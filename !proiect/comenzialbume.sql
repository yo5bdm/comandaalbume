-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 05 Ian 2018 la 14:27
-- Versiune server: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `comenzialbume`
--

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `userType` int(11) NOT NULL DEFAULT '2',
  `username` char(20) COLLATE utf8_romanian_ci NOT NULL,
  `email` char(30) COLLATE utf8_romanian_ci NOT NULL,
  `password` char(60) COLLATE utf8_romanian_ci NOT NULL,
  `authKey` char(60) COLLATE utf8_romanian_ci NOT NULL,
  `numeComplet` char(30) COLLATE utf8_romanian_ci NOT NULL,
  `numeFirma` char(30) COLLATE utf8_romanian_ci NOT NULL,
  `adresaFacturare` varchar(100) COLLATE utf8_romanian_ci NOT NULL,
  `oras` char(40) COLLATE utf8_romanian_ci NOT NULL,
  `judet` char(30) COLLATE utf8_romanian_ci NOT NULL,
  `CUI` char(20) COLLATE utf8_romanian_ci NOT NULL,
  `nrRegCom` char(20) COLLATE utf8_romanian_ci NOT NULL,
  `banca` varchar(100) COLLATE utf8_romanian_ci NOT NULL,
  `contBancar` varchar(100) COLLATE utf8_romanian_ci NOT NULL,
  `telefon` char(20) COLLATE utf8_romanian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_romanian_ci;

--
-- Salvarea datelor din tabel `users`
--

INSERT INTO `users` (`id`, `userType`, `username`, `email`, `password`, `authKey`, `numeComplet`, `numeFirma`, `adresaFacturare`, `oras`, `judet`, `CUI`, `nrRegCom`, `banca`, `contBancar`, `telefon`) VALUES
(4, 2, 'admin', 'yo5bdm@gmail.com', '$2y$13$L8ym2W1E.WGh9VxAMBSd6OYOa4BzSfiA7DO9byX5RLJEwsyp/g/mG', '$2y$13$v3pGfQFaaSKUa71FCLkGz.qdt3d6hLY/fCC5U3qmH9tNwxd7ty7Rm', 'Erdei Rudolf Eduard', 'Erdei Rudolf Eduard I.I.', 'Victor Babes 19/21', 'Baia Mare', 'Maramures', '28857878', 'F28/848/2012', 'Banca Transilvania Sucursala Baia Mare', 'RO68 RZBR KNZH HGTD 2552 09XX', '0744401352');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `authKey` (`authKey`),
  ADD UNIQUE KEY `uniquser` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
