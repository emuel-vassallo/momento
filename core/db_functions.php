<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function connect_to_db()
{
    return mysqli_connect('localhost', 'root', '', 'InstaCloneDB');
}

function does_value_exist($conn, $table, $column, $value)
{
    $query = "SELECT * FROM `$table` WHERE `$column` = '$value'";
    $result = mysqli_query($conn, $query);
    return mysqli_num_rows($result) > 0;
}

function upload_file($file, $target_dir)
{
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

    $image_name = $file['name'];
    $image_tmp_name = $file['tmp_name'];
    $image_error = $file['error'];

    if ($image_error !== 0) {
        $em = "Unknown error occurred!";
        header("Location: http://localhost/Emuel_Vassallo_4.2D/instagram-clone/public/index.php?error=$em");
    }

    $new_image_filename = uniqid() . '_' . $image_name;
    $image_upload_path = $target_dir . $new_image_filename;

    $_SESSION['profile_picture_dir'] = 'http://localhost/Emuel_Vassallo_4.2D/instagram-clone/uploads/profile-pictures/' . $new_image_filename;

    if (move_uploaded_file($image_tmp_name, $image_upload_path)) {
        return $image_upload_path;
    }

    return false;
}

function create_user($conn, $email, $phone_number, $full_name, $username, $hashed_password, $bio)
{
    $pfp_file = $_FILES['profile_picture_picker'];
    $target_dir = dirname(__DIR__) . '/uploads/profile-pictures/';
    $image_path = upload_file($pfp_file, $target_dir);

    if ($image_path) {
        $image_path = mysqli_real_escape_string($conn, $image_path);

        $query = "INSERT INTO `users_table` 
                 (`username`, `full_name`, `email`, `phone_number`, `password`, `profile_picture_path`, `bio`) 
                 VALUES ('$username', '$full_name', '$email', '$phone_number', '$hashed_password', '$image_path', '$bio');";

        return mysqli_query($conn, $query);
    }
    return false;
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