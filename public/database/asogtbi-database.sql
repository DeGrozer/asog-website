-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Feb 27, 2026 at 02:51 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `asogtbi-database`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `fullName` varchar(150) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'admin',
  `isActive` tinyint(1) NOT NULL DEFAULT 1,
  `lastLoginAt` datetime DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `fullName`, `email`, `password`, `role`, `isActive`, `lastLoginAt`, `createdAt`, `updatedAt`) VALUES
(3, 'ASOG Admin', 'admin@asog.local', '$2y$12$KO7JygwtpBFmOdbUExa0hOb3KvbKgMzsOzrFgw3nz5hwSKUL26rFm', 'superadmin', 1, '2026-02-27 01:17:39', '2026-02-25 14:38:17', '2026-02-27 01:17:39');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `shortDescription` varchar(500) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `imagePath` varchar(500) DEFAULT NULL,
  `sortOrder` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `isPublished` tinyint(1) NOT NULL DEFAULT 0,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `incubatees`
--

CREATE TABLE `incubatees` (
  `id` int(10) UNSIGNED NOT NULL,
  `companyName` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `founderName` varchar(150) DEFAULT NULL,
  `shortDescription` varchar(500) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `logoPath` varchar(500) DEFAULT NULL,
  `websiteUrl` varchar(500) DEFAULT NULL,
  `cohort` varchar(50) DEFAULT NULL,
  `teamMembers` text DEFAULT NULL,
  `sortOrder` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `isPublished` tinyint(1) NOT NULL DEFAULT 0,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `shortDescription` varchar(500) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `category` varchar(50) NOT NULL DEFAULT 'news',
  `imagePath` varchar(500) DEFAULT NULL,
  `isPublished` tinyint(1) NOT NULL DEFAULT 0,
  `isFeatured` tinyint(1) NOT NULL DEFAULT 0,
  `authorName` varchar(150) DEFAULT NULL,
  `publishedAt` datetime DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `slug`, `shortDescription`, `content`, `category`, `imagePath`, `isPublished`, `isFeatured`, `authorName`, `publishedAt`, `createdAt`, `updatedAt`) VALUES
(1, 'Lorem Ipsum dolor', 'lorem-ipsum-dolor', 'lorem ipsum dolor', '<p>&lt;p&gt;&amp;lt;p&amp;gt;asdasdasa  ,asudguaysgd iuasgdas &amp;lt;strong&amp;gt;hagsdjhgfasd &amp;lt;/strong&amp;gt;&amp;lt;a href=\"fb.com\" rel=\"noopener noreferrer\" target=\"_blank\"&amp;gt;&amp;lt;strong&amp;gt;dsfsdfsdfsdf&amp;lt;/strong&amp;gt;&amp;lt;/a&amp;gt;&amp;lt;/p&amp;gt;&lt;/p&gt;</p>', 'news', 'uploads/posts/1772001621_b1088aaf9289df64aef0.png', 1, 1, 'ASOG TBI', '2026-02-25 06:40:21', '2026-02-25 06:40:21', '2026-02-25 06:40:21'),
(2, 'ilukyjfthdg xvcm/k;jihlgmn', 'ilukyjfthdg-xvcmkjihlgmn', 'k\'oi;uytfjkjouiyfth', '<p>kjliuyfthxvbjiupyfg8ot78ytf,iyguh,iyt6r76tohipyyi</p>', 'features', 'uploads/posts/1772002379_a196a8aa2fee83195bad.png', 1, 0, 'ASOG TBI', '2026-02-25 01:17:54', '2026-02-25 06:52:59', '2026-02-27 01:17:55'),
(3, 'k;sajdhkgjv,', 'ksajdhkgjv', 'hscdvasugdlaisydfkausdgaksujdfasihkasu', '<h4><strong>a sdmhs,djhgas,jha,s <u>as.</u></strong><a href=\"facebook.com\" rel=\"noopener noreferrer\" target=\"_blank\"><strong><u>khdkajsfdkahskvgkasygais</u><em><u> </u></em></strong></a><strong><em><u>kausdkuaysgdkas</u></em></strong> sdjkgksudfgksdfgsdgsd </h4>', 'events', 'uploads/posts/1772006779_ad4d7fd6615dfacdfa8b.jpg', 1, 1, 'ASOG TBI', '2026-02-25 01:18:26', '2026-02-25 08:06:19', '2026-02-27 01:18:26'),
(4, 'AI tool powers ASOG TBI incubatees to Hack4SmartNaga victory', 'ai-tool-powers-asog-tbi-incubatees-to-hack4smartnaga-victory', 'A team incubated under the ASOG TBI won ₱20,000 at Hack4SmartNaga 2025 after pitching an artificial intelligence concept designed to help local governments assess typhoon damage more quickly and accurately.', '<p><span style=\"background-color: transparent; color: rgb(0, 0, 0);\">A team incubated under the ASOG TBI won ₱20,000 at Hack4SmartNaga 2025 after pitching an artificial intelligence concept designed to help local governments assess typhoon damage more quickly and accurately.</span></p><p><span style=\"background-color: transparent; color: rgb(0, 0, 0);\">Competing as Team INFRA, the group developed SAGIP (Storm Assessment and Geospatial Impact Profiling), which combines AI and geospatial data to identify areas affected by storms, supporting faster disaster response by local government units.</span></p><p><span style=\"background-color: transparent; color: rgb(0, 0, 0);\">Hack4SmartNaga 2025 brought together students, startups, and young professionals to create digital and science-based solutions aligned with Naga City’s goal of becoming more inclusive, resilient, and future-ready by 2028.</span></p><p><span style=\"background-color: transparent; color: rgb(0, 0, 0);\">The hackathon focused on four priority areas, including flood resilience, economic inclusion, public health, and participatory governance.</span></p><p><span style=\"background-color: transparent; color: rgb(0, 0, 0);\">SAGIP addressed the flood-resilience track by enabling more efficient damage assessment during extreme weather events, a recurring challenge for disaster-prone communities.</span></p><p><span style=\"background-color: transparent; color: rgb(0, 0, 0);\">Team INFRA is composed of Sean Xander Aquino, Joshua Jericho Barja, John Renzzo Montenegro, John Carlo Nas, and Divino Al Ricafort.</span></p><p><span style=\"background-color: transparent; color: rgb(0, 0, 0);\">The team receives mentorship and incubation support from ASOG TBI, an initiative of Camarines Sur Polytechnic Colleges that supports early-stage, technology-driven ventures.</span></p>', 'events', 'uploads/posts/1772089807_985ff302b74f785a6af6.png', 1, 1, 'ASOG TBI', '2025-11-04 07:48:47', '2026-02-26 06:29:47', '2026-02-26 07:48:47');

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `shortDescription` varchar(500) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `iconSvg` text DEFAULT NULL,
  `imagePath` varchar(500) DEFAULT NULL,
  `sortOrder` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `isPublished` tinyint(1) NOT NULL DEFAULT 0,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sitesettings`
--

CREATE TABLE `sitesettings` (
  `id` int(10) UNSIGNED NOT NULL,
  `settingKey` varchar(100) NOT NULL,
  `settingValue` text DEFAULT NULL,
  `settingGroup` varchar(50) NOT NULL DEFAULT 'general',
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sitesettings`
--

