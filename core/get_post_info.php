<?php
require_once("db_functions.php");
$conn = connect_to_db();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $post_id = !empty($_GET['post_id']) ? mysqli_real_escape_string($conn, trim($_GET['post_id'])) : '';

    if (!empty($post_id)) {
        $post = get_post($conn, $post_id);

        if ($post) {
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'post' => $post]);
            exit;
        } else {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Post not found']);
            exit;
        }
    }
}

header('Content-Type: application/json');
echo json_encode(['success' => false, 'message' => 'Failed to retrieve post data']);
?>