-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 26/02/2021 às 19:47
-- Versão do servidor: 10.4.16-MariaDB
-- Versão do PHP: 7.4.12

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
-- Estrutura para tabela `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cliente`
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
  `endereco` varchar(255) NOT NULL,
  `cep` varchar(45) NOT NULL,
  `numero` int(11) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `estado` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `itens de venda`
--

CREATE TABLE `itens de venda` (
  `Venda_id` int(11) NOT NULL,
  `Produto_id` int(11) NOT NULL,
  `quantidadeVendida` int(11) NOT NULL,
  `desconto` double DEFAULT NULL,
  `valorTotal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `marca`
--

CREATE TABLE `marca` (
  `id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `nome` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `medida`
--

CREATE TABLE `medida` (
  `id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `nome` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto`
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

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
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
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id`, `status`, `nome_completo`, `data_nascimento`, `email`, `sexo`, `senha`, `data_admissao`, `data_demissao`) VALUES
(1, 1, 'Carolina Aguera', '2002-01-12', 'carolaguerabr@gmail.com', 2, '$2y$10$G7iD6gDX8IEmMfuJbzvy6e5u0SbvGHlcq2yuKpStUI35V8CKTG93u', '2021-02-26', '0000-00-00'),
(2, 1, 'Cleiton Santos', '2022-01-12', 'cleitonsantos591@gmail.com', 2, '$2y$10$HtYzf6ciOEUcJ1p6Jvei7.6v4I3S4TosfZyPI5EFZcOlY315.htEK', '2002-01-26', '0000-00-00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `venda`
--

CREATE TABLE `venda` (
  `id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  ` data_hora` datetime NOT NULL,
  `valorTotal` double NOT NULL,
  `valorRecebido` double NOT NULL,
  `saldoReceber` double NOT NULL,
  `Usuario_id` int(11) NOT NULL,
  `Cliente_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `itens de venda`
--
ALTER TABLE `itens de venda`
  ADD PRIMARY KEY (`Venda_id`,`Produto_id`),
  ADD KEY `fk_Venda_has_Produto_Produto1_idx` (`Produto_id`),
  ADD KEY `fk_Venda_has_Produto_Venda1_idx` (`Venda_id`);

--
-- Índices de tabela `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `medida`
--
ALTER TABLE `medida`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Produto_Categoria1_idx` (`Categoria_id`),
  ADD KEY `fk_Produto_Marca1_idx` (`Marca_id`),
  ADD KEY `fk_Produto_Medida1_idx` (`medida_id`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `venda`
--
ALTER TABLE `venda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ControleDeVendas_CLIENTE1_idx` (`Cliente_id`),
  ADD KEY `fk_Venda_Usuario1_idx` (`Usuario_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `marca`
--
ALTER TABLE `marca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `medida`
--
ALTER TABLE `medida`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `venda`
--
ALTER TABLE `venda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
