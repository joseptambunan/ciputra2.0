-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2018 at 10:02 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ciputra2`
--

-- --------------------------------------------------------

--
-- Table structure for table `approvals`
--

CREATE TABLE `approvals` (
  `id` int(10) UNSIGNED NOT NULL,
  `approval_action_id` int(11) NOT NULL DEFAULT '1',
  `document_id` int(11) DEFAULT NULL,
  `document_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_nilai` decimal(64,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `approval_actions`
--

CREATE TABLE `approval_actions` (
  `id` int(10) UNSIGNED NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `approval_histories`
--

CREATE TABLE `approval_histories` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `approval_id` int(11) DEFAULT NULL,
  `document_type_id` int(11) DEFAULT NULL,
  `approval_action_id` int(11) NOT NULL DEFAULT '0',
  `no_urut` int(11) DEFAULT NULL,
  `durasi` int(11) DEFAULT NULL,
  `document_id` int(11) DEFAULT NULL,
  `document_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `approval_references`
--

CREATE TABLE `approval_references` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `pt_id` int(11) DEFAULT NULL,
  `document_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_urut` int(11) DEFAULT NULL,
  `min_value` double(15,2) DEFAULT NULL,
  `max_value` double(15,2) DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_action` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `id` int(10) UNSIGNED NOT NULL,
  `barangkeluar_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `pt_id` int(11) DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `asset_details`
--

CREATE TABLE `asset_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `asset_id` int(11) DEFAULT NULL,
  `barangkeluar_detail_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `asset_detail_items`
--

CREATE TABLE `asset_detail_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `asset_detail_id` int(11) DEFAULT NULL,
  `barangkeluar_detail_price_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `barcode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `asset_progresses`
--

CREATE TABLE `asset_progresses` (
  `id` int(10) UNSIGNED NOT NULL,
  `asset_id` int(11) DEFAULT NULL,
  `asset_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `templatepekerjaan_detail_id` int(11) DEFAULT NULL,
  `progresslapangan_percent` decimal(5,2) DEFAULT NULL,
  `progressbap_percent` decimal(5,2) DEFAULT NULL,
  `mulai_jadwal_date` date DEFAULT NULL,
  `selesai_jadwal_date` date DEFAULT NULL,
  `selesai_actual_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `asset_transactions`
--

CREATE TABLE `asset_transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `pt_id` int(11) DEFAULT NULL,
  `no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `asset_transaction_details`
--

CREATE TABLE `asset_transaction_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `asset_transaction_id` int(11) DEFAULT NULL,
  `asset_detail_item_id` int(11) DEFAULT NULL,
  `from_user_id` int(11) DEFAULT NULL,
  `from_department_id` int(11) DEFAULT NULL,
  `from_unit_sub_id` int(11) DEFAULT NULL,
  `from_location_id` int(11) DEFAULT NULL,
  `to_user_id` int(11) DEFAULT NULL,
  `to_department_id` int(11) DEFAULT NULL,
  `to_unit_sub_id` int(11) DEFAULT NULL,
  `to_location_id` int(11) DEFAULT NULL,
  `received_at` timestamp NULL DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `asset_transaction_detail_images`
--

CREATE TABLE `asset_transaction_detail_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `asset_transaction_detail_id` int(11) DEFAULT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL,
  `masking` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_id` int(11) NOT NULL,
  `estate_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `baps`
--

CREATE TABLE `baps` (
  `id` int(10) UNSIGNED NOT NULL,
  `spk_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `termin` int(11) DEFAULT NULL,
  `no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nilai_administrasi` double(15,2) DEFAULT NULL,
  `nilai_denda` double(15,2) DEFAULT NULL,
  `nilai_selisih` double(15,2) DEFAULT NULL,
  `nilai_talangan` decimal(11,2) DEFAULT NULL,
  `nilai_dp` decimal(11,2) DEFAULT NULL,
  `nilai_bap_1` bigint(24) DEFAULT NULL,
  `nilai_bap_2` bigint(24) DEFAULT NULL,
  `nilai_bap_3` bigint(24) DEFAULT NULL,
  `nilai_bap_dibayar` bigint(24) DEFAULT NULL,
  `nilai_retensi` bigint(24) NOT NULL,
  `nilai_pembayaran_saat_ini` int(24) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL,
  `spk_retensi_id` int(11) DEFAULT NULL,
  `percentage` decimal(5,2) DEFAULT NULL,
  `percentage_lapangan` int(11) DEFAULT NULL,
  `percentage_sebelumnyas` int(11) DEFAULT NULL,
  `status_voucher` int(11) NOT NULL,
  `nilai_spk` int(11) DEFAULT NULL,
  `nilai_vo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bap_details`
--

CREATE TABLE `bap_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `bap_id` int(11) DEFAULT NULL,
  `asset_id` int(11) DEFAULT NULL,
  `asset_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bap_detail_itempekerjaans`
--

CREATE TABLE `bap_detail_itempekerjaans` (
  `id` int(10) UNSIGNED NOT NULL,
  `bap_detail_id` int(11) DEFAULT NULL,
  `spkvo_unit_id` int(11) DEFAULT NULL,
  `itempekerjaan_id` int(11) DEFAULT NULL,
  `terbayar_percent` double(15,6) DEFAULT NULL,
  `lapangan_percent` double(15,6) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bap_goodreceive_potongans`
--

