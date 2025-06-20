-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Jun 2025 pada 01.20
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
(1, 9, 'BNI', 'Relasi Tabel.png', 'LUNAS', '2025-05-22 07:56:51', 700000, '2025-05-22 05:56:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dataadmin`
--

CREATE TABLE `dataadmin` (
  `ID_ADMIN` int(11) NOT NULL,
  `NAMA_ADMIN` varchar(20) NOT NULL,
  `USERNAME` varchar(100) NOT NULL,
  `TELEPON` varchar(20) NOT NULL,
  `PASSWORD` varchar(100) NOT NULL,
  `GAMBAR` varchar(100) NOT NULL,
  `TGL_BUAT` datetime NOT NULL,
  `TGL_UBAH` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `dataadmin`
--

INSERT INTO `dataadmin` (`ID_ADMIN`, `NAMA_ADMIN`, `USERNAME`, `TELEPON`, `PASSWORD`, `GAMBAR`, `TGL_BUAT`, `TGL_UBAH`) VALUES
(3, 'Admin', 'admin', '082191208347', '21232f297a57a5a743894a0e4a801fc3', 'Best 111+ Anime Profile Pictures 35.jpg', '2025-05-17 15:26:27', '2025-05-22 05:53:37');

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
  `TELEPON_AYAH` varchar(15) NOT NULL,
  `NAMA_IBU` varchar(30) NOT NULL,
  `TEMPAT_LAHIR_IBU` varchar(20) NOT NULL,
  `TGL_LAHIR_IBU` date NOT NULL,
  `AGAMA_IBU` enum('Islam','Kristen Protestan','Kristen Katolik','Hindu','Buddha','Konghucu') NOT NULL,
  `PENDIDIKAN_TERAKHIR_IBU` varchar(20) NOT NULL,
  `PEKERJAAN_IBU` varchar(20) NOT NULL,
  `ALAMAT_RUMAH_IBU` text NOT NULL,
  `KODE_POS_IBU` int(5) NOT NULL,
  `TELEPON_IBU` varchar(15) NOT NULL,
  `NAMA_WALI` varchar(20) NOT NULL,
  `TEMPAT_LAHIR_WALI` varchar(20) NOT NULL,
  `TGL_LAHIR_WALI` date NOT NULL,
  `AGAMA_WALI` enum('Islam','Kristen Protestan','Kristen Katolik','Hindu','Buddha','Konghucu') NOT NULL,
  `PENDIDIKAN_TERAKHIR_WALI` varchar(20) NOT NULL,
  `PEKERJAAN_WALI` varchar(20) NOT NULL,
  `ALAMAT_RUMAH_WALI` text NOT NULL,
  `KODE_POS_WALI` int(5) NOT NULL,
  `TELEPON_WALI` varchar(15) NOT NULL,
  `HUBUNGAN_WALI` varchar(20) NOT NULL,
  `TGL_BUAT1` datetime NOT NULL,
  `TGL_UBAH1` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `dataortu_wali`
--

INSERT INTO `dataortu_wali` (`ID_ORTU_WALI`, `ID_SISWA`, `NAMA_AYAH`, `TEMPAT_LAHIR_AYAH`, `TGL_LAHIR_AYAH`, `AGAMA_AYAH`, `PENDIDIKAN_TERAKHIR_AYAH`, `PEKERJAAN_AYAH`, `ALAMAT_RUMAH_AYAH`, `KODE_POS_AYAH`, `TELEPON_AYAH`, `NAMA_IBU`, `TEMPAT_LAHIR_IBU`, `TGL_LAHIR_IBU`, `AGAMA_IBU`, `PENDIDIKAN_TERAKHIR_IBU`, `PEKERJAAN_IBU`, `ALAMAT_RUMAH_IBU`, `KODE_POS_IBU`, `TELEPON_IBU`, `NAMA_WALI`, `TEMPAT_LAHIR_WALI`, `TGL_LAHIR_WALI`, `AGAMA_WALI`, `PENDIDIKAN_TERAKHIR_WALI`, `PEKERJAAN_WALI`, `ALAMAT_RUMAH_WALI`, `KODE_POS_WALI`, `TELEPON_WALI`, `HUBUNGAN_WALI`, `TGL_BUAT1`, `TGL_UBAH1`) VALUES
(1, 9, 'Usman Daud', 'Tidore', '1973-12-01', 'Islam', 'D4/S1', 'PNS/Guru', 'Desa Somahode', 18972, '082193645389', 'Julaiha Adam', 'Topo', '1982-05-09', 'Islam', 'SMA/SMK', 'Ibu Rumah Tangga', 'Desa Somahode', 18972, '085468299191', '', '', '0000-00-00', '', '', '', '', 0, '', '', '2025-05-17 15:43:49', '2025-05-17 13:43:49');

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
  `TELEPON_RUMAH` varchar(15) NOT NULL,
  `ASAL_SEKOLAH` text NOT NULL,
  `KELAS_JURUSAN` varchar(20) NOT NULL,
  `ALAMAT_SEKOLAH` text NOT NULL,
  `KODE_POS_SEKOLAH` varchar(5) NOT NULL,
  `TELEPON_SEKOLAH` varchar(15) NOT NULL,
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
(9, 'Huria Dhahika Usman', 'Heru', 'Sofifi', '2006-03-23', 'Perempuan', '155', '60', '50', '50', 'Islam', 'Desa Somahode', '18976', '082191208347', 'SD Somahode', '6', 'Desa Somahode', '18756', '082198465789', 'Main Voli', '2025-05-17 15:41:25', '2025-06-16 04:59:43', 'DITOLAK', 'Menari', '', '', '', 'Juara Main Voli', '', ''),
(13, 'Qaulan Sakila Usman', 'Ulan', 'Tidore', '2003-09-30', 'Perempuan', '154', '62', '40', '40', 'Islam', 'Kelurahan Topo', '18967', '082191208342', 'SMAN 3 TIDORE KEPULAUAN', 'IPA', 'Gamtufkange', '18974', '08283745698', '', '2025-06-20 23:24:32', '2025-06-20 21:24:32', 'BELUM DIVERIFIKASI', '', '', '', '', '', '', '');

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
(1, 9, 'AKTA_9_1748342139.pdf', 'KARTU_KELUARGA_9_1748342139.pdf', 'IJAZAH_9_1748342139.pdf', 'SKL_9_1748342139.pdf', '');

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
  ADD PRIMARY KEY (`ID_ADMIN`);

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
  MODIFY `ID_BAYAR` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `dataadmin`
--
ALTER TABLE `dataadmin`
  MODIFY `ID_ADMIN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `dataortu_wali`
--
ALTER TABLE `dataortu_wali`
  MODIFY `ID_ORTU_WALI` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `datasiswa`
--
ALTER TABLE `datasiswa`
  MODIFY `ID_SISWA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `dokumen`
--
ALTER TABLE `dokumen`
  MODIFY `ID_DOKUMEN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
