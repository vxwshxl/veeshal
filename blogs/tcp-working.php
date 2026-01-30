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

    <title>TCP Working: 3-Way Handshake & Reliable Communication - Veeshal D. Bodosa</title>
    <meta name="description" content="A deep dive into how TCP ensures reliable communication through the 3-way handshake, sequence numbers, and retransmission strategies.">
    <meta name="keywords" content="TCP, 3-Way Handshake, Networking, Reliability, SYN ACK, Web Development, webdevcohort2026">
    <meta name="author" content="Veeshal D. Bodosa">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="https://veeshal.me/blogs/tcp-working">
    <meta property="og:title" content="TCP Working: 3-Way Handshake & Reliable Communication">
    <meta property="og:description" content="How the internet ensures your data arrives perfectly, every time.">
    <meta property="og:image" content="https://i.ytimg.com/vi/_inkLnDbia0/sddefault.jpg">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://veeshal.me/blogs/tcp-working">
    <meta property="twitter:title" content="TCP Working: 3-Way Handshake & Reliable Communication">
    <meta property="twitter:description" content="How the internet ensures your data arrives perfectly, every time.">
    <meta property="twitter:image" content="https://i.ytimg.com/vi/_inkLnDbia0/sddefault.jpg">
    
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
                                    <li><a href="#handshake" class="toc-link">The 3-Way Handshake</a></li>
                                    <li><a href="#data-transfer" class="toc-link">Data Transfer</a></li>
                                    <li><a href="#packet-loss" class="toc-link">Available Handling Loss</a></li>
                                    <li><a href="#termination" class="toc-link">Closing Connection</a></li>
                                </ul>
                            </nav>
                        </div>
                    </aside>

                    <!-- Main Article Content -->
                    <div class="blog-main-content">
                        <header class="blog-header">
                            <h1>TCP Working: 3-Way Handshake & Reliable Communication</h1>
                            <div class="blog-meta-row">
                                <div class="meta-category">Software Development</div>
                                <div class="meta-author">Veeshal D. Bodosa</div>
                                <div class="meta-date">30 Jan 2026</div>
                            </div>
                        </header>

                        <div class="blog-hero-image-wrapper">
                            <img src="https://i.ytimg.com/vi/_inkLnDbia0/sddefault.jpg" alt="TCP Packet Structure" class="blog-hero-image" style="background: white; padding: 20px;">
                        </div>

                        <article class="article-content">
                            <p class="lead" id="introduction">Imagine sending a letter where you cut the paper into tiny pieces, mail them in separate envelopes, and just hope they all arrive. That is the internet without TCP. The Transmission Control Protocol (TCP) is the mechanism that turns the chaotic, unreliable web into a stable communication channel.</p>
                            
                            <p>It guarantees that data arrives in order, without errors, and without gaps. But how does it actually achieve this? It starts with a handshake.</p>

                            <h2 id="handshake">The 3-Way Handshake</h2>
                            <p>Before any data is exchanged, two computers must agree to talk. This process is called the 3-Way Handshake. It ensures both sides are ready to send and receive data.</p>
                            
                            <p>Analogy: Imagine calling a friend.</p>
                            <ul>
                                <li><strong>You:</strong> "Hello, can you hear me?" (SYN)</li>
                                <li><strong>Friend:</strong> "Yes, I hear you. Can you hear me?" (SYN-ACK)</li>
                                <li><strong>You:</strong> "Yes, I hear you." (ACK)</li>
                            </ul>
                            
                            <p>Only after this confirmation do you start the actual conversation.</p>

                            <div class="mermaid">
                            sequenceDiagram
                                participant Client
                                participant Server
                                Note over Client, Server: The 3-Way Handshake
                                Client->>Server: SYN (Sequence: 0)
                                Server-->>Client: SYN-ACK (Ack: 1, Sequence: 0)
                                Client->>Server: ACK (Ack: 1, Sequence: 1)
                                Note over Client, Server: Connection Established!
                            </div>

                            <p><strong>Step 1 (SYN):</strong> The client sends a synchronization packet to the server.</p>
                            <p><strong>Step 2 (SYN-ACK):</strong> The server acknowledges the client's packet and sends its own synchronization request.</p>
                            <p><strong>Step 3 (ACK):</strong> The client acknowledges the server's request. The connection is now open.</p>

                            <h2 id="data-transfer">Data Transfer: Sequence & Acknowledgement</h2>
                            <p>Once connected, how does TCP keep track of data? It uses <strong>Sequence Numbers</strong>. Every byte of data sent is numbered. This allows the receiver to reassemble the packets in the correct order, even if they arrive out of sequence.</p>

                            <div class="mermaid">
                            sequenceDiagram
                                participant Sender
                                participant Receiver
                                Sender->>Receiver: Data Packet 1 (Seq: 100)
                                Receiver-->>Sender: ACK 200 (I received up to 199, send 200 next)
                                Sender->>Receiver: Data Packet 2 (Seq: 200)
                                Receiver-->>Sender: ACK 300 (I received up to 299, send 300 next)
                            </div>

                            <p>The "Acknowledgement" (ACK) is crucial. It tells the sender exactly how much data has been successfully received.</p>

                            <h2 id="packet-loss">Handling Packet Loss</h2>
                            <p>The internet is unreliable. Packets get lost all the time. TCP handles this automatically using timeouts and retransmissions. If the sender sends a packet but doesn't receive an ACK within a specific time limit, it assumes the packet was lost and sends it again.</p>

                            <div class="mermaid">
                            sequenceDiagram
                                participant Sender
                                participant Receiver
                                Sender->>X Receiver: Data Packet 1 (LOST)
                                Note right of Sender: Waiting for ACK...
                                Note right of Sender: Timeout!
                                Sender->>Receiver: Data Packet 1 (Retransmission)
                                Receiver-->>Sender: ACK (Received Packet 1)
                            </div>

                            <p>This is why TCP is slower than UDP—it will pause and retry until the data is correct. It prioritizes accuracy over speed.</p>

                            <h2 id="termination">Closing the Connection</h2>
                            <p>When the conversation is over, the connection must be closed gracefully to ensure no data is left in transit. This uses a 4-step process often called the "Four-Way Handshake".</p>

                            <div class="mermaid">
                            sequenceDiagram
                                participant Client
                                participant Server
                                Client->>Server: FIN (I am done sending)
                                Server-->>Client: ACK (I heard you)
                                Server->>Client: FIN (I am also done)
                                Client-->>Server: ACK (Goodbye)
                                Note over Client, Server: Connection Closed
                            </div>

                            <h3>Conclusion</h3>
                            <p>TCP is the unsung hero of the internet. Its intricate dance of handshakes, acknowledgements, and retransmissions happens billions of times a day, allowing us to trust that the file we download or the message we read is exactly what was sent.</p>
                        </article>
                    </div>

                    <!-- Right Sidebar (Tags) -->
                    <aside class="blog-sidebar-right">
                        <div class="sidebar-tags-wrapper">
                            <h3 class="sidebar-title">Tags</h3>
                            <div class="blog-tags">
                                <a href="" class="blog-tag">#tcp</a>
                                <a href="" class="blog-tag">#networking</a>
                                <a href="" class="blog-tag">#handshake</a>
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
