<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once("db_functions.php");
$conn = connect_to_db();

$errors = array();

if (isset($_POST['email']) && !empty($_POST['email'])) {
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }
} else {
    $errors[] = "Email is required.";
}

if (isset($_POST['phone-number']) && !empty($_POST['phone-number'])) {
    $phone_number = mysqli_real_escape_string($conn, trim($_POST['phone-number']));
    if (!is_numeric($phone_number)) {
        $errors[] = "Phone number must be numeric.";
    } elseif (strlen($phone_number) < 3 || strlen($phone_number) > 15) {
        $errors[] = "Phone number must be between 3 and 15 digits.";
    }
} else {
    $errors[] = "Phone number is required.";
}

if (isset($_POST['full-name']) && !empty($_POST['full-name'])) {
    $full_name = mysqli_real_escape_string($conn, trim($_POST['full-name']));
    if (strlen($full_name) < 3 || strlen($full_name) > 15) {
        $errors[] = "Full name must be between 3 and 15 characters.";
    }
} else {
    $errors[] = "Full name is required.";
}

if (isset($_POST['username']) && !empty($_POST['username'])) {
    $username = strtolower(mysqli_real_escape_string($conn, trim($_POST['username'])));
    if (strlen($username) < 1 || strlen($username) > 15) {
        $errors[] = "Username must be between 1 and 15 characters.";
    }
} else {
    $errors[] = "Username is required.";
}

if (isset($_POST['password']) && !empty($_POST['password'])) {
    $password = mysqli_real_escape_string($conn, trim($_POST['password']));
    if (strlen($password) < 3) {
        $errors[] = "Password must be at least 3 characters long.";
    }
} else {
    $errors[] = "Password is required.";
}

if (!empty($errors)) {
    foreach ($errors as $error) {
        echo $error . "<br>";
    }
} else {
    $_SESSION['email'] = $email;
    $_SESSION['phone_number'] = $phone_number;
    $_SESSION['full_name'] = $full_name;
    $_SESSION['username'] = $username;
    $_SESSION['hashed_password'] = password_hash($password, PASSWORD_DEFAULT);

    header("Location: http://localhost/Emuel_Vassallo_4.2D/instagram-clone/public/profile.php");
    exit();
}
?>