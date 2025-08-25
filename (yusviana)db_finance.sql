-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 25, 2025 at 01:53 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_finance`
--

-- --------------------------------------------------------

--
-- Table structure for table `balance_beginning`
--

CREATE TABLE `balance_beginning` (
  `id` bigint UNSIGNED NOT NULL,
  `amount` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `balance_beginning`
--

INSERT INTO `balance_beginning` (`id`, `amount`, `created_at`, `updated_at`) VALUES
(1, 100400000, '2025-07-24 03:24:10', '2025-07-24 03:27:52');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_03_19_133037_create_payments_table', 1),
(5, '2025_03_19_184323_create_money_ins_table', 1),
(6, '2025_03_21_124515_create_money_outs_table', 1),
(7, '2025_05_08_094019_create_piutangs_table', 1),
(8, '2025_05_08_115237_create_utangs_table', 1),
(9, '2025_06_27_074420_create_balance_beginning_table', 1),
(10, '2025_07_19_041451_create_utang_installements_table', 1),
(11, '2025_07_22_222133_add_reminded_besok_to_utangs', 1),
(12, '2025_07_22_222208_add_reminded_besok_to_utang_installements', 1),
(13, '2025_07_23_112020_add_owner_phone_to_piutangs_table', 1),
(14, '2025_07_23_225559_add_wa_utang_to_utangs_table', 1),
(15, '2025_08_01_000000_create_piutang_installements_table', 1),
(16, '2025_08_02_000000_add_cicilan_fields_to_piutangs_table', 1),
(17, '2025_07_22_221608_add_reminded_besok_to_piutangs', 2),
(18, '2025_07_22_221621_add_reminded_besok_to_piutang_installements', 2);

-- --------------------------------------------------------

--
-- Table structure for table `money_ins`
--

CREATE TABLE `money_ins` (
  `trx_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `amount` int NOT NULL,
  `payment_method` int NOT NULL,
  `source` int NOT NULL,
  `proof` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ext_doc_ref` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_from` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_date` datetime NOT NULL,
  `note` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `money_ins`
--

INSERT INTO `money_ins` (`trx_id`, `category_id`, `amount`, `payment_method`, `source`, `proof`, `ext_doc_ref`, `payment_from`, `payment_date`, `note`, `created_at`, `updated_at`) VALUES
('IN-661003113', 2, 400000, 1, 0, '', NULL, NULL, '2025-07-24 00:00:00', NULL, '2025-07-24 03:27:52', '2025-07-24 03:27:52');

-- --------------------------------------------------------

--
-- Table structure for table `money_outs`
--

CREATE TABLE `money_outs` (
  `trx_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `amount` int NOT NULL,
  `payment_method` int NOT NULL,
  `proof` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ext_doc_ref` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_to` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_date` datetime NOT NULL,
  `note` longtext COLLATE utf8mb4_unicode_ci,
  `tax` decimal(5,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `user_id`, `name`, `type`, `created_at`, `updated_at`) VALUES
(1, 1, 'PDAM', 1, '2025-07-24 03:24:11', '2025-07-24 03:24:11'),
(2, 1, 'PIUTANG', 0, '2025-07-24 03:24:11', '2025-07-24 03:24:11');

-- --------------------------------------------------------

--
-- Table structure for table `piutangs`
--

CREATE TABLE `piutangs` (
  `collection_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `moneyin_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ext_doc_ref` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_from` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `owner_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `due_date` datetime NOT NULL,
  `is_paid` tinyint(1) NOT NULL DEFAULT '0',
  `reminded_besok` tinyint NOT NULL DEFAULT '0',
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'full',
  `installment_count` int DEFAULT NULL,
  `note` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `piutangs`
--

INSERT INTO `piutangs` (`collection_id`, `moneyin_id`, `amount`, `ext_doc_ref`, `payment_from`, `owner_phone`, `due_date`, `is_paid`, `reminded_besok`, `type`, `installment_count`, `note`, `created_at`, `updated_at`) VALUES
('COLL-354034514', 'IN-661003113', '400000', NULL, NULL, '082119072382', '2025-07-25 00:00:00', 0, 1, 'full', NULL, NULL, '2025-07-24 03:27:52', '2025-07-24 03:31:04');

-- --------------------------------------------------------

--
-- Table structure for table `piutang_installements`
--

