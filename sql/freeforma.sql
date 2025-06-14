CREATE TABLE `User` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `fullname` varchar(255),
  `email` varchar(255),
  `foto` varchar(255),
  `password` varchar(255),
  `role` enum('user','admin'),
  `isActive` boolean DEFAULT true,
  resetPasswordToken varchar(255) DEFAULT NULL,
);

CREATE TABLE `Template` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `templateName` varchar(255),
  `author` int,
  `deskripsi` longtext,
  `coverImage` varchar(255),
  `fileTemplate` varchar(255),
  `likeCount` int,
  `downloadCount` int,
  `approvalStatus` enum('pending','accepted','rejected'),
  `createdAt` timestamp,
  `updatedAt` timestamp
);

CREATE TABLE `TemplateLikes` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `userId` int,
  `templateId` int,
  `like` boolean
);

CREATE TABLE `TemplateDownloads` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `userId` int,
  `templateId` int,
  `download` boolean
);

ALTER TABLE `Template` ADD FOREIGN KEY (`author`) REFERENCES `User` (`id`);

ALTER TABLE `TemplateLikes` ADD FOREIGN KEY (`userId`) REFERENCES `User` (`id`);

ALTER TABLE `TemplateLikes` ADD FOREIGN KEY (`templateId`) REFERENCES `Template` (`id`);

ALTER TABLE `TemplateDownloads` ADD FOREIGN KEY (`userId`) REFERENCES `User` (`id`);

ALTER TABLE `TemplateDownloads` ADD FOREIGN KEY (`templateId`) REFERENCES `Template` (`id`);
