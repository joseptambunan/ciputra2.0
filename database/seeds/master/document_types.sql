-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2018 at 10:49 AM
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
-- Dumping data for table "document_types"
--

SET IDENTITY_INSERT "document_types" ON ;
INSERT INTO "document_types" ("id", "head_type", "description", "created_at", "updated_at", "deleted_at", "created_by", "updated_by", "deleted_by", "inactive_at", "inactive_by") VALUES
(1, 'Budget', NULL, '2018-07-27 10:47:45', '2018-08-01 11:00:16', NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'BudgetTahunan', NULL, '2018-07-27 10:49:57', '2018-07-27 10:50:58', NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'Workorder', NULL, '2018-07-27 10:51:07', '2018-08-01 11:01:08', NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'Rab', NULL, '2018-07-27 10:51:19', '2018-07-27 10:51:19', NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'Tender', NULL, '2018-07-27 10:51:24', '2018-08-01 11:00:54', NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'Spk', NULL, '2018-07-27 10:51:49', '2018-07-27 10:51:49', NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'Bap', NULL, '2018-07-27 10:51:56', '2018-07-27 10:51:56', NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'Vo', NULL, '2018-07-27 10:52:01', '2018-07-27 10:52:01', NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'Voucher', NULL, '2018-07-27 10:52:07', '2018-08-01 11:01:29', NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'Purchase Requesition', NULL, '2018-07-27 10:52:22', '2018-08-01 11:02:05', NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'Purchase Order', NULL, '2018-08-01 11:02:18', '2018-08-01 11:02:18', NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'TenderRekanan', NULL, '2018-09-05 07:00:00', '2018-09-05 07:00:00', NULL, 1, NULL, NULL, NULL, NULL),
(17, 'TenderMenang', NULL, '2018-09-05 07:00:00', '2018-09-05 07:00:00', NULL, 1, NULL, NULL, NULL, NULL),
(18, 'BudgetDraft', 'BudgetDraft', '2018-09-19 07:00:00', '2018-09-19 07:00:00', NULL, 1, NULL, NULL, NULL, NULL);

SET IDENTITY_INSERT "document_types" OFF;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
