-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2020 at 03:57 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restoran`
--

-- --------------------------------------------------------

--
-- Table structure for table `meja`
--

CREATE TABLE `meja` (
  `id_meja` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_reservasi` int(11) NOT NULL,
  `status` varchar(10) NOT NULL,
  `antrian` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meja`
--

INSERT INTO `meja` (`id_meja`, `id_user`, `id_reservasi`, `status`, `antrian`) VALUES
(1, 3, 1, 'kosong', ''),
(2, 3, 1, 'kosong', ''),
(3, 3, 1, 'kosong', ''),
(4, 3, 1, 'kosong', ''),
(5, 3, 1, 'kosong', ''),
(6, 3, 1, 'kosong', ''),
(7, 1, 1, 'kosong', ''),
(8, 1, 1, 'kosong', ''),
(9, 3, 1, 'kosong', ''),
(10, 1, 1, 'kosong', ''),
(11, 1, 1, 'kosong', ''),
(12, 1, 1, 'kosong', ''),
(13, 3, 1, 'kosong', ''),
(14, 1, 1, 'kosong', ''),
(15, 1, 1, 'kosong', ''),
(16, 1, 1, 'kosong', ''),
(17, 1, 1, 'kosong', ''),
(18, 1, 1, 'kosong', ''),
(19, 1, 1, 'kosong', ''),
(20, 1, 1, 'kosong', '');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `harga` int(11) NOT NULL,
  `gambar` varchar(99) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `nama`, `harga`, `gambar`) VALUES
(1, 'Ayam Goreng', 20000, 'ayam-goreng.jpg'),
(2, 'Nasi Goreng', 15000, 'nasi-goreng.jpg'),
(3, 'Soto Betawi', 30000, 'soto.jpg'),
(4, 'Sayur Asem', 25000, 'sayur-asem.jpg'),
(5, 'Gado-Gado', 15000, 'gado.jpg'),
(6, 'Ketoprak', 15000, 'ketoprak.jpg'),
(7, 'Steak Tempe', 20000, 'steak-tempe.jpg'),
(8, 'Ayam Bakar', 25000, 'ayam-bakar.jpg'),
(9, 'Capcay', 20000, 'capcay.jpg'),
(10, 'Pepes Ikan', 15000, 'pepes-ikan.jpg'),
(11, 'Gurame Bakar', 20000, 'gurame.jpg'),
(12, 'Cumi Goreng Tepung', 17000, 'cumi.jpg'),
(13, 'Nasi Putih', 5000, 'nasi.jpg'),
(14, 'Udang Goreng Tepung', 20000, 'udang.jpg'),
(15, 'Mie Ayam', 15000, 'mie.jpg'),
(16, 'Tempe Goreng', 5000, 'tempe-goreng.jpg'),
(17, 'Tahu Goreng', 5000, 'tahu-goreng.jpg'),
(18, 'Nasi Uduk', 7000, 'nasi-uduk.jpg'),
(19, 'Perkedel', 5000, 'perkedel.jpg'),
(20, 'Lele Goreng', 15000, 'lele.jpg'),
(21, 'Latte', 12000, 'latte.jpg'),
(22, 'Milkshake', 15000, 'milkshake.jpg'),
(23, 'Jus Mangga', 8000, 'jus-mangga.jpg'),
(24, 'Coca Cola', 6000, 'coca-cola.jpg'),
(25, 'Es Teh Manis', 5000, 'teh-manis.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `no_transaksi` varchar(99) NOT NULL,
  `id_sumber` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `total` int(11) NOT NULL,
  `kembalian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`no_transaksi`, `id_sumber`, `tanggal`, `total`, `kembalian`) VALUES
