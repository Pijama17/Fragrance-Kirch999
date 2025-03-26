-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 27 sep 2024 om 13:57
-- Serverversie: 10.4.32-MariaDB
-- PHP-versie: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `1`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestellingen`
--

CREATE TABLE `bestellingen` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `totaal_bedrag` decimal(10,2) NOT NULL,
  `datum` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `bestellingen`
--

INSERT INTO `bestellingen` (`id`, `user_id`, `totaal_bedrag`, `datum`) VALUES
(3, 999, 150.00, '2024-09-19 11:55:02');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestelling_items`
--

CREATE TABLE `bestelling_items` (
  `id` int(11) NOT NULL,
  `bestelling_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `aantal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `datum` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `message`, `datum`) VALUES
(8, 'rayan', 'pijamafaze@gmail.com', 'een hele goede website', '2024-09-27 09:35:06'),
(9, 'rayan', 'pijamafaze@gmail.com', 'je dikke zus', '2024-09-27 11:50:07');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `producten`
--

CREATE TABLE `producten` (
  `id` int(11) NOT NULL,
  `product` varchar(255) NOT NULL,
  `prijs` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `omschrijving` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `producten`
--

INSERT INTO `producten` (`id`, `product`, `prijs`, `image`, `omschrijving`) VALUES
(1, 'Private Blend Fragrances Oud Wood Eau de Parfum', 50.00, '', 'Tom Ford - Oud Wood Eau de Parfum\r\nZeldzaam. Exotisch. Onderscheidend. Eén van de zeldzaamste, kostbaarste en duurste ingrediënten in het register van een parfumeur, oud hout, wordt vaak verbrand in de wierook-gevulde tempels van Bhutan. Exotisch rozenhout en kardemom voeren naar een rokerige mix van sandelhout en vetiver. Tonkaboon en amber voegen warmte en sensualiteit toe.'),
(2, 'Jean Paul', 75.00, '', 'Pure Perfection is een meesterwerk van Gisada dat de essentie van luxe en verfijning vastlegt. Deze geur is een harmonieuze combinatie van sprankelende citrus, delicate bloemen en warme houtachtige noten. Perfect voor de moderne man die zijn stijl en persoonlijkheid wil benadrukken.'),
(3, 'Gisada', 100.00, '', 'Eau de Parfum is een krachtige geur die de moderniteit van de man van vandaag weerspiegelt. Het is een perfecte balans tussen frisse citrusnoten en warme houtachtige akkoorden, ideaal voor elke gelegenheid.');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `track_order`
--

CREATE TABLE `track_order` (
  `process_number` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `track_order`
--

INSERT INTO `track_order` (`process_number`, `id`, `order_id`, `status`, `updated_at`) VALUES
(8732, 999, 3, 'BEZIG ', '2024-09-26 08:54:53');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `naam` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `wachtwoord` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `naam`, `email`, `wachtwoord`) VALUES
(999, 'rayan', 'pijamafaze@gmail.com', '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `winkelwagen`
--

CREATE TABLE `winkelwagen` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `aantal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `bestellingen`
--
ALTER TABLE `bestellingen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexen voor tabel `bestelling_items`
--
ALTER TABLE `bestelling_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bestelling_id` (`bestelling_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexen voor tabel `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `producten`
--
ALTER TABLE `producten`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `track_order`
--
ALTER TABLE `track_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexen voor tabel `winkelwagen`
--
ALTER TABLE `winkelwagen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `bestellingen`
--
ALTER TABLE `bestellingen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `bestelling_items`
--
ALTER TABLE `bestelling_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT voor een tabel `producten`
--
ALTER TABLE `producten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `track_order`
--
ALTER TABLE `track_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1002;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10000;

--
-- AUTO_INCREMENT voor een tabel `winkelwagen`
--
ALTER TABLE `winkelwagen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `bestellingen`
--
ALTER TABLE `bestellingen`
  ADD CONSTRAINT `bestellingen_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Beperkingen voor tabel `bestelling_items`
--
ALTER TABLE `bestelling_items`
  ADD CONSTRAINT `bestelling_items_ibfk_1` FOREIGN KEY (`bestelling_id`) REFERENCES `bestellingen` (`id`),
  ADD CONSTRAINT `bestelling_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `producten` (`id`);

--
-- Beperkingen voor tabel `track_order`
--
ALTER TABLE `track_order`
  ADD CONSTRAINT `track_order_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `bestellingen` (`id`);

--
-- Beperkingen voor tabel `winkelwagen`
--
ALTER TABLE `winkelwagen`
  ADD CONSTRAINT `winkelwagen_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `producten` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
 