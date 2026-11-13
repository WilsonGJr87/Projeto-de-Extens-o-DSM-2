-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09/11/2026 às 20:41
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `premium_imoveis`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `nm_cliente` varchar(60) NOT NULL,
  `cd_cpf_cnpj_cliente` varchar(18) NOT NULL,
  `nm_email_cliente` varchar(60) NOT NULL,
  `cd_senha_cliente` varchar(255) NOT NULL,
  `cd_telefone_cliente` varchar(20) DEFAULT NULL,
  `dt_cadastro_cliente` date DEFAULT NULL,
  `nm_tipo_cliente` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `imagem`
--

CREATE TABLE `imagem` (
  `id_imagem` int(11) NOT NULL,
  `id_imovel` int(11) DEFAULT NULL,
  `caminho` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `imovel`
--

CREATE TABLE `imovel` (
  `id_imovel` int(11) NOT NULL,
  `id_proprietario` int(11) DEFAULT NULL,
  `nm_tipo_imovel` varchar(50) DEFAULT NULL,
  `qt_area_total_imovel` decimal(10,0) DEFAULT NULL,
  `qt_area_construida_imovel` decimal(10,0) DEFAULT NULL,
  `qt_quarto_imovel` int(11) DEFAULT NULL,
  `qt_banheiro_imovel` int(11) DEFAULT NULL,
  `qt_vaga_imovel` int(11) DEFAULT NULL,
  `nm_condicao_imovel` varchar(30) DEFAULT NULL,
  `nm_logradouro` varchar(60) DEFAULT NULL,
  `cd_numero_imovel` varchar(30) DEFAULT NULL,
  `nm_bairro_imovel` varchar(30) DEFAULT NULL,
  `nm_cidade_imovel` varchar(30) DEFAULT NULL,
  `cd_cep_imovel` int(11) DEFAULT NULL,
  `dt_construcao_imovel` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `proprietario`
--

CREATE TABLE `proprietario` (
  `id_proprietario` int(11) NOT NULL,
  `nm_proprietario` varchar(60) NOT NULL,
  `cd_cpf_cnpj_proprietario` varchar(18) NOT NULL,
  `nm_email_proprietario` varchar(60) NOT NULL,
  `cd_telefone_proprietario` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Índices de tabela `imagem`
--
ALTER TABLE `imagem`
  ADD PRIMARY KEY (`id_imagem`),
  ADD KEY `fk_id_movel` (`id_imovel`);

--
-- Índices de tabela `imovel`
--
ALTER TABLE `imovel`
  ADD PRIMARY KEY (`id_imovel`),
  ADD KEY `fk_imovel_proprietario` (`id_proprietario`);

--
-- Índices de tabela `proprietario`
--
ALTER TABLE `proprietario`
  ADD PRIMARY KEY (`id_proprietario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `imagem`
--
ALTER TABLE `imagem`
  ADD CONSTRAINT `fk_id_movel` FOREIGN KEY (`id_imovel`) REFERENCES `imovel` (`id_imovel`);

--
-- Restrições para tabelas `imovel`
--
ALTER TABLE `imovel`
  ADD CONSTRAINT `fk_imovel_proprietario` FOREIGN KEY (`id_proprietario`) REFERENCES `proprietario` (`id_proprietario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
