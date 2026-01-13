-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 13, 2026 at 02:57 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proyek2_toko_bunga_wilis`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_orders`
--

CREATE TABLE `admin_orders` (
  `id` bigint UNSIGNED NOT NULL,
  `order_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_address` text COLLATE utf8mb4_unicode_ci,
  `product_qty` int NOT NULL DEFAULT '0',
  `subtotal` int NOT NULL DEFAULT '0',
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_proof` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('MENUNGGU PEMBAYARAN','DIKEMAS','DIKIRIM','SAMPAI TUJUAN','SELESAI','DIBATALKAN') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'MENUNGGU PEMBAYARAN',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko-bunga-wilis-cache-0ade7c2cf97f75d009975f4d720d1fa6c19f4897', 'i:2;', 1766417647),
('toko-bunga-wilis-cache-0ade7c2cf97f75d009975f4d720d1fa6c19f4897:timer', 'i:1766417647;', 1766417647),
('toko-bunga-wilis-cache-b1d5781111d84f7b3fe45a0852e59758cd7a87e5', 'i:2;', 1766451931),
('toko-bunga-wilis-cache-b1d5781111d84f7b3fe45a0852e59758cd7a87e5:timer', 'i:1766451931;', 1766451931),
('toko-bunga-wilis-cache-da4b9237bacccdf19c0760cab7aec4a8359010b0', 'i:2;', 1766417547),
('toko-bunga-wilis-cache-da4b9237bacccdf19c0760cab7aec4a8359010b0:timer', 'i:1766417547;', 1766417547),
('toko-bunga-wilis-cache-fe5dbbcea5ce7e2988b8c69bcfdfde8904aabc1f', 'i:2;', 1766391048),
('toko-bunga-wilis-cache-fe5dbbcea5ce7e2988b8c69bcfdfde8904aabc1f:timer', 'i:1766391048;', 1766391048),
('toko-bunga-wilis-cache-testimonials-high-rating', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:5:{i:0;O:17:\"App\\Models\\Review\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:6:\"review\";s:13:\"\0*\0primaryKey\";s:9:\"id_review\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:9:{s:9:\"id_review\";i:8;s:9:\"id_produk\";i:4;s:8:\"id_users\";i:8;s:10:\"id_pesanan\";i:8;s:6:\"rating\";i:5;s:8:\"komentar\";s:9:\"bintang 5\";s:14:\"tanggal_review\";s:19:\"2025-12-23 09:07:25\";s:10:\"created_at\";s:19:\"2025-12-23 09:07:25\";s:10:\"updated_at\";s:19:\"2025-12-23 09:07:25\";}s:11:\"\0*\0original\";a:9:{s:9:\"id_review\";i:8;s:9:\"id_produk\";i:4;s:8:\"id_users\";i:8;s:10:\"id_pesanan\";i:8;s:6:\"rating\";i:5;s:8:\"komentar\";s:9:\"bintang 5\";s:14:\"tanggal_review\";s:19:\"2025-12-23 09:07:25\";s:10:\"created_at\";s:19:\"2025-12-23 09:07:25\";s:10:\"updated_at\";s:19:\"2025-12-23 09:07:25\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:2:{s:14:\"tanggal_review\";s:8:\"datetime\";s:6:\"rating\";s:7:\"integer\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:2:{s:6:\"produk\";O:17:\"App\\Models\\Produk\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:6:\"produk\";s:13:\"\0*\0primaryKey\";s:9:\"id_produk\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:9:\"id_produk\";i:4;s:11:\"id_kategori\";i:2;s:4:\"nama\";s:6:\"Coleus\";s:10:\"foto_utama\";s:26:\"images/products/coleus.jpg\";s:9:\"deskripsi\";s:991:\"Coleus - Tanaman Hias Daun Warna-Warni, Penghias Rumah & Taman Anda!\r\n\r\nTemukan keindahan yang hidup dengan Coleus, tanaman hias daun yang memukau dengan corak dan warna daun yang sangat ekspresif! Cocok untuk mempercantik sudut rumah, teras, balkon, atau sebagai aksen warna di taman.\r\n\r\n✨ KEUNGGULAN PRODUK:\r\n\r\nWarna & Corak Memukau: Kombinasi warna merah, ungu, hijau, kuning, dan pink dalam pola yang unik di setiap helai daun. Setiap tanaman seperti lukisan alam!\r\n\r\nPerawatan Mudah: Tanaman yang sangat adaptif dan tidak rewel. Cocok untuk pemula maupun kolektor tanaman.\r\n\r\nTumbuh Cepat & Rimbun: Dapat dipangkas secara rutin untuk merangsang percabangan, sehingga tanaman semakin lebat dan indah.\r\n\r\nMulti Fungsi: Bisa ditanam di pot dalam ruangan (indoor) dengan cahaya cukup, di pot gantung (hanging plant), atau langsung di tanah sebagai border atau pengisi taman.\r\n\r\nTanaman Siap Hias: Sudah tumbuh sehat dan rimbun, langsung bisa dipajang untuk memperindah sudut favorit Anda.\";s:7:\"terjual\";i:5;s:6:\"rating\";s:4:\"5.00\";s:13:\"jumlah_rating\";i:3;s:10:\"created_at\";s:19:\"2025-12-22 14:34:36\";s:10:\"updated_at\";s:19:\"2025-12-23 09:07:25\";}s:11:\"\0*\0original\";a:10:{s:9:\"id_produk\";i:4;s:11:\"id_kategori\";i:2;s:4:\"nama\";s:6:\"Coleus\";s:10:\"foto_utama\";s:26:\"images/products/coleus.jpg\";s:9:\"deskripsi\";s:991:\"Coleus - Tanaman Hias Daun Warna-Warni, Penghias Rumah & Taman Anda!\r\n\r\nTemukan keindahan yang hidup dengan Coleus, tanaman hias daun yang memukau dengan corak dan warna daun yang sangat ekspresif! Cocok untuk mempercantik sudut rumah, teras, balkon, atau sebagai aksen warna di taman.\r\n\r\n✨ KEUNGGULAN PRODUK:\r\n\r\nWarna & Corak Memukau: Kombinasi warna merah, ungu, hijau, kuning, dan pink dalam pola yang unik di setiap helai daun. Setiap tanaman seperti lukisan alam!\r\n\r\nPerawatan Mudah: Tanaman yang sangat adaptif dan tidak rewel. Cocok untuk pemula maupun kolektor tanaman.\r\n\r\nTumbuh Cepat & Rimbun: Dapat dipangkas secara rutin untuk merangsang percabangan, sehingga tanaman semakin lebat dan indah.\r\n\r\nMulti Fungsi: Bisa ditanam di pot dalam ruangan (indoor) dengan cahaya cukup, di pot gantung (hanging plant), atau langsung di tanah sebagai border atau pengisi taman.\r\n\r\nTanaman Siap Hias: Sudah tumbuh sehat dan rimbun, langsung bisa dipajang untuk memperindah sudut favorit Anda.\";s:7:\"terjual\";i:5;s:6:\"rating\";s:4:\"5.00\";s:13:\"jumlah_rating\";i:3;s:10:\"created_at\";s:19:\"2025-12-22 14:34:36\";s:10:\"updated_at\";s:19:\"2025-12-23 09:07:25\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:7:{i:0;s:11:\"id_kategori\";i:1;s:4:\"nama\";i:2;s:10:\"foto_utama\";i:3;s:9:\"deskripsi\";i:4;s:7:\"terjual\";i:5;s:6:\"rating\";i:6;s:13:\"jumlah_rating\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:4:\"user\";O:15:\"App\\Models\\User\":35:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"users\";s:13:\"\0*\0primaryKey\";s:8:\"id_users\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:16:{s:8:\"id_users\";i:8;s:4:\"role\";s:4:\"user\";s:4:\"nama\";s:13:\"Tino Nurcahya\";s:5:\"email\";s:26:\"tinonurcahya.msi@gmail.com\";s:8:\"password\";s:60:\"$2y$12$0f.UaykVZc9xUB7Ta/YwEuXOWeetNXZoIr0SqzFm5kF1RXqltun2G\";s:9:\"google_id\";s:21:\"109880261388014126393\";s:6:\"alamat\";s:16:\"jalan mawar no 3\";s:5:\"no_hp\";s:11:\"08123456787\";s:13:\"jenis_kelamin\";s:1:\"L\";s:11:\"foto_profil\";N;s:17:\"email_verified_at\";s:19:\"2025-12-22 15:10:07\";s:4:\"kota\";N;s:8:\"kode_pos\";N;s:14:\"remember_token\";s:60:\"ylSTac2v9us9jZjoujChDiCbpWIUz1mhzVeC3WkwFjUwFAsi8O267Ubm0TyX\";s:10:\"created_at\";s:19:\"2025-12-22 15:09:32\";s:10:\"updated_at\";s:19:\"2025-12-22 19:19:25\";}s:11:\"\0*\0original\";a:16:{s:8:\"id_users\";i:8;s:4:\"role\";s:4:\"user\";s:4:\"nama\";s:13:\"Tino Nurcahya\";s:5:\"email\";s:26:\"tinonurcahya.msi@gmail.com\";s:8:\"password\";s:60:\"$2y$12$0f.UaykVZc9xUB7Ta/YwEuXOWeetNXZoIr0SqzFm5kF1RXqltun2G\";s:9:\"google_id\";s:21:\"109880261388014126393\";s:6:\"alamat\";s:16:\"jalan mawar no 3\";s:5:\"no_hp\";s:11:\"08123456787\";s:13:\"jenis_kelamin\";s:1:\"L\";s:11:\"foto_profil\";N;s:17:\"email_verified_at\";s:19:\"2025-12-22 15:10:07\";s:4:\"kota\";N;s:8:\"kode_pos\";N;s:14:\"remember_token\";s:60:\"ylSTac2v9us9jZjoujChDiCbpWIUz1mhzVeC3WkwFjUwFAsi8O267Ubm0TyX\";s:10:\"created_at\";s:19:\"2025-12-22 15:09:32\";s:10:\"updated_at\";s:19:\"2025-12-22 19:19:25\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:2:{s:17:\"email_verified_at\";s:8:\"datetime\";s:8:\"password\";s:6:\"hashed\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:2:{i:0;s:8:\"password\";i:1;s:14:\"remember_token\";}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:11:{i:0;s:4:\"nama\";i:1;s:5:\"email\";i:2;s:8:\"password\";i:3;s:9:\"google_id\";i:4;s:4:\"role\";i:5;s:6:\"alamat\";i:6;s:5:\"no_hp\";i:7;s:13:\"jenis_kelamin\";i:8;s:11:\"foto_profil\";i:9;s:4:\"kota\";i:10;s:8:\"kode_pos\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:19:\"\0*\0authPasswordName\";s:8:\"password\";s:20:\"\0*\0rememberTokenName\";s:14:\"remember_token\";}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:9:\"id_produk\";i:1;s:8:\"id_users\";i:2;s:10:\"id_pesanan\";i:3;s:6:\"rating\";i:4;s:8:\"komentar\";i:5;s:14:\"tanggal_review\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:1;O:17:\"App\\Models\\Review\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:6:\"review\";s:13:\"\0*\0primaryKey\";s:9:\"id_review\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:9:{s:9:\"id_review\";i:7;s:9:\"id_produk\";i:5;s:8:\"id_users\";i:8;s:10:\"id_pesanan\";i:7;s:6:\"rating\";i:5;s:8:\"komentar\";N;s:14:\"tanggal_review\";s:19:\"2025-12-23 08:59:46\";s:10:\"created_at\";s:19:\"2025-12-23 08:59:46\";s:10:\"updated_at\";s:19:\"2025-12-23 08:59:46\";}s:11:\"\0*\0original\";a:9:{s:9:\"id_review\";i:7;s:9:\"id_produk\";i:5;s:8:\"id_users\";i:8;s:10:\"id_pesanan\";i:7;s:6:\"rating\";i:5;s:8:\"komentar\";N;s:14:\"tanggal_review\";s:19:\"2025-12-23 08:59:46\";s:10:\"created_at\";s:19:\"2025-12-23 08:59:46\";s:10:\"updated_at\";s:19:\"2025-12-23 08:59:46\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:2:{s:14:\"tanggal_review\";s:8:\"datetime\";s:6:\"rating\";s:7:\"integer\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:2:{s:6:\"produk\";O:17:\"App\\Models\\Produk\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:6:\"produk\";s:13:\"\0*\0primaryKey\";s:9:\"id_produk\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:9:\"id_produk\";i:5;s:11:\"id_kategori\";i:1;s:4:\"nama\";s:15:\"Gelombang Cinta\";s:10:\"foto_utama\";s:35:\"images/products/gelombang-cinta.jpg\";s:9:\"deskripsi\";s:816:\"Gelombang Cinta adalah tanaman hias eksklusif yang menjadi idaman para kolektor berkat keindahan daunnya yang dramatis. Setiap helai daunnya besar, tebal, dan kokoh, dengan permukaan bergelombang alami menyerupai kerutan kain sutra. Warna hijau tua yang pekat dan mengilap menambah kesan elegan dan mewah. Corak tulang daun yang menonjol dan simetris semakin mempertegas karakter tanaman ini.\r\n\r\nSebagai statement piece, Gelombang Cinta sangat cocok menjadi titik fokus di ruang tamu, sudut kerja, atau area penerimaan. Perawatannya cukup mudah asalkan kebutuhan dasar cahaya dan kelembapannya terpenuhi. Tanaman ini tumbuh lambat namun stabil, menjadikannya investasi jangka panjang yang bernilai baik secara estetika maupun kebanggaan koleksi. Keunikan setiap daunnya menjadikan setiap tanaman berbeda dan spesial.\";s:7:\"terjual\";i:1;s:6:\"rating\";s:4:\"5.00\";s:13:\"jumlah_rating\";i:1;s:10:\"created_at\";s:19:\"2025-12-22 14:34:36\";s:10:\"updated_at\";s:19:\"2025-12-23 08:59:46\";}s:11:\"\0*\0original\";a:10:{s:9:\"id_produk\";i:5;s:11:\"id_kategori\";i:1;s:4:\"nama\";s:15:\"Gelombang Cinta\";s:10:\"foto_utama\";s:35:\"images/products/gelombang-cinta.jpg\";s:9:\"deskripsi\";s:816:\"Gelombang Cinta adalah tanaman hias eksklusif yang menjadi idaman para kolektor berkat keindahan daunnya yang dramatis. Setiap helai daunnya besar, tebal, dan kokoh, dengan permukaan bergelombang alami menyerupai kerutan kain sutra. Warna hijau tua yang pekat dan mengilap menambah kesan elegan dan mewah. Corak tulang daun yang menonjol dan simetris semakin mempertegas karakter tanaman ini.\r\n\r\nSebagai statement piece, Gelombang Cinta sangat cocok menjadi titik fokus di ruang tamu, sudut kerja, atau area penerimaan. Perawatannya cukup mudah asalkan kebutuhan dasar cahaya dan kelembapannya terpenuhi. Tanaman ini tumbuh lambat namun stabil, menjadikannya investasi jangka panjang yang bernilai baik secara estetika maupun kebanggaan koleksi. Keunikan setiap daunnya menjadikan setiap tanaman berbeda dan spesial.\";s:7:\"terjual\";i:1;s:6:\"rating\";s:4:\"5.00\";s:13:\"jumlah_rating\";i:1;s:10:\"created_at\";s:19:\"2025-12-22 14:34:36\";s:10:\"updated_at\";s:19:\"2025-12-23 08:59:46\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:7:{i:0;s:11:\"id_kategori\";i:1;s:4:\"nama\";i:2;s:10:\"foto_utama\";i:3;s:9:\"deskripsi\";i:4;s:7:\"terjual\";i:5;s:6:\"rating\";i:6;s:13:\"jumlah_rating\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:4:\"user\";r:110;}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:9:\"id_produk\";i:1;s:8:\"id_users\";i:2;s:10:\"id_pesanan\";i:3;s:6:\"rating\";i:4;s:8:\"komentar\";i:5;s:14:\"tanggal_review\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:2;O:17:\"App\\Models\\Review\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:6:\"review\";s:13:\"\0*\0primaryKey\";s:9:\"id_review\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:9:{s:9:\"id_review\";i:6;s:9:\"id_produk\";i:4;s:8:\"id_users\";i:8;s:10:\"id_pesanan\";i:3;s:6:\"rating\";i:5;s:8:\"komentar\";s:25:\"tanaman ini sangat cantik\";s:14:\"tanggal_review\";s:19:\"2025-12-22 19:24:05\";s:10:\"created_at\";s:19:\"2025-12-22 19:24:05\";s:10:\"updated_at\";s:19:\"2025-12-22 19:24:05\";}s:11:\"\0*\0original\";a:9:{s:9:\"id_review\";i:6;s:9:\"id_produk\";i:4;s:8:\"id_users\";i:8;s:10:\"id_pesanan\";i:3;s:6:\"rating\";i:5;s:8:\"komentar\";s:25:\"tanaman ini sangat cantik\";s:14:\"tanggal_review\";s:19:\"2025-12-22 19:24:05\";s:10:\"created_at\";s:19:\"2025-12-22 19:24:05\";s:10:\"updated_at\";s:19:\"2025-12-22 19:24:05\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:2:{s:14:\"tanggal_review\";s:8:\"datetime\";s:6:\"rating\";s:7:\"integer\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:2:{s:6:\"produk\";r:48;s:4:\"user\";r:110;}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:9:\"id_produk\";i:1;s:8:\"id_users\";i:2;s:10:\"id_pesanan\";i:3;s:6:\"rating\";i:4;s:8:\"komentar\";i:5;s:14:\"tanggal_review\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:3;O:17:\"App\\Models\\Review\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:6:\"review\";s:13:\"\0*\0primaryKey\";s:9:\"id_review\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:9:{s:9:\"id_review\";i:5;s:9:\"id_produk\";i:4;s:8:\"id_users\";i:8;s:10:\"id_pesanan\";i:5;s:6:\"rating\";i:5;s:8:\"komentar\";s:23:\"tanamannya sangat bagus\";s:14:\"tanggal_review\";s:19:\"2025-12-22 19:08:14\";s:10:\"created_at\";s:19:\"2025-12-22 19:08:14\";s:10:\"updated_at\";s:19:\"2025-12-22 19:08:14\";}s:11:\"\0*\0original\";a:9:{s:9:\"id_review\";i:5;s:9:\"id_produk\";i:4;s:8:\"id_users\";i:8;s:10:\"id_pesanan\";i:5;s:6:\"rating\";i:5;s:8:\"komentar\";s:23:\"tanamannya sangat bagus\";s:14:\"tanggal_review\";s:19:\"2025-12-22 19:08:14\";s:10:\"created_at\";s:19:\"2025-12-22 19:08:14\";s:10:\"updated_at\";s:19:\"2025-12-22 19:08:14\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:2:{s:14:\"tanggal_review\";s:8:\"datetime\";s:6:\"rating\";s:7:\"integer\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:2:{s:6:\"produk\";r:48;s:4:\"user\";r:110;}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:9:\"id_produk\";i:1;s:8:\"id_users\";i:2;s:10:\"id_pesanan\";i:3;s:6:\"rating\";i:4;s:8:\"komentar\";i:5;s:14:\"tanggal_review\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:4;O:17:\"App\\Models\\Review\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:6:\"review\";s:13:\"\0*\0primaryKey\";s:9:\"id_review\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:9:{s:9:\"id_review\";i:4;s:9:\"id_produk\";i:3;s:8:\"id_users\";i:8;s:10:\"id_pesanan\";i:2;s:6:\"rating\";i:5;s:8:\"komentar\";s:3:\"oke\";s:14:\"tanggal_review\";s:19:\"2025-12-22 16:36:08\";s:10:\"created_at\";s:19:\"2025-12-22 16:36:08\";s:10:\"updated_at\";s:19:\"2025-12-22 16:36:08\";}s:11:\"\0*\0original\";a:9:{s:9:\"id_review\";i:4;s:9:\"id_produk\";i:3;s:8:\"id_users\";i:8;s:10:\"id_pesanan\";i:2;s:6:\"rating\";i:5;s:8:\"komentar\";s:3:\"oke\";s:14:\"tanggal_review\";s:19:\"2025-12-22 16:36:08\";s:10:\"created_at\";s:19:\"2025-12-22 16:36:08\";s:10:\"updated_at\";s:19:\"2025-12-22 16:36:08\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:2:{s:14:\"tanggal_review\";s:8:\"datetime\";s:6:\"rating\";s:7:\"integer\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:2:{s:6:\"produk\";O:17:\"App\\Models\\Produk\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:6:\"produk\";s:13:\"\0*\0primaryKey\";s:9:\"id_produk\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:9:\"id_produk\";i:3;s:11:\"id_kategori\";i:2;s:4:\"nama\";s:11:\"Mawar Merah\";s:10:\"foto_utama\";s:31:\"images/products/mawar-merah.jpg\";s:9:\"deskripsi\";s:950:\"Mawar Merah Segar - Simbol Cinta & Keindahan Abadi untuk Setiap Momen Spesial!\r\n\r\nHadirkan kehangatan dan pesona dengan Mawar Merah, bunga legendaris yang selalu menjadi pilihan utama untuk mengungkapkan perasaan terdalam. Cocok untuk hadiah romantis, dekorasi acara, atau sekadar menghiasi rumah dengan keindahan alam.\r\n\r\n🌹 KEUNGGULAN PRODUK:\r\n\r\nBunga Segar Premium: Dipetik dari kebun pilihan, dengan kelopak utuh, warna merah merona menyala, dan batang kuat.\r\n\r\nSimbolik Penuh Makna: Lambang cinta sejati, kekaguman, dan penghargaan yang tak terlukiskan dengan kata-kata.\r\n\r\nKesegaran Terjaga: Dikirim dalam kondisi segar dengan proses hydration sebelum pengiriman agar tahan lebih lama.\r\n\r\nSiap Pakai & Multi Fungsi: Siap dijadikan buket, dekorasi meja, rangkaian bunga, atau hadiah langsung dalam kemasan eksklusif.\r\n\r\nSetiap Tangkai Diseleksi: Hanya bunga dengan kualitas terbaik (ukuran, warna, dan kondisi) yang akan dikirimkan untuk Anda.\";s:7:\"terjual\";i:2;s:6:\"rating\";s:4:\"4.50\";s:13:\"jumlah_rating\";i:2;s:10:\"created_at\";s:19:\"2025-12-22 14:34:36\";s:10:\"updated_at\";s:19:\"2025-12-23 08:19:13\";}s:11:\"\0*\0original\";a:10:{s:9:\"id_produk\";i:3;s:11:\"id_kategori\";i:2;s:4:\"nama\";s:11:\"Mawar Merah\";s:10:\"foto_utama\";s:31:\"images/products/mawar-merah.jpg\";s:9:\"deskripsi\";s:950:\"Mawar Merah Segar - Simbol Cinta & Keindahan Abadi untuk Setiap Momen Spesial!\r\n\r\nHadirkan kehangatan dan pesona dengan Mawar Merah, bunga legendaris yang selalu menjadi pilihan utama untuk mengungkapkan perasaan terdalam. Cocok untuk hadiah romantis, dekorasi acara, atau sekadar menghiasi rumah dengan keindahan alam.\r\n\r\n🌹 KEUNGGULAN PRODUK:\r\n\r\nBunga Segar Premium: Dipetik dari kebun pilihan, dengan kelopak utuh, warna merah merona menyala, dan batang kuat.\r\n\r\nSimbolik Penuh Makna: Lambang cinta sejati, kekaguman, dan penghargaan yang tak terlukiskan dengan kata-kata.\r\n\r\nKesegaran Terjaga: Dikirim dalam kondisi segar dengan proses hydration sebelum pengiriman agar tahan lebih lama.\r\n\r\nSiap Pakai & Multi Fungsi: Siap dijadikan buket, dekorasi meja, rangkaian bunga, atau hadiah langsung dalam kemasan eksklusif.\r\n\r\nSetiap Tangkai Diseleksi: Hanya bunga dengan kualitas terbaik (ukuran, warna, dan kondisi) yang akan dikirimkan untuk Anda.\";s:7:\"terjual\";i:2;s:6:\"rating\";s:4:\"4.50\";s:13:\"jumlah_rating\";i:2;s:10:\"created_at\";s:19:\"2025-12-22 14:34:36\";s:10:\"updated_at\";s:19:\"2025-12-23 08:19:13\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:7:{i:0;s:11:\"id_kategori\";i:1;s:4:\"nama\";i:2;s:10:\"foto_utama\";i:3;s:9:\"deskripsi\";i:4;s:7:\"terjual\";i:5;s:6:\"rating\";i:6;s:13:\"jumlah_rating\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:4:\"user\";r:110;}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:9:\"id_produk\";i:1;s:8:\"id_users\";i:2;s:10:\"id_pesanan\";i:3;s:6:\"rating\";i:4;s:8:\"komentar\";i:5;s:14:\"tanggal_review\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1768316111);

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
-- Table structure for table `detail_tanaman`
--

CREATE TABLE `detail_tanaman` (
  `id_detail_tanaman` bigint UNSIGNED NOT NULL,
  `id_produk` bigint UNSIGNED NOT NULL,
  `nama_ilmiah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ukuran_detail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asal_tanaman` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_tanaman`
--

INSERT INTO `detail_tanaman` (`id_detail_tanaman`, `id_produk`, `nama_ilmiah`, `ukuran_detail`, `asal_tanaman`, `created_at`, `updated_at`) VALUES
(1, 1, 'Monstera deliciosa', 'Daun dewasa diameter 30–60 cm; tinggi tanaman bisa mencapai 2–3 meter', 'Hutan tropis Amerika Tengah dan Selatan', '2025-12-22 07:34:36', '2025-12-23 01:28:13'),
(2, 2, 'Licuala grandis', 'Daun berbentuk kipas bundar diameter 40–80 cm; tinggi tanaman bisa mencapai 1.5–3 meter', 'Hutan hujan tropis di Kepulauan Solomon dan Vanuatu', '2025-12-22 07:34:36', '2025-12-23 01:32:54'),
(3, 3, 'Rosa sp.', 'Diameter Bunga: 5 - 7 cm | Tinggi Tanaman: 50 - 65 cm', 'dataran Asia, Eropa, dan Timur Tengah', '2025-12-22 07:34:36', '2025-12-23 01:19:13'),
(4, 4, 'Plectranthus scutellarioides', 'Diameter ±10 cm', 'Asia Tenggara dan kepulauan Pasifik', '2025-12-22 07:34:36', '2025-12-22 07:34:36'),
(5, 5, 'Anthurium plowmanii', 'Daun dewasa panjang 30–70 cm, lebar 15–30 cm', 'Hutan hujan tropis Amerika Selatan', '2025-12-22 07:34:36', '2025-12-23 01:25:08'),
(6, 6, 'Sansevieria trifasciata', 'Tinggi daun 20–120 cm; daun tegak, kaku, berbentuk pedang', 'Afrika Barat', '2025-12-23 02:14:03', '2025-12-23 02:14:03'),
(7, 7, 'Spathiphyllum wallisii', 'Tinggi tanaman 30–80 cm, daun lanceolate hijau gelap, bunga putih dengan spathe menyerupai bendera', 'Hutan tropis Amerika Tengah dan Selatan', '2025-12-23 02:19:56', '2025-12-23 02:19:56'),
(8, 8, 'Aglaonema spp.', 'Tinggi tanaman 25–60 cm; daun oval atau lanceolate dengan pola warna beragam', 'Hutan tropis Asia Tenggara', '2025-12-23 02:25:52', '2025-12-23 02:25:52'),
(9, 9, 'Epipremnum aureum', 'Panjang batang merambat/gantung dapat mencapai 1–4 meter; daun berbentuk hati dengan variegasi kuning/putih', 'Kepulauan Solomon, Polinesia', '2025-12-23 02:29:23', '2025-12-23 02:29:23'),
(10, 10, 'Calathea spp.', 'Tinggi 30–60 cm; daun oval besar dengan pola seperti garis, bintik, atau tepian kontras', 'Hutan hujan tropis Amerika Selatan', '2025-12-23 02:36:00', '2025-12-23 02:37:03'),
(11, 11, 'Schlumbergera bridgesii', 'Panjang ruas batang 20–60 cm; berbunga di ujung batang dengan warna merah, pink, putih, atau ungu', 'Hutan tropis Brasil', '2025-12-23 02:54:35', '2025-12-23 02:54:35'),
(12, 12, 'Anthurium crystallinum', 'Daun dewasa panjang 20–40 cm, lebar 15–30 cm, berbentuk hati dengan urat daun putih-perak menonjol', 'Hutan hujan tropis Amerika Tengah dan Selatan', '2025-12-23 02:58:33', '2025-12-23 02:58:33');

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
-- Table structure for table `foto_produk`
--

CREATE TABLE `foto_produk` (
  `id_foto_produk` bigint UNSIGNED NOT NULL,
  `id_produk` bigint UNSIGNED NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `foto_produk`
--

INSERT INTO `foto_produk` (`id_foto_produk`, `id_produk`, `foto`) VALUES
(5, 1, 'uploads/produk/1766453709_482ukPo3FF.jpg'),
(6, 1, 'uploads/produk/1766453770_sR9p2tSLip.jpg'),
(7, 1, 'uploads/produk/1766453821_sohQebb9Or.jpg'),
(8, 2, 'uploads/produk/1766454418_hnLoAX1QZZ.jpg'),
(9, 2, 'uploads/produk/1766454498_lNcRzGh3Mi.jpg'),
(10, 2, 'uploads/produk/1766454526_UErZWIZel3.jpg'),
(11, 3, 'uploads/produk/1766454677_fN6GlDuA9x.jpg'),
(12, 3, 'uploads/produk/1766454677_B38zcDfVtv.jpeg'),
(13, 4, 'uploads/produk/1766454844_wDiRGZ7ROV.webp'),
(14, 4, 'uploads/produk/1766454844_XatgF0xtby.jpeg'),
(15, 4, 'uploads/produk/1766454844_Zi2ZoCkXev.jpg'),
(16, 5, 'uploads/produk/1766454990_G6osXBgMkM.webp'),
(17, 5, 'uploads/produk/1766454990_yMHN7423ap.jpeg'),
(18, 5, 'uploads/produk/1766454990_dxhU1tQrS2.jpg'),
(19, 6, 'uploads/produk/1766456044_efx4yRi7zc.jpg'),
(20, 6, 'uploads/produk/1766456044_qiregz0gMz.webp'),
(21, 6, 'uploads/produk/1766456079_s6iMIdwOIk.jpeg'),
(22, 7, 'uploads/produk/1766456396_4ZVtASzHPe.jpg'),
(23, 7, 'uploads/produk/1766456396_e1BPvYYYow.jpg'),
(24, 7, 'uploads/produk/1766456455_HFPAjohPdU.jpg'),
(25, 8, 'uploads/produk/1766456752_7cWcp3Mh0k.webp'),
(26, 8, 'uploads/produk/1766456752_PgnKIgmkiv.webp'),
(27, 8, 'uploads/produk/1766456752_04snxwTWkP.jpg'),
(28, 9, 'uploads/produk/1766457112_DCdm9eOMQE.jpg'),
(29, 9, 'uploads/produk/1766457112_0X7f0Puuvd.webp'),
(30, 9, 'uploads/produk/1766457112_qSNd2w4QIw.jpg'),
(31, 10, 'uploads/produk/1766457360_geCze58bnr.jpg'),
(32, 10, 'uploads/produk/1766457360_b34FDbqqrh.jpeg'),
(33, 10, 'uploads/produk/1766457360_bi0QojSIPW.jpeg'),
(34, 11, 'uploads/produk/1766458475_4g5Km8zREX.webp'),
(35, 11, 'uploads/produk/1766458475_ioAdmHAoMu.jpg'),
(36, 11, 'uploads/produk/1766458475_RZqQdDjILM.jpeg'),
(37, 12, 'uploads/produk/1766458713_dZoNhefz2O.webp'),
(38, 12, 'uploads/produk/1766458713_JPpx0hk4eF.jpg');

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
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` bigint UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Indoor Plant'),
(2, 'Outdoor Plant');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` bigint UNSIGNED NOT NULL,
  `id_users` bigint UNSIGNED NOT NULL,
  `id_produk_ukuran` bigint UNSIGNED NOT NULL,
  `jumlah` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`id_keranjang`, `id_users`, `id_produk_ukuran`, `jumlah`, `created_at`, `updated_at`) VALUES
(2, 3, 2, 3, '2025-12-22 07:34:36', '2025-12-22 07:34:36'),
(25, 8, 46, 1, '2026-01-05 06:12:01', '2026-01-05 06:12:01');

-- --------------------------------------------------------

--
-- Table structure for table `midtrans_notification_logs`
--

CREATE TABLE `midtrans_notification_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` json DEFAULT NULL,
  `processed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `midtrans_notification_logs`
--

INSERT INTO `midtrans_notification_logs` (`id`, `transaction_id`, `order_id`, `status`, `payload`, `processed_at`, `created_at`, `updated_at`) VALUES
(1, '99193ed8-f597-449b-951b-15172e2756f5', 'ORD-1766395979-7548', 'pending', '{\"currency\": \"IDR\", \"order_id\": \"ORD-1766395979-7548\", \"va_numbers\": [{\"bank\": \"bca\", \"va_number\": \"58343604789979778165012\"}], \"expiry_time\": \"2025-12-23 16:33:00\", \"merchant_id\": \"G782558343\", \"status_code\": \"201\", \"fraud_status\": \"accept\", \"gross_amount\": \"33300.00\", \"payment_type\": \"bank_transfer\", \"signature_key\": \"6a1a98f4e13f9bf4d99720ffa78e265243e5715c3f1a1ef8e7671e32b81ac60ec2bb672ec77b7899158d7485b101abccaf8111a01fde1dffcc5c58de765d0fff\", \"status_message\": \"Success, transaction is found\", \"transaction_id\": \"99193ed8-f597-449b-951b-15172e2756f5\", \"payment_amounts\": [], \"transaction_time\": \"2025-12-22 16:33:50\", \"transaction_status\": \"pending\"}', '2025-12-22 09:33:52', '2025-12-22 09:33:52', '2025-12-22 09:33:52'),
(2, '99193ed8-f597-449b-951b-15172e2756f5', 'ORD-1766395979-7548', 'settlement', '{\"currency\": \"IDR\", \"order_id\": \"ORD-1766395979-7548\", \"va_numbers\": [{\"bank\": \"bca\", \"va_number\": \"58343604789979778165012\"}], \"expiry_time\": \"2025-12-23 16:33:00\", \"merchant_id\": \"G782558343\", \"status_code\": \"200\", \"fraud_status\": \"accept\", \"gross_amount\": \"33300.00\", \"payment_type\": \"bank_transfer\", \"signature_key\": \"c738cd6434e8f8971d88fdd6d86566c823b5cb7436840a161deeab774193fd72a5ba09782cb6621310a0857e2583d94f3543364d574a8c97b2bca575aae0b274\", \"status_message\": \"Success, transaction is found\", \"transaction_id\": \"99193ed8-f597-449b-951b-15172e2756f5\", \"payment_amounts\": [], \"settlement_time\": \"2025-12-22 16:34:06\", \"transaction_time\": \"2025-12-22 16:33:50\", \"transaction_status\": \"settlement\"}', '2025-12-22 09:34:07', '2025-12-22 09:34:07', '2025-12-22 09:34:07'),
(3, '4d932771-5680-468f-8772-43e1b2544907', 'ORD-1766404805-5309', 'pending', '{\"currency\": \"IDR\", \"order_id\": \"ORD-1766404805-5309\", \"va_numbers\": [{\"bank\": \"bca\", \"va_number\": \"58343449811301290668781\"}], \"expiry_time\": \"2025-12-23 19:00:06\", \"merchant_id\": \"G782558343\", \"status_code\": \"201\", \"fraud_status\": \"accept\", \"gross_amount\": \"33300.00\", \"payment_type\": \"bank_transfer\", \"signature_key\": \"bc5d9f0877a2a24b3f0a8b9c84aeb628faf0bd6a1f9acb16fafc2abc5a627764fe50bfef8c7b2e5112701e25c16988c85954fd3f9660a44e749ecb2e96ba072e\", \"status_message\": \"Success, transaction is found\", \"transaction_id\": \"4d932771-5680-468f-8772-43e1b2544907\", \"payment_amounts\": [], \"transaction_time\": \"2025-12-22 19:00:10\", \"transaction_status\": \"pending\"}', '2025-12-22 12:00:12', '2025-12-22 12:00:12', '2025-12-22 12:00:12'),
(4, '4d932771-5680-468f-8772-43e1b2544907', 'ORD-1766404805-5309', 'settlement', '{\"currency\": \"IDR\", \"order_id\": \"ORD-1766404805-5309\", \"va_numbers\": [{\"bank\": \"bca\", \"va_number\": \"58343449811301290668781\"}], \"expiry_time\": \"2025-12-23 19:00:06\", \"merchant_id\": \"G782558343\", \"status_code\": \"200\", \"fraud_status\": \"accept\", \"gross_amount\": \"33300.00\", \"payment_type\": \"bank_transfer\", \"signature_key\": \"01c6c39526c1d10a644ad5c593d9b984ff5556fc561f7f5276d3e6dd2b9ff037394f770961f7dcb42c2db9bdd3c4d8165aead912e1276f560cdff70a1d6bb920\", \"status_message\": \"Success, transaction is found\", \"transaction_id\": \"4d932771-5680-468f-8772-43e1b2544907\", \"payment_amounts\": [], \"settlement_time\": \"2025-12-22 19:00:17\", \"transaction_time\": \"2025-12-22 19:00:10\", \"transaction_status\": \"settlement\"}', '2025-12-22 12:00:18', '2025-12-22 12:00:18', '2025-12-22 12:00:18'),
(5, '797ed3f4-cfce-459a-9c7b-9dd6e1be48b3', 'ORD-1766404897-9248', 'pending', '{\"currency\": \"IDR\", \"order_id\": \"ORD-1766404897-9248\", \"va_numbers\": [{\"bank\": \"bca\", \"va_number\": \"58343428743849043648065\"}], \"expiry_time\": \"2025-12-23 19:01:39\", \"merchant_id\": \"G782558343\", \"status_code\": \"201\", \"fraud_status\": \"accept\", \"gross_amount\": \"33300.00\", \"payment_type\": \"bank_transfer\", \"signature_key\": \"41dee7edb5be60c227b600b0ef2cd87ac2a019e56f0a859803da1e27bb545e285e57815f1923ddf3de6103c6dfeb36e4ece3eafa2060efbbfbd717887f333b36\", \"status_message\": \"Success, transaction is found\", \"transaction_id\": \"797ed3f4-cfce-459a-9c7b-9dd6e1be48b3\", \"payment_amounts\": [], \"transaction_time\": \"2025-12-22 19:01:42\", \"transaction_status\": \"pending\"}', '2025-12-22 12:01:44', '2025-12-22 12:01:44', '2025-12-22 12:01:44'),
(6, '797ed3f4-cfce-459a-9c7b-9dd6e1be48b3', 'ORD-1766404897-9248', 'settlement', '{\"currency\": \"IDR\", \"order_id\": \"ORD-1766404897-9248\", \"va_numbers\": [{\"bank\": \"bca\", \"va_number\": \"58343428743849043648065\"}], \"expiry_time\": \"2025-12-23 19:01:39\", \"merchant_id\": \"G782558343\", \"status_code\": \"200\", \"fraud_status\": \"accept\", \"gross_amount\": \"33300.00\", \"payment_type\": \"bank_transfer\", \"signature_key\": \"abd02edcf96434e47be241f5c229b25e1ffb080be63f764b716e549d8d21385868976686e37af579b3e879726a3ab1e0a04b82e92ed9832b320af49833a5e485\", \"status_message\": \"Success, transaction is found\", \"transaction_id\": \"797ed3f4-cfce-459a-9c7b-9dd6e1be48b3\", \"payment_amounts\": [], \"settlement_time\": \"2025-12-22 19:01:47\", \"transaction_time\": \"2025-12-22 19:01:42\", \"transaction_status\": \"settlement\"}', '2025-12-22 12:01:49', '2025-12-22 12:01:49', '2025-12-22 12:01:49'),
(7, 'f1dc69f5-8a02-4dac-817c-b6f2255ef457', 'ORD-1766405211-7005', 'pending', '{\"currency\": \"IDR\", \"order_id\": \"ORD-1766405211-7005\", \"va_numbers\": [{\"bank\": \"bca\", \"va_number\": \"58343246845754778456017\"}], \"expiry_time\": \"2025-12-23 19:06:53\", \"merchant_id\": \"G782558343\", \"status_code\": \"201\", \"fraud_status\": \"accept\", \"gross_amount\": \"33300.00\", \"payment_type\": \"bank_transfer\", \"signature_key\": \"bc118888e2aa64aac869871666d72df47a77c6512efdcf1639812add6e15cf3a3f77e68ba4f71ed69f86c732c90ef4ab9ed2456213729f35e0d36d748a1581af\", \"status_message\": \"Success, transaction is found\", \"transaction_id\": \"f1dc69f5-8a02-4dac-817c-b6f2255ef457\", \"payment_amounts\": [], \"transaction_time\": \"2025-12-22 19:06:56\", \"transaction_status\": \"pending\"}', '2025-12-22 12:06:59', '2025-12-22 12:06:59', '2025-12-22 12:06:59'),
(8, 'f1dc69f5-8a02-4dac-817c-b6f2255ef457', 'ORD-1766405211-7005', 'settlement', '{\"currency\": \"IDR\", \"order_id\": \"ORD-1766405211-7005\", \"va_numbers\": [{\"bank\": \"bca\", \"va_number\": \"58343246845754778456017\"}], \"expiry_time\": \"2025-12-23 19:06:53\", \"merchant_id\": \"G782558343\", \"status_code\": \"200\", \"fraud_status\": \"accept\", \"gross_amount\": \"33300.00\", \"payment_type\": \"bank_transfer\", \"signature_key\": \"f59e413dddb5d846e01c8939f8f4ed30b1d6a8bd921a9e864f93a3e5e4064767387c8de2058e23bade2201a110e4ffb9b23f5a2fff1a04bafb5023ff5986e989\", \"status_message\": \"Success, transaction is found\", \"transaction_id\": \"f1dc69f5-8a02-4dac-817c-b6f2255ef457\", \"payment_amounts\": [], \"settlement_time\": \"2025-12-22 19:07:01\", \"transaction_time\": \"2025-12-22 19:06:56\", \"transaction_status\": \"settlement\"}', '2025-12-22 12:07:06', '2025-12-22 12:07:06', '2025-12-22 12:07:06'),
(9, '234e2f40-2e69-401a-a9a8-ccf5753bdf21', 'ORD-1766406005-1402', 'pending', '{\"currency\": \"IDR\", \"order_id\": \"ORD-1766406005-1402\", \"va_numbers\": [{\"bank\": \"bca\", \"va_number\": \"58343139841713817368759\"}], \"expiry_time\": \"2025-12-23 19:20:07\", \"merchant_id\": \"G782558343\", \"status_code\": \"201\", \"fraud_status\": \"accept\", \"gross_amount\": \"33300.00\", \"payment_type\": \"bank_transfer\", \"signature_key\": \"d9f90007da4f91b140614671c643c76c835f5e4a279cd747061ef151170d6d54843306cf7de1f48a72788ce4bc9ff34344aeac51a50733d37ec3a701b1367d33\", \"status_message\": \"Success, transaction is found\", \"transaction_id\": \"234e2f40-2e69-401a-a9a8-ccf5753bdf21\", \"payment_amounts\": [], \"transaction_time\": \"2025-12-22 19:20:27\", \"transaction_status\": \"pending\"}', '2025-12-22 12:20:30', '2025-12-22 12:20:30', '2025-12-22 12:20:30'),
(10, '234e2f40-2e69-401a-a9a8-ccf5753bdf21', 'ORD-1766406005-1402', 'settlement', '{\"currency\": \"IDR\", \"order_id\": \"ORD-1766406005-1402\", \"va_numbers\": [{\"bank\": \"bca\", \"va_number\": \"58343139841713817368759\"}], \"expiry_time\": \"2025-12-23 19:20:07\", \"merchant_id\": \"G782558343\", \"status_code\": \"200\", \"fraud_status\": \"accept\", \"gross_amount\": \"33300.00\", \"payment_type\": \"bank_transfer\", \"signature_key\": \"f66fd12e9dd9316414272ec6a9ee970060730c2c479b8140889c6148696e54f5d723fa55a95c78a8d360283ce6d68e2684d4dee461b9bb6473b49bb29ace50a3\", \"status_message\": \"Success, transaction is found\", \"transaction_id\": \"234e2f40-2e69-401a-a9a8-ccf5753bdf21\", \"payment_amounts\": [], \"settlement_time\": \"2025-12-22 19:20:37\", \"transaction_time\": \"2025-12-22 19:20:27\", \"transaction_status\": \"settlement\"}', '2025-12-22 12:20:39', '2025-12-22 12:20:39', '2025-12-22 12:20:39'),
(11, '46694a2c-1215-43dd-b7c6-a201d86c2967', 'ORD-1766455128-3689', 'pending', '{\"currency\": \"IDR\", \"order_id\": \"ORD-1766455128-3689\", \"va_numbers\": [{\"bank\": \"bca\", \"va_number\": \"58343787896904736814292\"}], \"expiry_time\": \"2025-12-24 08:58:50\", \"merchant_id\": \"G782558343\", \"status_code\": \"201\", \"fraud_status\": \"accept\", \"gross_amount\": \"55500.00\", \"payment_type\": \"bank_transfer\", \"signature_key\": \"5e24c4e0a0a753adac090273ec96b93ae04d1906cfc5ae0f0c8302b5c4a5ec0c2c1e5b6814ebb1d120bacbdace91f8971f62f4853e356126cdf60f162a87cc34\", \"status_message\": \"Success, transaction is found\", \"transaction_id\": \"46694a2c-1215-43dd-b7c6-a201d86c2967\", \"payment_amounts\": [], \"transaction_time\": \"2025-12-23 08:58:54\", \"transaction_status\": \"pending\"}', '2025-12-23 01:58:56', '2025-12-23 01:58:56', '2025-12-23 01:58:56'),
(12, '46694a2c-1215-43dd-b7c6-a201d86c2967', 'ORD-1766455128-3689', 'settlement', '{\"currency\": \"IDR\", \"order_id\": \"ORD-1766455128-3689\", \"va_numbers\": [{\"bank\": \"bca\", \"va_number\": \"58343787896904736814292\"}], \"expiry_time\": \"2025-12-24 08:58:50\", \"merchant_id\": \"G782558343\", \"status_code\": \"200\", \"fraud_status\": \"accept\", \"gross_amount\": \"55500.00\", \"payment_type\": \"bank_transfer\", \"signature_key\": \"a51fedfa38c81255562eb0f0e18fbe937a21e0edbea741a0a603b5ae47b6adf511bc5f997b8613b603ea3059a0219edbd1a32cfa508245acf3439dfaad1917cf\", \"status_message\": \"Success, transaction is found\", \"transaction_id\": \"46694a2c-1215-43dd-b7c6-a201d86c2967\", \"payment_amounts\": [], \"settlement_time\": \"2025-12-23 08:59:01\", \"transaction_time\": \"2025-12-23 08:58:54\", \"transaction_status\": \"settlement\"}', '2025-12-23 01:59:02', '2025-12-23 01:59:02', '2025-12-23 01:59:02'),
(13, '610039a8-6cd1-463d-94bd-aee9daab9aab', 'ORD-1766455561-9520', 'pending', '{\"currency\": \"IDR\", \"order_id\": \"ORD-1766455561-9520\", \"va_numbers\": [{\"bank\": \"bca\", \"va_number\": \"58343470718295900842193\"}], \"expiry_time\": \"2025-12-24 09:06:03\", \"merchant_id\": \"G782558343\", \"status_code\": \"201\", \"fraud_status\": \"accept\", \"gross_amount\": \"33300.00\", \"payment_type\": \"bank_transfer\", \"signature_key\": \"83a7cb5e7badf1fa1cd83d7e12e30a7da90e2b55406fc32c6bd18e5fecb650f8c03ebaaf22c35bb3eccf2594864b9e567699e5d0363778d691cac8adddf7a865\", \"status_message\": \"Success, transaction is found\", \"transaction_id\": \"610039a8-6cd1-463d-94bd-aee9daab9aab\", \"payment_amounts\": [], \"transaction_time\": \"2025-12-23 09:06:06\", \"transaction_status\": \"pending\"}', '2025-12-23 02:06:08', '2025-12-23 02:06:08', '2025-12-23 02:06:08'),
(14, '610039a8-6cd1-463d-94bd-aee9daab9aab', 'ORD-1766455561-9520', 'settlement', '{\"currency\": \"IDR\", \"order_id\": \"ORD-1766455561-9520\", \"va_numbers\": [{\"bank\": \"bca\", \"va_number\": \"58343470718295900842193\"}], \"expiry_time\": \"2025-12-24 09:06:03\", \"merchant_id\": \"G782558343\", \"status_code\": \"200\", \"fraud_status\": \"accept\", \"gross_amount\": \"33300.00\", \"payment_type\": \"bank_transfer\", \"signature_key\": \"3ed00395f51bcd564a98c391855a56ef77599fac136c245e9cdffe1440bb46637db8b21a2c0b074b6950fe966b6e95a31c398dd351ca8e45296ee219dba58c82\", \"status_message\": \"Success, transaction is found\", \"transaction_id\": \"610039a8-6cd1-463d-94bd-aee9daab9aab\", \"payment_amounts\": [], \"settlement_time\": \"2025-12-23 09:06:12\", \"transaction_time\": \"2025-12-23 09:06:06\", \"transaction_status\": \"settlement\"}', '2025-12-23 02:06:14', '2025-12-23 02:06:14', '2025-12-23 02:06:14'),
(15, 'f0e5e06a-eae7-4bca-a1f3-fc9379f3fb06', 'ORD-1766465903-7422', 'pending', '{\"currency\": \"IDR\", \"order_id\": \"ORD-1766465903-7422\", \"va_numbers\": [{\"bank\": \"bca\", \"va_number\": \"58343020863653393713652\"}], \"expiry_time\": \"2025-12-24 11:58:25\", \"merchant_id\": \"G782558343\", \"status_code\": \"201\", \"fraud_status\": \"accept\", \"gross_amount\": \"66600.00\", \"payment_type\": \"bank_transfer\", \"signature_key\": \"1713672b275c5f959cef79df387f7477d877b2accb836d2b28f19ec7728889030f25d7ff74bf479226f6cd2df08a37017f416b58fb439363989c9c6d183baac4\", \"status_message\": \"Success, transaction is found\", \"transaction_id\": \"f0e5e06a-eae7-4bca-a1f3-fc9379f3fb06\", \"payment_amounts\": [], \"transaction_time\": \"2025-12-23 11:58:29\", \"transaction_status\": \"pending\"}', '2025-12-23 04:58:30', '2025-12-23 04:58:30', '2025-12-23 04:58:30'),
(16, 'f0e5e06a-eae7-4bca-a1f3-fc9379f3fb06', 'ORD-1766465903-7422', 'settlement', '{\"currency\": \"IDR\", \"order_id\": \"ORD-1766465903-7422\", \"va_numbers\": [{\"bank\": \"bca\", \"va_number\": \"58343020863653393713652\"}], \"expiry_time\": \"2025-12-24 11:58:25\", \"merchant_id\": \"G782558343\", \"status_code\": \"200\", \"fraud_status\": \"accept\", \"gross_amount\": \"66600.00\", \"payment_type\": \"bank_transfer\", \"signature_key\": \"6dfaaf79e233266479ba524f14a41db6ae26e3b51dbc6318fc24e7c37047230e54c3794f0f6e726783000cb5183cdd20df94af691eefda821f0a066da153f54c\", \"status_message\": \"Success, transaction is found\", \"transaction_id\": \"f0e5e06a-eae7-4bca-a1f3-fc9379f3fb06\", \"payment_amounts\": [], \"settlement_time\": \"2025-12-23 11:58:36\", \"transaction_time\": \"2025-12-23 11:58:29\", \"transaction_status\": \"settlement\"}', '2025-12-23 04:58:36', '2025-12-23 04:58:36', '2025-12-23 04:58:36'),
(17, 'f95b9072-14e3-4eb2-830e-303da2e29749', 'ORD-1766473856-1309', 'pending', '{\"currency\": \"IDR\", \"order_id\": \"ORD-1766473856-1309\", \"va_numbers\": [{\"bank\": \"bca\", \"va_number\": \"58343183838721394757324\"}], \"expiry_time\": \"2025-12-24 14:10:58\", \"merchant_id\": \"G782558343\", \"status_code\": \"201\", \"fraud_status\": \"accept\", \"gross_amount\": \"1332000.00\", \"payment_type\": \"bank_transfer\", \"signature_key\": \"7f97f6f5b2efbc003b7fb941fdbb8fa5e659b0a7aa3a34100879f79a13d333db44fc0f7f3911a2eb5cb6ba0d58e5104e2855ef931ae8f69e9aba1299fc1c9477\", \"status_message\": \"Success, transaction is found\", \"transaction_id\": \"f95b9072-14e3-4eb2-830e-303da2e29749\", \"payment_amounts\": [], \"transaction_time\": \"2025-12-23 14:11:19\", \"transaction_status\": \"pending\"}', '2025-12-23 07:11:20', '2025-12-23 07:11:20', '2025-12-23 07:11:20'),
(18, 'f95b9072-14e3-4eb2-830e-303da2e29749', 'ORD-1766473856-1309', 'settlement', '{\"currency\": \"IDR\", \"order_id\": \"ORD-1766473856-1309\", \"va_numbers\": [{\"bank\": \"bca\", \"va_number\": \"58343183838721394757324\"}], \"expiry_time\": \"2025-12-24 14:10:58\", \"merchant_id\": \"G782558343\", \"status_code\": \"200\", \"fraud_status\": \"accept\", \"gross_amount\": \"1332000.00\", \"payment_type\": \"bank_transfer\", \"signature_key\": \"fa1fee1b1e22f72771a8ed04a663731241998a89e91b9c5c774fa3b29f3e6d055a5e243fe2a14a6b5a7d4d54ee1fbc39da1480ff07cbfeab5ee832b766045315\", \"status_message\": \"Success, transaction is found\", \"transaction_id\": \"f95b9072-14e3-4eb2-830e-303da2e29749\", \"payment_amounts\": [], \"settlement_time\": \"2025-12-23 14:12:20\", \"transaction_time\": \"2025-12-23 14:11:19\", \"transaction_status\": \"settlement\"}', '2025-12-23 07:12:20', '2025-12-23 07:12:20', '2025-12-23 07:12:20'),
(19, '7a6ee250-e71b-4022-a8b8-64b095373957', 'ORD-1766474678-9853', 'pending', '{\"currency\": \"IDR\", \"order_id\": \"ORD-1766474678-9853\", \"expiry_time\": \"2025-12-24 14:24:40\", \"merchant_id\": \"G782558343\", \"status_code\": \"201\", \"fraud_status\": \"accept\", \"gross_amount\": \"44400.00\", \"payment_type\": \"qris\", \"signature_key\": \"517ae4b81ab85ce9fc1b9ccc7559c5f0d601051396761a21f456cd29b86cc2345e05433ee76066715aa028648e5a0febb00740dd9e9fe915c9cda990786bcbb1\", \"status_message\": \"Success, transaction is found\", \"transaction_id\": \"7a6ee250-e71b-4022-a8b8-64b095373957\", \"transaction_time\": \"2025-12-23 14:24:53\", \"transaction_status\": \"pending\"}', '2025-12-23 07:24:55', '2025-12-23 07:24:55', '2025-12-23 07:24:55'),
(20, '2389d6eb-4cf0-4398-9ee4-bed22ba01dce', 'ORD-1766475942-1014', 'pending', '{\"currency\": \"IDR\", \"order_id\": \"ORD-1766475942-1014\", \"va_numbers\": [{\"bank\": \"bca\", \"va_number\": \"58343117660540355314316\"}], \"expiry_time\": \"2025-12-24 14:45:43\", \"merchant_id\": \"G782558343\", \"status_code\": \"201\", \"fraud_status\": \"accept\", \"gross_amount\": \"133200.00\", \"payment_type\": \"bank_transfer\", \"signature_key\": \"9587e850d6471c5daae8c9cda8ca63df3e296073843a64c9b0d2b617c4110041c4ce66851224100085ff4dc5a43aae416979e4e4153e4569b3f8c2120828d032\", \"status_message\": \"Success, transaction is found\", \"transaction_id\": \"2389d6eb-4cf0-4398-9ee4-bed22ba01dce\", \"payment_amounts\": [], \"transaction_time\": \"2025-12-23 14:45:55\", \"transaction_status\": \"pending\"}', '2025-12-23 07:45:56', '2025-12-23 07:45:56', '2025-12-23 07:45:56'),
(21, '2389d6eb-4cf0-4398-9ee4-bed22ba01dce', 'ORD-1766475942-1014', 'settlement', '{\"currency\": \"IDR\", \"order_id\": \"ORD-1766475942-1014\", \"va_numbers\": [{\"bank\": \"bca\", \"va_number\": \"58343117660540355314316\"}], \"expiry_time\": \"2025-12-24 14:45:43\", \"merchant_id\": \"G782558343\", \"status_code\": \"200\", \"fraud_status\": \"accept\", \"gross_amount\": \"133200.00\", \"payment_type\": \"bank_transfer\", \"signature_key\": \"0c84155bbcd2aae42f41ddc17d9c296bb9765ccddf93a4315d958e9cf3a9a67158e145068bf9769ca06f84f124d5dca6d3919cdf3980b80a5d1087fd91fb44b2\", \"status_message\": \"Success, transaction is found\", \"transaction_id\": \"2389d6eb-4cf0-4398-9ee4-bed22ba01dce\", \"payment_amounts\": [], \"settlement_time\": \"2025-12-23 14:46:17\", \"transaction_time\": \"2025-12-23 14:45:55\", \"transaction_status\": \"settlement\"}', '2025-12-23 07:46:17', '2025-12-23 07:46:17', '2025-12-23 07:46:17'),
(22, '299a0e7b-ed5a-4076-993c-d48c4e3c2d86', 'ORD-1767280934-2300', 'pending', '{\"currency\": \"IDR\", \"order_id\": \"ORD-1767280934-2300\", \"va_numbers\": [{\"bank\": \"bca\", \"va_number\": \"58343405301279431164415\"}], \"expiry_time\": \"2026-01-02 22:22:17\", \"merchant_id\": \"G782558343\", \"status_code\": \"201\", \"fraud_status\": \"accept\", \"gross_amount\": \"33300.00\", \"payment_type\": \"bank_transfer\", \"signature_key\": \"96769af5ee9e5acc167c69037ecd39e987affa06b6171c6f655c414c68a35a42a412e895c0d56cb4af242f19c86d4c07bfcd01a1e9158635cf4a2936317b0d4b\", \"status_message\": \"Success, transaction is found\", \"transaction_id\": \"299a0e7b-ed5a-4076-993c-d48c4e3c2d86\", \"payment_amounts\": [], \"transaction_time\": \"2026-01-01 22:22:50\", \"transaction_status\": \"pending\"}', '2026-01-01 15:22:44', '2026-01-01 15:22:44', '2026-01-01 15:22:44'),
(23, '299a0e7b-ed5a-4076-993c-d48c4e3c2d86', 'ORD-1767280934-2300', 'settlement', '{\"currency\": \"IDR\", \"order_id\": \"ORD-1767280934-2300\", \"va_numbers\": [{\"bank\": \"bca\", \"va_number\": \"58343405301279431164415\"}], \"expiry_time\": \"2026-01-02 22:22:17\", \"merchant_id\": \"G782558343\", \"status_code\": \"200\", \"fraud_status\": \"accept\", \"gross_amount\": \"33300.00\", \"payment_type\": \"bank_transfer\", \"signature_key\": \"b807a95fdebaabc0966836eb09c2be45cc059aa79590b968a165497a18ff65923797488e2adba5cbde8a378db3965977f865fbc555a9b2523f3929a5741108e1\", \"status_message\": \"Success, transaction is found\", \"transaction_id\": \"299a0e7b-ed5a-4076-993c-d48c4e3c2d86\", \"payment_amounts\": [], \"settlement_time\": \"2026-01-01 22:22:58\", \"transaction_time\": \"2026-01-01 22:22:50\", \"transaction_status\": \"settlement\"}', '2026-01-01 15:22:51', '2026-01-01 15:22:51', '2026-01-01 15:22:51'),
(24, '909ea8c1-3dc5-4d29-899d-4e8984b3e162', 'ORD-1767591597-4028', 'pending', '{\"currency\": \"IDR\", \"order_id\": \"ORD-1767591597-4028\", \"va_numbers\": [{\"bank\": \"bca\", \"va_number\": \"58343377976903079179046\"}], \"expiry_time\": \"2026-01-06 12:39:59\", \"merchant_id\": \"G782558343\", \"status_code\": \"201\", \"fraud_status\": \"accept\", \"gross_amount\": \"1831500.00\", \"payment_type\": \"bank_transfer\", \"signature_key\": \"14215728af94d1615a15ae003c1becf49c604a6f7b593027d395717edc86d1a2b0c1327907f9c6b9b8d9153a909d7ad19e056f5c5afd3785ee094b66dee0ce3a\", \"status_message\": \"Success, transaction is found\", \"transaction_id\": \"909ea8c1-3dc5-4d29-899d-4e8984b3e162\", \"payment_amounts\": [], \"transaction_time\": \"2026-01-05 12:41:01\", \"transaction_status\": \"pending\"}', '2026-01-05 05:40:51', '2026-01-05 05:40:51', '2026-01-05 05:40:51'),
(25, '909ea8c1-3dc5-4d29-899d-4e8984b3e162', 'ORD-1767591597-4028', 'settlement', '{\"currency\": \"IDR\", \"order_id\": \"ORD-1767591597-4028\", \"va_numbers\": [{\"bank\": \"bca\", \"va_number\": \"58343377976903079179046\"}], \"expiry_time\": \"2026-01-06 12:39:59\", \"merchant_id\": \"G782558343\", \"status_code\": \"200\", \"fraud_status\": \"accept\", \"gross_amount\": \"1831500.00\", \"payment_type\": \"bank_transfer\", \"signature_key\": \"603f50a410665768d6699a6fdb26506bef32af7a540b51de319b664e2467cf7d2ad64db94464df6cb7cc146b899ee7346d0b36093cc870c87948c21841680463\", \"status_message\": \"Success, transaction is found\", \"transaction_id\": \"909ea8c1-3dc5-4d29-899d-4e8984b3e162\", \"payment_amounts\": [], \"settlement_time\": \"2026-01-05 12:41:12\", \"transaction_time\": \"2026-01-05 12:41:01\", \"transaction_status\": \"settlement\"}', '2026-01-05 05:41:02', '2026-01-05 05:41:02', '2026-01-05 05:41:02'),
(26, 'a4344985-83b5-4ac5-bb76-22b9c6f8c62e', 'ORD-1767592869-8229', 'pending', '{\"currency\": \"IDR\", \"order_id\": \"ORD-1767592869-8229\", \"va_numbers\": [{\"bank\": \"bca\", \"va_number\": \"58343111376862326986407\"}], \"expiry_time\": \"2026-01-06 13:01:11\", \"merchant_id\": \"G782558343\", \"status_code\": \"201\", \"fraud_status\": \"accept\", \"gross_amount\": \"22200000.00\", \"payment_type\": \"bank_transfer\", \"signature_key\": \"5af39d671dae21cc1f0ebad58faa4cc854a82264accc2ac1558f37c167fbbf6891ff93b3109c9a1009a18a92a95b37aa7fce8a199d0a7b9bde3f13a6525ad560\", \"status_message\": \"Success, transaction is found\", \"transaction_id\": \"a4344985-83b5-4ac5-bb76-22b9c6f8c62e\", \"payment_amounts\": [], \"transaction_time\": \"2026-01-05 13:01:55\", \"transaction_status\": \"pending\"}', '2026-01-05 06:01:45', '2026-01-05 06:01:45', '2026-01-05 06:01:45'),
(27, 'a4344985-83b5-4ac5-bb76-22b9c6f8c62e', 'ORD-1767592869-8229', 'settlement', '{\"currency\": \"IDR\", \"order_id\": \"ORD-1767592869-8229\", \"va_numbers\": [{\"bank\": \"bca\", \"va_number\": \"58343111376862326986407\"}], \"expiry_time\": \"2026-01-06 13:01:11\", \"merchant_id\": \"G782558343\", \"status_code\": \"200\", \"fraud_status\": \"accept\", \"gross_amount\": \"22200000.00\", \"payment_type\": \"bank_transfer\", \"signature_key\": \"ede466978f5d2ad62e75d5850061d633ede1ab3c9a44825654faa4feea0c961f18c526b834d1ae1eec57088b38a27b95f3570e6fef6964ff10b4e98a5ee0dbb4\", \"status_message\": \"Success, transaction is found\", \"transaction_id\": \"a4344985-83b5-4ac5-bb76-22b9c6f8c62e\", \"payment_amounts\": [], \"settlement_time\": \"2026-01-05 13:02:28\", \"transaction_time\": \"2026-01-05 13:01:55\", \"transaction_status\": \"settlement\"}', '2026-01-05 06:02:18', '2026-01-05 06:02:18', '2026-01-05 06:02:18');

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
(4, '2025_10_10_164005_create_notifikasi_table', 1),
(5, '2025_10_10_164015_create_kategori_table', 1),
(6, '2025_10_10_164021_create_ukuran_table', 1),
(7, '2025_10_10_164033_create_produk_table', 1),
(8, '2025_10_10_164040_create_foto_produk_table', 1),
(9, '2025_10_10_164046_create_detail_tanaman_table', 1),
(10, '2025_10_10_164051_create_petunjuk_perawatan_table', 1),
(11, '2025_10_10_164056_produk_ukuran', 1),
(12, '2025_10_10_164057_create_keranjang_table', 1),
(13, '2025_10_10_164104_create_pesanan_table', 1),
(14, '2025_10_10_164111_create_pesanan_item_table', 1),
(15, '2025_10_15_153757_create_password_reset_tokens_table', 1),
(16, '2025_11_12_202559_create_review_table', 1),
(17, '2025_12_05_230006_create_admin_orders_table', 1),
(18, '2025_12_19_074912_create_midtrans_notification_logs_table', 1),
(19, '2025_12_22_122707_create_sensor_data_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id_notifikasi` bigint UNSIGNED NOT NULL,
  `id_users` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pesan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('belum_dibaca','dibaca') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'belum_dibaca',
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
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` bigint UNSIGNED NOT NULL,
  `id_users` bigint UNSIGNED NOT NULL,
  `nama_penerima` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_penerima` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telepon_penerima` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtotal` decimal(10,2) NOT NULL DEFAULT '0.00',
  `pajak` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total_harga` decimal(10,2) NOT NULL,
  `status` enum('menunggu','diproses','dikirim','selesai','dibatalkan','dibayar') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'menunggu',
  `stock_updated_at` timestamp NULL DEFAULT NULL,
  `last_notification_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metode_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `va_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_pesanan` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `alamat_pengiriman` text COLLATE utf8mb4_unicode_ci,
  `snap_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kode_pesanan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `id_users`, `nama_penerima`, `email_penerima`, `telepon_penerima`, `subtotal`, `pajak`, `total_harga`, `status`, `stock_updated_at`, `last_notification_id`, `metode_pembayaran`, `bank`, `va_number`, `tanggal_pesanan`, `alamat_pengiriman`, `snap_token`, `created_at`, `updated_at`, `kode_pesanan`) VALUES
(1, 8, 'Tino Nurcahya', 'tinonurcahya.msi@gmail.com', '081934004614', 30000.00, 3300.00, 33300.00, 'menunggu', NULL, NULL, 'midtrans', NULL, NULL, '2025-12-22 15:59:47', 'arahan0461404614, Indramayu 04614', 'd876c784-4536-4d66-9790-40a1b20e8cb0', '2025-12-22 08:59:47', '2025-12-22 15:30:28', 'ORD-1766393987-9808'),
(2, 8, 'Tino Nurcahya', 'tinonurcahya.msi@gmail.com', '0812112121212', 30000.00, 3300.00, 33300.00, 'selesai', '2025-12-22 09:34:07', '99193ed8-f597-449b-951b-15172e2756f5', 'bank_transfer', 'bca', '58343604789979778165012', '2025-12-22 16:32:59', 'jalan mawar no3, Indramayu 212121', 'b13dab3b-9505-4240-aa7b-a3866f64f9ae', '2025-12-22 09:32:59', '2025-12-22 09:34:07', 'ORD-1766395979-7548'),
(3, 8, 'Tino Nurcahya', 'tinonurcahya.msi@gmail.com', '01234568787', 30000.00, 3300.00, 33300.00, 'selesai', '2025-12-22 12:00:18', '4d932771-5680-468f-8772-43e1b2544907', 'bank_transfer', 'bca', '58343449811301290668781', '2025-12-22 19:00:05', 'jalan mawar no 3, Indramayu 12121', 'a1a15c1b-67e9-4ab5-844b-7f14c2bad8bf', '2025-12-22 12:00:05', '2025-12-22 12:21:26', 'ORD-1766404805-5309'),
(4, 8, 'Tino Nurcahya', 'tinonurcahya.msi@gmail.com', '08123456787', 30000.00, 3300.00, 33300.00, 'selesai', '2025-12-22 12:01:49', '797ed3f4-cfce-459a-9c7b-9dd6e1be48b3', 'bank_transfer', 'bca', '58343428743849043648065', '2025-12-22 19:01:37', 'jalan mawar no 3, Indramayu 12121', 'ca085aeb-6925-4b9c-a0bc-4b7bf0695d78', '2025-12-22 12:01:37', '2025-12-22 12:01:49', 'ORD-1766404897-9248'),
(5, 8, 'Tino Nurcahya', 'tinonurcahya.msi@gmail.com', '08123456787', 30000.00, 3300.00, 33300.00, 'selesai', '2025-12-22 12:07:06', 'f1dc69f5-8a02-4dac-817c-b6f2255ef457', 'bank_transfer', 'bca', '58343246845754778456017', '2025-12-22 19:06:51', 'jalan mawar no 3, Indramayu 12121', '28d9b2d3-191a-4ad7-9464-a6a18d76b2f0', '2025-12-22 12:06:51', '2025-12-22 12:07:06', 'ORD-1766405211-7005'),
(6, 8, 'Tino Nurcahya', 'tinonurcahya.msi@gmail.com', '08123456787', 30000.00, 3300.00, 33300.00, 'diproses', '2025-12-22 12:20:39', '234e2f40-2e69-401a-a9a8-ccf5753bdf21', 'bank_transfer', 'bca', '58343139841713817368759', '2025-12-22 19:20:05', 'jalan mawar no 3, Indramayu 12121', 'e5a34be0-8e5e-4245-8882-19fc9fbb3b9a', '2025-12-22 12:20:05', '2025-12-23 04:53:50', 'ORD-1766406005-1402'),
(7, 8, 'Tino Nurcahya', 'tinonurcahya.msi@gmail.com', '08123456787', 50000.00, 5500.00, 55500.00, 'selesai', '2025-12-23 01:59:02', '46694a2c-1215-43dd-b7c6-a201d86c2967', 'bank_transfer', 'bca', '58343787896904736814292', '2025-12-23 08:58:48', 'jalan mawar no 3, Indramayu 12121', 'f386d2af-fbcd-400a-8961-287426faab1b', '2025-12-23 01:58:48', '2025-12-23 01:59:02', 'ORD-1766455128-3689'),
(8, 8, 'Tino Nurcahya', 'tinonurcahya.msi@gmail.com', '08123456787', 30000.00, 3300.00, 33300.00, 'selesai', '2025-12-23 02:06:14', '610039a8-6cd1-463d-94bd-aee9daab9aab', 'bank_transfer', 'bca', '58343470718295900842193', '2025-12-23 09:06:01', 'jalan mawar no 3, Indramayu 12121', '4967664b-7251-4836-b814-70f8f7e6c265', '2025-12-23 02:06:01', '2025-12-23 02:06:58', 'ORD-1766455561-9520'),
(9, 8, 'Tino Nurcahya', 'tinonurcahya.msi@gmail.com', '08123456787', 60000.00, 6600.00, 66600.00, 'dibayar', '2025-12-23 04:58:36', 'f0e5e06a-eae7-4bca-a1f3-fc9379f3fb06', 'bank_transfer', 'bca', '58343020863653393713652', '2025-12-23 11:58:23', 'jalan mawar no 3, Indramayu 1212', '45b9eba3-5ae5-4e9e-a3d3-0c9297040eb0', '2025-12-23 04:58:23', '2025-12-23 04:58:36', 'ORD-1766465903-7422'),
(10, 8, 'Tino Nurcahya', 'tinonurcahya.msi@gmail.com', '08123456787', 40000.00, 4400.00, 44400.00, 'selesai', NULL, NULL, 'midtrans', NULL, NULL, '2025-12-23 14:04:13', 'jalan mawar no 3, Indramayu 08858', 'a09dbc95-bdb9-40a6-bb05-e582f5e38c24', '2025-12-23 07:04:13', '2026-01-01 15:02:39', 'ORD-1766473453-5643'),
(11, 10, 'Viola Insan Putri', 'violainsanputri@gmail.com', '081234567890', 1200000.00, 132000.00, 1332000.00, 'dibayar', '2025-12-23 07:12:20', 'f95b9072-14e3-4eb2-830e-303da2e29749', 'bank_transfer', 'bca', '58343183838721394757324', '2025-12-23 14:10:56', 'krasak1234, indramayu 45611', '9bd0e96a-c215-419f-b189-51163307b9e3', '2025-12-23 07:10:56', '2025-12-23 07:12:20', 'ORD-1766473856-1309'),
(12, 10, 'Viola Insan Putri', 'violainsanputri@gmail.com', '083148481398', 40000.00, 4400.00, 44400.00, 'dikirim', NULL, NULL, 'qris', NULL, NULL, '2025-12-23 14:24:38', 'Jl.Letnan Joni Blok Pendowo RT.24/RW. 05, Desa Jatibarang Baru, Kec. Jatibarang, Kab. Indramayu,45273, Indramayu 45273', '5d8b25fa-1ce9-43a0-bfab-5351462a36f4', '2025-12-23 07:24:38', '2025-12-25 13:46:39', 'ORD-1766474678-9853'),
(13, 10, 'Viola Insan Putrialim', 'violainsanputri@gmail.com', '12345678910', 120000.00, 13200.00, 133200.00, 'dikirim', '2025-12-23 07:46:17', '2389d6eb-4cf0-4398-9ee4-bed22ba01dce', 'bank_transfer', 'bca', '58343117660540355314316', '2025-12-23 14:45:42', 'cirebonnnn, cirebon 411111', 'c660d0fb-b9c8-427a-8eb0-1bc1d8eaef0b', '2025-12-23 07:45:42', '2025-12-23 08:28:53', 'ORD-1766475942-1014'),
(14, 10, 'Viola Insan Putri', 'violainsanputri@gmail.com', '12345678910', 1300000.00, 143000.00, 1443000.00, 'dikirim', NULL, NULL, 'midtrans', NULL, NULL, '2025-12-23 15:01:30', 'Jl.Letnan Joni Blok Pendowo RT.24/RW. 05, Desa Jatibarang Baru, Kec. Jatibarang, Kab. Indramayu,45273, cirebon 411111', 'b41bdbaa-5ba3-451f-8f39-76678755cada', '2025-12-23 08:01:30', '2025-12-23 08:14:26', 'ORD-1766476890-4909'),
(15, 8, 'Tino Nurcahya', 'tinonurcahya.msi@gmail.com', '08123456787', 30000.00, 3300.00, 33300.00, 'dibayar', '2026-01-01 15:22:51', '299a0e7b-ed5a-4076-993c-d48c4e3c2d86', 'bank_transfer', 'bca', '58343405301279431164415', '2026-01-01 22:22:14', 'jalan mawar no 3, Indramayu 54454', 'b6e3de9a-9e60-42ac-807f-5529a2980167', '2026-01-01 15:22:14', '2026-01-01 15:22:51', 'ORD-1767280934-2300'),
(16, 8, 'Tino Nurcahya', 'tinonurcahya.msi@gmail.com', '08123456787', 1650000.00, 181500.00, 1831500.00, 'dibayar', '2026-01-05 05:41:02', '909ea8c1-3dc5-4d29-899d-4e8984b3e162', 'bank_transfer', 'bca', '58343377976903079179046', '2026-01-05 12:39:57', 'jalan mawar no 3, jepang 1123456', 'f05e685a-b2c8-47aa-a50d-0e54a32453aa', '2026-01-05 05:39:57', '2026-01-05 05:41:02', 'ORD-1767591597-4028'),
(17, 8, 'Tino Nurcahya', 'tinonurcahya.msi@gmail.com', '08123456787', 20000000.00, 2200000.00, 22200000.00, 'selesai', '2026-01-05 06:02:18', 'a4344985-83b5-4ac5-bb76-22b9c6f8c62e', 'bank_transfer', 'bca', '58343111376862326986407', '2026-01-05 13:01:09', 'jalan mawar no 3, kalimantan 1945', 'de4ec11c-1714-4a29-a232-1b5763cc8212', '2026-01-05 06:01:09', '2026-01-05 06:09:03', 'ORD-1767592869-8229');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan_item`
--

CREATE TABLE `pesanan_item` (
  `id_pesanan_item` bigint UNSIGNED NOT NULL,
  `id_pesanan` bigint UNSIGNED NOT NULL,
  `id_produk_ukuran` bigint UNSIGNED NOT NULL,
  `harga_satuan` decimal(10,2) NOT NULL,
  `kuantitas` int NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pesanan_item`
--

INSERT INTO `pesanan_item` (`id_pesanan_item`, `id_pesanan`, `id_produk_ukuran`, `harga_satuan`, `kuantitas`, `subtotal`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 30000.00, 1, 30000.00, '2025-12-22 08:59:47', '2025-12-22 08:59:47'),
(2, 2, 7, 30000.00, 1, 30000.00, '2025-12-22 09:32:59', '2025-12-22 09:32:59'),
(3, 3, 10, 30000.00, 1, 30000.00, '2025-12-22 12:00:05', '2025-12-22 12:00:05'),
(4, 4, 4, 30000.00, 1, 30000.00, '2025-12-22 12:01:37', '2025-12-22 12:01:37'),
(5, 5, 10, 30000.00, 1, 30000.00, '2025-12-22 12:06:51', '2025-12-22 12:06:51'),
(6, 6, 10, 30000.00, 1, 30000.00, '2025-12-22 12:20:05', '2025-12-22 12:20:05'),
(7, 7, 13, 50000.00, 1, 50000.00, '2025-12-23 01:58:48', '2025-12-23 01:58:48'),
(8, 8, 10, 30000.00, 1, 30000.00, '2025-12-23 02:06:01', '2025-12-23 02:06:01'),
(9, 9, 7, 35000.00, 1, 35000.00, '2025-12-23 04:58:23', '2025-12-23 04:58:23'),
(10, 9, 42, 25000.00, 1, 25000.00, '2025-12-23 04:58:23', '2025-12-23 04:58:23'),
(11, 10, 26, 40000.00, 1, 40000.00, '2025-12-23 07:04:13', '2025-12-23 07:04:13'),
(12, 11, 48, 600000.00, 2, 1200000.00, '2025-12-23 07:10:56', '2025-12-23 07:10:56'),
(13, 12, 38, 40000.00, 1, 40000.00, '2025-12-23 07:24:38', '2025-12-23 07:24:38'),
(14, 13, 43, 60000.00, 2, 120000.00, '2025-12-23 07:45:42', '2025-12-23 07:45:42'),
(15, 14, 4, 50000.00, 14, 700000.00, '2025-12-23 08:01:30', '2025-12-23 08:01:30'),
(16, 14, 9, 150000.00, 4, 600000.00, '2025-12-23 08:01:30', '2025-12-23 08:01:30'),
(17, 15, 10, 30000.00, 1, 30000.00, '2026-01-01 15:22:14', '2026-01-01 15:22:14'),
(18, 16, 44, 150000.00, 11, 1650000.00, '2026-01-05 05:39:57', '2026-01-05 05:39:57');

-- --------------------------------------------------------

--
-- Table structure for table `petunjuk_perawatan`
--

CREATE TABLE `petunjuk_perawatan` (
  `id_petunjuk_perawatan` bigint UNSIGNED NOT NULL,
  `id_produk` bigint UNSIGNED NOT NULL,
  `penyiraman` text COLLATE utf8mb4_unicode_ci,
  `cahaya` text COLLATE utf8mb4_unicode_ci,
  `suhu_dan_kelembapan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `petunjuk_perawatan`
--

INSERT INTO `petunjuk_perawatan` (`id_petunjuk_perawatan`, `id_produk`, `penyiraman`, `cahaya`, `suhu_dan_kelembapan`, `created_at`, `updated_at`) VALUES
(1, 1, 'Siram saat bagian atas media tanam (2–3 cm) terasa kering. Jaga agar tanah tetap lembap tetapi tidak basah terus-menerus. Kurangi penyiraman di musim hujan atau suhu rendah.', 'Cahaya terang tidak langsung (indirect bright light) adalah yang terbaik. Dapat beradaptasi di tempat cahaya rendah, tetapi pertumbuhan dan fenestrasi daun akan berkurang. Hindari sinar matahari langsung yang terlalu terik.', 'Suhu: 18–30°C (ideal sekitar 20–25°C).\r\n\r\nKelembapan: Sedang hingga tinggi (50–70%). Toleran dengan kelembapan ruangan biasa, tetapi akan tumbuh lebih subur dengan kelembapan tinggi.', '2025-12-22 07:34:36', '2025-12-23 01:28:13'),
(2, 2, 'Siram secara teratur untuk menjaga media tetap lembap, tetapi pastikan drainase sangat baik. Hindari media tergenang. Kurangi frekuensi di musim hujan.', 'Cahaya terang hingga matahari langsung pagi hari (full sun to partial shade). Di dalam ruangan, tempatkan di dekat jendela dengan sinar matahari langsung yang disaring.', 'Suhu: 20–32°C (tidak tahan suhu dingin di bawah 15°C).\r\n\r\nKelembapan: Tinggi (60–80%). Semprot daun secara rutin jika udara kering.', '2025-12-22 07:34:36', '2025-12-23 01:32:54'),
(3, 3, 'Cukup, tanah lembap tapi tidak basah. Siram saat permukaan tanah kering.', 'Sinar matahari penuh (minimal 6 jam/hari).', '18-28°C (suhu ruang sedang), dan Kelembapan: Sedang (50-70%).', '2025-12-22 07:34:36', '2025-12-23 01:19:13'),
(4, 4, 'Disiram 1 kali per 10-14 hari, hindari tanah terlalu lembap.', 'Butuh sinar matahari penuh setidaknya 6 jam sehari.', 'Suhu 25–35°C, kelembapan rendah.', '2025-12-22 07:34:36', '2025-12-22 07:34:36'),
(5, 5, 'Siram saat media tanam hampir kering (sekali 2–3 hari). Jangan biarkan tergenang.', 'Cahaya terang tidak langsung (indirect bright light). Hindari sinar matahari langsung.', 'Suhu: 18–28°C | Kelembapan: Tinggi (60–80%).', '2025-12-22 07:34:36', '2025-12-23 01:25:08'),
(6, 6, 'Siram hanya saat media tanah benar-benar kering (bisa 2–3 minggu sekali). Sangat tahan kekeringan, lebih takut kelebihan air.', 'Bisa hidup di cahaya rendah hingga terang tidak langsung. Toleran terhadap sinar matahari langsung yang tidak terlalu intens, tetapi warna daun bisa memudar jika terlalu terik.', 'Suhu: 18–30°C (tahan suhu ruang normal).\r\n\r\nKelembapan: Rendah hingga sedang (30–50%). Tidak membutuhkan kelembapan tinggi.', '2025-12-23 02:14:04', '2025-12-23 02:14:04'),
(7, 7, 'Siram saat permukaan tanah mulai kering. Gunakan air bersuhu ruang. Jika tanaman layu, siram dan akan segar kembali dalam beberapa jam. Jangan biarkan tergenang.', 'Cahaya terang tidak langsung optimal untuk pertumbuhan dan pembungaan. Bisa beradaptasi di tempat teduh, tetapi bunga mungkin lebih sedikit. Hindari sinar matahari langsung.', 'Suhu: 18–28°C (hindari suhu di bawah 15°C).\r\n\r\nKelembapan: Sedang hingga tinggi (50–70%). Semprot daun atau letakkan di nampan kerikil berair jika udara kering.', '2025-12-23 02:19:56', '2025-12-23 02:19:56'),
(8, 8, 'Siram saat permukaan tanah terasa kering. Aglaonema lebih toleran terhadap kekeringan daripada kelebihan air. Pastikan pot memiliki drainase baik.', 'Cahaya rendah hingga terang tidak langsung. Warna daun akan lebih cerah di cahaya terang, tetapi hindari sinar matahari langsung agar daun tidak terbakar.', 'Suhu: 20–30°C (hindari suhu di bawah 15°C dan angin dingin).\r\n\r\nKelembapan: Sedang hingga tinggi (50–70%). Semprot daun secara berkala jika udara kering.', '2025-12-23 02:25:52', '2025-12-23 02:25:52'),
(9, 9, 'Siram saat permukaan tanah kering. Tahan kekeringan, tetapi pertumbuhan optimal dengan media lembap (tidak basah).', 'Cahaya rendah hingga terang tidak langsung. Variegasi daun akan lebih cerah di cahaya terang, tetapi hindari sinar matahari langsung.', 'Suhu: 18–30°C (tahan suhu ruang normal).\r\n\r\nKelembapan: Sedang (40–60%). Dapat beradaptasi di kelembapan rendah.', '2025-12-23 02:29:23', '2025-12-23 02:29:23'),
(10, 10, 'Siram secara teratur untuk menjaga media tetap lembap (tidak basah). Gunakan air suling atau air hujan jika air keran berkapur, karena Calathea sensitif terhadap fluoride', 'Cahaya terang tidak langsung. Hindari sinar matahari langsung agar daun tidak terbakar. Bisa bertahan di tempat teduh, tetapi pola daun mungkin kurang jelas.', 'Suhu: 18–25°C (hindari suhu di bawah 15°C dan fluktuasi ekstrem).\r\n\r\nKelembapan: Tinggi (60–80%). Semprot daun rutin atau gunakan pelembap udara jika di ruangan kering.', '2025-12-23 02:36:00', '2025-12-23 02:36:00'),
(11, 11, 'Siram saat permukaan media terasa kering. Jaga kelembapan media saat musim pertumbuhan, kurangi penyiraman setelah bunga rontok.', 'Cahaya terang tidak langsung. Hindari matahari langsung berlebihan agar batang tidak menguning. Untuk memicu pembungaan, butuh periode \"hari pendek\" (12–14 jam gelap per hari selama beberapa minggu).', 'Suhu: 18–24°C (suhu lebih sejuk di malam hari membantu pembungaan).\r\n\r\nKelembapan: Sedang hingga tinggi (50–70%). Semprot ringan jika udara sangat kering.', '2025-12-23 02:54:35', '2025-12-23 02:54:35'),
(12, 12, 'Siram saat media setengah kering. Gunakan air yang tidak berkapur. Pastikan media porous dan drainase sangat baik.', 'Cahaya terang tidak langsung (hindari sinar matahari langsung). Daun bisa terbakar jika terlalu terik.', 'Suhu: 20–28°C (stabil, hindari perubahan ekstrem).\r\n\r\nKelembapan: Tinggi (70–85%). Wajib disemprot rutin atau diletakkan di ruangan lembap/tray kerikil basah.', '2025-12-23 02:58:33', '2025-12-23 02:58:33');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` bigint UNSIGNED NOT NULL,
  `id_kategori` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_utama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `terjual` int NOT NULL DEFAULT '0',
  `rating` decimal(3,2) NOT NULL DEFAULT '0.00',
  `jumlah_rating` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori`, `nama`, `foto_utama`, `deskripsi`, `terjual`, `rating`, `jumlah_rating`, `created_at`, `updated_at`) VALUES
(1, 1, 'Janda Bolong', 'images/products/monstera.jpg', 'Monstera Deliciosa adalah tanaman hias daun ikonis yang sangat populer berkat bentuk daunnya yang unik, besar, berwarna hijau gelap mengilap, dan memiliki fenestrations (lubang alami) serta belahan yang dramatis. \r\n\r\nTanaman ini memberikan nuansa tropis, modern, dan estetis yang kuat untuk segala jenis interior. Mudah dirawat dan tumbuh dengan cepat, cocok untuk pemula maupun kolektor. \r\n\r\nDapat ditanam dalam pot biasa atau dengan tiang moss pole untuk mendukung pertumbuhan vertikal yang lebih rapi dan maksimal.', 0, 0.00, 0, '2025-12-22 07:34:36', '2025-12-23 02:40:45'),
(2, 2, 'Palem Kipas', 'images/products/palem-kipas.jpg', 'Palem Kipas adalah tanaman hias yang sangat elegan dan memiliki daya tarik visual kuat berkat bentuk daunnya yang unik menyerupai kipas bundar, bergerigi halus di tepian, dan bertekstur seperti kertas berlipat. \r\n\r\nWarna hijaunya segar dan cerah, memberikan kesan tropis yang kuat namun tetap klasik. Cocok sebagai focal point di taman tropis, teras, atau interior luas dengan pencahayaan alami maksimal. \r\n\r\nPertumbuhannya lambat, sehingga cocok untuk penempatan jangka panjang tanpa perubahan bentuk yang drastis.', 1, 0.00, 0, '2025-12-22 07:34:36', '2025-12-23 02:41:07'),
(3, 2, 'Mawar Merah', 'images/products/mawar-merah.jpg', 'Mawar Merah Segar - Simbol Cinta & Keindahan Abadi untuk Setiap Momen Spesial!\r\n\r\nHadirkan kehangatan dan pesona dengan Mawar Merah, bunga legendaris yang selalu menjadi pilihan utama untuk mengungkapkan perasaan terdalam. Cocok untuk hadiah romantis, dekorasi acara, atau sekadar menghiasi rumah dengan keindahan alam.\r\n\r\n🌹 KEUNGGULAN PRODUK:\r\n\r\nBunga Segar Premium: Dipetik dari kebun pilihan, dengan kelopak utuh, warna merah merona menyala, dan batang kuat.\r\n\r\nSimbolik Penuh Makna: Lambang cinta sejati, kekaguman, dan penghargaan yang tak terlukiskan dengan kata-kata.\r\n\r\nKesegaran Terjaga: Dikirim dalam kondisi segar dengan proses hydration sebelum pengiriman agar tahan lebih lama.\r\n\r\nSiap Pakai & Multi Fungsi: Siap dijadikan buket, dekorasi meja, rangkaian bunga, atau hadiah langsung dalam kemasan eksklusif.\r\n\r\nSetiap Tangkai Diseleksi: Hanya bunga dengan kualitas terbaik (ukuran, warna, dan kondisi) yang akan dikirimkan untuk Anda.', 2, 4.50, 2, '2025-12-22 07:34:36', '2025-12-23 01:19:13'),
(4, 2, 'Coleus', 'images/products/coleus.jpg', 'Coleus - Tanaman Hias Daun Warna-Warni, Penghias Rumah & Taman Anda!\r\n\r\nTemukan keindahan yang hidup dengan Coleus, tanaman hias daun yang memukau dengan corak dan warna daun yang sangat ekspresif! Cocok untuk mempercantik sudut rumah, teras, balkon, atau sebagai aksen warna di taman.\r\n\r\n✨ KEUNGGULAN PRODUK:\r\n\r\nWarna & Corak Memukau: Kombinasi warna merah, ungu, hijau, kuning, dan pink dalam pola yang unik di setiap helai daun. Setiap tanaman seperti lukisan alam!\r\n\r\nPerawatan Mudah: Tanaman yang sangat adaptif dan tidak rewel. Cocok untuk pemula maupun kolektor tanaman.\r\n\r\nTumbuh Cepat & Rimbun: Dapat dipangkas secara rutin untuk merangsang percabangan, sehingga tanaman semakin lebat dan indah.\r\n\r\nMulti Fungsi: Bisa ditanam di pot dalam ruangan (indoor) dengan cahaya cukup, di pot gantung (hanging plant), atau langsung di tanah sebagai border atau pengisi taman.\r\n\r\nTanaman Siap Hias: Sudah tumbuh sehat dan rimbun, langsung bisa dipajang untuk memperindah sudut favorit Anda.', 5, 5.00, 3, '2025-12-22 07:34:36', '2025-12-23 02:07:25'),
(5, 1, 'Gelombang Cinta', 'images/products/gelombang-cinta.jpg', 'Gelombang Cinta adalah tanaman hias eksklusif yang menjadi idaman para kolektor berkat keindahan daunnya yang dramatis. Setiap helai daunnya besar, tebal, dan kokoh, dengan permukaan bergelombang alami menyerupai kerutan kain sutra. Warna hijau tua yang pekat dan mengilap menambah kesan elegan dan mewah. Corak tulang daun yang menonjol dan simetris semakin mempertegas karakter tanaman ini.\r\n\r\nSebagai statement piece, Gelombang Cinta sangat cocok menjadi titik fokus di ruang tamu, sudut kerja, atau area penerimaan. Perawatannya cukup mudah asalkan kebutuhan dasar cahaya dan kelembapannya terpenuhi. Tanaman ini tumbuh lambat namun stabil, menjadikannya investasi jangka panjang yang bernilai baik secara estetika maupun kebanggaan koleksi. Keunikan setiap daunnya menjadikan setiap tanaman berbeda dan spesial.', 1, 5.00, 1, '2025-12-22 07:34:36', '2025-12-23 01:59:46'),
(6, 1, 'Lidah Mertua', 'images/products/1766456043_Joq3O8RHja.jpg', 'Lidah Mertua adalah tanaman hias yang sangat tangguh dan mudah dirawat, cocok untuk pemula atau mereka yang sering lupa menyiram. \r\n\r\nDaunnya yang tebal, tegak, dengan pola lurik hijau dan kuning memberikan kesan modern dan minimalis. \r\n\r\nSelain cantik, tanaman ini dikenal sebagai pembersih udara alami yang efektif menyerap polutan. Tahan dalam berbagai kondisi cahaya dan bisa hidup lama dengan perawatan minimal.', 0, 0.00, 0, '2025-12-23 02:14:03', '2025-12-23 02:40:21'),
(7, 1, 'Peace Lily', 'images/products/1766456396_09iiIoHcMa.jpg', 'Peace Lily adalah tanaman hias populer yang dikenal dengan bunga putih elegannya yang kontras dengan daun hijau gelap mengilap. \r\n\r\nSelain penampilannya yang cantik dan cocok untuk dekorasi rumah atau kantor, tanaman ini juga termasuk pembersih udara alami yang efektif. \r\n\r\nPeace Lily mudah berbunga secara berkala sepanjang tahun dengan perawatan yang tepat. Tanaman ini juga mengirimkan “sinyal” saat butuh air dengan cara melayu, sehingga sangat ramah untuk pemula.', 0, 2.00, 1, '2025-12-23 02:19:56', '2026-01-05 05:44:31'),
(8, 1, 'Aglaonema Sri Rezeki', 'images/products/1766456752_hDW3aORSjF.jpg', 'Aglaonema Sri Rezeki adalah tanaman hias daun yang sangat populer karena pola warna daunnya yang cantik dan beragam, serta perawatannya yang mudah.\r\n\r\nTersedia dalam berbagai varian, setiap jenis menawarkan kombinasi warna unik mulai dari hijau dengan bercak silver, pinggiran merah, hingga corak pink. \r\n\r\nTanaman ini tumbuh kompak, cocok sebagai penghias meja, rak, atau sudut ruangan yang sedikit cahaya. Selain mempercantik ruangan, Aglaonema juga dikenal dapat membantu menyaring udara.', 0, 0.00, 0, '2025-12-23 02:25:52', '2025-12-23 02:38:57'),
(9, 1, 'Sirih Gading', 'images/products/1766456963_Jwa81IvLFJ.png', 'Sirih Gading adalah tanaman hias merambat yang sangat mudah dirawat dan cepat tumbuh, cocok untuk pemula. \r\n\r\nDaunnya berbentuk hati dengan corak variegasi kuning atau putih yang cerah, memberikan sentuhan segar dan hidup pada ruangan. \r\n\r\nTanaman ini dapat ditanam dalam pot gantung sehingga batangnya menjuntai indah, atau dibiarkan merambat pada dinding, rak, atau moss pole. Sirih Gading juga dikenal sebagai tanaman pembersih udara yang efektif.', 0, 0.00, 0, '2025-12-23 02:29:23', '2025-12-23 02:38:22'),
(10, 1, 'Calathea', 'images/products/1766457360_nmdhZcrv9M.jpg', 'Calathea adalah tanaman hias daun yang memukau dengan pola alami pada daunnya yang menyerupai lukisan seni. \r\n\r\nSetiap jenis Calathea memiliki corak unik, seperti garis-garis, bintik-bintik, atau warna-warna kontras di bagian bawah daun. Yang menarik, daun Calathea bergerak mengikuti cahaya (nyctinasty).\r\n\r\nmengangkat daunnya di malam hari seperti tangan yang sedang berdoa. Cocok sebagai aksen dekoratif yang hidup dan penuh karakter di ruang tamu, kamar tidur, atau kantor.', 0, 0.00, 0, '2025-12-23 02:36:00', '2025-12-23 02:37:20'),
(11, 1, 'Kaktus Natal', 'images/products/1766458475_0H9e7J3mER.jpg', 'Kaktus Natal adalah tanaman hias unik yang berbunga indah di musim penghujan atau hari pendek (biasanya sekitar Desember–Januari). \r\n\r\nBerbeda dengan kaktus gurun, tanaman ini tumbuh di habitat lembap hutan Brasil. Batangnya terdiri dari ruas-ruas pipih yang menjuntai, cocok ditanam di pot gantung. Bunganya muncul di ujung batang, berbentuk tubular dengan warna cerah seperti merah, pink, atau putih, memberikan aksen warna semarak di dalam ruangan.', 14, 0.00, 0, '2025-12-23 02:54:35', '2025-12-23 02:54:35'),
(12, 1, 'Kuping Gajah', 'images/products/1766458713_0bLuMokFLT.jpeg', 'Kuping Gajah adalah tanaman hias daun premium yang sangat digemari kolektor karena keindahan daunnya yang dramatis. \r\n\r\nDaunnya yang lebar berbentuk hati memiliki warna hijau beludru gelap yang kontras dengan urat-urat berwarna putih-perak yang menyerupai kristal. \r\n\r\nSetiap helai daun seperti karya seni hidup yang memancarkan elegan dan kemewahan. Tanaman ini tumbuh lambat tetapi sangat memuaskan untuk dikoleksi, cocok sebagai focal point di ruangan dengan pencahayaan tepat.', 2, 0.00, 0, '2025-12-23 02:58:33', '2025-12-23 02:58:33');

-- --------------------------------------------------------

--
-- Table structure for table `produk_ukuran`
--

CREATE TABLE `produk_ukuran` (
  `id_produk_ukuran` bigint UNSIGNED NOT NULL,
  `id_produk` bigint UNSIGNED NOT NULL,
  `id_ukuran` bigint UNSIGNED NOT NULL,
  `stok` int NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produk_ukuran`
--

INSERT INTO `produk_ukuran` (`id_produk_ukuran`, `id_produk`, `id_ukuran`, `stok`, `harga`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 20, 30000.00, NULL, '2025-12-23 01:38:12'),
(2, 1, 2, 16, 100000.00, NULL, '2025-12-23 01:38:12'),
(3, 1, 3, 17, 300000.00, NULL, '2025-12-23 01:38:12'),
(4, 2, 1, 14, 50000.00, NULL, '2025-12-23 01:32:54'),
(5, 2, 2, 9, 150000.00, NULL, '2025-12-23 01:32:54'),
(6, 2, 3, 5, 400000.00, NULL, '2025-12-23 01:32:54'),
(7, 3, 1, 13, 35000.00, NULL, '2025-12-23 01:20:43'),
(8, 3, 2, 8, 75000.00, NULL, '2025-12-23 01:20:43'),
(9, 3, 3, 4, 150000.00, NULL, '2025-12-23 01:20:43'),
(10, 4, 1, 10, 30000.00, NULL, NULL),
(11, 4, 2, 8, 45000.00, NULL, NULL),
(12, 4, 3, 4, 60000.00, NULL, NULL),
(13, 5, 1, 14, 50000.00, NULL, '2025-12-23 01:25:08'),
(14, 5, 2, 8, 150000.00, NULL, '2025-12-23 01:25:08'),
(15, 5, 3, 4, 400000.00, NULL, '2025-12-23 01:25:08'),
(19, 1, 4, 10, 800000.00, '2025-12-23 01:28:13', '2025-12-23 01:38:12'),
(20, 5, 4, 3, 800000.00, '2025-12-23 01:28:35', '2025-12-23 01:28:35'),
(22, 6, 1, 34, 20000.00, '2025-12-23 02:14:03', '2025-12-23 02:14:39'),
(23, 6, 2, 27, 50000.00, '2025-12-23 02:14:04', '2025-12-23 02:14:39'),
(24, 6, 3, 21, 120000.00, '2025-12-23 02:14:04', '2025-12-23 02:14:39'),
(25, 6, 4, 18, 300000.00, '2025-12-23 02:14:04', '2025-12-23 02:14:39'),
(26, 7, 1, 32, 40000.00, '2025-12-23 02:19:56', '2025-12-23 02:19:56'),
(27, 7, 2, 27, 90000.00, '2025-12-23 02:19:56', '2025-12-23 02:19:56'),
(28, 7, 3, 15, 200000.00, '2025-12-23 02:19:56', '2025-12-23 02:19:56'),
(29, 7, 4, 16, 450000.00, '2025-12-23 02:19:56', '2025-12-23 02:19:56'),
(30, 8, 1, 36, 25000.00, '2025-12-23 02:25:52', '2025-12-23 02:25:52'),
(31, 8, 2, 25, 75000.00, '2025-12-23 02:25:52', '2025-12-23 02:25:52'),
(32, 8, 3, 19, 250000.00, '2025-12-23 02:25:52', '2025-12-23 02:25:52'),
(33, 8, 4, 15, 700000.00, '2025-12-23 02:25:52', '2025-12-23 02:25:52'),
(34, 9, 1, 44, 15000.00, '2025-12-23 02:29:23', '2025-12-23 02:29:23'),
(35, 9, 2, 37, 40000.00, '2025-12-23 02:29:23', '2025-12-23 02:29:23'),
(36, 9, 3, 25, 100000.00, '2025-12-23 02:29:23', '2025-12-23 02:29:23'),
(38, 10, 1, 78, 40000.00, '2025-12-23 02:36:00', '2025-12-23 02:36:00'),
(39, 10, 2, 42, 100000.00, '2025-12-23 02:36:00', '2025-12-23 02:36:00'),
(40, 10, 3, 28, 300000.00, '2025-12-23 02:36:00', '2025-12-23 02:36:00'),
(41, 10, 4, 22, 400000.00, '2025-12-23 02:36:00', '2025-12-23 02:36:00'),
(42, 11, 1, 19, 25000.00, '2025-12-23 02:54:35', '2025-12-23 02:54:35'),
(43, 11, 2, 13, 60000.00, '2025-12-23 02:54:35', '2025-12-23 02:54:35'),
(44, 11, 3, 1, 150000.00, '2025-12-23 02:54:35', '2025-12-23 02:54:35'),
(45, 11, 4, 11, 210000.00, '2025-12-23 02:54:35', '2026-01-05 05:49:08'),
(46, 12, 1, 19, 80000.00, '2025-12-23 02:58:33', '2025-12-23 02:58:33'),
(47, 12, 2, 20, 200000.00, '2025-12-23 02:58:33', '2025-12-23 02:58:33'),
(48, 12, 3, 18, 600000.00, '2025-12-23 02:58:33', '2025-12-23 02:58:33');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id_review` bigint UNSIGNED NOT NULL,
  `id_produk` bigint UNSIGNED NOT NULL,
  `id_users` bigint UNSIGNED NOT NULL,
  `id_pesanan` bigint UNSIGNED DEFAULT NULL,
  `rating` tinyint NOT NULL,
  `komentar` text COLLATE utf8mb4_unicode_ci,
  `tanggal_review` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id_review`, `id_produk`, `id_users`, `id_pesanan`, `rating`, `komentar`, `tanggal_review`, `created_at`, `updated_at`) VALUES
(4, 3, 8, 2, 5, 'oke', '2025-12-22 09:36:08', '2025-12-22 09:36:08', '2025-12-22 09:36:08'),
(5, 4, 8, 5, 5, 'tanamannya sangat bagus', '2025-12-22 12:08:14', '2025-12-22 12:08:14', '2025-12-22 12:08:14'),
(6, 4, 8, 3, 5, 'tanaman ini sangat cantik', '2025-12-22 12:24:05', '2025-12-22 12:24:05', '2025-12-22 12:24:05'),
(7, 5, 8, 7, 5, NULL, '2025-12-23 01:59:46', '2025-12-23 01:59:46', '2025-12-23 01:59:46'),
(8, 4, 8, 8, 5, 'bintang 5', '2025-12-23 02:07:25', '2025-12-23 02:07:25', '2025-12-23 02:07:25'),
(9, 7, 8, 10, 2, 'baguss', '2026-01-05 05:44:31', '2026-01-05 05:44:31', '2026-01-05 05:44:31');

-- --------------------------------------------------------

--
-- Table structure for table `sensor_data`
--

CREATE TABLE `sensor_data` (
  `id` bigint UNSIGNED NOT NULL,
  `suhu` double NOT NULL,
  `kelembaban` double NOT NULL,
  `soil` int NOT NULL,
  `cahaya` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sensor_data`
--

INSERT INTO `sensor_data` (`id`, `suhu`, `kelembaban`, `soil`, `cahaya`, `created_at`, `updated_at`) VALUES
(1, 29, 70, 2500, 800, '2025-12-22 14:08:08', '2025-12-22 14:08:08'),
(2, 30, 89.6, 2582, 10, '2025-12-22 14:51:23', '2025-12-22 14:51:23'),
(3, 30.2, 89.1, 1447, 12, '2025-12-22 15:15:55', '2025-12-22 15:15:55'),
(4, 30.2, 89, 1450, 13, '2025-12-22 15:16:05', '2025-12-22 15:16:05'),
(5, 30.2, 89, 1450, 13, '2025-12-22 15:16:15', '2025-12-22 15:16:15'),
(6, 30.2, 88.9, 1445, 14, '2025-12-22 15:16:25', '2025-12-22 15:16:25'),
(7, 30.2, 89, 1456, 14, '2025-12-22 15:16:35', '2025-12-22 15:16:35'),
(8, 30.1, 89, 1449, 14, '2025-12-22 15:16:44', '2025-12-22 15:16:44'),
(9, 30.1, 89, 1446, 15, '2025-12-22 15:16:54', '2025-12-22 15:16:54'),
(10, 30.1, 89.1, 1453, 15, '2025-12-22 15:17:05', '2025-12-22 15:17:05'),
(11, 30.1, 89.2, 1443, 15, '2025-12-22 15:17:14', '2025-12-22 15:17:14'),
(12, 30.1, 89.2, 1439, 13, '2025-12-22 15:17:25', '2025-12-22 15:17:25'),
(13, 30.1, 89.2, 1449, 8, '2025-12-22 15:17:35', '2025-12-22 15:17:35'),
(14, 30.1, 89.2, 1440, 12, '2025-12-22 15:17:45', '2025-12-22 15:17:45'),
(15, 30.1, 89.2, 1445, 12, '2025-12-22 15:17:55', '2025-12-22 15:17:55'),
(16, 30.1, 89.2, 1445, 12, '2025-12-22 15:18:05', '2025-12-22 15:18:05'),
(17, 30.1, 89.2, 1465, 9, '2025-12-22 15:18:15', '2025-12-22 15:18:15'),
(18, 30.1, 89.3, 1442, 9, '2025-12-22 15:18:24', '2025-12-22 15:18:24'),
(19, 30.1, 89.3, 1442, 12, '2025-12-22 15:18:34', '2025-12-22 15:18:34'),
(20, 30.1, 89.3, 1444, 12, '2025-12-22 15:18:45', '2025-12-22 15:18:45'),
(21, 30.1, 89.4, 1445, 12, '2025-12-22 15:18:55', '2025-12-22 15:18:55'),
(22, 30.1, 89.3, 1443, 12, '2025-12-22 15:19:05', '2025-12-22 15:19:05'),
(23, 30.1, 89.3, 1446, 10, '2025-12-22 15:19:15', '2025-12-22 15:19:15'),
(24, 30, 89.7, 1446, 12, '2025-12-22 15:21:04', '2025-12-22 15:21:04'),
(25, 30, 89.7, 1425, 12, '2025-12-22 15:21:14', '2025-12-22 15:21:14'),
(26, 30, 89.6, 1441, 12, '2025-12-22 15:21:24', '2025-12-22 15:21:24'),
(27, 30, 89.6, 1441, 12, '2025-12-22 15:21:34', '2025-12-22 15:21:34'),
(28, 30.1, 89.6, 1504, 12, '2025-12-22 15:21:45', '2025-12-22 15:21:45'),
(29, 30.1, 89.5, 1455, 12, '2025-12-22 15:21:54', '2025-12-22 15:21:54'),
(30, 30.1, 89.5, 1461, 12, '2025-12-22 15:22:04', '2025-12-22 15:22:04'),
(31, 30.1, 89.5, 1443, 13, '2025-12-22 15:22:14', '2025-12-22 15:22:14'),
(32, 30.1, 89.6, 1417, 13, '2025-12-22 15:22:24', '2025-12-22 15:22:24'),
(33, 30.1, 89.5, 2547, 12, '2025-12-22 15:22:34', '2025-12-22 15:22:34'),
(34, 30.1, 89.5, 2587, 10, '2025-12-22 15:22:44', '2025-12-22 15:22:44'),
(35, 30.1, 89.6, 2559, 12, '2025-12-22 15:22:54', '2025-12-22 15:22:54'),
(36, 30.1, 89.6, 2557, 12, '2025-12-22 15:23:05', '2025-12-22 15:23:05'),
(37, 30.1, 89.6, 2582, 5, '2025-12-22 15:23:15', '2025-12-22 15:23:15'),
(38, 30.1, 89.6, 2601, 7, '2025-12-22 15:23:24', '2025-12-22 15:23:24'),
(39, 30.1, 89.6, 2647, 7, '2025-12-22 15:23:34', '2025-12-22 15:23:34'),
(40, 30.1, 89.6, 2608, 7, '2025-12-22 15:23:44', '2025-12-22 15:23:44'),
(41, 30.1, 89.6, 2559, 10, '2025-12-22 15:23:54', '2025-12-22 15:23:54'),
(42, 30.1, 89.6, 2559, 9, '2025-12-22 15:24:04', '2025-12-22 15:24:04'),
(43, 30.1, 89.6, 2581, 9, '2025-12-22 15:24:14', '2025-12-22 15:24:14'),
(44, 30.1, 89.6, 1377, 9, '2025-12-22 15:24:24', '2025-12-22 15:24:24'),
(45, 30.1, 89.6, 1422, 8, '2025-12-22 15:24:34', '2025-12-22 15:24:34'),
(46, 30.1, 89.6, 1411, 8, '2025-12-22 15:24:44', '2025-12-22 15:24:44'),
(47, 30.1, 89.6, 1421, 8, '2025-12-22 15:24:54', '2025-12-22 15:24:54'),
(48, 30.1, 89.6, 1418, 8, '2025-12-22 15:25:04', '2025-12-22 15:25:04'),
(49, 30.1, 89.6, 1416, 8, '2025-12-22 15:25:14', '2025-12-22 15:25:14'),
(50, 30.1, 89.6, 1385, 8, '2025-12-22 15:25:24', '2025-12-22 15:25:24'),
(51, 30.1, 89.6, 1435, 8, '2025-12-22 15:25:34', '2025-12-22 15:25:34'),
(52, 30.1, 89.6, 1424, 8, '2025-12-22 15:25:44', '2025-12-22 15:25:44'),
(53, 30.1, 89.6, 1434, 8, '2025-12-22 15:25:54', '2025-12-22 15:25:54'),
(54, 30.1, 89.6, 1408, 7, '2025-12-22 15:26:04', '2025-12-22 15:26:04'),
(55, 30.1, 89.6, 1414, 7, '2025-12-22 15:26:14', '2025-12-22 15:26:14'),
(56, 30.1, 89.6, 1399, 8, '2025-12-22 15:26:24', '2025-12-22 15:26:24'),
(57, 30.1, 89.6, 1413, 8, '2025-12-22 15:26:34', '2025-12-22 15:26:34'),
(58, 30.1, 89.6, 1398, 7, '2025-12-22 15:26:44', '2025-12-22 15:26:44'),
(59, 30.1, 89.6, 1405, 8, '2025-12-22 15:26:54', '2025-12-22 15:26:54'),
(60, 30.1, 89.6, 1415, 8, '2025-12-22 15:27:04', '2025-12-22 15:27:04'),
(61, 30.1, 89.6, 1408, 8, '2025-12-22 15:27:14', '2025-12-22 15:27:14'),
(62, 30.1, 89.6, 1409, 8, '2025-12-22 15:27:24', '2025-12-22 15:27:24'),
(63, 30.1, 89.6, 1429, 8, '2025-12-22 15:27:34', '2025-12-22 15:27:34'),
(64, 30.1, 89.6, 1408, 8, '2025-12-22 15:27:44', '2025-12-22 15:27:44'),
(65, 30.1, 89.6, 1426, 8, '2025-12-22 15:27:54', '2025-12-22 15:27:54'),
(66, 30.1, 89.6, 1410, 8, '2025-12-22 15:28:04', '2025-12-22 15:28:04'),
(67, 30.1, 89.6, 1314, 8, '2025-12-22 15:28:14', '2025-12-22 15:28:14'),
(68, 30.1, 89.6, 1406, 8, '2025-12-22 15:28:24', '2025-12-22 15:28:24'),
(69, 30.1, 89.6, 1409, 8, '2025-12-22 15:28:34', '2025-12-22 15:28:34'),
(70, 30.1, 89.6, 1413, 8, '2025-12-22 15:28:44', '2025-12-22 15:28:44'),
(71, 30.1, 89.6, 1413, 7, '2025-12-22 15:28:54', '2025-12-22 15:28:54'),
(72, 30.1, 89.6, 1408, 7, '2025-12-22 15:29:04', '2025-12-22 15:29:04'),
(73, 30.1, 89.6, 1405, 7, '2025-12-22 15:29:14', '2025-12-22 15:29:14'),
(74, 30.1, 89.6, 1421, 7, '2025-12-22 15:29:24', '2025-12-22 15:29:24'),
(75, 30.1, 89.6, 1410, 7, '2025-12-22 15:29:34', '2025-12-22 15:29:34'),
(76, 30.1, 89.6, 1410, 7, '2025-12-22 15:29:44', '2025-12-22 15:29:44'),
(77, 30.1, 89.6, 1420, 7, '2025-12-22 15:29:54', '2025-12-22 15:29:54'),
(78, 30.1, 89.6, 1379, 7, '2025-12-22 15:30:04', '2025-12-22 15:30:04'),
(79, 30.1, 89.6, 1409, 7, '2025-12-22 15:30:14', '2025-12-22 15:30:14'),
(80, 30.1, 89.6, 1399, 7, '2025-12-22 15:30:24', '2025-12-22 15:30:24'),
(81, 30.1, 89.6, 1423, 7, '2025-12-22 15:30:34', '2025-12-22 15:30:34'),
(82, 30.1, 89.6, 1408, 7, '2025-12-22 15:30:44', '2025-12-22 15:30:44'),
(83, 30.1, 89.6, 1413, 7, '2025-12-22 15:30:54', '2025-12-22 15:30:54'),
(84, 30.1, 89.6, 1409, 7, '2025-12-22 15:31:04', '2025-12-22 15:31:04'),
(85, 30.1, 89.6, 1406, 8, '2025-12-22 15:31:14', '2025-12-22 15:31:14'),
(86, 30.1, 89.6, 1339, 12, '2025-12-22 15:31:24', '2025-12-22 15:31:24'),
(87, 30.1, 89.6, 1408, 12, '2025-12-22 15:31:34', '2025-12-22 15:31:34'),
(88, 30.1, 89.6, 1424, 12, '2025-12-22 15:31:44', '2025-12-22 15:31:44'),
(89, 30.1, 89.6, 1401, 12, '2025-12-22 15:31:54', '2025-12-22 15:31:54'),
(90, 30.1, 89.6, 1422, 12, '2025-12-22 15:32:04', '2025-12-22 15:32:04'),
(91, 30.1, 89.6, 1387, 13, '2025-12-22 15:32:14', '2025-12-22 15:32:14'),
(92, 30.1, 89.6, 1424, 13, '2025-12-22 15:32:24', '2025-12-22 15:32:24'),
(93, 30.1, 89.6, 1409, 13, '2025-12-22 15:32:34', '2025-12-22 15:32:34'),
(94, 30.1, 89.6, 1379, 12, '2025-12-22 15:32:44', '2025-12-22 15:32:44'),
(95, 30.1, 89.6, 1406, 12, '2025-12-22 15:32:54', '2025-12-22 15:32:54'),
(96, 30.1, 89.6, 1410, 7, '2025-12-22 15:33:04', '2025-12-22 15:33:04'),
(97, 30.1, 89.6, 1405, 12, '2025-12-22 15:33:14', '2025-12-22 15:33:14'),
(98, 30.1, 89.6, 1409, 7, '2025-12-22 15:33:24', '2025-12-22 15:33:24'),
(99, 30.1, 89.6, 1394, 12, '2025-12-22 15:33:34', '2025-12-22 15:33:34'),
(100, 30.1, 89.6, 1390, 12, '2025-12-22 15:33:44', '2025-12-22 15:33:44'),
(101, 30.1, 89.6, 1372, 11, '2025-12-22 15:33:54', '2025-12-22 15:33:54'),
(102, 30.1, 89.6, 1403, 8, '2025-12-22 15:34:04', '2025-12-22 15:34:04'),
(103, 30.1, 89.6, 1407, 9, '2025-12-22 15:34:14', '2025-12-22 15:34:14'),
(104, 30.1, 89.6, 1399, 9, '2025-12-22 15:34:24', '2025-12-22 15:34:24'),
(105, 30.1, 89.6, 1410, 8, '2025-12-22 15:34:34', '2025-12-22 15:34:34'),
(106, 30.1, 89.6, 1404, 10, '2025-12-22 15:34:44', '2025-12-22 15:34:44'),
(107, 30.1, 89.6, 1409, 10, '2025-12-22 15:34:54', '2025-12-22 15:34:54'),
(108, 30.1, 89.6, 1407, 10, '2025-12-22 15:35:04', '2025-12-22 15:35:04'),
(109, 30.1, 89.6, 1410, 9, '2025-12-22 15:35:14', '2025-12-22 15:35:14'),
(110, 30.1, 89.6, 1428, 9, '2025-12-22 15:35:24', '2025-12-22 15:35:24'),
(111, 30.1, 89.6, 1409, 6, '2025-12-22 15:35:34', '2025-12-22 15:35:34'),
(112, 30.1, 89.6, 1411, 10, '2025-12-22 15:35:44', '2025-12-22 15:35:44'),
(113, 30.1, 89.6, 1408, 10, '2025-12-22 15:35:54', '2025-12-22 15:35:54'),
(114, 30.1, 89.6, 1423, 10, '2025-12-22 15:36:04', '2025-12-22 15:36:04'),
(115, 30.1, 89.6, 1409, 10, '2025-12-22 15:36:14', '2025-12-22 15:36:14'),
(116, 30.1, 89.6, 1395, 10, '2025-12-22 15:36:24', '2025-12-22 15:36:24'),
(117, 30.1, 89.6, 1409, 10, '2025-12-22 15:36:34', '2025-12-22 15:36:34'),
(118, 30.1, 89.6, 1407, 9, '2025-12-22 15:36:44', '2025-12-22 15:36:44'),
(119, 30.1, 89.6, 1406, 0, '2025-12-22 15:36:54', '2025-12-22 15:36:54'),
(120, 30.1, 89.6, 1406, 0, '2025-12-22 15:37:04', '2025-12-22 15:37:04'),
(121, 30.1, 89.6, 1403, 1, '2025-12-22 15:37:14', '2025-12-22 15:37:14'),
(122, 30.1, 89.6, 1407, 5, '2025-12-22 15:37:24', '2025-12-22 15:37:24'),
(123, 30.1, 89.6, 1407, 5, '2025-12-22 15:37:34', '2025-12-22 15:37:34'),
(124, 30.1, 89.6, 1406, 5, '2025-12-22 15:37:44', '2025-12-22 15:37:44'),
(125, 30.1, 89.6, 1408, 5, '2025-12-22 15:37:54', '2025-12-22 15:37:54'),
(126, 30.1, 89.6, 1406, 5, '2025-12-22 15:38:04', '2025-12-22 15:38:04'),
(127, 30.1, 89.6, 1396, 5, '2025-12-22 15:38:14', '2025-12-22 15:38:14'),
(128, 30.1, 89.6, 1392, 6, '2025-12-22 15:38:24', '2025-12-22 15:38:24'),
(129, 30.1, 89.6, 1423, 6, '2025-12-22 15:38:34', '2025-12-22 15:38:34'),
(130, 30.1, 89.6, 1423, 6, '2025-12-22 15:38:44', '2025-12-22 15:38:44'),
(131, 30.1, 89.6, 1404, 3, '2025-12-22 15:38:54', '2025-12-22 15:38:54'),
(132, 30.1, 89.6, 1396, 6, '2025-12-22 15:39:04', '2025-12-22 15:39:04'),
(133, 30.1, 89.6, 1411, 6, '2025-12-22 15:39:14', '2025-12-22 15:39:14'),
(134, 30.1, 89.6, 1411, 6, '2025-12-22 15:39:24', '2025-12-22 15:39:24'),
(135, 30.1, 89.6, 1424, 6, '2025-12-22 15:39:34', '2025-12-22 15:39:34'),
(136, 30.1, 89.6, 1393, 6, '2025-12-22 15:39:44', '2025-12-22 15:39:44'),
(137, 30.1, 89.6, 1407, 6, '2025-12-22 15:39:54', '2025-12-22 15:39:54'),
(138, 30.1, 89.6, 1406, 6, '2025-12-22 15:40:04', '2025-12-22 15:40:04'),
(139, 30.1, 89.6, 1425, 4, '2025-12-22 15:40:14', '2025-12-22 15:40:14'),
(140, 30.1, 89.6, 1405, 5, '2025-12-22 15:40:24', '2025-12-22 15:40:24'),
(141, 30.1, 89.6, 1390, 6, '2025-12-22 15:40:34', '2025-12-22 15:40:34'),
(142, 30.1, 89.6, 1403, 5, '2025-12-22 15:40:44', '2025-12-22 15:40:44'),
(143, 30.1, 89.6, 1435, 5, '2025-12-22 15:40:53', '2025-12-22 15:40:53'),
(144, 30.1, 89.6, 1404, 5, '2025-12-22 15:41:04', '2025-12-22 15:41:04'),
(145, 30.1, 89.6, 1399, 5, '2025-12-22 15:41:14', '2025-12-22 15:41:14'),
(146, 30.1, 89.6, 1406, 5, '2025-12-22 15:41:24', '2025-12-22 15:41:24'),
(147, 30.1, 89.6, 1423, 5, '2025-12-22 15:41:34', '2025-12-22 15:41:34'),
(148, 30.1, 89.6, 1407, 3, '2025-12-22 15:41:44', '2025-12-22 15:41:44'),
(149, 30.1, 89.6, 1415, 3, '2025-12-22 15:41:54', '2025-12-22 15:41:54'),
(150, 30.1, 89.6, 1407, 2, '2025-12-22 15:42:03', '2025-12-22 15:42:03'),
(151, 30.1, 89.6, 1399, 3, '2025-12-22 15:42:14', '2025-12-22 15:42:14'),
(152, 30.1, 89.6, 1408, 3, '2025-12-22 15:42:24', '2025-12-22 15:42:24'),
(153, 30.1, 89.6, 2544, 3, '2025-12-22 15:42:34', '2025-12-22 15:42:34'),
(154, 30.1, 89.6, 2544, 2, '2025-12-22 15:42:44', '2025-12-22 15:42:44'),
(155, 30.1, 89.6, 1723, 3, '2025-12-22 15:42:54', '2025-12-22 15:42:54'),
(156, 30.1, 89.6, 1697, 12, '2025-12-22 15:43:04', '2025-12-22 15:43:04'),
(157, 30.1, 89.6, 1703, 12, '2025-12-22 15:43:14', '2025-12-22 15:43:14'),
(158, 30.1, 89.6, 1705, 12, '2025-12-22 15:43:23', '2025-12-22 15:43:23'),
(159, 30.1, 89.6, 1690, 12, '2025-12-22 15:43:34', '2025-12-22 15:43:34'),
(160, 30.1, 89.6, 1682, 12, '2025-12-22 15:43:44', '2025-12-22 15:43:44'),
(161, 30.1, 89.6, 1667, 12, '2025-12-22 15:43:54', '2025-12-22 15:43:54'),
(162, 30.1, 89.6, 1694, 11, '2025-12-22 15:44:04', '2025-12-22 15:44:04'),
(163, 30.1, 89.6, 1681, 9, '2025-12-22 15:44:14', '2025-12-22 15:44:14'),
(164, 30.1, 89.6, 1664, 12, '2025-12-22 15:44:24', '2025-12-22 15:44:24'),
(165, 30.1, 89.6, 1694, 12, '2025-12-22 15:44:34', '2025-12-22 15:44:34'),
(166, 30.1, 89.6, 1682, 12, '2025-12-22 15:44:44', '2025-12-22 15:44:44'),
(167, 30.1, 89.6, 1680, 9, '2025-12-22 15:44:54', '2025-12-22 15:44:54'),
(168, 30.1, 89.6, 1678, 9, '2025-12-22 15:45:04', '2025-12-22 15:45:04'),
(169, 30.1, 89.6, 1676, 9, '2025-12-22 15:45:14', '2025-12-22 15:45:14'),
(170, 30.1, 89.6, 1670, 9, '2025-12-22 15:45:24', '2025-12-22 15:45:24'),
(171, 30.1, 89.6, 1671, 8, '2025-12-22 15:45:34', '2025-12-22 15:45:34'),
(172, 30.1, 89.6, 1680, 9, '2025-12-22 15:45:44', '2025-12-22 15:45:44'),
(173, 30.1, 89.6, 1670, 9, '2025-12-22 15:45:54', '2025-12-22 15:45:54'),
(174, 30.1, 89.6, 1676, 9, '2025-12-22 15:46:04', '2025-12-22 15:46:04'),
(175, 30.1, 89.6, 1673, 10, '2025-12-22 15:46:14', '2025-12-22 15:46:14'),
(176, 30.1, 89.6, 1671, 10, '2025-12-22 15:46:24', '2025-12-22 15:46:24'),
(177, 30.1, 89.6, 1676, 10, '2025-12-22 15:46:34', '2025-12-22 15:46:34'),
(178, 30.1, 89.6, 1670, 10, '2025-12-22 15:46:44', '2025-12-22 15:46:44'),
(179, 30.1, 89.6, 1668, 9, '2025-12-22 15:46:54', '2025-12-22 15:46:54'),
(180, 30.1, 89.6, 1674, 8, '2025-12-22 15:47:04', '2025-12-22 15:47:04'),
(181, 30.1, 89.6, 1684, 8, '2025-12-22 15:47:14', '2025-12-22 15:47:14'),
(182, 30.1, 89.6, 1655, 8, '2025-12-22 15:47:24', '2025-12-22 15:47:24'),
(183, 30.1, 89.6, 1681, 8, '2025-12-22 15:47:34', '2025-12-22 15:47:34'),
(184, 30.1, 89.6, 1676, 8, '2025-12-22 15:47:44', '2025-12-22 15:47:44'),
(185, 30.1, 89.6, 1670, 8, '2025-12-22 15:47:54', '2025-12-22 15:47:54'),
(186, 30.1, 89.6, 1671, 8, '2025-12-22 15:48:04', '2025-12-22 15:48:04'),
(187, 30.1, 89.6, 1665, 8, '2025-12-22 15:48:14', '2025-12-22 15:48:14'),
(188, 30.1, 89.6, 1669, 8, '2025-12-22 15:48:24', '2025-12-22 15:48:24'),
(189, 30.1, 89.6, 1669, 8, '2025-12-22 15:48:34', '2025-12-22 15:48:34'),
(190, 30.1, 89.6, 1673, 8, '2025-12-22 15:48:44', '2025-12-22 15:48:44'),
(191, 30.1, 89.6, 1664, 8, '2025-12-22 15:48:54', '2025-12-22 15:48:54'),
(192, 30.1, 89.6, 1677, 13, '2025-12-22 15:49:04', '2025-12-22 15:49:04'),
(193, 30.1, 89.6, 1677, 13, '2025-12-22 15:49:14', '2025-12-22 15:49:14'),
(194, 30.1, 89.6, 1675, 13, '2025-12-22 15:49:24', '2025-12-22 15:49:24'),
(195, 30.1, 89.6, 1661, 10, '2025-12-22 15:49:34', '2025-12-22 15:49:34'),
(196, 30.1, 89.6, 1671, 10, '2025-12-22 15:49:44', '2025-12-22 15:49:44'),
(197, 30.1, 89.6, 1680, 9, '2025-12-22 15:49:54', '2025-12-22 15:49:54'),
(198, 30.1, 89.6, 1663, 10, '2025-12-22 15:50:04', '2025-12-22 15:50:04'),
(199, 30.1, 89.6, 1661, 11, '2025-12-22 15:50:14', '2025-12-22 15:50:14'),
(200, 30.1, 89.6, 2540, 10, '2025-12-22 15:50:24', '2025-12-22 15:50:24'),
(201, 0, 0, 2543, 9, '2025-12-22 15:50:37', '2025-12-22 15:50:37'),
(202, 0, 0, 2551, 9, '2025-12-22 15:50:47', '2025-12-22 15:50:47'),
(203, 0, 0, 2554, 13, '2025-12-22 15:50:58', '2025-12-22 15:50:58'),
(204, 0, 0, 1567, 14, '2025-12-22 15:51:07', '2025-12-22 15:51:07'),
(205, 0, 0, 1535, 14, '2025-12-22 15:51:17', '2025-12-22 15:51:17'),
(206, 0, 0, 1563, 14, '2025-12-22 15:51:27', '2025-12-22 15:51:27'),
(207, 0, 0, 1535, 14, '2025-12-22 15:51:37', '2025-12-22 15:51:37'),
(208, 0, 0, 1535, 14, '2025-12-22 15:51:48', '2025-12-22 15:51:48'),
(209, 0, 0, 1535, 14, '2025-12-22 15:51:58', '2025-12-22 15:51:58'),
(210, 0, 0, 1520, 12, '2025-12-22 15:52:08', '2025-12-22 15:52:08'),
(211, 0, 0, 1535, 12, '2025-12-22 15:52:18', '2025-12-22 15:52:18'),
(212, 0, 0, 1434, 12, '2025-12-22 15:52:28', '2025-12-22 15:52:28'),
(213, 0, 0, 1535, 17, '2025-12-22 15:52:37', '2025-12-22 15:52:37'),
(214, 0, 0, 1563, 17, '2025-12-22 15:52:47', '2025-12-22 15:52:47'),
(215, 0, 0, 1535, 17, '2025-12-22 15:52:57', '2025-12-22 15:52:57'),
(216, 0, 0, 1534, 17, '2025-12-22 15:53:07', '2025-12-22 15:53:07'),
(217, 0, 0, 1535, 16, '2025-12-22 15:53:18', '2025-12-22 15:53:18'),
(218, 0, 0, 1535, 16, '2025-12-22 15:53:28', '2025-12-22 15:53:28'),
(219, 0, 0, 1535, 15, '2025-12-22 15:53:37', '2025-12-22 15:53:37'),
(220, 0, 0, 1535, 15, '2025-12-22 15:53:48', '2025-12-22 15:53:48'),
(221, 0, 0, 1535, 15, '2025-12-22 15:53:57', '2025-12-22 15:53:57'),
(222, 0, 0, 1535, 15, '2025-12-22 15:54:07', '2025-12-22 15:54:07'),
(223, 0, 0, 1535, 15, '2025-12-22 15:54:17', '2025-12-22 15:54:17'),
(224, 0, 0, 1558, 15, '2025-12-22 15:54:27', '2025-12-22 15:54:27'),
(225, 0, 0, 1535, 15, '2025-12-22 15:54:37', '2025-12-22 15:54:37'),
(226, 0, 0, 1535, 15, '2025-12-22 15:54:48', '2025-12-22 15:54:48'),
(227, 0, 0, 1555, 15, '2025-12-22 15:54:58', '2025-12-22 15:54:58'),
(228, 0, 0, 1552, 14, '2025-12-22 15:55:08', '2025-12-22 15:55:08'),
(229, 0, 0, 1535, 15, '2025-12-22 15:55:18', '2025-12-22 15:55:18'),
(230, 0, 0, 1531, 16, '2025-12-22 15:55:27', '2025-12-22 15:55:27'),
(231, 0, 0, 1569, 13, '2025-12-22 15:55:37', '2025-12-22 15:55:37'),
(232, 0, 0, 1535, 16, '2025-12-22 15:55:47', '2025-12-22 15:55:47'),
(233, 0, 0, 1601, 12, '2025-12-22 15:55:57', '2025-12-22 15:55:57'),
(234, 0, 0, 1535, 10, '2025-12-22 15:56:08', '2025-12-22 15:56:08'),
(235, 0, 0, 1535, 10, '2025-12-22 15:56:17', '2025-12-22 15:56:17'),
(236, 0, 0, 1535, 10, '2025-12-22 15:56:27', '2025-12-22 15:56:27'),
(237, 0, 0, 1535, 9, '2025-12-22 15:56:38', '2025-12-22 15:56:38'),
(238, 0, 0, 1533, 9, '2025-12-22 15:56:47', '2025-12-22 15:56:47'),
(239, 0, 0, 1535, 9, '2025-12-22 15:56:57', '2025-12-22 15:56:57'),
(240, 0, 0, 1535, 9, '2025-12-22 15:57:07', '2025-12-22 15:57:07'),
(241, 0, 0, 1535, 9, '2025-12-22 15:57:17', '2025-12-22 15:57:17'),
(242, 0, 0, 1570, 9, '2025-12-22 15:57:27', '2025-12-22 15:57:27'),
(243, 0, 0, 1535, 6, '2025-12-22 15:57:38', '2025-12-22 15:57:38'),
(244, 0, 0, 1535, 7, '2025-12-22 15:57:48', '2025-12-22 15:57:48'),
(245, 0, 0, 2590, 8, '2025-12-22 15:57:57', '2025-12-22 15:57:57'),
(246, 0, 0, 2586, -1, '2025-12-22 15:58:08', '2025-12-22 15:58:08'),
(247, 0, 0, 2559, 8, '2025-12-22 15:58:17', '2025-12-22 15:58:17'),
(248, 0, 0, 2517, 17, '2025-12-22 15:58:27', '2025-12-22 15:58:27'),
(249, 0, 0, 2586, 22, '2025-12-22 15:58:37', '2025-12-22 15:58:37'),
(250, 0, 0, 1391, 22, '2025-12-22 15:58:47', '2025-12-22 15:58:47'),
(251, 0, 0, 1383, 22, '2025-12-22 15:58:58', '2025-12-22 15:58:58'),
(252, 0, 0, 1381, 22, '2025-12-22 15:59:07', '2025-12-22 15:59:07'),
(253, 0, 0, 1374, 22, '2025-12-22 15:59:17', '2025-12-22 15:59:17'),
(254, 0, 0, 1392, 22, '2025-12-22 15:59:27', '2025-12-22 15:59:27'),
(255, 0, 0, 1397, 22, '2025-12-22 15:59:37', '2025-12-22 15:59:37'),
(256, 0, 0, 1379, 22, '2025-12-22 15:59:47', '2025-12-22 15:59:47'),
(257, 0, 0, 1366, 22, '2025-12-22 15:59:57', '2025-12-22 15:59:57'),
(258, 0, 0, 1377, 22, '2025-12-22 16:00:07', '2025-12-22 16:00:07'),
(259, 0, 0, 1280, 22, '2025-12-22 16:00:17', '2025-12-22 16:00:17'),
(260, 0, 0, 1395, 22, '2025-12-22 16:00:27', '2025-12-22 16:00:27'),
(261, 0, 0, 1363, 22, '2025-12-22 16:00:37', '2025-12-22 16:00:37'),
(262, 0, 0, 1376, 22, '2025-12-22 16:00:47', '2025-12-22 16:00:47'),
(263, 0, 0, 1367, 22, '2025-12-22 16:00:57', '2025-12-22 16:00:57'),
(264, 0, 0, 1372, 22, '2025-12-22 16:01:07', '2025-12-22 16:01:07'),
(265, 0, 0, 1380, 22, '2025-12-22 16:01:17', '2025-12-22 16:01:17'),
(266, 0, 0, 1376, 22, '2025-12-22 16:01:27', '2025-12-22 16:01:27'),
(267, 0, 0, 1366, 22, '2025-12-22 16:01:37', '2025-12-22 16:01:37'),
(268, 0, 0, 1375, 22, '2025-12-22 16:01:48', '2025-12-22 16:01:48'),
(269, 0, 0, 1371, 22, '2025-12-22 16:01:57', '2025-12-22 16:01:57'),
(270, 0, 0, 1377, 22, '2025-12-22 16:02:07', '2025-12-22 16:02:07'),
(271, 0, 0, 1378, 22, '2025-12-22 16:02:18', '2025-12-22 16:02:18'),
(272, 0, 0, 1371, 22, '2025-12-22 16:02:27', '2025-12-22 16:02:27'),
(273, 0, 0, 1373, 18, '2025-12-22 16:02:37', '2025-12-22 16:02:37'),
(274, 0, 0, 1377, 18, '2025-12-22 16:02:47', '2025-12-22 16:02:47'),
(275, 0, 0, 1381, 12, '2025-12-22 16:02:57', '2025-12-22 16:02:57'),
(276, 0, 0, 1371, 12, '2025-12-22 16:03:07', '2025-12-22 16:03:07'),
(277, 0, 0, 1378, 16, '2025-12-22 16:03:18', '2025-12-22 16:03:18'),
(278, 0, 0, 1379, 15, '2025-12-22 16:03:27', '2025-12-22 16:03:27'),
(279, 0, 0, 1369, 12, '2025-12-22 16:03:37', '2025-12-22 16:03:37'),
(280, 0, 0, 1363, 12, '2025-12-22 16:03:48', '2025-12-22 16:03:48'),
(281, 0, 0, 1345, 12, '2025-12-22 16:03:57', '2025-12-22 16:03:57'),
(282, 0, 0, 1376, 12, '2025-12-22 16:04:07', '2025-12-22 16:04:07'),
(283, 0, 0, 1371, 12, '2025-12-22 16:04:17', '2025-12-22 16:04:17'),
(284, 0, 0, 1370, 12, '2025-12-22 16:04:27', '2025-12-22 16:04:27'),
(285, 0, 0, 1383, 11, '2025-12-22 16:04:37', '2025-12-22 16:04:37'),
(286, 0, 0, 1378, 12, '2025-12-22 16:04:47', '2025-12-22 16:04:47'),
(287, 0, 0, 1330, 12, '2025-12-22 16:04:57', '2025-12-22 16:04:57'),
(288, 0, 0, 1361, 12, '2025-12-22 16:05:07', '2025-12-22 16:05:07'),
(289, 0, 0, 1377, 12, '2025-12-22 16:05:17', '2025-12-22 16:05:17'),
(290, 0, 0, 1370, 14, '2025-12-22 16:05:27', '2025-12-22 16:05:27'),
(291, 0, 0, 1370, 14, '2025-12-22 16:05:37', '2025-12-22 16:05:37'),
(292, 0, 0, 1374, 13, '2025-12-22 16:05:47', '2025-12-22 16:05:47'),
(293, 0, 0, 1360, 15, '2025-12-22 16:05:57', '2025-12-22 16:05:57'),
(294, 0, 0, 1391, 15, '2025-12-22 16:06:07', '2025-12-22 16:06:07'),
(295, 0, 0, 1369, 15, '2025-12-22 16:06:17', '2025-12-22 16:06:17'),
(296, 0, 0, 1373, 15, '2025-12-22 16:06:27', '2025-12-22 16:06:27'),
(297, 0, 0, 1370, 15, '2025-12-22 16:06:37', '2025-12-22 16:06:37'),
(298, 0, 0, 1379, 15, '2025-12-22 16:06:47', '2025-12-22 16:06:47'),
(299, 0, 0, 1369, 15, '2025-12-22 16:06:57', '2025-12-22 16:06:57'),
(300, 0, 0, 1369, 14, '2025-12-22 16:07:07', '2025-12-22 16:07:07'),
(301, 0, 0, 1371, 14, '2025-12-22 16:07:17', '2025-12-22 16:07:17'),
(302, 0, 0, 1390, 14, '2025-12-22 16:07:27', '2025-12-22 16:07:27'),
(303, 0, 0, 1373, 14, '2025-12-22 16:07:37', '2025-12-22 16:07:37'),
(304, 0, 0, 1378, 14, '2025-12-22 16:07:47', '2025-12-22 16:07:47'),
(305, 0, 0, 1376, 14, '2025-12-22 16:07:57', '2025-12-22 16:07:57'),
(306, 0, 0, 1371, 14, '2025-12-22 16:08:07', '2025-12-22 16:08:07'),
(307, 0, 0, 1369, 14, '2025-12-22 16:08:17', '2025-12-22 16:08:17'),
(308, 0, 0, 1369, 14, '2025-12-22 16:08:27', '2025-12-22 16:08:27'),
(309, 0, 0, 1377, 14, '2025-12-22 16:08:37', '2025-12-22 16:08:37'),
(310, 0, 0, 1366, 14, '2025-12-22 16:08:47', '2025-12-22 16:08:47'),
(311, 0, 0, 1369, 11, '2025-12-22 16:08:57', '2025-12-22 16:08:57'),
(312, 0, 0, 1366, 12, '2025-12-22 16:09:07', '2025-12-22 16:09:07'),
(313, 0, 0, 1366, 12, '2025-12-22 16:09:17', '2025-12-22 16:09:17'),
(314, 0, 0, 1371, 12, '2025-12-22 16:09:27', '2025-12-22 16:09:27'),
(315, 0, 0, 1367, 12, '2025-12-22 16:09:37', '2025-12-22 16:09:37'),
(316, 0, 0, 1370, 12, '2025-12-22 16:09:47', '2025-12-22 16:09:47'),
(317, 0, 0, 1367, 12, '2025-12-22 16:09:57', '2025-12-22 16:09:57'),
(318, 0, 0, 1369, 12, '2025-12-22 16:10:07', '2025-12-22 16:10:07'),
(319, 0, 0, 1365, 11, '2025-12-22 16:10:17', '2025-12-22 16:10:17'),
(320, 0, 0, 1369, 11, '2025-12-22 16:10:27', '2025-12-22 16:10:27'),
(321, 0, 0, 1366, 12, '2025-12-22 16:10:37', '2025-12-22 16:10:37'),
(322, 0, 0, 1369, 12, '2025-12-22 16:10:47', '2025-12-22 16:10:47'),
(323, 0, 0, 1372, 11, '2025-12-22 16:10:57', '2025-12-22 16:10:57'),
(324, 0, 0, 1366, 12, '2025-12-22 16:11:07', '2025-12-22 16:11:07'),
(325, 0, 0, 1369, 12, '2025-12-22 16:11:17', '2025-12-22 16:11:17'),
(326, 0, 0, 1365, 11, '2025-12-22 16:11:27', '2025-12-22 16:11:27'),
(327, 0, 0, 1370, 12, '2025-12-22 16:11:37', '2025-12-22 16:11:37'),
(328, 0, 0, 1371, 12, '2025-12-22 16:11:47', '2025-12-22 16:11:47'),
(329, 0, 0, 1367, 12, '2025-12-22 16:11:57', '2025-12-22 16:11:57'),
(330, 0, 0, 1365, 12, '2025-12-22 16:12:07', '2025-12-22 16:12:07'),
(331, 0, 0, 1369, 12, '2025-12-22 16:12:17', '2025-12-22 16:12:17'),
(332, 0, 0, 1367, 12, '2025-12-22 16:12:27', '2025-12-22 16:12:27'),
(333, 0, 0, 1371, 12, '2025-12-22 16:12:37', '2025-12-22 16:12:37'),
(334, 0, 0, 1374, 12, '2025-12-22 16:12:47', '2025-12-22 16:12:47'),
(335, 0, 0, 1372, 12, '2025-12-22 16:12:57', '2025-12-22 16:12:57'),
(336, 0, 0, 1365, 12, '2025-12-22 16:13:07', '2025-12-22 16:13:07'),
(337, 0, 0, 1370, 12, '2025-12-22 16:13:17', '2025-12-22 16:13:17'),
(338, 0, 0, 1367, 12, '2025-12-22 16:13:27', '2025-12-22 16:13:27'),
(339, 0, 0, 1371, 12, '2025-12-22 16:13:37', '2025-12-22 16:13:37'),
(340, 0, 0, 1369, 12, '2025-12-22 16:13:47', '2025-12-22 16:13:47'),
(341, 0, 0, 1364, 12, '2025-12-22 16:13:57', '2025-12-22 16:13:57'),
(342, 0, 0, 1374, 12, '2025-12-22 16:14:07', '2025-12-22 16:14:07'),
(343, 0, 0, 1375, 12, '2025-12-22 16:14:17', '2025-12-22 16:14:17'),
(344, 0, 0, 1367, 12, '2025-12-22 16:14:27', '2025-12-22 16:14:27'),
(345, 0, 0, 1367, 12, '2025-12-22 16:14:37', '2025-12-22 16:14:37'),
(346, 0, 0, 1367, 17, '2025-12-22 16:14:47', '2025-12-22 16:14:47'),
(347, 0, 0, 1376, 17, '2025-12-22 16:14:57', '2025-12-22 16:14:57'),
(348, 0, 0, 1362, 17, '2025-12-22 16:15:07', '2025-12-22 16:15:07'),
(349, 0, 0, 1367, 13, '2025-12-22 16:15:17', '2025-12-22 16:15:17'),
(350, 0, 0, 1373, 13, '2025-12-22 16:15:27', '2025-12-22 16:15:27'),
(351, 0, 0, 1367, 13, '2025-12-22 16:15:37', '2025-12-22 16:15:37'),
(352, 0, 0, 1369, 13, '2025-12-22 16:15:47', '2025-12-22 16:15:47'),
(353, 0, 0, 1370, 14, '2025-12-22 16:15:57', '2025-12-22 16:15:57'),
(354, 0, 0, 1369, 13, '2025-12-22 16:16:07', '2025-12-22 16:16:07'),
(355, 0, 0, 1373, 13, '2025-12-22 16:16:17', '2025-12-22 16:16:17'),
(356, 0, 0, 1365, 13, '2025-12-22 16:16:27', '2025-12-22 16:16:27'),
(357, 0, 0, 1370, 13, '2025-12-22 16:16:37', '2025-12-22 16:16:37'),
(358, 0, 0, 1370, 13, '2025-12-22 16:16:47', '2025-12-22 16:16:47'),
(359, 0, 0, 1366, 13, '2025-12-22 16:16:57', '2025-12-22 16:16:57'),
(360, 0, 0, 1365, 13, '2025-12-22 16:17:07', '2025-12-22 16:17:07'),
(361, 0, 0, 1367, 13, '2025-12-22 16:17:17', '2025-12-22 16:17:17'),
(362, 0, 0, 1366, 13, '2025-12-22 16:17:27', '2025-12-22 16:17:27'),
(363, 0, 0, 1371, 13, '2025-12-22 16:17:37', '2025-12-22 16:17:37'),
(364, 0, 0, 1365, 14, '2025-12-22 16:17:47', '2025-12-22 16:17:47'),
(365, 0, 0, 1367, 14, '2025-12-22 16:17:57', '2025-12-22 16:17:57'),
(366, 0, 0, 1370, 16, '2025-12-22 16:18:07', '2025-12-22 16:18:07'),
(367, 0, 0, 1365, 16, '2025-12-22 16:18:17', '2025-12-22 16:18:17'),
(368, 0, 0, 1367, 16, '2025-12-22 16:18:27', '2025-12-22 16:18:27'),
(369, 0, 0, 1363, 16, '2025-12-22 16:18:37', '2025-12-22 16:18:37'),
(370, 0, 0, 1367, 16, '2025-12-22 16:18:47', '2025-12-22 16:18:47'),
(371, 0, 0, 1367, 14, '2025-12-22 16:18:57', '2025-12-22 16:18:57'),
(372, 0, 0, 1374, 16, '2025-12-22 16:19:07', '2025-12-22 16:19:07'),
(373, 0, 0, 1370, 14, '2025-12-22 16:19:17', '2025-12-22 16:19:17'),
(374, 0, 0, 1365, 14, '2025-12-22 16:19:27', '2025-12-22 16:19:27'),
(375, 0, 0, 1367, 13, '2025-12-22 16:19:37', '2025-12-22 16:19:37'),
(376, 29.7, 91, 1382, 18, '2025-12-22 16:22:29', '2025-12-22 16:22:29'),
(377, 29.7, 90.9, 1375, 15, '2025-12-22 16:22:39', '2025-12-22 16:22:39'),
(378, 29.8, 90.8, 1375, 15, '2025-12-22 16:22:49', '2025-12-22 16:22:49'),
(379, 29.8, 90.8, 1374, 19, '2025-12-22 16:22:59', '2025-12-22 16:22:59'),
(380, 29.8, 90.7, 1377, 18, '2025-12-22 16:23:09', '2025-12-22 16:23:09'),
(381, 29.8, 90.7, 1378, 18, '2025-12-22 16:23:19', '2025-12-22 16:23:19'),
(382, 29.8, 90.6, 2559, 16, '2025-12-22 16:23:29', '2025-12-22 16:23:29'),
(383, 29.8, 90.6, 2587, 18, '2025-12-22 16:23:39', '2025-12-22 16:23:39'),
(384, 29.8, 90.6, 2586, 18, '2025-12-22 16:23:49', '2025-12-22 16:23:49'),
(385, 29.8, 90.3, 2587, 12, '2025-12-22 16:23:59', '2025-12-22 16:23:59'),
(386, 29.8, 90.1, 2586, 16, '2025-12-22 16:24:09', '2025-12-22 16:24:09'),
(387, 29.8, 90.3, 2582, 18, '2025-12-22 16:24:20', '2025-12-22 16:24:20'),
(388, 29.8, 90.1, 2589, 18, '2025-12-22 16:24:29', '2025-12-22 16:24:29'),
(389, 29.8, 90, 2588, 18, '2025-12-22 16:24:39', '2025-12-22 16:24:39'),
(390, 29.8, 90, 2581, 18, '2025-12-22 16:24:49', '2025-12-22 16:24:49'),
(391, 29.8, 89.8, 2585, 18, '2025-12-22 16:24:59', '2025-12-22 16:24:59'),
(392, 29.8, 89.8, 1474, 18, '2025-12-22 16:25:09', '2025-12-22 16:25:09'),
(393, 29.8, 90.1, 1461, 18, '2025-12-22 16:25:19', '2025-12-22 16:25:19'),
(394, 29.8, 90.2, 1456, 18, '2025-12-22 16:25:29', '2025-12-22 16:25:29'),
(395, 29.9, 90.3, 1456, 18, '2025-12-22 16:25:39', '2025-12-22 16:25:39'),
(396, 29.8, 90.3, 1452, 18, '2025-12-22 16:25:49', '2025-12-22 16:25:49'),
(397, 29.8, 90.3, 1449, 18, '2025-12-22 16:25:59', '2025-12-22 16:25:59'),
(398, 30, 94.7, 1440, 17, '2025-12-22 16:26:09', '2025-12-22 16:26:09'),
(399, 30.3, 93.9, 1445, 17, '2025-12-22 16:26:19', '2025-12-22 16:26:19'),
(400, 30.5, 91.5, 1442, 17, '2025-12-22 16:26:29', '2025-12-22 16:26:29'),
(401, 30.5, 89.5, 1441, 17, '2025-12-22 16:26:39', '2025-12-22 16:26:39'),
(402, 30.5, 88.9, 1440, 17, '2025-12-22 16:26:49', '2025-12-22 16:26:49'),
(403, 30.5, 88.5, 1441, 17, '2025-12-22 16:26:59', '2025-12-22 16:26:59'),
(404, 30.5, 88.2, 1437, 17, '2025-12-22 16:27:09', '2025-12-22 16:27:09'),
(405, 30.4, 88.2, 1438, 182, '2025-12-22 16:27:19', '2025-12-22 16:27:19'),
(406, 29.9, 90.2, 1439, 16, '2025-12-22 16:34:59', '2025-12-22 16:34:59'),
(407, 29.9, 90.2, 1436, 16, '2025-12-22 16:35:09', '2025-12-22 16:35:09'),
(408, 29.9, 90.2, 1435, 16, '2025-12-22 16:35:19', '2025-12-22 16:35:19'),
(409, 29.9, 90.1, 1435, 13, '2025-12-22 16:35:29', '2025-12-22 16:35:29'),
(410, 29.9, 90.1, 1433, 13, '2025-12-22 16:35:39', '2025-12-22 16:35:39'),
(411, 29.9, 90.2, 1438, 12, '2025-12-22 16:35:49', '2025-12-22 16:35:49'),
(412, 29.9, 90.3, 1436, 13, '2025-12-22 16:35:59', '2025-12-22 16:35:59'),
(413, 29.9, 90.3, 1435, 14, '2025-12-22 16:36:09', '2025-12-22 16:36:09'),
(414, 29.9, 90.3, 1434, 13, '2025-12-22 16:36:19', '2025-12-22 16:36:19'),
(415, 29.9, 90.2, 1434, 12, '2025-12-22 16:36:29', '2025-12-22 16:36:29'),
(416, 29.9, 90.3, 1441, 12, '2025-12-22 16:36:39', '2025-12-22 16:36:39'),
(417, 29.9, 90.3, 1431, 12, '2025-12-22 16:36:49', '2025-12-22 16:36:49'),
(418, 29.9, 90.3, 1434, 12, '2025-12-22 16:36:59', '2025-12-22 16:36:59'),
(419, 29.9, 90.3, 1440, 12, '2025-12-22 16:37:09', '2025-12-22 16:37:09'),
(420, 29.9, 90.3, 1434, 12, '2025-12-22 16:37:19', '2025-12-22 16:37:19'),
(421, 29.9, 90.3, 1434, 12, '2025-12-22 16:37:29', '2025-12-22 16:37:29'),
(422, 29.9, 90.3, 1439, 12, '2025-12-22 16:37:39', '2025-12-22 16:37:39'),
(423, 29.9, 90.3, 1437, 12, '2025-12-22 16:37:49', '2025-12-22 16:37:49'),
(424, 29.9, 90.3, 1437, 12, '2025-12-22 16:37:59', '2025-12-22 16:37:59'),
(425, 29.9, 90.2, 1437, 12, '2025-12-22 16:38:09', '2025-12-22 16:38:09'),
(426, 29.9, 90.3, 1435, 12, '2025-12-22 16:38:19', '2025-12-22 16:38:19'),
(427, 29.9, 90.3, 1435, 12, '2025-12-22 16:38:29', '2025-12-22 16:38:29'),
(428, 29.9, 90.3, 1437, 12, '2025-12-22 16:38:39', '2025-12-22 16:38:39'),
(429, 29.9, 90.3, 1438, 16, '2025-12-22 16:38:49', '2025-12-22 16:38:49'),
(430, 29.9, 90.3, 1439, 16, '2025-12-22 16:38:59', '2025-12-22 16:38:59'),
(431, 29.8, 90.4, 1438, 12, '2025-12-22 16:39:09', '2025-12-22 16:39:09'),
(432, 29.9, 90.4, 1439, 13, '2025-12-22 16:39:19', '2025-12-22 16:39:19'),
(433, 29.9, 90.4, 1435, 12, '2025-12-22 16:39:29', '2025-12-22 16:39:29'),
(434, 29.9, 90.3, 1434, 12, '2025-12-22 16:39:39', '2025-12-22 16:39:39'),
(435, 29.9, 90.4, 1437, 12, '2025-12-22 16:39:49', '2025-12-22 16:39:49'),
(436, 29.9, 90.4, 1427, 12, '2025-12-22 16:39:59', '2025-12-22 16:39:59'),
(437, 29.9, 90.4, 1437, 12, '2025-12-22 16:40:09', '2025-12-22 16:40:09'),
(438, 29.9, 90.4, 1431, 12, '2025-12-22 16:40:19', '2025-12-22 16:40:19'),
(439, 29.9, 90.4, 1437, 12, '2025-12-22 16:40:29', '2025-12-22 16:40:29'),
(440, 29.9, 90.4, 1437, 11, '2025-12-22 16:40:39', '2025-12-22 16:40:39'),
(441, 29.9, 90.4, 1437, 12, '2025-12-22 16:40:49', '2025-12-22 16:40:49'),
(442, 29.9, 90.4, 1446, 12, '2025-12-22 16:40:59', '2025-12-22 16:40:59'),
(443, 29.9, 90.3, 1439, 12, '2025-12-22 16:41:10', '2025-12-22 16:41:10'),
(444, 29.9, 90.3, 1437, 12, '2025-12-22 16:41:19', '2025-12-22 16:41:19'),
(445, 29.9, 90.3, 1441, 12, '2025-12-22 16:41:29', '2025-12-22 16:41:29'),
(446, 29.9, 90.3, 1434, 12, '2025-12-22 16:41:39', '2025-12-22 16:41:39'),
(447, 29.9, 90.3, 1438, 16, '2025-12-22 16:41:49', '2025-12-22 16:41:49'),
(448, 29.9, 90.3, 1435, 16, '2025-12-22 16:41:59', '2025-12-22 16:41:59'),
(449, 29.9, 90.2, 1435, 16, '2025-12-22 16:42:09', '2025-12-22 16:42:09'),
(450, 29.9, 90.2, 1438, 16, '2025-12-22 16:42:19', '2025-12-22 16:42:19'),
(451, 29.9, 90.3, 1438, 16, '2025-12-22 16:42:29', '2025-12-22 16:42:29'),
(452, 29.9, 90.2, 1435, 16, '2025-12-22 16:42:39', '2025-12-22 16:42:39'),
(453, 29.8, 90.3, 1433, 16, '2025-12-22 16:42:49', '2025-12-22 16:42:49'),
(454, 29.9, 90.3, 1435, 16, '2025-12-22 16:42:59', '2025-12-22 16:42:59'),
(455, 29.9, 90.3, 1441, 16, '2025-12-22 16:43:09', '2025-12-22 16:43:09'),
(456, 29.9, 90.3, 1436, 16, '2025-12-22 16:43:19', '2025-12-22 16:43:19'),
(457, 29.9, 90.3, 1433, 12, '2025-12-22 16:43:29', '2025-12-22 16:43:29'),
(458, 29.9, 90.3, 1431, 14, '2025-12-22 16:43:39', '2025-12-22 16:43:39'),
(459, 29.9, 90.4, 1434, 13, '2025-12-22 16:43:49', '2025-12-22 16:43:49'),
(460, 29.9, 90.4, 1436, 13, '2025-12-22 16:43:59', '2025-12-22 16:43:59'),
(461, 29.9, 90.3, 1436, 15, '2025-12-22 16:44:09', '2025-12-22 16:44:09'),
(462, 29.9, 90.3, 1434, 17, '2025-12-22 16:44:19', '2025-12-22 16:44:19'),
(463, 29.9, 90.3, 1434, 17, '2025-12-22 16:44:29', '2025-12-22 16:44:29'),
(464, 29.9, 90.3, 1441, 13, '2025-12-22 16:44:39', '2025-12-22 16:44:39'),
(465, 29.9, 90.4, 1429, 12, '2025-12-22 16:44:49', '2025-12-22 16:44:49'),
(466, 29.9, 90.3, 1438, 13, '2025-12-22 16:44:59', '2025-12-22 16:44:59'),
(467, 29.9, 90.3, 1436, 14, '2025-12-22 16:45:09', '2025-12-22 16:45:09'),
(468, 29.9, 90.3, 1419, 12, '2025-12-22 16:45:19', '2025-12-22 16:45:19'),
(469, 29.9, 90.4, 1445, 10, '2025-12-22 16:46:08', '2025-12-22 16:46:08'),
(470, 29.9, 90.4, 1431, 10, '2025-12-22 16:46:18', '2025-12-22 16:46:18'),
(471, 29.9, 90.4, 1424, 11, '2025-12-22 16:46:28', '2025-12-22 16:46:28'),
(472, 29.9, 90.3, 1427, 10, '2025-12-22 16:46:38', '2025-12-22 16:46:38'),
(473, 29.9, 90.3, 1431, 10, '2025-12-22 16:46:48', '2025-12-22 16:46:48'),
(474, 29.9, 90.4, 1451, 9, '2025-12-22 16:46:58', '2025-12-22 16:46:58'),
(475, 29.9, 90.4, 1433, 8, '2025-12-22 16:47:08', '2025-12-22 16:47:08'),
(476, 29.9, 90.4, 1422, 10, '2025-12-22 16:47:18', '2025-12-22 16:47:18'),
(477, 29.9, 90.3, 1425, 10, '2025-12-22 16:47:28', '2025-12-22 16:47:28'),
(478, 29.9, 90.4, 1436, 10, '2025-12-22 16:47:38', '2025-12-22 16:47:38'),
(479, 29.9, 90.4, 1434, 10, '2025-12-22 16:47:48', '2025-12-22 16:47:48'),
(480, 29.9, 90.3, 1426, 12, '2025-12-22 16:47:58', '2025-12-22 16:47:58'),
(481, 29.9, 90.4, 1429, 12, '2025-12-22 16:48:08', '2025-12-22 16:48:08'),
(482, 29.9, 90.3, 1433, 12, '2025-12-22 16:48:18', '2025-12-22 16:48:18'),
(483, 29.9, 90.3, 1392, 9, '2025-12-22 16:48:28', '2025-12-22 16:48:28'),
(484, 29.9, 90.3, 1422, 11, '2025-12-22 16:48:38', '2025-12-22 16:48:38'),
(485, 29.9, 90.3, 1434, 11, '2025-12-22 16:48:48', '2025-12-22 16:48:48'),
(486, 29.9, 90.3, 1431, 12, '2025-12-22 16:48:58', '2025-12-22 16:48:58'),
(487, 29.9, 90.3, 1431, 12, '2025-12-22 16:49:08', '2025-12-22 16:49:08'),
(488, 29.9, 90.4, 1437, 12, '2025-12-22 16:49:18', '2025-12-22 16:49:18'),
(489, 29.9, 90.4, 1424, 12, '2025-12-22 16:49:28', '2025-12-22 16:49:28'),
(490, 29.9, 90.4, 1420, 11, '2025-12-22 16:49:38', '2025-12-22 16:49:38'),
(491, 29.9, 90.3, 1439, 11, '2025-12-22 16:49:48', '2025-12-22 16:49:48'),
(492, 29.9, 90.3, 1431, 1, '2025-12-22 16:49:58', '2025-12-22 16:49:58'),
(493, 29.9, 90.4, 1441, 13, '2025-12-22 16:50:08', '2025-12-22 16:50:08'),
(494, 29.9, 90.6, 1427, 18, '2025-12-22 16:50:18', '2025-12-22 16:50:18'),
(495, 29.9, 90.6, 1439, 17, '2025-12-22 16:50:28', '2025-12-22 16:50:28'),
(496, 29.9, 90.6, 1445, 17, '2025-12-22 16:50:38', '2025-12-22 16:50:38'),
(497, 29.9, 90.4, 1394, 17, '2025-12-22 16:50:48', '2025-12-22 16:50:48'),
(498, 29.9, 90.4, 1438, 17, '2025-12-22 16:50:58', '2025-12-22 16:50:58'),
(499, 29.9, 90.5, 1434, 17, '2025-12-22 16:51:08', '2025-12-22 16:51:08'),
(500, 29.9, 90.4, 1445, 17, '2025-12-22 16:51:18', '2025-12-22 16:51:18'),
(501, 29.9, 90.3, 1430, 17, '2025-12-22 16:51:28', '2025-12-22 16:51:28'),
(502, 29.9, 90.4, 1434, 18, '2025-12-22 16:51:38', '2025-12-22 16:51:38'),
(503, 29.9, 90.4, 1426, 17, '2025-12-22 16:51:48', '2025-12-22 16:51:48'),
(504, 29.9, 90.3, 1437, 17, '2025-12-22 16:51:58', '2025-12-22 16:51:58'),
(505, 30, 90.2, 1433, 17, '2025-12-22 16:52:08', '2025-12-22 16:52:08'),
(506, 29.9, 90.2, 1435, 17, '2025-12-22 16:52:18', '2025-12-22 16:52:18'),
(507, 29.9, 90.1, 1435, 17, '2025-12-22 16:52:28', '2025-12-22 16:52:28'),
(508, 29.9, 90.2, 1437, 17, '2025-12-22 16:52:38', '2025-12-22 16:52:38'),
(509, 29.9, 90.2, 1437, 18, '2025-12-22 16:52:48', '2025-12-22 16:52:48'),
(510, 29.9, 90.2, 1434, 18, '2025-12-22 16:52:58', '2025-12-22 16:52:58'),
(511, 29.9, 90.2, 1435, 18, '2025-12-22 16:53:08', '2025-12-22 16:53:08'),
(512, 29.9, 90.2, 1441, 18, '2025-12-22 16:53:18', '2025-12-22 16:53:18'),
(513, 29.9, 90.2, 1427, 18, '2025-12-22 16:53:28', '2025-12-22 16:53:28'),
(514, 29.9, 90.2, 1434, 18, '2025-12-22 16:53:38', '2025-12-22 16:53:38'),
(515, 29.9, 90.2, 1450, 18, '2025-12-22 16:53:48', '2025-12-22 16:53:48'),
(516, 29.9, 90.2, 1435, 18, '2025-12-22 16:53:58', '2025-12-22 16:53:58'),
(517, 29.9, 90.2, 1395, 18, '2025-12-22 16:54:08', '2025-12-22 16:54:08'),
(518, 29.9, 90.2, 1437, 18, '2025-12-22 16:54:18', '2025-12-22 16:54:18'),
(519, 29.9, 90.3, 1430, 18, '2025-12-22 16:54:28', '2025-12-22 16:54:28'),
(520, 29.9, 90.2, 1435, 18, '2025-12-22 16:54:38', '2025-12-22 16:54:38'),
(521, 29.9, 90.2, 1438, 18, '2025-12-22 16:54:48', '2025-12-22 16:54:48'),
(522, 29.9, 90.3, 1439, 18, '2025-12-22 16:54:58', '2025-12-22 16:54:58'),
(523, 29.9, 90.3, 1438, 18, '2025-12-22 16:55:08', '2025-12-22 16:55:08'),
(524, 29.9, 90.2, 1437, 18, '2025-12-22 16:55:18', '2025-12-22 16:55:18'),
(525, 29.9, 90.3, 1451, 18, '2025-12-22 16:55:28', '2025-12-22 16:55:28'),
(526, 29.9, 90.3, 1439, 18, '2025-12-22 16:55:38', '2025-12-22 16:55:38'),
(527, 29.9, 90.3, 1430, 18, '2025-12-22 16:55:48', '2025-12-22 16:55:48'),
(528, 29.9, 90.3, 1433, 18, '2025-12-22 16:55:58', '2025-12-22 16:55:58'),
(529, 29.9, 90.3, 1431, 18, '2025-12-22 16:56:08', '2025-12-22 16:56:08'),
(530, 29.9, 90.4, 1456, 18, '2025-12-22 16:56:18', '2025-12-22 16:56:18'),
(531, 29.9, 90.4, 1435, 18, '2025-12-22 16:56:28', '2025-12-22 16:56:28'),
(532, 29.9, 90.4, 1429, 18, '2025-12-22 16:56:38', '2025-12-22 16:56:38'),
(533, 29.9, 90.3, 1440, 18, '2025-12-22 16:56:48', '2025-12-22 16:56:48'),
(534, 29.9, 90.4, 1438, 18, '2025-12-22 16:56:58', '2025-12-22 16:56:58'),
(535, 29.9, 90.4, 1447, 18, '2025-12-22 16:57:08', '2025-12-22 16:57:08'),
(536, 29.9, 90.4, 1436, 18, '2025-12-22 16:57:18', '2025-12-22 16:57:18'),
(537, 29.9, 90.4, 1436, 18, '2025-12-22 16:57:28', '2025-12-22 16:57:28'),
(538, 29.9, 90.4, 1433, 18, '2025-12-22 16:57:38', '2025-12-22 16:57:38'),
(539, 29.9, 90.5, 1434, 18, '2025-12-22 16:57:48', '2025-12-22 16:57:48'),
(540, 29.9, 90.4, 1440, 18, '2025-12-22 16:57:58', '2025-12-22 16:57:58'),
(541, 29.9, 90.4, 1447, 16, '2025-12-22 16:58:08', '2025-12-22 16:58:08'),
(542, 29.9, 90.3, 1435, 19, '2025-12-22 16:58:18', '2025-12-22 16:58:18'),
(543, 29.9, 90.3, 1434, 19, '2025-12-22 16:58:28', '2025-12-22 16:58:28'),
(544, 29.8, 90.3, 1435, 19, '2025-12-22 16:58:38', '2025-12-22 16:58:38'),
(545, 29.9, 90.4, 1438, 19, '2025-12-22 16:58:48', '2025-12-22 16:58:48'),
(546, 29.9, 90.4, 1442, 19, '2025-12-22 16:58:58', '2025-12-22 16:58:58'),
(547, 29.8, 90.4, 1434, 19, '2025-12-22 16:59:08', '2025-12-22 16:59:08'),
(548, 29.9, 90.5, 1428, 18, '2025-12-22 16:59:18', '2025-12-22 16:59:18'),
(549, 29.9, 90.5, 1447, 18, '2025-12-22 16:59:28', '2025-12-22 16:59:28'),
(550, 29.9, 90.5, 1431, 17, '2025-12-22 16:59:38', '2025-12-22 16:59:38'),
(551, 29.8, 90.5, 1453, 19, '2025-12-22 16:59:48', '2025-12-22 16:59:48'),
(552, 29.9, 90.5, 1409, 18, '2025-12-22 16:59:58', '2025-12-22 16:59:58'),
(553, 29.9, 90.5, 1435, 18, '2025-12-22 17:00:08', '2025-12-22 17:00:08'),
(554, 29.9, 90.5, 1419, 18, '2025-12-22 17:00:18', '2025-12-22 17:00:18'),
(555, 29.8, 90.4, 1439, 18, '2025-12-22 17:00:28', '2025-12-22 17:00:28'),
(556, 29.9, 90.4, 1434, 19, '2025-12-22 17:00:38', '2025-12-22 17:00:38'),
(557, 29.9, 90.5, 1520, 19, '2025-12-22 17:00:48', '2025-12-22 17:00:48'),
(558, 29.8, 90.3, 1438, 18, '2025-12-22 17:00:58', '2025-12-22 17:00:58'),
(559, 29.9, 90.3, 1431, 18, '2025-12-22 17:01:08', '2025-12-22 17:01:08'),
(560, 29.9, 90.4, 1435, 18, '2025-12-22 17:01:18', '2025-12-22 17:01:18'),
(561, 29.8, 90.4, 1434, 18, '2025-12-22 17:01:28', '2025-12-22 17:01:28'),
(562, 29.9, 90.5, 1431, 18, '2025-12-22 17:01:38', '2025-12-22 17:01:38'),
(563, 29.9, 90.5, 1429, 18, '2025-12-22 17:01:48', '2025-12-22 17:01:48'),
(564, 29.9, 90.5, 1427, 18, '2025-12-22 17:01:58', '2025-12-22 17:01:58'),
(565, 29.9, 90.5, 1434, 18, '2025-12-22 17:02:08', '2025-12-22 17:02:08'),
(566, 29.9, 90.5, 1457, 18, '2025-12-22 17:02:18', '2025-12-22 17:02:18'),
(567, 29.9, 90.5, 1435, 19, '2025-12-22 17:02:28', '2025-12-22 17:02:28'),
(568, 29.8, 90.5, 1431, 19, '2025-12-22 17:02:38', '2025-12-22 17:02:38'),
(569, 29.9, 90.5, 1454, 19, '2025-12-22 17:02:48', '2025-12-22 17:02:48'),
(570, 29.8, 90.5, 1434, 19, '2025-12-22 17:02:58', '2025-12-22 17:02:58'),
(571, 29.9, 90.5, 1438, 19, '2025-12-22 17:03:08', '2025-12-22 17:03:08'),
(572, 29.9, 90.5, 1439, 18, '2025-12-22 17:03:18', '2025-12-22 17:03:18'),
(573, 29.8, 90.5, 1427, 18, '2025-12-22 17:03:28', '2025-12-22 17:03:28'),
(574, 29.9, 90.5, 1424, 18, '2025-12-22 17:03:38', '2025-12-22 17:03:38'),
(575, 29.8, 90.6, 1437, 19, '2025-12-22 17:03:48', '2025-12-22 17:03:48'),
(576, 29.9, 90.5, 1453, 18, '2025-12-22 17:03:58', '2025-12-22 17:03:58'),
(577, 29.9, 90.5, 1446, 17, '2025-12-22 17:04:08', '2025-12-22 17:04:08'),
(578, 29.8, 90.5, 1433, 17, '2025-12-22 17:04:18', '2025-12-22 17:04:18'),
(579, 29.8, 90.6, 1435, 18, '2025-12-22 17:04:28', '2025-12-22 17:04:28'),
(580, 29.8, 90.5, 1430, 18, '2025-12-22 17:04:38', '2025-12-22 17:04:38'),
(581, 29.8, 90.6, 1427, 17, '2025-12-22 17:04:48', '2025-12-22 17:04:48'),
(582, 29.8, 90.6, 1441, 17, '2025-12-22 17:04:58', '2025-12-22 17:04:58'),
(583, 29.8, 90.7, 1455, 19, '2025-12-22 17:05:08', '2025-12-22 17:05:08'),
(584, 29.9, 91, 1441, 22, '2025-12-22 17:05:18', '2025-12-22 17:05:18'),
(585, 29.9, 90.9, 1440, 22, '2025-12-22 17:05:28', '2025-12-22 17:05:28'),
(586, 29.9, 90.7, 1439, 22, '2025-12-22 17:05:38', '2025-12-22 17:05:38'),
(587, 29.9, 90.7, 1450, 22, '2025-12-22 17:05:48', '2025-12-22 17:05:48'),
(588, 29.9, 90.7, 1438, 18, '2025-12-22 17:05:58', '2025-12-22 17:05:58'),
(589, 29.9, 90.6, 1442, 19, '2025-12-22 17:06:08', '2025-12-22 17:06:08'),
(590, 29.9, 90.6, 1450, 18, '2025-12-22 17:06:18', '2025-12-22 17:06:18'),
(591, 29.9, 90.6, 1407, 18, '2025-12-22 17:06:28', '2025-12-22 17:06:28'),
(592, 29.9, 90.6, 1439, 18, '2025-12-22 17:06:38', '2025-12-22 17:06:38'),
(593, 29.9, 90.6, 1438, 18, '2025-12-22 17:06:48', '2025-12-22 17:06:48'),
(594, 29.8, 90.6, 1394, 18, '2025-12-22 17:06:58', '2025-12-22 17:06:58'),
(595, 29.9, 90.7, 1439, 21, '2025-12-22 17:07:08', '2025-12-22 17:07:08'),
(596, 29.9, 90.6, 1431, 21, '2025-12-22 17:07:18', '2025-12-22 17:07:18'),
(597, 29.9, 90.7, 1445, 21, '2025-12-22 17:07:28', '2025-12-22 17:07:28'),
(598, 29.9, 90.7, 1452, 21, '2025-12-22 17:07:38', '2025-12-22 17:07:38'),
(599, 29.9, 90.6, 1427, 21, '2025-12-22 17:07:48', '2025-12-22 17:07:48'),
(600, 29.9, 90.6, 1425, 21, '2025-12-22 17:07:58', '2025-12-22 17:07:58'),
(601, 29.9, 90.6, 1439, 21, '2025-12-22 17:08:08', '2025-12-22 17:08:08'),
(602, 29.9, 90.6, 1429, 21, '2025-12-22 17:08:18', '2025-12-22 17:08:18'),
(603, 29.9, 90.7, 1439, 21, '2025-12-22 17:08:28', '2025-12-22 17:08:28'),
(604, 29.9, 90.6, 1435, 21, '2025-12-22 17:08:38', '2025-12-22 17:08:38'),
(605, 29.9, 90.7, 1431, 21, '2025-12-22 17:08:48', '2025-12-22 17:08:48'),
(606, 29.9, 90.6, 1439, 21, '2025-12-22 17:08:58', '2025-12-22 17:08:58'),
(607, 29.9, 90.6, 1413, 21, '2025-12-22 17:09:08', '2025-12-22 17:09:08'),
(608, 29.8, 90.6, 1410, 21, '2025-12-22 17:09:18', '2025-12-22 17:09:18'),
(609, 29.9, 90.7, 1453, 21, '2025-12-22 17:09:28', '2025-12-22 17:09:28'),
(610, 29.9, 90.7, 1435, 21, '2025-12-22 17:09:38', '2025-12-22 17:09:38'),
(611, 29.8, 90.7, 1433, 21, '2025-12-22 17:09:48', '2025-12-22 17:09:48'),
(612, 29.9, 90.7, 1437, 21, '2025-12-22 17:09:58', '2025-12-22 17:09:58'),
(613, 29.8, 90.7, 1438, 21, '2025-12-22 17:10:08', '2025-12-22 17:10:08'),
(614, 29.9, 90.7, 1433, 21, '2025-12-22 17:10:18', '2025-12-22 17:10:18'),
(615, 29.8, 90.7, 1434, 21, '2025-12-22 17:10:28', '2025-12-22 17:10:28'),
(616, 29.8, 90.7, 1434, 21, '2025-12-22 17:10:38', '2025-12-22 17:10:38'),
(617, 29.9, 90.7, 1435, 21, '2025-12-22 17:10:48', '2025-12-22 17:10:48'),
(618, 29.8, 90.7, 1435, 21, '2025-12-22 17:10:58', '2025-12-22 17:10:58'),
(619, 29.9, 90.7, 1442, 21, '2025-12-22 17:11:08', '2025-12-22 17:11:08'),
(620, 29.9, 90.7, 1431, 21, '2025-12-22 17:11:18', '2025-12-22 17:11:18'),
(621, 29.9, 90.7, 1431, 21, '2025-12-22 17:11:28', '2025-12-22 17:11:28'),
(622, 29.8, 90.8, 1438, 21, '2025-12-22 17:11:38', '2025-12-22 17:11:38'),
(623, 29.9, 90.8, 1445, 21, '2025-12-22 17:11:48', '2025-12-22 17:11:48'),
(624, 29.8, 90.8, 1431, 21, '2025-12-22 17:11:58', '2025-12-22 17:11:58'),
(625, 29.9, 90.8, 1453, 21, '2025-12-22 17:12:08', '2025-12-22 17:12:08'),
(626, 29.9, 90.8, 1439, 21, '2025-12-22 17:12:18', '2025-12-22 17:12:18'),
(627, 29.9, 90.8, 1435, 21, '2025-12-22 17:12:28', '2025-12-22 17:12:28'),
(628, 29.9, 90.8, 1435, 21, '2025-12-22 17:12:38', '2025-12-22 17:12:38'),
(629, 29.8, 90.7, 1436, 21, '2025-12-22 17:12:48', '2025-12-22 17:12:48'),
(630, 29.9, 90.8, 1436, 21, '2025-12-22 17:12:58', '2025-12-22 17:12:58'),
(631, 29.9, 90.8, 1439, 21, '2025-12-22 17:13:08', '2025-12-22 17:13:08'),
(632, 29.9, 90.8, 1438, 21, '2025-12-22 17:13:18', '2025-12-22 17:13:18'),
(633, 29.9, 90.7, 1438, 21, '2025-12-22 17:13:28', '2025-12-22 17:13:28'),
(634, 29.9, 90.7, 1435, 21, '2025-12-22 17:13:38', '2025-12-22 17:13:38'),
(635, 29.8, 90.7, 1431, 21, '2025-12-22 17:13:48', '2025-12-22 17:13:48'),
(636, 29.8, 90.7, 1430, 21, '2025-12-22 17:13:58', '2025-12-22 17:13:58'),
(637, 29.9, 90.7, 1429, 21, '2025-12-22 17:14:08', '2025-12-22 17:14:08'),
(638, 29.9, 90.7, 1442, 21, '2025-12-22 17:14:18', '2025-12-22 17:14:18'),
(639, 29.8, 90.8, 1429, 21, '2025-12-22 17:14:28', '2025-12-22 17:14:28'),
(640, 29.8, 90.7, 1443, 21, '2025-12-22 17:14:38', '2025-12-22 17:14:38'),
(641, 29.8, 90.7, 1431, 21, '2025-12-22 17:14:48', '2025-12-22 17:14:48'),
(642, 29.8, 90.7, 1414, 21, '2025-12-22 17:14:58', '2025-12-22 17:14:58'),
(643, 29.8, 90.7, 1431, 21, '2025-12-22 17:15:08', '2025-12-22 17:15:08'),
(644, 29.8, 90.7, 1434, 21, '2025-12-22 17:15:18', '2025-12-22 17:15:18'),
(645, 29.9, 90.7, 1429, 21, '2025-12-22 17:15:28', '2025-12-22 17:15:28'),
(646, 29.8, 90.7, 1435, 21, '2025-12-22 17:15:38', '2025-12-22 17:15:38'),
(647, 29.9, 90.8, 1430, 21, '2025-12-22 17:15:48', '2025-12-22 17:15:48'),
(648, 29.8, 90.8, 1438, 21, '2025-12-22 17:15:58', '2025-12-22 17:15:58'),
(649, 29.8, 90.7, 1442, 21, '2025-12-22 17:16:08', '2025-12-22 17:16:08'),
(650, 29.8, 90.8, 1429, 21, '2025-12-22 17:16:18', '2025-12-22 17:16:18'),
(651, 29.8, 90.8, 1434, 21, '2025-12-22 17:16:28', '2025-12-22 17:16:28'),
(652, 29.8, 90.8, 1424, 21, '2025-12-22 17:16:38', '2025-12-22 17:16:38'),
(653, 29.8, 90.8, 1433, 21, '2025-12-22 17:16:48', '2025-12-22 17:16:48'),
(654, 29.8, 90.8, 1463, 21, '2025-12-22 17:16:58', '2025-12-22 17:16:58'),
(655, 29.8, 90.8, 1435, 21, '2025-12-22 17:17:08', '2025-12-22 17:17:08'),
(656, 29.8, 90.8, 1435, 21, '2025-12-22 17:17:18', '2025-12-22 17:17:18'),
(657, 29.8, 90.8, 1429, 21, '2025-12-22 17:17:28', '2025-12-22 17:17:28'),
(658, 29.8, 90.8, 1423, 21, '2025-12-22 17:17:38', '2025-12-22 17:17:38'),
(659, 29.8, 90.8, 1439, 21, '2025-12-22 17:17:48', '2025-12-22 17:17:48'),
(660, 29.8, 90.8, 1455, 17, '2025-12-22 17:17:58', '2025-12-22 17:17:58'),
(661, 29.9, 90.8, 2559, 21, '2025-12-22 17:18:08', '2025-12-22 17:18:08'),
(662, 29.8, 90.8, 2551, 21, '2025-12-22 17:18:18', '2025-12-22 17:18:18'),
(663, 29.8, 90.9, 2546, 21, '2025-12-22 17:18:28', '2025-12-22 17:18:28'),
(664, 29.8, 90.8, 2554, 21, '2025-12-22 17:18:38', '2025-12-22 17:18:38'),
(665, 29.8, 90.8, 2559, 21, '2025-12-22 17:18:48', '2025-12-22 17:18:48'),
(666, 29.8, 90.8, 2517, 21, '2025-12-22 17:18:58', '2025-12-22 17:18:58'),
(667, 29.8, 90.8, 2531, 21, '2025-12-22 17:19:08', '2025-12-22 17:19:08'),
(668, 29.8, 90.8, 2559, 21, '2025-12-22 17:19:18', '2025-12-22 17:19:18'),
(669, 29.9, 90.8, 1648, 21, '2025-12-22 17:19:28', '2025-12-22 17:19:28'),
(670, 29.8, 90.9, 1648, 21, '2025-12-22 17:19:38', '2025-12-22 17:19:38'),
(671, 29.8, 90.8, 1638, 21, '2025-12-22 17:19:48', '2025-12-22 17:19:48'),
(672, 29.8, 90.8, 1623, 21, '2025-12-22 17:19:58', '2025-12-22 17:19:58'),
(673, 29.8, 90.8, 1646, 21, '2025-12-22 17:20:08', '2025-12-22 17:20:08'),
(674, 29.9, 90.7, 1641, 21, '2025-12-22 17:20:19', '2025-12-22 17:20:19'),
(675, 29.9, 90.7, 1626, 21, '2025-12-22 17:20:28', '2025-12-22 17:20:28'),
(676, 29.8, 90.7, 1631, 21, '2025-12-22 17:20:38', '2025-12-22 17:20:38'),
(677, 29.9, 90.8, 1646, 21, '2025-12-22 17:20:48', '2025-12-22 17:20:48'),
(678, 29.8, 90.7, 1632, 21, '2025-12-22 17:20:58', '2025-12-22 17:20:58'),
(679, 29.9, 90.8, 1633, 21, '2025-12-22 17:21:08', '2025-12-22 17:21:08'),
(680, 29.8, 90.8, 1635, 21, '2025-12-22 17:21:18', '2025-12-22 17:21:18'),
(681, 29.9, 90.8, 1624, 21, '2025-12-22 17:21:28', '2025-12-22 17:21:28'),
(682, 29.9, 90.8, 1642, 21, '2025-12-22 17:21:38', '2025-12-22 17:21:38'),
(683, 29.8, 90.8, 1636, 21, '2025-12-22 17:21:48', '2025-12-22 17:21:48'),
(684, 29.8, 90.8, 1643, 21, '2025-12-22 17:21:58', '2025-12-22 17:21:58'),
(685, 29.9, 90.8, 1638, 21, '2025-12-22 17:22:08', '2025-12-22 17:22:08'),
(686, 29.8, 90.8, 1635, 21, '2025-12-22 17:22:18', '2025-12-22 17:22:18'),
(687, 29.9, 90.8, 1638, 21, '2025-12-22 17:22:28', '2025-12-22 17:22:28'),
(688, 29.8, 90.7, 1635, 21, '2025-12-22 17:22:38', '2025-12-22 17:22:38'),
(689, 29.8, 90.8, 1633, 21, '2025-12-22 17:22:48', '2025-12-22 17:22:48'),
(690, 29.8, 90.8, 1635, 21, '2025-12-22 17:22:58', '2025-12-22 17:22:58'),
(691, 29.8, 90.7, 1639, 21, '2025-12-22 17:23:08', '2025-12-22 17:23:08'),
(692, 29.8, 90.7, 1634, 21, '2025-12-22 17:23:18', '2025-12-22 17:23:18'),
(693, 29.8, 90.7, 1623, 21, '2025-12-22 17:23:28', '2025-12-22 17:23:28'),
(694, 29.8, 90.7, 1651, 21, '2025-12-22 17:23:38', '2025-12-22 17:23:38'),
(695, 29.9, 90.7, 1631, 21, '2025-12-22 17:23:48', '2025-12-22 17:23:48'),
(696, 29.9, 90.8, 1634, 21, '2025-12-22 17:23:58', '2025-12-22 17:23:58'),
(697, 29.9, 90.8, 1635, 21, '2025-12-22 17:24:08', '2025-12-22 17:24:08'),
(698, 29.9, 90.7, 1637, 21, '2025-12-22 17:24:18', '2025-12-22 17:24:18'),
(699, 29.8, 90.7, 1629, 21, '2025-12-22 17:24:28', '2025-12-22 17:24:28'),
(700, 29.9, 90.8, 1645, 21, '2025-12-22 17:24:38', '2025-12-22 17:24:38'),
(701, 29.9, 90.7, 1637, 21, '2025-12-22 17:24:48', '2025-12-22 17:24:48');
INSERT INTO `sensor_data` (`id`, `suhu`, `kelembaban`, `soil`, `cahaya`, `created_at`, `updated_at`) VALUES
(702, 29.8, 90.7, 1630, 21, '2025-12-22 17:24:58', '2025-12-22 17:24:58'),
(703, 29.8, 90.7, 1638, 21, '2025-12-22 17:25:08', '2025-12-22 17:25:08'),
(704, 29.9, 90.7, 1642, 21, '2025-12-22 17:25:18', '2025-12-22 17:25:18'),
(705, 29.8, 90.8, 1635, 21, '2025-12-22 17:25:28', '2025-12-22 17:25:28'),
(706, 29.9, 90.8, 1633, 21, '2025-12-22 17:25:38', '2025-12-22 17:25:38'),
(707, 29.9, 90.8, 1631, 21, '2025-12-22 17:25:48', '2025-12-22 17:25:48'),
(708, 29.9, 90.7, 1635, 21, '2025-12-22 17:25:58', '2025-12-22 17:25:58'),
(709, 29.8, 90.7, 1639, 21, '2025-12-22 17:26:08', '2025-12-22 17:26:08'),
(710, 29.8, 90.7, 1635, 21, '2025-12-22 17:26:18', '2025-12-22 17:26:18'),
(711, 29.8, 90.8, 1645, 21, '2025-12-22 17:26:28', '2025-12-22 17:26:28'),
(712, 29.9, 90.8, 1635, 21, '2025-12-22 17:26:38', '2025-12-22 17:26:38'),
(713, 29.8, 90.8, 1632, 21, '2025-12-22 17:26:48', '2025-12-22 17:26:48'),
(714, 29.8, 90.8, 1628, 21, '2025-12-22 17:26:58', '2025-12-22 17:26:58'),
(715, 29.8, 90.8, 1623, 21, '2025-12-22 17:27:08', '2025-12-22 17:27:08'),
(716, 29.8, 90.7, 1638, 21, '2025-12-22 17:27:18', '2025-12-22 17:27:18'),
(717, 29.9, 90.7, 1633, 21, '2025-12-22 17:27:28', '2025-12-22 17:27:28'),
(718, 29.8, 90.7, 1648, 21, '2025-12-22 17:27:38', '2025-12-22 17:27:38'),
(719, 29.8, 90.7, 1630, 21, '2025-12-22 17:27:48', '2025-12-22 17:27:48'),
(720, 29.9, 90.8, 1645, 21, '2025-12-22 17:27:58', '2025-12-22 17:27:58'),
(721, 29.9, 90.7, 1615, 21, '2025-12-22 17:28:08', '2025-12-22 17:28:08'),
(722, 29.8, 90.8, 1617, 21, '2025-12-22 17:28:18', '2025-12-22 17:28:18'),
(723, 29.9, 90.7, 1629, 21, '2025-12-22 17:28:28', '2025-12-22 17:28:28'),
(724, 29.8, 90.7, 1634, 21, '2025-12-22 17:28:38', '2025-12-22 17:28:38'),
(725, 29.9, 90.7, 1627, 21, '2025-12-22 17:28:48', '2025-12-22 17:28:48'),
(726, 29.9, 90.7, 1621, 21, '2025-12-22 17:28:58', '2025-12-22 17:28:58'),
(727, 29.9, 90.7, 1630, 21, '2025-12-22 17:29:08', '2025-12-22 17:29:08'),
(728, 29.8, 90.7, 1558, 21, '2025-12-22 17:29:18', '2025-12-22 17:29:18'),
(729, 29.8, 90.7, 1628, 21, '2025-12-22 17:29:28', '2025-12-22 17:29:28'),
(730, 29.9, 90.8, 1627, 21, '2025-12-22 17:29:38', '2025-12-22 17:29:38'),
(731, 29.9, 90.8, 1639, 21, '2025-12-22 17:29:48', '2025-12-22 17:29:48'),
(732, 29.8, 90.7, 1636, 21, '2025-12-22 17:29:58', '2025-12-22 17:29:58'),
(733, 29.8, 90.8, 1627, 21, '2025-12-22 17:30:08', '2025-12-22 17:30:08'),
(734, 29.8, 90.7, 1635, 21, '2025-12-22 17:30:18', '2025-12-22 17:30:18'),
(735, 29.8, 90.7, 1603, 21, '2025-12-22 17:30:28', '2025-12-22 17:30:28'),
(736, 29.8, 90.7, 1631, 21, '2025-12-22 17:30:38', '2025-12-22 17:30:38'),
(737, 29.9, 90.8, 1634, 21, '2025-12-22 17:30:48', '2025-12-22 17:30:48'),
(738, 29.8, 90.7, 1582, 21, '2025-12-22 17:30:58', '2025-12-22 17:30:58'),
(739, 29.9, 90.7, 1635, 21, '2025-12-22 17:31:08', '2025-12-22 17:31:08'),
(740, 29.9, 90.7, 1636, 21, '2025-12-22 17:31:18', '2025-12-22 17:31:18'),
(741, 29.9, 90.7, 1629, 21, '2025-12-22 17:31:28', '2025-12-22 17:31:28'),
(742, 29.9, 90.7, 1621, 21, '2025-12-22 17:31:38', '2025-12-22 17:31:38'),
(743, 29.9, 90.7, 1634, 21, '2025-12-22 17:31:48', '2025-12-22 17:31:48'),
(744, 29.8, 90.7, 1631, 17, '2025-12-22 17:31:58', '2025-12-22 17:31:58'),
(745, 29.9, 90.8, 1604, 20, '2025-12-22 17:32:08', '2025-12-22 17:32:08'),
(746, 29.9, 90.8, 1631, 20, '2025-12-22 17:32:18', '2025-12-22 17:32:18'),
(747, 29.8, 90.8, 1616, 20, '2025-12-22 17:32:28', '2025-12-22 17:32:28'),
(748, 29.9, 90.8, 1627, 20, '2025-12-22 17:32:38', '2025-12-22 17:32:38'),
(749, 29.8, 90.7, 1628, 20, '2025-12-22 17:32:48', '2025-12-22 17:32:48'),
(750, 29.8, 90.8, 1637, 20, '2025-12-22 17:32:58', '2025-12-22 17:32:58'),
(751, 29.9, 90.8, 2544, 20, '2025-12-22 17:33:08', '2025-12-22 17:33:08'),
(752, 29.9, 90.7, 2526, 20, '2025-12-22 17:33:18', '2025-12-22 17:33:18'),
(753, 29.9, 90.7, 2519, 20, '2025-12-22 17:33:28', '2025-12-22 17:33:28'),
(754, 29.9, 90.7, 2557, 20, '2025-12-22 17:33:38', '2025-12-22 17:33:38'),
(755, 29.9, 90.7, 2559, 20, '2025-12-22 17:33:48', '2025-12-22 17:33:48'),
(756, 29.8, 90.7, 2548, 20, '2025-12-22 17:33:58', '2025-12-22 17:33:58'),
(757, 29.9, 90.8, 2540, 20, '2025-12-22 17:34:08', '2025-12-22 17:34:08'),
(758, 29.8, 90.7, 1517, 20, '2025-12-22 17:34:18', '2025-12-22 17:34:18'),
(759, 29.8, 90.8, 1629, 20, '2025-12-22 17:34:28', '2025-12-22 17:34:28'),
(760, 29.9, 90.7, 1633, 20, '2025-12-22 17:34:38', '2025-12-22 17:34:38'),
(761, 29.9, 90.7, 1626, 20, '2025-12-22 17:34:48', '2025-12-22 17:34:48'),
(762, 29.8, 90.7, 1629, 20, '2025-12-22 17:34:58', '2025-12-22 17:34:58'),
(763, 29.8, 90.7, 1631, 20, '2025-12-22 17:35:08', '2025-12-22 17:35:08'),
(764, 29.9, 90.7, 1626, 20, '2025-12-22 17:35:18', '2025-12-22 17:35:18'),
(765, 29.8, 90.7, 1655, 20, '2025-12-22 17:35:28', '2025-12-22 17:35:28'),
(766, 29.8, 90.7, 1626, 20, '2025-12-22 17:35:38', '2025-12-22 17:35:38'),
(767, 29.8, 90.7, 1627, 20, '2025-12-22 17:35:48', '2025-12-22 17:35:48'),
(768, 29.9, 90.7, 1618, 20, '2025-12-22 17:35:58', '2025-12-22 17:35:58'),
(769, 29.8, 90.7, 1617, 20, '2025-12-22 17:36:08', '2025-12-22 17:36:08'),
(770, 29.8, 90.7, 2546, 20, '2025-12-22 17:36:18', '2025-12-22 17:36:18'),
(771, 29.9, 90.7, 2547, 20, '2025-12-22 17:36:28', '2025-12-22 17:36:28'),
(772, 29.9, 90.7, 2548, 19, '2025-12-22 17:36:38', '2025-12-22 17:36:38'),
(773, 29.9, 90.8, 2544, 20, '2025-12-22 17:36:48', '2025-12-22 17:36:48'),
(774, 29.8, 90.7, 2549, 20, '2025-12-22 17:36:58', '2025-12-22 17:36:58'),
(775, 29.9, 90.7, 1424, 20, '2025-12-22 17:37:08', '2025-12-22 17:37:08'),
(776, 29.9, 90.7, 1447, 20, '2025-12-22 17:37:18', '2025-12-22 17:37:18'),
(777, 29.9, 90.7, 1452, 20, '2025-12-22 17:37:28', '2025-12-22 17:37:28'),
(778, 29.9, 90.7, 1429, 20, '2025-12-22 17:37:38', '2025-12-22 17:37:38'),
(779, 29.9, 90.7, 1435, 20, '2025-12-22 17:37:48', '2025-12-22 17:37:48'),
(780, 29.9, 90.8, 1425, 20, '2025-12-22 17:37:58', '2025-12-22 17:37:58'),
(781, 29.9, 90.8, 1424, 20, '2025-12-22 17:38:08', '2025-12-22 17:38:08'),
(782, 29.9, 90.8, 1430, 20, '2025-12-22 17:38:18', '2025-12-22 17:38:18'),
(783, 29.9, 90.8, 1429, 20, '2025-12-22 17:38:28', '2025-12-22 17:38:28'),
(784, 29.9, 90.8, 1427, 20, '2025-12-22 17:38:38', '2025-12-22 17:38:38'),
(785, 29.9, 90.7, 1433, 19, '2025-12-22 17:38:48', '2025-12-22 17:38:48'),
(786, 29.9, 90.8, 1443, 20, '2025-12-22 17:38:58', '2025-12-22 17:38:58'),
(787, 29.9, 90.7, 1431, 19, '2025-12-22 17:39:08', '2025-12-22 17:39:08'),
(788, 29.9, 90.7, 1433, 19, '2025-12-22 17:39:18', '2025-12-22 17:39:18'),
(789, 29.9, 90.7, 1439, 19, '2025-12-22 17:39:28', '2025-12-22 17:39:28'),
(790, 29.9, 90.8, 1446, 19, '2025-12-22 17:39:38', '2025-12-22 17:39:38'),
(791, 30, 94.1, 1437, 19, '2025-12-22 17:39:48', '2025-12-22 17:39:48'),
(792, 30.4, 94.6, 1432, 167, '2025-12-22 17:39:58', '2025-12-22 17:39:58'),
(793, 30.5, 92.1, 1437, 16, '2025-12-22 17:40:08', '2025-12-22 17:40:08'),
(794, 30.6, 90.4, 1431, 23, '2025-12-22 17:40:18', '2025-12-22 17:40:18'),
(795, 30.6, 89.1, 1431, 23, '2025-12-22 17:40:28', '2025-12-22 17:40:28'),
(796, 30.5, 88.7, 1431, 23, '2025-12-22 17:40:38', '2025-12-22 17:40:38'),
(797, 30.5, 88.5, 1431, 23, '2025-12-22 17:40:48', '2025-12-22 17:40:48'),
(798, 30.5, 88.5, 1433, 23, '2025-12-22 17:40:58', '2025-12-22 17:40:58'),
(799, 30.4, 88.4, 1433, 22, '2025-12-22 17:41:08', '2025-12-22 17:41:08'),
(800, 30.4, 88.5, 1435, 22, '2025-12-22 17:41:18', '2025-12-22 17:41:18'),
(801, 30.4, 88.6, 1430, 22, '2025-12-22 17:41:28', '2025-12-22 17:41:28'),
(802, 30.4, 88.7, 1425, 22, '2025-12-22 17:41:38', '2025-12-22 17:41:38'),
(803, 30.3, 88.7, 1440, 22, '2025-12-22 17:41:48', '2025-12-22 17:41:48'),
(804, 30.3, 88.8, 1409, 22, '2025-12-22 17:41:58', '2025-12-22 17:41:58'),
(805, 30.3, 89, 1446, 22, '2025-12-22 17:42:08', '2025-12-22 17:42:08'),
(806, 30.2, 89.1, 1431, 22, '2025-12-22 17:42:18', '2025-12-22 17:42:18'),
(807, 30.2, 89.2, 1424, 20, '2025-12-22 17:42:28', '2025-12-22 17:42:28'),
(808, 30.2, 89.2, 1431, 19, '2025-12-22 17:42:38', '2025-12-22 17:42:38'),
(809, 30.2, 89.4, 1417, 15, '2025-12-22 17:42:48', '2025-12-22 17:42:48'),
(810, 30.1, 89.4, 1441, 11, '2025-12-22 17:42:58', '2025-12-22 17:42:58'),
(811, 30.1, 89.5, 2258, 14, '2025-12-22 17:43:08', '2025-12-22 17:43:08'),
(812, 30.1, 89.6, 2256, 14, '2025-12-22 17:43:18', '2025-12-22 17:43:18'),
(813, 30.1, 89.6, 2258, 15, '2025-12-22 17:43:28', '2025-12-22 17:43:28'),
(814, 30.1, 89.7, 2252, 15, '2025-12-22 17:43:38', '2025-12-22 17:43:38'),
(815, 30.1, 89.7, 2256, 14, '2025-12-22 17:43:48', '2025-12-22 17:43:48'),
(816, 30.1, 89.8, 2330, 14, '2025-12-22 17:43:58', '2025-12-22 17:43:58'),
(817, 30.1, 89.8, 2199, 14, '2025-12-22 17:44:08', '2025-12-22 17:44:08'),
(818, 30.1, 89.8, 2193, 15, '2025-12-22 17:44:18', '2025-12-22 17:44:18'),
(819, 30.1, 89.8, 2187, 14, '2025-12-22 17:44:28', '2025-12-22 17:44:28'),
(820, 30.1, 89.8, 2183, 14, '2025-12-22 17:44:38', '2025-12-22 17:44:38'),
(821, 0, 0, 2197, 14, '2025-12-22 17:44:53', '2025-12-22 17:44:53'),
(822, 0, 0, 2147, 14, '2025-12-22 17:45:03', '2025-12-22 17:45:03'),
(823, 0, 0, 2211, 14, '2025-12-22 17:45:13', '2025-12-22 17:45:13'),
(824, 0, 0, 2191, 15, '2025-12-22 17:45:23', '2025-12-22 17:45:23'),
(825, 0, 0, 2182, 14, '2025-12-22 17:45:33', '2025-12-22 17:45:33'),
(826, 0, 0, 2172, 14, '2025-12-22 17:45:43', '2025-12-22 17:45:43'),
(827, 0, 0, 2174, 14, '2025-12-22 17:45:53', '2025-12-22 17:45:53'),
(828, 0, 0, 2177, 14, '2025-12-22 17:46:03', '2025-12-22 17:46:03'),
(829, 0, 0, 2192, 15, '2025-12-22 17:46:13', '2025-12-22 17:46:13'),
(830, 0, 0, 2174, 14, '2025-12-22 17:46:23', '2025-12-22 17:46:23'),
(831, 0, 0, 2160, 14, '2025-12-22 17:46:33', '2025-12-22 17:46:33'),
(832, 0, 0, 2178, 15, '2025-12-22 17:46:43', '2025-12-22 17:46:43'),
(833, 0, 0, 1785, 15, '2025-12-22 17:46:53', '2025-12-22 17:46:53'),
(834, 0, 0, 1784, 15, '2025-12-22 17:47:03', '2025-12-22 17:47:03'),
(835, 0, 0, 1783, 15, '2025-12-22 17:47:13', '2025-12-22 17:47:13'),
(836, 0, 0, 1783, 15, '2025-12-22 17:47:23', '2025-12-22 17:47:23'),
(837, 0, 0, 1781, 15, '2025-12-22 17:47:33', '2025-12-22 17:47:33'),
(838, 0, 0, 1765, 15, '2025-12-22 17:47:43', '2025-12-22 17:47:43'),
(839, 0, 0, 1777, 14, '2025-12-22 17:47:53', '2025-12-22 17:47:53'),
(840, 0, 0, 1780, 14, '2025-12-22 17:48:03', '2025-12-22 17:48:03'),
(841, 29.8, 90.8, 1808, 14, '2025-12-22 17:48:25', '2025-12-22 17:48:25'),
(842, 29.9, 90.8, 1776, 15, '2025-12-22 17:48:35', '2025-12-22 17:48:35'),
(843, 29.9, 90.7, 1785, 14, '2025-12-22 17:48:45', '2025-12-22 17:48:45'),
(844, 29.9, 90.7, 1808, 14, '2025-12-22 17:48:55', '2025-12-22 17:48:55'),
(845, 29.9, 90.7, 1792, 14, '2025-12-22 17:49:05', '2025-12-22 17:49:05'),
(846, 29.9, 90.7, 1793, 14, '2025-12-22 17:49:15', '2025-12-22 17:49:15'),
(847, 29.9, 90.7, 1775, 14, '2025-12-22 17:49:25', '2025-12-22 17:49:25'),
(848, 29.9, 90.7, 1791, 14, '2025-12-22 17:49:35', '2025-12-22 17:49:35'),
(849, 29.9, 90.6, 1793, 14, '2025-12-22 17:49:45', '2025-12-22 17:49:45'),
(850, 29.9, 90.6, 1792, 14, '2025-12-22 17:49:55', '2025-12-22 17:49:55'),
(851, 29.9, 90.6, 1791, 14, '2025-12-22 17:50:05', '2025-12-22 17:50:05'),
(852, 29.9, 90.6, 1793, 14, '2025-12-22 17:50:15', '2025-12-22 17:50:15'),
(853, 29.9, 90.6, 1798, 15, '2025-12-22 17:50:25', '2025-12-22 17:50:25'),
(854, 29.9, 90.7, 1791, 14, '2025-12-22 17:50:35', '2025-12-22 17:50:35'),
(855, 29.9, 90.7, 1780, 14, '2025-12-22 17:50:45', '2025-12-22 17:50:45'),
(856, 29.9, 90.6, 1789, 14, '2025-12-22 17:50:55', '2025-12-22 17:50:55'),
(857, 29.9, 90.6, 1791, 14, '2025-12-22 17:51:05', '2025-12-22 17:51:05'),
(858, 29.9, 90.6, 1788, 13, '2025-12-22 17:51:15', '2025-12-22 17:51:15'),
(859, 29.9, 90.6, 1787, 14, '2025-12-22 17:51:25', '2025-12-22 17:51:25'),
(860, 29.9, 90.6, 1792, 14, '2025-12-22 17:51:35', '2025-12-22 17:51:35'),
(861, 29.9, 90.6, 1791, 14, '2025-12-22 17:51:45', '2025-12-22 17:51:45'),
(862, 29.9, 90.6, 1789, 14, '2025-12-22 17:51:55', '2025-12-22 17:51:55'),
(863, 29.9, 90.6, 1791, 14, '2025-12-22 17:52:05', '2025-12-22 17:52:05'),
(864, 29.9, 90.6, 1791, 14, '2025-12-22 17:52:15', '2025-12-22 17:52:15'),
(865, 29.9, 90.6, 1795, 14, '2025-12-22 17:52:25', '2025-12-22 17:52:25'),
(866, 29.9, 90.6, 1794, 14, '2025-12-22 17:52:35', '2025-12-22 17:52:35'),
(867, 29.9, 90.6, 1806, 14, '2025-12-22 17:52:45', '2025-12-22 17:52:45'),
(868, 29.9, 90.6, 1790, 14, '2025-12-22 17:52:55', '2025-12-22 17:52:55'),
(869, 29.9, 90.6, 1779, 14, '2025-12-22 17:53:05', '2025-12-22 17:53:05'),
(870, 29.9, 90.6, 1762, 15, '2025-12-22 17:53:15', '2025-12-22 17:53:15'),
(871, 29.9, 90.6, 1790, 15, '2025-12-22 17:53:25', '2025-12-22 17:53:25'),
(872, 29.9, 90.6, 2595, 14, '2025-12-22 17:53:35', '2025-12-22 17:53:35'),
(873, 29.9, 90.5, 2593, 12, '2025-12-22 17:53:45', '2025-12-22 17:53:45'),
(874, 29.9, 90.6, 1648, 15, '2025-12-22 17:53:55', '2025-12-22 17:53:55'),
(875, 29.9, 90.6, 1642, 15, '2025-12-22 17:54:05', '2025-12-22 17:54:05'),
(876, 29.9, 90.6, 1584, 15, '2025-12-22 17:54:15', '2025-12-22 17:54:15'),
(877, 29.9, 90.6, 1616, 15, '2025-12-22 17:54:25', '2025-12-22 17:54:25'),
(878, 29.9, 90.6, 1680, 14, '2025-12-22 17:54:35', '2025-12-22 17:54:35'),
(879, 29.9, 90.6, 1627, 14, '2025-12-22 17:54:46', '2025-12-22 17:54:46'),
(880, 29.9, 90.6, 1607, 14, '2025-12-22 17:54:55', '2025-12-22 17:54:55'),
(881, 29.9, 90.5, 1619, 14, '2025-12-22 17:55:05', '2025-12-22 17:55:05'),
(882, 29.9, 90.5, 1619, 14, '2025-12-22 17:55:15', '2025-12-22 17:55:15'),
(883, 29.9, 90.5, 1618, 14, '2025-12-22 17:55:25', '2025-12-22 17:55:25'),
(884, 29.9, 90.6, 1623, 14, '2025-12-22 17:55:35', '2025-12-22 17:55:35'),
(885, 29.9, 90.6, 1599, 14, '2025-12-22 17:55:45', '2025-12-22 17:55:45'),
(886, 29.9, 90.6, 1609, 14, '2025-12-22 17:55:55', '2025-12-22 17:55:55'),
(887, 29.9, 90.6, 1640, 15, '2025-12-22 17:56:05', '2025-12-22 17:56:05'),
(888, 29.9, 90.6, 1622, 14, '2025-12-22 17:56:15', '2025-12-22 17:56:15'),
(889, 29.9, 90.6, 1633, 14, '2025-12-22 17:56:25', '2025-12-22 17:56:25'),
(890, 29.9, 90.7, 1617, 15, '2025-12-22 17:56:35', '2025-12-22 17:56:35'),
(891, 29.9, 90.6, 1616, 15, '2025-12-22 17:56:45', '2025-12-22 17:56:45'),
(892, 29.9, 90.6, 1611, 15, '2025-12-22 17:56:55', '2025-12-22 17:56:55'),
(893, 29.9, 90.6, 1632, 15, '2025-12-22 17:57:05', '2025-12-22 17:57:05'),
(894, 29.9, 90.6, 1619, 15, '2025-12-22 17:57:15', '2025-12-22 17:57:15'),
(895, 29.9, 90.5, 1616, 15, '2025-12-22 17:57:25', '2025-12-22 17:57:25'),
(896, 29.9, 90.5, 1616, 15, '2025-12-22 17:57:35', '2025-12-22 17:57:35'),
(897, 29.9, 90.6, 1619, 15, '2025-12-22 17:57:45', '2025-12-22 17:57:45'),
(898, 29.9, 90.6, 1616, 14, '2025-12-22 17:57:55', '2025-12-22 17:57:55'),
(899, 29.9, 90.5, 1612, 13, '2025-12-22 17:58:05', '2025-12-22 17:58:05'),
(900, 29.9, 90.6, 1615, 13, '2025-12-22 17:58:15', '2025-12-22 17:58:15'),
(901, 29.9, 90.6, 1612, 13, '2025-12-22 17:58:25', '2025-12-22 17:58:25'),
(902, 29.9, 90.5, 1618, 13, '2025-12-22 17:58:35', '2025-12-22 17:58:35'),
(903, 29.9, 90.6, 1619, 13, '2025-12-22 17:59:15', '2025-12-22 17:59:15'),
(904, 29.9, 90.6, 1629, 13, '2025-12-22 17:59:25', '2025-12-22 17:59:25'),
(905, 29.9, 90.6, 1617, 13, '2025-12-22 17:59:35', '2025-12-22 17:59:35'),
(906, 29.9, 90.6, 1611, 13, '2025-12-22 17:59:45', '2025-12-22 17:59:45'),
(907, 29.9, 90.6, 1623, 13, '2025-12-22 17:59:55', '2025-12-22 17:59:55'),
(908, 29.9, 90.6, 1616, 13, '2025-12-22 18:00:05', '2025-12-22 18:00:05'),
(909, 29.9, 90.5, 1616, 13, '2025-12-22 18:00:15', '2025-12-22 18:00:15'),
(910, 29.9, 90.5, 1616, 13, '2025-12-22 18:00:25', '2025-12-22 18:00:25'),
(911, 29.9, 90.5, 1670, 12, '2025-12-22 18:00:35', '2025-12-22 18:00:35'),
(912, 29.9, 90.5, 1616, 12, '2025-12-22 18:00:45', '2025-12-22 18:00:45'),
(913, 29.9, 90.6, 1586, 13, '2025-12-22 18:00:55', '2025-12-22 18:00:55'),
(914, 29.9, 90.5, 1616, 12, '2025-12-22 18:01:05', '2025-12-22 18:01:05'),
(915, 29.9, 90.5, 1618, 12, '2025-12-22 18:01:15', '2025-12-22 18:01:15'),
(916, 29.9, 90.5, 1616, 12, '2025-12-22 18:01:25', '2025-12-22 18:01:25'),
(917, 29.9, 90.5, 1614, 12, '2025-12-22 18:01:35', '2025-12-22 18:01:35'),
(918, 29.9, 90.4, 1616, 13, '2025-12-22 18:01:55', '2025-12-22 18:01:55'),
(919, 29.9, 90.5, 1615, 13, '2025-12-22 18:02:05', '2025-12-22 18:02:05'),
(920, 29.9, 90.5, 1619, 13, '2025-12-22 18:02:15', '2025-12-22 18:02:15'),
(921, 29.9, 90.5, 1617, 13, '2025-12-22 18:02:25', '2025-12-22 18:02:25'),
(922, 29.9, 90.5, 1614, 13, '2025-12-22 18:02:35', '2025-12-22 18:02:35'),
(923, 29.9, 90.5, 1616, 13, '2025-12-22 18:02:45', '2025-12-22 18:02:45'),
(924, 29.9, 90.5, 1621, 13, '2025-12-22 18:02:55', '2025-12-22 18:02:55'),
(925, 29.9, 90.5, 1600, 13, '2025-12-22 18:03:05', '2025-12-22 18:03:05'),
(926, 29.9, 90.5, 1625, 12, '2025-12-22 18:03:15', '2025-12-22 18:03:15'),
(927, 29.9, 90.5, 1603, 13, '2025-12-22 18:03:25', '2025-12-22 18:03:25'),
(928, 29.9, 90.5, 1614, 13, '2025-12-22 18:03:35', '2025-12-22 18:03:35'),
(929, 29.9, 90.5, 1616, 13, '2025-12-22 18:03:45', '2025-12-22 18:03:45'),
(930, 29.9, 90.5, 1605, 13, '2025-12-22 18:03:55', '2025-12-22 18:03:55'),
(931, 29.9, 90.5, 1615, 13, '2025-12-22 18:04:05', '2025-12-22 18:04:05'),
(932, 29.9, 90.5, 1616, 13, '2025-12-22 18:04:15', '2025-12-22 18:04:15'),
(933, 29.9, 90.5, 1616, 13, '2025-12-22 18:04:25', '2025-12-22 18:04:25'),
(934, 29.9, 90.5, 1572, 13, '2025-12-22 18:04:35', '2025-12-22 18:04:35'),
(935, 29.9, 90.5, 1610, 13, '2025-12-22 18:04:45', '2025-12-22 18:04:45'),
(936, 29.9, 90.5, 1618, 13, '2025-12-22 18:04:55', '2025-12-22 18:04:55'),
(937, 29.9, 90.5, 1584, 13, '2025-12-22 18:05:05', '2025-12-22 18:05:05'),
(938, 29.9, 90.6, 1621, 13, '2025-12-22 18:05:15', '2025-12-22 18:05:15'),
(939, 29.9, 90.5, 1617, 13, '2025-12-22 18:05:25', '2025-12-22 18:05:25'),
(940, 29.9, 90.6, 1585, 13, '2025-12-22 18:05:35', '2025-12-22 18:05:35'),
(941, 29.9, 90.5, 1616, 13, '2025-12-22 18:05:45', '2025-12-22 18:05:45'),
(942, 29.9, 90.5, 1616, 13, '2025-12-22 18:05:55', '2025-12-22 18:05:55'),
(943, 29.9, 90.5, 1614, 13, '2025-12-22 18:06:05', '2025-12-22 18:06:05'),
(944, 29.9, 90.6, 1616, 13, '2025-12-22 18:06:15', '2025-12-22 18:06:15'),
(945, 29.9, 90.6, 1616, 13, '2025-12-22 18:06:25', '2025-12-22 18:06:25'),
(946, 29.9, 90.5, 1612, 13, '2025-12-22 18:06:35', '2025-12-22 18:06:35'),
(947, 29.9, 90.5, 1607, 13, '2025-12-22 18:06:45', '2025-12-22 18:06:45'),
(948, 29.9, 90.5, 1624, 13, '2025-12-22 18:06:55', '2025-12-22 18:06:55'),
(949, 29.9, 90.5, 1601, 13, '2025-12-22 18:07:05', '2025-12-22 18:07:05'),
(950, 29.9, 90.6, 1599, 13, '2025-12-22 18:07:15', '2025-12-22 18:07:15'),
(951, 29.9, 90.5, 1682, 13, '2025-12-22 18:07:25', '2025-12-22 18:07:25'),
(952, 29.9, 90.6, 1616, 13, '2025-12-22 18:07:35', '2025-12-22 18:07:35'),
(953, 29.9, 90.6, 1582, 13, '2025-12-22 18:07:45', '2025-12-22 18:07:45'),
(954, 29.9, 90.6, 1613, 13, '2025-12-22 18:07:55', '2025-12-22 18:07:55'),
(955, 29.9, 90.6, 1616, 13, '2025-12-22 18:08:05', '2025-12-22 18:08:05'),
(956, 29.9, 90.5, 1616, 13, '2025-12-22 18:08:15', '2025-12-22 18:08:15'),
(957, 29.9, 90.5, 1618, 13, '2025-12-22 18:08:25', '2025-12-22 18:08:25'),
(958, 29.9, 90.5, 1620, 13, '2025-12-22 18:08:35', '2025-12-22 18:08:35'),
(959, 29.9, 90.5, 1630, 12, '2025-12-22 18:08:45', '2025-12-22 18:08:45'),
(960, 29.9, 90.5, 1625, 12, '2025-12-22 18:08:55', '2025-12-22 18:08:55'),
(961, 29.9, 90.6, 1616, 12, '2025-12-22 18:09:05', '2025-12-22 18:09:05'),
(962, 29.9, 90.5, 1610, 12, '2025-12-22 18:09:15', '2025-12-22 18:09:15'),
(963, 29.9, 90.5, 1610, 12, '2025-12-22 18:09:25', '2025-12-22 18:09:25'),
(964, 29.9, 90.5, 1616, 9, '2025-12-22 18:09:35', '2025-12-22 18:09:35'),
(965, 29.9, 90.5, 1616, 9, '2025-12-22 18:09:45', '2025-12-22 18:09:45'),
(966, 29.9, 90.5, 1614, 9, '2025-12-22 18:09:55', '2025-12-22 18:09:55'),
(967, 29.9, 90.5, 1618, 9, '2025-12-22 18:10:05', '2025-12-22 18:10:05'),
(968, 29.9, 90.5, 1616, 9, '2025-12-22 18:10:15', '2025-12-22 18:10:15'),
(969, 29.9, 90.5, 1616, 14, '2025-12-22 18:10:25', '2025-12-22 18:10:25'),
(970, 29.9, 90.5, 1591, 72, '2025-12-22 18:10:35', '2025-12-22 18:10:35'),
(971, 29.9, 90.5, 1634, 27, '2025-12-22 18:10:45', '2025-12-22 18:10:45'),
(972, 29.9, 90.5, 1611, 18, '2025-12-22 18:10:55', '2025-12-22 18:10:55'),
(973, 29.9, 90.5, 1614, 14, '2025-12-22 18:11:05', '2025-12-22 18:11:05'),
(974, 29.9, 90.5, 1627, 14, '2025-12-22 18:11:15', '2025-12-22 18:11:15'),
(975, 29.9, 90.5, 1616, 14, '2025-12-22 18:11:25', '2025-12-22 18:11:25'),
(976, 29.9, 90.4, 1618, 14, '2025-12-22 18:11:35', '2025-12-22 18:11:35'),
(977, 29.9, 90.5, 1615, 14, '2025-12-22 18:11:45', '2025-12-22 18:11:45'),
(978, 29.9, 90.5, 1585, 14, '2025-12-22 18:11:55', '2025-12-22 18:11:55'),
(979, 29.9, 90.4, 1611, 14, '2025-12-22 18:12:05', '2025-12-22 18:12:05'),
(980, 29.9, 90.4, 1612, 14, '2025-12-22 18:12:15', '2025-12-22 18:12:15'),
(981, 29.9, 90.4, 1615, 14, '2025-12-22 18:12:25', '2025-12-22 18:12:25'),
(982, 29.9, 90.4, 1628, 14, '2025-12-22 18:12:35', '2025-12-22 18:12:35'),
(983, 29.9, 90.4, 1637, 14, '2025-12-22 18:12:45', '2025-12-22 18:12:45'),
(984, 29.9, 90.4, 1631, 14, '2025-12-22 18:12:55', '2025-12-22 18:12:55'),
(985, 29.9, 90.4, 1615, 14, '2025-12-22 18:13:05', '2025-12-22 18:13:05'),
(986, 29.9, 90.5, 1616, 14, '2025-12-22 18:13:15', '2025-12-22 18:13:15'),
(987, 29.9, 90.5, 1620, 14, '2025-12-22 18:13:25', '2025-12-22 18:13:25'),
(988, 29.9, 90.4, 1615, 14, '2025-12-22 18:13:35', '2025-12-22 18:13:35'),
(989, 29.9, 90.4, 1616, 14, '2025-12-22 18:13:45', '2025-12-22 18:13:45'),
(990, 29.9, 90.4, 1615, 14, '2025-12-22 18:13:55', '2025-12-22 18:13:55'),
(991, 29.9, 90.4, 1610, 14, '2025-12-22 18:14:05', '2025-12-22 18:14:05'),
(992, 29.9, 90.4, 1616, 14, '2025-12-22 18:14:15', '2025-12-22 18:14:15'),
(993, 29.9, 90.4, 1599, 15, '2025-12-22 18:14:25', '2025-12-22 18:14:25'),
(994, 29.9, 90.7, 1610, 15, '2025-12-22 18:14:35', '2025-12-22 18:14:35'),
(995, 29.9, 90.6, 1614, 15, '2025-12-22 18:14:45', '2025-12-22 18:14:45'),
(996, 29.9, 90.6, 1612, 15, '2025-12-22 18:14:55', '2025-12-22 18:14:55'),
(997, 29.9, 90.5, 1617, 15, '2025-12-22 18:15:05', '2025-12-22 18:15:05'),
(998, 29.9, 90.5, 1616, 15, '2025-12-22 18:15:15', '2025-12-22 18:15:15'),
(999, 29.9, 90.4, 1615, 15, '2025-12-22 18:15:25', '2025-12-22 18:15:25'),
(1000, 29.9, 90.4, 1616, 15, '2025-12-22 18:15:35', '2025-12-22 18:15:35'),
(1001, 29.9, 90.4, 1607, 15, '2025-12-22 18:15:45', '2025-12-22 18:15:45'),
(1002, 29.9, 90.4, 1612, 15, '2025-12-22 18:15:55', '2025-12-22 18:15:55'),
(1003, 29.9, 90.4, 1626, 15, '2025-12-22 18:16:05', '2025-12-22 18:16:05'),
(1004, 29.9, 90.4, 1587, 15, '2025-12-22 18:16:15', '2025-12-22 18:16:15'),
(1005, 29.9, 90.5, 1616, 15, '2025-12-22 18:16:25', '2025-12-22 18:16:25'),
(1006, 29.9, 90.5, 1602, 15, '2025-12-22 18:16:35', '2025-12-22 18:16:35'),
(1007, 29.9, 90.5, 1615, 15, '2025-12-22 18:16:45', '2025-12-22 18:16:45'),
(1008, 29.9, 90.5, 1610, 15, '2025-12-22 18:16:55', '2025-12-22 18:16:55'),
(1009, 29.9, 90.5, 1611, 15, '2025-12-22 18:17:05', '2025-12-22 18:17:05'),
(1010, 29.9, 90.5, 1612, 15, '2025-12-22 18:17:15', '2025-12-22 18:17:15'),
(1011, 29.9, 90.5, 1609, 14, '2025-12-22 18:17:25', '2025-12-22 18:17:25'),
(1012, 29.9, 90.4, 1616, 14, '2025-12-22 18:17:35', '2025-12-22 18:17:35'),
(1013, 29.9, 90.5, 1616, 14, '2025-12-22 18:17:45', '2025-12-22 18:17:45'),
(1014, 29.9, 90.5, 1621, 14, '2025-12-22 18:17:55', '2025-12-22 18:17:55'),
(1015, 29.9, 90.5, 1616, 15, '2025-12-22 18:18:05', '2025-12-22 18:18:05'),
(1016, 29.9, 90.5, 1617, 14, '2025-12-22 18:18:15', '2025-12-22 18:18:15'),
(1017, 29.9, 90.5, 1610, 15, '2025-12-22 18:18:25', '2025-12-22 18:18:25'),
(1018, 29.9, 90.5, 1631, 15, '2025-12-22 18:18:35', '2025-12-22 18:18:35'),
(1019, 29.9, 90.5, 1616, 15, '2025-12-22 18:18:45', '2025-12-22 18:18:45'),
(1020, 29.9, 90.6, 1613, 15, '2025-12-22 18:18:55', '2025-12-22 18:18:55'),
(1021, 29.9, 90.5, 1615, 15, '2025-12-22 18:19:05', '2025-12-22 18:19:05'),
(1022, 29.9, 90.5, 1615, 14, '2025-12-22 18:19:15', '2025-12-22 18:19:15'),
(1023, 29.9, 90.5, 1614, 14, '2025-12-22 18:19:25', '2025-12-22 18:19:25'),
(1024, 29.9, 90.5, 1598, 14, '2025-12-22 18:19:35', '2025-12-22 18:19:35'),
(1025, 29.9, 90.6, 1616, 14, '2025-12-22 18:19:45', '2025-12-22 18:19:45'),
(1026, 29.9, 90.6, 1605, 14, '2025-12-22 18:19:55', '2025-12-22 18:19:55'),
(1027, 29.9, 90.5, 1612, 14, '2025-12-22 18:20:05', '2025-12-22 18:20:05'),
(1028, 29.9, 90.5, 1613, 14, '2025-12-22 18:20:15', '2025-12-22 18:20:15'),
(1029, 29.9, 90.5, 1613, 14, '2025-12-22 18:20:25', '2025-12-22 18:20:25'),
(1030, 29.9, 90.5, 1620, 13, '2025-12-22 18:20:35', '2025-12-22 18:20:35'),
(1031, 29.9, 90.5, 1616, 14, '2025-12-22 18:20:45', '2025-12-22 18:20:45'),
(1032, 29.9, 90.6, 1584, 14, '2025-12-22 18:20:55', '2025-12-22 18:20:55'),
(1033, 29.9, 90.6, 1630, 14, '2025-12-22 18:21:05', '2025-12-22 18:21:05'),
(1034, 29.9, 90.6, 1616, 14, '2025-12-22 18:21:15', '2025-12-22 18:21:15'),
(1035, 29.9, 90.6, 1616, 14, '2025-12-22 18:21:25', '2025-12-22 18:21:25'),
(1036, 29.9, 90.6, 1612, 14, '2025-12-22 18:21:35', '2025-12-22 18:21:35'),
(1037, 29.9, 90.5, 1623, 14, '2025-12-22 18:21:45', '2025-12-22 18:21:45'),
(1038, 29.9, 90.5, 1614, 14, '2025-12-22 18:21:55', '2025-12-22 18:21:55'),
(1039, 29.9, 90.5, 1614, 14, '2025-12-22 18:22:05', '2025-12-22 18:22:05'),
(1040, 29.9, 90.6, 1615, 14, '2025-12-22 18:22:15', '2025-12-22 18:22:15'),
(1041, 29.9, 90.6, 1616, 14, '2025-12-22 18:22:25', '2025-12-22 18:22:25'),
(1042, 29.9, 90.6, 1612, 14, '2025-12-22 18:22:35', '2025-12-22 18:22:35'),
(1043, 29.5, 89.2, 2606, 102, '2025-12-22 23:58:30', '2025-12-22 23:58:30'),
(1044, 29.5, 88.8, 2587, 102, '2025-12-22 23:58:40', '2025-12-22 23:58:40'),
(1045, 29.5, 88.7, 2603, 102, '2025-12-22 23:58:50', '2025-12-22 23:58:50'),
(1046, 29.5, 88.6, 2593, 102, '2025-12-22 23:59:00', '2025-12-22 23:59:00'),
(1047, 29.5, 88.6, 2559, 102, '2025-12-22 23:59:10', '2025-12-22 23:59:10'),
(1048, 29.5, 88.6, 2594, 102, '2025-12-22 23:59:20', '2025-12-22 23:59:20'),
(1049, 29.5, 88.6, 2609, 21, '2025-12-22 23:59:30', '2025-12-22 23:59:30'),
(1050, 29.5, 88.6, 2605, 62, '2025-12-22 23:59:40', '2025-12-22 23:59:40'),
(1051, 29.5, 88.6, 2625, 34, '2025-12-22 23:59:50', '2025-12-22 23:59:50'),
(1052, 29.5, 88.6, 2559, 38, '2025-12-23 00:00:00', '2025-12-23 00:00:00'),
(1053, 29.5, 88.6, 2641, 38, '2025-12-23 00:00:10', '2025-12-23 00:00:10'),
(1054, 29.5, 88.6, 2613, 39, '2025-12-23 00:00:20', '2025-12-23 00:00:20'),
(1055, 29.5, 88.6, 2613, 38, '2025-12-23 00:00:30', '2025-12-23 00:00:30'),
(1056, 29.5, 88.6, 2624, 37, '2025-12-23 00:00:40', '2025-12-23 00:00:40'),
(1057, 29.5, 88.6, 2629, 24, '2025-12-23 00:00:50', '2025-12-23 00:00:50'),
(1058, 29.5, 88.6, 2619, 37, '2025-12-23 00:01:00', '2025-12-23 00:01:00'),
(1059, 29.5, 88.6, 2617, 37, '2025-12-23 00:01:10', '2025-12-23 00:01:10'),
(1060, 29.5, 88.6, 2593, 37, '2025-12-23 00:01:20', '2025-12-23 00:01:20'),
(1061, 29.5, 88.6, 2623, 37, '2025-12-23 00:01:30', '2025-12-23 00:01:30'),
(1062, 29.5, 88.6, 2599, 37, '2025-12-23 00:01:40', '2025-12-23 00:01:40'),
(1063, 29.5, 88.6, 2613, 37, '2025-12-23 00:01:50', '2025-12-23 00:01:50'),
(1064, 29.5, 88.6, 2598, 37, '2025-12-23 00:02:00', '2025-12-23 00:02:00'),
(1065, 29.3, 87.8, 2618, 37, '2025-12-23 00:02:14', '2025-12-23 00:02:14'),
(1066, 29.4, 87.7, 2623, 37, '2025-12-23 00:02:24', '2025-12-23 00:02:24'),
(1067, 29.4, 87.7, 2629, 37, '2025-12-23 00:02:34', '2025-12-23 00:02:34'),
(1068, 29.3, 87.6, 2647, 37, '2025-12-23 00:02:44', '2025-12-23 00:02:44'),
(1069, 29.4, 87.7, 2608, 37, '2025-12-23 00:02:54', '2025-12-23 00:02:54'),
(1070, 29.3, 87.5, 2608, 37, '2025-12-23 00:03:04', '2025-12-23 00:03:04'),
(1071, 29.3, 87.6, 2603, 37, '2025-12-23 00:03:14', '2025-12-23 00:03:14'),
(1072, 29.3, 87.7, 2613, 46, '2025-12-23 00:03:24', '2025-12-23 00:03:24'),
(1073, 29.4, 89, 2621, 47, '2025-12-23 00:03:34', '2025-12-23 00:03:34'),
(1074, 29.5, 88.2, 2608, 47, '2025-12-23 00:03:44', '2025-12-23 00:03:44'),
(1075, 29.5, 87.7, 2612, 46, '2025-12-23 00:03:54', '2025-12-23 00:03:54'),
(1076, 29.5, 87.3, 2617, 46, '2025-12-23 00:04:04', '2025-12-23 00:04:04'),
(1077, 29.5, 87.3, 2622, 46, '2025-12-23 00:04:14', '2025-12-23 00:04:14'),
(1078, 29.5, 87.1, 2620, 46, '2025-12-23 00:04:24', '2025-12-23 00:04:24'),
(1079, 29.5, 87.3, 2613, 47, '2025-12-23 00:04:34', '2025-12-23 00:04:34'),
(1080, 29.5, 87.4, 2615, 47, '2025-12-23 00:04:44', '2025-12-23 00:04:44'),
(1081, 29.5, 87.4, 2610, 47, '2025-12-23 00:04:54', '2025-12-23 00:04:54'),
(1082, 29.5, 87.3, 2649, 47, '2025-12-23 00:05:04', '2025-12-23 00:05:04'),
(1083, 29.5, 87.4, 2609, 17, '2025-12-23 00:05:14', '2025-12-23 00:05:14'),
(1084, 29.5, 87.4, 2603, 27, '2025-12-23 00:05:24', '2025-12-23 00:05:24'),
(1085, 29.5, 87.3, 2618, 18, '2025-12-23 00:05:34', '2025-12-23 00:05:34'),
(1086, 29.5, 87.3, 2616, 38, '2025-12-23 00:05:44', '2025-12-23 00:05:44'),
(1087, 29.5, 87.4, 2617, 38, '2025-12-23 00:05:54', '2025-12-23 00:05:54'),
(1088, 29.5, 87.5, 2605, 37, '2025-12-23 00:06:04', '2025-12-23 00:06:04'),
(1089, 29.5, 87.5, 2612, 37, '2025-12-23 00:06:14', '2025-12-23 00:06:14'),
(1090, 29.5, 87.3, 2603, 38, '2025-12-23 00:06:24', '2025-12-23 00:06:24'),
(1091, 29.5, 87.3, 2655, 38, '2025-12-23 00:06:34', '2025-12-23 00:06:34'),
(1092, 29.5, 87.4, 2622, 38, '2025-12-23 00:06:44', '2025-12-23 00:06:44'),
(1093, 29.4, 87.3, 2614, 38, '2025-12-23 00:06:54', '2025-12-23 00:06:54'),
(1094, 29.5, 87.5, 2615, 39, '2025-12-23 00:07:04', '2025-12-23 00:07:04'),
(1095, 29.4, 87.6, 2608, 39, '2025-12-23 00:07:14', '2025-12-23 00:07:14'),
(1096, 29.5, 87.6, 2622, 40, '2025-12-23 00:07:24', '2025-12-23 00:07:24'),
(1097, 29.5, 87.6, 2613, 40, '2025-12-23 00:07:34', '2025-12-23 00:07:34'),
(1098, 29.4, 87.5, 2608, 41, '2025-12-23 00:07:44', '2025-12-23 00:07:44'),
(1099, 29.5, 87.5, 2615, 41, '2025-12-23 00:07:54', '2025-12-23 00:07:54'),
(1100, 29.4, 87.5, 2615, 41, '2025-12-23 00:08:04', '2025-12-23 00:08:04'),
(1101, 29.4, 87.6, 2617, 47, '2025-12-23 00:08:14', '2025-12-23 00:08:14'),
(1102, 29.4, 87.6, 2620, 60, '2025-12-23 00:08:24', '2025-12-23 00:08:24'),
(1103, 29.4, 87.7, 2618, 57, '2025-12-23 00:08:34', '2025-12-23 00:08:34'),
(1104, 29.4, 87.6, 2615, 52, '2025-12-23 00:08:44', '2025-12-23 00:08:44'),
(1105, 29.4, 87.6, 2598, 52, '2025-12-23 00:08:54', '2025-12-23 00:08:54'),
(1106, 29.4, 87.7, 2624, 62, '2025-12-23 00:09:39', '2025-12-23 00:09:39'),
(1107, 29.4, 87.8, 2607, 62, '2025-12-23 00:09:49', '2025-12-23 00:09:49'),
(1108, 29.4, 87.9, 2615, 62, '2025-12-23 00:09:59', '2025-12-23 00:09:59'),
(1109, 29.4, 87.9, 2609, 62, '2025-12-23 00:10:09', '2025-12-23 00:10:09'),
(1110, 29.4, 87.9, 2610, 62, '2025-12-23 00:10:19', '2025-12-23 00:10:19'),
(1111, 29.4, 87.8, 2610, 64, '2025-12-23 00:10:34', '2025-12-23 00:10:34'),
(1112, 29.4, 87.9, 2613, 62, '2025-12-23 00:10:44', '2025-12-23 00:10:44'),
(1113, 29.4, 87.9, 2609, 63, '2025-12-23 00:10:54', '2025-12-23 00:10:54'),
(1114, 29.4, 87.9, 2617, 63, '2025-12-23 00:11:04', '2025-12-23 00:11:04'),
(1115, 29.4, 87.9, 2620, 62, '2025-12-23 00:11:14', '2025-12-23 00:11:14'),
(1116, 29.4, 87.9, 2631, 62, '2025-12-23 00:11:24', '2025-12-23 00:11:24'),
(1117, 29.4, 87.9, 2626, 62, '2025-12-23 00:11:34', '2025-12-23 00:11:34'),
(1118, 29.4, 87.9, 2599, 62, '2025-12-23 00:11:44', '2025-12-23 00:11:44'),
(1119, 29.4, 87.9, 2613, 62, '2025-12-23 00:11:54', '2025-12-23 00:11:54'),
(1120, 29.4, 87.9, 2618, 62, '2025-12-23 00:12:04', '2025-12-23 00:12:04'),
(1121, 29.4, 87.9, 2611, 63, '2025-12-23 00:12:14', '2025-12-23 00:12:14'),
(1122, 29.4, 87.9, 2614, 63, '2025-12-23 00:12:24', '2025-12-23 00:12:24'),
(1123, 29.4, 87.9, 2614, 63, '2025-12-23 00:12:34', '2025-12-23 00:12:34'),
(1124, 29.4, 87.9, 2631, 63, '2025-12-23 00:12:44', '2025-12-23 00:12:44'),
(1125, 29.4, 87.9, 2551, 64, '2025-12-23 00:12:54', '2025-12-23 00:12:54'),
(1126, 29.4, 87.9, 2594, 64, '2025-12-23 00:13:04', '2025-12-23 00:13:04'),
(1127, 29.4, 87.9, 2624, 62, '2025-12-23 00:13:14', '2025-12-23 00:13:14'),
(1128, 29.4, 87.9, 2620, 62, '2025-12-23 00:13:24', '2025-12-23 00:13:24'),
(1129, 29.4, 87.9, 2625, 46, '2025-12-23 00:13:34', '2025-12-23 00:13:34'),
(1130, 29.4, 87.9, 2608, 44, '2025-12-23 00:13:44', '2025-12-23 00:13:44'),
(1131, 29.4, 87.9, 2623, 45, '2025-12-23 00:13:54', '2025-12-23 00:13:54'),
(1132, 29.4, 87.9, 2599, 45, '2025-12-23 00:14:04', '2025-12-23 00:14:04'),
(1133, 29.4, 87.9, 2609, 46, '2025-12-23 00:14:14', '2025-12-23 00:14:14'),
(1134, 29.4, 87.9, 2619, 45, '2025-12-23 00:14:24', '2025-12-23 00:14:24'),
(1135, 29.4, 87.9, 2610, 47, '2025-12-23 00:14:34', '2025-12-23 00:14:34'),
(1136, 29.4, 87.9, 2609, 47, '2025-12-23 00:14:44', '2025-12-23 00:14:44'),
(1137, 29.4, 87.9, 2589, 47, '2025-12-23 00:14:54', '2025-12-23 00:14:54'),
(1138, 29.4, 87.9, 2609, 46, '2025-12-23 00:15:04', '2025-12-23 00:15:04'),
(1139, 29.4, 87.9, 2608, 46, '2025-12-23 00:15:14', '2025-12-23 00:15:14'),
(1140, 29.4, 87.9, 2611, 42, '2025-12-23 00:15:24', '2025-12-23 00:15:24'),
(1141, 29.4, 87.9, 2605, 41, '2025-12-23 00:15:34', '2025-12-23 00:15:34'),
(1142, 29.4, 87.9, 2610, 42, '2025-12-23 00:15:44', '2025-12-23 00:15:44'),
(1143, 29.4, 87.9, 2608, 42, '2025-12-23 00:15:54', '2025-12-23 00:15:54'),
(1144, 29.4, 87.9, 2607, 43, '2025-12-23 00:16:04', '2025-12-23 00:16:04'),
(1145, 29.4, 87.9, 2610, 44, '2025-12-23 00:16:14', '2025-12-23 00:16:14'),
(1146, 0, 0, 2608, 52, '2025-12-23 00:16:48', '2025-12-23 00:16:48'),
(1147, 0, 0, 2605, 51, '2025-12-23 00:16:58', '2025-12-23 00:16:58'),
(1148, 0, 0, 2559, 52, '2025-12-23 00:17:08', '2025-12-23 00:17:08'),
(1149, 0, 0, 2607, 52, '2025-12-23 00:17:18', '2025-12-23 00:17:18'),
(1150, 0, 0, 2611, 50, '2025-12-23 00:17:28', '2025-12-23 00:17:28'),
(1151, 0, 0, 2609, 50, '2025-12-23 00:17:38', '2025-12-23 00:17:38'),
(1152, 0, 0, 2609, 51, '2025-12-23 00:17:48', '2025-12-23 00:17:48'),
(1153, 0, 0, 2615, 51, '2025-12-23 00:17:58', '2025-12-23 00:17:58'),
(1154, 0, 0, 2615, 51, '2025-12-23 00:18:08', '2025-12-23 00:18:08'),
(1155, 0, 0, 2582, 52, '2025-12-23 00:18:18', '2025-12-23 00:18:18'),
(1156, 0, 0, 2608, 52, '2025-12-23 00:18:28', '2025-12-23 00:18:28'),
(1157, 0, 0, 2659, 52, '2025-12-23 00:18:38', '2025-12-23 00:18:38'),
(1158, 0, 0, 2601, 52, '2025-12-23 00:18:48', '2025-12-23 00:18:48'),
(1159, 0, 0, 2591, 52, '2025-12-23 00:18:58', '2025-12-23 00:18:58'),
(1160, 0, 0, 2608, 52, '2025-12-23 00:19:08', '2025-12-23 00:19:08'),
(1161, 0, 0, 2605, 52, '2025-12-23 00:19:18', '2025-12-23 00:19:18'),
(1162, 0, 0, 2595, 52, '2025-12-23 00:19:28', '2025-12-23 00:19:28'),
(1163, 0, 0, 2615, 52, '2025-12-23 00:19:38', '2025-12-23 00:19:38'),
(1164, 0, 0, 2599, 52, '2025-12-23 00:19:48', '2025-12-23 00:19:48'),
(1165, 0, 0, 2601, 52, '2025-12-23 00:19:58', '2025-12-23 00:19:58'),
(1166, 0, 0, 2599, 52, '2025-12-23 00:20:08', '2025-12-23 00:20:08'),
(1167, 0, 0, 2624, 52, '2025-12-23 00:20:18', '2025-12-23 00:20:18'),
(1168, 0, 0, 2595, 44, '2025-12-23 00:20:28', '2025-12-23 00:20:28'),
(1169, 0, 0, 2608, 44, '2025-12-23 00:20:38', '2025-12-23 00:20:38'),
(1170, 0, 0, 2559, 49, '2025-12-23 00:21:19', '2025-12-23 00:21:19'),
(1171, 0, 0, 2630, 49, '2025-12-23 00:21:28', '2025-12-23 00:21:28'),
(1172, 29.5, 89.8, 2614, 49, '2025-12-23 00:21:48', '2025-12-23 00:21:48'),
(1173, 29.5, 89.8, 2559, 48, '2025-12-23 00:21:58', '2025-12-23 00:21:58'),
(1174, 29.5, 89.7, 2608, 48, '2025-12-23 00:22:08', '2025-12-23 00:22:08'),
(1175, 29.5, 89.7, 2620, 47, '2025-12-23 00:22:18', '2025-12-23 00:22:18'),
(1176, 29.5, 89.7, 2625, 47, '2025-12-23 00:22:28', '2025-12-23 00:22:28'),
(1177, 29.5, 89.7, 2602, 47, '2025-12-23 00:22:38', '2025-12-23 00:22:38'),
(1178, 29.5, 89.7, 2608, 47, '2025-12-23 00:22:48', '2025-12-23 00:22:48'),
(1179, 29.5, 89.7, 2615, 47, '2025-12-23 00:22:58', '2025-12-23 00:22:58'),
(1180, 29.5, 89.7, 2612, 47, '2025-12-23 00:23:08', '2025-12-23 00:23:08'),
(1181, 29.5, 89.7, 2611, 47, '2025-12-23 00:23:18', '2025-12-23 00:23:18'),
(1182, 29.5, 89.7, 2615, 47, '2025-12-23 00:23:28', '2025-12-23 00:23:28'),
(1183, 29.5, 89.7, 2613, 47, '2025-12-23 00:23:38', '2025-12-23 00:23:38'),
(1184, 29.5, 89.7, 2611, 46, '2025-12-23 00:23:48', '2025-12-23 00:23:48'),
(1185, 29.5, 89.7, 2612, 47, '2025-12-23 00:23:58', '2025-12-23 00:23:58'),
(1186, 29.5, 89.7, 2641, 47, '2025-12-23 00:24:08', '2025-12-23 00:24:08'),
(1187, 29.5, 89.7, 2619, 47, '2025-12-23 00:24:18', '2025-12-23 00:24:18'),
(1188, 29.5, 89.7, 2628, 47, '2025-12-23 00:24:28', '2025-12-23 00:24:28'),
(1189, 29.5, 89.7, 2615, 47, '2025-12-23 00:24:38', '2025-12-23 00:24:38'),
(1190, 29.5, 89.7, 2615, 47, '2025-12-23 00:24:48', '2025-12-23 00:24:48'),
(1191, 29.5, 89.7, 2584, 47, '2025-12-23 00:24:58', '2025-12-23 00:24:58'),
(1192, 29.5, 89.7, 2617, 47, '2025-12-23 00:25:08', '2025-12-23 00:25:08'),
(1193, 29.5, 89.7, 2611, 47, '2025-12-23 00:25:18', '2025-12-23 00:25:18'),
(1194, 29.5, 89.7, 2607, 42, '2025-12-23 00:25:28', '2025-12-23 00:25:28'),
(1195, 29.5, 89.7, 2620, 43, '2025-12-23 00:25:38', '2025-12-23 00:25:38'),
(1196, 29.5, 89.7, 2614, 42, '2025-12-23 00:25:48', '2025-12-23 00:25:48'),
(1197, 29.5, 89.7, 2612, 42, '2025-12-23 00:25:58', '2025-12-23 00:25:58'),
(1198, 29.5, 89.7, 2612, 44, '2025-12-23 00:26:08', '2025-12-23 00:26:08'),
(1199, 0, 0, 2610, 46, '2025-12-23 00:26:49', '2025-12-23 00:26:49'),
(1200, 0, 0, 2609, 46, '2025-12-23 00:26:59', '2025-12-23 00:26:59'),
(1201, 0, 0, 2608, 46, '2025-12-23 00:27:09', '2025-12-23 00:27:09'),
(1202, 0, 0, 2610, 46, '2025-12-23 00:27:19', '2025-12-23 00:27:19'),
(1203, 0, 0, 2610, 46, '2025-12-23 00:27:29', '2025-12-23 00:27:29'),
(1204, 29.5, 89.3, 2624, 45, '2025-12-23 00:27:52', '2025-12-23 00:27:52'),
(1205, 29.5, 89.3, 2603, 45, '2025-12-23 00:28:02', '2025-12-23 00:28:02'),
(1206, 29.5, 89.2, 2621, 45, '2025-12-23 00:28:12', '2025-12-23 00:28:12'),
(1207, 29.5, 89.2, 2626, 45, '2025-12-23 00:28:22', '2025-12-23 00:28:22'),
(1208, 29.6, 89.2, 2622, 45, '2025-12-23 00:28:32', '2025-12-23 00:28:32'),
(1209, 29.6, 89.1, 2610, 45, '2025-12-23 00:28:42', '2025-12-23 00:28:42'),
(1210, 29.6, 89, 2608, 44, '2025-12-23 00:28:52', '2025-12-23 00:28:52'),
(1211, 29.6, 88.9, 2639, 43, '2025-12-23 00:29:02', '2025-12-23 00:29:02'),
(1212, 29.5, 85.6, 2622, 41, '2025-12-23 03:02:17', '2025-12-23 03:02:17'),
(1213, 29.6, 85.6, 2610, 40, '2025-12-23 03:02:27', '2025-12-23 03:02:27'),
(1214, 29.6, 85.5, 2533, 41, '2025-12-23 03:02:37', '2025-12-23 03:02:37'),
(1215, 29.6, 85.4, 2603, 41, '2025-12-23 03:02:47', '2025-12-23 03:02:47'),
(1216, 29.6, 85.4, 2609, 42, '2025-12-23 03:02:57', '2025-12-23 03:02:57'),
(1217, 29.6, 85.3, 2624, 42, '2025-12-23 03:03:07', '2025-12-23 03:03:07'),
(1218, 29.7, 85.3, 2607, 43, '2025-12-23 03:03:17', '2025-12-23 03:03:17'),
(1219, 29.6, 85.2, 2624, 43, '2025-12-23 03:03:27', '2025-12-23 03:03:27'),
(1220, 29.6, 85.2, 2606, 43, '2025-12-23 03:03:37', '2025-12-23 03:03:37'),
(1221, 29.6, 85.2, 2608, 43, '2025-12-23 03:03:47', '2025-12-23 03:03:47'),
(1222, 29.7, 85.1, 2607, 42, '2025-12-23 03:03:57', '2025-12-23 03:03:57'),
(1223, 29.7, 85.2, 2608, 40, '2025-12-23 03:04:07', '2025-12-23 03:04:07'),
(1224, 29.6, 85.1, 2608, 40, '2025-12-23 03:04:17', '2025-12-23 03:04:17'),
(1225, 29.6, 85.1, 2610, 40, '2025-12-23 03:04:27', '2025-12-23 03:04:27'),
(1226, 29.6, 85.1, 2604, 43, '2025-12-23 03:04:37', '2025-12-23 03:04:37'),
(1227, 29.7, 85.2, 2609, 41, '2025-12-23 03:04:47', '2025-12-23 03:04:47'),
(1228, 29.7, 85.2, 2607, 39, '2025-12-23 03:04:57', '2025-12-23 03:04:57'),
(1229, 29.7, 85.2, 2602, 39, '2025-12-23 03:05:07', '2025-12-23 03:05:07'),
(1230, 29.6, 85.3, 2618, 39, '2025-12-23 03:05:17', '2025-12-23 03:05:17'),
(1231, 29.7, 85.3, 2608, 39, '2025-12-23 03:05:27', '2025-12-23 03:05:27'),
(1232, 29.7, 85.3, 2608, 36, '2025-12-23 03:05:37', '2025-12-23 03:05:37'),
(1233, 29.7, 85.3, 2607, 33, '2025-12-23 03:05:47', '2025-12-23 03:05:47'),
(1234, 29.7, 85.3, 2607, 38, '2025-12-23 03:05:57', '2025-12-23 03:05:57'),
(1235, 29.7, 85.3, 2608, 38, '2025-12-23 03:06:07', '2025-12-23 03:06:07'),
(1236, 29.7, 85.3, 2603, 38, '2025-12-23 03:06:17', '2025-12-23 03:06:17'),
(1237, 29.7, 85.5, 2611, 37, '2025-12-23 03:06:56', '2025-12-23 03:06:56'),
(1238, 29.7, 85.5, 2593, 37, '2025-12-23 03:07:06', '2025-12-23 03:07:06'),
(1239, 29.7, 85.5, 2623, 37, '2025-12-23 03:07:16', '2025-12-23 03:07:16'),
(1240, 29.7, 85.6, 2607, 37, '2025-12-23 03:07:26', '2025-12-23 03:07:26'),
(1241, 29.7, 85.5, 2611, 37, '2025-12-23 03:07:36', '2025-12-23 03:07:36'),
(1242, 29.7, 85.5, 2608, 39, '2025-12-23 03:07:46', '2025-12-23 03:07:46'),
(1243, 29.7, 85.5, 2609, 39, '2025-12-23 03:07:56', '2025-12-23 03:07:56'),
(1244, 29.7, 85.5, 2613, 39, '2025-12-23 03:08:06', '2025-12-23 03:08:06'),
(1245, 29.7, 85.5, 2633, 38, '2025-12-23 03:08:16', '2025-12-23 03:08:16'),
(1246, 29.7, 85.5, 2605, 39, '2025-12-23 03:08:26', '2025-12-23 03:08:26'),
(1247, 29.7, 85.5, 2608, 39, '2025-12-23 03:08:36', '2025-12-23 03:08:36'),
(1248, 29.7, 85.5, 2608, 39, '2025-12-23 03:08:46', '2025-12-23 03:08:46'),
(1249, 29.7, 85.5, 2611, 39, '2025-12-23 03:08:56', '2025-12-23 03:08:56'),
(1250, 29.7, 85.4, 2621, 39, '2025-12-23 03:09:06', '2025-12-23 03:09:06'),
(1251, 29.7, 85.5, 2595, 39, '2025-12-23 03:09:16', '2025-12-23 03:09:16'),
(1252, 29.7, 85.4, 2480, 39, '2025-12-23 03:09:26', '2025-12-23 03:09:26'),
(1253, 29.7, 85.4, 2603, 39, '2025-12-23 03:09:36', '2025-12-23 03:09:36'),
(1254, 29.7, 85.4, 2606, 39, '2025-12-23 03:09:46', '2025-12-23 03:09:46'),
(1255, 29.7, 85.5, 2602, 40, '2025-12-23 03:09:56', '2025-12-23 03:09:56'),
(1256, 29.7, 85.4, 2597, 40, '2025-12-23 03:10:06', '2025-12-23 03:10:06'),
(1257, 29.7, 85.3, 2608, 39, '2025-12-23 03:10:16', '2025-12-23 03:10:16'),
(1258, 29.7, 85.4, 2686, 39, '2025-12-23 03:10:26', '2025-12-23 03:10:26'),
(1259, 29.7, 85.4, 2623, 39, '2025-12-23 03:10:36', '2025-12-23 03:10:36'),
(1260, 29.7, 85.5, 2608, 38, '2025-12-23 03:10:46', '2025-12-23 03:10:46'),
(1261, 29.7, 85.5, 2591, 39, '2025-12-23 03:10:56', '2025-12-23 03:10:56'),
(1262, 29.7, 85.5, 2603, 39, '2025-12-23 03:11:06', '2025-12-23 03:11:06'),
(1263, 29.7, 85.5, 2607, 39, '2025-12-23 03:11:16', '2025-12-23 03:11:16'),
(1264, 29.7, 85.5, 2608, 39, '2025-12-23 03:11:26', '2025-12-23 03:11:26'),
(1265, 29.7, 85.4, 2612, 39, '2025-12-23 03:11:36', '2025-12-23 03:11:36'),
(1266, 29.7, 85.5, 2608, 39, '2025-12-23 03:11:46', '2025-12-23 03:11:46'),
(1267, 29.8, 85.4, 2608, 39, '2025-12-23 03:11:56', '2025-12-23 03:11:56'),
(1268, 29.7, 85.4, 2608, 38, '2025-12-23 03:12:06', '2025-12-23 03:12:06'),
(1269, 29.8, 85.4, 2610, 37, '2025-12-23 03:12:16', '2025-12-23 03:12:16'),
(1270, 29.7, 85.5, 2580, 37, '2025-12-23 03:12:26', '2025-12-23 03:12:26'),
(1271, 29.8, 85.5, 2618, 38, '2025-12-23 03:12:36', '2025-12-23 03:12:36'),
(1272, 29.8, 85.5, 2608, 37, '2025-12-23 03:12:46', '2025-12-23 03:12:46'),
(1273, 29.8, 85.5, 2605, 38, '2025-12-23 03:12:56', '2025-12-23 03:12:56'),
(1274, 29.8, 85.5, 2608, 37, '2025-12-23 03:13:06', '2025-12-23 03:13:06'),
(1275, 29.8, 85.5, 2608, 38, '2025-12-23 03:13:16', '2025-12-23 03:13:16'),
(1276, 29.8, 85.5, 2611, 37, '2025-12-23 03:13:26', '2025-12-23 03:13:26'),
(1277, 29.8, 85.5, 2610, 37, '2025-12-23 03:13:36', '2025-12-23 03:13:36'),
(1278, 29.8, 85.5, 2611, 37, '2025-12-23 03:13:46', '2025-12-23 03:13:46'),
(1279, 29.8, 85.5, 2603, 37, '2025-12-23 03:13:56', '2025-12-23 03:13:56'),
(1280, 0, 0, 2615, 37, '2025-12-23 03:14:07', '2025-12-23 03:14:07'),
(1281, 0, 0, 2609, 38, '2025-12-23 03:14:17', '2025-12-23 03:14:17'),
(1282, 0, 0, 2608, 38, '2025-12-23 03:14:27', '2025-12-23 03:14:27'),
(1283, 0, 0, 2609, 12, '2025-12-23 03:14:37', '2025-12-23 03:14:37'),
(1284, 0, 0, 2603, 37, '2025-12-23 03:14:47', '2025-12-23 03:14:47'),
(1285, 0, 0, 2608, 37, '2025-12-23 03:14:57', '2025-12-23 03:14:57'),
(1286, 0, 0, 2587, 37, '2025-12-23 03:15:07', '2025-12-23 03:15:07'),
(1287, 0, 0, 2603, 36, '2025-12-23 03:15:17', '2025-12-23 03:15:17'),
(1288, 0, 0, 2598, 37, '2025-12-23 03:15:27', '2025-12-23 03:15:27'),
(1289, 0, 0, 2608, 37, '2025-12-23 03:15:37', '2025-12-23 03:15:37'),
(1290, 0, 0, 2611, 37, '2025-12-23 03:15:47', '2025-12-23 03:15:47'),
(1291, 0, 0, 2599, 37, '2025-12-23 03:15:57', '2025-12-23 03:15:57'),
(1292, 0, 0, 2608, 35, '2025-12-23 03:16:07', '2025-12-23 03:16:07'),
(1293, 0, 0, 2608, 50, '2025-12-23 03:16:17', '2025-12-23 03:16:17'),
(1294, 29.7, 85.6, 2609, 49, '2025-12-23 03:16:33', '2025-12-23 03:16:33'),
(1295, 29.7, 85.6, 2606, 50, '2025-12-23 03:16:42', '2025-12-23 03:16:42'),
(1296, 29.7, 85.6, 2608, 49, '2025-12-23 03:16:52', '2025-12-23 03:16:52'),
(1297, 29.7, 85.4, 2605, 48, '2025-12-23 03:17:02', '2025-12-23 03:17:02'),
(1298, 29.7, 85.4, 2613, 48, '2025-12-23 03:17:12', '2025-12-23 03:17:12'),
(1299, 29.7, 85.5, 2612, 48, '2025-12-23 03:17:22', '2025-12-23 03:17:22'),
(1300, 29.7, 85.4, 2609, 40, '2025-12-23 03:17:32', '2025-12-23 03:17:32'),
(1301, 29.8, 85.5, 2607, 38, '2025-12-23 03:17:42', '2025-12-23 03:17:42'),
(1302, 29.8, 85.5, 2609, 37, '2025-12-23 03:17:52', '2025-12-23 03:17:52'),
(1303, 29.8, 85.5, 2614, 37, '2025-12-23 03:18:02', '2025-12-23 03:18:02'),
(1304, 29.7, 84.4, 2613, 12, '2025-12-23 03:57:57', '2025-12-23 03:57:57'),
(1305, 29.8, 84.1, 2615, 12, '2025-12-23 03:58:06', '2025-12-23 03:58:06'),
(1306, 29.8, 83.8, 2615, 12, '2025-12-23 03:58:17', '2025-12-23 03:58:17'),
(1307, 29.8, 83.8, 2610, 12, '2025-12-23 03:58:27', '2025-12-23 03:58:27'),
(1308, 29.8, 83.6, 2617, 12, '2025-12-23 03:58:37', '2025-12-23 03:58:37'),
(1309, 29.8, 83.7, 2613, 13, '2025-12-23 03:58:47', '2025-12-23 03:58:47'),
(1310, 29.8, 83.6, 2614, 12, '2025-12-23 03:58:57', '2025-12-23 03:58:57'),
(1311, 29.9, 83.5, 2609, 13, '2025-12-23 03:59:07', '2025-12-23 03:59:07'),
(1312, 29.9, 83.4, 2609, 14, '2025-12-23 03:59:17', '2025-12-23 03:59:17'),
(1313, 29.9, 83.4, 2614, 13, '2025-12-23 03:59:27', '2025-12-23 03:59:27'),
(1314, 29.9, 83.3, 2619, 13, '2025-12-23 03:59:37', '2025-12-23 03:59:37'),
(1315, 29.9, 83.2, 2610, 14, '2025-12-23 03:59:47', '2025-12-23 03:59:47'),
(1316, 29.9, 83.2, 2613, 14, '2025-12-23 03:59:57', '2025-12-23 03:59:57'),
(1317, 29.9, 83.1, 2614, 14, '2025-12-23 04:00:06', '2025-12-23 04:00:06'),
(1318, 29.9, 83.1, 2611, 14, '2025-12-23 04:00:17', '2025-12-23 04:00:17'),
(1319, 29.9, 83, 2617, 14, '2025-12-23 04:00:27', '2025-12-23 04:00:27'),
(1320, 30, 82.8, 2608, 14, '2025-12-23 04:00:37', '2025-12-23 04:00:37'),
(1321, 29.9, 82.8, 2613, 14, '2025-12-23 04:00:47', '2025-12-23 04:00:47'),
(1322, 30, 82.9, 2611, 14, '2025-12-23 04:00:57', '2025-12-23 04:00:57'),
(1323, 30, 82.9, 2618, 14, '2025-12-23 04:01:07', '2025-12-23 04:01:07'),
(1324, 30, 82.8, 2608, 14, '2025-12-23 04:01:17', '2025-12-23 04:01:17'),
(1325, 30, 82.8, 2623, 13, '2025-12-23 04:01:26', '2025-12-23 04:01:26'),
(1326, 30, 82.8, 2592, 13, '2025-12-23 04:01:37', '2025-12-23 04:01:37'),
(1327, 30, 82.8, 2621, 13, '2025-12-23 04:01:46', '2025-12-23 04:01:46'),
(1328, 30, 82.8, 2544, 13, '2025-12-23 04:01:57', '2025-12-23 04:01:57'),
(1329, 30, 82.8, 2613, 13, '2025-12-23 04:02:07', '2025-12-23 04:02:07'),
(1330, 30, 82.8, 2602, 13, '2025-12-23 04:02:17', '2025-12-23 04:02:17'),
(1331, 30, 82.8, 2618, 13, '2025-12-23 04:02:27', '2025-12-23 04:02:27'),
(1332, 30, 82.8, 2608, 13, '2025-12-23 04:02:37', '2025-12-23 04:02:37'),
(1333, 30, 82.8, 2614, 13, '2025-12-23 04:02:47', '2025-12-23 04:02:47'),
(1334, 30, 82.8, 2608, 13, '2025-12-23 04:02:57', '2025-12-23 04:02:57'),
(1335, 30, 82.8, 2598, 12, '2025-12-23 04:03:07', '2025-12-23 04:03:07'),
(1336, 30, 82.8, 2611, 12, '2025-12-23 04:03:17', '2025-12-23 04:03:17'),
(1337, 30, 82.8, 2624, 12, '2025-12-23 04:03:27', '2025-12-23 04:03:27'),
(1338, 30, 82.8, 2615, 13, '2025-12-23 04:03:37', '2025-12-23 04:03:37'),
(1339, 30, 82.8, 2618, 13, '2025-12-23 04:03:47', '2025-12-23 04:03:47'),
(1340, 30, 82.8, 2612, 13, '2025-12-23 04:03:57', '2025-12-23 04:03:57'),
(1341, 30, 82.8, 2673, 13, '2025-12-23 04:04:07', '2025-12-23 04:04:07'),
(1342, 30, 82.8, 2615, 13, '2025-12-23 04:04:17', '2025-12-23 04:04:17'),
(1343, 30, 82.8, 2608, 13, '2025-12-23 04:04:27', '2025-12-23 04:04:27'),
(1344, 30, 82.8, 2622, 13, '2025-12-23 04:04:37', '2025-12-23 04:04:37'),
(1345, 30, 82.8, 2614, 12, '2025-12-23 04:04:47', '2025-12-23 04:04:47'),
(1346, 30, 82.8, 2608, 13, '2025-12-23 04:04:57', '2025-12-23 04:04:57'),
(1347, 30, 82.8, 2608, 12, '2025-12-23 04:05:07', '2025-12-23 04:05:07'),
(1348, 30, 82.8, 2620, 13, '2025-12-23 04:05:17', '2025-12-23 04:05:17'),
(1349, 30, 82.8, 2623, 12, '2025-12-23 04:05:27', '2025-12-23 04:05:27'),
(1350, 30, 82.8, 2621, 12, '2025-12-23 04:05:37', '2025-12-23 04:05:37'),
(1351, 30, 82.8, 2621, 12, '2025-12-23 04:05:47', '2025-12-23 04:05:47'),
(1352, 30, 82.8, 2631, 12, '2025-12-23 04:05:56', '2025-12-23 04:05:56'),
(1353, 30, 82.8, 2640, 12, '2025-12-23 04:06:07', '2025-12-23 04:06:07'),
(1354, 30, 82.8, 2621, 13, '2025-12-23 04:06:17', '2025-12-23 04:06:17'),
(1355, 30, 82.8, 2623, 13, '2025-12-23 04:06:27', '2025-12-23 04:06:27'),
(1356, 30, 82.8, 2559, 13, '2025-12-23 04:06:37', '2025-12-23 04:06:37'),
(1357, 30, 82.8, 2623, 13, '2025-12-23 04:06:47', '2025-12-23 04:06:47'),
(1358, 30, 82.8, 2622, 13, '2025-12-23 04:06:57', '2025-12-23 04:06:57'),
(1359, 30, 82.8, 2619, 13, '2025-12-23 04:07:07', '2025-12-23 04:07:07'),
(1360, 30, 82.8, 2623, 13, '2025-12-23 04:07:16', '2025-12-23 04:07:16'),
(1361, 30, 82.8, 2623, 13, '2025-12-23 04:07:27', '2025-12-23 04:07:27'),
(1362, 30, 82.8, 2619, 12, '2025-12-23 04:07:36', '2025-12-23 04:07:36'),
(1363, 30, 82.8, 2621, 12, '2025-12-23 04:07:47', '2025-12-23 04:07:47'),
(1364, 30, 82.8, 2627, 12, '2025-12-23 04:07:57', '2025-12-23 04:07:57'),
(1365, 30, 82.8, 2596, 12, '2025-12-23 04:08:07', '2025-12-23 04:08:07'),
(1366, 30, 82.8, 2618, 12, '2025-12-23 04:08:16', '2025-12-23 04:08:16'),
(1367, 30, 82.8, 2623, 12, '2025-12-23 04:08:27', '2025-12-23 04:08:27'),
(1368, 30, 82.8, 2611, 12, '2025-12-23 04:08:37', '2025-12-23 04:08:37'),
(1369, 30, 82.8, 2619, 13, '2025-12-23 04:08:47', '2025-12-23 04:08:47'),
(1370, 30, 82.8, 2638, 12, '2025-12-23 04:08:57', '2025-12-23 04:08:57'),
(1371, 30, 82.8, 2624, 13, '2025-12-23 04:09:06', '2025-12-23 04:09:06'),
(1372, 30, 82.8, 2624, 12, '2025-12-23 04:09:17', '2025-12-23 04:09:17'),
(1373, 30, 82.8, 2622, 12, '2025-12-23 04:09:27', '2025-12-23 04:09:27'),
(1374, 30, 82.8, 2613, 14, '2025-12-23 04:09:37', '2025-12-23 04:09:37'),
(1375, 30, 82.8, 2614, 13, '2025-12-23 04:09:47', '2025-12-23 04:09:47'),
(1376, 30, 82.8, 2608, 13, '2025-12-23 04:09:57', '2025-12-23 04:09:57'),
(1377, 30, 82.8, 2621, 13, '2025-12-23 04:10:07', '2025-12-23 04:10:07'),
(1378, 30, 82.8, 2640, 13, '2025-12-23 04:10:17', '2025-12-23 04:10:17'),
(1379, 30, 82.8, 2611, 13, '2025-12-23 04:10:27', '2025-12-23 04:10:27'),
(1380, 30, 82.8, 2626, 13, '2025-12-23 04:10:36', '2025-12-23 04:10:36'),
(1381, 30, 82.8, 2622, 14, '2025-12-23 04:10:47', '2025-12-23 04:10:47'),
(1382, 30, 82.8, 2613, 13, '2025-12-23 04:10:57', '2025-12-23 04:10:57'),
(1383, 30, 82.8, 2618, 13, '2025-12-23 04:11:06', '2025-12-23 04:11:06'),
(1384, 30, 82.8, 2597, 13, '2025-12-23 04:11:17', '2025-12-23 04:11:17'),
(1385, 30, 82.8, 2589, 13, '2025-12-23 04:11:27', '2025-12-23 04:11:27'),
(1386, 30, 82.8, 2617, 13, '2025-12-23 04:11:37', '2025-12-23 04:11:37');
INSERT INTO `sensor_data` (`id`, `suhu`, `kelembaban`, `soil`, `cahaya`, `created_at`, `updated_at`) VALUES
(1387, 30, 82.8, 2619, 13, '2025-12-23 04:11:47', '2025-12-23 04:11:47'),
(1388, 30, 82.8, 2615, 13, '2025-12-23 04:11:56', '2025-12-23 04:11:56'),
(1389, 30, 82.8, 2617, 13, '2025-12-23 04:12:07', '2025-12-23 04:12:07'),
(1390, 30, 82.8, 2618, 13, '2025-12-23 04:12:17', '2025-12-23 04:12:17'),
(1391, 30, 82.8, 2618, 12, '2025-12-23 04:12:27', '2025-12-23 04:12:27'),
(1392, 30, 82.8, 2631, 12, '2025-12-23 04:12:37', '2025-12-23 04:12:37'),
(1393, 30, 82.8, 2622, 12, '2025-12-23 04:12:47', '2025-12-23 04:12:47'),
(1394, 30, 82.8, 2613, 12, '2025-12-23 04:12:56', '2025-12-23 04:12:56'),
(1395, 30, 82.8, 2621, 12, '2025-12-23 04:13:07', '2025-12-23 04:13:07'),
(1396, 30, 82.8, 2598, 12, '2025-12-23 04:13:17', '2025-12-23 04:13:17'),
(1397, 30, 82.8, 2619, 12, '2025-12-23 04:13:27', '2025-12-23 04:13:27'),
(1398, 30, 82.8, 2611, 14, '2025-12-23 04:13:36', '2025-12-23 04:13:36'),
(1399, 30, 82.8, 2615, 13, '2025-12-23 04:13:47', '2025-12-23 04:13:47'),
(1400, 30, 82.8, 2619, 14, '2025-12-23 04:13:57', '2025-12-23 04:13:57'),
(1401, 30, 82.8, 2618, 13, '2025-12-23 04:14:07', '2025-12-23 04:14:07'),
(1402, 30, 82.8, 2614, 13, '2025-12-23 04:14:17', '2025-12-23 04:14:17'),
(1403, 30, 82.8, 2615, 13, '2025-12-23 04:14:27', '2025-12-23 04:14:27'),
(1404, 30, 82.8, 2615, 12, '2025-12-23 04:14:37', '2025-12-23 04:14:37'),
(1405, 30, 82.8, 2622, 12, '2025-12-23 04:14:47', '2025-12-23 04:14:47'),
(1406, 30, 82.8, 2624, 12, '2025-12-23 04:14:57', '2025-12-23 04:14:57'),
(1407, 30, 82.8, 2607, 12, '2025-12-23 04:15:07', '2025-12-23 04:15:07'),
(1408, 30.3, 81.7, 2621, 12, '2025-12-23 04:15:43', '2025-12-23 04:15:43'),
(1409, 30.4, 81.6, 2622, 12, '2025-12-23 04:15:53', '2025-12-23 04:15:53'),
(1410, 30.4, 81.5, 2581, 12, '2025-12-23 04:16:03', '2025-12-23 04:16:03'),
(1411, 30.4, 81.6, 2624, 12, '2025-12-23 04:16:13', '2025-12-23 04:16:13'),
(1412, 30.4, 81.7, 2614, 12, '2025-12-23 04:16:23', '2025-12-23 04:16:23'),
(1413, 30.4, 81.8, 2620, 13, '2025-12-23 04:16:33', '2025-12-23 04:16:33'),
(1414, 30.4, 82.1, 2619, 13, '2025-12-23 04:16:43', '2025-12-23 04:16:43'),
(1415, 30.4, 81.7, 2624, 13, '2025-12-23 04:17:18', '2025-12-23 04:17:18'),
(1416, 30.4, 81.5, 2618, 13, '2025-12-23 04:17:28', '2025-12-23 04:17:28'),
(1417, 30.4, 81.4, 2617, 13, '2025-12-23 04:17:38', '2025-12-23 04:17:38'),
(1418, 30.5, 81.4, 2622, 13, '2025-12-23 04:17:48', '2025-12-23 04:17:48'),
(1419, 30.4, 81.3, 2614, 13, '2025-12-23 04:17:58', '2025-12-23 04:17:58'),
(1420, 30.4, 81.3, 2644, 13, '2025-12-23 04:18:08', '2025-12-23 04:18:08'),
(1421, 30.4, 81.4, 2618, 13, '2025-12-23 04:18:18', '2025-12-23 04:18:18'),
(1422, 30.4, 81.4, 2624, 13, '2025-12-23 04:18:28', '2025-12-23 04:18:28'),
(1423, 30.4, 81.5, 2609, 13, '2025-12-23 04:18:38', '2025-12-23 04:18:38'),
(1424, 30.4, 81.5, 2628, 12, '2025-12-23 04:18:48', '2025-12-23 04:18:48'),
(1425, 30.4, 81.5, 2617, 12, '2025-12-23 04:18:58', '2025-12-23 04:18:58'),
(1426, 30.4, 81.5, 2615, 12, '2025-12-23 04:19:08', '2025-12-23 04:19:08'),
(1427, 30.4, 81.5, 2608, 12, '2025-12-23 04:19:18', '2025-12-23 04:19:18'),
(1428, 30.4, 81.5, 2627, 12, '2025-12-23 04:19:28', '2025-12-23 04:19:28'),
(1429, 30.4, 81.4, 2621, 13, '2025-12-23 04:19:38', '2025-12-23 04:19:38'),
(1430, 30.4, 81.3, 2619, 13, '2025-12-23 04:19:48', '2025-12-23 04:19:48'),
(1431, 30.4, 81.4, 2595, 6, '2025-12-23 04:19:58', '2025-12-23 04:19:58'),
(1432, 30.4, 81.4, 2620, 13, '2025-12-23 04:20:08', '2025-12-23 04:20:08'),
(1433, 30.4, 81.4, 2613, 13, '2025-12-23 04:20:18', '2025-12-23 04:20:18'),
(1434, 30.4, 81.4, 2623, 13, '2025-12-23 04:20:28', '2025-12-23 04:20:28'),
(1435, 30.4, 81.3, 2631, 12, '2025-12-23 04:20:38', '2025-12-23 04:20:38'),
(1436, 30.4, 81.6, 2615, 13, '2025-12-23 04:20:48', '2025-12-23 04:20:48'),
(1437, 30.4, 81.6, 2615, 16, '2025-12-23 04:20:58', '2025-12-23 04:20:58'),
(1438, 30.4, 81.7, 2606, 14, '2025-12-23 04:21:08', '2025-12-23 04:21:08'),
(1439, 30.4, 81.8, 2623, 14, '2025-12-23 04:21:18', '2025-12-23 04:21:18'),
(1440, 30.4, 82.1, 2615, 10, '2025-12-23 04:22:02', '2025-12-23 04:22:02'),
(1441, 30.4, 81.9, 2615, 14, '2025-12-23 04:22:12', '2025-12-23 04:22:12'),
(1442, 30.4, 81.9, 2559, 15, '2025-12-23 04:22:37', '2025-12-23 04:22:37'),
(1443, 30.4, 82.2, 2608, 15, '2025-12-23 04:22:47', '2025-12-23 04:22:47'),
(1444, 30.4, 82.7, 1978, 14, '2025-12-23 04:22:57', '2025-12-23 04:22:57'),
(1445, 30.2, 82.4, 2619, 15, '2025-12-23 04:25:20', '2025-12-23 04:25:20'),
(1446, 30.2, 82.4, 1869, 16, '2025-12-23 04:25:30', '2025-12-23 04:25:30'),
(1447, 30.2, 82.4, 1899, 13, '2025-12-23 04:25:40', '2025-12-23 04:25:40'),
(1448, 0, 0, 1920, 16, '2025-12-23 04:26:09', '2025-12-23 04:26:09'),
(1449, 0, 0, 1904, 17, '2025-12-23 04:26:19', '2025-12-23 04:26:19'),
(1450, 0, 0, 1889, 17, '2025-12-23 04:26:29', '2025-12-23 04:26:29'),
(1451, 0, 0, 1930, 16, '2025-12-23 04:26:46', '2025-12-23 04:26:46'),
(1452, 0, 0, 1910, 16, '2025-12-23 04:26:56', '2025-12-23 04:26:56'),
(1453, 0, 0, 1950, 15, '2025-12-23 04:27:06', '2025-12-23 04:27:06'),
(1454, 0, 0, 2079, 15, '2025-12-23 04:27:16', '2025-12-23 04:27:16'),
(1455, 0, 0, 1989, 15, '2025-12-23 04:28:16', '2025-12-23 04:28:16'),
(1456, 0, 0, 2005, 15, '2025-12-23 04:28:26', '2025-12-23 04:28:26'),
(1457, 0, 0, 2021, 15, '2025-12-23 04:28:37', '2025-12-23 04:28:37'),
(1458, 0, 0, 2047, 15, '2025-12-23 04:28:46', '2025-12-23 04:28:46'),
(1459, 0, 0, 2090, 15, '2025-12-23 04:28:56', '2025-12-23 04:28:56'),
(1460, 0, 0, 2000, 15, '2025-12-23 04:29:07', '2025-12-23 04:29:07'),
(1461, 0, 0, 2070, 14, '2025-12-23 04:29:31', '2025-12-23 04:29:31'),
(1462, 0, 0, 2038, 14, '2025-12-23 04:29:41', '2025-12-23 04:29:41'),
(1463, 0, 0, 2557, 14, '2025-12-23 04:30:26', '2025-12-23 04:30:26'),
(1464, 0, 0, 2000, 15, '2025-12-23 04:31:03', '2025-12-23 04:31:03'),
(1465, 0, 0, 2015, 14, '2025-12-23 04:31:14', '2025-12-23 04:31:14'),
(1466, 0, 0, 2096, 12, '2025-12-23 04:32:05', '2025-12-23 04:32:05'),
(1467, 0, 0, 2097, 12, '2025-12-23 04:32:15', '2025-12-23 04:32:15'),
(1468, 0, 0, 2070, 12, '2025-12-23 04:32:25', '2025-12-23 04:32:25'),
(1469, 0, 0, 2066, 12, '2025-12-23 04:32:35', '2025-12-23 04:32:35'),
(1470, 0, 0, 2065, 12, '2025-12-23 04:32:45', '2025-12-23 04:32:45'),
(1471, 0, 0, 2065, 9, '2025-12-23 04:32:55', '2025-12-23 04:32:55'),
(1472, 0, 0, 2065, 12, '2025-12-23 04:33:05', '2025-12-23 04:33:05'),
(1473, 0, 0, 2068, 12, '2025-12-23 04:33:15', '2025-12-23 04:33:15'),
(1474, 0, 0, 2064, 13, '2025-12-23 04:33:25', '2025-12-23 04:33:25'),
(1475, 0, 0, 2065, 12, '2025-12-23 04:33:35', '2025-12-23 04:33:35'),
(1476, 0, 0, 2023, 12, '2025-12-23 04:34:10', '2025-12-23 04:34:10'),
(1477, 30.3, 83.2, 2159, 12, '2025-12-23 04:34:30', '2025-12-23 04:34:30'),
(1478, 30.3, 83.2, 2063, 12, '2025-12-23 04:34:40', '2025-12-23 04:34:40'),
(1479, 30.3, 83.3, 2191, 12, '2025-12-23 04:34:50', '2025-12-23 04:34:50'),
(1480, 30.3, 83.3, 2149, 12, '2025-12-23 04:35:00', '2025-12-23 04:35:00'),
(1481, 30.3, 83.3, 2142, 10, '2025-12-23 04:35:10', '2025-12-23 04:35:10'),
(1482, 30.3, 83.3, 2131, 12, '2025-12-23 04:35:20', '2025-12-23 04:35:20'),
(1483, 30.3, 83.3, 2131, 11, '2025-12-23 04:35:30', '2025-12-23 04:35:30'),
(1484, 30.3, 83.3, 2128, 11, '2025-12-23 04:35:40', '2025-12-23 04:35:40'),
(1485, 30.3, 83.3, 2129, 11, '2025-12-23 04:35:51', '2025-12-23 04:35:51'),
(1486, 30.3, 83.3, 2119, 11, '2025-12-23 04:36:00', '2025-12-23 04:36:00'),
(1487, 30.3, 83.3, 2098, 8, '2025-12-23 04:36:10', '2025-12-23 04:36:10'),
(1488, 30.3, 83.3, 2108, 11, '2025-12-23 04:36:20', '2025-12-23 04:36:20'),
(1489, 30.3, 83.3, 2110, 13, '2025-12-23 04:36:30', '2025-12-23 04:36:30'),
(1490, 30.3, 83.3, 2103, 14, '2025-12-23 04:36:40', '2025-12-23 04:36:40'),
(1491, 30.3, 83.3, 2090, 13, '2025-12-23 04:36:50', '2025-12-23 04:36:50'),
(1492, 30.3, 83.3, 2087, 16, '2025-12-23 04:37:00', '2025-12-23 04:37:00'),
(1493, 30.3, 83.3, 2099, 14, '2025-12-23 04:37:10', '2025-12-23 04:37:10'),
(1494, 30.3, 83.3, 2076, 14, '2025-12-23 04:37:20', '2025-12-23 04:37:20'),
(1495, 30.3, 83.3, 2101, 13, '2025-12-23 04:37:30', '2025-12-23 04:37:30'),
(1496, 30.3, 83.3, 2101, 13, '2025-12-23 04:37:40', '2025-12-23 04:37:40'),
(1497, 30.3, 83.3, 2099, 14, '2025-12-23 04:37:51', '2025-12-23 04:37:51'),
(1498, 30.3, 83.3, 2101, 14, '2025-12-23 04:38:01', '2025-12-23 04:38:01'),
(1499, 30.3, 83.3, 2096, 13, '2025-12-23 04:38:10', '2025-12-23 04:38:10'),
(1500, 30.3, 83.3, 2091, 15, '2025-12-23 04:38:21', '2025-12-23 04:38:21'),
(1501, 30.3, 83.3, 2133, 15, '2025-12-23 04:38:30', '2025-12-23 04:38:30'),
(1502, 30.3, 83.3, 2084, 15, '2025-12-23 04:38:40', '2025-12-23 04:38:40'),
(1503, 30.3, 83.3, 2113, 15, '2025-12-23 04:38:50', '2025-12-23 04:38:50'),
(1504, 30.3, 83.3, 2071, 16, '2025-12-23 04:39:00', '2025-12-23 04:39:00'),
(1505, 30.3, 83.3, 2075, 12, '2025-12-23 04:39:10', '2025-12-23 04:39:10'),
(1506, 30.3, 83.3, 2091, 12, '2025-12-23 04:39:20', '2025-12-23 04:39:20'),
(1507, 30.3, 83.3, 2081, 12, '2025-12-23 04:39:30', '2025-12-23 04:39:30'),
(1508, 30.3, 83.3, 2077, 12, '2025-12-23 04:39:40', '2025-12-23 04:39:40'),
(1509, 30.3, 83.3, 2077, 12, '2025-12-23 04:39:50', '2025-12-23 04:39:50'),
(1510, 30.3, 83.3, 2080, 12, '2025-12-23 04:40:00', '2025-12-23 04:40:00'),
(1511, 30.3, 83.3, 2080, 12, '2025-12-23 04:40:10', '2025-12-23 04:40:10'),
(1512, 30.3, 83.3, 2067, 12, '2025-12-23 04:40:20', '2025-12-23 04:40:20'),
(1513, 30.3, 83.3, 2082, 12, '2025-12-23 04:40:30', '2025-12-23 04:40:30'),
(1514, 30.3, 83.3, 2071, 12, '2025-12-23 04:40:40', '2025-12-23 04:40:40'),
(1515, 30.3, 83.3, 2064, 13, '2025-12-23 04:40:50', '2025-12-23 04:40:50'),
(1516, 30.3, 83.3, 2087, 12, '2025-12-23 04:41:00', '2025-12-23 04:41:00'),
(1517, 30.3, 83.3, 2092, 12, '2025-12-23 04:41:10', '2025-12-23 04:41:10'),
(1518, 30.3, 83.3, 2073, 12, '2025-12-23 04:41:20', '2025-12-23 04:41:20'),
(1519, 30.3, 83.3, 2071, 12, '2025-12-23 04:41:30', '2025-12-23 04:41:30'),
(1520, 30.3, 83.3, 2070, 12, '2025-12-23 04:41:40', '2025-12-23 04:41:40'),
(1521, 30.3, 83.3, 2065, 12, '2025-12-23 04:41:50', '2025-12-23 04:41:50'),
(1522, 30.3, 83.3, 2070, 12, '2025-12-23 04:42:00', '2025-12-23 04:42:00'),
(1523, 30.3, 83.3, 2001, 12, '2025-12-23 04:42:10', '2025-12-23 04:42:10'),
(1524, 30.3, 83.3, 2071, 11, '2025-12-23 04:42:21', '2025-12-23 04:42:21'),
(1525, 29.8, 81.3, 2544, 455, '2025-12-23 06:42:45', '2025-12-23 06:42:45'),
(1526, 0, 0, 2559, 245, '2025-12-23 06:43:24', '2025-12-23 06:43:24'),
(1527, 29.9, 78, 2593, 127, '2025-12-23 07:29:55', '2025-12-23 07:29:55'),
(1528, 0, 0, 1947, 90, '2025-12-23 07:30:23', '2025-12-23 07:30:23'),
(1529, 0, 0, 2592, 221, '2025-12-23 07:31:20', '2025-12-23 07:31:20'),
(1530, 0, 0, 2599, 75, '2025-12-23 07:32:00', '2025-12-23 07:32:00'),
(1531, 30.1, 77.2, 2581, 174, '2025-12-23 07:32:18', '2025-12-23 07:32:18'),
(1532, 30.1, 76.9, 2581, 236, '2025-12-23 07:32:28', '2025-12-23 07:32:28'),
(1533, 30.1, 77.2, 2554, 153, '2025-12-23 07:32:38', '2025-12-23 07:32:38'),
(1534, 30.1, 77, 2593, 140, '2025-12-23 07:32:48', '2025-12-23 07:32:48'),
(1535, 30.1, 76.8, 2595, 192, '2025-12-23 07:32:58', '2025-12-23 07:32:58'),
(1536, 30.1, 76.6, 2591, 126, '2025-12-23 07:33:08', '2025-12-23 07:33:08'),
(1537, 30.1, 77.1, 2595, 134, '2025-12-23 07:33:19', '2025-12-23 07:33:19'),
(1538, 30.1, 76.8, 2593, 112, '2025-12-23 07:33:28', '2025-12-23 07:33:28'),
(1539, 30.1, 76.8, 2592, 180, '2025-12-23 07:33:38', '2025-12-23 07:33:38'),
(1540, 30.1, 77, 2593, 47, '2025-12-23 07:33:48', '2025-12-23 07:33:48'),
(1541, 30.1, 78, 2704, 87, '2025-12-23 07:33:59', '2025-12-23 07:33:59'),
(1542, 30.1, 78.6, 2605, 88, '2025-12-23 07:34:08', '2025-12-23 07:34:08'),
(1543, 30.1, 78.2, 2601, 86, '2025-12-23 07:34:18', '2025-12-23 07:34:18'),
(1544, 30.1, 77.7, 2510, 118, '2025-12-23 07:34:28', '2025-12-23 07:34:28'),
(1545, 30.1, 77.5, 2601, 42, '2025-12-23 07:34:38', '2025-12-23 07:34:38'),
(1546, 30.1, 78, 2610, 159, '2025-12-23 07:35:02', '2025-12-23 07:35:02'),
(1547, 30.1, 78, 2602, 127, '2025-12-23 07:35:12', '2025-12-23 07:35:12'),
(1548, 0, 0, 2609, 167, '2025-12-23 07:35:24', '2025-12-23 07:35:24'),
(1549, 0, 0, 2614, 182, '2025-12-23 07:35:35', '2025-12-23 07:35:35'),
(1550, 0, 0, 2612, 344, '2025-12-23 07:35:52', '2025-12-23 07:35:52'),
(1551, 0, 0, 2620, 224, '2025-12-23 07:36:07', '2025-12-23 07:36:07'),
(1552, 0, 0, 2610, 239, '2025-12-23 07:36:17', '2025-12-23 07:36:17'),
(1553, 0, 0, 2595, 181, '2025-12-23 07:36:27', '2025-12-23 07:36:27'),
(1554, 0, 0, 2612, 307, '2025-12-23 07:36:47', '2025-12-23 07:36:47'),
(1555, 0, 0, 2612, 484, '2025-12-23 07:37:03', '2025-12-23 07:37:03'),
(1556, 0, 0, 2590, 205, '2025-12-23 07:37:36', '2025-12-23 07:37:36'),
(1557, 0, 0, 2593, 136, '2025-12-23 07:37:54', '2025-12-23 07:37:54'),
(1558, 30, 78.3, 2619, 169, '2025-12-23 07:41:06', '2025-12-23 07:41:06'),
(1559, 30, 78.2, 2608, 253, '2025-12-23 07:41:16', '2025-12-23 07:41:16'),
(1560, 30, 78.2, 2608, 222, '2025-12-23 07:41:29', '2025-12-23 07:41:29'),
(1561, 30, 78.6, 2609, 199, '2025-12-23 07:41:39', '2025-12-23 07:41:39'),
(1562, 30.1, 82.2, 2608, 200, '2025-12-23 07:41:49', '2025-12-23 07:41:49'),
(1563, 30.2, 80.2, 2606, 211, '2025-12-23 07:41:59', '2025-12-23 07:41:59'),
(1564, 30.2, 78.7, 2608, 187, '2025-12-23 07:42:09', '2025-12-23 07:42:09'),
(1565, 30.2, 78.6, 2597, 83, '2025-12-23 07:42:19', '2025-12-23 07:42:19'),
(1566, 30.2, 78.6, 2597, 238, '2025-12-23 07:42:29', '2025-12-23 07:42:29'),
(1567, 30.2, 78.6, 2593, 197, '2025-12-23 07:42:39', '2025-12-23 07:42:39'),
(1568, 30.2, 78.6, 2069, 92, '2025-12-23 07:42:49', '2025-12-23 07:42:49'),
(1569, 30.2, 78.6, 2595, 179, '2025-12-23 07:42:59', '2025-12-23 07:42:59'),
(1570, 30.2, 78.6, 2599, 235, '2025-12-23 07:43:09', '2025-12-23 07:43:09'),
(1571, 30.2, 78.6, 2602, 212, '2025-12-23 07:43:19', '2025-12-23 07:43:19'),
(1572, 30.2, 78.6, 2598, 146, '2025-12-23 07:43:29', '2025-12-23 07:43:29'),
(1573, 30.2, 78.6, 2493, 185, '2025-12-23 07:43:39', '2025-12-23 07:43:39'),
(1574, 30.2, 78.6, 2607, 201, '2025-12-23 07:43:49', '2025-12-23 07:43:49'),
(1575, 30.2, 78.6, 2600, 189, '2025-12-23 07:43:59', '2025-12-23 07:43:59'),
(1576, 30.2, 78.6, 2603, 186, '2025-12-23 07:44:09', '2025-12-23 07:44:09'),
(1577, 30.2, 78.6, 2116, 134, '2025-12-23 07:44:19', '2025-12-23 07:44:19'),
(1578, 30.2, 78.6, 2597, 212, '2025-12-23 07:44:29', '2025-12-23 07:44:29'),
(1579, 30.2, 78.6, 2603, 131, '2025-12-23 07:44:39', '2025-12-23 07:44:39'),
(1580, 30.2, 78.6, 2603, 175, '2025-12-23 07:44:49', '2025-12-23 07:44:49'),
(1581, 30.2, 78.6, 2605, 188, '2025-12-23 07:44:59', '2025-12-23 07:44:59'),
(1582, 30.2, 78.6, 2605, 251, '2025-12-23 07:45:09', '2025-12-23 07:45:09'),
(1583, 30.2, 78.6, 2605, 266, '2025-12-23 07:45:19', '2025-12-23 07:45:19'),
(1584, 30.2, 78.6, 2602, 276, '2025-12-23 07:45:29', '2025-12-23 07:45:29'),
(1585, 30.2, 78.6, 2603, 251, '2025-12-23 07:45:39', '2025-12-23 07:45:39'),
(1586, 0, 0, 2608, 195, '2025-12-23 07:45:51', '2025-12-23 07:45:51'),
(1587, 0, 0, 2608, 158, '2025-12-23 07:46:03', '2025-12-23 07:46:03'),
(1588, 0, 0, 2605, 148, '2025-12-23 07:46:22', '2025-12-23 07:46:22'),
(1589, 0, 0, 2608, 242, '2025-12-23 07:46:45', '2025-12-23 07:46:45'),
(1590, 0, 0, 2609, 171, '2025-12-23 07:47:27', '2025-12-23 07:47:27'),
(1591, 0, 0, 2601, 172, '2025-12-23 07:47:52', '2025-12-23 07:47:52'),
(1592, 0, 0, 2601, 343, '2025-12-23 07:48:05', '2025-12-23 07:48:05'),
(1593, 0, 0, 2597, 323, '2025-12-23 07:48:15', '2025-12-23 07:48:15'),
(1594, 0, 0, 2598, 328, '2025-12-23 07:48:25', '2025-12-23 07:48:25'),
(1595, 0, 0, 2597, 209, '2025-12-23 07:48:56', '2025-12-23 07:48:56'),
(1596, 0, 0, 2596, 225, '2025-12-23 07:49:06', '2025-12-23 07:49:06'),
(1597, 0, 0, 2597, 99, '2025-12-23 07:49:21', '2025-12-23 07:49:21'),
(1598, 0, 0, 2599, 122, '2025-12-23 07:49:31', '2025-12-23 07:49:31'),
(1599, 0, 0, 2599, 202, '2025-12-23 07:49:41', '2025-12-23 07:49:41'),
(1600, 0, 0, 2604, 275, '2025-12-23 07:49:59', '2025-12-23 07:49:59'),
(1601, 0, 0, 2595, 277, '2025-12-23 07:50:09', '2025-12-23 07:50:09'),
(1602, 0, 0, 2595, 301, '2025-12-23 07:50:19', '2025-12-23 07:50:19'),
(1603, 0, 0, 2596, 238, '2025-12-23 07:50:33', '2025-12-23 07:50:33'),
(1604, 0, 0, 2588, 248, '2025-12-23 07:50:43', '2025-12-23 07:50:43'),
(1605, 0, 0, 2605, 508, '2025-12-23 07:50:53', '2025-12-23 07:50:53'),
(1606, 0, 0, 2598, 377, '2025-12-23 07:51:03', '2025-12-23 07:51:03'),
(1607, 0, 0, 2601, 473, '2025-12-23 07:51:13', '2025-12-23 07:51:13'),
(1608, 0, 0, 2603, 376, '2025-12-23 07:51:23', '2025-12-23 07:51:23'),
(1609, 0, 0, 2601, 419, '2025-12-23 07:51:33', '2025-12-23 07:51:33'),
(1610, 0, 0, 2606, 502, '2025-12-23 07:51:43', '2025-12-23 07:51:43'),
(1611, 0, 0, 2601, 470, '2025-12-23 07:52:01', '2025-12-23 07:52:01'),
(1612, 0, 0, 2602, 579, '2025-12-23 07:52:11', '2025-12-23 07:52:11'),
(1613, 0, 0, 2597, 611, '2025-12-23 07:52:21', '2025-12-23 07:52:21'),
(1614, 0, 0, 2602, 450, '2025-12-23 07:52:31', '2025-12-23 07:52:31'),
(1615, 0, 0, 2595, 352, '2025-12-23 07:52:41', '2025-12-23 07:52:41'),
(1616, 0, 0, 2599, 178, '2025-12-23 07:52:51', '2025-12-23 07:52:51'),
(1617, 0, 0, 2599, 165, '2025-12-23 07:53:01', '2025-12-23 07:53:01'),
(1618, 0, 0, 2599, 331, '2025-12-23 07:53:11', '2025-12-23 07:53:11'),
(1619, 0, 0, 2595, 346, '2025-12-23 07:53:21', '2025-12-23 07:53:21'),
(1620, 0, 0, 2595, 327, '2025-12-23 07:53:31', '2025-12-23 07:53:31'),
(1621, 0, 0, 1705, 207, '2025-12-23 07:53:41', '2025-12-23 07:53:41'),
(1622, 0, 0, 2609, 183, '2025-12-23 07:53:51', '2025-12-23 07:53:51'),
(1623, 0, 0, 2586, 297, '2025-12-23 07:54:01', '2025-12-23 07:54:01'),
(1624, 0, 0, 2303, 261, '2025-12-23 07:54:11', '2025-12-23 07:54:11'),
(1625, 0, 0, 2594, 286, '2025-12-23 07:54:21', '2025-12-23 07:54:21'),
(1626, 0, 0, 2559, 294, '2025-12-23 07:54:39', '2025-12-23 07:54:39'),
(1627, 0, 0, 2554, 350, '2025-12-23 07:54:49', '2025-12-23 07:54:49'),
(1628, 0, 0, 2559, 388, '2025-12-23 07:55:00', '2025-12-23 07:55:00'),
(1629, 0, 0, 2583, 222, '2025-12-23 07:55:31', '2025-12-23 07:55:31'),
(1630, 30.1, 80.3, 2583, 300, '2025-12-23 07:56:18', '2025-12-23 07:56:18'),
(1631, 30.1, 80.1, 2611, 335, '2025-12-23 07:56:28', '2025-12-23 07:56:28'),
(1632, 30.1, 79.6, 2607, 277, '2025-12-23 07:56:38', '2025-12-23 07:56:38'),
(1633, 30.1, 80.2, 2613, 291, '2025-12-23 07:56:48', '2025-12-23 07:56:48'),
(1634, 30.1, 79.7, 2515, 225, '2025-12-23 07:56:58', '2025-12-23 07:56:58'),
(1635, 30.2, 79.7, 2594, 355, '2025-12-23 07:57:08', '2025-12-23 07:57:08'),
(1636, 30.2, 79.7, 2607, 172, '2025-12-23 07:57:18', '2025-12-23 07:57:18'),
(1637, 30.2, 80.2, 2607, 227, '2025-12-23 07:57:28', '2025-12-23 07:57:28'),
(1638, 0, 0, 2144, 72, '2025-12-23 07:58:23', '2025-12-23 07:58:23'),
(1639, 0, 0, 2559, 354, '2025-12-23 07:58:50', '2025-12-23 07:58:50'),
(1640, 0, 0, 2607, 439, '2025-12-23 07:59:24', '2025-12-23 07:59:24'),
(1641, 0, 0, 1701, 142, '2025-12-23 07:59:53', '2025-12-23 07:59:53'),
(1642, 0, 0, 1734, 236, '2025-12-23 08:00:03', '2025-12-23 08:00:03'),
(1643, 0, 0, 1735, 257, '2025-12-23 08:00:13', '2025-12-23 08:00:13'),
(1644, 0, 0, 1940, 414, '2025-12-23 08:00:33', '2025-12-23 08:00:33'),
(1645, 0, 0, 2559, 387, '2025-12-23 08:01:14', '2025-12-23 08:01:14'),
(1646, 30, 81.3, 2607, 192, '2025-12-23 08:02:48', '2025-12-23 08:02:48'),
(1647, 30, 81.2, 2557, 149, '2025-12-23 08:02:58', '2025-12-23 08:02:58'),
(1648, 30, 81.3, 2608, 167, '2025-12-23 08:03:08', '2025-12-23 08:03:08'),
(1649, 30, 80.9, 2594, 185, '2025-12-23 08:03:18', '2025-12-23 08:03:18'),
(1650, 30, 80.9, 2594, 197, '2025-12-23 08:03:28', '2025-12-23 08:03:28'),
(1651, 30, 80.6, 2596, 202, '2025-12-23 08:03:38', '2025-12-23 08:03:38'),
(1652, 30, 80.3, 2559, 112, '2025-12-23 08:03:48', '2025-12-23 08:03:48'),
(1653, 30, 80.4, 2597, 27, '2025-12-23 08:03:58', '2025-12-23 08:03:58'),
(1654, 30, 80.4, 2582, 171, '2025-12-23 08:04:08', '2025-12-23 08:04:08'),
(1655, 30, 80.6, 2865, 170, '2025-12-23 08:04:18', '2025-12-23 08:04:18'),
(1656, 0, 0, 2585, 237, '2025-12-23 08:04:42', '2025-12-23 08:04:42'),
(1657, 0, 0, 2581, 88, '2025-12-23 08:04:58', '2025-12-23 08:04:58'),
(1658, 29.8, 80.7, 2517, 167, '2025-12-23 08:07:50', '2025-12-23 08:07:50'),
(1659, 29.8, 80.7, 2495, 157, '2025-12-23 08:08:00', '2025-12-23 08:08:00'),
(1660, 0, 0, 2513, 147, '2025-12-23 08:08:18', '2025-12-23 08:08:18'),
(1661, 0, 0, 2528, 150, '2025-12-23 08:08:28', '2025-12-23 08:08:28'),
(1662, 0, 0, 2522, 162, '2025-12-23 08:08:38', '2025-12-23 08:08:38'),
(1663, 0, 0, 2559, 146, '2025-12-23 08:08:56', '2025-12-23 08:08:56'),
(1664, 0, 0, 2543, 130, '2025-12-23 08:09:27', '2025-12-23 08:09:27'),
(1665, 0, 0, 2559, 190, '2025-12-23 08:09:43', '2025-12-23 08:09:43'),
(1666, 0, 0, 2610, 149, '2025-12-23 08:10:16', '2025-12-23 08:10:16'),
(1667, 0, 0, 2588, 106, '2025-12-23 08:11:23', '2025-12-23 08:11:23'),
(1668, 0, 0, 2586, 137, '2025-12-23 08:11:45', '2025-12-23 08:11:45'),
(1669, 29.7, 84.4, 2559, 85, '2025-12-23 08:13:03', '2025-12-23 08:13:03'),
(1670, 29.7, 84.5, 2557, 114, '2025-12-23 08:13:13', '2025-12-23 08:13:13'),
(1671, 29.7, 84, 2559, 124, '2025-12-23 08:13:23', '2025-12-23 08:13:23'),
(1672, 29.8, 84.1, 2583, 116, '2025-12-23 08:13:33', '2025-12-23 08:13:33'),
(1673, 29.7, 84, 2559, 183, '2025-12-23 08:13:43', '2025-12-23 08:13:43'),
(1674, 29.8, 83.7, 2559, 275, '2025-12-23 08:13:53', '2025-12-23 08:13:53'),
(1675, 0, 0, 2559, 223, '2025-12-23 08:14:48', '2025-12-23 08:14:48'),
(1676, 0, 0, 2581, 216, '2025-12-23 08:15:04', '2025-12-23 08:15:04'),
(1677, 0, 0, 2559, 204, '2025-12-23 08:15:14', '2025-12-23 08:15:14'),
(1678, 0, 0, 2559, 166, '2025-12-23 08:15:44', '2025-12-23 08:15:44'),
(1679, 0, 0, 2559, 232, '2025-12-23 08:15:55', '2025-12-23 08:15:55'),
(1680, 0, 0, 2581, 403, '2025-12-23 08:16:21', '2025-12-23 08:16:21'),
(1681, 0, 0, 2559, 492, '2025-12-23 08:16:32', '2025-12-23 08:16:32'),
(1682, 0, 0, 2558, 428, '2025-12-23 08:16:42', '2025-12-23 08:16:42'),
(1683, 0, 0, 2225, 404, '2025-12-23 08:16:52', '2025-12-23 08:16:52'),
(1684, 0, 0, 2559, 452, '2025-12-23 08:17:02', '2025-12-23 08:17:02'),
(1685, 0, 0, 2559, 514, '2025-12-23 08:17:20', '2025-12-23 08:17:20'),
(1686, 0, 0, 2559, 462, '2025-12-23 08:17:37', '2025-12-23 08:17:37'),
(1687, 0, 0, 2559, 416, '2025-12-23 08:17:47', '2025-12-23 08:17:47'),
(1688, 0, 0, 2559, 424, '2025-12-23 08:17:57', '2025-12-23 08:17:57'),
(1689, 0, 0, 2559, 444, '2025-12-23 08:18:07', '2025-12-23 08:18:07'),
(1690, 0, 0, 2559, 453, '2025-12-23 08:18:17', '2025-12-23 08:18:17'),
(1691, 0, 0, 2559, 429, '2025-12-23 08:18:27', '2025-12-23 08:18:27'),
(1692, 0, 0, 2559, 465, '2025-12-23 08:18:37', '2025-12-23 08:18:37'),
(1693, 0, 0, 2558, 463, '2025-12-23 08:18:47', '2025-12-23 08:18:47'),
(1694, 0, 0, 2559, 459, '2025-12-23 08:18:57', '2025-12-23 08:18:57'),
(1695, 0, 0, 2559, 464, '2025-12-23 08:19:07', '2025-12-23 08:19:07'),
(1696, 0, 0, 2559, 440, '2025-12-23 08:19:17', '2025-12-23 08:19:17'),
(1697, 0, 0, 2559, 434, '2025-12-23 08:19:27', '2025-12-23 08:19:27'),
(1698, 0, 0, 2553, 438, '2025-12-23 08:19:37', '2025-12-23 08:19:37'),
(1699, 0, 0, 2559, 530, '2025-12-23 08:19:47', '2025-12-23 08:19:47'),
(1700, 0, 0, 2559, 496, '2025-12-23 08:19:57', '2025-12-23 08:19:57'),
(1701, 0, 0, 2559, 443, '2025-12-23 08:20:07', '2025-12-23 08:20:07'),
(1702, 0, 0, 2559, 386, '2025-12-23 08:20:17', '2025-12-23 08:20:17'),
(1703, 0, 0, 2559, 469, '2025-12-23 08:20:27', '2025-12-23 08:20:27'),
(1704, 0, 0, 2559, 405, '2025-12-23 08:20:37', '2025-12-23 08:20:37'),
(1705, 0, 0, 2559, 399, '2025-12-23 08:20:47', '2025-12-23 08:20:47'),
(1706, 0, 0, 2559, 334, '2025-12-23 08:20:57', '2025-12-23 08:20:57'),
(1707, 0, 0, 2559, 467, '2025-12-23 08:21:07', '2025-12-23 08:21:07'),
(1708, 0, 0, 2555, 487, '2025-12-23 08:21:17', '2025-12-23 08:21:17'),
(1709, 0, 0, 2550, 455, '2025-12-23 08:21:27', '2025-12-23 08:21:27'),
(1710, 0, 0, 2559, 454, '2025-12-23 08:21:37', '2025-12-23 08:21:37'),
(1711, 0, 0, 2558, 421, '2025-12-23 08:21:47', '2025-12-23 08:21:47'),
(1712, 0, 0, 2557, 446, '2025-12-23 08:22:17', '2025-12-23 08:22:17'),
(1713, 0, 0, 2555, 466, '2025-12-23 08:22:27', '2025-12-23 08:22:27'),
(1714, 0, 0, 2559, 470, '2025-12-23 08:22:37', '2025-12-23 08:22:37'),
(1715, 0, 0, 2559, 188, '2025-12-23 08:22:47', '2025-12-23 08:22:47'),
(1716, 0, 0, 2549, 383, '2025-12-23 08:22:57', '2025-12-23 08:22:57'),
(1717, 0, 0, 2559, 453, '2025-12-23 08:23:07', '2025-12-23 08:23:07'),
(1718, 0, 0, 2558, 420, '2025-12-23 08:23:17', '2025-12-23 08:23:17'),
(1719, 0, 0, 2559, 411, '2025-12-23 08:23:27', '2025-12-23 08:23:27'),
(1720, 0, 0, 2557, 389, '2025-12-23 08:23:37', '2025-12-23 08:23:37'),
(1721, 0, 0, 2551, 414, '2025-12-23 08:23:47', '2025-12-23 08:23:47'),
(1722, 0, 0, 2559, 411, '2025-12-23 08:23:57', '2025-12-23 08:23:57'),
(1723, 0, 0, 2559, 417, '2025-12-23 08:24:07', '2025-12-23 08:24:07'),
(1724, 0, 0, 2558, 382, '2025-12-23 08:24:17', '2025-12-23 08:24:17'),
(1725, 0, 0, 2559, 393, '2025-12-23 08:24:27', '2025-12-23 08:24:27'),
(1726, 0, 0, 2557, 364, '2025-12-23 08:24:37', '2025-12-23 08:24:37'),
(1727, 0, 0, 2559, 39, '2025-12-23 08:24:47', '2025-12-23 08:24:47'),
(1728, 0, 0, 2555, 339, '2025-12-23 08:24:57', '2025-12-23 08:24:57'),
(1729, 0, 0, 2559, 352, '2025-12-23 08:25:07', '2025-12-23 08:25:07'),
(1730, 0, 0, 2559, 446, '2025-12-23 08:25:17', '2025-12-23 08:25:17'),
(1731, 0, 0, 2554, 365, '2025-12-23 08:25:27', '2025-12-23 08:25:27'),
(1732, 0, 0, 2559, 355, '2025-12-23 08:25:51', '2025-12-23 08:25:51'),
(1733, 0, 0, 2554, 343, '2025-12-23 08:26:01', '2025-12-23 08:26:01'),
(1734, 0, 0, 2553, 337, '2025-12-23 08:26:11', '2025-12-23 08:26:11'),
(1735, 0, 0, 2549, 343, '2025-12-23 08:26:21', '2025-12-23 08:26:21'),
(1736, 0, 0, 2558, 334, '2025-12-23 08:26:31', '2025-12-23 08:26:31'),
(1737, 0, 0, 2551, 298, '2025-12-23 08:26:41', '2025-12-23 08:26:41'),
(1738, 0, 0, 2558, 315, '2025-12-23 08:26:51', '2025-12-23 08:26:51'),
(1739, 0, 0, 2549, 298, '2025-12-23 08:27:01', '2025-12-23 08:27:01'),
(1740, 0, 0, 2557, 299, '2025-12-23 08:27:11', '2025-12-23 08:27:11'),
(1741, 0, 0, 2551, 312, '2025-12-23 08:27:21', '2025-12-23 08:27:21'),
(1742, 0, 0, 2559, 311, '2025-12-23 08:27:31', '2025-12-23 08:27:31'),
(1743, 0, 0, 2558, 368, '2025-12-23 08:27:41', '2025-12-23 08:27:41'),
(1744, 0, 0, 2556, 362, '2025-12-23 08:27:51', '2025-12-23 08:27:51'),
(1745, 0, 0, 2559, 364, '2025-12-23 08:28:01', '2025-12-23 08:28:01'),
(1746, 0, 0, 2559, 363, '2025-12-23 08:28:11', '2025-12-23 08:28:11'),
(1747, 0, 0, 2547, 340, '2025-12-23 08:28:21', '2025-12-23 08:28:21'),
(1748, 0, 0, 2550, 351, '2025-12-23 08:28:31', '2025-12-23 08:28:31'),
(1749, 0, 0, 2550, 350, '2025-12-23 08:28:41', '2025-12-23 08:28:41'),
(1750, 0, 0, 2544, 345, '2025-12-23 08:28:51', '2025-12-23 08:28:51'),
(1751, 0, 0, 2549, 365, '2025-12-23 08:29:01', '2025-12-23 08:29:01'),
(1752, 0, 0, 2548, 368, '2025-12-23 08:29:11', '2025-12-23 08:29:11'),
(1753, 0, 0, 2550, 362, '2025-12-23 08:29:21', '2025-12-23 08:29:21'),
(1754, 0, 0, 2552, 368, '2025-12-23 08:29:31', '2025-12-23 08:29:31'),
(1755, 0, 0, 2553, 362, '2025-12-23 08:29:41', '2025-12-23 08:29:41'),
(1756, 0, 0, 2547, 366, '2025-12-23 08:29:51', '2025-12-23 08:29:51'),
(1757, 0, 0, 2554, 366, '2025-12-23 08:30:01', '2025-12-23 08:30:01'),
(1758, 0, 0, 2544, 350, '2025-12-23 08:30:11', '2025-12-23 08:30:11'),
(1759, 0, 0, 2553, 354, '2025-12-23 08:30:21', '2025-12-23 08:30:21'),
(1760, 0, 0, 2555, 337, '2025-12-23 08:30:31', '2025-12-23 08:30:31'),
(1761, 0, 0, 2559, 353, '2025-12-23 08:30:41', '2025-12-23 08:30:41'),
(1762, 0, 0, 2548, 356, '2025-12-23 08:30:51', '2025-12-23 08:30:51'),
(1763, 0, 0, 2551, 349, '2025-12-23 08:31:01', '2025-12-23 08:31:01'),
(1764, 0, 0, 2549, 347, '2025-12-23 08:31:11', '2025-12-23 08:31:11'),
(1765, 0, 0, 2549, 340, '2025-12-23 08:31:21', '2025-12-23 08:31:21'),
(1766, 0, 0, 2557, 328, '2025-12-23 08:31:31', '2025-12-23 08:31:31'),
(1767, 0, 0, 2550, 327, '2025-12-23 08:31:41', '2025-12-23 08:31:41'),
(1768, 0, 0, 2557, 327, '2025-12-23 08:31:51', '2025-12-23 08:31:51'),
(1769, 0, 0, 2557, 329, '2025-12-23 08:32:03', '2025-12-23 08:32:03'),
(1770, 0, 0, 2550, 342, '2025-12-23 08:32:11', '2025-12-23 08:32:11'),
(1771, 0, 0, 2550, 345, '2025-12-23 08:32:21', '2025-12-23 08:32:21'),
(1772, 0, 0, 2549, 351, '2025-12-23 08:32:31', '2025-12-23 08:32:31'),
(1773, 0, 0, 2546, 203, '2025-12-23 08:32:41', '2025-12-23 08:32:41'),
(1774, 0, 0, 2554, 180, '2025-12-23 08:32:51', '2025-12-23 08:32:51'),
(1775, 0, 0, 2559, 187, '2025-12-23 08:33:01', '2025-12-23 08:33:01'),
(1776, 0, 0, 2559, 142, '2025-12-23 08:33:11', '2025-12-23 08:33:11'),
(1777, 29.5, 84.4, 2585, 308, '2025-12-23 08:33:54', '2025-12-23 08:33:54'),
(1778, 29.5, 84.2, 2559, 228, '2025-12-23 08:34:05', '2025-12-23 08:34:05'),
(1779, 29.5, 83.7, 2559, 233, '2025-12-23 08:34:14', '2025-12-23 08:34:14'),
(1780, 29.5, 83.1, 2559, 224, '2025-12-23 08:34:24', '2025-12-23 08:34:24'),
(1781, 29.5, 82.7, 2558, 241, '2025-12-23 08:34:34', '2025-12-23 08:34:34'),
(1782, 29.5, 83.4, 2559, 244, '2025-12-23 08:34:44', '2025-12-23 08:34:44'),
(1783, 29.5, 83.4, 2559, 233, '2025-12-23 08:34:54', '2025-12-23 08:34:54'),
(1784, 29.5, 83.3, 2559, 266, '2025-12-23 08:35:04', '2025-12-23 08:35:04'),
(1785, 29.5, 83.9, 2559, 72, '2025-12-23 08:35:14', '2025-12-23 08:35:14'),
(1786, 29.5, 84.4, 2559, 300, '2025-12-23 08:35:24', '2025-12-23 08:35:24'),
(1787, 29.5, 84.9, 2559, 281, '2025-12-23 08:35:34', '2025-12-23 08:35:34'),
(1788, 29.5, 85.4, 2557, 253, '2025-12-23 08:35:44', '2025-12-23 08:35:44'),
(1789, 29.5, 85.5, 2559, 272, '2025-12-23 08:35:54', '2025-12-23 08:35:54'),
(1790, 29.5, 84.4, 2557, 276, '2025-12-23 08:36:04', '2025-12-23 08:36:04'),
(1791, 0, 0, 1276, 157, '2025-12-23 08:36:24', '2025-12-23 08:36:24'),
(1792, 0, 0, 1267, 227, '2025-12-23 08:36:34', '2025-12-23 08:36:34'),
(1793, 0, 0, 1255, 217, '2025-12-23 08:36:44', '2025-12-23 08:36:44'),
(1794, 0, 0, 1300, 185, '2025-12-23 08:37:01', '2025-12-23 08:37:01'),
(1795, 0, 0, 1310, 192, '2025-12-23 08:37:11', '2025-12-23 08:37:11'),
(1796, 0, 0, 1325, 146, '2025-12-23 08:37:21', '2025-12-23 08:37:21'),
(1797, 0, 0, 1173, 235, '2025-12-23 08:37:31', '2025-12-23 08:37:31'),
(1798, 0, 0, 1169, 226, '2025-12-23 08:37:41', '2025-12-23 08:37:41'),
(1799, 0, 0, 1170, 227, '2025-12-23 08:37:51', '2025-12-23 08:37:51'),
(1800, 0, 0, 1185, 187, '2025-12-23 08:38:01', '2025-12-23 08:38:01'),
(1801, 0, 0, 1184, 233, '2025-12-23 08:38:11', '2025-12-23 08:38:11'),
(1802, 0, 0, 1178, 211, '2025-12-23 08:38:21', '2025-12-23 08:38:21'),
(1803, 0, 0, 1181, 211, '2025-12-23 08:38:31', '2025-12-23 08:38:31'),
(1804, 29.5, 83.1, 1121, 339, '2025-12-23 08:38:56', '2025-12-23 08:38:56'),
(1805, 29.5, 82.8, 954, 356, '2025-12-23 08:39:06', '2025-12-23 08:39:06'),
(1806, 29.6, 82.9, 789, 354, '2025-12-23 08:39:16', '2025-12-23 08:39:16'),
(1807, 29.6, 83.2, 1217, 275, '2025-12-23 08:39:26', '2025-12-23 08:39:26'),
(1808, 29.6, 83.4, 1223, 242, '2025-12-23 08:39:36', '2025-12-23 08:39:36'),
(1809, 29.6, 83.3, 1227, 274, '2025-12-23 08:39:46', '2025-12-23 08:39:46'),
(1810, 29.6, 82.7, 1227, 368, '2025-12-23 08:39:56', '2025-12-23 08:39:56'),
(1811, 29.6, 82.6, 1232, 281, '2025-12-23 08:40:06', '2025-12-23 08:40:06'),
(1812, 29.6, 82.8, 1251, 308, '2025-12-23 08:40:16', '2025-12-23 08:40:16'),
(1813, 29.5, 83.5, 1250, 327, '2025-12-23 08:40:26', '2025-12-23 08:40:26'),
(1814, 29.5, 84.1, 1263, 122, '2025-12-23 08:40:36', '2025-12-23 08:40:36'),
(1815, 29.5, 84.4, 1248, 158, '2025-12-23 08:40:46', '2025-12-23 08:40:46'),
(1816, 29.5, 84.4, 1250, 333, '2025-12-23 08:40:56', '2025-12-23 08:40:56'),
(1817, 29.5, 84.4, 1257, 350, '2025-12-23 08:41:06', '2025-12-23 08:41:06'),
(1818, 29.5, 84.5, 1249, 348, '2025-12-23 08:41:16', '2025-12-23 08:41:16'),
(1819, 29.5, 83.2, 1251, 314, '2025-12-23 08:41:26', '2025-12-23 08:41:26'),
(1820, 29.5, 82.9, 1252, 323, '2025-12-23 08:41:36', '2025-12-23 08:41:36'),
(1821, 29.5, 83, 1258, 388, '2025-12-23 08:41:46', '2025-12-23 08:41:46'),
(1822, 29.5, 83.3, 1253, 388, '2025-12-23 08:41:56', '2025-12-23 08:41:56'),
(1823, 29.4, 82.6, 1264, 222, '2025-12-23 08:42:06', '2025-12-23 08:42:06'),
(1824, 29.5, 82.4, 1264, 379, '2025-12-23 08:42:16', '2025-12-23 08:42:16'),
(1825, 29.4, 82.6, 1255, 372, '2025-12-23 08:42:26', '2025-12-23 08:42:26'),
(1826, 29.4, 82.4, 1262, 337, '2025-12-23 08:42:36', '2025-12-23 08:42:36'),
(1827, 29.4, 82.3, 1261, 342, '2025-12-23 08:42:46', '2025-12-23 08:42:46'),
(1828, 29.4, 82.7, 1251, 380, '2025-12-23 08:42:56', '2025-12-23 08:42:56'),
(1829, 29.4, 82.4, 1264, 371, '2025-12-23 08:43:06', '2025-12-23 08:43:06'),
(1830, 29.4, 82.3, 1277, 363, '2025-12-23 08:43:16', '2025-12-23 08:43:16'),
(1831, 29.4, 82.3, 1254, 369, '2025-12-23 08:43:26', '2025-12-23 08:43:26'),
(1832, 29.4, 82.2, 1259, 376, '2025-12-23 08:43:36', '2025-12-23 08:43:36'),
(1833, 29.4, 82.2, 1260, 369, '2025-12-23 08:43:46', '2025-12-23 08:43:46'),
(1834, 29.4, 82.6, 1258, 381, '2025-12-23 08:43:56', '2025-12-23 08:43:56'),
(1835, 29.4, 82.6, 1258, 396, '2025-12-23 08:44:06', '2025-12-23 08:44:06'),
(1836, 29.4, 82.9, 1254, 406, '2025-12-23 08:44:16', '2025-12-23 08:44:16'),
(1837, 29.4, 83.9, 1247, 411, '2025-12-23 08:44:26', '2025-12-23 08:44:26'),
(1838, 29.4, 84.1, 1255, 390, '2025-12-23 08:44:36', '2025-12-23 08:44:36'),
(1839, 29.3, 84.3, 1250, 186, '2025-12-23 08:44:46', '2025-12-23 08:44:46');

-- --------------------------------------------------------

--
-- Table structure for table `ukuran`
--

CREATE TABLE `ukuran` (
  `id_ukuran` bigint UNSIGNED NOT NULL,
  `nama_ukuran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ukuran`
--

INSERT INTO `ukuran` (`id_ukuran`, `nama_ukuran`) VALUES
(1, 'Mini'),
(2, 'Sedang'),
(3, 'Besar'),
(4, 'Ekstra Besar');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` bigint UNSIGNED NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `google_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `no_hp` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_kelamin` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'L',
  `foto_profil` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `kota` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_pos` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `role`, `nama`, `email`, `password`, `google_id`, `alamat`, `no_hp`, `jenis_kelamin`, `foto_profil`, `email_verified_at`, `kota`, `kode_pos`, `remember_token`, `created_at`, `updated_at`) VALUES
(5, 'user', 'a', 'a@gmail.com', '$2y$12$ud6jalpZOfmevP38W.k2IeUQYpMT32L0OrTPi/zWWjjcrRYkHwVb6', NULL, 'Jl. Cendana No. 5', '081298765432', 'L', NULL, NULL, 'Bandung', '40123', NULL, '2025-12-22 07:34:36', '2025-12-22 07:34:36'),
(6, 'user', 'b', 'b@gmail.com', '$2y$12$GW6NmyrN9dvUaLkViDE9zeVasWx2nBxtgtoZtV3TVdy6GXH302Gmq', NULL, 'Jl. Cendana No. 5', '081298765432', 'L', NULL, NULL, 'Bandung', '40123', NULL, '2025-12-22 07:34:36', '2025-12-22 07:34:36'),
(7, 'user', 'c', 'c@gmail.com', '$2y$12$qbusrDmPd.Tq6MQ9soAHFuAq83uVrxip5e7trokx5cyVXtcm8eO/i', NULL, 'Jl. Cendana No. 5', '081298765432', 'L', NULL, NULL, 'Bandung', '40123', NULL, '2025-12-22 07:34:36', '2025-12-22 07:34:36'),
(8, 'user', 'Tino Nurcahya', 'tinonurcahya.msi@gmail.com', '$2y$12$0f.UaykVZc9xUB7Ta/YwEuXOWeetNXZoIr0SqzFm5kF1RXqltun2G', '109880261388014126393', 'jalan mawar no 3', '08123456787', 'L', NULL, '2025-12-22 08:10:07', NULL, NULL, 'ylSTac2v9us9jZjoujChDiCbpWIUz1mhzVeC3WkwFjUwFAsi8O267Ubm0TyX', '2025-12-22 08:09:32', '2025-12-22 12:19:25'),
(9, 'admin', 'Tino Nurcahya', 'tinonurcahya@gmail.com', '$2y$12$GGmtZucQuo/oIPeqLRbvN.CqLrStRiIwdEPXWNs9rwzm4MvDgY4xm', '110216955906283617943', NULL, NULL, 'L', NULL, '2025-12-22 15:33:37', NULL, NULL, 'rvL9NwObNe5VrbrhC8IoGQJDxSVs3J9DaggUPPPNdkXbxO7ARqEKPWGrVDre', '2025-12-22 15:32:19', '2025-12-22 15:33:37'),
(10, 'user', 'Viola Insan Putri', 'violainsanputri@gmail.com', '$2y$12$rm/F8wkFZ7BkG3oQg.2.PueJwqmyVcDSBO9wy2ZP9foYShmCzyFaC', '106552643641123548700', NULL, NULL, 'L', NULL, '2025-12-23 01:05:06', NULL, NULL, 'E9Lpic4JyWxdv3ML91AXOsbdI66QzRskytDoYcl3EFroyoKOqlNIMV43g7Mx', '2025-12-23 01:04:14', '2025-12-23 01:05:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_orders`
--
ALTER TABLE `admin_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_orders_user_id_foreign` (`user_id`),
  ADD KEY `admin_orders_order_code_index` (`order_code`);

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
-- Indexes for table `detail_tanaman`
--
ALTER TABLE `detail_tanaman`
  ADD PRIMARY KEY (`id_detail_tanaman`),
  ADD KEY `detail_tanaman_id_produk_foreign` (`id_produk`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `foto_produk`
--
ALTER TABLE `foto_produk`
  ADD PRIMARY KEY (`id_foto_produk`),
  ADD KEY `foto_produk_id_produk_foreign` (`id_produk`);

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
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`),
  ADD UNIQUE KEY `keranjang_id_users_id_produk_ukuran_unique` (`id_users`,`id_produk_ukuran`),
  ADD KEY `keranjang_id_produk_ukuran_foreign` (`id_produk_ukuran`);

--
-- Indexes for table `midtrans_notification_logs`
--
ALTER TABLE `midtrans_notification_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `midtrans_notification_logs_order_id_index` (`order_id`),
  ADD KEY `midtrans_notification_logs_order_id_status_index` (`order_id`,`status`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id_notifikasi`),
  ADD KEY `notifikasi_id_users_foreign` (`id_users`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD KEY `password_reset_tokens_email_index` (`email`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD UNIQUE KEY `pesanan_kode_pesanan_unique` (`kode_pesanan`),
  ADD KEY `pesanan_id_users_foreign` (`id_users`);

--
-- Indexes for table `pesanan_item`
--
ALTER TABLE `pesanan_item`
  ADD PRIMARY KEY (`id_pesanan_item`),
  ADD KEY `pesanan_item_id_pesanan_foreign` (`id_pesanan`),
  ADD KEY `pesanan_item_id_produk_ukuran_foreign` (`id_produk_ukuran`);

--
-- Indexes for table `petunjuk_perawatan`
--
ALTER TABLE `petunjuk_perawatan`
  ADD PRIMARY KEY (`id_petunjuk_perawatan`),
  ADD KEY `petunjuk_perawatan_id_produk_foreign` (`id_produk`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `produk_id_kategori_foreign` (`id_kategori`);

--
-- Indexes for table `produk_ukuran`
--
ALTER TABLE `produk_ukuran`
  ADD PRIMARY KEY (`id_produk_ukuran`),
  ADD UNIQUE KEY `produk_ukuran_id_produk_id_ukuran_unique` (`id_produk`,`id_ukuran`),
  ADD KEY `produk_ukuran_id_ukuran_foreign` (`id_ukuran`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id_review`),
  ADD KEY `review_id_produk_foreign` (`id_produk`),
  ADD KEY `review_id_users_foreign` (`id_users`),
  ADD KEY `review_id_pesanan_foreign` (`id_pesanan`);

--
-- Indexes for table `sensor_data`
--
ALTER TABLE `sensor_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ukuran`
--
ALTER TABLE `ukuran`
  ADD PRIMARY KEY (`id_ukuran`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_orders`
--
ALTER TABLE `admin_orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_tanaman`
--
ALTER TABLE `detail_tanaman`
  MODIFY `id_detail_tanaman` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `foto_produk`
--
ALTER TABLE `foto_produk`
  MODIFY `id_foto_produk` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `midtrans_notification_logs`
--
ALTER TABLE `midtrans_notification_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id_notifikasi` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `pesanan_item`
--
ALTER TABLE `pesanan_item`
  MODIFY `id_pesanan_item` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `petunjuk_perawatan`
--
ALTER TABLE `petunjuk_perawatan`
  MODIFY `id_petunjuk_perawatan` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `produk_ukuran`
--
ALTER TABLE `produk_ukuran`
  MODIFY `id_produk_ukuran` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id_review` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sensor_data`
--
ALTER TABLE `sensor_data`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1840;

--
-- AUTO_INCREMENT for table `ukuran`
--
ALTER TABLE `ukuran`
  MODIFY `id_ukuran` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_orders`
--
ALTER TABLE `admin_orders`
  ADD CONSTRAINT `admin_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_users`) ON DELETE SET NULL;

--
-- Constraints for table `detail_tanaman`
--
ALTER TABLE `detail_tanaman`
  ADD CONSTRAINT `detail_tanaman_id_produk_foreign` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE;

--
-- Constraints for table `foto_produk`
--
ALTER TABLE `foto_produk`
  ADD CONSTRAINT `foto_produk_id_produk_foreign` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE;

--
-- Constraints for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `keranjang_id_produk_ukuran_foreign` FOREIGN KEY (`id_produk_ukuran`) REFERENCES `produk_ukuran` (`id_produk_ukuran`) ON DELETE CASCADE,
  ADD CONSTRAINT `keranjang_id_users_foreign` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE CASCADE;

--
-- Constraints for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD CONSTRAINT `notifikasi_id_users_foreign` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE CASCADE;

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_id_users_foreign` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE CASCADE;

--
-- Constraints for table `pesanan_item`
--
ALTER TABLE `pesanan_item`
  ADD CONSTRAINT `pesanan_item_id_pesanan_foreign` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`) ON DELETE CASCADE,
  ADD CONSTRAINT `pesanan_item_id_produk_ukuran_foreign` FOREIGN KEY (`id_produk_ukuran`) REFERENCES `produk_ukuran` (`id_produk_ukuran`) ON DELETE CASCADE;

--
-- Constraints for table `petunjuk_perawatan`
--
ALTER TABLE `petunjuk_perawatan`
  ADD CONSTRAINT `petunjuk_perawatan_id_produk_foreign` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE;

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_id_kategori_foreign` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE;

--
-- Constraints for table `produk_ukuran`
--
ALTER TABLE `produk_ukuran`
  ADD CONSTRAINT `produk_ukuran_id_produk_foreign` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE,
  ADD CONSTRAINT `produk_ukuran_id_ukuran_foreign` FOREIGN KEY (`id_ukuran`) REFERENCES `ukuran` (`id_ukuran`) ON DELETE CASCADE;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_id_pesanan_foreign` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`) ON DELETE CASCADE,
  ADD CONSTRAINT `review_id_produk_foreign` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE,
  ADD CONSTRAINT `review_id_users_foreign` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
