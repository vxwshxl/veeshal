// Makes a web-sized copy of every timeline certificate and uploads it to R2
// next to the original, under achievement/web/<same filename>. The timeline
// page serves the copy when it exists and falls back to the original.
//
//   node --env-file=.env.local scripts/optimize-achievements.mjs
//
// Re-run after adding a new timeline event. Copies already on R2 are skipped.

import { createRequire } from 'node:module';
import { createHash, createHmac } from 'node:crypto';

// sharp ships as Next's image dependency; resolve it from there.
const require = createRequire(import.meta.url);
const sharp = createRequire(require.resolve('next/package.json'))('sharp');

const MAX_EDGE = 1600;
const WEB_DIR = 'achievement/web';

const env = (k) => { if (!process.env[k]) throw new Error(`Missing ${k}`); return process.env[k]; };
const SB_URL = env('NEXT_PUBLIC_SUPABASE_URL');
const SB_KEY = env('NEXT_PUBLIC_SUPABASE_ANON_KEY');
const R2_ACCOUNT = env('R2_ACCOUNT_ID');
const R2_KEY_ID = env('R2_ACCESS_KEY_ID');
const R2_SECRET = env('R2_SECRET_ACCESS_KEY');
const R2_BUCKET = env('R2_BUCKET_NAME');
const R2_PUBLIC = env('R2_PUBLIC_URL');

const sha256 = (d) => createHash('sha256').update(d).digest('hex');
const hmac = (k, d) => createHmac('sha256', k).update(d).digest();
const encodeKey = (key) => key.split('/').map((s) =>
  encodeURIComponent(s).replace(/[!'()*]/g, (c) => '%' + c.charCodeAt(0).toString(16).toUpperCase())).join('/');

// Minimal SigV4 PutObject against R2's S3 endpoint.
async function putObject(key, body, contentType) {
  const host = `${R2_ACCOUNT}.r2.cloudflarestorage.com`;
  const path = `/${R2_BUCKET}/${encodeKey(key)}`;
  const amzDate = new Date().toISOString().replace(/[:-]|\.\d{3}/g, '');
  const day = amzDate.slice(0, 8);
  const payloadHash = sha256(body);
  const headers = {
    'cache-control': 'public, max-age=31536000, immutable',
    'content-type': contentType,
    host,
    'x-amz-content-sha256': payloadHash,
    'x-amz-date': amzDate,
  };
  const signed = Object.keys(headers).sort();
  const canonical = ['PUT', path, '', ...signed.map((h) => `${h}:${headers[h]}`), '', signed.join(';'), payloadHash].join('\n');
  const scope = `${day}/auto/s3/aws4_request`;
  const toSign = ['AWS4-HMAC-SHA256', amzDate, scope, sha256(canonical)].join('\n');
  const kSign = hmac(hmac(hmac(hmac(`AWS4${R2_SECRET}`, day), 'auto'), 's3'), 'aws4_request');
  const sig = createHmac('sha256', kSign).update(toSign).digest('hex');

  const { host: _, ...sendHeaders } = headers;
  const res = await fetch(`https://${host}${path}`, {
    method: 'PUT',
    body,
    headers: { ...sendHeaders, authorization: `AWS4-HMAC-SHA256 Credential=${R2_KEY_ID}/${scope}, SignedHeaders=${signed.join(';')}, Signature=${sig}` },
  });
  if (!res.ok) throw new Error(`PUT ${key} -> ${res.status} ${await res.text()}`);
}

const rows = await (await fetch(`${SB_URL}/rest/v1/timeline_events?select=images`, { headers: { apikey: SB_KEY } })).json();
const srcs = [...new Set(rows.flatMap((r) => (typeof r.images === 'string' ? JSON.parse(r.images) : r.images)))]
  .filter((s) => s.startsWith(`${R2_PUBLIC}/achievement/`) && !s.includes(`/${WEB_DIR}/`));

for (const src of srcs) {
  const name = decodeURIComponent(src.split('/').pop());
  const key = `${WEB_DIR}/${name}`;
  if ((await fetch(`${R2_PUBLIC}/${encodeKey(key)}`, { method: 'HEAD' })).ok) { console.log('skip ', name); continue; }

  const buf = Buffer.from(await (await fetch(src)).arrayBuffer());
  const { data, info } = await sharp(buf, { limitInputPixels: false })
    .rotate()
    .resize(MAX_EDGE, MAX_EDGE, { fit: 'inside', withoutEnlargement: true })
    .webp({ quality: 80 })
    .toBuffer({ resolveWithObject: true });
  await putObject(key, data, 'image/webp');
  console.log(`up   ${name}  ${(buf.length / 1024) | 0}KB -> ${(data.length / 1024) | 0}KB  ${info.width}x${info.height}`);
}
