-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2021 at 02:19 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventori_kelompok5`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `merek` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL DEFAULT 0,
  `gambar` varchar(100) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `qrcode` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `merek`, `jumlah`, `gambar`, `keterangan`, `id_kategori`, `qrcode`) VALUES
(1, 'Laptop DELL Inspiron 14', 'DELL', 90, 'dell-inspiron-14-e8cf1869e893518dbf65e0202865e86f.jpg', 'Intel Core i7 6500U 2.5GHz Turbo 3.1GHz dengan RAM 4GB dan kapasitas penyimpanan 1TB', 1, NULL),
(2, 'HP 15 Athlon Gold 3150U', 'HP', 100, 'HP-15-Athlon-Gold-3150U.jpg', 'Processor: AMD Athlon™ Gold 3150U (2.4 GHz base clock, up to 3.3 GHz max boost clock, 1 MB L2 cache,', 1, NULL),
(3, 'ASUS VivoBook X441MA N4000', 'ASUS', 100, 'ASUS-VivoBook-X441MA-N4000.jpg', 'Processor: Intel® Celeron® N4000 1.1 GHz (4M Cache, up to 2.6 GHz)\r\nGraphic Card: Intel® UHD Graphic', 1, NULL),
(4, 'Asus ROG Strix Gaming Monitor 25 Inch XG258Q', 'ASUS', 100, '5ab1c25090105.jpg', 'Wide Screen\r\nUkuran : 25 Inch\r\nResolusi : 1920 x 1080\r\nRasio Aspek : 16:9\r\nRasio Kontras : 1000:1\r\nW', 2, NULL),
(5, 'RAZER Keyboard Huntsman Mini Clicky Optical Switch Gaming Keyboard', 'Razer', 0, '607d467cb1944.jpg', 'Gaming Keyboard\r\nSwitch : Clicky Optical Switch\r\nRazer Chroma™ customizable backlighting with 16.8 m', 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Laptop'),
(2, 'Perangkat Komputer'),
(3, 'Alat Tulis Kerja'),
(4, 'Printer'),
(5, 'Fasilitas Kelas');

-- --------------------------------------------------------

--
-- Table structure for table `keluar_item`
--

CREATE TABLE `keluar_item` (
  `id` int(11) NOT NULL,
  `id_penempatan` varchar(255) NOT NULL,
  `id_barang` varchar(255) NOT NULL,
  `jumlah_keluar` int(11) NOT NULL,
  `id_lokasi` int(11) NOT NULL,
  `tgl_keluar` datetime NOT NULL DEFAULT current_timestamp(),
  `qrcode` varchar(255) DEFAULT NULL,
  `keterangan` varchar(100) NOT NULL DEFAULT 'ada, baik'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keluar_item`
--

INSERT INTO `keluar_item` (`id`, `id_penempatan`, `id_barang`, `jumlah_keluar`, `id_lokasi`, `tgl_keluar`, `qrcode`, `keterangan`) VALUES
(1, 'KLR-2106231', '1', 10, 1, '2021-06-23 18:36:10', NULL, 'ada, baik');

--
-- Triggers `keluar_item`
--
DELIMITER $$
CREATE TRIGGER `penempatan_barang` AFTER INSERT ON `keluar_item` FOR EACH ROW BEGIN
	UPDATE barang SET jumlah=jumlah-NEW.jumlah_keluar
    WHERE id_barang = NEW.id_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `lokasi`
--

