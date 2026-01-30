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

    <title>Getting Started with cURL - Veeshal D. Bodosa</title>
    <meta name="description" content="Getting Started with cURL: A comprehensive guide for beginners on how to use cURL to interact with servers and APIs from the command line.">
    <meta name="keywords" content="cURL, API, Web Development, Terminal, HTTP Requests, Backend, Tutorial, Beginners, webdevcohort2026">
    <meta name="author" content="Veeshal D. Bodosa">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="https://veeshal.me/blogs/getting-started-with-curl">
    <meta property="og:title" content="Getting Started with cURL">
    <meta property="og:description" content="Master the terminal's most powerful tool. Learn how to talk to servers directly using cURL.">
    <meta property="og:image" content="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d2/Curl-logo.svg/1200px-Curl-logo.svg.png">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://veeshal.me/blogs/getting-started-with-curl">
    <meta property="twitter:title" content="Getting Started with cURL">
    <meta property="twitter:description" content="Master the terminal's most powerful tool. Learn how to talk to servers directly using cURL.">
    <meta property="twitter:image" content="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d2/Curl-logo.svg/1200px-Curl-logo.svg.png">
    
</head>

<body>
    <div id="home" class="home">
        <div class="homeContainer">
            <?php include 'includes/header.php'; ?>

            <!-- Single Blog Post Content -->
            <div class="single-blog-container with-sidebar">
                <div class="back-link-wrapper mobile-back-link">
                    <a href="index" class="back-link">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                        Back
                    </a>
                </div>
                
                <div class="blog-layout-grid">
                    <!-- Sticky Sidebar -->
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
                                    <li><a href="#what-is-curl" class="toc-link">What is cURL?</a></li>
                                    <li><a href="#why-use-it" class="toc-link">Why Programmers Need It</a></li>
                                    <li><a href="#first-request" class="toc-link">Your First Request</a></li>
                                    <li><a href="#request-response" class="toc-link">Understanding the Response</a></li>
                                    <li><a href="#apis" class="toc-link">Talking to APIs</a></li>
                                    <li><a href="#common-mistakes" class="toc-link">Common Mistakes</a></li>
                                </ul>
                            </nav>
                        </div>
                    </aside>

                    <!-- Main Article Content -->
                    <div class="blog-main-content">
                        <header class="blog-header">
                            <h1>Getting Started with cURL</h1>
                            <div class="blog-meta-row">
                                <div class="meta-category">Software Development</div>
                                <div class="meta-author">Veeshal D. Bodosa</div>
                                <div class="meta-date">18 Jan 2026</div>
                            </div>
                        </header>

                        <div class="blog-hero-image-wrapper">
                            <img src="https://curl.se/logo/curl-logo.svg" alt="cURL Logo" class="blog-hero-image" style="background: white; padding: 20px; border-radius: 8px;">
                        </div>

                        <article class="article-content">
                            <p class="lead" id="introduction">If you have ever built a web application, you know that the browser is your primary window into the internet. You type a URL, hit enter, and a formatted page appears. But for developers, the browser can sometimes hide too much. We often need to speak directly to servers, without the visual layer getting in the way.</p>
                            
                            <p>This is where the command line comes in. Just as you navigate files with commands, you can also navigate the web. To do this, we use a tool that has been the industry standard for decades: cURL.</p>

                            <h2 id="what-is-curl">What is cURL?</h2>
                            <p>cURL (Client URL) is a command-line tool used to transfer data to and from a server. Think of it as a web browser without the graphical user interface. Instead of rendering images and buttons, it simply sends a request and shows you the raw text the server sends back.</p>

                            <div class="mermaid">
                            graph LR
                                A[Terminal] -->|cURL Request| B[Server]
                                B -->|Raw Response| A
                            </div>

                            <p>It supports almost every protocol you can imagine, but for web developers, it is primarily used to make HTTP and HTTPS requests. It is installed by default on macOS and most Linux distributions, and it is easily available on Windows.</p>

                            <h2 id="why-use-it">Why Programmers Need cURL</h2>
                            <p>You might wonder why you would use a text-based tool when Chrome or Firefox exist. The answer lies in precision and automation.</p>

                            <div class="mermaid">
                            graph TD
                                Dev[Developer] -->|Using cURL| API[Backend API]
                                Dev -->|Using Browser| FE[Frontend App]
                                FE -->|Internal API Calls| API
                            </div>

                            <p>When you are building an API (Application Programming Interface), you don't always have a frontend ready to test it. You need a way to send specific data to your server and check exactly what it returns. cURL allows you to test endpoints, specific headers, and authentication flows instantly from your terminal. It is also scriptable, meaning you can write simple programs to check if your server is up or to download files automatically.</p>

                            <h2 id="first-request">Making Your First Request</h2>
                            <p>Let's strip away the complexity and try the simplest possible command. Open your terminal and type the following:</p>

                            <div class="code-block">
                                <span class="command">curl https://example.com</span>
                            </div>

                            <div class="mermaid">
                            graph TD
                                subgraph Browser_Request [Browser Request]
                                    direction TB
                                    B1[Start] --> B2[Fetch HTML]
                                    B2 --> B3[Fetch CSS/JS]
                                    B3 --> B4[Render Visuals]
                                end
                                
                                subgraph cURL_Request [cURL Request]
                                    direction TB
                                    C1[Start] --> C2[Fetch HTML]
                                    C2 --> C3[Show Raw Text]
                                end
                            </div>

                            <p>When you press enter, you won't see a webpage. You will see a flood of HTML code. This is exactly what your browser sees before it turns that code into the visual page you are used to. You have just successfully communicated with a server manually.</p>

                            <h2 id="request-response">Understanding Request and Response</h2>
                            <p>Every interaction on the web follows a conversation pattern: the Request and the Response.</p>

                            <div class="mermaid">
                            sequenceDiagram
                                participant Client as cURL/Browser
                                participant Server
                                Client->>Server: HTTP Request (GET /)
                                Note right of Server: Processing...
                                Server->>Client: HTTP Response (200 OK + Data)
                            </div>

                            <p>The <strong>Request</strong> is what you sent. In our example above, cURL sent a "GET" request to <code>example.com</code>. It essentially asked, "Can I please have the content of your homepage?"</p>

                            <p>The <strong>Response</strong> is what you got back. It contains two main parts: the Header and the Body. The Body is the HTML you saw. The Headers contain metadata, like the status code (200 OK means success, 404 means not found). To see these headers, we add a simple flag, <code>-i</code> (include headers):</p>

                            <div class="code-block">
                                <span class="command">curl -i https://example.com</span>
                            </div>

                            <p>Now, at the top of the output, you will see lines like <code>HTTP/1.1 200 OK</code>. This confirms the server received your message and processed it successfully.</p>

                            <h2 id="apis">Using cURL to Talk to APIs</h2>
                            <p>Modern web development is powered by APIs. These are servers that return data (usually JSON) instead of HTML. cURL is the perfect tool for testing them.</p>

                            <p>By default, cURL makes a GET request, which retrieves data. But often we need to send data to a server to create something new. This is done using a POST request. In cURL, we change the method using the <code>-X</code> flag and send data using the <code>-d</code> flag.</p>

                            <div class="code-block">
                                <span class="command">curl -X POST -d "name=Veeshal" https://httpbin.org/post</span>
                            </div>

                            <p>In this command, we are telling the server, "I am sending you a POST request with the data 'name=Veeshal'." The server at <code>httpbin.org</code> will reply with the data it received, proving the connection worked.</p>

                            <h2 id="common-mistakes">Common Mistakes Beginners Make</h2>
                            <p>As you start using cURL, you will likely encounter a few common hurdles. The most frequent issue is forgetting the protocol. If you type <code>curl example.com</code> without the <code>https://</code>, some versions might fail or assume the wrong protocol. Always be explicit.</p>

                            <p>Another common mistake is quoting. When sending JSON data, you must be careful with your quotes. In general, wrap the entire data string in single quotes and use double quotes for the JSON keys and values to ensure the specific shell (like zsh or bash) doesn't misinterpret them.</p>

                            <h3>Conclusion</h3>
                            <p>cURL is a fundamental tool in a developer's arsenal. It bridges the gap between writing code and understanding how that code travels across the network. By mastering these simple commands—fetching a page, checking headers, and sending data—you take control of the backend and move one step closer to becoming a complete software engineer.</p>
                        </article>
                    </div>

                    <!-- Right Sidebar (Tags) -->
                    <aside class="blog-sidebar-right">
                        <div class="sidebar-tags-wrapper">
                            <h3 class="sidebar-title">Tags</h3>
                            <div class="blog-tags">
                                <a href="" class="blog-tag">#curl</a>
                                <a href="" class="blog-tag">#api</a>
                                <a href="" class="blog-tag">#terminal</a>
                                <a href="" class="blog-tag">#webdevcohort2026</a>
                            </div>
                        </div>
                    </aside>
        </div>
    </div>
    </div>

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>
</div>

    <!-- Toast Notification Container -->
    <?php include 'includes/footer_resources.php'; ?>
    <!-- Custom Script for Single Blog Post -->
    <script src="../js/singleBlogScript.js"></script>
</body>
</html>
