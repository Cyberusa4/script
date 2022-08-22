-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 07, 2022 at 11:56 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `additionals`
--

CREATE TABLE `additionals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `additionals`
--

INSERT INTO `additionals` (`id`, `key`, `value`) VALUES
(4, 'popup_notice_status', '0'),
(5, 'popup_notice_description', '<h2 style=\"text-align:center\"><span style=\"color:#2980b9\"><strong>What is Lorem Ipsum?</strong></span></h2>\r\n\r\n<p style=\"text-align:center\"><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>'),
(6, 'download_page_center_section_status', '1'),
(7, 'download_page_center_section_title', 'Download page center section'),
(8, 'download_page_center_section_content', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>'),
(9, 'download_page_bottom_section_status', '1'),
(10, 'download_page_bottom_section_title', 'Download page bottom section'),
(11, 'download_page_bottom_section_content', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>');

-- --------------------------------------------------------

--
-- Table structure for table `addons`
--

CREATE TABLE `addons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `api_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `version` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `action_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_notifications`
--

CREATE TABLE `admin_notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 : Unread 1: Read',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_password_resets`
--

CREATE TABLE `admin_password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `advertisements`
--

CREATE TABLE `advertisements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `symbol` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `advertisements`
--

INSERT INTO `advertisements` (`id`, `position`, `size`, `symbol`, `code`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Head Code', NULL, 'head_code', NULL, 0, '2022-06-24 15:52:11', '2022-06-25 00:05:14'),
(2, 'Home Page (Top)', 'Responsive', 'home_page_top', NULL, 0, '2022-06-24 15:53:01', '2022-06-24 20:23:51'),
(3, 'Home Page (Bottom)', 'Responsive', 'home_page_bottom', NULL, 0, '2022-06-24 15:53:30', '2022-06-24 20:23:58'),
(4, 'Download Page (Header)', 'Responsive', 'download_page_header', NULL, 0, '2022-06-24 16:29:57', '2022-06-24 20:23:30'),
(5, 'Download Page (Left Sidebar Top)', '300x280', 'download_page_left_sidebar_top', NULL, 0, '2022-06-24 16:29:57', '2022-06-24 20:14:36'),
(6, 'Download Page (Left Sidebar Bottom)', '300x280', 'download_page_left_sidebar_bottom', NULL, 0, '2022-06-24 16:29:57', '2022-06-24 20:14:46'),
(7, 'Download Page (Description)', '200x355', 'download_page_description', NULL, 0, '2022-06-24 16:29:57', '2022-06-24 20:07:41'),
(8, 'Download Page (Down Bottom)', 'Responsive', 'download_page_down_bottom', NULL, 0, '2022-06-24 16:29:57', '2022-06-24 20:24:30'),
(9, 'Blog Page (Center)', 'Responsive', 'blog_page_center', NULL, 0, '2022-06-24 16:37:39', '2022-06-24 20:25:03'),
(10, 'Blog Page (Bottom)', 'Responsive', 'blog_page_bottom', NULL, 0, '2022-06-24 16:37:39', '2022-06-24 20:24:53'),
(11, 'Blog Page (Sidebar Top)', 'Responsive', 'blog_page_sidebar_top', NULL, 0, '2022-06-24 16:37:39', '2022-06-24 20:15:34'),
(12, 'Blog Page (Sidebar Bottom)', 'Responsive', 'blog_page_sidebar_bottom', NULL, 0, '2022-06-24 16:37:39', '2022-06-24 19:43:12'),
(13, 'Blog Page (Article Top)', 'Responsive', 'blog_page_article_top', NULL, 0, '2022-06-24 16:37:39', '2022-06-24 20:24:43'),
(14, 'Blog Page (Article Bottom)', 'Responsive', 'blog_page_article_Bottom', NULL, 0, '2022-06-24 16:37:39', '2022-06-24 20:24:36');

-- --------------------------------------------------------

--
-- Table structure for table `blog_articles`
--

CREATE TABLE `blog_articles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lang` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `views` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lang` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `views` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_comments`
--

CREATE TABLE `blog_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `article_id` bigint(20) UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capital` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `continent` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `continent_code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alpha_3` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `code`, `name`, `capital`, `continent`, `continent_code`, `phone`, `currency`, `symbol`, `alpha_3`, `created_at`, `updated_at`) VALUES
(1, 'AF', 'Afghanistan', 'Kabul', 'Asia', 'AS', '+93', 'AFN', '؋', 'AFG', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(2, 'AX', 'Aland Islands', 'Mariehamn', 'Europe', 'EU', '+358', 'EUR', '€', 'ALA', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(3, 'AL', 'Albania', 'Tirana', 'Europe', 'EU', '+355', 'ALL', 'Lek', 'ALB', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(4, 'DZ', 'Algeria', 'Algiers', 'Africa', 'AF', '+213', 'DZD', 'دج', 'DZA', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(5, 'AS', 'American Samoa', 'Pago Pago', 'Oceania', 'OC', '+1684', 'USD', '$', 'ASM', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(6, 'AD', 'Andorra', 'Andorra la Vella', 'Europe', 'EU', '+376', 'EUR', '€', 'AND', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(7, 'AO', 'Angola', 'Luanda', 'Africa', 'AF', '+244', 'AOA', 'Kz', 'AGO', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(8, 'AI', 'Anguilla', 'The Valley', 'North America', 'NA', '+1264', 'XCD', '$', 'AIA', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(9, 'AQ', 'Antarctica', 'Antarctica', 'Antarctica', 'AN', '+672', 'AAD', '$', 'ATA', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(10, 'AG', 'Antigua and Barbuda', 'St. John\'s', 'North America', 'NA', '+1268', 'XCD', '$', 'ATG', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(11, 'AR', 'Argentina', 'Buenos Aires', 'South America', 'SA', '+54', 'ARS', '$', 'ARG', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(12, 'AM', 'Armenia', 'Yerevan', 'Asia', 'AS', '+374', 'AMD', '֏', 'ARM', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(13, 'AW', 'Aruba', 'Oranjestad', 'North America', 'NA', '+297', 'AWG', 'ƒ', 'ABW', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(14, 'AU', 'Australia', 'Canberra', 'Oceania', 'OC', '+61', 'AUD', '$', 'AUS', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(15, 'AT', 'Austria', 'Vienna', 'Europe', 'EU', '+43', 'EUR', '€', 'AUT', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(16, 'AZ', 'Azerbaijan', 'Baku', 'Asia', 'AS', '+994', 'AZN', 'm', 'AZE', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(17, 'BS', 'Bahamas', 'Nassau', 'North America', 'NA', '+1242', 'BSD', 'B$', 'BHS', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(18, 'BH', 'Bahrain', 'Manama', 'Asia', 'AS', '+973', 'BHD', '.د.ب', 'BHR', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(19, 'BD', 'Bangladesh', 'Dhaka', 'Asia', 'AS', '+880', 'BDT', '৳', 'BGD', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(20, 'BB', 'Barbados', 'Bridgetown', 'North America', 'NA', '+1246', 'BBD', 'Bds$', 'BRB', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(21, 'BY', 'Belarus', 'Minsk', 'Europe', 'EU', '+375', 'BYN', 'Br', 'BLR', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(22, 'BE', 'Belgium', 'Brussels', 'Europe', 'EU', '+32', 'EUR', '€', 'BEL', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(23, 'BZ', 'Belize', 'Belmopan', 'North America', 'NA', '+501', 'BZD', '$', 'BLZ', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(24, 'BJ', 'Benin', 'Porto-Novo', 'Africa', 'AF', '+229', 'XOF', 'CFA', 'BEN', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(25, 'BM', 'Bermuda', 'Hamilton', 'North America', 'NA', '+1441', 'BMD', '$', 'BMU', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(26, 'BT', 'Bhutan', 'Thimphu', 'Asia', 'AS', '+975', 'BTN', 'Nu.', 'BTN', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(27, 'BO', 'Bolivia', 'Sucre', 'South America', 'SA', '+591', 'BOB', 'Bs.', 'BOL', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(28, 'BQ', 'Bonaire, Sint Eustatius and Saba', 'Kralendijk', 'North America', 'NA', '+599', 'USD', '$', 'BES', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(29, 'BA', 'Bosnia and Herzegovina', 'Sarajevo', 'Europe', 'EU', '+387', 'BAM', 'KM', 'BIH', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(30, 'BW', 'Botswana', 'Gaborone', 'Africa', 'AF', '+267', 'BWP', 'P', 'BWA', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(31, 'BV', 'Bouvet Island', NULL, 'Antarctica', 'AN', '+55', 'NOK', 'kr', 'BVT', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(32, 'BR', 'Brazil', 'Brasilia', 'South America', 'SA', '+55', 'BRL', 'R$', 'BRA', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(33, 'IO', 'British Indian Ocean Territory', 'Diego Garcia', 'Asia', 'AS', '+246', 'USD', '$', 'IOT', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(34, 'BN', 'Brunei Darussalam', 'Bandar Seri Begawan', 'Asia', 'AS', '+673', 'BND', 'B$', 'BRN', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(35, 'BG', 'Bulgaria', 'Sofia', 'Europe', 'EU', '+359', 'BGN', 'Лв.', 'BGR', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(36, 'BF', 'Burkina Faso', 'Ouagadougou', 'Africa', 'AF', '+226', 'XOF', 'CFA', 'BFA', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(37, 'BI', 'Burundi', 'Bujumbura', 'Africa', 'AF', '+257', 'BIF', 'FBu', 'BDI', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(38, 'KH', 'Cambodia', 'Phnom Penh', 'Asia', 'AS', '+855', 'KHR', 'KHR', 'KHM', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(39, 'CM', 'Cameroon', 'Yaounde', 'Africa', 'AF', '+237', 'XAF', 'FCFA', 'CMR', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(40, 'CA', 'Canada', 'Ottawa', 'North America', 'NA', '+1', 'CAD', '$', 'CAN', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(41, 'CV', 'Cape Verde', 'Praia', 'Africa', 'AF', '+238', 'CVE', '$', 'CPV', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(42, 'KY', 'Cayman Islands', 'George Town', 'North America', 'NA', '+1345', 'KYD', '$', 'CYM', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(43, 'CF', 'Central African Republic', 'Bangui', 'Africa', 'AF', '+236', 'XAF', 'FCFA', 'CAF', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(44, 'TD', 'Chad', 'N\'Djamena', 'Africa', 'AF', '+235', 'XAF', 'FCFA', 'TCD', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(45, 'CL', 'Chile', 'Santiago', 'South America', 'SA', '+56', 'CLP', '$', 'CHL', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(46, 'CN', 'China', 'Beijing', 'Asia', 'AS', '+86', 'CNY', '¥', 'CHN', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(47, 'CX', 'Christmas Island', 'Flying Fish Cove', 'Asia', 'AS', '+61', 'AUD', '$', 'CXR', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(48, 'CC', 'Cocos (Keeling) Islands', 'West Island', 'Asia', 'AS', '+672', 'AUD', '$', 'CCK', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(49, 'CO', 'Colombia', 'Bogota', 'South America', 'SA', '+57', 'COP', '$', 'COL', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(50, 'KM', 'Comoros', 'Moroni', 'Africa', 'AF', '+269', 'KMF', 'CF', 'COM', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(51, 'CG', 'Congo', 'Brazzaville', 'Africa', 'AF', '+242', 'XAF', 'FC', 'COG', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(52, 'CD', 'Congo, Democratic Republic of the Congo', 'Kinshasa', 'Africa', 'AF', '+242', 'CDF', 'FC', 'COD', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(53, 'CK', 'Cook Islands', 'Avarua', 'Oceania', 'OC', '+682', 'NZD', '$', 'COK', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(54, 'CR', 'Costa Rica', 'San Jose', 'North America', 'NA', '+506', 'CRC', '₡', 'CRI', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(55, 'CI', 'Cote D\'Ivoire', 'Yamoussoukro', 'Africa', 'AF', '+225', 'XOF', 'CFA', 'CIV', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(56, 'HR', 'Croatia', 'Zagreb', 'Europe', 'EU', '+385', 'HRK', 'kn', 'HRV', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(57, 'CU', 'Cuba', 'Havana', 'North America', 'NA', '+53', 'CUP', '$', 'CUB', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(58, 'CW', 'Curacao', 'Willemstad', 'North America', 'NA', '+599', 'ANG', 'ƒ', 'CUW', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(59, 'CY', 'Cyprus', 'Nicosia', 'Asia', 'AS', '+357', 'EUR', '€', 'CYP', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(60, 'CZ', 'Czech Republic', 'Prague', 'Europe', 'EU', '+420', 'CZK', 'Kč', 'CZE', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(61, 'DK', 'Denmark', 'Copenhagen', 'Europe', 'EU', '+45', 'DKK', 'Kr.', 'DNK', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(62, 'DJ', 'Djibouti', 'Djibouti', 'Africa', 'AF', '+253', 'DJF', 'Fdj', 'DJI', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(63, 'DM', 'Dominica', 'Roseau', 'North America', 'NA', '+1767', 'XCD', '$', 'DMA', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(64, 'DO', 'Dominican Republic', 'Santo Domingo', 'North America', 'NA', '+1809', 'DOP', '$', 'DOM', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(65, 'EC', 'Ecuador', 'Quito', 'South America', 'SA', '+593', 'USD', '$', 'ECU', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(66, 'EG', 'Egypt', 'Cairo', 'Africa', 'AF', '+20', 'EGP', 'ج.م', 'EGY', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(67, 'SV', 'El Salvador', 'San Salvador', 'North America', 'NA', '+503', 'USD', '$', 'SLV', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(68, 'GQ', 'Equatorial Guinea', 'Malabo', 'Africa', 'AF', '+240', 'XAF', 'FCFA', 'GNQ', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(69, 'ER', 'Eritrea', 'Asmara', 'Africa', 'AF', '+291', 'ERN', 'Nfk', 'ERI', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(70, 'EE', 'Estonia', 'Tallinn', 'Europe', 'EU', '+372', 'EUR', '€', 'EST', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(71, 'ET', 'Ethiopia', 'Addis Ababa', 'Africa', 'AF', '+251', 'ETB', 'Nkf', 'ETH', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(72, 'FK', 'Falkland Islands (Malvinas)', 'Stanley', 'South America', 'SA', '+500', 'FKP', '£', 'FLK', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(73, 'FO', 'Faroe Islands', 'Torshavn', 'Europe', 'EU', '+298', 'DKK', 'Kr.', 'FRO', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(74, 'FJ', 'Fiji', 'Suva', 'Oceania', 'OC', '+679', 'FJD', 'FJ$', 'FJI', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(75, 'FI', 'Finland', 'Helsinki', 'Europe', 'EU', '+358', 'EUR', '€', 'FIN', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(76, 'FR', 'France', 'Paris', 'Europe', 'EU', '+33', 'EUR', '€', 'FRA', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(77, 'GF', 'French Guiana', 'Cayenne', 'South America', 'SA', '+594', 'EUR', '€', 'GUF', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(78, 'PF', 'French Polynesia', 'Papeete', 'Oceania', 'OC', '+689', 'XPF', '₣', 'PYF', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(79, 'TF', 'French Southern Territories', 'Port-aux-Francais', 'Antarctica', 'AN', '+262', 'EUR', '€', 'ATF', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(80, 'GA', 'Gabon', 'Libreville', 'Africa', 'AF', '+241', 'XAF', 'FCFA', 'GAB', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(81, 'GM', 'Gambia', 'Banjul', 'Africa', 'AF', '+220', 'GMD', 'D', 'GMB', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(82, 'GE', 'Georgia', 'Tbilisi', 'Asia', 'AS', '+995', 'GEL', 'ლ', 'GEO', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(83, 'DE', 'Germany', 'Berlin', 'Europe', 'EU', '+49', 'EUR', '€', 'DEU', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(84, 'GH', 'Ghana', 'Accra', 'Africa', 'AF', '+233', 'GHS', 'GH₵', 'GHA', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(85, 'GI', 'Gibraltar', 'Gibraltar', 'Europe', 'EU', '+350', 'GIP', '£', 'GIB', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(86, 'GR', 'Greece', 'Athens', 'Europe', 'EU', '+30', 'EUR', '€', 'GRC', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(87, 'GL', 'Greenland', 'Nuuk', 'North America', 'NA', '+299', 'DKK', 'Kr.', 'GRL', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(88, 'GD', 'Grenada', 'St. George\'s', 'North America', 'NA', '+1473', 'XCD', '$', 'GRD', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(89, 'GP', 'Guadeloupe', 'Basse-Terre', 'North America', 'NA', '+590', 'EUR', '€', 'GLP', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(90, 'GU', 'Guam', 'Hagatna', 'Oceania', 'OC', '+1671', 'USD', '$', 'GUM', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(91, 'GT', 'Guatemala', 'Guatemala City', 'North America', 'NA', '+502', 'GTQ', 'Q', 'GTM', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(92, 'GG', 'Guernsey', 'St Peter Port', 'Europe', 'EU', '+44', 'GBP', '£', 'GGY', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(93, 'GN', 'Guinea', 'Conakry', 'Africa', 'AF', '+224', 'GNF', 'FG', 'GIN', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(94, 'GW', 'Guinea-Bissau', 'Bissau', 'Africa', 'AF', '+245', 'XOF', 'CFA', 'GNB', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(95, 'GY', 'Guyana', 'Georgetown', 'South America', 'SA', '+592', 'GYD', '$', 'GUY', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(96, 'HT', 'Haiti', 'Port-au-Prince', 'North America', 'NA', '+509', 'HTG', 'G', 'HTI', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(97, 'HM', 'Heard Island and Mcdonald Islands', '', 'Antarctica', 'AN', '+0', 'AUD', '$', 'HMD', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(98, 'VA', 'Holy See (Vatican City State)', 'Vatican City', 'Europe', 'EU', '+39', 'EUR', '€', 'VAT', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(99, 'HN', 'Honduras', 'Tegucigalpa', 'North America', 'NA', '+504', 'HNL', 'L', 'HND', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(100, 'HK', 'Hong Kong', 'Hong Kong', 'Asia', 'AS', '+852', 'HKD', '$', 'HKG', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(101, 'HU', 'Hungary', 'Budapest', 'Europe', 'EU', '+36', 'HUF', 'Ft', 'HUN', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(102, 'IS', 'Iceland', 'Reykjavik', 'Europe', 'EU', '+354', 'ISK', 'kr', 'ISL', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(103, 'IN', 'India', 'New Delhi', 'Asia', 'AS', '+91', 'INR', '₹', 'IND', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(104, 'ID', 'Indonesia', 'Jakarta', 'Asia', 'AS', '+62', 'IDR', 'Rp', 'IDN', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(105, 'IR', 'Iran, Islamic Republic of', 'Tehran', 'Asia', 'AS', '+98', 'IRR', '﷼', 'IRN', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(106, 'IQ', 'Iraq', 'Baghdad', 'Asia', 'AS', '+964', 'IQD', 'د.ع', 'IRQ', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(107, 'IE', 'Ireland', 'Dublin', 'Europe', 'EU', '+353', 'EUR', '€', 'IRL', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(108, 'IM', 'Isle of Man', 'Douglas, Isle of Man', 'Europe', 'EU', '+44', 'GBP', '£', 'IMN', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(109, 'IL', 'Israel', 'Jerusalem', 'Asia', 'AS', '+972', 'ILS', '₪', 'ISR', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(110, 'IT', 'Italy', 'Rome', 'Europe', 'EU', '+39', 'EUR', '€', 'ITA', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(111, 'JM', 'Jamaica', 'Kingston', 'North America', 'NA', '+1876', 'JMD', 'J$', 'JAM', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(112, 'JP', 'Japan', 'Tokyo', 'Asia', 'AS', '+81', 'JPY', '¥', 'JPN', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(113, 'JE', 'Jersey', 'Saint Helier', 'Europe', 'EU', '+44', 'GBP', '£', 'JEY', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(114, 'JO', 'Jordan', 'Amman', 'Asia', 'AS', '+962', 'JOD', 'ا.د', 'JOR', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(115, 'KZ', 'Kazakhstan', 'Astana', 'Asia', 'AS', '+7', 'KZT', 'лв', 'KAZ', '2021-11-03 22:07:15', '2021-11-04 15:59:30'),
(116, 'KE', 'Kenya', 'Nairobi', 'Africa', 'AF', '+254', 'KES', 'KSh', 'KEN', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(117, 'KI', 'Kiribati', 'Tarawa', 'Oceania', 'OC', '+686', 'AUD', '$', 'KIR', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(118, 'KP', 'Korea, Democratic People\'s Republic of', 'Pyongyang', 'Asia', 'AS', '+850', 'KPW', '₩', 'PRK', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(119, 'KR', 'Korea, Republic of', 'Seoul', 'Asia', 'AS', '+82', 'KRW', '₩', 'KOR', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(120, 'XK', 'Kosovo', 'Pristina', 'Europe', 'EU', '+381', 'EUR', '€', 'XKX', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(121, 'KW', 'Kuwait', 'Kuwait City', 'Asia', 'AS', '+965', 'KWD', 'ك.د', 'KWT', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(122, 'KG', 'Kyrgyzstan', 'Bishkek', 'Asia', 'AS', '+996', 'KGS', 'лв', 'KGZ', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(123, 'LA', 'Lao People\'s Democratic Republic', 'Vientiane', 'Asia', 'AS', '+856', 'LAK', '₭', 'LAO', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(124, 'LV', 'Latvia', 'Riga', 'Europe', 'EU', '+371', 'EUR', '€', 'LVA', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(125, 'LB', 'Lebanon', 'Beirut', 'Asia', 'AS', '+961', 'LBP', '£', 'LBN', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(126, 'LS', 'Lesotho', 'Maseru', 'Africa', 'AF', '+266', 'LSL', 'L', 'LSO', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(127, 'LR', 'Liberia', 'Monrovia', 'Africa', 'AF', '+231', 'LRD', '$', 'LBR', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(128, 'LY', 'Libyan Arab Jamahiriya', 'Tripolis', 'Africa', 'AF', '+218', 'LYD', 'د.ل', 'LBY', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(129, 'LI', 'Liechtenstein', 'Vaduz', 'Europe', 'EU', '+423', 'CHF', 'CHf', 'LIE', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(130, 'LT', 'Lithuania', 'Vilnius', 'Europe', 'EU', '+370', 'EUR', '€', 'LTU', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(131, 'LU', 'Luxembourg', 'Luxembourg', 'Europe', 'EU', '+352', 'EUR', '€', 'LUX', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(132, 'MO', 'Macao', 'Macao', 'Asia', 'AS', '+853', 'MOP', '$', 'MAC', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(133, 'MK', 'Macedonia, the Former Yugoslav Republic of', 'Skopje', 'Europe', 'EU', '+389', 'MKD', 'ден', 'MKD', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(134, 'MG', 'Madagascar', 'Antananarivo', 'Africa', 'AF', '+261', 'MGA', 'Ar', 'MDG', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(135, 'MW', 'Malawi', 'Lilongwe', 'Africa', 'AF', '+265', 'MWK', 'MK', 'MWI', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(136, 'MY', 'Malaysia', 'Kuala Lumpur', 'Asia', 'AS', '+60', 'MYR', 'RM', 'MYS', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(137, 'MV', 'Maldives', 'Male', 'Asia', 'AS', '+960', 'MVR', 'Rf', 'MDV', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(138, 'ML', 'Mali', 'Bamako', 'Africa', 'AF', '+223', 'XOF', 'CFA', 'MLI', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(139, 'MT', 'Malta', 'Valletta', 'Europe', 'EU', '+356', 'EUR', '€', 'MLT', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(140, 'MH', 'Marshall Islands', 'Majuro', 'Oceania', 'OC', '+692', 'USD', '$', 'MHL', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(141, 'MQ', 'Martinique', 'Fort-de-France', 'North America', 'NA', '+596', 'EUR', '€', 'MTQ', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(142, 'MR', 'Mauritania', 'Nouakchott', 'Africa', 'AF', '+222', 'MRO', 'MRU', 'MRT', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(143, 'MU', 'Mauritius', 'Port Louis', 'Africa', 'AF', '+230', 'MUR', '₨', 'MUS', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(144, 'YT', 'Mayotte', 'Mamoudzou', 'Africa', 'AF', '+269', 'EUR', '€', 'MYT', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(145, 'MX', 'Mexico', 'Mexico City', 'North America', 'NA', '+52', 'MXN', '$', 'MEX', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(146, 'FM', 'Micronesia, Federated States of', 'Palikir', 'Oceania', 'OC', '+691', 'USD', '$', 'FSM', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(147, 'MD', 'Moldova, Republic of', 'Chisinau', 'Europe', 'EU', '+373', 'MDL', 'L', 'MDA', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(148, 'MC', 'Monaco', 'Monaco', 'Europe', 'EU', '+377', 'EUR', '€', 'MCO', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(149, 'MN', 'Mongolia', 'Ulan Bator', 'Asia', 'AS', '+976', 'MNT', '₮', 'MNG', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(150, 'ME', 'Montenegro', 'Podgorica', 'Europe', 'EU', '+382', 'EUR', '€', 'MNE', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(151, 'MS', 'Montserrat', 'Plymouth', 'North America', 'NA', '+1664', 'XCD', '$', 'MSR', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(152, 'MA', 'Morocco', 'Rabat', 'Africa', 'AF', '+212', 'MAD', 'DH', 'MAR', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(153, 'MZ', 'Mozambique', 'Maputo', 'Africa', 'AF', '+258', 'MZN', 'MT', 'MOZ', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(154, 'MM', 'Myanmar', 'Nay Pyi Taw', 'Asia', 'AS', '+95', 'MMK', 'K', 'MMR', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(155, 'NA', 'Namibia', 'Windhoek', 'Africa', 'AF', '+264', 'NAD', '$', 'NAM', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(156, 'NR', 'Nauru', 'Yaren', 'Oceania', 'OC', '+674', 'AUD', '$', 'NRU', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(157, 'NP', 'Nepal', 'Kathmandu', 'Asia', 'AS', '+977', 'NPR', '₨', 'NPL', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(158, 'NL', 'Netherlands', 'Amsterdam', 'Europe', 'EU', '+31', 'EUR', '€', 'NLD', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(159, 'AN', 'Netherlands Antilles', 'Willemstad', 'North America', 'NA', '+599', 'ANG', 'NAf', 'ANT', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(160, 'NC', 'New Caledonia', 'Noumea', 'Oceania', 'OC', '+687', 'XPF', '₣', 'NCL', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(161, 'NZ', 'New Zealand', 'Wellington', 'Oceania', 'OC', '+64', 'NZD', '$', 'NZL', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(162, 'NI', 'Nicaragua', 'Managua', 'North America', 'NA', '+505', 'NIO', 'C$', 'NIC', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(163, 'NE', 'Niger', 'Niamey', 'Africa', 'AF', '+227', 'XOF', 'CFA', 'NER', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(164, 'NG', 'Nigeria', 'Abuja', 'Africa', 'AF', '+234', 'NGN', '₦', 'NGA', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(165, 'NU', 'Niue', 'Alofi', 'Oceania', 'OC', '+683', 'NZD', '$', 'NIU', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(166, 'NF', 'Norfolk Island', 'Kingston', 'Oceania', 'OC', '+672', 'AUD', '$', 'NFK', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(167, 'MP', 'Northern Mariana Islands', 'Saipan', 'Oceania', 'OC', '+1670', 'USD', '$', 'MNP', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(168, 'NO', 'Norway', 'Oslo', 'Europe', 'EU', '+47', 'NOK', 'kr', 'NOR', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(169, 'OM', 'Oman', 'Muscat', 'Asia', 'AS', '+968', 'OMR', '.ع.ر', 'OMN', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(170, 'PK', 'Pakistan', 'Islamabad', 'Asia', 'AS', '+92', 'PKR', '₨', 'PAK', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(171, 'PW', 'Palau', 'Melekeok', 'Oceania', 'OC', '+680', 'USD', '$', 'PLW', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(172, 'PS', 'Palestinian Territory, Occupied', 'East Jerusalem', 'Asia', 'AS', '+970', 'ILS', '₪', 'PSE', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(173, 'PA', 'Panama', 'Panama City', 'North America', 'NA', '+507', 'PAB', 'B/.', 'PAN', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(174, 'PG', 'Papua New Guinea', 'Port Moresby', 'Oceania', 'OC', '+675', 'PGK', 'K', 'PNG', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(175, 'PY', 'Paraguay', 'Asuncion', 'South America', 'SA', '+595', 'PYG', '₲', 'PRY', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(176, 'PE', 'Peru', 'Lima', 'South America', 'SA', '+51', 'PEN', 'S/.', 'PER', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(177, 'PH', 'Philippines', 'Manila', 'Asia', 'AS', '+63', 'PHP', '₱', 'PHL', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(178, 'PN', 'Pitcairn', 'Adamstown', 'Oceania', 'OC', '+64', 'NZD', '$', 'PCN', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(179, 'PL', 'Poland', 'Warsaw', 'Europe', 'EU', '+48', 'PLN', 'zł', 'POL', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(180, 'PT', 'Portugal', 'Lisbon', 'Europe', 'EU', '+351', 'EUR', '€', 'PRT', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(181, 'PR', 'Puerto Rico', 'San Juan', 'North America', 'NA', '+1787', 'USD', '$', 'PRI', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(182, 'QA', 'Qatar', 'Doha', 'Asia', 'AS', '+974', 'QAR', 'ق.ر', 'QAT', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(183, 'RE', 'Reunion', 'Saint-Denis', 'Africa', 'AF', '+262', 'EUR', '€', 'REU', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(184, 'RO', 'Romania', 'Bucharest', 'Europe', 'EU', '+40', 'RON', 'lei', 'ROM', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(185, 'RU', 'Russian Federation', 'Moscow', 'Asia', 'AS', '+70', 'RUB', '₽', 'RUS', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(186, 'RW', 'Rwanda', 'Kigali', 'Africa', 'AF', '+250', 'RWF', 'FRw', 'RWA', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(187, 'BL', 'Saint Barthelemy', 'Gustavia', 'North America', 'NA', '+590', 'EUR', '€', 'BLM', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(188, 'SH', 'Saint Helena', 'Jamestown', 'Africa', 'AF', '+290', 'SHP', '£', 'SHN', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(189, 'KN', 'Saint Kitts and Nevis', 'Basseterre', 'North America', 'NA', '+1869', 'XCD', '$', 'KNA', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(190, 'LC', 'Saint Lucia', 'Castries', 'North America', 'NA', '+1758', 'XCD', '$', 'LCA', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(191, 'MF', 'Saint Martin', 'Marigot', 'North America', 'NA', '+590', 'EUR', '€', 'MAF', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(192, 'PM', 'Saint Pierre and Miquelon', 'Saint-Pierre', 'North America', 'NA', '+508', 'EUR', '€', 'SPM', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(193, 'VC', 'Saint Vincent and the Grenadines', 'Kingstown', 'North America', 'NA', '+1784', 'XCD', '$', 'VCT', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(194, 'WS', 'Samoa', 'Apia', 'Oceania', 'OC', '+684', 'WST', 'SAT', 'WSM', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(195, 'SM', 'San Marino', 'San Marino', 'Europe', 'EU', '+378', 'EUR', '€', 'SMR', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(196, 'ST', 'Sao Tome and Principe', 'Sao Tome', 'Africa', 'AF', '+239', 'STD', 'Db', 'STP', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(197, 'SA', 'Saudi Arabia', 'Riyadh', 'Asia', 'AS', '+966', 'SAR', '﷼', 'SAU', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(198, 'SN', 'Senegal', 'Dakar', 'Africa', 'AF', '+221', 'XOF', 'CFA', 'SEN', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(199, 'RS', 'Serbia', 'Belgrade', 'Europe', 'EU', '+381', 'RSD', 'din', 'SRB', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(200, 'CS', 'Serbia and Montenegro', 'Belgrade', 'Europe', 'EU', '+381', 'RSD', 'din', 'SCG', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(201, 'SC', 'Seychelles', 'Victoria', 'Africa', 'AF', '+248', 'SCR', 'SRe', 'SYC', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(202, 'SL', 'Sierra Leone', 'Freetown', 'Africa', 'AF', '+232', 'SLL', 'Le', 'SLE', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(203, 'SG', 'Singapore', 'Singapur', 'Asia', 'AS', '+65', 'SGD', '$', 'SGP', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(204, 'SX', 'Sint Maarten', 'Philipsburg', 'North America', 'NA', '+1', 'ANG', 'ƒ', 'SXM', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(205, 'SK', 'Slovakia', 'Bratislava', 'Europe', 'EU', '+421', 'EUR', '€', 'SVK', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(206, 'SI', 'Slovenia', 'Ljubljana', 'Europe', 'EU', '+386', 'EUR', '€', 'SVN', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(207, 'SB', 'Solomon Islands', 'Honiara', 'Oceania', 'OC', '+677', 'SBD', 'Si$', 'SLB', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(208, 'SO', 'Somalia', 'Mogadishu', 'Africa', 'AF', '+252', 'SOS', 'Sh.so.', 'SOM', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(209, 'ZA', 'South Africa', 'Pretoria', 'Africa', 'AF', '+27', 'ZAR', 'R', 'ZAF', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(210, 'GS', 'South Georgia and the South Sandwich Islands', 'Grytviken', 'Antarctica', 'AN', '+500', 'GBP', '£', 'SGS', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(211, 'SS', 'South Sudan', 'Juba', 'Africa', 'AF', '+211', 'SSP', '£', 'SSD', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(212, 'ES', 'Spain', 'Madrid', 'Europe', 'EU', '+34', 'EUR', '€', 'ESP', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(213, 'LK', 'Sri Lanka', 'Colombo', 'Asia', 'AS', '+94', 'LKR', 'Rs', 'LKA', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(214, 'SD', 'Sudan', 'Khartoum', 'Africa', 'AF', '+249', 'SDG', '.س.ج', 'SDN', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(215, 'SR', 'Suriname', 'Paramaribo', 'South America', 'SA', '+597', 'SRD', '$', 'SUR', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(216, 'SJ', 'Svalbard and Jan Mayen', 'Longyearbyen', 'Europe', 'EU', '+47', 'NOK', 'kr', 'SJM', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(217, 'SZ', 'Swaziland', 'Mbabane', 'Africa', 'AF', '+268', 'SZL', 'E', 'SWZ', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(218, 'SE', 'Sweden', 'Stockholm', 'Europe', 'EU', '+46', 'SEK', 'kr', 'SWE', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(219, 'CH', 'Switzerland', 'Berne', 'Europe', 'EU', '+41', 'CHF', 'CHf', 'CHE', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(220, 'SY', 'Syrian Arab Republic', 'Damascus', 'Asia', 'AS', '+963', 'SYP', 'LS', 'SYR', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(221, 'TW', 'Taiwan, Province of China', 'Taipei', 'Asia', 'AS', '+886', 'TWD', '$', 'TWN', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(222, 'TJ', 'Tajikistan', 'Dushanbe', 'Asia', 'AS', '+992', 'TJS', 'SM', 'TJK', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(223, 'TZ', 'Tanzania, United Republic of', 'Dodoma', 'Africa', 'AF', '+255', 'TZS', 'TSh', 'TZA', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(224, 'TH', 'Thailand', 'Bangkok', 'Asia', 'AS', '+66', 'THB', '฿', 'THA', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(225, 'TL', 'Timor-Leste', 'Dili', 'Asia', 'AS', '+670', 'USD', '$', 'TLS', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(226, 'TG', 'Togo', 'Lome', 'Africa', 'AF', '+228', 'XOF', 'CFA', 'TGO', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(227, 'TK', 'Tokelau', NULL, 'Oceania', 'OC', '+690', 'NZD', '$', 'TKL', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(228, 'TO', 'Tonga', 'Nuku\'alofa', 'Oceania', 'OC', '+676', 'TOP', '$', 'TON', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(229, 'TT', 'Trinidad and Tobago', 'Port of Spain', 'North America', 'NA', '+1868', 'TTD', '$', 'TTO', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(230, 'TN', 'Tunisia', 'Tunis', 'Africa', 'AF', '+216', 'TND', 'ت.د', 'TUN', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(231, 'TR', 'Turkey', 'Ankara', 'Asia', 'AS', '+90', 'TRY', '₺', 'TUR', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(232, 'TM', 'Turkmenistan', 'Ashgabat', 'Asia', 'AS', '+7370', 'TMT', 'T', 'TKM', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(233, 'TC', 'Turks and Caicos Islands', 'Cockburn Town', 'North America', 'NA', '+1649', 'USD', '$', 'TCA', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(234, 'TV', 'Tuvalu', 'Funafuti', 'Oceania', 'OC', '+688', 'AUD', '$', 'TUV', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(235, 'UG', 'Uganda', 'Kampala', 'Africa', 'AF', '+256', 'UGX', 'USh', 'UGA', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(236, 'UA', 'Ukraine', 'Kiev', 'Europe', 'EU', '+380', 'UAH', '₴', 'UKR', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(237, 'AE', 'United Arab Emirates', 'Abu Dhabi', 'Asia', 'AS', '+971', 'AED', 'إ.د', 'ARE', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(238, 'GB', 'United Kingdom', 'London', 'Europe', 'EU', '+44', 'GBP', '£', 'GBR', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(239, 'US', 'United States', 'Washington', 'North America', 'NA', '+1', 'USD', '$', 'USA', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(240, 'UM', 'United States Minor Outlying Islands', NULL, 'North America', 'NA', '+1', 'USD', '$', 'UMI', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(241, 'UY', 'Uruguay', 'Montevideo', 'South America', 'SA', '+598', 'UYU', '$', 'URY', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(242, 'UZ', 'Uzbekistan', 'Tashkent', 'Asia', 'AS', '+998', 'UZS', 'лв', 'UZB', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(243, 'VU', 'Vanuatu', 'Port Vila', 'Oceania', 'OC', '+678', 'VUV', 'VT', 'VUT', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(244, 'VE', 'Venezuela', 'Caracas', 'South America', 'SA', '+58', 'VEF', 'Bs', 'VEN', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(245, 'VN', 'Viet Nam', 'Hanoi', 'Asia', 'AS', '+84', 'VND', '₫', 'VNM', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(246, 'VG', 'Virgin Islands, British', 'Road Town', 'North America', 'NA', '+1284', 'USD', '$', 'VGB', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(247, 'VI', 'Virgin Islands, U.s.', 'Charlotte Amalie', 'North America', 'NA', '+1340', 'USD', '$', 'VIR', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(248, 'WF', 'Wallis and Futuna', 'Mata Utu', 'Oceania', 'OC', '+681', 'XPF', '₣', 'WLF', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(249, 'EH', 'Western Sahara', 'El-Aaiun', 'Africa', 'AF', '+212', 'MAD', 'MAD', 'ESH', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(250, 'YE', 'Yemen', 'Sanaa', 'Asia', 'AS', '+967', 'YER', '﷼', 'YEM', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(251, 'ZM', 'Zambia', 'Lusaka', 'Africa', 'AF', '+260', 'ZMW', 'ZK', 'ZMB', '2021-11-03 22:07:16', '2021-11-04 15:59:30'),
(252, 'ZW', 'Zimbabwe', 'Harare', 'Africa', 'AF', '+263', 'ZWL', '$', 'ZWE', '2021-11-03 22:07:16', '2021-11-04 15:59:30');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `percentage` bigint(20) NOT NULL DEFAULT 1,
  `plan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `action_type` tinyint(4) NOT NULL,
  `limit` bigint(20) NOT NULL DEFAULT 1,
  `expiry_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `extensions`
--

CREATE TABLE `extensions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `credentials` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `instructions` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0:Disabled 1:Enabled',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `extensions`
--

INSERT INTO `extensions` (`id`, `name`, `symbol`, `logo`, `credentials`, `instructions`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Google reCAPTCHA', 'google_recaptcha', 'images/extensions/google-recaptcha.png', '{\"site_key\":null,\"secret_key\":null}', NULL, 0, '2022-02-23 20:40:12', '2022-07-07 16:25:47'),
(2, 'Google Analytics', 'google_analytics', 'images/extensions/google-analytics.png', '{\"tracking_id\":null}', NULL, 0, '2022-02-23 20:40:12', '2022-02-23 22:10:57'),
(3, 'Tawk.to', 'tawk_to', 'images/extensions/tawk-to.png', '{\"api_key\":null}', NULL, 0, '2022-02-23 20:40:12', '2022-02-23 22:17:33'),
(4, 'Facebook OAuth', 'facebook_oauth', 'images/extensions/facebook-oauth.png', '{\"client_id\":null,\"client_secret\":null}', '<ul class=\"mb-0\"> \r\n<li><strong>Redirect URL :</strong> [URL]/login/facebook/callback</li> \r\n</ul>', 0, '2022-02-23 20:40:12', '2022-06-21 00:28:35');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lang` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lang` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `file_entries`
--

CREATE TABLE `file_entries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shared_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `storage_provider_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filename` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` bigint(20) NOT NULL DEFAULT 0,
  `extension` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path_ids` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `access_status` tinyint(1) NOT NULL DEFAULT 1,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `downloads` bigint(20) NOT NULL DEFAULT 0,
  `views` bigint(20) NOT NULL DEFAULT 0,
  `admin_has_viewed` tinyint(1) NOT NULL DEFAULT 0,
  `expiry_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `file_reports`
--

CREATE TABLE `file_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `file_entry_id` bigint(20) UNSIGNED NOT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason` int(11) NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_has_viewed` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `footer_menu`
--

CREATE TABLE `footer_menu` (
  `id` int(10) UNSIGNED NOT NULL,
  `lang` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `native` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `native`, `code`, `created_at`, `updated_at`) VALUES
(1, 'English', 'English', 'en', '2021-12-11 14:35:51', '2021-12-11 14:35:51');

-- --------------------------------------------------------

--
-- Table structure for table `mail_templates`
--

CREATE TABLE `mail_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lang` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `licence_type` tinyint(1) NOT NULL DEFAULT 1,
  `group_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mail_templates`
--

INSERT INTO `mail_templates` (`id`, `lang`, `licence_type`, `group_name`, `key`, `value`, `created_at`, `updated_at`) VALUES
(2, 'en', 1, 'reset password notification', 'Reset Password Notification', 'Reset Password Notification', '2022-04-04 02:33:49', '2022-04-05 04:58:29'),
(3, 'en', 1, 'reset password notification', 'Hello!', 'Hello!', '2022-04-04 02:33:49', '2022-04-04 04:58:20'),
(4, 'en', 1, 'reset password notification', 'You are receiving this email because we received a password reset request for your account.', 'You are receiving this email because we received a password reset request for your account.', '2022-04-04 02:33:49', '2022-04-04 02:33:49'),
(5, 'en', 1, 'reset password notification', 'Reset Password', 'Reset Password', '2022-04-04 02:33:49', '2022-04-04 02:33:49'),
(6, 'en', 1, 'reset password notification', 'This password reset link will expire in {time} minutes.', 'This password reset link will expire in {time} minutes.', '2022-04-04 02:33:49', '2022-04-04 02:33:49'),
(7, 'en', 1, 'reset password notification', 'If you did not request a password reset, no further action is required.', 'If you did not request a password reset, no further action is required.', '2022-04-04 02:33:49', '2022-04-04 02:33:49'),
(8, 'en', 1, 'reset password notification', 'Regards', 'Regards', '2022-04-04 02:33:49', '2022-04-04 02:33:49'),
(9, 'en', 1, 'reset password notification', 'If you are having trouble clicking the button, just copy and paste the URL below into your web browser', 'If you are having trouble clicking the button, just copy and paste the URL below into your web browser', '2022-04-04 02:33:49', '2022-04-04 02:33:49'),
(11, 'en', 1, 'email verification notification', 'Verify Email Address', 'Verify Email Address', '2022-04-04 02:36:11', '2022-04-04 02:36:47'),
(12, 'en', 1, 'email verification notification', 'Hello!', 'Hello!', '2022-04-04 02:36:11', '2022-04-04 02:36:11'),
(13, 'en', 1, 'email verification notification', 'Please click the button below to verify your email address.', 'Please click the button below to verify your email address.', '2022-04-04 02:36:11', '2022-04-04 02:36:11'),
(14, 'en', 1, 'email verification notification', 'Verify My Email', 'Verify My Email', '2022-04-04 02:36:11', '2022-04-04 02:36:11'),
(15, 'en', 1, 'email verification notification', 'If you did not create an account, no further action is required.', 'If you did not create an account, no further action is required.', '2022-04-04 02:36:11', '2022-04-04 02:36:11'),
(23, 'en', 1, 'email verification notification', 'If you are having trouble clicking the button, just copy and paste the URL below into your web browser', 'If you are having trouble clicking the button, just copy and paste the URL below into your web browser', '2022-04-04 02:36:11', '2022-04-04 02:36:11'),
(185, 'en', 2, 'free subscription renewal notification', 'Your free subscription has been renewed', 'Your free subscription has been renewed', '2022-04-04 03:06:35', '2022-04-04 03:06:35'),
(186, 'en', 2, 'free subscription renewal notification', 'Hi {user_firstname},', 'Hi {user_firstname},', '2022-04-04 03:06:35', '2022-04-04 03:06:35'),
(187, 'en', 2, 'free subscription renewal notification', 'Great news! Your free subscription has officially been renewed. the following email is just to inform you that you can start using your subscription from now.', 'Great news! Your free subscription has officially been renewed. the following email is just to inform you that you can start using your subscription from now.', '2022-04-04 03:06:35', '2022-04-04 03:06:35'),
(188, 'en', 2, 'free subscription renewal notification', 'Start uploading files', 'Start uploading files', '2022-04-04 03:06:35', '2022-04-04 03:06:35'),
(189, 'en', 2, 'free subscription renewal notification', 'You are receiving this email because you have an account in {website_name} If you get this email by mistake, no further action is required.', 'You are receiving this email because you have an account in {website_name} If you get this email by mistake, no further action is required.', '2022-04-04 03:06:35', '2022-04-04 03:06:35'),
(190, 'en', 2, 'free subscription renewal notification', 'Regards', 'Regards', '2022-04-04 03:06:35', '2022-04-04 03:06:35'),
(191, 'en', 2, 'free subscription renewal notification', 'If you are having trouble clicking the button, just copy and paste the URL below into your web browser', 'If you are having trouble clicking the button, just copy and paste the URL below into your web browser', '2022-04-04 03:06:35', '2022-04-04 03:06:35'),
(192, 'en', 2, 'subscription renewal reminder notification', 'RENEWAL NOTICE: Your subscription is expiring soon', 'RENEWAL NOTICE: Your subscription is expiring soon', '2022-04-04 03:46:59', '2022-04-04 03:46:59'),
(193, 'en', 2, 'subscription renewal reminder notification', 'Hi {user_firstname},', 'Hi {user_firstname},', '2022-04-04 03:46:59', '2022-04-04 03:46:59'),
(194, 'en', 2, 'subscription renewal reminder notification', 'Your subscription is about to expire on {expiry_date}, please renew it before it gets expiry to avoid losing your files.', 'Your subscription is about to expire on {expiry_date}, please renew it before it gets expiry to avoid losing your files.', '2022-04-04 03:46:59', '2022-04-04 03:46:59'),
(195, 'en', 2, 'subscription renewal reminder notification', 'Renew Now', 'Renew Now', '2022-04-04 03:46:59', '2022-04-04 03:46:59'),
(196, 'en', 2, 'subscription renewal reminder notification', 'Your Subscription Details', 'Your Subscription Details', '2022-04-04 03:46:59', '2022-04-04 03:46:59'),
(197, 'en', 2, 'subscription renewal reminder notification', 'Plan name', 'Plan name', '2022-04-04 03:46:59', '2022-04-04 03:46:59'),
(198, 'en', 2, 'subscription renewal reminder notification', 'Interval', 'Interval', '2022-04-04 03:46:59', '2022-04-04 03:46:59'),
(199, 'en', 2, 'subscription renewal reminder notification', 'Price', 'Price', '2022-04-04 03:46:59', '2022-04-04 03:46:59'),
(200, 'en', 2, 'subscription renewal reminder notification', 'Not ready to renew? No problem. We\'ll remind you closer to the expiry date, so you don\'t miss the deadline.', 'Not ready to renew? No problem. We\'ll remind you closer to the expiry date, so you don\'t miss the deadline.', '2022-04-04 03:46:59', '2022-04-04 03:46:59'),
(201, 'en', 2, 'subscription renewal reminder notification', 'Regards', 'Regards', '2022-04-04 03:46:59', '2022-04-04 03:46:59'),
(202, 'en', 2, 'subscription renewal reminder notification', 'If you are having trouble clicking the button, just copy and paste the URL below into your web browser', 'If you are having trouble clicking the button, just copy and paste the URL below into your web browser', '2022-04-04 03:46:59', '2022-04-04 03:46:59'),
(203, 'en', 2, 'subscription expiry notification', 'EXPIRY NOTICE: Your subscription has been expired', 'EXPIRY NOTICE: Your subscription has been expired', '2022-04-04 03:58:44', '2022-04-04 04:55:49'),
(204, 'en', 2, 'subscription expiry notification', 'Hi {user_firstname},', 'Hi {user_firstname},', '2022-04-04 03:58:44', '2022-04-04 03:58:44'),
(205, 'en', 2, 'subscription expiry notification', 'Your subscription has been expired, and we are about deleting your files, if you did not renew the subscription after {delete_interval} from now.', 'Your subscription has been expired, and we are about deleting your files, if you did not renew the subscription after {delete_interval} from now.', '2022-04-04 03:58:44', '2022-04-04 03:58:44'),
(206, 'en', 2, 'subscription expiry notification', 'Renew Now', 'Renew Now', '2022-04-04 03:58:44', '2022-04-04 03:58:44'),
(207, 'en', 2, 'subscription expiry notification', 'Your Subscription Details', 'Your Subscription Details', '2022-04-04 03:58:44', '2022-04-04 03:58:44'),
(208, 'en', 2, 'subscription expiry notification', 'Plan name', 'Plan name', '2022-04-04 03:58:44', '2022-04-04 03:58:44'),
(209, 'en', 2, 'subscription expiry notification', 'Interval', 'Interval', '2022-04-04 03:58:44', '2022-04-04 03:58:44'),
(210, 'en', 2, 'subscription expiry notification', 'Price', 'Price', '2022-04-04 03:58:44', '2022-04-04 03:58:44'),
(211, 'en', 2, 'subscription expiry notification', 'You are receiving this email because you have an account in {website_name} If you get this email by mistake, no further action is required.', 'You are receiving this email because you have an account in {website_name} If you get this email by mistake, no further action is required.', '2022-04-04 03:58:44', '2022-04-04 03:58:44'),
(212, 'en', 2, 'subscription expiry notification', 'Regards', 'Regards', '2022-04-04 03:58:44', '2022-04-04 03:58:44'),
(213, 'en', 2, 'subscription expiry notification', 'If you are having trouble clicking the button, just copy and paste the URL below into your web browser', 'If you are having trouble clicking the button, just copy and paste the URL below into your web browser', '2022-04-04 03:58:44', '2022-04-04 03:58:44');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_10_03_223916_create_admins_table', 1),
(6, '2021_10_03_224118_create_admin_password_resets', 1),
(12, '2021_10_07_221832_create_settings_table', 4),
(27, '2021_10_14_230536_create_languages_table', 8),
(29, '2021_10_17_222714_create_additionals_table', 9),
(52, '2021_10_15_212511_create_translates_table', 12),
(54, '2021_10_04_213420_create_pages_table', 14),
(55, '2021_10_06_201713_create_blog_categories_table', 14),
(56, '2021_10_06_201752_create_blog_articles_table', 14),
(62, '2021_11_03_225531_create_countries_table', 19),
(64, '2021_11_25_183407_add_columns_to_users_table', 21),
(65, '2014_10_12_000000_create_users_table', 22),
(71, '2021_11_01_162229_create_user_logs_table', 23),
(73, '2021_12_01_100425_create_admin_notifications_table', 24),
(74, '2021_12_05_004428_create_user_notifications_table', 25),
(77, '2021_12_05_230539_create_social_providers_table', 26),
(82, '2021_12_28_203912_add_views_to_blog_categories_table', 29),
(83, '2021_12_28_203935_add_views_to_blog_articles_table', 29),
(84, '2021_12_28_204116_add_views_to_pages_table', 30),
(86, '2021_12_15_215308_create_footer_menu_table', 31),
(87, '2022_01_06_180145_create_blog_comments_table', 32),
(89, '2022_01_08_213840_create_payment_gateways_table', 34),
(92, '2021_10_28_191044_create_storage_providers_table', 36),
(93, '2022_02_23_213634_create_extensions_table', 37),
(94, '2022_01_12_214207_create_addons_table', 38),
(95, '2022_04_03_220038_create_mail_templates_table', 39),
(96, '2022_03_07_231527_create_taxes_table', 40),
(97, '2022_01_06_225055_create_features_table', 41),
(98, '2021_10_24_215104_create_seo_configurations_table', 42),
(99, '2022_02_26_131252_create_faqs_table', 43),
(100, '2022_04_27_210604_create_slideshows_table', 43),
(101, '2022_06_03_175507_create_plans_table', 43),
(102, '2022_06_05_002615_create_subscriptions_table', 43),
(103, '2022_06_05_002924_create_coupons_table', 43),
(106, '2021_12_14_233352_create_navbar_menu_table', 44),
(107, '2022_06_05_003030_create_transactions_table', 45),
(108, '2019_08_19_000000_create_failed_jobs_table', 46),
(110, '2022_06_24_164954_create_advertisements_table', 47),
(114, '2022_06_08_183452_create_file_entries_table', 48),
(116, '2022_07_05_201637_create_upload_settings_table', 49),
(117, '2022_06_26_214337_create_file_reports_table', 50);

-- --------------------------------------------------------

--
-- Table structure for table `navbar_menu`
--

CREATE TABLE `navbar_menu` (
  `id` int(10) UNSIGNED NOT NULL,
  `page` tinyint(4) NOT NULL,
  `lang` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` tinyint(4) NOT NULL,
  `link` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `views` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_gateways`
--

CREATE TABLE `payment_gateways` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `handler` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fees` int(3) NOT NULL DEFAULT 0 COMMENT '%',
  `min` double(10,2) NOT NULL,
  `test_mode` tinyint(1) DEFAULT NULL COMMENT 'null 0:Disbaled 1:Enabled',
  `credentials` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `instructions` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0:Disabled 1:Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_gateways`
--

INSERT INTO `payment_gateways` (`id`, `name`, `symbol`, `handler`, `logo`, `fees`, `min`, `test_mode`, `credentials`, `instructions`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Paypal', 'paypal_express', 'App\\Http\\Controllers\\Frontend\\Gateways\\PaypalExpressController', 'images/payments/l6yGIXyP6SbqTrA_1641691269.png', 0, 0.00, 0, '{\"client_id\":null,\"client_secret\":null}', '<ul class=\"mb-0\"> \r\n<li>You can get the Api Keys from : <a target=\"__blank\" href=\"https://developer.paypal.com/developer/applications/create\">https://developer.paypal.com/developer/applications/create</a>&nbsp;</li> \r\n</ul>', 0, '2022-01-08 21:05:29', '2022-07-07 16:28:23'),
(2, 'Stripe', 'stripe_checkout', 'App\\Http\\Controllers\\Frontend\\Gateways\\StripeCheckoutController', 'images/payments/ufBAiDA1bT2sZ4O_1655769600.png', 0, 0.50, NULL, '{\"publishable_key\":null,\"secret_key\":null}', '<ul class=\"mb-0\"> <li>You can get the API keys from : <a target=\"__blank\" href=\"https://dashboard.stripe.com/apikeys\">https://dashboard.stripe.com/apikeys</a>&nbsp;</li>\r\n</ul>', 0, '2022-01-08 21:05:29', '2022-07-07 16:28:34');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `interval` tinyint(4) NOT NULL COMMENT '1:Monthly 2:Yearly 3:Lifetime',
  `price` double(10,2) NOT NULL DEFAULT 0.00,
  `storage_space` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `files_duration` bigint(20) DEFAULT NULL,
  `upload_at_once` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_protection` tinyint(1) NOT NULL COMMENT '0:No 1:Yes',
  `advertisements` tinyint(1) NOT NULL COMMENT '0:No 1:Yes',
  `custom_features` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `require_login` tinyint(1) NOT NULL DEFAULT 1,
  `free_plan` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0:No 1:Yes',
  `featured_plan` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0:No 1:Yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seo_configurations`
--

CREATE TABLE `seo_configurations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lang` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keywords` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `robots_index` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `robots_follow_links` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`) VALUES
(1, 'website_name', 'Filebob'),
(2, 'website_url', NULL),
(3, 'website_dark_logo', 'images/dark-logo.jpg'),
(4, 'website_light_logo', 'images/light-logo.jpg'),
(5, 'website_favicon', 'images/favicon.jpg'),
(6, 'website_social_image', 'images/social-image.jpg'),
(7, 'website_primary_color', '#0045AD'),
(8, 'website_secondary_color', '#002369'),
(9, 'website_email_verify_status', '0'),
(10, 'website_registration_status', '1'),
(11, 'mail_status', '0'),
(12, 'mail_mailer', 'smtp'),
(13, 'mail_host', NULL),
(14, 'mail_port', NULL),
(15, 'mail_username', NULL),
(16, 'mail_password', NULL),
(17, 'mail_encryption', 'tls'),
(18, 'mail_form_email', NULL),
(19, 'mail_from_name', NULL),
(25, 'contact_email', NULL),
(34, 'terms_of_service_link', NULL),
(36, 'website_cookie', '0'),
(38, 'date_format', '10'),
(39, 'timezone', 'America/New_York'),
(40, 'website_force_ssl_status', '0'),
(1002, 'website_mail_logo', 'images/mail-logo.jpg'),
(1003, 'website_mail_primary_color', '#0045AD'),
(1004, 'website_mail_background_color', '#EDF2F7'),
(1005, 'website_mail_normal_text_color', '#718096'),
(1006, 'website_mail_bold_text_color', '#3D4852'),
(1007, 'website_blog_status', '1'),
(1008, 'website_tickets_status', '1'),
(1009, 'website_contact_form_status', '0'),
(1010, 'website_currency', '5'),
(1011, 'expired_subscriptions_files_delete', '7'),
(1012, 'unacceptable_file_types', 'exe,php,lnk'),
(1013, 'website_chunk_size', '50'),
(1014, 'website_third_color', '#282F3D'),
(1015, 'website_dark_mode_primary_color', '#181C25'),
(1016, 'website_dark_mode_secondary_color', '#282F3D'),
(1017, 'website_file_icon_dark_color', '#0045AD'),
(1018, 'website_file_icon_medium_color', '#376CBB'),
(1019, 'website_file_icon_light_color', '#7DA2DA'),
(1020, 'website_folder_icon_color', '#F8C341'),
(1021, 'website_faq_status', '1'),
(1022, 'website_download_waiting_time', '10'),
(1023, 'website_download_page_blog_posts_status', '1'),
(1024, 'default_folders', 'Videos,Music,Photos,Documents');

-- --------------------------------------------------------

--
-- Table structure for table `slideshows`
--

CREATE TABLE `slideshows` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` tinyint(4) NOT NULL COMMENT '1:Image 2:Video',
  `source` tinyint(4) NOT NULL COMMENT '1:Upload 2:URL',
  `file` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `social_providers`
--

CREATE TABLE `social_providers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `facebook` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `storage_providers`
--

CREATE TABLE `storage_providers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `handler` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `credentials` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `instructions` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0:Disabled 1:Enabled',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `storage_providers`
--

INSERT INTO `storage_providers` (`id`, `name`, `symbol`, `handler`, `logo`, `credentials`, `instructions`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Local Storage', 'local', 'App\\Http\\Controllers\\Frontend\\Storage\\LocalController', 'images/storage/local.png', '{}', NULL, 1, '2022-02-20 22:13:06', '2022-02-20 22:44:06'),
(2, 'Amazon S3', 's3', 'App\\Http\\Controllers\\Frontend\\Storage\\AmazonController', 'images/storage/amazon.png', '{\"access_key_id\":null,\"secret_access_key\":null,\"default_region\":null,\"bucket\":null,\"url\":null}', NULL, 0, '2022-02-20 22:12:55', '2022-06-25 22:36:18'),
(3, 'Wasabi Cloud Storage', 'wasabi', 'App\\Http\\Controllers\\Frontend\\Storage\\WasabiController', 'images/storage/wasabi.png', '{\"access_key_id\":null,\"secret_access_key\":null,\"default_region\":null,\"bucket\":null}', NULL, 0, '2022-02-20 22:13:01', '2022-06-25 22:36:28'),
(4, 'Backblaze B2 Cloud Storage ', 'backblazeb2', 'App\\Http\\Controllers\\Frontend\\Storage\\Backblazeb2Controller', 'images/storage/backblaze.png', '{\"access_key_id\":null,\"secret_access_key\":null,\"default_region\":null,\"bucket\":null,\"endpoint\":null}', '<ul class=\"mb-0\"> \r\n<li class=\"mb-2\">Endpoint must start with <strong>Https://</strong></li>\r\n<li>You will get the endpoint without https:// from backblaze b2, you have to add it manually.</li>\r\n</ul>', 0, '2022-02-20 22:13:01', '2022-07-07 16:23:37');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `plan_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0:Canceled 1:Active',
  `expiry_at` timestamp NULL DEFAULT NULL,
  `admin_has_viewed` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE `taxes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED DEFAULT NULL,
  `percentage` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `checkout_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `plan_id` bigint(20) UNSIGNED NOT NULL,
  `coupon_id` bigint(20) UNSIGNED DEFAULT NULL,
  `details_before_discount` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details_after_discount` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plan_price` double(10,2) NOT NULL,
  `tax_price` double(10,2) NOT NULL DEFAULT 0.00,
  `fees_price` double(10,2) NOT NULL DEFAULT 0.00,
  `total_price` double(10,2) NOT NULL,
  `payment_gateway_id` bigint(20) UNSIGNED DEFAULT NULL,
  `payment_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payer_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payer_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` tinyint(4) NOT NULL COMMENT '1:Subscribe 2:renew 3:Upgrade',
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1:Pending 2:Paid 3:Canceled',
  `cancellation_reason` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_has_viewed` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `translates`
--

CREATE TABLE `translates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lang` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `licence_type` tinyint(1) NOT NULL DEFAULT 1,
  `group_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'general',
  `key` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `translates`
--

INSERT INTO `translates` (`id`, `lang`, `licence_type`, `group_name`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1025, 'en', 1, 'general', 'All rights reserved', 'All rights reserved', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1026, 'en', 1, 'validation', 'The :attribute must be accepted.', 'The :attribute must be accepted.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1027, 'en', 1, 'validation', 'The :attribute must be accepted when :other is :value.', 'The :attribute must be accepted when :other is :value.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1028, 'en', 1, 'validation', 'The :attribute is not a valid URL.', 'The :attribute is not a valid URL.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1029, 'en', 1, 'validation', 'The :attribute must be a date after :date.', 'The :attribute must be a date after :date.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1030, 'en', 1, 'validation', 'The :attribute must be a date after or equal to :date.', 'The :attribute must be a date after or equal to :date.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1031, 'en', 1, 'validation', 'The :attribute must only contain letters.', 'The :attribute must only contain letters.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1032, 'en', 1, 'validation', 'The :attribute must only contain letters, numbers, dashes and underscores.', 'The :attribute must only contain letters, numbers, dashes and underscores.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1033, 'en', 1, 'validation', 'The :attribute must only contain letters and numbers.', 'The :attribute must only contain letters and numbers.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1034, 'en', 1, 'validation', 'The :attribute must be an array.', 'The :attribute must be an array.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1035, 'en', 1, 'validation', 'The :attribute must be a date before :date.', 'The :attribute must be a date before :date.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1036, 'en', 1, 'validation', 'The :attribute must be a date before or equal to :date.', 'The :attribute must be a date before or equal to :date.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1037, 'en', 1, 'validation', 'The :attribute must be between :min and :max.', 'The :attribute must be between :min and :max.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1038, 'en', 1, 'validation', 'The :attribute must be between :min and :max kilobytes.', 'The :attribute must be between :min and :max kilobytes.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1039, 'en', 1, 'validation', 'The :attribute must be between :min and :max characters.', 'The :attribute must be between :min and :max characters.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1040, 'en', 1, 'validation', 'The :attribute must have between :min and :max items.', 'The :attribute must have between :min and :max items.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1041, 'en', 1, 'validation', 'The :attribute field must be true or false.', 'The :attribute field must be true or false.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1042, 'en', 1, 'validation', 'The :attribute confirmation does not match.', 'The :attribute confirmation does not match.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1043, 'en', 1, 'validation', 'The password is incorrect.', 'The password is incorrect.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1044, 'en', 1, 'validation', 'The :attribute is not a valid date.', 'The :attribute is not a valid date.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1045, 'en', 1, 'validation', 'The :attribute must be a date equal to :date.', 'The :attribute must be a date equal to :date.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1046, 'en', 1, 'validation', 'The :attribute does not match the format :format.', 'The :attribute does not match the format :format.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1047, 'en', 1, 'validation', 'The :attribute and :other must be different.', 'The :attribute and :other must be different.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1048, 'en', 1, 'validation', 'The :attribute must be :digits digits.', 'The :attribute must be :digits digits.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1049, 'en', 1, 'validation', 'The :attribute must be between :min and :max digits.', 'The :attribute must be between :min and :max digits.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1050, 'en', 1, 'validation', 'The :attribute has invalid image dimensions.', 'The :attribute has invalid image dimensions.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1051, 'en', 1, 'validation', 'The :attribute field has a duplicate value.', 'The :attribute field has a duplicate value.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1052, 'en', 1, 'validation', 'The :attribute must be a valid email address.', 'The :attribute must be a valid email address.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1053, 'en', 1, 'validation', 'The :attribute must end with one of the following: :values.', 'The :attribute must end with one of the following: :values.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1054, 'en', 1, 'validation', 'The selected :attribute is invalid.', 'The selected :attribute is invalid.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1055, 'en', 1, 'validation', 'The :attribute must be a file.', 'The :attribute must be a file.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1056, 'en', 1, 'validation', 'The :attribute field must have a value.', 'The :attribute field must have a value.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1057, 'en', 1, 'validation', 'The :attribute must be greater than :value.', 'The :attribute must be greater than :value.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1058, 'en', 1, 'validation', 'The :attribute must be greater than :value kilobytes.', 'The :attribute must be greater than :value kilobytes.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1059, 'en', 1, 'validation', 'The :attribute must be greater than :value characters.', 'The :attribute must be greater than :value characters.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1060, 'en', 1, 'validation', 'The :attribute must have more than :value items.', 'The :attribute must have more than :value items.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1061, 'en', 1, 'validation', 'The :attribute must be greater than or equal :value.', 'The :attribute must be greater than or equal :value.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1062, 'en', 1, 'validation', 'The :attribute must be greater than or equal :value kilobytes.', 'The :attribute must be greater than or equal :value kilobytes.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1063, 'en', 1, 'validation', 'The :attribute must be greater than or equal :value characters.', 'The :attribute must be greater than or equal :value characters.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1064, 'en', 1, 'validation', 'The :attribute must have :value items or more.', 'The :attribute must have :value items or more.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1065, 'en', 1, 'validation', 'The :attribute must be an image.', 'The :attribute must be an image.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1066, 'en', 1, 'validation', 'The :attribute field does not exist in :other.', 'The :attribute field does not exist in :other.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1067, 'en', 1, 'validation', 'The :attribute must be an integer.', 'The :attribute must be an integer.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1068, 'en', 1, 'validation', 'The :attribute must be a valid IP address.', 'The :attribute must be a valid IP address.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1069, 'en', 1, 'validation', 'The :attribute must be a valid IPv4 address.', 'The :attribute must be a valid IPv4 address.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1070, 'en', 1, 'validation', 'The :attribute must be a valid IPv6 address.', 'The :attribute must be a valid IPv6 address.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1071, 'en', 1, 'validation', 'The :attribute must be a valid JSON string.', 'The :attribute must be a valid JSON string.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1072, 'en', 1, 'validation', 'The :attribute must be less than :value.', 'The :attribute must be less than :value.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1073, 'en', 1, 'validation', 'The :attribute must be less than :value kilobytes.', 'The :attribute must be less than :value kilobytes.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1074, 'en', 1, 'validation', 'The :attribute must be less than :value characters.', 'The :attribute must be less than :value characters.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1075, 'en', 1, 'validation', 'The :attribute must have less than :value items.', 'The :attribute must have less than :value items.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1076, 'en', 1, 'validation', 'The :attribute must be less than or equal :value.', 'The :attribute must be less than or equal :value.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1077, 'en', 1, 'validation', 'The :attribute must be less than or equal :value kilobytes.', 'The :attribute must be less than or equal :value kilobytes.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1078, 'en', 1, 'validation', 'The :attribute must be less than or equal :value characters.', 'The :attribute must be less than or equal :value characters.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1079, 'en', 1, 'validation', 'The :attribute must not have more than :value items.', 'The :attribute must not have more than :value items.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1080, 'en', 1, 'validation', 'The :attribute must not be greater than :max.', 'The :attribute must not be greater than :max.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1081, 'en', 1, 'validation', 'The :attribute must not be greater than :max kilobytes.', 'The :attribute must not be greater than :max kilobytes.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1082, 'en', 1, 'validation', 'The :attribute must not be greater than :max characters.', 'The :attribute must not be greater than :max characters.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1083, 'en', 1, 'validation', 'The :attribute must not have more than :max items.', 'The :attribute must not have more than :max items.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1084, 'en', 1, 'validation', 'The :attribute must be a file of type: :values.', 'The :attribute must be a file of type: :values.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1085, 'en', 1, 'validation', 'The :attribute must be at least :min.', 'The :attribute must be at least :min.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1086, 'en', 1, 'validation', 'The :attribute must be at least :min kilobytes.', 'The :attribute must be at least :min kilobytes.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1087, 'en', 1, 'validation', 'The :attribute must be at least :min characters.', 'The :attribute must be at least :min characters.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1088, 'en', 1, 'validation', 'The :attribute must have at least :min items.', 'The :attribute must have at least :min items.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1089, 'en', 1, 'validation', 'The :attribute must be a multiple of :value.', 'The :attribute must be a multiple of :value.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1090, 'en', 1, 'validation', 'The :attribute format is invalid.', 'The :attribute format is invalid.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1091, 'en', 1, 'validation', 'The :attribute must be a number.', 'The :attribute must be a number.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1092, 'en', 1, 'validation', 'The :attribute field must be present.', 'The :attribute field must be present.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1093, 'en', 1, 'validation', 'The :attribute field is required.', 'The :attribute field is required.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1094, 'en', 1, 'validation', 'The :attribute field is required when :other is :value.', 'The :attribute field is required when :other is :value.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1095, 'en', 1, 'validation', 'The :attribute field is required unless :other is in :values.', 'The :attribute field is required unless :other is in :values.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1096, 'en', 1, 'validation', 'The :attribute field is required when :values is present.', 'The :attribute field is required when :values is present.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1097, 'en', 1, 'validation', 'The :attribute field is required when :values are present.', 'The :attribute field is required when :values are present.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1098, 'en', 1, 'validation', 'The :attribute field is required when :values is not present.', 'The :attribute field is required when :values is not present.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1099, 'en', 1, 'validation', 'The :attribute field is required when none of :values are present.', 'The :attribute field is required when none of :values are present.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1100, 'en', 1, 'validation', 'The :attribute field is prohibited.', 'The :attribute field is prohibited.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1101, 'en', 1, 'validation', 'The :attribute field is prohibited when :other is :value.', 'The :attribute field is prohibited when :other is :value.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1102, 'en', 1, 'validation', 'The :attribute field is prohibited unless :other is in :values.', 'The :attribute field is prohibited unless :other is in :values.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1103, 'en', 1, 'validation', 'The :attribute field prohibits :other from being present.', 'The :attribute field prohibits :other from being present.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1104, 'en', 1, 'validation', 'The :attribute and :other must match.', 'The :attribute and :other must match.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1105, 'en', 1, 'validation', 'The :attribute must be :size.', 'The :attribute must be :size.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1106, 'en', 1, 'validation', 'The :attribute must be :size kilobytes.', 'The :attribute must be :size kilobytes.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1107, 'en', 1, 'validation', 'The :attribute must be :size characters.', 'The :attribute must be :size characters.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1108, 'en', 1, 'validation', 'The :attribute must contain :size items.', 'The :attribute must contain :size items.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1109, 'en', 1, 'validation', 'The :attribute must start with one of the following: :values.', 'The :attribute must start with one of the following: :values.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1110, 'en', 1, 'validation', 'The :attribute must be a string.', 'The :attribute must be a string.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1111, 'en', 1, 'validation', 'The :attribute must be a valid timezone.', 'The :attribute must be a valid timezone.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1112, 'en', 1, 'validation', 'The :attribute has already been taken.', 'The :attribute has already been taken.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1113, 'en', 1, 'validation', 'The :attribute failed to upload.', 'The :attribute failed to upload.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1114, 'en', 1, 'validation', 'The :attribute must be a valid URL.', 'The :attribute must be a valid URL.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1115, 'en', 1, 'validation', 'The :attribute must be a valid UUID.', 'The :attribute must be a valid UUID.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1118, 'en', 1, 'alerts', 'These credentials do not match our records.', 'These credentials do not match our records.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1119, 'en', 1, 'alerts', 'The provided password is incorrect.', 'The provided password is incorrect.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1120, 'en', 1, 'alerts', 'Too many login attempts. Please try again in :seconds seconds.', 'Too many login attempts. Please try again in :seconds seconds.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1121, 'en', 1, 'alerts', 'Your password has been reset!', 'Your password has been reset!', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1122, 'en', 1, 'alerts', 'We have emailed your password reset link!', 'We have emailed your password reset link!', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1123, 'en', 1, 'alerts', 'Please wait before retrying.', 'Please wait before retrying.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1124, 'en', 1, 'alerts', 'This password reset token is invalid.', 'This password reset token is invalid.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1125, 'en', 1, 'alerts', 'We can\'t find a user with that email address.', 'We can\'t find a user with that email address.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1126, 'en', 1, 'forms', 'captcha', 'captcha', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1135, 'en', 1, 'user', 'Sign In', 'Sign In', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1136, 'en', 1, 'user', 'Sign Up', 'Sign Up', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1137, 'en', 1, 'user', 'Reset Password', 'Reset Password', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1138, 'en', 1, 'user', 'Sign in page title', 'Sign in', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1139, 'en', 1, 'user', 'Sign in to your account to continue', 'Sign in to your account to continue', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1140, 'en', 1, 'forms', 'Email address', 'Email address', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1141, 'en', 1, 'forms', 'Password', 'Password', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1142, 'en', 1, 'user', 'Remember Me', 'Remember Me', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1143, 'en', 1, 'user', 'Forgot Your Password?', 'Forgot Your Password?', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1144, 'en', 1, 'user', 'Or', 'Or', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1145, 'en', 1, 'user', 'Sign in With Facebook', 'Sign in With Facebook', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1146, 'en', 1, 'user', 'You will receive an email with a link to reset your password', 'You will receive an email with a link to reset your password', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1147, 'en', 1, 'user', 'Reset', 'Reset', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1148, 'en', 1, 'user', 'Enter a new password to continue.', 'Enter a new password to continue.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1149, 'en', 1, 'forms', 'Confirm password', 'Confirm password', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1150, 'en', 1, 'user', 'Please confirm your password before continuing.', 'Please confirm your password before continuing.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1151, 'en', 1, 'user', 'Confirm Password', 'Confirm Password', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1152, 'en', 1, 'forms', 'First Name', 'First Name', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1153, 'en', 1, 'forms', 'Last Name', 'Last Name', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1154, 'en', 1, 'forms', 'Username', 'Username', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1155, 'en', 1, 'general', 'Choose', 'Choose', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1156, 'en', 1, 'forms', 'Country', 'Country', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1157, 'en', 1, 'forms', 'Phone Number', 'Phone Number', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1158, 'en', 1, 'user', 'I agree to the', 'I agree to the', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1159, 'en', 1, 'user', 'terms of service', 'terms of service', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1160, 'en', 1, 'user', 'Continue', 'Continue', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1161, 'en', 1, 'user', 'Create account', 'Create account', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1162, 'en', 1, 'user', 'Enter your details to create an account', 'Enter your details to create an account', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1163, 'en', 1, 'alerts', 'Country not exists', 'Country not exists', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1164, 'en', 1, 'alerts', 'Phone code not exsits', 'Phone code not exsits', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1165, 'en', 1, 'alerts', 'Registration is currently disabled.', 'Registration is currently disabled.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1166, 'en', 1, 'alerts', 'Your account has been blocked', 'Your account has been blocked', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1167, 'en', 1, 'user', 'Verify Your Email Address', 'Verify Your Email Address', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1168, 'en', 1, 'user', 'Thanks for getting started with', 'Thanks for getting started with', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1169, 'en', 1, 'user', 'We need a little more information to complete your registration, including a confirmation of your email address.', 'We need a little more information to complete your registration, including a confirmation of your email address.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1170, 'en', 1, 'user', 'Please follow the instruction that we sent to your email, if you didn\'t receive the email click resent to get a new one.', 'Please follow the instruction that we sent to your email, if you didn\'t receive the email click resent to get a new one.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1171, 'en', 1, 'user', 'Resend', 'Resend', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1172, 'en', 1, 'user', 'Change Email', 'Change Email', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1173, 'en', 1, 'alerts', 'Link has been resend Successfully', 'Link has been resend Successfully', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1174, 'en', 1, 'user', 'Save', 'Save', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1175, 'en', 1, 'alerts', 'You must to change the email to make a change', 'You must to change the email to make a change', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1176, 'en', 1, 'alerts', 'Email has been changed successfully', 'Email has been changed successfully', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1177, 'en', 1, 'user', 'Logout', 'Logout', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1178, 'en', 1, 'user', 'Dashboard', 'Dashboard', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1180, 'en', 1, 'user', 'Settings', 'Settings', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1181, 'en', 1, 'user', 'Account Details', 'Account Details', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1182, 'en', 1, 'user', 'Change Password', 'Change Password', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1183, 'en', 1, 'user', '2FA Authentication', '2FA Authentication', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1184, 'en', 1, 'user', 'No Content Found', 'No Content Found', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1185, 'en', 1, 'user', 'It looks like this section is empty or your search did not return any results, you can start creating a content or search using another word', 'It looks like this section is empty or your search did not return any results, you can start creating a content or search using another word', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1186, 'en', 1, 'user', 'Back', 'Back', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1209, 'en', 1, 'user', 'Notifications', 'Notifications', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1210, 'en', 1, 'user', 'Make All as Read', 'Make All as Read', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1211, 'en', 1, 'user', 'View All', 'View All', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1212, 'en', 1, 'user', 'All notifications has been read successfully', 'All notifications has been read successfully', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1213, 'en', 1, 'user', 'User', 'User', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1214, 'en', 1, 'user', 'No notifications found', 'No notifications found', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1215, 'en', 1, 'alerts', 'Connection error please try again', 'Connection error please try again', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1216, 'en', 1, 'alerts', 'Upload error', 'Upload error', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1217, 'en', 1, 'user', 'Complete registration', 'Complete registration', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1218, 'en', 1, 'user', 'We need a little more information to complete your registration.', 'We need a little more information to complete your registration.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1219, 'en', 1, 'alerts', 'Unauthorized or expired token', 'Unauthorized or expired token', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1236, 'en', 1, 'user', 'Change', 'Change', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1237, 'en', 1, 'forms', 'Address line 1', 'Address line 1', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1238, 'en', 1, 'forms', 'Address line 2', 'Address line 2', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1239, 'en', 1, 'forms', 'Apartment, suite, etc. (optional)', 'Apartment, suite, etc. (optional)', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1240, 'en', 1, 'forms', 'City', 'City', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1241, 'en', 1, 'forms', 'State', 'State', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1242, 'en', 1, 'forms', 'Postal code', 'Postal code', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1243, 'en', 1, 'user', 'Save Changes', 'Save Changes', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1244, 'en', 1, 'alerts', 'Phone number already exist', 'Phone number already exist', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1245, 'en', 1, 'alerts', 'You must to change the phone number to make a change', 'You must to change the phone number to make a change', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1246, 'en', 1, 'alerts', 'Phone number has been changed successfully', 'Phone number has been changed successfully', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1247, 'en', 1, 'alerts', 'Phone number must be in the same country where you located', 'Phone number must be in the same country where you located', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1248, 'en', 1, 'alerts', 'Account details has been updated successfully', 'Account details has been updated successfully', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1249, 'en', 1, 'user', 'Verify Your New Email Address', 'Verify Your New Email Address', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1250, 'en', 1, 'user', 'Since you have changed your email address, we need to verify that it is really your email', 'Since you have changed your email address, we need to verify that it is really your email', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1251, 'en', 1, 'forms', 'New Password', 'New Password', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1252, 'en', 1, 'forms', 'Confirm New Password', 'Confirm New Password', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1253, 'en', 1, 'alerts', 'Your current password does not matches with the password you provided', 'Your current password does not matches with the password you provided', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1254, 'en', 1, 'alerts', 'New Password cannot be same as your current password. Please choose a different password', 'New Password cannot be same as your current password. Please choose a different password', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1255, 'en', 1, 'alerts', 'Account password has been changed successfully', 'Account password has been changed successfully', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1256, 'en', 1, 'user', 'Two-factor authentication (2FA) strengthens access security by requiring two methods (also referred to as factors) to verify your identity. Two-factor authentication protects against phishing, social engineering, and password brute force attacks and secures your logins from attackers exploiting weak or stolen credentials.', 'Two-factor authentication (2FA) strengthens access security by requiring two methods (also referred to as factors) to verify your identity. Two-factor authentication protects against phishing, social engineering, and password brute force attacks and secures your logins from attackers exploiting weak or stolen credentials.', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1257, 'en', 1, 'user', 'To use the two factor authentication, you have to install a Google Authenticator compatible app. Here are some that are currently available', 'To use the two factor authentication, you have to install a Google Authenticator compatible app. Here are some that are currently available', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1258, 'en', 1, 'user', 'Google Authenticator for iOS', 'Google Authenticator for iOS', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1259, 'en', 1, 'user', 'Google Authenticator for Android', 'Google Authenticator for Android', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1260, 'en', 1, 'user', 'Microsoft Authenticator for iOS', 'Microsoft Authenticator for iOS', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1261, 'en', 1, 'user', 'Microsoft Authenticator for Android', 'Microsoft Authenticator for Android', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1262, 'en', 1, 'user', 'Enable', 'Enable', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1263, 'en', 1, 'user', 'Enable 2FA Authentication', 'Enable 2FA Authentication', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1264, 'en', 1, 'alerts', 'Invalid OTP code', 'Invalid OTP code', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1265, 'en', 1, 'alerts', '2FA Authentication has been enabled successfully', '2FA Authentication has been enabled successfully', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1266, 'en', 1, 'user', 'Disable 2FA Authentication', 'Disable 2FA Authentication', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1267, 'en', 1, 'user', 'Disable', 'Disable', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1268, 'en', 1, 'alerts', '2FA Authentication has been disabled successfully', '2FA Authentication has been disabled successfully', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1269, 'en', 1, 'forms', 'OTP Code', 'OTP Code', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1270, 'en', 1, 'user', '2Fa Verification', '2Fa Verification', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1271, 'en', 1, 'user', 'Please enter the OTP code to continue', 'Please enter the OTP code to continue', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1272, 'en', 1, 'error pages', 'Page Not Found', 'Page Not Found', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1273, 'en', 1, 'error pages', 'Unauthorized', 'Unauthorized', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1274, 'en', 1, 'error pages', 'Server Error', 'Server Error', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1275, 'en', 1, 'error pages', 'Service Unavailable', 'Service Unavailable', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1276, 'en', 1, 'error pages', 'Too Many Requests', 'Too Many Requests', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1277, 'en', 1, 'error pages', 'Forbidden', 'Forbidden', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1278, 'en', 1, 'error pages', 'Page Expired', 'Page Expired', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1279, 'en', 1, 'error pages', 'You can’t always get what you want. It’s true in life, and it’s true on the web — sometimes, what you’re looking for just isn’t there', 'You can’t always get what you want. It’s true in life, and it’s true on the web — sometimes, what you’re looking for just isn’t there', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1280, 'en', 1, 'error pages', 'Back to home', 'Back to home', '2021-12-11 14:35:51', '2021-12-11 14:35:51'),
(1281, 'en', 1, 'general', 'We use cookies to personalize your experience. By continuing to visit this website you agree to our use of cookies', 'We use cookies to personalize your experience. By continuing to visit this website you agree to our use of cookies', '2021-12-11 17:50:17', '2021-12-11 17:50:17'),
(1282, 'en', 1, 'general', 'Got it', 'Got it', '2021-12-11 17:50:17', '2021-12-11 17:50:17'),
(1283, 'en', 1, 'general', 'More', 'More', '2021-12-11 17:50:17', '2021-12-11 17:50:17'),
(1284, 'en', 1, 'alerts', 'Cookie accepted successfully', 'Cookie accepted successfully', '2021-12-11 18:19:44', '2021-12-11 18:19:44'),
(1285, 'en', 1, 'general', 'Close', 'Close', '2021-12-14 19:26:32', '2021-12-14 19:26:32'),
(3433, 'en', 1, 'general', 'Copied to clipboard', 'Copied to clipboard', '2022-04-16 03:16:10', '2022-04-16 03:16:10'),
(3434, 'en', 1, 'general', 'B', 'B', '2022-06-20 22:04:45', '2022-06-20 22:04:45'),
(3435, 'en', 1, 'general', 'KB', 'KB', '2022-06-20 22:04:45', '2022-06-20 22:04:45'),
(3436, 'en', 1, 'general', 'MB', 'MB', '2022-06-20 22:04:45', '2022-06-20 22:04:45'),
(3437, 'en', 1, 'general', 'GB', 'GB', '2022-06-20 22:04:45', '2022-06-20 22:04:45'),
(3438, 'en', 1, 'general', 'TB', 'TB', '2022-06-20 22:04:45', '2022-06-20 22:04:45'),
(3439, 'en', 1, 'general', 'day', 'day', '2022-06-20 22:05:18', '2022-06-20 22:05:18'),
(3440, 'en', 1, 'general', 'days', 'days', '2022-06-20 22:05:18', '2022-06-20 22:05:18'),
(3441, 'en', 2, 'general', 'monthly', 'Monthly', '2022-06-20 22:05:47', '2022-07-06 16:40:06'),
(3442, 'en', 2, 'general', 'yearly', 'Yearly', '2022-06-20 22:05:47', '2022-07-06 16:40:06'),
(3443, 'en', 2, 'general', 'lifetime', 'Lifetime', '2022-06-20 22:05:47', '2022-07-06 16:40:06'),
(3444, 'en', 2, 'plans', 'month', 'month', '2022-06-20 22:06:04', '2022-07-06 16:27:56'),
(3445, 'en', 2, 'plans', 'year', 'year', '2022-06-20 22:06:04', '2022-07-06 16:27:56'),
(3446, 'en', 2, 'plans', 'lifetime', 'lifetime', '2022-06-20 22:06:04', '2022-07-06 16:27:56'),
(3447, 'en', 2, 'transactions', 'Subscribe', 'Subscribe', '2022-06-20 22:07:33', '2022-07-06 16:27:34'),
(3448, 'en', 2, 'transactions', 'Renew', 'Renew', '2022-06-20 22:07:33', '2022-07-06 16:27:34'),
(3449, 'en', 2, 'transactions', 'Upgrade', 'Upgrade', '2022-06-20 22:07:33', '2022-07-06 16:27:34'),
(3450, 'en', 1, 'general', 'Second', 'Second', '2022-06-20 22:07:48', '2022-06-20 22:07:48'),
(3451, 'en', 1, 'general', 'Seconds', 'Seconds', '2022-06-20 22:07:48', '2022-06-20 22:07:48'),
(3452, 'en', 1, 'home page', 'Upload and Share Your Files', 'Upload and Share Your Files', '2022-06-20 22:08:27', '2022-06-20 22:08:27'),
(3453, 'en', 1, 'home page', 'Upload your Images, documents, music, and video in a single place and access them anywhere and share them everywhere.', 'Upload your Images, documents, music, and video in a single place and access them anywhere and share them everywhere.', '2022-06-20 22:08:27', '2022-06-20 22:08:27'),
(3454, 'en', 1, 'home page', 'Upload', 'Upload', '2022-06-20 22:08:27', '2022-06-20 22:08:27'),
(3455, 'en', 1, 'home page', 'Features', 'Features', '2022-06-20 22:08:27', '2022-06-20 22:08:27'),
(3456, 'en', 1, 'home page', 'Features description', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s.', '2022-06-20 22:08:27', '2022-06-20 22:12:11'),
(3457, 'en', 2, 'home page', 'Pricing', 'Pricing', '2022-06-20 22:08:27', '2022-07-06 16:42:41'),
(3458, 'en', 2, 'home page', 'Pricing description', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s.', '2022-06-20 22:08:27', '2022-07-06 16:42:41'),
(3459, 'en', 2, 'general', 'Free', 'Free', '2022-06-20 22:08:27', '2022-07-06 16:40:06'),
(3460, 'en', 2, 'plans', '{seconds} download waiting time', '{seconds} download waiting time', '2022-06-20 22:08:27', '2022-07-06 16:27:56'),
(3462, 'en', 2, 'plans', '{storage_space} Storage space', '{storage_space} Storage space', '2022-06-20 22:08:27', '2022-07-06 16:27:56'),
(3463, 'en', 2, 'plans', '{file_size} Size per file', '{file_size} Size per file', '2022-06-20 22:08:27', '2022-07-06 16:27:56'),
(3464, 'en', 2, 'plans', 'Files available for {files_duration}', 'Files available for {files_duration}', '2022-06-20 22:08:27', '2022-07-06 16:27:56'),
(3465, 'en', 2, 'plans', 'No advertisements', 'No advertisements', '2022-06-20 22:08:27', '2022-07-06 16:27:56'),
(3466, 'en', 2, 'plans', 'Password protected files', 'Password protected files', '2022-06-20 22:08:27', '2022-07-06 16:27:56'),
(3467, 'en', 1, 'general', 'Unlimited', 'Unlimited', '2022-06-20 22:08:27', '2022-06-20 22:08:27'),
(3468, 'en', 1, 'general', 'Unlimited time', 'Unlimited time', '2022-06-20 22:08:27', '2022-06-20 22:08:27'),
(3469, 'en', 2, 'plans', 'No download waiting time', 'No download waiting time', '2022-06-20 22:08:27', '2022-07-06 16:27:56'),
(3470, 'en', 2, 'plans', 'Featured', 'Featured', '2022-06-20 22:08:27', '2022-07-06 16:27:56'),
(3471, 'en', 2, 'plans', 'Advertisements', 'Advertisements', '2022-06-20 22:08:27', '2022-07-06 16:27:56'),
(3472, 'en', 2, 'plans', 'Choose plan', 'Choose plan', '2022-06-20 22:08:27', '2022-07-06 16:27:56'),
(3473, 'en', 1, 'home page', 'Latest blog posts', 'Latest blog posts', '2022-06-20 22:08:27', '2022-06-20 22:08:27'),
(3474, 'en', 1, 'home page', 'Latest blog posts description', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s.', '2022-06-20 22:08:27', '2022-06-20 22:12:11'),
(3476, 'en', 1, 'home page', 'View more', 'View more', '2022-06-20 22:08:27', '2022-06-20 22:08:27'),
(3477, 'en', 1, 'home page', 'FAQ', 'FAQ', '2022-06-20 22:08:27', '2022-06-20 22:08:27'),
(3478, 'en', 1, 'home page', 'FAQ description', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s.', '2022-06-20 22:08:27', '2022-06-20 22:12:11'),
(3479, 'en', 1, 'home page', 'Find out more answers on our FAQ', 'Find out more answers on our FAQ', '2022-06-20 22:08:27', '2022-06-20 22:08:27'),
(3480, 'en', 1, 'home page', 'Contact Us', 'Contact Us', '2022-06-20 22:08:27', '2022-06-20 22:08:27'),
(3481, 'en', 1, 'home page', 'Contact Us description', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s.', '2022-06-20 22:08:27', '2022-06-20 22:12:11'),
(3482, 'en', 1, 'forms', 'Name', 'Name', '2022-06-20 22:08:27', '2022-06-20 22:08:27'),
(3483, 'en', 1, 'forms', 'Subject', 'Subject', '2022-06-20 22:08:27', '2022-06-20 22:08:27'),
(3484, 'en', 1, 'forms', 'Message', 'Message', '2022-06-20 22:08:27', '2022-06-20 22:08:27'),
(3485, 'en', 1, 'home page', 'Send', 'Send', '2022-06-20 22:08:28', '2022-06-20 22:08:28'),
(3486, 'en', 1, 'upload zone', 'Upload Files', 'Upload Files', '2022-06-20 22:08:28', '2022-07-06 16:39:29'),
(3487, 'en', 1, 'upload zone', 'Upload more', 'Upload more', '2022-06-20 22:08:28', '2022-07-06 16:39:29'),
(3488, 'en', 1, 'upload zone', 'Max File Size {max_file_size}', 'Max File Size {max_file_size}', '2022-06-20 22:08:28', '2022-06-20 22:08:28'),
(3489, 'en', 1, 'upload zone', 'Files available for {files_duration}', 'Files available for {files_duration}', '2022-06-20 22:08:28', '2022-06-20 22:08:28'),
(3490, 'en', 1, 'upload zone', 'Reset', 'Reset', '2022-06-20 22:08:28', '2022-06-20 22:08:28'),
(3491, 'en', 1, 'upload zone', 'Drag and drop or click here to upload', 'Drag and drop or click here to upload', '2022-06-20 22:08:28', '2022-06-20 22:08:28'),
(3492, 'en', 1, 'upload zone', 'You can also', 'You can also', '2022-06-20 22:08:28', '2022-06-20 22:08:28'),
(3493, 'en', 1, 'upload zone', 'browse from your computer', 'browse from your computer', '2022-06-20 22:08:28', '2022-06-20 22:08:28'),
(3494, 'en', 1, 'upload zone', 'Password protection', 'Password protection', '2022-06-20 22:08:28', '2022-06-20 22:08:28'),
(3495, 'en', 1, 'upload zone', 'The password helps protect your file from public accessing', 'The password helps protect your file from public accessing', '2022-06-20 22:08:28', '2022-06-20 22:08:28'),
(3496, 'en', 1, 'upload zone', 'Enter password', 'Enter password', '2022-06-20 22:08:28', '2022-06-20 22:08:28'),
(3497, 'en', 1, 'upload zone', 'Submit', 'Submit', '2022-06-20 22:08:28', '2022-06-20 22:08:28'),
(3498, 'en', 1, 'upload zone', 'Auto delete file', 'Auto delete file', '2022-06-20 22:08:28', '2022-06-20 22:08:28'),
(3499, 'en', 1, 'upload zone', 'Don\'t autodelete', 'Don\'t autodelete', '2022-06-20 22:08:28', '2022-06-20 22:08:28'),
(3500, 'en', 1, 'upload zone', 'After 5 minutes', 'After 5 minutes', '2022-06-20 22:08:28', '2022-06-20 22:08:28'),
(3501, 'en', 1, 'upload zone', 'After 15 minutes', 'After 15 minutes', '2022-06-20 22:08:28', '2022-06-20 22:08:28'),
(3502, 'en', 1, 'upload zone', 'After 30 minutes', 'After 30 minutes', '2022-06-20 22:08:28', '2022-06-20 22:08:28'),
(3503, 'en', 1, 'upload zone', 'After 1 hour', 'After 1 hour', '2022-06-20 22:08:28', '2022-06-20 22:08:28'),
(3504, 'en', 1, 'upload zone', 'After 3 hours', 'After 3 hours', '2022-06-20 22:08:28', '2022-06-20 22:08:28'),
(3505, 'en', 1, 'upload zone', 'After 6 hours', 'After 6 hours', '2022-06-20 22:08:28', '2022-06-20 22:08:28'),
(3506, 'en', 1, 'upload zone', 'After 12 hours', 'After 12 hours', '2022-06-20 22:08:28', '2022-06-20 22:08:28'),
(3507, 'en', 1, 'upload zone', 'After 1 day', 'After 1 day', '2022-06-20 22:08:28', '2022-06-20 22:08:28'),
(3508, 'en', 1, 'upload zone', 'After 2 days', 'After 2 days', '2022-06-20 22:08:28', '2022-06-20 22:08:28'),
(3509, 'en', 1, 'upload zone', 'After 3 days', 'After 3 days', '2022-06-20 22:08:28', '2022-06-20 22:08:28'),
(3510, 'en', 1, 'upload zone', 'After 4 days', 'After 4 days', '2022-06-20 22:08:28', '2022-06-20 22:08:28'),
(3511, 'en', 1, 'upload zone', 'After 5 days', 'After 5 days', '2022-06-20 22:08:28', '2022-06-20 22:08:28'),
(3512, 'en', 1, 'upload zone', 'After 6 days', 'After 6 days', '2022-06-20 22:08:28', '2022-06-20 22:08:28'),
(3513, 'en', 1, 'upload zone', 'After 1 week', 'After 1 week', '2022-06-20 22:08:28', '2022-06-20 22:08:28'),
(3514, 'en', 1, 'upload zone', 'After 2 weeks', 'After 2 weeks', '2022-06-20 22:08:28', '2022-06-20 22:08:28'),
(3515, 'en', 1, 'upload zone', 'After 3 weeks', 'After 3 weeks', '2022-06-20 22:08:28', '2022-06-20 22:08:28'),
(3516, 'en', 1, 'upload zone', 'After 1 month', 'After 1 month', '2022-06-20 22:08:28', '2022-06-20 22:08:28'),
(3517, 'en', 1, 'upload zone', 'After 2 months', 'After 2 months', '2022-06-20 22:08:28', '2022-06-20 22:08:28'),
(3518, 'en', 1, 'upload zone', 'After 3 months', 'After 3 months', '2022-06-20 22:08:28', '2022-06-20 22:08:28'),
(3519, 'en', 1, 'upload zone', 'After 4 months', 'After 4 months', '2022-06-20 22:08:28', '2022-06-20 22:08:28'),
(3520, 'en', 1, 'upload zone', 'After 5 months', 'After 5 months', '2022-06-20 22:08:28', '2022-06-20 22:08:28'),
(3521, 'en', 1, 'upload zone', 'After 6 months', 'After 6 months', '2022-06-20 22:08:28', '2022-06-20 22:08:28'),
(3522, 'en', 1, 'upload zone', 'After 1 year', 'After 1 year', '2022-06-20 22:08:28', '2022-06-20 22:08:28'),
(3523, 'en', 1, 'upload zone', 'Upload', 'Upload', '2022-06-20 22:08:28', '2022-06-20 22:08:28'),
(3524, 'en', 1, 'upload zone', 'File is too big, Max file size {maxFileSize}', 'File is too big, Max file size {maxFileSize}', '2022-06-20 22:08:28', '2022-06-20 22:08:28'),
(3525, 'en', 1, 'upload zone', 'Download link', 'Download link', '2022-06-20 22:08:28', '2022-06-20 22:08:28'),
(3526, 'en', 1, 'upload zone', 'Preview link', 'Preview link', '2022-06-20 22:08:28', '2022-06-20 22:08:28'),
(3527, 'en', 1, 'upload zone', 'View File', 'View File', '2022-06-20 22:08:28', '2022-06-20 22:08:28'),
(3528, 'en', 1, 'alerts', 'Login or create account to start uploading files', 'Login or create account to start uploading files', '2022-06-20 22:08:28', '2022-06-20 22:08:28'),
(3529, 'en', 2, 'alerts', 'Your subscription has been expired, renew it to start uploading files', 'Your subscription has been expired, renew it to start uploading files', '2022-06-20 22:08:28', '2022-07-06 16:41:20'),
(3530, 'en', 2, 'alerts', 'Your subscription has been canceled, please contact us for more information', 'Your subscription has been canceled, please contact us for more information', '2022-06-20 22:08:28', '2022-07-06 16:41:20'),
(3531, 'en', 1, 'upload zone', 'Invalid file auto delete time', 'Invalid file auto delete time', '2022-06-20 22:08:28', '2022-06-20 22:08:28'),
(3532, 'en', 1, 'upload zone', 'Are you sure you want to close this window?', 'Are you sure you want to close this window?', '2022-06-20 22:08:28', '2022-06-20 22:08:28'),
(3533, 'en', 1, 'upload zone', 'No files attached', 'No files attached', '2022-06-20 22:08:28', '2022-06-20 22:08:28'),
(3534, 'en', 1, 'upload zone', 'You cannot upload files of this type.', 'You cannot upload files of this type.', '2022-06-20 22:08:28', '2022-06-20 22:08:28'),
(3535, 'en', 1, 'upload zone', 'insufficient storage space please ensure sufficient space', 'insufficient storage space please ensure sufficient space', '2022-06-20 22:08:28', '2022-06-20 22:08:28'),
(3536, 'en', 1, 'upload zone', 'File with the same name already attached', 'File with the same name already attached', '2022-06-20 22:08:28', '2022-06-20 22:08:28'),
(3537, 'en', 1, 'upload zone', 'file is too big max file size: {{maxFilesize}}MiB.', 'file is too big max file size: {{maxFilesize}}MiB.', '2022-06-20 22:08:28', '2022-06-20 22:08:28'),
(3538, 'en', 1, 'upload zone', 'Server responded with {{statusCode}} code.', 'Server responded with {{statusCode}} code.', '2022-06-20 22:08:28', '2022-06-20 22:08:28'),
(3539, 'en', 1, 'upload zone', 'Drop files here to upload', 'Drop files here to upload', '2022-06-20 22:08:28', '2022-06-20 22:08:28'),
(3540, 'en', 1, 'upload zone', 'Your browser does not support drag and drop file uploads.', 'Your browser does not support drag and drop file uploads.', '2022-06-20 22:08:28', '2022-06-20 22:08:28'),
(3541, 'en', 1, 'upload zone', 'Please use the fallback form below to upload your files like in the olden days.', 'Please use the fallback form below to upload your files like in the olden days.', '2022-06-20 22:08:28', '2022-06-20 22:08:28'),
(3542, 'en', 1, 'upload zone', 'Cancel upload', 'Cancel upload', '2022-06-20 22:08:28', '2022-06-20 22:08:28'),
(3543, 'en', 1, 'upload zone', 'Are you sure you want to cancel this upload?', 'Are you sure you want to cancel this upload?', '2022-06-20 22:08:28', '2022-06-20 22:08:28'),
(3544, 'en', 1, 'upload zone', 'Remove file', 'Remove file', '2022-06-20 22:08:28', '2022-06-20 22:08:28'),
(3545, 'en', 1, 'upload zone', 'You can not upload any more files.', 'You can not upload any more files.', '2022-06-20 22:08:28', '2022-06-20 22:08:28'),
(3546, 'en', 2, 'plans', 'Upload {count} file at once', 'Upload {count} file at once', '2022-06-20 22:09:32', '2022-07-06 16:27:56'),
(3547, 'en', 2, 'plans', 'Upload {count} files at once', 'Upload {count} files at once', '2022-06-20 22:08:27', '2022-07-06 16:27:56'),
(3548, 'en', 1, 'home page', 'Get Started', 'Get Started', '2022-06-20 22:11:47', '2022-06-20 22:11:47'),
(3549, 'en', 1, 'blog', 'Blog', 'Blog', '2022-06-20 22:12:57', '2022-06-20 22:12:57'),
(3550, 'en', 1, 'blog', 'Search..', 'Search..', '2022-06-20 22:12:57', '2022-06-20 22:12:57'),
(3551, 'en', 1, 'blog', 'Popular articles', 'Popular articles', '2022-06-20 22:12:57', '2022-06-20 22:12:57'),
(3552, 'en', 1, 'blog', 'Categories', 'Categories', '2022-06-20 22:12:57', '2022-06-20 22:12:57'),
(3553, 'en', 1, 'blog', 'Comments', 'Comments', '2022-06-20 22:13:12', '2022-06-20 22:13:12'),
(3554, 'en', 1, 'blog', 'No comments available', 'No comments available', '2022-06-20 22:13:12', '2022-06-20 22:13:12'),
(3555, 'en', 1, 'blog', 'Login or create account to leave comments', 'Login or create account to leave comments', '2022-06-20 22:13:12', '2022-06-20 22:13:12'),
(3558, 'en', 2, 'plans', 'Pricing plans', 'Pricing plans', '2022-06-20 22:13:22', '2022-07-06 16:27:56'),
(3559, 'en', 2, 'user', 'Choose your plan to complete the subscription', 'Choose your plan to complete the subscription', '2022-06-20 22:13:22', '2022-07-06 16:42:17'),
(3570, 'en', 2, 'alerts', 'Subscribed Successfully', 'Subscribed Successfully', '2022-06-20 22:13:36', '2022-07-06 16:41:20'),
(3571, 'en', 2, 'subscription', 'Subscription', 'Subscription', '2022-06-20 22:13:36', '2022-07-06 16:27:16'),
(3572, 'en', 2, 'subscription', 'Subscription expiration date', 'Subscription expiration date', '2022-06-20 22:13:36', '2022-07-06 16:27:16'),
(3573, 'en', 2, 'subscription', 'Your current plan', 'Your current plan', '2022-06-20 22:13:36', '2022-07-06 16:27:16'),
(3574, 'en', 2, 'transactions', 'Transactions', 'Transactions', '2022-06-20 22:13:36', '2022-07-06 16:27:34'),
(3575, 'en', 2, 'transactions', 'Transaction Number', 'Transaction Number', '2022-06-20 22:13:36', '2022-07-06 16:27:34'),
(3576, 'en', 2, 'transactions', 'Plan (Interval)', 'Plan (Interval)', '2022-06-20 22:13:36', '2022-07-06 16:27:34'),
(3577, 'en', 2, 'transactions', 'Plan Price', 'Plan Price', '2022-06-20 22:13:36', '2022-07-06 16:27:34'),
(3578, 'en', 2, 'transactions', 'Total', 'Total', '2022-06-20 22:13:36', '2022-07-06 16:27:34'),
(3579, 'en', 2, 'transactions', 'Type', 'Type', '2022-06-20 22:13:36', '2022-07-06 16:27:34'),
(3580, 'en', 2, 'transactions', 'Status', 'Status', '2022-06-20 22:13:36', '2022-07-06 16:27:34'),
(3581, 'en', 2, 'transactions', 'Transaction date', 'Transaction date', '2022-06-20 22:13:36', '2022-07-06 16:27:34'),
(3582, 'en', 2, 'transactions', 'Action', 'Action', '2022-06-20 22:13:36', '2022-07-06 16:27:34'),
(3583, 'en', 2, 'transactions', 'Done', 'Done', '2022-06-20 22:13:36', '2022-07-06 16:27:34');
INSERT INTO `translates` (`id`, `lang`, `licence_type`, `group_name`, `key`, `value`, `created_at`, `updated_at`) VALUES
(3584, 'en', 1, 'user', 'My files', 'My files', '2022-06-20 22:13:37', '2022-06-20 22:13:37'),
(3585, 'en', 2, 'user', 'My subscription', 'My subscription', '2022-06-20 22:13:37', '2022-07-06 16:42:17'),
(3586, 'en', 2, 'subscription', 'Upgrade', 'Upgrade', '2022-06-20 22:13:37', '2022-07-06 16:27:16'),
(3587, 'en', 1, 'file manager', 'File Manager', 'File Manager', '2022-06-20 22:13:38', '2022-06-20 22:13:38'),
(3588, 'en', 1, 'file manager', 'My Files', 'My Files', '2022-06-20 22:13:38', '2022-06-20 22:13:38'),
(3589, 'en', 1, 'file manager', 'Recent files', 'Recent files', '2022-06-20 22:13:38', '2022-06-20 22:13:38'),
(3591, 'en', 1, 'file manager', 'Trash', 'Trash', '2022-06-20 22:13:38', '2022-06-20 22:13:38'),
(3592, 'en', 2, 'file manager', 'Subscription', 'Subscription', '2022-06-20 22:13:38', '2022-07-06 16:44:24'),
(3593, 'en', 1, 'file manager', 'Settings', 'Settings', '2022-06-20 22:13:38', '2022-06-20 22:13:38'),
(3594, 'en', 1, 'file manager', 'Logout', 'Logout', '2022-06-20 22:13:38', '2022-06-20 22:13:38'),
(3595, 'en', 1, 'file manager', 'Upload', 'Upload', '2022-06-20 22:13:38', '2022-06-20 22:13:38'),
(3596, 'en', 1, 'file manager', 'Search on your files & folders', 'Search on your files & folders', '2022-06-20 22:13:38', '2022-06-20 22:13:38'),
(3597, 'en', 1, 'file manager', 'Selected', 'Selected', '2022-06-20 22:13:38', '2022-06-20 22:13:38'),
(3598, 'en', 1, 'file manager', 'My Folders', 'My Folders', '2022-06-20 22:13:38', '2022-06-20 22:13:38'),
(3599, 'en', 1, 'file manager', 'Create Folder', 'Create Folder', '2022-06-20 22:13:38', '2022-06-20 22:13:38'),
(3600, 'en', 1, 'file manager', 'Theme', 'Theme', '2022-06-20 22:13:38', '2022-06-20 22:13:38'),
(3601, 'en', 1, 'file manager', 'Give this folder a name', 'Give this folder a name', '2022-06-20 22:13:38', '2022-06-20 22:13:38'),
(3602, 'en', 1, 'file manager', 'Folder Name', 'Folder Name', '2022-06-20 22:13:38', '2022-06-20 22:13:38'),
(3603, 'en', 1, 'file manager', 'Cancel', 'Cancel', '2022-06-20 22:13:38', '2022-06-20 22:13:38'),
(3604, 'en', 1, 'file manager', 'Create', 'Create', '2022-06-20 22:13:38', '2022-06-20 22:13:38'),
(3605, 'en', 1, 'file manager', 'Folder name required', 'Folder name required', '2022-06-20 22:13:38', '2022-06-20 22:13:38'),
(3606, 'en', 1, 'file manager', 'Failed to load files', 'Failed to load files', '2022-06-20 22:13:38', '2022-06-20 22:13:38'),
(3607, 'en', 1, 'file manager', 'Failed to load folders', 'Failed to load folders', '2022-06-20 22:13:38', '2022-06-20 22:13:38'),
(3608, 'en', 1, 'file manager', 'This Folder is Empty', 'This Folder is Empty', '2022-06-20 22:13:40', '2022-06-20 22:13:40'),
(3609, 'en', 1, 'file manager', 'You Don\'t have any folders', 'You Don\'t have any folders', '2022-06-20 22:13:40', '2022-06-20 22:13:40'),
(3610, 'en', 2, 'plans', 'Your plan', 'Your plan', '2022-06-20 22:13:44', '2022-07-06 16:27:56'),
(3611, 'en', 2, 'plans', 'Upgrade plan', 'Upgrade plan', '2022-06-20 22:13:44', '2022-07-06 16:27:56'),
(3612, 'en', 1, 'blog', 'Leave a comment', 'Leave a comment', '2022-06-20 22:13:54', '2022-06-20 22:13:54'),
(3613, 'en', 1, 'blog', 'Your comment', 'Your comment', '2022-06-20 22:13:54', '2022-06-20 22:13:54'),
(3614, 'en', 1, 'blog', 'Publish', 'Publish', '2022-06-20 22:13:54', '2022-06-20 22:13:54'),
(3615, 'en', 1, 'alerts', 'Your comment is under review it will be published soon', 'Your comment is under review it will be published soon', '2022-06-20 22:14:02', '2022-06-20 22:14:02'),
(3616, 'en', 1, 'general', 'FAQ', 'FAQ', '2022-06-20 22:14:15', '2022-06-20 22:14:15'),
(3617, 'en', 1, 'alerts', 'Error on sending', 'Error on sending', '2022-06-20 22:14:29', '2022-06-20 22:14:29'),
(3618, 'en', 1, 'alerts', 'Your message has been sent successfully', 'Your message has been sent successfully', '2022-06-20 22:14:37', '2022-06-20 22:14:37'),
(3620, 'en', 2, 'transactions', 'Transaction details', 'Transaction details', '2022-06-20 22:16:07', '2022-07-06 16:27:34'),
(3621, 'en', 2, 'transactions', 'Transaction Type', 'Transaction Type', '2022-06-20 22:16:07', '2022-07-06 16:27:34'),
(3622, 'en', 2, 'transactions', 'Transaction Status', 'Transaction Status', '2022-06-20 22:16:07', '2022-07-06 16:27:34'),
(3623, 'en', 2, 'transactions', 'Taxes', 'Taxes', '2022-06-20 22:16:07', '2022-07-06 16:27:34'),
(3624, 'en', 2, 'transactions', 'Subtotal', 'Subtotal', '2022-06-20 22:16:07', '2022-07-06 16:27:34'),
(3635, 'en', 2, 'transactions', 'Paid', 'Paid', '2022-06-20 22:20:20', '2022-07-06 16:27:34'),
(3636, 'en', 2, 'transactions', 'Coupon Code', 'Coupon Code', '2022-06-20 22:20:29', '2022-07-06 16:27:34'),
(3637, 'en', 2, 'transactions', 'Payment method', 'Payment method', '2022-06-20 22:20:29', '2022-07-06 16:27:34'),
(3638, 'en', 2, 'transactions', 'Discount', 'Discount', '2022-06-20 22:20:29', '2022-07-06 16:27:34'),
(3639, 'en', 2, 'transactions', 'Gateway Fees', 'Gateway Fees', '2022-06-20 22:20:29', '2022-07-06 16:27:34'),
(3640, 'en', 1, 'notifications', 'Thanks for joining us {user_firstname}!', 'Thanks for joining us {user_firstname}!', '2022-06-20 22:21:00', '2022-06-20 22:21:00'),
(3641, 'en', 2, 'notifications', 'Transaction canceled {transaction_number}', 'Transaction canceled {transaction_number}', '2022-06-20 22:21:25', '2022-07-06 16:44:41'),
(3643, 'en', 2, 'transactions', 'Canceled', 'Canceled', '2022-06-20 22:21:36', '2022-07-06 16:27:34'),
(3644, 'en', 2, 'transactions', 'Transaction has been canceled', 'Transaction has been canceled', '2022-06-20 22:21:39', '2022-07-06 16:27:34'),
(3645, 'en', 1, 'blog', 'No data found', 'No data found', '2022-06-20 22:23:39', '2022-06-20 22:23:39'),
(3646, 'en', 1, 'blog', 'It looks like there is no articles or your search did not return any results', 'It looks like there is no articles or your search did not return any results', '2022-06-20 22:23:39', '2022-06-20 22:23:39'),
(3647, 'en', 1, 'file manager', '{count} downloads', '{count} downloads', '2022-06-20 22:28:18', '2022-06-20 22:28:18'),
(3648, 'en', 1, 'file manager', '{count} download', '{count} download', '2022-06-20 22:29:53', '2022-06-20 22:29:53'),
(3649, 'en', 1, 'file manager', '{count} folder', '{count} folder', '2022-06-20 22:31:09', '2022-06-20 22:31:09'),
(3650, 'en', 1, 'file manager', '{count} folders', '{count} folders', '2022-06-20 22:31:09', '2022-06-20 22:31:09'),
(3651, 'en', 1, 'file manager', '{count} file', '{count} file', '2022-06-20 22:31:09', '2022-06-20 22:31:09'),
(3652, 'en', 1, 'file manager', '{count} files', '{count} files', '2022-06-20 22:31:09', '2022-06-20 22:31:09'),
(3653, 'en', 1, 'file manager', 'Folder created successfully', 'Folder created successfully', '2022-06-20 22:34:25', '2022-06-20 22:34:25'),
(3654, 'en', 1, 'file manager', 'Filemanager', 'Filemanager', '2022-06-20 22:34:27', '2022-06-20 22:34:27'),
(3655, 'en', 1, 'upload zone', 'Folder not exists', 'Folder not exists', '2022-06-20 22:34:34', '2022-06-20 22:34:34'),
(3656, 'en', 1, 'upload zone', 'Unavailable storage provider', 'Unavailable storage provider', '2022-06-20 22:35:08', '2022-06-20 22:35:08'),
(3657, 'en', 1, 'upload zone', 'Failed to upload ({filename})', 'Failed to upload ({filename})', '2022-06-20 22:35:39', '2022-06-20 22:35:39'),
(3658, 'en', 1, 'file manager', 'The parent folder not exist', 'The parent folder not exist', '2022-06-20 22:36:44', '2022-06-20 22:36:44'),
(3659, 'en', 1, 'file manager', 'Folder with that name already exists', 'Folder with that name already exists', '2022-06-20 22:36:57', '2022-06-20 22:36:57'),
(3660, 'en', 2, 'checkout', 'Checkout', 'Checkout', '2022-03-04 21:19:41', '2022-07-06 16:26:49'),
(3661, 'en', 2, 'checkout', 'Billing address', 'Billing address', '2022-03-04 21:19:41', '2022-07-06 16:26:49'),
(3662, 'en', 2, 'checkout', 'Payment Methods', 'Payment Methods', '2022-03-04 21:19:41', '2022-07-06 16:26:49'),
(3663, 'en', 2, 'checkout', 'SSL Secure Payment', 'SSL Secure Payment', '2022-03-04 21:21:56', '2022-07-06 16:26:49'),
(3664, 'en', 2, 'checkout', 'Your information is protected by 256-bit SSL encryption', 'Your information is protected by 256-bit SSL encryption', '2022-03-04 21:21:56', '2022-07-06 16:26:49'),
(3665, 'en', 2, 'checkout', 'Pay Now', 'Pay Now', '2022-03-04 21:34:00', '2022-07-06 16:26:49'),
(3666, 'en', 2, 'checkout', 'Order Summary', 'Order Summary', '2022-03-04 21:43:08', '2022-07-06 16:26:49'),
(3667, 'en', 2, 'checkout', 'No payment methods available right now please try again later.', 'No payment methods available right now please try again later.', '2022-03-05 16:30:47', '2022-07-06 16:26:49'),
(3668, 'en', 2, 'checkout', 'Tax', 'Tax', '2022-03-06 21:32:07', '2022-07-06 16:26:49'),
(3669, 'en', 2, 'checkout', 'Total', 'Total', '2022-03-06 21:32:07', '2022-07-06 16:26:49'),
(3670, 'en', 2, 'checkout', 'Plan', 'Plan', '2022-03-06 21:39:18', '2022-07-06 16:26:49'),
(3671, 'en', 2, 'checkout', 'Selected payment method is not active ', 'Selected payment method is not active ', '2022-03-06 22:59:07', '2022-07-06 16:26:49'),
(3672, 'en', 2, 'checkout', 'Invalid or expired transaction', 'Invalid or expired transaction', '2022-03-06 23:18:22', '2022-07-06 16:26:49'),
(3673, 'en', 2, 'checkout', 'Payment failed', 'Payment failed', '2022-03-07 17:22:59', '2022-07-06 16:26:49'),
(3674, 'en', 2, 'checkout', 'Process payment failed', 'Process payment failed', '2022-03-07 17:24:25', '2022-07-06 16:26:49'),
(3675, 'en', 2, 'checkout', 'Payment gateways may charge extra fees', 'Payment gateways may charge extra fees', '2022-03-07 17:35:04', '2022-07-06 16:26:49'),
(3676, 'en', 2, 'checkout', 'Payment made successfully', 'Payment made successfully', '2022-03-08 16:20:07', '2022-07-06 16:26:49'),
(3677, 'en', 2, 'checkout', 'Incomplete payment please contact us', 'Incomplete payment please contact us', '2022-03-08 20:16:32', '2022-07-06 16:26:49'),
(3678, 'en', 2, 'checkout', 'No payment method needed.', 'No payment method needed.', '2022-03-10 16:14:55', '2022-07-06 16:26:49'),
(3679, 'en', 2, 'checkout', 'Continue', 'Continue', '2022-03-10 16:20:35', '2022-07-06 16:26:49'),
(3680, 'en', 2, 'checkout', 'Coupon Code', 'Coupon Code', '2022-05-15 21:24:20', '2022-07-06 16:26:49'),
(3681, 'en', 2, 'checkout', 'Enter coupon code', 'Enter coupon code', '2022-05-15 21:24:20', '2022-07-06 16:26:49'),
(3682, 'en', 2, 'checkout', 'Apply', 'Apply', '2022-05-15 21:24:20', '2022-07-06 16:26:49'),
(3683, 'en', 2, 'checkout', 'Invalid or expired coupon code', 'Invalid or expired coupon code', '2022-05-15 21:25:03', '2022-07-06 16:26:49'),
(3684, 'en', 2, 'checkout', 'Coupon has been applied successfully', 'Coupon has been applied successfully', '2022-05-15 21:50:15', '2022-07-06 16:26:49'),
(3685, 'en', 2, 'checkout', 'Subtotal', 'Subtotal', '2022-05-15 21:50:16', '2022-07-06 16:26:49'),
(3686, 'en', 2, 'checkout', 'Discount', 'Discount', '2022-05-15 21:50:16', '2022-07-06 16:26:49'),
(3687, 'en', 2, 'checkout', 'You have exceeded the usage limit for this coupon', 'You have exceeded the usage limit for this coupon', '2022-05-15 21:59:06', '2022-07-06 16:26:49'),
(3688, 'en', 1, 'blog', 'Read More', 'Read More', '2022-06-20 22:49:13', '2022-06-20 22:49:13'),
(3690, 'en', 1, 'general', 'Contact Us', 'Contact Us', '2022-06-20 23:00:00', '2022-06-20 23:00:00'),
(3691, 'en', 1, 'general', 'Are you sure?', 'Are you sure?', '2022-06-20 23:02:15', '2022-06-20 23:02:15'),
(3692, 'en', 1, 'general', 'Confirm that you want do this action', 'Confirm that you want do this action', '2022-06-20 23:02:15', '2022-06-20 23:02:15'),
(3693, 'en', 1, 'general', 'Confirm', 'Confirm', '2022-06-20 23:02:15', '2022-06-20 23:02:15'),
(3694, 'en', 1, 'general', 'Cancel', 'Cancel', '2022-06-20 23:02:15', '2022-06-20 23:02:15'),
(3695, 'en', 2, 'plans', 'No plans available', 'No plans available', '2022-06-21 00:53:15', '2022-07-06 16:27:56'),
(3696, 'en', 2, 'subscription', 'Renew Subscription', 'Renew Subscription', '2022-06-21 01:03:23', '2022-07-06 16:27:16'),
(3697, 'en', 2, 'plans', 'Renew plan', 'Renew plan', '2022-06-21 01:20:02', '2022-07-06 16:27:56'),
(3698, 'en', 2, 'alerts', 'You need to subscribe before you can upgrade the plan', 'You need to subscribe before you can upgrade the plan', '2022-06-21 14:20:40', '2022-07-06 16:41:20'),
(3699, 'en', 2, 'alerts', 'You can only renew your current plan or upgrade to new plan', 'You can only renew your current plan or upgrade to new plan', '2022-06-21 14:20:56', '2022-07-06 16:41:20'),
(3700, 'en', 2, 'alerts', 'You cannot upgrade to this plan, storage space not enough', 'You cannot upgrade to this plan, storage space not enough', '2022-06-21 14:21:21', '2022-07-06 16:41:20'),
(3701, 'en', 2, 'checkout', 'Important Notice !', 'Important Notice !', '2022-06-21 14:28:07', '2022-07-06 16:26:49'),
(3702, 'en', 2, 'checkout', 'When you upgrade the plan before your current plan expires, you will lose all the features in your current plan and move to the new plan, and the new plan period will be calculated and the old period removed.', 'When you upgrade the plan before your current plan expires, you will lose all the features in your current plan and move to the new plan, and the new plan period will be calculated and the old period removed.', '2022-06-21 14:28:07', '2022-07-06 16:26:49'),
(3703, 'en', 1, 'preview', 'Preview', 'Preview', '2022-06-21 16:22:34', '2022-06-21 16:22:34'),
(3704, 'en', 1, 'preview', 'shared by \"{username}\"', 'shared by \"{username}\"', '2022-06-21 16:27:02', '2022-06-21 16:27:02'),
(3705, 'en', 1, 'preview', 'Share', 'Share', '2022-06-21 16:28:41', '2022-06-21 16:28:41'),
(3706, 'en', 1, 'preview', 'Download', 'Download', '2022-06-21 16:28:41', '2022-06-21 16:28:41'),
(3707, 'en', 1, 'general', 'Share this file', 'Share this file', '2022-06-21 17:28:32', '2022-06-21 17:28:32'),
(3708, 'en', 1, 'general', 'Preview link', 'Preview link', '2022-06-21 17:28:32', '2022-06-21 17:28:32'),
(3709, 'en', 1, 'general', 'Download link', 'Download link', '2022-06-21 17:28:32', '2022-06-21 17:28:32'),
(3710, 'en', 1, 'general', 'Copy', 'Copy', '2022-06-21 17:29:33', '2022-06-21 17:29:33'),
(3713, 'en', 1, 'file password', 'File', 'File', '2022-06-21 20:45:27', '2022-06-21 20:45:27'),
(3714, 'en', 1, 'file password', 'Password', 'Password', '2022-06-21 20:45:27', '2022-06-21 20:45:27'),
(3717, 'en', 1, 'file password', 'Enter the password to unlock the file', 'Enter the password to unlock the file', '2022-06-21 20:59:58', '2022-06-21 20:59:58'),
(3718, 'en', 1, 'file password', 'Enter password', 'Enter password', '2022-06-21 21:00:11', '2022-06-21 21:00:11'),
(3719, 'en', 1, 'file password', 'Unlock', 'Unlock', '2022-06-21 21:00:43', '2022-06-21 21:00:43'),
(3720, 'en', 1, 'alerts', 'Unauthorized action', 'Unauthorized action', '2022-06-21 22:48:25', '2022-06-21 22:48:25'),
(3722, 'en', 1, 'file password', 'Incorrect password', 'Incorrect password', '2022-06-21 23:09:43', '2022-06-21 23:09:43'),
(3746, 'en', 1, 'download page', 'Download', 'Download', '2022-06-24 15:48:01', '2022-06-24 15:48:01'),
(3747, 'en', 1, 'download page', 'Share File', 'Share File', '2022-06-24 15:48:01', '2022-06-24 15:48:01'),
(3748, 'en', 1, 'download page', 'Report File', 'Report File', '2022-06-24 15:48:01', '2022-06-24 15:48:01'),
(3749, 'en', 1, 'download page', 'Preview File', 'Preview File', '2022-06-24 15:48:01', '2022-06-24 15:48:01'),
(3750, 'en', 1, 'download page', 'Please Wait {seconds}', 'Please Wait {seconds}', '2022-06-24 15:48:01', '2022-06-24 15:48:01'),
(3751, 'en', 1, 'download page', 'Download ({fileSize})', 'Download ({fileSize})', '2022-06-24 15:48:01', '2022-06-24 15:48:01'),
(3752, 'en', 1, 'download page', 'Create an account today and get 1 TB of space', 'Create an account today and get 1 TB of space', '2022-06-24 15:48:01', '2022-06-24 15:48:01'),
(3753, 'en', 1, 'download page', 'Get started', 'Get started', '2022-06-24 15:48:01', '2022-06-24 15:48:01'),
(3754, 'en', 1, 'download page', 'File extension (.{file_extension})', 'File extension (.{file_extension})', '2022-06-24 15:48:01', '2022-06-24 15:48:01'),
(3755, 'en', 1, 'download page', 'File size', 'File size', '2022-06-24 15:48:01', '2022-06-24 15:48:01'),
(3756, 'en', 1, 'download page', 'Uploaded at', 'Uploaded at', '2022-06-24 15:48:01', '2022-06-24 15:48:01'),
(3757, 'en', 1, 'download page', 'About {filename}', 'About {filename}', '2022-06-24 15:48:01', '2022-06-24 15:48:01'),
(3758, 'en', 1, 'download page', 'File name {filename}, which is a {file_extension} format, and it its one of the files that can be downloaded and used easily. You can upload similar files without the need for a {website_name} account, or you can create an account by clicking on the sign-up button and you will be able to upload and manage your files. {website_name} supports many file formats and you can upload your files and share them anywhere and download them anytime', 'File name {filename}, which is a {file_extension} format, and it its one of the files that can be downloaded and used easily. You can upload similar files without the need for a {website_name} account, or you can create an account by clicking on the sign-up button and you will be able to upload and manage your files. {website_name} supports many file formats and you can upload your files and share them anywhere and download them anytime', '2022-06-24 15:48:01', '2022-06-24 15:48:01'),
(3759, 'en', 1, 'download page', 'Latest blog posts', 'Latest blog posts', '2022-06-24 15:48:01', '2022-06-24 15:48:01'),
(3760, 'en', 1, 'download page', 'View more', 'View more', '2022-06-24 15:48:01', '2022-06-24 15:48:01'),
(3762, 'en', 1, 'upload zone', 'Empty files cannot be uploaded', 'Empty files cannot be uploaded', '2022-06-25 13:26:28', '2022-06-25 13:26:28'),
(3763, 'en', 1, 'upload zone', 'Storage provider error', 'Storage provider error', '2022-06-25 14:14:11', '2022-06-25 14:14:11'),
(3764, 'en', 1, 'upload zone', 'Storage provider error', 'Storage provider error', '2022-06-25 14:14:11', '2022-06-25 14:14:11'),
(3766, 'en', 1, 'download page', 'Downloading...', 'Downloading...', '2022-06-25 17:26:36', '2022-06-25 17:26:36'),
(3767, 'en', 1, 'download page', 'File not found, missing or expired', 'File not found, missing or expired', '2022-06-25 17:35:02', '2022-06-25 17:35:02'),
(3768, 'en', 1, 'alerts', 'Unauthorized access', 'Unauthorized access', '2022-06-25 17:51:19', '2022-06-25 17:51:19'),
(3769, 'en', 1, 'download page', 'There was a problem while trying to download the file', 'There was a problem while trying to download the file', '2022-06-25 19:16:25', '2022-06-25 19:16:25'),
(3770, 'en', 1, 'download page', 'Report this file', 'Report this file', '2022-06-26 20:38:36', '2022-06-26 20:38:36'),
(3771, 'en', 1, 'download page', 'Name', 'Name', '2022-06-26 20:39:28', '2022-06-26 20:39:28'),
(3772, 'en', 1, 'download page', 'Email', 'Email', '2022-06-26 20:39:28', '2022-06-26 20:39:28'),
(3773, 'en', 1, 'download page', 'Reason for reporting', 'Reason for reporting', '2022-06-26 20:39:28', '2022-06-26 20:39:28'),
(3776, 'en', 1, 'download page', 'Privacy, copyright or legal complaints', 'Privacy, copyright or legal complaints', '2022-06-26 20:41:19', '2022-06-26 20:41:19'),
(3777, 'en', 1, 'download page', 'Spam or misleading', 'Spam or misleading', '2022-06-26 20:41:19', '2022-06-26 20:41:19'),
(3778, 'en', 1, 'download page', 'Malware, virus or malicious content', 'Malware, virus or malicious content', '2022-06-26 20:41:19', '2022-06-26 20:41:19'),
(3779, 'en', 1, 'download page', 'Child abuse', 'Child abuse', '2022-06-26 20:41:19', '2022-06-26 20:41:19'),
(3780, 'en', 1, 'download page', 'Other', 'Other', '2022-06-26 20:41:19', '2022-06-26 20:41:19'),
(3783, 'en', 1, 'download page', 'Details', 'Details', '2022-06-26 20:46:33', '2022-06-26 20:46:33'),
(3784, 'en', 1, 'download page', 'Describe the reason why you reported the file to a maximum of 600 characters', 'Describe the reason why you reported the file to a maximum of 600 characters', '2022-06-26 20:46:33', '2022-06-26 20:46:33'),
(3785, 'en', 1, 'download page', 'Send', 'Send', '2022-06-26 20:46:33', '2022-06-26 20:46:33'),
(3786, 'en', 1, 'download page', 'Invalid report reason', 'Invalid report reason', '2022-06-26 21:09:03', '2022-06-26 21:09:03'),
(3787, 'en', 1, 'download page', 'Your report has been sent successfully, we will review and take the necessary action', 'Your report has been sent successfully, we will review and take the necessary action', '2022-06-26 21:14:28', '2022-06-26 21:14:28'),
(3788, 'en', 1, 'download page', 'You have already reported this file', 'You have already reported this file', '2022-06-26 21:17:48', '2022-06-26 21:17:48'),
(3789, 'en', 1, 'general', 'Files with private access cannot be shared', 'Files with private access cannot be shared', '2022-06-28 15:24:43', '2022-06-28 15:24:43'),
(3790, 'en', 1, 'file manager', 'Preview', 'Preview', '2022-06-29 19:31:55', '2022-06-29 19:31:55'),
(3791, 'en', 1, 'file manager', 'Share', 'Share', '2022-06-29 19:32:40', '2022-06-29 19:32:40'),
(3792, 'en', 1, 'file manager', 'Download', 'Download', '2022-06-29 19:32:40', '2022-06-29 19:32:40'),
(3795, 'en', 1, 'file manager', 'File not found, missing or expired please refresh the page and try again', 'File not found, missing or expired please refresh the page and try again', '2022-06-29 20:23:31', '2022-06-29 20:23:31'),
(3796, 'en', 1, 'file manager', 'Files with private access cannot be shared, make sure the file access is public before trying to share it', 'Files with private access cannot be shared, make sure the file access is public before trying to share it', '2022-06-29 21:04:16', '2022-06-29 21:04:16'),
(3797, 'en', 1, 'file manager', 'Rename', 'Rename', '2022-06-29 23:42:00', '2022-06-29 23:42:00'),
(3799, 'en', 1, 'file manager', 'File Name', 'File Name', '2022-06-30 00:54:27', '2022-06-30 00:54:27'),
(3800, 'en', 1, 'file manager', 'File name required', 'File name required', '2022-06-30 01:07:39', '2022-06-30 01:07:39'),
(3801, 'en', 1, 'file manager', 'Renamed successfully', 'Renamed successfully', '2022-06-30 01:36:03', '2022-06-30 01:36:03'),
(3802, 'en', 1, 'file manager', 'Protection', 'Protection', '2022-06-30 16:04:52', '2022-06-30 16:04:52'),
(3803, 'en', 1, 'file manager', 'File Access', 'File Access', '2022-06-30 16:32:05', '2022-06-30 16:32:05'),
(3804, 'en', 1, 'file manager', 'Public', 'Public', '2022-06-30 16:32:05', '2022-06-30 16:32:05'),
(3805, 'en', 1, 'file manager', 'Private', 'Private', '2022-06-30 16:32:05', '2022-06-30 16:32:05'),
(3806, 'en', 1, 'file manager', 'File Password', 'File Password', '2022-06-30 16:32:05', '2022-06-30 16:32:05'),
(3807, 'en', 1, 'file manager', 'Enter password', 'Enter password', '2022-06-30 16:32:05', '2022-06-30 16:32:05'),
(3808, 'en', 1, 'file manager', 'Submit', 'Submit', '2022-06-30 16:32:05', '2022-06-30 16:32:05'),
(3809, 'en', 1, 'file manager', 'Leave the password field empty to cancel or remove it.', 'Leave the password field empty to cancel or remove it.', '2022-06-30 18:55:27', '2022-06-30 18:55:27'),
(3810, 'en', 1, 'file manager', 'Updated successfully', 'Updated successfully', '2022-07-01 01:14:01', '2022-07-01 01:14:01'),
(3811, 'en', 1, 'file manager', 'File protected by password', 'File protected by password', '2022-07-01 01:24:36', '2022-07-01 01:24:36'),
(3812, 'en', 1, 'file manager', 'Move to Trash', 'Move to Trash', '2022-07-01 16:58:34', '2022-07-01 16:58:34'),
(3813, 'en', 1, 'file manager', 'File moved to trash', 'File moved to trash', '2022-07-01 17:50:51', '2022-07-01 17:50:51'),
(3814, 'en', 2, 'subscription', 'Your subscription has been expired, Please renew it to continue using the service.', 'Your subscription has been expired, Please renew it to continue using the service.', '2022-07-02 00:11:13', '2022-07-06 16:27:16'),
(3815, 'en', 2, 'notifications', 'Your free subscription has been renewed', 'Your free subscription has been renewed', '2022-07-02 17:17:45', '2022-07-06 16:44:41'),
(3816, 'en', 2, 'notifications', 'Your subscription will expiry soon', 'Your subscription will expiry soon', '2022-07-02 18:34:56', '2022-07-06 16:44:41'),
(3817, 'en', 2, 'subscription', 'Your subscription is about expired, Renew it to avoid deleting your files.', 'Your subscription is about expired, Renew it to avoid deleting your files.', '2022-07-02 18:35:47', '2022-07-06 16:27:16'),
(3818, 'en', 2, 'notifications', 'Your subscription has been expired', 'Your subscription has been expired', '2022-07-02 19:06:16', '2022-07-06 16:44:41'),
(3819, 'en', 2, 'notifications', 'Your files will be deleted after {delete_interval}', 'Your files will be deleted after {delete_interval}', '2022-07-02 19:06:16', '2022-07-06 16:44:41'),
(3820, 'en', 1, 'file manager', 'You have not selected any file', 'You have not selected any file', '2022-07-04 20:23:24', '2022-07-04 20:23:24'),
(3823, 'en', 1, 'file manager', 'Files moved to trash', 'Files moved to trash', '2022-07-04 20:55:30', '2022-07-04 20:55:30'),
(3824, 'en', 1, 'file manager', 'Trash Folder', 'Trash Folder', '2022-07-04 22:20:43', '2022-07-04 22:20:43'),
(3825, 'en', 1, 'file manager', 'Empty Trash', 'Empty Trash', '2022-07-05 00:31:39', '2022-07-05 00:31:39'),
(3826, 'en', 1, 'file manager', 'Restore All', 'Restore All', '2022-07-05 00:31:39', '2022-07-05 00:31:39'),
(3827, 'en', 1, 'file manager', 'Restored successfully', 'Restored successfully', '2022-07-05 00:48:21', '2022-07-05 00:48:21'),
(3828, 'en', 1, 'file manager', 'Restore', 'Restore', '2022-07-05 01:10:32', '2022-07-05 01:10:32'),
(3829, 'en', 1, 'file manager', 'Delete Forever', 'Delete Forever', '2022-07-05 01:10:32', '2022-07-05 01:10:32'),
(3830, 'en', 1, 'file manager', 'Emptied successfully', 'Emptied successfully', '2022-07-05 02:02:20', '2022-07-05 02:02:20'),
(3831, 'en', 1, 'file manager', 'File belongs to a deleted folder it cannot be restored', 'File belongs to a deleted folder it cannot be restored', '2022-07-05 14:46:09', '2022-07-05 14:46:09'),
(3832, 'en', 1, 'file manager', 'No results for \"{search_word}\"', 'No results for \"{search_word}\"', '2022-07-06 20:20:09', '2022-07-06 20:20:09');

-- --------------------------------------------------------

--
-- Table structure for table `upload_settings`
--

CREATE TABLE `upload_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `storage_space` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `files_duration` bigint(20) DEFAULT NULL,
  `upload_at_once` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_protection` tinyint(1) NOT NULL COMMENT '0:No 1:Yes',
  `advertisements` tinyint(1) NOT NULL COMMENT '0:No 1:Yes',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `upload_settings`
--

INSERT INTO `upload_settings` (`id`, `name`, `symbol`, `icon`, `storage_space`, `file_size`, `files_duration`, `upload_at_once`, `password_protection`, `advertisements`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Guests Uploads', 'guests', 'images/settings/guests.png', NULL, NULL, NULL, '1', 0, 1, 0, '2022-07-05 19:32:16', '2022-07-07 16:27:15'),
(2, 'Users Uploads', 'users', 'images/settings/users.png', NULL, NULL, NULL, '100', 1, 1, 1, '2022-07-05 19:32:16', '2022-07-07 16:27:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `google2fa_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: Disabled, 1: Active',
  `google2fa_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0: Banned, 1: Active',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_has_viewed` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_logs`
--

CREATE TABLE `user_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `ip` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `timezone` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_notifications`
--

CREATE TABLE `user_notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 : Unread 1: Read',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `additionals`
--
ALTER TABLE `additionals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `addons`
--
ALTER TABLE `addons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_password_resets`
--
ALTER TABLE `admin_password_resets`
  ADD KEY `admin_password_resets_email_index` (`email`);

--
-- Indexes for table `advertisements`
--
ALTER TABLE `advertisements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_articles`
--
ALTER TABLE `blog_articles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blog_articles_slug_unique` (`slug`),
  ADD KEY `blog_articles_category_id_foreign` (`category_id`),
  ADD KEY `blog_articles_admin_id_foreign` (`admin_id`),
  ADD KEY `blog_articles_lang_foreign` (`lang`);

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blog_categories_slug_unique` (`slug`),
  ADD KEY `blog_categories_lang_foreign` (`lang`);

--
-- Indexes for table `blog_comments`
--
ALTER TABLE `blog_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_comments_user_id_foreign` (`user_id`),
  ADD KEY `blog_comments_article_id_foreign` (`article_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupons_code_unique` (`code`),
  ADD KEY `coupons_plan_id_foreign` (`plan_id`);

--
-- Indexes for table `extensions`
--
ALTER TABLE `extensions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `faqs_lang_foreign` (`lang`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `file_entries`
--
ALTER TABLE `file_entries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `file_entries_shared_id_unique` (`shared_id`),
  ADD KEY `file_entries_user_id_foreign` (`user_id`),
  ADD KEY `file_entries_storage_provider_id_foreign` (`storage_provider_id`);

--
-- Indexes for table `file_reports`
--
ALTER TABLE `file_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `file_reports_file_entry_id_foreign` (`file_entry_id`);

--
-- Indexes for table `footer_menu`
--
ALTER TABLE `footer_menu`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `footer_menu_name_unique` (`name`),
  ADD KEY `footer_menu_lang_foreign` (`lang`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `languages_code_unique` (`code`);

--
-- Indexes for table `mail_templates`
--
ALTER TABLE `mail_templates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mail_templates_lang_foreign` (`lang`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `navbar_menu`
--
ALTER TABLE `navbar_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `navbar_menu_lang_foreign` (`lang`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_page_slug_unique` (`slug`),
  ADD KEY `pages_lang_foreign` (`lang`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_gateways`
--
ALTER TABLE `payment_gateways`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seo_configurations`
--
ALTER TABLE `seo_configurations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `seo_configurations_lang_unique` (`lang`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slideshows`
--
ALTER TABLE `slideshows`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_providers`
--
ALTER TABLE `social_providers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `social_providers_user_id_foreign` (`user_id`);

--
-- Indexes for table `storage_providers`
--
ALTER TABLE `storage_providers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subscriptions_user_id_foreign` (`user_id`),
  ADD KEY `subscriptions_plan_id_foreign` (`plan_id`);

--
-- Indexes for table `taxes`
--
ALTER TABLE `taxes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `taxes_country_id_unique` (`country_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transactions_checkout_id_unique` (`checkout_id`),
  ADD UNIQUE KEY `transactions_transaction_id_unique` (`transaction_id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`),
  ADD KEY `transactions_plan_id_foreign` (`plan_id`),
  ADD KEY `transactions_coupon_id_foreign` (`coupon_id`),
  ADD KEY `transactions_payment_gateway_id_foreign` (`payment_gateway_id`);

--
-- Indexes for table `translates`
--
ALTER TABLE `translates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `translates_lang_foreign` (`lang`);

--
-- Indexes for table `upload_settings`
--
ALTER TABLE `upload_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_mobile_unique` (`mobile`);

--
-- Indexes for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_logs_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_notifications`
--
ALTER TABLE `user_notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_notifications_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `additionals`
--
ALTER TABLE `additionals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `addons`
--
ALTER TABLE `addons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `advertisements`
--
ALTER TABLE `advertisements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `blog_articles`
--
ALTER TABLE `blog_articles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_comments`
--
ALTER TABLE `blog_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=253;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `extensions`
--
ALTER TABLE `extensions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `file_entries`
--
ALTER TABLE `file_entries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `file_reports`
--
ALTER TABLE `file_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `footer_menu`
--
ALTER TABLE `footer_menu`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `mail_templates`
--
ALTER TABLE `mail_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=257;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `navbar_menu`
--
ALTER TABLE `navbar_menu`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_gateways`
--
ALTER TABLE `payment_gateways`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seo_configurations`
--
ALTER TABLE `seo_configurations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1025;

--
-- AUTO_INCREMENT for table `slideshows`
--
ALTER TABLE `slideshows`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `social_providers`
--
ALTER TABLE `social_providers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `storage_providers`
--
ALTER TABLE `storage_providers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `taxes`
--
ALTER TABLE `taxes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `translates`
--
ALTER TABLE `translates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3833;

--
-- AUTO_INCREMENT for table `upload_settings`
--
ALTER TABLE `upload_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_logs`
--
ALTER TABLE `user_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_notifications`
--
ALTER TABLE `user_notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog_articles`
--
ALTER TABLE `blog_articles`
  ADD CONSTRAINT `blog_articles_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `blog_articles_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `blog_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `blog_articles_lang_foreign` FOREIGN KEY (`lang`) REFERENCES `languages` (`code`) ON DELETE CASCADE;

--
-- Constraints for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD CONSTRAINT `blog_categories_lang_foreign` FOREIGN KEY (`lang`) REFERENCES `languages` (`code`) ON DELETE CASCADE;

--
-- Constraints for table `blog_comments`
--
ALTER TABLE `blog_comments`
  ADD CONSTRAINT `blog_comments_article_id_foreign` FOREIGN KEY (`article_id`) REFERENCES `blog_articles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `blog_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `coupons`
--
ALTER TABLE `coupons`
  ADD CONSTRAINT `coupons_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `faqs`
--
ALTER TABLE `faqs`
  ADD CONSTRAINT `faqs_lang_foreign` FOREIGN KEY (`lang`) REFERENCES `languages` (`code`) ON DELETE CASCADE;

--
-- Constraints for table `file_entries`
--
ALTER TABLE `file_entries`
  ADD CONSTRAINT `file_entries_storage_provider_id_foreign` FOREIGN KEY (`storage_provider_id`) REFERENCES `storage_providers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `file_entries_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `file_reports`
--
ALTER TABLE `file_reports`
  ADD CONSTRAINT `file_reports_file_entry_id_foreign` FOREIGN KEY (`file_entry_id`) REFERENCES `file_entries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `footer_menu`
--
ALTER TABLE `footer_menu`
  ADD CONSTRAINT `footer_menu_lang_foreign` FOREIGN KEY (`lang`) REFERENCES `languages` (`code`) ON DELETE CASCADE;

--
-- Constraints for table `mail_templates`
--
ALTER TABLE `mail_templates`
  ADD CONSTRAINT `mail_templates_lang_foreign` FOREIGN KEY (`lang`) REFERENCES `languages` (`code`) ON DELETE CASCADE;

--
-- Constraints for table `navbar_menu`
--
ALTER TABLE `navbar_menu`
  ADD CONSTRAINT `navbar_menu_lang_foreign` FOREIGN KEY (`lang`) REFERENCES `languages` (`code`) ON DELETE CASCADE;

--
-- Constraints for table `pages`
--
ALTER TABLE `pages`
  ADD CONSTRAINT `pages_lang_foreign` FOREIGN KEY (`lang`) REFERENCES `languages` (`code`) ON DELETE CASCADE;

--
-- Constraints for table `seo_configurations`
--
ALTER TABLE `seo_configurations`
  ADD CONSTRAINT `seo_configurations_lang_foreign` FOREIGN KEY (`lang`) REFERENCES `languages` (`code`) ON DELETE CASCADE;

--
-- Constraints for table `social_providers`
--
ALTER TABLE `social_providers`
  ADD CONSTRAINT `social_providers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `subscriptions_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `subscriptions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `taxes`
--
ALTER TABLE `taxes`
  ADD CONSTRAINT `taxes_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_payment_gateway_id_foreign` FOREIGN KEY (`payment_gateway_id`) REFERENCES `payment_gateways` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `translates`
--
ALTER TABLE `translates`
  ADD CONSTRAINT `translates_lang_foreign` FOREIGN KEY (`lang`) REFERENCES `languages` (`code`) ON DELETE CASCADE;

--
-- Constraints for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD CONSTRAINT `user_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_notifications`
--
ALTER TABLE `user_notifications`
  ADD CONSTRAINT `user_notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
