-- MySQL dump 10.13  Distrib 5.7.20, for Win64 (x86_64)
--
-- Host: localhost    Database: pizzaria
-- ------------------------------------------------------
-- Server version	5.7.20-log

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
-- Table structure for table `tbl_avaliacao`
--

DROP TABLE IF EXISTS `tbl_avaliacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_avaliacao` (
  `idAvaliacao` int(11) NOT NULL AUTO_INCREMENT,
  `idProduto` int(11) NOT NULL,
  `avaliacao` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idAvaliacao`),
  KEY `idProduto` (`idProduto`),
  CONSTRAINT `tbl_avaliacao_ibfk_1` FOREIGN KEY (`idProduto`) REFERENCES `tbl_produto` (`idProduto`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_avaliacao`
--

LOCK TABLES `tbl_avaliacao` WRITE;
/*!40000 ALTER TABLE `tbl_avaliacao` DISABLE KEYS */;
INSERT INTO `tbl_avaliacao` VALUES (1,1,5),(2,2,5),(3,3,5),(4,4,5);
/*!40000 ALTER TABLE `tbl_avaliacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_categoria`
--

DROP TABLE IF EXISTS `tbl_categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_categoria` (
  `idCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(180) NOT NULL,
  PRIMARY KEY (`idCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_categoria`
--

LOCK TABLES `tbl_categoria` WRITE;
/*!40000 ALTER TABLE `tbl_categoria` DISABLE KEYS */;
INSERT INTO `tbl_categoria` VALUES (1,'Pizzas Salgadas'),(2,'Pizzas Doces'),(3,'Pizzas Grandes'),(4,'Pizzas Pequenas');
/*!40000 ALTER TABLE `tbl_categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_cidade`
--

DROP TABLE IF EXISTS `tbl_cidade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_cidade` (
  `idCidade` int(11) NOT NULL AUTO_INCREMENT,
  `cidade` varchar(200) NOT NULL,
  `idEstado` int(11) NOT NULL,
  PRIMARY KEY (`idCidade`),
  KEY `fk_idEstado_tbl_cidade` (`idEstado`),
  CONSTRAINT `fk_idEstado_tbl_cidade` FOREIGN KEY (`idEstado`) REFERENCES `tbl_estado` (`idEstado`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_cidade`
--

LOCK TABLES `tbl_cidade` WRITE;
/*!40000 ALTER TABLE `tbl_cidade` DISABLE KEYS */;
INSERT INTO `tbl_cidade` VALUES (3,'Brasiléia',1),(4,'Bujari',1),(5,'Capixaba',1),(6,'Cruzeiro do Sul',1),(7,'Epitaciolândia',1),(8,'Feijó',1),(9,'Jordão',1),(10,'Mancio Lima',1),(11,'Manoel Urbano',1),(12,'Marechal Thaumaturgo',1),(13,'Plácido de Castro',1),(14,'Porto Acre',1),(15,'Porto Walter',1),(16,'Rio Branco',1),(17,'Rodrigues Alves',1),(18,'Santa Rosa do Purus',1),(19,'Sena Madureira',1),(20,'Senador Guiomard',1),(21,'Tarauaca',1),(22,'Xapuri',1),(23,'Água Branca',2),(24,'Alazão',2),(25,'Alecrim',2),(26,'Anadia',2),(27,'Anel',2),(28,'Anum Novo',2),(29,'Anum Velho',2),(30,'Arapiraca',2),(31,'Atalaia',2),(32,'Baixa da Onça',2),(33,'Baixa do Capim',2),(34,'Bálsamo',2),(35,'Bananeiras',2),(36,'Barra de Santo Antônio',2),(37,'Barra de São Miguel',2),(38,'Barra do Bonifácio',2),(39,'Barra Grande',2),(40,'Batalha',2),(41,'Batingas',2),(42,'Belém',2),(43,'Belo Monte',2),(44,'Boa Sorte',2),(45,'Boa Vista',2),(46,'Boca da Mata',2),(47,'Bom Jardim',2),(48,'Bonifácio',2),(49,'Branquinha',2),(50,'Cacimbinhas',2),(51,'Cajarana',2),(52,'Cajueiro',2),(53,'Caldeirões de Cima',2),(54,'Camadanta',2),(55,'Campo Alegre',2),(56,'Campo Grande',2),(57,'Canaa',2),(58,'Canafistula',2),(59,'Canapi',2),(60,'Canastra',2),(61,'Cangandu',2),(62,'Capela',2),(63,'Carneiros',2),(64,'Carrasco',2),(65,'Chá Preta',2),(66,'Coite do Noia',2),(67,'Colônia Leopoldina',2),(68,'Coqueiro Seco',2),(69,'Coruripe',2),(70,'Coruripe da Cal',2),(71,'Craibas',2),(72,'Delmiro Gouveia',2),(73,'Dois Riachos',2),(74,'Entremontes',2),(75,'Estrela de Alagoas',2),(76,'Feira Grande',2),(77,'Feliz Deserto',2),(78,'Fernão Velho',2),(79,'Flexeiras',2),(80,'Floriano Peixoto',2),(81,'Gaspar',2),(82,'Girau do Ponciano',2),(83,'Ibateguara',2),(84,'Igaci',2),(85,'Igreja Nova',2),(86,'Inhapi',2),(87,'Jacaré dos Homens',2),(88,'Jacuipe',2),(89,'Japaratinga',2),(90,'Jaramataia',2),(91,'Jenipapo',2),(92,'Joaquim Gomes',2),(93,'Jundia',2),(94,'Junqueiro',2),(95,'Lagoa da Areia',2),(96,'Lagoa da Canoa',2),(97,'Lagoa da Pedra',2),(98,'Lagoa Dantas',2),(99,'Lagoa do Caldeirão',2),(100,'Lagoa do Canto',2);
/*!40000 ALTER TABLE `tbl_cidade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_curiosidade_decada`
--

DROP TABLE IF EXISTS `tbl_curiosidade_decada`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_curiosidade_decada` (
  `idPagina` int(11) NOT NULL AUTO_INCREMENT,
  `idItemPagina` int(11) NOT NULL,
  `titulo` varchar(240) NOT NULL,
  PRIMARY KEY (`idPagina`),
  KEY `fk_idItemPagina_tbl_curiosidade_decada` (`idItemPagina`),
  CONSTRAINT `fk_idItemPagina_tbl_curiosidade_decada` FOREIGN KEY (`idItemPagina`) REFERENCES `tbl_item_curiosidade_decada` (`idItemPagina`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_curiosidade_decada`
--

LOCK TABLES `tbl_curiosidade_decada` WRITE;
/*!40000 ALTER TABLE `tbl_curiosidade_decada` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_curiosidade_decada` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_decada`
--

DROP TABLE IF EXISTS `tbl_decada`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_decada` (
  `idDecada` int(11) NOT NULL AUTO_INCREMENT,
  `decada` varchar(2) NOT NULL,
  PRIMARY KEY (`idDecada`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_decada`
--

LOCK TABLES `tbl_decada` WRITE;
/*!40000 ALTER TABLE `tbl_decada` DISABLE KEYS */;
INSERT INTO `tbl_decada` VALUES (1,'60'),(2,'70'),(3,'80');
/*!40000 ALTER TABLE `tbl_decada` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_endereco`
--

DROP TABLE IF EXISTS `tbl_endereco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_endereco` (
  `idEndereco` int(11) NOT NULL AUTO_INCREMENT,
  `idCidade` int(11) NOT NULL,
  `cep` varchar(8) NOT NULL,
  `logradouro` varchar(250) NOT NULL,
  `numero` varchar(6) NOT NULL,
  `bairro` varchar(200) NOT NULL,
  PRIMARY KEY (`idEndereco`),
  KEY `fk_idCidade_tbl_endereco` (`idCidade`),
  CONSTRAINT `fk_idCidade_tbl_endereco` FOREIGN KEY (`idCidade`) REFERENCES `tbl_cidade` (`idCidade`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_endereco`
--

LOCK TABLES `tbl_endereco` WRITE;
/*!40000 ALTER TABLE `tbl_endereco` DISABLE KEYS */;
INSERT INTO `tbl_endereco` VALUES (3,69,'15615615','Looney Tunes','666','QUINTO DOS INFERNOS'),(4,14,'84648864','Marechal Hastinphilo Moura','73','MORUMBI'),(5,22,'15615615','Pamplona','1873','Jardins');
/*!40000 ALTER TABLE `tbl_endereco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_estabelecimento`
--

DROP TABLE IF EXISTS `tbl_estabelecimento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_estabelecimento` (
  `idPagina` int(11) NOT NULL AUTO_INCREMENT,
  `idItemPagina` int(11) NOT NULL,
  `titulo` varchar(240) NOT NULL,
  `iconeTitulo` varchar(340) DEFAULT NULL,
  PRIMARY KEY (`idPagina`),
  KEY `fk_idItemPagina_tbl_estabelecimento` (`idItemPagina`),
  CONSTRAINT `fk_idItemPagina_tbl_estabelecimento` FOREIGN KEY (`idItemPagina`) REFERENCES `tbl_item_estabelecimento` (`idItemPagina`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_estabelecimento`
--

LOCK TABLES `tbl_estabelecimento` WRITE;
/*!40000 ALTER TABLE `tbl_estabelecimento` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_estabelecimento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_estado`
--

DROP TABLE IF EXISTS `tbl_estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_estado` (
  `idEstado` int(11) NOT NULL AUTO_INCREMENT,
  `uf` varchar(2) NOT NULL,
  `estado` varchar(250) NOT NULL,
  PRIMARY KEY (`idEstado`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_estado`
--

LOCK TABLES `tbl_estado` WRITE;
/*!40000 ALTER TABLE `tbl_estado` DISABLE KEYS */;
INSERT INTO `tbl_estado` VALUES (1,'AC','Acre'),(2,'AL','Alagoas'),(3,'AP','Amapá'),(4,'AM','Amazonas'),(5,'BA','Bahia'),(6,'CE','Ceará'),(7,'DF','Distrito Federal'),(8,'ES','Espírito Santo'),(9,'GO','Goiás'),(10,'MA','Maranhão'),(11,'MT','Mato Grosso'),(12,'MS','Mato Grosso do Sul'),(13,'MG','Minas Gerais'),(14,'PA','Pará'),(15,'PB','Paraíba'),(16,'PR','Paraná'),(17,'PE','Pernambuco'),(18,'PI','Piauí'),(19,'RJ','Rio de Janeiro'),(20,'RN','Rio Grande do Norte'),(21,'RS','Rio Grande do Sul'),(22,'RO','Rondônia'),(23,'RR','Roraima'),(24,'SC','Santa Catarina'),(25,'SP','São Paulo'),(26,'SE','Sergipe'),(27,'TO','Tocantins');
/*!40000 ALTER TABLE `tbl_estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_estado_civil`
--

DROP TABLE IF EXISTS `tbl_estado_civil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_estado_civil` (
  `idEstadoCivil` int(11) NOT NULL AUTO_INCREMENT,
  `estado_civil` varchar(45) NOT NULL,
  PRIMARY KEY (`idEstadoCivil`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_estado_civil`
--

LOCK TABLES `tbl_estado_civil` WRITE;
/*!40000 ALTER TABLE `tbl_estado_civil` DISABLE KEYS */;
INSERT INTO `tbl_estado_civil` VALUES (1,'Solteiro'),(2,'Casado'),(3,'Viuvo'),(4,'Divorciado');
/*!40000 ALTER TABLE `tbl_estado_civil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_fale_conosco`
--

DROP TABLE IF EXISTS `tbl_fale_conosco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_fale_conosco` (
  `id_fale_conosco` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `celular` varchar(14) NOT NULL,
  `telefone` varchar(13) DEFAULT NULL,
  `email` varchar(80) NOT NULL,
  `profissao` varchar(80) NOT NULL,
  `home_page` varchar(100) DEFAULT NULL,
  `link_facebook` varchar(100) DEFAULT NULL,
  `infos_produto` varchar(255) DEFAULT NULL,
  `sugestao_critica` varchar(255) DEFAULT NULL,
  `sexo` char(1) NOT NULL,
  PRIMARY KEY (`id_fale_conosco`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_fale_conosco`
--

LOCK TABLES `tbl_fale_conosco` WRITE;
/*!40000 ALTER TABLE `tbl_fale_conosco` DISABLE KEYS */;
INSERT INTO `tbl_fale_conosco` VALUES (1,'Anna','11 975485214','','anna.castro@hotmaail.com','Analista de Dados','','','','','F');
/*!40000 ALTER TABLE `tbl_fale_conosco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_funcionario`
--

DROP TABLE IF EXISTS `tbl_funcionario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_funcionario` (
  `idFuncionario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `celular` varchar(12) NOT NULL,
  `telefone` varchar(11) DEFAULT NULL,
  `email` varchar(80) NOT NULL,
  `sexo` char(1) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `dtNasc` date NOT NULL,
  `salario` decimal(10,2) NOT NULL,
  `idEstadoCivil` int(11) NOT NULL,
  PRIMARY KEY (`idFuncionario`),
  KEY `fk_idEstadoCivil_tbl_estado_civil` (`idEstadoCivil`),
  CONSTRAINT `fk_idEstadoCivil_tbl_estado_civil` FOREIGN KEY (`idEstadoCivil`) REFERENCES `tbl_estado_civil` (`idEstadoCivil`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_funcionario`
--

LOCK TABLES `tbl_funcionario` WRITE;
/*!40000 ALTER TABLE `tbl_funcionario` DISABLE KEYS */;
INSERT INTO `tbl_funcionario` VALUES (9,'Caique M. Oliveira','666666666666','','caique_m_oliveira@outlook.com','M','66666666666','2016-06-06',6666666.00,1),(10,'Tester','111234567890','','tester@tester.company.com','M','11111111111','2016-01-11',0.00,1);
/*!40000 ALTER TABLE `tbl_funcionario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_item_curiosidade_decada`
--

DROP TABLE IF EXISTS `tbl_item_curiosidade_decada`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_item_curiosidade_decada` (
  `idItemPagina` int(11) NOT NULL AUTO_INCREMENT,
  `idDecada` int(11) NOT NULL,
  `titulo` varchar(120) NOT NULL,
  `imagemPrincipal` varchar(340) NOT NULL,
  `imagemFundo` varchar(340) NOT NULL,
  `descricao` varchar(600) NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  PRIMARY KEY (`idItemPagina`),
  KEY `fk_idDecada_tbl_curiosidade_decada` (`idDecada`),
  CONSTRAINT `fk_idDecada_tbl_curiosidade_decada` FOREIGN KEY (`idDecada`) REFERENCES `tbl_decada` (`idDecada`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_item_curiosidade_decada`
--

LOCK TABLES `tbl_item_curiosidade_decada` WRITE;
/*!40000 ALTER TABLE `tbl_item_curiosidade_decada` DISABLE KEYS */;
INSERT INTO `tbl_item_curiosidade_decada` VALUES (74,1,'THE ROLLING STONES','../../pictures/decades/uploaded/651b809c1439525fc53ce484d8c9261a.jpg','../../pictures/decades/uploaded/f42a7144995cf0433751a236eafc2a54.jpg','The Rolling Stones é uma banda de rock britânica formada em Londres em 1962 e considerada um dos maiores e mais bem sucedidos grupos musicais de todos os tempos. Ao lado dos Beatles, são considerados a banda mais importante da chamada Invasão Britânica ocorrida nos anos 1960. A banda e seus membros ocuparam posição de destaque nas mudanças musicais e comportamentais dos anos 1960 e são frequentemente relacionados com a contracultura, rebeldia e juventude.',1),(75,1,'THE BEATLES','../../pictures/decades/uploaded/433b70ee7f232d27b543ada9cd733dad.jpg','../../pictures/decades/uploaded/fa4d31d6dc23fab845c5ef87ce5045ff.jpg','The Beatles foi uma banda de rock, formada na cidade de Liverpool (Inglaterra), em 1956. Faziam parte deste grupo os seguintes músicos: John Lennon (vocalista, guitarrista e compositor), George Harrison (guitarrista e vocalista), Paul Mc Cartney (baixista, compositor e vocal) e Ringo Star (baterista). O nome inicial da banda era Silver Beetles, fazendo uma referência a besouros. Porém, por sugestão de John Lennon, a banda passou a se chamar The Beatles.',1),(76,1,'ELVIS PRESLEY','../../pictures/decades/uploaded/40509669df6512dd7630556e5e400c95.jpg','../../pictures/decades/uploaded/1f9be99ac7708566e45cc3ac453c1c80.jpg','Elvis Aaron Presley nasceu em 8 de janeiro de 1935, na cidade de East Tupelo (Mississipi – Estados Unidos). Foi um dos mais populares cantores de Rock’n and Roll de todos os tempos. É considerado por muitos o pai deste ritmo musical.\r Quando era jovem, Elvis assistia cultos da Igreja Pentecostal de sua cidade. Gostava muito das canções gospel que eram cantadas na igreja. Durante a juventude, também entrou em contato com a música country e com o blues (típico da região sul dos Estados Unidos).',1),(77,2,'AC/DC','../../pictures/decades/uploaded/8e870fde1ef13a173b3b77ea9b1b1cb3.jpg','../../pictures/decades/uploaded/016a6b39847dad8f03e6a841fec35e97.png','AC/DC é uma banda de rock formada em Sydney, Austrália em 1973, pelos irmãos Malcolm e Angus Young, sendo considerada umas das maiores e mais bem sucedidas bandas de rock de todos os tempos.\r \r No documentário produzido pelo programa Behind The Music a banda explica que precisava de um nome para sua primeira apresentação, os irmãos estavam nesta busca há várias semanas. Ao olhar para máquina de costura da irmã Margaret Young os Youngs observaram as iniciais \"AC/DC\".',1),(79,2,'SEX PISTOLS','../../pictures/decades/uploaded/d80142228252c9b5785e2da254cd46dd.jpg','../../pictures/decades/uploaded/3c0770be37e5ccb5f5c50d86b5ba2d64.jpg','Sex Pistols foi uma banda inglesa de punk rock formada em Londres em 1975, considerada responsável por ter começado o movimento punk no Reino Unido e ter influenciado muitos músicos de punk rock e rock alternativo. Ainda que originalmente a banda tenha durado apenas dois anos e meio, lançando apenas quatro singles e um álbum de estúdio — Never Mind the Bollocks, Here\'s the Sex Pistols —, os Sex Pistols são considerados por alguns críticos uma das mais influentes bandas da história da música.\r ',1),(86,2,'BLACK SABBATH','../../pictures/decades/uploaded/bf98ca50ee2ab89f84ae0ce2c0a06cd7.png','../../pictures/decades/uploaded/1ee39feb0717af8ecc16980c88b05631.jpg','Black Sabbath foi uma banda de heavy metal britânica formada no ano de 1968 em Birmingham pelo guitarrista e principal compositor Tony Iommi, o baixista e principal letrista Geezer Butler, o vocalista Ozzy Osbourne e o baterista Bill Ward. Desde o início, a banda passou por diversas mudanças na formação, com o guitarrista Iommi sendo o único presente em todas elas. Originalmente era uma banda de blues rock, que logo adotou o nome Black Sabbath e começou a incorporar ocultismo.',1),(87,3,'GUNS N\' ROSES','../../pictures/decades/uploaded/6e41efc6cbcdac85f1a6a6a6ad60c85a.jpg','../../pictures/decades/uploaded/9b18c11f6a2831712ded25994c69a1df.jpg','Guns N\' Roses (às vezes abreviado como G N\' R ou GnR) é uma banda de hard rock formada em Los Angeles, Califórnia (EUA), em 1985. A banda já lançou seis álbuns de estúdio, três EPs e um álbum ao vivo.\r\n\r\nA banda já vendeu mais de 100 milhões de cópias em todo o mundo, sendo cerca de 43 milhões somente nos Estados Unidos. O seu álbum de estreia lançado em 1987, Appetite for Destruction, vendeu cerca de 33 milhões de cópias no mundo todo, sendo certificado 18 vezes platina pela RIAA.',1),(88,3,'NIRVANA','../../pictures/decades/uploaded/731e81f73a571c115fb682986cfab0cd.jpg','../../pictures/decades/uploaded/398a294b4f5ea2a1a1d50b972d375d08.png','Nirvana foi uma banda norte-americana de rock, formada pelo vocalista e guitarrista Kurt Cobain e pelo baixista Krist Novoselic em Aberdeen no ano de 1987, que obteve grande sucesso em meio ao movimento grunge de Seattle no início dos anos 90. Vários bateristas passaram pelo Nirvana, sendo o que ficou mais tempo na banda foi Dave Grohl, que entrou em 1990.\r\n\r\nNo final da década de 1980 o Nirvana se estabeleceu como parte da cena grunge de Seattle, lançando seu primeiro álbum, Bleach.',1);
/*!40000 ALTER TABLE `tbl_item_curiosidade_decada` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_item_estabelecimento`
--

DROP TABLE IF EXISTS `tbl_item_estabelecimento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_item_estabelecimento` (
  `idItemPagina` int(11) NOT NULL AUTO_INCREMENT,
  `idPizzaria` int(11) NOT NULL,
  `imagemEstabelecimento` varchar(340) NOT NULL,
  `iconeBanda` varchar(340) NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  PRIMARY KEY (`idItemPagina`),
  KEY `fk_idPizzaria_tbl_item_estabelecimento` (`idPizzaria`),
  CONSTRAINT `fk_idPizzaria_tbl_item_estabelecimento` FOREIGN KEY (`idPizzaria`) REFERENCES `tbl_pizzaria` (`idPizzaria`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_item_estabelecimento`
--

LOCK TABLES `tbl_item_estabelecimento` WRITE;
/*!40000 ALTER TABLE `tbl_item_estabelecimento` DISABLE KEYS */;
INSERT INTO `tbl_item_estabelecimento` VALUES (3,3,'../../pictures/whereWeAre/uploaded/0b6c53271e4d6def7a94ea812e521076.jpg','../../pictures/whereWeAre/uploaded/acb28d9d1e79a7c95f66f48c6815ee50.png',1),(4,4,'../../pictures/whereWeAre/uploaded/80070597523cf2d2845725dafd17b44b.jpg','../../pictures/whereWeAre/uploaded/baadf7d14f5bbe66e7d1fca616892d10.png',1),(5,5,'../../pictures/whereWeAre/uploaded/7992e48958bcd21e0db7f12be6190339.jpg','../../pictures/whereWeAre/uploaded/7d527a4aaa3ebfc9f76757bf309b16c3.png',1);
/*!40000 ALTER TABLE `tbl_item_estabelecimento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_item_pizza_mes`
--

DROP TABLE IF EXISTS `tbl_item_pizza_mes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_item_pizza_mes` (
  `idItemPagina` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(120) NOT NULL,
  `descricao` varchar(240) NOT NULL,
  `preco` decimal(5,2) NOT NULL,
  `imagem` varchar(340) NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  PRIMARY KEY (`idItemPagina`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_item_pizza_mes`
--

LOCK TABLES `tbl_item_pizza_mes` WRITE;
/*!40000 ALTER TABLE `tbl_item_pizza_mes` DISABLE KEYS */;
INSERT INTO `tbl_item_pizza_mes` VALUES (2,'Pizza de Maguerita','Preparada com a deliciosa combinação de ingredientes como ervilha, azeitona, molho de tomate, cebola, ovos, queijo, linguiça calabresa e orégano, a Pizza Maguerita é sucesso em qualquer mesa.',32.12,'../../pictures/monthsPizza/uploaded/e7d126702420f0038443bbb1e211fc8f.jpg',1);
/*!40000 ALTER TABLE `tbl_item_pizza_mes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_item_promocao`
--

DROP TABLE IF EXISTS `tbl_item_promocao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_item_promocao` (
  `idItemPagina` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(120) NOT NULL,
  `imagem` varchar(340) NOT NULL,
  `descricao` varchar(240) NOT NULL,
  `precoNaoPromocional` decimal(5,2) NOT NULL,
  `precoPromocional` decimal(5,2) NOT NULL,
  `dtValidade` date NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  PRIMARY KEY (`idItemPagina`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_item_promocao`
--

LOCK TABLES `tbl_item_promocao` WRITE;
/*!40000 ALTER TABLE `tbl_item_promocao` DISABLE KEYS */;
INSERT INTO `tbl_item_promocao` VALUES (3,'Pizza de Maguerita','../../pictures/aboutUs/uploaded/e7d126702420f0038443bbb1e211fc8f.jpg','Molho, mussarela, tomate, gorgonzola e orégano.',45.00,32.00,'2017-12-07',1),(4,' Sex on The Beach','../../pictures/aboutUs/uploaded/a7f85d07d3e6e1275b0614dbae4ebf3d.jpg','O sex on the beach é um drink bifásico, perfeito para você que quer algo bonito e delicioso para seus convidados.',61.10,44.20,'2017-12-10',1);
/*!40000 ALTER TABLE `tbl_item_promocao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_item_sobre_pizzaria`
--

DROP TABLE IF EXISTS `tbl_item_sobre_pizzaria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_item_sobre_pizzaria` (
  `idItemPagina` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(120) NOT NULL,
  `imagem` varchar(340) NOT NULL,
  `descricao` varchar(600) NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  PRIMARY KEY (`idItemPagina`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_item_sobre_pizzaria`
--

LOCK TABLES `tbl_item_sobre_pizzaria` WRITE;
/*!40000 ALTER TABLE `tbl_item_sobre_pizzaria` DISABLE KEYS */;
INSERT INTO `tbl_item_sobre_pizzaria` VALUES (9,'SOBRE A FRAJOLA’S PIZZARIA','../../pictures/promotions/uploaded/11e488a986d1fe5d8bd46357659f4b86.jpg','Famosa por sua massa fina e pela variedade de sabores, que vão dos clássicos aos mais originais, a Frajola’s Pizzaria se tornou uma das casas mais tradicionais da cidade de São Paulo.\r\n\r\nHoje, possui três unidades em alguns dos principais bairros da capital paulista - Jardins, Quintos dos Infernos e Morumbi.\r\n\r\nAberta em 1957, na Pamplona – Jardins, a Frajola’s Pizzaria surgiu como uma casa de comida árabe. Seis anos depois, foi comprada pela família Nóbrega.',1),(10,'CHEF','../../pictures/promotions/uploaded/09862aeed4d64405c2a3298f1db92cb7.jpg','O Pizzaiolo-chefe Antônio Macedo, imprime sua assinatura no menu de pizzas, servido à noite, desde 1963. Entre suas criações uma coleção consagrada de sucessos como a Due Funghi, a Frajola, a Vegetariana e, também, novos sucessos como a Garoa, que foi criada especialmente para a inauguração da Frajola’s Pizzaria São Paulo. ',1),(11,'QUALIDADE E TRADIÇÃO','../../pictures/promotions/uploaded/ce7e272531f383c1d3bbbb67b2e7990e.jpg','O sucesso da Frajola’s Pizzaria está diretamente ligado à família Nobrega e aos ideais de seu fundador. Atualmente, a terceira geração, formada pelos netos André, Renan, Paulo e Marcelo, está à frente dos restaurantes e mantém um controle próximo e atento do negócio.\r\n\r\nTreinamento e formação de uma equipe qualificada, atualização constante de equipamentos, melhorias nas instalações e aperfeiçoamento da operação como um todo fazem da Frajola’s Pizzaria uma referência em seu mercado. E para complet',1);
/*!40000 ALTER TABLE `tbl_item_sobre_pizzaria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pizza_mes`
--

DROP TABLE IF EXISTS `tbl_pizza_mes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_pizza_mes` (
  `idPagina` int(11) NOT NULL AUTO_INCREMENT,
  `idItemPagina` int(11) NOT NULL,
  `titulo` varchar(240) NOT NULL,
  PRIMARY KEY (`idPagina`),
  KEY `fk_idItemPagina_tbl_pizza_mes` (`idItemPagina`),
  CONSTRAINT `fk_idItemPagina_tbl_pizza_mes` FOREIGN KEY (`idItemPagina`) REFERENCES `tbl_item_pizza_mes` (`idItemPagina`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pizza_mes`
--

LOCK TABLES `tbl_pizza_mes` WRITE;
/*!40000 ALTER TABLE `tbl_pizza_mes` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_pizza_mes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pizzaria`
--

DROP TABLE IF EXISTS `tbl_pizzaria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_pizzaria` (
  `idPizzaria` int(11) NOT NULL AUTO_INCREMENT,
  `idEndereco` int(11) NOT NULL,
  `telefone` varchar(11) NOT NULL,
  PRIMARY KEY (`idPizzaria`),
  KEY `fk_idEndereco_tbl_pizzaria` (`idEndereco`),
  CONSTRAINT `fk_idEndereco_tbl_pizzaria` FOREIGN KEY (`idEndereco`) REFERENCES `tbl_endereco` (`idEndereco`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pizzaria`
--

LOCK TABLES `tbl_pizzaria` WRITE;
/*!40000 ALTER TABLE `tbl_pizzaria` DISABLE KEYS */;
INSERT INTO `tbl_pizzaria` VALUES (3,3,'66666666666'),(4,4,'1137474450 '),(5,5,'01138870702');
/*!40000 ALTER TABLE `tbl_pizzaria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_privilegio`
--

DROP TABLE IF EXISTS `tbl_privilegio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_privilegio` (
  `idPrivilegio` int(11) NOT NULL AUTO_INCREMENT,
  `privilegio` varchar(250) NOT NULL,
  PRIMARY KEY (`idPrivilegio`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_privilegio`
--

LOCK TABLES `tbl_privilegio` WRITE;
/*!40000 ALTER TABLE `tbl_privilegio` DISABLE KEYS */;
INSERT INTO `tbl_privilegio` VALUES (1,'Administrador'),(2,'Operador Básico'),(3,'Cataloguista');
/*!40000 ALTER TABLE `tbl_privilegio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_privilegio_pagina`
--

DROP TABLE IF EXISTS `tbl_privilegio_pagina`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_privilegio_pagina` (
  `idPrivilegioPagina` int(11) NOT NULL AUTO_INCREMENT,
  `idPrivilegio` int(11) NOT NULL,
  `idPagina` int(11) NOT NULL,
  PRIMARY KEY (`idPrivilegioPagina`),
  KEY `fk_idPrivilegio_tbl_privilegio_pagina` (`idPrivilegio`),
  KEY `fk_idPagina_tbl_pizza_mes` (`idPagina`),
  CONSTRAINT `fk_idPagina_tbl_curiosidade_decada` FOREIGN KEY (`idPagina`) REFERENCES `tbl_curiosidade_decada` (`idPagina`),
  CONSTRAINT `fk_idPagina_tbl_estabelecimento` FOREIGN KEY (`idPagina`) REFERENCES `tbl_estabelecimento` (`idPagina`),
  CONSTRAINT `fk_idPagina_tbl_pizza_mes` FOREIGN KEY (`idPagina`) REFERENCES `tbl_pizza_mes` (`idPagina`),
  CONSTRAINT `fk_idPagina_tbl_promocao` FOREIGN KEY (`idPagina`) REFERENCES `tbl_promocao` (`idPagina`),
  CONSTRAINT `fk_idPagina_tbl_sobre_pizzaria` FOREIGN KEY (`idPagina`) REFERENCES `tbl_sobre_pizzaria` (`idPagina`),
  CONSTRAINT `fk_idPrivilegio_tbl_privilegio_pagina` FOREIGN KEY (`idPrivilegio`) REFERENCES `tbl_privilegio` (`idPrivilegio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_privilegio_pagina`
--

LOCK TABLES `tbl_privilegio_pagina` WRITE;
/*!40000 ALTER TABLE `tbl_privilegio_pagina` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_privilegio_pagina` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_produto`
--

DROP TABLE IF EXISTS `tbl_produto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_produto` (
  `idProduto` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `preco` decimal(5,2) NOT NULL,
  `descricao` varchar(60) NOT NULL,
  `detalhes` varchar(400) NOT NULL,
  `imagemProduto` varchar(340) NOT NULL,
  `idSubcategoria` int(11) NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  `click` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idProduto`),
  KEY `fk_idSubcategoria_tbl_produto` (`idSubcategoria`),
  CONSTRAINT `fk_idSubcategoria_tbl_produto` FOREIGN KEY (`idSubcategoria`) REFERENCES `tbl_subcategoria` (`idSubcategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_produto`
--

LOCK TABLES `tbl_produto` WRITE;
/*!40000 ALTER TABLE `tbl_produto` DISABLE KEYS */;
INSERT INTO `tbl_produto` VALUES (1,'Peperoni',42.00,'descrição teste','DETALHES Teste','../../pictures/pizzas/products/pepperoni.jpg',5,1,23),(2,'Portuguesa',42.00,'Port DESCRIÇÂO TESTE','Teste','../../pictures/pizzas/products/teste.jpg',4,1,30),(3,'dasdasd',66.00,'asdasd','asdsdasdasdasd','../../pictures/pizzas/products/14f80d0793305653a490ba1f05239f00.jpg',2,1,0),(4,'Brazuka',22.00,'para a família e os colegas o futebol','Pizza incrível servida com queijo junto a teste','../../pictures/pizzas/products/14f80d0793305653a490ba1f05239f00.jpg',2,1,2);
/*!40000 ALTER TABLE `tbl_produto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_promocao`
--

DROP TABLE IF EXISTS `tbl_promocao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_promocao` (
  `idPagina` int(11) NOT NULL AUTO_INCREMENT,
  `idItemPagina` int(11) NOT NULL,
  `titulo` varchar(240) NOT NULL,
  PRIMARY KEY (`idPagina`),
  KEY `fk_idItemPagina_tbl_promocao` (`idItemPagina`),
  CONSTRAINT `fk_idItemPagina_tbl_promocao` FOREIGN KEY (`idItemPagina`) REFERENCES `tbl_item_promocao` (`idItemPagina`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_promocao`
--

LOCK TABLES `tbl_promocao` WRITE;
/*!40000 ALTER TABLE `tbl_promocao` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_promocao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_sobre_pizzaria`
--

DROP TABLE IF EXISTS `tbl_sobre_pizzaria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_sobre_pizzaria` (
  `idPagina` int(11) NOT NULL AUTO_INCREMENT,
  `idItemPagina` int(11) NOT NULL,
  `titulo` varchar(240) NOT NULL,
  `subtitulo` varchar(120) NOT NULL,
  PRIMARY KEY (`idPagina`),
  KEY `fk_idItemPagina_tbl_sobre_pizzaria` (`idItemPagina`),
  CONSTRAINT `fk_idItemPagina_tbl_sobre_pizzaria` FOREIGN KEY (`idItemPagina`) REFERENCES `tbl_item_sobre_pizzaria` (`idItemPagina`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_sobre_pizzaria`
--

LOCK TABLES `tbl_sobre_pizzaria` WRITE;
/*!40000 ALTER TABLE `tbl_sobre_pizzaria` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_sobre_pizzaria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_subcategoria`
--

DROP TABLE IF EXISTS `tbl_subcategoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_subcategoria` (
  `idSubcategoria` int(11) NOT NULL AUTO_INCREMENT,
  `idCategoria` int(11) NOT NULL,
  `subcategoria` varchar(80) NOT NULL,
  PRIMARY KEY (`idSubcategoria`),
  KEY `idCategoria` (`idCategoria`),
  CONSTRAINT `tbl_subcategoria_ibfk_1` FOREIGN KEY (`idCategoria`) REFERENCES `tbl_categoria` (`idCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_subcategoria`
--

LOCK TABLES `tbl_subcategoria` WRITE;
/*!40000 ALTER TABLE `tbl_subcategoria` DISABLE KEYS */;
INSERT INTO `tbl_subcategoria` VALUES (1,1,'Sabores Vegetarianas'),(2,1,'Sabores Tradicionais'),(3,1,'Sabores Peixe'),(4,1,'Sabores a Moda'),(5,1,'Sabores Carne');
/*!40000 ALTER TABLE `tbl_subcategoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_usuario`
--

DROP TABLE IF EXISTS `tbl_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `idPrivilegio` int(11) NOT NULL,
  `idFuncionario` int(11) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `senha` varchar(200) NOT NULL,
  `foto_perfil` varchar(380) NOT NULL,
  PRIMARY KEY (`idUsuario`),
  KEY `fk_idPrivilegio_tbl_privilegio` (`idPrivilegio`),
  KEY `fk_idFuncionario_tbl_usuario` (`idFuncionario`),
  CONSTRAINT `fk_idFuncionario_tbl_usuario` FOREIGN KEY (`idFuncionario`) REFERENCES `tbl_funcionario` (`idFuncionario`),
  CONSTRAINT `fk_idPrivilegio_tbl_privilegio` FOREIGN KEY (`idPrivilegio`) REFERENCES `tbl_privilegio` (`idPrivilegio`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_usuario`
--

LOCK TABLES `tbl_usuario` WRITE;
/*!40000 ALTER TABLE `tbl_usuario` DISABLE KEYS */;
INSERT INTO `tbl_usuario` VALUES (9,1,9,'admin','adminweb','../pictures/employees/pictures/profile/3cecc727a6368a52deb78cb416895213.jpg'),(10,3,10,'tester','123','../pictures/employees/pictures/profile/1bb87d41d15fe27b500a4bfcde01bb0e.png');
/*!40000 ALTER TABLE `tbl_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `view_analise_marketing_clicks`
--

DROP TABLE IF EXISTS `view_analise_marketing_clicks`;
/*!50001 DROP VIEW IF EXISTS `view_analise_marketing_clicks`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `view_analise_marketing_clicks` AS SELECT 
 1 AS `idProduto`,
 1 AS `titulo`,
 1 AS `preco`,
 1 AS `avaliacao`,
 1 AS `click`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_mostrar_produtos`
--

DROP TABLE IF EXISTS `view_mostrar_produtos`;
/*!50001 DROP VIEW IF EXISTS `view_mostrar_produtos`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `view_mostrar_produtos` AS SELECT 
 1 AS `idProduto`,
 1 AS `titulo`,
 1 AS `preco`,
 1 AS `descricao`,
 1 AS `detalhes`,
 1 AS `imagemProduto`,
 1 AS `idSubcategoria`,
 1 AS `ativo`,
 1 AS `subcategoria`,
 1 AS `idCategoria`,
 1 AS `categoria`,
 1 AS `avaliacao`,
 1 AS `idAvaliacao`*/;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `view_analise_marketing_clicks`
--

/*!50001 DROP VIEW IF EXISTS `view_analise_marketing_clicks`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_analise_marketing_clicks` AS select `v_mp`.`idProduto` AS `idProduto`,`v_mp`.`titulo` AS `titulo`,`v_mp`.`preco` AS `preco`,`v_mp`.`avaliacao` AS `avaliacao`,`prd`.`click` AS `click` from (`view_mostrar_produtos` `v_mp` join `tbl_produto` `prd` on((`prd`.`idProduto` = `v_mp`.`idProduto`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_mostrar_produtos`
--

/*!50001 DROP VIEW IF EXISTS `view_mostrar_produtos`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_mostrar_produtos` AS select `prd`.`idProduto` AS `idProduto`,`prd`.`titulo` AS `titulo`,`prd`.`preco` AS `preco`,`prd`.`descricao` AS `descricao`,`prd`.`detalhes` AS `detalhes`,`prd`.`imagemProduto` AS `imagemProduto`,`prd`.`idSubcategoria` AS `idSubcategoria`,`prd`.`ativo` AS `ativo`,`sbc`.`subcategoria` AS `subcategoria`,`ctg`.`idCategoria` AS `idCategoria`,`ctg`.`categoria` AS `categoria`,`avl`.`avaliacao` AS `avaliacao`,`avl`.`idAvaliacao` AS `idAvaliacao` from (((`tbl_produto` `prd` join `tbl_avaliacao` `avl` on((`avl`.`idProduto` = `prd`.`idProduto`))) join `tbl_subcategoria` `sbc` on((`sbc`.`idSubcategoria` = `prd`.`idSubcategoria`))) join `tbl_categoria` `ctg` on((`ctg`.`idCategoria` = `sbc`.`idCategoria`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-11-30 20:43:19
