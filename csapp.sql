-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Jul 25, 2021 at 07:07 PM
-- Server version: 8.0.24
-- PHP Version: 8.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `csapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `status` int NOT NULL,
  `acct_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `acct_bal` double NOT NULL,
  `loan_bal` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `user_id`, `status`, `acct_number`, `acct_bal`, `loan_bal`, `created_at`, `updated_at`) VALUES
(1, 6, 1, '8133627619', 52000, 0, '2021-07-06 15:02:13', '2021-07-25 18:05:42'),
(3, 8, 1, '0212002930', 56000, 0, '2021-07-06 16:01:08', '2021-07-25 18:05:42'),
(6, 11, 1, '8142548510', 392000, 0, '2021-07-06 22:05:19', '2021-07-25 18:05:42');

-- --------------------------------------------------------

--
-- Table structure for table `deductions`
--

CREATE TABLE `deductions` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `account_id` int NOT NULL,
  `earns` int NOT NULL,
  `contribution` int NOT NULL,
  `unrecovered_loan` int NOT NULL,
  `month` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` varchar(22) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deductions`
--

INSERT INTO `deductions` (`id`, `user_id`, `account_id`, `earns`, `contribution`, `unrecovered_loan`, `month`, `year`, `total`, `created_at`, `updated_at`) VALUES
(7, 6, 1, 40000, 4000, 0, 'Dec', '2021', 4000, '2021-07-25 18:03:57', '2021-07-25 18:03:57'),
(8, 8, 3, 50000, 5000, 0, 'Dec', '2021', 5000, '2021-07-25 18:03:57', '2021-07-25 18:03:57'),
(9, 11, 6, 50000, 28000, 0, 'Dec', '2021', 28000, '2021-07-25 18:03:57', '2021-07-25 18:03:57');

-- --------------------------------------------------------

--
-- Table structure for table `dividends`
--

