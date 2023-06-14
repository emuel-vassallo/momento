<?php
require_once("../core/db_functions.php");
require_once("partials/post_functions.php");

function display_posts($conn, $posts)
{
    $user_id = $_SESSION['user_id'];

    foreach ($posts as $post) {
        $poster_id = $post['user_id'];
        $poster_profile_picture = '/instagram-clone' . $post['profile_picture_path'];
        $poster_display_name = $post['display_name'];
        $poster_username = $post['username'];

        $post_id = $post['id'];
        $post_image_path = '/instagram-clone' . $post['image_dir'];
        $caption = $post['caption'] ? nl2br($post['caption']) : '';
        $created_at = $post['created_at'];

        $time_ago = get_formatted_time_ago($created_at);

        $user_profile_link = "http://localhost/instagram-clone/public/user_profile.php?user_id=" . $poster_id;

        $is_current_user = $user_id === $poster_id;

        $is_post_liked = does_row_exist($conn, 'likes_table', 'liker_id', $user_id, 'post_id', $post_id);

        $like_checked_attribute = $is_post_liked ? 'checked' : '';

        $dropdown_menu_items = get_dropdown_menu_items($is_current_user, $post_id, false);

        $caption_html = $caption === '' ? '' :
            "
            <div class='px-2 d-flex post-caption-container align-items-start gap-1'>
                <svg class='bi bi-quote flex-shrink-0 mt-1' xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' viewBox='0 0 16 16'>
                    <path d='M12 12a1 1 0 0 0 1-1V8.558a1 1 0 0 0-1-1h-1.388c0-.351.021-.703.062-1.054.062-.372.166-.703.31-.992.145-.29.331-.517.559-.683.227-.186.516-.279.868-.279V3c-.579 0-1.085.124-1.52.372a3.322 3.322 0 0 0-1.085.992 4.92 4.92 0 0 0-.62 1.458A7.712 7.712 0 0 0 9 7.558V11a1 1 0 0 0 1 1h2Zm-6 0a1 1 0 0 0 1-1V8.558a1 1 0 0 0-1-1H4.612c0-.351.021-.703.062-1.054.062-.372.166-.703.31-.992.145-.29.331-.517.559-.683.227-.186.516-.279.868-.279V3c-.579 0-1.085.124-1.52.372a3.322 3.322 0 0 0-1.085.992 4.92 4.92 0 0 0-.62 1.458A7.712 7.712 0 0 0 3 7.558V11a1 1 0 0 0 1 1h2Z'/>
                </svg>
                <div class='caption-text'>
                    <p class='post-caption m-0 fw-medium'>
                        {$caption}
                    </p>
                </div>
            </div>
            ";

        echo "<div class='post d-flex w-100 bg-white p-4 border' data-post-id='{$post_id}' data-poster-id='{$poster_id}'>
                <div class='w-100 d-flex flex-column align-items-start gap-3'>
                    <div class='px-2 post-top d-flex align-items-center w-100 justify-content-between'>
                        <a href='{$user_profile_link}' class='text-decoration-none'>
                            <div class='post-user-info d-flex align-items-center justify-content-center'>
                                <img class='lazy feed-card-profile-picture me-2 flex-shrink-0' data-src='{$poster_profile_picture}' alt='{$poster_display_name}'s profile picture'>
                                <div class='ps-1 d-flex flex-column'>
                                    <p class='m-0 fw-semibold text-body'>{$poster_display_name}</p>
                                    <p class='m-0 text-secondary'><small>@{$poster_username}</small></p>
                                </div>
                            </div>
                        </a>
                        <div class='dropdown'>
                            <i class='bi bi-three-dots w-100 h-100 text-body-tertiary post-more-options-menu-button fs-4' data-bs-toggle='dropdown' aria-expanded='false'></i>
                            <ul class='dropdown-menu p-1'> 
                                {$dropdown_menu_items}
                            </ul>
                        </div>
                    </div>

                    <div class='d-flex flex-column w-100 gap-3'>
                        <img class='lazy feed-post-image' data-src='{$post_image_path}' alt='Post Image'>

                        <div class='px-2 d-flex justify-content-between'>
                            <div class='d-flex gap-3 align-items-center'>
                                <div class='con-like cursor-pointer'>
                                    <input title='like' type='checkbox' class='like cursor-pointer' {$like_checked_attribute}>
                                    <div class='checkmark'>
                                        <svg xmlns='http://www.w3.org/2000/svg' class='bi bi-heart outline' fill='currentColor' width='22' height='22' viewBox='0 0 16 16'>
                                            <path d='m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z'/>
                                        </svg>
                                        <svg xmlns='http://www.w3.org/2000/svg' class='bi bi-heart-fill filled text-danger' fill='currentColor' width='22' height='22' viewBox='0 0 16 16'>
                                            <path fill-rule='evenodd' d='M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z'/>
                                        </svg>

                                        <svg class='celebrate' width='100' height='100' xmlns='http://www.w3.org/2000/svg'>
                                            <polygon points='10,10 20,20' class='poly'></polygon>
                                            <polygon points='10,50 20,50' class='poly'></polygon>
                                 2          <polygon points='20,80 30,70' class='poly'></polygon>
                                            <polygon points='90,10 80,20' class='poly'></polygon>
                                            <polygon points='90,50 80,50' class='poly'></polygon>
                                            <polygon points='80,80 70,70' class='poly'></polygon>
                                        </svg>
                                    </div>   
                                </div>

                                <svg xmlns='http://www.w3.org/2000/svg' width='22' height='22' fill='currentColor' class='bi bi-chat cursor-pointer' viewBox='0 0 16 16'>
                                    <path d='M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z'/>
                                </svg>

                                <svg xmlns='http://www.w3.org/2000/svg' width='22' height='22' fill='currentColor' class='bi bi-send cursor-pointer' viewBox='0 0 16 16'>
                                    <path d='M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z'/>
                                </svg>
                            </div>

                            <svg xmlns='http://www.w3.org/2000/svg' width='22' height='22' fill='currentColor' class='bi bi-bookmark justify-self-end cursor-pointer' viewBox='0 0 16 16'>
                                <path d='M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z'/>
                            </svg>
                        </div>
                    </div>
                      
                    {$caption_html}

                    <p class='px-2 post-creation-date text-secondary flex-shrink-0 m-0'><small>{$time_ago}</small></p>
                </div>
              </div>";
    }
}


function display_all_posts()
{
    $conn = connect_to_db();
    $posts = get_all_posts($conn);
    display_posts($conn, $posts);
}

function display_user_posts($user_id)
{
    $conn = connect_to_db();
    $posts = get_user_posts($conn, $user_id);
    display_posts($conn, $posts);
}

?>