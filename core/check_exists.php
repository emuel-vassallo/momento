<?php
require_once("db_functions.php");

function execute($params)
{
    $pdo = connect_to_db();

    $params = json_decode($params, true);

    $type = $params['type'];
    $value = $params['value'];

    if (empty($type)) {
        return false;
    }

    if (does_value_exist($pdo, 'users_table', $type, $value)) {
        return true;
    }
    return false;
}
?>