<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Log in · Momento</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
        </script>

    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js"></script>

    <script type="module" src="scripts/validate-login.js" defer></script>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div>
        <?php include('partials/header.php'); ?>
        <main class="page-login d-flex flex-column w-100 h-100 align-items-center justify-content-center">
            <div class="login-form-container d-flex flex-column w-100 h-100">
                <form id="login-form" autocomplete="off" novalidate="novalidate"
                    class="bg-white border py-4 px-5 rounded" method="POST" action="../core/process_login.php">
                    <div class=" text-center mb-1 pb-1">
                        <svg fill="#595C5F" width="52" height="52" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M3,9A1,1,0,0,0,4,8V5A1,1,0,0,1,5,4H8A1,1,0,0,0,8,2H5A3,3,0,0,0,2,5V8A1,1,0,0,0,3,9ZM8,20H5a1,1,0,0,1-1-1V16a1,1,0,0,0-2,0v3a3,3,0,0,0,3,3H8a1,1,0,0,0,0-2ZM12,8a4,4,0,1,0,4,4A4,4,0,0,0,12,8Zm0,6a2,2,0,1,1,2-2A2,2,0,0,1,12,14ZM19,2H16a1,1,0,0,0,0,2h3a1,1,0,0,1,1,1V8a1,1,0,0,0,2,0V5A3,3,0,0,0,19,2Zm2,13a1,1,0,0,0-1,1v3a1,1,0,0,1-1,1H16a1,1,0,0,0,0,2h3a3,3,0,0,0,3-3V16A1,1,0,0,0,21,15Z"/></svg>
                        <p class="text-muted fw-bold mt-3 fs-5">
                            Log in
                        </p>
                    </div>
                    <div class="form-floating mb-3 row">
                        <input class="form-control bg-light" id="username" name="username" type="name"
                            autocomplete="off" placeholder="Phone number, username or email address" />
                        <label class="w-100 px-0">
                            <p class="bg-light m-0 ms-1 ps-2 w-100">Phone number, username or email address</p>
                        </label>
                    </div>
                    <div class=" form-floating mb-3 row">
                        <input class="form-control bg-light" id="password" name="password" placeholder="Password"
                            autocomplete="off" type="password" />
                        <label class="w-100 px-0">
                            <p class="bg-light m-0 ms-1 ps-2 w-100">Password</p>
                        </label>
                    </div>
                    <div class="mb-4 row">
                        <button class="btn btn-primary fw-bold w-100" name="submit-button" type="submit">Log
                            in</button>
                    </div>
                    <div id="login-error" class='alert alert-danger mb-0 row' role='alert'>Sorry, your password was
                        incorrect. Please double-check your password.</div>
                </form>
                <div class="bg-white py-4 px-5 text-center border mt-4 rounded">
                    <p class="m-0">
                        Don't have an account? <a href="register.php"
                            class="link-underline link-underline-opacity-0 fw-semibold">Sign up</a>
                    </p>
                </div>
            </div>
        </main>
        <?php include('partials/footer.php'); ?>
    </div>
</body>

</html>
