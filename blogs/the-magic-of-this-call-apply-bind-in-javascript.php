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

    <title>The Magic of this, call(), apply(), and bind() in JavaScript - Veeshal D. Bodosa</title>
    <meta name="description" content="Learn JavaScript this, call(), apply(), and bind() with simple object examples, method borrowing, and a beginner-friendly comparison.">
    <meta name="keywords" content="JavaScript, this, call, apply, bind, method borrowing, functions, webdevcohort2026">
    <meta name="author" content="Veeshal D. Bodosa">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="https://veeshal.me/blogs/the-magic-of-this-call-apply-bind-in-javascript">
    <meta property="og:title" content="The Magic of this, call(), apply(), and bind() in JavaScript">
    <meta property="og:description" content="A beginner-friendly guide to understanding this, call(), apply(), and bind() in JavaScript.">
    <meta property="og:image" content="https://media2.dev.to/dynamic/image/width=1000,height=420,fit=cover,gravity=auto,format=auto/https%3A%2F%2Fdev-to-uploads.s3.amazonaws.com%2Fuploads%2Farticles%2F2z8d8uo9p763mb5mc1rn.webp">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://veeshal.me/blogs/the-magic-of-this-call-apply-bind-in-javascript">
    <meta property="twitter:title" content="The Magic of this, call(), apply(), and bind() in JavaScript">
    <meta property="twitter:description" content="A beginner-friendly guide to understanding this, call(), apply(), and bind() in JavaScript.">
    <meta property="twitter:image" content="https://media2.dev.to/dynamic/image/width=1000,height=420,fit=cover,gravity=auto,format=auto/https%3A%2F%2Fdev-to-uploads.s3.amazonaws.com%2Fuploads%2Farticles%2F2z8d8uo9p763mb5mc1rn.webp">
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
                                    <li><a href="#what-this-means" class="toc-link">What this Means</a></li>
                                    <li><a href="#this-normal-functions" class="toc-link">this in Normal Functions</a></li>
                                    <li><a href="#this-inside-objects" class="toc-link">this Inside Objects</a></li>
                                    <li><a href="#call-method" class="toc-link">call()</a></li>
                                    <li><a href="#apply-method" class="toc-link">apply()</a></li>
                                    <li><a href="#bind-method" class="toc-link">bind()</a></li>
                                    <li><a href="#difference-call-apply-bind" class="toc-link">call vs apply vs bind</a></li>
                                    <li><a href="#assignment" class="toc-link">Practice Assignment</a></li>
                                    <li><a href="#conclusion" class="toc-link">Conclusion</a></li>
                                </ul>
                            </nav>
                        </div>
                    </aside>

                    <div class="blog-main-content">
                        <header class="blog-header">
                            <h1>The Magic of this, call(), apply(), and bind() in JavaScript</h1>
                            <div class="blog-meta-row">
                                <div class="meta-category">JavaScript</div>
                                <div class="meta-author">Veeshal D. Bodosa</div>
                                <div class="meta-date">15 Mar 2026</div>
                            </div>
                        </header>

                        <div class="blog-hero-image-wrapper">
                            <img src="https://media2.dev.to/dynamic/image/width=1000,height=420,fit=cover,gravity=auto,format=auto/https%3A%2F%2Fdev-to-uploads.s3.amazonaws.com%2Fuploads%2Farticles%2F2z8d8uo9p763mb5mc1rn.webp" alt="JavaScript this call apply bind" class="blog-hero-image" style="background: linear-gradient(135deg, #fff9de, #edd250); padding: 24px; object-fit: contain;">
                        </div>

                        <article class="article-content">
                            <p class="lead" id="introduction">The <code>this</code> keyword is one of the most interesting parts of JavaScript. At first, it feels confusing because its value can change depending on how a function is called. The easiest way to understand it is this: <strong><code>this</code> usually depends on who is calling the function.</strong></p>

                            <p>Once that idea is clear, <code>call()</code>, <code>apply()</code>, and <code>bind()</code> become much easier to understand, because all three help us control what <code>this</code> should point to.</p>

                            <h2 id="what-this-means">1. What <code>this</code> Means in JavaScript</h2>
                            <p>Think of <code>this</code> as the object connected to the current function call.</p>

                            <div class="mermaid">
                            flowchart LR
                                A["Function"] --> B["Who called me?"]
                                B --> C["That becomes this"]
                            </div>

                            <p>So instead of asking, "What is <code>this</code>?" ask, "Who is calling the function?"</p>

                            <h2 id="this-normal-functions">2. <code>this</code> Inside Normal Functions</h2>
                            <p>In a normal standalone function, <code>this</code> is not connected to any object in the simple way beginners expect.</p>

                            <div class="code-block">
function showName() {
    console.log(this);
}

showName();
                            </div>

                            <p>For now, just remember: in a plain normal function, <code>this</code> does not automatically refer to your custom object unless you connect it somehow.</p>

                            <h2 id="this-inside-objects">3. <code>this</code> Inside Objects</h2>
                            <p>Inside an object method, <code>this</code> usually refers to the object that is calling the method.</p>

                            <div class="code-block">
