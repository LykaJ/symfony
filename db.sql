-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 10, 2019 at 07:37 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `symfony`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'grab'),
(2, 'rotate'),
(3, 'flip'),
(4, 'offset rotation'),
(5, 'slide'),
(6, 'one foot'),
(7, 'old school');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `trick_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `creation_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `trick_id`, `author_id`, `content`, `creation_date`) VALUES
(1, 18, 4, 'First comment', '2019-03-12 09:59:05'),
(2, 18, 4, 'Comment', '2019-03-12 12:56:31'),
(3, 18, 4, 'Comment', '2019-03-12 12:58:18'),
(4, 18, 4, 'Comment', '2019-03-12 12:58:51'),
(5, 20, 4, 'hey!', '2019-03-12 13:00:09'),
(8, 18, 9, 'comment', '2019-03-13 13:29:10'),
(9, 23, 9, 'test comment', '2019-03-13 13:56:10'),
(10, 20, 9, 'Nice!', '2019-03-19 15:04:36'),
(11, 18, 10, 'So cool !', '2019-03-21 15:24:14'),
(12, 18, 11, 'hello !', '2019-03-21 16:09:48'),
(13, 27, 11, 'Waouh, nice trick!', '2019-03-29 10:23:41'),
(14, 27, 9, 'Right, this one is impressive !', '2019-03-29 10:24:18'),
(15, 18, 9, 'Hello ! \r\n\r\nJust wanted to say that I like this trick. Hard to do, but very satisfying in the end. \r\n\r\nWho else does it?', '2019-04-03 10:56:17'),
(16, 18, 9, 'Test', '2019-04-04 12:33:35'),
(17, 18, 9, 'Fake comment!', '2019-04-04 17:49:54'),
(18, 18, 11, 'Comment !!!!', '2019-04-04 17:50:43'),
(19, 27, 11, 'Love the image !', '2019-04-05 07:14:42');

-- --------------------------------------------------------

--
-- Table structure for table `image_media`
--

