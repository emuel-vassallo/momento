<?php
require_once 'db_functions.php';

function execute($params)
{
    $pdo = connect_to_db();

    $params = json_decode($params, true);

    $post_id = $params['postId'];

    if (empty($post_id)) {
        return ['success' => false, 'error' => 'Invalid parameters'];
    }

    $result = delete_post_with_image($pdo, $post_id);

    if ($result) {
        return ['success' => true];
    } else {
        return ['success' => false, 'error' => 'Failed to delete post'];
    }
}
?>