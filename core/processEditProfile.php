<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once("db_functions.php");
$conn = connect_to_db();

$errors = array();

if (isset($_FILES['profile-picture-picker']) && !empty($_FILES['profile-picture-picker'])) {
    $target_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/';

    $pfp_file = $_FILES['profile-picture-picker'];
    $pfp_file_ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    $allowed_extensions = array("jpg", "jpeg", "png", "bmp");

    if (!in_array($pfp_file_ext, $allowed_extensions)) {
        $errors[] = "Invalid file extension. Only JPG, JPEG, and PNG, and BMP files are allowed.";
    }
}

if (isset($_POST['bio']) && !empty($_POST['bio'])) {
    $bio = mysqli_real_escape_string($conn, trim($_POST['bio']));
    if (strlen($bio) > 150) {
        $errors[] = "Bio must not exceed 150 characters.";
    }
}

if (empty($errors)) {
    $_SESSION['bio'] = $bio;

    $email = $_SESSION['email'];
    $phone_number = $_SESSION['phone_number'];
    $full_name = $_SESSION['full_name'];
    $username = $_SESSION['username'];
    $hashed_password = $_SESSION['hashed_password'];

    $result = create_user($conn, $email, $phone_number, $full_name, $username, $hashed_password, $bio, $pfp_file, $target_dir);

    if ($result) {
        header("Location: http://localhost/Emuel_Vassallo_4.2D/instagram-clone/public/index.php");
    }
} else {
    foreach ($errors as $error) {
        echo $error . "<br>";
    }
}
?>