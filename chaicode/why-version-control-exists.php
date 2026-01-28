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

    <title>Why Version Control Exists: The Pendrive Problem - Veeshal D. Bodosa</title>
    <meta name="description" content="Discover why version control is essential in software development. From the chaos of pendrive file transfers to the structured world of Git.">
    <meta name="keywords" content="Version Control, Git, Pendrive Problem, Software Development, Collaboration, History, Coding, Web Development, Tutorial, Beginners, chaicode, chaicohort, webdevcohort2026">
    <meta name="author" content="Veeshal D. Bodosa">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="https://veeshal.me/blogs/why-version-control-exists">
    <meta property="og:title" content="Why Version Control Exists: The Pendrive Problem">
    <meta property="og:description" content="From 'final_v2_really_final' folders to Git: The evolution of collaboration in software development.">
    <meta property="og:image" content="https://veeshal.me/assets/blogs/why-version-control/pendrive-vs-git.png">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://veeshal.me/blogs/why-version-control-exists">
    <meta property="twitter:title" content="Why Version Control Exists: The Pendrive Problem">
    <meta property="twitter:description" content="From 'final_v2_really_final' folders to Git: The evolution of collaboration in software development.">
    <meta property="twitter:image" content="https://veeshal.me/assets/blogs/why-version-control/pendrive-vs-git.png">
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
                                    <li><a href="#pendrive-era" class="toc-link">The Pendrive Era</a></li>
                                    <li><a href="#the-chaos" class="toc-link">The Chaos of Manual Sync</a></li>
                                    <li><a href="#enter-vcs" class="toc-link">Enter Version Control</a></li>
                                    <li><a href="#conclusion" class="toc-link">Conclusion</a></li>
                                </ul>
                            </nav>
                        </div>
                    </aside>

                    <!-- Main Article Content -->
                    <div class="blog-main-content">
                        <header class="blog-header">
                            <h1>Why Version Control Exists: The Pendrive Problem</h1>
                            <div class="blog-meta-row">
                                <div class="meta-category">Software Development</div>
                                <div class="meta-author">Veeshal D. Bodosa</div>
                                <div class="meta-date">16 Jan 2026</div>
                            </div>
                        </header>

                        </header>

                        <div class="blog-hero-image-wrapper">
                             <img src="https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/blogs/why-version-control/pendrive-vs-git.png" alt="Pendrive vs Git Workflow" class="blog-hero-image">
                        </div>

                        <article class="article-content">
                            <p class="lead" id="introduction">Imagine you are working on a college project with three friends. The deadline is tomorrow. You finish your part of the code and pass it to your friend on a pendrive. They add their code, delete some of yours by mistake, and pass it to the third person. By the time it comes back to you, the code is broken, and no one knows who changed what.</p>
                            
                            <p>This nightmare is exactly why Version Control Systems (VCS) like Git exist.</p>

                            <h2 id="pendrive-era">The Pendrive Era & "Final" Folders</h2>
                            <p>Before tools like Git were standard, collaboration was physical and messy. Developers literally used pendrives to share code.</p>
                            
                            <p>Even if you were working alone, you likely had a folder structure that looked like this:</p>
                            
                            <div class="figure-container">
                                <img src="https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/blogs/why-version-control/folder-chaos.png" alt="Manual Versioning Chaos" class="blog-diagram">
                                <div class="diagram-caption">Fig 1. The familiar chaos of manual versioning</div>
                            </div>
                            
                            <p>You would create backup copies of your entire project folder before making a risky change. If the change failed, you’d delete the current folder and unzip the backup. It was manual, error-prone, and inefficient.</p>

                            <h2 id="the-chaos">The Chaos of Manual Sync</h2>
                            <p>Here are the specific problems with the "Pendrive" or "Email" method of collaboration:</p>
                            <ul>
                                <li><strong>Overwriting Code:</strong> If two people edit the same file at the same time and try to merge them manually, one person's changes often get wiped out.</li>
                                <li><strong>No History:</strong> "Why did this button stop working?" With manual backups, you can't easily see <em>who</em> changed a specific line of code or <em>why</em>.</li>
                                <li><strong>Single Point of Failure:</strong> If the person with the "latest" code on their laptop crashes their hard drive, the project is gone.</li>
                                <li><strong>Collaboration Hell:</strong> You spend more time merging code and fixing integration bugs than actually writing features.</li>
                            </ul>

                            <h2 id="enter-vcs">Enter Version Control</h2>
                            <p>Version Control Systems automate the tracking of changes. It’s like a time machine for your code.</p>
                            
                            <p>With Git, you stop thinking about "files" and start thinking about "snapshots" of your project over time. It solves the pendrive problems effectively:</p>

                             <div class="figure-container">
                                <img src="https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/blogs/why-version-control/git-timeline.png" alt="Git Timeline Clean and Organized" class="blog-diagram">
                                <div class="diagram-caption">Fig 2. The clean, linear history provided by Git</div>
                            </div>

                            <ul>
                                <li><strong>Collaboration:</strong> Multiple people can work on the same file without overwriting each other (mostly). Git handles the merging logic.</li>
                                <li><strong>History & Blame:</strong> You can see exactly who wrote every line of code (<code>git blame</code>) and the message explaining why (<code>git log</code>).</li>
                                <li><strong>Safety:</strong> You can experiment on a "branch". If it works, you merge it. If it breaks, you just delete the branch, keeping your main code safe.</li>
                                <li><strong>Distributed Backup:</strong> Every developer has a full copy of the project history. If the main server goes down, any team member's computer can restore the repository.</li>
                            </ul>

                            <h2 id="conclusion">Conclusion</h2>
                            <p>The transition from "Final_v2.zip" to <code>git commit</code> was a revolution in software engineering. While Git has a learning curve, it prevents the heart-stopping moment of losing days of work. It turns the chaos of collaboration into a structured, manageable history.</p>
                            
                            <p>So next time you feel frustrated with a merge conflict, just remember: it's still better than passing around a pendrive.</p>
                        </article>
                    </div>

                    <!-- Right Sidebar (Tags) -->
                    <aside class="blog-sidebar-right">
                        <div class="sidebar-tags-wrapper">
                            <h3 class="sidebar-title">Tags</h3>
                            <div class="blog-tags">
                                <a href="" class="blog-tag">#version-control</a>
                                <a href="" class="blog-tag">#git</a>
                                <a href="" class="blog-tag">#collaboration</a>
                                <a href="" class="blog-tag">#history</a>
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
