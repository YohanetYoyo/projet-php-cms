-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Hôte : db:3306
-- Généré le : jeu. 02 avr. 2026 à 19:50
-- Version du serveur : 11.3.2-MariaDB-1:11.3.2+maria~ubu2204
-- Version de PHP : 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `app_cms`
--

-- --------------------------------------------------------

--
-- Structure de la table `Pages`
--

CREATE TABLE `Pages` (
  `id_page` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `content` varchar(128) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `author` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `PageUserRoles`
--

CREATE TABLE `PageUserRoles` (
  `id_user` int(11) NOT NULL,
  `id_page` int(11) NOT NULL,
  `id_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Roles`
--

CREATE TABLE `Roles` (
  `id_role` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Users`
--

CREATE TABLE `Users` (
  `id_user` int(11) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `email` varchar(128) NOT NULL,
  `pwd` varchar(128) NOT NULL,
  `is_admin` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Users`
--

INSERT INTO `Users` (`id_user`, `lastname`, `firstname`, `email`, `pwd`, `is_admin`, `created_at`) VALUES
(1, 'ADMIN', 'Admin', 'admin@admin.admin', '$2y$10$0sV7M8UZ40vM1KAbbv38rOlnItoWihq56u1XbCq3VJu6FA.c/jk7a', 1, '2026-03-18 14:31:29');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Pages`
--
ALTER TABLE `Pages`
  ADD PRIMARY KEY (`id_page`),
  ADD KEY `fk_author_user` (`author`);

--
-- Index pour la table `PageUserRoles`
--
ALTER TABLE `PageUserRoles`
  ADD PRIMARY KEY (`id_user`,`id_page`,`id_role`),
  ADD KEY `fk_pur_page` (`id_page`),
  ADD KEY `fk_pur_role` (`id_role`);

--
-- Index pour la table `Roles`
--
ALTER TABLE `Roles`
  ADD PRIMARY KEY (`id_role`);

--
-- Index pour la table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Pages`
--
ALTER TABLE `Pages`
  MODIFY `id_page` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Roles`
--
ALTER TABLE `Roles`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Users`
--
ALTER TABLE `Users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Pages`
--
ALTER TABLE `Pages`
  ADD CONSTRAINT `fk_author_user` FOREIGN KEY (`author`) REFERENCES `Users` (`id_user`);

--
-- Contraintes pour la table `PageUserRoles`
--
ALTER TABLE `PageUserRoles`
  ADD CONSTRAINT `fk_pur_page` FOREIGN KEY (`id_page`) REFERENCES `Pages` (`id_page`),
  ADD CONSTRAINT `fk_pur_role` FOREIGN KEY (`id_role`) REFERENCES `Roles` (`id_role`),
  ADD CONSTRAINT `fk_pur_user` FOREIGN KEY (`id_user`) REFERENCES `Users` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
