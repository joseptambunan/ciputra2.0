-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2018 at 09:24 AM
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
-- Dumping data for table "users"
--

SET IDENTITY_INSERT "users" ON ;
INSERT INTO "users" ("id", "user_login", "user_name", "is_rekanan", "email", "user_phone", "digitalsignature", "photo", "password", "description", "remember_token", "created_at", "updated_at", "deleted_at", "created_by", "updated_by", "deleted_by", "inactive_at", "inactive_by", "user_id") VALUES
(1, 'administrator', 'Administrator', 0, 'administrator@ciputra.com', NULL, NULL, NULL, '$2y$10$CU/xdfZv4E.SQMyw9JSJCuWBgCoxcmHTwhPHsmT2YXIibeBeNpyge', 'default administrator account', 'tWQRqY0ai5CDN7RewUA9SbXHiPjJBPaX8bJw28RFm4fk5yPzS9pYvi2CKylM', '2018-03-28 21:23:11', '2018-08-15 10:33:56', NULL, NULL, 1, NULL, NULL, NULL, NULL),
(2, 'restricted', 'Restricted User', 0, 'restricted@ciputra.com', NULL, NULL, NULL, '$2y$10$syr13zaNp2BR61TfCgBqMOrUANWrQ.NgvHVMHduA9ykmVDinXmOme', 'restricted user without any privilege', NULL, '2018-03-28 21:23:11', '2018-03-28 21:23:11', '2018-10-04 17:00:00', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'admin2', 'Admin 2', 1, 'admin2@gmail.com', NULL, NULL, NULL, '$2y$10$JjTmoUBJ6b3ZB8fNOSDQqeILm7z7nzo4jb4vSe.5u1TOgnYn27wjm', 'Admin 2', NULL, '2018-04-04 20:28:54', '2018-04-04 20:28:54', '2018-10-04 17:00:00', 1, NULL, NULL, NULL, NULL, NULL),
(4, 'direktur', 'DIrektur Utama', 1, 'direktur@ciputra.com', NULL, NULL, NULL, '$2y$10$zPHVj8r/maBRi7JcX1N5heeztQUVaxrthHvhQVMSZx4Tw.9lggwD6', 'Direktur', '7dWQGGAh7nk4UkowELN8ZyTkv1MGZzso8Yc95ScPcnnFHVfDRPQSVLV5G5wV', '2018-04-04 23:37:38', '2018-04-04 23:37:38', '2018-10-04 17:00:00', 1, 4, NULL, NULL, NULL, NULL),
(5, 'manager', 'General Manager', 1, 'manager@ciputra.com', NULL, NULL, NULL, '$2y$10$L4udJAJMqaImJVjURbl8Ve28dONuOYHjKszvtWlVQDWkI69xiwNIW', 'asdasdasdasscasdfsfsfsdf', '6lvTLaG6e22Ib0KtgceCMgv0yCrcU3Xm1ULSXnfxnrFXxh6GKUzZOEr70mCJ', '2018-04-04 23:43:19', '2018-07-30 02:59:58', '2018-10-04 17:00:00', 1, 1, NULL, NULL, NULL, NULL),
(6, 'budi', 'Budi', 1, 'budi@ciputra.com', NULL, NULL, NULL, '$2y$10$/lUbj/UQcUIiukPf6r3MbOanlf8v.Aavcu57cjvh1nDKC3Ka6dDx.', NULL, NULL, '2018-04-04 23:49:38', '2018-04-04 23:49:38', '2018-10-04 17:00:00', 1, NULL, NULL, NULL, NULL, NULL),
(7, 'indra', 'Indra', 0, 'indra@ciputra.com', NULL, NULL, NULL, '$2y$10$phMWIsguEjwjYB0Y6TPFouT7EL/J8weK8CMijT9M0xteEsA0MposO', NULL, NULL, '2018-04-04 23:52:16', '2018-04-04 23:52:16', '2018-10-04 17:00:00', 1, NULL, NULL, NULL, NULL, NULL),
(8, 'nani', 'Nani', 0, 'nani@ciputra.com', NULL, NULL, NULL, '$2y$10$PdAdl80liq.PDFkUPVC/6eEet82sx3Al.azVcvupsWh7YzsuoRqvq', NULL, 'VSAROSHrv9auYik40ASGCUlPaKw1ld5kSqOdhujJkHzwLW81WXoNBlJY7ATC', '2018-04-04 23:53:08', '2018-04-04 23:53:08', '2018-10-04 17:00:00', 1, 8, NULL, NULL, NULL, NULL),
(9, 'approval1', 'Approval', 1, 'harun@ciptutra.com', NULL, NULL, NULL, '$2y$10$CU/xdfZv4E.SQMyw9JSJCuWBgCoxcmHTwhPHsmT2YXIibeBeNpyge', NULL, 'GSJbAjKtxYFHpNlLZQxGpUiywQIkNrGiu7f2gW5tRljxpdgQTHIh4R2pAweM', '2018-04-04 23:54:20', '2018-07-24 07:52:44', '2018-10-09 17:00:00', 1, 9, NULL, NULL, NULL, NULL),
(10, 'arman', 'Arman', 1, 'arman@ciputra.com', NULL, NULL, NULL, '$2y$10$uV0v2pRL2RA9g6BNDMZ4o.CSaRjSsTpO91wdXKuZ9t3C8wMbkwWqO', NULL, 'BGoQZhmjrZk6XV1NShmQrWbD9rJICGliWv50QPFrWqYlMYz7POpz4py1hiIN', '2018-04-05 00:04:24', '2018-04-05 00:04:24', '2018-10-04 17:00:00', 1, 10, NULL, NULL, NULL, NULL),
(11, 'taufik', 'Taufik', 0, 'taufik@ciputra.com', NULL, NULL, NULL, '$2y$10$z1JnxEmuMNmzOA8Loa3H/OsyvbONMbKyiuRxc4qYuxmHORUQc/Qfy', NULL, 'YrG14dIC7tfb9XqZoefCQuC887UsOW7QHbK1wFDuJhZJcvev9HUEzrsYMDlg', '2018-04-05 01:41:12', '2018-04-05 01:41:12', '2018-10-04 17:00:00', 1, 11, NULL, NULL, NULL, NULL),
(12, 'hidayat1', 'Hidayat1', 0, 'hidayat1@ciputra.com', NULL, NULL, NULL, '$2y$10$/NrIuFXgxgltPseYKxGQLeC2V1ap1PtJ0aZk9I1cgne24kHpzq0MK', NULL, 'Mnc90qeAEud0ExoovCUR5aAMSpqH0eLaOgMo7TlLim3jWoR6PXayEFas6RAp', '2018-04-05 02:04:23', '2018-04-05 02:04:23', '2018-10-04 17:00:00', 1, 12, NULL, NULL, NULL, NULL),
(13, 'hidayat2', 'Hidayat2', 0, 'hidayat2', NULL, NULL, NULL, '$2y$10$wQWdKwB/77B66shU3CaTCe7.jH.fv1QIrD1vtzwraSnW8yHMN8h.C', NULL, NULL, '2018-04-05 02:05:21', '2018-04-05 02:05:21', '2018-10-04 17:00:00', 1, NULL, NULL, NULL, NULL, NULL),
(14, 'hidayat3', 'Hidayat3', 0, 'hidayat3', NULL, NULL, NULL, '$2y$10$PpGPvUzV7DlLW64pFjaZe.q.49QZveD9J9bnxqcCjeA1KdhaPk686', NULL, NULL, '2018-04-05 02:05:56', '2018-04-05 02:05:56', '2018-10-04 17:00:00', 1, NULL, NULL, NULL, NULL, NULL),
(15, 'nancy', 'Nancy', 0, 'nancy@ciputra.com', NULL, NULL, NULL, '$2y$10$lJX9RZI55BY.GCNZiO3.ku2mcve8tRdGO5urQhZebzkn8la1WPbES', NULL, 'i2TNP642micxCCJ3J5jXGNeiEFAfitceEMiuVmKjl8LMx7LFa3WovLZgJhBs', '2018-04-05 02:12:24', '2018-04-05 02:12:24', '2018-10-04 17:00:00', 1, 15, NULL, NULL, NULL, NULL),
(16, 'pic2', 'pic2', 0, 'pic2@ciputra.com', NULL, NULL, NULL, '$2y$10$ZH6hQtYH7XaR2Naw786aWezCZob3X0oriw3eQLwC4iCsiy0mrKycG', 'For PIC', '2B0h4E7Ly8uHDYGP3I0R9XtWrBgGGkg9JDsvFfl09qB3HxuTqFGPEC5QMIz9', '2018-05-28 00:50:56', '2018-05-28 00:50:56', '2018-10-04 17:00:00', 1, 16, NULL, NULL, NULL, NULL),
(17, 'zidane', 'zidane', 1, 'zidane@gmail.com', '08123456789', NULL, NULL, '$2y$10$pl8670PG1aRmbsz52TmKN.QufbfZdkC7svX7cJS4CWfOiiS3IotEm', 'Zinedine Zidane', NULL, '2018-07-30 02:47:09', '2018-07-30 02:47:09', '2018-10-04 17:00:00', 1, NULL, NULL, NULL, NULL, NULL),
(18, 'tofa@ciputra.com', 'tofa', 1, 'tofa@ciputra.com', '08123525459', NULL, NULL, '$2y$10$vMMw.UhnyXwSSqQK9jbedeBg0o2FbHG81osDtS6in7ONwn8sA4XrW', NULL, NULL, '2018-08-01 10:58:04', '2018-08-01 10:59:10', '2018-10-04 17:00:00', 1, 1, NULL, NULL, NULL, NULL),
(19, 'arifiradat', 'arifiradat', 0, 'arifiradat@ciputra.com', NULL, NULL, NULL, '$2y$10$y15KP3rGb8zRjZRK85ZDoeCs9.mk3dnkqVvWXlegGMF2AjLQ255jG', NULL, NULL, '2018-08-15 10:35:51', '2018-08-15 10:35:51', '2018-10-04 17:00:00', 1, NULL, NULL, NULL, NULL, NULL),
(20, 'bizPark2', 'bizPark2', 0, 'bizpark2@ciputra.com', '021-22101818', NULL, NULL, '$2y$10$P9JjPiidzMAYHYZDrtCbnux1.D2ug9SBYKYFOSYS.zZLrgiTE.b3m', 'Proyek pergudangan BizPark2', 'DRGl2KcQ2J4PCKY4JoxnmxuYxI8yDg1YEc9kAEqAZJOgTyZ4B8EbcHyDnLkA', '2018-09-21 10:46:43', '2018-09-21 10:46:43', '2018-10-04 17:00:00', 1, 20, NULL, NULL, NULL, NULL),
(21, 'BizPark3', 'BizPark3', 1, 'bizpark3@ciputra.com', '081364770433', NULL, NULL, '$2y$10$mO0dq46wisd8M7R7MU3Op.33ZjnPg10uKSburl6IyXFCMKmR7LeAy', NULL, 'JID2JxsYxorI2280OMMOu4V7fyB8iHhsUfCAXkcaBCpp6gQRzWoDR62Ljcmm', '2018-09-27 13:50:38', '2018-10-01 10:31:30', '2018-10-04 17:00:00', 1, 21, NULL, NULL, NULL, NULL),
(22, 'cbdapprove', 'cbdapprove', 0, 'cbdapprove@ciputra.com', '081364770433', NULL, NULL, '$2y$10$2fTI5lQuKQKAuLB9oXJCN.RuzkLahoW6/8uRnjtt6WDMjiGRyc3ui', NULL, NULL, '2018-10-01 10:27:39', '2018-10-01 10:27:39', '2018-10-04 17:00:00', 1, NULL, NULL, NULL, NULL, NULL),
(24, 'dircitralandcibubur', 'dircitralandcibubur', 0, 'citralandcibubur@ciputra.com', NULL, NULL, NULL, '$2y$10$2gx.wR/ai/.gPT9iyRX7TefTDI5m1wNXIbe6e801ibn5s.2AtBIaW', 'User Approval', '3liUB9iYqlNzkSWPRkyCVKbPaIHPzSYngbUtzyaVKrKun8tLXne3VidAsVQc', '2018-10-01 10:32:03', '2018-10-05 03:07:50', NULL, 1, 24, NULL, NULL, NULL, NULL),
(25, 'assdir', 'assdir', 0, 'cbddir2@gmail.com', NULL, NULL, NULL, '$2y$10$0MvJvfNSqvpYjYC73u3nAOZ2lmQQlEfxGew/rHEtOjoHVgGfZl1wm', NULL, 'GxZAGd20N3C2j6udDKcRCwrcIDuGG44i9upaykCdbqzWKe9y5g2MUcYOosDg', '2018-10-07 05:26:44', '2018-11-09 04:23:52', NULL, 1, 32, NULL, NULL, NULL, NULL),
(26, 'cbdgm', 'cbdgm', 0, 'cbdgm@ciptra.com', '081364770433', NULL, NULL, '$2y$10$CbGhbUBJm/llTEvUNEI5Y.RDrInpTMvmXvWjgxdszsM7CE0ETtPia', NULL, 't1jzbh1UkmOLyWZ2d3zhKd1njjuW7YMBBeR9rDEb2gGCKx0PUZRhMTVFtDgH', '2018-10-07 05:28:50', '2018-10-07 05:28:50', NULL, 1, 26, NULL, NULL, NULL, NULL),
(27, 'cbdhod', 'cbdhod', 1, 'cbdhod@ciputra.com', '081364770433', NULL, NULL, '$2y$10$q6DwMkaP1BLp144EhgbB5uuReeJnAwUMNaoEaL/ZCLe6nbRqnU4f6', NULL, 'pIGPUfC76YmZcFcT7icnPokO5L1YbbSpCyJitYlPXh8qRqJJHs0vb955Fh5Z', '2018-10-07 05:31:08', '2018-10-07 05:31:37', NULL, 1, 27, NULL, NULL, NULL, NULL),
(28, 'sdir', 'sdir', 0, 'josep.tambunan7@gmail.com', NULL, NULL, NULL, '$2y$10$fKdYg2c64Y3LFUeFzBifm.40eYU73jv3xtA7BVMWDsM/dzvV25sum', NULL, NULL, '2018-10-07 06:36:34', '2018-11-09 04:42:57', NULL, 1, 32, NULL, NULL, NULL, NULL),
(29, 'cbddiv', 'cbddiv', 0, 'cbddiv@gmail.com', '081364770433', NULL, NULL, '$2y$10$5bCEl.PhQ9AwcxZAXXzPceKDYpFyyJqdmYtFqzIXR4pnc2ETEz.bW', NULL, 'mhgSswlu8XQDIMqgJDb8l4TbgOebfMIcuOqgcdWCI6HQ61nF9U68kwWaqlD9', '2018-10-07 07:04:04', '2018-10-07 07:04:04', NULL, 1, 29, NULL, NULL, NULL, NULL),
(30, 'cbdadmin', 'cbdadmin', 0, 'cbdadmin@gmail.com', '081364770433', NULL, NULL, '$2y$10$fVlvX.FWwARlw6Pubpc7mOo/Hsy/A3nZgoRoYUVEexFnLwurlIP32', NULL, 'zEHrJpiqRCJCNWRfmjNwMurue8EhkD0CI1a6Cwek0aMmYiJ3fvBA9uk4tZwH', '2018-10-07 20:05:27', '2018-10-07 20:05:27', NULL, 1, 30, NULL, NULL, NULL, NULL),
(31, 'bizpark3admin', 'bizpark3admin', 0, 'bizpark3admin@ciputra.com', '081364770433', NULL, NULL, '$2y$10$RW29z./vt0jhLRxQTYt.BeJu6llsjPwbvSmEsFKss/mYbtS1G.WAS', NULL, 'T3mKuOZHh4fwW1uiNTcVFQ0VG5lAXBmtJjcq9tw5G8hgijF4vW4r2WVSTpqk', '2018-10-29 03:22:32', '2018-10-29 03:22:32', NULL, 1, 31, NULL, NULL, NULL, NULL),
(32, 'proyekdummyadmin', 'proyekdummyadmin', 0, 'proyekdummyadmin@gmail.com', '081364770433', NULL, NULL, '$2y$10$4fkWgVB8Hzv3ejnjkXm3WOMOwNc8e1iJ6.QHanXT3a1uDAbtx3USe', NULL, 'esm7YJFSR96gf72NoygrqecNDaU5FNZPIAMONeYtmk7rkzSBaSyKTyBuQtYa', '2018-10-29 20:36:49', '2018-10-29 20:36:49', NULL, 1, 32, NULL, NULL, NULL, NULL),
(33, 'rekanan_harapan_jaya', 'rekanan_harapan_jaya', 1, 'josep.tambunan7@gmail.com', NULL, NULL, NULL, '$2y$10$jvhkiUtMic5CB2Rd2sssH.2cPuBJ4dhjNtR1K4kkQHYOO1OeLKaee', NULL, '9YeGtC6hbyqunERlB85bLx4EBJIbi2dK9Dwn6zjRJZlCoTO3HHfdQad6pVLz', '2018-11-01 20:33:31', '2018-11-01 20:33:31', NULL, 1, 33, NULL, NULL, NULL, NULL),
(34, 'rekanan_abc', 'rekanan_abc', 1, NULL, NULL, NULL, NULL, '$2y$10$wzZOhtEJOyVBrXO9kAFN7.t.W8kAHTqhnmQqD7JpvUUhE/IsBGyBW', NULL, 'mCk7p8r1XupEw64kIegEAhG1hGs1JqfKj6dNP6KOG5x56a8QZzP9SV4De3Zh', '2018-11-02 01:53:48', '2018-11-02 01:53:48', NULL, 1, 34, NULL, NULL, NULL, NULL),
(36, 'rekanan_harapan', 'rekanan_harapan', 1, NULL, NULL, NULL, NULL, '$2y$10$2gx.wR/ai/.gPT9iyRX7TefTDI5m1wNXIbe6e801ibn5s.2AtBIaW', NULL, 'gLN4Eg8091YCqg4Siq9O0v1HjzzWW1C8PCTYZXg8yt43fm2WQlrp5Sn0n3Es', '2018-11-03 04:39:01', '2018-11-03 04:39:01', NULL, 1, 36, NULL, NULL, NULL, NULL),
(37, 'clpbadmin', 'clpbadmin', 0, 'clpbadmin@gmail.com', '081364770433', NULL, NULL, '$2y$10$u7UMoJJ/mqIvoP.on0Eq1eZ88c4aqSeaK/8cqV0MNV1MtLhvb/Wxi', NULL, 'S9U5tVhLASOX8nM63uelgWkZPl1pqfd28D161DrbhHx5WYLdoSILtHSF02xz', '2018-11-09 04:17:29', '2018-11-09 04:17:29', NULL, 1, 37, NULL, NULL, NULL, NULL),
(38, 'dir', 'dir', 0, 'josep.tambunan7@gmail.com', '081364770433', NULL, NULL, '$2y$10$Kdd8egFVGizodkb.EMKjeO/RLK4VbpUQbm/QaHgGcSmvN3I8AUUna', NULL, NULL, '2018-11-09 04:44:51', '2018-11-09 04:44:51', NULL, 32, NULL, NULL, NULL, NULL, NULL),
(39, 'proyekdummygm', 'proyekdummygm', 0, 'josep.tambunan7@gmail.com', '081364770433', NULL, NULL, '$2y$10$VoOKPOIWqVg3//E3DI5TE.A5YoK8ueVVYRUQKzTPDgfs/NFEdJo9G', NULL, NULL, '2018-11-09 08:52:42', '2018-11-09 08:52:42', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(40, 'proyekdummydept', 'proyekdummydept', 0, 'josep.tambunan7@gmail.com', '081364770433', NULL, NULL, '$2y$10$LgLOGamHTOBl0sCoKfnW/uMss2fFHxr9yPWrhkAqc0PYwJa7bZO2y', NULL, NULL, '2018-11-09 08:53:51', '2018-11-09 08:53:51', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(41, 'proyekdummydiv', 'proyekdummydiv', 0, 'josep.tambunan7@gmail.com', '081364770433', NULL, NULL, '$2y$10$7.ze8K.9Iv6M3HFOggKA1uNT9KsFpaLK3a7MeANkAPGdVVDHwChHi', NULL, NULL, '2018-11-09 08:56:29', '2018-11-09 08:56:29', NULL, 1, NULL, NULL, NULL, NULL, NULL);

SET IDENTITY_INSERT "users" OFF;

--
-- Dumping data for table "user_details"
--

SET IDENTITY_INSERT "user_details" ON ;
INSERT INTO "user_details" ("id", "user_id", "mappingperusahaan_id", "user_jabatan_id", "user_level", "can_approve", "description", "created_at", "updated_at", "deleted_at", "created_by", "updated_by", "deleted_by", "inactive_at", "inactive_by", "project_pt_id") VALUES
(1, 3, 1, 1, 1, 0, NULL, '2018-04-04 20:29:00', '2018-04-04 23:15:44', NULL, 1, 1, NULL, NULL, NULL, NULL),
(2, 4, 1, 1, 1, 1, NULL, '2018-04-04 23:39:08', '2018-04-04 23:39:08', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(3, 5, 1, 1, 2, 1, 'Manager', '2018-04-04 23:43:33', '2018-06-10 22:54:37', '2018-06-10 22:54:37', 1, 1, 1, NULL, NULL, NULL),
(4, 6, 1, 2, 4, 1, NULL, '2018-04-04 23:51:29', '2018-04-04 23:51:29', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(5, 7, 1, 3, 3, 1, NULL, '2018-04-04 23:52:44', '2018-04-04 23:52:44', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(6, 8, 1, 4, 2, 1, NULL, '2018-04-04 23:53:52', '2018-04-04 23:53:52', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(7, 9, 1, 5, 1, 1, NULL, '2018-04-04 23:54:29', '2018-06-24 20:56:34', '2018-06-24 20:56:34', 1, 1, 1, NULL, NULL, NULL),
(8, 10, 1, 3, 1, 1, NULL, '2018-04-05 00:04:36', '2018-04-05 00:04:36', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(9, 11, 1, 1, 1, 1, NULL, '2018-04-05 01:42:56', '2018-06-24 21:01:23', '2018-06-24 21:01:23', 1, 1, 1, NULL, NULL, NULL),
(10, 11, 3, 6, 5, 1, NULL, '2018-04-05 01:52:13', '2018-04-05 01:54:48', NULL, 1, 1, NULL, NULL, NULL, NULL),
(11, 11, 4, 6, 5, 1, NULL, '2018-04-05 01:52:23', '2018-04-05 01:54:59', NULL, 1, 1, NULL, NULL, NULL, NULL),
(12, 12, 2, 7, 6, 1, NULL, '2018-04-05 02:04:46', '2018-04-05 02:04:46', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(13, 13, 3, 7, 6, 1, NULL, '2018-04-05 02:05:34', '2018-04-05 02:05:34', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(14, 14, 4, 7, 6, 1, NULL, '2018-04-05 02:06:03', '2018-04-05 02:06:03', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(15, 15, 1, 2, 1, 1, NULL, '2018-04-05 02:15:34', '2018-05-06 21:25:14', '2018-05-06 21:25:14', 1, 1, 1, NULL, NULL, NULL),
(16, 1, 2, 2, 1, 1, NULL, '2018-04-06 03:19:15', '2018-07-04 23:47:26', '2018-07-04 23:47:26', 1, 1, 1, NULL, NULL, NULL),
(17, 1, 5, 7, 7, 0, NULL, '2018-05-03 22:59:58', '2018-07-04 23:47:29', '2018-07-04 23:47:29', 1, 1, 1, NULL, NULL, NULL),
(18, 16, 1, 2, 2, 0, 'PIC', '2018-05-28 00:51:14', '2018-05-28 00:53:03', '2018-05-28 00:53:03', 1, 1, 1, NULL, NULL, NULL),
(19, 16, 6, 8, 8, 0, 'PIC PROJECT', '2018-05-28 00:53:50', '2018-05-28 00:53:50', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(20, 5, 1, 5, 5, 1, NULL, '2018-06-10 23:11:04', '2018-06-10 23:11:04', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(21, 1, 7, 8, 8, 0, NULL, '2018-06-14 21:28:19', '2018-07-04 23:47:31', '2018-07-04 23:47:31', 1, 1, 1, NULL, NULL, NULL),
(22, 9, 1, 1, 1, 1, NULL, '2018-06-24 20:56:29', '2018-06-24 20:56:29', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(23, 24, 20, 1, 1, 1, NULL, '2018-10-05 03:10:16', '2018-10-09 21:28:35', '2018-10-09 21:28:35', 1, 1, 1, NULL, NULL, NULL),
(24, 24, 21, 1, 1, 1, NULL, '2018-10-05 03:10:16', '2018-10-09 21:28:35', '2018-10-09 21:28:35', 1, 1, 1, NULL, NULL, NULL),
(25, 25, 19, 4, 4, 1, NULL, '2018-10-07 05:28:15', '2018-10-07 05:28:15', NULL, 1, NULL, NULL, NULL, NULL, 39),
(26, 26, 19, 5, 5, 1, NULL, '2018-10-07 05:29:24', '2018-10-07 05:29:24', NULL, 1, NULL, NULL, NULL, NULL, 39),
(27, 28, 19, 2, 2, 1, NULL, '2018-10-07 06:38:34', '2018-10-07 06:38:34', NULL, 1, NULL, NULL, NULL, NULL, 39),
(28, 27, 19, 6, 6, 1, NULL, '2018-10-07 06:53:56', '2018-10-07 06:53:56', NULL, 1, NULL, NULL, NULL, NULL, 39),
(29, 29, 19, 7, 7, 1, NULL, '2018-10-07 07:05:04', '2018-10-07 07:05:04', NULL, 1, NULL, NULL, NULL, NULL, 39),
(30, 30, 19, 10, 10, 0, NULL, '2018-10-07 20:13:43', '2018-10-07 20:13:43', NULL, 1, NULL, NULL, NULL, NULL, 39),
(31, 24, 20, 1, 1, 0, NULL, '2018-10-09 21:28:04', '2018-10-09 21:28:35', '2018-10-09 21:28:35', 1, 1, 1, NULL, NULL, 40),
(32, 24, 21, 1, 1, 0, NULL, '2018-10-09 21:28:04', '2018-10-09 21:28:35', '2018-10-09 21:28:35', 1, 1, 1, NULL, NULL, 40),
(33, 24, 20, 4, 4, 0, NULL, '2018-10-09 21:28:14', '2018-10-09 21:29:06', '2018-10-09 21:29:06', 1, 1, 1, NULL, NULL, 40),
(34, 24, 21, 4, 4, 0, NULL, '2018-10-09 21:28:14', '2018-10-09 21:29:07', '2018-10-09 21:29:07', 1, 1, 1, NULL, NULL, 40),
(35, 24, 20, 10, 10, 0, NULL, '2018-10-09 21:28:27', '2018-10-09 21:29:17', '2018-10-09 21:29:17', 1, 1, 1, NULL, NULL, 40),
(36, 24, 21, 10, 10, 0, NULL, '2018-10-09 21:28:27', '2018-10-09 21:29:17', '2018-10-09 21:29:17', 1, 1, 1, NULL, NULL, 40),
(37, 24, 20, 1, 1, 1, NULL, '2018-10-09 21:29:32', '2018-10-09 21:29:32', NULL, 1, NULL, NULL, NULL, NULL, 40),
(38, 24, 21, 1, 1, 1, NULL, '2018-10-09 21:29:32', '2018-10-09 21:29:32', NULL, 1, NULL, NULL, NULL, NULL, 40),
(39, 31, 24, 10, 10, 0, NULL, '2018-10-29 03:36:22', '2018-10-29 03:36:22', NULL, 1, NULL, NULL, NULL, NULL, 43),
(40, 32, 2, 10, 10, 0, NULL, '2018-10-29 20:37:10', '2018-10-29 20:37:10', NULL, 1, NULL, NULL, NULL, NULL, 44),
(41, 32, 1, 10, 10, 0, NULL, '2018-10-29 20:37:10', '2018-10-29 20:37:10', NULL, 1, NULL, NULL, NULL, NULL, 44),
(42, 37, 25, 10, 10, 0, NULL, '2018-11-09 04:18:42', '2018-11-09 04:18:42', NULL, 1, NULL, NULL, NULL, NULL, 45),
(43, 37, 25, 10, 10, 0, NULL, '2018-11-09 04:18:43', '2018-11-09 04:18:43', NULL, 1, NULL, NULL, NULL, NULL, 45),
(44, 25, 2, 2, 2, 1, NULL, '2018-11-09 04:23:04', '2018-11-09 04:23:04', NULL, 32, NULL, NULL, NULL, NULL, 46),
(45, 25, 1, 2, 2, 1, NULL, '2018-11-09 04:23:04', '2018-11-09 04:23:04', NULL, 32, NULL, NULL, NULL, NULL, 46),
(46, 25, 2, 4, 4, 1, NULL, '2018-11-09 04:33:05', '2018-11-09 04:33:05', NULL, 32, NULL, NULL, NULL, NULL, 47),
(47, 25, 1, 4, 4, 1, NULL, '2018-11-09 04:33:05', '2018-11-09 04:33:05', NULL, 32, NULL, NULL, NULL, NULL, 47),
(48, 28, 2, 2, 2, 1, NULL, '2018-11-09 04:34:08', '2018-11-09 04:34:08', NULL, 32, NULL, NULL, NULL, NULL, 48),
(49, 28, 1, 2, 2, 1, NULL, '2018-11-09 04:34:08', '2018-11-09 04:34:08', NULL, 32, NULL, NULL, NULL, NULL, 48),
(50, 38, 2, 3, 3, 1, NULL, '2018-11-09 04:45:06', '2018-11-09 04:45:06', NULL, 32, NULL, NULL, NULL, NULL, 49),
(51, 38, 1, 3, 3, 1, NULL, '2018-11-09 04:45:06', '2018-11-09 04:45:06', NULL, 32, NULL, NULL, NULL, NULL, 49),
(52, 39, 2, 5, 5, 1, NULL, '2018-11-09 08:53:02', '2018-11-09 08:53:02', NULL, 1, NULL, NULL, NULL, NULL, 50),
(53, 39, 1, 5, 5, 1, NULL, '2018-11-09 08:53:02', '2018-11-09 08:53:02', NULL, 1, NULL, NULL, NULL, NULL, 50),
(54, 40, 1, 6, 6, 1, NULL, '2018-11-09 08:55:45', '2018-11-09 08:55:45', NULL, 1, NULL, NULL, NULL, NULL, 51),
(55, 41, 1, 7, 7, 1, NULL, '2018-11-09 08:56:47', '2018-11-09 08:56:47', NULL, 1, NULL, NULL, NULL, NULL, 52);

SET IDENTITY_INSERT "user_details" OFF;

--
-- Dumping data for table "user_groups"
--

SET IDENTITY_INSERT "user_groups" ON ;
INSERT INTO "user_groups" ("id", "name", "is_rekanan", "description", "created_at", "updated_at", "deleted_at", "created_by", "updated_by", "deleted_by", "inactive_at", "inactive_by") VALUES
(1, 'administrator', 0, 'Group untuk app administrator', '2018-04-01 05:48:23', '2018-04-01 05:48:23', NULL, 1, NULL, NULL, NULL, NULL),
(2, 'restricted', 0, 'Group untuk user tanpa akses apa-apa', '2018-04-01 05:48:23', '2018-04-01 05:48:23', NULL, 1, NULL, NULL, NULL, NULL),
(3, 'pic', 0, 'Group untuk PIC Lapangan', '2018-05-27 17:00:00', '2018-05-27 17:00:00', NULL, NULL, NULL, NULL, NULL, NULL);

SET IDENTITY_INSERT "user_groups" OFF;

--
-- Dumping data for table "user_group_details"
--

SET IDENTITY_INSERT "user_group_details" ON ;
INSERT INTO "user_group_details" ("id", "user_group_id", "user_id", "description", "created_at", "updated_at", "deleted_at", "created_by", "updated_by", "deleted_by", "inactive_at", "inactive_by") VALUES
(1, 1, 1, 'First administrator', '2018-04-01 05:48:23', '2018-04-01 05:48:23', NULL, 1, NULL, NULL, NULL, NULL),
(2, 2, 2, 'Restricted user', '2018-04-01 05:48:23', '2018-04-01 05:48:23', NULL, 1, NULL, NULL, NULL, NULL),
(3, 1, 9, NULL, '2018-05-11 02:10:08', '2018-05-13 21:16:52', '2018-05-13 21:16:52', 1, 9, 9, NULL, NULL),
(4, 3, 16, 'PIC 1 Project ', '2018-05-27 17:00:00', '2018-05-27 17:00:00', NULL, NULL, NULL, NULL, NULL, NULL);

SET IDENTITY_INSERT "user_group_details" OFF;

--
-- Dumping data for table "user_jabatans"
--

SET IDENTITY_INSERT "user_jabatans" ON ;
INSERT INTO "user_jabatans" ("id", "code", "name", "description", "created_at", "updated_at", "deleted_at", "created_by", "updated_by", "deleted_by", "inactive_at", "inactive_by") VALUES
(1, 'DIRUTS', 'Direktur Utama', NULL, '2018-03-28 21:23:10', '2018-07-31 13:46:30', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'SDIR', 'Senior Direktur', NULL, '2018-04-04 23:46:11', '2018-07-31 13:59:05', NULL, 1, NULL, NULL, NULL, NULL),
(3, 'DIR', 'Direktur', NULL, '2018-04-04 23:46:36', '2018-07-31 13:59:16', NULL, 1, NULL, NULL, NULL, NULL),
(4, 'ASSDIR', 'Assosiate Direktur', NULL, '2018-04-04 23:46:53', '2018-07-31 13:59:28', NULL, 1, NULL, NULL, NULL, NULL),
(5, 'GM', 'General Manager', NULL, '2018-04-04 23:47:07', '2018-04-04 23:47:07', NULL, 1, NULL, NULL, NULL, NULL),
(6, 'HOD', 'Kepala Departemen', NULL, '2018-04-05 01:53:54', '2018-07-30 08:41:17', NULL, 1, 1, NULL, NULL, NULL),
(7, 'HDV', 'Kepala Divisi', NULL, '2018-04-05 02:03:55', '2018-07-30 08:41:31', NULL, 1, NULL, NULL, NULL, NULL),
(8, 'SPV', 'Pengawas Lapangan', NULL, '2018-05-28 00:53:23', '2018-07-31 13:51:26', NULL, 1, NULL, NULL, NULL, NULL),
(10, 'ADM', 'Administrasi', 'ADMINISTRASI', '2018-07-31 13:47:23', '2018-07-31 13:47:51', NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'CSR', 'Kasir', NULL, '2018-07-31 13:52:32', '2018-07-31 13:52:32', NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'PM', 'Project Manager', NULL, '2018-10-04 09:00:01', '2018-10-04 09:00:01', NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'PM', 'Project Manager', 'Project Manager', '2018-10-05 03:05:49', '2018-10-05 03:05:49', NULL, NULL, NULL, NULL, NULL, NULL);

SET IDENTITY_INSERT "user_jabatans" OFF;

--
-- Dumping data for table "user_rekanans"
--

SET IDENTITY_INSERT "user_rekanans" ON ;
INSERT INTO "user_rekanans" ("id", "user_login", "user_name", "is_rekanan", "password", "description", "remember_token", "created_at", "updated_at", "deleted_at", "created_by", "updated_by", "deleted_by", "inactive_at", "inactive_by", "rekanan_group_id") VALUES
(5, 'rekanan_harapan_jaya', 'rekanan_harapan_jaya', 1, '$2y$10$5qbkmjanzGeja4qeKUovgOaGy186pagvZwEzMi85KGveRDkRFkeDm', NULL, NULL, '2018-11-01 20:33:31', '2018-11-01 20:33:31', NULL, NULL, NULL, NULL, NULL, NULL, 768),
(6, 'rekanan_abc', 'rekanan_abc', 1, '$2y$10$2RTSpf/kGxK1a6A1w3hrAueGRO3vMMbZ.RLj1CMEUVkKdmVlRfiuy', NULL, NULL, '2018-11-02 01:50:58', '2018-11-02 01:53:48', NULL, NULL, NULL, NULL, NULL, NULL, 769),
(7, 'rekanan_harapan_jaya', 'rekanan_harapan_jaya', 1, '$2y$10$bMxkU5ociLscHkHU76MjOefpISWwC8pVn2Sy5wEv/yajZwx4mXlcu', NULL, NULL, '2018-11-03 04:38:41', '2018-11-03 04:38:41', NULL, NULL, NULL, NULL, NULL, NULL, 770),
(8, 'rekanan_harapan', 'rekanan_harapan', 1, '$2y$10$CepQ3IJxRJ1NZBGwFYReuuiLmlqep3HFcMHIw6Tepu69bJTK17EHi', NULL, NULL, '2018-11-03 04:39:01', '2018-11-03 04:39:01', NULL, NULL, NULL, NULL, NULL, NULL, 770);

SET IDENTITY_INSERT "user_rekanans" OFF;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