INSERT INTO `sitesettings` (`id`, `settingKey`, `settingValue`, `settingGroup`, `createdAt`, `updatedAt`) VALUES
(1, 'aboutTitle', 'Built for Bicol\'s Future', 'about', '2026-02-25 14:21:16', '2026-02-25 14:21:16'),
(2, 'aboutSubtitle', 'Who We Are', 'about', '2026-02-25 14:21:16', '2026-02-25 14:21:16'),
(3, 'aboutContent', '<p>ASOG TBI operates under Camarines Sur Polytechnic Colleges with funding from DOST-PCIEERD. We work alongside startups and MSMEs across the Bicol Region — helping them build real products around food value chain management through engineering and AI.</p><p>Our team provides hands-on support from prototyping and mentorship to market validation and IP protection — so founders can focus on what they do best.</p>', 'about', '2026-02-25 14:21:16', '2026-02-25 14:21:16'),
(4, 'aboutTags', 'AI Research,Food Value Chain,Startup Incubation,Engineering Innovation,MSME Support', 'about', '2026-02-25 14:21:16', '2026-02-25 14:21:16'),
(5, 'heroTagline', 'Join the Ecosystem', 'hero', '2026-02-25 14:21:16', '2026-02-25 14:21:16'),
(6, 'ctaTitle', 'Ready to Build your business with us?', 'cta', '2026-02-25 14:21:16', '2026-02-25 14:21:16'),
(7, 'ctaDescription', 'Apply to the ASOG TBI incubation program and get access to state-of-the-art facilities, mentorship, and funding opportunities.', 'cta', '2026-02-25 14:21:16', '2026-02-25 14:21:16'),
(8, 'ctaButtonText', 'Be an Incubatee', 'cta', '2026-02-25 14:21:16', '2026-02-25 14:21:16'),
(9, 'ctaButtonUrl', '#contact', 'cta', '2026-02-25 14:21:16', '2026-02-25 14:21:16'),
(10, 'ctaSecondaryText', 'Explore Our Program', 'cta', '2026-02-25 14:21:16', '2026-02-25 14:21:16'),
(11, 'ctaSecondaryUrl', '/programs', 'cta', '2026-02-25 14:21:16', '2026-02-25 14:21:16'),
(12, 'contactEmail', 'asogtbi@cspc.edu.ph', 'contact', '2026-02-25 14:21:16', '2026-02-25 14:21:16'),
(13, 'contactPhone', '', 'contact', '2026-02-25 14:21:16', '2026-02-25 14:21:16'),
(14, 'contactAddress', 'Camarines Sur Polytechnic Colleges, Nabua, Camarines Sur', 'contact', '2026-02-25 14:21:16', '2026-02-25 14:21:16'),
(15, 'facebookUrl', '#', 'contact', '2026-02-25 14:21:16', '2026-02-25 14:21:16'),
(16, 'instagramUrl', '#', 'contact', '2026-02-25 14:21:16', '2026-02-25 14:21:16');

-- --------------------------------------------------------

--
-- Table structure for table `teammembers`
--

CREATE TABLE `teammembers` (
  `id` int(10) UNSIGNED NOT NULL,
  `fullName` varchar(150) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `position` varchar(255) DEFAULT NULL,
  `shortBio` varchar(500) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `photoPath` varchar(500) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `linkedinUrl` varchar(500) DEFAULT NULL,
  `sortOrder` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `isPublished` tinyint(1) NOT NULL DEFAULT 0,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_admins_email` (`email`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_facilities_slug` (`slug`);

--
-- Indexes for table `incubatees`
--
ALTER TABLE `incubatees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_incubatees_slug` (`slug`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_posts_slug` (`slug`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_programs_slug` (`slug`);

--
-- Indexes for table `sitesettings`
--
ALTER TABLE `sitesettings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_settings_key` (`settingKey`);

--
-- Indexes for table `teammembers`
--
ALTER TABLE `teammembers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_team_slug` (`slug`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `incubatees`
--
ALTER TABLE `incubatees`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sitesettings`
--
ALTER TABLE `sitesettings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `teammembers`
--
ALTER TABLE `teammembers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
