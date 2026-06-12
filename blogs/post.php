<?php
// Dynamic blog post — renders CMS-authored posts (blogs.is_static = false)
require_once __DIR__ . '/../lib/supabase.php';

$slug = isset($_GET['slug']) ? $_GET['slug'] : '';
$post = null;

if ($slug !== '') {
    $rows = sb_fetch('blogs', 'select=*&slug=eq.' . rawurlencode($slug) . '&published=eq.true&limit=1');
    if ($rows && isset($rows[0])) $post = $rows[0];
}

if (!$post) {
    http_response_code(404);
}

// static posts live as their own PHP files — send the visitor there
if ($post && !empty($post['is_static'])) {
    header('Location: ' . $post['slug']);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'includes/head_resources.php'; ?>
    <title><?php echo $post ? htmlspecialchars($post['title']) . ' - Veeshal D. Bodosa' : 'Post not found - Veeshal D. Bodosa'; ?></title>
    <meta name="description" content="<?php echo $post ? htmlspecialchars($post['excerpt'] ? $post['excerpt'] : $post['title']) : 'Post not found'; ?>">
    <meta name="author" content="Veeshal D. Bodosa">
    <style>
        .post-wrap {
            max-width: 820px;
            margin: 0 auto;
            padding: clamp(36px, 7vh, 80px) var(--gutter) clamp(64px, 10vh, 120px);
        }

        .post-wrap .post-meta {
            display: flex;
            gap: 14px;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 18px;
        }

        .post-wrap h1 {
            font-family: var(--font-display);
            font-weight: 600;
            font-size: clamp(36px, 6vw, 72px);
            line-height: 1.02;
            letter-spacing: -0.02em;
            margin-bottom: 22px;
        }

        .post-cover {
            border-radius: 18px;
            overflow: hidden;
            border: 1px solid var(--line);
            margin-bottom: 34px;
        }

        .post-cover img { width: 100%; display: block; }

        .post-body { font-size: 17px; line-height: 1.75; color: #2c2b26; }
        .post-body h2, .post-body h3 { font-family: var(--font-display); font-weight: 600; margin: 1.6em 0 0.6em; }
        .post-body p { margin-bottom: 1.1em; }
        .post-body a { color: var(--amber-deep); }
        .post-body img { max-width: 100%; border-radius: 12px; }
        .post-body pre {
            background: var(--ink);
            color: var(--paper);
            border-radius: 12px;
            padding: 18px;
            overflow-x: auto;
            font-family: var(--font-mono);
            font-size: 13.5px;
        }
        .post-body code { font-family: var(--font-mono); font-size: 0.92em; }
        .post-body blockquote {
            border-left: 3px solid var(--amber);
            padding-left: 18px;
            color: var(--muted);
            font-style: italic;
            margin: 1.2em 0;
        }

        .post-404 { text-align: center; padding: 16vh var(--gutter); }
        .post-404 h1 { font-family: var(--font-display); font-size: clamp(40px, 8vw, 100px); }
    </style>
</head>

<body>
    <div id="home" class="home">
        <div class="homeContainer">
            <?php include 'includes/header.php'; ?>

            <?php if ($post): ?>
            <article class="post-wrap">
                <div class="post-meta">
                    <span class="blog-category-tag"><?php echo htmlspecialchars($post['category']); ?></span>
                    <span class="blog-date"><?php echo htmlspecialchars($post['date_label']); ?></span>
                </div>
                <h1><?php echo htmlspecialchars($post['title']); ?></h1>
                <?php if (!empty($post['image'])): ?>
                <div class="post-cover"><img src="<?php echo htmlspecialchars(sb_asset($post['image'], '../')); ?>" alt="<?php echo htmlspecialchars($post['title']); ?>"></div>
                <?php endif; ?>
                <div class="post-body">
                    <?php echo $post['content_html']; ?>
                </div>
            </article>
            <?php else: ?>
            <div class="post-404">
                <h1>404<span class="amber">.</span></h1>
                <p class="sub-note">that post took a wrong turn — <a href="index">back to the blogs</a>.</p>
            </div>
            <?php endif; ?>
        </div>

        <?php include 'includes/footer.php'; ?>
    </div>

    <?php include 'includes/footer_resources.php'; ?>
</body>

</html>
