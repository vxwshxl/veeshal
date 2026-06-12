<?php
// /vee — CMS panel (Supabase-backed). Keys come from .env (never hardcoded).
$env = [];
$envPath = null;
if (file_exists(__DIR__ . '/../.env')) {
    $envPath = __DIR__ . '/../.env';
} elseif (file_exists(__DIR__ . '/../../config/.env')) {
    $envPath = __DIR__ . '/../../config/.env';
}
if ($envPath) {
    $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        $parts = explode('=', $line, 2);
        if (count($parts) === 2) $env[trim($parts[0])] = trim($parts[1]);
    }
}
$SB_URL = isset($env['NEXT_PUBLIC_SUPABASE_URL']) ? $env['NEXT_PUBLIC_SUPABASE_URL'] : '';
$SB_ANON = isset($env['NEXT_PUBLIC_SUPABASE_ANON_KEY']) ? $env['NEXT_PUBLIC_SUPABASE_ANON_KEY'] : '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>vee. — control room</title>
    <link rel="icon" type="image/svg+xml" href="../favicon.svg" />
    <link href="https://api.fontshare.com/v2/css?f[]=clash-display@500,600,700&f[]=general-sans@400,500,600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,400;0,500;0,700;1,400&display=swap" rel="stylesheet">
    <style>
        :root {
            --paper: #f8f7f3;
            --ink: #111110;
            --ink-2: #1a1a18;
            --ink-3: #242422;
            --amber: #F9B646;
            --coral: #ff5f6d;
            --line: rgba(248, 247, 243, 0.12);
            --muted: #a3a094;
            --mono: 'JetBrains Mono', monospace;
            --display: 'Clash Display', sans-serif;
            --body: 'General Sans', sans-serif;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: var(--body);
            background: var(--ink);
            color: var(--paper);
            min-height: 100vh;
        }

        ::selection { background: var(--amber); color: var(--ink); }

        .mono { font-family: var(--mono); font-size: 11px; letter-spacing: 0.14em; text-transform: uppercase; }
        .amber { color: var(--amber); }

        button { font-family: var(--mono); cursor: pointer; }

        /* ---------- login ---------- */
        .login-wrap {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background:
                radial-gradient(ellipse 60% 40% at 50% 0%, rgba(249, 182, 70, 0.08), transparent 70%),
                var(--ink);
        }

        .login-card {
            width: min(400px, 92vw);
            border: 1px solid var(--line);
            border-radius: 20px;
            padding: 40px 34px;
            background: var(--ink-2);
        }

        .login-card h1 {
            font-family: var(--display);
            font-weight: 600;
            font-size: 34px;
            margin-bottom: 4px;
        }

        .login-card .sub { color: var(--muted); font-size: 13px; margin-bottom: 28px; }

        .field { margin-bottom: 18px; }

        .field label {
            display: block;
            font-family: var(--mono);
            font-size: 10px;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 7px;
        }

        .field input, .field textarea, .field select {
            width: 100%;
            background: var(--ink);
            border: 1px solid var(--line);
            border-radius: 10px;
            color: var(--paper);
            padding: 11px 14px;
            font-size: 14px;
            font-family: var(--body);
            outline: none;
            transition: border-color 0.2s;
        }

        .field textarea { min-height: 90px; resize: vertical; line-height: 1.5; }
        .field textarea.big { min-height: 220px; font-family: var(--mono); font-size: 12.5px; }

        .field input:focus, .field textarea:focus, .field select:focus { border-color: var(--amber); }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--amber);
            color: var(--ink);
            border: 1.5px solid var(--amber);
            font-size: 12px;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            font-weight: 700;
            padding: 12px 24px;
            border-radius: 99px;
            transition: all 0.2s;
        }

        .btn:hover { background: transparent; color: var(--amber); }
        .btn.ghost { background: transparent; color: var(--paper); border-color: var(--line); }
        .btn.ghost:hover { border-color: var(--amber); color: var(--amber); }
        .btn.danger { background: transparent; color: var(--coral); border-color: rgba(255, 95, 109, 0.4); }
        .btn.danger:hover { background: var(--coral); color: var(--ink); border-color: var(--coral); }
        .btn.sm { padding: 7px 14px; font-size: 10px; }
        .btn:disabled { opacity: 0.5; cursor: wait; }

        .err { color: var(--coral); font-size: 13px; margin-top: 12px; min-height: 18px; }

        /* ---------- app shell ---------- */
        .shell { display: none; min-height: 100vh; }
        .shell.on { display: grid; grid-template-columns: 240px 1fr; }

        aside {
            border-right: 1px solid var(--line);
            padding: 26px 18px;
            background: var(--ink-2);
            display: flex;
            flex-direction: column;
            gap: 4px;
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
        }

        aside .brand {
            font-family: var(--display);
            font-weight: 600;
            font-size: 26px;
            padding: 0 10px 18px;
        }

        aside .nav-btn {
            text-align: left;
            background: transparent;
            border: none;
            color: var(--muted);
            font-size: 11px;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            padding: 11px 12px;
            border-radius: 10px;
            transition: all 0.15s;
        }

        aside .nav-btn:hover { color: var(--paper); background: var(--ink-3); }
        aside .nav-btn.on { color: var(--ink); background: var(--amber); font-weight: 700; }

        aside .foot { margin-top: auto; padding-top: 18px; border-top: 1px solid var(--line); }

        main { padding: 30px clamp(18px, 3vw, 44px); max-width: 1100px; }

        .page-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
            margin-bottom: 24px;
        }

        .page-head h2 {
            font-family: var(--display);
            font-weight: 600;
            font-size: 32px;
            text-transform: lowercase;
        }

        .hint { color: var(--muted); font-size: 12.5px; margin-bottom: 18px; }

        /* ---------- rows ---------- */
        .rows { display: flex; flex-direction: column; gap: 10px; }

        .row {
            display: flex;
            align-items: center;
            gap: 14px;
            border: 1px solid var(--line);
            border-radius: 14px;
            padding: 12px 16px;
            background: var(--ink-2);
        }

        .row.hidden-row { opacity: 0.45; }

        .row .thumb {
            width: 56px;
            height: 42px;
            border-radius: 8px;
            object-fit: cover;
            background: var(--ink-3);
            flex-shrink: 0;
        }

        .row .meta { flex: 1; min-width: 0; }

        .row .title { font-weight: 600; font-size: 14.5px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .row .sub { color: var(--muted); font-size: 11.5px; font-family: var(--mono); }

        .row .acts { display: flex; gap: 6px; flex-shrink: 0; }

        .icon-btn {
            background: var(--ink-3);
            border: 1px solid var(--line);
            color: var(--paper);
            width: 30px;
            height: 30px;
            border-radius: 8px;
            font-size: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.15s;
        }

        .icon-btn:hover { border-color: var(--amber); color: var(--amber); }
        .icon-btn.del:hover { border-color: var(--coral); color: var(--coral); }

        /* ---------- modal ---------- */
        .modal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(6px);
            z-index: 100;
            align-items: flex-start;
            justify-content: center;
            padding: 5vh 16px;
            overflow-y: auto;
        }

        .modal.on { display: flex; }

        .modal-card {
            width: min(640px, 100%);
            background: var(--ink-2);
            border: 1px solid var(--line);
            border-radius: 18px;
            padding: 30px;
        }

        .modal-card h3 {
            font-family: var(--display);
            font-weight: 600;
            font-size: 24px;
            margin-bottom: 22px;
            text-transform: lowercase;
        }

        .grid2 { display: grid; grid-template-columns: 1fr 1fr; gap: 0 16px; }

        @media (max-width: 600px) { .grid2 { grid-template-columns: 1fr; } }

        .modal-acts { display: flex; justify-content: flex-end; gap: 10px; margin-top: 10px; }

        .upload-row { display: flex; gap: 8px; align-items: center; }
        .upload-row input { flex: 1; }

        .check { display: flex; align-items: center; gap: 10px; padding: 10px 0; }
        .check input { width: 18px; height: 18px; accent-color: var(--amber); }
        .check span { font-size: 13px; color: var(--muted); }

        /* ---------- toast ---------- */
        #toast {
            position: fixed;
            bottom: 22px;
            right: 22px;
            z-index: 200;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .t {
            background: var(--ink-2);
            border: 1px solid var(--line);
            border-left: 4px solid var(--amber);
            border-radius: 10px;
            padding: 12px 18px;
            font-size: 13px;
            animation: tin 0.25s ease;
        }

        .t.bad { border-left-color: var(--coral); }

        @keyframes tin { from { transform: translateY(10px); opacity: 0; } }

        .live-dot {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            font-family: var(--mono);
            font-size: 10px;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--muted);
        }

        .live-dot::before {
            content: "";
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #3ddc84;
            animation: pulse 1.6s ease infinite;
        }

        @keyframes pulse { 50% { opacity: 0.3; } }

        @media (max-width: 860px) {
            .shell.on { grid-template-columns: 1fr; }
            aside { position: relative; height: auto; flex-direction: row; flex-wrap: wrap; align-items: center; }
            aside .brand { padding: 0 10px 0 0; font-size: 20px; }
            aside .foot { margin: 0 0 0 auto; padding: 0; border: none; }
        }
    </style>
