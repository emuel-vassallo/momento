<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once("db_functions.php");
$conn = connect_to_db();

$errors = array();

if (isset($_FILES['post_modal_image_picker']) && !empty($_FILES['post_modal_image_picker'])) {
    $allowed_extensions = array("jpg", "jpeg", "png", "bmp");
    $post_modal_image_picker_file_ext = strtolower(pathinfo($_FILES['post_modal_image_picker']['name'], PATHINFO_EXTENSION));

    if (!in_array($post_modal_image_picker_file_ext, $allowed_extensions)) {
        $errors[] = "Invalid file extension. Only JPG, JPEG, and PNG, and BMP files are allowed.";
    }
}

if (isset($_POST['post_caption'])) {
    $caption = mysqli_real_escape_string($conn, trim($_POST['post_caption']));
    if (strlen($caption) > 2200) {
        $errors[] = "Caption must not exceed 2,200 characters.";
    }
}

if (empty($errors)) {
    $user_id = $_SESSION['user_id'];

    $result = add_post($conn, $user_id, $caption);

    if ($result) {
            header("Location: http://localhost/Emuel_Vassallo_4.2D/instagram-clone/public/index.php");
        }
} else {
    foreach ($errors as $error) {
        echo $error . "<br>";
    }
}
?>