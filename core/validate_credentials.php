<?php
require_once("db_functions.php");

$conn = connect_to_db();

session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $response = ['success' => false, 'error' => 'Method not allowed'];
    sendJsonResponse($response);
    exit;
}

$errors = array();

if (isset($_POST['username']) && !empty($_POST['username'])) {
    $username = trim($_POST['username']);
} else {
    $errors[] = "Username is required.";
}

if (isset($_POST['password']) && !empty($_POST['password'])) {
    $password = trim($_POST['password']);
} else {
    $errors[] = "Password is required.";
}

if (!empty($errors)) {
    $response = ['success' => false, 'errors' => $errors];
    sendJsonResponse($response);
    exit;
}

$result = get_user_by_credentials($conn, $username, $password);

if ($result) {
    $response = ['success' => true];
} else {
    $response = ['success' => false, 'error' => 'Invalid credentials'];
}

sendJsonResponse($response);

function sendJsonResponse($response)
{
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>