CREATE TABLE `bap_goodreceive_potongans` (
  `id` int(10) UNSIGNED NOT NULL,
  `head_id` int(11) DEFAULT NULL,
  `head_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `voucher_id` int(11) DEFAULT NULL,
  `coa_id` int(11) DEFAULT NULL,
  `nilai` double(15,2) DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bap_pphs`
--

CREATE TABLE `bap_pphs` (
  `id` int(10) UNSIGNED NOT NULL,
  `bap_id` int(11) DEFAULT NULL,
  `coa_id` int(11) DEFAULT NULL,
  `percent` decimal(5,2) DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `barangkeluars`
--

CREATE TABLE `barangkeluars` (
  `id` int(10) UNSIGNED NOT NULL,
  `permintaanbarang_id` int(11) DEFAULT NULL,
  `confirmed_by_warehouseman` int(11) DEFAULT NULL,
  `confirmed_by_requester` int(11) DEFAULT NULL,
  `approval_status_id` int(11) DEFAULT NULL,
  `no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `barangkeluar_details`
--

CREATE TABLE `barangkeluar_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `barangkeluar_id` int(11) DEFAULT NULL,
  `permintaanbarang_detail_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `warehouse_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `barangkeluar_detail_prices`
--

CREATE TABLE `barangkeluar_detail_prices` (
  `id` int(10) UNSIGNED NOT NULL,
  `barangkeluar_detail_id` int(11) DEFAULT NULL,
  `inventory_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` double(15,2) DEFAULT NULL,
  `ppn` decimal(5,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `barangmasuks`
--

CREATE TABLE `barangmasuks` (
  `id` int(10) UNSIGNED NOT NULL,
  `purchaseorder_id` int(11) DEFAULT NULL,
  `sumber_id` int(11) DEFAULT NULL,
  `sumber_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `confirmed_by_warehouseman` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `confirmed_by_requester` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `confirmed_by_warehouseman_at` timestamp NULL DEFAULT NULL,
  `confirmed_by_requester_at` timestamp NULL DEFAULT NULL,
  `approval_status_id` int(11) NOT NULL DEFAULT '0',
  `no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `barangmasuk_details`
--

CREATE TABLE `barangmasuk_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `barangmasuk_id` int(11) DEFAULT NULL,
  `purchaseorder_detail_id` int(11) DEFAULT NULL,
  `goodreceive_detail_id` int(11) DEFAULT NULL,
  `warehouse_id` int(11) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `quantity` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double(15,2) DEFAULT NULL,
  `ppn` decimal(5,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `barangreturs`
--

CREATE TABLE `barangreturs` (
  `id` int(10) UNSIGNED NOT NULL,
  `goodreceive_id` int(11) NOT NULL,
  `no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `ditahan` double(15,2) NOT NULL DEFAULT '0.00',
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `barangretur_details`
--

CREATE TABLE `barangretur_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `barangretur_id` int(11) NOT NULL,
  `goodreceive_detail_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` double(15,2) DEFAULT NULL,
  `ppn` decimal(5,2) DEFAULT NULL,
  `pph` decimal(5,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bloks`
--

CREATE TABLE `bloks` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `project_kawasan_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `luas` double(10,2) DEFAULT '1.00',
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL,
  `kode` varchar(21) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `budgets`
--

CREATE TABLE `budgets` (
  `id` int(10) UNSIGNED NOT NULL,
  `pt_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `project_kawasan_id` int(11) DEFAULT NULL,
  `no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL,
  `status_active` int(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `budget_carry_overs`
--

CREATE TABLE `budget_carry_overs` (
  `id` int(11) NOT NULL,
  `spk_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL,
  `budget_tahunan_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `budget_details`
--

CREATE TABLE `budget_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `budget_id` int(11) DEFAULT NULL,
  `itempekerjaan_id` int(11) DEFAULT NULL,
  `nilai` double(15,2) DEFAULT NULL,
  `volume` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `satuan` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT 'ls',
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `budget_drafts`
--

CREATE TABLE `budget_drafts` (
  `id` int(11) NOT NULL,
  `no` text NOT NULL,
  `budget_parent_id` int(11) DEFAULT NULL,
  `workorder_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL,
  `inactive_by` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `budget_draft_details`
--

CREATE TABLE `budget_draft_details` (
  `id` int(11) NOT NULL,
  `budget_draft_id` int(11) DEFAULT NULL,
  `itempekerjaan_id` int(11) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL,
  `volume` int(11) DEFAULT NULL,
  `satuan` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `budget_groups`
--

CREATE TABLE `budget_groups` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `budget_periodes`
--

CREATE TABLE `budget_periodes` (
  `id` int(10) UNSIGNED NOT NULL,
  `budget_id` int(11) DEFAULT NULL,
  `tahun` int(11) DEFAULT NULL,
  `itempekerjaan_id` int(11) DEFAULT NULL,
  `volume` int(11) DEFAULT NULL,
  `satuan` int(11) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `budget_tahunans`
--

CREATE TABLE `budget_tahunans` (
  `id` int(10) UNSIGNED NOT NULL,
  `budget_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun_anggaran` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `budget_tahunan_details`
--

CREATE TABLE `budget_tahunan_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `budget_tahunan_id` int(11) DEFAULT NULL,
  `itempekerjaan_id` int(11) DEFAULT NULL,
  `nilai` double(15,2) DEFAULT NULL,
  `volume` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `satuan` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_overbudget` decimal(5,2) DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `budget_tahunan_detailtemplates`
--

CREATE TABLE `budget_tahunan_detailtemplates` (
  `id` int(10) UNSIGNED NOT NULL,
  `budget_id` int(11) DEFAULT NULL,
  `template_id` int(11) DEFAULT NULL,
  `itempekerjaan_id` int(11) DEFAULT NULL,
  `volume` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `satuan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nilai` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `budget_tahunan_periodes`
--

CREATE TABLE `budget_tahunan_periodes` (
  `id` int(10) UNSIGNED NOT NULL,
  `budget_id` int(11) DEFAULT NULL,
  `bulan` int(11) DEFAULT NULL,
  `itempekerjaan_id` int(11) DEFAULT NULL,
  `volume` int(11) DEFAULT NULL,
  `satuan` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nilai` double(24,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL,
  `januari` float DEFAULT NULL,
  `februari` float DEFAULT NULL,
  `maret` float DEFAULT NULL,
  `april` float DEFAULT NULL,
  `mei` float DEFAULT NULL,
  `juni` float DEFAULT NULL,
  `juli` float DEFAULT NULL,
  `agustus` float DEFAULT NULL,
  `september` float DEFAULT NULL,
  `oktober` float DEFAULT NULL,
  `november` float DEFAULT NULL,
  `desember` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `budget_tahunan_templates`
--

CREATE TABLE `budget_tahunan_templates` (
  `id` int(10) UNSIGNED NOT NULL,
  `budget_id` int(11) DEFAULT NULL,
  `template_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `budget_type_details`
--

CREATE TABLE `budget_type_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `budget_id` int(11) DEFAULT NULL,
  `template_id` int(11) DEFAULT NULL,
  `itempekerjaan_id` int(11) DEFAULT NULL,
  `volume` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `satuan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nilai` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_to` int(11) NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(10) UNSIGNED NOT NULL,
  `province_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zipcode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coas`
--

CREATE TABLE `coas` (
  `id` int(10) UNSIGNED NOT NULL,
  `subholding` int(11) DEFAULT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coa_department`
--

CREATE TABLE `coa_department` (
  `coa_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cost_reports`
--

CREATE TABLE `cost_reports` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `project_kawasan_id` int(11) DEFAULT NULL,
  `spk_id` int(11) DEFAULT NULL,
  `itempekerjaan` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL,
  `department` int(11) DEFAULT NULL,
  `progress_lapangan` double(5,2) DEFAULT NULL,
  `progress_bap` double(5,2) DEFAULT NULL,
  `nilai` double(15,2) DEFAULT NULL,
  `rekanan` int(11) DEFAULT NULL,
  `rekanan_type` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `department_supports`
--

CREATE TABLE `department_supports` (
  `id` int(10) UNSIGNED NOT NULL,
  `workorder_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `department_support_details`
--

CREATE TABLE `department_support_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `department_support_id` int(11) DEFAULT NULL,
  `pic_support` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `document_types`
--

CREATE TABLE `document_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `head_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `escrows`
--

CREATE TABLE `escrows` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(32) NOT NULL DEFAULT '1',
  `total_nilai` double(15,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forums`
--

CREATE TABLE `forums` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `topic` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `forum_comments`
--

CREATE TABLE `forum_comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `forum_id` int(11) NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `forum_images`
--

CREATE TABLE `forum_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `forum_id` int(11) NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `globalsettings`
--

CREATE TABLE `globalsettings` (
  `id` int(10) UNSIGNED NOT NULL,
  `parameter` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `goodreceives`
--

CREATE TABLE `goodreceives` (
  `id` int(10) UNSIGNED NOT NULL,
  `purchaseorder_id` int(11) DEFAULT NULL,
  `approval_status_id` int(11) DEFAULT NULL,
  `no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `is_downpayment` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `goodreceive_details`
--

CREATE TABLE `goodreceive_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `goodreceive_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `satuan_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` double(15,2) DEFAULT NULL,
  `ppn` decimal(5,2) DEFAULT NULL,
  `pph` decimal(5,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `group_items`
--

CREATE TABLE `group_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `group_privileges`
--

CREATE TABLE `group_privileges` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_group_id` int(11) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `add` tinyint(1) NOT NULL DEFAULT '1',
  `edit` tinyint(1) NOT NULL DEFAULT '1',
  `delete` tinyint(1) NOT NULL DEFAULT '1',
  `view` tinyint(1) NOT NULL DEFAULT '1',
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `group_tahapans`
--

CREATE TABLE `group_tahapans` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hpp_development_costs`
--

CREATE TABLE `hpp_development_costs` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `hpp_dev_cost_reports`
--

CREATE TABLE `hpp_dev_cost_reports` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `project_kawasan_id` int(11) DEFAULT NULL,
  `itempekerjaan` int(11) DEFAULT NULL,
  `budget_awal` varchar(24) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `budget_tahun` varchar(24) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kontrak_total` varchar(24) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kontrak_tahun` varchar(24) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `progress_lapangan` varchar(24) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `progress_bap` varchar(24) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bap_terbayar_total` varchar(24) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bap_terbayar_tahun` varchar(24) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `saldo_budget_awal` varchar(24) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `saldo_budget_tahun` varchar(24) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `saldo_kontrak_total` varchar(24) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `group_cost` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `hpp_dev_cost_summary_reports`
--

CREATE TABLE `hpp_dev_cost_summary_reports` (
  `id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `project_kawasan_id` int(11) DEFAULT NULL,
  `efisiensi` int(11) DEFAULT NULL,
  `luas_netto` double(15,2) DEFAULT NULL,
  `luas_bruto` double(15,2) DEFAULT NULL,
  `total_budget` double(24,2) DEFAULT NULL,
  `hpp_netto` double(15,2) DEFAULT NULL,
  `hpp_bruto` double(15,2) DEFAULT NULL,
  `total_kontrak` double(24,2) DEFAULT NULL,
  `hpp_kontrak_netto` double(15,2) DEFAULT NULL,
  `hpp_kontrak_bruto` double(15,2) DEFAULT NULL,
  `total_kontrak_terbayar` double(24,2) DEFAULT NULL,
  `hpp_realisasi_netto` double(15,2) DEFAULT NULL,
  `hpp_realisasi_bruto` double(15,2) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `delete_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `inactive_by` int(11) DEFAULT NULL,
  `delete_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hpp_updates`
--

CREATE TABLE `hpp_updates` (
  `id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `nilai_budget` varchar(32) DEFAULT NULL,
  `luas_book` decimal(15,2) DEFAULT NULL,
  `luas_erem` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `netto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hpp_update_details`
--

CREATE TABLE `hpp_update_details` (
  `id` int(11) NOT NULL,
  `hpp_update_id` int(11) DEFAULT NULL,
  `budget_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

CREATE TABLE `inventories` (
  `id` int(10) UNSIGNED NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `rekanan_id` int(11) DEFAULT NULL,
  `warehouse_id` int(11) DEFAULT NULL,
  `sumber_id` int(11) DEFAULT NULL,
  `sumber_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `quantity_terpakai` int(11) DEFAULT NULL,
  `price` double(15,2) DEFAULT NULL,
  `description` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory_corrections`
--

CREATE TABLE `inventory_corrections` (
  `id` int(10) UNSIGNED NOT NULL,
  `no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory_correction_details`
--

CREATE TABLE `inventory_correction_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `inventory_correction_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `satuan_id` int(11) NOT NULL,
  `quantity_app` int(11) DEFAULT NULL,
  `quantity_fisik` int(11) DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory_transfers`
--

CREATE TABLE `inventory_transfers` (
  `id` int(10) UNSIGNED NOT NULL,
  `warehouse_id_from` int(11) DEFAULT NULL,
  `warehouse_id_to` int(11) DEFAULT NULL,
  `sender` int(11) DEFAULT NULL,
  `receiver` int(11) DEFAULT NULL,
  `approval_status_id` int(11) DEFAULT NULL,
  `no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `send_at` timestamp NULL DEFAULT NULL,
  `received_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory_transfer_details`
--

CREATE TABLE `inventory_transfer_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `inventory_transfer_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `itempekerjaans`
--

CREATE TABLE `itempekerjaans` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `group_cost` int(11) DEFAULT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tag` int(11) NOT NULL DEFAULT '0',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ppn` decimal(5,2) NOT NULL DEFAULT '0.00',
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL,
  `coa_ppn` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `escrow_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `itempekerjaan_coas`
--

CREATE TABLE `itempekerjaan_coas` (
  `id` int(10) UNSIGNED NOT NULL,
  `itempekerjaan_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `coa_id` int(11) DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `itempekerjaan_details`
--

CREATE TABLE `itempekerjaan_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `itempekerjaan_id` int(11) DEFAULT NULL,
  `nilai` double(15,2) NOT NULL DEFAULT '0.00',
  `satuan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `volume` double(10,2) NOT NULL DEFAULT '0.00',
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `itempekerjaan_progresses`
--

CREATE TABLE `itempekerjaan_progresses` (
  `id` int(11) NOT NULL,
  `item_pekerjaan_id` int(11) NOT NULL,
  `termyn` int(11) DEFAULT NULL,
  `percentage` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(10) UNSIGNED NOT NULL,
  `item_category_id` int(11) DEFAULT NULL,
  `default_warehouse_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `satuan_warning` tinyint(1) NOT NULL DEFAULT '0',
  `stock_min` int(11) NOT NULL,
  `is_inventory` tinyint(1) NOT NULL DEFAULT '0',
  `is_consumable` tinyint(1) NOT NULL DEFAULT '1',
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_categories`
--

CREATE TABLE `item_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL,
  `itempekerjaan_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_category_user`
--

CREATE TABLE `item_category_user` (
  `item_category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_pekerjaan_subs`
--

CREATE TABLE `item_pekerjaan_subs` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `item_prices`
--

CREATE TABLE `item_prices` (
  `id` int(10) UNSIGNED NOT NULL,
  `item_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `price_kecil` double(15,2) NOT NULL,
  `price_besar` double(15,2) NOT NULL,
  `matauang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kurs` double(15,2) NOT NULL,
  `volume` int(11) NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_satuans`
--

CREATE TABLE `item_satuans` (
  `id` int(10) UNSIGNED NOT NULL,
  `item_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `konversi` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_templates`
--

CREATE TABLE `item_templates` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `satuan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(10) UNSIGNED NOT NULL,
  `city_id` int(11) NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mappingperusahaans`
--

CREATE TABLE `mappingperusahaans` (
  `id` int(10) UNSIGNED NOT NULL,
  `pt_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `division_id` int(11) DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mou_items`
--

CREATE TABLE `mou_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `rekanan_supp_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_satuan_id` int(11) NOT NULL,
  `price_kecil` double(15,2) NOT NULL,
  `price_besar` double(15,2) NOT NULL,
  `matauang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kurs` double(15,2) NOT NULL,
  `volume` int(11) NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengajuanbiayas`
--

CREATE TABLE `pengajuanbiayas` (
  `id` int(10) UNSIGNED NOT NULL,
  `budget_id` int(11) DEFAULT NULL,
  `no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `butuh_date` date DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengajuanbiaya_details`
--

CREATE TABLE `pengajuanbiaya_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `itempekerjaan_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `nilai` double(15,2) DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permintaanbarangs`
--

CREATE TABLE `permintaanbarangs` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `pt_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `spk_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permintaanbarang_details`
--

CREATE TABLE `permintaanbarang_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `permintaanbarang_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `is_inventarisasi` tinyint(1) NOT NULL DEFAULT '0',
  `quantity` int(11) DEFAULT NULL,
  `butuh_date` date DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peruntukans`
--

CREATE TABLE `peruntukans` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `piutangs`
--

CREATE TABLE `piutangs` (
  `id` int(10) UNSIGNED NOT NULL,
  `rekanan_id` int(11) DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `pt_id` int(11) DEFAULT NULL,
  `no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `nilai` double(15,2) DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `piutang_pembayarans`
--

CREATE TABLE `piutang_pembayarans` (
  `id` int(10) UNSIGNED NOT NULL,
  `piutang_id` int(11) DEFAULT NULL,
  `sumber_id` int(11) DEFAULT NULL,
  `sumber_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nilai` double(15,2) DEFAULT NULL,
  `cara_pembayaran` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `piutang_project_rekanans`
--

CREATE TABLE `piutang_project_rekanans` (
  `id` int(10) UNSIGNED NOT NULL,
  `rekanan_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `max_percent` decimal(5,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(10) UNSIGNED NOT NULL,
  `subholding` int(11) DEFAULT NULL,
  `contactperson` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `luas` double(10,2) DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zipcode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_contactpeople`
--

CREATE TABLE `project_contactpeople` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT '1',
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_kawasans`
--

CREATE TABLE `project_kawasans` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `project_type_id` int(11) DEFAULT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lahan_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lahan_luas` double(15,2) DEFAULT NULL,
  `lahan_sellable` double(15,2) NOT NULL DEFAULT '0.00',
  `zipcode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_kawasan` tinyint(1) NOT NULL DEFAULT '1',
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL,
  `id_kawasan_erems` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_pt_users`
--

CREATE TABLE `project_pt_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `pt_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_types`
--

CREATE TABLE `project_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_type_group_id` int(11) DEFAULT NULL,
  `is_unit` tinyint(1) DEFAULT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_type_groups`
--

CREATE TABLE `project_type_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

CREATE TABLE `provinces` (
  `id` int(10) UNSIGNED NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pts`
--

CREATE TABLE `pts` (
  `id` int(10) UNSIGNED NOT NULL,
  `city_id` int(11) DEFAULT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `npwp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rekening` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pt_master_rekenings`
--

CREATE TABLE `pt_master_rekenings` (
  `id` int(11) NOT NULL,
  `pt_id` int(11) DEFAULT NULL,
  `bank_id` int(11) DEFAULT NULL,
  `rekening` varchar(64) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `inactive_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pt_rekenings`
--

CREATE TABLE `pt_rekenings` (
  `id` int(10) UNSIGNED NOT NULL,
  `rekanan_id` int(11) DEFAULT NULL,
  `bank_id` int(11) DEFAULT NULL,
  `nama_rekening` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchaseorders`
--

CREATE TABLE `purchaseorders` (
  `id` int(10) UNSIGNED NOT NULL,
  `purchaserequest_id` int(11) NOT NULL,
  `rekanan_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `matauang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kurs` double(15,3) NOT NULL,
  `term_pengiriman` int(11) NOT NULL,
  `cara_pembayaran` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchaseorder_cancellations`
--

CREATE TABLE `purchaseorder_cancellations` (
  `id` int(10) UNSIGNED NOT NULL,
  `purchaseorder_id` int(11) DEFAULT NULL,
  `no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchaseorder_cancellation_details`
--

CREATE TABLE `purchaseorder_cancellation_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `purchaseorder_cancellation_id` int(11) DEFAULT NULL,
  `purchaseorder_detail_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchaseorder_details`
--

CREATE TABLE `purchaseorder_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `purchaseorder_id` int(11) NOT NULL,
  `purchaserequest_detail_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `item_satuan_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `quantity_kecil` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `price_kecil` double(15,2) NOT NULL,
  `ppn` double(15,2) NOT NULL,
  `pph` int(11) NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchaseorder_dps`
--

CREATE TABLE `purchaseorder_dps` (
  `id` int(10) UNSIGNED NOT NULL,
  `purchaseorder_id` int(11) NOT NULL,
  `goodreceive_detail_id` int(11) NOT NULL,
  `goodreceive_detail_id_applied` int(11) NOT NULL,
  `date` date NOT NULL,
  `percentage` decimal(8,2) NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchaserequests`
--

CREATE TABLE `purchaserequests` (
  `id` int(10) UNSIGNED NOT NULL,
  `pt_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `butuh_date` date NOT NULL,
  `is_urgent` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchaserequest_cancellations`
--

CREATE TABLE `purchaserequest_cancellations` (
  `id` int(10) UNSIGNED NOT NULL,
  `purchaserequest_id` int(11) NOT NULL,
  `no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchaserequest_cancellation_details`
--

CREATE TABLE `purchaserequest_cancellation_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `purchaserequest_cancellation_id` int(11) NOT NULL,
  `purchaserequest_detail_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchaserequest_details`
--

CREATE TABLE `purchaserequest_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `purchaserequest_id` int(11) NOT NULL,
  `itempekerjaan_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_satuan_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `recomended_supplier` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rec_1` int(11) DEFAULT NULL,
  `rec_2` int(11) DEFAULT NULL,
  `rec_3` int(11) DEFAULT NULL,
  `delivery_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchaserequest_detail_penawarans`
--

CREATE TABLE `purchaserequest_detail_penawarans` (
  `id` int(10) UNSIGNED NOT NULL,
  `purchaserequest_detail_id` int(11) NOT NULL,
  `rekanan_id` int(11) NOT NULL,
  `price` double(15,3) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rabs`
--

CREATE TABLE `rabs` (
  `id` int(10) UNSIGNED NOT NULL,
  `workorder_id` int(11) DEFAULT NULL,
  `no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flow` int(11) NOT NULL DEFAULT '1',
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL,
  `budget_tahunan_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rab_pekerjaans`
--

CREATE TABLE `rab_pekerjaans` (
  `id` int(10) UNSIGNED NOT NULL,
  `rab_unit_id` int(11) DEFAULT NULL,
  `templatepekerjaan_detail_id` int(11) DEFAULT NULL,
  `itempekerjaan_id` int(11) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL,
  `volume` float(10,2) DEFAULT NULL,
  `satuan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ppn` decimal(5,2) NOT NULL DEFAULT '0.00',
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL,
  `is_pembangunan` tinyint(1) DEFAULT '1',
  `urutitem` int(11) DEFAULT NULL,
  `termin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rab_units`
--

CREATE TABLE `rab_units` (
  `id` int(10) UNSIGNED NOT NULL,
  `rab_id` int(11) DEFAULT NULL,
  `asset_id` int(11) DEFAULT NULL,
  `asset_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rekanans`
--

CREATE TABLE `rekanans` (
  `id` int(10) UNSIGNED NOT NULL,
  `rekanan_group_id` int(11) DEFAULT NULL,
  `kelas_id` int(11) DEFAULT NULL,
  `surat_kota` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surat_alamat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surat_kodepos` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cp_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cp_ktp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cp_ktp_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cp_jabatan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cp_whatsap` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cp_line` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `survey_status` int(11) NOT NULL DEFAULT '1',
  `survey_date` date DEFAULT NULL,
  `pkp_date` date DEFAULT NULL,
  `pkp_status` int(11) NOT NULL DEFAULT '1',
  `aktif_status` int(11) NOT NULL DEFAULT '2',
  `stujk` int(11) NOT NULL DEFAULT '1',
  `siup_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `siup_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tdp_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tdp_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gabung_date` date DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL,
  `ppn` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rekanan_groups`
--

CREATE TABLE `rekanan_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `npwp_kota` int(11) DEFAULT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pph_percent` int(11) DEFAULT NULL,
  `npwp_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `npwp_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `npwp_alamat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL,
  `coa_ppn` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rekanan_kelas`
--

CREATE TABLE `rekanan_kelas` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rekanan_penilaians`
--

CREATE TABLE `rekanan_penilaians` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `rekanan_id` int(11) DEFAULT NULL,
  `review_date` date DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rekanan_penilaian_details`
--

CREATE TABLE `rekanan_penilaian_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `rekanan_penilaian_id` int(11) DEFAULT NULL,
  `spk_id` int(11) DEFAULT NULL,
  `grade` int(11) DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rekanan_rekenings`
--

CREATE TABLE `rekanan_rekenings` (
  `id` int(10) UNSIGNED NOT NULL,
  `rekanan_id` int(11) DEFAULT NULL,
  `bank_id` int(11) DEFAULT NULL,
  `nama_rekening` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rekanan_supps`
--

CREATE TABLE `rekanan_supps` (
  `id` int(10) UNSIGNED NOT NULL,
  `rekanan_id` int(11) DEFAULT NULL,
  `pt_id` int(11) DEFAULT NULL,
  `penandatangan` int(11) DEFAULT NULL,
  `saksi` int(11) DEFAULT NULL,
  `supp_template_id` int(11) DEFAULT NULL,
  `no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `expired_at` date DEFAULT NULL,
  `printed_at` timestamp NULL DEFAULT NULL,
  `setuju_at` timestamp NULL DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rekanan_supp_vos`
--

CREATE TABLE `rekanan_supp_vos` (
  `id` int(10) UNSIGNED NOT NULL,
  `rekanan_supp_id` int(11) DEFAULT NULL,
  `no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `printed_at` timestamp NULL DEFAULT NULL,
  `setuju_at` timestamp NULL DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rekanan_types`
--

CREATE TABLE `rekanan_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `is_survey` tinyint(1) NOT NULL DEFAULT '1',
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rekanan_type_details`
--

CREATE TABLE `rekanan_type_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `rekanan_id` int(11) DEFAULT NULL,
  `rekanan_type_id` int(11) DEFAULT NULL,
  `kelas_spesialis` int(11) NOT NULL DEFAULT '0',
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `spks`
--

CREATE TABLE `spks` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `dp_nilai` int(11) DEFAULT '0',
  `rekanan_id` int(11) DEFAULT NULL,
  `tender_rekanan_id` int(11) DEFAULT NULL,
  `spk_type_id` int(11) DEFAULT NULL,
  `spk_parent_id` varchar(21) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `finish_date` date DEFAULT NULL,
  `fa_date` date DEFAULT NULL,
  `dp_percent` decimal(15,2) DEFAULT NULL,
  `denda_a` int(11) DEFAULT NULL,
  `denda_b` int(11) DEFAULT NULL,
  `matauang` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nilai_tukar` double(10,2) DEFAULT NULL,
  `jenis_kontrak` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `memo_cara_bayar` text COLLATE utf8mb4_unicode_ci,
  `memo_lingkup_kerja` text COLLATE utf8mb4_unicode_ci,
  `is_instruksilangsung` tinyint(1) NOT NULL DEFAULT '0',
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `carapembayaran` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL,
  `garansi_nilai` float(10,2) DEFAULT NULL,
  `coa_pph_default_id` int(11) DEFAULT NULL,
  `pic_id` int(11) DEFAULT NULL,
  `st_1` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `st_2` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `st_3` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `spkvo_units`
--

CREATE TABLE `spkvo_units` (
  `id` int(10) UNSIGNED NOT NULL,
  `spk_detail_id` int(11) DEFAULT NULL,
  `head_id` int(11) DEFAULT NULL,
  `head_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `templatepekerjaan_id` int(11) DEFAULT NULL,
  `unit_progress_id` int(11) DEFAULT NULL,
  `nilai` double(15,2) DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `volume` float(10,2) DEFAULT NULL,
  `satuan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ppn` decimal(5,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `spk_details`
--

CREATE TABLE `spk_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `spk_id` int(11) DEFAULT NULL,
  `asset_id` int(11) DEFAULT NULL,
  `asset_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `spk_pengembalians`
--

CREATE TABLE `spk_pengembalians` (
  `id` int(10) UNSIGNED NOT NULL,
  `spk_id` int(11) NOT NULL,
  `termin` int(11) NOT NULL,
  `percent` decimal(5,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `spk_po_pics`
--

CREATE TABLE `spk_po_pics` (
  `id` int(10) UNSIGNED NOT NULL,
  `head_id` int(11) DEFAULT NULL,
  `head_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `spk_retensis`
--

CREATE TABLE `spk_retensis` (
  `id` int(10) UNSIGNED NOT NULL,
  `spk_id` int(11) DEFAULT NULL,
  `bap_id` int(11) DEFAULT NULL,
  `percent` decimal(5,2) DEFAULT NULL,
  `hari` int(11) DEFAULT NULL,
  `is_progress` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `spk_termyns`
--

CREATE TABLE `spk_termyns` (
  `id` int(10) UNSIGNED NOT NULL,
  `spk_id` int(11) DEFAULT NULL,
  `termin` int(11) DEFAULT NULL,
  `progress` decimal(5,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `spk_termyn_details`
--

CREATE TABLE `spk_termyn_details` (
  `id` int(11) NOT NULL,
  `spk_termyn_id` int(11) NOT NULL,
  `item_pekerjaan_id` int(11) NOT NULL,
  `termyn` int(11) DEFAULT NULL,
  `percentage` decimal(5,2) DEFAULT '0.00',
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `spk_types`
--

CREATE TABLE `spk_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supp_revisions`
--

CREATE TABLE `supp_revisions` (
  `id` int(10) UNSIGNED NOT NULL,
  `rekanan_supp_id` int(11) DEFAULT NULL,
  `no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supp_templates`
--

CREATE TABLE `supp_templates` (
  `id` int(10) UNSIGNED NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suratinstruksis`
--

CREATE TABLE `suratinstruksis` (
  `id` int(10) UNSIGNED NOT NULL,
  `spk_id` int(11) DEFAULT NULL,
  `no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `perihal` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` mediumtext COLLATE utf8mb4_unicode_ci,
  `biaya` tinyint(1) NOT NULL DEFAULT '0',
  `is_tambahbiaya` tinyint(1) NOT NULL DEFAULT '0',
  `start_date` date DEFAULT NULL,
  `finish_date` date DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `surat_instruksi_items`
--

CREATE TABLE `surat_instruksi_items` (
  `id` int(11) NOT NULL,
  `surat_instruksi_unit_id` int(11) DEFAULT NULL,
  `itempekerjaan_id` int(11) DEFAULT NULL,
  `unit_progress_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL,
  `status` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `surat_instruksi_units`
--

CREATE TABLE `surat_instruksi_units` (
  `id` int(11) NOT NULL,
  `suratinstruksi_id` int(11) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sys_logs`
--

CREATE TABLE `sys_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `head_id` int(11) DEFAULT NULL,
  `head_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `log_fix_tag_id` int(11) NOT NULL DEFAULT '0',
  `action_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `templatepekerjaans`
--

CREATE TABLE `templatepekerjaans` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_type_id` int(11) NOT NULL,
  `tag` int(11) NOT NULL DEFAULT '0',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `luasbangunan` double(10,2) NOT NULL DEFAULT '0.00',
  `luas_tanah` double(11,2) NOT NULL,
  `hppbangunanpermeter` double(15,2) DEFAULT NULL,
  `is_sellable` tinyint(1) NOT NULL DEFAULT '1',
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `templatepekerjaan_details`
--

CREATE TABLE `templatepekerjaan_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `templatepekerjaan_id` int(11) DEFAULT NULL,
  `itempekerjaan_id` int(11) DEFAULT NULL,
  `group_tahapan_id` int(11) DEFAULT NULL,
  `group_item_id` int(11) DEFAULT NULL,
  `periode_id` int(11) DEFAULT NULL,
  `urutitem` int(11) DEFAULT NULL,
  `termin` int(11) DEFAULT NULL,
  `nilai` double(15,2) NOT NULL DEFAULT '0.00',
  `volume` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `satuan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bobot` decimal(5,2) DEFAULT NULL,
  `durasi` int(11) NOT NULL DEFAULT '0',
  `is_pembangunan` tinyint(1) NOT NULL DEFAULT '1',
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `templatepekerjaan_detail_items`
--

CREATE TABLE `templatepekerjaan_detail_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `templatepekerjaan_id` int(11) DEFAULT NULL,
  `itempekerjaan_id` int(11) DEFAULT NULL,
  `volume` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `satuan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `templatepekerjaan_detail_subs`
--

CREATE TABLE `templatepekerjaan_detail_subs` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `templatepekerjaan_lapangans`
--

CREATE TABLE `templatepekerjaan_lapangans` (
  `id` int(10) UNSIGNED NOT NULL,
  `group_item_id` int(11) DEFAULT NULL,
  `urutitem` int(11) DEFAULT NULL,
  `termin` int(11) DEFAULT NULL,
  `bobot` decimal(5,2) DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `templatepekerjaan_periodes`
--

CREATE TABLE `templatepekerjaan_periodes` (
  `id` int(10) UNSIGNED NOT NULL,
  `template_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `periode_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tenders`
--

CREATE TABLE `tenders` (
  `id` int(10) UNSIGNED NOT NULL,
  `rab_id` int(11) DEFAULT NULL,
  `kelas_id` int(11) DEFAULT NULL,
  `no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ambil_doc_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aanwijzing_date` date DEFAULT NULL,
  `penawaran1_date` date DEFAULT NULL,
  `klarifikasi1_date` date DEFAULT NULL,
  `penawaran2_date` date DEFAULT NULL,
  `klarifikasi2_date` date DEFAULT NULL,
  `penawaran3_date` date DEFAULT NULL,
  `recommendation_date` date DEFAULT NULL,
  `pengumuman_date` date DEFAULT NULL,
  `harga_dokumen` double(8,2) DEFAULT NULL,
  `sumber` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL,
  `final_date` datetime DEFAULT NULL,
  `durasi` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sifat_tender` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tender_documents`
--

CREATE TABLE `tender_documents` (
  `id` int(11) NOT NULL,
  `tender_id` int(11) DEFAULT NULL,
  `document_name` varchar(64) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tender_document_approvals`
--

CREATE TABLE `tender_document_approvals` (
  `id` int(11) NOT NULL,
  `tender_document_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` varchar(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tender_korespondensis`
--

CREATE TABLE `tender_korespondensis` (
  `id` int(10) UNSIGNED NOT NULL,
  `tender_rekanan_id` int(11) DEFAULT NULL,
  `no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `diundang_at` timestamp NULL DEFAULT NULL,
  `tempat_undangan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `due_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tender_menangs`
--

CREATE TABLE `tender_menangs` (
  `id` int(10) UNSIGNED NOT NULL,
  `tender_rekanan_id` int(11) DEFAULT NULL,
  `tender_unit_id` int(11) DEFAULT NULL,
  `asset_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asset_id` int(11) DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tender_menang_details`
--

CREATE TABLE `tender_menang_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `tender_menang_id` int(11) DEFAULT NULL,
  `templatepekerjaan_detail_id` int(11) DEFAULT NULL,
  `itempekerjaan_id` int(11) DEFAULT NULL,
  `nilai` double(15,2) DEFAULT NULL,
  `volume` float(10,2) DEFAULT NULL,
  `satuan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL,
  `is_pembangunan` tinyint(1) DEFAULT '1',
  `ppn` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tender_penawarans`
--

CREATE TABLE `tender_penawarans` (
  `id` int(10) UNSIGNED NOT NULL,
  `tender_rekanan_id` int(11) DEFAULT NULL,
  `no` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `file_attachment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tender_penawaran_details`
--

CREATE TABLE `tender_penawaran_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `tender_penawaran_id` int(11) DEFAULT NULL,
  `rab_pekerjaan_id` int(11) DEFAULT NULL,
  `keterangan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nilai` double(15,2) DEFAULT NULL,
  `volume` float(10,2) DEFAULT NULL,
  `satuan` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tender_purchase_korespondensis`
--

CREATE TABLE `tender_purchase_korespondensis` (
  `id` int(10) UNSIGNED NOT NULL,
  `tender_rekanan_id` int(11) DEFAULT NULL,
  `no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `diundang_at` timestamp NULL DEFAULT NULL,
  `tempat_undangan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `due_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tender_purchase_menangs`
--

CREATE TABLE `tender_purchase_menangs` (
  `id` int(10) UNSIGNED NOT NULL,
  `tender_rekanan_id` int(11) DEFAULT NULL,
  `tender_unit_id` int(11) DEFAULT NULL,
  `asset_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asset_id` int(11) DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tender_purchase_menang_details`
--

CREATE TABLE `tender_purchase_menang_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `tender_menang_id` int(11) DEFAULT NULL,
  `templatepekerjaan_detail_id` int(11) DEFAULT NULL,
  `itempekerjaan_id` int(11) DEFAULT NULL,
  `is_pembangunan` tinyint(1) NOT NULL DEFAULT '1',
  `nilai` double(15,2) DEFAULT NULL,
  `volume` int(11) DEFAULT NULL,
  `satuan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ppn` decimal(5,2) NOT NULL DEFAULT '0.00',
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tender_purchase_requests`
--

CREATE TABLE `tender_purchase_requests` (
  `id` int(10) UNSIGNED NOT NULL,
  `rab_id` int(11) DEFAULT NULL,
  `kelas_id` int(11) DEFAULT NULL,
  `no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ambil_doc_date` date DEFAULT NULL,
  `aanwijzing_date` date DEFAULT NULL,
  `penawaran1_date` date DEFAULT NULL,
  `klarifikasi1_date` date DEFAULT NULL,
  `penawaran2_date` date DEFAULT NULL,
  `klarifikasi2_date` date DEFAULT NULL,
  `penawaran3_date` date DEFAULT NULL,
  `final_date` date DEFAULT NULL,
  `recommendation_date` date DEFAULT NULL,
  `pengumuman_date` date DEFAULT NULL,
  `harga_dokumen` double(8,2) DEFAULT NULL,
  `sumber` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tender_purchase_request_details`
--

CREATE TABLE `tender_purchase_request_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `tender_id` int(11) DEFAULT NULL,
  `purchaserequest_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tender_purchase_request_items`
--

CREATE TABLE `tender_purchase_request_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `tender_purchase_request_id` int(11) DEFAULT NULL,
  `purchase_request_detail_id` int(11) DEFAULT NULL,
  `itempekerjaan` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_satuan_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `recomended_supplier` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tender_purchase_request_penawarans`
--

CREATE TABLE `tender_purchase_request_penawarans` (
  `id` int(10) UNSIGNED NOT NULL,
  `tender_purchase_request_rekanan_id` int(11) DEFAULT NULL,
  `no` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `file_attachment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tender_purchase_request_rekanans`
--

CREATE TABLE `tender_purchase_request_rekanans` (
  `id` int(10) UNSIGNED NOT NULL,
  `tender_purchase_request_id` int(11) DEFAULT NULL,
  `rekanan_id` int(11) DEFAULT NULL,
  `sipp_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sipp_date` date DEFAULT NULL,
  `doc_ambil_date` date DEFAULT NULL,
  `doc_ambil_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_pemenang` tinyint(1) NOT NULL DEFAULT '0',
  `doc_bayar_status` tinyint(1) NOT NULL DEFAULT '0',
  `doc_bayar_date` date DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tender_rekanans`
--

CREATE TABLE `tender_rekanans` (
  `id` int(10) UNSIGNED NOT NULL,
  `tender_id` int(11) DEFAULT NULL,
  `rekanan_id` int(11) DEFAULT NULL,
  `sipp_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sipp_date` date DEFAULT NULL,
  `doc_ambil_date` date DEFAULT NULL,
  `doc_ambil_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_pemenang` tinyint(1) NOT NULL DEFAULT '0',
  `doc_bayar_status` tinyint(1) NOT NULL DEFAULT '0',
  `doc_bayar_date` date DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL,
  `is_recomendasi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tender_units`
--

CREATE TABLE `tender_units` (
  `id` int(10) UNSIGNED NOT NULL,
  `tender_id` int(11) DEFAULT NULL,
  `rab_unit_id` int(11) DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(10) UNSIGNED NOT NULL,
  `blok_id` int(11) DEFAULT NULL,
  `templatepekerjaan_id` int(11) DEFAULT NULL,
  `pt_id` int(11) DEFAULT NULL,
  `peruntukan_id` int(11) DEFAULT NULL,
  `unit_arah_id` int(11) DEFAULT NULL,
  `unit_hadap_id` int(11) DEFAULT NULL,
  `unit_type_id` int(11) DEFAULT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanah_luas` double(10,2) DEFAULT NULL,
  `bangunan_luas` double(10,2) DEFAULT NULL,
  `is_sellable` tinyint(1) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '0',
  `tag_kategori` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'b',
  `st1_date` date DEFAULT NULL,
  `st2_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL,
  `id_erems` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `unit_arahs`
--

CREATE TABLE `unit_arahs` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `unit_progresses`
--

CREATE TABLE `unit_progresses` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `unit_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `itempekerjaan_id` int(11) DEFAULT NULL,
  `group_tahapan_id` int(11) DEFAULT NULL,
  `group_item_id` int(11) DEFAULT NULL,
  `urutitem` int(11) DEFAULT NULL,
  `termin` int(11) DEFAULT NULL,
  `nilai` double(15,2) NOT NULL DEFAULT '0.00',
  `volume` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `satuan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bobot` decimal(7,4) DEFAULT NULL,
  `durasi` int(11) NOT NULL DEFAULT '0',
  `is_pembangunan` tinyint(1) NOT NULL DEFAULT '1',
  `progresslapangan_percent` decimal(5,2) DEFAULT NULL,
  `progressbap_percent` decimal(5,2) DEFAULT NULL,
  `mulai_jadwal_date` date DEFAULT NULL,
  `selesai_jadwal_date` date DEFAULT NULL,
  `selesai_actual_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `unit_progress_details`
--

CREATE TABLE `unit_progress_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `unit_progress_id` int(11) DEFAULT NULL,
  `pic_rekanan` int(11) DEFAULT NULL,
  `pic_internal` int(11) DEFAULT NULL,
  `progress_date` date DEFAULT NULL,
  `progress_percent` decimal(5,2) DEFAULT NULL,
  `setuju_rekanan_at` timestamp NULL DEFAULT NULL,
  `setuju_internal_at` timestamp NULL DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `unit_progress_detail_pictures`
--

CREATE TABLE `unit_progress_detail_pictures` (
  `id` int(10) UNSIGNED NOT NULL,
  `unit_progress_detail_id` int(11) DEFAULT NULL,
  `picture` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `unit_subs`
--

CREATE TABLE `unit_subs` (
  `id` int(10) UNSIGNED NOT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `unit_types`
--

CREATE TABLE `unit_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `luas_bangunan` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `luas_tanah` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL,
  `listrik` int(11) DEFAULT NULL,
  `kode` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_login` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_rekanan` tinyint(1) NOT NULL DEFAULT '0',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `digitalsignature` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `mappingperusahaan_id` int(11) DEFAULT NULL,
  `user_jabatan_id` int(11) DEFAULT NULL,
  `user_level` int(11) DEFAULT NULL,
  `can_approve` tinyint(1) NOT NULL DEFAULT '0',
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL,
  `project_pt_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE `user_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_rekanan` tinyint(1) NOT NULL DEFAULT '0',
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_group_details`
--

CREATE TABLE `user_group_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_group_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_jabatans`
--

CREATE TABLE `user_jabatans` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_warehouse`
--

CREATE TABLE `user_warehouse` (
  `user_id` int(11) DEFAULT NULL,
  `warehouse_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vos`
--

CREATE TABLE `vos` (
  `id` int(10) UNSIGNED NOT NULL,
  `suratinstruksi_id` int(11) DEFAULT NULL,
  `suratinstruksi_unit_id` int(11) DEFAULT NULL,
  `no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `urutan` int(11) DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vouchers`
--

CREATE TABLE `vouchers` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(11) NOT NULL,
  `head_id` int(11) DEFAULT NULL,
  `head_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rekanan_id` int(11) DEFAULT NULL,
  `rekanan_rekening_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `pt_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_faktur` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempo_date` date DEFAULT NULL,
  `penyerahan_date` date DEFAULT NULL,
  `pencairan_date` date DEFAULT NULL,
  `is_out` tinyint(1) NOT NULL DEFAULT '1',
  `export_count` int(11) DEFAULT NULL,
  `posting` int(11) DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL,
  `spm_status` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `voucher_details`
--

CREATE TABLE `voucher_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `voucher_id` int(11) DEFAULT NULL,
  `coa_id` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `head_id` int(11) DEFAULT NULL,
  `head_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nilai` double(15,2) DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mata_uang` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kurs` double(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

CREATE TABLE `warehouses` (
  `id` int(10) UNSIGNED NOT NULL,
  `head_id` int(11) DEFAULT NULL,
  `head_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `capacity_volume` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `workorders`
--

CREATE TABLE `workorders` (
  `id` int(10) UNSIGNED NOT NULL,
  `budget_tahunan_id` int(11) DEFAULT NULL,
  `department_from` int(11) DEFAULT NULL,
  `department_to` int(11) DEFAULT NULL,
  `no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `durasi` int(11) NOT NULL DEFAULT '0',
  `satuan_waktu` int(11) NOT NULL DEFAULT '0',
  `estimasi_nilaiwo` double(15,2) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `posisi_dokumen` int(11) NOT NULL DEFAULT '1',
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL,
  `end_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `workorder_budget_details`
--

CREATE TABLE `workorder_budget_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `workorder_id` int(11) DEFAULT NULL,
  `itempekerjaan_id` int(11) DEFAULT NULL,
  `budget_tahunan_id` int(11) DEFAULT NULL,
  `tahun_anggaran` int(11) DEFAULT NULL,
  `volume` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `satuan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nilai` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `workorder_details`
--

CREATE TABLE `workorder_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `workorder_id` int(11) DEFAULT NULL,
  `asset_id` int(11) DEFAULT NULL,
  `asset_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `approvals`
--
ALTER TABLE `approvals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `approvals_document_id_index` (`document_id`),
  ADD KEY `approvals_approval_action_id_index` (`approval_action_id`);

--
-- Indexes for table `approval_actions`
--
ALTER TABLE `approval_actions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `approval_histories`
--
ALTER TABLE `approval_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `approval_histories_document_id_user_id_index` (`document_id`,`user_id`);

--
-- Indexes for table `approval_references`
--
ALTER TABLE `approval_references`
  ADD PRIMARY KEY (`id`),
  ADD KEY `approval_references_user_id_project_id_pt_id_index` (`user_id`,`project_id`,`pt_id`);

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asset_details`
--
ALTER TABLE `asset_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asset_detail_items`
--
ALTER TABLE `asset_detail_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asset_progresses`
--
ALTER TABLE `asset_progresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `asset_progresses_asset_id_index` (`asset_id`),
  ADD KEY `asset_progresses_templatepekerjaan_detail_id_index` (`templatepekerjaan_detail_id`);

--
-- Indexes for table `asset_transactions`
--
ALTER TABLE `asset_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asset_transaction_details`
--
ALTER TABLE `asset_transaction_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asset_transaction_detail_images`
--
ALTER TABLE `asset_transaction_detail_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `baps`
--
ALTER TABLE `baps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `baps_spk_id_index` (`spk_id`);

--
-- Indexes for table `bap_details`
--
ALTER TABLE `bap_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bap_details_bap_id_asset_id_index` (`bap_id`,`asset_id`);

--
-- Indexes for table `bap_detail_itempekerjaans`
--
ALTER TABLE `bap_detail_itempekerjaans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bap_detail_itempekerjaans_bap_detail_id_itempekerjaan_id_index` (`bap_detail_id`,`itempekerjaan_id`);

--
-- Indexes for table `bap_goodreceive_potongans`
--
ALTER TABLE `bap_goodreceive_potongans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bap_goodreceive_potongans_head_id_index` (`head_id`),
  ADD KEY `bap_goodreceive_potongans_head_type_index` (`head_type`),
  ADD KEY `bap_goodreceive_potongans_voucher_id_index` (`voucher_id`),
  ADD KEY `bap_goodreceive_potongans_coa_id_index` (`coa_id`);

--
-- Indexes for table `bap_pphs`
--
ALTER TABLE `bap_pphs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bap_pphs_bap_id_coa_id_index` (`bap_id`,`coa_id`);

--
-- Indexes for table `barangkeluars`
--
ALTER TABLE `barangkeluars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barangkeluar_details`
--
ALTER TABLE `barangkeluar_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barangkeluar_detail_prices`
--
ALTER TABLE `barangkeluar_detail_prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barangmasuks`
--
ALTER TABLE `barangmasuks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barangmasuk_details`
--
ALTER TABLE `barangmasuk_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barangreturs`
--
ALTER TABLE `barangreturs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barangreturs_goodreceive_id_index` (`goodreceive_id`);

--
-- Indexes for table `barangretur_details`
--
ALTER TABLE `barangretur_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barangretur_details_barangretur_id_index` (`barangretur_id`),
  ADD KEY `barangretur_details_goodreceive_detail_id_index` (`goodreceive_detail_id`);

--
-- Indexes for table `bloks`
--
ALTER TABLE `bloks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bloks_project_id_project_kawasan_id_index` (`project_id`,`project_kawasan_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `budgets`
--
ALTER TABLE `budgets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `budgets_pt_id_index` (`pt_id`),
  ADD KEY `budgets_department_id_index` (`department_id`),
  ADD KEY `budgets_project_id_index` (`project_id`),
  ADD KEY `budgets_parent_id_index` (`parent_id`),
  ADD KEY `budgets_project_kawasan_id_index` (`project_kawasan_id`);

--
-- Indexes for table `budget_carry_overs`
--
ALTER TABLE `budget_carry_overs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `budget_details`
--
ALTER TABLE `budget_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `budget_details_budget_id_itempekerjaan_id_index` (`budget_id`,`itempekerjaan_id`);

--
-- Indexes for table `budget_drafts`
--
ALTER TABLE `budget_drafts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `budget_draft_details`
--
ALTER TABLE `budget_draft_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `budget_groups`
--
ALTER TABLE `budget_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `budget_periodes`
--
ALTER TABLE `budget_periodes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `budget_periodes_budget_id_index` (`budget_id`),
  ADD KEY `budget_periodes_itempekerjaan_id_index` (`itempekerjaan_id`);

--
-- Indexes for table `budget_tahunans`
--
ALTER TABLE `budget_tahunans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `budget_tahunans_budget_id_parent_id_index` (`budget_id`,`parent_id`);

--
-- Indexes for table `budget_tahunan_details`
--
ALTER TABLE `budget_tahunan_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `budget_tahunan_details_budget_tahunan_id_itempekerjaan_id_index` (`budget_tahunan_id`,`itempekerjaan_id`);

--
-- Indexes for table `budget_tahunan_detailtemplates`
--
ALTER TABLE `budget_tahunan_detailtemplates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `budget_tahunan_detailtemplates_budget_id_index` (`budget_id`),
  ADD KEY `budget_tahunan_detailtemplates_template_id_index` (`template_id`),
  ADD KEY `budget_tahunan_detailtemplates_itempekerjaan_id_index` (`itempekerjaan_id`);

--
-- Indexes for table `budget_tahunan_periodes`
--
ALTER TABLE `budget_tahunan_periodes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `budget_tahunan_periodes_budget_id_index` (`budget_id`);

--
-- Indexes for table `budget_tahunan_templates`
--
ALTER TABLE `budget_tahunan_templates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `budget_tahunan_templates_budget_id_index` (`budget_id`),
  ADD KEY `budget_tahunan_templates_template_id_index` (`template_id`);

--
-- Indexes for table `budget_type_details`
--
ALTER TABLE `budget_type_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `budget_type_details_budget_id_index` (`budget_id`),
  ADD KEY `budget_type_details_template_id_index` (`template_id`),
  ADD KEY `budget_type_details_itempekerjaan_id_index` (`itempekerjaan_id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chats_user_id_user_to_index` (`user_id`,`user_to`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cities_province_id_index` (`province_id`);

--
-- Indexes for table `coas`
--
ALTER TABLE `coas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coas_subholding_index` (`subholding`);

--
-- Indexes for table `cost_reports`
--
ALTER TABLE `cost_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `itempekerjaan` (`itempekerjaan`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department_supports`
--
ALTER TABLE `department_supports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_supports_workorder_id_department_id_index` (`workorder_id`,`department_id`);

--
-- Indexes for table `department_support_details`
--
ALTER TABLE `department_support_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_support_details_department_support_id_index` (`department_support_id`),
  ADD KEY `department_support_details_pic_support_index` (`pic_support`);

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `document_types`
--
ALTER TABLE `document_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `escrows`
--
ALTER TABLE `escrows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `forums`
--
ALTER TABLE `forums`
  ADD PRIMARY KEY (`id`),
  ADD KEY `forums_user_id_index` (`user_id`);

--
-- Indexes for table `forum_comments`
--
ALTER TABLE `forum_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `forum_comments_forum_id_index` (`forum_id`);

--
-- Indexes for table `forum_images`
--
ALTER TABLE `forum_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `forum_images_forum_id_index` (`forum_id`);

--
-- Indexes for table `globalsettings`
--
ALTER TABLE `globalsettings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `goodreceives`
--
ALTER TABLE `goodreceives`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `goodreceive_details`
--
ALTER TABLE `goodreceive_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_items`
--
ALTER TABLE `group_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_privileges`
--
ALTER TABLE `group_privileges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_privileges_user_group_id_menu_id_index` (`user_group_id`,`menu_id`);

--
-- Indexes for table `group_tahapans`
--
ALTER TABLE `group_tahapans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hpp_development_costs`
--
ALTER TABLE `hpp_development_costs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hpp_dev_cost_reports`
--
ALTER TABLE `hpp_dev_cost_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hpp_dev_cost_summary_reports`
--
ALTER TABLE `hpp_dev_cost_summary_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hpp_updates`
--
ALTER TABLE `hpp_updates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `hpp_update_details`
--
ALTER TABLE `hpp_update_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hpp_update_id` (`hpp_update_id`),
  ADD KEY `budget_id` (`budget_id`);

--
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory_corrections`
--
ALTER TABLE `inventory_corrections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory_correction_details`
--
ALTER TABLE `inventory_correction_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inventory_correction_details_inventory_correction_id_index` (`inventory_correction_id`),
  ADD KEY `inventory_correction_details_item_id_index` (`item_id`),
  ADD KEY `inventory_correction_details_warehouse_id_index` (`warehouse_id`),
  ADD KEY `inventory_correction_details_satuan_id_index` (`satuan_id`);

--
-- Indexes for table `inventory_transfers`
--
ALTER TABLE `inventory_transfers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory_transfer_details`
--
ALTER TABLE `inventory_transfer_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `itempekerjaans`
--
ALTER TABLE `itempekerjaans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `itempekerjaans_parent_id_index` (`parent_id`),
  ADD KEY `itempekerjaans_department_id_index` (`department_id`);

--
-- Indexes for table `itempekerjaan_coas`
--
ALTER TABLE `itempekerjaan_coas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `itempekerjaan_coas_itempekerjaan_id_department_id_coa_id_index` (`itempekerjaan_id`,`department_id`,`coa_id`);

--
-- Indexes for table `itempekerjaan_details`
--
ALTER TABLE `itempekerjaan_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `itempekerjaan_details_itempekerjaan_id_index` (`itempekerjaan_id`);

--
-- Indexes for table `itempekerjaan_progresses`
--
ALTER TABLE `itempekerjaan_progresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_categories`
--
ALTER TABLE `item_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_pekerjaan_subs`
--
ALTER TABLE `item_pekerjaan_subs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_prices`
--
ALTER TABLE `item_prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_satuans`
--
ALTER TABLE `item_satuans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_templates`
--
ALTER TABLE `item_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mappingperusahaans`
--
ALTER TABLE `mappingperusahaans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mappingperusahaans_pt_id_department_id_index` (`pt_id`,`department_id`),
  ADD KEY `mappingperusahaans_division_id_index` (`division_id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mou_items`
--
ALTER TABLE `mou_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pengajuanbiayas`
--
ALTER TABLE `pengajuanbiayas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengajuanbiaya_details`
--
ALTER TABLE `pengajuanbiaya_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permintaanbarangs`
--
ALTER TABLE `permintaanbarangs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permintaanbarang_details`
--
ALTER TABLE `permintaanbarang_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peruntukans`
--
ALTER TABLE `peruntukans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `piutangs`
--
ALTER TABLE `piutangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `piutangs_rekanan_id_index` (`rekanan_id`),
  ADD KEY `piutangs_approved_by_index` (`approved_by`),
  ADD KEY `piutangs_project_id_index` (`project_id`),
  ADD KEY `piutangs_pt_id_index` (`pt_id`);

--
-- Indexes for table `piutang_pembayarans`
--
ALTER TABLE `piutang_pembayarans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `piutang_pembayarans_piutang_id_index` (`piutang_id`),
  ADD KEY `piutang_pembayarans_sumber_id_index` (`sumber_id`),
  ADD KEY `piutang_pembayarans_sumber_type_index` (`sumber_type`);

--
-- Indexes for table `piutang_project_rekanans`
--
ALTER TABLE `piutang_project_rekanans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `piutang_project_rekanans_rekanan_id_project_id_index` (`rekanan_id`,`project_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projects_contactperson_subholding_index` (`contactperson`,`subholding`),
  ADD KEY `projects_city_id_index` (`city_id`);

--
-- Indexes for table `project_contactpeople`
--
ALTER TABLE `project_contactpeople`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_contactpeople_project_id_user_id_index` (`project_id`,`user_id`);

--
-- Indexes for table `project_kawasans`
--
ALTER TABLE `project_kawasans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_kawasans_project_id_project_type_id_index` (`project_id`,`project_type_id`);

--
-- Indexes for table `project_pt_users`
--
ALTER TABLE `project_pt_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_pt_users_user_id_pt_id_project_id_index` (`user_id`,`pt_id`,`project_id`);

--
-- Indexes for table `project_types`
--
ALTER TABLE `project_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_types_project_type_group_id_index` (`project_type_group_id`);

--
-- Indexes for table `project_type_groups`
--
ALTER TABLE `project_type_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`id`),
  ADD KEY `provinces_country_id_index` (`country_id`);

--
-- Indexes for table `pts`
--
ALTER TABLE `pts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pts_city_id_index` (`city_id`);

--
-- Indexes for table `pt_master_rekenings`
--
ALTER TABLE `pt_master_rekenings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pt_id` (`pt_id`,`bank_id`);

--
-- Indexes for table `pt_rekenings`
--
ALTER TABLE `pt_rekenings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pt_rekenings_rekanan_id_bank_id_index` (`rekanan_id`,`bank_id`);

--
-- Indexes for table `purchaseorders`
--
ALTER TABLE `purchaseorders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchaseorder_cancellations`
--
ALTER TABLE `purchaseorder_cancellations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchaseorder_cancellation_details`
--
ALTER TABLE `purchaseorder_cancellation_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchaseorder_details`
--
ALTER TABLE `purchaseorder_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchaseorder_dps`
--
ALTER TABLE `purchaseorder_dps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchaserequests`
--
ALTER TABLE `purchaserequests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchaserequest_cancellations`
--
ALTER TABLE `purchaserequest_cancellations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchaserequest_cancellation_details`
--
ALTER TABLE `purchaserequest_cancellation_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchaserequest_details`
--
ALTER TABLE `purchaserequest_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchaserequest_detail_penawarans`
--
ALTER TABLE `purchaserequest_detail_penawarans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rabs`
--
ALTER TABLE `rabs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rabs_workorder_id_index` (`workorder_id`);

--
-- Indexes for table `rab_pekerjaans`
--
ALTER TABLE `rab_pekerjaans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rab_pekerjaans_rab_unit_id_index` (`rab_unit_id`),
  ADD KEY `rab_pekerjaans_templatepekerjaan_detail_id_index` (`templatepekerjaan_detail_id`);

--
-- Indexes for table `rab_units`
--
ALTER TABLE `rab_units`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rab_units_rab_id_asset_id_index` (`rab_id`,`asset_id`);

--
-- Indexes for table `rekanans`
--
ALTER TABLE `rekanans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rekanans_kelas_id_surat_kota_rekanan_group_id_index` (`kelas_id`,`surat_kota`,`rekanan_group_id`);

--
-- Indexes for table `rekanan_groups`
--
ALTER TABLE `rekanan_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rekanan_kelas`
--
ALTER TABLE `rekanan_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rekanan_penilaians`
--
ALTER TABLE `rekanan_penilaians`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rekanan_penilaians_project_id_rekanan_id_index` (`project_id`,`rekanan_id`);

--
-- Indexes for table `rekanan_penilaian_details`
--
ALTER TABLE `rekanan_penilaian_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rekanan_penilaian_details_rekanan_penilaian_id_index` (`rekanan_penilaian_id`),
  ADD KEY `rekanan_penilaian_details_spk_id_index` (`spk_id`);

--
-- Indexes for table `rekanan_rekenings`
--
ALTER TABLE `rekanan_rekenings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rekanan_rekenings_rekanan_id_bank_id_index` (`rekanan_id`,`bank_id`);

--
-- Indexes for table `rekanan_supps`
--
ALTER TABLE `rekanan_supps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rekanan_supps_rekanan_id_index` (`rekanan_id`),
  ADD KEY `rekanan_supps_pt_id_index` (`pt_id`),
  ADD KEY `rekanan_supps_penandatangan_index` (`penandatangan`),
  ADD KEY `rekanan_supps_saksi_index` (`saksi`),
  ADD KEY `rekanan_supps_supp_template_id_index` (`supp_template_id`);

--
-- Indexes for table `rekanan_supp_vos`
--
ALTER TABLE `rekanan_supp_vos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rekanan_supp_vos_rekanan_supp_id_index` (`rekanan_supp_id`);

--
-- Indexes for table `rekanan_types`
--
ALTER TABLE `rekanan_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rekanan_type_details`
--
ALTER TABLE `rekanan_type_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rekanan_type_details_rekanan_id_rekanan_type_id_index` (`rekanan_id`,`rekanan_type_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD UNIQUE KEY `sessions_id_unique` (`id`);

--
-- Indexes for table `spks`
--
ALTER TABLE `spks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `spks_project_id_index` (`project_id`),
  ADD KEY `spks_rekanan_id_index` (`rekanan_id`),
  ADD KEY `spks_tender_rekanan_id_index` (`tender_rekanan_id`),
  ADD KEY `spks_spk_type_id_index` (`spk_type_id`),
  ADD KEY `spks_spk_parent_id_index` (`spk_parent_id`);

--
-- Indexes for table `spkvo_units`
--
ALTER TABLE `spkvo_units`
  ADD PRIMARY KEY (`id`),
  ADD KEY `spkvo_units_spk_detail_id_index` (`spk_detail_id`),
  ADD KEY `spkvo_units_head_id_index` (`head_id`),
  ADD KEY `spkvo_units_head_type_index` (`head_type`),
  ADD KEY `spkvo_units_templatepekerjaan_id_index` (`templatepekerjaan_id`),
  ADD KEY `spkvo_units_unit_progress_id_index` (`unit_progress_id`);

--
-- Indexes for table `spk_details`
--
ALTER TABLE `spk_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `spk_details_spk_id_asset_id_index` (`spk_id`,`asset_id`);

--
-- Indexes for table `spk_pengembalians`
--
ALTER TABLE `spk_pengembalians`
  ADD PRIMARY KEY (`id`),
  ADD KEY `spk_pengembalians_spk_id_index` (`spk_id`);

--
-- Indexes for table `spk_po_pics`
--
ALTER TABLE `spk_po_pics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `spk_po_pics_head_id_index` (`head_id`),
  ADD KEY `spk_po_pics_head_type_index` (`head_type`),
  ADD KEY `spk_po_pics_user_id_index` (`user_id`);

--
-- Indexes for table `spk_retensis`
--
ALTER TABLE `spk_retensis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `spk_retensis_spk_id_index` (`spk_id`);

--
-- Indexes for table `spk_termyns`
--
ALTER TABLE `spk_termyns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `spk_termyns_spk_id_index` (`spk_id`);

--
-- Indexes for table `spk_termyn_details`
--
ALTER TABLE `spk_termyn_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `spk_types`
--
ALTER TABLE `spk_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supp_revisions`
--
ALTER TABLE `supp_revisions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supp_revisions_rekanan_supp_id_index` (`rekanan_supp_id`);

--
-- Indexes for table `supp_templates`
--
ALTER TABLE `supp_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suratinstruksis`
--
ALTER TABLE `suratinstruksis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `suratinstruksis_spk_id_index` (`spk_id`);

--
-- Indexes for table `surat_instruksi_items`
--
ALTER TABLE `surat_instruksi_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `suratinstruksi_id` (`surat_instruksi_unit_id`);

--
-- Indexes for table `surat_instruksi_units`
--
ALTER TABLE `surat_instruksi_units`
  ADD PRIMARY KEY (`id`),
  ADD KEY `suratinstruksi_id` (`suratinstruksi_id`);

--
-- Indexes for table `sys_logs`
--
ALTER TABLE `sys_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sys_logs_head_id_index` (`head_id`),
  ADD KEY `sys_logs_head_type_index` (`head_type`),
  ADD KEY `sys_logs_log_fix_tag_id_index` (`log_fix_tag_id`);

--
-- Indexes for table `templatepekerjaans`
--
ALTER TABLE `templatepekerjaans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `templatepekerjaan_details`
--
ALTER TABLE `templatepekerjaan_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `templatepekerjaan_details_templatepekerjaan_id_index` (`templatepekerjaan_id`),
  ADD KEY `templatepekerjaan_details_itempekerjaan_id_index` (`itempekerjaan_id`),
  ADD KEY `templatepekerjaan_details_group_tahapan_id_index` (`group_tahapan_id`),
  ADD KEY `templatepekerjaan_details_group_item_id_index` (`group_item_id`);

--
-- Indexes for table `templatepekerjaan_detail_items`
--
ALTER TABLE `templatepekerjaan_detail_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `templatepekerjaan_detail_items_templatepekerjaan_id_index` (`templatepekerjaan_id`),
  ADD KEY `templatepekerjaan_detail_items_itempekerjaan_id_index` (`itempekerjaan_id`);

--
-- Indexes for table `templatepekerjaan_detail_subs`
--
ALTER TABLE `templatepekerjaan_detail_subs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `templatepekerjaan_lapangans`
--
ALTER TABLE `templatepekerjaan_lapangans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `templatepekerjaan_lapangans_group_item_id_index` (`group_item_id`);

--
-- Indexes for table `templatepekerjaan_periodes`
--
ALTER TABLE `templatepekerjaan_periodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tenders`
--
ALTER TABLE `tenders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tenders_rab_id_kelas_id_index` (`rab_id`,`kelas_id`);

--
-- Indexes for table `tender_documents`
--
ALTER TABLE `tender_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tender_id` (`tender_id`);

--
-- Indexes for table `tender_document_approvals`
--
ALTER TABLE `tender_document_approvals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tender_document_id` (`tender_document_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tender_korespondensis`
--
ALTER TABLE `tender_korespondensis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tender_korespondensis_tender_rekanan_id_index` (`tender_rekanan_id`);

--
-- Indexes for table `tender_menangs`
--
ALTER TABLE `tender_menangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tender_menangs_tender_rekanan_id_index` (`tender_rekanan_id`),
  ADD KEY `tender_menangs_tender_unit_id_index` (`tender_unit_id`),
  ADD KEY `tender_menangs_asset_id_index` (`asset_id`);

--
-- Indexes for table `tender_menang_details`
--
ALTER TABLE `tender_menang_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tender_menang_details_tender_menang_id_index` (`tender_menang_id`),
  ADD KEY `tender_menang_details_templatepekerjaan_detail_id_index` (`templatepekerjaan_detail_id`),
  ADD KEY `tender_menang_details_itempekerjaan_id_index` (`itempekerjaan_id`);

--
-- Indexes for table `tender_penawarans`
--
ALTER TABLE `tender_penawarans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tender_penawarans_tender_rekanan_id_index` (`tender_rekanan_id`);

--
-- Indexes for table `tender_penawaran_details`
--
ALTER TABLE `tender_penawaran_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tender_penawaran_details_tender_penawaran_id_index` (`tender_penawaran_id`),
  ADD KEY `tender_penawaran_details_rab_pekerjaan_id_index` (`rab_pekerjaan_id`);

--
-- Indexes for table `tender_purchase_korespondensis`
--
ALTER TABLE `tender_purchase_korespondensis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tender_purchase_korespondensis_tender_rekanan_id_index` (`tender_rekanan_id`);

--
-- Indexes for table `tender_purchase_menangs`
--
ALTER TABLE `tender_purchase_menangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tender_purchase_menangs_tender_rekanan_id_index` (`tender_rekanan_id`),
  ADD KEY `tender_purchase_menangs_tender_unit_id_index` (`tender_unit_id`),
  ADD KEY `tender_purchase_menangs_asset_id_index` (`asset_id`);

--
-- Indexes for table `tender_purchase_menang_details`
--
ALTER TABLE `tender_purchase_menang_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tender_purchase_menang_details_tender_menang_id_index` (`tender_menang_id`),
  ADD KEY `tender_purchase_menang_details_templatepekerjaan_detail_id_index` (`templatepekerjaan_detail_id`),
  ADD KEY `tender_purchase_menang_details_itempekerjaan_id_index` (`itempekerjaan_id`);

--
-- Indexes for table `tender_purchase_requests`
--
ALTER TABLE `tender_purchase_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tender_purchase_request_details`
--
ALTER TABLE `tender_purchase_request_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tender_purchase_request_details_tender_id_index` (`tender_id`),
  ADD KEY `tender_purchase_request_details_purchaserequest_id_index` (`purchaserequest_id`);

--
-- Indexes for table `tender_purchase_request_items`
--
ALTER TABLE `tender_purchase_request_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tender_purchase_request_penawarans`
--
ALTER TABLE `tender_purchase_request_penawarans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tender_purchase_request_penawarans_tender_rekanan_id_index` (`tender_purchase_request_rekanan_id`);

--
-- Indexes for table `tender_purchase_request_rekanans`
--
ALTER TABLE `tender_purchase_request_rekanans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tender_rekanans`
--
ALTER TABLE `tender_rekanans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tender_rekanans_tender_id_rekanan_id_index` (`tender_id`,`rekanan_id`);

--
-- Indexes for table `tender_units`
--
ALTER TABLE `tender_units`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tender_units_tender_id_rab_unit_id_index` (`tender_id`,`rab_unit_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`),
  ADD KEY `units_blok_id_index` (`blok_id`),
  ADD KEY `units_templatepekerjaan_id_index` (`templatepekerjaan_id`),
  ADD KEY `units_pt_id_index` (`pt_id`),
  ADD KEY `units_peruntukan_id_index` (`peruntukan_id`),
  ADD KEY `units_unit_arah_id_index` (`unit_arah_id`),
  ADD KEY `units_unit_type_id_index` (`unit_type_id`);

--
-- Indexes for table `unit_arahs`
--
ALTER TABLE `unit_arahs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit_progresses`
--
ALTER TABLE `unit_progresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `unit_progresses_project_id_index` (`project_id`),
  ADD KEY `unit_progresses_unit_id_index` (`unit_id`),
  ADD KEY `itempekerjaan_id` (`itempekerjaan_id`);

--
-- Indexes for table `unit_progress_details`
--
ALTER TABLE `unit_progress_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `unit_progress_details_unit_progress_id_index` (`unit_progress_id`),
  ADD KEY `unit_progress_details_pic_rekanan_index` (`pic_rekanan`),
  ADD KEY `unit_progress_details_pic_internal_index` (`pic_internal`);

--
-- Indexes for table `unit_progress_detail_pictures`
--
ALTER TABLE `unit_progress_detail_pictures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `unit_progress_detail_pictures_unit_progress_detail_id_index` (`unit_progress_detail_id`);

--
-- Indexes for table `unit_subs`
--
ALTER TABLE `unit_subs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `unit_subs_unit_id_index` (`unit_id`);

--
-- Indexes for table `unit_types`
--
ALTER TABLE `unit_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_user_login_unique` (`user_login`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_details_user_id_mappingperusahaan_id_user_jabatan_id_index` (`user_id`,`mappingperusahaan_id`,`user_jabatan_id`);

--
-- Indexes for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_group_details`
--
ALTER TABLE `user_group_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_group_details_user_id_user_group_id_index` (`user_id`,`user_group_id`);

--
-- Indexes for table `user_jabatans`
--
ALTER TABLE `user_jabatans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vos`
--
ALTER TABLE `vos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vos_suratinstruksi_id_index` (`suratinstruksi_id`),
  ADD KEY `suratinstruksi_unit_id` (`suratinstruksi_unit_id`);

--
-- Indexes for table `vouchers`
--
ALTER TABLE `vouchers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vouchers_head_id_index` (`head_id`),
  ADD KEY `vouchers_head_type_index` (`head_type`),
  ADD KEY `vouchers_rekanan_id_index` (`rekanan_id`),
  ADD KEY `vouchers_department_id_index` (`department_id`),
  ADD KEY `vouchers_pt_id_index` (`pt_id`);

--
-- Indexes for table `voucher_details`
--
ALTER TABLE `voucher_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `voucher_details_voucher_id_index` (`voucher_id`),
  ADD KEY `voucher_details_coa_id_index` (`coa_id`),
  ADD KEY `voucher_details_head_id_index` (`head_id`),
  ADD KEY `voucher_details_head_type_index` (`head_type`);

--
-- Indexes for table `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `warehouses_head_id_city_id_index` (`head_id`,`city_id`);

--
-- Indexes for table `workorders`
--
ALTER TABLE `workorders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `workorders_budget_tahunan_id_index` (`budget_tahunan_id`),
  ADD KEY `workorders_department_to_index` (`department_to`),
  ADD KEY `workorders_department_from_index` (`department_from`);

--
-- Indexes for table `workorder_budget_details`
--
ALTER TABLE `workorder_budget_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `workorder_budget_details_workorder_id_index` (`workorder_id`),
  ADD KEY `workorder_budget_details_itempekerjaan_id_index` (`itempekerjaan_id`),
  ADD KEY `workorder_budget_details_budget_tahunan_id_index` (`budget_tahunan_id`);

--
-- Indexes for table `workorder_details`
--
ALTER TABLE `workorder_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `workorder_details_workorder_id_asset_id_index` (`workorder_id`,`asset_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `approvals`
--
ALTER TABLE `approvals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=436;

--
-- AUTO_INCREMENT for table `approval_actions`
--
ALTER TABLE `approval_actions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `approval_histories`
--
ALTER TABLE `approval_histories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=664;

--
-- AUTO_INCREMENT for table `approval_references`
--
ALTER TABLE `approval_references`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=335;

--
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `asset_details`
--
ALTER TABLE `asset_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `asset_detail_items`
--
ALTER TABLE `asset_detail_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `asset_progresses`
--
ALTER TABLE `asset_progresses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `asset_transactions`
--
ALTER TABLE `asset_transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `asset_transaction_details`
--
ALTER TABLE `asset_transaction_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `asset_transaction_detail_images`
--
ALTER TABLE `asset_transaction_detail_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `baps`
--
ALTER TABLE `baps`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1088;

--
-- AUTO_INCREMENT for table `bap_details`
--
ALTER TABLE `bap_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1023;

--
-- AUTO_INCREMENT for table `bap_detail_itempekerjaans`
--
ALTER TABLE `bap_detail_itempekerjaans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1401;

--
-- AUTO_INCREMENT for table `bap_goodreceive_potongans`
--
ALTER TABLE `bap_goodreceive_potongans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bap_pphs`
--
ALTER TABLE `bap_pphs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `barangkeluars`
--
ALTER TABLE `barangkeluars`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `barangkeluar_details`
--
ALTER TABLE `barangkeluar_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `barangkeluar_detail_prices`
--
ALTER TABLE `barangkeluar_detail_prices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `barangmasuks`
--
ALTER TABLE `barangmasuks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `barangmasuk_details`
--
ALTER TABLE `barangmasuk_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `barangreturs`
--
ALTER TABLE `barangreturs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `barangretur_details`
--
ALTER TABLE `barangretur_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bloks`
--
ALTER TABLE `bloks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `budgets`
--
ALTER TABLE `budgets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `budget_carry_overs`
--
ALTER TABLE `budget_carry_overs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `budget_details`
--
ALTER TABLE `budget_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1295;

--
-- AUTO_INCREMENT for table `budget_drafts`
--
ALTER TABLE `budget_drafts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `budget_draft_details`
--
ALTER TABLE `budget_draft_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `budget_groups`
--
ALTER TABLE `budget_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `budget_periodes`
--
ALTER TABLE `budget_periodes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `budget_tahunans`
--
ALTER TABLE `budget_tahunans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `budget_tahunan_details`
--
ALTER TABLE `budget_tahunan_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=899;

--
-- AUTO_INCREMENT for table `budget_tahunan_detailtemplates`
--
ALTER TABLE `budget_tahunan_detailtemplates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `budget_tahunan_periodes`
--
ALTER TABLE `budget_tahunan_periodes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `budget_tahunan_templates`
--
ALTER TABLE `budget_tahunan_templates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `budget_type_details`
--
ALTER TABLE `budget_type_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `coas`
--
ALTER TABLE `coas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `cost_reports`
--
ALTER TABLE `cost_reports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `department_supports`
--
ALTER TABLE `department_supports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `department_support_details`
--
ALTER TABLE `department_support_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `document_types`
--
ALTER TABLE `document_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `escrows`
--
ALTER TABLE `escrows`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `forums`
--
ALTER TABLE `forums`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forum_comments`
--
ALTER TABLE `forum_comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forum_images`
--
ALTER TABLE `forum_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `globalsettings`
--
ALTER TABLE `globalsettings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `goodreceives`
--
ALTER TABLE `goodreceives`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hpp_dev_cost_reports`
--
ALTER TABLE `hpp_dev_cost_reports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=901;

--
-- AUTO_INCREMENT for table `hpp_dev_cost_summary_reports`
--
ALTER TABLE `hpp_dev_cost_summary_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `hpp_updates`
--
ALTER TABLE `hpp_updates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hpp_update_details`
--
ALTER TABLE `hpp_update_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `itempekerjaans`
--
ALTER TABLE `itempekerjaans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=441;

--
-- AUTO_INCREMENT for table `itempekerjaan_coas`
--
ALTER TABLE `itempekerjaan_coas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `itempekerjaan_progresses`
--
ALTER TABLE `itempekerjaan_progresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2741;

--
-- AUTO_INCREMENT for table `mappingperusahaans`
--
ALTER TABLE `mappingperusahaans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `peruntukans`
--
ALTER TABLE `peruntukans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2090;

--
-- AUTO_INCREMENT for table `project_kawasans`
--
ALTER TABLE `project_kawasans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `project_pt_users`
--
ALTER TABLE `project_pt_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `provinces`
--
ALTER TABLE `provinces`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pts`
--
ALTER TABLE `pts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pt_master_rekenings`
--
ALTER TABLE `pt_master_rekenings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rabs`
--
ALTER TABLE `rabs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `rab_pekerjaans`
--
ALTER TABLE `rab_pekerjaans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=325;

--
-- AUTO_INCREMENT for table `rab_units`
--
ALTER TABLE `rab_units`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `rekanans`
--
ALTER TABLE `rekanans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=717;

--
-- AUTO_INCREMENT for table `rekanan_groups`
--
ALTER TABLE `rekanan_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=717;

--
-- AUTO_INCREMENT for table `spks`
--
ALTER TABLE `spks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5995;

--
-- AUTO_INCREMENT for table `spkvo_units`
--
ALTER TABLE `spkvo_units`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1603;

--
-- AUTO_INCREMENT for table `spk_details`
--
ALTER TABLE `spk_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1382;

--
-- AUTO_INCREMENT for table `spk_pengembalians`
--
ALTER TABLE `spk_pengembalians`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `spk_po_pics`
--
ALTER TABLE `spk_po_pics`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `spk_retensis`
--
ALTER TABLE `spk_retensis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `spk_termyns`
--
ALTER TABLE `spk_termyns`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=193;

--
-- AUTO_INCREMENT for table `spk_termyn_details`
--
ALTER TABLE `spk_termyn_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `spk_types`
--
ALTER TABLE `spk_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `suratinstruksis`
--
ALTER TABLE `suratinstruksis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `surat_instruksi_items`
--
ALTER TABLE `surat_instruksi_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `surat_instruksi_units`
--
ALTER TABLE `surat_instruksi_units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `templatepekerjaans`
--
ALTER TABLE `templatepekerjaans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `templatepekerjaan_details`
--
ALTER TABLE `templatepekerjaan_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `templatepekerjaan_detail_items`
--
ALTER TABLE `templatepekerjaan_detail_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `templatepekerjaan_detail_subs`
--
ALTER TABLE `templatepekerjaan_detail_subs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `templatepekerjaan_lapangans`
--
ALTER TABLE `templatepekerjaan_lapangans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `templatepekerjaan_periodes`
--
ALTER TABLE `templatepekerjaan_periodes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tenders`
--
ALTER TABLE `tenders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tender_documents`
--
ALTER TABLE `tender_documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tender_document_approvals`
--
ALTER TABLE `tender_document_approvals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tender_korespondensis`
--
ALTER TABLE `tender_korespondensis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `tender_menangs`
--
ALTER TABLE `tender_menangs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tender_menang_details`
--
ALTER TABLE `tender_menang_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;

--
-- AUTO_INCREMENT for table `tender_penawarans`
--
ALTER TABLE `tender_penawarans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;

--
-- AUTO_INCREMENT for table `tender_penawaran_details`
--
ALTER TABLE `tender_penawaran_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1607;

--
-- AUTO_INCREMENT for table `tender_rekanans`
--
ALTER TABLE `tender_rekanans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `tender_units`
--
ALTER TABLE `tender_units`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2687;

--
-- AUTO_INCREMENT for table `unit_arahs`
--
ALTER TABLE `unit_arahs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `unit_progresses`
--
ALTER TABLE `unit_progresses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1604;

--
-- AUTO_INCREMENT for table `unit_progress_details`
--
ALTER TABLE `unit_progress_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=649;

--
-- AUTO_INCREMENT for table `unit_types`
--
ALTER TABLE `unit_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `user_jabatans`
--
ALTER TABLE `user_jabatans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `vos`
--
ALTER TABLE `vos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=179;

--
-- AUTO_INCREMENT for table `voucher_details`
--
ALTER TABLE `voucher_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=452;

--
-- AUTO_INCREMENT for table `workorders`
--
ALTER TABLE `workorders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `workorder_budget_details`
--
ALTER TABLE `workorder_budget_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=316;

--
-- AUTO_INCREMENT for table `workorder_details`
--
ALTER TABLE `workorder_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
