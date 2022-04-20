-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 20, 2022 at 03:56 PM
-- Server version: 8.0.27
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exploreserbia`
--
CREATE DATABASE IF NOT EXISTS `exploreserbia` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `exploreserbia`;

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

DROP TABLE IF EXISTS `korisnik`;
CREATE TABLE IF NOT EXISTS `korisnik` (
  `korisnickoIme` varchar(20) NOT NULL,
  `ime` varchar(20) NOT NULL,
  `prezime` varchar(20) NOT NULL,
  `pol` varchar(6) NOT NULL,
  `email` varchar(320) NOT NULL,
  `lozinka` varchar(40) NOT NULL,
  `slikaURL` varchar(2000) DEFAULT NULL,
  `tip` int NOT NULL,
  `lokacija` int NOT NULL,
  PRIMARY KEY (`korisnickoIme`),
  KEY `tip` (`tip`),
  KEY `lokacija` (`lokacija`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `korisniktip`
--

DROP TABLE IF EXISTS `korisniktip`;
CREATE TABLE IF NOT EXISTS `korisniktip` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tip` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lokacija`
--

DROP TABLE IF EXISTS `lokacija`;
CREATE TABLE IF NOT EXISTS `lokacija` (
  `id` int NOT NULL AUTO_INCREMENT,
  `naziv` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `objava`
--

DROP TABLE IF EXISTS `objava`;
CREATE TABLE IF NOT EXISTS `objava` (
  `id` int NOT NULL AUTO_INCREMENT,
  `naslov` varchar(120) NOT NULL,
  `tekst` longtext NOT NULL,
  `brojOcena` int NOT NULL,
  `sumaOcena` int NOT NULL,
  `odobrena` tinyint(1) NOT NULL,
  `vremeKreiranja` date NOT NULL,
  `autor` varchar(20) DEFAULT NULL,
  `lokacija` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `autor` (`autor`),
  KEY `lokacija` (`lokacija`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `objavatag`
--

DROP TABLE IF EXISTS `objavatag`;
CREATE TABLE IF NOT EXISTS `objavatag` (
  `objavaID` int NOT NULL,
  `tagID` int NOT NULL,
  PRIMARY KEY (`objavaID`,`tagID`),
  KEY `tagID` (`tagID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reklama`
--

DROP TABLE IF EXISTS `reklama`;
CREATE TABLE IF NOT EXISTS `reklama` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nazivRadnje` varchar(60) NOT NULL,
  `opis` varchar(300) DEFAULT NULL,
  `slikaURL` varchar(2000) DEFAULT NULL,
  `adresa` varchar(120) NOT NULL,
  `telefon` varchar(20) DEFAULT NULL,
  `email` varchar(320) DEFAULT NULL,
  `sajtURL` varchar(2000) DEFAULT NULL,
  `vremeKreiranja` date NOT NULL,
  `odobrena` tinyint(1) NOT NULL,
  `autor` varchar(20) DEFAULT NULL,
  `lokacija` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `autor` (`autor`),
  KEY `lokacija` (`lokacija`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
CREATE TABLE IF NOT EXISTS `tag` (
  `id` int NOT NULL AUTO_INCREMENT,
  `naziv` varchar(120) NOT NULL,
  `odobren` tinyint(1) NOT NULL,
  `kategorija` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `kategorija` (`kategorija`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tagkategorija`
--

DROP TABLE IF EXISTS `tagkategorija`;
CREATE TABLE IF NOT EXISTS `tagkategorija` (
  `id` int NOT NULL AUTO_INCREMENT,
  `naziv` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD CONSTRAINT `lokacija` FOREIGN KEY (`lokacija`) REFERENCES `lokacija` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tip` FOREIGN KEY (`tip`) REFERENCES `korisniktip` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `objava`
--
ALTER TABLE `objava`
  ADD CONSTRAINT `autorO` FOREIGN KEY (`autor`) REFERENCES `korisnik` (`korisnickoIme`) ON DELETE SET NULL,
  ADD CONSTRAINT `lokacijaO` FOREIGN KEY (`lokacija`) REFERENCES `lokacija` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `objavatag`
--
ALTER TABLE `objavatag`
  ADD CONSTRAINT `objavaID` FOREIGN KEY (`objavaID`) REFERENCES `objava` (`id`),
  ADD CONSTRAINT `tagID` FOREIGN KEY (`tagID`) REFERENCES `tag` (`id`);

--
-- Constraints for table `reklama`
--
ALTER TABLE `reklama`
  ADD CONSTRAINT `autor` FOREIGN KEY (`autor`) REFERENCES `korisnik` (`korisnickoIme`) ON DELETE SET NULL,
  ADD CONSTRAINT `lokacijaR` FOREIGN KEY (`lokacija`) REFERENCES `lokacija` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tag`
--
ALTER TABLE `tag`
  ADD CONSTRAINT `kategorija` FOREIGN KEY (`kategorija`) REFERENCES `tagkategorija` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
