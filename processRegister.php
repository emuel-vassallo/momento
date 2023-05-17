<?php
require_once("db_functions.php");
$conn = connectToDB();

if (isset($_POST['email'])) {
    $_SESSION['email'] = mysqli_real_escape_string($conn, $_POST['email']);
}
if (isset($_POST['mobile-number'])) {
    $_SESSION['mobile-number'] = mysqli_real_escape_string($conn, $_POST['mobile-number']);
}
if (isset($_POST['full-name'])) {
    $_SESSION['full-name'] = mysqli_real_escape_string($conn, $_POST['full-name']);
}
if (isset($_POST['username'])) {
    $_SESSION['username'] = mysqli_real_escape_string($conn, $_POST['username']);
}
if (isset($_POST['password'])) {
    $_SESSION['password'] = mysqli_real_escape_string($conn, $_POST['password']);
}

header("Location: http://localhost/Emuel_Vassallo_4.2D/instagram-clone/index.php");
?>