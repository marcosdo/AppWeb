-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-03-2022 a las 11:45:24
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

--
-- Volcado de datos para la tabla `chat`
--

INSERT INTO `chat` (`Receptor`, `Origen`, `Contenido`, `Tiempo`, `Tipo`) VALUES
('Entrenador1', 'Usuario1', 'hola', '2022-03-15 16:48:53', 'U-E'),
('Usuario1', 'Entrenador1', 'asda', '2022-03-15 17:12:41', 'E-U');

--
-- Volcado de datos para la tabla `comidas`
--

INSERT INTO `comidas` (`id_comida`, `objetivo`, `tipo`, `descripcion`) VALUES
(1, 1, 'Desayuno', 'Copos de avena con leche'),
(2, 1, 'Desayuno', 'Yogur con copos de avena'),
(3, 1, 'Desayuno', 'Tortitas de avena'),
(4, 2, 'Desayuno', 'Porridge de avena y frutos secos'),
(5, 2, 'Desayuno', 'Requesón con fruta'),
(6, 2, 'Desayuno', 'Sándwich de queso gouda con huevo duro'),
(7, 2, 'Desayuno', 'Batido de platano y avena'),
(8, 3, 'Desayuno', 'Smoothie Bowls'),
(9, 3, 'Desayuno', 'Hotcakes de avena y quinoa'),
(10, 3, 'Desayuno', 'Pudín'),
(11, 3, 'Desayuno', 'Wrap de pavo'),
(12, 1, 'Comida', 'Ensalada de calabacín a la plancha con q'),
(13, 1, 'Comida', 'Albondigas de merluza y brocoli'),
(14, 1, 'Comida', 'Pechuga de pollo con soja y verduras salteadas'),
(15, 1, 'Comida', 'Caldo de verduras con tortilla francesa'),
(16, 2, 'Comida', 'Ensalada de patata hervida, tomate, pepino y huevo duro'),
(17, 2, 'Comida', 'Wok de verduras al curry con tiras de pollo'),
(18, 2, 'Comida', '.Berenjena y calabacín asado con pimentón dulce'),
(19, 2, 'Comida', 'Puré de calabaza con patata hervida'),
(20, 2, 'Comida', 'Tomates rellenos de lentejas'),
(21, 2, 'Comida', 'Revuelto de gambas y champiñones'),
(22, 3, 'Cena', 'Pollo con verduras y queso batido al papillote'),
(23, 3, 'Cena', 'Salmón al horno con salsa de yogur'),
(24, 3, 'Cena', 'Sopa de pasta y hamburguesa con naranja picada'),
(25, 3, 'Cena', 'Crema de verduras y pechuga de pollo con manzana'),
(26, 3, 'Cena', 'Croquetas de pescado con pure de patata'),
(27, 3, 'Cena', 'Pollo a la naranja'),
(28, 3, 'Cena', 'Garbanzos con espinacas'),
(29, 3, 'Cena', 'Arroz tres delicias'),
(30, 1, 'Cena', 'Ensalada de patata hervida, tomate, pepino y huevo duro'),
(31, 1, 'Cena', 'Wok de verduras al curry con tiras de pollo'),
(32, 2, 'Cena', 'Hamburguesa de jamón york con mayonesa y queso'),
(33, 2, 'Cena', 'Minipizza cuatro quesos con naranja troceada'),
(34, 3, 'Comida', 'Pollo con almendras chino'),
(35, 3, 'Comida', 'Atún a la plancha con ajo y perejil');
--
--
-- Volcado de datos para la tabla `profesional`
--

INSERT INTO `profesional` (`nombre`, `apellidos`, `correo`, `password`, `nutri`, `usuarios`, `num_usuarios`, `id_profesional`) VALUES
('Antonio', 'Pintus', 'pintus@lifety', '$2y$10$kwNuu0U4fEO7xYOEOH1QWOa4Zk7lnGLmnt9hrM1iV5hV4ASlq4TFu', 'Pintus', '', 1, 1);

--
--
-- Volcado de datos para la tabla `dieta`
--

INSERT INTO `dieta` (`id_usuario`, `objetivo`, `desayunos`, `comidas`, `cenas`) VALUES
(1, 3, '[\"Pudu00edn\",\"Smoothie Bowls\",\"Wrap de pavo\",\"Wrap de pavo\",\"Hotcakes de avena y quinoa\",\"Smoothie Bowls\",\"Hotcakes de avena y quinoa\"]', '[\"Atu00fan a la plancha con ajo y perejil\",\"Pollo con almendras chino\",\"Atu00fan a la plancha con ajo y perejil\",\"Atu00fan a la plancha con ajo y perejil\",\"Pollo con almendras chino\",\"Atu00fan a la plancha con ajo y perejil\",\"Pollo con almendras chino\"]', '[\"Pollo a la naranja\",\"Pollo a la naranja\",\"Pollo con verduras y queso batido al papillote\",\"Pollo con verduras y queso batido al papillote\",\"Arroz tres delicias\",\"Pollo con verduras y queso batido al papillote\",\"Salmu00f3n al horno con salsa de yogur\"]');

