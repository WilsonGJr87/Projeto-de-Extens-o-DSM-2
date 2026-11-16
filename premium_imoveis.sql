-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 16/11/2026 às 15:41
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

--
-- Despejando dados para a tabela `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nm_cliente`, `cd_cpf_cnpj_cliente`, `nm_email_cliente`, `cd_senha_cliente`, `cd_telefone_cliente`, `dt_cadastro_cliente`, `nm_tipo_cliente`) VALUES
(1, 'Gabriel Oliveira', '123.456.789-00', 'gabriel@email.com', 'gabriel123', '(13) 99123-4567', '2026-11-16', 'Pessoa Física'),
(2, 'Mariana Santos', '987.654.321-00', 'mariana@email.com', 'mariana123', '(13) 99876-5432', '2026-11-16', 'Pessoa Física'),
(3, 'Lucas Henrique Ferreira', '45678912309', 'lucas.ferreira@email.com', 'lucas123', '13992846173', NULL, 'Cliente');

-- --------------------------------------------------------

--
-- Estrutura para tabela `imagem`
--

CREATE TABLE `imagem` (
  `id_imagem` int(11) NOT NULL,
  `id_imovel` int(11) DEFAULT NULL,
  `caminho` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `imagem`
--

INSERT INTO `imagem` (`id_imagem`, `id_imovel`, `caminho`) VALUES
(1, 1, 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=1000'),
(2, 2, 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=1000'),
(3, 3, 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=1000'),
(4, 4, 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=1000'),
(5, 5, 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=1000'),
(6, 6, 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=1000'),
(7, 7, 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=1000'),
(8, 8, 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=1000'),
(9, 9, 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=1000'),
(10, 10, 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=1000'),
(11, 11, 'https://images.unsplash.com/photo-1600566753086-00f18fb6b3ea?w=1000'),
(12, 12, 'https://images.unsplash.com/photo-1600566753086-00f18fb6b3ea?w=1000'),
(13, 13, 'https://images.unsplash.com/photo-1600566753086-00f18fb6b3ea?w=1000'),
(14, 14, 'https://images.unsplash.com/photo-1600566753086-00f18fb6b3ea?w=1000'),
(15, 15, 'https://images.unsplash.com/photo-1600566753086-00f18fb6b3ea?w=1000'),
(16, 16, 'https://images.unsplash.com/photo-1600047509807-ba8f99d2cdde?w=1000'),
(17, 17, 'https://images.unsplash.com/photo-1600047509807-ba8f99d2cdde?w=1000'),
(18, 18, 'https://images.unsplash.com/photo-1600047509807-ba8f99d2cdde?w=1000'),
(19, 19, 'https://images.unsplash.com/photo-1600047509807-ba8f99d2cdde?w=1000'),
(20, 20, 'https://images.unsplash.com/photo-1600047509807-ba8f99d2cdde?w=1000'),
(21, 21, 'https://images.unsplash.com/photo-1600585154526-990dced4db0d?w=1000'),
(22, 22, 'https://images.unsplash.com/photo-1600585154526-990dced4db0d?w=1000'),
(23, 23, 'https://images.unsplash.com/photo-1600585154526-990dced4db0d?w=1000'),
(24, 24, 'https://images.unsplash.com/photo-1600585154526-990dced4db0d?w=1000'),
(25, 25, 'https://images.unsplash.com/photo-1600585154526-990dced4db0d?w=1000'),
(26, 26, 'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?w=1000'),
(27, 27, 'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?w=1000'),
(28, 28, 'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?w=1000'),
(29, 29, 'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?w=1000'),
(30, 30, 'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?w=1000');

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
  `vl_preco` decimal(10,2) DEFAULT NULL,
  `nm_rua` varchar(100) DEFAULT NULL,
  `sg_estado` varchar(10) DEFAULT NULL,
  `ds_imovel` varchar(500) DEFAULT NULL,
  `nm_finalidade_imovel` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `imovel`
--

INSERT INTO `imovel` (`id_imovel`, `id_proprietario`, `nm_tipo_imovel`, `qt_area_total_imovel`, `qt_area_construida_imovel`, `qt_quarto_imovel`, `qt_banheiro_imovel`, `qt_vaga_imovel`, `nm_condicao_imovel`, `nm_logradouro`, `cd_numero_imovel`, `nm_bairro_imovel`, `nm_cidade_imovel`, `cd_cep_imovel`, `dt_construcao_imovel`, `vl_preco`, `nm_rua`, `sg_estado`, `ds_imovel`, `nm_finalidade_imovel`) VALUES
(1, 1, 'Casa', 250, 180, 3, 2, 2, 'Novo', 'Rua das Palmeiras', '125', 'Boqueirão', 'Praia Grande', 11700000, '2020-05-12', 650000.00, 'Rua das Palmeiras', 'SP', 'Imóvel aconchegante localizado em uma região tranquila, próximo a comércios e serviços. Possui ambientes bem distribuídos, boa iluminação natural e espaço adequado para uma família pequena. Uma ótima opção para quem busca praticidade e conforto.', 'comprar'),
(2, 1, 'Apartamento', 95, 85, 2, 2, 1, 'Usado', 'Avenida Brasil', '450', 'Guilhermina', 'Praia Grande', 11701300, '2015-08-20', 420000.00, 'Avenida Brasil', 'SP', 'Apartamento bem localizado, próximo à praia e com fácil acesso a mercados, restaurantes e transporte público. Conta com ambientes espaçosos, boa ventilação e uma planta funcional, sendo uma excelente opção para moradia ou investimento.', 'alugar'),
(3, 2, 'Sobrado', 300, 220, 4, 3, 2, 'Reformado', 'Rua dos Lírios', '78', 'Canto do Forte', 'Praia Grande', 11700100, '2010-03-15', 780000.00, 'Rua dos Lírios', 'SP', 'Casa confortável em bairro residencial, com ambientes bem aproveitados e boa iluminação. A propriedade oferece espaço suficiente para acomodar uma família, além de estar próxima a estabelecimentos comerciais e vias de acesso.', 'comprar'),
(4, 2, 'Apartamento', 75, 68, 2, 1, 1, 'Novo', 'Rua Bahia', '320', 'Aviação', 'Praia Grande', 11702000, '2023-01-10', 390000.00, 'Rua Bahia', 'SP', 'Imóvel moderno e funcional, situado em uma região valorizada. Possui cômodos bem distribuídos, área interna confortável e fácil acesso aos principais serviços do bairro. Ideal para quem procura praticidade no dia a dia.', 'alugar'),
(5, 3, 'Terreno', 400, 0, 0, 0, 0, 'Novo', 'Rua das Acácias', 'S/N', 'Tupi', 'Praia Grande', 11703200, NULL, 280000.00, 'Rua das Acácias', 'SP', 'Casa localizada em área residencial tranquila, com espaços amplos e boa circulação entre os ambientes. A propriedade apresenta uma estrutura confortável e fica próxima a mercados, escolas e outros serviços essenciais.', 'comprar'),
(6, 3, 'Casa', 180, 120, 3, 2, 1, 'Usado', 'Rua São Paulo', '215', 'Ocian', 'Praia Grande', 11704200, '2008-06-22', 450000.00, 'Rua São Paulo', 'SP', 'Apartamento compacto e confortável, ideal para quem busca praticidade. Possui ambientes bem distribuídos e está localizado próximo a comércios, serviços e opções de lazer. Uma boa alternativa para moradia ou investimento.', 'alugar'),
(7, 4, 'Apartamento', 110, 95, 3, 2, 2, 'Reformado', 'Avenida Presidente Kennedy', '1500', 'Guilhermina', 'Praia Grande', 11702000, '2018-11-05', 590000.00, 'Avenida Presidente Kennedy', 'SP', 'Imóvel espaçoso em localização estratégica, próximo a importantes vias de acesso e diversos estabelecimentos comerciais. Conta com uma planta funcional e ambientes confortáveis, atendendo bem às necessidades de uma família.', 'comprar'),
(8, 4, 'Casa', 220, 160, 3, 2, 2, 'Usado', 'Rua das Flores', '90', 'Mirim', 'Praia Grande', 11705000, '2012-09-18', 520000.00, 'Rua das Flores', 'SP', 'Casa agradável em região residencial, com boa distribuição dos cômodos e espaço suficiente para momentos em família. Localizada próxima a comércios e serviços, oferece praticidade e tranquilidade para os moradores.', 'alugar'),
(9, 5, 'Chácara', 1500, 250, 4, 3, 4, 'Usado', 'Estrada do Campo', '1200', 'Área Rural', 'Itanhaém', 11740000, '2005-04-30', 950000.00, 'Estrada do Campo', 'SP', 'Propriedade localizada em uma região mais tranquila, ideal para quem busca contato com a natureza e maior privacidade. Possui amplo espaço e estrutura adequada para diferentes possibilidades de uso, proporcionando conforto e tranquilidade.', 'comprar'),
(10, 5, 'Apartamento', 60, 55, 1, 1, 1, 'Novo', 'Rua Pernambuco', '340', 'Boqueirão', 'Praia Grande', 11701000, '2024-02-14', 350000.00, 'Rua Pernambuco', 'SP', 'Apartamento confortável localizado em região com ampla variedade de comércio e serviços. Possui ambientes funcionais, boa iluminação e uma localização conveniente para quem deseja praticidade e facilidade de acesso.', 'alugar'),
(11, 6, 'Casa', 350, 240, 4, 3, 3, 'Reformado', 'Rua das Orquídeas', '500', 'Canto do Forte', 'Praia Grande', 11700150, '2016-07-19', 980000.00, 'Rua das Orquídeas', 'SP', 'Imóvel localizado em uma área residencial valorizada, com ambientes confortáveis e bem distribuídos. A proximidade com a praia, comércio e serviços torna a propriedade uma excelente opção para morar ou investir.', 'comprar'),
(12, 6, 'Terreno', 250, 0, 0, 0, 0, 'Novo', 'Rua Minas Gerais', 'S/N', 'Aviação', 'Praia Grande', 11702000, NULL, 220000.00, 'Rua Minas Gerais', 'SP', 'Apartamento funcional em região tranquila e de fácil acesso. Possui ambientes bem aproveitados e está próximo a estabelecimentos comerciais e opções de lazer. Uma alternativa interessante para quem procura praticidade e conforto.', 'alugar'),
(13, 7, 'Apartamento', 85, 75, 2, 2, 1, 'Usado', 'Avenida Paris', '720', 'Boqueirão', 'Praia Grande', 11701000, '2014-12-03', 480000.00, 'Avenida Paris', 'SP', 'Imóvel bem localizado, próximo a comércios, restaurantes e serviços. Conta com espaços confortáveis e uma distribuição interna funcional. Sua localização facilita o acesso a diferentes pontos da cidade e proporciona praticidade aos moradores.', 'comprar'),
(14, 7, 'Sobrado', 200, 175, 3, 3, 2, 'Novo', 'Rua dos Pinheiros', '155', 'Solemar', 'Praia Grande', 11709000, '2022-10-25', 690000.00, 'Rua dos Pinheiros', 'SP', 'Casa localizada em uma região tranquila, com boa área disponível e ambientes confortáveis. Ideal para famílias que desejam mais espaço e privacidade, sem abrir mão da proximidade com serviços e vias de acesso.', 'alugar'),
(15, 8, 'Casa', 160, 110, 2, 1, 1, 'Usado', 'Rua João Pessoa', '88', 'Tupi', 'Praia Grande', 11703000, '2000-05-17', 370000.00, 'Rua João Pessoa', 'SP', 'Apartamento aconchegante em bairro residencial, com ambientes funcionais e boa iluminação. Está próximo a comércios e serviços essenciais, oferecendo uma rotina prática e confortável para seus moradores.', 'comprar'),
(16, 8, 'Apartamento', 130, 115, 3, 2, 2, 'Reformado', 'Avenida Costa e Silva', '900', 'Boqueirão', 'Praia Grande', 11701000, '2019-08-12', 720000.00, 'Avenida Costa e Silva', 'SP', 'Imóvel amplo e bem localizado, próximo a diferentes opções de comércio, serviços e lazer. Apresenta ambientes bem distribuídos e uma estrutura confortável, sendo uma boa escolha para famílias que precisam de espaço.', 'alugar'),
(17, 9, 'Terreno', 500, 0, 0, 0, 0, 'Novo', 'Rua das Palmeiras', 'S/N', 'Mirim', 'Praia Grande', 11705000, NULL, 350000.00, 'Rua das Palmeiras', 'SP', 'Casa confortável situada em uma região residencial, oferecendo espaço para convivência e uma distribuição funcional dos ambientes. A localização proporciona tranquilidade e acesso conveniente a comércios e serviços próximos.', 'comprar'),
(18, 9, 'Casa', 280, 190, 3, 2, 2, 'Usado', 'Rua Argentina', '430', 'Guilhermina', 'Praia Grande', 11702000, '2011-01-30', 680000.00, 'Rua Argentina', 'SP', 'Apartamento localizado em área residencial com boa infraestrutura. Possui ambientes confortáveis e funcionais, além de estar próximo a mercados, restaurantes e outros serviços. Uma boa opção para quem valoriza praticidade.', 'alugar'),
(19, 10, 'Apartamento', 70, 62, 2, 1, 1, 'Novo', 'Rua México', '250', 'Aviação', 'Praia Grande', 11702000, '2021-06-15', 410000.00, 'Rua México', 'SP', 'Imóvel com localização privilegiada, próximo à praia e a diversos estabelecimentos comerciais. Possui ambientes bem distribuídos e uma estrutura confortável, sendo indicado tanto para moradia quanto para investimento.', 'comprar'),
(20, 10, 'Sobrado', 240, 200, 4, 3, 2, 'Reformado', 'Rua das Violetas', '610', 'Canto do Forte', 'Praia Grande', 11700100, '2017-09-22', 850000.00, 'Rua das Violetas', 'SP', 'Casa espaçosa em região residencial tranquila, com ambientes confortáveis e boa área para convivência. A propriedade está próxima a serviços e vias de acesso, combinando praticidade com um ambiente agradável.', 'alugar'),
(21, 11, 'Casa', 190, 130, 3, 2, 2, 'Usado', 'Rua Bahia', '75', 'Ocian', 'Praia Grande', 11704000, '2009-04-11', 490000.00, 'Rua Bahia', 'SP', 'Apartamento funcional em uma das regiões mais movimentadas do bairro, próximo a comércio, serviços e opções de lazer. Conta com ambientes bem aproveitados e localização conveniente para diferentes necessidades.', 'comprar'),
(22, 11, 'Apartamento', 100, 90, 3, 2, 1, 'Novo', 'Avenida São Paulo', '1200', 'Boqueirão', 'Praia Grande', 11701000, '2023-07-08', 560000.00, 'Avenida São Paulo', 'SP', 'Imóvel confortável e bem localizado, com fácil acesso a comércios, restaurantes e serviços. A propriedade possui uma planta funcional e ambientes agradáveis, sendo uma opção interessante para residência ou investimento.', 'alugar'),
(23, 12, 'Chácara', 2000, 300, 5, 4, 5, 'Reformado', 'Estrada dos Pescadores', '800', 'Área Rural', 'Mongaguá', 11730000, '2007-02-19', 1200000.00, 'Estrada dos Pescadores', 'SP', 'Propriedade situada em uma área mais tranquila, com bastante espaço e contato com um ambiente natural. Ideal para quem procura maior privacidade e tranquilidade, podendo atender diferentes projetos e necessidades.', 'comprar'),
(24, 12, 'Apartamento', 55, 48, 1, 1, 1, 'Usado', 'Rua Pernambuco', '180', 'Guilhermina', 'Praia Grande', 11701000, '2013-11-27', 320000.00, 'Rua Pernambuco', 'SP', 'Apartamento aconchegante em região residencial, próximo a comércios e serviços essenciais. Possui ambientes bem distribuídos e uma localização prática, sendo adequado para quem busca conforto sem abrir mão da conveniência.', 'alugar'),
(25, 13, 'Casa', 320, 210, 4, 3, 2, 'Novo', 'Rua das Hortênsias', '350', 'Canto do Forte', 'Praia Grande', 11700100, '2022-04-05', 1050000.00, 'Rua das Hortênsias', 'SP', 'Casa confortável localizada em bairro residencial, com ambientes bem distribuídos e espaço adequado para uma família. A região oferece acesso fácil a comércio, serviços e opções de lazer, proporcionando uma rotina prática.', 'comprar'),
(26, 13, 'Terreno', 600, 0, 0, 0, 0, 'Novo', 'Rua São Jorge', 'S/N', 'Solemar', 'Praia Grande', 11709000, NULL, 420000.00, 'Rua São Jorge', 'SP', 'Imóvel localizado em uma área tranquila, com boa distribuição dos ambientes e espaço confortável. A propriedade oferece uma combinação de praticidade e sossego, sendo uma alternativa interessante para moradia ou investimento.', 'alugar'),
(27, 14, 'Apartamento', 90, 82, 2, 2, 1, 'Reformado', 'Avenida Presidente Kennedy', '2100', 'Aviação', 'Praia Grande', 11702000, '2016-12-14', 530000.00, 'Avenida Presidente Kennedy', 'SP', 'Apartamento bem localizado, próximo a vias importantes e diversos estabelecimentos comerciais. Possui ambientes funcionais e confortáveis, oferecendo praticidade para quem deseja morar próximo a serviços e opções de lazer.', 'comprar'),
(28, 14, 'Casa', 210, 150, 3, 2, 2, 'Usado', 'Rua dos Jasmins', '145', 'Tupi', 'Praia Grande', 11703000, '2006-08-09', 460000.00, 'Rua dos Jasmins', 'SP', 'Casa agradável em região residencial, com ambientes confortáveis e boa distribuição interna. Localizada próxima a comércios e serviços, oferece uma combinação equilibrada entre tranquilidade, espaço e praticidade.', 'alugar'),
(29, 15, 'Sobrado', 270, 230, 4, 3, 3, 'Novo', 'Rua das Gaivotas', '700', 'Boqueirão', 'Praia Grande', 11701000, '2024-01-20', 890000.00, 'Rua das Gaivotas', 'SP', 'Imóvel confortável em região com boa infraestrutura, próximo a comércio, serviços e opções de lazer. Possui ambientes bem aproveitados e uma localização conveniente, sendo uma boa escolha para residência ou investimento.', 'comprar'),
(30, 15, 'Apartamento', 65, 58, 2, 1, 1, 'Usado', 'Rua Campinas', '95', 'Ocian', 'Praia Grande', 11704000, '2012-05-16', 340000.00, 'Rua Campinas', 'SP', 'Apartamento compacto e funcional, localizado próximo a comércios e serviços do bairro. Conta com ambientes bem distribuídos e uma localização prática, sendo indicado para quem procura uma opção confortável e de fácil manutenção.', 'alugar');

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
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
