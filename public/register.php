<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Sign up · Instagram Clone</title>
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
        <?php include('header.php'); ?>
        <main class="page-register d-flex flex-column w-100 h-100 align-items-center justify-content-center">
            <div class="register-form-container d-flex flex-column w-100 h-100">
                <form id="register-form" autocomplete="off" novalidate="novalidate"
                    class="bg-white border py-4 px-5 rounded" method="POST" enctype="multipart/form-data"
                    action="../core/process_register_form.php">
                    <div class=" text-center mb-1 pb-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="52" height="52" fill="#595C5F"
                            class="bi bi-instagram" viewBox="0 0 16 16">
                            <path
                                d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z" />
                        </svg>
                        <p class="text-muted fw-bold mt-3 fs-5">
                            Sign up to see photos from your friends.
                        </p>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control bg-light" id="email" name="email" placeholder="Email"
                            autocomplete="off" type="email" value="<?php echo $_SESSION['email'] ?>" />
                        <label class="w-100 px-0">
                            <p class="bg-light m-0 ms-1 ps-2 w-100">Email</p>
                        </label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control bg-light" id="phone-number" name="phone_number"
                            placeholder="Phone Number" autocomplete="off" autocomplete="off" type="text"
                            value="<?php echo $_SESSION['phone_number'] ?>" />
                        <label class="w-100 px-0">
                            <p class="bg-light m-0 ms-1 ps-2 w-100">Phone Number</p>
                        </label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control bg-light" id="full-name" name="full_name" placeholder="Full Name"
                            autocomplete="off" type="text" value="<?php echo $_SESSION['full_name'] ?>" />
                        <label class="w-100 px-0">
                            <p class="bg-light m-0 ms-1 ps-2 w-100">Full Name</p>
                        </label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control bg-light" id="username" name="username" placeholder="Username"
                            autocomplete="off" type="text" value="<?php echo $_SESSION['username'] ?>" />
                        <label class="w-100 px-0">
                            <p class="bg-light m-0 ms-1 ps-2 w-100">Username</p>
                        </label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control bg-light" id="password" name="password" placeholder="Password"
                            autocomplete="off" type="password" />
                        <label class="w-100 px-0">
                            <p class="bg-light m-0 ms-1 ps-2 w-100">Password</p>
                        </label>
                    </div>
                    <div class="mb-2">
                        <button id="register-submit-button" class="btn btn-primary fw-bold w-100" name="submit"
                            type="submit">Next</button>
                    </div>
                </form>
                <div class="bg-white py-4 px-5 text-center border mt-4 rounded">
                    <p class="m-0">
                        Have an account? <a href="login.php"
                            class="link-underline link-underline-opacity-0 fw-semibold">Log
                            in</a>
                    </p>
                </div>
            </div>
        </main>
        <?php include('footer.php'); ?>
    </div>
</body>

</html>