-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 15/11/2026 às 04:00
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
  `cd_cpf_cnpj_cliente` varchar(18) UNIQUE NOT NULL,
  `nm_email_cliente` varchar(60) UNIQUE NOT NULL,
  `cd_senha_cliente` varchar(255) NOT NULL,
  `cd_telefone_cliente` varchar(20) DEFAULT NULL,
  `dt_cadastro_cliente` DATETIME DEFAULT CURRENT_TIMESTAMP,
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
  `dt_construcao_imovel` date DEFAULT NULL,
  `vl_preco` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `imovel`
--

INSERT INTO `imovel` (`id_imovel`, `id_proprietario`, `nm_tipo_imovel`, `qt_area_total_imovel`, `qt_area_construida_imovel`, `qt_quarto_imovel`, `qt_banheiro_imovel`, `qt_vaga_imovel`, `nm_condicao_imovel`, `nm_logradouro`, `cd_numero_imovel`, `nm_bairro_imovel`, `nm_cidade_imovel`, `cd_cep_imovel`, `dt_construcao_imovel`, `vl_preco`) VALUES
(1, 1, 'Casa', 250, 180, 3, 2, 2, 'Novo', 'Rua das Palmeiras', '125', 'Boqueirão', 'Praia Grande', 11700000, '2020-05-12', 650000.00),
(2, 1, 'Apartamento', 95, 85, 2, 2, 1, 'Usado', 'Avenida Brasil', '450', 'Guilhermina', 'Praia Grande', 11701300, '2015-08-20', 420000.00),
(3, 2, 'Sobrado', 300, 220, 4, 3, 2, 'Reformado', 'Rua dos Lírios', '78', 'Canto do Forte', 'Praia Grande', 11700100, '2010-03-15', 780000.00),
(4, 2, 'Apartamento', 75, 68, 2, 1, 1, 'Novo', 'Rua Bahia', '320', 'Aviação', 'Praia Grande', 11702000, '2023-01-10', 390000.00),
(5, 3, 'Terreno', 400, 0, 0, 0, 0, 'Novo', 'Rua das Acácias', 'S/N', 'Tupi', 'Praia Grande', 11703200, NULL, 280000.00),
(6, 3, 'Casa', 180, 120, 3, 2, 1, 'Usado', 'Rua São Paulo', '215', 'Ocian', 'Praia Grande', 11704200, '2008-06-22', 450000.00),
(7, 4, 'Apartamento', 110, 95, 3, 2, 2, 'Reformado', 'Avenida Presidente Kennedy', '1500', 'Guilhermina', 'Praia Grande', 11702000, '2018-11-05', 590000.00),
(8, 4, 'Casa', 220, 160, 3, 2, 2, 'Usado', 'Rua das Flores', '90', 'Mirim', 'Praia Grande', 11705000, '2012-09-18', 520000.00),
(9, 5, 'Chácara', 1500, 250, 4, 3, 4, 'Usado', 'Estrada do Campo', '1200', 'Área Rural', 'Itanhaém', 11740000, '2005-04-30', 950000.00),
(10, 5, 'Apartamento', 60, 55, 1, 1, 1, 'Novo', 'Rua Pernambuco', '340', 'Boqueirão', 'Praia Grande', 11701000, '2024-02-14', 350000.00),
(11, 6, 'Casa', 350, 240, 4, 3, 3, 'Reformado', 'Rua das Orquídeas', '500', 'Canto do Forte', 'Praia Grande', 11700150, '2016-07-19', 980000.00),
(12, 6, 'Terreno', 250, 0, 0, 0, 0, 'Novo', 'Rua Minas Gerais', 'S/N', 'Aviação', 'Praia Grande', 11702000, NULL, 220000.00),
(13, 7, 'Apartamento', 85, 75, 2, 2, 1, 'Usado', 'Avenida Paris', '720', 'Boqueirão', 'Praia Grande', 11701000, '2014-12-03', 480000.00),
(14, 7, 'Sobrado', 200, 175, 3, 3, 2, 'Novo', 'Rua dos Pinheiros', '155', 'Solemar', 'Praia Grande', 11709000, '2022-10-25', 690000.00),
(15, 8, 'Casa', 160, 110, 2, 1, 1, 'Usado', 'Rua João Pessoa', '88', 'Tupi', 'Praia Grande', 11703000, '2000-05-17', 370000.00),
(16, 8, 'Apartamento', 130, 115, 3, 2, 2, 'Reformado', 'Avenida Costa e Silva', '900', 'Boqueirão', 'Praia Grande', 11701000, '2019-08-12', 720000.00),
(17, 9, 'Terreno', 500, 0, 0, 0, 0, 'Novo', 'Rua das Palmeiras', 'S/N', 'Mirim', 'Praia Grande', 11705000, NULL, 350000.00),
(18, 9, 'Casa', 280, 190, 3, 2, 2, 'Usado', 'Rua Argentina', '430', 'Guilhermina', 'Praia Grande', 11702000, '2011-01-30', 680000.00),
(19, 10, 'Apartamento', 70, 62, 2, 1, 1, 'Novo', 'Rua México', '250', 'Aviação', 'Praia Grande', 11702000, '2021-06-15', 410000.00),
(20, 10, 'Sobrado', 240, 200, 4, 3, 2, 'Reformado', 'Rua das Violetas', '610', 'Canto do Forte', 'Praia Grande', 11700100, '2017-09-22', 850000.00),
(21, 11, 'Casa', 190, 130, 3, 2, 2, 'Usado', 'Rua Bahia', '75', 'Ocian', 'Praia Grande', 11704000, '2009-04-11', 490000.00),
(22, 11, 'Apartamento', 100, 90, 3, 2, 1, 'Novo', 'Avenida São Paulo', '1200', 'Boqueirão', 'Praia Grande', 11701000, '2023-07-08', 560000.00),
(23, 12, 'Chácara', 2000, 300, 5, 4, 5, 'Reformado', 'Estrada dos Pescadores', '800', 'Área Rural', 'Mongaguá', 11730000, '2007-02-19', 1200000.00),
(24, 12, 'Apartamento', 55, 48, 1, 1, 1, 'Usado', 'Rua Pernambuco', '180', 'Guilhermina', 'Praia Grande', 11701000, '2013-11-27', 320000.00),
(25, 13, 'Casa', 320, 210, 4, 3, 2, 'Novo', 'Rua das Hortênsias', '350', 'Canto do Forte', 'Praia Grande', 11700100, '2022-04-05', 1050000.00),
(26, 13, 'Terreno', 600, 0, 0, 0, 0, 'Novo', 'Rua São Jorge', 'S/N', 'Solemar', 'Praia Grande', 11709000, NULL, 420000.00),
(27, 14, 'Apartamento', 90, 82, 2, 2, 1, 'Reformado', 'Avenida Presidente Kennedy', '2100', 'Aviação', 'Praia Grande', 11702000, '2016-12-14', 530000.00),
(28, 14, 'Casa', 210, 150, 3, 2, 2, 'Usado', 'Rua dos Jasmins', '145', 'Tupi', 'Praia Grande', 11703000, '2006-08-09', 460000.00),
(29, 15, 'Sobrado', 270, 230, 4, 3, 3, 'Novo', 'Rua das Gaivotas', '700', 'Boqueirão', 'Praia Grande', 11701000, '2024-01-20', 890000.00),
(30, 15, 'Apartamento', 65, 58, 2, 1, 1, 'Usado', 'Rua Campinas', '95', 'Ocian', 'Praia Grande', 11704000, '2012-05-16', 340000.00);

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
-- Despejando dados para a tabela `proprietario`
--

