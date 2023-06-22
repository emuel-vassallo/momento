<?php
require_once('../core/db_functions.php');
require_once('../core/utility_functions.php');

$conn = connect_to_db();
$user_id = $_SESSION['user_id'];
$user_post_count = get_user_post_count($conn, $user_id);
$user_followers = get_user_followers($conn, $user_id);
$user_followers_count = count($user_followers);
$user_following = get_followed_users_by_user($conn, $user_id);
$user_following_count = count($user_following);

$active_page = get_active_page();

$poster_profile_picture = $_SESSION['user_profile_picture_path'];
$profile_pic_compression_settings = "w_500/f_auto,q_auto:eco";
$profile_pic_transformed_url = add_transformation_parameters($poster_profile_picture, $profile_pic_compression_settings);

$user_profile_link = 'user_profile.php?user_id=' . $user_id . '"';
?>

<nav class="fixed-top sidebar navbar navbar-light bg-white h-100 border-end p-0">
    <div class="d-flex flex-column position-sticky h-100 w-100">
        <div class="sidebar-container d-flex flex-column h-100 pt-5 pb-4">

            <!-- User Profile -->
            <div class="home-navbar-profile-container d-flex flex-column align-items-center text-center mb-4 pb-3">
                <a href="<?php echo $user_profile_link; ?>" class="text-decoration-none">
                    <img class="home-navbar-user-profile-picture mb-2" src="<?php echo $profile_pic_transformed_url; ?>"
                        alt="User profile picture">
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

            <!-- User Profile Information -->
            <div class="d-flex align-items-center justify-content-between navbar-user-info mx-5 px-2 mb-4 pb-3">
                <a href="<?php echo $user_profile_link; ?>" class="text-decoration-none">
                    <div class="d-flex flex-column align-items-center">
                        <p class="fw-bold mb-1 text-body">
                            <?php echo $user_post_count ?>
                        </p>
                        <p class="m-0 text-secondary">
                            <?php echo strval($user_post_count) === '1' ? 'Post' : 'Posts' ?>
                        </p>
                    </div>
                </a>
                <p class="p-0 m-0"><small>.</small></p>
                <a href="#" class="text-decoration-none">
                    <div class="d-flex flex-column align-items-center">
                        <p class="fw-bold mb-1 text-body" id="sidebar-user-followers-count">
                            <?php echo $user_followers_count ?>
                        </p>
                        <p class="m-0 text-secondary">
                            <?php echo strval($user_followers_count) === '1' ? 'Follower' : 'Followers' ?>
                        </p>
                    </div>
                </a>
                <p class="p-0 m-0"><small>.</small></p>
                <a href="#" class="text-decoration-none">
                    <div class="d-flex flex-column align-items-center">
                        <p class="fw-bold mb-1 text-body" id="sidebar-user-following-count">
                            <?php echo $user_following_count ?>
                        </p>
                        <p class="m-0 text-secondary">Following</p>
                    </div>
                </a>
            </div>

            <!-- User Bio -->
            <div class="mb-5 pb-1 mx-5 px-2 d-flex flex-column align-items-start">
                <p class="user-profile-name fs-6 fw-bold p-0 m-0 mb-2 text-nowrap">
                    <?php echo $_SESSION['user_display_name']; ?>
                </p>
                <p class="sidebar-bio-text m-0 text-secondary fs-6">
                    <?php echo $_SESSION['user_bio']; ?>
                </p>
            </div>

            <!-- Menu Links -->
            <ul class="navbar-menu-links-container d-flex flex-column navbar-nav w-100 ps-0 mb-5">
                <li
                    class="nav-item d-flex mb-2 align-items-center <?php echo ($active_page === 'feed') ? 'fw-semibold active' : ''; ?>">
                    <a class="nav-link d-flex px-2 ms-5 w-100" href="index.php">
                        <i
                            class="nav-link-icon bi <?php echo ($active_page === 'feed') ? 'bi-house-door-fill' : 'bi-house-door'; ?> me-4 d-flex align-items-center justify-content-center"></i>
                        Home
                    </a>
                </li>
                <li
                    class="nav-item d-flex align-items-center <?php echo ($active_page === 'profile') ? 'fw-semibold active' : ''; ?>">
                    <a class="nav-link d-flex px-2 ms-5 w-100" href="user_profile.php?user_id=<?php echo $user_id; ?>">
                        <i
                            class="nav-link-icon bi <?php echo ($active_page === 'profile') ? 'bi-person-fill' : 'bi-person'; ?> me-4 d-flex align-items-center justify-content-center"></i>
                        Profile
                    </a>
                </li>
                <li
                    class="nav-item d-flex align-items-center <?php echo ($active_page === 'settings') ? 'fw-semibold active' : ''; ?>">
                    <a class="nav-link d-flex px-2 ms-5 w-100" href="edit_profile.php">
                        <i
                            class="nav-link-icon bi <?php echo ($active_page === 'settings') ? 'bi-gear-fill' : 'bi-gear'; ?> me-4 d-flex align-items-center justify-content-center"></i>
                        Settings
                    </a>
                </li>
            </ul>

            <!-- Logout Link -->
            <div class="w-100 navbar-nav mt-auto">
                <a class="nav-link d-flex px-2 ms-5 w-100" href="logout.php">
                    <i
                        class="nav-link-icon bi bi-box-arrow-right me-4 d-flex align-items-center justify-content-center"></i>
                    Logout
                </a>
            </div>
        </div>
    </div>
</nav>