-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 05 Mai 2015 à 21:18
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
  `IDcadenas` int(11) NOT NULL AUTO_INCREMENT,
  `Dispo` int(11) DEFAULT NULL,
  `Longitude` int(11) DEFAULT NULL,
  `Latitude` int(11) DEFAULT NULL,
  `CleNFC` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`IDcadenas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `emprunt`
--

CREATE TABLE IF NOT EXISTS `emprunt` (
  `IDpersonne` int(11) DEFAULT NULL,
  `IDcadenas` int(11) DEFAULT NULL,
  `Heuredebut` datetime DEFAULT NULL,
  `Heurefin` datetime DEFAULT NULL,
  KEY `IDpersonne` (`IDpersonne`),
  KEY `IDcadenas` (`IDcadenas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `personne`
--

CREATE TABLE IF NOT EXISTS `personne` (
  `IDpersonne` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(255) DEFAULT NULL,
  `Prenom` varchar(255) DEFAULT NULL,
  `Mail` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Numtel` int(11) DEFAULT NULL,
  `Note` int(11) DEFAULT NULL,
  `Mdp` varchar(255) NOT NULL,
  `NumCB` int(11) DEFAULT NULL,
  `IDcadenas` int(11) DEFAULT NULL,
  PRIMARY KEY (`IDpersonne`),
  UNIQUE KEY `Mail` (`Mail`),
  KEY `IDcadenas` (`IDcadenas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `emprunt`
--
ALTER TABLE `emprunt`
  ADD CONSTRAINT `emprunt_ibfk_1` FOREIGN KEY (`IDpersonne`) REFERENCES `personne` (`IDpersonne`),
  ADD CONSTRAINT `emprunt_ibfk_2` FOREIGN KEY (`IDcadenas`) REFERENCES `cadenas` (`IDcadenas`);

--
-- Contraintes pour la table `personne`
--
ALTER TABLE `personne`
  ADD CONSTRAINT `personne_ibfk_1` FOREIGN KEY (`IDcadenas`) REFERENCES `cadenas` (`IDcadenas`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
