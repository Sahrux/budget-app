-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 03 Haz 2022, 10:14:13
-- Sunucu sürümü: 10.4.22-MariaDB
-- PHP Sürümü: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `phptask`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `balance`
--

CREATE TABLE `balance` (
  `id` int(255) NOT NULL,
  `balance` int(255) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `balance`
--

INSERT INTO `balance` (`id`, `balance`) VALUES
(1, 94);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `categories`
--

CREATE TABLE `categories` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'kommunal'),
(2, 'alışveriş'),
(3, 'mobil'),
(4, 'təhsil');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `currency`
--

CREATE TABLE `currency` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `currency`
--

INSERT INTO `currency` (`id`, `name`, `fullname`) VALUES
(1, 'azn', 'Azərbaycan Manatı'),
(2, 'usd', 'United States Dollar'),
(3, 'tl', 'Türk Lirəsi');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `income`
--

CREATE TABLE `income` (
  `id` int(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `amount` decimal(10,0) NOT NULL,
  `category_id` int(255) NOT NULL,
  `currency_id` int(255) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `income`
--

INSERT INTO `income` (`id`, `description`, `amount`, `category_id`, `currency_id`, `date`) VALUES
(2, 'kommunal üçün ', '50', 1, 1, '2022-06-03'),
(3, 'Online Alış Veriş', '200', 2, 2, '2022-06-04');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `payment`
--

CREATE TABLE `payment` (
  `id` int(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `amount` decimal(10,0) NOT NULL,
  `category_id` int(255) NOT NULL,
  `currency_id` int(255) NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `payment`
--

INSERT INTO `payment` (`id`, `description`, `amount`, `category_id`, `currency_id`, `payment_type`, `date`) VALUES
(1, 'Aylıq Ödəniş', '30', 1, 1, 0, '2022-06-03'),
(2, 'internet paketi ', '6', 3, 1, 0, '2022-06-15'),
(3, '', '90', 2, 3, 0, '2022-06-17'),
(4, 'udemy', '30', 4, 2, 0, '2022-06-08');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `balance`
--
ALTER TABLE `balance`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `income`
--
ALTER TABLE `income`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `currency_id` (`currency_id`);

--
-- Tablo için indeksler `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `currency_id` (`currency_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `balance`
--
ALTER TABLE `balance`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `income`
--
ALTER TABLE `income`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `income`
--
ALTER TABLE `income`
  ADD CONSTRAINT `income_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `income_ibfk_2` FOREIGN KEY (`currency_id`) REFERENCES `currency` (`id`);

--
-- Tablo kısıtlamaları `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`currency_id`) REFERENCES `currency` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
