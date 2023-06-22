<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once('../core/utility_functions.php');
redirect_if_not_logged_in();

require_once('../core/db_functions.php');
require_once('post_display.php');

$conn = connect_to_db();

redirect_if_not_logged_in();
if (isset($_GET['user_id']) && !empty($_GET['user_id'])) {
    $current_user_id = $_GET['user_id'];
    $is_logged_in_user_profile = intval($current_user_id) === intval($_SESSION['user_id']);
    $user_info = get_user_info($conn, $current_user_id);
    $user_bio = nl2br($user_info['bio']);

    $poster_profile_picture_url = $user_info['profile_picture_path'];
    $poster_profile_pic_compression_settings = "w_400/f_auto,q_auto:eco";
    $poster_profile_pic_transformed_url = add_transformation_parameters($poster_profile_picture_url, $poster_profile_pic_compression_settings);

    $user_posts_amount = get_user_post_count($conn, $current_user_id);
    // $user_followers_amount = get_user_followers_count($conn, $current_user_id);
    $user_followers_amount = 0;
    // $user_following_amount = get_user_following_count($conn, $current_user_id);
    $user_following_amount = 0;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Momento</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
        </script>
    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/minisearch@6.1.0/dist/umd/index.min.js"></script>

    <link rel="stylesheet" href="css/style.css">
    <script src="scripts/handle-scroll-to.js" defer></script>
    <script type="module" src="scripts/show-search-suggestions.js" defer></script>
    <script src="scripts/lazy-load.js" defer></script>

    <script type="module" src="scripts/post-modal-handler.js" defer></script>
    <script type="module" src="scripts/post-more-options-handler.js" defer></script>
    <script type="module" src="scripts/post-likes-modal-handler.js" defer></script>
    <script type="module" src="scripts/post-interactions-handler.js" defer></script>
    <script type="module" src="scripts/follow-handler.js" defer></script>
</head>

<body class="h-100 w-100 m-0 p-0 preload">
    <?php include('partials/post_modal.php') ?>
    <?php include('partials/delete_post_modal.php') ?>
    <?php include('partials/post_likes_modal.php') ?>
    <?php include('partials/post_link_copied_toast.php'); ?>
    <div class="w-100 h-100 body-container container-fluid m-0 p-0">
        <?php include('partials/header.php'); ?>
        <?php include('partials/sidebar.php'); ?>
        <main class="page-user-profile bg-light">
            <div class="py-5 d-flex flex-column h-100 align-items-center gap-5">
                <div class="profile-info d-flex pb-0 gap-4 align-items-center justify-content-start mb-3">
                    <img class="user-profile-profile-picture flex-shrink-0"
                        src="<?php echo $poster_profile_pic_transformed_url; ?>" alt="">
                    <div class="user-profile-text-info d-flex flex-column gap-3 w-100 p-1">
                        <div class="d-flex gap-4 align-items-center">
                            <div>
                                <p class="user-profile-display-name fs-5 fw-bold text-body m-0">
                                    <?php echo $user_info['display_name'] ?>
                                </p>
                                <p class="user-profile-username text-secondary fs-6 m-0">
                                    <?php echo '@' . $user_info['username'] ?>
                                </p>
                            </div>
                            <div>
                                <?php echo $is_logged_in_user_profile ? '
                                <a href="edit_profile.php" class="btn btn-outline-secondary" role="button">Edit Profile</a>
                            ' : '
                                <input type="checkbox" class="btn-check" id="user-profile-follow-button" checked autocomplete="off">
                                <label class="btn btn-outline-primary" for="user-profile-follow-button">
                                    <span class="follow-text fw-medium">Follow</span>
                                    <span class="unfollow-text">Unfollow</span>
                                </label>
                            '; ?>
                            </div>
                        </div>
                        <div class="d-flex gap-3">
                            <a id="user-profile-posts-amount"
                                class='d-flex user-profile-posts-amount-container align-items-center gap-1 text-decoration-none text-body fw-semibold'>
                                <p class="user-profile-posts-amount m-0 fs-6">
                                    <?php echo $user_posts_amount ?>
                                </p>
                                <p class="m-0 fs-6">
                                    <?php echo $user_posts_amount === 1 ? 'Post' : 'Posts' ?>
                                </p>
                            </a>
                            <a id="user-profile-followers-amount"
                                class='d-flex user-profile-followers-amount-container align-items-center gap-1 text-decoration-none text-body fw-semibold'>
                                <p class="user-profile-followers-amount m-0 fs-6">
                                    <?php echo $user_followers_amount ?>
                                </p>
                                <p class="m-0 fs-6">
                                    <?php echo $user_followers_amount === 1 ? 'Follower' : 'Followers' ?>
                                </p>
                            </a>
                            <a id="user-profile-following-amount"
                                class='d-flex user-profile-following-amount-container align-items-center gap-1 text-decoration-none text-body fw-semibold'>
                                <p class="user-profile-following-amount m-0 fs-6">
                                    <?php echo $user_following_amount ?>
                                </p>
                                <p class="m-0 fs-6">Following</p>
                            </a>
                        </div>
                        <div class="user-profile-bio-container">
                            <p class="fw-semibold m-0 fs-6">Bio</p>
                            <p class="user-profile-bio m-0">
                                <?php echo $user_bio ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div
                    class="d-flex feed-container flex-column align-items-start align-items-center justify-content-center">
                    <div class="feed-top w-100 mb-4">
                        <h4 id="user-profile-posts" class="fw-semibold">Posts</h4>
                    </div>
                    <div
                        class="feed-posts-container p-0 d-flex flex-column align-items-center justify-content-center w-100 gap-4">
                        <?php
                        if ($user_posts_amount > 0) {
                            display_user_posts($current_user_id);
                        } else {
                            ?>
                            <div class="text-center d-flex flex-column align-items-center justify-content-center gap-1">
                                <i class="text-secondary bi bi-emoji-frown h1"></i>
                                <p class="text-secondary fs-5">No posts yet.</p>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </main>
        <?php include('partials/footer.php'); ?>
    </div>
</body>

</html>