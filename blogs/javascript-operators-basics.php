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

    <title>JavaScript Operators: The Basics You Need to Know - Veeshal D. Bodosa</title>
    <meta name="description" content="Learn JavaScript operators with simple examples covering arithmetic, comparison, logical, and assignment operators for beginners.">
    <meta name="keywords" content="JavaScript, Operators, Arithmetic, Comparison, Logical, Assignment, ==, ===, webdevcohort2026">
    <meta name="author" content="Veeshal D. Bodosa">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="https://veeshal.me/blogs/javascript-operators-basics">
    <meta property="og:title" content="JavaScript Operators: The Basics You Need to Know">
    <meta property="og:description" content="A beginner-friendly guide to JavaScript operators with practical examples and clear comparisons.">
    <meta property="og:image" content="https://blog.dhiraj.dev/_next/image?url=https%3A%2F%2Fcdn.hashnode.com%2Fuploads%2Fcovers%2F69513de35d3cf3dcde6a6e95%2F4d329a4d-fbed-4bd6-8e18-70a174b094cb.png&w=3840&q=75">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://veeshal.me/blogs/javascript-operators-basics">
    <meta property="twitter:title" content="JavaScript Operators: The Basics You Need to Know">
    <meta property="twitter:description" content="A beginner-friendly guide to JavaScript operators with practical examples and clear comparisons.">
    <meta property="twitter:image" content="https://blog.dhiraj.dev/_next/image?url=https%3A%2F%2Fcdn.hashnode.com%2Fuploads%2Fcovers%2F69513de35d3cf3dcde6a6e95%2F4d329a4d-fbed-4bd6-8e18-70a174b094cb.png&w=3840&q=75">
</head>

<body>
    <div id="home" class="home">
        <div class="homeContainer">
            <?php include 'includes/header.php'; ?>

            <div class="single-blog-container with-sidebar">
                <div class="back-link-wrapper mobile-back-link">
                    <a href="index" class="back-link">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                        Back
                    </a>
                </div>

                <div class="blog-layout-grid">
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
                                    <li><a href="#what-are-operators" class="toc-link">What Are Operators?</a></li>
                                    <li><a href="#arithmetic-operators" class="toc-link">Arithmetic Operators</a></li>
                                    <li><a href="#comparison-operators" class="toc-link">Comparison Operators</a></li>
                                    <li><a href="#logical-operators" class="toc-link">Logical Operators</a></li>
                                    <li><a href="#assignment-operators" class="toc-link">Assignment Operators</a></li>
                                    <li><a href="#assignment" class="toc-link">Practice Assignment</a></li>
                                    <li><a href="#conclusion" class="toc-link">Conclusion</a></li>
                                </ul>
                            </nav>
                        </div>
                    </aside>

                    <div class="blog-main-content">
                        <header class="blog-header">
                            <h1>JavaScript Operators: The Basics You Need to Know</h1>
                            <div class="blog-meta-row">
                                <div class="meta-category">JavaScript</div>
                                <div class="meta-author">Veeshal D. Bodosa</div>
                                <div class="meta-date">15 Mar 2026</div>
                            </div>
                        </header>

                        <div class="blog-hero-image-wrapper">
                            <img src="https://blog.dhiraj.dev/_next/image?url=https%3A%2F%2Fcdn.hashnode.com%2Fuploads%2Fcovers%2F69513de35d3cf3dcde6a6e95%2F4d329a4d-fbed-4bd6-8e18-70a174b094cb.png&w=3840&q=75" alt="JavaScript Operators" class="blog-hero-image" style="background: linear-gradient(135deg, #fff8da, #eed14d); padding: 24px; object-fit: contain;">
                        </div>

                        <article class="article-content">
                            <p class="lead" id="introduction">Operators are symbols that tell JavaScript to perform some action on values. For example, they can add numbers, compare two values, combine conditions, or update a variable. If variables are the boxes that store values, operators are the tools we use to work with those values.</p>

                            <p>In this article, we will focus on the most common operator groups you will use every day: arithmetic, comparison, logical, and assignment operators.</p>

                            <h2 id="what-are-operators">1. What Operators Are</h2>
                            <p>Operators are symbols that perform operations on values.</p>

                            <div class="code-block">
let a = 10;
let b = 5;

console.log(a + b);
// 15
                            </div>

                            <p>Here, the <code>+</code> operator tells JavaScript to add <code>a</code> and <code>b</code>.</p>

                            <div class="mermaid">
                            flowchart TD
                                A["Arithmetic"] --> A1["+ - * / %"]
                                B["Comparison"] --> B1["== === != > <"]
                                C["Logical"] --> C1["&& || !"]
                                D["Assignment"] --> D1["= += -="]
                            </div>

                            <h2 id="arithmetic-operators">2. Arithmetic Operators</h2>
                            <p>Arithmetic operators are used for math operations.</p>

                            <div class="code-block">
let a = 10;
let b = 3;

