-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 31, 2025 at 06:12 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `basta`
--

-- --------------------------------------------------------

--
-- Table structure for table `basta`
--

DROP TABLE IF EXISTS `basta`;
CREATE TABLE IF NOT EXISTS `basta` (
  `basta_id` int NOT NULL AUTO_INCREMENT,
  `korisnik_id` int NOT NULL,
  `biljka_id` int NOT NULL,
  `datum_dodavanja` datetime NOT NULL,
  `nadimak` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lokacija` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`basta_id`),
  KEY `korisnik_id` (`korisnik_id`,`biljka_id`),
  KEY `biljka_id` (`biljka_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `basta`
--

INSERT INTO `basta` (`basta_id`, `korisnik_id`, `biljka_id`, `datum_dodavanja`, `nadimak`, `lokacija`) VALUES
(5, 3, 4, '2025-07-31 16:00:22', 'Gojko', 'moja soba');

-- --------------------------------------------------------

--
-- Table structure for table `biljke`
--

DROP TABLE IF EXISTS `biljke`;
CREATE TABLE IF NOT EXISTS `biljke` (
  `biljka_id` int NOT NULL AUTO_INCREMENT,
  `naziv` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `latinski_naziv` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tip` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slika` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `zalivanje_dani` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kolicina_vode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `djubrenje_dani` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tip_djubriva` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `osvetljenje` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`biljka_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `biljke`
--

INSERT INTO `biljke` (`biljka_id`, `naziv`, `latinski_naziv`, `tip`, `slika`, `zalivanje_dani`, `kolicina_vode`, `djubrenje_dani`, `tip_djubriva`, `osvetljenje`) VALUES
(1, 'Zamija', 'Zamioculcas zamiifolia', 'Sobna biljka', 'zamija.jpg', 'Na svakih 10–14 dana, kada se gornjih 3–5 cm zemlje potpuno osuši. Zimi na svake 3 nedelje ili duže', 'Oko 100–200 ml vode po zalivanju za manju saksiju (15–20 cm prečnika)', 'Jednom mesečno tokom proleća i leta', 'Tečno đubrivo za sobne biljke ili đubrivo sa uravnoteženim odnosom NPK (npr. 10-10-10 ili 20-20-20).', 'Srednje do slabo indirektno svetlo (može podneti i senku)'),
(2, 'Aloa vera', 'Aloe vera', 'Sobna biljka', 'aloa_vera.jpg', 'Na 2–3 nedelje, kada je zemlja potpuno suva do dna saksije. Zimi ređe, čak i samo jednom mesečno', 'Prosečno: 100 ml za manju biljku, do 200 ml za veću', '1–2 puta mesečno tokom proleća i leta, uvek posle zalivanja, da se ne ošteti koren', 'Tečno đubrivo za sukulente ili kaktuse. Niska koncentracija azota (npr. NPK 10-40-10 ili 15-30-15)', 'Jako indirektno svetlo ili direktno jutarnje sunce\r\n\r\n'),
(3, 'Sobni ljiljan', 'Lilium candidum', 'Sobna biljka', 'ljiljana.jpg', 'Zemlja treba da bude stalno blago vlažna, ali ne previše mokra. U proleće i leto zalivati otprilike 2 puta nedeljno, zimi ređe', '300-500 ml 2 puta nedeljno tokom proleća i leta. Zimi 150-200 ml jednom u 10-14 dana', 'Đubriti jednom mesečno tokom vegetacije (proleće i leto), oko 100 ml rastvora po biljci', 'Tečno đubrivo za cvetnice (npr. NPK 10-10-10) razblaženo prema uputstvu proizvođača', 'Svetlo mesto sa indirektnim svetlom, ne voli direktno jako sunce'),
(4, 'Fikus', 'Ficus elastica', 'Sobna biljka', 'fikus.jpg', 'Zalivati kad se gornjih 3-5 cm zemlje osuši, otprilike jednom nedeljno. Ne voli stajaću vodu', 'Oko 250-400 ml', 'Đubriti jednom mesečno tokom prolećnog i letnjeg perioda', 'Univerzalno tečno đubrivo, razblaženo po uputstvu. Jednom mesečno tokom prolećnog i letnjeg perioda, oko 100 ml rastvora po biljci.', 'Srednje do jako indirektno svetlo, može podneti i senku'),
(5, 'Lavanda', 'Lavandula angustifolia', 'Biljka za baštu (ali može i u saksiji na terasi)', 'lavanda.jpg', 'Kada je zemlja potpuno suva, jednom u dve nedelje tokom leta, zimi ređe', '150-250 ml tokom leta. Zimi gotovo da se ne zaliva, osim ako je ekstremno suvo.', 'Đubriti jednom u sezoni (proleće)', 'Koristi blago đubrivo za mediteranske biljke ili kaktuse, može i đubrivo sa manjim sadržajem azota.', 'Jako sunce, idealno direktno osvetljenje 6+ sati dnevno\r\n\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `djubrenje`
--

DROP TABLE IF EXISTS `djubrenje`;
CREATE TABLE IF NOT EXISTS `djubrenje` (
  `djubrenje_id` int NOT NULL AUTO_INCREMENT,
  `basta_id` int NOT NULL,
  `datum` datetime NOT NULL,
  `tip` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kolicina` int NOT NULL,
  PRIMARY KEY (`djubrenje_id`),
  KEY `basta_id` (`basta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

DROP TABLE IF EXISTS `korisnik`;
CREATE TABLE IF NOT EXISTS `korisnik` (
  `korisnik_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ime` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prezime` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`korisnik_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`korisnik_id`, `username`, `ime`, `prezime`, `password`, `email`) VALUES
(3, 'marko', 'Marko', 'Prastalo', '$2y$10$0KH9JLP.iSk5ExDEat/7XO844ShJ/ElA6S8c0UC54fDkhpfvp/BKa', 'admin@gmail.com'),
(4, 'pera', 'Petar', 'Petrovic', '$2y$10$LzrsyZuFBz2ZVsUN4uXJEOk22QWDKhD/lnXAEo6DqYJNFsc3SPMke', 'pera@gmail.com'),
(6, 'mika', 'Milan', 'Milanovic', '$2y$10$tnMbETr3BJQbm/pg3JCovuYGoxzg.Q1ZxTX7DcYUXhjQLW.os5lv.', 'mika@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `zalivanje`
--

DROP TABLE IF EXISTS `zalivanje`;
CREATE TABLE IF NOT EXISTS `zalivanje` (
  `zalivanje_id` int NOT NULL AUTO_INCREMENT,
  `basta_id` int NOT NULL,
  `datum` datetime NOT NULL,
  `kolicina` int NOT NULL,
  PRIMARY KEY (`zalivanje_id`),
  KEY `basta_id` (`basta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `zdravlje`
--

DROP TABLE IF EXISTS `zdravlje`;
CREATE TABLE IF NOT EXISTS `zdravlje` (
  `zdravlje_id` int NOT NULL AUTO_INCREMENT,
  `basta_id` int NOT NULL,
  `datum` datetime NOT NULL,
  `simptomi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dijagnoza` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `akcije` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`zdravlje_id`),
  KEY `basta_id` (`basta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `basta`
--
ALTER TABLE `basta`
  ADD CONSTRAINT `basta_ibfk_1` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnik` (`korisnik_id`),
  ADD CONSTRAINT `basta_ibfk_2` FOREIGN KEY (`biljka_id`) REFERENCES `biljke` (`biljka_id`);

--
-- Constraints for table `djubrenje`
--
ALTER TABLE `djubrenje`
  ADD CONSTRAINT `djubrenje_ibfk_1` FOREIGN KEY (`basta_id`) REFERENCES `basta` (`basta_id`);

--
-- Constraints for table `zalivanje`
--
ALTER TABLE `zalivanje`
  ADD CONSTRAINT `zalivanje_ibfk_1` FOREIGN KEY (`basta_id`) REFERENCES `basta` (`basta_id`);

--
-- Constraints for table `zdravlje`
--
ALTER TABLE `zdravlje`
  ADD CONSTRAINT `zdravlje_ibfk_1` FOREIGN KEY (`basta_id`) REFERENCES `basta` (`basta_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
