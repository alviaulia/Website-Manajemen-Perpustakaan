-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2024 at 07:24 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` int(11) NOT NULL,
  `nama_anggota` varchar(225) NOT NULL,
  `gender_anggota` enum('Laki Laki','Perempuan') NOT NULL,
  `alamat_anggota` text NOT NULL,
  `no_telp_anggota` varchar(15) NOT NULL,
  `username` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `nama_anggota`, `gender_anggota`, `alamat_anggota`, `no_telp_anggota`, `username`, `password`) VALUES
(101, 'Boni', 'Laki Laki', 'Jl. Melati No 13', '089782451250', 'anggota', '123'),
(102, 'Acel', 'Perempuan', 'Jl. Mawar No 1', '081254967851', 'sd', 'fsd');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `judul_buku` varchar(225) NOT NULL,
  `penulis` varchar(225) NOT NULL,
  `stok_buku` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `judul_buku`, `penulis`, `stok_buku`) VALUES
(0, 'Senja', 'Mentari', 10),
(3, 'The Great Gatsby', 'F. Scott Fitzgerald', 10),
(4, 'To Kill a Mockingbird', 'Harper Lee', 8),
(5, '1984', 'George Orwell', 15),
(6, 'Pride and Prejudice', 'Jane Austen', 12),
(7, 'The Catcher in the Rye', 'J.D. Salinger', 7),
(8, 'Animal Farm', 'George Orwell', 20),
(9, 'The Lord of the Rings', 'J.R.R. Tolkien', 18),
(10, 'The Hobbit', 'J.R.R. Tolkien', 25),
(11, 'Harry Potter and the Philosopher\'s Stone', 'J.K. Rowling', 14),
(12, 'Jane Eyre', 'Charlotte Brontë', 9),
(13, 'Wuthering Heights', 'Emily Brontë', 11),
(14, 'Brave New World', 'Aldous Huxley', 17),
(15, 'The Chronicles of Narnia', 'C.S. Lewis', 22),
(16, 'The Grapes of Wrath', 'John Steinbeck', 16),
(17, 'Moby-Dick', 'Herman Melville', 13),
(18, 'The Picture of Dorian Gray', 'Oscar Wilde', 19),
(19, 'Frankenstein', 'Mary Shelley', 21),
(20, 'Dracula', 'Bram Stoker', 26),
(21, 'The Adventures of Huckleberry Finn', 'Mark Twain', 23),
(22, 'The War of the Worlds', 'H.G. Wells', 20),
(23, 'Alice\'s Adventures in Wonderland', 'Lewis Carroll', 18),
(24, 'Gulliver\'s Travels', 'Jonathan Swift', 25),
(25, 'Don Quixote', 'Miguel de Cervantes', 14),
(26, 'Crime and Punishment', 'Fyodor Dostoevsky', 9),
(27, 'The Odyssey', 'Homer', 11);

-- --------------------------------------------------------

--
-- Table structure for table `denda`
--

CREATE TABLE `denda` (
  `id_transaksi_pengembalian` int(11) NOT NULL,
  `lama_keterlambatan` int(11) NOT NULL,
  `tarif_denda` int(11) NOT NULL,
  `total_denda` int(11) NOT NULL,
  `status_pembayaran` enum('Sudah','Belum') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `denda`
--

INSERT INTO `denda` (`id_transaksi_pengembalian`, `lama_keterlambatan`, `tarif_denda`, `total_denda`, `status_pembayaran`) VALUES
(3, 20, 500, 2000000, 'Belum'),
(4, 20, 30000, 20000, 'Belum'),
(5, 20, 100000, 2000000, 'Belum'),
(6, 17, 200000, 3400000, 'Sudah'),
(7, 17, 20000, 340000, 'Belum'),
(8, 17, 2000000, 34000000, 'Belum'),
(9, 17, 20000, 340000, 'Belum'),
(10, 24, 1000000, 24000000, 'Belum');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_pustakawan` int(11) NOT NULL,
  `nama_pustakawan` varchar(225) NOT NULL,
  `gender_pustakawan` enum('Laki Laki','Perempuan') NOT NULL,
  `username` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_pustakawan`, `nama_pustakawan`, `gender_pustakawan`, `username`, `password`) VALUES
(1, 'admin loh', 'Laki Laki', 'admin', '123');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_peminjaman`
--

