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

    <title>CSS Selectors 101: Targeting Elements with Precision - Veeshal D. Bodosa</title>
    <meta name="description" content="Master the art of CSS selectors. Learn how to target elements by tag, class, and ID to style your webpages with precision.">
    <meta name="keywords" content="CSS, Selectors, Web Design, HTML, ID vs Class, Specificity, webdevcohort2026">
    <meta name="author" content="Veeshal D. Bodosa">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="https://veeshal.me/blogs/css-selectors-101">
    <meta property="og:title" content="CSS Selectors 101: Targeting Elements with Precision">
    <meta property="og:description" content="Stop guessing and start styling with intent.">
    <meta property="og:image" content="https://media2.dev.to/dynamic/image/width=1000,height=420,fit=cover,gravity=auto,format=auto/https%3A%2F%2Fdev-to-uploads.s3.amazonaws.com%2Fuploads%2Farticles%2Fnl1rxl108tb77t4ch3g3.png">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://veeshal.me/blogs/css-selectors-101">
    <meta property="twitter:title" content="CSS Selectors 101: Targeting Elements with Precision">
    <meta property="twitter:description" content="Stop guessing and start styling with intent.">
    <meta property="twitter:image" content="https://media2.dev.to/dynamic/image/width=1000,height=420,fit=cover,gravity=auto,format=auto/https%3A%2F%2Fdev-to-uploads.s3.amazonaws.com%2Fuploads%2Farticles%2Fnl1rxl108tb77t4ch3g3.png">
    
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
                                    <li><a href="#element" class="toc-link">Element Selector</a></li>
                                    <li><a href="#class" class="toc-link">Class Selector</a></li>
                                    <li><a href="#id" class="toc-link">ID Selector</a></li>
                                    <li><a href="#grouping" class="toc-link">Grouping & Descendants</a></li>
                                    <li><a href="#priority" class="toc-link">Who Wins? (Priority)</a></li>
                                </ul>
                            </nav>
                        </div>
                    </aside>

                    <!-- Main Article Content -->
                    <div class="blog-main-content">
                        <header class="blog-header">
                            <h1>CSS Selectors 101: Targeting Elements with Precision</h1>
                            <div class="blog-meta-row">
                                <div class="meta-category">HTML & CSS</div>
                                <div class="meta-author">Veeshal D. Bodosa</div>
                                <div class="meta-date">30 Jan 2026</div>
                            </div>
                        </header>

                        <div class="blog-hero-image-wrapper">
                            <img src="https://media2.dev.to/dynamic/image/width=1000,height=420,fit=cover,gravity=auto,format=auto/https%3A%2F%2Fdev-to-uploads.s3.amazonaws.com%2Fuploads%2Farticles%2Fnl1rxl108tb77t4ch3g3.png" alt="CSS Logo" class="blog-hero-image" style="background: white; padding: 20px;">
                        </div>

                        <article class="article-content">
                            <p class="lead" id="introduction">CSS (Cascading Style Sheets) is all about applying rules to things. But before you can apply a rule—like "make this text red"—you have to tell the browser <em>which</em> text you are talking about. This addressing system is done via <strong>Selectors</strong>.</p>
                            
                            <p>Think of selectors like addressing a letter. You can send mail to "Everyone in New York" (broad), "The Smiths" (specific group), or "John Doe at 123 Main St" (unique).</p>

                            <h2 id="element">1. Element Selector (The Broadest Stroke)</h2>
                            <p>This targets every single instance of an HTML tag.</p>
                            
                            <div class="code-block">
p {
    color: blue;
}
                            </div>
                            
                            <p><strong>Result:</strong> Every single paragraph on the page turns blue. This is great for setting defaults but often too broad for specific designs.</p>

                            <h2 id="class">2. Class Selector (The Reusable Label)</h2>
                            <p>Classes are the workhorses of CSS. You can label multiple elements with the same class name and style them all at once. Class selectors always start with a dot (<code>.</code>).</p>

                            <div class="code-block">
.highlight {
    background-color: yellow;
}
                            </div>

                            <p><strong>HTML:</strong></p>
                            <div class="code-block">
&lt;p class="highlight"&gt;This is important.&lt;/p&gt;
&lt;span class="highlight"&gt;So is this.&lt;/span&gt;
                            </div>

                            <h2 id="id">3. ID Selector (The Unique Identifier)</h2>
                            <p>IDs are unique. There should only be one element with a specific ID on a page. Because they are so specific, they are powerful but rigid. ID selectors start with a hash (<code>#</code>).</p>

                            <div class="code-block">
#main-header {
    font-size: 32px;
}
                            </div>
                            
                            <div class="mermaid">
                            graph TD
                                El[Element Selector] -->|p| Targets[All Paragraphs]
                                Cl[Class Selector] -->|.btn| Targets2["Specific Group (Buttons)"]
                                ID[ID Selector] -->|#logo| Targets3["One Unique Element"]
                            </div>

                            <h2 id="grouping">4. Grouping & Descendant Selectors</h2>
                            <p>Sometimes you want to be efficient.</p>
                            
                            <h3>Grouping (The Comma)</h3>
                            <p>If <code>h1</code> and <code>h2</code> need the same font, group them:</p>
                            <div class="code-block">
h1, h2 {
    font-family: 'Arial';
}
                            </div>

                            <h3>Descendant (The Space)</h3>
                            <p>If you only want to style an image <em>inside</em> the footer, use a space:</p>
                            <div class="code-block">
footer img {
    border: 1px solid white;
}
                            </div>
                            
                            <p>This tells the browser: "Find the footer, then look inside it for an image."</p>

                            <h2 id="priority">5. Who Wins? (Basic Priority)</h2>
                            <p>What happens if a paragraph has an ID, a Class, and a Tag style, and they all say different things? CSS has a hierarchy of "Specificity".</p>
                            
                            <div class="mermaid">
                            graph BT
                                Tag[Tag Selector] --> Class[Class Selector]
                                Class --> ID[ID Selector]
                                ID --> Inline[Inline Styles]
                                Inline --> Important[!important]
                                style Tag fill:#f9f,stroke:#333
                                style Class fill:#bbf,stroke:#333
                                style ID fill:#bfb,stroke:#333
                            </div>

                            <ul>
                                <li><strong>Tag:</strong> Lowest priority (1 point)</li>
                                <li><strong>Class:</strong> Medium priority (10 points)</li>
                                <li><strong>ID:</strong> High priority (100 points)</li>
                            </ul>
                            
                            <p>If you have <code>.red-text { color: red; }</code> and <code>#blue-text { color: blue; }</code> on the same element, <strong>Blue</strong> wins because IDs overpower Classes.</p>

                            <h3>Conclusion</h3>
                            <p>Selectors are the grammar of CSS. By combining elements, classes, and IDs, you can target exactly what you want without accidentally messing up the rest of your page. Start broad with elements, refine with classes, and use IDs sparingly for structure.</p>
                        </article>
                    </div>

                    <!-- Right Sidebar (Tags) -->
                    <aside class="blog-sidebar-right">
                        <div class="sidebar-tags-wrapper">
                            <h3 class="sidebar-title">Tags</h3>
                            <div class="blog-tags">
                                <a href="" class="blog-tag">#css</a>
                                <a href="" class="blog-tag">#selectors</a>
                                <a href="" class="blog-tag">#webdesign</a>
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
