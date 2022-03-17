-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-03-2022 a las 15:28:07
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
CREATE DATABASE IF NOT EXISTS `lifety` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `lifety`;

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
('Entrenador1', 'Usuario1', 'hola', '2022-03-15 16:48:53', 'U-E'),
('Usuario1', 'Entrenador1', 'asda', '2022-03-15 17:12:41', 'E-U');

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
  PRIMARY KEY (`id_comida`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `comidas`
--

TRUNCATE TABLE `comidas`;
--
-- Volcado de datos para la tabla `comidas`
--

INSERT INTO `comidas` (`id_comida`, `objetivo`, `tipo`, `descripcion`) VALUES
(1, 1, 'Desayuno', 'Copos de avena con leche'),
(2, 1, 'Desayuno', 'Yogur con copos de avena'),
(3, 1, 'Desayuno', 'Tortitas de avena'),
(4, 2, 'Desayuno', 'Porridge de avena y frutos secos'),
(5, 2, 'Desayuno', 'Requesón con fruta'),
(6, 2, 'Desayuno', 'Sándwich de queso gouda con huevo duro'),
(7, 2, 'Desayuno', 'Batido de platano y avena'),
(8, 3, 'Desayuno', 'Smoothie Bowls'),
(9, 3, 'Desayuno', 'Hotcakes de avena y quinoa'),
(10, 3, 'Desayuno', 'Pudín'),
(11, 3, 'Desayuno', 'Wrap de pavo'),
(12, 1, 'Comida', 'Ensalada de calabacín a la plancha con q'),
(13, 1, 'Comida', 'Albondigas de merluza y brocoli'),
(14, 1, 'Comida', 'Pechuga de pollo con soja y verduras salteadas'),
(15, 1, 'Comida', 'Caldo de verduras con tortilla francesa'),
(16, 2, 'Comida', 'Ensalada de patata hervida, tomate, pepino y huevo duro'),
(17, 2, 'Comida', 'Wok de verduras al curry con tiras de pollo'),
(18, 2, 'Comida', '.Berenjena y calabacín asado con pimentón dulce'),
(19, 2, 'Comida', 'Puré de calabaza con patata hervida'),
(20, 2, 'Comida', 'Tomates rellenos de lentejas'),
(21, 2, 'Comida', 'Revuelto de gambas y champiñones'),
(22, 3, 'Cena', 'Pollo con verduras y queso batido al papillote'),
(23, 3, 'Cena', 'Salmón al horno con salsa de yogur'),
(24, 3, 'Cena', 'Sopa de pasta y hamburguesa con naranja picada'),
(25, 3, 'Cena', 'Crema de verduras y pechuga de pollo con manzana'),
(26, 3, 'Cena', 'Croquetas de pescado con pure de patata'),
(27, 3, 'Cena', 'Pollo a la naranja'),
(28, 3, 'Cena', 'Garbanzos con espinacas'),
(29, 3, 'Cena', 'Arroz tres delicias'),
(30, 1, 'Cena', 'Ensalada de patata hervida, tomate, pepino y huevo duro'),
(31, 1, 'Cena', 'Wok de verduras al curry con tiras de pollo'),
(32, 2, 'Cena', 'Hamburguesa de jamón york con mayonesa y queso'),
(33, 2, 'Cena', 'Minipizza cuatro quesos con naranja troceada'),
(34, 3, 'Comida', 'Pollo con almendras chino'),
(35, 3, 'Comida', 'Atún a la plancha con ajo y perejil');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dieta`
--

DROP TABLE IF EXISTS `dieta`;
CREATE TABLE IF NOT EXISTS `dieta` (
  `id_usuario` int(5) NOT NULL,
  `objetivo` int(1) UNSIGNED NOT NULL,
  `desayunos` text NOT NULL,
  `comidas` text NOT NULL,
  `cenas` text NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `dieta`
--

TRUNCATE TABLE `dieta`;
--
-- Volcado de datos para la tabla `dieta`
--

INSERT INTO `dieta` (`id_usuario`, `objetivo`, `desayunos`, `comidas`, `cenas`) VALUES
(1, 1, '[\"Pudu00edn\",\"Hotcakes de avena y quinoa\",\"Hotcakes de avena y quinoa\",\"Pudu00edn\",\"Hotcakes de avena y quinoa\",\"Hotcakes de avena y quinoa\",\"Hotcakes de avena y quinoa\"]', '[\"Pollo con almendras chino\",\"Pollo con almendras chino\",\"Atu00fan a la plancha con ajo y perejil\",\"Atu00fan a la plancha con ajo y perejil\",\"Atu00fan a la plancha con ajo y perejil\",\"Pollo con almendras chino\",\"Pollo con almendras chino\"]', '[\"Croquetas de pescado con pure de patata\",\"Arroz tres delicias\",\"Garbanzos con espinacas\",\"Crema de verduras y pechuga de pollo con manzana\",\"Sopa de pasta y hamburguesa con naranja picada\",\"Salmu00f3n al horno con salsa de yogur\",\"Sopa de pasta y hamburguesa con naranja picada\"]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dietas`
--

DROP TABLE IF EXISTS `dietas`;
CREATE TABLE IF NOT EXISTS `dietas` (
  `objetivo` int(1) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `tipo` enum('Desayuno','Comida','Cena') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `dietas`
--

TRUNCATE TABLE `dietas`;
--
-- Volcado de datos para la tabla `dietas`
--

INSERT INTO `dietas` (`objetivo`, `descripcion`, `tipo`) VALUES
(1, 'Copos de avena con leche', 'Desayuno'),
(1, 'Espinacas con pollo plancha', 'Comida'),
(1, 'Crema de calabaza y gallo', 'Cena'),
(1, 'Pollo asado y judias verdes', 'Comida'),
(1, 'Menestra de verduras y salmon', 'Cena'),
(2, 'Tosta de huevos y tomate', 'Desayuno'),
(2, 'Tortitas de arroz', 'Desayuno'),
(2, 'Tosta de huevos y tomate', 'Desayuno'),
(1, 'Leche desnatada con avena', 'Desayuno'),
(1, 'Yogur con copos de avena', 'Desayuno'),
(1, 'Tortitas de avena', 'Desayuno'),
(2, 'Porridge de avena y frutos secos', 'Desayuno'),
(2, 'Requeson con fruta', 'Desayuno'),
(2, 'Sandwich de queso gouda con huevo duro', 'Desayuno'),
(2, 'Batido de platano y avena', 'Desayuno'),
(3, 'Smoothie Bowls', 'Desayuno'),
(3, 'Hotcakes de avena y quinoa', 'Desayuno'),
(3, 'Pudin', 'Desayuno'),
(3, 'Wrap de pavo', 'Desayuno'),
(1, 'Ensalada de calabacin a la plancha', 'Comida'),
(1, 'Albondigas de merluza y brocoli', 'Comida'),
(1, 'Pechuga de pollo con soja y verduras salteadas', 'Comida'),
(1, 'Caldo de verduras con tortilla francesa', 'Comida'),
(2, 'Ensalada de patata hervida, tomate, pepino y huevo duro', 'Comida'),
(2, 'Wok de verduras al curry con tiras de pollo', 'Comida'),
(2, 'Berenjena y calabacin asado con pimenton dulce', 'Comida'),
(2, 'Pure de calabaza con patata hervida', 'Comida'),
(2, 'Tomates rellenos de lentejas', 'Comida'),
(2, 'Revuelto de gambas y champiñones', 'Comida'),
(2, 'Pollo picante con cuscus', 'Cena'),
(2, 'Ensalada campera', 'Comida'),
(2, 'Merluza a la plancha con ensalada', 'Cena'),
(3, 'Pollo con verduras y queso batido al papillote', 'Cena'),
(3, 'Salmon al horno con salsa de yogur', 'Cena'),
(3, 'Sopa de pasta y hamburguesa con naranja picada', 'Cena'),
(3, 'Crema de verduras y pechuga de pollo con manzana', 'Cena'),
(3, 'Croquetas de pescado con pure de patata', 'Cena'),
(3, 'Pollo a la naranja', 'Cena'),
(3, 'Garbanzos con espinacas', 'Cena'),
(3, 'Arroz tres delicias', 'Cena'),
(1, 'Ensalada de patata hervida, tomate, pepino y huevo duro', 'Cena'),
(1, 'Wok de verduras al curry con tiras de pollo', 'Cena'),
(2, 'Hamburguesa de jamon york con mayonesa y queso', 'Cena'),
(2, 'Minipizza cuatro quesos con naranja troceada', 'Cena'),
(3, 'Pollo con almendras chino', 'Comida'),
(3, 'Atún a la plancha con ajo y perejil', 'Comida');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejercicios`
--

DROP TABLE IF EXISTS `ejercicios`;
CREATE TABLE IF NOT EXISTS `ejercicios` (
  `musculo` varchar(40) DEFAULT NULL,
  `nombre` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `ejercicios`
--

TRUNCATE TABLE `ejercicios`;
--
-- Volcado de datos para la tabla `ejercicios`
--

INSERT INTO `ejercicios` (`musculo`, `nombre`) VALUES
('Hombro', 'Elevacion lateral'),
('Hombro', 'Press hombro'),
('Hombro', 'Remo al menton'),
('Hombro', 'Press militar'),
('Pierna', 'Sentadilla'),
('Pierna', 'Prensa'),
('Pierna', 'Extension de cuadriceps'),
('Pierna', 'Hip thrust'),
('Pecho', 'Press banca'),
('Pecho', 'Aperturas con mancuernas'),
('Pecho', 'Press banca inclinado'),
('Pecho', 'Maquina de empuje'),
('Triceps', 'Fondos'),
('Triceps', 'Press frances'),
('Triceps', 'Extensiones'),
('Triceps', 'Barras paralelas'),
('Biceps', 'Curl spider'),
('Biceps', 'Predicador'),
('Biceps', 'Martillo'),
('Biceps', 'Chin-ups'),
('Espalda', 'Jalon'),
('Espalda', 'Remo en T'),
('Espalda', 'Remo con barra'),
('Espalda', 'Renegade row');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planificacion`
--

DROP TABLE IF EXISTS `planificacion`;
CREATE TABLE IF NOT EXISTS `planificacion` (
  `id_usuario` int(5) NOT NULL,
  `desayunos` text DEFAULT NULL,
  `comidas` text DEFAULT NULL,
  `cenas` text DEFAULT NULL,
  `rutina` text DEFAULT NULL,
  `dobjetivo` int(1) DEFAULT NULL,
  `eobjetivo` int(1) DEFAULT NULL,
  `dias` int(1) DEFAULT NULL,
  `nivel` char(1) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `planificacion`
--

TRUNCATE TABLE `planificacion`;
--
-- Volcado de datos para la tabla `planificacion`
--

INSERT INTO `planificacion` (`id_usuario`, `desayunos`, `comidas`, `cenas`, `rutina`, `dobjetivo`, `eobjetivo`, `dias`, `nivel`) VALUES
(1, NULL, NULL, NULL, '[[\"Press banca\",\"Aperturas con mancuernas\",\"Elevacion lateral\",\"Press hombro\"],[\"Jalon\",\"Remo en T\",\"Curl spider\",\"Predicador\"],[\"Sentadilla\",\"Prensa\",\"Fondos\",\"Press frances\"]]', NULL, 1, 3, 'P'),
(2, NULL, NULL, NULL, '[[\"Press banca\",\"Aperturas con mancuernas\",\"Elevacion lateral\",\"Press hombro\"],[\"Jalon\",\"Remo en T\",\"Curl spider\",\"Predicador\"],[\"Sentadilla\",\"Prensa\",\"Fondos\",\"Press frances\"]]', NULL, 1, 3, 'P');

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
  `id_usuario` int(5) NOT NULL,
  `id_profesional` int(5) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `Profesional_FK` (`id_profesional`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `premium`
--

TRUNCATE TABLE `premium`;
--
-- Volcado de datos para la tabla `premium`
--

INSERT INTO `premium` (`peso`, `altura`, `alergias`, `observaciones_adicionales`, `num_logros`, `logros`, `id_usuario`, `id_profesional`) VALUES
(75, 170, '', '', 0, '', 1, 1);

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
  `id_profesional` int(5) NOT NULL AUTO_INCREMENT,
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
('Antonio', 'Pintus', 'pintus@lifety', '$2y$10$kwNuu0U4fEO7xYOEOH1QWOa4Zk7lnGLmnt9hrM1iV5hV4ASlq4TFu', 'Pintus', 'Kylian', 1, 1);

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
  `id_usuario` int(5) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `usuario`
--

TRUNCATE TABLE `usuario`;
--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`nombre`, `apellidos`, `correo`, `password`, `usuario`, `premium`, `id_usuario`) VALUES
('Kylian', 'Mbappe', 'rmcf', '$2y$10$kwNuu0U4fEO7xYOEOH1QWOa4Zk7lnGLmnt9hrM1iV5hV4ASlq4TFu', 'Floren', 1, 1),
('Erling', 'Halland', 'halland@lifety', '$2y$10$ZBoj.Ov4LQDcEBhTVhIso.x7y9SW3Visgbd6NFRC1g.JOBfj8wMGO', 'P$G', 0, 2);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `planificacion`
--
ALTER TABLE `planificacion`
  ADD CONSTRAINT `Usu_FK` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `premium`
--
ALTER TABLE `premium`
  ADD CONSTRAINT `Profesional_FK` FOREIGN KEY (`id_profesional`) REFERENCES `profesional` (`id_profesional`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Usuario_FK` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
