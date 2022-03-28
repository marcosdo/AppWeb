SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Estructura de tabla para la tabla `dieta`
--

DROP TABLE IF EXISTS `dieta`;
CREATE TABLE IF NOT EXISTS `dieta` (
  `id_usuario` int(5) NOT NULL,
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
-- Filtros para la tabla `dieta`
--
ALTER TABLE `dieta`
  ADD CONSTRAINT `clave-dieta-almurezo` FOREIGN KEY (`id_almuerzo`) REFERENCES `comidas` (`id_comida`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `clave-dieta-cena` FOREIGN KEY (`id_cena`) REFERENCES `comidas` (`id_comida`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `clave-dieta-desayuno` FOREIGN KEY (`id_desayuno`) REFERENCES `comidas` (`id_comida`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `clave-dieta-usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

SET FOREIGN_KEY_CHECKS=1;
COMMIT;