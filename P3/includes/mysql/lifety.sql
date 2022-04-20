-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: lifety
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

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
-- Table structure for table `anuncio`
--

DROP TABLE IF EXISTS `anuncio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `anuncio` (
  `id_anuncio` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `id_empresa` int(5) unsigned NOT NULL,
  `contenido` mediumtext NOT NULL,
  `imagen` varchar(30) NOT NULL,
  `orden` int(1) unsigned NOT NULL,
  PRIMARY KEY (`id_anuncio`),
  KEY `Empresa_FK` (`id_empresa`),
  CONSTRAINT `Empresa_FK` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id_empresa`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anuncio`
--

LOCK TABLES `anuncio` WRITE;
/*!40000 ALTER TABLE `anuncio` DISABLE KEYS */;
/*!40000 ALTER TABLE `anuncio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chat`
--

DROP TABLE IF EXISTS `chat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chat` (
  `Receptor` text NOT NULL,
  `Origen` text NOT NULL,
  `Contenido` mediumtext NOT NULL,
  `Tiempo` datetime NOT NULL,
  `Tipo` enum('U-E','E-U') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat`
--

LOCK TABLES `chat` WRITE;
/*!40000 ALTER TABLE `chat` DISABLE KEYS */;
INSERT INTO `chat` VALUES ('pintus','perspa','hola que tal','2022-04-10 15:27:50','U-E');
/*!40000 ALTER TABLE `chat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comidas`
--

DROP TABLE IF EXISTS `comidas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comidas` (
  `id_comida` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `objetivo` int(1) NOT NULL,
  `tipo` enum('Desayuno','Comida','Cena') NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `link` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id_comida`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comidas`
--

LOCK TABLES `comidas` WRITE;
/*!40000 ALTER TABLE `comidas` DISABLE KEYS */;
INSERT INTO `comidas` VALUES (1,1,'Desayuno','Copos de avena con leche',''),(2,1,'Desayuno','Yogur con copos de avena',''),(3,1,'Desayuno','Tortitas de avena',''),(4,2,'Desayuno','Porridge de avena y frutos secos',''),(5,2,'Desayuno','Requeson con fruta',''),(6,2,'Desayuno','Sandwich de queso gouda con huevo duro',''),(7,2,'Desayuno','Batido de platano y avena',''),(8,3,'Desayuno','Smoothie Bowls',''),(9,3,'Desayuno','Hotcakes de avena y quinoa',''),(10,3,'Desayuno','Pudin',''),(11,3,'Desayuno','Wrap de pavo',''),(12,1,'Comida','Ensalada de calabacin a la plancha con queso feta',''),(13,1,'Comida','Albondigas de merluza y brocoli',''),(14,1,'Comida','Pechuga de pollo con soja y verduras salteadas',''),(15,1,'Comida','Caldo de verduras con tortilla francesa',''),(16,2,'Comida','Ensalada de patata hervida, tomate, pepino y huevo duro',''),(17,2,'Comida','Wok de verduras al curry con tiras de pollo',''),(18,2,'Comida','.Berenjena y calabacin asado con pimenton dulce',''),(19,2,'Comida','Pure de calabaza con patata hervida',''),(20,2,'Comida','Tomates rellenos de lentejas',''),(21,2,'Comida','Revuelto de gambas y champinones',''),(22,3,'Cena','Pollo con verduras y queso batido al papillote',''),(23,3,'Cena','Salmon al horno con salsa de yogur',''),(24,3,'Cena','Sopa de pasta y hamburguesa con naranja picada',''),(25,3,'Cena','Crema de verduras y pechuga de pollo con manzana',''),(26,3,'Cena','Croquetas de pescado con pure de patata',''),(27,3,'Cena','Pollo a la naranja',''),(28,3,'Cena','Garbanzos con espinacas',''),(29,3,'Cena','Arroz tres delicias',''),(30,1,'Cena','Ensalada de patata hervida, tomate, pepino y huevo duro',''),(31,1,'Cena','Wok de verduras al curry con tiras de pollo',''),(32,2,'Cena','Hamburguesa de jamon york con mayonesa y queso',''),(33,2,'Cena','Minipizza cuatro quesos con naranja troceada',''),(34,1,'Comida','Pescado blanco a la plancha con ensalada de lechuga',''),(35,1,'Comida','Revuelto de dos huevos con verduras',''),(36,1,'Comida','Menestra de acelgas, zanahoria y patata',''),(37,1,'Comida','Alcachofas al horno y muslo de pollo a la plancha',''),(38,1,'Comida','Kinoa con verduras',''),(39,1,'Comida','Berenjena rellena de verduras y arroz integral',''),(40,2,'Comida','Pasta con setas salteadas',''),(41,2,'Comida','Arroz con pollo a la plancha',''),(42,2,'Comida','Cocido',''),(43,2,'Comida','Lentejas',''),(44,2,'Comida','Pollo con almendras chino',''),(45,2,'Comida','Fingers de pollo casero con salsa picante',''),(46,2,'Comida','Arroz integral con pasas y almendras',''),(47,2,'Comida','Pollo picante con cuscus',''),(48,2,'Comida','Pasta cremosa con pollo cajun',''),(49,2,'Comida','Paella de pollo y chorizo',''),(50,2,'Comida','Hamburguesa de pollo zingy',''),(51,2,'Comida','Quesadilla de pavo y aguacate',''),(52,3,'Comida','Pollo a la naranja',''),(53,3,'Comida','Garbanzos con espinacas',''),(54,3,'Comida','Arroz tres delicias',''),(55,3,'Comida','Conejo al horno con verduras',''),(56,3,'Comida','Salteado de verduras con pollo a la plancha',''),(57,3,'Comida','Tortilla de patatas con mayonesa',''),(58,3,'Comida','Lasana de verduras',''),(59,3,'Comida','Tallarines chinos con gambas',''),(60,3,'Comida','Merluza al horno con verduras',''),(61,3,'Comida','Revuelto de bacalao',''),(62,3,'Comida','Atun a la plancha con ajo y perejil',''),(63,1,'Desayuno','Tostada de pan integral con aguacate',''),(64,2,'Desayuno','Gofres proteicos',''),(65,2,'Desayuno','Brownie proteico',''),(66,2,'Desayuno','Gachas de avena proteicas',''),(67,2,'Desayuno','Muffins proteicos de yogurt helado',''),(68,2,'Desayuno','Vasitos de cheescake',''),(69,2,'Desayuno','Bocaditos proteicos de masa de galleta',''),(70,3,'Desayuno','Pudding',''),(71,3,'Desayuno','Wrap de pavo',''),(72,3,'Desayuno','Pan de platano relleno de cheesecake',''),(73,3,'Desayuno','Tortitas proteicas de platano',''),(74,1,'Cena','Berenjena y calabacin asado con pimenton dulce',''),(75,1,'Cena','Pure de calabaza con patata hervida',''),(76,1,'Cena','Tomates rellenos de lentejas',''),(77,1,'Cena','Revuelto de gambas con champinones',''),(78,1,'Cena','Pate de humus',''),(79,2,'Cena','Filete de buey con patata al horno y verduras',''),(80,2,'Cena','Macarrones con pisto',''),(81,2,'Cena','Ravioli con jamon york y tomate fresco',''),(82,2,'Cena','Ensalada de arroz con atun y mayonesa',''),(83,2,'Cena','Tagliatelle con salmon y nata',''),(84,3,'Cena','Conejo al horno con verduras',''),(85,3,'Cena','Salteado de verduras con pollo a la plancha',''),(86,3,'Cena','Tortilla de patatas con mayonesa',''),(87,3,'Cena','Lasana de verduras','');
/*!40000 ALTER TABLE `comidas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contiene`
--

DROP TABLE IF EXISTS `contiene`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contiene` (
  `id_rutina` int(5) NOT NULL,
  `id_ejercicio` int(5) NOT NULL,
  `dia` int(1) NOT NULL,
  `repeticiones` int(2) NOT NULL,
  KEY `Ejercicio_FK` (`id_ejercicio`),
  KEY `id_rutina` (`id_rutina`),
  CONSTRAINT `Ejercicio_FK` FOREIGN KEY (`id_ejercicio`) REFERENCES `ejercicios` (`id_ejercicio`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Idrut_FK` FOREIGN KEY (`id_rutina`) REFERENCES `rutina` (`id_rutina`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contiene`
--

LOCK TABLES `contiene` WRITE;
/*!40000 ALTER TABLE `contiene` DISABLE KEYS */;
INSERT INTO `contiene` VALUES (91,12,1,6),(91,9,1,14),(91,0,1,14),(91,1,1,6),(91,20,2,6),(91,21,2,6),(91,16,2,14),(91,17,2,8),(91,4,3,6),(91,5,3,6),(91,12,3,6),(91,13,3,8),(92,12,1,6),(92,9,1,14),(92,0,1,14),(92,1,1,6),(92,20,2,6),(92,21,2,6),(92,16,2,14),(92,17,2,8),(92,4,3,6),(92,5,3,6),(92,12,3,6),(92,13,3,8);
/*!40000 ALTER TABLE `contiene` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dieta`
--

DROP TABLE IF EXISTS `dieta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dieta` (
  `id_usuario` int(5) unsigned NOT NULL,
  `fecha` date NOT NULL,
  `id_desayuno` int(5) unsigned DEFAULT NULL,
  `id_almuerzo` int(5) unsigned DEFAULT NULL,
  `id_cena` int(5) unsigned DEFAULT NULL,
  `tipo` int(1) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_usuario`,`fecha`),
  KEY `clave-dieta-desayuno` (`id_desayuno`),
  KEY `clave-dieta-almurezo` (`id_almuerzo`),
  KEY `clave-dieta-cena` (`id_cena`),
  CONSTRAINT `clave-dieta-almurezo` FOREIGN KEY (`id_almuerzo`) REFERENCES `comidas` (`id_comida`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `clave-dieta-cena` FOREIGN KEY (`id_cena`) REFERENCES `comidas` (`id_comida`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `clave-dieta-desayuno` FOREIGN KEY (`id_desayuno`) REFERENCES `comidas` (`id_comida`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `dieta_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dieta`
--

LOCK TABLES `dieta` WRITE;
/*!40000 ALTER TABLE `dieta` DISABLE KEYS */;
INSERT INTO `dieta` VALUES (36,'2022-04-10',10,12,30,1),(36,'2022-04-11',2,13,31,1),(36,'2022-04-12',3,34,74,1),(36,'2022-04-13',63,35,75,1),(36,'2022-04-14',1,36,76,1),(36,'2022-04-15',2,37,77,1),(36,'2022-04-16',3,39,78,1);
/*!40000 ALTER TABLE `dieta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ejercicios`
--

DROP TABLE IF EXISTS `ejercicios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ejercicios` (
  `id_ejercicio` int(5) NOT NULL,
  `tipo` int(1) NOT NULL,
  `musculo` varchar(40) DEFAULT NULL,
  `nombre` varchar(40) DEFAULT NULL,
  `descripcion` mediumtext NOT NULL,
  `imagen` varchar(50) NOT NULL,
  PRIMARY KEY (`id_ejercicio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ejercicios`
--

LOCK TABLES `ejercicios` WRITE;
/*!40000 ALTER TABLE `ejercicios` DISABLE KEYS */;
INSERT INTO `ejercicios` VALUES (0,2,'Hombro','Elevacion lateral','',''),(1,0,'Hombro','Press hombro','',''),(2,1,'Hombro','Remo al menton','',''),(3,0,'Hombro','Press militar','',''),(4,0,'Pierna','Sentadilla','',''),(5,0,'Pierna','Prensa','',''),(6,1,'Pierna','Extension de cuadriceps','',''),(7,1,'Pierna','Hip thrust','',''),(8,0,'Pecho','Press banca','',''),(9,2,'Pecho','Aperturas con mancuernas','',''),(10,0,'Pecho','Press banca inclinado','',''),(11,1,'Pecho','Maquina de empuje','',''),(12,0,'Triceps','Fondos','',''),(13,1,'Triceps','Press frances','',''),(14,2,'Triceps','Extensiones','',''),(15,1,'Triceps','Barras paralelas','',''),(16,2,'Biceps','Curl spider','',''),(17,1,'Biceps','Predicador','',''),(18,1,'Biceps','Martillo','',''),(19,1,'Biceps','Chin-ups','',''),(20,0,'Espalda','Jalon','',''),(21,0,'Espalda','Remo en T','',''),(22,1,'Espalda','Remo con barra','',''),(23,1,'Espalda','Renegade row','','');
/*!40000 ALTER TABLE `ejercicios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empresas`
--

DROP TABLE IF EXISTS `empresas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empresas` (
  `id_empresa` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  PRIMARY KEY (`id_empresa`),
  UNIQUE KEY `nombre_empresa` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresas`
--

LOCK TABLES `empresas` WRITE;
/*!40000 ALTER TABLE `empresas` DISABLE KEYS */;
/*!40000 ALTER TABLE `empresas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entrena`
--

DROP TABLE IF EXISTS `entrena`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entrena` (
  `nutri` text NOT NULL,
  `usuario` text NOT NULL,
  `editarutina` int(1) NOT NULL,
  `editadieta` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entrena`
--

LOCK TABLES `entrena` WRITE;
/*!40000 ALTER TABLE `entrena` DISABLE KEYS */;
INSERT INTO `entrena` VALUES ('pintus','perspa',0,0);
/*!40000 ALTER TABLE `entrena` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `foro`
--

DROP TABLE IF EXISTS `foro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `foro` (
  `id_foro` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `id_usuario` int(5) unsigned NOT NULL,
  `tema` varchar(50) NOT NULL,
  `nickcreador` varchar(20) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `contenido` varchar(500) NOT NULL,
  `categoria` enum('Nutricion','Dieta') NOT NULL,
  `respuestas` int(5) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_foro`),
  UNIQUE KEY `tema` (`tema`),
  KEY `id_usuario` (`id_usuario`),
  KEY `nickcreador` (`nickcreador`),
  CONSTRAINT `foro_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `personas` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `foro_ibfk_2` FOREIGN KEY (`nickcreador`) REFERENCES `personas` (`nick`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `foro`
--

LOCK TABLES `foro` WRITE;
/*!40000 ALTER TABLE `foro` DISABLE KEYS */;
INSERT INTO `foro` VALUES (27,31,'&iquest;Creatina-&gt;p&eacute;rdida de pelo?','pintus','2022-04-19 15:27:25','La creatina, &aacute;cido &alpha;-metil guanido-ac&eacute;tico, es un &aacute;cido org&aacute;nico nitrogenado que se encuentra en los m&uacute;sculos y c&eacute;lulas nerviosas de algunos organismos vivos. Se puede obtener tanto de manera natural como de manera artificial como suplemento','Dieta',0);
/*!40000 ALTER TABLE `foro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mensaje`
--

DROP TABLE IF EXISTS `mensaje`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mensaje` (
  `id_mensaje` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `id_usuario` int(5) unsigned NOT NULL,
  `id_referencia` int(5) unsigned DEFAULT NULL,
  `id_foro` int(5) unsigned NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `mensaje` mediumtext NOT NULL,
  `fecha` datetime NOT NULL,
  `prioridad` int(5) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_mensaje`),
  KEY `Tema_FK` (`id_foro`),
  KEY `Mensaje_FK` (`id_referencia`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `Mensaje_FK` FOREIGN KEY (`id_referencia`) REFERENCES `mensaje` (`id_mensaje`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Tema_FK` FOREIGN KEY (`id_foro`) REFERENCES `foro` (`id_foro`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `mensaje_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `personas` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mensaje`
--

LOCK TABLES `mensaje` WRITE;
/*!40000 ALTER TABLE `mensaje` DISABLE KEYS */;
INSERT INTO `mensaje` VALUES (12,31,NULL,27,'Contexto','La creatina, &aacute;cido &alpha;-metil guanido-ac&eacute;tico, es un &aacute;cido org&aacute;nico nitrogenado que se encuentra en los m&uacute;sculos y c&eacute;lulas nerviosas de algunos organismos vivos. Se puede obtener tanto de manera natural como de manera artificial como suplemento','2022-04-19 15:27:25',0),(16,31,NULL,27,'Creatina buena o no','Merece la pena tomar creatina? O se produce mucha perdida de cabello. La perdida es gradual o de golpe?','2022-04-19 15:35:34',0),(17,32,NULL,27,'Mi experiencia con la creatina','Yo tomo creatina pre-entreno y no tengo problemas de cabello eso es un mito','2022-04-19 15:51:20',0),(18,38,16,27,'Experiencia con creatina de conocidos','Mi novio ha empezado a tomar creatina y le veo con menor cantidad de pelo, te dir&iacute;a que la p&eacute;rdida es de golpe','2022-04-19 15:55:42',1),(19,32,18,27,'Mi experiencia con la creatina','Yo la tomo y noto mi cabello igual de denso y fuerte, la p&eacute;rdida depende de las hormonas. La creatina no lo induce, ya que la creamos con nuestro propio cuerpo','2022-04-19 15:56:56',2);
/*!40000 ALTER TABLE `mensaje` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `noticias`
--

DROP TABLE IF EXISTS `noticias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `noticias` (
  `id_noticia` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `id_profesional` int(5) unsigned NOT NULL,
  `titulo` mediumtext NOT NULL,
  `cuerpo` mediumtext NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`id_noticia`),
  KEY `id_profesional` (`id_profesional`),
  CONSTRAINT `noticias_ibfk_1` FOREIGN KEY (`id_profesional`) REFERENCES `profesional` (`id_profesional`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `noticias`
--

LOCK TABLES `noticias` WRITE;
/*!40000 ALTER TABLE `noticias` DISABLE KEYS */;
INSERT INTO `noticias` VALUES (1,31,'Condenado un gimnasio de Sevilla por la agresión de un monitor a un usuario que se quejó por no usar mascarillas','Cuando está a punto de desaparecer la obligatoriedad del uso de las mascarillas en los interiores, llega una sentencia por un incidente dentro de un gimnasio. La empresa que gestiona un gimnasio de San Bernardo ha sido condenada como responsable civil subsidiaria por las lesiones que le produjo, durante una agresión, uno de sus monitores a un socio del mencionado centro deportivo. La sentencia, asimismo, condena al monitor por un delito de lesiones.  Los hechos juzgados ocurrieron el 17 de noviembre de 2021, cuando el socio agredido recriminó al monitor que hubiera socias en la sala de fitness sin la mascarilla obligatoria. La sentencia del juzgado de Instrucción número 18 de Sevilla, a la que ha tenido acceso este periódico, recoge entre los hechos probados que el usuario requirió al monitor para que \"exigiese a otros usuarios que se cubrieran la cara y nariz con la mascarilla\" como a él se lo exigía.  La conversación se desarrolló en tono \"poco cordial\", dice la juez, que añade que el cliente le dijo al monitor que \"hiciera su trabajo\", a lo que el monitor le respondió: \"Usted no es nadie para decirme cuál es mi trabajo\". Dice el fallo que el denunciante \"pudo llamar subnormal\" al monitor mientras bajaba al vestuario, por lo que al oírlo el condenado,  A. R. N.,  lo siguió, prosiguiendo la discusión entre ambos, y el monitor llamó \"tonto y subnormal\" al cliente. En un momento dado, el monitor golpeó al cliente en el brazo derecho, \"agarrándolo y zarandeándolo con fuerza causándole tendinitis del manguito de los rotadores\" y tardó siete días en curar.','2022-04-01 16:23:48'),(2,31,'La diferencia de entrenar en el gimnasio con o sin mascarilla: así afecta a la respiración y al corazón','Uno de los contextos en los que el uso de mascarillas ha generado más dudas y controversias es en la práctica de la actividad deportiva. Y es que al mismo tiempo que el esfuerzo físico favorece el contagio del virus (ya que aumenta la proyección de partículas de saliva que pueden ser transmisoras), muchas personas reportaban una mayor incomodidad al tratar de ejercitarse con la mascarilla e incluso se mostraban preocupadas por que dificultase su respiración de manera dañina.\r\n\r\nSin efectos significativos\r\nAhora, el fin de la obligación de llevar la mascarilla incluso en espacios interiores debería aliviar definitivamente esos miedos. No obstante, lo cierto es que parece ser que siempre fueron infundados.\r\n\r\nAsí lo ha puesto de manifiesto un estudio llevado a cabo por investigadores del centro Langone Health de la Universidad de Nueva York, que ha sido aceptado para su publicación en el medio especializado Sports Medicine y que presentaron en la convención anual de la Academia Americana de Cirujanos Ortopédicos.\r\n\r\nTal y como recoge el medio Medscape, el trabajo en cuestión, una revisión sistemática de la evidencia disponible hasta el momento, concluye que los individuos sanos pueden realizar ejercicio físico intenso con las mascarillas habitualmente empleadas para prevenir el contagio de la covid-19 con mínimos cambios fisiológicos.\r\n\r\nConcretamente, los autores han explorado 22 investigaciones sobre un total de 583 personas, en las que se observó que llevar mascarilla no tuvo ningún efecto significativo en los principales parámetros fisiológicos: la frecuencia cardíaca, la frecuencia respiratoria, la saturación de oxígeno en sangre y el agotamiento percibido. Estos resultados eran también extensibles a las mujeres embarazadas e incluso a los niños.\r\n\r\nDe la misma manera, estas conclusiones se aplicaban tanto a las tradicionales mascarillas quirúrgicas como a las mascarillas FFP2/N95, las dos más comúnmente empleadas.\r\n\r\nAún así, los investigadores resaltan que los estudios recogidos no son de gran calidad, ya que tienden a utilizar cohortes muy pequeñas. La retirada de las mascarillas en numerosos países podría en este sentido frenar la investigación sobre este asunto; sin embargo, los autores creen que el campo seguirá siendo relevante de cara a futuros brotes de covid-19 o incluso ante otras futuras epidemias de enfermedades respiratorias.','2022-04-05 16:23:48'),(3,31,'Los gimnasios respiran 700 días después: \"La gente está muy contenta\"','Es incómodo, aseguran; sudas, se te moja la mascarilla, no puedes respirar bien... Por eso, los usuarios de los gimnasios han recibido con los brazos abiertos y a cara descubierta el fin de la obligatoriedad de utilizar mascarilla cuando levantan pesas, siguen una clase de aerobic o practican spinning. En estos locales, tanto socios como trabajadores han acudido en la inmensa mayoría de los casos sin el cubrebocas a su cita diaria con el deporte.  \"La diferencia es brutal; solo el hecho de respirar mientras hacer las series se nota muchísimo. Es mucho más cómodo\", explican Samuel Ruiz y Miguel Pérez, socios del gimnasio bilbaino Twentyfit. Y no solo eso, \"también el poder ver las caras de las personas se hace raro. Incluso gente que no conocías sin mascarilla ahora la puedes ver\". Estos dos bilbainos no veían el momento de poder acudir al gimnasio sin tener que usar mascarilla, \"y poder entrenar libremente sin ese agobio\", aunque también se alegran de poder ir a la universidad sin ella. \"Tengo ganas de ver a mis compañeros, es mucha diferencia. Hay alumnos que igual han venido nuevo y no les conoces las caras, porque solo coincides en clase. Es más fácil hablar, hacer las presentaciones orales se hacen más cómodas... Es mucho mejor\", coinciden.  Irene Laza y Kosti Gradinau, que entrenaban a unos metros, son de la misma opinión. \"Tenía muchas ganas de poder quitarme la mascarilla en el gimnasio. Ha sido mucho tiempo\", afirmaban. Eso sí, ni el cubrebocas ha impedido que hayan seguido acudiendo durante estos largos años de pandemia. \"Mejor venir sin mascarilla que no venir. Y fondo habremos cogido de fatigarnos tanto con la mascarilla\", bromeaban entre ellos.','2022-04-08 16:23:48'),(4,31,'Programa piloto enseñará a estudiantes de LAUSD sobre cocina y nutrición','El proyecto se apega a recetas culturalmente relevantes para las familias del sur de California, con el fin de dar lugar a hábitos saludables para toda la vida. Algunos representantes de LAUSD hicieron acto de presencia para mostrar su apoyo al programa. Una preparatoria en el distrito de Crenshaw lanzó el martes un programa piloto de gastronomía, en donde los alumnos aprenderán planes de cocina y nutrición.  Los estudiantes de artes culinarios en la preparatoria Dorsey cocinaban salmón el día de hoy.  “Sacamos los ingredientes y luego hacemos equipo para ver quien va a hacer que”, dijo Guadalupe Santiago, estudiante.  Pero hoy fue una clase diferente, ya que se lanzó el programa Common Threads, que busca modificar los métodos de preparación de comida, y tuvieron de invitado a Govind Armstrong, un chef reconocido por su participación en Top Chef, y quien habló sobre su vida con su madre costarricense.  “Mi mamá trabajaba mucho, tenía dos trabajos, pero era muy importante que todos nos sentáramos a comer”, dijo Armstrong.  Y aparte de inspirar a los jóvenes, les pasó sus conocimientos sobre la cocina saludable.','2022-04-10 16:23:48'),(5,31,'Este es el alimento que más calorías tiene del mundo: español y cargado de grasa','¿Cuál crees que es el alimento que tiene más calorías de todos? Probablemente, pienses que se trata de una hamburguesa, de unas patatas fritas o de una palmera de chocolate. Sin embargo, el alimento que más calorías tiene del mundo puede ser saludable, aunque no conviene tomar una gran ración. De hecho, una de sus variantes se produce en gran medida en España y, además, cuenta con una gran fama en todo el mundo.  Se trata del aceite, así en general: tanto el de girasol, como el de coco o, incluso, nuestro aceite de oliva. Si están compuestos por un 100% de aceite, cualquiera de ellos se considera como el alimento más calórico del mundo. Esto se debe a que los aceites contienen un 100% de grasas y estas son el macronutriente con más calorías de todos. Concretamente, cada gramo de grasa contiene 9 kilocalorías. Una tostada con tomate y aceite de oliva. Una tostada con tomate y aceite de oliva.  NUTRICIÓN Este es el alimento que más calorías tiene del mundo: español y cargado de grasa Las grasas son el nutriente que más calorías aporta por cada gramo de peso y, por tanto, el alimento más calórico es muy rico en esta sustancia. 19 abril, 2022 03:36GUARDAR  ACEITE DE OLIVA ESPAÑA GRASAS Silvia Val Noticias relacionadas  Las 4 mejores alternativas al aceite de girasol que \'vuela\' del supermercado  Peligro por aceite de oliva adulterado en España: éstas son las marcas que no debes consumir  Más allá de oliva y girasol: éstos son los aceites alternativos más saludables para la dieta ¿Cuál crees que es el alimento que tiene más calorías de todos? Probablemente, pienses que se trata de una hamburguesa, de unas patatas fritas o de una palmera de chocolate. Sin embargo, el alimento que más calorías tiene del mundo puede ser saludable, aunque no conviene tomar una gran ración. De hecho, una de sus variantes se produce en gran medida en España y, además, cuenta con una gran fama en todo el mundo.  Se trata del aceite, así en general: tanto el de girasol, como el de coco o, incluso, nuestro aceite de oliva. Si están compuestos por un 100% de aceite, cualquiera de ellos se considera como el alimento más calórico del mundo. Esto se debe a que los aceites contienen un 100% de grasas y estas son el macronutriente con más calorías de todos. Concretamente, cada gramo de grasa contiene 9 kilocalorías.  Los carbohidratos y las proteínas, por su parte, contienen cuatro kilocalorías por cada gramo. Es decir, que si un alimento está compuesto al 100% por grasas este es, sin duda, el alimento más calórico. Las palmeras de chocolate, las hamburguesas o las patatas fritas suelen contener varios tipos de nutrientes y, por eso, en proporción nunca superan al aceite. En este sentido, las calorías de los alimentos se suelen calcular por cada 100 gramos.','2022-04-15 16:23:48'),(6,31,'Una nutrición adecuada acelera el metabolismo e incrementa tu energía','Lo que mucha gente desconoce es que para tener un metabolismo veloz es necesario ajustar los horarios de comida e incluso comer más, además de entender cómo el cuerpo procesa los alimentos y cuáles son óptimos para su funcionamiento, lo que genera un impacto en el peso, apetito y niveles de grasa corporal. De acuerdo con la nutrióloga y directora de Worldwide Health Education & Training en Herbalife Nutrition, Michelle Ricker, entre más rápido sea este proceso, más calorías se quemarán.  A pesar de que todos los alimentos proporcionan energía, algunos son mejores para obtenerla de manera sostenida. Carbohidratos complejos, grasas saludables (aguacate y nueces) y proteínas como pollo, pescado, tempeh, huevos, entre otros, calman el hambre pero tardan más tiempo en digerirse y brindan energía de forma lenta y constante, lo que significa un bajo índice glucémico.  Para digerir alimentos con un elevado índice glucémico o comida «chatarra» se necesita de menos energía porque contienen altos niveles de ingredientes refinados, provocando que el cuerpo siga teniendo hambre y mande al cerebro la señal de pedir más comida.','2022-04-17 16:23:48'),(7,31,'“Me dijeron que estaba fumada y hoy me llaman visionaria”: ‘Pickleball’, un nuevo deporte destinado a arrasar','Con cerca de cinco millones de jugadores, este híbrido entre el tenis, el bádminton y el pimpón se ha convertido en un fenómeno en ebullición en Estados Unidos. Varios expertos desgranan los motivos de su éxito y la probabilidad de que acabe triunfando también en nuestro país. Al igual que la de tantos otros en estos últimos dos años, la vida de Xiana López también dio un vuelco radical tras el azote de la covid-19. Trabajadora esencial al ejercer como realizadora de los informativos de La Sexta durante trece años, siguió levantándose a las cuatro y media de la mañana en lo más duro de la crisis sanitaria para rodearse de “fake news, malas noticias y un montón de cosas más” que la llevaron a pensar en un futuro distinto para su familia. “Me propuse que si venía una nueva pandemia me iba a pillar en Hawái, trabajando con mi ordenador desde allí. Y yo tengo un problema, que trato de conseguir lo que me propongo”. Aquel anhelo dio paso a diferentes cursos sobre comercio internacional, cómo vender en Amazon y un extenso estudio de mercado sobre qué tipo de producto podía satisfacer su runrún emprendedor. Hasta que un día, en un trayecto en la salida de la A-7, puso fin a sus anhelos cuando advirtió un cartel que invitaba a probar un deporte desconocido hasta entonces en nuestro país: el pickleball.','2022-04-18 16:23:48'),(8,31,'Los riesgos de las populares \"dietas milagro\"','La obesidad es uno de los principales problemas de salud en España con un 53,6% de prevalencia, según la Encuesta Europea de Salud en el país. Esta situación abre las puertas a las \"dietas milagro\" que se caracterizan por la supuesta rápida pérdida de peso, pero conllevan grandes riesgos. Estas tienen una gran popularidad.  Estas dietas suponen graves peligros para el bienestar de la persona como deficiencias nutricionales, daños en órganos como los riñones o el hígado; y cambios metabólicos que afectan al buen funcionamiento del organismo. La Fundación Española de la Nutrición cuenta que cada vez hay más estudios sobre las dietas, pero que \"la gente prefiere perder peso de forma inmediata y no poco a poco\". También afirman que la dieta mediterránea, es decir, la \"anti dieta\" es la más común.  Para perder peso y no poner en riesgo la salud es importante hacerlo de una manera controlada y guiada por un nutricionista que tenga en cuenta el metabolismo, la composición corporal y el historial clínico, entre otros para el éxito a largo plazo.   \"Cuando terminan este tipo de dietas, hay tanta ansiedad por comer que se recupera lo perdido y se gana más peso. La pérdida de peso saludable y más perdurable en el tiempo es la que implica de 1/2 kilo a 1 kilo de grasa corporal/semana sin perder masa muscular. El nutricionista hace este seguimiento de la corporación corporal con instrumentos de medición (plicómetro, cinta métrica...) y corrige el perfil nutricional de la dieta para evitar la pérdida de masa corporal\", explica Alma Palau, presidenta del Consejo General de Colegios Oficiales de Dietistas-Nutricionistas.  Al utilizar este método se produce un descenso de peso, pero con el paso del tiempo pasa a ser insostenible provocando la privación de nutrientes, la restricción de alimentos y la reducción drástica de calorías. Esto hace que sean poco efectivas, asegurando el \"efecto rebote\" y creando un círculo vicioso que puede comprometer a la salud física a largo plazo.  Por otro lado, las dietas milagro pueden suponer una amenaza para el bienestar mental. \"El supuesto objetivo es conseguir resultados inmediatos y sin esfuerzos, lo que resulta deseable y poco alcanzable. Puede funcionar como detonante de diversos trastornos de conducta alimentaria, especialmente en personas con baja autoestima y fuertes valores estéticos\", dice la psicóloga de BluaU de la entidad, Margarita Carrasco.','2022-04-20 16:27:13'),(9,31,'Vitamina B12: cuáles son sus beneficios y qué pasa si no consumes suficiente','La vitamina B12 pertenece a las ocho vitaminas del grupo B e interviene en numerosos procesos fisiológicos. La B12 es un nutriente que ayuda a mantener sanas las neuronas y los glóbulos sanguíneos y a diferencia de otras, solo se puede obtener de alimentos de origen animal, por lo que las personas con dietas veganas o vegetarianas, pueden llegar a producir síntomas por la falta de ella.  Una dieta equilibrada proporciona las cantidades necesarias de vitaminas que el organismo necesita, ya que estas están presentes en una gran variedad de alimentos, especialmente de origen vegetal. Sin embargo, la vitamina B12 está presente únicamente en alimentos de origen animal, por esta razón, las dietas veganas deben consumir esta vitamina como suplemento nutricional.  De igual modo, esta vitamina desempeña un papel muy relevante en el crecimiento y contribuye al normal desarrollo del sistema nervioso, mientras que la falta de ella, puede provocar anemia, debilidad y sensación de hormigueo en brazos y piernas. La B12, también llamada cobalamina, debido a que contiene cobalto, es una vitamina hidrosoluble esencial que ayuda al metabolismo de proteínas e interviene en numerosos procesos fisiológicos, como la formación de glóbulos rojos en la sangre y el mantenimiento del sistema nervioso central.  Además, contribuye a la elaboración del ADN, el material genético presente en todas las células, y previene la anemia megaloblástica, que provoca cansancio y debilidad, según Medline Plus.  La vitamina B12 es producida, en la naturaleza, por bacterias, por lo que solo los alimentos de origen animal son fuente de B12, por la simbiosis bacteriana. En cambio, no se encuentra en los alimentos vegetales y puede ser producida industrialmente únicamente por fermentación bacteriana.','2022-04-23 16:27:13'),(10,31,'Cinco alimentos clave para mejorar la nutrición de los más pequeños','Según la Organización Mundial de la Salud (OMS) la obesidad, esta acumulación anormal o excesiva de grasa que supone un riesgo para la salud, tiene especial gravedad si se da en la infancia. Esta patología tiene consecuencias nefastas, y la pandemia de la COVID-19, solo ha hecho que aumente más esta afección entre los más pequeños. Según datos de la OMS, en el mundo hay más de 300 millones de personas obesas, aunque las cifras más preocupantes son las referentes a la obesidad infantil. En los países en desarrollo con economías emergentes, la prevalencia de sobrepeso y obesidad infantil entre los niños en edad preescolar supera el 30%. Nuestro país es el tercero en toda Europa con mayor prevalencia de sobrepeso y obesidad infantil con un 14,2% de obesidad infantil y juvenil, tras Grecia (18%) e Italia (15,2%), según los datos de la OMS, cifras que no dejan de aumentar. En este sentido, es durante la infancia cuando se fijan los hábitos alimentarios, y si no se establecen correctamente, son muy difíciles de cambiar. «Con un especialista de la mano y unas rutinas alimentarias adecuadas junto a un estilo de vida saludable, se reducen las posibilidades de que el niño/a pueda sufrir determinadas patologías en su edad adulta», explican fuentes de Deusto Salud. Y añaden: «Además, se evitarán posibles trastornos nutricionales, anemia, sobrepeso u obesidad. La etapa infantil es donde más cambios tanto físicos como intelectuales se producen, y en ello cobra especial importancia la alimentación». Los cinco alimentos clave La hora de sentarse a la mesa no debe de ser nunca un momento traumático para los más pequeños, no se debe forzar a comer ni tampoco a que no lo haga. El objetivo es conseguir que aprendan a alimentarse solos y que disfruten con ello. Una de las maneras de conseguirlo es innovar con recetas e ingredientes diferentes, siempre teniendo en cuenta su valor nutricional, también se puede permitir que contribuyan a la elaboración del plato o preguntándoles que quieren para comer. También es importante establecer horarios regulares para las comidas y crear un hábito en los niños. A continuación Deusto Salud, centro de formación continua, presenta una lista con alimentos con valor nutricional imprescindibles para la buena alimentación de los más pequeños: Huevo. Es uno de los alimentos más nutritivos que existen además de ser una gran fuente de proteínas, contiene pocas grasas y ayuda al crecimiento y la actividad cerebral de los más pequeños. Arándanos. Gracias a su alto contenido en fibra mejora la digestión y ayudan a combatir las infecciones digestivas y urinarias. Son un gran alimento, ya que contienen flavonoides que potencian la memoria y mejoran el aprendizaje. Espinacas. Es un alimento muy completo, puesto que contienen hierro, vitaminas A y C y calcio. Ayudan a fortalecer los huesos, los músculos y el desarrollo cerebral además de reducir el riesgo de padecer enfermedades oculares. Yogur. Contiene una gran fuente de calcio y proteínas, es más fácil de digerir que la leche. Ayuda al correcto desarrollo de los huesos y disminuye las diarreas, además de ser una buena fuente de vitaminas del grupo B y minera  Nutricionistas: la mano derecha de los padres A día de hoy, existen muchos centros que se encargan de formar profesionales de la nutrición infantil que sean capaces de hacer un seguimiento teniendo en cuenta la etapa de desarrollo, sus características personales y sus necesidades en cada etapa de su crecimiento. De hecho desde el equipo d su nuevo curso de Alimentación y Nutrición Pediátrica aseguran que « cada vez más padres buscan ayuda de profesionales en nutrición infantil, para ayudarles a la creación de hábitos saludables y una dieta equilibrada y divertida para sus hijos».','2022-04-30 16:27:13');
/*!40000 ALTER TABLE `noticias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personas`
--

DROP TABLE IF EXISTS `personas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personas` (
  `id_usuario` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `nick` varchar(6) NOT NULL,
  `nombre` varchar(25) CHARACTER SET utf32 NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `contraseña` varchar(100) NOT NULL,
  `rol` tinyint(1) unsigned NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `nick_admin` (`nick`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personas`
--

LOCK TABLES `personas` WRITE;
/*!40000 ALTER TABLE `personas` DISABLE KEYS */;
INSERT INTO `personas` VALUES (8,'admin0','Dwayne','Johnson','dwayne@lifety.com','$2y$10$uAGG3yMjH7sBX9Qc2QEXZeJoc92buC2qPgxt2x0zdLv3Th3lrp4c.',0),(31,'pintus','Antonio','Pintus','pintus@lifety.es','$2y$10$4HMCjZeRUdGa.USKL.GCi.1bKkrkWWLpyF0n43517XSOOVmvQwDGG',2),(32,'anakin','Anakin','Skywalker','anakin@ucm.es','$2y$10$uOz6PMvV6YOUHm3b6Is6juMm1PG5zF1Vyp175pSCVGMpweIj4xzki',1),(35,'admin2','Mark','Wahlberg','markwa@lifety.es','$2y$10$LqSxgop6C4kalnXJsXYMZe1zVqg0T4.AokRa1cdxkyjHsxnkd6HcG',0),(36,'perspa','Persona','P&aacute;jaro','perspa@ucm.es','$2y$10$5XbQuYbufL5BkjaB3x.LLOnfZMrOkEBuz7jSZLZQjehc261drjb6S',1),(37,'flavio','Flavio','Briatore','flavio@ucm.es','$2y$10$Hhaw6oPpK.M2FC62Jx0de.wnnv3WUvXIojKATcMv2doTde6ukpmBy',1),(38,'silvia','Silvia','Mu&ntilde;oz','silvia@ucm.es','$2y$10$UWc8VQdQjGB80Bo.zybo..LLomjrT9Ig210N0zt.HHZ0BDOVS2Ebe',1);
/*!40000 ALTER TABLE `personas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `premium`
--

DROP TABLE IF EXISTS `premium`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `premium` (
  `id_usuario` int(5) unsigned NOT NULL,
  `id_profesional` int(5) unsigned NOT NULL,
  `peso` float NOT NULL,
  `altura` float NOT NULL,
  `alergias` text NOT NULL,
  `observaciones_adicionales` text NOT NULL,
  `num_logros` int(20) NOT NULL,
  `logros` set('5logros','AccesoTodos','ComenzarChat','Completa1Plan','Completa5Plan','ContrataNutri','Permanencia','Permanencia1m','Foro') NOT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `Pro_FK` (`id_profesional`),
  CONSTRAINT `premium_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `premium_ibfk_2` FOREIGN KEY (`id_profesional`) REFERENCES `profesional` (`id_profesional`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `premium`
--

LOCK TABLES `premium` WRITE;
/*!40000 ALTER TABLE `premium` DISABLE KEYS */;
INSERT INTO `premium` VALUES (36,31,70,1,'no','no',0,'');
/*!40000 ALTER TABLE `premium` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productos` (
  `id_producto` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `id_empresa` int(5) unsigned NOT NULL,
  `imagen` varchar(25) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` mediumtext NOT NULL,
  `precio` decimal(10,0) unsigned NOT NULL,
  `link` varchar(200) NOT NULL,
  `tipo` enum('proteina','caseina','creatina','aminoacidos','preentreno','gainer') NOT NULL,
  PRIMARY KEY (`id_producto`),
  KEY `id_empresa` (`id_empresa`),
  CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id_empresa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profesional`
--

DROP TABLE IF EXISTS `profesional`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profesional` (
  `id_profesional` int(5) unsigned NOT NULL,
  `nutri` varchar(20) NOT NULL,
  `num_usuarios` int(3) NOT NULL,
  `usuarios` text NOT NULL,
  PRIMARY KEY (`id_profesional`),
  CONSTRAINT `profesional_ibfk_1` FOREIGN KEY (`id_profesional`) REFERENCES `personas` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profesional`
--

LOCK TABLES `profesional` WRITE;
/*!40000 ALTER TABLE `profesional` DISABLE KEYS */;
INSERT INTO `profesional` VALUES (31,'pintus',2,'');
/*!40000 ALTER TABLE `profesional` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rutina`
--

DROP TABLE IF EXISTS `rutina`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rutina` (
  `id_rutina` int(5) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(5) unsigned NOT NULL,
  `activa` tinyint(1) NOT NULL,
  `objetivo` int(1) DEFAULT NULL,
  `nivel` char(1) DEFAULT NULL,
  `dias` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_rutina`),
  KEY `id_rutina` (`id_rutina`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `rutina_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rutina`
--

LOCK TABLES `rutina` WRITE;
/*!40000 ALTER TABLE `rutina` DISABLE KEYS */;
INSERT INTO `rutina` VALUES (91,36,1,1,'P',3),(92,32,1,1,'P',3);
/*!40000 ALTER TABLE `rutina` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id_usuario` int(5) unsigned NOT NULL,
  `premium` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `personas` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (32,0),(35,0),(36,1),(38,0);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-04-20 17:53:05
