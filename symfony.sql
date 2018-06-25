-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 25 Cze 2018, 13:02
-- Wersja serwera: 10.1.31-MariaDB
-- Wersja PHP: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `symfony`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `book`
--

CREATE TABLE `book` (
  `id_book` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `author` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `book`
--

INSERT INTO `book` (`id_book`, `title`, `author`, `price`) VALUES
(1, 'Gone: Faza Pierwsza - Niepokój', 'Michael Grant', '39.99'),
(2, 'Ogniem i mieczem', 'H. Sienkiewicz', '69.99'),
(3, 'Dzieci z Bulerbyn', 'Astrid Lindgren', '29.99'),
(4, 'Na gorącym uczynku', 'Harlan Coben', '15.00'),
(5, 'Mężczyźni, którzy nienawidzą kobiet', 'Stieg Larsson', '89.99'),
(6, 'Symfonia C++', 'Jerzy Grebosz', '79.99'),
(7, 'Baśnie Andersena', 'Hans Christian Andersen', '99.99'),
(8, 'Władca Pierścieni: Dwie wieże', 'John Ronald Reuel Tolkien', '119.90'),
(9, 'Zaginiona', 'Harlan Coben', '24.99'),
(10, 'Obiecaj mi', 'Harlan Coben', '19.99'),
(11, 'I nie było już nikogo', 'Agata Christie', '39.99'),
(12, 'W pustyni i w puszczy', 'H. Sienkiewicz', '59.99'),
(13, 'Sieci komputerowe', 'Karol Krysiak', '67.00'),
(14, 'Gastroenterologia', 'Simon Travis', '25.00'),
(15, 'Nieoficjalny podręcznik: HTML5', 'Matthew MacDonald', '80.00'),
(16, 'Śmierć na Nilu', 'Agata Christie', '9.99'),
(17, 'Tajemnicza wyspa', 'Jules Verne', '29.99');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `book_has_category`
--

CREATE TABLE `book_has_category` (
  `id_bhc` int(11) NOT NULL,
  `book_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `book_has_category`
--

INSERT INTO `book_has_category` (`id_bhc`, `book_id`, `category_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 6, 1),
(7, 7, 1),
(8, 8, 1),
(9, 9, 1),
(10, 10, 1),
(11, 11, 1),
(12, 12, 1),
(13, 13, 1),
(14, 14, 1),
(15, 15, 1),
(16, 16, 1),
(17, 17, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `category`
--

CREATE TABLE `category` (
  `id_category` int(11) NOT NULL,
  `name_cat` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `category`
--

INSERT INTO `category` (`id_category`, `name_cat`) VALUES
(1, ''),
(2, 'fantasy'),
(3, 'historyczna'),
(4, 'horror'),
(5, 'przygodowa'),
(6, 'kryminał'),
(7, 'bajki i baśnie'),
(8, 'klasyka'),
(9, 'IT'),
(10, 'romans'),
(11, 'popularnonaukowa');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id_book`);

--
-- Indeksy dla tabeli `book_has_category`
--
ALTER TABLE `book_has_category`
  ADD PRIMARY KEY (`id_bhc`),
  ADD UNIQUE KEY `UNIQ_4ECB29AD16A2B381` (`book_id`),
  ADD KEY `IDX_4ECB29AD12469DE2` (`category_id`);

--
-- Indeksy dla tabeli `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `book`
--
ALTER TABLE `book`
  MODIFY `id_book` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT dla tabeli `book_has_category`
--
ALTER TABLE `book_has_category`
  MODIFY `id_bhc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT dla tabeli `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `book_has_category`
--
ALTER TABLE `book_has_category`
  ADD CONSTRAINT `FK_4ECB29AD12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id_category`),
  ADD CONSTRAINT `FK_4ECB29AD16A2B381` FOREIGN KEY (`book_id`) REFERENCES `book` (`id_book`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
