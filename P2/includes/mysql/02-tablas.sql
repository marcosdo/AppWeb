-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-03-2022 a las 12:13:42
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
  `link` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id_comida`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrena`
--

CREATE TABLE `entrena` (
  `nutri` text NOT NULL,
  `usuario` text NOT NULL
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
  `id_usuario` int(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