--
-- Volcado de datos para la tabla `dietas`
--

INSERT INTO `dietas` (`objetivo`, `descripcion`, `tipo`) VALUES
(1, 'Copos de avena con leche', 'Desayuno'),
(1, 'Espinacas con pollo plancha', 'Comida'),
(1, 'Crema de calabaza y gallo', 'Cena'),
(1, 'Pollo asado y judias verdes', 'Comida'),
(1, 'Menestra de verduras y salmon', 'Cena'),
(2, 'Tosta de huevos y tomate', 'Desayuno'),
(2, 'Tortitas de arroz', 'Desayuno'),
(2, 'Tosta de huevos y tomate', 'Desayuno'),
(1, 'Leche desnatada con avena', 'Desayuno'),
(1, 'Yogur con copos de avena', 'Desayuno'),
(1, 'Tortitas de avena', 'Desayuno'),
(2, 'Porridge de avena y frutos secos', 'Desayuno'),
(2, 'Requeson con fruta', 'Desayuno'),
(2, 'Sandwich de queso gouda con huevo duro', 'Desayuno'),
(2, 'Batido de platano y avena', 'Desayuno'),
(3, 'Smoothie Bowls', 'Desayuno'),
(3, 'Hotcakes de avena y quinoa', 'Desayuno'),
(3, 'Pudin', 'Desayuno'),
(3, 'Wrap de pavo', 'Desayuno'),
(1, 'Ensalada de calabacin a la plancha', 'Comida'),
(1, 'Albondigas de merluza y brocoli', 'Comida'),
(1, 'Pechuga de pollo con soja y verduras salteadas', 'Comida'),
(1, 'Caldo de verduras con tortilla francesa', 'Comida'),
(2, 'Ensalada de patata hervida, tomate, pepino y huevo duro', 'Comida'),
(2, 'Wok de verduras al curry con tiras de pollo', 'Comida'),
(2, 'Berenjena y calabacin asado con pimenton dulce', 'Comida'),
(2, 'Pure de calabaza con patata hervida', 'Comida'),
(2, 'Tomates rellenos de lentejas', 'Comida'),
(2, 'Revuelto de gambas y champiñones', 'Comida'),
(2, 'Pollo picante con cuscus', 'Cena'),
(2, 'Ensalada campera', 'Comida'),
(2, 'Merluza a la plancha con ensalada', 'Cena'),
(3, 'Pollo con verduras y queso batido al papillote', 'Cena'),
(3, 'Salmon al horno con salsa de yogur', 'Cena'),
(3, 'Sopa de pasta y hamburguesa con naranja picada', 'Cena'),
(3, 'Crema de verduras y pechuga de pollo con manzana', 'Cena'),
(3, 'Croquetas de pescado con pure de patata', 'Cena'),
(3, 'Pollo a la naranja', 'Cena'),
(3, 'Garbanzos con espinacas', 'Cena'),
(3, 'Arroz tres delicias', 'Cena'),
(1, 'Ensalada de patata hervida, tomate, pepino y huevo duro', 'Cena'),
(1, 'Wok de verduras al curry con tiras de pollo', 'Cena'),
(2, 'Hamburguesa de jamon york con mayonesa y queso', 'Cena'),
(2, 'Minipizza cuatro quesos con naranja troceada', 'Cena'),
(3, 'Pollo con almendras chino', 'Comida'),
(3, 'Atún a la plancha con ajo y perejil', 'Comida');

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
-- Volcado de datos para la tabla `planificacion`
--

INSERT INTO `planificacion` (`id_usuario`, `rutina`, `eobjetivo`, `dias`, `nivel`) VALUES
(1, '[[\"Press banca\",\"Aperturas con mancuernas\",\"Elevacion lateral\",\"Press hombro\"],[\"Jalon\",\"Remo en T\",\"Curl spider\",\"Predicador\"],[\"Sentadilla\",\"Prensa\",\"Fondos\",\"Press frances\"],[\"Press banca\",\"Aperturas con mancuernas\",\"Elevacion lateral\",\"Press hombro\",\"Jalon\",\"Remo en T\"],[\"Curl spider\",\"Predicador\",\"Sentadilla\",\"Prensa\",\"Fondos\",\"Press frances\"]]', 1, 5, 'P');

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`nombre`, `apellidos`, `correo`, `password`, `usuario`, `premium`, `id_usuario`) VALUES
('Kylian', 'Mbappe', 'rmcf', '$2y$10$kwNuu0U4fEO7xYOEOH1QWOa4Zk7lnGLmnt9hrM1iV5hV4ASlq4TFu', 'Floren', 0, 1),
('Alexin', 'Magarzo', 'amagarzo@ucm.es', '$2y$10$N4nhU68Ap/9gclz95Q416eiFSDw2Pb71oqlTDgX9Rw3XKFL96WuNq', 'Alexin', 0, 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
