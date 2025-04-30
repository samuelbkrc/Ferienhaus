-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 31. Mrz 2025 um 14:47
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
-- Datenbank: `ferienhaus`
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
  `erstellt_am` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `buchung`
--

INSERT INTO `buchung` (`id`, `gast_id`, `ferienhaus_id`, `ankunft`, `abfahrt`, `erstellt_am`) VALUES
(1, 1, 2, '2025-03-13', '2025-03-24', '2025-03-24 16:23:26');

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
  `beschreibung` text NOT NULL,
  `preis_pro_nacht` decimal(6,2) NOT NULL,
  `max_gaeste` int(11) NOT NULL,
  `erstellt_am` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `ferienhaus`
--

INSERT INTO `ferienhaus` (`id`, `name`, `adresse`, `plz`, `ort`, `beschreibung`, `preis_pro_nacht`, `max_gaeste`, `erstellt_am`) VALUES
(1, 'Pascal Vercayie', 'Gibsmühlstraße', '6600', 'Breitenwang', 'Hund ohne Hund', 12.00, 7, '2025-03-31 12:32:24'),
(1, 'Pascal Vercayie', 'Gibsmühl', '6600', 'Breitenwang', 'Hund ohne Hund', 11.00, 7, '2025-03-31 12:33:15'),
(2, 'Samuel Bukarica', 'Weidenstraße', '6600', 'Reutte', 'GOAT', 111.00, 2, '2025-03-31 12:33:49');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `gast`
--

CREATE TABLE `gast` (
  `id` int(11) NOT NULL,
  `vorname` varchar(50) NOT NULL,
  `nachname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefon` varchar(20) NOT NULL,
  `erstellt_am` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `buchung`
--
ALTER TABLE `buchung`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `gast_id` (`gast_id`),
  ADD UNIQUE KEY `ferienhaus_id` (`ferienhaus_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `buchung`
--
ALTER TABLE `buchung`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41877938;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
