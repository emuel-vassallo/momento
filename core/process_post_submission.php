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

$errors = [];

if (isset($_FILES['post_modal_image_picker']) && !empty($_FILES['post_modal_image_picker'])) {
    $allowed_extensions = ["jpg", "jpeg", "png", "bmp"];
    $post_modal_image_picker_file_ext = strtolower(pathinfo($_FILES['post_modal_image_picker']['name'], PATHINFO_EXTENSION));

    if (!in_array($post_modal_image_picker_file_ext, $allowed_extensions)) {
        $errors[] = "Invalid file extension. Only JPG, JPEG, PNG, and BMP files are allowed.";
    }
}

if (isset($_POST['post_caption'])) {
    $caption = trim($_POST['post_caption']);
    if (strlen($caption) > 2200) {
        $errors[] = "Caption must not exceed 2,200 characters.";
    }
}

if (!empty($errors)) {
    foreach ($errors as $error) {
        echo $error . "<br>";
    }
    exit;
}

$user_id = $_SESSION['user_id'];
$result = add_post($pdo, $user_id, $caption);

if ($result) {
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
}
?>