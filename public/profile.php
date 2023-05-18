<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js"></script>
    <script type="text/javascript" src="scripts/validateEditProfile.js" defer></script>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <section class="py-4 h-100 d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="edit-profile">
                    <form id="edit-profile-form" autocomplete="off" novalidate="novalidate" method="post"
                        enctype="multipart/form-data" action="../core/processEditProfile.php">
                        <div class="card edit-profile-card">
                            <div class="card-header fw-bold d-flex align-items-center">
                                <div class="row d-flex align-items-center w-100">
                                    <a class="col btn btn-link text-start text-nowrap p-0 ps-3" href="register.php"
                                        role="button">Back</a>
                                    <h5 class="col text-center m-0 p-0 text-nowrap">Edit Profile</h5>
                                    <a class="col btn btn-link text-nowrap p-0 invisible">Back</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="display-name" class="form-label">Profile Picture</label>
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <img src="images/default-pfp.jpg"
                                                class="profile-picture-picker-image img-fluid rounded-circle"
                                                alt="profile picture" />
                                        </div>
                                        <div class="btn btn-light btn-rounded p-0">
                                            <label class="choose-profile-picture-label form-label mb-0 w-100 h-100 p-2"
                                                for="profile-picture-picker">Upload</label>
                                            <input type="file" name="profile-picture-picker" accept="image/*"
                                                class="form-control d-none" id="profile-picture-picker"
                                                autocomplete="off" />
                                        </div>
                                    </div>
                                    <div id="errors-container_custom-profile-picture"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="edit-profile-display-name" class="form-label">Display Name</label>
                                    <input type="text" class="form-control" id="edit-profile-display-name"
                                        placeholder="Username" value="<?php echo $_SESSION['full_name'] ?>">
                                    <div id="errors-container_custom-display-name"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="bio" class="form-label">Bio</label>
                                    <textarea class="bio-text form-control" id="bio" name="bio" rows="
                                        3">Hi I'm <?php echo explode(' ', $_SESSION['full_name'])[0]; ?>!</textarea>
                                    <div id="errors-container_custom-bio"></div>
                                </div>
                                <div class="mb-3 text-end">
                                    <button type="submit" class="btn btn-primary fw-bold w-25 bg-gradient">Save</button>
                                </div>
                            </div>
                        </div>
                        <div id="errors-container_custom-container"></div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>