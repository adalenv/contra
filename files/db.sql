-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2010 at 10:45 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
(8, 3, '3-file915.mp3', '2010-04-21 00:31:43');

-- --------------------------------------------------------

--
-- Table structure for table `campaigns`
--

CREATE TABLE `campaigns` (
  `campaign_id` int(11) NOT NULL,
  `campaign_name` varchar(50) NOT NULL,
  `campaign_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `campaigns`
--

INSERT INTO `campaigns` (`campaign_id`, `campaign_name`, `campaign_description`) VALUES
(1, 'NEW', 'Auto Created test'),
(3, 'test cmp', 'terfsd fsdfsdf gfdgdfg');

-- --------------------------------------------------------

--
-- Table structure for table `contracts`
--

CREATE TABLE `contracts` (
  `contract_id` int(11) NOT NULL,
  `contract_type` enum('luce','gas','dual') NOT NULL,
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
  `note` text NOT NULL,
  `campaign` int(11) NOT NULL COMMENT 'campaign_id',
  `supervisor` int(11) NOT NULL COMMENT 'user_id'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contracts`
--

INSERT INTO `contracts` (`contract_id`, `contract_type`, `proposal_number`, `date`, `ugm_cb`, `analisi_cb`, `iniziative_cb`, `toponimo`, `address`, `civico`, `price`, `location`, `ubicazione_fornitura`, `domicillazione_documenti_fatture`, `listino`, `richiede_gas_naturale`, `request_type`, `pdr`, `fornitore_uscente`, `consume_annuo`, `tipo_riscaldamento`, `tipo_cottura_acqua`, `fature_via_email`, `operator`, `status`, `cancellation_reason`, `gender`, `rag_sociale`, `first_name`, `last_name`, `bussines_name`, `client_type`, `tel_number`, `alt_number`, `cel_number`, `cel_number2`, `cel_number3`, `email`, `alt_email`, `birth_nation`, `vat_number`, `partita_iva`, `birth_date`, `birth_municipality`, `document_type`, `document_number`, `document_date`, `iban_code`, `iban_accounthoder`, `iban_fiscal_code`, `payment_type`, `note`, `campaign`, `supervisor`) VALUES
(35, 'dual', '', '2010-04-21', 'false', 'true', 'true', 'via', 'fg', '56', '', '56', 'resident', 'residenza', 'FIX12 TS', 'false', 'SW1 - SWITCH', '', '', '', 'false', 'false', 'false', 6, 1, '', 'male', 'sdf', 'sd', 'f', '', 'personal', 'sdf', '', 'fdg', '', '', 'fdgfdg@dfg', '', 'sd', 'sdf', '', '2010-04-21', 'f', 'id_card', 'sdf', '2010-04-21', '', '', '', 'postal', '', 3, 12),
(33, 'dual', '', '2010-04-21', 'false', 'false', 'false', 'via', 'f', '34', '', '3', 'resident', 'residenza', 'FIX12 TS', 'false', 'SW1 - SWITCH', '', '', '', 'false', 'false', 'false', 6, 1, '', 'male', 'sda', 'sd', 'as', '', 'personal', 'asd', '', 'as', '', '', 'dasd@fds', '', 'as', 'd', '', '2010-04-21', 'd', 'id_card', 'asd', '2010-04-21', '', '', '', 'postal', '', 1, 12),
(34, 'dual', '', '2010-04-21', 'false', 'false', 'false', 'via', 'ds', '34', '', 'w', 'resident', 'residenza', 'FIX12 TS', 'false', 'SW1 - SWITCH', '', '', '', 'false', 'false', 'false', 5, 1, '', 'male', 'asd', 'asd', 'as', '', 'personal', 'd', '', 'sad', '', '', 'asdsadasd@sf', '', 'as', 'd', '', '2010-04-21', 'd', 'id_card', 'as', '2010-04-21', '', '', '', 'postal', '', 3, 13);

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
(28, 3, '3-wwww.jpg', '2010-04-21 00:31:18');

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
  `role` enum('operator','supervisor','backoffice','admin') NOT NULL DEFAULT 'operator',
  `supervisor` int(11) NOT NULL COMMENT 'user_id'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `first_name`, `last_name`, `role`, `supervisor`) VALUES
(1, 'admin', 'passw', 'Adalen', 'Test', 'admin', 3),
(6, 'testadmin12', 'paswwordi', 'userssss', 'Test', 'operator', 13),
(12, 'supervisor01', 'testuser', 'supervisor', '001', 'supervisor', 2),
(13, 's2', 'sw', 's2', 'test', 'supervisor', 1),
(14, 'adminasdasd', 'asdas', 'dfsd', 'asdasd', 'operator', 0);

-- --------------------------------------------------------

--
-- Table structure for table `workhours`
--

CREATE TABLE `workhours` (
  `workhours_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hours` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workhours`
--

INSERT INTO `workhours` (`workhours_id`, `user_id`, `hours`, `date`) VALUES
(1, 1, 6, '2010-04-21'),
(2, 6, 2, '2010-04-21'),
(3, 6, 2, '2010-04-21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audios`
--
ALTER TABLE `audios`
  ADD PRIMARY KEY (`audio_id`);

--
-- Indexes for table `campaigns`
--
ALTER TABLE `campaigns`
  ADD PRIMARY KEY (`campaign_id`);

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
-- Indexes for table `workhours`
--
ALTER TABLE `workhours`
  ADD PRIMARY KEY (`workhours_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audios`
--
ALTER TABLE `audios`
  MODIFY `audio_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `campaigns`
--
ALTER TABLE `campaigns`
  MODIFY `campaign_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `contracts`
--
ALTER TABLE `contracts`
  MODIFY `contract_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
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
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `workhours`
--
ALTER TABLE `workhours`
  MODIFY `workhours_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
