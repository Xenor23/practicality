-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql:3306
-- Généré le : mar. 18 juin 2024 à 21:32
-- Version du serveur : 8.4.0
-- Version de PHP : 8.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `practicity`
--

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

CREATE TABLE `events` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime NOT NULL,
  `min_players` int NOT NULL,
  `max_players` int NOT NULL,
  `status` varchar(20) NOT NULL,
  `created_by` int NOT NULL,
  `requirements` text NOT NULL,
  `type` varchar(15) NOT NULL,
  `image_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `events`
--

INSERT INTO `events` (`id`, `name`, `description`, `start_datetime`, `end_datetime`, `min_players`, `max_players`, `status`, `created_by`, `requirements`, `type`, `image_id`) VALUES
(28, 'Test', 'TEST', '2024-06-06 14:18:00', '2024-06-06 15:18:00', 10, 50, 'Prochainement', 3, '2v2, uhc', 'mini-tournois', 22),
(29, 'Pour la présentation', 'PrésentationPrésentationPrésentationPrésentationPrésentationPrésentationPrésentationPrésentationPrésentationPrésentationPrésentationPrésentationPrésentationPrésentationPrésentationPrésentationPrésentationPrésentationPrésentationPrésentationPrésentationPrésentationPrésentationPrésentationPrésentationvvv', '2024-06-06 16:27:00', '2024-06-06 18:28:00', 10, 30, 'Prochainement', 3, '2v2, uhc', 'tournois', 23),
(30, 'sqdpojfqsfà)q^s', 'dfspjfdqsà)pjkqfsp^qskf)àp', '2024-06-17 06:11:00', '2024-06-17 08:11:00', 11, 39, 'Prochainement', 4, '2v2, uhc', 'tournois', 24),
(31, 'TEST', 'fqzssfsgqsgd', '2024-06-17 10:20:00', '2024-06-17 12:20:00', 10, 40, 'Prochainement', 4, '2v2, uhc, bedwars', 'tournois', 25),
(32, 'JPP DE LANGLAIS', 'gndfsikl,mv', '2024-06-17 16:10:00', '2024-06-17 17:10:00', 10, 59, 'Prochainement', 3, '2v2, uhc', 'tournois', 26),
(33, 'TEST', 'rtsdtgifdyfyiuuugghjk', '2024-06-18 04:42:00', '2024-06-18 09:42:00', 10, 50, 'Prochainement', 3, '2v2, uhc, bedwars, no_rod', 'tournois', 27);

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE `images` (
  `id` int NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `uploaded_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `images`
--

INSERT INTO `images` (`id`, `file_name`, `file_path`, `uploaded_at`) VALUES
(22, 'Isagi trop baka.jpeg', '/var/www/html/rezero/public/assets/img/uploads/6661a90a3f553_Isagi trop baka.jpeg', '2024-06-06 12:18:18'),
(23, 'Barou clipped.jpeg', '/var/www/html/rezero/public/assets/img/uploads/6661ab5f44f89_Barou clipped.jpeg', '2024-06-06 12:28:15'),
(24, 'Barou clipped.jpeg', '/var/www/html/rezero/public/assets/img/uploads/666f9b8a183f0_Barou clipped.jpeg', '2024-06-17 02:12:26'),
(25, 'Barou clipped.jpeg', '/var/www/html/rezero/public/assets/img/uploads/666ff1f50a16e_Barou clipped.jpeg', '2024-06-17 08:21:09'),
(26, 'Two-Gun Blue lock.jpeg', '/var/www/html/rezero/public/assets/img/uploads/667035d44cac6_Two-Gun Blue lock.jpeg', '2024-06-17 13:10:44'),
(27, 'Fighting my way.jpeg', '/var/www/html/rezero/public/assets/img/uploads/6670e60bbac2e_Fighting my way.jpeg', '2024-06-18 01:42:35');

-- --------------------------------------------------------

--
-- Structure de la table `participants`
--

