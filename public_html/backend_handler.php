<?php
$fileName = $_GET['file'];

$params = $_GET['params'] ?? null;

include '../core/' . $fileName;

$result = null;

if (function_exists('execute')) {
    if ($params) {
        $result = execute($params);
    } else {
        $result = execute();
    }
} else {
    $result = null;
}

$response = [
    'result' => $result
];

header('Content-Type: application/json');

echo json_encode($response);

?>