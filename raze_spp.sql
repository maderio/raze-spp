-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 09, 2023 at 08:35 AM
-- Server version: 5.7.33
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `raze_spp`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `create_transaksi` (IN `p_bulan_dibayar` INT(2), IN `p_tahun_dibayar` INT(4), IN `p_id_siswa` INT, IN `p_id_petugas` INT, IN `p_id_pembayaran` INT)   BEGIN
	DECLARE total_transaksi INT;
	SELECT COUNT(*) INTO total_transaksi
    FROM transaksi WHERE id_siswa = P_id_siswa AND id_pembayaran = p_id_pembayaran AND bulan_dibayar = p_bulan_dibayar;
    IF total_transaksi = 0 THEN
		INSERT INTO transaksi(tanggal_bayar, bulan_dibayar, tahun_dibayar, id_siswa, id_petugas, id_pembayaran)
        VALUES(NOW(), p_bulan_dibayar, p_tahun_dibayar, p_id_siswa, p_id_petugas, p_id_pembayaran);
    END IF;
END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `get_bulan_dibayar` (`p_id_siswa` INT) RETURNS VARCHAR(100) CHARSET latin1  BEGIN
	DECLARE bulan VARCHAR(100) DEFAULT '';
    SELECT GROUP_CONCAT(bulan_dibayar ORDER BY bulan_dibayar SEPARATOR ',')
    INTO bulan
    FROM transaksi
    WHERE id_siswa = p_id_siswa;
    RETURN bulan;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama` varchar(10) NOT NULL,
  `kompetensi_keahlian` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama`, `kompetensi_keahlian`) VALUES
(1, 'RPL', 'Rekayasa Perangkat Lunak'),
(2, 'MM', 'Multi Media'),
(3, 'TKJ', 'Teknik Komputer Jaringan'),
(4, 'TPM', 'Teknik Permesinan');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `tahun_ajaran` varchar(9) NOT NULL,
  `nominal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `tahun_ajaran`, `nominal`) VALUES
(1, '2021/2023', 150000),
(2, '2022/2023', 200000);

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(128) NOT NULL,
  `cookie` text,
  `role` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `username`, `password`, `cookie`, `role`) VALUES
(1, 'riorenata', '6fadb620f1df79d40018543c5efa07e5', 'edc557ced38eca8b7a254df5512aea67', 1),
(2, 'admin', '1ceba3f6d6e51a9fb2cf7f55aab9143c', '0ec89d1eeefa1ee6cd8c7153b323c212', 1),
(3, 'petugas', '3d6c48adfcb424f7492302f5583b67d4', 'e6d1e204a669f96a018ae9004d7403fe', 2),
(4, 'siswa', '257298b87d10bf21f9ab1b92b71e838b', '1ab4b718258b45319ca7561b6bd8ff34', 3),
(5, '28587', '7874b8316084acc8994f1d174f78ebfe', '323f731fc15337594cdf8b719d0d5b96', 3);

--
-- Triggers `pengguna`
--
DELIMITER $$
CREATE TRIGGER `tambah_riwayat_login` AFTER UPDATE ON `pengguna` FOR EACH ROW BEGIN
	INSERT INTO riwayat_login
    VALUES(NULL, OLD.id_pengguna, NOW());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `id_pengguna` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `nama`, `id_pengguna`) VALUES
(1, 'Rio Renata', 1),
(2, 'Admin', 2),
(3, 'Petugas', 3);

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_login`
--

