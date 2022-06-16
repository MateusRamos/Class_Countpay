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
  `quantidade_parcelas` varchar(30) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=16920 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lancamento`
--

LOCK TABLES `lancamento` WRITE;
/*!40000 ALTER TABLE `lancamento` DISABLE KEYS */;
INSERT INTO `lancamento` VALUES (16906,'Teste','Receita',123.00,'2022-06-15',143,21,NULL,5,NULL,NULL,0),(16907,'fasdfasd','Receita',1200.00,'2022-06-16',143,21,NULL,5,NULL,NULL,0),(16908,'Teste','Receita',123.00,'2022-07-15',143,21,NULL,5,NULL,NULL,1),(16909,'Teste','Receita',123.00,'2022-07-15',143,21,NULL,5,NULL,NULL,1),(16910,'Teste','Receita',123.00,'2022-07-15',143,21,NULL,5,NULL,NULL,1),(16911,'asdad','Receita',1000.00,'2022-06-15',143,21,NULL,5,NULL,NULL,0),(16912,'asdasda','Receita',1640.00,'2022-06-15',143,21,NULL,5,NULL,NULL,0),(16913,'Teste','Receita',123.00,'2022-07-15',143,21,NULL,5,NULL,NULL,1),(16914,'Teste','Receita',123.00,'2022-07-15',143,21,NULL,5,NULL,NULL,1),(16915,'Teste','Receita',123.00,'2022-07-15',143,21,NULL,5,NULL,NULL,1),(16916,'Teste','Receita',123.00,'2022-07-15',143,21,NULL,5,NULL,NULL,1),(16917,'Teste','Despesa',123.00,'2022-07-15',143,21,NULL,5,NULL,NULL,1),(16918,'Teste','Despesa',123.00,'2022-07-15',143,21,NULL,5,NULL,NULL,1),(16919,'Teste','Receita',123.00,'2022-07-15',143,21,NULL,5,NULL,NULL,1);
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

-- Dump completed on 2022-06-15 23:02:16
