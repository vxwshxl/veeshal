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
    <meta name="theme-color" content="#000000">
    <link rel="canonical" href="https://veeshal.me/">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://veeshal.me/">
    <meta property="og:title" content="Veeshal D. Bodosa - Crafting Code & Cinematics">
    <meta property="og:description"
        content="Welcome to a visual journey that blends code & creativity, and every edit tells a story. Engineered with precision & crafted with passion.">
    <meta property="og:image" content="https://veeshal.me/assets/vee-og.svg">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://veeshal.me/">
    <meta property="twitter:title" content="Veeshal D. Bodosa - Crafting Code & Cinematics">
    <meta property="twitter:description"
        content="Welcome to a visual journey that blends code & creativity, and every edit tells a story. Engineered with precision & crafted with passion.">
    <meta property="twitter:image" content="https://veeshal.me/assets/vee-og.svg">

    <link rel="icon" type="image/png" href="favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="favicon.svg" />
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png" />
    <link rel="manifest" href="site.webmanifest" />
    <title>Veeshal D. Bodosa - Crafting Code & Cinematics</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/introStyles.css">
    <link rel="stylesheet" href="css/portfolioStyles.css">
    <link rel="stylesheet" href="css/projectStyles.css">
    <link rel="stylesheet" href="css/aboutStyles.css">
    <link rel="stylesheet" href="css/contactStyles.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet">
    
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

