<?php
require_once 'db_functions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $response = ['success' => false, 'error' => 'Method not allowed'];
    sendJsonResponse($response);
    exit;
}

$conn = connect_to_db();

$post_id = isset($_POST['post_id']) ? mysqli_real_escape_string($conn, trim($_POST['post_id'])) : '';

if (empty($post_id)) {
    $response = ['success' => false, 'error' => 'Invalid request: missing post_id parameter'];
    sendJsonResponse($response);
    exit;
}

$success = delete_post($conn, $post_id);

if ($success) {
    $response = ['success' => true];
} else {
    $response = ['success' => false, 'error' => 'Unable to delete the post'];
}

sendJsonResponse($response);

function sendJsonResponse($response)
{
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>