-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Feb 08, 2022 alle 23:46
-- Versione del server: 10.4.21-MariaDB
-- Versione PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `negozio_alcolici_tw`
--
CREATE DATABASE IF NOT EXISTS `negozio_alcolici_tw` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `negozio_alcolici_tw`;

-- --------------------------------------------------------

--
-- Struttura della tabella `categoria`
--

CREATE TABLE `categoria` (
  `ID` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `cliente`
--

CREATE TABLE `cliente` (
  `ID` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `cognome` varchar(20) NOT NULL,
  `dataNascita` date NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `notifica`
--

CREATE TABLE `notifica` (
  `ID` int(11) NOT NULL,
  `testo` varchar(100) NOT NULL,
  `tipo` enum('spedizione','esaurimento') NOT NULL,
  `ID_venditore` int(11) DEFAULT NULL,
  `ID_cliente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `ordine`
--

CREATE TABLE `ordine` (
  `ID` int(11) NOT NULL,
  `costoTotale` float NOT NULL,
  `tipoPagamento` enum('contanti','carta') NOT NULL,
  `dataOraOrdine` datetime NOT NULL,
  `numeroCarta` int(11) NOT NULL,
  `dataScadenzaCarta` date NOT NULL,
  `cvv` int(11) NOT NULL,
  `ID_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotto`
--

CREATE TABLE `prodotto` (
  `ID` int(11) NOT NULL,
  `ID_venditore` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `nomeImmagine` varchar(30) NOT NULL,
  `quantitàDisponibile` int(11) NOT NULL,
  `tipoDisponibilità` enum('Immediata','5 giorni','10 giorni','1 mese') NOT NULL,
  `prezzoUnitario` float NOT NULL,
  `testoBreve` varchar(100) NOT NULL,
  `testoMedio` varchar(1000) NOT NULL,
  `testoLungo` varchar(2500) NOT NULL,
  `dataInserimento` date NOT NULL,
  `ID_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotto_in_ordine`
--

CREATE TABLE `prodotto_in_ordine` (
  `quantitàAcquistata` int(11) NOT NULL,
  `ID_ordine` int(11) NOT NULL,
  `ID_prodotto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `venditore`
--

CREATE TABLE `venditore` (
  `ID` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `cognome` varchar(20) NOT NULL,
  `dataNascita` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indici per le tabelle `notifica`
--
ALTER TABLE `notifica`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FKdi_venditore` (`ID_venditore`),
  ADD KEY `FKdi_cliente` (`ID_cliente`);

--
-- Indici per le tabelle `ordine`
--
ALTER TABLE `ordine`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FKeffettua` (`ID_cliente`);

--
-- Indici per le tabelle `prodotto`
--
ALTER TABLE `prodotto`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FKinserisce` (`ID_venditore`),
  ADD KEY `FKappartiene` (`ID_categoria`);

--
-- Indici per le tabelle `prodotto_in_ordine`
--
ALTER TABLE `prodotto_in_ordine`
  ADD PRIMARY KEY (`ID_ordine`,`ID_prodotto`),
  ADD UNIQUE KEY `ID_ordine` (`ID_ordine`),
  ADD KEY `ID_prodotto` (`ID_prodotto`);

--
-- Indici per le tabelle `venditore`
--
ALTER TABLE `venditore`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `categoria`
--
ALTER TABLE `categoria`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `cliente`
--
ALTER TABLE `cliente`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `notifica`
--
ALTER TABLE `notifica`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `ordine`
--
ALTER TABLE `ordine`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `prodotto`
--
ALTER TABLE `prodotto`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `venditore`
--
ALTER TABLE `venditore`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `notifica`
--
ALTER TABLE `notifica`
  ADD CONSTRAINT `FKdi_cliente` FOREIGN KEY (`ID_cliente`) REFERENCES `cliente` (`ID`),
  ADD CONSTRAINT `FKdi_venditore` FOREIGN KEY (`ID_venditore`) REFERENCES `venditore` (`ID`);

--
-- Limiti per la tabella `ordine`
--
ALTER TABLE `ordine`
  ADD CONSTRAINT `FKeffettua` FOREIGN KEY (`ID_cliente`) REFERENCES `cliente` (`ID`);

--
-- Limiti per la tabella `prodotto`
--
ALTER TABLE `prodotto`
  ADD CONSTRAINT `FKappartiene` FOREIGN KEY (`ID_categoria`) REFERENCES `categoria` (`ID`),
  ADD CONSTRAINT `FKinserisce` FOREIGN KEY (`ID_venditore`) REFERENCES `venditore` (`ID`);

--
-- Limiti per la tabella `prodotto_in_ordine`
--
ALTER TABLE `prodotto_in_ordine`
  ADD CONSTRAINT `prodotto_in_ordine_ibfk_1` FOREIGN KEY (`ID_ordine`) REFERENCES `ordine` (`ID`),
  ADD CONSTRAINT `prodotto_in_ordine_ibfk_2` FOREIGN KEY (`ID_prodotto`) REFERENCES `prodotto` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
