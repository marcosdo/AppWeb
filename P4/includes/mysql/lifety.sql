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
  `nombre_empresa` varchar(20) NOT NULL,
  `contenido` mediumtext NOT NULL,
  `imagen` varchar(50) NOT NULL,
  `link` varchar(50) NOT NULL,
  PRIMARY KEY (`id_anuncio`),
  KEY `Empresa_FK` (`nombre_empresa`),
  CONSTRAINT `Empresa_FK` FOREIGN KEY (`nombre_empresa`) REFERENCES `empresas` (`nombre`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anuncio`
--

LOCK TABLES `anuncio` WRITE;
/*!40000 ALTER TABLE `anuncio` DISABLE KEYS */;
INSERT INTO `anuncio` VALUES (12,'goldgym','50% de descuento en el primer mes','5.jpg','https://www.goldsgym.com/'),(13,'energyFitness','3 meses por solo 50 euros!!!!!','6.jpg','http://energiefitness.es/'),(14,'fitnessCenter','FitnessCenter el mejor gimnasio de Madrid !!','10.jpg','https://www.fitnesscentervaguada.com/'),(15,'energyFitness','GET FIT NOW','11.jpg','http://energiefitness.es/'),(16,'theGym','50% en el mes de enero','16.jpg','https://thegym.es/'),(17,'fitnessCenter','GET YOUR ONE YEAR MEMBERSHIP NOW!','25.jpg','https://www.fitnesscentervaguada.com/');
/*!40000 ALTER TABLE `anuncio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias` (
  `id_categoria` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `tipo` enum('proteina','creatina','vitaminas','gainer','aminoacidos','pre-entreno','minerales') NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chat`
--

DROP TABLE IF EXISTS `chat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chat` (
  `id_mensaje` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `Receptor` varchar(6) NOT NULL,
  `Origen` varchar(6) NOT NULL,
  `Contenido` mediumtext NOT NULL,
  `Tiempo` datetime NOT NULL,
  `Tipo` enum('U-E','E-U') NOT NULL,
  PRIMARY KEY (`id_mensaje`),
  KEY `receptor_FK` (`Receptor`),
  KEY `origen_FK` (`Origen`),
  CONSTRAINT `origen_FK` FOREIGN KEY (`Origen`) REFERENCES `personas` (`nick`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `receptor_FK` FOREIGN KEY (`Receptor`) REFERENCES `personas` (`nick`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat`
--

LOCK TABLES `chat` WRITE;
/*!40000 ALTER TABLE `chat` DISABLE KEYS */;
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
INSERT INTO `comidas` VALUES (1,1,'Desayuno','Copos de avena con leche','B-dbqL7gNv4'),(2,1,'Desayuno','Yogur con copos de avena','gVfttCZ0fs4'),(3,1,'Desayuno','Tortitas de avena','oGroq7a0bdU'),(4,2,'Desayuno','Porridge de avena y frutos secos','h9GavXyTtrU'),(5,2,'Desayuno','Requeson con fruta','Rs2c3jjYp1s'),(6,2,'Desayuno','Sandwich de queso gouda con huevo duro','Qp0cwY_Omfo'),(7,2,'Desayuno','Batido de platano y avena','nRgayAD5-TI'),(8,3,'Desayuno','Smoothie Bowls','HaIDT_3bLC0'),(9,3,'Desayuno','Hotcakes de avena y quinoa','jEv23vDoLso'),(10,3,'Desayuno','Pudin','iTsmADW4f2M'),(11,3,'Desayuno','Wrap de pavo','Uv7tIHbK1Pc'),(12,1,'Comida','Ensalada de calabacin a la plancha con queso feta','DOuQbt9oARw'),(13,1,'Comida','Albondigas de merluza y brocoli','yNSvCS4C5sw'),(14,1,'Comida','Pechuga de pollo con soja y verduras salteadas','FkWNwE_8HLI'),(15,1,'Comida','Caldo de verduras con tortilla francesa','OKNVtOy-voE'),(16,2,'Comida','Ensalada de patata hervida, tomate, pepino y huevo duro','HC0I9cOyeKU'),(17,2,'Comida','Wok de verduras al curry con tiras de pollo','_SmPsDz-FNQ'),(18,2,'Comida','Berenjena y calabacin asado con pimenton dulce','NoPU6BHz7MA'),(19,2,'Comida','Pure de calabaza con patata hervida','ljW05txkbgQ'),(20,2,'Comida','Tomates rellenos de lentejas','G5UXbOAPPE0'),(21,2,'Comida','Revuelto de gambas y champinones','EvYgm5grrZ4'),(22,3,'Cena','Pollo con verduras y queso batido al papillote','L8ZCOeItiD4'),(23,3,'Cena','Salmon al horno con salsa de yogur','9ULcnMnAOY'),(24,3,'Cena','Sopa de pasta y hamburguesa con naranja picada','mB82tHlelQc'),(25,3,'Cena','Crema de verduras y pechuga de pollo con manzana','8pj0BtRXN84'),(26,3,'Cena','Croquetas de pescado con pure de patata','UdYgR9teHHA'),(27,3,'Cena','Pollo a la naranja','pS73hquOCcg'),(28,3,'Cena','Garbanzos con espinacas','_7OuTWNKdpQ'),(29,3,'Cena','Arroz tres delicias','GnUxt3Qus4Q'),(30,1,'Cena','Ensalada de patata hervida, tomate, pepino y huevo duro','HC0I9cOyeKU'),(31,1,'Cena','Wok de verduras al curry con tiras de pollo','_SmPsDz-FNQ'),(32,2,'Cena','Hamburguesa de jamon york con mayonesa y queso','b_fhENSnCv0'),(33,2,'Cena','Minipizza cuatro quesos con naranja troceada','v3-WUoR5pE4'),(34,1,'Comida','Pescado blanco a la plancha con ensalada de lechuga','Z2kaRbM9_0M'),(35,1,'Comida','Revuelto de dos huevos con verduras','C_19Ga14b7o'),(36,1,'Comida','Menestra de acelgas, zanahoria y patata','erv0QCD6yJg'),(37,1,'Comida','Alcachofas al horno y muslo de pollo a la plancha','Z_lyxrlXDDo'),(38,1,'Comida','Kinoa con verduras','7k8qUKdb1nQ'),(39,1,'Comida','Berenjena rellena de verduras y arroz integral','2iSG_MO6Bfw'),(40,2,'Comida','Pasta con setas salteadas','SI6rdKaLZ-s'),(41,2,'Comida','Arroz con pollo a la plancha','rgXc3RIxGf0'),(42,2,'Comida','Cocido','mAHJWcYONsQ'),(43,2,'Comida','Lentejas','_Dcrxs-f61A'),(44,2,'Comida','Pollo con almendras chino','8CVXYvMlUz4'),(45,2,'Comida','Fingers de pollo casero con salsa picante','23IU_c4HVww'),(46,2,'Comida','Arroz integral con pasas y almendras','D0DZVDpfF8s'),(47,2,'Comida','Pollo picante con cuscus','136YHCFHmv0'),(48,2,'Comida','Pasta cremosa con pollo cajun','azPcIZXiWjo'),(49,2,'Comida','Paella con pollo y chorizo','RCGumB75MLI'),(50,2,'Comida','Hamburguesa de pollo zingy','52ofs6voj_Y'),(51,2,'Comida','Quesadilla de pavo y aguacate','xgorUAS10Rk'),(52,3,'Comida','Pollo a la naranja','pS73hquOCcg'),(53,3,'Comida','Garbanzos con espinacas','_7OuTWNKdpQ'),(54,3,'Comida','Arroz tres delicias','GnUxt3Qus4Q'),(55,3,'Comida','Conejo al horno con verduras','BaoEYLXtDoc'),(56,3,'Comida','Salteado de verduras con pollo a la plancha','YzM5ASZfvHs'),(57,3,'Comida','Tortilla de patatas con mayonesa','lv9J3UgYZ5w'),(58,3,'Comida','Lasana de verduras','DrInBvbmBAM'),(59,3,'Comida','Tallarines chinos con gambas','4cXb5NHVJU8'),(60,3,'Comida','Merluza al horno con verduras','9s8s8KAJ2Ao'),(61,3,'Comida','Revuelto de bacalao','U_O1O1-ttBk'),(62,3,'Comida','Atun a la plancha con ajo y perejil','WcvWDNvqrA0'),(63,1,'Desayuno','Tostada de pan integral con aguacate','oe18SYFTJEU'),(64,2,'Desayuno','Gofres proteicos','f0xOuJToKFw'),(65,2,'Desayuno','Brownie proteico','yXWhqcsQvJk'),(66,2,'Desayuno','Gachas de avena proteicas','mxn_4vn2VpA'),(67,2,'Desayuno','Muffins proteicos de yogurt helado','MdioDJq_VrI'),(68,2,'Desayuno','Vasitos de cheescake','3Z7vJMAQl1c'),(69,2,'Desayuno','Bocaditos proteicos de masa de galleta','JCfXci6Vlp8'),(70,3,'Desayuno','Puding','iTsmADW4f2M'),(71,3,'Desayuno','Wrap de pavo','Uv7tIHbK1Pc'),(72,3,'Desayuno','Pan de platano relleno de cheesecake','K-Z5MLcSKQ0'),(73,3,'Desayuno','Tortitas proteicas de platano','3SJ251EMiXk'),(74,1,'Cena','Berenjena y calabacin asado con pimenton dulce','NoPU6BHz7MA'),(75,1,'Cena','Pure de calabaza con patata hervida','ljW05txkbgQ'),(76,1,'Cena','Tomates rellenos de lentejas','G5UXbOAPPE0'),(77,1,'Cena','Revuelto de gambas con champinones','EvYgm5grrZ4'),(78,1,'Cena','Pate de humus','_zeG2g94GAo'),(79,2,'Cena','Filete de buey con patata al horno y verduras','veCqkuoMjLc'),(80,2,'Cena','Macarrones con pisto','yFXAlRI_-nI'),(81,2,'Cena','Ravioli con jamon york y tomate fresco','EMu3yVfuHkA'),(82,2,'Cena','Ensalada de arroz con atun y mayonesa','5VY9hSR4qjc'),(83,2,'Cena','Tagliatelle con salmon y nata','Wg8AJCJmd-I'),(84,3,'Cena','Conejo al horno con verduras','BaoEYLXtDoc'),(85,3,'Cena','Salteado de verduras con pollo a la plancha','BaoEYLXtDoc'),(86,3,'Cena','Tortilla de patatas con mayonesa','lv9J3UgYZ5w'),(87,3,'Cena','Lasana de verduras','DrInBvbmBAM');
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
  KEY `id_rutina` (`id_rutina`),
  KEY `Ejercicio_FK` (`id_ejercicio`),
  CONSTRAINT `Ejercicio_FK` FOREIGN KEY (`id_ejercicio`) REFERENCES `ejercicios` (`id_ejercicio`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Idrut_FK` FOREIGN KEY (`id_rutina`) REFERENCES `rutina` (`id_rutina`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contiene`
--

LOCK TABLES `contiene` WRITE;
/*!40000 ALTER TABLE `contiene` DISABLE KEYS */;
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
/*!40000 ALTER TABLE `dieta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ejercicios`
--

DROP TABLE IF EXISTS `ejercicios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ejercicios` (
  `id_ejercicio` int(5) NOT NULL AUTO_INCREMENT,
  `tipo` int(1) NOT NULL,
  `musculo` varchar(40) DEFAULT NULL,
  `nombre` varchar(40) DEFAULT NULL,
  `descripcion` mediumtext NOT NULL,
  PRIMARY KEY (`id_ejercicio`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ejercicios`
--

LOCK TABLES `ejercicios` WRITE;
/*!40000 ALTER TABLE `ejercicios` DISABLE KEYS */;
INSERT INTO `ejercicios` VALUES (1,2,'Hombro','Elevacion lateral','Tomando aire elevamos las mancuernas hasta que los brazos queden alineados con los hombros y desde alli­ bajamos lentamente mientras exhalamos. Las elevaciones laterales se pueden hacer con ambas manos juntas o tambien, alternando un brazo y otro.'),(2,0,'Hombro','Press hombro','Las mancuernas deben quedar a la altura de los hombros y las palmas de las manos cerradas mirando hacia delante. Activando los musculos de los brazos y los hombros, levanta lentamente el peso por encima de tu cabeza, haciendo una forma triangular que termine con ambas pesas juntas encima de la cabeza.'),(3,1,'Hombro','Remo al menton','Primero colocate de pie y sujeta la barra con ambas manos. Es importante que las manos esten, como minimo, separadas a una anchura igual a la del torso. La espalda debe estar totalmente recta y los brazos, estirados. Coge aire antes de comenzar el ejercicio. En segundo lugar, levanta la barra de forma continua y sin parar, hasta que alcances el menten. Esta debe mantenerse muy cerca del cuerpo. Manten la posicion unos segundos. Finalmente, baja de forma lenta y continua, para comenzar el ciclo de nuevo.'),(4,0,'Hombro','Press militar','Cogemos la barra con las manos en pronacion (con las palmas mirando hacia adelante). Las manos deben situarse a una anchura algo superior a la de los hombros. Sacamos la barra de su soporte y la colocamos sobre la parte alta de nuestro pecho, a la altura de nuestras claviculas.'),(5,0,'Pierna','Sentadilla','Abre tus piernas hasta el ancho de tus hombros. Junta tus manos o estira tus brazos en un Ã¡ngulo de 90 grados. Cuando vayas a bajar, manten los gluteos hacia atras. Haz como si fueras a sentarte en una silla imaginaria. A continuacion repite el ejercicio.'),(6,0,'Pierna','Prensa','Para colocarse: sentarse en la prensa inclinada de piernas y situando un pie en el centro de la plataforma. Hay que mantener el pie recto o un poco girado hacia fuera. No apoyes la cabeza en el respaldo. Manten una posicion neutra con los ojos mirando la plataforma. Ten el pecho elevado y la zona lumbar bien apoyada. Sobre el movimiento: libera el peso de los topes de seguridad. Dobla la pierna para bajar la plataforma hasta que la rodilla casi toque el pecho. No permitais que la cadera se eleve para aumentar el recorrido. Parar durante un segundo y estira la pierna empujando el peso, pero detente justo antes de bloquear la rodilla. Repitelo.'),(7,1,'Pierna','Extension de cuadriceps','Sientate en una silla y apoya los pies en el suelo separados el ancho de las caderas. Manten la espalda recta. Extiende la rodilla izquierda hacia delante y contrae los musculos del cuadriceps. Vuelve a la posicion inicial y repite las veces indicadas. Repite el mismo proceso con la pierna derecha.'),(8,1,'Pierna','Hip thrust','Empuja con los talones. Asegarate que las espinillas esten verticales en la parte mas alta del movimiento. Manten las rodillas hacia afuera. Logra una extension completa de cadera. Ligeramente inclina posteriormente la pelvis. Manten las costillas abajo.Manten la vista al frente. Entierra los brazos en la banca. Respira hondo y contrae el core antes de cada levantamiento. Haz una pausa en el tope y aprieta los gluteos. '),(9,0,'Pecho','Press banca','Tumbate en un banco plano y echa los hombros hacia atras. La linea extendida desde los hombros hasta las vertebras lumbares debe estar apoyada en el banco. La cabeza estara apoyada sobre el banco, mientras que las piernas formaran un angulo de 90º en el suelo. Lleva la barra a la altura de los hombros, con las munecas rectas y las manos rodeando firmemente la barra. Realiza el movimiento, tomando aire al mismo tiempo que contraes gluteos, espalda y omoplatos fijos. Al respirar profundamente aliviaras la presion de la columna y estabilizar la parte central del cuerpo. Coloca la barra sobre el pecho de forma lenta y controlada. Elevala con un movimiento contundente.'),(10,2,'Pecho','Aperturas con mancuernas','Para comenzar el ejercicio debemos tumbarnos de espalda sobre un banco plano y estrecho para que durante el movimiento no nos moleste en los hombros. Con mancuernas en ambas manos cuyas palmas deben mirar hacia el centro del cuerpo y manteniendo los brazos levemente flexionados en vertical al cuerpo, sobre el pecho, inspiramos y separamos los brazos del cuerpo hasta llegar a la altura de los hombros y que los codos pasen mas abajo que estos, es decir, mantenemos los brazos alineados entre si­, perpendicular al cuerpo y paralelos al suelo.'),(11,0,'Pecho','Press banca inclinado','Sientate en el banco y lleva las mancuernas a los lados del pecho. Empuja las mancuernas hacia el techo, pero sin bloquear completamente los codos. A continuacion, baja las mancuernas de forma lenta y controlada de nuevo hacia el pecho. Haz una pausa de 1-2 segundos en la parte baja del ejercicio y, sin perder la tension en los brazos, repite el mismo proceso las veces indicadas.'),(12,1,'Pecho','Maquina de empuje','Ajusta la altura del asiento para que los agarres queden a la altura de los hombros o un poco por debajo. Sientate erguido con la espalda contra el acolchado y coloca los pies sobre el suelo directamente bajo las rodillas y separados aproximadamente a la anchura de los hombros. Sujeta los agarres con las palmas mirando hacia fuera. Toma aire y aguanta la respiracion mientras empujas para llevar los agarres lejos del cuerpo. Expulsa el aire despuÃ©s de pasar la parte mas difi­cil del movimiento o cuando los brazos esten completamente extendidos. Haz una pequena pausa y regresa a la posicion inicial. Cuando las manos se aproximen a la altura del pecho, cambia rapidamente la direccion del movimiento y repite.'),(13,0,'Triceps','Fondos','Los fondos pueden hacerse en barras paralelas de modo que se trabaja de forma intensa el pectoral y el tri­ceps colocando los brazos estirados a la anchura de los hombros y elevando y descendiendo el cuerpo en vertical hasta hacer un Ã¡ngulo de 90 grados con el codo.'),(14,1,'Triceps','Press frances','Nos colocamos en un banco plano y cogemos la barra con un agarre prono. Ponemos los antebrazos flexionados y los brazos en vertical. Cogemos el aire y efectuamos una tension de los codos, llegando la barra hasta la frente, pero sin llegar a tocarla. En la vieja escuela, este ejercicio era conocido como el rompefrentes. Conforme estes bajando la barra a la frente, evita separar los codos, porque perderas reclutamiento de fibras del tri­ceps. Centrate en juntar ambos codos a la cabeza.'),(15,2,'Triceps','Extensiones','Para comenzar este ejercicio debemos posicionarnos de pie frente al aparato de polea alta, y habiendo seleccionado el peso a utilizar, debemos tomar con las manos el mago de manera que las palmas miren hacia el suelo. Con los brazos pegados al torso y los codos siempre alineados con el cuerpo, comenzamos el movimiento. Realizamos una extension de los codos, llevando el mango de la polea hacia abajo, sin despegar los codos de los lados del cuerpo y unicamente movilizando el antebrazo. Espiramos al final del movimiento y regresamos lentamente a la posicion inicial.'),(16,1,'Triceps','Barras paralelas','Es muy importante cuidar la ejecucion de cada ejercicio, vigilando la postura y protegiendo la espalda, intentando mantenerla siempre recta. Con una mano en cada barra, nos elevamos con los brazos firmes y estirados, nos inclinamos ligeramente hacia delante y comenzamos con la bajada hasta que nuestros brazos formen un angulo de 90º aproximadamente. Mantenemos la posicion un segundo y subimos de forma explosiva hasta la posicion inicial.'),(17,2,'Biceps','Curl spider','Te apoyas contra un banco inclinado de forma inversa. Coge la mancuerna en supinacion (palmas hacia delante), empezar por hacer el curl spider en el brazo derecho, llevando la mancuerna hasta el bi­ceps  hasta que este totalmente contraido. Despues de tener el bi­ceps derecho contraido, bajar lentamente hasta que tu brazo derecho este completamente extendido. A medida que baja el bi­ceps derecho, iniciar el mismo movimiento con el bi­ceps izquierdo alternando de esta forma cada brazo.'),(18,1,'Biceps','Predicador','Coge con ambas manos la barra que se une al cable de la polea. Realiza un movimiento de curl acercando la barra hacia los hombros, sujeta la polea en esta posicion durante unos segundos, y lentamente comienza a extender los brazos hasta que estos vuelvan a su posicion inicial y repite.'),(19,1,'Biceps','Martillo','Colocate de pie, con las rodillas ligeramente flexionadas y coge una mancuerna en cada mano, de tal manera que las palmas se miren entre ellas. Asi, el peso se descarga sobre las piernas y no sobre la columna vertebral. Manten la espalda recta durante el desarrollo de todo el ejercicio. Los brazos deben estar extendidos a lo largo de los costados, debemos tratar de no movilizar el brazo y codo, unicamente el antebrazo. Inhalamos y procedemos a realizar una flexion de codo con uno de los brazos y asi­ de forma alterna, manteniendo la posicion de los brazos. '),(20,1,'Biceps','Chin-ups','Coloca las manos sobre la barra, alineadas con los hombros (o a un poco menos distancia), con las palmas hacia adentro, es decir, con un agarre en supinacion. Con los brazos extendidos, aprieta los omoplatos ligeramente, echando los hombros hacia atras. Imagina que intentas exprimir una naranja grande entre los hombros. Intenta tensar los musculos abdominales, o llevar el ombligo hacia dentro hacia la columna vertebral. Esto te ayudara a activar el nucleo y mejorar el equilibrio. Tira del torso hacia arriba con los bi­ceps y aprieta los omoplatos. Yo me visualizo usando los brazos/biceps cuando estoy abajo y los musculos de la espalda cuando estoy casi en la parte de arriba del movimiento. Pausa un momento cuando estes arriba y lentamente, y con control, baja a la posicion inicial. La fase de descenso debe durar entre 2 y 3 segundos y debes evitar bloquear completamente los codos al extender los brazos.'),(21,0,'Espalda','Jalon','Primero, asegarate de que la barra larga este bien enganchada a la maquina. Ajusta el rodillo a la medida adecuada para bloquear tus piernas. Sujeta la barra con las palmas de las manos mirando hacia delante (agarre en pronacion) y con una separacion de mas del ancho de los hombros. Incli­nate ligeramente hacia atras (unos 20 grados aproximadamente), saca pecho y contrae el abdomen. Tira de la barra hacia la parte superior del pecho mientras aprietas los omoplatos. Los codos deben moverse hacia abajo y no hacia atras. De forma lenta y controlada, lleva la barra a la posicion inicial estirando completamente los brazos y estirando los dorsales. Repite el proceso las veces indicadas.'),(22,0,'Espalda','Remo en T','Colocate de pie frente a la maquina de barra en T con las rodillas ligeramente flexionadas. Tu espalda debe mantener en una postura recta. Ajusta la altura de la maquina, para que puedas recostar tu pecho en una inclinacion de 45° sobre la almohadilla del banco de la maquina. Tome la barra con firmeza y posicianela frente a usted con los brazos extendidos. Inhale y jale la barra hasta que llegue al pecho. Exhale una vez finalizado el movimiento. Vuelva a la posicion inicial de forma suave.'),(23,1,'Espalda','Remo con barra','Mirada al frente (ligeramente al suelo), toda tu columna debe estar alineada. Movimiento de retraccion escapular, e iniciamos el tiron de los codos, junto a la ejecucion de una leve disociacion lumbopulvica (esto evita el aumento de tension en las lumbares). Las munecas deben permanecer en la misma posicion durante todo el movimiento, rectas, bloqueadas. Al tiempo que se flexionan los brazos los codos van hacia afuera y terminan el movimiento en la posicion mas alta de nuestro cuerpo. Nos daremos cuenta que para terminar de ejecutar el remo con barra correctamente, en la posicion alta, las escapulas tienden a tocarse.'),(24,1,'Espalda','Remo mancuernas banco','Necesita colocar un banco inclinado a 360 para hacer el ejercicio. Seleccione el peso adecuado de las mancuernas. Coja las pesas, sientese en el banco y descanse el pecho sobre la almohadilla. Su cabeza debe estar mas alta que el banco. Los pies deben estar en el suelo y los brazos deben estar rectos. Retrayendo los omoplatos, levante las mancuernas hacia los lados de su pecho mientras exhala. Mientras hace el ejercicio, mueva solo el brazo, asegurese de no mover ninguna otra parte de su cuerpo. Vuelva a la posicion inicial con un suave movimiento mientras inhala.');
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresas`
--

LOCK TABLES `empresas` WRITE;
/*!40000 ALTER TABLE `empresas` DISABLE KEYS */;
INSERT INTO `empresas` VALUES (5,'Emfit'),(10,'energyFitness'),(1,'facebook'),(11,'fitnessCenter'),(9,'goldgym'),(7,'HSN'),(6,'Iogenix'),(4,'Lifepro'),(3,'Myprotein'),(8,'Potential'),(2,'Prozis'),(12,'theGym');
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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `foro`
--

LOCK TABLES `foro` WRITE;
/*!40000 ALTER TABLE `foro` DISABLE KEYS */;
INSERT INTO `foro` VALUES (27,31,'&iquest;Creatina-&gt;p&eacute;rdida de pelo?','pintus','2022-04-19 15:27:25','La creatina, &aacute;cido &alpha;-metil guanido-ac&eacute;tico, es un &aacute;cido org&aacute;nico nitrogenado que se encuentra en los m&uacute;sculos y c&eacute;lulas nerviosas de algunos organismos vivos. Se puede obtener tanto de manera natural como de manera artificial como suplemento','Dieta',0),(29,32,'&iquest;Alimentos-&gt;perder peso?','anakin','2022-05-12 19:46:29','Quiero encontrar alimentos que puedan servirme para perder peso, ya que me lo ha recomendado el m&eacute;dico y quiero ponerme las pilas. &iquest;Que me recomendais para ello?','Dieta',0),(30,32,'Importancia de las vitaminas en nuestra nutricion','anakin','2022-05-12 19:53:41','&iquest;Como son de importantes las vitaminas en nuestra nutricion? &iquest;Deberiamos incluir complementos en nuestra alimentacion para tener mayores cantidades de vitaminas?','Nutricion',0);
/*!40000 ALTER TABLE `foro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `likes` (
  `id_usuario` int(5) unsigned NOT NULL,
  `id_mensaje` int(5) unsigned NOT NULL,
  KEY `id_usuario` (`id_usuario`),
  KEY `id_mensaje` (`id_mensaje`),
  CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `personas` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`id_mensaje`) REFERENCES `mensaje` (`id_mensaje`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `likes`
--

LOCK TABLES `likes` WRITE;
/*!40000 ALTER TABLE `likes` DISABLE KEYS */;
INSERT INTO `likes` VALUES (32,31),(32,36),(32,37),(32,39);
/*!40000 ALTER TABLE `likes` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mensaje`
--

LOCK TABLES `mensaje` WRITE;
/*!40000 ALTER TABLE `mensaje` DISABLE KEYS */;
INSERT INTO `mensaje` VALUES (12,31,NULL,27,'Contexto','La creatina, &aacute;cido &alpha;-metil guanido-ac&eacute;tico, es un &aacute;cido org&aacute;nico nitrogenado que se encuentra en los m&uacute;sculos y c&eacute;lulas nerviosas de algunos organismos vivos. Se puede obtener tanto de manera natural como de manera artificial como suplemento','2022-04-19 15:27:25',0),(16,31,NULL,27,'Creatina buena o no','Merece la pena tomar creatina? O se produce mucha perdida de cabello. La perdida es gradual o de golpe?','2022-04-19 15:35:34',0),(17,32,NULL,27,'Mi experiencia con la creatina','Yo tomo creatina pre-entreno y no tengo problemas de cabello eso es un mito','2022-04-19 15:51:20',0),(18,38,16,27,'Experiencia con creatina de conocidos','Mi novio ha empezado a tomar creatina y le veo con menor cantidad de pelo, te dir&iacute;a que la p&eacute;rdida es de golpe','2022-04-19 15:55:42',1),(19,32,18,27,'Mi experiencia con la creatina','Yo la tomo y noto mi cabello igual de denso y fuerte, la p&eacute;rdida depende de las hormonas. La creatina no lo induce, ya que la creamos con nuestro propio cuerpo','2022-04-19 15:56:56',2),(20,31,NULL,27,'asdf','asdf','2022-04-21 10:09:42',0),(21,31,NULL,27,'asdf','asdf','2022-04-21 10:09:46',0),(22,31,NULL,27,'asdf','asdf','2022-04-21 10:09:50',0),(23,32,NULL,27,'prueba1','jsjsjsjs','2022-05-09 21:43:17',0),(25,32,12,27,'Prueba 1','contenido prueba 1','2022-05-09 21:55:13',1),(31,32,NULL,29,'Contexto','Quiero encontrar alimentos que puedan servirme para perder peso, ya que me lo ha recomendado el m&eacute;dico y quiero ponerme las pilas. &iquest;Que me recomendais para ello?','2022-05-12 19:46:29',0),(32,32,31,29,'Alimentaci&oacute;n buena -&gt; perder peso? ','Yo creo que es un mito, sin ejercicio no se puede perder peso','2022-05-12 19:47:19',1),(33,32,31,29,'Alimentos beneficiosos para perder peso','Te verde: adem&aacute;s de ser delicioso ayuda a acelerar nuestro metabolismo y a disminuir antojos rapidamente. SUERTE!','2022-05-12 19:48:07',1),(34,32,32,29,'Otro alimento para perder peso','Almendras: en general la mayoria de las nueces son excelentes para perder peso debido a su alto contenido de grasas mono-insaturadas. Nos ayudan a combatir antojos','2022-05-12 19:49:07',2),(35,32,34,29,'Oro de espa&ntilde;a','Aceite de oliva: es otra fuente de acidos grados mono-insaturados que nos ayuda a controlar nuestros antojos','2022-05-12 19:50:39',3),(36,32,NULL,30,'Contexto','&iquest;Como son de importantes las vitaminas en nuestra nutricion? &iquest;Deberiamos incluir complementos en nuestra alimentacion para tener mayores cantidades de vitaminas?','2022-05-12 19:53:41',0),(37,32,36,30,'Vitamina D','La vitamina D es una vitamina liposoluble que cumple diferentes funciones en el organismo, entre las que destaca la de servir como veh&iacute;culo para la absorci&oacute;n del calcio por parte del organismo, un mineral que es esencial para el desarrollo y crecimiento de los huesos y para mantenerlos fuertes','2022-05-12 19:54:07',1),(38,32,36,30,'Cuidado con los suplementos vitaminicos','Los suplementos diet&eacute;ticos, aunque pueden ser beneficiosos para la salud del organismo, es necesario consumirlo de forma temporal, si en realidad tenemos deficiencia de vitaminas. Jam&aacute;s debe utilizarse como una suplantaci&oacute;n de alimentos naturales.','2022-05-12 19:55:19',1),(39,32,37,30,'Vitamina A','Tambi&eacute;n conocida como retinol, es com&uacute;nmente conocida por sus incre&iacute;bles beneficios para la piel. No obstante, este nutriente tambi&eacute;n contribuye a mantener una visi&oacute;n saludable y fortalece al sistema inmunitario. Las zanahorias, el piment&oacute;n, los mangos, guisantes verdes y las hojas de nabo, entre otros, son una fuente natural de vitamina A.','2022-05-12 19:56:03',2),(40,32,37,30,'Omega-3',' contribuye a prevenir enfermedades cardiovasculares, as&iacute; como ayuda a mantener el colesterol en niveles saludables.  Se encuentra en los pescados y mariscos, en las nueces y aceites como el de soja, canola o linaza.  ','2022-05-12 19:56:44',2);
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
  `fecha` date NOT NULL,
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
INSERT INTO `noticias` VALUES (1,31,'Condenado un gimnasio de Sevilla por la agresión de un monitor a un usuario que se quejó por no usar mascarillas','Cuando está a punto de desaparecer la obligatoriedad del uso de las mascarillas en los interiores, llega una sentencia por un incidente dentro de un gimnasio. La empresa que gestiona un gimnasio de San Bernardo ha sido condenada como responsable civil subsidiaria por las lesiones que le produjo, durante una agresión, uno de sus monitores a un socio del mencionado centro deportivo. La sentencia, asimismo, condena al monitor por un delito de lesiones.  Los hechos juzgados ocurrieron el 17 de noviembre de 2021, cuando el socio agredido recriminó al monitor que hubiera socias en la sala de fitness sin la mascarilla obligatoria. La sentencia del juzgado de Instrucción número 18 de Sevilla, a la que ha tenido acceso este periódico, recoge entre los hechos probados que el usuario requirió al monitor para que \"exigiese a otros usuarios que se cubrieran la cara y nariz con la mascarilla\" como a él se lo exigía.  La conversación se desarrolló en tono \"poco cordial\", dice la juez, que añade que el cliente le dijo al monitor que \"hiciera su trabajo\", a lo que el monitor le respondió: \"Usted no es nadie para decirme cuál es mi trabajo\". Dice el fallo que el denunciante \"pudo llamar subnormal\" al monitor mientras bajaba al vestuario, por lo que al oírlo el condenado,  A. R. N.,  lo siguió, prosiguiendo la discusión entre ambos, y el monitor llamó \"tonto y subnormal\" al cliente. En un momento dado, el monitor golpeó al cliente en el brazo derecho, \"agarrándolo y zarandeándolo con fuerza causándole tendinitis del manguito de los rotadores\" y tardó siete días en curar.','2022-04-01'),(2,31,'La diferencia de entrenar en el gimnasio con o sin mascarilla: así afecta a la respiración y al corazón','Uno de los contextos en los que el uso de mascarillas ha generado más dudas y controversias es en la práctica de la actividad deportiva. Y es que al mismo tiempo que el esfuerzo físico favorece el contagio del virus (ya que aumenta la proyección de partículas de saliva que pueden ser transmisoras), muchas personas reportaban una mayor incomodidad al tratar de ejercitarse con la mascarilla e incluso se mostraban preocupadas por que dificultase su respiración de manera dañina.\r\n\r\nSin efectos significativos\r\nAhora, el fin de la obligación de llevar la mascarilla incluso en espacios interiores debería aliviar definitivamente esos miedos. No obstante, lo cierto es que parece ser que siempre fueron infundados.\r\n\r\nAsí lo ha puesto de manifiesto un estudio llevado a cabo por investigadores del centro Langone Health de la Universidad de Nueva York, que ha sido aceptado para su publicación en el medio especializado Sports Medicine y que presentaron en la convención anual de la Academia Americana de Cirujanos Ortopédicos.\r\n\r\nTal y como recoge el medio Medscape, el trabajo en cuestión, una revisión sistemática de la evidencia disponible hasta el momento, concluye que los individuos sanos pueden realizar ejercicio físico intenso con las mascarillas habitualmente empleadas para prevenir el contagio de la covid-19 con mínimos cambios fisiológicos.\r\n\r\nConcretamente, los autores han explorado 22 investigaciones sobre un total de 583 personas, en las que se observó que llevar mascarilla no tuvo ningún efecto significativo en los principales parámetros fisiológicos: la frecuencia cardíaca, la frecuencia respiratoria, la saturación de oxígeno en sangre y el agotamiento percibido. Estos resultados eran también extensibles a las mujeres embarazadas e incluso a los niños.\r\n\r\nDe la misma manera, estas conclusiones se aplicaban tanto a las tradicionales mascarillas quirúrgicas como a las mascarillas FFP2/N95, las dos más comúnmente empleadas.\r\n\r\nAún así, los investigadores resaltan que los estudios recogidos no son de gran calidad, ya que tienden a utilizar cohortes muy pequeñas. La retirada de las mascarillas en numerosos países podría en este sentido frenar la investigación sobre este asunto; sin embargo, los autores creen que el campo seguirá siendo relevante de cara a futuros brotes de covid-19 o incluso ante otras futuras epidemias de enfermedades respiratorias.','2022-04-05'),(3,31,'Los gimnasios respiran 700 días después: \"La gente está muy contenta\"','Es incómodo, aseguran; sudas, se te moja la mascarilla, no puedes respirar bien... Por eso, los usuarios de los gimnasios han recibido con los brazos abiertos y a cara descubierta el fin de la obligatoriedad de utilizar mascarilla cuando levantan pesas, siguen una clase de aerobic o practican spinning. En estos locales, tanto socios como trabajadores han acudido en la inmensa mayoría de los casos sin el cubrebocas a su cita diaria con el deporte.  \"La diferencia es brutal; solo el hecho de respirar mientras hacer las series se nota muchísimo. Es mucho más cómodo\", explican Samuel Ruiz y Miguel Pérez, socios del gimnasio bilbaino Twentyfit. Y no solo eso, \"también el poder ver las caras de las personas se hace raro. Incluso gente que no conocías sin mascarilla ahora la puedes ver\". Estos dos bilbainos no veían el momento de poder acudir al gimnasio sin tener que usar mascarilla, \"y poder entrenar libremente sin ese agobio\", aunque también se alegran de poder ir a la universidad sin ella. \"Tengo ganas de ver a mis compañeros, es mucha diferencia. Hay alumnos que igual han venido nuevo y no les conoces las caras, porque solo coincides en clase. Es más fácil hablar, hacer las presentaciones orales se hacen más cómodas... Es mucho mejor\", coinciden.  Irene Laza y Kosti Gradinau, que entrenaban a unos metros, son de la misma opinión. \"Tenía muchas ganas de poder quitarme la mascarilla en el gimnasio. Ha sido mucho tiempo\", afirmaban. Eso sí, ni el cubrebocas ha impedido que hayan seguido acudiendo durante estos largos años de pandemia. \"Mejor venir sin mascarilla que no venir. Y fondo habremos cogido de fatigarnos tanto con la mascarilla\", bromeaban entre ellos.','2022-04-08'),(4,31,'Programa piloto enseñará a estudiantes de LAUSD sobre cocina y nutrición','El proyecto se apega a recetas culturalmente relevantes para las familias del sur de California, con el fin de dar lugar a hábitos saludables para toda la vida. Algunos representantes de LAUSD hicieron acto de presencia para mostrar su apoyo al programa. Una preparatoria en el distrito de Crenshaw lanzó el martes un programa piloto de gastronomía, en donde los alumnos aprenderán planes de cocina y nutrición.  Los estudiantes de artes culinarios en la preparatoria Dorsey cocinaban salmón el día de hoy.  “Sacamos los ingredientes y luego hacemos equipo para ver quien va a hacer que”, dijo Guadalupe Santiago, estudiante.  Pero hoy fue una clase diferente, ya que se lanzó el programa Common Threads, que busca modificar los métodos de preparación de comida, y tuvieron de invitado a Govind Armstrong, un chef reconocido por su participación en Top Chef, y quien habló sobre su vida con su madre costarricense.  “Mi mamá trabajaba mucho, tenía dos trabajos, pero era muy importante que todos nos sentáramos a comer”, dijo Armstrong.  Y aparte de inspirar a los jóvenes, les pasó sus conocimientos sobre la cocina saludable.','2022-04-10'),(5,31,'Este es el alimento que más calorías tiene del mundo: español y cargado de grasa','¿Cuál crees que es el alimento que tiene más calorías de todos? Probablemente, pienses que se trata de una hamburguesa, de unas patatas fritas o de una palmera de chocolate. Sin embargo, el alimento que más calorías tiene del mundo puede ser saludable, aunque no conviene tomar una gran ración. De hecho, una de sus variantes se produce en gran medida en España y, además, cuenta con una gran fama en todo el mundo.  Se trata del aceite, así en general: tanto el de girasol, como el de coco o, incluso, nuestro aceite de oliva. Si están compuestos por un 100% de aceite, cualquiera de ellos se considera como el alimento más calórico del mundo. Esto se debe a que los aceites contienen un 100% de grasas y estas son el macronutriente con más calorías de todos. Concretamente, cada gramo de grasa contiene 9 kilocalorías. Una tostada con tomate y aceite de oliva. Una tostada con tomate y aceite de oliva.  NUTRICIÓN Este es el alimento que más calorías tiene del mundo: español y cargado de grasa Las grasas son el nutriente que más calorías aporta por cada gramo de peso y, por tanto, el alimento más calórico es muy rico en esta sustancia. 19 abril, 2022 03:36GUARDAR  ACEITE DE OLIVA ESPAÑA GRASAS Silvia Val Noticias relacionadas  Las 4 mejores alternativas al aceite de girasol que \'vuela\' del supermercado  Peligro por aceite de oliva adulterado en España: éstas son las marcas que no debes consumir  Más allá de oliva y girasol: éstos son los aceites alternativos más saludables para la dieta ¿Cuál crees que es el alimento que tiene más calorías de todos? Probablemente, pienses que se trata de una hamburguesa, de unas patatas fritas o de una palmera de chocolate. Sin embargo, el alimento que más calorías tiene del mundo puede ser saludable, aunque no conviene tomar una gran ración. De hecho, una de sus variantes se produce en gran medida en España y, además, cuenta con una gran fama en todo el mundo.  Se trata del aceite, así en general: tanto el de girasol, como el de coco o, incluso, nuestro aceite de oliva. Si están compuestos por un 100% de aceite, cualquiera de ellos se considera como el alimento más calórico del mundo. Esto se debe a que los aceites contienen un 100% de grasas y estas son el macronutriente con más calorías de todos. Concretamente, cada gramo de grasa contiene 9 kilocalorías.  Los carbohidratos y las proteínas, por su parte, contienen cuatro kilocalorías por cada gramo. Es decir, que si un alimento está compuesto al 100% por grasas este es, sin duda, el alimento más calórico. Las palmeras de chocolate, las hamburguesas o las patatas fritas suelen contener varios tipos de nutrientes y, por eso, en proporción nunca superan al aceite. En este sentido, las calorías de los alimentos se suelen calcular por cada 100 gramos.','2022-04-15'),(6,31,'Una nutrición adecuada acelera el metabolismo e incrementa tu energía','Lo que mucha gente desconoce es que para tener un metabolismo veloz es necesario ajustar los horarios de comida e incluso comer más, además de entender cómo el cuerpo procesa los alimentos y cuáles son óptimos para su funcionamiento, lo que genera un impacto en el peso, apetito y niveles de grasa corporal. De acuerdo con la nutrióloga y directora de Worldwide Health Education & Training en Herbalife Nutrition, Michelle Ricker, entre más rápido sea este proceso, más calorías se quemarán.  A pesar de que todos los alimentos proporcionan energía, algunos son mejores para obtenerla de manera sostenida. Carbohidratos complejos, grasas saludables (aguacate y nueces) y proteínas como pollo, pescado, tempeh, huevos, entre otros, calman el hambre pero tardan más tiempo en digerirse y brindan energía de forma lenta y constante, lo que significa un bajo índice glucémico.  Para digerir alimentos con un elevado índice glucémico o comida «chatarra» se necesita de menos energía porque contienen altos niveles de ingredientes refinados, provocando que el cuerpo siga teniendo hambre y mande al cerebro la señal de pedir más comida.','2022-04-17'),(7,31,'“Me dijeron que estaba fumada y hoy me llaman visionaria”: ‘Pickleball’, un nuevo deporte destinado a arrasar','Con cerca de cinco millones de jugadores, este híbrido entre el tenis, el bádminton y el pimpón se ha convertido en un fenómeno en ebullición en Estados Unidos. Varios expertos desgranan los motivos de su éxito y la probabilidad de que acabe triunfando también en nuestro país. Al igual que la de tantos otros en estos últimos dos años, la vida de Xiana López también dio un vuelco radical tras el azote de la covid-19. Trabajadora esencial al ejercer como realizadora de los informativos de La Sexta durante trece años, siguió levantándose a las cuatro y media de la mañana en lo más duro de la crisis sanitaria para rodearse de “fake news, malas noticias y un montón de cosas más” que la llevaron a pensar en un futuro distinto para su familia. “Me propuse que si venía una nueva pandemia me iba a pillar en Hawái, trabajando con mi ordenador desde allí. Y yo tengo un problema, que trato de conseguir lo que me propongo”. Aquel anhelo dio paso a diferentes cursos sobre comercio internacional, cómo vender en Amazon y un extenso estudio de mercado sobre qué tipo de producto podía satisfacer su runrún emprendedor. Hasta que un día, en un trayecto en la salida de la A-7, puso fin a sus anhelos cuando advirtió un cartel que invitaba a probar un deporte desconocido hasta entonces en nuestro país: el pickleball.','2022-04-18'),(8,31,'Los riesgos de las populares \"dietas milagro\"','La obesidad es uno de los principales problemas de salud en España con un 53,6% de prevalencia, según la Encuesta Europea de Salud en el país. Esta situación abre las puertas a las \"dietas milagro\" que se caracterizan por la supuesta rápida pérdida de peso, pero conllevan grandes riesgos. Estas tienen una gran popularidad.  Estas dietas suponen graves peligros para el bienestar de la persona como deficiencias nutricionales, daños en órganos como los riñones o el hígado; y cambios metabólicos que afectan al buen funcionamiento del organismo. La Fundación Española de la Nutrición cuenta que cada vez hay más estudios sobre las dietas, pero que \"la gente prefiere perder peso de forma inmediata y no poco a poco\". También afirman que la dieta mediterránea, es decir, la \"anti dieta\" es la más común.  Para perder peso y no poner en riesgo la salud es importante hacerlo de una manera controlada y guiada por un nutricionista que tenga en cuenta el metabolismo, la composición corporal y el historial clínico, entre otros para el éxito a largo plazo.   \"Cuando terminan este tipo de dietas, hay tanta ansiedad por comer que se recupera lo perdido y se gana más peso. La pérdida de peso saludable y más perdurable en el tiempo es la que implica de 1/2 kilo a 1 kilo de grasa corporal/semana sin perder masa muscular. El nutricionista hace este seguimiento de la corporación corporal con instrumentos de medición (plicómetro, cinta métrica...) y corrige el perfil nutricional de la dieta para evitar la pérdida de masa corporal\", explica Alma Palau, presidenta del Consejo General de Colegios Oficiales de Dietistas-Nutricionistas.  Al utilizar este método se produce un descenso de peso, pero con el paso del tiempo pasa a ser insostenible provocando la privación de nutrientes, la restricción de alimentos y la reducción drástica de calorías. Esto hace que sean poco efectivas, asegurando el \"efecto rebote\" y creando un círculo vicioso que puede comprometer a la salud física a largo plazo.  Por otro lado, las dietas milagro pueden suponer una amenaza para el bienestar mental. \"El supuesto objetivo es conseguir resultados inmediatos y sin esfuerzos, lo que resulta deseable y poco alcanzable. Puede funcionar como detonante de diversos trastornos de conducta alimentaria, especialmente en personas con baja autoestima y fuertes valores estéticos\", dice la psicóloga de BluaU de la entidad, Margarita Carrasco.','2022-04-20'),(9,31,'Vitamina B12: cuáles son sus beneficios y qué pasa si no consumes suficiente','La vitamina B12 pertenece a las ocho vitaminas del grupo B e interviene en numerosos procesos fisiológicos. La B12 es un nutriente que ayuda a mantener sanas las neuronas y los glóbulos sanguíneos y a diferencia de otras, solo se puede obtener de alimentos de origen animal, por lo que las personas con dietas veganas o vegetarianas, pueden llegar a producir síntomas por la falta de ella.  Una dieta equilibrada proporciona las cantidades necesarias de vitaminas que el organismo necesita, ya que estas están presentes en una gran variedad de alimentos, especialmente de origen vegetal. Sin embargo, la vitamina B12 está presente únicamente en alimentos de origen animal, por esta razón, las dietas veganas deben consumir esta vitamina como suplemento nutricional.  De igual modo, esta vitamina desempeña un papel muy relevante en el crecimiento y contribuye al normal desarrollo del sistema nervioso, mientras que la falta de ella, puede provocar anemia, debilidad y sensación de hormigueo en brazos y piernas. La B12, también llamada cobalamina, debido a que contiene cobalto, es una vitamina hidrosoluble esencial que ayuda al metabolismo de proteínas e interviene en numerosos procesos fisiológicos, como la formación de glóbulos rojos en la sangre y el mantenimiento del sistema nervioso central.  Además, contribuye a la elaboración del ADN, el material genético presente en todas las células, y previene la anemia megaloblástica, que provoca cansancio y debilidad, según Medline Plus.  La vitamina B12 es producida, en la naturaleza, por bacterias, por lo que solo los alimentos de origen animal son fuente de B12, por la simbiosis bacteriana. En cambio, no se encuentra en los alimentos vegetales y puede ser producida industrialmente únicamente por fermentación bacteriana.','2022-04-23'),(10,31,'Cinco alimentos clave para mejorar la nutrición de los más pequeños','Según la Organización Mundial de la Salud (OMS) la obesidad, esta acumulación anormal o excesiva de grasa que supone un riesgo para la salud, tiene especial gravedad si se da en la infancia. Esta patología tiene consecuencias nefastas, y la pandemia de la COVID-19, solo ha hecho que aumente más esta afección entre los más pequeños. Según datos de la OMS, en el mundo hay más de 300 millones de personas obesas, aunque las cifras más preocupantes son las referentes a la obesidad infantil. En los países en desarrollo con economías emergentes, la prevalencia de sobrepeso y obesidad infantil entre los niños en edad preescolar supera el 30%. Nuestro país es el tercero en toda Europa con mayor prevalencia de sobrepeso y obesidad infantil con un 14,2% de obesidad infantil y juvenil, tras Grecia (18%) e Italia (15,2%), según los datos de la OMS, cifras que no dejan de aumentar. En este sentido, es durante la infancia cuando se fijan los hábitos alimentarios, y si no se establecen correctamente, son muy difíciles de cambiar. «Con un especialista de la mano y unas rutinas alimentarias adecuadas junto a un estilo de vida saludable, se reducen las posibilidades de que el niño/a pueda sufrir determinadas patologías en su edad adulta», explican fuentes de Deusto Salud. Y añaden: «Además, se evitarán posibles trastornos nutricionales, anemia, sobrepeso u obesidad. La etapa infantil es donde más cambios tanto físicos como intelectuales se producen, y en ello cobra especial importancia la alimentación». Los cinco alimentos clave La hora de sentarse a la mesa no debe de ser nunca un momento traumático para los más pequeños, no se debe forzar a comer ni tampoco a que no lo haga. El objetivo es conseguir que aprendan a alimentarse solos y que disfruten con ello. Una de las maneras de conseguirlo es innovar con recetas e ingredientes diferentes, siempre teniendo en cuenta su valor nutricional, también se puede permitir que contribuyan a la elaboración del plato o preguntándoles que quieren para comer. También es importante establecer horarios regulares para las comidas y crear un hábito en los niños. A continuación Deusto Salud, centro de formación continua, presenta una lista con alimentos con valor nutricional imprescindibles para la buena alimentación de los más pequeños: Huevo. Es uno de los alimentos más nutritivos que existen además de ser una gran fuente de proteínas, contiene pocas grasas y ayuda al crecimiento y la actividad cerebral de los más pequeños. Arándanos. Gracias a su alto contenido en fibra mejora la digestión y ayudan a combatir las infecciones digestivas y urinarias. Son un gran alimento, ya que contienen flavonoides que potencian la memoria y mejoran el aprendizaje. Espinacas. Es un alimento muy completo, puesto que contienen hierro, vitaminas A y C y calcio. Ayudan a fortalecer los huesos, los músculos y el desarrollo cerebral además de reducir el riesgo de padecer enfermedades oculares. Yogur. Contiene una gran fuente de calcio y proteínas, es más fácil de digerir que la leche. Ayuda al correcto desarrollo de los huesos y disminuye las diarreas, además de ser una buena fuente de vitaminas del grupo B y minera  Nutricionistas: la mano derecha de los padres A día de hoy, existen muchos centros que se encargan de formar profesionales de la nutrición infantil que sean capaces de hacer un seguimiento teniendo en cuenta la etapa de desarrollo, sus características personales y sus necesidades en cada etapa de su crecimiento. De hecho desde el equipo d su nuevo curso de Alimentación y Nutrición Pediátrica aseguran que « cada vez más padres buscan ayuda de profesionales en nutrición infantil, para ayudarles a la creación de hábitos saludables y una dieta equilibrada y divertida para sus hijos».','2022-04-30');
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
-- Table structure for table `pertenece`
--

DROP TABLE IF EXISTS `pertenece`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pertenece` (
  `id_producto` int(5) unsigned NOT NULL,
  `id_categoria` int(5) unsigned NOT NULL,
  KEY `Producto_FK` (`id_producto`),
  KEY `Categoria_FK` (`id_categoria`),
  CONSTRAINT `Categoria_FK` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Producto_FK` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pertenece`
--

LOCK TABLES `pertenece` WRITE;
/*!40000 ALTER TABLE `pertenece` DISABLE KEYS */;
/*!40000 ALTER TABLE `pertenece` ENABLE KEYS */;
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
  `nombre` varchar(50) NOT NULL,
  `descripcion` mediumtext NOT NULL,
  `precio` decimal(10,0) unsigned NOT NULL,
  `link` varchar(200) NOT NULL,
  `tipo` enum('proteina','caseina','creatina','aminoacidos','preentreno','gainer') NOT NULL,
  PRIMARY KEY (`id_producto`),
  KEY `id_empresa` (`id_empresa`),
  CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id_empresa`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (1,4,'Life Pro Whey Choco Monky 1kg Limited Edition','Life Pro Whey Protein Choco Monky es una proteína whey hecha con una de las mejores materias primas, LACPRODAN SP-8011. Cuenta con una calidad excelente que la diferencian del resto de proteínas del mercado y con el autentico sabor de las tabletas de chocolate.',32,'https://www.lifepronutrition.com/es/concentrado-suero/life-pro-whey-chocolate-jungle-1kg-limited-edition.html','proteina'),(2,2,'Creatina Creapure','Al utilizar Creapure®, una marca líder en creatina monohidrato producida en Alemania a partir de la mejor materia prima y cumpliendo con los más altos estándares de calidad, Prozis ha logrado crear Creatine Creapure®, un suplemento de creatina de un solo ingrediente para deportistas y sin ninguna de las sustancias adicionales utilizadas por otras marcas como relleno. Creatine Creapure® de Prozis proporciona 3000 mg de la forma de creatina más limpia y eficaz por dosis, de una manera práctica y asequible.',28,'https://www.prozis.com/es/es/prozis/creatina-creapure-300-g','creatina'),(3,5,'Science Casein Black Cookies','La caseina se trata de un complemento alimenticio que gracias a su compleja composición supone un aporte alimenticio a largo plazo para los músculos, por lo que es una excelente opción antes de irse a la cama o durante un viaje largo, porque la digestión puede durar varias horas.',36,'https://www.emfitnutrition.com/science-casein-black-cookies-peanut-butter-crunchy-limited-edition-1kg-efficient-science-p-11204.html','caseina'),(4,3,'Impact EAA','Mezcla nueva y mejorada, con todos los aminoácidos esenciales.',30,'https://www.myprotein.es/nutricion-deportiva/impact-eaa/11985042.html?affil=thggpsad&switchcurrency=EUR&shippingcountry=ES&variation=11985043&affil=mpppc_campaign=71700000048326108&adtype=pla&product_','aminoacidos'),(5,3,'Aislado de Proteína de Guisante','Sin soja ni lácteos, nuestro Aislado de Proteína de Guisante contiene 23 g de proteína por ración, perfecto para aquellos que entrenan con una dieta vegetal. Podrás obtener más información sobre nuestra gama de productos Myvegan.',23,'https://www.myprotein.es/nutricion-deportiva/aislado-de-proteina-de-guisante/10530136.html','proteina'),(6,4,'Wild Pump','Favorece la mejora del rendimiento y ayuda a aumentar los niveles de energía: especialmente, los días en los que realicemos entrenamientos de alta intensidad o que nos sintamos cansados, puede ser el aliado ideal. Gracias al aporte de cafeína, en combinación con los extractos vegetales y minerales, aumenta la claridad mental, el foco y el estado de alerta. Mejora los niveles de fuerza y de resistencia.  Mayor tiempo de entrenamiento: ayuda a posponer la aparición de fatiga y de cansancio: de esta manera, podremos continuar durante un mayor tiempo realizando un entrenamiento de calidad y alta intensidad.  La cafeína tiene efecto termogénico: puede ayudar a la perdida de grasa. Favorece la congestión muscular o sensación de pump. La citrulinamalato, especialmente, es un precursor de la arginina: encargada de mejorar la vasodilatación. ',41,'https://www.lifepronutrition.com/es/preentreno/life-pro-wild-pump-400g.html','preentreno'),(7,7,'Evomass 2.0','Evomass 2.0 (Ganador de peso) de SportSeries es un preparado alimenticio a base de carbohidratos (como la harina de avena) y proteínas en polvo (como el concentrado de proteína de suero de leche - WPC).  Evomass 2.0 está destinado, por su gran aporte enegético, a deportistas intensos que estén sometidos a altas cargas de entrenamiento, culturistas y practicantes de fitness en volumen que busquen un alimento para complementar su dieta, alto en proteínas, en carbohidratos complejos y calorías.',12,'https://www.hsnstore.com/marcas/sport-series/evomass-2-0-ganador-de-peso-1kg-chocolate?gclid=Cj0KCQjwmuiTBhDoARIsAPiv6L97_Z2-RVmDctEMYokMUIkTq2jyGrEbt_a4NBNWj6kvg3ECGPwZTSMaAuxdEALw_wcB','gainer'),(8,2,'Big Shot - Pre-Workout 46 servings','Con una fórmula especial, ideal para entrenamientos de gran fuerza, fomentará tu rendimiento físico en ejercicios de alta intensidad. El óxido nítrico aumentará tu flujo sanguíneo y el complejo de ingredientes presentes en este suplemento potenciará definitivamente la calidad de tus entrenamientos. Gracias a la creatina monohidrato, la arginina, la beta-alanina y la cafeína podrás conseguir grandes logros en tu rendimiento, un gran aumento de energía y una concentración mayor que te llevará directamente a tus objetivos. Esta potente fórmula te ayudará a alcanzar tu siguiente nivel de motivación y a dar un gran paso hacia la perfección. Todos los \"Big Shots\" tienen algo en común: están determinados a superar sus límites, pero serás tú quien podrá llegar aún más lejos.',24,'https://www.prozis.com/es/es/prozis/big-shot-pre-workout-46-servings?ot=GAESSS&campaignid=14564370617&adgroupid=127663082780&keyword=&placement=','preentreno'),(9,3,'Caseína de Liberación Lenta','Al tardar más en ser digerido y utilizado por tu cuerpo, este es el batido perfecto para obtener un aporte de proteínas entre comidas e incluso mientras duermes y así cumplir tus objetivos de entrenamiento. También incluye un perfil completo de aminoácidos, naturalmente presentes en la proteína, que te ayudarán a desarrollar y recuperar tus nuevos músculos1 antes, durante y después de hacer ejercicio para que te despiertes deseando empezar tu siguiente sesión deportiva.',25,'https://www.myprotein.es/nutricion-deportiva/caseina-de-liberacion-lenta/10798909.html?affil=mpppc_campaign=71700000079561931&adtype=&product_id=&gclid=Cj0KCQjw4PKTBhD8ARIsAHChzRIxY7BJgwzYC2IWfspBGeBK','caseina'),(10,4,'Life Pro Creatine Creapure','La fórmula patentada Creapure es un sinónimo de calidad, por lo que esta creatina de LifePro Nutrition, con un 99.9% de pureza se convierte en un suplemento con un nivel de profesionalidad muy alto. Por ello, Life Pro Nutrition Creatine Creapure 500g. es el producto perfecto para todos esos deportistas que quieren complementar su actividad física con la ayuda de productos que impulsen su rendimiento. Además, la creatina es una de las sustancias más importantes del sector, gracias a sus grandes propiedades.',34,'https://www.nutrimarket.com/es/creatina/life-pro-creatine-creapure-500g.html','creatina'),(11,7,'Aminoacidos esenciales (EAAS)','Aminoácidos esenciales (EAA’s) en polvo de RawSeries es un complemento alimenticio en polvo vegano, a base de los 9 aminoácidos esenciales, de fermentación vegetal. Los aminoácidos (proteinogénicos) son los elementos que componen la proteína. Los aminoácidos esenciales son aquellos aminoácidos proteinogénicos que nuestro organismo no puede sintetizar de forma endógena y requiere de su consumo a través de la dieta. Este producto, a diferencia de la mayoría de EAAs del mercado, es 100% apto para vegetarianos y veganos.',7,'https://www.hsnstore.com/marcas/raw-series/aminoacidos-esenciales-eaa-s-en-polvo','aminoacidos'),(12,2,'100% Real Whey Protein','100% Real Whey Protein de Prozis contiene concentrado de proteína de suero de leche de calidad superior en una fórmula altamente concentrada. Esta proteína pura de alto valor biológico aporta un perfil completo de aminoácidos, con BCAA, y te ayudará a incrementar la masa muscular, al tiempo que favorecerá el mantenimiento del tejido muscular que tanto te ha costado ganar. Sometida a rigurosas pruebas en laboratorios avanzados, la composición de 100% Real Whey Protein no tiene ningún secreto que esconder. Con este suplemento, lo que ves en la etiqueta es exactamente lo que añades a tu mezclador. Además, gracias a los procesos tecnológicamente avanzados empleados en su producción, este suplemento en polvo se presenta de forma instantánea para favorecer una mezcla rápida y fácil, proporcionándote un batido suave y sin grumos.',30,'https://www.prozis.com/es/es/prozis/100-real-whey-protein-1000-g?ot=GAESSS&campaignid=14564370617&adgroupid=127663082780&keyword=&placement=','proteina');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rutina`
--

LOCK TABLES `rutina` WRITE;
/*!40000 ALTER TABLE `rutina` DISABLE KEYS */;
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

--
-- Table structure for table `usuariosproductos`
--

DROP TABLE IF EXISTS `usuariosproductos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuariosproductos` (
  `id_usuario` int(5) unsigned NOT NULL,
  `id_producto` int(5) unsigned NOT NULL,
  KEY `id_producto` (`id_producto`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `usuariosproductos_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `usuariosproductos_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuariosproductos`
--

LOCK TABLES `usuariosproductos` WRITE;
/*!40000 ALTER TABLE `usuariosproductos` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuariosproductos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-12 20:01:16
