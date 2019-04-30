-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 16-Mar-2019 às 21:41
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
-- Estrutura da tabela `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(300) DEFAULT NULL,
  `cpf` varchar(300) DEFAULT NULL,
  `cnpj` varchar(300) DEFAULT NULL,
  `nome` varchar(350) DEFAULT NULL,
  `senha` varchar(300) DEFAULT NULL,
  `tel` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id`, `email`, `cpf`, `cnpj`, `nome`, `senha`, `tel`) VALUES
(1, 'globo.com', NULL, '111111', 'globo', '123', '111111');

-- --------------------------------------------------------

--
-- Estrutura da tabela `debito`
--

DROP TABLE IF EXISTS `debito`;
CREATE TABLE IF NOT EXISTS `debito` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `valor` double DEFAULT NULL,
  `fatura_path` varchar(400) DEFAULT NULL,
  `boleto_path` varchar(400) DEFAULT NULL,
  `cte_path` varchar(400) DEFAULT NULL,
  `data_create` date DEFAULT NULL,
  `data_vencimento` date DEFAULT NULL,
  `id_entrega` int(11) DEFAULT NULL,
  `cnpj` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `debito`
--

INSERT INTO `debito` (`id`, `valor`, `fatura_path`, `boleto_path`, `cte_path`, `data_create`, `data_vencimento`, `id_entrega`, `cnpj`) VALUES
(1, 1000, NULL, NULL, NULL, '2019-03-12', '2019-03-18', 2, '111111');

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
  `cli_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `doc`
--

INSERT INTO `doc` (`id`, `data_upload`, `arquivo_path`, `entrega`, `tipo`, `descricao`, `cli_id`) VALUES
(1, '2019-03-01', '/teste/teste', 1, 'Fatura', 'Fatura de teste', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `entrega`
--

DROP TABLE IF EXISTS `entrega`;
CREATE TABLE IF NOT EXISTS `entrega` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_criacao` date DEFAULT NULL,
  `data_previsao` date DEFAULT NULL,
  `nf` varchar(100) DEFAULT NULL,
  `produto` varchar(150) DEFAULT NULL,
  `cod_rastreio` varchar(40) DEFAULT NULL,
  `cli_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `entrega`
--

INSERT INTO `entrega` (`id`, `data_criacao`, `data_previsao`, `nf`, `produto`, `cod_rastreio`, `cli_id`) VALUES
(2, '2019-03-12', '2019-03-18', '7386427634872364832BR', 'Carga Geral ', 'S9D89DS89DS89BR', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `movimentacoes`
--

DROP TABLE IF EXISTS `movimentacoes`;
CREATE TABLE IF NOT EXISTS `movimentacoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entrega_id` int(11) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `data_create` date DEFAULT NULL,
  `status` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