CREATE TABLE `lokasi` (
  `id_lokasi` int(11) NOT NULL,
  `nama_lokasi` varchar(100) NOT NULL,
  `fakultas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lokasi`
--

INSERT INTO `lokasi` (`id_lokasi`, `nama_lokasi`, `fakultas`) VALUES
(1, 'Ruang Kelas A', 'Fakultas Ilmu Komputer dan Teknologi Informasi'),
(2, 'Ruang Kepala Prodi Teknologi Informasi', 'Fakultas Ilmu Komputer dan Teknologi Informasi'),
(3, 'Ruang Dosen TI', 'Fakultas Ilmu Komputer dan Teknologi Informasi'),
(4, 'Ruang Kepala prodi Ilmu Komputer', 'Fakultas Ilmu Komputer dan Teknologi Informasi'),
(5, 'Ruang Dosen Ilkom', 'Fakultas Ilmu Komputer dan Teknologi Informasi'),
(6, 'Laboratorium Jaringan', 'Fakultas Ilmu Komputer dan Teknologi Informasi'),
(7, 'Laboratorium Pemrograman', 'Fakultas Ilmu Komputer dan Teknologi Informasi'),
(8, 'Laboratorium Database', 'Fakultas Ilmu Komputer dan Teknologi Informasi'),
(9, 'Laboratorium Multimedia', 'Fakultas Ilmu Komputer dan Teknologi Informasi'),
(10, 'Ruang Seminar TI', 'Fakultas Ilmu Komputer dan Teknologi Informasi');

-- --------------------------------------------------------

--
-- Table structure for table `masuk_item`
--

CREATE TABLE `masuk_item` (
  `id` int(11) NOT NULL,
  `id_pengadaan` varchar(255) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah_masuk` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `tgl_masuk` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `masuk_item`
--

INSERT INTO `masuk_item` (`id`, `id_pengadaan`, `id_barang`, `jumlah_masuk`, `harga`, `tgl_masuk`) VALUES
(1, 'MSK-2106231', 1, 80, 80000000, '2021-06-23 18:36:19'),
(2, 'MSK-2106231', 3, 100, 110000000, '2021-06-23 18:36:19');

--
-- Triggers `masuk_item`
--
DELIMITER $$
CREATE TRIGGER `pengadaan_barang` AFTER INSERT ON `masuk_item` FOR EACH ROW BEGIN
	UPDATE barang SET jumlah = jumlah+NEW.jumlah_masuk
    WHERE id_barang = NEW.id_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `EMP_ID` int(11) NOT NULL,
  `EMP_NAME` varchar(300) NOT NULL,
  `EMP_ADDRESS` varchar(300) NOT NULL,
  `EMP_CELL` varchar(300) NOT NULL,
  `EMP_EMAIL` varchar(300) NOT NULL,
  `EMP_GENDER` varchar(11) NOT NULL,
  `EMP_DATE` date NOT NULL,
  `CREATED_DATE` date DEFAULT NULL,
  `CREATED_USERID` int(11) DEFAULT NULL,
  `UPDATED_DATE` date DEFAULT NULL,
  `UPDATED_USERID` int(11) DEFAULT NULL,
  `STATUS` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`EMP_ID`, `EMP_NAME`, `EMP_ADDRESS`, `EMP_CELL`, `EMP_EMAIL`, `EMP_GENDER`, `EMP_DATE`, `CREATED_DATE`, `CREATED_USERID`, `UPDATED_DATE`, `UPDATED_USERID`, `STATUS`) VALUES
(1, 'Naomi', 'sibolga barus', '082277364268', 'naomihutauruk08@gmail.com', 'P', '0000-00-00', '2021-06-02', NULL, NULL, NULL, 0),
(2, 'Mita Amelia', 'gg Medan Area, jl Jamin Ginting', '082145786363', 'mita@gmail.com', 'P', '0000-00-00', '2021-06-03', NULL, NULL, NULL, 0),
(3, 'Monika Pasaribu', 'jl Ring Road Setia Budi ', '082252123656', 'monika@gmail.com', 'P', '0000-00-00', '2021-06-03', NULL, NULL, NULL, 0),
(4, 'Kristina Nainggolan ', 'gg Medan Area, jl Jamin Ginting', '082145786363', 'kristina@gmail.com', 'P', '0000-00-00', '2021-06-03', NULL, NULL, NULL, 0),
(5, 'Mail', 'sibolga barus', '082277364268', 'mail@gmail.com', 'L', '0000-00-00', '2021-06-03', NULL, NULL, NULL, 0),
(6, 'Mian H', 'gg Ganefo jl jamin Ginting Padang Bulan', '082514526324', 'mian@gmail.com', 'L', '0000-00-00', '2021-06-03', NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `penempatan`
--

CREATE TABLE `penempatan` (
  `id_penempatan` varchar(255) NOT NULL,
  `id_lokasi` int(11) NOT NULL,
  `tgl_permintaan_penempatan` datetime NOT NULL,
  `tgl_disetujui` datetime DEFAULT NULL,
  `tgl_ditempatkan` datetime DEFAULT NULL,
  `USER_ID` int(11) NOT NULL,
  `disetujui_oleh` int(11) DEFAULT NULL,
  `pegawai_penanggung_jawab` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `_diselesaikan` int(11) DEFAULT NULL,
  `diselesaikan_oleh` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penempatan`
--

INSERT INTO `penempatan` (`id_penempatan`, `id_lokasi`, `tgl_permintaan_penempatan`, `tgl_disetujui`, `tgl_ditempatkan`, `USER_ID`, `disetujui_oleh`, `pegawai_penanggung_jawab`, `status`, `_diselesaikan`, `diselesaikan_oleh`) VALUES
('KLR-2106231', 1, '2021-06-08 00:00:00', '2021-06-23 13:35:30', '2021-06-23 13:36:10', 1, 1005, 2, 1, 1, 1006);

-- --------------------------------------------------------

--
-- Table structure for table `pengadaan`
--

CREATE TABLE `pengadaan` (
  `id_pengadaan` varchar(255) NOT NULL,
  `tgl_permintaan` datetime DEFAULT NULL,
  `tgl_disetujui` datetime DEFAULT NULL,
  `tgl_masuk` datetime DEFAULT NULL,
  `total_harga` int(11) DEFAULT NULL,
  `id_supplier` int(11) NOT NULL,
  `USER_ID` int(11) NOT NULL,
  `disetujui_oleh` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `_dibayar` int(11) DEFAULT NULL,
  `dibayar_oleh` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengadaan`
--

INSERT INTO `pengadaan` (`id_pengadaan`, `tgl_permintaan`, `tgl_disetujui`, `tgl_masuk`, `total_harga`, `id_supplier`, `USER_ID`, `disetujui_oleh`, `status`, `_dibayar`, `dibayar_oleh`) VALUES
('MSK-2106231', NULL, '2021-06-23 13:32:12', '2021-06-23 13:36:19', 190000000, 1, 1, 1005, 1, 1, 1006),
('MSK-2106232', '2021-06-23 00:00:00', NULL, NULL, 100000000, 1, 1, NULL, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `permintaan_penempatan_item`
--

CREATE TABLE `permintaan_penempatan_item` (
  `id` int(11) NOT NULL,
  `id_penempatan` varchar(255) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `id_lokasi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `permintaan_penempatan_item`
--

INSERT INTO `permintaan_penempatan_item` (`id`, `id_penempatan`, `id_barang`, `jumlah`, `id_lokasi`) VALUES
(1, 'KLR-2106231', 1, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `permintaan_pengadaan_item`
--

CREATE TABLE `permintaan_pengadaan_item` (
  `id` int(11) NOT NULL,
  `id_pengadaan` varchar(255) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `permintaan_pengadaan_item`
--

INSERT INTO `permintaan_pengadaan_item` (`id`, `id_pengadaan`, `id_barang`, `jumlah`, `harga`) VALUES
(3, 'MSK-2106231', 1, 80, 80000000),
(4, 'MSK-2106231', 3, 100, 110000000),
(5, 'MSK-2106232', 1, 10, 100000000);

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int(11) NOT NULL,
  `nama_petugas` varchar(100) NOT NULL,
  `no_telepon` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `GROUP_ID` int(11) NOT NULL,
  `USER_ID` int(11) NOT NULL,
  `gambar_petugas` int(100) DEFAULT NULL,
  `STATUS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `nama_petugas`, `no_telepon`, `alamat`, `GROUP_ID`, `USER_ID`, `gambar_petugas`, `STATUS`) VALUES
(1, 'Anggitri Sihombing', '082370252763', 'Kisaran', 1, 1, NULL, 0),
(2, 'Alya Febriani', '08123456789', 'Medan', 2, 1005, NULL, 0),
(3, 'Putri Handayani', '08987654324', 'Padang Sidimpuan', 3, 1006, NULL, 0),
(4, 'Naomi Hutahuruk', '081387465837', 'Sibolga', 1, 1007, NULL, 0),
(5, 'Sonia Rai', '081398473937', 'Tebing Tinggi', 3, 1008, NULL, 0),
(6, 'Dinda Manurung', '08168402403', 'Kisaran', 3, 1009, NULL, 0),
(7, 'Jessica Wong', '08176253748', 'Tapaktuan', 2, 1010, NULL, 0),
(8, 'Dindid', '12345', 'Medan', 1, 1011, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sig`
--

CREATE TABLE `sig` (
  `id` int(11) NOT NULL,
  `img` varchar(100) NOT NULL,
  `USER_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sig`
--

INSERT INTO `sig` (`id`, `img`, `USER_ID`) VALUES
(1, 'assets/signature-image/60bb629d20fdf.png', 1),
(2, 'assets/signature-image/60bb62ae30fe9.png', 1),
(3, 'assets/signature-image/60bb7234c22ac.png', 1),
(4, 'assets/signature-image/60bb7331ef3ef.png', 1),
(5, 'assets/signature-image/60bb978353c2e.png', 1),
(6, 'assets/signature-image/60bc74a59b824.png', 1),
(7, 'assets/signature-image/60bd9607527c3.png', 1),
(8, 'assets/signature-image/60d31ba97fb37.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL,
  `nama_supplier` varchar(100) NOT NULL,
  `nama_perusahaan` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_telp` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `STATUS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `nama_perusahaan`, `email`, `no_telp`, `alamat`, `STATUS`) VALUES
(1, 'Sentral Komputer', 'Sentral Komputer', 'sentralkomputer@gmail.com', '081286888651', 'Taman Pulo Indah Jl. Manggis Blok M 34 Penggilingan Jakarta timur 13940', 1),
(2, 'Aneka Kertas Toko', 'Aneka Kertas Toko', 'anekakertas@gmail.com', '0614579173', 'JL Prof HM Yamin SH 283, Medan, 20232, Sidodadi, East Medan, Medan City, North Sumatra 20233', 0),
(3, 'Toko Mebel Kantor Kota Medan, Sumatera Utara ', 'PT WIRA UTAMA (Office Furniture Medan)', 'wirautama@gmail.com', '0614531952', 'Jalan Prefessor Jl. Prof. HM. Yamin Sh No.23, Perintis, GH, Medan City, North Sumatra 20234', 0),
(4, 'Ricky Hanbert', 'PT. Hanatekindo Mulia Abadi', 'info@hanatekindo.co.id', '027508989', 'Komplek, Golden Fatmawati, Blk. J 10 Jl. RS. Fatmawati Raya No.8, RT.8/RW.6, Gandaria Sel., Kec. Cil', 0),
(5, 'Bambang Hermansyah', 'PT. GUNUNGSEMESTA ELEKTRIKA', 'sales@gunungsemesta.com', '0216264525', 'Komp. Harco Mangga Dua Blok D No.8 Jl. Mangga Dua Raya - Jakarta Pusat 10730', 0);

-- --------------------------------------------------------

--
-- Table structure for table `usr_group`
--

CREATE TABLE `usr_group` (
  `GROUP_ID` int(11) NOT NULL,
  `GROUP_NAME` varchar(100) NOT NULL,
  `CREATED_DATE` date DEFAULT NULL,
  `CREATED_USERID` int(11) DEFAULT NULL,
  `UPDATED_DATE` date DEFAULT NULL,
  `UPDATED_USERID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usr_group`
--

INSERT INTO `usr_group` (`GROUP_ID`, `GROUP_NAME`, `CREATED_DATE`, `CREATED_USERID`, `UPDATED_DATE`, `UPDATED_USERID`) VALUES
(1, 'Superadmin', '2015-02-27', 1, NULL, NULL),
(2, 'Manager', '2015-02-27', 1, NULL, NULL),
(3, 'Petugas', '2015-02-27', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `usr_menu`
--

CREATE TABLE `usr_menu` (
  `MENU_ID` int(11) NOT NULL,
  `MENU_TEXT` varchar(100) DEFAULT NULL,
  `MENU_URL` varchar(500) DEFAULT NULL,
  `PARENT_ID` int(11) DEFAULT NULL,
  `SORT_ORDER` int(11) DEFAULT NULL,
  `SHOW_IN_MENU` int(11) DEFAULT NULL,
  `IS_ADMIN` varchar(1) DEFAULT NULL,
  `CREATED_DATE` date DEFAULT NULL,
  `CREATED_USERID` int(11) DEFAULT NULL,
  `UPDATED_DATE` date DEFAULT NULL,
  `UPDATED_USERID` int(11) DEFAULT NULL,
  `icon` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usr_menu`
--

INSERT INTO `usr_menu` (`MENU_ID`, `MENU_TEXT`, `MENU_URL`, `PARENT_ID`, `SORT_ORDER`, `SHOW_IN_MENU`, `IS_ADMIN`, `CREATED_DATE`, `CREATED_USERID`, `UPDATED_DATE`, `UPDATED_USERID`, `icon`) VALUES
(1, 'Kelola User', '#', 0, 1, 1, '1', NULL, NULL, NULL, NULL, 'fa fa-user'),
(2, 'Tambah User', 'User/tambah_user', 1, 2, 1, NULL, NULL, NULL, NULL, NULL, ''),
(3, 'People', '#', 0, 2, 1, NULL, NULL, NULL, NULL, NULL, 'fa fa-users'),
(4, 'Data Petugas', 'Petugas/data_petugas', 3, 1, 1, NULL, NULL, NULL, NULL, NULL, ''),
(5, 'Barang', '#', 0, 3, 1, NULL, NULL, NULL, NULL, NULL, 'fa fa-cubes'),
(6, 'List Barang', 'Barang/data_barang', 5, 1, 1, NULL, NULL, NULL, NULL, NULL, ''),
(7, 'Tambah Grup User', 'User/grup_user', 1, 2, 1, NULL, '2016-06-09', 1, NULL, NULL, ''),
(8, 'Data Pegawai', 'Pegawai/data_pegawai', 3, 2, 1, NULL, '2016-06-16', 1, NULL, NULL, ''),
(9, 'Input Output Barang', '#', 0, 4, 1, NULL, '2018-05-06', 1, NULL, NULL, 'fa fa-exchange'),
(10, 'Pengadaan', 'Pengadaan/data_pengadaan', 9, 1, 1, NULL, '2018-05-06', 1, NULL, NULL, ''),
(11, 'Kategori Barang', 'Kategori/data_kategori', 5, 2, 1, NULL, '2018-05-06', 1, NULL, NULL, ''),
(13, 'Lokasi', '#', 0, 5, 1, NULL, '2018-05-06', 1, NULL, NULL, 'fa fa-map-marker'),
(14, 'Invoice Pengadaan', 'Pengadaan/invoice_pengadaan', 9, 2, 1, NULL, '2018-05-06', 1, NULL, NULL, ''),
(15, 'Aset Inventaris', 'Penempatan/aset_inventaris', 9, 4, 1, NULL, '2018-05-06', 1, NULL, NULL, ''),
(16, 'Data Lokasi', 'Lokasi/data_lokasi', 13, 1, 1, NULL, '2018-05-06', 1, NULL, NULL, ''),
(17, 'Data Fakultas', 'Fakultas/data_fakultas', 13, 2, 0, NULL, '2018-05-06', 1, NULL, NULL, ''),
(18, 'Laporan Pengadaan', 'Laporan/laporan_pengadaan', 21, 1, 1, NULL, '2018-05-06', 1, NULL, NULL, ''),
(19, 'Laporan Penempatan', 'Laporan/laporan_penempatan', 21, 1, 1, NULL, '2018-05-06', 1, NULL, NULL, ''),
(20, 'Penempatan', 'Penempatan/data_penempatan', 9, 3, 1, NULL, '2018-05-06', 1, NULL, NULL, ''),
(21, 'Reports', '#', 0, 6, 1, NULL, '2018-05-11', 1, NULL, NULL, 'fa fa-file'),
(22, 'Laporan Pemindahan', 'reports/mutation', 21, 1, 0, NULL, '2018-05-11', 1, NULL, NULL, ''),
(23, 'Laporan Peminjaman', 'reports/loan', 21, 2, 0, NULL, '2018-05-11', 1, NULL, NULL, ''),
(24, 'Data Supplier', 'Supplier/data_supplier', 3, 3, 1, NULL, '2018-05-11', 1, NULL, NULL, ''),
(25, 'Pengaturan Umum', '#', 0, 9, 0, NULL, '2018-05-06', 1, NULL, NULL, 'fa fa-cog'),
(26, 'Profil', 'pengaturan/profil', 25, 1, 1, NULL, NULL, NULL, NULL, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `usr_permission`
--

CREATE TABLE `usr_permission` (
  `PER_ID` int(11) NOT NULL,
  `GROUP_ID` int(11) NOT NULL,
  `MENU_ID` int(11) NOT NULL,
  `PER_SELECT` varchar(1) NOT NULL,
  `PER_INSERT` varchar(1) NOT NULL,
  `PER_UPDATE` varchar(1) NOT NULL,
  `PER_DELETE` varchar(1) NOT NULL,
  `CREATED_DATE` date DEFAULT NULL,
  `CREATED_USERID` int(11) DEFAULT NULL,
  `UPDATED_DATE` date DEFAULT NULL,
  `UPDATED_USERID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usr_permission`
--

INSERT INTO `usr_permission` (`PER_ID`, `GROUP_ID`, `MENU_ID`, `PER_SELECT`, `PER_INSERT`, `PER_UPDATE`, `PER_DELETE`, `CREATED_DATE`, `CREATED_USERID`, `UPDATED_DATE`, `UPDATED_USERID`) VALUES
(1, 2, 2, '0', '0', '0', '0', NULL, NULL, '2018-05-17', 1),
(2, 2, 3, '0', '0', '0', '0', NULL, NULL, '2018-05-17', 1),
(3, 2, 4, '1', '0', '0', '0', NULL, NULL, '2018-05-17', 1),
(4, 2, 5, '1', '0', '0', '0', NULL, NULL, '2018-05-17', 1),
(5, 2, 6, '1', '0', '0', '0', NULL, NULL, '2016-06-16', 1),
(6, 2, 7, '0', '0', '0', '0', NULL, NULL, '2018-05-17', 1),
(7, 2, 8, '1', '0', '0', '0', NULL, NULL, '2016-06-16', 1),
(8, 2, 9, '1', '0', '0', '0', NULL, NULL, '2016-06-16', 1),
(9, 2, 10, '1', '0', '0', '0', NULL, NULL, '2016-06-16', 1),
(10, 2, 11, '1', '0', '0', '0', NULL, NULL, '2016-06-16', 1),
(11, 2, 14, '1', '0', '0', '0', NULL, NULL, '2016-06-16', 1),
(12, 2, 15, '1', '0', '0', '0', '2015-03-02', 1, '2016-06-16', 1),
(13, 2, 16, '1', '0', '0', '0', '2015-03-02', 1, '2016-06-16', 1),
(14, 2, 17, '1', '0', '0', '0', '2015-03-02', 1, '2016-06-16', 1),
(15, 2, 18, '1', '0', '0', '0', '2015-03-02', 1, '2018-05-17', 1),
(16, 2, 19, '1', '0', '0', '0', '2015-03-02', 1, '2016-06-16', 1),
(17, 1, 2, '0', '0', '0', '0', '2015-03-06', 1, '2015-04-15', 1),
(18, 1, 3, '1', '1', '1', '1', '2015-03-06', 1, '2015-04-15', 1),
(19, 1, 5, '0', '0', '0', '0', '2015-03-06', 1, '2015-04-15', 1),
(20, 1, 6, '0', '0', '0', '0', '2015-03-06', 1, '2015-04-15', 1),
(21, 1, 9, '0', '0', '0', '0', '2015-03-06', 1, NULL, NULL),
(22, 1, 10, '0', '0', '0', '0', '2015-03-06', 1, NULL, NULL),
(23, 1, 11, '0', '0', '0', '0', '2015-03-06', 1, NULL, NULL),
(24, 1, 12, '0', '0', '0', '0', '2015-03-06', 1, '2015-04-15', 1),
(25, 1, 13, '0', '0', '0', '0', '2015-03-06', 1, '2015-04-15', 1),
(26, 1, 14, '0', '0', '0', '0', '2015-03-06', 1, '2015-04-15', 1),
(27, 1, 15, '0', '0', '0', '0', '2015-03-06', 1, NULL, NULL),
(28, 1, 16, '0', '0', '0', '0', '2015-03-06', 1, NULL, NULL),
(29, 1, 17, '0', '0', '0', '0', '2015-03-06', 1, NULL, NULL),
(30, 1, 18, '0', '0', '0', '0', '2015-03-06', 1, NULL, NULL),
(31, 1, 19, '0', '0', '0', '0', '2015-03-06', 1, NULL, NULL),
(32, 1, 21, '1', '1', '1', '1', '2015-03-06', 1, '2015-04-15', 1),
(33, 1, 22, '1', '1', '1', '1', '2015-03-06', 1, '2015-04-15', 1),
(34, 2, 20, '1', '0', '0', '0', '2015-03-16', 1, '2018-05-17', 1),
(35, 2, 21, '1', '0', '0', '0', '2015-03-16', 1, '2017-10-18', 1),
(36, 2, 22, '1', '0', '0', '0', '2015-03-16', 1, '2017-10-18', 1),
(37, 2, 23, '1', '0', '0', '0', '2015-03-16', 1, '2017-10-18', 1),
(38, 2, 24, '1', '0', '0', '0', '2015-03-16', 1, '2017-10-18', 1),
(39, 1, 23, '0', '0', '0', '0', '2015-04-15', 1, '2015-04-15', 1),
(40, 1, 24, '0', '0', '0', '0', '2015-04-15', 1, '2015-04-15', 1),
(41, 1, 25, '0', '0', '0', '0', '2015-04-15', 1, '2015-04-15', 1),
(42, 1, 26, '0', '0', '0', '0', '2015-04-15', 1, '2015-04-15', 1),
(43, 2, 26, '1', '0', '0', '0', '2015-09-11', 1, '2017-10-18', 1),
(44, 2, 27, '0', '0', '0', '0', '2015-09-11', 1, '2017-10-18', 1),
(45, 2, 28, '0', '0', '0', '0', '2015-09-11', 1, '2017-10-18', 1),
(46, 2, 29, '0', '0', '0', '0', '2015-09-11', 1, '2017-10-18', 1),
(47, 2, 1, '1', '0', '0', '0', '2016-06-16', 1, '2018-05-17', 1),
(48, 2, 7, '0', '0', '0', '0', '2016-06-16', 1, NULL, NULL),
(49, 2, 8, '0', '0', '0', '0', '2016-06-16', 1, NULL, NULL),
(50, 2, 20, '0', '0', '0', '0', '2016-06-16', 1, NULL, NULL),
(51, 3, 8, '1', '1', '1', '1', '2017-08-01', 1, NULL, NULL),
(52, 3, 24, '1', '1', '1', '1', '2017-08-01', 1, NULL, NULL),
(53, 3, 6, '1', '1', '1', '1', '2017-08-01', 1, NULL, NULL),
(54, 3, 11, '1', '1', '1', '1', '2017-08-01', 1, NULL, NULL),
(55, 3, 10, '1', '1', '1', '1', '2017-08-01', 1, NULL, NULL),
(56, 3, 14, '1', '1', '1', '1', '2017-08-01', 1, NULL, NULL),
(57, 3, 16, '1', '1', '1', '1', '2017-08-01', 1, NULL, NULL),
(58, 3, 18, '1', '1', '1', '1', '2017-08-01', 1, NULL, NULL),
(59, 3, 19, '1', '1', '1', '1', '2018-05-11', 1, '2018-05-17', 1),
(60, 3, 20, '1', '1', '1', '1', '2018-05-11', 1, '2018-05-17', 1),
(61, 3, 26, '1', '1', '1', '1', '2018-05-11', 1, '2018-05-17', 1),
(62, 3, 2, '0', '0', '0', '0', '2018-05-11', 1, '2018-05-17', 1),
(63, 3, 4, '1', '0', '0', '0', '2018-05-11', 1, '2018-05-17', 1),
(64, 2, 36, '0', '0', '0', '0', '2018-05-11', 1, '2018-05-17', 1),
(65, 2, 37, '1', '0', '0', '0', '2018-05-11', 1, '2018-05-17', 1),
(66, 2, 38, '1', '0', '0', '0', '2018-05-11', 1, '2018-05-17', 1),
(67, 2, 39, '0', '0', '0', '0', '2018-05-11', 1, '2018-05-17', 1),
(68, 2, 40, '1', '0', '0', '0', '2018-05-11', 1, '2018-05-17', 1),
(69, 2, 41, '1', '0', '0', '0', '2018-05-11', 1, '2018-05-17', 1),
(70, 2, 42, '1', '0', '0', '0', '2018-05-11', 1, '2018-05-17', 1),
(71, 2, 43, '1', '1', '0', '0', '2018-05-11', 1, '2018-05-17', 1),
(72, 2, 44, '1', '0', '0', '0', '2018-05-11', 1, '2018-05-17', 1),
(73, 2, 45, '1', '0', '0', '0', '2018-05-11', 1, '2018-05-17', 1),
(74, 2, 46, '1', '0', '0', '0', '2018-05-11', 1, '2018-05-17', 1),
(75, 3, 15, '1', '1', '1', '1', '2018-05-11', 1, '2018-05-17', 1),
(76, 2, 48, '1', '0', '0', '0', '2018-05-11', 1, '2018-05-17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `usr_user`
--

CREATE TABLE `usr_user` (
  `USER_ID` int(11) NOT NULL,
  `USER_NAME` varchar(100) NOT NULL,
  `FULL_NAME` varchar(100) DEFAULT NULL,
  `U_PASSWORD` varchar(500) NOT NULL,
  `GROUP_ID` int(11) NOT NULL,
  `SUP_ADMIN` varchar(1) DEFAULT NULL,
  `CREATED_DATE` date DEFAULT NULL,
  `CREATED_USERID` int(11) DEFAULT NULL,
  `UPDATED_DATE` date DEFAULT NULL,
  `UPDATED_USERID` int(11) DEFAULT NULL,
  `STATUS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usr_user`
--

INSERT INTO `usr_user` (`USER_ID`, `USER_NAME`, `FULL_NAME`, `U_PASSWORD`, `GROUP_ID`, `SUP_ADMIN`, `CREATED_DATE`, `CREATED_USERID`, `UPDATED_DATE`, `UPDATED_USERID`, `STATUS`) VALUES
(1, 'anggitrisi', 'Anggitri Si', 'a770eb7fc6ea2f42f6c65ab90b39534aa1119b5c', 1, NULL, NULL, NULL, NULL, NULL, 1),
(2, 'superadmin', '0', '90b9aa7e25f80cf4f64e990b78a9fc5ebd6cecad', 1, NULL, NULL, NULL, '2017-08-08', 1, 0),
(1005, 'alya', NULL, 'da6676444e60ac70d2f90217951908225e618ff3', 2, NULL, NULL, NULL, NULL, NULL, 1),
(1006, 'putri', NULL, '34aae98596354bf1dd42afe362fc48e5a91c612e', 3, NULL, NULL, NULL, NULL, NULL, 1),
(1007, 'naomi', NULL, '063bcdfa20312bcb2504c70cd7ca4a96fc55adb5', 1, NULL, NULL, NULL, NULL, NULL, 1),
(1008, 'soniarai', NULL, '0a057c1744534c9270aa2a1f8f6c3ebe0c8a44a9', 3, NULL, NULL, NULL, NULL, NULL, 1),
(1009, 'dinda', NULL, '85f4057c80fbd417a78d9629d03f0d97cd9b214f', 3, NULL, NULL, NULL, NULL, NULL, 1),
(1010, 'wong', NULL, '11fa32e991bb7ab31f56a15ebcf3598169bca1da', 2, NULL, NULL, NULL, NULL, NULL, 1),
(1011, 'dindid', NULL, 'df44a3cde5853e07f85c8787fbf182c34a29ef5c', 1, NULL, NULL, NULL, NULL, NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `keluar_item`
--
ALTER TABLE `keluar_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lokasi`
--
ALTER TABLE `lokasi`
  ADD PRIMARY KEY (`id_lokasi`);

--
-- Indexes for table `masuk_item`
--
ALTER TABLE `masuk_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`EMP_ID`);

--
-- Indexes for table `penempatan`
--
ALTER TABLE `penempatan`
  ADD PRIMARY KEY (`id_penempatan`);

--
-- Indexes for table `pengadaan`
--
ALTER TABLE `pengadaan`
  ADD PRIMARY KEY (`id_pengadaan`);

--
-- Indexes for table `permintaan_penempatan_item`
--
ALTER TABLE `permintaan_penempatan_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permintaan_pengadaan_item`
--
ALTER TABLE `permintaan_pengadaan_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indexes for table `sig`
--
ALTER TABLE `sig`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `usr_group`
--
ALTER TABLE `usr_group`
  ADD PRIMARY KEY (`GROUP_ID`);

--
-- Indexes for table `usr_menu`
--
ALTER TABLE `usr_menu`
  ADD PRIMARY KEY (`MENU_ID`),
  ADD KEY `FK_usr_menu_usr_menu_menu_id` (`PARENT_ID`);

--
-- Indexes for table `usr_permission`
--
ALTER TABLE `usr_permission`
  ADD PRIMARY KEY (`PER_ID`),
  ADD KEY `FK_usr_permission_usr_group_group_id` (`GROUP_ID`),
  ADD KEY `FK_usr_permission_usr_menu_menu_id` (`MENU_ID`);

--
-- Indexes for table `usr_user`
--
ALTER TABLE `usr_user`
  ADD PRIMARY KEY (`USER_ID`),
  ADD UNIQUE KEY `UK_USER_NAME` (`USER_NAME`),
  ADD KEY `FK_usr_user_usr_group_group_id` (`GROUP_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `keluar_item`
--
ALTER TABLE `keluar_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lokasi`
--
ALTER TABLE `lokasi`
  MODIFY `id_lokasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `masuk_item`
--
ALTER TABLE `masuk_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `EMP_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `permintaan_penempatan_item`
--
ALTER TABLE `permintaan_penempatan_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permintaan_pengadaan_item`
--
ALTER TABLE `permintaan_pengadaan_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sig`
--
ALTER TABLE `sig`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `usr_group`
--
ALTER TABLE `usr_group`
  MODIFY `GROUP_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `usr_menu`
--
ALTER TABLE `usr_menu`
  MODIFY `MENU_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `usr_user`
--
ALTER TABLE `usr_user`
  MODIFY `USER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1012;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
