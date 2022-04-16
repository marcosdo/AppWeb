-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-04-2022 a las 15:43:31
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `lifety`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anuncio`
--

DROP TABLE IF EXISTS `anuncio`;
CREATE TABLE IF NOT EXISTS `anuncio` (
  `id_anuncio` int(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_empresa` int(5) UNSIGNED NOT NULL,
  `contenido` mediumtext NOT NULL,
  `imagen` varchar(30) NOT NULL,
  `orden` int(1) UNSIGNED NOT NULL,
  PRIMARY KEY (`id_anuncio`),
  KEY `Empresa_FK` (`id_empresa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `anuncio`
--

TRUNCATE TABLE `anuncio`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `id_categoria` int(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tipo` enum('proteina','creatina','vitaminas','gainer','aminoacidos','pre-entreno','minerales') NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `categorias`
--

TRUNCATE TABLE `categorias`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat`
--

DROP TABLE IF EXISTS `chat`;
CREATE TABLE IF NOT EXISTS `chat` (
  `Receptor` text NOT NULL,
  `Origen` text NOT NULL,
  `Contenido` mediumtext NOT NULL,
  `Tiempo` datetime NOT NULL,
  `Tipo` enum('U-E','E-U') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `chat`
--

TRUNCATE TABLE `chat`;
--
-- Volcado de datos para la tabla `chat`
--

INSERT INTO `chat` (`Receptor`, `Origen`, `Contenido`, `Tiempo`, `Tipo`) VALUES
('pintus', 'perspa', 'hola que tal', '2022-04-10 15:27:50', 'U-E');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comidas`
--

DROP TABLE IF EXISTS `comidas`;
CREATE TABLE IF NOT EXISTS `comidas` (
  `id_comida` int(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `objetivo` int(1) NOT NULL,
  `tipo` enum('Desayuno','Comida','Cena') NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `link` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id_comida`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `comidas`
--

TRUNCATE TABLE `comidas`;
--
-- Volcado de datos para la tabla `comidas`
--

INSERT INTO `comidas` (`id_comida`, `objetivo`, `tipo`, `descripcion`, `link`) VALUES
(1, 1, 'Desayuno', 'Copos de avena con leche', ''),
(2, 1, 'Desayuno', 'Yogur con copos de avena', ''),
(3, 1, 'Desayuno', 'Tortitas de avena', ''),
(4, 2, 'Desayuno', 'Porridge de avena y frutos secos', ''),
(5, 2, 'Desayuno', 'Requeson con fruta', ''),
(6, 2, 'Desayuno', 'Sandwich de queso gouda con huevo duro', ''),
(7, 2, 'Desayuno', 'Batido de platano y avena', ''),
(8, 3, 'Desayuno', 'Smoothie Bowls', ''),
(9, 3, 'Desayuno', 'Hotcakes de avena y quinoa', ''),
(10, 3, 'Desayuno', 'Pudin', ''),
(11, 3, 'Desayuno', 'Wrap de pavo', ''),
(12, 1, 'Comida', 'Ensalada de calabacin a la plancha con queso feta', ''),
(13, 1, 'Comida', 'Albondigas de merluza y brocoli', ''),
(14, 1, 'Comida', 'Pechuga de pollo con soja y verduras salteadas', ''),
(15, 1, 'Comida', 'Caldo de verduras con tortilla francesa', ''),
(16, 2, 'Comida', 'Ensalada de patata hervida, tomate, pepino y huevo duro', ''),
(17, 2, 'Comida', 'Wok de verduras al curry con tiras de pollo', ''),
(18, 2, 'Comida', '.Berenjena y calabacin asado con pimenton dulce', ''),
(19, 2, 'Comida', 'Pure de calabaza con patata hervida', ''),
(20, 2, 'Comida', 'Tomates rellenos de lentejas', ''),
(21, 2, 'Comida', 'Revuelto de gambas y champinones', ''),
(22, 3, 'Cena', 'Pollo con verduras y queso batido al papillote', ''),
(23, 3, 'Cena', 'Salmon al horno con salsa de yogur', ''),
(24, 3, 'Cena', 'Sopa de pasta y hamburguesa con naranja picada', ''),
(25, 3, 'Cena', 'Crema de verduras y pechuga de pollo con manzana', ''),
(26, 3, 'Cena', 'Croquetas de pescado con pure de patata', ''),
(27, 3, 'Cena', 'Pollo a la naranja', ''),
(28, 3, 'Cena', 'Garbanzos con espinacas', ''),
(29, 3, 'Cena', 'Arroz tres delicias', ''),
(30, 1, 'Cena', 'Ensalada de patata hervida, tomate, pepino y huevo duro', ''),
(31, 1, 'Cena', 'Wok de verduras al curry con tiras de pollo', ''),
(32, 2, 'Cena', 'Hamburguesa de jamon york con mayonesa y queso', ''),
(33, 2, 'Cena', 'Minipizza cuatro quesos con naranja troceada', ''),
(34, 1, 'Comida', 'Pescado blanco a la plancha con ensalada de lechuga', ''),
(35, 1, 'Comida', 'Revuelto de dos huevos con verduras', ''),
(36, 1, 'Comida', 'Menestra de acelgas, zanahoria y patata', ''),
(37, 1, 'Comida', 'Alcachofas al horno y muslo de pollo a la plancha', ''),
(38, 1, 'Comida', 'Kinoa con verduras', ''),
(39, 1, 'Comida', 'Berenjena rellena de verduras y arroz integral', ''),
(40, 2, 'Comida', 'Pasta con setas salteadas', ''),
(41, 2, 'Comida', 'Arroz con pollo a la plancha', ''),
(42, 2, 'Comida', 'Cocido', ''),
(43, 2, 'Comida', 'Lentejas', ''),
(44, 2, 'Comida', 'Pollo con almendras chino', ''),
(45, 2, 'Comida', 'Fingers de pollo casero con salsa picante', ''),
(46, 2, 'Comida', 'Arroz integral con pasas y almendras', ''),
(47, 2, 'Comida', 'Pollo picante con cuscus', ''),
(48, 2, 'Comida', 'Pasta cremosa con pollo cajun', ''),
(49, 2, 'Comida', 'Paella de pollo y chorizo', ''),
(50, 2, 'Comida', 'Hamburguesa de pollo zingy', ''),
(51, 2, 'Comida', 'Quesadilla de pavo y aguacate', ''),
(52, 3, 'Comida', 'Pollo a la naranja', ''),
(53, 3, 'Comida', 'Garbanzos con espinacas', ''),
(54, 3, 'Comida', 'Arroz tres delicias', ''),
(55, 3, 'Comida', 'Conejo al horno con verduras', ''),
(56, 3, 'Comida', 'Salteado de verduras con pollo a la plancha', ''),
(57, 3, 'Comida', 'Tortilla de patatas con mayonesa', ''),
(58, 3, 'Comida', 'Lasana de verduras', ''),
(59, 3, 'Comida', 'Tallarines chinos con gambas', ''),
(60, 3, 'Comida', 'Merluza al horno con verduras', ''),
(61, 3, 'Comida', 'Revuelto de bacalao', ''),
(62, 3, 'Comida', 'Atun a la plancha con ajo y perejil', ''),
(63, 1, 'Desayuno', 'Tostada de pan integral con aguacate', ''),
(64, 2, 'Desayuno', 'Gofres proteicos', ''),
(65, 2, 'Desayuno', 'Brownie proteico', ''),
(66, 2, 'Desayuno', 'Gachas de avena proteicas', ''),
(67, 2, 'Desayuno', 'Muffins proteicos de yogurt helado', ''),
(68, 2, 'Desayuno', 'Vasitos de cheescake', ''),
(69, 2, 'Desayuno', 'Bocaditos proteicos de masa de galleta', ''),
(70, 3, 'Desayuno', 'Pudding', ''),
(71, 3, 'Desayuno', 'Wrap de pavo', ''),
(72, 3, 'Desayuno', 'Pan de platano relleno de cheesecake', ''),
(73, 3, 'Desayuno', 'Tortitas proteicas de platano', ''),
(74, 1, 'Cena', 'Berenjena y calabacin asado con pimenton dulce', ''),
(75, 1, 'Cena', 'Pure de calabaza con patata hervida', ''),
(76, 1, 'Cena', 'Tomates rellenos de lentejas', ''),
(77, 1, 'Cena', 'Revuelto de gambas con champinones', ''),
(78, 1, 'Cena', 'Pate de humus', ''),
(79, 2, 'Cena', 'Filete de buey con patata al horno y verduras', ''),
(80, 2, 'Cena', 'Macarrones con pisto', ''),
(81, 2, 'Cena', 'Ravioli con jamon york y tomate fresco', ''),
(82, 2, 'Cena', 'Ensalada de arroz con atun y mayonesa', ''),
(83, 2, 'Cena', 'Tagliatelle con salmon y nata', ''),
(84, 3, 'Cena', 'Conejo al horno con verduras', ''),
(85, 3, 'Cena', 'Salteado de verduras con pollo a la plancha', ''),
(86, 3, 'Cena', 'Tortilla de patatas con mayonesa', ''),
(87, 3, 'Cena', 'Lasana de verduras', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contiene`
--

DROP TABLE IF EXISTS `contiene`;
CREATE TABLE IF NOT EXISTS `contiene` (
  `id_rutina` int(5) NOT NULL,
  `id_ejercicio` int(5) NOT NULL,
  `dia` int(1) NOT NULL,
  `repeticiones` int(2) NOT NULL,
  KEY `Ejercicio_FK` (`id_ejercicio`),
  KEY `id_rutina` (`id_rutina`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `contiene`
--

TRUNCATE TABLE `contiene`;
--
-- Volcado de datos para la tabla `contiene`
--

INSERT INTO `contiene` (`id_rutina`, `id_ejercicio`, `dia`, `repeticiones`) VALUES
(91, 8, 1, 6),
(91, 9, 1, 14),
(91, 0, 1, 14),
(91, 1, 1, 6),
(91, 20, 2, 6),
(91, 21, 2, 6),
(91, 16, 2, 14),
(91, 17, 2, 8),
(91, 4, 3, 6),
(91, 5, 3, 6),
(91, 12, 3, 6),
(91, 13, 3, 8),
(92, 8, 1, 6),
(92, 9, 1, 14),
(92, 0, 1, 14),
(92, 1, 1, 6),
(92, 20, 2, 6),
(92, 21, 2, 6),
(92, 16, 2, 14),
(92, 17, 2, 8),
(92, 4, 3, 6),
(92, 5, 3, 6),
(92, 12, 3, 6),
(92, 13, 3, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dieta`
--

DROP TABLE IF EXISTS `dieta`;
CREATE TABLE IF NOT EXISTS `dieta` (
  `id_usuario` int(5) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `id_desayuno` int(5) UNSIGNED DEFAULT NULL,
  `id_almuerzo` int(5) UNSIGNED DEFAULT NULL,
  `id_cena` int(5) UNSIGNED DEFAULT NULL,
  `tipo` int(1) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_usuario`,`fecha`),
  KEY `clave-dieta-desayuno` (`id_desayuno`),
  KEY `clave-dieta-almurezo` (`id_almuerzo`),
  KEY `clave-dieta-cena` (`id_cena`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `dieta`
--

TRUNCATE TABLE `dieta`;
--
-- Volcado de datos para la tabla `dieta`
--

INSERT INTO `dieta` (`id_usuario`, `fecha`, `id_desayuno`, `id_almuerzo`, `id_cena`, `tipo`) VALUES
(36, '2022-04-10', 1, 12, 30, 1),
(36, '2022-04-11', 2, 13, 31, 1),
(36, '2022-04-12', 3, 34, 74, 1),
(36, '2022-04-13', 63, 35, 75, 1),
(36, '2022-04-14', 1, 36, 76, 1),
(36, '2022-04-15', 2, 37, 77, 1),
(36, '2022-04-16', 3, 39, 78, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejercicios`
--

DROP TABLE IF EXISTS `ejercicios`;
CREATE TABLE IF NOT EXISTS `ejercicios` (
  `id_ejercicio` int(5) NOT NULL,
  `tipo` int(1) NOT NULL,
  `musculo` varchar(40) DEFAULT NULL,
  `nombre` varchar(40) DEFAULT NULL,
  `descripcion` mediumtext NOT NULL,
  `imagen` varchar(50) NOT NULL,
  PRIMARY KEY (`id_ejercicio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `ejercicios`
--

TRUNCATE TABLE `ejercicios`;
--
-- Volcado de datos para la tabla `ejercicios`
--

INSERT INTO `ejercicios` (`id_ejercicio`, `tipo`, `musculo`, `nombre`, `descripcion`, `imagen`) VALUES
(0, 2, 'Hombro', 'Elevacion lateral', '', ''),
(1, 0, 'Hombro', 'Press hombro', '', ''),
(2, 1, 'Hombro', 'Remo al menton', '', ''),
(3, 0, 'Hombro', 'Press militar', '', ''),
(4, 0, 'Pierna', 'Sentadilla', '', ''),
(5, 0, 'Pierna', 'Prensa', '', ''),
(6, 1, 'Pierna', 'Extension de cuadriceps', '', ''),
(7, 1, 'Pierna', 'Hip thrust', '', ''),
(8, 0, 'Pecho', 'Press banca', '', ''),
(9, 2, 'Pecho', 'Aperturas con mancuernas', '', ''),
(10, 0, 'Pecho', 'Press banca inclinado', '', ''),
(11, 1, 'Pecho', 'Maquina de empuje', '', ''),
(12, 0, 'Triceps', 'Fondos', '', ''),
(13, 1, 'Triceps', 'Press frances', '', ''),
(14, 2, 'Triceps', 'Extensiones', '', ''),
(15, 1, 'Triceps', 'Barras paralelas', '', ''),
(16, 2, 'Biceps', 'Curl spider', '', ''),
(17, 1, 'Biceps', 'Predicador', '', ''),
(18, 1, 'Biceps', 'Martillo', '', ''),
(19, 1, 'Biceps', 'Chin-ups', '', ''),
(20, 0, 'Espalda', 'Jalon', '', ''),
(21, 0, 'Espalda', 'Remo en T', '', ''),
(22, 1, 'Espalda', 'Remo con barra', '', ''),
(23, 1, 'Espalda', 'Renegade row', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

DROP TABLE IF EXISTS `empresas`;
CREATE TABLE IF NOT EXISTS `empresas` (
  `id_empresa` int(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  PRIMARY KEY (`id_empresa`),
  UNIQUE KEY `nombre_empresa` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `empresas`
--

TRUNCATE TABLE `empresas`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrena`
--

DROP TABLE IF EXISTS `entrena`;
CREATE TABLE IF NOT EXISTS `entrena` (
  `nutri` text NOT NULL,
  `usuario` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `entrena`
--

TRUNCATE TABLE `entrena`;
--
-- Volcado de datos para la tabla `entrena`
--

INSERT INTO `entrena` (`nutri`, `usuario`) VALUES
('pintus', 'perspa'),
('pintus', 'perspa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foro`
--

DROP TABLE IF EXISTS `foro`;
CREATE TABLE IF NOT EXISTS `foro` (
  `id_foro` int(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_usuario` int(5) UNSIGNED NOT NULL,
  `tema` varchar(20) NOT NULL,
  `nickcreador` varchar(20) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `contenido` varchar(500) NOT NULL,
  `categoria` enum('Nutricion','Dieta') NOT NULL,
  `respuestas` int(5) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_foro`),
  UNIQUE KEY `tema` (`tema`),
  KEY `id_usuario` (`id_usuario`),
  KEY `nickcreador` (`nickcreador`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `foro`
--

TRUNCATE TABLE `foro`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

DROP TABLE IF EXISTS `mensaje`;
CREATE TABLE IF NOT EXISTS `mensaje` (
  `id_mensaje` int(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_usuario` int(5) UNSIGNED NOT NULL,
  `id_referencia` int(5) UNSIGNED NOT NULL,
  `id_foro` int(5) UNSIGNED NOT NULL,
  `titulo` varchar(25) NOT NULL,
  `mensaje` mediumtext NOT NULL,
  `fecha` datetime NOT NULL,
  `prioridad` int(5) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_mensaje`),
  KEY `Tema_FK` (`id_foro`),
  KEY `Mensaje_FK` (`id_referencia`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `mensaje`
--

TRUNCATE TABLE `mensaje`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

DROP TABLE IF EXISTS `noticias`;
CREATE TABLE IF NOT EXISTS `noticias` (
  `id_noticia` int(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_profesional` int(5) UNSIGNED NOT NULL,
  `titulo` varchar(40) NOT NULL,
  `cuerpo` mediumtext NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`id_noticia`),
  KEY `id_profesional` (`id_profesional`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `noticias`
--

TRUNCATE TABLE `noticias`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

DROP TABLE IF EXISTS `personas`;
CREATE TABLE IF NOT EXISTS `personas` (
  `id_usuario` int(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nick` varchar(6) NOT NULL,
  `nombre` varchar(25) CHARACTER SET utf32 NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `contraseña` varchar(100) NOT NULL,
  `rol` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `nick_admin` (`nick`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `personas`
--

TRUNCATE TABLE `personas`;
--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id_usuario`, `nick`, `nombre`, `apellidos`, `correo`, `contraseña`, `rol`) VALUES
(8, 'admin0', 'Dwayne', 'Johnson', 'dwayne@lifety.com', '$2y$10$uAGG3yMjH7sBX9Qc2QEXZeJoc92buC2qPgxt2x0zdLv3Th3lrp4c.', 0),
(31, 'pintus', 'Antonio', 'Pintus', 'pintus@lifety.es', '$2y$10$4HMCjZeRUdGa.USKL.GCi.1bKkrkWWLpyF0n43517XSOOVmvQwDGG', 2),
(32, 'anakin', 'Anakin', 'Skywalker', 'anakin@ucm.es', '$2y$10$uOz6PMvV6YOUHm3b6Is6juMm1PG5zF1Vyp175pSCVGMpweIj4xzki', 1),
(35, 'admin2', 'Mark', 'Wahlberg', 'markwa@lifety.es', '$2y$10$LqSxgop6C4kalnXJsXYMZe1zVqg0T4.AokRa1cdxkyjHsxnkd6HcG', 0),
(36, 'perspa', 'Persona', 'P&aacute;jaro', 'perspa@ucm.es', '$2y$10$5XbQuYbufL5BkjaB3x.LLOnfZMrOkEBuz7jSZLZQjehc261drjb6S', 1),
(37, 'flavio', 'Flavio', 'Briatore', 'flavio@ucm.es', '$2y$10$Hhaw6oPpK.M2FC62Jx0de.wnnv3WUvXIojKATcMv2doTde6ukpmBy', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pertenece`
--

DROP TABLE IF EXISTS `pertenece`;
CREATE TABLE IF NOT EXISTS `pertenece` (
  `id_producto` int(5) UNSIGNED NOT NULL,
  `id_categoria` int(5) UNSIGNED NOT NULL,
  KEY `Producto_FK` (`id_producto`),
  KEY `Categoria_FK` (`id_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `pertenece`
--

TRUNCATE TABLE `pertenece`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `premium`
--

DROP TABLE IF EXISTS `premium`;
CREATE TABLE IF NOT EXISTS `premium` (
  `id_usuario` int(5) UNSIGNED NOT NULL,
  `id_profesional` int(5) UNSIGNED NOT NULL,
  `peso` float NOT NULL,
  `altura` float NOT NULL,
  `alergias` text NOT NULL,
  `observaciones_adicionales` text NOT NULL,
  `num_logros` int(20) NOT NULL,
  `logros` set('5logros','AccesoTodos','ComenzarChat','Completa1Plan','Completa5Plan','ContrataNutri','Permanencia','Permanencia1m','Foro') NOT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `Pro_FK` (`id_profesional`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `premium`
--

TRUNCATE TABLE `premium`;
--
-- Volcado de datos para la tabla `premium`
--

INSERT INTO `premium` (`id_usuario`, `id_profesional`, `peso`, `altura`, `alergias`, `observaciones_adicionales`, `num_logros`, `logros`) VALUES
(36, 31, 70, 1, 'no', 'no', 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `id_producto` int(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `imagen` varchar(25) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` mediumtext NOT NULL,
  `precio` decimal(10,0) UNSIGNED NOT NULL,
  `link` varchar(200) NOT NULL,
  PRIMARY KEY (`id_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `productos`
--

TRUNCATE TABLE `productos`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesional`
--

DROP TABLE IF EXISTS `profesional`;
CREATE TABLE IF NOT EXISTS `profesional` (
  `id_profesional` int(5) UNSIGNED NOT NULL,
  `nutri` varchar(20) NOT NULL,
  `num_usuarios` int(3) NOT NULL,
  `usuarios` text NOT NULL,
  PRIMARY KEY (`id_profesional`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `profesional`
--

TRUNCATE TABLE `profesional`;
--
-- Volcado de datos para la tabla `profesional`
--

INSERT INTO `profesional` (`id_profesional`, `nutri`, `num_usuarios`, `usuarios`) VALUES
(31, 'pintus', 2, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutina`
--

DROP TABLE IF EXISTS `rutina`;
CREATE TABLE IF NOT EXISTS `rutina` (
  `id_rutina` int(5) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(5) UNSIGNED NOT NULL,
  `activa` tinyint(1) NOT NULL,
  `objetivo` int(1) DEFAULT NULL,
  `nivel` char(1) DEFAULT NULL,
  `dias` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_rutina`),
  KEY `id_rutina` (`id_rutina`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `rutina`
--

TRUNCATE TABLE `rutina`;
--
-- Volcado de datos para la tabla `rutina`
--

INSERT INTO `rutina` (`id_rutina`, `id_usuario`, `activa`, `objetivo`, `nivel`, `dias`) VALUES
(91, 36, 1, 1, 'P', 3),
(92, 32, 1, 1, 'P', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(5) UNSIGNED NOT NULL,
  `premium` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `usuario`
--

TRUNCATE TABLE `usuario`;
--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `premium`) VALUES
(32, 0),
(35, 0),
(36, 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `anuncio`
--
ALTER TABLE `anuncio`
  ADD CONSTRAINT `Empresa_FK` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id_empresa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `contiene`
--
ALTER TABLE `contiene`
  ADD CONSTRAINT `Ejercicio_FK` FOREIGN KEY (`id_ejercicio`) REFERENCES `ejercicios` (`id_ejercicio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Idrut_FK` FOREIGN KEY (`id_rutina`) REFERENCES `rutina` (`id_rutina`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `dieta`
--
ALTER TABLE `dieta`
  ADD CONSTRAINT `clave-dieta-almurezo` FOREIGN KEY (`id_almuerzo`) REFERENCES `comidas` (`id_comida`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `clave-dieta-cena` FOREIGN KEY (`id_cena`) REFERENCES `comidas` (`id_comida`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `clave-dieta-desayuno` FOREIGN KEY (`id_desayuno`) REFERENCES `comidas` (`id_comida`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `dieta_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `foro`
--
ALTER TABLE `foro`
  ADD CONSTRAINT `foro_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `personas` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foro_ibfk_2` FOREIGN KEY (`nickcreador`) REFERENCES `personas` (`nick`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD CONSTRAINT `Mensaje_FK` FOREIGN KEY (`id_referencia`) REFERENCES `mensaje` (`id_mensaje`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Tema_FK` FOREIGN KEY (`id_foro`) REFERENCES `foro` (`id_foro`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mensaje_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `personas` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD CONSTRAINT `noticias_ibfk_1` FOREIGN KEY (`id_profesional`) REFERENCES `profesional` (`id_profesional`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pertenece`
--
ALTER TABLE `pertenece`
  ADD CONSTRAINT `Categoria_FK` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Producto_FK` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `premium`
--
ALTER TABLE `premium`
  ADD CONSTRAINT `premium_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `premium_ibfk_2` FOREIGN KEY (`id_profesional`) REFERENCES `profesional` (`id_profesional`);

--
-- Filtros para la tabla `profesional`
--
ALTER TABLE `profesional`
  ADD CONSTRAINT `profesional_ibfk_1` FOREIGN KEY (`id_profesional`) REFERENCES `personas` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `rutina`
--
ALTER TABLE `rutina`
  ADD CONSTRAINT `rutina_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `personas` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
