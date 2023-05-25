<?php
require_once 'db_functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['post_id'])) {
        $post_id = $_POST['post_id'];

        $conn = connect_to_db();
        $success = delete_post($conn, $post_id);

        if ($success) {
            $response = ['success' => true, 'post_id' => $post_id];
            $status_code = 200;
        } else {
            $response = ['success' => false, 'error' => 'Unable to delete the post'];
            $status_code = 400;
        }
    } else {
        $response = ['error' => 'Invalid request: missing post_id parameter'];
        $status_code = 400;
    }
} else {
    $response = ['error' => 'Method not allowed'];
    $status_code = 405;
}

http_response_code($status_code);
echo json_encode($response);
?>