-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               11.8.2-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.10.0.7000
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for eiei
CREATE DATABASE IF NOT EXISTS `eiei` /*!40100 DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci */;
USE `eiei`;

-- Dumping structure for table eiei.episodes
CREATE TABLE IF NOT EXISTS `episodes` (
  `id` char(36) NOT NULL,
  `series_id` char(36) NOT NULL,
  `season_number` int(11) NOT NULL,
  `episode_number` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_episodes_series` (`series_id`),
  CONSTRAINT `fk_episodes_series` FOREIGN KEY (`series_id`) REFERENCES `series` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- Dumping data for table eiei.episodes: ~0 rows (approximately)

-- Dumping structure for table eiei.favorites
CREATE TABLE IF NOT EXISTS `favorites` (
  `id` char(36) NOT NULL,
  `profile_id` char(36) NOT NULL,
  `movie_id` char(36) DEFAULT NULL,
  `episode_id` char(36) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_favorites_profile` (`profile_id`),
  KEY `fk_favorites_movie` (`movie_id`),
  KEY `fk_favorites_episode` (`episode_id`),
  CONSTRAINT `fk_favorites_episode` FOREIGN KEY (`episode_id`) REFERENCES `episodes` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_favorites_movie` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_favorites_profile` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- Dumping data for table eiei.favorites: ~0 rows (approximately)

-- Dumping structure for table eiei.movies
CREATE TABLE IF NOT EXISTS `movies` (
  `id` char(36) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `genre` varchar(100) DEFAULT NULL,
  `release_year` int(11) DEFAULT NULL,
  `images` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- Dumping data for table eiei.movies: ~1 rows (approximately)
REPLACE INTO `movies` (`id`, `title`, `description`, `genre`, `release_year`, `images`, `video_url`, `created_at`) VALUES
	('iintdotdev', 'Wednesday', 'eiei', 'eiei', 2006, '["wednesday.jpg", "cc.png"]', 'content/abc1.mp4', '2025-07-24 00:08:05');

-- Dumping structure for table eiei.profiles
CREATE TABLE IF NOT EXISTS `profiles` (
  `id` char(36) NOT NULL,
  `user_id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `avatar_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_profiles_user` (`user_id`),
  CONSTRAINT `fk_profiles_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- Dumping data for table eiei.profiles: ~0 rows (approximately)

-- Dumping structure for table eiei.series
CREATE TABLE IF NOT EXISTS `series` (
  `id` char(36) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `genre` varchar(100) DEFAULT NULL,
  `release_year` int(11) DEFAULT NULL,
  `poster_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- Dumping data for table eiei.series: ~0 rows (approximately)

-- Dumping structure for table eiei.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` char(36) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` enum('USER','ADMIN') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- Dumping data for table eiei.users: ~0 rows (approximately)

-- Dumping structure for table eiei.watch_history
CREATE TABLE IF NOT EXISTS `watch_history` (
  `id` char(36) NOT NULL,
  `profile_id` char(36) NOT NULL,
  `movie_id` char(36) DEFAULT NULL,
  `episode_id` char(36) DEFAULT NULL,
  `watched_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `progress` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_watch_profile` (`profile_id`),
  KEY `fk_watch_movie` (`movie_id`),
  KEY `fk_watch_episode` (`episode_id`),
  CONSTRAINT `fk_watch_episode` FOREIGN KEY (`episode_id`) REFERENCES `episodes` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_watch_movie` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_watch_profile` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- Dumping data for table eiei.watch_history: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
