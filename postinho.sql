-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 11-Abr-2024 às 18:09
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `postinho`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `consulta`
--

CREATE TABLE `consulta` (
  `CD_CONSULTA` int(11) NOT NULL,
  `CD_PACIENTE` int(11) NOT NULL,
  `CD_MEDICO` int(11) NOT NULL,
  `DIAGNOSTICO` varchar(120) NOT NULL,
  `DT_ATENDIMENTO` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `medico`
--

CREATE TABLE `medico` (
  `CD_MEDICO` int(11) NOT NULL,
  `NM_MEDICO` varchar(50) NOT NULL,
  `ESPECIALIDADE` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `medico`
--

INSERT INTO `medico` (`CD_MEDICO`, `NM_MEDICO`, `ESPECIALIDADE`) VALUES
(1, 'Dr. João Silva', 'Clínico Geral'),
(2, 'Dra. Maria Santos', 'Cardiologista'),
(3, 'Dr. Pedro Oliveira', 'Ortopedista'),
(4, 'Dra. Ana Costa', 'Dermatologista'),
(5, 'Dr. José Lima', 'Pediatria'),
(6, 'Dra. Carla Souza', 'Grastologista'),
(7, 'Dr. André Pereira', 'Oftalmologista'),
(8, 'Dra. Sofia Almeida', 'Neurologista'),
(9, 'Dra. Elídio Junior', 'Clínico Geral');

-- --------------------------------------------------------

--
-- Estrutura da tabela `paciente`
--

CREATE TABLE `paciente` (
  `CD_PACIENTE` int(11) NOT NULL,
  `NOME` varchar(50) NOT NULL,
  `IDADE` int(3) NOT NULL,
  `SEXO` varchar(10) NOT NULL,
  `CPF` varchar(14) NOT NULL,
  `TELEFONE` varchar(15) NOT NULL,
  `ENDERECO` varchar(120) NOT NULL,
  `PESO` float NOT NULL,
  `ALTURA` float NOT NULL,
  `TIPO_S` int(11) NOT NULL,
  `ATIVO` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_sanguineo`
--

CREATE TABLE `tipo_sanguineo` (
  `CD_TIPO_S` int(11) NOT NULL,
  `NM_TIPO_S` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tipo_sanguineo`
--

INSERT INTO `tipo_sanguineo` (`CD_TIPO_S`, `NM_TIPO_S`) VALUES
(1, 'A+'),
(2, 'A-'),
(3, 'B+'),
(4, 'B-'),
(5, 'AB+'),
(6, 'AB-'),
(7, 'O+'),
(8, 'O-');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `consulta`
--
ALTER TABLE `consulta`
  ADD PRIMARY KEY (`CD_CONSULTA`),
  ADD KEY `CD_MEDICO` (`CD_MEDICO`),
  ADD KEY `CD_PACIENTE` (`CD_PACIENTE`);

--
-- Índices para tabela `medico`
--
ALTER TABLE `medico`
  ADD PRIMARY KEY (`CD_MEDICO`);

--
-- Índices para tabela `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`CD_PACIENTE`),
  ADD KEY `TIPO_S` (`TIPO_S`) USING BTREE;

--
-- Índices para tabela `tipo_sanguineo`
--
ALTER TABLE `tipo_sanguineo`
  ADD PRIMARY KEY (`CD_TIPO_S`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `consulta`
--
ALTER TABLE `consulta`
  MODIFY `CD_CONSULTA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `medico`
--
ALTER TABLE `medico`
  MODIFY `CD_MEDICO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `paciente`
--
ALTER TABLE `paciente`
  MODIFY `CD_PACIENTE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de tabela `tipo_sanguineo`
--
ALTER TABLE `tipo_sanguineo`
  MODIFY `CD_TIPO_S` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `consulta`
--
ALTER TABLE `consulta`
  ADD CONSTRAINT `consulta_ibfk_1` FOREIGN KEY (`CD_MEDICO`) REFERENCES `medico` (`CD_MEDICO`),
  ADD CONSTRAINT `consulta_ibfk_2` FOREIGN KEY (`CD_PACIENTE`) REFERENCES `paciente` (`CD_PACIENTE`);

--
-- Limitadores para a tabela `paciente`
--
ALTER TABLE `paciente`
  ADD CONSTRAINT `paciente_ibfk_1` FOREIGN KEY (`TIPO_S`) REFERENCES `tipo_sanguineo` (`CD_TIPO_S`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