CREATE TABLE `image_media` (
  `id` int(11) NOT NULL,
  `trick_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `image_media`
--

INSERT INTO `image_media` (`id`, `trick_id`, `name`) VALUES
(31, 50, '0cfc9b073617122bb308eb2fb7c47a1f.jpeg'),
(32, 50, '72c8dc4c06d7a5d961cf2cfd37859d9c.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset`
--

CREATE TABLE `password_reset` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trick`
--

CREATE TABLE `trick` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `creation_date` datetime NOT NULL,
  `edition_date` datetime DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `author_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trick`
--

INSERT INTO `trick` (`id`, `title`, `content`, `creation_date`, `edition_date`, `category_id`, `author_id`, `image`) VALUES
(18, 'Mute', 'saisie de la carre frontside de la planche entre les deux pieds avec la main avant', '2019-03-11 17:14:36', '2019-03-16 22:36:32', 1, 4, 'ebe8fa27a57fdec6ee28af71006cc18c.jpg'),
(20, 'Sad', 'saisie de la carre backside de la planche, entre les deux pieds, avec la main avant', '2019-03-11 17:19:53', '2019-03-18 13:42:25', 1, 4, '652f9a80eaabda1f6b191ccb3731a143.jpg'),
(21, 'Indy', 'saisie de la carre frontside de la planche, entre les deux pieds, avec la main arrière', '2019-03-11 17:20:12', '2019-03-19 13:34:23', 1, 4, 'b8f43612c3171db5a81e1b3985989fb1.jpg'),
(23, 'Tail grab', 'tail grab', '2019-03-11 17:20:44', '2019-03-19 14:53:21', 1, 4, 'f363387d4d3f42d463faefbda3e3ce1e.jpg'),
(24, 'Nose grab', 'saisie de la partie avant de la planche, avec la main avant', '2019-03-11 17:21:09', '2019-03-19 14:55:10', 1, 4, 'b582c55d3d4df66c670521ba3646f8fa.jpg'),
(25, 'Japan', 'saisie de l\'avant de la planche, avec la main avant, du côté de la carre frontside.', '2019-03-11 17:21:23', '2019-03-19 14:56:52', 1, 4, 'a52277e22885fed5d818d6b43c462868.jpg'),
(26, '180', 'un demi-tour, soit 180 degrés d\'angle', '2019-03-11 17:21:51', '2019-03-20 15:27:57', 2, 4, '814272917c1df5c9f066fe0da5ff571d.jpg'),
(27, '360', 'trois six pour un tour complet', '2019-03-12 08:13:48', '2019-03-19 14:59:40', 2, 5, 'f0cbfda6d74db6f981f0bc6bd278ce4a.jpg'),
(50, 'Stalefish', 'saisie de la carre backside de la planche entre les deux pieds avec la main arrière', '2019-04-09 08:44:33', '2019-04-09 08:44:34', 1, 11, 'f6887cf5d6b7fa6eee7623d5116bf697.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `real_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `signup_date` datetime NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `real_name`, `email`, `password`, `signup_date`, `last_login`, `picture`, `role`, `token`) VALUES
(4, 'demo', 'Jack Sparrow', 'pirate@carabiean.com', '$2y$12$nouk/iHz2kwQYEzPPwjsV.ptDCerxvWpFpiR.ZYm6idmL7/pK1bby', '2019-03-11 17:14:15', '2019-03-11 17:14:15', NULL, 'ROLE_USER', NULL),
(5, 'admin', 'Admin', 'admin@email.com', '$2y$12$fX46bW013gQf/mvkgAXmju14FWQfdV5z3But4FnE4OI2JXp36B2ey', '2019-03-12 08:12:45', '2019-03-12 08:12:45', NULL, 'ROLE_ADMIN', NULL),
(9, 'Ilian', 'Ilian Jake', 'test@test.com', '$2y$12$Sf18bGJ/IKTH57xGYqaTkOHi8VhQHsWJwEWvd9NZh2Py2dmzc/Edy', '2019-03-12 16:34:24', '2019-03-12 16:34:24', NULL, 'ROLE_USER', NULL),
(10, 'JaneDoe', 'Jane Doe', 'webdesigner.form@gmail.com', '$2y$12$JX7OnLA3pL/8j7TuQfq2Ru4uENoolxcVVXD6k1hCcn.eV8zXsFF9.', '2019-03-21 14:47:37', '2019-03-21 14:47:37', NULL, 'ROLE_USER', NULL),
(11, 'Lyka', 'Lyka Joane', 'raulet.alicia@gmail.com', '$2y$12$iQvavcPek/ylVi/LF110M.E1efW3B0usefHVKuEIWLA1p17JFWW2W', '2019-03-21 15:59:37', '2019-03-21 15:59:37', 'f733216e7254669dd2b09251498e3e25.png', 'ROLE_USER', NULL),
(12, 'Test', 'Test', 'test@email.com', '$2y$12$dEgQjw7vWt8x4QBvQhkF8.4GszI.y7tqjBvQ0b6.XLjWUbLvNpUf2', '2019-04-10 09:35:57', '2019-04-10 09:35:57', NULL, 'ROLE_USER', NULL),
(13, 'Test2', 'Test', 'test2@email.com', '$2y$12$Ptx8B9HneBbrr4zweZkMv.uBNZq7xxI1RtmI15GlPFAtdwukPU1Ku', '2019-04-10 09:37:54', '2019-04-10 09:37:54', NULL, 'ROLE_USER', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `video_media`
--

CREATE TABLE `video_media` (
  `id` int(11) NOT NULL,
  `trick_id` int(11) DEFAULT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `video_media`
--

INSERT INTO `video_media` (`id`, `trick_id`, `path`) VALUES
(14, 18, 'https://www.youtube.com/embed/51sQRIK-TEI'),
(20, 50, 'https://www.youtube.com/embed/51sQRIK-TEI'),
(21, 50, 'https://www.youtube.com/embed/f9FjhCt_w2U');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9474526CB281BE2E` (`trick_id`),
  ADD KEY `IDX_9474526CF675F31B` (`author_id`);

--
-- Indexes for table `image_media`
--
ALTER TABLE `image_media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7D6925A5B281BE2E` (`trick_id`);

--
-- Indexes for table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_B1017252A76ED395` (`user_id`);

--
-- Indexes for table `trick`
--
ALTER TABLE `trick`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D8F0A91E12469DE2` (`category_id`),
  ADD KEY `IDX_D8F0A91EF675F31B` (`author_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `video_media`
--
ALTER TABLE `video_media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E54EA8AEB281BE2E` (`trick_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `image_media`
--
ALTER TABLE `image_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `password_reset`
--
ALTER TABLE `password_reset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trick`
--
ALTER TABLE `trick`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `video_media`
--
ALTER TABLE `video_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_9474526CB281BE2E` FOREIGN KEY (`trick_id`) REFERENCES `trick` (`id`),
  ADD CONSTRAINT `FK_9474526CF675F31B` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `image_media`
--
ALTER TABLE `image_media`
  ADD CONSTRAINT `FK_7D6925A5B281BE2E` FOREIGN KEY (`trick_id`) REFERENCES `trick` (`id`);

--
-- Constraints for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD CONSTRAINT `FK_B1017252A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `trick`
--
ALTER TABLE `trick`
  ADD CONSTRAINT `FK_D8F0A91E12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `FK_D8F0A91EF675F31B` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `video_media`
--
ALTER TABLE `video_media`
  ADD CONSTRAINT `FK_E54EA8AEB281BE2E` FOREIGN KEY (`trick_id`) REFERENCES `trick` (`id`);
