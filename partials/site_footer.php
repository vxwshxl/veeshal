<?php
// Shared v2 footer — set $base (relative path to site root) before including.
$base = isset($base) ? $base : '';
?>
<footer class="site-footer">
    <div class="footer-top">
        <a class="brand" href="<?php echo $base; ?>"><img src="<?php echo $base; ?>assets/logo.svg" alt="vee logo"></a>
        <nav>
            <ul>
                <li><a href="<?php echo $base; ?>">Home</a></li>
                <li><a href="<?php echo $base; ?>#intro">Intro</a></li>
                <li><a href="<?php echo $base; ?>projects">Projects</a></li>
                <li><a href="<?php echo $base; ?>timeline">Timeline</a></li>
                <li><a href="<?php echo $base; ?>chaicode">ChaiCode</a></li>
                <li><a href="<?php echo $base; ?>blogs">Blogs</a></li>
                <li><a href="<?php echo $base; ?>#contact">Contact</a></li>
                <li><a href="<?php echo $base; ?>#about">About</a></li>
            </ul>
        </nav>
    </div>

    <div class="footer-giant">
        <span class="row"><span class="ghost">fall back<span class="amber">?</span></span></span>
        <span class="row"><span>redesign<span class="amber">..!</span></span></span>
    </div>

    <div class="footer-bottom">
        <span>© 2026 veeshal d. bodosa</span>
        <span>engineered with precision — crafted with passion</span>
        <span><a href="mailto:work@veeshal.me">work@veeshal.me</a></span>
    </div>
</footer>
