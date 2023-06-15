<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function connect_to_db()
{
    $host = 'localhost';
    $db = 'InstaCloneDB';
    $user = 'root';
    $pass = '';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4' COLLATE 'utf8mb4_unicode_ci'",
    ];
    try {
        return new PDO($dsn, $user, $pass, $options);
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int) $e->getCode());
    }
}
function create_user($pdo, $email, $phone_number, $full_name, $username, $hashed_password, $display_name, $bio)
{
    $target_dir = dirname(__DIR__) . '/uploads/profile-pictures/';
    $directory_name = 'profile-pictures';

    $query_callback = function ($pdo, $profile_picture_path) use ($username, $full_name, $email, $phone_number, $hashed_password, $display_name, $bio) {
        $username = strtolower($username);
        $sql = "INSERT INTO users_table 
                  (username, full_name, email, phone_number, password, profile_picture_path, display_name, bio) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username, $full_name, $email, $phone_number, $hashed_password, $profile_picture_path, $display_name, $bio]);

        return $stmt->rowCount() > 0;
    };

    return process_file_and_execute_query($pdo, $_FILES['profile_picture_picker'], $target_dir, $directory_name, $query_callback);
}

function add_post($pdo, $user_id, $caption)
{
    $target_dir = dirname(__DIR__) . '/uploads/posts/';
    $directory_name = 'posts';

    $query_callback = function ($pdo, $new_post_modal_image_picker_path) use ($user_id, $caption) {
        $sql = "INSERT INTO posts_table (user_id, image_dir, caption, created_at) 
                  VALUES (?, ?, ?, NOW())";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$user_id, $new_post_modal_image_picker_path, $caption]);

        return $stmt->rowCount() > 0;
    };

    return process_file_and_execute_query($pdo, $_FILES['post_modal_image_picker'], $target_dir, $directory_name, $query_callback);
}

function upload_image_file_to_dir($file, $target_dir, $directory_name)
{
    $image_name = $file['name'];
    $image_tmp_name = $file['tmp_name'];

    $new_image_filename = uniqid() . '_' . $image_name;
    $image_upload_path = $target_dir . $new_image_filename;

    $relative_image_path = $directory_name . '/' . $new_image_filename;

    if ($directory_name === 'profile-pictures') {
        $_SESSION['user_profile_picture_path'] = '/instagram-clone/uploads/' . $relative_image_path;
    }

    if (move_uploaded_file($image_tmp_name, $image_upload_path)) {
        return '/uploads/' . $relative_image_path;
    }

    return false;
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

function process_file_and_execute_query($pdo, $file, $target_dir, $directory_name, $query_callback)
{
    if (empty($file['name'])) {
        return false;
    }

    $new_image_path = upload_image_file_to_dir($file, $target_dir, $directory_name);

    if (!$new_image_path) {
        return false;
    }

    return $query_callback($pdo, $new_image_path);
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

function get_post($pdo, $post_id)
{
    return get_row_by_id($pdo, 'posts_table', $post_id);
}

function update_post($pdo, $post_id, $new_caption)
{
    $new_image_file = $_FILES['post_modal_image_picker'];
    $target_dir = dirname(__DIR__) . '/uploads/posts/';
    $new_image_path = '';

    if (!empty($new_image_file['name'])) {
        $new_image_path = upload_image_file_to_dir($new_image_file, $target_dir, 'posts');
    } else {
        $sql = "SELECT image_dir FROM posts_table WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$post_id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $new_image_path = $row['image_dir'];
        }
    }

    $sql = "UPDATE posts_table SET 
              image_dir = ?,
              caption = ?,
              updated_at = NOW()
              WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$new_image_path, $new_caption, $post_id]);
}

function update_user_profile($pdo, $user_id, $display_name, $bio)
{
    $new_image_file = $_FILES['profile_picture_picker'];
    $target_dir = dirname(__DIR__) . '/uploads/profile-pictures/';
    $new_image_path = '';

    if (!empty($new_image_file['name'])) {
        $new_image_path = upload_image_file_to_dir($new_image_file, $target_dir, 'profile-pictures');
    } else {
        $sql = "SELECT profile_picture_path FROM users_table WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$user_id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $new_image_path = $row['profile_picture_path'];
        }
    }

    $sql = "UPDATE users_table SET 
              profile_picture_path = ?,
              display_name = ?,
              bio = ?
              WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$new_image_path, $display_name, $bio, $user_id]);
}

function delete_post($pdo, $post_id)
{
    $sql = "DELETE FROM posts_table WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$post_id]);

    return $stmt->rowCount() > 0;
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
?>