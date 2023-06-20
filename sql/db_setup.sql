SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `users_table` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_picture_path` varchar(255) NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `bio` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `posts_table` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `image_dir` varchar(255) DEFAULT NULL,
  `caption` varchar(2200) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `likes_table` (
  `like_id` int(11) NOT NULL,
  `liker_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `liked_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `comments_table` (
  `id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `parent_comment_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `followers_table` (
  `follow_id` int(11) NOT NULL,
  `follower_id` int(11) NOT NULL,
  `followed_id` int(11) NOT NULL,
  `followed_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `comments_table`
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

ALTER TABLE `followers_table`
  ADD PRIMARY KEY (`follow_id`),
  ADD KEY `follower_id` (`follower_id`),
  ADD KEY `followed_id` (`followed_id`);

ALTER TABLE `likes_table`
  ADD PRIMARY KEY (`like_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `liker_id` (`liker_id`) USING BTREE;

ALTER TABLE `posts_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_table_ibfk_1` (`user_id`);

ALTER TABLE `users_table`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `followers_table`
  MODIFY `follow_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `likes_table`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=373;

ALTER TABLE `posts_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=191;

ALTER TABLE `users_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=486;

ALTER TABLE `comments_table`
  ADD CONSTRAINT `comments_table_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_table_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `followers_table`
  ADD CONSTRAINT `followers_table_ibfk_1` FOREIGN KEY (`follower_id`) REFERENCES `users_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `followers_table_ibfk_2` FOREIGN KEY (`followed_id`) REFERENCES `users_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `likes_table`
  ADD CONSTRAINT `likes_table_ibfk_1` FOREIGN KEY (`liker_id`) REFERENCES `users_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `likes_table_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `posts_table`
  ADD CONSTRAINT `posts_table_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;