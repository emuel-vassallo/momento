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

require_once("../core/db_functions.php");
$conn = connect_to_db();
$posts = get_all_posts($conn);

function display_posts($posts)
{
    foreach ($posts as $post) {
        $poster_profile_picture = $post['profile_picture_path'];
        $poster_display_name = $post['display_name'];
        $poster_username = $post['username'];
        $imageDir = $post['image_dir'];
        $caption = $post['caption'];

        echo "<div class='post d-flex flex-column w-100 mb-5 pb-2'>
                <div class='post-top d-flex align-items-center mb-3'>
                  <img class='feed-card-profile-picture' src='$poster_profile_picture' alt='$poster_display_name's profile picture'>
                  <div>
                    <p class='m-0'>$poster_display_name</p>
                    <p class='m-0 text-dark-emphasis'>$poster_username</p>
                  </div>
                </div>
                <img class='feed-post-image' src='$imageDir' alt='Post Image'>
                <div>
                  <p>$caption</p>
                </div>
              </div>";
    }
}
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
        <div class="d-flex feed-container flex-column p-5 align-items-center justify-content-center">
            <p class="h3">Feed</p>
            <div class="feed-posts-container d-flex flex-column align-items-center justify-content-center">
                <?php display_posts($posts) ?>
            </div>
        </div>

        <?php include('footer.php'); ?>
    </main>
</body>

</html>