<nav class="d-flex flex-column navbar navbar-light bg-light justify-space-between mt-1 ps-0 pe-0 pb-4 flex-shrink-0">
    <div class="navbar-top w-100">

        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center justify-content-center align-self-start pt-4 pe-5 pb-5 ps-5 m-0 mb-4"
            href="index.php">
            <img src="images/instagram-logo.png" width="30" height="30" class="d-inline-block align-top me-3" alt="">
            <p class="h4 m-0 p-0">Instagram</p>
        </a>

        <!-- User Profile -->
        <div class="home-navbar-profile-container d-flex flex-column align-items-center text-center mb-4">
            <img class="home-navbar-user-profile-picture mb-2"
                src="<?php echo $_SESSION['user_profile_picture_path']; ?>" alt="User profile picture">
            <div class="home-navbar-user-profile-info-container d-flex flex-column justify-content-center">
                <p class="user-profile-name fs-5 fw-bold p-0 m-0 text-nowrap">
                    <?php echo $_SESSION['user_display_name']; ?>
                </p>
                <p class="user-profile-username text-dark-emphasis fs-6 p-0 m-0 text-nowrap">
                    <?php echo '@' . $_SESSION['user_username']; ?>
                </p>
            </div>
        </div>

        <!-- User Profile Posts Information -->
        <div class="navbar-user-posts-info mb-4">
            <div class="navbar-user-posts d-flex flex-column align-items-center">
                <p class="fw-bold mb-1">0</p>
                <p class="m-0 text-secondary">Posts</p>
            </div>
        </div>

        <!-- User Bio -->
        <div class="mb-5 pb-1 ps-5 pe-5 d-flex flex-column align-items-start">
            <p class="user-profile-name fs-6 fw-bold p-0 m-0 mb-2 text-nowrap">
                <?php echo $_SESSION['user_display_name']; ?>
            </p>
            <p class="m-0 text-secondary">
                <?php echo $_SESSION['user_bio'] ?>
            </p>
        </div>

        <!-- Menu Links -->
        <ul class="navbar-menu-links-container d-flex flex-column navbar-nav w-100 ps-0">
            <li
                class="nav-item d-flex mb-2 align-items-center <?php echo ($activePage === 'feed') ? 'fw-semibold active' : ''; ?>">
                <a class="nav-link d-flex ps-5 w-100" href="index.php">
                    <i
                        class="nav-link-icon bi <?php echo ($activePage === 'feed') ? 'bi-house-door-fill' : 'bi-house-door'; ?> me-4 d-flex align-items-center justify-content-center"></i>
                    Feed
                </a>
            </li>
            <li
                class="nav-item d-flex align-items-center <?php echo ($activePage === 'settings') ? 'fw-semibold active' : ''; ?>">
                <a class="nav-link d-flex ps-5 w-100" href="edit_profile.php">
                    <i
                        class="nav-link-icon bi <?php echo ($activePage === 'settings') ? 'bi-gear-fill' : 'bi-gear'; ?> me-4 d-flex align-items-center justify-content-center"></i>
                    Settings
                </a>
            </li>
            <li class="nav-item">
            </li>
        </ul>
    </div>

    <!-- Logout Link -->
    <div class="w-100 navbar-nav pt-4">
        <a class="nav-link d-flex ps-5 w-100" href="logout.php">
            <i class="nav-link-icon bi bi-box-arrow-right me-4 d-flex align-items-center justify-content-center"></i>
            Logout
        </a>
    </div>
</nav>