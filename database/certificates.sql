-- phpMyAdmin SQL Dump
-- version 4.5.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 19, 2016 at 11:24 PM
-- Server version: 5.5.49-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `certificates`
--

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `id` int(11) NOT NULL,
  `isin` varchar(45) DEFAULT NULL,
  `trading_market` varchar(45) DEFAULT NULL,
  `currency` int(11) NOT NULL,
  `issuer` varchar(45) DEFAULT NULL,
  `issuing_price` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `certificates`
--

INSERT INTO `certificates` (`id`, `isin`, `trading_market`, `currency`, `issuer`, `issuing_price`) VALUES
(1, 'asdfs', 'sdfsdf', 1, 'sdf', 'dff');

-- --------------------------------------------------------

--
-- Table structure for table `certificate_documents`
--

CREATE TABLE `certificate_documents` (
  `id` int(11) NOT NULL,
  `certificates_id` int(11) NOT NULL,
  `document_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `certificate_documents`
--

INSERT INTO `certificate_documents` (`id`, `certificates_id`, `document_name`) VALUES
(1, 1, ''),
(2, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `certificate_prices`
--

CREATE TABLE `certificate_prices` (
  `id` int(11) NOT NULL,
  `certificates_id` int(11) NOT NULL,
  `price` varchar(45) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `certificate_prices`
--

INSERT INTO `certificate_prices` (`id`, `certificates_id`, `price`, `created_date`) VALUES
(1, 1, '56', '2016-07-19 23:11:23'),
(2, 1, '', '2016-07-19 23:11:33'),
(3, 1, '222', '2016-07-19 23:12:03'),
(4, 1, '22z', '2016-07-19 23:20:28'),
(5, 1, '223', '2016-07-19 23:20:57');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(11) NOT NULL,
  `currency` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `currency`) VALUES
(1, 'EUR'),
(2, 'USD'),
(3, 'EGP');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`id`,`currency`),
  ADD KEY `fk_certificates_table11_idx` (`currency`);

--
-- Indexes for table `certificate_documents`
--
ALTER TABLE `certificate_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_certificate_documents_certificates1_idx` (`certificates_id`);

--
-- Indexes for table `certificate_prices`
--
ALTER TABLE `certificate_prices`
  ADD PRIMARY KEY (`id`,`certificates_id`),
  ADD KEY `fk_certificate_prices_certificates1_idx` (`certificates_id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `certificate_documents`
--
ALTER TABLE `certificate_documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `certificate_prices`
--
ALTER TABLE `certificate_prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `certificates`
--
ALTER TABLE `certificates`
  ADD CONSTRAINT `fk_certificates_table11` FOREIGN KEY (`currency`) REFERENCES `currencies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `certificate_documents`
--
ALTER TABLE `certificate_documents`
  ADD CONSTRAINT `fk_certificate_documents_certificates1` FOREIGN KEY (`certificates_id`) REFERENCES `certificates` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `certificate_prices`
--
ALTER TABLE `certificate_prices`
  ADD CONSTRAINT `fk_certificate_prices_certificates1` FOREIGN KEY (`certificates_id`) REFERENCES `certificates` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
