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
        'cloud_name' => "dp4vwqhol",
        'api_key' => "566176181427548",
        'api_secret' => "23y5SZK4E0cmjQjORSwQPVevDTI",
    ],
    'url' => [
        'secure' => true
    ]
]);
?>