-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Mar 27, 2021 at 08:01 AM
-- Server version: 8.0.19
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpus_smk7`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` bigint NOT NULL,
  `id_users` int NOT NULL,
  `nama_anggota` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_slug` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nmr_hp` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_induk` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe_anggota` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_profile` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `id_users`, `nama_anggota`, `nama_slug`, `nmr_hp`, `nomor_induk`, `email`, `jenis_kelamin`, `tipe_anggota`, `foto_profile`) VALUES
(2, 3, 'Hafiidh Luqmanul Hakim', 'hafiidh-luqmanul-hakim', '085391791228', '0002792083', 'hafidluqmanulhakim@gmail.com', 'Laki-Laki', 'siswa', '-'),
(3, 4, 'M. Ilham', 'm-ilham', '085250654125', '0001403865', 'muhilham0603@gmail.com', 'Laki-Laki', 'siswa', '2017-08-06 09:22:09_laravel-programming.jpg'),
(6, 7, 'daguy', 'daguy', '085391791228', '000238123', 'daguy@gmail.com', 'Laki-Laki', 'siswa', '-'),
(10, 13, 'Sudijan', 'sudijan', '08125125125', '00888888', 'sudijan@gmail.com', 'Laki-Laki', 'guru', '-');

-- --------------------------------------------------------

--
-- Table structure for table `anggota_perpus`
--

CREATE TABLE `anggota_perpus` (
  `id_anggota_perpus` bigint NOT NULL,
  `id_anggota` bigint NOT NULL,
  `id_kelas` int NOT NULL,
  `id_tahun_ajaran` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `anggota_perpus`
--

INSERT INTO `anggota_perpus` (`id_anggota_perpus`, `id_anggota`, `id_kelas`, `id_tahun_ajaran`) VALUES
(1, 2, 3, 4),
(4, 3, 3, 4),
(6, 10, 11, 1),
(7, 6, 4, 5);

-- --------------------------------------------------------

--
-- Table structure for table `barcode_scan`
--

CREATE TABLE `barcode_scan` (
  `id_barcode` int UNSIGNED NOT NULL,
  `code_scanner` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_buku` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_buku` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barcode_scan`
--

INSERT INTO `barcode_scan` (`id_barcode`, `code_scanner`, `kode_buku`, `id_buku`, `created_at`, `updated_at`) VALUES
(8, 'HS611032', 'RXGUriTDznEpadQxjOAeyokWdLRwPNREROUXAaywWjkdQdeTxNrpoGzDiPnL', 5, '2017-09-25 13:29:38', '2017-09-25 13:29:38'),
(9, '123123123', 'vfLmsPNKzZWBIjTtyOmrbEeqkVQRwZetPfZKsZmwWmQqTjzyIVNBbkLOEvRr', 6, '2017-09-27 16:12:43', '2017-09-27 16:12:43'),
(10, '456789456789', 'kAMibFwqJxcZGfCDSEtQQRkUmaeIojDMAxojUtkiSfGkEQmwQFRCqJZeacbI', 3, '2017-09-27 16:13:03', '2017-09-27 16:13:03'),
(11, '123456789', 'msdQURjkzoDtVHLhRwpZTxYFcCdGJqwkDTRQUqzxFYJcZoCHmdGsLtdpVhjR', 5, '2017-09-29 18:38:37', '2017-09-29 18:38:37'),
(12, '12031202', 'dlUgOPoVABsZRLFlNzxEvcXPwfSaypZxaogAszRPfLpXVEBFdNlOlPwUvScy', 8, '2018-08-09 19:34:46', '2018-08-09 19:34:46'),
(13, '3000000', 'XNuCEFKCOYcjbzuMtUSpRsaoHglfAeuOjKEMluSACXgeHboUcCFtaYspfRNz', 12, '2018-08-11 07:16:57', '2018-08-11 07:16:57'),
(14, '4000000', 'tdQsKQdlburnhvAxCaNEDMRkOHjPUBbvuDPBxaCORhrEUdnsQHdMKQjtAlkN', 13, '2018-08-11 07:36:52', '2018-08-11 07:36:52'),
(15, '9999999', 'GVxcwIUXWCkGjPgurpieBMRSHzyAtiUpCMywXzgAGuBHkSPijIVxGtRrecWi', 13, NULL, NULL),
(16, '12345678910', 'wtiKzhjqfHEpYaEnwPNuWOdAGDBmXIzfuDwHYamnIPjtwiAEXqpNKdOhGBWE', 14, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` bigint NOT NULL,
  `judul_buku` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul_slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nomor_induk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pengarang` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sn_penulis` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `penerbit` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_terbit` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_terbit` year NOT NULL,
  `id_sub_ktg` int DEFAULT NULL,
  `klasifikasi` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_eksemplar` int NOT NULL,
  `stok_buku` int NOT NULL,
  `foto_buku` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `tanggal_upload` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `judul_buku`, `judul_slug`, `nomor_induk`, `pengarang`, `sn_penulis`, `penerbit`, `tempat_terbit`, `tahun_terbit`, `id_sub_ktg`, `klasifikasi`, `jumlah_eksemplar`, `stok_buku`, `foto_buku`, `keterangan`, `tanggal_upload`, `created_at`, `updated_at`) VALUES
