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

    <title>Array Methods You Must Know - Veeshal D. Bodosa</title>
    <meta name="description" content="Learn JavaScript array methods with simple examples, before-and-after states, beginner-friendly reduce, and practical map vs filter comparisons.">
    <meta name="keywords" content="JavaScript, Array Methods, push, pop, shift, unshift, map, filter, reduce, forEach, webdevcohort2026">
    <meta name="author" content="Veeshal D. Bodosa">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="https://veeshal.me/blogs/array-methods-you-must-know">
    <meta property="og:title" content="Array Methods You Must Know">
    <meta property="og:description" content="A beginner-friendly guide to the JavaScript array methods you will use again and again.">
    <meta property="og:image" content="https://cdn.simpleicons.org/javascript/F7DF1E">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://veeshal.me/blogs/array-methods-you-must-know">
    <meta property="twitter:title" content="Array Methods You Must Know">
    <meta property="twitter:description" content="A beginner-friendly guide to the JavaScript array methods you will use again and again.">
    <meta property="twitter:image" content="https://cdn.simpleicons.org/javascript/F7DF1E">
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
                                    <li><a href="#push-pop" class="toc-link">push() and pop()</a></li>
                                    <li><a href="#shift-unshift" class="toc-link">shift() and unshift()</a></li>
                                    <li><a href="#foreach" class="toc-link">forEach()</a></li>
                                    <li><a href="#map" class="toc-link">map()</a></li>
                                    <li><a href="#filter" class="toc-link">filter()</a></li>
                                    <li><a href="#reduce" class="toc-link">reduce()</a></li>
                                    <li><a href="#for-loop-vs-methods" class="toc-link">for Loop vs map/filter</a></li>
                                    <li><a href="#assignment" class="toc-link">Practice Assignment</a></li>
                                    <li><a href="#conclusion" class="toc-link">Conclusion</a></li>
                                </ul>
                            </nav>
                        </div>
                    </aside>

                    <div class="blog-main-content">
                        <header class="blog-header">
                            <h1>Array Methods You Must Know</h1>
                            <div class="blog-meta-row">
                                <div class="meta-category">JavaScript</div>
                                <div class="meta-author">Veeshal D. Bodosa</div>
                                <div class="meta-date">15 Mar 2026</div>
                            </div>
                        </header>

                        <div class="blog-hero-image-wrapper">
                            <img src="https://cdn.simpleicons.org/javascript/F7DF1E" alt="JavaScript Logo" class="blog-hero-image" style="background: linear-gradient(135deg, #fff4b8, #ffd447); padding: 24px; object-fit: contain;">
                        </div>

                        <article class="article-content">
                            <p class="lead" id="introduction">If you are learning JavaScript, arrays will show up everywhere: student marks, product lists, todos, API data, and more. Instead of writing long manual loops for every small task, JavaScript gives us built-in array methods that make code easier to read and easier to maintain.</p>

                            <p>This article covers the methods you should know first: <code>push()</code>, <code>pop()</code>, <code>shift()</code>, <code>unshift()</code>, <code>map()</code>, <code>filter()</code>, <code>reduce()</code>, and <code>forEach()</code>. Keep your browser console open and try every example yourself. Also, to keep the ideas clear, we will avoid method chaining in the beginning.</p>

                            <h2 id="push-pop">1. <code>push()</code> and <code>pop()</code></h2>
                            <p>These methods work at the <strong>end</strong> of an array. They change the original array.</p>

                            <h3><code>push()</code></h3>
                            <p><code>push()</code> adds a new item to the end.</p>
                            <div class="code-block">
let fruits = ["apple", "banana"];
console.log("Before:", fruits);

fruits.push("mango");

console.log("After:", fruits);
// Before: ["apple", "banana"]
// After: ["apple", "banana", "mango"]
                            </div>

                            <h3><code>pop()</code></h3>
                            <p><code>pop()</code> removes the last item and returns it.</p>
                            <div class="code-block">
let fruits = ["apple", "banana", "mango"];
console.log("Before:", fruits);

let removedFruit = fruits.pop();

console.log("Removed:", removedFruit);
console.log("After:", fruits);
// Removed: "mango"
// After: ["apple", "banana"]
                            </div>

                            <h2 id="shift-unshift">2. <code>shift()</code> and <code>unshift()</code></h2>
                            <p>These methods work at the <strong>start</strong> of an array. They also change the original array.</p>

                            <h3><code>unshift()</code></h3>
                            <p><code>unshift()</code> adds a new item to the beginning.</p>
                            <div class="code-block">
