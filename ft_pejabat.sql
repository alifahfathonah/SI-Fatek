-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2020 at 09:11 AM
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
-- Database: `ft_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `ft_pejabat`
--

CREATE TABLE `ft_pejabat` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nip` varchar(30) DEFAULT NULL,
  `grup` varchar(50) DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `namaUnit` varchar(50) NOT NULL,
  `kodeUnit` smallint(6) DEFAULT NULL,
  `lastLogin` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ft_pejabat`
--

INSERT INTO `ft_pejabat` (`id`, `nama`, `nip`, `grup`, `jabatan`, `namaUnit`, `kodeUnit`, `lastLogin`) VALUES
(2, 'Fabian Manoppo', '196210141992031001', 'dekan', 'Dekan Fakultas Teknik', 'Fakultas Teknik', 2, '2020-03-20 01:41:56'),
(3, 'Arie Lumenta', '197304172000031001', 'jurusan', 'Kepala Jurusan Teknik Elektro', 'Jurusan Teknik Elektro', 43, '2019-07-02 13:20:43'),
(4, 'Virginia Tulenan', '198409062010122007', 'prodi', 'Koord. Prodi Teknik Informatika', 'Prodi Teknik Informatika', 77, '2019-07-08 16:47:44'),
(5, 'Lily Patras', '196604031995122001', 'jurusan', 'Sekretaris Jurusan Teknik Elektro', 'Jurusan Teknik Elektro', 43, '2018-11-30 06:15:06'),
(6, 'Meita Rumbayan', '197605192000032001', 'prodi', 'Koord. Prodi Teknik Elektro', 'Prodi Teknik Elektro', 12, NULL),
(7, 'Semuel Rompis', '197608152003121003', 'jurusan', 'Kepala Jurusan Teknik Sipil', 'Jurusan Teknik Sipil', 45, '2019-07-03 14:06:50'),
(8, 'Mecky Manoppo', '196405131993031003', 'jurusan', 'Sekretaris Jurusan Teknik Sipil', 'Jurusan Teknik Sipil', 45, NULL),
(9, 'Cindy Supit', '197407062001122002', 'prodi', 'Koord. Prodi Teknik Sipil', 'Prodi Teknik Sipil', 14, '2019-02-08 13:34:46'),
(10, 'Isri Mangangka', '196509241993031003', 'prodi', 'Koord. Prodi Teknik Lingkungan', 'Prodi Teknik Lingkungan', 94, '2018-12-14 10:05:53'),
(11, 'Octavianus Rogi', '196910081994121001', 'jurusan', 'Kepala Jurusan Arsitektur', 'Jurusan Arsitektur', 42, '2020-03-19 14:56:49'),
(12, 'Ingerid Moniaga', '197309182002122001', 'jurusan', 'Sekretaris Jurusan Arsitektur', 'Jurusan Arsitektur', 42, '2019-07-15 15:48:21'),
(13, 'Frits Siregar', '196701211997021001', 'prodi', 'Koord. Prodi Arsitektur', 'Prodi Arsitektur', 15, NULL),
(14, 'Fella Warouw', '197405172000032001', 'prodi', 'Koord. Prodi PWK', 'Prodi PWK', 16, '2019-01-16 20:49:17'),
(15, 'Charles Punuhsingon', '197509262006041001', 'jurusan', 'Kepala Jurusan Teknik Mesin', 'Jurusan Teknik Mesin', 44, '2019-09-24 15:47:27'),
(16, 'Rudy Poeng', '196608141994031002', 'jurusan', 'Sekretaris Jurusan Teknik Mesin', 'Jurusan Teknik Mesin', 44, NULL),
(17, 'Judy Waani', '196410101995121001', 'wd1', 'WD1 Bidang Akademik dan Kerjasama', 'Fakultas Teknik', 2, '2019-10-14 14:18:14'),
(18, 'Vecky Poekoel', '196705101997021001', 'wd2', 'WD2 Bidang Umum dan Keuangan', 'Fakultas Teknik', 2, NULL),
(19, 'Markus Umboh', '197505181999031001', 'wd3', 'WD3 Bidang Kemahasiswaan', 'Fakultas Teknik', 2, '2019-02-07 17:35:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ft_pejabat`
--
ALTER TABLE `ft_pejabat`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ft_pejabat`
--
ALTER TABLE `ft_pejabat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
