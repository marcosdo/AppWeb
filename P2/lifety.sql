-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-03-2022 a las 22:45:23
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
  `Objetivo` int(1) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `Tipo` enum('Desayuno','Comida','Cena') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `dietas`
--

INSERT INTO `dietas` (`Objetivo`, `descripcion`, `Tipo`) VALUES
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
(1, 'Ensalada de calabacín a la plancha con queso', 'Comida'),
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
  `Musculo` varchar(40) DEFAULT NULL,
  `Nombre` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ejercicios`
--

INSERT INTO `ejercicios` (`Musculo`, `Nombre`) VALUES
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
  `Id_usuario` int(5) NOT NULL,
  `desayunos` text DEFAULT NULL,
  `comidas` text DEFAULT NULL,
  `cenas` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `planificacion`
--

INSERT INTO `planificacion` (`Id_usuario`, `desayunos`, `comidas`, `cenas`) VALUES
(0, '', '', ''),
(23, 'Comida A, Comida B', 'Comida C', 'Comida D'),
(25, 'Porridge de avena y frutos secos | Batido de platano y avena | Requesón con fruta | Porridge de avena y frutos secos | Requesón con fruta | Requesón con fruta | Sándwich de queso gouda con huevo duro', 'Puré de calabaza con patata hervida | Revuelto de gambas y champiñones | Tomates rellenos de lentejas | Revuelto de gambas y champiñones | Tomates rellenos de lentejas | Wok de verduras al curry con tiras de pollo | Revuelto de gambas y champiñones', 'Minipizza cuatro quesos con naranja troceada | Minipizza cuatro quesos con naranja troceada | Hamburguesa de jamón york con mayonesa y queso | Minipizza cuatro quesos con naranja troceada | Hamburguesa de jamón york con mayonesa y queso | Hamburguesa de jamón york con mayonesa y queso | Minipizza cuatro quesos con naranja troceada'),
(77, 'Batido de platano y avena | Batido de platano y avena | Sándwich de queso gouda con huevo duro | Batido de platano y avena | Porridge de avena y frutos secos | Requesón con fruta | Batido de platano y avena\r\n', 'Revuelto de gambas y champiñones | Ensalada de patata hervida, tomate, pepino y huevo duro | Revuelto de gambas y champiñones | Puré de calabaza con patata hervida | Puré de calabaza con patata hervida | Wok de verduras al curry con tiras de pollo | .Berenjena y calabacín asado con pimentón dulce\r\n', 'Hamburguesa de jamón york con mayonesa y queso | Minipizza cuatro quesos con naranja troceada | Hamburguesa de jamón york con mayonesa y queso | Hamburguesa de jamón york con mayonesa y queso | Hamburguesa de jamón york con mayonesa y queso | Hamburguesa de jamón york con mayonesa y queso | Hamburguesa de jamón york con mayonesa y queso\r\n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `premium`
--

CREATE TABLE `premium` (
  `Peso` float NOT NULL,
  `Altura` float NOT NULL,
  `Alergias` text NOT NULL,
  `Observaciones_adicionales` text NOT NULL,
  `Num_logros` int(20) NOT NULL,
  `Logros` int(2) NOT NULL,
  `Id_usuario` int(5) NOT NULL,
  `Id_profesional` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `premium`
--

INSERT INTO `premium` (`Peso`, `Altura`, `Alergias`, `Observaciones_adicionales`, `Num_logros`, `Logros`, `Id_usuario`, `Id_profesional`) VALUES
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
  `Nombre` text NOT NULL,
  `Apellidos` text NOT NULL,
  `Contraseña` varchar(25) NOT NULL,
  `Correo` varchar(50) NOT NULL,
  `DNI` varchar(9) NOT NULL,
  `Id_profesional` int(5) NOT NULL,
  `Usuarios` text NOT NULL,
  `Num_usuarios` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `profesional`
--

INSERT INTO `profesional` (`Nombre`, `Apellidos`, `Contraseña`, `Correo`, `DNI`, `Id_profesional`, `Usuarios`, `Num_usuarios`) VALUES
('Sandra', 'Ramos Ramos', '1234', 'sandra@lifety', '45678923P', 0, 'Alex ', 1),
('Ivan', 'Ledesma Casado', '123', 'ivan@lifety', '45678923E', 1, '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `Nombre` text NOT NULL,
  `Apellidos` text NOT NULL,
  `DNI` varchar(9) NOT NULL,
  `Correo` varchar(50) NOT NULL,
  `Password` varchar(25) NOT NULL,
  `Id_usuario` int(5) NOT NULL,
  `Premium` tinyint(1) NOT NULL,
  `Nivel` char(1) DEFAULT NULL,
  `Dias` int(1) DEFAULT NULL,
  `Eobjetivo` int(1) DEFAULT NULL,
  `Dobjetivo` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`Nombre`, `Apellidos`, `DNI`, `Correo`, `Password`, `Id_usuario`, `Premium`, `Nivel`, `Dias`, `Eobjetivo`, `Dobjetivo`) VALUES
('Alex', '', '', '', '1', 0, 1, 'P', 5, 3, 1),
('Sandra', 'Ramos', '444444O', '', '2', 1, 0, NULL, NULL, NULL, 0),
('Prueba', 'A', '', '', '', 23, 0, NULL, NULL, NULL, NULL),
('Vacio', 'B', '', '', '', 25, 0, NULL, NULL, NULL, NULL),
('Kylian', 'Mbappe', '', '', '', 77, 0, NULL, NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `planificacion`
--
ALTER TABLE `planificacion`
  ADD KEY `Id_FK` (`Id_usuario`);

--
-- Indices de la tabla `premium`
--
ALTER TABLE `premium`
  ADD KEY `Id_FK` (`Id_usuario`),
  ADD KEY `Profesional_FK` (`Id_profesional`);

--
-- Indices de la tabla `profesional`
--
ALTER TABLE `profesional`
  ADD PRIMARY KEY (`Id_profesional`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`Id_usuario`);

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
