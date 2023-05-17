<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once("db_functions.php");
$conn = connect_to_db();

if (isset($_POST['username']) && !empty($_POST['username'])) {
    $username = mysqli_real_escape_string($conn, trim($_POST['username']));
}
if (isset($_POST['password']) && !empty($_POST['password'])) {
    $password = mysqli_real_escape_string($conn, trim($_POST['password']));
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
}

$result = authenticate_user($conn, $username, $password);

if ($result) {
    $_SESSION['username'] = $username;
    echo "true";
} else {
    echo "false";
}
?>