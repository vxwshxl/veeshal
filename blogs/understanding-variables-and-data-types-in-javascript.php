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

    <title>Understanding Variables and Data Types in JavaScript - Veeshal D. Bodosa</title>
    <meta name="description" content="Learn JavaScript variables, var let const, primitive data types, and scope with simple beginner-friendly examples and diagrams.">
    <meta name="keywords" content="JavaScript, Variables, Data Types, var, let, const, scope, string, number, boolean, null, undefined, webdevcohort2026">
    <meta name="author" content="Veeshal D. Bodosa">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="https://veeshal.me/blogs/understanding-variables-and-data-types-in-javascript">
    <meta property="og:title" content="Understanding Variables and Data Types in JavaScript">
    <meta property="og:description" content="A beginner-friendly guide to storing values in JavaScript with var, let, const, primitive types, and simple scope examples.">
    <meta property="og:image" content="https://miro.medium.com/v2/resize:fit:1400/format:webp/1*qvAJkRLtYnnVFTScPjgWPA.jpeg">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://veeshal.me/blogs/understanding-variables-and-data-types-in-javascript">
    <meta property="twitter:title" content="Understanding Variables and Data Types in JavaScript">
    <meta property="twitter:description" content="A beginner-friendly guide to storing values in JavaScript with var, let, const, primitive types, and simple scope examples.">
    <meta property="twitter:image" content="https://miro.medium.com/v2/resize:fit:1400/format:webp/1*qvAJkRLtYnnVFTScPjgWPA.jpeg">
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
                                    <li><a href="#what-are-variables" class="toc-link">What Are Variables?</a></li>
                                    <li><a href="#declaring-variables" class="toc-link">var, let, and const</a></li>
                                    <li><a href="#primitive-data-types" class="toc-link">Primitive Data Types</a></li>
                                    <li><a href="#var-let-const-difference" class="toc-link">Difference Between var, let, const</a></li>
                                    <li><a href="#scope" class="toc-link">What Is Scope?</a></li>
                                    <li><a href="#assignment" class="toc-link">Practice Assignment</a></li>
                                    <li><a href="#conclusion" class="toc-link">Conclusion</a></li>
                                </ul>
                            </nav>
                        </div>
                    </aside>

                    <div class="blog-main-content">
                        <header class="blog-header">
                            <h1>Understanding Variables and Data Types in JavaScript</h1>
                            <div class="blog-meta-row">
                                <div class="meta-category">JavaScript</div>
                                <div class="meta-author">Veeshal D. Bodosa</div>
                                <div class="meta-date">15 Mar 2026</div>
                            </div>
                        </header>

                        <div class="blog-hero-image-wrapper">
                            <img src="https://miro.medium.com/v2/resize:fit:1400/format:webp/1*qvAJkRLtYnnVFTScPjgWPA.jpeg" alt="JavaScript Variables and Data Types" class="blog-hero-image" style="background: linear-gradient(135deg, #fff8d5, #f6de63); padding: 24px; object-fit: contain;">
                        </div>

                        <article class="article-content">
                            <p class="lead" id="introduction">Think of a variable like a labeled box. You put some information inside the box, give it a name, and later you can open that box whenever you need the value. In JavaScript, variables help us store data so our programs can remember names, ages, prices, login states, and much more.</p>

                            <p>But storing a value is only one part of the story. JavaScript also needs to understand <strong>what kind of value</strong> is inside the variable. That is where data types come in.</p>

                            <h2 id="what-are-variables">1. What Variables Are and Why They Are Needed</h2>
                            <p>A variable is a named place in memory used to store a value.</p>

                            <div class="code-block">
let name = "Veeshal";
let age = 22;

console.log(name);
console.log(age);
                            </div>

                            <p>Without variables, we would have to repeat raw values everywhere in the code. Variables make code easier to read, update, and reuse.</p>

                            <div class="mermaid">
                            flowchart LR
                                A["Variable name"] --> B["Box storing value"]
                                B --> C["Use value later in code"]
                            </div>

                            <h2 id="declaring-variables">2. How to Declare Variables Using <code>var</code>, <code>let</code>, and <code>const</code></h2>
                            <p>JavaScript gives us three main ways to declare variables:</p>

                            <div class="code-block">
var city = "Delhi";
let score = 90;
const country = "India";
                            </div>

                            <p>All three create variables, but they behave a little differently.</p>

                            <h3><code>var</code></h3>
                            <p><code>var</code> is the older way to declare variables in JavaScript.</p>

                            <div class="code-block">
var language = "JavaScript";
language = "JS";
console.log(language);
// JS
                            </div>

                            <h3><code>let</code></h3>
                            <p><code>let</code> is the modern choice when you know the value may change later.</p>

                            <div class="code-block">
let age = 20;
age = 21;
console.log(age);
// 21
                            </div>

                            <h3><code>const</code></h3>
                            <p><code>const</code> is used when the variable should not be reassigned.</p>

                            <div class="code-block">
