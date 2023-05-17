<!DOCTYPE html>
<html>

<head>
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js"></script>
    <script type="text/javascript" src="scripts/validateLogin.js" defer></script>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <section class="py-4 h-100 d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="login-form">
                    <form id=" login-form" autocomplete="off" novalidate="novalidate" class="bg-white border py-4 px-5"
                        method="post" action="processLogin.php">
                        <div class=" text-center mb-3 pb-1">
                            <i class="fab fa-bootstrap fa-5x text-secondary mb-2"></i>
                            <h3 class="text-muted fw-bold">
                                Log In
                            </h3>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="username" name="username" type="name" autocomplete="off"
                                placeholder="Phone number, username or email address" /><label>Phone
                                number, username or
                                email address</label>
                        </div>
                        <div class=" form-floating mb-3">
                            <input class="form-control" id="password" name="password" placeholder="Password"
                                autocomplete="off" type="password" /><label>Password</label>
                        </div>
                        <div class="mb-2">
                            <button class="btn btn-primary fw-bold w-100 bg-gradient" name="submit-button"
                                type="submit">Log
                                in</button>
                        </div>
                    </form>
                    <div class="bg-white py-4 px-5 text-center border mt-4">
                        <p class="m-0">
                            Don't have an account? <a href="register.php">Sign up</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>