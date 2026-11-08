-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2026 at 05:31 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lrvpharmacy5`
--

-- --------------------------------------------------------

--
-- Table structure for table `batches`
--

CREATE TABLE `batches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `total_due` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `phone`, `total_due`, `created_at`, `updated_at`) VALUES
(1, 'Rahman vi', '01717855678', 306.00, '2026-09-25 08:46:04', '2026-10-31 10:56:29'),
(2, 'Nasir vi ci', '01716388754', 0.00, '2026-10-19 05:23:04', '2026-10-31 05:30:32'),
(3, 'Sohel vi city', '01716567454', 0.00, '2026-10-21 16:32:56', '2026-10-21 16:32:56'),
(4, 'Kamal vi rupshi', '01765456342', 28.00, '2026-10-21 16:33:46', '2026-10-29 17:02:46'),
(5, 'Sahin Molla', '01865765698', 0.00, '2026-10-21 16:38:49', '2026-10-21 16:38:49'),
(6, 'Jahad Vi', '01912435676', 35.00, '2026-10-21 16:40:15', '2026-11-01 09:29:57'),
(7, 'Sahadat vi', '01923467655', 870.00, '2026-10-21 16:43:55', '2026-10-31 05:33:44'),
(8, 'kasem vi Buiya bari', '01675466354', 0.00, '2026-10-24 14:19:41', '2026-11-04 08:47:00'),
(9, 'Sohan vi jatrabari', '01716543233', 0.00, '2026-10-25 17:37:43', '2026-10-25 17:37:43'),
(10, 'Kamrul vi city', '01871234323', 175.00, '2026-10-25 17:44:03', '2026-11-01 15:04:29'),
(11, 'Raju vi molla bari', '01912332224', 0.00, '2026-10-25 17:44:28', '2026-10-25 17:44:28'),
(12, 'Nur hosen bagh bari', '01976234565', 0.00, '2026-10-26 05:04:30', '2026-10-31 05:34:58'),
(13, 'Hasan vi', '01764876536', 19.00, '2026-10-27 16:23:00', '2026-11-01 08:47:32'),
(14, 'Anowar Mizi Bari', '01715434553', 0.00, '2026-10-29 17:00:48', '2026-10-29 17:00:48'),
(15, 'Rahman vi', NULL, 0.00, '2026-10-29 17:12:55', '2026-10-29 17:12:55'),
(16, 'Razzak vi noyabari', '01876567654', 0.00, '2026-10-30 13:23:49', '2026-10-30 13:23:49'),
(17, 'Abul kasem sowdag', NULL, 11.00, '2026-10-30 13:24:37', '2026-11-01 08:49:09'),
(18, 'Ruma', '0187654653', 66.00, '2026-10-30 16:01:58', '2026-10-30 16:03:14');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `expense_category_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `expense_category_id`, `amount`, `comment`, `created_at`, `updated_at`) VALUES
(1, 2, 500.00, NULL, NULL, NULL),
(2, 2, 20.00, 'dokan', '2026-10-19 21:39:37', '2026-10-19 21:39:37'),
(3, 1, 5200.00, 'purchase', '2026-10-19 21:50:23', '2026-10-19 21:50:23'),
(4, 1, 5200.00, 'purchase', '2026-10-19 21:51:12', '2026-10-19 21:51:12'),
(5, 3, 320.00, NULL, '2026-10-19 21:58:22', '2026-10-19 21:58:22'),
(6, 1, 1590.00, 'Square', '2026-10-20 04:01:02', '2026-10-20 04:01:02'),
(7, 4, 5000.00, 'shop owner', '2026-10-20 04:03:52', '2026-10-20 04:03:52'),
(8, 1, 1000.00, 'Beximco', '2026-10-20 06:19:44', '2026-10-20 06:19:44'),
(9, 1, 5000.00, 'Square', '2026-10-30 06:21:20', '2026-10-30 06:21:20'),
(10, 5, 8000.00, 'Sofiq Oct-26 Salary', '2026-10-30 06:23:19', '2026-10-30 06:23:19'),
(11, 2, 50.00, NULL, '2026-10-30 06:23:37', '2026-10-30 06:23:37'),
(12, 2, 100.00, NULL, '2026-10-31 10:57:10', '2026-10-31 10:57:10');

-- --------------------------------------------------------

--
-- Table structure for table `expense_categories`
--

CREATE TABLE `expense_categories` (
  `id` bigint(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `comments` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expense_categories`
--

