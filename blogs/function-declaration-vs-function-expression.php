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

    <title>Function Declaration vs Function Expression: What’s the Difference? - Veeshal D. Bodosa</title>
    <meta name="description" content="Learn the difference between JavaScript function declarations and function expressions with simple examples, hoisting basics, and practical use cases.">
    <meta name="keywords" content="JavaScript, Function Declaration, Function Expression, Hoisting, Functions, webdevcohort2026">
    <meta name="author" content="Veeshal D. Bodosa">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="https://veeshal.me/blogs/function-declaration-vs-function-expression">
    <meta property="og:title" content="Function Declaration vs Function Expression: What’s the Difference?">
    <meta property="og:description" content="A beginner-friendly comparison of JavaScript function declarations and function expressions.">
    <meta property="og:image" content="https://blog.thitainfo.com/_next/image?url=https%3A%2F%2Fcdn.hashnode.com%2Fuploads%2Fcovers%2F6185effafd5d634d0169926f%2Fc896a9b8-0227-4b9a-9323-6d48e02e2427.png&w=3840&q=75">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://veeshal.me/blogs/function-declaration-vs-function-expression">
    <meta property="twitter:title" content="Function Declaration vs Function Expression: What’s the Difference?">
    <meta property="twitter:description" content="A beginner-friendly comparison of JavaScript function declarations and function expressions.">
    <meta property="twitter:image" content="https://blog.thitainfo.com/_next/image?url=https%3A%2F%2Fcdn.hashnode.com%2Fuploads%2Fcovers%2F6185effafd5d634d0169926f%2Fc896a9b8-0227-4b9a-9323-6d48e02e2427.png&w=3840&q=75">
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
                                    <li><a href="#what-are-functions" class="toc-link">What Are Functions?</a></li>
                                    <li><a href="#function-declaration" class="toc-link">Function Declaration</a></li>
                                    <li><a href="#function-expression" class="toc-link">Function Expression</a></li>
                                    <li><a href="#key-differences" class="toc-link">Key Differences</a></li>
                                    <li><a href="#hoisting" class="toc-link">Basic Hoisting Idea</a></li>
                                    <li><a href="#when-to-use" class="toc-link">When to Use Each</a></li>
                                    <li><a href="#assignment" class="toc-link">Practice Assignment</a></li>
                                    <li><a href="#conclusion" class="toc-link">Conclusion</a></li>
                                </ul>
                            </nav>
                        </div>
                    </aside>

                    <div class="blog-main-content">
                        <header class="blog-header">
                            <h1>Function Declaration vs Function Expression: What’s the Difference?</h1>
                            <div class="blog-meta-row">
                                <div class="meta-category">JavaScript</div>
                                <div class="meta-author">Veeshal D. Bodosa</div>
                                <div class="meta-date">15 Mar 2026</div>
                            </div>
                        </header>

                        <div class="blog-hero-image-wrapper">
                            <img src="https://blog.thitainfo.com/_next/image?url=https%3A%2F%2Fcdn.hashnode.com%2Fuploads%2Fcovers%2F6185effafd5d634d0169926f%2Fc896a9b8-0227-4b9a-9323-6d48e02e2427.png&w=3840&q=75" alt="JavaScript Functions" class="blog-hero-image" style="background: linear-gradient(135deg, #fff6cf, #f2d249); padding: 24px; object-fit: contain;">
                        </div>

                        <article class="article-content">
                            <p class="lead" id="introduction">Functions are one of the most important parts of JavaScript. Instead of repeating the same code again and again, we can put that logic inside a function and reuse it whenever we need it. This makes code cleaner, easier to read, and easier to maintain.</p>

                            <p>In JavaScript, two common ways to define functions are <strong>function declarations</strong> and <strong>function expressions</strong>. They may look similar, but they behave differently in some important ways.</p>

                            <h2 id="what-are-functions">1. What Functions Are and Why We Need Them</h2>
                            <p>A function is a reusable block of code that performs a task.</p>

                            <div class="code-block">
function add(a, b) {
    return a + b;
}

console.log(add(2, 3));
// 5
                            </div>

                            <p>Without functions, you would have to rewrite the same logic every time. Functions help avoid repetition.</p>

                            <h2 id="function-declaration">2. Function Declaration Syntax</h2>
                            <p>A function declaration defines a named function using the <code>function</code> keyword.</p>

                            <div class="code-block">
function multiply(a, b) {
    return a * b;
}

console.log(multiply(4, 5));
// 20
                            </div>

                            <p>This is called a declaration because the function is declared directly in the code with its name.</p>

                            <h2 id="function-expression">3. Function Expression Syntax</h2>
                            <p>A function expression stores a function inside a variable.</p>

                            <div class="code-block">
