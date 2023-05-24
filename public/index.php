<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: http://localhost/Emuel_Vassallo_4.2D/instagram-clone/public/login.php');
}

$activePage = '';
if (basename($_SERVER['PHP_SELF']) === 'index.php') {
    $activePage = 'feed';
} elseif (basename($_SERVER['PHP_SELF']) === 'edit_profile.php') {
    $activePage = 'settings';
} elseif (basename($_SERVER['PHP_SELF']) === 'logout.php') {
    $activePage = 'logout';
}

require_once('post_display.php');
?>
<!DOCTYPE html>
<html>

<head>
    <title>Instagram Clone</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js"></script>

    <link rel="stylesheet" href="css/style.css">
    <script src="scripts/create-post-modal-handler.js" defer></script>
    <script src="scripts/validate-create-post-form.js" defer></script>
</head>

<body class="d-flex">
    <?php include('navbar.php'); ?>
    <main class="d-flex flex-column w-100 h-100">
        <?php include('header.php'); ?>
        <div class="d-flex feed-container flex-column p-5 align-items-start align-items-center justify-content-center">
            <div class="feed-top w-100 mb-4">
                <p class="h3 fw-semibold">Feed</p>
            </div>
            <div class="feed-posts-container d-flex flex-column align-items-center justify-content-center">
                <?php display_posts($posts) ?>
            </div>
        </div>

        <?php include('footer.php'); ?>
    </main>
</body>

</html>