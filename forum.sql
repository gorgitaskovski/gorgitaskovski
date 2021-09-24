-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 01, 2020 at 01:28 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
CREATE TABLE IF NOT EXISTS `accounts` (
  `account_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`account_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`account_id`, `username`, `password`) VALUES
(1, 'Nikola Gruevski', 'Nikola Gruevski'),
(2, 'Zoran Paljo', 'Zoran Paljo');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_content` text COLLATE utf8_unicode_ci NOT NULL,
  `account_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  PRIMARY KEY (`post_id`),
  KEY `fk_post_account_id` (`account_id`),
  KEY `fk_post_topic_id` (`topic_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_content`, `account_id`, `topic_id`) VALUES
(2, 'jak komentar', 2, 2),
(3, 'pazar3', 1, 3),
(4, 'komentar', 1, 1),
(5, 'muabet', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

DROP TABLE IF EXISTS `topics`;
CREATE TABLE IF NOT EXISTS `topics` (
  `topic_id` int(11) NOT NULL AUTO_INCREMENT,
  `topic_name` text COLLATE utf8_unicode_ci NOT NULL,
  `account_id` int(11) NOT NULL,
  PRIMARY KEY (`topic_id`),
  KEY `fk_topic_account_id` (`account_id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`topic_id`, `topic_name`, `account_id`) VALUES
(1, 'PHP', 1),
(2, 'HTML', 1),
(3, 'CSS', 1),
(4, 'Java', 2),
(5, 'JavaScript', 1),
(6, 'HelloWorld', 2),
(7, 'HelloWorld2', 2),
(8, 'HelloWorld3', 1),
(9, 'HelloWorld4', 2),
(10, 'HelloWorld5', 2),
(11, 'HelloWorld6', 2),
(12, 'HelloWorld7', 1),
(13, 'HelloWorld8', 1),
(14, 'SQL', 1),
(16, 'Nevazna Tema', 2),
(17, 'Dosadna Tema', 1),
(18, 'Interesna Tema', 1),
(19, 'Jaka Tema', 1),
(20, 'Nekoja Tema Sinkir', 2),
(21, 'Nekoja Tema Demek', 1),
(22, 'Nekoja Tema', 1),
(23, 'nemuabet', 1),
(24, 'camce muabet', 1),
(25, 'Muabet', 1),
(28, 'HelloWorld9', 1),
(47, 'muabet', 1),
(48, 'fitness paljo welcome to the jungle', 2),
(49, 'prodavam staro zelezo', 2),
(56, 'pazar3', 2),
(57, 'nz', 2),
(60, 'Vazna Tema', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `fk_post_account_id` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`),
  ADD CONSTRAINT `fk_post_topic_id` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`topic_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `fk_topic_account_id` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
