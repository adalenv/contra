-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 27, 2018 at 06:03 PM
-- Server version: 5.5.47-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `contra`
--

-- --------------------------------------------------------

--
-- Table structure for table `audio_files`
--

CREATE TABLE IF NOT EXISTS `audio_files` (
  `audio_id` int(11) NOT NULL AUTO_INCREMENT,
  `contract_id` int(11) NOT NULL COMMENT 'contrat id',
  `url` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`audio_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `contracts`
--

CREATE TABLE IF NOT EXISTS `contracts` (
  `contract_id` int(11) NOT NULL AUTO_INCREMENT,
  `contract_type` text NOT NULL,
  `proposal_number` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `address` text NOT NULL,
  `location` varchar(100) NOT NULL,
  `operator` int(11) NOT NULL COMMENT 'user id',
  `status` int(11) NOT NULL COMMENT 'status id',
  `cancellation_reason` varchar(100) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `bussines_name` varchar(50) NOT NULL,
  `client_type` enum('personal') NOT NULL,
  `tel_number` varchar(30) NOT NULL,
  `alt_phone` varchar(30) NOT NULL,
  `cel_number` varchar(30) NOT NULL,
  `cel_number2` varchar(30) NOT NULL,
  `cel_number3` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `alt_email` varchar(50) NOT NULL,
  `nation` varchar(50) NOT NULL,
  `vat_number` varchar(50) NOT NULL,
  `birth_date` date NOT NULL,
  `municipality` varchar(50) NOT NULL,
  `iban_code` varchar(50) NOT NULL,
  `iban_acountholder` int(50) NOT NULL,
  `iban_fiscal_code` int(50) NOT NULL,
  `payment` enum('postal','cc') NOT NULL,
  PRIMARY KEY (`contract_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE IF NOT EXISTS `notes` (
  `note_id` int(11) NOT NULL AUTO_INCREMENT,
  `contract_id` int(11) NOT NULL COMMENT 'contract id',
  `user_id` int(11) NOT NULL COMMENT 'user id',
  `text` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`note_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `full_name` text NOT NULL,
  `role` enum('operator','supervisor','backoffice','admin') NOT NULL DEFAULT 'operator',
  PRIMARY KEY (`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

