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
) ENGINE=InnoDB AUTO_INCREMENT=981233 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

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

-- Dump completed on 2022-07-08 19:43:15
