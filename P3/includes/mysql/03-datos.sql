-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-04-2022 a las 15:46:31
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.2

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

--
-- Truncar tablas antes de insertar `anuncio`
--

TRUNCATE TABLE `anuncio`;
--
-- Truncar tablas antes de insertar `categorias`
--

TRUNCATE TABLE `categorias`;
--
-- Truncar tablas antes de insertar `chat`
--

TRUNCATE TABLE `chat`;
--
-- Volcado de datos para la tabla `chat`
--

INSERT INTO `chat` (`Receptor`, `Origen`, `Contenido`, `Tiempo`, `Tipo`) VALUES
('pintus', 'perspa', 'hola que tal', '2022-04-10 15:27:50', 'U-E');

--
-- Truncar tablas antes de insertar `comidas`
--

TRUNCATE TABLE `comidas`;
--
-- Volcado de datos para la tabla `comidas`
--

INSERT INTO `comidas` (`id_comida`, `objetivo`, `tipo`, `descripcion`, `link`) VALUES
(1, 1, 'Desayuno', 'Copos de avena con leche', ''),
(2, 1, 'Desayuno', 'Yogur con copos de avena', ''),
(3, 1, 'Desayuno', 'Tortitas de avena', ''),
(4, 2, 'Desayuno', 'Porridge de avena y frutos secos', ''),
(5, 2, 'Desayuno', 'Requeson con fruta', ''),
(6, 2, 'Desayuno', 'Sandwich de queso gouda con huevo duro', ''),
(7, 2, 'Desayuno', 'Batido de platano y avena', ''),
(8, 3, 'Desayuno', 'Smoothie Bowls', ''),
(9, 3, 'Desayuno', 'Hotcakes de avena y quinoa', ''),
(10, 3, 'Desayuno', 'Pudin', ''),
(11, 3, 'Desayuno', 'Wrap de pavo', ''),
(12, 1, 'Comida', 'Ensalada de calabacin a la plancha con queso feta', ''),
(13, 1, 'Comida', 'Albondigas de merluza y brocoli', ''),
(14, 1, 'Comida', 'Pechuga de pollo con soja y verduras salteadas', ''),
(15, 1, 'Comida', 'Caldo de verduras con tortilla francesa', ''),
(16, 2, 'Comida', 'Ensalada de patata hervida, tomate, pepino y huevo duro', ''),
(17, 2, 'Comida', 'Wok de verduras al curry con tiras de pollo', ''),
(18, 2, 'Comida', '.Berenjena y calabacin asado con pimenton dulce', ''),
(19, 2, 'Comida', 'Pure de calabaza con patata hervida', ''),
(20, 2, 'Comida', 'Tomates rellenos de lentejas', ''),
(21, 2, 'Comida', 'Revuelto de gambas y champinones', ''),
(22, 3, 'Cena', 'Pollo con verduras y queso batido al papillote', ''),
(23, 3, 'Cena', 'Salmon al horno con salsa de yogur', ''),
(24, 3, 'Cena', 'Sopa de pasta y hamburguesa con naranja picada', ''),
(25, 3, 'Cena', 'Crema de verduras y pechuga de pollo con manzana', ''),
(26, 3, 'Cena', 'Croquetas de pescado con pure de patata', ''),
(27, 3, 'Cena', 'Pollo a la naranja', ''),
(28, 3, 'Cena', 'Garbanzos con espinacas', ''),
(29, 3, 'Cena', 'Arroz tres delicias', ''),
(30, 1, 'Cena', 'Ensalada de patata hervida, tomate, pepino y huevo duro', ''),
(31, 1, 'Cena', 'Wok de verduras al curry con tiras de pollo', ''),
(32, 2, 'Cena', 'Hamburguesa de jamon york con mayonesa y queso', ''),
(33, 2, 'Cena', 'Minipizza cuatro quesos con naranja troceada', ''),
(34, 1, 'Comida', 'Pescado blanco a la plancha con ensalada de lechuga', ''),
(35, 1, 'Comida', 'Revuelto de dos huevos con verduras', ''),
(36, 1, 'Comida', 'Menestra de acelgas, zanahoria y patata', ''),
(37, 1, 'Comida', 'Alcachofas al horno y muslo de pollo a la plancha', ''),
(38, 1, 'Comida', 'Kinoa con verduras', ''),
(39, 1, 'Comida', 'Berenjena rellena de verduras y arroz integral', ''),
(40, 2, 'Comida', 'Pasta con setas salteadas', ''),
(41, 2, 'Comida', 'Arroz con pollo a la plancha', ''),
(42, 2, 'Comida', 'Cocido', ''),
(43, 2, 'Comida', 'Lentejas', ''),
(44, 2, 'Comida', 'Pollo con almendras chino', ''),
(45, 2, 'Comida', 'Fingers de pollo casero con salsa picante', ''),
(46, 2, 'Comida', 'Arroz integral con pasas y almendras', ''),
(47, 2, 'Comida', 'Pollo picante con cuscus', ''),
(48, 2, 'Comida', 'Pasta cremosa con pollo cajun', ''),
(49, 2, 'Comida', 'Paella de pollo y chorizo', ''),
(50, 2, 'Comida', 'Hamburguesa de pollo zingy', ''),
(51, 2, 'Comida', 'Quesadilla de pavo y aguacate', ''),
(52, 3, 'Comida', 'Pollo a la naranja', ''),
(53, 3, 'Comida', 'Garbanzos con espinacas', ''),
(54, 3, 'Comida', 'Arroz tres delicias', ''),
(55, 3, 'Comida', 'Conejo al horno con verduras', ''),
(56, 3, 'Comida', 'Salteado de verduras con pollo a la plancha', ''),
(57, 3, 'Comida', 'Tortilla de patatas con mayonesa', ''),
(58, 3, 'Comida', 'Lasana de verduras', ''),
(59, 3, 'Comida', 'Tallarines chinos con gambas', ''),
(60, 3, 'Comida', 'Merluza al horno con verduras', ''),
(61, 3, 'Comida', 'Revuelto de bacalao', ''),
(62, 3, 'Comida', 'Atun a la plancha con ajo y perejil', ''),
(63, 1, 'Desayuno', 'Tostada de pan integral con aguacate', ''),
(64, 2, 'Desayuno', 'Gofres proteicos', ''),
(65, 2, 'Desayuno', 'Brownie proteico', ''),
(66, 2, 'Desayuno', 'Gachas de avena proteicas', ''),
(67, 2, 'Desayuno', 'Muffins proteicos de yogurt helado', ''),
(68, 2, 'Desayuno', 'Vasitos de cheescake', ''),
(69, 2, 'Desayuno', 'Bocaditos proteicos de masa de galleta', ''),
(70, 3, 'Desayuno', 'Pudding', ''),
(71, 3, 'Desayuno', 'Wrap de pavo', ''),
(72, 3, 'Desayuno', 'Pan de platano relleno de cheesecake', ''),
(73, 3, 'Desayuno', 'Tortitas proteicas de platano', ''),
(74, 1, 'Cena', 'Berenjena y calabacin asado con pimenton dulce', ''),
(75, 1, 'Cena', 'Pure de calabaza con patata hervida', ''),
(76, 1, 'Cena', 'Tomates rellenos de lentejas', ''),
(77, 1, 'Cena', 'Revuelto de gambas con champinones', ''),
(78, 1, 'Cena', 'Pate de humus', ''),
(79, 2, 'Cena', 'Filete de buey con patata al horno y verduras', ''),
(80, 2, 'Cena', 'Macarrones con pisto', ''),
(81, 2, 'Cena', 'Ravioli con jamon york y tomate fresco', ''),
(82, 2, 'Cena', 'Ensalada de arroz con atun y mayonesa', ''),
(83, 2, 'Cena', 'Tagliatelle con salmon y nata', ''),
(84, 3, 'Cena', 'Conejo al horno con verduras', ''),
(85, 3, 'Cena', 'Salteado de verduras con pollo a la plancha', ''),
(86, 3, 'Cena', 'Tortilla de patatas con mayonesa', ''),
(87, 3, 'Cena', 'Lasana de verduras', '');

