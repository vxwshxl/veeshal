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

    <title>DNS Record Types Explained - Veeshal D. Bodosa</title>
    <meta name="description" content="DNS Record Types Explained: Understand A, AAAA, CNAME, MX, TXT, and NS records with simple analogies. Ideally for Web Dev Cohort 2026.">
    <meta name="keywords" content="DNS, Domain Name System, A Record, CNAME, MX Record, Web Development, Tutorial, Beginners, internet, networking, webdevcohort2026">
    <meta name="author" content="Veeshal D. Bodosa">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="https://veeshal.me/blogs/dns-record-types-explained">
    <meta property="og:title" content="DNS Record Types Explained">
    <meta property="og:description" content="Master the basics of DNS records. A comprehensive guide for beginners explaining how browsers find websites.">
    <meta property="og:image" content="https://www.cloudflare.com/img/learning/dns/what-is-dns/dns-lookup-diagram.png">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://veeshal.me/blogs/dns-record-types-explained">
    <meta property="twitter:title" content="DNS Record Types Explained">
    <meta property="twitter:description" content="Master the basics of DNS records. A comprehensive guide for beginners explaining how browsers find websites.">
    <meta property="twitter:image" content="https://www.cloudflare.com/img/learning/dns/what-is-dns/dns-lookup-diagram.png">
    
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
                                    <li><a href="#what-is-dns" class="toc-link">What is DNS?</a></li>
                                    <li><a href="#ns-record" class="toc-link">1. NS Record</a></li>
                                    <li><a href="#a-record" class="toc-link">2. A Record</a></li>
                                    <li><a href="#aaaa-record" class="toc-link">3. AAAA Record</a></li>
                                    <li><a href="#cname-record" class="toc-link">4. CNAME Record</a></li>
                                    <li><a href="#mx-record" class="toc-link">5. MX Record</a></li>
                                    <li><a href="#txt-record" class="toc-link">6. TXT Record</a></li>
                                    <li><a href="#summary" class="toc-link">Putting It All Together</a></li>
                                </ul>
                            </nav>
                        </div>
                    </aside>

                    <!-- Main Article Content -->
                    <div class="blog-main-content">
                        <header class="blog-header">
                            <h1>DNS Record Types Explained</h1>
                            <div class="blog-meta-row">
                                <div class="meta-category">Software Development</div>
                                <div class="meta-author">Veeshal D. Bodosa</div>
                                <div class="meta-date">30 Jan 2026</div>
                            </div>
                        </header>

                        <div class="blog-hero-image-wrapper">
                            <img src="https://www.cloudflare.com/img/learning/dns/what-is-dns/dns-lookup-diagram.png" alt="DNS Lookup Diagram" class="blog-hero-image">
                        </div>

                        <article class="article-content">
                            <p class="lead">Every time you access a website, your browser translates a human-readable domain name into a machine-readable IP address. This process relies on the Domain Name System (DNS). While often compared to a phonebook, it is more of a distributed database that directs internet traffic to the correct destination.</p>
                            
                            <p>Computers communicate using numbers, specifically IP addresses. DNS bridges the gap between the names we remember and the infrastructure that powers the web.</p>

                            <h2 id="what-is-dns">What is DNS?</h2>
                            <p>At its core, DNS maps names to numbers. When you visit <code>example.com</code>, DNS looks up the corresponding IP address so your browser can request the site's resources. Beyond simple address lookups, DNS manages email routing, domain verification, and service aliases through specific record types.</p>
                            
                            <div class="mermaid">
                            graph LR
                                A[User] -->|Types google.com| B(Browser)
                                B -->|Asks for IP| C(DNS Resolver)
                                C -->|Returns 142.250.183.14| B
                                B -->|Requests Content| D[Server]
                                D -->|Sends Website| A
                            </div>

                            <p>These records dictate how different types of traffic should be handled for a single domain name. Understanding them is essential for managing any web infrastructure.</p>

                            <h2 id="ns-record">1. NS Record (Name Server)</h2>
                            <p>An NS record establishes authority as shown below:</p>
                            
                            <div class="mermaid">
                            graph TD
                                Root[.] --> TLD[.com]
                                TLD --> Auth[NS: ns1.provider.com]
                                Auth --> Domain[mycoolsite.com]
                            </div>

                            <p>It indicates which specific server holds the master DNS records for a domain. Without an NS record, the global DNS network has no way of knowing where to look for your domain's details. It effectively delegates management of the zone to a specific provider.</p>

                            <h2 id="a-record">2. A Record (Address)</h2>
                            <p>The A record is the fundamental building block of DNS. It maps a domain name directly to an IPv4 address.</p>
                            
                            <div class="mermaid">
                            graph LR
                                A[example.com] -->|A Record| B[93.184.216.34]
                            </div>

                            <p>For instance, it connects <code>example.com</code> to <code>93.184.216.34</code>. This is the primary record used to point a domain to a web server.</p>

                            <h2 id="aaaa-record">3. AAAA Record</h2>
                            <p>As the number of connected devices outgrew the IPv4 protocol, IPv6 was introduced to provide a vastly larger address space. The AAAA record performs the same function as an A record but connects a domain to a 128-bit IPv6 address. It ensures compatibility with modern network infrastructure.</p>

                            <h2 id="cname-record">4. CNAME Record (Canonical Name)</h2>
                            <p>A CNAME record acts as an alias. Instead of pointing to an IP address, it points one domain name to another.</p>

                            <div class="mermaid">
                            graph LR
                                A[www.example.com] -->|CNAME| B[example.com]
                                B -->|A Record| C[93.184.216.34]
                            </div>

                            <p>This is commonly used for subdomains; for example, <code>www.example.com</code> might point to <code>example.com</code>. If the underlying IP address of the main domain changes, the alias automatically resolves to the new address without requiring an update.</p>

                            <h2 id="mx-record">5. MX Record (Mail Exchange)</h2>
                            <p>DNS handles more than just web traffic. The MX record directs email to the correct mail server.</p>

                            <div class="mermaid">
                            graph LR
                                Sender -->|Sends Email| DNS
                                DNS -->|Looks up MX| MX[smtp.google.com]
                                MX -->|Delivers to| Inbox
                            </div>

                            <p>This separation allows you to host your website on one server while routing emails to a specialized service like Gmail or Outlook. You can define multiple MX records with varying priorities to establish backup mail servers.</p>

                            <h2 id="txt-record">6. TXT Record (Text)</h2>
                            <p>TXT records store arbitrary text data in a domain's DNS zone. While they do not affect how a website loads, they are critical for verification and security. Services like Google Search Console use them to verify ownership, and email protocols like SPF and DKIM use them to prevent spoofing.</p>

                            <h2 id="summary">Putting It All Together</h2>
                            <p>A typical domain configuration combines these records to create a fully functional presence. In a real-world scenario for <code>mycoolsite.com</code>, the configuration might look like this:</p>

                            <table style="width: 100%; border-collapse: collapse; margin-top: 20px; margin-bottom: 20px;">
                                <thead style="background-color: #f1f1f1; text-align: left;">
                                    <tr>
                                        <th style="padding: 10px; border-bottom: 2px solid #ddd;">Record Type</th>
                                        <th style="padding: 10px; border-bottom: 2px solid #ddd;">Host</th>
                                        <th style="padding: 10px; border-bottom: 2px solid #ddd;">Value / Destination</th>
                                        <th style="padding: 10px; border-bottom: 2px solid #ddd;">Purpose</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="padding: 10px; border-bottom: 1px solid #ddd;"><strong>NS</strong></td>
                                        <td style="padding: 10px; border-bottom: 1px solid #ddd;">`@`</td>
                                        <td style="padding: 10px; border-bottom: 1px solid #ddd;">`ns1.provider.com`</td>
                                        <td style="padding: 10px; border-bottom: 1px solid #ddd;">Delegates authority</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 10px; border-bottom: 1px solid #ddd;"><strong>A</strong></td>
                                        <td style="padding: 10px; border-bottom: 1px solid #ddd;">`@`</td>
                                        <td style="padding: 10px; border-bottom: 1px solid #ddd;">`192.0.2.1`</td>
                                        <td style="padding: 10px; border-bottom: 1px solid #ddd;">Points to web server</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 10px; border-bottom: 1px solid #ddd;"><strong>CNAME</strong></td>
                                        <td style="padding: 10px; border-bottom: 1px solid #ddd;">`www`</td>
                                        <td style="padding: 10px; border-bottom: 1px solid #ddd;">`mycoolsite.com`</td>
                                        <td style="padding: 10px; border-bottom: 1px solid #ddd;">Aliases www to root</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 10px; border-bottom: 1px solid #ddd;"><strong>MX</strong></td>
                                        <td style="padding: 10px; border-bottom: 1px solid #ddd;">`@`</td>
                                        <td style="padding: 10px; border-bottom: 1px solid #ddd;">`smtp.google.com`</td>
                                        <td style="padding: 10px; border-bottom: 1px solid #ddd;">Routes email</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 10px; border-bottom: 1px solid #ddd;"><strong>TXT</strong></td>
                                        <td style="padding: 10px; border-bottom: 1px solid #ddd;">`@`</td>
                                        <td style="padding: 10px; border-bottom: 1px solid #ddd;">`google-site-verification`</td>
                                        <td style="padding: 10px; border-bottom: 1px solid #ddd;">Verifies ownership</td>
                                    </tr>
                                </tbody>
                            </table>

                            <h3>Conclusion</h3>
                            <p>Effective domain management relies on correctly configuring these records. NS records delegate control, A and CNAME records direct users to your site, MX records handle communication, and TXT records provide necessary verification. Each component plays a specific role in ensuring a domain functions correctly across the internet.</p>
                        </article>
                    </div>

                    <!-- Right Sidebar (Tags) -->
                    <aside class="blog-sidebar-right">
                        <div class="sidebar-tags-wrapper">
                            <h3 class="sidebar-title">Tags</h3>
                            <div class="blog-tags">
                                <a href="" class="blog-tag">#webdev</a>
                                <a href="" class="blog-tag">#dns</a>
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
