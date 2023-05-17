<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function connect_to_db()
{
    return mysqli_connect('localhost', 'root', '', 'InstaCloneDB');
}
function create_user($conn, $email, $phone_number, $full_name, $username, $password)
{
    $query = "INSERT INTO `users_table` 
              (`username`, `full_name`, `email`, `phone_number`, `password`) 
              VALUES ('$username', '$full_name', '$email', '$phone_number', '$password');";
    return mysqli_query($conn, $query);
}

function authenticate_user($conn, $username, $password)
{
    $query = "SELECT `password`
              FROM `users_table`
              WHERE `username` = '$username'
                OR `email` = '$username'
                OR `phone_number` = '$username';";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $hashedPassword = $row['password'];
        return password_verify($password, $hashedPassword);
    }

    return false;
}
?>