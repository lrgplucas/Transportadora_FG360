-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 08-Abr-2019 às 16:08
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
  `celular` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id`, `email`, `cpf`, `cnpj`, `nome`, `senha`, `tel`, `celular`) VALUES
(1, 'globo.com', NULL, '111111', 'globo', '123', '111111', NULL),
(2, 'email@email.com', NULL, '111', 'sbt', '111', '111', '11');

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
  `tipo` varchar(150) DEFAULT NULL,
  `descricao` varchar(300) DEFAULT NULL,
  `cli_id` int(11) DEFAULT NULL,
  `vencimento` date DEFAULT NULL,
  `status` varchar(300) DEFAULT NULL,
  `valor` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `doc`
--

INSERT INTO `doc` (`id`, `data_upload`, `arquivo_path`, `tipo`, `descricao`, `cli_id`, `vencimento`, `status`, `valor`) VALUES
(6, '2019-04-08', 'docs/AyANUCT.jpg', '2Âº Via', '2Âº Via', 2, '2019-04-30', 'Pago', '8989');

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
  `tipo_carga` varchar(400) DEFAULT NULL,
  `motorista` varchar(400) DEFAULT NULL,
  `veiculo` varchar(400) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `entrega`
--

INSERT INTO `entrega` (`id`, `data_criacao`, `data_previsao`, `nf`, `produto`, `cod_rastreio`, `cli_id`, `tipo_carga`, `motorista`, `veiculo`) VALUES
(2, '2019-03-12', '2019-03-18', '7386427634872364832BR', 'Carga Geral', 'S9D89DS89DS89BR', 1, 'Direto', 'Givalnildo', 'Truck DLC-4563'),
(3, NULL, NULL, 'Pendente', '1', '1', 2, 'Carga compartilhada', NULL, NULL),
(4, NULL, NULL, 'Entregue', '1', '1', 1, 'Carga compartilhada', NULL, NULL),
(5, NULL, NULL, 'Em Transporte', '', '11', 1, 'Carga compartilhada', NULL, NULL),
(6, NULL, NULL, 'Em Transporte', '', '11', 1, 'Carga compartilhada', NULL, NULL),
(7, NULL, '2019-04-24', 'Em Transporte', '1', '11', 1, 'Carga compartilhada', NULL, NULL),
(8, NULL, '2019-04-24', 'Em Transporte', '1', '11', 1, 'Carga compartilhada', NULL, NULL),
(9, '2019-04-04', '2019-04-24', 'Em Transporte', '1', '11', 1, 'Carga compartilhada', NULL, NULL),
(10, '2019-04-04', '2019-04-24', 'Em Transporte', '1', '11', 1, 'Carga compartilhada', '1', '1'),
(11, '2019-04-04', '2019-04-24', 'Em Transporte', '1', '11', 1, 'Carga compartilhada', '1', '1'),
(12, '2019-04-04', '2019-04-25', 'Em Transporte', '1', 'Camera', 1, 'Carga compartilhada', 'Paulo', 'Truck22'),
(13, '2019-04-04', '2019-04-25', 'Em Transporte', '1', 'Camera', 1, 'Carga compartilhada', 'Paulo', 'Truck22'),
(14, '2019-04-04', '2019-04-23', 'Em Transporte', '122', 'GASTROENTRUDOR', 2, 'Carga compartilhada', 'LUCAS', '121'),
(15, '2019-04-04', '2019-04-23', 'Em Transporte', '122', 'GASTROENTRUDOR', 2, 'Carga compartilhada', 'LUCAS', '121'),
(16, '2019-04-04', '2019-04-23', 'Em Transporte', '122', 'GASTROENTRUDOR', 2, 'Carga compartilhada', 'LUCAS', '121'),
(17, '2019-04-04', '2019-04-23', 'Em Transporte', '122', 'GASTROENTRUDOR', 2, 'Carga compartilhada', 'LUCAS', '121'),
(18, '2019-04-04', '2019-04-23', 'Em Transporte', '122', 'GASTROENTRUDOR', 2, 'Carga compartilhada', 'LUCAS', '121'),
(19, '2019-04-04', '2019-04-23', 'Em Transporte', '122', 'GASTROENTRUDOR', 2, 'Carga compartilhada', 'LUCAS', '121'),
(20, '2019-04-04', '2019-04-23', 'Em Transporte', '122', 'GASTROENTRUDOR', 2, 'Carga compartilhada', 'LUCAS', '121'),
(21, '2019-04-04', '2019-04-23', 'Em Transporte', '122', 'GASTROENTRUDOR', 2, 'Carga compartilhada', 'LUCAS', '121'),
(22, '2019-04-04', '2019-04-23', 'Em Transporte', '122', 'GASTROENTRUDOR', 2, 'Carga compartilhada', 'LUCAS', '121'),
(23, '2019-04-04', '2019-04-23', 'Em Transporte', '122', 'GASTROENTRUDOR', 2, 'Carga compartilhada', 'LUCAS', '121'),
(24, '2019-04-04', '2019-04-23', 'Em Transporte', '122', 'GASTROENTRUDOR', 2, 'Carga compartilhada', 'LUCAS', '121'),
(25, '2019-04-04', '2019-04-23', 'Em Transporte', '122', 'GASTROENTRUDOR', 2, 'Carga compartilhada', 'LUCAS', '121'),
(26, '2019-04-04', '2019-04-10', 'Pendente', '1', '1', 2, 'Carga compartilhada', '1', '1'),
(27, '2019-04-04', '2019-04-10', 'Pendente', '1', '1', 2, 'Carga compartilhada', '1', '1'),
(28, '2019-04-04', '2019-04-10', 'Pendente', '1', '1', 2, 'Carga compartilhada', '1', '1'),
(29, '2019-04-04', '2019-04-11', 'Pendente', '1', '1', 1, 'Carga compartilhada', '1', '1'),
(30, '2019-04-04', '2019-04-11', 'Pendente', '1', '1', 1, 'Carga compartilhada', '1', '1'),
(31, '2019-04-04', '2019-04-11', 'Pendente', '1', '1', 1, 'Carga compartilhada', '1', '1'),
(32, '2019-04-04', '2019-04-11', 'Pendente', '1', '1', 1, 'Carga compartilhada', '1', '1'),
(33, '2019-04-04', '2019-04-11', 'Pendente', '1', '1', 1, 'Carga compartilhada', '1', '1'),
(34, '2019-04-04', '2019-04-11', 'Pendente', '1', '1', 1, 'Carga compartilhada', '1', '1'),
(35, '2019-04-04', '2019-04-11', 'Pendente', '1', '1', 1, 'Carga compartilhada', '1', '1'),
(36, '2019-04-04', '2019-04-11', 'Pendente', '1', '1', 1, 'Carga compartilhada', '1', '1'),
(37, '2019-04-04', '2019-04-11', 'Em Transporte', '1', '1', 1, 'Carga compartilhada', '1', '1'),
(38, '2019-04-04', '2019-04-11', 'Em Transporte', '1', '1', 1, 'Carga compartilhada', '1', '1'),
(39, '2019-04-04', '2019-04-11', 'Em Transporte', '1', '1', 1, 'Carga compartilhada', '1', '1'),
(40, '2019-04-04', '2019-04-11', 'Em Transporte', '1', '1', 1, 'Carga compartilhada', '1', '1'),
(41, '2019-04-04', '2019-04-11', 'Em Transporte', '1', '1', 1, 'Carga compartilhada', '1', '1'),
(42, '2019-04-04', '2019-04-11', 'Em Transporte', '1', '1', 1, 'Carga compartilhada', '1', '1'),
(43, '2019-04-04', '2019-04-11', 'Em Transporte', '1', '1', 1, 'Carga compartilhada', '1', '1'),
(44, '2019-04-04', '2019-04-04', 'Pendente', '1', '1', 1, 'Carga compartilhada', '11', '1'),
(45, '2019-04-04', '2019-04-04', 'Pendente', '1', '1', 1, 'Carga compartilhada', '11', '1'),
(46, '2019-04-04', '2019-04-19', 'Em Transporte', '1', '1', 1, 'Carga compartilhada', '1', '1'),
(47, '2019-04-04', '2019-04-19', 'Em Transporte', '1', '1', 1, 'Carga compartilhada', '1', '1'),
(48, '2019-04-04', '2019-04-19', 'Em Transporte', '1', '1', 1, 'Carga compartilhada', '1', '1'),
(49, '2019-04-04', '2019-04-19', 'Em Transporte', '1', '1', 1, 'Carga compartilhada', '1', '1'),
(50, '2019-04-04', '2019-04-02', 'Pendente', '', '11', 1, 'Carga compartilhada', '1', '1'),
(51, '2019-04-04', '2019-04-02', 'Pendente', '', '', 1, 'Carga compartilhada', '1', '1'),
(52, '2019-04-04', '2019-04-04', 'Pendente', 'w', 'w', 1, 'Carga compartilhada', '11', '1'),
(53, '2019-04-04', '2019-04-04', 'Pendente', 'w', 'w', 1, 'Carga compartilhada', '11', '1'),
(54, '2019-04-04', '2019-04-04', 'Pendente', 'w', 'w', 1, 'Carga compartilhada', '11', '1'),
(55, '2019-04-04', '2019-04-04', 'Pendente', 'w', 'w', 1, 'Carga compartilhada', '11', '1'),
(56, '2019-04-04', '2019-04-04', 'Pendente', '1', '1', 1, 'Carga compartilhada', '1', '1'),
(57, '2019-04-04', '2019-04-04', 'Pendente', '1', '1', 1, 'Carga compartilhada', '1', '1'),
(58, '2019-04-04', '2019-04-04', 'Pendente', '1', '1', 1, 'Carga compartilhada', '1', '1'),
(59, '2019-04-04', '2019-04-04', 'Pendente', '1', '1', 1, 'Carga compartilhada', '', '1'),
(60, '2019-04-04', '2019-04-11', 'Em Transporte', '1', '1', 2, 'Carga compartilhada', '1', '1'),
(61, '2019-04-04', '2019-04-11', 'Em Transporte', '1', '1', 2, 'Carga compartilhada', '1', '1'),
(62, '2019-04-04', '2019-04-30', 'Em Transporte', '', '11', 1, 'Carga compartilhada', '1', '1'),
(63, '2019-04-04', '2019-04-30', 'Em Transporte', '1', '1', 1, 'Carga compartilhada', '1', '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `movimentacoes`
--

DROP TABLE IF EXISTS `movimentacoes`;
CREATE TABLE IF NOT EXISTS `movimentacoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entrega_id` int(11) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `data_criacao` date DEFAULT NULL,
  `status` varchar(500) DEFAULT NULL,
  `motorista` varchar(300) DEFAULT NULL,
  `veiculo` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `movimentacoes`
--

INSERT INTO `movimentacoes` (`id`, `entrega_id`, `data`, `data_criacao`, `status`, `motorista`, `veiculo`) VALUES
(1, 2, '2019-03-24', '2019-03-24', 'teste de entrega', NULL, NULL),
(2, 2, '2019-03-25', '2019-03-25', 'teste de entrega 2', NULL, NULL),
(3, 27, '2019-04-04', '2019-04-05', 'Em Transporte', NULL, NULL),
(4, 26, '2019-04-05', '2019-04-05', 'Pendente', '1', '1'),
(5, 26, '2019-04-05', '2019-04-05', 'Pendente', '1', '1');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
