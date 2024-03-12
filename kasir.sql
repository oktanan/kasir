-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2023 at 09:46 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_codinglinepos`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `id_barang` varchar(100) NOT NULL,
  `barcode` varchar(20) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `stock_minimal` int(11) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_barang`
--

INSERT INTO `tbl_barang` (`id_barang`, `barcode`, `nama_barang`, `harga_beli`, `harga_jual`, `stock`, `satuan`, `stock_minimal`, `gambar`) VALUES
('BRG-001', '8995757018557', 'Susu kental manis', 10000, 11000, 10, 'kaleng', 3, 'BRG-001.jpeg'),
('BRG-002', '8995757018888', 'Sirup Jeruk ', 15000, 16000, 2, 'piece', 3, 'BRG-002.jpeg'),
('BRG-003', '8996767018557', 'Wafer Nabati', 1500, 2000, 6, 'piece', 3, 'BRG-003.jpeg'),
('BRG-004', '8996767018117', 'Isoplus', 2500, 3000, 10, 'botol', 3, 'BRG-004.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_beli_detail`
--

CREATE TABLE `tbl_beli_detail` (
  `id` int(11) NOT NULL,
  `no_beli` varchar(20) NOT NULL,
  `tgl_beli` date NOT NULL,
  `kode_brg` varchar(10) NOT NULL,
  `nama_brg` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `jml_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_beli_detail`
--

INSERT INTO `tbl_beli_detail` (`id`, `no_beli`, `tgl_beli`, `kode_brg`, `nama_brg`, `qty`, `harga_beli`, `jml_harga`) VALUES
(11, 'PB0001', '2023-11-02', 'BRG-002', 'Sirup Jeruk ', 5, 15000, 75000),
(12, 'PB0001', '2023-11-02', 'BRG-001', 'Susu kental manis', 2, 10000, 20000),
(13, 'PB0002', '2023-11-02', 'BRG-003', 'Wafer Nabati', 4, 1500, 6000),
(14, 'PB0002', '2023-11-02', 'BRG-004', 'Isoplus', 2, 2500, 5000),
(15, 'PB0003', '2023-11-03', 'BRG-001', 'Susu kental manis', 2, 10000, 20000),
(16, 'PB0003', '2023-11-03', 'BRG-004', 'Isoplus', 2, 2500, 5000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_beli_head`
--

CREATE TABLE `tbl_beli_head` (
  `no_beli` varchar(20) NOT NULL,
  `tgl_beli` date NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `total` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_beli_head`
--

INSERT INTO `tbl_beli_head` (`no_beli`, `tgl_beli`, `supplier`, `total`, `keterangan`) VALUES
('PB0001', '2023-11-02', 'PT Enseval Mega ', 95000, ''),
('PB0002', '2023-11-02', 'PT SNS', 11000, ''),
('PB0003', '2023-11-03', 'CV Fajar', 25000, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `id_customer` int(11) NOT NULL,
  `nama` varchar(256) NOT NULL,
  `telepon` varchar(25) NOT NULL,
  `deskripsi` varchar(256) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`id_customer`, `nama`, `telepon`, `deskripsi`, `alamat`) VALUES
(2, 'Aletha', '08912345632', 'Pengunjung', 'Mojogedang'),
(3, 'Nazwa', '08912345543', 'Pengunjung', 'Delingan');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jual_detail`
--

CREATE TABLE `tbl_jual_detail` (
  `id` int(11) NOT NULL,
  `no_jual` varchar(20) NOT NULL,
  `tgl_jual` date NOT NULL,
  `barcode` varchar(100) NOT NULL,
  `nama_brg` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `jml_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_jual_detail`
--

INSERT INTO `tbl_jual_detail` (`id`, `no_jual`, `tgl_jual`, `barcode`, `nama_brg`, `qty`, `harga_jual`, `jml_harga`) VALUES
(2, 'PJ0001', '2023-11-02', '8995757018557', 'Susu kental manis', 2, 11000, 22000),
(3, 'PJ0001', '2023-11-02', '8995757018888', 'Sirup Jeruk ', 2, 16000, 32000),
(6, 'PJ0002', '2023-11-02', '8996767018557', 'Wafer Nabati', 2, 2000, 4000),
(7, 'PJ0003', '2023-11-02', '8996767018117', 'Isoplus', 2, 3000, 6000),
(8, 'PJ0003', '2023-11-02', '8996767018557', 'Wafer Nabati', 2, 2000, 4000),
(9, 'PJ0004', '2023-11-04', '8995757018888', 'Sirup Jeruk ', 6, 16000, 96000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jual_head`
--

CREATE TABLE `tbl_jual_head` (
  `no_jual` varchar(20) NOT NULL,
  `tgl_jual` date NOT NULL,
  `customer` varchar(255) NOT NULL,
  `total` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `jml_bayar` int(11) NOT NULL,
  `kembalian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_jual_head`
--

INSERT INTO `tbl_jual_head` (`no_jual`, `tgl_jual`, `customer`, `total`, `keterangan`, `jml_bayar`, `kembalian`) VALUES
('PJ0001', '2023-11-02', 'Aletha', 54000, '', 60000, 6000),
('PJ0002', '2023-11-02', 'Aletha', 4000, '', 10000, 6000),
('PJ0003', '2023-11-02', 'Aletha', 10000, '', 20000, 10000),
('PJ0004', '2023-11-04', 'Nazwa', 96000, '', 100000, 4000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier`
--

CREATE TABLE `tbl_supplier` (
  `id_supplier` int(11) NOT NULL,
  `nama` varchar(256) NOT NULL,
  `telepon` varchar(25) NOT NULL,
  `deskripsi` varchar(256) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`id_supplier`, `nama`, `telepon`, `deskripsi`, `alamat`) VALUES
(1, 'PT Enseval Mega ', '0721725254', 'Distributor', 'Surakarta'),
(4, 'CV Fajar ', '0721485325', 'Distributor Kelontongan', 'Tanjung Selor'),
(5, 'PT SNS', '0721238921', 'Distributor Snack', 'Jambangan');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `userid` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `password` varchar(256) NOT NULL,
  `address` varchar(100) NOT NULL,
  `level` int(1) NOT NULL COMMENT '1-administrator 2-supervisor 3-operator',
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`userid`, `username`, `fullname`, `password`, `address`, `level`, `foto`) VALUES
(8, 'admin', 'admin', '$2y$10$JoKIusmjCvdf77dKAl4FCOWgUJzevsEtQr.95wdc1OvvqBwvTsEKW', 'Karanganyar', 1, '327-face6.jpg'),
(9, 'oktavia', 'oktavia', '$2y$10$VxruaP9mZbox5v7lPeC1Ke/8Z16DM4.goCJrFpxAZBYvYs8JN44wS', 'Sukoharjo', 2, '344-face2.jpg'),
(10, 'kasir', 'kasir', '$2y$10$Lfg/sH5SgPum.f5mMlkYiehdQlZquTBYgLF..brjybEyqv01n7J7W', 'Kebakkramat', 3, '745-logo.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `tbl_beli_detail`
--
ALTER TABLE `tbl_beli_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_beli_head`
--
ALTER TABLE `tbl_beli_head`
  ADD PRIMARY KEY (`no_beli`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `tbl_jual_detail`
--
ALTER TABLE `tbl_jual_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_jual_head`
--
ALTER TABLE `tbl_jual_head`
  ADD PRIMARY KEY (`no_jual`);

--
-- Indexes for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_beli_detail`
--
ALTER TABLE `tbl_beli_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_jual_detail`
--
ALTER TABLE `tbl_jual_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
