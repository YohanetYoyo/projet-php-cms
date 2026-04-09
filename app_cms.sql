-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Hôte : db:3306
-- Généré le : jeu. 09 avr. 2026 à 19:36
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
  `status` varchar(50) NOT NULL,
  `author` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Pages`
--

INSERT INTO `Pages` (`id_page`, `title`, `content`, `slug`, `status`, `author`, `created_at`) VALUES
(2, 'AUTO', 'TERJTJNTEJQJQETJTEJEQTJETJJQJTEJJEJETJJWTKJSRYKSSK', 'drgreg', 'draft', 1, '2026-04-09 12:10:59'),
(5, 'momo', 'ryjryjdsjtyyj', 'mama', 'archived', 3, '2026-04-09 18:47:23');

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
-- Structure de la table `PasswordResetTokens`
--

CREATE TABLE `PasswordResetTokens` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `expires_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `PasswordResetTokens`
--

INSERT INTO `PasswordResetTokens` (`id`, `id_user`, `token`, `created_at`, `expires_at`) VALUES
(1, 2, 'f287325792df014887d78f6e5ecc6b6d8234653fe92cc2f59516c467b8d26245', '2026-04-09 19:17:11', '2026-04-09 21:17:11'),
(2, 2, 'ff3651a5caa31a6ae3209920d475c8a4c9393eaf3009c7d148620034a26c5325', '2026-04-09 19:19:52', '2026-04-09 21:19:52'),
(3, 2, 'f0547ae3beb80a71913361c048aa7d3746c0196a46d8aa4a15cb8d86c5b8f5b5', '2026-04-09 19:20:02', '2026-04-09 21:20:02');

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
(1, 'ADMIN', 'Admin', 'admin@admin.admin', '$2y$10$0sV7M8UZ40vM1KAbbv38rOlnItoWihq56u1XbCq3VJu6FA.c/jk7a', 1, '2026-03-18 14:31:29'),
(2, 'GNAMKEY', 'Yvan', 'ygnamkey3@gmail.com', '$2y$10$3gGHeuJ/N0Lj/2AMIc3Y7.Y6FMFY03WRNS.3tvxra5Od1DY26k1Y2', 0, '2026-04-03 17:58:36'),
(3, 'GNAMKEY', 'Yvan', 'gnamkeyyvan1@gmail.com', '$2y$10$svf/S1xOnZOqfKYo//8CK.2xqt8BVShycS4nr6BlQ6867NtHuKUU6', 0, '2026-04-09 12:15:25');

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
-- Index pour la table `PasswordResetTokens`
--
ALTER TABLE `PasswordResetTokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`),
  ADD KEY `id_user` (`id_user`);

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
  MODIFY `id_page` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `PasswordResetTokens`
--
ALTER TABLE `PasswordResetTokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `Roles`
--
ALTER TABLE `Roles`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Users`
--
ALTER TABLE `Users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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

--
-- Contraintes pour la table `PasswordResetTokens`
--
ALTER TABLE `PasswordResetTokens`
  ADD CONSTRAINT `PasswordResetTokens_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `Users` (`id_user`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