--
-- Truncar tablas antes de insertar `contiene`
--

TRUNCATE TABLE `contiene`;
--
-- Volcado de datos para la tabla `contiene`
--

INSERT INTO `contiene` (`id_rutina`, `id_ejercicio`, `dia`, `repeticiones`) VALUES
(91, 8, 1, 6),
(91, 9, 1, 14),
(91, 0, 1, 14),
(91, 1, 1, 6),
(91, 20, 2, 6),
(91, 21, 2, 6),
(91, 16, 2, 14),
(91, 17, 2, 8),
(91, 4, 3, 6),
(91, 5, 3, 6),
(91, 12, 3, 6),
(91, 13, 3, 8),
(92, 8, 1, 6),
(92, 9, 1, 14),
(92, 0, 1, 14),
(92, 1, 1, 6),
(92, 20, 2, 6),
(92, 21, 2, 6),
(92, 16, 2, 14),
(92, 17, 2, 8),
(92, 4, 3, 6),
(92, 5, 3, 6),
(92, 12, 3, 6),
(92, 13, 3, 8);

--
-- Truncar tablas antes de insertar `dieta`
--

TRUNCATE TABLE `dieta`;
--
-- Volcado de datos para la tabla `dieta`
--

INSERT INTO `dieta` (`id_usuario`, `fecha`, `id_desayuno`, `id_almuerzo`, `id_cena`, `tipo`) VALUES
(36, '2022-04-10', 1, 12, 30, 1),
(36, '2022-04-11', 2, 13, 31, 1),
(36, '2022-04-12', 3, 34, 74, 1),
(36, '2022-04-13', 63, 35, 75, 1),
(36, '2022-04-14', 1, 36, 76, 1),
(36, '2022-04-15', 2, 37, 77, 1),
(36, '2022-04-16', 3, 39, 78, 1);

