<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once("db_functions.php");
$conn = connect_to_db();

if (isset($_POST['email']) && !empty($_POST['email'])) {
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
}
if (isset($_POST['phone-number']) && !empty($_POST['phone-number'])) {
    $phone_number = mysqli_real_escape_string($conn, trim($_POST['phone-number']));
}
if (isset($_POST['full-name']) && !empty($_POST['full-name'])) {
    $full_name = mysqli_real_escape_string($conn, trim($_POST['full-name']));
}
if (isset($_POST['username']) && !empty($_POST['username'])) {
    $username = strtolower(mysqli_real_escape_string($conn, trim($_POST['username'])));
}
if (isset($_POST['password']) && !empty($_POST['password'])) {
    $password = mysqli_real_escape_string($conn, trim($_POST['password']));
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
}

$_SESSION['email'] = $email;
$_SESSION['phone_number'] = $phone_number;
$_SESSION['full_name'] = $full_name;
$_SESSION['username'] = $username;
$_SESSION['hashed_password'] = $hashed_password;

header("Location: http://localhost/Emuel_Vassallo_4.2D/instagram-clone/public/profile.php");
?>