-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 31, 2018 at 08:34 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

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
-- Table structure for table `adreselivrare`
--

CREATE TABLE `adreselivrare` (
  `id` int(11) NOT NULL,
  `clientID` int(11) NOT NULL,
  `numeDestinatar` varchar(20) COLLATE utf8_romanian_ci NOT NULL,
  `persoanaContact` varchar(20) COLLATE utf8_romanian_ci DEFAULT NULL,
  `telefon` varchar(20) COLLATE utf8_romanian_ci NOT NULL,
  `adresa` varchar(40) COLLATE utf8_romanian_ci NOT NULL,
  `oras` varchar(20) COLLATE utf8_romanian_ci NOT NULL,
  `judet` varchar(20) COLLATE utf8_romanian_ci NOT NULL,
  `codPostal` varchar(10) COLLATE utf8_romanian_ci NOT NULL,
  `def` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_romanian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) COLLATE utf8_romanian_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_romanian_ci;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1515605674),
('m180110_164044_initial', 1515605678),
('m180111_131328_tabelProduse', 1515676879),
('m180111_132521_adminProduse', 1515678241),
('m180731_181658_createTemplatesTable', 1533062026);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `clientID` int(11) NOT NULL,
  `workerID` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `dataPlasat` date NOT NULL,
  `pretTotal` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_romanian_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `clientID`, `workerID`, `status`, `dataPlasat`, `pretTotal`) VALUES
(1, 2, 3, 4, '2018-01-12', 875),
(2, 2, 3, 3, '2018-03-01', 0),
(3, 1, NULL, 1, '2018-07-31', 0);

-- --------------------------------------------------------

--
-- Table structure for table `produse`
--

CREATE TABLE `produse` (
  `id` int(11) NOT NULL,
  `comandaID` int(11) NOT NULL,
  `descriere` text COLLATE utf8_romanian_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_romanian_ci;

--
-- Dumping data for table `produse`
--

INSERT INTO `produse` (`id`, `comandaID`, `descriere`) VALUES
(13, 1, '{\"replici\":[{\"id\":\"3\",\"bucati\":1,\"$$hashKey\":\"object:360\"},{\"id\":\"1\",\"bucati\":1,\"$$hashKey\":\"object:362\"}],\"produs\":\"album\",\"idComanda\":1,\"nrMontaje\":20,\"albumSelectat\":\"15\",\"designColajeSel\":\"1\",\"copertaBuretataSel\":\"1\",\"codCopFata\":\"1\",\"codCopSpate\":\"1\",\"codCopCotor\":\"1\",\"bucCopertaSel\":\"1\",\"coltareSel\":\"2\",\"cutieCartonSel\":\"2\",\"faceOffSel\":\"7\",\"copertaFataSel\":\"4\",\"lipireSel\":\"1\",\"laminareSel\":\"1\",\"tipCanvasSel\":\"1\",\"pozitiePaspartuCoperta\":\"1\",\"dimensiunePaspartuSel\":\"1\",\"codRamaPaspartuSel\":\"1\",\"pozitiePlexiglasCoperta\":\"1\",\"tipInscriptionareSel\":\"2\",\"optiuniInscriptionareFata\":\"2\",\"fontTextCopertaFata\":\"1\",\"textCopertaFata\":\"Ana are mere Fata\",\"pozitieTextCopertaFata\":\"1\",\"optiuniInscriptionareSpate\":\"2\",\"fontTextCopertaSpate\":\"1\",\"textCopertaSpate\":\"Ana are mere pe spate\",\"pozitieTextCopertaSpate\":\"1\",\"linkFisiere\":\"Linkul cu fisierele\",\"observatii\":\"Observatiile mele cele faine\",\"pretTotal\":495,\"cutieLux\":{\"da\":\"1\",\"coltare\":\"2\",\"coperta\":\"3\",\"dimensiuniplexiglas\":\"1\",\"inscriptionare\":\"2\",\"text\":\"Ana are mere pe cutie\",\"font\":\"1\",\"pozitieText\":\"1\",\"panglica\":\"4\",\"materialcadru\":\"1\"}}'),
(15, 1, '{\"produs\":\"mapadvd\",\"observatii\":\"Niciuna\",\"idComanda\":1,\"tip\":\"Premium\",\"premium\":{\"nrdiscuri\":\"3\",\"magnet\":\"2\"},\"clasic\":{\"nrdiscuri\":\"1\",\"laminare\":\"1\"},\"ambele\":{\"nrbucati\":3,\"coperta\":\"3\",\"dimensiunipaspartu\":\"3\",\"inscriptionare\":\"2\",\"text\":\"\",\"font\":\"5\",\"pozitieText\":\"4\",\"copertaburetata\":\"2\",\"coltare\":\"2\"},\"pretTotal\":270,\"text\":\"Ana are mere pe passpartu\"}'),
(16, 1, '{\"produs\":\"mapadvd\",\"observatii\":\"Ana nu mai are mere\",\"idComanda\":1,\"tip\":\"Clasic\",\"premium\":{\"nrdiscuri\":\"1\",\"magnet\":\"1\"},\"clasic\":{\"nrdiscuri\":\"6\",\"laminare\":\"2\"},\"ambele\":{\"nrbucati\":2,\"coperta\":\"3\",\"dimensiunipaspartu\":\"3\",\"inscriptionare\":\"2\",\"text\":\"\",\"font\":\"6\",\"pozitieText\":\"4\",\"copertaburetata\":\"2\",\"coltare\":\"2\"},\"pretTotal\":110,\"text\":\"Mircea Inscriptionel Dezimbracatul\"}');

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `id` int(11) NOT NULL,
  `denumire` varchar(20) COLLATE utf8_romanian_ci NOT NULL,
  `userType` int(11) NOT NULL,
  `def` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_romanian_ci;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `denumire`, `userType`, `def`) VALUES
