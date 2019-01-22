-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  jeu. 17 jan. 2019 à 15:23
-- Version du serveur :  5.6.38
-- Version de PHP :  7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `author` varchar(60) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `comment_date` datetime NOT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `author`, `user_id`, `comment`, `comment_date`, `status`) VALUES
(4, 2, 'James', 9, 'Preum\'s !', '2010-03-27 00:00:00', 1),
(5, 2, 'James', 9, 'Excellente analyse de la situation !\r\nIl y arrivera plus tôt qu\'on ne le pense !', '2010-03-27 00:00:00', 1),
(6, 2, 'Ilian', 13, 'Love this yeah!', '2018-11-11 00:00:00', 1),
(7, 2, 'James', 9, 'Hi, new here. Love this place!', '2018-11-11 00:00:00', 1),
(8, 2, 'Jane', 1, 'J\'adore', '2018-11-11 00:00:00', 1),
(9, 2, 'Jane', 1, 'So fun!', '2018-11-11 00:00:00', 1),
(10, 6, 'toto', 7, 'We are all mad here!', '2018-12-29 00:00:00', 1),
(11, 6, 'James', 9, ' Boop!', '2018-12-18 00:00:00', 1),
(16, 2, 'Jane', 1, 'Hey world!', '2019-01-03 00:00:00', 1),
(31, 22, 'James', 9, 'First comment!', '2019-01-08 13:17:32', 1),
(32, 22, 'James', 9, 'bcizga :D', '2019-01-08 14:25:27', 1),
(34, 22, 'Ilian', 13, 'Interesting!', '2019-01-10 15:21:16', NULL),
(35, 22, 'Ilian', 13, '&lt;strong&gt;hello&lt;/strong&gt;', '2019-01-10 17:18:29', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(60) NOT NULL,
  `content` text NOT NULL,
  `creation_date` datetime NOT NULL,
  `edition_date` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `title`, `author`, `content`, `creation_date`, `edition_date`, `status`) VALUES
