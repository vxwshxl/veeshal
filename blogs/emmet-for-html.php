<?php
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

    <title>Emmet for HTML: A Beginner’s Guide to Writing Faster Markup - Veeshal D. Bodosa</title>
    <meta name="description" content="Learn how to write HTML at lightning speed using Emmet abbreviations. A clear guide to shortcuts, nesting, and multiplication.">
    <meta name="keywords" content="Emmet, HTML, Coding Speed, Productivity, Shortcuts, Web Development, webdevcohort2026">
    <meta name="author" content="Veeshal D. Bodosa">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="https://veeshal.me/blogs/emmet-for-html">
    <meta property="og:title" content="Emmet for HTML: A Beginner’s Guide to Writing Faster Markup">
    <meta property="og:description" content="Type less, do more. The ultimate shortcut for web developers.">
    <meta property="og:image" content="https://www.alphr.com/wp-content/uploads/2023/10/emmet-nedir-ve-ne-ise-yarar-1280x720.jpg">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://veeshal.me/blogs/emmet-for-html">
    <meta property="twitter:title" content="Emmet for HTML: A Beginner’s Guide to Writing Faster Markup">
    <meta property="twitter:description" content="Type less, do more. The ultimate shortcut for web developers.">
    <meta property="twitter:image" content="https://www.alphr.com/wp-content/uploads/2023/10/emmet-nedir-ve-ne-ise-yarar-1280x720.jpg">
    
</head>

<body>
    <div id="home" class="home">
        <div class="homeContainer">
            <?php include 'includes/header.php'; ?>

            <!-- Single Blog Post Content -->
            <div class="single-blog-container with-sidebar">
                <div class="back-link-wrapper mobile-back-link">
                    <a href="index" class="back-link">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                        Back
                    </a>
                </div>
                
                <div class="blog-layout-grid">
                    <!-- Sticky Sidebar -->
                    <aside class="blog-sidebar">
                        <div class="desktop-back-link" style="margin-bottom: 20px;">
                            <a href="index" class="back-link">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                                Back
                            </a>
                        </div>
                        <div class="sidebar-inner">
                            <h3 class="sidebar-title">On this page</h3>
                            <nav class="table-of-contents">
                                <ul>
                                    <li><a href="#introduction" class="toc-link">Introduction</a></li>
                                    <li><a href="#basics" class="toc-link">The Basics</a></li>
                                    <li><a href="#classes-ids" class="toc-link">Classes & IDs</a></li>
                                    <li><a href="#nesting" class="toc-link">Nesting Elements</a></li>
                                    <li><a href="#multiplication" class="toc-link">Multiplication</a></li>
                                    <li><a href="#boilerplate" class="toc-link">Instant Boilerplate</a></li>
                                </ul>
                            </nav>
                        </div>
                    </aside>

                    <!-- Main Article Content -->
                    <div class="blog-main-content">
                        <header class="blog-header">
                            <h1>Emmet for HTML: A Beginner’s Guide to Writing Faster Markup</h1>
                            <div class="blog-meta-row">
                                <div class="meta-category">HTML & CSS</div>
                                <div class="meta-author">Veeshal D. Bodosa</div>
                                <div class="meta-date">30 Jan 2026</div>
                            </div>
                        </header>

                        <div class="blog-hero-image-wrapper">
                            <img src="https://www.alphr.com/wp-content/uploads/2023/10/emmet-nedir-ve-ne-ise-yarar-1280x720.jpg" alt="Emmet Logo" class="blog-hero-image" style="background: white; padding: 20px;">
                        </div>

                        <article class="article-content">
                            <p class="lead" id="introduction">Typing HTML manually feels like a chore. Opening tags, typing the name, closing tags, typing the closing name... it is repetitive and error-prone. What if you could type a shorthand code and have it explode into full, valid HTML? That is exactly what Emmet does.</p>
                            
                            <p>Emmet is a plugin built into most modern code editors (like VS Code) that converts abbreviated syntax into full HTML structures instantly.</p>

                            <div class="mermaid">
                            graph LR
                                Short[Type: div.container] -->|Press Tab| Result[Result: &lt;div class='container'&gt;&lt;/div&gt;]
                                style Short fill:#e1f5fe,stroke:#01579b
                                style Result fill:#e8f5e9,stroke:#2e7d32
                            </div>

                            <h2 id="basics">1. The Basics</h2>
                            <p>At its simplest, type the tag name and press <code>Tab</code> or <code>Enter</code>.</p>
                            
                            <ul>
                                <li>Type <code>h1</code> → <code>&lt;h1&gt;&lt;/h1&gt;</code></li>
                                <li>Type <code>p</code> → <code>&lt;p&gt;&lt;/p&gt;</code></li>
                                <li>Type <code>a</code> → <code>&lt;a href=""&gt;&lt;/a&gt;</code></li>
                            </ul>

                            <h2 id="classes-ids">2. Adding Classes and IDs</h2>
                            <p>We use CSS selectors syntax here. <code>.</code> for Class and <code>#</code> for ID.</p>
                            
                            <div class="code-block">
