<?php
http_response_code(404);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../hackathons/includes/head_resources.php'; ?>
    <link rel="stylesheet" href="../css/errorStyles.css">
    <title>404 Not Found - Veeshal D. Bodosa</title>
</head>
<body>
    <div id="home" class="home">
        <div class="homeContainer">
            <?php include '../hackathons/includes/header.php'; ?>

            <div class="error-container interactive-404">
                <div class="error-code">4<span class="error-highlight">0</span>4</div>
                <h1 class="error-title">Page Not Found</h1>
                <p class="error-message">Oops! Looks like you took a wrong turn. The page you are looking for has been moved, deleted, or possibly never existed.</p>
                <div class="error-actions">
                    <a href="../index" class="error-btn primary">Return Home</a>
                    <a href="../index#project" class="error-btn secondary">View Projects</a>
                </div>
            </div>
        </div>
        
        <?php include '../hackathons/includes/footer.php'; ?>
    </div>
    
    <?php include '../hackathons/includes/footer_resources.php'; ?>
    
    <!-- Interactive 404 GSAP Animation -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            gsap.to(".error-highlight", {
                y: -20,
                duration: 1,
                yoyo: true,
                repeat: -1,
                ease: "power1.inOut"
            });
            gsap.from(".error-container > *", {
                y: 30,
                opacity: 0,
                duration: 0.8,
                stagger: 0.1,
                ease: "power2.out"
            });
        });
    </script>
</body>
</html>
