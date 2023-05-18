<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function connect_to_db()
{
    return mysqli_connect('localhost', 'root', '', 'InstaCloneDB');
}
function create_user($conn, $email, $phone_number, $full_name, $username, $hashed_password, $bio, $file, $target_dir)
{
    $filename = uniqid() . '_' . $file['name'];

    $target_path = $target_dir . $filename;

    if (move_uploaded_file($file['tmp_name'], $target_path)) {
        $image_path = mysqli_real_escape_string($conn, $target_path);

        $query = "INSERT INTO `users_table` 
                 (`username`, `full_name`, `email`, `phone_number`, `password`, `profile_picture_path`, `bio`) 
                 VALUES ('$username', '$full_name', '$email', '$phone_number', '$hashed_password', '$image_path', '$bio');";
        return mysqli_query($conn, $query);
    }
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