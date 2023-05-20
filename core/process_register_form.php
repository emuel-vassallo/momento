<?php
require_once("db_functions.php");
$conn = connect_to_db();

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    function validateField($field, $name, $minLength, $maxLength = false, $numeric = false, $email = false)
    {
        global $errors, $conn;

        if (isset($_POST[$field]) && !empty($_POST[$field])) {
            $value = mysqli_real_escape_string($conn, trim($_POST[$field]));

            // Check for existing value only for email, phone, and username fields
            if (in_array($field, ['email', 'phone', 'username']) && does_value_exist($conn, 'users_table', $field, $value)) {
                $errors[] = "$name already exists. Please choose a different $name.";
            } else {
                if ($numeric) {
                    if (!is_numeric($value) || strlen($value) < $minLength || strlen($value) > $maxLength) {
                        if (!is_numeric($value)) {
                            $errors[] = "$name must be numeric.";
                        } else {
                            $errors[] = "$name must be between $minLength and $maxLength digits.";
                        }
                    }
                } elseif ($email) {
                    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                        $errors[] = "Invalid $name format.";
                    }
                } else {
                    if ($maxLength) {
                        if (strlen($value) < $minLength || strlen($value) > $maxLength) {
                            $errors[] = "$name must be between $minLength and $maxLength characters.";
                        }
                    } else {
                        if (strlen($value) < $minLength) {
                            $errors[] = "$name must be at least $minLength characters long.";
                        }
                    }
                }
            }
        } else {
            $errors[] = "$name is required.";
        }
    }


    $errors = [];

    validateField('email', 'Email', 1, 255, false, true);
    validateField('phone_number', 'Phone number', 3, 15, true);
    validateField('full_name', 'Full name', 3, 15);
    validateField('username', 'Username', 1, 15);
    validateField('password', 'Password', 3);

    if (!empty($errors)) {
        echo json_encode($errors);
        return;
    } else {
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['phone_number'] = $_POST['phone_number'];
        $_SESSION['full_name'] = $_POST['full_name'];
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['hashed_password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $_SESSION['registration_complete'] = true;

        header('Location: http://localhost/Emuel_Vassallo_4.2D/instagram-clone/public/profile_setup.php');
        echo "valid";
    }
}
?>