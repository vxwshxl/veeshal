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

    <title>Understanding Object-Oriented Programming in JavaScript - Veeshal D. Bodosa</title>
    <meta name="description" content="Learn JavaScript OOP with classes, objects, constructors, methods, and beginner-friendly encapsulation using simple real-world examples.">
    <meta name="keywords" content="JavaScript, OOP, classes, objects, constructor, methods, encapsulation, instances, webdevcohort2026">
    <meta name="author" content="Veeshal D. Bodosa">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="https://veeshal.me/blogs/understanding-oop-in-javascript">
    <meta property="og:title" content="Understanding Object-Oriented Programming in JavaScript">
    <meta property="og:description" content="A beginner-friendly guide to OOP in JavaScript using classes, objects, constructors, and methods.">
    <meta property="og:image" content="https://miro.medium.com/0*wgDCQoZtprrPg272.jpg">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://veeshal.me/blogs/understanding-oop-in-javascript">
    <meta property="twitter:title" content="Understanding Object-Oriented Programming in JavaScript">
    <meta property="twitter:description" content="A beginner-friendly guide to OOP in JavaScript using classes, objects, constructors, and methods.">
    <meta property="twitter:image" content="https://miro.medium.com/0*wgDCQoZtprrPg272.jpg">
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
                                    <li><a href="#what-is-oop" class="toc-link">What Is OOP?</a></li>
                                    <li><a href="#blueprint-analogy" class="toc-link">Blueprint Analogy</a></li>
                                    <li><a href="#what-is-class" class="toc-link">What Is a Class?</a></li>
                                    <li><a href="#creating-objects" class="toc-link">Creating Objects with Classes</a></li>
                                    <li><a href="#constructor-method" class="toc-link">Constructor Method</a></li>
                                    <li><a href="#methods-inside-class" class="toc-link">Methods Inside a Class</a></li>
                                    <li><a href="#encapsulation" class="toc-link">Basic Encapsulation</a></li>
                                    <li><a href="#assignment" class="toc-link">Practice Assignment</a></li>
                                    <li><a href="#conclusion" class="toc-link">Conclusion</a></li>
                                </ul>
                            </nav>
                        </div>
                    </aside>

                    <div class="blog-main-content">
                        <header class="blog-header">
                            <h1>Understanding Object-Oriented Programming in JavaScript</h1>
                            <div class="blog-meta-row">
                                <div class="meta-category">JavaScript</div>
                                <div class="meta-author">Veeshal D. Bodosa</div>
                                <div class="meta-date">15 Mar 2026</div>
                            </div>
                        </header>

                        <div class="blog-hero-image-wrapper">
                            <img src="https://miro.medium.com/0*wgDCQoZtprrPg272.jpg" alt="JavaScript OOP" class="blog-hero-image" style="background: linear-gradient(135deg, #fff9dc, #eed35a); padding: 24px; object-fit: contain;">
                        </div>

                        <article class="article-content">
                            <p class="lead" id="introduction">Object-Oriented Programming, or OOP, is a way of organizing code using objects. Instead of writing unrelated variables and functions everywhere, OOP helps us group related data and behavior together. This makes code easier to reuse, easier to read, and easier to manage as projects grow.</p>

                            <p>In JavaScript, modern OOP is usually taught with <code>class</code> syntax. It is a beginner-friendly way to create many similar objects without repeating the same code again and again.</p>

                            <h2 id="what-is-oop">1. What Object-Oriented Programming Means</h2>
                            <p>OOP is a programming style where we model real-world things as objects. An object can contain:</p>
                            <ul>
                                <li><strong>properties</strong> for data</li>
                                <li><strong>methods</strong> for behavior</li>
                            </ul>

                            <p>For example, a car has properties like color and model, and behavior like start or stop. OOP lets us represent that structure in code.</p>

                            <h2 id="blueprint-analogy">2. Real-World Analogy: Blueprint to Objects</h2>
                            <p>Think about a car factory. A blueprint describes what every car should look like. But the blueprint itself is not a real car. It is just the plan.</p>

                            <p>From that one blueprint, the factory can make many actual cars. In OOP:</p>
                            <ul>
                                <li>a <strong>class</strong> is the blueprint</li>
                                <li>an <strong>object</strong> is the real item created from that blueprint</li>
                            </ul>

                            <div class="mermaid">
                            flowchart LR
                                A["Car Blueprint"] --> B["Car Object 1"]
                                A --> C["Car Object 2"]
                                A --> D["Car Object 3"]
                            </div>

                            <h2 id="what-is-class">3. What Is a Class in JavaScript?</h2>
                            <p>A class is a template used to create objects with the same structure.</p>

                            <div class="code-block">
