<?php
require_once("db_functions.php");
$conn = connect_to_db();

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    function validateField($field, $name, $minLength, $maxLength = false, $numeric = false, $email = false)
    {
        global $errors, $conn;

        if (!isset($_POST[$field]) || empty($_POST[$field])) {
            $errors[] = "$name is required.";
            return;
        }

        $value = mysqli_real_escape_string($conn, trim($_POST[$field]));

        if (in_array($field, ['email', 'phone', 'username']) && does_value_exist($conn, 'users_table', $field, $value)) {
            $errors[] = "$name already exists. Please choose a different $name.";
            return;
        }

        if ($numeric && (!is_numeric($value) || strlen($value) < $minLength || strlen($value) > $maxLength)) {
            if (!is_numeric($value)) {
                $errors[] = "$name must be numeric.";
            } else {
                $errors[] = "$name must be between $minLength and $maxLength digits.";
            }
            return;
        }

        if ($email && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid $name format.";
            return;
        }

        if ($field === 'username' && !preg_match('/^[a-zA-Z0-9._]+$/', $value)) {
            $errors[] = "$name may only contain letters, numbers, periods, and underscores.";
            return;
        }

        if ($maxLength && (strlen($value) < $minLength || strlen($value) > $maxLength)) {
            $errors[] = "$name must be between $minLength and $maxLength characters.";
            return;
        }

        if (strlen($value) < $minLength) {
            $errors[] = "$name must be at least $minLength characters long.";
            return;
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
        $_SESSION['email'] = strtolower($_POST['email']);
        $_SESSION['phone_number'] = $_POST['phone_number'];
        $_SESSION['full_name'] = $_POST['full_name'];
        $_SESSION['username'] = strtolower($_POST['username']);
        $_SESSION['hashed_password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $_SESSION['registration_complete'] = true;

        header('Location: http://localhost/Emuel_Vassallo_4.2D/instagram-clone/public/profile_setup.php');
        echo "valid";
    }
} else {
    header('Location: http://localhost/Emuel_Vassallo_4.2D/instagram-clone/public/index.php');
}
?>