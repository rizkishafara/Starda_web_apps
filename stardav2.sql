-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 22, 2022 at 02:29 AM
-- Server version: 5.7.33
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stardav2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(10) NOT NULL,
  `username_admin` varchar(20) DEFAULT NULL,
  `password_admin` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username_admin`, `password_admin`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(3, 'rizkishafara', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `alasan_produk`
--

CREATE TABLE `alasan_produk` (
  `id_alasan` int(10) NOT NULL,
  `id_product` int(3) DEFAULT NULL,
  `alasan` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alasan_produk`
--

INSERT INTO `alasan_produk` (`id_alasan`, `id_product`, `alasan`) VALUES
(1, 68, 'coba tolak'),
(2, 65, 'coba tolak'),
(3, 65, 'demo tolak'),
(4, 149, 'tidak memenuhi syarat');

-- --------------------------------------------------------

--
-- Table structure for table `category_file`
--

CREATE TABLE `category_file` (
  `id_cat_file` int(3) NOT NULL,
  `cat_file` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_file`
--

INSERT INTO `category_file` (`id_cat_file`, `cat_file`) VALUES
(1, 'video'),
(2, 'photo'),
(3, 'doc'),
(4, 'xls'),
(5, 'pdf');

-- --------------------------------------------------------

--
-- Table structure for table `daftar_kegiatan`
--

CREATE TABLE `daftar_kegiatan` (
  `id_kegiatan` int(4) NOT NULL,
  `kegiatan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `daftar_kegiatan`
--

INSERT INTO `daftar_kegiatan` (`id_kegiatan`, `kegiatan`) VALUES
(2, 'Kegiatan 1'),
(3, 'Kegiatan 2'),
(4, 'Kegiatan 3');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_file`
--

CREATE TABLE `kategori_file` (
  `id_kategori_file` int(5) NOT NULL,
  `kategori_file` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_file`
--

INSERT INTO `kategori_file` (`id_kategori_file`, `kategori_file`) VALUES
(1, 'Edukasi'),
(3, 'Produk'),
(4, 'Dokumentasi');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id_status` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id_status`, `status`) VALUES
(1, 'Ditinjau'),
(2, 'Disetujui'),
(3, 'Ditolak');

-- --------------------------------------------------------

--
-- Table structure for table `sub_kategori`
--

