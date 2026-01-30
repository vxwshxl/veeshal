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

    <title>Understanding HTML Tags and Elements - Veeshal D. Bodosa</title>
    <meta name="description" content="A beginner's guide to HTML: deeply understanding tags, elements, attributes, and the difference between block and inline layouts.">
    <meta name="keywords" content="HTML, Web Development, Tags, Elements, Block vs Inline, Basics, webdevcohort2026">
    <meta name="author" content="Veeshal D. Bodosa">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="https://veeshal.me/blogs/understanding-html-tags-and-elements">
    <meta property="og:title" content="Understanding HTML Tags and Elements">
    <meta property="og:description" content="Mastering the building blocks of the web.">
    <meta property="og:image" content="https://i.ytimg.com/vi/mekRKzHByEQ/maxresdefault.jpg">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://veeshal.me/blogs/understanding-html-tags-and-elements">
    <meta property="twitter:title" content="Understanding HTML Tags and Elements">
    <meta property="twitter:description" content="Mastering the building blocks of the web.">
    <meta property="twitter:image" content="https://i.ytimg.com/vi/mekRKzHByEQ/maxresdefault.jpg">
    
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
                                    <li><a href="#anatomy" class="toc-link">Anatomy of an Element</a></li>
                                    <li><a href="#void-elements" class="toc-link">Self-Closing Tags</a></li>
                                    <li><a href="#block-inline" class="toc-link">Block vs Inline</a></li>
                                    <li><a href="#best-practices" class="toc-link">Best Practices</a></li>
                                </ul>
                            </nav>
                        </div>
                    </aside>

                    <!-- Main Article Content -->
                    <div class="blog-main-content">
                        <header class="blog-header">
                            <h1>Understanding HTML Tags and Elements</h1>
                            <div class="blog-meta-row">
                                <div class="meta-category">HTML & CSS</div>
                                <div class="meta-author">Veeshal D. Bodosa</div>
                                <div class="meta-date">24 Jan 2026</div>
                            </div>
                        </header>

                        <div class="blog-hero-image-wrapper">
                            <img src="https://i.ytimg.com/vi/mekRKzHByEQ/maxresdefault.jpg" alt="HTML5 Logo" class="blog-hero-image" style="background: white; padding: 20px;">
                        </div>

                        <article class="article-content">
                            <p class="lead" id="introduction">Every webpage, no matter how complex, starts with HTML (HyperText Markup Language). It is the skeleton of the web. Just as a human body needs a skeleton to hold its shape, a website needs specific codes—called tags—to define headings, paragraphs, images, and buttons.</p>
                            
                            <p>But there is often confusion: what is a tag, and how is it different from an element? Let's break it down.</p>

                            <h2 id="anatomy">Anatomy of an HTML Element</h2>
                            <p>An HTML <strong>Element</strong> is the complete instruction to the browser. It usually consists of a start tag, some content, and an end tag.</p>

                            <div class="mermaid">
                            graph LR
                                sub1[Start Tag] --- Content
                                Content --- sub2[End Tag]
                                sub1 -->|&lt;p&gt;| Element
                                Content -->|Hello World| Element
                                sub2 -->|&lt;/p&gt;| Element
                            </div>

                            <ul>
                                <li><strong>The Start Tag:</strong> <code>&lt;p&gt;</code> tells the browser "a paragraph starts here".</li>
                                <li><strong>The Content:</strong> "Hello World" is what the user actually sees.</li>
                                <li><strong>The End Tag:</strong> <code>&lt;/p&gt;</code> tells the browser "the paragraph ends here".</li>
                                <li><strong>The Element:</strong> The entire combination: <code>&lt;p&gt;Hello World&lt;/p&gt;</code>.</li>
                            </ul>

                            <h2 id="void-elements">Self-Closing (Void) Elements</h2>
                            <p>Not everything has content inside it. For example, an image or a line break cannot "contain" text in the same way a paragraph does. These are called <strong>void elements</strong> or self-closing tags.</p>
                            
                            <p>They do not have an end tag.</p>
                            <ul>
                                <li><code>&lt;img src="pic.jpg"&gt;</code> (Embeds an image)</li>
                                <li><code>&lt;br&gt;</code> (Inserts a line break)</li>
                                <li><code>&lt;hr&gt;</code> (Inserts a horizontal rule)</li>
                                <li><code>&lt;input type="text"&gt;</code> (Creates an input field)</li>
                            </ul>

                            <h2 id="block-inline">Block-Level vs Inline Elements</h2>
                            <p>One of the most important concepts to understand early is how elements behave on the page. They generally fall into two categories: Block and Inline.</p>

                            <h3>1. Block-Level Elements</h3>
                            <p>These elements take up the <strong>full width</strong> available. They always start on a new line and force the next element to start on a new line below them.</p>
                            <p><em>Examples:</em> <code>&lt;div&gt;</code>, <code>&lt;p&gt;</code>, <code>&lt;h1&gt;</code> to <code>&lt;h6&gt;</code>, <code>&lt;article&gt;</code>, <code>&lt;section&gt;</code>.</p>

                            <h3>2. Inline Elements</h3>
                            <p>These elements only take up as much width as necessary. They do not start on a new line and sit comfortably next to other elements.</p>
                            <p><em>Examples:</em> <code>&lt;span&gt;</code>, <code>&lt;a&gt;</code>, <code>&lt;strong&gt;</code>, <code>&lt;img&gt;</code>.</p>

                            <div class="mermaid">
                            graph TD
                                subgraph Block_Layout ["Block Behavior (Stacking)"]
                                    Div1["Div 1 (100% Width)"]
                                    Div2["Div 2 (100% Width)"]
                                    P1["Paragraph (100% Width)"]
                                    Div1 --> Div2
                                    Div2 --> P1
                                end

                                subgraph Inline_Layout ["Inline Behavior (Side-by-Side)"]
                                    Span1["Span 1"] --- Span2["Span 2"] --- Link["Link"]
                                end
                            </div>

                            <p>Think of block elements like stacking boxes vertically, and inline elements like words in a sentence flowing horizontally.</p>

                            <h2 id="best-practices">Best Practices</h2>
                            <ul>
                                <li><strong>Close your tags:</strong> Unless it's a void element, always include the closing tag <code>&lt;/tag&gt;</code>. Unclosed tags can cause layout disasters.</li>
                                <li><strong>Use semantic text:</strong> Don't just use <code>&lt;div&gt;</code> for everything. Use <code>&lt;header&gt;</code>, <code>&lt;nav&gt;</code>, and <code>&lt;footer&gt;</code> to give your code meaning.</li>
                                <li><strong>Lowercase tags:</strong> While HTML isn't strictly case-sensitive, the industry standard is to write tags in lowercase (e.g., <code>&lt;div&gt;</code>, not <code>&lt;DIV&gt;</code>).</li>
                            </ul>

                            <h3>Conclusion</h3>
                            <p>Understanding the difference between a tag and an element, and knowing how block and inline elements behave, gives you full control over your webpage's structure. These are the simple LEGO bricks from which every site on the internet is built.</p>
                        </article>
                    </div>

                    <!-- Right Sidebar (Tags) -->
                    <aside class="blog-sidebar-right">
                        <div class="sidebar-tags-wrapper">
                            <h3 class="sidebar-title">Tags</h3>
                            <div class="blog-tags">
                                <a href="" class="blog-tag">#html</a>
                                <a href="" class="blog-tag">#webdev</a>
                                <a href="" class="blog-tag">#basics</a>
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
