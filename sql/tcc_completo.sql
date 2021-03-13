-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12-Mar-2021 às 01:17
-- Versão do servidor: 10.4.17-MariaDB
-- versão do PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `tcc`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`id`, `status`, `nome`) VALUES
(1, 1, 'Sólidos');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `local_trabalho` varchar(200) DEFAULT NULL,
  `telefone_trabalho` varchar(45) DEFAULT NULL,
  `nome_completo` varchar(200) NOT NULL,
  `data_nascimento` date NOT NULL,
  `cpf` varchar(45) NOT NULL,
  `email` varchar(100) NOT NULL,
  `sexo` tinyint(1) NOT NULL,
  `telefone_residencial` varchar(45) DEFAULT NULL,
  `telefone_celular` varchar(45) NOT NULL,
  `rua` varchar(255) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `cep` varchar(45) NOT NULL,
  `numero` int(11) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id`, `local_trabalho`, `telefone_trabalho`, `nome_completo`, `data_nascimento`, `cpf`, `email`, `sexo`, `telefone_residencial`, `telefone_celular`, `rua`, `bairro`, `cep`, `numero`, `cidade`, `uf`, `status`) VALUES
(1, 'Depósito Brasil', '36397282', 'Flavio Fedechen Aguiar', '2002-01-12', '10628065906', 'flavio@gmail.com', 2, '4436398933', '44984594973', 'Rua Treze de Maio', 'Jardim Colibri', '87506340', 1829, 'Umuarama', 'PR', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `itensvenda`
--

CREATE TABLE `itensvenda` (
  `Venda_id` int(11) NOT NULL,
  `Produto_id` int(11) NOT NULL,
  `quantidadeVendida` int(11) NOT NULL,
  `valorTotal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `marca`
--

CREATE TABLE `marca` (
  `id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `nome` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `marca`
--

INSERT INTO `marca` (`id`, `status`, `nome`) VALUES
(1, 1, 'Votorantim');

-- --------------------------------------------------------

--
-- Estrutura da tabela `medida`
--

CREATE TABLE `medida` (
  `id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `nome` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `medida`
--

INSERT INTO `medida` (`id`, `status`, `nome`) VALUES
(1, 1, 'Kilograma');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `valor_venda` double NOT NULL,
  `codigo` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `Categoria_id` int(11) NOT NULL,
  `Marca_id` int(11) NOT NULL,
  `Medida_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id`, `status`, `nome`, `valor_venda`, `codigo`, `quantidade`, `Categoria_id`, `Marca_id`, `Medida_id`) VALUES
(1, 1, 'Cimento', 30, 321, 10, 1, 1, 1),
(2, 1, 'Tinta ', 2.25, 4321, 10, 1, 1, 1),
(3, 1, 'Parafuso', 2.25, 10987, 20, 1, 1, 1),
(4, 1, 'Joelho ', 10.5, 9874, 30, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `nome_completo` varchar(200) NOT NULL,
  `data_nascimento` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `sexo` tinyint(1) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `data_admissao` date NOT NULL,
  `data_demissao` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `status`, `nome_completo`, `data_nascimento`, `email`, `sexo`, `senha`, `data_admissao`, `data_demissao`) VALUES
(1, 1, 'Carolina Aguera', '2002-01-12', 'carolaguerabr@gmail.com', 2, '$2y$10$G7iD6gDX8IEmMfuJbzvy6e5u0SbvGHlcq2yuKpStUI35V8CKTG93u', '2021-02-26', '0000-00-00'),
(2, 1, 'Cleiton Santos', '2022-01-12', 'cleitonsantos591@gmail.com', 2, '$2y$10$HtYzf6ciOEUcJ1p6Jvei7.6v4I3S4TosfZyPI5EFZcOlY315.htEK', '2002-01-26', '0000-00-00'),
(3, 1, 'Flavio Fedechen Aguiar', '1999-10-30', 'flavio@gmail.com', 1, '$2y$10$L8P5KcMzkRTy1QAjX.wIquUvGed1KwJERUkJnldzz6uOzoW389W76', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `venda`
--

CREATE TABLE `venda` (
  `id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  ` data_hora` datetime NOT NULL,
  `valorTotal` double NOT NULL,
  `desconto` double DEFAULT NULL,
  `valorRecebido` double NOT NULL,
  `Usuario_id` int(11) NOT NULL,
  `Cliente_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `itensvenda`
--
ALTER TABLE `itensvenda`
  ADD PRIMARY KEY (`Venda_id`,`Produto_id`),
  ADD KEY `fk_Venda_has_Produto_Produto1_idx` (`Produto_id`),
  ADD KEY `fk_Venda_has_Produto_Venda1_idx` (`Venda_id`);

--
-- Índices para tabela `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `medida`
--
ALTER TABLE `medida`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Produto_Categoria1_idx` (`Categoria_id`),
  ADD KEY `fk_Produto_Marca1_idx` (`Marca_id`),
  ADD KEY `fk_Produto_Medida1_idx` (`Medida_id`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `venda`
--
ALTER TABLE `venda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ControleDeVendas_CLIENTE1_idx` (`Cliente_id`),
  ADD KEY `fk_Venda_Usuario1_idx` (`Usuario_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `marca`
--
ALTER TABLE `marca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `medida`
--
ALTER TABLE `medida`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `venda`
--
ALTER TABLE `venda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