</head>

<body>

    <!-- login -->
    <div class="login-wrap" id="loginView">
        <form class="login-card" id="loginForm">
            <h1>vee<span class="amber">.</span> control room</h1>
            <p class="sub">sign in to manage the site</p>
            <div class="field">
                <label for="loginEmail">email</label>
                <input id="loginEmail" type="email" autocomplete="username" required>
            </div>
            <div class="field">
                <label for="loginPass">password</label>
                <input id="loginPass" type="password" autocomplete="current-password" required>
            </div>
            <button class="btn" id="loginBtn" type="submit">start engine →</button>
            <p class="err" id="loginErr"></p>
        </form>
    </div>

    <!-- app -->
    <div class="shell" id="app">
        <aside>
            <div class="brand">vee<span class="amber">.</span></div>
            <div id="navBtns"></div>
            <div class="foot">
                <span class="live-dot" id="liveDot">realtime</span>
                <button class="btn ghost sm" id="logoutBtn" style="margin-top:12px;">logout</button>
            </div>
        </aside>

        <main>
            <div class="page-head">
                <h2 id="secTitle">settings</h2>
                <button class="btn sm" id="addBtn" style="display:none;">+ add new</button>
            </div>
            <p class="hint" id="secHint"></p>
            <div id="content"></div>
        </main>
    </div>

    <!-- modal -->
    <div class="modal" id="modal">
        <form class="modal-card" id="modalForm">
            <h3 id="modalTitle">edit</h3>
            <div id="modalFields"></div>
            <div class="modal-acts">
                <button type="button" class="btn ghost sm" id="modalCancel">cancel</button>
                <button type="submit" class="btn sm" id="modalSave">save</button>
            </div>
        </form>
    </div>

    <div id="toast"></div>

    <script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2/dist/umd/supabase.min.js"></script>
    <script>
        const SB_URL = "<?php echo $SB_URL; ?>";
        const SB_ANON = "<?php echo $SB_ANON; ?>";
        const sb = window.supabase.createClient(SB_URL, SB_ANON);

        /* ------------------------------------------------------------
           table configs — drive the whole CRUD UI
           ------------------------------------------------------------ */
        const F = (k, t = 'text', label = null, opts = null) => ({ k, t, label: label || k.replace(/_/g, ' '), opts });

        const TABLES = {
            settings: { label: 'Settings', special: 'settings', hint: 'Resume, contact email, hero copy & home-page stats.' },
            featured_projects: {
                label: 'Featured Projects', titleKey: 'name', subKeys: ['info', 'tag'], imgKey: 'hover_src',
                hint: 'The hover-menu list on the home page. One of url / video / image decides what a click does.',
                fields: [F('name'), F('info', 'text', 'category line (left)'), F('tag', 'text', 'tag line (right)'),
                    F('url', 'url', 'open URL (external link)'), F('video', 'url', 'video URL (popup)'),
                    F('image', 'image', 'image (popup)'), F('hover_src', 'image', 'hover preview image'),
                    F('sort', 'number'), F('visible', 'bool')],
            },
            gallery: {
                label: 'Gallery', titleKey: 'alt', subKeys: ['image_url'], imgKey: 'image_url',
                hint: 'The 6-frame portfolio wall on the home page.',
                fields: [F('image_url', 'image', 'image'), F('alt', 'text', 'alt text'), F('sort', 'number'), F('visible', 'bool')],
            },
            projects: {
                label: 'All Projects', titleKey: 'title', subKeys: ['cat', 'year'], imgKey: 'img',
                hint: 'The detailed case studies on /projects.',
                fields: [F('title'), F('cat', 'select', 'category', ['development', 'video', 'design']),
                    F('cat_label', 'text', 'chip label'), F('img', 'image', 'cover image'),
                    F('description', 'textarea', 'description (HTML ok)'), F('role'), F('stack', 'text', 'toolkit'),
                    F('year'), F('action', 'text', 'button text'), F('url', 'url', 'open URL'),
                    F('video', 'url', 'video URL (popup)'), F('image', 'image', 'image (popup)'),
                    F('sort', 'number'), F('visible', 'bool')],
            },
            skills: {
                label: 'Skill Icons', titleKey: 'name', subKeys: ['icon_url'], imgKey: 'icon_url',
                hint: 'The grayscale logo marquee in the about section.',
                fields: [F('name'), F('icon_url', 'image', 'icon'), F('sort', 'number'), F('visible', 'bool')],
            },
            timeline_events: {
                label: 'Timeline', titleKey: 'title', subKeys: ['tag', 'date_label'],
                hint: 'Achievements on /timeline. Images is a JSON array of URLs (first = cover).',
                fields: [F('title'), F('tag', 'text', 'badge (Winner…)'), F('date_label', 'text', 'date'),
                    F('description', 'textarea'), F('images', 'json', 'images (JSON array of URLs)'),
                    F('sort', 'number'), F('visible', 'bool')],
            },
            chaicode_items: {
                label: 'ChaiCode', titleKey: 'title', subKeys: ['category', 'date_label'], imgKey: 'image',
                hint: 'Cards on /chaicode.',
                fields: [F('title'), F('category'), F('date_label', 'text', 'date'), F('image', 'image', 'cover'),
                    F('link', 'text', 'link (relative or URL)'), F('sort', 'number'), F('visible', 'bool')],
            },
            blogs: {
                label: 'Blogs', titleKey: 'title', subKeys: ['category', 'date_label'], imgKey: 'image',
                hint: 'Cards on /blogs. Static posts point at existing PHP pages; new posts can carry their own HTML and render at /blogs/post?slug=…',
                fields: [F('title'), F('slug'), F('category', 'select', 'category', ['JavaScript', 'HTML & CSS', 'Software development']),
                    F('date_label', 'text', 'date'), F('image', 'image', 'cover'),
                    F('excerpt', 'textarea'), F('content_html', 'bigtext', 'content (HTML — used when not static)'),
                    F('is_static', 'bool', 'static page (existing PHP file)'), F('sort', 'number'), F('published', 'bool')],
            },
            social_links: {
                label: 'Social Links', titleKey: 'label', subKeys: ['url'],
                hint: 'The round chips in the home hero (and used site-wide).',
                fields: [F('label', 'text', 'short label (yt/ig/…)'), F('url', 'url'), F('sort', 'number'), F('visible', 'bool')],
            },
        };

        const $ = (s) => document.querySelector(s);
        let session = null;
        let current = 'settings';
        let rows = [];
        let channel = null;

        function toast(msg, bad = false) {
            const t = document.createElement('div');
            t.className = 't' + (bad ? ' bad' : '');
            t.textContent = msg;
            $('#toast').appendChild(t);
            setTimeout(() => t.remove(), 3500);
        }

        /* ---------- auth ---------- */
        $('#loginForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            $('#loginBtn').disabled = true;
            $('#loginErr').textContent = '';
            const { error } = await sb.auth.signInWithPassword({
                email: $('#loginEmail').value.trim(),
                password: $('#loginPass').value,
            });
            $('#loginBtn').disabled = false;
            if (error) $('#loginErr').textContent = error.message;
        });

        $('#logoutBtn').addEventListener('click', () => sb.auth.signOut());

        sb.auth.onAuthStateChange((_e, s) => {
            session = s;
            const onIn = !!s;
            $('#loginView').style.display = onIn ? 'none' : 'flex';
            $('#app').classList.toggle('on', onIn);
            if (onIn) { buildNav(); openSection('settings'); }
        });

        /* ---------- nav ---------- */
        function buildNav() {
            const wrap = $('#navBtns');
            wrap.innerHTML = '';
            Object.entries(TABLES).forEach(([key, cfg]) => {
                const b = document.createElement('button');
                b.className = 'nav-btn' + (key === current ? ' on' : '');
                b.textContent = cfg.label;
                b.onclick = () => openSection(key);
                wrap.appendChild(b);
            });
        }

        function openSection(key) {
            current = key;
            buildNav();
            const cfg = TABLES[key];
            $('#secTitle').textContent = cfg.label.toLowerCase();
            $('#secHint').textContent = cfg.hint || '';
            $('#addBtn').style.display = cfg.special ? 'none' : 'inline-flex';
            subscribe(key);
            cfg.special === 'settings' ? renderSettings() : loadRows();
        }

        /* ---------- realtime ---------- */
        function subscribe(key) {
            if (channel) sb.removeChannel(channel);
            const table = key === 'settings' ? 'site_settings' : key;
            channel = sb.channel('cms-' + table)
                .on('postgres_changes', { event: '*', schema: 'public', table }, () => {
                    current === 'settings' ? renderSettings() : loadRows();
                })
                .subscribe();
        }

        /* ---------- generic list ---------- */
        async function loadRows() {
            const { data, error } = await sb.from(current).select('*').order('sort', { ascending: true }).order('id');
            if (error) return toast(error.message, true);
            rows = data;
            const cfg = TABLES[current];
            const wrap = document.createElement('div');
            wrap.className = 'rows';

            rows.forEach((r, idx) => {
                const div = document.createElement('div');
                div.className = 'row' + ((r.visible === false || r.published === false) ? ' hidden-row' : '');
                const img = cfg.imgKey && r[cfg.imgKey]
                    ? `<img class="thumb" src="${pub(r[cfg.imgKey])}" alt="" onerror="this.style.visibility='hidden'">`
                    : '';
                const sub = (cfg.subKeys || []).map((k) => r[k]).filter(Boolean).join(' — ');
                div.innerHTML = `${img}
                    <div class="meta">
                        <div class="title">${escapeHtml(String(r[cfg.titleKey] || r.id))}</div>
                        <div class="sub">${escapeHtml(sub)}</div>
                    </div>
                    <div class="acts">
                        <button type="button" class="icon-btn" title="move up">↑</button>
                        <button type="button" class="icon-btn" title="move down">↓</button>
                        <button type="button" class="icon-btn" title="show/hide">${(r.visible === false || r.published === false) ? '🚫' : '👁'}</button>
                        <button type="button" class="icon-btn" title="edit">✏️</button>
                        <button type="button" class="icon-btn del" title="delete">✕</button>
                    </div>`;
                const [up, down, vis, edit, del] = div.querySelectorAll('.icon-btn');
                up.onclick = () => move(idx, -1);
                down.onclick = () => move(idx, 1);
                vis.onclick = () => toggleVisible(r);
                edit.onclick = () => openModal(r);
                del.onclick = () => removeRow(r);
                wrap.appendChild(div);
            });

            if (!rows.length) wrap.innerHTML = '<p class="hint">nothing here yet — add the first one.</p>';
            $('#content').replaceChildren(wrap);
        }

        function pub(u) {
            if (!u) return '';
            if (/^https?:\/\//.test(u)) return u;
            return '../' + u; // root-relative asset paths
        }

        function escapeHtml(s) {
            return s.replace(/[&<>"']/g, (c) => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c]));
        }

        async function move(idx, dir) {
            const j = idx + dir;
            if (j < 0 || j >= rows.length) return;
            const a = rows[idx], b = rows[j];
            const sa = a.sort, sbv = b.sort === a.sort ? a.sort + dir : b.sort;
            const r1 = await sb.from(current).update({ sort: sbv }).eq('id', a.id);
            const r2 = await sb.from(current).update({ sort: sa }).eq('id', b.id);
            if (r1.error || r2.error) toast((r1.error || r2.error).message, true);
            loadRows();
        }

        async function toggleVisible(r) {
            const key = ('published' in r) ? 'published' : 'visible';
            const { error } = await sb.from(current).update({ [key]: !(r[key] !== false) ? true : false }).eq('id', r.id);
            if (error) toast(error.message, true);
            loadRows();
        }

        async function removeRow(r) {
            if (!confirm('Delete this entry? This cannot be undone.')) return;
            const { error } = await sb.from(current).delete().eq('id', r.id);
            error ? toast(error.message, true) : toast('deleted');
            loadRows();
        }

        /* ---------- modal form ---------- */
        let editing = null;

        $('#addBtn').onclick = () => openModal(null);
        $('#modalCancel').onclick = () => $('#modal').classList.remove('on');
        $('#modal').addEventListener('click', (e) => { if (e.target === $('#modal')) $('#modal').classList.remove('on'); });

        function fieldHtml(f, val) {
            const v = val === null || val === undefined ? '' : val;
            const id = 'f_' + f.k;
            if (f.t === 'bool') {
                return `<label class="check"><input type="checkbox" id="${id}" ${v === false ? '' : 'checked'}><span>${f.label}</span></label>`;
            }
            if (f.t === 'textarea') return `<div class="field" style="grid-column:1/-1"><label for="${id}">${f.label}</label><textarea id="${id}">${escapeHtml(String(v))}</textarea></div>`;
            if (f.t === 'bigtext') return `<div class="field" style="grid-column:1/-1"><label for="${id}">${f.label}</label><textarea id="${id}" class="big">${escapeHtml(String(v))}</textarea></div>`;
            if (f.t === 'json') return `<div class="field" style="grid-column:1/-1"><label for="${id}">${f.label}</label><textarea id="${id}">${escapeHtml(typeof v === 'string' ? v : JSON.stringify(v, null, 1))}</textarea></div>`;
            if (f.t === 'select') {
                const ops = f.opts.map((o) => `<option ${o === v ? 'selected' : ''}>${o}</option>`).join('');
                return `<div class="field"><label for="${id}">${f.label}</label><select id="${id}">${ops}</select></div>`;
            }
            if (f.t === 'image') {
                return `<div class="field" style="grid-column:1/-1"><label for="${id}">${f.label}</label>
                    <div class="upload-row">
                        <input id="${id}" type="text" value="${escapeHtml(String(v))}" placeholder="URL or assets/… path">
                        <button type="button" class="btn ghost sm" onclick="uploadInto('${id}')">upload</button>
                    </div></div>`;
            }
            if (f.t === 'number') return `<div class="field"><label for="${id}">${f.label}</label><input id="${id}" type="number" value="${v === '' ? 0 : v}"></div>`;
            return `<div class="field"><label for="${id}">${f.label}</label><input id="${id}" type="text" value="${escapeHtml(String(v))}"></div>`;
        }

        async function uploadInto(inputId) {
            const picker = document.createElement('input');
            picker.type = 'file';
            picker.onchange = async () => {
                const file = picker.files[0];
                if (!file) return;
                toast('uploading…');
                const path = Date.now() + '-' + file.name.replace(/[^a-zA-Z0-9.\-_]/g, '_');
                const { error } = await sb.storage.from('media').upload(path, file, { upsert: true });
                if (error) return toast(error.message, true);
                const { data } = sb.storage.from('media').getPublicUrl(path);
                document.getElementById(inputId).value = data.publicUrl;
                toast('uploaded ✓');
            };
            picker.click();
        }

        function openModal(row) {
            editing = row;
            const cfg = TABLES[current];
            $('#modalTitle').textContent = (row ? 'edit ' : 'new ') + cfg.label.toLowerCase();
            $('#modalFields').innerHTML = '<div class="grid2">' +
                cfg.fields.map((f) => fieldHtml(f, row ? row[f.k] : (f.t === 'bool' ? true : f.t === 'number' ? (rows.length) : ''))).join('') +
                '</div>';
            $('#modal').classList.add('on');
        }

        $('#modalForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const cfg = TABLES[current];
            const payload = {};
            for (const f of cfg.fields) {
                const el = document.getElementById('f_' + f.k);
                if (f.t === 'bool') payload[f.k] = el.checked;
                else if (f.t === 'number') payload[f.k] = Number(el.value || 0);
                else if (f.t === 'json') {
                    try { payload[f.k] = el.value.trim() ? JSON.parse(el.value) : []; }
                    catch { return toast('invalid JSON in ' + f.label, true); }
                }
                else payload[f.k] = el.value.trim() || null;
            }
            $('#modalSave').disabled = true;
            const q = editing
                ? sb.from(current).update(payload).eq('id', editing.id)
                : sb.from(current).insert(payload);
            const { error } = await q;
            $('#modalSave').disabled = false;
            if (error) return toast(error.message, true);
            $('#modal').classList.remove('on');
            toast('saved ✓');
            loadRows();
        });

        /* ---------- settings (key/value) ---------- */
        async function renderSettings() {
            const { data, error } = await sb.from('site_settings').select('*');
            if (error) return toast(error.message, true);
            const map = Object.fromEntries(data.map((r) => [r.key, r.value]));
            const hero = map.hero || {};
            const el = document.createElement('div');
            el.innerHTML = `
                <div class="grid2">
                    <div class="field" style="grid-column:1/-1"><label>resume url</label>
                        <div class="upload-row">
                            <input id="s_resume" type="text" value="${escapeHtml(String(map.resume_url || ''))}">
                            <button type="button" class="btn ghost sm" onclick="uploadInto('s_resume')">upload pdf</button>
                        </div>
                    </div>
                    <div class="field"><label>contact email</label><input id="s_email" type="email" value="${escapeHtml(String(map.contact_email || ''))}"></div>
                    <div class="field"><label>hero eyebrow</label><input id="s_eyebrow" value="${escapeHtml(String(hero.eyebrow || ''))}"></div>
                    <div class="field"><label>hero title — line 1</label><input id="s_t1" value="${escapeHtml(String(hero.title_1 || ''))}"></div>
                    <div class="field"><label>hero title — line 2</label><input id="s_t2" value="${escapeHtml(String(hero.title_2 || ''))}"></div>
                    <div class="field" style="grid-column:1/-1"><label>hero copy</label><textarea id="s_copy">${escapeHtml(String(hero.copy || ''))}</textarea></div>
                    <div class="field" style="grid-column:1/-1"><label>stats (JSON array)</label><textarea id="s_stats" class="big" style="min-height:140px">${escapeHtml(JSON.stringify(map.stats || [], null, 2))}</textarea></div>
                </div>
                <button class="btn" id="saveSettings">save settings</button>`;
            $('#content').replaceChildren(el);

            $('#saveSettings').onclick = async () => {
                let stats;
                try { stats = JSON.parse($('#s_stats').value); }
                catch { return toast('stats: invalid JSON', true); }
                const updates = [
                    { key: 'resume_url', value: $('#s_resume').value.trim() },
                    { key: 'contact_email', value: $('#s_email').value.trim() },
                    { key: 'hero', value: { eyebrow: $('#s_eyebrow').value, title_1: $('#s_t1').value, title_2: $('#s_t2').value, copy: $('#s_copy').value } },
                    { key: 'stats', value: stats },
                ];
                for (const u of updates) {
                    const { error } = await sb.from('site_settings').upsert({ key: u.key, value: u.value, updated_at: new Date().toISOString() });
                    if (error) return toast(error.message, true);
                }
                toast('settings saved ✓');
            };
        }
    </script>
</body>

</html>
