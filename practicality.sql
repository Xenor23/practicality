-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql:3306
-- Généré le : dim. 23 juin 2024 à 20:02
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
(29, 'Pour la présentation', 'PrésentationPrésentationPrésentationPrésentationPrésentationPrésentationPrésentationPrésentationPrésentationPrésentationPrésentationPrésentationPrésentationPrésentationPrésentationPrésentationPrésentationPrésentationPrésentationPrésentationPrésentationPrésentationPrésentationPrésentationvvv', '2024-06-06 16:27:00', '2024-06-06 18:28:00', 10, 30, 'Prochainement', 3, '2v2, uhc', 'tournois', 23),
(30, 'sqdpojfqsfà)q^s', 'dfspjfdqsà)pjkqfsp^qskf)àp', '2024-06-17 06:11:00', '2024-06-17 08:11:00', 11, 39, 'Prochainement', 4, '2v2, uhc', 'tournois', 24),
(31, 'TEST', 'fqzssfsgqsgd', '2024-06-17 10:20:00', '2024-06-17 12:20:00', 10, 40, 'Prochainement', 4, '2v2, uhc, bedwars', 'tournois', 25),
(32, 'JPP DE LANGLAIS', 'gndfsikl,mv', '2024-06-17 16:10:00', '2024-06-17 17:10:00', 10, 59, 'Prochainement', 3, '2v2, uhc', 'tournois', 26),
(33, 'TEST', 'rtsdtgifdyfyiuuugghjk', '2024-06-18 04:42:00', '2024-06-18 09:42:00', 10, 50, 'Prochainement', 3, '2v2, uhc, bedwars, no_rod', 'tournois', 27),
(34, 'DGIOHGDQIOHGOPQDGDOQ', 'DGJDOPJGDSOJGDSOPDGJSOP', '2024-06-19 02:29:00', '2024-06-19 05:29:00', 10, 30, 'Prochainement', 4, '2v2, uhc', 'tournois', 28),
(35, 'test', 'qdfiopjqfsopqsqdfiopjqfsopqsqdfiopjqfsopqsqdfiopjqfsopqsqdfiopjqfsopqsqdfiopjqfsopqsqdfiopjqfsopqsqdfiopjqfsopqsqdfiopjqfsopqsqdfiopjqfsopqsqdfiopjqfsopqsqdfiopjqfsopqsqdfiopjqfsopqsqdfiopjqfsopqsqdfiopjqfsopqs', '2024-06-19 11:00:00', '2024-06-19 12:00:00', 10, 30, 'Prochainement', 3, '2v2, bedwars, no_rod', 'mini-tournois', 29),
(36, 'DSQDSQD', 'SQDSQQSDQ', '2024-06-20 18:29:00', '2024-06-20 20:29:00', 20, 54, 'Prochainement', 4, '2v2, bedwars', 'mini-tournois', 30);

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
(27, 'Fighting my way.jpeg', '/var/www/html/rezero/public/assets/img/uploads/6670e60bbac2e_Fighting my way.jpeg', '2024-06-18 01:42:35'),
(28, 'Barou clipped.jpeg', '/var/www/html/practicity/public/assets/img/uploads/667218735fdd7_Barou clipped.jpeg', '2024-06-18 23:29:55'),
(29, 'Two-Gun Blue lock.jpeg', '/var/www/html/practicity/public/assets/img/uploads/66729026976d3_Two-Gun Blue lock.jpeg', '2024-06-19 08:00:38'),
(30, 'sheesh black girl samourai.jpeg', '/var/www/html/practicity/public/assets/img/uploads/66744ad735149_sheesh black girl samourai.jpeg', '2024-06-20 15:29:27');

-- --------------------------------------------------------

--
-- Structure de la table `participants`
--

CREATE TABLE `participants` (
  `id` int NOT NULL,
  `event_id` int NOT NULL,
  `user_id` int NOT NULL,
  `position` int NOT NULL,
  `points` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `participants`
--

INSERT INTO `participants` (`id`, `event_id`, `user_id`, `position`, `points`) VALUES
(3, 31, 4, 12, 40),
(4, 31, 3, 12, 40),
(6, 32, 3, 10, 50),
(7, 33, 3, 12, 60),
(8, 34, 4, 10, 60),
(9, 34, 3, 0, 600),
(10, 35, 3, 0, 75);

-- --------------------------------------------------------

--
-- Structure de la table `results`
--

CREATE TABLE `results` (
  `id` int NOT NULL,
  `event_id` int NOT NULL,
  `participant_id` int NOT NULL
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
(4, 'Saman', 'Herallal', 'Saman', 'saman@baobab-ingenierie.fr', '$2y$10$o..97/bCcb2y.ge4JJ7hju7Wmq8uI793WyC01122TUvD25c4cU3a.', 'fr', 28, '2024-05-27 14:35:25', '2024-05-27 14:35:25', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `votes`
--

CREATE TABLE `votes` (
  `id` int NOT NULL,
  `event_id` int NOT NULL,
  `user_id` int NOT NULL,
  `vote` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `image_id` (`image_id`);

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
  ADD KEY `event_id` (`event_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `participant_id` (`participant_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `events`
--
ALTER TABLE `events`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT pour la table `images`
--
ALTER TABLE `images`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `participants`
--
ALTER TABLE `participants`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `results`
--
ALTER TABLE `results`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `events_ibfk_2` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`);

--
-- Contraintes pour la table `participants`
--
ALTER TABLE `participants`
  ADD CONSTRAINT `participants_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `participants_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `results_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`),
  ADD CONSTRAINT `results_ibfk_2` FOREIGN KEY (`participant_id`) REFERENCES `participants` (`id`);

--
-- Contraintes pour la table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`),
  ADD CONSTRAINT `votes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