CREATE TABLE `riwayat_login` (
  `id_login` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `waktu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `riwayat_login`
--

INSERT INTO `riwayat_login` (`id_login`, `id_pengguna`, `waktu`) VALUES
(1, 1, '2023-03-06 01:40:32'),
(2, 1, '2023-03-08 19:16:16'),
(3, 4, '2023-03-08 19:40:11'),
(4, 1, '2023-03-08 19:45:52'),
(5, 4, '2023-03-08 19:46:40'),
(6, 4, '2023-03-08 22:53:44'),
(7, 1, '2023-03-08 22:55:22'),
(8, 4, '2023-03-08 22:55:32'),
(9, 4, '2023-03-08 22:56:29'),
(10, 4, '2023-03-08 22:57:58'),
(11, 4, '2023-03-08 22:59:58'),
(12, 1, '2023-03-09 15:15:39'),
(13, 5, '2023-03-09 15:22:47'),
(14, 3, '2023-03-09 16:15:29'),
(15, 2, '2023-03-09 16:32:19');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `nisn` varchar(10) NOT NULL,
  `nis` varchar(5) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(14) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `id_pembayaran` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nisn`, `nis`, `nama`, `alamat`, `telepon`, `id_kelas`, `id_pengguna`, `id_pembayaran`) VALUES
(1, '0046492995', '28892', 'I Made Rio Renata', 'Jl. Gemitir No. 105', '081246599468', 1, 1, 1),
(2, '0000000000', '00000', 'Siswa', 'Bali', '000000000000', 2, 4, 1),
(3, '0028587', '28587', 'I Putu Rama Agastya Diananta Putra', 'Jl. Tukad Balian No. 77', '081337742956', 4, 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `tanggal_bayar` datetime NOT NULL,
  `bulan_dibayar` int(2) NOT NULL,
  `tahun_dibayar` int(4) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_petugas` int(11) NOT NULL,
  `id_pembayaran` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `tanggal_bayar`, `bulan_dibayar`, `tahun_dibayar`, `id_siswa`, `id_petugas`, `id_pembayaran`) VALUES
(1, '2023-03-06 01:40:41', 7, 2023, 1, 1, 1),
(2, '2023-03-08 19:46:29', 7, 2023, 2, 1, 1),
(3, '2023-03-08 19:46:29', 8, 2023, 2, 1, 1),
(4, '2023-03-08 19:46:29', 9, 2023, 2, 1, 1),
(5, '2023-03-08 19:46:29', 10, 2023, 2, 1, 1),
(6, '2023-03-08 19:46:29', 11, 2023, 2, 1, 1),
(7, '2023-03-08 19:46:29', 12, 2023, 2, 1, 1),
(8, '2023-03-08 19:46:29', 1, 2023, 2, 1, 1),
(9, '2023-03-08 19:46:29', 2, 2023, 2, 1, 1),
(10, '2023-03-08 19:46:29', 3, 2023, 2, 1, 1),
(11, '2023-03-08 19:46:29', 4, 2023, 2, 1, 1),
(12, '2023-03-08 19:46:29', 5, 2023, 2, 1, 1),
(13, '2023-03-08 19:46:29', 6, 2023, 2, 1, 1),
(14, '2023-03-09 15:21:32', 1, 2023, 3, 1, 2),
(15, '2023-03-09 15:21:32', 2, 2023, 3, 1, 2),
(16, '2023-03-09 15:21:32', 3, 2023, 3, 1, 2),
(17, '2023-03-09 15:21:32', 4, 2023, 3, 1, 2),
(18, '2023-03-09 15:21:32', 5, 2023, 3, 1, 2),
(19, '2023-03-09 15:21:32', 6, 2023, 3, 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- Indexes for table `riwayat_login`
--
ALTER TABLE `riwayat_login`
  ADD PRIMARY KEY (`id_login`),
  ADD KEY `pengguna` (`id_pengguna`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_pengguna` (`id_pengguna`),
  ADD KEY `id_pembayaran` (`id_pembayaran`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `id_petugas` (`id_petugas`),
  ADD KEY `id_pembayaran` (`id_pembayaran`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `riwayat_login`
--
ALTER TABLE `riwayat_login`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `petugas`
--
ALTER TABLE `petugas`
  ADD CONSTRAINT `petugas_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `siswa_ibfk_2` FOREIGN KEY (`id_pembayaran`) REFERENCES `pembayaran` (`id_pembayaran`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `siswa_ibfk_3` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id_petugas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_3` FOREIGN KEY (`id_pembayaran`) REFERENCES `pembayaran` (`id_pembayaran`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
