<?php
require_once("db_functions.php");

function execute($params)
{
    $pdo = connect_to_db();

    $params = json_decode($params, true);

    $post_id = $params['post_id'];

    return get_post($pdo, $post_id);
}
?>