class Car {

}
                            </div>

                            <p>This class does not do much yet, but it shows the basic syntax. The class becomes useful when we add properties and methods inside it.</p>

                            <h2 id="creating-objects">4. Creating Objects Using Classes</h2>
                            <p>Once a class is ready, we create objects from it using the <code>new</code> keyword.</p>

                            <div class="code-block">
class Car {
    constructor(brand, color) {
        this.brand = brand;
        this.color = color;
    }
}

const car1 = new Car("Toyota", "Red");
const car2 = new Car("Honda", "Blue");

console.log(car1);
console.log(car2);
                            </div>

                            <p>Here, <code>car1</code> and <code>car2</code> are different objects, but both were created from the same class.</p>

                            <div class="mermaid">
                            flowchart TD
                                A["Class: Car"] --> B["Instance: car1"]
                                A --> C["Instance: car2"]
                            </div>

                            <h2 id="constructor-method">5. Constructor Method</h2>
                            <p>The <code>constructor</code> is a special method inside a class. It runs automatically when a new object is created.</p>

                            <div class="code-block">
class Person {
    constructor(name, age) {
        this.name = name;
        this.age = age;
    }
}

const user1 = new Person("Veeshal", 22);
console.log(user1.name);
// Veeshal
                            </div>

                            <p>In this example:</p>
                            <ul>
                                <li><code>name</code> and <code>age</code> are values passed while creating the object</li>
                                <li><code>this.name</code> and <code>this.age</code> store those values inside the new object</li>
                            </ul>

                            <h2 id="methods-inside-class">6. Methods Inside a Class</h2>
                            <p>Methods are functions written inside a class. They describe what an object can do.</p>

                            <div class="code-block">
class Student {
    constructor(name, age) {
        this.name = name;
        this.age = age;
    }

    showDetails() {
        console.log("Name:", this.name);
        console.log("Age:", this.age);
    }
}

const student1 = new Student("Riya", 20);
student1.showDetails();
                            </div>

                            <p>The <code>showDetails()</code> method belongs to the class, so every object created from that class can use it.</p>

                            <h2 id="encapsulation">7. Basic Idea of Encapsulation</h2>
                            <p>Encapsulation means keeping related data and behavior together inside one structure.</p>

                            <div class="code-block">
class BankAccount {
    constructor(owner, balance) {
        this.owner = owner;
        this.balance = balance;
    }

    deposit(amount) {
        this.balance = this.balance + amount;
    }
}

const account1 = new BankAccount("Riya", 1000);
account1.deposit(500);
console.log(account1.balance);
// 1500
                            </div>

                            <p>Here, the account data and the deposit behavior are kept together in one class. That is the beginner-friendly idea of encapsulation. We are not going into private fields or advanced access control yet.</p>

                            <h2 id="assignment">8. Practice Assignment</h2>
                            <p>Try this in your browser console:</p>

                            <div class="code-block">
class Student {
    constructor(name, age) {
        this.name = name;
        this.age = age;
    }

    printDetails() {
        console.log("Student:", this.name, "-", this.age);
    }
}

const student1 = new Student("Riya", 20);
const student2 = new Student("Aman", 22);

student1.printDetails();
student2.printDetails();
                            </div>

                            <p>This assignment shows:</p>
                            <ul>
                                <li>a class named <code>Student</code></li>
                                <li>properties like <code>name</code> and <code>age</code></li>
                                <li>a method that prints student details</li>
                                <li>multiple objects created from the same class</li>
                            </ul>

                            <h2 id="conclusion">Conclusion</h2>
                            <p>OOP helps organize JavaScript code by using classes as blueprints and objects as real instances. With classes, constructors, methods, and basic encapsulation, you can build code that is cleaner and more reusable.</p>

                            <p>Start with small examples like <code>Car</code>, <code>Person</code>, and <code>Student</code>. Once these basics are clear, you will find it much easier to understand bigger JavaScript applications.</p>
                        </article>
                    </div>

                    <aside class="blog-sidebar-right">
                        <div class="sidebar-tags-wrapper">
                            <h3 class="sidebar-title">Tags</h3>
                            <div class="blog-tags">
                                <a href="" class="blog-tag">#javascript</a>
                                <a href="" class="blog-tag">#oop</a>
                                <a href="" class="blog-tag">#classes</a>
                                <a href="" class="blog-tag">#constructor</a>
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
