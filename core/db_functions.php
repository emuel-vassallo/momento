<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function connect_to_db()
{
    require_once 'config.php';

    $dsn = "mysql:host=" . DB_CONFIG['host'] . ";dbname=" . DB_CONFIG['db'];
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4' COLLATE 'utf8mb4_unicode_ci'",
    ];

    try {
        return new PDO($dsn, DB_CONFIG['user'], DB_CONFIG['pass'], $options);
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int) $e->getCode());
    }
}

function upload_image_to_cloudinary($file, $target_dir, $public_id = null)
{
    require_once '../vendor/autoload.php';

    if (!empty($public_id)) {
        return (new Cloudinary\Api\Upload\UploadApi())->upload($file['tmp_name'], [
            'public_id' => $public_id,
            'resource_type' => 'image',
        ]);

    }

    return (new Cloudinary\Api\Upload\UploadApi())->upload($file['tmp_name'], [
        'folder' => $target_dir,
        'resource_type' => 'image',
    ]);
}


function process_file_and_execute_query($pdo, $file, $target_dir, $query_callback)
{
    if (empty($file['name'])) {
        return false;
    }

    $new_image_result = upload_image_to_cloudinary($file, $target_dir);
    $new_image_path = $new_image_result['secure_url'];
    $new_image_public_id = $new_image_result['public_id'];

    if (!$new_image_path || !$new_image_public_id) {
        return false;
    }

    return $query_callback($pdo, $new_image_path, $new_image_public_id);
}

function create_user($pdo, $email, $phone_number, $full_name, $username, $hashed_password, $display_name, $bio)
{
    $target_dir = 'momento/profile-pictures/';

    $query_callback = function ($pdo, $profile_picture_path, $new_image_public_id) use ($username, $full_name, $email, $phone_number, $hashed_password, $display_name, $bio) {
        $username = strtolower($username);
        $sql = "INSERT INTO users_table 
                  (username, full_name, email, phone_number, password, profile_picture_path, image_public_id, display_name, bio) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username, $full_name, $email, $phone_number, $hashed_password, $profile_picture_path, $new_image_public_id, $display_name, $bio]);

        return $stmt->rowCount() > 0;
    };

    return process_file_and_execute_query($pdo, $_FILES['profile_picture_picker'], $target_dir, $query_callback);
}

function add_post($pdo, $user_id, $caption)
{
    $target_dir = 'momento/posts';

    $query_callback = function ($pdo, $new_post_modal_image_picker_path, $new_post_image_public_id) use ($user_id, $caption) {
        $sql = "INSERT INTO posts_table (user_id, image_dir, image_public_id, caption, created_at) 
                  VALUES (?, ?, ?, ?, NOW())";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$user_id, $new_post_modal_image_picker_path, $new_post_image_public_id, $caption]);

        return $stmt->rowCount() > 0;
    };

    return process_file_and_execute_query($pdo, $_FILES['post_modal_image_picker'], $target_dir, $query_callback);
}

function get_user_by_credentials($pdo, $username, $password)
{
    $sql = "SELECT * 
              FROM users_table 
              WHERE username = ?
                OR email = ?
                OR phone_number = ?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $username,
        $username,
        $username
    ]);

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        return false;
    }

    $hashed_password = $row['password'];

    if (password_verify($password, $hashed_password) || $password === $hashed_password) {
        return $row;
    }

    return false;
}

function fetch_posts($pdo, $sql)
{
    $stmt = $pdo->query($sql);
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $posts;
}

function get_all_posts($pdo)
{
    $sql = "SELECT p.*, u.username, u.display_name, u.profile_picture_path
              FROM posts_table AS p
              JOIN users_table AS u ON p.user_id = u.id
              ORDER BY p.created_at DESC;
              ";

    return fetch_posts($pdo, $sql);
}

function get_user_posts($pdo, $user_id)
{
    $sql = "SELECT p.*, u.username, u.display_name, u.profile_picture_path
              FROM posts_table AS p
              JOIN users_table AS u ON p.user_id = u.id
              WHERE u.id = $user_id
              ORDER BY p.created_at DESC;
              ";

    return fetch_posts($pdo, $sql);
}

