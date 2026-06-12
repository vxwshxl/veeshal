<?php
/**
 * Tiny server-side Supabase REST reader (anon key, read-only).
 * Every page falls back to its static content if this returns null,
 * so the site never breaks when offline / rate-limited.
 *
 * Disk cache (lib/cache/, SB_CACHE_TTL) keeps page loads off the network;
 * sb_prefetch() refreshes several queries in ONE parallel round trip so
 * even a cold cache costs a single RTT, not one per table.
 */

const SB_CACHE_TTL = 120; // seconds before we re-check Supabase

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

function sb_cache_file($key)
{
    $dir = __DIR__ . '/cache';
    if (!is_dir($dir)) @mkdir($dir, 0775, true);
    return $dir . '/' . md5($key) . '.json';
}

function sb_url_for($table, $query)
{
    $env = sb_env();
    if (empty($env['NEXT_PUBLIC_SUPABASE_URL']) || empty($env['NEXT_PUBLIC_SUPABASE_ANON_KEY'])) return null;
    return rtrim($env['NEXT_PUBLIC_SUPABASE_URL'], '/') . '/rest/v1/' . $table . '?' . $query;
}

function sb_headers()
{
    $env = sb_env();
    $anon = $env['NEXT_PUBLIC_SUPABASE_ANON_KEY'];
    return ['apikey: ' . $anon, 'Authorization: Bearer ' . $anon];
}

/**
 * Refresh several [table, query] pairs in ONE parallel round trip,
 * skipping anything whose disk cache is still fresh. Call once at the
 * top of a page so the sb_fetch() calls below it never hit the network
 * one-by-one. On failure the stale cache is "touched" so the page (and
 * the next ones inside the TTL window) serve stale instead of blocking.
 */
function sb_prefetch(array $requests)
{
    $pending = [];
    foreach ($requests as $req) {
        list($table, $query) = $req;
        $key = $table . '?' . $query;
        $file = sb_cache_file($key);
        if (is_file($file) && (time() - filemtime($file)) < SB_CACHE_TTL) continue;
        $url = sb_url_for($table, $query);
        if ($url) $pending[$key] = $url;
    }
    if (!$pending) return;

    $mh = curl_multi_init();
    $handles = [];
    foreach ($pending as $key => $url) {
        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CONNECTTIMEOUT => 2,
            CURLOPT_TIMEOUT => 3,
            CURLOPT_HTTPHEADER => sb_headers(),
        ]);
        curl_multi_add_handle($mh, $ch);
        $handles[$key] = $ch;
    }

    do {
        $status = curl_multi_exec($mh, $running);
        if ($running) curl_multi_select($mh, 0.2);
    } while ($running && $status === CURLM_OK);

    foreach ($handles as $key => $ch) {
        $body = curl_multi_getcontent($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $file = sb_cache_file($key);
        if ($body !== false && $code === 200 && is_array(json_decode($body, true))) {
            @file_put_contents($file, $body, LOCK_EX);
        } elseif (is_file($file)) {
            @touch($file); // serve stale quietly; retry next TTL window
        }
        curl_multi_remove_handle($mh, $ch);
        curl_close($ch);
    }
    curl_multi_close($mh);
}

/**
 * GET /rest/v1/{table}?{query} → decoded array, or null on any failure.
 * Fresh disk cache is served instantly; otherwise one network call with
 * stale-cache fallback.
 */
function sb_fetch($table, $query = 'select=*')
{
    static $memo = [];
    $key = $table . '?' . $query;
    if (array_key_exists($key, $memo)) return $memo[$key];

    $url = sb_url_for($table, $query);
    if (!$url) return $memo[$key] = null;

    $cacheFile = sb_cache_file($key);

    // fresh cache → no network at all
    if (is_file($cacheFile) && (time() - filemtime($cacheFile)) < SB_CACHE_TTL) {
        $data = json_decode(@file_get_contents($cacheFile), true);
        if (is_array($data)) return $memo[$key] = $data;
    }

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CONNECTTIMEOUT => 2,
        CURLOPT_TIMEOUT => 3,
        CURLOPT_HTTPHEADER => sb_headers(),
    ]);
    $body = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($body !== false && $code === 200) {
        $data = json_decode($body, true);
        if (is_array($data)) {
            @file_put_contents($cacheFile, $body, LOCK_EX);
            return $memo[$key] = $data;
        }
    }

    // network failed → serve stale cache of any age before giving up
    if (is_file($cacheFile)) {
        @touch($cacheFile); // don't retry on every request while Supabase is down
        $data = json_decode(@file_get_contents($cacheFile), true);
        if (is_array($data)) return $memo[$key] = $data;
    }

    return $memo[$key] = null;
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
