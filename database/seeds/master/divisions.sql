-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2018 at 09:42 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: "ciputra2"
--

--
-- Dumping data for table "divisions"
--

SET IDENTITY_INSERT "divisions" ON ;
INSERT INTO "divisions" ("id", "code", "name", "description", "created_at", "updated_at", "deleted_at", "created_by", "updated_by", "deleted_by", "inactive_at", "inactive_by") VALUES
(1, 'ACC', 'Accounting', 'Accounting', '2018-07-03 22:21:04', '2018-07-03 22:21:04', NULL, 1, NULL, NULL, NULL, NULL),
(2, 'BUI', 'Building', 'Building', '2018-07-03 22:21:04', '2018-07-03 22:21:04', NULL, 1, NULL, NULL, NULL, NULL),
(3, 'COL', 'Collection', 'Collection', '2018-07-03 22:21:04', '2018-07-03 22:21:04', NULL, 1, NULL, NULL, NULL, NULL),
(4, 'CP', 'Contract & Procurement', 'Contract & Procurement', '2018-07-03 22:21:04', '2018-07-03 22:21:04', NULL, 1, NULL, NULL, NULL, NULL),
(5, 'CR', 'Customer Relation', 'Customer Relation', '2018-07-03 22:21:04', '2018-07-03 22:21:04', NULL, 1, NULL, NULL, NULL, NULL),
(6, 'FAC', 'Facilities', 'Facilities', '2018-07-03 22:21:04', '2018-07-03 22:21:04', NULL, 1, NULL, NULL, NULL, NULL),
(7, 'HCM', 'Human Capital Management & GA', 'Human Capital Management & GA', '2018-07-03 22:21:04', '2018-07-03 22:21:04', NULL, 1, NULL, NULL, NULL, NULL),
(8, 'ICT', 'Information Computer Technologi', 'ICT', '2018-07-03 22:21:04', '2018-07-31 15:04:06', NULL, 1, NULL, NULL, NULL, NULL),
(9, 'INF', 'Infrastructure', 'Infrastructure', '2018-07-03 22:21:04', '2018-07-03 22:21:04', NULL, 1, NULL, NULL, NULL, NULL),
(10, 'LAA', 'Land Administration', 'Land Administration', '2018-07-03 22:21:05', '2018-07-03 22:21:05', NULL, 1, NULL, NULL, NULL, NULL),
(11, 'LAQ', 'Land Aquisition', 'Land Aquisition', '2018-07-03 22:21:05', '2018-07-03 22:21:05', NULL, 1, NULL, NULL, NULL, NULL),
(12, 'LH', 'Landscape & Housekeeping', 'Landscape & Housekeeping', '2018-07-03 22:21:05', '2018-07-03 22:21:05', NULL, 1, NULL, NULL, NULL, NULL),
(13, 'LEG', 'Legal & Mortgage', 'Legal & Mortgage', '2018-07-03 22:21:05', '2018-07-03 22:21:05', NULL, 1, NULL, NULL, NULL, NULL),
(14, 'LIT', 'Litigation', 'Litigation', '2018-07-03 22:21:05', '2018-07-03 22:21:05', NULL, 1, NULL, NULL, NULL, NULL),
(15, 'PER', 'Permit', 'Permit', '2018-07-03 22:21:05', '2018-07-03 22:21:05', NULL, 1, NULL, NULL, NULL, NULL),
(16, 'PD', 'Planning & Design', 'Planning & Design', '2018-07-03 22:21:05', '2018-07-03 22:21:05', NULL, 1, NULL, NULL, NULL, NULL),
(17, 'PRO', 'Promotion', 'Promotion', '2018-07-03 22:21:05', '2018-07-03 22:21:05', NULL, 1, NULL, NULL, NULL, NULL),
(18, 'PUR', 'Purchasing', 'Purchasing', '2018-07-03 22:21:05', '2018-07-03 22:21:05', NULL, 1, NULL, NULL, NULL, NULL),
(19, 'RET', 'Retribution', 'Retribution', '2018-07-03 22:21:05', '2018-07-03 22:21:05', NULL, 1, NULL, NULL, NULL, NULL),
(20, 'SAL', 'Sales', 'Sales', '2018-07-03 22:21:05', '2018-07-03 22:21:05', NULL, 1, NULL, NULL, NULL, NULL),
(21, 'SEC', 'Security', 'Security', '2018-07-03 22:21:05', '2018-07-03 22:21:05', NULL, 1, NULL, NULL, NULL, NULL),
(22, 'TAX', 'Tax', 'Tax', '2018-07-03 22:21:05', '2018-07-03 22:21:05', NULL, 1, NULL, NULL, NULL, NULL),
(23, 'TRE', 'Treasury', 'Treasury', '2018-07-03 22:21:05', '2018-07-03 22:21:05', NULL, 1, NULL, NULL, NULL, NULL),
(24, 'UTI', 'Utility & Infrastructure', 'Utility & Infrastructure', '2018-07-03 22:21:05', '2018-07-03 22:21:05', NULL, 1, NULL, NULL, NULL, NULL),
(25, 'WAT', 'Water Supply', 'Water Supply', '2018-07-03 22:21:05', '2018-07-03 22:21:05', NULL, 1, NULL, NULL, NULL, NULL),
(26, 'WTP', 'Water Park', 'Water Park', '2018-07-03 22:21:05', '2018-07-03 22:21:05', NULL, 1, NULL, NULL, NULL, NULL),
(27, 'EST', 'Estate', NULL, '2018-10-01 13:05:23', '2018-10-01 13:05:23', NULL, NULL, NULL, NULL, NULL, NULL);

SET IDENTITY_INSERT "divisions" OFF;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
