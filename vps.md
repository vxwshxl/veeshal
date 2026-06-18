# veeshal VPS Deployment
```bash
cd /var/www/veeshal
git pull origin main
pnpm install --frozen-lockfile
NODE_OPTIONS="--max-old-space-size=4096" pnpm build
pm2 restart veeshal --update-env
```


cd /var/www/veeshal
git pull origin main
pnpm install --frozen-lockfile
pnpm build
pm2 reload veeshal --update-env

# Deploying the Next.js site to the VPS (nginx)

The repo is now a pure Next.js app at its root (the PHP files were removed).
We run Next on an internal port (`127.0.0.1:3002`) and point nginx at it via a
reverse proxy.

> **Port note:** this box already runs other Next apps — `3000`
> (anglo-bodo-dictionary / bodookhrang), `3001` (ku-app), `8000` (supabase).
> veeshal uses **3002** to avoid an `EADDRINUSE` collision. If you change it,
> change it in both the `PORT=` of the `pm2 start` command (delete + recreate the
> process) and the nginx `proxy_pass`.

> **Before you pull on the VPS:** the old PHP is gone from the repo, so the next
> `git pull` will remove the PHP files from the server. Do steps 1–5 in one
> sitting so there's no gap. Note your current commit first for rollback:
> `git -C /var/www/veeshal rev-parse HEAD` and back up the nginx file:
> `sudo cp /etc/nginx/sites-enabled/veeshal ~/veeshal-nginx-php.bak`.

---

## 1. One-time: install Node 22 LTS + pnpm on the VPS

```bash
curl -fsSL https://deb.nodesource.com/setup_22.x | sudo -E bash -
sudo apt install -y nodejs
node -v   # should print v22.x

# Enable pnpm via Corepack (ships with Node 22; respects the
# "packageManager" field in package.json, so versions stay in sync)
sudo corepack enable
corepack prepare pnpm@10.26.2 --activate
pnpm -v   # should print 10.26.2
```

## 2. One-time: env file on the VPS

`.env.local` is gitignored, so it never lands via `git pull` — create it once:

```bash
cd /var/www/veeshal
nano .env.local        # paste the same vars as your old .env
```

It needs at minimum:

```
NEXT_PUBLIC_SUPABASE_URL=...
NEXT_PUBLIC_SUPABASE_ANON_KEY=...
SUPABASE_SERVICE_ROLE_KEY=...
EMAILJS_SERVICE_ID=...
EMAILJS_TEMPLATE_ID=...
EMAILJS_PUBLIC_KEY=...
```

## 3. Pull + build

```bash
cd /var/www/veeshal
git pull origin main            # removes PHP, brings the Next app to the root
pnpm install --frozen-lockfile  # clean install from pnpm-lock.yaml
pnpm build                      # sharp builds via pnpm.onlyBuiltDependencies in package.json
```

## 4. One-time: run Next under PM2

Create a new PM2 process named `veeshal`, running Next directly via node on
`127.0.0.1:3002` — the same way the other apps on this box (`bodo`, `ku`) are
managed by PM2.

```bash
cd /var/www/veeshal
PORT=3002 pm2 start node_modules/next/dist/bin/next --name veeshal -- start
pm2 save                                # persist so it survives reboots
pm2 list                                # veeshal should be "online"
wget -qO- http://127.0.0.1:3002 | head  # Next is responding
```

After this, every deploy just reloads it: `pm2 reload veeshal --update-env`.

> If PM2 isn't yet set to launch on boot, run `pm2 startup` once and follow the
> printed command (you likely already did this for `bodo`/`ku`).

### Migrating off the old systemd service (one-time, if it exists)

veeshal previously ran under systemd. Remove it so the two don't fight over the
port:

```bash
sudo systemctl stop veeshal-next
sudo systemctl disable veeshal-next
sudo rm /etc/systemd/system/veeshal-next.service
sudo systemctl daemon-reload
```

## 5. Point nginx at Next

Edit `/etc/nginx/sites-enabled/veeshal`. Replace the PHP `location` blocks
with a reverse proxy. Keep the Certbot SSL lines exactly as they are.

```nginx
server {
    server_name veeshal.me www.veeshal.me;

    # Static files Next serves with content hashes (immutable, cached hard)
    location /_next/static/ {
        proxy_pass http://127.0.0.1:3002;
        add_header Cache-Control "public, max-age=31536000, immutable";
    }

    # Everything else → Next.js
    location / {
        proxy_pass http://127.0.0.1:3002;
        proxy_http_version 1.1;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
    }

    listen 443 ssl; # managed by Certbot
    ssl_certificate /etc/letsencrypt/live/veeshal.me/fullchain.pem; # managed by Certbot
    ssl_certificate_key /etc/letsencrypt/live/veeshal.me/privkey.pem; # managed by Certbot
    include /etc/letsencrypt/options-ssl-nginx.conf; # managed by Certbot
    ssl_dhparam /etc/letsencrypt/ssl-dhparams.pem; # managed by Certbot
}

server {
    if ($host = www.veeshal.me) { return 301 https://$host$request_uri; }
    if ($host = veeshal.me)     { return 301 https://$host$request_uri; }
    listen 80;
    server_name veeshal.me www.veeshal.me;
    return 404;
}
```

Apply:

```bash
sudo nginx -t && sudo systemctl reload nginx
```

Visit https://veeshal.me — it's now served by Next.js.

### Rollback (if needed)
```bash
cd /var/www/veeshal
git checkout <old-php-commit>            # the SHA you noted above
sudo cp ~/veeshal-nginx-php.bak /etc/nginx/sites-enabled/veeshal
sudo systemctl reload nginx
sudo systemctl restart php8.4-fpm
```

---

## 6. CI deploys (already wired)

`.github/workflows/deploy.yml` now runs, on every push to `main`:

```yaml
cd ${{ secrets.VPS_PATH }}
git pull origin main
pnpm install --frozen-lockfile
pnpm build
pm2 reload veeshal --update-env
```

No `sudo` is needed — PM2 runs as the deploy user (`VPS_USER`), so make sure the
SSH deploy user is the **same user that owns the PM2 daemon** running `bodo`/`ku`
(on this box that's `root`). The old `systemctl` sudoers line is no longer
required and can be removed from `sudo visudo`.

Once Next is live you can `sudo systemctl disable --now php8.4-fpm` and
`sudo apt remove php8.4-fpm` if nothing else on the box uses PHP.

---

## Why this kills your cache problem

- Next fingerprints its own CSS/JS (`/_next/static/...[hash]`) → browsers
  always fetch the new version after a deploy. No hard refresh, ever.
- Your reused `/js/*.js` get a `?v=<deploy id>` query (see `app/Scripts.tsx`),
  so they bust on every restart too.
- Supabase content still refreshes every 120s with no rebuild (ISR), same as
  the old PHP disk-cache TTL.
