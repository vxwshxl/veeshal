<?php
http_response_code(503);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../hackathons/includes/head_resources.php'; ?>
    <link rel="stylesheet" href="../css/errorStyles.css">
    <title>503 Service Unavailable - Veeshal D. Bodosa</title>
</head>
<body>
    <div id="home" class="home">
        <div class="homeContainer">
            <?php include '../hackathons/includes/header.php'; ?>

            <div class="error-container">
                <div class="error-code">5<span class="error-highlight">0</span>3</div>
                <h1 class="error-title">Under Maintenance</h1>
                <p class="error-message">The site is currently undergoing scheduled maintenance to improve your experience. We'll be back online shortly.</p>
                <div class="error-actions">
                    <a href="mailto:veebodosa@gmail.com" class="error-btn primary">Email Us</a>
                </div>
            </div>
        </div>
        
        <?php include '../hackathons/includes/footer.php'; ?>
    </div>
    
    <?php include '../hackathons/includes/footer_resources.php'; ?>
</body>
</html>