(2, 'About me :D', 'Jessica', 'Hi guys, my name is Jessica! \r\nI am a webdesigner.', '2018-12-18 16:22:26', '2018-12-30 15:07:47', 1),
(5, 'Un bon chocolat chaud', 'James', 'En ces températures hivernales, rien ne vaut un bon chocolat chaud pour se réchauffer.', '2018-11-26 14:01:39', NULL, 1),
(6, 'Wonderland', 'Alice', 'Who\'s seen the white rabbit, running this way, looking late, taking shortcuts to the Wonderland? Should I follow the white rabbit to this weird land, of smoke and tea, and turn insane?', '2018-11-26 14:28:13', '2019-01-03 11:33:12', 1),
(22, 'The truth behind PHP... The evil PHP!', 'Ilian', 'Phasellus a orci purus. Phasellus lacinia quam nec mauris blandit, posuere elementum nibh posuere. Donec faucibus pulvinar erat, at rhoncus nisl posuere mattis. Morbi nec accumsan orci, nec iaculis velit. In ultricies sem eu ante bibendum, a finibus arcu ornare. Etiam fermentum sodales diam. Vestibulum eu rutrum risus. Sed in tellus nec nisl lacinia tristique. Suspendisse urna nibh, tincidunt eu porttitor ac, mollis id dolor. Sed tincidunt, magna eget finibus bibendum, augue libero consectetur justo, ut tempus elit massa et odio. Donec lobortis ligula non facilisis congue. Etiam odio sapien, finibus sollicitudin nibh a, malesuada semper metus. Duis vehicula viverra semper. Praesent viverra nisi eget ipsum tincidunt ultricies.', '2019-01-08 11:36:39', '2019-01-17 14:45:27', 1),
(44, 'Item 1', 'Ilian', 'Item 1, 2, 3', '2019-01-16 14:09:15', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `profiles`
--

CREATE TABLE `profiles` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `profiles`
--

INSERT INTO `profiles` (`id`, `description`) VALUES
(1, 'member'),
(2, 'collaborator'),
(3, 'administrator'),
(4, 'unvalidated');

-- --------------------------------------------------------

--
-- Structure de la table `profiles_rights`
--

CREATE TABLE `profiles_rights` (
  `profile_id` int(11) NOT NULL,
  `right_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `profiles_rights`
--

INSERT INTO `profiles_rights` (`profile_id`, `right_id`) VALUES
(1, 4),
(1, 5),
(2, 1),
(2, 2),
(3, 4),
(3, 1),
(3, 7),
(3, 6),
(3, 3),
(3, 5),
(3, 2),
(2, 4),
(2, 5),
(3, 8),
(3, 9);

-- --------------------------------------------------------

--
-- Structure de la table `rights`
--

CREATE TABLE `rights` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `rights`
--

INSERT INTO `rights` (`id`, `description`) VALUES
(1, 'add post'),
(2, 'edit post'),
(3, 'delete post'),
(4, 'add comment'),
(5, 'edit comment'),
(6, 'delete comment'),
(7, 'add user'),
(8, 'validate'),
(9, 'delete user');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(90) NOT NULL,
  `signup_date` datetime NOT NULL,
  `login_date` datetime NOT NULL,
  `profile_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `pseudo`, `password`, `email`, `signup_date`, `login_date`, `profile_id`) VALUES
(1, 'Jane', '3e744b9dc39389baf0c5a0660589b8402f3dbb49b89b3e75f2c9355852a3', 'test@test.com', '2018-12-29 12:39:54', '2018-12-29 12:39:54', 3),
(7, 'toto', '31f7a65e315586ac198bd798b6629ce4903d0899476d5741a9f32e2e521b6a66', 'toto@toto.toto', '2018-12-29 16:58:13', '2018-12-29 16:58:13', 3),
(9, 'James', 'f21dea74d898cfeaf836ecc99ad0331bade09711ff927365e91ada2ff4cb5caf', 'james.bond@mi6.uk', '2018-12-29 17:15:45', '2018-12-29 17:15:45', 1),
(13, 'Ilian', '200db1b1414722036ac0e407c3215ed818650371477b19dee9d9616291917d02', 'test@test.com', '2018-12-30 13:19:28', '2018-12-30 13:19:28', 3),
(14, 'ibanez1', '3e24733f285f9d873aa5208d4c29d94349466d0a340e4247409b9bfd46b490aa', 'arnez50@yahoo.fr', '2018-12-30 13:29:00', '2018-12-30 13:29:00', 1),
(15, 'Kate', '2c249473aa501c43f154cc5bd2332c4c5ab5281cdc7c22ba049724882eda25f7', 'kate.moss@moss.com', '2018-12-31 12:23:01', '2018-12-31 12:23:01', 2),
(18, 'Loane', '9eed46f97a2dccba75c2493e1b7460c15ffec7b797f1e4bfe651c1a2ce8fc5b9', 'test@test.com', '2019-01-08 14:44:59', '2019-01-08 14:44:59', 2),
(19, 'Near', '46ba34770bccfde756708d47d83fb7c8257fe8a4b3a35f25d385a8284021f476', 'test@test.com', '2019-01-14 16:01:00', '2019-01-14 16:01:00', 4),
(20, 'Mello', '4d8f5a95d189a978c8a29c88cee32dbd87468a6cb839c32057931dccfbd0b6dd', 'm@detective.com', '2019-01-17 11:59:41', '2019-01-17 11:59:41', 4);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `profiles_rights`
--
ALTER TABLE `profiles_rights`
  ADD KEY `profile_id` (`profile_id`),
  ADD KEY `right_id` (`right_id`);

--
-- Index pour la table `rights`
--
ALTER TABLE `rights`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_profile_id` (`profile_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT pour la table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `rights`
--
ALTER TABLE `rights`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `post_id` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `profiles_rights`
--
ALTER TABLE `profiles_rights`
  ADD CONSTRAINT `profile_id` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `right_id` FOREIGN KEY (`right_id`) REFERENCES `rights` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `user_profile_id` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
