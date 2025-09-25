-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2025 at 08:01 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `salsacantik`
--

-- --------------------------------------------------------

--
-- Table structure for table `stok_buku`
--

CREATE TABLE `stok_buku` (
  `id_buku` int(11) NOT NULL,
  `judul_buku` varchar(100) DEFAULT NULL,
  `pengarang` varchar(100) DEFAULT NULL,
  `tahun_terbit` year(4) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stok_buku`
--

INSERT INTO `stok_buku` (`id_buku`, `judul_buku`, `pengarang`, `tahun_terbit`, `stok`) VALUES
(31, 'Laskar Pelangi', 'Andrea Hirata', '2009', 200),
(32, 'Bumi Manusia ', 'Pramoedya Ananta Toer ', '2008', 600),
(35, 'Negeri 5 menara', ' Ahmad Fuadi ', '2009', 200),
(36, 'Negeri 5 Menara', ' Ahmad Fuadi ', '2007', 17),
(37, 'Negeri 5 Menara', ' Ahmad Fuadi ', '2008', 7);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` enum('admin','staff','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `level`) VALUES
(1, 'admin', '12345', 'admin'),
(2, 'staff', '12345', 'staff'),
(3, 'user1', '12345', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `stok_buku`
--
ALTER TABLE `stok_buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `stok_buku`
--
ALTER TABLE `stok_buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
