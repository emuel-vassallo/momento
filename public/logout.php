<?php
session_start();
unset($_SESSION['user_id']);
unset($_SESSION['user_username']);
unset($_SESSION['user_full_name']);
unset($_SESSION['user_email']);
unset($_SESSION['user_phone_number']);
unset($_SESSION['user_profile_picture_path']);
unset($_SESSION['user_display_name']);
unset($_SESSION['user_bio']);
unset($_SESSION['email']);
unset($_SESSION['phone_number']);
unset($_SESSION['full_name']);
unset($_SESSION['username']);
unset($_SESSION['hashed_password']);
unset($_SESSION['current_user_username']);
header('Location: http://localhost/Emuel_Vassallo_4.2D/instagram-clone/public/login.php');
?>