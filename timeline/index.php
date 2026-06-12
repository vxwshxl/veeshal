<?php
// Simple .env parser
$env = [];
$envPath = null;

// Check for .env in parent directory (Localhost relative to timeline/)
if (file_exists(__DIR__ . '/../.env')) {
    $envPath = __DIR__ . '/../.env';
} 
// Check for .env in config directory (Hostinger/Production relative to timeline/)
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

// ---------- Supabase content (static fallback below) ----------
require_once __DIR__ . '/../lib/supabase.php';
$timeline_items = sb_fetch('timeline_events', 'select=*&visible=eq.true&order=sort');
if (!$timeline_items) {
    $timeline_items = [
        ['title' => 'AI & Innovation at NEGC 2026, USTM', 'description' => 'AI & Innovation... Awarded competition conducted during North East Graduate Congress-2026 held at University of Science & Technology Meghalaya from 26th–28th March, 2026.', 'tag' => 'Winner', 'date_label' => '26-28 Mar 2026', 'images' => ['https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/achievement/AI%20%26%20Inno%202026%20-%201st.webp', 'https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/achievement/AI%20%26%20Inno%20-%201.webp', 'https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/achievement/AI%20%26%20Inno%20-%202.webp']],
        ['title' => 'Prajukti 2026 GCU Hackathon', 'description' => 'Prajukti 2026 GCU Hackathon held during GCU Varsity Week: EUPHUISM 2026 (Roots and Resilience) from 11th to 14th March, 2026.', 'tag' => 'Winner', 'date_label' => '11-14 Mar 2026', 'images' => ['https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/achievement/Prajukti%202026%20-%201st.webp', 'https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/achievement/Prajukti%20-%201.webp', 'https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/achievement/Prajukti%20-%202.webp']],
        ['title' => 'Codestellation, under CodeWar 7.0 at AEC', 'description' => 'This Hackathon was held by Assam Engineering College (AEC) under CodeWar 7.0 part of Pyrokinesis 2026 organised by Coding Club, AEC named as Codestellation on 26 Feb 2026.', 'tag' => 'First Runner Up', 'date_label' => '26 Feb 2026', 'images' => ['https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/achievement/CodeWar%202026%20-%202nd.webp', 'https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/achievement/CodeWar%20-%201.webp', 'https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/achievement/CodeWar%20-%202.webp']],
        ['title' => 'Ideathon — Where Ideas Compile', 'description' => 'First place at the Ideathon competition — a stage where raw ideas meet real execution. Pitched a solution that stood out from the crowd and brought home the win. The beginning of the grind.', 'tag' => 'Winner', 'date_label' => '27 NOV 2024', 'images' => ['https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/achievement/Idea%20Comp%202024%20-%201st.webp']],
    ];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'includes/head_resources.php'; ?>
    <link rel="stylesheet" href="../css/timelineStyles.css">
    
    <title>Timeline - Veeshal D. Bodosa</title>
    <meta name="description" content="Timeline - Veeshal D. Bodosa - A creative developer and video editor blending code and cinematics to craft immersive digital experiences.">
    <meta name="keywords" content="Veeshal D. Bodosa, Web Developer, Video Editor, Portfolio, React Native, Flutter, Cinematics, Creative Developer, India, Timeline">
    <meta name="author" content="Veeshal D. Bodosa">
    <link rel="canonical" href="https://veeshal.me/timeline/">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://veeshal.me/timeline/">
    <meta property="og:title" content="Timeline - Veeshal D. Bodosa">
    <meta property="og:description" content="Welcome to a visual journey that blends code &amp; creativity, and every edit tells a story. Engineered with precision &amp; crafted with passion.">
    <meta property="og:image" content="https://veeshal.me/assets/vee-og.svg">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://veeshal.me/timeline/">
    <meta property="twitter:title" content="Timeline - Veeshal D. Bodosa">
    <meta property="twitter:description" content="Welcome to a visual journey that blends code &amp; creativity, and every edit tells a story. Engineered with precision &amp; crafted with passion.">
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

    <div id="home" class="home">
        <div class="homeContainer">
            <?php include 'includes/header.php'; ?>

            <!-- Timeline Layout -->
            <div class="timeline-container">
                <div class="timeline-title">
                    <!-- Creative coding label: console.log(currentLife) -->
                    <div class="code-label">
                        <span class="code-fn">console</span><span class="code-dot">.</span><span class="code-method">log</span><span class="code-paren">(</span><span class="code-var">currentLife</span><span class="code-paren">)</span>
                    </div>
                    <h1>Glory<br>Logged.</h1>
                </div>

                <!-- Snake-path SVG progress line -->
                <div class="timeline-progress-wrapper" id="timelineProgressWrapper">
                    <svg id="snakeSvg" class="snake-svg" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                        <!-- Grey base path -->
                        <path id="snakePathBase" class="snake-path-base" fill="none" stroke="#d1d1d1" stroke-width="4"/>
                        <!-- Yellow fill path (scroll-driven) -->
                        <path id="snakePathFill" class="snake-path-fill" fill="none" stroke="#F9B646" stroke-width="4" stroke-linecap="round"/>
                    </svg>
                </div>

                <div class="timeline" id="timelineItems">

                    <?php foreach ($timeline_items as $ti => $ev):
                        $side = $ti % 2 === 0 ? 'left' : 'right';
                        $imgs = is_array($ev['images']) ? $ev['images'] : json_decode($ev['images'], true);
                        if (!is_array($imgs)) $imgs = [];
                    ?>
                    <div class="timeline-item <?php echo $side; ?>" data-images='<?php echo htmlspecialchars(json_encode($imgs, JSON_UNESCAPED_SLASHES | JSON_HEX_APOS), ENT_QUOTES); ?>'>
                        <div class="timeline-content">
                            <div class="tag-row">
                                <span class="tag"><?php echo htmlspecialchars($ev['tag']); ?></span>
                                <span class="date"><?php echo htmlspecialchars($ev['date_label']); ?></span>
                            </div>
                            <h2><?php echo htmlspecialchars($ev['title']); ?></h2>
                            <p><?php echo htmlspecialchars($ev['description']); ?></p>
                        </div>
                        <div class="timeline-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>
                        </div>
                        <div class="timeline-image">
                            <div class="img-slider<?php echo count($imgs) < 2 ? ' single' : ''; ?>">
                                <?php foreach ($imgs as $ii => $iu): ?>
                                <img src="<?php echo htmlspecialchars($iu); ?>" alt="<?php echo htmlspecialchars($ev['title']); ?>" class="slider-img<?php echo $ii === 0 ? ' active' : ''; ?>">
                                <?php endforeach; ?>
                                <button class="slider-btn slider-prev" aria-label="Previous">&#8249;</button>
                                <button class="slider-btn slider-next" aria-label="Next">&#8250;</button>
                                <div class="slider-dots">
                                    <?php foreach ($imgs as $ii => $iu): ?>
                                    <span class="dot<?php echo $ii === 0 ? ' active' : ''; ?>"></span>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>

                </div><!-- /.timeline -->
            </div><!-- /.timeline-container -->

            <!-- Fullscreen Image Modal with Slider -->
            <div id="timelineModal" class="timeline-modal">
                <div class="timeline-modal-content">
                    <span class="close-modal">&times;</span>
                    <button class="modal-arrow modal-prev" aria-label="Previous">&#8249;</button>
                    <img id="timelinePopupImg" src="" alt="Fullscreen Certificate">
                    <button class="modal-arrow modal-next" aria-label="Next">&#8250;</button>
                    <div class="modal-dots" id="modalDots"></div>
                </div>
            </div>

        </div>
        
        <!-- Footer in Main Container -->
        <?php include 'includes/footer.php'; ?>
    </div>

    <!-- Toast Notification Container -->
    <?php include 'includes/footer_resources.php'; ?>
    <script src="../js/timelineScript.js"></script>
</body>
</html>
