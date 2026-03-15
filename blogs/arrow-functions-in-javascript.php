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

    <title>Arrow Functions in JavaScript: A Simpler Way to Write Functions - Veeshal D. Bodosa</title>
    <meta name="description" content="Learn JavaScript arrow functions with simple examples, syntax breakdowns, implicit return, and beginner-friendly comparisons with normal functions.">
    <meta name="keywords" content="JavaScript, Arrow Functions, ES6, Functions, Implicit Return, Syntax, map, webdevcohort2026">
    <meta name="author" content="Veeshal D. Bodosa">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="https://veeshal.me/blogs/arrow-functions-in-javascript">
    <meta property="og:title" content="Arrow Functions in JavaScript: A Simpler Way to Write Functions">
    <meta property="og:description" content="A beginner-friendly guide to writing shorter, cleaner JavaScript functions with arrow syntax.">
    <meta property="og:image" content="https://upload.wikimedia.org/wikipedia/commons/6/6a/JavaScript-logo.png">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://veeshal.me/blogs/arrow-functions-in-javascript">
    <meta property="twitter:title" content="Arrow Functions in JavaScript: A Simpler Way to Write Functions">
    <meta property="twitter:description" content="A beginner-friendly guide to writing shorter, cleaner JavaScript functions with arrow syntax.">
    <meta property="twitter:image" content="https://upload.wikimedia.org/wikipedia/commons/6/6a/JavaScript-logo.png">
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
                                    <li><a href="#what-are-arrow-functions" class="toc-link">What Are Arrow Functions?</a></li>
                                    <li><a href="#basic-syntax" class="toc-link">Basic Syntax</a></li>
                                    <li><a href="#one-parameter" class="toc-link">One Parameter</a></li>
                                    <li><a href="#multiple-parameters" class="toc-link">Multiple Parameters</a></li>
                                    <li><a href="#implicit-vs-explicit" class="toc-link">Implicit vs Explicit Return</a></li>
                                    <li><a href="#difference-normal-vs-arrow" class="toc-link">Arrow vs Normal Function</a></li>
                                    <li><a href="#assignment" class="toc-link">Practice Assignment</a></li>
                                    <li><a href="#conclusion" class="toc-link">Conclusion</a></li>
                                </ul>
                            </nav>
                        </div>
                    </aside>

                    <div class="blog-main-content">
                        <header class="blog-header">
                            <h1>Arrow Functions in JavaScript: A Simpler Way to Write Functions</h1>
                            <div class="blog-meta-row">
                                <div class="meta-category">JavaScript</div>
                                <div class="meta-author">Veeshal D. Bodosa</div>
                                <div class="meta-date">15 Mar 2026</div>
                            </div>
                        </header>

                        <div class="blog-hero-image-wrapper">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/6/6a/JavaScript-logo.png" alt="JavaScript Logo" class="blog-hero-image" style="background: #f7df1e; padding: 24px; object-fit: contain;">
                        </div>

                        <article class="article-content">
                            <p class="lead" id="introduction">Before arrow functions, writing small JavaScript functions often meant extra boilerplate: the <code>function</code> keyword, braces, and sometimes a full <code>return</code> statement for even tiny operations. Arrow functions make that syntax shorter and easier to read.</p>

                            <p>They are part of modern JavaScript and you will see them everywhere, especially in callbacks, array methods, and React code. In this article, we will focus only on the beginner-friendly parts so the idea stays simple and clear.</p>

                            <h2 id="what-are-arrow-functions">1. What Are Arrow Functions?</h2>
                            <p>Arrow functions are a shorter way to write function expressions in JavaScript. They use the <code>=&gt;</code> syntax, which looks like an arrow.</p>

                            <div class="code-block">
function greet(name) {
    return "Hello " + name;
}

const greetArrow = (name) => {
    return "Hello " + name;
};
                            </div>

                            <p>Both functions do the same job. The arrow version simply removes some extra syntax.</p>

                            <div class="mermaid">
                            graph LR
                                A[function greet(name) { return name; }] --> B[Remove function keyword]
                                B --> C[Add =&gt; between parameters and body]
                                C --> D[const greet = (name) =&gt; { return name; }]
                            </div>

                            <h2 id="basic-syntax">2. Basic Arrow Function Syntax</h2>
                            <p>Here is the basic shape:</p>

                            <div class="code-block">
const functionName = (parameters) => {
    return value;
};
                            </div>

                            <p>Break it into parts:</p>
                            <ul>
                                <li><strong><code>const functionName</code>:</strong> stores the function in a variable</li>
                                <li><strong><code>(parameters)</code>:</strong> input values</li>
                                <li><strong><code>=&gt;</code>:</strong> arrow syntax</li>
                                <li><strong><code>{ }</code>:</strong> function body</li>
                                <li><strong><code>return</code>:</strong> sends a value back</li>
                            </ul>

                            <div class="mermaid">
                            graph TD
                                A[const add] --> B[(a, b)]
                                B --> C[=&gt;]
                                C --> D[{ return a + b; }]
                            </div>

                            <h2 id="one-parameter">3. Arrow Functions with One Parameter</h2>
                            <p>If there is only <strong>one parameter</strong>, parentheses are optional.</p>

                            <div class="code-block">
