<?php
require_once '../core/utility_functions.php';

session_start();

$base_url = get_base_url();

unset(
    $_SESSION['user_id'],
    $_SESSION['user_username'],
    $_SESSION['user_full_name'],
    $_SESSION['user_email'],
    $_SESSION['user_phone_number'],
    $_SESSION['user_profile_picture_path'],
    $_SESSION['user_display_name'],
    $_SESSION['user_bio'],
    $_SESSION['email'],
    $_SESSION['phone_number'],
    $_SESSION['full_name'],
    $_SESSION['username'],
    $_SESSION['hashed_password'],
    $_SESSION['current_user_username']
    );

session_destroy();

header('Location: ' . $base_url . 'login.php');
exit;
?>