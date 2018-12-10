-- MySQL dump 10.13  Distrib 5.7.19, for Linux (x86_64)
--
-- Host: localhost    Database: teledata
-- ------------------------------------------------------
-- Server version	5.7.19-0ubuntu0.16.04.1

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
-- Table structure for table `anulaciones`
--

DROP TABLE IF EXISTS `anulaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `anulaciones` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `DevolucionId` int(11) DEFAULT NULL,
  `AnulacionIdBsale` int(11) DEFAULT NULL,
  `DocumentoIdBsale` int(11) DEFAULT NULL,
  `FechaAnulacion` date DEFAULT NULL,
  `HoraAnulacion` time DEFAULT NULL,
  `UrlPdfBsale` varchar(255) DEFAULT NULL,
  `NumeroDocumento` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anulaciones`
--

LOCK TABLES `anulaciones` WRITE;
/*!40000 ALTER TABLE `anulaciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `anulaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `arriendo_equipos_datos`
--

DROP TABLE IF EXISTS `arriendo_equipos_datos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `arriendo_equipos_datos` (
  `IdArriendoEquiposDatos` int(11) NOT NULL AUTO_INCREMENT,
  `Velocidad` varchar(255) NOT NULL,
  `Plan` varchar(255) NOT NULL,
  `IdOrigen` int(11) DEFAULT NULL,
  `IdProducto` int(11) DEFAULT NULL,
  `TipoDestino` varchar(150) DEFAULT NULL,
  `IdServicio` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdArriendoEquiposDatos`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `arriendo_equipos_datos`
--

LOCK TABLES `arriendo_equipos_datos` WRITE;
/*!40000 ALTER TABLE `arriendo_equipos_datos` DISABLE KEYS */;
INSERT INTO `arriendo_equipos_datos` VALUES (35,'3','3',0,0,'2',662),(39,'3X1','R3',10,0,'2',664),(40,'3X1','R3',10,0,'2',665),(41,'3X1','R3',10,0,'2',666),(42,'10X4','R10',10,0,'2',667),(43,'3X1','R3',10,0,'2',669),(44,'3X1','R3',10,0,'2',670),(45,'5X5','PK5',0,0,'2',671),(46,'5X5','PK5',0,0,'2',672),(47,'5X5','PK5',0,0,'2',673),(48,'5X5','PK5',0,0,'2',674),(49,'','',0,0,'2',675),(50,'','',0,0,'2',676),(51,'','',0,0,'2',677),(52,'','',0,0,'2',678),(53,'','',0,0,'2',679),(54,'','',0,0,'2',680),(55,'','',0,0,'2',681),(56,'3x1','R3',10,0,'2',682),(57,'3x1','R3',10,0,'2',683),(58,'3x1','R3',10,0,'2',684),(59,'3x1','R3',10,0,'2',685),(60,'5x2','R5',10,0,'2',686),(61,'5x2','R5',10,0,'2',687),(62,'3x1','R3',0,0,'2',688),(63,'5x2','R5',10,0,'2',689),(64,'5x2','R5',10,0,'2',690),(65,'3x1','R3',10,0,'2',691),(67,'1','1',0,0,'2',695),(68,'1','1',0,0,'0',67),(70,'1','1',0,0,'2',696),(71,'3x1','R3',10,0,'2',697),(72,'3x1','R3',10,0,'2',698),(73,'3x1','R3',10,0,'2',699),(74,'3x1','R3',10,0,'2',700),(75,'3x1','R3',10,0,'2',701),(76,'3x1','R3',10,0,'2',702),(77,'3x1','R3',10,0,'2',703),(78,'3x1','R3',10,0,'2',704),(79,'8x3','R8',10,0,'2',705),(80,'3x1','P3',10,0,'2',706),(81,'3x1','P3',0,0,'0',80),(82,'3x1','R3',10,0,'2',707),(83,'1','1',10,0,'2',708),(84,'3x1','R3',10,0,'2',710),(85,'5x2','R5',10,0,'2',711),(86,'3x1','R3',10,0,'2',712),(87,'5x2','R5',0,0,'2',713),(88,'2x600','',10,0,'2',714),(89,'3x1','R3',10,0,'2',715),(90,'2x600','R2',10,0,'2',716),(91,'5x5','PK5',10,0,'2',717),(92,'3x1','R3',10,0,'2',718),(93,'3x1','R3',10,0,'2',719),(94,'3x1','R3',10,0,'2',720),(95,'3x1','R3',10,0,'2',721);
/*!40000 ALTER TABLE `arriendo_equipos_datos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ciudades`
--

DROP TABLE IF EXISTS `ciudades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ciudades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(64) NOT NULL,
  `provincia_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=346 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ciudades`
--

LOCK TABLES `ciudades` WRITE;
/*!40000 ALTER TABLE `ciudades` DISABLE KEYS */;
INSERT INTO `ciudades` VALUES (1,'Arica',1),(2,'Camarones',1),(3,'General Lagos',2),(4,'Putre',2),(5,'Alto Hospicio',3),(6,'Iquique',3),(7,'Camiña',4),(8,'Colchane',4),(9,'Huara',4),(10,'Pica',4),(11,'Pozo Almonte',4),(12,'Antofagasta',5),(13,'Mejillones',5),(14,'Sierra Gorda',5),(15,'Taltal',5),(16,'Calama',6),(17,'Ollague',6),(18,'San Pedro de Atacama',6),(19,'María Elena',7),(20,'Tocopilla',7),(21,'Chañaral',8),(22,'Diego de Almagro',8),(23,'Caldera',9),(24,'Copiapó',9),(25,'Tierra Amarilla',9),(26,'Alto del Carmen',10),(27,'Freirina',10),(28,'Huasco',10),(29,'Vallenar',10),(30,'Canela',11),(31,'Illapel',11),(32,'Los Vilos',11),(33,'Salamanca',11),(34,'Andacollo',12),(35,'Coquimbo',12),(36,'La Higuera',12),(37,'La Serena',12),(38,'Paihuaco',12),(39,'Vicuña',12),(40,'Combarbalá',13),(41,'Monte Patria',13),(42,'Ovalle',13),(43,'Punitaqui',13),(44,'Río Hurtado',13),(45,'Isla de Pascua',14),(46,'Calle Larga',15),(47,'Los Andes',15),(48,'Rinconada',15),(49,'San Esteban',15),(50,'La Ligua',16),(51,'Papudo',16),(52,'Petorca',16),(53,'Zapallar',16),(54,'Hijuelas',17),(55,'La Calera',17),(56,'La Cruz',17),(57,'Limache',17),(58,'Nogales',17),(59,'Olmué',17),(60,'Quillota',17),(61,'Algarrobo',18),(62,'Cartagena',18),(63,'El Quisco',18),(64,'El Tabo',18),(65,'San Antonio',18),(66,'Santo Domingo',18),(67,'Catemu',19),(68,'Llaillay',19),(69,'Panquehue',19),(70,'Putaendo',19),(71,'San Felipe',19),(72,'Santa María',19),(73,'Casablanca',20),(74,'Concón',20),(75,'Juan Fernández',20),(76,'Puchuncaví',20),(77,'Quilpué',20),(78,'Quintero',20),(79,'Valparaíso',20),(80,'Villa Alemana',20),(81,'Viña del Mar',20),(82,'Colina',21),(83,'Lampa',21),(84,'Tiltil',21),(85,'Pirque',22),(86,'Puente Alto',22),(87,'San José de Maipo',22),(88,'Buin',23),(89,'Calera de Tango',23),(90,'Paine',23),(91,'San Bernardo',23),(92,'Alhué',24),(93,'Curacaví',24),(94,'María Pinto',24),(95,'Melipilla',24),(96,'San Pedro',24),(97,'Cerrillos',25),(98,'Cerro Navia',25),(99,'Conchalí',25),(100,'El Bosque',25),(101,'Estación Central',25),(102,'Huechuraba',25),(103,'Independencia',25),(104,'La Cisterna',25),(105,'La Granja',25),(106,'La Florida',25),(107,'La Pintana',25),(108,'La Reina',25),(109,'Las Condes',25),(110,'Lo Barnechea',25),(111,'Lo Espejo',25),(112,'Lo Prado',25),(113,'Macul',25),(114,'Maipú',25),(115,'Ñuñoa',25),(116,'Pedro Aguirre Cerda',25),(117,'Peñalolén',25),(118,'Providencia',25),(119,'Pudahuel',25),(120,'Quilicura',25),(121,'Quinta Normal',25),(122,'Recoleta',25),(123,'Renca',25),(124,'San Miguel',25),(125,'San Joaquín',25),(126,'San Ramón',25),(127,'Santiago',25),(128,'Vitacura',25),(129,'El Monte',26),(130,'Isla de Maipo',26),(131,'Padre Hurtado',26),(132,'Peñaflor',26),(133,'Talagante',26),(134,'Codegua',27),(135,'Coínco',27),(136,'Coltauco',27),(137,'Doñihue',27),(138,'Graneros',27),(139,'Las Cabras',27),(140,'Machalí',27),(141,'Malloa',27),(142,'Mostazal',27),(143,'Olivar',27),(144,'Peumo',27),(145,'Pichidegua',27),(146,'Quinta de Tilcoco',27),(147,'Rancagua',27),(148,'Rengo',27),(149,'Requínoa',27),(150,'San Vicente de Tagua Tagua',27),(151,'La Estrella',28),(152,'Litueche',28),(153,'Marchihue',28),(154,'Navidad',28),(155,'Peredones',28),(156,'Pichilemu',28),(157,'Chépica',29),(158,'Chimbarongo',29),(159,'Lolol',29),(160,'Nancagua',29),(161,'Palmilla',29),(162,'Peralillo',29),(163,'Placilla',29),(164,'Pumanque',29),(165,'San Fernando',29),(166,'Santa Cruz',29),(167,'Cauquenes',30),(168,'Chanco',30),(169,'Pelluhue',30),(170,'Curicó',31),(171,'Hualañé',31),(172,'Licantén',31),(173,'Molina',31),(174,'Rauco',31),(175,'Romeral',31),(176,'Sagrada Familia',31),(177,'Teno',31),(178,'Vichuquén',31),(179,'Colbún',32),(180,'Linares',32),(181,'Longaví',32),(182,'Parral',32),(183,'Retiro',32),(184,'San Javier',32),(185,'Villa Alegre',32),(186,'Yerbas Buenas',32),(187,'Constitución',33),(188,'Curepto',33),(189,'Empedrado',33),(190,'Maule',33),(191,'Pelarco',33),(192,'Pencahue',33),(193,'Río Claro',33),(194,'San Clemente',33),(195,'San Rafael',33),(196,'Talca',33),(197,'Arauco',34),(198,'Cañete',34),(199,'Contulmo',34),(200,'Curanilahue',34),(201,'Lebu',34),(202,'Los Álamos',34),(203,'Tirúa',34),(204,'Alto Biobío',35),(205,'Antuco',35),(206,'Cabrero',35),(207,'Laja',35),(208,'Los Ángeles',35),(209,'Mulchén',35),(210,'Nacimiento',35),(211,'Negrete',35),(212,'Quilaco',35),(213,'Quilleco',35),(214,'San Rosendo',35),(215,'Santa Bárbara',35),(216,'Tucapel',35),(217,'Yumbel',35),(218,'Chiguayante',36),(219,'Concepción',36),(220,'Coronel',36),(221,'Florida',36),(222,'Hualpén',36),(223,'Hualqui',36),(224,'Lota',36),(225,'Penco',36),(226,'San Pedro de La Paz',36),(227,'Santa Juana',36),(228,'Talcahuano',36),(229,'Tomé',36),(230,'Bulnes',37),(231,'Chillán',37),(232,'Chillán Viejo',37),(233,'Cobquecura',37),(234,'Coelemu',37),(235,'Coihueco',37),(236,'El Carmen',37),(237,'Ninhue',37),(238,'Ñiquen',37),(239,'Pemuco',37),(240,'Pinto',37),(241,'Portezuelo',37),(242,'Quillón',37),(243,'Quirihue',37),(244,'Ránquil',37),(245,'San Carlos',37),(246,'San Fabián',37),(247,'San Ignacio',37),(248,'San Nicolás',37),(249,'Treguaco',37),(250,'Yungay',37),(251,'Carahue',38),(252,'Cholchol',38),(253,'Cunco',38),(254,'Curarrehue',38),(255,'Freire',38),(256,'Galvarino',38),(257,'Gorbea',38),(258,'Lautaro',38),(259,'Loncoche',38),(260,'Melipeuco',38),(261,'Nueva Imperial',38),(262,'Padre Las Casas',38),(263,'Perquenco',38),(264,'Pitrufquén',38),(265,'Pucón',38),(266,'Saavedra',38),(267,'Temuco',38),(268,'Teodoro Schmidt',38),(269,'Toltén',38),(270,'Vilcún',38),(271,'Villarrica',38),(272,'Angol',39),(273,'Collipulli',39),(274,'Curacautín',39),(275,'Ercilla',39),(276,'Lonquimay',39),(277,'Los Sauces',39),(278,'Lumaco',39),(279,'Purén',39),(280,'Renaico',39),(281,'Traiguén',39),(282,'Victoria',39),(283,'Corral',40),(284,'Lanco',40),(285,'Los Lagos',40),(286,'Máfil',40),(287,'Mariquina',40),(288,'Paillaco',40),(289,'Panguipulli',40),(290,'Valdivia',40),(291,'Futrono',41),(292,'La Unión',41),(293,'Lago Ranco',41),(294,'Río Bueno',41),(295,'Ancud',42),(296,'Castro',42),(297,'Chonchi',42),(298,'Curaco de Vélez',42),(299,'Dalcahue',42),(300,'Puqueldón',42),(301,'Queilén',42),(302,'Quemchi',42),(303,'Quellón',42),(304,'Quinchao',42),(305,'Calbuco',43),(306,'Cochamó',43),(307,'Fresia',43),(308,'Frutillar',43),(309,'Llanquihue',43),(310,'Los Muermos',43),(311,'Maullín',43),(312,'Puerto Montt',43),(313,'Puerto Varas',43),(314,'Osorno',44),(315,'Puero Octay',44),(316,'Purranque',44),(317,'Puyehue',44),(318,'Río Negro',44),(319,'San Juan de la Costa',44),(320,'San Pablo',44),(321,'Chaitén',45),(322,'Futaleufú',45),(323,'Hualaihué',45),(324,'Palena',45),(325,'Aisén',46),(326,'Cisnes',46),(327,'Guaitecas',46),(328,'Cochrane',47),(329,'O\'higgins',47),(330,'Tortel',47),(331,'Coihaique',48),(332,'Lago Verde',48),(333,'Chile Chico',49),(334,'Río Ibáñez',49),(335,'Antártica',50),(336,'Cabo de Hornos',50),(337,'Laguna Blanca',51),(338,'Punta Arenas',51),(339,'Río Verde',51),(340,'San Gregorio',51),(341,'Porvenir',52),(342,'Primavera',52),(343,'Timaukel',52),(344,'Natales',53),(345,'Torres del Paine',53);
/*!40000 ALTER TABLE `ciudades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clase_clientes`
--

DROP TABLE IF EXISTS `clase_clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clase_clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `limite_facturas` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clase_clientes`
--

LOCK TABLES `clase_clientes` WRITE;
/*!40000 ALTER TABLE `clase_clientes` DISABLE KEYS */;
INSERT INTO `clase_clientes` VALUES (1,'Normal',2),(2,'Preferente',1),(3,'Premium',0);
/*!40000 ALTER TABLE `clase_clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clase_tickets`
--

DROP TABLE IF EXISTS `clase_tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clase_tickets` (
  `IdClase` int(11) NOT NULL,
  `Nombre` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`IdClase`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clase_tickets`
--

LOCK TABLES `clase_tickets` WRITE;
/*!40000 ALTER TABLE `clase_tickets` DISABLE KEYS */;
INSERT INTO `clase_tickets` VALUES (1,'Cliente'),(2,'Interno');
/*!40000 ALTER TABLE `clase_tickets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comentarios_tickets`
--

DROP TABLE IF EXISTS `comentarios_tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comentarios_tickets` (
  `IdComentarioTicket` int(11) NOT NULL AUTO_INCREMENT,
  `IdTickets` int(11) DEFAULT NULL,
  `Comentario` varchar(150) DEFAULT NULL,
  `IdUSuario` varchar(150) DEFAULT NULL,
  `Fecha` datetime DEFAULT NULL,
  PRIMARY KEY (`IdComentarioTicket`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comentarios_tickets`
--

LOCK TABLES `comentarios_tickets` WRITE;
/*!40000 ALTER TABLE `comentarios_tickets` DISABLE KEYS */;
/*!40000 ALTER TABLE `comentarios_tickets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compras_ingresos`
--

DROP TABLE IF EXISTS `compras_ingresos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `compras_ingresos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero_documento` int(11) NOT NULL,
  `fecha_emision` date NOT NULL,
  `fecha_vencimiento` date DEFAULT NULL,
  `detalle` text,
  `proveedor_id` int(11) NOT NULL,
  `centro_costo_id` int(11) NOT NULL,
  `total_documento` double(11,2) DEFAULT NULL,
  `tipo_documento_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compras_ingresos`
--

LOCK TABLES `compras_ingresos` WRITE;
/*!40000 ALTER TABLE `compras_ingresos` DISABLE KEYS */;
/*!40000 ALTER TABLE `compras_ingresos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compras_pagos`
--

DROP TABLE IF EXISTS `compras_pagos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `compras_pagos` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `CompraId` int(11) NOT NULL,
  `FechaPago` date NOT NULL,
  `TipoPago` int(11) NOT NULL,
  `Detalle` varchar(255) DEFAULT NULL,
  `Monto` double(11,2) DEFAULT NULL,
  `FechaEmisionCheque` date DEFAULT NULL,
  `FechaVencimientoCheque` date DEFAULT NULL,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compras_pagos`
--

LOCK TABLES `compras_pagos` WRITE;
/*!40000 ALTER TABLE `compras_pagos` DISABLE KEYS */;
/*!40000 ALTER TABLE `compras_pagos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contactos`
--

DROP TABLE IF EXISTS `contactos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contactos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contacto` varchar(255) DEFAULT NULL,
  `tipo_contacto` varchar(255) DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `rut` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=133 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contactos`
--

LOCK TABLES `contactos` WRITE;
/*!40000 ALTER TABLE `contactos` DISABLE KEYS */;
INSERT INTO `contactos` VALUES (119,'Servicios integrales del Sur S.A.','2','SIS.PTOVARAS@GMAIL.COM','652566600','76521560'),(120,'Cjurgens','2','gcisternas@nomehue.cl','1','76243328'),(124,'Cjurgens','2','cjurgens@teledata.cl, kcardenas@teledata.cl','1','26339939'),(127,'Ximena de la Fuente','2','ximenagourmet@gmail.com','994380781','76541036'),(128,'Marcela Jimenez','2','marcela.jimenez@ersil.cl','954161342','76911785'),(129,'Ricardo Roth','1','rroth@oasisdelampa.cl','987769457','76466000'),(132,'Daniela','2','daniela.castillo@incon.cl','','76830018');
/*!40000 ALTER TABLE `contactos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `datos_tecnicos`
--

DROP TABLE IF EXISTS `datos_tecnicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `datos_tecnicos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rut` int(11) NOT NULL,
  `id_servicio` int(11) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `estacion` varchar(100) NOT NULL,
  `ap` varchar(100) NOT NULL,
  `senal` int(11) NOT NULL,
  `senal_actual` int(11) NOT NULL,
  `mac` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `datos_tecnicos`
--

LOCK TABLES `datos_tecnicos` WRITE;
/*!40000 ALTER TABLE `datos_tecnicos` DISABLE KEYS */;
/*!40000 ALTER TABLE `datos_tecnicos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departamentos_tickets`
--

DROP TABLE IF EXISTS `departamentos_tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departamentos_tickets` (
  `IdDepartamento` int(11) NOT NULL,
  `Nombre` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`IdDepartamento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departamentos_tickets`
--

LOCK TABLES `departamentos_tickets` WRITE;
/*!40000 ALTER TABLE `departamentos_tickets` DISABLE KEYS */;
INSERT INTO `departamentos_tickets` VALUES (1,'Soporte Técnico');
/*!40000 ALTER TABLE `departamentos_tickets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `descuentos`
--

DROP TABLE IF EXISTS `descuentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `descuentos` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Rut` varchar(255) DEFAULT NULL,
  `IdServicio` int(11) DEFAULT NULL,
  `Porcentaje` float(11,0) DEFAULT NULL,
  `Cantidad` int(11) DEFAULT NULL,
  `IdTicket` int(11) DEFAULT NULL,
  `CantidadUtilizada` int(11) DEFAULT NULL,
  `FechaCreacion` date DEFAULT NULL,
  `FechaAprobacion` date DEFAULT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `descuentos`
--

LOCK TABLES `descuentos` WRITE;
/*!40000 ALTER TABLE `descuentos` DISABLE KEYS */;
/*!40000 ALTER TABLE `descuentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `descuentos_aplicados`
--

DROP TABLE IF EXISTS `descuentos_aplicados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `descuentos_aplicados` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `IdDescuento` int(11) DEFAULT NULL,
  `IdServicio` int(11) DEFAULT NULL,
  `IdDetalle` int(11) DEFAULT NULL,
  `IdTicket` int(11) DEFAULT NULL,
  `Porcentaje` float DEFAULT NULL,
  `Tipo` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `descuentos_aplicados`
--

LOCK TABLES `descuentos_aplicados` WRITE;
/*!40000 ALTER TABLE `descuentos_aplicados` DISABLE KEYS */;
/*!40000 ALTER TABLE `descuentos_aplicados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `devoluciones`
--

DROP TABLE IF EXISTS `devoluciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `devoluciones` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `FacturaId` int(11) DEFAULT NULL,
  `DevolucionIdBsale` int(11) DEFAULT NULL,
  `DocumentoIdBsale` int(11) DEFAULT NULL,
  `Motivo` varchar(255) DEFAULT NULL,
  `FechaDevolucion` date DEFAULT NULL,
  `HoraDevolucion` time DEFAULT NULL,
  `UrlPdfBsale` varchar(255) DEFAULT NULL,
  `NumeroDocumento` int(11) DEFAULT NULL,
  `DevolucionAnulada` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `devoluciones`
--

LOCK TABLES `devoluciones` WRITE;
/*!40000 ALTER TABLE `devoluciones` DISABLE KEYS */;
INSERT INTO `devoluciones` VALUES (24,2919,5,7,'Error  de Prueba ','2017-12-14','21:00:00','http://app2.bsale.cl/view/15057/94d1066f13a2.pdf?sfd=99',1,0),(25,2921,6,16,'error de prueba','2017-12-14','21:00:00','http://app2.bsale.cl/view/15057/47625aacfa0d.pdf?sfd=99',2,0),(26,2895,10,31,'ANULAR','2018-08-21','21:00:00','http://app2.bsale.cl/view/15057/9083b0a56bb9.pdf?sfd=99',3,0),(27,2908,11,36,'Prueba API','2018-08-23','21:00:00','http://app2.bsale.cl/view/15057/d54a81ee1730.pdf?sfd=99',4,0),(29,2971,12,52,'Boleta Doble Cliente CVT','2018-09-11','10:49:32','http://app2.bsale.cl/view/15057/953886976460.pdf?sfd=99',5,0),(30,2922,14,32,'error ','2018-09-11','21:00:00','http://app2.bsale.cl/view/15057/bf520fe4929f.pdf?sfd=99',6,NULL),(31,2975,15,57,'error en el monto','2018-09-26','16:27:37','http://app2.bsale.cl/view/15057/5eb9ce798329.pdf?sfd=99',7,0),(32,3063,17,98,'error en facturacion','2018-10-17','12:06:14','http://app2.bsale.cl/view/15057/4eec7e9a7e32.pdf?sfd=99',8,0),(33,3031,20,76,'Error de Facturación','2018-10-17','21:00:00','http://app2.bsale.cl/view/15057/a860f7b5e36d.pdf?sfd=99',9,NULL);
/*!40000 ALTER TABLE `devoluciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `direcciones`
--

DROP TABLE IF EXISTS `direcciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `direcciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rut` int(11) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `comuna` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `direcciones`
--

LOCK TABLES `direcciones` WRITE;
/*!40000 ALTER TABLE `direcciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `direcciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `direcciones_ip`
--

DROP TABLE IF EXISTS `direcciones_ip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `direcciones_ip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rut` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `id_servicio` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `direcciones_ip`
--

LOCK TABLES `direcciones_ip` WRITE;
/*!40000 ALTER TABLE `direcciones_ip` DISABLE KEYS */;
/*!40000 ALTER TABLE `direcciones_ip` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado_tickets`
--

DROP TABLE IF EXISTS `estado_tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estado_tickets` (
  `IdEstado` int(11) NOT NULL,
  `Nombre` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`IdEstado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado_tickets`
--

LOCK TABLES `estado_tickets` WRITE;
/*!40000 ALTER TABLE `estado_tickets` DISABLE KEYS */;
INSERT INTO `estado_tickets` VALUES (1,'Abierto'),(2,'Cerrado'),(3,'Finalizado');
/*!40000 ALTER TABLE `estado_tickets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `facturas`
--

DROP TABLE IF EXISTS `facturas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `facturas` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Rut` varchar(255) NOT NULL,
  `Grupo` int(11) NOT NULL,
  `TipoFactura` int(11) NOT NULL,
  `EstatusFacturacion` int(11) NOT NULL,
  `DocumentoIdBsale` varchar(50) NOT NULL,
  `NumeroDocumento` varchar(50) DEFAULT NULL,
  `UrlPdfBsale` varchar(255) NOT NULL,
  `informedSiiBsale` varchar(50) NOT NULL,
  `responseMsgSiiBsale` varchar(255) NOT NULL,
  `FechaFacturacion` date NOT NULL,
  `HoraFacturacion` time NOT NULL,
  `TipoDocumento` varchar(255) DEFAULT NULL,
  `FechaVencimiento` date DEFAULT NULL,
  `IVA` float DEFAULT NULL,
  `NumeroOC` varchar(255) DEFAULT NULL,
  `FechaOC` date DEFAULT NULL,
  `Referencia` varchar(255) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `IdUsuarioSession` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3079 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `facturas`
--

LOCK TABLES `facturas` WRITE;
/*!40000 ALTER TABLE `facturas` DISABLE KEYS */;
INSERT INTO `facturas` VALUES (1,'76830018',1001,2,0,'0',NULL,'','0','','2018-08-24','15:49:58','2','2018-08-24',0.19,'1','2018-08-28',NULL,NULL,NULL),(2,'76830018',1001,2,0,'0',NULL,'','0','','2018-08-24','15:49:58','2','2018-08-24',0.19,'',NULL,NULL,NULL,NULL),(2699,'86247400',1,2,1,'21','10','http://app2.bsale.cl/view/15057/363b074f7ea4.pdf?sfd=99','1','','2018-06-22','11:12:30','2','2018-07-01',0.19,NULL,NULL,NULL,NULL,NULL),(2825,'14638794',1,2,1,'23','2','http://app2.bsale.cl/view/15057/eb893e8f73c0.pdf?sfd=99','1','','2018-08-14','12:56:13','1','2018-09-03',0.19,NULL,NULL,NULL,NULL,NULL),(2826,'12761640',1,2,1,'24','3','http://app2.bsale.cl/view/15057/94c361eb3a8a.pdf?sfd=99','1','','2018-08-14','12:56:19','1','2018-09-03',0.19,NULL,NULL,NULL,NULL,NULL),(2827,'6593446',1,2,1,'25','4','http://app2.bsale.cl/view/15057/44aaa459150f.pdf?sfd=99','1','','2018-08-14','12:56:24','1','2018-09-03',0.19,NULL,NULL,NULL,NULL,NULL),(2828,'5012355',1,2,1,'26','5','http://app2.bsale.cl/view/15057/32651f5f24a1.pdf?sfd=99','1','','2018-08-14','12:56:30','1','2018-09-03',0.19,NULL,NULL,NULL,NULL,NULL),(2831,'5012355',0,1,1,'27','6','http://app2.bsale.cl/view/15057/607f06e61bd3.pdf?sfd=99','1','','2018-08-14','15:32:04','1','2018-09-03',0.19,'',NULL,NULL,NULL,NULL),(2832,'6593446',0,1,1,'28','7','http://app2.bsale.cl/view/15057/8766e094a70b.pdf?sfd=99','1','','2018-08-14','15:33:10','1','2018-09-03',0.19,'',NULL,NULL,NULL,NULL),(2833,'78796670',1,2,1,'29','11','http://app2.bsale.cl/view/15057/f21a34e9716f.pdf?sfd=99','1','','2018-08-14','17:33:18','2','2018-09-03',0.19,'',NULL,NULL,NULL,NULL),(2884,'86247400',4,2,1,'30','12','http://app2.bsale.cl/view/15057/c4a0e7745aa1.pdf?sfd=99','1','','2018-08-21','14:53:37','2','2018-09-10',0.19,'',NULL,NULL,NULL,NULL),(2895,'86247400',4,2,2,'31','13','http://app2.bsale.cl/view/15057/5ed1a201a343.pdf?sfd=99','1','','2018-08-21','16:34:45','2','2018-09-10',0.19,'196558','2018-08-07',NULL,NULL,NULL),(2899,'8466934',0,1,1,'33','9','http://app2.bsale.cl/view/15057/776d3fe798b4.pdf?sfd=99','1','','2018-08-22','12:42:28','1','2018-09-11',0.19,'',NULL,NULL,NULL,NULL),(2902,'76830018',1,3,1,'35','14','http://app2.bsale.cl/view/15057/63070fdef548.pdf?sfd=99','1','','2018-08-24','13:14:53','2','2018-08-31',0.19,'',NULL,NULL,NULL,NULL),(2908,'17520287',0,1,2,'36','10','http://app2.bsale.cl/view/15057/ca67ac0d0b15.pdf?sfd=99','1','','2018-08-24','14:30:46','1','2018-09-13',0.19,'',NULL,NULL,NULL,NULL),(2919,'11111111',1000,4,2,'7','1','http://app2.bsale.cl/view/15057/dfb0decb8d12.pdf?sfd=99','0','Proceso Finalizado Correctamente!','2017-10-02','21:00:00','2','2017-10-02',0.19,'',NULL,NULL,NULL,NULL),(2920,'15434708',1000,4,1,'22','1','http://app2.bsale.cl/view/15057/cfed3a9043bf.pdf?sfd=99','1','','2018-08-05','20:00:00','1','2018-08-25',0.19,'',NULL,NULL,NULL,NULL),(2921,'23527489',1000,4,2,'16','7','http://app2.bsale.cl/view/15057/93340799888f.pdf?sfd=99','0','Proceso Finalizado Correctamente!','2017-11-06','21:00:00','2','2017-11-06',0.19,'',NULL,NULL,NULL,NULL),(2922,'8466934',1000,4,2,'32','8','http://app2.bsale.cl/view/15057/db5b3534bbfa.pdf?sfd=99','1','','2018-08-21','21:00:00','1','2018-08-21',0.19,'','1970-01-31',NULL,NULL,NULL),(2959,'5012355',1,2,1,'38','11','http://app2.bsale.cl/view/15057/40f1fb0e4788.pdf?sfd=99','1','','2018-09-03','16:44:55','1','2018-09-23',0.19,'','1970-01-31',NULL,NULL,NULL),(2960,'14638794',1,2,1,'39','12','http://app2.bsale.cl/view/15057/5cae0b489f3d.pdf?sfd=99','1','','2018-09-03','17:10:41','1','2018-09-23',0.19,'','1970-01-31',NULL,NULL,NULL),(2961,'12761640',1,2,1,'40','13','http://app2.bsale.cl/view/15057/faf10f6d9275.pdf?sfd=99','1','','2018-09-03','17:10:53','1','2018-09-23',0.19,'','1970-01-31',NULL,NULL,NULL),(2962,'6593446',1,2,1,'41','14','http://app2.bsale.cl/view/15057/72cd996ca951.pdf?sfd=99','1','','2018-09-03','17:11:15','1','2018-09-23',0.19,'','1970-01-31',NULL,NULL,NULL),(2963,'76608219',1,2,1,'42','15','http://app2.bsale.cl/view/15057/9238d42a34df.pdf?sfd=99','1','','2018-09-04','09:28:10','2','2018-09-24',0.19,NULL,NULL,NULL,NULL,NULL),(2964,'78796670',1,2,1,'43','16','http://app2.bsale.cl/view/15057/58dfc529c1b0.pdf?sfd=99','1','','2018-09-04','09:28:16','2','2018-09-24',0.19,NULL,NULL,NULL,NULL,NULL),(2967,'86247400',4,2,1,'44','17','http://app2.bsale.cl/view/15057/4afa6ac0ae55.pdf?sfd=99','1','','2018-09-06','10:01:24','2','2018-09-26',0.19,'OST-198015','2018-08-29',NULL,NULL,NULL),(2968,'12017636',1,2,1,'45','18','http://app2.bsale.cl/view/15057/c663aef118a6.pdf?sfd=99','1','','2018-09-06','10:02:21','2','2018-09-26',0.19,NULL,NULL,NULL,NULL,NULL),(2969,'13825370',1,2,1,'46','19','http://app2.bsale.cl/view/15057/e1f91580420d.pdf?sfd=99','1','','2018-09-06','10:02:27','2','2018-09-26',0.19,NULL,NULL,NULL,NULL,NULL),(2970,'76127546',1,2,1,'47','20','http://app2.bsale.cl/view/15057/4eee0cd64f64.pdf?sfd=99','1','','2018-09-06','10:02:32','2','2018-09-26',0.19,NULL,NULL,NULL,NULL,NULL),(2971,'6448076',1,2,2,'48','15','http://app2.bsale.cl/view/15057/15e8e8fdfe84.pdf?sfd=99','1','','2018-09-11','10:09:49','1','2018-09-26',0.19,'','1970-01-31',NULL,NULL,NULL),(2972,'17296156',1,2,1,'49','16','http://app2.bsale.cl/view/15057/442e8cb2a526.pdf?sfd=99','1','','2018-09-06','10:10:03','1','2018-09-26',0.19,'','1970-01-31',NULL,NULL,NULL),(2973,'17520287',1,2,1,'50','17','http://app2.bsale.cl/view/15057/3a5dacd2f012.pdf?sfd=99','1','','2018-09-07','16:32:26','1','2018-09-27',0.19,'','1970-01-31',NULL,NULL,NULL),(2975,'6448076',1000,1,2,'51','18','http://app2.bsale.cl/view/15057/77d3d335447c.pdf?sfd=99','1','','2018-09-26','17:17:38','1','2018-09-30',0.19,'','1969-01-31',NULL,NULL,NULL),(2976,'15250162',1,2,1,'53','19','http://app2.bsale.cl/view/15057/6237bf31fa22.pdf?sfd=99','1','','2018-09-12','16:22:29','1','2018-10-02',0.19,'','1970-01-31',NULL,NULL,NULL),(2977,'76245945',1,2,1,'54','21','http://app2.bsale.cl/view/15057/58524c8f8255.pdf?sfd=99','1','','2018-09-12','16:22:55','2','2018-10-02',0.19,'','1970-01-31',NULL,NULL,NULL),(2978,'76830018',1,2,1,'55','22','http://app2.bsale.cl/view/15057/b8e6f4686105.pdf?sfd=99','1','','2018-09-12','16:23:20','2','2018-10-02',0.19,'','1970-01-31',NULL,NULL,NULL),(2985,'17296156',1000,1,1,'58','20','http://app2.bsale.cl/view/15057/5adade42fdc9.pdf?sfd=99','1','','2018-09-26','17:03:15','1','2018-10-16',0.19,'','1969-01-31',NULL,NULL,NULL),(2987,'15514913',1,3,1,'59','21','http://app2.bsale.cl/view/15057/33dcf9bf138e.pdf?sfd=99','1','','2018-09-28','17:29:05','1','2018-10-05',0.19,'0','1970-01-31',NULL,NULL,NULL),(3014,'6593446',1000,1,1,'60','22','http://app2.bsale.cl/view/15057/bce79510a1d7.pdf?sfd=99','1','','2018-10-01','16:16:24','1','2018-10-21',0.19,'','1969-01-31',NULL,NULL,NULL),(3015,'8466934',1000,1,1,'61','23','http://app2.bsale.cl/view/15057/624640c2d2f8.pdf?sfd=99','1','','2018-10-01','16:16:39','1','2018-10-21',0.19,'','1969-01-31',NULL,NULL,NULL),(3016,'76521560',1000,1,1,'62','23','http://app2.bsale.cl/view/15057/8e95e6f48a43.pdf?sfd=99','1','','2018-10-01','16:18:20','2','2018-10-21',0.19,'','1969-01-31',NULL,NULL,NULL),(3017,'76245945',1000,1,1,'63','24','http://app2.bsale.cl/view/15057/fede3ea7b31b.pdf?sfd=99','1','','2018-10-01','16:18:33','2','2018-10-21',0.19,'','1969-01-31',NULL,NULL,NULL),(3018,'76243328',1000,1,1,'64','25','http://app2.bsale.cl/view/15057/649b374d7a99.pdf?sfd=99','1','','2018-10-01','16:18:45','2','2018-10-21',0.19,'','1969-01-31',NULL,NULL,NULL),(3019,'14638794',1,2,1,'65','24','http://app2.bsale.cl/view/15057/f1677609fd54.pdf?sfd=99','1','','2018-10-01','16:33:28','1','2018-10-21',0.19,NULL,NULL,NULL,NULL,NULL),(3020,'12761640',1,2,1,'66','25','http://app2.bsale.cl/view/15057/41fc58c6b105.pdf?sfd=99','1','','2018-10-01','16:33:32','1','2018-10-21',0.19,NULL,NULL,NULL,NULL,NULL),(3021,'17296156',1,2,1,'67','26','http://app2.bsale.cl/view/15057/02548c6d0330.pdf?sfd=99','1','','2018-10-01','16:33:37','1','2018-10-21',0.19,NULL,NULL,NULL,NULL,NULL),(3022,'76608219',1,2,1,'68','26','http://app2.bsale.cl/view/15057/2dec639f0cd8.pdf?sfd=99','1','','2018-10-01','16:33:41','2','2018-10-21',0.19,NULL,NULL,NULL,NULL,NULL),(3023,'6448076',1,2,1,'69','27','http://app2.bsale.cl/view/15057/d3faeac99801.pdf?sfd=99','1','','2018-10-01','16:33:47','1','2018-10-21',0.19,NULL,NULL,NULL,NULL,NULL),(3024,'6593446',1,2,1,'70','28','http://app2.bsale.cl/view/15057/276e5c97179d.pdf?sfd=99','1','','2018-10-01','16:33:52','1','2018-10-21',0.19,NULL,NULL,NULL,NULL,NULL),(3025,'5012355',1,2,1,'71','29','http://app2.bsale.cl/view/15057/17e5e5c3006d.pdf?sfd=99','1','','2018-10-01','16:33:56','1','2018-10-21',0.19,NULL,NULL,NULL,NULL,NULL),(3026,'17520287',1,2,1,'72','30','http://app2.bsale.cl/view/15057/451470466ce6.pdf?sfd=99','1','','2018-10-01','16:34:00','1','2018-10-21',0.19,NULL,NULL,NULL,NULL,NULL),(3028,'15250162',1,2,1,'73','31','http://app2.bsale.cl/view/15057/6c6a5e090d0b.pdf?sfd=99','1','','2018-10-01','16:57:48','1','2018-10-21',0.19,NULL,NULL,NULL,NULL,NULL),(3029,'6417882',1,2,1,'74','32','http://app2.bsale.cl/view/15057/4ef4d19ca341.pdf?sfd=99','1','','2018-10-01','16:57:55','1','2018-10-21',0.19,NULL,NULL,NULL,NULL,NULL),(3030,'6375115',1,2,1,'75','33','http://app2.bsale.cl/view/15057/be37443f59bb.pdf?sfd=99','1','','2018-10-01','16:58:00','1','2018-10-21',0.19,NULL,NULL,NULL,NULL,NULL),(3031,'15514913',1,2,2,'76','34','http://app2.bsale.cl/view/15057/ac717548eae0.pdf?sfd=99','1','','2018-10-01','16:58:05','1','2018-10-21',0.19,NULL,NULL,NULL,NULL,NULL),(3036,'15250162',1000,1,1,'77','35','http://app2.bsale.cl/view/15057/b18ffaff9728.pdf?sfd=99','1','','2018-10-01','17:09:07','1','2018-10-21',0.19,'','1969-01-31',NULL,NULL,NULL),(3037,'6417882',1000,1,1,'78','36','http://app2.bsale.cl/view/15057/70a9a5de0ebf.pdf?sfd=99','1','','2018-10-01','17:09:21','1','2018-10-21',0.19,'','1969-01-31',NULL,NULL,NULL),(3038,'6375115',1000,1,1,'79','37','http://app2.bsale.cl/view/15057/8f9826bf740e.pdf?sfd=99','1','','2018-10-01','17:09:31','1','2018-10-21',0.19,'','1969-01-31',NULL,NULL,NULL),(3039,'78796670',1,2,1,'80','27','http://app2.bsale.cl/view/15057/91e988b39d94.pdf?sfd=99','1','','2018-10-01','17:18:13','2','2018-10-21',0.19,NULL,NULL,NULL,NULL,NULL),(3040,'10420529',1000,1,0,'0',NULL,'','0','','2018-10-03','10:15:46','2','2018-10-03',0.19,'','1969-01-31',NULL,NULL,NULL),(3043,'76521560',1,2,1,'81','28','http://app2.bsale.cl/view/15057/bb48b67c77df.pdf?sfd=99','1','','2018-10-03','12:09:27','2','2018-10-23',0.19,'','1970-01-31',NULL,NULL,NULL),(3044,'76243328',1,2,1,'82','29','http://app2.bsale.cl/view/15057/f5c41e6c1104.pdf?sfd=99','1','','2018-10-03','12:34:14','2','2018-10-23',0.19,'','1970-01-31',NULL,NULL,NULL),(3046,'6448076',1000,1,1,'83','38','http://app2.bsale.cl/view/15057/bd3310c90b6e.pdf?sfd=99','1','','2018-10-11','10:59:01','1','2018-10-31',0.19,'','1969-01-31',NULL,NULL,NULL),(3047,'12017636',1,2,1,'84','30','http://app2.bsale.cl/view/15057/881566ac763d.pdf?sfd=99','1','','2018-10-12','09:12:38','2','2018-11-01',0.19,NULL,NULL,NULL,NULL,NULL),(3048,'13825370',1,2,1,'85','31','http://app2.bsale.cl/view/15057/ed4c3def665f.pdf?sfd=99','1','','2018-10-12','09:12:43','2','2018-11-01',0.19,NULL,NULL,NULL,NULL,NULL),(3049,'76127546',1,2,1,'86','32','http://app2.bsale.cl/view/15057/521813419d17.pdf?sfd=99','1','','2018-10-12','09:12:48','2','2018-11-01',0.19,NULL,NULL,NULL,NULL,NULL),(3050,'76245945',1,2,1,'87','33','http://app2.bsale.cl/view/15057/17a87dc6ac6d.pdf?sfd=99','1','','2018-10-12','09:12:52','2','2018-11-01',0.19,NULL,NULL,NULL,NULL,NULL),(3051,'76830018',1,2,1,'88','34','http://app2.bsale.cl/view/15057/f3cd57d88a17.pdf?sfd=99','1','','2018-10-12','09:13:07','2','2018-11-01',0.19,NULL,NULL,NULL,NULL,NULL),(3052,'10420529',1,2,1,'89','35','http://app2.bsale.cl/view/15057/c00b7d00e7d6.pdf?sfd=99','1','','2018-10-12','09:13:12','2','2018-11-01',0.19,NULL,NULL,NULL,NULL,NULL),(3053,'76250727',1,2,1,'90','36','http://app2.bsale.cl/view/15057/620846201e39.pdf?sfd=99','1','','2018-10-12','09:13:18','2','2018-11-01',0.19,NULL,NULL,NULL,NULL,NULL),(3054,'86247400',4,2,1,'91','37','http://app2.bsale.cl/view/15057/7eae77148808.pdf?sfd=99','1','','2018-10-12','18:47:41','2','2018-10-20',0.19,'OST-199453','2018-09-26',NULL,NULL,NULL),(3056,'12713590',1,3,1,'92','39','http://app2.bsale.cl/view/15057/9470baffeb83.pdf?sfd=99','1','','2018-10-16','16:44:05','1','2018-10-23',0.19,'0','1970-01-31',NULL,NULL,NULL),(3057,'10858431',1,3,1,'93','40','http://app2.bsale.cl/view/15057/0c066f210730.pdf?sfd=99','1','','2018-10-16','16:46:21','1','2018-10-23',0.19,'0','1970-01-31',NULL,NULL,NULL),(3058,'6740725',1,2,0,'0',NULL,'','0','','2018-10-16','17:49:43','2','2018-10-16',0.19,NULL,NULL,NULL,NULL,NULL),(3060,'6740725',1000,1,1,'94','38','http://app2.bsale.cl/view/15057/c399d20533c9.pdf?sfd=99','1','','2018-10-16','18:01:58','2','2018-11-05',0.19,'','1969-01-31',NULL,NULL,NULL),(3061,'12713590',1,2,1,'95','41','http://app2.bsale.cl/view/15057/ed9634918388.pdf?sfd=99','1','','2018-10-17','10:10:40','1','2018-11-06',0.19,'','1970-01-31',NULL,NULL,NULL),(3062,'765666',1,2,1,'96','42','http://app2.bsale.cl/view/15057/f8b12db5b85f.pdf?sfd=99','1','','2018-10-17','10:10:56','1','2018-11-06',0.19,'','1970-01-31',NULL,NULL,NULL),(3063,'12713590',1000,1,2,'97','43','http://app2.bsale.cl/view/15057/b2f2166cb1bb.pdf?sfd=99','1','','2018-10-17','10:11:28','1','2018-11-06',0.19,'','1969-01-31',NULL,NULL,NULL),(3065,'15561394',1000,1,1,'99','39','http://app2.bsale.cl/view/15057/d6a7905288a4.pdf?sfd=99','1','','2018-10-17','13:49:24','2','2018-11-06',0.19,'','1969-01-31',NULL,NULL,NULL),(3067,'13825370',1000,1,1,'100','40','http://app2.bsale.cl/view/15057/8a9833a15689.pdf?sfd=99','1','','2018-10-18','09:04:34','2','2018-11-07',0.19,'','1969-01-31',NULL,NULL,NULL),(3070,'76911785',1000,1,1,'102','41','http://app2.bsale.cl/view/15057/1bc66c7620f6.pdf?sfd=99','1','','2018-10-23','17:03:16','2','2018-11-12',0.19,'','2018-10-22',NULL,NULL,NULL),(3071,'76911785',1000,1,1,'103','42','http://app2.bsale.cl/view/15057/cc07d7d3feac.pdf?sfd=99','1','','2018-10-23','17:04:03','2','2018-11-12',0.19,'','1969-01-31',NULL,NULL,NULL),(3072,'76460253',1000,1,1,'104','43','http://app2.bsale.cl/view/15057/e8135985a375.pdf?sfd=99','1','','2018-10-23','17:05:14','2','2018-11-12',0.19,'','1969-01-31',NULL,NULL,NULL),(3073,'8564327',1,3,1,'105','44','http://app2.bsale.cl/view/15057/a85940b41247.pdf?sfd=99','1','','2018-10-23','17:06:23','2','2018-10-30',0.19,'0','1970-01-31',NULL,NULL,NULL),(3074,'76911785',1,3,1,'106','45','http://app2.bsale.cl/view/15057/b33414b5c117.pdf?sfd=99','1','','2018-10-26','11:57:03','2','2018-11-02',0.19,'0','1970-01-31',NULL,NULL,NULL),(3075,'76466000',1,3,1,'107','46','http://app2.bsale.cl/view/15057/071c6669259c.pdf?sfd=99','1','','2018-10-26','11:57:18','2','2018-11-02',0.19,'0','1970-01-31',NULL,NULL,NULL),(3076,'76521560',1,3,1,'108','47','http://app2.bsale.cl/view/15057/51b529dd714a.pdf?sfd=99','1','','2018-10-26','11:57:28','2','2018-11-02',0.19,'0','1970-01-31',NULL,NULL,NULL),(3077,'15561394',1,3,1,'109','48','http://app2.bsale.cl/view/15057/4ffdd6719af6.pdf?sfd=99','1','','2018-10-26','11:57:46','2','2018-11-02',0.19,'0','1970-01-31',NULL,NULL,NULL),(3078,'10420529',1,3,1,'110','49','http://app2.bsale.cl/view/15057/5cbff105a75c.pdf?sfd=99','1','','2018-10-26','11:57:59','2','2018-11-02',0.19,'0','1970-01-31',NULL,NULL,NULL);
/*!40000 ALTER TABLE `facturas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `facturas_detalle`
--

DROP TABLE IF EXISTS `facturas_detalle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `facturas_detalle` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `FacturaId` int(11) NOT NULL,
  `Concepto` varchar(255) NOT NULL,
  `Valor` double(11,2) NOT NULL,
  `Descuento` float NOT NULL,
  `Cantidad` int(11) DEFAULT NULL,
  `Total` double DEFAULT NULL,
  `IdServicio` int(11) DEFAULT NULL,
  `Codigo` varchar(255) DEFAULT NULL,
  `documentDetailIdBsale` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4030 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `facturas_detalle`
--

LOCK TABLES `facturas_detalle` WRITE;
/*!40000 ALTER TABLE `facturas_detalle` DISABLE KEYS */;
INSERT INTO `facturas_detalle` VALUES (2699,2699,'	\r\nAnticipo Implementacion Conectividad XI Region',55970312.00,0,1,66604671,0,NULL,27),(3552,2825,'Arriendo de Equipos de Datos  - Mes Julio',27227.90,0,1,32401,666,'14638794-2BSMI01',29),(3553,2826,' Arriendo de Equipos de Datos  - Mes Julio',122525.55,0,1,145805,667,'12761640-KBSMI01',30),(3554,2826,'Arriendo de equipos de Telefonía IP - Mes Julio',13613.95,0,1,16201,668,'12761640-KBSMI02',31),(3555,2827,'Arriendo de Equipos de Datos  - Mes Julio',27227.90,0,1,32401,664,'6593446-9BSMI01',33),(3556,2827,'Arriendo de Equipos de Datos  - Mes Julio',27227.90,0,1,32401,665,'6593446-9BSMI02',33),(3557,2828,' Arriendo de Equipos de Datos  - Mes Julio',27227.90,0,1,32401,669,'5012355-3BSMI01',34),(3560,2831,'VISITA TÉCNICA CONFIGURACIÓN DE ROUTER',27228.00,0,1,32401,0,NULL,35),(3561,2832,'UPS INTERACTIVA',54456.00,0,1,64803,0,NULL,36),(3562,2833,'Arriendo de Equipos de Datos  - Mes Julio',40841.85,0,1,48602,670,'',37),(3628,2884,'Arriendo de Equipos de \r\n\r\nDatos  - Mes Julio - CENTRO PAILDAD',327029.40,0,1,389165,671,'86247400-7FSMI01',38),(3629,2884,'Arriendo de Equipos de \r\n\r\nDatos  - Mes Julio - CENTRO MORRO CHILCO',327029.40,0,1,389165,672,'86247400-7FSMI02',39),(3630,2884,'Arriendo de Equipos de \r\n\r\nDatos  - Mes Julio - CENTRO PUNTA PAULA',327029.40,0,1,389165,673,'86247400-7FSMI03',40),(3631,2884,'Arriendo de Equipos de \r\n\r\nDatos  - Mes Julio - CENTRO LILLE 1',327029.40,0,1,389165,674,'86247400-7FSMI04',41),(3632,2884,'Arriendo de Equipos de \r\n\r\nDatos  - Mes Julio - CENTRO LILLIE 2',327029.40,0,1,389165,675,'86247400-7FSMI05',42),(3633,2884,'Arriendo de Equipos de \r\n\r\nDatos  - Mes Julio - CENTRO YELCHO',327029.40,0,1,389165,676,'86247400-7FSMI06',43),(3634,2884,'Arriendo de Equipos de \r\n\r\nDatos  - Mes Julio - CENTRO PUNTA PELU',327029.40,0,1,389165,677,'86247400-7FSMI07',44),(3635,2884,'Arriendo de Equipos de \r\n\r\nDatos  - Mes Julio - CENTRO QUILQUE SUR',327029.40,0,1,389165,679,'86247400-7FSMI08',45),(3636,2884,'Arriendo de Equipos de \r\n\r\nDatos  - Mes Julio - CENTRO ABTAO',327029.40,0,1,389165,680,'86247400-7FSMI09',46),(3637,2884,'Arriendo de Equipos de \r\n\r\nDatos  - Mes Julio - CENTRO HUAPI',327029.40,0,1,389165,681,'86247400-7FSMI10',47),(3702,2895,'Arriendo de Equipos de Datos  - Mes Julio - CENTRO PAILDAD',327029.40,0,1,389165,671,'86247400-7FSMI01',48),(3703,2895,'Arriendo de Equipos de Datos  - Mes Julio - CENTRO MORRO CHILCO',327029.40,0,1,389165,672,'86247400-7FSMI02',49),(3704,2895,'Arriendo de Equipos de Datos  - Mes Julio - CENTRO PUNTA PAULA',327029.40,0,1,389165,673,'86247400-7FSMI03',50),(3705,2895,'Arriendo de Equipos de Datos  - Mes Julio - CENTRO LILLE 1',327029.40,0,1,389165,674,'86247400-7FSMI04',51),(3706,2895,'Arriendo de Equipos de Datos  - Mes Julio - CENTRO LILLIE 2',327029.40,0,1,389165,675,'86247400-7FSMI05',52),(3707,2895,'Arriendo de Equipos de Datos  - Mes Julio - CENTRO YELCHO',327029.40,0,1,389165,676,'86247400-7FSMI06',53),(3708,2895,'Arriendo de Equipos de Datos  - Mes Julio - CENTRO PUNTA PELU',327029.40,0,1,389165,677,'86247400-7FSMI07',54),(3709,2895,'Arriendo de Equipos de Datos  - Mes Julio - CENTRO QUILQUE SUR',327029.40,0,1,389165,679,'86247400-7FSMI08',55),(3710,2895,'Arriendo de Equipos de Datos  - Mes Julio - CENTRO ABTAO',327029.40,0,1,389165,680,'86247400-7FSMI09',56),(3711,2895,'Arriendo de Equipos de Datos  - Mes Julio - CENTRO HUAPI',327029.40,0,1,389165,681,'86247400-7FSMI10',57),(3724,2899,'VISITA TÉCNICA POR CÁMARA IP MAS INSTALACIÓN NVR',190792.00,0,1,227042,0,'',60),(3725,2899,'INSTALACIÓN Y HABILITACIÓN DE 5 CÁMARAS IP',597487.00,0,1,711010,0,'',61),(3728,2902,'Arriendo de Equipos de Datos  - Costo de instalación / Habilitación',218103.84,0,1,259544,686,'76830018-6FSMI01',72),(3734,2908,'Prueba Devolucion',27263.00,0,1,32443,0,'',73),(3740,2919,'Prueba Teledata',50000.00,0,1,59500,0,'',8),(3741,2920,'Prueba Boleta',1.00,0,1,1,0,'',28),(3742,2921,'Arriendo de Equipos de Datos ',23000.00,0,1,27370,0,'',22),(3743,2922,'VISITA TÉCNICA POR CÁMARA IP MAS INSTALACIÓN NVR',190792.00,0,1,227042,0,'',58),(3744,2922,'INSTALACIÓN Y HABILITACIÓN DE 5 CÁMARAS IP',597487.00,0,1,711010,0,'',59),(3855,2959,'Arriendo de Equipos de Datos  - Mes Agosto ',27298.00,0,1,32485,669,'5012355-3BSMI01',75),(3856,2960,'Arriendo de Equipos de Datos  - Mes Agosto ',27298.00,0,1,32485,666,'14638794-2BSMI01',76),(3857,2961,'Arriendo de Equipos de Datos  - Mes Agosto ',122841.00,0,1,146181,667,'12761640-KBSMI01',77),(3858,2961,'Arriendo de equipos de Telefonía IP - Mes Agosto ',13649.00,0,1,16242,668,'12761640-KBSMI02',78),(3859,2962,'Arriendo de Equipos de Datos  - Mes Agosto - CONEXION N°1',27298.00,0,1,32485,664,'6593446-9BSMI01',79),(3860,2962,'Arriendo de Equipos de Datos  - Mes Agosto - Conexion N° 2',27298.00,0,1,32485,665,'6593446-9BSMI02',80),(3861,2963,'Arriendo de Equipos de Datos  - Mes Agosto ',27298.00,0,1,32485,691,'76608219-KFSMI01',81),(3862,2964,'Arriendo de Equipos de Datos  - Mes Agosto ',40947.00,0,1,48727,670,'78796670-5FSMI01',82),(3867,2967,'Arriendo de Equipos de Datos  - Mes Agosto - CENTRO PAILDAD',327576.00,0,1,389815,671,'86247400-7FSMI01',83),(3868,2967,'Arriendo de Equipos de Datos  - Mes Agosto - CENTRO MORRO CHILCO',327576.00,0,1,389815,672,'86247400-7FSMI02',84),(3869,2967,'Arriendo de Equipos de Datos  - Mes Agosto - CENTRO PUNTA PAULA',327576.00,0,1,389815,673,'86247400-7FSMI03',85),(3870,2967,'Arriendo de Equipos de Datos  - Mes Agosto - CENTRO LILLE 1',327576.00,0,1,389815,674,'86247400-7FSMI04',86),(3871,2967,'Arriendo de Equipos de Datos  - Mes Agosto - CENTRO LILLIE 2',327576.00,0,1,389815,675,'86247400-7FSMI05',87),(3872,2967,'Arriendo de Equipos de Datos  - Mes Agosto - CENTRO YELCHO',327576.00,0,1,389815,676,'86247400-7FSMI06',88),(3873,2967,'Arriendo de Equipos de Datos  - Mes Agosto - CENTRO PUNTA PELU',327576.00,0,1,389815,677,'86247400-7FSMI07',89),(3874,2967,'Arriendo de Equipos de Datos  - Mes Agosto - CENTRO QUILQUE SUR',327576.00,0,1,389815,679,'86247400-7FSMI08',90),(3875,2967,'Arriendo de Equipos de Datos  - Mes Agosto - CENTRO ABTAO',327576.00,0,1,389815,680,'86247400-7FSMI09',91),(3876,2967,'Arriendo de Equipos de Datos  - Mes Agosto - CENTRO HUAPI',327576.00,0,1,389815,681,'86247400-7FSMI10',92),(3877,2968,'Arriendo de Equipos de Datos  - Mes Agosto ',27298.00,0,1,32485,683,'12017636-6FSMI01',93),(3878,2969,'Arriendo de Equipos de Datos  - Mes Agosto ',27298.00,0,1,32485,682,'13825370-8FSMI01',94),(3879,2970,'Arriendo de Equipos de Datos  - Proporcional Junio (17 Dias)',30890.09,0,1,36759,687,'76127546-1FSMI01',95),(3880,2970,'Arriendo de Equipos de Datos  - Mes Julio',54456.00,0,1,64803,687,'76127546-1FSMI01',96),(3881,2970,'Arriendo de Equipos de Datos  - Mes Agosto ',54596.00,0,1,64969,687,'76127546-1FSMI01',97),(3882,2971,'Arriendo de Equipos de Datos  - Mes Agosto ',54596.00,0,1,64969,690,'6448076-6BSMI01',98),(3883,2972,'Arriendo de Equipos de Datos  - Mes Agosto ',27298.00,0,1,32485,684,'17296156-8BSMI01',99),(3884,2973,'Arriendo de Equipos de Datos  - Mes Agosto ',27298.00,0,1,32485,685,'17520287-0BSMI01',100),(3890,2975,'Ducto plástico para cable de red desde Domicilio hasta cabaña',20760.00,0,1,24704,0,'',101),(3891,2975,'Cable de red 5e exterior con conectores blindados',33300.00,0,1,39627,0,'',102),(3892,2975,'Materiales(amarras, abrazaderas,fijaciones,sellos)',13200.00,0,1,15708,0,'',103),(3893,2975,'Router adicional como mayor desempeño y capacidad de manejo',65300.00,0,1,77707,0,'',104),(3894,2975,'Mano de Obra de trabajos',144000.00,0,1,171360,0,'',105),(3895,2976,'Arriendo de Equipos de Datos  - Mes Agosto ',27298.00,0,1,32485,688,'15250162-5BSMI01',107),(3896,2977,'Arriendo de Equipos de Datos  - Mes Agosto ',54596.00,0,1,64969,689,'76245945-0FSMI01',108),(3897,2978,'Arriendo de Equipos de Datos  - Proporcional Junio (2 Dias)',3635.06,0,1,4326,686,'76830018-6FSMI01',109),(3898,2978,'Arriendo de Equipos de Datos  - Mes Julio',54456.00,0,1,64803,686,'76830018-6FSMI01',110),(3899,2978,'Arriendo de Equipos de Datos  - Mes Agosto ',54596.00,0,1,64969,686,'76830018-6FSMI01',111),(3908,2985,'Instalación y habilitación enlace Internet',83193.00,0,1,99000,0,'',119),(3910,2987,'Arriendo de Equipos de Datos  - Costo de instalación / Habilitación',184913.04,0,1,220047,703,'15514913-2BSMI01',120),(3948,3014,'Visita Técnica, Cambio iluminador antena principal (1° junio)',40713.00,0,1,48448,0,'',121),(3949,3014,'Visita Técnica, cambio PoE y cable (04 julio)',27291.00,0,1,32476,0,'',122),(3950,3015,'Visita Técnica, Reconfiguración NVR (24 agosto)',27518.00,0,1,32746,0,'',123),(3951,3016,'Habilitación Servicio Internet',382074.00,0,1,454668,0,'',124),(3952,3016,'Red LAN, equipo emisor, equipo receptor, router WiFi',232003.00,0,1,276084,0,'',125),(3953,3017,'Habilitación Segundo Domicilio',163746.00,0,1,194858,0,'',126),(3954,3018,'Puente inalámbrico desde Oficina a nueva cabaña, más router WiFi',368429.00,0,1,438431,0,'',127),(3955,3019,'Arriendo de Equipos de Datos  - Mes Septiembre',27359.00,0,1,32557,666,'14638794-2BSMI01',128),(3956,3020,'Arriendo de Equipos de Datos  - Mes Septiembre',123115.50,0,1,146507,667,'12761640-KBSMI01',129),(3957,3020,'Arriendo de equipos de Telefonía IP - Mes Septiembre',13679.50,0,1,16279,668,'12761640-KBSMI02',130),(3958,3021,'Arriendo de Equipos de Datos  - Mes Septiembre',27359.00,0,1,32557,684,'17296156-8BSMI01',131),(3959,3022,'Arriendo de Equipos de Datos  - Mes Septiembre',27359.00,0,1,32557,691,'76608219-KFSMI01',132),(3960,3023,'Arriendo de Equipos de Datos  - Mes Septiembre',54718.00,0,1,65114,690,'6448076-6BSMI01',133),(3961,3024,'Arriendo de Equipos de Datos  - Mes Septiembre - CONEXION N°1',27359.00,0,1,32557,664,'6593446-9BSMI01',134),(3962,3024,'Arriendo de Equipos de Datos  - Mes Septiembre - Conexion N° 2',27359.00,0,1,32557,665,'6593446-9BSMI02',135),(3963,3025,'Arriendo de Equipos de Datos  - Mes Septiembre',27359.00,0,1,32557,669,'5012355-3BSMI01',136),(3964,3026,'Arriendo de Equipos de Datos  - Mes Septiembre',27359.00,0,1,32557,685,'17520287-0BSMI01',137),(3966,3028,'Arriendo de Equipos de Datos  - Mes Septiembre',27359.00,0,1,32557,688,'15250162-5BSMI01',138),(3967,3029,'Arriendo de Equipos de Datos  - Mes Septiembre',27359.00,0,1,32557,701,'6417882-2BSMI01',139),(3968,3030,'Arriendo de Equipos de Datos  - Mes Septiembre',27359.00,0,1,32557,700,'6375115-4BSMI01',140),(3969,3031,'Arriendo de Equipos de Datos  - Mes Septiembre',27359.00,0,1,32557,703,'15514913-2BSMI01',141),(3970,3031,'Arriendo de Equipos de Datos  - Proporcional Septiembre (18 Dias)',16415.40,0,1,19534,703,'15514913-2BSMI01',142),(3975,3036,'INSTALACIÓN Y HABILITACIÓN DE EQUIPOS DE DATOS',189076.00,0,1,225000,0,'',143),(3976,3037,'Costo de instalación / Habilitación de equipos de datos',323949.00,0,1,385499,0,'',144),(3977,3038,'INSTALACION Y HABILITACION DE EQUIPOS DE DATOS',326857.00,0,1,388960,0,'',145),(3978,3039,'Arriendo de Equipos de Datos  - Mes Septiembre',41038.50,0,1,48836,670,'78796670-5FSMI01',146),(3979,3040,'Habilitación Internet',186975.00,0,1,222500,0,'',NULL),(3982,3043,'Arriendo de Equipos de Datos  - Mes Septiembre',27359.00,0,1,32557,704,'76521560-9FSMI01',147),(3983,3044,'Arriendo de Equipos de Datos  - Mes Septiembre',68397.50,0,1,81393,706,'76243328-1FSMI01',148),(3985,3046,'Habilitación tercera Cabaña, 25 mts. de ducto, 45 mts. de cable, más materiales',297550.00,0,1,354085,0,'',149),(3986,3047,'Arriendo de Equipos de Datos  - Mes Septiembre',27359.00,0,1,32557,683,'12017636-6FSMI01',150),(3987,3048,'Arriendo de Equipos de Datos  - Mes Septiembre',27359.00,0,1,32557,682,'13825370-8FSMI01',151),(3988,3049,'Arriendo de Equipos de Datos  - Mes Septiembre',54718.00,0,1,65114,687,'76127546-1FSMI01',152),(3989,3050,'Arriendo de Equipos de Datos  - Mes Septiembre',54718.00,0,1,65114,689,'76245945-0FSMI01',153),(3990,3051,'Arriendo de Equipos de Datos  - Mes Septiembre',54718.00,0,1,65114,686,'76830018-6FSMI01',154),(3991,3052,'Arriendo de Equipos de Datos  - Mes Septiembre',27359.00,0,1,32557,707,'10420529-1FSMI01',155),(3992,3052,'Arriendo de Equipos de Datos  - Proporcional Octubre (29 Dias)',25597.65,0,1,30461,707,'10420529-1FSMI01',156),(3993,3053,'Arriendo de Equipos de Datos  - Mes Septiembre',27359.00,0,1,32557,702,'76250727-7FSMI01',157),(3994,3054,'Arriendo de Equipos de Datos  - Mes Septiembre - CENTRO PAILDAD',328311.00,0,1,390690,671,'86247400-7FSMI01',158),(3995,3054,'Arriendo de Equipos de Datos  - Mes Septiembre - CENTRO MORRO CHILCO',328311.00,0,1,390690,672,'86247400-7FSMI02',159),(3996,3054,'Arriendo de Equipos de Datos  - Mes Septiembre - CENTRO PUNTA PAULA',328311.00,0,1,390690,673,'86247400-7FSMI03',160),(3997,3054,'Arriendo de Equipos de Datos  - Mes Septiembre - CENTRO LILLE 1',328311.00,0,1,390690,674,'86247400-7FSMI04',161),(3998,3054,'Arriendo de Equipos de Datos  - Mes Septiembre - CENTRO LILLIE 2',328311.00,0,1,390690,675,'86247400-7FSMI05',162),(3999,3054,'Arriendo de Equipos de Datos  - Mes Septiembre - CENTRO YELCHO',328311.00,0,1,390690,676,'86247400-7FSMI06',163),(4000,3054,'Arriendo de Equipos de Datos  - Mes Septiembre - CENTRO PUNTA PELU',328311.00,0,1,390690,677,'86247400-7FSMI07',164),(4001,3054,'Arriendo de Equipos de Datos  - Mes Septiembre - CENTRO QUILQUE SUR',328311.00,0,1,390690,679,'86247400-7FSMI08',165),(4002,3054,'Arriendo de Equipos de Datos  - Mes Septiembre - CENTRO ABTAO',328311.00,0,1,390690,680,'86247400-7FSMI09',166),(4003,3054,'Arriendo de Equipos de Datos  - Mes Septiembre - CENTRO HUAPI',328311.00,0,1,390690,681,'86247400-7FSMI10',167),(4005,3056,'Arriendo de Equipos de Datos  - Costo de instalación / Habilitación',191241.30,0,1,227577,710,'12713590-8BSMI01',168),(4006,3057,'Arriendo de Equipos de Datos  - Costo de instalación / Habilitación',191241.30,0,1,227577,711,'10858431-9BSMI01',169),(4007,3058,'Arriendo de Equipos de Datos  - Proporcional Octubre (19 Dias)',16768.58,0,1,19955,712,'6740725-3FSMI01',NULL),(4009,3060,'Habilitación e Instalación',189076.00,0,1,225000,0,'',170),(4010,3061,'Arriendo de Equipos de Datos  - Proporcional Septiembre (2 Dias)',1824.20,0,1,2171,710,'12713590-8BSMI01',171),(4011,3062,'Arriendo de Equipos de Datos  - Mes Septiembre',27359.00,0,1,32557,705,'765666-1BSMI01',172),(4012,3063,'Habilitación Servicio Internet',191596.00,0,1,227999,0,'',173),(4014,3065,'habilitación Servicio de Internet',191596.00,0,1,227999,0,'',175),(4016,3067,'HABILITACION SERVICIO INTERNET',189075.00,0,1,224999,0,'',176),(4020,3070,'Red LAN, Equipo Base + Equipo Receptor',245619.00,0,1,292287,0,'',178),(4021,3070,'UPS en línea',354783.00,0,1,422192,0,'',179),(4022,3071,'Access Point WiFi (Pintura), Access Point WiFi (Cabos), Cable Cat5e, Materiales: Fijaciones, amarras',367160.00,0,1,436920,0,'',180),(4023,3072,'Habilitación Servicio Internet',218487.00,0,1,260000,0,'',181),(4024,3073,'Arriendo de Equipos de Datos  - Costo de instalación / Habilitación',191514.89,0,1,227903,719,'8564327-4FSMI01',182),(4025,3074,'Arriendo de Equipos de Datos  - Costo de instalación / Habilitación',1091361.28,0,1,1298720,717,'76911785-7FSMI01',NULL),(4026,3075,'Arriendo de Equipos de Datos  - Costo de instalación / Habilitación',273592.70,0,1,325575,718,'76466000-5FSMI01',NULL),(4027,3076,'Arriendo de Equipos de Datos  - Costo de instalación / Habilitación',382482.59,0,1,455154,704,'76521560-9FSMI01',NULL),(4028,3077,'Arriendo de Equipos de Datos  - Costo de instalación / Habilitación',191514.89,0,1,227903,715,'15561394-7FSMI01',NULL),(4029,3078,'Arriendo de Equipos de Datos  - Costo de instalación / Habilitación',186863.81,0,1,222368,707,'10420529-1FSMI01',NULL);
/*!40000 ALTER TABLE `facturas_detalle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `facturas_pagos`
--

DROP TABLE IF EXISTS `facturas_pagos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `facturas_pagos` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `FacturaId` int(11) NOT NULL,
  `FechaPago` date NOT NULL,
  `TipoPago` int(11) NOT NULL,
  `Detalle` varchar(255) DEFAULT NULL,
  `Monto` double(11,2) DEFAULT NULL,
  `FechaEmisionCheque` date DEFAULT NULL,
  `FechaVencimientoCheque` date DEFAULT NULL,
  `IdUsuarioSession` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `facturas_pagos`
--

LOCK TABLES `facturas_pagos` WRITE;
/*!40000 ALTER TABLE `facturas_pagos` DISABLE KEYS */;
INSERT INTO `facturas_pagos` VALUES (1,2699,'2018-07-06',2,'',66604671.00,'1969-01-31','1969-01-31',104),(3,2825,'2018-09-05',8,'CONVENIO PAC',32401.00,'1969-01-31','1969-01-31',109),(4,2826,'2018-08-14',8,'CONVENIO PAC',162006.00,'1969-01-31','1969-01-31',109),(5,2833,'2018-08-14',8,'CONVENIO PAC',48602.00,'1969-01-31','1969-01-31',109),(6,2920,'2018-08-13',8,'EFECTIVO',1.00,'1969-01-31','1969-01-31',109),(7,2832,'2018-08-14',8,'CONVENIO PAC',64803.00,'1969-01-31','1969-01-31',109),(8,2828,'2018-08-24',8,'CONVENIO PAC',32401.00,'1969-01-31','1969-01-31',109),(9,2960,'2018-09-11',8,'CONVENIO PAC',32485.00,'1969-01-31','1969-01-31',109),(10,2961,'2018-09-11',8,'CONVENIO PAC',162423.00,'1969-01-31','1969-01-31',109),(11,2964,'2018-09-11',8,'CONVENIO PAC',48727.00,'1969-01-31','1969-01-31',109),(12,2962,'2018-09-11',8,'CONVENIO PAC',64970.00,'1969-01-31','1969-01-31',109),(13,2959,'2018-09-11',8,'CONVENIO PAC',32485.00,'1969-01-31','1969-01-31',109),(15,2985,'2018-09-28',1,'00000000000018818099',99000.00,'1969-01-31','1969-01-31',109),(16,2972,'2018-09-28',1,'00000000000018818099',32485.00,'1969-01-31','1969-01-31',109),(17,2969,'2018-09-28',1,'00000000000018818099',32485.00,'1969-01-31','1969-01-31',109),(18,2973,'2018-09-28',1,'00000000000018818099',32370.00,'1969-01-31','1969-01-31',109),(19,2902,'2018-09-28',1,'00000000000018818099',258293.00,'1969-01-31','1969-01-31',109),(20,2977,'2018-10-01',1,'TRASPASO DE:IDANMAPU S A',64969.00,'1969-01-31','1969-01-31',109),(22,2967,'2018-10-05',1,'PAGO:PROVEEDORES 0862474007',3898150.00,'1969-01-31','1969-01-31',117),(23,2884,'2018-10-05',1,'PAGO:PROVEEDORES 0862474007',3891650.00,'1969-01-31','1969-01-31',117),(24,3019,'2018-10-05',9,'',32557.00,'1969-01-31','1969-01-31',117),(25,3015,'2018-10-09',1,'TRASPASO DE:RODRIGO CHICHARRO SAENZ',32746.00,'1969-01-31','1969-01-31',117),(26,3020,'2018-10-05',9,'',162786.00,'1969-01-31','1969-01-31',117),(27,3039,'2018-10-05',9,'',48836.00,'1969-01-31','1969-01-31',117),(28,3024,'2018-10-05',9,'',65114.00,'1969-01-31','1969-01-31',117),(29,3025,'2018-10-05',9,'',32557.00,'1969-01-31','1969-01-31',117),(36,3043,'2018-10-16',1,'transpaso de Servicios Integrales del Sur',32557.00,'1969-01-31','1969-01-31',109),(45,2978,'2018-10-25',1,'',134098.00,'1969-01-31','1969-01-31',117),(48,3075,'2018-10-23',1,'',326000.00,'1969-01-31','1969-01-31',117);
/*!40000 ALTER TABLE `facturas_pagos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `giros`
--

DROP TABLE IF EXISTS `giros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `giros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `giros`
--

LOCK TABLES `giros` WRITE;
/*!40000 ALTER TABLE `giros` DISABLE KEYS */;
INSERT INTO `giros` VALUES (1,'AGRICULTURA, GANADERÍA, CAZA Y SILVICULTURA'),(2,'PESCA '),(3,'EXPLOTACIÓN DE MINAS Y CANTERAS '),(4,'INDUSTRIAS MANUFACTURERAS NO METÁLICAS '),(5,'INDUSTRIAS MANUFACTURERAS METÁLICAS '),(6,'SUMINISTRO DE ELECTRICIDAD, GAS Y AGUA '),(7,'CONSTRUCCIÓN'),(8,'COMERCIO AL POR MAYOR Y MENOR; REP. VEHÍCULOS AUTOMOTORES/ENSERES DOMÉSTICOS '),(9,'HOTELES Y RESTAURANTES '),(10,'TRANSPORTE, ALMACENAMIENTO Y COMUNICACIONES'),(11,'INTERMEDIACIÓN FINANCIERA '),(12,'ACTIVIDADES INMOBILIARIAS, EMPRESARIALES Y DE ALQUILER '),(13,'ADM. PÚBLICA Y DEFENSA; PLANES DE SEG. SOCIAL, AFILIACIÓN OBLIGATORIA'),(14,'ENSEÑANZA '),(15,'SERVICIOS SOCIALES Y DE SALUD'),(16,'OTRAS ACTIVIDADES DE SERVICIOS COMUNITARIAS, SOCIALES Y PERSONALES'),(17,'CONSEJO DE ADMINISTRACIÓN DE EDIFICIOS Y CONDOMINIOS'),(18,'ORGANIZACIONES Y ÓRGANOS EXTRATERRITORIALES '),(24,'PRUEBA'),(25,'ACUICOLA'),(26,'INFORMATICA'),(27,'SIN GIRO, PERSONA NATURAL'),(28,'TELECOMUNICACIONES'),(29,'VENTA DE  TEXTILES Y OTROS'),(30,'INVERSIONES Y ARQUITECTURA'),(31,'CULTIVOS MARINOS, PROCESADORA DE PRODUCTOS DEL MAR'),(32,'TRANSPORTE MARÍTIMO'),(33,'MAQUINARIA ENTRETENIMIENTO'),(34,'ACT. DE ASESORAMIENTO EMPRESARIAL'),(35,'COMPRA VENTA Y ALQUILER DE INMOBILIARIOS PROPIOS Y ARRIENDOS'),(36,'INMOBILIARIA'),(37,'APICULTURA'),(38,'AGRICOLA'),(39,'SERVICIOS'),(40,'EXPLOTACIóN MIXTA'),(41,'ARRIENDO DE INMUEBLES'),(42,'INVERSIONES Y ASESORIAS'),(43,'HOTELERIA'),(44,'EMPRESARIO'),(45,'TALLER DE REDES'),(46,'CULTIVOS HIDROPóNICOS E INVERNADEROS'),(47,'APICULTURA Y HORTALIZAS');
/*!40000 ALTER TABLE `giros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grupo_servicio`
--

DROP TABLE IF EXISTS `grupo_servicio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grupo_servicio` (
  `IdGrupo` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(150) DEFAULT NULL,
  `EsOC` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdGrupo`)
) ENGINE=InnoDB AUTO_INCREMENT=1002 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupo_servicio`
--

LOCK TABLES `grupo_servicio` WRITE;
/*!40000 ALTER TABLE `grupo_servicio` DISABLE KEYS */;
INSERT INTO `grupo_servicio` VALUES (1,'Grupo 1',0),(2,'Grupo 2',0),(3,'ANUAL',0),(4,'GP1 Con OC',1),(5,'GP2 Con OC',1),(6,'GP3 Con OC',1),(1000,'Sin Grupo',0),(1001,'Sin Grupo Con OC',1);
/*!40000 ALTER TABLE `grupo_servicio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventario_egresos`
--

DROP TABLE IF EXISTS `inventario_egresos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventario_egresos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `destino_tipo` int(11) NOT NULL,
  `destino_id` int(11) NOT NULL,
  `fecha_movimiento` date NOT NULL,
  `hora_movimiento` time NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventario_egresos`
--

LOCK TABLES `inventario_egresos` WRITE;
/*!40000 ALTER TABLE `inventario_egresos` DISABLE KEYS */;
/*!40000 ALTER TABLE `inventario_egresos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventario_ingresos`
--

DROP TABLE IF EXISTS `inventario_ingresos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventario_ingresos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_compra` date NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `numero_factura` int(11) NOT NULL,
  `numero_serie` varchar(50) NOT NULL,
  `mac_address` varchar(50) NOT NULL,
  `modelo_producto_id` int(11) NOT NULL,
  `proveedor_id` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  `valor` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `bodega_tipo` int(11) NOT NULL DEFAULT '1',
  `bodega_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventario_ingresos`
--

LOCK TABLES `inventario_ingresos` WRITE;
/*!40000 ALTER TABLE `inventario_ingresos` DISABLE KEYS */;
/*!40000 ALTER TABLE `inventario_ingresos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log_login`
--

DROP TABLE IF EXISTS `log_login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log_login` (
  `IdLogLogin` int(11) NOT NULL AUTO_INCREMENT,
  `IdUsuario` int(11) DEFAULT NULL,
  `Usuario` varchar(150) DEFAULT NULL,
  `Fecha` datetime DEFAULT NULL,
  `Proceso` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`IdLogLogin`)
) ENGINE=InnoDB AUTO_INCREMENT=1167 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log_login`
--

LOCK TABLES `log_login` WRITE;
/*!40000 ALTER TABLE `log_login` DISABLE KEYS */;
INSERT INTO `log_login` VALUES (519,109,'katherine','2018-07-31 17:29:51','CORRECTO'),(520,105,'oswaldo','2018-07-31 17:51:00','CORRECTO'),(521,105,'oswaldo','2018-08-02 11:32:05','CORRECTO'),(522,105,'oswaldo','2018-08-02 14:56:33','CORRECTO'),(523,1,'lponce','2018-08-02 15:48:57','CORRECTO'),(524,0,'katherine','2018-08-02 17:51:31','INCORRECTO'),(525,0,'katherine','2018-08-02 17:51:33','INCORRECTO'),(526,109,'katherine','2018-08-02 17:51:39','CORRECTO'),(527,105,'oswaldo','2018-08-03 15:16:08','CORRECTO'),(528,0,'katherine','2018-08-06 09:36:05','INCORRECTO'),(529,109,'katherine','2018-08-06 09:36:09','CORRECTO'),(530,105,'oswaldo','2018-08-06 09:51:11','CORRECTO'),(531,105,'oswaldo','2018-08-06 11:14:51','CORRECTO'),(532,105,'oswaldo','2018-08-07 10:05:55','CORRECTO'),(533,0,'katherine','2018-08-07 11:42:03','INCORRECTO'),(534,109,'katherine','2018-08-07 11:42:13','CORRECTO'),(535,0,'katherine','2018-08-07 12:21:31','INCORRECTO'),(536,0,'katherine','2018-08-07 12:21:37','INCORRECTO'),(537,109,'katherine','2018-08-07 12:21:43','CORRECTO'),(538,105,'oswaldo','2018-08-07 13:01:37','CORRECTO'),(539,110,'cjurgens','2018-08-08 11:36:41','CORRECTO'),(540,109,'katherine','2018-08-08 11:37:18','CORRECTO'),(541,110,'cjurgens','2018-08-08 12:18:52','CORRECTO'),(542,105,'oswaldo','2018-08-08 13:17:24','CORRECTO'),(543,109,'katherine','2018-08-08 15:26:56','CORRECTO'),(544,110,'cjurgens','2018-08-08 15:30:35','CORRECTO'),(545,105,'oswaldo','2018-08-08 16:16:51','CORRECTO'),(546,109,'katherine','2018-08-08 16:53:06','CORRECTO'),(547,107,'rberndt','2018-08-09 09:30:25','CORRECTO'),(548,105,'oswaldo','2018-08-09 10:25:36','CORRECTO'),(549,105,'oswaldo','2018-08-09 12:21:00','CORRECTO'),(550,105,'oswaldo','2018-08-10 09:24:01','CORRECTO'),(551,105,'oswaldo','2018-08-10 09:49:30','CORRECTO'),(552,105,'oswaldo','2018-08-10 17:19:42','CORRECTO'),(553,107,'rberndt','2018-08-13 09:27:01','CORRECTO'),(554,109,'katherine','2018-08-13 09:56:25','CORRECTO'),(555,105,'oswaldo','2018-08-13 10:04:14','CORRECTO'),(556,105,'oswaldo','2018-08-13 14:41:30','CORRECTO'),(557,1,'lponce','2018-08-13 16:19:25','CORRECTO'),(558,110,'cjurgens','2018-08-14 10:16:06','CORRECTO'),(559,109,'katherine','2018-08-14 10:18:45','CORRECTO'),(560,109,'katherine','2018-08-14 10:33:00','CORRECTO'),(561,110,'cjurgens','2018-08-14 10:48:48','CORRECTO'),(562,110,'cjurgens','2018-08-14 11:40:59','CORRECTO'),(563,105,'oswaldo','2018-08-14 12:40:20','CORRECTO'),(564,109,'KATHERINE','2018-08-14 12:49:20','CORRECTO'),(565,109,'katherine','2018-08-14 13:06:05','CORRECTO'),(566,105,'oswaldo','2018-08-14 13:20:11','CORRECTO'),(567,110,'cjurgens','2018-08-14 14:38:48','CORRECTO'),(568,105,'oswaldo','2018-08-14 15:13:45','CORRECTO'),(569,109,'katherine','2018-08-14 15:26:09','CORRECTO'),(570,110,'cjurgens','2018-08-14 15:30:48','CORRECTO'),(571,105,'oswaldo','2018-08-14 15:57:14','CORRECTO'),(572,110,'cjurgens','2018-08-14 16:21:23','CORRECTO'),(573,105,'oswaldo','2018-08-14 16:42:20','CORRECTO'),(574,110,'cjurgens','2018-08-14 17:13:30','CORRECTO'),(575,0,'katherine','2018-08-14 17:37:43','INCORRECTO'),(576,109,'katherine','2018-08-14 17:37:47','CORRECTO'),(577,104,'fran','2018-08-16 08:14:34','CORRECTO'),(578,105,'oswaldo','2018-08-16 11:42:07','CORRECTO'),(579,104,'fran','2018-08-16 15:09:08','CORRECTO'),(580,107,'rberndt','2018-08-17 09:49:14','CORRECTO'),(581,104,'fran','2018-08-17 15:36:53','CORRECTO'),(582,110,'cjurgens','2018-08-17 15:58:27','CORRECTO'),(583,110,'cjurgens','2018-08-20 09:12:27','CORRECTO'),(584,105,'oswaldo','2018-08-20 10:39:33','CORRECTO'),(585,105,'oswaldo','2018-08-20 14:48:49','CORRECTO'),(586,105,'oswaldo','2018-08-20 16:18:13','CORRECTO'),(587,0,'fran','2018-08-20 16:26:46','INCORRECTO'),(588,104,'fran','2018-08-20 16:26:51','CORRECTO'),(589,110,'cjurgens','2018-08-20 16:28:06','CORRECTO'),(590,110,'cjurgens','2018-08-20 16:54:09','CORRECTO'),(591,109,'katherine','2018-08-20 16:55:20','CORRECTO'),(592,110,'cjurgens','2018-08-20 16:58:26','CORRECTO'),(593,110,'cjurgens','2018-08-20 16:59:21','CORRECTO'),(594,110,'cjurgens','2018-08-20 18:03:09','CORRECTO'),(595,105,'oswaldo','2018-08-20 18:35:08','CORRECTO'),(596,109,'katherine','2018-08-21 10:17:14','CORRECTO'),(597,105,'oswaldo','2018-08-21 11:29:54','CORRECTO'),(598,110,'cjurgens','2018-08-21 11:42:49','CORRECTO'),(599,110,'cjurgens','2018-08-21 12:36:20','CORRECTO'),(600,105,'oswaldo','2018-08-21 14:32:07','CORRECTO'),(601,110,'cjurgens','2018-08-21 14:37:38','CORRECTO'),(602,109,'katherine','2018-08-21 16:28:27','CORRECTO'),(603,105,'oswaldo','2018-08-21 16:31:40','CORRECTO'),(604,110,'cjurgens','2018-08-21 16:37:41','CORRECTO'),(605,110,'cjurgens','2018-08-21 17:41:05','CORRECTO'),(606,105,'oswaldo','2018-08-21 17:41:45','CORRECTO'),(607,105,'oswaldo','2018-08-21 18:10:08','CORRECTO'),(608,109,'katherine','2018-08-21 18:54:15','CORRECTO'),(609,110,'cjurgens','2018-08-22 09:57:25','CORRECTO'),(610,0,'katherine','2018-08-22 10:30:54','INCORRECTO'),(611,0,'katherine','2018-08-22 10:31:03','INCORRECTO'),(612,109,'katherine','2018-08-22 10:31:11','CORRECTO'),(613,106,'rmontoya','2018-08-22 11:30:21','CORRECTO'),(614,109,'KATHERINE','2018-08-22 11:31:59','CORRECTO'),(615,108,'esalas','2018-08-22 12:32:21','CORRECTO'),(616,109,'katherine','2018-08-22 12:41:53','CORRECTO'),(617,110,'cjurgens','2018-08-22 12:48:46','CORRECTO'),(618,108,'esalas','2018-08-22 12:55:53','CORRECTO'),(619,109,'katherine','2018-08-22 12:58:11','CORRECTO'),(620,104,'fran','2018-08-22 13:52:16','CORRECTO'),(621,109,'katherine','2018-08-22 15:40:02','CORRECTO'),(622,105,'oswaldo','2018-08-22 15:46:51','CORRECTO'),(623,105,'oswaldo','2018-08-22 15:56:33','CORRECTO'),(624,110,'cjurgens','2018-08-22 16:45:38','CORRECTO'),(625,108,'esalas','2018-08-22 16:55:53','CORRECTO'),(626,109,'katherine','2018-08-22 17:18:45','CORRECTO'),(627,105,'oswaldo','2018-08-22 17:20:42','CORRECTO'),(628,110,'cjurgens','2018-08-22 17:46:48','CORRECTO'),(629,105,'oswaldo','2018-08-23 09:07:18','CORRECTO'),(630,108,'esalas','2018-08-23 09:30:51','CORRECTO'),(631,105,'oswaldo','2018-08-23 10:28:55','CORRECTO'),(632,108,'esalas','2018-08-23 11:53:25','CORRECTO'),(633,105,'oswaldo','2018-08-23 12:46:13','CORRECTO'),(634,105,'oswaldo','2018-08-23 15:44:40','CORRECTO'),(635,109,'katherine','2018-08-23 16:53:06','CORRECTO'),(636,105,'oswaldo','2018-08-24 09:22:20','CORRECTO'),(637,108,'esalas','2018-08-24 09:51:47','CORRECTO'),(638,105,'oswaldo','2018-08-24 12:01:09','CORRECTO'),(639,0,'katherine','2018-08-24 11:38:17','INCORRECTO'),(640,109,'katherine','2018-08-24 11:38:23','CORRECTO'),(641,109,'katherine','2018-08-24 13:02:08','CORRECTO'),(642,108,'esalas','2018-08-24 13:02:10','CORRECTO'),(643,105,'oswaldo','2018-08-24 14:21:11','CORRECTO'),(644,109,'katherine','2018-08-24 15:09:28','CORRECTO'),(645,105,'oswaldo','2018-08-24 15:10:01','CORRECTO'),(646,105,'oswaldo','2018-08-24 15:10:02','CORRECTO'),(647,108,'esalas','2018-08-24 15:56:43','CORRECTO'),(648,105,'oswaldo','2018-08-24 18:09:16','CORRECTO'),(649,106,'rmontoya','2018-08-27 10:09:17','CORRECTO'),(650,116,'dangel','2018-08-27 10:11:56','CORRECTO'),(651,108,'esalas','2018-08-27 10:11:54','CORRECTO'),(652,108,'esalas','2018-08-27 10:36:20','CORRECTO'),(653,109,'katherine','2018-08-27 11:14:36','CORRECTO'),(654,104,'fran','2018-08-27 11:52:05','CORRECTO'),(655,108,'esalas','2018-08-27 12:37:44','CORRECTO'),(656,104,'fran','2018-08-27 12:42:20','CORRECTO'),(657,109,'katherine','2018-08-27 13:25:17','CORRECTO'),(658,108,'esalas','2018-08-27 13:38:28','CORRECTO'),(659,108,'esalas','2018-08-27 15:34:28','CORRECTO'),(660,109,'katherine','2018-08-27 17:53:09','CORRECTO'),(661,109,'katherine','2018-08-27 18:14:23','CORRECTO'),(662,110,'cjurgens','2018-08-27 18:22:48','CORRECTO'),(663,109,'katherine','2018-08-28 08:44:07','CORRECTO'),(664,110,'cjurgens','2018-08-28 09:59:14','CORRECTO'),(665,110,'cjurgens','2018-08-28 10:13:15','CORRECTO'),(666,0,'oswaldo','2018-08-28 11:57:52','INCORRECTO'),(667,105,'oswaldo','2018-08-28 11:57:58','CORRECTO'),(668,105,'oswaldo','2018-08-28 12:02:51','CORRECTO'),(669,116,'dangel','2018-08-28 12:06:39','CORRECTO'),(670,108,'esalas','2018-08-28 12:35:08','CORRECTO'),(671,110,'cjurgens','2018-08-28 16:06:09','CORRECTO'),(672,107,'rberndt','2018-08-28 17:43:20','CORRECTO'),(673,116,'dangel','2018-08-28 19:41:01','CORRECTO'),(674,116,'dangel','2018-08-28 20:00:46','CORRECTO'),(675,116,'dangel','2018-08-29 02:43:32','CORRECTO'),(676,0,'cjurgens','2018-08-29 09:07:25','INCORRECTO'),(677,0,'cjurgens','2018-08-29 09:07:36','INCORRECTO'),(678,110,'cjurgens','2018-08-29 09:08:10','CORRECTO'),(679,109,'katherine','2018-08-29 10:24:31','CORRECTO'),(680,105,'oswaldo','2018-08-29 10:35:27','CORRECTO'),(681,105,'oswaldo','2018-08-29 11:58:22','CORRECTO'),(682,110,'cjurgens','2018-08-29 12:40:57','CORRECTO'),(683,109,'katherine','2018-08-29 14:53:02','CORRECTO'),(684,110,'cjurgens','2018-08-29 14:57:02','CORRECTO'),(685,110,'cjurgens','2018-08-29 17:57:22','CORRECTO'),(686,105,'orodriguez','2018-08-29 17:57:30','CORRECTO'),(687,107,'rberndt','2018-08-29 18:18:52','CORRECTO'),(688,110,'cjurgens','2018-08-30 10:04:45','CORRECTO'),(689,110,'cjurgens','2018-08-30 10:49:49','CORRECTO'),(690,108,'esalas','2018-08-30 11:51:31','CORRECTO'),(691,110,'cjurgens','2018-08-30 13:10:38','CORRECTO'),(692,108,'esalas','2018-08-30 13:38:56','CORRECTO'),(693,105,'orodriguez','2018-08-30 16:55:34','CORRECTO'),(694,0,'cjurgens','2018-08-30 17:02:46','INCORRECTO'),(695,110,'cjurgens','2018-08-30 17:02:56','CORRECTO'),(696,108,'esalas','2018-08-30 17:12:55','CORRECTO'),(697,110,'cjurgens','2018-08-30 17:34:07','CORRECTO'),(698,105,'orodriguez','2018-08-30 21:23:33','CORRECTO'),(699,116,'dangel','2018-08-30 21:44:30','CORRECTO'),(700,116,'dangel','2018-08-30 21:48:24','CORRECTO'),(701,116,'dangel','2018-08-30 23:25:02','CORRECTO'),(702,116,'dangel','2018-08-30 23:26:08','CORRECTO'),(703,116,'dangel','2018-08-30 23:29:24','CORRECTO'),(704,116,'dangel','2018-08-31 00:06:27','CORRECTO'),(705,116,'dangel','2018-08-31 00:44:26','CORRECTO'),(706,116,'dangel','2018-08-31 01:06:45','CORRECTO'),(707,105,'orodriguez','2018-08-31 10:07:30','CORRECTO'),(708,108,'esalas','2018-08-31 11:04:32','CORRECTO'),(709,108,'esalas','2018-08-31 11:21:07','CORRECTO'),(710,116,'dangel','2018-08-31 11:59:41','CORRECTO'),(711,116,'dangel','2018-08-31 12:00:19','CORRECTO'),(712,116,'dangel','2018-08-31 12:01:28','CORRECTO'),(713,116,'dangel','2018-08-31 12:14:56','CORRECTO'),(714,0,'esalas','2018-08-31 12:44:10','INCORRECTO'),(715,108,'esalas','2018-08-31 12:44:21','CORRECTO'),(716,105,'orodriguez','2018-08-31 14:44:27','CORRECTO'),(717,105,'orodriguez','2018-08-31 15:05:13','CORRECTO'),(718,105,'orodriguez','2018-08-31 16:09:19','CORRECTO'),(719,116,'dangel','2018-08-31 18:38:29','CORRECTO'),(720,110,'cjurgens','2018-09-03 09:07:00','CORRECTO'),(721,110,'cjurgens','2018-09-03 10:14:48','CORRECTO'),(722,107,'rberndt','2018-09-03 12:33:21','CORRECTO'),(723,108,'esalas','2018-09-03 13:55:24','CORRECTO'),(724,105,'orodriguez','2018-09-03 14:15:51','CORRECTO'),(725,105,'orodriguez','2018-09-03 15:51:26','CORRECTO'),(726,0,'katherine','2018-09-03 16:33:58','INCORRECTO'),(727,109,'katherine','2018-09-03 16:34:06','CORRECTO'),(728,105,'orodriguez','2018-09-03 17:26:09','CORRECTO'),(729,105,'orodriguez','2018-09-03 17:32:42','CORRECTO'),(730,0,'katherine','2018-09-04 09:01:44','INCORRECTO'),(731,0,'katherine','2018-09-04 09:01:48','INCORRECTO'),(732,109,'katherine','2018-09-04 09:01:54','CORRECTO'),(733,110,'cjurgens','2018-09-04 09:02:31','CORRECTO'),(734,110,'cjurgens','2018-09-04 09:05:05','CORRECTO'),(735,105,'orodriguez','2018-09-04 09:10:07','CORRECTO'),(736,110,'cjurgens','2018-09-04 09:20:13','CORRECTO'),(737,105,'orodriguez','2018-09-04 10:25:06','CORRECTO'),(738,109,'katherine','2018-09-04 09:41:53','CORRECTO'),(739,105,'orodriguez','2018-09-04 09:54:33','CORRECTO'),(740,107,'rberndt','2018-09-04 10:32:48','CORRECTO'),(741,105,'orodriguez','2018-09-04 11:04:39','CORRECTO'),(742,105,'orodriguez','2018-09-04 12:07:54','CORRECTO'),(743,105,'orodriguez','2018-09-04 13:16:03','CORRECTO'),(744,108,'esalas','2018-09-04 12:27:57','CORRECTO'),(745,104,'fran','2018-09-04 12:55:10','CORRECTO'),(746,105,'orodriguez','2018-09-04 14:25:29','CORRECTO'),(747,105,'orodriguez','2018-09-04 16:17:50','CORRECTO'),(748,105,'orodriguez','2018-09-04 17:23:54','CORRECTO'),(749,108,'esalas','2018-09-04 16:44:26','CORRECTO'),(750,110,'cjurgens','2018-09-05 08:59:25','CORRECTO'),(751,105,'orodriguez','2018-09-05 09:13:58','CORRECTO'),(752,105,'orodriguez','2018-09-05 10:21:59','CORRECTO'),(753,105,'orodriguez','2018-09-05 12:45:17','CORRECTO'),(754,108,'esalas','2018-09-05 13:36:29','CORRECTO'),(755,105,'orodriguez','2018-09-05 17:22:43','CORRECTO'),(756,105,'orodriguez','2018-09-05 16:30:37','CORRECTO'),(757,110,'cjurgens','2018-09-05 18:13:02','CORRECTO'),(758,0,'katherine','2018-09-05 18:13:53','INCORRECTO'),(759,0,'katherine','2018-09-05 18:13:54','INCORRECTO'),(760,109,'katherine','2018-09-05 18:13:59','CORRECTO'),(761,110,'cjurgens','2018-09-05 18:20:51','CORRECTO'),(762,105,'orodriguez','2018-09-05 18:27:42','CORRECTO'),(763,108,'esalas','2018-09-06 09:57:33','CORRECTO'),(764,110,'cjurgens','2018-09-06 10:00:20','CORRECTO'),(765,109,'katherine','2018-09-06 10:09:04','CORRECTO'),(766,105,'orodriguez','2018-09-06 11:20:31','CORRECTO'),(767,0,'fran','2018-09-06 10:43:23','INCORRECTO'),(768,104,'fran','2018-09-06 10:43:28','CORRECTO'),(769,109,'katherine','2018-09-06 11:13:04','CORRECTO'),(770,105,'orodriguez','2018-09-06 14:32:08','CORRECTO'),(771,110,'cjurgens','2018-09-06 15:20:28','CORRECTO'),(772,116,'dangel','2018-09-06 15:33:43','CORRECTO'),(773,105,'orodriguez','2018-09-06 16:55:09','CORRECTO'),(774,109,'katherine','2018-09-06 17:30:46','CORRECTO'),(775,108,'esalas','2018-09-06 17:34:10','CORRECTO'),(776,110,'cjurgens','2018-09-06 17:45:55','CORRECTO'),(777,110,'cjurgens','2018-09-07 10:24:12','CORRECTO'),(778,104,'fran','2018-09-07 10:27:47','CORRECTO'),(779,105,'orodriguez','2018-09-07 11:16:57','CORRECTO'),(780,105,'orodriguez','2018-09-07 15:15:57','CORRECTO'),(781,110,'cjurgens','2018-09-07 16:29:31','CORRECTO'),(782,104,'fran','2018-09-10 09:22:32','CORRECTO'),(783,108,'esalas','2018-09-10 10:03:17','CORRECTO'),(784,110,'cjurgens','2018-09-10 10:20:40','CORRECTO'),(785,105,'orodriguez','2018-09-10 10:57:47','CORRECTO'),(786,104,'fran','2018-09-10 11:08:35','CORRECTO'),(787,105,'orodriguez','2018-09-10 11:56:52','CORRECTO'),(788,110,'cjurgens','2018-09-10 12:33:24','CORRECTO'),(789,110,'cjurgens','2018-09-10 13:37:38','CORRECTO'),(790,108,'esalas','2018-09-10 14:06:15','CORRECTO'),(791,105,'orodriguez','2018-09-10 15:45:51','CORRECTO'),(792,109,'katherine','2018-09-10 15:51:39','CORRECTO'),(793,110,'cjurgens','2018-09-10 16:34:43','CORRECTO'),(794,109,'katherine','2018-09-10 17:09:14','CORRECTO'),(795,105,'orodriguez','2018-09-10 17:34:39','CORRECTO'),(796,108,'esalas','2018-09-10 18:38:50','CORRECTO'),(797,104,'fran','2018-09-11 10:25:52','CORRECTO'),(798,109,'katherine','2018-09-11 10:46:59','CORRECTO'),(799,109,'katherine','2018-09-11 10:53:33','CORRECTO'),(800,105,'orodriguez','2018-09-11 11:38:48','CORRECTO'),(801,108,'esalas','2018-09-11 11:48:59','CORRECTO'),(802,105,'orodriguez','2018-09-11 12:03:12','CORRECTO'),(803,110,'cjurgens','2018-09-11 12:05:47','CORRECTO'),(804,109,'katherine','2018-09-11 12:11:01','CORRECTO'),(805,105,'orodriguez','2018-09-11 12:39:40','CORRECTO'),(806,105,'orodriguez','2018-09-11 18:44:41','CORRECTO'),(807,109,'katherine','2018-09-12 08:35:10','CORRECTO'),(808,108,'esalas','2018-09-12 09:01:12','CORRECTO'),(809,105,'orodriguez','2018-09-12 10:50:34','CORRECTO'),(810,108,'esalas','2018-09-12 10:11:21','CORRECTO'),(811,108,'esalas','2018-09-12 13:26:57','CORRECTO'),(812,105,'orodriguez','2018-09-12 13:35:32','CORRECTO'),(813,105,'orodriguez','2018-09-12 13:59:06','CORRECTO'),(814,108,'esalas','2018-09-12 14:48:01','CORRECTO'),(815,107,'rberndt','2018-09-12 15:04:23','CORRECTO'),(816,109,'katherine','2018-09-12 15:48:17','CORRECTO'),(817,110,'cjurgens','2018-09-12 16:22:04','CORRECTO'),(818,109,'katherine','2018-09-12 16:25:45','CORRECTO'),(819,105,'orodriguez','2018-09-12 16:59:36','CORRECTO'),(820,105,'orodriguez','2018-09-12 18:16:19','CORRECTO'),(821,108,'esalas','2018-09-12 23:37:16','CORRECTO'),(822,108,'esalas','2018-09-13 00:25:21','CORRECTO'),(823,105,'orodriguez','2018-09-13 09:15:13','CORRECTO'),(824,105,'orodriguez','2018-09-13 10:19:54','CORRECTO'),(825,110,'cjurgens','2018-09-13 10:14:00','CORRECTO'),(826,108,'esalas','2018-09-13 10:15:21','CORRECTO'),(827,105,'orodriguez','2018-09-13 11:26:10','CORRECTO'),(828,109,'katherine','2018-09-13 11:59:02','CORRECTO'),(829,110,'cjurgens','2018-09-13 12:23:12','CORRECTO'),(830,108,'esalas','2018-09-13 13:10:53','CORRECTO'),(831,105,'orodriguez','2018-09-13 14:49:35','CORRECTO'),(832,105,'orodriguez','2018-09-13 15:28:50','CORRECTO'),(833,110,'cjurgens','2018-09-13 15:33:36','CORRECTO'),(834,105,'orodriguez','2018-09-13 16:56:57','CORRECTO'),(835,105,'orodriguez','2018-09-13 16:05:29','CORRECTO'),(836,105,'orodriguez','2018-09-13 16:05:29','CORRECTO'),(837,105,'orodriguez','2018-09-13 16:05:29','CORRECTO'),(838,105,'orodriguez','2018-09-13 16:05:29','CORRECTO'),(839,105,'orodriguez','2018-09-13 16:05:29','CORRECTO'),(840,105,'orodriguez','2018-09-13 16:05:29','CORRECTO'),(841,105,'orodriguez','2018-09-13 16:05:29','CORRECTO'),(842,110,'cjurgens','2018-09-13 16:47:09','CORRECTO'),(843,107,'rberndt','2018-09-13 16:50:03','CORRECTO'),(844,105,'orodriguez','2018-09-13 17:26:00','CORRECTO'),(845,108,'esalas','2018-09-13 18:08:48','CORRECTO'),(846,105,'orodriguez','2018-09-13 18:27:34','CORRECTO'),(847,109,'katherine','2018-09-14 08:47:12','CORRECTO'),(848,0,'katherine','2018-09-14 09:02:11','INCORRECTO'),(849,109,'katherine','2018-09-14 09:02:16','CORRECTO'),(850,105,'orodriguez','2018-09-14 09:25:57','CORRECTO'),(851,108,'esalas','2018-09-14 10:08:22','CORRECTO'),(852,105,'orodriguez','2018-09-14 10:20:18','CORRECTO'),(853,105,'orodriguez','2018-09-14 11:26:44','CORRECTO'),(854,109,'katherine','2018-09-14 10:33:42','CORRECTO'),(855,108,'esalas','2018-09-14 12:25:07','CORRECTO'),(856,110,'cjurgens','2018-09-20 12:17:40','CORRECTO'),(857,108,'esalas','2018-09-20 13:01:45','CORRECTO'),(858,110,'cjurgens','2018-09-20 13:35:00','CORRECTO'),(859,108,'esalas','2018-09-21 09:16:48','CORRECTO'),(860,109,'katherine','2018-09-21 09:31:24','CORRECTO'),(861,110,'cjurgens','2018-09-21 09:48:37','CORRECTO'),(862,110,'cjurgens','2018-09-21 10:50:55','CORRECTO'),(863,107,'rberndt','2018-09-21 11:28:15','CORRECTO'),(864,108,'esalas','2018-09-21 12:43:08','CORRECTO'),(865,108,'esalas','2018-09-21 15:30:07','CORRECTO'),(866,108,'esalas','2018-09-21 16:23:26','CORRECTO'),(867,110,'cjurgens','2018-09-21 16:26:53','CORRECTO'),(868,109,'katherine','2018-09-24 08:50:43','CORRECTO'),(869,109,'katherine','2018-09-24 08:54:39','CORRECTO'),(870,107,'rberndt','2018-09-24 09:39:28','CORRECTO'),(871,109,'katherine','2018-09-24 11:09:26','CORRECTO'),(872,105,'orodriguez','2018-09-24 11:45:13','CORRECTO'),(873,105,'orodriguez','2018-09-24 11:51:08','CORRECTO'),(874,108,'esalas','2018-09-24 13:13:53','CORRECTO'),(875,104,'fran','2018-09-24 14:29:18','CORRECTO'),(876,109,'katherine','2018-09-24 15:02:36','CORRECTO'),(877,108,'esalas','2018-09-24 15:21:52','CORRECTO'),(878,105,'orodriguez','2018-09-24 16:43:07','CORRECTO'),(879,105,'orodriguez','2018-09-24 18:17:12','CORRECTO'),(880,109,'katherine','2018-09-25 08:51:17','CORRECTO'),(881,110,'cjurgens','2018-09-25 09:14:54','CORRECTO'),(882,105,'orodriguez','2018-09-25 09:44:08','CORRECTO'),(883,105,'orodriguez','2018-09-25 11:02:08','CORRECTO'),(884,105,'orodriguez','2018-09-25 11:45:07','CORRECTO'),(885,105,'orodriguez','2018-09-25 14:54:26','CORRECTO'),(886,105,'orodriguez','2018-09-25 16:48:56','CORRECTO'),(887,108,'esalas','2018-09-25 17:42:30','CORRECTO'),(888,108,'esalas','2018-09-25 17:47:13','CORRECTO'),(889,105,'orodriguez','2018-09-25 18:39:41','CORRECTO'),(890,109,'katherine','2018-09-26 09:22:37','CORRECTO'),(891,110,'cjurgens','2018-09-26 09:38:45','CORRECTO'),(892,105,'orodriguez','2018-09-26 10:36:34','CORRECTO'),(893,105,'orodriguez','2018-09-26 11:13:50','CORRECTO'),(894,109,'katherine','2018-09-26 11:21:56','CORRECTO'),(895,108,'esalas','2018-09-26 12:27:17','CORRECTO'),(896,107,'rberndt','2018-09-26 14:15:52','CORRECTO'),(897,110,'cjurgens','2018-09-26 14:43:26','CORRECTO'),(898,110,'cjurgens','2018-09-26 14:43:26','CORRECTO'),(899,110,'cjurgens','2018-09-26 15:13:32','CORRECTO'),(900,105,'orodriguez','2018-09-26 15:22:08','CORRECTO'),(901,109,'katherine','2018-09-26 15:35:27','CORRECTO'),(902,105,'orodriguez','2018-09-26 16:32:18','CORRECTO'),(903,110,'cjurgens','2018-09-26 16:33:27','CORRECTO'),(904,108,'esalas','2018-09-27 11:16:42','CORRECTO'),(905,108,'esalas','2018-09-27 11:23:21','CORRECTO'),(906,105,'orodriguez','2018-09-27 12:48:44','CORRECTO'),(907,104,'fran','2018-09-27 13:22:24','CORRECTO'),(908,105,'orodriguez','2018-09-27 15:32:49','CORRECTO'),(909,105,'orodriguez','2018-09-27 16:39:29','CORRECTO'),(910,105,'orodriguez','2018-09-27 18:37:03','CORRECTO'),(911,105,'orodriguez','2018-09-28 09:33:08','CORRECTO'),(912,110,'cjurgens','2018-09-28 10:35:15','CORRECTO'),(913,105,'orodriguez','2018-09-28 10:35:36','CORRECTO'),(914,109,'katherine','2018-09-28 10:55:14','CORRECTO'),(915,109,'katherine','2018-09-28 12:51:03','CORRECTO'),(916,105,'orodriguez','2018-09-28 13:12:14','CORRECTO'),(917,108,'esalas','2018-09-28 17:05:02','CORRECTO'),(918,0,'esteban','2018-09-28 17:11:12','INCORRECTO'),(919,0,'esteban','2018-09-28 17:11:19','INCORRECTO'),(920,0,'esteban','2018-09-28 17:11:27','INCORRECTO'),(921,107,'rberndt','2018-09-28 17:11:56','CORRECTO'),(922,0,'Esteban','2018-09-28 17:12:37','INCORRECTO'),(923,108,'Esteban','2018-09-28 17:13:09','CORRECTO'),(924,105,'orodriguez','2018-09-28 17:19:39','CORRECTO'),(925,117,'Paula','2018-09-28 17:20:54','CORRECTO'),(926,117,'Paula','2018-09-28 17:27:48','CORRECTO'),(927,107,'rberndt','2018-10-01 11:49:25','CORRECTO'),(928,110,'cjurgens','2018-10-01 13:23:33','CORRECTO'),(929,105,'orodriguez','2018-10-01 14:22:12','CORRECTO'),(930,110,'cjurgens','2018-10-01 15:13:35','CORRECTO'),(931,105,'orodriguez','2018-10-01 15:25:30','CORRECTO'),(932,109,'katherine','2018-10-01 16:10:16','CORRECTO'),(933,110,'cjurgens','2018-10-01 16:13:57','CORRECTO'),(934,110,'cjurgens','2018-10-01 17:17:30','CORRECTO'),(935,105,'orodriguez','2018-10-01 18:37:43','CORRECTO'),(936,105,'orodriguez','2018-10-02 10:21:31','CORRECTO'),(937,110,'cjurgens','2018-10-02 12:07:30','CORRECTO'),(938,105,'orodriguez','2018-10-02 14:23:40','CORRECTO'),(939,105,'orodriguez','2018-10-02 13:34:59','CORRECTO'),(940,105,'orodriguez','2018-10-02 13:39:53','CORRECTO'),(941,105,'orodriguez','2018-10-02 15:33:21','CORRECTO'),(942,105,'orodriguez','2018-10-02 17:31:05','CORRECTO'),(943,105,'orodriguez','2018-10-02 17:01:49','CORRECTO'),(944,104,'fran','2018-10-02 18:22:51','CORRECTO'),(945,105,'orodriguez','2018-10-02 18:24:32','CORRECTO'),(946,0,'katherine','2018-10-03 09:34:31','INCORRECTO'),(947,109,'katherine','2018-10-03 09:34:37','CORRECTO'),(948,107,'rberndt','2018-10-03 10:05:41','CORRECTO'),(949,108,'Esteban','2018-10-03 10:06:14','CORRECTO'),(950,109,'katherine ','2018-10-03 10:35:49','CORRECTO'),(951,110,'cjurgens','2018-10-03 11:22:00','CORRECTO'),(952,105,'orodriguez','2018-10-03 11:48:32','CORRECTO'),(953,105,'orodriguez','2018-10-03 12:47:52','CORRECTO'),(954,109,'katherine','2018-10-03 13:51:54','CORRECTO'),(955,105,'orodriguez','2018-10-03 14:10:49','CORRECTO'),(956,109,'KATHERINE','2018-10-03 15:36:18','CORRECTO'),(957,105,'orodriguez','2018-10-03 15:40:30','CORRECTO'),(958,108,'Esteban','2018-10-03 16:11:48','CORRECTO'),(959,109,'katherine','2018-10-03 16:48:00','CORRECTO'),(960,105,'orodriguez','2018-10-03 17:20:03','CORRECTO'),(961,105,'orodriguez','2018-10-04 09:22:06','CORRECTO'),(962,105,'orodriguez','2018-10-04 10:09:19','CORRECTO'),(963,105,'orodriguez','2018-10-04 11:43:42','CORRECTO'),(964,110,'cjurgens','2018-10-04 16:47:22','CORRECTO'),(965,110,'cjurgens','2018-10-04 16:47:23','CORRECTO'),(966,110,'cjurgens','2018-10-04 16:47:25','CORRECTO'),(967,110,'cjurgens','2018-10-04 16:49:12','CORRECTO'),(968,110,'cjurgens','2018-10-04 16:49:13','CORRECTO'),(969,110,'cjurgens','2018-10-04 16:49:14','CORRECTO'),(970,110,'cjurgens','2018-10-04 16:49:14','CORRECTO'),(971,110,'cjurgens','2018-10-04 16:49:14','CORRECTO'),(972,110,'cjurgens','2018-10-04 16:49:14','CORRECTO'),(973,110,'cjurgens','2018-10-04 16:49:14','CORRECTO'),(974,110,'cjurgens','2018-10-04 16:49:14','CORRECTO'),(975,110,'cjurgens','2018-10-04 16:49:15','CORRECTO'),(976,110,'cjurgens','2018-10-04 16:49:30','CORRECTO'),(977,110,'cjurgens','2018-10-04 16:51:08','CORRECTO'),(978,109,'katherine','2018-10-04 16:52:16','CORRECTO'),(979,108,'Esteban','2018-10-04 18:19:50','CORRECTO'),(980,105,'orodriguez','2018-10-05 09:16:06','CORRECTO'),(981,105,'orodriguez','2018-10-05 09:16:16','CORRECTO'),(982,105,'orodriguez','2018-10-05 09:16:31','CORRECTO'),(983,105,'orodriguez','2018-10-05 11:27:29','CORRECTO'),(984,109,'katherine','2018-10-05 12:49:15','CORRECTO'),(985,110,'cjurgens','2018-10-05 13:00:12','CORRECTO'),(986,109,'katherine','2018-10-05 13:03:42','CORRECTO'),(987,109,'katherine','2018-10-05 13:05:52','CORRECTO'),(988,109,'katherine','2018-10-05 13:05:59','CORRECTO'),(989,110,'cjurgens','2018-10-05 13:09:22','CORRECTO'),(990,110,'cjurgens','2018-10-05 13:16:38','CORRECTO'),(991,110,'cjurgens','2018-10-05 13:16:43','CORRECTO'),(992,109,'katherine','2018-10-05 13:17:07','CORRECTO'),(993,109,'katherine','2018-10-05 13:18:25','CORRECTO'),(994,109,'katherine','2018-10-05 13:30:37','CORRECTO'),(995,109,'katherine','2018-10-05 13:49:55','CORRECTO'),(996,117,'paula','2018-10-05 13:51:26','CORRECTO'),(997,117,'Paula','2018-10-05 13:52:00','CORRECTO'),(998,117,'Paula','2018-10-05 13:52:01','CORRECTO'),(999,109,'katherine','2018-10-05 13:52:11','CORRECTO'),(1000,109,'katherine','2018-10-05 13:52:13','CORRECTO'),(1001,109,'katherine','2018-10-05 13:52:21','CORRECTO'),(1002,109,'katherine','2018-10-05 13:52:34','CORRECTO'),(1003,117,'Paula','2018-10-05 13:53:07','CORRECTO'),(1004,105,'orodriguez','2018-10-05 14:00:08','CORRECTO'),(1005,117,'Paula','2018-10-05 14:57:50','CORRECTO'),(1006,105,'orodriguez','2018-10-05 15:32:30','CORRECTO'),(1007,105,'orodriguez','2018-10-05 16:45:05','CORRECTO'),(1008,105,'orodriguez','2018-10-05 18:01:55','CORRECTO'),(1009,108,'Esteban','2018-10-08 11:56:04','CORRECTO'),(1010,105,'orodriguez','2018-10-08 12:14:07','CORRECTO'),(1011,107,'rberndt','2018-10-08 13:52:31','CORRECTO'),(1012,105,'orodriguez','2018-10-08 15:36:07','CORRECTO'),(1013,108,'Esteban','2018-10-09 11:12:08','CORRECTO'),(1014,105,'orodriguez','2018-10-09 12:36:45','CORRECTO'),(1015,105,'orodriguez','2018-10-09 13:40:33','CORRECTO'),(1016,109,'katherine','2018-10-09 12:54:05','CORRECTO'),(1017,109,'katherine','2018-10-09 13:13:59','CORRECTO'),(1018,105,'orodriguez','2018-10-09 13:22:37','CORRECTO'),(1019,117,'paula','2018-10-09 16:17:16','CORRECTO'),(1020,109,'katherine ','2018-10-09 16:56:51','CORRECTO'),(1021,105,'orodriguez','2018-10-09 17:53:46','CORRECTO'),(1022,105,'orodriguez','2018-10-10 11:31:40','CORRECTO'),(1023,105,'orodriguez','2018-10-10 13:25:17','CORRECTO'),(1024,108,'Esteban','2018-10-10 12:51:09','CORRECTO'),(1025,117,'paula','2018-10-10 15:11:29','CORRECTO'),(1026,105,'orodriguez','2018-10-10 18:59:47','CORRECTO'),(1027,117,'paula','2018-10-11 09:22:22','CORRECTO'),(1028,105,'orodriguez','2018-10-11 09:41:48','CORRECTO'),(1029,108,'Esteban','2018-10-11 10:19:18','CORRECTO'),(1030,105,'orodriguez','2018-10-11 10:26:09','CORRECTO'),(1031,105,'orodriguez','2018-10-11 11:53:40','CORRECTO'),(1032,105,'orodriguez','2018-10-11 12:15:33','CORRECTO'),(1033,105,'orodriguez','2018-10-11 13:22:58','CORRECTO'),(1034,110,'cjurgens','2018-10-12 09:11:54','CORRECTO'),(1035,109,'katherine','2018-10-12 13:31:19','CORRECTO'),(1036,110,'cjurgens','2018-10-12 16:36:41','CORRECTO'),(1037,117,'paula','2018-10-12 16:53:12','CORRECTO'),(1038,105,'orodriguez','2018-10-12 17:09:18','CORRECTO'),(1039,110,'cjurgens','2018-10-12 17:47:57','CORRECTO'),(1040,105,'orodriguez','2018-10-12 18:09:30','CORRECTO'),(1041,105,'orodriguez','2018-10-12 19:30:32','CORRECTO'),(1042,110,'cjurgens','2018-10-12 18:44:06','CORRECTO'),(1043,110,'cjurgens','2018-10-12 18:48:19','CORRECTO'),(1044,105,'orodriguez','2018-10-16 09:06:33','CORRECTO'),(1045,105,'orodriguez','2018-10-16 09:18:03','CORRECTO'),(1046,110,'cjurgens','2018-10-16 09:38:52','CORRECTO'),(1047,105,'orodriguez','2018-10-16 10:06:27','CORRECTO'),(1048,117,'PAULA','2018-10-16 11:55:56','CORRECTO'),(1049,105,'orodriguez','2018-10-16 12:20:21','CORRECTO'),(1050,110,'cjurgens','2018-10-16 13:17:32','CORRECTO'),(1051,105,'orodriguez','2018-10-16 13:40:13','CORRECTO'),(1052,110,'cjurgens','2018-10-16 14:29:52','CORRECTO'),(1053,110,'cjurgens','2018-10-16 15:49:16','CORRECTO'),(1054,105,'orodriguez','2018-10-16 15:54:27','CORRECTO'),(1055,110,'cjurgens','2018-10-16 16:10:02','CORRECTO'),(1056,117,'PAULA','2018-10-16 16:14:50','CORRECTO'),(1057,110,'cjurgens','2018-10-16 16:24:55','CORRECTO'),(1058,105,'orodriguez','2018-10-16 16:57:54','CORRECTO'),(1059,105,'orodriguez','2018-10-16 17:25:19','CORRECTO'),(1060,109,'katherine','2018-10-17 08:54:40','CORRECTO'),(1061,110,'cjurgens','2018-10-17 09:21:35','CORRECTO'),(1062,109,'katherine','2018-10-17 10:08:59','CORRECTO'),(1063,110,'cjurgens','2018-10-17 10:18:46','CORRECTO'),(1064,0,'paula','2018-10-17 11:11:12','INCORRECTO'),(1065,117,'paula','2018-10-17 11:11:21','CORRECTO'),(1066,105,'orodriguez','2018-10-17 11:48:42','CORRECTO'),(1067,110,'cjurgens','2018-10-17 11:49:21','CORRECTO'),(1068,105,'orodriguez','2018-10-17 11:49:26','CORRECTO'),(1069,109,'katherine','2018-10-17 12:04:35','CORRECTO'),(1070,108,'Esteban','2018-10-17 13:21:47','CORRECTO'),(1071,105,'orodriguez','2018-10-17 13:45:13','CORRECTO'),(1072,117,'paula','2018-10-17 13:45:50','CORRECTO'),(1073,109,'katherine','2018-10-17 15:04:26','CORRECTO'),(1074,117,'PAULA','2018-10-17 15:13:35','CORRECTO'),(1075,105,'orodriguez','2018-10-17 15:41:49','CORRECTO'),(1076,109,'katherine','2018-10-17 17:11:32','CORRECTO'),(1077,110,'cjurgens','2018-10-17 17:44:36','CORRECTO'),(1078,117,'paula','2018-10-18 08:49:40','CORRECTO'),(1079,109,'katherine','2018-10-18 08:54:27','CORRECTO'),(1080,105,'orodriguez','2018-10-18 09:12:25','CORRECTO'),(1081,108,'Esteban','2018-10-18 09:52:03','CORRECTO'),(1082,0,'katherine','2018-10-18 10:26:29','INCORRECTO'),(1083,109,'katherine','2018-10-18 10:26:34','CORRECTO'),(1084,117,'paula','2018-10-18 10:31:23','CORRECTO'),(1085,108,'Esteban','2018-10-18 11:00:02','CORRECTO'),(1086,105,'orodriguez','2018-10-18 11:01:56','CORRECTO'),(1087,110,'cjurgens','2018-10-18 11:04:24','CORRECTO'),(1088,108,'Esteban','2018-10-18 11:38:29','CORRECTO'),(1089,104,'fran','2018-10-18 12:10:41','CORRECTO'),(1090,109,'katherine','2018-10-18 15:19:36','CORRECTO'),(1091,105,'orodriguez','2018-10-18 16:59:38','CORRECTO'),(1092,109,'katherine','2018-10-18 17:57:55','CORRECTO'),(1093,108,'Esteban','2018-10-18 17:59:39','CORRECTO'),(1094,105,'orodriguez','2018-10-18 18:58:52','CORRECTO'),(1095,104,'fran','2018-10-19 09:06:22','CORRECTO'),(1096,105,'orodriguez','2018-10-19 09:11:56','CORRECTO'),(1097,105,'orodriguez','2018-10-19 09:19:27','CORRECTO'),(1098,104,'fran','2018-10-19 09:39:09','CORRECTO'),(1099,109,'katherine ','2018-10-19 10:08:00','CORRECTO'),(1100,109,'katherine','2018-10-19 13:18:53','CORRECTO'),(1101,117,'paula','2018-10-19 16:57:29','CORRECTO'),(1102,108,'Esteban','2018-10-22 08:36:22','CORRECTO'),(1103,110,'cjurgens','2018-10-22 10:07:31','CORRECTO'),(1104,117,'paula','2018-10-22 10:13:07','CORRECTO'),(1105,110,'cjurgens','2018-10-22 11:47:27','CORRECTO'),(1106,116,'dangel','2018-10-22 13:33:01','CORRECTO'),(1107,105,'orodriguez','2018-10-22 13:51:57','CORRECTO'),(1108,110,'cjurgens','2018-10-22 14:22:59','CORRECTO'),(1109,108,'Esteban','2018-10-22 16:32:00','CORRECTO'),(1110,110,'cjurgens','2018-10-22 16:47:38','CORRECTO'),(1111,104,'fran','2018-10-22 17:03:41','CORRECTO'),(1112,117,'paula','2018-10-22 17:05:41','CORRECTO'),(1113,116,'dangel','2018-10-22 17:52:38','CORRECTO'),(1114,108,'Esteban','2018-10-22 18:02:16','CORRECTO'),(1115,117,'paula','2018-10-22 18:27:46','CORRECTO'),(1116,105,'orodriguez','2018-10-23 09:10:52','CORRECTO'),(1117,108,'Esteban','2018-10-23 09:20:26','CORRECTO'),(1118,116,'dangel','2018-10-23 10:12:59','CORRECTO'),(1119,110,'cjurgens','2018-10-23 10:29:07','CORRECTO'),(1120,108,'Esteban','2018-10-23 10:41:33','CORRECTO'),(1121,105,'orodriguez','2018-10-23 11:52:56','CORRECTO'),(1122,116,'dangel','2018-10-23 12:06:31','CORRECTO'),(1123,109,'katherine','2018-10-23 12:47:38','CORRECTO'),(1124,116,'dangel','2018-10-23 14:40:44','CORRECTO'),(1125,117,'PAULA','2018-10-23 16:02:44','CORRECTO'),(1126,116,'dangel','2018-10-23 16:14:24','CORRECTO'),(1127,108,'Esteban','2018-10-23 16:25:47','CORRECTO'),(1128,109,'KATHERINE','2018-10-23 16:49:44','CORRECTO'),(1129,107,'rberndt','2018-10-23 16:50:50','CORRECTO'),(1130,110,'cjurgens','2018-10-23 17:02:28','CORRECTO'),(1131,116,'dangel','2018-10-23 17:39:30','CORRECTO'),(1132,117,'PAULA','2018-10-23 17:44:09','CORRECTO'),(1133,105,'orodriguez','2018-10-23 17:51:21','CORRECTO'),(1134,116,'dangel','2018-10-23 18:01:52','CORRECTO'),(1135,108,'Esteban','2018-10-23 18:20:18','CORRECTO'),(1136,105,'orodriguez','2018-10-23 18:46:52','CORRECTO'),(1137,108,'Esteban','2018-10-23 18:48:39','CORRECTO'),(1138,108,'Esteban','2018-10-23 18:48:39','CORRECTO'),(1139,116,'dangel','2018-10-23 18:48:44','CORRECTO'),(1140,116,'dangel','2018-10-23 18:54:37','CORRECTO'),(1141,116,'dangel','2018-10-24 08:47:17','CORRECTO'),(1142,105,'orodriguez','2018-10-24 09:00:33','CORRECTO'),(1143,117,'PAULA','2018-10-24 10:15:13','CORRECTO'),(1144,110,'cjurgens','2018-10-24 10:51:00','CORRECTO'),(1145,116,'dangel','2018-10-24 11:12:31','CORRECTO'),(1146,110,'cjurgens','2018-10-24 11:40:18','CORRECTO'),(1147,117,'PAULA','2018-10-24 12:07:24','CORRECTO'),(1148,116,'dangel','2018-10-24 12:20:56','CORRECTO'),(1149,116,'dangel','2018-10-24 12:21:06','CORRECTO'),(1150,116,'dangel','2018-10-24 12:57:16','CORRECTO'),(1151,105,'orodriguez','2018-10-24 13:09:02','CORRECTO'),(1152,116,'dangel','2018-10-24 13:57:45','CORRECTO'),(1153,110,'cjurgens','2018-10-24 16:02:54','CORRECTO'),(1154,117,'PAULA','2018-10-24 17:06:40','CORRECTO'),(1155,105,'orodriguez','2018-10-24 17:15:07','CORRECTO'),(1156,109,'katherine','2018-10-25 11:10:16','CORRECTO'),(1157,117,'paula','2018-10-25 12:15:19','CORRECTO'),(1158,108,'Esteban','2018-10-25 16:21:39','CORRECTO'),(1159,107,'rberndt','2018-10-25 17:59:19','CORRECTO'),(1160,109,'katherine','2018-10-26 10:44:22','CORRECTO'),(1161,104,'fran','2018-10-26 10:51:11','CORRECTO'),(1162,117,'PAULA','2018-10-26 11:45:47','CORRECTO'),(1163,108,'Esteban','2018-10-26 11:50:03','CORRECTO'),(1164,104,'fran','2018-10-26 12:24:51','CORRECTO'),(1165,116,'dangel','2018-10-26 12:39:33','CORRECTO'),(1166,108,'Esteban','2018-10-26 16:22:11','CORRECTO');
/*!40000 ALTER TABLE `log_login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log_query`
--

DROP TABLE IF EXISTS `log_query`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log_query` (
  `IdLogSql` int(11) NOT NULL AUTO_INCREMENT,
  `IdUsuario` int(11) DEFAULT NULL,
  `Fecha` datetime DEFAULT NULL,
  `Query` varchar(500) DEFAULT NULL,
  `TipoOperacion` varchar(150) NOT NULL,
  PRIMARY KEY (`IdLogSql`)
) ENGINE=InnoDB AUTO_INCREMENT=121128 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log_query`
--

LOCK TABLES `log_query` WRITE;
/*!40000 ALTER TABLE `log_query` DISABLE KEYS */;
INSERT INTO `log_query` VALUES (81845,109,'2018-07-31 17:41:36','INSERT INTO personaempresa\n			(rut, dv, nombre, giro, ciudad, region, direccion, correo, contacto, comentario, telefono, alias, tipo_cliente, id_usuario_sistema, clase_cliente, tipo_pago_bsale_id)\n			VALUES\n			(\'14638794\', \'2\', \'VERENA MENTZINGEN\', \'Sin giro, persona natural\', \'315\', \'13\', \'FUNDO CENTINELA, PUERTO OCTAY\', \'V.MENTZINGEN@GMAIL.COM\', \'VERENA MENTZINGEN\', \'PRIMER CLIENTE YEIIIIIIIIIIIIII\', \'996415372\', \'\', \'1\', \'109\', \'1\', \'4\')','insert'),(81848,109,'2018-07-31 17:41:38','UPDATE personaempresa SET cliente_id_bsale = \'3766\' WHERE id = \'286\'','update'),(83167,1,'2018-08-02 15:55:06','INSERT INTO personaempresa\n			(rut, dv, nombre, giro, ciudad, region, direccion, correo, contacto, comentario, telefono, alias, tipo_cliente, id_usuario_sistema, clase_cliente, tipo_pago_bsale_id)\n			VALUES\n			(\'15434708\', \'9\', \'LUIS PONCE PRUEBA\', \'Suministro de Electricidad, Gas y Agua\', \'88\', \'7\', \'BORIS CALDERON SOTO 135 BUIN\', \'LPONCE1405@GMAIL.COM\', \'LUIS\', \'\', \'956126384\', \'PRUEBA\', \'2\', \'1\', \'1\', \'14\')','insert'),(83170,1,'2018-08-02 15:55:10','UPDATE personaempresa SET cliente_id_bsale = \'3663\' WHERE id = \'287\'','update'),(84743,109,'2018-08-06 09:38:14','INSERT INTO nota_venta(rut, fecha, numero_oc, fecha_oc, solicitado_por, estatus_facturacion) VALUES (\'14638794\',\'2018-08-06\',\'\',\'2018-08-06\',\'KATHERINE\',\'0\')','insert'),(84744,109,'2018-08-06 09:38:14','INSERT INTO nota_venta_detalle(nota_venta_id, concepto, cantidad, precio, total) VALUES (\'26\',\'ARRIENDO EQUIPOS DE DATOS JULIO 2018\',\'1\',\'27208\',\'32378\')','insert'),(85341,109,'2018-08-08 11:45:06','INSERT INTO personaempresa\n			(rut, dv, nombre, giro, ciudad, region, direccion, correo, contacto, comentario, telefono, alias, tipo_cliente, id_usuario_sistema, clase_cliente, tipo_pago_bsale_id)\n			VALUES\n			(\'6593446\', \'9\', \'FRANCISCA ALEMPARTE\', \'Sin giro, persona natural\', \'313\', \'13\', \'LOTEO NORTE 14-C, PUERTO VARAS\', \'TIALEMPARTE@GMAIL.COM\', \'FRANCICA ALEMPARTE\', \'\', \'979579900\', \'\', \'1\', \'109\', \'1\', \'22\')','insert'),(85344,109,'2018-08-08 11:45:08','UPDATE personaempresa SET cliente_id_bsale = \'3795\' WHERE id = \'288\'','update'),(85521,109,'2018-08-08 12:37:39','INSERT INTO nota_venta(rut, fecha, numero_oc, fecha_oc, solicitado_por, estatus_facturacion) VALUES (\'6593446\',\'2018-08-08\',\'\',\'2018-08-08\',\'francisca alemparte\',\'0\')','insert'),(85522,109,'2018-08-08 12:37:39','INSERT INTO nota_venta_detalle(nota_venta_id, concepto, cantidad, precio, total) VALUES (\'28\',\'VISITA TECNICA\',\'1\',\'136048\',\'161897\')','insert'),(85523,109,'2018-08-08 12:37:39','INSERT INTO nota_venta_detalle(nota_venta_id, concepto, cantidad, precio, total) VALUES (\'28\',\'10 METROS DE CABLE\',\'1\',\'81629\',\'97139\')','insert'),(85766,109,'2018-08-08 13:00:36','INSERT INTO nota_venta(rut, fecha, numero_oc, fecha_oc, solicitado_por, estatus_facturacion) VALUES (\'6593446\',\'2018-08-08\',\'\',\'2018-08-08\',\'esteban\',\'0\')','insert'),(85767,109,'2018-08-08 13:00:36','INSERT INTO nota_venta_detalle(nota_venta_id, concepto, cantidad, precio, total) VALUES (\'29\',\'cable\',\'1\',\'54419\',\'64759\')','insert'),(89443,109,'2018-08-14 10:38:39','INSERT INTO personaempresa\n			(rut, dv, nombre, giro, ciudad, region, direccion, correo, contacto, comentario, telefono, alias, tipo_cliente, id_usuario_sistema, clase_cliente, tipo_pago_bsale_id)\n			VALUES\n			(\'6593446\', \'9\', \'FRANCISCA ALEMPARTE\', \'Sin giro, persona natural\', \'313\', \'13\', \'LOTEO NORTE 14C\', \'TIALEMPARTE@GMAIL.COM\', \'FRANCISCA ALEMPARTE\', \'\', \'979579900\', \'\', \'1\', \'109\', \'1\', \'15\')','insert'),(89446,109,'2018-08-14 10:38:41','UPDATE personaempresa SET cliente_id_bsale = \'13\' WHERE id = \'289\'','update'),(89504,109,'2018-08-14 10:52:50','INSERT INTO arriendo_equipos_datos (IdServicio, Velocidad, Plan, IdOrigen, IdProducto, TipoDestino) VALUES (\'664\', \'3X1\', \'R3\', \'10\', \'0\', \'2\')','insert'),(89527,109,'2018-08-14 10:57:34','INSERT INTO arriendo_equipos_datos (IdServicio, Velocidad, Plan, IdOrigen, IdProducto, TipoDestino) VALUES (\'665\', \'3X1\', \'R3\', \'10\', \'0\', \'2\')','insert'),(89550,109,'2018-08-14 10:59:48','INSERT INTO personaempresa\n			(rut, dv, nombre, giro, ciudad, region, direccion, correo, contacto, comentario, telefono, alias, tipo_cliente, id_usuario_sistema, clase_cliente, tipo_pago_bsale_id)\n			VALUES\n			(\'14638794\', \'2\', \'VERENA MENTZINGEN\', \'Sin giro, persona natural\', \'315\', \'13\', \'FUNDO CENTINELA.\', \'V.MENTZINGEN@GMAIL.COM\', \'VERENA MENTZINGEN\', \'\', \'996415372\', \'\', \'1\', \'109\', \'1\', \'15\')','insert'),(89553,109,'2018-08-14 10:59:49','UPDATE personaempresa SET cliente_id_bsale = \'11\' WHERE id = \'290\'','update'),(89578,109,'2018-08-14 11:02:35','INSERT INTO arriendo_equipos_datos (IdServicio, Velocidad, Plan, IdOrigen, IdProducto, TipoDestino) VALUES (\'666\', \'3X1\', \'R3\', \'10\', \'0\', \'2\')','insert'),(89600,109,'2018-08-14 11:05:32','INSERT INTO personaempresa\n			(rut, dv, nombre, giro, ciudad, region, direccion, correo, contacto, comentario, telefono, alias, tipo_cliente, id_usuario_sistema, clase_cliente, tipo_pago_bsale_id)\n			VALUES\n			(\'12761640\', \'K\', \'RICHARD GALLEGOS NAVARRO\', \'Sin giro, persona natural\', \'313\', \'13\', \'PARCELACION LOS ULMOS.  PARCELA 43\', \'OFICINA.AGUILERA@GMAIL.COM\', \'RICHARD GALLEGOS\', \'\', \'944146691\', \'\', \'1\', \'109\', \'1\', \'15\')','insert'),(89603,109,'2018-08-14 11:05:33','UPDATE personaempresa SET cliente_id_bsale = \'15\' WHERE id = \'291\'','update'),(89628,109,'2018-08-14 11:13:57','INSERT INTO arriendo_equipos_datos (IdServicio, Velocidad, Plan, IdOrigen, IdProducto, TipoDestino) VALUES (\'667\', \'10X4\', \'R10\', \'10\', \'0\', \'2\')','insert'),(89634,109,'2018-08-14 11:17:29','INSERT INTO trafico_generado (LineaTelefonica, Descripcion,IdServicio) VALUES (\'652566620\', \'\',\'668\')','insert'),(89656,109,'2018-08-14 11:21:11','INSERT INTO personaempresa\n			(rut, dv, nombre, giro, ciudad, region, direccion, correo, contacto, comentario, telefono, alias, tipo_cliente, id_usuario_sistema, clase_cliente, tipo_pago_bsale_id)\n			VALUES\n			(\'5012355\', \'3\', \'FERNANDO VILCHES SARABIA\', \'Sin giro, persona natural\', \'313\', \'13\', \'RUTA 225.  KM 20,5\', \'FEVISA.VAMPIRO@YAHOO.CL\', \'FERNANDO VILCHES\', \'\', \'994795886\', \'\', \'1\', \'109\', \'1\', \'15\')','insert'),(89659,109,'2018-08-14 11:21:12','UPDATE personaempresa SET cliente_id_bsale = \'16\' WHERE id = \'292\'','update'),(89684,109,'2018-08-14 11:23:58','INSERT INTO arriendo_equipos_datos (IdServicio, Velocidad, Plan, IdOrigen, IdProducto, TipoDestino) VALUES (\'669\', \'3X1\', \'R3\', \'10\', \'0\', \'2\')','insert'),(89706,109,'2018-08-14 11:25:32','INSERT INTO giros (nombre) VALUES (\'INVERSIONES Y ARQUITECTURA\')','insert'),(89708,109,'2018-08-14 11:28:29','INSERT INTO personaempresa\n			(rut, dv, nombre, giro, ciudad, region, direccion, correo, contacto, comentario, telefono, alias, tipo_cliente, id_usuario_sistema, clase_cliente, tipo_pago_bsale_id)\n			VALUES\n			(\'78796670\', \'5\', \'INVERSIONES BELLAVISTA LTDA.\', \'INVERSIONES Y ARQUITECTURA\', \'127\', \'7\', \'AV. MANQUEHUE NORTE 151.  OF. 508.  LAS CONDES\', \'ASANDOVALE@ASANDOVAL.CL\', \'ANDRES SANDOVAL\', \'\', \'990304242\', \'\', \'2\', \'109\', \'1\', \'15\')','insert'),(89711,109,'2018-08-14 11:28:31','UPDATE personaempresa SET cliente_id_bsale = \'17\' WHERE id = \'293\'','update'),(89736,109,'2018-08-14 11:33:24','INSERT INTO arriendo_equipos_datos (IdServicio, Velocidad, Plan, IdOrigen, IdProducto, TipoDestino) VALUES (\'670\', \'3X1\', \'R3\', \'10\', \'0\', \'2\')','insert'),(89888,109,'2018-08-14 11:46:30','INSERT INTO giros (nombre) VALUES (\'CULTIVOS MARINOS, PROCESADORA DE PRODUCTOS DEL MAR\')','insert'),(89890,109,'2018-08-14 11:48:03','INSERT INTO personaempresa\n			(rut, dv, nombre, giro, ciudad, region, direccion, correo, contacto, comentario, telefono, alias, tipo_cliente, id_usuario_sistema, clase_cliente, tipo_pago_bsale_id)\n			VALUES\n			(\'86247400\', \'7\', \'EMPRESAS AQUACHILE S.A.\', \'CULTIVOS MARINOS, PROCESADORA DE PRODUCTOS DEL MAR\', \'312\', \'13\', \'SECTOR CARDONAL.  LOTE B. S/N\', \'JAVIER.MUNOZ@AQUACHILE.COM\', \'JAVIER MUÑOZ\', \'\', \'652433600\', \'\', \'2\', \'109\', \'3\', \'11\')','insert'),(89893,109,'2018-08-14 11:48:04','UPDATE personaempresa SET cliente_id_bsale = \'10\' WHERE id = \'294\'','update'),(89943,109,'2018-08-14 12:00:38','INSERT INTO arriendo_equipos_datos (IdServicio, Velocidad, Plan, IdOrigen, IdProducto, TipoDestino) VALUES (\'671\', \'5X5\', \'PK5\', \'0\', \'0\', \'2\')','insert'),(89952,109,'2018-08-14 12:03:18','INSERT INTO arriendo_equipos_datos (IdServicio, Velocidad, Plan, IdOrigen, IdProducto, TipoDestino) VALUES (\'672\', \'5X5\', \'PK5\', \'0\', \'0\', \'2\')','insert'),(89974,109,'2018-08-14 12:07:49','INSERT INTO arriendo_equipos_datos (IdServicio, Velocidad, Plan, IdOrigen, IdProducto, TipoDestino) VALUES (\'673\', \'5X5\', \'PK5\', \'0\', \'0\', \'2\')','insert'),(89982,109,'2018-08-14 12:10:13','INSERT INTO arriendo_equipos_datos (IdServicio, Velocidad, Plan, IdOrigen, IdProducto, TipoDestino) VALUES (\'674\', \'5X5\', \'PK5\', \'0\', \'0\', \'2\')','insert'),(90876,109,'2018-08-14 15:27:22','INSERT INTO nota_venta(rut, fecha, numero_oc, fecha_oc, solicitado_por, estatus_facturacion) VALUES (\'6593446\',\'2018-08-14\',\'\',\'2018-08-14\',\'ESTEBAN SALAS\',\'0\')','insert'),(90877,109,'2018-08-14 15:27:22','INSERT INTO nota_venta_detalle(nota_venta_id, concepto, cantidad, precio, total) VALUES (\'30\',\'UPS INTERACTIVA\',\'1\',\'54456\',\'64803\')','insert'),(90950,109,'2018-08-14 15:31:11','INSERT INTO nota_venta(rut, fecha, numero_oc, fecha_oc, solicitado_por, estatus_facturacion) VALUES (\'5012355\',\'2018-08-14\',\'\',\'2018-08-14\',\'ESTEBAN SALAS\',\'0\')','insert'),(90951,109,'2018-08-14 15:31:11','INSERT INTO nota_venta_detalle(nota_venta_id, concepto, cantidad, precio, total) VALUES (\'31\',\'VISITA TÉCNICA CONFIGURACIÓN DE ROUTER\',\'1\',\'27228\',\'32401\')','insert'),(91625,110,'2018-08-14 16:32:41','INSERT INTO arriendo_equipos_datos (IdServicio, Velocidad, Plan, IdOrigen, IdProducto, TipoDestino) VALUES (\'675\', \'\', \'\', \'0\', \'0\', \'2\')','insert'),(91722,110,'2018-08-14 17:14:39','INSERT INTO arriendo_equipos_datos (IdServicio, Velocidad, Plan, IdOrigen, IdProducto, TipoDestino) VALUES (\'676\', \'\', \'\', \'0\', \'0\', \'2\')','insert'),(91729,110,'2018-08-14 17:16:28','INSERT INTO arriendo_equipos_datos (IdServicio, Velocidad, Plan, IdOrigen, IdProducto, TipoDestino) VALUES (\'677\', \'\', \'\', \'0\', \'0\', \'2\')','insert'),(91736,110,'2018-08-14 17:16:59','INSERT INTO arriendo_equipos_datos (IdServicio, Velocidad, Plan, IdOrigen, IdProducto, TipoDestino) VALUES (\'678\', \'\', \'\', \'0\', \'0\', \'2\')','insert'),(91745,110,'2018-08-14 17:17:09','INSERT INTO arriendo_equipos_datos (IdServicio, Velocidad, Plan, IdOrigen, IdProducto, TipoDestino) VALUES (\'679\', \'\', \'\', \'0\', \'0\', \'2\')','insert'),(91752,110,'2018-08-14 17:18:14','INSERT INTO arriendo_equipos_datos (IdServicio, Velocidad, Plan, IdOrigen, IdProducto, TipoDestino) VALUES (\'680\', \'\', \'\', \'0\', \'0\', \'2\')','insert'),(91759,110,'2018-08-14 17:18:50','INSERT INTO arriendo_equipos_datos (IdServicio, Velocidad, Plan, IdOrigen, IdProducto, TipoDestino) VALUES (\'681\', \'\', \'\', \'0\', \'0\', \'2\')','insert'),(93906,110,'2018-08-21 11:44:23',' UPDATE servicios SET Codigo = \'86247400-7FSMI10\', Grupo = \'4\', TipoFactura = \'13\', Valor = \'12\', Descuento = \'0\', Descripcion = \'\', Conexion = \'CENTRO HUAPI  Referencia:  OST 196558\', Direccion = \'\', Latitud = \'-41.3214705\', Longitud = \'-73.0138898\', Referencia = \'\', Contacto = \'\', Fono = \'\', PosibleEstacion = \'\', Equipamiento = \'\', SenalTeorica = \'\', UsuarioPppoeTeorico = \'\', FechaComprometidaInstalacion = \'1969-01-31\', CostoInstalacion = \'0\', CostoInstalacionDescuento = \'0\' WHERE Id = \'681\'','update'),(96130,109,'2018-08-21 18:56:22','INSERT INTO giros (nombre) VALUES (\'Transporte Marítimo\')','insert'),(96132,109,'2018-08-21 18:58:06','INSERT INTO personaempresa\n			(rut, dv, nombre, giro, ciudad, region, direccion, correo, contacto, comentario, telefono, alias, tipo_cliente, id_usuario_sistema, clase_cliente, tipo_pago_bsale_id)\n			VALUES\n			(\'13825370\', \'8\', \'JAVIER ALEJANDRO JOBIS VARGAS\', \'Transporte Marítimo\', \'323\', \'13\', \'CALLE 1 S/N\', \'AJOBIS@HOTMAIL.COM\', \'JAVIER JOBIS\', \'DIRECCIóN DE ANTENA: SECTOR EL COBRE S/N.  HORNOPIRéN\', \'9987696084\', \'\', \'2\', \'109\', \'1\', \'11\')','insert'),(96135,109,'2018-08-21 18:58:08','UPDATE personaempresa SET cliente_id_bsale = \'18\' WHERE id = \'295\'','update'),(96160,109,'2018-08-21 19:00:27','INSERT INTO arriendo_equipos_datos (IdServicio, Velocidad, Plan, IdOrigen, IdProducto, TipoDestino) VALUES (\'682\', \'3x1\', \'R3\', \'10\', \'0\', \'2\')','insert'),(96217,109,'2018-08-21 19:08:31','INSERT INTO giros (nombre) VALUES (\'Maquinaria Entretenimiento\')','insert'),(96219,109,'2018-08-21 19:09:41','INSERT INTO personaempresa\n			(rut, dv, nombre, giro, ciudad, region, direccion, correo, contacto, comentario, telefono, alias, tipo_cliente, id_usuario_sistema, clase_cliente, tipo_pago_bsale_id)\n			VALUES\n			(\'12017636\', \'6\', \'RODRIGO VENEGAS VALENZUELA\', \'Maquinaria Entretenimiento\', \'312\', \'13\', \'ANTONIO VARAS 1016\', \'RODRIGO.RV.ROMA@GMAIL.COM\', \'RODRIGO VENEGAS\', \'\', \'9942073892\', \'\', \'2\', \'109\', \'1\', \'11\')','insert'),(96222,109,'2018-08-21 19:09:45','UPDATE personaempresa SET cliente_id_bsale = \'19\' WHERE id = \'296\'','update'),(96247,109,'2018-08-21 19:22:19','INSERT INTO arriendo_equipos_datos (IdServicio, Velocidad, Plan, IdOrigen, IdProducto, TipoDestino) VALUES (\'683\', \'3x1\', \'R3\', \'10\', \'0\', \'2\')','insert'),(96302,109,'2018-08-21 19:25:22','INSERT INTO personaempresa\n			(rut, dv, nombre, giro, ciudad, region, direccion, correo, contacto, comentario, telefono, alias, tipo_cliente, id_usuario_sistema, clase_cliente, tipo_pago_bsale_id)\n			VALUES\n			(\'17296156\', \'8\', \'LAURA VáSQUEZ FRITZ\', \'Sin giro, persona natural\', \'313\', \'13\', \'LOS URALES S/N\', \'LAUVASQUEZFRITZ@GMAIL.COM\', \'LAURA VáSQUEZ\', \'\', \'955332877\', \'\', \'1\', \'109\', \'1\', \'11\')','insert'),(96305,109,'2018-08-21 19:25:23','UPDATE personaempresa SET cliente_id_bsale = \'20\' WHERE id = \'297\'','update'),(96330,109,'2018-08-21 19:27:56','INSERT INTO arriendo_equipos_datos (IdServicio, Velocidad, Plan, IdOrigen, IdProducto, TipoDestino) VALUES (\'684\', \'3x1\', \'R3\', \'10\', \'0\', \'2\')','insert'),(96370,109,'2018-08-21 19:32:36','INSERT INTO personaempresa\n			(rut, dv, nombre, giro, ciudad, region, direccion, correo, contacto, comentario, telefono, alias, tipo_cliente, id_usuario_sistema, clase_cliente, tipo_pago_bsale_id)\n			VALUES\n			(\'17520287\', \'0\', \'CYRO FARIñA ROMáN\', \'Sin giro, persona natural\', \'323\', \'13\', \'CONTAO S/N\', \'CYRO@LIVE.CL\', \'CYRO FARIñA\', \'\', \'974885541\', \'\', \'1\', \'109\', \'1\', \'11\')','insert'),(96373,109,'2018-08-21 19:32:38','UPDATE personaempresa SET cliente_id_bsale = \'21\' WHERE id = \'298\'','update'),(96398,109,'2018-08-21 19:34:32','INSERT INTO arriendo_equipos_datos (IdServicio, Velocidad, Plan, IdOrigen, IdProducto, TipoDestino) VALUES (\'685\', \'3x1\', \'R3\', \'10\', \'0\', \'2\')','insert'),(96420,109,'2018-08-21 19:38:36','INSERT INTO giros (nombre) VALUES (\'Act. de asesoramiento empresarial\')','insert'),(96422,109,'2018-08-21 19:41:30','INSERT INTO personaempresa\n			(rut, dv, nombre, giro, ciudad, region, direccion, correo, contacto, comentario, telefono, alias, tipo_cliente, id_usuario_sistema, clase_cliente, tipo_pago_bsale_id)\n			VALUES\n			(\'76830018\', \'6\', \'CONSORCIO INCON - VYE CONSULTORES PICHICOLO LTDA.\', \'Act. de asesoramiento empresarial\', \'109\', \'7\', \'AV. APOQUINDO 5555.  OFICINA 608\', \'LUIS.GONZALEZ@INCON.CL\', \'LUIS GONZáLEZ GALLEGOS\', \'\', \'223705366\', \'INCON\', \'2\', \'109\', \'1\', \'11\')','insert'),(96425,109,'2018-08-21 19:41:32','UPDATE personaempresa SET cliente_id_bsale = \'22\' WHERE id = \'299\'','update'),(96450,109,'2018-08-21 19:46:17','INSERT INTO arriendo_equipos_datos (IdServicio, Velocidad, Plan, IdOrigen, IdProducto, TipoDestino) VALUES (\'686\', \'5x2\', \'2\', \'10\', \'0\', \'2\')','insert'),(96472,109,'2018-08-21 19:48:05','INSERT INTO giros (nombre) VALUES (\'Compra venta y alquiler de inmobiliarios propios y arriendos\')','insert'),(96474,109,'2018-08-21 19:48:56','INSERT INTO personaempresa\n			(rut, dv, nombre, giro, ciudad, region, direccion, correo, contacto, comentario, telefono, alias, tipo_cliente, id_usuario_sistema, clase_cliente, tipo_pago_bsale_id)\n			VALUES\n			(\'76127546\', \'1\', \'INMOBILIARIA MILLANTú\', \'Compra venta y alquiler de inmobiliarios propios y arriendos\', \'12\', \'3\', \'ESMERALDA 1807.  OFICINA 302A\', \'PATRICIA.GONZALEZ@DLYC.CL\', \'PATRICIA GONZáLEZ\', \'\', \'995367467\', \'\', \'2\', \'109\', \'1\', \'11\')','insert'),(96477,109,'2018-08-21 19:48:58','UPDATE personaempresa SET cliente_id_bsale = \'23\' WHERE id = \'300\'','update'),(96502,109,'2018-08-21 19:58:14','INSERT INTO arriendo_equipos_datos (IdServicio, Velocidad, Plan, IdOrigen, IdProducto, TipoDestino) VALUES (\'687\', \'5x2\', \'R5\', \'10\', \'0\', \'2\')','insert'),(96524,109,'2018-08-21 20:02:45','INSERT INTO personaempresa\n			(rut, dv, nombre, giro, ciudad, region, direccion, correo, contacto, comentario, telefono, alias, tipo_cliente, id_usuario_sistema, clase_cliente, tipo_pago_bsale_id)\n			VALUES\n			(\'15250162\', \'5\', \'ROGELIO ARIEL SOTO VEGA\', \'Sin giro, persona natural\', \'323\', \'13\', \'CALLE RíO VODUDAHUE S/N\', \'RSOTOVEGA90@GMAIL.COM\', \'ROGELIO SOTO\', \'\', \'978837337\', \'\', \'1\', \'109\', \'1\', \'11\')','insert'),(96527,109,'2018-08-21 20:02:47','UPDATE personaempresa SET cliente_id_bsale = \'24\' WHERE id = \'301\'','update'),(96552,109,'2018-08-21 20:05:07','INSERT INTO arriendo_equipos_datos (IdServicio, Velocidad, Plan, IdOrigen, IdProducto, TipoDestino) VALUES (\'688\', \'3x1\', \'R3\', \'0\', \'0\', \'2\')','insert'),(96767,109,'2018-08-22 11:36:08','INSERT INTO personaempresa\n			(rut, dv, nombre, giro, ciudad, region, direccion, correo, contacto, comentario, telefono, alias, tipo_cliente, id_usuario_sistema, clase_cliente, tipo_pago_bsale_id)\n			VALUES\n			(\'8466934\', \'2\', \'RODRIGO CHICHARRO\', \'Sin giro, persona natural\', \'313\', \'13\', \'PARCELA 86 VOLCANES DEL LAGO, PUERTO VARAS\', \'RCHICHARRO@MANQUEHUE.NET\', \'RODRIGO CHICHARRO\', \'\', \'986161230\', \'\', \'1\', \'109\', \'1\', \'1\')','insert'),(96770,109,'2018-08-22 11:36:10','UPDATE personaempresa SET cliente_id_bsale = \'25\' WHERE id = \'302\'','update'),(96825,109,'2018-08-22 11:40:55','INSERT INTO nota_venta(rut, fecha, numero_oc, fecha_oc, solicitado_por, estatus_facturacion) VALUES (\'8466934\',\'2018-08-22\',\'\',\'2018-08-22\',\'ESTEBAN SALAS\',\'0\')','insert'),(96826,109,'2018-08-22 11:40:55','INSERT INTO nota_venta_detalle(nota_venta_id, concepto, cantidad, precio, total) VALUES (\'32\',\'VISITA TÉCNICA POR CÁMARA IP MAS INSTALACIÓN NVR\',\'1\',\'190792\',\'227042\')','insert'),(96827,109,'2018-08-22 11:40:55','INSERT INTO nota_venta_detalle(nota_venta_id, concepto, cantidad, precio, total) VALUES (\'32\',\'INSTALACIÓN Y HABILITACIÓN DE 5 CÁMARAS IP\',\'1\',\'597487\',\'711010\')','insert'),(98467,109,'2018-08-22 17:49:27','INSERT INTO nota_venta(rut, fecha, numero_oc, fecha_oc, solicitado_por, estatus_facturacion) VALUES (\'6593446\',\'2018-08-22\',\'\',\'2018-08-22\',\'ESTEBAN SALAS\',\'0\')','insert'),(98468,109,'2018-08-22 17:49:27','INSERT INTO nota_venta_detalle(nota_venta_id, concepto, cantidad, precio, total) VALUES (\'33\',\'VISITA TECNICA\',\'1\',\'27256\',\'32435\')','insert'),(99641,108,'2018-08-24 10:16:47','INSERT INTO giros (nombre) VALUES (\'Inmobiliaria\')','insert'),(99643,108,'2018-08-24 10:18:51','INSERT INTO personaempresa\n			(rut, dv, nombre, giro, ciudad, region, direccion, correo, contacto, comentario, telefono, alias, tipo_cliente, id_usuario_sistema, clase_cliente, tipo_pago_bsale_id)\n			VALUES\n			(\'76245945\', \'0\', \'IDAMAPU SA\', \'Inmobiliaria\', \'313\', \'13\', \'EL CIPRéS 2404\', \'MTAMPE@IDANMAPU.COM\', \'MARTíN TAMPE\', \'\', \'991823126\', \'\', \'2\', \'108\', \'2\', \'11\')','insert'),(99646,108,'2018-08-24 10:18:53','UPDATE personaempresa SET cliente_id_bsale = \'26\' WHERE id = \'15\'','update'),(99671,108,'2018-08-24 10:43:31','INSERT INTO arriendo_equipos_datos (IdServicio, Velocidad, Plan, IdOrigen, IdProducto, TipoDestino) VALUES (\'689\', \'5x2\', \'R5\', \'10\', \'0\', \'2\')','insert'),(101126,108,'2018-08-24 16:38:28','INSERT INTO personaempresa\n			(rut, dv, nombre, giro, ciudad, region, direccion, correo, contacto, comentario, telefono, alias, tipo_cliente, id_usuario_sistema, clase_cliente, tipo_pago_bsale_id)\n			VALUES\n			(\'6448076\', \'6\', \'JOANNE DUNCAN CARRASCO\', \'Sin giro, persona natural\', \'313\', \'13\', \'KM. 40,3.  LAS MARGARITAS, PARCELA 8\', \'JOANNEDUNCAN@GMAIL.COM\', \'JOANNE DUNCAN\', \'\', \'999971334\', \'\', \'1\', \'108\', \'1\', \'15\')','insert'),(101129,108,'2018-08-24 16:38:30','UPDATE personaempresa SET cliente_id_bsale = \'27\' WHERE id = \'16\'','update'),(101130,108,'2018-08-24 16:38:30','INSERT INTO correo_extra (IdUsuario, Correo) VALUES (\'16\', \'bhaywood@mac.com \')','insert'),(101159,108,'2018-08-24 17:03:53','INSERT INTO arriendo_equipos_datos (IdServicio, Velocidad, Plan, IdOrigen, IdProducto, TipoDestino) VALUES (\'690\', \'5x2\', \'R5\', \'10\', \'0\', \'2\')','insert'),(101784,108,'2018-08-27 12:38:15','INSERT INTO giros (nombre) VALUES (\'Apicultura\')','insert'),(101937,108,'2018-08-27 13:39:57','INSERT INTO personaempresa\n			(rut, dv, nombre, giro, ciudad, region, direccion, correo, contacto, comentario, telefono, alias, tipo_cliente, id_usuario_sistema, clase_cliente, tipo_pago_bsale_id)\n			VALUES\n			(\'76608219\', \'K\', \'LA PICA DE LA ABEJA SPA\', \'Apicultura\', \'313\', \'13\', \'SAN EDRO 519.  LOCAL 4\', \'APISU@YAHOO.COM\', \'HUGO MORAGA\', \'\', \'998731582\', \'\', \'2\', \'108\', \'1\', \'15\')','insert'),(101940,108,'2018-08-27 13:39:59','UPDATE personaempresa SET cliente_id_bsale = \'28\' WHERE id = \'17\'','update'),(101965,108,'2018-08-27 13:44:57','INSERT INTO arriendo_equipos_datos (IdServicio, Velocidad, Plan, IdOrigen, IdProducto, TipoDestino) VALUES (\'691\', \'3x1\', \'R3\', \'10\', \'0\', \'2\')','insert'),(102006,108,'2018-08-27 13:52:54','INSERT INTO nota_venta(rut, fecha, numero_oc, fecha_oc, solicitado_por, estatus_facturacion) VALUES (\'6448076\',\'2018-08-27\',\'\',\'2018-08-27\',\'Esteban Eduardo Salas Tejedas\',\'0\')','insert'),(102007,108,'2018-08-27 13:52:54','INSERT INTO nota_venta_detalle(nota_venta_id, concepto, cantidad, precio, total) VALUES (\'35\',\'Habilitación tercera Cabaña, 25 mts. de ducto, 45 mts. de cable, más materiales\',\'1\',\'297550\',\'354085\')','insert'),(102567,110,'2018-08-28 10:55:35',' UPDATE servicios SET Codigo = \'86247400-7FSMI10\', Grupo = \'4\', TipoFactura = \'13\', Valor = \'12\', Descuento = \'0\', Descripcion = \'\', Conexion = \'CENTRO HUAPI\', Direccion = \'\', Latitud = \'-41.3214705\', Longitud = \'-73.0138898\', Referencia = \'\', Contacto = \'\', Fono = \'\', PosibleEstacion = \'\', Equipamiento = \'\', SenalTeorica = \'\', UsuarioPppoeTeorico = \'\', FechaComprometidaInstalacion = \'1969-01-31\', CostoInstalacion = \'0\', CostoInstalacionDescuento = \'0\' WHERE Id = \'681\'','update'),(112487,108,'2018-08-30 13:42:11','INSERT INTO personaempresa\n			(rut, dv, nombre, giro, ciudad, region, direccion, correo, contacto, comentario, telefono, alias, tipo_cliente, id_usuario_sistema, clase_cliente, tipo_pago_bsale_id)\n			VALUES\n			(\'6375115\', \'4\', \'MARíA IRENE EGUIGUREN LARRAíN\', \'SIN GIRO, PERSONA NATURAL\', \'109\', \'7\', \'BURGOS 88. DPTO 17\', \'IRENEEGUIGUREN@GMAIL.COM\', \'MARíA IRENE EGUIGUREN LARRAíN\', \'\', \'998281209\', \'\', \'1\', \'108\', \'1\', \'15\')','insert'),(112490,108,'2018-08-30 13:42:15','UPDATE personaempresa SET cliente_id_bsale = \'30\' WHERE id = \'10000\'','update'),(114843,110,'2018-08-30 18:18:36','INSERT INTO nota_venta(rut, fecha, numero_oc, fecha_oc, solicitado_por, estatus_facturacion) VALUES (\'6593446\',\'2018-08-30\',\'\',\'1969-01-31\',\'113\',\'0\')','insert'),(114844,110,'2018-08-30 18:18:36','INSERT INTO nota_venta_detalle(nota_venta_id, concepto, cantidad, precio, total) VALUES (\'41\',\'asiss\',\'1\',\'54568\',\'64936\')','insert'),(119256,108,'2018-09-03 13:56:50','INSERT INTO giros (nombre) VALUES (\'AGRICOLA\')','insert'),(119258,108,'2018-09-03 13:58:08','INSERT INTO personaempresa\n			(rut, dv, nombre, giro, ciudad, region, direccion, correo, contacto, comentario, telefono, alias, tipo_cliente, id_usuario_sistema, clase_cliente, tipo_pago_bsale_id)\n			VALUES\n			(\'76250727\', \'7\', \'AGRíCOLA Y FORESTAL EL MAITéN LTDA.\', \'AGRICOLA\', \'208\', \'10\', \'JUAN ANTONIO COLOMA 202.\', \'PILAR_GUZ@HOTMAIL.COM\', \'MARíA DEL PILAR GUZMáN\', \'CONTACTO DEL FUNDO: JOSé SOTO: 974033563\', \'998210504\', \'\', \'2\', \'108\', \'1\', \'15\')','insert'),(119261,108,'2018-09-03 13:58:10','UPDATE personaempresa SET cliente_id_bsale = \'31\' WHERE id = \'10001\'','update'),(120206,110,'2018-09-07 16:32:26','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento, NumeroOC, FechaOC) VALUES (\'17520287\', \'1\', \'2\', \'1\', \'50\', \'http://app2.bsale.cl/view/15057/3a5dacd2f012.pdf?sfd=99\', \'1\', \'\', NOW(), NOW(), \'1\', \'2018-09-27\', 0.19, \'17\', \'\', \'1970-01-31\')','insert'),(120207,110,'2018-09-07 16:32:29','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'2973\', \'Arriendo de Equipos de Datos  - Mes Agosto \', \'27298\', \'1\', \'0\', \'685\', \'32485\', \'17520287-0BSMI01\')','insert'),(120210,108,'2018-09-10 14:13:07','INSERT INTO personaempresa\n			(rut, dv, nombre, giro, ciudad, region, direccion, correo, contacto, comentario, telefono, alias, tipo_cliente, id_usuario_sistema, clase_cliente, tipo_pago_bsale_id)\n			VALUES\n			(\'6417882\', \'2\', \'RAMóN LOLAS MORALES\', \'SIN GIRO, PERSONA NATURAL\', \'110\', \'7\', \'CERRO BLANCO 2131.\', \'RLOLAS@PIMASA.COM\', \'RAMóN LOLAS\', \'\', \'998264189\', \'\', \'1\', \'108\', \'1\', \'15\')','insert'),(120211,108,'2018-09-10 14:13:09','UPDATE personaempresa SET cliente_id_bsale = \'32\' WHERE id = \'10002\'','update'),(120212,108,'2018-09-10 14:31:10','INSERT INTO mantenedor_tipo_factura (codigo, descripcion, tipo_facturacion) VALUES (\'\', \'\', \'1\')','insert'),(120213,108,'2018-09-10 14:31:20','INSERT INTO arriendo_equipos_datos (IdServicio, Velocidad, Plan, IdOrigen, IdProducto, TipoDestino) VALUES (\'701\', \'3x1\', \'R3\', \'10\', \'0\', \'2\')','insert'),(120224,109,'2018-09-10 17:16:19','INSERT INTO nota_venta(rut, fecha, numero_oc, fecha_oc, solicitado_por, estatus_facturacion) VALUES (\'6448076\',\'2018-09-10\',\'\',\'1969-01-31\',\'108\',\'0\')','insert'),(120225,109,'2018-09-10 17:16:19','INSERT INTO nota_venta_detalle(nota_venta_id, concepto, cantidad, precio, total) VALUES (\'44\',\'Ducto plástico para cable de red desde Domicilio hasta cabaña\',\'1\',\'20760\',\'24704\')','insert'),(120226,109,'2018-09-10 17:16:19','INSERT INTO nota_venta_detalle(nota_venta_id, concepto, cantidad, precio, total) VALUES (\'44\',\'Cable de red 5e exterior con conectores blindados\',\'1\',\'33300\',\'39627\')','insert'),(120227,109,'2018-09-10 17:16:19','INSERT INTO nota_venta_detalle(nota_venta_id, concepto, cantidad, precio, total) VALUES (\'44\',\'Materiales(amarras, abrazaderas,fijaciones,sellos)\',\'1\',\'13200\',\'15708\')','insert'),(120228,109,'2018-09-10 17:16:19','INSERT INTO nota_venta_detalle(nota_venta_id, concepto, cantidad, precio, total) VALUES (\'44\',\'Router adicional como mayor desempeño y capacidad de manejo\',\'1\',\'65300\',\'77707\')','insert'),(120229,109,'2018-09-10 17:16:19','INSERT INTO nota_venta_detalle(nota_venta_id, concepto, cantidad, precio, total) VALUES (\'44\',\'Mano de Obra de trabajos\',\'1\',\'144000\',\'171360\')','insert'),(120231,109,'2018-09-10 17:17:10','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, NumeroOC, FechaOC) VALUES (\'6448076\', \'1000\', \'1\', \'0\', NOW(), NOW(), \'1\', NOW(), 0.19, \'0\', \'\', \'0\', \'\', \'\', \'1969-01-31\')','insert'),(120232,109,'2018-09-10 17:17:10','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'2974\', \'Ducto plástico para cable de red desde Domicilio hasta cabaña\', \'20760\', \'1\', \'0\', \'0\', \'24704\', \'\')','insert'),(120233,109,'2018-09-10 17:17:10','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'2974\', \'Cable de red 5e exterior con conectores blindados\', \'33300\', \'1\', \'0\', \'0\', \'39627\', \'\')','insert'),(120234,109,'2018-09-10 17:17:10','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'2974\', \'Materiales(amarras, abrazaderas,fijaciones,sellos)\', \'13200\', \'1\', \'0\', \'0\', \'15708\', \'\')','insert'),(120235,109,'2018-09-10 17:17:10','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'2974\', \'Router adicional como mayor desempeño y capacidad de manejo\', \'65300\', \'1\', \'0\', \'0\', \'77707\', \'\')','insert'),(120236,109,'2018-09-10 17:17:10','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'2974\', \'Mano de Obra de trabajos\', \'144000\', \'1\', \'0\', \'0\', \'171360\', \'\')','insert'),(120237,109,'2018-09-10 17:17:10','UPDATE nota_venta SET estatus_facturacion = 1, factura_id = \'2974\' WHERE id = \'44\'','update'),(120238,109,'2018-09-10 17:17:38','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento, NumeroOC, FechaOC) VALUES (\'6448076\', \'1000\', \'1\', \'1\', \'51\', \'http://app2.bsale.cl/view/15057/77d3d335447c.pdf?sfd=99\', \'1\', \'\', NOW(), NOW(), \'1\', \'2018-09-30\', 0.19, \'18\', \'\', \'1969-01-31\')','insert'),(120239,109,'2018-09-10 17:17:42','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'2975\', \'Ducto plástico para cable de red desde Domicilio hasta cabaña\', \'20760\', \'1\', \'0\', \'0\', \'24704\', \'\')','insert'),(120240,109,'2018-09-10 17:17:42','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'2975\', \'Cable de red 5e exterior con conectores blindados\', \'33300\', \'1\', \'0\', \'0\', \'39627\', \'\')','insert'),(120241,109,'2018-09-10 17:17:42','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'2975\', \'Materiales(amarras, abrazaderas,fijaciones,sellos)\', \'13200\', \'1\', \'0\', \'0\', \'15708\', \'\')','insert'),(120242,109,'2018-09-10 17:17:42','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'2975\', \'Router adicional como mayor desempeño y capacidad de manejo\', \'65300\', \'1\', \'0\', \'0\', \'77707\', \'\')','insert'),(120243,109,'2018-09-10 17:17:42','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'2975\', \'Mano de Obra de trabajos\', \'144000\', \'1\', \'0\', \'0\', \'171360\', \'\')','insert'),(120247,108,'2018-09-10 18:44:25','INSERT INTO arriendo_equipos_datos (IdServicio, Velocidad, Plan, IdOrigen, IdProducto, TipoDestino) VALUES (\'702\', \'3x1\', \'R3\', \'10\', \'0\', \'2\')','insert'),(120252,108,'2018-09-10 18:47:17','INSERT INTO nota_venta(rut, fecha, numero_oc, fecha_oc, solicitado_por, estatus_facturacion) VALUES (\'76250727\',\'2018-09-10\',\'\',\'1969-01-31\',\'113\',\'0\')','insert'),(120253,108,'2018-09-10 18:47:17','INSERT INTO nota_venta_detalle(nota_venta_id, concepto, cantidad, precio, total) VALUES (\'45\',\'Access Point NSM2 Casa Cuidador\',\'1\',\'121849\',\'145000\')','insert'),(120256,109,'2018-09-11 10:49:32','INSERT INTO devoluciones(FacturaId, DevolucionIdBsale, DocumentoIdBsale, UrlPdfBsale, Motivo, FechaDevolucion, HoraDevolucion, NumeroDocumento, DevolucionAnulada) VALUES (\'2971\', \'12\', \'52\', \'http://app2.bsale.cl/view/15057/953886976460.pdf?sfd=99\',\'Boleta Doble Cliente CVT\', NOW(), NOW(),\'5\', \'0\')','insert'),(120257,109,'2018-09-11 10:49:32','UPDATE facturas SET EstatusFacturacion = \'2\', FechaFacturacion = NOW() WHERE Id = \'2971\'','update'),(120258,108,'2018-09-11 11:50:02','INSERT INTO giros (nombre) VALUES (\'SERVICIOS\')','insert'),(120259,108,'2018-09-11 11:51:02','INSERT INTO personaempresa\n			(rut, dv, nombre, giro, ciudad, region, direccion, correo, contacto, comentario, telefono, alias, tipo_cliente, id_usuario_sistema, clase_cliente, tipo_pago_bsale_id)\n			VALUES\n			(\'76521560\', \'9\', \'SERVICIOS INTEGRALES DEL SUR S.A.\', \'SERVICIOS\', \'313\', \'13\', \'RUTA 225.  KM. 40\', \'SIS.PTOVARAS@GMAIL.COM\', \'SEBASTIáN RAIMANN\', \'\', \'982342621\', \'\', \'2\', \'108\', \'1\', \'15\')','insert'),(120260,108,'2018-09-11 11:51:03','UPDATE personaempresa SET cliente_id_bsale = \'33\' WHERE id = \'10003\'','update'),(120263,108,'2018-09-11 12:09:23','INSERT INTO nota_venta(rut, fecha, numero_oc, fecha_oc, solicitado_por, estatus_facturacion) VALUES (\'17296156\',\'2018-09-11\',\'\',\'1969-01-31\',\'108\',\'0\')','insert'),(120264,108,'2018-09-11 12:09:23','INSERT INTO nota_venta_detalle(nota_venta_id, concepto, cantidad, precio, total) VALUES (\'46\',\'Instalación y habilitación enlace Internet\',\'1\',\'83193\',\'99000\')','insert'),(120268,108,'2018-09-12 13:28:30','UPDATE personaempresa SET alias = \'\', nombre = \'JAVIER ALEJANDRO JOBIS VARGAS\', giro = \'TRANSPORTE MARÍTIMO\', direccion = \'CALLE 1 S/N\', correo = \'AJOBIS@HOTMAIL.COM\', contacto = \'JAVIER JOBIS\', comentario = \'DIRECCIóN DE ANTENA: SECTOR EL COBRE S/N.  HORNOPIRéN\', telefono = \'9987696084\', tipo_cliente = \'2\', ciudad = \'323\', region = \'13\', tipo_pago_bsale_id = \'15\' WHERE id = \'7\'','update'),(120269,108,'2018-09-12 13:31:49','INSERT INTO personaempresa\n			(rut, dv, nombre, giro, ciudad, region, direccion, correo, contacto, comentario, telefono, alias, tipo_cliente, id_usuario_sistema, clase_cliente, tipo_pago_bsale_id)\n			VALUES\n			(\'15514913\', \'2\', \'ANTONIO KURTE GóMEZ\', \'SIN GIRO, PERSONA NATURAL\', \'312\', \'13\', \'CAMINO NUEVA BRAUNAU.  KM. 3.  PARCELA 12\', \'TONOKURTE@GMAIL.COM\', \'ANTONIO KURTE\', \'\', \'998843849\', \'\', \'1\', \'108\', \'1\', \'15\')','insert'),(120270,108,'2018-09-12 13:31:55','UPDATE personaempresa SET cliente_id_bsale = \'34\' WHERE id = \'10004\'','update'),(120271,108,'2018-09-12 14:51:22','INSERT INTO arriendo_equipos_datos (IdServicio, Velocidad, Plan, IdOrigen, IdProducto, TipoDestino) VALUES (\'703\', \'3x1\', \'R3\', \'10\', \'0\', \'2\')','insert'),(120272,108,'2018-09-12 14:52:42','UPDATE `servicios` set `FacturarSinInstalacion` = \'1\' where `Id` = \'703\'','update'),(120273,108,'2018-09-12 15:31:55','UPDATE servicios set IdUsuarioAsignado = \'110\', Estatus = \'3\' where Id = \'703\'','update'),(120274,108,'2018-09-12 15:55:12','INSERT INTO arriendo_equipos_datos (IdServicio, Velocidad, Plan, IdOrigen, IdProducto, TipoDestino) VALUES (\'704\', \'3x1\', \'R3\', \'10\', \'0\', \'2\')','insert'),(120275,108,'2018-09-12 15:55:16','UPDATE `servicios` set `FacturarSinInstalacion` = \'1\' where `Id` = \'704\'','update'),(120276,108,'2018-09-12 15:55:51','UPDATE servicios set IdUsuarioAsignado = \'110\', Estatus = \'3\' where Id = \'704\'','update'),(120279,108,'2018-09-12 15:58:59','INSERT INTO nota_venta(rut, fecha, numero_oc, fecha_oc, solicitado_por, estatus_facturacion) VALUES (\'76521560\',\'2018-09-11\',\'\',\'1969-01-31\',\'108\',\'0\')','insert'),(120280,108,'2018-09-12 15:58:59','INSERT INTO nota_venta_detalle(nota_venta_id, concepto, cantidad, precio, total) VALUES (\'47\',\'Puente inalámbrico: Emisor+Receptor+Router\',\'1\',\'232003\',\'276084\')','insert'),(120282,110,'2018-09-12 16:22:29','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento, NumeroOC, FechaOC) VALUES (\'15250162\', \'1\', \'2\', \'1\', \'53\', \'http://app2.bsale.cl/view/15057/6237bf31fa22.pdf?sfd=99\', \'1\', \'\', NOW(), NOW(), \'1\', \'2018-10-02\', 0.19, \'19\', \'\', \'1970-01-31\')','insert'),(120283,110,'2018-09-12 16:22:32','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'2976\', \'Arriendo de Equipos de Datos  - Mes Agosto \', \'27298\', \'1\', \'0\', \'688\', \'32485\', \'15250162-5BSMI01\')','insert'),(120286,110,'2018-09-12 16:22:55','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento, NumeroOC, FechaOC) VALUES (\'76245945\', \'1\', \'2\', \'1\', \'54\', \'http://app2.bsale.cl/view/15057/58524c8f8255.pdf?sfd=99\', \'1\', \'\', NOW(), NOW(), \'2\', \'2018-10-02\', 0.19, \'21\', \'\', \'1970-01-31\')','insert'),(120287,110,'2018-09-12 16:23:00','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'2977\', \'Arriendo de Equipos de Datos  - Mes Agosto \', \'54596\', \'1\', \'0\', \'689\', \'64969\', \'76245945-0FSMI01\')','insert'),(120290,110,'2018-09-12 16:23:20','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento, NumeroOC, FechaOC) VALUES (\'76830018\', \'1\', \'2\', \'1\', \'55\', \'http://app2.bsale.cl/view/15057/b8e6f4686105.pdf?sfd=99\', \'1\', \'\', NOW(), NOW(), \'2\', \'2018-10-02\', 0.19, \'22\', \'\', \'1970-01-31\')','insert'),(120291,110,'2018-09-12 16:23:27','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'2978\', \'Arriendo de Equipos de Datos  - Proporcional Junio (2 Dias)\', \'3635.06\', \'1\', \'0\', \'686\', \'4326\', \'76830018-6FSMI01\')','insert'),(120292,110,'2018-09-12 16:23:27','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'2978\', \'Arriendo de Equipos de Datos  - Mes Julio\', \'54456\', \'1\', \'0\', \'686\', \'64803\', \'76830018-6FSMI01\')','insert'),(120293,110,'2018-09-12 16:23:27','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'2978\', \'Arriendo de Equipos de Datos  - Mes Agosto \', \'54596\', \'1\', \'0\', \'686\', \'64969\', \'76830018-6FSMI01\')','insert'),(120302,108,'2018-09-12 23:40:06','INSERT INTO nota_venta(rut, fecha, numero_oc, fecha_oc, solicitado_por, estatus_facturacion) VALUES (\'76245945\',\'2018-09-13\',\'\',\'1969-01-31\',\'108\',\'0\')','insert'),(120303,108,'2018-09-12 23:40:06','INSERT INTO nota_venta_detalle(nota_venta_id, concepto, cantidad, precio, total) VALUES (\'48\',\'Habilitación Segundo Domicilio\',\'1\',\'163746\',\'194858\')','insert'),(120306,108,'2018-09-12 23:42:11','UPDATE nota_venta SET rut = \'76245945\', fecha = \'2018-09-13\', numero_oc = \'\', fecha_oc = \'1969-01-31\', solicitado_por = \'108\' WHERE id = \'48\'','update'),(120311,108,'2018-09-13 13:13:39','INSERT INTO nota_venta(rut, fecha, numero_oc, fecha_oc, solicitado_por, estatus_facturacion) VALUES (\'76521560\',\'2018-09-13\',\'\',\'1969-01-31\',\'108\',\'0\')','insert'),(120312,108,'2018-09-13 13:13:39','INSERT INTO nota_venta_detalle(nota_venta_id, concepto, cantidad, precio, total) VALUES (\'49\',\'Habilitación Servicio Internet\',\'1\',\'382074\',\'454668\')','insert'),(120313,108,'2018-09-13 13:13:39','INSERT INTO nota_venta_detalle(nota_venta_id, concepto, cantidad, precio, total) VALUES (\'49\',\'Red LAN, equipo emisor, equipo receptor, router WiFi\',\'1\',\'232003\',\'276084\')','insert'),(120315,108,'2018-09-13 13:20:34','INSERT INTO personaempresa\n			(rut, dv, nombre, giro, ciudad, region, direccion, correo, contacto, comentario, telefono, alias, tipo_cliente, id_usuario_sistema, clase_cliente, tipo_pago_bsale_id)\n			VALUES\n			(\'765666\', \'1\', \'ÁLVARO POBLETE SMITH\', \'SIN GIRO, PERSONA NATURAL\', \'309\', \'13\', \'PARCELACIóN LLANQUIHUE\', \'APOBLETE@CAMANCHACA.CL\', \'ÁLVARO POBLETE\', \'GERENTE GENERAL CAMANCHACA\', \'9 9444 2214\', \'\', \'1\', \'108\', \'3\', \'15\')','insert'),(120316,108,'2018-09-13 13:20:36','UPDATE personaempresa SET cliente_id_bsale = \'35\' WHERE id = \'10005\'','update'),(120317,108,'2018-09-14 10:30:14','INSERT INTO arriendo_equipos_datos (IdServicio, Velocidad, Plan, IdOrigen, IdProducto, TipoDestino) VALUES (\'705\', \'8x3\', \'R8\', \'10\', \'0\', \'2\')','insert'),(120319,108,'2018-09-20 13:05:08','INSERT INTO giros (nombre) VALUES (\'EXPLOTACIóN MIXTA\')','insert'),(120320,108,'2018-09-20 13:15:21','INSERT INTO personaempresa\n			(rut, dv, nombre, giro, ciudad, region, direccion, correo, contacto, comentario, telefono, alias, tipo_cliente, id_usuario_sistema, clase_cliente, tipo_pago_bsale_id)\n			VALUES\n			(\'76243328\', \'1\', \'AGRíCOLA Y COMERCIAL NOMEHUE LTDA.\', \'EXPLOTACIóN MIXTA\', \'102\', \'7\', \'AVENIDA DEL VALLE NORTE 787.  OF 404.\', \'DCOVARRUBIAS@NOMEHUE.CL\', \'GERMáN CISTERNAS OSSA\', \'FONO PERSONAL DON GERMáN: +56 9 8769 7573\', \'227547500\', \'\', \'2\', \'108\', \'1\', \'15\')','insert'),(120321,108,'2018-09-20 13:15:24','UPDATE personaempresa SET cliente_id_bsale = \'36\' WHERE id = \'10006\'','update'),(120327,108,'2018-09-21 12:53:57','INSERT INTO nota_venta(rut, fecha, numero_oc, fecha_oc, solicitado_por, estatus_facturacion) VALUES (\'6593446\',\'2018-09-21\',\'\',\'1969-01-31\',\'108\',\'0\')','insert'),(120328,108,'2018-09-21 12:53:57','INSERT INTO nota_venta_detalle(nota_venta_id, concepto, cantidad, precio, total) VALUES (\'50\',\'Visita Técnica, Cambio iluminador antena principal (1° junio)\',\'1\',\'40713\',\'48448\')','insert'),(120329,108,'2018-09-21 12:53:57','INSERT INTO nota_venta_detalle(nota_venta_id, concepto, cantidad, precio, total) VALUES (\'50\',\'Visita Técnica, cambio PoE y cable (04 julio)\',\'1\',\'27291\',\'32476\')','insert'),(120333,108,'2018-09-21 12:58:11','INSERT INTO nota_venta(rut, fecha, numero_oc, fecha_oc, solicitado_por, estatus_facturacion) VALUES (\'8466934\',\'2018-09-21\',\'\',\'1969-01-31\',\'108\',\'0\')','insert'),(120334,108,'2018-09-21 12:58:11','INSERT INTO nota_venta_detalle(nota_venta_id, concepto, cantidad, precio, total) VALUES (\'51\',\'Visita Técnica, Reconfiguración NVR (24 agosto)\',\'1\',\'27518\',\'32746\')','insert'),(120337,108,'2018-09-21 15:33:22','UPDATE personaempresa SET alias = \'\', nombre = \'LA PICA DE LA ABEJA SPA\', giro = \'APICULTURA\', direccion = \'SAN PEDRO 519.  LOCAL 4\', correo = \'APISU@YAHOO.COM\', contacto = \'HUGO MORAGA\', comentario = \'\', telefono = \'998731582\', tipo_cliente = \'2\', ciudad = \'313\', region = \'13\', tipo_pago_bsale_id = \'15\' WHERE id = \'17\'','update'),(120338,108,'2018-09-21 15:34:49','UPDATE servicios set IdUsuarioAsignado = \'110\', EstatusInstalacion = \'3\' where Id = \'702\'','update'),(120341,110,'2018-09-21 16:29:53','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, NumeroOC, FechaOC) VALUES (\'6593446\', \'1000\', \'1\', \'0\', NOW(), NOW(), \'1\', NOW(), 0.19, \'0\', \'\', \'0\', \'\', \'\', \'1969-01-31\')','insert'),(120342,110,'2018-09-21 16:29:53','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'2979\', \'Visita Técnica, Cambio iluminador antena principal (1° junio)\', \'40713\', \'1\', \'0\', \'0\', \'48448\', \'\')','insert'),(120343,110,'2018-09-21 16:29:53','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'2979\', \'Visita Técnica, cambio PoE y cable (04 julio)\', \'27291\', \'1\', \'0\', \'0\', \'32476\', \'\')','insert'),(120344,110,'2018-09-21 16:29:53','UPDATE nota_venta SET estatus_facturacion = 1, factura_id = \'2979\' WHERE id = \'50\'','update'),(120346,110,'2018-09-21 16:30:42','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, NumeroOC, FechaOC) VALUES (\'76245945\', \'1000\', \'1\', \'0\', NOW(), NOW(), \'2\', NOW(), 0.19, \'0\', \'\', \'0\', \'\', \'\', \'1969-01-31\')','insert'),(120347,110,'2018-09-21 16:30:42','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'2980\', \'Habilitación Segundo Domicilio\', \'163746\', \'1\', \'0\', \'0\', \'194858\', \'\')','insert'),(120348,110,'2018-09-21 16:30:42','UPDATE nota_venta SET estatus_facturacion = 1, factura_id = \'2980\' WHERE id = \'48\'','update'),(120349,110,'2018-09-21 16:31:28','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, NumeroOC, FechaOC) VALUES (\'8466934\', \'1000\', \'1\', \'0\', NOW(), NOW(), \'1\', NOW(), 0.19, \'0\', \'\', \'0\', \'\', \'\', \'1969-01-31\')','insert'),(120350,110,'2018-09-21 16:31:28','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'2981\', \'Visita Técnica, Reconfiguración NVR (24 agosto)\', \'27518\', \'1\', \'0\', \'0\', \'32746\', \'\')','insert'),(120351,110,'2018-09-21 16:31:28','UPDATE nota_venta SET estatus_facturacion = 1, factura_id = \'2981\' WHERE id = \'51\'','update'),(120352,110,'2018-09-21 16:33:09','DELETE from nota_venta_detalle where nota_venta_id = \'47\'','delete'),(120353,110,'2018-09-21 16:33:09','DELETE from nota_venta where id = \'47\'','delete'),(120354,110,'2018-09-21 16:33:16','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, NumeroOC, FechaOC) VALUES (\'76521560\', \'1000\', \'1\', \'0\', NOW(), NOW(), \'2\', NOW(), 0.19, \'0\', \'\', \'0\', \'\', \'\', \'1969-01-31\')','insert'),(120355,110,'2018-09-21 16:33:16','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'2982\', \'Habilitación Servicio Internet\', \'382074\', \'1\', \'0\', \'0\', \'454668\', \'\')','insert'),(120356,110,'2018-09-21 16:33:16','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'2982\', \'Red LAN, equipo emisor, equipo receptor, router WiFi\', \'232003\', \'1\', \'0\', \'0\', \'276084\', \'\')','insert'),(120357,110,'2018-09-21 16:33:16','UPDATE nota_venta SET estatus_facturacion = 1, factura_id = \'2982\' WHERE id = \'49\'','update'),(120362,108,'2018-09-24 15:34:33','INSERT INTO arriendo_equipos_datos (IdServicio, Velocidad, Plan, IdOrigen, IdProducto, TipoDestino) VALUES (\'706\', \'3x1\', \'P3\', \'10\', \'0\', \'2\')','insert'),(120365,108,'2018-09-24 15:37:52','INSERT INTO nota_venta(rut, fecha, numero_oc, fecha_oc, solicitado_por, estatus_facturacion) VALUES (\'76243328\',\'2018-09-24\',\'\',\'1969-01-31\',\'108\',\'0\')','insert'),(120366,108,'2018-09-24 15:37:52','INSERT INTO nota_venta_detalle(nota_venta_id, concepto, cantidad, precio, total) VALUES (\'52\',\'Puente inalámbrico desde Oficina a nueva cabaña, más router WiFi\',\'1\',\'368429\',\'438431\')','insert'),(120368,108,'2018-09-24 15:38:07','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, NumeroOC, FechaOC) VALUES (\'76243328\', \'1000\', \'1\', \'0\', NOW(), NOW(), \'2\', NOW(), 0.19, \'0\', \'\', \'0\', \'\', \'\', \'1969-01-31\')','insert'),(120369,108,'2018-09-24 15:38:07','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'2983\', \'Puente inalámbrico desde Oficina a nueva cabaña, más router WiFi\', \'368429\', \'1\', \'0\', \'0\', \'438431\', \'\')','insert'),(120370,108,'2018-09-24 15:38:07','UPDATE nota_venta SET estatus_facturacion = 1, factura_id = \'2983\' WHERE id = \'52\'','update'),(120375,108,'2018-09-25 17:49:04','INSERT INTO personaempresa\n			(rut, dv, nombre, giro, ciudad, region, direccion, correo, contacto, comentario, telefono, alias, tipo_cliente, id_usuario_sistema, clase_cliente, tipo_pago_bsale_id)\n			VALUES\n			(\'10420529\', \'1\', \'ANTONIO DOMINGO CELEDóN SANHUEZA\', \'HOTELES Y RESTAURANTES\', \'323\', \'13\', \'INGENIERO MILITAR S/N.  HORNOPIRéN\', \'INFO@ENTREMONTANAS.CL\', \'CAROLAINE CELEDóN\', \'\', \'978489705\', \'HOTEL ENTRE MONTAñAS\', \'2\', \'108\', \'1\', \'15\')','insert'),(120376,108,'2018-09-25 17:49:05','UPDATE personaempresa SET cliente_id_bsale = \'37\' WHERE id = \'10000\'','update'),(120377,108,'2018-09-25 17:54:03','INSERT INTO arriendo_equipos_datos (IdServicio, Velocidad, Plan, IdOrigen, IdProducto, TipoDestino) VALUES (\'707\', \'3x1\', \'R3\', \'10\', \'0\', \'2\')','insert'),(120378,108,'2018-09-25 17:54:35','UPDATE `servicios` set `FacturarSinInstalacion` = \'1\' where `Id` = \'707\'','update'),(120380,108,'2018-09-25 17:56:15','UPDATE servicios set IdUsuarioAsignado = \'110\', EstatusInstalacion = \'3\' where Id = \'707\'','update'),(120392,109,'2018-09-26 16:03:02','INSERT INTO facturas_pagos(FacturaId, FechaPago, TipoPago, Detalle, Monto, FechaEmisionCheque, FechaVencimientoCheque, IdUsuarioSession) VALUES (\'2825\',\'2018-09-05\',\'8\',\'CONVENIO PAC\',\'32401\',\'1969-01-31\',\'1969-01-31\',\'109\')','insert'),(120393,109,'2018-09-26 16:04:40','INSERT INTO facturas_pagos(FacturaId, FechaPago, TipoPago, Detalle, Monto, FechaEmisionCheque, FechaVencimientoCheque, IdUsuarioSession) VALUES (\'2826\',\'2018-08-14\',\'8\',\'CONVENIO PAC\',\'162006\',\'1969-01-31\',\'1969-01-31\',\'109\')','insert'),(120394,109,'2018-09-26 16:05:26','INSERT INTO facturas_pagos(FacturaId, FechaPago, TipoPago, Detalle, Monto, FechaEmisionCheque, FechaVencimientoCheque, IdUsuarioSession) VALUES (\'2833\',\'2018-08-14\',\'8\',\'CONVENIO PAC\',\'48602\',\'1969-01-31\',\'1969-01-31\',\'109\')','insert'),(120395,109,'2018-09-26 16:08:15','INSERT INTO facturas_pagos(FacturaId, FechaPago, TipoPago, Detalle, Monto, FechaEmisionCheque, FechaVencimientoCheque, IdUsuarioSession) VALUES (\'2920\',\'2018-08-13\',\'8\',\'EFECTIVO\',\'1\',\'1969-01-31\',\'1969-01-31\',\'109\')','insert'),(120396,109,'2018-09-26 16:09:04','INSERT INTO facturas_pagos(FacturaId, FechaPago, TipoPago, Detalle, Monto, FechaEmisionCheque, FechaVencimientoCheque, IdUsuarioSession) VALUES (\'2832\',\'2018-08-14\',\'8\',\'CONVENIO PAC\',\'64803\',\'1969-01-31\',\'1969-01-31\',\'109\')','insert'),(120397,109,'2018-09-26 16:10:17','INSERT INTO facturas_pagos(FacturaId, FechaPago, TipoPago, Detalle, Monto, FechaEmisionCheque, FechaVencimientoCheque, IdUsuarioSession) VALUES (\'2828\',\'2018-08-24\',\'8\',\'CONVENIO PAC\',\'32401\',\'1969-01-31\',\'1969-01-31\',\'109\')','insert'),(120398,109,'2018-09-26 16:16:01','INSERT INTO facturas_pagos(FacturaId, FechaPago, TipoPago, Detalle, Monto, FechaEmisionCheque, FechaVencimientoCheque, IdUsuarioSession) VALUES (\'2960\',\'2018-09-11\',\'8\',\'CONVENIO PAC\',\'32485\',\'1969-01-31\',\'1969-01-31\',\'109\')','insert'),(120399,109,'2018-09-26 16:17:13','INSERT INTO facturas_pagos(FacturaId, FechaPago, TipoPago, Detalle, Monto, FechaEmisionCheque, FechaVencimientoCheque, IdUsuarioSession) VALUES (\'2961\',\'2018-09-11\',\'8\',\'CONVENIO PAC\',\'162423\',\'1969-01-31\',\'1969-01-31\',\'109\')','insert'),(120400,109,'2018-09-26 16:19:53','INSERT INTO facturas_pagos(FacturaId, FechaPago, TipoPago, Detalle, Monto, FechaEmisionCheque, FechaVencimientoCheque, IdUsuarioSession) VALUES (\'2964\',\'2018-09-11\',\'8\',\'CONVENIO PAC\',\'48727\',\'1969-01-31\',\'1969-01-31\',\'109\')','insert'),(120401,109,'2018-09-26 16:24:38','INSERT INTO facturas_pagos(FacturaId, FechaPago, TipoPago, Detalle, Monto, FechaEmisionCheque, FechaVencimientoCheque, IdUsuarioSession) VALUES (\'2962\',\'2018-09-11\',\'8\',\'CONVENIO PAC\',\'64970\',\'1969-01-31\',\'1969-01-31\',\'109\')','insert'),(120402,109,'2018-09-26 16:25:13','INSERT INTO facturas_pagos(FacturaId, FechaPago, TipoPago, Detalle, Monto, FechaEmisionCheque, FechaVencimientoCheque, IdUsuarioSession) VALUES (\'2959\',\'2018-09-11\',\'8\',\'CONVENIO PAC\',\'32485\',\'1969-01-31\',\'1969-01-31\',\'109\')','insert'),(120403,109,'2018-09-26 16:27:37','INSERT INTO devoluciones(FacturaId, DevolucionIdBsale, DocumentoIdBsale, UrlPdfBsale, Motivo, FechaDevolucion, HoraDevolucion, NumeroDocumento, DevolucionAnulada) VALUES (\'2975\', \'15\', \'57\', \'http://app2.bsale.cl/view/15057/5eb9ce798329.pdf?sfd=99\',\'error en el monto\', NOW(), NOW(),\'7\', \'0\')','insert'),(120404,109,'2018-09-26 16:27:37','UPDATE facturas SET EstatusFacturacion = \'2\', FechaFacturacion = NOW() WHERE Id = \'2975\'','update'),(120406,109,'2018-09-26 16:30:33','DELETE from nota_venta_detalle where nota_venta_id = \'33\'','delete'),(120407,109,'2018-09-26 16:30:33','DELETE from nota_venta where id = \'33\'','delete'),(120408,109,'2018-09-26 16:30:58','DELETE from nota_venta_detalle where nota_venta_id = \'53\'','delete'),(120409,109,'2018-09-26 16:30:58','DELETE from nota_venta where id = \'53\'','delete'),(120415,109,'2018-09-26 17:02:36','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, NumeroOC, FechaOC) VALUES (\'17296156\', \'1000\', \'1\', \'0\', NOW(), NOW(), \'1\', NOW(), 0.19, \'0\', \'\', \'0\', \'\', \'\', \'1969-01-31\')','insert'),(120416,109,'2018-09-26 17:02:36','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'2984\', \'Instalación y habilitación enlace Internet\', \'83193\', \'1\', \'0\', \'0\', \'99000\', \'\')','insert'),(120417,109,'2018-09-26 17:02:36','UPDATE nota_venta SET estatus_facturacion = 1, factura_id = \'2984\' WHERE id = \'46\'','update'),(120418,109,'2018-09-26 17:03:15','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento, NumeroOC, FechaOC) VALUES (\'17296156\', \'1000\', \'1\', \'1\', \'58\', \'http://app2.bsale.cl/view/15057/5adade42fdc9.pdf?sfd=99\', \'1\', \'\', NOW(), NOW(), \'1\', \'2018-10-16\', 0.19, \'20\', \'\', \'1969-01-31\')','insert'),(120419,109,'2018-09-26 17:03:19','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'2985\', \'Instalación y habilitación enlace Internet\', \'83193\', \'1\', \'0\', \'0\', \'99000\', \'\')','insert'),(120424,108,'2018-09-27 11:24:08','UPDATE personaempresa SET alias = \'INCON\', nombre = \'CONSORCIO INCON - V y E CONSULTORES PICHICOLO LTDA.\', giro = \'ACT. DE ASESORAMIENTO EMPRESARIAL\', direccion = \'AV. APOQUINDO 5555.  OFICINA 608\', correo = \'LUIS.GONZALEZ@INCON.CL\', contacto = \'LUIS GONZáLEZ GALLEGOS\', comentario = \'\', telefono = \'223705366\', tipo_cliente = \'2\', ciudad = \'109\', region = \'7\', tipo_pago_bsale_id = \'15\' WHERE id = \'11\'','update'),(120557,109,'2018-09-28 13:03:00','INSERT INTO facturas_pagos(FacturaId, FechaPago, TipoPago, Detalle, Monto, FechaEmisionCheque, FechaVencimientoCheque, IdUsuarioSession) VALUES (\'2973\',\'2018-09-28\',\'1\',\'008010716007\',\'32485\',\'1969-01-31\',\'1969-01-31\',\'109\')','insert'),(120558,109,'2018-09-28 13:08:15','INSERT INTO facturas_pagos(FacturaId, FechaPago, TipoPago, Detalle, Monto, FechaEmisionCheque, FechaVencimientoCheque, IdUsuarioSession) VALUES (\'2985\',\'2018-09-28\',\'1\',\'00000000000018818099\',\'99000\',\'1969-01-31\',\'1969-01-31\',\'109\')','insert'),(120559,109,'2018-09-28 13:09:16','INSERT INTO facturas_pagos(FacturaId, FechaPago, TipoPago, Detalle, Monto, FechaEmisionCheque, FechaVencimientoCheque, IdUsuarioSession) VALUES (\'2972\',\'2018-09-28\',\'1\',\'00000000000018818099\',\'32485\',\'1969-01-31\',\'1969-01-31\',\'109\')','insert'),(120560,109,'2018-09-28 13:11:10','INSERT INTO facturas_pagos(FacturaId, FechaPago, TipoPago, Detalle, Monto, FechaEmisionCheque, FechaVencimientoCheque, IdUsuarioSession) VALUES (\'2969\',\'2018-09-28\',\'1\',\'00000000000018818099\',\'32485\',\'1969-01-31\',\'1969-01-31\',\'109\')','insert'),(120562,109,'2018-09-28 13:12:44','INSERT INTO facturas_pagos(FacturaId, FechaPago, TipoPago, Detalle, Monto, FechaEmisionCheque, FechaVencimientoCheque, IdUsuarioSession) VALUES (\'2973\',\'2018-09-28\',\'1\',\'00000000000018818099\',\'32370\',\'1969-01-31\',\'1969-01-31\',\'109\')','insert'),(120563,109,'2018-09-28 13:13:48','INSERT INTO facturas_pagos(FacturaId, FechaPago, TipoPago, Detalle, Monto, FechaEmisionCheque, FechaVencimientoCheque, IdUsuarioSession) VALUES (\'2902\',\'2018-09-28\',\'1\',\'00000000000018818099\',\'258293\',\'1969-01-31\',\'1969-01-31\',\'109\')','insert'),(120564,108,'2018-09-28 17:07:02','INSERT INTO usuarios (usuario, nombre, clave, nivel, cargo, email,sexo) VALUES (\'Paula\', \'Paula Reinoso\', \'$2y$10$uZ76jA8FNvL/xVDpF.G2Gu46Y4sEe5VdOjTGuKgn6iC4oXJreRzJu\', \'1\', \'Administración\', \'preinoso@teledata.cl\',\'\')','insert'),(120565,108,'2018-09-28 17:08:46','UPDATE usuarios SET usuario=\'Esteban\', nombre=\'Esteban Salas\', clave=\'$2y$10$9xWWUD0mzPnPexQsu/zC4eHS72mMQhAtcRmNX2q/nilVD4c39GlCK\', nivel=\'1\', cargo=\'Departamento de Ventas\', email=\'esalas@teledata.cl\' WHERE id= 108','update'),(120566,107,'2018-09-28 17:12:59','UPDATE usuarios SET usuario=\'Esteban\', nombre=\'Esteban Salas\', clave=\'$2y$10$lx15c1pF2W7rHjUUy61o0uj3OTiysr2ROXFSPDT0tbqfyuDyfFz5O\', nivel=\'1\', cargo=\'Departamento de Ventas\', email=\'esalas@teledata.cl\' WHERE id= 108','update'),(120572,117,'2018-09-28 17:29:05','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento, NumeroOC, FechaOC) VALUES (\'15514913\', \'1\', \'3\', \'1\', \'59\', \'http://app2.bsale.cl/view/15057/33dcf9bf138e.pdf?sfd=99\', \'1\', \'\', NOW(), NOW(), \'1\', \'2018-10-05\', 0.19, \'21\', \'0\', \'1970-01-31\')','insert'),(120573,117,'2018-09-28 17:29:09','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'2987\', \'Arriendo de Equipos de Datos  - Costo de instalación / Habilitación\', \'184913.04\', \'1\', \'0.00\', \'703\', \'220047\', \'15514913-2BSMI01\')','insert'),(120574,117,'2018-09-28 17:29:09','UPDATE servicios SET EstatusFacturacion = \'1\', FechaFacturacion = NOW() WHERE Id = \'703\'','update'),(120575,117,'2018-09-28 17:38:28','UPDATE usuarios SET usuario=\'Paula\', nombre=\'Paula Reinoso\', clave=\'$2y$10$auW0fN5OuqTdgXt6tMLR0.uymEwH0igJ3GXYxKm.OoZ5TKaJ1fS5S\', nivel=\'1\', cargo=\'Administración\', email=\'preinoso@teledata.cl\' WHERE id= 117','update'),(120677,109,'2018-10-01 16:16:24','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento, NumeroOC, FechaOC) VALUES (\'6593446\', \'1000\', \'1\', \'1\', \'60\', \'http://app2.bsale.cl/view/15057/bce79510a1d7.pdf?sfd=99\', \'1\', \'\', NOW(), NOW(), \'1\', \'2018-10-21\', 0.19, \'22\', \'\', \'1969-01-31\')','insert'),(120678,109,'2018-10-01 16:16:27','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3014\', \'Visita Técnica, Cambio iluminador antena principal (1° junio)\', \'40713\', \'1\', \'0\', \'0\', \'48448\', \'\')','insert'),(120679,109,'2018-10-01 16:16:27','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3014\', \'Visita Técnica, cambio PoE y cable (04 julio)\', \'27291\', \'1\', \'0\', \'0\', \'32476\', \'\')','insert'),(120682,109,'2018-10-01 16:16:39','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento, NumeroOC, FechaOC) VALUES (\'8466934\', \'1000\', \'1\', \'1\', \'61\', \'http://app2.bsale.cl/view/15057/624640c2d2f8.pdf?sfd=99\', \'1\', \'\', NOW(), NOW(), \'1\', \'2018-10-21\', 0.19, \'23\', \'\', \'1969-01-31\')','insert'),(120683,109,'2018-10-01 16:16:42','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3015\', \'Visita Técnica, Reconfiguración NVR (24 agosto)\', \'27518\', \'1\', \'0\', \'0\', \'32746\', \'\')','insert'),(120686,110,'2018-10-01 16:18:20','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento, NumeroOC, FechaOC) VALUES (\'76521560\', \'1000\', \'1\', \'1\', \'62\', \'http://app2.bsale.cl/view/15057/8e95e6f48a43.pdf?sfd=99\', \'1\', \'\', NOW(), NOW(), \'2\', \'2018-10-21\', 0.19, \'23\', \'\', \'1969-01-31\')','insert'),(120687,110,'2018-10-01 16:18:24','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3016\', \'Habilitación Servicio Internet\', \'382074\', \'1\', \'0\', \'0\', \'454668\', \'\')','insert'),(120688,110,'2018-10-01 16:18:24','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3016\', \'Red LAN, equipo emisor, equipo receptor, router WiFi\', \'232003\', \'1\', \'0\', \'0\', \'276084\', \'\')','insert'),(120691,110,'2018-10-01 16:18:33','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento, NumeroOC, FechaOC) VALUES (\'76245945\', \'1000\', \'1\', \'1\', \'63\', \'http://app2.bsale.cl/view/15057/fede3ea7b31b.pdf?sfd=99\', \'1\', \'\', NOW(), NOW(), \'2\', \'2018-10-21\', 0.19, \'24\', \'\', \'1969-01-31\')','insert'),(120692,110,'2018-10-01 16:18:38','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3017\', \'Habilitación Segundo Domicilio\', \'163746\', \'1\', \'0\', \'0\', \'194858\', \'\')','insert'),(120695,110,'2018-10-01 16:18:45','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento, NumeroOC, FechaOC) VALUES (\'76243328\', \'1000\', \'1\', \'1\', \'64\', \'http://app2.bsale.cl/view/15057/649b374d7a99.pdf?sfd=99\', \'1\', \'\', NOW(), NOW(), \'2\', \'2018-10-21\', 0.19, \'25\', \'\', \'1969-01-31\')','insert'),(120696,110,'2018-10-01 16:18:49','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3018\', \'Puente inalámbrico desde Oficina a nueva cabaña, más router WiFi\', \'368429\', \'1\', \'0\', \'0\', \'438431\', \'\')','insert'),(120699,109,'2018-10-01 16:23:00','INSERT INTO facturas_pagos(FacturaId, FechaPago, TipoPago, Detalle, Monto, FechaEmisionCheque, FechaVencimientoCheque, IdUsuarioSession) VALUES (\'2977\',\'2018-10-01\',\'1\',\'TRASPASO DE:IDANMAPU S A\',\'64969\',\'1969-01-31\',\'1969-01-31\',\'109\')','insert'),(120700,109,'2018-10-01 16:23:27','INSERT INTO facturas_pagos(FacturaId, FechaPago, TipoPago, Detalle, Monto, FechaEmisionCheque, FechaVencimientoCheque, IdUsuarioSession) VALUES (\'2977\',\'2018-10-01\',\'1\',\'1\',\'64969\',\'1969-01-31\',\'1969-01-31\',\'109\')','insert'),(120702,109,'2018-10-01 16:33:28','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento) VALUES (\'14638794\', \'1\', \'2\', \'1\', \'65\', \'http://app2.bsale.cl/view/15057/f1677609fd54.pdf?sfd=99\', \'1\', \'\', NOW(), NOW(), \'1\', \'2018-10-21\', 0.19, \'24\')','insert'),(120703,109,'2018-10-01 16:33:31','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3019\', \'Arriendo de Equipos de Datos  - Mes Septiembre\', \'27359\', \'1\', \'0\', \'666\', \'32557\', \'14638794-2BSMI01\')','insert'),(120706,109,'2018-10-01 16:33:32','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento) VALUES (\'12761640\', \'1\', \'2\', \'1\', \'66\', \'http://app2.bsale.cl/view/15057/41fc58c6b105.pdf?sfd=99\', \'1\', \'\', NOW(), NOW(), \'1\', \'2018-10-21\', 0.19, \'25\')','insert'),(120707,109,'2018-10-01 16:33:36','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3020\', \'Arriendo de Equipos de Datos  - Mes Septiembre\', \'123115.5\', \'1\', \'0\', \'667\', \'146507\', \'12761640-KBSMI01\')','insert'),(120708,109,'2018-10-01 16:33:36','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3020\', \'Arriendo de equipos de Telefonía IP - Mes Septiembre\', \'13679.5\', \'1\', \'0\', \'668\', \'16279\', \'12761640-KBSMI02\')','insert'),(120711,109,'2018-10-01 16:33:37','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento) VALUES (\'17296156\', \'1\', \'2\', \'1\', \'67\', \'http://app2.bsale.cl/view/15057/02548c6d0330.pdf?sfd=99\', \'1\', \'\', NOW(), NOW(), \'1\', \'2018-10-21\', 0.19, \'26\')','insert'),(120712,109,'2018-10-01 16:33:40','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3021\', \'Arriendo de Equipos de Datos  - Mes Septiembre\', \'27359\', \'1\', \'0\', \'684\', \'32557\', \'17296156-8BSMI01\')','insert'),(120715,109,'2018-10-01 16:33:41','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento) VALUES (\'76608219\', \'1\', \'2\', \'1\', \'68\', \'http://app2.bsale.cl/view/15057/2dec639f0cd8.pdf?sfd=99\', \'1\', \'\', NOW(), NOW(), \'2\', \'2018-10-21\', 0.19, \'26\')','insert'),(120716,109,'2018-10-01 16:33:46','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3022\', \'Arriendo de Equipos de Datos  - Mes Septiembre\', \'27359\', \'1\', \'0\', \'691\', \'32557\', \'76608219-KFSMI01\')','insert'),(120719,109,'2018-10-01 16:33:47','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento) VALUES (\'6448076\', \'1\', \'2\', \'1\', \'69\', \'http://app2.bsale.cl/view/15057/d3faeac99801.pdf?sfd=99\', \'1\', \'\', NOW(), NOW(), \'1\', \'2018-10-21\', 0.19, \'27\')','insert'),(120720,109,'2018-10-01 16:33:51','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3023\', \'Arriendo de Equipos de Datos  - Mes Septiembre\', \'54718\', \'1\', \'0\', \'690\', \'65114\', \'6448076-6BSMI01\')','insert'),(120723,109,'2018-10-01 16:33:52','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento) VALUES (\'6593446\', \'1\', \'2\', \'1\', \'70\', \'http://app2.bsale.cl/view/15057/276e5c97179d.pdf?sfd=99\', \'1\', \'\', NOW(), NOW(), \'1\', \'2018-10-21\', 0.19, \'28\')','insert'),(120724,109,'2018-10-01 16:33:55','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3024\', \'Arriendo de Equipos de Datos  - Mes Septiembre - CONEXION N°1\', \'27359\', \'1\', \'0\', \'664\', \'32557\', \'6593446-9BSMI01\')','insert'),(120725,109,'2018-10-01 16:33:55','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3024\', \'Arriendo de Equipos de Datos  - Mes Septiembre - Conexion N° 2\', \'27359\', \'1\', \'0\', \'665\', \'32557\', \'6593446-9BSMI02\')','insert'),(120728,109,'2018-10-01 16:33:56','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento) VALUES (\'5012355\', \'1\', \'2\', \'1\', \'71\', \'http://app2.bsale.cl/view/15057/17e5e5c3006d.pdf?sfd=99\', \'1\', \'\', NOW(), NOW(), \'1\', \'2018-10-21\', 0.19, \'29\')','insert'),(120729,109,'2018-10-01 16:33:59','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3025\', \'Arriendo de Equipos de Datos  - Mes Septiembre\', \'27359\', \'1\', \'0\', \'669\', \'32557\', \'5012355-3BSMI01\')','insert'),(120732,109,'2018-10-01 16:34:00','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento) VALUES (\'17520287\', \'1\', \'2\', \'1\', \'72\', \'http://app2.bsale.cl/view/15057/451470466ce6.pdf?sfd=99\', \'1\', \'\', NOW(), NOW(), \'1\', \'2018-10-21\', 0.19, \'30\')','insert'),(120733,109,'2018-10-01 16:34:04','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3026\', \'Arriendo de Equipos de Datos  - Mes Septiembre\', \'27359\', \'1\', \'0\', \'685\', \'32557\', \'17520287-0BSMI01\')','insert'),(120737,109,'2018-10-01 16:41:27','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA) VALUES (\'15514913\', \'1\', \'2\', \'0\', \'0\', \'\', \'0\', \'\', NOW(), NOW(), \'1\', NOW(), 0.19)','insert'),(120738,109,'2018-10-01 16:41:28','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Descuento, IdServicio, Cantidad, Total, Codigo) VALUES (\'3027\', \'Arriendo de Equipos de Datos  - Proporcional Septiembre (18 Dias)\', \'16415.4\', \'0.00\', \'703\', \'1\', \'19534\', \'15514913-2BSMI01\')','insert'),(120739,109,'2018-10-01 16:41:28','UPDATE servicios SET FechaInstalacion = \'2018-09-12\', InstaladoPor = \'115\', Comentario = \'CAMBIAR ESTACION\', UsuarioPppoe = \'AKURTE\', EstacionFinal = \'12\', SenalFinal = \'-50\', EstatusInstalacion = \'1\' where Id = \'703\'','update'),(120740,109,'2018-10-01 16:57:48','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento) VALUES (\'15250162\', \'1\', \'2\', \'1\', \'73\', \'http://app2.bsale.cl/view/15057/6c6a5e090d0b.pdf?sfd=99\', \'1\', \'\', NOW(), NOW(), \'1\', \'2018-10-21\', 0.19, \'31\')','insert'),(120741,109,'2018-10-01 16:57:53','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3028\', \'Arriendo de Equipos de Datos  - Mes Septiembre\', \'27359\', \'1\', \'0\', \'688\', \'32557\', \'15250162-5BSMI01\')','insert'),(120744,109,'2018-10-01 16:57:55','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento) VALUES (\'6417882\', \'1\', \'2\', \'1\', \'74\', \'http://app2.bsale.cl/view/15057/4ef4d19ca341.pdf?sfd=99\', \'1\', \'\', NOW(), NOW(), \'1\', \'2018-10-21\', 0.19, \'32\')','insert'),(120745,109,'2018-10-01 16:57:59','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3029\', \'Arriendo de Equipos de Datos  - Mes Septiembre\', \'27359\', \'1\', \'0\', \'701\', \'32557\', \'6417882-2BSMI01\')','insert'),(120748,109,'2018-10-01 16:58:00','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento) VALUES (\'6375115\', \'1\', \'2\', \'1\', \'75\', \'http://app2.bsale.cl/view/15057/be37443f59bb.pdf?sfd=99\', \'1\', \'\', NOW(), NOW(), \'1\', \'2018-10-21\', 0.19, \'33\')','insert'),(120749,109,'2018-10-01 16:58:03','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3030\', \'Arriendo de Equipos de Datos  - Mes Septiembre\', \'27359\', \'1\', \'0\', \'700\', \'32557\', \'6375115-4BSMI01\')','insert'),(120752,109,'2018-10-01 16:58:05','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento) VALUES (\'15514913\', \'1\', \'2\', \'1\', \'76\', \'http://app2.bsale.cl/view/15057/ac717548eae0.pdf?sfd=99\', \'1\', \'\', NOW(), NOW(), \'1\', \'2018-10-21\', 0.19, \'34\')','insert'),(120753,109,'2018-10-01 16:58:09','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3031\', \'Arriendo de Equipos de Datos  - Mes Septiembre\', \'27359\', \'1\', \'0\', \'703\', \'32557\', \'15514913-2BSMI01\')','insert'),(120754,109,'2018-10-01 16:58:09','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3031\', \'Arriendo de Equipos de Datos  - Proporcional Septiembre (18 Dias)\', \'16415.4\', \'1\', \'0\', \'703\', \'19534\', \'15514913-2BSMI01\')','insert'),(120761,109,'2018-10-01 17:01:07','INSERT INTO nota_venta(rut, fecha, numero_oc, fecha_oc, solicitado_por, estatus_facturacion) VALUES (\'15250162\',\'2018-10-01\',\'\',\'1969-01-31\',\'108\',\'0\')','insert'),(120762,109,'2018-10-01 17:01:07','INSERT INTO nota_venta_detalle(nota_venta_id, concepto, cantidad, precio, total) VALUES (\'54\',\'INSTALACIÓN Y HABILITACIÓN DE EQUIPOS DE DATOS\',\'1\',\'189076\',\'225000\')','insert'),(120764,109,'2018-10-01 17:01:17','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, NumeroOC, FechaOC) VALUES (\'15250162\', \'1000\', \'1\', \'0\', NOW(), NOW(), \'1\', NOW(), 0.19, \'0\', \'\', \'0\', \'\', \'\', \'1969-01-31\')','insert'),(120765,109,'2018-10-01 17:01:17','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3032\', \'INSTALACIÓN Y HABILITACIÓN DE EQUIPOS DE DATOS\', \'189076\', \'1\', \'0\', \'0\', \'225000\', \'\')','insert'),(120766,109,'2018-10-01 17:01:17','UPDATE nota_venta SET estatus_facturacion = 1, factura_id = \'3032\' WHERE id = \'54\'','update'),(120769,109,'2018-10-01 17:05:29','INSERT INTO nota_venta(rut, fecha, numero_oc, fecha_oc, solicitado_por, estatus_facturacion) VALUES (\'6375115\',\'2018-10-01\',\'\',\'1969-01-31\',\'108\',\'0\')','insert'),(120770,109,'2018-10-01 17:05:29','INSERT INTO nota_venta_detalle(nota_venta_id, concepto, cantidad, precio, total) VALUES (\'55\',\'INSTALACION Y HABILITACION DE EQUIPOS DE DATOS\',\'1\',\'326857\',\'388960\')','insert'),(120775,109,'2018-10-01 17:07:58','INSERT INTO nota_venta(rut, fecha, numero_oc, fecha_oc, solicitado_por, estatus_facturacion) VALUES (\'6417882\',\'2018-10-01\',\'\',\'1969-01-31\',\'108\',\'0\')','insert'),(120776,109,'2018-10-01 17:07:58','INSERT INTO nota_venta_detalle(nota_venta_id, concepto, cantidad, precio, total) VALUES (\'56\',\'Costo de instalación / Habilitación de equipos de datos\',\'1\',\'323949\',\'385499\')','insert'),(120778,109,'2018-10-01 17:08:31','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, NumeroOC, FechaOC) VALUES (\'6375115\', \'1000\', \'1\', \'0\', NOW(), NOW(), \'1\', NOW(), 0.19, \'0\', \'\', \'0\', \'\', \'\', \'1969-01-31\')','insert'),(120779,109,'2018-10-01 17:08:31','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3033\', \'INSTALACION Y HABILITACION DE EQUIPOS DE DATOS\', \'326857\', \'1\', \'0\', \'0\', \'388960\', \'\')','insert'),(120780,109,'2018-10-01 17:08:31','UPDATE nota_venta SET estatus_facturacion = 1, factura_id = \'3033\' WHERE id = \'55\'','update'),(120781,109,'2018-10-01 17:08:34','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, NumeroOC, FechaOC) VALUES (\'6417882\', \'1000\', \'1\', \'0\', NOW(), NOW(), \'1\', NOW(), 0.19, \'0\', \'\', \'0\', \'\', \'\', \'1969-01-31\')','insert'),(120782,109,'2018-10-01 17:08:34','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3034\', \'Costo de instalación / Habilitación de equipos de datos\', \'323949\', \'1\', \'0\', \'0\', \'385499\', \'\')','insert'),(120783,109,'2018-10-01 17:08:34','UPDATE nota_venta SET estatus_facturacion = 1, factura_id = \'3034\' WHERE id = \'56\'','update'),(120784,109,'2018-10-01 17:08:37','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, NumeroOC, FechaOC) VALUES (\'6448076\', \'1000\', \'1\', \'0\', NOW(), NOW(), \'1\', NOW(), 0.19, \'0\', \'\', \'0\', \'\', \'\', \'1969-01-31\')','insert'),(120785,109,'2018-10-01 17:08:37','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3035\', \'Habilitación tercera Cabaña, 25 mts. de ducto, 45 mts. de cable, más materiales\', \'297550\', \'1\', \'0\', \'0\', \'354085\', \'\')','insert'),(120786,109,'2018-10-01 17:08:37','UPDATE nota_venta SET estatus_facturacion = 1, factura_id = \'3035\' WHERE id = \'35\'','update'),(120787,109,'2018-10-01 17:09:07','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento, NumeroOC, FechaOC) VALUES (\'15250162\', \'1000\', \'1\', \'1\', \'77\', \'http://app2.bsale.cl/view/15057/b18ffaff9728.pdf?sfd=99\', \'1\', \'\', NOW(), NOW(), \'1\', \'2018-10-21\', 0.19, \'35\', \'\', \'1969-01-31\')','insert'),(120788,109,'2018-10-01 17:09:11','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3036\', \'INSTALACIÓN Y HABILITACIÓN DE EQUIPOS DE DATOS\', \'189076\', \'1\', \'0\', \'0\', \'225000\', \'\')','insert'),(120791,109,'2018-10-01 17:09:21','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento, NumeroOC, FechaOC) VALUES (\'6417882\', \'1000\', \'1\', \'1\', \'78\', \'http://app2.bsale.cl/view/15057/70a9a5de0ebf.pdf?sfd=99\', \'1\', \'\', NOW(), NOW(), \'1\', \'2018-10-21\', 0.19, \'36\', \'\', \'1969-01-31\')','insert'),(120792,109,'2018-10-01 17:09:25','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3037\', \'Costo de instalación / Habilitación de equipos de datos\', \'323949\', \'1\', \'0\', \'0\', \'385499\', \'\')','insert'),(120795,109,'2018-10-01 17:09:31','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento, NumeroOC, FechaOC) VALUES (\'6375115\', \'1000\', \'1\', \'1\', \'79\', \'http://app2.bsale.cl/view/15057/8f9826bf740e.pdf?sfd=99\', \'1\', \'\', NOW(), NOW(), \'1\', \'2018-10-21\', 0.19, \'37\', \'\', \'1969-01-31\')','insert'),(120796,109,'2018-10-01 17:09:35','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3038\', \'INSTALACION Y HABILITACION DE EQUIPOS DE DATOS\', \'326857\', \'1\', \'0\', \'0\', \'388960\', \'\')','insert'),(120799,110,'2018-10-01 17:18:13','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento) VALUES (\'78796670\', \'1\', \'2\', \'1\', \'80\', \'http://app2.bsale.cl/view/15057/91e988b39d94.pdf?sfd=99\', \'1\', \'\', NOW(), NOW(), \'2\', \'2018-10-21\', 0.19, \'27\')','insert'),(120800,110,'2018-10-01 17:18:17','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3039\', \'Arriendo de Equipos de Datos  - Mes Septiembre\', \'41038.5\', \'1\', \'0\', \'670\', \'48836\', \'78796670-5FSMI01\')','insert'),(120845,108,'2018-10-03 10:13:59','INSERT INTO nota_venta(rut, fecha, numero_oc, fecha_oc, solicitado_por, estatus_facturacion) VALUES (\'10420529\',\'2018-10-02\',\'\',\'1969-01-31\',\'108\',\'0\')','insert'),(120846,108,'2018-10-03 10:13:59','INSERT INTO nota_venta_detalle(nota_venta_id, concepto, cantidad, precio, total) VALUES (\'57\',\'Habilitación Internet\',\'1\',\'186975\',\'222500\')','insert'),(120848,108,'2018-10-03 10:15:46','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, NumeroOC, FechaOC) VALUES (\'10420529\', \'1000\', \'1\', \'0\', NOW(), NOW(), \'2\', NOW(), 0.19, \'0\', \'\', \'0\', \'\', \'\', \'1969-01-31\')','insert'),(120849,108,'2018-10-03 10:15:46','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3040\', \'Habilitación Internet\', \'186975\', \'1\', \'0\', \'0\', \'222500\', \'\')','insert'),(120850,108,'2018-10-03 10:15:46','UPDATE nota_venta SET estatus_facturacion = 1, factura_id = \'3040\' WHERE id = \'57\'','update'),(120851,108,'2018-10-03 10:24:37','INSERT INTO personaempresa\n			(rut, dv, nombre, giro, ciudad, region, direccion, correo, contacto, comentario, telefono, alias, tipo_cliente, id_usuario_sistema, clase_cliente, tipo_pago_bsale_id)\n			VALUES\n			(\'12713590\', \'8\', \'JUAN GUILLERMO RODRíGUEZ SANHUEZA\', \'SIN GIRO, PERSONA NATURAL\', \'312\', \'13\', \'PARCELACIóN DON RAFAEL. PARCELA 30.  PUERTO MONTT\', \'JRODRIGUEZ@CONSTRUCTORAOCTAY.CL\', \'JUAN RODRíGUEZ\', \'\', \'998838233\', \'\', \'1\', \'108\', \'1\', \'15\')','insert'),(120852,108,'2018-10-03 10:24:39','UPDATE personaempresa SET cliente_id_bsale = \'39\' WHERE id = \'10002\'','update'),(120853,108,'2018-10-03 11:00:21','INSERT INTO arriendo_equipos_datos (IdServicio, Velocidad, Plan, IdOrigen, IdProducto, TipoDestino) VALUES (\'710\', \'3x1\', \'R3\', \'10\', \'0\', \'2\')','insert'),(120854,108,'2018-10-03 11:00:25','UPDATE `servicios` set `FacturarSinInstalacion` = \'1\' where `Id` = \'710\'','update'),(120855,108,'2018-10-03 11:01:56','UPDATE servicios set IdUsuarioAsignado = \'117\', EstatusInstalacion = \'3\' where Id = \'710\'','update'),(120857,108,'2018-10-03 11:06:24','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA) VALUES (\'12713590\', \'1\', \'2\', \'0\', \'0\', \'\', \'0\', \'\', NOW(), NOW(), \'1\', NOW(), 0.19)','insert'),(120858,108,'2018-10-03 11:06:25','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Descuento, IdServicio, Cantidad, Total, Codigo) VALUES (\'3041\', \'Arriendo de Equipos de Datos  - Proporcional Septiembre (2 Dias)\', \'1824.2\', \'0.00\', \'710\', \'1\', \'2171\', \'12713590-8BSMI01\')','insert'),(120859,108,'2018-10-03 11:06:25','UPDATE servicios SET FechaInstalacion = \'2018-09-28\', InstaladoPor = \'115\', Comentario = \'Habilitación Servicio Internet\', UsuarioPppoe = \'juanrodriguez\', EstacionFinal = \'14\', SenalFinal = \'66\', EstatusInstalacion = \'1\' where Id = \'710\'','update'),(120860,108,'2018-10-03 11:08:00','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA) VALUES (\'10420529\', \'1\', \'2\', \'0\', \'0\', \'\', \'0\', \'\', NOW(), NOW(), \'2\', NOW(), 0.19)','insert'),(120861,108,'2018-10-03 11:08:01','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Descuento, IdServicio, Cantidad, Total, Codigo) VALUES (\'3042\', \'Arriendo de Equipos de Datos  - Proporcional Octubre (29 Dias)\', \'25597.64516129\', \'0.00\', \'707\', \'1\', \'30461\', \'10420529-1FSMI01\')','insert'),(120862,108,'2018-10-03 11:08:01','UPDATE servicios SET FechaInstalacion = \'2018-10-02\', InstaladoPor = \'115\', Comentario = \'Habilitación Servicio Internet\', UsuarioPppoe = \'aceledon\', EstacionFinal = \'12\', SenalFinal = \'55\', EstatusInstalacion = \'1\' where Id = \'707\'','update'),(120865,110,'2018-10-03 12:09:27','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento, NumeroOC, FechaOC) VALUES (\'76521560\', \'1\', \'2\', \'1\', \'81\', \'http://app2.bsale.cl/view/15057/bb48b67c77df.pdf?sfd=99\', \'1\', \'\', NOW(), NOW(), \'2\', \'2018-10-23\', 0.19, \'28\', \'\', \'1970-01-31\')','insert'),(120866,110,'2018-10-03 12:09:31','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3043\', \'Arriendo de Equipos de Datos  - Mes Septiembre\', \'27359\', \'1\', \'0\', \'704\', \'32557\', \'76521560-9FSMI01\')','insert'),(120869,110,'2018-10-03 12:23:14','UPDATE personaempresa SET alias = \'\', nombre = \'AGRíCOLA Y COMERCIAL NOMEHUE LTDA.\', giro = \'EXPLOTACIóN MIXTA\', direccion = \'AVENIDA DEL VALLE NORTE 787.  OF 404.\', correo = \'kcardenas@teledata.cl\', contacto = \'GERMáN CISTERNAS OSSA\', comentario = \'FONO PERSONAL DON GERMáN: +56 9 8769 7573\', telefono = \'227547500\', tipo_cliente = \'2\', ciudad = \'102\', region = \'7\', tipo_pago_bsale_id = \'15\' WHERE id = \'24\'','update'),(120871,110,'2018-10-03 12:34:14','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento, NumeroOC, FechaOC) VALUES (\'76243328\', \'1\', \'2\', \'1\', \'82\', \'http://app2.bsale.cl/view/15057/f5c41e6c1104.pdf?sfd=99\', \'1\', \'\', NOW(), NOW(), \'2\', \'2018-10-23\', 0.19, \'29\', \'\', \'1970-01-31\')','insert'),(120872,110,'2018-10-03 12:34:19','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3044\', \'Arriendo de Equipos de Datos  - Mes Septiembre\', \'68397.5\', \'1\', \'0\', \'706\', \'81393\', \'76243328-1FSMI01\')','insert'),(120899,109,'2018-10-05 13:50:51','UPDATE usuarios SET usuario=\'Paula\', nombre=\'Paula Reinoso\', clave=\'$2y$10$H/5CrRefJoShda0x.fO.cePlhPvIZkWwRgfQEuwezH/yxJboCAliW\', nivel=\'1\', cargo=\'Administración\', email=\'preinoso@teledata.cl\' WHERE id= 117','update'),(120900,117,'2018-10-05 15:26:31','INSERT INTO facturas_pagos(FacturaId, FechaPago, TipoPago, Detalle, Monto, FechaEmisionCheque, FechaVencimientoCheque, IdUsuarioSession) VALUES (\'2967\',\'2018-10-05\',\'1\',\'PAGO:PROVEEDORES 0862474007\',\'3898150\',\'1969-01-31\',\'1969-01-31\',\'117\')','insert'),(120901,117,'2018-10-05 15:27:51','INSERT INTO facturas_pagos(FacturaId, FechaPago, TipoPago, Detalle, Monto, FechaEmisionCheque, FechaVencimientoCheque, IdUsuarioSession) VALUES (\'2884\',\'2018-10-05\',\'1\',\'PAGO:PROVEEDORES 0862474007\',\'3891650\',\'1969-01-31\',\'1969-01-31\',\'117\')','insert'),(120902,108,'2018-10-09 11:46:55','INSERT INTO personaempresa\n			(rut, dv, nombre, giro, ciudad, region, direccion, correo, contacto, comentario, telefono, alias, tipo_cliente, id_usuario_sistema, clase_cliente, tipo_pago_bsale_id)\n			VALUES\n			(\'10858431\', \'9\', \'JOSé LUIS ACEVAL SILVA\', \'SIN GIRO, PERSONA NATURAL\', \'312\', \'13\', \'CHIN CHIN BAJO S/N, PARCELACIòN DON RAFAEL, PARCELA Nª 25\', \'JLACEVALS@GMAIL.COM\', \'JOSé LUIS ACEVAL SILVA\', \'\', \'996440778\', \'\', \'1\', \'108\', \'1\', \'15\')','insert'),(120903,108,'2018-10-09 12:09:53','INSERT INTO arriendo_equipos_datos (IdServicio, Velocidad, Plan, IdOrigen, IdProducto, TipoDestino) VALUES (\'711\', \'5x2\', \'R5\', \'10\', \'0\', \'2\')','insert'),(120904,108,'2018-10-09 12:09:56','UPDATE `servicios` set `FacturarSinInstalacion` = \'1\' where `Id` = \'711\'','update'),(120905,108,'2018-10-09 12:19:12','UPDATE servicios set IdUsuarioAsignado = \'117\', EstatusInstalacion = \'3\' where Id = \'711\'','update'),(120906,108,'2018-10-09 12:31:33','INSERT INTO personaempresa\n			(rut, dv, nombre, giro, ciudad, region, direccion, correo, contacto, comentario, telefono, alias, tipo_cliente, id_usuario_sistema, clase_cliente, tipo_pago_bsale_id)\n			VALUES\n			(\'11712371\', \'5\', \'PATRICIO NANNIG GOTSCHLICH\', \'AGRICOLA\', \'308\', \'13\', \'FUNDO VILLA ALEGRE S/N.  FRUTILLAR\', \'PNANNIGG@GMAIL.COM\', \'PATRICIO NANNIG\', \'\', \'996450602\', \'\', \'2\', \'108\', \'1\', \'15\')','insert'),(120907,117,'2018-10-09 16:19:53','INSERT INTO facturas_pagos(FacturaId, FechaPago, TipoPago, Detalle, Monto, FechaEmisionCheque, FechaVencimientoCheque, IdUsuarioSession) VALUES (\'3019\',\'2018-10-05\',\'9\',\'\',\'32557\',\'1969-01-31\',\'1969-01-31\',\'117\')','insert'),(120908,117,'2018-10-09 16:20:38','INSERT INTO facturas_pagos(FacturaId, FechaPago, TipoPago, Detalle, Monto, FechaEmisionCheque, FechaVencimientoCheque, IdUsuarioSession) VALUES (\'3015\',\'2018-10-09\',\'1\',\'TRASPASO DE:RODRIGO CHICHARRO SAENZ\',\'32746\',\'1969-01-31\',\'1969-01-31\',\'117\')','insert'),(120909,117,'2018-10-09 16:21:07','INSERT INTO facturas_pagos(FacturaId, FechaPago, TipoPago, Detalle, Monto, FechaEmisionCheque, FechaVencimientoCheque, IdUsuarioSession) VALUES (\'3020\',\'2018-10-05\',\'9\',\'\',\'162786\',\'1969-01-31\',\'1969-01-31\',\'117\')','insert'),(120910,117,'2018-10-09 16:22:17','INSERT INTO facturas_pagos(FacturaId, FechaPago, TipoPago, Detalle, Monto, FechaEmisionCheque, FechaVencimientoCheque, IdUsuarioSession) VALUES (\'3039\',\'2018-10-05\',\'9\',\'\',\'48836\',\'1969-01-31\',\'1969-01-31\',\'117\')','insert'),(120911,117,'2018-10-09 16:23:43','INSERT INTO facturas_pagos(FacturaId, FechaPago, TipoPago, Detalle, Monto, FechaEmisionCheque, FechaVencimientoCheque, IdUsuarioSession) VALUES (\'3024\',\'2018-10-05\',\'9\',\'\',\'65114\',\'1969-01-31\',\'1969-01-31\',\'117\')','insert'),(120912,117,'2018-10-09 16:24:27','INSERT INTO facturas_pagos(FacturaId, FechaPago, TipoPago, Detalle, Monto, FechaEmisionCheque, FechaVencimientoCheque, IdUsuarioSession) VALUES (\'3025\',\'2018-10-05\',\'9\',\'\',\'32557\',\'1969-01-31\',\'1969-01-31\',\'117\')','insert'),(120913,108,'2018-10-11 10:21:09','INSERT INTO giros (nombre) VALUES (\'ARRIENDO DE INMUEBLES\')','insert'),(120914,108,'2018-10-11 10:22:47','INSERT INTO personaempresa\n			(rut, dv, nombre, giro, ciudad, region, direccion, correo, contacto, comentario, telefono, alias, tipo_cliente, id_usuario_sistema, clase_cliente, tipo_pago_bsale_id)\n			VALUES\n			(\'6740725\', \'3\', \'JAIME NEUMANN KLENNER\', \'ARRIENDO DE INMUEBLES\', \'309\', \'13\', \'PORTAL DEL LAGO.  PARCELA 12.  LLANQUIHUE\', \'JAIME.NEUMANN@GMAIL.COM\', \'JIME NEUMANN KLENNER\', \'\', \'998886503\', \'\', \'2\', \'108\', \'1\', \'15\')','insert'),(120915,108,'2018-10-11 10:32:56','INSERT INTO arriendo_equipos_datos (IdServicio, Velocidad, Plan, IdOrigen, IdProducto, TipoDestino) VALUES (\'712\', \'3x1\', \'R3\', \'10\', \'0\', \'2\')','insert'),(120916,108,'2018-10-11 10:36:00','INSERT INTO giros (nombre) VALUES (\'INVERSIONES Y ASESORIAS\')','insert'),(120917,108,'2018-10-11 10:39:21','INSERT INTO personaempresa\n			(rut, dv, nombre, giro, ciudad, region, direccion, correo, contacto, comentario, telefono, alias, tipo_cliente, id_usuario_sistema, clase_cliente, tipo_pago_bsale_id)\n			VALUES\n			(\'76460253\', \'6\', \'INVERSIONES Y ASESORíAS AQUELARRE SPA\', \'INVERSIONES Y ASESORIAS\', \'312\', \'13\', \'CAMINO CHINQUIHUE KM. 10.  PARCELA 6.  PUERTO MONTT\', \'IVANKIPREOS@GMAIL.COM\', \'IVáN KIPREOS\', \'\', \'994192019\', \'\', \'2\', \'108\', \'1\', \'15\')','insert'),(120918,108,'2018-10-11 10:44:47','INSERT INTO arriendo_equipos_datos (IdServicio, Velocidad, Plan, IdOrigen, IdProducto, TipoDestino) VALUES (\'713\', \'5x2\', \'R5\', \'0\', \'0\', \'2\')','insert'),(120919,108,'2018-10-11 10:48:40','INSERT INTO nota_venta(rut, fecha, numero_oc, fecha_oc, solicitado_por, estatus_facturacion) VALUES (\'76460253\',\'2018-10-12\',\'\',\'1969-01-31\',\'108\',\'0\')','insert'),(120920,108,'2018-10-11 10:48:40','INSERT INTO nota_venta_detalle(nota_venta_id, concepto, cantidad, precio, total) VALUES (\'58\',\'Habilitación Servicio Internet\',\'1\',\'218487\',\'260000\')','insert'),(120921,108,'2018-10-11 10:51:41','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, NumeroOC, FechaOC) VALUES (\'76460253\', \'1000\', \'1\', \'0\', NOW(), NOW(), \'2\', NOW(), 0.19, \'0\', \'\', \'0\', \'\', \'\', \'1969-01-31\')','insert'),(120922,108,'2018-10-11 10:51:41','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3045\', \'Habilitación Servicio Internet\', \'218487\', \'1\', \'0\', \'0\', \'260000\', \'\')','insert'),(120923,108,'2018-10-11 10:51:41','UPDATE nota_venta SET estatus_facturacion = 1, factura_id = \'3045\' WHERE id = \'58\'','update'),(120924,108,'2018-10-11 10:59:01','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento, NumeroOC, FechaOC) VALUES (\'6448076\', \'1000\', \'1\', \'1\', \'83\', \'http://app2.bsale.cl/view/15057/bd3310c90b6e.pdf?sfd=99\', \'1\', \'\', NOW(), NOW(), \'1\', \'2018-10-31\', 0.19, \'38\', \'\', \'1969-01-31\')','insert'),(120925,108,'2018-10-11 10:59:04','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3046\', \'Habilitación tercera Cabaña, 25 mts. de ducto, 45 mts. de cable, más materiales\', \'297550\', \'1\', \'0\', \'0\', \'354085\', \'\')','insert'),(120926,110,'2018-10-12 09:12:38','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento) VALUES (\'12017636\', \'1\', \'2\', \'1\', \'84\', \'http://app2.bsale.cl/view/15057/881566ac763d.pdf?sfd=99\', \'1\', \'\', NOW(), NOW(), \'2\', \'2018-11-01\', 0.19, \'30\')','insert'),(120927,110,'2018-10-12 09:12:42','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3047\', \'Arriendo de Equipos de Datos  - Mes Septiembre\', \'27359\', \'1\', \'0\', \'683\', \'32557\', \'12017636-6FSMI01\')','insert'),(120928,110,'2018-10-12 09:12:43','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento) VALUES (\'13825370\', \'1\', \'2\', \'1\', \'85\', \'http://app2.bsale.cl/view/15057/ed4c3def665f.pdf?sfd=99\', \'1\', \'\', NOW(), NOW(), \'2\', \'2018-11-01\', 0.19, \'31\')','insert'),(120929,110,'2018-10-12 09:12:47','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3048\', \'Arriendo de Equipos de Datos  - Mes Septiembre\', \'27359\', \'1\', \'0\', \'682\', \'32557\', \'13825370-8FSMI01\')','insert'),(120930,110,'2018-10-12 09:12:48','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento) VALUES (\'76127546\', \'1\', \'2\', \'1\', \'86\', \'http://app2.bsale.cl/view/15057/521813419d17.pdf?sfd=99\', \'1\', \'\', NOW(), NOW(), \'2\', \'2018-11-01\', 0.19, \'32\')','insert'),(120931,110,'2018-10-12 09:12:51','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3049\', \'Arriendo de Equipos de Datos  - Mes Septiembre\', \'54718\', \'1\', \'0\', \'687\', \'65114\', \'76127546-1FSMI01\')','insert'),(120932,110,'2018-10-12 09:12:52','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento) VALUES (\'76245945\', \'1\', \'2\', \'1\', \'87\', \'http://app2.bsale.cl/view/15057/17a87dc6ac6d.pdf?sfd=99\', \'1\', \'\', NOW(), NOW(), \'2\', \'2018-11-01\', 0.19, \'33\')','insert'),(120933,110,'2018-10-12 09:13:05','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3050\', \'Arriendo de Equipos de Datos  - Mes Septiembre\', \'54718\', \'1\', \'0\', \'689\', \'65114\', \'76245945-0FSMI01\')','insert'),(120934,110,'2018-10-12 09:13:07','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento) VALUES (\'76830018\', \'1\', \'2\', \'1\', \'88\', \'http://app2.bsale.cl/view/15057/f3cd57d88a17.pdf?sfd=99\', \'1\', \'\', NOW(), NOW(), \'2\', \'2018-11-01\', 0.19, \'34\')','insert'),(120935,110,'2018-10-12 09:13:11','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3051\', \'Arriendo de Equipos de Datos  - Mes Septiembre\', \'54718\', \'1\', \'0\', \'686\', \'65114\', \'76830018-6FSMI01\')','insert'),(120936,110,'2018-10-12 09:13:12','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento) VALUES (\'10420529\', \'1\', \'2\', \'1\', \'89\', \'http://app2.bsale.cl/view/15057/c00b7d00e7d6.pdf?sfd=99\', \'1\', \'\', NOW(), NOW(), \'2\', \'2018-11-01\', 0.19, \'35\')','insert'),(120937,110,'2018-10-12 09:13:17','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3052\', \'Arriendo de Equipos de Datos  - Mes Septiembre\', \'27359\', \'1\', \'0\', \'707\', \'32557\', \'10420529-1FSMI01\')','insert'),(120938,110,'2018-10-12 09:13:17','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3052\', \'Arriendo de Equipos de Datos  - Proporcional Octubre (29 Dias)\', \'25597.65\', \'1\', \'0\', \'707\', \'30461\', \'10420529-1FSMI01\')','insert'),(120939,110,'2018-10-12 09:13:18','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento) VALUES (\'76250727\', \'1\', \'2\', \'1\', \'90\', \'http://app2.bsale.cl/view/15057/620846201e39.pdf?sfd=99\', \'1\', \'\', NOW(), NOW(), \'2\', \'2018-11-01\', 0.19, \'36\')','insert'),(120940,110,'2018-10-12 09:13:22','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3053\', \'Arriendo de Equipos de Datos  - Mes Septiembre\', \'27359\', \'1\', \'0\', \'702\', \'32557\', \'76250727-7FSMI01\')','insert'),(120941,110,'2018-10-12 18:44:56','  UPDATE facturas SET Referencia = \'OST-199453\' WHERE Rut = \'86247400\' AND Grupo = \'4\' AND TipoFactura = \'2\' AND EstatusFacturacion = 0','update'),(120942,110,'2018-10-12 18:47:21','  UPDATE facturas SET NumeroOC = \'OST-199453\', FechaOC = \'2018-09-26\' WHERE Rut = \'86247400\' AND Grupo = \'4\' AND TipoFactura = \'2\' AND EstatusFacturacion = 0','update'),(120943,110,'2018-10-12 18:47:34','  UPDATE facturas SET Referencia = \'OST-199453\' WHERE Rut = \'86247400\' AND Grupo = \'4\' AND TipoFactura = \'2\' AND EstatusFacturacion = 0','update'),(120944,110,'2018-10-12 18:47:41','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento, NumeroOC, FechaOC) VALUES (\'86247400\', \'4\', \'2\', \'1\', \'91\', \'http://app2.bsale.cl/view/15057/7eae77148808.pdf?sfd=99\', \'1\', \'\', NOW(), NOW(), \'2\', \'2018-11-01\', 0.19, \'37\', \'OST-199453\', \'2018-09-26\')','insert'),(120945,110,'2018-10-12 18:47:46','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3054\', \'Arriendo de Equipos de Datos  - Mes Septiembre - CENTRO PAILDAD\', \'328311\', \'1\', \'0\', \'671\', \'390690\', \'86247400-7FSMI01\')','insert'),(120946,110,'2018-10-12 18:47:46','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3054\', \'Arriendo de Equipos de Datos  - Mes Septiembre - CENTRO MORRO CHILCO\', \'328311\', \'1\', \'0\', \'672\', \'390690\', \'86247400-7FSMI02\')','insert'),(120947,110,'2018-10-12 18:47:46','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3054\', \'Arriendo de Equipos de Datos  - Mes Septiembre - CENTRO PUNTA PAULA\', \'328311\', \'1\', \'0\', \'673\', \'390690\', \'86247400-7FSMI03\')','insert'),(120948,110,'2018-10-12 18:47:46','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3054\', \'Arriendo de Equipos de Datos  - Mes Septiembre - CENTRO LILLE 1\', \'328311\', \'1\', \'0\', \'674\', \'390690\', \'86247400-7FSMI04\')','insert'),(120949,110,'2018-10-12 18:47:46','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3054\', \'Arriendo de Equipos de Datos  - Mes Septiembre - CENTRO LILLIE 2\', \'328311\', \'1\', \'0\', \'675\', \'390690\', \'86247400-7FSMI05\')','insert'),(120950,110,'2018-10-12 18:47:46','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3054\', \'Arriendo de Equipos de Datos  - Mes Septiembre - CENTRO YELCHO\', \'328311\', \'1\', \'0\', \'676\', \'390690\', \'86247400-7FSMI06\')','insert'),(120951,110,'2018-10-12 18:47:46','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3054\', \'Arriendo de Equipos de Datos  - Mes Septiembre - CENTRO PUNTA PELU\', \'328311\', \'1\', \'0\', \'677\', \'390690\', \'86247400-7FSMI07\')','insert'),(120952,110,'2018-10-12 18:47:46','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3054\', \'Arriendo de Equipos de Datos  - Mes Septiembre - CENTRO QUILQUE SUR\', \'328311\', \'1\', \'0\', \'679\', \'390690\', \'86247400-7FSMI08\')','insert'),(120953,110,'2018-10-12 18:47:46','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3054\', \'Arriendo de Equipos de Datos  - Mes Septiembre - CENTRO ABTAO\', \'328311\', \'1\', \'0\', \'680\', \'390690\', \'86247400-7FSMI09\')','insert'),(120954,110,'2018-10-12 18:47:46','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3054\', \'Arriendo de Equipos de Datos  - Mes Septiembre - CENTRO HUAPI\', \'328311\', \'1\', \'0\', \'681\', \'390690\', \'86247400-7FSMI10\')','insert'),(120955,105,'2018-10-16 10:33:14','UPDATE personaempresa SET alias = \'\', nombre = \'AGRíCOLA Y COMERCIAL NOMEHUE LTDA.\', giro = \'EXPLOTACIóN MIXTA\', direccion = \'AVENIDA DEL VALLE NORTE 787.  OF 404.\', correo = \'kcardenas@teledata.cl\', contacto = \'GERMáN CISTERNAS OSSA\', comentario = \'FONO PERSONAL DON GERMáN: +56 9 8769 7573\', telefono = \'227547500\', tipo_cliente = \'2\', ciudad = \'102\', region = \'7\', tipo_pago_bsale_id = \'15\' WHERE id = \'24\'','update'),(120956,105,'2018-10-16 10:34:20','UPDATE personaempresa SET alias = \'\', nombre = \'AGRíCOLA Y COMERCIAL NOMEHUE LTDA.\', giro = \'EXPLOTACIóN MIXTA\', direccion = \'AVENIDA DEL VALLE NORTE 787.  OF 404.\', correo = \'kcardenas@teledata.cl\', contacto = \'GERMáN CISTERNAS OSSA\', comentario = \'FONO PERSONAL DON GERMáN: +56 9 8769 7573\', telefono = \'227547500\', tipo_cliente = \'2\', ciudad = \'102\', region = \'7\', tipo_pago_bsale_id = \'15\' WHERE id = \'24\'','update'),(120957,105,'2018-10-16 10:34:31','UPDATE personaempresa SET alias = \'\', nombre = \'AGRíCOLA Y COMERCIAL NOMEHUE LTDA.\', giro = \'EXPLOTACIóN MIXTA\', direccion = \'AVENIDA DEL VALLE NORTE 787.  OF 404.\', correo = \'kcardenas@teledata.cl\', contacto = \'GERMáN CISTERNAS OSSA\', comentario = \'FONO PERSONAL DON GERMáN: +56 9 8769 7573\', telefono = \'227547500\', tipo_cliente = \'2\', ciudad = \'102\', region = \'7\', tipo_pago_bsale_id = \'15\' WHERE id = \'24\'','update'),(120958,105,'2018-10-16 10:34:47','UPDATE personaempresa SET alias = \'\', nombre = \'AGRíCOLA Y COMERCIAL NOMEHUE LTDA.\', giro = \'EXPLOTACIóN MIXTA\', direccion = \'AVENIDA DEL VALLE NORTE 787.  OF 404.\', correo = \'kcardenas@teledata.cl\', contacto = \'GERMáN CISTERNAS OSSA\', comentario = \'FONO PERSONAL DON GERMáN: +56 9 8769 7573\', telefono = \'227547500\', tipo_cliente = \'2\', ciudad = \'102\', region = \'7\', tipo_pago_bsale_id = \'15\' WHERE id = \'24\'','update'),(120959,105,'2018-10-16 10:38:09','UPDATE personaempresa SET alias = \'\', nombre = \'AGRíCOLA Y COMERCIAL NOMEHUE LTDA.\', giro = \'EXPLOTACIóN MIXTA\', direccion = \'AVENIDA DEL VALLE NORTE 787.  OF 404.\', correo = \'kcardenas@teledata.cl\', contacto = \'GERMáN CISTERNAS OSSA\', comentario = \'FONO PERSONAL DON GERMáN: +56 9 8769 7573\', telefono = \'227547500\', tipo_cliente = \'2\', ciudad = \'102\', region = \'7\', tipo_pago_bsale_id = \'15\' WHERE id = \'24\'','update'),(120960,105,'2018-10-16 10:44:48','UPDATE personaempresa SET alias = \'\', nombre = \'AGRíCOLA Y COMERCIAL NOMEHUE LTDA.\', giro = \'EXPLOTACIóN MIXTA\', direccion = \'AVENIDA DEL VALLE NORTE 787.  OF 404.\', correo = \'kcardenas@teledata.cl\', contacto = \'GERMáN CISTERNAS OSSA\', comentario = \'FONO PERSONAL DON GERMáN: +56 9 8769 7573\', telefono = \'227547500\', tipo_cliente = \'2\', ciudad = \'102\', region = \'7\', tipo_pago_bsale_id = \'15\' WHERE id = \'24\'','update'),(120961,105,'2018-10-16 10:45:01','UPDATE personaempresa SET alias = \'\', nombre = \'AGRíCOLA Y COMERCIAL NOMEHUE LTDA.\', giro = \'EXPLOTACIóN MIXTA\', direccion = \'AVENIDA DEL VALLE NORTE 787.  OF 404.\', correo = \'kcardenas@teledata.cl\', contacto = \'GERMáN CISTERNAS OSSA\', comentario = \'FONO PERSONAL DON GERMáN: +56 9 8769 7573\', telefono = \'227547500\', tipo_cliente = \'2\', ciudad = \'102\', region = \'7\', tipo_pago_bsale_id = \'15\' WHERE id = \'24\'','update'),(120962,105,'2018-10-16 10:46:04','UPDATE personaempresa SET alias = \'\', nombre = \'AGRíCOLA Y COMERCIAL NOMEHUE LTDA.\', giro = \'EXPLOTACIóN MIXTA\', direccion = \'AVENIDA DEL VALLE NORTE 787.  OF 404.\', correo = \'kcardenas@teledata.cl\', contacto = \'GERMáN CISTERNAS OSSA\', comentario = \'FONO PERSONAL DON GERMáN: +56 9 8769 7573\', telefono = \'227547500\', tipo_cliente = \'2\', ciudad = \'102\', region = \'7\', tipo_pago_bsale_id = \'15\' WHERE id = \'24\'','update'),(120963,105,'2018-10-16 10:47:26','UPDATE personaempresa SET alias = \'\', nombre = \'AGRíCOLA Y COMERCIAL NOMEHUE LTDA.\', giro = \'EXPLOTACIóN MIXTA\', direccion = \'AVENIDA DEL VALLE NORTE 787.  OF 404.\', correo = \'kcardenas@teledata.cl\', contacto = \'GERMáN CISTERNAS OSSA\', comentario = \'FONO PERSONAL DON GERMáN: +56 9 8769 7573\', telefono = \'227547500\', tipo_cliente = \'2\', ciudad = \'102\', region = \'7\', tipo_pago_bsale_id = \'15\' WHERE id = \'24\'','update'),(120964,105,'2018-10-16 10:47:59','UPDATE personaempresa SET alias = \'\', nombre = \'AGRíCOLA Y COMERCIAL NOMEHUE LTDA.\', giro = \'EXPLOTACIóN MIXTA\', direccion = \'AVENIDA DEL VALLE NORTE 787.  OF 404.\', correo = \'kcardenas@teledata.cl\', contacto = \'GERMáN CISTERNAS OSSA\', comentario = \'FONO PERSONAL DON GERMáN: +56 9 8769 7573\', telefono = \'227547500\', tipo_cliente = \'2\', ciudad = \'102\', region = \'7\', tipo_pago_bsale_id = \'15\' WHERE id = \'24\'','update'),(120965,105,'2018-10-16 10:48:20','UPDATE personaempresa SET alias = \'\', nombre = \'AGRíCOLA Y COMERCIAL NOMEHUE LTDA.\', giro = \'EXPLOTACIóN MIXTA\', direccion = \'AVENIDA DEL VALLE NORTE 787.  OF 404.\', correo = \'kcardenas@teledata.cl\', contacto = \'GERMáN CISTERNAS OSSA\', comentario = \'FONO PERSONAL DON GERMáN: +56 9 8769 7573\', telefono = \'227547500\', tipo_cliente = \'2\', ciudad = \'102\', region = \'7\', tipo_pago_bsale_id = \'15\' WHERE id = \'24\'','update'),(120966,105,'2018-10-16 10:51:45','UPDATE personaempresa SET alias = \'*\', nombre = \'PRUEBA SISTEMA NO BORRAR\', giro = \'SIN GIRO, PERSONA NATURAL\', direccion = \'*\', correo = \'bfsraptor@gmail.com\', contacto = \'*\', comentario = \'*\', telefono = \'983764505\', tipo_cliente = \'2\', ciudad = \'118\', region = \'7\', tipo_pago_bsale_id = \'15\', posee_pac = \'1\' WHERE id = \'9999\'','update'),(120967,105,'2018-10-16 10:53:11','UPDATE personaempresa SET alias = \'*\', nombre = \'PRUEBA SISTEMA NO BORRAR\', giro = \'SIN GIRO, PERSONA NATURAL\', direccion = \'*\', correo = \'bfsraptor@gmail.com\', contacto = \'*\', comentario = \'*\', telefono = \'983764505\', tipo_cliente = \'2\', ciudad = \'118\', region = \'7\', tipo_pago_bsale_id = \'15\', posee_pac = \'0\' WHERE id = \'9999\'','update'),(120968,105,'2018-10-16 10:53:29','UPDATE personaempresa SET alias = \'*\', nombre = \'PRUEBA SISTEMA NO BORRAR\', giro = \'SIN GIRO, PERSONA NATURAL\', direccion = \'*\', correo = \'bfsraptor@gmail.com\', contacto = \'*\', comentario = \'*\', telefono = \'983764505\', tipo_cliente = \'2\', ciudad = \'118\', region = \'7\', tipo_pago_bsale_id = \'15\', posee_pac = \'1\' WHERE id = \'9999\'','update'),(120969,110,'2018-10-16 15:51:18','INSERT INTO giros (nombre) VALUES (\'HOTELERIA\')','insert'),(120970,117,'2018-10-16 16:27:10','INSERT INTO facturas_pagos(FacturaId, FechaPago, TipoPago, Detalle, Monto, FechaEmisionCheque, FechaVencimientoCheque, IdUsuarioSession) VALUES (\'3030\',\'2018-10-02\',\'1\',\'65964460\',\'32557\',\'1969-01-31\',\'1969-01-31\',\'117\')','insert'),(120971,117,'2018-10-16 16:32:53','INSERT INTO facturas_pagos(FacturaId, FechaPago, TipoPago, Detalle, Monto, FechaEmisionCheque, FechaVencimientoCheque, IdUsuarioSession) VALUES (\'3038\',\'2018-08-24\',\'1\',\'64832136\',\'194480\',\'1969-01-31\',\'1969-01-31\',\'117\')','insert'),(120972,117,'2018-10-16 16:35:20','INSERT INTO facturas_pagos(FacturaId, FechaPago, TipoPago, Detalle, Monto, FechaEmisionCheque, FechaVencimientoCheque, IdUsuarioSession) VALUES (\'3038\',\'2018-09-03\',\'1\',\'65144218\',\'194480\',\'1969-01-31\',\'1969-01-31\',\'117\')','insert'),(120973,117,'2018-10-16 16:42:07','INSERT INTO nota_venta(rut, fecha, numero_oc, fecha_oc, solicitado_por, estatus_facturacion) VALUES (\'12713590\',\'2018-10-16\',\'\',\'1969-01-31\',\'108\',\'0\')','insert'),(120974,117,'2018-10-16 16:42:07','INSERT INTO nota_venta_detalle(nota_venta_id, concepto, cantidad, precio, total) VALUES (\'59\',\'Habilitación Servicio Internet\',\'1\',\'191596\',\'227999\')','insert'),(120975,117,'2018-10-16 16:42:24','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, NumeroOC, FechaOC) VALUES (\'12713590\', \'1000\', \'1\', \'0\', NOW(), NOW(), \'1\', NOW(), 0.19, \'0\', \'\', \'0\', \'\', \'\', \'1969-01-31\')','insert'),(120976,117,'2018-10-16 16:42:24','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3055\', \'Habilitación Servicio Internet\', \'191596\', \'1\', \'0\', \'0\', \'227999\', \'\')','insert'),(120977,117,'2018-10-16 16:42:24','UPDATE nota_venta SET estatus_facturacion = 1, factura_id = \'3055\' WHERE id = \'59\'','update'),(120978,117,'2018-10-16 16:44:05','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento, NumeroOC, FechaOC) VALUES (\'12713590\', \'1\', \'3\', \'1\', \'92\', \'http://app2.bsale.cl/view/15057/9470baffeb83.pdf?sfd=99\', \'1\', \'\', NOW(), NOW(), \'1\', \'2018-10-23\', 0.19, \'39\', \'0\', \'1970-01-31\')','insert'),(120979,117,'2018-10-16 16:44:09','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3056\', \'Arriendo de Equipos de Datos  - Costo de instalación / Habilitación\', \'191241.2973\', \'1\', \'0.00\', \'710\', \'227577\', \'12713590-8BSMI01\')','insert'),(120980,117,'2018-10-16 16:44:09','UPDATE servicios SET EstatusFacturacion = \'1\', FechaFacturacion = NOW() WHERE Id = \'710\'','update'),(120981,117,'2018-10-16 16:46:21','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento, NumeroOC, FechaOC) VALUES (\'10858431\', \'1\', \'3\', \'1\', \'93\', \'http://app2.bsale.cl/view/15057/0c066f210730.pdf?sfd=99\', \'1\', \'\', NOW(), NOW(), \'1\', \'2018-10-23\', 0.19, \'40\', \'0\', \'1970-01-31\')','insert'),(120982,117,'2018-10-16 16:46:25','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3057\', \'Arriendo de Equipos de Datos  - Costo de instalación / Habilitación\', \'191241.2973\', \'1\', \'0.00\', \'711\', \'227577\', \'10858431-9BSMI01\')','insert'),(120983,117,'2018-10-16 16:46:25','UPDATE servicios SET EstatusFacturacion = \'1\', FechaFacturacion = NOW() WHERE Id = \'711\'','update'),(120984,117,'2018-10-16 16:50:20','INSERT INTO facturas_pagos(FacturaId, FechaPago, TipoPago, Detalle, Monto, FechaEmisionCheque, FechaVencimientoCheque, IdUsuarioSession) VALUES (\'3056\',\'2018-09-14\',\'1\',\'239111759\',\'227577\',\'1969-01-31\',\'1969-01-31\',\'117\')','insert'),(120985,110,'2018-10-16 16:50:49','INSERT INTO personaempresa\n			(rut, dv, nombre, giro, ciudad, region, direccion, correo, contacto, comentario, telefono, alias, tipo_cliente, id_usuario_sistema, clase_cliente, tipo_pago_bsale_id, posee_pac)\n			VALUES\n			(\'76541036\', \'3\', \'LA CACHIMBA SPA\', \'HOTELERIA\', \'127\', \'7\', \'AVENIDA ANDRéS BELLO 2687\', \'XIMENAGOURMET@GMAIL.COM\', \'\', \'\', \'\', \'\', \'2\', \'110\', \'1\', \'15\', \'0\')','insert'),(120986,110,'2018-10-16 16:50:49','INSERT INTO contactos ( contacto, tipo_contacto, correo, telefono, rut ) VALUES ( \'Ximena de la Fuente\', ( SELECT id FROM mantenedor_tipo_contacto WHERE nombre = \'Facturación\' ), \'ximenagourmet@gmail.com\', \'994380781\', \'76541036\' )','insert'),(120987,110,'2018-10-16 16:52:51','INSERT INTO arriendo_equipos_datos (IdServicio, Velocidad, Plan, IdOrigen, IdProducto, TipoDestino) VALUES (\'714\', \'2x600\', \'\', \'10\', \'0\', \'2\')','insert'),(120988,117,'2018-10-16 16:57:15','DELETE FROM facturas_pagos WHERE Id = 33','delete'),(120989,117,'2018-10-16 16:58:01','INSERT INTO facturas_pagos(FacturaId, FechaPago, TipoPago, Detalle, Monto, FechaEmisionCheque, FechaVencimientoCheque, IdUsuarioSession) VALUES (\'3056\',\'2018-09-14\',\'1\',\'239111759\',\'113822\',\'1969-01-31\',\'1969-01-31\',\'117\')','insert'),(120990,117,'2018-10-16 16:59:15','INSERT INTO facturas_pagos(FacturaId, FechaPago, TipoPago, Detalle, Monto, FechaEmisionCheque, FechaVencimientoCheque, IdUsuarioSession) VALUES (\'3056\',\'2018-10-10\',\'1\',\'242494842\',\'113822\',\'1969-01-31\',\'1969-01-31\',\'117\')','insert'),(120991,110,'2018-10-16 17:48:04','INSERT INTO nota_venta(rut, fecha, numero_oc, fecha_oc, solicitado_por, estatus_facturacion) VALUES (\'6740725\',\'2018-10-16\',\'\',\'1969-01-31\',\'108\',\'0\')','insert'),(120992,110,'2018-10-16 17:48:04','INSERT INTO nota_venta_detalle(nota_venta_id, concepto, cantidad, precio, total) VALUES (\'60\',\'Habilitación e Instalación\',\'1\',\'189076\',\'225000\')','insert'),(120993,110,'2018-10-16 17:48:48','UPDATE servicios set IdUsuarioAsignado = \'110\', EstatusInstalacion = \'3\' where Id = \'712\'','update'),(120994,110,'2018-10-16 17:49:43','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA) VALUES (\'6740725\', \'1\', \'2\', \'0\', \'0\', \'\', \'0\', \'\', NOW(), NOW(), \'2\', NOW(), 0.19)','insert'),(120995,110,'2018-10-16 17:49:44','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Descuento, IdServicio, Cantidad, Total, Codigo) VALUES (\'3058\', \'Arriendo de Equipos de Datos  - Proporcional Octubre (19 Dias)\', \'16768.58483871\', \'0.00\', \'712\', \'1\', \'19955\', \'6740725-3FSMI01\')','insert'),(120996,110,'2018-10-16 17:49:44','UPDATE servicios SET FechaInstalacion = \'2018-10-12\', InstaladoPor = \'110\', Comentario = \'\', UsuarioPppoe = \'jneumann\', EstacionFinal = \'12\', SenalFinal = \'60\', EstatusInstalacion = \'1\' where Id = \'712\'','update'),(120997,110,'2018-10-16 18:01:38','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, NumeroOC, FechaOC) VALUES (\'6740725\', \'1000\', \'1\', \'0\', NOW(), NOW(), \'2\', NOW(), 0.19, \'0\', \'\', \'0\', \'\', \'\', \'1969-01-31\')','insert'),(120998,110,'2018-10-16 18:01:38','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3059\', \'Habilitación e Instalación\', \'189076\', \'1\', \'0\', \'0\', \'225000\', \'\')','insert'),(120999,110,'2018-10-16 18:01:38','UPDATE nota_venta SET estatus_facturacion = 1, factura_id = \'3059\' WHERE id = \'60\'','update'),(121000,110,'2018-10-16 18:01:58','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento, NumeroOC, FechaOC) VALUES (\'6740725\', \'1000\', \'1\', \'1\', \'94\', \'http://app2.bsale.cl/view/15057/c399d20533c9.pdf?sfd=99\', \'1\', \'\', NOW(), NOW(), \'2\', \'2018-11-05\', 0.19, \'38\', \'\', \'1969-01-31\')','insert'),(121001,110,'2018-10-16 18:02:03','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3060\', \'Habilitación e Instalación\', \'189076\', \'1\', \'0\', \'0\', \'225000\', \'\')','insert'),(121002,109,'2018-10-17 10:10:40','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento, NumeroOC, FechaOC) VALUES (\'12713590\', \'1\', \'2\', \'1\', \'95\', \'http://app2.bsale.cl/view/15057/ed9634918388.pdf?sfd=99\', \'1\', \'\', NOW(), NOW(), \'1\', \'2018-11-06\', 0.19, \'41\', \'\', \'1970-01-31\')','insert'),(121003,109,'2018-10-17 10:10:44','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3061\', \'Arriendo de Equipos de Datos  - Proporcional Septiembre (2 Dias)\', \'1824.2\', \'1\', \'0\', \'710\', \'2171\', \'12713590-8BSMI01\')','insert'),(121004,109,'2018-10-17 10:10:56','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento, NumeroOC, FechaOC) VALUES (\'765666\', \'1\', \'2\', \'1\', \'96\', \'http://app2.bsale.cl/view/15057/f8b12db5b85f.pdf?sfd=99\', \'1\', \'\', NOW(), NOW(), \'1\', \'2018-11-06\', 0.19, \'42\', \'\', \'1970-01-31\')','insert'),(121005,109,'2018-10-17 10:10:59','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3062\', \'Arriendo de Equipos de Datos  - Mes Septiembre\', \'27359\', \'1\', \'0\', \'705\', \'32557\', \'765666-1BSMI01\')','insert'),(121006,109,'2018-10-17 10:11:28','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento, NumeroOC, FechaOC) VALUES (\'12713590\', \'1000\', \'1\', \'1\', \'97\', \'http://app2.bsale.cl/view/15057/b2f2166cb1bb.pdf?sfd=99\', \'1\', \'\', NOW(), NOW(), \'1\', \'2018-11-06\', 0.19, \'43\', \'\', \'1969-01-31\')','insert'),(121007,109,'2018-10-17 10:11:31','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3063\', \'Habilitación Servicio Internet\', \'191596\', \'1\', \'0\', \'0\', \'227999\', \'\')','insert'),(121008,109,'2018-10-17 10:22:05','INSERT INTO facturas_pagos(FacturaId, FechaPago, TipoPago, Detalle, Monto, FechaEmisionCheque, FechaVencimientoCheque, IdUsuarioSession) VALUES (\'3043\',\'2018-10-16\',\'1\',\'transpaso de Servicios Integrales del Sur\',\'32557\',\'1969-01-31\',\'1969-01-31\',\'109\')','insert'),(121009,109,'2018-10-17 12:06:14','INSERT INTO devoluciones(FacturaId, DevolucionIdBsale, DocumentoIdBsale, UrlPdfBsale, Motivo, FechaDevolucion, HoraDevolucion, NumeroDocumento, DevolucionAnulada) VALUES (\'3063\', \'17\', \'98\', \'http://app2.bsale.cl/view/15057/4eec7e9a7e32.pdf?sfd=99\',\'error en facturacion\', NOW(), NOW(),\'8\', \'0\')','insert'),(121010,109,'2018-10-17 12:06:14','UPDATE facturas SET EstatusFacturacion = \'2\', FechaFacturacion = NOW() WHERE Id = \'3063\'','update'),(121011,109,'2018-10-17 12:11:18','INSERT INTO facturas_pagos(FacturaId, FechaPago, TipoPago, Detalle, Monto, FechaEmisionCheque, FechaVencimientoCheque, IdUsuarioSession) VALUES (\'3023\',\'2018-10-17\',\'1\',\'123\',\'65114\',\'1969-01-31\',\'1969-01-31\',\'109\')','insert'),(121012,109,'2018-10-17 12:11:49','DELETE FROM facturas_pagos WHERE Id = 37','delete'),(121013,108,'2018-10-17 13:23:22','INSERT INTO giros (nombre) VALUES (\'EMPRESARIO\')','insert'),(121014,108,'2018-10-17 13:24:30','INSERT INTO personaempresa\n			(rut, dv, nombre, giro, ciudad, region, direccion, correo, contacto, comentario, telefono, alias, tipo_cliente, id_usuario_sistema, clase_cliente, tipo_pago_bsale_id, posee_pac)\n			VALUES\n			(\'15561394\', \'7\', \'MIGUEL RODRIGO LEIVA GUZMáN\', \'EMPRESARIO\', \'312\', \'13\', \'PARCELA DON RAFAEL NúMERO 48.\', \'MIGUEL.ASESORIA@GMAIL.COM\', \'MIGUEL LEIVA\', \'\', \'974215207\', \'\', \'2\', \'108\', \'1\', \'15\', \'0\')','insert'),(121015,108,'2018-10-17 13:31:00','INSERT INTO arriendo_equipos_datos (IdServicio, Velocidad, Plan, IdOrigen, IdProducto, TipoDestino) VALUES (\'715\', \'3x1\', \'R3\', \'10\', \'0\', \'2\')','insert'),(121016,108,'2018-10-17 13:31:05','UPDATE `servicios` set `FacturarSinInstalacion` = \'1\' where `Id` = \'715\'','update'),(121017,117,'2018-10-17 13:48:02','INSERT INTO nota_venta(rut, fecha, numero_oc, fecha_oc, solicitado_por, estatus_facturacion) VALUES (\'15561394\',\'2018-10-17\',\'\',\'1969-01-31\',\'108\',\'0\')','insert'),(121018,117,'2018-10-17 13:48:02','INSERT INTO nota_venta_detalle(nota_venta_id, concepto, cantidad, precio, total) VALUES (\'61\',\'habilitación Servicio de Internet\',\'1\',\'191596\',\'227999\')','insert'),(121019,117,'2018-10-17 13:48:40','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, NumeroOC, FechaOC) VALUES (\'15561394\', \'1000\', \'1\', \'0\', NOW(), NOW(), \'2\', NOW(), 0.19, \'0\', \'\', \'0\', \'\', \'\', \'1969-01-31\')','insert'),(121020,117,'2018-10-17 13:48:40','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3064\', \'habilitación Servicio de Internet\', \'191596\', \'1\', \'0\', \'0\', \'227999\', \'\')','insert'),(121021,117,'2018-10-17 13:48:40','UPDATE nota_venta SET estatus_facturacion = 1, factura_id = \'3064\' WHERE id = \'61\'','update'),(121022,117,'2018-10-17 13:49:24','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento, NumeroOC, FechaOC) VALUES (\'15561394\', \'1000\', \'1\', \'1\', \'99\', \'http://app2.bsale.cl/view/15057/d6a7905288a4.pdf?sfd=99\', \'1\', \'\', NOW(), NOW(), \'2\', \'2018-11-06\', 0.19, \'39\', \'\', \'1969-01-31\')','insert'),(121023,117,'2018-10-17 13:49:28','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3065\', \'habilitación Servicio de Internet\', \'191596\', \'1\', \'0\', \'0\', \'227999\', \'\')','insert'),(121024,117,'2018-10-17 13:51:02','INSERT INTO facturas_pagos(FacturaId, FechaPago, TipoPago, Detalle, Monto, FechaEmisionCheque, FechaVencimientoCheque, IdUsuarioSession) VALUES (\'3065\',\'2018-10-03\',\'1\',\'\',\'114000\',\'1969-01-31\',\'1969-01-31\',\'117\')','insert'),(121025,117,'2018-10-17 13:52:52','INSERT INTO facturas_pagos(FacturaId, FechaPago, TipoPago, Detalle, Monto, FechaEmisionCheque, FechaVencimientoCheque, IdUsuarioSession) VALUES (\'3065\',\'2018-10-12\',\'1\',\'\',\'113999\',\'1969-01-31\',\'1969-01-31\',\'117\')','insert'),(121026,117,'2018-10-17 13:59:11','INSERT INTO facturas_pagos(FacturaId, FechaPago, TipoPago, Detalle, Monto, FechaEmisionCheque, FechaVencimientoCheque, IdUsuarioSession) VALUES (\'3029\',\'2018-10-02\',\'1\',\'\',\'32557\',\'1969-01-31\',\'1969-01-31\',\'117\')','insert'),(121027,117,'2018-10-17 14:00:07','INSERT INTO facturas_pagos(FacturaId, FechaPago, TipoPago, Detalle, Monto, FechaEmisionCheque, FechaVencimientoCheque, IdUsuarioSession) VALUES (\'3037\',\'2018-10-02\',\'1\',\'\',\'191091\',\'1969-01-31\',\'1969-01-31\',\'117\')','insert'),(121028,117,'2018-10-17 14:02:18','INSERT INTO facturas_pagos(FacturaId, FechaPago, TipoPago, Detalle, Monto, FechaEmisionCheque, FechaVencimientoCheque, IdUsuarioSession) VALUES (\'3037\',\'2018-08-14\',\'1\',\'\',\'194408\',\'1969-01-31\',\'1969-01-31\',\'117\')','insert'),(121029,117,'2018-10-18 09:01:59','INSERT INTO nota_venta(rut, fecha, numero_oc, fecha_oc, solicitado_por, estatus_facturacion) VALUES (\'13825370\',\'2018-10-18\',\'\',\'1969-01-31\',\'108\',\'0\')','insert'),(121030,117,'2018-10-18 09:01:59','INSERT INTO nota_venta_detalle(nota_venta_id, concepto, cantidad, precio, total) VALUES (\'62\',\'HABILITACION SERVICIO INTERNET\',\'1\',\'189075\',\'224999\')','insert'),(121031,117,'2018-10-18 09:02:12','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, NumeroOC, FechaOC) VALUES (\'13825370\', \'1000\', \'1\', \'0\', NOW(), NOW(), \'2\', NOW(), 0.19, \'0\', \'\', \'0\', \'\', \'\', \'1969-01-31\')','insert'),(121032,117,'2018-10-18 09:02:12','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3066\', \'HABILITACION SERVICIO INTERNET\', \'189075\', \'1\', \'0\', \'0\', \'224999\', \'\')','insert'),(121033,117,'2018-10-18 09:02:12','UPDATE nota_venta SET estatus_facturacion = 1, factura_id = \'3066\' WHERE id = \'62\'','update'),(121034,117,'2018-10-18 09:04:34','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento, NumeroOC, FechaOC) VALUES (\'13825370\', \'1000\', \'1\', \'1\', \'100\', \'http://app2.bsale.cl/view/15057/8a9833a15689.pdf?sfd=99\', \'1\', \'\', NOW(), NOW(), \'2\', \'2018-11-07\', 0.19, \'40\', \'\', \'1969-01-31\')','insert'),(121035,117,'2018-10-18 09:04:39','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3067\', \'HABILITACION SERVICIO INTERNET\', \'189075\', \'1\', \'0\', \'0\', \'224999\', \'\')','insert'),(121036,117,'2018-10-18 09:06:10','INSERT INTO facturas_pagos(FacturaId, FechaPago, TipoPago, Detalle, Monto, FechaEmisionCheque, FechaVencimientoCheque, IdUsuarioSession) VALUES (\'3067\',\'2018-08-06\',\'1\',\'\',\'120000\',\'1969-01-31\',\'1969-01-31\',\'117\')','insert'),(121037,117,'2018-10-18 09:06:40','INSERT INTO facturas_pagos(FacturaId, FechaPago, TipoPago, Detalle, Monto, FechaEmisionCheque, FechaVencimientoCheque, IdUsuarioSession) VALUES (\'3067\',\'2018-08-09\',\'1\',\'\',\'104999\',\'1969-01-31\',\'1969-01-31\',\'117\')','insert'),(121038,108,'2018-10-18 18:05:12','INSERT INTO arriendo_equipos_datos (IdServicio, Velocidad, Plan, IdOrigen, IdProducto, TipoDestino) VALUES (\'716\', \'2x600\', \'R2\', \'10\', \'0\', \'2\')','insert'),(121039,108,'2018-10-22 18:03:16','INSERT INTO giros (nombre) VALUES (\'TALLER DE REDES\')','insert'),(121040,108,'2018-10-22 18:06:24','INSERT INTO personaempresa\n			(rut, dv, nombre, giro, ciudad, region, direccion, correo, contacto, comentario, telefono, alias, tipo_cliente, id_usuario_sistema, clase_cliente, tipo_pago_bsale_id, posee_pac)\n			VALUES\n			(\'76911785\', \'7\', \'TALLERES DEL SUR SPA\', \'TALLER DE REDES\', \'312\', \'13\', \'TRAPéN.  LOTE 14.  PANITAO\', \'GONZALO.ROJAS@ERSIL.CL\', \'GONZALO ROJAS\', \'\', \'954161342\', \'\', \'2\', \'108\', \'1\', \'15\', \'0\')','insert'),(121041,108,'2018-10-22 18:06:24','INSERT INTO contactos ( contacto, tipo_contacto, correo, telefono, rut ) VALUES ( \'Marcela Jimenez\', ( SELECT id FROM mantenedor_tipo_contacto WHERE nombre = \'Facturación\' ), \'marcela.jimenez@ersil.cl\', \'954161342\', \'76911785\' )','insert'),(121042,108,'2018-10-22 18:21:12','INSERT INTO arriendo_equipos_datos (IdServicio, Velocidad, Plan, IdOrigen, IdProducto, TipoDestino) VALUES (\'717\', \'5x5\', \'PK5\', \'10\', \'0\', \'2\')','insert'),(121043,108,'2018-10-22 18:21:15','UPDATE `servicios` set `FacturarSinInstalacion` = \'1\' where `Id` = \'717\'','update'),(121044,108,'2018-10-22 18:28:10','INSERT INTO nota_venta(rut, fecha, numero_oc, fecha_oc, solicitado_por, estatus_facturacion) VALUES (\'76911785\',\'2018-10-22\',\'\',\'2018-10-22\',\'108\',\'0\')','insert'),(121045,108,'2018-10-22 18:28:10','INSERT INTO nota_venta_detalle(nota_venta_id, concepto, cantidad, precio, total) VALUES (\'63\',\'Red LAN, Equipo Base + Equipo Receptor\',\'1\',\'245619\',\'292287\')','insert'),(121046,108,'2018-10-22 18:28:10','INSERT INTO nota_venta_detalle(nota_venta_id, concepto, cantidad, precio, total) VALUES (\'63\',\'UPS en línea\',\'1\',\'354783\',\'422192\')','insert'),(121047,108,'2018-10-22 18:28:40','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, NumeroOC, FechaOC) VALUES (\'76911785\', \'1000\', \'1\', \'0\', NOW(), NOW(), \'2\', NOW(), 0.19, \'0\', \'\', \'0\', \'\', \'\', \'2018-10-22\')','insert'),(121048,108,'2018-10-22 18:28:40','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3068\', \'Red LAN, Equipo Base + Equipo Receptor\', \'245619\', \'1\', \'0\', \'0\', \'292287\', \'\')','insert'),(121049,108,'2018-10-22 18:28:40','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3068\', \'UPS en línea\', \'354783\', \'1\', \'0\', \'0\', \'422192\', \'\')','insert'),(121050,108,'2018-10-22 18:28:40','UPDATE nota_venta SET estatus_facturacion = 1, factura_id = \'3068\' WHERE id = \'63\'','update'),(121051,108,'2018-10-23 09:24:46','INSERT INTO nota_venta(rut, fecha, numero_oc, fecha_oc, solicitado_por, estatus_facturacion) VALUES (\'76911785\',\'2018-10-22\',\'\',\'1969-01-31\',\'108\',\'0\')','insert'),(121052,108,'2018-10-23 09:24:46','INSERT INTO nota_venta_detalle(nota_venta_id, concepto, cantidad, precio, total) VALUES (\'64\',\'Access Point WiFi (Pintura), Access Point WiFi (Cabos), Cable Cat5e, Materiales: Fijaciones, amarras\',\'1\',\'367160\',\'436920\')','insert'),(121053,108,'2018-10-23 09:32:24','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, NumeroOC, FechaOC) VALUES (\'76911785\', \'1000\', \'1\', \'0\', NOW(), NOW(), \'2\', NOW(), 0.19, \'0\', \'\', \'0\', \'\', \'\', \'1969-01-31\')','insert'),(121054,108,'2018-10-23 09:32:24','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3069\', \'Access Point WiFi (Pintura), Access Point WiFi (Cabos), Cable Cat5e, Materiales: Fijaciones, amarras\', \'367160\', \'1\', \'0\', \'0\', \'436920\', \'\')','insert'),(121055,108,'2018-10-23 09:32:24','UPDATE nota_venta SET estatus_facturacion = 1, factura_id = \'3069\' WHERE id = \'64\'','update'),(121056,108,'2018-10-23 09:35:03','INSERT INTO giros (nombre) VALUES (\'CULTIVOS HIDROPóNICOS E INVERNADEROS\')','insert'),(121057,108,'2018-10-23 10:44:02','INSERT INTO personaempresa\n			(rut, dv, nombre, giro, ciudad, region, direccion, correo, contacto, comentario, telefono, alias, tipo_cliente, id_usuario_sistema, clase_cliente, tipo_pago_bsale_id, posee_pac)\n			VALUES\n			(\'76466000\', \'5\', \'SOCIEDAD AGRíCOLA OASIS DE LAMPA LTDA,\', \'CULTIVOS HIDROPóNICOS E INVERNADEROS\', \'83\', \'7\', \'PARCELA 2B. NUEVO PORVENIR\', \'FINAZAS@OASISDELAMPA.CL\', \'RICARDO ROTH\', \'\', \'987769457\', \'RICARDO ROTH\', \'2\', \'108\', \'1\', \'15\', \'0\')','insert'),(121058,108,'2018-10-23 10:44:02','INSERT INTO contactos ( contacto, tipo_contacto, correo, telefono, rut ) VALUES ( \'Ricardo Roth\', ( SELECT id FROM mantenedor_tipo_contacto WHERE nombre = \'Técnico\' ), \'rroth@oasisdelampa.cl\', \'987769457\', \'76466000\' )','insert'),(121059,108,'2018-10-23 10:54:54','INSERT INTO arriendo_equipos_datos (IdServicio, Velocidad, Plan, IdOrigen, IdProducto, TipoDestino) VALUES (\'718\', \'3x1\', \'R3\', \'10\', \'0\', \'2\')','insert'),(121060,108,'2018-10-23 10:55:07','UPDATE `servicios` set `FacturarSinInstalacion` = \'1\' where `Id` = \'718\'','update'),(121061,105,'2018-10-23 11:59:24','  UPDATE contactos \n                    SET contacto = \'Cjurgens\',\n                    tipo_contacto = \'2\',\n                    correo = \'cjurgens@teledata.cl, kcardenas@teledata.cl\',\n                    telefono = \'1\' \n                    WHERE\n                        id = \'124\'','update'),(121062,105,'2018-10-23 12:02:40','  INSERT INTO contactos ( contacto, tipo_contacto, correo, telefono, rut ) SELECT\n                \'Prueba\',\n                \'1\',\n                \'prueba@prueba.com\',\n                \'999888666\',\n                rut \n                FROM\n                    personaempresa \n                WHERE\n                    id = \'9999\'','insert'),(121063,116,'2018-10-23 12:08:16','  INSERT INTO contactos ( contacto, tipo_contacto, correo, telefono, rut ) SELECT\n                \'prueba3\',\n                \'1\',\n                \'prueba3@gmail.com\',\n                \'\',\n                rut \n                FROM\n                    personaempresa \n                WHERE\n                    id = \'24\'','insert'),(121064,116,'2018-10-23 12:10:25','  UPDATE contactos \n                    SET contacto = \'prueba32\',\n                    tipo_contacto = \'1\',\n                    correo = \'prueba3@gmail.com\',\n                    telefono = \'\' \n                    WHERE\n                        id = \'131\'','update'),(121065,105,'2018-10-23 12:18:55','DELETE FROM contactos WHERE Id = 130','delete'),(121066,116,'2018-10-23 12:23:34','DELETE FROM contactos WHERE Id = 131','delete'),(121067,108,'2018-10-23 16:36:16','INSERT INTO giros (nombre) VALUES (\'APICULTURA Y HORTALIZAS\')','insert'),(121068,108,'2018-10-23 16:42:05','INSERT INTO personaempresa\n			(rut, dv, nombre, giro, ciudad, region, direccion, correo, contacto, comentario, telefono, alias, tipo_cliente, id_usuario_sistema, clase_cliente, tipo_pago_bsale_id, posee_pac)\n			VALUES\n			(\'8564327\', \'4\', \'ALFREDO ARNOLDO ROTH REED\', \'APICULTURA Y HORTALIZAS\', \'313\', \'13\', \'PEULLA S/N.  LAGO TODOS LOS SANTOS\', \'PENDIENTE@CORREO.CL\', \'ALFREDO ROTH\', \'\', \'973334092\', \'\', \'2\', \'108\', \'1\', \'15\', \'0\')','insert'),(121069,108,'2018-10-23 16:48:47','INSERT INTO arriendo_equipos_datos (IdServicio, Velocidad, Plan, IdOrigen, IdProducto, TipoDestino) VALUES (\'719\', \'3x1\', \'R3\', \'10\', \'0\', \'2\')','insert'),(121070,108,'2018-10-23 16:48:48','UPDATE `servicios` set `FacturarSinInstalacion` = \'1\' where `Id` = \'719\'','update'),(121071,108,'2018-10-23 16:50:19','UPDATE personaempresa SET alias = \'\', nombre = \'ALVARO POBLETE SMITH\', giro = \'SIN GIRO, PERSONA NATURAL\', direccion = \'PARCELACIóN LLANQUIHUE\', correo = \'APOBLETE@CAMANCHACA.CL\', contacto = \'ÁLVARO POBLETE\', comentario = \'GERENTE GENERAL CAMANCHACA\', telefono = \'9 9444 2214\', tipo_cliente = \'1\', ciudad = \'309\', region = \'13\', tipo_pago_bsale_id = \'15\', posee_pac = \'0\' WHERE id = \'23\'','update'),(121072,108,'2018-10-23 16:53:13','UPDATE personaempresa SET alias = \'\', nombre = \'ALFREDO ARNOLDO ROTH REED\', giro = \'APICULTURA Y HORTALIZAS\', direccion = \'PEULLA S/N.  LAGO TODOS LOS SANTOS\', correo = \'Alfredo-roth@hotmail.com\', contacto = \'ALFREDO ROTH\', comentario = \'\', telefono = \'973334092\', tipo_cliente = \'2\', ciudad = \'313\', region = \'13\', tipo_pago_bsale_id = \'15\', posee_pac = \'0\' WHERE id = \'10008\'','update'),(121073,110,'2018-10-23 17:03:16','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento, NumeroOC, FechaOC) VALUES (\'76911785\', \'1000\', \'1\', \'1\', \'102\', \'http://app2.bsale.cl/view/15057/1bc66c7620f6.pdf?sfd=99\', \'1\', \'\', NOW(), NOW(), \'2\', \'2018-11-12\', 0.19, \'41\', \'\', \'2018-10-22\')','insert'),(121074,110,'2018-10-23 17:03:25','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3070\', \'Red LAN, Equipo Base + Equipo Receptor\', \'245619\', \'1\', \'0\', \'0\', \'292287\', \'\')','insert'),(121075,110,'2018-10-23 17:03:25','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3070\', \'UPS en línea\', \'354783\', \'1\', \'0\', \'0\', \'422192\', \'\')','insert'),(121076,110,'2018-10-23 17:04:03','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento, NumeroOC, FechaOC) VALUES (\'76911785\', \'1000\', \'1\', \'1\', \'103\', \'http://app2.bsale.cl/view/15057/cc07d7d3feac.pdf?sfd=99\', \'1\', \'\', NOW(), NOW(), \'2\', \'2018-11-12\', 0.19, \'42\', \'\', \'1969-01-31\')','insert'),(121077,110,'2018-10-23 17:04:15','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3071\', \'Access Point WiFi (Pintura), Access Point WiFi (Cabos), Cable Cat5e, Materiales: Fijaciones, amarras\', \'367160\', \'1\', \'0\', \'0\', \'436920\', \'\')','insert'),(121078,108,'2018-10-23 17:05:14','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento, NumeroOC, FechaOC) VALUES (\'76460253\', \'1000\', \'1\', \'1\', \'104\', \'http://app2.bsale.cl/view/15057/e8135985a375.pdf?sfd=99\', \'1\', \'\', NOW(), NOW(), \'2\', \'2018-11-12\', 0.19, \'43\', \'\', \'1969-01-31\')','insert'),(121079,108,'2018-10-23 17:05:18','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3072\', \'Habilitación Servicio Internet\', \'218487\', \'1\', \'0\', \'0\', \'260000\', \'\')','insert'),(121080,108,'2018-10-23 17:06:23','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento, NumeroOC, FechaOC) VALUES (\'8564327\', \'1\', \'3\', \'1\', \'105\', \'http://app2.bsale.cl/view/15057/a85940b41247.pdf?sfd=99\', \'1\', \'\', NOW(), NOW(), \'2\', \'2018-10-30\', 0.19, \'44\', \'0\', \'1970-01-31\')','insert'),(121081,108,'2018-10-23 17:06:27','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3073\', \'Arriendo de Equipos de Datos  - Costo de instalación / Habilitación\', \'191514.89\', \'1\', \'0.00\', \'719\', \'227903\', \'8564327-4FSMI01\')','insert'),(121082,108,'2018-10-23 17:06:27','UPDATE servicios SET EstatusFacturacion = \'1\', FechaFacturacion = NOW() WHERE Id = \'719\'','update'),(121083,108,'2018-10-23 17:09:23','INSERT INTO personaempresa\n			(rut, dv, nombre, giro, ciudad, region, direccion, correo, contacto, comentario, telefono, alias, tipo_cliente, id_usuario_sistema, clase_cliente, tipo_pago_bsale_id, posee_pac)\n			VALUES\n			(\'9580565\', \'5\', \'TORBEN PETERSEN ETTRUP\', \'SIN GIRO, PERSONA NATURAL\', \'313\', \'13\', \'CASILLA 975\', \'TORBEN.E.PETERSEN@GMAIL.COM\', \'TORBEN PETERSEN\', \'\', \'995350280\', \'\', \'1\', \'108\', \'2\', \'15\', \'0\')','insert'),(121084,108,'2018-10-23 17:13:06','INSERT INTO arriendo_equipos_datos (IdServicio, Velocidad, Plan, IdOrigen, IdProducto, TipoDestino) VALUES (\'720\', \'3x1\', \'R3\', \'10\', \'0\', \'2\')','insert'),(121085,108,'2018-10-23 18:25:10','INSERT INTO arriendo_equipos_datos (IdServicio, Velocidad, Plan, IdOrigen, IdProducto, TipoDestino) VALUES (\'721\', \'3x1\', \'R3\', \'10\', \'0\', \'2\')','insert'),(121086,117,'2018-10-24 17:26:57','DELETE FROM facturas_pagos WHERE Id = 31','delete'),(121087,117,'2018-10-24 17:27:04','DELETE FROM facturas_pagos WHERE Id = 32','delete'),(121088,117,'2018-10-24 17:28:42','DELETE FROM facturas_pagos WHERE Id = 35','delete'),(121089,117,'2018-10-24 17:28:52','DELETE FROM facturas_pagos WHERE Id = 34','delete'),(121090,117,'2018-10-24 17:29:57','DELETE FROM facturas_pagos WHERE Id = 44','delete'),(121091,117,'2018-10-24 17:30:03','DELETE FROM facturas_pagos WHERE Id = 43','delete'),(121092,117,'2018-10-24 17:30:49','DELETE FROM facturas_pagos WHERE Id = 39','delete'),(121093,117,'2018-10-24 17:30:53','DELETE FROM facturas_pagos WHERE Id = 38','delete'),(121094,117,'2018-10-24 17:31:39','DELETE FROM facturas_pagos WHERE Id = 40','delete'),(121095,117,'2018-10-24 17:31:50','DELETE FROM facturas_pagos WHERE Id = 42','delete'),(121096,117,'2018-10-24 17:31:54','DELETE FROM facturas_pagos WHERE Id = 41','delete'),(121097,117,'2018-10-24 17:32:56','DELETE FROM facturas_pagos WHERE Id = 30','delete'),(121098,110,'2018-10-25 12:17:25','  INSERT INTO contactos ( contacto, tipo_contacto, correo, telefono, rut ) SELECT\n                \'Daniela\',\n                \'2\',\n                \'daniela.castillo@incon.cl\',\n                \'\',\n                rut \n                FROM\n                    personaempresa \n                WHERE\n                    id = \'11\'','insert'),(121099,117,'2018-10-25 16:17:33','INSERT INTO facturas_pagos(FacturaId, FechaPago, TipoPago, Detalle, Monto, FechaEmisionCheque, FechaVencimientoCheque, IdUsuarioSession) VALUES (\'2978\',\'2018-10-25\',\'1\',\'\',\'134098\',\'1969-01-31\',\'1969-01-31\',\'117\')','insert'),(121100,116,'2018-10-26 10:35:58','INSERT INTO mantenedor_costos(nombre, direccion, personal_id, correo, telefono) VALUES (\'prueba 2\',\'123\',\'116\',\'dan@gmail.com\', \'0\')','insert'),(121101,110,'2018-10-26 11:57:03','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento, NumeroOC, FechaOC) VALUES (\'76911785\', \'1\', \'3\', \'1\', \'106\', \'http://app2.bsale.cl/view/15057/b33414b5c117.pdf?sfd=99\', \'1\', \'\', NOW(), NOW(), \'2\', \'2018-11-02\', 0.19, \'45\', \'0\', \'1970-01-31\')','insert'),(121102,110,'2018-10-26 11:57:10','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3074\', \'Arriendo de Equipos de Datos  - Costo de instalación / Habilitación\', \'1091361.2803\', \'1\', \'0.00\', \'717\', \'1298720\', \'76911785-7FSMI01\')','insert'),(121103,110,'2018-10-26 11:57:10','UPDATE servicios SET EstatusFacturacion = \'1\', FechaFacturacion = NOW() WHERE Id = \'717\'','update'),(121104,110,'2018-10-26 11:57:18','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento, NumeroOC, FechaOC) VALUES (\'76466000\', \'1\', \'3\', \'1\', \'107\', \'http://app2.bsale.cl/view/15057/071c6669259c.pdf?sfd=99\', \'1\', \'\', NOW(), NOW(), \'2\', \'2018-11-02\', 0.19, \'46\', \'0\', \'1970-01-31\')','insert'),(121105,110,'2018-10-26 11:57:22','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3075\', \'Arriendo de Equipos de Datos  - Costo de instalación / Habilitación\', \'273592.7\', \'1\', \'0.00\', \'718\', \'325575\', \'76466000-5FSMI01\')','insert'),(121106,110,'2018-10-26 11:57:22','UPDATE servicios SET EstatusFacturacion = \'1\', FechaFacturacion = NOW() WHERE Id = \'718\'','update'),(121107,110,'2018-10-26 11:57:28','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento, NumeroOC, FechaOC) VALUES (\'76521560\', \'1\', \'3\', \'1\', \'108\', \'http://app2.bsale.cl/view/15057/51b529dd714a.pdf?sfd=99\', \'1\', \'\', NOW(), NOW(), \'2\', \'2018-11-02\', 0.19, \'47\', \'0\', \'1970-01-31\')','insert'),(121108,110,'2018-10-26 11:57:36','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3076\', \'Arriendo de Equipos de Datos  - Costo de instalación / Habilitación\', \'382482.5946\', \'1\', \'0.00\', \'704\', \'455154\', \'76521560-9FSMI01\')','insert'),(121109,110,'2018-10-26 11:57:36','UPDATE servicios SET EstatusFacturacion = \'1\', FechaFacturacion = NOW() WHERE Id = \'704\'','update'),(121110,110,'2018-10-26 11:57:46','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento, NumeroOC, FechaOC) VALUES (\'15561394\', \'1\', \'3\', \'1\', \'109\', \'http://app2.bsale.cl/view/15057/4ffdd6719af6.pdf?sfd=99\', \'1\', \'\', NOW(), NOW(), \'2\', \'2018-11-02\', 0.19, \'48\', \'0\', \'1970-01-31\')','insert'),(121111,110,'2018-10-26 11:57:50','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3077\', \'Arriendo de Equipos de Datos  - Costo de instalación / Habilitación\', \'191514.89\', \'1\', \'0.00\', \'715\', \'227903\', \'15561394-7FSMI01\')','insert'),(121112,110,'2018-10-26 11:57:50','UPDATE servicios SET EstatusFacturacion = \'1\', FechaFacturacion = NOW() WHERE Id = \'715\'','update'),(121113,110,'2018-10-26 11:57:59','INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento, NumeroOC, FechaOC) VALUES (\'10420529\', \'1\', \'3\', \'1\', \'110\', \'http://app2.bsale.cl/view/15057/5cbff105a75c.pdf?sfd=99\', \'1\', \'\', NOW(), NOW(), \'2\', \'2018-11-02\', 0.19, \'49\', \'0\', \'1970-01-31\')','insert'),(121114,110,'2018-10-26 11:58:03','INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES (\'3078\', \'Arriendo de Equipos de Datos  - Costo de instalación / Habilitación\', \'186863.8141\', \'1\', \'0.00\', \'707\', \'222368\', \'10420529-1FSMI01\')','insert'),(121115,110,'2018-10-26 11:58:03','UPDATE servicios SET EstatusFacturacion = \'1\', FechaFacturacion = NOW() WHERE Id = \'707\'','update'),(121116,110,'2018-10-26 12:11:13','  UPDATE contactos \n                    SET contacto = \'Katty\',\n                    tipo_contacto = \'2\',\n                    correo = \'SIS.PTOVARAS@GMAIL.COM\',\n                    telefono = \'652566600\' \n                    WHERE\n                        id = \'119\'','update'),(121117,110,'2018-10-26 12:11:36','  UPDATE contactos \n                    SET contacto = \'Servicios integrales del Sur S.A.\',\n                    tipo_contacto = \'2\',\n                    correo = \'SIS.PTOVARAS@GMAIL.COM\',\n                    telefono = \'652566600\' \n                    WHERE\n                        id = \'119\'','update'),(121118,104,'2018-10-26 12:45:14','INSERT INTO facturas_pagos(FacturaId, FechaPago, TipoPago, Detalle, Monto, FechaEmisionCheque, FechaVencimientoCheque, IdUsuarioSession) VALUES (\'3053\',\'2018-10-26\',\'1\',\'\',\'40000\',\'1969-01-31\',\'1969-01-31\',\'104\')','insert'),(121119,104,'2018-10-26 12:46:02','DELETE FROM facturas_pagos WHERE Id = 46','delete'),(121120,104,'2018-10-26 12:47:10','INSERT INTO facturas_pagos(FacturaId, FechaPago, TipoPago, Detalle, Monto, FechaEmisionCheque, FechaVencimientoCheque, IdUsuarioSession) VALUES (\'3053\',\'2018-10-19\',\'1\',\'\',\'3000\',\'1969-01-31\',\'1969-01-31\',\'104\')','insert'),(121121,104,'2018-10-26 12:48:02','DELETE FROM facturas_pagos WHERE Id = 47','delete'),(121122,110,'2018-10-26 14:08:52','DELETE FROM contactos WHERE Id = 125','delete'),(121123,110,'2018-10-26 14:10:25','UPDATE personaempresa SET alias = \'\', nombre = \'AGRíCOLA Y COMERCIAL NOMEHUE LTDA.\', giro = \'EXPLOTACIóN MIXTA\', direccion = \'AVENIDA DEL VALLE NORTE 787.  OF 404.\', correo = \'gcisternas@nomehue.cl\', contacto = \'GERMáN CISTERNAS OSSA\', comentario = \'FONO PERSONAL DON GERMáN: +56 9 8769 7573\', telefono = \'227547500\', tipo_cliente = \'2\', ciudad = \'102\', region = \'7\', tipo_pago_bsale_id = \'15\', posee_pac = \'0\' WHERE id = \'24\'','update'),(121124,110,'2018-10-26 14:21:40','  UPDATE contactos \n                    SET contacto = \'Cjurgens\',\n                    tipo_contacto = \'2\',\n                    correo = \'gcisternas@nomehue.cl\',\n                    telefono = \'1\' \n                    WHERE\n                        id = \'120\'','update'),(121125,116,'2018-10-26 15:26:37','INSERT INTO mantenedor_proveedores(nombre, direccion, telefono, contacto, correo, rut) VALUES (\'proveedor_2\', \'P. Montt\', \'03123123\', \'prueba2contacto\', \'prueba2@gmail.com\', \'1231231\')','insert'),(121126,116,'2018-10-26 15:27:57','INSERT INTO mantenedor_costos(nombre, direccion, personal_id, correo, telefono) VALUES (\'prueba2\',\'p. montt\',\'116\',\'prueba2@gmail.com\', \'032123123\')','insert'),(121127,117,'2018-10-26 16:23:41','INSERT INTO facturas_pagos(FacturaId, FechaPago, TipoPago, Detalle, Monto, FechaEmisionCheque, FechaVencimientoCheque, IdUsuarioSession) VALUES (\'3075\',\'2018-10-23\',\'1\',\'\',\'326000\',\'1969-01-31\',\'1969-01-31\',\'117\')','insert');
/*!40000 ALTER TABLE `log_query` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log_sistema`
--

DROP TABLE IF EXISTS `log_sistema`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log_sistema` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Fecha` varchar(18) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `operacion` varchar(10) NOT NULL,
  `id_registro` int(11) NOT NULL,
  `tabla` varchar(30) NOT NULL,
  `query` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log_sistema`
--

LOCK TABLES `log_sistema` WRITE;
/*!40000 ALTER TABLE `log_sistema` DISABLE KEYS */;
/*!40000 ALTER TABLE `log_sistema` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mantencion_red`
--

DROP TABLE IF EXISTS `mantencion_red`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mantencion_red` (
  `IdMantencionRed` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(300) DEFAULT NULL,
  `ComentarioDatosAdicionales` varchar(300) DEFAULT NULL,
  `IdServicio` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdMantencionRed`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mantencion_red`
--

LOCK TABLES `mantencion_red` WRITE;
/*!40000 ALTER TABLE `mantencion_red` DISABLE KEYS */;
/*!40000 ALTER TABLE `mantencion_red` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mantenedor_bodegas`
--

DROP TABLE IF EXISTS `mantenedor_bodegas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mantenedor_bodegas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `telefono` varchar(100) CHARACTER SET latin1 NOT NULL,
  `personal_id` int(11) NOT NULL,
  `correo` varchar(100) CHARACTER SET latin1 NOT NULL,
  `principal` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mantenedor_bodegas`
--

LOCK TABLES `mantenedor_bodegas` WRITE;
/*!40000 ALTER TABLE `mantenedor_bodegas` DISABLE KEYS */;
INSERT INTO `mantenedor_bodegas` VALUES (10,'BODEGA PUERTO VARAS','TERRAPLEN 675','652566600',107,'RBERNDT@TELEDATA.CL',1);
/*!40000 ALTER TABLE `mantenedor_bodegas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mantenedor_costos`
--

DROP TABLE IF EXISTS `mantenedor_costos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mantenedor_costos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `principal` int(11) NOT NULL DEFAULT '0',
  `direccion` varchar(200) NOT NULL,
  `telefono` varchar(100) CHARACTER SET latin1 NOT NULL,
  `personal_id` int(11) NOT NULL,
  `correo` varchar(100) CHARACTER SET latin1 NOT NULL,
  `codigo_cuenta` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mantenedor_costos`
--

LOCK TABLES `mantenedor_costos` WRITE;
/*!40000 ALTER TABLE `mantenedor_costos` DISABLE KEYS */;
INSERT INTO `mantenedor_costos` VALUES (1,'Disponible',0,'','0',116,'0',10100),(2,'Caja Principal',0,'','0',116,'0',10101),(3,'Bancos',0,'','0',116,'0',10300),(4,'Banco Chile',0,'','',116,'',10301),(5,'Depósitos a plazo',0,'','',116,'',10500),(6,'Dep. a plazo BCO.BCI',0,'','',116,'',10501),(7,'Deudores por ventas',0,'','',116,'',20000),(8,'Clientes ventas crédito',0,'','',116,'',20001),(9,'Documentos por cobrar',0,'','',116,'',22000),(10,'Cheques a fecha por cobrar',0,'','',116,'',22001),(11,'Cheques protestados',0,'','',116,'',22002),(12,'Deudores varios',0,'','',116,'',23000),(13,'Existencias',0,'','',116,'',25000),(14,'Existencias antenas',0,'','',116,'',25001),(15,'Existencias router',0,'','',116,'',25002),(16,'Existencias cables/conectores',0,'','',116,'',25003),(17,'Existencias UPS',0,'','',116,'',25004),(18,'Impuestos por recuperar',0,'','',116,'',26000),(19,'Impuesto provicional',0,'','',116,'',26001),(20,'PPM 2017',0,'','',116,'',26002),(21,'IVA crédito fiscal',0,'','',116,'',26101),(22,'Crédito 33 BIS activo fijo',0,'','',116,'',26102),(23,'Cré. por donaciones',0,'','',116,'',26103),(24,'CDTO. Por dev. Impto. Renta',0,'','',116,'',26104),(25,'Otros imptos por recuperar',0,'','',116,'',26105),(26,'Cuentas particulares',0,'','',116,'',27000),(27,'CTA. Part. Sergio Casas Del Vall',0,'','',116,'',27001),(28,'CTA. Part. Maria Stecher',0,'','',116,'',27002),(29,'Activos fijos',0,'','',116,'',30000),(30,'Maquinarias',0,'','',116,'',30001),(31,'Equipos computacionales',0,'','',116,'',30002),(32,'Vehiculos',0,'','',116,'',30003),(33,'Muebles y utiles',0,'','',116,'',30004),(34,'Inst. De Est. Telecomunicaciones',0,'','',116,'',30005),(35,'Equipos de tel. De Insfraestruc',0,'','',116,'',30006),(36,'Herramientas',0,'','',116,'',30007),(37,'Otras maquinarias y equipos',0,'','',116,'',30010),(38,'Inmuebles',0,'','',116,'',31000),(39,'Terreno 1',0,'','',116,'',31001),(40,'Otros activos fijos',0,'','',116,'',32000),(41,'Vehiculos en leasing',0,'','',116,'',32001),(42,'Otros activos fijos',0,'','',116,'',32003),(43,'Perdida de arrastre',0,'','',116,'',40001),(44,'Proveedores',0,'','',116,'',50000),(45,'Proveedores',0,'','',116,'',50001),(46,'Acreedores',0,'','',116,'',55000),(47,'Acreedores',0,'','',116,'',55001),(48,'Honorarios por pagar',0,'','',116,'',55003),(49,'Prov. Proveedores',0,'','',116,'',55004),(50,'Prov. Honorarios',0,'','',116,'',55005),(51,'Anticipo clientes',0,'','',116,'',55006),(52,'PTMOS. Bancarios',0,'','',116,'',56000),(53,'Oblig. BCO. Chile CLP',0,'','',116,'',56001),(54,'Oblig. Bcos. Hipotecario',0,'','',116,'',56002),(55,'Oblig. Bcos. CLP. OP96678',0,'','',116,'',56003),(56,'Oblig. Por leas. Bco. BCI',0,'','',116,'',56004),(57,'Oblig. Por leas. Forum',0,'','',116,'',56005),(58,'Impuestos por pagar',0,'','',116,'',57000),(59,'IVA debito fiscal',0,'','',116,'',57001),(60,'Retencion profesional',0,'','',116,'',57002),(61,'IVA retenido a terceros',0,'','',116,'',57003),(62,'Prov. Impto. Primera CAT',0,'','',116,'',57004),(63,'Impto. Unico trabajadores',0,'','',116,'',57005),(64,'Impuestos por pagar',0,'','',116,'',57006),(65,'Contribuciones por pagar',0,'','',116,'',57007),(66,'Convenios tesoreria por pagar',0,'','',116,'',57008),(67,'PPM Diciembre',0,'','',116,'',57010),(68,'Instituciones de prevision',0,'','',116,'',58000),(69,'Imposiciones por pagar',0,'','',116,'',58001),(70,'Saldo a favor CCAF',0,'','',116,'',58002),(71,'Ctas. Ctes personal',0,'','',116,'',59000),(72,'Sueldos liquidos',0,'','',116,'',59001),(73,'Anticipos personal',0,'','',116,'',59002),(74,'Prestamos al personal',0,'','',116,'',59003),(75,'Sobregiro',0,'','',116,'',59004),(76,'Otros descuentos',0,'','',116,'',59005),(77,'Capital y reservas',0,'','',116,'',60000),(78,'Capital social',0,'','',116,'',60001),(79,'Revalorizacion capital propio',0,'','',116,'',60101),(80,'Reservas aumento de capital',0,'','',116,'',60201),(81,'Dividendos distribuidos',0,'','',116,'',60303),(82,'Utilidades',0,'','',116,'',60401);
/*!40000 ALTER TABLE `mantenedor_costos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mantenedor_marca_producto`
--

DROP TABLE IF EXISTS `mantenedor_marca_producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mantenedor_marca_producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_producto_id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mantenedor_marca_producto`
--

LOCK TABLES `mantenedor_marca_producto` WRITE;
/*!40000 ALTER TABLE `mantenedor_marca_producto` DISABLE KEYS */;
/*!40000 ALTER TABLE `mantenedor_marca_producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mantenedor_modelo_producto`
--

DROP TABLE IF EXISTS `mantenedor_modelo_producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mantenedor_modelo_producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `marca_producto_id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mantenedor_modelo_producto`
--

LOCK TABLES `mantenedor_modelo_producto` WRITE;
/*!40000 ALTER TABLE `mantenedor_modelo_producto` DISABLE KEYS */;
/*!40000 ALTER TABLE `mantenedor_modelo_producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mantenedor_proveedores`
--

DROP TABLE IF EXISTS `mantenedor_proveedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mantenedor_proveedores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(300) NOT NULL,
  `direccion` varchar(300) NOT NULL,
  `telefono` varchar(100) CHARACTER SET latin1 NOT NULL,
  `contacto` varchar(300) NOT NULL,
  `correo` varchar(100) CHARACTER SET latin1 NOT NULL,
  `rut` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mantenedor_proveedores`
--

LOCK TABLES `mantenedor_proveedores` WRITE;
/*!40000 ALTER TABLE `mantenedor_proveedores` DISABLE KEYS */;
INSERT INTO `mantenedor_proveedores` VALUES (1,'proveedor_1','puerto varas','04246504181','Daniel Elias','daniel30081990@gmail.com',20147586),(2,'proveedor_2','P. Montt','03123123','prueba2contacto','prueba2@gmail.com',1231231);
/*!40000 ALTER TABLE `mantenedor_proveedores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mantenedor_servicios`
--

DROP TABLE IF EXISTS `mantenedor_servicios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mantenedor_servicios` (
  `IdServicio` int(11) NOT NULL AUTO_INCREMENT,
  `servicio` varchar(200) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`IdServicio`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mantenedor_servicios`
--

LOCK TABLES `mantenedor_servicios` WRITE;
/*!40000 ALTER TABLE `mantenedor_servicios` DISABLE KEYS */;
INSERT INTO `mantenedor_servicios` VALUES (1,'Arriendo de Equipos de Datos '),(5,'Servicio de Mantención de Red'),(4,'Servicio de IP Pública '),(3,'Servicio de Puertos Públicos '),(2,'Servicio de Internet '),(6,'Arriendo de equipos de Telefonía IP'),(7,'Otros Servicios');
/*!40000 ALTER TABLE `mantenedor_servicios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mantenedor_site`
--

DROP TABLE IF EXISTS `mantenedor_site`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mantenedor_site` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `telefono` varchar(100) CHARACTER SET latin1 NOT NULL,
  `personal_id` int(11) NOT NULL,
  `correo` varchar(100) CHARACTER SET latin1 NOT NULL,
  `kmz` longblob,
  `contacto` varchar(255) DEFAULT NULL,
  `dueno_cerro` varchar(255) DEFAULT NULL,
  `latitud_coordenada` varchar(255) DEFAULT NULL,
  `longitud_coordenada` varchar(255) DEFAULT NULL,
  `latitud_coordenada_site` varchar(255) DEFAULT NULL,
  `longitud_coordenada_site` varchar(255) DEFAULT NULL,
  `datos_proveedor_electrico` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mantenedor_site`
--

LOCK TABLES `mantenedor_site` WRITE;
/*!40000 ALTER TABLE `mantenedor_site` DISABLE KEYS */;
INSERT INTO `mantenedor_site` VALUES (12,'Estación Prueba Final','Oficina','652566600',108,'esalas@teledata.cl',NULL,'Esteban Salas','Katty','','','','',''),(13,'VO','Volcán Osorno SN','652566600',108,'esalas@teledata.cl',NULL,'Esteban Salas','','','','','',''),(14,'PUERTO VARAS','Los Urales','652566600',108,'esalas@teledata.cl',NULL,'Esteban Salas','Margarita Berrios','','','','',''),(15,'PETROHUE','PETROHUE SN','652566600',1,'esalas@teledata.cl',NULL,'Esteban Salas','','','','','','');
/*!40000 ALTER TABLE `mantenedor_site` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mantenedor_tipo_cliente`
--

DROP TABLE IF EXISTS `mantenedor_tipo_cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mantenedor_tipo_cliente` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mantenedor_tipo_cliente`
--

LOCK TABLES `mantenedor_tipo_cliente` WRITE;
/*!40000 ALTER TABLE `mantenedor_tipo_cliente` DISABLE KEYS */;
INSERT INTO `mantenedor_tipo_cliente` VALUES (1,'Boleta'),(2,'Factura'),(3,'Canje');
/*!40000 ALTER TABLE `mantenedor_tipo_cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mantenedor_tipo_contacto`
--

DROP TABLE IF EXISTS `mantenedor_tipo_contacto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mantenedor_tipo_contacto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mantenedor_tipo_contacto`
--

LOCK TABLES `mantenedor_tipo_contacto` WRITE;
/*!40000 ALTER TABLE `mantenedor_tipo_contacto` DISABLE KEYS */;
INSERT INTO `mantenedor_tipo_contacto` VALUES (1,'Técnico'),(2,'Facturación'),(3,'Otro');
/*!40000 ALTER TABLE `mantenedor_tipo_contacto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mantenedor_tipo_factura`
--

DROP TABLE IF EXISTS `mantenedor_tipo_factura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mantenedor_tipo_factura` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(10) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `tipo_facturacion` int(11) DEFAULT NULL,
  `tipo_documento` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mantenedor_tipo_factura`
--

LOCK TABLES `mantenedor_tipo_factura` WRITE;
/*!40000 ALTER TABLE `mantenedor_tipo_factura` DISABLE KEYS */;
INSERT INTO `mantenedor_tipo_factura` VALUES (11,'BSMI','Boleta Servicio Mensual Individual',1,1),(17,'FSAI','Factura Servicio Anual Internet',3,2),(13,'FSMI','Factura Servicio Mensual',1,2),(15,'FSMIOC','Factura Servicio Mensual Orden de Compra',1,2);
/*!40000 ALTER TABLE `mantenedor_tipo_factura` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mantenedor_tipo_facturacion`
--

DROP TABLE IF EXISTS `mantenedor_tipo_facturacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mantenedor_tipo_facturacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mantenedor_tipo_facturacion`
--

LOCK TABLES `mantenedor_tipo_facturacion` WRITE;
/*!40000 ALTER TABLE `mantenedor_tipo_facturacion` DISABLE KEYS */;
INSERT INTO `mantenedor_tipo_facturacion` VALUES (1,'Mensual'),(2,'Semestral'),(3,'Anual');
/*!40000 ALTER TABLE `mantenedor_tipo_facturacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mantenedor_tipo_pago`
--

DROP TABLE IF EXISTS `mantenedor_tipo_pago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mantenedor_tipo_pago` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mantenedor_tipo_pago`
--

LOCK TABLES `mantenedor_tipo_pago` WRITE;
/*!40000 ALTER TABLE `mantenedor_tipo_pago` DISABLE KEYS */;
INSERT INTO `mantenedor_tipo_pago` VALUES (1,'Transferencia'),(2,'Deposito Cheque'),(3,'Deposito Efectivo'),(4,'Transbank'),(5,'Cheque de a fecha'),(6,'Cheque al dia'),(7,'Pago portal'),(8,'Otro'),(9,'Convenio Pac');
/*!40000 ALTER TABLE `mantenedor_tipo_pago` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mantenedor_tipo_pago_bsale`
--

DROP TABLE IF EXISTS `mantenedor_tipo_pago_bsale`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mantenedor_tipo_pago_bsale` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `activo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mantenedor_tipo_pago_bsale`
--

LOCK TABLES `mantenedor_tipo_pago_bsale` WRITE;
/*!40000 ALTER TABLE `mantenedor_tipo_pago_bsale` DISABLE KEYS */;
INSERT INTO `mantenedor_tipo_pago_bsale` VALUES (1,'EFECTIVO',1),(2,'TARJETA CREDITO',0),(3,'NOTA CREDITO DEVOLUCION',0),(4,'CREDITO',0),(5,'CHEQUE',0),(6,'TARJETA DE DEBITO',0),(7,'ABONO DE CLIENTE',0),(8,'TRANSFERENCIA BANCARIA',0),(9,'GIFTCARD',0),(10,'WEBPAY',0),(11,'30 Dias',1),(12,'60 Dias',1),(13,'90 Dias',0),(14,'120 Dias',0),(15,'20 Dias',1);
/*!40000 ALTER TABLE `mantenedor_tipo_pago_bsale` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mantenedor_tipo_producto`
--

DROP TABLE IF EXISTS `mantenedor_tipo_producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mantenedor_tipo_producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mantenedor_tipo_producto`
--

LOCK TABLES `mantenedor_tipo_producto` WRITE;
/*!40000 ALTER TABLE `mantenedor_tipo_producto` DISABLE KEYS */;
/*!40000 ALTER TABLE `mantenedor_tipo_producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mantenedor_tipo_proveedores`
--

DROP TABLE IF EXISTS `mantenedor_tipo_proveedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mantenedor_tipo_proveedores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mantenedor_tipo_proveedores`
--

LOCK TABLES `mantenedor_tipo_proveedores` WRITE;
/*!40000 ALTER TABLE `mantenedor_tipo_proveedores` DISABLE KEYS */;
INSERT INTO `mantenedor_tipo_proveedores` VALUES (1,'FACTURA ELECTRONICA'),(2,'NOTA DE CREDITO ELECTRONICA'),(3,'NOTA DE DEBITO ELECTRONICA'),(4,'FACTURANO AFECTA O EXENTA ELECTRONICA');
/*!40000 ALTER TABLE `mantenedor_tipo_proveedores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mensualidad_direccion_ip_fija`
--

DROP TABLE IF EXISTS `mensualidad_direccion_ip_fija`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mensualidad_direccion_ip_fija` (
  `IdMensualidadDireccionIPFija` int(11) NOT NULL AUTO_INCREMENT,
  `DireccionIPFija` varchar(15) DEFAULT NULL,
  `Descripcion` varchar(100) DEFAULT NULL,
  `IdServicio` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdMensualidadDireccionIPFija`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mensualidad_direccion_ip_fija`
--

LOCK TABLES `mensualidad_direccion_ip_fija` WRITE;
/*!40000 ALTER TABLE `mensualidad_direccion_ip_fija` DISABLE KEYS */;
/*!40000 ALTER TABLE `mensualidad_direccion_ip_fija` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mensualidad_puertos_publicos`
--

DROP TABLE IF EXISTS `mensualidad_puertos_publicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mensualidad_puertos_publicos` (
  `IdMensualidadPuertosPublicos` int(11) NOT NULL AUTO_INCREMENT,
  `PuertoTCPUDP` varchar(100) DEFAULT NULL,
  `Descripcion` varchar(100) DEFAULT NULL,
  `IdServicio` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdMensualidadPuertosPublicos`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mensualidad_puertos_publicos`
--

LOCK TABLES `mensualidad_puertos_publicos` WRITE;
/*!40000 ALTER TABLE `mensualidad_puertos_publicos` DISABLE KEYS */;
/*!40000 ALTER TABLE `mensualidad_puertos_publicos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(15) NOT NULL,
  `descripcion` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `enlace` varchar(100) NOT NULL,
  `permisos` varchar(20) NOT NULL,
  `icono` varchar(50) NOT NULL,
  `indice` int(11) NOT NULL,
  `activo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_menu`)
) ENGINE=MyISAM AUTO_INCREMENT=1035 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (1,'Clientes','Clientes y Servicios ','#','1,2.3','fa fa-user',1,1),(2,'Tareas','Tareas','../tareas/Tarea.php','1,2,3','fa fa-sticky-note',2,1),(4,'com','Compras & Ingreso  ','#','1,2,3','fa fa-shopping-cart',5,1),(5,'Inventario','Inventario','#','1,2,3','fa fa-dropbox',6,1),(6,'Reportes','Reportes','#','1,2,3','fa fa-bar-chart',7,1),(7,'Configurac','Configuracion','#','1','fa fa-cog',8,1),(8,'Tickets','Tickets','#','1,2,3','fa fa-ticket',9,1),(9,'RadioPlan','Radio Planning','../radio/Radio.php','1,2,3','fa fa-map-marker',10,1),(3,'NotaVent','Nota de Venta','#','1,2,3','glyphicon glyphicon-usd',3,1),(10,'Logs','Logs','#','1','fa fa-exclamation-triangle',11,1),(11,'fac','Emisión de Documentos','#','1,2,3','fa fa-percent',4,1);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_roles`
--

DROP TABLE IF EXISTS `menu_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_menu` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `menu_submenu` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_roles`
--

LOCK TABLES `menu_roles` WRITE;
/*!40000 ALTER TABLE `menu_roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `menu_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nivel_privilegio`
--

DROP TABLE IF EXISTS `nivel_privilegio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nivel_privilegio` (
  `IdNivelPrivilegio` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(150) DEFAULT NULL,
  `Descripcion` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`IdNivelPrivilegio`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nivel_privilegio`
--

LOCK TABLES `nivel_privilegio` WRITE;
/*!40000 ALTER TABLE `nivel_privilegio` DISABLE KEYS */;
INSERT INTO `nivel_privilegio` VALUES (1,'Administrador','Descripcion de Administrador'),(2,'Soporte','Descripcion de Soporte'),(3,'Terreno','Descripcion de Terreno');
/*!40000 ALTER TABLE `nivel_privilegio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nota_venta`
--

DROP TABLE IF EXISTS `nota_venta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nota_venta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rut` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `numero_oc` varchar(40) NOT NULL,
  `fecha_oc` date DEFAULT NULL,
  `solicitado_por` varchar(200) NOT NULL,
  `estatus_facturacion` int(11) DEFAULT NULL,
  `factura_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nota_venta`
--

LOCK TABLES `nota_venta` WRITE;
/*!40000 ALTER TABLE `nota_venta` DISABLE KEYS */;
INSERT INTO `nota_venta` VALUES (30,6593446,'2018-08-14','','1969-01-31','108',1,2829),(31,5012355,'2018-08-14','','1969-01-31','108',1,2830),(32,8466934,'2018-08-22','','1969-01-31','108',1,2897),(34,17520287,'2018-08-24','','1969-01-31','105',1,2903),(35,6448076,'2018-08-27','','1969-01-31','108',1,3035),(44,6448076,'2018-09-10','','1969-01-31','108',1,2974),(45,76250727,'2018-09-10','','1969-01-31','113',0,NULL),(46,17296156,'2018-09-11','','1969-01-31','108',1,2984),(48,76245945,'2018-09-13','','1969-01-31','108',1,2980),(49,76521560,'2018-09-13','','1969-01-31','108',1,2982),(50,6593446,'2018-09-21','','1969-01-31','108',1,2979),(51,8466934,'2018-09-21','','1969-01-31','108',1,2981),(52,76243328,'2018-09-24','','1969-01-31','108',1,2983),(54,15250162,'2018-10-01','','1969-01-31','108',1,3032),(55,6375115,'2018-10-01','','1969-01-31','108',1,3033),(56,6417882,'2018-10-01','','1969-01-31','108',1,3034),(57,10420529,'2018-10-02','','1969-01-31','108',1,3040),(58,76460253,'2018-10-12','','1969-01-31','108',1,3045),(59,12713590,'2018-10-16','','1969-01-31','108',1,3055),(60,6740725,'2018-10-16','','1969-01-31','108',1,3059),(61,15561394,'2018-10-17','','1969-01-31','108',1,3064),(62,13825370,'2018-10-18','','1969-01-31','108',1,3066),(63,76911785,'2018-10-22','','2018-10-22','108',1,3068),(64,76911785,'2018-10-22','','1969-01-31','108',1,3069);
/*!40000 ALTER TABLE `nota_venta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nota_venta_detalle`
--

DROP TABLE IF EXISTS `nota_venta_detalle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nota_venta_detalle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nota_venta_id` int(11) NOT NULL,
  `concepto` varchar(200) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` double NOT NULL,
  `total` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nota_venta_detalle`
--

LOCK TABLES `nota_venta_detalle` WRITE;
/*!40000 ALTER TABLE `nota_venta_detalle` DISABLE KEYS */;
INSERT INTO `nota_venta_detalle` VALUES (47,21,'1',1,20000,23800),(50,23,'1',1,20000,23800),(51,23,'2',1,54410,64748),(52,24,'1',1,27205,32374),(53,24,'1',2,54410,129496),(54,25,'1',1,27205,32374),(55,25,'2',2,54410,129496),(57,27,'Prueba Boleta',1,1,1),(61,30,'UPS INTERACTIVA',1,54456,64803),(62,31,'VISITA TÉCNICA CONFIGURACIÓN DE ROUTER',1,27228,32401),(63,32,'VISITA TÉCNICA POR CÁMARA IP MAS INSTALACIÓN NVR',1,190792,227042),(64,32,'INSTALACIÓN Y HABILITACIÓN DE 5 CÁMARAS IP',1,597487,711010),(66,34,'Prueba Devolucion',1,27263,32443),(67,35,'Habilitación tercera Cabaña, 25 mts. de ducto, 45 mts. de cable, más materiales',1,297550,354085),(80,44,'Ducto plástico para cable de red desde Domicilio hasta cabaña',1,20760,24704),(81,44,'Cable de red 5e exterior con conectores blindados',1,33300,39627),(82,44,'Materiales(amarras, abrazaderas,fijaciones,sellos)',1,13200,15708),(83,44,'Router adicional como mayor desempeño y capacidad de manejo',1,65300,77707),(84,44,'Mano de Obra de trabajos',1,144000,171360),(85,45,'Access Point NSM2 Casa Cuidador',1,121849,145000),(86,46,'Instalación y habilitación enlace Internet',1,83193,99000),(88,48,'Habilitación Segundo Domicilio',1,163746,194858),(89,49,'Habilitación Servicio Internet',1,382074,454668),(90,49,'Red LAN, equipo emisor, equipo receptor, router WiFi',1,232003,276084),(91,50,'Visita Técnica, Cambio iluminador antena principal (1° junio)',1,40713,48448),(92,50,'Visita Técnica, cambio PoE y cable (04 julio)',1,27291,32476),(93,51,'Visita Técnica, Reconfiguración NVR (24 agosto)',1,27518,32746),(94,52,'Puente inalámbrico desde Oficina a nueva cabaña, más router WiFi',1,368429,438431),(96,54,'INSTALACIÓN Y HABILITACIÓN DE EQUIPOS DE DATOS',1,189076,225000),(97,55,'INSTALACION Y HABILITACION DE EQUIPOS DE DATOS',1,326857,388960),(98,56,'Costo de instalación / Habilitación de equipos de datos',1,323949,385499),(99,57,'Habilitación Internet',1,186975,222500),(100,58,'Habilitación Servicio Internet',1,218487,260000),(101,59,'Habilitación Servicio Internet',1,191596,227999),(102,60,'Habilitación e Instalación',1,189076,225000),(103,61,'habilitación Servicio de Internet',1,191596,227999),(104,62,'HABILITACION SERVICIO INTERNET',1,189075,224999),(105,63,'Red LAN, Equipo Base + Equipo Receptor',1,245619,292287),(106,63,'UPS en línea',1,354783,422192),(107,64,'Access Point WiFi (Pintura), Access Point WiFi (Cabos), Cable Cat5e, Materiales: Fijaciones, amarras',1,367160,436920);
/*!40000 ALTER TABLE `nota_venta_detalle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nota_venta_tmp`
--

DROP TABLE IF EXISTS `nota_venta_tmp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nota_venta_tmp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `concepto` varchar(200) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` double NOT NULL,
  `total` double NOT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=131 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nota_venta_tmp`
--

LOCK TABLES `nota_venta_tmp` WRITE;
/*!40000 ALTER TABLE `nota_venta_tmp` DISABLE KEYS */;
INSERT INTO `nota_venta_tmp` VALUES (77,'1',1,27224,32397,1),(127,'a',1,1,1,105);
/*!40000 ALTER TABLE `nota_venta_tmp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `origen_tickets`
--

DROP TABLE IF EXISTS `origen_tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `origen_tickets` (
  `IdOrigen` int(11) NOT NULL,
  `Nombre` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`IdOrigen`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `origen_tickets`
--

LOCK TABLES `origen_tickets` WRITE;
/*!40000 ALTER TABLE `origen_tickets` DISABLE KEYS */;
INSERT INTO `origen_tickets` VALUES (1,'Llamado Telefónico'),(2,'Correo Electrónico'),(3,'Presencial'),(4,'Pagina Web'),(5,'Interno'),(6,'Carta'),(7,'Otros');
/*!40000 ALTER TABLE `origen_tickets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personaempresa`
--

DROP TABLE IF EXISTS `personaempresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personaempresa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rut` int(11) NOT NULL,
  `dv` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `nombre` varchar(300) CHARACTER SET latin1 DEFAULT NULL,
  `giro` varchar(100) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `contacto` varchar(100) DEFAULT NULL,
  `comentario` varchar(100) DEFAULT NULL,
  `telefono` varchar(11) DEFAULT NULL,
  `region` varchar(100) DEFAULT NULL,
  `ciudad` varchar(100) DEFAULT NULL,
  `alias` varchar(100) DEFAULT NULL,
  `tipo_cliente` varchar(100) DEFAULT NULL,
  `id_usuario_sistema` int(11) DEFAULT NULL,
  `clase_cliente` varchar(255) DEFAULT NULL,
  `cliente_id_bsale` int(11) DEFAULT NULL,
  `tipo_pago_bsale_id` int(11) DEFAULT NULL,
  `posee_pac` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `rut` (`rut`)
) ENGINE=MyISAM AUTO_INCREMENT=10010 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personaempresa`
--

LOCK TABLES `personaempresa` WRITE;
/*!40000 ALTER TABLE `personaempresa` DISABLE KEYS */;
INSERT INTO `personaempresa` VALUES (1,6593446,'9','FRANCISCA ALEMPARTE','SIN GIRO, PERSONA NATURAL','LOTEO NORTE 14C','TITIALEMPARTE@GMAIL.COM','FRANCISCA ALEMPARTE','','979579900','13','313','','1',109,'1',13,15,0),(2,14638794,'2','VERENA MENTZINGEN','SIN GIRO, PERSONA NATURAL','FUNDO CENTINELA.','V.MENTZINGEN@GMAIL.COM','VERENA MENTZINGEN','','996415372','13','315','','1',109,'1',11,15,0),(3,12761640,'K','RICHARD GALLEGOS NAVARRO','SIN GIRO, PERSONA NATURAL','PARCELACION LOS ULMOS.  PARCELA 43','OFICINA.AGUILERA@GMAIL.COM','RICHARD GALLEGOS','','944146691','13','313','','1',109,'1',15,15,0),(4,5012355,'3','FERNANDO VILCHES SARABIA','SIN GIRO, PERSONA NATURAL','RUTA 225.  KM 20,5','FEVISA.VAMPIRO@YAHOO.CL','FERNANDO VILCHES','','994795886','13','313','','1',109,'1',16,15,0),(5,78796670,'5','INVERSIONES BELLAVISTA LTDA.','INVERSIONES Y ARQUITECTURA','AV. MANQUEHUE NORTE 151.  OF. 508.  LAS CONDES','ASANDOVALE@ASANDOVAL.CL','ANDRES SANDOVAL','','990304242','7','127','','2',109,'1',17,15,0),(6,86247400,'7','EMPRESAS AQUACHILE S.A.','CULTIVOS MARINOS, PROCESADORA DE PRODUCTOS DEL MAR','SECTOR CARDONAL.  LOTE B. S/N','JAVIER.MUNOZ@AQUACHILE.COM','JAVIER MUÑOZ','','652433600','13','312','','2',109,'3',10,15,0),(7,13825370,'8','JAVIER ALEJANDRO JOBIS VARGAS','TRANSPORTE MARÍTIMO','CALLE 1 S/N','AJOBIS@HOTMAIL.COM','JAVIER JOBIS','DIRECCIóN DE ANTENA: SECTOR EL COBRE S/N.  HORNOPIRéN','9987696084','13','323','','2',109,'1',18,15,0),(8,12017636,'6','RODRIGO VENEGAS VALENZUELA','MAQUINARIA ENTRETENIMIENTO','ANTONIO VARAS 1016','RODRIGO.RV.ROMA@GMAIL.COM','RODRIGO VENEGAS','','9942073892','13','312','','2',109,'1',19,11,0),(9,17296156,'8','LAURA VáSQUEZ FRITZ','SIN GIRO, PERSONA NATURAL','LOS URALES S/N','LAUVASQUEZFRITZ@GMAIL.COM','LAURA VáSQUEZ','','955332877','13','313','','1',109,'1',20,15,0),(10,17520287,'0','CYRO FARIñA ROMáN','SIN GIRO, PERSONA NATURAL','CONTAO S/N','CYRO@LIVE.CL','CYRO FARIñA','','974885541','13','323','','1',109,'1',21,15,0),(11,76830018,'6','CONSORCIO INCON - V y E CONSULTORES PICHICOLO LTDA.','ACT. DE ASESORAMIENTO EMPRESARIAL','AV. APOQUINDO 5555.  OFICINA 608','LUIS.GONZALEZ@INCON.CL','LUIS GONZáLEZ GALLEGOS','','223705366','7','109','INCON','2',109,'1',22,15,0),(12,76127546,'1','INMOBILIARIA MILLANTú','COMPRA VENTA Y ALQUILER DE INMOBILIARIOS PROPIOS Y ARRIENDOS','ESMERALDA 1807.  OFICINA 302A','PATRICIA.GONZALEZ@DLYC.CL','PATRICIA GONZáLEZ','','995367467','3','12','','2',109,'1',23,15,0),(13,15250162,'5','ROGELIO ARIEL SOTO VEGA','SIN GIRO, PERSONA NATURAL','CALLE RíO VODUDAHUE S/N','RSOTOVEGA90@GMAIL.COM','ROGELIO SOTO','','978837337','13','323','','1',109,'1',24,15,0),(14,8466934,'2','RODRIGO CHICHARRO','SIN GIRO, PERSONA NATURAL','PARCELA 86 VOLCANES DEL LAGO, PUERTO VARAS','RCHICHARRO@MANQUEHUE.NET','RODRIGO CHICHARRO','','986161230','13','313','','1',109,'1',25,1,0),(15,76245945,'0','IDANMAPU SA','INMOBILIARIA','EL CIPRéS 2404','MTAMPE@IDANMAPU.COM','MARTíN TAMPE','','991823126','13','313','','2',108,'2',26,11,0),(16,6448076,'6','JOANNE DUNCAN CARRASCO','SIN GIRO, PERSONA NATURAL','KM. 40,3.  LAS MARGARITAS, PARCELA 8','JOANNEDUNCAN@GMAIL.COM','JOANNE DUNCAN','','999971334','13','313','','1',108,'1',27,15,0),(17,76608219,'K','LA PICA DE LA ABEJA SPA','APICULTURA','SAN PEDRO 519.  LOCAL 4','APISU@YAHOO.COM','HUGO MORAGA','','998731582','13','313','','2',108,'1',28,15,0),(9999,26339939,'0','PRUEBA SISTEMA NO BORRAR','SIN GIRO, PERSONA NATURAL','*','bfsraptor@gmail.com','*','*','983764505','7','118','*','2',105,'1',29,15,0),(18,6375115,'4','MARíA IRENE EGUIGUREN LARRAíN','SIN GIRO, PERSONA NATURAL','BURGOS 88. DPTO 17','IRENEEGUIGUREN@GMAIL.COM','MARíA IRENE EGUIGUREN LARRAíN','','998281209','7','109','','1',108,'1',30,15,0),(19,76250727,'7','AGRíCOLA Y FORESTAL EL MAITéN LTDA.','AGRICOLA','JUAN ANTONIO COLOMA 202.','PILAR_GUZ@HOTMAIL.COM','MARíA DEL PILAR GUZMáN','CONTACTO DEL FUNDO: JOSé SOTO: 974033563','998210504','10','208','','2',108,'1',31,15,0),(20,6417882,'2','RAMóN LOLAS MORALES','SIN GIRO, PERSONA NATURAL','CERRO BLANCO 2131.','RLOLAS@PIMASA.COM','RAMóN LOLAS','','998264189','7','110','','1',108,'1',32,15,0),(21,76521560,'9','SERVICIOS INTEGRALES DEL SUR S.A.','SERVICIOS','RUTA 225.  KM. 40','SIS.PTOVARAS@GMAIL.COM','SEBASTIáN RAIMANN','','982342621','13','313','','2',108,'1',33,15,0),(22,15514913,'2','ANTONIO KURTE GóMEZ','SIN GIRO, PERSONA NATURAL','CAMINO NUEVA BRAUNAU.  KM. 3.  PARCELA 12','TONOKURTE@GMAIL.COM','ANTONIO KURTE','','998843849','13','312','','1',108,'1',34,15,0),(23,765666,'1','ALVARO POBLETE SMITH','SIN GIRO, PERSONA NATURAL','PARCELACIóN LLANQUIHUE','APOBLETE@CAMANCHACA.CL','ÁLVARO POBLETE','GERENTE GENERAL CAMANCHACA','9 9444 2214','13','309','','1',108,'3',35,15,0),(24,76243328,'1','AGRíCOLA Y COMERCIAL NOMEHUE LTDA.','EXPLOTACIóN MIXTA','AVENIDA DEL VALLE NORTE 787.  OF 404.','gcisternas@nomehue.cl','GERMáN CISTERNAS OSSA','FONO PERSONAL DON GERMáN: +56 9 8769 7573','227547500','7','102','','2',108,'1',36,15,0),(25,10420529,'1','ANTONIO DOMINGO CELEDóN SANHUEZA','HOTELES Y RESTAURANTES','INGENIERO MILITAR S/N.  HORNOPIRéN','INFO@ENTREMONTANAS.CL','CAROLAINE CELEDóN','','978489705','13','323','HOTEL ENTRE MONTAñAS','2',108,'1',37,15,0),(26,12713590,'8','JUAN GUILLERMO RODRíGUEZ SANHUEZA','SIN GIRO, PERSONA NATURAL','PARCELACIóN DON RAFAEL. PARCELA 30.  PUERTO MONTT','JRODRIGUEZ@CONSTRUCTORAOCTAY.CL','JUAN RODRíGUEZ','','998838233','13','312','','1',108,'1',39,15,0),(10000,10858431,'9','JOSé LUIS ACEVAL SILVA','SIN GIRO, PERSONA NATURAL','CHIN CHIN BAJO S/N, PARCELACIòN DON RAFAEL, PARCELA Nª 25','JLACEVALS@GMAIL.COM','JOSé LUIS ACEVAL SILVA','','996440778','13','312','','1',108,'1',NULL,15,0),(10001,11712371,'5','PATRICIO NANNIG GOTSCHLICH','AGRICOLA','FUNDO VILLA ALEGRE S/N.  FRUTILLAR','PNANNIGG@GMAIL.COM','PATRICIO NANNIG','','996450602','13','308','','2',108,'1',NULL,15,0),(10002,6740725,'3','JAIME NEUMANN KLENNER','ARRIENDO DE INMUEBLES','PORTAL DEL LAGO.  PARCELA 12.  LLANQUIHUE','JAIME.NEUMANN@GMAIL.COM','JIME NEUMANN KLENNER','','998886503','13','309','','2',108,'1',NULL,15,0),(10003,76460253,'6','INVERSIONES Y ASESORíAS AQUELARRE SPA','INVERSIONES Y ASESORIAS','CAMINO CHINQUIHUE KM. 10.  PARCELA 6.  PUERTO MONTT','IVANKIPREOS@GMAIL.COM','IVáN KIPREOS','','994192019','13','312','','2',108,'1',NULL,15,0),(10004,76541036,'3','LA CACHIMBA SPA','HOTELERIA','AVENIDA ANDRéS BELLO 2687','XIMENAGOURMET@GMAIL.COM','','','','7','127','','2',110,'1',NULL,15,0),(10005,15561394,'7','MIGUEL RODRIGO LEIVA GUZMáN','EMPRESARIO','PARCELA DON RAFAEL NúMERO 48.','MIGUEL.ASESORIA@GMAIL.COM','MIGUEL LEIVA','','974215207','13','312','','2',108,'1',NULL,15,0),(10006,76911785,'7','TALLERES DEL SUR SPA','TALLER DE REDES','TRAPéN.  LOTE 14.  PANITAO','GONZALO.ROJAS@ERSIL.CL','GONZALO ROJAS','','954161342','13','312','','2',108,'1',NULL,15,0),(10007,76466000,'5','SOCIEDAD AGRíCOLA OASIS DE LAMPA LTDA,','CULTIVOS HIDROPóNICOS E INVERNADEROS','PARCELA 2B. NUEVO PORVENIR','FINAZAS@OASISDELAMPA.CL','RICARDO ROTH','','987769457','7','83','RICARDO ROTH','2',108,'1',NULL,15,0),(10008,8564327,'4','ALFREDO ARNOLDO ROTH REED','APICULTURA Y HORTALIZAS','PEULLA S/N.  LAGO TODOS LOS SANTOS','Alfredo-roth@hotmail.com','ALFREDO ROTH','','973334092','13','313','','2',108,'1',NULL,15,0),(10009,9580565,'5','TORBEN PETERSEN ETTRUP','SIN GIRO, PERSONA NATURAL','CASILLA 975','TORBEN.E.PETERSEN@GMAIL.COM','TORBEN PETERSEN','','995350280','13','313','','1',108,'2',NULL,15,0);
/*!40000 ALTER TABLE `personaempresa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `provincias`
--

DROP TABLE IF EXISTS `provincias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `provincias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(64) NOT NULL,
  `region_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `provincias`
--

LOCK TABLES `provincias` WRITE;
/*!40000 ALTER TABLE `provincias` DISABLE KEYS */;
INSERT INTO `provincias` VALUES (1,'Arica',1),(2,'Parinacota',1),(3,'Iquique',2),(4,'El Tamarugal',2),(5,'Antofagasta',3),(6,'El Loa',3),(7,'Tocopilla',3),(8,'Chañaral',4),(9,'Copiapó',4),(10,'Huasco',4),(11,'Choapa',5),(12,'Elqui',5),(13,'Limarí',5),(14,'Isla de Pascua',6),(15,'Los Andes',6),(16,'Petorca',6),(17,'Quillota',6),(18,'San Antonio',6),(19,'San Felipe de Aconcagua',6),(20,'Valparaiso',6),(21,'Chacabuco',7),(22,'Cordillera',7),(23,'Maipo',7),(24,'Melipilla',7),(25,'Santiago',7),(26,'Talagante',7),(27,'Cachapoal',8),(28,'Cardenal Caro',8),(29,'Colchagua',8),(30,'Cauquenes',9),(31,'Curicó',9),(32,'Linares',9),(33,'Talca',9),(34,'Arauco',10),(35,'Bio Bío',10),(36,'Concepción',10),(37,'Ñuble',10),(38,'Cautín',11),(39,'Malleco',11),(40,'Valdivia',12),(41,'Ranco',12),(42,'Chiloé',13),(43,'Llanquihue',13),(44,'Osorno',13),(45,'Palena',13),(46,'Aisén',14),(47,'Capitán Prat',14),(48,'Coihaique',14),(49,'General Carrera',14),(50,'Antártica Chilena',15),(51,'Magallanes',15),(52,'Tierra del Fuego',15),(53,'Última Esperanza',15);
/*!40000 ALTER TABLE `provincias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `radio_ingresos`
--

DROP TABLE IF EXISTS `radio_ingresos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `radio_ingresos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estacion_id` int(11) NOT NULL,
  `funcion` varchar(100) NOT NULL,
  `alarma_activada` varchar(100) NOT NULL,
  `direccion_ip` varchar(100) NOT NULL,
  `puerto_acceso` varchar(100) NOT NULL,
  `ancho_canal` varchar(100) NOT NULL,
  `apid` varchar(100) NOT NULL,
  `baseid` varchar(100) NOT NULL,
  `frecuencia` varchar(100) NOT NULL,
  `tx_power` varchar(100) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `ssid` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `radio_ingresos`
--

LOCK TABLES `radio_ingresos` WRITE;
/*!40000 ALTER TABLE `radio_ingresos` DISABLE KEYS */;
/*!40000 ALTER TABLE `radio_ingresos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `regiones`
--

DROP TABLE IF EXISTS `regiones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `regiones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(64) NOT NULL,
  `region_ordinal` varchar(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `regiones`
--

LOCK TABLES `regiones` WRITE;
/*!40000 ALTER TABLE `regiones` DISABLE KEYS */;
INSERT INTO `regiones` VALUES (1,'Arica y Parinacota','XV'),(2,'Tarapacá','I'),(3,'Antofagasta','II'),(4,'Atacama','III'),(5,'Coquimbo','IV'),(6,'Valparaiso','V'),(7,'Metropolitana de Santiago','RM'),(8,'Libertador General Bernardo O\'Higgins','VI'),(9,'Maule','VII'),(10,'Biobío','VIII'),(11,'La Araucanía','IX'),(12,'Los Ríos','XIV'),(13,'Los Lagos','X'),(14,'Aisén del General Carlos Ibáñez del Campo','XI'),(15,'Magallanes y de la Antártica Chilena','XII');
/*!40000 ALTER TABLE `regiones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `nivel` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Administrador',1),(2,'Terreno',2),(3,'Soporte',3);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servicio_internet`
--

DROP TABLE IF EXISTS `servicio_internet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servicio_internet` (
  `IdServInternet` int(11) NOT NULL AUTO_INCREMENT,
  `Velocidad` varchar(150) DEFAULT NULL,
  `Plan` varchar(150) DEFAULT NULL,
  `IdOrigen` int(11) NOT NULL,
  `IdProducto` int(11) NOT NULL,
  `TipoDestino` varchar(150) NOT NULL,
  `IdServicio` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdServInternet`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicio_internet`
--

LOCK TABLES `servicio_internet` WRITE;
/*!40000 ALTER TABLE `servicio_internet` DISABLE KEYS */;
INSERT INTO `servicio_internet` VALUES (1,'2','1',0,0,'2',663);
/*!40000 ALTER TABLE `servicio_internet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servicios`
--

DROP TABLE IF EXISTS `servicios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servicios` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Rut` int(11) NOT NULL,
  `Grupo` int(11) DEFAULT NULL,
  `TipoFactura` varchar(150) DEFAULT NULL,
  `Valor` double(11,2) DEFAULT NULL,
  `Descuento` double(11,2) DEFAULT NULL,
  `IdServicio` int(11) NOT NULL,
  `Codigo` varchar(150) CHARACTER SET latin1 NOT NULL,
  `Descripcion` varchar(500) NOT NULL,
  `EstatusInstalacion` int(11) NOT NULL,
  `FechaInstalacion` date DEFAULT NULL,
  `InstaladoPor` varchar(200) DEFAULT NULL,
  `Comentario` varchar(200) DEFAULT NULL,
  `UsuarioPppoe` varchar(200) DEFAULT NULL,
  `Conexion` varchar(255) DEFAULT NULL,
  `IdUsuarioSession` int(11) NOT NULL,
  `Direccion` varchar(200) NOT NULL,
  `Latitud` varchar(200) NOT NULL,
  `Longitud` varchar(200) NOT NULL,
  `Referencia` varchar(200) NOT NULL,
  `Contacto` varchar(200) NOT NULL,
  `Fono` varchar(200) NOT NULL,
  `FechaComprometidaInstalacion` date NOT NULL,
  `PosibleEstacion` varchar(200) NOT NULL,
  `Equipamiento` varchar(200) NOT NULL,
  `SenalTeorica` varchar(200) NOT NULL,
  `IdUsuarioAsignado` int(11) NOT NULL,
  `SenalFinal` varchar(200) NOT NULL,
  `EstacionFinal` varchar(200) NOT NULL,
  `EstatusFacturacion` int(11) NOT NULL,
  `CostoInstalacion` double(11,2) NOT NULL,
  `FacturarSinInstalacion` int(11) NOT NULL,
  `CostoInstalacionDescuento` double(11,2) NOT NULL,
  `UsuarioPppoeTeorico` varchar(255) NOT NULL,
  `FechaFacturacion` date DEFAULT NULL,
  `FechaInicioDesactivacion` date DEFAULT NULL,
  `FechaFinalDesactivacion` date DEFAULT NULL,
  `FechaUltimoCobro` date DEFAULT NULL,
  `NombreServicioExtra` varchar(255) DEFAULT NULL,
  `EstatusServicio` int(11) DEFAULT '1',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=722 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicios`
--

LOCK TABLES `servicios` WRITE;
/*!40000 ALTER TABLE `servicios` DISABLE KEYS */;
INSERT INTO `servicios` VALUES (664,6593446,1,'11',1.00,0.00,1,'6593446-9BSMI01','',1,'2018-07-01','108','','FALEMPARTE','CONEXION N°1',109,'','-41.300083','-72.985895','','FRANCISCA ALEMPARTE','979579900','2018-07-01','PUERTO VARAS','NSM5+HAP','56',109,'56','14',0,0.00,0,0.00,'FALEMPARTE','2018-08-14',NULL,NULL,'2018-10-01',NULL,1),(665,6593446,1,'11',1.00,0.00,1,'6593446-9BSMI02','',1,'2018-07-01','null','','ALEMPARTE','Conexion N° 2',109,'INTERIOR LAGO TODOS LOS SANTOS','-41.3214705','-73.0138898','','FRANCISCA ALEMPARTE','979579900','2018-07-01','PETROHUE','FORCE200+HAP','58',109,'58','15',0,0.00,0,0.00,'ALEMPARTE','2018-08-14',NULL,NULL,'2018-10-01',NULL,1),(666,14638794,1,'11',1.00,0.00,1,'14638794-2BSMI01','',1,'2018-07-01','null','','MENTZINGEN','',109,'','-41.3214705','-73.0138898','','VERENA MENTZINGEN','96415372','2018-07-01','VO','EPMP1000+34+HAP','66',109,'66','13',0,0.00,0,0.00,'MENTZINGEN','2018-08-14',NULL,NULL,'2018-10-01',NULL,1),(667,12761640,1,'11',4.50,0.00,1,'12761640-KBSMI01','',1,'2018-07-01','null','','RGALLEGOS','',109,'','-41.3214705','-73.0138898','','RICHARD GALLEGOS','944146691','2018-07-01','VO','EPMP1000+HAP','',109,'56','13',0,0.00,0,0.00,'RGALLEGOS','2018-08-14',NULL,NULL,'2018-10-01',NULL,1),(668,12761640,1,'11',0.50,0.00,6,'12761640-KBSMI02','CARGO FIJO TELEFONIA',1,'2018-07-01','null','','RGALLEGOSTEL','',109,'','-41.3214705','-73.0138898','','','','1969-01-31','','','',109,'1','13',0,0.00,0,0.00,'','2018-08-14',NULL,NULL,'2018-10-01',NULL,1),(669,5012355,1,'11',1.00,0.00,1,'5012355-3BSMI01','',1,'2018-07-01','108','','FVILCHEZ','',109,'','-41.3214705','-73.0138898','','FERNANDO VILCHES','994795886','2018-07-01','VO','NANOBRIDGE+951','72',109,'72','13',0,0.00,0,0.00,'FVILCHEZ','2018-08-14',NULL,NULL,'2018-10-01',NULL,1),(670,78796670,1,'13',1.50,0.00,1,'78796670-5FSMI01','',1,'2018-07-01','108','','ASANDOVAL','',109,'','-41.251895','-72.780917','','ANDRES SANDOVAL','990304242','2018-07-01','VO','PBE400+HSP','67',110,'67','12',0,0.00,0,0.00,'ASANDOVAL','2018-08-14',NULL,NULL,'2018-10-01',NULL,1),(671,86247400,4,'13',12.00,0.00,1,'86247400-7FSMI01','',1,'2018-07-01','108','','aquachile.paildad','CENTRO PAILDAD',109,'','-41.3214705','-73.0138898','','JAVIER MUÑOZ','652433600','2018-07-01','TRANQUI','FORCE200+951','56',110,'56','12',0,0.00,0,0.00,'AQUACHILE.PAILDAD','2018-08-14',NULL,NULL,'2018-10-01',NULL,1),(672,86247400,4,'13',12.00,0.00,1,'86247400-7FSMI02','',1,'2018-07-01','108','','aquachile.morrochilco','CENTRO MORRO CHILCO',109,'','-41.3214705','-73.0138898','','JAVIER MUÑOZ','652433600','2018-07-01','','FORCE200+951','74',110,'74','12',0,0.00,0,0.00,'AQUACHILE.MORROCHILCO','2018-08-14',NULL,NULL,'2018-10-01',NULL,1),(673,86247400,4,'13',12.00,0.00,1,'86247400-7FSMI03','',1,'2018-07-01','108','','aquachile.puntapaula','CENTRO PUNTA PAULA',109,'','-41.3214705','-73.0138898','','JAVIER MUÑOZ','652433600','2018-07-01','QUELLON','FORCE200+951','64',110,'64','12',0,0.00,0,0.00,'AQUACHILE.PUNTAPAULA','2018-08-14',NULL,NULL,'2018-10-01',NULL,1),(674,86247400,4,'13',12.00,0.00,1,'86247400-7FSMI04','',1,'2018-07-01','108','','aquachile.lillie1','CENTRO LILLE 1',109,'','-41.3214705','-73.0138898','','JAVIER MUÑOZ','652433600','2018-07-01','QUELLON','FORCE200+951','64',110,'64','12',0,0.00,0,0.00,'AQUACHILE.LILLE1','2018-08-14',NULL,NULL,'2018-10-01',NULL,1),(675,86247400,4,'13',12.00,0.00,1,'86247400-7FSMI05','',1,'2018-07-01','108','','sinppoeaun','CENTRO LILLIE 2',110,'','-41.32752142834767','-72.95188249199373','','','','1969-01-31','','','',110,'60','12',0,0.00,0,0.00,'','2018-08-14',NULL,NULL,'2018-10-01',NULL,1),(676,86247400,4,'13',12.00,0.00,1,'86247400-7FSMI06','',1,'2018-07-01','108','','sindato','CENTRO YELCHO',110,'','-41.3214705','-73.0138898','','','','1969-01-31','','','',110,'60','12',0,0.00,0,0.00,'','2018-08-14',NULL,NULL,'2018-10-01',NULL,1),(677,86247400,4,'13',12.00,0.00,1,'86247400-7FSMI07','',1,'2018-07-01','108','','sinpppoe','CENTRO PUNTA PELU',110,'','-41.3214705','-73.0138898','','','','1969-01-31','','','',110,'60','12',0,0.00,0,0.00,'','2018-08-14',NULL,NULL,'2018-10-01',NULL,1),(679,86247400,4,'13',12.00,0.00,1,'86247400-7FSMI08','',1,'2018-07-01','null','','sinppppoe','CENTRO QUILQUE SUR',110,'','-41.3214705','-73.0138898','','','','1969-01-31','','','',110,'60','12',0,0.00,0,0.00,'','2018-08-14',NULL,NULL,'2018-10-01',NULL,1),(680,86247400,4,'13',12.00,0.00,1,'86247400-7FSMI09','',1,'2018-07-01','null','','pppeoe','CENTRO ABTAO',110,'','-41.3214705','-73.0138898','','','','1969-01-31','','','',110,'60','12',0,0.00,0,0.00,'','2018-08-14',NULL,NULL,'2018-10-01',NULL,1),(681,86247400,4,'13',12.00,0.00,1,'86247400-7FSMI10','',1,'2018-07-01','null','','pppoe','CENTRO HUAPI',110,'','-41.3214705','-73.0138898','','','','1969-01-31','','','',110,'60','12',0,0.00,0,0.00,'','2018-08-14',NULL,NULL,'2018-10-01',NULL,1),(682,13825370,1,'13',1.00,0.00,1,'13825370-8FSMI01','',0,'2018-08-21','','','','',109,'','-41.3214705','-73.0138898','','Javier Jobis','9987696084','1969-01-31','llancahué','force200+hap','',0,'','',0,0.00,0,0.00,'jjobis','2018-08-21',NULL,NULL,'2018-10-01',NULL,1),(683,12017636,1,'13',1.00,0.00,1,'12017636-6FSMI01','',3,'2018-08-21','','','','',109,'Valle Polincay Km.11','-41.43285516862555','-72.75250316708076','','Rocío Poblete','9942073892','2018-08-01','Polincay','NSM5+Hap','',115,'','',0,3.64,0,0.00,'rvenegas','2018-08-21',NULL,NULL,'2018-10-01',NULL,1),(684,17296156,1,'11',1.00,0.00,1,'17296156-8BSMI01','',0,'2018-08-21','','','','',109,'Los Urales s/n','-41.31073697872628','-73.00105811207277','','Laura Vásquez','955332877','2018-08-01','Puerto Varas','LOCOM5+Hap','',0,'','',0,3.64,0,0.00,'lvasquez','2018-08-21',NULL,NULL,'2018-10-01',NULL,1),(685,17520287,1,'11',1.00,0.00,1,'17520287-0BSMI01','Ex conexión Francisco Cortés',0,'2018-08-21','','','','',109,'Contao s/n','-41.3214705','-73.0138898','','Cyro Fariña','974885541','2018-08-16','Contao','Loco M5+TP Link','',0,'','',0,1.00,0,0.00,'cfarina','2018-08-21',NULL,NULL,'2018-10-01',NULL,1),(686,76830018,1,'13',2.00,0.00,1,'76830018-6FSMI01','',1,'2018-06-28','115','Instalado por Camilo Uribe hacia Llancahué','cincon','',109,'Ingenieros Militares.  Pasaje Las Rosas s/n.  Sector Rampa.  Hornopirén','-41.97126649181245','-72.47389138786775','','Luis González','2237005366','1969-01-31','Lancahué','Force200+Hap','',108,'74','12',1,8.00,0,0.00,'incon','2018-08-24',NULL,NULL,'2018-10-01',NULL,1),(687,76127546,1,'13',2.00,0.00,1,'76127546-1FSMI01','',1,'2018-06-13','null','','ginocar','',109,'Sector Los Riscos','-41.3214705','-73.0138898','','Gino Carpanetti / Patricia González','995367467','2018-07-01','VO','Force200+Hap','',108,'72','13',0,0.00,0,0.00,'ginocar','2018-08-21',NULL,NULL,'2018-10-01',NULL,1),(688,15250162,1,'11',1.00,0.00,1,'15250162-5BSMI01','',0,'2018-08-21','','','','',109,'Calle Río Vodudahue s/n','-41.3214705','-73.0138898','','Rogelio Soto','9788373337','2018-08-08','Llancahué','Force200+Hap','',0,'','',0,7.00,0,0.00,'rsoto','2018-08-21',NULL,NULL,'2018-10-01',NULL,1),(689,76245945,1,'13',2.00,0.00,1,'76245945-0FSMI01','',0,'2018-08-24','','','','',108,'','-41.28296022353785','-72.7839923009156','','Martín Tampe','991823126','2018-08-23','Tampe','LocoM5+hap','',0,'','',0,10.00,0,40.00,'modelotampe@teledata','2018-08-24',NULL,NULL,'2018-10-01',NULL,1),(690,6448076,1,'11',2.00,0.00,1,'6448076-6BSMI01','',0,'2018-08-24','','','','',108,'Km. 40,3.  Las Margaritas, Parcela 8','-41.22796834524552','-72.5639331444977','','Joanne Duncan','+56 999971334','2018-08-02','VO','Force200+hap','',0,'','',0,0.00,0,0.00,'jduncan','2018-08-24',NULL,NULL,'2018-10-01',NULL,1),(691,76608219,1,'13',1.00,0.00,1,'76608219-KFSMI01','',0,'2018-08-27','','','','',108,'','-41.21558112573194','-72.7034777507065','','Hugo Moraga','998731582','1969-01-31','','PBE400+Hap','-67',0,'','',0,0.00,0,0.00,'hmoraga','2018-08-27',NULL,NULL,'2018-10-01',NULL,1),(703,15514913,1,'11',1.00,0.00,1,'15514913-2BSMI01','',1,'2018-09-12','115','CAMBIAR ESTACION','AKURTE','',108,'','-41.32812568460731','-73.03187132923586','','Antonio Kurte','998843849','2018-09-11','Las Lomas','Force 180 + Hap-Lite','-50',110,'-50','12',1,6.76,1,0.00,'akurte','2018-09-28',NULL,NULL,'2018-10-01',NULL,1),(700,6375115,1,'11',1.00,0.00,1,'6375115-4BSMI01','',0,'2018-09-04','','','','',105,'','-41.22741964538765','-73.01603556725763','','María Irene Eguiguren','998281209','2018-09-30','VO','epmp1000+dish30+hap','-65',0,'','',0,11.97,0,0.00,'irenepa','2018-09-04',NULL,NULL,'2018-10-01',NULL,1),(701,6417882,1,'11',1.00,0.00,1,'6417882-2BSMI01','',0,'2018-09-10','','','','',108,'','-41.3214705','-73.0138898','','Ramón Lolas','998264189','2018-09-20','VO','Force 200 + Haplite','',0,'','',0,11.95,0,0.00,'rlolas','2018-09-10',NULL,NULL,'2018-10-01',NULL,1),(702,76250727,1,'13',1.00,0.00,1,'76250727-7FSMI01','',3,'2018-09-10','','','','',108,'','-40.950410602846866','-72.82494426815492','','Pilar Guzmán / Juan Soto','998210504 / 974033563','2018-09-10','VO','RD30 + 951','',110,'','',0,10.76,0,0.00,'pguzman','2018-09-10',NULL,NULL,'2018-10-01',NULL,1),(704,76521560,1,'13',1.00,0.00,1,'76521560-9FSMI01','Habilitación Servicio Internet',3,'2018-09-12','','','','',108,'','-41.28400831350684','-73.15608979313356','','Sebastián Raiman','982342803','2018-09-12','VO','Dish30 + EPMP1000 + 951','65',110,'','',1,13.98,1,0.00,'sraimann','2018-10-26',NULL,NULL,'2018-10-01',NULL,1),(705,765666,1,'11',1.00,0.00,1,'765666-1BSMI01','',0,'2018-09-14','','','','',108,'Parcelación LLanquihue','-41.282734478879625','-73.01774145214546','','Alvaro Poblete','994442214','2018-09-08','Puerto Varas','Force200+951','51',0,'','',0,0.00,0,0.00,'apoblete','2018-09-14',NULL,NULL,'2018-10-01',NULL,1),(706,76243328,1,'13',2.50,0.00,1,'76243328-1FSMI01','',0,'2018-09-24','','','','',108,'','-40.91654656871212','-72.95711279957277','','Germán Cisternas','+56 987697573','2018-09-01','VO','epmp1000+Dish30+RB951','-65',0,'','',0,0.00,0,0.00,'anomehue','2018-09-24',NULL,NULL,'2018-10-01',NULL,1),(707,10420529,1,'13',1.00,0.00,1,'10420529-1FSMI01','',1,'2018-10-02','115','Habilitación Servicio Internet','aceledon','',108,'Ingeniero Militar s/n','-41.97028535283496','-72.48362780659181','','Carolaine Celedón','978489705','2018-09-28','Llancahué','force200+haplite','55',110,'55','12',1,6.83,1,0.00,'aceledon','2018-10-26',NULL,NULL,'2018-10-01',NULL,1),(708,15434708,1000,'11',1.00,0.00,1,'15434708-9BSMI01','*',3,'2018-09-25','','','','',105,'','-41.3214705','-73.0138898','','','','1969-01-31','','','',105,'','',0,0.00,0,0.00,'','2018-09-25',NULL,NULL,'2018-10-01',NULL,1),(709,26339939,1000,'13',1.00,0.00,7,'26339939-0FSMI01','*',0,'2018-09-28','','','','',105,'','-41.3214705','-73.0138898','','','','1969-01-31','','','',0,'','',0,0.00,0,0.00,'','2018-09-28',NULL,NULL,'2018-10-01','Servicio de Prueba',1),(710,12713590,1,'11',1.00,0.00,1,'12713590-8BSMI01','Internet Domicilio',1,'2018-09-28','115','Habilitación Servicio Internet','juanrodriguez','',108,'Parcelación Don Rafael.  Parcela 30.  Puerto Montt','-41.43252135219135','-72.93159962742311','','Juan Rodríguez','998838233','2018-09-28','Puerto Varas','Force200+RB951','66',117,'66','14',1,6.99,1,0.00,'juanrodriguez','2018-10-16',NULL,NULL,'2018-10-01',NULL,1),(711,10858431,1,'11',2.00,0.00,1,'10858431-9BSMI01','',3,'2018-10-09','','','','',108,'Chin Chin bajo s/n, Parcelaciòn Don Rafael, Parcela Nª 25','-41.43218351212468','-72.9294538602112','','José Luis Aceval Silva','996440778','1969-01-31','PV','Force 200 + Hap','-69',117,'','',1,6.99,1,0.00,'jluisaceval@gmail.com','2018-10-16',NULL,NULL,'2018-10-01',NULL,1),(712,6740725,1,'13',1.00,0.00,1,'6740725-3FSMI01','',1,'2018-10-12','110','','jneumann','',108,'Portal del Lago.  Parcela 12.  Llanquihue','-41.2431364662884','-73.0132567986725','','Jaime Neumann','998886503','2018-10-12','Puerto Roales - Puerto Varas','PBE400 / Force 200 + RB951','60',110,'60','12',0,0.00,0,0.00,'jneumann','2018-10-11',NULL,NULL,'2018-10-01',NULL,1),(713,76460253,1,'13',2.00,0.00,1,'76460253-6FSMI01','',0,'2018-10-11','','','','',108,'Augusta Schwerter.  Parcela 6, Santa Augusta.  Puerto Varas','-41.323895773107004','-72.99457789509279','','Iván Kipreos Pinochet','994192019','2018-10-12','Puerto Varas','Force 200 + RB951','-55',0,'','',0,0.00,0,0.00,'ikipreos','2018-10-11',NULL,NULL,'2018-10-01',NULL,1),(714,76541036,1000,'13',1.00,0.00,1,'76541036-3FSMI01','',0,'2018-10-16','','','','',110,'','-41.3214705','-73.0138898','','','','1969-01-31','','','',0,'','',0,0.00,0,0.00,'','2018-10-16',NULL,NULL,'2018-10-01',NULL,1),(715,15561394,1,'13',1.00,0.00,1,'15561394-7FSMI01','',0,'2018-10-17','','','','',108,'Parcelación Don Rafael Número 48.  Puerto Montt','-41.432263950395274','-72.9293465718506','','Miguel Leiva','+56 9 7421 5207','2018-10-06','Puerto Varas','F200+Hap-Lite','-74',0,'','',1,7.00,1,0.00,'mguzman1','2018-10-26',NULL,NULL,'2018-10-01',NULL,1),(716,76521560,1,'13',1.00,0.00,1,'76521560-9FSMI02','',0,'2018-10-18','','','','',108,'Ruta 225.  Km 40.  Puerto Varas','-41.3214705','-73.0138898','','Sebastián Raimann','982342621','2018-10-01','VO','NanoBridge+TP link','65',0,'','',0,0.00,0,0.00,'craimann','2018-10-18',NULL,NULL,'2018-10-01',NULL,1),(717,76911785,1,'13',10.00,0.00,1,'76911785-7FSMI01','',0,'2018-10-22','','','','',108,'Sector El Vocal, Km. 2, Camino el Jardín','-41.59741817058576','-73.28586579411012','','Gonzalo Rojas','954161342','2018-10-19','Puerto Varas','RD34+951','745',0,'','',1,39.89,1,0.00,'tallersur','2018-10-26',NULL,NULL,'2018-10-01',NULL,1),(718,76466000,1,'13',1.00,0.00,1,'76466000-5FSMI01','',0,'2018-10-23','','','','',108,'Lago Todos Los Santos','-41.085984233624565','-72.16237963287819','','Ricardo Roth','987769457','2018-10-10','Chilcón','Force200+hap','55',0,'','',1,10.00,1,0.00,'ricardoroth','2018-10-26',NULL,NULL,'2018-10-01',NULL,1),(719,8564327,1,'13',1.00,0.00,1,'8564327-4FSMI01','',0,'2018-10-23','','','','',108,'Peulla s/n.  Lago Todos Los Santos.','-41.3214705','-73.0138898','','Alfredo Roth','973334092','2018-10-10','Chilcón','F200+Hap','60',0,'','',1,7.00,1,0.00,'alfredroth','2018-10-23',NULL,NULL,'2018-10-01',NULL,1),(720,9580565,1,'11',1.00,0.00,1,'9580565-5BSMI01','',0,'2018-10-23','','','','',108,'Casa Rupanco','-40.79649285978364','-72.44602860062105','','Torben Petersen','995350280','2018-10-24','El Taique','NanoBridge+RB951','50',0,'','',0,9.98,0,0.00,'tpetersen','2018-10-23',NULL,NULL,'2018-10-01',NULL,1),(721,11712371,1,'13',1.00,0.00,1,'11712371-5FSMI01','',0,'2018-10-23','','','','',108,'Fundo Villa Alegre s/n','-41.1018967020778','-73.15185190289003','','Patricio Nannig','996450602','2018-10-02','','EPMP100+Hap-Lite','65',0,'','',0,0.00,0,0.00,'pnanning','2018-10-23',NULL,NULL,'2018-10-01',NULL,1);
/*!40000 ALTER TABLE `servicios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `submenu`
--

DROP TABLE IF EXISTS `submenu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `submenu` (
  `IdSubMenu` int(11) NOT NULL AUTO_INCREMENT,
  `Id_menu` int(11) DEFAULT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Enlace` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`IdSubMenu`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `submenu`
--

LOCK TABLES `submenu` WRITE;
/*!40000 ALTER TABLE `submenu` DISABLE KEYS */;
INSERT INTO `submenu` VALUES (4,5,'Bodegas','../bodegas/Bodega.php'),(5,5,'Proveedores','../proveedores/Proveedor.php'),(6,5,'Mantenedor Tipo Producto','../tipo_producto/TipoProducto.php'),(7,5,'Mantenedor Marca Producto','../marca_producto/MarcaProducto.php'),(8,5,'Mantenedor Modelo Producto','../modelo_producto/ModeloProducto.php'),(9,5,'Ingreso de productos','../ingresos/Ingreso.php'),(10,5,'Egresos','../egresos/Egreso.php'),(11,1,'Crear Cliente','../clientes'),(12,1,'Ver Clientes','../clientes/listaCliente.php'),(13,1,'Crear Servicios','../servicios'),(14,6,'Informes','../reportes/informes.php'),(16,7,'Registro de Usuarios','../registroUsuarios'),(17,10,'Log querys','../logQuerys'),(18,4,'Agregar Ingreso Factura de Compras ','../compras_ingresos/Ingreso.php'),(19,4,'Centros de Costos','../costos/Costo.php'),(20,10,'Log Login','../logLogin'),(22,7,'Tipo Cobro Servicio','../TipoCobroServicio'),(23,1,'Ver Servicios','	\r\n../clientesServicios'),(26,3,'Nota de Venta','../nota_venta/NotaVenta.php'),(27,7,'Clase Cliente','../clase_cliente/ClaseCliente.php'),(28,11,'Emisión de Documentos','../facturacion/Facturacion.php'),(30,8,'Tickets','../tickets'),(31,8,'Descuentos','../descuentos/index.php'),(32,11,'Listado de Documentos','../facturacion/Facturas.php');
/*!40000 ALTER TABLE `submenu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subtipo_ticket`
--

DROP TABLE IF EXISTS `subtipo_ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subtipo_ticket` (
  `IdSubTipoTicket` int(11) NOT NULL AUTO_INCREMENT,
  `IdTipoTicket` int(11) DEFAULT NULL,
  `Nombre` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`IdSubTipoTicket`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subtipo_ticket`
--

LOCK TABLES `subtipo_ticket` WRITE;
/*!40000 ALTER TABLE `subtipo_ticket` DISABLE KEYS */;
INSERT INTO `subtipo_ticket` VALUES (1,2,'Problema Sin Visita'),(4,1,'Ejemplo de subtipo correos');
/*!40000 ALTER TABLE `subtipo_ticket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tickets` (
  `IdTickets` int(11) NOT NULL AUTO_INCREMENT,
  `IdCliente` int(11) DEFAULT NULL,
  `Origen` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Departamento` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Tipo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Subtipo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Prioridad` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `AsignarA` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Estado` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FechaCreacion` date DEFAULT NULL,
  `IdServicios` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Observaciones` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `IdUsuarioSession` int(11) NOT NULL,
  `Clase` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdTickets`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tickets`
--

LOCK TABLES `tickets` WRITE;
/*!40000 ALTER TABLE `tickets` DISABLE KEYS */;
/*!40000 ALTER TABLE `tickets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tiempo_prioridad`
--

DROP TABLE IF EXISTS `tiempo_prioridad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tiempo_prioridad` (
  `IdTiempoPrioridad` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) DEFAULT NULL,
  `TiempoHora` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`IdTiempoPrioridad`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tiempo_prioridad`
--

LOCK TABLES `tiempo_prioridad` WRITE;
/*!40000 ALTER TABLE `tiempo_prioridad` DISABLE KEYS */;
INSERT INTO `tiempo_prioridad` VALUES (8,'Alta','24'),(9,'Media','48'),(10,'Baja','72');
/*!40000 ALTER TABLE `tiempo_prioridad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_ticket`
--

DROP TABLE IF EXISTS `tipo_ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_ticket` (
  `IdTipoTicket` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`IdTipoTicket`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_ticket`
--

LOCK TABLES `tipo_ticket` WRITE;
/*!40000 ALTER TABLE `tipo_ticket` DISABLE KEYS */;
INSERT INTO `tipo_ticket` VALUES (1,'Correos'),(2,'Problema Sin Visita');
/*!40000 ALTER TABLE `tipo_ticket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trafico_generado`
--

DROP TABLE IF EXISTS `trafico_generado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trafico_generado` (
  `IdTraficoGenerado` int(11) NOT NULL AUTO_INCREMENT,
  `LineaTelefonica` varchar(100) DEFAULT NULL,
  `Descripcion` varchar(300) DEFAULT NULL,
  `IdServicio` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdTraficoGenerado`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trafico_generado`
--

LOCK TABLES `trafico_generado` WRITE;
/*!40000 ALTER TABLE `trafico_generado` DISABLE KEYS */;
INSERT INTO `trafico_generado` VALUES (4,'652566620','',668);
/*!40000 ALTER TABLE `trafico_generado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(40) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `clave` varchar(60) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nivel` int(11) NOT NULL,
  `cargo` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `sexo` varchar(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=MyISAM AUTO_INCREMENT=118 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (116,'dangel','Daniel Angel','$2y$10$/wlAN9MCzw.dEtuKJ.L7QOiK/bX6xMS1ZtcQ.HsFNMC/wRhq/W8Dm',1,'Programador','daniel30081990@gmail.com',''),(108,'Esteban','Esteban Salas','$2y$10$lx15c1pF2W7rHjUUy61o0uj3OTiysr2ROXFSPDT0tbqfyuDyfFz5O',1,'Departamento de Ventas','esalas@teledata.cl',''),(107,'rberndt','Rolf Berndt','$2y$10$bE/TRQfNOWenWRhbGeh9zes8k4iTH1wUAJUcHS.7inF.0A4UhWsfG',1,'Encargado de Logistica y Bodega','rberndt@teledata.cl',''),(101,'sergio','Sergio Casas del Valle','$2y$10$wk0haa0ftt6zG.nQd3BxO.IYhU1R0xdy09SXY11ML3ZCFYN.t7Zky',1,'Gerente General','sergio@teledata.cl',''),(106,'rmontoya','Ronald Montoya','$2y$10$NMEna//nIKUoD2NXh3a2Ge7cxRrc4rznpQST3ZBzxWXdSd8e2Fjv6',1,'Administrador','rmontoya@teledata.cl',''),(105,'orodriguez','Oswaldo Rodriguez','$2y$10$R8ymz9NZLRYcSRXNGh/XLODcrF1zWkwRXwd0KdvD0zjK5xhxm2vM2',1,'Programador','oswaldo@awaking.cl','M'),(104,'Fran','Francesca ','$2y$10$HLYr/5u406iqMvcK6f/jae9ybwEIX1rX39DFkFC2nIlHJyuL14JU.',1,'Gerencia','fpezzuto@teledata.cl',''),(109,'Katherine','Katherine','$2y$10$yzdXvtzXKI9ourenTp.oY.vcsIoIZnliI2td1JRX1ckpxkwoZt6Ta',1,'Contadora','kcardenas@teledata.cl',''),(110,'cjurgens','Carlos Jurgens','$2y$10$LUtxyBRwS6zIwWhSAk9KeOFaxeyYN3tmRJYEDIaUtx2ldgvFzTLYq',1,'Administracion','cjurgens@teledata.cl',''),(112,'julio','Julio Carrillo','$2y$10$GAv785q.0I1o1aZVAiBxc.fc7eseW5omkflk73tqhrsSVgIehz4x6',1,'Soporte Nivel 2','jcarrillo@teledata.cl',''),(115,'Walter','Walter Saldivia','$2y$10$b7Lk74qz9AA43ttILcgzuOsXs92G/uKn7q5UCMWIFOQqJnuQoDf5C',3,'Tecnico Terreno','wsaldivia@teledata.cl',''),(113,'atris','Atris Martelo','$2y$10$4oI0ixVEiyXB/X0euuUiVuEwPx/dg8FGLFJJ6fX7gHai.F6u1AARG',1,'Soporte Nivel 1','atrismartelo@teledata.cl',''),(114,'GIAN','Gian Pezzuto','$2y$10$k5Kk2y5O7HOccpjWr4bV1eQZ.qRs2JenVozLNkm5LlaWvN1HC7l0.',2,'ENCARGADO CHILOE','GIANNIPEZZUTO@TELEDATA.CL',''),(117,'Paula','Paula Reinoso','$2y$10$H/5CrRefJoShda0x.fO.cePlhPvIZkWwRgfQEuwezH/yxJboCAliW',1,'Administración','preinoso@teledata.cl','');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `variables_globales`
--

DROP TABLE IF EXISTS `variables_globales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `variables_globales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_comprobacion` date NOT NULL,
  `token_prueba` varchar(255) DEFAULT NULL,
  `token_produccion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `variables_globales`
--

LOCK TABLES `variables_globales` WRITE;
/*!40000 ALTER TABLE `variables_globales` DISABLE KEYS */;
INSERT INTO `variables_globales` VALUES (1,'2018-07-01','55c32f657ce5aa159a6fc039b64aabceead8f061','957d3b3419bacf7dbd0dd528172073c9903d618b');
/*!40000 ALTER TABLE `variables_globales` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-10-26 22:00:02
