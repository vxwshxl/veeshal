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

    <title>TCP vs UDP: When to Use What - Veeshal D. Bodosa</title>
    <meta name="description" content="Understand the core differences between TCP and UDP, and learn how HTTP relies on TCP for reliable communication.">
    <meta name="keywords" content="TCP, UDP, HTTP, Networking, Web Development, Protocols, Transport Layer, webdevcohort2026">
    <meta name="author" content="Veeshal D. Bodosa">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="https://veeshal.me/blogs/tcp-vs-udp">
    <meta property="og:title" content="TCP vs UDP: When to Use What">
    <meta property="og:description" content="Reliability vs. Speed: The eternal trade-off in networking explained.">
    <meta property="og:image" content="https://miro.medium.com/v2/resize:fit:1400/format:webp/1*ZPtAG6N2qQB_iIFzEtPP7Q.png">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://veeshal.me/blogs/tcp-vs-udp">
    <meta property="twitter:title" content="TCP vs UDP: When to Use What">
    <meta property="twitter:description" content="Reliability vs. Speed: The eternal trade-off in networking explained.">
    <meta property="twitter:image" content="https://miro.medium.com/v2/resize:fit:1400/format:webp/1*ZPtAG6N2qQB_iIFzEtPP7Q.png">
    
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
                                    <li><a href="#tcp" class="toc-link">TCP: Reliability First</a></li>
                                    <li><a href="#udp" class="toc-link">UDP: Speed First</a></li>
                                    <li><a href="#comparison" class="toc-link">Key Differences</a></li>
                                    <li><a href="#http-tcp" class="toc-link">HTTP and TCP</a></li>
                                    <li><a href="#conclusion" class="toc-link">Conclusion</a></li>
                                </ul>
                            </nav>
                        </div>
                    </aside>

                    <!-- Main Article Content -->
                    <div class="blog-main-content">
                        <header class="blog-header">
                            <h1>TCP vs UDP: When to Use What</h1>
                            <div class="blog-meta-row">
                                <div class="meta-category">Software Development</div>
                                <div class="meta-author">Veeshal D. Bodosa</div>
                                <div class="meta-date">21 Jan 2026</div>
                            </div>
                        </header>

                        <div class="blog-hero-image-wrapper">
                            <img src="https://miro.medium.com/v2/resize:fit:1400/format:webp/1*ZPtAG6N2qQB_iIFzEtPP7Q.png" alt="TCP vs UDP Diagram" class="blog-hero-image" style="background: white; padding: 20px;">
                        </div>

                        <article class="article-content">
                            <p class="lead" id="introduction">The internet is chaos effectively organized by rules. When you send data—whether it is an email, a video stream, or a web request—it is broken down into small packets. How those packets get from point A to point B depends entirely on the transport protocol you choose. The two dominant players in this arena are TCP and UDP.</p>
                            
                            <p>For developers, understanding the distinction isn't just academic; it dictates how you build real-time games, streaming services, and robust APIs.</p>

                            <h2 id="tcp">TCP: The Reliable Courier (Transmission Control Protocol)</h2>
                            <p>TCP is the foundation of most internet traffic. It prioritizes <strong>reliability</strong> above all else. When you use TCP, you are guaranteeing that your data will arrive intact and in the correct order.</p>

                            <p>Think of TCP like a certified mail courier or a phone call. You pick up the phone, establish a connection ("Hello?"), have your conversation, and then say goodbye. If you say something and the other person doesn't hear it, you repeat it.</p>

                            <div class="mermaid">
                            sequenceDiagram
                                participant Sender
                                participant Receiver
                                Sender->>Receiver: SYN (Let's connect)
                                Receiver-->>Sender: SYN-ACK (Okay, ready)
                                Sender->>Receiver: ACK (Great!)
                                Note over Sender, Receiver: Connection Established
                                Sender->>Receiver: Data Packet 1
                                Receiver-->>Sender: Acknowledge Packet 1
                                Sender->>Receiver: Data Packet 2
                            </div>

                            <p><strong>Use Cases:</strong> Any application where missing data is unacceptable.
                            <br>- Browsing websites (HTTP/HTTPS)
                            <br>- Sending emails (SMTP)
                            <br>- File transfers (FTP)</p>

                            <h2 id="udp">UDP: The Fast Loudspeaker (User Datagram Protocol)</h2>
                            <p>UDP is the rebel. It prioritizes <strong>speed</strong> and efficiency. It doesn't care about connections, order, or error checking. It simply fires packets at the destination and hopes for the best.</p>

                            <p>Think of UDP like a live announcement over a loudspeaker or a radio broadcast. You speak into the mic. If someone in the back misses a word due to noise, you don't stop and repeat it; you just keep talking.</p>

                            <div class="mermaid">
                            graph LR
                                Sender[Sender] -->|Packet 1| Receiver[Receiver]
                                Sender -->|"Packet 2 (Lost)"| X["X"]
                                Sender -->|Packet 3| Receiver
                                Sender -->|Packet 4| Receiver
                            </div>

                            <p><strong>Use Cases:</strong> Applications where speed is critical and minor data loss is acceptable.
                            <br>- Video streaming (YouTube, Twitch) - A dropped frame is better than a pause.
                            <br>- Online Gaming - Old position data is useless; you need the current state instantly.
                            <br>- DNS Lookups - Speed is key for the initial query.</p>

                            <h2 id="comparison">The Great Divide: TCP vs UDP</h2>
                            <p>Here is how they stack up against each other:</p>

                            <div class="mermaid">
                            graph TD
                                subgraph TCP ["TCP (Reliable)"]
                                    T1[Connection-Oriented]
                                    T2[Guaranteed Delivery]
                                    T3[Ordered Packets]
                                    T4[Slower / Overhead]
                                end
                                
                                subgraph UDP ["UDP (Fast)"]
                                    U1[Connectionless]
                                    U2[Fire and Forget]
                                    U3[Unordered]
                                    U4[Low Latency]
                                end
                            </div>

                            <h2 id="http-tcp">Where Does HTTP Fit?</h2>
                            <p>A common source of confusion for beginners is the relationship between HTTP and specific transport protocols. <strong>HTTP is not a replacement for TCP.</strong></p>
                            
                            <p>HTTP (HyperText Transfer Protocol) lives at the <strong>Application Layer</strong> (Layer 7). It defines <em>what</em> the messages mean (GET, POST, 200 OK).
                            <br>TCP lives at the <strong>Transport Layer</strong> (Layer 4). It handles <em>how</em> those messages are moved across the wire.</p>

                            <div class="mermaid">
                            graph TD
                                App[Application Layer: HTTP] -->|Data Payload| Transport[Transport Layer: TCP]
                                Transport -->|Segments| Network[Network Layer: IP]
                                Network -->|Packets| Link[Physical Layer: Ethernet/WiFi]
                            </div>

                            <p>When you visit a website, your browser uses HTTP to format a "GET" request. It then hands that request to TCP. TCP chops it up, numbers the pieces, sends them to the server, and ensures they arrive. The server's TCP layer reassembles them and hands the complete HTTP request to the web server software.</p>
                            
                            <p>This is why the web is reliable. You never load a webpage and find that the middle paragraph is missing or the CSS arrived before the HTML. TCP ensures the HTTP document is reconstructed perfectly.</p>

                            <h2 id="conclusion">Conclusion</h2>
                            <p>Choosing between TCP and UDP is a trade-off between reliability and latency. If every bit matters (like a bank transfer or a webpage), use TCP. If real-time responsiveness matters more than perfection (like a video call or a shooter game), use UDP. Understanding this foundational layer helps you design systems that are not just functional, but optimized for their specific purpose.</p>
                        </article>
                    </div>

                    <!-- Right Sidebar (Tags) -->
                    <aside class="blog-sidebar-right">
                        <div class="sidebar-tags-wrapper">
                            <h3 class="sidebar-title">Tags</h3>
                            <div class="blog-tags">
                                <a href="" class="blog-tag">#networking</a>
                                <a href="" class="blog-tag">#tcp</a>
                                <a href="" class="blog-tag">#udp</a>
                                <a href="" class="blog-tag">#http</a>
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
