-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-03-2022 a las 15:26:57
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
--
-- Truncar tablas antes de insertar `profesional`
--

TRUNCATE TABLE `profesional`;
--
-- Volcado de datos para la tabla `profesional`
--

INSERT INTO `profesional` (`nombre`, `apellidos`, `correo`, `password`, `nutri`, `usuarios`, `num_usuarios`, `id_profesional`) VALUES
('Antonio', 'Pintus', 'pintus@lifety', '$2y$10$kwNuu0U4fEO7xYOEOH1QWOa4Zk7lnGLmnt9hrM1iV5hV4ASlq4TFu', 'Pintus', 'Floren,', 1, 1);

--
-- Truncar tablas antes de insertar `usuario`
--

TRUNCATE TABLE `usuario`;
--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`nombre`, `apellidos`, `correo`, `password`, `usuario`, `premium`, `id_usuario`) VALUES
('Kylian', 'Mbappe', 'rmcf', '$2y$10$kwNuu0U4fEO7xYOEOH1QWOa4Zk7lnGLmnt9hrM1iV5hV4ASlq4TFu', 'Floren', 1, 1),
('Erling', 'Halland', 'halland@lifety', '$2y$10$ZBoj.Ov4LQDcEBhTVhIso.x7y9SW3Visgbd6NFRC1g.JOBfj8wMGO', 'P$G', 0, 2);
COMMIT;
--
-- Truncar tablas antes de insertar `chat`
--

TRUNCATE TABLE `chat`;
--
-- Volcado de datos para la tabla `chat`
--

INSERT INTO `chat` (`Receptor`, `Origen`, `Contenido`, `Tiempo`, `Tipo`) VALUES
('Entrenador1', 'Usuario1', 'hola', '2022-03-15 16:48:53', 'U-E'),
('Usuario1', 'Entrenador1', 'asda', '2022-03-15 17:12:41', 'E-U');

--
-- Truncar tablas antes de insertar `comidas`
--

TRUNCATE TABLE `comidas`;
--
-- Volcado de datos para la tabla `comidas`
--

