-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : Dim 09 mai 2021 à 18:55
-- Version du serveur :  10.4.17-MariaDB
-- Version de PHP : 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `userlist`
--

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `nom`, `photo`, `email`, `phone`, `status`) VALUES
(1, 'wilson saintilein', 'Nord-Ouest.png', 'saintilien49@gmail.com', '123456789', 0),
(7, 'Saintilien Wilson', 'city6093487c68e968.97060870Screenshot from 2021-02-08 20-08-54.png', 'saintilien49@gmail.com', '123456789', 1),
(9, 'Saintilien Wilson 1', 'city60971bba4cc986.84543874Screenshot from 2021-05-06 14-28-20.png', 'wilson@gmail.com', '40869409', 1),
(10, 'Saintilien Loveson', 'city609733ef7389b2.40568984Screenshot from 2021-03-11 05-58-39.png', 'loveson1@gmail.com', '2345678900', 1),
(11, 'Saintilien Wilson', 'user.png', 'wilson.saintilien@facebook.com', '40869409', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
