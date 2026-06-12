<?php
// Shared v2 header — set $active ('home','projects','timeline','chaicode','blogs')
// and $base (relative path to site root, e.g. '../') before including.
$active = isset($active) ? $active : '';
$base = isset($base) ? $base : '';
?>
<header class="site-header">
    <a class="brand" href="<?php echo $base; ?>"><img src="<?php echo $base; ?>assets/logo.svg" alt="vee logo"></a>
    <nav>
        <ul>
            <li><a href="<?php echo $base; ?>" <?php if ($active === 'home') echo 'class="active"'; ?>>Home</a></li>
            <li><a href="<?php echo $base; ?>#intro">Intro</a></li>
            <li><a href="<?php echo $base; ?>projects" <?php if ($active === 'projects') echo 'class="active"'; ?>>Projects</a></li>
            <li><a href="<?php echo $base; ?>timeline" <?php if ($active === 'timeline') echo 'class="active"'; ?>>Timeline</a></li>
            <li><a href="<?php echo $base; ?>chaicode" <?php if ($active === 'chaicode') echo 'class="active"'; ?>>ChaiCode</a></li>
            <li><a href="<?php echo $base; ?>blogs" <?php if ($active === 'blogs') echo 'class="active"'; ?>>Blogs</a></li>
            <li><a href="<?php echo $base; ?>#contact">Contact</a></li>
            <li><a href="<?php echo $base; ?>#about">About</a></li>
        </ul>
    </nav>
    <div class="header-flag"><img src="<?php echo $base; ?>assets/india.svg" alt="Made in India"></div>
</header>
