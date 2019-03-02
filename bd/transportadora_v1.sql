-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 21-Fev-2019 às 01:49
-- Versão do servidor: 5.7.23
-- versão do PHP: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `transportadora`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `doc`
--

DROP TABLE IF EXISTS `doc`;
CREATE TABLE IF NOT EXISTS `doc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_upload` date DEFAULT NULL,
  `arquivo_path` varchar(300) DEFAULT NULL,
  `entrega` int(11) DEFAULT NULL,
  `tipo` varchar(150) DEFAULT NULL,
  `descricao` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `entrega`
--

DROP TABLE IF EXISTS `entrega`;
CREATE TABLE IF NOT EXISTS `entrega` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_criacao` date DEFAULT NULL,
  `data_previsao` date DEFAULT NULL,
  `email_cli` varchar(150) DEFAULT NULL,
  `nome_cli` varchar(100) DEFAULT NULL,
  `doc_cli` varchar(100) DEFAULT NULL,
  `nf` varchar(100) DEFAULT NULL,
  `produto` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
