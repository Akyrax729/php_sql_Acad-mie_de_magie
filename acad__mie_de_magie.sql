-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 13 déc. 2024 à 15:42
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
-- Base de données : `académie_de_magie`
--

-- --------------------------------------------------------

--
-- Structure de la table `bestiaire`
--

DROP TABLE IF EXISTS `bestiaire`;
CREATE TABLE IF NOT EXISTS `bestiaire` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_type_fk` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `bestiaire`
--

INSERT INTO `bestiaire` (`id`, `name`, `description`, `img`, `id_type_fk`, `user_id`) VALUES
(11, 'liche', 'un mort-vivant dangereux capable de réanimer d&#039;autres mort-vivants.', '1734080152285.jpg', 3, 1),
(7, 'elémentaire d&#039;eau', 'Une forme humanoïde faite uniquement d&#039;eau avec une conscience propre.', '1733996557368.jpg', 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `element`
--

DROP TABLE IF EXISTS `element`;
CREATE TABLE IF NOT EXISTS `element` (
  `id_element` int NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_element`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `element`
--

INSERT INTO `element` (`id_element`, `type`) VALUES
(1, 'Air'),
(2, 'Feu'),
(3, 'Eau'),
(4, 'Lumière');

-- --------------------------------------------------------

--
-- Structure de la table `sort`
--

DROP TABLE IF EXISTS `sort`;
CREATE TABLE IF NOT EXISTS `sort` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_type_fk` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `sort`
--

INSERT INTO `sort` (`id`, `name`, `img`, `id_type_fk`, `user_id`) VALUES
(7, 'blizzard', '1734103865563.webp', 3, 2);

-- --------------------------------------------------------

--
-- Structure de la table `type_de_creature`
--

DROP TABLE IF EXISTS `type_de_creature`;
CREATE TABLE IF NOT EXISTS `type_de_creature` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `type_de_creature`
--

INSERT INTO `type_de_creature` (`id`, `type`) VALUES
(1, 'Aquatique'),
(2, 'Démoniaque'),
(3, 'Mort-vivant'),
(4, 'Mi-bête');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `admin`) VALUES
(1, 'catherine', '$2y$10$8ZvASLhs1ulmmTs2NHyX4OmVj22rU176sbrYgON0Ql2/CIaUmAPqK', 1),
(2, 'anastasya', '$2y$10$EKizWpUFpgu/z/Wvb6KZneJ9sx1auwHKavmlUiAg3b/JKKXKiv58a', 0);

-- --------------------------------------------------------

--
-- Structure de la table `user_element`
--

DROP TABLE IF EXISTS `user_element`;
CREATE TABLE IF NOT EXISTS `user_element` (
  `user_id` int NOT NULL,
  `element_id` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user_element`
--

INSERT INTO `user_element` (`user_id`, `element_id`) VALUES
(2, 3),
(1, 1),
(1, 2),
(1, 3),
(1, 4);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