INSERT INTO `proprietario` (`id_proprietario`, `nm_proprietario`, `cd_cpf_cnpj_proprietario`, `nm_email_proprietario`, `cd_telefone_proprietario`) VALUES
(1, 'Carlos Eduardo Silva', '123.456.789-01', 'carlos.silva@email.com', '(13) 98845-1234'),
(2, 'Mariana Oliveira Santos', '234.567.890-12', 'mariana.santos@email.com', '(13) 99712-4567'),
(3, 'Roberto Almeida Costa', '345.678.901-23', 'roberto.costa@email.com', '(11) 98123-7890'),
(4, 'Fernanda Rodrigues Lima', '456.789.012-34', 'fernanda.lima@email.com', '(13) 99654-3210'),
(5, 'João Pedro Ferreira', '567.890.123-45', 'joao.ferreira@email.com', '(11) 97531-8642'),
(6, 'Ana Carolina Martins', '678.901.234-56', 'ana.martins@email.com', '(13) 98456-7891'),
(7, 'Ricardo Mendes Souza', '789.012.345-67', 'ricardo.souza@email.com', '(12) 99123-4567'),
(8, 'Patrícia Gomes Ribeiro', '890.123.456-78', 'patricia.ribeiro@email.com', '(13) 98765-4321'),
(9, 'Lucas Henrique Barbosa', '901.234.567-89', 'lucas.barbosa@email.com', '(11) 97654-3210'),
(10, 'Camila Fernandes Rocha', '012.345.678-90', 'camila.rocha@email.com', '(13) 99321-6547'),
(11, 'André Luiz Carvalho', '111.222.333-44', 'andre.carvalho@email.com', '(12) 98234-5678'),
(12, 'Juliana Castro Mendes', '222.333.444-55', 'juliana.mendes@email.com', '(13) 98567-1234'),
(13, 'Marcelo Vieira Lopes', '333.444.555-66', 'marcelo.lopes@email.com', '(11) 99456-7890'),
(14, 'Beatriz Nascimento Alves', '444.555.666-77', 'beatriz.alves@email.com', '(13) 99234-5678'),
(15, 'Gustavo Pereira Ramos', '555.666.777-88', 'gustavo.ramos@email.com', '(12) 99789-1234');

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
