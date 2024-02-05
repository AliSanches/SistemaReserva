-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 05-Fev-2024 às 14:53
-- Versão do servidor: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projeto`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso`
--

CREATE TABLE `curso` (
  `id_curso` int(11) NOT NULL,
  `status` bit(1) NOT NULL,
  `nome_curso` varchar(60) NOT NULL,
  `data_cadastro` date NOT NULL,
  `id_tipo_curso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `curso`
--

INSERT INTO `curso` (`id_curso`, `status`, `nome_curso`, `data_cadastro`, `id_tipo_curso`) VALUES
(10, b'0', 'Técnico de Informatica', '2023-08-16', 5),
(13, b'0', 'Técnico em Moda Nuclear', '2023-08-17', 6),
(16, b'1', 'Análise e Desenvolvimento de Sistemas', '2023-08-17', 7),
(17, b'0', 'Análise de Suporte', '0000-00-00', 2),
(18, b'0', 'Curso de Testes', '0000-00-00', 5),
(19, b'0', 'Mecânico ', '0000-00-00', 2),
(20, b'0', 'Testes', '0000-00-00', 2),
(21, b'0', 'Teste02', '0000-00-00', 7),
(22, b'0', 'Massoterapia', '0000-00-00', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `reserva`
--

CREATE TABLE `reserva` (
  `id_reserva` int(11) NOT NULL,
  `hora_cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_cadastro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_inicio` date NOT NULL,
  `data_termino` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_termino` time NOT NULL,
  `status` bit(1) NOT NULL,
  `id_turma` int(11) DEFAULT NULL,
  `id_sala` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `reserva`
--

INSERT INTO `reserva` (`id_reserva`, `hora_cadastro`, `data_cadastro`, `data_inicio`, `data_termino`, `hora_inicio`, `hora_termino`, `status`, `id_turma`, `id_sala`, `id_usuario`, `id_curso`) VALUES
(5, '2023-12-16 15:31:01', '2023-12-16 12:31:01', '2023-01-01', '2023-01-02', '18:00:00', '22:40:00', b'1', 20, 4, NULL, 20),
(13, '2023-12-19 23:44:44', '2023-12-19 20:44:44', '2023-12-20', '2023-12-20', '12:00:00', '17:00:00', b'0', 20, 13, NULL, 20),
(15, '2023-12-21 21:27:48', '2023-12-21 18:27:48', '2025-02-01', '2025-02-01', '08:00:00', '09:00:00', b'0', 22, 4, NULL, 22);

-- --------------------------------------------------------

--
-- Estrutura da tabela `sala`
--

CREATE TABLE `sala` (
  `id_sala` int(11) NOT NULL,
  `status` bit(1) NOT NULL,
  `num_sala` int(11) NOT NULL,
  `capacidade` int(11) NOT NULL,
  `armario` enum('sim','nao') NOT NULL,
  `comport_notebook` enum('sim','nao') DEFAULT NULL,
  `data_cadastro` date NOT NULL,
  `hora_cadastro` time NOT NULL,
  `id_tipo_sala` int(11) DEFAULT NULL,
  `id_turma` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `sala`
--

INSERT INTO `sala` (`id_sala`, `status`, `num_sala`, `capacidade`, `armario`, `comport_notebook`, `data_cadastro`, `hora_cadastro`, `id_tipo_sala`, `id_turma`) VALUES
(4, b'1', 20, 21, 'nao', 'sim', '2023-08-16', '07:16:45', 3, NULL),
(12, b'1', 500, 10, 'nao', 'nao', '2023-12-16', '12:39:55', 1, 20),
(13, b'1', 123, 10, 'nao', 'nao', '2023-12-16', '04:23:15', 1, NULL),
(15, b'1', 304, 40, 'nao', 'nao', '2023-12-21', '11:54:14', 8, NULL),
(16, b'1', 0, 0, 'nao', 'sim', '2023-12-22', '01:06:34', 1, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_curso`
--

CREATE TABLE `tipo_curso` (
  `id_tipo_curso` int(11) NOT NULL,
  `value` varchar(60) NOT NULL,
  `nome_tipo` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `tipo_sala` (
  `id_tipo_sala` int(11) NOT NULL,
  `value` varchar(52) NOT NULL,
  `nome_sala` varchar(73) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `sabado` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `turma`
--

INSERT INTO `turma` (`id_turma`, `status`, `nome_turma`, `horario_inicio`, `horario_termino`, `ano`, `codigo_Oferta`, `id_curso`, `data_inicio`, `data_termino`, `data_cadastro`, `segunda`, `terca`, `quarta`, `quinta`, `sexta`, `sabado`) VALUES
(16, b'1', 'Turma 10', '15:38:00', '18:41:00', 2023, 123121, 13, '2023-08-16', '2023-08-19', '2023-08-18', b'1', b'1', b'1', b'1', b'0', b'0'),
(17, b'1', 'Turma 1', '19:00:00', '22:30:00', 2023, 343, 18, '2023-11-01', '2023-11-30', '2023-11-04', b'1', b'1', b'1', b'1', b'1', b'0'),
(18, b'1', 'Turma 1', '18:00:00', '22:00:00', 2023, 987, 19, '2024-01-10', '2024-12-20', '2023-11-05', b'1', b'1', b'1', b'1', b'1', b'0'),
(19, b'1', 'Turma 10', '08:00:00', '12:00:00', 2023, 878, 16, '2024-01-01', '2024-12-31', '2023-11-05', b'1', b'1', b'1', b'1', b'1', b'0'),
(20, b'1', 'Turma 01', '11:11:00', '11:11:00', 2023, 1234, 20, '1111-11-11', '1111-11-11', '2023-12-16', b'1', b'1', b'1', b'1', b'1', b'0'),
(21, b'1', 'Turma01', '11:11:00', '11:11:00', 2023, 1233, 21, '1111-11-11', '1111-11-11', '2023-12-16', b'1', b'1', b'1', b'1', b'1', b'1'),
(22, b'1', 'Turma 01', '08:00:00', '09:00:00', 2023, 9878, 22, '2024-02-01', '2025-02-01', '2023-12-21', b'1', b'1', b'1', b'1', b'1', b'0');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `status` bit(1) NOT NULL,
  `nome` char(40) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `senha` varchar(20) NOT NULL,
  `tipo` enum('adm','com') DEFAULT NULL,
  `data_cadastro` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `status`, `nome`, `usuario`, `senha`, `tipo`, `data_cadastro`) VALUES
(1, b'1', 'Alisson', 'Alisson.Sanches', '1234', 'adm', '0000-00-00'),
(2, b'1', 'Juliana', 'Juliana.Matos', '4321', 'com', '0000-00-00'),
(3, b'0', 'Teste', 'Teste.Teste', '1233', 'com', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id_curso`),
  ADD KEY `id_tipo_curso` (`id_tipo_curso`);

--
-- Indexes for table `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `id_turma` (`id_turma`),
  ADD KEY `id_sala` (`id_sala`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_curso` (`id_curso`);

--
-- Indexes for table `sala`
--
ALTER TABLE `sala`
  ADD PRIMARY KEY (`id_sala`),
  ADD KEY `id_tipo_sala` (`id_tipo_sala`),
  ADD KEY `fk_sala_turma` (`id_turma`);

--
-- Indexes for table `tipo_curso`
--
ALTER TABLE `tipo_curso`
  ADD PRIMARY KEY (`id_tipo_curso`);

--
-- Indexes for table `tipo_sala`
--
ALTER TABLE `tipo_sala`
  ADD PRIMARY KEY (`id_tipo_sala`);

--
-- Indexes for table `turma`
--
ALTER TABLE `turma`
  ADD PRIMARY KEY (`id_turma`),
  ADD KEY `id_curso` (`id_curso`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `curso`
--
ALTER TABLE `curso`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `reserva`
--
ALTER TABLE `reserva`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `sala`
--
ALTER TABLE `sala`
  MODIFY `id_sala` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tipo_curso`
--
ALTER TABLE `tipo_curso`
  MODIFY `id_tipo_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tipo_sala`
--
ALTER TABLE `tipo_sala`
  MODIFY `id_tipo_sala` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `turma`
--
ALTER TABLE `turma`
  MODIFY `id_turma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
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
  ADD CONSTRAINT `reserva_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `reserva_ibfk_4` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`);

--
-- Limitadores para a tabela `sala`
--
ALTER TABLE `sala`
  ADD CONSTRAINT `fk_sala_turma` FOREIGN KEY (`id_turma`) REFERENCES `turma` (`id_turma`),
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
