<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Log in</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js"></script>
    <script type="module" src="scripts/validate-login.js" defer></script>
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="d-flex flex-column">
    <section class="py-4 h-100 d-flex align-items-center justify-content-center mb-0 pb-0">
        <div class="container">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="login-form">
                    <form id="login-form" autocomplete="off" novalidate="novalidate" class="bg-white border py-4 px-5"
                        method="POST" action="../core/process_login.php">
                        <div class=" text-center mb-1 pb-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="52" height="52" fill="#595C5F"
                                class="bi bi-instagram" viewBox="0 0 16 16">
                                <path
                                    d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z" />
                            </svg>
                            <h5 class="text-muted fw-bold mt-3">
                                Log in
                            </h5>
                        </div>
                        <div class="form-floating mb-3 row">
                            <input class="form-control" id="username" name="username" type="name" autocomplete="off"
                                placeholder="Phone number, username or email address" /><label
                                class="col text-truncate">Phone
                                number, username or
                                email address</label>
                        </div>
                        <div class=" form-floating mb-3 row">
                            <input class="form-control" id="password" name="password" placeholder="Password"
                                autocomplete="off" type="password" /><label>Password</label>
                        </div>
                        <div class="mb-4 row">
                            <button class="btn btn-primary fw-bold w-100 bg-gradient" name="submit-button"
                                type="submit">Log
                                in</button>
                        </div>
                        <div id="login-error" class='alert alert-danger mb-0 row' role='alert'>Sorry, your password was
                            incorrect. Please double-check your password.</div>
                    </form>
                    <div class="bg-white py-4 px-5 text-center border mt-4">
                        <p class="m-0">
                            Don't have an account? <a href="register.php"
                                class="link-underline link-underline-opacity-0 fw-semibold">Sign up</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include('footer.php'); ?>
</body>

</html>