<body>
    <div class="loader">
        <div class="counter">0</div>

        <div class="site-teaser">
            <span>vee</span>
        </div>

        <div class="wheel">
            <!-- Tyre (Outer circle) -->
            <div class="tyre"></div>

            <!-- Rim (Middle circle) -->
            <div class="rim"></div>

            <!-- Spokes Container -->
            <div class="spokes-container" id="spokes"></div>

            <!-- Central Logo -->
            <div class="bmw-logo">
                <div class="bmw-logo-quarter"></div>
                <div class="bmw-logo-quarter"></div>
                <div class="bmw-logo-quarter"></div>
                <div class="bmw-logo-quarter"></div>
            </div>
        </div>
    </div>

    <div id="home" class="home">
        <div class="homeContainer">
            <div class="top">
                <!-- Header/Navigation -->
                <div class="space-up"></div>
                <hr class="line">
                <header>
                    <div class="logo">
                        <a href="index.php"><img src="assets/logo.svg"></a>
                    </div>
                    <nav>
                        <ul>
                            <li><a href="#home">Home</a></li>
                            <li><a href="#intro"><span class="highlight">Intro</span></a></li>
                            <li><a href="#portfolio">Portfolio</a></li>
                            <li><a href="#project">Projects</a></li>
                            <li><a href="blogs/index.php">Blogs</a></li>
                            <li><a href="#contact">Contact</a></li>
                            <li><a href="#about">About</a></li>
                        </ul>
                    </nav>
                    <div class="logo">
                        <img src="assets/india.svg" alt="Made in India">
                    </div>
                </header>
                <hr class="line">
            </div>

            <!-- Home Content -->
            <main class="homeContent">
                <div class="content-left">
                    <h1 class="homeTxt">code & cinema</h1>
                    <p class="welcome-text">
                        Welcome to a visual journey that blends<br>
                        code & creativity, and every edit tells a story.<br>
                        Engineered with precision & crafted with passion.
                    </p>
                    <div class="social-icons">
                        <a href="https://www.youtube.com/@vxwshxl" target="_blank" class="social-icon">yt</a>
                        <a href="https://www.instagram.com/vxwshxl" target="_blank" class="social-icon">ig</a>
                        <a href="https://github.com/vxwshxl" target="_blank" class="social-icon">git</a>
                        <a href="https://www.linkedin.com/in/vxwshxl" target="_blank" class="social-icon">in</a>
                        <a href="https://x.com/vxwshxl" target="_blank" class="social-icon">x</a>
                        <a href="https://www.facebook.com/vxwshxl" target="_blank" class="social-icon">fb</a>
                        
                        <!-- Resume Button -->
                        <hr class="line">
                        <a href="RESUME - VEESHAL.pdf" target="_blank" class="resume-btn">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 16L7 11H10V4H14V11H17L12 16ZM6 18V20H18V18H6Z" fill="currentColor"/>
                            </svg>
                            RESUME
                        </a>
                        <hr class="line">
                    </div>

                    <div class="stats">
                        <div class="stat-item">
                            <h2>+5</h2>
                            <p>Developed Live<br>
                                <a href="#project" style="font-weight:bold; color: #F9B646; cursor: pointer;">
                                    Coding Projects
                                </a>
                            </p>
                        </div>
                        <div class="stat-item">
                            <h2>+15</h2>
                            <p>Edited High-Quality<br>
                                <a href="#project" style="font-weight:bold; color: #F9B646; cursor: pointer;">
                                    Video Projects
                                </a>
                            </p>
                        </div>
                        <div class="stat-item">
                            <h2>+50k</h2>
                            <p>Monthly Visitors for<br>
                                <a href="https://anglo-bodo-dictionary.com" target="_blank"
                                    style="font-weight:bold; color: #F9B646; cursor: pointer;">
                                    Anglo-Bodo Dictionary
                                </a>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="content-right">
                    <div class="feature-card">
                        <img src="assets/vee-img.svg" alt="Veeshal D. Bodosa Portrait">
                    </div>
                </div>
            </main>
        </div>
    </div>

    <div id="intro" class="intro">
        <!-- Intro Content -->
        <main class="intro">
            <div class="marquee-container-intro">
                <div class="marquee-content">
                    <div class="whiteTxt">intro. &nbsp; vee. &nbsp; intro. &nbsp; vee. &nbsp; intro. &nbsp; vee. &nbsp;
                        intro. &nbsp; vee. &nbsp; intro. &nbsp; vee. &nbsp; intro. &nbsp; vee. &nbsp;</div>
                </div>
            </div>

            <!-- Image container -->
            <div id="imageContainer" style="position: relative; display: block;">
                <img id="introImage" src="assets/hitr.jpg" style="display: block; cursor: pointer;"
                    alt="Video Thumbnail">

                <button id="playBtn" class="play-pause-btn">
                    <svg id="playIcon" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <polygon points="5,3 19,12 5,21" fill="currentColor" />
                    </svg>
                </button>
            </div>

            <!-- Video container -->
            <div id="videoContainer" style="position: relative; display: none;">
                <video id="introVideo" src="https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/HITR.mp4" loop muted playsinline preload="auto"
                    style="width: 100%; height: 100%; object-fit: cover;">
                </video>

                <!-- Play/Pause Button (moved outside videoContainer) -->
                <button id="pauseBtn" class="play-pause-btn">
                    <svg id="pauseIcon" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg" style="display: none;">
                        <rect x="6" y="4" width="4" height="16" fill="currentColor" />
                        <rect x="14" y="4" width="4" height="16" fill="currentColor" />
                    </svg>
                </button>
            </div>
        </main>
    </div>

    <div id="portfolio" class="portfolio">
        <div class="portfolio-grid">
            <div class="card"><img src="assets/portfolio/1.png" alt="Portfolio 1"></div>
            <div class="card"><img src="assets/portfolio/2.png" alt="Portfolio 2"></div>
            <div class="card"><img src="assets/portfolio/3.png" alt="Portfolio 3"></div>
            <div class="card"><img src="assets/portfolio/4.png" alt="Portfolio 4"></div>
            <div class="card"><img src="assets/portfolio/5.png" alt="Portfolio 5"></div>
            <div class="card last-card"><img src="assets/portfolio/6.png" alt="Portfolio 6"></div>
        </div>
        <h2 class="portfolio-title">portfolio</h2>
    </div>

    <div class="marquee-container">
        <div class="marquee-content">
            <div class="blackTxt">featured. &nbsp; projects. &nbsp; vee. &nbsp; featured. &nbsp; projects. &nbsp; vee. &nbsp; featured. &nbsp; projects. &nbsp; vee. &nbsp;
            featured. &nbsp; projects. &nbsp; vee. &nbsp; featured. &nbsp; projects. &nbsp; vee. &nbsp; featured. &nbsp; projects. &nbsp; vee. &nbsp;</div>
        </div>
    </div>

    <div id="project" class="project">
        <div class="preview">
            <div class="preview-img preview-img-1"></div>
            <div class="preview-img preview-img-2"></div>
        </div>
        <div class="menu">
            <div class="menu-item" data-url="https://anglo-bodo-dictionary.com"
                data-hover-src="./assets/projects/1.png">
                <div class="info">
                    <p>Tool</p>
                </div>
                <div class="name">
                    <p>Anglo-Bodo Dictionary</p>
                </div>
                <div class="tag">
                    <p>Web Development</p>
                </div>
            </div>
            <div class="menu-item" data-url="https://kgc-app.in" data-hover-src="./assets/projects/2.png">
                <div class="info">
                    <p>Education</p>
                </div>
                <div class="name">
                    <p>Kokrajhar Govt. College</p>
                </div>
                <div class="tag">
                    <p>Web & App Development</p>
                </div>
            </div>
            <div class="menu-item" data-url="https://swrzee.in" data-hover-src="./assets/projects/3.png">
                <div class="info">
                    <p>Enterprise</p>
                </div>
                <div class="name">
                    <p>Swrzee Enterprise</p>
                </div>
                <div class="tag">
                    <p>Web Development</p>
                </div>
            </div>
            <div class="menu-item" data-url="https://www.youtube.com/watch?v=gNVz83QSoY4"
                data-hover-src="./assets/projects/4.png">
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
                data-hover-src="./assets/projects/5.png">
                <div class="info">
                    <p>Travel</p>
                </div>
                <div class="name">
                    <p>Andaman & Nicobar Islands</p>
                </div>
                <div class="tag">
                    <p>Video Editing</p>
                </div>
            </div>
            <div class="menu-item" data-video="https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/GDG.mp4" data-hover-src="./assets/projects/6.png">
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
            <div class="menu-item" data-video="https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/open-mic.mp4" data-hover-src="./assets/projects/7.png">
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
            <div class="menu-item" data-image="assets/projects/8.png" data-hover-src="./assets/projects/8.png">
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
    </div>

    <div id="contact" class="contact">
        <div class="contact-container">
            <!-- Left Column: Image -->
            <div class="contact-image">
                <img src="assets/vee.svg" alt="vee">
            </div>

            <!-- Right Column: Form -->
            <div class="contact-content">
                <h1 class="contactTxt">contact</h1>
                <h3 class="gmailTxt">veebodosa@gmail.com</h3>

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

                    <button type="submit" class="submit-btn">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <div id="about" class="about">
        <h2>
            <span class="accent">vee</span> aka <span class="accent">Veeshal D. Bodosa</span>, a coder & cinematic
            storyteller.
            <br>
            I craft <span class="highlight">web experiences</span>, designing seamless <span
                class="highlight">apps</span>,
            & bringing visions to life through <span class="highlight">cinematics</span>.
            <br>
            Blending code & creativity is where I thrive.
        </h2>

        <!-- Logo Marquee -->
        <div class="logoMarquee">
            <div class="marqueeInner">
                <!-- Set 1 -->
                <div class="logo-set">
                    <!-- Frontend -->
                    <img src="assets/skills/react-native.png" alt="React Native" />
                    <img src="assets/skills/flutter.png" alt="Flutter" />
                    <img src="assets/skills/tailwind.png" alt="Tailwind CSS" />
                    <img src="assets/skills/expo.png" alt="Expo" />

                    <!-- Backend -->
                    <img src="assets/skills/php.png" alt="PHP" />
                    <img src="assets/skills/mysql.png" alt="MySQL" />
                    <img src="assets/skills/postgreSQL.png" alt="PostgreSQL" />

                    <!-- Video Editing -->
                    <img src="assets/skills/premiere.png" alt="Adobe Premiere" />
                    <img src="assets/skills/davinci.png" alt="DaVinci Resolve" />
                    <img src="assets/skills/capcut.png" alt="CapCut" />

                    <!-- Photo Editing & Design -->
                    <img src="assets/skills/figma.png" alt="Figma" />
                    <img src="assets/skills/krita.png" alt="Krita" />
                    <img src="assets/skills/canva.png" alt="Canva" />

                    <!-- Animation -->
                    <img src="assets/skills/jitter.png" alt="Jitter" />
                </div>

                <!-- Set 2 (Duplicate for loop) -->
                <div class="logo-set">
                    <!-- Frontend -->
                    <img src="assets/skills/react-native.png" alt="React Native" />
                    <img src="assets/skills/flutter.png" alt="Flutter" />
                    <img src="assets/skills/tailwind.png" alt="Tailwind CSS" />
                    <img src="assets/skills/expo.png" alt="Expo" />

                    <!-- Backend -->
                    <img src="assets/skills/php.png" alt="PHP" />
                    <img src="assets/skills/mysql.png" alt="MySQL" />
                    <img src="assets/skills/postgreSQL.png" alt="PostgreSQL" />

                    <!-- Video Editing -->
                    <img src="assets/skills/premiere.png" alt="Adobe Premiere" />
                    <img src="assets/skills/davinci.png" alt="DaVinci Resolve" />
                    <img src="assets/skills/capcut.png" alt="CapCut" />

                    <!-- Photo Editing & Design -->
                    <img src="assets/skills/figma.png" alt="Figma" />
                    <img src="assets/skills/krita.png" alt="Krita" />
                    <img src="assets/skills/canva.png" alt="Canva" />

                    <!-- Animation -->
                    <img src="assets/skills/jitter.png" alt="Jitter" />
                </div>
            </div>
        </div>

        <p class="aboutText">
            When things <span class="accent">fall</span>,
            <br>
            Don’t quit —
            <br>
            Instead <span class="highlight">redesign</span>..!
        </p>
    </div>

    <div class="footer">
        <div class="footerContainer">
            <div class="top">
                <!-- Footer/Navigation -->
                <hr class="line">
                <div class="space-up"></div>
                <footer>
                    <div class="logo">
                        <a href="index.php"><img src="assets/logo.svg"></a>
                    </div>
                    <nav>
                        <ul>
                            <li><a href="#home">Home</a></li>
                            <li><a href="#intro"><span class="highlight">Intro</span></a></li>
                            <li><a href="#portfolio">Portfolio</a></li>
                            <li><a href="#project">Projects</a></li>
                            <li><a href="blogs/index.php">Blogs</a></li>
                            <li><a href="#contact">Contact</a></li>
                            <li><a href="#about">About</a></li>
                        </ul>
                    </nav>
                </footer>
            </div>
            <h2 class="homeTxt">fall back<span class="highlight">?</span></h2>
            <h2 class="homeTxt">redesign<span class="highlight">..!</span></h2>
        </div>
    </div>
    
    <!-- Toast Notification Container -->
    <div id="toast-container"></div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/introScript.js"></script>
    <script src="js/projectScript.js"></script>
    <script src="js/contactScript.js"></script>
</body>
</html>