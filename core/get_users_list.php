<?php
require_once("db_functions.php");
$conn = connect_to_db();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $profiles = get_all_users($conn);

    echo json_encode($profiles);
}
?>