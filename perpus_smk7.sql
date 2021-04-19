-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Apr 19, 2021 at 03:10 AM
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
  `foto_profile` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `id_users`, `nama_anggota`, `nama_slug`, `nmr_hp`, `nomor_induk`, `email`, `jenis_kelamin`, `tipe_anggota`, `foto_profile`) VALUES
(2, 3, 'Hafiidh Luqmanul Hakim', 'hafiidh-luqmanul-hakim', '085391791228', '0002792083', 'hafidluqmanulhakim@gmail.com', 'Laki-Laki', 'siswa', '-'),
(3, 4, 'M. Ilham', 'm-ilham', '085250654125', '0001403865', 'muhilham0603@gmail.com', 'Laki-Laki', 'siswa', '2017-08-06 09:22:09_laravel-programming.jpg'),
(6, 7, 'Raihan Febryan', 'raihan-febryan', '085391791228', '000238123', 'raihanfebryan@gmail.com', 'Laki-Laki', 'siswa', '-'),
(10, 13, 'Rohmat', 'rohmat', '08125125125', '00888888', 'Rohmat@gmail.com', 'Laki-Laki', 'guru', '-'),
(11, 22, 'Ahmad Munaroh', 'ahmad-munaroh', '088888888', '-', 'ahmadmunaroh@gmail.com', 'Laki-Laki', 'karyawan', '-'),
(12, 25, 'Dimas Ridho Amalia', 'dimas-ridho-amalia', '0888888888', '000123901239201', 'dimasuhuy@gmail.com', 'Laki-Laki', 'siswa', '-');

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
(1, 2, 3, 5),
(4, 3, 3, 5),
(6, 10, 11, 1),
(7, 6, 4, 5),
(9, 11, 1, 1),
(10, 6, 3, 5),
(11, 12, 3, 5);

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
('00206956-6c27-4c37-870a-10225360817d', '977811618561433', 12, NULL, NULL),
('02c41959-fa32-415b-9a6b-33dcba919616', '103161618561457', 6, NULL, NULL),
('037120bf-6e62-47e1-a2cd-74f5e2f8ac73', '247061618561457', 6, NULL, NULL),
('0418346e-047e-4cf0-a7d8-23a80cc51311', '565421618561450', 8, NULL, NULL),
('04921ca7-5503-4baf-8229-1e8996540092', '919771618561432', 12, NULL, NULL),
('059678f7-d74d-4be6-8875-6b0eba1358fa', '217131618561432', 12, NULL, NULL),
('07334a3a-f2d1-4266-a94b-4aee07077c69', '997851618561456', 6, NULL, NULL),
('086ae569-9ad6-4a2a-8bf0-e410928167da', '675321618561457', 6, NULL, NULL),
('093887b7-ae3c-4ea3-8313-fd4fe2ff4dc7', '502111618561433', 12, NULL, NULL),
('09bf309f-97d4-45f6-9f99-57366cc4d830', '813441618561457', 6, NULL, NULL),
('09c44a14-988c-405b-bb8d-14df99ebac29', '509531618561456', 6, NULL, NULL),
('0a4d36be-87f4-46a3-ae35-a32f73444fbb', '96911618561456', 6, NULL, NULL),
('0af37a18-39b6-4a01-8a2f-9977f7f32e2d', '651291618561457', 6, NULL, NULL),
('0bf354bd-1ecc-4bc2-9b25-a2cdcfe77a2c', '757681618561456', 6, NULL, NULL),
('0c59dcc6-ddd3-4e55-8b5a-b91c28b0da68', '353111618561456', 6, NULL, NULL),
('0fb681ff-9624-47e1-bbb2-75a63c882c2c', '770361618561456', 6, NULL, NULL),
('100ff81a-e9ef-4e9e-bcc2-7015c48f85e5', '468501618561456', 6, NULL, NULL),
('10f4aa12-a4a5-4959-9ff9-cbf1a8dd4369', '405951618561450', 8, NULL, NULL),
('113a445d-a6d8-42cf-b77e-963e68d77216', '255041618561456', 6, NULL, NULL),
('1278bc5d-b38d-474b-be00-c9b6c606ca4a', '993021618561457', 6, NULL, NULL),
('12c23d0f-36af-4b1b-b0cf-841b88ff0c89', '188981618561457', 6, NULL, NULL),
('12f17f7e-d5ec-401f-a432-4341babdca2d', '110091618561456', 6, NULL, NULL),
('130e9c73-ff41-44a9-a040-bdec3b1f1d7d', '742211618561432', 12, NULL, NULL),
('14161a2d-7ce8-4de5-b1cd-356b89c58465', '668251618561457', 6, NULL, NULL),
('1616e46c-2287-498d-a524-bace98b560b1', '675831618561456', 6, NULL, NULL),
('17321330-9091-450d-8ddf-07ee90aea71c', '158111618561457', 6, NULL, NULL),
('1833a6eb-ec18-4a9e-a041-e95aa3f424d0', '425161618561450', 8, NULL, NULL),
('184bf1da-703c-499f-9eb8-52d439e4e0fd', '239651618561457', 6, NULL, NULL),
('1877a5eb-169c-4ca3-a528-3d8523e64df4', '672091618561456', 6, NULL, NULL),
('18aab001-8191-4348-8b35-2024ecbeb9bf', '843101618561450', 8, NULL, NULL),
('1990bb32-eeda-4375-9fd7-9ed452f8b703', '770351618561457', 6, NULL, NULL),
('19d16c6c-8cca-43d0-b248-317cf14430c4', '175601618561456', 6, NULL, NULL),
('1a36b654-4a9a-435a-a3ba-d139b4688710', '161181618561427', 13, NULL, NULL),
('1ae5a314-fc4f-4a4b-8041-d317788e0111', '929101618561456', 6, NULL, NULL),
('1b30e6a1-aaaa-4777-90b2-1caac42a71f1', '881071618561457', 6, NULL, NULL),
('1f4a9472-0430-4697-9af4-9e01d05576b7', '192151618561441', 11, NULL, NULL),
('1f979b68-188d-415d-982f-1fe53ac5ea08', '843011618561457', 6, NULL, NULL),
('1fb1d5ef-20fd-4a3b-a771-d6a18d81748a', '361381618561457', 6, NULL, NULL),
('20989d47-1938-4b99-8e14-bebb0bd096f4', '208601618561302', 14, NULL, NULL),
('259f01f4-6f50-4427-a2f3-02d448207f80', '465131618561457', 6, NULL, NULL),
('25bbd67b-9c4f-4b11-8b30-c325afa71dd7', '263351618561450', 8, NULL, NULL),
('265c4727-e817-4834-8480-f1787da811de', '149281618561456', 6, NULL, NULL),
('27f1a158-51e3-4be1-bbd9-dcc64546ddec', '570991618561457', 6, NULL, NULL),
('27f5c19a-aea3-49c3-a6c2-b07fae9c0fac', '125341618561456', 6, NULL, NULL),
('280ab0eb-b2e8-4655-92ed-b6d400e47a25', '389291618561456', 6, NULL, NULL),
('28c5261e-1739-4fbf-832f-4bf31df7302c', '690021618561450', 8, NULL, NULL),
('291e5785-5eca-45df-a7c6-28713d388fea', '124411618561456', 6, NULL, NULL),
('29e551af-0df9-426f-b00a-28b474ebf358', '210771618561456', 6, NULL, NULL),
('2ac9f796-a34f-425f-9d2b-2d9473ec995f', '650041618561456', 6, NULL, NULL),
('2d1db608-786c-4cc4-a298-de8d57321aae', '358611618561427', 13, NULL, NULL),
('2e53b097-75ec-4b0f-9867-b27d3e0aa1f6', '399001618561468', 3, NULL, NULL),
('303f50b1-c1b3-468c-a971-691ff91f84f4', '640711618561441', 11, NULL, NULL),
('3125ac07-4868-47a0-aaef-34778299a634', '52041618561302', 14, NULL, NULL),
('32ecae84-dd17-4c14-90b1-dc53db29f0d7', '383661618561457', 6, NULL, NULL),
('33322e6b-7eba-42b1-8625-7e9e5c69d2d6', '80881618561456', 6, NULL, NULL),
('34143232-c00d-4dfb-a45e-8b2d921b7964', '549611618561457', 6, NULL, NULL),
('34e4147d-ad69-42da-8ebd-4e8f7fcee260', '157161618561450', 8, NULL, NULL),
('37028c55-8654-4f79-b35a-0fdd91c6378a', '633721618561457', 6, NULL, NULL),
('373b14c2-c422-46da-83cf-67e9cf48dcb6', '953901618561450', 8, NULL, NULL),
('37df38e5-6cfe-4a3e-a513-fe7d84531954', '610431618561450', 8, NULL, NULL),
('38d0c11b-8d81-4ae3-baf0-9cb4f0821ee6', '720741618561441', 11, NULL, NULL),
('3906e25e-5896-4db2-89b8-0c04e4a8bc52', '512721618561463', 5, NULL, NULL),
('39beb36a-be20-40c2-9595-4d11f2a76dea', '56471618561450', 8, NULL, NULL),
('3ab06872-ff17-4027-b605-3abca7993766', '866681618561457', 6, NULL, NULL),
('3ac8660d-b929-40ed-976f-2b8b044099ff', '293731618561427', 13, NULL, NULL),
('3b1b7af6-bf82-4874-b3fa-62ec5000b76f', '61301618561456', 6, NULL, NULL),
('3c906658-e955-4d85-a1ff-657192ae85ef', '827891618561432', 12, NULL, NULL),
('3d475623-6e1b-44da-80c1-c2f43076969d', '309581618561432', 12, NULL, NULL),
('3d51fd8a-6193-4bd4-8a78-416a409d22a3', '420761618561441', 11, NULL, NULL),
('3f02961e-ab38-4187-a025-6b66ed46c32d', '564791618561457', 6, NULL, NULL),
('410b51d4-ab3b-4594-9778-80a8c14e40fe', '746571618561456', 6, NULL, NULL),
('4115c8d7-04b0-4ca7-9e3a-5362d23f703a', '471151618561456', 6, NULL, NULL),
('411e471a-4d0a-4b9d-8762-b572c64488ea', '419581618561432', 12, NULL, NULL),
('4169ae43-4443-4a9d-89f0-88185002fb02', '403141618561457', 6, NULL, NULL),
('42413ced-47cc-45c0-bb1e-e986d82ead0f', '992401618561467', 3, NULL, NULL),
('42488417-8669-4e87-922c-bf464f77b2fb', '832731618561450', 8, NULL, NULL),
('4277ae37-0936-45da-83c0-77b2bdf918b3', '755731618561457', 6, NULL, NULL),
('43aa464a-225e-4825-883b-d7d6a7d21a58', '297691618561427', 13, NULL, NULL),
('442b737e-38ef-4cf9-ad29-8cd251ff76f6', '657901618561457', 6, NULL, NULL),
('45af074c-4d2a-4c2c-a243-b7aea48d3078', '38501618561456', 6, NULL, NULL),
('468140ed-379f-459d-bc89-5260e4516734', '79811618561441', 11, NULL, NULL),
('48eb265a-1e4d-439a-8ca2-8f935285bf14', '682931618561450', 8, NULL, NULL),
('4947300e-22e7-4710-8d5c-651c0d155c13', '931271618561457', 6, NULL, NULL),
('49e632b3-b87a-42d8-a788-19edef209d2b', '316931618561450', 8, NULL, NULL),
('4af0bc7b-b710-42df-a973-4c16b6239181', '651661618561468', 3, NULL, NULL),
('4bd2c29f-c85a-4616-a79f-9d87859d9cf7', '363891618561450', 8, NULL, NULL),
('4d02a086-6c31-4d95-9231-304ec68ed863', '966791618561302', 14, NULL, NULL),
('4d6cbc8d-7d80-49ce-9b8c-c4488208d65c', '467181618561467', 3, NULL, NULL),
('4e02b5de-3ab6-439b-a740-8fec093b0a8f', '595891618561456', 6, NULL, NULL),
('4e4d79f9-c31e-4389-b130-9ac25a4ad979', '422911618561432', 12, NULL, NULL),
('4e991fe5-e744-4acd-9f54-1fc9c230bc69', '968571618561456', 6, NULL, NULL),
('4eee9c8e-dc4a-4663-94ef-ef1af5edf0ca', '102671618561456', 6, NULL, NULL),
('5188c8d4-f21e-4f70-adaf-1ebc902ad977', '476021618561450', 8, NULL, NULL),
('52688c24-e24a-4f6e-9333-e97dc4b241f1', '447451618561457', 6, NULL, NULL),
('528f120e-fef1-4379-9ada-ce0a13330a39', '585061618561450', 8, NULL, NULL),
('52bcd924-2d3e-4c1e-b5a8-c7e5f87654bc', '255721618561456', 6, NULL, NULL),
('55788974-2609-4af5-b13c-6d2ddb6abad0', '291551618561468', 3, NULL, NULL),
('55aa8de3-34b6-4f2e-b76c-58a012d8f6ba', '448351618561456', 6, NULL, NULL),
('55f6d6ad-0653-4168-bb39-8c100bfe953d', '646121618561456', 6, NULL, NULL),
('5673565d-294d-4cde-bd66-c8d9b83e7671', '644501618561467', 3, NULL, NULL),
('56a08cf1-5b37-42f6-bf45-de33131aa1ea', '843061618561302', 14, NULL, NULL),
('5702c1f3-5843-4c36-8ec6-4a639e7999be', '563671618561457', 6, NULL, NULL),
('570ccc7b-e3f8-45a4-b517-78bc7cabe493', '240761618561457', 6, NULL, NULL),
('575c276f-2734-4b8d-81c4-c8fc374a9f01', '1121618561456', 6, NULL, NULL),
('5802b817-7f21-4478-a149-195b4641d82d', '44761618561432', 12, NULL, NULL),
('5ae0e335-82b5-45d4-ae8b-c7e65885c5ed', '766331618561468', 3, NULL, NULL),
('5b807ec7-8531-4171-8411-2267eb7d44b2', '124501618561456', 6, NULL, NULL),
('5c215e03-9d35-436e-a037-7029cfcc7f59', '496511618561456', 6, NULL, NULL),
('5fddc250-e3a6-4248-a251-7a48110ec801', '689421618561450', 8, NULL, NULL),
('60a983c8-cc11-4a5e-adfb-7f169b83dafd', '368541618561457', 6, NULL, NULL),
('62125d53-2a58-46ea-9126-183bf49eec88', '280261618561456', 6, NULL, NULL),
('62d87554-1dde-4663-904a-7c95b1816f3a', '568611618561302', 14, NULL, NULL),
('6670d1ee-0aa8-430a-9105-f896bddda405', '293901618561457', 6, NULL, NULL),
('667461e4-d29d-4dfa-9e52-0c8064829e2a', '671171618561450', 8, NULL, NULL),
('6699c7b3-b058-4b27-9501-e4194f7861cc', '254181618561450', 8, NULL, NULL),
('683f6ac8-393c-4fe6-8d23-af8712a4cbf7', '727921618561450', 8, NULL, NULL),
('6a8da8c6-f26a-42a2-95ea-e0265957dc81', '650941618561456', 6, NULL, NULL),
('6abe9b52-aea3-415d-840a-0d5c26ed576d', '412601618561456', 6, NULL, NULL),
('6af0aaad-f851-487d-9000-d6649e3c041b', '728551618561433', 12, NULL, NULL),
('6cafc16b-8a2e-44f3-bb68-744b84fbffce', '647081618561433', 12, NULL, NULL),
('6d9355d8-0475-4477-85b0-7bdf5cd52bd7', '267671618561432', 12, NULL, NULL),
('6e23747d-d9f7-4387-a53b-4f54b051355a', '728821618561450', 8, NULL, NULL),
('6f79eef8-95c3-405a-9a28-5e1044796b83', '968441618561456', 6, NULL, NULL),
('6fb4d578-d2d9-47cf-be29-db34b3db98ce', '196161618561450', 8, NULL, NULL),
('716b3032-f567-4cba-b3b9-aea962c670f5', '623381618561456', 6, NULL, NULL),
('7232e2f2-77ac-4d1e-a462-7f547cce9b82', '437171618561450', 8, NULL, NULL),
('72f24009-40a8-4ae4-b0e5-28e3289609b1', '486211618561456', 6, NULL, NULL),
('7511024e-553a-42af-9210-bd96e3a6d2f7', '242341618561302', 14, NULL, NULL),
('751639a8-f893-4c5e-af80-5b9f57cbf9fa', '825551618561450', 8, NULL, NULL),
('75ee4535-3295-4f6c-a2eb-80806470a6d6', '63971618561450', 8, NULL, NULL),
('779716e9-c021-4040-bfcf-973097ff44c7', '30351618561432', 12, NULL, NULL),
('7b3e29a5-d299-47f4-b7f1-dc732b5b141c', '300991618561450', 8, NULL, NULL),
('7ce6795c-9259-48c9-b205-cfb595ce9e43', '779141618561468', 3, NULL, NULL),
('7de24c88-8aae-40b1-9d1b-bb56c4337a63', '830411618561441', 11, NULL, NULL),
('7efac1ea-ffc5-4edd-83ac-a7e1a2ab3d6a', '510011618561457', 6, NULL, NULL),
('7fa63e8e-ff40-45c7-9626-5e249011529f', '410681618561450', 8, NULL, NULL),
('8075d6ca-05d7-48c1-9dcc-d498acfe20da', '155551618561432', 12, NULL, NULL),
('809a15ab-26fe-4f23-bc9c-19b7b79d43ec', '809061618561450', 8, NULL, NULL),
('810dd72f-48b1-46bf-8a00-118781955186', '367431618561456', 6, NULL, NULL),
('84f28b56-23d9-4751-9e1a-18785c762966', '979781618561456', 6, NULL, NULL),
('84f9850f-f27f-4705-aa7c-ed4f67214400', '976561618561456', 6, NULL, NULL),
('8643dc5b-ba8c-410a-b8cb-e14daddb96e4', '562881618561457', 6, NULL, NULL),
('89dc75e0-cfd6-4ce3-86bd-504816a9b7e0', '893991618561456', 6, NULL, NULL),
('8a1029d1-3d7d-43ab-b659-6d0b824d99d8', '632071618561457', 6, NULL, NULL),
('8b0417ae-40de-4dc5-bcad-10be6ade61f2', '763941618561456', 6, NULL, NULL),
('8b398ad1-3c69-473d-9647-8e8c67e4b6c0', '124191618561468', 3, NULL, NULL),
('8d91a765-ccf2-43c0-86ae-d965dfe885b7', '15111618561463', 5, NULL, NULL),
('8e3636b5-5bd0-4d8b-84b5-3ff7e7f730ba', '109251618561456', 6, NULL, NULL),
('8e550e2b-b9cb-493c-b2e9-249c3398e62d', '14011618561456', 6, NULL, NULL),
('8fa43b3c-6099-4809-b352-7b2d224503b3', '558241618561441', 11, NULL, NULL),
('8fef987f-9239-4ab9-9b95-3063e1b18acf', '630451618561457', 6, NULL, NULL),
('90492a39-3b0a-4b5b-b880-67847569e800', '397731618561427', 13, NULL, NULL),
('91d0f2f6-d526-40b1-b5a4-9d3bf7c27b18', '125141618561432', 12, NULL, NULL),
('92a717d5-f26e-4d26-bddc-ece1d34ddfdf', '726371618561456', 6, NULL, NULL),
('932e06be-cb52-401a-9590-458f5109c793', '780521618561450', 8, NULL, NULL),
('941a158b-5430-43d3-bff7-47564c20c2ac', '485341618561457', 6, NULL, NULL),
('94d9fe32-909b-4ebc-840d-d4f88f587d35', '842511618561450', 8, NULL, NULL),
('967710dd-ee22-4c6a-8cf6-8ebb4034fc1a', '962041618561467', 3, NULL, NULL),
('9796e4cc-9bc0-4ca7-ae6d-b5aa9868344a', '639151618561450', 8, NULL, NULL),
('982dc526-e25f-45b4-89f2-1bcaf0ba028a', '265431618561456', 6, NULL, NULL),
('9a0de3ff-ef62-426c-b129-ef440f1c6b85', '618441618561456', 6, NULL, NULL),
('9a184520-ef43-4fbd-84fe-94233dc790d8', '733541618561456', 6, NULL, NULL),
('9c8d8bb1-67e3-4462-8b2f-8ccb53873e5a', '188151618561450', 8, NULL, NULL),
('9d085caa-5502-48de-804e-4cf40fd29f61', '177901618561456', 6, NULL, NULL),
('9fc9d49c-505c-4089-b88b-525d1648c31c', '307761618561468', 3, NULL, NULL),
('a09d02aa-3172-4600-8471-5abbe6e3d713', '697821618561433', 12, NULL, NULL),
('a31d93ce-b170-43f1-ba1a-2dd5aad83eb8', '102591618561456', 6, NULL, NULL),
('a38aa618-cff0-4570-bfe8-8f6260736868', '154061618561450', 8, NULL, NULL),
('a443f0ff-b149-482c-8144-9e0c7e19b06b', '183551618561457', 6, NULL, NULL),
('a4c1cd5b-5e8b-41fe-823b-e02f07526cdb', '938351618561433', 12, NULL, NULL),
('a8c467db-077a-424a-91dc-b823af077c75', '505231618561457', 6, NULL, NULL),
('aa808c89-126c-45ea-9e01-2bb411b541f2', '855401618561433', 12, NULL, NULL),
('abe45c72-923b-4e1e-bb18-1a0b4d0cc04c', '298641618561457', 6, NULL, NULL),
('af3288d7-f983-4274-9618-ff83ec16fdb7', '423531618561456', 6, NULL, NULL),
('af7cf17a-42f3-479a-a4e3-2bcab856ffd0', '515101618561467', 3, NULL, NULL),
('b0fbe1b6-ac86-459f-a213-21c86d489aa4', '29591618561450', 8, NULL, NULL),
('b1c33353-f33d-453e-9f9d-dcd3d88cdcca', '385351618561456', 6, NULL, NULL),
('b34b6898-0b00-493b-ba6a-e8d104a8c9a7', '123961618561441', 11, NULL, NULL),
('b38e14e0-1307-4330-9ed5-944dba6852e8', '446251618561427', 13, NULL, NULL),
('b43b48ab-362a-4fee-a0d9-c2e44e13a71d', '95361618561457', 6, NULL, NULL),
('b43bb785-c619-46af-aaaf-ca3d354df974', '858401618561432', 12, NULL, NULL),
('b59b8b34-f510-4829-af52-55895e9cb2e8', '426291618561457', 6, NULL, NULL),
('b6e67784-c4a5-476e-b128-18b40377d0be', '937411618561450', 8, NULL, NULL),
('b753a1b5-c285-4891-b9be-0f94c51d2c4f', '500371618561456', 6, NULL, NULL),
('b774e21a-310c-4a1a-81e1-a286ec8bf7d3', '213781618561456', 6, NULL, NULL),
('b8be29d9-ffc6-4ee6-9d21-9890e2a6c89d', '5781618561457', 6, NULL, NULL),
('baa67ddb-fa5b-4534-9557-fd1e127c9128', '884381618561450', 8, NULL, NULL),
('bcf8e271-1723-4847-a888-95ef71fabf33', '279001618561450', 8, NULL, NULL),
('beb1560b-53e1-4306-b16b-c41a8c8b97b3', '900821618561467', 3, NULL, NULL),
('c21d4145-01a9-499a-b713-bf44b09f62dc', '513121618561457', 6, NULL, NULL),
('c2759f88-6253-4a12-91e3-3d8b5178365d', '470001618561450', 8, NULL, NULL),
('c3ada2a8-4259-4683-8f9a-61c6c085ba13', '338301618561450', 8, NULL, NULL),
('c3e6fc8f-45be-4a24-8310-32d102d3e541', '294741618561302', 14, NULL, NULL),
('c452007b-e4a1-4b5c-a16f-91ac09835b47', '828501618561432', 12, NULL, NULL),
('c57d59ce-e454-4577-b5d8-1545621dfdf1', '756421618561457', 6, NULL, NULL),
('c6660f79-3335-4289-bba4-ab5bb82fbaeb', '961191618561456', 6, NULL, NULL),
('c78d4c18-a804-43d6-b6ec-daef124a8dc1', '444051618561450', 8, NULL, NULL),
('c9aec430-7c3f-4151-a9fd-7f18ac3a49eb', '806801618561457', 6, NULL, NULL),
('c9d6558f-6059-44a4-9ea0-10ef5c5e6296', '386991618561450', 8, NULL, NULL),
('cbae2dae-30c1-4dbe-8020-a09580333747', '892191618561427', 13, NULL, NULL),
('cdedf0f9-becb-4c20-ab05-696ecf181efc', '721541618561450', 8, NULL, NULL),
('ce0f686b-6ae9-48eb-b17a-5581cd08ab95', '708571618561456', 6, NULL, NULL),
('cf10e70e-732f-4773-8656-da49777ff86d', '381281618561433', 12, NULL, NULL),
('cf1db03e-e048-4ca5-87b6-025726c31ddf', '168091618561427', 13, NULL, NULL),
('d2dea2c1-2cca-4084-b352-3ae566a2bfdb', '794921618561450', 8, NULL, NULL),
('d30d57cd-f253-4b43-83e6-949a17b65b60', '639781618561441', 11, NULL, NULL),
('d4814c32-df68-4da7-9cb7-9ba4c3758b8a', '893661618561441', 11, NULL, NULL),
('d5df8dc5-c544-4797-9800-3e304c898f98', '36881618561456', 6, NULL, NULL),
('d692c47a-3718-45fc-8611-7ff18c24411c', '4551618561456', 6, NULL, NULL),
('da3df88f-f520-4de2-88cd-1812c8687d85', '744611618561450', 8, NULL, NULL),
('dc5a396d-24fd-4288-aa07-6c13b37dcc8a', '167631618561456', 6, NULL, NULL),
('dce90363-9577-49ec-bc7d-e3099e41d9e7', '287291618561450', 8, NULL, NULL),
('e081dab6-f9d4-4776-9098-98bf4d512c75', '788621618561450', 8, NULL, NULL),
('e0f5b0cb-3a1b-4670-bca0-0da3307bd066', '50641618561456', 6, NULL, NULL),
('e1c769ba-3a09-4e05-b073-3c85f3a55d49', '800171618561456', 6, NULL, NULL),
('e38d6545-7336-4211-b63a-a237eb9192cd', '589401618561432', 12, NULL, NULL),
('e4939d37-48f6-4e8e-9f89-9b6e57ef653d', '730371618561456', 6, NULL, NULL),
('e56b5eb8-2f70-44ab-bcb0-828a009d37f0', '599301618561467', 3, NULL, NULL),
('e6d535d9-ba6c-43cf-bbc3-c246c4b783a0', '485181618561456', 6, NULL, NULL),
('e796436c-4eda-4861-bd38-a2012ecc4374', '796061618561432', 12, NULL, NULL),
('e89bc6eb-90b8-4444-b4f4-b9714ba5159b', '736661618561450', 8, NULL, NULL),
('e94ca804-68bb-4497-ae46-cef78f9a3397', '884701618561450', 8, NULL, NULL),
('eafcbe5b-91ff-45dd-8595-85146da57c71', '500181618561450', 8, NULL, NULL),
('ebe04b0b-6225-4a71-ae61-d3d473b9b66c', '490651618561432', 12, NULL, NULL),
('edf2d8aa-9286-46ef-a2a4-0ff489e3ff53', '839211618561427', 13, NULL, NULL),
('edf74a6e-9f39-4b5c-b693-b792d4643c0e', '612271618561456', 6, NULL, NULL),
('ee3fcc9c-fc3a-40cb-9cef-10700419939e', '233221618561457', 6, NULL, NULL),
('ee603037-1dfb-4aba-a260-bff1c03deeae', '625821618561432', 12, NULL, NULL),
('eead89e6-c7c9-49f2-856c-58bdf2ae8117', '611791618561456', 6, NULL, NULL),
('f19daf0c-376a-44ca-a3ab-02186f1b8de5', '839621618561463', 5, NULL, NULL),
('f2b46aa5-408b-4f8f-9b00-c8df6b73294e', '573301618561457', 6, NULL, NULL),
('f31fa3c7-b6d9-4fdb-9ec8-2f42226b8530', '62161618561432', 12, NULL, NULL),
('f491445d-6ef3-4c52-ad14-ad9fb7f06f03', '205341618561450', 8, NULL, NULL),
('f4a4f05d-1954-422f-9d58-50d512104eba', '618711618561457', 6, NULL, NULL),
('f6b04585-4969-4fdc-b291-45de620a9933', '209351618561457', 6, NULL, NULL),
('f75b1632-ed11-45a5-80d3-8d72bb28e0f5', '214971618561432', 12, NULL, NULL),
('f7d2a6d5-f006-4c4c-82d9-0c8b5290a3b6', '279891618561457', 6, NULL, NULL),
('f7e3b73f-1eb9-42fb-bd03-3eaf3192b150', '750461618561432', 12, NULL, NULL),
('f8c7f121-f0cc-4bd9-a443-b153d8dd2536', '114911618561427', 13, NULL, NULL),
('f91bcb9b-2b3e-4387-87fd-a792b211dccf', '354791618561456', 6, NULL, NULL),
('fa130a18-7253-4b31-8b69-09a9befeb763', '877041618561302', 14, NULL, NULL),
('fb17ef68-a92f-485a-ae04-fb8f556e2a80', '936141618561432', 12, NULL, NULL),
('fc304c40-2e85-419e-8b04-45f3893d5631', '830301618561456', 6, NULL, NULL);

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `judul_buku`, `judul_slug`, `inisial_buku`, `pengarang`, `sn_penulis`, `penerbit`, `tempat_terbit`, `tahun_terbit`, `tahun_buku`, `id_sub_ktg`, `klasifikasi`, `jumlah_eksemplar`, `stok_buku`, `foto_buku`, `keterangan`, `tanggal_upload`, `jenis_buku`, `created_at`, `updated_at`) VALUES
(3, 'PHP Undercover', 'php-undercover', 'P', 'Andre Pratama', 'ANP', 'Duniailkom', 'Samarinda', 2017, 2018, 1, '679.8', 10, 14, '_foto_buku_5b51485b149cc2017-07-30_39323034-programming-wallpapers.jpg.jpg', 'Jago', '2021-04-16', 'buku-bacaan', '2017-07-28 18:48:59', '2018-07-19 18:26:35'),
(5, 'Javascript Undercover', 'javascript-undercover', 'T', 'Andre Pratama', 'ANP', 'Duniailkom', 'Jakarta', 2011, 2018, 1, '777.127.128', 32, 3, '_foto_buku_5b514875253c02017-07-30_39323034-programming-wallpapers.jpg.jpg', '-', '2021-04-16', 'buku-bacaan', '2017-07-30 03:49:58', '2018-07-19 18:27:01'),
(6, 'MySQL Undercover', 'mysql-undercover', 'M', 'Andre Pratama', 'ANP', 'Duniailkom', 'Samarinda', 2017, 2018, 1, '892.128.7', 32, 114, '_foto_buku_5b513de054b74carbon (2).png.jpg', '-', '2021-04-16', 'buku-bacaan', '2017-09-03 19:48:17', '2018-07-19 17:41:52'),
(8, 'Belajar Laravel 5.6', 'belajar-laravel-56', 'L', 'Taylor Otwell', 'TWL', 'Laravel Corp.', 'Los Angeles', 2018, 2018, 1, '575.5', 32, 49, '_foto_buku_5b51e09d478deTaylor-Otwell-cloudways.jpg', NULL, '2021-04-16', 'buku-bacaan', '2018-07-19 07:28:16', '2018-07-20 05:16:13'),
(11, 'Panduan Praktis Menguasai Vue Js', 'panduan-praktis-menguasai-vue-js', 'P', 'Lutfi Gani', 'LGN', 'Lokomedia', 'Jakarta', 2015, 2015, 1, '123.123.123', 32, 10, '_foto_buku_5b51476a162bcbatik_04.png.jpg', NULL, '2021-04-16', 'buku-bacaan', '2018-07-19 18:22:34', '2018-07-19 18:22:34'),
(12, 'Matematika Kelas XII K-13', 'matematika-kelas-xii-k-13', 'M', 'Kemendikbud', 'KMB', 'Kemendikbud', 'Jakarta Utara', 2000, 2018, 4, '001.011.022', 19, 26, '-', '-', '2021-04-16', 'buku-pelajaran-kelas-xii', '2018-08-11 07:16:38', '2018-08-11 07:16:38'),
(13, 'Bahasa Indonesia Kelas XII K-13', 'bahasa-indonesia-kelas-xii-k-13', 'I', 'Kemendikbu', 'KMB', 'Kemendikbud', 'Jakarta', 2000, 2018, 4, '001.002.003', 32, 9, '-', '-', '2021-04-16', 'buku-pelajaran-kelas-xii', '2018-08-11 07:36:38', '2018-08-11 07:36:38'),
(14, 'The Pragmatic Programmer', 'the-pragmatic-programmer', 'T', 'Andrew Hunt', 'ADH', '-', '-', 2000, 2018, 1, '-', 32, 8, '-', '“The Pragmatic Programmer” By Andrew Hunt and Dave Thomas. Buku ini sangat cocok untuk semua programmer, baik yang masih pemula maupun sudah expert. Sesuai dengan judulnya, Buku Pemrograman ini akan mengubah pandangan dan kepribadianmu tentang pemrograman. Setelah membaca buku ini, Kamu akan menemukan banyak hal baru dan akan membuat kamu menjadi programmer yang lebih baik.\r\n\r\nYang sangat menarik dari buku ini yaitu pada isi bukunya, Buku ini tidak berfokus pada bahasa pemrograman tertentu, Melainkan membahas lebih luas tentang bahasa pemrograman. Walaupun tidak berfokus pada bahasa pemrograman tertentu, Isi dari buku ini sangat mudah dimengerti.\r\n\r\nDidalam buku ini kamu akan menemukan hal-hal kritis yang dianggap serius oleh seorang programmer dan bagaimana menemukan solusi pada sebuah case. Kamu akan belajar melakukan eksplorasi pada pemrograman, Pemilihan alat, memisahkan model dari pandangan, manajemen tim, dan bagaimana meminimalkan duplikasi di antara banyak topik lainnya.', '2021-04-16', 'buku-bacaan', NULL, NULL);

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
  `code_scanner` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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

