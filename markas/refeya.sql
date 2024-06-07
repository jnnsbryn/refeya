-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2024 at 08:30 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `refeya`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cafe`
--

CREATE TABLE `tbl_cafe` (
  `id_cafe` int(11) NOT NULL,
  `nama_cafe` varchar(30) NOT NULL,
  `deskripsi_cafe` text NOT NULL,
  `lokasi_cafe` varchar(30) NOT NULL,
  `fasilitas_cafe` varchar(60) NOT NULL,
  `foto_cafe` varchar(100) NOT NULL,
  `input_date` date NOT NULL,
  `updated_date` date NOT NULL,
  `status_cafe` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_cafe`
--

INSERT INTO `tbl_cafe` (`id_cafe`, `nama_cafe`, `deskripsi_cafe`, `lokasi_cafe`, `fasilitas_cafe`, `foto_cafe`, `input_date`, `updated_date`, `status_cafe`) VALUES
(1, 'Cafe Maspion', 'Cafe pinggir pabrik buka 25 jam', 'https://google.com', 'Wifi,Listrik,Toilet', '06062024235111bicycle-1872682_1280.jpg', '2024-06-06', '2024-06-07', 1),
(2, 'Cafe Aloha', 'Cafe pinggir alas buka 1 jam', 'https://bing.com', 'WiFi,Toilet', '06062024222008bazaar-1853361_1280.jpg', '2024-06-06', '2024-06-07', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_favorite`
--

CREATE TABLE `tbl_favorite` (
  `id_favorite` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_cafe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_review`
--

CREATE TABLE `tbl_review` (
  `id_review` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_cafe` int(11) NOT NULL,
  `rating_cafe` int(11) NOT NULL,
  `ulasan_cafe` text NOT NULL,
  `tanggal_submit` date NOT NULL DEFAULT current_timestamp(),
  `tanggal_update` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `email_user` varchar(30) NOT NULL,
  `pwd_user` varchar(200) NOT NULL,
  `role_user` varchar(5) NOT NULL DEFAULT 'user',
  `status_user` int(11) NOT NULL DEFAULT 1,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `email_user`, `pwd_user`, `role_user`, `status_user`, `created_at`) VALUES
(1, 'admin@refeya.my.id', '$2y$10$94D72fWs4MN6DWT1CPJw2uPp3fyTvdanuf84PozJ40h39GseIvBJ6', 'admin', 1, '2024-06-06'),
(2, 'sugeng@gmail.com', '$2y$10$CxZTd9HFCk9AgISCvLstDOKQveCWI1dZB2Se/5kCG6sGInCf9pcO.', 'user', 1, '2024-06-06'),
(3, 'pedro@gmail.com', '$2y$10$0Kwz0RLEPVPefd1rCjwo9efW7qxuqaz0/gHtWF.w9Xn9DYy0bAzRi', 'user', 1, '2024-06-08'),
(4, 'mbappe@gmail.com', '$2y$10$2Fqcl.miRL7G4oU4Yqrd.uyq40/yHi40z7wN2xCHqEPtuhFWxuqcG', 'user', 1, '2024-06-08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_cafe`
--
ALTER TABLE `tbl_cafe`
  ADD PRIMARY KEY (`id_cafe`);

--
-- Indexes for table `tbl_favorite`
--
ALTER TABLE `tbl_favorite`
  ADD PRIMARY KEY (`id_favorite`);

--
-- Indexes for table `tbl_review`
--
ALTER TABLE `tbl_review`
  ADD PRIMARY KEY (`id_review`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_cafe`
--
ALTER TABLE `tbl_cafe`
  MODIFY `id_cafe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_favorite`
--
ALTER TABLE `tbl_favorite`
  MODIFY `id_favorite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_review`
--
ALTER TABLE `tbl_review`
  MODIFY `id_review` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
