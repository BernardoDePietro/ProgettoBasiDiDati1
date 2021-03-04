-- phpMyAdmin SQL Dump
-- version 4.1.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Giu 05, 2020 alle 10:11
-- Versione del server: 5.6.33-log
-- PHP Version: 5.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `my_depietroprogetto`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `ID_Categoria` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` text NOT NULL,
  PRIMARY KEY (`ID_Categoria`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `dipartimento`
--

CREATE TABLE IF NOT EXISTS `dipartimento` (
  `ID_Dip` int(5) NOT NULL AUTO_INCREMENT,
  `ID_Uni` int(3) NOT NULL,
  `Nome` varchar(100) DEFAULT NULL,
  `Via` varchar(100) DEFAULT NULL,
  `Cap` int(5) DEFAULT NULL,
  `Civico` int(5) DEFAULT NULL,
  PRIMARY KEY (`ID_Dip`),
  KEY `ID_Uni` (`ID_Uni`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=23 ;

--
-- Dump dei dati per la tabella `dipartimento`
--

INSERT INTO `dipartimento` (`ID_Dip`, `ID_Uni`, `Nome`, `Via`, `Cap`, `Civico`) VALUES
(10, 2, 'Ingegneria', 'Contrada di Dio', 98166, 0),
(12, 2, 'Civilta Antiche e Moderne', 'A. Giuffre', 98168, 0),
(13, 2, 'Economia', 'Cesare Battisti', 98122, 98),
(14, 2, 'Giurisprudenza', 'Piazza Pugliatti', 98122, 1),
(15, 2, 'Medicina Clinica e Sperimentale', 'Consolare Valeria', 98125, 1),
(16, 2, 'Patologia umana dell''adulto e dell''eta'' evolutiva', 'Consolare Valeria', 98125, 1),
(17, 2, 'Scienze biomediche, odontoiatriche e delle immagini morfologiche e funzionali', 'Consolare Valeria', 98125, 1),
(18, 2, 'Scienze chimiche, biologiche, farmaceutiche ed ambientali', 'Stagno d''Alcontres Messina', 98166, 0),
(19, 2, 'Scienze cognitive, psicologiche, pedagogiche e degli studi culturali', 'Concezione', 98121, 8),
(20, 2, 'Scienze matematiche e informatiche, scienze fisiche e scienze della terra', 'Stagno d''Alcontres', 98166, 0),
(21, 2, 'Scienze politiche e giuridiche', 'Piazza 20 Settembre', 98122, 0),
(22, 2, 'Scienze veterinarie', 'Polo Universitario S.S. Annunziata', 98168, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `direttore`
--

CREATE TABLE IF NOT EXISTS `direttore` (
  `Matricola` int(6) NOT NULL,
  `ID_Dip` int(5) NOT NULL,
  `Nome` varchar(30) NOT NULL,
  `Cognome` varchar(30) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Password` varchar(32) NOT NULL,
  PRIMARY KEY (`Matricola`),
  KEY `ID_Dip` (`ID_Dip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `direttore`
--

INSERT INTO `direttore` (`Matricola`, `ID_Dip`, `Nome`, `Cognome`, `Email`, `Password`) VALUES
(467546, 10, 'Bernardo', 'De Pietro', 'bernardodepietro11@gmail.com', '34e77268ac70c37fac53a7cf4e940ff6');

-- --------------------------------------------------------

--
-- Struttura della tabella `docente`
--

CREATE TABLE IF NOT EXISTS `docente` (
  `Matricola` int(6) NOT NULL,
  `Nome` varchar(30) NOT NULL,
  `Cognome` varchar(30) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Password` varchar(32) NOT NULL,
  `ID_Locale` int(5) DEFAULT NULL,
  `ID_Dip` int(5) NOT NULL,
  PRIMARY KEY (`Matricola`),
  KEY `ID_Locale` (`ID_Locale`),
  KEY `ID_Dip` (`ID_Dip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `docente`
--

INSERT INTO `docente` (`Matricola`, `Nome`, `Cognome`, `Email`, `Password`, `ID_Locale`, `ID_Dip`) VALUES
(214532, 'Francesco', 'Rossi', 'frossi@unime.it', '0cf9520058590fa87d5429265bbb9a9e', 11, 10);

-- --------------------------------------------------------

--
-- Struttura della tabella `edificio`
--

CREATE TABLE IF NOT EXISTS `edificio` (
  `ID_Edificio` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Dip` int(5) NOT NULL,
  `Nome` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_Edificio`),
  KEY `ID_Dip` (`ID_Dip`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=20 ;

--
-- Dump dei dati per la tabella `edificio`
--

INSERT INTO `edificio` (`ID_Edificio`, `ID_Dip`, `Nome`) VALUES
(11, 10, 'Blocco A'),
(12, 10, 'Blocco B'),
(13, 13, 'Edificio H'),
(16, 13, 'Edificio C'),
(17, 13, 'Edificio D'),
(18, 13, 'Rettorato'),
(19, 12, 'unico');

-- --------------------------------------------------------

--
-- Struttura della tabella `fornitore`
--

CREATE TABLE IF NOT EXISTS `fornitore` (
  `ID_Fornitore` int(5) NOT NULL,
  `Nome` varchar(30) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Password` varchar(32) NOT NULL,
  PRIMARY KEY (`ID_Fornitore`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `fornitore`
--

INSERT INTO `fornitore` (`ID_Fornitore`, `Nome`, `Email`, `Password`) VALUES
(12345, 'Azienda di Elettronica', 'fornitore@unime.it', 'e128c1e17fb084b782ef733c8c75bf9d');

-- --------------------------------------------------------

--
-- Struttura della tabella `genere`
--

CREATE TABLE IF NOT EXISTS `genere` (
  `ID_Genere` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_Genere`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `locale`
--

CREATE TABLE IF NOT EXISTS `locale` (
  `ID_Locale` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Piano` int(5) NOT NULL,
  `ID_Tipologia` int(5) NOT NULL,
  `Nome` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_Locale`),
  KEY `ID_Tipologia` (`ID_Tipologia`),
  KEY `ID_Piano` (`ID_Piano`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=22 ;

--
-- Dump dei dati per la tabella `locale`
--

INSERT INTO `locale` (`ID_Locale`, `ID_Piano`, `ID_Tipologia`, `Nome`) VALUES
(1, 5, 13, '101'),
(2, 13, 9, 'Informatica'),
(3, 13, 9, 'Linguistico'),
(4, 6, 13, '101'),
(6, 4, 13, '102'),
(7, 5, 13, '203'),
(8, 5, 13, '204'),
(9, 5, 13, '205'),
(10, 5, 13, '206'),
(11, 5, 13, '207'),
(12, 5, 13, '208'),
(13, 5, 13, '209'),
(14, 5, 13, '210'),
(15, 5, 13, '211'),
(16, 5, 13, '212'),
(17, 5, 13, '213'),
(18, 4, 8, '1'),
(19, 4, 8, '2'),
(20, 5, 8, '1'),
(21, 5, 8, '2');

-- --------------------------------------------------------

--
-- Struttura della tabella `magazzino`
--

CREATE TABLE IF NOT EXISTS `magazzino` (
  `ID_Magazzino` int(5) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_Magazzino`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=245 ;

--
-- Dump dei dati per la tabella `magazzino`
--

INSERT INTO `magazzino` (`ID_Magazzino`, `Nome`) VALUES
(17, 'Scrivania'),
(18, 'Scrivania'),
(19, 'Scrivania'),
(21, 'Sedia'),
(22, 'Sedia'),
(23, 'Sedia'),
(24, 'Sedia'),
(25, 'Sedia'),
(26, 'Sedia'),
(27, 'Sedia'),
(28, 'Sedia'),
(29, 'Sedia'),
(30, 'Sedia'),
(31, 'Sedia'),
(32, 'Sedia'),
(33, 'Sedia'),
(34, 'Sedia'),
(35, 'Sedia'),
(36, 'Sedia'),
(37, 'Sedia'),
(38, 'Sedia'),
(39, 'Sedia'),
(41, 'Monitor'),
(42, 'Monitor'),
(43, 'Monitor'),
(44, 'Monitor'),
(45, 'Monitor'),
(46, 'Monitor'),
(47, 'Monitor'),
(48, 'Monitor'),
(49, 'Monitor'),
(51, 'Tastiera'),
(52, 'Tastiera'),
(53, 'Tastiera'),
(54, 'Tastiera'),
(55, 'Tastiera'),
(56, 'Tastiera'),
(57, 'Tastiera'),
(58, 'Tastiera'),
(59, 'Tastiera'),
(61, 'Mouse'),
(62, 'Mouse'),
(63, 'Mouse'),
(64, 'Mouse'),
(65, 'Mouse'),
(66, 'Mouse'),
(67, 'Mouse'),
(68, 'Mouse'),
(69, 'Mouse'),
(71, 'Router'),
(72, 'Router'),
(73, 'Router'),
(74, 'Router'),
(76, 'Router'),
(77, 'Router'),
(78, 'Router'),
(79, 'Router'),
(81, 'Termosifoni'),
(82, 'Termosifoni'),
(83, 'Termosifoni'),
(84, 'Termosifoni'),
(85, 'Termosifoni'),
(86, 'Termosifoni'),
(87, 'Termosifoni'),
(88, 'Termosifoni'),
(89, 'Termosifoni'),
(91, 'Cestino'),
(92, 'Cestino'),
(93, 'Cestino'),
(94, 'Cestino'),
(95, 'Cestino'),
(96, 'Cestino'),
(97, 'Cestino'),
(98, 'Cestino'),
(99, 'Cestino'),
(100, 'Scrivania'),
(101, 'Scrivania'),
(102, 'Scrivania'),
(103, 'Scrivania'),
(104, 'Scrivania'),
(105, 'Scrivania'),
(106, 'Scrivania'),
(107, 'Scrivania'),
(108, 'Scrivania'),
(109, 'Scrivania'),
(110, 'Cestino'),
(111, 'Cestino'),
(112, 'Cestino'),
(113, 'Cestino'),
(114, 'Cestino'),
(115, 'Cestino'),
(116, 'Cestino'),
(117, 'Cestino'),
(118, 'Cestino'),
(119, 'Cestino'),
(122, 'Switch'),
(123, 'Switch'),
(124, 'Switch'),
(125, 'Switch'),
(126, 'Switch'),
(127, 'Switch'),
(128, 'Switch'),
(129, 'Switch'),
(131, 'Porta'),
(132, 'Porta'),
(133, 'Porta'),
(134, 'Porta'),
(135, 'Porta'),
(136, 'Porta'),
(138, 'Porta'),
(139, 'Porta'),
(140, 'Porta'),
(141, 'Porta'),
(142, 'Porta'),
(143, 'Porta'),
(144, 'Porta'),
(145, 'Porta'),
(146, 'Porta'),
(147, 'Porta'),
(148, 'Porta'),
(149, 'Porta'),
(151, 'Lavagna'),
(152, 'Lavagna'),
(153, 'Lavagna'),
(154, 'Lavagna'),
(155, 'Lavagna'),
(156, 'Lavagna'),
(157, 'Lavagna'),
(158, 'Lavagna'),
(159, 'Lavagna'),
(160, 'Microfono'),
(161, 'Microfono'),
(162, 'Microfono'),
(163, 'Microfono'),
(164, 'Microfono'),
(165, 'Microfono'),
(166, 'Microfono'),
(167, 'Microfono'),
(168, 'Microfono'),
(169, 'Microfono'),
(170, 'Rubinetto'),
(171, 'Rubinetto'),
(172, 'Rubinetto'),
(173, 'Rubinetto'),
(174, 'Rubinetto'),
(175, 'Rubinetto'),
(176, 'Rubinetto'),
(177, 'Rubinetto'),
(178, 'Rubinetto'),
(179, 'Rubinetto'),
(181, 'Wc'),
(182, 'Wc'),
(183, 'Wc'),
(184, 'Wc'),
(185, 'Wc'),
(186, 'Wc'),
(187, 'Wc'),
(188, 'Wc'),
(189, 'Wc'),
(191, 'Lampadina'),
(192, 'Lampadina'),
(193, 'Lampadina'),
(194, 'Lampadina'),
(195, 'Lampadina'),
(196, 'Lampadina'),
(197, 'Lampadina'),
(198, 'Lampadina'),
(199, 'Lampadina'),
(202, 'Lampadina'),
(203, 'Lampadina'),
(204, 'Lampadina'),
(205, 'Lampadina'),
(206, 'Lampadina'),
(207, 'Lampadina'),
(208, 'Lampadina'),
(209, 'Lampadina'),
(210, 'Lavandino'),
(211, 'Lavandino'),
(212, 'Lavandino'),
(213, 'Lavandino'),
(214, 'Lavandino'),
(215, 'Lavandino'),
(216, 'Lavandino'),
(217, 'Lavandino'),
(218, 'Lavandino'),
(219, 'Lavandino'),
(220, 'Lavandino'),
(221, 'Lavandino'),
(222, 'Lavandino'),
(223, 'Lavandino'),
(224, 'Lavandino'),
(225, 'Lavandino'),
(226, 'Lavandino'),
(227, 'Lavandino'),
(228, 'Lavandino'),
(229, 'Lavandino'),
(239, 'Sedia'),
(240, 'Sedia'),
(244, 'Monitor');

-- --------------------------------------------------------

--
-- Struttura della tabella `modello`
--

CREATE TABLE IF NOT EXISTS `modello` (
  `ID_Modello` int(5) NOT NULL AUTO_INCREMENT,
  `Modello` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_Modello`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=18 ;

--
-- Dump dei dati per la tabella `modello`
--

INSERT INTO `modello` (`ID_Modello`, `Modello`) VALUES
(11, 'Generico'),
(12, 'Legno'),
(13, 'Led'),
(14, 'Alogena'),
(16, 'Metallo'),
(17, 'Plastica');

-- --------------------------------------------------------

--
-- Struttura della tabella `oggetto`
--

CREATE TABLE IF NOT EXISTS `oggetto` (
  `ID_Oggetto` int(5) NOT NULL AUTO_INCREMENT,
  `ID_Modello` int(5) NOT NULL,
  `ID_Magazzino` int(5) DEFAULT NULL,
  `ID_Locale` int(5) DEFAULT NULL,
  `ID_Ordine` int(5) DEFAULT NULL,
  `Nome` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_Oggetto`),
  KEY `ID_Modello` (`ID_Modello`),
  KEY `ID_Locale` (`ID_Locale`),
  KEY `oggetto_ibfk_1` (`ID_Ordine`),
  KEY `oggetto_ibfk_4` (`ID_Magazzino`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=275 ;

--
-- Dump dei dati per la tabella `oggetto`
--

INSERT INTO `oggetto` (`ID_Oggetto`, `ID_Modello`, `ID_Magazzino`, `ID_Locale`, `ID_Ordine`, `Nome`) VALUES
(29, 11, 244, NULL, NULL, 'Monitor'),
(30, 11, NULL, NULL, 13, 'Monitor'),
(37, 12, NULL, 11, NULL, 'Scrivania'),
(39, 12, 17, NULL, NULL, 'Scrivania'),
(40, 12, 18, NULL, NULL, 'Scrivania'),
(41, 12, 19, NULL, NULL, 'Scrivania'),
(42, 12, NULL, 11, NULL, 'Sedia'),
(44, 12, 22, NULL, NULL, 'Sedia'),
(45, 12, 23, NULL, NULL, 'Sedia'),
(46, 12, 24, NULL, NULL, 'Sedia'),
(47, 12, 25, NULL, NULL, 'Sedia'),
(48, 12, 26, NULL, NULL, 'Sedia'),
(49, 12, 27, NULL, NULL, 'Sedia'),
(50, 12, 28, NULL, NULL, 'Sedia'),
(51, 12, 29, NULL, NULL, 'Sedia'),
(52, 17, 30, NULL, NULL, 'Sedia'),
(53, 17, 31, NULL, NULL, 'Sedia'),
(54, 17, 32, NULL, NULL, 'Sedia'),
(55, 17, 33, NULL, NULL, 'Sedia'),
(56, 17, 34, NULL, NULL, 'Sedia'),
(57, 17, 35, NULL, NULL, 'Sedia'),
(58, 17, 36, NULL, NULL, 'Sedia'),
(59, 17, 37, NULL, NULL, 'Sedia'),
(60, 17, 38, NULL, NULL, 'Sedia'),
(61, 17, 39, NULL, NULL, 'Sedia'),
(62, 11, NULL, 11, NULL, 'Monitor'),
(63, 11, 41, NULL, NULL, 'Monitor'),
(64, 11, 42, NULL, NULL, 'Monitor'),
(65, 11, 43, NULL, NULL, 'Monitor'),
(66, 11, 44, NULL, NULL, 'Monitor'),
(67, 11, 45, NULL, NULL, 'Monitor'),
(68, 11, 46, NULL, NULL, 'Monitor'),
(69, 11, 47, NULL, NULL, 'Monitor'),
(70, 11, 48, NULL, NULL, 'Monitor'),
(71, 11, 49, NULL, NULL, 'Monitor'),
(72, 11, NULL, 11, NULL, 'Tastiera'),
(73, 11, 51, NULL, NULL, 'Tastiera'),
(74, 11, 52, NULL, NULL, 'Tastiera'),
(75, 11, 53, NULL, NULL, 'Tastiera'),
(76, 11, 54, NULL, NULL, 'Tastiera'),
(77, 11, 55, NULL, NULL, 'Tastiera'),
(78, 11, 56, NULL, NULL, 'Tastiera'),
(79, 11, 57, NULL, NULL, 'Tastiera'),
(80, 11, 58, NULL, NULL, 'Tastiera'),
(81, 11, 59, NULL, NULL, 'Tastiera'),
(82, 11, NULL, 11, NULL, 'Mouse'),
(83, 11, 61, NULL, NULL, 'Mouse'),
(84, 11, 62, NULL, NULL, 'Mouse'),
(85, 11, 63, NULL, NULL, 'Mouse'),
(86, 11, 64, NULL, NULL, 'Mouse'),
(87, 11, 65, NULL, NULL, 'Mouse'),
(88, 11, 66, NULL, NULL, 'Mouse'),
(89, 11, 67, NULL, NULL, 'Mouse'),
(90, 11, 68, NULL, NULL, 'Mouse'),
(91, 11, 69, NULL, NULL, 'Mouse'),
(92, 11, NULL, 11, NULL, 'Router'),
(93, 11, 71, NULL, NULL, 'Router'),
(94, 11, 72, NULL, NULL, 'Router'),
(95, 11, 73, NULL, NULL, 'Router'),
(96, 11, 74, NULL, NULL, 'Router'),
(97, 11, NULL, 6, NULL, 'Router'),
(98, 11, 76, NULL, NULL, 'Router'),
(99, 11, 77, NULL, NULL, 'Router'),
(100, 11, 78, NULL, NULL, 'Router'),
(101, 11, 79, NULL, NULL, 'Router'),
(102, 11, NULL, 11, NULL, 'Termosifoni'),
(103, 11, 81, NULL, NULL, 'Termosifoni'),
(104, 11, 82, NULL, NULL, 'Termosifoni'),
(105, 11, 83, NULL, NULL, 'Termosifoni'),
(106, 11, 84, NULL, NULL, 'Termosifoni'),
(107, 11, 85, NULL, NULL, 'Termosifoni'),
(108, 11, 86, NULL, NULL, 'Termosifoni'),
(109, 11, 87, NULL, NULL, 'Termosifoni'),
(110, 11, 88, NULL, NULL, 'Termosifoni'),
(111, 11, 89, NULL, NULL, 'Termosifoni'),
(112, 17, NULL, 11, NULL, 'Cestino'),
(113, 17, 91, NULL, NULL, 'Cestino'),
(114, 17, 92, NULL, NULL, 'Cestino'),
(115, 17, 93, NULL, NULL, 'Cestino'),
(116, 17, 94, NULL, NULL, 'Cestino'),
(117, 17, 95, NULL, NULL, 'Cestino'),
(118, 17, 96, NULL, NULL, 'Cestino'),
(119, 17, 97, NULL, NULL, 'Cestino'),
(120, 17, 98, NULL, NULL, 'Cestino'),
(121, 17, 99, NULL, NULL, 'Cestino'),
(122, 16, 100, NULL, NULL, 'Scrivania'),
(123, 16, 101, NULL, NULL, 'Scrivania'),
(124, 16, 102, NULL, NULL, 'Scrivania'),
(125, 16, 103, NULL, NULL, 'Scrivania'),
(126, 16, 104, NULL, NULL, 'Scrivania'),
(127, 16, 105, NULL, NULL, 'Scrivania'),
(128, 16, 106, NULL, NULL, 'Scrivania'),
(129, 16, 107, NULL, NULL, 'Scrivania'),
(130, 16, 108, NULL, NULL, 'Scrivania'),
(131, 16, 109, NULL, NULL, 'Scrivania'),
(132, 16, 110, NULL, NULL, 'Cestino'),
(133, 16, 111, NULL, NULL, 'Cestino'),
(134, 16, 112, NULL, NULL, 'Cestino'),
(135, 16, 113, NULL, NULL, 'Cestino'),
(136, 16, 114, NULL, NULL, 'Cestino'),
(137, 16, 115, NULL, NULL, 'Cestino'),
(138, 16, 116, NULL, NULL, 'Cestino'),
(139, 16, 117, NULL, NULL, 'Cestino'),
(140, 16, 118, NULL, NULL, 'Cestino'),
(141, 16, 119, NULL, NULL, 'Cestino'),
(142, 11, NULL, 4, NULL, 'Switch'),
(143, 11, NULL, 11, NULL, 'Switch'),
(144, 11, 122, NULL, NULL, 'Switch'),
(145, 11, 123, NULL, NULL, 'Switch'),
(146, 11, 124, NULL, NULL, 'Switch'),
(147, 11, 125, NULL, NULL, 'Switch'),
(148, 11, 126, NULL, NULL, 'Switch'),
(149, 11, 127, NULL, NULL, 'Switch'),
(150, 11, 128, NULL, NULL, 'Switch'),
(151, 11, 129, NULL, NULL, 'Switch'),
(152, 12, NULL, 11, NULL, 'Porta'),
(153, 12, 131, NULL, NULL, 'Porta'),
(154, 12, 132, NULL, NULL, 'Porta'),
(155, 12, 133, NULL, NULL, 'Porta'),
(156, 12, 134, NULL, NULL, 'Porta'),
(157, 12, 135, NULL, NULL, 'Porta'),
(158, 12, 136, NULL, NULL, 'Porta'),
(160, 12, 138, NULL, NULL, 'Porta'),
(161, 12, 139, NULL, NULL, 'Porta'),
(162, 16, 140, NULL, NULL, 'Porta'),
(163, 16, 141, NULL, NULL, 'Porta'),
(164, 16, 142, NULL, NULL, 'Porta'),
(165, 16, 143, NULL, NULL, 'Porta'),
(166, 16, 144, NULL, NULL, 'Porta'),
(167, 16, 145, NULL, NULL, 'Porta'),
(168, 16, 146, NULL, NULL, 'Porta'),
(169, 16, 147, NULL, NULL, 'Porta'),
(170, 16, 148, NULL, NULL, 'Porta'),
(171, 16, 149, NULL, NULL, 'Porta'),
(172, 17, NULL, 17, NULL, 'Lavagna'),
(173, 17, 151, NULL, NULL, 'Lavagna'),
(174, 17, 152, NULL, NULL, 'Lavagna'),
(175, 17, 153, NULL, NULL, 'Lavagna'),
(176, 17, 154, NULL, NULL, 'Lavagna'),
(177, 17, 155, NULL, NULL, 'Lavagna'),
(178, 17, 156, NULL, NULL, 'Lavagna'),
(179, 17, 157, NULL, NULL, 'Lavagna'),
(180, 17, 158, NULL, NULL, 'Lavagna'),
(181, 17, 159, NULL, NULL, 'Lavagna'),
(182, 11, 160, NULL, NULL, 'Microfono'),
(183, 11, 161, NULL, NULL, 'Microfono'),
(184, 11, 162, NULL, NULL, 'Microfono'),
(185, 11, 163, NULL, NULL, 'Microfono'),
(186, 11, 164, NULL, NULL, 'Microfono'),
(187, 11, 165, NULL, NULL, 'Microfono'),
(188, 11, 166, NULL, NULL, 'Microfono'),
(189, 11, 167, NULL, NULL, 'Microfono'),
(190, 11, 168, NULL, NULL, 'Microfono'),
(191, 11, 169, NULL, NULL, 'Microfono'),
(192, 11, 170, NULL, NULL, 'Rubinetto'),
(193, 11, 171, NULL, NULL, 'Rubinetto'),
(194, 11, 172, NULL, NULL, 'Rubinetto'),
(195, 11, 173, NULL, NULL, 'Rubinetto'),
(196, 11, 174, NULL, NULL, 'Rubinetto'),
(197, 11, 175, NULL, NULL, 'Rubinetto'),
(198, 11, 176, NULL, NULL, 'Rubinetto'),
(199, 11, 177, NULL, NULL, 'Rubinetto'),
(200, 11, 178, NULL, NULL, 'Rubinetto'),
(201, 11, 179, NULL, NULL, 'Rubinetto'),
(203, 11, 181, NULL, NULL, 'Wc'),
(204, 11, 182, NULL, NULL, 'Wc'),
(205, 11, 183, NULL, NULL, 'Wc'),
(206, 11, 184, NULL, NULL, 'Wc'),
(207, 11, 185, NULL, NULL, 'Wc'),
(208, 11, 186, NULL, NULL, 'Wc'),
(209, 11, 187, NULL, NULL, 'Wc'),
(210, 11, 188, NULL, NULL, 'Wc'),
(211, 11, 189, NULL, NULL, 'Wc'),
(212, 14, NULL, 11, NULL, 'Lampadina'),
(213, 14, 191, NULL, NULL, 'Lampadina'),
(214, 14, 192, NULL, NULL, 'Lampadina'),
(215, 14, 193, NULL, NULL, 'Lampadina'),
(216, 14, 194, NULL, NULL, 'Lampadina'),
(217, 14, 195, NULL, NULL, 'Lampadina'),
(218, 14, 196, NULL, NULL, 'Lampadina'),
(219, 14, 197, NULL, NULL, 'Lampadina'),
(220, 14, 198, NULL, NULL, 'Lampadina'),
(221, 14, 199, NULL, NULL, 'Lampadina'),
(222, 13, NULL, 11, NULL, 'Lampadina'),
(223, 13, NULL, 11, NULL, 'Lampadina'),
(224, 13, 202, NULL, NULL, 'Lampadina'),
(225, 13, 203, NULL, NULL, 'Lampadina'),
(226, 13, 204, NULL, NULL, 'Lampadina'),
(227, 13, 205, NULL, NULL, 'Lampadina'),
(228, 13, 206, NULL, NULL, 'Lampadina'),
(229, 13, 207, NULL, NULL, 'Lampadina'),
(230, 13, 208, NULL, NULL, 'Lampadina'),
(231, 13, 209, NULL, NULL, 'Lampadina'),
(232, 11, 210, NULL, NULL, 'Lavandino'),
(233, 11, 211, NULL, NULL, 'Lavandino'),
(234, 11, 212, NULL, NULL, 'Lavandino'),
(235, 11, 213, NULL, NULL, 'Lavandino'),
(236, 11, 214, NULL, NULL, 'Lavandino'),
(237, 11, 215, NULL, NULL, 'Lavandino'),
(238, 11, 216, NULL, NULL, 'Lavandino'),
(239, 11, 217, NULL, NULL, 'Lavandino'),
(240, 11, 218, NULL, NULL, 'Lavandino'),
(241, 11, 219, NULL, NULL, 'Lavandino'),
(242, 11, 220, NULL, NULL, 'Lavandino'),
(243, 11, 221, NULL, NULL, 'Lavandino'),
(244, 11, 222, NULL, NULL, 'Lavandino'),
(245, 11, 223, NULL, NULL, 'Lavandino'),
(246, 11, 224, NULL, NULL, 'Lavandino'),
(247, 11, 225, NULL, NULL, 'Lavandino'),
(248, 11, 226, NULL, NULL, 'Lavandino'),
(249, 11, 227, NULL, NULL, 'Lavandino'),
(250, 11, 228, NULL, NULL, 'Lavandino'),
(251, 11, 229, NULL, NULL, 'Lavandino'),
(268, 12, NULL, NULL, NULL, 'Pisello'),
(270, 12, 239, NULL, NULL, 'Sedia'),
(271, 12, 240, NULL, NULL, 'Sedia'),
(272, 12, NULL, 1, NULL, 'Sedia');

-- --------------------------------------------------------

--
-- Struttura della tabella `ordine`
--

CREATE TABLE IF NOT EXISTS `ordine` (
  `ID_Ordine` int(5) NOT NULL AUTO_INCREMENT,
  `Mat_Direttore` int(6) NOT NULL,
  `ID_Fornitore` int(5) DEFAULT NULL,
  `Oggetto` varchar(50) NOT NULL,
  `Stato` enum('0','1','2') NOT NULL,
  PRIMARY KEY (`ID_Ordine`),
  KEY `Mat_Direttore` (`Mat_Direttore`),
  KEY `ID_Fornitore` (`ID_Fornitore`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=34 ;

--
-- Dump dei dati per la tabella `ordine`
--

INSERT INTO `ordine` (`ID_Ordine`, `Mat_Direttore`, `ID_Fornitore`, `Oggetto`, `Stato`) VALUES
(13, 467546, NULL, 'Monitor', '0');

-- --------------------------------------------------------

--
-- Struttura della tabella `personale`
--

CREATE TABLE IF NOT EXISTS `personale` (
  `Matricola` int(6) NOT NULL,
  `ID_Dip` int(5) NOT NULL,
  `Nome` varchar(30) NOT NULL,
  `Cognome` varchar(30) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Password` varchar(32) NOT NULL,
  PRIMARY KEY (`Matricola`),
  KEY `ID_Dip` (`ID_Dip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `personale`
--

INSERT INTO `personale` (`Matricola`, `ID_Dip`, `Nome`, `Cognome`, `Email`, `Password`) VALUES
(900597, 10, 'Giovanni', 'Verdi', 'gverdi@unime.it', '5dcc2d6e755be9119f0a24c1bef844f6');

-- --------------------------------------------------------

--
-- Struttura della tabella `piano`
--

CREATE TABLE IF NOT EXISTS `piano` (
  `ID_Piano` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Edificio` int(5) NOT NULL,
  `Nome` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_Piano`),
  KEY `ID_Edificio` (`ID_Edificio`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=22 ;

--
-- Dump dei dati per la tabella `piano`
--

INSERT INTO `piano` (`ID_Piano`, `ID_Edificio`, `Nome`) VALUES
(4, 11, '1'),
(5, 11, '2'),
(6, 16, '0'),
(7, 19, '0'),
(8, 19, '1'),
(9, 19, '2'),
(10, 19, '3'),
(11, 19, '4'),
(13, 17, '0'),
(14, 17, '1'),
(15, 17, '2'),
(16, 17, '3'),
(17, 17, '4'),
(18, 16, '1'),
(19, 16, 'Soppalco'),
(20, 11, '3'),
(21, 11, '4');

-- --------------------------------------------------------

--
-- Struttura della tabella `studente`
--

CREATE TABLE IF NOT EXISTS `studente` (
  `Matricola` int(6) NOT NULL,
  `ID_Dip` int(5) NOT NULL,
  `Nome` varchar(30) NOT NULL,
  `Cognome` varchar(30) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Password` varchar(32) NOT NULL,
  PRIMARY KEY (`Matricola`),
  KEY `ID_Dip` (`ID_Dip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `studente`
--

INSERT INTO `studente` (`Matricola`, `ID_Dip`, `Nome`, `Cognome`, `Email`, `Password`) VALUES
(470000, 10, 'Marco', 'Neri', 'mneri@unime.it', '782219e8e7e47153413fc0654285a052');

-- --------------------------------------------------------

--
-- Struttura della tabella `tipologia`
--

CREATE TABLE IF NOT EXISTS `tipologia` (
  `ID_Tipologia` int(11) NOT NULL AUTO_INCREMENT,
  `Tipo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_Tipologia`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=18 ;

--
-- Dump dei dati per la tabella `tipologia`
--

INSERT INTO `tipologia` (`ID_Tipologia`, `Tipo`) VALUES
(8, 'Bagno'),
(9, 'Laboratorio'),
(11, 'Corridoio'),
(13, 'Aula'),
(15, 'Biblioteca'),
(17, 'Ufficio');

-- --------------------------------------------------------

--
-- Struttura della tabella `universita`
--

CREATE TABLE IF NOT EXISTS `universita` (
  `ID_Uni` int(3) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(50) NOT NULL,
  `Citta` varchar(30) NOT NULL,
  PRIMARY KEY (`ID_Uni`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=3 ;

--
-- Dump dei dati per la tabella `universita`
--

INSERT INTO `universita` (`ID_Uni`, `Nome`, `Citta`) VALUES
(2, 'Universita degli studi di Messina', 'Messina');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
