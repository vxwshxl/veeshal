<?php
// Simple .env parser
$env = [];
$envPath = null;

// Check for .env in parent directory (Localhost relative to blogs/)
if (file_exists(__DIR__ . '/../.env')) {
    $envPath = __DIR__ . '/../.env';
} 
// Check for .env in config directory (Hostinger/Production relative to blogs/)
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Blogs - Veeshal D. Bodosa - A creative developer and video editor blending code and cinematics to craft immersive digital experiences.">
    <meta name="keywords"
        content="Veeshal D. Bodosa, Web Developer, Video Editor, Portfolio, React Native, Flutter, Cinematics, Creative Developer, India, Blogs">
    <meta name="author" content="Veeshal D. Bodosa">
    <meta name="robots" content="index, follow">
    <meta name="theme-color" content="#000000">
    <link rel="canonical" href="https://veeshal.me/blogs/">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://veeshal.me/blogs/">
    <meta property="og:title" content="Blogs - Veeshal D. Bodosa">
    <meta property="og:description"
        content="Welcome to a visual journey that blends code & creativity, and every edit tells a story. Engineered with precision & crafted with passion.">
    <meta property="og:image" content="https://veeshal.me/assets/vee-og.jpg">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://veeshal.me/blogs/">
    <meta property="twitter:title" content="Blogs - Veeshal D. Bodosa">
    <meta property="twitter:description"
        content="Welcome to a visual journey that blends code & creativity, and every edit tells a story. Engineered with precision & crafted with passion.">
    <meta property="twitter:image" content="https://veeshal.me/assets/vee-og.jpg">

    <link rel="icon" type="image/png" href="../favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="../favicon.svg" />
    <link rel="shortcut icon" href="../favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="../apple-touch-icon.png" />
    <link rel="manifest" href="../site.webmanifest" />
    <title>Blogs - Veeshal D. Bodosa</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/introStyles.css">
    <link rel="stylesheet" href="../css/portfolioStyles.css">
    <link rel="stylesheet" href="../css/projectStyles.css">
    <link rel="stylesheet" href="../css/aboutStyles.css">
    <link rel="stylesheet" href="../css/contactStyles.css">
    <link rel="stylesheet" href="../css/blogsStyles.css">
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
    <!-- Loader Removed -->

    <div id="home" class="home">
        <div class="homeContainer">
            <div class="top">
                <!-- Header/Navigation -->
                <div class="space-up"></div>
                <hr class="line">
                <header>
                    <div class="logo">
                        <a href="../index.php"><img src="../assets/logo.svg"></a>
                    </div>
                    <nav>
                        <ul>
                            <li><a href="../index.php">Home</a></li>
                            <li><a href="../index.php#intro">Intro</a></li>
                            <li><a href="../index.php#portfolio">Portfolio</a></li>
                            <li><a href="../index.php#project">Projects</a></li>
                            <li><a href="index.php"><span class="highlight">Blogs</span></a></li>
                            <li><a href="../index.php#contact">Contact</a></li>
                            <li><a href="../index.php#about">About</a></li>
                        </ul>
                    </nav>
                    <div class="logo">
                        <img src="../assets/india.svg" alt="Made in India">
                    </div>
                </header>
                <hr class="line">
            </div>

            <!-- Blogs Layout -->
            <div class="blog-container">
                <!-- Sidebar -->
                <aside class="blog-sidebar">
                    <h3 class="blog-category-title">Categories</h3>
                    <ul class="blog-categories">
                        <li><a href="index.php" class="<?php echo !isset($_GET['category']) ? 'active' : ''; ?>">View all</a></li>
                        <?php
                        $categories = [
                            'Product design',
                            'Software development',
                            'Product management',
                            'Productivity',
                            'User research',
                            'Design inspiration'
                        ];
                        foreach ($categories as $cat) {
                            $isActive = isset($_GET['category']) && $_GET['category'] === $cat ? 'active' : '';
                            echo "<li><a href=\"?category=" . urlencode($cat) . "\" class=\"$isActive\">$cat</a></li>";
                        }
                        ?>
                    </ul>
                </aside>

                <!-- Main Content -->
                <main class="blog-content">
                    <?php
                    // Mock Data - 11 Blog Posts
                    // Blog Posts Data
                    $all_posts = [
                        [
                            'title' => 'Git for Beginners: Basics and Essential Commands',
                            'date' => '27 Dec 2025',
                            'category' => 'Software development',
                            'image' => '../assets/working-dir.png',
                            'link' => 'git-for-beginners.php'
                        ]
                    ];
                    ?>
                    
                    <!-- Inject Data for JS -->
                    <script>
                        const allPosts = <?php echo json_encode($all_posts); ?>;
                    </script>

                    <div class="blog-content-header">
                        <h3 class="recent-posts-title">Recent posts</h3>
                        <div class="search-container">
                            <input type="text" placeholder="Search" class="search-input">
                        </div>
                    </div>
                    
                    <div class="posts-grid">
                        <!-- Content rendered via JS -->
                    </div>

                    <!-- Pagination -->
                    <div class="pagination-container" style="margin-top: 50px; display: flex; justify-content: center; gap: 8px; align-items: center; flex-wrap: wrap;">
                        <!-- Pagination rendered via JS -->
                    </div>

                </main>
            </div>
        </div>
        
        <!-- Footer in Main Container -->
        <div class="footer">
            <div class="footerContainer">
                <div class="top">
                    <!-- Footer/Navigation -->
                    <hr class="line">
                    <div class="space-up"></div>
                    <footer>
                        <div class="logo">
                            <a href="../index.php"><img src="../assets/logo.svg"></a>
                        </div>
                        <nav>
                            <ul>
                                <li><a href="../index.php">Home</a></li>
                                <li><a href="../index.php#intro">Intro</a></li>
                                <li><a href="../index.php#portfolio">Portfolio</a></li>
                                <li><a href="../index.php#project">Projects</a></li>
                                <li><a href="index.php"><span class="highlight">Blogs</span></a></li>
                                <li><a href="../index.php#contact">Contact</a></li>
                                <li><a href="../index.php#about">About</a></li>
                            </ul>
                        </nav>
                    </footer>
                </div>
                 <h2 class="homeTxt">fall back<span class="highlight">?</span></h2>
                <h2 class="homeTxt">redesign<span class="highlight">..!</span></h2>
            </div>
        </div>
    </div>

    <!-- Toast Notification Container -->
    <div id="toast-container"></div>

    <!-- Removed js/script.js to prevent loader and entrance animations -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="../js/blogScript.js"></script>
</body>
</html>
