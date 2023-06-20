<?php
require_once("db_functions.php");

function execute()
{
    $pdo = connect_to_db();

    return get_all_users($pdo);
}
?>