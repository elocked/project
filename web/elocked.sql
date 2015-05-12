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
  `cleNFC` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idCadenas`),
  KEY `FK_Cadenas_idProprio` (`idProprio`)
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `note` varchar(4) DEFAULT NULL,
  `mdp` varchar(255) NOT NULL,
  `numCB` varchar(255) NOT NULL,
  `DateCrea` datetime DEFAULT NULL,
  PRIMARY KEY (`idPersonne`),
  UNIQUE KEY `mail` (`mail`,`numtel`,`numCB`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `proprietaire`
--

CREATE TABLE IF NOT EXISTS `proprietaire` (
  `idProprio` int(11) NOT NULL,
   PRIMARY KEY (`idProprio`),
  KEY `FK_Proprietaire_idProprio` (`idProprio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- ---------------------------------------------------------
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `cadenas`
--

ALTER TABLE `etatcadenas`
   ADD CONSTRAINT `FK_Cadenas_idCadenas` FOREIGN KEY (`idCadenas`) REFERENCES `cadenas` (`idCadenas`);

ALTER TABLE `cadenas`
  ADD CONSTRAINT `FK_Cadenas_idProprio` FOREIGN KEY (`idProprio`) REFERENCES `proprietaire` (`idProprio`);

--
-- Contraintes pour la table `emprunt`
--
ALTER TABLE `emprunt`
  ADD CONSTRAINT `FK_Emprunt_idCadenas` FOREIGN KEY (`idCadenas`) REFERENCES `cadenas` (`idCadenas`);

--
-- Contraintes pour la table `proprietaire`
--
ALTER TABLE `proprietaire`
  ADD CONSTRAINT `FK_Proprietaire_idProprio` FOREIGN KEY (`idProprio`) REFERENCES `personne` (`idPersonne`);



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