let queue = ["second", "third"];
console.log("Before:", queue);

queue.unshift("first");

console.log("After:", queue);
// Before: ["second", "third"]
// After: ["first", "second", "third"]
                            </div>

                            <h3><code>shift()</code></h3>
                            <p><code>shift()</code> removes the first item and returns it.</p>
                            <div class="code-block">
let queue = ["first", "second", "third"];
console.log("Before:", queue);

let removedItem = queue.shift();

console.log("Removed:", removedItem);
console.log("After:", queue);
// Removed: "first"
// After: ["second", "third"]
                            </div>

                            <h2 id="foreach">3. <code>forEach()</code></h2>
                            <p>Use <code>forEach()</code> when you want to do something for every item, but you do <strong>not</strong> want a new array back.</p>

                            <div class="code-block">
let prices = [100, 200, 300];

prices.forEach(function(price, index) {
    console.log("Item", index, "costs", price);
});

// Item 0 costs 100
// Item 1 costs 200
// Item 2 costs 300
                            </div>

                            <p>A simple way to remember it: <code>forEach()</code> is for <strong>performing an action</strong>, not for building a transformed result.</p>

                            <h2 id="map">4. <code>map()</code></h2>
                            <p><code>map()</code> creates a <strong>new array</strong> by changing every item in the original array. The original array stays unchanged.</p>

                            <div class="code-block">
let numbers = [2, 4, 6, 8];
console.log("Original:", numbers);

let doubledNumbers = numbers.map(function(num) {
    return num * 2;
});

console.log("New array:", doubledNumbers);
console.log("Original after map:", numbers);
// New array: [4, 8, 12, 16]
// Original after map: [2, 4, 6, 8]
                            </div>

                            <div class="mermaid">
                            graph LR
                                A[Original Array: 2,4,6,8] --> B[Take 2]
                                B --> C[Return 4]
                                A --> D[Take 4]
                                D --> E[Return 8]
                                A --> F[Take 6]
                                F --> G[Return 12]
                                A --> H[Take 8]
                                H --> I[Return 16]
                                C --> J[New Array: 4,8,12,16]
                                E --> J
                                G --> J
                                I --> J
                            </div>

                            <p>This is useful when you want to transform data, like converting prices, doubling numbers, or turning names into uppercase.</p>

                            <h2 id="filter">5. <code>filter()</code></h2>
                            <p><code>filter()</code> also creates a <strong>new array</strong>, but instead of changing each item, it keeps only the items that match a condition.</p>

                            <div class="code-block">
let marks = [5, 12, 8, 20, 17];
console.log("Original:", marks);

let passedMarks = marks.filter(function(mark) {
    return mark > 10;
});

console.log("Filtered:", passedMarks);
console.log("Original after filter:", marks);
// Filtered: [12, 20, 17]
// Original after filter: [5, 12, 8, 20, 17]
                            </div>

                            <div class="mermaid">
                            graph TD
                                A[5] --> B{Greater than 10?}
                                C[12] --> D{Greater than 10?}
                                E[8] --> F{Greater than 10?}
                                G[20] --> H{Greater than 10?}
                                I[17] --> J{Greater than 10?}
                                B -->|No| K[Discard]
                                D -->|Yes| L[Keep 12]
                                F -->|No| K
                                H -->|Yes| M[Keep 20]
                                J -->|Yes| N[Keep 17]
                                L --> O[Result: 12,20,17]
                                M --> O
                                N --> O
                            </div>

                            <p>Use <code>filter()</code> when you want to remove unwanted values and keep only matching ones.</p>

                            <h2 id="reduce">6. <code>reduce()</code></h2>
                            <p><code>reduce()</code> takes many values and combines them into <strong>one final value</strong>. For beginners, the easiest example is finding the total sum of numbers.</p>

                            <div class="code-block">
let numbers = [1, 2, 3, 4];

let total = numbers.reduce(function(accumulator, currentValue) {
    return accumulator + currentValue;
}, 0);