CREATE TABLE `dividends` (
  `id` bigint UNSIGNED NOT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `announced` datetime NOT NULL,
  `interim` int NOT NULL,
  `final_div` double NOT NULL,
  `total_div` double NOT NULL,
  `bonus` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `closure_date` datetime NOT NULL,
  `agm` date NOT NULL,
  `payment_d` date NOT NULL,
  `quali_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expenditures`
--

CREATE TABLE `expenditures` (
  `id` bigint UNSIGNED NOT NULL,
  `expense` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `month` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenditures`
--

INSERT INTO `expenditures` (`id`, `expense`, `description`, `amount`, `month`, `year`, `created_at`, `updated_at`) VALUES
(1, 'Diseal', 'JPL', 20000, '2021-05', 2022, '2021-07-24 01:48:50', '2021-07-24 01:48:50');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `financial_years`
--

CREATE TABLE `financial_years` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `begin_date` date NOT NULL,
  `close_date` date NOT NULL,
  `bf` double DEFAULT NULL,
  `bd` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `financial_years`
--

INSERT INTO `financial_years` (`id`, `name`, `description`, `status`, `begin_date`, `close_date`, `bf`, `bd`, `created_at`, `updated_at`) VALUES
(1, '2021', 'Excellent', 1, '2021-07-12', '2021-07-15', 20000, 0, '2021-07-23 13:02:48', '2021-07-23 13:02:48');

-- --------------------------------------------------------

--
-- Table structure for table `histories`
--

CREATE TABLE `histories` (
  `id` bigint UNSIGNED NOT NULL,
  `account_id` int NOT NULL,
  `amount` double NOT NULL,
  `acct_bal` double NOT NULL,
  `user_id` int NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `can_pay` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `histories`
--

INSERT INTO `histories` (`id`, `account_id`, `amount`, `acct_bal`, `user_id`, `status`, `can_pay`, `created_at`, `updated_at`) VALUES
(1, 1, 4000, 4000, 6, 'Credit', 10, '2021-07-07 04:23:16', '2021-07-07 04:23:16'),
(2, 3, 5000, 5000, 8, 'Credit', 10, '2021-07-07 04:23:16', '2021-07-07 04:23:16'),
(3, 6, 28000, 28000, 11, 'Credit', 56, '2021-07-07 04:23:16', '2021-07-07 04:23:16'),
(4, 1, 4000, 4000, 6, 'Credit', 10, '2021-07-07 04:23:27', '2021-07-07 04:23:27'),
(5, 3, 5000, 5000, 8, 'Credit', 10, '2021-07-07 04:23:28', '2021-07-07 04:23:28'),
(6, 6, 28000, 28000, 11, 'Credit', 56, '2021-07-07 04:23:28', '2021-07-07 04:23:28'),
(7, 1, 4000, 4000, 6, 'Credit', 10, '2021-07-07 04:23:35', '2021-07-07 04:23:35'),
(8, 3, 5000, 5000, 8, 'Credit', 10, '2021-07-07 04:23:35', '2021-07-07 04:23:35'),
(9, 6, 28000, 28000, 11, 'Credit', 56, '2021-07-07 04:23:35', '2021-07-07 04:23:35'),
(10, 1, 4000, 4000, 6, 'Credit', 10, '2021-07-07 04:23:47', '2021-07-07 04:23:47'),
(11, 3, 5000, 5000, 8, 'Credit', 10, '2021-07-07 04:23:47', '2021-07-07 04:23:47'),
(12, 6, 28000, 28000, 11, 'Credit', 56, '2021-07-07 04:23:47', '2021-07-07 04:23:47'),
(13, 6, 28000, 28000, 11, 'Credit', 56, '2021-07-07 04:24:18', '2021-07-07 04:24:18'),
(14, 6, 28000, 56000, 11, 'Credit', 56, '2021-07-07 08:23:47', '2021-07-07 08:23:47'),
(15, 3, 9000, -4000, 8, 'Debit', 10, '2021-07-07 08:24:38', '2021-07-07 08:24:38'),
(16, 1, 4000, 8000, 6, 'Credit', 10, '2021-07-07 08:24:47', '2021-07-07 08:24:47'),
(17, 3, 5000, 1000, 8, 'Credit', 10, '2021-07-07 08:24:47', '2021-07-07 08:24:47'),
(18, 6, 28000, 84000, 11, 'Credit', 56, '2021-07-07 08:24:47', '2021-07-07 08:24:47'),
(19, 1, 4000, 12000, 6, 'Credit', 10, '2021-07-07 08:24:50', '2021-07-07 08:24:50'),
(20, 3, 5000, 6000, 8, 'Credit', 10, '2021-07-07 08:24:50', '2021-07-07 08:24:50'),
(21, 6, 28000, 112000, 11, 'Credit', 56, '2021-07-07 08:24:50', '2021-07-07 08:24:50'),
(22, 1, 4000, 16000, 6, 'Credit', 10, '2021-07-07 08:24:51', '2021-07-07 08:24:51'),
(23, 3, 5000, 11000, 8, 'Credit', 10, '2021-07-07 08:24:51', '2021-07-07 08:24:51'),
(24, 6, 28000, 140000, 11, 'Credit', 56, '2021-07-07 08:24:51', '2021-07-07 08:24:51'),
(25, 1, 4000, 20000, 6, 'Credit', 10, '2021-07-07 08:24:51', '2021-07-07 08:24:51'),
(26, 3, 5000, 16000, 8, 'Credit', 10, '2021-07-07 08:24:51', '2021-07-07 08:24:51'),
(27, 6, 28000, 168000, 11, 'Credit', 56, '2021-07-07 08:24:51', '2021-07-07 08:24:51'),
(28, 1, 4000, 24000, 6, 'Credit', 10, '2021-07-07 08:24:52', '2021-07-07 08:24:52'),
(29, 3, 5000, 21000, 8, 'Credit', 10, '2021-07-07 08:24:52', '2021-07-07 08:24:52'),
(30, 6, 28000, 196000, 11, 'Credit', 56, '2021-07-07 08:24:52', '2021-07-07 08:24:52'),
(31, 1, 4000, 28000, 6, 'Credit', 10, '2021-07-07 08:24:52', '2021-07-07 08:24:52'),
(32, 3, 5000, 26000, 8, 'Credit', 10, '2021-07-07 08:24:52', '2021-07-07 08:24:52'),
(33, 6, 28000, 224000, 11, 'Credit', 56, '2021-07-07 08:24:52', '2021-07-07 08:24:52'),
(34, 1, 4000, 32000, 6, 'Credit', 10, '2021-07-07 08:24:52', '2021-07-07 08:24:52'),
(35, 3, 5000, 31000, 8, 'Credit', 10, '2021-07-07 08:24:52', '2021-07-07 08:24:52'),
(36, 6, 28000, 252000, 11, 'Credit', 56, '2021-07-07 08:24:52', '2021-07-07 08:24:52'),
(37, 1, 4000, 36000, 6, 'Credit', 10, '2021-07-07 08:24:53', '2021-07-07 08:24:53'),
(38, 3, 5000, 36000, 8, 'Credit', 10, '2021-07-07 08:24:53', '2021-07-07 08:24:53'),
(39, 6, 28000, 280000, 11, 'Credit', 56, '2021-07-07 08:24:53', '2021-07-07 08:24:53'),
(40, 1, 4000, 40000, 6, 'Credit', 10, '2021-07-07 08:24:53', '2021-07-07 08:24:53'),
(41, 3, 5000, 41000, 8, 'Credit', 10, '2021-07-07 08:24:53', '2021-07-07 08:24:53'),
(42, 6, 28000, 308000, 11, 'Credit', 56, '2021-07-07 08:24:53', '2021-07-07 08:24:53'),
(43, 1, 4000, 44000, 6, 'Credit', 10, '2021-07-07 08:24:54', '2021-07-07 08:24:54'),
(44, 3, 5000, 46000, 8, 'Credit', 10, '2021-07-07 08:24:54', '2021-07-07 08:24:54'),
(45, 6, 28000, 336000, 11, 'Credit', 56, '2021-07-07 08:24:54', '2021-07-07 08:24:54'),
(46, 1, 4000, 48000, 6, 'Credit', 10, '2021-07-22 17:25:33', '2021-07-22 17:25:33'),
(47, 3, 5000, 51000, 8, 'Credit', 10, '2021-07-22 17:25:33', '2021-07-22 17:25:33'),
(48, 6, 28000, 364000, 11, 'Credit', 56, '2021-07-22 17:25:33', '2021-07-22 17:25:33'),
(49, 1, 4000, 52000, 6, 'Credit', 10, '2021-07-25 18:05:42', '2021-07-25 18:05:42'),
(50, 3, 5000, 56000, 8, 'Credit', 10, '2021-07-25 18:05:42', '2021-07-25 18:05:42'),
(51, 6, 28000, 392000, 11, 'Credit', 56, '2021-07-25 18:05:42', '2021-07-25 18:05:42');

-- --------------------------------------------------------

--
-- Table structure for table `incomes`
--

CREATE TABLE `incomes` (
  `id` bigint UNSIGNED NOT NULL,
  `revenue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `month` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `incomes`
--

INSERT INTO `incomes` (`id`, `revenue`, `description`, `amount`, `month`, `year`, `created_at`, `updated_at`) VALUES
(1, 'Contibution', 'Deduction money from Workers', 10000, '2021-01', 2022, '2021-07-24 01:45:14', '2021-07-24 01:45:14'),
(2, 'Loan', 'Just Loan', 1000000, '2021-05', 2019, '2021-07-24 01:47:28', '2021-07-24 01:47:28');

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount_range` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `intrest` double NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`id`, `name`, `amount_range`, `duration`, `intrest`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Simple Plan', '1000 - 20000', '180', 1.2, 1, '2021-07-25 16:24:34', '2021-07-25 16:24:34');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_07_06_134311_create_accounts_table', 1),
(5, '2021_07_06_231123_create_histories_table', 2),
(6, '2021_07_07_055900_create_withdrawals_table', 3),
(7, '2021_07_07_060641_create_loans_table', 3),
(8, '2021_07_07_093717_create_products_table', 4),
(9, '2021_07_23_110330_create_financial_years_table', 5),
(10, '2021_07_24_013511_create_incomes_table', 6),
(11, '2021_07_24_013528_create_expenditures_table', 6),
(12, '2021_07_24_055719_create_dividends_table', 7),
(13, '2021_07_25_173427_create_deductions_table', 8);

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double(8,2) NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` double(8,2) DEFAULT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `can_pay` int DEFAULT NULL,
  `salary` bigint DEFAULT NULL,
  `isAdmin` int NOT NULL DEFAULT '2',
  `status` int DEFAULT NULL,
  `keep_track` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `avatar`, `email`, `phone`, `can_pay`, `salary`, `isAdmin`, `status`, `keep_track`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Demon Admin', NULL, 'demo@gmail.com', '09021805432', NULL, NULL, 1, NULL, NULL, '2021-07-06 14:12:12', '$2y$10$wgJPTw8x7CrmA8OshEcZj.9V0mTCeFQGjy2SQK6Ozs5TAD19TH7Li', 'lgh1dIr8gUTSRL3BXLod7nAZTmQyVXh9t52NV4sgAPGpx8jcaCvv6UIR3bqO', '2021-07-06 14:12:12', '2021-07-06 14:12:12'),
(6, 'Goodness Ugo', NULL, 'goody@gmail.com', '08133627619', 10, 40000, 2, 1, NULL, NULL, '$2y$10$mfXcPD8iGeZKxberyM5RPuhCeohmDWw3Ett3o8Bx7zsi64F6ZJw1.', NULL, '2021-07-06 15:02:13', '2021-07-21 09:47:29'),
(8, 'pa', NULL, 'pa@gmail.com', '90212002930', 10, 50000, 2, 1, NULL, NULL, '$2y$10$5uVW.T/xRHyMQ803MJLXQ.T3QZv8mGymor2D9sm90vSpd.v9qN/wq', NULL, '2021-07-06 16:01:08', '2021-07-06 16:01:08'),
(11, 'EMMANUELLA', NULL, 'ella@gmail.com', '08142548510', 56, 50000, 2, 1, 'DQPjZa3z', NULL, '$2y$10$tAlwrEAJKbBH8WaaEbYl6O3o8esHPyrEucQwaXZvvTt9rA3N7YVr.', 'OU3RMtCphcTWyZH8HJg1HigXn5X516g4zsRESwlxeoMRaEwxsUrTsLIStjPJ', '2021-07-06 22:05:19', '2021-07-07 03:57:37');

-- --------------------------------------------------------

--
-- Table structure for table `withdrawals`
--

CREATE TABLE `withdrawals` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `amount` int NOT NULL,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `withdrawals`
--

INSERT INTO `withdrawals` (`id`, `user_id`, `amount`, `reason`, `status`, `created_at`, `updated_at`) VALUES
(1, 11, 5000, 'I need money', 2, '2021-07-07 05:45:18', '2021-07-07 08:14:51'),
(2, 11, 9000, 'Reason...\r\nI just wan to spend', 1, '2021-07-07 05:46:18', '2021-07-07 08:13:39'),
(3, 11, 2000, 'Reason...', 4, '2021-07-07 05:47:23', '2021-07-07 08:12:00'),
(4, 11, 40000, 'I need money', 3, '2021-07-07 08:26:54', '2021-07-07 08:26:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deductions`
--
ALTER TABLE `deductions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dividends`
--
ALTER TABLE `dividends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenditures`
--
ALTER TABLE `expenditures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `financial_years`
--
ALTER TABLE `financial_years`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `histories`
--
ALTER TABLE `histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incomes`
--
ALTER TABLE `incomes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- Indexes for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `deductions`
--
ALTER TABLE `deductions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `dividends`
--
ALTER TABLE `dividends`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenditures`
--
ALTER TABLE `expenditures`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `financial_years`
--
ALTER TABLE `financial_years`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `histories`
--
ALTER TABLE `histories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `incomes`
--
ALTER TABLE `incomes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `withdrawals`
--
ALTER TABLE `withdrawals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
