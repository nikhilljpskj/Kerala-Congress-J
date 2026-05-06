-- Update contents table
ALTER TABLE `contents` ADD COLUMN `category` VARCHAR(50) DEFAULT 'main' COMMENT 'main, kyf, kitproc' AFTER `type`;
ALTER TABLE `contents` ADD COLUMN `event_date` DATETIME NULL AFTER `image`;

-- Create gallery table
CREATE TABLE IF NOT EXISTS `gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) NOT NULL,
  `category` varchar(50) DEFAULT 'main' COMMENT 'main, kyf, kitproc',
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