INSERT INTO `expense_categories` (`id`, `name`, `comments`) VALUES
(1, 'Medicine Purchase', ''),
(2, 'Breakfast', ''),
(3, 'Electric Bill', ''),
(4, 'Shop rent', ''),
(5, 'Employee Salary', ''),
(6, 'Others', '');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `medicines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `generic_name` varchar(255) DEFAULT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `purchase_price` decimal(10,2) DEFAULT NULL,
  `sell_price` decimal(10,2) DEFAULT NULL,
  `batch_no` varchar(25) DEFAULT NULL,
  `expiry` date NOT NULL DEFAULT '2020-01-01',
  `is_active` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 100,
  `stock_alert` int(10) NOT NULL DEFAULT 5
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`id`, `name`, `generic_name`, `brand`, `category`, `barcode`, `purchase_price`, `sell_price`, `batch_no`, `expiry`, `is_active`, `created_at`, `updated_at`, `stock`, `stock_alert`) VALUES
(1, 'Napa', 'Paracetamol', 'Beximco', 'Tablet', 'BD1001', 1.50, 2.00, 'null', '2027-11-15', 1, '2026-09-25 08:40:59', '2026-10-20 17:00:46', 40, 50),
(2, 'Ace 500mg', 'Paracetamol', 'Square', 'Tablet', 'BD1002', 1.40, 2.00, 'btc875', '2026-10-30', 1, '2026-09-25 08:40:59', '2026-11-04 15:15:21', 39, 20),
(3, 'Napa Extra', 'Paracetamol + Caffeine', 'Beximco', 'Tablet', 'BD1003', 2.00, 3.00, 'null', '2028-12-28', 1, '2026-09-25 08:40:59', '2026-10-29 17:26:36', 200, 5),
(4, 'Calpol', 'Paracetamol', 'GlaxoSmithKline', 'Syrup', 'BD1004', 42.00, 45.00, 'null', '2026-10-14', 1, '2026-09-25 08:40:59', '2026-10-17 03:45:21', 200, 5),
(5, 'Fastdol', 'Paracetamol', 'Incepta', 'Tablet', 'BD1005', 1.60, 2.20, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-10-30 13:14:21', 196, 5),
(6, 'Seclo 20mg', 'Omeprazole', 'Square', 'Capsule', 'BD1010', 4.00, 6.00, 'null', '2026-10-14', 1, '2026-09-25 08:40:59', '2026-10-19 06:58:52', 210, 5),
(7, 'Sergel', 'Esomeprazole', 'Healthcare', 'Capsule', 'BD1011', 5.50, 8.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-10-27 16:01:40', 190, 5),
(8, 'Nexum', 'Esomeprazole', 'Beximco', 'Capsule', 'BD1012', 6.00, 9.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(9, 'Pantonix', 'Pantoprazole', 'Square', 'Tablet', 'BD1013', 4.50, 6.50, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(10, 'Rabe 20mg', 'Rabeprazole', 'Aristopharma', 'Tablet', 'BD1014', 7.50, 8.50, '-', '2026-10-14', 1, '2026-09-25 08:40:59', '2026-11-01 15:27:40', 200, 5),
(11, 'Zimax', 'Azithromycin', 'Square', 'Tablet', 'BD1020', 25.00, 35.00, 'null', '2026-10-14', 1, '2026-09-25 08:40:59', '2026-11-01 15:04:29', 190, 5),
(12, 'Azithral', 'Azithromycin', 'IPCA', 'Tablet', 'BD1021', 24.00, 34.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-10-20 17:06:46', 199, 5),
(13, 'Ciprocin', 'Ciprofloxacin', 'Square', 'Tablet', 'BD1022', 3.50, 5.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(14, 'Flagyl', 'Metronidazole', 'Sanofi', 'Tablet', 'BD1023', 2.00, 3.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-10-30 08:40:05', 186, 5),
(15, 'Amoxiclav', 'Amoxicillin + Clavulanic Acid', 'Square', 'Tablet', 'BD1024', 18.00, 25.00, '-', '2030-01-29', 1, '2026-09-25 08:40:59', '2026-10-30 13:14:21', 197, 5),
(16, 'Alatrol', 'Loratadine', 'Square', 'Tablet', NULL, 1.50, 2.20, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-11-06 13:17:19', 106, 5),
(17, 'Fexo 120mg', 'Fexofenadine', 'Square', 'Tablet', 'BD1031', 3.00, 4.50, 'null', '2026-10-14', 1, '2026-09-25 08:40:59', '2026-10-20 17:04:59', 10, 20),
(18, 'Histacin', 'Antihistamine', 'Square', 'Tablet', 'BD1032', 1.80, 2.50, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(19, 'Ceevit', 'Vitamin C', 'Square', 'Tablet', 'BD1040', 1.20, 2.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(20, 'Becosules', 'Vitamin B Complex', 'Abbott', 'Capsule', 'BD1041', 5.00, 7.50, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-10-30 08:40:41', 189, 5),
(21, 'Zincovit', 'Zinc + Vitamins', 'IPCA', 'Tablet', 'BD1042', 3.00, 4.50, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(22, 'Calcium Sandoz', 'Calcium', 'Novartis', 'Tablet', 'BD1043', 3.50, 5.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(23, 'Napa Syrup', 'Paracetamol', 'Square', 'Syrup', 'BD1050', 35.00, 50.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-10-31 10:52:41', 198, 5),
(24, 'Ace Syrup', 'Paracetamol', 'Square', 'Syrup', 'BD1051', 32.00, 48.00, '-', '2026-10-14', 1, '2026-09-25 08:40:59', '2026-11-06 13:15:18', 6, 8),
(25, 'Cough Syrup', 'Ambroxol', 'Square', 'Syrup', 'BD1052', 45.00, 65.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(26, 'Glycomet', 'Metformin', 'USV', 'Tablet', 'BD1060', 2.50, 3.50, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(27, 'Insulin Actrapid', 'Insulin', 'Novo Nordisk', 'Injection', 'BD1061', 350.00, 500.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(28, 'Amlodipine', 'Amlodipine', 'Square', 'Tablet', 'BD2001', 2.50, 3.50, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-11-06 13:16:26', 187, 5),
(29, 'Angilock', 'Losartan', 'Square', 'Tablet', 'BD2002', 4.00, 6.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-10-30 13:14:21', 197, 5),
(30, 'Tenormin', 'Atenolol', 'AstraZeneca', 'Tablet', 'BD2003', 3.50, 5.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-10-27 16:01:40', 190, 5),
(31, 'Carvedilol', 'Carvedilol', 'Renata', 'Tablet', 'BD2004', 5.00, 7.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(32, 'Inderal', 'Propranolol', 'Square', 'Tablet', 'BD2005', 2.80, 4.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(33, 'Monas', 'Montelukast', 'Square', 'Tablet', 'BD3001', 6.00, 9.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(34, 'Montair', 'Montelukast', 'Sun Pharma', 'Tablet', 'BD3002', 6.50, 9.50, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(35, 'Telfast', 'Fexofenadine', 'Sanofi', 'Tablet', 'BD3003', 4.00, 6.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-10-30 13:14:21', 198, 5),
(36, 'Ventolin', 'Salbutamol', 'GSK', 'Inhaler', 'BD3004', 250.00, 350.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(37, 'Asthalin', 'Salbutamol', 'Cipla', 'Inhaler', 'BD3005', 220.00, 320.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-10-25 17:23:49', 196, 5),
(38, 'Ornidazole', 'Ornidazole', 'Square', 'Tablet', 'BD3010', 5.00, 7.50, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(39, 'Tinidazole', 'Tinidazole', 'Renata', 'Tablet', 'BD3011', 4.50, 6.50, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(40, 'Clindamycin', 'Clindamycin', 'Square', 'Capsule', 'BD3012', 12.00, 18.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(41, 'Doxycycline', 'Doxycycline', 'Incepta', 'Capsule', 'BD3013', 8.00, 12.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(42, 'Cefurox', 'Cefuroxime', 'GSK', 'Tablet', 'BD3014', 20.00, 30.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(43, 'Ketorolac', 'Ketorolac', 'Square', 'Injection', 'BD3020', 25.00, 40.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(44, 'Diclofenac Inj', 'Diclofenac', 'Novartis', 'Injection', 'BD3021', 20.00, 35.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-10-30 13:14:21', 198, 5),
(45, 'Tramadol', 'Tramadol', 'Square', 'Capsule', 'BD3022', 10.00, 15.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(46, 'Hepamerz', 'L-Ornithine L-Aspartate', 'Abbott', 'Syrup', 'BD3030', 120.00, 180.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(47, 'Ursocol', 'Ursodeoxycholic Acid', 'Sun Pharma', 'Tablet', 'BD3031', 15.00, 22.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(48, 'Domperidone', 'Domperidone', 'Square', 'Tablet', 'BD3032', 2.50, 3.50, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(49, 'Peditral', 'ORS Pediatric', 'Square', 'Sachet', 'BD3040', 6.00, 9.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(50, 'Zinc Baby', 'Zinc Sulphate', 'Renata', 'Tablet', 'BD3041', 2.00, 3.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-10-20 17:06:46', 199, 5),
(51, 'Calpol Baby', 'Paracetamol', 'GSK', 'Syrup', 'BD3042', 45.00, 65.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-10-20 17:06:46', 189, 5),
(52, 'Thyronorm', 'Levothyroxine', 'Abbott', 'Tablet', 'BD3050', 4.00, 6.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(53, 'Euthyrox', 'Levothyroxine', 'Merck', 'Tablet', 'BD3051', 4.50, 6.50, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(54, 'Prednisolone', 'Prednisolone', 'Square', 'Tablet', 'BD3052', 2.50, 3.50, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(55, 'Nexito', 'Escitalopram', 'Sun Pharma', 'Tablet', 'BD3060', 8.00, 12.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(56, 'Tryptanol', 'Amitriptyline', 'Square', 'Tablet', 'BD3061', 3.00, 5.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(57, 'Rivotril', 'Clonazepam', 'Roche', 'Tablet', 'BD3062', 10.00, 15.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(58, 'Fluconazole', 'Fluconazole', 'Square', 'Capsule', 'BD3070', 10.00, 15.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(59, 'Itraconazole', 'Itraconazole', 'Renata', 'Capsule', 'BD3071', 12.00, 18.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(60, 'Candid Cream', 'Clotrimazole', 'GSK', 'Cream', 'BD3072', 25.00, 40.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(61, 'Clopidogrel', 'Clopidogrel', 'Square', 'Tablet', 'BD3080', 12.00, 18.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(62, 'Ecosprin', 'Aspirin', 'USV', 'Tablet', 'BD3081', 3.00, 5.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(63, 'Anzitor 10mg', 'Atorvastatin', 'Square', 'Tablet', 'BD3082', 10.00, 12.00, '-', '2026-10-14', 1, '2026-09-25 08:40:59', '2026-10-26 05:56:26', 189, 5),
(64, 'Savlon', 'Antiseptic', 'ACI', 'Liquid', 'BD3090', 35.00, 55.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(65, 'Dettol', 'Chloroxylenol', 'Reckitt', 'Liquid', 'BD3091', 40.00, 60.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(66, 'Burnol', 'Antiseptic Cream', 'Square', 'Cream', 'BD3092', 25.00, 35.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(67, 'Vicks Vaporub', 'Menthol', 'P&G', 'Ointment', 'BD3093', 45.00, 65.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(68, 'ORS Salt', 'Oral Rehydration Salt', 'Square', 'Sachet', 'BD3094', 5.00, 7.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(69, 'Seretide', 'Salmeterol + Fluticasone', 'GSK', 'Inhaler', 'BD4001', 450.00, 650.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(70, 'Foracort', 'Budesonide + Formoterol', 'Cipla', 'Inhaler', 'BD4002', 400.00, 600.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(71, 'Budesonide Respules', 'Budesonide', 'Square', 'Nebulizer', 'BD4003', 300.00, 450.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(72, 'Salbutamol Neb', 'Salbutamol', 'Renata', 'Nebulizer', 'BD4004', 250.00, 380.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(73, 'Meronem', 'Meropenem', 'AstraZeneca', 'Injection', 'BD4010', 1200.00, 1800.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(74, 'Tazopen', 'Piperacillin + Tazobactam', 'Square', 'Injection', 'BD4011', 900.00, 1300.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-10-20 17:06:46', 199, 5),
(75, 'Vancomycin', 'Vancomycin', 'Healthcare', 'Injection', 'BD4012', 800.00, 1200.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(76, 'Imipenem', 'Imipenem', 'Beximco', 'Injection', 'BD4013', 1100.00, 1600.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(77, 'Tramadol SR', 'Tramadol', 'Square', 'Capsule', 'BD4020', 12.00, 18.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(78, 'Morphine', 'Morphine Sulfate', 'GSK', 'Injection', 'BD4021', 150.00, 220.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(79, 'Trajenta', 'Linagliptin', 'Boehringer', 'Tablet', 'BD4030', 45.00, 65.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(80, 'Galvus', 'Vildagliptin', 'Novartis', 'Tablet', 'BD4031', 40.00, 60.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(81, 'Januvia', 'Sitagliptin', 'Merck', 'Tablet', 'BD4032', 55.00, 80.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(82, 'Plavix', 'Clopidogrel', 'Sanofi', 'Tablet', 'BD4040', 14.00, 20.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(83, 'Rosuvastatin', 'Rosuvastatin', 'Square', 'Tablet', 'BD4041', 8.00, 12.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(84, 'Crestor', 'Rosuvastatin', 'AstraZeneca', 'Tablet', 'BD4042', 10.00, 15.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(85, 'Gabapentin', 'Gabapentin', 'Incepta', 'Capsule', 'BD4050', 8.00, 12.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-10-20 17:06:46', 199, 5),
(86, 'Pregabalin', 'Pregabalin', 'Square', 'Capsule', 'BD4051', 12.00, 18.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-10-20 17:06:46', 199, 5),
(87, 'Seroquel', 'Quetiapine', 'AstraZeneca', 'Tablet', 'BD4052', 18.00, 25.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(88, 'Esomeprazole IV', 'Esomeprazole', 'Healthcare', 'Injection', 'BD4060', 250.00, 350.00, NULL, '2026-10-14', 1, '2026-09-25 08:40:59', '2026-09-25 08:40:59', 200, 5),
(92, 'Tobramycin Eye Drop', 'Tobramycin', 'Alcon', 'Drops', 'BD4080', 90.00, 130.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(93, 'Ofloxacin Eye Drop', 'Ofloxacin', 'Square', 'Drops', 'BD4081', 70.00, 100.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-10-14 03:29:34', 205, 5),
(94, 'Econazole Cream', 'Econazole', 'Renata', 'Cream', 'BD4090', 30.00, 45.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(95, 'Ketoconazole Cream', 'Ketoconazole', 'Square', 'Cream', 'BD4091', 25.00, 40.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(96, 'Dydril', 'rone', 'null', 'Syrup', 'BD4100', 35.00, 50.00, '-', '2026-10-14', 1, '2026-09-25 08:41:00', '2026-11-01 15:10:49', 200, 5),
(97, 'Progesterone', 'Progesterone', 'Incepta', 'Capsule', 'BD4101', 30.00, 45.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(99, 'Atropine', 'Atropine Sulfate', 'Square', 'Injection', 'BD4111', 120.00, 180.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-10-30 13:14:21', 197, 5),
(100, 'Dopamine', 'Dopamine', 'Beximco', 'Injection', 'BD4112', 200.00, 300.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(101, 'Hydrogen Peroxide', 'Antiseptic', 'ACI', 'Liquid', 'BD4120', 25.00, 40.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(102, 'Spirit', 'Ethanol', 'Square', 'Liquid', 'BD4121', 30.00, 50.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(103, 'Cotton Roll', 'Medical Cotton', 'Local', 'Accessory', 'BD4122', 20.00, 30.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(104, 'Bandage', 'Medical Bandage', 'Local', 'Accessory', 'BD4123', 15.00, 25.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-10-30 13:14:21', 190, 5),
(105, 'Surgical Mask', 'Mask', 'Local', 'Accessory', 'BD4124', 5.00, 10.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(106, 'Napa Rapid', 'Paracetamol', 'Square', 'Tablet', 'BD3100', 2.00, 3.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(107, 'Ace Plus', 'Paracetamol + Caffeine', 'Square', 'Tablet', NULL, 2.50, 3.50, 'btc760', '2026-10-14', 1, '2026-09-25 08:41:00', '2026-11-06 13:16:40', 178, 20),
(108, 'Pamol', 'Paracetamol', 'Incepta', 'Tablet', 'BD3102', 1.80, 2.50, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(109, 'Tempra', 'Paracetamol', 'GSK', 'Syrup', 'BD3103', 45.00, 65.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(110, 'Clavam', 'Amoxicillin + Clavulanic Acid', 'Square', 'Tablet', 'BD3110', 22.00, 32.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(111, 'Cefix', 'Cefixime', 'Renata', 'Tablet', 'BD3111', 18.00, 26.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-10-30 13:14:21', 199, 5),
(112, 'Ceftum', 'Cefuroxime', 'GSK', 'Tablet', 'BD3112', 20.00, 30.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(113, 'Zithromax', 'Azithromycin', 'Pfizer', 'Tablet', 'BD3113', 28.00, 40.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(114, 'Oracef', 'Cefixime', 'Incepta', 'Capsule', 'BD3114', 16.00, 24.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(115, 'Esoral', 'Esomeprazole', 'Square', 'Capsule', 'BD3120', 6.00, 9.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(116, 'Omastin', 'Omeprazole', 'Incepta', 'Capsule', 'BD3121', 4.50, 6.50, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(117, 'Pantid', 'Pantoprazole', 'Opsonin', 'Tablet', 'BD3122', 4.00, 6.00, 'null', '2026-10-14', 1, '2026-09-25 08:41:00', '2026-10-17 06:41:27', 200, 5),
(118, 'Rabifast 20mg', 'Rabeprazole', 'Renata', 'Tablet', 'BD3123', 6.50, 9.50, '-', '2026-10-14', 1, '2026-09-25 08:41:00', '2026-11-01 15:28:39', 198, 5),
(119, 'Diabetrol', 'Gliclazide', 'Square', 'Tablet', 'BD3130', 3.50, 5.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(120, 'Metfo XR', 'Metformin XR', 'Beximco', 'Tablet', 'BD3131', 3.00, 4.50, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(121, 'Glucophage', 'Metformin', 'Merck', 'Tablet', 'BD3132', 2.80, 4.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(122, 'Amlovas', 'Amlodipine', 'Square', 'Tablet', 'BD3140', 2.50, 3.50, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-10-30 13:14:21', 198, 5),
(123, 'Losacard', 'Losartan', 'Incepta', 'Tablet', 'BD3141', 4.50, 6.50, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(124, 'Betaloc', 'Metoprolol', 'AstraZeneca', 'Tablet', 'BD3142', 5.00, 7.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(125, 'Norvasc', 'Amlodipine', 'Pfizer', 'Tablet', 'BD3143', 3.50, 5.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(126, 'Alledryl', 'Diphenhydramine', 'Square', 'Tablet', NULL, 2.00, 3.00, '-', '2026-10-14', 1, '2026-09-25 08:41:00', '2026-11-06 13:16:58', 129, 5),
(127, 'Histal', 'Antihistamine', 'Renata', 'Tablet', 'BD3151', 1.80, 2.50, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(128, 'Levocet', 'Levocetirizine', 'Square', 'Tablet', 'BD3152', 2.50, 3.50, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(129, 'Revital H', 'Multivitamin', 'Ranbaxy', 'Capsule', 'BD3160', 5.00, 7.50, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-10-20 17:06:46', 198, 5),
(130, 'Seven Seas', 'Cod Liver Oil', 'Merck', 'Capsule', 'BD3161', 6.00, 9.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(131, 'Osteocal', 'Calcium + D3', 'Square', 'Tablet', 'BD3162', 4.50, 6.50, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(132, 'Bricanyl', 'Terbutaline', 'AstraZeneca', 'Tablet', 'BD3170', 6.00, 9.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(133, 'Seretide', 'Fluticasone + Salmeterol', 'GSK', 'Inhaler', 'BD3171', 450.00, 650.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(134, 'Pulmoclear', 'Ambroxol', 'Incepta', 'Syrup', 'BD3172', 50.00, 70.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(135, 'Clobetasol Cream', 'Clobetasol', 'Square', 'Cream', 'BD3180', 30.00, 45.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(136, 'Candistatin', 'Clotrimazole', 'Renata', 'Cream', 'BD3181', 25.00, 30.00, 'null', '2026-10-14', 1, '2026-09-25 08:41:00', '2026-10-18 09:02:38', 200, 5),
(137, 'Fungicide', 'Ketoconazole', 'Incepta', 'Cream', 'BD3182', 28.00, 42.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(138, 'Oflox Eye Drop', 'Ofloxacin', 'Square', 'Drops', 'BD3190', 60.00, 85.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(139, 'TobraDex', 'Tobramycin + Dexamethasone', 'Alcon', 'Drops', 'BD3191', 95.00, 140.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(140, 'Arinac', 'Ibuprofen + Pseudoephedrine', 'Abbott', 'Tablet', 'BD3200', 3.50, 5.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-10-25 17:23:49', 198, 5),
(141, 'Zerodol', 'Aceclofenac', 'Ipca', 'Tablet', 'BD3201', 4.00, 6.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(142, 'Movex', 'Diclofenac', 'Square', 'Tablet', 'BD3202', 3.00, 4.50, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(144, 'Hydrocortisone Inj', 'Hydrocortisone', 'Square', 'Injection', 'BD3211', 50.00, 80.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-10-30 13:14:21', 199, 5),
(145, 'Pedialyte', 'ORS Solution', 'Abbott', 'Syrup', 'BD3220', 40.00, 60.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(146, 'Baby Zinc', 'Zinc Sulphate', 'Renata', 'Syrup', 'BD3221', 35.00, 55.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-10-20 17:06:46', 198, 5),
(147, 'Sedil', 'Diazepam', 'Square', 'Tablet', 'BD3230', 5.00, 7.50, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(148, 'Zoloft', 'Sertraline', 'Pfizer', 'Tablet', 'BD3231', 10.00, 15.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(149, 'Lexotanil', 'Bromazepam', 'Roche', 'Tablet', 'BD3232', 8.00, 12.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(150, 'Moxacil', 'Amoxicillin', 'Square', 'Capsule', 'BD3300', 5.00, 7.50, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(151, 'Ampiclox', 'Ampicillin + Cloxacillin', 'GSK', 'Capsule', 'BD3301', 6.00, 9.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-10-20 17:06:46', 198, 5),
(152, 'Cloxin', 'Cloxacillin', 'Square', 'Capsule', 'BD3302', 5.50, 8.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(153, 'Cefspan', 'Cefixime', 'Square', 'Tablet', 'BD3303', 18.00, 26.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-10-14 02:33:39', 198, 5),
(154, 'Novacef', 'Cefuroxime', 'Incepta', 'Tablet', 'BD3304', 20.00, 30.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(155, 'Fluclox', 'Flucloxacillin', 'Renata', 'Capsule', 'BD3310', 6.00, 9.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(156, 'Gripax', 'Paracetamol + Phenylephrine', 'Square', 'Tablet', 'BD3311', 3.50, 5.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(157, 'Coldex', 'Antihistamine Combo', 'Incepta', 'Tablet', 'BD3312', 3.00, 4.50, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(158, 'Sinarest', 'Paracetamol + Chlorpheniramine', 'Centaur', 'Tablet', 'BD3313', 4.00, 6.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(159, 'Zoton', 'Lansoprazole', 'General', 'Capsule', 'BD3320', 7.00, 10.00, '-', '2026-10-14', 1, '2026-09-25 08:41:00', '2026-11-04 08:46:23', 200, 5),
(160, 'Pariet', 'Rabeprazole', 'Janssen', 'Tablet', 'BD3321', 8.00, 12.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(161, 'Controloc', 'Pantoprazole', 'Takeda', 'Tablet', 'BD3322', 6.50, 9.50, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(162, 'Rosuvas', 'Rosuvastatin', 'Square', 'Tablet', 'BD3330', 10.00, 15.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(163, 'Lipitor', 'Atorvastatin', 'Pfizer', 'Tablet', 'BD3331', 12.00, 18.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(164, 'Cardace', 'Ramipril', 'Sanofi', 'Tablet', 'BD3332', 9.00, 13.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(165, 'Januvia', 'Sitagliptin', 'MSD', 'Tablet', 'BD3340', 35.00, 50.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(166, 'Galvus', 'Vildagliptin', 'Novartis', 'Tablet', 'BD3341', 30.00, 45.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(167, 'Forxiga', 'Dapagliflozin', 'AstraZeneca', 'Tablet', 'BD3342', 40.00, 60.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(168, 'Etoricox', 'Etoricoxib', 'Square', 'Tablet', 'BD3350', 6.00, 9.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(169, 'Celebrex', 'Celecoxib', 'Pfizer', 'Capsule', 'BD3351', 15.00, 22.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-10-30 13:14:21', 199, 5),
(170, 'Arcoxia', 'Etoricoxib', 'MSD', 'Tablet', 'BD3352', 12.00, 18.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-10-20 17:06:46', 199, 5),
(171, 'Multivita', 'Multivitamin', 'Square', 'Tablet', 'BD3360', 5.00, 7.50, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(172, 'Vitamin D3', 'Cholecalciferol', 'Incepta', 'Capsule', 'BD3361', 6.00, 9.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(173, 'OsteoCare', 'Calcium + D3', 'Square', 'Tablet', 'BD3362', 4.50, 6.50, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(175, 'Xalatan', 'Latanoprost', 'Pfizer', 'Drops', 'BD3371', 150.00, 220.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(176, 'Otomax', 'Ear Drop', 'Incepta', 'Drops', 'BD3372', 50.00, 75.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(177, 'Luliconazole', 'Antifungal', 'GSK', 'Cream', 'BD3380', 35.00, 55.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(178, 'Miconazole', 'Antifungal', 'Square', 'Cream', 'BD3381', 25.00, 40.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(179, 'Ketoconazole Shampoo', 'Antifungal Shampoo', 'Incepta', 'Shampoo', 'BD3382', 90.00, 140.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(180, 'Seroquel', 'Quetiapine', 'AstraZeneca', 'Tablet', 'BD3390', 18.00, 25.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(181, 'Cipralex', 'Escitalopram', 'Lundbeck', 'Tablet', 'BD3391', 12.00, 18.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(182, 'Alprazolam', 'Anxiolytic', 'Pfizer', 'Tablet', 'BD3392', 10.00, 15.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-11-06 13:17:49', 155, 5),
(183, 'Morphine', 'Morphine Sulphate', 'Hospital Use', 'Injection', 'BD3400', 120.00, 180.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(184, 'Dextrose', 'IV Fluid', 'Square', 'Injection', 'BD3401', 50.00, 80.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(185, 'Normal Saline', '0.9% NaCl', 'Beximco', 'IV Fluid', 'BD3402', 40.00, 70.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(186, 'ORS Plus', 'Electrolyte Solution', 'Square', 'Sachet', 'BD3410', 6.00, 9.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(187, 'Entacyd', 'Antacid', 'Square', 'Tablet', 'BD3411', 3.00, 5.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(188, 'Digene', 'Antacid', 'Abbott', 'Tablet', 'BD3412', 4.00, 6.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(189, 'Pudin Hara', 'Herbal Digestive', 'Hamdard', 'Liquid', 'BD3413', 35.00, 55.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-10-20 17:06:46', 198, 5),
(190, 'Eno', 'Antacid Powder', 'GSK', 'Powder', 'BD3414', 12.00, 18.00, NULL, '2026-10-14', 1, '2026-09-25 08:41:00', '2026-09-25 08:41:00', 200, 5),
(197, 'Zimax 50ml', 'Azithromycin', 'Square', 'Syrup', 'aziths', 130.00, 150.00, 'btnc', '2028-12-28', 1, '2026-10-16 08:56:26', '2026-10-30 13:14:21', 8, 2),
(198, 'Seclo 40mg', 'Omeprazole', 'Square', 'Capsule', 'sohfkas', 9.00, 10.00, 'jaskla', '2028-12-15', 1, '2026-10-17 02:43:36', '2026-10-19 06:58:28', 20, 5),
(199, 'Amilin 10mg', 'Amitriptyline', 'Opsonin', 'Tablet', NULL, 0.80, 1.00, 'null', '2026-10-31', 1, '2026-10-20 12:43:54', '2026-10-30 13:14:21', 79, 30),
(200, 'Amilin 25mg', 'Amitriptyline', 'Opsonin', 'Tablet', NULL, 1.35, 1.50, NULL, '2026-10-31', 1, '2026-10-20 12:47:18', '2026-10-30 13:14:21', 98, 30),
(201, 'Napadol', 'Paracetamol', 'Beximcom', 'Tablet', NULL, 7.00, 8.00, NULL, '2028-12-28', 1, '2026-10-24 14:20:55', '2026-10-24 14:20:55', 50, 20),
(202, 'Anadol', 'Paracetamol', 'Square', 'Tablet', NULL, 7.00, 8.00, '-', '2029-06-08', 1, '2026-10-24 14:49:43', '2026-10-30 13:14:21', 49, 20),
(203, 'Anadol Suppository', 'Paracetamol', 'Square', 'Suppository', NULL, 10.00, 12.00, '-', '2028-08-26', 1, '2026-10-24 14:51:21', '2026-10-30 13:14:21', 8, 2),
(204, 'Ovocal-D', 'Calcium', 'Beacon', 'Tablet', NULL, 14.00, 17.00, NULL, '2028-12-28', 1, '2026-10-24 15:10:44', '2026-10-24 15:10:44', 100, 20),
(205, 'Coralcal DX', 'Calcium', 'Radient', 'Tablet', NULL, 15.00, 17.00, NULL, '2026-10-30', 1, '2026-10-24 15:21:13', '2026-10-24 15:21:13', 50, 20),
(206, 'Finix 20mg', 'alfaa', 'Opsonin', 'Tablet', NULL, 6.00, 7.00, NULL, '2028-10-18', 1, '2026-10-30 15:54:51', '2026-10-30 15:57:59', 15, 20),
(207, 'Rupa 10mg', 'Rupatadine', 'Aristopharma', 'Tablet', NULL, 7.00, 8.00, NULL, '2028-10-12', 1, '2026-10-31 10:54:33', '2026-10-31 10:54:33', 50, 20),
(208, 'Alarid 1gm', 'Ketotifine', 'Square', 'Tablet', NULL, 1.30, 1.50, NULL, '2029-08-20', 1, '2026-11-01 08:44:17', '2026-11-01 08:48:20', 90, 20),
(209, 'Finix mups 20mg', 'Esomeprazole', 'Opsonin', 'Tablet', NULL, 7.00, 8.00, '-', '2029-09-12', 1, '2026-11-01 08:45:29', '2026-11-01 08:47:02', 46, 20),
(210, 'Omidon 10mg', 'Domperidone', 'Incepta', 'Tablet', NULL, 3.00, 3.50, NULL, '2028-12-28', 1, '2026-11-05 15:43:35', '2026-11-05 15:43:35', 100, 20),
(211, 'Omidon 60ml', 'Domperidone', 'Incepta', 'Syrup', NULL, 32.00, 35.00, NULL, '2028-11-29', 1, '2026-11-05 15:44:43', '2026-11-05 15:45:36', 11, 2),
(212, 'Dexlan 30mg', 'Dexlansoprazole', 'Ibn sina', 'Capsule', NULL, 9.00, 10.00, NULL, '2030-11-27', 1, '2026-11-06 05:51:46', '2026-11-06 05:51:46', 100, 20);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2026_04_25_130329_create_batches_table', 1),
(6, '2026_04_25_130329_create_sales_table', 1),
(7, '2026_04_25_130330_create_sale_items_table', 1),
(8, '2026_04_25_130331_create_customers_table', 1),
(9, '2026_04_25_130331_create_medicines_table', 1),
(10, '2026_04_25_152431_add_stock_to_medicines_table', 1),
(11, '2026_04_25_191057_add_fields_to_customers_table', 1),
(12, '2026_04_25_191409_add_customer_id_to_sales_table', 1),
(13, '2026_04_25_193731_create_payments_table', 1),
(14, '2026_04_25_194711_add_name_to_customers_table', 1),
(15, '2026_04_26_104500_add_customer_id_to_sales_table_fixed', 1),
(16, '2026_10_19_134523_create_expenses_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `customer_id`, `amount`, `note`, `created_at`, `updated_at`) VALUES
(1, 1, 20.00, NULL, '2026-09-25 08:47:34', '2026-09-25 08:47:34'),
(2, 1, 10.00, NULL, '2026-09-25 08:48:49', '2026-09-25 08:48:49'),
(3, 6, 10.00, NULL, '2026-10-25 17:41:08', '2026-10-25 17:41:08'),
(4, 6, 10.00, NULL, '2026-10-25 17:41:50', '2026-10-25 17:41:50'),
(5, 4, 200.00, NULL, '2026-10-27 16:16:23', '2026-10-27 16:16:23'),
(6, 4, 10.00, NULL, '2026-10-29 17:01:16', '2026-10-29 17:01:16'),
(7, 4, 30.00, '90', '2026-10-29 17:01:46', '2026-10-29 17:01:46'),
(8, 4, 5.00, NULL, '2026-10-29 17:02:13', '2026-10-29 17:02:13'),
(9, 4, 10.00, NULL, '2026-10-29 17:02:26', '2026-10-29 17:02:26'),
(10, 4, 5.00, NULL, '2026-10-29 17:02:31', '2026-10-29 17:02:31'),
(11, 4, 5.00, NULL, '2026-10-29 17:02:36', '2026-10-29 17:02:36'),
(12, 4, 7.00, NULL, '2026-10-29 17:02:46', '2026-10-29 17:02:46'),
(13, 1, 15.00, '52', '2026-10-29 17:13:49', '2026-10-29 17:13:49'),
(14, 1, 19.00, 'prev due 79', '2026-10-29 17:25:11', '2026-10-29 17:25:11'),
(15, 6, 10.00, NULL, '2026-10-29 17:25:37', '2026-10-29 17:25:37'),
(16, 18, 50.00, NULL, '2026-10-30 16:03:14', '2026-10-30 16:03:14'),
(17, 1, 200.00, NULL, '2026-10-31 10:56:29', '2026-10-31 10:56:29'),
(18, 13, 15.00, NULL, '2026-11-01 08:47:32', '2026-11-01 08:47:32'),
(19, 17, 4.00, NULL, '2026-11-01 08:49:09', '2026-11-01 08:49:09');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `total` decimal(10,2) NOT NULL,
  `paid` decimal(10,2) NOT NULL DEFAULT 0.00,
  `due` decimal(10,2) NOT NULL DEFAULT 0.00,
  `discount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `invoice_no` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `customer_id`, `total`, `paid`, `due`, `discount`, `invoice_no`, `created_at`, `updated_at`) VALUES
