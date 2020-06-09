-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2020 at 03:57 PM
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
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meja`
--

INSERT INTO `meja` (`id_meja`, `id_user`, `id_reservasi`, `status`) VALUES
(1, 1, 1, 'kosong'),
(2, 1, 1, 'kosong'),
(3, 1, 1, 'kosong'),
(4, 1, 1, 'kosong'),
(5, 3, 1, 'kosong'),
(6, 1, 1, 'kosong'),
(7, 1, 1, 'kosong'),
(8, 1, 1, 'kosong'),
(9, 1, 1, 'kosong'),
(10, 1, 1, 'kosong'),
(11, 1, 1, 'kosong'),
(12, 1, 1, 'kosong'),
(13, 1, 1, 'kosong'),
(14, 1, 1, 'kosong'),
(15, 1, 1, 'kosong'),
(16, 1, 1, 'kosong'),
(17, 1, 1, 'kosong'),
(18, 1, 1, 'kosong'),
(19, 1, 1, 'kosong'),
(20, 1, 1, 'kosong');

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
(20, 'Lele Goreng', 15000, 'lele.jpg');

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
('20200610', 1, '2020-06-09 19:31:12', 40000, 83123);

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
  `ket` varchar(99) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_list`
--

INSERT INTO `order_list` (`id_order_list`, `no_transaksi`, `id_meja`, `id_menu`, `id_user`, `harga`, `quantity`, `total`, `ket`) VALUES
(1, '2020051', 1, 1, 1, 20000, 2, 40000, 'Pesan Ayam'),
(2, '2020051', 1, 1, 1, 20000, 1, 20000, 'Ayam Lagi'),
(3, '2020052', 9, 2, 1, 15000, 3, 45000, 'Beli nasi goreng'),
(4, '2020052', 9, 1, 1, 20000, 1, 20000, 'Ayam'),
(5, '2020053', 3, 1, 1, 20000, 2, 40000, ''),
(6, '2020053', 3, 1, 1, 20000, 2, 40000, 'asd'),
(7, '2020054', 1, 6, 2, 15000, 2, 30000, 'Ketoprak tidak pedes'),
(8, '2020055', 2, 1, 1, 20000, 2, 40000, 'Ayam 1'),
(9, '2020056', 17, 19, 1, 5000, 4, 20000, 'perkedel'),
(10, '2020057', 15, 9, 1, 20000, 2, 40000, 'Capcay 2'),
(11, '2020058', 2, 2, 1, 15000, 2, 30000, 'Jangan terlalu pedas, dan tidak buah buahan'),
(12, '2020058', 2, 3, 1, 30000, 1, 30000, 'Soto nya jangan terlalu pedas'),
(13, '2020059', 1, 1, 1, 20000, 4, 80000, ''),
(14, '2020059', 1, 4, 1, 25000, 1, 25000, ''),
(15, '20200610', 5, 1, 3, 20000, 2, 40000, '');

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
  `tanggal_reservasi` date NOT NULL,
  `jam` varchar(10) NOT NULL,
  `nama_pelanggan` varchar(50) NOT NULL,
  `no_telp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservasi`
--

INSERT INTO `reservasi` (`id_reservasi`, `id_user`, `tanggal_reservasi`, `jam`, `nama_pelanggan`, `no_telp`) VALUES
(1, 1, '0000-00-00', '', 'kosong', ''),
(2, 1, '2020-05-13', '18:00', 'Rama', ''),
(3, 1, '2020-05-16', '12:12', 'Ismail', '123123'),
(4, 1, '2020-05-16', '20:00', 'Ismail', '123123'),
(5, 1, '2020-05-20', '20:12', 'Rama', '123'),
(6, 2, '2020-05-21', '12:12', 'Olaf', '0900'),
(7, 1, '2020-05-23', '12:12', 'Opa', '123'),
(8, 1, '2020-05-25', '12:00', 'Haki', '0876854666');

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
(6, 'lukas', '213', 'Lukasiho', 'Lukasiho@yahoo.com', 'Pelanggan');

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
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `order_list`
--
ALTER TABLE `order_list`
  MODIFY `id_order_list` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `reservasi`
--
ALTER TABLE `reservasi`
  MODIFY `id_reservasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`id_sumber`) REFERENCES `sumber` (`id_sumber`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
