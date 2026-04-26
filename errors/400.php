<?php
http_response_code(400);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../timeline/includes/head_resources.php'; ?>
    <link rel="stylesheet" href="../css/errorStyles.css">
    <title>400 Bad Request - Veeshal D. Bodosa</title>
</head>
<body>
    <div id="home" class="home">
        <div class="homeContainer">
            <?php include '../timeline/includes/header.php'; ?>

            <div class="error-container">
                <div class="error-code">4<span class="error-highlight">0</span>0</div>
                <h1 class="error-title">Bad Request</h1>
                <p class="error-message">We couldn't process your request. This might happen if form data was submitted incorrectly or the request was malformed.</p>
                <div class="error-actions">
                    <a href="javascript:history.back()" class="error-btn primary">Go Back</a>
                    <a href="../index#contact" class="error-btn secondary">Contact Us</a>
                </div>
            </div>
        </div>
        
        <?php include '../timeline/includes/footer.php'; ?>
    </div>
    
    <?php include '../timeline/includes/footer_resources.php'; ?>
</body>
</html>
