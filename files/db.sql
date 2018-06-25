-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 15, 2018 at 03:23 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `audios`
--

INSERT INTO `audios` (`audio_id`, `contract_id`, `url`, `date`) VALUES
(1, 48, '180612_SdfFsd.mp3', '2018-06-12 13:27:17');

-- --------------------------------------------------------

--
-- Table structure for table `campaigns`
--

CREATE TABLE IF NOT EXISTS `campaigns` (
  `campaign_id` int(11) NOT NULL AUTO_INCREMENT,
  `campaign_name` varchar(50) NOT NULL,
  `campaign_description` text NOT NULL,
  PRIMARY KEY (`campaign_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

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

CREATE TABLE IF NOT EXISTS `contracts` (
  `contract_id` int(11) NOT NULL AUTO_INCREMENT,
  `contract_type` enum('luce','gas','dual') NOT NULL,
  `proposal_number` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `ugm_cb` enum('true','false') NOT NULL DEFAULT 'false',
  `analisi_cb` enum('true','false') NOT NULL DEFAULT 'false',
  `iniziative_cb` enum('true','false') NOT NULL DEFAULT 'false',
  `toponimo` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `civico` varchar(30) NOT NULL,
  `price` varchar(50) NOT NULL,
  `location` varchar(100) NOT NULL,
  `cap` varchar(50) NOT NULL,
  `uf_cap` varchar(50) NOT NULL,
  `ddf_cap` varchar(50) NOT NULL,
  `uf_toponimo` varchar(50) NOT NULL,
  `uf_address` text NOT NULL,
  `uf_civico` varchar(30) NOT NULL,
  `uf_price` varchar(50) NOT NULL,
  `uf_location` varchar(100) NOT NULL,
  `ddf_toponimo` varchar(50) NOT NULL,
  `ddf_address` text NOT NULL,
  `ddf_civico` varchar(30) NOT NULL,
  `ddf_price` varchar(50) NOT NULL,
  `ddf_location` varchar(100) NOT NULL,
  `ubicazione_fornitura` enum('resident','non_resident') NOT NULL,
  `domicillazione_documenti_fatture` enum('residenza','ubicazione_fornitura','altro') NOT NULL,
  `listino` varchar(50) NOT NULL,
  `gas_request_type` varchar(50) NOT NULL,
  `gas_pdr` varchar(50) NOT NULL,
  `gas_fornitore_uscente` varchar(50) NOT NULL,
  `gas_consume_annuo` varchar(50) NOT NULL,
  `gas_tipo_riscaldamento` enum('true','false') NOT NULL,
  `gas_tipo_cottura_acqua` enum('true','false') NOT NULL,
  `gas_remi` varchar(50) NOT NULL,
  `gas_matricola` varchar(50) NOT NULL,
  `luce_request_type` varchar(50) NOT NULL,
  `luce_pod` varchar(50) NOT NULL,
  `luce_fornitore_uscente` varchar(50) NOT NULL,
  `luce_opzione_oraria` varchar(50) NOT NULL,
  `luce_potenza` varchar(50) NOT NULL,
  `luce_tensione` varchar(50) NOT NULL,
  `luce_consume_annuo` varchar(50) NOT NULL,
  `fature_via_email` enum('true','false') NOT NULL,
  `operator` int(11) NOT NULL COMMENT 'user id',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT 'status id',
  `cancellation_reason` varchar(100) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `rag_sociale` text NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `bussines_name` varchar(50) NOT NULL,
  `client_type` enum('personal','intestario','delega') NOT NULL,
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
  `delega_first_name` varchar(50) NOT NULL,
  `delega_last_name` varchar(50) NOT NULL,
  `delega_vat_number` varchar(100) NOT NULL,
  `document_type` enum('id_card','passport','patent') NOT NULL,
  `document_number` varchar(100) NOT NULL,
  `document_date` date NOT NULL,
  `document_expiry` date NOT NULL,
  `document_issue_place` varchar(50) NOT NULL,
  `iban_code` varchar(50) NOT NULL,
  `iban_accounthoder` varchar(50) NOT NULL,
  `iban_fiscal_code` varchar(50) NOT NULL,
  `payment_type` enum('postal','cc') NOT NULL,
  `note` text NOT NULL,
  `campaign` int(11) NOT NULL COMMENT 'campaign_id',
  `supervisor` int(11) NOT NULL COMMENT 'user_id',
  PRIMARY KEY (`contract_id`),
  UNIQUE KEY `contract_id_2` (`contract_id`),
  KEY `contract_id` (`contract_id`),
  KEY `contract_id_3` (`contract_id`),
  KEY `contract_id_4` (`contract_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `contracts`
--

INSERT INTO `contracts` (`contract_id`, `contract_type`, `proposal_number`, `date`, `ugm_cb`, `analisi_cb`, `iniziative_cb`, `toponimo`, `address`, `civico`, `price`, `location`, `cap`, `uf_cap`, `ddf_cap`, `uf_toponimo`, `uf_address`, `uf_civico`, `uf_price`, `uf_location`, `ddf_toponimo`, `ddf_address`, `ddf_civico`, `ddf_price`, `ddf_location`, `ubicazione_fornitura`, `domicillazione_documenti_fatture`, `listino`, `gas_request_type`, `gas_pdr`, `gas_fornitore_uscente`, `gas_consume_annuo`, `gas_tipo_riscaldamento`, `gas_tipo_cottura_acqua`, `gas_remi`, `gas_matricola`, `luce_request_type`, `luce_pod`, `luce_fornitore_uscente`, `luce_opzione_oraria`, `luce_potenza`, `luce_tensione`, `luce_consume_annuo`, `fature_via_email`, `operator`, `status`, `cancellation_reason`, `gender`, `rag_sociale`, `first_name`, `last_name`, `bussines_name`, `client_type`, `tel_number`, `alt_number`, `cel_number`, `cel_number2`, `cel_number3`, `email`, `alt_email`, `birth_nation`, `vat_number`, `partita_iva`, `birth_date`, `birth_municipality`, `delega_first_name`, `delega_last_name`, `delega_vat_number`, `document_type`, `document_number`, `document_date`, `document_expiry`, `iban_code`, `iban_accounthoder`, `iban_fiscal_code`, `payment_type`, `note`, `campaign`, `supervisor`) VALUES
(35, 'dual', '', '2010-04-21', 'false', 'true', 'true', 'via', 'fg', '56', '', '56', '', '', '', 'via', '', '', '', '', 'via', '', '', '', '', 'resident', 'residenza', 'FIX12 TS', 'SW1 - SWITCH', '', '', '', 'false', 'false', '', '', 'Maggior Tutela', '', '', '', '', '', '', 'false', 6, 1, '', 'male', 'sdf', 'sd', 'f', '', 'personal', 'sdf', '', 'fdg', '', '', 'fdgfdg@dfg', '', 'sd', 'sdf', '', '2010-04-21', 'f', '', '', '', 'id_card', 'sdf', '2010-04-21', '0000-00-00', '', '', '', 'postal', 'this is a test note ok?\r\na simple test one', 3, 13),
(36, 'dual', '', '2010-04-21', 'false', 'false', 'false', 'via', 'ghj', 'ghj', '', 'ghj', '', '', '', 'via', '', '', '', '', 'via', '', '', '', '', 'non_resident', 'altro', 'FIX12 TS', 'A01 - ATTTIVAZIONE', 'test', '', '', 'false', 'false', '', '', 'Maggior Tutela', '', '', '', '', '', '', 'false', 6, 4, '', 'male', '', 'lkl', 'kl', '', 'personal', 'ljk', '', 'klk;', '', '', 'ljkljklhfghghghgh@fgfg', '', 'jkl', 'jl', '', '2010-04-21', 'jkl', '', '', '', 'id_card', 'jk', '2010-04-21', '0000-00-00', '', '', '', 'postal', '', 1, 13),
(37, 'luce', '', '2010-04-21', 'false', 'false', 'false', 'via', 'ghj', '4', '', 'ghj', '', '', '', 'via', '', '', '', '', 'via', '', '', '', '', 'non_resident', 'altro', 'FIX12 TS', '', '', '', '', 'false', 'false', '', '', 'Maggior Tutela', '', '', '', '', '', '', 'false', 6, 1, '', 'male', '', 'lkl', 'kl', '', 'personal', 'ljk', '', 'klk;', '', '', 'ljkljklhfghghghgh@fgfg', '', 'jkl', 'jl', '', '2010-04-21', 'jkl', '', '', '', 'id_card', 'jk', '2010-04-21', '0000-00-00', '', '', '', 'postal', '', 1, 13),
(33, 'dual', '', '2010-04-21', 'false', 'false', 'false', 'via', 'f', '34', '', '3', '', '', '', 'via', '', '', '', '', 'via', '', '', '', '', 'resident', 'residenza', 'FIX12 TS', 'SW1 - SWITCH', '', '', '', 'false', 'false', '', '', 'Maggior Tutela', '', '', '', '', '', '', 'false', 6, 5, '', 'male', 'sda', 'sd', 'as', '', 'personal', 'asd', '', 'as', '', '', 'dasd@fds', '', 'as', 'd', '', '2010-04-21', 'd', '', '', '', 'id_card', 'asd', '2010-04-21', '0000-00-00', '', '', '', 'postal', '', 1, 12),
(34, 'dual', '', '2010-04-21', 'false', 'false', 'false', 'via', 'ds', '34', '', 'w', '', '', '', 'via', '', '', '', '', 'via', '', '', '', '', 'resident', 'residenza', 'FIX12 TS', 'SW1 - SWITCH', '', '', '', 'false', 'false', '', '', 'Maggior Tutela', 'test', '', '', '', '', '', 'false', 6, 1, '', 'male', 'asd', 'asd', 'as', '', 'personal', 'd', '', 'sad', '', '', 'asdsadasd@sf', '', 'as', 'd', '', '2010-04-21', 'd', '', '', '', 'id_card', 'as', '2010-04-21', '0000-00-00', '', '', '', 'postal', '', 3, 13),
(38, 'dual', '', '2018-05-26', 'false', 'false', 'false', 'via', 'df', '345435', '', 'rgtrt', '', '', '', '', '', '', '', '', '', '', '', '', '', 'resident', 'residenza', 'FIX12 TS', 'A01 - ATTTIVAZIONE', '', '', '', 'false', 'false', '', '', 'Maggior Tutela', '', '', '', '', '', '', 'false', 6, 1, '', 'male', 'vb', 'b', 'v', '', 'personal', 'bv', '', 'b', '', '', 'vbvbv@dfg', '', 'b', 'bv', '', '2018-05-26', 'v', '', '', '', 'id_card', 'bv', '2018-05-26', '0000-00-00', '', '', '', 'postal', '', 3, 13),
(39, 'luce', '', '2018-05-26', 'false', 'false', 'false', 'via', 'sdfsdf', 'sdfsdf', '', 'asd', '', '', '', 'via', 'hgjgh', 'ghjgh', 'jghjgh', 'jghj', '', '', '', '', '', 'non_resident', 'ubicazione_fornitura', 'FIX12 TS', '', '', '', '', '', '', '', '', 'Maggior Tutela', '', '', 'Opzione 1', '', '', '', 'false', 6, 7, '', 'male', '', 'sd', 'sd', '', 'delega', 'asd', '', 'as', '', '', 'dasdasd@dfdsf', '', 'sad', 'sd', '', '2018-05-26', 'as', 'dfg', 'ghfg', 'hfgh', 'id_card', 'dasd', '2018-05-26', '0000-00-00', '', '', '', 'postal', '1', 1, 13),
(40, 'gas', '', '2018-05-26', 'false', 'true', 'true', 'via', 'dfgfgfg', 'dfg', 'fg', 'dfgd', '', '', '', 'via', 'dfgdfg', 'fgdfg', '', 'dfgdfg', 'via', 'dfgdfg', 'dfg', '', 'dfg', 'non_resident', 'altro', 'FIX12 TS', '', '', '', '', '', 'false', '', '', 'Maggior Tutela', '', '', '', '', '', '', 'false', 6, 1, '', 'male', 'fgd', 'dfg', 'dfg', '', 'delega', 'dfg', '', 'g', '', '', 'fg@dffsdf.fgh', '', 'dfgdf', 'dfg', '', '2018-05-26', 'g', 'dele', 'ooo', 'fis', 'id_card', 'dfg', '2018-05-26', '0000-00-00', '', '', '', 'postal', '1', 3, 13),
(41, 'luce', '', '2018-05-27', 'false', 'false', 'false', 'via', 'sdfg', 'fdg', '', 'dfg', '', '', '', '', '', '', '', '', '', '', '', '', '', 'resident', 'residenza', 'FIX12 TS', '', '', '', '', '', '', '', '', 'Maggior Tutela', 'test', '', 'Opzione 1', '', '', '', 'false', 6, 1, '', 'male', 'df', 'gdf', 'g', '', 'personal', 'dfg', '', 'dfg', '', '', 'sdasd@fsf', '', 'dfg', 'dfg', '', '2018-05-27', 'dfg', '', '', '', 'id_card', 'dfg', '2018-05-27', '0000-00-00', '', '', '', 'postal', '', 1, 13),
(42, 'dual', '', '2018-05-27', 'false', 'false', 'false', 'via', 'asdasd', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'resident', 'residenza', 'FIX12 TS', 'SW1 - SWITCH', '12345678901234', '', '', 'false', 'false', '', '', 'Maggior Tutela', '12345678901234', '', 'Opzione 1', '', '', '', 'false', 6, 6, '', 'male', '', '', 'fasdasd', '', 'personal', 'sfsdfsdfsdfs', '', 'dfasdasdasd', '', '', '', '', '', '', '', '2018-05-27', '', '', '', '', 'id_card', '', '2018-05-27', '0000-00-00', '123456789012345678901234567', '', '', 'postal', '', 1, 13),
(43, 'dual', '', '2018-05-27', 'false', 'false', 'false', 'via', 'asdasdasd', 'asdasd', '', 'asdasd', '', '', '', '', '', '', '', '', '', '', '', '', '', 'resident', 'residenza', 'FIX12 TS', 'SW1 - SWITCH', '12345678901234', '', '', '', 'false', '', '', 'Maggior Tutela', '12345678904000', '', 'Opzione 1', '', '12345678901234', '', 'false', 6, 4, '', 'male', '', 'j', 'sdf', '', 'personal', '1232133433', '', '1242343454', '', '', 'sdfsdfsdf@sdasd', '', 'sdf', 'sdf', '', '2018-05-27', 'sdf', '', '', '', 'id_card', 'sdf', '2018-05-27', '0000-00-00', '123456789012345678909234567', '', '', 'postal', '1', 1, 13),
(44, 'gas', '', '2018-05-27', 'false', 'false', 'false', 'via', 'sdf', 'sdf', '', 'sdf', '', '', '', '', '', '', '', '', '', '', '', '', '', 'resident', 'residenza', 'FIX12 TS', 'SW1 - SWITCH', '55345678901234', '', '', 'false', 'false', '', '', 'Maggior Tutela', '', '', '', '', '', '', 'false', 6, 2, '', 'male', 'asda', 'asd', 'asd', '', 'delega', '1234567899', '', '1234567888', '', '', 'asdasdasd@dfsdf', '', 'asd', 'asd', '', '2018-05-27', 'asd', 'sdfsdf', 'sdfsdf', 'sdfsdf', 'id_card', 'asd', '2018-05-27', '0000-00-00', '123456789012345678901234567', '', '', 'postal', '', 3, 13),
(45, 'gas', '', '2018-05-27', 'false', 'false', 'false', 'via', 'sdf', 'sdf', '', '.sdf', '', '', '', '', '', '', '', '', '', '', '', '', '', 'resident', 'residenza', 'FIX12 TS', 'SW1 - SWITCH', '12345678909876', '', '', '', 'false', 'dfg', '', 'Maggior Tutela', '', '', '', '', '', '', 'false', 6, 1, '', 'male', '', 'df', 'gd', '', 'delega', '9876543210', '', '1234567890', '', '', 'bnj@sdf', '', 'dfg', 'fg', '', '2018-05-27', 'dfg', 'dfg', 'dfg', 'dfg', 'id_card', 'dfg', '2018-02-06', '0000-00-00', '1234567891234567891234567ee', '', '', 'postal', '', 3, 13),
(46, 'dual', '', '2010-04-21', 'true', 'true', 'true', 'via', 'sdf', 'sdf', 'fgdfg', 'sdf', 'dfg', '', '', '', '', '', '', '', '', '', '', '', '', 'resident', 'residenza', 'FIX12 TS', '', '12345678908766', '', '', '', 'false', '', '', 'Maggior Tutela', '912345678908760', '', 'Opzione 1', '', '', '', 'true', 15, 3, '', 'male', 'sd', 'f', 'sdf', '', '', '1234567890', '', '3215469787', '', '', 'sdfsdf@sdf', '', 'sdf', 'sdf', '', '2010-04-21', 'sdf', '', '', '', 'patent', 'sdf', '2010-04-21', '2018-06-20', '', '', '', 'postal', '1hggh\r\n=', 3, 12);

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
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_name` varchar(50) NOT NULL,
  `status_description` text NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_id`, `status_name`, `status_description`) VALUES
(1, 'Pending', 'Auto Created'),
(2, 'OK', ''),
(3, 'KO', ''),
(4, 'Inserito', ''),
(5, 'Da Controlare', ''),
(6, 'Switch', ''),
(7, 'Storni', '');

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
  `role` enum('operator','supervisor','backoffice','admin','economist') NOT NULL DEFAULT 'operator',
  `supervisor` int(11) NOT NULL COMMENT 'user_id',
  PRIMARY KEY (`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `first_name`, `last_name`, `role`, `supervisor`) VALUES
(1, 'admin', 'passw', 'Adalen', 'Test', 'admin', 0),
(6, 'testadmin12', 'paswwordi', 'userssss', 'Test', 'operator', 13),
(12, 'supervisor01', 'testuser', 'supervisor', '001', 'supervisor', 2),
(13, 's2', 's2', 's2', 'test', 'supervisor', 0),
(14, 'adminasdasd', 'asdas', 'dfsd', 'asdasd', 'admin', 12),
(15, 'o1', 'o1', 'o1', 'o1', 'operator', 12),
(16, 'bo', 'bo', 'test', 'backoffice', 'backoffice', 12),
(17, 'e', 'e', 'e', 'e', 'economist', 0);

-- --------------------------------------------------------

--
-- Table structure for table `workhours`
--

CREATE TABLE IF NOT EXISTS `workhours` (
  `workhours_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `hours` float(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`workhours_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `workhours`
--

INSERT INTO `workhours` (`workhours_id`, `user_id`, `hours`, `date`) VALUES
(1, 1, 6, '2010-04-21'),
(2, 6, 2, '2010-06-16'),
(3, 6, 2, '2010-04-21'),
(4, 1, 7, '2018-05-27'),
(5, 1, 6, '2018-05-27'),
(6, 1, 1, '2018-05-27'),
(7, 14, 8, '2018-05-27'),
(8, 12, 8, '2018-05-27'),
(9, 12, 8, '2018-05-27'),
(10, 1, 8, '2018-05-27'),
(11, 1, 8, '2018-05-27'),
(12, 1, 1, '2018-05-27'),
(13, 1, 1, '2018-05-27'),
(14, 1, 8, '2018-07-12'),
(15, 1, 8, '2018-07-12'),
(16, 1, 8, '2018-07-12'),
(17, 1, 8, '2018-05-27'),
(21, 14, 8, '2018-05-27'),
(23, 6, 8, '2018-05-27'),
(24, 6, 8, '2018-05-27'),
(25, 6, 8, '2018-05-27'),
(26, 6, 8, '2018-05-27'),
(27, 6, 8, '2018-05-27'),
(28, 6, 3, '2018-05-27'),
(29, 6, 3, '2018-05-27'),
(30, 6, 3, '2018-05-27'),
(31, 6, 3, '2018-05-27'),
(32, 6, 8, '2010-04-21');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
