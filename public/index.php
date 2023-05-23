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

        echo "<div class='post d-flex w-100 mb-5 pb-4'>
                <div class='d-flex flex-column w-100 align-items-start'>
                    <div class='post-top d-flex align-items-center mb-2 pb-2'>
                        <div class='post-user-info d-flex align-items-center justify-content-center'>
                            <img class='feed-card-profile-picture me-2' src='$poster_profile_picture' alt='$poster_display_name's profile picture'>
                            <div class='ps-1 d-flex flex-column'>
                                <p class='m-0 fw-semibold'>$poster_display_name</p>
                                <p class='m-0 text-dark-emphasis'><small>@$poster_username</small></p>
                            </div>
                        </div>
                    </div>
                    <img class='feed-post-image mb-3 pb-1' src='$imageDir' alt='Post Image'>
                    <div class='d-flex post-caption align-items-start justify-content-start w-100'>
                        <p class='m-0 fw-medium'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' fill='currentColor' class='bi bi-quote' viewBox='0 0 16 16'>
                            <path d='M12 12a1 1 0 0 0 1-1V8.558a1 1 0 0 0-1-1h-1.388c0-.351.021-.703.062-1.054.062-.372.166-.703.31-.992.145-.29.331-.517.559-.683.227-.186.516-.279.868-.279V3c-.579 0-1.085.124-1.52.372a3.322 3.322 0 0 0-1.085.992 4.92 4.92 0 0 0-.62 1.458A7.712 7.712 0 0 0 9 7.558V11a1 1 0 0 0 1 1h2Zm-6 0a1 1 0 0 0 1-1V8.558a1 1 0 0 0-1-1H4.612c0-.351.021-.703.062-1.054.062-.372.166-.703.31-.992.145-.29.331-.517.559-.683.227-.186.516-.279.868-.279V3c-.579 0-1.085.124-1.52.372a3.322 3.322 0 0 0-1.085.992 4.92 4.92 0 0 0-.62 1.458A7.712 7.712 0 0 0 3 7.558V11a1 1 0 0 0 1 1h2Z'/>
                        </svg>
                        $caption</p>
                    </div>
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