function get_user_post_count($pdo, $user_id)
{
    $sql = "SELECT COUNT(*) AS post_count FROM posts_table WHERE user_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC)['post_count'];
    return $row;
}

function get_all_users($pdo)
{
    $sql = "SELECT id, username, display_name, profile_picture_path FROM users_table";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $profiles = [];

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $profiles[] = $row;
    }

    return $profiles;
}

function get_row_by_id($pdo, $table_name, $row_id)
{
    $sql = "SELECT * 
              FROM $table_name
              WHERE id = ?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$row_id]);

    if (!$stmt || $stmt->rowCount() === 0) {
        return false;
    }

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row;
}

function get_user_info($pdo, $user_id)
{
    return get_row_by_id($pdo, 'users_table', $user_id);
}

function get_users_info($pdo, $user_ids)
{
    $placeholders = implode(',', array_fill(0, count($user_ids), '?'));
    $sql = "SELECT id, username, display_name, profile_picture_path 
            FROM users_table 
            WHERE id IN ($placeholders)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($user_ids);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get_post($pdo, $post_id)
{
    return get_row_by_id($pdo, 'posts_table', $post_id);
}

function update_post($pdo, $post_id, $new_caption)
{
    $new_image_file = $_FILES['post_modal_image_picker'];
    $new_image_path = null;
    $is_image_updated = !empty($new_image_file['name']);
    $is_caption_updated = isset($new_caption);
    $is_post_updated = $is_caption_updated || $is_image_updated;

    if ($is_post_updated) {
        if ($is_caption_updated && $is_image_updated) {
            $target_dir = 'momento/posts';
            $image_public_id = get_image_public_id_from_post($pdo, $post_id);
            $new_image_path = upload_image_to_cloudinary($new_image_file, $target_dir, $image_public_id)['secure_url'];

            $sql = "UPDATE posts_table SET 
              image_dir = ?,
              caption = ?,
              updated_at = NOW()
              WHERE id = ?";

            $stmt = $pdo->prepare($sql);
            return $stmt->execute([$new_image_path, $new_caption, $post_id]);
        }
        if ($is_caption_updated) {
            $sql = "UPDATE posts_table SET 
              caption = ?,
              updated_at = NOW()
              WHERE id = ?";

            $stmt = $pdo->prepare($sql);
            return $stmt->execute([$new_caption, $post_id]);
        }
        if ($is_image_updated) {
            $target_dir = 'momento/posts';
            $image_public_id = get_image_public_id_from_post($pdo, $post_id);
            $new_image_path = upload_image_to_cloudinary($new_image_file, $target_dir, $image_public_id)['secure_url'];

            $sql = "UPDATE posts_table SET 
              image_dir = ?,
              updated_at = NOW()
              WHERE id = ?";

            $stmt = $pdo->prepare($sql);
            return $stmt->execute([$new_image_path, $post_id]);
        }
    }
    return true;
}

function update_user_profile($pdo, $user_id, $new_display_name, $new_bio)
{
    $new_image_file = $_FILES['profile_picture_picker'];
    $is_image_updated = !empty($new_image_file['name']);
    $is_display_name_updated = isset($new_display_name);
    $is_bio_updated = isset($new_bio);
    $is_profile_updated = $is_display_name_updated || $is_image_updated || $is_bio_updated;

    $new_image_url = '';

    if ($is_profile_updated) {
        $target_dir = 'momento/profile-pictures';
        $image_public_id = get_image_public_id_from_user($pdo, $user_id);

        if ($is_image_updated) {
            $new_image_url = upload_image_to_cloudinary($new_image_file, $target_dir, $image_public_id)['secure_url'];
            $_SESSION['user_profile_picture_path'] = $new_image_url;
        }

        $sql = "UPDATE users_table SET 
            profile_picture_path = IF(:is_image_updated, :new_image_url, profile_picture_path),
            display_name = IF(:is_display_name_updated, :new_display_name, display_name),
            bio = IF(:is_bio_updated, :new_bio, bio)
            WHERE id = :user_id";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':is_image_updated', $is_image_updated, PDO::PARAM_BOOL);
        $stmt->bindParam(':new_image_url', $new_image_url);
        $stmt->bindParam(':is_display_name_updated', $is_display_name_updated, PDO::PARAM_BOOL);
        $stmt->bindParam(':new_display_name', $new_display_name);
        $stmt->bindParam(':is_bio_updated', $is_bio_updated, PDO::PARAM_BOOL);
        $stmt->bindParam(':new_bio', $new_bio);
        $stmt->bindParam(':user_id', $user_id);

        return $stmt->execute();
    }
}

function delete_image_from_cloudinary($public_id)
{
    require_once '../vendor/autoload.php';

    try {
        $result = (new Cloudinary\Api\Upload\UploadApi())->destroy($public_id);
        return !empty($result) && $result['result'] == 'ok';
    } catch (\Exception $e) {
        return false;
    }
}

function get_image_public_id_from_user($pdo, $user_id)
{
    $sql = "SELECT image_public_id FROM users_table WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id]);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result && isset($result['image_public_id'])) {
        return $result['image_public_id'];
    } else {
        return null;
    }
}

