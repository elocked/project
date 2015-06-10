-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 09 Juin 2015 à 13:51
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
  `Heure_debut` time DEFAULT NULL,
  `Heure_fin` time DEFAULT NULL,
  `Date_demande` datetime DEFAULT NULL,
  PRIMARY KEY (`id_demande`),
  KEY `FK_Demande_idPersonne` (`idPersonne`),
  KEY `FK_Demande_idCadenas` (`idCadenas`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=325 ;

--
-- Contenu de la table `demande`
--

INSERT INTO `demande` (`id_demande`, `idPersonne`, `idCadenas`, `Heure_debut`, `Heure_fin`, `Date_demande`) VALUES
(303, 1, 8, '11:30:00', '12:00:00', '2015-05-28 11:28:47'),
(304, 1, 7, '11:00:00', '13:00:00', '2015-06-02 10:27:21'),
(305, 1, 6, '16:00:00', '17:00:00', '2015-06-02 15:21:35'),
(306, 1, 12, '18:00:00', '19:00:00', '2015-06-02 17:05:01'),
(307, 1, 6, '03:02:00', '05:01:00', '2015-06-02 17:14:52'),
(308, 1, 7, '11:05:00', '11:35:00', '2015-06-03 11:05:01'),
(309, 1, 3, '11:00:00', '18:00:00', '2015-06-04 10:06:58'),
(310, 1, 8, '18:00:00', '19:00:00', '2015-06-04 17:11:33'),
(311, 1, 12, '18:00:00', '19:00:00', '2015-06-04 17:26:15'),
(312, 1, 11, '18:00:00', '19:00:00', '2015-06-04 17:27:42'),
(313, 1, 12, '12:00:00', '15:00:00', '2015-06-05 11:29:58'),
(314, 1, 9, '15:00:00', '16:00:00', '2015-06-05 14:40:00'),
(315, 1, 8, '15:00:00', '01:00:00', '2015-06-05 14:43:40'),
(316, 1, 8, '16:00:00', '22:00:00', '2015-06-05 15:21:15'),
(317, 1, 6, '02:00:00', '03:00:00', '2015-06-07 01:14:01'),
(318, 2, 3, '17:00:00', '18:00:00', '2015-06-08 16:41:08'),
(319, 2, 3, '17:00:00', '18:00:00', '2015-06-08 16:45:30'),
(320, 2, 6, '10:00:00', '11:00:00', '2015-06-09 09:22:08'),
(321, 2, 5, '10:00:00', '11:00:00', '2015-06-09 09:34:28'),
(322, 1, 13, '10:00:00', '11:00:00', '2015-06-09 09:36:24'),
(323, 1, 13, '12:00:00', '14:00:00', '2015-06-09 11:16:00'),
(324, 2, 6, '12:00:00', '13:00:00', '2015-06-09 11:50:28');

-- --------------------------------------------------------

--
-- Structure de la table `emprunt`
--

CREATE TABLE IF NOT EXISTS `emprunt` (
  `idEmprunt` int(11) NOT NULL AUTO_INCREMENT,
  `DebutEmprunt` time NOT NULL,
  `FinEmprunt` time NOT NULL,
  `Duree` time NOT NULL,
  `idCadenas` int(11) NOT NULL,
  `idPersonne` int(11) NOT NULL,
  PRIMARY KEY (`idEmprunt`),
  KEY `FK_Emprunt_idCadenas` (`idCadenas`),
  KEY `FK_Emprunt_idPersonne` (`idPersonne`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Contenu de la table `emprunt`
--

INSERT INTO `emprunt` (`idEmprunt`, `DebutEmprunt`, `FinEmprunt`, `Duree`, `idCadenas`, `idPersonne`) VALUES
(8, '11:05:00', '11:35:00', '00:30:00', 7, 1),
(9, '11:00:00', '18:00:00', '01:00:00', 3, 1),
(10, '18:00:00', '19:00:00', '01:00:00', 8, 1),
(11, '18:00:00', '19:00:00', '01:00:00', 12, 1),
(12, '18:00:00', '19:00:00', '01:00:00', 11, 1),
(13, '12:00:00', '15:00:00', '03:00:00', 12, 1),
(14, '15:00:00', '16:00:00', '01:00:00', 9, 1),
(15, '15:00:00', '01:00:00', '10:00:00', 8, 1),
(16, '16:00:00', '22:00:00', '06:00:00', 8, 1),
(17, '02:00:00', '03:00:00', '01:00:00', 6, 1),
(18, '17:00:00', '18:00:00', '01:00:00', 3, 1),
(19, '10:00:00', '11:00:00', '01:00:00', 6, 1),
(20, '10:00:00', '11:00:00', '01:00:00', 5, 1),
(21, '12:00:00', '13:00:00', '01:00:00', 6, 1);

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
(6, 2.585, 48.8388, 0),
(7, 2.587, 48.8388, 1),
(8, 2.587, 48.8398, 1),
(9, 2.587, 48.8408, 1),
(10, 2.585, 48.8408, 1),
(11, 2.586, 48.8418, 1),
(12, 2.584, 48.8428, 1),
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Contenu de la table `notif`
--

INSERT INTO `notif` (`id_notif`, `id_demande`, `valide`, `vu`, `Date_notif`) VALUES
(1, 308, 1, 1, '2015-06-03 11:05:01'),
(2, 309, 1, 1, '2015-06-04 10:06:58'),
(3, 310, 1, 1, '2015-06-04 17:11:34'),
(4, 311, 1, 1, '2015-06-04 17:26:15'),
(5, 312, 1, 1, '2015-06-04 17:27:42'),
(6, 313, 1, 1, '2015-06-05 11:29:58'),
(7, 314, 1, 1, '2015-06-05 14:40:00'),
(8, 315, 1, 1, '2015-06-05 14:43:40'),
(9, 316, 1, 1, '2015-06-05 15:21:15'),
(10, 317, 1, 1, '2015-06-07 01:14:01'),
(12, 319, 1, 1, '2015-06-08 16:45:30'),
(13, 320, 1, 1, '2015-06-09 09:22:08'),
(14, 321, 1, 1, '2015-06-09 09:34:28'),
(16, 323, 1, 1, '2015-06-09 11:16:00'),
(17, 324, 1, 1, '2015-06-09 11:50:29');

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
