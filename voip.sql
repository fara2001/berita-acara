-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 20 Sep 2024 pada 05.03
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `voip`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `ba`
--

CREATE TABLE `ba` (
  `id` int(11) NOT NULL,
  `ba` varchar(99) NOT NULL,
  `perusahaan` varchar(99) NOT NULL,
  `nomor_surat` varchar(99) NOT NULL,
  `tanggal` date NOT NULL,
  `customer_name` varchar(99) NOT NULL,
  `address` varchar(99) NOT NULL,
  `installation_address` varchar(99) NOT NULL,
  `person_in_charge` varchar(99) NOT NULL,
  `contact_person` varchar(99) NOT NULL,
  `working_order` varchar(99) NOT NULL,
  `customer_id` varchar(99) NOT NULL,
  `circuit_id` varchar(99) NOT NULL,
  `jenis_layanan` varchar(99) NOT NULL,
  `note` varchar(99) DEFAULT NULL,
  `third_party` varchar(99) NOT NULL,
  `nama_jabatan` varchar(99) NOT NULL,
  `jabatan` varchar(99) NOT NULL,
  `site_engineer` varchar(99) NOT NULL,
  `site_engineer_jabatan` varchar(99) NOT NULL,
  `lampiran_gambar` varchar(999) DEFAULT NULL,
  `lampiran_text` varchar(9999) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `ba`
--

INSERT INTO `ba` (`id`, `ba`, `perusahaan`, `nomor_surat`, `tanggal`, `customer_name`, `address`, `installation_address`, `person_in_charge`, `contact_person`, `working_order`, `customer_id`, `circuit_id`, `jenis_layanan`, `note`, `third_party`, `nama_jabatan`, `jabatan`, `site_engineer`, `site_engineer_jabatan`, `lampiran_gambar`, `lampiran_text`) VALUES
(1, '', '', '8989', '2001-08-09', '89', '89', '898', '98', '989', '89', '898', '98', '98', '98', '989', '89', '', '', '', NULL, NULL),
(2, '', '', '8989', '2001-08-09', '89', '89', '898', '98', '989', '89', '898', '98', '98', '98', '989', '89', '', '98', '', NULL, NULL),
(3, '', '', '8989', '2001-08-09', '89', '89', '898', '98', '989', '89', '898', '98', '98', '98', '989', '89', '', '98', '', NULL, NULL),
(4, '', '', '7878', '2007-07-07', '78', '787', '87', '87', '87', '87', '878', '78', '87', '7', '878', '78', '', '7', '', NULL, NULL),
(5, '', '', '7878', '2007-07-07', '78', '787', '87', '87', '87', '87', '878', '78', '87', '7', '878', '78', '', '7', '', NULL, NULL),
(6, 'Pasang Baru', 'PT DIGITAL SATELLITE INDONESIA', '001/OC/DS1/I/2024', '2024-01-01', 'Fahmi Rasyied', 'jl.Asem II gg.H.Muhammad No.57 RT 004/03 Cipete Selatan', 'Cilandak, Jakarta Selatan, DKI Jakarta, Indonesia', 'op', 'op', 'opo', 'po', 'po', 'po', 'po', 'po', 'pop', '', 'op', '', NULL, NULL),
(7, 'Pasang Baru', 'PT DIGITAL SATELLITE INDONESIA', '001/OC/DS1/I/2024', '2024-01-01', 'Fahmi Rasyied', 'jl.Asem II gg.H.Muhammad No.57 RT 004/03 Cipete Selatan', 'Cilandak, Jakarta Selatan, DKI Jakarta, Indonesia', 'op', 'op', 'opo', 'po', 'po', 'po', 'po', 'po', 'pop', '', 'op', '', NULL, NULL),
(8, 'Pasang Baru', 'PT DIGITAL SATELLITE INDONESIA', '001/OC/DS1/I/2024', '2024-09-18', 'ty', 'ty', 'tyt', 'yt', 'yty', 'ty', 'ty', 'ty', 'tyt', 'yt', 'tyt', 'yy', '', 'tyt', '', NULL, NULL),
(9, 'Pasang Baru', 'PT DIGITAL SATELLITE INDONESIA', '001/OC/DS1/I/2024', '2002-02-02', '67', '67', '67', '67', '67', '67', '67', '676', '767', '676', '76', '676', 'Manager Operation', '67777', 'noc', NULL, NULL),
(10, 'Pasang Baru', 'PT DIGITAL SATELLITE INDONESIA', '001/OC/DS1/I/2024', '2024-09-02', 'g', 'hgh', 'gh', 'gh', 'gh', 'ghg', 'hg', 'hg', 'hgh', 'gh', 'ghg', 'gh', 'Manager Operation', 'ghg', 'Network Operation', 'uploads/Screenshot_20240821_151621.png', 'tytytytyy'),
(11, 'Pasang Baru', 'PT DIGITAL SATELLITE INDONESIA', '001/OC/DS1/I/2024', '2024-09-02', 'g', 'hgh', 'gh', 'gh', 'gh', 'ghg', 'hg', 'hg', 'hgh', 'gh', 'ghg', 'gh', 'Manager Operation', 'ghg', 'Network Operation', 'uploads/Screenshot_20240821_151621.png', 'tytytytyy'),
(12, 'Pasang Baru', 'PT DIGITAL SATELLITE INDONESIA', '001/OC/DS1/I/2024', '2024-09-03', 'ty', 'tyt', 'yt', 'yt', 'yty', 'ty', 'ty', 'ty', 'ty', 'ty', 'tyt', 'yt', 'Manager Operation', 'yt', 'Network Operation', 'uploads/Screenshot_20240823_110934.png', 'tyty');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_nomor`
--

CREATE TABLE `data_nomor` (
  `id` int(11) NOT NULL,
  `geo_number` varchar(50) DEFAULT NULL,
  `toll_free_number` varchar(50) DEFAULT NULL,
  `number_translasi` varchar(50) DEFAULT NULL,
  `customer` varchar(100) DEFAULT NULL,
  `tanggal_aktif` date DEFAULT '0000-00-00',
  `server` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `is_delete` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_nomor`
--

INSERT INTO `data_nomor` (`id`, `geo_number`, `toll_free_number`, `number_translasi`, `customer`, `tanggal_aktif`, `server`, `status`, `is_delete`) VALUES
(1, '02150997010', '08001401593', 'Yes', 'EPSILON', '2024-08-13', 'Enigma', 'Aktif', 0),
(2, '02150997011', '08001401594', 'No', 'TIRTA', '0000-00-00', 'Timber', 'Available', 1),
(3, '02150997012', '08001401595', 'No', 'MORATEL', '0000-00-00', 'Enigma', 'Available', 0),
(4, '02150997013', '08001401596', 'No', 'IFORTE', '2024-08-16', 'Timber', 'Aktif', 1),
(5, '02150997014', '08001401597', 'Yes', 'EPSILON', '0000-00-00', 'Enigma', 'Available', 0),
(6, '02150997016', '08001401599', 'No', 'TIRTA', '2007-01-18', 'Rubik', 'Aktif', 1),
(7, '02150997018', '08001401601', 'Yes', 'MORATEL', '0000-00-00', 'Enigma', 'Available', 0),
(8, '02150997019', '08001401602', 'No', 'IFORTE', '0000-00-00', 'TIMBER', 'Available', 0),
(11, '02150997022', '08001401605', 'Yes', 'MORATEL', '0000-00-00', 'Timber', 'Available', 0),
(12, '02150997023', '08001401606', 'No', 'IFORTE', '0000-00-00', 'Rubik', 'Aktif', 0),
(13, '02150997024', '08001401607', 'Yes', 'EPSILON', '0000-00-00', 'Enigma', 'Available', 0),
(14, '02150997025', '08001401608', 'No', 'TIRTA', '0000-00-00', 'Timber', 'Aktif', 0),
(15, '02150997026', '08001401609', 'Yes', 'MORATEL', '0000-00-00', 'Rubik', 'Available', 0),
(16, '02150997027', '08001401610', 'No', 'IFORTE', '0000-00-00', 'Enigma', 'Aktif', 0),
(17, '02150997028', '08001401611', 'Yes', 'EPSILON', '0000-00-00', 'Timber', 'Available', 0),
(18, '02150997029', '08001401612', 'No', 'TIRTA', '0000-00-00', 'Rubik', 'Aktif', 0),
(19, '02150997030', '08001401613', 'Yes', 'MORATEL', '0000-00-00', 'Enigma', 'Available', 0),
(20, '02150997031', '08001401614', 'No', 'IFORTE', '0000-00-00', 'Timber', 'Aktif', 0),
(21, '02150997032', '08001401615', 'Yes', 'EPSILON', '0000-00-00', 'Rubik', 'Available', 0),
(22, '02150997033', '08001401616', 'No', 'TIRTA', '0000-00-00', 'Enigma', 'Aktif', 0),
(23, '02150997034', '08001401617', 'Yes', 'MORATEL', '0000-00-00', 'Timber', 'Available', 0),
(24, '02150997035', '08001401618', 'No', 'IFORTE', '0000-00-00', 'Rubik', 'Aktif', 0),
(25, '02150997036', '08001401619', 'Yes', 'EPSILON', '0000-00-00', 'Enigma', 'Available', 0),
(26, '02150997037', '08001401620', 'No', 'TIRTA', '0000-00-00', 'Timber', 'Aktif', 0),
(27, '02150997038', '08001401621', 'Yes', 'MORATEL', '0000-00-00', 'Rubik', 'Available', 0),
(28, '02150997039', '08001401622', 'No', 'IFORTE', '0000-00-00', 'Enigma', 'Aktif', 0),
(29, '02150997040', '08001401623', 'Yes', 'EPSILON', '0000-00-00', 'Enigma', 'Available', 0),
(30, '02150997041', '08001401624', 'No', 'TIRTA', '0000-00-00', 'Rubik', 'Aktif', 0),
(31, '02150997042', '08001401625', 'Yes', 'MORATEL', '0000-00-00', 'Enigma', 'Available', 0),
(32, '02150997043', '08001401626', 'No', 'IFORTE', '0000-00-00', 'Timber', 'Aktif', 0),
(33, '02150997044', '08001401627', 'Yes', 'EPSILON', '0000-00-00', 'Rubik', 'Available', 0),
(34, '02150997045', '08001401628', 'No', 'TIRTA', '0000-00-00', 'Enigma', 'Aktif', 0),
(35, '02150997046', '08001401629', 'Yes', 'MORATEL', '0000-00-00', 'Timber', 'Available', 0),
(36, '02150997047', '08001401630', 'No', 'IFORTE', '0000-00-00', 'Rubik', 'Aktif', 0),
(37, '02150997048', '08001401631', 'Yes', 'EPSILON', '0000-00-00', 'Enigma', 'Available', 0),
(38, '02150997049', '08001401632', 'No', 'TIRTA', '0000-00-00', 'Timber', 'Aktif', 0),
(39, '02150997050', '08001401633', 'Yes', 'MORATEL', '0000-00-00', 'Rubik', 'Available', 0),
(40, '02150997051', '08001401634', 'No', 'IFORTE', '0000-00-00', 'Enigma', 'Aktif', 0),
(41, '02150997052', '08001401635', 'Yes', 'EPSILON', '0000-00-00', 'Timber', 'Available', 0),
(42, '02150997053', '08001401636', 'No', 'TIRTA', '0000-00-00', 'Rubik', 'Aktif', 0),
(43, '02150997054', '08001401637', 'Yes', 'MORATEL', '0000-00-00', 'Enigma', 'Available', 0),
(44, '02150997055', '08001401638', 'No', 'IFORTE', '0000-00-00', 'Timber', 'Aktif', 0),
(45, '02150997056', '08001401639', 'Yes', 'EPSILON', '0000-00-00', 'Rubik', 'Available', 0),
(46, '02150997058', '08001401641', 'No', 'TIRTA', '2024-08-05', 'Enigma', 'Aktif', 0),
(47, '02150997059', '08001401642', 'Yes', 'MORATEL', '0000-00-00', 'Timber', 'Available', 0),
(48, '02150997017', '08001401643', 'No', 'IFORTE', '0000-00-00', 'Rubik', 'Aktif', 1),
(49, '02150997057', '08001401644', 'Yes', 'EPSILON', '0000-00-00', 'Enigma', 'Available', 1),
(126, '888888888', '087787020853', 'Yes', 'FAHMI RASYIED', '2024-07-30', 'Enigma', 'Aktif', 0),
(127, '09999999', '6666666', 'Yes', 'RUKITA', '2024-08-05', 'EPSILON', 'Aktif', 1),
(128, '02111111111', '08777777777', 'Yes', 'RUKITA', '2024-09-20', 'Enigma', 'Aktif', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `username` varchar(99) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`username`, `password`) VALUES
('fahmi', '1234');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `ba`
--
ALTER TABLE `ba`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_nomor`
--
ALTER TABLE `data_nomor`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `ba`
--
ALTER TABLE `ba`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `data_nomor`
--
ALTER TABLE `data_nomor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
