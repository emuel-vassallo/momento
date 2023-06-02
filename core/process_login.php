<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once("db_functions.php");
$conn = connect_to_db();

$username = $_POST['username'];
$password = $_POST['password'];
$result = get_user_by_credentials($conn, $username, $password);

$_SESSION['user_id'] = $result['id'];
$_SESSION['user_username'] = $result['username'];
$_SESSION['user_full_name'] = $result['full_name'];
$_SESSION['user_email'] = $result['email'];
$_SESSION['user_phone_number'] = $result['phone_number'];
$_SESSION['user_profile_picture_path'] = '/instagram-clone' . $result['profile_picture_path'];
$_SESSION['user_display_name'] = $result['display_name'];
$_SESSION['user_bio'] = nl2br(stripslashes($result['bio']));

header("Location: http://localhost/instagram-clone/public/index.php");
?>