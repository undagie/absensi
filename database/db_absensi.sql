-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 18, 2023 at 10:55 AM
-- Server version: 8.0.31
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_absensi`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

DROP TABLE IF EXISTS `absensi`;
CREATE TABLE IF NOT EXISTS `absensi` (
  `id_absen` int NOT NULL AUTO_INCREMENT,
  `tgl` date NOT NULL,
  `waktu` time NOT NULL,
  `keterangan` enum('Masuk','Pulang') NOT NULL,
  `id_user` int NOT NULL,
  PRIMARY KEY (`id_absen`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id_absen`, `tgl`, `waktu`, `keterangan`, `id_user`) VALUES
(1, '2023-08-01', '07:24:23', 'Masuk', 2),
(2, '2023-08-01', '16:37:11', 'Pulang', 2),
(3, '2023-08-02', '07:12:58', 'Masuk', 2),
(4, '2023-08-02', '17:25:28', 'Pulang', 2);

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

DROP TABLE IF EXISTS `divisi`;
CREATE TABLE IF NOT EXISTS `divisi` (
  `id_divisi` smallint NOT NULL AUTO_INCREMENT,
  `nama_divisi` varchar(50) NOT NULL,
  `gaji_pokok` int NOT NULL,
  PRIMARY KEY (`id_divisi`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`id_divisi`, `nama_divisi`, `gaji_pokok`) VALUES
(1, 'Marketing', 2000000),
(2, 'IT ', 2500000),
(3, 'Akuntan', 3000000),
(4, 'Security', 1500000),
(5, 'HSE', 3200000),
(6, 'Produksi', 2600000),
(13, 'Human Resource', 3150000);

-- --------------------------------------------------------

--
-- Table structure for table `jam`
--

DROP TABLE IF EXISTS `jam`;
CREATE TABLE IF NOT EXISTS `jam` (
  `id_jam` tinyint(1) NOT NULL AUTO_INCREMENT,
  `start` time NOT NULL,
  `finish` time NOT NULL,
  `keterangan` enum('Masuk','Pulang') NOT NULL,
  PRIMARY KEY (`id_jam`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jam`
--

INSERT INTO `jam` (`id_jam`, `start`, `finish`, `keterangan`) VALUES
(1, '07:00:00', '07:45:00', 'Masuk'),
(2, '16:00:00', '16:45:00', 'Pulang');

-- --------------------------------------------------------

--
-- Table structure for table `penggajian`
--

DROP TABLE IF EXISTS `penggajian`;
CREATE TABLE IF NOT EXISTS `penggajian` (
  `id_penggajian` int NOT NULL AUTO_INCREMENT,
  `id_user` smallint NOT NULL,
  `bulan` tinyint NOT NULL,
  `tahun` year NOT NULL,
  `gaji_pokok` int NOT NULL,
  `bonus` int DEFAULT '0',
  `potongan` int DEFAULT '0',
  `total_gaji` int GENERATED ALWAYS AS (((`gaji_pokok` + `bonus`) - `potongan`)) VIRTUAL,
  PRIMARY KEY (`id_penggajian`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penggajian`
--

INSERT INTO `penggajian` (`id_penggajian`, `id_user`, `bulan`, `tahun`, `gaji_pokok`, `bonus`, `potongan`) VALUES
(1, 1, 1, 2023, 2000000, 0, 0),
(2, 2, 1, 2023, 2500000, 150000, 50000),
(3, 3, 1, 2023, 2000000, 100000, 75000),
(4, 1, 2, 2023, 2000000, 120000, 40000),
(5, 2, 2, 2023, 2500000, 140000, 55000),
(6, 3, 2, 2023, 2000000, 90000, 80000),
(7, 1, 3, 2023, 2000000, 110000, 45000),
(8, 2, 3, 2023, 2500000, 130000, 52000),
(9, 3, 3, 2023, 2000000, 95000, 72000),
(10, 1, 4, 2023, 2000000, 115000, 42000),
(11, 2, 4, 2023, 2500000, 137000, 53000),
(12, 3, 4, 2023, 2000000, 92000, 73000),
(13, 1, 5, 2023, 2000000, 112000, 46000),
(14, 2, 5, 2023, 2500000, 132000, 54000),
(15, 3, 5, 2023, 2000000, 91000, 74000),
(16, 1, 6, 2023, 2000000, 117000, 43000),
(17, 2, 6, 2023, 2500000, 138000, 52000),
(18, 3, 6, 2023, 2000000, 94000, 71000),
(21, 1, 9, 2023, 2000000, 0, 0),
(22, 2, 9, 2023, 2500000, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` smallint NOT NULL AUTO_INCREMENT,
  `nik` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `foto` varchar(20) DEFAULT 'no-foto.png',
  `divisi` smallint DEFAULT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(60) NOT NULL,
  `level` enum('Manager','Karyawan') NOT NULL DEFAULT 'Karyawan',
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nik`, `nama`, `alamat`, `telp`, `email`, `foto`, `divisi`, `username`, `password`, `level`) VALUES
(1, '1001001', 'Junaidi', 'Jalan Adhyaksa', '08971137712', 'junaidi@gmail.com', '1691317781.png', 1, 'junaidi', '$2y$10$24GkCeAu7hA.07/BrfF0yuEqrIavNC8BXVKBOlsASOi6m96q4OV32', 'Manager'),
(2, '1001002', 'Mila Siti Salamah', 'Jalan Ratu Intan', '08115016727', 'milasitisalamah22@gmail.com', '1691317710.png', 2, 'mila', '$2y$10$mityfmTuTwXx59d784Lyh.2CBl29f1IacWTGL991Amtcy5d4Q7.yy', 'Karyawan'),
(3, '1001002', 'Purnomo', 'Jalan Salak', '081313131313', 'purnomo@gmail.com', '1691317865.png', 1, 'purnomo', '$2y$10$y/a1LlW17RrEL4nVa1ptSes5Mz2J6i1rcDgu.WPXQraRvyFvcB5mK', 'Karyawan');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `penggajian`
--
ALTER TABLE `penggajian`
  ADD CONSTRAINT `penggajian_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
