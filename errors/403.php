<?php
http_response_code(403);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../timeline/includes/head_resources.php'; ?>
    <link rel="stylesheet" href="../css/errorStyles.css">
    <title>403 Forbidden - Veeshal D. Bodosa</title>
</head>
<body>
    <div id="home" class="home">
        <div class="homeContainer">
            <?php include '../timeline/includes/header.php'; ?>

            <div class="error-container">
                <div class="error-code">4<span class="error-highlight">0</span>3</div>
                <h1 class="error-title">Access Denied</h1>
                <p class="error-message">You don't have permission to access this resource. It might be restricted or you might need to sign in.</p>
                <div class="error-actions">
                    <a href="../index" class="error-btn primary">Go Back Home</a>
                </div>
            </div>
        </div>
        
        <?php include '../timeline/includes/footer.php'; ?>
    </div>
    
    <?php include '../timeline/includes/footer_resources.php'; ?>
</body>
</html>
