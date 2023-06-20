<?php
session_start();

function execute()
{
  $userId = $_SESSION['user_id'];

  if (!$userId) {
    return null;
  }

  return $userId;
}
?>