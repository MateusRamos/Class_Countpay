-- MariaDB dump 10.19  Distrib 10.4.22-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: countpay
-- ------------------------------------------------------
-- Server version	10.4.22-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `lancamento`
--

DROP TABLE IF EXISTS `lancamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lancamento` (
  `id_lancamento` int(11) NOT NULL AUTO_INCREMENT,
  `descricao_lancamento` varchar(120) DEFAULT NULL,
  `tipo_lancamento` varchar(64) DEFAULT NULL,
  `valor` decimal(8,2) DEFAULT NULL,
  `data_lancamento` date DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_conta` int(11) DEFAULT NULL,
  `id_cartao` int(11) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `parcela_atual` int(11) DEFAULT NULL,
  `parcela_total` int(11) DEFAULT NULL,
  `frequencia` varchar(120) DEFAULT NULL,
  `status_lancamento` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_lancamento`),
  KEY `usuario` (`id_usuario`),
  KEY `conta` (`id_conta`),
  KEY `cartao` (`id_cartao`),
  KEY `categoria` (`id_categoria`),
  CONSTRAINT `cartao` FOREIGN KEY (`id_cartao`) REFERENCES `cartao` (`id_cartao`),
  CONSTRAINT `categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`),
  CONSTRAINT `conta` FOREIGN KEY (`id_conta`) REFERENCES `conta` (`id_conta`),
  CONSTRAINT `usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=981166 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lancamento`
--

LOCK TABLES `lancamento` WRITE;
/*!40000 ALTER TABLE `lancamento` DISABLE KEYS */;
INSERT INTO `lancamento` VALUES (1,'asdasdadaasd','Despesa Única',100.00,'2022-01-16',143,NULL,NULL,5,NULL,NULL,NULL,0),(2,'asdasdadaasd','Despesa Única',200.00,'2022-02-16',143,NULL,NULL,5,NULL,NULL,NULL,0),(3,'asdasdadaasd','Despesa Única',300.00,'2022-03-16',143,NULL,NULL,5,NULL,NULL,NULL,0),(4,'asdasdadaasd','Despesa Única',400.00,'2022-04-16',143,NULL,NULL,5,NULL,NULL,NULL,0),(5,'asdasdadaasd','Despesa Única',500.00,'2022-05-16',143,NULL,NULL,5,NULL,NULL,NULL,0),(6,'asdasdadaasd','Despesa Única',600.00,'2022-06-16',143,NULL,NULL,5,NULL,NULL,NULL,0),(7,'asdasdadaasd','Despesa Única',700.00,'2022-07-16',143,NULL,NULL,5,NULL,NULL,NULL,0),(8,'asdasdadaasd','Despesa Única',800.00,'2022-08-16',143,NULL,NULL,5,NULL,NULL,NULL,0),(9,'asdasdadaasd','Despesa Única',900.00,'2022-09-16',143,NULL,NULL,5,NULL,NULL,NULL,0),(10,'asdasdadaasd','Despesa Única',1000.00,'2022-10-16',143,NULL,NULL,5,NULL,NULL,NULL,0),(11,'asdasdadaasd','Despesa Única',1100.00,'2022-11-16',143,NULL,NULL,5,NULL,NULL,NULL,0),(12,'asdasdadaasd','Despesa Única',1200.00,'2022-12-16',143,NULL,NULL,5,NULL,NULL,NULL,0);
/*!40000 ALTER TABLE `lancamento` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-06-24 23:22:53
