-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Apr 2025 pada 15.06
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
-- Database: `database_psb`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `administrasi`
--

CREATE TABLE `administrasi` (
  `Id_Administrasi` int(11) NOT NULL,
  `Id_Data_Siswa` int(11) NOT NULL,
  `Nama_Peserta_Didik` varchar(30) NOT NULL,
  `Nama_Bank` varchar(30) NOT NULL,
  `Bukti_Transfer` varchar(30) NOT NULL,
  `Status` enum('Lunas','Belum Lunas') NOT NULL,
  `tgl_buat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_ortu`
--

CREATE TABLE `data_ortu` (
  `Id_Orang_Tua_Wali` int(11) NOT NULL,
  `Id_Data_Siswa` int(11) NOT NULL,
  `Nama_Ayah` varchar(30) NOT NULL,
  `Status_Ayah` varchar(10) NOT NULL,
  `Tgl_Lahir_Ayah` date NOT NULL,
  `Telepon_Ayah` varchar(14) NOT NULL,
  `Pendidikan_Terakhir_Ayah` varchar(20) NOT NULL,
  `Pekerjaan_Ayah` varchar(30) NOT NULL,
  `Penghasilan_Ayah` varchar(10) NOT NULL,
  `Alamat_Ayah` varchar(165) NOT NULL,
  `Nama_Ibu` varchar(30) NOT NULL,
  `Status_Ibu` varchar(10) NOT NULL,
  `Tgl_Lahir_Ibu` date NOT NULL,
  `Telepon_Ibu` varchar(14) NOT NULL,
  `Pendidikan_Terakhir_Ibu` varchar(20) NOT NULL,
  `Pekerjaan_Ibu` varchar(30) NOT NULL,
  `Penghasilan_Ibu` varchar(10) NOT NULL,
  `Alamat_Ibu` varchar(165) NOT NULL,
  `Nama_Wali` varchar(30) NOT NULL,
  `Status_Wali` varchar(10) NOT NULL,
  `Tgl_Lahir_Wali` date NOT NULL,
  `Telepon_Wali` varchar(14) NOT NULL,
  `Pendidikan_Terakhir_Wali` varchar(20) NOT NULL,
  `Pekerjaan_Wali` varchar(30) NOT NULL,
  `Penghasilan_Wali` varchar(10) NOT NULL,
  `Alamat_Wali` varchar(165) NOT NULL,
  `tgl_buat` datetime NOT NULL,
  `tgl_ubah` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_siswa`
--

CREATE TABLE `data_siswa` (
  `Id_Data_Siswa` int(11) NOT NULL,
  `NISN` varchar(15) NOT NULL,
  `No_KK` varchar(20) NOT NULL,
  `NIK` varchar(16) NOT NULL,
  `Nama_Panggilan` text NOT NULL,
  `Nama_Peserta_Didik` text NOT NULL,
  `Tempat_Lahir` varchar(30) NOT NULL,
  `Tanggal_Lahir` date NOT NULL,
  `Jenis_Kelamin` enum('Laki-Laki','Perempuan') NOT NULL,
  `Agama` varchar(9) NOT NULL,
  `Gol_Darah` varchar(5) NOT NULL,
  `Tinggi_Badan` varchar(4) NOT NULL,
  `Berat_Badan` varchar(3) NOT NULL,
  `Suku` varchar(10) NOT NULL,
  `Bahasa` varchar(12) NOT NULL,
  `Kewarganegaraan` varchar(10) NOT NULL,
  `Status_Anak` varchar(12) NOT NULL,
  `Anak_Ke` int(2) NOT NULL,
  `Jml_Saudara` int(2) NOT NULL,
  `Jenis_Tinggal` varchar(17) NOT NULL,
  `Alamat_Tinggal` text NOT NULL,
  `Provinsi_Tinggal` varchar(30) NOT NULL,
  `Kab_Kota_Tinggal` varchar(30) NOT NULL,
  `Kec_Tinggal` varchar(30) NOT NULL,
  `Kelurahan_Tinggal` varchar(30) NOT NULL,
  `Kode_POS` varchar(6) NOT NULL,
  `Jarak_Ke_Sekolah` varchar(5) NOT NULL,
  `Riwayat_Penyakit` text NOT NULL,
  `status_ortu` tinyint(1) NOT NULL,
  `status_administrasi` tinyint(1) NOT NULL,
  `tgl_buat` datetime NOT NULL,
  `tgl_ubah` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokumen`
--

CREATE TABLE `dokumen` (
  `Id_Dokumen` int(11) NOT NULL,
  `Id_Data_Siswa` int(11) NOT NULL,
  `Nama_Peserta_Didik` varchar(30) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `ktp` varchar(100) NOT NULL,
  `akte` varchar(100) NOT NULL,
  `ijazah` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendidikan`
--

CREATE TABLE `pendidikan` (
  `Id_Pendidikan` int(11) NOT NULL,
  `Nama_Peserta_Didik` varchar(30) NOT NULL,
  `Id_Data_Siswa` int(11) NOT NULL,
  `status_slta` varchar(100) NOT NULL,
  `kota` varchar(100) NOT NULL,
  `kecamatan` varchar(100) NOT NULL,
  `kode_pos` varchar(10) NOT NULL,
  `nama_slta` varchar(100) NOT NULL,
  `no_ijazah` varchar(100) NOT NULL,
  `tahun lulus` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `administrasi`
--
ALTER TABLE `administrasi`
  ADD PRIMARY KEY (`Id_Administrasi`),
  ADD UNIQUE KEY `unique_siswa` (`Id_Data_Siswa`);

--
-- Indeks untuk tabel `data_ortu`
--
ALTER TABLE `data_ortu`
  ADD PRIMARY KEY (`Id_Orang_Tua_Wali`),
  ADD UNIQUE KEY `unique_datasiswa` (`Id_Data_Siswa`);

--
-- Indeks untuk tabel `data_siswa`
--
ALTER TABLE `data_siswa`
  ADD PRIMARY KEY (`Id_Data_Siswa`),
  ADD UNIQUE KEY `NISN` (`NISN`),
  ADD UNIQUE KEY `NIK` (`NIK`);

--
-- Indeks untuk tabel `dokumen`
--
ALTER TABLE `dokumen`
  ADD PRIMARY KEY (`Id_Dokumen`),
  ADD UNIQUE KEY `unique_datasiswa` (`Id_Data_Siswa`);

--
-- Indeks untuk tabel `pendidikan`
--
ALTER TABLE `pendidikan`
  ADD PRIMARY KEY (`Id_Pendidikan`),
  ADD UNIQUE KEY `unique_datasiswa` (`Id_Data_Siswa`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `unique_username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `administrasi`
--
ALTER TABLE `administrasi`
  MODIFY `Id_Administrasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `data_ortu`
--
ALTER TABLE `data_ortu`
  MODIFY `Id_Orang_Tua_Wali` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `data_siswa`
--
ALTER TABLE `data_siswa`
  MODIFY `Id_Data_Siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `dokumen`
--
ALTER TABLE `dokumen`
  MODIFY `Id_Dokumen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pendidikan`
--
ALTER TABLE `pendidikan`
  MODIFY `Id_Pendidikan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
