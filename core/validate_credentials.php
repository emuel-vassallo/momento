<?php
require_once("db_functions.php");

$conn = connect_to_db();

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = array();

    if (isset($_POST['username']) && !empty($_POST['username'])) {
        $username = mysqli_real_escape_string($conn, trim($_POST['username']));
    } else {
        $errors[] = "Username is required.";
    }

    if (isset($_POST['password']) && !empty($_POST['password'])) {
        $password = mysqli_real_escape_string($conn, trim($_POST['password']));
    } else {
        $errors[] = "Password is required.";
    }


    if (empty($errors)) {
        $result = get_user_by_credentials($conn, $username, $password);

        if ($result) {
            echo "valid";

        } else {
            echo "invalid";
        }
    } else {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
}
?>