const person = {
    name: "Veeshal",
    greet: function() {
        console.log("Hello, I am " + this.name);
    }
};

person.greet();
// Hello, I am Veeshal
                            </div>

                            <p>Here, <code>person</code> is calling <code>greet()</code>, so <code>this.name</code> means <code>person.name</code>.</p>

                            <h2 id="call-method">4. What <code>call()</code> Does</h2>
                            <p><code>call()</code> lets you call a function immediately and choose what <code>this</code> should be.</p>

                            <div class="code-block">
const person1 = {
    name: "Veeshal"
};

function greet(city) {
    console.log("Hello, I am " + this.name + " from " + city);
}

greet.call(person1, "Kokrajhar");
// Hello, I am Veeshal from Kokrajhar
                            </div>

                            <p>In <code>call()</code>:</p>
                            <ul>
                                <li>the first argument sets <code>this</code></li>
                                <li>the remaining arguments are passed one by one</li>
                            </ul>

                            <h2 id="apply-method">5. What <code>apply()</code> Does</h2>
                            <p><code>apply()</code> is very similar to <code>call()</code>. It also calls the function immediately and sets <code>this</code>.</p>

                            <p>The main difference is how arguments are passed: <code>apply()</code> uses an array.</p>

                            <div class="code-block">
const person2 = {
    name: "Riya"
};

function greet(city, country) {
    console.log("Hello, I am " + this.name + " from " + city + ", " + country);
}

greet.apply(person2, ["Delhi", "India"]);
// Hello, I am Riya from Delhi, India
                            </div>

                            <h2 id="bind-method">6. What <code>bind()</code> Does</h2>
                            <p><code>bind()</code> does not call the function immediately. Instead, it returns a <strong>new function</strong> with <code>this</code> fixed to a chosen object.</p>

                            <div class="code-block">
const person3 = {
    name: "Aman"
};

function greet(city) {
    console.log("Hello, I am " + this.name + " from " + city);
}

const boundGreet = greet.bind(person3, "Mumbai");

boundGreet();
// Hello, I am Aman from Mumbai
                            </div>

                            <p>This is useful when you want to store the function and use it later.</p>

                            <h2 id="difference-call-apply-bind">7. Difference Between <code>call</code>, <code>apply</code>, and <code>bind</code></h2>
                            <p>All three help control <code>this</code>, but they are used differently.</p>

                            <div class="mermaid">
                            flowchart TD
                                A["call"] --> A1["Calls immediately"]
                                A --> A2["Arguments passed one by one"]
                                B["apply"] --> B1["Calls immediately"]
                                B --> B2["Arguments passed as array"]
                                C["bind"] --> C1["Returns new function"]
                                C --> C2["Call later"]
                            </div>

                            <p>Simple comparison:</p>
                            <ul>
                                <li><strong><code>call()</code>:</strong> call now, arguments separately</li>
                                <li><strong><code>apply()</code>:</strong> call now, arguments in an array</li>
                                <li><strong><code>bind()</code>:</strong> do not call now, return a new function for later use</li>
                            </ul>

                            <h2 id="assignment">8. Practice Assignment</h2>
                            <p>Try this in your browser console:</p>

                            <div class="code-block">
const student = {
    name: "Riya",
    showName: function(course, city) {
        console.log(this.name + " studies " + course + " in " + city);
    }
};

const anotherStudent = {
    name: "Aman"
};

student.showName("JavaScript", "Delhi");

student.showName.call(anotherStudent, "React", "Mumbai");

student.showName.apply(anotherStudent, ["Node.js", "Bangalore"]);

const boundFunction = student.showName.bind(anotherStudent, "Python", "Pune");
boundFunction();
                            </div>

                            <p>This assignment shows:</p>
                            <ul>
                                <li>a method using <code>this</code></li>
                                <li>method borrowing using <code>call()</code></li>
                                <li>array arguments with <code>apply()</code></li>
                                <li>storing a bound function using <code>bind()</code></li>
                            </ul>

                            <h2 id="conclusion">Conclusion</h2>
                            <p>The easiest way to understand <code>this</code> is to think about the caller. In many cases, <code>this</code> points to the object that is calling the function. And when you want to control that behavior yourself, <code>call()</code>, <code>apply()</code>, and <code>bind()</code> are the tools that help.</p>

                            <p>Keep the rule simple: <code>call()</code> and <code>apply()</code> run immediately, while <code>bind()</code> gives you a new function to run later. Once that idea clicks, these methods stop feeling magical and start feeling useful.</p>
                        </article>
                    </div>

                    <aside class="blog-sidebar-right">
                        <div class="sidebar-tags-wrapper">
                            <h3 class="sidebar-title">Tags</h3>
                            <div class="blog-tags">
                                <a href="" class="blog-tag">#javascript</a>
                                <a href="" class="blog-tag">#this</a>
                                <a href="" class="blog-tag">#callapplybind</a>
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
