-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Apr 24, 2021 at 07:32 AM
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
  `tipe_anggota` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_profile` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_delete` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `id_users`, `nama_anggota`, `nama_slug`, `nmr_hp`, `nomor_induk`, `email`, `jenis_kelamin`, `tipe_anggota`, `foto_profile`, `status_delete`) VALUES
(2, 3, 'Hafiidh Luqmanul Hakim', 'hafiidh-luqmanul-hakim', '085391791228', '0002792083', 'hafidluqmanulhakim@gmail.com', 'Laki-Laki', 'siswa', '_photo_profile_6083ad40a62d0unnamed.jpg', 0),
(3, 4, 'M. Ilham', 'm-ilham', '085250654125', '0001403865', 'muhilham0603@gmail.com', 'Laki-Laki', 'siswa', '-', 0),
(6, 7, 'Raihan Febryan', 'raihan-febryan', '085391791228', '000238123', 'raihanfebryan@gmail.com', 'Laki-Laki', 'siswa', '-', 1),
(10, 13, 'Rohmat', 'rohmat', '08125125125', '00888888', 'Rohmat@gmail.com', 'Laki-Laki', 'guru', '-', 0),
(11, 22, 'Ahmad Munaroh', 'ahmad-munaroh', '088888888', '-', 'ahmadmunaroh@gmail.com', 'Laki-Laki', 'karyawan', '-', 0),
(12, 25, 'Dimas Ridho Amalia', 'dimas-ridho-amalia', '0888888888', '000123901239201', 'dimasuhuy@gmail.com', 'Laki-Laki', 'siswa', '-', 0),
(13, 30, 'Safira Dina Fakhirah', 'safira-dina-fakhirah', '0821212121', '00012391239', 'safiradinafakhirah17@gmail.com', 'Perempuan', 'siswa', '-', 0);

-- --------------------------------------------------------

--
-- Table structure for table `anggota_perpus`
--

