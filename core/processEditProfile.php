<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once("db_functions.php");
$conn = connect_to_db();

if (isset($_FILES['profile-picture-picker']) && !empty($_FILES['profile-picture-picker'])) {
    $target_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/';
}

if (isset($_POST['bio']) && !empty($_POST['bio'])) {
    $bio = mysqli_real_escape_string($conn, trim($_POST['bio']));
}

$_SESSION['bio'] = $bio;

$email = $_SESSION['email'];
$phone_number = $_SESSION['phone_number'];
$full_name = $_SESSION['full_name'];
$username = $_SESSION['username'];
$hashed_password = $_SESSION['hashed_password'];

$result = create_user($conn, $email, $phone_number, $full_name, $username, $hashed_password, $bio, $_FILES['profile-picture-picker'], $target_dir);

if ($result) {
    header("Location: http://localhost/Emuel_Vassallo_4.2D/instagram-clone/public/index.php");
}
?>