function get_image_public_id_from_post($pdo, $post_id)
{
    $sql = "SELECT image_public_id FROM posts_table WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$post_id]);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result && isset($result['image_public_id'])) {
        return $result['image_public_id'];
    } else {
        return null;
    }
}

function delete_post($pdo, $post_id)
{
    $sql = "DELETE FROM posts_table WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$post_id]);

    return $stmt->rowCount() > 0;
}

function delete_post_with_image($pdo, $post_id)
{
    $image_public_id = get_image_public_id_from_post($pdo, $post_id);

    $image_deleted = delete_image_from_cloudinary($image_public_id);

    if (!$image_deleted) {
        return false;
    }

    $post_deleted = delete_post($pdo, $post_id);

    if (!$post_deleted) {
        return false;
    }

    return true;
}

function does_value_exist($pdo, $table, $column, $value)
{
    $sql = "SELECT * FROM $table WHERE $column = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$value]);
    $result = $stmt->fetchAll();
    return count($result) > 0;
}

function does_row_exist($pdo, $table, $column1, $value1, $column2, $value2)
{
    $sql = "SELECT * FROM $table WHERE $column1 = ? AND $column2 = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$value1, $value2]);
    $result = $stmt->fetchAll();
    return count($result) > 0;
}

function add_like($pdo, $liker_id, $post_id)
{
    $sql = "INSERT INTO likes_table (liker_id, post_id) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$liker_id, $post_id]);

    return $stmt->rowCount() > 0;
}

function remove_like($pdo, $liker_id, $post_id)
{
    $sql = "DELETE FROM likes_table WHERE liker_id = ? AND post_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$liker_id, $post_id]);

    return $stmt->rowCount() > 0;
}

function get_post_likes($pdo, $post_id)
{
    $sql = "SELECT u.*
            FROM users_table AS u
            JOIN likes_table AS l ON u.id = l.liker_id
            WHERE l.post_id = ?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$post_id]);

    $profiles = [];

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $profiles[] = $row;
    }

    return $profiles;
}

function get_user_followers(PDO $pdo, $user_id)
{
    $sql = "SELECT u.* 
            FROM users_table u 
            INNER JOIN followers_table f ON u.id = f.follower_id
            WHERE f.followed_id = :user_id";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get_followed_users_by_user(PDO $pdo, $user_id)
{
    $sql = "SELECT u.* 
            FROM users_table u 
            INNER JOIN followers_table f ON u.id = f.followed_id
            WHERE f.follower_id = :user_id";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function follow_user(PDO $pdo, $follower_id, $followed_id)
{
    $sql = "INSERT INTO followers_table (follower_id, followed_id) VALUES (:follower_id, :followed_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':follower_id', $follower_id, PDO::PARAM_INT);
    $stmt->bindParam(':followed_id', $followed_id, PDO::PARAM_INT);
    $success = $stmt->execute();
    return $success;
}

function unfollow_user(PDO $pdo, $follower_id, $followed_id)
{
    $sql = "DELETE FROM followers_table WHERE follower_id = :follower_id AND followed_id = :followed_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':follower_id', $follower_id, PDO::PARAM_INT);
    $stmt->bindParam(':followed_id', $followed_id, PDO::PARAM_INT);
    $success = $stmt->execute();
    return $success;
}
?>