<?php
http_response_code(500);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../timeline/includes/head_resources.php'; ?>
    <link rel="stylesheet" href="../css/errorStyles.css">
    <title>500 Internal Server Error - Veeshal D. Bodosa</title>
</head>
<body>
    <div id="home" class="home">
        <div class="homeContainer">
            <?php include '../timeline/includes/header.php'; ?>

            <div class="error-container">
                <div class="error-code">5<span class="error-highlight">0</span>0</div>
                <h1 class="error-title">Internal Server Error</h1>
                <p class="error-message">We experienced an unexpected issue on our end. Please try again later or contact support if the problem persists.</p>
                <div class="error-actions">
                    <a href="../index" class="error-btn primary">Reload Page</a>
                    <a href="../index#contact" class="error-btn secondary">Contact Support</a>
                </div>
            </div>
        </div>
        
        <?php include '../timeline/includes/footer.php'; ?>
    </div>
    
    <?php include '../timeline/includes/footer_resources.php'; ?>
</body>
</html>