console.log(a + b); // 13
console.log(a - b); // 7
console.log(a * b); // 30
console.log(a / b); // 3.333...
console.log(a % b); // 1
                            </div>

                            <p>Quick meaning:</p>
                            <ul>
                                <li><code>+</code> adds values</li>
                                <li><code>-</code> subtracts values</li>
                                <li><code>*</code> multiplies values</li>
                                <li><code>/</code> divides values</li>
                                <li><code>%</code> gives the remainder</li>
                            </ul>

                            <p>The remainder operator <code>%</code> is often used to check if a number is even or odd.</p>

                            <div class="code-block">
console.log(10 % 2); // 0
console.log(11 % 2); // 1
                            </div>

                            <h2 id="comparison-operators">3. Comparison Operators</h2>
                            <p>Comparison operators compare values and return either <code>true</code> or <code>false</code>.</p>

                            <div class="code-block">
console.log(5 == "5");   // true
console.log(5 === "5");  // false
console.log(5 != 3);     // true
console.log(10 > 7);     // true
console.log(4 < 2);      // false
                            </div>

                            <p>The most important beginner point is the difference between <code>==</code> and <code>===</code>.</p>

                            <div class="code-block">
console.log(5 == "5");   // true
console.log(5 === "5");  // false
                            </div>

                            <p>Why?</p>
                            <ul>
                                <li><code>==</code> compares value after type conversion</li>
                                <li><code>===</code> compares both value and type</li>
                            </ul>

                            <p>In most cases, beginners should prefer <code>===</code> because it is clearer and safer.</p>

                            <h2 id="logical-operators">4. Logical Operators</h2>
                            <p>Logical operators are used to combine or reverse conditions.</p>

                            <div class="code-block">
let age = 20;
let hasID = true;

console.log(age >= 18 && hasID); // true
console.log(age < 18 || hasID);  // true
console.log(!hasID);             // false
                            </div>

                            <p>Simple meaning:</p>
                            <ul>
                                <li><code>&&</code> means <strong>AND</strong> and returns true only if both conditions are true</li>
                                <li><code>||</code> means <strong>OR</strong> and returns true if at least one condition is true</li>
                                <li><code>!</code> means <strong>NOT</strong> and reverses true to false or false to true</li>
                            </ul>

                            <div class="mermaid">
                            flowchart TD
                                A["true && true"] --> A1["true"]
                                B["true || false"] --> B1["true"]
                                C["!true"] --> C1["false"]
                            </div>

                            <h2 id="assignment-operators">5. Assignment Operators</h2>
                            <p>Assignment operators are used to assign or update values in variables.</p>

                            <div class="code-block">
let score = 10;

score = 15;
console.log(score); // 15

score += 5;
console.log(score); // 20

score -= 3;
console.log(score); // 17
                            </div>

                            <p>Meaning:</p>
                            <ul>
                                <li><code>=</code> assigns a value</li>
                                <li><code>+=</code> adds and updates</li>
                                <li><code>-=</code> subtracts and updates</li>
                            </ul>

                            <h2 id="assignment">6. Practice Assignment</h2>
                            <p>Try this in your browser console:</p>

                            <div class="code-block">
let a = 12;
let b = 4;

console.log(a + b);
console.log(a - b);
console.log(a * b);
console.log(a / b);
console.log(a % b);

console.log(5 == "5");
console.log(5 === "5");

let isStudent = true;
let age = 20;

console.log(isStudent && age >= 18);
console.log(isStudent || age < 18);
console.log(!isStudent);
                            </div>

                            <p>This assignment helps you practice:</p>
                            <ul>
                                <li>basic arithmetic operations</li>
                                <li>the difference between <code>==</code> and <code>===</code></li>
                                <li>small conditions using logical operators</li>
                            </ul>

                            <h2 id="conclusion">Conclusion</h2>
                            <p>Operators are some of the most basic but most useful tools in JavaScript. Arithmetic operators help with calculations, comparison operators help check values, logical operators help combine conditions, and assignment operators help update variables.</p>

                            <p>Keep your practice simple at first. Use small console examples and pay special attention to <code>===</code>, <code>&&</code>, <code>||</code>, and <code>+=</code>, because these appear everywhere in real JavaScript code.</p>
                        </article>
                    </div>

                    <aside class="blog-sidebar-right">
                        <div class="sidebar-tags-wrapper">
                            <h3 class="sidebar-title">Tags</h3>
                            <div class="blog-tags">
                                <a href="" class="blog-tag">#javascript</a>
                                <a href="" class="blog-tag">#operators</a>
                                <a href="" class="blog-tag">#comparison</a>
                                <a href="" class="blog-tag">#logicaloperators</a>
                                <a href="" class="blog-tag">#webdevcohort2026</a>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>

        <?php include 'includes/footer.php'; ?>
    </div>

    <?php include 'includes/footer_resources.php'; ?>
    <script src="../js/singleBlogScript.js"></script>
</body>
</html>
