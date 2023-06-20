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

if (isset($_POST['user_display_name']) && !empty($_POST['user_display_name'])) {
    $user_display_name = trim($_POST['user_display_name']);
    if (strlen($user_display_name) === 0) {
        $errors[] = "Display name is required.";
    }
    if (strlen($user_display_name) < 1 || strlen($user_display_name) > 30) {
        $errors[] = "Display name must be between 1 and 30 characters long.";
    }
} else {
    $errors[] = "Display name is required.";
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

$user_id = $_SESSION['user_id'];
$result = update_user_profile($pdo, $user_id, $user_display_name, $bio);

if ($result) {
    $_SESSION['user_display_name'] = $user_display_name;
    $_SESSION['user_bio'] = nl2br($bio);
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
} else {
    echo "Something went wrong while updating the user profile";
    exit;
}
?>