CREATE TABLE `anggota_perpus` (
  `id_anggota_perpus` bigint NOT NULL,
  `id_anggota` bigint NOT NULL,
  `id_kelas` int NOT NULL,
  `id_tahun_ajaran` int NOT NULL,
  `status_delete` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `anggota_perpus`
--

INSERT INTO `anggota_perpus` (`id_anggota_perpus`, `id_anggota`, `id_kelas`, `id_tahun_ajaran`, `status_delete`) VALUES
(1, 2, 3, 5, 0),
(4, 3, 3, 5, 0),
(6, 10, 11, 1, 0),
(7, 6, 4, 5, 0),
(9, 11, 1, 1, 1),
(10, 6, 3, 5, 0),
(11, 12, 3, 5, 0),
(12, 13, 12, 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `aturan_pinjam`
--

CREATE TABLE `aturan_pinjam` (
  `id_aturan_pinjam` int NOT NULL,
  `isi_aturan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aturan_pinjam`
--

INSERT INTO `aturan_pinjam` (`id_aturan_pinjam`, `isi_aturan`) VALUES
(1, '<h2 style=\"margin: 25px 0px 20px; font-family: \'Open Sans\'; font-weight: 300; line-height: 40px; color: #444444; text-rendering: optimizelegibility; font-size: 32px; background-color: #ffffff;\">Peraturan Umum</h2>\r\n<ol style=\"padding: 0px 0px 0px 30px; margin: 20px 0px; color: #444444; font-family: \'Open Sans\'; font-size: 14px; background-color: #ffffff;\">\r\n<li style=\"line-height: 20px;\">Berpakaian sopan dan tidak diperkenankan memakai kaos oblong, jaket dan sandal.</li>\r\n<li style=\"line-height: 20px;\">Mengisi daftar pengunjung yang sudah disediakan.</li>\r\n<li style=\"line-height: 20px;\">Tidak diperkenankan membawa buku, tas, map dan sejenisnya, serta membawa jaket ke ruang perpustakaan.</li>\r\n<li style=\"line-height: 20px;\">Tidak diperkenankan menyimpan uang, perhiasan, dan barang-barang berharga lainnya dalam perlengkapan barang yang di titipkan.</li>\r\n<li style=\"line-height: 20px;\">Menjaga kerapihan bahan pustaka, kebersihan, keamanan dan ketenangan belajar.</li>\r\n<li style=\"line-height: 20px;\">Tidak diperkenankan membawa makanan dan minuman atau pun makan-makan dan merokok di ruang perpustakaan.</li>\r\n<li style=\"line-height: 20px;\">Memperlihatkan kepada petugas barang/buku yang dibawa pada saat masuk dan keluar perpustakaan.</li>\r\n</ol>\r\n<h2 style=\"margin: 25px 0px 20px; font-family: \'Open Sans\'; font-weight: 300; line-height: 40px; color: #444444; text-rendering: optimizelegibility; font-size: 32px; background-color: #ffffff;\">Peraturan Peminjaman Bahan Pustaka</h2>\r\n<ol style=\"padding: 0px 0px 0px 30px; margin: 20px 0px; color: #444444; font-family: \'Open Sans\'; font-size: 14px; background-color: #ffffff;\">\r\n<li style=\"line-height: 20px;\"><strong>Prosedur Peminjaman</strong>\r\n<ol style=\"padding: 0px 0px 0px 30px; margin: 0px;\">\r\n<li style=\"line-height: 20px;\">Setiap Peminjam harus memperlihatkan kartu anggota perpustakaan yang masih berlaku.</li>\r\n<li style=\"line-height: 20px;\">Setiap Peminjam tidak diperkenankan menggunakan kartu anggota perpustakaan milik orang lain</li>\r\n<li style=\"line-height: 20px;\">Jenis koleksi buku yang dipinjam adalah semua buku yang ada di ruang sirkulasi.<br />Jumlah koleksi yang dapat dipinjam:<br />Mahasiswa sebanyak 2(dua) eksemplar;<br />Dosen,Karyawan dan Mahasiswa Pascasarjana sebanya 3(tiga) eksemplar.</li>\r\n<li style=\"line-height: 20px;\">Pinjaman untuk di photo copy adalah semua koleksi yang berada di ruang sirkulasi dan referensi;</li>\r\n<li style=\"line-height: 20px;\">Setiap peminjaman diharuskan memeriksakan keutuhan buku yang akan dipinjamnya kepada petugas peminjaman</li>\r\n<li style=\"line-height: 20px;\">Buku-buku yang dipinjam oleh mahasiswa, dosen, karyawan dan mahasiswa Pascasarjana paling lambat dikembalikan 7 (tujuh) hari terhitung mulai tanggal peminjaman.</li>\r\n<li style=\"line-height: 20px;\">Buku yang telah habis masa pinjamannya harus dikembalikan tepat waktunya dan dapat diperpanjang waktu pinjamnya.</li>\r\n<li style=\"line-height: 20px;\">Perpanjangan waktu peminjaman hanya dapat dilakukan sebanyak 1(satu) kali.</li>\r\n</ol>\r\n</li>\r\n<li style=\"line-height: 20px;\"><strong>Kewajiban dan Tanggung Jawab Peminjam</strong>\r\n<ol style=\"padding: 0px 0px 0px 30px; margin: 0px;\">\r\n<li style=\"line-height: 20px;\">Peminjam diwajibkan memelihara buku yang dipinjamnya dengan baik dan dilarang membuat tulisan, coretan atau merusak/merobek halaman buku.</li>\r\n<li style=\"line-height: 20px;\">Kerusakan buku yang dipinjam yang disebabkan oleh peminjam, sepenuhnya menjadi tanggung jawab peminjam dan diharuskan mengganti dengan buku yang sama dalam keadaan utuh dan ditambah dengan denda keterlambatan.</li>\r\n<li style=\"line-height: 20px;\">Kehilangan buku perpustakaan yang sedang dipinjam sepenuhnya menjadi tanggung jawab peminjam. Penggantian dapat berupa:<br />Buku yang sama judulnya;<br />Uang yang besarnya:<br />1 X harga buku, untuk buku-buku terbitan dalam negeri, ditambah biaya administrasi, atau 2 X lipat harga buku, untuk buku-buku terbitan dalam negeri yang termasuk kategori buku langka, atau 3 X harga buku, untuk buku-buku terbitan luar negeri.</li>\r\n</ol>\r\n</li>\r\n<li style=\"line-height: 20px;\"><strong>Sanksi</strong>\r\n<ol style=\"padding: 0px 0px 0px 30px; margin: 0px;\">\r\n<li style=\"line-height: 20px;\">Setiap peminjam yang mempunyai buku pinjaman dan telah melewati batas waktu peminjamannya tidak diperkenankan meminjam buku lain sebelum buku tersebut dikembalikan.</li>\r\n<li style=\"line-height: 20px;\">Setiap peminjaman yang terlambat mengembalikan buku dikenakan denda sesuai dengan ketentuan yang berlaku</li>\r\n<li style=\"line-height: 20px;\">Setiap peminjam yang terlambat mengembalikan buku pinjamannya sampai 2(dua) bulan berturut-turut terhitung sejak jatuh tempo tanggal pengembaliannya, dinyatakan menghilangkan buku tersebut.</li>\r\n<li style=\"line-height: 20px;\">Tidak diperkenankan menggunakan haknya sebagai anggota perpustakaan untuk sementara waktu</li>\r\n<li style=\"line-height: 20px;\">Dicabut tanda keanggotaanya dari perpustakaan UIN Sunan Gunung Djati Bandung</li>\r\n</ol>\r\n</li>\r\n<li style=\"line-height: 20px;\"><strong>Ketentuan Khusus</strong>\r\n<ol style=\"padding: 0px 0px 0px 30px; margin: 0px;\">\r\n<li style=\"line-height: 20px;\">Setiap Anggota yang keluar dari keanggotaan/mahasiswa yang akan mengambil ijazah, diharuskan mendapat surat keterangan bebas pinjaman dari perpustakaan dengan menyerahkan Skripsi berikut Soft Copy nya dalam bentuk CD dan diwajibkan menyumbang buku.</li>\r\n<li style=\"line-height: 20px;\">Bagi mahasiswa yang telah lulus ujian diharuskan menyerahkan buku ilmiah bermutu atau uang sesuai ketentuan yang belaku (SK Rektor UIN Sunan Gunung Djati Bandung No. 107 Tahun 2010 tentang Pedoman Pelayanan Perpustakaan Pusat</li>\r\n</ol>\r\n</li>\r\n</ol>');

-- --------------------------------------------------------

--
-- Table structure for table `barcode_scan`
--

CREATE TABLE `barcode_scan` (
  `id_barcode` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_scanner` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_buku` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barcode_scan`
--

INSERT INTO `barcode_scan` (`id_barcode`, `code_scanner`, `id_buku`, `created_at`, `updated_at`) VALUES
('230af27c-1ea0-4f6b-89ce-06a553d4071a', '838091618930152', 8, NULL, NULL),
('24d75706-fa36-418d-8af5-cee7d427f28b', '417741618930119', 14, NULL, NULL),
('277197b7-ec60-4a36-a2f7-45c67b7b916b', '925151618930139', 11, NULL, NULL),
('455ce3c5-920b-4a1f-92da-58ffcd56de66', '706121618930161', 5, NULL, NULL),
('65443654-e9a1-48cf-b3eb-44a3670bddea', '351031618930165', 3, NULL, NULL),
('8f879f9e-0d5a-42ac-8334-108f26a72e91', '284131618930128', 13, NULL, NULL),
('a9edc47d-c3de-4651-b3e1-0bb487b08168', '506361618930156', 6, NULL, NULL),
('bff61512-b559-4337-82e2-25785bbce259', '109241618930133', 12, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` bigint NOT NULL,
  `judul_buku` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul_slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inisial_buku` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pengarang` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sn_penulis` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `penerbit` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_terbit` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_terbit` year NOT NULL,
  `tahun_buku` year NOT NULL,
  `id_sub_ktg` int DEFAULT NULL,
  `klasifikasi` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_eksemplar` int NOT NULL,
  `stok_buku` int NOT NULL,
  `foto_buku` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `tanggal_upload` date NOT NULL,
  `jenis_buku` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_delete` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `judul_buku`, `judul_slug`, `inisial_buku`, `pengarang`, `sn_penulis`, `penerbit`, `tempat_terbit`, `tahun_terbit`, `tahun_buku`, `id_sub_ktg`, `klasifikasi`, `jumlah_eksemplar`, `stok_buku`, `foto_buku`, `keterangan`, `tanggal_upload`, `jenis_buku`, `status_delete`, `created_at`, `updated_at`) VALUES
(3, 'PHP Undercover', 'php-undercover', 'P', 'Andre Pratama', 'ANP', 'Duniailkom', 'Samarinda', 2017, 2018, 1, '679.8', 10, 8, '_foto_buku_5b51485b149cc2017-07-30_39323034-programming-wallpapers.jpg.jpg', 'Jago', '2021-04-20', 'buku-bacaan', 0, '2017-07-28 18:48:59', '2018-07-19 18:26:35'),
(5, 'Javascript Undercover', 'javascript-undercover', 'T', 'Andre Pratama', 'ANP', 'Duniailkom', 'Jakarta', 2011, 2018, 1, '777.127.128', 32, 0, '_foto_buku_5b514875253c02017-07-30_39323034-programming-wallpapers.jpg.jpg', '-', '2021-04-20', 'buku-bacaan', 0, '2017-07-30 03:49:58', '2018-07-19 18:27:01'),
(6, 'MySQL Undercover', 'mysql-undercover', 'M', 'Andre Pratama', 'ANP', 'Duniailkom', 'Samarinda', 2017, 2018, 1, '892.128.7', 32, 109, '_foto_buku_5b513de054b74carbon (2).png.jpg', '-', '2021-04-20', 'buku-bacaan', 0, '2017-09-03 19:48:17', '2018-07-19 17:41:52'),
(8, 'Belajar Laravel 5.6', 'belajar-laravel-56', 'L', 'Taylor Otwell', 'TWL', 'Laravel Corp.', 'Los Angeles', 2018, 2018, 1, '575.5', 32, 43, '_foto_buku_5b51e09d478deTaylor-Otwell-cloudways.jpg', NULL, '2021-04-20', 'buku-bacaan', 0, '2018-07-19 07:28:16', '2018-07-20 05:16:13'),
(11, 'Panduan Praktis Menguasai Vue Js', 'panduan-praktis-menguasai-vue-js', 'P', 'Lutfi Gani', 'LGN', 'Lokomedia', 'Jakarta', 2015, 2015, 1, '123.123.123', 32, 9, '_foto_buku_5b51476a162bcbatik_04.png.jpg', NULL, '2021-04-20', 'buku-bacaan', 0, '2018-07-19 18:22:34', '2018-07-19 18:22:34'),
(12, 'Matematika Kelas XII K-13', 'matematika-kelas-xii-k-13', 'M', 'Kemendikbud', 'KMB', 'Kemendikbud', 'Jakarta Utara', 2000, 2018, 4, '001.011.022', 19, 23, '-', '-', '2021-04-20', 'buku-pelajaran-kelas-xii', 0, '2018-08-11 07:16:38', '2018-08-11 07:16:38'),
(13, 'Bahasa Indonesia Kelas XII K-13', 'bahasa-indonesia-kelas-xii-k-13', 'I', 'Kemendikbu', 'KMB', 'Kemendikbud', 'Jakarta', 2000, 2018, 4, '001.002.003', 32, 7, '-', '-', '2021-04-20', 'buku-pelajaran-kelas-xii', 0, '2018-08-11 07:36:38', '2018-08-11 07:36:38'),
(14, 'The Pragmatic Programmer', 'the-pragmatic-programmer', 'T', 'Andrew Hunt', 'ADH', '-', '-', 2000, 2018, 1, '-', 32, 8, '-', '“The Pragmatic Programmer” By Andrew Hunt and Dave Thomas. Buku ini sangat cocok untuk semua programmer, baik yang masih pemula maupun sudah expert. Sesuai dengan judulnya, Buku Pemrograman ini akan mengubah pandangan dan kepribadianmu tentang pemrograman. Setelah membaca buku ini, Kamu akan menemukan banyak hal baru dan akan membuat kamu menjadi programmer yang lebih baik.\r\n\r\nYang sangat menarik dari buku ini yaitu pada isi bukunya, Buku ini tidak berfokus pada bahasa pemrograman tertentu, Melainkan membahas lebih luas tentang bahasa pemrograman. Walaupun tidak berfokus pada bahasa pemrograman tertentu, Isi dari buku ini sangat mudah dimengerti.\r\n\r\nDidalam buku ini kamu akan menemukan hal-hal kritis yang dianggap serius oleh seorang programmer dan bagaimana menemukan solusi pada sebuah case. Kamu akan belajar melakukan eksplorasi pada pemrograman, Pemilihan alat, memisahkan model dari pandangan, manajemen tim, dan bagaimana meminimalkan duplikasi di antara banyak topik lainnya.', '2021-04-20', 'buku-bacaan', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `buku_rusak`
--

CREATE TABLE `buku_rusak` (
  `id_buku_rusak` bigint NOT NULL,
  `id_buku` bigint NOT NULL,
  `stok_rusak` int NOT NULL,
  `ket_buku_rusak` text NOT NULL
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
  `ket_buku_tamu` varchar(30) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `buku_tamu`
--

INSERT INTO `buku_tamu` (`id_buku_tamu`, `id_anggota_perpus`, `tanggal_berkunjung`, `ket_buku_tamu`, `created_at`, `updated_at`) VALUES
(5, 1, '2021-03-10', '', '2021-03-10 15:19:15', '2021-03-10 15:19:15'),
(7, 6, '2021-03-15', '', '2021-03-15 06:59:17', '2021-03-15 06:59:17'),
(8, 1, '2021-03-20', 'Mengunjungi Perpustakaan', '2021-03-20 15:36:49', '2021-03-20 15:36:49'),
(9, 9, '2021-04-15', 'Mengunjungi Perpustakaan', '2021-04-15 08:01:58', '2021-04-15 08:01:58'),
(10, 9, '2021-04-15', 'Mengunjungi Perpustakaan', '2021-04-15 08:02:52', '2021-04-15 08:02:52');

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_detail_transaksi` bigint NOT NULL,
  `id_transaksi` bigint NOT NULL,
  `id_buku` bigint NOT NULL,
  `stok_transaksi` int NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_harus_kembali` date NOT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `status_transaksi` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `denda` bigint DEFAULT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_detail_transaksi`, `id_transaksi`, `id_buku`, `stok_transaksi`, `tanggal_pinjam`, `tanggal_harus_kembali`, `tanggal_kembali`, `status_transaksi`, `denda`, `keterangan`, `created_at`, `updated_at`) VALUES
(25, 11, 13, 1, '2021-04-14', '2021-04-12', '2021-04-19', 'kembali', 30000, NULL, NULL, '2021-04-18 20:06:19'),
(26, 12, 8, 1, '2021-04-14', '2021-04-30', NULL, 'sedang-dipinjam', NULL, NULL, NULL, NULL),
(27, 11, 6, 1, '2021-04-16', '2021-04-30', '2021-04-19', 'kembali', 0, NULL, NULL, '2021-04-18 20:00:55'),
(28, 11, 6, 1, '2021-04-16', '2021-04-19', '2021-04-20', 'hilang', 50000, NULL, NULL, '2021-04-20 13:02:07'),
(29, 13, 6, 1, '2021-04-17', '2021-04-20', NULL, 'sedang-dipinjam', NULL, NULL, NULL, NULL),
(30, 13, 12, 1, '2021-04-17', '2021-04-20', NULL, 'sedang-dipinjam', NULL, NULL, NULL, NULL),
(31, 11, 12, 1, '2021-04-17', '2021-04-18', '2021-04-21', 'hilang', 50000, NULL, NULL, '2021-04-21 11:10:57'),
(36, 11, 8, 1, '2021-04-22', '2021-05-06', '2021-04-22', 'kembali', 0, NULL, NULL, '2021-04-22 15:42:14'),
(37, 11, 8, 1, '2021-04-22', '2021-05-06', '2021-04-22', 'kembali', 0, NULL, NULL, '2021-04-22 15:42:14'),
(39, 15, 3, 1, '2021-04-22', '2021-05-06', '2021-04-23', 'kembali', 0, NULL, NULL, '2021-04-23 21:29:40'),
(40, 16, 5, 1, '2021-04-22', '2021-05-06', '2021-04-22', 'kembali', 0, NULL, NULL, '2021-04-22 22:57:09'),
(41, 16, 3, 1, '2021-04-22', '2021-05-06', NULL, 'sedang-dipinjam', NULL, NULL, NULL, NULL),
(42, 16, 6, 1, '2021-04-22', '2021-05-06', NULL, 'sedang-dipinjam', NULL, NULL, NULL, NULL),
(43, 17, 3, 1, '2021-04-23', '2021-05-07', NULL, 'sedang-dipinjam', NULL, NULL, NULL, NULL),
(44, 17, 5, 1, '2021-04-23', '2021-05-07', NULL, 'sedang-dipinjam', NULL, NULL, NULL, NULL),
(45, 17, 6, 1, '2021-04-23', '2021-05-07', NULL, 'sedang-dipinjam', NULL, NULL, NULL, NULL),
(49, 11, 12, 1, '2021-04-23', '2021-04-27', NULL, 'sedang-dipinjam', NULL, NULL, NULL, NULL),
(50, 11, 13, 1, '2021-04-23', '2021-04-27', NULL, 'sedang-dipinjam', NULL, NULL, NULL, NULL),
(51, 11, 3, 1, '2021-04-23', '2021-04-27', NULL, 'sedang-dipinjam', NULL, NULL, NULL, NULL),
(52, 15, 6, 1, '2021-04-23', '2021-05-07', '2021-04-23', 'kembali', 0, NULL, NULL, '2021-04-23 21:31:49'),
(53, 15, 6, 0, '2021-04-23', '2021-04-27', NULL, 'sedang-dipinjam', NULL, NULL, NULL, NULL);

--
-- Triggers `detail_transaksi`
--
DELIMITER $$
CREATE TRIGGER `kembalikan_buku` AFTER UPDATE ON `detail_transaksi` FOR EACH ROW IF(NEW.status_transaksi = 'kembali') THEN
	BEGIN
        UPDATE buku SET stok_buku = stok_buku + NEW.stok_transaksi
        WHERE id_buku = NEW.id_buku;
    END; END IF
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `pinjam_buku` AFTER UPDATE ON `detail_transaksi` FOR EACH ROW IF(NEW.status_transaksi = 'sedang-dipinjam') THEN
	BEGIN
        UPDATE buku SET stok_buku = stok_buku - NEW.stok_transaksi
        WHERE id_buku = NEW.id_buku;
    END; END IF
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `pinjam_buku_insert` AFTER INSERT ON `detail_transaksi` FOR EACH ROW IF(NEW.status_transaksi = 'sedang-dipinjam') THEN
	BEGIN
        UPDATE buku SET stok_buku = stok_buku - NEW.stok_transaksi
        WHERE id_buku = NEW.id_buku;
    END; END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `failed_jobs`
--

INSERT INTO `failed_jobs` (`id`, `connection`, `queue`, `payload`, `exception`, `failed_at`) VALUES
(1, 'database', 'default', '{\"displayName\":\"App\\\\Jobs\\\\SendManyEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendManyEmailJob\",\"command\":\"O:25:\\\"App\\\\Jobs\\\\SendManyEmailJob\\\":8:{s:6:\\\"\\u0000*\\u0000job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'Symfony\\Component\\Debug\\Exception\\FatalThrowableError: Class \'App\\Jobs\\TransaksiDetail\' not found in /var/www/perpus_smk7/app/Jobs/SendManyEmailJob.php:36\nStack trace:\n#0 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): App\\Jobs\\SendManyEmailJob->handle()\n#1 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#2 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#3 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#4 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/Container.php(590): Illuminate\\Container\\BoundMethod::call()\n#5 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(94): Illuminate\\Container\\Container->call()\n#6 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(130): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#7 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(105): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#8 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(98): Illuminate\\Pipeline\\Pipeline->then()\n#9 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(83): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#10 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(130): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#11 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(105): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#12 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(85): Illuminate\\Pipeline\\Pipeline->then()\n#13 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(59): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#14 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(88): Illuminate\\Queue\\CallQueuedHandler->call()\n#15 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(368): Illuminate\\Queue\\Jobs\\Job->fire()\n#16 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(314): Illuminate\\Queue\\Worker->process()\n#17 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(134): Illuminate\\Queue\\Worker->runJob()\n#18 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(112): Illuminate\\Queue\\Worker->daemon()\n#19 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(96): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#20 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#21 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#22 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#23 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#24 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/Container.php(590): Illuminate\\Container\\BoundMethod::call()\n#25 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Console/Command.php(134): Illuminate\\Container\\Container->call()\n#26 /var/www/perpus_smk7/vendor/symfony/console/Command/Command.php(255): Illuminate\\Console\\Command->execute()\n#27 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Console/Command.php(121): Symfony\\Component\\Console\\Command\\Command->run()\n#28 /var/www/perpus_smk7/vendor/symfony/console/Application.php(1009): Illuminate\\Console\\Command->run()\n#29 /var/www/perpus_smk7/vendor/symfony/console/Application.php(273): Symfony\\Component\\Console\\Application->doRunCommand()\n#30 /var/www/perpus_smk7/vendor/symfony/console/Application.php(149): Symfony\\Component\\Console\\Application->doRun()\n#31 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Console/Application.php(93): Symfony\\Component\\Console\\Application->run()\n#32 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(131): Illuminate\\Console\\Application->run()\n#33 /var/www/perpus_smk7/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle()\n#34 {main}', '2021-04-23 20:56:14'),
(2, 'database', 'default', '{\"displayName\":\"App\\\\Jobs\\\\SendManyEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendManyEmailJob\",\"command\":\"O:25:\\\"App\\\\Jobs\\\\SendManyEmailJob\\\":8:{s:6:\\\"\\u0000*\\u0000job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'Symfony\\Component\\Debug\\Exception\\FatalThrowableError: Class \'App\\Jobs\\TransaksiDetail\' not found in /var/www/perpus_smk7/app/Jobs/SendManyEmailJob.php:36\nStack trace:\n#0 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): App\\Jobs\\SendManyEmailJob->handle()\n#1 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#2 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#3 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#4 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/Container.php(590): Illuminate\\Container\\BoundMethod::call()\n#5 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(94): Illuminate\\Container\\Container->call()\n#6 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(130): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#7 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(105): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#8 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(98): Illuminate\\Pipeline\\Pipeline->then()\n#9 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(83): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#10 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(130): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#11 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(105): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#12 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(85): Illuminate\\Pipeline\\Pipeline->then()\n#13 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(59): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#14 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(88): Illuminate\\Queue\\CallQueuedHandler->call()\n#15 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(368): Illuminate\\Queue\\Jobs\\Job->fire()\n#16 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(314): Illuminate\\Queue\\Worker->process()\n#17 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(134): Illuminate\\Queue\\Worker->runJob()\n#18 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(112): Illuminate\\Queue\\Worker->daemon()\n#19 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(96): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#20 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#21 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#22 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#23 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#24 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/Container.php(590): Illuminate\\Container\\BoundMethod::call()\n#25 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Console/Command.php(134): Illuminate\\Container\\Container->call()\n#26 /var/www/perpus_smk7/vendor/symfony/console/Command/Command.php(255): Illuminate\\Console\\Command->execute()\n#27 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Console/Command.php(121): Symfony\\Component\\Console\\Command\\Command->run()\n#28 /var/www/perpus_smk7/vendor/symfony/console/Application.php(1009): Illuminate\\Console\\Command->run()\n#29 /var/www/perpus_smk7/vendor/symfony/console/Application.php(273): Symfony\\Component\\Console\\Application->doRunCommand()\n#30 /var/www/perpus_smk7/vendor/symfony/console/Application.php(149): Symfony\\Component\\Console\\Application->doRun()\n#31 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Console/Application.php(93): Symfony\\Component\\Console\\Application->run()\n#32 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(131): Illuminate\\Console\\Application->run()\n#33 /var/www/perpus_smk7/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle()\n#34 {main}', '2021-04-23 20:56:14'),
(3, 'database', 'default', '{\"displayName\":\"App\\\\Jobs\\\\SendManyEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendManyEmailJob\",\"command\":\"O:25:\\\"App\\\\Jobs\\\\SendManyEmailJob\\\":8:{s:6:\\\"\\u0000*\\u0000job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'Symfony\\Component\\Debug\\Exception\\FatalThrowableError: Class \'App\\Models\\TransaksiDetail\' not found in /var/www/perpus_smk7/app/Jobs/SendManyEmailJob.php:37\nStack trace:\n#0 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): App\\Jobs\\SendManyEmailJob->handle()\n#1 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#2 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#3 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#4 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/Container.php(590): Illuminate\\Container\\BoundMethod::call()\n#5 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(94): Illuminate\\Container\\Container->call()\n#6 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(130): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#7 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(105): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#8 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(98): Illuminate\\Pipeline\\Pipeline->then()\n#9 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(83): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#10 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(130): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#11 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(105): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#12 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(85): Illuminate\\Pipeline\\Pipeline->then()\n#13 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(59): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#14 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(88): Illuminate\\Queue\\CallQueuedHandler->call()\n#15 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(368): Illuminate\\Queue\\Jobs\\Job->fire()\n#16 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(314): Illuminate\\Queue\\Worker->process()\n#17 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(134): Illuminate\\Queue\\Worker->runJob()\n#18 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(112): Illuminate\\Queue\\Worker->daemon()\n#19 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(96): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#20 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#21 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#22 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#23 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#24 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/Container.php(590): Illuminate\\Container\\BoundMethod::call()\n#25 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Console/Command.php(134): Illuminate\\Container\\Container->call()\n#26 /var/www/perpus_smk7/vendor/symfony/console/Command/Command.php(255): Illuminate\\Console\\Command->execute()\n#27 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Console/Command.php(121): Symfony\\Component\\Console\\Command\\Command->run()\n#28 /var/www/perpus_smk7/vendor/symfony/console/Application.php(1009): Illuminate\\Console\\Command->run()\n#29 /var/www/perpus_smk7/vendor/symfony/console/Application.php(273): Symfony\\Component\\Console\\Application->doRunCommand()\n#30 /var/www/perpus_smk7/vendor/symfony/console/Application.php(149): Symfony\\Component\\Console\\Application->doRun()\n#31 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Console/Application.php(93): Symfony\\Component\\Console\\Application->run()\n#32 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(131): Illuminate\\Console\\Application->run()\n#33 /var/www/perpus_smk7/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle()\n#34 {main}', '2021-04-23 20:57:07'),
(4, 'database', 'default', '{\"displayName\":\"App\\\\Jobs\\\\SendManyEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendManyEmailJob\",\"command\":\"O:25:\\\"App\\\\Jobs\\\\SendManyEmailJob\\\":8:{s:6:\\\"\\u0000*\\u0000job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'Symfony\\Component\\Debug\\Exception\\FatalThrowableError: Class \'App\\Jobs\\Mail\' not found in /var/www/perpus_smk7/app/Jobs/SendManyEmailJob.php:55\nStack trace:\n#0 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): App\\Jobs\\SendManyEmailJob->handle()\n#1 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#2 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#3 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#4 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/Container.php(590): Illuminate\\Container\\BoundMethod::call()\n#5 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(94): Illuminate\\Container\\Container->call()\n#6 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(130): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#7 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(105): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#8 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(98): Illuminate\\Pipeline\\Pipeline->then()\n#9 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(83): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#10 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(130): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#11 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(105): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#12 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(85): Illuminate\\Pipeline\\Pipeline->then()\n#13 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(59): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#14 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(88): Illuminate\\Queue\\CallQueuedHandler->call()\n#15 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(368): Illuminate\\Queue\\Jobs\\Job->fire()\n#16 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(314): Illuminate\\Queue\\Worker->process()\n#17 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(134): Illuminate\\Queue\\Worker->runJob()\n#18 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(112): Illuminate\\Queue\\Worker->daemon()\n#19 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(96): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#20 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#21 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#22 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#23 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#24 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/Container.php(590): Illuminate\\Container\\BoundMethod::call()\n#25 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Console/Command.php(134): Illuminate\\Container\\Container->call()\n#26 /var/www/perpus_smk7/vendor/symfony/console/Command/Command.php(255): Illuminate\\Console\\Command->execute()\n#27 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Console/Command.php(121): Symfony\\Component\\Console\\Command\\Command->run()\n#28 /var/www/perpus_smk7/vendor/symfony/console/Application.php(1009): Illuminate\\Console\\Command->run()\n#29 /var/www/perpus_smk7/vendor/symfony/console/Application.php(273): Symfony\\Component\\Console\\Application->doRunCommand()\n#30 /var/www/perpus_smk7/vendor/symfony/console/Application.php(149): Symfony\\Component\\Console\\Application->doRun()\n#31 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Console/Application.php(93): Symfony\\Component\\Console\\Application->run()\n#32 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(131): Illuminate\\Console\\Application->run()\n#33 /var/www/perpus_smk7/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle()\n#34 {main}', '2021-04-23 20:57:38'),
(5, 'database', 'default', '{\"displayName\":\"App\\\\Jobs\\\\SendManyEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendManyEmailJob\",\"command\":\"O:25:\\\"App\\\\Jobs\\\\SendManyEmailJob\\\":8:{s:6:\\\"\\u0000*\\u0000job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'Symfony\\Component\\Debug\\Exception\\FatalThrowableError: Class \'App\\Jobs\\ReminderPinjamBuku\' not found in /var/www/perpus_smk7/app/Jobs/SendManyEmailJob.php:56\nStack trace:\n#0 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): App\\Jobs\\SendManyEmailJob->handle()\n#1 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#2 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#3 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#4 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/Container.php(590): Illuminate\\Container\\BoundMethod::call()\n#5 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(94): Illuminate\\Container\\Container->call()\n#6 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(130): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#7 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(105): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#8 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(98): Illuminate\\Pipeline\\Pipeline->then()\n#9 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(83): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#10 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(130): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#11 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(105): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#12 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(85): Illuminate\\Pipeline\\Pipeline->then()\n#13 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(59): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#14 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(88): Illuminate\\Queue\\CallQueuedHandler->call()\n#15 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(368): Illuminate\\Queue\\Jobs\\Job->fire()\n#16 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(314): Illuminate\\Queue\\Worker->process()\n#17 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(134): Illuminate\\Queue\\Worker->runJob()\n#18 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(112): Illuminate\\Queue\\Worker->daemon()\n#19 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(96): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#20 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#21 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#22 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#23 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#24 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/Container.php(590): Illuminate\\Container\\BoundMethod::call()\n#25 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Console/Command.php(134): Illuminate\\Container\\Container->call()\n#26 /var/www/perpus_smk7/vendor/symfony/console/Command/Command.php(255): Illuminate\\Console\\Command->execute()\n#27 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Console/Command.php(121): Symfony\\Component\\Console\\Command\\Command->run()\n#28 /var/www/perpus_smk7/vendor/symfony/console/Application.php(1009): Illuminate\\Console\\Command->run()\n#29 /var/www/perpus_smk7/vendor/symfony/console/Application.php(273): Symfony\\Component\\Console\\Application->doRunCommand()\n#30 /var/www/perpus_smk7/vendor/symfony/console/Application.php(149): Symfony\\Component\\Console\\Application->doRun()\n#31 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Console/Application.php(93): Symfony\\Component\\Console\\Application->run()\n#32 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(131): Illuminate\\Console\\Application->run()\n#33 /var/www/perpus_smk7/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle()\n#34 {main}', '2021-04-23 20:58:05'),
(6, 'database', 'default', '{\"displayName\":\"App\\\\Jobs\\\\SendMailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendMailJob\",\"command\":\"O:20:\\\"App\\\\Jobs\\\\SendMailJob\\\":9:{s:7:\\\"\\u0000*\\u0000mail\\\";a:4:{s:5:\\\"email\\\";s:28:\\\"hafidluqmanulhakim@gmail.com\\\";s:10:\\\"judul_buku\\\";s:14:\\\"PHP Undercover\\\";s:12:\\\"nama_anggota\\\";s:22:\\\"Hafiidh Luqmanul Hakim\\\";s:21:\\\"tanggal_harus_kembali\\\";s:10:\\\"2021-04-27\\\";}s:6:\\\"\\u0000*\\u0000job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'ErrorException: Undefined index: HTTP_HOST in /var/www/perpus_smk7/app/Helper/helper.php:10\nStack trace:\n#0 /var/www/perpus_smk7/app/Helper/helper.php(10): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->handleError()\n#1 /var/www/perpus_smk7/storage/framework/views/fa489da8e4925cdecf906e81ff165dbe692a46b7.php(83): mail_image()\n#2 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/View/Engines/PhpEngine.php(43): include(\'/var/www/perpus...\')\n#3 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/View/Engines/CompilerEngine.php(59): Illuminate\\View\\Engines\\PhpEngine->evaluatePath()\n#4 /var/www/perpus_smk7/vendor/facade/ignition/src/Views/Engines/CompilerEngine.php(36): Illuminate\\View\\Engines\\CompilerEngine->get()\n#5 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/View/View.php(143): Facade\\Ignition\\Views\\Engines\\CompilerEngine->get()\n#6 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/View/View.php(126): Illuminate\\View\\View->getContents()\n#7 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/View/View.php(91): Illuminate\\View\\View->renderContents()\n#8 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(355): Illuminate\\View\\View->render()\n#9 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(328): Illuminate\\Mail\\Mailer->renderView()\n#10 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(246): Illuminate\\Mail\\Mailer->addContent()\n#11 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(159): Illuminate\\Mail\\Mailer->send()\n#12 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Support/Traits/Localizable.php(19): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}()\n#13 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(160): Illuminate\\Mail\\Mailable->withLocale()\n#14 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(277): Illuminate\\Mail\\Mailable->send()\n#15 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(231): Illuminate\\Mail\\Mailer->sendMailable()\n#16 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Mail/PendingMail.php(121): Illuminate\\Mail\\Mailer->send()\n#17 /var/www/perpus_smk7/app/Jobs/SendMailJob.php(38): Illuminate\\Mail\\PendingMail->send()\n#18 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): App\\Jobs\\SendMailJob->handle()\n#19 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#20 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#21 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#22 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/Container.php(590): Illuminate\\Container\\BoundMethod::call()\n#23 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(94): Illuminate\\Container\\Container->call()\n#24 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(130): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#25 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(105): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#26 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(98): Illuminate\\Pipeline\\Pipeline->then()\n#27 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(83): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#28 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(130): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#29 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(105): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#30 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(85): Illuminate\\Pipeline\\Pipeline->then()\n#31 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(59): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#32 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(88): Illuminate\\Queue\\CallQueuedHandler->call()\n#33 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(368): Illuminate\\Queue\\Jobs\\Job->fire()\n#34 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(314): Illuminate\\Queue\\Worker->process()\n#35 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(134): Illuminate\\Queue\\Worker->runJob()\n#36 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(112): Illuminate\\Queue\\Worker->daemon()\n#37 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(96): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#38 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#39 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#40 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#41 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#42 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/Container.php(590): Illuminate\\Container\\BoundMethod::call()\n#43 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Console/Command.php(134): Illuminate\\Container\\Container->call()\n#44 /var/www/perpus_smk7/vendor/symfony/console/Command/Command.php(255): Illuminate\\Console\\Command->execute()\n#45 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Console/Command.php(121): Symfony\\Component\\Console\\Command\\Command->run()\n#46 /var/www/perpus_smk7/vendor/symfony/console/Application.php(1009): Illuminate\\Console\\Command->run()\n#47 /var/www/perpus_smk7/vendor/symfony/console/Application.php(273): Symfony\\Component\\Console\\Application->doRunCommand()\n#48 /var/www/perpus_smk7/vendor/symfony/console/Application.php(149): Symfony\\Component\\Console\\Application->doRun()\n#49 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Console/Application.php(93): Symfony\\Component\\Console\\Application->run()\n#50 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(131): Illuminate\\Console\\Application->run()\n#51 /var/www/perpus_smk7/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle()\n#52 {main}\n\nNext Facade\\Ignition\\Exceptions\\ViewException: Undefined index: HTTP_HOST (View: /var/www/perpus_smk7/resources/views/Email/main.blade.php) in /var/www/perpus_smk7/app/Helper/helper.php:10\nStack trace:\n#0 /var/www/perpus_smk7/app/Helper/helper.php(10): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->handleError()\n#1 /var/www/perpus_smk7/resources/views/Email/main.blade.php(83): mail_image()\n#2 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/View/Engines/PhpEngine.php(43): include(\'/var/www/perpus...\')\n#3 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/View/Engines/CompilerEngine.php(59): Illuminate\\View\\Engines\\PhpEngine->evaluatePath()\n#4 /var/www/perpus_smk7/vendor/facade/ignition/src/Views/Engines/CompilerEngine.php(36): Illuminate\\View\\Engines\\CompilerEngine->get()\n#5 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/View/View.php(143): Facade\\Ignition\\Views\\Engines\\CompilerEngine->get()\n#6 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/View/View.php(126): Illuminate\\View\\View->getContents()\n#7 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/View/View.php(91): Illuminate\\View\\View->renderContents()\n#8 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(355): Illuminate\\View\\View->render()\n#9 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(328): Illuminate\\Mail\\Mailer->renderView()\n#10 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(246): Illuminate\\Mail\\Mailer->addContent()\n#11 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(159): Illuminate\\Mail\\Mailer->send()\n#12 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Support/Traits/Localizable.php(19): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}()\n#13 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(160): Illuminate\\Mail\\Mailable->withLocale()\n#14 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(277): Illuminate\\Mail\\Mailable->send()\n#15 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(231): Illuminate\\Mail\\Mailer->sendMailable()\n#16 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Mail/PendingMail.php(121): Illuminate\\Mail\\Mailer->send()\n#17 /var/www/perpus_smk7/app/Jobs/SendMailJob.php(38): Illuminate\\Mail\\PendingMail->send()\n#18 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): App\\Jobs\\SendMailJob->handle()\n#19 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#20 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#21 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#22 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/Container.php(590): Illuminate\\Container\\BoundMethod::call()\n#23 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(94): Illuminate\\Container\\Container->call()\n#24 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(130): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#25 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(105): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#26 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(98): Illuminate\\Pipeline\\Pipeline->then()\n#27 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(83): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#28 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(130): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#29 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(105): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#30 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(85): Illuminate\\Pipeline\\Pipeline->then()\n#31 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(59): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#32 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(88): Illuminate\\Queue\\CallQueuedHandler->call()\n#33 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(368): Illuminate\\Queue\\Jobs\\Job->fire()\n#34 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(314): Illuminate\\Queue\\Worker->process()\n#35 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(134): Illuminate\\Queue\\Worker->runJob()\n#36 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(112): Illuminate\\Queue\\Worker->daemon()\n#37 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(96): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#38 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#39 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#40 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#41 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#42 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/Container.php(590): Illuminate\\Container\\BoundMethod::call()\n#43 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Console/Command.php(134): Illuminate\\Container\\Container->call()\n#44 /var/www/perpus_smk7/vendor/symfony/console/Command/Command.php(255): Illuminate\\Console\\Command->execute()\n#45 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Console/Command.php(121): Symfony\\Component\\Console\\Command\\Command->run()\n#46 /var/www/perpus_smk7/vendor/symfony/console/Application.php(1009): Illuminate\\Console\\Command->run()\n#47 /var/www/perpus_smk7/vendor/symfony/console/Application.php(273): Symfony\\Component\\Console\\Application->doRunCommand()\n#48 /var/www/perpus_smk7/vendor/symfony/console/Application.php(149): Symfony\\Component\\Console\\Application->doRun()\n#49 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Console/Application.php(93): Symfony\\Component\\Console\\Application->run()\n#50 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(131): Illuminate\\Console\\Application->run()\n#51 /var/www/perpus_smk7/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle()\n#52 {main}', '2021-04-24 12:41:53');
INSERT INTO `failed_jobs` (`id`, `connection`, `queue`, `payload`, `exception`, `failed_at`) VALUES
(7, 'database', 'default', '{\"displayName\":\"App\\\\Jobs\\\\SendMailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendMailJob\",\"command\":\"O:20:\\\"App\\\\Jobs\\\\SendMailJob\\\":9:{s:7:\\\"\\u0000*\\u0000mail\\\";a:4:{s:5:\\\"email\\\";s:28:\\\"hafidluqmanulhakim@gmail.com\\\";s:10:\\\"judul_buku\\\";s:31:\\\"Bahasa Indonesia Kelas XII K-13\\\";s:12:\\\"nama_anggota\\\";s:22:\\\"Hafiidh Luqmanul Hakim\\\";s:21:\\\"tanggal_harus_kembali\\\";s:10:\\\"2021-04-27\\\";}s:6:\\\"\\u0000*\\u0000job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'ErrorException: Undefined index: SERVER_NAME in /var/www/perpus_smk7/app/Helper/helper.php:10\nStack trace:\n#0 /var/www/perpus_smk7/app/Helper/helper.php(10): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->handleError()\n#1 /var/www/perpus_smk7/storage/framework/views/fa489da8e4925cdecf906e81ff165dbe692a46b7.php(83): mail_image()\n#2 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/View/Engines/PhpEngine.php(43): include(\'/var/www/perpus...\')\n#3 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/View/Engines/CompilerEngine.php(59): Illuminate\\View\\Engines\\PhpEngine->evaluatePath()\n#4 /var/www/perpus_smk7/vendor/facade/ignition/src/Views/Engines/CompilerEngine.php(36): Illuminate\\View\\Engines\\CompilerEngine->get()\n#5 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/View/View.php(143): Facade\\Ignition\\Views\\Engines\\CompilerEngine->get()\n#6 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/View/View.php(126): Illuminate\\View\\View->getContents()\n#7 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/View/View.php(91): Illuminate\\View\\View->renderContents()\n#8 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(355): Illuminate\\View\\View->render()\n#9 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(328): Illuminate\\Mail\\Mailer->renderView()\n#10 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(246): Illuminate\\Mail\\Mailer->addContent()\n#11 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(159): Illuminate\\Mail\\Mailer->send()\n#12 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Support/Traits/Localizable.php(19): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}()\n#13 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(160): Illuminate\\Mail\\Mailable->withLocale()\n#14 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(277): Illuminate\\Mail\\Mailable->send()\n#15 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(231): Illuminate\\Mail\\Mailer->sendMailable()\n#16 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Mail/PendingMail.php(121): Illuminate\\Mail\\Mailer->send()\n#17 /var/www/perpus_smk7/app/Jobs/SendMailJob.php(38): Illuminate\\Mail\\PendingMail->send()\n#18 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): App\\Jobs\\SendMailJob->handle()\n#19 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#20 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#21 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#22 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/Container.php(590): Illuminate\\Container\\BoundMethod::call()\n#23 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(94): Illuminate\\Container\\Container->call()\n#24 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(130): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#25 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(105): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#26 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(98): Illuminate\\Pipeline\\Pipeline->then()\n#27 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(83): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#28 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(130): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#29 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(105): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#30 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(85): Illuminate\\Pipeline\\Pipeline->then()\n#31 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(59): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#32 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(88): Illuminate\\Queue\\CallQueuedHandler->call()\n#33 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(368): Illuminate\\Queue\\Jobs\\Job->fire()\n#34 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(314): Illuminate\\Queue\\Worker->process()\n#35 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(134): Illuminate\\Queue\\Worker->runJob()\n#36 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(112): Illuminate\\Queue\\Worker->daemon()\n#37 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(96): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#38 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#39 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#40 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#41 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#42 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/Container.php(590): Illuminate\\Container\\BoundMethod::call()\n#43 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Console/Command.php(134): Illuminate\\Container\\Container->call()\n#44 /var/www/perpus_smk7/vendor/symfony/console/Command/Command.php(255): Illuminate\\Console\\Command->execute()\n#45 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Console/Command.php(121): Symfony\\Component\\Console\\Command\\Command->run()\n#46 /var/www/perpus_smk7/vendor/symfony/console/Application.php(1009): Illuminate\\Console\\Command->run()\n#47 /var/www/perpus_smk7/vendor/symfony/console/Application.php(273): Symfony\\Component\\Console\\Application->doRunCommand()\n#48 /var/www/perpus_smk7/vendor/symfony/console/Application.php(149): Symfony\\Component\\Console\\Application->doRun()\n#49 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Console/Application.php(93): Symfony\\Component\\Console\\Application->run()\n#50 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(131): Illuminate\\Console\\Application->run()\n#51 /var/www/perpus_smk7/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle()\n#52 {main}\n\nNext Facade\\Ignition\\Exceptions\\ViewException: Undefined index: SERVER_NAME (View: /var/www/perpus_smk7/resources/views/Email/main.blade.php) in /var/www/perpus_smk7/app/Helper/helper.php:10\nStack trace:\n#0 /var/www/perpus_smk7/app/Helper/helper.php(10): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->handleError()\n#1 /var/www/perpus_smk7/resources/views/Email/main.blade.php(83): mail_image()\n#2 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/View/Engines/PhpEngine.php(43): include(\'/var/www/perpus...\')\n#3 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/View/Engines/CompilerEngine.php(59): Illuminate\\View\\Engines\\PhpEngine->evaluatePath()\n#4 /var/www/perpus_smk7/vendor/facade/ignition/src/Views/Engines/CompilerEngine.php(36): Illuminate\\View\\Engines\\CompilerEngine->get()\n#5 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/View/View.php(143): Facade\\Ignition\\Views\\Engines\\CompilerEngine->get()\n#6 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/View/View.php(126): Illuminate\\View\\View->getContents()\n#7 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/View/View.php(91): Illuminate\\View\\View->renderContents()\n#8 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(355): Illuminate\\View\\View->render()\n#9 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(328): Illuminate\\Mail\\Mailer->renderView()\n#10 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(246): Illuminate\\Mail\\Mailer->addContent()\n#11 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(159): Illuminate\\Mail\\Mailer->send()\n#12 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Support/Traits/Localizable.php(19): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}()\n#13 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(160): Illuminate\\Mail\\Mailable->withLocale()\n#14 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(277): Illuminate\\Mail\\Mailable->send()\n#15 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(231): Illuminate\\Mail\\Mailer->sendMailable()\n#16 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Mail/PendingMail.php(121): Illuminate\\Mail\\Mailer->send()\n#17 /var/www/perpus_smk7/app/Jobs/SendMailJob.php(38): Illuminate\\Mail\\PendingMail->send()\n#18 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): App\\Jobs\\SendMailJob->handle()\n#19 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#20 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#21 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#22 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/Container.php(590): Illuminate\\Container\\BoundMethod::call()\n#23 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(94): Illuminate\\Container\\Container->call()\n#24 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(130): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#25 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(105): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#26 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(98): Illuminate\\Pipeline\\Pipeline->then()\n#27 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(83): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#28 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(130): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#29 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(105): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#30 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(85): Illuminate\\Pipeline\\Pipeline->then()\n#31 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(59): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#32 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(88): Illuminate\\Queue\\CallQueuedHandler->call()\n#33 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(368): Illuminate\\Queue\\Jobs\\Job->fire()\n#34 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(314): Illuminate\\Queue\\Worker->process()\n#35 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(134): Illuminate\\Queue\\Worker->runJob()\n#36 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(112): Illuminate\\Queue\\Worker->daemon()\n#37 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(96): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#38 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#39 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#40 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#41 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#42 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/Container.php(590): Illuminate\\Container\\BoundMethod::call()\n#43 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Console/Command.php(134): Illuminate\\Container\\Container->call()\n#44 /var/www/perpus_smk7/vendor/symfony/console/Command/Command.php(255): Illuminate\\Console\\Command->execute()\n#45 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Console/Command.php(121): Symfony\\Component\\Console\\Command\\Command->run()\n#46 /var/www/perpus_smk7/vendor/symfony/console/Application.php(1009): Illuminate\\Console\\Command->run()\n#47 /var/www/perpus_smk7/vendor/symfony/console/Application.php(273): Symfony\\Component\\Console\\Application->doRunCommand()\n#48 /var/www/perpus_smk7/vendor/symfony/console/Application.php(149): Symfony\\Component\\Console\\Application->doRun()\n#49 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Console/Application.php(93): Symfony\\Component\\Console\\Application->run()\n#50 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(131): Illuminate\\Console\\Application->run()\n#51 /var/www/perpus_smk7/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle()\n#52 {main}', '2021-04-24 12:49:49'),
(8, 'database', 'default', '{\"displayName\":\"App\\\\Jobs\\\\SendMailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendMailJob\",\"command\":\"O:20:\\\"App\\\\Jobs\\\\SendMailJob\\\":9:{s:7:\\\"\\u0000*\\u0000mail\\\";a:4:{s:5:\\\"email\\\";s:28:\\\"hafidluqmanulhakim@gmail.com\\\";s:10:\\\"judul_buku\\\";s:31:\\\"Bahasa Indonesia Kelas XII K-13\\\";s:12:\\\"nama_anggota\\\";s:22:\\\"Hafiidh Luqmanul Hakim\\\";s:21:\\\"tanggal_harus_kembali\\\";s:10:\\\"2021-04-27\\\";}s:6:\\\"\\u0000*\\u0000job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'Swift_IoException: Unable to open file for reading [/var/www/perpus_smk7/storage/app/16576.jpg] in /var/www/perpus_smk7/vendor/swiftmailer/swiftmailer/lib/classes/Swift/ByteStream/FileByteStream.php:131\nStack trace:\n#0 /var/www/perpus_smk7/vendor/swiftmailer/swiftmailer/lib/classes/Swift/ByteStream/FileByteStream.php(77): Swift_ByteStream_FileByteStream->getReadHandle()\n#1 /var/www/perpus_smk7/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Mime/ContentEncoder/Base64ContentEncoder.php(40): Swift_ByteStream_FileByteStream->read()\n#2 /var/www/perpus_smk7/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Mime/SimpleMimeEntity.php(555): Swift_Mime_ContentEncoder_Base64ContentEncoder->encodeByteStream()\n#3 /var/www/perpus_smk7/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Mime/SimpleMimeEntity.php(532): Swift_Mime_SimpleMimeEntity->bodyToByteStream()\n#4 /var/www/perpus_smk7/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Mime/SimpleMimeEntity.php(570): Swift_Mime_SimpleMimeEntity->toByteStream()\n#5 /var/www/perpus_smk7/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Mime/SimpleMimeEntity.php(532): Swift_Mime_SimpleMimeEntity->bodyToByteStream()\n#6 /var/www/perpus_smk7/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Mime/SimpleMessage.php(601): Swift_Mime_SimpleMimeEntity->toByteStream()\n#7 /var/www/perpus_smk7/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Message.php(162): Swift_Mime_SimpleMessage->toByteStream()\n#8 /var/www/perpus_smk7/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/AbstractSmtpTransport.php(400): Swift_Message->toByteStream()\n#9 /var/www/perpus_smk7/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/AbstractSmtpTransport.php(502): Swift_Transport_AbstractSmtpTransport->streamMessage()\n#10 /var/www/perpus_smk7/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/AbstractSmtpTransport.php(518): Swift_Transport_AbstractSmtpTransport->doMailTransaction()\n#11 /var/www/perpus_smk7/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/AbstractSmtpTransport.php(206): Swift_Transport_AbstractSmtpTransport->sendTo()\n#12 /var/www/perpus_smk7/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Mailer.php(71): Swift_Transport_AbstractSmtpTransport->send()\n#13 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(488): Swift_Mailer->send()\n#14 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(261): Illuminate\\Mail\\Mailer->sendSwiftMessage()\n#15 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(159): Illuminate\\Mail\\Mailer->send()\n#16 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Support/Traits/Localizable.php(19): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}()\n#17 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(160): Illuminate\\Mail\\Mailable->withLocale()\n#18 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(277): Illuminate\\Mail\\Mailable->send()\n#19 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(231): Illuminate\\Mail\\Mailer->sendMailable()\n#20 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Mail/PendingMail.php(121): Illuminate\\Mail\\Mailer->send()\n#21 /var/www/perpus_smk7/app/Jobs/SendMailJob.php(38): Illuminate\\Mail\\PendingMail->send()\n#22 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): App\\Jobs\\SendMailJob->handle()\n#23 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#24 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#25 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#26 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/Container.php(590): Illuminate\\Container\\BoundMethod::call()\n#27 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(94): Illuminate\\Container\\Container->call()\n#28 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(130): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#29 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(105): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#30 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(98): Illuminate\\Pipeline\\Pipeline->then()\n#31 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(83): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#32 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(130): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#33 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(105): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#34 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(85): Illuminate\\Pipeline\\Pipeline->then()\n#35 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(59): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#36 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(88): Illuminate\\Queue\\CallQueuedHandler->call()\n#37 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(368): Illuminate\\Queue\\Jobs\\Job->fire()\n#38 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(314): Illuminate\\Queue\\Worker->process()\n#39 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(134): Illuminate\\Queue\\Worker->runJob()\n#40 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(112): Illuminate\\Queue\\Worker->daemon()\n#41 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(96): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#42 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#43 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#44 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#45 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#46 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/Container.php(590): Illuminate\\Container\\BoundMethod::call()\n#47 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Console/Command.php(134): Illuminate\\Container\\Container->call()\n#48 /var/www/perpus_smk7/vendor/symfony/console/Command/Command.php(255): Illuminate\\Console\\Command->execute()\n#49 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Console/Command.php(121): Symfony\\Component\\Console\\Command\\Command->run()\n#50 /var/www/perpus_smk7/vendor/symfony/console/Application.php(1009): Illuminate\\Console\\Command->run()\n#51 /var/www/perpus_smk7/vendor/symfony/console/Application.php(273): Symfony\\Component\\Console\\Application->doRunCommand()\n#52 /var/www/perpus_smk7/vendor/symfony/console/Application.php(149): Symfony\\Component\\Console\\Application->doRun()\n#53 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Console/Application.php(93): Symfony\\Component\\Console\\Application->run()\n#54 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(131): Illuminate\\Console\\Application->run()\n#55 /var/www/perpus_smk7/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle()\n#56 {main}', '2021-04-24 12:53:05'),
(9, 'database', 'default', '{\"displayName\":\"App\\\\Jobs\\\\SendMailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendMailJob\",\"command\":\"O:20:\\\"App\\\\Jobs\\\\SendMailJob\\\":9:{s:7:\\\"\\u0000*\\u0000mail\\\";a:4:{s:5:\\\"email\\\";s:28:\\\"hafidluqmanulhakim@gmail.com\\\";s:10:\\\"judul_buku\\\";s:25:\\\"Matematika Kelas XII K-13\\\";s:12:\\\"nama_anggota\\\";s:22:\\\"Hafiidh Luqmanul Hakim\\\";s:21:\\\"tanggal_harus_kembali\\\";s:10:\\\"2021-04-27\\\";}s:6:\\\"\\u0000*\\u0000job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'Swift_IoException: Unable to open file for reading [/var/www/perpus_smk7/storage/app/16576.jpg] in /var/www/perpus_smk7/vendor/swiftmailer/swiftmailer/lib/classes/Swift/ByteStream/FileByteStream.php:131\nStack trace:\n#0 /var/www/perpus_smk7/vendor/swiftmailer/swiftmailer/lib/classes/Swift/ByteStream/FileByteStream.php(77): Swift_ByteStream_FileByteStream->getReadHandle()\n#1 /var/www/perpus_smk7/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Mime/ContentEncoder/Base64ContentEncoder.php(40): Swift_ByteStream_FileByteStream->read()\n#2 /var/www/perpus_smk7/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Mime/SimpleMimeEntity.php(555): Swift_Mime_ContentEncoder_Base64ContentEncoder->encodeByteStream()\n#3 /var/www/perpus_smk7/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Mime/SimpleMimeEntity.php(532): Swift_Mime_SimpleMimeEntity->bodyToByteStream()\n#4 /var/www/perpus_smk7/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Mime/SimpleMimeEntity.php(570): Swift_Mime_SimpleMimeEntity->toByteStream()\n#5 /var/www/perpus_smk7/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Mime/SimpleMimeEntity.php(532): Swift_Mime_SimpleMimeEntity->bodyToByteStream()\n#6 /var/www/perpus_smk7/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Mime/SimpleMessage.php(601): Swift_Mime_SimpleMimeEntity->toByteStream()\n#7 /var/www/perpus_smk7/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Message.php(162): Swift_Mime_SimpleMessage->toByteStream()\n#8 /var/www/perpus_smk7/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/AbstractSmtpTransport.php(400): Swift_Message->toByteStream()\n#9 /var/www/perpus_smk7/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/AbstractSmtpTransport.php(502): Swift_Transport_AbstractSmtpTransport->streamMessage()\n#10 /var/www/perpus_smk7/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/AbstractSmtpTransport.php(518): Swift_Transport_AbstractSmtpTransport->doMailTransaction()\n#11 /var/www/perpus_smk7/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/AbstractSmtpTransport.php(206): Swift_Transport_AbstractSmtpTransport->sendTo()\n#12 /var/www/perpus_smk7/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Mailer.php(71): Swift_Transport_AbstractSmtpTransport->send()\n#13 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(488): Swift_Mailer->send()\n#14 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(261): Illuminate\\Mail\\Mailer->sendSwiftMessage()\n#15 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(159): Illuminate\\Mail\\Mailer->send()\n#16 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Support/Traits/Localizable.php(19): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}()\n#17 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(160): Illuminate\\Mail\\Mailable->withLocale()\n#18 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(277): Illuminate\\Mail\\Mailable->send()\n#19 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(231): Illuminate\\Mail\\Mailer->sendMailable()\n#20 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Mail/PendingMail.php(121): Illuminate\\Mail\\Mailer->send()\n#21 /var/www/perpus_smk7/app/Jobs/SendMailJob.php(38): Illuminate\\Mail\\PendingMail->send()\n#22 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): App\\Jobs\\SendMailJob->handle()\n#23 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#24 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#25 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#26 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/Container.php(590): Illuminate\\Container\\BoundMethod::call()\n#27 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(94): Illuminate\\Container\\Container->call()\n#28 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(130): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#29 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(105): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#30 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(98): Illuminate\\Pipeline\\Pipeline->then()\n#31 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(83): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#32 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(130): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#33 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(105): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#34 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(85): Illuminate\\Pipeline\\Pipeline->then()\n#35 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(59): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#36 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(88): Illuminate\\Queue\\CallQueuedHandler->call()\n#37 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(368): Illuminate\\Queue\\Jobs\\Job->fire()\n#38 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(314): Illuminate\\Queue\\Worker->process()\n#39 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(134): Illuminate\\Queue\\Worker->runJob()\n#40 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(112): Illuminate\\Queue\\Worker->daemon()\n#41 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(96): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#42 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#43 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#44 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#45 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#46 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/Container.php(590): Illuminate\\Container\\BoundMethod::call()\n#47 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Console/Command.php(134): Illuminate\\Container\\Container->call()\n#48 /var/www/perpus_smk7/vendor/symfony/console/Command/Command.php(255): Illuminate\\Console\\Command->execute()\n#49 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Console/Command.php(121): Symfony\\Component\\Console\\Command\\Command->run()\n#50 /var/www/perpus_smk7/vendor/symfony/console/Application.php(1009): Illuminate\\Console\\Command->run()\n#51 /var/www/perpus_smk7/vendor/symfony/console/Application.php(273): Symfony\\Component\\Console\\Application->doRunCommand()\n#52 /var/www/perpus_smk7/vendor/symfony/console/Application.php(149): Symfony\\Component\\Console\\Application->doRun()\n#53 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Console/Application.php(93): Symfony\\Component\\Console\\Application->run()\n#54 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(131): Illuminate\\Console\\Application->run()\n#55 /var/www/perpus_smk7/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle()\n#56 {main}', '2021-04-24 12:58:14'),
(10, 'database', 'default', '{\"displayName\":\"App\\\\Jobs\\\\SendMailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendMailJob\",\"command\":\"O:20:\\\"App\\\\Jobs\\\\SendMailJob\\\":9:{s:7:\\\"\\u0000*\\u0000mail\\\";a:4:{s:5:\\\"email\\\";s:28:\\\"hafidluqmanulhakim@gmail.com\\\";s:10:\\\"judul_buku\\\";s:31:\\\"Bahasa Indonesia Kelas XII K-13\\\";s:12:\\\"nama_anggota\\\";s:22:\\\"Hafiidh Luqmanul Hakim\\\";s:21:\\\"tanggal_harus_kembali\\\";s:10:\\\"2021-04-27\\\";}s:6:\\\"\\u0000*\\u0000job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'Illuminate\\Queue\\MaxAttemptsExceededException: App\\Jobs\\SendMailJob has been attempted too many times or run too long. The job may have previously timed out. in /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Worker.php:632\nStack trace:\n#0 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(165): Illuminate\\Queue\\Worker->maxAttemptsExceededException()\n#1 /var/www/perpus_smk7/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/StreamBuffer.php(162): Illuminate\\Queue\\Worker->Illuminate\\Queue\\{closure}()\n#2 /var/www/perpus_smk7/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/AbstractSmtpTransport.php(469): Swift_Transport_StreamBuffer->readLine()\n#3 /var/www/perpus_smk7/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/AbstractSmtpTransport.php(342): Swift_Transport_AbstractSmtpTransport->getFullResponse()\n#4 /var/www/perpus_smk7/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/EsmtpTransport.php(305): Swift_Transport_AbstractSmtpTransport->executeCommand()\n#5 /var/www/perpus_smk7/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/AbstractSmtpTransport.php(367): Swift_Transport_EsmtpTransport->executeCommand()\n#6 /var/www/perpus_smk7/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/EsmtpTransport.php(341): Swift_Transport_AbstractSmtpTransport->doHeloCommand()\n#7 /var/www/perpus_smk7/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/AbstractSmtpTransport.php(148): Swift_Transport_EsmtpTransport->doHeloCommand()\n#8 /var/www/perpus_smk7/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Mailer.php(65): Swift_Transport_AbstractSmtpTransport->start()\n#9 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(488): Swift_Mailer->send()\n#10 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(261): Illuminate\\Mail\\Mailer->sendSwiftMessage()\n#11 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(159): Illuminate\\Mail\\Mailer->send()\n#12 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Support/Traits/Localizable.php(19): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}()\n#13 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(160): Illuminate\\Mail\\Mailable->withLocale()\n#14 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(277): Illuminate\\Mail\\Mailable->send()\n#15 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(231): Illuminate\\Mail\\Mailer->sendMailable()\n#16 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Mail/PendingMail.php(121): Illuminate\\Mail\\Mailer->send()\n#17 /var/www/perpus_smk7/app/Jobs/SendMailJob.php(38): Illuminate\\Mail\\PendingMail->send()\n#18 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): App\\Jobs\\SendMailJob->handle()\n#19 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#20 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#21 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#22 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/Container.php(590): Illuminate\\Container\\BoundMethod::call()\n#23 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(94): Illuminate\\Container\\Container->call()\n#24 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(130): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#25 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(105): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#26 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(98): Illuminate\\Pipeline\\Pipeline->then()\n#27 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(83): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#28 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(130): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#29 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(105): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#30 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(85): Illuminate\\Pipeline\\Pipeline->then()\n#31 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(59): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#32 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(88): Illuminate\\Queue\\CallQueuedHandler->call()\n#33 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(368): Illuminate\\Queue\\Jobs\\Job->fire()\n#34 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(314): Illuminate\\Queue\\Worker->process()\n#35 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(134): Illuminate\\Queue\\Worker->runJob()\n#36 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(112): Illuminate\\Queue\\Worker->daemon()\n#37 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(96): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#38 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#39 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#40 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#41 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#42 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Container/Container.php(590): Illuminate\\Container\\BoundMethod::call()\n#43 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Console/Command.php(134): Illuminate\\Container\\Container->call()\n#44 /var/www/perpus_smk7/vendor/symfony/console/Command/Command.php(255): Illuminate\\Console\\Command->execute()\n#45 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Console/Command.php(121): Symfony\\Component\\Console\\Command\\Command->run()\n#46 /var/www/perpus_smk7/vendor/symfony/console/Application.php(1009): Illuminate\\Console\\Command->run()\n#47 /var/www/perpus_smk7/vendor/symfony/console/Application.php(273): Symfony\\Component\\Console\\Application->doRunCommand()\n#48 /var/www/perpus_smk7/vendor/symfony/console/Application.php(149): Symfony\\Component\\Console\\Application->doRun()\n#49 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Console/Application.php(93): Symfony\\Component\\Console\\Application->run()\n#50 /var/www/perpus_smk7/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(131): Illuminate\\Console\\Application->run()\n#51 /var/www/perpus_smk7/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle()\n#52 {main}', '2021-04-24 13:00:38');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `status_delete` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori_buku`
--

INSERT INTO `kategori_buku` (`id_kategori_buku`, `nama_kategori`, `slug_kategori`, `deskripsi_kategori`, `status_delete`, `created_at`, `updated_at`) VALUES
(1, 'Non referensi', 'non-referensi', 'Kategori Buku Pelajaran', 0, NULL, '2018-08-11 07:11:46'),
(2, 'Referensi', 'referensi', 'Bla bla bla bla bla', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int NOT NULL,
  `id_kelas_tingkat` int NOT NULL,
  `id_jurusan` int NOT NULL,
  `urutan_kelas` int NOT NULL,
  `status_delete` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `id_kelas_tingkat`, `id_jurusan`, `urutan_kelas`, `status_delete`) VALUES
(1, 2, 4, 1, 0),
(2, 3, 4, 1, 0),
(3, 4, 4, 1, 0),
(4, 2, 2, 1, 1),
(5, 3, 2, 1, 0),
(6, 4, 2, 1, 0),
(7, 2, 3, 1, 0),
(8, 3, 3, 1, 0),
(9, 4, 3, 1, 0),
(10, 2, 4, 2, 0),
(11, 1, 1, 0, 0),
(12, 3, 3, 2, 0);

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
(30, '2019_10_11_051113_create_notifications_table', 19),
(31, '2019_08_19_000000_create_failed_jobs_table', 20),
(32, '2021_04_23_192118_create_jobs_table', 20);

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
-- Table structure for table `panduan_pinjam`
--

CREATE TABLE `panduan_pinjam` (
  `id_panduan_pinjam` int NOT NULL,
  `langkah_panduan` varchar(30) NOT NULL,
  `isi_panduan` text NOT NULL,
  `foto_panduan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `panduan_pinjam`
--

INSERT INTO `panduan_pinjam` (`id_panduan_pinjam`, `langkah_panduan`, `isi_panduan`, `foto_panduan`) VALUES
(1, 'Langkah 1', 'Login di halaman login untuk melakukan transaksi peminjaman buku', '_foto_panduan_6071cb0c0fd08Screen Shot 2021-04-10 at 23.57.48.png'),
(2, 'Langkah 2', 'Cari buku yang ingin dipinjam, pencarian dapat dilakukan berdasarkan filter order buku, pencarian buku, dan mencari buku sesuai kategori atau sub kategori di menu sidebar', '_foto_panduan_6071cb928fc3cScreen Shot 2020-11-10 at 12.32.45.png'),
(3, 'Langkah 3', 'Baca peraturan terlebih dahulu serta perhatikan tanggal maximal pengembalian, peraturan wajib dipahami agar bisa meminjam, klik menyetujui agar dapat mengklik tombol pinjam', '_foto_panduan_6071cc0081dafScreen Shot 2021-04-11 at 00.00.54.png'),
(4, 'Langkah 4', 'Setelah mengklik tombol pinjam maka status peminjaman akan muncul dengan tulisan \"pending\". Kunjungi perpustakaan dan lakukan konfirmasi kepada petugas perpustakaan untuk peminjaman dan pengambilan buku', '_foto_panduan_6071cc8cf182dScreen Shot 2021-04-11 at 00.02.52.png'),
(5, 'Langkah 5', 'Jika petugas sudah mengkonfirmasi peminjaman, harap simpan dan rawat buku dengan baik jangan sampai hilang. Pantau juga daftar peminjaman buku di halaman profile', '_foto_panduan_6071ce443e65cScreen Shot 2021-04-11 at 00.11.34.png'),
(6, 'Langkah 6', 'Di halaman detail pinjam terdapat tanggal pinjam, tanggal maximal pengembalian, dan status peminjaman. Selalu pantau agar ingat tanggal pengembalian', '_foto_panduan_6071ce958ac1bScreen Shot 2021-04-11 at 00.09.39.png');

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
  `jabatan` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_profile` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `id_users`, `nip`, `nama_petugas`, `jabatan`, `foto_profile`) VALUES
(2, 16, '19670512 200701 1 038', 'Khairul Anam, M.Pd', 'kepala-perpustakaan', '-'),
(4, 31, '-', 'Ferdiana Tri Ulandari, S.Kom', 'pustakawan', '_foto_petugas_6083c1c7b3be4pngkey.com-avatar-png-1149878.png');

-- --------------------------------------------------------

--
-- Table structure for table `pin_buku_tamu`
--

CREATE TABLE `pin_buku_tamu` (
  `id_pin_buku_tamu` int NOT NULL,
  `pin_buku_tamu` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pin_buku_tamu`
--

INSERT INTO `pin_buku_tamu` (`id_pin_buku_tamu`, `pin_buku_tamu`) VALUES
(1, 2120);

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
  `status_delete` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_kategori`
--

INSERT INTO `sub_kategori` (`id_sub_ktg`, `id_kategori_buku`, `nama_sub`, `slug_sub_ktg`, `deskripsi_sub`, `status_delete`, `created_at`, `updated_at`) VALUES
(1, 2, 'Rekayasa Perangkat Lunak', 'rekayasa-perangkat-lunak', 'Sub Kategori Rekayasa Perangkat Lunak adalah ....', 0, NULL, NULL),
(2, 2, 'Multimedia', 'multimedia', 'Sub Kategori Multimedia adalah ...', 0, NULL, NULL),
(3, 2, 'Teknik Komputer Jaringan\r\n', 'teknik-komputer-jaringan', 'Sub Kategori Teknik Komputer Jaringan adalah ...', 0, NULL, NULL),
(4, 1, 'Pelajaran', 'pelajaran', 'Sub Kategori Buku Pelajaran', 0, '2018-08-11 07:13:21', '2018-08-11 07:13:21');

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
(1, '001/Perpus/04/2021', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tahun_ajaran`
--

CREATE TABLE `tahun_ajaran` (
  `id_tahun_ajaran` int NOT NULL,
  `tahun_ajaran` varchar(10) NOT NULL,
  `status_delete` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tahun_ajaran`
--

INSERT INTO `tahun_ajaran` (`id_tahun_ajaran`, `tahun_ajaran`, `status_delete`) VALUES
(1, '-', 0),
(2, '2018/2019', 1),
(3, '2017/2018', 0),
(4, '2019/2018', 0),
(5, '2021/2022', 0);

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
(11, 1, NULL),
(12, 4, NULL),
(13, 11, NULL),
(15, 6, NULL),
(16, 9, NULL),
(17, 12, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` int NOT NULL,
  `name` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
(1, 'Administrator SMK 7', 'admin', '$2y$10$x44D0Pclz570dxhOqAsD6.VNr9aDy04CX7w.gZ1nDjhAKxG/4Vu8C', 'k1FnKfGIB8HKV6EabkmW5oHH4SjOrggZl5En39Vxhh0UsuvIKJETb4UT04FH', 2, 1, 0, '2018-06-21 13:12:39', '2017-07-16 03:52:48', '2021-04-20 21:50:02'),
(3, 'Hafiidh Luqmanul Hakim', 'hafidlh', '$2y$10$9II9gIVOMrHHOBJqlzSmneA.zhKTpDVecYJvAGZHWFsNQXGrshCgW', 'ldhGzTxxDMVTF38NoNKcMNlwqqLPDOWvDxXxJQgyR7tKoGSfwpcvReOCrcqY', 0, 1, 0, '2018-07-02 02:23:25', '2017-09-07 15:54:05', '2020-12-23 06:49:35'),
(4, 'Muhammad Ilham', 'ilham', '$2y$10$tD3vwSfLWgGAsBtLue/Dwuqs6sp1LsinmT4Z/B2frj6e7noh8BwXi', 'dPsXKQg66vplI3lnxecKCP7GFy7AtSbAYyanXleWm31JO6FSB88qFZjHwz4B', 0, 1, 0, '2017-10-27 05:13:00', '2017-08-06 01:22:09', '2017-10-26 21:13:00'),
(7, 'Raihan Febryan', 'raihan', '$2y$10$Wl5WEj3Drgs8veoZnWYOy.WRcpUVaV8y9LluZ0k4Vkd90qQSvXYo2', '6MkooEHAQilt9L2CxFYKJf9crQLML0JgIjKLf27HN6pXL99yj5N6Hd36shga', 0, 1, 1, NULL, NULL, '2021-04-20 13:30:09'),
(13, 'Rohmat', 'rohmat', '$2y$10$TeOTDAEfbd/p7RpQSyJq2.sF0srj9YRJD6MXX6Wi2Aem5lQLCE3pO', NULL, 0, 1, 0, NULL, NULL, '2021-04-18 19:39:23'),
(16, 'Khairul Anam, M.Pd', 'anam', '$2y$10$1EOxruCVgVOhE.pabyFU7.IK4Jt.CKLGzRzQ1tfE7R2QhSHIwjtNq', NULL, 1, 1, 0, NULL, NULL, '2021-03-24 09:39:27'),
(22, 'Ahmad Munaroh', 'ahmadmunaroh', '$2y$10$FwiK5VRGosz57LftcCAXauBJv9kFc3WJbXzgYlz3FGInaDi2gGCDO', NULL, 0, 1, 0, NULL, NULL, NULL),
(25, 'Dimas Ridho Amalia', 'dimas', '$2y$10$XvER.SaXlkcIMVxJ7YxZz.LEhcpg09DsWZOKLy6G9bWhEkrPvfYMW', NULL, 0, 1, 0, NULL, NULL, NULL),
(30, 'Safira Dina Fakhirah', 'fira', '$2y$10$WgMN3uQDfxWSZ2Sfg6tI2eyH3hrNw6/sGew8LMZknzEzRGAwLlnYm', NULL, 0, 1, 0, NULL, NULL, NULL),
(31, 'Ferdiana Tri Ulandari, S.Kom', 'ferdiana', '$2y$10$nu2PKGR4vt5c1.sl2m4j3uObWyh1.9QGNCPEejNFTblJNjSJwubFG', NULL, 1, 1, 0, NULL, NULL, '2021-04-24 14:59:19');

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
-- Indexes for table `aturan_pinjam`
--
ALTER TABLE `aturan_pinjam`
  ADD PRIMARY KEY (`id_aturan_pinjam`);

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
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

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
-- Indexes for table `panduan_pinjam`
--
ALTER TABLE `panduan_pinjam`
  ADD PRIMARY KEY (`id_panduan_pinjam`);

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
-- Indexes for table `pin_buku_tamu`
--
ALTER TABLE `pin_buku_tamu`
  ADD PRIMARY KEY (`id_pin_buku_tamu`);

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
  MODIFY `id_anggota` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `anggota_perpus`
--
ALTER TABLE `anggota_perpus`
  MODIFY `id_anggota_perpus` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `aturan_pinjam`
--
ALTER TABLE `aturan_pinjam`
  MODIFY `id_aturan_pinjam` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id_buku_tamu` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detail_transaksi` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

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
  MODIFY `id_kelas` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `kelas_tingkat`
--
ALTER TABLE `kelas_tingkat`
  MODIFY `id_kelas_tingkat` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id_notif` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `panduan_pinjam`
--
ALTER TABLE `panduan_pinjam`
  MODIFY `id_panduan_pinjam` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pin_buku_tamu`
--
ALTER TABLE `pin_buku_tamu`
  MODIFY `id_pin_buku_tamu` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id_transaksi` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

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
  ADD CONSTRAINT `buku_tamu_ibfk_1` FOREIGN KEY (`id_anggota_perpus`) REFERENCES `anggota_perpus` (`id_anggota_perpus`) ON UPDATE CASCADE;

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
