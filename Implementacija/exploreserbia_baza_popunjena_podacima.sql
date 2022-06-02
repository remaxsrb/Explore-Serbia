-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 31, 2022 at 07:25 PM
-- Server version: 5.7.36
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
CREATE DATABASE IF NOT EXISTS `exploreserbia` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
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
  `lozinka` varchar(255) NOT NULL,
  `slikaURL` varchar(2000) DEFAULT NULL,
  `tip` int(11) NOT NULL,
  `lokacija` int(11) NOT NULL,
  PRIMARY KEY (`korisnickoIme`),
  KEY `tip` (`tip`),
  KEY `lokacija` (`lokacija`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`korisnickoIme`, `ime`, `prezime`, `pol`, `email`, `lozinka`, `slikaURL`, `tip`, `lokacija`) VALUES
('angie', 'Anđela', 'Janković', 'zensko', 'queenofsilver@gmail.com', '$2y$10$Y9IrrWNRXoMD84VXwZG7D.rjBO758mJV/iAtS3DCGM64FF8CkldXq', 'https://i.pinimg.com/736x/bb/82/86/bb82868fc648747713b4d14aaccb7327.jpg', 3, 36),
('bogdandj', 'Bogdan', 'Đorđević', 'musko', 'djordjevicb68@gmail.com', '$2y$10$zZM2xdOdKnZfQjKL/g1lmenF5TEpVSM8rcTLdAqQpEM0gzb0uiw4u', 'https://storage.needpix.com/rsynced_images/cartoon-1890438_1280.jpg', 3, 2),
('brankaM', 'Branka', 'Marković', 'zensko', 'brankica@gmail.com', '$2y$10$jU/VDYdEqmrI7wGXGQ8l0OhFTcuo1CWnrHPHdYG62hhIbIdD.seIS', 'https://previews.123rf.com/images/jemastock/jemastock1712/jemastock171212588/92283189-beautiful-woman-profile-cartoon-icon-vector-illustration-graphic-design.jpg', 3, 44),
('brankopanda', 'Branko', 'Mitić', 'musko', 'brankobane@gmail.com', '$2y$10$/JyAnS3u43NEsROHB1XuueyCq23uF99BvGaSdJ9Fd0clCDwiypq9.', 'https://fiverr-res.cloudinary.com/images/t_main1,q_auto,f_auto,q_auto,f_auto/gigs/107029848/original/2abfa483e6c2a0bccf23007a21df0253ea3070bd/cartoon-profile-picture-illustration.png', 3, 144),
('djordjepetrovic', 'Đorđe', 'Petrović', 'musko', 'djordje1212@gmail.com', '$2y$10$//VYXEISjgW.VNprSdP0qOQQ2c1yNe8zx4vQTstm74DMGCxY1UO1m', NULL, 3, 100),
('dusanm', 'Dušan', 'Momić', 'musko', 'duskom@gmail.com', '$2y$10$N0PPCCI967m1H9fX6CQDeOy0vJaLXxVhjZQZI8yNd3UnognyaOq7C', 'https://i.pinimg.com/736x/ba/d7/86/bad786dfe4f227555be6fa2484b0b9a3.jpg', 3, 80),
('lazar', 'Lazar', 'Lazarevic', 'musko', 'lazar@gmail.com', '$2y$10$t7OT5xiQ2nY2jpMs/Z2cqu10r7/BM5EtfvUop9NdChSA2hzAbe792', 'https://thumbs.dreamstime.com/b/big-sea-turtle-watercolor-painting-104737980.jpg', 2, 5),
('markopetrovic', 'Marko', 'Petrović', 'musko', 'mare312@gmail.com', '$2y$10$r5OcMC7nsiu1JpTpR78IHuta33ytaHr/mucYECSVEkQxS6WCAqOJy', 'https://c8.alamy.com/zooms/9/9d75d3fcb40441a39876692eed1f0c21/tc2fpe.jpg', 3, 100),
('milos', 'Milos', 'Brkovic', 'musko', 'milos@gmail.com', '$2y$10$//VYXEISjgW.VNprSdP0qOQQ2c1yNe8zx4vQTstm74DMGCxY1UO1m', 'https://thumbs.dreamstime.com/z/dog-avatar-25770385.jpg', 2, 144),
('mirko', 'Mirko', 'Mirkovic', 'musko', 'mirko@gmail.com', '$2y$10$w1vRxFayzGMvKRKDAzkkzOI3EqAR5Ph8YVA8fd5g.g5vFwCL8S1Ei', NULL, 2, 1),
('nikola', 'Nikola', 'Nikolic', 'musko', 'nikola@nikola.gmail.com', '$2y$10$RDfmc.xJOWmfjbL22AJgB.2aMLm0hoham/py2JD/qRaPpvyT0W/Su', 'https://thumbs.dreamstime.com/b/cat-snake-mouth-kitten-vector-illustration-cartoon-isolated-white-background-sitting-carpet-137112606.jpg', 2, 1),
('oliverM', 'Oliver', 'Mikic', 'musko', 'oliverM@gmail.com', '$2y$10$//VYXEISjgW.VNprSdP0qOQQ2c1yNe8zx4vQTstm74DMGCxY1UO1m', NULL, 1, 18),
('pavlovics', 'Stefan', 'Pavlović', 'musko', 'stefolino@gmail.com', '$2y$10$koKI/anSN3ceKJn30.uv0ujNiY5b5.63A9uv5aRQ5S9DlufMc8Oby', 'https://previews.123rf.com/images/jemastock/jemastock1706/jemastock170616048/80929474-illustrazione-vettoriale-illustrazione-maschile-personaggio-uomo-del-fumetto.jpg', 3, 38),
('pera', 'Pera', 'Peric', 'musko', 'pera@gmail.com', '$2y$10$dqyIF3Bhmw1p7yGtocwLzejvxiM52dHpsaNggFs7bA2BBYT8vsCo2', NULL, 1, 16),
('remax', 'Marko', 'Jovanovic', 'musko', 'remaxsrb@protonmail.com', '$2y$10$6G6hLQnwJoBU3GtvpAHFoeB5zRfalXT.hg2d0Xu1OHf2CGyDU5lIy', 'https://cdn.cloudflare.steamstatic.com/steamcommunity/public/images/avatars/40/402821bb7124754e80ddacac5545b8ce61ba71fb_full.jpg', 1, 16),
('sale1', 'Saša', 'Mitrović', 'musko', 'salemitrovic@gmail.com', '$2y$10$ZB506bmokdHk6DefNonvjuosLENN7lch87rzvB76YhOeUeAkJZMpK', 'https://cdn.dribbble.com/users/3180658/screenshots/14244858/dribbble-greaser_4x.png', 3, 16),
('stefan123', 'Stefan', 'Stefanovic', 'musko', 'default@yahoo.com', '$2y$10$//VYXEISjgW.VNprSdP0qOQQ2c1yNe8zx4vQTstm74DMGCxY1UO1m', NULL, 2, 1),
('vasilys', 'Petar', 'Vasiljević', 'musko', 'petarvasilj@gmail.com', '$2y$10$sFW6dmVnnVS89MEITyTkf.I9AIJjlw7HJyR13sMtacef8V.puPH8K', 'https://lh3.googleusercontent.com/_UDofjN0RB1ILBmnhlpRXATd9Rv1dmMrVMo-GMnaPSD2KwW1u5xVG8nvUrfQFYircjL8c85URIgNnzHA6EYjcmp5RqoTMSsypaNrNaNNnCP78u7aXNG6cfuEKyKk7Img2MR8cUM=s0', 3, 21);