console.log(total);
// 10
                            </div>

                            <p>Here, <code>0</code> is the starting value of the accumulator.</p>

                            <div class="mermaid">
                            graph LR
                                A[Start: 0] --> B[0 + 1 = 1]
                                B --> C[1 + 2 = 3]
                                C --> D[3 + 3 = 6]
                                D --> E[6 + 4 = 10]
                                E --> F[Final Result: 10]
                            </div>

                            <p>Think of <code>reduce()</code> like this: take one running total, keep updating it, and return one final answer. For now, that mental model is enough.</p>

                            <h2 id="for-loop-vs-methods">7. Traditional <code>for</code> Loop vs <code>map()</code> / <code>filter()</code></h2>
                            <p>You can do the same tasks with a traditional loop, but array methods usually make your intention clearer.</p>

                            <h3>Doubling numbers with a <code>for</code> loop</h3>
                            <div class="code-block">
let numbers = [2, 4, 6];
let doubled = [];

for (let i = 0; i &lt; numbers.length; i++) {
    doubled.push(numbers[i] * 2);
}

console.log(doubled);
// [4, 8, 12]
                            </div>

                            <h3>Doubling numbers with <code>map()</code></h3>
                            <div class="code-block">
let numbers = [2, 4, 6];

let doubled = numbers.map(function(num) {
    return num * 2;
});

console.log(doubled);
// [4, 8, 12]
                            </div>

                            <h3>Filtering values with a <code>for</code> loop</h3>
                            <div class="code-block">
let numbers = [5, 12, 8, 20];
let greaterThanTen = [];

for (let i = 0; i &lt; numbers.length; i++) {
    if (numbers[i] &gt; 10) {
        greaterThanTen.push(numbers[i]);
    }
}

console.log(greaterThanTen);
// [12, 20]
                            </div>

                            <h3>Filtering values with <code>filter()</code></h3>
                            <div class="code-block">
let numbers = [5, 12, 8, 20];

let greaterThanTen = numbers.filter(function(num) {
    return num &gt; 10;
});

console.log(greaterThanTen);
// [12, 20]
                            </div>

                            <p>Use a <code>for</code> loop when you need full control. Use <code>map()</code> and <code>filter()</code> when you want code that reads closer to plain English.</p>

                            <h2 id="assignment">8. Practice Assignment</h2>
                            <p>Try this mini task in your console without chaining methods:</p>

                            <div class="code-block">
let numbers = [4, 7, 10, 13, 16];

let doubled = numbers.map(function(num) {
    return num * 2;
});

let greaterThanTen = numbers.filter(function(num) {
    return num &gt; 10;
});

let total = numbers.reduce(function(accumulator, currentValue) {
    return accumulator + currentValue;
}, 0);

console.log("Original:", numbers);
console.log("Doubled:", doubled);
console.log("Greater than 10:", greaterThanTen);
console.log("Total sum:", total);
                            </div>

                            <p>Expected output:</p>
                            <ul>
                                <li><strong>Original:</strong> <code>[4, 7, 10, 13, 16]</code></li>
                                <li><strong>Doubled:</strong> <code>[8, 14, 20, 26, 32]</code></li>
                                <li><strong>Greater than 10:</strong> <code>[13, 16]</code></li>
                                <li><strong>Total sum:</strong> <code>50</code></li>
                            </ul>

                            <h2 id="conclusion">Conclusion</h2>
                            <p>These array methods are part of everyday JavaScript. <code>push()</code> and <code>pop()</code> help you work with the end of an array, <code>shift()</code> and <code>unshift()</code> work with the beginning, <code>forEach()</code> helps you run an action for every item, <code>map()</code> transforms, <code>filter()</code> selects, and <code>reduce()</code> combines many values into one.</p>

                            <p>Start with these basics, practice them in the browser console, and avoid chaining until each method feels natural on its own. Once the basics are clear, writing clean JavaScript becomes much easier.</p>
                        </article>
                    </div>

                    <aside class="blog-sidebar-right">
                        <div class="sidebar-tags-wrapper">
                            <h3 class="sidebar-title">Tags</h3>
                            <div class="blog-tags">
                                <a href="" class="blog-tag">#javascript</a>
                                <a href="" class="blog-tag">#arraymethods</a>
                                <a href="" class="blog-tag">#map</a>
                                <a href="" class="blog-tag">#filter</a>
                                <a href="" class="blog-tag">#reduce</a>
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
