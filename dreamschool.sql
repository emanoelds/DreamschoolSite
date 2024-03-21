-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 13-Jun-2023 às 21:24
-- Versão do servidor: 10.4.14-MariaDB
-- versão do PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `dreamschool`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `login_alunos`
--

CREATE TABLE `login_alunos` (
  `id` int(11) NOT NULL,
  `nome_aluno` varchar(100) NOT NULL,
  `usuario_aluno` varchar(100) NOT NULL,
  `aniver_aluno` date NOT NULL,
  `email_aluno` varchar(100) NOT NULL,
  `senha_aluno` decimal(4,0) DEFAULT NULL,
  `img_aluno` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_admin`
--

CREATE TABLE `user_admin` (
  `id_admin` int(11) NOT NULL,
  `usuario_admin` varchar(100) NOT NULL,
  `senha_admin` varchar(100) NOT NULL,
  `email_admin` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `user_admin`
--

INSERT INTO `user_admin` (`id_admin`, `usuario_admin`, `senha_admin`, `email_admin`) VALUES
(2, 'DS-ProfDS', '51ca6a097b552288d5ee599fd63bfea4af61d46a', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_alunos`
--

CREATE TABLE `user_alunos` (
  `id_aluno` int(11) NOT NULL,
  `id` decimal(6,0) NOT NULL,
  `nome_aluno` varchar(100) NOT NULL,
  `pontuacao_aluno` decimal(4,0) DEFAULT NULL,
  `img_aluno` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `login_alunos`
--
ALTER TABLE `login_alunos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `user_admin`
--
ALTER TABLE `user_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Índices para tabela `user_alunos`
--
ALTER TABLE `user_alunos`
  ADD PRIMARY KEY (`id_aluno`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `user_admin`
--
ALTER TABLE `user_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `user_alunos`
--
ALTER TABLE `user_alunos`
  MODIFY `id_aluno` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
