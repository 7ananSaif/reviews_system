-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2024 at 12:25 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reviews_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments_reviews_ratings`
--

CREATE TABLE `comments_reviews_ratings` (
  `id` int(11) NOT NULL,
  `comment` text DEFAULT NULL,
  `review` text DEFAULT NULL,
  `rating` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'datetime',
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL COMMENT 'user',
  `item_id` int(11) NOT NULL COMMENT 'id of item'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments_reviews_ratings`
--

INSERT INTO `comments_reviews_ratings` (`id`, `comment`, `review`, `rating`, `created_at`, `updated_at`, `user_id`, `item_id`) VALUES
(3, '33', '343', '', '2024-08-26 09:56:22', '2024-08-26 08:56:22', 2, 1),
(4, '23', '32', '', '2024-08-26 10:15:29', '2024-08-26 09:15:29', 123, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments_reviews_ratings`
--
ALTER TABLE `comments_reviews_ratings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments_reviews_ratings`
--
ALTER TABLE `comments_reviews_ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
