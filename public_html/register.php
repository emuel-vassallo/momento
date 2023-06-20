<?php
session_start();

$email = $_SESSION['email'] ?? '';
$phone_number = $_SESSION['phone_number'] ?? '';
$full_name = $_SESSION['full_name'] ?? '';
$username = $_SESSION['username'] ?? '';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Sign up · Momento</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
        </script>

    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js"></script>

    <script type="module" src="scripts/validate-register.js" defer></script>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div>
        <?php include('partials/header.php'); ?>
        <main class="bg-light page-register d-flex flex-column w-100 align-items-center justify-content-center">
            <div class="container p-0 m-0">
                <div class="card register-card border">
                    <div class="register-card-img-container row no-gutters">
                        <div class="col-md-6 p-0">
                            <img class="register-card-img h-100 w-100"
                                src="https://res.cloudinary.com/dp4vwqhol/image/upload/w_1000/f_auto,q_auto:eco/v1687030815/momento/images/toa-heftiba-l_ExpFwwOEg-unsplash_wto45y.jpg"
                                alt="">
                        </div>
                        <div class="col-md-6 p-0">
                            <div class="card-body h-100 d-flex flex-column justify-content-center p-0">
                                <form id="register-form" autocomplete="off" novalidate="novalidate"
                                    class="d-flex flex-column w-100 p-5 gap-5" method="POST"
                                    enctype="multipart/form-data"
                                    action="execute_core_file.php?filename=process_register_form.php">
                                    <div>
                                        <p class="fw-bold fs-1 m-0 p-0">
                                            Create an account<br>
                                        </p>
                                        <p class="fs-5 m-0 p-0">
                                            Start sharing moments, one click at a time!<br>
                                        </p>
                                    </div>
                                    <div class="inputs-container d-flex flex-column gap-4">
                                        <div class="d-flex gap-4">
                                            <div class="form-floating">
                                                <input class="form-control bg-light px-3" id="email" name="email"
                                                    placeholder="Email" autocomplete="off" type="email"
                                                    value="<?php echo $email ?>" />
                                                <label class="w-100 px-0">
                                                    <p class="bg-light px-3 w-100 text-truncate">Email</p>
                                                </label>
                                            </div>
                                            <div class="form-floating">
                                                <input class="form-control bg-light px-3" id="phone-number"
                                                    name="phone_number" placeholder="Phone Number" autocomplete="off"
                                                    autocomplete="off" type="text"
                                                    value="<?php echo $phone_number ?>" />
                                                <label class="w-100 px-0">
                                                    <p class="bg-light px-3 w-100 text-truncate">Phone Number</p>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-floating">
                                            <input class="form-control bg-light px-3" id="full-name" name="full_name"
                                                placeholder="Full Name" autocomplete="off" type="text"
                                                value="<?php echo $full_name ?>" />
                                            <label class="w-100 px-0">
                                                <p class="bg-light px-3 w-100 text-truncate">Full Name</p>
                                            </label>
                                        </div>
                                        <div class="form-floating">
                                            <input class="form-control bg-light px-3" id="username" name="username"
                                                placeholder="Username" autocomplete="off" type="text"
                                                value="<?php echo $username ?>" />
                                            <label class="w-100 px-0">
                                                <p class="bg-light px-3 w-100 text-truncate">Username</p>
                                            </label>
                                        </div>
                                        <div class="form-floating">
                                            <input class="form-control bg-light px-3" id="password" name="password"
                                                placeholder="Password" autocomplete="off" type="password" />
                                            <label class="w-100 px-0">
                                                <p class="bg-light px-3 w-100 text-truncate">Password</p>
                                            </label>
                                        </div>
                                        <div>
                                            <button id="register-submit-button" class="btn btn-primary fw-bold w-100"
                                                name="submit" type="submit">Next</button>
                                        </div>
                                    </div>
                                    <div class="bg-white">
                                        <p class="m-0">
                                            <span class="text-muted">Have an account?</span> <a href="login.php"
                                                class="link-underline link-underline-opacity-0 fw-semibold">Log
                                                in</a>
                                        </p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <?php include('partials/footer.php'); ?>
    </div>
</body>

</html>