const square = num => {
    return num * num;
};

console.log(square(4));
// 16
                            </div>

                            <p>You can also keep the parentheses if you want. Both are valid:</p>

                            <div class="code-block">
const squareOne = num => num * num;
const squareTwo = (num) => num * num;
                            </div>

                            <h2 id="multiple-parameters">4. Arrow Functions with Multiple Parameters</h2>
                            <p>If there are two or more parameters, parentheses are required.</p>

                            <div class="code-block">
const add = (a, b) => {
    return a + b;
};

console.log(add(5, 3));
// 8
                            </div>

                            <p>Another simple example:</p>

                            <div class="code-block">
const greetUser = (firstName, lastName) => {
    return "Hello " + firstName + " " + lastName;
};

console.log(greetUser("Vee", "Bodosa"));
// Hello Vee Bodosa
                            </div>

                            <h2 id="implicit-vs-explicit">5. Implicit Return vs Explicit Return</h2>
                            <p>This is one of the biggest reasons arrow functions feel short.</p>

                            <h3>Explicit return</h3>
                            <p>If you use curly braces <code>{ }</code>, you usually write <code>return</code> yourself.</p>

                            <div class="code-block">
const multiply = (a, b) => {
    return a * b;
};
                            </div>

                            <h3>Implicit return</h3>
                            <p>If the function has just one expression, you can remove the braces and <code>return</code>. JavaScript returns the value automatically.</p>

                            <div class="code-block">
const multiplyShort = (a, b) => a * b;
                            </div>

                            <p>Compare them:</p>

                            <div class="code-block">
const sayHiLong = (name) => {
    return "Hi " + name;
};

const sayHiShort = name => "Hi " + name;
                            </div>

                            <p>The result is the same, but the second version is shorter. This is called <strong>implicit return</strong>.</p>

                            <h2 id="difference-normal-vs-arrow">6. Basic Difference Between Arrow Function and Normal Function</h2>
                            <p>For beginner-level code, the main difference is syntax and readability.</p>

                            <div class="code-block">
function isEven(num) {
    return num % 2 === 0;
}

const isEvenArrow = (num) => {
    return num % 2 === 0;
};
                            </div>

                            <p>Arrow functions are usually:</p>
                            <ul>
                                <li>shorter</li>
                                <li>cleaner for small functions</li>
                                <li>common in modern JavaScript</li>
                            </ul>

                            <p>Normal functions are still useful too. For now, just remember this simple rule: use arrow functions when you want concise modern syntax for small tasks and callbacks.</p>

                            <p>We are intentionally avoiding a deep discussion of <code>this</code> here, because that topic makes more sense after your function basics are strong.</p>

                            <h3>Normal function to arrow function conversion</h3>
                            <div class="code-block">
function addNumbers(a, b) {
    return a + b;
}

const addNumbersArrow = (a, b) => a + b;
                            </div>

                            <h3>Using an arrow function inside <code>map()</code></h3>
                            <div class="code-block">
const numbers = [1, 2, 3, 4];

const doubled = numbers.map(num => num * 2);

console.log(doubled);
// [2, 4, 6, 8]
                            </div>

                            <h2 id="assignment">7. Practice Assignment</h2>
                            <p>Try these in your browser console:</p>

                            <div class="code-block">
function squareNumber(num) {
    return num * num;
}

const squareArrow = num => num * num;

const evenOrOdd = num => {
    if (num % 2 === 0) {
        return "Even";
    }
    return "Odd";
};

const values = [2, 4, 6, 8];
const squares = values.map(num => num * num);

console.log(squareNumber(5));
console.log(squareArrow(5));
console.log(evenOrOdd(7));
console.log(squares);
                            </div>

                            <p>Expected output:</p>
                            <ul>
                                <li><strong><code>squareNumber(5)</code>:</strong> <code>25</code></li>
                                <li><strong><code>squareArrow(5)</code>:</strong> <code>25</code></li>
                                <li><strong><code>evenOrOdd(7)</code>:</strong> <code>"Odd"</code></li>
                                <li><strong><code>squares</code>:</strong> <code>[4, 16, 36, 64]</code></li>
                            </ul>

                            <h2 id="conclusion">Conclusion</h2>
                            <p>Arrow functions are a cleaner and shorter way to write functions in JavaScript. They help reduce boilerplate, improve readability, and are used heavily in modern JS code.</p>

                            <p>Start with simple examples like greetings, math operations, and <code>map()</code> callbacks. Once you are comfortable with the syntax, arrow functions will start feeling natural very quickly.</p>
                        </article>
                    </div>

                    <aside class="blog-sidebar-right">
                        <div class="sidebar-tags-wrapper">
                            <h3 class="sidebar-title">Tags</h3>
                            <div class="blog-tags">
                                <a href="" class="blog-tag">#javascript</a>
                                <a href="" class="blog-tag">#arrowfunctions</a>
                                <a href="" class="blog-tag">#es6</a>
                                <a href="" class="blog-tag">#functions</a>
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
