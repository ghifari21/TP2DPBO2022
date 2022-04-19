-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2022 at 10:18 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ormawa`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbidangdivisi`
--

CREATE TABLE `tbidangdivisi` (
  `id_bidang` bigint(20) NOT NULL,
  `jabatan` varchar(255) DEFAULT NULL,
  `id_divisi` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbidangdivisi`
--

INSERT INTO `tbidangdivisi` (`id_bidang`, `jabatan`, `id_divisi`) VALUES
(1, 'Ketua', 1),
(2, 'Sekretaris', 2),
(3, 'Staff', 3),
(7, 'Wakil Ketua', 12),
(8, 'Ketua', 12),
(9, 'Bendahara', 13),
(10, 'Staff', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tdivisi`
--

CREATE TABLE `tdivisi` (
  `id_divisi` bigint(20) NOT NULL,
  `nama_divisi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tdivisi`
--

INSERT INTO `tdivisi` (`id_divisi`, `nama_divisi`) VALUES
(1, 'Divisi Komunikasi Teknologi dan Informasi'),
(2, 'Divisi Pengembangan Organisasi'),
(3, 'Divisi Kerohanian'),
(12, 'Non Divisi'),
(13, 'Divisi Pengembangan Minat Dan Bakat');

-- --------------------------------------------------------

--
-- Table structure for table `tpengurus`
--

CREATE TABLE `tpengurus` (
  `nim` varchar(255) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `semester` int(11) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `id_bidang` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tpengurus`
--

INSERT INTO `tpengurus` (`nim`, `nama`, `semester`, `image`, `id_bidang`) VALUES
('1941742', 'Another Kono Dio Da', 6, 'ig-2.jpg', 10),
('1946244', 'King Chad', 6, 'ig-6.jpg', 10),
('2000412', 'Alief Muhammad Abdillah', 4, 'ig-3.png', 3),
('2000421', 'Sigma Chad', 4, 'ig-7.png', 9),
('2000879', 'Hilman Fauzi Herdiana', 4, 'ig-8.jpg', 2),
('2000952', 'Ghifari Octaverin', 4, 'ig-10.png', 1),
('2000964', 'Axel Eldrian Hadiwibowo', 4, 'ig-5.jpg', 3),
('2041274', 'Giga Chad', 6, 'ig-9.jpg', 8),
('2084244', 'Kujo Jotaro', 4, 'ig-4.jpg', 10),
('2087421', 'Dio Brando', 6, 'ig-1.jpg', 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbidangdivisi`
--
ALTER TABLE `tbidangdivisi`
  ADD PRIMARY KEY (`id_bidang`),
  ADD KEY `id_divisi` (`id_divisi`);

--
-- Indexes for table `tdivisi`
--
ALTER TABLE `tdivisi`
  ADD PRIMARY KEY (`id_divisi`);

--
-- Indexes for table `tpengurus`
--
ALTER TABLE `tpengurus`
  ADD PRIMARY KEY (`nim`),
  ADD KEY `id_bidang` (`id_bidang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbidangdivisi`
--
ALTER TABLE `tbidangdivisi`
  MODIFY `id_bidang` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tdivisi`
--
ALTER TABLE `tdivisi`
  MODIFY `id_divisi` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbidangdivisi`
--
ALTER TABLE `tbidangdivisi`
  ADD CONSTRAINT `tbidangdivisi_ibfk_1` FOREIGN KEY (`id_divisi`) REFERENCES `tdivisi` (`id_divisi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tpengurus`
--
ALTER TABLE `tpengurus`
  ADD CONSTRAINT `tpengurus_ibfk_1` FOREIGN KEY (`id_bidang`) REFERENCES `tbidangdivisi` (`id_bidang`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
