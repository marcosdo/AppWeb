-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-03-2022 a las 11:44:47
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 8.0.6

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
  `Eobjetivo` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`Nombre`, `Apellidos`, `DNI`, `Correo`, `Password`, `Id_usuario`, `Premium`, `Nivel`, `Dias`, `Eobjetivo`) VALUES
('Alex', '', '', '', '1', 0, 1, 'P', NULL, 1),
('Sandra', 'Ramos', '444444O', '', '2', 1, 0, NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

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
-- Filtros para la tabla `premium`
--
ALTER TABLE `premium`
  ADD CONSTRAINT `Profesional_FK` FOREIGN KEY (`Id_profesional`) REFERENCES `profesional` (`Id_profesional`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
