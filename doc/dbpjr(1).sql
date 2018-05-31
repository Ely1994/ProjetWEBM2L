-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 31 mai 2018 à 11:07
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `dbpjr`
--

-- --------------------------------------------------------

--
-- Structure de la table `employe`
--

DROP TABLE IF EXISTS `employe`;
CREATE TABLE IF NOT EXISTS `employe` (
  `E_id` int(11) NOT NULL AUTO_INCREMENT,
  `E_nom` varchar(50) NOT NULL,
  `E_prenom` varchar(50) NOT NULL,
  `E_login` varchar(20) NOT NULL,
  `E_mdp` varchar(20) NOT NULL,
  `E_credits` int(10) NOT NULL,
  `E_date` date NOT NULL,
  `E_statut` varchar(20) NOT NULL,
  PRIMARY KEY (`E_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `employe`
--

INSERT INTO `employe` (`E_id`, `E_nom`, `E_prenom`, `E_login`, `E_mdp`, `E_credits`, `E_date`, `E_statut`) VALUES
(1, 'dress', 'élie', 'ely', 'azer', 23, '2018-01-11', 'chef'),
(2, 'lepichon', 'fred', 'orogarde', 'azer', 20, '2018-01-11', 'employe');

-- --------------------------------------------------------

--
-- Structure de la table `formation`
--

DROP TABLE IF EXISTS `formation`;
CREATE TABLE IF NOT EXISTS `formation` (
  `F_id` int(10) NOT NULL AUTO_INCREMENT,
  `F_nom` varchar(25) NOT NULL,
  `F_description` varchar(25) NOT NULL,
  `F_lieu` varchar(25) NOT NULL,
  `F_prerequis` varchar(25) NOT NULL,
  `F_date_debut` date NOT NULL,
  `F_duree` int(10) NOT NULL,
  `F_credits` int(10) NOT NULL,
  PRIMARY KEY (`F_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `formation`
--

INSERT INTO `formation` (`F_id`, `F_nom`, `F_description`, `F_lieu`, `F_prerequis`, `F_date_debut`, `F_duree`, `F_credits`) VALUES
(6, 'cours de Basket', 'pour les amateurs', 'invalides', 'aucun', '2018-02-14', 2, 5),
(7, 'formation de Tennis', 'pour les débutants', 'jardin du luxembourg', 'avoir une raquette', '2018-04-01', 4, 8),
(8, 'formation de Volley', 'attention aux bobos', 'salle souterraine', 'avoir un ballon', '2018-04-13', 2, 4),
(9, 'cours de Piscine', 'cours de remise à niveau', 'montparnasse', 'il faut savoir nager.', '2018-04-30', 3, 2);

-- --------------------------------------------------------

--
-- Structure de la table `inscrits`
--

DROP TABLE IF EXISTS `inscrits`;
CREATE TABLE IF NOT EXISTS `inscrits` (
  `formation_F_id` int(10) NOT NULL,
  `employe_E_id` int(10) NOT NULL,
  `I_statut` int(10) DEFAULT NULL,
  PRIMARY KEY (`formation_F_id`,`employe_E_id`),
  KEY `employe_E_id` (`employe_E_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `inscrits`
--

INSERT INTO `inscrits` (`formation_F_id`, `employe_E_id`, `I_statut`) VALUES
(7, 2, 2),
(8, 1, 2),
(8, 2, 1),
(9, 2, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
