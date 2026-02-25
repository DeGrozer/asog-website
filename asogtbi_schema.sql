-- ════════════════════════════════════════════════════════════════════════
-- ASOG TBI — Complete Database Schema
-- Database : asogtbi-database
-- Charset  : utf8mb4 / utf8mb4_general_ci
-- Port     : 3307
-- ════════════════════════════════════════════════════════════════════════

SET FOREIGN_KEY_CHECKS = 0;

-- ─── admins ────────────────────────────────────────────────────────────
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
    `id`          INT UNSIGNED  AUTO_INCREMENT PRIMARY KEY,
    `fullName`    VARCHAR(150)  NOT NULL,
    `email`       VARCHAR(255)  NOT NULL,
    `password`    VARCHAR(255)  NOT NULL,
    `role`        VARCHAR(50)   NOT NULL DEFAULT 'admin',
    `isActive`    TINYINT(1)    NOT NULL DEFAULT 1,
    `lastLoginAt` DATETIME      NULL,
    `createdAt`   DATETIME      NULL,
    `updatedAt`   DATETIME      NULL,
    UNIQUE KEY `idx_admins_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ─── posts ─────────────────────────────────────────────────────────────
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
    `id`               INT UNSIGNED  AUTO_INCREMENT PRIMARY KEY,
    `title`            VARCHAR(255)  NOT NULL,
    `slug`             VARCHAR(255)  NOT NULL,
    `shortDescription` VARCHAR(500)  NULL,
    `content`          TEXT          NULL,
    `category`         VARCHAR(50)   NOT NULL DEFAULT 'news',
    `imagePath`        VARCHAR(500)  NULL,
    `isPublished`      TINYINT(1)    NOT NULL DEFAULT 0,
    `isFeatured`       TINYINT(1)    NOT NULL DEFAULT 0,
    `authorName`       VARCHAR(150)  NULL,
    `publishedAt`      DATETIME      NULL,
    `createdAt`        DATETIME      NULL,
    `updatedAt`        DATETIME      NULL,
    UNIQUE KEY `idx_posts_slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ─── programs ──────────────────────────────────────────────────────────
