-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-03-2022 a las 17:14:58
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
-- Base de datos: `practica 2 aw`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejercicios`
--

CREATE TABLE `ejercicios` (
  `Musculo` varchar(20) DEFAULT NULL,
  `Nombre` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ejercicios`
--

INSERT INTO `ejercicios` (`Musculo`, `Nombre`) VALUES
('Pierna', 'Sentadilla'),
('Pierna', 'Prensa'),
('Pecho', 'Press banca'),
('Pecho', 'Aperturas con mancue'),
('Pecho', 'Press banca inclinad'),
('Pecho', 'Maquina de empuje'),
('Pierna', 'Extension de cruadri'),
('Pierna', 'Hip thrust'),
('Hombro', 'Elevacion lateral'),
('Hombro', 'Press hombro'),
('Hombro', 'Remo al menton'),
('Triceps', 'Fondos'),
('Triceps', 'Press frances'),
('Triceps', 'Extensiones'),
('Biceps', 'Curl araña'),
('Biceps', 'Predicador'),
('Biceps', 'Martillo'),
('Espalda', 'Jalon'),
('Espalda', 'Remo T'),
('Espalda', 'Remo con barra');

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
  `Logros` int(2) DEFAULT NULL,
  `Id_usuario` int(5) NOT NULL,
  `Id_profesional` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesional`
--

CREATE TABLE `profesional` (
  `Nombre` text NOT NULL,
  `Apellido 1` text NOT NULL,
  `Apellido 2` text NOT NULL,
  `Contraseña` varchar(25) NOT NULL,
  `Correo` varchar(50) NOT NULL,
  `DNI` int(9) NOT NULL,
  `Id_profesional` int(5) NOT NULL,
  `Usuarios` text NOT NULL,
  `Num_usuarios` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `Nombre` text NOT NULL,
  `Apellido 1` text NOT NULL,
  `Apellido 2` text NOT NULL,
  `DNI` varchar(9) NOT NULL,
  `Correo` varchar(50) NOT NULL,
  `Contraseña` varchar(25) NOT NULL,
  `Id_usuario` int(5) NOT NULL,
  `Premium` tinyint(1) NOT NULL,
  `Nivel` char(1) DEFAULT NULL,
  `Dias` int(1) DEFAULT NULL,
  `Eobjetivo` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`Nombre`, `Apellido 1`, `Apellido 2`, `DNI`, `Correo`, `Contraseña`, `Id_usuario`, `Premium`, `Nivel`, `Dias`, `Eobjetivo`) VALUES
('Alex', '', '', '', '', '', 0, 0, 'P', NULL, 1);

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
