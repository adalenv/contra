-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2018 at 07:05 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `opus`
--

-- --------------------------------------------------------

--
-- Table structure for table `audios`
--

CREATE TABLE `audios` (
  `audio_id` int(11) NOT NULL,
  `contract_id` int(11) NOT NULL COMMENT 'contrat id',
  `url` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `audios`
--

INSERT INTO `audios` (`audio_id`, `contract_id`, `url`, `date`) VALUES
(4, 1, '1-SampleAudio_0.4mb.mp3', '2018-05-04 17:31:22'),
(5, 1, '1-SampleAudio_0.4mb.mp3', '2018-05-04 17:35:43'),
(6, 2, '2-dfgdfgdfdfgdfg.mp3', '2010-04-20 23:27:29'),
(7, 2, '2-file915.mp3', '2010-04-20 23:57:40');

-- --------------------------------------------------------

--
-- Table structure for table `contracts`
--

CREATE TABLE `contracts` (
  `contract_id` int(11) NOT NULL,
  `contract_type` enum('electricity','gas','dual') NOT NULL,
  `proposal_number` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `ugm_cb` enum('true','false') NOT NULL DEFAULT 'false',
  `analisi_cb` enum('true','false') NOT NULL DEFAULT 'false',
  `iniziative_cb` enum('true','false') NOT NULL DEFAULT 'false',
  `toponimo` enum('via') NOT NULL,
  `address` text NOT NULL,
  `civico` varchar(30) NOT NULL,
  `price` varchar(50) NOT NULL,
  `location` varchar(100) NOT NULL,
  `ubicazione_fornitura` enum('resident','non_resident') NOT NULL,
  `domicillazione_documenti_fatture` enum('residenza','ubicazione_fornitura','altro') NOT NULL,
  `listino` varchar(50) NOT NULL,
  `richiede_gas_naturale` enum('true','false') NOT NULL,
  `request_type` varchar(50) NOT NULL,
  `pdr` varchar(50) NOT NULL,
  `fornitore_uscente` varchar(50) NOT NULL,
  `consume_annuo` varchar(50) NOT NULL,
  `tipo_riscaldamento` enum('true','false') NOT NULL,
  `tipo_cottura_acqua` enum('true','false') NOT NULL,
  `fature_via_email` enum('true','false') NOT NULL,
  `operator` int(11) NOT NULL COMMENT 'user id',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT 'status id',
  `cancellation_reason` varchar(100) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `rag_sociale` text NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `bussines_name` varchar(50) NOT NULL,
  `client_type` enum('personal') NOT NULL,
  `tel_number` varchar(30) NOT NULL,
  `alt_number` varchar(30) NOT NULL,
  `cel_number` varchar(30) NOT NULL,
  `cel_number2` varchar(30) NOT NULL,
  `cel_number3` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `alt_email` varchar(50) NOT NULL,
  `birth_nation` varchar(50) NOT NULL,
  `vat_number` varchar(50) NOT NULL,
  `partita_iva` varchar(50) NOT NULL,
  `birth_date` date NOT NULL,
  `birth_municipality` varchar(50) NOT NULL,
  `document_type` enum('id_card','passport') NOT NULL,
  `document_number` varchar(100) NOT NULL,
  `document_date` date NOT NULL,
  `iban_code` varchar(50) NOT NULL,
  `iban_accounthoder` varchar(50) NOT NULL,
  `iban_fiscal_code` varchar(50) NOT NULL,
  `payment_type` enum('postal','cc') NOT NULL,
  `note` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contracts`
--

INSERT INTO `contracts` (`contract_id`, `contract_type`, `proposal_number`, `date`, `ugm_cb`, `analisi_cb`, `iniziative_cb`, `toponimo`, `address`, `civico`, `price`, `location`, `ubicazione_fornitura`, `domicillazione_documenti_fatture`, `listino`, `richiede_gas_naturale`, `request_type`, `pdr`, `fornitore_uscente`, `consume_annuo`, `tipo_riscaldamento`, `tipo_cottura_acqua`, `fature_via_email`, `operator`, `status`, `cancellation_reason`, `gender`, `rag_sociale`, `first_name`, `last_name`, `bussines_name`, `client_type`, `tel_number`, `alt_number`, `cel_number`, `cel_number2`, `cel_number3`, `email`, `alt_email`, `birth_nation`, `vat_number`, `partita_iva`, `birth_date`, `birth_municipality`, `document_type`, `document_number`, `document_date`, `iban_code`, `iban_accounthoder`, `iban_fiscal_code`, `payment_type`, `note`) VALUES
(16, 'dual', '', '2010-04-21', 'true', 'true', 'false', 'via', 'sfsf', '34', '', '3434', 'resident', 'residenza', 'FIX12 TS', 'false', 'SW1 - SWITCH', '', '', '', 'false', 'false', 'false', 5, 1, '', 'male', 'ertertert', 'ert', 'ert', '', 'personal', 'ert', '', 'er', '', '', 'tetertertertet@fsdf', '', 'e', 'ert', '', '2010-04-21', 'rte', 'id_card', 't', '2010-04-21', '', '0', '0', 'postal', ''),
(17, 'dual', '', '2010-04-21', 'false', 'false', 'false', 'via', 'sdf', '45', '', '545', 'resident', 'residenza', 'FIX12 TS', 'false', 'SW1 - SWITCH', '', '', '', 'false', 'false', 'false', 12, 1, '', 'female', 'wrewe', 'er', 'ewr', '', 'personal', 'wer', '', 'we', '', '', 'rwerwer@sdf', '', 'rw', 'e', '', '2010-04-21', 'er', 'passport', 'wer', '2010-04-21', '', '0', '0', 'postal', ''),
(18, 'electricity', '', '2010-04-12', 'true', 'true', 'true', 'via', 'retger gdfgdfgdf ', '4545', 'ererwer', 'wer345345', 'non_resident', 'altro', 'FIX12 TS', 'true', 'SW1 - SWITCH', 'fer', '345', 'gdfgdfg', 'true', 'false', 'true', 12, 2, '', 'female', '1cfdf ', 'Adlan', 'Vlllaer', '', 'personal', '25142514141251', '52353', '5243', '53563', '636', 'ASDASD@ASDAS.ASD', 'ASDASD@ASDAS.ASD', 'albania', '2334sdfsdf3', '122', '1994-10-08', 'tirane', 'passport', '212313213fdgfd', '2010-04-23', 'fsdfsdf', 'sdfsdf', 'sdfsdf', 'cc', 'sf f sdf sf\r\nsdf\r\nsd\r\nf\r\nsd\r\nfs\r\ndf'),
(19, 'dual', '', '2018-05-15', 'false', 'false', 'false', 'via', 'sdfs', '34', '', '3fgdfg', 'resident', 'residenza', 'FIX12 TS', 'false', 'SW1 - SWITCH', '', '', '', 'false', 'false', 'false', 6, 1, '', 'male', '', 'frwe', 'r', '', 'personal', 'wer', '', 'w', '', '', 'erwer@dfsdf', '', 'wer', 'wer', '', '2018-05-15', 'we', 'id_card', 'r', '2018-05-15', '', '', '', 'postal', ''),
(20, 'dual', '', '2018-05-16', 'false', 'false', 'false', 'via', 'dsf', '45', '', '45', 'resident', 'residenza', 'FIX12 TS', 'false', 'SW1 - SWITCH', '', '', '', 'false', 'false', 'false', 6, 1, '', 'male', '', 'sdf', 'sdf', '', 'personal', 'sd', '', 'f', '', '', 'sdfsdfsdfsdf@sdf', '', 'sd', 'sdf', '', '2018-05-16', 'fsdf', 'id_card', 'sdf', '2018-05-16', '', '', '', 'postal', ''),
(21, 'dual', '', '2018-05-16', 'true', 'false', 'true', 'via', 'sdfsdf', '3434', 'sdf', 'sdf', 'non_resident', 'altro', 'FIX12 TS', 'true', 'SW1 - SWITCH', 'fs', 'sdfsd', 'fsdf', 'false', 'true', 'true', 12, 1, '', 'female', 'sdf', 'fedfdf', 'fdf', '', '', '324234234', 'dsf', 'frwer324', '34343423', 'sdfsdfsdfsdf', '34dfsdf@sdfdsf', 'sdfsdf@dasdasd.dfgdfg', 'df', 'fdf', 'ffdf', '2018-05-16', 'fdf', 'passport', 'sdfsdfsdfsdf', '2018-05-16', 'gdfgdfgdfgdfgdfg', 'dfgdf', 'dfg', 'cc', 'reterte'),
(22, 'dual', '', '2018-05-16', 'true', 'false', 'true', 'via', 'asdasd', '3', '', '3', 'resident', 'residenza', 'FIX12 TS', 'false', 'SW1 - SWITCH', '', '', '', 'false', 'false', 'false', 6, 3, '', 'female', 'sdf', 'asd', 'asdas', '', 'personal', 'asd', '', 'asd', '', '', 'asdasdwwww@sdsdsdds', '', 'as', 'asd', '', '2018-05-16', 'da', 'id_card', 'sd', '2018-05-16', '', '', '', 'postal', ''),
(23, 'dual', '', '2018-05-16', 'false', 'false', 'true', 'via', 'werw', '234', '', '23423', 'resident', 'residenza', 'FIX12 TS', 'false', 'SW1 - SWITCH', '', '', '', 'false', 'false', 'false', 6, 1, '', 'male', 'wer', 'rerwer', 'rer', '', 'personal', 'er', '', 'wer', '', '', 'werwerwer@rewrwer', '', 'wer', 'wer', '', '2018-05-16', 'wer', 'id_card', 'w', '2018-05-16', '', '', '', 'postal', ''),
(24, 'dual', '', '2018-05-16', 'false', 'false', 'true', 'via', 'wer', '345', '', 'wrwer', 'resident', 'residenza', 'FIX12 TS', 'false', 'SW1 - SWITCH', '', '', '', 'false', 'false', 'false', 6, 1, '', 'male', 'sdf', 'sdf', 'sd', '', 'personal', 'sdf', '', 's', '', '', 'dfsdf@sdfsdf.sdffdf', '', 'sdf', 'f', '', '2018-05-16', 's', 'id_card', 'df', '2018-05-16', '', '', '', 'postal', ''),
(25, 'dual', '', '2018-05-16', 'false', 'false', 'false', 'via', 'sdfs', '45345', '', 'dfgdfgdfg', 'resident', 'residenza', 'FIX12 TS', 'false', 'SW1 - SWITCH', '', '', '', 'false', 'false', 'false', 5, 1, '', 'male', 'dfg', 'sdf', 'sdf', '', 'personal', 'f', '', 'sd', '', '', 'fdsfsdfsdf@dfsdf.sdfsdf', '', 's', 'sf', '', '2018-05-16', 'df', 'id_card', 'sd', '2018-05-16', '', '', '', 'postal', ''),
(26, 'dual', '', '2018-05-16', 'false', 'false', 'false', 'via', 'sdfs', '45345', '', 'dfgdfgdfg', 'resident', 'residenza', 'FIX12 TS', 'false', 'SW1 - SWITCH', '', '', '', 'false', 'false', 'false', 5, 1, '', 'male', 'dfg', 'sdf', 'sdf', '', 'personal', 'f', '', 'sd', '', '', 'fdsfsdfsdf@dfsdf.sdfsdf', '', 's', 'sf', '', '2018-05-16', 'df', 'id_card', 'sd', '2018-05-16', '', '', '', 'postal', ''),
(27, 'dual', '', '2018-05-16', 'false', 'false', 'false', 'via', 'sdfsd', '34', '', 'sdfsdf', 'resident', 'residenza', 'FIX12 TS', 'false', 'SW1 - SWITCH', '', '', '', 'false', 'false', 'false', 5, 1, '', 'male', '', 'sd', 'sd', '', 'personal', 's', '', 'df', '', '', 'sdfsdfsdf@sdfsdf', 'sdfsdfsdf@sdfsdf', 'sdf', 'f', '', '2018-05-16', 's', 'id_card', 'df', '2018-05-16', '', '', '', 'postal', ''),
(28, 'dual', '', '2018-05-16', 'false', 'false', 'false', 'via', 'sdfsd', '34', '', 'sdfsdf', 'resident', 'residenza', 'FIX12 TS', 'false', 'SW1 - SWITCH', '', '', '', 'false', 'false', 'false', 5, 1, '', 'male', '', 'sd', 'sd', '', 'personal', 's', '', 'df', '', '', 'sdfsdfsdf@sdfsdf', 'sdfsdfsdf@sdfsdf', 'sdf', 'f', '', '2018-05-16', 's', 'id_card', 'df', '2018-05-16', '', '', '', 'postal', ''),
(29, 'dual', '', '2018-05-16', 'false', 'false', 'false', 'via', 'sdf', '34324', '', 'sdfsdf', 'resident', 'residenza', 'FIX12 TS', 'false', 'SW1 - SWITCH', '', '', '', 'false', 'false', 'false', 12, 1, '', 'male', '', 'sdf', 'sdf', '', 'personal', 'f', '', 'sdf', '', '', 'sdfsdff@sdfsd.f', '', 'f', 'sd', '', '2018-05-16', 'sdf', 'id_card', 'sd', '2018-05-16', '', '', '', 'postal', ''),
(30, 'electricity', '', '2018-05-16', 'false', 'false', 'false', 'via', 'sdf', '34324', '', 'sdfsdf', 'resident', 'residenza', 'FIX12 TS', 'false', 'SW1 - SWITCH', '', '', '', 'false', 'false', 'false', 12, 3, '', 'male', '', 'sdf', 'sdf', '', 'personal', 'f', '', 'sdf', '', '', 'sdfsdff@sdfsd.f', '', 'f', 'sd', '', '2018-05-16', 'sdf', 'id_card', 'sd', '2018-05-16', '', '', '', 'postal', '');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `document_id` int(11) NOT NULL,
  `contract_id` int(11) NOT NULL,
  `url` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(23, 3, '3-states.txt', '0000-00-00 00:00:00'),
(24, 2, '2-New Text Document.txt', '2010-04-20 23:25:27'),
(25, 2, '2-3282.txt', '2010-04-20 23:32:29'),
(26, 2, '2-aaaa.png', '2010-04-20 23:34:24'),
(27, 2, '2-SM?RTP.exe', '2010-04-20 23:34:44');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `note_id` int(11) NOT NULL,
  `contract_id` int(11) NOT NULL COMMENT 'contract id',
  `user_id` int(11) NOT NULL COMMENT 'user id',
  `text` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(50) NOT NULL,
  `status_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_id`, `status_name`, `status_description`) VALUES
(1, 'NEW', 'Auto Created test'),
(3, 'test 3', 'terfsd fsdfsdf gfdgdfg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `role` enum('operator','supervisor','backoffice','admin') NOT NULL DEFAULT 'operator'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `first_name`, `last_name`, `role`) VALUES
(1, 'admin', 'passw', 'Adalen', 'Test', 'admin'),
(5, 'testadmin12', 'paswwordi', 'userssss', 'Test', 'operator'),
(6, 'testadmin12', 'paswwordi', 'testgfgf', 'Test', 'operator'),
(12, 'testuser', 'testuser', 'ssdf', 'Test', 'operator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audios`
--
ALTER TABLE `audios`
  ADD PRIMARY KEY (`audio_id`);

--
-- Indexes for table `contracts`
--
ALTER TABLE `contracts`
  ADD PRIMARY KEY (`contract_id`),
  ADD UNIQUE KEY `contract_id_2` (`contract_id`),
  ADD KEY `contract_id` (`contract_id`),
  ADD KEY `contract_id_3` (`contract_id`),
  ADD KEY `contract_id_4` (`contract_id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`document_id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`note_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audios`
--
ALTER TABLE `audios`
  MODIFY `audio_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `contracts`
--
ALTER TABLE `contracts`
  MODIFY `contract_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `note_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