div.card       →  &lt;div class="card"&gt;&lt;/div&gt;
h1#main-title  →  &lt;h1 id="main-title"&gt;&lt;/h1&gt;
p.text-bold    →  &lt;p class="text-bold"&gt;&lt;/p&gt;
                            </div>

                            <p>You can even combine them:</p>
                            <div class="code-block">
div#hero.section.dark → &lt;div id="hero" class="section dark"&gt;&lt;/div&gt;
                            </div>

                            <h2 id="nesting">3. Nesting Elements (The Child Operator)</h2>
                            <p>Use the greater-than symbol <code>&gt;</code> to put one element inside another.</p>

                            <div class="code-block">
ul&gt;li&gt;a
                            </div>

                            <p><strong>Becomes:</strong></p>
                            <div class="code-block">
&lt;ul&gt;
    &lt;li&gt;
        &lt;a href=""&gt;&lt;/a&gt;
    &lt;/li&gt;
&lt;/ul&gt;
                            </div>

                            <div class="mermaid">
                            graph TD
                                UL[ul] --> LI[li]
                                LI --> A[a]
                            </div>

                            <h2 id="multiplication">4. Multiplication (Repeating Elements)</h2>
                            <p>Need a list with 5 items? Don't copy-paste. Use the asterisk <code>*</code>.</p>

                            <div class="code-block">
ul&gt;li*5
                            </div>

                            <p><strong>Becomes:</strong></p>
                            <div class="code-block">
&lt;ul&gt;
    &lt;li&gt;&lt;/li&gt;
    &lt;li&gt;&lt;/li&gt;
    &lt;li&gt;&lt;/li&gt;
    &lt;li&gt;&lt;/li&gt;
    &lt;li&gt;&lt;/li&gt;
&lt;/ul&gt;
                            </div>

                            <h2 id="boilerplate">5. The Ultimate Shortcut (Boilerplate)</h2>
                            <p>Starting a new file? Just type <code>!</code> and press <code>Tab</code>.</p>
                            
                            <p>Emmet will generate the entire HTML5 document structure, including the <code>&lt;html&gt;</code>, <code>&lt;head&gt;</code>, <code>&lt;body&gt;</code>, and meta tags.</p>

                            <div class="code-block">
&lt;!DOCTYPE html&gt;
&lt;html lang="en"&gt;
&lt;head&gt;
    &lt;meta charset="UTF-8"&gt;
    &lt;title&gt;Document&lt;/title&gt;
&lt;/head&gt;
&lt;body&gt;
    
&lt;/body&gt;
&lt;/html&gt;
                            </div>

                            <h3>Conclusion</h3>
                            <p>Emmet isn't cheating; it's efficiency. By memorizing these few patterns—<code>.</code> for classes, <code>&gt;</code> for nesting, and <code>*</code> for multiplication—you can write HTML as fast as you can think. Give it a try in your next project!</p>
                        </article>
                    </div>

                    <!-- Right Sidebar (Tags) -->
                    <aside class="blog-sidebar-right">
                        <div class="sidebar-tags-wrapper">
                            <h3 class="sidebar-title">Tags</h3>
                            <div class="blog-tags">
                                <a href="" class="blog-tag">#emmet</a>
                                <a href="" class="blog-tag">#html</a>
                                <a href="" class="blog-tag">#productivity</a>
                                <a href="" class="blog-tag">#webdevcohort2026</a>
                            </div>
                        </div>
                    </aside>
        </div>
    </div>
    </div>

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>
</div>

    <!-- Toast Notification Container -->
    <?php include 'includes/footer_resources.php'; ?>
    <!-- Custom Script for Single Blog Post -->
    <script src="../js/singleBlogScript.js"></script>
</body>
</html>
