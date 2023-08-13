-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 13, 2023 at 11:13 AM
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

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `InsertAbsensi`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertAbsensi` (IN `tanggal` DATE, IN `idUser` INT)   BEGIN
  DECLARE dayOfWeek INT;
  
  -- Dapatkan hari dalam seminggu (1=Senin, 2=Selasa, ..., 7=Minggu)
  SET dayOfWeek = DAYOFWEEK(tanggal);

  -- Jangan insert untuk hari Minggu atau tanggal libur
  IF dayOfWeek <> 7 AND tanggal <> '2023-05-01' THEN 
    INSERT INTO absensi (tgl, waktu, keterangan, id_user) VALUES
    (tanggal, ADDTIME('07:00:00', SEC_TO_TIME(ROUND(RAND() * 2700))), 'Masuk', idUser),
    (tanggal, ADDTIME('16:00:00', SEC_TO_TIME(ROUND(RAND() * 2700))), 'Pulang', idUser);
  END IF;
  
END$$

DROP PROCEDURE IF EXISTS `IsiData`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `IsiData` ()   BEGIN
  DECLARE i INT DEFAULT 1;
  WHILE i <= 31 DO
    CALL InsertAbsensi(DATE('2023-05-' + CAST(i AS CHAR)), 2);
    CALL InsertAbsensi(DATE('2023-05-' + CAST(i AS CHAR)), 3);
    SET i = i + 1;
  END WHILE;
END$$

DELIMITER ;

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
(1, '1001001', 'Junaidi', 'Jalan Adhyaksa', '08971137712', 'junaidi@gmail.com', '1691317781.png', NULL, 'junaidi', '$2y$10$24GkCeAu7hA.07/BrfF0yuEqrIavNC8BXVKBOlsASOi6m96q4OV32', 'Manager'),
(2, '1001002', 'Mila Siti Salamah', 'Jalan Ratu Intan', '08115016727', 'milasitisalamah22@gmail.com', '1691317710.png', 2, 'mila', '$2y$10$mityfmTuTwXx59d784Lyh.2CBl29f1IacWTGL991Amtcy5d4Q7.yy', 'Karyawan'),
(3, '1001002', 'Purnomo', 'Jalan Salak', '081313131313', 'purnomo@gmail.com', '1691317865.png', 1, 'purnomo', '$2y$10$y/a1LlW17RrEL4nVa1ptSes5Mz2J6i1rcDgu.WPXQraRvyFvcB5mK', 'Karyawan');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
