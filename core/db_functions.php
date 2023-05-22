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
    $image_name = $file['name'];
    $image_tmp_name = $file['tmp_name'];
    $image_error = $file['error'];

    if ($image_error !== 0) {
        $em = "Unknown error occurred!";
        header("Location: http://localhost/Emuel_Vassallo_4.2D/instagram-clone/public/index.php?error=$em");
    }

    $new_image_filename = uniqid() . '_' . $image_name;
    $image_upload_path = $target_dir . $new_image_filename;

    $relative_image_path = '/Emuel_Vassallo_4.2D/instagram-clone/uploads/profile-pictures/' . $new_image_filename;
    $_SESSION['user_profile_picture_path'] = $relative_image_path;


    if (move_uploaded_file($image_tmp_name, $image_upload_path)) {
        return $relative_image_path;
    }

    return false;
}

function upload_profile_picture($file)
{
    $target_dir = dirname(dirname(dirname(__DIR__))) . '/Emuel_Vassallo_4.2D/instagram-clone/uploads/profile-pictures/';
    return upload_file($file, $target_dir);
}


function create_user($conn, $email, $phone_number, $full_name, $username, $hashed_password, $display_name, $bio)
{
    $pfp_file = $_FILES['profile_picture_picker'];

    if (!empty($pfp_file['name'])) {
        $profile_picture_path = upload_profile_picture($pfp_file);

        if ($profile_picture_path) {
            $username = mysqli_real_escape_string($conn, strtolower($username));
            $profile_picture_path = mysqli_real_escape_string($conn, $profile_picture_path);
            $display_name = mysqli_real_escape_string($conn, $display_name);
            $bio = mysqli_real_escape_string($conn, $bio);

            $query = "INSERT INTO `users_table` 
                 (`username`, `full_name`, `email`, `phone_number`, `password`, `profile_picture_path`, `display_name`, `bio`) 
                 VALUES ('$username', '$full_name', '$email', '$phone_number', '$hashed_password', '$profile_picture_path', '$display_name', '$bio');";

            return mysqli_query($conn, $query);
        }
    }
    return false;
}


function get_user_by_credentials($conn, $username, $password)
{
    $query = "SELECT * 
              FROM `users_table` 
              WHERE `username` = '$username' 
                OR `email` = '$username' 
                OR `phone_number` = '$username'";

    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $hashedPassword = $row['password'];

        if (password_verify($password, $hashedPassword) || $password === $hashedPassword) {
            return $row;
        }
    }

    return false;
}


function update_user_profile($conn, $user_id, $display_name, $profile_picture_path, $bio)
{
    $display_name = mysqli_real_escape_string($conn, $display_name);
    $bio = mysqli_real_escape_string($conn, $bio);

    $query = "UPDATE `users_table` SET 
              `profile_picture_path` = '$profile_picture_path',
              `display_name` = '$display_name',
              `bio` = '$bio'
              WHERE `id` = '$user_id'";

    return mysqli_query($conn, $query);
}

?>