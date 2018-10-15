-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 27, 2018 at 12:42 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


--
-- Database: `ciputraqs`
--

-- --------------------------------------------------------

--
-- Table structure for table `purchaseorders`
--

CREATE TABLE `purchaseorders` (
  `id` int(10) UNSIGNED NOT NULL,
  `tender_purchase_request_group_id` int(11) NOT NULL,
  `rekanan_id` int(11) NOT NULL,
  `location_id` int(11) DEFAULT NULL,
  `no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `matauang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kurs` double(15,3) NOT NULL,
  `term_pengiriman` int(11) DEFAULT NULL,
  `cara_pembayaran` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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

--
-- Dumping data for table `purchaseorders`
--

INSERT INTO `purchaseorders` (`id`, `tender_purchase_request_group_id`, `rekanan_id`, `location_id`, `no`, `date`, `matauang`, `kurs`, `term_pengiriman`, `cara_pembayaran`, `status`, `description`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`, `inactive_at`, `inactive_by`) VALUES
(1, 1, 4, NULL, '0001/PO/CD/IX/2018/CBD/DFT', '2018-09-25', 'IDR', 1.000, NULL, NULL, NULL, '-', '2018-09-25 09:08:51', '2018-09-25 09:08:51', NULL, 9, NULL, NULL, NULL, NULL),
(2, 1, 4, NULL, '0001/PO/CD/IX/2018/CBD/DFT', '2018-09-25', 'IDR', 1.000, NULL, NULL, NULL, '-', '2018-09-25 09:11:51', '2018-09-25 09:11:51', NULL, 9, NULL, NULL, NULL, NULL),
(3, 1, 4, NULL, '0001/PO/CD/IX/2018/CBD/DFT', '2018-09-25', 'IDR', 1.000, NULL, NULL, NULL, '-', '2018-09-25 09:23:22', '2018-09-25 09:23:22', NULL, 9, NULL, NULL, NULL, NULL),
(4, 1, 4, NULL, '0001/PO/CD/IX/2018/CBD/DFT', '2018-09-25', 'IDR', 1.000, NULL, NULL, NULL, '-', '2018-09-25 09:39:42', '2018-09-25 09:39:42', NULL, 9, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchaseorder_details`
--

CREATE TABLE `purchaseorder_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `purchaseorder_id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `brand_id` int(11) NOT NULL,
  `item_satuan_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `ppn` double(15,2) DEFAULT NULL,
  `pph` int(11) DEFAULT NULL,
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

--
-- Dumping data for table `purchaseorder_details`
--

INSERT INTO `purchaseorder_details` (`id`, `purchaseorder_id`, `item_id`, `brand_id`, `item_satuan_id`, `quantity`, `price`, `ppn`, `pph`, `description`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`, `inactive_at`, `inactive_by`) VALUES
(1, 1, 11, 6, 14, 400, 2900000, NULL, NULL, '\nSpesifikasi :', '2018-09-25 09:08:51', '2018-09-25 09:08:51', NULL, 9, NULL, NULL, NULL, NULL),
(2, 2, 11, 6, 14, 400, 2900000, NULL, NULL, '\nSpesifikasi :', '2018-09-25 09:11:51', '2018-09-25 09:11:51', NULL, 9, NULL, NULL, NULL, NULL),
(3, 3, 11, 6, 14, 400, 2900000, NULL, NULL, '\nSpesifikasi :', '2018-09-25 09:23:22', '2018-09-25 09:23:22', NULL, 9, NULL, NULL, NULL, NULL),
(4, 4, 11, 6, 14, 400, 2900000, NULL, NULL, '\nSpesifikasi :', '2018-09-25 09:39:42', '2018-09-25 09:39:42', NULL, 9, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchaseorder_term_pengiriman`
--

CREATE TABLE `purchaseorder_term_pengiriman` (
  `id` int(11) NOT NULL,
  `purchaseorder_detail_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `quantity` int(11) NOT NULL,
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
-- Table structure for table `purchaserequests`
--

CREATE TABLE `purchaserequests` (
  `id` int(10) UNSIGNED NOT NULL,
  `budget_tahunan_id` int(11) NOT NULL,
  `pt_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `butuh_date` date NOT NULL,
  `is_urgent` varchar(8) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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

--
-- Dumping data for table `purchaserequests`
--

INSERT INTO `purchaserequests` (`id`, `budget_tahunan_id`, `pt_id`, `department_id`, `location_id`, `no`, `date`, `butuh_date`, `is_urgent`, `description`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`, `inactive_at`, `inactive_by`) VALUES
(1, 13, 2, 2, 1, '0001/PR/CD/IX/2018/CBD/DFT', '2018-09-25', '2018-10-01', '0', 'Permintaan untuk pembuatan saluran air', '2018-09-25 07:26:20', '2018-09-25 07:26:20', NULL, 20, NULL, NULL, NULL, NULL),
(2, 13, 2, 2, 1, '0002/PR/CD/IX/2018/CBD/DFT', '2018-09-25', '2018-10-02', '0', 'pekerjaan jalan', '2018-09-25 07:36:09', '2018-09-25 07:36:09', NULL, 20, NULL, NULL, NULL, NULL),
(3, 13, 2, 2, 1, '0003/PR/CD/IX/2018/CBD/DFT', '2018-09-25', '2018-10-02', '0', 'pekerjaan jalan', '2018-09-25 07:39:13', '2018-09-25 07:39:13', NULL, 20, NULL, NULL, NULL, NULL),
(4, 13, 2, 2, 1, '0004/PR/CD/IX/2018/CBD/DFT', '2018-09-25', '2018-10-02', '0', 'pekerjaan jembatan', '2018-09-25 07:48:03', '2018-09-25 07:48:03', NULL, 20, NULL, NULL, NULL, NULL);

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

--
-- Dumping data for table `purchaserequest_details`
--

INSERT INTO `purchaserequest_details` (`id`, `purchaserequest_id`, `itempekerjaan_id`, `item_id`, `item_satuan_id`, `brand_id`, `recomended_supplier`, `quantity`, `description`, `rec_1`, `rec_2`, `rec_3`, `delivery_date`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`, `inactive_at`, `inactive_by`) VALUES
(1, 1, 97, 11, 14, 6, '3', 10, 'Semen Holcim 40Kg pcc', 16, 21, 4, '2018-10-01', '2018-09-25 07:26:20', '2018-09-25 07:26:20', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 2, 97, 13, 21, 5, '3', 15, '13 - Semen Gresik 40Kg', 20, 17, 13, '2018-10-02', '2018-09-25 07:36:09', '2018-09-25 07:36:09', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 3, 97, 11, 14, 5, '2', 5, '11 - Semen Holcim 40Kg', 18, 3, NULL, '2018-10-02', '2018-09-25 07:39:13', '2018-09-25 07:39:13', NULL, NULL, NULL, NULL, NULL, NULL),
(4, 4, 97, 11, 14, 5, '1', 12, '11 - Semen Holcim 40Kg', 18, NULL, NULL, '2018-10-02', '2018-09-25 07:48:03', '2018-09-25 07:48:03', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tender_purchase_requests`
--

CREATE TABLE `tender_purchase_requests` (
  `id` int(10) UNSIGNED NOT NULL,
  `tender_pr_groups_id` int(11) NOT NULL,
  `rab_id` int(11) DEFAULT NULL,
  `kelas_id` int(11) DEFAULT NULL,
  `no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aanwijzing_type` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aanwijzing_date` date DEFAULT NULL,
  `penawaran1_date` date DEFAULT NULL,
  `klarifikasi1_date` date DEFAULT NULL,
  `penawaran2_date` date DEFAULT NULL,
  `klarifikasi2_date` date DEFAULT NULL,
  `penawaran3_date` date DEFAULT NULL,
  `final_date` date DEFAULT NULL,
  `recommendation_date` date DEFAULT NULL,
  `pengumuman_date` date DEFAULT NULL,
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

--
-- Dumping data for table `tender_purchase_requests`
--

INSERT INTO `tender_purchase_requests` (`id`, `tender_pr_groups_id`, `rab_id`, `kelas_id`, `no`, `name`, `aanwijzing_type`, `aanwijzing_date`, `penawaran1_date`, `klarifikasi1_date`, `penawaran2_date`, `klarifikasi2_date`, `penawaran3_date`, `final_date`, `recommendation_date`, `pengumuman_date`, `sumber`, `description`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`, `inactive_at`, `inactive_by`) VALUES
(1, 1, 0, 1, '0001/TPR/CD/IX/2018/CBD/JGG', 'Tender pembelian sement 40Kg', 'Surat Cetak', '2018-09-28', '2018-10-01', '2018-10-01', '2018-10-06', '2018-10-01', '2018-10-10', '2018-10-10', '2018-10-10', '2018-10-10', '-', '-', '2018-09-25 08:09:56', '2018-09-25 08:09:56', NULL, 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tender_purchase_request_details`
--

CREATE TABLE `tender_purchase_request_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `tender_id` int(11) DEFAULT NULL,
  `purchaserequest_detail_id` int(11) DEFAULT NULL,
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
-- Table structure for table `tender_purchase_request_groups`
--

CREATE TABLE `tender_purchase_request_groups` (
  `id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `satuan_id` int(11) NOT NULL,
  `description` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tender_purchase_request_groups`
--

INSERT INTO `tender_purchase_request_groups` (`id`, `quantity`, `satuan_id`, `description`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`, `inactive_at`, `inactive_by`) VALUES
(1, 400, 16, '\nSpesifikasi :', '2018-09-25 00:42:02', '2018-09-25 00:42:02', NULL, 1, NULL, NULL, NULL, NULL),
(2, 680, 16, '\nSpesifikasi :', '2018-09-25 00:50:17', '2018-09-25 00:50:17', NULL, 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tender_purchase_request_group_details`
--

CREATE TABLE `tender_purchase_request_group_details` (
  `id` int(11) NOT NULL,
  `tender_purchase_request_groups_id` int(11) NOT NULL,
  `id_purchase_request_detail` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tender_purchase_request_group_details`
--

INSERT INTO `tender_purchase_request_group_details` (`id`, `tender_purchase_request_groups_id`, `id_purchase_request_detail`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`, `inactive_at`, `inactive_by`) VALUES
(1, 1, 1, '2018-09-25 00:42:02', '2018-09-25 00:42:02', NULL, 1, NULL, NULL, NULL, NULL),
(2, 2, 3, '2018-09-25 00:50:17', '2018-09-25 00:50:17', NULL, 1, NULL, NULL, NULL, NULL),
(3, 2, 4, '2018-09-25 00:50:17', '2018-09-25 00:50:17', NULL, 1, NULL, NULL, NULL, NULL);

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
  `tender_rekanan_id` int(11) DEFAULT NULL,
  `no` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `name_file` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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

--
-- Dumping data for table `tender_purchase_request_penawarans`
--

INSERT INTO `tender_purchase_request_penawarans` (`id`, `tender_rekanan_id`, `no`, `date`, `name_file`, `file_attachment`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`, `inactive_at`, `inactive_by`) VALUES
(1, 1, '0001/TPRP/CD/IX/2018/CBD/JGG', '2018-09-25', NULL, NULL, '2018-09-25 08:09:56', '2018-09-25 08:09:56', NULL, 1, NULL, NULL, NULL, NULL),
(2, 2, '0002/TPRP/CD/IX/2018/CBD/JGG', '2018-09-25', NULL, NULL, '2018-09-25 08:09:56', '2018-09-25 08:09:56', NULL, 1, NULL, NULL, NULL, NULL),
(3, 3, '0003/TPRP/CD/IX/2018/CBD/JGG', '2018-09-25', NULL, NULL, '2018-09-25 08:09:56', '2018-09-25 08:09:56', NULL, 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tender_purchase_request_penawarans_details`
--

CREATE TABLE `tender_purchase_request_penawarans_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `tender_penawaran_id` int(11) DEFAULT NULL,
  `rab_pekerjaan_id` int(11) DEFAULT NULL,
  `keterangan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nilai` double(15,2) DEFAULT NULL,
  `volume` float(10,2) DEFAULT NULL,
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
-- Dumping data for table `tender_purchase_request_penawarans_details`
--

INSERT INTO `tender_purchase_request_penawarans_details` (`id`, `tender_penawaran_id`, `rab_pekerjaan_id`, `keterangan`, `nilai`, `volume`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`, `inactive_at`, `inactive_by`) VALUES
(1, 1, 0, 'Penawaran 1', 3000000.00, NULL, '2018-09-25 08:09:56', '2018-09-25 08:09:56', NULL, 1, NULL, NULL, NULL, NULL),
(2, 1, 0, 'Penawaran 2', 2950000.00, NULL, '2018-09-25 08:09:56', '2018-09-25 08:09:56', NULL, 1, NULL, NULL, NULL, NULL),
(3, 1, 0, 'Penawaran 3', 1000000.00, NULL, '2018-09-25 08:09:56', '2018-09-25 08:09:56', NULL, 1, NULL, NULL, NULL, NULL),
(4, 2, 0, 'Penawaran 1', 3500000.00, NULL, '2018-09-25 08:09:56', '2018-09-25 08:09:56', NULL, 1, NULL, NULL, NULL, NULL),
(5, 2, 0, 'Penawaran 2', 2900000.00, NULL, '2018-09-25 08:09:56', '2018-09-25 08:09:56', NULL, 1, NULL, NULL, NULL, NULL),
(6, 2, 0, 'Penawaran 3', 2900000.00, NULL, '2018-09-25 08:09:56', '2018-09-25 08:09:56', NULL, 1, NULL, NULL, NULL, NULL),
(7, 3, 0, 'Penawaran 1', 2750000.00, NULL, '2018-09-25 08:09:56', '2018-09-25 08:09:56', NULL, 1, NULL, NULL, NULL, NULL),
(8, 3, 0, 'Penawaran 2', 2900000.00, NULL, '2018-09-25 08:09:56', '2018-09-25 08:09:56', NULL, 1, NULL, NULL, NULL, NULL),
(9, 3, 0, 'Penawaran 3', 2900000.00, NULL, '2018-09-25 08:09:56', '2018-09-25 08:09:56', NULL, 1, NULL, NULL, NULL, NULL);

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

--
-- Dumping data for table `tender_purchase_request_rekanans`
--

INSERT INTO `tender_purchase_request_rekanans` (`id`, `tender_purchase_request_id`, `rekanan_id`, `sipp_no`, `sipp_date`, `doc_ambil_date`, `doc_ambil_by`, `is_pemenang`, `doc_bayar_status`, `doc_bayar_date`, `description`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`, `inactive_at`, `inactive_by`) VALUES
(1, 1, 16, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, '2018-09-25 08:09:56', '2018-09-25 08:09:56', NULL, 1, NULL, NULL, NULL, NULL),
(2, 1, 21, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, '2018-09-25 08:09:56', '2018-09-25 08:09:56', NULL, 1, NULL, NULL, NULL, NULL),
(3, 1, 4, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, '2018-09-25 08:09:56', '2018-09-25 08:09:56', NULL, 1, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `purchaseorders`
--
ALTER TABLE `purchaseorders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchaseorder_details`
--
ALTER TABLE `purchaseorder_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchaseorder_term_pengiriman`
--
ALTER TABLE `purchaseorder_term_pengiriman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchaserequests`
--
ALTER TABLE `purchaserequests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchaserequest_details`
--
ALTER TABLE `purchaserequest_details`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `tender_purchase_request_details_purchaserequest_id_index` (`purchaserequest_detail_id`);

--
-- Indexes for table `tender_purchase_request_groups`
--
ALTER TABLE `tender_purchase_request_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tender_purchase_request_group_details`
--
ALTER TABLE `tender_purchase_request_group_details`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `tender_penawarans_tender_rekanan_id_index` (`tender_rekanan_id`);

--
-- Indexes for table `tender_purchase_request_penawarans_details`
--
ALTER TABLE `tender_purchase_request_penawarans_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tender_penawaran_details_tender_penawaran_id_index` (`tender_penawaran_id`),
  ADD KEY `tender_penawaran_details_rab_pekerjaan_id_index` (`rab_pekerjaan_id`);

--
-- Indexes for table `tender_purchase_request_rekanans`
--
ALTER TABLE `tender_purchase_request_rekanans`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `purchaseorders`
--
ALTER TABLE `purchaseorders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `purchaseorder_details`
--
ALTER TABLE `purchaseorder_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `purchaseorder_term_pengiriman`
--
ALTER TABLE `purchaseorder_term_pengiriman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchaserequests`
--
ALTER TABLE `purchaserequests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `purchaserequest_details`
--
ALTER TABLE `purchaserequest_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tender_purchase_requests`
--
ALTER TABLE `tender_purchase_requests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tender_purchase_request_details`
--
ALTER TABLE `tender_purchase_request_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tender_purchase_request_groups`
--
ALTER TABLE `tender_purchase_request_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tender_purchase_request_group_details`
--
ALTER TABLE `tender_purchase_request_group_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tender_purchase_request_penawarans`
--
ALTER TABLE `tender_purchase_request_penawarans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tender_purchase_request_penawarans_details`
--
ALTER TABLE `tender_purchase_request_penawarans_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tender_purchase_request_rekanans`
--
ALTER TABLE `tender_purchase_request_rekanans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;
