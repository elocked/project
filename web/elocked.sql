-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 15 Juin 2015 à 10:53
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `elocked`
--

-- --------------------------------------------------------

--
-- Structure de la table `cadenas`
--

CREATE TABLE IF NOT EXISTS `cadenas` (
  `idCadenas` int(11) NOT NULL AUTO_INCREMENT,
  `idProprio` int(11) NOT NULL,
  `cleNFC` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idCadenas`),
  KEY `FK_Cadenas_idProprio` (`idProprio`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Contenu de la table `cadenas`
--

INSERT INTO `cadenas` (`idCadenas`, `idProprio`, `cleNFC`) VALUES
(3, 1, '164646'),
(4, 1, '5468'),
(5, 1, '65886'),
(6, 1, '65887'),
(7, 1, '65888'),
(8, 1, '65889'),
(9, 1, '65866'),
(10, 1, '67986'),
(11, 1, '61286'),
(12, 1, '65478'),
(13, 2, '1769');

-- --------------------------------------------------------

--
-- Structure de la table `demande`
--

CREATE TABLE IF NOT EXISTS `demande` (
  `id_demande` int(11) NOT NULL AUTO_INCREMENT,
  `idPersonne` int(11) NOT NULL,
  `idCadenas` int(11) NOT NULL,
  `Heure_debut` datetime DEFAULT NULL,
  `Heure_fin` datetime DEFAULT NULL,
  `Date_demande` datetime DEFAULT NULL,
  PRIMARY KEY (`id_demande`),
  KEY `FK_Demande_idPersonne` (`idPersonne`),
  KEY `FK_Demande_idCadenas` (`idCadenas`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=332 ;

--
-- Contenu de la table `demande`
--

INSERT INTO `demande` (`id_demande`, `idPersonne`, `idCadenas`, `Heure_debut`, `Heure_fin`, `Date_demande`) VALUES
(322, 1, 13, '2015-06-09 10:00:00', '2015-06-09 11:00:00', '2015-06-09 09:36:24'),
(323, 1, 13, '2015-06-09 12:00:00', '2015-06-09 14:00:00', '2015-06-09 11:16:00'),
(325, 2, 12, '2015-06-12 16:34:00', '2015-06-12 17:34:00', '2015-06-12 16:35:01'),
(326, 2, 11, '2015-06-12 16:40:00', '2015-06-13 17:40:00', '2015-06-12 16:40:32'),
(327, 2, 12, '2015-06-12 16:42:00', '2015-06-13 14:50:00', '2015-06-12 16:42:58'),
(328, 2, 11, '2015-06-12 16:47:00', '2015-06-28 22:45:00', '2015-06-12 16:48:00'),
(329, 2, 10, '2015-06-12 16:53:00', '2015-06-28 21:50:00', '2015-06-12 16:53:42'),
(330, 2, 9, '2015-06-12 16:54:00', '2015-06-19 18:25:00', '2015-06-12 16:54:50'),
(331, 2, 7, '2015-06-12 16:58:00', '2015-06-19 00:00:00', '2015-06-12 16:59:07');

-- --------------------------------------------------------

--
-- Structure de la table `emprunt`
--

CREATE TABLE IF NOT EXISTS `emprunt` (
  `idEmprunt` int(11) NOT NULL AUTO_INCREMENT,
  `DebutEmprunt` datetime NOT NULL,
  `FinEmprunt` datetime NOT NULL,
  `idCadenas` int(11) NOT NULL,
  `idPersonne` int(11) NOT NULL,
  PRIMARY KEY (`idEmprunt`),
  KEY `FK_Emprunt_idCadenas` (`idCadenas`),
  KEY `FK_Emprunt_idPersonne` (`idPersonne`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Contenu de la table `emprunt`
--

INSERT INTO `emprunt` (`idEmprunt`, `DebutEmprunt`, `FinEmprunt`, `idCadenas`, `idPersonne`) VALUES
(8, '2015-06-09 11:05:00', '2015-06-09 11:35:00', 7, 1),
(9, '2015-06-09 11:00:00', '2015-06-09 18:00:00', 3, 1),
(10, '2015-06-09 18:00:00', '2015-06-09 19:00:00', 8, 1),
(11, '2015-06-09 18:00:00', '2015-06-09 19:00:00', 12, 1),
(12, '2015-06-09 18:00:00', '2015-06-09 19:00:00', 11, 1),
(13, '2015-06-09 12:00:00', '2015-06-09 15:00:00', 12, 1),
(14, '2015-06-09 15:00:00', '2015-06-09 16:00:00', 9, 1),
(15, '2015-06-09 15:00:00', '2015-06-09 01:00:00', 8, 1),
(16, '2015-06-09 16:00:00', '2015-06-09 22:00:00', 8, 1),
(17, '2015-06-09 02:00:00', '2015-06-09 03:00:00', 6, 1),
(18, '2015-06-09 17:00:00', '2015-06-09 18:00:00', 3, 1),
(19, '2015-06-09 10:00:00', '2015-06-09 11:00:00', 6, 1),
(20, '2015-06-09 10:00:00', '2015-06-09 11:00:00', 5, 1),
(21, '2015-06-09 12:00:00', '2015-06-09 13:00:00', 6, 1),
(22, '2015-06-12 16:40:00', '2015-06-13 17:40:00', 11, 2),
(23, '2015-06-12 16:34:00', '2015-06-12 17:34:00', 12, 2),
(24, '2015-06-12 16:42:00', '2015-06-13 14:50:00', 12, 2),
(25, '2015-06-12 16:47:00', '2015-06-28 22:45:00', 11, 2),
(26, '2015-06-12 16:53:00', '2015-06-28 21:50:00', 10, 2),
(27, '2015-06-12 16:54:00', '2015-06-19 18:25:00', 9, 2),
(28, '2015-06-12 16:58:00', '2015-06-19 00:00:00', 7, 2);

-- --------------------------------------------------------

--
-- Structure de la table `etatcadenas`
--

CREATE TABLE IF NOT EXISTS `etatcadenas` (
  `idCadenas` int(11) NOT NULL AUTO_INCREMENT,
  `Longitude` float DEFAULT NULL,
  `Latitude` float DEFAULT NULL,
  `Dispo` tinyint(1) NOT NULL,
  PRIMARY KEY (`idCadenas`),
  KEY `FK_Cadenas_idCadenas` (`idCadenas`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Contenu de la table `etatcadenas`
--

INSERT INTO `etatcadenas` (`idCadenas`, `Longitude`, `Latitude`, `Dispo`) VALUES
(3, 2.583, 48.8388, 1),
(4, 2.583, 48.8358, 1),
(5, 2.585, 48.8358, 1),
(6, 2.585, 48.8388, 1),
(7, 2.587, 48.8388, 0),
(8, 2.587, 48.8398, 1),
(9, 2.587, 48.8408, 0),
(10, 2.585, 48.8408, 0),
(11, 2.586, 48.8418, 0),
(12, 2.584, 48.8428, 0),
(13, 2.584, 48.8357, 1);

-- --------------------------------------------------------

--
-- Structure de la table `notif`
--

CREATE TABLE IF NOT EXISTS `notif` (
  `id_notif` int(11) NOT NULL AUTO_INCREMENT,
  `id_demande` int(11) NOT NULL,
  `valide` int(2) DEFAULT NULL,
  `vu` int(2) DEFAULT NULL,
  `Date_notif` datetime DEFAULT NULL,
  PRIMARY KEY (`id_notif`),
  KEY `FK_Notif_id_demande` (`id_demande`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Contenu de la table `notif`
--

INSERT INTO `notif` (`id_notif`, `id_demande`, `valide`, `vu`, `Date_notif`) VALUES
(18, 325, 1, 1, '2015-06-12 16:35:01'),
(19, 326, 1, 1, '2015-06-12 16:40:32'),
(20, 327, 1, 1, '2015-06-12 16:42:58'),
(21, 328, 1, 1, '2015-06-12 16:48:00'),
(22, 329, 1, 1, '2015-06-12 16:53:42'),
(23, 330, 1, 1, '2015-06-12 16:54:50'),
(24, 331, NULL, 0, '2015-06-12 16:59:07');

-- --------------------------------------------------------

--
-- Structure de la table `personne`
--

CREATE TABLE IF NOT EXISTS `personne` (
  `idPersonne` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `numtel` int(255) NOT NULL,
  `note` int(4) DEFAULT NULL,
  `mdp` varchar(255) NOT NULL,
  `numCB` varchar(255) NOT NULL,
  `DateCrea` datetime DEFAULT NULL,
  PRIMARY KEY (`idPersonne`),
  UNIQUE KEY `mail` (`mail`,`numtel`,`numCB`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `personne`
--

INSERT INTO `personne` (`idPersonne`, `nom`, `prenom`, `mail`, `numtel`, `note`, `mdp`, `numCB`, `DateCrea`) VALUES
(1, 'padel', 'alexandre', 'alex.1277@hotmail.fr', 645698975, 4, '$2y$10$jxZSiE.D2N.B.6ywR2hLLeW/qneHMLuGk7z4LkKnrDMCn.knRtXLG', '$2y$10$t7MEIiqVznRh79AnxnmlHOJghLmt1rzNm5C4BMEZv/3/5z9fZtkBu', '2015-05-12 16:38:53'),
(2, 'monfort', 'nelson', 'nelson@test.com', 103020605, 3, '$2y$10$URIhMjdsQ96ESIfPtAUhvus9.iS778B1J9WjTkvE5brEhl6DHY.ta', '$2y$10$eGjvl3mGFZcrpGqxn7G1dOyHYiA7KcEw46HxBHRorEVJLqmAUQe3q', '2015-06-05 15:37:18');

-- --------------------------------------------------------

--
-- Structure de la table `proprietaire`
--

CREATE TABLE IF NOT EXISTS `proprietaire` (
  `idProprio` int(11) NOT NULL,
  PRIMARY KEY (`idProprio`),
  KEY `FK_Proprietaire_idProprio` (`idProprio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `proprietaire`
--

INSERT INTO `proprietaire` (`idProprio`) VALUES
(1),
(2);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `cadenas`
--
ALTER TABLE `cadenas`
  ADD CONSTRAINT `FK_Cadenas_idProprio` FOREIGN KEY (`idProprio`) REFERENCES `proprietaire` (`idProprio`);

--
-- Contraintes pour la table `demande`
--
ALTER TABLE `demande`
  ADD CONSTRAINT `FK_Demande_idCadenas` FOREIGN KEY (`idCadenas`) REFERENCES `cadenas` (`idCadenas`),
  ADD CONSTRAINT `FK_Demande_idPersonne` FOREIGN KEY (`idPersonne`) REFERENCES `personne` (`idPersonne`);

--
-- Contraintes pour la table `emprunt`
--
ALTER TABLE `emprunt`
  ADD CONSTRAINT `FK_Emprunt_idCadenas` FOREIGN KEY (`idCadenas`) REFERENCES `cadenas` (`idCadenas`),
  ADD CONSTRAINT `FK_Emprunt_idPersonne` FOREIGN KEY (`idPersonne`) REFERENCES `personne` (`idPersonne`);

--
-- Contraintes pour la table `etatcadenas`
--
ALTER TABLE `etatcadenas`
  ADD CONSTRAINT `FK_Cadenas_idCadenas` FOREIGN KEY (`idCadenas`) REFERENCES `cadenas` (`idCadenas`);

--
-- Contraintes pour la table `notif`
--
ALTER TABLE `notif`
  ADD CONSTRAINT `FK_Notif_id_demande` FOREIGN KEY (`id_demande`) REFERENCES `demande` (`id_demande`);

--
-- Contraintes pour la table `proprietaire`
--
ALTER TABLE `proprietaire`
  ADD CONSTRAINT `FK_Proprietaire_idProprio` FOREIGN KEY (`idProprio`) REFERENCES `personne` (`idPersonne`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
