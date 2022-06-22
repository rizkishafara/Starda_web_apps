-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2022 at 03:42 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `starda`
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
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_cat` int(2) NOT NULL,
  `category` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_cat`, `category`) VALUES
(10, 'Developer'),
(11, 'Multimedia'),
(12, 'Sekolah');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id_status` int(1) NOT NULL,
  `status` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(12, 12, 'Kepala Sekolah');

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
  `id_category` int(2) DEFAULT NULL,
  `id_sub_category` int(5) DEFAULT NULL,
  `instansi` varchar(500) DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `about` text DEFAULT NULL,
  `status` enum('active','non active') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_data`
--

INSERT INTO `user_data` (`id_user`, `fullname`, `email`, `password`, `photo_user`, `address_user`, `phone_user`, `id_category`, `id_sub_category`, `instansi`, `gender`, `about`, `status`) VALUES
(21, 'Rizki Shafara Adiyatma', 'rizkishafara99@gmail.com', '51b6c6d78b3645c4290c88ab79e0f943', '21_7LOHSrVPmxkqU5l.jpg', 'Ungaran Timur', '62895360622007', 10, 4, 'Udinus', 'male', 'Saya adalah mahasiswa Udinus semester 5 prodi Teknik Informatika D3 angkatan 2019', 'active'),
(24, 'Slamet', 'slamet123@gmail.com', '51b6c6d78b3645c4290c88ab79e0f943', 'default.png', 'Jl. Imam Bonjol No.11', '628567824568', 10, 6, 'Udinus', 'male', '', 'non active'),
(28, 'Muhammad Bagus Chalil', 'baguschalil@gmail.com', '51b6c6d78b3645c4290c88ab79e0f943', '28_7SANnrcMwXPTmst.png', 'Pedurungan Tengah, Semarang', '6287678543682', 11, 7, 'Udinus', 'male', 'Saya master AI, Photoshop, Corel draw', 'active'),
(29, 'Alfandi Okta', 'alokwitra@gmail.com', '51b6c6d78b3645c4290c88ab79e0f943', '29_QasNyHC8kvTBM3o.png', 'Pedurungan Kidul, Semarang', '62853457263808', 11, 8, 'Abstract Story', 'male', 'Saya adlaah seorang freelancer yang menguasai berbagai bidang multimedia terutama videography', 'active'),
(30, 'Didan Hafiz Putra', 'hatama@gmail.com', '51b6c6d78b3645c4290c88ab79e0f943', '30_b480PMgYErax7WT.png', 'Jl. Badak No 21, Semarang', '62856352373487', 10, 3, 'Udinus', 'male', 'Frontend developer, Mahasiswa Udinus', 'active'),
(31, 'Ferisa Salsabila', 'ferisa@gmail.com', '51b6c6d78b3645c4290c88ab79e0f943', '31_L5Hwf7li9UMXytk.png', 'Genuk Utara', '62853457263808', 10, 6, 'CV Genuk Sejahtera', 'female', 'Saya adalah CTO CV Genuk Sejahtera', 'active'),
(32, 'Muhammad Yusuf Faisal', 'yusufaisal@gmail.com', '51b6c6d78b3645c4290c88ab79e0f943', '32_Cgzd2tF1elGSiIJ.png', 'Pati Selatan, Jawa Tengah', '628907863123', 11, 10, 'Elite Global Indonesia', 'male', 'Saya adalah mahasiswa Udinus Teknik informatika D3 tapi bisa 3D', 'non active'),
(33, 'Rizki Okta Maulana', 'okta321@gmail.com', '51b6c6d78b3645c4290c88ab79e0f943', '33_0cK7Cng89kdJVrE.jpeg', 'Jl. Diponegoro No.35, Ungaran', '62853457263808', 11, 9, 'Udinus', 'male', '', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `user_document`
--

CREATE TABLE `user_document` (
  `id_user` int(10) DEFAULT NULL,
  `id_document` int(100) NOT NULL,
  `title_document` varchar(1000) DEFAULT NULL,
  `name_document` varchar(1000) DEFAULT NULL,
  `id_cat_file` int(3) DEFAULT NULL,
  `status_doc` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_document`
--

INSERT INTO `user_document` (`id_user`, `id_document`, `title_document`, `name_document`, `id_cat_file`, `status_doc`) VALUES
(21, 3, 'doc', '1_docrzTC6YwZ2PpKkMO.doc', 3, 1),
(24, 12, 'MOU', '24_docwASrobQFdytW70U.pdf', 5, 2),
(32, 15, 'Log Aktivitas magang', '32_docm7kgHuaNrLZ4AoP.xlsx', 4, 2),
(32, 16, 'Dokumen', '32_docuwdb9fAIvaltkVn.docx', 3, 3),
(29, 17, 'Prakin', '29_docA6WYcatgeqoNrjs.docx', 3, 2),
(31, 18, 'Dokumen saya', '31_docUKMFrS8qPlXRAnf.xlsx', 4, 2),
(30, 19, 'Dokumen contoh', '30_docQhesTXZxBMIz3RF.xlsx', 4, 2),
(31, 20, 'Dokumen coba', '31_docyVbSr4O9HBPX8Gs.docx', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_media`
--

CREATE TABLE `user_media` (
  `id_user` int(5) DEFAULT NULL,
  `id_media` int(100) NOT NULL,
  `title_media` varchar(1000) DEFAULT NULL,
  `name_media` varchar(1000) DEFAULT NULL,
  `id_cat_file` int(3) DEFAULT NULL,
  `status_media` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_media`
--

INSERT INTO `user_media` (`id_user`, `id_media`, `title_media`, `name_media`, `id_cat_file`, `status_media`) VALUES
(32, 58, 'Foto profile saya', '32_mediaQz4PELW1XNHqjGx.png', 2, 1),
(32, 59, 'Video', '32_mediaWtPFec0Di8A3B5I.mp4', 1, 2),
(31, 60, 'Profile', '31_mediayUVdE1c5vsWDxge.png', 2, 2),
(31, 61, 'Dokumentasi Kegiatan 1', '31_media7fdC8re3bjYySmk.mp4', 1, 3),
(30, 62, 'Video saya', '30_mediaYV3Sa0LgzcXqFGb.mp4', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `category_file`
--
ALTER TABLE `category_file`
  ADD PRIMARY KEY (`id_cat_file`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_cat`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `sub_kategori`
--
ALTER TABLE `sub_kategori`
  ADD PRIMARY KEY (`id_sub_category`);

--
-- Indexes for table `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `user_document`
--
ALTER TABLE `user_document`
  ADD PRIMARY KEY (`id_document`);

--
-- Indexes for table `user_media`
--
ALTER TABLE `user_media`
  ADD PRIMARY KEY (`id_media`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `category_file`
--
ALTER TABLE `category_file`
  MODIFY `id_cat_file` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_cat` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sub_kategori`
--
ALTER TABLE `sub_kategori`
  MODIFY `id_sub_category` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_data`
--
ALTER TABLE `user_data`
  MODIFY `id_user` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `user_document`
--
ALTER TABLE `user_document`
  MODIFY `id_document` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user_media`
--
ALTER TABLE `user_media`
  MODIFY `id_media` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
