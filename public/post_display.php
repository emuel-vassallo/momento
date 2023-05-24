<?php
require_once("../core/db_functions.php");
$conn = connect_to_db();
$posts = get_all_posts($conn);

function display_posts($posts)
{
    foreach ($posts as $post) {
        $poster_profile_picture = $post['profile_picture_path'];
        $poster_display_name = $post['display_name'];
        $poster_username = $post['username'];
        $post_image_path = $post['image_dir'];
        $caption = $post['caption'];
        $created_at = $post['created_at'];
        $created_timestamp = strtotime($created_at);
        $current_timestamp = time();
        $time_diff = $current_timestamp - $created_timestamp;

        if ($time_diff < 60) {
            $time_ago = ($time_diff == 1) ? "1 second ago" : $time_diff . " seconds ago";
        } elseif ($time_diff < 3600) {
            $minutes = floor($time_diff / 60);
            $time_ago = ($minutes == 1) ? "1 minute ago" : $minutes . " minutes ago";
        } elseif ($time_diff < 86400) {
            $hours = floor($time_diff / 3600);
            $time_ago = ($hours == 1) ? "1 hour ago" : $hours . " hours ago";
        } else {
            $time_ago = date("F j, Y", $created_timestamp);
        }

        echo "<div class='post d-flex w-100 mb-5 pb-4'>
                <div class='d-flex flex-column align-items-start'>
                    <div class='post-top d-flex align-items-center mb-2 pb-2'>
                        <div class='post-user-info d-flex align-items-center justify-content-center'>
                            <img class='feed-card-profile-picture me-2' src='$poster_profile_picture' alt='$poster_display_name's profile picture'>
                            <div class='ps-1 d-flex flex-column'>
                                <p class='m-0 fw-semibold'>$poster_display_name</p>
                                <p class='m-0 text-secondary'><small>@$poster_username</small></p>
                            </div>
                        </div>
                    </div>
                    <img class='feed-post-image mb-3 pb-1' src='$post_image_path' alt='Post Image'>
                    <div class='d-flex flex-column post-bottom align-items-start justify-content-start w-100'>
                        <p class='post-caption mb-1 fw-medium'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' fill='currentColor' class='bi bi-quote' viewBox='0 0 16 16'>
                            <path d='M12 12a1 1 0 0 0 1-1V8.558a1 1 0 0 0-1-1h-1.388c0-.351.021-.703.062-1.054.062-.372.166-.703.31-.992.145-.29.331-.517.559-.683.227-.186.516-.279.868-.279V3c-.579 0-1.085.124-1.52.372a3.322 3.322 0 0 0-1.085.992 4.92 4.92 0 0 0-.62 1.458A7.712 7.712 0 0 0 9 7.558V11a1 1 0 0 0 1 1h2Zm-6 0a1 1 0 0 0 1-1V8.558a1 1 0 0 0-1-1H4.612c0-.351.021-.703.062-1.054.062-.372.166-.703.31-.992.145-.29.331-.517.559-.683.227-.186.516-.279.868-.279V3c-.579 0-1.085.124-1.52.372a3.322 3.322 0 0 0-1.085.992 4.92 4.92 0 0 0-.62 1.458A7.712 7.712 0 0 0 3 7.558V11a1 1 0 0 0 1 1h2Z'/>
                        </svg>
                        $caption</p>
                        <p class='post-creation-date text-secondary flex-shrink-0'><small>$time_ago</small></p>
                    </div>
                </div>
              </div>";
    }
}
?>