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

    <title>Understanding Objects in JavaScript - Veeshal D. Bodosa</title>
    <meta name="description" content="Learn JavaScript objects with simple beginner-friendly examples covering key-value pairs, property access, updates, adding, deleting, and looping through keys.">
    <meta name="keywords" content="JavaScript, Objects, key value pairs, dot notation, bracket notation, object properties, webdevcohort2026">
    <meta name="author" content="Veeshal D. Bodosa">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="https://veeshal.me/blogs/understanding-objects-in-javascript">
    <meta property="og:title" content="Understanding Objects in JavaScript">
    <meta property="og:description" content="A beginner-friendly guide to JavaScript objects, property access, updates, and looping through keys.">
    <meta property="og:image" content="https://cdn.worldvectorlogo.com/logos/javascript-1.svg">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://veeshal.me/blogs/understanding-objects-in-javascript">
    <meta property="twitter:title" content="Understanding Objects in JavaScript">
    <meta property="twitter:description" content="A beginner-friendly guide to JavaScript objects, property access, updates, and looping through keys.">
    <meta property="twitter:image" content="https://cdn.worldvectorlogo.com/logos/javascript-1.svg">
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
                                    <li><a href="#what-are-objects" class="toc-link">What Are Objects?</a></li>
                                    <li><a href="#creating-objects" class="toc-link">Creating Objects</a></li>
                                    <li><a href="#accessing-properties" class="toc-link">Accessing Properties</a></li>
                                    <li><a href="#updating-properties" class="toc-link">Updating Properties</a></li>
                                    <li><a href="#adding-deleting-properties" class="toc-link">Adding and Deleting Properties</a></li>
                                    <li><a href="#looping-through-keys" class="toc-link">Looping Through Keys</a></li>
                                    <li><a href="#array-vs-object" class="toc-link">Array vs Object</a></li>
                                    <li><a href="#assignment" class="toc-link">Practice Assignment</a></li>
                                    <li><a href="#conclusion" class="toc-link">Conclusion</a></li>
                                </ul>
                            </nav>
                        </div>
                    </aside>

                    <div class="blog-main-content">
                        <header class="blog-header">
                            <h1>Understanding Objects in JavaScript</h1>
                            <div class="blog-meta-row">
                                <div class="meta-category">JavaScript</div>
                                <div class="meta-author">Veeshal D. Bodosa</div>
                                <div class="meta-date">15 Mar 2026</div>
                            </div>
                        </header>

                        <div class="blog-hero-image-wrapper">
                            <img src="https://cdn.worldvectorlogo.com/logos/javascript-1.svg" alt="JavaScript Objects" class="blog-hero-image" style="background: linear-gradient(135deg, #fff6d0, #f4d84f); padding: 24px; object-fit: contain;">
                        </div>

                        <article class="article-content">
                            <p class="lead" id="introduction">In JavaScript, arrays are useful when you want an ordered list of values. But when you want to describe one real-world thing with multiple related details, an object is usually a better fit. For example, a person has a name, age, and city. Keeping those values together inside one structure makes the code easier to understand.</p>

                            <p>That is exactly what objects do. They store data in <strong>key-value pairs</strong>, which makes them great for representing people, products, users, settings, and more.</p>

                            <h2 id="what-are-objects">1. What Objects Are and Why They Are Needed</h2>
                            <p>An object is a collection of related data stored as <strong>key: value</strong> pairs.</p>

                            <div class="code-block">
const person = {
    name: "Veeshal",
    age: 22,
    city: "Kokrajhar"
};
                            </div>

                            <p>Here:</p>
                            <ul>
                                <li><code>name</code>, <code>age</code>, and <code>city</code> are keys</li>
                                <li><code>"Veeshal"</code>, <code>22</code>, and <code>"Kokrajhar"</code> are values</li>
                            </ul>

                            <div class="mermaid">
                            flowchart TD
                                A["person object"] --> B["name : Veeshal"]
                                A --> C["age : 22"]
                                A --> D["city : Kokrajhar"]
                            </div>

                            <p>Objects are needed because they group related information into one place instead of scattering separate variables across the code.</p>

                            <h2 id="creating-objects">2. Creating Objects</h2>
                            <p>The easiest way to create an object is with curly braces <code>{ }</code>.</p>

                            <div class="code-block">
const student = {
    name: "Riya",
    age: 20,
    course: "JavaScript"
};
                            </div>

                            <p>You can think of this as creating one box called <code>student</code> that contains multiple labeled values.</p>

                            <h2 id="accessing-properties">3. Accessing Properties</h2>
                            <p>There are two common ways to access object properties: <strong>dot notation</strong> and <strong>bracket notation</strong>.</p>

                            <h3>Dot notation</h3>
                            <div class="code-block">
