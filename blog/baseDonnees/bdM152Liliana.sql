-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mar. 07 fév. 2023 à 16:38
-- Version du serveur :  10.3.37-MariaDB-0ubuntu0.20.04.1
-- Version de PHP : 8.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bdM152Liliana`
--
CREATE DATABASE IF NOT EXISTS `bdM152Liliana` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `bdM152Liliana`;

-- --------------------------------------------------------

--
-- Structure de la table `media`
--

CREATE TABLE `media` (
  `idMedia` int(11) NOT NULL,
  `typeMedia` text NOT NULL,
  `nomMedia` text NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `idPost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `media`
--

INSERT INTO `media` (`idMedia`, `typeMedia`, `nomMedia`, `creationDate`, `idPost`) VALUES
(1, 'Array', 'pixil-frame-0 (1)_63e26edf5c097.png', '2023-02-07 15:31:43', 43),
(2, 'Array', 'Array', '2023-02-07 15:33:04', 44),
(3, 'png', 'Array', '2023-02-07 15:34:02', 45),
(4, 'png', 'Array', '2023-02-07 15:34:03', 46),
(5, 'png', 'Array', '2023-02-07 15:34:03', 47),
(6, 'png', 'Array', '2023-02-07 15:34:03', 48),
(7, 'png', 'Array', '2023-02-07 15:34:03', 49),
(8, 'png', 'Array', '2023-02-07 15:34:03', 50),
(9, 'png', 'pixil-frame-0 (1)_63e26fdbb2fc7.png', '2023-02-07 15:35:55', 51),
(10, 'png', 'pixil-frame-0 (1)_63e27021663d0.png', '2023-02-07 15:37:05', 52),
(11, 'png', 'pixil-frame-0 (1)_63e27021f3819.png', '2023-02-07 15:37:05', 53),
(12, 'png', 'Ingredients_63e2702f5fcf9.png', '2023-02-07 15:37:19', 55),
(13, 'png', 'Ingredients_63e27043b41ef.png', '2023-02-07 15:37:39', 56),
(14, 'png', 'Ingredients_63e27043e6230.png', '2023-02-07 15:37:39', 57),
(15, 'png', 'Ingredients_63e270440fc8c.png', '2023-02-07 15:37:40', 58);

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

CREATE TABLE `post` (
  `idPost` int(11) NOT NULL,
  `commentaire` text NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `modificationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`idPost`, `commentaire`, `creationDate`, `modificationDate`) VALUES
(38, 'qer', '2023-02-07 15:30:41', '2023-02-07 15:30:41'),
(39, 'qer', '2023-02-07 15:30:41', '2023-02-07 15:30:41'),
(40, 'qer', '2023-02-07 15:30:41', '2023-02-07 15:30:41'),
(41, 'qer', '2023-02-07 15:30:42', '2023-02-07 15:30:42'),
(42, 'qer', '2023-02-07 15:30:42', '2023-02-07 15:30:42'),
(43, 'qer', '2023-02-07 15:31:43', '2023-02-07 15:31:43'),
(44, 'qer', '2023-02-07 15:33:03', '2023-02-07 15:33:03'),
(45, 'qer', '2023-02-07 15:34:02', '2023-02-07 15:34:02'),
(46, 'qer', '2023-02-07 15:34:03', '2023-02-07 15:34:03'),
(47, 'qer', '2023-02-07 15:34:03', '2023-02-07 15:34:03'),
(48, 'qer', '2023-02-07 15:34:03', '2023-02-07 15:34:03'),
(49, 'qer', '2023-02-07 15:34:03', '2023-02-07 15:34:03'),
(50, 'qer', '2023-02-07 15:34:03', '2023-02-07 15:34:03'),
(51, 'qer', '2023-02-07 15:35:55', '2023-02-07 15:35:55'),
(52, 'qer', '2023-02-07 15:37:05', '2023-02-07 15:37:05'),
(53, 'qer', '2023-02-07 15:37:05', '2023-02-07 15:37:05'),
(54, 'e', '2023-02-07 15:37:11', '2023-02-07 15:37:11'),
(55, 'd', '2023-02-07 15:37:19', '2023-02-07 15:37:19'),
(56, 'd', '2023-02-07 15:37:39', '2023-02-07 15:37:39'),
(57, 'd', '2023-02-07 15:37:39', '2023-02-07 15:37:39'),
(58, 'd', '2023-02-07 15:37:40', '2023-02-07 15:37:40');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`idMedia`),
  ADD KEY `idPost` (`idPost`);

--
-- Index pour la table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`idPost`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `media`
--
ALTER TABLE `media`
  MODIFY `idMedia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `post`
--
ALTER TABLE `post`
  MODIFY `idPost` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_ibfk_1` FOREIGN KEY (`idPost`) REFERENCES `post` (`idPost`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
