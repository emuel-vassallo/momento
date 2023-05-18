<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once("db_functions.php");
$conn = connect_to_db();

if (isset($_FILES['profile-picture-picker']) && !empty($_FILES['profile-picture-picker'])) {
    $profile_picture_dir = mysqli_real_escape_string($conn, trim($_FILES['profile_picture_dir']['name']));
}

$result = create_user($conn, $_SESSION['email'], $_SESSION['phone_number'], $_SESSION['full_name'], $_SESSION['username'], $_SESSION['hashed_password'], $profile_picture_dir);

if ($result) {
    header("Location: http://localhost/Emuel_Vassallo_4.2D/instagram-clone/index.php");
}
?>