const multiply = function(a, b) {
    return a * b;
};

console.log(multiply(4, 5));
// 20
                            </div>

                            <p>The logic is the same, but the function is now treated like a value assigned to a variable.</p>

                            <div class="mermaid">
                            flowchart LR
                                A["Function Declaration"] --> B["function add(a, b) { ... }"]
                                C["Function Expression"] --> D["const add = function(a, b) { ... }"]
                            </div>

                            <h2 id="key-differences">4. Key Differences Between Declaration and Expression</h2>
                            <p>Let us compare them side by side:</p>

                            <div class="code-block">
// Function Declaration
function greetOne(name) {
    return "Hello " + name;
}

// Function Expression
const greetTwo = function(name) {
    return "Hello " + name;
};
                            </div>

                            <p>Main differences:</p>
                            <ul>
                                <li>a declaration stands on its own</li>
                                <li>an expression is stored in a variable</li>
                                <li>declarations are hoisted differently from expressions</li>
                            </ul>

                            <h2 id="hoisting">5. Basic Idea of Hoisting</h2>
                            <p>At a high level, hoisting means JavaScript prepares some declarations before the code runs.</p>

                            <h3>Function declaration before definition</h3>
                            <div class="code-block">
console.log(add(2, 3));

function add(a, b) {
    return a + b;
}
// 5
                            </div>

                            <p>This works because function declarations are hoisted.</p>

                            <h3>Function expression before definition</h3>
                            <div class="code-block">
// console.log(add(2, 3)); // Error

const add = function(a, b) {
    return a + b;
};
                            </div>

                            <p>This does <strong>not</strong> work the same way. The variable exists only after its assignment line runs, so you should not call a function expression before defining it.</p>

                            <div class="mermaid">
                            flowchart TD
                                A["Code starts"] --> B["Function declaration can be called"]
                                A --> C["Function expression must wait for assignment"]
                            </div>

                            <p>Keep the hoisting idea simple for now:</p>
                            <ul>
                                <li><strong>Function declaration:</strong> can usually be called before it appears in the code</li>
                                <li><strong>Function expression:</strong> should be used after the assignment line</li>
                            </ul>

                            <h2 id="when-to-use">6. When to Use Each Type</h2>
                            <p>Use a <strong>function declaration</strong> when you want a named reusable function that is easy to find and can be used earlier in the file.</p>

                            <div class="code-block">
function calculateTotal(price, tax) {
    return price + tax;
}
                            </div>

                            <p>Use a <strong>function expression</strong> when you want to store a function in a variable, pass it around, or keep it connected to a specific part of the code.</p>

                            <div class="code-block">
const calculateTotal = function(price, tax) {
    return price + tax;
};
                            </div>

                            <p>For beginners, a practical rule is:</p>
                            <ul>
                                <li>use declarations for general reusable functions</li>
                                <li>use expressions when functions are assigned to variables or used in callbacks later</li>
                            </ul>

                            <h2 id="assignment">7. Practice Assignment</h2>
                            <p>Try this in your browser console:</p>

                            <div class="code-block">
function multiplyOne(a, b) {
    return a * b;
}

const multiplyTwo = function(a, b) {
    return a * b;
};

console.log(multiplyOne(3, 4));
console.log(multiplyTwo(3, 4));

console.log(testDeclaration(2, 5));
function testDeclaration(a, b) {
    return a * b;
}

// console.log(testExpression(2, 5)); // Error
const testExpression = function(a, b) {
    return a * b;
};
                            </div>

                            <p>What to observe:</p>
                            <ul>
                                <li>both functions can do the same job</li>
                                <li>the declaration works before its definition</li>
                                <li>the expression should be called only after assignment</li>
                            </ul>

                            <h2 id="conclusion">Conclusion</h2>
                            <p>Function declarations and function expressions both help you create reusable logic in JavaScript, but they are written differently and behave differently with hoisting.</p>

                            <p>Keep the main idea in mind: declarations are hoisted more clearly, while expressions depend on when the variable gets assigned. Once this difference becomes clear, reading and writing JavaScript functions gets much easier.</p>
                        </article>
                    </div>

                    <aside class="blog-sidebar-right">
                        <div class="sidebar-tags-wrapper">
                            <h3 class="sidebar-title">Tags</h3>
                            <div class="blog-tags">
                                <a href="" class="blog-tag">#javascript</a>
                                <a href="" class="blog-tag">#functions</a>
                                <a href="" class="blog-tag">#hoisting</a>
                                <a href="" class="blog-tag">#functionexpression</a>
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