(1, NULL, 175.00, 175.00, 0.00, 0.00, 'INV-20260925-0001', '2026-09-25 08:43:53', '2026-09-25 08:43:53'),
(2, 1, 42.00, 0.00, 42.00, 0.00, 'INV-20260925-0002', '2026-09-25 08:47:08', '2026-09-25 08:47:08'),
(3, NULL, 57.00, 57.00, 0.00, 0.00, 'INV-20261013-0001', '2026-10-13 07:52:01', '2026-10-13 07:52:01'),
(4, NULL, 56.50, 56.50, 0.00, 0.00, 'INV-20261014-0001', '2026-10-14 02:33:39', '2026-10-14 02:33:39'),
(5, NULL, 660.00, 660.00, 0.00, 0.00, 'INV-20261014-0002', '2026-10-14 03:28:02', '2026-10-14 03:28:02'),
(6, NULL, 180.00, 180.00, 0.00, 0.00, 'INV-20261014-0003', '2026-10-14 03:31:49', '2026-10-14 03:31:49'),
(7, NULL, 220.00, 220.00, 0.00, 0.00, 'INV-20261016-0001', '2026-10-16 08:55:12', '2026-10-16 08:55:12'),
(8, NULL, 20.00, 20.00, 0.00, 0.00, 'INV-20261020-0001', '2026-10-20 04:16:07', '2026-10-20 04:16:07'),
(9, NULL, 50.20, 50.20, 0.00, 0.00, 'INV-20261020-0002', '2026-10-20 06:43:31', '2026-10-20 06:43:31'),
(10, NULL, 168.00, 168.00, 0.00, 0.00, 'INV-20261020-0003', '2026-10-20 06:44:40', '2026-10-20 06:44:40'),
(11, NULL, 2309.20, 2309.20, 0.00, 0.00, 'INV-20261020-0004', '2026-10-20 17:06:46', '2026-10-20 17:06:46'),
(12, NULL, 2.20, 2.20, 0.00, 0.00, 'INV-20261022-0001', '2026-10-22 06:19:22', '2026-10-22 06:19:22'),
(13, NULL, 63.00, 63.00, 0.00, 0.00, 'INV-20261022-0002', '2026-10-22 14:00:55', '2026-10-22 14:00:55'),
(14, NULL, 135.00, 135.00, 0.00, 0.00, 'INV-20261022-0003', '2026-10-22 14:10:21', '2026-10-22 14:10:21'),
(15, NULL, 130.00, 130.00, 0.00, 0.00, 'INV-20261022-0004', '2026-10-22 14:22:08', '2026-10-22 14:22:08'),
(16, NULL, 470.00, 470.00, 0.00, 0.00, 'INV-20261022-0005', '2026-10-22 14:27:00', '2026-10-22 14:27:00'),
(17, NULL, 300.00, 300.00, 0.00, 20.00, 'INV-20261022-0006', '2026-10-22 14:30:59', '2026-10-22 14:30:59'),
(18, NULL, 295.00, 295.00, 0.00, 30.00, 'INV-20261025-0001', '2026-10-25 17:23:49', '2026-10-25 17:23:49'),
(19, NULL, 10.00, 10.00, 0.00, 2.00, 'INV-20261025-0002', '2026-10-25 17:24:25', '2026-10-25 17:24:25'),
(20, 8, 11.00, 11.00, 0.00, 0.00, 'INV-20261025-0003', '2026-10-25 17:39:29', '2026-10-25 17:39:29'),
(21, 6, 30.00, 0.00, 30.00, 0.00, 'INV-20261025-0004', '2026-10-25 17:40:14', '2026-10-25 17:40:14'),
(22, NULL, 35.00, 35.00, 0.00, 0.70, 'INV-20261026-0001', '2026-10-26 04:08:20', '2026-10-26 04:08:20'),
(23, 4, 120.00, 0.00, 120.00, 0.00, 'INV-20261026-0002', '2026-10-26 05:56:26', '2026-10-26 05:56:26'),
(24, 4, 15.00, 0.00, 15.00, 0.00, 'INV-20261026-0003', '2026-10-26 05:58:54', '2026-10-26 05:58:54'),
(25, 4, 150.00, 0.00, 150.00, 0.00, 'INV-20261026-0004', '2026-10-26 05:59:57', '2026-10-26 05:59:57'),
(26, 1, 10.00, 0.00, 10.00, 0.00, 'INV-20261026-0005', '2026-10-26 06:00:51', '2026-10-26 06:00:51'),
(27, 4, 15.00, 0.00, 15.00, 0.00, 'INV-20261026-0006', '2026-10-26 06:06:27', '2026-10-26 06:06:27'),
(28, NULL, 25.00, 25.00, 0.00, 0.00, 'INV-20261026-0007', '2026-10-26 06:23:37', '2026-10-26 06:23:37'),
(29, 8, 150.00, 150.00, 0.00, 10.00, 'INV-20261027-0001', '2026-10-27 16:01:40', '2026-10-27 16:01:40'),
(30, 1, 30.00, 0.00, 30.00, 5.00, 'INV-20261029-0001', '2026-10-29 17:12:40', '2026-10-29 17:12:40'),
(31, 1, 42.00, 0.00, 42.00, 0.00, 'INV-20261029-0002', '2026-10-29 17:24:15', '2026-10-29 17:24:15'),
(32, 1, 138.00, 0.00, 138.00, 0.00, 'INV-20261030-0001', '2026-10-30 08:40:05', '2026-10-30 08:40:05'),
(33, 1, 88.00, 0.00, 88.00, 0.00, 'INV-20261030-0002', '2026-10-30 08:40:41', '2026-10-30 08:40:41'),
(34, NULL, 12.00, 12.00, 0.00, 0.00, 'INV-20261030-0003', '2026-10-30 12:46:54', '2026-10-30 12:46:54'),
(35, 13, 34.00, 0.00, 34.00, 0.00, 'INV-20261030-0004', '2026-10-30 12:58:25', '2026-10-30 12:58:25'),
(36, 7, 870.00, 0.00, 870.00, 3.50, 'INV-20261030-0005', '2026-10-30 13:14:21', '2026-10-30 13:14:21'),
(37, NULL, 260.00, 260.00, 0.00, 5.00, 'INV-20261030-0006', '2026-10-30 15:57:59', '2026-10-30 15:57:59'),
(38, 18, 116.00, 0.00, 116.00, 0.00, 'INV-20261030-0007', '2026-10-30 16:02:22', '2026-10-30 16:02:22'),
(39, 1, 220.00, 0.00, 220.00, 15.00, 'INV-20261031-0001', '2026-10-31 10:49:59', '2026-10-31 10:49:59'),
(40, NULL, 120.00, 120.00, 0.00, 2.00, 'INV-20261031-0002', '2026-10-31 10:52:41', '2026-10-31 10:52:41'),
(41, NULL, 110.00, 110.00, 0.00, 2.00, 'INV-20261101-0001', '2026-11-01 08:47:02', '2026-11-01 08:47:02'),
(42, 17, 15.00, 0.00, 15.00, 0.00, 'INV-20261101-0002', '2026-11-01 08:48:20', '2026-11-01 08:48:20'),
(43, 6, 35.00, 0.00, 35.00, 0.00, 'INV-20261101-0003', '2026-11-01 09:29:57', '2026-11-01 09:29:57'),
(44, 10, 175.00, 0.00, 175.00, 0.00, 'INV-20261101-0004', '2026-11-01 15:04:29', '2026-11-01 15:04:29'),
(45, NULL, 35.00, 35.00, 0.00, 0.00, 'INV-20261105-0001', '2026-11-05 15:45:36', '2026-11-05 15:45:36'),
(46, NULL, 96.00, 96.00, 0.00, 0.00, 'INV-20261106-0001', '2026-11-06 13:15:18', '2026-11-06 13:15:18'),
(47, NULL, 22.00, 22.00, 0.00, 0.00, 'INV-20261106-0002', '2026-11-06 13:15:49', '2026-11-06 13:15:49'),
(48, NULL, 30.00, 30.00, 0.00, 0.00, 'INV-20261106-0003', '2026-11-06 13:16:06', '2026-11-06 13:16:06'),
(49, NULL, 35.00, 35.00, 0.00, 0.00, 'INV-20261106-0004', '2026-11-06 13:16:26', '2026-11-06 13:16:26'),
(50, NULL, 35.00, 35.00, 0.00, 0.00, 'INV-20261106-0005', '2026-11-06 13:16:40', '2026-11-06 13:16:40'),
(51, NULL, 30.00, 30.00, 0.00, 0.00, 'INV-20261106-0006', '2026-11-06 13:16:58', '2026-11-06 13:16:58'),
(52, NULL, 22.00, 22.00, 0.00, 0.00, 'INV-20261106-0007', '2026-11-06 13:17:19', '2026-11-06 13:17:19'),
(53, NULL, 150.00, 150.00, 0.00, 0.00, 'INV-20261106-0008', '2026-11-06 13:17:33', '2026-11-06 13:17:33'),
(54, NULL, 150.00, 150.00, 0.00, 0.00, 'INV-20261106-0009', '2026-11-06 13:17:49', '2026-11-06 13:17:49');

