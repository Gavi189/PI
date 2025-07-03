-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2025 at 10:04 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_backend`
--

-- --------------------------------------------------------

--
-- Table structure for table `carrinho`
--

CREATE TABLE `carrinho` (
  `id_carrinho` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carrinho`
--

INSERT INTO `carrinho` (`id_carrinho`, `id_cliente`, `id_produto`, `quantidade`) VALUES
(6, 3, 8, 1),
(7, 3, 3, 1),
(8, 3, 2, 1),
(9, 3, 3, 1),
(10, 3, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `carrinhos`
--

CREATE TABLE `carrinhos` (
  `id_carrinho` int(11) NOT NULL,
  `data` date NOT NULL,
  `id_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carrinhos`
--

INSERT INTO `carrinhos` (`id_carrinho`, `data`, `id_cliente`) VALUES
(1, '2025-06-30', 3);

-- --------------------------------------------------------

--
-- Table structure for table `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nome` char(100) NOT NULL,
  `imagem` varchar(80) DEFAULT NULL,
  `cpf` char(14) DEFAULT NULL,
  `email` char(100) DEFAULT NULL,
  `whatsapp` char(16) DEFAULT NULL,
  `logradouro` char(150) NOT NULL,
  `numero` char(20) NOT NULL,
  `complemento` char(40) NOT NULL,
  `bairro` char(40) NOT NULL,
  `cidade` char(30) NOT NULL,
  `cep` char(9) NOT NULL,
  `estado` char(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nome`, `imagem`, `cpf`, `email`, `whatsapp`, `logradouro`, `numero`, `complemento`, `bairro`, `cidade`, `cep`, `estado`) VALUES
(3, 'mariano lopes', NULL, '18', NULL, NULL, 'Rua adélia david santos', '158', '', '', 'Taubaté', '12051-447', NULL),
(4, 'Ana Maria Braga', NULL, '80', NULL, NULL, 'Rua do Sol', '101', '', 'Leblon', 'Rio de Janeiro', '34567-890', NULL),
(5, 'João Silva', NULL, '25', NULL, NULL, 'Rua das Palmeiras', '45', 'Apto 101', 'Centro', 'São Paulo', '01001-000', NULL),
(6, 'Maria Oliveira', NULL, '30', NULL, NULL, 'Avenida Brasil', '500', '', 'Jardim América', 'Rio de Janeiro', '20031-000', NULL),
(7, 'Carlos Pereira', NULL, '40', NULL, NULL, 'Rua das Acácias', '78', '', 'Bela Vista', 'Curitiba', '80010-000', NULL),
(9, 'Pedro Santos', NULL, '28', NULL, NULL, 'Rua das Laranjeiras', '90', '', 'Jardim Botânico', 'Porto Alegre', '90010-000', NULL),
(10, 'Fernanda Lima', NULL, '22', NULL, NULL, 'Rua das Rosas', '15', '', 'Vila Mariana', 'São Paulo', '04001-000', NULL),
(11, 'RICARDO', NULL, '23', NULL, NULL, 'Rua eusebio marcondes', '123', 'casa', 'Centro', 'Taubaté', 'SP', '12'),
(13, 'Glauco Luiz', 'aaafd1124176cab5756d33e6ba2a1a49.webp', '123.456.789-10', 'glauco@senac.com.br', '(12) 3 4567-8900', 'Avenida Doutor José Getúlio Monteiro', '432432', 'casa', 'Vila Rezende', 'Taubaté', '12052-150', 'SP');

-- --------------------------------------------------------

--
-- Table structure for table `fornecedores`
--

CREATE TABLE `fornecedores` (
  `id_fornecedor` int(11) NOT NULL,
  `razao_social` char(100) DEFAULT NULL,
  `cnpj` char(18) DEFAULT NULL,
  `telefone` char(14) DEFAULT NULL,
  `email` char(100) DEFAULT NULL,
  `logradouro` char(150) DEFAULT NULL,
  `numero` char(20) DEFAULT NULL,
  `complemento` char(40) DEFAULT NULL,
  `bairro` char(40) DEFAULT NULL,
  `cidade` char(30) DEFAULT NULL,
  `cep` char(9) DEFAULT NULL,
  `estado` char(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fornecedores`
--

INSERT INTO `fornecedores` (`id_fornecedor`, `razao_social`, `cnpj`, `telefone`, `email`, `logradouro`, `numero`, `complemento`, `bairro`, `cidade`, `cep`, `estado`) VALUES
(1, 'Senac Taubaté', '12.345.678/0009-10', '(12) 1111-1111', 'contato@senac.com.br', 'Rua Nelson Freire Campello', '202', '', 'Centro', 'Taubaté', '12010-700', 'SP'),
(2, 'Tia do Lanche', '12.345.678/9000-10', '(12) 2222-2222', 'contato@tiadolanche.com.br', 'Rua das Calandrinas', '123456', 'Casa', 'Parque das Flores', 'Taubaté', '12050-700', 'SP');

-- --------------------------------------------------------

--
-- Table structure for table `marcas`
--

CREATE TABLE `marcas` (
  `id_marca` int(11) NOT NULL,
  `marca` char(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `marcas`
--

INSERT INTO `marcas` (`id_marca`, `marca`) VALUES
(1, 'Samsung'),
(2, 'Sony'),
(3, 'LG'),
(4, 'Apple'),
(5, 'Panasonic'),
(6, 'Philips'),
(7, 'Toshiba'),
(8, 'Sharp'),
(9, 'Intel'),
(10, 'AMD'),
(11, 'Nvidia'),
(12, 'Asus'),
(13, 'Acer'),
(14, 'Dell'),
(15, 'HP'),
(16, 'Lenovo'),
(17, 'Microsoft'),
(18, 'Xiaomi'),
(19, 'Huawei'),
(20, 'Motorola');

-- --------------------------------------------------------

--
-- Table structure for table `produtos`
--

CREATE TABLE `produtos` (
  `id_produto` int(11) NOT NULL,
  `produto` char(100) NOT NULL,
  `descricao` text DEFAULT NULL,
  `id_marca` int(11) NOT NULL,
  `imagem` char(80) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `preco` decimal(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produtos`
--

INSERT INTO `produtos` (`id_produto`, `produto`, `descricao`, `id_marca`, `imagem`, `quantidade`, `preco`) VALUES
(1, 'Smartphone Galaxy S24+', 'Top de linha da Samsung', 1, 'b44e03e1b3fc904577f0f8d84e324670.jpg', 10, 3000.00),
(2, 'Moto Edge 60 Pro', 'Celular da motorola', 20, '080aba92b9137ac1c47c8a329c7c4462.webp', 50, 3500.00),
(3, 'iPhone 16 Pro Max', 'Celular top da Apple', 4, 'a7ce450536f8bf5bf5c025f78458d950.jpg', 10, 10000.00),
(4, 'Produto', NULL, 4, NULL, NULL, NULL),
(5, 'iPhone 16 Pro Max', NULL, 3, NULL, NULL, NULL),
(6, 'iPhone 16 Pro Max', NULL, 3, NULL, NULL, NULL),
(7, 'iPhone 16 Pro Max', NULL, 5, NULL, NULL, NULL),
(8, 'Google Pixel', 'Mais Caro da Google', 17, '6c337e8f15a5862d2af14c40d97fba9a.jpg', 2, 10000.00);

-- --------------------------------------------------------

--
-- Table structure for table `rl_carrinho_produto`
--

CREATE TABLE `rl_carrinho_produto` (
  `id_rl` int(11) NOT NULL,
  `id_carrinho` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `qtde` int(11) NOT NULL,
  `valor` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rl_carrinho_produto`
--

INSERT INTO `rl_carrinho_produto` (`id_rl`, `id_carrinho`, `id_produto`, `qtde`, `valor`) VALUES
(1, 1, 1, 2, 5000.00),
(2, 1, 2, 1, 2000.00);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nome` char(100) NOT NULL,
  `email` char(100) NOT NULL,
  `senha` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nome`, `email`, `senha`) VALUES
(1, 'Glauco Luiz', 'glauco@senac.com.br', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),
(3, 'Gabriel', 'gavi@email.com', '8a2fbfe46f7e62f3a31d175d7c995bd89fc5c6bc'),
(6, 'Glauco Santos', 'gs@email.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carrinho`
--
ALTER TABLE `carrinho`
  ADD PRIMARY KEY (`id_carrinho`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_produto` (`id_produto`);

--
-- Indexes for table `carrinhos`
--
ALTER TABLE `carrinhos`
  ADD PRIMARY KEY (`id_carrinho`);

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indexes for table `fornecedores`
--
ALTER TABLE `fornecedores`
  ADD PRIMARY KEY (`id_fornecedor`);

--
-- Indexes for table `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id_produto`),
  ADD KEY `id_marca` (`id_marca`);

--
-- Indexes for table `rl_carrinho_produto`
--
ALTER TABLE `rl_carrinho_produto`
  ADD PRIMARY KEY (`id_rl`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carrinho`
--
ALTER TABLE `carrinho`
  MODIFY `id_carrinho` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `carrinhos`
--
ALTER TABLE `carrinhos`
  MODIFY `id_carrinho` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `fornecedores`
--
ALTER TABLE `fornecedores`
  MODIFY `id_fornecedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `rl_carrinho_produto`
--
ALTER TABLE `rl_carrinho_produto`
  MODIFY `id_rl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carrinho`
--
ALTER TABLE `carrinho`
  ADD CONSTRAINT `carrinho_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`),
  ADD CONSTRAINT `carrinho_ibfk_2` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id_produto`);

--
-- Constraints for table `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `produtos_ibfk_1` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id_marca`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
