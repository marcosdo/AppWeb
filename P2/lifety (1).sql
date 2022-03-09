-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-03-2022 a las 16:32:19
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
-- Estructura de tabla para la tabla `premium`
--

CREATE TABLE `premium` (
  `Peso` float NOT NULL,
  `Altura` float NOT NULL,
  `Alergias` text NOT NULL,
  `Observaciones adicionales` text NOT NULL,
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
  `Premium` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
