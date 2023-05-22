<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: http://localhost/Emuel_Vassallo_4.2D/instagram-clone/public/login.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Instagram Clone</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <a href="edit_profile.php">Edit Profile</a>
    <a href="logout.php">Log Out</a>
    <div class="home-sidebar-profile-container d-flex p-5">
        <img class="home-sidebar-user-profile-picture me-3" src="<?php echo $_SESSION['user_profile_picture_path']; ?>"
            alt="User profile picture">
        <div class="home-sidebar-user-profile-info-container d-flex flex-column justify-content-center">
            <p class="user-profile-name h5 fw-bold p-0 m-0">
                <?php echo $_SESSION['user_display_name']; ?>
            </p>
            <p class="user-profile-username text-muted p-0 m-0">
                <?php echo '@' . $_SESSION['user_username']; ?>
            </p>
        </div>
    </div>

</html>