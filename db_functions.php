<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function connect_to_db()
{
    return mysqli_connect('localhost', 'root', '', 'InstaCloneDB');
}
function create_user($conn, $email, $mobile_number, $full_name, $username, $password)
{
    $query = "INSERT INTO `users_table` 
            (`username`, `full_name`, `email`, `mobile_number`, `password`) 
            VALUES ('$username', '$full_name', '$email', '$mobile_number', '$password');";
    return mysqli_query($conn, $query);
}
?>