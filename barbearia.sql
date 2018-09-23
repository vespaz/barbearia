-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 23-Set-2018 às 19:13
-- Versão do servidor: 5.6.13
-- versão do PHP: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `barbearia`
--
CREATE DATABASE IF NOT EXISTS `barbearia` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `barbearia`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE IF NOT EXISTS `produto` (
  `id_produto` int(11) NOT NULL AUTO_INCREMENT,
  `nome_produto` varchar(100) NOT NULL,
  `preco` double NOT NULL,
  `varejo` varchar(100) NOT NULL,
  `qtdMin` varchar(100) NOT NULL,
  `desconto` varchar(100) NOT NULL,
  PRIMARY KEY (`id_produto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id_produto`, `nome_produto`, `preco`, `varejo`, `qtdMin`, `desconto`) VALUES
(3, 'Gel', 9.99, 'sim', '10', '0'),
(4, 'Pomada', 8.75, 'sim', '0', '0');

-- --------------------------------------------------------

--
-- Estrutura da tabela `servico`
--

CREATE TABLE IF NOT EXISTS `servico` (
  `id_barbearia` int(11) NOT NULL AUTO_INCREMENT,
  `nome_servico` varchar(100) NOT NULL,
  `preco` double NOT NULL,
  `brinde` varchar(100) NOT NULL,
  PRIMARY KEY (`id_barbearia`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Extraindo dados da tabela `servico`
--

INSERT INTO `servico` (`id_barbearia`, `nome_servico`, `preco`, `brinde`) VALUES
(5, 'Barba', 25, ''),
(6, 'Cabelo', 40, ''),
(7, 'Corte', 10, 'leite'),
(8, 'Barba', 15, 'Vale Sorvete');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