('0000000', 1, '2020-05-20 15:27:40', 0, 0),
('2020051', 1, '2020-04-20 15:29:06', 60000, 10000),
('2020052', 1, '2020-05-20 15:29:14', 65000, 5000),
('2020053', 1, '2020-05-20 16:34:13', 80000, 10000),
('2020054', 1, '2020-05-21 17:14:28', 30000, 0),
('2020055', 1, '2020-05-23 12:37:44', 40000, 10000),
('2020056', 1, '2020-05-23 13:01:59', 20000, 10000),
('2020057', 1, '2020-05-25 17:06:39', 40000, 0),
('2020058', 1, '2020-05-25 21:08:07', 60000, 0),
('2020059', 1, '2020-05-25 21:10:57', 105000, 15000),
('20200610', 1, '2020-06-09 19:31:12', 40000, 83123),
('20200611', 1, '2020-06-09 21:11:57', 20000, 10000),
('20200612', 1, '2020-06-09 21:12:53', 40000, 10000),
('20200613', 1, '2020-06-09 21:21:16', 20000, 12293123),
('20200614', 1, '2020-06-09 21:24:18', 20000, 91111),
('20200615', 1, '2020-06-10 19:36:26', 20000, 10000),
('20200616', 1, '2020-06-10 19:36:34', 50000, 50000),
('20200617', 1, '2020-06-11 18:23:11', 20000, 202222),
('20200618', 1, '2020-06-14 07:00:23', 20000, 0),
('20200619', 1, '2020-06-14 16:25:45', 40000, 0),
('20200620', 1, '2020-06-14 16:26:47', 60000, 40000),
('20200621', 1, '2020-06-14 16:29:00', 20000, 193123),
('20200622', 1, '2020-06-14 16:31:41', 20000, 103123),
('20200623', 1, '2020-06-14 16:32:30', 20000, 1211313),
('20200624', 1, '2020-06-16 15:25:58', 20000, 2222),
('20200625', 1, '2020-06-16 15:26:02', 20000, 2222),
('20200626', 1, '2020-06-16 10:25:45', 20000, 0),
('20200626', 1, '2020-06-16 11:41:49', 20000, 103123),
('20200626', 1, '2020-06-16 13:44:40', 40000, 80000),
('20200626', 1, '2020-06-16 13:45:50', 40000, 83123),
('20200626', 1, '2020-06-16 13:16:44', 40000, 83312),
('20200626', 1, '2020-06-16 13:17:30', 40000, 1193123),
('20200626', 1, '2020-06-16 14:18:32', 40000, 83123),
('20200626', 1, '2020-06-16 14:26:21', 40000, 83123),
('20200626', 1, '2020-06-16 14:38:41', 20000, 0),
('20200626', 1, '2020-06-16 17:31:57', 20000, 2222),
('20200627', 1, '2020-06-16 19:08:14', 20000, 2222),
('20200628', 1, '2020-06-17 12:33:54', 40000, 0),
('20200629', 1, '2020-06-17 12:35:18', 40000, 0),
('20200630', 1, '2020-06-17 16:49:57', 40000, 0),
('20200631', 1, '2020-06-17 17:20:45', 40000, 83123),
('20200632', 1, '2020-06-17 17:21:45', 20000, 0),
('20200633', 1, '2020-06-17 18:30:16', 40000, 83123),
('20200634', 1, '2020-06-17 19:31:24', 20000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_list`
--

CREATE TABLE `order_list` (
  `id_order_list` int(11) NOT NULL,
  `no_transaksi` varchar(99) NOT NULL,
  `id_meja` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `ket` varchar(99) NOT NULL,
  `siap` int(11) NOT NULL,
  `saji` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_list`
--

INSERT INTO `order_list` (`id_order_list`, `no_transaksi`, `id_meja`, `id_menu`, `id_user`, `harga`, `quantity`, `total`, `ket`, `siap`, `saji`) VALUES
(1, '2020051', 1, 1, 1, 20000, 2, 40000, 'Pesan Ayam', 0, 0),
(2, '2020051', 1, 1, 1, 20000, 1, 20000, 'Ayam Lagi', 0, 0),
(3, '2020052', 9, 2, 1, 15000, 3, 45000, 'Beli nasi goreng', 0, 0),
(4, '2020052', 9, 1, 1, 20000, 1, 20000, 'Ayam', 0, 0),
(5, '2020053', 3, 1, 1, 20000, 2, 40000, '', 0, 0),
(6, '2020053', 3, 1, 1, 20000, 2, 40000, 'asd', 0, 0),
(7, '2020054', 1, 6, 2, 15000, 2, 30000, 'Ketoprak tidak pedes', 0, 0),
(8, '2020055', 2, 1, 1, 20000, 2, 40000, 'Ayam 1', 0, 0),
(9, '2020056', 17, 19, 1, 5000, 4, 20000, 'perkedel', 0, 0),
(10, '2020057', 15, 9, 1, 20000, 2, 40000, 'Capcay 2', 0, 0),
(11, '2020058', 2, 2, 1, 15000, 2, 30000, 'Jangan terlalu pedas, dan tidak buah buahan', 0, 0),
(12, '2020058', 2, 3, 1, 30000, 1, 30000, 'Soto nya jangan terlalu pedas', 0, 0),
(13, '2020059', 1, 1, 1, 20000, 4, 80000, '', 0, 0),
(14, '2020059', 1, 4, 1, 25000, 1, 25000, '', 0, 0),
(15, '20200610', 5, 1, 3, 20000, 2, 40000, '', 0, 0),
(16, '20200611', 1, 1, 3, 20000, 1, 20000, 'asd', 0, 0),
(17, '20200612', 1, 1, 3, 20000, 2, 40000, 'a', 0, 0),
(18, '20200613', 1, 1, 3, 20000, 1, 20000, 'a', 0, 0),
(19, '20200614', 1, 1, 3, 20000, 1, 20000, '', 0, 0),
(20, '20200615', 1, 1, 3, 20000, 1, 20000, '', 0, 0),
(21, '20200616', 2, 4, 3, 25000, 2, 50000, 'asd', 0, 0),
(22, '20200617', 1, 1, 3, 20000, 1, 20000, '', 0, 0),
(23, '20200618', 2, 1, 3, 20000, 1, 20000, '', 0, 0),
(24, '20200621', 6, 1, 3, 20000, 1, 20000, '', 0, 0),
(25, '20200619', 1, 1, 3, 20000, 2, 40000, '', 0, 0),
(26, '20200622', 1, 1, 3, 20000, 1, 20000, '', 0, 0),
(27, '20200620', 3, 1, 3, 20000, 3, 60000, '', 0, 0),
(28, '20200623', 1, 1, 3, 20000, 1, 20000, '2213', 0, 0),
(29, '20200624', 1, 1, 5, 20000, 1, 20000, 'Samabalnya jangan kebnayakan', 1, 1),
(30, '20200625', 4, 1, 3, 20000, 1, 20000, '', 1, 1),
(31, '20200628', 3, 1, 3, 20000, 2, 40000, 'Ayam Goreng dua', 0, 1),
(32, '20200626', 1, 1, 5, 20000, 1, 20000, 'asdas', 0, 0),
(33, '20200626', 1, 1, 3, 20000, 1, 20000, '', 0, 0),
(34, '20200626', 1, 1, 3, 20000, 2, 40000, '', 0, 0),
(35, '20200626', 1, 1, 3, 20000, 2, 40000, '', 0, 0),
(36, '20200626', 1, 1, 3, 20000, 2, 40000, '', 0, 0),
(37, '20200626', 1, 1, 3, 20000, 2, 40000, '', 0, 0),
(38, '20200626', 1, 1, 3, 20000, 2, 40000, 'as', 0, 0),
(39, '20200626', 9, 1, 3, 20000, 2, 40000, '', 0, 0),
(40, '20200626', 9, 1, 3, 20000, 1, 20000, '', 0, 0),
(41, '20200626', 4, 1, 3, 20000, 1, 20000, 'asd', 0, 0),
(42, '20200627', 13, 1, 3, 20000, 1, 20000, '', 0, 0),
(43, '20200629', 3, 1, 3, 20000, 2, 40000, '', 0, 0),
(44, '20200630', 2, 1, 3, 20000, 2, 40000, '', 0, 0),
(45, '20200631', 2, 1, 3, 20000, 2, 40000, '', 0, 0),
(46, '20200632', 2, 1, 3, 20000, 1, 20000, 'asdasd', 0, 0),
(47, '20200633', 2, 1, 3, 20000, 1, 20000, 'asd', 0, 0),
(48, '20200633', 2, 1, 3, 20000, 1, 20000, '', 0, 0),
(49, '20200634', 2, 1, 3, 20000, 1, 20000, '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id_pengeluaran` int(11) NOT NULL,
  `id_sumber` int(11) NOT NULL,
  `tgl_pengeluaran` datetime NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengeluaran`
--

INSERT INTO `pengeluaran` (`id_pengeluaran`, `id_sumber`, `tgl_pengeluaran`, `jumlah`) VALUES
(1, 2, '2020-04-20 14:24:11', 20000),
(2, 3, '2020-04-20 14:24:11', 20000),
(3, 4, '2020-04-20 14:24:11', 20000),
(4, 5, '2020-04-20 14:24:11', 20000),
(5, 6, '2020-04-20 14:24:11', 20000),
(6, 7, '2020-04-20 14:24:11', 20000),
(7, 2, '2020-05-20 15:51:32', 35000),
(8, 3, '2020-05-20 15:51:32', 12000),
(9, 4, '2020-05-20 15:51:32', 50000),
(10, 5, '2020-05-20 15:51:32', 70000),
(11, 6, '2020-05-20 15:51:32', 1000),
(12, 7, '2020-05-20 15:51:32', 30000),
(13, 2, '2020-06-08 16:20:07', 25000),
(14, 3, '2020-06-08 16:20:07', 30000),
(15, 4, '2020-06-08 16:20:07', 50000),
(16, 5, '2020-06-08 16:20:07', 30000),
(17, 6, '2020-06-08 16:20:07', 10000),
(18, 7, '2020-06-08 16:20:07', 40000);

-- --------------------------------------------------------

--
-- Table structure for table `reservasi`
--

CREATE TABLE `reservasi` (
  `id_reservasi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal_reservasi` datetime NOT NULL,
  `jam` varchar(11) NOT NULL,
  `nama_pelanggan` varchar(50) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservasi`
--

INSERT INTO `reservasi` (`id_reservasi`, `id_user`, `tanggal_reservasi`, `jam`, `nama_pelanggan`, `no_telp`, `email`) VALUES
(1, 1, '0000-00-00 00:00:00', '', 'kosong', '', ''),
(2, 1, '2020-06-18 00:00:00', '10:00-12:00', 'Alan', '089683', 'alan@gmail.com'),
(3, 1, '2020-06-18 00:00:00', '10:00-11:00', 'Lolo', '21546288', 'lolo@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `sumber`
--

CREATE TABLE `sumber` (
  `id_sumber` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sumber`
--

INSERT INTO `sumber` (`id_sumber`, `nama`) VALUES
(1, 'Pendapatan Restoran'),
(2, 'Beban Gaji Pegawai'),
(3, 'Beban Telpon & internet'),
(4, 'Beban  Perlengkapan Kantor'),
(5, 'Beban Transportasi dan bensin'),
(6, 'Beban Tidak Terduga'),
(7, 'Beban Tagihan Listrik');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(99) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(99) NOT NULL,
  `tipe` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `email`, `tipe`) VALUES
(1, 'ismail', '123', 'Ismail', '', 'Kasir'),
(2, 'admin', '123', 'Admin', '', 'Admin'),
(3, 'rama', '123', 'Rama Cahya', '', 'Pelayan'),
(4, 'Kiki', '123', 'Rizky Pramata', '', 'Koki'),
(5, 'cahya', '123', 'Cahya Seta', '', 'Pelanggan'),
(6, 'lukas', '123', 'Lukasiho', 'Lukasiho@yahoo.com', 'Pelanggan'),
(17, 'kujang', '123', 'Kujang', 'kujang@gmail.com', 'Koki'),
(18, 'ratih', '123', 'Ratih', 'ratih@mail.com', 'Kasir'),
(19, 'popo', '123', 'Popo', 'popp@gmail.com', 'Pelanggan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `meja`
--
ALTER TABLE `meja`
  ADD PRIMARY KEY (`id_meja`),
  ADD KEY `id_reservasi` (`id_reservasi`),
  ADD KEY `id_staff` (`id_user`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD KEY `id_sumber` (`id_sumber`);

--
-- Indexes for table `order_list`
--
ALTER TABLE `order_list`
  ADD PRIMARY KEY (`id_order_list`),
  ADD KEY `id_meja` (`id_meja`),
  ADD KEY `id_menu` (`id_menu`),
  ADD KEY `id_staff` (`id_user`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`),
  ADD KEY `id_sumber` (`id_sumber`);

--
-- Indexes for table `reservasi`
--
ALTER TABLE `reservasi`
  ADD PRIMARY KEY (`id_reservasi`),
  ADD KEY `id_staff` (`id_user`);

--
-- Indexes for table `sumber`
--
ALTER TABLE `sumber`
  ADD PRIMARY KEY (`id_sumber`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `meja`
--
ALTER TABLE `meja`
  MODIFY `id_meja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `order_list`
--
ALTER TABLE `order_list`
  MODIFY `id_order_list` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `reservasi`
--
ALTER TABLE `reservasi`
  MODIFY `id_reservasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`id_sumber`) REFERENCES `sumber` (`id_sumber`);

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `reset_reservasi` ON SCHEDULE EVERY 1 DAY STARTS '2020-06-15 23:00:00' ON COMPLETION PRESERVE ENABLE DO UPDATE `meja` JOIN reservasi ON meja.id_reservasi = reservasi.id_reservasi SET jamAntri = '',antrian = '', meja.id_reservasi = 1,status = "kosong" WHERE reservasi.tanggal_reservasi != "0000-00-00 00:00:00"$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
