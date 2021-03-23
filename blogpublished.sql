-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 23, 2021 at 01:28 PM
-- Server version: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogpublished`
--

DROP TABLE IF EXISTS `blogpublished`;
CREATE TABLE IF NOT EXISTS `blogpublished` (
  `id` varchar(13) NOT NULL,
  `publish_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`,`publish_date`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blogpublished`
--

INSERT INTO `blogpublished` (`id`, `publish_date`) VALUES
('6059c92cc2174', '2021-03-23 10:57:58'),
('6059cc6aea622', '2021-03-23 11:12:36'),
('6059cd27134d8', '2021-03-23 11:14:42'),
('6059cdce588a0', '2021-03-23 11:16:13'),
('6059ce100097b', '2021-03-23 11:17:10'),
('6059ce466793e', '2021-03-23 11:17:54'),
('6059de58b411e', '2021-03-23 12:28:09'),
('6059df1d364c3', '2021-03-23 12:31:11');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
