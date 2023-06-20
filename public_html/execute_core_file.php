<?php
if (empty($_SERVER['HTTP_REFERER'])) {
    header('Location: index.php');
    exit;
}

$base_path = str_replace('/public_html', '', dirname(__FILE__)) . '/core/';

$file = $_GET['filename'] ?? '';

$file = basename($file);

$file_to_execute = $base_path . $file;

ob_start();
include $file_to_execute;
ob_end_flush();

exit;
?>