CREATE TABLE `participants` (
  `id` int NOT NULL,
  `event_id` int NOT NULL,
  `user_id` int NOT NULL,
  `team_id` int NOT NULL,
  `position` int NOT NULL,
  `points` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `participants`
--

INSERT INTO `participants` (`id`, `event_id`, `user_id`, `team_id`, `position`, `points`) VALUES
(3, 31, 4, 2, 12, 40),
(4, 31, 3, 3, 12, 40),
(6, 32, 3, 5, 10, 50),
(7, 33, 3, 6, 12, 60);

-- --------------------------------------------------------

--
-- Structure de la table `results`
--

CREATE TABLE `results` (
  `id` int NOT NULL,
  `event_id` int NOT NULL,
  `participant_id` int NOT NULL,
  `team_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `teams`
--

CREATE TABLE `teams` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `creator_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `teams`
--

INSERT INTO `teams` (`id`, `name`, `creator_id`) VALUES
(1, 'Nom de l\'équipe par défaut', 4),
(2, 'TEST', 4),
(3, 'TEST', 3),
(5, 'Zebidu75', 3),
(6, 'ayo wtf', 3);

-- --------------------------------------------------------

--
-- Structure de la table `team_members`
--

CREATE TABLE `team_members` (
  `id` int NOT NULL,
  `team_id` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `country` varchar(50) NOT NULL,
  `age` int NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `email`, `password_hash`, `country`, `age`, `created_at`, `updated_at`, `role`) VALUES
(3, 'Duy Quang', 'TRAN', 'Xenor_23', 't.duyq23@gmail.com', '$2y$10$QJJOdIyT0tCaip6tEPFabueJhfOwh3/JaPapf9rxFDstKaPbOqhD.', 'fr', 18, '2024-05-27 12:11:33', '2024-05-27 12:11:33', 'admin'),
(4, 'Saman', 'Herallal', 'Saman', 'saman@baobab-ingenierie.fr', '$2y$10$o..97/bCcb2y.ge4JJ7hju7Wmq8uI793WyC01122TUvD25c4cU3a.', 'fr', 28, '2024-05-27 14:35:25', '2024-05-27 14:35:25', 'admin'),
(5, 'Duy Quang', 'TRAN', 'Xenor', 'xstylefatalm@gmail.com', '$2y$10$ui4khNo/l3LDVMEpX24p9u4yKlNHytiWNgjDGk9AKdNl25DVob/7K', 'fr', 18, '2024-06-06 01:28:11', '2024-06-06 01:34:03', 'user'),
(8, 'Allain', 'Jury', 'Super Jury', 'allain@yahoomail.fr', '$2y$10$ALO9GsOCCSMUc2tL7GbX4ue2PdT5GnP06PXqrKk2Y4OoPLkmvRGhu', 'fr', 18, '2024-06-06 13:11:41', '2024-06-17 14:02:53', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `votes`
--

CREATE TABLE `votes` (
  `id` int NOT NULL,
  `event_id` int NOT NULL,
  `user_id` int NOT NULL,
  `team_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_events_created_by` (`created_by`),
  ADD KEY `idx_events_image_id` (`image_id`);

--
-- Index pour la table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_participants_event_id` (`event_id`),
  ADD KEY `idx_participants_user_id` (`user_id`),
  ADD KEY `idx_participants_team_id` (`team_id`);

--
-- Index pour la table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_results_event_id` (`event_id`),
  ADD KEY `idx_results_participant_id` (`participant_id`),
  ADD KEY `idx_results_team_id` (`team_id`);

--
-- Index pour la table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_teams_creator_id` (`creator_id`);

--
-- Index pour la table `team_members`
--
ALTER TABLE `team_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_team_members_team_id` (`team_id`),
  ADD KEY `idx_team_members_user_id` (`user_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_votes_event_id` (`event_id`),
  ADD KEY `idx_votes_user_id` (`user_id`),
  ADD KEY `idx_votes_team_id` (`team_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `events`
--
ALTER TABLE `events`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `images`
--
ALTER TABLE `images`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `participants`
--
ALTER TABLE `participants`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `results`
--
ALTER TABLE `results`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `team_members`
--
ALTER TABLE `team_members`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `fk_events_created_by` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_events_image_id` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `participants`
--
ALTER TABLE `participants`
  ADD CONSTRAINT `fk_participants_event_id` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_participants_team_id` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_participants_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `fk_results_event_id` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_results_participant_id` FOREIGN KEY (`participant_id`) REFERENCES `participants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_results_team_id` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `teams`
--
ALTER TABLE `teams`
  ADD CONSTRAINT `fk_teams_creator_id` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `team_members`
--
ALTER TABLE `team_members`
  ADD CONSTRAINT `fk_team_members_team_id` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_team_members_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `fk_votes_event_id` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_votes_team_id` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_votes_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
