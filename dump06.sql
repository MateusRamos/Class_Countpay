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
-- Table structure for table `cartao`
--

DROP TABLE IF EXISTS `cartao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cartao` (
  `id_cartao` int(11) NOT NULL AUTO_INCREMENT,
  `apelido` varchar(64) NOT NULL,
  `tipo_cartao` varchar(64) NOT NULL,
  `vence_dia` int(2) DEFAULT NULL,
  `limite` decimal(8,2) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_instituicao` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_cartao`),
  KEY `cartao_ibfk_1` (`id_usuario`),
  KEY `cartao_ibfk_2` (`id_instituicao`),
  CONSTRAINT `cartao_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  CONSTRAINT `cartao_ibfk_2` FOREIGN KEY (`id_instituicao`) REFERENCES `instituicao` (`id_instituicao`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cartao`
--

LOCK TABLES `cartao` WRITE;
/*!40000 ALTER TABLE `cartao` DISABLE KEYS */;
INSERT INTO `cartao` VALUES (1,'Cartão Nubank','Cartão',5,7100.00,100,260),(2,'Cartão Inter','Cartão',5,2000.00,100,77),(3,'Cartão Santander','Cartão',5,2000.00,100,33),(4,'Cartão Caixa','Débito',5,0.00,100,104),(12,'cartao tsssss','Cartão',9,6000.00,143,NULL),(14,'asdasda','Cartão',15,1500.00,143,1);
/*!40000 ALTER TABLE `cartao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (1,'Salário'),(2,'Empréstimos'),(3,'Investimentos'),(4,'Outras Receitas'),(5,'Alimentação'),(6,'Assinatura e Serviços'),(7,'Bares'),(8,'Restaurantes'),(9,'Casa'),(10,'Compras'),(11,'Cuidados Pessoais'),(12,'Dívidas'),(13,'Empréstimos'),(14,'Educação'),(15,'Familía'),(16,'Impostos'),(17,'Taxas'),(18,'Investimentos'),(19,'Lazer e Hobbies'),(20,'Mercado'),(21,'Pets'),(22,'Presentes'),(23,'Doações'),(24,'Roupas'),(25,'Saúde'),(26,'Trabalho'),(27,'Transporte'),(28,'Viagem'),(29,'Operação Bancária'),(30,'Outras Despesas');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conta`
--

DROP TABLE IF EXISTS `conta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conta` (
  `id_conta` int(11) NOT NULL AUTO_INCREMENT,
  `apelido` varchar(64) NOT NULL,
  `tipo_conta` varchar(64) NOT NULL,
  `saldo` decimal(10,2) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_instituicao` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_conta`),
  KEY `conta_ibfk_1` (`id_usuario`),
  KEY `conta_ibfk_2` (`id_instituicao`),
  CONSTRAINT `conta_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  CONSTRAINT `conta_ibfk_2` FOREIGN KEY (`id_instituicao`) REFERENCES `instituicao` (`id_instituicao`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conta`
--

LOCK TABLES `conta` WRITE;
/*!40000 ALTER TABLE `conta` DISABLE KEYS */;
INSERT INTO `conta` VALUES (1,'Conta Nubank','Conta Digital',0.00,100,260),(2,'Conta Inter','Conta Corrente',0.00,100,77),(3,'Conta Santander','Conta Corrente',0.00,100,33),(4,'Conta Itaú','Conta Itaú',0.00,100,341),(5,'Carteira','Carteira Física',0.00,100,1000),(20,'conta 1','Conta Poupança',993.00,143,125),(21,'Conta 2','Carteira Física',5005.00,143,340),(22,'conta 3','Conta Corrente',1000.00,143,336);
/*!40000 ALTER TABLE `conta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `frequencia`
--

DROP TABLE IF EXISTS `frequencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `frequencia` (
  `id_frequencia` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) DEFAULT NULL,
  `dias` int(11) DEFAULT NULL,
  `mes` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_frequencia`)
) ENGINE=InnoDB AUTO_INCREMENT=367 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `frequencia`
--

LOCK TABLES `frequencia` WRITE;
/*!40000 ALTER TABLE `frequencia` DISABLE KEYS */;
INSERT INTO `frequencia` VALUES (1,'Semanalmente',7,NULL),(2,'Quinzenalmente',15,NULL),(3,'Mensalmente',30,1),(4,'Bimestral',60,2),(5,'Trimestral',90,3),(6,'Semestral',180,6),(7,'Anualmente',365,12);
/*!40000 ALTER TABLE `frequencia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instituicao`
--

DROP TABLE IF EXISTS `instituicao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `instituicao` (
  `id_instituicao` int(11) NOT NULL,
  `nome` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`id_instituicao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instituicao`
--

LOCK TABLES `instituicao` WRITE;
/*!40000 ALTER TABLE `instituicao` DISABLE KEYS */;
INSERT INTO `instituicao` VALUES (1,'Banco do Brasil'),(33,'Banco Santander'),(77,'Banco Inter'),(93,'Pelocred'),(104,'Caixa Econômica Federal'),(121,'Agibank'),(125,'Banco Genial'),(197,'Stone Pagamentos'),(212,'Banco Original'),(218,'BS2'),(237,'Banco Bradesco'),(260,'Nubank'),(280,'Meupag!'),(290,'Pagseguro'),(323,'Mercado Pago'),(335,'Banco Digio'),(336,'C6 Bank'),(340,'Superdigital'),(341,'Banco Itaú'),(356,'Banco Real'),(380,'PicPay'),(389,'Banco Mercantil do Brasil S.A'),(396,'Hub Pagamentos'),(399,'HSBC Bank Brasil'),(401,'Iugu'),(422,'Banco Safra'),(450,'Fitbank'),(453,'Banco Rural'),(633,'Banco Rendimento'),(652,'Itaú Unibanco Holding'),(654,'Banco Digi+'),(735,'Neon'),(745,'Banco Citibank'),(1000,'Outros');
/*!40000 ALTER TABLE `instituicao` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=981209 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lancamento`
--

LOCK TABLES `lancamento` WRITE;
/*!40000 ALTER TABLE `lancamento` DISABLE KEYS */;
INSERT INTO `lancamento` VALUES (1,'receita unica','Receita Única',15.00,'2022-07-28',143,21,NULL,5,NULL,NULL,NULL,0),(2,'asasdasda','Despesa Única',16.00,'2022-07-28',143,NULL,12,5,NULL,NULL,NULL,0),(3,'ggggg','Despesa Única',17.00,'2022-07-28',143,20,NULL,5,NULL,NULL,NULL,0),(4,'receita unica','Receita Única',25.00,'2022-05-28',143,21,NULL,5,NULL,NULL,NULL,0),(5,'asasdasda','Despesa Única',26.00,'2022-05-28',143,NULL,12,5,NULL,NULL,NULL,0),(6,'ggggg','Despesa Única',27.00,'2022-05-28',143,20,NULL,5,NULL,NULL,NULL,0),(981190,'aaaaaaaaaaaa','Receita Fixa',1000.00,'2022-06-29',143,21,NULL,5,NULL,NULL,NULL,0),(981191,'asssssssssssss','Despesa Fixa',1000.00,'2022-07-08',143,22,NULL,5,NULL,NULL,NULL,1),(981192,'hhhhhhhhhhh','Despesa Fixa',1000.00,'2022-07-09',143,NULL,12,5,NULL,NULL,NULL,1),(981193,'receita unica','Receita Única',5.00,'2022-06-28',143,21,NULL,5,NULL,NULL,NULL,0),(981194,'asasdasda','Despesa Única',6.00,'2022-06-28',143,NULL,12,5,NULL,NULL,NULL,0),(981195,'ggggg','Despesa Única',7.00,'2022-06-28',143,20,NULL,5,NULL,NULL,NULL,0),(981196,'aaaaaaaaaaaa','Receita Fixa',1000.00,'2022-07-29',143,21,NULL,5,NULL,NULL,NULL,1),(981197,'asddasda','Receita Parcelada',1000.00,'2022-06-29',143,21,NULL,5,1,6,'Bimestral',2),(981198,'asddasda','Receita Parcelada',1000.00,'2022-08-29',143,21,NULL,5,2,6,'Bimestral',2),(981199,'asddasda','Receita Parcelada',1000.00,'2022-10-29',143,21,NULL,5,3,6,'Bimestral',2),(981200,'asddasda','Receita Parcelada',1000.00,'2022-12-29',143,21,NULL,5,4,6,'Bimestral',2),(981201,'asddasda','Receita Parcelada',1000.00,'2023-02-28',143,21,NULL,5,5,6,'Bimestral',2),(981202,'asddasda','Receita Parcelada',1000.00,'2023-04-29',143,21,NULL,5,6,6,'Bimestral',2),(981203,'adasda','Despesa Parcelada',1000.00,'2022-06-29',143,22,NULL,5,1,6,'Bimestral',2),(981204,'adasda','Despesa Parcelada',1000.00,'2022-08-29',143,22,NULL,5,2,6,'Bimestral',2),(981205,'adasda','Despesa Parcelada',1000.00,'2022-10-29',143,22,NULL,5,3,6,'Bimestral',2),(981206,'adasda','Despesa Parcelada',1000.00,'2022-12-29',143,22,NULL,5,4,6,'Bimestral',2),(981207,'adasda','Despesa Parcelada',1000.00,'2023-02-28',143,22,NULL,5,5,6,'Bimestral',2),(981208,'adasda','Despesa Parcelada',1000.00,'2023-04-29',143,22,NULL,5,6,6,'Bimestral',2);
/*!40000 ALTER TABLE `lancamento` ENABLE KEYS */;
UNLOCK TABLES;

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
  `tipo_meta` varchar(56) DEFAULT NULL,
  PRIMARY KEY (`id_meta`),
  KEY `id_conta` (`id_conta`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `meta_ibfk_1` FOREIGN KEY (`id_conta`) REFERENCES `conta` (`id_conta`),
  CONSTRAINT `meta_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meta`
--

LOCK TABLES `meta` WRITE;
/*!40000 ALTER TABLE `meta` DISABLE KEYS */;
INSERT INTO `meta` VALUES (7,'Meta 1','comprar 1 carro',1000.00,NULL,'2022-06-20','2024-10-20',NULL,'concluido',21,143,'guardando'),(8,'Meta tv samsung','compra rtv',1000.00,5,'2022-06-26','2022-10-04',NULL,'ativo',22,143,'guardando'),(10,'asdasda','asdasda',1000.00,993,'2022-06-08','2022-07-02',NULL,'ativo',20,143,'guardando'),(12,'','',0.00,NULL,'0000-00-00','0000-00-00',NULL,'',NULL,NULL,'guardando');
/*!40000 ALTER TABLE `meta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notificacoes`
--

DROP TABLE IF EXISTS `notificacoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notificacoes` (
  `id_notificacoes` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(64) NOT NULL,
  `descricao` varchar(256) DEFAULT NULL,
  `id_tipo_notificacoes` int(11) NOT NULL,
  `data_emissao` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_notificacoes`),
  KEY `id_usuario` (`id_usuario`),
  KEY `notificacoes_ibfk_2` (`id_tipo_notificacoes`),
  CONSTRAINT `notificacoes_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  CONSTRAINT `notificacoes_ibfk_2` FOREIGN KEY (`id_tipo_notificacoes`) REFERENCES `tipo_notificacoes` (`id_tipo_notificacoes`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notificacoes`
--

LOCK TABLES `notificacoes` WRITE;
/*!40000 ALTER TABLE `notificacoes` DISABLE KEYS */;
INSERT INTO `notificacoes` VALUES (1,'Alerta de furto','Perdemos o controle',1,'2022-06-14 00:43:45',143),(2,'Foi pra merda','Perdemos o controle',1,'2022-06-14 00:44:47',NULL),(3,'Titu','Fudeo',1,'2022-06-14 00:45:27',NULL),(4,'rapariga','asdasdasda',1,'2022-06-21 20:20:24',143);
/*!40000 ALTER TABLE `notificacoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_notificacoes`
--

DROP TABLE IF EXISTS `tipo_notificacoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_notificacoes` (
  `id_tipo_notificacoes` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(100) NOT NULL,
  `visto` int(11) DEFAULT NULL,
  `icone` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_notificacoes`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_notificacoes`
--

LOCK TABLES `tipo_notificacoes` WRITE;
/*!40000 ALTER TABLE `tipo_notificacoes` DISABLE KEYS */;
INSERT INTO `tipo_notificacoes` VALUES (1,'Atenção',NULL,'bi bi-exclamation-circle text-warning\n');
/*!40000 ALTER TABLE `tipo_notificacoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_receita`
--

DROP TABLE IF EXISTS `tipo_receita`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_receita` (
  `id_tipo_receita` int(11) NOT NULL,
  `descricao` varchar(120) NOT NULL,
  PRIMARY KEY (`id_tipo_receita`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_receita`
--

LOCK TABLES `tipo_receita` WRITE;
/*!40000 ALTER TABLE `tipo_receita` DISABLE KEYS */;
INSERT INTO `tipo_receita` VALUES (1,'Receita'),(2,'Receita Fixa'),(3,'Receita Parcelada');
/*!40000 ALTER TABLE `tipo_receita` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_usuario`
--

DROP TABLE IF EXISTS `tipo_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_usuario` (
  `id_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_usuario`
--

LOCK TABLES `tipo_usuario` WRITE;
/*!40000 ALTER TABLE `tipo_usuario` DISABLE KEYS */;
INSERT INTO `tipo_usuario` VALUES (1,'Administrador'),(2,'Usuario');
/*!40000 ALTER TABLE `tipo_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(24) NOT NULL,
  `sobrenome` varchar(24) NOT NULL,
  `email` varchar(128) NOT NULL,
  `data_nascimento` date NOT NULL,
  `login` varchar(48) NOT NULL,
  `senha` varchar(256) NOT NULL,
  `id_tipo_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `usuario_ibfk_1` (`id_tipo_usuario`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `tipo_usuario` (`id_tipo_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=158 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (0,'  ','  ','','0000-00-00','CGsgHQrdZqEa','4G#@*z4kHRfK',2),(1,'Lucas','Heideric','lucas@countpay.com.br','2000-07-24','theheideric','123456',1),(2,'Mateus','Ramos','mateus@countpay.com.br','2001-08-25','theramos','123456',1),(3,'Raphael','Rocha','raphel@gmail.com','1993-06-06','Mateuzin','Mateuzão',2),(4,'Alexandre','Galhardo 2','alexandre@countpay.com.br','1999-05-05','xande','123456',1),(100,'Lucas','da Rocha Heideric','lucasheideric@Countpay.com.br','2000-07-24','lucas','123456',2),(143,'Alexandre','da Silva Pinto','AlexPinto@Countpay.com.br','2022-05-19','usuario','123',2);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario_perfil`
--

DROP TABLE IF EXISTS `usuario_perfil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario_perfil` (
  `id_usuario` int(11) DEFAULT NULL,
  `ocupacao` varchar(64) DEFAULT NULL,
  `pais` varchar(24) DEFAULT NULL,
  `cidade` varchar(32) DEFAULT NULL,
  `endereco` varchar(128) DEFAULT NULL,
  `telefone` varchar(16) DEFAULT NULL,
  `sobre_mim` tinytext DEFAULT NULL,
  `twitter` varchar(128) DEFAULT NULL,
  `linkedin` varchar(128) DEFAULT NULL,
  `facebook` varchar(128) DEFAULT NULL,
  `instagram` varchar(128) DEFAULT NULL,
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `usuario_perfil_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_perfil`
--

LOCK TABLES `usuario_perfil` WRITE;
/*!40000 ALTER TABLE `usuario_perfil` DISABLE KEYS */;
INSERT INTO `usuario_perfil` VALUES (143,'Faxineiro','Brasil','Pau Grande','Rua Miracemo de Moraes','(11) 91232-9093','Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus.','https://facebook.com/#','https://twitter.com/#','https://instagram.com/#','https://linkedin.com/#'),(2,'Estudante','Brasil','Cambuci','Rj194 km-0','(22) 98832-2285','SSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS','https://ead2.iff.edu.br/','https://kultivi.com/','https://www.notion.so/','https://graphviz.org/'),(NULL,'','','','','','','','','',''),(0,' ',' ',' ',' ','',' ',' ',' ',' ',' ');
/*!40000 ALTER TABLE `usuario_perfil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'countpay'
--

--
-- Dumping routines for database 'countpay'
--
/*!50003 DROP PROCEDURE IF EXISTS `sp_cartao_inserir` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_cartao_inserir`(

	papelido VARCHAR(100),
    ptipo_cartao VARCHAR(45),
    pvence_dia INT,
    plimite DECIMAL(10,2),
    pid_usuario INT,
    pid_instituicao INT

)
BEGIN

	INSERT INTO cartao (apelido, tipo_cartao, vence_dia, limite, id_usuario, id_instituicao) VALUES 
					   (papelido, ptipo_cartao, pvence_dia, plimite, pid_usuario, pid_instituicao);
                       
                       SELECT * FROM cartao WHERE id_cartao = LAST_INSERT_ID();

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_coleta_dados_fixo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_coleta_dados_fixo`(
    pid_usuario INT,
    pdata_inicial DATE,
    pdata_final DATE
)
BEGIN

    SELECT tipo_lancamento, valor, id_cartao FROM lancamento WHERE id_usuario = pid_usuario AND status_lancamento = 1 AND data_lancamento BETWEEN pdata_inicial AND pdata_final;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_coleta_dados_meses` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_coleta_dados_meses`(
    pid_usuario INT,
    pdata_inicial DATE,
    pdata_final DATE
)
BEGIN

    SELECT tipo_lancamento, valor, id_cartao FROM lancamento WHERE id_usuario = pid_usuario AND status_lancamento <> 1 AND data_lancamento BETWEEN pdata_inicial AND pdata_final;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_conta_inserir` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_conta_inserir`(

	papelido VARCHAR(100),
    ptipo_conta VARCHAR(35),
    psaldo DECIMAL(10,2),
    pid_usuario INT,
    pid_instituicao INT
    

)
BEGIN

	INSERT INTO conta (apelido, tipo_conta, saldo, id_usuario, id_instituicao) VALUES
					  (papelido, ptipo_conta, psaldo, pid_usuario, pid_instituicao);
                      
                      SELECT * FROM conta WHERE id_conta = LAST_INSERT_ID();

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_lancamento_normal` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_lancamento_normal`(
	
    pid_usuario INT,
    pdescricao_lancamento VARCHAR(100),
    pvalor DECIMAL(10,2),
    ptipo_lancamento VARCHAR(100),
    pdata_lancamento DATE,
    pid_conta INT,
    pid_cartao INT,
    pid_categoria INT,
    pstatus_lancamento INT
    
    
)
BEGIN

	INSERT INTO lancamento (id_usuario, descricao_lancamento, valor, tipo_lancamento, data_lancamento, id_conta, id_cartao, id_categoria, status_lancamento) VALUES
						   (pid_usuario, pdescricao_lancamento, pvalor, ptipo_lancamento, pdata_lancamento, pid_conta, pid_cartao, pid_categoria, pstatus_lancamento);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_lancamento_parcelado` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_lancamento_parcelado`(

	pid_usuario INT,
    ptipo_lancamento VARCHAR(100),
    pdescricao_lancamento VARCHAR(100),
    pvalor DECIMAL(10,2),
    pparcela_total int,
    pparcela_atual int,
    pdata_lancamento DATE,
    pfrequencia VARCHAR(100),
    pid_conta INT,
    pid_cartao INT,
    pid_categoria INT,
    pstatus_lancamento INT
)
BEGIN

	INSERT INTO lancamento (id_usuario, tipo_lancamento, descricao_lancamento, valor, parcela_total, parcela_atual, data_lancamento, frequencia, id_conta, id_cartao, id_categoria, status_lancamento) VALUES
						   (pid_usuario, ptipo_lancamento, pdescricao_lancamento, pvalor, pparcela_total, pparcela_atual, pdata_lancamento, pfrequencia, pid_conta, pid_cartao, pid_categoria, pstatus_lancamento);
                           
	SELECT id_lancamento FROM lancamento WHERE id_lancamento = LAST_INSERT_ID();

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_lancamento_parcelado_dias` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_lancamento_parcelado_dias`(

	pid_usuario INT,
    ptipo_lancamento VARCHAR(100),
    pdescricao_lancamento VARCHAR(100),
    pvalor DECIMAL(10,2),
    pparcela_atual INT,
    pparcela_total INT,
    pdata_lancamento DATE,
    pfrequencia VARCHAR(100),
    pid_conta INT,
    pid_cartao INT,
    pid_categoria INT,
    pstatus_lancamento INT,
    pintervalo INT

)
BEGIN

	INSERT INTO lancamento (descricao_lancamento, tipo_lancamento, valor, data_lancamento, id_usuario, id_conta, id_cartao, id_categoria, parcela_total, parcela_atual, frequencia, status_lancamento)
                         VALUES (pdescricao_lancamento, ptipo_lancamento, pvalor, pdata_lancamento, pid_usuario, pid_conta, pid_cartao, pid_categoria, pparcela_total, pparcela_atual, pfrequencia, pstatus_lancamento);
                           
	UPDATE lancamento SET data_lancamento = DATE_ADD(data_lancamento, INTERVAL pintervalo DAY) WHERE id_lancamento = LAST_INSERT_ID();

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_lancamento_parcelado_meses` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_lancamento_parcelado_meses`(

	pid_usuario INT,
    ptipo_lancamento VARCHAR(100),
    pdescricao_lancamento VARCHAR(100),
    pvalor DECIMAL(10,2),
    pparcela_atual INT,
    pparcela_total INT,
    pdata_lancamento DATE,
    pfrequencia VARCHAR(100),
    pid_conta INT,
    pid_cartao INT,
    pid_categoria INT,
    pstatus_lancamento INT,
    pintervalo INT

)
BEGIN

	INSERT INTO lancamento (descricao_lancamento, tipo_lancamento, valor, data_lancamento, id_usuario, id_conta, id_cartao, id_categoria, parcela_total, parcela_atual, frequencia, status_lancamento)
                         VALUES (pdescricao_lancamento, ptipo_lancamento, pvalor, pdata_lancamento, pid_usuario, pid_conta, pid_cartao, pid_categoria, pparcela_total, pparcela_atual, pfrequencia, pstatus_lancamento);
                           
	UPDATE lancamento SET data_lancamento = DATE_ADD(data_lancamento, INTERVAL pintervalo MONTH) WHERE id_lancamento = LAST_INSERT_ID();

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_lancamento_transferencia` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_lancamento_transferencia`(

	papelido VARCHAR(50),
    ptipo_lancamento VARCHAR(50),
    pvalor DECIMAL(10,2),
    pdata_lancamento DATE,
    pid_usuario INT,
    pid_conta INT,
    pid_categoria INT
    
    
)
BEGIN

	INSERT INTO lancamento (descricao_lancamento, tipo_lancamento, valor, data_lancamento, id_usuario, id_conta, id_categoria) VALUES
						  (papelido, ptipo_lancamento, pvalor, pdata_lancamento, pid_usuario, pid_conta, pid_categoria);

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_usuario_atualizar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_usuario_atualizar`(
pid_usuario INT,
pnome VARCHAR(100),
psobrenome VARCHAR(100),
pemail VARCHAR(200),
pdata_nascimento DATE,
plogin VARCHAR(100),
psenha VARCHAR(500)

)
BEGIN

	UPDATE usuario
    SET
    nome = pnome,
    sobrenome = psobrenome,
    email = pemail,
    data_nascimento = pdata_nascimento,
    login = plogin
    
    WHERE id_usuario = pid_usuario;
    
    SELECT * FROM usuario WHERE id_usuario = pid_usuario;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_usuario_inserir` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_usuario_inserir`(

pnome VARCHAR(100),
psobrenome VARCHAR(100),
pemail VARCHAR(200),
pdata_nascimento DATE,
plogin VARCHAR(100),
psenha VARCHAR(500),
pid_tipo_usuario INT

)
BEGIN

	INSERT INTO USUARIO (nome, sobrenome, email, data_nascimento, login, senha, id_tipo_usuario) VALUES (pnome, psobrenome, pemail, pdata_nascimento, plogin, psenha, pid_tipo_usuario);
	
    SELECT * FROM USUARIO WHERE id_usuario = LAST_INSERT_ID();
    
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-06-29 20:39:24