CREATE TABLE `transaksi_peminjaman` (
  `id_transaksi_peminjaman` int(11) NOT NULL,
  `tgl_peminjaman` date NOT NULL,
  `tanggal_jatuh_tempo` date NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `id_pustakawan` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_peminjaman`
--

INSERT INTO `transaksi_peminjaman` (`id_transaksi_peminjaman`, `tgl_peminjaman`, `tanggal_jatuh_tempo`, `id_anggota`, `id_buku`, `id_pustakawan`, `qty`) VALUES
(1, '2024-06-08', '2024-06-10', 101, 0, 1, 2),
(3, '2024-06-08', '2024-06-09', 101, 0, 1, 2),
(4, '2024-06-08', '2024-06-09', 101, 0, 1, 3),
(5, '2024-06-08', '2024-06-13', 101, 0, 1, 3),
(6, '2024-06-08', '2024-06-13', 101, 0, 1, 3),
(7, '2024-06-08', '2024-06-13', 102, 0, 1, 3),
(8, '2024-06-08', '2024-06-13', 102, 0, 1, 3),
(9, '2024-06-08', '2024-06-10', 102, 0, 1, 3),
(10, '2024-06-08', '2024-06-14', 102, 0, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_pengembalian`
--

CREATE TABLE `transaksi_pengembalian` (
  `id_transaksi_pengembalian` int(11) NOT NULL,
  `id_transaksi_peminjaman` int(11) NOT NULL,
  `tgl_dikembalikan` date NOT NULL,
  `id_pustakawan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_pengembalian`
--

INSERT INTO `transaksi_pengembalian` (`id_transaksi_pengembalian`, `id_transaksi_peminjaman`, `tgl_dikembalikan`, `id_pustakawan`) VALUES
(2, 3, '2024-06-29', 1),
(3, 4, '2024-06-29', 1),
(4, 4, '2024-06-29', 1),
(5, 4, '2024-06-29', 1),
(6, 5, '2024-06-30', 1),
(7, 6, '2024-06-30', 1),
(8, 7, '2024-06-30', 1),
(9, 8, '2024-06-30', 1),
(10, 9, '2024-06-30', 1),
(11, 10, '2024-06-11', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `denda`
--
ALTER TABLE `denda`
  ADD PRIMARY KEY (`id_transaksi_pengembalian`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_pustakawan`);

--
-- Indexes for table `transaksi_peminjaman`
--
ALTER TABLE `transaksi_peminjaman`
  ADD PRIMARY KEY (`id_transaksi_peminjaman`),
  ADD KEY `id_pustakawan` (`id_pustakawan`),
  ADD KEY `id_buku` (`id_buku`),
  ADD KEY `id_anggota` (`id_anggota`);

--
-- Indexes for table `transaksi_pengembalian`
--
ALTER TABLE `transaksi_pengembalian`
  ADD PRIMARY KEY (`id_transaksi_pengembalian`),
  ADD KEY `id_transaksi_peminjaman` (`id_transaksi_peminjaman`),
  ADD KEY `id_pustakawan` (`id_pustakawan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `denda`
--
ALTER TABLE `denda`
  MODIFY `id_transaksi_pengembalian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_pustakawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaksi_peminjaman`
--
ALTER TABLE `transaksi_peminjaman`
  MODIFY `id_transaksi_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `transaksi_pengembalian`
--
ALTER TABLE `transaksi_pengembalian`
  MODIFY `id_transaksi_pengembalian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `denda`
--
ALTER TABLE `denda`
  ADD CONSTRAINT `denda_ibfk_1` FOREIGN KEY (`id_transaksi_pengembalian`) REFERENCES `transaksi_pengembalian` (`id_transaksi_pengembalian`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi_peminjaman`
--
ALTER TABLE `transaksi_peminjaman`
  ADD CONSTRAINT `transaksi_peminjaman_ibfk_2` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_peminjaman_ibfk_3` FOREIGN KEY (`id_pustakawan`) REFERENCES `petugas` (`id_pustakawan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_peminjaman_ibfk_4` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi_pengembalian`
--
ALTER TABLE `transaksi_pengembalian`
  ADD CONSTRAINT `transaksi_pengembalian_ibfk_1` FOREIGN KEY (`id_pustakawan`) REFERENCES `petugas` (`id_pustakawan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_pengembalian_ibfk_2` FOREIGN KEY (`id_transaksi_peminjaman`) REFERENCES `transaksi_peminjaman` (`id_transaksi_peminjaman`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
