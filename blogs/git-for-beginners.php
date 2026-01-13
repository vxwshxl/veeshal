<?php
// Simple .env parser (reused from index.php)
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
    <meta name="keywords" content="Git, Version Control, Coding, Web Development, Tutorial, Beginners">
    <meta name="author" content="Veeshal D. Bodosa">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="https://veeshal.me/blogs/git-for-beginners.php">
    <meta property="og:title" content="Git for Beginners: Basics and Essential Commands">
    <meta property="og:description" content="Master the basics of Git version control. A comprehensive guide for beginners covering commands, workflows, and core concepts.">
    <meta property="og:image" content="../assets/working-dir.png">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://veeshal.me/blogs/git-for-beginners.php">
    <meta property="twitter:title" content="Git for Beginners: Basics and Essential Commands">
    <meta property="twitter:description" content="Master the basics of Git version control. A comprehensive guide for beginners covering commands, workflows, and core concepts.">
    <meta property="twitter:image" content="../assets/working-dir.png">
    
    <!-- Code Highlight Format (optional, creating simple styles below) -->
    <!-- Code Highlight Format (styles moved to singleBlogStyles.css) -->
</head>

<body>
    <div id="home" class="home">
        <div class="homeContainer">
            <?php include 'includes/header.php'; ?>

            <!-- Single Blog Post Content -->
            <div class="single-blog-container">
                <div class="back-link-wrapper">
                    <a href="index.php" class="back-link">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                        Back
                    </a>
                </div>
                
                <header class="blog-header">
                    <h1>Git for Beginners: Basics and Essential Commands</h1>
                    <div class="blog-meta-row">
                        <div class="meta-category">
                            Software Development
                        </div>
                        <div class="meta-author">
                            Veeshal D. Bodosa
                        </div>
                        <div class="meta-date">
                            27 Dec 2025
                        </div>
                    </div>
                </header>

                <div class="blog-hero-image-wrapper">
                    <img src="../assets/working-dir.png" alt="Git Working Directory" class="blog-hero-image">
                </div>

                <article class="article-content">
                    <p class="lead">Version control is an essential skill for any developer. In this guide, we'll explore Git, the most popular distributed version control system, and get you up and running with the basics.</p>

                    <h2>What is Git?</h2>
                    <p>Git is a <strong>distributed version control system (DVCS)</strong> created by Linus Torvalds in 2005. It allows multiple developers to work on a project simultaneously without overwriting each other's changes. It tracks the history of changes, allowing you to revert to previous versions if something goes wrong.</p>
                    <p>Unlike centralized systems where the complete codebase resides on a single server, in Git, every developer's computer contains a full copy of the repository, including the entire history of all changes.</p>

                    <h2>Why Git is Used?</h2>
                    <ul>
                        <li><strong>Collaboration</strong>: Multiple people can work on the same project without conflict.</li>
                        <li><strong>History & Backup</strong>: Every change is recorded. You can go back to any previous state.</li>
                        <li><strong>Branching</strong>: You can work on new features in isolation (branches) without affecting the main code.</li>
                        <li><strong>Distributed</strong>: You have a full backup of the project locally. Work offline and push when ready.</li>
                    </ul>

                    <h2>Git Basics and Core Concepts</h2>
                    
                    <h3>1. The Repository (Repo)</h3>
                    <p>A repository is like a project folder that Git tracks. It contains all your project files and the history of changes made to them.</p>

                    <div class="figure-container">
                        <img src="../assets/git-structure.png" alt="Git Repository Structure Diagram" class="blog-diagram">
                        <div class="diagram-caption">Fig 1. Local Repository Structure Overview</div>
                    </div>

                    <h3>2. The Three States</h3>
                    <p>Git has a specific workflow that involves three main states/areas:</p>
                    
                    <div class="figure-container">
                        <img src="../assets/git-flow.png" alt="Git Workflow Diagram" class="blog-diagram">
                        <div class="diagram-caption">Fig 2. The Git Workflow: Working Directory → Staging → Repo</div>
                    </div>
                    
                    <ul>
                        <li><strong>Working Directory</strong>: Where you modify files.</li>
                        <li><strong>Staging Area (Index)</strong>: Where you organize changes before committing them.</li>
                        <li><strong>Repository (HEAD)</strong>: Where Git permanently stores the changes as a "commit".</li>
                    </ul>

                    <h3>3. Commit and Branch</h3>
                    <ul>
                        <li><strong>Commit</strong>: A snapshot of your project at a specific point in time.</li>
                        <li><strong>Branch</strong>: A parallel version of your repository. The default branch is usually called <code>main</code> or <code>master</code>.</li>
                    </ul>
                    
                    <div class="figure-container">
                        <img src="../assets/git-history.png" alt="Git Commit History" class="blog-diagram">
                        <div class="diagram-caption">Fig 3. Commit History Flow</div>
                    </div>

                    <h2>Common Git Commands</h2>
                    <p>Here are the essential commands to get you started with a basic workflow.</p>

                    <h3>1. Setup & Init</h3>
                    <div class="code-block">
                        <span class="comment"># Initialize a new git repository in the current folder</span>
                        <span class="command">git init</span>
                        <br>
                        <span class="comment"># Clone an existing repository from a URL</span>
                        <span class="command">git clone https://github.com/user/repo.git</span>
                    </div>

                    <h3>2. Configuration</h3>
                    <div class="code-block">
                        <span class="comment"># Set your username</span>
                        <span class="command">git config --global user.name "Your Name"</span>
                        <br>
                        <span class="comment"># Set your email</span>
                        <span class="command">git config --global user.email "you@example.com"</span>
                    </div>

                    <h3>3. Typical Workflow</h3>
                    <p>After making changes to your files:</p>
                    <div class="code-block">
                        <span class="comment"># Check the status of your changes</span>
                        <span class="command">git status</span>
                        <br>
                        <span class="comment"># Add a specific file to the staging area</span>
                        <span class="command">git add filename.txt</span>
                        <br>
                        <span class="comment"># Add all changed files to staging</span>
                        <span class="command">git add .</span>
                        <br>
                        <span class="comment"># Commit the changes with a message</span>
                        <span class="command">git commit -m "Add new feature section"</span>
                        <br>
                        <span class="comment"># View the commit history</span>
                        <span class="command">git log</span>
                    </div>

                    <h2>Conclusion</h2>
                    <p>Git is a powerful tool that transforms how developers build software. While it has many more advanced features, these basics are enough to start managing your projects effectively. Start practicing these commands today!</p>
                </article>
            </div>
        </div>

        <!-- Footer -->
        <!-- Footer -->
        <?php include 'includes/footer.php'; ?>
    </div>

    <!-- Toast Notification Container -->
    <?php include 'includes/footer_resources.php'; ?>
    <!-- No blogScript.js needed for this simple page, or we can include empty/relevant scripts -->
</body>
</html>