-- --------------------------------------------------------

--
-- Table structure for table `sale_items`
--

CREATE TABLE `sale_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sale_id` bigint(20) UNSIGNED NOT NULL,
  `medicine_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale_items`
--

INSERT INTO `sale_items` (`id`, `sale_id`, `medicine_name`, `price`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 'Bandage', 25.00, 7, '2026-09-25 08:43:53', '2026-09-25 08:43:53'),
(2, 2, 'Ace', 2.00, 10, '2026-09-25 08:47:08', '2026-09-25 08:47:08'),
(3, 2, 'Alatrol', 2.20, 10, '2026-09-25 08:47:08', '2026-09-25 08:47:08'),
(4, 3, 'Ace Plus', 3.50, 10, '2026-10-13 07:52:01', '2026-10-13 07:52:01'),
(5, 3, 'Alatrol', 2.20, 10, '2026-10-13 07:52:01', '2026-10-13 07:52:01'),
(6, 4, 'test3', 1.50, 3, '2026-10-14 02:33:39', '2026-10-14 02:33:39'),
(7, 4, 'Cefspan', 26.00, 2, '2026-10-14 02:33:39', '2026-10-14 02:33:39'),
(8, 5, 'Ace', 2.00, 5, '2026-10-14 03:28:02', '2026-10-14 03:28:02'),
(9, 5, 'Calpol Baby', 65.00, 10, '2026-10-14 03:28:02', '2026-10-14 03:28:02'),
(10, 6, 'Syp Zimax 50ml', 180.00, 1, '2026-10-14 03:31:49', '2026-10-14 03:31:49'),
(11, 7, 'Adrenaline', 220.00, 1, '2026-10-16 08:55:12', '2026-10-16 08:55:12'),
(12, 8, 'Napa', 2.00, 10, '2026-10-20 04:16:07', '2026-10-20 04:16:07'),
(13, 9, 'Alatrol', 2.20, 1, '2026-10-20 06:43:31', '2026-10-20 06:43:31'),
(14, 9, 'Ace Syrup', 48.00, 1, '2026-10-20 06:43:31', '2026-10-20 06:43:31'),
(15, 10, 'Alcon Tears', 120.00, 1, '2026-10-20 06:44:40', '2026-10-20 06:44:40'),
(16, 10, 'Ace Syrup', 48.00, 1, '2026-10-20 06:44:40', '2026-10-20 06:44:40'),
(17, 11, 'Ace 500mg', 2.00, 1, '2026-10-20 17:06:46', '2026-10-20 17:06:46'),
(18, 11, 'Alatrol', 2.20, 1, '2026-10-20 17:06:46', '2026-10-20 17:06:46'),
(19, 11, 'Alcon Tears', 120.00, 1, '2026-10-20 17:06:46', '2026-10-20 17:06:46'),
(20, 11, 'Ace Syrup', 48.00, 1, '2026-10-20 17:06:46', '2026-10-20 17:06:46'),
(21, 11, 'Alledryl', 3.00, 1, '2026-10-20 17:06:46', '2026-10-20 17:06:46'),
(22, 11, 'Amilin 25mg', 1.50, 1, '2026-10-20 17:06:46', '2026-10-20 17:06:46'),
(23, 11, 'Amlodipine', 3.50, 1, '2026-10-20 17:06:46', '2026-10-20 17:06:46'),
(24, 11, 'Amlovas', 3.50, 1, '2026-10-20 17:06:46', '2026-10-20 17:06:46'),
(25, 11, 'Amoxiclav', 25.00, 1, '2026-10-20 17:06:46', '2026-10-20 17:06:46'),
(26, 11, 'Ampiclox', 9.00, 2, '2026-10-20 17:06:46', '2026-10-20 17:06:46'),
(27, 11, 'Angilock', 6.00, 1, '2026-10-20 17:06:46', '2026-10-20 17:06:46'),
(28, 11, 'Arcoxia', 18.00, 1, '2026-10-20 17:06:46', '2026-10-20 17:06:46'),
(29, 11, 'Arinac', 5.00, 1, '2026-10-20 17:06:46', '2026-10-20 17:06:46'),
(30, 11, 'Asthalin', 320.00, 1, '2026-10-20 17:06:46', '2026-10-20 17:06:46'),
(31, 11, 'Atorvastatin', 9.00, 1, '2026-10-20 17:06:46', '2026-10-20 17:06:46'),
(32, 11, 'Azithral', 34.00, 1, '2026-10-20 17:06:46', '2026-10-20 17:06:46'),
(33, 11, 'Baby Zinc', 55.00, 2, '2026-10-20 17:06:46', '2026-10-20 17:06:46'),
(34, 11, 'Bandage', 25.00, 2, '2026-10-20 17:06:46', '2026-10-20 17:06:46'),
(35, 11, 'Becosules', 7.50, 1, '2026-10-20 17:06:46', '2026-10-20 17:06:46'),
(36, 11, 'Calpol Baby', 65.00, 1, '2026-10-20 17:06:46', '2026-10-20 17:06:46'),
(37, 11, 'Gabapentin', 12.00, 1, '2026-10-20 17:06:46', '2026-10-20 17:06:46'),
(38, 11, 'Pregabalin', 18.00, 1, '2026-10-20 17:06:46', '2026-10-20 17:06:46'),
(39, 11, 'Pudin Hara', 55.00, 2, '2026-10-20 17:06:46', '2026-10-20 17:06:46'),
(40, 11, 'Revital H', 7.50, 2, '2026-10-20 17:06:46', '2026-10-20 17:06:46'),
(41, 11, 'Tazopen', 1300.00, 1, '2026-10-20 17:06:46', '2026-10-20 17:06:46'),
(42, 11, 'Zinc Baby', 3.00, 1, '2026-10-20 17:06:46', '2026-10-20 17:06:46'),
(43, 12, 'Alatrol', 2.20, 1, '2026-10-22 06:19:22', '2026-10-22 06:19:22'),
(44, 13, 'Ace Syrup', 48.00, 1, '2026-10-22 14:00:55', '2026-10-22 14:00:55'),
(45, 13, 'Alprazolam', 15.00, 1, '2026-10-22 14:00:55', '2026-10-22 14:00:55'),
(46, 14, 'Alcon Tears', 120.00, 1, '2026-10-22 14:10:21', '2026-10-22 14:10:21'),
(47, 14, 'Alprazolam', 15.00, 1, '2026-10-22 14:10:21', '2026-10-22 14:10:21'),
(48, 15, 'Alprazolam', 15.00, 1, '2026-10-22 14:22:08', '2026-10-22 14:22:08'),
(49, 15, 'Alcon Tears', 120.00, 1, '2026-10-22 14:22:08', '2026-10-22 14:22:08'),
(50, 16, 'Asthalin', 320.00, 1, '2026-10-22 14:27:00', '2026-10-22 14:27:00'),
(51, 16, 'Atropine', 180.00, 1, '2026-10-22 14:27:00', '2026-10-22 14:27:00'),
(52, 17, 'Asthalin', 320.00, 1, '2026-10-22 14:30:59', '2026-10-22 14:30:59'),
(53, 18, 'Arinac', 5.00, 1, '2026-10-25 17:23:49', '2026-10-25 17:23:49'),
(54, 18, 'Asthalin', 320.00, 1, '2026-10-25 17:23:49', '2026-10-25 17:23:49'),
(55, 19, 'Anadol Suppository', 12.00, 1, '2026-10-25 17:24:25', '2026-10-25 17:24:25'),
(56, 20, 'Alatrol', 2.20, 5, '2026-10-25 17:39:29', '2026-10-25 17:39:29'),
(57, 21, 'Alledryl', 3.00, 10, '2026-10-25 17:40:14', '2026-10-25 17:40:14'),
(58, 22, 'Alatrol', 2.20, 1, '2026-10-26 04:08:20', '2026-10-26 04:08:20'),
(59, 22, 'Ace Plus', 3.50, 1, '2026-10-26 04:08:20', '2026-10-26 04:08:20'),
(60, 22, 'Amilin 10mg', 1.00, 5, '2026-10-26 04:08:20', '2026-10-26 04:08:20'),
(61, 22, 'Alprazolam', 15.00, 1, '2026-10-26 04:08:20', '2026-10-26 04:08:20'),
(62, 22, 'Alledryl', 3.00, 1, '2026-10-26 04:08:20', '2026-10-26 04:08:20'),
(63, 22, 'Amlodipine', 3.50, 2, '2026-10-26 04:08:20', '2026-10-26 04:08:20'),
(64, 23, 'Anzitor 10mg', 12.00, 10, '2026-10-26 05:56:26', '2026-10-26 05:56:26'),
(65, 24, 'Alprazolam', 15.00, 1, '2026-10-26 05:58:54', '2026-10-26 05:58:54'),
(66, 25, 'Alprazolam', 15.00, 10, '2026-10-26 05:59:57', '2026-10-26 05:59:57'),
(67, 26, 'Amilin 10mg', 1.00, 10, '2026-10-26 06:00:51', '2026-10-26 06:00:51'),
(68, 27, 'Alprazolam', 15.00, 1, '2026-10-26 06:06:27', '2026-10-26 06:06:27'),
(69, 28, 'Amoxiclav', 25.00, 1, '2026-10-26 06:23:37', '2026-10-26 06:23:37'),
(70, 29, 'Alledryl', 3.00, 10, '2026-10-27 16:01:40', '2026-10-27 16:01:40'),
(71, 29, 'Tenormin', 5.00, 10, '2026-10-27 16:01:40', '2026-10-27 16:01:40'),
(72, 29, 'Sergel', 8.00, 10, '2026-10-27 16:01:40', '2026-10-27 16:01:40'),
(73, 30, 'Ace 500mg', 2.00, 10, '2026-10-29 17:12:40', '2026-10-29 17:12:40'),
(74, 30, 'Alledryl', 3.00, 5, '2026-10-29 17:12:40', '2026-10-29 17:12:40'),
(75, 31, 'Alatrol', 2.20, 10, '2026-10-29 17:24:15', '2026-10-29 17:24:15'),
(76, 31, 'Ace 500mg', 2.00, 10, '2026-10-29 17:24:15', '2026-10-29 17:24:15'),
(77, 32, 'Flagyl', 3.00, 14, '2026-10-30 08:40:05', '2026-10-30 08:40:05'),
(78, 32, 'Ace Syrup', 48.00, 2, '2026-10-30 08:40:05', '2026-10-30 08:40:05'),
(79, 33, 'Alatrol', 2.20, 6, '2026-10-30 08:40:41', '2026-10-30 08:40:41'),
(80, 33, 'Becosules', 7.50, 10, '2026-10-30 08:40:41', '2026-10-30 08:40:41'),
(81, 34, 'Alledryl', 3.00, 4, '2026-10-30 12:46:54', '2026-10-30 12:46:54'),
(82, 35, 'Alatrol', 2.20, 13, '2026-10-30 12:58:25', '2026-10-30 12:58:25'),
(83, 35, 'Amilin 10mg', 1.00, 5, '2026-10-30 12:58:25', '2026-10-30 12:58:25'),
(84, 36, 'Alatrol', 2.20, 1, '2026-10-30 13:14:21', '2026-10-30 13:14:21'),
(85, 36, 'Alprazolam', 15.00, 2, '2026-10-30 13:14:21', '2026-10-30 13:14:21'),
(86, 36, 'Ace 500mg', 2.00, 1, '2026-10-30 13:14:21', '2026-10-30 13:14:21'),
(87, 36, 'Amilin 25mg', 1.50, 1, '2026-10-30 13:14:21', '2026-10-30 13:14:21'),
(88, 36, 'Ace Plus', 3.50, 1, '2026-10-30 13:14:21', '2026-10-30 13:14:21'),
(89, 36, 'Amilin 10mg', 1.00, 1, '2026-10-30 13:14:21', '2026-10-30 13:14:21'),
(90, 36, 'Amlovas', 3.50, 1, '2026-10-30 13:14:21', '2026-10-30 13:14:21'),
(91, 36, 'Amoxiclav', 25.00, 1, '2026-10-30 13:14:21', '2026-10-30 13:14:21'),
(92, 36, 'Angilock', 6.00, 2, '2026-10-30 13:14:21', '2026-10-30 13:14:21'),
(93, 36, 'Anadol Suppository', 12.00, 1, '2026-10-30 13:14:21', '2026-10-30 13:14:21'),
(94, 36, 'Anadol', 8.00, 1, '2026-10-30 13:14:21', '2026-10-30 13:14:21'),
(95, 36, 'Zimax 50ml', 150.00, 1, '2026-10-30 13:14:21', '2026-10-30 13:14:21'),
(96, 36, 'Atropine', 180.00, 2, '2026-10-30 13:14:21', '2026-10-30 13:14:21'),
(97, 36, 'Cefix', 26.00, 1, '2026-10-30 13:14:21', '2026-10-30 13:14:21'),
(98, 36, 'Celebrex', 22.00, 1, '2026-10-30 13:14:21', '2026-10-30 13:14:21'),
(99, 36, 'Bandage', 25.00, 1, '2026-10-30 13:14:21', '2026-10-30 13:14:21'),
(100, 36, 'Fastdol', 2.20, 4, '2026-10-30 13:14:21', '2026-10-30 13:14:21'),
(101, 36, 'Telfast', 6.00, 2, '2026-10-30 13:14:21', '2026-10-30 13:14:21'),
(102, 36, 'Rabifast', 9.50, 2, '2026-10-30 13:14:21', '2026-10-30 13:14:21'),
(103, 36, 'Diclofenac Inj', 35.00, 2, '2026-10-30 13:14:21', '2026-10-30 13:14:21'),
(104, 36, 'Hydrocortisone Inj', 80.00, 1, '2026-10-30 13:14:21', '2026-10-30 13:14:21'),
(105, 37, 'Finix 20mg', 7.00, 35, '2026-10-30 15:57:59', '2026-10-30 15:57:59'),
(106, 37, 'Ace 500mg', 2.00, 10, '2026-10-30 15:57:59', '2026-10-30 15:57:59'),
(107, 38, 'Alatrol', 2.20, 5, '2026-10-30 16:02:22', '2026-10-30 16:02:22'),
(108, 38, 'Alprazolam', 15.00, 7, '2026-10-30 16:02:22', '2026-10-30 16:02:22'),
(109, 39, 'Alledryl', 3.00, 20, '2026-10-31 10:49:59', '2026-10-31 10:49:59'),
(110, 39, 'Zimax', 35.00, 5, '2026-10-31 10:49:59', '2026-10-31 10:49:59'),
(111, 40, 'Alatrol', 2.20, 10, '2026-10-31 10:52:41', '2026-10-31 10:52:41'),
(112, 40, 'Napa Syrup', 50.00, 2, '2026-10-31 10:52:41', '2026-10-31 10:52:41'),
(113, 41, 'Finix mups 20mg', 8.00, 14, '2026-11-01 08:47:02', '2026-11-01 08:47:02'),
(114, 42, 'Alarid 1gm', 1.50, 10, '2026-11-01 08:48:20', '2026-11-01 08:48:20'),
(115, 43, 'Ace Plus', 3.50, 10, '2026-11-01 09:29:57', '2026-11-01 09:29:57'),
(116, 44, 'Zimax', 35.00, 5, '2026-11-01 15:04:29', '2026-11-01 15:04:29'),
(117, 45, 'Omidon 60ml', 35.00, 1, '2026-11-05 15:45:36', '2026-11-05 15:45:36'),
(118, 46, 'Ace Syrup', 48.00, 2, '2026-11-06 13:15:18', '2026-11-06 13:15:18'),
(119, 47, 'Alatrol', 2.20, 10, '2026-11-06 13:15:49', '2026-11-06 13:15:49'),
(120, 48, 'Alledryl', 3.00, 10, '2026-11-06 13:16:06', '2026-11-06 13:16:06'),
(121, 49, 'Amlodipine', 3.50, 10, '2026-11-06 13:16:26', '2026-11-06 13:16:26'),
(122, 50, 'Ace Plus', 3.50, 10, '2026-11-06 13:16:40', '2026-11-06 13:16:40'),
(123, 51, 'Alledryl', 3.00, 10, '2026-11-06 13:16:58', '2026-11-06 13:16:58'),
(124, 52, 'Alatrol', 2.20, 10, '2026-11-06 13:17:19', '2026-11-06 13:17:19'),
(125, 53, 'Alprazolam', 15.00, 10, '2026-11-06 13:17:33', '2026-11-06 13:17:33'),
(126, 54, 'Alprazolam', 15.00, 10, '2026-11-06 13:17:49', '2026-11-06 13:17:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `batches`
--
ALTER TABLE `batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expenses_expense_category_id_foreign` (`expense_category_id`);

--
-- Indexes for table `expense_categories`
--
ALTER TABLE `expense_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `medicines_barcode_unique` (`barcode`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `sale_items`
--
ALTER TABLE `sale_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_items_sale_id_foreign` (`sale_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `batches`
--
ALTER TABLE `batches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `expense_categories`
--
ALTER TABLE `expense_categories`
  MODIFY `id` bigint(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=213;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `sale_items`
--
ALTER TABLE `sale_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_expense_category_id_foreign` FOREIGN KEY (`expense_category_id`) REFERENCES `expense_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `sale_items`
--
ALTER TABLE `sale_items`
  ADD CONSTRAINT `sale_items_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