const person = {
    name: "Veeshal",
    age: 22,
    city: "Kokrajhar"
};

console.log(person.name);
console.log(person.age);
// Veeshal
// 22
                            </div>

                            <h3>Bracket notation</h3>
                            <div class="code-block">
const person = {
    name: "Veeshal",
    age: 22,
    city: "Kokrajhar"
};

console.log(person["city"]);
// Kokrajhar
                            </div>

                            <p>Use dot notation most of the time because it is shorter. Use bracket notation when the property name comes from a variable or when the key has special characters.</p>

                            <h2 id="updating-properties">4. Updating Object Properties</h2>
                            <p>You can update an existing property by assigning a new value to it.</p>

                            <div class="code-block">
const person = {
    name: "Veeshal",
    age: 22,
    city: "Kokrajhar"
};

person.age = 23;

console.log(person.age);
// 23
                            </div>

                            <p>This changes only the <code>age</code> property, not the whole object.</p>

                            <h2 id="adding-deleting-properties">5. Adding and Deleting Properties</h2>
                            <p>You can add a new property the same way you update one.</p>

                            <div class="code-block">
const person = {
    name: "Veeshal",
    age: 22
};

person.city = "Kokrajhar";

console.log(person);
// { name: "Veeshal", age: 22, city: "Kokrajhar" }
                            </div>

                            <p>You can remove a property using the <code>delete</code> keyword.</p>

                            <div class="code-block">
const person = {
    name: "Veeshal",
    age: 22,
    city: "Kokrajhar"
};

delete person.city;

console.log(person);
// { name: "Veeshal", age: 22 }
                            </div>

                            <h2 id="looping-through-keys">6. Looping Through Object Keys</h2>
                            <p>A simple beginner-friendly way to loop through an object is using <code>for...in</code>.</p>

                            <div class="code-block">
const person = {
    name: "Veeshal",
    age: 22,
    city: "Kokrajhar"
};

for (let key in person) {
    console.log(key, ":", person[key]);
}
                            </div>

                            <p>Step by step:</p>
                            <ul>
                                <li>JavaScript takes one key at a time</li>
                                <li><code>key</code> becomes <code>name</code>, then <code>age</code>, then <code>city</code></li>
                                <li><code>person[key]</code> gives the value for that key</li>
                            </ul>

                            <h2 id="array-vs-object">7. Difference Between Array and Object</h2>
                            <p>Arrays and objects both store data, but they are used differently.</p>

                            <div class="mermaid">
                            flowchart LR
                                A["Array"] --> A1["Ordered list"]
                                A --> A2["Uses indexes"]
                                B["Object"] --> B1["Named values"]
                                B --> B2["Uses keys"]
                            </div>

                            <div class="code-block">
const fruits = ["apple", "banana", "mango"];
console.log(fruits[0]);
// apple

const person = {
    name: "Veeshal",
    age: 22
};
console.log(person.name);
// Veeshal
                            </div>

                            <p>Use an array when order matters. Use an object when you want to describe one thing with named properties.</p>

                            <h2 id="assignment">8. Practice Assignment</h2>
                            <p>Try this in your browser console:</p>

                            <div class="code-block">
const student = {
    name: "Riya",
    age: 20,
    course: "JavaScript"
};

student.age = 21;

for (let key in student) {
    console.log(key, ":", student[key]);
}
                            </div>

                            <p>This assignment uses:</p>
                            <ul>
                                <li>an <strong>object</strong> to store related details about one student</li>
                                <li>property update with <code>student.age = 21</code></li>
                                <li>a <code>for...in</code> loop to print all keys and values</li>
                            </ul>

                            <h2 id="conclusion">Conclusion</h2>
                            <p>Objects are one of the most important parts of JavaScript. They help you organize related information using key-value pairs. Once you know how to create objects, access properties, update values, add new properties, delete properties, and loop through keys, you have a strong foundation for working with real data.</p>

                            <p>Keep the examples simple for now. Think of an object as a labeled information card about one thing, like a person, student, or product. That mental model will take you a long way.</p>
                        </article>
                    </div>

                    <aside class="blog-sidebar-right">
                        <div class="sidebar-tags-wrapper">
                            <h3 class="sidebar-title">Tags</h3>
                            <div class="blog-tags">
                                <a href="" class="blog-tag">#javascript</a>
                                <a href="" class="blog-tag">#objects</a>
                                <a href="" class="blog-tag">#keyvaluepairs</a>
                                <a href="" class="blog-tag">#dotnotation</a>
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
