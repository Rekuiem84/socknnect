-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : ven. 13 sep. 2024 à 07:10
-- Version du serveur : 5.7.39
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `socknnect`
--

-- --------------------------------------------------------

--
-- Structure de la table `matches`
--

CREATE TABLE `matches` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `other_user` int(11) NOT NULL,
  `like_status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `matches`
--

INSERT INTO `matches` (`id`, `user`, `other_user`, `like_status`) VALUES
(1, 11, 12, NULL),
(2, 11, 13, NULL),
(3, 12, 11, NULL),
(4, 12, 13, NULL),
(5, 13, 11, NULL),
(6, 13, 12, NULL),
(7, 14, 11, NULL),
(8, 14, 12, NULL),
(9, 14, 13, NULL),
(10, 11, 14, NULL),
(11, 12, 14, NULL),
(12, 13, 14, NULL),
(13, 17, 11, 0),
(14, 11, 17, NULL),
(15, 17, 12, 0),
(16, 12, 17, NULL),
(17, 17, 13, 1),
(18, 13, 17, NULL),
(19, 17, 14, 0),
(20, 14, 17, NULL),
(21, 18, 11, 1),
(22, 11, 18, NULL),
(23, 18, 12, 0),
(24, 12, 18, NULL),
(25, 18, 13, 1),
(26, 13, 18, NULL),
(27, 18, 14, 0),
(28, 14, 18, NULL),
(29, 18, 17, 0),
(30, 17, 18, NULL),
(31, 19, 11, NULL),
(32, 11, 19, NULL),
(33, 19, 12, NULL),
(34, 12, 19, NULL),
(35, 19, 13, NULL),
(36, 13, 19, NULL),
(37, 19, 14, NULL),
(38, 14, 19, NULL),
(39, 19, 17, NULL),
(40, 17, 19, NULL),
(41, 19, 18, NULL),
(42, 18, 19, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `couleur` varchar(255) NOT NULL,
  `taille` float NOT NULL,
  `matiere` varchar(255) NOT NULL,
  `motif` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `nom`, `password`, `couleur`, `taille`, `matiere`, `motif`, `photo`, `email`) VALUES
(11, 'Admin', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', 'bleue', 34, 'coton', 'simple', 'sock-1.webp', 'aze@aze.fr'),
(12, 'Luca', '4b8a5e5619f2d3b3d027ab30684fb31c09334e61', 'bleu', 45, 'coton', 'rond', 'sock-2.jpg', 'rgerg@zrfzef.fe'),
(13, 'Irving', 'c7caf43a830475d0d44f6b79522b285b5c143aaf', 'vert', 45, 'soie', 'stripes', 'sock-3.webp', 'lokijuhygtfr@hgtfr.fr'),
(14, 'Alistair', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', 'jaune', 45, 'poly', 'bandes', 'sock-4.png', 'test-test@gmail.com'),
(17, 'Morini', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', 'grid', 12, 'poly', 'aucun', 'sock-2.jpg', 'qsd@qsd.com'),
(18, 'noob', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', 'bleue', 45, 'poly', 'aucun', 'sock-bleue-18.jpeg', 'noob@aze.fr'),
(19, 'le roi', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', 'Arc en ciel', 40, 'coton', 'bandes', 'rainbow-sock-19.webp', 'king@aze.com');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_3` (`user`),
  ADD KEY `FK_4` (`other_user`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `matches`
--
ALTER TABLE `matches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `matches`
--
ALTER TABLE `matches`
  ADD CONSTRAINT `FK_3` FOREIGN KEY (`user`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_4` FOREIGN KEY (`other_user`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
