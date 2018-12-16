-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2018 at 05:41 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movies_api`
--

-- --------------------------------------------------------

--
-- Table structure for table `actors`
--

CREATE TABLE `actors` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `movie_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `actors`
--

INSERT INTO `actors` (`id`, `name`, `movie_id`) VALUES
(6, 'mahmoud gamal', 6),
(7, 'mahmoud gamal', 7),
(9, 'mahmoud gamal', 9),
(10, 'mahmoud gamal', 10),
(11, 'mahmoud gamal', 11),
(12, 'mahmoud gamal', 12),
(13, 'mahmoud gamal', 13),
(14, 'mahmoud gamal', 14),
(15, 'mahmoud gamal', 15),
(16, 'mahmoud gamal', 16),
(17, 'mahmoud gamal', 5);

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `name`) VALUES
(1, 'action'),
(2, 'action'),
(3, 'action'),
(4, 'action'),
(5, 'action'),
(6, 'action'),
(7, 'action'),
(8, 'action'),
(9, 'action'),
(10, 'action'),
(11, 'action'),
(12, 'action'),
(13, 'action'),
(14, 'action'),
(15, 'action'),
(16, 'action'),
(17, 'action');

-- --------------------------------------------------------

--
-- Table structure for table `genre_movie`
--

CREATE TABLE `genre_movie` (
  `id` int(10) UNSIGNED NOT NULL,
  `movie_id` int(10) UNSIGNED NOT NULL,
  `genre_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `genre_movie`
--

INSERT INTO `genre_movie` (`id`, `movie_id`, `genre_id`) VALUES
(6, 6, 6),
(7, 7, 7),
(9, 9, 9),
(10, 10, 10),
(11, 11, 11),
(12, 12, 12),
(13, 13, 13),
(14, 14, 14),
(15, 15, 15),
(16, 16, 16),
(17, 5, 17);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_12_15_131717_create_movies_table', 1),
(4, '2018_12_15_131729_create_actors_table', 1),
(5, '2018_12_15_132756_create_genres_table', 1),
(6, '2018_12_15_133539_create_movies_genres_table', 1),
(7, '2018_12_16_103611_create_user_movie_rating', 1);

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` double(4,2) NOT NULL DEFAULT '0.00',
  `release_year` int(11) NOT NULL,
  `gross_profit` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `director` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `title`, `description`, `image_url`, `rating`, `release_year`, `gross_profit`, `director`, `created_at`, `updated_at`) VALUES
(5, 'of thrones', 'testtesttesttesttesttesttesttest', 'https://www.layoutit.com/img/people-q-c-600-200-1.jpg', 2.00, 2014, '2555000000M', 'mahmoud', '2018-12-16 14:12:18', '2018-12-16 14:31:38'),
(6, 'Game of thrones', 'testtesttesttesttesttesttesttest', 'https://www.layoutit.com/img/people-q-c-600-200-1.jpg', 0.00, 2014, '2555000000M', 'mahmoud', '2018-12-16 14:12:19', '2018-12-16 14:12:19'),
(7, 'Game of thrones', 'testtesttesttesttesttesttesttest', 'https://www.layoutit.com/img/people-q-c-600-200-1.jpg', 0.00, 2014, '2555000000M', 'mahmoud', '2018-12-16 14:12:20', '2018-12-16 14:12:20'),
(9, 'Game of thrones', 'testtesttesttesttesttesttesttest', 'https=>//www.layoutit.com/img/people-q-c-600-200-1.jpg', 0.00, 2014, '2555000000M', 'mahmoud', '2018-12-16 14:26:43', '2018-12-16 14:26:43'),
(10, 'Gamse of thrones', 'testtesttesttesttesttesttesttest', 'https=>//www.layoutit.com/img/people-q-c-600-200-1.jpg', 0.00, 2014, '2555000000M', 'mahmoud', '2018-12-16 14:27:18', '2018-12-16 14:27:18'),
(11, 'Gamsess of thrones', 'testtesttesttesttesttesttesttest', 'https=>//www.layoutit.com/img/people-q-c-600-200-1.jpg', 0.00, 2014, '2555000000M', 'mahmoud', '2018-12-16 14:28:09', '2018-12-16 14:28:09'),
(12, 'Gamsess of thrones', 'testtesttesttesttesttesttesttest', 'https=>//www.layoutit.com/img/people-q-c-600-200-1.jpg', 0.00, 2014, '2555000000M', 'mahmoud', '2018-12-16 14:28:17', '2018-12-16 14:28:17'),
(13, 'Gamsess of thrones', 'testtesttesttesttesttesttesttest', 'https=>//www.layoutit.com/img/people-q-c-600-200-1.jpg', 0.00, 2014, '2555000000M', 'mahmoud', '2018-12-16 14:28:25', '2018-12-16 14:28:25'),
(14, 'Gamsess of thrones', 'testtesttesttesttesttesttesttest', 'https://www.layoutit.com/img/people-q-c-600-200-1.jpg', 0.00, 2014, '2555000000M', 'mahmoud', '2018-12-16 14:29:30', '2018-12-16 14:29:30'),
(15, 'Gamsess of thrones', 'testtesttesttesttesttesttesttest', 'https://www.layoutit.com/img/people-q-c-600-200-1.jpg', 0.00, 2014, '2555000000M', 'mahmoud', '2018-12-16 14:29:39', '2018-12-16 14:29:39'),
(16, 'Gamsess of thrones', 'testtesttesttesttesttesttesttest', 'https://www.layoutit.com/img/people-q-c-600-200-1.jpg', 0.00, 2014, '2555000000M', 'mahmoud', '2018-12-16 14:31:37', '2018-12-16 14:31:37');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'mahmoudafifi', 'mahmoudafifi460@gmail.com', NULL, '$2y$10$A75Sixz4FJzArHwRVjHqQuTLCpzSzB4xj4jy1LhunO1U10ViN/Mbu', NULL, '2018-12-16 14:20:20', '2018-12-16 14:20:20');

-- --------------------------------------------------------

--
-- Table structure for table `user_movie_rating`
--

CREATE TABLE `user_movie_rating` (
  `id` int(10) UNSIGNED NOT NULL,
  `rating_number` int(11) NOT NULL,
  `movie_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_movie_rating`
--

INSERT INTO `user_movie_rating` (`id`, `rating_number`, `movie_id`, `user_id`) VALUES
(14, 2, 5, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actors`
--
ALTER TABLE `actors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `actors_movie_id_foreign` (`movie_id`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genre_movie`
--
ALTER TABLE `genre_movie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `genre_movie_movie_id_foreign` (`movie_id`),
  ADD KEY `genre_movie_genre_id_foreign` (`genre_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_movie_rating`
--
ALTER TABLE `user_movie_rating`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_movie_rating_movie_id_foreign` (`movie_id`),
  ADD KEY `user_movie_rating_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actors`
--
ALTER TABLE `actors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `genre_movie`
--
ALTER TABLE `genre_movie`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_movie_rating`
--
ALTER TABLE `user_movie_rating`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `actors`
--
ALTER TABLE `actors`
  ADD CONSTRAINT `actors_movie_id_foreign` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `genre_movie`
--
ALTER TABLE `genre_movie`
  ADD CONSTRAINT `genre_movie_genre_id_foreign` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `genre_movie_movie_id_foreign` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_movie_rating`
--
ALTER TABLE `user_movie_rating`
  ADD CONSTRAINT `user_movie_rating_movie_id_foreign` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_movie_rating_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