--
-- Truncar tablas antes de insertar `ejercicios`
--

TRUNCATE TABLE `ejercicios`;
--
-- Volcado de datos para la tabla `ejercicios`
--

INSERT INTO `ejercicios` (`id_ejercicio`, `tipo`, `musculo`, `nombre`, `descripcion`, `imagen`) VALUES
(0, 2, 'Hombro', 'Elevacion lateral', '', ''),
(1, 0, 'Hombro', 'Press hombro', '', ''),
(2, 1, 'Hombro', 'Remo al menton', '', ''),
(3, 0, 'Hombro', 'Press militar', '', ''),
(4, 0, 'Pierna', 'Sentadilla', '', ''),
(5, 0, 'Pierna', 'Prensa', '', ''),
(6, 1, 'Pierna', 'Extension de cuadriceps', '', ''),
(7, 1, 'Pierna', 'Hip thrust', '', ''),
(8, 0, 'Pecho', 'Press banca', '', ''),
(9, 2, 'Pecho', 'Aperturas con mancuernas', '', ''),
(10, 0, 'Pecho', 'Press banca inclinado', '', ''),
(11, 1, 'Pecho', 'Maquina de empuje', '', ''),
(12, 0, 'Triceps', 'Fondos', '', ''),
(13, 1, 'Triceps', 'Press frances', '', ''),
(14, 2, 'Triceps', 'Extensiones', '', ''),
(15, 1, 'Triceps', 'Barras paralelas', '', ''),
(16, 2, 'Biceps', 'Curl spider', '', ''),
(17, 1, 'Biceps', 'Predicador', '', ''),
(18, 1, 'Biceps', 'Martillo', '', ''),
(19, 1, 'Biceps', 'Chin-ups', '', ''),
(20, 0, 'Espalda', 'Jalon', '', ''),
(21, 0, 'Espalda', 'Remo en T', '', ''),
(22, 1, 'Espalda', 'Remo con barra', '', ''),
(23, 1, 'Espalda', 'Renegade row', '', '');

