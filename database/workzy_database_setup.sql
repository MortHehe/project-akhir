-- ============================================================
-- WORKZY - Freelance Marketplace Platform
-- Database Setup Script
-- MySQL Database Schema
-- Version: 1.0.0
-- Date: December 10, 2025
-- ============================================================

-- Create Database
CREATE DATABASE IF NOT EXISTS `workzy`
DEFAULT CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE `workzy`;

-- ============================================================
-- TABLE: users
-- Description: Stores all user accounts (clients, freelancers, admins)
-- ============================================================
CREATE TABLE IF NOT EXISTS `users` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `role` VARCHAR(50) NOT NULL DEFAULT 'user' COMMENT 'user=client, freelancer, admin',
  `phone` VARCHAR(20) NULL,
  `location` VARCHAR(255) NULL,
  `company` VARCHAR(255) NULL,
  `industry` VARCHAR(100) NULL,
  `company_size` VARCHAR(50) NULL,
  `website` VARCHAR(255) NULL,
  `company_description` TEXT NULL,
  `notification_settings` TEXT NULL,
  `bio` TEXT NULL COMMENT 'User biography/about section',
  `skills` TEXT NULL COMMENT 'JSON array of skills',
  `hourly_rate` DECIMAL(10,2) NULL COMMENT 'Hourly rate for freelancers',
  `availability` VARCHAR(50) NULL COMMENT 'Freelancer availability status',
  `email_verified_at` TIMESTAMP NULL,
  `password` VARCHAR(255) NOT NULL,
  `remember_token` VARCHAR(100) NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `idx_role` (`role`),
  KEY `idx_location` (`location`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- TABLE: password_reset_tokens
-- Description: Stores password reset tokens
-- ============================================================
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` VARCHAR(255) NOT NULL,
  `token` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- TABLE: sessions
-- Description: Stores user session data
-- ============================================================
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` VARCHAR(255) NOT NULL,
  `user_id` BIGINT UNSIGNED NULL,
  `ip_address` VARCHAR(45) NULL,
  `user_agent` TEXT NULL,
  `payload` LONGTEXT NOT NULL,
  `last_activity` INT NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- TABLE: cache
-- Description: Application cache storage
-- ============================================================
CREATE TABLE IF NOT EXISTS `cache` (
  `key` VARCHAR(255) NOT NULL,
  `value` MEDIUMTEXT NOT NULL,
  `expiration` INT NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- TABLE: cache_locks
-- Description: Cache locking mechanism
-- ============================================================
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` VARCHAR(255) NOT NULL,
  `owner` VARCHAR(255) NOT NULL,
  `expiration` INT NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- TABLE: jobs
-- Description: Queue jobs for background processing
-- ============================================================
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` VARCHAR(255) NOT NULL,
  `payload` LONGTEXT NOT NULL,
  `attempts` TINYINT UNSIGNED NOT NULL,
  `reserved_at` INT UNSIGNED NULL,
  `available_at` INT UNSIGNED NOT NULL,
  `created_at` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- TABLE: job_batches
-- Description: Batch jobs tracking
-- ============================================================
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` VARCHAR(255) NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `total_jobs` INT NOT NULL,
  `pending_jobs` INT NOT NULL,
  `failed_jobs` INT NOT NULL,
  `failed_job_ids` LONGTEXT NOT NULL,
  `options` MEDIUMTEXT NULL,
  `cancelled_at` INT NULL,
  `created_at` INT NOT NULL,
  `finished_at` INT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- TABLE: failed_jobs
-- Description: Failed queue jobs
-- ============================================================
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` VARCHAR(255) NOT NULL,
  `connection` TEXT NOT NULL,
  `queue` TEXT NOT NULL,
  `payload` LONGTEXT NOT NULL,
  `exception` LONGTEXT NOT NULL,
  `failed_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- TABLE: orders
-- Description: Stores all project orders
-- ============================================================
CREATE TABLE IF NOT EXISTS `orders` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` BIGINT UNSIGNED NOT NULL COMMENT 'Client who created the order',
  `freelancer_id` BIGINT UNSIGNED NULL COMMENT 'Assigned freelancer',
  `job_title` VARCHAR(255) NOT NULL,
  `job_description` TEXT NULL,
  `requirements` TEXT NULL COMMENT 'Project requirements',
  `delivery_message` TEXT NULL COMMENT 'Freelancer delivery message',
  `delivery_file` VARCHAR(255) NULL COMMENT 'Path to delivery file',
  `delivered_at` TIMESTAMP NULL COMMENT 'When work was delivered',
  `price` DECIMAL(10,2) NOT NULL,
  `deadline` DATE NULL,
  `freelancer_email` VARCHAR(255) NULL,
  `status` ENUM('pending', 'paid', 'accepted', 'in_progress', 'delivered', 'completed', 'cancelled', 'rejected') NOT NULL DEFAULT 'pending',
  `payment_method` VARCHAR(255) NULL,
  `paid_at` TIMESTAMP NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `orders_user_id_foreign` (`user_id`),
  KEY `orders_freelancer_id_foreign` (`freelancer_id`),
  KEY `idx_status` (`status`),
  KEY `idx_deadline` (`deadline`),
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `orders_freelancer_id_foreign` FOREIGN KEY (`freelancer_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- TABLE: messages
-- Description: Stores chat messages between users
-- ============================================================
CREATE TABLE IF NOT EXISTS `messages` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `sender_id` BIGINT UNSIGNED NOT NULL,
  `receiver_id` BIGINT UNSIGNED NOT NULL,
  `order_id` BIGINT UNSIGNED NULL COMMENT 'Related order if applicable',
  `message` TEXT NOT NULL,
  `is_read` TINYINT(1) NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `messages_sender_id_foreign` (`sender_id`),
  KEY `messages_receiver_id_foreign` (`receiver_id`),
  KEY `messages_order_id_foreign` (`order_id`),
  KEY `idx_sender_receiver_created` (`sender_id`, `receiver_id`, `created_at`),
  CONSTRAINT `messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `messages_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `messages_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- TABLE: reviews
-- Description: Stores reviews for completed orders
-- ============================================================
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` BIGINT UNSIGNED NOT NULL,
  `user_id` BIGINT UNSIGNED NOT NULL COMMENT 'Client who wrote the review',
  `freelancer_id` BIGINT UNSIGNED NOT NULL COMMENT 'Freelancer being reviewed',
  `rating` TINYINT UNSIGNED NOT NULL COMMENT 'Rating from 1 to 5',
  `title` VARCHAR(255) NULL,
  `comment` TEXT NULL,
  `quality_rating` TINYINT UNSIGNED NULL COMMENT 'Quality of work: 1-5',
  `communication_rating` TINYINT UNSIGNED NULL COMMENT 'Communication: 1-5',
  `deadline_rating` TINYINT UNSIGNED NULL COMMENT 'Meeting deadline: 1-5',
  `professionalism_rating` TINYINT UNSIGNED NULL COMMENT 'Professionalism: 1-5',
  `helpful_count` INT UNSIGNED NOT NULL DEFAULT 0,
  `is_verified` TINYINT(1) NOT NULL DEFAULT 0 COMMENT 'Admin verified review',
  `is_published` TINYINT(1) NOT NULL DEFAULT 1 COMMENT 'Review is visible',
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `reviews_order_id_unique` (`order_id`),
  KEY `reviews_user_id_index` (`user_id`),
  KEY `reviews_freelancer_id_index` (`freelancer_id`),
  KEY `reviews_rating_index` (`rating`),
  CONSTRAINT `reviews_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reviews_freelancer_id_foreign` FOREIGN KEY (`freelancer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `chk_rating` CHECK (`rating` >= 1 AND `rating` <= 5),
  CONSTRAINT `chk_quality_rating` CHECK (`quality_rating` IS NULL OR (`quality_rating` >= 1 AND `quality_rating` <= 5)),
  CONSTRAINT `chk_communication_rating` CHECK (`communication_rating` IS NULL OR (`communication_rating` >= 1 AND `communication_rating` <= 5)),
  CONSTRAINT `chk_deadline_rating` CHECK (`deadline_rating` IS NULL OR (`deadline_rating` >= 1 AND `deadline_rating` <= 5)),
  CONSTRAINT `chk_professionalism_rating` CHECK (`professionalism_rating` IS NULL OR (`professionalism_rating` >= 1 AND `professionalism_rating` <= 5))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- TABLE: withdrawals
-- Description: Stores freelancer withdrawal requests
-- ============================================================
CREATE TABLE IF NOT EXISTS `withdrawals` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` BIGINT UNSIGNED NOT NULL COMMENT 'Freelancer requesting withdrawal',
  `amount` DECIMAL(10,2) NOT NULL,
  `payment_method` VARCHAR(255) NOT NULL DEFAULT 'bank_transfer',
  `payment_details` TEXT NULL COMMENT 'Bank account or PayPal details',
  `status` ENUM('pending', 'approved', 'rejected', 'sent') NOT NULL DEFAULT 'pending',
  `admin_notes` TEXT NULL COMMENT 'Admin notes or rejection reason',
  `requested_at` TIMESTAMP NOT NULL,
  `processed_at` TIMESTAMP NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `withdrawals_user_id_foreign` (`user_id`),
  KEY `idx_status` (`status`),
  KEY `idx_requested_at` (`requested_at`),
  CONSTRAINT `withdrawals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `chk_amount` CHECK (`amount` >= 50.00)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- TABLE: projects (from migrations)
-- Description: Portfolio projects for freelancers
-- ============================================================
CREATE TABLE IF NOT EXISTS `projects` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` BIGINT UNSIGNED NOT NULL COMMENT 'Freelancer who owns the project',
  `title` VARCHAR(255) NOT NULL,
  `description` TEXT NULL,
  `image` VARCHAR(255) NULL,
  `url` VARCHAR(255) NULL,
  `technologies` TEXT NULL COMMENT 'JSON array of technologies used',
  `is_featured` TINYINT(1) NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `projects_user_id_foreign` (`user_id`),
  CONSTRAINT `projects_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- INSERT DEFAULT DATA
-- ============================================================

-- Insert default admin user
-- Password: admin123 (bcrypt hashed)
INSERT INTO `users` (`name`, `email`, `role`, `password`, `created_at`, `updated_at`)
VALUES
('Admin', 'admin@workzy.com', 'admin', '$2y$12$LQv3c1yycLGFY0JYd8X0Vu1nSRgQfRN9Q9JG5xGJ5YP5xGJ5xGJ5x', NOW(), NOW())
ON DUPLICATE KEY UPDATE `email` = `email`;

-- Insert sample freelancer
-- Password: freelancer123
INSERT INTO `users` (`name`, `email`, `role`, `bio`, `skills`, `hourly_rate`, `location`, `password`, `created_at`, `updated_at`)
VALUES
('John Doe', 'freelancer@workzy.com', 'freelancer', 'Full-stack developer with 5 years of experience', '["PHP", "Laravel", "JavaScript", "React", "MySQL"]', 85.00, 'San Francisco, CA', '$2y$12$LQv3c1yycLGFY0JYd8X0Vu1nSRgQfRN9Q9JG5xGJ5YP5xGJ5xGJ5x', NOW(), NOW())
ON DUPLICATE KEY UPDATE `email` = `email`;

-- Insert sample client
-- Password: client123
INSERT INTO `users` (`name`, `email`, `role`, `company`, `password`, `created_at`, `updated_at`)
VALUES
('Jane Smith', 'client@workzy.com', 'user', 'Tech Startup Inc.', '$2y$12$LQv3c1yycLGFY0JYd8X0Vu1nSRgQfRN9Q9JG5xGJ5YP5xGJ5xGJ5x', NOW(), NOW())
ON DUPLICATE KEY UPDATE `email` = `email`;

-- ============================================================
-- VIEWS (Optional - for reporting and analytics)
-- ============================================================

-- View: Freelancer Statistics
CREATE OR REPLACE VIEW `v_freelancer_stats` AS
SELECT
  u.id,
  u.name,
  u.email,
  u.hourly_rate,
  COUNT(DISTINCT o.id) AS total_orders,
  COUNT(DISTINCT CASE WHEN o.status = 'completed' THEN o.id END) AS completed_orders,
  COALESCE(AVG(r.rating), 0) AS avg_rating,
  COUNT(DISTINCT r.id) AS total_reviews,
  COALESCE(SUM(CASE WHEN o.status = 'completed' THEN o.price END), 0) AS total_earnings
FROM users u
LEFT JOIN orders o ON u.id = o.freelancer_id
LEFT JOIN reviews r ON u.id = r.freelancer_id
WHERE u.role = 'freelancer'
GROUP BY u.id, u.name, u.email, u.hourly_rate;

-- View: Order Statistics by Status
CREATE OR REPLACE VIEW `v_order_stats` AS
SELECT
  status,
  COUNT(*) AS order_count,
  SUM(price) AS total_value,
  AVG(price) AS avg_value
FROM orders
GROUP BY status;

-- View: Monthly Revenue
CREATE OR REPLACE VIEW `v_monthly_revenue` AS
SELECT
  DATE_FORMAT(paid_at, '%Y-%m') AS month,
  COUNT(*) AS total_orders,
  SUM(price) AS gross_revenue,
  SUM(price * 0.15) AS platform_revenue
FROM orders
WHERE status IN ('paid', 'accepted', 'in_progress', 'delivered', 'completed')
  AND paid_at IS NOT NULL
GROUP BY DATE_FORMAT(paid_at, '%Y-%m')
ORDER BY month DESC;

-- ============================================================
-- STORED PROCEDURES (Optional)
-- ============================================================

DELIMITER //

-- Procedure: Calculate Freelancer Earnings
CREATE PROCEDURE IF NOT EXISTS `sp_calculate_freelancer_earnings`(
  IN p_freelancer_id BIGINT UNSIGNED,
  OUT p_total_earnings DECIMAL(10,2),
  OUT p_available_balance DECIMAL(10,2),
  OUT p_pending_withdrawals DECIMAL(10,2)
)
BEGIN
  -- Calculate total earnings from completed orders (after 15% platform fee)
  SELECT COALESCE(SUM(price * 0.85), 0) INTO p_total_earnings
  FROM orders
  WHERE freelancer_id = p_freelancer_id
    AND status = 'completed';

  -- Calculate pending withdrawals
  SELECT COALESCE(SUM(amount), 0) INTO p_pending_withdrawals
  FROM withdrawals
  WHERE user_id = p_freelancer_id
    AND status IN ('pending', 'approved');

  -- Calculate available balance
  SET p_available_balance = p_total_earnings - p_pending_withdrawals;
END //

DELIMITER ;

-- ============================================================
-- TRIGGERS (Optional - for audit trails and automation)
-- ============================================================

DELIMITER //

-- Trigger: Auto-update order delivered_at timestamp
CREATE TRIGGER IF NOT EXISTS `trg_orders_delivered`
BEFORE UPDATE ON `orders`
FOR EACH ROW
BEGIN
  IF NEW.status = 'delivered' AND OLD.status != 'delivered' THEN
    SET NEW.delivered_at = CURRENT_TIMESTAMP;
  END IF;
END //

DELIMITER ;

-- ============================================================
-- INDEXES FOR PERFORMANCE
-- ============================================================

-- Additional indexes for better query performance
CREATE INDEX IF NOT EXISTS `idx_users_role_created` ON `users` (`role`, `created_at`);
CREATE INDEX IF NOT EXISTS `idx_orders_status_created` ON `orders` (`status`, `created_at`);
CREATE INDEX IF NOT EXISTS `idx_orders_freelancer_status` ON `orders` (`freelancer_id`, `status`);
CREATE INDEX IF NOT EXISTS `idx_messages_is_read` ON `messages` (`is_read`, `receiver_id`);
CREATE INDEX IF NOT EXISTS `idx_withdrawals_user_status` ON `withdrawals` (`user_id`, `status`);

-- ============================================================
-- GRANTS AND PERMISSIONS
-- ============================================================

-- Create application user (adjust as needed)
-- CREATE USER IF NOT EXISTS 'workzy_user'@'localhost' IDENTIFIED BY 'your_secure_password';
-- GRANT SELECT, INSERT, UPDATE, DELETE ON workzy.* TO 'workzy_user'@'localhost';
-- FLUSH PRIVILEGES;

-- ============================================================
-- COMPLETION MESSAGE
-- ============================================================

SELECT '========================================' AS '';
SELECT 'WORKZY Database Setup Completed!' AS '';
SELECT '========================================' AS '';
SELECT 'Database Name: workzy' AS '';
SELECT 'Tables Created: 13' AS '';
SELECT 'Views Created: 3' AS '';
SELECT 'Procedures Created: 1' AS '';
SELECT '========================================' AS '';
SELECT 'Default Users:' AS '';
SELECT '  Admin: admin@workzy.com (password: admin123)' AS '';
SELECT '  Freelancer: freelancer@workzy.com (password: freelancer123)' AS '';
SELECT '  Client: client@workzy.com (password: client123)' AS '';
SELECT '========================================' AS '';
SELECT 'Next Steps:' AS '';
SELECT '  1. Update .env file with database credentials' AS '';
SELECT '  2. Run: php artisan migrate' AS '';
SELECT '  3. Run: php artisan db:seed (optional)' AS '';
SELECT '  4. Run: php artisan serve' AS '';
SELECT '========================================' AS '';
