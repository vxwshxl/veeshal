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

    <title>Inside Git: How It Works and the Role of the .git Folder - Veeshal D. Bodosa</title>
    <meta name="description" content="Explore the specific internal workings of Git. Understand the .git folder, Git objects (Blob, Tree, Commit), and how Git tracks changes internally.">
    <meta name="keywords" content="Git, Internals, .git folder, Blob, Tree, Commit, Version Control, Coding, Web Development, Tutorial, Beginners, chaicode, chaicohort, webdevcohort2026">
    <meta name="author" content="Veeshal D. Bodosa">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="https://veeshal.me/blogs/inside-git-how-it-works">
    <meta property="og:title" content="Inside Git: How It Works and the Role of the .git Folder">
    <meta property="og:description" content="Dive deep into Git's architecture. Learn about the .git directory, how objects are stored, and the magic behind version control.">
    <meta property="og:image" content="https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/blogs/inside-git/structure.png">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://veeshal.me/blogs/inside-git-how-it-works">
    <meta property="twitter:title" content="Inside Git: How It Works and the Role of the .git Folder">
    <meta property="twitter:description" content="Dive deep into Git's architecture. Learn about the .git directory, how objects are stored, and the magic behind version control.">
    <meta property="twitter:image" content="https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/blogs/inside-git/structure.png">
    
    <!-- Code Highlight Format (optional, creating simple styles below) -->
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
                                    <li><a href="#the-dot-git-folder" class="toc-link">The .git Folder</a></li>
                                    <li><a href="#git-objects" class="toc-link">Git Objects</a></li>
                                    <li><a href="#how-git-tracks" class="toc-link">How Git Tracks Changes</a></li>
                                    <li><a href="#internal-flow" class="toc-link">Internal Flow</a></li>
                                    <li><a href="#conclusion" class="toc-link">Conclusion</a></li>
                                </ul>
                            </nav>
                        </div>
                    </aside>

                    <!-- Main Article Content -->
                    <div class="blog-main-content">
                        <header class="blog-header">
                            <h1>Inside Git: How It Works and the Role of the .git Folder</h1>
                            <div class="blog-meta-row">
                                <div class="meta-category">Software Development</div>
                                <div class="meta-author">Veeshal D. Bodosa</div>
                                <div class="meta-date">16 Jan 2026</div>
                            </div>
                        </header>

                        <div class="blog-hero-image-wrapper">
                            <img src="https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/blogs/inside-git/structure.png" alt="Different Git Objects" class="blog-hero-image">
                        </div>

                        <article class="article-content">
                            <p class="lead" id="introduction">We often use Git commands like <code>git add</code> and <code>git commit</code> without thinking much about what happens under the hood. But understanding Git's internals can give you a powerful mental model, helping you solve complex merge conflicts and understand version control at a deeper level.</p>

                            <h2 id="the-dot-git-folder">The .git Folder: Where the Magic Happens</h2>
                            <p>When you run <code>git init</code> in a directory, Git creates a hidden subfolder named <code>.git</code>. This folder contains everything that makes your project a Git repository. If you delete this folder, all your project's history is lost.</p>
                            
                            <div class="figure-container">
                                <img src="https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/blogs/inside-git/structure.png" alt="Structure of the .git directory" class="blog-diagram">
                                <div class="diagram-caption">Fig 1. Inside the .git directory</div>
                            </div>

                            <p>Here are some of the key components inside:</p>
                            <ul>
                                <li><strong>HEAD:</strong> A pointer to the current branch reference you're working on.</li>
                                <li><strong>config:</strong> Contains local configuration settings for your repository.</li>
                                <li><strong>objects/:</strong> The database where all content (files, commits) is stored.</li>
                                <li><strong>refs/:</strong> Stores pointers to commit objects (branches, tags).</li>
                                <li><strong>index:</strong> (or Stage) The binary file that stores staging area information.</li>
                            </ul>

                            <h2 id="git-objects">Git Objects: Blob, Tree, and Commit</h2>
                            <p>Git is essentially a content-addressable filesystem. It stores data as a set of objects in the <code>.git/objects</code> directory. There are three main types:</p>

                            <div class="figure-container">
                                <img src="https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/blogs/inside-git/objects.png" alt="Git Objects Relationship" class="blog-diagram">
                                <div class="diagram-caption">Fig 2. The relationship between Commit, Tree, and Blob objects</div>
                            </div>

                            <h3>1. Blob (Binary Large Object)</h3>
                            <p>A blob stores the <strong>content</strong> of a file. It doesn't store the filename or metadata, just the raw data. If you have two files with identical content, Git stores only one blob.</p>

                            <h3>2. Tree</h3>
                            <p>A tree is like a directory. It maps filenames to blobs (files) or other trees (subdirectories). It captures the structure of your project.</p>

                            <h3>3. Commit</h3>
                            <p>A commit object wraps everything together. It points to a top-level tree (snapshot of the project), and contains metadata like:</p>
                            <ul>
                                <li>Author and Committer information</li>
                                <li>Commit message</li>
                                <li>Pointer to the <strong>parent commit</strong> (forming the history chain)</li>
                            </ul>

                            <h2 id="how-git-tracks">How Git Tracks Changes</h2>
                            <p>Git uses <strong>SHA-1 hashes</strong> to identify everything. When you save a file, Git calculates a 40-character hash based on its content (e.g., <code>e69de29bb2d1d6434b8b29ae775ad8c2e48c5391</code>). This ensures integrity: if a single bit of data changes, the hash changes completely.</p>
                            <p>This means Git doesn't just store "changes" or "diffs" per se; it stores snapshots. However, it's smart enough to be efficient about storage.</p>

                            <h2 id="internal-flow">The Internal Flow: git add & git commit</h2>
                            <p>Let's visualize the data flow when you run commands:</p>

                            <div class="figure-container">
                                <img src="https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/blogs/inside-git/flow.png" alt="Git Internal Flow Diagram" class="blog-diagram">
                                <div class="diagram-caption">Fig 3. Data flow from Working Directory to Repository</div>
                            </div>

                            <ol>
                                <li><strong>Working Directory:</strong> You create or modify a file.</li>
                                <li><strong>git add:</strong> Git creates a <strong>blob</strong> of your file's current content, stores it in the objects database, and updates the <strong>index</strong> to point to this new blob.</li>
                                <li><strong>git commit:</strong> Git creates a <strong>tree</strong> object representing the current directory structure (from the index) and a <strong>commit</strong> object pointing to that tree. The commit also points to the previous commit (parent), advancing the HEAD.</li>
                            </ol>

                            <h2 id="conclusion">Conclusion</h2>
                            <p>By understanding the <code>.git</code> folder and the trio of Blob, Tree, and Commit objects, you move from memorizing commands to understanding the system. Git is simple but powerful: a directed acyclic graph (DAG) of commits representing snapshots of your project over time.</p>
                        </article>
                    </div>

                    <!-- Right Sidebar (Tags) -->
                    <aside class="blog-sidebar-right">
                        <div class="sidebar-tags-wrapper">
                            <h3 class="sidebar-title">Tags</h3>
                            <div class="blog-tags">
                                <a href="" class="blog-tag">#git</a>
                                <a href="" class="blog-tag">#internals</a>
                                <a href="" class="blog-tag">#version-control</a>
                                <a href="" class="blog-tag">#chaicode</a>
                                <a href="" class="blog-tag">#webdevcohort2026</a>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
    </div>
    </div>

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>
</div>

    <!-- Toast Notification Container -->
    <?php include 'includes/footer_resources.php'; ?>
    <script src="../js/singleBlogScript.js"></script>
</body>
</html>
