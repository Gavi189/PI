-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: db_backend
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
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
  `estado` char(2) DEFAULT NULL,
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (3,'mariano lopes',NULL,'18',NULL,NULL,'Rua adélia david santos','158','','','Taubaté','12051-447',NULL),(4,'Ana Maria Braga',NULL,'80',NULL,NULL,'Rua do Sol','101','','Leblon','Rio de Janeiro','34567-890',NULL),(5,'João Silva',NULL,'25',NULL,NULL,'Rua das Palmeiras','45','Apto 101','Centro','São Paulo','01001-000',NULL),(6,'Maria Oliveira',NULL,'30',NULL,NULL,'Avenida Brasil','500','','Jardim América','Rio de Janeiro','20031-000',NULL),(7,'Carlos Pereira',NULL,'40',NULL,NULL,'Rua das Acácias','78','','Bela Vista','Curitiba','80010-000',NULL),(9,'Pedro Santos',NULL,'28',NULL,NULL,'Rua das Laranjeiras','90','','Jardim Botânico','Porto Alegre','90010-000',NULL),(10,'Fernanda Lima',NULL,'22',NULL,NULL,'Rua das Rosas','15','','Vila Mariana','São Paulo','04001-000',NULL),(11,'RICARDO',NULL,'23',NULL,NULL,'Rua eusebio marcondes','123','casa','Centro','Taubaté','SP','12'),(13,'Glauco Luiz','52fcd6cbec2f348c7b776c96b129688a.jpg','123.456.789-10','glauco@senac.com.br','(12) 3 4567-8900','Avenida Doutor José Getúlio Monteiro','432432','casa','Vila Rezende','Taubaté','12052-150','SP');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fornecedores`
--

DROP TABLE IF EXISTS `fornecedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fornecedores` (
  `id_fornecedor` int(11) NOT NULL AUTO_INCREMENT,
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
  `estado` char(2) DEFAULT NULL,
  PRIMARY KEY (`id_fornecedor`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fornecedores`
--

LOCK TABLES `fornecedores` WRITE;
/*!40000 ALTER TABLE `fornecedores` DISABLE KEYS */;
INSERT INTO `fornecedores` VALUES (1,'Senac Taubaté','12.345.678/0009-10','(12) 1111-1111','contato@senac.com.br','Rua Nelson Freire Campello','202','','Centro','Taubaté','12010-700','SP'),(2,'Tia do Lanche','12.345.678/9000-10','(12) 2222-2222','contato@tiadolanche.com.br','Rua das Calandrinas','123456','Casa','Parque das Flores','Taubaté','12050-700','SP');
/*!40000 ALTER TABLE `fornecedores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marcas`
--

DROP TABLE IF EXISTS `marcas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `marcas` (
  `id_marca` int(11) NOT NULL AUTO_INCREMENT,
  `marca` char(40) NOT NULL,
  PRIMARY KEY (`id_marca`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marcas`
--

LOCK TABLES `marcas` WRITE;
/*!40000 ALTER TABLE `marcas` DISABLE KEYS */;
INSERT INTO `marcas` VALUES (1,'Samsung'),(2,'Sony'),(3,'LG'),(4,'Apple'),(5,'Panasonic'),(6,'Philips'),(7,'Toshiba'),(8,'Sharp'),(9,'Intel'),(10,'AMD'),(11,'Nvidia'),(12,'Asus'),(13,'Acer'),(14,'Dell'),(15,'HP'),(16,'Lenovo'),(17,'Microsoft'),(18,'Xiaomi'),(19,'Huawei'),(20,'Motorola');
/*!40000 ALTER TABLE `marcas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produtos`
--

DROP TABLE IF EXISTS `produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produtos` (
  `id_produto` int(11) NOT NULL AUTO_INCREMENT,
  `produto` char(100) NOT NULL,
  `descricao` text DEFAULT NULL,
  `id_marca` int(11) NOT NULL,
  `imagem` char(80) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `preco` decimal(8,2) DEFAULT NULL,
  PRIMARY KEY (`id_produto`),
  KEY `id_marca` (`id_marca`),
  CONSTRAINT `produtos_ibfk_1` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id_marca`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos`
--

LOCK TABLES `produtos` WRITE;
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` VALUES (1,'Smartphone Galaxy S24+','Top de linha da Samsung',1,'b44e03e1b3fc904577f0f8d84e324670.jpg',10,3000.00);
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` char(100) NOT NULL,
  `email` char(100) NOT NULL,
  `senha` varchar(80) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

CREATE TABLE `carrinho` (
       `id_carrinho` int(11) NOT NULL AUTO_INCREMENT,
       `id_cliente` int(11) NOT NULL,
       `id_produto` int(11) NOT NULL,
       `quantidade` int(11) NOT NULL,
       PRIMARY KEY (`id_carrinho`),
       KEY `id_cliente` (`id_cliente`),
       KEY `id_produto` (`id_produto`),
       CONSTRAINT `carrinho_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`),
       CONSTRAINT `carrinho_ibfk_2` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id_produto`)
     ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Glauco Luiz','glauco@senac.com.br','7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),(3,'Gabriel','gavi@email.com','8a2fbfe46f7e62f3a31d175d7c995bd89fc5c6bc');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-06-06 17:15:27
