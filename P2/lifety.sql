-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-03-2022 a las 10:37:52
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.2

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
-- Estructura de tabla para la tabla `dietas`
--

CREATE TABLE `dietas` (
  `objetivo` int(1) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `tipo` enum('Desayuno','Comida','Cena') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `dietas`
--

INSERT INTO `dietas` (`objetivo`, `descripcion`, `tipo`) VALUES
(1, 'Copos de avena con leche', 'Desayuno'),
(1, 'Yogur con copos de avena', 'Desayuno'),
(1, 'Tortitas de avena', 'Desayuno'),
(2, 'Porridge de avena y frutos secos', 'Desayuno'),
(2, 'Requesón con fruta', 'Desayuno'),
(2, 'Sándwich de queso gouda con huevo duro', 'Desayuno'),
(2, 'Batido de platano y avena', 'Desayuno'),
(3, 'Smoothie Bowls', 'Desayuno'),
(3, 'Hotcakes de avena y quinoa', 'Desayuno'),
(3, 'Pudín', 'Desayuno'),
(3, 'Wrap de pavo', 'Desayuno'),
(1, 'Ensalada de calabacín a la plancha con q', 'Comida'),
(1, 'Albondigas de merluza y brocoli', 'Comida'),
(1, 'Pechuga de pollo con soja y verduras salteadas', 'Comida'),
(1, 'Caldo de verduras con tortilla francesa', 'Comida'),
(2, 'Ensalada de patata hervida, tomate, pepino y huevo duro', 'Comida'),
(2, 'Wok de verduras al curry con tiras de pollo', 'Comida'),
(2, '.Berenjena y calabacín asado con pimentón dulce', 'Comida'),
(2, 'Puré de calabaza con patata hervida', 'Comida'),
(2, 'Tomates rellenos de lentejas', 'Comida'),
(2, 'Revuelto de gambas y champiñones', 'Comida'),
(3, 'Pollo con verduras y queso batido al papillote', 'Cena'),
(3, 'Salmón al horno con salsa de yogur', 'Cena'),
(3, 'Sopa de pasta y hamburguesa con naranja picada', 'Cena'),
(3, 'Crema de verduras y pechuga de pollo con manzana', 'Cena'),
(3, 'Croquetas de pescado con pure de patata', 'Cena'),
(3, 'Pollo a la naranja', 'Cena'),
(3, 'Garbanzos con espinacas', 'Cena'),
(3, 'Arroz tres delicias', 'Cena'),
(1, 'Ensalada de patata hervida, tomate, pepino y huevo duro', 'Cena'),
(1, 'Wok de verduras al curry con tiras de pollo', 'Cena'),
(2, 'Hamburguesa de jamón york con mayonesa y queso', 'Cena'),
(2, 'Minipizza cuatro quesos con naranja troceada', 'Cena'),
(3, 'Pollo con almendras chino', 'Comida'),
(3, 'Atún a la plancha con ajo y perejil', 'Comida');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejercicios`
--

CREATE TABLE `ejercicios` (
  `musculo` varchar(40) DEFAULT NULL,
  `nombre` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ejercicios`
--

INSERT INTO `ejercicios` (`musculo`, `nombre`) VALUES
('Hombro', 'Elevación lateral'),
('Hombro', 'Press hombro'),
('Hombro', 'Remo al mentón'),
('Hombro', 'Press militar'),
('Pierna', 'Sentadilla'),
('Pierna', 'Prensa'),
('Pierna', 'Extensión de cuadriceps'),
('Pierna', 'Hip thrust'),
('Pecho', 'Press banca'),
('Pecho', 'Aperturas con mancuernas'),
('Pecho', 'Press banca inclinado'),
('Pecho', 'Máquina de empuje'),
('Triceps', 'Fondos'),
('Triceps', 'Press francés'),
('Triceps', 'Extensiones'),
('Triceps', 'Barras paralelas'),
('Biceps', 'Curl araña'),
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

CREATE TABLE `planificacion` (
  `id_usuario` varchar(20) NOT NULL,
  `desayunos` text DEFAULT NULL,
  `comidas` text DEFAULT NULL,
  `cenas` text DEFAULT NULL,
  `rutina` text DEFAULT NULL,
  `dobjetivo` int(1) DEFAULT NULL,
  `eobjetivo` int(1) DEFAULT NULL,
  `dias` int(1) DEFAULT NULL,
  `nivel` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `planificacion`
--

INSERT INTO `planificacion` (`id_usuario`, `desayunos`, `comidas`, `cenas`, `rutina`, `dobjetivo`, `eobjetivo`, `dias`, `nivel`) VALUES
(0, 'Tortitas de avena | Copos de avena con leche | Yogur con copos de avena | Copos de avena con leche | Yogur con copos de avena | Tortitas de avena | Tortitas de avena', 'Ensalada de calabacín a la plancha con q | Albondigas de merluza y brocoli | Ensalada de calabacín a la plancha con q | Pechuga de pollo con soja y verduras salteadas | Pechuga de pollo con soja y verduras salteadas | Albondigas de merluza y brocoli | Caldo de verduras con tortilla francesa', 'Wok de verduras al curry con tiras de pollo | Wok de verduras al curry con tiras de pollo | Ensalada de patata hervida, tomate, pepino y huevo duro | Wok de verduras al curry con tiras de pollo | Wok de verduras al curry con tiras de pollo | Wok de verduras al curry con tiras de pollo | Ensalada de patata hervida, tomate, pepino y huevo duro', NULL, NULL, NULL, NULL, NULL),
(23, 'Comida A, Comida B', 'Comida C', 'Comida D', 'Press banca | Aperturas con mancuernas | Elevación lateral | Press hombro - Jalon | Remo en T | Curl araña | Predicador - Sentadilla | Prensa | Fondos | Press francés', NULL, NULL, NULL, NULL),
(25, 'Porridge de avena y frutos secos | Batido de platano y avena | Requesón con fruta | Porridge de avena y frutos secos | Requesón con fruta | Requesón con fruta | Sándwich de queso gouda con huevo duro', 'Puré de calabaza con patata hervida | Revuelto de gambas y champiñones | Tomates rellenos de lentejas | Revuelto de gambas y champiñones | Tomates rellenos de lentejas | Wok de verduras al curry con tiras de pollo | Revuelto de gambas y champiñones', 'Minipizza cuatro quesos con naranja troceada | Minipizza cuatro quesos con naranja troceada | Hamburguesa de jamón york con mayonesa y queso | Minipizza cuatro quesos con naranja troceada | Hamburguesa de jamón york con mayonesa y queso | Hamburguesa de jamón york con mayonesa y queso | Minipizza cuatro quesos con naranja troceada', 'Press banca | Aperturas con mancuernas | Elevación lateral | Press hombro - Jalon | Remo en T | Curl araña | Predicador - Sentadilla | Prensa | Fondos | Press francés', NULL, NULL, NULL, NULL),
(77, 'Batido de platano y avena | Batido de platano y avena | Sándwich de queso gouda con huevo duro | Batido de platano y avena | Porridge de avena y frutos secos | Requesón con fruta | Batido de platano y avena\r\n', 'Revuelto de gambas y champiñones | Ensalada de patata hervida, tomate, pepino y huevo duro | Revuelto de gambas y champiñones | Puré de calabaza con patata hervida | Puré de calabaza con patata hervida | Wok de verduras al curry con tiras de pollo | .Berenjena y calabacín asado con pimentón dulce\r\n', 'Hamburguesa de jamón york con mayonesa y queso | Minipizza cuatro quesos con naranja troceada | Hamburguesa de jamón york con mayonesa y queso | Hamburguesa de jamón york con mayonesa y queso | Hamburguesa de jamón york con mayonesa y queso | Hamburguesa de jamón york con mayonesa y queso | Hamburguesa de jamón york con mayonesa y queso\r\n', 'Press banca | Aperturas con mancuernas | Elevación lateral | Press hombro - Jalon | Remo en T | Curl araña | Predicador - Sentadilla | Prensa | Fondos | Press francés', NULL, 2, 3, 'P'),
(44, 'Pudín | Pudín | Pudín | Hotcakes de avena y quinoa | Wrap de pavo | Wrap de pavo | Smoothie Bowls', 'Atún a la plancha con ajo y perejil | Pollo con almendras chino | Atún a la plancha con ajo y perejil | Atún a la plancha con ajo y perejil | Pollo con almendras chino | Pollo con almendras chino | Pollo con almendras chino', 'Crema de verduras y pechuga de pollo con manzana | Pollo a la naranja | Pollo con verduras y queso batido al papillote | Garbanzos con espinacas | Pollo con verduras y queso batido al papillote | Pollo a la naranja | Sopa de pasta y hamburguesa con naranja picada', 'Press banca | Aperturas con mancuernas | Press banca inclinado | Elevación lateral | Press hombro | Remo al mentón - Jalon | Remo en T | Remo con barra | Curl araña | Predicador | Martillo - Sentadilla | Prensa | Extensión de cuadriceps | Fondos | Press francés | Extensiones - Press banca | Aperturas con mancuernas | Press banca inclinado | Elevación lateral | Press hombro | Remo al mentón | Jalon | Remo en T | Remo con barra - Curl araña | Predicador | Martillo | Sentadilla | Prensa | Extensión de cuadriceps | Fondos | Press francés | Extensiones', 3, 2, 5, 'M');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `premium`
--

CREATE TABLE `premium` (
  `peso` float NOT NULL,
  `altura` float NOT NULL,
  `alergias` text NOT NULL,
  `observaciones_adicionales` text NOT NULL,
  `num_logros` int(20) NOT NULL,
  `logros` int(2) NOT NULL,
  `id_usuario` varchar(20) NOT NULL,
  `id_profesional` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `premium`
--

INSERT INTO `premium` (`peso`, `altura`, `alergias`, `observaciones_adicionales`, `num_logros`, `logros`, `id_usuario`, `id_profesional`) VALUES
(75, 170, '', '', 0, 0, 0, 0),
(75, 170, '', '', 0, 0, 0, 0),
(75, 170, '', '', 0, 0, 0, 0),
(75, 170, '', '', 0, 0, 0, 0),
(75, 170, '', '', 0, 0, 0, 0),
(75, 170, '', '', 0, 0, 0, 0),
(75, 170, '', '', 0, 0, 0, 0),
(75, 170, '', '', 0, 0, 0, 0),
(75, 170, '', '', 0, 0, 0, 0),
(75, 170, '', '', 0, 0, 0, 0),
(75, 170, '', '', 0, 0, 0, 0),
(75, 170, '', '', 0, 0, 0, 0),
(75, 170, '', '', 0, 0, 0, 0),
(75, 170, '', '', 0, 0, 0, 0),
(75, 170, '', '', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesional`
--

CREATE TABLE `profesional` (
  `nombre` text NOT NULL,
  `apellidos` text NOT NULL,
  `contraseña` varchar(25) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `dni` varchar(9) NOT NULL,
  `id_profesional` varchar(20) NOT NULL,
  `usuarios` text NOT NULL,
  `num_usuarios` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `profesional`
--

INSERT INTO `profesional` (`nombre`, `apellidos`, `contraseña`, `correo`, `dni`, `id_profesional`, `usuarios`, `num_usuarios`) VALUES
('Sandra', 'Ramos Ramos', '1234', 'sandra@lifety', '45678923P', 0, 'Alex ', 1),
('Ivan', 'Ledesma Casado', '123', 'ivan@lifety', '45678923E', 1, '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `nombre` text NOT NULL,
  `apellidos` text NOT NULL,
  `dni` varchar(9) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `password` varchar(25) NOT NULL,
  `id_usuario` varchar(20) NOT NULL,
  `premium` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`nombre`, `apellidos`, `dni`, `correo`, `password`, `id_usuario`, `premium`) VALUES
('Alex', '', '', '', '1', 0, 1),
('Sandra', 'Ramos', '444444O', '', '2', 1, 0),
('Prueba', 'A', '', '', '', 23, 0),
('Vacio', 'B', '', '', '', 25, 0),
('Diego', '', '', '', '2', 44, 0),
('Kylian', 'Mbappe', '', '', '', 77, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `planificacion`
--
ALTER TABLE `planificacion`
  ADD KEY `Id_FK` (`id_usuario`);

--
-- Indices de la tabla `premium`
--
ALTER TABLE `premium`
  ADD KEY `Id_FK` (`id_usuario`),
  ADD KEY `Profesional_FK` (`id_profesional`);

--
-- Indices de la tabla `profesional`
--
ALTER TABLE `profesional`
  ADD PRIMARY KEY (`id_profesional`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `planificacion`
--
ALTER TABLE `planificacion`
  ADD CONSTRAINT `Id_FK` FOREIGN KEY (`Id_usuario`) REFERENCES `usuario` (`Id_usuario`);

--
-- Filtros para la tabla `premium`
--
ALTER TABLE `premium`
  ADD CONSTRAINT `Profesional_FK` FOREIGN KEY (`Id_profesional`) REFERENCES `profesional` (`Id_profesional`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
