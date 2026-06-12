<?php
/**
 * Tiny server-side Supabase REST reader (anon key, read-only).
 * Every page falls back to its static content if this returns null,
 * so the site never breaks when offline / rate-limited.
 */

function sb_env()
{
    static $env = null;
    if ($env !== null) return $env;

    $env = [];
    $candidates = [
        __DIR__ . '/../.env',          // localhost
        __DIR__ . '/../../config/.env' // production
    ];
    foreach ($candidates as $path) {
        if (file_exists($path)) {
            $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                if (strpos(trim($line), '#') === 0) continue;
                $parts = explode('=', $line, 2);
                if (count($parts) === 2) $env[trim($parts[0])] = trim($parts[1]);
            }
            break;
        }
    }
    return $env;
}

/**
 * GET /rest/v1/{table}?{query} → decoded array, or null on any failure.
 * Cached per request; short timeout so a Supabase hiccup can't stall the page.
 */
function sb_fetch($table, $query = 'select=*')
{
    static $cache = [];
    $key = $table . '?' . $query;
    if (array_key_exists($key, $cache)) return $cache[$key];

    $env = sb_env();
    if (empty($env['NEXT_PUBLIC_SUPABASE_URL']) || empty($env['NEXT_PUBLIC_SUPABASE_ANON_KEY'])) {
        return $cache[$key] = null;
    }

    $url = rtrim($env['NEXT_PUBLIC_SUPABASE_URL'], '/') . '/rest/v1/' . $table . '?' . $query;
    $anon = $env['NEXT_PUBLIC_SUPABASE_ANON_KEY'];

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CONNECTTIMEOUT => 2,
        CURLOPT_TIMEOUT => 3,
        CURLOPT_HTTPHEADER => [
            'apikey: ' . $anon,
            'Authorization: Bearer ' . $anon,
        ],
    ]);
    $body = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($body === false || $code !== 200) return $cache[$key] = null;
    $data = json_decode($body, true);
    if (!is_array($data)) return $cache[$key] = null;
    return $cache[$key] = $data;
}

/** Read one site_settings value (already-decoded), or $default. */
function sb_setting($key, $default = null)
{
    $rows = sb_fetch('site_settings', 'select=key,value');
    if (!$rows) return $default;
    foreach ($rows as $r) {
        if ($r['key'] === $key) return $r['value'];
    }
    return $default;
}

/** Prefix root-relative asset paths ("assets/…") with $base; pass URLs through. */
function sb_asset($path, $base = '')
{
    if (!$path) return '';
    if (preg_match('#^https?://#', $path)) return $path;
    return $base . ltrim($path, '/');
}