INSERT INTO `comidas` (`id_comida`, `objetivo`, `tipo`, `descripcion`) VALUES
(1, 1, 'Desayuno', 'Copos de avena con leche'),
(2, 1, 'Desayuno', 'Yogur con copos de avena'),
(3, 1, 'Desayuno', 'Tortitas de avena'),
(4, 2, 'Desayuno', 'Porridge de avena y frutos secos'),
(5, 2, 'Desayuno', 'Requeson con fruta'),
(6, 2, 'Desayuno', 'Sandwich de queso gouda con huevo duro'),
(7, 2, 'Desayuno', 'Batido de platano y avena'),
(8, 3, 'Desayuno', 'Smoothie Bowls'),
(9, 3, 'Desayuno', 'Hotcakes de avena y quinoa'),
(10, 3, 'Desayuno', 'Pudin'),
(11, 3, 'Desayuno', 'Wrap de pavo'),
(12, 1, 'Comida', 'Ensalada de calabacin a la plancha con queso feta'),
(13, 1, 'Comida', 'Albondigas de merluza y brocoli'),
(14, 1, 'Comida', 'Pechuga de pollo con soja y verduras salteadas'),
(15, 1, 'Comida', 'Caldo de verduras con tortilla francesa'),
(16, 2, 'Comida', 'Ensalada de patata hervida, tomate, pepino y huevo duro'),
(17, 2, 'Comida', 'Wok de verduras al curry con tiras de pollo'),
(18, 2, 'Comida', '.Berenjena y calabacin asado con pimenton dulce'),
(19, 2, 'Comida', 'Pure de calabaza con patata hervida'),
(20, 2, 'Comida', 'Tomates rellenos de lentejas'),
(21, 2, 'Comida', 'Revuelto de gambas y champinones'),
(22, 3, 'Cena', 'Pollo con verduras y queso batido al papillote'),
(23, 3, 'Cena', 'Salmon al horno con salsa de yogur'),
(24, 3, 'Cena', 'Sopa de pasta y hamburguesa con naranja picada'),
(25, 3, 'Cena', 'Crema de verduras y pechuga de pollo con manzana'),
(26, 3, 'Cena', 'Croquetas de pescado con pure de patata'),
(27, 3, 'Cena', 'Pollo a la naranja'),
(28, 3, 'Cena', 'Garbanzos con espinacas'),
(29, 3, 'Cena', 'Arroz tres delicias'),
(30, 1, 'Cena', 'Ensalada de patata hervida, tomate, pepino y huevo duro'),
(31, 1, 'Cena', 'Wok de verduras al curry con tiras de pollo'),
(32, 2, 'Cena', 'Hamburguesa de jamon york con mayonesa y queso'),
(33, 2, 'Cena', 'Minipizza cuatro quesos con naranja troceada'),
(34, 1, 'Comida', 'Pescado blanco a la plancha con ensalada de lechuga'),
(35, 1, 'Comida', 'Revuelto de dos huevos con verduras'),
(36, 1, 'Comida', 'Menestra de acelgas, zanahoria y patata'),
(37, 1, 'Comida', 'Alcachofas al horno y muslo de pollo a la plancha'),
(38, 1, 'Comida', 'Kinoa con verduras'),
(39, 1, 'Comida', 'Berenjena rellena de verduras y arroz integral'),
(40, 2, 'Comida', 'Pasta con setas salteadas'),
(41, 2, 'Comida', 'Arroz con pollo a la plancha'),
(42, 2, 'Comida', 'Cocido'),
(43, 2, 'Comida', 'Lentejas'),
(44, 2, 'Comida', 'Pollo con almendras chino'),
(45, 2, 'Comida', 'Fingers de pollo casero con salsa picante'),
(46, 2, 'Comida', 'Arroz integral con pasas y almendras'),
(47, 2, 'Comida', 'Pollo picante con cuscus'),
(48, 2, 'Comida', 'Pasta cremosa con pollo cajun'),
(49, 2, 'Comida', 'Paella de pollo y chorizo'),
(50, 2, 'Comida', 'Hamburguesa de pollo zingy'),
(51, 2, 'Comida', 'Quesadilla de pavo y aguacate'),
(52, 3, 'Comida', 'Pollo a la naranja'),
(53, 3, 'Comida', 'Garbanzos con espinacas'),
(54, 3, 'Comida', 'Arroz tres delicias'),
(55, 3, 'Comida', 'Conejo al horno con verduras'),
(56, 3, 'Comida', 'Salteado de verduras con pollo a la plancha'),
(57, 3, 'Comida', 'Tortilla de patatas con mayonesa'),
(58, 3, 'Comida', 'Lasana de verduras'),
(59, 3, 'Comida', 'Tallarines chinos con gambas'),
(60, 3, 'Comida', 'Merluza al horno con verduras'),
(61, 3, 'Comida', 'Revuelto de bacalao'),
(62, 3, 'Comida', 'Atun a la plancha con ajo y perejil'),
(63, 1, 'Desayuno', 'Tostada de pan integral con aguacate'),
(64, 2, 'Desayuno', 'Gofres proteicos'),
(65, 2, 'Desayuno', 'Brownie proteico'),
(66, 2, 'Desayuno', 'Gachas de avena proteicas'),
(67, 2, 'Desayuno', 'Muffins proteicos de yogurt helado'),
(68, 2, 'Desayuno', 'Vasitos de cheescake'),
(69, 2, 'Desayuno', 'Bocaditos proteicos de masa de galleta'),
(70, 3, 'Desayuno', 'Pudding'),
(71, 3, 'Desayuno', 'Wrap de pavo'),
(72, 3, 'Desayuno', 'Pan de platano relleno de cheesecake'),
(73, 3, 'Desayuno', 'Tortitas proteicas de platano'),
(74, 1, 'Cena', 'Berenjena y calabacin asado con pimenton dulce'),
(75, 1, 'Cena', 'Pure de calabaza con patata hervida'),
(76, 1, 'Cena', 'Tomates rellenos de lentejas'),
(77, 1, 'Cena', 'Revuelto de gambas con champinones'),
(78, 1, 'Cena', 'Pate de humus'),
(79, 2, 'Cena', 'Filete de buey con patata al horno y verduras'),
(80, 2, 'Cena', 'Macarrones con pisto'),
(81, 2, 'Cena', 'Ravioli con jamon york y tomate fresco'),
(82, 2, 'Cena', 'Ensalada de arroz con atun y mayonesa'),
(83, 2, 'Cena', 'Tagliatelle con salmon y nata'),
(84, 3, 'Cena', 'Conejo al horno con verduras'),
(85, 3, 'Cena', 'Salteado de verduras con pollo a la plancha'),
(86, 3, 'Cena', 'Tortilla de patatas con mayonesa'),
(87, 3, 'Cena', 'Lasana de verduras');

