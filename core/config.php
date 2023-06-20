<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('../vendor/autoload.php');

use Cloudinary\Configuration\Configuration;

define('DB_CONFIG', [
    'host' => 'localhost',
    'db' => 'momento_db',
    'user' => 'root',
    'pass' => '',
]);


Configuration::instance([
    'cloud' => [
        'cloud_name' => $_SERVER['CLOUDINARY_CLOUD_NAME'],
        'api_key' => $_SERVER['CLOUDINARY_API_KEY'],
        'api_secret' => $_SERVER['CLOUDINARY_API_SECRET'],
    ],
    'url' => [
        'secure' => true
    ]
]);
?>