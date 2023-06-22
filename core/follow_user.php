<?php
require_once 'db_functions.php';

function execute($params)
{
    $pdo = connect_to_db();

    $params = json_decode($params, true);

    $follower_id = $params['follower_id'];
    $followed_id = $params['followed_id'];

    if (empty($follower_id) || empty($followed_id)) {
        return ['success' => false, 'error' => 'Invalid parameters'];
    }

    $result = follow_user($pdo, $follower_id, $followed_id);

    if ($result) {
        return ['success' => true];
    } else {
        return ['success' => false, 'error' => 'Failed to delete post'];
    }
}
?>