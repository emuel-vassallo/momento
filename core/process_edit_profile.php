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

$current_user_data = get_user_info($pdo, $user_id);
$current_display_name = $current_user_data['display_name'];
$current_bio = $current_user_data['bio'];

$new_image_file = $_FILES['profile_picture_picker'];

$is_image_updated = !empty($new_image_file['name']);
$is_display_name_updated = $user_display_name !== $_SESSION['user_display_name'];
$is_bio_updated = $bio !== $_SESSION['user_bio'];

if (!$is_image_updated && !$is_display_name_updated && !$is_bio_updated) {
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
}

$result = update_user_profile($pdo, $user_id, $is_display_name_updated ? $user_display_name : null, $is_bio_updated ? $bio : null);

if ($is_display_name_updated) {
    $_SESSION['user_display_name'] = $user_display_name;
}

if ($is_bio_updated) {
    $_SESSION['user_bio'] = nl2br($bio);
}

header("Location: " . $_SERVER['HTTP_REFERER']);
exit;
?>