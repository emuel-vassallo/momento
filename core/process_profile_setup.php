<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

session_start();

require_once("db_functions.php");
$pdo = connect_to_db();

$errors = array();

if (isset($_FILES['profile_picture_picker']) && !empty($_FILES['profile_picture_picker'])) {
    $allowed_extensions = array("jpg", "jpeg", "png", "bmp");
    $pfp_file_ext = strtolower(pathinfo($_FILES['profile_picture_picker']['name'], PATHINFO_EXTENSION));

    if (!in_array($pfp_file_ext, $allowed_extensions)) {
        $errors[] = "Invalid file extension. Only JPG, JPEG, PNG, and BMP files are allowed.";
    }
}

if (isset($_POST['user_display_name']) && !empty($_POST['user_display_name'])) {
    $user_display_name = trim($_POST['user_display_name']);
    if (strlen($user_display_name) === 0) {
        $errors[] = "Display name is required.";
    } elseif (strlen($user_display_name) < 1 || strlen($user_display_name) > 30) {
        $errors[] = "Display name must be between 1 and 30 characters long.";
    }
}

if (isset($_POST['bio']) && !empty($_POST['bio'])) {
    $bio = trim($_POST['bio']);
    if (strlen($bio) > 150) {
        $errors[] = "Bio must not exceed 150 characters.";
    }
}

if (!empty($errors)) {
    foreach ($errors as $error) {
        echo $error . "<br>";
    }
    exit;
}

$_SESSION['user_bio'] = $bio;
$_SESSION['user_display_name'] = $user_display_name;

$email = $_SESSION['email'];
$phone_number = $_SESSION['phone_number'];
$full_name = $_SESSION['full_name'];
$username = $_SESSION['username'];
$hashed_password = $_SESSION['hashed_password'];

$result = create_user($pdo, $email, $phone_number, $full_name, $username, $hashed_password, $user_display_name, $bio);

if ($result) {
    $_SESSION['registration_complete'] = false;
    $_SESSION['current_user_username'] = $username;

    $user_info = get_user_by_credentials($pdo, $username, $hashed_password);

    if ($user_info) {
        $_SESSION['user_id'] = $user_info['id'];
        $_SESSION['user_username'] = $user_info['username'];
        $_SESSION['user_full_name'] = $user_info['full_name'];
        $_SESSION['user_email'] = $user_info['email'];
        $_SESSION['user_phone_number'] = $user_info['phone_number'];
        $_SESSION['user_profile_picture_path'] = $user_info['profile_picture_path'];

        unset($_SESSION['email']);
        unset($_SESSION['phone_number']);
        unset($_SESSION['full_name']);
        unset($_SESSION['username']);
        unset($_SESSION['hashed_password']);
        unset($_SESSION['current_user_username']);

        header('Location: index.php');
        exit;
    }
} else {
    echo "Something went wrong while creating the user.";
}