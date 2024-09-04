-- Adminer 4.8.1 MySQL 5.5.5-10.6.16-MariaDB-0ubuntu0.22.04.1 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `etat`;
CREATE TABLE `etat` (
  `ETA_ID` char(2) NOT NULL,
  `ETA_LIB` varchar(30) NOT NULL,
  PRIMARY KEY (`ETA_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_general_ci;

INSERT INTO `etat` (`ETA_ID`, `ETA_LIB`) VALUES
('CL',	'Saisie clôturée'),
('CR',	'Fiche créée, saisie en cours'),
('NV',	'Non validée'),
('RB',	'Remboursée'),
('VA',	'Validée et mise en paiement');

DROP TABLE IF EXISTS `fiche_frais`;
CREATE TABLE `fiche_frais` (
  `FFR_ID` int(2) NOT NULL AUTO_INCREMENT,
  `VIS_ID` char(4) NOT NULL,
  `ETA_ID` char(2) NOT NULL,
  `FRR_ANNEE` char(4) NOT NULL,
  `FRR_MOIS` enum('JANVIER','FEVRIER','MARS','AVRIL','MAI','JUIN','JUILLET','AOUT','SEPTEMBRE','OCTOBRE','NOVEMBRE','DECEMBRE') NOT NULL,
  `FRR_MONTANT_VALIDE` decimal(10,2) NOT NULL,
  `FRR_NB_JUSTIFICATIFS` int(11) NOT NULL,
  `FRR_DATE_MODIF` date NOT NULL,
  PRIMARY KEY (`FFR_ID`),
  KEY `VIS_ID` (`VIS_ID`),
  KEY `ETA_ID` (`ETA_ID`),
  CONSTRAINT `fiche_frais_ibfk_2` FOREIGN KEY (`VIS_ID`) REFERENCES `visiteur` (`VIS_ID`) ON DELETE CASCADE,
  CONSTRAINT `fiche_frais_ibfk_3` FOREIGN KEY (`ETA_ID`) REFERENCES `etat` (`ETA_ID`) ON DELETE CASCADE,
  CONSTRAINT `fiche_frais_ibfk_4` FOREIGN KEY (`FFR_ID`) REFERENCES `ligne_frais_forfait` (`FFR_ID`) ON DELETE CASCADE,
  CONSTRAINT `fiche_frais_ibfk_5` FOREIGN KEY (`FFR_ID`) REFERENCES `ligne_frais_forfait` (`FFR_ID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_general_ci;

INSERT INTO `fiche_frais` (`FFR_ID`, `VIS_ID`, `ETA_ID`, `FRR_ANNEE`, `FRR_MOIS`, `FRR_MONTANT_VALIDE`, `FRR_NB_JUSTIFICATIFS`, `FRR_DATE_MODIF`) VALUES
(255,	'CaVi',	'CR',	'2024',	'AVRIL',	53.00,	6,	'2023-03-15'),
(4999,	'LaMa',	'NV',	'2020',	'FEVRIER',	0.00,	2,	'2021-05-02');

DROP TABLE IF EXISTS `frais_forfait`;
CREATE TABLE `frais_forfait` (
  `FOR_ID` char(3) NOT NULL,
  `FOR_LIB` char(20) NOT NULL,
  `FOR_MONTANT` decimal(52,0) NOT NULL,
  PRIMARY KEY (`FOR_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_general_ci;

INSERT INTO `frais_forfait` (`FOR_ID`, `FOR_LIB`, `FOR_MONTANT`) VALUES
('ETP',	'Forfait Etape',	110),
('KM',	'Frais Kilométrique',	1),
('NUI',	'Nuitée Hôtel',	80),
('REP',	'Repas Restaurant',	25);

DROP TABLE IF EXISTS `ligne_frais_forfait`;
CREATE TABLE `ligne_frais_forfait` (
  `FFR_ID` int(11) NOT NULL,
  `FOR_ID` char(3) NOT NULL,
  `LIG_QTE` int(11) NOT NULL,
  PRIMARY KEY (`FFR_ID`,`FOR_ID`),
  KEY `fk_ligneFraisForfait` (`FOR_ID`),
  CONSTRAINT `fk_FOR_ID` FOREIGN KEY (`FOR_ID`) REFERENCES `frais_forfait` (`FOR_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_general_ci;

INSERT INTO `ligne_frais_forfait` (`FFR_ID`, `FOR_ID`, `LIG_QTE`) VALUES
(1,	'ETP',	660),
(1,	'REP',	6),
(223,	'ETP',	660),
(255,	'ETP',	1),
(255,	'KM',	1),
(255,	'NUI',	1),
(255,	'REP',	1),
(356,	'ETP',	2),
(356,	'KM',	2),
(356,	'NUI',	2),
(356,	'REP',	2),
(4999,	'ETP',	660),
(4999,	'KM',	6),
(4999,	'NUI',	6),
(4999,	'REP',	6);

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `LIGNE_FRAIS_HORS_FORFAIT11`;
CREATE TABLE `LIGNE_FRAIS_HORS_FORFAIT11` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FFR_ID` int(11) NOT NULL,
  `DTE` char(3) NOT NULL,
  `LIBELLE` varchar(250) NOT NULL,
  `MONTANT` decimal(10,2) NOT NULL,
  `ETA_ID` char(2) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_LIGNE_FHF_FICHEFRAIS55` (`FFR_ID`),
  KEY `ETA_ID` (`ETA_ID`),
  CONSTRAINT `FK_LIGNE_FHF_FICHEFRAIS55` FOREIGN KEY (`FFR_ID`) REFERENCES `fiche_frais` (`FFR_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `LIGNE_FRAIS_HORS_FORFAIT11` (`ID`, `FFR_ID`, `DTE`, `LIBELLE`, `MONTANT`, `ETA_ID`) VALUES
(2,	255,	'03',	'teste',	150.00,	'VA'),
(3,	4999,	'30',	'teste',	150.00,	'VA'),
(8,	255,	'09',	'Bonj',	14.00,	'CR');

DROP TABLE IF EXISTS `LIGNE_FRAIS_HORS_FORFAIT2`;
CREATE TABLE `LIGNE_FRAIS_HORS_FORFAIT2` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FFR_ID` int(11) NOT NULL,
  `DTE` char(3) CHARACTER SET utf16 COLLATE utf16_general_ci NOT NULL,
  `LIBELLE` varchar(250) CHARACTER SET utf16 COLLATE utf16_general_ci NOT NULL,
  `MONTANT` decimal(10,2) NOT NULL,
  `ETA_ID` char(2) CHARACTER SET utf16 COLLATE utf16_general_ci NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_LIGNE_FHF_FICHEFRAIS` (`FFR_ID`),
  KEY `ETA_ID` (`ETA_ID`),
  CONSTRAINT `LIGNE_FRAIS_HORS_FORFAIT2_ibfk_1` FOREIGN KEY (`ETA_ID`) REFERENCES `etat` (`ETA_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `LIGNE_FRAIS_HORS_FORFAIT2` (`ID`, `FFR_ID`, `DTE`, `LIBELLE`, `MONTANT`, `ETA_ID`) VALUES
(1,	25,	'',	'test1',	100.00,	'CR'),
(2,	26,	'te',	'test2',	14.00,	'CR'),
(3,	17,	'',	'test3',	19.00,	'CR'),
(4,	29,	'',	'test4',	25.00,	'CR'),
(5,	28,	'',	'test4',	200.00,	'CR');

DROP TABLE IF EXISTS `LIGNE_FRAIS_HORS_FORFAIT_BA`;
CREATE TABLE `LIGNE_FRAIS_HORS_FORFAIT_BA` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FFR_ID` int(11) NOT NULL,
  `DTE` date NOT NULL,
  `LIBELLE` varchar(250) CHARACTER SET utf16 COLLATE utf16_general_ci NOT NULL,
  `MONTANT` decimal(10,2) NOT NULL,
  `ETA_ID` char(2) CHARACTER SET utf16 COLLATE utf16_general_ci NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_LIGNE_FHF_ETAT` (`ETA_ID`),
  KEY `FFR_ID` (`FFR_ID`),
  CONSTRAINT `FK_LIGNE_FHF_ETAT` FOREIGN KEY (`ETA_ID`) REFERENCES `etat` (`ETA_ID`),
  CONSTRAINT `LIGNE_FRAIS_HORS_FORFAIT_BA_ibfk_1` FOREIGN KEY (`FFR_ID`) REFERENCES `fiche_frais` (`FFR_ID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `LIGNE_FRAIS_HORS_FORFAIT_BA` (`ID`, `FFR_ID`, `DTE`, `LIBELLE`, `MONTANT`, `ETA_ID`) VALUES
(48,	255,	'2024-04-11',	'h',	12.00,	'CR');

DROP TABLE IF EXISTS `USER`;
CREATE TABLE `USER` (
  `id` char(4) CHARACTER SET utf16 COLLATE utf16_general_ci NOT NULL,
  `login` varchar(30) NOT NULL,
  `password` varchar(18) NOT NULL,
  `dteConnexion` date DEFAULT NULL,
  `role` enum('comptable','administrateur','visiteur') NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_usr` FOREIGN KEY (`id`) REFERENCES `visiteur` (`VIS_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `USER` (`id`, `login`, `password`, `dteConnexion`, `role`) VALUES
('CaVi',	'Victorca',	'Iroise29',	NULL,	'visiteur'),
('LaMa',	'IMANE',	'IMA*',	NULL,	'comptable'),
('test',	'Imane',	'Iroise291',	NULL,	'comptable'),
('WMRR',	'Imane',	'Iroise29',	NULL,	'administrateur');

DROP TABLE IF EXISTS `visiteur`;
CREATE TABLE `visiteur` (
  `VIS_ID` char(4) NOT NULL,
  `VIS_NOM` char(60) NOT NULL,
  `VIS_PRENOM` char(60) NOT NULL,
  `VIS_ADRESSE` char(60) DEFAULT NULL,
  `VIS_CP` char(5) DEFAULT NULL,
  `VIS_VILLE` char(60) DEFAULT NULL,
  `VIS_DATE_EMBAUCHE` date DEFAULT NULL,
  PRIMARY KEY (`VIS_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_general_ci;

INSERT INTO `visiteur` (`VIS_ID`, `VIS_NOM`, `VIS_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATE_EMBAUCHE`) VALUES
('CaVi',	'Caron\r\n',	'Victor\r\n',	'11 sq Luxembourg \r\n',	'20243',	'ISOLACCIO DI FIUMORBO',	NULL),
('ChLo',	'Chevallier\r\n',	'Lorenzo\r\n',	'17 r Lyon \r\n',	'55190',	'BOVEE SUR BARBOURE',	NULL),
('CoVi',	'Cousin\r\n',	'Victor\r\n',	'3 r Paris \r\n',	'07300',	'MAUVES',	NULL),
('DaCo',	'David\r\n',	'Colin\r\n',	'Et 3 6 r Loctudy \r\n',	'42170',	'CHAMBLES',	NULL),
('DuBe',	'Duval\r\n',	'Benjamin\r\n',	'3 r Victor Eusen \r\n',	'02590',	'FLUQUIERES',	NULL),
('FiEs',	'Fischer\r\n',	'Esteban\r\n',	'25 r Django Reinhardt \r\n',	'55220',	'VADELAINCOURT',	NULL),
('FrAr',	'Francois\r\n',	'Arthur\r\n',	'36 r Champagne \r\n',	'45490',	'TREILLES EN GATINAIS',	NULL),
('FrMo',	'Francois\r\n',	'Mohamed\r\n',	'13 r Aristide Briand \r\n',	'44710',	'PORT ST PERE',	NULL),
('GoKy',	'Gonzalez\r\n',	'Kylian\r\n',	'3 all Lavais \r\n',	'32430',	'ROQUELAURE ST AUBIN',	NULL),
('GuNo',	'Guillou\r\n',	'Noah\r\n',	'207 r Gouesnou \r\n',	'51300',	'FRIGNICOURT',	NULL),
('LaAl',	'Launay\r\n',	'Alexandre\r\n',	'8 r Navarin \r\n',	'30580',	'VALLERARGUES',	NULL),
('LaAn',	'Lacroix\r\n',	'Antoine\r\n',	'3 r Kersaint \r\n',	'16350',	'CHAMPAGNE MOUTON',	NULL),
('LaMa',	'Lamy\r\n',	'Maxime\r\n',	'92 r Richelieu \r\n',	'14410',	'VALDALLIERE',	'2018-09-24'),
('LeDi',	'Lecomte\r\n',	'Dimitri\r\n',	'17 r Lyon \r\n',	'10110',	'MAGNANT',	NULL),
('LeLo',	'Leclercq\r\n',	'Lorenzo\r\n',	'8 r Yves Collet\r\n',	'29260',	'ST MEEN',	NULL),
('MeAd',	'Meunier\r\n',	'Adrien\r\n',	'8 r Navarin \r\n',	'17770',	'VILLARS LES BOIS',	NULL),
('MeTo',	'Menard\r\n',	'Tom\r\n',	'3 r Michel Ollivier \r\n',	'62770',	'AUCHY LES HESDIN',	NULL),
('NaNi',	'Navarro\r\n',	'Nicolas\r\n',	'Le Grand Large 2 quai Douane \r\n',	'85200',	'DOIX LES FONTAINES',	NULL),
('SaBe',	'Sauvage\r\n',	'Benjamin\r\n',	'2 r Pablo Neruda \r\n',	'50440',	'LA HAGUE',	NULL),
('ScDy',	'Schneider\r\n',	'Dylan\r\n',	'3 r Anjou \r\n',	'14430',	'HOTOT EN AUGE',	NULL),
('test',	'test',	'Antoto',	'1 rue d\'une ville',	'29200',	'brest',	'2020-09-04'),
('VaMo',	'Vaillant\r\n',	'Mohamed\r\n',	'Et 3 6 r Loctudy \r\n',	'04230',	'FONTIENNE',	NULL),
('ViDo',	'Vidal\r\n',	'Dorian\r\n',	'207 r Gouesnou \r\n',	'54380',	'BEZAUMONT',	NULL),
('WMRR',	'OUAMAR',	'Imane',	'8 rue du four',	'29200',	'Brest',	'2018-09-08');

-- 2024-09-04 17:44:11