--
-- Truncar tablas antes de insertar `empresas`
--

TRUNCATE TABLE `empresas`;
--
-- Truncar tablas antes de insertar `entrena`
--

TRUNCATE TABLE `entrena`;
--
-- Volcado de datos para la tabla `entrena`
--

INSERT INTO `entrena` (`nutri`, `usuario`) VALUES
('pintus', 'perspa'),
('pintus', 'perspa');

--
-- Truncar tablas antes de insertar `foro`
--

TRUNCATE TABLE `foro`;
--
-- Truncar tablas antes de insertar `mensaje`
--

TRUNCATE TABLE `mensaje`;
--
-- Truncar tablas antes de insertar `noticias`
--

TRUNCATE TABLE `noticias`;
--
-- Truncar tablas antes de insertar `personas`
--

TRUNCATE TABLE `personas`;
--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id_usuario`, `nick`, `nombre`, `apellidos`, `correo`, `contraseña`, `rol`) VALUES
(8, 'admin0', 'Dwayne', 'Johnson', 'dwayne@lifety.com', '$2y$10$uAGG3yMjH7sBX9Qc2QEXZeJoc92buC2qPgxt2x0zdLv3Th3lrp4c.', 0),
(31, 'pintus', 'Antonio', 'Pintus', 'pintus@lifety.es', '$2y$10$4HMCjZeRUdGa.USKL.GCi.1bKkrkWWLpyF0n43517XSOOVmvQwDGG', 2),
(32, 'anakin', 'Anakin', 'Skywalker', 'anakin@ucm.es', '$2y$10$uOz6PMvV6YOUHm3b6Is6juMm1PG5zF1Vyp175pSCVGMpweIj4xzki', 1),
(35, 'admin2', 'Mark', 'Wahlberg', 'markwa@lifety.es', '$2y$10$LqSxgop6C4kalnXJsXYMZe1zVqg0T4.AokRa1cdxkyjHsxnkd6HcG', 0),
(36, 'perspa', 'Persona', 'P&aacute;jaro', 'perspa@ucm.es', '$2y$10$5XbQuYbufL5BkjaB3x.LLOnfZMrOkEBuz7jSZLZQjehc261drjb6S', 1),
(37, 'flavio', 'Flavio', 'Briatore', 'flavio@ucm.es', '$2y$10$Hhaw6oPpK.M2FC62Jx0de.wnnv3WUvXIojKATcMv2doTde6ukpmBy', 1);

--
-- Truncar tablas antes de insertar `pertenece`
--

TRUNCATE TABLE `pertenece`;
--
-- Truncar tablas antes de insertar `premium`
--

TRUNCATE TABLE `premium`;
--
-- Volcado de datos para la tabla `premium`
--

INSERT INTO `premium` (`id_usuario`, `id_profesional`, `peso`, `altura`, `alergias`, `observaciones_adicionales`, `num_logros`, `logros`) VALUES
(36, 31, 70, 1, 'no', 'no', 0, '');

--
-- Truncar tablas antes de insertar `productos`
--

TRUNCATE TABLE `productos`;
--
-- Truncar tablas antes de insertar `profesional`
--

TRUNCATE TABLE `profesional`;
--
-- Volcado de datos para la tabla `profesional`
--

INSERT INTO `profesional` (`id_profesional`, `nutri`, `num_usuarios`, `usuarios`) VALUES
(31, 'pintus', 2, '');

--
-- Truncar tablas antes de insertar `rutina`
--

TRUNCATE TABLE `rutina`;
--
-- Volcado de datos para la tabla `rutina`
--

INSERT INTO `rutina` (`id_rutina`, `id_usuario`, `activa`, `objetivo`, `nivel`, `dias`) VALUES
(91, 36, 1, 1, 'P', 3),
(92, 32, 1, 1, 'P', 3);

--
-- Truncar tablas antes de insertar `usuario`
--

TRUNCATE TABLE `usuario`;
--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `premium`) VALUES
(32, 0),
(35, 0),
(36, 1);
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
