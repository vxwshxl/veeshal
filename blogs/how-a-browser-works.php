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

    <title>How a Browser Works: A Beginner-Friendly Guide - Veeshal D. Bodosa</title>
    <meta name="description" content="A simplified guide to browser internals: DOM, CSSOM, and the Critical Rendering Path.">
    <meta name="keywords" content="Browser, DOM, CSSOM, Rendering Engine, Web Development, HTML Parsing, Critical Rendering Path, webdevcohort2026">
    <meta name="author" content="Veeshal D. Bodosa">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="https://veeshal.me/blogs/how-a-browser-works">
    <meta property="og:title" content="How a Browser Works: A Beginner-Friendly Guide">
    <meta property="og:description" content="What truly happens between pressing 'Enter' and seeing a website?">
    <meta property="og:image" content="https://ineasysteps.com/wp-content/uploads/2021/11/How-to-web-browsers-work-image.jpg">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://veeshal.me/blogs/how-a-browser-works">
    <meta property="twitter:title" content="How a Browser Works: A Beginner-Friendly Guide">
    <meta property="twitter:description" content="What truly happens between pressing 'Enter' and seeing a website?">
    <meta property="twitter:image" content="https://ineasysteps.com/wp-content/uploads/2021/11/How-to-web-browsers-work-image.jpg">
    
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
                                    <li><a href="#architecture" class="toc-link">Browser Architecture</a></li>
                                    <li><a href="#networking" class="toc-link">Networking</a></li>
                                    <li><a href="#dom" class="toc-link">HTML & The DOM</a></li>
                                    <li><a href="#cssom" class="toc-link">CSS & The CSSOM</a></li>
                                    <li><a href="#render-tree" class="toc-link">The Render Tree</a></li>
                                    <li><a href="#layout-paint" class="toc-link">Layout & Paint</a></li>
                                </ul>
                            </nav>
                        </div>
                    </aside>

                    <!-- Main Article Content -->
                    <div class="blog-main-content">
                        <header class="blog-header">
                            <h1>How a Browser Works: A Beginner-Friendly Guide</h1>
                            <div class="blog-meta-row">
                                <div class="meta-category">HTML & CSS</div>
                                <div class="meta-author">Veeshal D. Bodosa</div>
                                <div class="meta-date">23 Jan 2026</div>
                            </div>
                        </header>

                        <div class="blog-hero-image-wrapper">
                            <img src="https://ineasysteps.com/wp-content/uploads/2021/11/How-to-web-browsers-work-image.jpg" alt="DOM Tree Diagram" class="blog-hero-image" style="background: white; padding: 20px;">
                        </div>

                        <article class="article-content">
                            <p class="lead" id="introduction">We use web browsers every day, yet for many, they remain a magical black box. You type a URL, press Enter, and—poof—a website appears. But as developers, we need to look closer. What happens in those milliseconds? How does text turn into pixels?</p>
                            
                            <p>A web browser is essentialy a complex engine designed to fetch resources and interpret them into an interactive visual experience.</p>

                            <h2 id="architecture">High-Level Browser Architecture</h2>
                            <p>A browser isn't just one monolithic program. It's a collection of specialized components working together.</p>
                            
                            <div class="mermaid">
                            graph TD
                                User[User] --> UI[User Interface]
                                UI --> BrowserEngine[Browser Engine]
                                BrowserEngine --> RenderingEngine[Rendering Engine]
                                BrowserEngine --> Data[Data Persistence]
                                RenderingEngine --> Networking[Networking]
                                RenderingEngine --> JS[JS Interpreter]
                                RenderingEngine --> UIBackend[UI Backend]
                            </div>

                            <ul>
                                <li><strong>The User Interface:</strong> The address bar, back button, bookmarks menu. This is what you interact with.</li>
                                <li><strong>The Browser Engine:</strong> Marshalling actions between the UI and the rendering engine.</li>
                                <li><strong>The Rendering Engine:</strong> The heart of the operation. It parses HTML and CSS and displays the content. (Examples: Blink in Chrome, Gecko in Firefox, WebKit in Safari).</li>
                                <li><strong>Networking:</strong> Handles HTTP requests (as we discussed in our TCP vs UDP article).</li>
                            </ul>

                            <h2 id="networking">Step 1: Fetching the Data</h2>
                            <p>It starts with Networking. When you request a page, the browser sends an HTTP request. The server responds with HTML. This HTML arrives as a stream of raw bytes.</p>
                            
                            <p>The browser must now convert these bytes into something it can understand.</p>
                            
                            <h2 id="dom">Step 2: HTML Parsing & The DOM</h2>
                            <p>The browser reads the raw HTML bytes and converts them into characters, then into tokens (like <code>&lt;html&gt;</code>, <code>&lt;body&gt;</code>), and finally into objects.</p>
                            
                            <p>These objects are linked in a tree structure called the <strong>DOM (Document Object Model)</strong>. The DOM reflects the parent-child relationships defined in your HTML.</p>

                            <div class="mermaid">
                            graph TD
                                Doc[Document] --> HTML[html]
                                HTML --> Head[head]
                                Head --> Title[title]
                                HTML --> Body[body]
                                Body --> P[p]
                                Body --> Div[div]
                                Div --> Img[img]
                            </div>
                            
                            <p>If your HTML is broken (e.g., missing a closing tag), the browser tries to fix it here. This explains why "view source" often looks different from the code you wrote—it's the browser's corrected interpretation.</p>

                            <h2 id="cssom">Step 3: CSS Parsing & The CSSOM</h2>
                            <p>While parsing HTML, the browser encounters a <code>&lt;link&gt;</code> tag for CSS. It pauses to fetch the stylesheet.</p>
                            
                            <p>Just like HTML becomes the DOM, CSS bytes are converted into the <strong>CSSOM (CSS Object Model)</strong>. This is also a tree structure, but it represents styles and cascading rules.</p>
                            
                            <div class="mermaid">
                            graph TD
                                Body[body: font-size 16px] --> Div[div: display block]
                                Div --> P[p: font-weight bold]
                                Div --> Span[span: color red]
                            </div>

                            <p>Why a tree? Because of inheritance. If you set a font size on the <code>body</code>, it cascades down to the <code>p</code> tag unless overridden.</p>

                            <h2 id="render-tree">Step 4: The Render Tree</h2>
                            <p>Now we have two trees: the DOM (content) and the CSSOM (style). The browser combines them into a <strong>Render Tree</strong>.</p>
                            
                            <p>The Render Tree contains <em>only</em> what will be displayed on the screen.
                            <br>- <strong>Included:</strong> Visible elements like <code>&lt;div&gt;</code> with text.
                            <br>- <strong>Excluded:</strong> Non-visual elements like <code>&lt;head&gt;</code> or elements with <code>display: none</code>.</p>
                            
                            <div class="mermaid">
                            graph LR
                                DOM[DOM Tree] -->|Combine| Render[Render Tree]
                                CSSOM[CSSOM Tree] -->|Combine| Render
                            </div>

                            <h2 id="layout-paint">Step 5: Layout & Paint</h2>
                            <p>With the Render Tree built, the browser proceeds to the final stages:</p>
                            
                            <h3>Layout (Reflow)</h3>
                            <p>The browser calculates the exact position and size of every box within the viewport. It determines that the "Header" is 100% width at the top, and the "Sidebar" is 200px wide on the left. This is geometry.</p>
                            
                            <h3>Paint</h3>
                            <p>Finally, the browser fills in the pixels. It draws text, colors, images, shadows, and borders. This process is called "painting" or "rasterizing."</p>

                            <div class="mermaid">
                            graph LR
                                HTML --> DOM
                                CSS --> CSSOM
                                DOM --> RenderTree
                                CSSOM --> RenderTree
                                RenderTree --> Layout
                                Layout --> Paint
                                Paint --> Display
                            </div>

                            <h3>Summary</h3>
                            <p>The journey from URL to pixels involves a sophisticated pipeline. The browser fetches raw data, builds the DOM and CSSOM, combines them, calculates geometry, and paints pixels. Understanding this flow (the "Critical Rendering Path") is the first step toward mastering performance optimization.</p>
                        </article>
                    </div>

                    <!-- Right Sidebar (Tags) -->
                    <aside class="blog-sidebar-right">
                        <div class="sidebar-tags-wrapper">
                            <h3 class="sidebar-title">Tags</h3>
                            <div class="blog-tags">
                                <a href="" class="blog-tag">#browser</a>
                                <a href="" class="blog-tag">#html</a>
                                <a href="" class="blog-tag">#css</a>
                                <a href="" class="blog-tag">#dom</a>
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
