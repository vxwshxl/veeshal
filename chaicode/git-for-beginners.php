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

    <title>Git for Beginners - Veeshal D. Bodosa</title>
    <meta name="description" content="Git for Beginners: Basics and Essential Commands. Learn what Git is, why use it, and how to start version controlling your projects.">
    <meta name="keywords" content="Git, Version Control, Coding, Web Development, Tutorial, Beginners, github, version-control-systems, repository, chaicode, chaicohort, webdevcohort2026, masterji">
    <meta name="author" content="Veeshal D. Bodosa">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="https://veeshal.me/blogs/git-for-beginners">
    <meta property="og:title" content="Git for Beginners: Basics and Essential Commands">
    <meta property="og:description" content="Master the basics of Git version control. A comprehensive guide for beginners covering commands, workflows, and core concepts.">
    <meta property="og:image" content="https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/blogs/git-for-beginners/working-dir.png">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://veeshal.me/blogs/git-for-beginners">
    <meta property="twitter:title" content="Git for Beginners: Basics and Essential Commands">
    <meta property="twitter:description" content="Master the basics of Git version control. A comprehensive guide for beginners covering commands, workflows, and core concepts.">
    <meta property="twitter:image" content="https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/blogs/git-for-beginners/working-dir.png">
    
    <!-- Code Highlight Format (optional, creating simple styles below) -->
    <!-- Code Highlight Format (styles moved to singleBlogStyles.css) -->
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
                                    <li><a href="#what-is-git" class="toc-link">What is Git?</a></li>
                                    <li><a href="#why-git" class="toc-link">Why is Git Used?</a></li>
                                    <li><a href="#life-before-git" class="toc-link">Life Before Git</a></li>
                                    <li><a href="#git-basics" class="toc-link">Git Basics & Terminologies</a></li>
                                    <li><a href="#common-commands" class="toc-link">Common Git Commands</a></li>
                                    
                                    <!-- Indented sub-sections for commands -->
                                    <li style="margin-left: 15px;"><a href="#start-git" class="toc-link">Start Git in a Project</a></li>
                                    <li style="margin-left: 15px;"><a href="#check-changes" class="toc-link">Check What Changed</a></li>
                                    <li style="margin-left: 15px;"><a href="#stage-changes" class="toc-link">Stage the Changes</a></li>
                                    <li style="margin-left: 15px;"><a href="#save-snapshot" class="toc-link">Save a Snapshot</a></li>
                                    <li style="margin-left: 15px;"><a href="#view-customs" class="toc-link">View Past Commits</a></li>
                                    
                                    <li><a href="#repo-structure" class="toc-link">Local Repository Structure</a></li>
                                    <li><a href="#conclusion" class="toc-link">Conclusion</a></li>
                                </ul>
                            </nav>
                        </div>
                        

                    </aside>

                    <!-- Main Article Content -->
                    <div class="blog-main-content">
                        <header class="blog-header">
                            <h1>Git for Beginners: Basics and Essential Commands</h1>
                            <div class="blog-meta-row">
                                <div class="meta-category">Software Development</div>
                                <div class="meta-author">Veeshal D. Bodosa</div>
                                <div class="meta-date">13 Jan 2026</div>
                            </div>
                        </header>

                        <div class="blog-hero-image-wrapper">
                            <img src="https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/blogs/git-for-beginners/working-dir.png" alt="Git Working Directory" class="blog-hero-image">
                        </div>

                        <article class="article-content">
                            <p class="lead">Version control is an essential skill for any developer. In this guide, we'll explore Git, the most popular distributed version control system, and get you up and running with the basics.</p>

                            <h2 id="what-is-git">What is Git?</h2>
                            <p>Git is a <strong>distributed version control system (DVCS)</strong> created by Linus Torvalds in 2005. It allows multiple developers to work on a project simultaneously without overwriting each other's changes. It tracks the history of changes, allowing you to revert to previous versions if something goes wrong.</p>
                            
                            <h2 id="why-git">Why is Git Used?</h2>
                            <p>Git has become the industry standard for version control for several compelling reasons:</p>
                            <ul>
                                <li><strong>Collaboration:</strong> Multiple people can work on the same project without conflict using branching and merging.</li>
                                <li><strong>History & Backup:</strong> Every change is recorded. You can go back to any previous state of your project.</li>
                                <li><strong>Branching:</strong> You can work on new features in isolation (branches) without affecting the main code.</li>
                            </ul>

                            <h2 id="life-before-git">Life Before Git</h2>
                            <p>Before systems like Git, developers often used "suffixed files" to manage versions. You might have seen folders like:</p>
                            <ul>
                                <li><code>project_final.zip</code></li>
                                <li><code>project_final_v2.zip</code></li>
                                <li><code>project_final_final_REAL.zip</code></li>
                            </ul>
                            <p>This method is error-prone, hard to merge, and doesn't tell you <em>what</em> changed or <em>who</em> changed it. Git solves this by recording precise "deltas" (changes) and metadata for every modification.</p>

                            <h2 id="git-basics">Git Basics and Core Terminologies</h2>
                            <p>Before diving into commands, it's crucial to understand the three distinct states of a Git project:</p>
                            
                            <div class="figure-container">
                                <img src="https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/blogs/git-for-beginners/git-flow.png" alt="Git Workflow Diagram" class="blog-diagram">
                                <div class="diagram-caption">Fig 1. The Git Workflow: Working Directory → Staging → Repo</div>
                            </div>
                            
                            <ul>
                                <li><strong>Working Directory:</strong> The files you see and edit on your computer.</li>
                                <li><strong>Staging Area (Index):</strong> A holding area for changes you want to commit next.</li>
                                <li><strong>Repository (HEAD):</strong> Where Git permanently stores the snapshots (commits).</li>
                            </ul>

                            <h2 id="common-commands">Common Git Commands</h2>
                            <p>Let's walk through a typical workflow step-by-step.</p>

                            <h3 id="start-git">1. Start Git in a Project</h3>
                            <p>To start tracking a project, you need to initialize a repository.</p>
                            <div class="code-block">
                                <span class="comment"># Initialize a new git repository in the current folder</span>
                                <span class="command">git init</span>
                            </div>
                            <p>This creates a hidden <code>.git</code> folder that tracks your project.</p>

                            <h3 id="check-changes">2. Check What Changed</h3>
                            <p>Whenever you modify files, check their status.</p>
                            <div class="code-block">
                                <span class="command">git status</span>
                            </div>
                            <p>Files will show as "Untracked" or "Modified" in red.</p>

                            <h3 id="stage-changes">3. Stage the Changes</h3>
                            <p>Tell Git which files you want to include in the next save. This moves them to the <strong>Staging Area</strong>.</p>
                            <div class="code-block">
                                <span class="comment"># Add a specific file</span>
                                <span class="command">git add index.html</span>
                                <br>
                                <span class="comment"># Or add all changes</span>
                                <span class="command">git add .</span>
                            </div>

                            <h3 id="save-snapshot">4. Save a Snapshot (Commit)</h3>
                            <p>Permanently save the staged changes to the repository history.</p>
                            <div class="code-block">
                                <span class="command">git commit -m "Initial commit with homepage"</span>
                            </div>

                            <h3 id="view-customs">5. View Past Commits</h3>
                            <p>See a log of all changes made to the project.</p>
                            <div class="code-block">
                                <span class="command">git log</span>
                            </div>
                            
                            <div class="figure-container">
                                <img src="https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/blogs/git-for-beginners/git-history.png" alt="Git History Diagram" class="blog-diagram">
                                <div class="diagram-caption">Fig 2. Visualizing Git History: A timeline of commits</div>
                            </div>

                            <h2 id="repo-structure">Local Repository Structure</h2>
                            <p>Your local Git environment consists of your actual files (Working Directory) and the hidden <code>.git</code> folder (Repository). All the magic happens inside that <code>.git</code> folder, while you work with normal files in your directory.</p>
                            <div class="figure-container">
                                <img src="https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/blogs/git-for-beginners/git-structure.png" alt="Git Repository Structure Diagram" class="blog-diagram">
                                <div class="diagram-caption">Fig 3. Structure of a Git Project</div>
                            </div>

                            <h2 id="conclusion">Conclusion</h2>
                            <p>Git is a powerful tool that transforms how developers build software. While it has many more advanced features like branching and remote repositories (GitHub/GitLab), these basics: <code>init</code>, <code>add</code>, <code>commit</code>, and <code>status </code>are the foundation of your daily workflow.</p>
                        </article>
                    </div>

                    <!-- Right Sidebar (Tags) -->
                    <aside class="blog-sidebar-right">
                        <div class="sidebar-tags-wrapper">
                            <h3 class="sidebar-title">Tags</h3>
                            <div class="blog-tags">
                                <a href="" class="blog-tag">#git</a>
                                <a href="" class="blog-tag">#github</a>
                                <a href="" class="blog-tag">#version-control-systems</a>
                                <a href="" class="blog-tag">#repository</a>
                                <a href="" class="blog-tag">#chaicode</a>
                                <a href="" class="blog-tag">#chaicohort</a>
                                <a href="" class="blog-tag">#webdevcohort2026</a>
                                <a href="" class="blog-tag">#masterji</a>
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
    <!-- No blogScript.js needed for this simple page, or we can include empty/relevant scripts -->
    <!-- Custom Script for Single Blog Post -->
    <script src="../js/singleBlogScript.js"></script>
</body>
</html>
