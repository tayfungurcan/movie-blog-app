-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 17 Şub 2024, 14:49:24
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `blogapp`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `short_description` varchar(500) NOT NULL,
  `description` text DEFAULT NULL,
  `imageUrl` varchar(100) DEFAULT NULL,
  `url` varchar(150) NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  `isHome` tinyint(1) NOT NULL DEFAULT 0,
  `dateAdded` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tablo döküm verisi `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `short_description`, `description`, `imageUrl`, `url`, `isActive`, `isHome`, `dateAdded`) VALUES
(1, 'film 1', '   film 1 kısa açıklama', '&lt;p&gt;film 1 a&amp;ccedil;ıklama&lt;/p&gt;', '1a7e80b3ae99b5c4274248f21365ec29.jpeg', 'film-1', 1, 1, '2024-02-09 20:27:00'),
(2, 'film 2', '  film 2 kısa açıklama\r\n', '&lt;p&gt;film 2 a&amp;ccedil;ıklama&lt;/p&gt;', 'e802c82961f474a378153d7c6a51b72a.jpeg', 'film-2', 1, 1, '2024-02-09 20:27:00'),
(3, 'film 3', '     film 3 kısa açıklama', '&lt;p&gt;film 3 a&amp;ccedil;ıklama&lt;/p&gt;', 'db0c6ab7e2682012fdac6e6d5245bd1e.jpeg', 'film-3', 1, 1, '2024-02-09 20:27:00');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `blog_category`
--

CREATE TABLE `blog_category` (
  `blog_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tablo döküm verisi `blog_category`
--

INSERT INTO `blog_category` (`blog_id`, `category_id`) VALUES
(1, 2),
(1, 3),
(2, 2),
(2, 3),
(3, 1),
(3, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tablo döküm verisi `categories`
--

INSERT INTO `categories` (`id`, `name`, `isActive`) VALUES
(1, 'dram', 1),
(2, 'komedi', 1),
(3, 'korku', 1),
(4, 'romantizm', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(10) NOT NULL DEFAULT 'user',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `user_type`, `created_at`) VALUES
(1, 'tayfun', 'kullanıcı@hotmail.com', '$2y$10$WxvH7cgjPTK6gIZGieSZyu4HavdYcPmcYfB13Fh/VFtn6IwWGY5jy', 'user', '2024-02-11 20:31:38'),
(2, 'tayfun1', 'admin@hotmail.com', '$2y$10$grGKgwGTqlm7XbfEKSugA.Wh/iQurIhuujgs.8lKdm6uKJI.XEMNK', 'admin', '2024-02-11 20:31:56');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `url` (`url`);

--
-- Tablo için indeksler `blog_category`
--
ALTER TABLE `blog_category`
  ADD PRIMARY KEY (`blog_id`,`category_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Tablo için indeksler `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `blog_category`
--
ALTER TABLE `blog_category`
  ADD CONSTRAINT `blog_category_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `blog_category_ibfk_2` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
