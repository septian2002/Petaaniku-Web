-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 02, 2024 at 12:36 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `petaniku`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_anggota` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id`, `nama_anggota`, `username`, `email`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 'kka', 'kakak', 'kakka', 'kakka', '2024-05-01 10:32:26', '2024-05-01 10:32:26'),
(2, 'lkanlkawD', 'ljsnjxsa', 'KJWJWd', 'lwndlknwd', '2024-05-01 10:41:54', '2024-05-01 10:41:54'),
(3, 'kka', 'E32211537', 'tritama96@gmail.com', 'k', '2024-05-01 10:54:40', '2024-05-01 10:54:40'),
(4, 'lkanlkawD', 'knn', 'mn@ee', 'klkkkk', '2024-05-01 11:15:24', '2024-05-02 03:29:00'),
(8, 'alnskndkad', 'adlkadnaknda', 'tritama9@gmail.com', 'yyaaa', '2024-05-02 03:29:27', '2024-05-02 03:29:27');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_member` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `is_checkout` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `id_member`, `id_barang`, `jumlah`, `total`, `is_checkout`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, 200, 0, '2024-05-01 20:43:10', '2024-05-01 20:43:10'),
(3, 1, 2, 3, 450, 0, '2024-05-01 23:43:50', '2024-05-01 23:43:50'),
(7, 2, 2, 5, 750, 1, '2024-05-02 00:49:28', '2024-05-02 01:36:56'),
(11, 2, 1, 3, 300, 0, '2024-05-02 01:46:09', '2024-05-02 01:46:09');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `nama_kategori`, `deskripsi`, `gambar`, `created_at`, `updated_at`) VALUES
(2, 'Pupuk', 'Seperti pupuk organik, pupuk anorganik, pupuk hayati, dan pupuk cair.', '17146404365.jpg', '2024-05-01 09:53:44', '2024-05-02 02:00:36'),
(3, 'Benih', 'Ini Deskripsi', '17145900003.jpg', '2024-05-01 11:16:26', '2024-05-01 12:00:14');

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
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_member` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `nama_member`, `no_hp`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'adhimas', '085230900943', 'tritama96@gmail.com', '$2y$10$4CF6/6iHaSmx8mJoLL26AudpDRe4KP6EFEIjuvU8OlFoH1nbgvOW6', '2024-05-01 09:23:17', '2024-05-01 09:23:17'),
(2, 'Adhimas', '1234', 'user2@gmail.com', '$2y$10$sRd083aZXYzlYiO4YXe91OY13bze81h0m1c3TYU6kK0X4tLucbz3K', '2024-05-02 00:21:22', '2024-05-02 00:21:22');

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_09_26_141851_create_categories_table', 1),
(6, '2023_09_30_052646_create_subcategories_table', 1),
(7, '2023_09_30_111316_create_sliders_table', 1),
(8, '2023_09_30_123852_create_products_table', 1),
(9, '2023_10_01_035808_create_members_table', 1),
(10, '2023_10_01_072113_create_testimonis_table', 1),
(11, '2023_10_01_133831_create_reviews_table', 1),
(12, '2023_10_02_033911_create_orders_table', 1),
(13, '2024_05_01_165913_create_anggota_table', 2),
(14, '2024_05_01_185052_add_harga_to_categories_table', 3),
(15, '2023_10_24_144913_create_carts_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_member` int(11) NOT NULL,
  `invoice` int(11) NOT NULL,
  `grand_total` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `id_member`, `invoice`, `grand_total`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 150000, 'Dikonfirmasi', '2024-05-27 00:32:31', '2024-05-01 17:37:30'),
