<?php
require_once("db_functions.php");
$pdo = connect_to_db();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $post_id = !empty($_GET['post_id']) ? trim($_GET['post_id']) : '';

    if (!empty($post_id)) {
        $post_likes = get_post_likes($pdo, $post_id);

        if ($post_likes) {
            $profiles = [];
            foreach ($post_likes as $like) {
                $profile = get_user_info($pdo, $like['id']);
                if ($profile) {
                    $profiles[] = $profile;
                }
            }

            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'profiles' => $profiles]);
            exit;
        } else {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Post likes not found']);
            exit;
        }
    }
}

header('Content-Type: application/json');
echo json_encode(['success' => false, 'message' => 'Failed to retrieve data']);
?>