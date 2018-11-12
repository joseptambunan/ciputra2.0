-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2018 at 09:45 AM
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
-- Dumping data for table "mappingperusahaans"
--

SET IDENTITY_INSERT "mappingperusahaans" ON ;
INSERT INTO "mappingperusahaans" ("id", "pt_id", "department_id", "division_id", "description", "created_at", "updated_at", "deleted_at", "created_by", "updated_by", "deleted_by", "inactive_at", "inactive_by") VALUES
(1, 1, 2, 16, NULL, '2018-07-04 23:48:39', '2018-07-04 23:48:39', NULL, 1, NULL, NULL, NULL, NULL),
(2, 1, 1, 9, NULL, '2018-07-23 03:43:04', '2018-07-23 03:43:04', NULL, 1, NULL, NULL, NULL, NULL),
(3, 6, 2, 1, NULL, '2018-07-31 00:00:00', '2018-07-31 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL),
(4, 8, 2, 16, NULL, '2018-09-21 18:25:14', '2018-09-21 18:25:14', NULL, NULL, NULL, NULL, NULL, NULL),
(6, 9, 2, 16, NULL, '2018-10-01 13:05:57', '2018-10-01 13:05:57', NULL, NULL, NULL, NULL, NULL, NULL),
(7, 9, 2, 2, NULL, '2018-10-01 13:06:35', '2018-10-01 13:06:35', NULL, NULL, NULL, NULL, NULL, NULL),
(8, 9, 12, 7, NULL, '2018-10-01 13:06:57', '2018-10-01 13:06:57', NULL, NULL, NULL, NULL, NULL, NULL),
(9, 9, 6, 1, NULL, '2018-10-01 13:07:12', '2018-10-01 13:07:12', NULL, NULL, NULL, NULL, NULL, NULL),
(10, 9, 6, 23, NULL, '2018-10-01 13:07:44', '2018-10-01 13:07:44', NULL, NULL, NULL, NULL, NULL, NULL),
(11, 9, 6, 22, NULL, '2018-10-01 13:08:04', '2018-10-01 13:08:04', NULL, NULL, NULL, NULL, NULL, NULL),
(12, 9, 14, 13, NULL, '2018-10-01 13:08:49', '2018-10-01 13:08:49', NULL, NULL, NULL, NULL, NULL, NULL),
(13, 9, 14, 15, NULL, '2018-10-01 13:09:15', '2018-10-01 13:09:15', NULL, NULL, NULL, NULL, NULL, NULL),
(14, 9, 14, 10, NULL, '2018-10-01 13:10:03', '2018-10-01 13:10:03', NULL, NULL, NULL, NULL, NULL, NULL),
(15, 9, 17, 17, NULL, '2018-10-01 13:10:57', '2018-10-01 13:10:57', NULL, NULL, NULL, NULL, NULL, NULL),
(16, 9, 2, 4, NULL, '2018-10-01 13:13:03', '2018-10-01 13:13:03', NULL, NULL, NULL, NULL, NULL, NULL),
(17, 9, 2, 9, NULL, '2018-10-01 13:13:44', '2018-10-01 13:13:44', NULL, NULL, NULL, NULL, NULL, NULL),
(18, 10, 2, 16, NULL, '2018-10-01 13:49:09', '2018-10-01 13:49:09', NULL, NULL, NULL, NULL, NULL, NULL),
(19, 2, 2, 16, NULL, '2018-10-01 14:03:02', '2018-10-01 14:03:02', NULL, NULL, NULL, NULL, NULL, NULL),
(20, 11, 2, 16, NULL, '2018-10-04 10:01:42', '2018-10-04 10:01:42', NULL, NULL, NULL, NULL, NULL, NULL),
(21, 11, 2, 4, NULL, '2018-10-04 10:02:09', '2018-10-04 10:02:09', NULL, NULL, NULL, NULL, NULL, NULL),
(22, 10, 2, 2, NULL, '2018-10-05 03:09:25', '2018-10-05 03:09:25', NULL, NULL, NULL, NULL, NULL, NULL),
(23, 25, 2, 16, NULL, '2018-10-19 00:19:20', '2018-10-19 00:19:20', NULL, NULL, NULL, NULL, NULL, NULL),
(24, 24, 2, 16, NULL, '2018-10-29 03:35:54', '2018-10-29 03:35:54', NULL, NULL, NULL, NULL, NULL, NULL),
(25, 48, 2, 16, NULL, '2018-11-09 04:18:08', '2018-11-09 04:18:08', NULL, NULL, NULL, NULL, NULL, NULL);

SET IDENTITY_INSERT "mappingperusahaans" OFF;

--
-- Dumping data for table "projects"
--

SET IDENTITY_INSERT "projects" ON ;
INSERT INTO "projects" ("id", "subholding", "contactperson", "city_id", "code", "name", "luas", "address", "zipcode", "phone", "fax", "email", "description", "created_at", "updated_at", "deleted_at", "created_by", "updated_by", "deleted_by", "inactive_at", "inactive_by", "project_id", "luas_nonpengembangan") VALUES
(1, 2, NULL, NULL, 'D', 'CITRA INDAH', 0.00, 'JONGGOL', 'NULL', 'NULL', 'JONGGOL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:44', '2018-10-18 23:15:44', NULL, 1, NULL, NULL, NULL, NULL, 5, NULL),
(2, 2, NULL, 265, 'G', 'CITRA RAYA - SURABAYA', 0.00, 'SURABAYA', 'NULL', 'NULL', 'SURABAYA', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:44', '2018-10-18 23:15:44', NULL, 1, NULL, NULL, NULL, NULL, 8, NULL),
(3, 2, NULL, NULL, 'H', 'CITRAGRAN -  CIBUBUR', 0.00, 'CIBUBUR', 'NULL', 'NULL', 'CIBUBUR', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:44', '2018-10-18 23:15:44', NULL, 1, NULL, NULL, NULL, NULL, 9, NULL),
(4, 2, NULL, 156, 'I01', 'SEKOLAH CIPUTRA - CITRARAYA', 0.00, 'TANGERANG', 'NULL', 'NULL', 'TANGERANG', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:44', '2018-10-18 23:15:44', NULL, 1, NULL, NULL, NULL, NULL, 10, NULL),
(5, 2, NULL, 265, 'P', 'UNIVERSITAS CIPUTRA', 0.00, 'SURABAYA', 'NULL', 'NULL', 'SURABAYA', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:44', '2018-10-18 23:15:44', NULL, 1, NULL, NULL, NULL, NULL, 20, NULL),
(6, 2, NULL, 265, 'R', 'SEKOLAH CIPUTRA-SURABAYA', 0.00, 'SURABAYA', 'NULL', 'NULL', 'SURABAYA', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:44', '2018-10-18 23:15:44', NULL, 1, NULL, NULL, NULL, NULL, 23, NULL),
(7, 2, NULL, NULL, 'S', 'LAMPUNG', 0.00, 'LAMPUNG', 'NULL', 'NULL', 'LAMPUNG', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:44', '2018-10-18 23:15:44', NULL, 1, NULL, NULL, NULL, NULL, 24, NULL),
(8, 2, NULL, 51, 'XXX', 'CitraLand Bagya City Medan', 0.00, 'MEDAN', 'NULL', 'NULL', 'MEDAN', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:44', '2018-10-18 23:15:44', NULL, 1, NULL, NULL, NULL, NULL, 30, NULL),
(9, 2, NULL, 88, 'XXX', 'CitraLand Pekanbaru', 0.00, 'PEKANBARU', 'NULL', 'NULL', 'PEKANBARU', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:44', '2018-10-18 23:15:44', NULL, 1, NULL, NULL, NULL, NULL, 31, NULL),
(10, 2, NULL, 88, 'XXX', 'CitraGarden Pekanbaru', 0.00, 'PEKANBARU', 'NULL', 'NULL', 'PEKANBARU', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:44', '2018-10-18 23:15:44', NULL, 1, NULL, NULL, NULL, NULL, 32, NULL),
(11, 2, NULL, NULL, 'XXX', 'CitraGarden Lampung', 0.00, 'LAMPUNG', 'NULL', 'NULL', 'LAMPUNG', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:44', '2018-10-18 23:15:44', NULL, 1, NULL, NULL, NULL, NULL, 33, NULL),
(12, 2, NULL, NULL, 'XXX', 'BizPark 2 - Penggilingan', 0.00, 'PENGILINGAN', 'NULL', 'NULL', 'PENGILINGAN', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:44', '2018-10-18 23:15:44', NULL, 1, NULL, NULL, NULL, NULL, 34, NULL),
(13, 2, NULL, 161, 'XXX', 'BizPark Bandung', 0.00, 'BANDUNG', 'NULL', 'NULL', 'BANDUNG', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:44', '2018-10-18 23:15:44', NULL, 1, NULL, NULL, NULL, NULL, 35, NULL),
(14, 2, NULL, 215, 'XXX', 'CitraSun Garden Semarang', 0.00, 'SEMARANG', 'NULL', 'NULL', 'SEMARANG', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:44', '2018-10-18 23:15:44', NULL, 1, NULL, NULL, NULL, NULL, 36, NULL),
(15, 2, NULL, 270, 'XXX', 'CitraSun Garden Yogyakarta', 0.00, 'YOGYAKARTA', 'NULL', 'NULL', 'YOGYAKARTA', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:45', '2018-10-18 23:15:45', NULL, 1, NULL, NULL, NULL, NULL, 37, NULL),
(16, 2, NULL, 215, 'XXX', 'CitraGrand Semarang', 0.00, 'SEMARANG', 'NULL', 'NULL', 'SEMARANG', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:45', '2018-10-18 23:15:45', NULL, 1, NULL, NULL, NULL, NULL, 38, NULL),
(17, 2, NULL, 265, 'XXX', 'CitraLand Surabaya', 0.00, 'SURABAYA', 'NULL', 'NULL', 'SURABAYA', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:45', '2018-10-18 23:15:45', NULL, 1, NULL, NULL, NULL, NULL, 39, NULL),
(18, 2, NULL, 265, 'XXX', 'CitraLand Utara', 0.00, 'SURABAYA', 'NULL', 'NULL', 'SURABAYA', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:45', '2018-10-18 23:15:45', NULL, 1, NULL, NULL, NULL, NULL, 40, NULL),
(19, 2, NULL, 251, 'XXX', 'CitraHarmoni Sidoarjo', 0.00, 'SIDOARJO', 'NULL', 'NULL', 'SIDOARJO', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:45', '2018-10-18 23:15:45', NULL, 1, NULL, NULL, NULL, NULL, 41, NULL),
(20, 2, NULL, 251, 'XXX', 'CitraGarden Sidoarjo', 0.00, 'SIDOARJO', 'NULL', 'NULL', 'SIDOARJO', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:45', '2018-10-18 23:15:45', NULL, 1, NULL, NULL, NULL, NULL, 42, NULL),
(21, 2, NULL, 251, 'XXX', 'CitraIndah Sidoarjo', 0.00, 'SIDOARJO', 'NULL', 'NULL', 'SIDOARJO', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:45', '2018-10-18 23:15:45', NULL, 1, NULL, NULL, NULL, NULL, 43, NULL),
(22, 2, NULL, NULL, 'XXX', 'The Taman Dayu Pandaaan', 0.00, 'PANDAAN', 'NULL', 'NULL', 'PANDAAN', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:45', '2018-10-18 23:15:45', NULL, 1, NULL, NULL, NULL, NULL, 44, NULL),
(23, 2, NULL, NULL, 'XXX', 'Paradise Memorial Park', 0.00, 'Lain Lain', 'NULL', 'NULL', 'Lain Lain', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:45', '2018-10-18 23:15:45', NULL, 1, NULL, NULL, NULL, NULL, 45, NULL),
(24, 2, NULL, 279, 'XXX', 'CitraLand Denpasar', 0.00, 'DENPASAR', 'NULL', 'NULL', 'DENPASAR', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:45', '2018-10-18 23:15:45', NULL, 1, NULL, NULL, NULL, NULL, 46, NULL),
(25, 2, NULL, 407, 'XXX', 'CitraLand Kendari', 0.00, 'KENDARI', 'NULL', 'NULL', 'KENDARI', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:45', '2018-10-18 23:15:45', NULL, 1, NULL, NULL, NULL, NULL, 47, NULL),
(26, 2, NULL, 418, 'XXX', 'CitraLand Palu', 0.00, 'PALU', 'NULL', 'NULL', 'PALU', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:45', '2018-10-18 23:15:45', NULL, 1, NULL, NULL, NULL, NULL, 48, NULL),
(27, 2, NULL, 432, 'XXX', 'CitraLand Manado', 0.00, 'MANADO', 'NULL', 'NULL', 'MANADO', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:45', '2018-10-18 23:15:45', NULL, 1, NULL, NULL, NULL, NULL, 49, NULL),
(28, 2, NULL, 448, 'XXX', 'CitraLand Ambon', 0.00, 'AMBON', 'NULL', 'NULL', 'AMBON', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:45', '2018-10-18 23:15:45', NULL, 1, NULL, NULL, NULL, NULL, 50, NULL),
(29, 2, NULL, 265, 'XXX', 'Ciputra World Surabaya', 0.00, 'SURABAYA', 'NULL', 'NULL', 'SURABAYA', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:45', '2018-10-18 23:15:45', NULL, 1, NULL, NULL, NULL, NULL, 51, NULL),
(30, 2, NULL, 265, 'XXX', 'Comercial - CitraLand Surabaya', 0.00, 'SURABAYA', 'NULL', 'NULL', 'SURABAYA', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:45', '2018-10-18 23:15:45', NULL, 1, NULL, NULL, NULL, NULL, 52, NULL),
(31, 2, NULL, 265, 'XXX', 'Apartment - CitraLand Surabaya', 0.00, 'SURABAYA', 'NULL', 'NULL', 'SURABAYA', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:45', '2018-10-18 23:15:45', NULL, 1, NULL, NULL, NULL, NULL, 53, NULL),
(32, 2, NULL, 265, 'XXX', 'CitraLand Surabaya - Utara', 0.00, 'SURABAYA', 'NULL', 'NULL', 'SURABAYA', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:45', '2018-10-18 23:15:45', NULL, 1, NULL, NULL, NULL, NULL, 54, NULL),
(33, 2, NULL, NULL, 'XXX', 'CitraGarden & CitraIndah Sidoharjo', 0.00, 'Sidoharjo', 'NULL', 'NULL', 'Sidoharjo', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:45', '2018-10-18 23:15:45', NULL, 1, NULL, NULL, NULL, NULL, 55, NULL),
(34, 2, NULL, NULL, 'xxx', 'Rumah - CitraLand Surabaya ', 0.00, 'Surabaya Perumahan', 'NULL', 'NULL', 'Surabaya Perumahan', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:45', '2018-10-18 23:15:45', NULL, 1, NULL, NULL, NULL, NULL, 56, NULL),
(35, 2, NULL, 265, 'XXX', 'Hotel CiputraWorld', 0.00, 'Surabaya', 'NULL', 'NULL', 'Surabaya', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:45', '2018-10-18 23:15:45', NULL, 1, NULL, NULL, NULL, NULL, 58, NULL),
(36, 2, NULL, 270, 'XXX', 'CitraGrand Mutiara Yogyakarta', 0.00, 'Yogyakarta', 'NULL', 'NULL', 'Yogyakarta', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:45', '2018-10-18 23:15:45', NULL, 1, NULL, NULL, NULL, NULL, 61, NULL),
(37, 2, NULL, NULL, 'XXX', 'Sekolah Citra Berkat Citra Indah', 0.00, 'Jonggol', 'NULL', 'NULL', 'Jonggol', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:45', '2018-10-18 23:15:45', NULL, 1, NULL, NULL, NULL, NULL, 63, NULL),
(38, 2, NULL, NULL, 'XXX', 'BizPark 1 - Pulogadung', 0.00, 'Jakarta', 'NULL', 'NULL', 'Jakarta', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:45', '2018-10-18 23:15:45', NULL, 1, NULL, NULL, NULL, NULL, 68, NULL),
(39, 2, NULL, 251, 'XXX', 'The Taman Dayu Pandaaan', 0.00, 'Sidoarjo', 'NULL', 'NULL', 'Sidoarjo', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:45', '2018-10-18 23:15:45', NULL, 1, NULL, NULL, NULL, NULL, 72, NULL),
(40, 2, NULL, NULL, 'XXX', 'UC.COM', 0.00, 'Jakarta', 'NULL', 'NULL', 'Jakarta', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:45', '2018-10-18 23:15:45', NULL, 1, NULL, NULL, NULL, NULL, 73, NULL),
(41, 2, NULL, 265, 'XXX', 'Ciputra Waterpark Surabaya', 0.00, 'Surabaya', 'NULL', 'NULL', 'Surabaya', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:45', '2018-10-18 23:15:45', NULL, 1, NULL, NULL, NULL, NULL, 85, NULL),
(42, 2, NULL, 51, 'XXX', 'CitraGarden Medan', 0.00, 'Medan', 'NULL', 'NULL', 'Medan', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:45', '2018-10-18 23:15:45', NULL, 1, NULL, NULL, NULL, NULL, 86, NULL),
(43, 2, NULL, 265, 'XXX', 'Ciputra Golf Surabaya', 0.00, 'Surabaya', 'NULL', 'NULL', 'Surabaya', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:45', '2018-10-18 23:15:45', NULL, 1, NULL, NULL, NULL, NULL, 88, NULL),
(44, 2, NULL, 88, 'XXX', 'Mall Ciputra Seraya Pekanbaru', 0.00, 'Pekanbaru', 'NULL', 'NULL', 'Pekanbaru', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:45', '2018-10-18 23:15:45', NULL, 1, NULL, NULL, NULL, NULL, 93, NULL),
(45, 2, NULL, 156, 'XXX', 'Sekolah Citra Berkat Tangerang', 0.00, 'Tangerang', 'NULL', 'NULL', 'Tangerang', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:45', '2018-10-18 23:15:45', NULL, 1, NULL, NULL, NULL, NULL, 94, NULL),
(46, 2, NULL, NULL, 'XXX', 'CitraGran Cibubur', 0.00, 'Cibubur', 'NULL', 'NULL', 'Cibubur', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:45', '2018-10-18 23:15:45', NULL, 1, NULL, NULL, NULL, NULL, 97, NULL),
(47, 2, NULL, NULL, 'XXX', 'Sekolah Citra Kasih Jakarta', 0.00, 'Jakarta', 'NULL', 'NULL', 'Jakarta', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:45', '2018-10-18 23:15:45', NULL, 1, NULL, NULL, NULL, NULL, 100, NULL),
(48, 2, NULL, 51, 'XXX', 'Ruko - CitraLand Bagya City ', 0.00, 'Medan', 'NULL', 'NULL', 'Medan', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:45', '2018-10-18 23:15:45', NULL, 1, NULL, NULL, NULL, NULL, 101, NULL),
(49, 2, NULL, 51, 'XXX', 'Rumah - CitraLand Bagya City ', 0.00, 'Medan', 'NULL', 'NULL', 'Medan', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:45', '2018-10-18 23:15:45', NULL, 1, NULL, NULL, NULL, NULL, 102, NULL),
(50, 2, NULL, 51, 'XXX', 'Kavling - CitraLand Bagya City ', 0.00, 'Medan', 'NULL', 'NULL', 'Medan', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:45', '2018-10-18 23:15:45', NULL, 1, NULL, NULL, NULL, NULL, 103, NULL),
(51, 2, NULL, 265, 'XXX', 'Citraland The GreenLake', 0.00, 'Surabaya', 'NULL', 'NULL', 'Surabaya', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:45', '2018-10-18 23:15:45', NULL, 1, NULL, NULL, NULL, NULL, 105, NULL),
(52, 2, NULL, 265, 'XXX', 'Sekolah Citra Berkat Surabaya', 0.00, 'Surabaya', 'NULL', 'NULL', 'Surabaya', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:45', '2018-10-18 23:15:45', NULL, 1, NULL, NULL, NULL, NULL, 106, NULL),
(53, 2, NULL, NULL, 'XXX', 'CitraGarden Waterpark Sidoarjo', 0.00, 'Sidoarja', 'NULL', 'NULL', 'Sidoarja', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:45', '2018-10-18 23:15:45', NULL, 1, NULL, NULL, NULL, NULL, 107, NULL),
(54, 2, NULL, NULL, 'XXX', 'Mall Ciputra Cibubur', 0.00, 'Cibubur', 'NULL', 'NULL', 'Cibubur', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:45', '2018-10-18 23:15:45', NULL, 1, NULL, NULL, NULL, NULL, 111, NULL),
(55, 2, NULL, NULL, 'CGL', 'Citra Garden Lampung', 0.00, 'LAMPUNG', 'NULL', 'NULL', 'LAMPUNG', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:45', '2018-10-18 23:15:45', NULL, 1, NULL, NULL, NULL, NULL, 2013, NULL),
(56, 2, NULL, 163, 'YYY', 'BizPark 3 - CE Bekasi', 0.00, 'Bekasi', 'NULL', 'NULL', 'Bekasi', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:45', '2018-10-18 23:15:45', NULL, 1, NULL, NULL, NULL, NULL, 2019, NULL),
(57, 2, NULL, 393, 'YYY', 'CitraLand Waterfront City Makassar', 0.00, 'Makassar', 'NULL', 'NULL', 'Makassar', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:45', '2018-10-18 23:15:45', NULL, 1, NULL, NULL, NULL, NULL, 2045, NULL),
(58, 2, NULL, NULL, 'YYY', 'CitraLand Lampung ', 0.00, 'LAMPUNG', 'NULL', 'NULL', 'LAMPUNG', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:45', '2018-10-18 23:15:45', NULL, 1, NULL, NULL, NULL, NULL, 2069, NULL),
(59, 2, NULL, NULL, 'XXX', 'CWS - Hotel', 0.00, 'Surabya', 'NULL', 'NULL', 'Surabya', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:45', '2018-10-18 23:15:45', NULL, 1, NULL, NULL, NULL, NULL, 2072, NULL),
(60, 2, NULL, 180, 'XXX', 'CitraGrand CBD Cibubur', 393546.00, 'Cibubur', '12345', 'NULL', 'Cibubur', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:45', '2018-10-18 23:35:06', NULL, 1, NULL, NULL, NULL, NULL, 2075, NULL),
(61, 2, NULL, NULL, 'I', 'CitraLand Cibubur', 0.00, 'Mekarsari', 'NULL', 'NULL', 'Mekarsari', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:45', '2018-10-18 23:15:45', NULL, 1, NULL, NULL, NULL, NULL, 2076, NULL),
(62, 2, NULL, 432, 'YYY', 'CitraLand Kairagi Manado', 0.00, 'Manado', 'NULL', 'NULL', 'Manado', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:45', '2018-10-18 23:15:45', NULL, 1, NULL, NULL, NULL, NULL, 2077, NULL),
(63, 2, NULL, NULL, 'YYY', 'CitraLand Tallasa City Makassar ', 0.00, 'Cibubur', 'NULL', 'NULL', 'Cibubur', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:45', '2018-10-18 23:15:45', NULL, 1, NULL, NULL, NULL, NULL, 2078, NULL),
(64, 2, NULL, 393, 'YYY', 'CitraLand Palembang', 0.00, 'Makassar', 'NULL', 'NULL', 'Makassar', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:45', '2018-10-18 23:15:45', NULL, 1, NULL, NULL, NULL, NULL, 2079, NULL),
(65, 2, NULL, 265, 'YYY', 'Apartment CitraLand Surabaya-Cornell', 0.00, 'SURABAYA', 'NULL', 'NULL', 'SURABAYA', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:45', '2018-10-18 23:15:45', NULL, 1, NULL, NULL, NULL, NULL, 2080, NULL),
(66, 2, NULL, 163, 'XXX', 'BizPark 3', 85496.00, 'Bekasi', 'NULL', 'NULL', 'Bekasi', 'bizpark3@ciputra.com', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:45', '2018-10-29 02:12:31', NULL, 1, NULL, NULL, NULL, NULL, 3026, 0),
(67, 2, NULL, NULL, 'XXX', 'CitraLand Cileungsi', 0.00, 'Jakartaa', 'NULL', 'NULL', 'Jakartaa', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:45', '2018-10-18 23:15:45', NULL, 1, NULL, NULL, NULL, NULL, 3027, NULL),
(68, 2, NULL, 393, 'XXX', 'CitraLand City Losari Makasar', 0.00, 'Makassar', 'NULL', 'NULL', 'Makassar', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:45', '2018-10-18 23:15:45', NULL, 1, NULL, NULL, NULL, NULL, 3028, NULL),
(69, 2, NULL, NULL, 'XXX', 'KANTOR PUSAT SH2', 0.00, 'Jakarta', 'NULL', 'NULL', 'Jakarta', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:46', '2018-10-18 23:15:46', NULL, 1, NULL, NULL, NULL, NULL, 3030, NULL),
(70, 2, NULL, 393, 'XXX', 'CitraLand Tallasa City Makasar', 0.00, 'Makassar', 'NULL', 'NULL', 'Makassar', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:46', '2018-10-18 23:15:46', NULL, 1, NULL, NULL, NULL, NULL, 3031, NULL),
(71, 2, NULL, 432, 'XXX', 'CitraLand Winagun Manado', 0.00, 'Manado', 'NULL', 'NULL', 'Manado', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:46', '2018-10-18 23:15:46', NULL, 1, NULL, NULL, NULL, NULL, 3032, NULL),
(72, 2, NULL, NULL, 'XXX', 'Citraland Cibubur', 0.00, 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:46', '2018-10-18 23:15:46', NULL, 1, NULL, NULL, NULL, NULL, 4032, NULL),
(73, 2, NULL, NULL, 'XXX', 'UCEC', 0.00, 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:46', '2018-10-18 23:15:46', NULL, 1, NULL, NULL, NULL, NULL, 4043, NULL),
(74, 2, NULL, NULL, 'XXX', '--- Kosong --', 0.00, 'aaaa', 'NULL', 'NULL', 'aaaa', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:46', '2018-10-18 23:15:46', NULL, 1, NULL, NULL, NULL, NULL, 4044, NULL),
(75, 2, NULL, 265, 'XXX', 'KANTOR PUSAT SH2', 0.00, 'SURABAYA', 'NULL', 'NULL', 'SURABAYA', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:46', '2018-10-18 23:15:46', NULL, 1, NULL, NULL, NULL, NULL, 4058, NULL),
(76, 2, NULL, NULL, 'XXX', 'Barsa City Yogyakarta', 0.00, 'Jl. Laksda Adi Sucipto km.7, Yogyakarta', 'NULL', 'NULL', 'Jl. Laksda Adi Sucipto km.7, Yogyakarta', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:46', '2018-10-18 23:15:46', NULL, 1, NULL, NULL, NULL, NULL, 4063, NULL),
(77, 2, NULL, NULL, 'XXX', 'Ciputra World Surabaya - The Vertu', 0.00, 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:46', '2018-10-18 23:15:46', NULL, 1, NULL, NULL, NULL, NULL, 5087, NULL),
(78, 2, NULL, NULL, 'NULL', 'Barsa City Yogyakarta (Ruko)', 0.00, 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:46', '2018-10-18 23:15:46', NULL, 1, NULL, NULL, NULL, NULL, 5097, NULL),
(79, 2, NULL, NULL, 'NULL', 'Barsa City Yogyakarta (Non Ruko)', 0.00, 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:46', '2018-10-18 23:15:46', NULL, 1, NULL, NULL, NULL, NULL, 5098, NULL),
(80, 2, NULL, NULL, 'XXX', 'CitraLand Vittorio Wiyung Surabaya', 0.00, 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:46', '2018-10-18 23:15:46', NULL, 1, NULL, NULL, NULL, NULL, 5101, NULL),
(81, 2, NULL, NULL, 'XXX', 'Citraland Gama City Medan', 0.00, 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 23:15:46', '2018-10-18 23:15:46', NULL, 1, NULL, NULL, NULL, NULL, 5103, NULL),
(82, 2, NULL, 184, 'PTD', 'Proyek Dummy 1', 50000.00, 'Depok', '14356', '081364770433', '081364770433', 'ptd@ciputra.com', NULL, '2018-10-29 20:35:49', '2018-10-30 22:53:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 30000);

SET IDENTITY_INSERT "projects" OFF;

--
-- Dumping data for table "project_pts"
--

SET IDENTITY_INSERT "project_pts" ON ;
INSERT INTO "project_pts" ("id", "pt_id", "project_id", "created_at", "updated_at", "deleted_at", "created_by", "updated_by", "deleted_by", "inactive_at", "inactive_by", "projectpt_id", "description") VALUES
(1, 1, 1, '2018-10-19 00:06:14', '2018-10-19 00:06:14', NULL, 1, NULL, NULL, NULL, NULL, 43, 'Migration from Erem based export at 18 Oct 2018'),
(2, 2, 1, '2018-10-19 00:06:14', '2018-10-19 00:06:14', NULL, 1, NULL, NULL, NULL, NULL, 44, 'Migration from Erem based export at 18 Oct 2018'),
(3, 3, 2, '2018-10-19 00:06:14', '2018-10-19 00:06:14', NULL, 1, NULL, NULL, NULL, NULL, 51, 'Migration from Erem based export at 18 Oct 2018'),
(4, 4, 2, '2018-10-19 00:06:14', '2018-10-19 00:06:14', NULL, 1, NULL, NULL, NULL, NULL, 52, 'Migration from Erem based export at 18 Oct 2018'),
(5, 5, 2, '2018-10-19 00:06:14', '2018-10-19 00:06:14', NULL, 1, NULL, NULL, NULL, NULL, 53, 'Migration from Erem based export at 18 Oct 2018'),
(6, 6, 2, '2018-10-19 00:06:14', '2018-10-19 00:06:14', NULL, 1, NULL, NULL, NULL, NULL, 54, 'Migration from Erem based export at 18 Oct 2018'),
(7, 7, 2, '2018-10-19 00:06:14', '2018-10-19 00:06:14', NULL, 1, NULL, NULL, NULL, NULL, 55, 'Migration from Erem based export at 18 Oct 2018'),
(8, 8, 2, '2018-10-19 00:06:14', '2018-10-19 00:06:14', NULL, 1, NULL, NULL, NULL, NULL, 56, 'Migration from Erem based export at 18 Oct 2018'),
(9, 9, 2, '2018-10-19 00:06:14', '2018-10-19 00:06:14', NULL, 1, NULL, NULL, NULL, NULL, 57, 'Migration from Erem based export at 18 Oct 2018'),
(10, 10, 2, '2018-10-19 00:06:14', '2018-10-19 00:06:14', NULL, 1, NULL, NULL, NULL, NULL, 58, 'Migration from Erem based export at 18 Oct 2018'),
(11, 11, 2, '2018-10-19 00:06:14', '2018-10-19 00:06:14', NULL, 1, NULL, NULL, NULL, NULL, 59, 'Migration from Erem based export at 18 Oct 2018'),
(12, NULL, 2, '2018-10-19 00:06:14', '2018-10-19 00:06:14', NULL, 1, NULL, NULL, NULL, NULL, 60, 'Migration from Erem based export at 18 Oct 2018'),
(13, NULL, 2, '2018-10-19 00:06:14', '2018-10-19 00:06:14', NULL, 1, NULL, NULL, NULL, NULL, 61, 'Migration from Erem based export at 18 Oct 2018'),
(14, 12, 2, '2018-10-19 00:06:14', '2018-10-19 00:06:14', NULL, 1, NULL, NULL, NULL, NULL, 62, 'Migration from Erem based export at 18 Oct 2018'),
(15, 13, 3, '2018-10-19 00:06:14', '2018-10-19 00:06:14', NULL, 1, NULL, NULL, NULL, NULL, 63, 'Migration from Erem based export at 18 Oct 2018'),
(16, 14, 3, '2018-10-19 00:06:14', '2018-10-19 00:06:14', NULL, 1, NULL, NULL, NULL, NULL, 64, 'Migration from Erem based export at 18 Oct 2018'),
(17, 15, 3, '2018-10-19 00:06:14', '2018-10-19 00:06:14', NULL, 1, NULL, NULL, NULL, NULL, 65, 'Migration from Erem based export at 18 Oct 2018'),
(18, 16, 3, '2018-10-19 00:06:14', '2018-10-19 00:06:14', NULL, 1, NULL, NULL, NULL, NULL, 66, 'Migration from Erem based export at 18 Oct 2018'),
(19, 17, 4, '2018-10-19 00:06:14', '2018-10-19 00:06:14', NULL, 1, NULL, NULL, NULL, NULL, 67, 'Migration from Erem based export at 18 Oct 2018'),
(20, 18, 3, '2018-10-19 00:06:14', '2018-10-19 00:06:14', NULL, 1, NULL, NULL, NULL, NULL, 68, 'Migration from Erem based export at 18 Oct 2018'),
(21, 19, 7, '2018-10-19 00:06:14', '2018-10-19 00:06:14', NULL, 1, NULL, NULL, NULL, NULL, 85, 'Migration from Erem based export at 18 Oct 2018'),
(22, 21, 55, '2018-10-19 00:06:14', '2018-10-19 00:06:14', NULL, 1, NULL, NULL, NULL, NULL, 2012, 'Migration from Erem based export at 18 Oct 2018'),
(23, 22, 8, '2018-10-19 00:06:14', '2018-10-19 00:06:14', NULL, 1, NULL, NULL, NULL, NULL, 2014, 'Migration from Erem based export at 18 Oct 2018'),
(24, 24, 66, '2018-10-19 00:06:14', '2018-10-19 00:06:14', NULL, 1, NULL, NULL, NULL, NULL, 2016, 'Migration from Erem based export at 18 Oct 2018'),
(25, 17, 3, '2018-10-19 00:06:14', '2018-10-19 00:06:14', NULL, 1, NULL, NULL, NULL, NULL, 2017, 'Migration from Erem based export at 18 Oct 2018'),
(26, 25, 60, '2018-10-19 00:06:14', '2018-10-19 00:06:14', NULL, 1, NULL, NULL, NULL, NULL, 2018, 'Migration from Erem based export at 18 Oct 2018'),
(27, 27, 61, '2018-10-19 00:06:14', '2018-10-19 00:06:14', NULL, 1, NULL, NULL, NULL, NULL, 2019, 'Migration from Erem based export at 18 Oct 2018'),
(28, 28, 13, '2018-10-19 00:06:14', '2018-10-19 00:06:14', NULL, 1, NULL, NULL, NULL, NULL, 2020, 'Migration from Erem based export at 18 Oct 2018'),
(29, 29, 26, '2018-10-19 00:06:14', '2018-10-19 00:06:14', NULL, 1, NULL, NULL, NULL, NULL, 2021, 'Migration from Erem based export at 18 Oct 2018'),
(30, 38, 71, '2018-10-19 00:06:15', '2018-10-19 00:06:15', NULL, 1, NULL, NULL, NULL, NULL, 2022, 'Migration from Erem based export at 18 Oct 2018'),
(31, 39, 62, '2018-10-19 00:06:15', '2018-10-19 00:06:15', NULL, 1, NULL, NULL, NULL, NULL, 2023, 'Migration from Erem based export at 18 Oct 2018'),
(32, 41, 69, '2018-10-19 00:06:15', '2018-10-19 00:06:15', NULL, 1, NULL, NULL, NULL, NULL, 2026, 'Migration from Erem based export at 18 Oct 2018'),
(33, 42, 69, '2018-10-19 00:06:15', '2018-10-19 00:06:15', NULL, 1, NULL, NULL, NULL, NULL, 2027, 'Migration from Erem based export at 18 Oct 2018'),
(34, 43, 69, '2018-10-19 00:06:15', '2018-10-19 00:06:15', NULL, 1, NULL, NULL, NULL, NULL, 2028, 'Migration from Erem based export at 18 Oct 2018'),
(35, 44, 69, '2018-10-19 00:06:15', '2018-10-19 00:06:15', NULL, 1, NULL, NULL, NULL, NULL, 2029, 'Migration from Erem based export at 18 Oct 2018'),
(36, 45, 69, '2018-10-19 00:06:15', '2018-10-19 00:06:15', NULL, 1, NULL, NULL, NULL, NULL, 2030, 'Migration from Erem based export at 18 Oct 2018'),
(37, 46, 68, '2018-10-19 00:06:15', '2018-10-19 00:06:15', NULL, 1, NULL, NULL, NULL, NULL, 2036, 'Migration from Erem based export at 18 Oct 2018'),
(38, 47, 70, '2018-10-19 00:06:15', '2018-10-19 00:06:15', NULL, 1, NULL, NULL, NULL, NULL, 2037, 'Migration from Erem based export at 18 Oct 2018'),
(39, 21, 58, '2018-10-19 00:06:15', '2018-10-19 00:06:15', NULL, 1, NULL, NULL, NULL, NULL, 2038, 'Migration from Erem based export at 18 Oct 2018'),
(40, 48, 9, '2018-10-19 00:06:15', '2018-10-19 00:06:15', NULL, 1, NULL, NULL, NULL, NULL, 3039, 'Migration from Erem based export at 18 Oct 2018'),
(41, 49, 10, '2018-10-19 00:06:15', '2018-10-19 00:06:15', NULL, 1, NULL, NULL, NULL, NULL, 3040, 'Migration from Erem based export at 18 Oct 2018'),
(42, NULL, 69, '2018-10-19 00:06:15', '2018-10-19 00:06:15', NULL, 1, NULL, NULL, NULL, NULL, 3069, 'Migration from Erem based export at 18 Oct 2018'),
(43, NULL, 69, '2018-10-19 00:06:15', '2018-10-19 00:06:15', NULL, 1, NULL, NULL, NULL, NULL, 3071, 'Migration from Erem based export at 18 Oct 2018'),
(44, 50, 20, '2018-10-19 00:06:15', '2018-10-19 00:06:15', NULL, 1, NULL, NULL, NULL, NULL, 3078, 'Migration from Erem based export at 18 Oct 2018'),
(45, 51, 51, '2018-10-19 00:06:15', '2018-10-19 00:06:15', NULL, 1, NULL, NULL, NULL, NULL, 3082, 'Migration from Erem based export at 18 Oct 2018'),
(46, 52, 28, '2018-10-19 00:06:15', '2018-10-19 00:06:15', NULL, 1, NULL, NULL, NULL, NULL, 3084, 'Migration from Erem based export at 18 Oct 2018'),
(47, 53, 16, '2018-10-19 00:06:15', '2018-10-19 00:06:15', NULL, 1, NULL, NULL, NULL, NULL, 3085, 'Migration from Erem based export at 18 Oct 2018'),
(48, 54, 22, '2018-10-19 00:06:15', '2018-10-19 00:06:15', NULL, 1, NULL, NULL, NULL, NULL, 3086, 'Migration from Erem based export at 18 Oct 2018'),
(49, 55, 14, '2018-10-19 00:06:15', '2018-10-19 00:06:15', NULL, 1, NULL, NULL, NULL, NULL, 3087, 'Migration from Erem based export at 18 Oct 2018'),
(50, 56, 25, '2018-10-19 00:06:15', '2018-10-19 00:06:15', NULL, 1, NULL, NULL, NULL, NULL, 3088, 'Migration from Erem based export at 18 Oct 2018'),
(51, 57, 64, '2018-10-19 00:06:15', '2018-10-19 00:06:15', NULL, 1, NULL, NULL, NULL, NULL, 3090, 'Migration from Erem based export at 18 Oct 2018'),
(52, 58, 16, '2018-10-19 00:06:15', '2018-10-19 00:06:15', NULL, 1, NULL, NULL, NULL, NULL, 3113, 'Migration from Erem based export at 18 Oct 2018'),
(53, 59, 16, '2018-10-19 00:06:15', '2018-10-19 00:06:15', NULL, 1, NULL, NULL, NULL, NULL, 3114, 'Migration from Erem based export at 18 Oct 2018'),
(54, 60, 36, '2018-10-19 00:06:15', '2018-10-19 00:06:15', NULL, 1, NULL, NULL, NULL, NULL, 3115, 'Migration from Erem based export at 18 Oct 2018'),
(55, 61, 15, '2018-10-19 00:06:15', '2018-10-19 00:06:15', NULL, 1, NULL, NULL, NULL, NULL, 3116, 'Migration from Erem based export at 18 Oct 2018'),
(56, 63, 61, '2018-10-19 00:06:15', '2018-10-19 00:06:15', NULL, 1, NULL, NULL, NULL, NULL, 4171, 'Migration from Erem based export at 18 Oct 2018'),
(57, 64, 76, '2018-10-19 00:06:15', '2018-10-19 00:06:15', NULL, 1, NULL, NULL, NULL, NULL, 4172, 'Migration from Erem based export at 18 Oct 2018'),
(58, 65, 22, '2018-10-19 00:06:15', '2018-10-19 00:06:15', NULL, 1, NULL, NULL, NULL, NULL, 4175, 'Migration from Erem based export at 18 Oct 2018'),
(59, NULL, 19, '2018-10-19 00:06:15', '2018-10-19 00:06:15', NULL, 1, NULL, NULL, NULL, NULL, 5178, 'Migration from Erem based export at 18 Oct 2018'),
(60, 66, 21, '2018-10-19 00:06:15', '2018-10-19 00:06:15', NULL, 1, NULL, NULL, NULL, NULL, 5179, 'Migration from Erem based export at 18 Oct 2018'),
(61, 67, 24, '2018-10-19 00:06:15', '2018-10-19 00:06:15', NULL, 1, NULL, NULL, NULL, NULL, 5180, 'Migration from Erem based export at 18 Oct 2018'),
(62, 68, 3, '2018-10-19 00:06:15', '2018-10-19 00:06:15', NULL, 1, NULL, NULL, NULL, NULL, 6186, 'Migration from Erem based export at 18 Oct 2018'),
(63, 69, 25, '2018-10-19 00:06:15', '2018-10-19 00:06:15', NULL, 1, NULL, NULL, NULL, NULL, 6188, 'Migration from Erem based export at 18 Oct 2018'),
(64, 70, 80, '2018-10-19 00:06:15', '2018-10-19 00:06:15', NULL, 1, NULL, NULL, NULL, NULL, 6190, 'Migration from Erem based export at 18 Oct 2018'),
(65, 71, 81, '2018-10-19 00:06:15', '2018-10-19 00:06:15', NULL, 1, NULL, NULL, NULL, NULL, 6194, 'Migration from Erem based export at 18 Oct 2018'),
(66, 1, 82, '2018-10-29 20:36:05', '2018-10-29 20:36:05', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL);

SET IDENTITY_INSERT "project_pts" OFF;

--
-- Dumping data for table "project_pt_users"
--

SET IDENTITY_INSERT "project_pt_users" ON ;
INSERT INTO "project_pt_users" ("id", "user_id", "pt_id", "project_id", "description", "created_at", "updated_at", "deleted_at", "created_by", "updated_by", "deleted_by", "inactive_at", "inactive_by", "project_pt") VALUES
(1, 1, 1, 105, NULL, '2018-07-04 23:47:01', '2018-08-15 09:26:42', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(4, 9, 4, 2076, NULL, '2018-07-31 00:00:00', '2018-07-31 00:00:00', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(5, 9, 4, 2075, NULL, '2018-07-31 16:26:32', '2018-07-31 16:26:32', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 9, 6, 2077, NULL, '2018-08-14 11:33:29', '2018-08-14 11:33:29', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 9, 1, 2078, NULL, '2018-08-14 16:47:03', '2018-08-14 16:47:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 9, 6, 2078, NULL, '2018-08-14 07:00:00', '2018-08-14 07:00:00', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(9, 1, 5, 2075, NULL, '2018-08-23 14:16:21', '2018-08-23 14:16:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 1, 1, 2079, NULL, '2018-09-03 13:13:38', '2018-09-03 13:13:38', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 9, 1, 2079, NULL, '2018-09-03 14:43:38', '2018-09-03 14:43:38', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 9, 1, 2080, NULL, '2018-09-05 22:52:14', '2018-09-05 22:52:14', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 1, 1, 2081, NULL, '2018-09-06 16:13:00', '2018-09-06 16:13:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 9, 1, 2081, NULL, '2018-09-06 16:37:02', '2018-09-06 16:37:02', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 1, 5, 2082, NULL, '2018-09-12 10:44:34', '2018-09-12 10:44:34', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 1, 1, 2082, NULL, '2018-09-12 11:27:31', '2018-09-12 11:27:31', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 9, 1, 2082, NULL, '2018-09-12 13:01:07', '2018-09-12 13:01:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 1, 7, 2083, NULL, '2018-09-18 13:48:30', '2018-09-18 13:48:30', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 9, 7, 2083, NULL, '2018-09-19 13:21:11', '2018-09-19 13:21:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 20, 8, 2084, NULL, '2018-09-21 10:47:30', '2018-09-21 10:47:30', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 1, 8, 2086, NULL, '2018-09-27 10:22:10', '2018-09-27 10:22:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 4, 8, 2086, NULL, '2018-09-27 10:22:28', '2018-09-27 10:22:28', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 21, 9, 2087, NULL, '2018-09-27 13:51:40', '2018-09-27 13:51:40', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 1, 2, 2075, NULL, '2018-10-01 10:16:47', '2018-10-01 10:16:47', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 1, 10, 2088, NULL, '2018-10-01 11:50:28', '2018-10-01 11:50:28', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 9, 2, 2075, NULL, '2018-10-01 16:44:18', '2018-10-01 16:44:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 1, 11, 2089, NULL, '2018-10-04 10:01:21', '2018-10-04 10:01:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 25, 2, 2075, NULL, '2018-10-07 05:28:03', '2018-10-07 05:28:03', NULL, NULL, NULL, NULL, NULL, NULL, 26),
(35, 26, 2, 2075, NULL, '2018-10-07 05:29:15', '2018-10-07 05:29:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(36, 27, 2, 2075, NULL, '2018-10-07 05:31:45', '2018-10-07 05:31:45', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(37, 28, 2, 2075, NULL, '2018-10-07 06:36:43', '2018-10-07 06:36:43', NULL, NULL, NULL, NULL, NULL, NULL, 26),
(38, 29, 2, 2075, NULL, '2018-10-07 07:04:12', '2018-10-07 07:04:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(39, 30, 2, 2075, NULL, '2018-10-07 20:05:33', '2018-10-07 20:05:33', NULL, NULL, NULL, NULL, NULL, NULL, 26),
(40, 24, 11, 2088, NULL, '2018-10-09 21:10:52', '2018-10-09 21:10:52', NULL, NULL, NULL, NULL, NULL, NULL, 66),
(43, 31, 24, 66, NULL, '2018-10-29 03:32:17', '2018-10-29 03:32:17', NULL, NULL, NULL, NULL, NULL, NULL, 24),
(44, 32, 1, 82, NULL, '2018-10-29 20:37:00', '2018-10-29 20:37:00', NULL, NULL, NULL, NULL, NULL, NULL, 66),
(45, 37, 48, 9, NULL, '2018-11-09 04:17:37', '2018-11-09 04:17:37', NULL, NULL, NULL, NULL, NULL, NULL, 40),
(47, 25, 1, 82, NULL, '2018-11-09 04:32:56', '2018-11-09 04:32:56', NULL, NULL, NULL, NULL, NULL, NULL, 66),
(48, 28, 1, 82, NULL, '2018-11-09 04:33:57', '2018-11-09 04:33:57', NULL, NULL, NULL, NULL, NULL, NULL, 66),
(49, 38, 1, 82, NULL, '2018-11-09 04:44:57', '2018-11-09 04:44:57', NULL, NULL, NULL, NULL, NULL, NULL, 66),
(50, 39, 1, 82, NULL, '2018-11-09 08:52:50', '2018-11-09 08:52:50', NULL, NULL, NULL, NULL, NULL, NULL, 66),
(51, 40, 1, 82, NULL, '2018-11-09 08:53:57', '2018-11-09 08:53:57', NULL, NULL, NULL, NULL, NULL, NULL, 66),
(52, 41, 1, 82, NULL, '2018-11-09 08:56:35', '2018-11-09 08:56:35', NULL, NULL, NULL, NULL, NULL, NULL, 66);

SET IDENTITY_INSERT "project_pt_users" OFF;

--
-- Dumping data for table "pts"
--

SET IDENTITY_INSERT "pts" ON ;
INSERT INTO "pts" ("id", "city_id", "code", "name", "address", "npwp", "phone", "rekening", "description", "created_at", "updated_at", "deleted_at", "created_by", "updated_by", "deleted_by", "inactive_at", "inactive_by", "pt_id") VALUES
(1, NULL, 'D01', 'PT. CIPUTRA INDAH', 'Jonggol', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:48', '2018-10-18 21:45:48', NULL, 1, NULL, NULL, NULL, NULL, 38),
(2, NULL, 'D02', 'PT. MITRAKUSUMA ERASEMESTA', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:48', '2018-10-18 21:45:48', NULL, 1, NULL, NULL, NULL, NULL, 39),
(3, NULL, 'G01', 'PT. CIPUTRA SURYA - KP', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:48', '2018-10-18 21:45:48', NULL, 1, NULL, NULL, NULL, NULL, 46),
(4, NULL, 'G02', 'PT. APTACITRA SURYA', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:48', '2018-10-18 21:45:48', NULL, 1, NULL, NULL, NULL, NULL, 47),
(5, NULL, 'G03', 'PT. BUMIINDAH PERMAITERANG', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:48', '2018-10-18 21:45:48', NULL, 1, NULL, NULL, NULL, NULL, 48),
(6, NULL, 'G04', 'PT. TAMANCITRA SURYAHIJAU', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:48', '2018-10-18 21:45:48', NULL, 1, NULL, NULL, NULL, NULL, 49),
(7, NULL, 'G05', 'PT. SUBURHIJAU JAYAMAKMUR', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:48', '2018-10-18 21:45:48', NULL, 1, NULL, NULL, NULL, NULL, 50),
(8, NULL, 'G06', 'PT. CAHAYAHIJAU TAMANINDAH', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:48', '2018-10-18 21:45:48', NULL, 1, NULL, NULL, NULL, NULL, 51),
(9, NULL, 'G07', 'PT. GALAXY ALAMSEMESTA', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:48', '2018-10-18 21:45:48', NULL, 1, NULL, NULL, NULL, NULL, 52),
(10, NULL, 'G08', 'PT. GALAXY CITRAPERDANA', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:48', '2018-10-18 21:45:48', NULL, 1, NULL, NULL, NULL, NULL, 53),
(11, NULL, 'G09', 'PT. CITRA BAHAGIA ELOK', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:48', '2018-10-18 21:45:48', NULL, 1, NULL, NULL, NULL, NULL, 54),
(12, NULL, 'G12', 'PT. CIPUTRA ELOK MITRA', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:48', '2018-10-18 21:45:48', NULL, 1, NULL, NULL, NULL, NULL, 57),
(13, NULL, 'H01', 'PT. CIPUTRA SPIRIT', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:48', '2018-10-18 21:45:48', NULL, 1, NULL, NULL, NULL, NULL, 58),
(14, NULL, 'H02', 'PT. SAPTAMULIA HIJAUBANGUN', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:49', '2018-10-18 21:45:49', NULL, 1, NULL, NULL, NULL, NULL, 59),
(15, NULL, 'H03', 'PT. INTILOKAHITA', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:49', '2018-10-18 21:45:49', NULL, 1, NULL, NULL, NULL, NULL, 60),
(16, NULL, 'H04', 'PT. KARYAPRIMA HIJAUSELARAS', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:49', '2018-10-18 21:45:49', NULL, 1, NULL, NULL, NULL, NULL, 61),
(17, NULL, 'I01', 'PT. SINAR BAHANA MULYA', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:49', '2018-10-18 21:45:49', NULL, 1, NULL, NULL, NULL, NULL, 62),
(18, NULL, 'I02', 'PT. CIPTAULUNG ARTAJAYA', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:49', '2018-10-18 21:45:49', NULL, 1, NULL, NULL, NULL, NULL, 63),
(19, NULL, 'S01', 'PT. WIN WIN REALTY', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:49', '2018-10-18 21:45:49', NULL, 1, NULL, NULL, NULL, NULL, 80),
(20, NULL, 'L01', 'PT. UAT Company', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:49', '2018-10-18 21:45:49', NULL, 1, NULL, NULL, NULL, NULL, 1091),
(21, NULL, 'ABP', 'PT. Asendabangun Persada', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:49', '2018-10-18 21:45:49', NULL, 1, NULL, NULL, NULL, NULL, 2088),
(22, NULL, 'CBC', 'JO CIPUTRA KARYA PANCASAKTI NUGRAHA', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:49', '2018-10-18 21:45:49', NULL, 1, NULL, NULL, NULL, NULL, 2092),
(23, NULL, 'XXX', 'PT. Kosong', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:49', '2018-10-18 21:45:49', NULL, 1, NULL, NULL, NULL, NULL, 2095),
(24, NULL, 'XXX', 'PT. Mitra Makmur Bagya', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:49', '2018-10-18 21:45:49', NULL, 1, NULL, NULL, NULL, NULL, 2096),
(25, NULL, 'XXX', 'PT. Ciputra Nugraha International', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:49', '2018-10-18 21:45:49', NULL, 1, NULL, NULL, NULL, NULL, 2097),
(26, NULL, 'XXX', 'PT. Kosong', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:49', '2018-10-18 21:45:49', NULL, 1, NULL, NULL, NULL, NULL, 2098),
(27, NULL, 'I15', 'PT. PANASIA GRIYA MEKARASRI', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:49', '2018-10-18 21:45:49', NULL, 1, NULL, NULL, NULL, NULL, 2099),
(28, NULL, 'XXX', 'PT. Central International Property', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:49', '2018-10-18 21:45:49', NULL, 1, NULL, NULL, NULL, NULL, 2100),
(29, NULL, 'XXX', 'JO CITRALAND PALU', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:49', '2018-10-18 21:45:49', NULL, 1, NULL, NULL, NULL, NULL, 2101),
(30, NULL, 'X01', 'PT. CIPUTRA INTERNASIONAL MDN', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:49', '2018-10-18 21:45:49', NULL, 1, NULL, NULL, NULL, NULL, 3122),
(31, NULL, 'X02', 'PT.CIPUTRA INTERNASIONAL ESC', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:49', '2018-10-18 21:45:49', NULL, 1, NULL, NULL, NULL, NULL, 3124),
(32, NULL, 'X03', 'PT.CIPUTRA INTERNASIONAL DK', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:49', '2018-10-18 21:45:49', NULL, 1, NULL, NULL, NULL, NULL, 3125),
(33, NULL, 'X04', 'PT.CIPUTRA BANGUN SELARAS', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:49', '2018-10-18 21:45:49', NULL, 1, NULL, NULL, NULL, NULL, 3126),
(34, NULL, 'X05', 'JO CIPUTRA KARYA PANCASAKTI NUGRAHA', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:49', '2018-10-18 21:45:49', NULL, 1, NULL, NULL, NULL, NULL, 3139),
(35, NULL, 'X07', 'PT.CIPUTRA KPSN', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:49', '2018-10-18 21:45:49', NULL, 1, NULL, NULL, NULL, NULL, 3140),
(36, NULL, 'XXX', 'PT. Panasia Griya Mekarasri', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:49', '2018-10-18 21:45:49', NULL, 1, NULL, NULL, NULL, NULL, 3141),
(37, NULL, 'XXX', 'PT. ANEKAINDAH MITRAPERKASA', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:49', '2018-10-18 21:45:49', NULL, 1, NULL, NULL, NULL, NULL, 3142),
(38, NULL, 'XXX', 'PT CIPUTRA INTERNASIONAL MANADO', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:49', '2018-10-18 21:45:49', NULL, 1, NULL, NULL, NULL, NULL, 3150),
(39, NULL, 'XXX', 'PT Citra Grand Khatulistiwa', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:49', '2018-10-18 21:45:49', NULL, 1, NULL, NULL, NULL, NULL, 3152),
(40, NULL, 'XXX', 'CIPUTRA INTERNATIONAL', '', '', '', '', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:49', '2018-10-18 21:45:49', NULL, 1, NULL, NULL, NULL, NULL, 3157),
(41, NULL, 'XXX', 'PT Ciputra Nusantara', '', '', '', '', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:49', '2018-10-18 21:45:49', NULL, 1, NULL, NULL, NULL, NULL, 3159),
(42, NULL, 'XXX', 'PT Cipglobal megahkarya', '', '', '', '', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:49', '2018-10-18 21:45:49', NULL, 1, NULL, NULL, NULL, NULL, 3160),
(43, NULL, 'XXX', 'PT Ciputra Internasional', '', '', '', '', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:49', '2018-10-18 21:45:49', NULL, 1, NULL, NULL, NULL, NULL, 3161),
(44, NULL, 'XXX', 'Ciputra Yasmin', '', '', '', '', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:49', '2018-10-18 21:45:49', NULL, 1, NULL, NULL, NULL, NULL, 3162),
(45, NULL, 'XXX', 'PT Citra Tirta Surabaya', '', '', '', '', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:49', '2018-10-18 21:45:49', NULL, 1, NULL, NULL, NULL, NULL, 3163),
(46, NULL, 'XXX', 'JO CIPUTRA YASMIN BUMI ASRI', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:49', '2018-10-18 21:45:49', NULL, 1, NULL, NULL, NULL, NULL, 3167),
(47, NULL, 'XXX', 'CIPUTRA TALLASA JO', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:49', '2018-10-18 21:45:49', NULL, 1, NULL, NULL, NULL, NULL, 3168),
(48, NULL, 'XXX', 'PT. CIPUTRA SYMPHONY', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:49', '2018-10-18 21:45:49', NULL, 1, NULL, NULL, NULL, NULL, 3172),
(49, NULL, 'XXX', 'PT. CIPUTRA ABADI KARYA', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:49', '2018-10-18 21:45:49', NULL, 1, NULL, NULL, NULL, NULL, 3173),
(50, NULL, 'XXXX', 'PT. CAHAYA FAJAR ABADITAMA', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:49', '2018-10-18 21:45:49', NULL, 1, NULL, NULL, NULL, NULL, 3190),
(51, NULL, 'XXX', 'JO Ciputra Mutiara Cemerlang Abadi', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:49', '2018-10-18 21:45:49', NULL, 1, NULL, NULL, NULL, NULL, 3192),
(52, NULL, 'XXX', 'PT. CIPUTRA INTERNASIONAL', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:49', '2018-10-18 21:45:49', NULL, 1, NULL, NULL, NULL, NULL, 3193),
(53, NULL, 'XXX', 'JO CIPUTRA KARYA UTAMA', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:49', '2018-10-18 21:45:49', NULL, 1, NULL, NULL, NULL, NULL, 3194),
(54, NULL, 'XXX', 'PT. CIPUTRA DEVELOPMENT TBK.', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:49', '2018-10-18 21:45:49', NULL, 1, NULL, NULL, NULL, NULL, 3195),
(55, NULL, 'XXX', 'JO Ciputra Sunindo Property', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:49', '2018-10-18 21:45:49', NULL, 1, NULL, NULL, NULL, NULL, 3196),
(56, NULL, 'XXX', 'PT. CIPUTRA ABDI PERSADA', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:49', '2018-10-18 21:45:49', NULL, 1, NULL, NULL, NULL, NULL, 3197),
(57, NULL, 'ACK', 'PT ARDAYA CIPTA KARSA', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:49', '2018-10-18 21:45:49', NULL, 1, NULL, NULL, NULL, NULL, 3198),
(58, NULL, 'XXX', 'PT. Ciputra Inti Pratama', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:49', '2018-10-18 21:45:49', NULL, 1, NULL, NULL, NULL, NULL, 3199),
(59, NULL, 'XXX', 'PT. Karya Utama Bumi', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:49', '2018-10-18 21:45:49', NULL, 1, NULL, NULL, NULL, NULL, 3200),
(60, NULL, 'XXX', 'JO. Ciputra Graha Terasama', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:49', '2018-10-18 21:45:49', NULL, 1, NULL, NULL, NULL, NULL, 3201),
(61, NULL, 'XXX', 'JO Sunindo Graha Utama', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:49', '2018-10-18 21:45:49', NULL, 1, NULL, NULL, NULL, NULL, 3202),
(62, NULL, 'XXX', 'JO CITRALAND MANADO', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:49', '2018-10-18 21:45:49', NULL, 1, NULL, NULL, NULL, NULL, 4219),
(63, NULL, 'XXX', 'PT. GRIYA MEKARASRI', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:50', '2018-10-18 21:45:50', NULL, 1, NULL, NULL, NULL, NULL, 4221),
(64, NULL, 'XXX', 'JO Ciputra Sunindo Prima Utama', 'Jl. Laksda Adi Sucipto km.7, Yogyakarta', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:50', '2018-10-18 21:45:50', NULL, 1, NULL, NULL, NULL, NULL, 4222),
(65, NULL, 'XXX', 'PT. TAMAN DAYU', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:50', '2018-10-18 21:45:50', NULL, 1, NULL, NULL, NULL, NULL, 4224),
(66, NULL, 'XXX', 'JO Ciputra Surya Sidoarjo Permai (JOCSSP)', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:50', '2018-10-18 21:45:50', NULL, 1, NULL, NULL, NULL, NULL, 4228),
(67, NULL, 'XXX', 'JO CIPUTRA KARYA MAKMUR', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:50', '2018-10-18 21:45:50', NULL, 1, NULL, NULL, NULL, NULL, 4229),
(68, NULL, 'XXX', 'PT. TUMBUHSEMANGAT NIAGACEMERLANG', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:50', '2018-10-18 21:45:50', NULL, 1, NULL, NULL, NULL, NULL, 5233),
(69, NULL, 'XXX', 'PT. GRAHA PELITA INDAH', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:50', '2018-10-18 21:45:50', NULL, 1, NULL, NULL, NULL, NULL, 5238),
(70, NULL, 'XXX', 'JO Ciputra Mentari Propertindo', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:50', '2018-10-18 21:45:50', NULL, 1, NULL, NULL, NULL, NULL, 6240),
(71, NULL, 'XXX', 'JO CIPUTRA KARYA PANCASAKTI NUSANTARA', 'NULL', 'NULL', 'NULL', 'NULL', 'Migration from Erem based export at 18 Oct 2018', '2018-10-18 21:45:50', '2018-10-18 21:45:50', NULL, 1, NULL, NULL, NULL, NULL, 6244);

SET IDENTITY_INSERT "pts" OFF;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
