<?php
require_once("db_functions.php");

function execute($params)
{
    $pdo = connect_to_db();

    $params = json_decode($params, true);

    $post_id = $params['post_id'];

    $post_likes = get_post_likes($pdo, $post_id);

    if ($post_likes) {
        $profile_ids = array_column($post_likes, 'id');
        $profiles = array_values(array_filter(get_users_info($pdo, $profile_ids)));
        return $profiles;
    }

    return [];
}
?>