const pi = 3.14;
console.log(pi);
// 3.14
                            </div>

                            <p>If you try to assign a new value to a <code>const</code> variable, JavaScript throws an error.</p>

                            <h2 id="primitive-data-types">3. Primitive Data Types</h2>
                            <p>Primitive data types are the basic building blocks of data in JavaScript. For this beginner article, focus on these five:</p>

                            <h3>String</h3>
                            <p>Used for text.</p>
                            <div class="code-block">
let name = "Veeshal";
console.log(typeof name);
// string
                            </div>

                            <h3>Number</h3>
                            <p>Used for numeric values.</p>
                            <div class="code-block">
let age = 22;
console.log(typeof age);
// number
                            </div>

                            <h3>Boolean</h3>
                            <p>Used for true or false values.</p>
                            <div class="code-block">
let isStudent = true;
console.log(typeof isStudent);
// boolean
                            </div>

                            <h3><code>null</code></h3>
                            <p>Represents an intentional empty value.</p>
                            <div class="code-block">
let middleName = null;
console.log(middleName);
// null
                            </div>

                            <h3><code>undefined</code></h3>
                            <p>Means a variable exists but no value has been assigned yet.</p>
                            <div class="code-block">
let hobby;
console.log(hobby);
// undefined
                            </div>

                            <p>Simple examples:</p>
                            <ul>
                                <li><strong>Name</strong> is usually a <code>string</code></li>
                                <li><strong>Age</strong> is usually a <code>number</code></li>
                                <li><strong>IsStudent</strong> is usually a <code>boolean</code></li>
                            </ul>

                            <h2 id="var-let-const-difference">4. Basic Difference Between <code>var</code>, <code>let</code>, and <code>const</code></h2>
                            <p>Here is the easiest way to compare them:</p>

                            <div class="code-block">
var course = "Web Dev";
var course = "JavaScript";
console.log(course);
// JavaScript

let level = "Beginner";
level = "Intermediate";
console.log(level);
// Intermediate

const appName = "Notes App";
console.log(appName);
// Notes App
                            </div>

                            <div class="mermaid">
                            flowchart TD
                                A["var"] --> A1["Can reassign"]
                                A --> A2["Older style"]
                                B["let"] --> B1["Can reassign"]
                                B --> B2["Block scoped"]
                                C["const"] --> C1["Cannot reassign"]
                                C --> C2["Block scoped"]
                            </div>

                            <p>Beginner-friendly summary:</p>
                            <ul>
                                <li><strong><code>var</code>:</strong> old style, generally avoid in new code</li>
                                <li><strong><code>let</code>:</strong> use when the value may change</li>
                                <li><strong><code>const</code>:</strong> use when the value should stay fixed</li>
                            </ul>

                            <h2 id="scope">5. What Is Scope? A Very Beginner-Friendly Explanation</h2>
                            <p>Scope means <strong>where a variable can be used</strong>.</p>

                            <p>Think of scope like rooms in a house. A variable created inside one room may only be available inside that room.</p>

                            <div class="code-block">
if (true) {
    let message = "Hello from inside the block";
    console.log(message);
}

// console.log(message); // Error
                            </div>

                            <p>In the example above, <code>message</code> exists only inside the <code>if</code> block because it was declared with <code>let</code>.</p>

                            <div class="mermaid">
                            flowchart TD
                                A["Global area"] --> B["if block"]
                                B --> C["let message lives here"]
                                A --> D["Outside block"]
                                D --> E["message not available here"]
                            </div>

                            <p>For now, remember only this:</p>
                            <ul>
                                <li><code>let</code> and <code>const</code> respect block scope</li>
                                <li><code>var</code> behaves differently and can be confusing for beginners</li>
                            </ul>

                            <h2 id="assignment">6. Practice Assignment</h2>
                            <p>Try this in your browser console:</p>

                            <div class="code-block">
let name = "Veeshal";
let age = 22;
let isStudent = true;

console.log(name);
console.log(age);
console.log(isStudent);

age = 23;
console.log(age);

const country = "India";
console.log(country);

// country = "USA"; // This will cause an error
                            </div>

                            <p>What to observe:</p>
                            <ul>
                                <li><code>let</code> variables can change</li>
                                <li><code>const</code> variables cannot be reassigned</li>
                                <li>Different variables can store different types of values</li>
                            </ul>

                            <h2 id="conclusion">Conclusion</h2>
                            <p>Variables help JavaScript programs store and reuse data. Data types tell JavaScript what kind of value is being stored. Once you understand variables, <code>var</code>, <code>let</code>, <code>const</code>, basic primitive types, and scope, you have one of the most important foundations in programming.</p>

                            <p>Keep the idea simple for now: variables are labeled boxes, data types describe what is inside the box, and scope decides where that box can be opened.</p>
                        </article>
                    </div>

                    <aside class="blog-sidebar-right">
                        <div class="sidebar-tags-wrapper">
                            <h3 class="sidebar-title">Tags</h3>
                            <div class="blog-tags">
                                <a href="" class="blog-tag">#javascript</a>
                                <a href="" class="blog-tag">#variables</a>
                                <a href="" class="blog-tag">#datatypes</a>
                                <a href="" class="blog-tag">#varletconst</a>
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
