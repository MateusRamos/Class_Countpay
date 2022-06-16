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
-- Table structure for table `meta`
--

DROP TABLE IF EXISTS `meta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meta` (
  `id_meta` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(256) NOT NULL,
  `objetivo` varchar(256) NOT NULL,
  `valor` decimal(11,2) NOT NULL,
  `valor_atual` int(11) DEFAULT NULL,
  `data_inicial` date NOT NULL,
  `data_final` date NOT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `status` varchar(48) NOT NULL,
  `id_conta` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_meta`),
  KEY `id_conta` (`id_conta`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `meta_ibfk_1` FOREIGN KEY (`id_conta`) REFERENCES `conta` (`id_conta`),
  CONSTRAINT `meta_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meta`
--

LOCK TABLES `meta` WRITE;
/*!40000 ALTER TABLE `meta` DISABLE KEYS */;
INSERT INTO `meta` VALUES (1,'comprar geladeira','comprar uma brasthemp',5000.00,NULL,'2022-06-10','2023-06-10',NULL,'ativo',21,143),(2,'Comprar Celular','Comprar um iphone',3000.00,500,'2022-05-14','2022-12-25',NULL,'pausado',22,143),(4,'teste','Comprar um dildo',50.00,NULL,'2022-06-14','2022-06-29',NULL,'pausado',21,143),(5,'aaaaaaa','aasaasdada',60.00,NULL,'2022-06-09','2022-06-14',NULL,'concluido',21,143),(6,'dafa','sdfasfas',100.00,NULL,'2022-04-02','2022-09-06',NULL,'pausado',22,143);
/*!40000 ALTER TABLE `meta` ENABLE KEYS */;
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