CREATE TABLE `sub_kategori` (
  `category_id` int(2) DEFAULT NULL,
  `id_sub_category` int(10) NOT NULL,
  `sub_category` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_kategori`
--

INSERT INTO `sub_kategori` (`category_id`, `id_sub_category`, `sub_category`) VALUES
(10, 3, 'Frontend Web Programer'),
(10, 4, 'Backend Web Programer'),
(10, 5, 'Game Developer'),
(10, 6, 'Mobile Programer'),
(11, 7, 'Designer'),
(11, 8, 'Videographer'),
(11, 9, 'Animator'),
(11, 10, '3D Artist'),
(11, 11, 'Audio Enginer'),
(12, 12, 'Guru');

-- --------------------------------------------------------

--
-- Table structure for table `unduh_produk`
--

CREATE TABLE `unduh_produk` (
  `id_unduh` int(10) NOT NULL,
  `id_produk_unduh` int(5) DEFAULT NULL,
  `id_user_unduh` int(3) DEFAULT NULL,
  `tanggal_unduh` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unduh_produk`
--

INSERT INTO `unduh_produk` (`id_unduh`, `id_produk_unduh`, `id_user_unduh`, `tanggal_unduh`) VALUES
(1, 58, 31, '2022-01-31'),
(2, 58, 31, '2022-01-31'),
(3, 61, 31, '2022-01-31'),
(4, 61, 31, '2022-01-31'),
(5, 61, 31, '2022-01-31'),
(6, 61, 31, '2022-01-31'),
(7, 62, 31, '2022-01-31'),
(8, 62, 31, '2022-01-31'),
(9, 62, 31, '2022-01-31'),
(10, 62, 31, '2022-01-31'),
(11, 63, 31, '2022-01-31'),
(12, 63, 31, '2022-01-31'),
(13, 59, 31, '2022-01-31'),
(14, 59, 31, '2022-01-31'),
(15, 59, 31, '2022-01-31'),
(16, 59, 31, '2022-01-31'),
(17, 58, 31, '2022-01-31'),
(18, 59, 31, '2022-01-31'),
(19, 59, 31, '2022-01-31'),
(20, 59, 31, '2022-01-31'),
(21, 59, 31, '2022-01-31'),
(22, 59, 31, '2022-01-31'),
(23, 59, 31, '2022-01-31'),
(24, 61, 31, '2022-01-31'),
(25, 58, NULL, '2022-01-31'),
(26, 144, 36, '2022-02-23'),
(27, 151, 37, '2022-03-06'),
(28, 151, 37, '2022-03-06'),
(29, 151, 37, '2022-03-06'),
(30, 151, 37, '2022-03-06'),
(31, 151, 37, '2022-03-06'),
(32, 151, 37, '2022-03-06'),
(33, 151, 37, '2022-03-06'),
(34, 151, 37, '2022-03-06'),
(35, 151, 37, '2022-03-06'),
(36, 151, 37, '2022-03-06'),
(37, 151, 37, '2022-03-06'),
(38, 151, 37, '2022-03-06'),
(39, 151, 37, '2022-03-06'),
(40, 151, 37, '2022-03-06'),
(41, 151, 37, '2022-03-06'),
(42, 151, 37, '2022-03-06'),
(43, 151, 37, '2022-03-06'),
(44, 151, 37, '2022-03-07');

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE `user_data` (
  `id_user` int(5) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(1000) DEFAULT NULL,
  `photo_user` varchar(100) DEFAULT NULL,
  `address_user` varchar(100) DEFAULT NULL,
  `phone_user` varchar(20) DEFAULT NULL,
  `id_category_user` int(2) DEFAULT NULL,
  `id_keahlian_user` int(3) DEFAULT NULL,
  `instansi` varchar(500) DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `about` text,
  `status` enum('active','non active') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_data`
--

INSERT INTO `user_data` (`id_user`, `fullname`, `email`, `password`, `photo_user`, `address_user`, `phone_user`, `id_category_user`, `id_keahlian_user`, `instansi`, `gender`, `about`, `status`) VALUES
(21, 'Rizki Shafara Adiyatma', 'rizkishafara99@gmail.com', '51b6c6d78b3645c4290c88ab79e0f943', '21_7LOHSrVPmxkqU5l.jpg', 'Ungaran Timur', '62895360622007', 10, 1, 'Udinus', 'male', 'Saya adalah mahasiswa Udinus semester 5 prodi Teknik Informatika D3 angkatan 2019', 'active'),
(24, 'Slamet', 'slamet123@gmail.com', '51b6c6d78b3645c4290c88ab79e0f943', 'default.png', 'Jl. Imam Bonjol No.11', '628567824568', 10, 2, 'Udinus', 'male', '', 'active'),
(28, 'Muhammad Bagus Chalil', 'baguschalil@gmail.com', '51b6c6d78b3645c4290c88ab79e0f943', '28_7SANnrcMwXPTmst.png', 'Pedurungan Tengah, Semarang', '6287678543682', 11, 1, 'Udinus', 'male', 'Saya master AI, Photoshop, Corel draw', 'active'),
(29, 'Alfandi Okta', 'alokwitra@gmail.com', '51b6c6d78b3645c4290c88ab79e0f943', '29_QasNyHC8kvTBM3o.png', 'Pedurungan Kidul, Semarang', '62853457263808', 11, 2, 'Abstract Story', 'male', 'Saya adlaah seorang freelancer yang menguasai berbagai bidang multimedia terutama videography', 'active'),
(30, 'Didan Hafiz Putra', 'hatama@gmail.com', '51b6c6d78b3645c4290c88ab79e0f943', '30_b480PMgYErax7WT.png', 'Jl. Badak No 21, Semarang', '62856352373487', 10, 1, 'Udinus', 'male', 'Frontend developer, Mahasiswa Udinus', 'active'),
(31, 'Ferisa Salsabila', 'ferisa@gmail.com', '51b6c6d78b3645c4290c88ab79e0f943', '31_L5Hwf7li9UMXytk.png', 'Genuk Utara', '62853457263808', 10, 2, 'CV Genuk Sejahtera', 'female', 'Saya adalah CTO CV Genuk Sejahtera', 'active'),
(32, 'Muhammad Yusuf Faisal', 'yusufaisal@gmail.com', '51b6c6d78b3645c4290c88ab79e0f943', '32_Cgzd2tF1elGSiIJ.png', 'Pati Selatan, Jawa Tengah', '628907863123', 11, 1, 'Elite Global Indonesia', 'male', 'Saya adalah mahasiswa Udinus Teknik informatika D3 tapi bisa 3D', 'active'),
(33, 'Rizki Okta Maulana', 'okta321@gmail.com', '51b6c6d78b3645c4290c88ab79e0f943', '33_0cK7Cng89kdJVrE.jpeg', 'Jl. Diponegoro No.35, Ungaran', '62853457263808', 1, 2, 'Udinus', 'male', '', 'active'),
(37, 'demo akun', 'mrkbtz99@gmail.com', '202cb962ac59075b964b07152d234b70', '37_Ag0lRwOj5MnkvtF.jpeg', 'Ungaran', '62895360622007', 10, 2, 'PT demo sejahtera', 'male', 'saya adalah akun demo dari Starda', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `user_kategori`
--

CREATE TABLE `user_kategori` (
  `id_cat` int(2) NOT NULL,
  `category_user` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_kategori`
--

INSERT INTO `user_kategori` (`id_cat`, `category_user`) VALUES
(1, 'Lain - lain'),
(10, 'Guru'),
(11, 'Dosen'),
(12, 'Siswa'),
(13, 'Mahasiswa');

-- --------------------------------------------------------

--
-- Table structure for table `user_keahlian`
--

CREATE TABLE `user_keahlian` (
  `id_keahlian` int(3) NOT NULL,
  `keahlian_user` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_keahlian`
--

INSERT INTO `user_keahlian` (`id_keahlian`, `keahlian_user`) VALUES
(1, 'Penulis'),
(2, 'Mobile Programmer'),
(3, 'Keahlian 3');

-- --------------------------------------------------------

--
-- Table structure for table `user_kegiatan`
--

CREATE TABLE `user_kegiatan` (
  `id_user_kegiatan` int(5) NOT NULL,
  `produk_id` int(5) DEFAULT NULL,
  `kegiatan` varchar(100) DEFAULT NULL,
  `tanggal_kegiatan` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_kegiatan`
--

INSERT INTO `user_kegiatan` (`id_user_kegiatan`, `produk_id`, `kegiatan`, `tanggal_kegiatan`) VALUES
(1, 21, 'Kegiatan 1', '2022-03-05'),
(2, 21, 'Kegiatan 2', '2022-03-03'),
(5, 156, 'Kegiatan 3', '2022-03-17'),
(7, 158, 'Kegiatan 3', '2022-03-01');

-- --------------------------------------------------------

--
-- Table structure for table `user_product_document`
--

CREATE TABLE `user_product_document` (
  `id_document` int(100) NOT NULL,
  `produk_id` int(10) NOT NULL,
  `name_document` varchar(1000) DEFAULT NULL,
  `id_cat_doc` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_product_document`
--

INSERT INTO `user_product_document` (`id_document`, `produk_id`, `name_document`, `id_cat_doc`) VALUES
(12, 0, '24_docwASrobQFdytW70U.pdf', 5),
(15, 0, '32_docm7kgHuaNrLZ4AoP.xlsx', 4),
(16, 0, '32_docuwdb9fAIvaltkVn.docx', 3),
(17, 0, '29_docA6WYcatgeqoNrjs.docx', 3),
(18, 0, '31_docUKMFrS8qPlXRAnf.xlsx', 4),
(19, 0, '30_docQhesTXZxBMIz3RF.xlsx', 4),
(20, 0, '21_dociJhLIFcUwYDlvmM.pdf', 5),
(22, 0, '21_docvtQluApXYrCOURx.pdf', 5),
(23, 103, 'oN1ru.pdf', 5),
(24, 104, 'ALUR_PROSES_PEMBAYARAN_UDINUS.pdfbw2GP', 5),
(25, 105, '1fKiu.pdf', 5),
(26, 108, 'Fh5q8ktm.pdf', 5),
(27, 129, '3MRkbALUR_PROSES_PEMBAYARAN_UDINUS.pdf', 5),
(28, 130, 'iX6TgALUR_PROSES_PEMBAYARAN_UDINUS.pdf', 5),
(29, 130, 'iX6TgALUR_PROSES_PEMBAYARAN_UDINUS.pdf', 5),
(30, 130, 'iX6TgALUR_PROSES_PEMBAYARAN_UDINUS.pdf', 5),
(31, 131, 'WDOLHEsertif_WEBNAS_Rizki_Shafara_Adiyatma.pdf', 5),
(32, 131, 'WDOLHEsertif_WEBNAS_Rizki_Shafara_Adiyatma.pdf', 5),
(33, 132, 'aydDvArray.pdf', 5),
(34, 133, '36_produkFQWz1efCNGLqY5S.pdf', 5),
(49, 151, 'oFdC6Data.xlsx', 4),
(50, 151, 'rcwg7ALUR_EPA_MHS.pdf', 5),
(56, 156, '8WUMdData_Rizki_Shafara_Adiyatma.xlsx', 4),
(58, 158, 'it1TLData_Rizki_Shafara_Adiyatma.xlsx', 4);

-- --------------------------------------------------------

--
-- Table structure for table `user_produk`
--

CREATE TABLE `user_produk` (
  `id_user` int(5) DEFAULT NULL,
  `id_produk` int(100) NOT NULL,
  `title_produk` varchar(1000) DEFAULT NULL,
  `name_produk` varchar(1000) DEFAULT NULL,
  `desc_produk` varchar(1000) DEFAULT NULL,
  `id_kategori` int(5) DEFAULT NULL,
  `id_cat_file` int(3) DEFAULT NULL,
  `status_produk` int(1) DEFAULT '1',
  `upload_date` date DEFAULT NULL,
  `verif_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_produk`
--

INSERT INTO `user_produk` (`id_user`, `id_produk`, `title_produk`, `name_produk`, `desc_produk`, `id_kategori`, `id_cat_file`, `status_produk`, `upload_date`, `verif_date`) VALUES
(32, 58, 'Foto profile saya', '32_mediaQz4PELW1XNHqjGx.png', 'ini deskripsi', 1, 2, 2, '2021-03-05', NULL),
(32, 59, 'Video', '32_mediaWtPFec0Di8A3B5I.mp4', NULL, 3, 1, 2, '2022-04-04', NULL),
(31, 60, 'Profile', '31_mediayUVdE1c5vsWDxge.png', NULL, 4, 2, 3, '2022-01-27', NULL),
(31, 61, 'Dokumentasi Kegiatan 1', '31_media7fdC8re3bjYySmk.mp4', NULL, 3, 1, 2, '2022-02-02', NULL),
(30, 62, 'Video saya', '30_mediaYV3Sa0LgzcXqFGb.mp4', NULL, 3, 1, 2, '2022-02-05', '2022-01-30'),
(21, 63, 'Media Foto', '21_mediaKcfV7Gg6zxQ2DAB.png', '', 4, 2, 2, '2022-03-30', '2022-01-30'),
(21, 64, 'video demo', '21_mediauXQJ6jv98HK2kOl.mp4', 'coba', 3, 1, 1, '2022-01-31', NULL),
(21, 65, 'Media demo', '21_mediabHzyWdgfIPZTjqs.png', 'demo unggah media', 4, 2, 3, '2022-02-01', NULL),
(37, 151, 'coba aja', '37_produkvSu6oqTaGj581lJ.mp4', 'ini coba lagi aja kk', 1, 1, 2, '2022-03-07', '2022-03-09'),
(37, 156, 'asas', '37_produk0IP93WwN425beLt.png', 'asas', 1, 2, 1, '2022-03-16', NULL),
(37, 158, 'ssss', '37_produkxlypHNanYcXkWIo.png', 'sss', 3, 2, 2, '2022-03-16', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `alasan_produk`
--
ALTER TABLE `alasan_produk`
  ADD PRIMARY KEY (`id_alasan`);

--
-- Indexes for table `category_file`
--
ALTER TABLE `category_file`
  ADD PRIMARY KEY (`id_cat_file`);

--
-- Indexes for table `daftar_kegiatan`
--
ALTER TABLE `daftar_kegiatan`
  ADD PRIMARY KEY (`id_kegiatan`);

--
-- Indexes for table `kategori_file`
--
ALTER TABLE `kategori_file`
  ADD PRIMARY KEY (`id_kategori_file`);

--
-- Indexes for table `sub_kategori`
--
ALTER TABLE `sub_kategori`
  ADD PRIMARY KEY (`id_sub_category`);

--
-- Indexes for table `unduh_produk`
--
ALTER TABLE `unduh_produk`
  ADD PRIMARY KEY (`id_unduh`);

--
-- Indexes for table `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `user_kategori`
--
ALTER TABLE `user_kategori`
  ADD PRIMARY KEY (`id_cat`);

--
-- Indexes for table `user_keahlian`
--
ALTER TABLE `user_keahlian`
  ADD PRIMARY KEY (`id_keahlian`);

--
-- Indexes for table `user_kegiatan`
--
ALTER TABLE `user_kegiatan`
  ADD PRIMARY KEY (`id_user_kegiatan`);

--
-- Indexes for table `user_product_document`
--
ALTER TABLE `user_product_document`
  ADD PRIMARY KEY (`id_document`);

--
-- Indexes for table `user_produk`
--
ALTER TABLE `user_produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `alasan_produk`
--
ALTER TABLE `alasan_produk`
  MODIFY `id_alasan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `category_file`
--
ALTER TABLE `category_file`
  MODIFY `id_cat_file` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `daftar_kegiatan`
--
ALTER TABLE `daftar_kegiatan`
  MODIFY `id_kegiatan` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kategori_file`
--
ALTER TABLE `kategori_file`
  MODIFY `id_kategori_file` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sub_kategori`
--
ALTER TABLE `sub_kategori`
  MODIFY `id_sub_category` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `unduh_produk`
--
ALTER TABLE `unduh_produk`
  MODIFY `id_unduh` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `user_data`
--
ALTER TABLE `user_data`
  MODIFY `id_user` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `user_kategori`
--
ALTER TABLE `user_kategori`
  MODIFY `id_cat` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_keahlian`
--
ALTER TABLE `user_keahlian`
  MODIFY `id_keahlian` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_kegiatan`
--
ALTER TABLE `user_kegiatan`
  MODIFY `id_user_kegiatan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_product_document`
--
ALTER TABLE `user_product_document`
  MODIFY `id_document` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `user_produk`
--
ALTER TABLE `user_produk`
  MODIFY `id_produk` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
