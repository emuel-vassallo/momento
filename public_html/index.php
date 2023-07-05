<?php
session_start();

require_once('../core/utility_functions.php');
redirect_if_not_logged_in();

require_once('post_display.php');
?>
<!DOCTYPE html>
<html>

<head>
    <title>Momento</title>
    <meta charset="UTF-8">
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
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="post-link-copied-toast" class="toast align-items-center" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    Link copied to clipboard.
                </div>
                <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
    <div class="w-100 h-100 body-container container-fluid m-0 p-0">
        <?php include('partials/header.php'); ?>
        <?php include('partials/sidebar.php'); ?>
        <main class="page-home d-flex flex-column h-100 bg-light align-items-center justify-content-start">
            <div
                class="d-flex feed-container flex-column pt-5 pb-5 align-items-start align-items-center justify-content-center">
                <div class="feed-top w-100 mb-4">
                    <p class="h3 fw-semibold">Feed</p>
                </div>
                <div class="feed-posts-container d-flex flex-column align-items-center justify-content-center gap-4">
                    <?php display_all_posts() ?>
                </div>
            </div>
        </main>
        <?php include('partials/footer.php'); ?>
    </div>
</body>

</html>