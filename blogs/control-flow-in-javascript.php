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

    <title>Control Flow in JavaScript: If, Else, and Switch Explained - Veeshal D. Bodosa</title>
    <meta name="description" content="Learn JavaScript control flow with simple if, else, else if, and switch examples, including step-by-step decisions and beginner-friendly comparisons.">
    <meta name="keywords" content="JavaScript, Control Flow, if else, else if, switch, break, conditions, webdevcohort2026">
    <meta name="author" content="Veeshal D. Bodosa">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="https://veeshal.me/blogs/control-flow-in-javascript">
    <meta property="og:title" content="Control Flow in JavaScript: If, Else, and Switch Explained">
    <meta property="og:description" content="A beginner-friendly guide to how JavaScript makes decisions using if, else, else if, and switch.">
    <meta property="og:image" content="https://miro.medium.com/v2/resize:fit:1400/format:webp/1*ej4NUhE3AOp0DVBJR3WA5w.png">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://veeshal.me/blogs/control-flow-in-javascript">
    <meta property="twitter:title" content="Control Flow in JavaScript: If, Else, and Switch Explained">
    <meta property="twitter:description" content="A beginner-friendly guide to how JavaScript makes decisions using if, else, else if, and switch.">
    <meta property="twitter:image" content="https://miro.medium.com/v2/resize:fit:1400/format:webp/1*ej4NUhE3AOp0DVBJR3WA5w.png">
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
                                    <li><a href="#what-is-control-flow" class="toc-link">What Is Control Flow?</a></li>
                                    <li><a href="#if-statement" class="toc-link">The if Statement</a></li>
                                    <li><a href="#if-else" class="toc-link">The if-else Statement</a></li>
                                    <li><a href="#else-if-ladder" class="toc-link">The else if Ladder</a></li>
                                    <li><a href="#switch-statement" class="toc-link">The switch Statement</a></li>
                                    <li><a href="#switch-vs-if-else" class="toc-link">switch vs if-else</a></li>
                                    <li><a href="#assignment" class="toc-link">Practice Assignment</a></li>
                                    <li><a href="#conclusion" class="toc-link">Conclusion</a></li>
                                </ul>
                            </nav>
                        </div>
                    </aside>

                    <div class="blog-main-content">
                        <header class="blog-header">
                            <h1>Control Flow in JavaScript: If, Else, and Switch Explained</h1>
                            <div class="blog-meta-row">
                                <div class="meta-category">JavaScript</div>
                                <div class="meta-author">Veeshal D. Bodosa</div>
                                <div class="meta-date">15 Mar 2026</div>
                            </div>
                        </header>

                        <div class="blog-hero-image-wrapper">
                            <img src="https://miro.medium.com/v2/resize:fit:1400/format:webp/1*ej4NUhE3AOp0DVBJR3WA5w.png" alt="JavaScript Control Flow Graphic" class="blog-hero-image" style="background: linear-gradient(135deg, #fff1c2, #f2d24c); padding: 24px; object-fit: contain;">
                        </div>

                        <article class="article-content">
                            <p class="lead" id="introduction">In real life, we make decisions all the time. If it is raining, we take an umbrella. If we pass an exam, we celebrate. If it is Sunday, we rest. Programming works in a similar way. The code checks a condition, then decides what should happen next.</p>

                            <p>That decision-making process is called <strong>control flow</strong>. In JavaScript, the most common tools for this are <code>if</code>, <code>else</code>, <code>else if</code>, and <code>switch</code>.</p>

                            <h2 id="what-is-control-flow">1. What Control Flow Means in Programming</h2>
                            <p>Control flow means the order in which your code runs. Sometimes code runs line by line. Sometimes it has to choose between different paths.</p>

                            <div class="mermaid">
                            flowchart TD
                                A["Start"] --> B["Check condition"]
                                B -->|True| C["Run one block"]
                                B -->|False| D["Run another block"]
                            </div>

                            <p>So when we talk about control flow, we are really talking about: <strong>How does the program decide what to do next?</strong></p>

                            <h2 id="if-statement">2. The <code>if</code> Statement</h2>
                            <p>Use <code>if</code> when you want code to run only when a condition is true.</p>

                            <div class="code-block">
let age = 20;

if (age >= 18) {
    console.log("You can vote");
}
                            </div>

                            <p>Step by step:</p>
                            <ul>
                                <li>JavaScript checks whether <code>age &gt;= 18</code></li>
                                <li>If the condition is true, the code inside the block runs</li>
                                <li>If the condition is false, JavaScript skips that block</li>
                            </ul>

                            <h2 id="if-else">3. The <code>if-else</code> Statement</h2>
                            <p>Use <code>if-else</code> when there are two possible outcomes.</p>

                            <div class="code-block">
let marks = 35;

