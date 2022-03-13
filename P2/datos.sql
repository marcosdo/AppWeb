-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-03-2022 a las 17:24:12
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
-- Volcado de datos para la tabla `dietas`
--

INSERT INTO `dietas` (`Objetivo`, `descripcion`, `Tipo`) VALUES
(1, 'Copos de avena con leche', 'Desayuno'),
(1, 'Yogur con copos de avena', 'Desayuno'),
(1, 'Tortitas de avena', 'Desayuno'),
(2, 'Porridge de avena y frutos secos', 'Desayuno'),
(2, 'Requesón con fruta', 'Desayuno'),
(2, 'Sándwich de queso gouda con huevo duro', 'Desayuno'),
(2, 'Batido de platano y avena', 'Desayuno'),
(3, 'Smoothie Bowls', 'Desayuno'),
(3, 'Hotcakes de avena y quinoa', 'Desayuno'),
(3, 'Pudín', 'Desayuno'),
(3, 'Wrap de pavo', 'Desayuno'),
(1, 'Ensalada de calabacín a la plancha con q', 'Comida'),
(1, 'Albondigas de merluza y brocoli', 'Comida'),
(1, 'Pechuga de pollo con soja y verduras salteadas', 'Comida'),
(1, 'Caldo de verduras con tortilla francesa', 'Comida'),
(2, 'Ensalada de patata hervida, tomate, pepino y huevo duro', 'Comida'),
(2, 'Wok de verduras al curry con tiras de pollo', 'Comida'),
(2, '.Berenjena y calabacín asado con pimentón dulce', 'Comida'),
(2, 'Puré de calabaza con patata hervida', 'Comida'),
(2, 'Tomates rellenos de lentejas', 'Comida'),
(2, 'Revuelto de gambas y champiñones', 'Comida'),
(3, 'Pollo con verduras y queso batido al papillote', 'Cena'),
(3, 'Salmón al horno con salsa de yogur', 'Cena'),
(3, 'Sopa de pasta y hamburguesa con naranja picada', 'Cena'),
(3, 'Crema de verduras y pechuga de pollo con manzana', 'Cena'),
(3, 'Croquetas de pescado con pure de patata', 'Cena'),
(3, 'Pollo a la naranja', 'Cena'),
(3, 'Garbanzos con espinacas', 'Cena'),
(3, 'Arroz tres delicias', 'Cena'),
(1, 'Ensalada de patata hervida, tomate, pepino y huevo duro', 'Cena'),
(1, 'Wok de verduras al curry con tiras de pollo', 'Cena'),
(2, 'Hamburguesa de jamón york con mayonesa y queso', 'Cena'),
(2, 'Minipizza cuatro quesos con naranja troceada', 'Cena'),
(3, 'Pollo con almendras chino', 'Comida'),
(3, 'Atún a la plancha con ajo y perejil', 'Comida');

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

--
-- Volcado de datos para la tabla `profesional`
--

INSERT INTO `profesional` (`Nombre`, `Apellidos`, `Contraseña`, `Correo`, `DNI`, `Id_profesional`, `Usuarios`, `Num_usuarios`) VALUES
('Sandra', 'Ramos Ramos', '1234', 'sandra@lifety', '45678923P', 0, 'Alex ', 1),
('Ivan', 'Ledesma Casado', '123', 'ivan@lifety', '45678923E', 1, '', 0);

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`Nombre`, `Apellidos`, `DNI`, `Correo`, `Password`, `Id_usuario`, `Premium`, `Nivel`, `Dias`, `Eobjetivo`, `Dobjetivo`) VALUES
('Alex', '', '', '', '1', 0, 1, 'P', 3, 1, 2),
('Sandra', 'Ramos', '444444O', '', '2', 1, 0, NULL, NULL, NULL, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
