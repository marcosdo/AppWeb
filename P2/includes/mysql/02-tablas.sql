-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-03-2022 a las 15:25:30
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejercicios`
--

DROP TABLE IF EXISTS `ejercicios`;
CREATE TABLE IF NOT EXISTS `ejercicios` (
  `musculo` varchar(40) DEFAULT NULL,
  `nombre` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planificacion`
--

DROP TABLE IF EXISTS `planificacion`;
CREATE TABLE IF NOT EXISTS `planificacion` (
  `id_usuario` int(5) NOT NULL,
  `rutina` text DEFAULT NULL,
  `eobjetivo` int(1) DEFAULT NULL,
  `dias` int(1) DEFAULT NULL,
  `nivel` char(1) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
