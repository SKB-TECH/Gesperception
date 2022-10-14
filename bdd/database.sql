-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 19, 2022 at 01:22 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nyalukemba_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `autres_depenses`
--

CREATE TABLE `autres_depenses` (
  `code_autres` int(11) NOT NULL,
  `montant_depense` double NOT NULL,
  `motif` varchar(50) NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `avance`
--

CREATE TABLE `avance` (
  `id` int(11) NOT NULL,
  `idagent` int(11) NOT NULL,
  `mois` varchar(55) NOT NULL,
  `montant` float NOT NULL DEFAULT 0,
  `um` varchar(15) NOT NULL,
  `dates` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `avance`
--

INSERT INTO `avance` (`id`, `idagent`, `mois`, `montant`, `um`, `dates`) VALUES
(3, 1, '2022-06', 20000, 'Fc', '2022-09-29');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `code_classe` int(11) NOT NULL,
  `designation_classe` varchar(50) NOT NULL,
  `idOption` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `depense`
--

CREATE TABLE `depense` (
  `id` int(11) NOT NULL,
  `motif` text NOT NULL,
  `montant` int(11) NOT NULL,
  `um` varchar(15) NOT NULL,
  `mois` varchar(25) NOT NULL,
  `dates` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `depense`
--

INSERT INTO `depense` (`id`, `motif`, `montant`, `um`, `mois`, `dates`) VALUES
(2, 'Achat Fournitures de bureau', 120000, '$', '2022-03', '2022-09-23'),
(4, 'Coordination', 34500, '$', '2022-07', '2022-09-23');

-- --------------------------------------------------------

--
-- Table structure for table `eleves`
--

CREATE TABLE `eleves` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `postnom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `sexe` varchar(10) NOT NULL,
  `date_naissance` date NOT NULL DEFAULT current_timestamp(),
  `lieu_naissance` varchar(50) NOT NULL,
  `classe` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `eleves`
--

INSERT INTO `eleves` (`id`, `nom`, `postnom`, `prenom`, `sexe`, `date_naissance`, `lieu_naissance`, `classe`) VALUES
(1, 'Matabaro', 'ddd', 'Doddy', 'M', '2022-09-13', 'king', '1 ere'),
(2, 'bbbb', 'fvcvc', 'vcvcv', 'M', '2022-09-12', 'king', '1 ere'),
(4, 'a', 't', 'a', 'b', '2022-09-14', 'r', '1 ere'),
(5, 'o', 'd', 'd', 'y', '2022-09-14', '', '1 ere'),
(6, 'a', 't', 'a', 'b', '2022-09-14', 'r', '1 ere'),
(7, 'o', 'd', 'd', 'y', '2022-09-14', '', ''),
(8, 'a', 't', 'a', 'b', '2022-09-14', 'r', '2 e'),
(9, 'o', 'd', 'd', 'm', '2022-09-14', '', '2 ere'),
(10, 'a', 't', 'a', 'b', '2022-09-14', 'r', '2 e'),
(11, 'o', 'd', 'd', 'y', '2022-09-14', '', '2 e'),
(12, 'a', 't', 'a', 'b', '2022-09-14', 'r', 'a'),
(13, 'o', 'd', 'd', 'y', '2022-09-14', '', '3 e'),
(14, 'a', 't', 'a', 'b', '2022-09-14', 'r', 'a'),
(15, 'o', 'd', 'd', 'y', '2022-09-14', '', ''),
(16, 'a', 't', 'a', 'b', '2022-09-14', 'r', 'a'),
(17, 'o', 'd', 'd', 'y', '2022-09-14', '', ''),
(18, 'a', 't', 'a', 'b', '2022-09-14', 'r', 'a'),
(19, 'o', 'd', 'd', 'y', '2022-09-14', '', ''),
(21, 'o', 'd', 'd', 'y', '2022-09-14', '', ''),
(22, 'a', 't', 'a', 'b', '2022-09-14', 'r', 'a'),
(23, 'o', 'd', 'd', 'y', '2022-09-14', '', ''),
(24, 'Nom', 'Postom', 'Prenom', 'Sexe', '2022-09-14', 'Lieu', 'Classe'),
(25, 'Matabaro', 'mulume', 'Doddy', 'M', '2022-09-14', 'king', '1 ere'),
(26, 'doddy', 'koko', 'rien', 'f', '2022-09-14', 'bkv', '2 ere'),
(27, 'Matabaro', 'mulume', 'Doddy', 'M', '2022-09-14', 'king', '3 ere'),
(28, 'doddy', 'koko', 'rien', 'f', '2022-09-14', 'bkv', '4 ere'),
(29, 'Matabaro', 'mulume', 'Doddy', 'M', '2022-09-14', 'king', '5 ere'),
(30, 'doddy', 'koko', 'rien', 'f', '2022-09-14', 'bkv', '6 ere'),
(31, 'Matabaro', 'mulume', 'Doddy', 'M', '2022-09-14', 'king', '7 ere'),
(32, 'doddy', 'koko', 'rien', 'f', '2022-09-14', 'bkv', '8 ere'),
(33, 'Matabaro', 'mulume', 'Doddy', 'M', '2022-09-14', 'king', '9 ere'),
(34, 'doddy', 'koko', 'rien', 'f', '2022-09-14', 'bkv', '10 ere'),
(35, 'Matabaro', 'mulume', 'Doddy', 'M', '2022-09-14', 'king', '11 ere'),
(36, 'doddy', 'koko', 'rien', 'f', '2022-09-14', 'bkv', '12 ere'),
(37, 'Matabaro', 'mulume', 'Doddy', 'M', '2022-09-14', 'king', '13 ere'),
(38, 'doddy', 'koko', 'rien', 'f', '2022-09-14', 'bkv', '14 ere'),
(39, 'Matabaro', 'mulume', 'Doddy', 'M', '2022-09-14', 'king', '15 ere'),
(40, 'doddy', 'koko', 'rien', 'f', '2022-09-14', 'bkv', '16 ere'),
(41, 'Matabaro', 'mulume', 'Doddy', 'M', '2022-09-14', 'king', '17 ere'),
(42, 'doddy', 'koko', 'rien', 'f', '2022-09-14', 'bkv', '18 ere'),
(43, 'Matabaro', 'mulume', 'Doddy', 'M', '2022-09-14', 'king', '19 ere'),
(45, 'Nom', 'Postom', 'Prenom', 'Sexe', '2022-09-14', 'Lieu', 'Classe'),
(46, 'Matabaro', 'mulume', 'Doddy', 'M', '2022-09-14', 'king', '1 ere'),
(47, 'doddy', 'koko', 'rien', 'f', '2022-09-14', 'bkv', '2 ere'),
(48, 'Matabaro', 'mulume', 'Doddy', 'M', '2022-09-14', 'king', '3 ere'),
(49, 'doddy', 'koko', 'rien', 'f', '2022-09-14', 'bkv', '4 ere'),
(50, 'Matabaro', 'mulume', 'Doddy', 'M', '2022-09-14', 'king', '5 ere'),
(51, 'doddy', 'koko', 'rien', 'f', '2022-09-14', 'bkv', '6 ere'),
(52, 'Matabaro', 'mulume', 'Doddy', 'M', '2022-09-14', 'king', '7 ere'),
(53, 'doddy', 'koko', 'rien', 'f', '2022-09-14', 'bkv', '8 ere'),
(54, 'Matabaro', 'mulume', 'Doddy', 'M', '2022-09-14', 'king', '9 ere'),
(55, 'doddy', 'koko', 'rien', 'f', '2022-09-14', 'bkv', '10 ere'),
(56, 'Matabaro', 'mulume', 'Doddy', 'M', '2022-09-14', 'king', '11 ere'),
(57, 'doddy', 'koko', 'rien', 'f', '2022-09-14', 'bkv', '12 ere'),
(58, 'Matabaro', 'mulume', 'Doddy', 'M', '2022-09-14', 'king', '13 ere'),
(59, 'doddy', 'koko', 'rien', 'f', '2022-09-14', 'bkv', '14 ere'),
(60, 'Matabaro', 'mulume', 'Doddy', 'M', '2022-09-14', 'king', '15 ere'),
(61, 'doddy', 'koko', 'rien', 'f', '2022-09-14', 'bkv', '16 ere'),
(62, 'Matabaro', 'mulume', 'Doddy', 'M', '2022-09-14', 'king', '17 ere'),
(63, 'doddy', 'koko', 'rien', 'f', '2022-09-14', 'bkv', '18 ere'),
(64, 'Matabaro', 'mulume', 'Doddy', 'M', '2022-09-14', 'king', '19 ere'),
(65, 'doddy', 'koko', 'rien', 'f', '2022-09-14', 'bkv', '20 ere'),
(66, 'Postom', 'Prenom', 'Sexe', 'Classe', '2022-09-14', 'Naissance', 'Lieu'),
(67, 'mulume', 'Doddy', 'M', '1 ere', '2022-09-14', '2022-09-13', 'king'),
(68, 'koko', 'rien', 'f', '2 ere', '2022-09-14', '2022-09-12', 'bkv'),
(69, 'mulume', 'Doddy', 'M', '3 ere', '2022-09-14', '2022-09-11', 'king'),
(70, 'koko', 'rien', 'f', '4 ere', '2022-09-14', '2022-09-10', 'bkv'),
(71, 'mulume', 'Doddy', 'M', '5 ere', '2022-09-14', '2022-09-9', 'king'),
(72, 'koko', 'rien', 'f', '6 ere', '2022-09-14', '2022-09-8', 'bkv'),
(73, 'mulume', 'Doddy', 'M', '7 ere', '2022-09-14', '2022-09-7', 'king'),
(74, 'koko', 'rien', 'f', '8 ere', '2022-09-14', '2022-09-6', 'bkv'),
(75, 'mulume', 'Doddy', 'M', '9 ere', '2022-09-14', '2022-09-5', 'king'),
(76, 'koko', 'rien', 'f', '10 ere', '2022-09-14', '2022-09-4', 'bkv'),
(77, 'mulume', 'Doddy', 'M', '11 ere', '2022-09-14', '2022-09-3', 'king'),
(78, 'koko', 'rien', 'f', '12 ere', '2022-09-14', '2022-09-2', 'bkv'),
(79, 'mulume', 'Doddy', 'M', '13 ere', '2022-09-14', '2022-09-1', 'king'),
(80, 'koko', 'rien', 'f', '14 ere', '2022-09-14', '2022-09+0', 'bkv'),
(81, 'mulume', 'Doddy', 'M', '15 ere', '2022-09-14', '2022-09+1', 'king'),
(82, 'koko', 'rien', 'f', '16 ere', '2022-09-14', '2022-09+2', 'bkv'),
(83, 'mulume', 'Doddy', 'M', '17 ere', '2022-09-14', '2022-09+3', 'king'),
(84, 'koko', 'rien', 'f', '18 ere', '2022-09-14', '2022-09+4', 'bkv'),
(85, 'mulume', 'Doddy', 'M', '19 ere', '2022-09-14', '2022-09+5', 'king'),
(86, 'koko', 'rien', 'f', '20 ere', '2022-09-14', '2022-09+6', 'bkv'),
(87, 'Postom', 'Prenom', 'Sexe', 'Classe', '2022-09-14', 'Naissance', 'Lieu'),
(88, 'mulume', 'Doddy', 'M', '1 ere', '2022-09-14', '2022-09-13', 'king'),
(89, 'koko', 'rien', 'f', '2 ere', '2022-09-14', '2022-09-12', 'bkv'),
(90, 'mulume', 'Doddy', 'M', '3 ere', '2022-09-14', '2022-09-11', 'king'),
(91, 'koko', 'rien', 'f', '4 ere', '2022-09-14', '2022-09-10', 'bkv'),
(92, 'mulume', 'Doddy', 'M', '5 ere', '2022-09-14', '2022-09-9', 'king'),
(93, 'koko', 'rien', 'f', '6 ere', '2022-09-14', '2022-09-8', 'bkv'),
(94, 'mulume', 'Doddy', 'M', '7 ere', '2022-09-14', '2022-09-7', 'king'),
(95, 'koko', 'rien', 'f', '8 ere', '2022-09-14', '2022-09-6', 'bkv'),
(96, 'mulume', 'Doddy', 'M', '9 ere', '2022-09-14', '2022-09-5', 'king'),
(97, 'koko', 'rien', 'f', '10 ere', '2022-09-14', '2022-09-4', 'bkv'),
(98, 'mulume', 'Doddy', 'M', '11 ere', '2022-09-14', '2022-09-3', 'king'),
(99, 'koko', 'rien', 'f', '12 ere', '2022-09-14', '2022-09-2', 'bkv'),
(100, 'mulume', 'Doddy', 'M', '13 ere', '2022-09-14', '2022-09-1', 'king'),
(101, 'koko', 'rien', 'f', '14 ere', '2022-09-14', '2022-09+0', 'bkv'),
(102, 'mulume', 'Doddy', 'M', '15 ere', '2022-09-14', '2022-09+1', 'king'),
(103, 'koko', 'rien', 'f', '16 ere', '2022-09-14', '2022-09+2', 'bkv'),
(104, 'mulume', 'Doddy', 'M', '17 ere', '2022-09-14', '2022-09+3', 'king'),
(105, 'koko', 'rien', 'f', '18 ere', '2022-09-14', '2022-09+4', 'bkv'),
(106, 'mulume', 'Doddy', 'M', '19 ere', '2022-09-14', '2022-09+5', 'king'),
(107, 'koko', 'rien', 'f', '20 ere', '2022-09-14', '2022-09+6', 'bkv'),
(108, 'Postom', 'Prenom', 'Sexe', 'Classe', '2022-09-14', 'Naissance', 'Lieu'),
(109, 'mulume', 'Doddy', 'M', '1 ere', '2022-09-14', '2022-09-13', 'king'),
(110, 'koko', 'rien', 'f', '2 ere', '2022-09-14', '2022-09-12', 'bkv'),
(111, 'mulume', 'Doddy', 'M', '3 ere', '2022-09-14', '2022-09-11', 'king'),
(112, 'koko', 'rien', 'f', '4 ere', '2022-09-14', '2022-09-10', 'bkv'),
(113, 'mulume', 'Doddy', 'M', '5 ere', '2022-09-14', '2022-09-9', 'king'),
(114, 'koko', 'rien', 'f', '6 ere', '2022-09-14', '2022-09-8', 'bkv'),
(115, 'mulume', 'Doddy', 'M', '7 ere', '2022-09-14', '2022-09-7', 'king'),
(116, 'koko', 'rien', 'f', '8 ere', '2022-09-14', '2022-09-6', 'bkv'),
(117, 'mulume', 'Doddy', 'M', '9 ere', '2022-09-14', '2022-09-5', 'king'),
(118, 'koko', 'rien', 'f', '10 ere', '2022-09-14', '2022-09-4', 'bkv'),
(119, 'mulume', 'Doddy', 'M', '11 ere', '2022-09-14', '2022-09-3', 'king'),
(121, 'mulume', 'Doddy', 'M', '13 ere', '2022-09-14', '2022-09-1', 'king'),
(122, 'koko', 'rien', 'f', '14 ere', '2022-09-14', '2022-09+0', 'bkv'),
(124, 'koko', 'rien', 'f', '16 ere', '2022-09-14', '2022-09+2', 'bkv'),
(125, 'mulume', 'Doddy', 'M', '17 ere', '2022-09-14', '2022-09+3', 'king'),
(126, 'koko', 'rien', 'f', '18 ere', '2022-09-14', '2022-09+4', 'bkv'),
(128, 'koko', 'rien', 'f', '20 ere', '2022-09-14', '2022-09+6', 'bkv'),
(129, 'Nom', 'Postom', 'Prenom', 'Sexe', '2022-09-14', 'Lieu', 'Classe'),
(130, 'Matabaro', 'mulume', 'Doddy', 'M', '2022-09-14', 'king', '1 ere'),
(131, 'doddy', 'koko', 'rien', 'f', '2022-09-14', 'bkv', '2 ere'),
(132, 'Matabaro', 'mulume', 'Doddy', 'M', '2022-09-14', 'king', '3 ere'),
(133, 'doddy', 'koko', 'rien', 'f', '2022-09-14', 'bkv', '4 ere'),
(134, 'Matabaro', 'mulume', 'Doddy', 'M', '2022-09-14', 'king', '5 ere'),
(135, 'doddy', 'koko', 'rien', 'f', '2022-09-14', 'bkv', '6 ere'),
(136, 'Matabaro', 'mulume', 'Doddy', 'M', '2022-09-14', 'king', '7 ere'),
(137, 'doddy', 'koko', 'rien', 'f', '2022-09-14', 'bkv', '8 ere'),
(138, 'Matabaro', 'mulume', 'Doddy', 'M', '2022-09-14', 'king', '9 ere'),
(139, 'doddy', 'koko', 'rien', 'f', '2022-09-14', 'bkv', '10 ere'),
(140, 'Matabaro', 'mulume', 'Doddy', 'M', '2022-09-14', 'king', '11 ere'),
(141, 'doddy', 'koko', 'rien', 'f', '2022-09-14', 'bkv', '12 ere'),
(142, 'Matabaro', 'mulume', 'Doddy', 'M', '2022-09-14', 'king', '13 ere'),
(143, 'doddy', 'koko', 'rien', 'f', '2022-09-14', 'bkv', '14 ere'),
(144, 'Matabaro', 'mulume', 'Doddy', 'M', '2022-09-14', 'king', '15 ere'),
(145, 'doddy', 'koko', 'rien', 'f', '2022-09-14', 'bkv', '16 ere'),
(146, 'Matabaro', 'mulume', 'Doddy', 'M', '2022-09-14', 'king', '17 ere'),
(147, 'doddy', 'koko', 'rien', 'f', '2022-09-14', 'bkv', '18 ere'),
(148, 'Matabaro', 'mulume', 'Doddy', 'M', '2022-09-14', 'king', '19 ere'),
(149, 'doddy', 'koko', 'rien', 'f', '2022-09-14', 'bkv', '20 ere'),
(150, 'Nom', 'Postom', 'Prenom', 'Sexe', '2022-09-14', 'Lieu', 'Classe'),
(151, 'Matabaro', 'mulume', 'Doddy', 'M', '2022-09-14', 'king', '1 ere'),
(152, 'doddy', 'koko', 'rien', 'f', '2022-09-14', 'bkv', '2 ere'),
(153, 'Matabaro', 'mulume', 'Doddy', 'M', '2022-09-14', 'king', '3 ere'),
(154, 'doddy', 'koko', 'rien', 'f', '2022-09-14', 'bkv', '4 ere'),
(155, 'Matabaro', 'mulume', 'Doddy', 'M', '2022-09-14', 'king', '5 ere'),
(156, 'doddy', 'koko', 'rien', 'f', '2022-09-14', 'bkv', '6 ere'),
(157, 'Matabaro', 'mulume', 'Doddy', 'M', '2022-09-14', 'king', '7 ere'),
(158, 'doddy', 'koko', 'rien', 'f', '2022-09-14', 'bkv', '8 ere'),
(159, 'Matabaro', 'mulume', 'Doddy', 'M', '2022-09-14', 'king', '9 ere'),
(160, 'doddy', 'koko', 'rien', 'f', '2022-09-14', 'bkv', '10 ere'),
(161, 'Matabaro', 'mulume', 'Doddy', 'M', '2022-09-14', 'king', '11 ere'),
(162, 'doddy', 'koko', 'rien', 'f', '2022-09-14', 'bkv', '12 ere'),
(163, 'Matabaro', 'mulume', 'Doddy', 'M', '2022-09-14', 'king', '13 ere'),
(164, 'doddy', 'koko', 'rien', 'f', '2022-09-14', 'bkv', '14 ere'),
(165, 'Matabaro', 'mulume', 'Doddy', 'M', '2022-09-14', 'king', '15 ere'),
(167, 'Matabaro', 'mulume', 'Doddy', 'M', '2022-09-14', 'king', '17 ere'),
(169, 'Matabaro', 'mulume', 'Doddy', 'M', '2022-09-14', 'king', '19 ere'),
(171, 'KOKO', 'MIDESO', 'DM', 'M', '2022-09-07', 'Bukavu', 'IVemeHP');

-- --------------------------------------------------------

--
-- Table structure for table `enseignants`
--

CREATE TABLE `enseignants` (
  `id` int(11) NOT NULL,
  `noms` varchar(150) NOT NULL,
  `grade` varchar(40) NOT NULL,
  `sexe` varchar(10) NOT NULL,
  `adresse` varchar(40) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `domaine` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `enseignants`
--

INSERT INTO `enseignants` (`id`, `noms`, `grade`, `sexe`, `adresse`, `telephone`, `domaine`) VALUES
(1, 'shako kinyamba benjamin', 'Licencie', 'Homme', 'Goma', '0813678926', 'Enseignant'),
(3, 'Doddy Parolier', 'Licencie', 'Homme', 'Bagira', '0813678926', 'Informatique'),
(4, 'Ben Gourou', 'Licencie', 'Homme', 'Nguba', '0813678926', 'Prefet'),
(5, 'Ben Gourou', 'D6', 'Homme', 'Nguba', '+243977423201', 'Proviseur'),
(6, 'Audrey Kibibi', 'Licencie', 'Homme', 'Nguba', '0813678926', 'Prefet');

-- --------------------------------------------------------

--
-- Table structure for table `frais`
--

CREATE TABLE `frais` (
  `id` int(11) NOT NULL,
  `libelle` varchar(50) NOT NULL,
  `montant_frais` double(50,0) NOT NULL,
  `devise` varchar(50) NOT NULL,
  `tranche1` double NOT NULL DEFAULT 0,
  `tranche2` double NOT NULL DEFAULT 0,
  `tranche3` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `frais`
--

INSERT INTO `frais` (`id`, `libelle`, `montant_frais`, `devise`, `tranche1`, `tranche2`, `tranche3`) VALUES
(1, 'Prime', 400, '$', 90, 140, 170),
(6, 'Frais Divers', 60, '$', 20, 15, 20);

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `code_option` int(11) NOT NULL,
  `designation_option` varchar(50) NOT NULL,
  `idSection` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `paie`
--

CREATE TABLE `paie` (
  `id` int(11) NOT NULL,
  `idagent` int(11) NOT NULL,
  `montant` int(11) NOT NULL,
  `mituelle` int(11) NOT NULL,
  `avance` int(11) NOT NULL,
  `net` int(11) NOT NULL,
  `mois` varchar(55) NOT NULL,
  `dates` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paie`
--

INSERT INTO `paie` (`id`, `idagent`, `montant`, `mituelle`, `avance`, `net`, `mois`, `dates`) VALUES
(5, 3, 45000, 1000, 4000, 40000, '2022-02', '2022-09-22'),
(6, 1, 45000, 4500, 0, 40500, '2022-02', '2022-09-22'),
(7, 1, 45000, 4500, 0, 40500, '2022-02', '2022-09-21');

-- --------------------------------------------------------

--
-- Table structure for table `perception`
--

CREATE TABLE `perception` (
  `id` int(11) NOT NULL,
  `date_perception` date NOT NULL,
  `montant_percu` double NOT NULL,
  `idEleve` int(11) NOT NULL,
  `idFrais` int(11) NOT NULL,
  `idUser` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `perception`
--

INSERT INTO `perception` (`id`, `date_perception`, `montant_percu`, `idEleve`, `idFrais`, `idUser`) VALUES
(49, '2022-09-18', 10, 170, 1, 1),
(50, '2022-09-18', 100, 170, 1, 1),
(51, '2022-09-18', 200, 170, 1, 1),
(52, '2022-09-18', 10, 170, 1, 1),
(53, '2022-09-18', 10, 170, 1, 1),
(54, '2022-09-18', 10, 170, 1, 1),
(55, '2022-09-20', 45, 171, 1, 1),
(56, '2022-09-22', 156, 171, 1, 1),
(57, '2022-09-13', 156, 171, 1, 1),
(58, '2022-09-20', 45, 1, 1, 1),
(59, '2022-09-20', 200, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `code_section` int(11) NOT NULL,
  `designation` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`code_section`, `designation`) VALUES
(1, ''),
(2, ''),
(3, ''),
(4, ''),
(5, ''),
(6, ''),
(7, ''),
(8, ''),
(9, ''),
(10, ''),
(12, 'section'),
(13, 'section'),
(14, 'section'),
(15, 'section'),
(16, 'section'),
(17, 'section'),
(18, 'section'),
(19, 'section'),
(20, 'section'),
(21, 'section'),
(22, 'section'),
(23, 'section'),
(24, 'section'),
(25, 'section'),
(26, 'section'),
(27, 'section'),
(28, 'section'),
(29, 'section'),
(30, 'section'),
(31, 'section'),
(32, 'section'),
(33, 'section');

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `code_user` int(11) NOT NULL,
  `noms` varchar(50) NOT NULL,
  `fonction` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `login` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`code_user`, `noms`, `fonction`, `password`, `login`) VALUES
(1, 'doddy', 'admin', 'ok', 'doddy'),
(2, 'doddy2', 'Secretaire AVEC', 'admin', 'admin'),
(3, 'doddy2', 'Secretaire AVEC', 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `autres_depenses`
--
ALTER TABLE `autres_depenses`
  ADD PRIMARY KEY (`code_autres`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`code_classe`);

--
-- Indexes for table `eleves`
--
ALTER TABLE `eleves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enseignants`
--
ALTER TABLE `enseignants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `frais`
--
ALTER TABLE `frais`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`code_option`);

--
-- Indexes for table `paie`
--
ALTER TABLE `paie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `perception`
--
ALTER TABLE `perception`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`code_section`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`code_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eleves`
--
ALTER TABLE `eleves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- AUTO_INCREMENT for table `enseignants`
--
ALTER TABLE `enseignants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `frais`
--
ALTER TABLE `frais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `code_option` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paie`
--
ALTER TABLE `paie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `perception`
--
ALTER TABLE `perception`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `code_section` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `code_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;