--
-- Truncar tablas antes de insertar `dieta`
--

TRUNCATE TABLE `dieta`;

--
-- Truncar tablas antes de insertar `ejercicios`
--

TRUNCATE TABLE `ejercicios`;
--
-- Volcado de datos para la tabla `ejercicios`
--

INSERT INTO `ejercicios` (`musculo`, `nombre`) VALUES
('Hombro', 'Elevacion lateral'),
('Hombro', 'Press hombro'),
('Hombro', 'Remo al menton'),
('Hombro', 'Press militar'),
('Pierna', 'Sentadilla'),
('Pierna', 'Prensa'),
('Pierna', 'Extension de cuadriceps'),
('Pierna', 'Hip thrust'),
('Pecho', 'Press banca'),
('Pecho', 'Aperturas con mancuernas'),
('Pecho', 'Press banca inclinado'),
('Pecho', 'Maquina de empuje'),
('Triceps', 'Fondos'),
('Triceps', 'Press frances'),
('Triceps', 'Extensiones'),
('Triceps', 'Barras paralelas'),
('Biceps', 'Curl spider'),
('Biceps', 'Predicador'),
('Biceps', 'Martillo'),
('Biceps', 'Chin-ups'),
('Espalda', 'Jalon'),
('Espalda', 'Remo en T'),
('Espalda', 'Remo con barra'),
('Espalda', 'Renegade row');

--
-- Truncar tablas antes de insertar `planificacion`
--

TRUNCATE TABLE `planificacion`;
--
-- Volcado de datos para la tabla `planificacion`
--

INSERT INTO `planificacion` (`id_usuario`, `rutina`, `eobjetivo`, `dias`, `nivel`) VALUES
(1, '[[\"Press banca\",\"Aperturas con mancuernas\",\"Elevacion lateral\",\"Press hombro\"],[\"Jalon\",\"Remo en T\",\"Curl spider\",\"Predicador\"],[\"Sentadilla\",\"Prensa\",\"Fondos\",\"Press frances\"]]', 1, 3, 'P'),
(2, '[[\"Press banca\",\"Aperturas con mancuernas\",\"Elevacion lateral\",\"Press hombro\"],[\"Jalon\",\"Remo en T\",\"Curl spider\",\"Predicador\"],[\"Sentadilla\",\"Prensa\",\"Fondos\",\"Press frances\"]]', 1, 3, 'P');

--
-- Truncar tablas antes de insertar `premium`
--

TRUNCATE TABLE `premium`;
--
-- Volcado de datos para la tabla `premium`
--

INSERT INTO `premium` (`peso`, `altura`, `alergias`, `observaciones_adicionales`, `num_logros`, `logros`, `id_usuario`, `id_profesional`) VALUES
(75, 170, '', '', 0, '', 1, 1);



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
