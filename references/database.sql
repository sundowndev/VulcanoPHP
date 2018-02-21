-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  mer. 21 fév. 2018 à 22:28
-- Version du serveur :  5.7.21-0ubuntu0.17.10.1
-- Version de PHP :  7.1.14-1+ubuntu17.10.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `daimyocms`
--

-- --------------------------------------------------------

--
-- Structure de la table `d_articles`
--

CREATE TABLE `d_articles` (
  `id` int(11) NOT NULL,
  `hash_id` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `publishDate` datetime NOT NULL,
  `editedDate` datetime NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `d_category`
--

CREATE TABLE `d_category` (
  `id` int(11) NOT NULL,
  `hash_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `createdDate` datetime NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `d_users`
--

CREATE TABLE `d_users` (
  `id` int(11) NOT NULL,
  `hash_id` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `registerDate` datetime NOT NULL,
  `access` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `d_users`
--

INSERT INTO `d_users` (`id`, `hash_id`, `username`, `email`, `password`, `registerDate`, `access`) VALUES
(2, '123', 'admin', 'admin@daimyo.fr', '$2y$10$1DrA71.COOnqx1sMvYrRLeakZ4UYP0tMz4Et9VFpJe7cA69ZgI0sC', '2018-02-21 00:00:00', '0');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `d_articles`
--
ALTER TABLE `d_articles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `d_category`
--
ALTER TABLE `d_category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `d_users`
--
ALTER TABLE `d_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `d_articles`
--
ALTER TABLE `d_articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `d_category`
--
ALTER TABLE `d_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `d_users`
--
ALTER TABLE `d_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
