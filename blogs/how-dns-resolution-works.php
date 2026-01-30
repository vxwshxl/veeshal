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

    <title>How DNS Resolution Works - Veeshal D. Bodosa</title>
    <meta name="description" content="Explore the mechanics of DNS resolution. Learn how the 'dig' command reveals the journey from Root Servers to Authoritative answers.">
    <meta name="keywords" content="DNS, dig command, Root Servers, TLD, Authoritative, Web Development, Networking, Recursive Resolver, webdevcohort2026">
    <meta name="author" content="Veeshal D. Bodosa">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="https://veeshal.me/blogs/how-dns-resolution-works">
    <meta property="og:title" content="How DNS Resolution Works">
    <meta property="og:description" content="Understanding the hidden hierarchy of the internet using the dig command.">
    <meta property="og:image" content="https://media.geeksforgeeks.org/wp-content/uploads/20250801171021517035/address_resolution_in_dns.webp">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://veeshal.me/blogs/how-dns-resolution-works">
    <meta property="twitter:title" content="How DNS Resolution Works">
    <meta property="twitter:description" content="Understanding the hidden hierarchy of the internet using the dig command.">
    <meta property="twitter:image" content="https://media.geeksforgeeks.org/wp-content/uploads/20250801171021517035/address_resolution_in_dns.webp">
    
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
                                    <li><a href="#the-hierarchy" class="toc-link">The Hierarchy</a></li>
                                    <li><a href="#root-servers" class="toc-link">The Root (.)</a></li>
                                    <li><a href="#tld-servers" class="toc-link">Top Level Domains (TLD)</a></li>
                                    <li><a href="#authoritative" class="toc-link">Authoritative Servers</a></li>
                                    <li><a href="#full-resolution" class="toc-link">Full Resolution</a></li>
                                </ul>
                            </nav>
                        </div>
                    </aside>

                    <!-- Main Article Content -->
                    <div class="blog-main-content">
                        <header class="blog-header">
                            <h1>How DNS Resolution Works</h1>
                            <div class="blog-meta-row">
                                <div class="meta-category">Software Development</div>
                                <div class="meta-author">Veeshal D. Bodosa</div>
                                <div class="meta-date">30 Jan 2026</div>
                            </div>
                        </header>

                        <div class="blog-hero-image-wrapper">
                            <img src="https://media.geeksforgeeks.org/wp-content/uploads/20250801171021517035/address_resolution_in_dns.webp" alt="DNS Resolution Diagram" class="blog-hero-image" style="background: white; padding: 20px;">
                        </div>

                        <article class="article-content">
                            <p class="lead" id="introduction">We often describe DNS as the phonebook of the internet, but that analogy simplifies a highly complex, layered system. When you type a URL, your computer doesn't just look up a single list. It engages in a recursive hunt across the globe, queries multiple server layers, and pieces together the answer. To fully understand this architecture, we turn to a powerful diagnostic tool known as <code>dig</code>.</p>
                            
                            <p>This article explores the mechanics of DNS resolution, tracing the path from your local request all the way to the final IP address.</p>

                            <h2 id="the-hierarchy">The Hierarchy of the Internet</h2>
                            <p>DNS is organized as a distributed hierarchy. It is not a single database but a tree structure where each layer holds specific information about the layer below it. This ensures the system is scalable and resilient.</p>

                            <div class="mermaid">
                            graph TD
                                Root["Root Servers (.)"] --> Com[".com TLD"]
                                Root --> Org[".org TLD"]
                                Root --> Net[".net TLD"]
                                Com --> Google["google.com (Authoritative)"]
                                Com --> Amazon["amazon.com (Authoritative)"]
                                Google --> Maps["maps.google.com"]
                            </div>

                            <p>To navigate this tree, we use <code>dig</code> (Domain Information Groper). This command-line tool allows us to query DNS servers directly and inspect the response headers and records.</p>

                            <h2 id="root-servers">Step 1: The Root Name Servers</h2>
                            <p>Every DNS lookup theoretically starts at the Root. The root is the highest level of the DNS hierarchy, represented simply by a dot (<code>.</code>). There are 13 logical root name servers distributed worldwide.</p>

                            <p>We can query the root servers to see what they know. They do not know the IP address of <code>google.com</code>, but they know who manages <code>.com</code>.</p>

                            <div class="code-block">
                                <span class="command">dig . NS</span>
                            </div>

                            <p>This command asks, "Who manages the root?" The response lists the root servers (a.root-servers.net, b.root-servers.net, etc.). These are the gatekeepers that direct traffic to the Top-Level Domain (TLD) servers.</p>

                            <h2 id="tld-servers">Step 2: The TLD Name Servers</h2>
                            <p>The next layer down consists of Top-Level Domains (TLDs) like <code>.com</code>, <code>.org</code>, and <code>.io</code>. Each TLD has its own set of name servers. The root server directs our query to the TLD server responsible for the domain extension we are looking for.</p>

                            <p>If we want to find <code>google.com</code>, we first need to find the servers that manage all <code>.com</code> domains.</p>

                            <div class="code-block">
                                <span class="command">dig com. NS</span>
                            </div>

                            <p>The output here refers us to the gTLD (Generic Top-Level Domain) servers. These servers sit in the middle of the hierarchy. They don't know the final IP address of the website either, but they know exactly which "Authoritative Name Server" manages the specific domain <code>google.com</code>.</p>

                            <h2 id="authoritative">Step 3: The Authoritative Name Servers</h2>
                            <p>Finally, we reach the authority. The Authoritative Name Server is the one that actually holds the specific DNS records (A, CNAME, MX) for a domain. It is usually managed by the domain registrar (like GoDaddy) or a cloud provider (like AWS Route53 or Cloudflare).</p>

                            <p>To find out who is verifying <code>google.com</code>, we query for its NS records:</p>

                            <div class="code-block">
                                <span class="command">dig google.com NS</span>
                            </div>

                            <p>The response will list servers like <code>ns1.google.com</code>. These are the final destination in our recursive journey. They hold the definitive answer to our question: "What is the IP address of google.com?"</p>

                            <h2 id="full-resolution">Step 4: The Full Resolution Flow</h2>
                            <p>When you browse the web, your computer acts as a "Stub Resolver" and talks to a "Recursive Resolver" (usually provided by your ISP or Google's 8.8.8.8). This recursive resolver performs all the steps we just explored on your behalf.</p>

                            <div class="mermaid">
                            sequenceDiagram
                                participant Client as Client (You)
                                participant Resolver as Recursive Resolver
                                participant Root as Root Server (.)
                                participant TLD as TLD Server (.com)
                                participant Auth as Auth Server (google.com)
                                
                                Client->>Resolver: Where is google.com?
                                Resolver->>Root: Where is google.com?
                                Root->>Resolver: Go ask .com TLD (Referral)
                                Resolver->>TLD: Where is google.com?
                                TLD->>Resolver: Go ask ns1.google.com (Referral)
                                Resolver->>Auth: Where is google.com?
                                Auth->>Resolver: It is 142.250.183.14 (Answer)
                                Resolver->>Client: 142.250.183.14
                            </div>

                            <p>To see the result of this entire process, we run our final command:</p>

                            <div class="code-block">
                                <span class="command">dig google.com</span>
                            </div>

                            <p>This returns the A Record containing the IP address. The "Answer Section" of the output confirms that the recursive process succeeded, and your browser can now initiate a connection to the server.</p>

                            <h3>Conclusion</h3>
                            <p>DNS resolution is an elegant, tiered system. By using <code>dig</code>, developers can peel back these layers and verify configurations at each stage. Understanding this flow—from Root to TLD to Authoritative server—is fundamental to troubleshooting connectivity issues and designing robust network architectures.</p>
                        </article>
                    </div>

                    <!-- Right Sidebar (Tags) -->
                    <aside class="blog-sidebar-right">
                        <div class="sidebar-tags-wrapper">
                            <h3 class="sidebar-title">Tags</h3>
                            <div class="blog-tags">
                                <a href="" class="blog-tag">#dns</a>
                                <a href="" class="blog-tag">#dig</a>
                                <a href="" class="blog-tag">#networking</a>
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