DROP TABLE IF EXISTS `programs`;
CREATE TABLE `programs` (
    `id`               INT UNSIGNED  AUTO_INCREMENT PRIMARY KEY,
    `title`            VARCHAR(255)  NOT NULL,
    `slug`             VARCHAR(255)  NOT NULL,
    `shortDescription` VARCHAR(500)  NULL,
    `content`          TEXT          NULL,
    `iconSvg`          TEXT          NULL,
    `imagePath`        VARCHAR(500)  NULL,
    `sortOrder`        INT UNSIGNED  NOT NULL DEFAULT 0,
    `isPublished`      TINYINT(1)    NOT NULL DEFAULT 0,
    `createdAt`        DATETIME      NULL,
    `updatedAt`        DATETIME      NULL,
    UNIQUE KEY `idx_programs_slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ─── facilities ────────────────────────────────────────────────────────
DROP TABLE IF EXISTS `facilities`;
CREATE TABLE `facilities` (
    `id`               INT UNSIGNED  AUTO_INCREMENT PRIMARY KEY,
    `name`             VARCHAR(255)  NOT NULL,
    `slug`             VARCHAR(255)  NOT NULL,
    `shortDescription` VARCHAR(500)  NULL,
    `content`          TEXT          NULL,
    `imagePath`        VARCHAR(500)  NULL,
    `sortOrder`        INT UNSIGNED  NOT NULL DEFAULT 0,
    `isPublished`      TINYINT(1)    NOT NULL DEFAULT 0,
    `createdAt`        DATETIME      NULL,
    `updatedAt`        DATETIME      NULL,
    UNIQUE KEY `idx_facilities_slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ─── incubatees ────────────────────────────────────────────────────────
DROP TABLE IF EXISTS `incubatees`;
CREATE TABLE `incubatees` (
    `id`               INT UNSIGNED  AUTO_INCREMENT PRIMARY KEY,
    `companyName`      VARCHAR(255)  NOT NULL,
    `slug`             VARCHAR(255)  NOT NULL,
    `founderName`      VARCHAR(150)  NULL,
    `shortDescription` VARCHAR(500)  NULL,
    `content`          TEXT          NULL,
    `logoPath`         VARCHAR(500)  NULL,
    `websiteUrl`       VARCHAR(500)  NULL,
    `cohort`           VARCHAR(50)   NULL,
    `sortOrder`        INT UNSIGNED  NOT NULL DEFAULT 0,
    `isPublished`      TINYINT(1)    NOT NULL DEFAULT 0,
    `createdAt`        DATETIME      NULL,
    `updatedAt`        DATETIME      NULL,
    UNIQUE KEY `idx_incubatees_slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ─── teamMembers ───────────────────────────────────────────────────────
DROP TABLE IF EXISTS `teamMembers`;
CREATE TABLE `teamMembers` (
    `id`          INT UNSIGNED  AUTO_INCREMENT PRIMARY KEY,
    `fullName`    VARCHAR(150)  NOT NULL,
    `slug`        VARCHAR(255)  NOT NULL,
    `position`    VARCHAR(255)  NULL,
    `shortBio`    VARCHAR(500)  NULL,
    `content`     TEXT          NULL,
    `photoPath`   VARCHAR(500)  NULL,
    `email`       VARCHAR(255)  NULL,
    `linkedinUrl` VARCHAR(500)  NULL,
    `sortOrder`   INT UNSIGNED  NOT NULL DEFAULT 0,
    `isPublished` TINYINT(1)    NOT NULL DEFAULT 0,
    `createdAt`   DATETIME      NULL,
    `updatedAt`   DATETIME      NULL,
    UNIQUE KEY `idx_team_slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ─── siteSettings ──────────────────────────────────────────────────────
DROP TABLE IF EXISTS `siteSettings`;
CREATE TABLE `siteSettings` (
    `id`           INT UNSIGNED  AUTO_INCREMENT PRIMARY KEY,
    `settingKey`   VARCHAR(100)  NOT NULL,
    `settingValue` TEXT          NULL,
    `settingGroup` VARCHAR(50)   NOT NULL DEFAULT 'general',
    `createdAt`    DATETIME      NULL,
    `updatedAt`    DATETIME      NULL,
    UNIQUE KEY `idx_settings_key` (`settingKey`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

SET FOREIGN_KEY_CHECKS = 1;


-- ════════════════════════════════════════════════════════════════════════
-- DEFAULT DATA
-- ════════════════════════════════════════════════════════════════════════

-- Default admin  (password: AsogAdmin@2026)
-- Generate hash:  php -r "echo password_hash('AsogAdmin@2026', PASSWORD_BCRYPT);"
INSERT INTO `admins` (`fullName`, `email`, `password`, `role`, `isActive`, `createdAt`, `updatedAt`)
VALUES ('ASOG Admin', 'admin@asog.local',
        '$2y$10$YsGKOzbnOeKuWCGmOAP3qup5kLhJsWT5ACoR2GFfMjQCE3wGSfKRi',
        'superadmin', 1, NOW(), NOW());

-- Default site settings
INSERT INTO `siteSettings` (`settingKey`, `settingValue`, `settingGroup`, `createdAt`, `updatedAt`) VALUES
('aboutTitle',       'Built for Bicol''s Future',                                                        'about',   NOW(), NOW()),
('aboutSubtitle',    'Who We Are',                                                                       'about',   NOW(), NOW()),
('aboutContent',     '<p>The ASOG Technology Business Incubator (TBI) is an initiative of Camarines Sur Polytechnic Colleges, funded by DOST-PCIEERD, dedicated to fostering engineering and AI-based innovations for food value chain management across the Bicol Region.</p><p>We empower startups and MSMEs with state-of-the-art facilities, expert mentorship, and end-to-end support — from ideation and prototyping to market validation and intellectual property protection.</p>', 'about', NOW(), NOW()),
('aboutTags',        'AI Research,Food Value Chain,Startup Incubation,Engineering Innovation,MSME Support', 'about', NOW(), NOW()),
('heroTagline',      'Join the Ecosystem',                                                               'hero',    NOW(), NOW()),
('ctaTitle',         'Ready to Build your business with us?',                                            'cta',     NOW(), NOW()),
('ctaDescription',   'Apply to the ASOG TBI incubation program and get access to state-of-the-art facilities, mentorship, and funding opportunities.', 'cta', NOW(), NOW()),
('ctaButtonText',    'Be an Incubatee',                                                                  'cta',     NOW(), NOW()),
('ctaButtonUrl',     '#contact',                                                                         'cta',     NOW(), NOW()),
('ctaSecondaryText', 'Explore Our Program',                                                              'cta',     NOW(), NOW()),
('ctaSecondaryUrl',  '/programs',                                                                        'cta',     NOW(), NOW()),
('contactEmail',     'asogtbi@cspc.edu.ph',                                                              'contact', NOW(), NOW()),
('contactPhone',     '',                                                                                 'contact', NOW(), NOW()),
('contactAddress',   'Camarines Sur Polytechnic Colleges, Nabua, Camarines Sur',                         'contact', NOW(), NOW()),
('facebookUrl',      '#',                                                                                'contact', NOW(), NOW()),
('instagramUrl',     '#',                                                                                'contact', NOW(), NOW());
