<?php
// Simple .env parser
$env = [];
$envPath = null;

// Check for .env in current directory (Localhost)
if (file_exists(__DIR__ . '/.env')) {
    $envPath = __DIR__ . '/.env';
}
// Check for .env in config directory (Hostinger/Production)
elseif (file_exists(__DIR__ . '/../config/.env')) {
    $envPath = __DIR__ . '/../config/.env';
}

if ($envPath) {
    $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        // Skip comments
        if (strpos(trim($line), '#') === 0) continue;

        // Parse key=value
        $parts = explode('=', $line, 2);
        if (count($parts) === 2) {
            $name = trim($parts[0]);
            $value = trim($parts[1]);
            $env[$name] = $value;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Portfolio of Veeshal D. Bodosa - A creative developer and video editor blending code and cinematics to craft immersive digital experiences.">
    <meta name="keywords"
        content="Veeshal D. Bodosa, Web Developer, Video Editor, Portfolio, React Native, Flutter, Cinematics, Creative Developer, India">
    <meta name="author" content="Veeshal D. Bodosa">
    <meta name="robots" content="index, follow">
    <meta name="theme-color" content="#111110">
    <link rel="canonical" href="https://veeshal.me/">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://veeshal.me/">
    <meta property="og:title" content="Veeshal D. Bodosa - Crafting Code & Cinematics">
    <meta property="og:description"
        content="Welcome to a visual journey that blends code & creativity, and every edit tells a story. Engineered with precision & crafted with passion.">
    <meta property="og:image" content="https://veeshal.me/assets/vee-og.webp">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://veeshal.me/">
    <meta property="twitter:title" content="Veeshal D. Bodosa - Crafting Code & Cinematics">
    <meta property="twitter:description"
        content="Welcome to a visual journey that blends code & creativity, and every edit tells a story. Engineered with precision & crafted with passion.">
    <meta property="twitter:image" content="https://veeshal.me/assets/vee-og.webp">

    <link rel="icon" type="image/png" href="favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="favicon.svg" />
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png" />
    <link rel="manifest" href="site.webmanifest" />
    <title>Veeshal D. Bodosa - Crafting Code & Cinematics</title>

    <link href="https://api.fontshare.com/v2/css?f[]=clash-display@500,600,700&f[]=general-sans@400,500,600,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,400;0,500;0,700;1,400;1,500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/v2.css">
    <noscript>
        <style>
            .page { opacity: 1 !important; }
            .loader, .cursor-dot, .cursor-ring { display: none !important; }
            body.is-loading { overflow: auto; height: auto; }
        </style>
    </noscript>

    <!-- EmailJS SDK -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
    <!-- Crypto-JS for Gravatar MD5 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>

    <script type="text/javascript">
        // Inject Variables from PHP
        const EMAIL_PUBLIC_KEY = "<?php echo isset($env['EMAILJS_PUBLIC_KEY']) ? $env['EMAILJS_PUBLIC_KEY'] : ''; ?>";
        const EMAIL_SERVICE_ID = "<?php echo isset($env['EMAILJS_SERVICE_ID']) ? $env['EMAILJS_SERVICE_ID'] : ''; ?>";
        const EMAIL_TEMPLATE_ID = "<?php echo isset($env['EMAILJS_TEMPLATE_ID']) ? $env['EMAILJS_TEMPLATE_ID'] : ''; ?>";
    </script>
</head>

<body class="is-loading">

    <!-- ===================== LOADER — pit-lane wheel burst ===================== -->
    <div class="loader" aria-hidden="true">
        <div class="loader-road"></div>
        <div class="loader-streaks" id="loaderStreaks"></div>

        <div class="loader-wheel-wrap">
            <!-- motion-blur ghost (live mirror of the wheel below) -->
            <svg class="loader-wheel loader-wheel-ghost" viewBox="0 0 400 400">
                <use href="#lwWheel"></use>
            </svg>

            <svg class="loader-wheel" viewBox="0 0 400 400">
                <defs>
                    <radialGradient id="lwRimGrad" cx="35%" cy="32%" r="80%">
                        <stop offset="0%" stop-color="#45454b" />
                        <stop offset="55%" stop-color="#26262a" />
                        <stop offset="100%" stop-color="#121214" />
                    </radialGradient>
                    <linearGradient id="lwSpokeGrad" x1="0" y1="0" x2="0" y2="1">
                        <stop offset="0%" stop-color="#4e4e54" />
                        <stop offset="100%" stop-color="#1b1b1e" />
                    </linearGradient>
                    <radialGradient id="lwDiscGrad" cx="50%" cy="50%" r="50%">
                        <stop offset="50%" stop-color="#2c2c2f" />
                        <stop offset="82%" stop-color="#404045" />
                        <stop offset="100%" stop-color="#232326" />
                    </radialGradient>
                    <!-- one twin-blade spoke, stamped 5x -->
                    <g id="lwSpoke">
                        <path d="M191 178 L177 78 Q186 70 195 73 L198 178 Z" fill="url(#lwSpokeGrad)" />
                        <path d="M209 178 L223 78 Q214 70 205 73 L202 178 Z" fill="url(#lwSpokeGrad)" />
                    </g>
                </defs>

                <g id="lwWheel">
                    <!-- static layer: brake disc + amber caliper, seen through the spokes -->
                    <circle cx="200" cy="200" r="118" fill="url(#lwDiscGrad)" />
                    <circle cx="200" cy="200" r="106" fill="none" stroke="#1c1c1f" stroke-width="3"
                        stroke-dasharray="2 11" />
                    <circle cx="200" cy="200" r="86" fill="none" stroke="#1c1c1f" stroke-width="3"
                        stroke-dasharray="2 9" />
                    <path d="M319.6 144.2 A132 132 0 0 1 319.6 255.8 L290.6 242.3 A100 100 0 0 0 290.6 157.7 Z"
                        fill="#F9B646" />

                    <!-- rotor: tire + rim + spokes (this part spins) -->
                    <g id="lwRotor">
                        <!-- tire -->
                        <circle cx="200" cy="200" r="174" fill="none" stroke="#141414" stroke-width="46" />
                        <circle cx="200" cy="200" r="192" fill="none" stroke="#060606" stroke-width="8"
                            stroke-dasharray="15 11" />
                        <circle cx="200" cy="200" r="160" fill="none" stroke="#0b0b0b" stroke-width="12" />
                        <!-- race-tire paint marker -->
                        <circle cx="200" cy="42" r="5" fill="#F9B646" />

                        <!-- rim -->
                        <circle cx="200" cy="200" r="152" fill="none" stroke="#4d4d53" stroke-width="2.5" />
                        <circle cx="200" cy="200" r="141" fill="none" stroke="url(#lwRimGrad)" stroke-width="21" />

                        <!-- 5 twin spokes -->
                        <use href="#lwSpoke" />
                        <use href="#lwSpoke" transform="rotate(72 200 200)" />
                        <use href="#lwSpoke" transform="rotate(144 200 200)" />
                        <use href="#lwSpoke" transform="rotate(216 200 200)" />
                        <use href="#lwSpoke" transform="rotate(288 200 200)" />

                        <!-- hub, lug nuts, centre cap -->
                        <circle cx="200" cy="200" r="58" fill="#19191b" stroke="#2c2c30" stroke-width="2" />
                        <circle cx="200" cy="166" r="6" fill="#8e8e96" />
                        <circle cx="232.3" cy="189.5" r="6" fill="#8e8e96" />
                        <circle cx="220" cy="227.5" r="6" fill="#8e8e96" />
                        <circle cx="180" cy="227.5" r="6" fill="#8e8e96" />
                        <circle cx="167.7" cy="189.5" r="6" fill="#8e8e96" />
                        <circle cx="200" cy="200" r="29" fill="#111110" stroke="#F9B646" stroke-width="2" />
                        <text x="200" y="212" text-anchor="middle" font-family="'Clash Display', sans-serif"
                            font-size="34" font-weight="700" fill="#F9B646">V</text>
                    </g>
                </g>
            </svg>
        </div>

        <div class="loader-meta">
            <span class="loader-brand">vee<span class="amber">.</span></span>
            <span class="loader-tag">code &amp; cinema — '26</span>
        </div>

        <div class="loader-line"><i></i></div>

        <div class="loader-speedo">
            <span class="loader-counter" id="loaderCounter">000</span>
            <span class="loader-unit">ignition / km·h</span>
        </div>
    </div>

    <!-- film grain + custom cursor -->
    <div class="grain" aria-hidden="true"></div>
    <div class="cursor-dot" aria-hidden="true"></div>
    <div class="cursor-ring" aria-hidden="true"></div>

    <!-- scroll progress wheel -->
    <button class="scroll-wheel" aria-label="Back to top">
        <svg viewBox="0 0 100 100">
            <circle cx="50" cy="50" r="44" fill="rgba(17,17,16,0.85)" />
            <g class="sw-rotor">
                <circle cx="50" cy="50" r="36" fill="none" stroke="#3a3a3e" stroke-width="5" />
                <line x1="50" y1="50" x2="50" y2="16" stroke="#5a5a60" stroke-width="4" />
                <line x1="50" y1="50" x2="82.3" y2="60.5" stroke="#5a5a60" stroke-width="4" />
                <line x1="50" y1="50" x2="30" y2="77.5" stroke="#5a5a60" stroke-width="4" />
                <line x1="50" y1="50" x2="17.7" y2="39.5" stroke="#5a5a60" stroke-width="4" />
                <line x1="50" y1="50" x2="70" y2="22.5" stroke="#5a5a60" stroke-width="4" />
                <circle cx="50" cy="50" r="9" fill="#F9B646" />
            </g>
            <circle class="sw-progress" cx="50" cy="50" r="44" />
        </svg>
    </button>

    <div class="page">

        <!-- ===================== HERO ===================== -->
        <section id="home" class="hero" data-nav-section>
            <header class="site-header">
                <a class="brand" href="index"><img src="assets/logo.svg" alt="vee logo"></a>
                <nav>
                    <ul>
                        <li><a href="#home">Home</a></li>
                        <li><a href="#intro">Intro</a></li>
                        <li><a href="projects">Projects</a></li>
                        <li><a href="timeline">Timeline</a></li>
                        <li><a href="chaicode">ChaiCode</a></li>
                        <li><a href="blogs">Blogs</a></li>
                        <li><a href="#contact">Contact</a></li>
                        <li><a href="#about">About</a></li>
                    </ul>
                </nav>
                <div class="header-flag"><img src="assets/india.svg" alt="Made in India"></div>
            </header>

            <div class="hero-ghost" aria-hidden="true">veeshal — veeshal</div>

            <div class="hero-inner">
                <div class="hero-left">
                    <p class="hero-eyebrow mono">creative developer — video editor</p>

                    <h1 class="hero-title">
                        <span class="line"><span class="word">code</span></span>
                        <span class="line"><span class="word amp">&amp;</span>&nbsp;<span class="word">cinema</span></span>
                    </h1>

                    <svg class="hero-swoosh" viewBox="0 0 420 40" aria-hidden="true">
                        <path d="M6 30 C 110 6, 240 6, 300 22 S 400 30, 414 14" />
                    </svg>

                    <p class="hero-copy">
                        Welcome to a visual journey that blends <strong>code &amp; creativity</strong>,
                        where every edit tells a story. Engineered with precision &amp;
                        crafted with passion.
                    </p>

                    <div class="social-row">
                        <a href="https://www.youtube.com/@vxwshxl" target="_blank" class="social-icon">yt</a>
                        <a href="https://www.instagram.com/vxwshxl" target="_blank" class="social-icon">ig</a>
                        <a href="https://github.com/vxwshxl" target="_blank" class="social-icon">git</a>
                        <a href="https://www.linkedin.com/in/vxwshxl" target="_blank" class="social-icon">in</a>
                        <a href="https://x.com/vxwshxl" target="_blank" class="social-icon">x</a>
                        <a href="https://www.facebook.com/vxwshxl" target="_blank" class="social-icon">fb</a>
                        <a href="RESUME - VEESHAL.pdf" target="_blank" class="resume-btn">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 16L7 11H10V4H14V11H17L12 16ZM6 18V20H18V18H6Z" fill="currentColor" />
                            </svg>
                            resume
                        </a>
                    </div>

                    <div class="stats">
                        <div class="stat-item">
                            <h2><span class="plus">+</span><span class="count" data-target="5">5</span></h2>
                            <p>Developed Live<br><a href="projects">Coding Projects</a></p>
                        </div>
                        <div class="stat-item">
                            <h2><span class="plus">+</span><span class="count" data-target="15">15</span></h2>
                            <p>Edited High-Quality<br><a href="projects">Video Projects</a></p>
                        </div>
                        <div class="stat-item">
                            <h2><span class="plus">+</span><span class="count" data-target="50">50</span>k</h2>
                            <p>Monthly Visitors for<br><a href="https://bodookhrang.com" target="_blank">Bodo Okhrang</a></p>
                        </div>
                    </div>
                </div>

                <div class="hero-right">
                    <div class="portrait-card">
                        <img src="assets/vee-img.webp" alt="Veeshal D. Bodosa Portrait">
                        <span class="portrait-badge">vee<span class="amber">.</span> — based in india</span>
                    </div>
                </div>
            </div>

            <div class="scroll-cue mono">
                scroll
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10" />
                    <line x1="12" y1="12" x2="12" y2="3" />
                    <line x1="12" y1="12" x2="19" y2="16" />
                    <line x1="12" y1="12" x2="5" y2="16" />
                </svg>
            </div>
        </section>

        <!-- ===================== SHOWREEL (dark cinema) ===================== -->
        <section id="intro" class="reel" data-nav-section>
            <div class="section-head on-dark">
                <div>
                    <p class="section-kicker"><span class="idx">01</span> showreel</p>
                    <h2 class="section-title">
                        <span class="word">every</span> <span class="word">edit</span>
                        <span class="word amber">tells</span> <span class="word">a</span>
                        <span class="word">story<span class="amber">.</span></span>
                    </h2>
                </div>
                <p class="section-note">hit play — sound on for the full ride.</p>
            </div>

            <div class="reel-frame">
                <!-- Image container -->
                <div id="imageContainer" style="position: relative; display: block;">
                    <img id="introImage" src="assets/hitr.jpg" style="display: block; cursor: pointer;"
                        alt="Video Thumbnail">

                    <button id="playBtn" class="play-pause-btn" aria-label="Play showreel">
                        <svg id="playIcon" width="26" height="26" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <polygon points="5,3 19,12 5,21" fill="currentColor" />
                        </svg>
                    </button>
                </div>

                <!-- Video container -->
                <div id="videoContainer" style="position: relative; display: none;">
                    <video id="introVideo" src="https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/HITR.mp4" loop muted
                        playsinline preload="auto" style="width: 100%; height: 100%; object-fit: cover;">
                    </video>

                    <button id="pauseBtn" class="play-pause-btn" aria-label="Pause showreel">
                        <svg id="pauseIcon" width="26" height="26" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg" style="display: none;">
                            <rect x="6" y="4" width="4" height="16" fill="currentColor" />
                            <rect x="14" y="4" width="4" height="16" fill="currentColor" />
                        </svg>
                    </button>
                </div>

                <div class="reel-bar">
                    <span class="rec">rec</span>
                    <span>hitr — showreel '26</span>
                    <span>16:9 / 4k</span>
                </div>
            </div>
        </section>

        <!-- ===================== PORTFOLIO GRID ===================== -->
        <section id="portfolio">
            <div class="section-head">
                <div>
                    <p class="section-kicker"><span class="idx">02</span> stills &amp; frames</p>
                    <h2 class="section-title">
                        <span class="word">the</span> <span class="word amber">gallery</span>
                    </h2>
                </div>
                <p class="section-note">a wall of frames — shot, cut &amp; graded by me.</p>
            </div>

            <div class="portfolio">
                <div class="portfolio-grid">
                    <div class="card"><img src="assets/portfolio/1.webp" alt="Portfolio 1"></div>
                    <div class="card"><img src="assets/portfolio/2.webp" alt="Portfolio 2"></div>
                    <div class="card"><img src="assets/portfolio/3.webp" alt="Portfolio 3"></div>
                    <div class="card"><img src="assets/portfolio/4.webp" alt="Portfolio 4"></div>
                    <div class="card"><img src="assets/portfolio/5.webp" alt="Portfolio 5"></div>
                    <div class="card last-card"><img src="assets/portfolio/6.webp" alt="Portfolio 6"></div>
                </div>
                <h2 class="portfolio-title">portfolio</h2>
            </div>
        </section>

        <!-- marquee band -->
        <div class="band band-dark" aria-hidden="true">
            <div class="band-track">
                <span class="band-chunk">
                    featured <span class="dot"></span> <span class="o">projects</span> <span class="dot"></span>
                    selected <span class="dot"></span> <span class="o">work</span> <span class="dot"></span>
                    featured <span class="dot"></span> <span class="o">projects</span> <span class="dot"></span>
                    selected <span class="dot"></span> <span class="o">work</span> <span class="dot"></span>
                </span>
                <span class="band-chunk">
                    featured <span class="dot"></span> <span class="o">projects</span> <span class="dot"></span>
                    selected <span class="dot"></span> <span class="o">work</span> <span class="dot"></span>
                    featured <span class="dot"></span> <span class="o">projects</span> <span class="dot"></span>
                    selected <span class="dot"></span> <span class="o">work</span> <span class="dot"></span>
                </span>
            </div>
        </div>

        <!-- ===================== FEATURED PROJECTS ===================== -->
        <section id="project" class="project" data-nav-section>
            <div class="section-head">
                <div>
                    <p class="section-kicker"><span class="idx">03</span> selected work</p>
                    <h2 class="section-title">
                        <span class="word">featured</span> <span class="word amber">projects</span>
                    </h2>
                </div>
                <p class="section-note">hover a row for a live preview — click to open.</p>
            </div>

            <div class="preview">
                <div class="preview-img preview-img-1"></div>
                <div class="preview-img preview-img-2"></div>
            </div>
            <div class="menu">
                <div class="menu-item" data-url="https://bodookhrang.com" data-hover-src="./assets/projects/1.webp">
                    <div class="info">
                        <p>A.I. Tool</p>
                    </div>
                    <div class="name">
                        <p>Bodo Okhrang</p>
                    </div>
                    <div class="tag">
                        <p>Web Development</p>
                    </div>
                </div>
                <div class="menu-item" data-url="https://flopshop.vercel.app" data-hover-src="./assets/projects/12.webp">
                    <div class="info">
                        <p>E-COMMERCE Tool</p>
                    </div>
                    <div class="name">
                        <p>FlopShop</p>
                    </div>
                    <div class="tag">
                        <p>Web Development/PWA</p>
                    </div>
                </div>
                <div class="menu-item" data-url="https://crewspace-ai.vercel.app" data-hover-src="./assets/projects/11.webp">
                    <div class="info">
                        <p>A.I. Tool</p>
                    </div>
                    <div class="name">
                        <p>CrewSpace AI</p>
                    </div>
                    <div class="tag">
                        <p>Extension</p>
                    </div>
                </div>
                <div class="menu-item" data-url="https://ku-app.in" data-hover-src="./assets/projects/2.webp">
                    <div class="info">
                        <p>Education</p>
                    </div>
                    <div class="name">
                        <p>Kokrajhar University</p>
                    </div>
                    <div class="tag">
                        <p>Web &amp; App Development</p>
                    </div>
                </div>
                <div class="menu-item" data-url="https://www.youtube.com/watch?v=gNVz83QSoY4"
                    data-hover-src="./assets/projects/4.webp">
                    <div class="info">
                        <p>Travel</p>
                    </div>
                    <div class="name">
                        <p>Trip to Darjeeling</p>
                    </div>
                    <div class="tag">
                        <p>Video Editing</p>
                    </div>
                </div>
                <div class="menu-item" data-url="https://www.youtube.com/watch?v=gBvocwLObFQ"
                    data-hover-src="./assets/projects/5.webp">
                    <div class="info">
                        <p>Travel</p>
                    </div>
                    <div class="name">
                        <p>Andaman &amp; Nicobar Islands</p>
                    </div>
                    <div class="tag">
                        <p>Video Editing</p>
                    </div>
                </div>
                <div class="menu-item" data-video="https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/GDG.mp4"
                    data-hover-src="./assets/projects/6.webp">
                    <div class="info">
                        <p>Event</p>
                    </div>
                    <div class="name">
                        <p>GOOGLE DEV GROUP - 2025</p>
                    </div>
                    <div class="tag">
                        <p>Video Editing</p>
                    </div>
                </div>
                <div class="menu-item" data-video="https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/open-mic.mp4"
                    data-hover-src="./assets/projects/7.webp">
                    <div class="info">
                        <p>Event</p>
                    </div>
                    <div class="name">
                        <p>Open Mic RGU - 2025</p>
                    </div>
                    <div class="tag">
                        <p>Video Editing</p>
                    </div>
                </div>
                <div class="menu-item" data-image="assets/projects/8.webp" data-hover-src="./assets/projects/8.webp">
                    <div class="info">
                        <p>Event</p>
                    </div>
                    <div class="name">
                        <p>Badminton Tournament</p>
                    </div>
                    <div class="tag">
                        <p>Banner Editing</p>
                    </div>
                </div>
                <div class="menu-item" data-image="assets/projects/9.webp" data-hover-src="./assets/projects/9.webp">
                    <div class="info">
                        <p>Tool</p>
                    </div>
                    <div class="name">
                        <p>BODOअख्रां Pvt. Ltd. Logo</p>
                    </div>
                    <div class="tag">
                        <p>Logo Design</p>
                    </div>
                </div>
                <div class="menu-item" data-image="assets/projects/10.webp" data-hover-src="./assets/projects/10.webp">
                    <div class="info">
                        <p>Local Shop</p>
                    </div>
                    <div class="name">
                        <p>My Tea</p>
                    </div>
                    <div class="tag">
                        <p>Banner Editing</p>
                    </div>
                </div>

                <!-- Popup Modal (supports both video and image) -->
                <div id="mediaModal" class="media-modal">
                    <div class="media-content">
                        <span id="closeMedia" class="close-btn">&times;</span>

                        <!-- Video element -->
                        <video id="popupVideo" controls>
                            <source src="" type="video/mp4">
                            Your browser does not support HTML5 video.
                        </video>

                        <!-- Image element -->
                        <img id="popupImage" src="" alt="Popup Image">
                    </div>
                </div>
            </div>

            <div class="project-cta">
                <a href="projects" class="btn-pill">view all projects, in detail <span class="arr">→</span></a>
            </div>
        </section>

        <!-- marquee band -->
        <div class="band band-light" aria-hidden="true">
            <div class="band-track">
                <span class="band-chunk">
                    let's talk <span class="dot"></span> <span class="o">got a project?</span> <span class="dot"></span>
                    let's talk <span class="dot"></span> <span class="o">got a project?</span> <span class="dot"></span>
                    let's talk <span class="dot"></span> <span class="o">got a project?</span> <span class="dot"></span>
                </span>
                <span class="band-chunk">
                    let's talk <span class="dot"></span> <span class="o">got a project?</span> <span class="dot"></span>
                    let's talk <span class="dot"></span> <span class="o">got a project?</span> <span class="dot"></span>
                    let's talk <span class="dot"></span> <span class="o">got a project?</span> <span class="dot"></span>
                </span>
            </div>
        </div>

        <!-- ===================== CONTACT (dark) ===================== -->
        <section id="contact" class="contact" data-nav-section>
            <div class="section-head on-dark">
                <div>
                    <p class="section-kicker"><span class="idx">04</span> contact</p>
                    <h2 class="section-title">
                        <span class="word">let's</span> <span class="word">build</span>
                        <span class="word amber">something<span class="coral">.</span></span>
                    </h2>
                </div>
                <p class="section-note">avg. reply time: faster than my renders.</p>
            </div>

            <div class="contact-container">
                <!-- Left Column: Image -->
                <div class="contact-image">
                    <img src="assets/vee.webp" alt="vee">
                </div>

                <!-- Right Column: Form -->
                <div class="contact-content">
                    <h3 class="gmailTxt">drop a line — <a href="mailto:veebodosa@gmail.com">veebodosa@gmail.com</a></h3>

                    <form id="contactForm">
                        <div class="form-row">
                            <div class="form-group">
                                <input type="text" id="name" placeholder=" " required>
                                <label for="name">Name</label>
                            </div>
                            <div class="form-group">
                                <input type="email" id="email" placeholder=" " required>
                                <label for="email">Email Address</label>
                            </div>
                        </div>

                        <div class="selection-group">
                            <label>Category</label>
                            <div class="pills">
                                <button type="button" class="pill-btn active">Project Development</button>
                                <button type="button" class="pill-btn">Visual / Video Editing</button>
                                <button type="button" class="pill-btn">Redesign</button>
                                <button type="button" class="pill-btn">Hire Me</button>
                                <button type="button" class="pill-btn">Others</button>
                            </div>
                        </div>

                        <div class="form-group message-group">
                            <textarea id="message" placeholder=" " required></textarea>
                            <label for="message">Your message</label>
                        </div>

                        <button type="submit" class="submit-btn">send it →</button>
                    </form>
                </div>
            </div>
        </section>

        <!-- ===================== ABOUT ===================== -->
        <section id="about" class="about" data-nav-section>
            <p class="section-kicker"><span class="idx">05</span> about</p>

            <h2 class="about-statement">
                <span class="w accent">vee</span> <span class="w">aka</span>
                <span class="w accent">Veeshal</span> <span class="w accent">D.</span> <span class="w accent">Bodosa,</span>
                <span class="w">a</span> <span class="w">coder</span> <span class="w">&amp;</span>
                <span class="w">cinematic</span> <span class="w">storyteller.</span>
                <span class="w">I</span> <span class="w">craft</span>
                <span class="w highlight">web</span> <span class="w highlight">experiences,</span>
                <span class="w">design</span> <span class="w">seamless</span> <span class="w highlight">apps,</span>
                <span class="w">&amp;</span> <span class="w">bring</span> <span class="w">visions</span>
                <span class="w">to</span> <span class="w">life</span> <span class="w">through</span>
                <span class="w highlight">cinematics.</span>
                <span class="w">Blending</span> <span class="w">code</span> <span class="w">&amp;</span>
                <span class="w">creativity</span> <span class="w">is</span> <span class="w">where</span>
                <span class="w">I</span> <span class="w">thrive.</span>
            </h2>

            <!-- Logo Marquee -->
            <div class="logoMarquee">
                <div class="marqueeInner">
                    <!-- Set 1 -->
                    <div class="logo-set">
                        <img src="assets/skills/react-native.png" alt="React Native" />
                        <img src="assets/skills/flutter.png" alt="Flutter" />
                        <img src="assets/skills/tailwind.png" alt="Tailwind CSS" />
                        <img src="assets/skills/expo.png" alt="Expo" />
                        <img src="assets/skills/php.png" alt="PHP" />
                        <img src="assets/skills/mysql.png" alt="MySQL" />
                        <img src="assets/skills/postgreSQL.png" alt="PostgreSQL" />
                        <img src="assets/skills/premiere.png" alt="Adobe Premiere" />
                        <img src="assets/skills/davinci.png" alt="DaVinci Resolve" />
                        <img src="assets/skills/capcut.png" alt="CapCut" />
                        <img src="assets/skills/figma.png" alt="Figma" />
                        <img src="assets/skills/krita.png" alt="Krita" />
                        <img src="assets/skills/canva.png" alt="Canva" />
                        <img src="assets/skills/jitter.png" alt="Jitter" />
                    </div>

                    <!-- Set 2 (Duplicate for loop) -->
                    <div class="logo-set">
                        <img src="assets/skills/react-native.png" alt="React Native" />
                        <img src="assets/skills/flutter.png" alt="Flutter" />
                        <img src="assets/skills/tailwind.png" alt="Tailwind CSS" />
                        <img src="assets/skills/expo.png" alt="Expo" />
                        <img src="assets/skills/php.png" alt="PHP" />
                        <img src="assets/skills/mysql.png" alt="MySQL" />
                        <img src="assets/skills/postgreSQL.png" alt="PostgreSQL" />
                        <img src="assets/skills/premiere.png" alt="Adobe Premiere" />
                        <img src="assets/skills/davinci.png" alt="DaVinci Resolve" />
                        <img src="assets/skills/capcut.png" alt="CapCut" />
                        <img src="assets/skills/figma.png" alt="Figma" />
                        <img src="assets/skills/krita.png" alt="Krita" />
                        <img src="assets/skills/canva.png" alt="Canva" />
                        <img src="assets/skills/jitter.png" alt="Jitter" />
                    </div>
                </div>
            </div>

            <p class="about-quote">
                When things <span class="accent">fall</span>,<br>
                Don't quit —<br>
                Instead <span class="highlight">redesign</span>..!
            </p>
        </section>

        <!-- ===================== FOOTER ===================== -->
        <footer class="site-footer">
            <div class="footer-top">
                <a class="brand" href="index"><img src="assets/vee-logo-white.svg" alt="vee logo"
                        onerror="this.src='assets/logo.svg'"></a>
                <nav>
                    <ul>
                        <li><a href="#home">Home</a></li>
                        <li><a href="#intro">Intro</a></li>
                        <li><a href="projects">Projects</a></li>
                        <li><a href="timeline">Timeline</a></li>
                        <li><a href="chaicode">ChaiCode</a></li>
                        <li><a href="blogs">Blogs</a></li>
                        <li><a href="#contact">Contact</a></li>
                        <li><a href="#about">About</a></li>
                    </ul>
                </nav>
            </div>

            <div class="footer-giant">
                <span class="row"><span class="ghost">fall back<span class="amber">?</span></span></span>
                <span class="row"><span>redesign<span class="amber">..!</span></span></span>
            </div>

            <div class="footer-bottom">
                <span>© 2026 veeshal d. bodosa</span>
                <span>engineered with precision — crafted with passion</span>
                <span><a href="mailto:veebodosa@gmail.com">veebodosa@gmail.com</a></span>
            </div>
        </footer>

    </div><!-- /.page -->

    <!-- Toast Notification Container -->
    <div id="toast-container"></div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
    <script src="js/v2.js"></script>
    <script src="js/introScript.js"></script>
    <script src="js/projectScript.js"></script>
    <script src="js/contactScript.js"></script>
</body>

</html>
