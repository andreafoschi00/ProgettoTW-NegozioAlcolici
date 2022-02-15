SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `negozio_alcolici_tw` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `negozio_alcolici_tw`;

CREATE TABLE `categoria` (
  `ID` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `cliente` (
  `ID` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `cognome` varchar(20) NOT NULL,
  `dataNascita` date NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `notifica` (
  `ID` int(11) NOT NULL,
  `testo` varchar(500) NOT NULL,
  `tipo` enum('spedizione','esaurimento') NOT NULL,
  `letta` tinyint(1) NOT NULL,
  `ID_venditore` int(11) DEFAULT NULL,
  `ID_cliente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `ordine` (
  `ID` int(11) NOT NULL,
  `costoTotale` float NOT NULL,
  `tipoPagamento` enum('Contanti alla consegna','Carta di credito') NOT NULL,
  `indirizzoSpedizione` enum('Via Cesare Pavese, 50, 47521 Cesena FC (1° Piano)','Via Nicolò Macchiavelli, 47521 Cesena FC (Piano Terra)') NOT NULL,
  `dataOraOrdine` datetime NOT NULL,
  `numeroCarta` bigint(16) DEFAULT NULL,
  `dataScadenzaCarta` date DEFAULT NULL,
  `cvv` int(3) DEFAULT NULL,
  `ID_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

CREATE TABLE `prodotto_in_ordine` (
  `quantitàAcquistata` int(11) NOT NULL,
  `ID_ordine` int(11) NOT NULL,
  `ID_prodotto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `venditore` (
  `ID` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `cognome` varchar(20) NOT NULL,
  `dataNascita` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE `categoria`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `cliente`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `email` (`email`);

ALTER TABLE `notifica`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FKdi_venditore` (`ID_venditore`),
  ADD KEY `FKdi_cliente` (`ID_cliente`);

ALTER TABLE `ordine`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FKeffettua` (`ID_cliente`);

ALTER TABLE `prodotto`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FKinserisce` (`ID_venditore`),
  ADD KEY `FKappartiene` (`ID_categoria`);

ALTER TABLE `prodotto_in_ordine`
  ADD PRIMARY KEY (`ID_ordine`,`ID_prodotto`),
  ADD KEY `ID_ordine` (`ID_ordine`),
  ADD KEY `ID_prodotto` (`ID_prodotto`);

ALTER TABLE `venditore`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `email` (`email`);


ALTER TABLE `categoria`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `cliente`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `notifica`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ordine`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `prodotto`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `venditore`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `notifica`
  ADD CONSTRAINT `FKdi_cliente` FOREIGN KEY (`ID_cliente`) REFERENCES `cliente` (`ID`),
  ADD CONSTRAINT `FKdi_venditore` FOREIGN KEY (`ID_venditore`) REFERENCES `venditore` (`ID`);

ALTER TABLE `ordine`
  ADD CONSTRAINT `FKeffettua` FOREIGN KEY (`ID_cliente`) REFERENCES `cliente` (`ID`);

ALTER TABLE `prodotto`
  ADD CONSTRAINT `FKappartiene` FOREIGN KEY (`ID_categoria`) REFERENCES `categoria` (`ID`),
  ADD CONSTRAINT `FKinserisce` FOREIGN KEY (`ID_venditore`) REFERENCES `venditore` (`ID`);

ALTER TABLE `prodotto_in_ordine`
  ADD CONSTRAINT `prodotto_in_ordine_ibfk_1` FOREIGN KEY (`ID_ordine`) REFERENCES `ordine` (`ID`),
  ADD CONSTRAINT `prodotto_in_ordine_ibfk_2` FOREIGN KEY (`ID_prodotto`) REFERENCES `prodotto` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