if (marks >= 40) {
    console.log("Pass");
} else {
    console.log("Fail");
}
                            </div>

                            <p>Here, only one block will run. If the first condition is false, JavaScript goes to the <code>else</code> block.</p>

                            <div class="mermaid">
                            flowchart TD
                                A["Check marks >= 40"] -->|Yes| B["Print Pass"]
                                A -->|No| C["Print Fail"]
                            </div>

                            <h2 id="else-if-ladder">4. The <code>else if</code> Ladder</h2>
                            <p>Use <code>else if</code> when you have more than two choices.</p>

                            <div class="code-block">
let score = 78;

if (score >= 90) {
    console.log("Grade A");
} else if (score >= 75) {
    console.log("Grade B");
} else if (score >= 50) {
    console.log("Grade C");
} else {
    console.log("Fail");
}
                            </div>

                            <p>JavaScript checks from top to bottom. As soon as one condition is true, it runs that block and stops checking the rest.</p>

                            <h2 id="switch-statement">5. The <code>switch</code> Statement</h2>
                            <p><code>switch</code> is useful when you want to compare one value against many exact options.</p>

                            <div class="code-block">
let day = "Wednesday";

switch (day) {
    case "Monday":
        console.log("Start of the week");
        break;
    case "Wednesday":
        console.log("Midweek");
        break;
    case "Sunday":
        console.log("Holiday");
        break;
    default:
        console.log("Regular day");
}
                            </div>

                            <p>The <code>break</code> statement is important. It tells JavaScript to stop after the matching case. Without <code>break</code>, execution continues into the next case, which is usually not what beginners want.</p>

                            <div class="mermaid">
                            flowchart TD
                                A["day = Wednesday"] --> B{"switch(day)"}
                                B --> C["case Monday"]
                                B --> D["case Wednesday"]
                                B --> E["case Sunday"]
                                B --> F["default"]
                                D --> G["Print Midweek"]
                                G --> H["break"]
                            </div>

                            <h2 id="switch-vs-if-else">6. When to Use <code>switch</code> vs <code>if-else</code></h2>
                            <p>Use <code>if-else</code> when your conditions are based on ranges or different logical expressions.</p>

                            <div class="code-block">
let temperature = 31;

if (temperature > 35) {
    console.log("Very hot");
} else if (temperature > 25) {
    console.log("Warm");
} else {
    console.log("Cool");
}
                            </div>

                            <p>Use <code>switch</code> when one variable is being matched with fixed values.</p>

                            <div class="code-block">
let role = "admin";

switch (role) {
    case "admin":
        console.log("Full access");
        break;
    case "editor":
        console.log("Edit access");
        break;
    default:
        console.log("Limited access");
}
                            </div>

                            <p>Simple rule:</p>
                            <ul>
                                <li><strong><code>if-else</code>:</strong> better for conditions like <code>&gt;</code>, <code>&lt;</code>, <code>&amp;&amp;</code>, or mixed logic</li>
                                <li><strong><code>switch</code>:</strong> better for checking one value against many exact choices</li>
                            </ul>

                            <h2 id="assignment">7. Practice Assignment</h2>
                            <p>Try these two programs in your browser console:</p>

                            <div class="code-block">
let number = -5;

if (number > 0) {
    console.log("Positive");
} else if (number < 0) {
    console.log("Negative");
} else {
    console.log("Zero");
}

let day = "Friday";

switch (day) {
    case "Monday":
        console.log("Day 1");
        break;
    case "Tuesday":
        console.log("Day 2");
        break;
    case "Wednesday":
        console.log("Day 3");
        break;
    case "Thursday":
        console.log("Day 4");
        break;
    case "Friday":
        console.log("Day 5");
        break;
    case "Saturday":
        console.log("Day 6");
        break;
    case "Sunday":
        console.log("Day 7");
        break;
    default:
        console.log("Invalid day");
}
                            </div>

                            <p>Why these structures?</p>
                            <ul>
                                <li>The positive, negative, or zero program uses <code>if-else if-else</code> because it checks different logical conditions</li>
                                <li>The weekday program uses <code>switch</code> because one variable is compared with many exact text values</li>
                            </ul>

                            <h2 id="conclusion">Conclusion</h2>
                            <p>Control flow is how a program decides which path to take. With <code>if</code>, <code>if-else</code>, <code>else if</code>, and <code>switch</code>, you can make your JavaScript respond to conditions and user input.</p>

                            <p>Start with simple decision-making examples first. Once these basics are clear, writing bigger programs becomes much easier because you will know how to control the path your code follows.</p>
                        </article>
                    </div>

                    <aside class="blog-sidebar-right">
                        <div class="sidebar-tags-wrapper">
                            <h3 class="sidebar-title">Tags</h3>
                            <div class="blog-tags">
                                <a href="" class="blog-tag">#javascript</a>
                                <a href="" class="blog-tag">#controlflow</a>
                                <a href="" class="blog-tag">#ifelse</a>
                                <a href="" class="blog-tag">#switch</a>
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
