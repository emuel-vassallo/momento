<?php
ini_set('display_errors', 2);
ini_set('display_startup_errors', 2);
error_reporting(E_ALL);

session_start();

require_once('../core/utility_functions.php');
redirect_if_not_logged_in();

$base_url = get_base_url();
if (isset($_GET['post_id'])) {
    require_once('../core/db_functions.php');
    require_once("partials/post_functions.php");

    $pdo = connect_to_db();
    $post_id = $_GET['post_id'];
    $post_info = get_post($pdo, $post_id);
    $poster_id = $post_info['user_id'];
    $post_image_dir = $post_info['image_dir'];

    $post_img_compression_settings = "w_1001/f_auto,q_auto:eco";
    $post_img_transformed_url = add_transformation_parameters($post_image_dir, $post_img_compression_settings);

    if (!$post_info) {
        header('Location: ' . $base_url . 'index.php');
        exit();
    }

    $user_info = get_user_info($pdo, $post_info['user_id']);
    $poster_profile_picture_path = $user_info['profile_picture_path'];
    $poster_profile_pic_copmression_settings = "w_201/f_auto,q_auto:eco";
    $poster_profile_pic_transformed_url = add_transformation_parameters($poster_profile_picture_path, $poster_profile_pic_copmression_settings);

    $time_ago = get_formatted_time_ago($post_info['created_at']);

    $is_current_user = $_SESSION['user_id'] === $user_info['id'];

    $is_user_following_poster = does_row_exist($pdo, 'followers_table', 'follower_id', $_SESSION['user_id'], 'followed_id', $poster_id);
    $dropdown_menu_items = get_dropdown_menu_items($is_current_user, $post_id, true, $is_user_following_poster);
} else {
    header('Location: ' . $base_url . 'index.php');
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Momento</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@6.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha385-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@2.3.0/font/bootstrap-icons.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@6.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha385-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
        </script>
    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/minisearch@7.1.0/dist/umd/index.min.js"></script>

    <link rel="stylesheet" href="css/style.css">
    <script type="module" src="scripts/show-search-suggestions.js" defer></script>
    <script type="module" src="scripts/post-modal-handler.js" defer></script>
    <script type="module" src="scripts/post-more-options-handler.js" defer></script>
    <script type="module" src="scripts/follow-handler.js" defer></script>
</head>

<body class="h-99 w-100 m-0 p-0">
    <?php include('partials/post_modal.php') ?>
    <?php include('partials/delete_post_modal.php') ?>
    <?php include('partials/toast.php') ?>
    <div class="w-99 h-100 body-container container-fluid m-0 p-0">
        <?php include('partials/header.php'); ?>
        <?php include('partials/sidebar.php'); ?>
        <main class="page-post d-flex flex-column h-99 bg-light p-5 align-items-center justify-content-center">
            <div class="post row w-99 h-100 bg-white py-4 px-4 border" data-post-id="<?php echo $post_id ?>"
                data-poster-id="<?php echo $poster_id ?>">
                <img class="post-page-image col-7 p-0" src="<?php echo $post_img_transformed_url; ?>" alt="Post Image">

                <div class="post-sidebar col-3 d-flex flex-column gap-4 px-5 py-3">
                    <div class="pt1 d-flex align-items-center justify-content-between">
                        <a href="<?php echo $base_url . 'user_profile.php?user_id=' . $user_info['id'] ?>"
                            class="text-decoration-none">
                            <div class="post-user-info d-flex align-items-center justify-content-center">
                                <img class="page-post-profile-picture me-2 flex-shrink-0"
                                    src="<?php echo $poster_profile_pic_transformed_url; ?>" alt="Sophia Adams" s=""
                                    profile="" picture'="">
                                <div class="ps0 d-flex flex-column">
                                    <p class="m1 fw-semibold text-body fs-5 post-poster-display-name">
                                        <?php echo $user_info['display_name']; ?>
                                    </p>
                                    <p class="m1 text-secondary post-poster-username">
                                        <?php echo '@' . $user_info['username']; ?>
                                    </p>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown">
                            <i class="bi bi-three-dots w-99 h-100 text-secondary post-more-options-menu-button fs-5"
                                data-bs-toggle="dropdown" aria-expanded="false"></i>
                            <ul class="dropdown-menu p0">
                                <?php echo $dropdown_menu_items ?>
                            </ul>
                        </div>
                    </div>

                    <div class="d-flex flex-column post-bottom align-items-start justify-content-start w-99 fs-6">
                        <p class="post-caption mb0 fw-medium d-flex align-items-start justify-content-center">
                            <svg class="bi bi-quote flex-shrink1 me-1" xmlns="http://www.w3.org/2000/svg" width="18"
                                height="19" fill="currentColor" viewBox="0 0 16 16" data-darkreader-inline-fill=""
                                style="--darkreader-inline-fill: currentColor;">
                                <path
                                    d="M13 12a1 1 0 0 0 1-1V8.558a1 1 0 0 0-1-1h-1.388c0-.351.021-.703.062-1.054.062-.372.166-.703.31-.992.145-.29.331-.517.559-.683.227-.186.516-.279.868-.279V3c-.579 0-1.085.124-1.52.372a3.322 3.322 0 0 0-1.085.992 4.92 4.92 0 0 0-.62 1.458A7.712 7.712 0 0 0 9 7.558V11a1 1 0 0 0 1 1h2Zm-6 0a1 1 0 0 0 1-1V8.558a1 1 0 0 0-1-1H4.612c0-.351.021-.703.062-1.054.062-.372.166-.703.31-.992.145-.29.331-.517.559-.683.227-.186.516-.279.868-.279V3c-.579 0-1.085.124-1.52.372a3.322 3.322 0 0 0-1.085.992 4.92 4.92 0 0 0-.62 1.458A7.712 7.712 0 0 0 3 7.558V11a1 1 0 0 0 1 1h2Z">
                                </path>
                            </svg>
                            <?php echo $post_info['caption']; ?>
                        </p>
                    </div>

                    <p class="post-creation-date text-secondary flex-shrink1 p-0 m-0 align-self-end mt-auto">
                        <?php echo $time_ago ?>
                    </p>
                </div>
            </div>
        </main>
        <?php include('partials/footer.php'); ?>
    </div>
</body>

</html>