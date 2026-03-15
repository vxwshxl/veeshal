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

    <title>JavaScript Arrays 101 - Veeshal D. Bodosa</title>
    <meta name="description" content="Learn JavaScript arrays with simple beginner-friendly examples covering creation, indexing, updating values, length, and basic looping.">
    <meta name="keywords" content="JavaScript, Arrays, indexing, array length, loops, beginners, webdevcohort2026">
    <meta name="author" content="Veeshal D. Bodosa">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="https://veeshal.me/blogs/javascript-arrays-101">
    <meta property="og:title" content="JavaScript Arrays 101">
    <meta property="og:description" content="A beginner-friendly guide to JavaScript arrays, indexing, updates, length, and basic loops.">
    <meta property="og:image" content="https://upload.wikimedia.org/wikipedia/commons/d/d4/Javascript-shield.svg">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://veeshal.me/blogs/javascript-arrays-101">
    <meta property="twitter:title" content="JavaScript Arrays 101">
    <meta property="twitter:description" content="A beginner-friendly guide to JavaScript arrays, indexing, updates, length, and basic loops.">
    <meta property="twitter:image" content="https://upload.wikimedia.org/wikipedia/commons/d/d4/Javascript-shield.svg">
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
                                    <li><a href="#what-are-arrays" class="toc-link">What Are Arrays?</a></li>
                                    <li><a href="#creating-arrays" class="toc-link">How to Create an Array</a></li>
                                    <li><a href="#accessing-elements" class="toc-link">Accessing Elements by Index</a></li>
                                    <li><a href="#updating-elements" class="toc-link">Updating Elements</a></li>
                                    <li><a href="#array-length" class="toc-link">Array Length</a></li>
                                    <li><a href="#looping-arrays" class="toc-link">Basic Looping</a></li>
                                    <li><a href="#assignment" class="toc-link">Practice Assignment</a></li>
                                    <li><a href="#conclusion" class="toc-link">Conclusion</a></li>
                                </ul>
                            </nav>
                        </div>
                    </aside>

                    <div class="blog-main-content">
                        <header class="blog-header">
                            <h1>JavaScript Arrays 101</h1>
                            <div class="blog-meta-row">
                                <div class="meta-category">JavaScript</div>
                                <div class="meta-author">Veeshal D. Bodosa</div>
                                <div class="meta-date">15 Mar 2026</div>
                            </div>
                        </header>

                        <div class="blog-hero-image-wrapper">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/d/d4/Javascript-shield.svg" alt="JavaScript Arrays" class="blog-hero-image" style="background: linear-gradient(135deg, #fff8db, #f0d44f); padding: 24px; object-fit: contain;">
                        </div>

                        <article class="article-content">
                            <p class="lead" id="introduction">Imagine you want to store a list of your favorite fruits, exam marks, or daily tasks. You could create separate variables for each one, but that becomes messy very quickly. Arrays solve this problem by letting you store multiple values together in a single variable.</p>

                            <p>In JavaScript, an array is an ordered collection of values. That means every item has a position, and we can access items using that position number, called an index.</p>

                            <h2 id="what-are-arrays">1. What Arrays Are and Why We Need Them</h2>
                            <p>An array stores multiple values in order inside one variable.</p>

                            <div class="code-block">
let fruit1 = "Apple";
let fruit2 = "Banana";
let fruit3 = "Mango";
                            </div>

                            <p>The code above works, but it is not very practical when the list gets longer.</p>

                            <div class="code-block">
let fruits = ["Apple", "Banana", "Mango"];
console.log(fruits);
                            </div>

                            <p>This is easier to manage because all related values are grouped together in one place.</p>

                            <h2 id="creating-arrays">2. How to Create an Array</h2>
                            <p>You create an array using square brackets <code>[ ]</code> and separate items with commas.</p>

                            <div class="code-block">
let fruits = ["Apple", "Banana", "Mango"];
let marks = [78, 85, 92];
let tasks = ["Study", "Code", "Sleep"];
                            </div>

                            <p>Arrays can hold strings, numbers, booleans, and more. For beginners, just remember that an array is a collection of values stored in order.</p>

                            <div class="mermaid">
                            flowchart LR
                                A["fruits array"] --> B["0: Apple"]
                                A --> C["1: Banana"]
                                A --> D["2: Mango"]
                            </div>

                            <h2 id="accessing-elements">3. Accessing Elements Using Index</h2>
                            <p>Every value in an array has an index, and indexing starts from <strong>0</strong>, not 1.</p>

                            <div class="code-block">
let fruits = ["Apple", "Banana", "Mango"];

console.log(fruits[0]);
console.log(fruits[1]);
console.log(fruits[2]);
// Apple
// Banana
// Mango
                            </div>

                            <p>This means:</p>
                            <ul>
                                <li>first element is at index <code>0</code></li>
                                <li>second element is at index <code>1</code></li>
                                <li>third element is at index <code>2</code></li>
                            </ul>

                            <div class="mermaid">
                            flowchart TD
                                A["Index 0"] --> B["Apple"]
                                C["Index 1"] --> D["Banana"]
                                E["Index 2"] --> F["Mango"]
                            </div>

                            <h2 id="updating-elements">4. Updating Elements</h2>
                            <p>You can change an array value by using its index.</p>

                            <div class="code-block">
let fruits = ["Apple", "Banana", "Mango"];

fruits[1] = "Orange";

console.log(fruits);
// ["Apple", "Orange", "Mango"]
                            </div>

                            <p>Here, the value at index <code>1</code> changed from <code>"Banana"</code> to <code>"Orange"</code>.</p>

                            <h2 id="array-length">5. Array <code>length</code> Property</h2>
                            <p>The <code>length</code> property tells you how many elements are in the array.</p>

                            <div class="code-block">
let fruits = ["Apple", "Banana", "Mango"];

console.log(fruits.length);
// 3
                            </div>

                            <p>This is very useful when looping through arrays or finding the last element.</p>

                            <div class="code-block">
let fruits = ["Apple", "Banana", "Mango"];

console.log(fruits[fruits.length - 1]);
// Mango
                            </div>

                            <h2 id="looping-arrays">6. Basic Looping Over Arrays</h2>
                            <p>A simple way to print all elements of an array is using a <code>for</code> loop.</p>

                            <div class="code-block">
let fruits = ["Apple", "Banana", "Mango"];

for (let i = 0; i < fruits.length; i++) {
    console.log(fruits[i]);
}
                            </div>

                            <p>Step by step:</p>
                            <ul>
                                <li><code>i = 0</code> starts at the first element</li>
                                <li><code>i &lt; fruits.length</code> keeps the loop inside array boundaries</li>
                                <li><code>i++</code> moves to the next index each time</li>
                            </ul>

                            <p>This prints every value in order.</p>

                            <h2 id="assignment">7. Practice Assignment</h2>
                            <p>Try this in your browser console:</p>

                            <div class="code-block">
let movies = ["Interstellar", "Inception", "3 Idiots", "The Dark Knight", "Zindagi Na Milegi Dobara"];

console.log("First movie:", movies[0]);
console.log("Last movie:", movies[movies.length - 1]);

movies[2] = "PK";

console.log("Updated array:", movies);

for (let i = 0; i < movies.length; i++) {
    console.log(movies[i]);
}
                            </div>

                            <p>This assignment helps you practice:</p>
                            <ul>
                                <li>creating an array</li>
                                <li>accessing the first and last element</li>
                                <li>changing one value</li>
                                <li>looping through all elements</li>
                            </ul>

                            <h2 id="conclusion">Conclusion</h2>
                            <p>Arrays are one of the most useful basics in JavaScript. They let you store multiple values in one place, access them using indexes, update values when needed, check length, and loop through the whole collection.</p>

                            <p>Keep the mental model simple: an array is an ordered list of values, and indexing starts from 0. Once this becomes natural, working with JavaScript data gets much easier.</p>
                        </article>
                    </div>

                    <aside class="blog-sidebar-right">
                        <div class="sidebar-tags-wrapper">
                            <h3 class="sidebar-title">Tags</h3>
                            <div class="blog-tags">
                                <a href="" class="blog-tag">#javascript</a>
                                <a href="" class="blog-tag">#arrays</a>
                                <a href="" class="blog-tag">#indexing</a>
                                <a href="" class="blog-tag">#loops</a>
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
