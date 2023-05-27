<?php
require_once("db_functions.php");
$conn = connect_to_db();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type = isset($_POST['type']) ? trim($_POST['type']) : '';
    $value = isset($_POST['value']) ? trim($_POST['value']) : '';

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
                $response = ['success' => false];
            } else {
                $response = ['success' => true];
            }
        } else {
            $response = ['success' => false];
        }
    } else {
        $response = ['success' => false];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}
?>