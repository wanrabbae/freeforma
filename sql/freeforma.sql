-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 15, 2025 at 03:05 PM
-- Server version: 5.7.39
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `freeforma`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `AddTemplateLike` (IN `p_userId` INT, IN `p_templateId` INT)   BEGIN
    -- Check if the user has already liked the template
    IF NOT EXISTS (
        SELECT 1 FROM TemplateLikes
        WHERE userId = p_userId AND templateId = p_templateId
    ) THEN
        -- Insert new like
        INSERT INTO TemplateLikes (userId, templateId, `like`)
        VALUES (p_userId, p_templateId, 1);

        -- Update likeCount in Template
        UPDATE Template
        SET likeCount = likeCount + 1
        WHERE id = p_templateId;
    END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `Template`
--

CREATE TABLE `Template` (
  `id` int(11) NOT NULL,
  `templateName` varchar(255) DEFAULT NULL,
  `author` int(11) DEFAULT NULL,
  `deskripsi` longtext,
  `coverImage` varchar(255) DEFAULT NULL,
  `fileTemplate` varchar(255) DEFAULT NULL,
  `likeCount` int(11) NOT NULL DEFAULT '0',
  `downloadCount` int(11) NOT NULL DEFAULT '0',
  `category` enum('Skripsi & Tesis','Jurnal & Artikel','CV Akademik & Resume','Presentasi','Lainnya') NOT NULL DEFAULT 'Lainnya',
  `approvalStatus` enum('pending','accepted','rejected') DEFAULT 'pending',
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Template`
--

INSERT INTO `Template` (`id`, `templateName`, `author`, `deskripsi`, `coverImage`, `fileTemplate`, `likeCount`, `downloadCount`, `category`, `approvalStatus`, `isActive`, `createdAt`, `updatedAt`) VALUES
(5, 'HNSP Jurnal', 11, '<p><strong>asdasdas</strong></p>\r\n\r\n<p> </p>\r\n\r\n<p><strong><em>asdasdas</em></strong></p>\r\n\r\n<p> </p>\r\n\r\n<ol>\r\n	<li><strong><em>asdas</em></strong></li>\r\n	<li><strong><em>asdasdsa</em></strong></li>\r\n	<li><strong><em>sad</em></strong></li>\r\n</ol>\r\n', 'cover_684e5fad0ebeb.png', 'template_684e58a6b4d4d.pdf', 0, 2, 'Jurnal & Artikel', 'accepted', 1, '2025-06-15 12:23:57', '2025-06-15 05:22:46'),
(8, 'Lorem ipsum 222', 11, '<p>adasdasadd</p>\r\n', 'cover_684e708f5d0f9.png', 'template_684e708f5d363.pdf', 0, 0, 'Skripsi & Tesis', 'accepted', 0, '2025-06-15 07:27:04', '2025-06-15 07:04:47'),
(9, 'HNSP Jurnal', 11, '<p><strong>asdasdas</strong></p>\r\n\r\n<p> </p>\r\n\r\n<p><strong><em>asdasdas</em></strong></p>\r\n\r\n<p> </p>\r\n\r\n<ol>\r\n	<li><strong><em>asdas</em></strong></li>\r\n	<li><strong><em>asdasdsa</em></strong></li>\r\n	<li><strong><em>sad</em></strong></li>\r\n</ol>\r\n', 'cover_684e5fad0ebeb.png', 'template_345353434.docx', 0, 2, 'CV Akademik & Resume', 'accepted', 1, '2025-06-15 12:25:07', '2025-06-15 05:22:46'),
(10, 'HNSP Jurnal', 11, '<p><strong>asdasdas</strong></p>\r\n\r\n<p> </p>\r\n\r\n<p><strong><em>asdasdas</em></strong></p>\r\n\r\n<p> </p>\r\n\r\n<ol>\r\n	<li><strong><em>asdas</em></strong></li>\r\n	<li><strong><em>asdasdsa</em></strong></li>\r\n	<li><strong><em>sad</em></strong></li>\r\n</ol>\r\n', 'cover_684e5fad0ebeb.png', 'template_684e58a6b4d4d.pptx', 0, 0, 'Skripsi & Tesis', 'accepted', 1, '2025-06-15 11:57:24', '2025-06-15 05:22:46'),
(11, 'HNSP Jurnal', 11, '<p><strong>asdasdas</strong></p>\r\n\r\n<p> </p>\r\n\r\n<p><strong><em>asdasdas</em></strong></p>\r\n\r\n<p> </p>\r\n\r\n<ol>\r\n	<li><strong><em>asdas</em></strong></li>\r\n	<li><strong><em>asdasdsa</em></strong></li>\r\n	<li><strong><em>sad</em></strong></li>\r\n</ol>\r\n', 'cover_684e5fad0ebeb.png', 'template_684e58a6b4d4d.tex', 0, 1, 'Skripsi & Tesis', 'accepted', 1, '2025-06-15 12:28:23', '2025-06-15 05:22:46'),
(12, 'HNSP Jurnal', 11, '<p><strong>asdasdas</strong></p>\r\n\r\n<p> </p>\r\n\r\n<p><strong><em>asdasdas</em></strong></p>\r\n\r\n<p> </p>\r\n\r\n<ol>\r\n	<li><strong><em>asdas</em></strong></li>\r\n	<li><strong><em>asdasdsa</em></strong></li>\r\n	<li><strong><em>sad</em></strong></li>\r\n</ol>\r\n', 'cover_684e5fad0ebeb.png', 'template_684e58a6b4d4d.pdf', 0, 0, 'Skripsi & Tesis', 'accepted', 1, '2025-06-15 11:57:24', '2025-06-15 05:22:46'),
(13, 'HNSP Jurnal', 11, '<p><strong>asdasdas</strong></p>\r\n\r\n<p> </p>\r\n\r\n<p><strong><em>asdasdas</em></strong></p>\r\n\r\n<p> </p>\r\n\r\n<ol>\r\n	<li><strong><em>asdas</em></strong></li>\r\n	<li><strong><em>asdasdsa</em></strong></li>\r\n	<li><strong><em>sad</em></strong></li>\r\n</ol>\r\n', 'cover_684e5fad0ebeb.png', 'template_684e58a6b4d4d.pdf', 0, 0, 'Skripsi & Tesis', 'accepted', 1, '2025-06-15 11:57:24', '2025-06-15 05:22:46'),
(14, 'HNSP Jurnal', 11, '<p><strong>asdasdas</strong></p>\r\n\r\n<p> </p>\r\n\r\n<p><strong><em>asdasdas</em></strong></p>\r\n\r\n<p> </p>\r\n\r\n<ol>\r\n	<li><strong><em>asdas</em></strong></li>\r\n	<li><strong><em>asdasdsa</em></strong></li>\r\n	<li><strong><em>sad</em></strong></li>\r\n</ol>\r\n', 'cover_684e5fad0ebeb.png', 'template_684e58a6b4d4d.pdf', 0, 0, 'Skripsi & Tesis', 'accepted', 1, '2025-06-15 11:57:24', '2025-06-15 05:22:46'),
(15, 'HNSP Jurnal', 11, '<p><strong>asdasdas</strong></p>\r\n\r\n<p> </p>\r\n\r\n<p><strong><em>asdasdas</em></strong></p>\r\n\r\n<p> </p>\r\n\r\n<ol>\r\n	<li><strong><em>asdas</em></strong></li>\r\n	<li><strong><em>asdasdsa</em></strong></li>\r\n	<li><strong><em>sad</em></strong></li>\r\n</ol>\r\n', 'cover_684e5fad0ebeb.png', 'template_684e58a6b4d4d.pdf', 0, 0, 'Skripsi & Tesis', 'accepted', 1, '2025-06-15 11:57:24', '2025-06-15 05:22:46');

-- --------------------------------------------------------

--
-- Table structure for table `TemplateDownloads`
--

CREATE TABLE `TemplateDownloads` (
  `id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `templateId` int(11) DEFAULT NULL,
  `download` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `TemplateDownloads`
--

INSERT INTO `TemplateDownloads` (`id`, `userId`, `templateId`, `download`) VALUES
(2, NULL, 5, 1),
(3, NULL, 9, 1),
(4, NULL, 9, 1),
(5, NULL, 5, 1),
(6, NULL, 11, 1);

--
-- Triggers `TemplateDownloads`
--
DELIMITER $$
CREATE TRIGGER `trg_increment_download_count` AFTER INSERT ON `TemplateDownloads` FOR EACH ROW BEGIN
  -- Update downloadCount in Template where id matches the inserted templateId
  UPDATE Template
  SET downloadCount = downloadCount + 1
  WHERE id = NEW.templateId;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `TemplateLikes`
--

CREATE TABLE `TemplateLikes` (
  `id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `templateId` int(11) DEFAULT NULL,
  `like` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Triggers `TemplateLikes`
--
DELIMITER $$
CREATE TRIGGER `trg_decrement_like_count` AFTER DELETE ON `TemplateLikes` FOR EACH ROW BEGIN
    UPDATE Template
    SET likeCount = likeCount - 1
    WHERE id = OLD.templateId;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('user','admin') DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `resetPasswordToken` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`id`, `fullname`, `email`, `foto`, `password`, `role`, `isActive`, `resetPasswordToken`) VALUES
(2, 'Admin22232432', 'admin@gmail.com', '684d6c4a195a0-ALWAN_PASFOTO_DASI_ITEM-removebg-preview-removebg-preview (1).jpg', '$2a$12$wYMA82gVE2eLeLmASlW.Zue3AsYcjlykD4EWyJDgLDGRHQIzCx42u', 'admin', 1, 'cd631a398791c33e420af372019af42c'),
(11, 'wan test2222', 'wan@gmail.com', '684d60c6b8e6d-1-kai-angkut-267-juta-ton-barang-di-semester-i-2021.jpeg', '$2a$12$wYMA82gVE2eLeLmASlW.Zue3AsYcjlykD4EWyJDgLDGRHQIzCx42u', 'user', 1, NULL),
(14, 'Jane Doe', 'user1@gmail.com', '684e1f15086f9-ca14bec8db80f84cd40d7d7b20e9378bde-23-doctor-who-matt-smith1.rsquare.w700.jpg.webp', '$2a$12$wYMA82gVE2eLeLmASlW.Zue3AsYcjlykD4EWyJDgLDGRHQIzCx42u', 'user', 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Template`
--
ALTER TABLE `Template`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author` (`author`);

--
-- Indexes for table `TemplateDownloads`
--
ALTER TABLE `TemplateDownloads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`),
  ADD KEY `templateId` (`templateId`);

--
-- Indexes for table `TemplateLikes`
--
ALTER TABLE `TemplateLikes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`),
  ADD KEY `templateId` (`templateId`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Template`
--
ALTER TABLE `Template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `TemplateDownloads`
--
ALTER TABLE `TemplateDownloads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `TemplateLikes`
--
ALTER TABLE `TemplateLikes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Template`
--
ALTER TABLE `Template`
  ADD CONSTRAINT `template_ibfk_1` FOREIGN KEY (`author`) REFERENCES `User` (`id`);

--
-- Constraints for table `TemplateDownloads`
--
ALTER TABLE `TemplateDownloads`
  ADD CONSTRAINT `templatedownloads_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `User` (`id`),
  ADD CONSTRAINT `templatedownloads_ibfk_2` FOREIGN KEY (`templateId`) REFERENCES `Template` (`id`);

--
-- Constraints for table `TemplateLikes`
--
ALTER TABLE `TemplateLikes`
  ADD CONSTRAINT `templatelikes_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `User` (`id`),
  ADD CONSTRAINT `templatelikes_ibfk_2` FOREIGN KEY (`templateId`) REFERENCES `Template` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