CREATE TABLE `piutang_installements` (
  `id` bigint UNSIGNED NOT NULL,
  `piutang_collection_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `due_date` date NOT NULL,
  `is_paid` tinyint(1) NOT NULL DEFAULT '0',
  `reminded_besok` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('57aoXzULVxRINMiSVvPopVQHJozyALG0sWwMFdec', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiRDJEbVpNaVYxUm1yazBabkhhd2tQRFNReXhTTkZxRERUTUZGd2hiWSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL21vbmV5LW91dCI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMwOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvbW9uZXktaW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjE4OiJmbGFzaGVyOjplbnZlbG9wZXMiO2E6MDp7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1753328062);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `role`, `no_phone`, `photo`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'CFO Tekmt', 'cfo@gmail.com', NULL, 'cfo', '0895402319384', NULL, '$2y$12$7t6d101YBEVBtqgPgsurV.aN2cG0BBJ60pycG6L7cHVqSnEUoOyf6', NULL, '2025-07-24 03:24:11', '2025-07-24 03:26:57'),
(2, 'CEO Tekmt', 'ceo@gmail.com', NULL, 'ceo', NULL, NULL, '$2y$12$ix3KGd.G0lK7oJhWNGNUk.Z9Q8FIEaGVjyvyHD5nO8iTRdC8Tm9zW', NULL, '2025-07-24 03:24:11', '2025-07-24 03:24:11');

-- --------------------------------------------------------

--
-- Table structure for table `utangs`
--

CREATE TABLE `utangs` (
  `trx_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `moneyout_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ext_doc_ref` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_from` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `due_date` datetime NOT NULL,
  `is_paid` tinyint(1) NOT NULL DEFAULT '0',
  `note` longtext COLLATE utf8mb4_unicode_ci,
  `wa_utang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'full',
  `installment_count` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `utang_installements`
--

CREATE TABLE `utang_installements` (
  `id` bigint UNSIGNED NOT NULL,
  `utang_trx_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `due_date` date NOT NULL,
  `is_paid` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `balance_beginning`
--
ALTER TABLE `balance_beginning`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `money_ins`
--
ALTER TABLE `money_ins`
  ADD PRIMARY KEY (`trx_id`),
  ADD KEY `money_ins_category_id_foreign` (`category_id`);

--
-- Indexes for table `money_outs`
--
ALTER TABLE `money_outs`
  ADD PRIMARY KEY (`trx_id`),
  ADD KEY `money_outs_category_id_foreign` (`category_id`);

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
  ADD UNIQUE KEY `payments_name_unique` (`name`),
  ADD KEY `payments_user_id_foreign` (`user_id`);

--
-- Indexes for table `piutangs`
--
ALTER TABLE `piutangs`
  ADD PRIMARY KEY (`collection_id`),
  ADD KEY `piutangs_moneyin_id_foreign` (`moneyin_id`);

--
-- Indexes for table `piutang_installements`
--
ALTER TABLE `piutang_installements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `piutang_installements_piutang_collection_id_foreign` (`piutang_collection_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `utangs`
--
ALTER TABLE `utangs`
  ADD PRIMARY KEY (`trx_id`),
  ADD KEY `utangs_moneyout_id_foreign` (`moneyout_id`);

--
-- Indexes for table `utang_installements`
--
ALTER TABLE `utang_installements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utang_installements_utang_trx_id_foreign` (`utang_trx_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `balance_beginning`
--
ALTER TABLE `balance_beginning`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `piutang_installements`
--
ALTER TABLE `piutang_installements`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `utang_installements`
--
ALTER TABLE `utang_installements`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `money_ins`
--
ALTER TABLE `money_ins`
  ADD CONSTRAINT `money_ins_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `payments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `money_outs`
--
ALTER TABLE `money_outs`
  ADD CONSTRAINT `money_outs_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `payments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `piutangs`
--
ALTER TABLE `piutangs`
  ADD CONSTRAINT `piutangs_moneyin_id_foreign` FOREIGN KEY (`moneyin_id`) REFERENCES `money_ins` (`trx_id`) ON DELETE CASCADE;

--
-- Constraints for table `piutang_installements`
--
ALTER TABLE `piutang_installements`
  ADD CONSTRAINT `piutang_installements_piutang_collection_id_foreign` FOREIGN KEY (`piutang_collection_id`) REFERENCES `piutangs` (`collection_id`) ON DELETE CASCADE;

--
-- Constraints for table `utangs`
--
ALTER TABLE `utangs`
  ADD CONSTRAINT `utangs_moneyout_id_foreign` FOREIGN KEY (`moneyout_id`) REFERENCES `money_outs` (`trx_id`) ON DELETE CASCADE;

--
-- Constraints for table `utang_installements`
--
ALTER TABLE `utang_installements`
  ADD CONSTRAINT `utang_installements_utang_trx_id_foreign` FOREIGN KEY (`utang_trx_id`) REFERENCES `utangs` (`trx_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