INSERT INTO `detail_transaksi` (`id_detail_transaksi`, `id_transaksi`, `id_buku`, `code_scanner`, `stok_transaksi`, `tanggal_pinjam`, `tanggal_harus_kembali`, `tanggal_kembali`, `status_transaksi`, `denda`, `keterangan`, `created_at`, `updated_at`) VALUES
(25, 11, 13, '9999999', 1, '2021-04-14', '2021-04-12', '2021-04-19', 'kembali', 30000, NULL, NULL, '2021-04-18 20:06:19'),
(26, 12, 8, '', 1, '2021-04-14', '2021-04-20', NULL, 'sedang-dipinjam', NULL, NULL, NULL, NULL),
(27, 11, 6, '618711618561457', 1, '2021-04-16', '2021-04-30', '2021-04-19', 'kembali', 0, NULL, NULL, '2021-04-18 20:00:55'),
(28, 11, 6, NULL, 1, '2021-04-16', '2021-04-19', '2021-04-19', 'kembali', 0, NULL, NULL, '2021-04-18 20:00:55'),
(29, 13, 6, '', 1, '2021-04-17', '2021-04-20', NULL, 'sedang-dipinjam', NULL, NULL, NULL, NULL),
(30, 13, 12, '', 1, '2021-04-17', '2021-04-20', NULL, 'sedang-dipinjam', NULL, NULL, NULL, NULL),
(31, 11, 12, '', 1, '2021-04-17', '2021-04-18', '2021-04-19', 'kembali', 0, NULL, NULL, '2021-04-18 20:02:34');

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
(3, 24, '1923213 123992 00912 0', 'Petugas', 'pustakawan', '_foto_petugas_607a89c9bd191pngkey.com-avatar-png-1149878.png');

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
(1, '001/Perpus/04/2021', 5);

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
(11, 1, NULL),
(12, 4, NULL),
(13, 11, NULL);

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
(1, 'Administrator', 'admin', '$2y$10$x44D0Pclz570dxhOqAsD6.VNr9aDy04CX7w.gZ1nDjhAKxG/4Vu8C', '9I8aS1gcT73YxKt1RYjbXi3qphKBi6DWeCk2dXv2RJ8vA5izDT8fRdryuPPv', 2, 1, 0, '2018-06-21 13:12:39', '2017-07-16 03:52:48', '2018-03-18 23:22:12'),
(3, 'Hafiidh Luqmanul Hakim', 'hafidlh', '$2y$10$9II9gIVOMrHHOBJqlzSmneA.zhKTpDVecYJvAGZHWFsNQXGrshCgW', 'F56d8YRyQfgTHFzKmPNGcCmu40963RvrZbbOqvdsPUDT9n1sZKKlKXlxm1Hf', 0, 1, 0, '2018-07-02 02:23:25', '2017-09-07 15:54:05', '2020-12-23 06:49:35'),
(4, 'Muhammad Ilham', 'ilham', '$2y$10$tD3vwSfLWgGAsBtLue/Dwuqs6sp1LsinmT4Z/B2frj6e7noh8BwXi', 'dPsXKQg66vplI3lnxecKCP7GFy7AtSbAYyanXleWm31JO6FSB88qFZjHwz4B', 0, 1, 0, '2017-10-27 05:13:00', '2017-08-06 01:22:09', '2017-10-26 21:13:00'),
(7, 'Raihan Febryan', 'raihan', '$2y$10$Wl5WEj3Drgs8veoZnWYOy.WRcpUVaV8y9LluZ0k4Vkd90qQSvXYo2', '6MkooEHAQilt9L2CxFYKJf9crQLML0JgIjKLf27HN6pXL99yj5N6Hd36shga', 0, 1, 0, NULL, NULL, '2021-04-18 19:40:12'),
(13, 'Rohmat', 'rohmat', '$2y$10$TeOTDAEfbd/p7RpQSyJq2.sF0srj9YRJD6MXX6Wi2Aem5lQLCE3pO', NULL, 0, 1, 0, NULL, NULL, '2021-04-18 19:39:23'),
(16, 'Khairul Anam, M.Pd', 'anam', '$2y$10$1EOxruCVgVOhE.pabyFU7.IK4Jt.CKLGzRzQ1tfE7R2QhSHIwjtNq', NULL, 1, 1, 0, NULL, NULL, '2021-03-24 09:39:27'),
(22, 'Ahmad Munaroh', 'ahmadmunaroh', '$2y$10$FwiK5VRGosz57LftcCAXauBJv9kFc3WJbXzgYlz3FGInaDi2gGCDO', NULL, 0, 1, 0, NULL, NULL, NULL),
(24, 'Petugas', 'petugas', '$2y$10$ueIp2c3zQ9LqarxWaDlqg.yAuXhEsbmtXDiKCnjJOlGZLqPljhJZ6', NULL, 1, 1, 0, NULL, NULL, '2021-04-17 07:13:51'),
(25, 'Dimas Ridho Amalia', 'dimas', '$2y$10$XvER.SaXlkcIMVxJ7YxZz.LEhcpg09DsWZOKLy6G9bWhEkrPvfYMW', NULL, 0, 1, 0, NULL, NULL, NULL);

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
  MODIFY `id_anggota` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `anggota_perpus`
--
ALTER TABLE `anggota_perpus`
  MODIFY `id_anggota_perpus` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  MODIFY `id_detail_transaksi` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

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
-- AUTO_INCREMENT for table `panduan_pinjam`
--
ALTER TABLE `panduan_pinjam`
  MODIFY `id_panduan_pinjam` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id_transaksi` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

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
