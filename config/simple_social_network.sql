-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 13. Jul 2017 um 21:26
-- Server-Version: 10.1.19-MariaDB
-- PHP-Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `simple social network`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `from_user` varchar(255) NOT NULL,
  `to_user` varchar(255) NOT NULL,
  `message` varchar(10000) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `deactivated_accounts`
--

CREATE TABLE `deactivated_accounts` (
  `id` int(6) NOT NULL,
  `user_id` int(6) NOT NULL,
  `deactivated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `password_recovery`
--

CREATE TABLE `password_recovery` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expire_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `posts`
--

CREATE TABLE `posts` (
  `id` int(6) UNSIGNED NOT NULL,
  `user_id` int(6) NOT NULL,
  `post_type` varchar(5) NOT NULL,
  `post_text` text NOT NULL,
  `youtube_link` varchar(255) NOT NULL,
  `image_directory` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `posted_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `post_type`, `post_text`, `youtube_link`, `image_directory`, `link`, `posted_at`) VALUES
(16, 1, 'text', 'Wow! Das Simple Social Network ist echt voll super! :D', '', '', '', '2017-07-13 19:15:03'),
(17, 2, 'video', 'Voll praktisch, dass man auch ganz einfach ein YouTube-Video posten kann! =P', 'https://www.youtube.com/embed/YvGlBFjxvgY', '', '', '2017-07-13 19:16:40'),
(18, 3, 'link', 'Schaut euch mal diese Website ein! Richtig cooles Projekt! o.O', '', '', 'http://localhost/SimpleSocialNetwork/index.php', '2017-07-13 19:17:42'),
(19, 3, 'image', 'Much wow... so Bild!', '', 'ecc9527868ecabeb3da29b69ef1a1f44', '', '2017-07-13 19:22:24');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(6) UNSIGNED NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `activated` enum('0','1') NOT NULL DEFAULT '0',
  `avatar` varchar(255) NOT NULL DEFAULT './avatar-uploads/default-avatar.jpg',
  `banner` varchar(255) NOT NULL DEFAULT './banner-uploads/default-banner.jpg',
  `join_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `activated`, `avatar`, `banner`, `join_date`) VALUES
(1, 'RUBEN', '$2y$10$JsmSS1R4B1FxrW7TFhwi.ugxZ13XfsfCiY.N.hx/GYJvBJ1MbQ4fi', 'r.winkler1412@gmail.com', '1', './avatar-uploads/default-avatar.jpg', './banner-uploads/default-banner.jpg', '2017-07-13 17:16:08'),
(2, 'XenonNeox', '$2y$10$.NVvevHS5X8pZyxR1v19oOnhge2norQWwAyaABc/s2.v0BQJFeVKa', 'xenon.neox@gmail.com', '1', './avatar-uploads/default-avatar.jpg', './banner-uploads/default-banner.jpg', '2017-07-13 17:16:15'),
(3, 'Tester01', '$2y$10$tYKE9FhNcnzw7IkBWZ9otOSdzMtLjeFP0ICYv0G2by5lLKDWzW3iK', 'ruben.vlogsgamesmehr@gmail.com', '1', './avatar-uploads/default-avatar.jpg', './banner-uploads/default-banner.jpg', '2017-07-13 17:16:18'),
(4, 'Tester02', '$2y$10$GtN2OnBeaMd3iUYV5rSy6OOND64tnFrEIzryE30q8Vhjb9RjeeLUq', 'kontakt@division-network.de', '1', './avatar-uploads/default-avatar.jpg', './banner-uploads/default-banner.jpg', '2017-07-13 17:16:21'),
(5, 'Tester03', '$2y$10$EjznSAOFhYjkYHhMEPOD9e506Hw8B1CgpzJctRXB5DE28V9uLTG1C', 'ruben.winkler@division-network.de', '1', './avatar-uploads/default-avatar.jpg', './banner-uploads/default-banner.jpg', '2017-07-13 17:16:23');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `deactivated_accounts`
--
ALTER TABLE `deactivated_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `password_recovery`
--
ALTER TABLE `password_recovery`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `deactivated_accounts`
--
ALTER TABLE `deactivated_accounts`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `password_recovery`
--
ALTER TABLE `password_recovery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT für Tabelle `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
