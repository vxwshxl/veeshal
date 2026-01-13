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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Git for Beginners: Basics and Essential Commands. Learn what Git is, why use it, and how to start version controlling your projects.">
    <meta name="keywords" content="Git, Version Control, Coding, Web Development, Tutorial, Beginners">
    <meta name="author" content="Veeshal D. Bodosa">
    <meta name="theme-color" content="#000000">

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

    <link rel="icon" type="image/png" href="../favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="../favicon.svg" />
    <link rel="shortcut icon" href="../favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="../apple-touch-icon.png" />
    <link rel="manifest" href="../site.webmanifest" />

    <title>Git for Beginners - Veeshal D. Bodosa</title>

    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/blogsStyles.css">
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Code Highlight Format (optional, creating simple styles below) -->
    <style>
        /* Specific Styles for Single Blog Post */
        /* Overriding global paddings for this page if necessary */
        
        .single-blog-container {
            max-width: 800px;
            margin: 0 auto;
            /* Default desktop padding */
            padding: 60px 20px;
        }

        .back-link-wrapper {
            margin-bottom: 30px;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            color: #666;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            transition: color 0.2s;
        }
        
        .back-link:hover {
            color: #000;
        }
        
        .back-link svg {
            margin-right: 8px;
            width: 16px;
            height: 16px;
        }

        .blog-header {
            text-align: left;
            margin-bottom: 40px;
        }

        .blog-header h1 {
            font-size: 2.8rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 24px;
            color: #000;
            letter-spacing: -0.02em;
        }

        .blog-meta-row {
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 0.95rem;
            color: #666;
            flex-wrap: wrap;
        }
        
        .meta-item {
            display: flex;
            align-items: center;
            gap: 6px;
        }
        
        .meta-separator {
            width: 4px;
            height: 4px;
            background-color: #ccc;
            border-radius: 50%;
        }

        .author-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
            border: 1px solid #eee;
        }

        .blog-hero-image-wrapper {
            width: 100%;
            margin-bottom: 50px;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
            background-color: #f0f0f0;
        }
        
        .blog-hero-image {
            width: 100%;
            height: auto;
            display: block;
            transition: transform 0.3s ease;
        }
        
        /* content styling */
        .article-content {
            font-size: 1.125rem;
            line-height: 1.75;
            color: #222;
            font-family: 'Inter', sans-serif;
        }
        
        .article-content .lead {
            font-size: 1.35rem;
            line-height: 1.6;
            color: #444;
            margin-bottom: 40px;
            font-weight: 400;
        }

        .article-content h2 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-top: 60px;
            margin-bottom: 24px;
            color: #000;
            letter-spacing: -0.01em;
        }

        .article-content h3 {
            font-size: 1.4rem;
            font-weight: 600;
            margin-top: 40px;
            margin-bottom: 16px;
            color: #000;
        }

        .article-content p {
            margin-bottom: 24px;
            color: #333;
        }

        .article-content ul, .article-content ol {
            margin-bottom: 30px;
            padding-left: 20px;
        }
        
        .article-content li {
            margin-bottom: 12px;
            padding-left: 8px;
        }
        
        /* Code blocks */
        .code-block {
            background-color: #1e1e1e;
            color: #ddd;
            padding: 24px;
            border-radius: 12px;
            font-family: 'Courier New', Courier, monospace;
            font-size: 0.95rem;
            overflow-x: auto;
            margin: 30px 0;
            border: 1px solid #333;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .command {
            color: #F9B646;
            font-weight: 600;
            display: block;
            margin-bottom: 8px;
        }
        
        .command:last-child {
            margin-bottom: 0;
        }

        .comment {
            color: #888;
            display: block;
            margin-bottom: 4px;
            font-style: italic;
        }
        
        /* Diagrams */
        .figure-container {
            margin: 50px 0;
            text-align: center;
        }

        .blog-diagram {
            width: 100%;
            height: auto;
            border-radius: 12px;
            border: 1px solid #e5e5e5;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            background: #fff;
        }
        
        .diagram-caption {
            margin-top: 15px;
            font-size: 0.9rem;
            color: #666;
            font-style: italic;
        }

        /* Mobile Adjustments */
        @media (max-width: 768px) {
            .single-blog-container {
                /* Reduce side padding significantly on mobile */
                padding: 30px 0; /* Let the container handle horizontal spacing */
            }
            
            /* Home container padding override via specificity if needed, 
               but here we are inside .single-blog-container */
            
            .blog-header h1 {
                font-size: 2.2rem;
            }
            
            .blog-meta-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }
            
            .meta-separator {
                display: none;
            }
            
            .article-content {
                font-size: 1.05rem;
            }
            
            .article-content .lead {
                font-size: 1.2rem;
            }

            /* Diagram full width on mobile */
            .blog-diagram {
                border-radius: 8px;
            }
        }
    </style>
</head>

<body>
    <div id="home" class="home">
        <div class="homeContainer">
            <div class="top">
                <!-- Header/Navigation -->
                <div class="space-up"></div>
                <hr class="line">
                <header>
                    <div class="logo">
                        <a href="../index.php"><img src="../assets/logo.png"></a>
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
                        <img src="../assets/india.png" alt="Made in India">
                    </div>
                </header>
                <hr class="line">
            </div>

            <!-- Single Blog Post Content -->
            <div class="single-blog-container">
                <div class="back-link-wrapper">
                    <a href="index.php" class="back-link">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                        Back to Blogs
                    </a>
                </div>
                
                <header class="blog-header">
                    <h1>Git for Beginners: Basics and Essential Commands</h1>
                    <div class="blog-meta-row">
                        <div class="meta-item">
                            <!-- Could put avatar here -->
                            <span style="font-weight: 600; color: #000;">Veeshal D. Bodosa</span>
                        </div>
                        <div class="meta-separator"></div>
                        <div class="meta-item">
                            27 Dec 2025
                        </div>
                        <div class="meta-separator"></div>
                        <div class="meta-item" style="color: #F9B646; font-weight: 600;">
                            Software Development
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
        <div class="footer">
            <div class="footerContainer">
                <div class="top">
                    <!-- Footer/Navigation -->
                    <hr class="line">
                    <div class="space-up"></div>
                    <footer>
                        <div class="logo">
                            <a href="../index.php"><img src="../assets/logo.png"></a>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <!-- No blogScript.js needed for this simple page, or we can include empty/relevant scripts -->
</body>
</html>
