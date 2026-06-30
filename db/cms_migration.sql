-- Update contents table
ALTER TABLE `contents` ADD COLUMN `category` VARCHAR(50) DEFAULT 'main' COMMENT 'main, kyf, kitproc' AFTER `type`;
ALTER TABLE `contents` ADD COLUMN `event_date` DATETIME NULL AFTER `image`;

-- Create gallery table
CREATE TABLE IF NOT EXISTS `gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) NOT NULL,
  `video_url` varchar(500) DEFAULT NULL,
  `media_type` varchar(20) NOT NULL DEFAULT 'image',
  `category` varchar(50) DEFAULT 'main' COMMENT 'main, kyf, kitproc',
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create member update requests table
CREATE TABLE IF NOT EXISTS `member_update_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `requested_by` varchar(150) NOT NULL,
  `requested_changes` text DEFAULT NULL,
  `requested_photo` varchar(255) DEFAULT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `admin_note` text DEFAULT NULL,
  `reviewed_by` int(11) DEFAULT NULL,
  `reviewed_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_member_update_requests_member_id` (`member_id`),
  KEY `idx_member_update_requests_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
