-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Hôte : boonumpedago.mysql.db
-- Généré le :  Dim 18 mars 2018 à 23:57
-- Version du serveur :  5.5.55-0+deb7u1-log
-- Version de PHP :  5.6.33-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `boonumpedago`
--

-- --------------------------------------------------------

--
-- Structure de la table `fs_info`
--

CREATE TABLE `fs_info` (
  `idinfo` int(11) NOT NULL,
  `info` varchar(200) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fs_user`
--

CREATE TABLE `fs_user` (
  `iduser` int(11) NOT NULL,
  `user` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `pwd` varchar(20) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Déchargement des données de la table `fs_user`
--

INSERT INTO `fs_user` (`iduser`, `user`, `pwd`) VALUES
(10, 'claude', 'claude'),
(11, 'agnes', 'agnes'),
(12, 'charles', 'charles'),
(13, 'alain', 'alain'),
(14, 'thierry', 'thierry');

-- --------------------------------------------------------

--
-- Structure de la table `fs_xss`
--

CREATE TABLE `fs_xss` (
  `idxss` int(11) NOT NULL,
  `infoxss` text COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `fs_info`
--
ALTER TABLE `fs_info`
  ADD PRIMARY KEY (`idinfo`);

--
-- Index pour la table `fs_user`
--
ALTER TABLE `fs_user`
  ADD PRIMARY KEY (`iduser`),
  ADD KEY `user` (`user`);

--
-- Index pour la table `fs_xss`
--
ALTER TABLE `fs_xss`
  ADD PRIMARY KEY (`idxss`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `fs_info`
--
ALTER TABLE `fs_info`
  MODIFY `idinfo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT pour la table `fs_user`
--
ALTER TABLE `fs_user`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT pour la table `fs_xss`
--
ALTER TABLE `fs_xss`
  MODIFY `idxss` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
