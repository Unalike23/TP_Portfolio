-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 04 mai 2026 à 09:26
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet_jouet`
--

-- --------------------------------------------------------

--
-- Structure de la table `catalogue`
--

DROP TABLE IF EXISTS `catalogue`;
CREATE TABLE IF NOT EXISTS `catalogue` (
  `id` int NOT NULL AUTO_INCREMENT,
  `annee` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `catalogue`
--

INSERT INTO `catalogue` (`id`, `annee`) VALUES
(1, 2022),
(2, 2023),
(3, 2024),
(4, 2025);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` int NOT NULL,
  `libelle` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `code`, `libelle`) VALUES
(1, 1, 'Jeux de construction'),
(2, 2, 'Poupées et accessoires'),
(3, 3, 'Véhicules'),
(4, 4, 'Jeux éducatifs'),
(5, 5, 'Jeux d\'extérieur'),
(6, 6, 'Jeux de société');

-- --------------------------------------------------------

--
-- Structure de la table `jouet`
--

DROP TABLE IF EXISTS `jouet`;
CREATE TABLE IF NOT EXISTS `jouet` (
  `id` int NOT NULL AUTO_INCREMENT,
  `numero` int NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `categorie_id` int NOT NULL,
  `tranche_age_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `categorie_id` (`categorie_id`),
  KEY `tranche_age_id` (`tranche_age_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `jouet`
--

INSERT INTO `jouet` (`id`, `numero`, `libelle`, `categorie_id`, `tranche_age_id`) VALUES
(1, 101, 'Lego Classic', 1, 1),
(2, 102, 'Barbie Princesse', 2, 2),
(3, 103, 'Voiture télécommandée', 3, 3),
(4, 104, 'Puzzle 500 pièces', 4, 3),
(5, 105, 'Ballon de foot', 5, 2),
(6, 106, 'Monopoly Junior', 6, 1),
(7, 107, 'Duplo Créateur', 1, 5),
(8, 108, 'Maison de poupées', 2, 3),
(9, 109, 'Camion de pompiers', 3, 1),
(10, 110, 'Jeu de chimie', 4, 4),
(11, 111, 'Trottinette', 5, 2),
(12, 112, 'Jeu de dames', 6, 3),
(13, 113, 'Lego Technic', 1, 4),
(14, 114, 'Poupée interactive', 2, 2),
(15, 115, 'Moto électrique', 3, 3);

-- --------------------------------------------------------

--
-- Structure de la table `quantite`
--

DROP TABLE IF EXISTS `quantite`;
CREATE TABLE IF NOT EXISTS `quantite` (
  `id` int NOT NULL AUTO_INCREMENT,
  `catalogue_id` int NOT NULL,
  `jouet_id` int NOT NULL,
  `quantite` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `catalogue_id` (`catalogue_id`),
  KEY `jouet_id` (`jouet_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `quantite`
--

INSERT INTO `quantite` (`id`, `catalogue_id`, `jouet_id`, `quantite`) VALUES
(1, 1, 1, 50),
(2, 1, 2, 30),
(3, 1, 3, 20),
(4, 1, 4, 15),
(5, 1, 5, 40),
(6, 2, 6, 25),
(7, 2, 7, 35),
(8, 2, 8, 10),
(9, 2, 9, 45),
(10, 2, 10, 5),
(11, 3, 11, 30),
(12, 3, 12, 20),
(13, 3, 13, 15),
(14, 3, 14, 25),
(15, 3, 15, 10),
(16, 4, 1, 60),
(17, 4, 3, 25),
(18, 4, 5, 50),
(19, 4, 7, 40),
(20, 4, 9, 35);

-- --------------------------------------------------------

--
-- Structure de la table `tranche_age`
--

DROP TABLE IF EXISTS `tranche_age`;
CREATE TABLE IF NOT EXISTS `tranche_age` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` int NOT NULL,
  `age_min` int NOT NULL,
  `age_max` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `tranche_age`
--

INSERT INTO `tranche_age` (`id`, `code`, `age_min`, `age_max`) VALUES
(1, 1, 3, 5),
(2, 2, 6, 8),
(3, 3, 9, 12),
(4, 4, 13, 16),
(5, 5, 0, 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