(2, 2, 24050204, 15600, 'Dikonfirmasi', '2024-05-02 00:46:04', '2024-05-02 00:59:46'),
(3, 2, 24050207, 15600, 'Dikonfirmasi', '2024-05-02 00:46:07', '2024-05-02 00:59:50'),
(4, 2, 24050211, 15600, 'Baru', '2024-05-02 00:46:11', NULL),
(5, 2, 24050211, 15600, 'Baru', '2024-05-02 00:46:11', NULL),
(6, 2, 24050211, 15600, 'Baru', '2024-05-02 00:46:11', NULL),
(7, 2, 24050212, 15600, 'Baru', '2024-05-02 00:46:12', NULL),
(8, 2, 24050212, 15600, 'Baru', '2024-05-02 00:46:12', NULL),
(9, 2, 24050214, 15600, 'Baru', '2024-05-02 00:46:14', NULL),
(10, 2, 24050214, 15600, 'Baru', '2024-05-02 00:46:14', NULL),
(11, 2, 24050232, 16350, 'Baru', '2024-05-02 00:49:32', NULL),
(12, 2, 24050245, 750, 'Baru', '2024-05-02 00:49:45', NULL),
(13, 2, 24050254, 750, 'Baru', '2024-05-02 00:53:54', NULL),
(14, 2, 24050257, 750, 'Baru', '2024-05-02 00:53:57', NULL),
(15, 2, 24050257, 750, 'Selesai', '2024-05-02 00:53:57', '2024-05-02 01:10:27'),
(16, 2, 24050237, 45750, 'Baru', '2024-05-02 01:21:37', NULL),
(17, 2, 24050240, 45750, 'Baru', '2024-05-02 01:21:40', NULL),
(18, 2, 24050246, 90750, 'Baru', '2024-05-02 01:23:46', NULL),
(19, 2, 24050210, 135750, 'Baru', '2024-05-02 01:30:10', NULL),
(20, 2, 24050224, 135750, 'Baru', '2024-05-02 01:35:24', NULL),
(21, 2, 24050253, 135750, 'Baru', '2024-05-02 01:35:53', NULL),
(22, 2, 24050204, 135750, 'Baru', '2024-05-02 01:36:04', NULL),
(23, 2, 24050221, 750, 'Baru', '2024-05-02 01:36:21', NULL),
(24, 2, 24050256, 750, 'Baru', '2024-05-02 01:36:56', NULL),
(25, 2, 24050212, 300, 'Baru', '2024-05-02 01:46:12', NULL),
(26, 2, 24050215, 300, 'Baru', '2024-05-02 01:46:15', NULL),
(27, 2, 24050215, 300, 'Baru', '2024-05-02 01:46:15', NULL),
(28, 2, 24050259, 300, 'Baru', '2024-05-02 01:48:59', NULL),
(29, 2, 24050203, 300, 'Baru', '2024-05-02 01:49:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders_details`
--

CREATE TABLE `orders_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `id_kategori`, `nama_barang`, `gambar`, `deskripsi`, `harga`, `created_at`, `updated_at`) VALUES
(1, 2, 'Pupuk Bawang', '17146119796.jpg', 'Ini Deskripsi', 100, '2024-05-01 18:06:19', '2024-05-01 18:06:19'),
(2, 2, 'Pupuk Bawang', '17146121011.jpg', 'ini', 150, '2024-05-01 18:08:21', '2024-05-01 18:08:21'),
(3, 2, 'barang satu', '17146127806.jpg', 'ini', 15000, '2024-05-01 18:19:40', '2024-05-01 18:19:40'),
(4, 2, 'askl', '17146138906.jpg', 'kkk', 150, '2024-05-01 18:38:10', '2024-05-01 18:38:10'),
(5, 2, 'barang dua', '17146139685.jpg', 'kkk', 100, '2024-05-01 18:39:28', '2024-05-01 18:39:28'),
(6, 2, 'aaa', '17146148159.jpg', 'aaa', 100, '2024-05-01 18:53:35', '2024-05-01 18:53:35');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_member` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `review` text NOT NULL,
  `rating` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_slider` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `nama_slider`, `deskripsi`, `gambar`, `created_at`, `updated_at`) VALUES
(2, 'Toko Pertanian', 'Selamat Datang!', '17146399454.jpg', '2024-05-02 01:52:25', '2024-05-02 01:52:25');

-- --------------------------------------------------------

--
-- Table structure for table `testimonis`
--

CREATE TABLE `testimonis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_testimoni` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@admin.com', '2024-05-01 09:12:00', '$2y$10$23ObTEOFtaTFCOkF4uS0ZeHXMbEtjyKcf5kETFWN7t4K.DdzZLBai', NULL, '2024-05-01 09:12:00', '2024-05-01 09:12:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_details`
--
ALTER TABLE `orders_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonis`
--
ALTER TABLE `testimonis`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `orders_details`
--
ALTER TABLE `orders_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `testimonis`
--
ALTER TABLE `testimonis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
