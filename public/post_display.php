<?php
require_once("../core/db_functions.php");
require_once("partials/post_functions.php");
function display_posts($posts)
{
    foreach ($posts as $post) {
        $poster_id = $post['user_id'];
        $poster_profile_picture = $post['profile_picture_path'];
        $poster_display_name = $post['display_name'];
        $poster_username = $post['username'];

        $post_id = $post['id'];
        $post_image_path = $post['image_dir'];
        $caption = nl2br($post['caption']);
        $created_at = $post['created_at'];

        $time_ago = get_formatted_time_ago($created_at);

        $user_profile_link = "http://localhost/Emuel_Vassallo_4.2D/instagram-clone/public/user_profile.php?user_id=" . $poster_id;

        $is_current_user = $_SESSION['user_id'] === $poster_id;

        $dropdown_menu_items = get_dropdown_menu_items($is_current_user, $post_id, false);

        $caption_html = $caption === '' ? '' : "<svg class='bi bi-quote flex-shrink-0 me-1' xmlns='http://www.w3.org/2000/svg' width='18' height='18' fill='currentColor' viewBox='0 0 16 16'>
                                <path d='M12 12a1 1 0 0 0 1-1V8.558a1 1 0 0 0-1-1h-1.388c0-.351.021-.703.062-1.054.062-.372.166-.703.31-.992.145-.29.331-.517.559-.683.227-.186.516-.279.868-.279V3c-.579 0-1.085.124-1.52.372a3.322 3.322 0 0 0-1.085.992 4.92 4.92 0 0 0-.62 1.458A7.712 7.712 0 0 0 9 7.558V11a1 1 0 0 0 1 1h2Zm-6 0a1 1 0 0 0 1-1V8.558a1 1 0 0 0-1-1H4.612c0-.351.021-.703.062-1.054.062-.372.166-.703.31-.992.145-.29.331-.517.559-.683.227-.186.516-.279.868-.279V3c-.579 0-1.085.124-1.52.372a3.322 3.322 0 0 0-1.085.992 4.92 4.92 0 0 0-.62 1.458A7.712 7.712 0 0 0 3 7.558V11a1 1 0 0 0 1 1h2Z'/>
                            </svg>
                            <div class='caption-text'>
                            <p class='post-caption mb-1 fw-medium'>
                                $caption
                             </p>
                            </div>";

        echo "<div class='post d-flex w-100 mb-5 pb-2 bg-white py-4 px-4 border' data-post-id='$post_id' data-poster-id='$poster_id'>
                <div class='w-100 d-flex flex-column align-items-start gap-3'>
                    <div class='post-top d-flex align-items-center w-100 justify-content-between'>
                        <a href='$user_profile_link' class='text-decoration-none'>
                            <div class='post-user-info d-flex align-items-center justify-content-center'>
                                <img class='feed-card-profile-picture me-2 flex-shrink-0' src='$poster_profile_picture' alt='$poster_display_name's profile picture'>
                                <div class='ps-1 d-flex flex-column'>
                                    <p class='m-0 fw-semibold text-body'>$poster_display_name</p>
                                    <p class='m-0 text-secondary'><small>@$poster_username</small></p>
                                </div>
                            </div>
                        </a>
                        <div class='dropdown'>
                            <i class='bi bi-three-dots w-100 h-100 text-secondary post-more-options-menu-button fs-5' data-bs-toggle='dropdown' aria-expanded='false'></i>
                            <ul class='dropdown-menu p-1'> 
                                $dropdown_menu_items
                            </ul>
                        </div>
                    </div>

                    <img class='feed-post-image' src='$post_image_path' alt='Post Image'>

                    <div class='d-flex post-caption-container'>
                      $caption_html
                    </div>
                    <p class='post-creation-date text-secondary flex-shrink-0 m-0'><small>$time_ago</small></p>
                </div>
              </div>";
    }
}


function display_all_posts()
{
    $conn = connect_to_db();
    $posts = get_all_posts($conn);
    display_posts($posts);
}

function display_user_posts($user_id)
{
    $conn = connect_to_db();
    $posts = get_user_posts($conn, $user_id);
    display_posts($posts);
}

?>
