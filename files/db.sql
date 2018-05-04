-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 04, 2018 at 07:41 PM
-- Server version: 5.5.47-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `opusdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `audios`
--

CREATE TABLE IF NOT EXISTS `audios` (
  `audio_id` int(11) NOT NULL AUTO_INCREMENT,
  `contract_id` int(11) NOT NULL COMMENT 'contrat id',
  `url` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`audio_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `audios`
--

INSERT INTO `audios` (`audio_id`, `contract_id`, `url`, `date`) VALUES
(4, 1, '1-SampleAudio_0.4mb.mp3', '2018-05-04 17:31:22'),
(5, 1, '1-SampleAudio_0.4mb.mp3', '2018-05-04 17:35:43');

-- --------------------------------------------------------

--
-- Table structure for table `contracts`
--

CREATE TABLE IF NOT EXISTS `contracts` (
  `contract_id` int(11) NOT NULL AUTO_INCREMENT,
  `contract_type` enum('electricity','gas') NOT NULL,
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
  PRIMARY KEY (`contract_id`),
  UNIQUE KEY `contract_id_2` (`contract_id`),
  KEY `contract_id` (`contract_id`),
  KEY `contract_id_3` (`contract_id`),
  KEY `contract_id_4` (`contract_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `contracts`
--

INSERT INTO `contracts` (`contract_id`, `contract_type`, `proposal_number`, `date`, `address`, `location`, `operator`, `status`, `cancellation_reason`, `gender`, `first_name`, `last_name`, `bussines_name`, `client_type`, `tel_number`, `alt_phone`, `cel_number`, `cel_number2`, `cel_number3`, `email`, `alt_email`, `nation`, `vat_number`, `birth_date`, `municipality`, `iban_code`, `iban_acountholder`, `iban_fiscal_code`, `payment`) VALUES
(1, 'electricity', '54345', '2018-01-11 16:50:28', 'dfgdfg', 'dfgdfg', 5, 3, 'werwer\r\n', 'male', 'Baftjaro', 'Rosi', 'werwer', 'personal', '35345345', '', '345345345', '34534535345', '', '', '', '', '', '0000-00-00', '', '345345', 0, 0, 'postal'),
(2, 'gas', '54345', '2018-04-30 15:50:28', 'dfgdfg', 'dfgdfg', 5, 3, 'werwer\r\n', 'male', 'Antonio', 'Vladi', 'werwer', 'personal', '35345345', '', '345345345', '34534535345', '', '', '', '', '', '0000-00-00', '', '345345', 0, 0, 'postal'),
(3, 'electricity', '54345', '2018-04-11 15:50:28', 'dfgdfg', 'dfgdfg', 2, 3, 'werwer\r\n', 'male', 'Emanuele', 'Basha', 'werwer', 'personal', '35345345', '', '345345345', '34534535345', '', '', '', '', '', '0000-00-00', '', '345345', 0, 0, 'postal'),
(4, 'electricity', '54345', '2018-04-30 15:50:28', 'dfgdfg', 'dfgdfg', 2, 3, 'werwer\r\n', 'male', 'Emanuele', 'Basha', 'werwer', 'personal', '35345345', '', '345345345', '34534535345', '', '', '', '', '', '0000-00-00', '', '345345', 0, 0, 'postal'),
(5, 'electricity', '54345', '2018-05-02 15:50:28', 'dfgdfg', 'dfgdfg', 2, 3, 'werwer\r\n', 'male', 'Emanuele', 'Basha', 'werwer', 'personal', '35345345', '', '345345345', '34534535345', '', '', '', '', '', '0000-00-00', '', '345345', 0, 0, 'postal'),
(6, 'gas', '54345', '2018-04-30 15:50:28', 'dfgdfg', 'dfgdfg', 12, 3, 'werwer\r\n', 'male', 'Antonio', 'Vladi', 'werwer', 'personal', '35345345', '', '345345345', '34534535345', '', '', '', '', '', '0000-00-00', '', '345345', 0, 0, 'postal'),
(7, 'gas', '54345', '2017-08-02 15:50:28', 'dfgdfg', 'dfgdfg', 5, 3, 'werwer\r\n', 'male', 'Antonio', 'Vladi', 'werwer', 'personal', '35345345', '', '345345345', '34534535345', '', '', '', '', '', '0000-00-00', '', '345345', 0, 0, 'postal'),
(8, 'electricity', '54345', '2018-01-18 16:50:28', 'dfgdfg', 'dfgdfg', 1, 3, 'werwer\r\n', 'male', 'Emanuele', 'Basha', 'werwer', 'personal', '35345345', '', '345345345', '34534535345', '', '', '', '', '', '0000-00-00', '', '345345', 0, 0, 'postal');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE IF NOT EXISTS `documents` (
  `document_id` int(11) NOT NULL AUTO_INCREMENT,
  `contract_id` int(11) NOT NULL,
  `url` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`document_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`document_id`, `contract_id`, `url`, `date`) VALUES
(14, 3, '3-44296-analyze-&-attack-ssh-protocol.pdf', '0000-00-00 00:00:00'),
(15, 3, '3-crm.docx', '0000-00-00 00:00:00'),
(16, 3, '3-1.PDF', '0000-00-00 00:00:00'),
(17, 3, '3-1.PDF', '0000-00-00 00:00:00'),
(18, 3, '3-1_7.doc', '0000-00-00 00:00:00'),
(19, 3, '3-1.PDF', '0000-00-00 00:00:00'),
(20, 3, '3-simplemaps-worldcities-basic.csv', '0000-00-00 00:00:00'),
(21, 3, '3-simplemaps-worldcities-basic.csv', '0000-00-00 00:00:00'),
(22, 3, '3-simplemaps-worldcities-basic.csv', '0000-00-00 00:00:00'),
(23, 3, '3-states.txt', '0000-00-00 00:00:00');

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
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `role` enum('operator','supervisor','backoffice','admin') NOT NULL DEFAULT 'operator',
  PRIMARY KEY (`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `first_name`, `last_name`, `role`) VALUES
(1, 'testadmin12', 'paswwordi', 'Adalen', 'Test', 'operator'),
(5, 'testadmin12', 'paswwordi', 'user', 'Test', 'operator'),
(6, 'testadmin12', 'paswwordi', 'test', 'Test', 'operator'),
(12, 'testadmin12', 'paswwordi', 'user', 'Test', 'operator');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
