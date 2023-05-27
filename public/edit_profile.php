<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: http://localhost/Emuel_Vassallo_4.2D/instagram-clone/public/login.php');
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Edit Profile</title>
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

    <script src="scripts/show-search-suggestions.js" defer></script>
    <script type="module" src="scripts/post-modal-handler.js" defer></script>
</head>

<body>
    <?php include('partials/post_modal.php') ?>
    <div class="w-100 h-100 body-container container-fluid m-0 p-0">
        <?php include('partials/sidebar.php'); ?>
        <?php include('partials/header.php'); ?>
        <main class="page-settings d-flex flex-column align-items-center justify-content-between bg-light">
            <form class="p-5" id="edit-profile-form" autocomplete="off" novalidate="novalidate" method="POST"
                enctype="multipart/form-data" action="../core/process_edit_profile.php">
                <div class="card edit-profile-card">
                    <div class="card-header fw-bold d-flex align-items-center bg-white">
                        <div class="d-flex align-items-center w-100">
                            <h5 class="text-center m-0 p-0 text-nowrap">Edit Profile</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="display-name" class="form-label">Profile Picture</label>
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <img src="<?php echo $_SESSION['user_profile_picture_path'] ?>"
                                        class="profile-picture-picker-image img-fluid rounded-circle"
                                        id="profile-picture-picker-image" alt="profile picture" />
                                </div>
                                <div class="btn btn-light btn-rounded p-0">
                                    <label class="choose-profile-picture-label form-label mb-0 w-100 h-100 p-2"
                                        for="profile-picture-picker">Upload</label>
                                    <input type="file" name="profile_picture_picker" accept="image/*"
                                        class="form-control d-none" id="profile-picture-picker" autocomplete="off" />
                                </div>
                            </div>
                            <div id="errors-container_custom-profile-picture"></div>
                        </div>
                        <div class="mb-3">
                            <label for="edit-profile-display-name" class="form-label">Display
                                Name</label>
                            <input type="text" class="form-control bg-light" id="edit-profile-display-name"
                                placeholder="<?php echo $_SESSION['user_display_name'] ?>"
                                value="<?php echo $_SESSION['user_display_name'] ?>" name="user_display_name">
                            <div id="errors-container_custom-display-name">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="bio" class="form-label">Bio</label>
                            <textarea class="profile-bio-textarea form-control bg-light" id="bio" name="bio" rows="
                                        3"
                                placeholder="<?php echo $_SESSION['user_bio']; ?>"><?php echo $_SESSION['user_bio']; ?></textarea>
                            <div id="errors-container_custom-bio"></div>
                        </div>
                        <div class="mb-3 text-end">
                            <button type="submit" class="btn btn-primary fw-bold text-nowrap">Save</button>
                        </div>
                    </div>
                </div>
                <div id="errors-container_custom-container"></div>
            </form>
        </main>
        <?php include('partials/footer.php'); ?>
    </div>
</body>

</html>