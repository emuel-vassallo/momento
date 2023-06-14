<?php
session_start();

if (isset($_SESSION['user_id'])) {
  $userId = $_SESSION['user_id'];
  $response = ['userId' => $userId];
} else {
  $response = ['userId' => null];
}

header('Content-Type: application/json');
echo json_encode($response);
