-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 11, 2010 at 08:31 AM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `phpsols`
--

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `image_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `filename` varchar(25) NOT NULL,
  `caption` varchar(120) NOT NULL,
  PRIMARY KEY (`image_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`image_id`, `filename`, `caption`) VALUES
(1, 'basin.jpg', 'Water basin at Ryoanji temple, Kyoto'),
(2, 'fountains.jpg', 'Fountains in central Tokyo'),
(3, 'kinkakuji.jpg', 'The Golden Pavilion in Kyoto'),
(4, 'maiko.jpg', 'Maiko&#8212;trainee geishas in Kyoto'),
(5, 'maiko_phone.jpg', 'Every maiko should have one&#8212;a mobile, of course'),
(6, 'menu.jpg', 'Menu outside restaurant in Pontocho, Kyoto'),
(7, 'monk.jpg', 'Monk begging for alms in Kyoto'),
(8, 'ryoanji.jpg', 'Autumn leaves at Ryoanji temple, Kyoto');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
