<?php
require_once('../core/db_functions.php');
$conn = connect_to_db();
$user_post_count = get_user_post_count($conn, $_SESSION['user_id']);

$active_page = '';
if (basename($_SERVER['PHP_SELF']) === 'index.php') {
    $active_page = 'feed';
} elseif (basename($_SERVER['PHP_SELF']) === 'edit_profile.php') {
    $active_page = 'settings';
} elseif (basename($_SERVER['PHP_SELF']) === 'logout.php') {
    $active_page = 'logout';
}
?>

<nav class="fixed-top sidebar navbar navbar-light bg-white h-100 border-end">
    <div class="d-flex flex-column position-sticky h-100 w-100">
        <div class="sidebar-container d-flex flex-column h-100 pt-5">
            <!-- User Profile -->
            <div class="home-navbar-profile-container d-flex flex-column align-items-center text-center mb-4 pb-3">
                <a href="http://localhost/Emuel_Vassallo_4.2D/instagram-clone/public/user_profile.php?user_id=<?php echo $_SESSION['user_id']; ?>"
                    class="text-decoration-none">
                    <img class="home-navbar-user-profile-picture mb-2"
                        src="<?php echo $_SESSION['user_profile_picture_path']; ?>" alt="User profile picture">
                    <div class="home-navbar-user-profile-info-container d-flex flex-column justify-content-center">
                        <p class="user-profile-name fs-5 fw-bold p-0 m-0 text-nowrap text-body">
                            <?php echo $_SESSION['user_display_name']; ?>
                        </p>
                        <p class="user-profile-username text-secondary fs-6 p-0 m-0 text-nowrap">
                            <?php echo '@' . $_SESSION['user_username']; ?>
                        </p>
                    </div>
                </a>
            </div>


            <!-- User Profile Posts Information -->
            <div class="navbar-user-posts-info mb-4 pb-3">
                <a href="http://localhost/Emuel_Vassallo_4.2D/instagram-clone/public/user_profile.php?user_id=<?php echo $_SESSION['user_id']; ?>"
                    class="text-decoration-none">
                    <div class="navbar-user-posts d-flex flex-column align-items-center">
                        <p class="fw-bold mb-1 text-body">
                            <?php echo $user_post_count ?>
                        </p>
                        <p class="m-0 text-secondary">Posts</p>
                    </div>
                </a>
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
            <ul class="navbar-menu-links-container d-flex flex-column navbar-nav w-100 ps-0 mb-5">
                <li
                    class="nav-item d-flex mb-2 align-items-center <?php echo ($active_page === 'feed') ? 'fw-semibold active' : ''; ?>">
                    <a class="nav-link d-flex ps-5 w-100" href="index.php">
                        <i
                            class="nav-link-icon bi <?php echo ($active_page === 'feed') ? 'bi-house-door-fill' : 'bi-house-door'; ?> me-4 d-flex align-items-center justify-content-center"></i>
                        Home
                    </a>
                </li>
                <li
                    class="nav-item d-flex align-items-center <?php echo ($active_page === 'settings') ? 'fw-semibold active' : ''; ?>">
                    <a class="nav-link d-flex ps-5 w-100" href="edit_profile.php">
                        <i
                            class="nav-link-icon bi <?php echo ($active_page === 'settings') ? 'bi-gear-fill' : 'bi-gear'; ?> me-4 d-flex align-items-center justify-content-center"></i>
                        Settings
                    </a>
                </li>
                <li class="nav-item">
                </li>
            </ul>

            <!-- Logout Link -->
            <div class="w-100 navbar-nav pt-5 mt-5">
                <a class="nav-link d-flex ps-5 w-100" href="logout.php">
                    <i
                        class="nav-link-icon bi bi-box-arrow-right me-4 d-flex align-items-center justify-content-center"></i>
                    Logout
                </a>
            </div>
        </div>
    </div>
</nav>