(1, '[in plasare]', 0, 1),
(2, 'Plasat', 0, 0),
(3, 'Preluat', 1, 0),
(4, 'In lucru', 1, 0),
(5, 'Livrat', 1, 0),
(6, 'Anulat', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE `templates` (
  `id` int(11) NOT NULL,
  `clientID` int(11) NOT NULL,
  `descriere` varchar(30) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `userType` int(11) NOT NULL DEFAULT '2',
  `username` varchar(20) COLLATE utf8_romanian_ci NOT NULL,
  `email` varchar(30) COLLATE utf8_romanian_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_romanian_ci NOT NULL,
  `authKey` varchar(60) COLLATE utf8_romanian_ci NOT NULL,
  `numeComplet` varchar(30) COLLATE utf8_romanian_ci NOT NULL,
  `numeFirma` varchar(30) COLLATE utf8_romanian_ci NOT NULL,
  `adresaFacturare` varchar(100) COLLATE utf8_romanian_ci NOT NULL,
  `oras` varchar(40) COLLATE utf8_romanian_ci NOT NULL,
  `judet` varchar(30) COLLATE utf8_romanian_ci NOT NULL,
  `CUI` varchar(20) COLLATE utf8_romanian_ci NOT NULL,
  `nrRegCom` varchar(20) COLLATE utf8_romanian_ci NOT NULL,
  `banca` varchar(100) COLLATE utf8_romanian_ci NOT NULL,
  `contBancar` varchar(100) COLLATE utf8_romanian_ci NOT NULL,
  `telefon` varchar(20) COLLATE utf8_romanian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_romanian_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `userType`, `username`, `email`, `password`, `authKey`, `numeComplet`, `numeFirma`, `adresaFacturare`, `oras`, `judet`, `CUI`, `nrRegCom`, `banca`, `contBancar`, `telefon`) VALUES
(1, 0, 'admin', 'admin@admin', '$2y$13$16ORCJnZhH/HDV2F/ZKtM.dCH.o46.0wLNEcQfl1ItuCn/oLSJpLu', '$2y$13$a8Q/naGR3muLQcMuN9wrc.ISd2pFCVTVlRwnXALsPoGnvAdQ0U1Iy', 'Administratorul cel Tare', 'admin', 'admin', 'admin', 'admin', 'admin', 'admin', 'admin', 'admin', 'admin'),
(2, 2, 'client', 'client@client', '$2y$13$9vQJrEAPIex8Zav.750mBO30OPHrDNHpu4zpF0PhHXRWm3wxWQwwi', '$2y$13$OnTfzBlKrExsm7ye.p/sxe3FGmuqHY.3RgarYWTwOln4cnYtkY1zS', 'Clientul cel tare', 'admin', 'admin', 'admin', 'admin', 'admin', 'admin', 'admin', 'admin', 'admin'),
(3, 1, 'worker', 'worker@worker.com', '$2y$13$deFdfBu9pPFiBjLYJmrgjO5p7l83HGxNoW3xVNeM0FM/pt4tsvl5K', '$2y$13$2esHiIDffNH7Z8RgW/lhR.eitHg/3y1Kt7cC1m1VUWqzvokofnqLq', 'worker', 'worker', 'worker', 'worker', 'worker', 'worker', 'worker', 'worker', 'worker', 'worker');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adreselivrare`
--
ALTER TABLE `adreselivrare`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-adreselivrare-clientID` (`clientID`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-orders-clientID` (`clientID`),
  ADD KEY `idx-orders-workerID` (`workerID`),
  ADD KEY `idx-orders-statusID` (`status`);

--
-- Indexes for table `produse`
--
ALTER TABLE `produse`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-produse-comandaID` (`comandaID`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx-statuses-clientID` (`denumire`);

--
-- Indexes for table `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-templates-clientID` (`clientID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx-users-email` (`email`),
  ADD UNIQUE KEY `idx-users-authKey` (`authKey`),
  ADD UNIQUE KEY `idx-users-username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adreselivrare`
--
ALTER TABLE `adreselivrare`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `produse`
--
ALTER TABLE `produse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `templates`
--
ALTER TABLE `templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adreselivrare`
--
ALTER TABLE `adreselivrare`
  ADD CONSTRAINT `fk-adreselivrare-userID` FOREIGN KEY (`clientID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk-orders-clientID` FOREIGN KEY (`clientID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk-orders-statusID` FOREIGN KEY (`status`) REFERENCES `statuses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk-orders-workerID` FOREIGN KEY (`workerID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `produse`
--
ALTER TABLE `produse`
  ADD CONSTRAINT `fk-produse-comandaID` FOREIGN KEY (`comandaID`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `templates`
--
ALTER TABLE `templates`
  ADD CONSTRAINT `fk-templates-clientID` FOREIGN KEY (`clientID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
