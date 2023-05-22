<?php
require_once("db_functions.php");
$conn = connect_to_db();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type = isset($_POST['type']) ? $_POST['type'] : '';
    $value = isset($_POST['value']) ? mysqli_real_escape_string($conn, trim($_POST['value'])) : '';

    if (!empty($type) && !empty($value)) {
        $column = '';
        switch ($type) {
            case 'email':
                $column = 'email';
                break;
            case 'phone_number':
                $column = 'phone_number';
                break;
            case 'username':
                $column = 'username';
                break;
        }

        if (!empty($column)) {
            if (does_value_exist($conn, 'users_table', $column, $value)) {
                echo "invalid";
            } else {
                echo "valid";
            }
        }
    } else {
        echo "invalid";
    }
}
?>