<?php
function get_base_url()
{
    return strtolower(substr($_SERVER["SERVER_PROTOCOL"], 0, strpos($_SERVER["SERVER_PROTOCOL"], '/'))) . '://' . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER["PHP_SELF"]), '/\\') . '/';
}

function redirect_if_not_logged_in()
{
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit();
    }
}
function get_active_page()
{
    $active_page = '';

    if (basename($_SERVER['PHP_SELF']) === 'index.php') {
        $active_page = 'feed';
    } elseif (basename($_SERVER['PHP_SELF']) === 'edit_profile.php') {
        $active_page = 'settings';
    } elseif (basename($_SERVER['PHP_SELF']) === 'user_profile.php' && isset($_GET['user_id']) && $_GET['user_id'] == $_SESSION['user_id']) {
        $active_page = 'profile';
    }

    return $active_page;
}

function add_transformation_parameters($imageUrl, $transformation)
{
    $url_parts = explode("/upload/", $imageUrl);

    if (count($url_parts) === 2) {
        $transformed_url = $url_parts[0] . "/upload/" . $transformation . "/" . $url_parts[1];

        return $transformed_url;
    }
    return $imageUrl;
}
?>