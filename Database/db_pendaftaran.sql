-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Bulan Mei 2025 pada 06.22
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
-- Database: `db_pendaftaran`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `administrasi`
--

CREATE TABLE `administrasi` (
  `ID_BAYAR` int(11) NOT NULL,
  `ID_SISWA` int(11) NOT NULL,
  `NAMA_BANK` varchar(11) NOT NULL,
  `BUKTI_TRANSFER` varchar(100) NOT NULL,
  `STATUS` enum('LUNAS','BELUM LUNAS') NOT NULL,
  `TGL_BUAT` datetime NOT NULL,
  `JUMLAH_BIAYA` int(20) NOT NULL,
  `TGL_UBAH` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `administrasi`
--

INSERT INTO `administrasi` (`ID_BAYAR`, `ID_SISWA`, `NAMA_BANK`, `BUKTI_TRANSFER`, `STATUS`, `TGL_BUAT`, `JUMLAH_BIAYA`, `TGL_UBAH`) VALUES
(1, 1, 'BRI', '', 'LUNAS', '2025-05-04 04:41:52', 70000, '2025-05-04 06:31:04'),
(3, 2, 'BNI', '★ twinkling watermelon cast.jpg', 'LUNAS', '2025-05-04 07:22:49', 9000000, '2025-05-04 06:31:40'),
(4, 3, 'bni', '', 'LUNAS', '2025-05-07 03:49:37', 876543, '2025-05-07 01:49:37'),
(5, 4, 'jhg', '', 'LUNAS', '2025-05-07 03:49:48', 98765, '2025-05-07 01:49:48'),
(6, 6, 'kjhgf', '', 'LUNAS', '2025-05-07 03:50:05', 98765, '2025-05-07 01:50:05'),
(7, 5, 'oiugv', '', 'BELUM LUNAS', '2025-05-07 03:50:40', 987654, '2025-05-07 01:50:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dataadmin`
--

CREATE TABLE `dataadmin` (
  `ID_ADMIN` int(11) NOT NULL,
  `NAMA_ADMIN` varchar(20) NOT NULL,
  `EMAIL` varchar(40) NOT NULL,
  `USERNAME` varchar(30) NOT NULL,
  `PASSWORD` varchar(30) NOT NULL,
  `GAMBAR` varchar(100) NOT NULL,
  `TGL_BUAT` datetime NOT NULL,
  `TGL_UBAH` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `dataadmin`
--

INSERT INTO `dataadmin` (`ID_ADMIN`, `NAMA_ADMIN`, `EMAIL`, `USERNAME`, `PASSWORD`, `GAMBAR`, `TGL_BUAT`, `TGL_UBAH`) VALUES
(1, 'Qaulan Sakila Usman', 'Usmanqaulan@gmail.com', 'ulan', 'ulan', '', '2025-05-04 06:24:37', '2025-05-04 05:29:36'),
(2, 'Dwi Andriyani', 'Andriyani@gmail.com', 'lia', 'lia', '0a98e28a-2e61-4700-8904-4be8681b790c.jpg', '2025-05-04 06:13:25', '2025-05-04 05:28:09'),
(4, 'Jubaidah', 'ida', 'ida', 'ida', 'download.jpg', '2025-05-04 07:03:53', '2025-05-04 05:03:53'),
(5, 'gigi', 'lala', 'sisi', 'kuku', 'download (1).png', '2025-05-04 07:27:21', '2025-05-04 05:27:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dataortu_wali`
--

CREATE TABLE `dataortu_wali` (
  `ID_ORTU_WALI` int(11) NOT NULL,
  `ID_SISWA` int(11) NOT NULL,
  `NAMA_AYAH` varchar(30) NOT NULL,
  `TEMPAT_LAHIR_AYAH` varchar(20) NOT NULL,
  `TGL_LAHIR_AYAH` date NOT NULL,
  `AGAMA_AYAH` enum('Islam','Kristen Prostestan','Kristen Katolik','Hindu','Buddha','Konghucu') NOT NULL,
  `PENDIDIKAN_TERAKHIR_AYAH` varchar(20) NOT NULL,
  `PEKERJAAN_AYAH` varchar(30) NOT NULL,
  `ALAMAT_RUMAH_AYAH` text NOT NULL,
  `KODE_POS_AYAH` int(5) NOT NULL,
  `TELEPON_AYAH` int(15) NOT NULL,
  `NAMA_IBU` varchar(30) NOT NULL,
  `TEMPAT_LAHIR_IBU` varchar(20) NOT NULL,
  `TGL_LAHIR_IBU` date NOT NULL,
  `AGAMA_IBU` enum('Islam','Kristen Protestan','Kristen Katolik','Hindu','Buddha','Konghucu') NOT NULL,
  `PENDIDIKAN_TERAKHIR_IBU` varchar(20) NOT NULL,
  `PEKERJAAN_IBU` varchar(20) NOT NULL,
  `ALAMAT_RUMAH_IBU` text NOT NULL,
  `KODE_POS_IBU` int(5) NOT NULL,
  `TELEPON_IBU` int(15) NOT NULL,
  `NAMA_WALI` varchar(20) NOT NULL,
  `TEMPAT_LAHIR_WALI` varchar(20) NOT NULL,
  `TGL_LAHIR_WALI` date NOT NULL,
  `AGAMA_WALI` enum('Islam','Kristen Protestan','Kristen Katolik','Hindu','Buddha','Konghucu') NOT NULL,
  `PENDIDIKAN_TERAKHIR_WALI` varchar(20) NOT NULL,
  `PEKERJAAN_WALI` varchar(20) NOT NULL,
  `ALAMAT_RUMAH_WALI` text NOT NULL,
  `KODE_POS_WALI` int(5) NOT NULL,
  `TELEPON_WALI` int(15) NOT NULL,
  `HUBUNGAN_WALI` varchar(20) NOT NULL,
  `TGL_BUAT1` datetime NOT NULL,
  `TGL_UBAH1` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `dataortu_wali`
--

INSERT INTO `dataortu_wali` (`ID_ORTU_WALI`, `ID_SISWA`, `NAMA_AYAH`, `TEMPAT_LAHIR_AYAH`, `TGL_LAHIR_AYAH`, `AGAMA_AYAH`, `PENDIDIKAN_TERAKHIR_AYAH`, `PEKERJAAN_AYAH`, `ALAMAT_RUMAH_AYAH`, `KODE_POS_AYAH`, `TELEPON_AYAH`, `NAMA_IBU`, `TEMPAT_LAHIR_IBU`, `TGL_LAHIR_IBU`, `AGAMA_IBU`, `PENDIDIKAN_TERAKHIR_IBU`, `PEKERJAAN_IBU`, `ALAMAT_RUMAH_IBU`, `KODE_POS_IBU`, `TELEPON_IBU`, `NAMA_WALI`, `TEMPAT_LAHIR_WALI`, `TGL_LAHIR_WALI`, `AGAMA_WALI`, `PENDIDIKAN_TERAKHIR_WALI`, `PEKERJAAN_WALI`, `ALAMAT_RUMAH_WALI`, `KODE_POS_WALI`, `TELEPON_WALI`, `HUBUNGAN_WALI`, `TGL_BUAT1`, `TGL_UBAH1`) VALUES
(3, 1, 'Vikram Rathore', 'India', '1999-09-09', 'Hindu', 'SMA/SMK', 'Guru', 'India', 1876, 987652345, 'Lalisa Mnaoban', 'korea', '1888-09-09', 'Kristen Katolik', 'SMA/SMK', 'chef', 'korea', 12345, 89764, 'Samsudin Haji', 'Tidore', '1999-09-09', 'Kristen Protestan', 'SMP', 'ingi', 'poiuytr', 19007, 9876543, 'anak', '2025-05-04 06:49:24', '2025-05-03 23:13:33'),
(4, 2, 'lili lala', 'dfhyu', '1990-02-02', 'Hindu', 'D1', 'dyuytre', 'wertybv', 123456, 876543, 'siti', 'wefg', '1999-02-09', 'Hindu', 'D2', 'waitress', 'wefgb', 2345, 9890, '', '', '0000-00-00', '', '', '', '', 0, 0, '', '2025-05-04 06:56:36', '2025-05-03 23:14:30'),
(5, 3, 'sdfg', 'wedrfg', '2009-09-09', 'Buddha', 'D2', 'ertghw', 'edfgb', 234, 3456, 'cgvhbjk', 'tfygui', '2008-08-08', 'Kristen Katolik', 'D3', 'iuytrdb', 'ugfvb', 9876, 9876, '', '', '0000-00-00', '', '', '', '', 0, 0, '', '2025-05-07 02:42:54', '2025-05-07 00:42:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `datasiswa`
--

CREATE TABLE `datasiswa` (
  `ID_SISWA` int(11) NOT NULL,
  `NAMA_LENGKAP` text NOT NULL,
  `NAMA_PANGGILAN` text NOT NULL,
  `TEMPAT_LAHIR` varchar(20) NOT NULL,
  `TGL_LAHIR` date NOT NULL,
  `JENIS_KELAMIN` enum('Laki - Laki','Perempuan') NOT NULL,
  `TINGGI_BADAN` varchar(4) NOT NULL,
  `BERAT_BADAN` varchar(3) NOT NULL,
  `PANJANG_TANGAN` varchar(4) NOT NULL,
  `PANJANG_KAKI` varchar(4) NOT NULL,
  `AGAMA` enum('Islam','Kristen Protestan','Kristen Katolik','Hindu','Buddha','Konghucu') NOT NULL,
  `ALAMAT_RUMAH` text NOT NULL,
  `KODE_POS_RUMAH` varchar(5) NOT NULL,
  `TELEPON_RUMAH` int(15) NOT NULL,
  `ASAL_SEKOLAH` text NOT NULL,
  `KELAS_JURUSAN` varchar(20) NOT NULL,
  `ALAMAT_SEKOLAH` text NOT NULL,
  `KODE_POS_SEKOLAH` varchar(5) NOT NULL,
  `TELEPON_SEKOLAH` int(15) NOT NULL,
  `HOBI` varchar(15) NOT NULL,
  `TGL_BUAT` datetime NOT NULL,
  `TGL_UBAH` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `STATUS` enum('BELUM DIVERIFIKASI','DITOLAK','DIVERIFIKASI','') NOT NULL,
  `KETERAMPILAN_KHUSUS` varchar(20) NOT NULL,
  `PENGHARGAAN_SEKOLAH` varchar(20) NOT NULL,
  `PENGHARGAAN_KECAMATAN` varchar(20) NOT NULL,
  `PENGHARGAAN_KAB_KOTA` varchar(20) NOT NULL,
  `PENGHARGAAN_PROVINSI` varchar(20) NOT NULL,
  `PENGHARGAAN_NASIONAL` varchar(20) NOT NULL,
  `PENGHARGAAN_INTERNASIONAL` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `datasiswa`
--

INSERT INTO `datasiswa` (`ID_SISWA`, `NAMA_LENGKAP`, `NAMA_PANGGILAN`, `TEMPAT_LAHIR`, `TGL_LAHIR`, `JENIS_KELAMIN`, `TINGGI_BADAN`, `BERAT_BADAN`, `PANJANG_TANGAN`, `PANJANG_KAKI`, `AGAMA`, `ALAMAT_RUMAH`, `KODE_POS_RUMAH`, `TELEPON_RUMAH`, `ASAL_SEKOLAH`, `KELAS_JURUSAN`, `ALAMAT_SEKOLAH`, `KODE_POS_SEKOLAH`, `TELEPON_SEKOLAH`, `HOBI`, `TGL_BUAT`, `TGL_UBAH`, `STATUS`, `KETERAMPILAN_KHUSUS`, `PENGHARGAAN_SEKOLAH`, `PENGHARGAAN_KECAMATAN`, `PENGHARGAAN_KAB_KOTA`, `PENGHARGAAN_PROVINSI`, `PENGHARGAAN_NASIONAL`, `PENGHARGAAN_INTERNASIONAL`) VALUES
(1, 'Emma Yuan', 'Emma', 'Beijing', '2009-09-09', 'Perempuan', '168', '50', '50', '50', 'Konghucu', 'Beijing, China', '17890', 55555, 'University Beijing', 'Business', 'Beijing', '17906', 821912047, 'swimming', '2025-05-04 06:41:29', '2025-05-07 02:31:57', 'DITOLAK', 'Reading', '', 'juara 1 Masak', '', '', '', ''),
(2, 'Viona Snow Etherland', 'vivi', 'Etherland', '2001-01-01', 'Perempuan', '180', '50', '50', '50', 'Kristen Katolik', 'barat', '5678', 1234, 'bojong gede', 'masako', 'utara', '75678', 87654567, 'renang', '2025-05-04 06:52:58', '2025-05-07 02:31:04', 'BELUM DIVERIFIKASI', 'jatuh', '', '', '', '', '', ''),
(3, 'fgvhbjn', 'kjhgfb', 'iuytrdcvb', '2007-08-08', '', '9876', '987', '976', '9876', 'Kristen Protestan', 'iuydcvb', '98', 987654, 'iuytfn', 'iuytcvb', 'iuytvbn', '987', 87, 'hgv', '2025-05-06 05:25:23', '2025-05-07 02:31:07', 'BELUM DIVERIFIKASI', 'iuygfvb', '', '', '', '', '', ''),
(4, 'hgfcb', 'wertyu', 'fgm', '2006-06-01', '', '876', '7', '876', '9876', 'Kristen Protestan', 'jhgfc ', '87', 987654, 'iuygfn', 'oiuytd', 'iuyfdcvbn', '76', 98765, 'iufcvbn', '2025-05-06 05:26:49', '2025-05-07 02:31:09', 'BELUM DIVERIFIKASI', 'iugfcvbn', '', '', '', '', '', ''),
(5, 'oiuytdsxcvbn', 'ugfcvbnm', 'ogfcghjk', '2004-08-08', 'Perempuan', '567', '456', '67', '67', 'Hindu', 'dfghj', '56', 456, 'sdfghj', 'iuyf ', 'wertyui', '876', 987654, 'iugfvbn', '2025-05-06 05:27:49', '2025-05-07 02:31:11', 'BELUM DIVERIFIKASI', 'iuytfdc', '', '', '', '', '', ''),
(6, 'iugfcvbn', 'hdvhxbcncb', 'chcvxhjdh', '2003-01-01', 'Perempuan', '7865', '778', '784', '7656', 'Kristen Katolik', 'hvhdvhg', '454', 76578, 'fhcuuvu', 'uvgcj', 'xbcgy', '46548', 97544874, 'kucg', '2025-05-06 05:28:50', '2025-05-07 02:31:13', 'BELUM DIVERIFIKASI', 'uvrc hf', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokumen`
--

CREATE TABLE `dokumen` (
  `ID_DOKUMEN` int(11) NOT NULL,
  `ID_SISWA` int(11) NOT NULL,
  `AKTA` varchar(100) NOT NULL,
  `KARTU_KELUARGA` varchar(100) NOT NULL,
  `IJAZAH` varchar(100) NOT NULL,
  `SKL` varchar(100) NOT NULL,
  `BUKU_PIP` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `dokumen`
--

INSERT INTO `dokumen` (`ID_DOKUMEN`, `ID_SISWA`, `AKTA`, `KARTU_KELUARGA`, `IJAZAH`, `SKL`, `BUKU_PIP`) VALUES
(1, 1, 'AKTA_1_1746325710.jpg', 'KARTU_KELUARGA_1_1746325710.pdf', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `administrasi`
--
ALTER TABLE `administrasi`
  ADD PRIMARY KEY (`ID_BAYAR`),
  ADD KEY `fk_siswa_bayar` (`ID_SISWA`);

--
-- Indeks untuk tabel `dataadmin`
--
ALTER TABLE `dataadmin`
  ADD PRIMARY KEY (`ID_ADMIN`),
  ADD UNIQUE KEY `UNIQUE_ADMIN` (`USERNAME`);

--
-- Indeks untuk tabel `dataortu_wali`
--
ALTER TABLE `dataortu_wali`
  ADD PRIMARY KEY (`ID_ORTU_WALI`),
  ADD UNIQUE KEY `UNIQUE_SISWA` (`ID_SISWA`);

--
-- Indeks untuk tabel `datasiswa`
--
ALTER TABLE `datasiswa`
  ADD PRIMARY KEY (`ID_SISWA`);

--
-- Indeks untuk tabel `dokumen`
--
ALTER TABLE `dokumen`
  ADD PRIMARY KEY (`ID_DOKUMEN`),
  ADD KEY `fk_siswa_dokumen` (`ID_SISWA`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `administrasi`
--
ALTER TABLE `administrasi`
  MODIFY `ID_BAYAR` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `dataadmin`
--
ALTER TABLE `dataadmin`
  MODIFY `ID_ADMIN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `dataortu_wali`
--
ALTER TABLE `dataortu_wali`
  MODIFY `ID_ORTU_WALI` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `datasiswa`
--
ALTER TABLE `datasiswa`
  MODIFY `ID_SISWA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `dokumen`
--
ALTER TABLE `dokumen`
  MODIFY `ID_DOKUMEN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `administrasi`
--
ALTER TABLE `administrasi`
  ADD CONSTRAINT `fk_siswa_bayar` FOREIGN KEY (`ID_SISWA`) REFERENCES `datasiswa` (`ID_SISWA`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `dataortu_wali`
--
ALTER TABLE `dataortu_wali`
  ADD CONSTRAINT `fk_siswa_ortu` FOREIGN KEY (`ID_SISWA`) REFERENCES `datasiswa` (`ID_SISWA`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `dokumen`
--
ALTER TABLE `dokumen`
  ADD CONSTRAINT `fk_siswa_dokumen` FOREIGN KEY (`ID_SISWA`) REFERENCES `datasiswa` (`ID_SISWA`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
