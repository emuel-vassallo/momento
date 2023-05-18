<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once("db_functions.php");
$conn = connect_to_db();

$errors = array();

if (isset($_POST['username']) && !empty($_POST['username'])) {
    $username = mysqli_real_escape_string($conn, trim($_POST['username']));
} else {
    $errors[] = "Username is required.";
}

if (isset($_POST['password']) && !empty($_POST['password'])) {
    $password = mysqli_real_escape_string($conn, trim($_POST['password']));
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
} else {
    $errors[] = "Password is required.";
}

if (empty($errors)) {
    $result = authenticate_user($conn, $username, $password);

    if ($result) {
        $_SESSION['username'] = $username;
    }
} else {
    foreach ($errors as $error) {
        echo $error . "<br>";
    }
}
?>