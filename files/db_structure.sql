-- MySQL dump 10.14  Distrib 5.5.56-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: justcall
-- ------------------------------------------------------
-- Server version	5.5.56-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `audios`
--

DROP TABLE IF EXISTS `audios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `audios` (
  `audio_id` int(11) NOT NULL AUTO_INCREMENT,
  `contract_id` int(11) NOT NULL COMMENT 'contrat id',
  `url` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`audio_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4859 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `campaigns`
--

DROP TABLE IF EXISTS `campaigns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `campaigns` (
  `campaign_id` int(11) NOT NULL AUTO_INCREMENT,
  `campaign_name` varchar(50) NOT NULL,
  `campaign_description` text NOT NULL,
  PRIMARY KEY (`campaign_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `chat`
--

DROP TABLE IF EXISTS `chat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from` varchar(255) NOT NULL DEFAULT '',
  `to` varchar(255) NOT NULL DEFAULT '',
  `message` text NOT NULL,
  `sent` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `recd` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10094 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `chat_lastactivity`
--

DROP TABLE IF EXISTS `chat_lastactivity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chat_lastactivity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=173 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `contracts`
--

DROP TABLE IF EXISTS `contracts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contracts` (
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
  `document_issue_place` varchar(60) NOT NULL,
  `iban_code` varchar(50) NOT NULL,
  `iban_accounthoder` varchar(50) NOT NULL,
  `iban_fiscal_code` varchar(50) NOT NULL,
  `payment_type` enum('postal','cc') NOT NULL,
  `note` text NOT NULL,
  `campaign` int(11) NOT NULL COMMENT 'campaign_id',
  `supervisor` int(11) NOT NULL COMMENT 'user_id',
  `note_super` text NOT NULL,
  PRIMARY KEY (`contract_id`),
  UNIQUE KEY `contract_id_2` (`contract_id`),
  KEY `contract_id` (`contract_id`),
  KEY `contract_id_3` (`contract_id`),
  KEY `contract_id_4` (`contract_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4428 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `documents`
--

DROP TABLE IF EXISTS `documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documents` (
  `document_id` int(11) NOT NULL AUTO_INCREMENT,
  `contract_id` int(11) NOT NULL,
  `url` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`document_id`)
) ENGINE=InnoDB AUTO_INCREMENT=544 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `contract_id` int(11) NOT NULL,
  `diff` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15913 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `notes`
--

DROP TABLE IF EXISTS `notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notes` (
  `note_id` int(11) NOT NULL AUTO_INCREMENT,
  `contract_id` int(11) NOT NULL COMMENT 'contract id',
  `user_id` int(11) NOT NULL COMMENT 'user id',
  `text` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`note_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_name` varchar(50) NOT NULL,
  `status_description` text NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `role` enum('operator','supervisor','backoffice','admin','economist','floor_manager') NOT NULL DEFAULT 'operator',
  `supervisor` int(11) NOT NULL COMMENT 'user_id',
  PRIMARY KEY (`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=181 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `workhours`
--

DROP TABLE IF EXISTS `workhours`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `workhours` (
  `workhours_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `hours` float NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`workhours_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7033 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-11-07 15:12:22
