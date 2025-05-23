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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (3,'mariano lopes',NULL,'18',NULL,NULL,'Rua adélia david santos','158','','','Taubaté','12051-447',NULL),(4,'Ana Maria Braga',NULL,'80',NULL,NULL,'Rua do Sol','101','','Leblon','Rio de Janeiro','34567-890',NULL),(5,'João Silva',NULL,'25',NULL,NULL,'Rua das Palmeiras','45','Apto 101','Centro','São Paulo','01001-000',NULL),(6,'Maria Oliveira',NULL,'30',NULL,NULL,'Avenida Brasil','500','','Jardim América','Rio de Janeiro','20031-000',NULL),(7,'Carlos Pereira',NULL,'40',NULL,NULL,'Rua das Acácias','78','','Bela Vista','Curitiba','80010-000',NULL),(8,'Ana Costa',NULL,'35',NULL,NULL,'Rua do Comércio','120','Bloco B','Centro','Belo Horizonte','30110-000',NULL),(9,'Pedro Santos',NULL,'28',NULL,NULL,'Rua das Laranjeiras','90','','Jardim Botânico','Porto Alegre','90010-000',NULL),(10,'Fernanda Lima',NULL,'22',NULL,NULL,'Rua das Rosas','15','','Vila Mariana','São Paulo','04001-000',NULL),(11,'RICARDO',NULL,'23',NULL,NULL,'Rua eusebio marcondes','123','casa','Centro','Taubaté','SP','12'),(12,'Glauco Luiz','6b202d2a2f2efcf3ec4d0628c7891c80.jpg','123.456.798-00','glauco@senac.com.br','(13) 2 4564-8679','fdsfds','65456','casa','Vila Rezende','Taubaté','12052-150','Sã');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Glauco Luiz','glauco@senac.com.br','7110eda4d09e062aa5e4a390b0a572ac0d2c0220');
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

-- Dump completed on 2025-05-23 17:12:39
