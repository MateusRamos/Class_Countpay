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
  `fixo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_lancamento`),
  KEY `usuario` (`id_usuario`),
  KEY `conta` (`id_conta`),
  KEY `cartao` (`id_cartao`),
  KEY `categoria` (`id_categoria`),
  CONSTRAINT `cartao` FOREIGN KEY (`id_cartao`) REFERENCES `cartao` (`id_cartao`),
  CONSTRAINT `categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`),
  CONSTRAINT `conta` FOREIGN KEY (`id_conta`) REFERENCES `conta` (`id_conta`),
  CONSTRAINT `usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=16899 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lancamento`
--

LOCK TABLES `lancamento` WRITE;
/*!40000 ALTER TABLE `lancamento` DISABLE KEYS */;
INSERT INTO `lancamento` VALUES (16874,'Alexandre','Despesa Fixa',50.00,'2022-06-05',100,2,NULL,5,NULL,NULL,0),(16875,'chama1','Despesa Fixa',50.00,'2022-05-08',143,2,NULL,5,NULL,NULL,0),(16876,'chama2','Receita Fixa',50.00,'2022-06-09',143,2,NULL,5,NULL,NULL,0),(16877,'Alexandre','Receita Fixa',50.00,'2022-06-04',NULL,2,NULL,5,NULL,NULL,0),(16878,'asa','Receita',50.00,'2022-06-04',100,NULL,1,29,NULL,NULL,0),(16884,'chama1','Receita Fixa',50.00,'2022-06-10',143,2,NULL,5,NULL,NULL,0),(16886,'chama2','Despesa Fixa',50.00,'2022-06-07',143,2,NULL,5,NULL,NULL,0),(16887,'chama2','Receita Fixa',50.00,'2022-03-15',143,2,NULL,5,NULL,NULL,0),(16888,'chama2','Despesa Fixa',50.00,'2022-01-02',143,2,NULL,5,NULL,NULL,0),(16889,'Alexandre','Despesa Fixa',50.00,'2022-07-05',100,2,NULL,5,NULL,NULL,1),(16890,'Teste','Despesa Parcelada',500.00,'2022-06-14',143,21,NULL,5,'1 / 2','Quinzenalmente',NULL),(16891,'Teste','Despesa Parcelada',500.00,'2022-06-29',143,21,NULL,5,'2 / 2','Quinzenalmente',NULL),(16892,'Perdemos o controle','Receita Parcelada',500.00,'2022-06-14',143,21,NULL,5,'1 / 2','Trimestral',NULL),(16893,'Perdemos o controle','Receita Parcelada',500.00,'2022-09-14',143,21,NULL,5,'2 / 2','Trimestral',NULL),(16894,'Perdemos o controle','Receita',70.00,'2022-06-14',143,21,NULL,5,NULL,NULL,NULL),(16895,'Perdemos o controle','Receita',70.00,'2022-06-14',143,21,NULL,5,NULL,NULL,NULL),(16896,'aaaaassdawdwdwd','Receita',3001.00,'2022-06-14',143,21,NULL,5,NULL,NULL,NULL),(16897,'ehwtj','Receita',5000.00,'2022-06-14',143,21,NULL,5,NULL,NULL,NULL),(16898,'fhg','Receita',5000.00,'2022-06-14',143,22,NULL,5,NULL,NULL,NULL);
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

-- Dump completed on 2022-06-15 11:37:29
