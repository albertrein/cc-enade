-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql109.epizy.com
-- Tempo de geração: 09/09/2021 às 17:35
-- Versão do servidor: 5.7.34-37
-- Versão do PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `epiz_29536934_ccenade_base`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `comentarios`
--

CREATE TABLE `comentarios` (
  `comentariopk` int(11) NOT NULL,
  `mensagem` varchar(255) NOT NULL,
  `data` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `usuariofk` int(11) NOT NULL,
  `questaofk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `questoes`
--

CREATE TABLE `questoes` (
  `questaopk` int(11) NOT NULL,
  `resposta` varchar(20) NOT NULL,
  `ano` int(11) DEFAULT NULL,
  `nrquestao` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `questoes`
--

INSERT INTO `questoes` (`questaopk`, `resposta`, `ano`, `nrquestao`) VALUES
(14, 'C', 2017, 10),
(15, 'E', 2017, 11),
(16, 'C', 2017, 12),
(17, 'B', 2017, 13),
(18, 'C', 2017, 14),
(19, 'D', 2017, 15),
(20, 'E', 2017, 16),
(21, 'A', 2017, 17),
(22, 'D', 2017, 18),
(23, 'E', 2017, 19),
(24, 'D', 2017, 20),
(25, 'A', 2017, 21),
(26, 'C', 2017, 22),
(27, 'A', 2017, 23),
(28, 'E', 2017, 24),
(29, 'C', 2017, 25),
(30, 'E', 2017, 26),
(31, 'B', 2017, 27),
(32, 'D', 2017, 28),
(33, 'E', 2017, 29),
(34, 'B', 2017, 30),
(35, 'E', 2017, 31),
(36, 'B', 2017, 32),
(37, 'D', 2017, 33),
(38, 'A', 2017, 34),
(39, 'E', 2017, 35),
(41, 'A', 2014, 1),
(42, 'C', 2014, 2),
(43, 'E', 2014, 3),
(44, 'B', 2014, 4),
(45, 'D', 2014, 5),
(46, 'C', 2014, 6),
(47, 'E', 2014, 7),
(48, 'D', 2014, 8),
(49, 'B', 2014, 9),
(50, 'A', 2014, 10),
(51, 'B', 2014, 11),
(52, 'D', 2014, 12),
(53, 'B', 2014, 13),
(55, 'C', 2014, 15),
(56, 'C', 2014, 16),
(57, 'A', 2014, 17),
(58, 'E', 2014, 18),
(59, 'A', 2014, 19),
(60, 'E', 2014, 20),
(61, 'B', 2014, 21),
(63, 'D', 2014, 23),
(64, 'C', 2014, 24),
(65, 'D', 2014, 25),
(66, 'C', 2014, 26),
(67, 'B', 2014, 27),
(68, 'A', 2014, 28),
(69, 'C', 2014, 29),
(70, 'A', 2014, 30),
(71, 'C', 2014, 31),
(72, 'A', 2014, 32),
(73, 'B', 2014, 33);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `usuariopk` int(11) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `isprofessor` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`comentariopk`),
  ADD KEY `fk_usuarios` (`usuariofk`),
  ADD KEY `fk_questoes` (`questaofk`);

--
-- Índices de tabela `questoes`
--
ALTER TABLE `questoes`
  ADD PRIMARY KEY (`questaopk`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuariopk`),
  ADD UNIQUE KEY `nome` (`nome`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `comentariopk` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `questoes`
--
ALTER TABLE `questoes`
  MODIFY `questaopk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usuariopk` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
