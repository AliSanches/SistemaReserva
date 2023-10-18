-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 18-Ago-2023 às 22:11
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `projeto`
--
CREATE DATABASE IF NOT EXISTS `projeto` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `projeto`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso`
--

DROP TABLE IF EXISTS `curso`;
CREATE TABLE `curso` (
  `id_curso` int(11) NOT NULL,
  `status` bit(1) NOT NULL,
  `nome_curso` varchar(60) NOT NULL,
  `data_cadastro` date NOT NULL,
  `id_tipo_curso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `curso`
--

INSERT INTO `curso` (`id_curso`, `status`, `nome_curso`, `data_cadastro`, `id_tipo_curso`) VALUES
(10, b'0', 'Técnico de Informatica', '2023-08-16', 5),
(13, b'0', 'Técnico em Moda Nuclear', '2023-08-17', 6),
(14, b'0', 'Técnico de Aviação Nuclear', '2023-08-17', 3),
(15, b'1', 'Técnico de Rede Nuclear', '2023-08-17', 7),
(16, b'1', 'Teatro Nuclear', '2023-08-17', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `reserva`
--

DROP TABLE IF EXISTS `reserva`;
CREATE TABLE `reserva` (
  `id_reserva` int(11) NOT NULL,
  `hora_cadastro` time NOT NULL,
  `data_cadastro` date NOT NULL,
  `data_inicio` date NOT NULL,
  `data_termino` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_termino` time NOT NULL,
  `status` bit(1) NOT NULL,
  `id_turma` int(11) DEFAULT NULL,
  `id_sala` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `sala`
--

DROP TABLE IF EXISTS `sala`;
CREATE TABLE `sala` (
  `id_sala` int(11) NOT NULL,
  `status` bit(1) NOT NULL,
  `num_sala` int(11) NOT NULL,
  `capacidade` int(11) NOT NULL,
  `armario` enum('sim','nao') NOT NULL,
  `comport_notebook` enum('sim','nao') DEFAULT NULL,
  `data_cadastro` date NOT NULL,
  `hora_cadastro` time NOT NULL,
  `id_tipo_sala` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `sala`
--

INSERT INTO `sala` (`id_sala`, `status`, `num_sala`, `capacidade`, `armario`, `comport_notebook`, `data_cadastro`, `hora_cadastro`, `id_tipo_sala`) VALUES
(4, b'1', 20, 21, 'nao', 'sim', '2023-08-16', '07:16:45', 3),
(6, b'1', 78, 21, 'sim', 'sim', '2023-08-16', '03:21:14', 5),
(7, b'1', 78, 12, 'sim', 'sim', '2023-08-18', '01:38:53', 4),
(8, b'1', 78, 38, 'nao', 'sim', '2023-08-18', '01:57:21', 6),
(9, b'1', 78, 100, 'nao', 'sim', '2023-08-18', '03:27:14', 3),
(10, b'1', 13, 100, 'sim', 'sim', '2023-08-18', '03:30:54', 8),
(11, b'1', 20, 12, 'sim', 'sim', '2023-08-18', '03:40:37', 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_curso`
--

DROP TABLE IF EXISTS `tipo_curso`;
CREATE TABLE `tipo_curso` (
  `id_tipo_curso` int(11) NOT NULL,
  `value` varchar(60) NOT NULL,
  `nome_tipo` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `tipo_curso`
--

INSERT INTO `tipo_curso` (`id_tipo_curso`, `value`, `nome_tipo`) VALUES
(1, 'livre', 'Livre'),
(2, 'tecnico', 'Técnico'),
(3, 'emed', 'EMED'),
(4, 'idiomas', 'Idiomas'),
(5, 'graducao', 'Graduação'),
(6, 'posgrad', 'Pós-Graduação'),
(7, 'ead', 'EAD');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_sala`
--

DROP TABLE IF EXISTS `tipo_sala`;
CREATE TABLE `tipo_sala` (
  `id_tipo_sala` int(11) NOT NULL,
  `value` varchar(52) NOT NULL,
  `nome_sala` varchar(73) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `tipo_sala`
--

INSERT INTO `tipo_sala` (`id_tipo_sala`, `value`, `nome_sala`) VALUES
(1, 'sala convencional', 'Sala Convencional'),
(2, 'longarinas', 'Longarinas'),
(3, 'emed', 'EMED'),
(4, 'lab bem estar estetica', 'Laboratório de Bem Estar e Estética'),
(5, 'lab bem estar massoterapia', 'Laboratório de Bem Estar e Massoterapia'),
(6, 'lab visagismo beleza moda', 'Laboratório de Visagismo Beleza e Moda'),
(7, 'lab enfermagem farmacia', 'Laboratório de Enfermagem e Farmacia'),
(8, 'lab hardware', 'Laboratório de Hardware'),
(9, 'lab informatica', 'Laboratório de Informatica'),
(10, 'lab multf moda', 'Laboratório Multifuncional Moda'),
(11, 'experimental', 'Experimental'),
(12, 'laboratorio multif design', 'Laboratório Multifuncional de Design'),
(13, 'estudio radio', 'Estudio de Radio'),
(14, 'estudio video', 'Estudio de Video');

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma`
--

DROP TABLE IF EXISTS `turma`;
CREATE TABLE `turma` (
  `id_turma` int(11) NOT NULL,
  `status` bit(1) NOT NULL,
  `nome_turma` varchar(100) DEFAULT NULL,
  `horario_inicio` time DEFAULT NULL,
  `horario_termino` time NOT NULL,
  `ano` year(4) NOT NULL,
  `codigo_Oferta` int(11) NOT NULL,
  `id_curso` int(11) DEFAULT NULL,
  `data_inicio` date NOT NULL,
  `data_termino` date NOT NULL,
  `data_cadastro` date NOT NULL,
  `segunda` bit(1) NOT NULL,
  `terca` bit(1) NOT NULL,
  `quarta` bit(1) NOT NULL,
  `quinta` bit(1) NOT NULL,
  `sexta` bit(1) NOT NULL,
  `sabado` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `turma`
--

INSERT INTO `turma` (`id_turma`, `status`, `nome_turma`, `horario_inicio`, `horario_termino`, `ano`, `codigo_Oferta`, `id_curso`, `data_inicio`, `data_termino`, `data_cadastro`, `segunda`, `terca`, `quarta`, `quinta`, `sexta`, `sabado`) VALUES
(1, b'1', 'Turma 44', '13:30:00', '17:30:00', 2023, 123121, 10, '2023-08-08', '2023-08-17', '2023-08-16', b'1', b'1', b'1', b'1', b'1', b'0'),
(2, b'1', 'Turma', '17:06:00', '00:00:00', 2023, 111111, NULL, '2023-08-17', '2023-08-18', '2023-08-17', b'0', b'0', b'0', b'0', b'0', b'0'),
(9, b'1', 'Turma23', '13:30:00', '17:30:00', 2023, 43123, 10, '2023-08-08', '2023-08-09', '2023-08-17', b'0', b'0', b'0', b'0', b'0', b'0'),
(13, b'1', 'Veterinaria', '17:06:00', '19:06:00', 2023, 101, NULL, '2023-08-19', '2023-08-26', '2023-08-18', b'0', b'0', b'0', b'0', b'0', b'0'),
(14, b'1', 'Veterinaria', '16:10:00', '19:10:00', 2023, 123121, 16, '2023-08-10', '2023-08-31', '2023-08-18', b'0', b'0', b'0', b'0', b'0', b'0'),
(15, b'1', 'Veterinaria', '16:15:00', '19:15:00', 2023, 123121, 15, '2023-08-16', '2023-08-25', '2023-08-18', b'1', b'1', b'0', b'0', b'0', b'0'),
(16, b'1', 'Mecanico Nuclear', '15:38:00', '18:41:00', 2023, 123121, 13, '2023-08-16', '2023-08-19', '2023-08-18', b'1', b'0', b'0', b'0', b'0', b'0'),
(17, b'1', 'Veterinaria', '16:40:00', '14:45:00', 2023, 111111, 14, '2023-08-19', '2023-08-20', '2023-08-18', b'1', b'0', b'0', b'0', b'0', b'0'),
(18, b'1', 'Astronauta Nuclear 24', '14:43:00', '19:41:00', 2023, 123121, 15, '2023-08-19', '2023-08-24', '2023-08-18', b'1', b'0', b'0', b'0', b'0', b'0');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `status` bit(1) NOT NULL,
  `nome` char(40) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `senha` varchar(20) NOT NULL,
  `tipo` enum('adm','com') DEFAULT NULL,
  `data_cadastro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id_curso`),
  ADD KEY `id_tipo_curso` (`id_tipo_curso`);

--
-- Índices para tabela `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `id_turma` (`id_turma`),
  ADD KEY `id_sala` (`id_sala`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices para tabela `sala`
--
ALTER TABLE `sala`
  ADD PRIMARY KEY (`id_sala`),
  ADD KEY `id_tipo_sala` (`id_tipo_sala`);

--
-- Índices para tabela `tipo_curso`
--
ALTER TABLE `tipo_curso`
  ADD PRIMARY KEY (`id_tipo_curso`);

--
-- Índices para tabela `tipo_sala`
--
ALTER TABLE `tipo_sala`
  ADD PRIMARY KEY (`id_tipo_sala`);

--
-- Índices para tabela `turma`
--
ALTER TABLE `turma`
  ADD PRIMARY KEY (`id_turma`),
  ADD KEY `id_curso` (`id_curso`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `curso`
--
ALTER TABLE `curso`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `reserva`
--
ALTER TABLE `reserva`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `sala`
--
ALTER TABLE `sala`
  MODIFY `id_sala` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `tipo_curso`
--
ALTER TABLE `tipo_curso`
  MODIFY `id_tipo_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `tipo_sala`
--
ALTER TABLE `tipo_sala`
  MODIFY `id_tipo_sala` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `turma`
--
ALTER TABLE `turma`
  MODIFY `id_turma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `curso_ibfk_1` FOREIGN KEY (`id_tipo_curso`) REFERENCES `tipo_curso` (`id_tipo_curso`);

--
-- Limitadores para a tabela `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `reserva_ibfk_1` FOREIGN KEY (`id_turma`) REFERENCES `turma` (`id_turma`),
  ADD CONSTRAINT `reserva_ibfk_2` FOREIGN KEY (`id_sala`) REFERENCES `sala` (`id_sala`),
  ADD CONSTRAINT `reserva_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Limitadores para a tabela `sala`
--
ALTER TABLE `sala`
  ADD CONSTRAINT `sala_ibfk_1` FOREIGN KEY (`id_tipo_sala`) REFERENCES `tipo_sala` (`id_tipo_sala`);

--
-- Limitadores para a tabela `turma`
--
ALTER TABLE `turma`
  ADD CONSTRAINT `turma_ibfk_1` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
