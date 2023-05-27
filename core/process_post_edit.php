<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();

    require_once("db_functions.php");

    $conn = connect_to_db();

    $errors = array();

    if (isset($_POST['post_caption'])) {
        $caption = mysqli_real_escape_string($conn, trim($_POST['post_caption']));
        if (strlen($caption) > 2200) {
            $errors[] = "Caption must not exceed 2,200 characters.";
        }
    }

    if (empty($errors)) {
        $post_id = $_POST['post_modal_post_id'];


        $result = update_post($conn, $post_id, $caption);

        if ($result) {
            header("Location: ".$_SERVER['PHP_SELF']);
        }
    } else {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
} else {
    header("Location: http://localhost/Emuel_Vassallo_4.2D/instagram-clone/public/index.php");
}
?>