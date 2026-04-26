<?php
// Simple .env parser
$env = [];
$envPath = null;

// Check for .env in parent directory (Localhost relative to hackathons/)
if (file_exists(__DIR__ . '/../.env')) {
    $envPath = __DIR__ . '/../.env';
} 
// Check for .env in config directory (Hostinger/Production relative to hackathons/)
elseif (file_exists(__DIR__ . '/../../config/.env')) {
    $envPath = __DIR__ . '/../../config/.env';
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
    <?php include 'includes/head_resources.php'; ?>
    <link rel="stylesheet" href="../css/hackathonsStyles.css">
    
    <title>Hackathons - Veeshal D. Bodosa</title>
    <meta name="description" content="Hackathons - Veeshal D. Bodosa - A creative developer and video editor blending code and cinematics to craft immersive digital experiences.">
    <meta name="keywords" content="Veeshal D. Bodosa, Web Developer, Video Editor, Portfolio, React Native, Flutter, Cinematics, Creative Developer, India, Hackathons">
    <meta name="author" content="Veeshal D. Bodosa">
    <link rel="canonical" href="https://veeshal.me/hackathons/">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://veeshal.me/hackathons/">
    <meta property="og:title" content="Hackathons - Veeshal D. Bodosa">
    <meta property="og:description" content="Welcome to a visual journey that blends code & creativity, and every edit tells a story. Engineered with precision & crafted with passion.">
    <meta property="og:image" content="https://veeshal.me/assets/vee-og.svg">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://veeshal.me/hackathons/">
    <meta property="twitter:title" content="Hackathons - Veeshal D. Bodosa">
    <meta property="twitter:description" content="Welcome to a visual journey that blends code & creativity, and every edit tells a story. Engineered with precision & crafted with passion.">
    <meta property="twitter:image" content="https://veeshal.me/assets/vee-og.svg">
    
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
    <!-- Loader Removed -->

    <div id="home" class="home">
        <div class="homeContainer">
            <?php include 'includes/header.php'; ?>

            <!-- Hackathons Layout -->
            <div class="hackathons-container">
                <div class="hackathons-title">
                    <span class="highlight-bg">The Ship Log</span>
                    <h1>Mission<br>Progress.</h1>
                </div>

                <div class="timeline">
                    <!-- Item 1 (Left) -->
                    <div class="timeline-item left">
                        <div class="timeline-content">
                            <div class="tag-row">
                                <span class="tag">Topper</span>
                                <span class="date">2025</span>
                            </div>
                            <h2>Even Semester Topper 2025</h2>
                            <p>Academic Performance In Even Semester-End Examination 2024-2025.</p>
                        </div>
                        <div class="timeline-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 15V3m0 12l-4-4m4 4l4-4M2 17l.621 2.485A2 2 0 0 0 4.561 21h14.878a2 2 0 0 0 1.94-1.515L22 17"></path></svg>
                        </div>
                        <div class="timeline-image">
                            <img src="../assets/hitr.jpg" alt="Certificate 1" class="zoom-img">
                        </div>
                    </div>

                    <!-- Item 2 (Right) -->
                    <div class="timeline-item right">
                        <div class="timeline-content">
                            <div class="tag-row">
                                <span class="tag">Winner</span>
                                <span class="date">2026</span>
                            </div>
                            <h2>AI & Innovation at NEGC 2026, USTM</h2>
                            <p>AI & Innovation... Awarded competition conducted during North East Graduate Congress-2026 held at University of Science & Technology Meghalaya from 26th-28th March, 2026.</p>
                        </div>
                        <div class="timeline-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>
                        </div>
                        <div class="timeline-image">
                            <img src="../assets/portfolio/1.webp" alt="Certificate 2" class="zoom-img">
                        </div>
                    </div>

                    <!-- Item 3 (Left) -->
                    <div class="timeline-item left">
                        <div class="timeline-content">
                            <div class="tag-row">
                                <span class="tag">Winner</span>
                                <span class="date">2026</span>
                            </div>
                            <h2>Prajukti 2026 GCU Hackathon</h2>
                            <p>Prajukti 2026 GCU Hackathon held during GCU Varsity Week: EUPHUISM 2026 (Roots and Resilience) from 11th to 14th March, 2026.</p>
                        </div>
                        <div class="timeline-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>
                        </div>
                        <div class="timeline-image">
                            <img src="../assets/portfolio/2.webp" alt="Certificate 3" class="zoom-img">
                        </div>
                    </div>

                    <!-- Item 4 (Right) -->
                    <div class="timeline-item right">
                        <div class="timeline-content">
                            <div class="tag-row">
                                <span class="tag">First Runner Up</span>
                                <span class="date">Feb 2026</span>
                            </div>
                            <h2>Codestellation, under Codewar 7.0 at AEC</h2>
                            <p>This Hackathon was held by Assam Engineering College (AEC) under CodeWar 7.0 part of Pyrokinesis 2026 organised by Coding Club, AEC named as Codestellation on 26 Feb 2026.</p>
                        </div>
                        <div class="timeline-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>
                        </div>
                        <div class="timeline-image">
                            <img src="../assets/portfolio/3.webp" alt="Certificate 4" class="zoom-img">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Fullscreen Image Modal -->
            <div id="hackathonModal" class="hackathon-modal">
                <div class="hackathon-modal-content">
                    <span class="close-modal">&times;</span>
                    <img id="hackathonPopupImg" src="" alt="Fullscreen Certificate">
                </div>
            </div>
        </div>
        
        <!-- Footer in Main Container -->
        <?php include 'includes/footer.php'; ?>
    </div>

    <!-- Toast Notification Container -->
    <?php include 'includes/footer_resources.php'; ?>
    <script src="../js/hackathonsScript.js"></script>
</body>
</html>
