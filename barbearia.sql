-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 27-Set-2018 às 13:42
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
-- Estrutura da tabela `brinde`
--

CREATE TABLE IF NOT EXISTS `brinde` (
  `id_brinde` int(11) NOT NULL AUTO_INCREMENT,
  `brinde` varchar(100) NOT NULL,
  PRIMARY KEY (`id_brinde`),
  KEY `id_brinde` (`id_brinde`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `brinde`
--

INSERT INTO `brinde` (`id_brinde`, `brinde`) VALUES
(1, 'CafÃ©'),
(2, 'chocolate');

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
  `descontao` varchar(100) NOT NULL,
  PRIMARY KEY (`id_produto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `servico`
--

CREATE TABLE IF NOT EXISTS `servico` (
  `id_barbearia` int(11) NOT NULL AUTO_INCREMENT,
  `nome_servico` varchar(100) NOT NULL,
  `preco` float NOT NULL,
  `cod_brinde` int(100) DEFAULT NULL,
  PRIMARY KEY (`id_barbearia`),
  KEY `brinde` (`cod_brinde`),
  KEY `brinde_2` (`cod_brinde`),
  KEY `brinde_3` (`cod_brinde`),
  KEY `brinde_4` (`cod_brinde`),
  KEY `brinde_5` (`cod_brinde`),
  KEY `cod_brinde` (`cod_brinde`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Extraindo dados da tabela `servico`
--

INSERT INTO `servico` (`id_barbearia`, `nome_servico`, `preco`, `cod_brinde`) VALUES
(7, 'Barba', 35, 1),
(9, 'Aparar alt', 66, 1);

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `servico`
--
ALTER TABLE `servico`
  ADD CONSTRAINT `servico_ibfk_1` FOREIGN KEY (`cod_brinde`) REFERENCES `brinde` (`id_brinde`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
