-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 20 Mai 2015 à 15:19
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

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
(12, 1, '65478');

-- --------------------------------------------------------

--
-- Structure de la table `emprunt`
--

CREATE TABLE IF NOT EXISTS `emprunt` (
  `idEmprunt` int(11) NOT NULL AUTO_INCREMENT,
  `Demande` datetime NOT NULL,
  `DebutEmprunt` datetime NOT NULL,
  `FinEmprunt` datetime NOT NULL,
  `Duree` timestamp NOT NULL,
  `idCadenas` int(11) NOT NULL,
  PRIMARY KEY (`idEmprunt`),
  KEY `FK_Emprunt_idCadenas` (`idCadenas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `etatcadenas`
--

INSERT INTO `etatcadenas` (`idCadenas`, `Longitude`, `Latitude`, `Dispo`) VALUES
(3, 2.583, 48.8388, 1),
(4, 2.583, 48.8358, 1),
(5, 2.585, 48.8358, 1),
(6, 2.585, 48.8388, 1),
(7, 2.587, 48.8388, 1),
(8, 2.587, 48.8398, 1),
(9, 2.587, 48.8408, 1),
(10, 2.585, 48.8408, 1),
(11, 2.586, 48.8418, 1),
(12, 2.584, 48.8428, 1);

-- --------------------------------------------------------

--
-- Structure de la table `personne`
--

CREATE TABLE IF NOT EXISTS `personne` (
  `idPersonne` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `numtel` varchar(255) NOT NULL,
  `note` int(4) DEFAULT NULL,
  `mdp` varchar(255) NOT NULL,
  `numCB` varchar(255) NOT NULL,
  `DateCrea` datetime DEFAULT NULL,
  PRIMARY KEY (`idPersonne`),
  UNIQUE KEY `mail` (`mail`,`numtel`,`numCB`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `personne`
--

INSERT INTO `personne` (`idPersonne`, `nom`, `prenom`, `mail`, `numtel`, `note`, `mdp`, `numCB`, `DateCrea`) VALUES
(1, 'padel', 'alexandre', 'alex.1277@hotmail.fr', '0645698975', NULL, '$2y$10$jxZSiE.D2N.B.6ywR2hLLeW/qneHMLuGk7z4LkKnrDMCn.knRtXLG', '$2y$10$t7MEIiqVznRh79AnxnmlHOJghLmt1rzNm5C4BMEZv/3/5z9fZtkBu', '2015-05-12 16:38:53');

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
(1);


-- -------------------------------------------------------


CREATE TABLE IF NOT EXISTS `demande` (
  `id_demande` int(11) NOT NULL AUTO_INCREMENT,
  `idPersonne` int(11) NOT NULL,
  `idCadenas`  int(11) NOT NULL,
  `Heure_debut` time DEFAULT NULL,
  `Heure_fin` time DEFAULT NULL,
  `Date_demande` datetime DEFAULT NULL,
  PRIMARY KEY (`id_demande`),
  KEY `FK_Demande_idPersonne` (`idPersonne`),
  KEY `FK_Demande_idCadenas` (`idCadenas`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- ------------------------------------------------------------


CREATE TABLE IF NOT EXISTS `notif` (
  `id_notif` int(11) NOT NULL AUTO_INCREMENT,
  `id_demande` int(11) NOT NULL,
  `valide`  int(2)  DEFAULT NULL,
  `vu` int(2) DEFAULT NULL,
  `Date_notif` datetime DEFAULT NULL,
  PRIMARY KEY (`id_notif`),
  KEY `FK_Notif_id_demande` (`id_demande`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


-- -----------------------------------------------------------------


--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `cadenas`
--
ALTER TABLE `cadenas`
  ADD CONSTRAINT `FK_Cadenas_idProprio` FOREIGN KEY (`idProprio`) REFERENCES `proprietaire` (`idProprio`);

--
-- Contraintes pour la table `emprunt`
--
ALTER TABLE `emprunt`
  ADD CONSTRAINT `FK_Emprunt_idCadenas` FOREIGN KEY (`idCadenas`) REFERENCES `cadenas` (`idCadenas`);

--
-- Contraintes pour la table `etatcadenas`
--
ALTER TABLE `etatcadenas`
  ADD CONSTRAINT `FK_Cadenas_idCadenas` FOREIGN KEY (`idCadenas`) REFERENCES `cadenas` (`idCadenas`);

--
-- Contraintes pour la table `proprietaire`
--
ALTER TABLE `proprietaire`
  ADD CONSTRAINT `FK_Proprietaire_idProprio` FOREIGN KEY (`idProprio`) REFERENCES `personne` (`idPersonne`);




ALTER TABLE `demande`
  ADD CONSTRAINT `FK_Demande_idPersonne` FOREIGN KEY (`idPersonne`) REFERENCES `personne` (`idPersonne`),
  ADD CONSTRAINT `FK_Demande_idCadenas` FOREIGN KEY (`idCadenas`) REFERENCES `cadenas` (`idCadenas`);



ALTER TABLE `notif`
  ADD CONSTRAINT `FK_Notif_id_demande` FOREIGN KEY (`id_demande`) REFERENCES `demande` (`id_demande`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
