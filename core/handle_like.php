<?php
require_once 'db_functions.php';

function execute($params)
{
    $pdo = connect_to_db();

    $params = json_decode($params, true);

    $like_action = isset($params['like_action']) ? trim($params['like_action']) : '';
    $user_id = isset($params['user_id']) ? trim($params['user_id']) : '';
    $post_id = isset($params['post_id']) ? trim($params['post_id']) : '';

    if (empty($user_id) || empty($post_id)) {
        return ['success' => false, 'error' => 'Invalid request: missing user_id or post_id parameter'];
    }

    $success = $like_action === 'add' ? add_like($pdo, $user_id, $post_id) : remove_like($pdo, $user_id, $post_id);

    if ($success) {
        return ['success' => true];
    }
    return ['success' => false, 'error' => 'Unable to add the like'];
}
?>