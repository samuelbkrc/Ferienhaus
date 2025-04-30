-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 30. Apr 2025 um 12:27
-- Server-Version: 10.4.32-MariaDB
-- PHP-Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `ferienhaus_db`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `buchung`
--

CREATE TABLE `buchung` (
  `id` int(11) NOT NULL,
  `gast_id` int(11) NOT NULL,
  `ferienhaus_id` int(11) NOT NULL,
  `ankunft` date NOT NULL,
  `abfahrt` date NOT NULL,
  `erstellt_am` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `buchung`
--

INSERT INTO `buchung` (`id`, `gast_id`, `ferienhaus_id`, `ankunft`, `abfahrt`, `erstellt_am`) VALUES
(17, 1, 1, '2025-04-04', '2025-04-20', '2025-04-29 15:29:24');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ferienhaus`
--

CREATE TABLE `ferienhaus` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `plz` varchar(10) NOT NULL,
  `ort` varchar(100) NOT NULL,
  `beschreibung` text DEFAULT NULL,
  `preis_pro_nacht` decimal(6,2) NOT NULL,
  `max_gaeste` int(11) NOT NULL,
  `erstellt_am` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `ferienhaus`
--

INSERT INTO `ferienhaus` (`id`, `name`, `adresse`, `plz`, `ort`, `beschreibung`, `preis_pro_nacht`, `max_gaeste`, `erstellt_am`) VALUES
(1, 'Haus am See', 'Seestr. 12', '12345', 'Musterstadt', 'Direkt am See mit Steg', 120.00, 4, '2025-04-07 07:38:47'),
(2, 'Bergblick Chalet', 'Bergweg 5', '67890', 'Alpendorf', 'Panorama-Ausblick auf die Berge', 150.00, 6, '2025-04-07 07:38:47'),
(3, 'Stadtvilla', 'Hauptstr. 100', '10115', 'Berlin', 'Zentrale Lage mit Garten', 200.00, 5, '2025-04-07 07:38:47');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `gast`
--

CREATE TABLE `gast` (
  `id` int(11) NOT NULL,
  `vorname` varchar(50) NOT NULL,
  `nachname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefon` varchar(20) DEFAULT NULL,
  `erstellt_am` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `gast`
--

INSERT INTO `gast` (`id`, `vorname`, `nachname`, `email`, `telefon`, `erstellt_am`) VALUES
(1, 'Anna', 'Müller', 'anna.mueller@example.com', '01711234567', '2025-04-07 07:38:47'),
(2, 'Ben', 'Schneider', 'ben.schneider@example.com', '01719876543', '2025-04-07 07:38:47'),
(3, 'Clara', 'Fischer', 'clara.fischer@example.com', '01515556677', '2025-04-07 07:38:47');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `buchung`
--
ALTER TABLE `buchung`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `ferienhaus`
--
ALTER TABLE `ferienhaus`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `gast`
--
ALTER TABLE `gast`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `buchung`
--
ALTER TABLE `buchung`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT für Tabelle `ferienhaus`
--
ALTER TABLE `ferienhaus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `gast`
--
ALTER TABLE `gast`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `buchung`
--
ALTER TABLE `buchung`
  ADD CONSTRAINT `buchung_ibfk_1` FOREIGN KEY (`gast_id`) REFERENCES `gast` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `buchung_ibfk_2` FOREIGN KEY (`ferienhaus_id`) REFERENCES `ferienhaus` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
