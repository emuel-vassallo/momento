<?php
require_once("db_functions.php");
$conn = connect_to_db();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $profiles = get_all_users($conn);

    header('Content-Type: application/json');
    echo json_encode($profiles);
    exit;
}

header('Content-Type: application/json');
echo json_encode(['success' => false, 'message' => 'Failed to retrieve post data']);
?>