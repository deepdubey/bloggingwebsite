-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 23, 2021 at 01:26 PM
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
-- Table structure for table `blogcreated`
--

DROP TABLE IF EXISTS `blogcreated`;
CREATE TABLE IF NOT EXISTS `blogcreated` (
  `id` varchar(13) NOT NULL,
  `title` varchar(150) NOT NULL,
  `image` varchar(250) DEFAULT NULL,
  `textarea` longtext,
  `author` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blogcreated`
--

INSERT INTO `blogcreated` (`id`, `title`, `image`, `textarea`, `author`) VALUES
('6059cd27134d8', 'Php', '6059cd27134d8.jpeg', 'djsds', 'deepdubey989@gmail.com'),
('6059cdce588a0', 'Destructuring Props in react', '6059cdce588a0.jpeg', 'Destructuring', 'deepdubey989@gmail.com'),
('6059de58b411e', 'React Native', '6059de58b411e.jpeg', 'React Native is like React, but it uses native components instead of web components as building blocks. So to understand the basic structure of a React Native app, you need to understand some of the basic React concepts, like JSX, components, state, and props. If you already know React, you still need to learn some React-Native-specific stuff, like the native components. This tutorial is aimed at all audiences, whether you have React experience or not.\r\n\r\nLets begin.', 'xyz@gmail.com'),
('6059df1d364c3', 'Javascript', '6059df1d364c3.jpeg', 'JavaScript, often abbreviated as JS, is a programming language that conforms to the ECMAScript specification. JavaScript is high-level, often just-in-time compiled, and multi-paradigm. It has curly-bracket syntax, dynamic typing, prototype-based object-orientation, and first-class functions.', 'xyz@gmail.com');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
