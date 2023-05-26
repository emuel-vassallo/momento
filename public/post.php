<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: http://localhost/Emuel_Vassallo_4.2D/instagram-clone/public/login.php');
}

if (isset($_GET['post_id'])) {
    require_once('../core/db_functions.php');
    require_once("partials/post_functions.php");

    $conn = connect_to_db();
    $post_id = $_GET['post_id'];
    $post_info = get_post($conn, $post_id);

    if (!$post_info) {
        header('Location: http://localhost/Emuel_Vassallo_4.2D/instagram-clone/public/index.php');
        exit();
    }

    $user_info = get_user_info($conn, $post_info['user_id']);

    $time_ago = get_formatted_time_ago($post_info['created_at']);

    $is_current_user = $_SESSION['user_id'] === $user_info['id'];
    $dropdown_menu_items = get_dropdown_menu_items($is_current_user, $post_id, true);
} else {
    header('Location: http://localhost/Emuel_Vassallo_4.2D/instagram-clone/public/index.php');
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Instagram Clone</title>
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
    <script src="scripts/create-post-modal-handler.js" defer></script>
    <script src="scripts/validate-create-post-form.js" defer></script>
    <script src="scripts/show-search-suggestions.js" defer></script>
    <script src="scripts/post-more-options-handler.js" defer></script>
</head>

<body class="h-100 w-100 m-0 p-0">
    <div class="backdrop hidden">
    </div>
    <?php include('partials/create_post_modal.php') ?>
    <?php include('partials/delete_post_modal.php') ?>
    <?php include('partials/post_link_copied_toast.php'); ?>
    <div class="w-100 h-100 body-container container-fluid m-0 p-0">
        <?php include('partials/header.php'); ?>
        <?php include('partials/sidebar.php'); ?>
        <main class="page-post d-flex flex-column h-100 bg-light p-5 align-items-center justify-content-center">
            <div class="post row w-100 h-100 bg-white py-4 px-4 border" data-post-id="<?php echo $post_id ?>">
                <img class="post-page-image col-8 p-0" src="<?php echo $post_info['image_dir']; ?>" alt="Post Image">

                <div class="post-sidebar col-4 d-flex flex-column gap-4 px-5 py-3">
                    <div class="pt-0 d-flex align-items-center justify-content-between">
                        <a href="http://localhost/Emuel_Vassallo_4.2D/instagram-clone/public/user_profile.php?user_id=<?php echo $user_info['id'] ?>"
                            class="text-decoration-none">
                            <div class="post-user-info d-flex align-items-center justify-content-center">
                                <img class="page-post-profile-picture me-3 flex-shrink-0"
                                    src="<?php echo $user_info['profile_picture_path']; ?>" alt="Sophia Adams" s=""
                                    profile="" picture'="">
                                <div class="ps-1 d-flex flex-column">
                                    <p class="m-0 fw-semibold text-body fs-5">
                                        <?php echo $user_info['display_name']; ?>
                                    </p>
                                    <p class="m-0 text-secondary">
                                        <?php echo '@' . $user_info['username']; ?>
                                    </p>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown">
                            <i class="bi bi-three-dots w-100 h-100 text-secondary post-more-options-menu-button fs-5"
                                data-bs-toggle="dropdown" aria-expanded="false"></i>
                            <ul class="dropdown-menu p-1">
                                <?php echo $dropdown_menu_items ?>
                            </ul>
                        </div>
                    </div>

                    <div class="d-flex flex-column post-bottom align-items-start justify-content-start w-100 fs-6">
                        <p class="post-caption mb-1 fw-medium d-flex align-items-start justify-content-center">
                            <svg class="bi bi-quote flex-shrink-0 me-1" xmlns="http://www.w3.org/2000/svg" width="18"
                                height="18" fill="currentColor" viewBox="0 0 16 16" data-darkreader-inline-fill=""
                                style="--darkreader-inline-fill: currentColor;">
                                <path
                                    d="M12 12a1 1 0 0 0 1-1V8.558a1 1 0 0 0-1-1h-1.388c0-.351.021-.703.062-1.054.062-.372.166-.703.31-.992.145-.29.331-.517.559-.683.227-.186.516-.279.868-.279V3c-.579 0-1.085.124-1.52.372a3.322 3.322 0 0 0-1.085.992 4.92 4.92 0 0 0-.62 1.458A7.712 7.712 0 0 0 9 7.558V11a1 1 0 0 0 1 1h2Zm-6 0a1 1 0 0 0 1-1V8.558a1 1 0 0 0-1-1H4.612c0-.351.021-.703.062-1.054.062-.372.166-.703.31-.992.145-.29.331-.517.559-.683.227-.186.516-.279.868-.279V3c-.579 0-1.085.124-1.52.372a3.322 3.322 0 0 0-1.085.992 4.92 4.92 0 0 0-.62 1.458A7.712 7.712 0 0 0 3 7.558V11a1 1 0 0 0 1 1h2Z">
                                </path>
                            </svg>
                            <?php echo $post_info['caption']; ?>
                        </p>
                    </div>

                    <p class="post-creation-date text-secondary flex-shrink-0 p-0 m-0 align-self-end mt-auto">
                        <?php echo $time_ago ?>
                    </p>
                </div>
            </div>
        </main>
        <?php include('partials/footer.php'); ?>
    </div>
</body>

</html>
