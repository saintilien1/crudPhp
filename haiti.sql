-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 06 mai 2021 à 14:26
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
-- Base de données : `haiti`
--

-- --------------------------------------------------------

--
-- Structure de la table `ville`
--

CREATE TABLE `ville` (
  `id` int(11) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `departement` varchar(40) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `ville`
--

INSERT INTO `ville` (`id`, `nom`, `photo`, `departement`, `description`, `status`) VALUES
(1, 'Port-de-Paix2', 'Nord-Ouest.png', 'Nord-Ouest', 'Christophe Colomb dénomme les environs de Port-de-Paix « Valparaíso » (la Vallée de Paradis), et il reste toujours d\'agréables plages et paysages.À partir des années 1640, Port-de-Paix est, avec l\'île de la Tortue, parmi les premiers points d\'appui de la présence française dans la partie occidentale d\'Hispaniola.Après 1665, Bertrand d\'Ogeron de la Bouëre, gouverneur de la Tortue, favorise le développement de Port-de-Paix en poussant des boucaniers et des flibustiers de l\'île de la Tortue à se convertir en agriculteurs. Ce mouvement est renforcé par l\'arrivée de centaines d’engagés (appelés des 36 mois, la durée de leur contrat), qu\'Ogeron fait venir de France.En 1685, Pierre-Paul Tarin de Cussy, gouverneur de Saint-Domingue, s\'installe à Port-de-Paix qui devient le centre de gravité de la présence française sur l\'île d\'Hispaniola. Une cinquantaine de soldats français s\'installent en 1688 à Port-de-Paix.En juillet 1695, Port-de-Paix est attaqué et pillé par les Anglais, en représailles à l\'expédition de la Jamaïque, menée en 1694 par Jean-Baptiste du Casse.', 1),
(7, 'Port-de-Paix1', 'city6093487c68e968.97060870Screenshot from 2021-02-08 20-08-54.png', 'Nord-Ouest', 'Christophe Colomb dénomme les environs de Port-de-Paix « Valparaíso » (la Vallée de Paradis), et il reste toujours d\'agréables plages et paysages.À partir des années 1640, Port-de-Paix est, avec l\'île de la Tortue, parmi les premiers points d\'appui de la présence française dans la partie occidentale d\'Hispaniola.Après 1665, Bertrand d\'Ogeron de la Bouëre, gouverneur de la Tortue, favorise le développement de Port-de-Paix en poussant des boucaniers et des flibustiers de l\'île de la Tortue à se convertir en agriculteurs. Ce mouvement est renforcé par l\'arrivée de centaines d’engagés (appelés des 36 mois, la durée de leur contrat), qu\'Ogeron fait venir de France.En 1685, Pierre-Paul Tarin de Cussy, gouverneur de Saint-Domingue, s\'installe à Port-de-Paix qui devient le centre de gravité de la présence française sur l\'île d\'Hispaniola. Une cinquantaine de soldats français s\'installent en 1688 à Port-de-Paix.En juillet 1695, Port-de-Paix est attaqué et pillé par les Anglais, en représailles à l\'expédition de la Jamaïque, menée en 1694 par Jean-Baptiste du Casse.', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `ville`
--
ALTER TABLE `ville`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `ville`
--
ALTER TABLE `ville`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
