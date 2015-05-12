-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 12 Mai 2015 à 13:59
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
  `idEtat` int(11) NOT NULL,
  PRIMARY KEY (`idCadenas`),
  KEY `FK_Cadenas_idProprio` (`idProprio`),
  KEY `FK_Cadenas_idEtat` (`idEtat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `idUtilisateur` int(11) NOT NULL,
  PRIMARY KEY (`idEmprunt`),
  KEY `FK_Emprunt_idCadenas` (`idCadenas`),
  KEY `FK_Emprunt_idUtilisateur` (`idUtilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `etatcadenas`
--

CREATE TABLE IF NOT EXISTS `etatcadenas` (
  `idEtat` int(11) NOT NULL,
  `Longitude` float DEFAULT NULL,
  `Latitude` float DEFAULT NULL,
  `Dispo` tinyint(1) NOT NULL,
  PRIMARY KEY (`idEtat`),
  KEY `Longitude` (`Longitude`,`Latitude`,`Dispo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `personne`
--

CREATE TABLE IF NOT EXISTS `personne` (
  `idPersonne` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(20) NOT NULL,
  `Prenom` varchar(20) NOT NULL,
  `E_mail` varchar(50) NOT NULL,
  `Telephone` varchar(34) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `numCB` varchar(255) NOT NULL,
  `Note` varchar(4) DEFAULT NULL,
  `DateCrea` datetime DEFAULT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `idProprio` int(11) NOT NULL,
  PRIMARY KEY (`idPersonne`),
  UNIQUE KEY `E_mail` (`E_mail`,`Telephone`,`numCB`),
  KEY `FK_Personne_idUtilisateur` (`idUtilisateur`),
  KEY `FK_Personne_idProprio` (`idProprio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `proprietaire`
--

CREATE TABLE IF NOT EXISTS `proprietaire` (
  `idProprio` int(11) NOT NULL AUTO_INCREMENT,
  `idPersonne` int(11) NOT NULL,
  PRIMARY KEY (`idProprio`),
  KEY `FK_Proprietaire_idPersonne` (`idPersonne`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `idPersonne` int(11) NOT NULL,
  PRIMARY KEY (`idUtilisateur`),
  KEY `FK_Utilisateur_idPersonne` (`idPersonne`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `cadenas`
--
ALTER TABLE `cadenas`
  ADD CONSTRAINT `FK_Cadenas_idEtat` FOREIGN KEY (`idEtat`) REFERENCES `etatcadenas` (`idEtat`),
  ADD CONSTRAINT `FK_Cadenas_idProprio` FOREIGN KEY (`idProprio`) REFERENCES `proprietaire` (`idProprio`);

--
-- Contraintes pour la table `emprunt`
--
ALTER TABLE `emprunt`
  ADD CONSTRAINT `FK_Emprunt_idUtilisateur` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`),
  ADD CONSTRAINT `FK_Emprunt_idCadenas` FOREIGN KEY (`idCadenas`) REFERENCES `cadenas` (`idCadenas`);

--
-- Contraintes pour la table `personne`
--
ALTER TABLE `personne`
  ADD CONSTRAINT `FK_Personne_idProprio` FOREIGN KEY (`idProprio`) REFERENCES `proprietaire` (`idProprio`),
  ADD CONSTRAINT `FK_Personne_idUtilisateur` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`);

--
-- Contraintes pour la table `proprietaire`
--
ALTER TABLE `proprietaire`
  ADD CONSTRAINT `FK_Proprietaire_idPersonne` FOREIGN KEY (`idPersonne`) REFERENCES `personne` (`idPersonne`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `FK_Utilisateur_idPersonne` FOREIGN KEY (`idPersonne`) REFERENCES `personne` (`idPersonne`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