(3, 'Belajar PHP 7.1', 'belajar-php-71', '123', 'Ilham Jagaw Ter', 'IJT', 'Gramedia', 'Samarinda', 2017, 1, '679.8', 10, 14, '_foto_buku_5b51485b149cc2017-07-30_39323034-programming-wallpapers.jpg.jpg', 'Jago', '2018-07-20', '2017-07-28 18:48:59', '2018-07-19 18:26:35'),
(5, 'Tes', 'tes', '124', 'asdasd', 'asdadsa', 'asdasd', 'asdasda', 2011, 1, '777.127.128', 123213, 2, '_foto_buku_5b514875253c02017-07-30_39323034-programming-wallpapers.jpg.jpg', '-', '2018-07-20', '2017-07-30 03:49:58', '2018-07-19 18:27:01'),
(6, 'Kehebatan', 'kehebatan', '125', 'Daguy', 'DGY', 'Erlangga', 'samarinda', 2017, 1, '892.128.7', 100, 118, '_foto_buku_5b513de054b74carbon (2).png.jpg', '-', '2018-07-20', '2017-09-03 19:48:17', '2018-07-19 17:41:52'),
(8, 'Belajar Laravel 5.6', 'belajar-laravel-56', '128', 'Taylor Otwell', 'TWL', 'Laravel Corp.', 'Los Angeles', 2018, 1, '575.5', 120, 130, '_foto_buku_5b51e09d478deTaylor-Otwell-cloudways.jpg', NULL, '2018-07-20', '2018-07-19 07:28:16', '2018-07-20 05:16:13'),
(11, 'daguy', 'daguy', '127', 'Daguy', 'DGY', 'asdasd', 'asdasd', 2019, 2, '123.123.', 123123, 121231, '_foto_buku_5b51476a162bcbatik_04.png.jpg', NULL, '2018-07-20', '2018-07-19 18:22:34', '2018-07-19 18:22:34'),
(12, 'Matematika K-13', 'matematika-k-13', '128', 'Daguy', 'DGY', 'Erlangga', 'Jakarta Utara', 2000, 4, '001.011.022', 19, 30, '-', '-', '2018-08-11', '2018-08-11 07:16:38', '2018-08-11 07:16:38'),
(13, 'Bahasa Indonesia K-13', 'bahasa-indonesia-k-13', '129', 'Daguy', 'DGY', 'Erlangga', 'Jakarta', 2000, 4, '001.002.003', 230, 1997, '-', '-', '2018-08-11', '2018-08-11 07:36:38', '2018-08-11 07:36:38'),
(14, 'The Pragmatic Programmer', 'the-pragmatic-programmer', '130', 'Andrew Hunt', 'ADH', '-', '-', 2000, 1, '-', 100000, 8, '-', '“The Pragmatic Programmer” By Andrew Hunt and Dave Thomas. Buku ini sangat cocok untuk semua programmer, baik yang masih pemula maupun sudah expert. Sesuai dengan judulnya, Buku Pemrograman ini akan mengubah pandangan dan kepribadianmu tentang pemrograman. Setelah membaca buku ini, Kamu akan menemukan banyak hal baru dan akan membuat kamu menjadi programmer yang lebih baik.\r\n\r\nYang sangat menarik dari buku ini yaitu pada isi bukunya, Buku ini tidak berfokus pada bahasa pemrograman tertentu, Melainkan membahas lebih luas tentang bahasa pemrograman. Walaupun tidak berfokus pada bahasa pemrograman tertentu, Isi dari buku ini sangat mudah dimengerti.\r\n\r\nDidalam buku ini kamu akan menemukan hal-hal kritis yang dianggap serius oleh seorang programmer dan bagaimana menemukan solusi pada sebuah case. Kamu akan belajar melakukan eksplorasi pada pemrograman, Pemilihan alat, memisahkan model dari pandangan, manajemen tim, dan bagaimana meminimalkan duplikasi di antara banyak topik lainnya.', '2020-12-22', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `buku_rusak`
--

CREATE TABLE `buku_rusak` (
  `id_buku_rusak` bigint NOT NULL,
  `id_buku` bigint NOT NULL,
  `stok_rusak` int NOT NULL,
  `ket_buku_rusak` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `buku_rusak`
--

INSERT INTO `buku_rusak` (`id_buku_rusak`, `id_buku`, `stok_rusak`, `ket_buku_rusak`) VALUES
(1, 3, 12, 'Halaman Sobek');

-- --------------------------------------------------------

--
-- Table structure for table `buku_tamu`
--

CREATE TABLE `buku_tamu` (
  `id_buku_tamu` bigint NOT NULL,
  `id_anggota_perpus` bigint NOT NULL,
  `tanggal_berkunjung` date NOT NULL,
  `ket_buku_tamu` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `buku_tamu`
--

INSERT INTO `buku_tamu` (`id_buku_tamu`, `id_anggota_perpus`, `tanggal_berkunjung`, `ket_buku_tamu`, `created_at`, `updated_at`) VALUES
(5, 1, '2021-03-10', '', '2021-03-10 15:19:15', '2021-03-10 15:19:15'),
(7, 6, '2021-03-15', '', '2021-03-15 06:59:17', '2021-03-15 06:59:17'),
(8, 1, '2021-03-20', 'Mengunjungi Perpustakaan', '2021-03-20 15:36:49', '2021-03-20 15:36:49');

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_detail_transaksi` bigint NOT NULL,
  `id_transaksi` bigint NOT NULL,
  `id_buku` bigint NOT NULL,
  `kode_buku` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stok_transaksi` int NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_harus_kembali` date NOT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `status_transaksi` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `denda` bigint DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_detail_transaksi`, `id_transaksi`, `id_buku`, `kode_buku`, `stok_transaksi`, `tanggal_pinjam`, `tanggal_harus_kembali`, `tanggal_kembali`, `status_transaksi`, `denda`, `keterangan`, `created_at`, `updated_at`) VALUES
(11, 9, 13, 'tdQsKQdlburnhvAxCaNEDMRkOHjPUBbvuDPBxaCORhrEUdnsQHdMKQjtAlkN', 1, '2020-12-23', '2021-01-06', '2021-03-07', 'kembali', NULL, 'Tertukar', NULL, '2021-03-07 14:23:24'),
(12, 10, 13, 'GVxcwIUXWCkGjPgurpieBMRSHzyAtiUpCMywXzgAGuBHkSPijIVxGtRrecWi', 1, '2020-12-23', '2021-01-06', '2020-12-23', 'kembali', NULL, 'Tertukar', NULL, '2020-12-23 06:49:08'),
(13, 9, 3, 'kAMibFwqJxcZGfCDSEtQQRkUmaeIojDMAxojUtkiSfGkEQmwQFRCqJZeacbI', 0, '2020-12-23', '2021-01-06', '2021-03-07', 'kembali', NULL, NULL, NULL, '2021-03-07 14:23:24'),
(14, 9, 14, 'wtiKzhjqfHEpYaEnwPNuWOdAGDBmXIzfuDwHYamnIPjtwiAEXqpNKdOhGBWE', 0, '2021-03-07', '2021-03-21', NULL, 'batal-pinjam', NULL, NULL, '2021-03-07 15:07:59', '2021-03-07 15:07:59'),
(16, 9, 3, '', 1, '2021-03-26', '2021-04-09', NULL, 'sedang-dipinjam', NULL, NULL, NULL, NULL),
(17, 9, 5, '', 1, '2021-03-26', '2021-04-09', NULL, 'sedang-dipinjam', NULL, NULL, NULL, NULL);

--
-- Triggers `detail_transaksi`
--
DELIMITER $$
CREATE TRIGGER `hapus_transaksi` AFTER DELETE ON `detail_transaksi` FOR EACH ROW BEGIN
	UPDATE buku SET stok_buku = stok_buku+OLD.stok_transaksi
    WHERE id_buku = OLD.id_buku;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `pinjam_buku` AFTER INSERT ON `detail_transaksi` FOR EACH ROW BEGIN
	UPDATE buku SET stok_buku = stok_buku - NEW.stok_transaksi
    WHERE id_buku = NEW.id_buku;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id_jurusan` int NOT NULL,
  `nama_jurusan` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id_jurusan`, `nama_jurusan`) VALUES
(1, '-'),
(2, 'TKJ'),
(3, 'MM'),
(4, 'RPL');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_buku`
--

CREATE TABLE `kategori_buku` (
  `id_kategori_buku` int NOT NULL,
  `nama_kategori` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug_kategori` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi_kategori` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori_buku`
--

INSERT INTO `kategori_buku` (`id_kategori_buku`, `nama_kategori`, `slug_kategori`, `deskripsi_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Non referensi', 'non-referensi', 'Kategori Buku Pelajaran', NULL, '2018-08-11 07:11:46'),
(2, 'Referensi', 'referensi', 'Bla bla bla bla bla', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int NOT NULL,
  `id_kelas_tingkat` int NOT NULL,
  `id_jurusan` int NOT NULL,
  `urutan_kelas` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `id_kelas_tingkat`, `id_jurusan`, `urutan_kelas`) VALUES
(1, 2, 4, 1),
(2, 3, 4, 1),
(3, 4, 4, 1),
(4, 2, 2, 1),
(5, 3, 2, 1),
(6, 4, 2, 1),
(7, 2, 3, 1),
(8, 3, 3, 1),
(9, 4, 3, 1),
(10, 2, 4, 2),
(11, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `kelas_tingkat`
--

CREATE TABLE `kelas_tingkat` (
  `id_kelas_tingkat` int NOT NULL,
  `kelas_tingkat` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kelas_tingkat`
--

INSERT INTO `kelas_tingkat` (`id_kelas_tingkat`, `kelas_tingkat`) VALUES
(1, '-'),
(2, 'X'),
(3, 'XI'),
(4, 'XII');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2017_06_17_145959_drop_table_password_resets', 2),
(3, '2017_06_18_130630_siswa', 3),
(4, '2017_06_18_132830_siswa', 4),
(5, '2017_06_18_133010_petugas', 5),
(6, '2017_06_18_133307_buku', 6),
(7, '2017_06_18_142458_jk_siswa', 6),
(8, '2017_06_18_142509_jk_petugas', 6),
(9, '2017_06_18_143152_barcode_scan', 6),
(10, '2017_06_18_143459_username_change_siswa', 7),
(11, '2017_06_18_143505_username_change_petugas', 7),
(12, '2017_06_18_143933_name_siswa', 7),
(13, '2017_06_18_144243_transaksi_buku', 7),
(14, '2017_06_18_144253_kategori_buku', 7),
(15, '2017_06_19_032646_buku', 8),
(16, '2017_06_19_032745_barcode_scanner', 9),
(17, '2017_06_19_032931_relationship_table', 10),
(18, '2017_06_21_025813_email_siswa', 11),
(19, '2017_07_09_144258_rating_buku', 12),
(20, '2017_07_13_132652_email_siswa', 13),
(21, '2017_07_13_160543_tanggal_publish_buku', 14),
(22, '2017_07_25_120458_wishtlist_buku', 15),
(23, '2017_07_28_011523_judul_slug', 15),
(24, '2017_07_28_100954_status_pinjam', 16),
(25, '2017_07_28_101007_status_kembali', 16),
(26, '2017_07_28_102322_nama_slug', 16),
(27, '2017_07_29_021725_update_buku', 17),
(28, '2017_07_30_150521_wishtlist_buku', 18),
(29, '2014_10_12_100000_create_password_resets_table', 19),
(30, '2019_10_11_051113_create_notifications_table', 19);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint UNSIGNED NOT NULL,
  `data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('41be4520-f8d5-4fb4-b659-3f2a48fc3186', 'App\\Notifications\\RatingBuku', 'App\\User', 2, '{\"pesan\":\"mantul\"}', NULL, '2019-10-11 05:11:24', '2019-10-11 05:11:24'),
('4adfe6c9-12f1-4c4b-8131-5274c384c9d4', 'App\\Notifications\\RatingBuku', 'App\\User', 1, '{\"pesan\":\"mantul\"}', NULL, '2019-10-11 05:11:24', '2019-10-11 05:11:24'),
('7ebbe2ee-60b4-4ca2-b3f1-55d6a3a4ee45', 'App\\Notifications\\RatingBuku', 'App\\User', 4, '{\"pesan\":\"mantul\"}', NULL, '2019-10-11 05:11:24', '2019-10-11 05:11:24'),
('ace4541c-19ed-4769-ad8b-1e55d4b15b1a', 'App\\Notifications\\RatingBuku', 'App\\User', 7, '{\"pesan\":\"mantul\"}', NULL, '2019-10-11 05:11:24', '2019-10-11 05:11:24'),
('dcf2d18f-4376-4e65-a98b-7d2ebb789517', 'App\\Notifications\\RatingBuku', 'App\\User', 5, '{\"pesan\":\"mantul\"}', NULL, '2019-10-11 05:11:24', '2019-10-11 05:11:24'),
('f2b41fd5-f04d-40d9-a99c-14186741ba99', 'App\\Notifications\\RatingBuku', 'App\\User', 3, '{\"pesan\":\"mantul\"}', NULL, '2019-10-11 05:11:24', '2019-10-11 05:11:24');

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id_notif` int NOT NULL,
  `id_siswa` bigint NOT NULL,
  `text` text NOT NULL,
  `ket` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int UNSIGNED NOT NULL,
  `id_users` int NOT NULL,
  `nip` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_petugas` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_profile` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `id_users`, `nip`, `nama_petugas`, `jabatan`, `foto_profile`) VALUES
(2, 16, '19670512 200701 1 038', 'Khairul Anam, M.Pd', 'kepala-perpustakaan', '-');

-- --------------------------------------------------------

--
-- Table structure for table `rating_buku`
--

CREATE TABLE `rating_buku` (
  `id_rating` bigint NOT NULL,
  `id_siswa` bigint NOT NULL,
  `id_buku` bigint NOT NULL,
  `rating` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rating_buku`
--

INSERT INTO `rating_buku` (`id_rating`, `id_siswa`, `id_buku`, `rating`, `created_at`, `updated_at`) VALUES
(1, 2, 13, 3000, NULL, NULL),
(2, 3, 3, 2000, NULL, NULL),
(3, 3, 6, 3000, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sub_kategori`
--

CREATE TABLE `sub_kategori` (
  `id_sub_ktg` int NOT NULL,
  `id_kategori_buku` int DEFAULT NULL,
  `nama_sub` varchar(100) NOT NULL,
  `slug_sub_ktg` varchar(100) NOT NULL,
  `deskripsi_sub` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_kategori`
--

INSERT INTO `sub_kategori` (`id_sub_ktg`, `id_kategori_buku`, `nama_sub`, `slug_sub_ktg`, `deskripsi_sub`, `created_at`, `updated_at`) VALUES
(1, 2, 'Rekayasa Perangkat Lunak', 'rekayasa-perangkat-lunak', 'Sub Kategori Rekayasa Perangkat Lunak adalah ....', NULL, NULL),
(2, 2, 'Multimedia', 'multimedia', 'Sub Kategori Multimedia adalah ...', NULL, NULL),
(3, 2, 'Teknik Komputer Jaringan\r\n', 'teknik-komputer-jaringan', 'Sub Kategori Teknik Komputer Jaringan adalah ...', NULL, NULL),
(4, 1, 'Pelajaran', 'pelajaran', 'Sub Kategori Buku Pelajaran', '2018-08-11 07:13:21', '2018-08-11 07:13:21');

-- --------------------------------------------------------

--
-- Table structure for table `surat_bebas_pustaka`
--

CREATE TABLE `surat_bebas_pustaka` (
  `id_surat_bebas_pustaka` int NOT NULL,
  `nomor_surat` varchar(70) NOT NULL,
  `id_tahun_ajaran` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `surat_bebas_pustaka`
--

INSERT INTO `surat_bebas_pustaka` (`id_surat_bebas_pustaka`, `nomor_surat`, `id_tahun_ajaran`) VALUES
(1, '001/Perpus/04/2019', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tahun_ajaran`
--

CREATE TABLE `tahun_ajaran` (
  `id_tahun_ajaran` int NOT NULL,
  `tahun_ajaran` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tahun_ajaran`
--

INSERT INTO `tahun_ajaran` (`id_tahun_ajaran`, `tahun_ajaran`) VALUES
(1, '-'),
(2, '2018/2019'),
(3, '2017/2018'),
(4, '2019/2018'),
(5, '2021/2022');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_buku`
--

CREATE TABLE `transaksi_buku` (
  `id_transaksi` bigint NOT NULL,
  `id_anggota_perpus` bigint NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi_buku`
--

INSERT INTO `transaksi_buku` (`id_transaksi`, `id_anggota_perpus`, `updated_at`) VALUES
(9, 1, NULL),
(10, 4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` int NOT NULL,
  `name` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` tinyint(1) NOT NULL COMMENT '0=siswa; 1=petugas; 2=admin;',
  `status_akun` int NOT NULL,
  `status_delete` int NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `name`, `username`, `password`, `remember_token`, `level`, `status_akun`, `status_delete`, `last_login`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin', '$2y$10$x44D0Pclz570dxhOqAsD6.VNr9aDy04CX7w.gZ1nDjhAKxG/4Vu8C', 'k7i2QdZTix5TbTG3NkOQH0aO4sTJwuCLU3vKBWaBdn1Cn0mNLhUjYkWKoBnt', 2, 1, 0, '2018-06-21 13:12:39', '2017-07-16 03:52:48', '2018-03-18 23:22:12'),
(3, 'Hafiidh Luqmanul Hakim', 'hafidlh', '$2y$10$9II9gIVOMrHHOBJqlzSmneA.zhKTpDVecYJvAGZHWFsNQXGrshCgW', 'F56d8YRyQfgTHFzKmPNGcCmu40963RvrZbbOqvdsPUDT9n1sZKKlKXlxm1Hf', 0, 1, 0, '2018-07-02 02:23:25', '2017-09-07 15:54:05', '2020-12-23 06:49:35'),
(4, 'Muhammad Ilham', 'ilham', '$2y$10$tD3vwSfLWgGAsBtLue/Dwuqs6sp1LsinmT4Z/B2frj6e7noh8BwXi', 'dPsXKQg66vplI3lnxecKCP7GFy7AtSbAYyanXleWm31JO6FSB88qFZjHwz4B', 0, 1, 0, '2017-10-27 05:13:00', '2017-08-06 01:22:09', '2017-10-26 21:13:00'),
(7, 'Dagum', 'dagum', '$2y$10$qSTuenEO1wPzMbXU5SBq1eTElDRGDmWVZBf0DD1LN8z8QovLeoC.e', '6MkooEHAQilt9L2CxFYKJf9crQLML0JgIjKLf27HN6pXL99yj5N6Hd36shga', 0, 1, 0, NULL, NULL, '2018-10-29 08:13:14'),
(13, 'Sudijan', 'sudijan', '$2y$10$CAfsd0olraWCLm6HAmoMMeUxC1Lc77KNms67N3XcF2bcBfKr3vZiq', NULL, 0, 1, 0, NULL, NULL, NULL),
(16, 'Khairul Anam, M.Pd', 'anam', '$2y$10$1EOxruCVgVOhE.pabyFU7.IK4Jt.CKLGzRzQ1tfE7R2QhSHIwjtNq', NULL, 1, 1, 0, NULL, NULL, '2021-03-24 09:39:27');

-- --------------------------------------------------------

--
-- Table structure for table `wishtlist_buku`
--

CREATE TABLE `wishtlist_buku` (
  `id_wishtlist` bigint NOT NULL,
  `id_siswa` bigint NOT NULL,
  `id_buku` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`),
  ADD KEY `username` (`id_users`);

--
-- Indexes for table `anggota_perpus`
--
ALTER TABLE `anggota_perpus`
  ADD PRIMARY KEY (`id_anggota_perpus`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `anggota_perpus_ibfk_2` (`id_anggota`),
  ADD KEY `id_tahun_ajaran` (`id_tahun_ajaran`);

--
-- Indexes for table `barcode_scan`
--
ALTER TABLE `barcode_scan`
  ADD PRIMARY KEY (`id_barcode`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `id_kategori_buku` (`id_sub_ktg`);

--
-- Indexes for table `buku_rusak`
--
ALTER TABLE `buku_rusak`
  ADD PRIMARY KEY (`id_buku_rusak`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indexes for table `buku_tamu`
--
ALTER TABLE `buku_tamu`
  ADD PRIMARY KEY (`id_buku_tamu`),
  ADD KEY `id_anggota_perpus` (`id_anggota_perpus`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_detail_transaksi`),
  ADD KEY `id_buku` (`id_buku`),
  ADD KEY `relasi_transaksi` (`id_transaksi`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indexes for table `kategori_buku`
--
ALTER TABLE `kategori_buku`
  ADD PRIMARY KEY (`id_kategori_buku`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD KEY `id_kelas_tingkat` (`id_kelas_tingkat`),
  ADD KEY `id_jurusan` (`id_jurusan`);

--
-- Indexes for table `kelas_tingkat`
--
ALTER TABLE `kelas_tingkat`
  ADD PRIMARY KEY (`id_kelas_tingkat`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id_notif`),
  ADD KEY `id_siswa` (`id_siswa`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`),
  ADD KEY `id_users` (`id_users`);

--
-- Indexes for table `rating_buku`
--
ALTER TABLE `rating_buku`
  ADD PRIMARY KEY (`id_rating`),
  ADD KEY `rating_buku_id_siswa_foreign` (`id_siswa`),
  ADD KEY `rating_buku_id_buku_foreign` (`id_buku`);

--
-- Indexes for table `sub_kategori`
--
ALTER TABLE `sub_kategori`
  ADD PRIMARY KEY (`id_sub_ktg`),
  ADD KEY `kategori_buku` (`id_kategori_buku`);

--
-- Indexes for table `surat_bebas_pustaka`
--
ALTER TABLE `surat_bebas_pustaka`
  ADD PRIMARY KEY (`id_surat_bebas_pustaka`),
  ADD KEY `id_tahun_ajaran` (`id_tahun_ajaran`);

--
-- Indexes for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  ADD PRIMARY KEY (`id_tahun_ajaran`);

--
-- Indexes for table `transaksi_buku`
--
ALTER TABLE `transaksi_buku`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_anggota_perpus` (`id_anggota_perpus`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- Indexes for table `wishtlist_buku`
--
ALTER TABLE `wishtlist_buku`
  ADD PRIMARY KEY (`id_wishtlist`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `id_buku` (`id_buku`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `anggota_perpus`
--
ALTER TABLE `anggota_perpus`
  MODIFY `id_anggota_perpus` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `barcode_scan`
--
ALTER TABLE `barcode_scan`
  MODIFY `id_barcode` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `buku_rusak`
--
ALTER TABLE `buku_rusak`
  MODIFY `id_buku_rusak` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `buku_tamu`
--
ALTER TABLE `buku_tamu`
  MODIFY `id_buku_tamu` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detail_transaksi` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id_jurusan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kategori_buku`
--
ALTER TABLE `kategori_buku`
  MODIFY `id_kategori_buku` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `kelas_tingkat`
--
ALTER TABLE `kelas_tingkat`
  MODIFY `id_kelas_tingkat` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id_notif` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rating_buku`
--
ALTER TABLE `rating_buku`
  MODIFY `id_rating` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sub_kategori`
--
ALTER TABLE `sub_kategori`
  MODIFY `id_sub_ktg` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `surat_bebas_pustaka`
--
ALTER TABLE `surat_bebas_pustaka`
  MODIFY `id_surat_bebas_pustaka` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  MODIFY `id_tahun_ajaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaksi_buku`
--
ALTER TABLE `transaksi_buku`
  MODIFY `id_transaksi` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `wishtlist_buku`
--
ALTER TABLE `wishtlist_buku`
  MODIFY `id_wishtlist` bigint NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `anggota`
--
ALTER TABLE `anggota`
  ADD CONSTRAINT `username_siswa` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `anggota_perpus`
--
ALTER TABLE `anggota_perpus`
  ADD CONSTRAINT `anggota_perpus_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `anggota_perpus_ibfk_2` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `anggota_perpus_ibfk_3` FOREIGN KEY (`id_tahun_ajaran`) REFERENCES `tahun_ajaran` (`id_tahun_ajaran`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `barcode_scan`
--
ALTER TABLE `barcode_scan`
  ADD CONSTRAINT `barcode_scan_ibfk_1` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `sub_kategori_buku` FOREIGN KEY (`id_sub_ktg`) REFERENCES `sub_kategori` (`id_sub_ktg`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `buku_rusak`
--
ALTER TABLE `buku_rusak`
  ADD CONSTRAINT `buku_rusak_ibfk_1` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `buku_tamu`
--
ALTER TABLE `buku_tamu`
  ADD CONSTRAINT `buku_tamu_ibfk_1` FOREIGN KEY (`id_anggota_perpus`) REFERENCES `anggota_perpus` (`id_anggota_perpus`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_ibfk_1` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `relasi_transaksi` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi_buku` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`id_kelas_tingkat`) REFERENCES `kelas_tingkat` (`id_kelas_tingkat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kelas_ibfk_2` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusan` (`id_jurusan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD CONSTRAINT `notifikasi_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `anggota` (`id_anggota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `petugas`
--
ALTER TABLE `petugas`
  ADD CONSTRAINT `petugas_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rating_buku`
--
ALTER TABLE `rating_buku`
  ADD CONSTRAINT `rating_buku_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `anggota` (`id_anggota`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rating_buku_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sub_kategori`
--
ALTER TABLE `sub_kategori`
  ADD CONSTRAINT `sub_kategori_ibfk_1` FOREIGN KEY (`id_kategori_buku`) REFERENCES `kategori_buku` (`id_kategori_buku`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `surat_bebas_pustaka`
--
ALTER TABLE `surat_bebas_pustaka`
  ADD CONSTRAINT `surat_bebas_pustaka_ibfk_1` FOREIGN KEY (`id_tahun_ajaran`) REFERENCES `tahun_ajaran` (`id_tahun_ajaran`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi_buku`
--
ALTER TABLE `transaksi_buku`
  ADD CONSTRAINT `transaksi_buku_ibfk_1` FOREIGN KEY (`id_anggota_perpus`) REFERENCES `anggota_perpus` (`id_anggota_perpus`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wishtlist_buku`
--
ALTER TABLE `wishtlist_buku`
  ADD CONSTRAINT `wishtlist_buku_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `anggota` (`id_anggota`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wishtlist_buku_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
