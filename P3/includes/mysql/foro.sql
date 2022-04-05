-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-04-2022 a las 10:58:47
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
-- Estructura de tabla para la tabla `foro`
--

DROP TABLE IF EXISTS `foro`;
CREATE TABLE IF NOT EXISTS `foro` (
  `id_foro` int(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_usuario` int(5) UNSIGNED NOT NULL,
  `tema` varchar(20) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `contenido` varchar(500) NOT NULL,
  `categoria` enum('Nutricion','Dieta') NOT NULL,
  `respuestas` int(5) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_foro`),
  UNIQUE KEY `tema` (`tema`),
  KEY `usuar_PK` (`id_usuario`)
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
  `prioridad` int(5) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_mensaje`),
  KEY `Tema_FK` (`id_foro`),
  KEY `Mensaje_FK` (`id_referencia`),
  KEY `Autor_KF` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `mensaje`
--

TRUNCATE TABLE `mensaje`;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `foro`
--
ALTER TABLE `foro`
  ADD CONSTRAINT `usuar_PK` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD CONSTRAINT `Autor_KF` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Mensaje_FK` FOREIGN KEY (`id_referencia`) REFERENCES `mensaje` (`id_mensaje`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Tema_FK` FOREIGN KEY (`id_foro`) REFERENCES `foro` (`id_foro`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
