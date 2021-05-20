-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Bulan Mei 2021 pada 11.53
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_simlantib_pku`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_03_28_075716_create_permission_tables', 1),
(5, '2021_05_18_112637_create_pelanggarans_table', 1),
(6, '2021_05_18_200338_create_perdas_table', 2),
(7, '2021_05_18_203340_create_perda_pelanggarans_table', 3),
(8, '2021_05_18_203452_create_perda_sangsis_table', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 4),
(3, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggarans`
--

CREATE TABLE `pelanggarans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_ktp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ttl` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jns_kelamin` enum('lk','pr') COLLATE utf8mb4_unicode_ci NOT NULL,
  `agama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pekerjaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_perda` bigint(20) NOT NULL,
  `pelanggaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sangsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ktp_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `id_petugas` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pelanggarans`
--

INSERT INTO `pelanggarans` (`id`, `no_ktp`, `nama`, `ttl`, `jns_kelamin`, `agama`, `pekerjaan`, `alamat`, `nomor_hp`, `nama_perda`, `pelanggaran`, `sangsi`, `lokasi`, `keterangan`, `ktp_path`, `status`, `id_petugas`, `created_at`, `updated_at`) VALUES
(7, '12345', 'asd', 'dsad-06/May/2021', 'pr', 'Hindu', 'asd', 'Jl. Merpati Sakti Gg Cendrawasih C3\r\nJl. Desa Belakang Sidomulyo, kec. lirik Inhu', '082385786314', 15, 'apa', 'asdsadsadsd', 'sda', 'sd', 'uploads/1621499749_1.jpeg', 1, 4, '2021-05-20 08:35:49', '2021-05-20 08:40:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `perdas`
--

CREATE TABLE `perdas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nomor_perda` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_perda` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pelanggaran` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `jenis_sangsi` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `perdas`
--

INSERT INTO `perdas` (`id`, `nomor_perda`, `nama_perda`, `pelanggaran`, `jenis_sangsi`, `created_at`, `updated_at`, `deleted_at`) VALUES
(11, '2020', 'sangsi', 'a:0:{}', 'a:0:{}', '2021-05-18 13:42:35', '2021-05-19 02:39:46', '2021-05-19 02:39:46'),
(14, 'asd', 'sdsd', 'a:0:{}', 'a:0:{}', '2021-05-19 02:34:50', '2021-05-19 02:39:49', '2021-05-19 02:39:49'),
(15, '2 tahun 2020', 'prokess', 'a:2:{i:1;i:15;i:2;i:16;}', 'a:2:{i:0;i:1;i:2;i:3;}', '2021-05-19 02:40:04', '2021-05-19 03:23:06', NULL),
(16, 'ads', 'dsdsd', 'a:0:{}', 'a:0:{}', '2021-05-19 03:44:21', '2021-05-19 04:06:17', '2021-05-19 04:06:17'),
(17, '2 tahun 2020', 'peo', 'a:2:{i:1;i:15;i:2;i:16;}', 'a:2:{i:0;i:1;i:2;i:3;}', '2021-05-19 02:40:04', '2021-05-19 03:23:06', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `perda_pelanggarans`
--

CREATE TABLE `perda_pelanggarans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `perda_pelanggarans`
--

INSERT INTO `perda_pelanggarans` (`id`, `nama`, `created_at`, `updated_at`, `deleted_at`) VALUES
(8, 'asd', '2021-05-19 01:51:40', '2021-05-19 02:33:22', '2021-05-19 02:33:22'),
(9, 'asaasasasad', '2021-05-19 01:52:01', '2021-05-19 02:33:07', '2021-05-19 02:33:07'),
(10, 'asdsdsd', '2021-05-19 01:52:10', '2021-05-19 02:33:25', '2021-05-19 02:33:25'),
(11, 'aa', '2021-05-19 02:41:25', '2021-05-19 02:41:40', '2021-05-19 02:41:40'),
(12, '202020', '2021-05-19 02:41:30', '2021-05-19 03:05:24', '2021-05-19 03:05:24'),
(13, 'cccc', '2021-05-19 02:41:35', '2021-05-19 03:05:26', '2021-05-19 03:05:26'),
(14, 'oke1', '2021-05-19 03:05:31', '2021-05-19 03:10:48', '2021-05-19 03:10:48'),
(15, 'oke', '2021-05-19 03:10:29', '2021-05-19 03:10:29', NULL),
(16, 'apa', '2021-05-19 03:10:35', '2021-05-19 03:10:35', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `perda_sangsis`
--

CREATE TABLE `perda_sangsis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `perda_sangsis`
--

INSERT INTO `perda_sangsis` (`id`, `nama`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'asdsadsadsd', '2021-05-19 03:05:36', '2021-05-19 03:05:36', NULL),
(2, 'as', '2021-05-19 03:10:55', '2021-05-19 03:11:28', '2021-05-19 03:11:28'),
(3, 'sssasa', '2021-05-19 03:11:19', '2021-05-19 03:11:24', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2021-05-18 05:06:12', '2021-05-18 05:06:12'),
(2, 'petugas', 'web', '2021-05-18 05:06:12', '2021-05-18 05:06:12'),
(3, 'pimpinan', 'web', '2021-05-18 05:06:12', '2021-05-18 05:06:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe_user` enum('admin','pimpinan','petugas') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `nama`, `password`, `nomor_hp`, `tipe_user`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', 'Admin', '$2y$10$vh57OO9gEh5VOLuricCWXe.MzOxbxjpk5FHCmw8eodbSxnd42chza', '-', 'admin', NULL, '2021-05-18 05:06:12', '2021-05-18 05:06:12', NULL),
(2, 'yusuf', 'yusuf', '$2y$10$9z9DLsV0GepwLCWtTwvr4e94tCqdPx/ZfP2SZzQqb6CJSATShNkUa', '082385786314', 'pimpinan', NULL, '2021-05-18 05:06:35', '2021-05-18 05:06:39', '2021-05-18 05:06:39'),
(3, 'yusuf', 'yusuf dwi putra', '$2y$10$DFaEMhUfNknNPEL6weYwfuwtxiuNw8lXUg3Y8vteaDe1w.q531zvm', '082385786314', 'pimpinan', NULL, '2021-05-18 05:06:48', '2021-05-18 05:07:30', NULL),
(4, 'andi', 'Andi Putra', '$2y$10$/4zuPH3.Rb0KSTEBkpWN0Oe//iVnzN/jauyJYR4Va.4hxErCQnzcm', '082385786314', 'petugas', NULL, '2021-05-18 05:08:02', '2021-05-18 05:08:14', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `pelanggarans`
--
ALTER TABLE `pelanggarans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `perdas`
--
ALTER TABLE `perdas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `perda_pelanggarans`
--
ALTER TABLE `perda_pelanggarans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `perda_sangsis`
--
ALTER TABLE `perda_sangsis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `pelanggarans`
--
ALTER TABLE `pelanggarans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `perdas`
--
ALTER TABLE `perdas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `perda_pelanggarans`
--
ALTER TABLE `perda_pelanggarans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `perda_sangsis`
--
ALTER TABLE `perda_sangsis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
