-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 11 déc. 2024 à 08:29
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `film`
--

-- --------------------------------------------------------

--
-- Structure de la table `fiche_film`
--

DROP TABLE IF EXISTS `fiche_film`;
CREATE TABLE IF NOT EXISTS `fiche_film` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `temps` int NOT NULL,
  `sortie` int NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `fiche_film`
--

INSERT INTO `fiche_film` (`id`, `titre`, `temps`, `sortie`, `image`) VALUES
(7, 'The Gentleman', 113, 2020, 'images/675315becc9bb.webp'),
(6, 'Kusco', 75, 2000, 'images/675315cd9740c.jpg'),
(3, 'Joker', 122, 2019, 'images/675315d9947ee.webp'),
(8, 'Sweeney todd', 116, 2007, 'images/675315e772431.jpg'),
(9, 'Princesse Mononoké', 134, 1997, 'images/675315f850c5e.jpg'),
(11, 'Fight Club', 131, 1999, 'images/675316076213b.webp'),
(16, 'Dogma', 130, 1999, 'image/6753133c2c65b.webp');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `date_inscription` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
