-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-03-2022 a las 12:12:32
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 8.0.6

SET FOREIGN_KEY_CHECKS=0;
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
('0', '12', 's', '2022-03-27 18:12:04', 'U-E'),
('0', '13', 's', '2022-03-27 18:13:01', 'U-E'),
('Pintus', 'ivan', 'hola', '2022-03-29 11:28:21', 'U-E');

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
(83, 8, 1, 10),
(83, 9, 1, 10),
(83, 0, 1, 10),
(83, 1, 1, 10),
(83, 20, 2, 10),
(83, 21, 2, 10),
(83, 16, 2, 10),
(83, 17, 2, 10),
(83, 4, 3, 10),
(83, 5, 3, 10),
(83, 12, 3, 10),
(83, 13, 3, 10),
(84, 8, 1, 10),
(84, 9, 1, 10),
(84, 0, 1, 10),
(84, 1, 1, 10),
(84, 20, 2, 10),
(84, 21, 2, 10),
(84, 16, 2, 10),
(84, 17, 2, 10),
(84, 4, 3, 10),
(84, 5, 3, 10),
(84, 12, 3, 10),
(84, 13, 3, 10),
(85, 8, 1, 10),
(85, 9, 1, 10),
(85, 0, 1, 10),
(85, 1, 1, 10),
(85, 20, 2, 10),
(85, 21, 2, 10),
(85, 16, 2, 10),
(85, 17, 2, 10),
(85, 4, 3, 10),
(85, 5, 3, 10),
(85, 12, 3, 10),
(85, 13, 3, 10),
(86, 8, 1, 10),
(86, 9, 1, 10),
(86, 0, 1, 10),
(86, 1, 1, 10),
(86, 20, 2, 10),
(86, 21, 2, 10),
(86, 16, 2, 10),
(86, 17, 2, 10),
(86, 4, 3, 10),
(86, 5, 3, 10),
(86, 12, 3, 10),
(86, 13, 3, 10),
(86, 8, 4, 10),
(86, 9, 4, 10),
(86, 0, 4, 10),
(86, 1, 4, 10),
(86, 20, 4, 10),
(86, 21, 4, 10),
(86, 16, 5, 10),
(86, 17, 5, 10),
(86, 4, 5, 10),
(86, 5, 5, 10),
(86, 12, 5, 10),
(86, 13, 5, 10);

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
(5, '2022-03-29', 1, 12, 30, 1),
(5, '2022-03-30', 2, 13, 31, 1),
(5, '2022-03-31', 3, 34, 74, 1),
(5, '2022-04-01', 63, 35, 75, 1),
(5, '2022-04-02', 1, 37, 76, 1),
(5, '2022-04-03', 2, 38, 77, 1),
(5, '2022-04-04', 3, 39, 78, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejercicios`
--

DROP TABLE IF EXISTS `ejercicios`;
CREATE TABLE IF NOT EXISTS `ejercicios` (
  `id_ejercicio` int(5) NOT NULL,
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

INSERT INTO `ejercicios` (`id_ejercicio`, `musculo`, `nombre`, `descripcion`, `imagen`) VALUES
(0, 'Hombro', 'Elevacion lateral', '', ''),
(1, 'Hombro', 'Press hombro', '', ''),
(2, 'Hombro', 'Remo al menton', '', ''),
(3, 'Hombro', 'Press militar', '', ''),
(4, 'Pierna', 'Sentadilla', '', ''),
(5, 'Pierna', 'Prensa', '', ''),
(6, 'Pierna', 'Extension de cuadriceps', '', ''),
(7, 'Pierna', 'Hip thrust', '', ''),
(8, 'Pecho', 'Press banca', '', ''),
(9, 'Pecho', 'Aperturas con mancuernas', '', ''),
(10, 'Pecho', 'Press banca inclinado', '', ''),
(11, 'Pecho', 'Maquina de empuje', '', ''),
(12, 'Triceps', 'Fondos', '', ''),
(13, 'Triceps', 'Press frances', '', ''),
(14, 'Triceps', 'Extensiones', '', ''),
(15, 'Triceps', 'Barras paralelas', '', ''),
(16, 'Biceps', 'Curl spider', '', ''),
(17, 'Biceps', 'Predicador', '', ''),
(18, 'Biceps', 'Martillo', '', ''),
(19, 'Biceps', 'Chin-ups', '', ''),
(20, 'Espalda', 'Jalon', '', ''),
(21, 'Espalda', 'Remo en T', '', ''),
(22, 'Espalda', 'Remo con barra', '', ''),
(23, 'Espalda', 'Renegade row', '', '');

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
-- Estructura de tabla para la tabla `foro`
--

DROP TABLE IF EXISTS `foro`;
CREATE TABLE IF NOT EXISTS `foro` (
  `id_foro` int(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tema` varchar(20) NOT NULL,
  PRIMARY KEY (`id_foro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  PRIMARY KEY (`id_mensaje`),
  KEY `Tema_FK` (`id_foro`),
  KEY `Mensaje_FK` (`id_referencia`),
  KEY `Autor_KF` (`id_usuario`)
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
  KEY `Prof_FK` (`id_profesional`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `noticias`
--

TRUNCATE TABLE `noticias`;
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
  `peso` float NOT NULL,
  `altura` float NOT NULL,
  `alergias` text NOT NULL,
  `observaciones_adicionales` text NOT NULL,
  `num_logros` int(20) NOT NULL,
  `logros` set('5logros','AccesoTodos','ComenzarChat','Completa1Plan','Completa5Plan','ContrataNutri','Permanencia','Permanencia1m','Foro') NOT NULL,
  `id_usuario` int(5) UNSIGNED NOT NULL,
  `id_profesional` int(5) UNSIGNED NOT NULL,
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

INSERT INTO `premium` (`peso`, `altura`, `alergias`, `observaciones_adicionales`, `num_logros`, `logros`, `id_usuario`, `id_profesional`) VALUES
(75, 170, '', '', 0, '', 1, 1),
(64, 1, '', '', 0, '', 5, 1);

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
  `nombre` text NOT NULL,
  `apellidos` text NOT NULL,
  `correo` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nutri` varchar(20) NOT NULL,
  `usuarios` text NOT NULL,
  `num_usuarios` int(3) NOT NULL,
  `id_profesional` int(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_profesional`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `profesional`
--

TRUNCATE TABLE `profesional`;
--
-- Volcado de datos para la tabla `profesional`
--

INSERT INTO `profesional` (`nombre`, `apellidos`, `correo`, `password`, `nutri`, `usuarios`, `num_usuarios`, `id_profesional`) VALUES
('Antonio', 'Pintus', 'pintus@lifety', '$2y$10$kwNuu0U4fEO7xYOEOH1QWOa4Zk7lnGLmnt9hrM1iV5hV4ASlq4TFu', 'Pintus', 'Floren,ivan,', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutina`
--

DROP TABLE IF EXISTS `rutina`;
CREATE TABLE IF NOT EXISTS `rutina` (
  `activa` tinyint(1) NOT NULL,
  `id_usuario` int(5) UNSIGNED NOT NULL,
  `nivel` char(1) DEFAULT NULL,
  `dias` int(1) DEFAULT NULL,
  `objetivo` int(1) DEFAULT NULL,
  `id_rutina` int(5) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_rutina`),
  KEY `id_rutina` (`id_rutina`),
  KEY `U_FK` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `rutina`
--

TRUNCATE TABLE `rutina`;
--
-- Volcado de datos para la tabla `rutina`
--

INSERT INTO `rutina` (`activa`, `id_usuario`, `nivel`, `dias`, `objetivo`, `id_rutina`) VALUES
(0, 5, 'P', 3, 1, 83),
(0, 5, 'M', 3, 1, 84),
(0, 5, 'M', 3, 2, 85),
(1, 5, 'A', 5, 2, 86);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `nombre` text NOT NULL,
  `apellidos` text NOT NULL,
  `correo` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `premium` tinyint(1) NOT NULL,
  `id_usuario` int(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `usuario`
--

TRUNCATE TABLE `usuario`;
--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`nombre`, `apellidos`, `correo`, `password`, `usuario`, `premium`, `id_usuario`) VALUES
('Kylian', 'Mbappe', 'rmcf', '$2y$10$kwNuu0U4fEO7xYOEOH1QWOa4Zk7lnGLmnt9hrM1iV5hV4ASlq4TFu', 'Floren', 1, 1),
('Erling', 'Halland', 'halland@lifety', '$2y$10$ZBoj.Ov4LQDcEBhTVhIso.x7y9SW3Visgbd6NFRC1g.JOBfj8wMGO', 'P$G', 0, 2),
('Alba', 'Ramos', 'alba@ucm.es', '$2y$10$4NX/TP/xBl0g9xb04lJ5nO2ajL6wf2XMs1lVAFRVZhQzeFjic4q2i', 'alba', 0, 3),
('Diego', 'Alvarez', 'diego@ucm.es', '$2y$10$/mtT29PXM55I1VXcDLsCDOzDnyIxkg5jUMtY.wYmwZKQua6FBiKkO', 'diego', 0, 4),
('ivan', 'ledesma', 'ivan@ucm.es', '$2y$10$PLUfX1o1vKm7q4FDxgS/luj7MD.GL4b8lOqrlR3L.nSKThKc7DeqK', 'ivan', 1, 5);

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
  ADD CONSTRAINT `clave-dieta-usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD CONSTRAINT `Autor_KF` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Mensaje_FK` FOREIGN KEY (`id_referencia`) REFERENCES `mensaje` (`id_mensaje`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Tema_FK` FOREIGN KEY (`id_foro`) REFERENCES `foro` (`id_foro`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD CONSTRAINT `Prof_FK` FOREIGN KEY (`id_profesional`) REFERENCES `profesional` (`id_profesional`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `Pro_FK` FOREIGN KEY (`id_profesional`) REFERENCES `profesional` (`id_profesional`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Usu_FK` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `rutina`
--
ALTER TABLE `rutina`
  ADD CONSTRAINT `U_FK` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