-- --------------------------------------------------------

--
-- Table structure for table `korisniktip`
--

DROP TABLE IF EXISTS `korisniktip`;
CREATE TABLE IF NOT EXISTS `korisniktip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tip` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `korisniktip`
--

INSERT INTO `korisniktip` (`id`, `tip`) VALUES
(1, 'admin'),
(2, 'pisac'),
(3, 'zanatlija');

-- --------------------------------------------------------

--
-- Table structure for table `lokacija`
--

DROP TABLE IF EXISTS `lokacija`;
CREATE TABLE IF NOT EXISTS `lokacija` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=179 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lokacija`
--

INSERT INTO `lokacija` (`id`, `naziv`) VALUES
(1, 'Aleksandrovac'),
(2, 'Aleksinac'),
(3, 'Alibunar'),
(4, 'Apatin'),
(5, 'Aranđelovac'),
(6, 'Arilje'),
(7, 'Babušnica'),
(8, 'Bajina Bašta'),
(9, 'Batočina'),
(10, 'Bač'),
(11, 'Bačka Palanka'),
(12, 'Bačka Topola'),
(13, 'Bački Petrovac'),
(14, 'Bela Palanka'),
(15, 'Bela Crkva'),
(16, 'Beograd'),
(17, 'Beočin'),
(18, 'Bečej'),
(19, 'Blace'),
(20, 'Bogatić'),
(21, 'Bojnik'),
(22, 'Boljevac'),
(23, 'Bor'),
(24, 'Bosilegrad'),
(25, 'Brus'),
(26, 'Bujanovac'),
(27, 'Valjevo'),
(28, 'Varvarin'),
(29, 'Velika Plana'),
(30, 'Veliko Gradište'),
(31, 'Vladimirici'),
(32, 'Vladičin Han'),
(33, 'Vlasotnice'),
(34, 'Vranje'),
(35, 'Vrbas'),
(36, 'Vršac'),
(37, 'Vučitrn'),
(38, 'Gadžin Han'),
(39, 'Glogovac'),
(40, 'Gnjiljane'),
(41, 'Golubac'),
(42, 'Dragaš'),
(43, 'Gornji Milanovac'),
(44, 'Grocka'),
(45, 'Despotovac'),
(46, 'Dečani'),
(47, 'Dimitrovgrad'),
(48, 'Doljevac'),
(49, 'Donji Milanovac'),
(50, 'Đakovica'),
(51, 'Žabalj'),
(52, 'Žabari'),
(53, 'Žagubica'),
(54, 'Žitište'),
(55, 'Žitorađa'),
(56, 'Zaječar'),
(57, 'Zvečan'),
(58, 'Zrenjanin'),
(59, 'Zubin Potok'),
(60, 'Ivanjica'),
(61, 'Inđija'),
(62, 'Irig'),
(63, 'Istok'),
(64, 'Jagoina'),
(65, 'Kanjiža'),
(66, 'Kačanik'),
(67, 'Kikinda'),
(68, 'Kladovo'),
(69, 'Klina'),
(70, 'Knić'),
(71, 'Knjaževac'),
(72, 'Kovačica'),
(73, 'Kovin'),
(74, 'Kosjerić'),
(75, 'Kostolac'),
(76, 'Kosovo Polje'),
(77, 'Kosovska Kamenica'),
(78, 'Kosovska Mitrovica'),
(79, 'Koceljeva'),
(80, 'Kragujevac'),
(81, 'Kraljevo'),
(82, 'Krupanj'),
(83, 'Kruševac'),
(84, 'Kula'),
(85, 'Kuršumlija'),
(86, 'Kučevo'),
(87, 'Lazarevac'),
(88, 'Lajkovac'),
(89, 'Lapovo'),
(90, 'Lebane'),
(91, 'Leposavić'),
(92, 'Leskovac'),
(93, 'Lipljan'),
(94, 'Loznica'),
(95, 'Lučani'),
(96, 'Ljig'),
(97, 'Ljubovija'),
(98, 'Majdanpek'),
(99, 'Mali Zvornik'),
(100, 'Mali Iđoš'),
(101, 'Malo Crnice'),
(102, 'Medveđa'),
(103, 'Mediana'),
(104, 'Merošina'),
(105, 'Mionica'),
(106, 'Mladenovac'),
(107, 'Negotin'),
(108, 'Niš'),
(109, 'Niška Banja'),
(110, 'Nova Varoš'),
(111, 'Nova Crnja'),
(112, 'Novi Bečej'),
(113, 'Novi Kneževac'),
(114, 'Novi Pazar'),
(115, 'Novi Sad'),
(116, 'Novo Brdo'),
(117, 'Obilić'),
(118, 'Obrenovac'),
(119, 'Opovo'),
(120, 'Orahovac'),
(121, 'Osečina'),
(122, 'Odžaci'),
(123, 'Palilula'),
(124, 'Pantelej'),
(125, 'Pančevo'),
(126, 'Paraćin'),
(127, 'Petrovaradin'),
(128, 'Petrovac na Mlavi'),
(129, 'Peć'),
(130, 'Pećinci'),
(131, 'Pirot'),
(132, 'Priboj'),
(133, 'Prizren'),
(134, 'Priština'),
(135, 'Prokuplje'),
(136, 'Ražanj'),
(137, 'Rača'),
(138, 'Raška'),
(139, 'Rekovac'),
(140, 'Ruma'),
(141, 'Svilajnac'),
(142, 'Svrljig'),
(143, 'Sjenica'),
(144, 'Smederevo'),
(145, 'Smederevska Palanka'),
(146, 'Soko Banja'),
(147, 'Sombor'),
(148, 'Sopot'),
(149, 'Srbica'),
(150, 'Srbobran'),
(151, 'Sremska Mitrovica'),
(152, 'Sremski Karlovci'),
(153, 'Stara Pazova'),
(154, 'Stagari'),
(155, 'Subotica'),
(156, 'Suva Reka'),
(157, 'Surdulica'),
(158, 'Surčin'),
(159, 'Temerin'),
(160, 'Titel'),
(161, 'Topola'),
(162, 'Trgovište'),
(163, 'Trstenik'),
(164, 'Tutin'),
(165, 'Ćićevac'),
(166, 'Ćuprija'),
(167, 'Ub'),
(168, 'Užice'),
(169, 'Uroševac'),
(170, 'Crveni Krst - Niš'),
(171, 'Crna Trava'),
(172, 'Čajetina'),
(173, 'Čačak'),
(174, 'Čoka'),
(175, 'Šabac'),
(176, 'Šid'),
(177, 'Štimlje'),
(178, 'Štrpce');

-- --------------------------------------------------------

--
-- Table structure for table `objava`
--

DROP TABLE IF EXISTS `objava`;
CREATE TABLE IF NOT EXISTS `objava` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naslov` varchar(120) NOT NULL,
  `tekst` longtext NOT NULL,
  `brojOcena` int(11) NOT NULL,
  `sumaOcena` int(11) NOT NULL,
  `odobrena` tinyint(1) NOT NULL,
  `vremeKreiranja` date NOT NULL,
  `autor` varchar(20) DEFAULT NULL,
  `lokacija` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `autor` (`autor`),
  KEY `lokacija` (`lokacija`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `objava`
--

INSERT INTO `objava` (`id`, `naslov`, `tekst`, `brojOcena`, `sumaOcena`, `odobrena`, `vremeKreiranja`, `autor`, `lokacija`) VALUES
(1, 'Smederevska tvrdjava', 'Smederevska tvrđava je tvrđava u Smederevu koju je na ušću reke Jezave u Dunav u drugoj četvrtini 15. veka (od 1428. godine) podigao despot Srbije Đurađ Branković (1427—1456), po njoj nazvan Smederevac. Tvrđava je po svom tipu klasična vodena (opkoljena je Dunavom i Jezavom, a sa juga veštačkim šancem koji povezuje dve reke) ravničarsko utvrđenje što je čini jedinstvenom u srpskoj srednjovekovnoj arhitekturi, a za uzor prilikom gradnje uzet je Carigrad i njegovi bedemi.\r\n\r\n Prema svojoj površini od 10ha 41a 14m² (11,3272ha prema merenjima iz 1975. godine) bez spoljašnjeg bedema i kula odnosno 14.5ha sa njima, predstavlja jednu od najvećih tvrđava u Evropi i najveću tog tipa[traži se izvor]. Ima osnovu raznokrakog trougla (550m x 502m x 400m) u čijem je severnom temenu je smešten manji raznokraki trougao (75m x ?m x ?m) koji formira Mali grad, dok ostatak utvrđenja čini Veliki grad.\r\n[img]http://www.serbia.com/wp-content/uploads/2012/12/102-smederevo-fortress-smederevska-tvrdjava1.jpg[/img]', 12, 56, 1, '2022-05-17', 'milos', 144),
(2, 'Car Dusan Silni', 'Stefan Uroš IV Dušan Nemanjić[a] (oko 1308. ili u martu 1312 — Devol, 20. decembar 1355), poznatiji kao Dušan Silni, bio je pretposlednji srpski kralj iz dinastije Nemanjića. Imao je titulu kralja od 1331. do 1346. godine, a zatim je postao i prvi krunisani car srpske države,[b] kada ga je na Vaskrs 16. aprila 1346. godine krunisao prvi srpski patrijarh Joanikije II. Dušan je vladao nad novonastalim Srpskim carstvom više od 9 godina do svoje smrti 20. decembra 1355. godine. Car Dušan je opisan kao energičan vladar, jakog karaktera i temperamenta, zato se često u izvorima i literaturi javlja i pod imenom „Dušan Silni”.\r\n[img]https://www.kurir.rs/data/images/2018/04/16/00/1461523_stefan_ls.jpg[/img]\r\nRođen je oko 1308. godine, ili 1312. godine od oca Stefana Uroša III Dečanskog i majke Teodore Smilec. Dušanov deda po ocu je srpski kralj Stefan Milutin, a po majci bugarski car Smilec.\r\n', 5, 16, 1, '2022-05-10', 'milos', 144),
(3, 'Tara', 'Masiv planine Tare nalazi se u zapadnoj Srbiji, u severozapadnom delu oivičen dubokim kanjonom reke Drine, dok mu se ogranci spuštaju ka kremanskoj dolini i dolini reke Đetinje, gde se oslanja na ogranke Zlatibora. Područje planine Tare sačinjava najzapadniju skupinu iz grupe Starovlaških planina i, u širem smislu, sastoji se od tri podeone celine, donekle izdvojene rečnim dolinama, prevojima ili sedlima.\r\n[img]https://upload.wikimedia.org/wikipedia/commons/thumb/9/96/Tara_jezero_Djurici.jpg/432px-Tara_jezero_Djurici.jpg[/img]\r\n\r\nNa osnovu dugogodišnjih proučavanja i istraživanja ovog područja, a radi zaštite izuzetnih prirodnih vrednosti koje ono poseduje Skupština Srbije je 1981 posebnim Zakonom područje Tare proglasila za Nacionalni park.\r\n\r\nPlanina Tara je poznato i tradicionalno letnje i zimsko rekreativno područje. Povoljni klimatski uslovi, veliki broj sunčanih dana, srednja visina oko 1000 metra nadmorske visine.\r\n[img]https://bookaweb.s3.eu-central-1.amazonaws.com/media/27772/responsive-images/tara-%283%29___media_library_original_1200_630.jpg[/img]', 8, 22, 1, '2022-05-13', 'stefan123', 12),
(4, 'Soko Banja', 'Nalazi se visini od oko 400 m nadmorske visine. Kroz Sokobanju protiče reka Sokobanjska Moravica. Poznata je turistička odrednica za rekreativni, a posebno banjski turizam. Nalazi se između karpatskih i balkanskih planina, Rtnja i Ozrena. Za Sokobanju su vezani i Lepterija, izletište koje se nalazi uz Sokobanjsku Moravicu, i poznati srednjovekovni grad — Soko Grad (banjski). U blizini banje nalazi se vodopad Ripaljka, koji je periodičan i visok je dvadesetak metara. Sokobanja je poznata po manifestaciji „Prva harmonika”, tradicionalnom takmičenju harmonikaša koje se održava svake godine krajem avgusta.\r\n\r\nOvde se nalaze Termomineralni izvori Sokobanje.', 20, 87, 1, '2022-05-15', 'lazar', 146),
(5, 'Soko Grad', 'Soko Grad je srednjovekovni grad zvan još i Sokolac, smešten na 2 km istočno od Sokobanje. Istraživanja su pokazala da je grad vrlo razuđen i velikih razmera. U dobrom stanju je sačuvana samo prva, ulazna kula u gornjem gradu, a ostalo je, kako kule, tako i zidovi, porušeno.\r\n[img]https://upload.wikimedia.org/wikipedia/commons/thumb/c/c0/Sokograd.jpg/330px-Sokograd.jpg[/img]', 5, 14, 1, '2022-05-13', NULL, 146),
(10, 'Pećina Risovača', 'Pećina Risovača nalazi se na ulazu u Aranđelovac iz pravca Topole. Predstavlja stanište čoveka iz ledenog doba i jedno od najpoznatijih nalazišta paleolita u Evropi. Kao prirodan objekat prava je retkost ne samo za nauku nego i za posetioce koji žele da saznaju nešto o čovekovoj prošlosti.\r\n\r\nMeštanima je pećina bila poznata i pre 1937/1938. godine kada je počeo rad kamenoloma, ali su postojala samo dva uzana ulaza u podzemnu prostoriju. Godine 1953. počela su arheološka ispitivanja i otkriveni su fosili pećinskog medveda, mamuta, runastog nosoroga, bizona, pećinskog lava, leoparda, pećinske hijene, jelena itd. Otkopana je pećina u dužini od 187 metara sa dvoranama od korala raznih oblika i boja i sa predmetima i ukrasima kojima se služio pračovek.\r\n[img]https://upload.wikimedia.org/wikipedia/commons/thumb/f/ff/Ulaz_u_pecinu_risovaca.jpg/375px-Ulaz_u_pecinu_risovaca.jpg[/img]\r\nZbog prirodne vrednosti, kao i velikog arheološkog i paleontološkog značaja, pećina je 1983. proglašena kulturnim dobrom od velikog značaja, a 1995. sa okolnim prostorom (oko 13 hektara) stavljena je pod zaštitu kao spomenik prirode I kategorije.', 2, 8, 1, '2022-05-31', 'nikola', 5),
(11, 'Kalemegdan', 'Kalemegdan je najveći beogradski park. Istovremeno je najznačajniji kulturno-istorijski kompleks, u kojem dominira Beogradska tvrđava iznad ušća Save u Dunav. Naziv Kalemegdan odnosi se samo na prostorni plato oko tvrđave koji je osamdesetih godina 19. veka pretvoren u park . Plato je, dok je tvrđava bila glavno vojno uporište Beograda, služio da se neprijatelj osmotri i sačeka za borbu. Njegovo ime potiče od turskih reči kale („tvrđava“) i mejdan („bojište“). Turci su Kalemegdan nazivali i Fićir-bajir što znači „breg za razmišljanje“', 0, 0, 0, '2022-05-31', 'nikola', 16),
(12, 'Hram Svetog Save', 'Hram Svetog Save u Beogradu najveći je srpski pravoslavni hram i predstavlja najveću pravoslavnu crkvu na svijetu koja je u upotrebi. Nalazi se u opštini Vračar, na istočnom dijelu Svetosavskog platoa. Planirano je da bude sjedište episkopije i glavni saborni hram Srpske pravoslavne crkve. Posvećen je Svetom Savi, osnivaču Srpske pravoslavne crkve i jednoj od najznačajnijih ličnosti u srpskoj istoriji.\r\n\r\n[img]https://upload.wikimedia.org/wikipedia/commons/thumb/d/d2/%D0%A5%D1%80%D0%B0%D0%BC_%D0%A1%D0%B2%D0%B5%D1%82%D0%BE%D0%B3_%D0%A1%D0%B0%D0%B2%D0%B5_%D0%A1%D0%B5%D1%80%D0%B1%D1%81%D0%BA%D0%BE%D0%B3_%D1%83_%D0%91%D0%B8%D0%BE%D0%B3%D1%80%D0%B0%D0%B4%D1%83.jpg/420px-%D0%A5%D1%80%D0%B0%D0%BC_%D0%A1%D0%B2%D0%B5%D1%82%D0%BE%D0%B3_%D0%A1%D0%B0%D0%B2%D0%B5_%D0%A1%D0%B5%D1%80%D0%B1%D1%81%D0%BA%D0%BE%D0%B3_%D1%83_%D0%91%D0%B8%D0%BE%D0%B3%D1%80%D0%B0%D0%B4%D1%83.jpg[/img]\r\n\r\nSagrađen je na pretpostavljenom mjestu groba Svetog Save, gdje su spaljene njegove mošti. Veliki vezir Kodža Sinan-paša naredio je da se kovčeg sa Savinim moštima prenese iz manastira Mileševa u Beograd, gdje ga je 1595. godine stavio na lomaču i spalio. Međutim, tačno mjesto spaljivanja nije utvrđeno sa sigurnošću, a smatra se da je ono bilo na brdu „Čupina umka”, na Tašmajdanu, na mjestu između današnje Crkve Svetog Marka i sportskog kompleksa, a koje se tada zvalo Vračar.', 2, 9, 1, '2022-05-31', 'nikola', 16);

-- --------------------------------------------------------

--
-- Table structure for table `objavatag`
--

DROP TABLE IF EXISTS `objavatag`;
CREATE TABLE IF NOT EXISTS `objavatag` (
  `objavaID` int(11) NOT NULL,
  `tagID` int(11) NOT NULL,
  PRIMARY KEY (`objavaID`,`tagID`),
  KEY `tagID` (`tagID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `objavatag`
--

INSERT INTO `objavatag` (`objavaID`, `tagID`) VALUES
(1, 1),
(2, 2),
(5, 2),
(3, 3),
(4, 4),
(5, 4),
(10, 5),
(11, 6),
(12, 7);

-- --------------------------------------------------------

--
-- Table structure for table `ocenakorisnikobjava`
--

DROP TABLE IF EXISTS `ocenakorisnikobjava`;
CREATE TABLE IF NOT EXISTS `ocenakorisnikobjava` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `korisnickoIme` varchar(20) DEFAULT NULL,
  `objava` int(11) DEFAULT NULL,
  `ocena` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `korisnickoIme` (`korisnickoIme`),
  KEY `objava` (`objava`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ocenakorisnikobjava`
--

INSERT INTO `ocenakorisnikobjava` (`id`, `korisnickoIme`, `objava`, `ocena`) VALUES
(1, 'nikola', 3, 5),
(2, 'pera', 10, 4),
(3, 'pera', 12, 5),
(4, 'lazar', 10, 4),
(5, 'lazar', 12, 4);

-- --------------------------------------------------------

--
-- Table structure for table `reklama`
--

DROP TABLE IF EXISTS `reklama`;
CREATE TABLE IF NOT EXISTS `reklama` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nazivRadnje` varchar(60) NOT NULL,
  `opis` varchar(1000) DEFAULT NULL,
  `slikaURL` varchar(2000) DEFAULT NULL,
  `adresa` varchar(120) NOT NULL,
  `telefon` varchar(20) DEFAULT NULL,
  `email` varchar(320) DEFAULT NULL,
  `sajtURL` varchar(2000) DEFAULT NULL,
  `vremeKreiranja` date NOT NULL,
  `odobrena` tinyint(1) NOT NULL,
  `autor` varchar(20) DEFAULT NULL,
  `lokacija` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `autor` (`autor`),
  KEY `lokacija` (`lokacija`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reklama`
--

INSERT INTO `reklama` (`id`, `nazivRadnje`, `opis`, `slikaURL`, `adresa`, `telefon`, `email`, `sajtURL`, `vremeKreiranja`, `odobrena`, `autor`, `lokacija`) VALUES
(1, 'GRNČARIJA ĐORĐEVIĆ', 'Grnčarske majstorije i nadahnuća radionice „Đorđević“ traju od davne 1927. godine. Majstor Voja Đorđević je u Obrenovcu osnovao ovu radionicu. Radio je u njoj do 1957. godine. Majstori i njihovi pomoćnici dobijali su i dobijaju inspiraciju za svoj rad u starim grnčarski tehnikama i proizvodima. Upotrebna, baštenska i ukrasna grnčarija uvek je nalazila svoj put do kupaca. Radionica „Đorđević“ je jedna od retkih koja na ovim prostorima čuva ovaj drevni zanat. Na taj način značajno doprinosi čuvanju naše kulturne baštine i tradicije.', 'https://www.biznisgroup.com/wp-content/uploads/2019/11/67368198_2363827947027905_4970242863393669120_n.jpg', 'Maksima Gorkog 65', '+060 3323619', 'djordjevici68@gmail.com', 'grncarijadjordjevic.com', '2022-04-12', 1, 'bogdandj', 144),
(2, 'PODRUM ĐORĐEVIĆ', 'Po uzoru na pretke, nastavljajući dugu tradiciju, vinarija Podrum Đorđević, proizvodi najbolje grožđe i najkvalitetnija vina iz Aleksandrovca. Na dva i po sata od Beograda, na osunčanim padinama Begovca, nastaju izuzetna vina sa istančanim karakterom i teroarom Župe Aleksandrovačke.', 'https://www.hranaipice.net/files/upload/htmleditor/vina-djordjevic-2.jpg', 'Gornji Stupanj BB', '+064 3755199', 'djordjevicivino@gmail.com', 'vinarijadjordjevic.com', '2022-03-11', 1, 'bogdandj', 12),
(3, 'DUŠAN MOMIĆ PR, ZANATSKA RADNJA ZA OBRADU METALA', 'Naša radnja je relativno mlado preduzeće, osnovano 2017. godine. Bavimo se izradom preserskih alata, alata za livenje kao i uslužnom proizvodnjom prototipova i serijskom proizvodnjom. Mašine za obradu i proizvodnju alata su veoma kvalitetne, tako da možemo ispoštovati sve uslove kvaliteta. U narednim godinama planiramo da povećamo mašinski park.', 'https://masinskaobradametala.rs/wp-content/uploads/2021/06/industrial-metal-drill-machine-metalworking-workshop.jpg', 'Braće Ribnikar 10', '+064 1215481', 'momicd76@gmail.com', 'momicmetal.com', '2022-04-12', 1, 'dusanm', 144),
(4, 'PANDA AUTO', 'Panda auto je privatno preduzeće koje obezbeđuje sve rezervne delove i ostalu robu namenjenu održavanju putničkih i komercijalnih vozila, kao i alate, opremu i neophodne softverske pakete za rad u servisima motornih vozila. Preduzeće je počelo sa radom 1990. godine i od tada kontinuirano proširuje prodajnu mrežu na tržištu Srbije. Početkom 2021. poslovanje se odvija širom Srbije kroz više od 40 poslovnih jedinica koje se nalaze pod okriljem firme.\r\nStrateška težnja preduzeća je da svojim asortimanom pokrije 99% potreba servisa motornih vozila, lako informisanje i poručivanje, uz pružanje dovoljno brze isporuke. Povrh svega, mi pružamo pomoć serviserima da vlasniku vozila obezbede efikasno i kvalitetno održavanje.\r\nStalno usavršavanje našeg profesionalnog znanja, asortimana i usluge ka servisima je jedini pravac poslovnih aktivnosti preduzeća.\r\nIz ovog okvira preduzeće neće izlaziti ni u budućnosti, jer procenjujemo da ima još puno prostora na tržištu snabdevanja servisa motornih vozila', 'https://www.vesti-online.com/wp-content/uploads/2021/07/auto-repair-3691963_1920-1024x683.jpg', 'Karađorđeva 46', '+062 8311472', 'panda6@gmail.com', 'pandamionica.com', '2022-05-11', 1, 'brankopanda', 5),
(5, 'SAŠA MITROVIĆ PR SAMOSTALNA ZANATSKA RADNJA BEOGRAD IZRADA P', 'Posuđe za kuhinju proizvedeno od najkvalitetnijih materijala sa dugom otpornošću jeste ono što je fokus naše prodavnice. Kvalitetno posuđe za kuvanje je nešto što sebi moramo obezbediti kako bi ručak uvek bio spremljen na najkvalitetniji način. Uz našu ponudu ćete sebi obezbediti adekvatan kuhinjski pribor, jer hrana u našem posuđu čuva svoje dobre sastojke, vitamine i nutrijente.', 'https://static.kupindoslike.com/BAKARNO-POSUDjE-RUCNA-IZRADA-19-ILI-18-VEK_slika_L_3618748.jpg', 'Mariborska 22', '+066 1214172', 'salesale@gmail.com', 'saleposudje.com', '2022-05-21', 0, 'sale1', 12),
(6, 'SAŠA MITROVIĆ RUČNO RAĐENI NAKIT', 'Domaći brend ručno rađenog antialergijskog nakita.\r\nSvoju priču počeli smo pre 8 godina, i naša vizija je bila da tržištu ponudimo drugačiji i originalan nakit, koji pritom neće izazivati alergije niti druge indikacije na koži.\r\nSmatramo da nakit osim što je privlačan i unikatan treba da bude i bezbedan za nošenje.\r\nNakit ne menja boju tokom nošenja, otporan je na vodu, znoj i habanje. Nakit pravimo od kombinacije aluminijuma koji tokom vremena ne tamni i nema reakcije u dodiru sa spoljnim faktorima, eko kože, kože, kaučuka, poludragog kamenja, stakala i svilenih kanapa.\r\nNaši klijenti kod nas mogu pronaći, isprobati ili poručiti nakit koji će istaći njihovu individualnost.', 'https://unikatnirucnoradjeninakit.com/wp-content/uploads/2020/03/h8.jpg', 'Ribnička 7', '+066 1214172', 'salesale@gmail.com', 'salenakit.com', '2022-05-21', 1, 'sale1', 12),
(14, 'OBUĆA VASILYS - RUČNO RAĐENA OBUĆA', 'Proizvodnja obuće Vasilys od samog svog početka 1988. godine pa sve do danas trudi se da svojim mušterijama ponudi samo maksimalan kvalitet kako materijala, tako i same izrade.\r\nSinonimi za našu obuću su unikatan dizajn, koža vrhunskog kvaliteta i tradicija u ručnoj izradi koju sada već prenosimo sa kolena na koleno. Sa velikim brojem zadovoljnih mušterija smatramo da smo dobri u poslu kojim se bavimo sa čim želimo da se uverite i Vi.\r\nProverite zašto nam se mušterije stalno vraćaju!', 'https://www.kobbler.rs/wp-content/uploads/2020/09/4Z5A3817-400x400.jpg', 'Takovska 1', '+060 0143211', 'obucavale@gmail.com', 'www.valeobuca.com', '2022-05-30', 0, 'vasilys', 159),
(15, 'SVILENA ODEĆA ANGIE', 'Svilena odeća Angie je porodična zanatska radnja, koja ima iskustvo od preko 50 godina u dizajniranju i proizvodnji odela, sakoa i drugih krojačkih artikala, napravljenih od 100% svile koja, pored kvaliteta i vrhunskog izgleda, garantuje neprikosnovenu udobnost! Ženska odeća je još jedna od naših kategorija u kojoj imamo veliki izbor proizvoda. Ženska odeća, majice na kratak i dug rukav, duksevi sa kapuljačom i bez, duks haljine, letnji kompleti kao i kompleti ženske odeće. Kod nas možete da pronađeš veliki izbor ženske odeće na jednom mestu. Posetite nas!', 'https://thumbs.dreamstime.com/z/silk-clothes-colorful-sell-market-75375681.jpg', 'Ulica palih boraca 89', '+061 0652212', 'angie@gmail.com', 'www.angiesilk.com', '2022-05-30', 1, 'angie', 146);

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
CREATE TABLE IF NOT EXISTS `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(120) NOT NULL,
  `odobren` tinyint(1) NOT NULL,
  `kategorija` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `kategorija` (`kategorija`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`id`, `naziv`, `odobren`, `kategorija`) VALUES
(1, 'Smederevska tvrdjava', 1, 4),
(2, 'Dusan Silni', 1, 1),
(3, 'Nacionalni park Tara', 1, 6),
(4, 'Soko grad', 1, 4),
(5, 'Pećina Risovača', 0, 5),
(6, 'Kalemegdan', 0, 4),
(7, 'Hram Svetog Save', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tagkategorija`
--

DROP TABLE IF EXISTS `tagkategorija`;
CREATE TABLE IF NOT EXISTS `tagkategorija` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tagkategorija`
--

INSERT INTO `tagkategorija` (`id`, `naziv`) VALUES
(1, 'istorijska licnost'),
(2, 'spomenik'),
(3, 'crkva/manastir'),
(4, 'tvrdjava'),
(5, 'areolosko nalaziste'),
(6, 'park prirode');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD CONSTRAINT `lokacija` FOREIGN KEY (`lokacija`) REFERENCES `lokacija` (`id`),
  ADD CONSTRAINT `tip` FOREIGN KEY (`tip`) REFERENCES `korisniktip` (`id`);

--
-- Constraints for table `objava`
--
ALTER TABLE `objava`
  ADD CONSTRAINT `autorO` FOREIGN KEY (`autor`) REFERENCES `korisnik` (`korisnickoIme`) ON DELETE SET NULL,
  ADD CONSTRAINT `lokacijaO` FOREIGN KEY (`lokacija`) REFERENCES `lokacija` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `objavatag`
--
ALTER TABLE `objavatag`
  ADD CONSTRAINT `objavaID` FOREIGN KEY (`objavaID`) REFERENCES `objava` (`id`),
  ADD CONSTRAINT `tagID` FOREIGN KEY (`tagID`) REFERENCES `tag` (`id`);

--
-- Constraints for table `ocenakorisnikobjava`
--
ALTER TABLE `ocenakorisnikobjava`
  ADD CONSTRAINT `korisnickoImeOc` FOREIGN KEY (`korisnickoIme`) REFERENCES `korisnik` (`korisnickoIme`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `objavaOc` FOREIGN KEY (`objava`) REFERENCES `objava` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `reklama`
--
ALTER TABLE `reklama`
  ADD CONSTRAINT `autor` FOREIGN KEY (`autor`) REFERENCES `korisnik` (`korisnickoIme`) ON DELETE SET NULL,
  ADD CONSTRAINT `lokacijaR` FOREIGN KEY (`lokacija`) REFERENCES `lokacija` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tag`
--
ALTER TABLE `tag`
  ADD CONSTRAINT `kategorija` FOREIGN KEY (`kategorija`) REFERENCES `tagkategorija` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
