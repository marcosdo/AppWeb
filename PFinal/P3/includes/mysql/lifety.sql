-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Servidor: vm16.db.swarm.test
-- Tiempo de generación: 19-04-2022 a las 14:02:08
-- Versión del servidor: 10.8.2-MariaDB-1:10.8.2+maria~focal
-- Versión de PHP: 8.0.15

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

CREATE TABLE `anuncio` (
  `id_anuncio` int(5) UNSIGNED NOT NULL,
  `id_empresa` int(5) UNSIGNED NOT NULL,
  `contenido` mediumtext NOT NULL,
  `imagen` varchar(30) NOT NULL,
  `orden` int(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(5) UNSIGNED NOT NULL,
  `tipo` enum('proteina','creatina','vitaminas','gainer','aminoacidos','pre-entreno','minerales') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat`
--

CREATE TABLE `chat` (
  `Receptor` text NOT NULL,
  `Origen` text NOT NULL,
  `Contenido` mediumtext NOT NULL,
  `Tiempo` datetime NOT NULL,
  `Tipo` enum('U-E','E-U') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `chat`
--

INSERT INTO `chat` (`Receptor`, `Origen`, `Contenido`, `Tiempo`, `Tipo`) VALUES
('pintus', 'perspa', 'hola que tal', '2022-04-10 15:27:50', 'U-E');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comidas`
--

CREATE TABLE `comidas` (
  `id_comida` int(5) UNSIGNED NOT NULL,
  `objetivo` int(1) NOT NULL,
  `tipo` enum('Desayuno','Comida','Cena') NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `link` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contiene`
--

CREATE TABLE `contiene` (
  `id_rutina` int(5) NOT NULL,
  `id_ejercicio` int(5) NOT NULL,
  `dia` int(1) NOT NULL,
  `repeticiones` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `contiene`
--

INSERT INTO `contiene` (`id_rutina`, `id_ejercicio`, `dia`, `repeticiones`) VALUES
(91, 12, 1, 6),
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
(92, 12, 1, 6),
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dieta`
--

CREATE TABLE `dieta` (
  `id_usuario` int(5) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `id_desayuno` int(5) UNSIGNED DEFAULT NULL,
  `id_almuerzo` int(5) UNSIGNED DEFAULT NULL,
  `id_cena` int(5) UNSIGNED DEFAULT NULL,
  `tipo` int(1) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `dieta`
--

INSERT INTO `dieta` (`id_usuario`, `fecha`, `id_desayuno`, `id_almuerzo`, `id_cena`, `tipo`) VALUES
(36, '2022-04-10', 10, 12, 30, 1),
(36, '2022-04-11', 2, 13, 31, 1),
(36, '2022-04-12', 3, 34, 74, 1),
(36, '2022-04-13', 63, 35, 75, 1),
(36, '2022-04-14', 1, 36, 76, 1),
(36, '2022-04-15', 2, 37, 77, 1),
(36, '2022-04-16', 3, 39, 78, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejercicios`
--

CREATE TABLE `ejercicios` (
  `id_ejercicio` int(5) NOT NULL,
  `tipo` int(1) NOT NULL,
  `musculo` varchar(40) DEFAULT NULL,
  `nombre` varchar(40) DEFAULT NULL,
  `descripcion` mediumtext NOT NULL,
  `imagen` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE `empresas` (
  `id_empresa` int(5) UNSIGNED NOT NULL,
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrena`
--

CREATE TABLE `entrena` (
  `nutri` text NOT NULL,
  `usuario` text NOT NULL,
  `editarutina` int(1) NOT NULL,
  `editadieta` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `entrena`
--

INSERT INTO `entrena` (`nutri`, `usuario`, `editarutina`, `editadieta`) VALUES
('pintus', 'perspa', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foro`
--

CREATE TABLE `foro` (
  `id_foro` int(5) UNSIGNED NOT NULL,
  `id_usuario` int(5) UNSIGNED NOT NULL,
  `tema` varchar(50) NOT NULL,
  `nickcreador` varchar(20) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `contenido` varchar(500) NOT NULL,
  `categoria` enum('Nutricion','Dieta') NOT NULL,
  `respuestas` int(5) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `foro`
--

INSERT INTO `foro` (`id_foro`, `id_usuario`, `tema`, `nickcreador`, `fecha`, `contenido`, `categoria`, `respuestas`) VALUES
(27, 31, '&iquest;Creatina-&gt;p&eacute;rdida de pelo?', 'pintus', '2022-04-19 15:27:25', 'La creatina, &aacute;cido &alpha;-metil guanido-ac&eacute;tico, es un &aacute;cido org&aacute;nico nitrogenado que se encuentra en los m&uacute;sculos y c&eacute;lulas nerviosas de algunos organismos vivos. Se puede obtener tanto de manera natural como de manera artificial como suplemento', 'Dieta', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

CREATE TABLE `mensaje` (
  `id_mensaje` int(5) UNSIGNED NOT NULL,
  `id_usuario` int(5) UNSIGNED NOT NULL,
  `id_referencia` int(5) UNSIGNED DEFAULT NULL,
  `id_foro` int(5) UNSIGNED NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `mensaje` mediumtext NOT NULL,
  `fecha` datetime NOT NULL,
  `prioridad` int(5) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `mensaje`
--

INSERT INTO `mensaje` (`id_mensaje`, `id_usuario`, `id_referencia`, `id_foro`, `titulo`, `mensaje`, `fecha`, `prioridad`) VALUES
(12, 31, NULL, 27, 'Contexto', 'La creatina, &aacute;cido &alpha;-metil guanido-ac&eacute;tico, es un &aacute;cido org&aacute;nico nitrogenado que se encuentra en los m&uacute;sculos y c&eacute;lulas nerviosas de algunos organismos vivos. Se puede obtener tanto de manera natural como de manera artificial como suplemento', '2022-04-19 15:27:25', 0),
(16, 31, NULL, 27, 'Creatina buena o no', 'Merece la pena tomar creatina? O se produce mucha perdida de cabello. La perdida es gradual o de golpe?', '2022-04-19 15:35:34', 0),
(17, 32, NULL, 27, 'Mi experiencia con la creatina', 'Yo tomo creatina pre-entreno y no tengo problemas de cabello eso es un mito', '2022-04-19 15:51:20', 0),
(18, 38, 16, 27, 'Experiencia con creatina de conocidos', 'Mi novio ha empezado a tomar creatina y le veo con menor cantidad de pelo, te dir&iacute;a que la p&eacute;rdida es de golpe', '2022-04-19 15:55:42', 1),
(19, 32, 18, 27, 'Mi experiencia con la creatina', 'Yo la tomo y noto mi cabello igual de denso y fuerte, la p&eacute;rdida depende de las hormonas. La creatina no lo induce, ya que la creamos con nuestro propio cuerpo', '2022-04-19 15:56:56', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `id_noticia` int(5) UNSIGNED NOT NULL,
  `id_profesional` int(5) UNSIGNED NOT NULL,
  `titulo` varchar(40) NOT NULL,
  `cuerpo` mediumtext NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id_usuario` int(5) UNSIGNED NOT NULL,
  `nick` varchar(6) NOT NULL,
  `nombre` varchar(25) CHARACTER SET utf32 NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `contraseña` varchar(100) NOT NULL,
  `rol` tinyint(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id_usuario`, `nick`, `nombre`, `apellidos`, `correo`, `contraseña`, `rol`) VALUES
(8, 'admin0', 'Dwayne', 'Johnson', 'dwayne@lifety.com', '$2y$10$uAGG3yMjH7sBX9Qc2QEXZeJoc92buC2qPgxt2x0zdLv3Th3lrp4c.', 0),
(31, 'pintus', 'Antonio', 'Pintus', 'pintus@lifety.es', '$2y$10$4HMCjZeRUdGa.USKL.GCi.1bKkrkWWLpyF0n43517XSOOVmvQwDGG', 2),
(32, 'anakin', 'Anakin', 'Skywalker', 'anakin@ucm.es', '$2y$10$uOz6PMvV6YOUHm3b6Is6juMm1PG5zF1Vyp175pSCVGMpweIj4xzki', 1),
(35, 'admin2', 'Mark', 'Wahlberg', 'markwa@lifety.es', '$2y$10$LqSxgop6C4kalnXJsXYMZe1zVqg0T4.AokRa1cdxkyjHsxnkd6HcG', 0),
(36, 'perspa', 'Persona', 'P&aacute;jaro', 'perspa@ucm.es', '$2y$10$5XbQuYbufL5BkjaB3x.LLOnfZMrOkEBuz7jSZLZQjehc261drjb6S', 1),
(37, 'flavio', 'Flavio', 'Briatore', 'flavio@ucm.es', '$2y$10$Hhaw6oPpK.M2FC62Jx0de.wnnv3WUvXIojKATcMv2doTde6ukpmBy', 1),
(38, 'silvia', 'Silvia', 'Mu&ntilde;oz', 'silvia@ucm.es', '$2y$10$UWc8VQdQjGB80Bo.zybo..LLomjrT9Ig210N0zt.HHZ0BDOVS2Ebe', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pertenece`
--

CREATE TABLE `pertenece` (
  `id_producto` int(5) UNSIGNED NOT NULL,
  `id_categoria` int(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `premium`
--

CREATE TABLE `premium` (
  `id_usuario` int(5) UNSIGNED NOT NULL,
  `id_profesional` int(5) UNSIGNED NOT NULL,
  `peso` float NOT NULL,
  `altura` float NOT NULL,
  `alergias` text NOT NULL,
  `observaciones_adicionales` text NOT NULL,
  `num_logros` int(20) NOT NULL,
  `logros` set('5logros','AccesoTodos','ComenzarChat','Completa1Plan','Completa5Plan','ContrataNutri','Permanencia','Permanencia1m','Foro') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `premium`
--

INSERT INTO `premium` (`id_usuario`, `id_profesional`, `peso`, `altura`, `alergias`, `observaciones_adicionales`, `num_logros`, `logros`) VALUES
(36, 31, 70, 1, 'no', 'no', 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(5) UNSIGNED NOT NULL,
  `imagen` varchar(25) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` mediumtext NOT NULL,
  `precio` decimal(10,0) UNSIGNED NOT NULL,
  `link` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesional`
--

CREATE TABLE `profesional` (
  `id_profesional` int(5) UNSIGNED NOT NULL,
  `nutri` varchar(20) NOT NULL,
  `num_usuarios` int(3) NOT NULL,
  `usuarios` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `profesional`
--

INSERT INTO `profesional` (`id_profesional`, `nutri`, `num_usuarios`, `usuarios`) VALUES
(31, 'pintus', 2, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutina`
--

CREATE TABLE `rutina` (
  `id_rutina` int(5) NOT NULL,
  `id_usuario` int(5) UNSIGNED NOT NULL,
  `activa` tinyint(1) NOT NULL,
  `objetivo` int(1) DEFAULT NULL,
  `nivel` char(1) DEFAULT NULL,
  `dias` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rutina`
--

INSERT INTO `rutina` (`id_rutina`, `id_usuario`, `activa`, `objetivo`, `nivel`, `dias`) VALUES
(91, 36, 1, 1, 'P', 3),
(92, 32, 1, 1, 'P', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(5) UNSIGNED NOT NULL,
  `premium` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `premium`) VALUES
(32, 0),
(35, 0),
(36, 1),
(38, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `anuncio`
--
ALTER TABLE `anuncio`
  ADD PRIMARY KEY (`id_anuncio`),
  ADD KEY `Empresa_FK` (`id_empresa`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `comidas`
--
ALTER TABLE `comidas`
  ADD PRIMARY KEY (`id_comida`);

--
-- Indices de la tabla `contiene`
--
ALTER TABLE `contiene`
  ADD KEY `Ejercicio_FK` (`id_ejercicio`),
  ADD KEY `id_rutina` (`id_rutina`);

--
-- Indices de la tabla `dieta`
--
ALTER TABLE `dieta`
  ADD PRIMARY KEY (`id_usuario`,`fecha`),
  ADD KEY `clave-dieta-desayuno` (`id_desayuno`),
  ADD KEY `clave-dieta-almurezo` (`id_almuerzo`),
  ADD KEY `clave-dieta-cena` (`id_cena`);

--
-- Indices de la tabla `ejercicios`
--
ALTER TABLE `ejercicios`
  ADD PRIMARY KEY (`id_ejercicio`);

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id_empresa`),
  ADD UNIQUE KEY `nombre_empresa` (`nombre`);

--
-- Indices de la tabla `foro`
--
ALTER TABLE `foro`
  ADD PRIMARY KEY (`id_foro`),
  ADD UNIQUE KEY `tema` (`tema`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `nickcreador` (`nickcreador`);

--
-- Indices de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD PRIMARY KEY (`id_mensaje`),
  ADD KEY `Tema_FK` (`id_foro`),
  ADD KEY `Mensaje_FK` (`id_referencia`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id_noticia`),
  ADD KEY `id_profesional` (`id_profesional`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `nick_admin` (`nick`);

--
-- Indices de la tabla `pertenece`
--
ALTER TABLE `pertenece`
  ADD KEY `Producto_FK` (`id_producto`),
  ADD KEY `Categoria_FK` (`id_categoria`);

--
-- Indices de la tabla `premium`
--
ALTER TABLE `premium`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `Pro_FK` (`id_profesional`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `profesional`
--
ALTER TABLE `profesional`
  ADD PRIMARY KEY (`id_profesional`);

--
-- Indices de la tabla `rutina`
--
ALTER TABLE `rutina`
  ADD PRIMARY KEY (`id_rutina`),
  ADD KEY `id_rutina` (`id_rutina`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `anuncio`
--
ALTER TABLE `anuncio`
  MODIFY `id_anuncio` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comidas`
--
ALTER TABLE `comidas`
  MODIFY `id_comida` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id_empresa` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `foro`
--
ALTER TABLE `foro`
  MODIFY `id_foro` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  MODIFY `id_mensaje` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id_noticia` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id_usuario` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rutina`
--
ALTER TABLE `rutina`
  MODIFY `id_rutina` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

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
  ADD CONSTRAINT `dieta_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `foro`
--
ALTER TABLE `foro`
  ADD CONSTRAINT `foro_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `personas` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foro_ibfk_2` FOREIGN KEY (`nickcreador`) REFERENCES `personas` (`nick`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD CONSTRAINT `Mensaje_FK` FOREIGN KEY (`id_referencia`) REFERENCES `mensaje` (`id_mensaje`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Tema_FK` FOREIGN KEY (`id_foro`) REFERENCES `foro` (`id_foro`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mensaje_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `personas` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD CONSTRAINT `noticias_ibfk_1` FOREIGN KEY (`id_profesional`) REFERENCES `profesional` (`id_profesional`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `premium_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `premium_ibfk_2` FOREIGN KEY (`id_profesional`) REFERENCES `profesional` (`id_profesional`);

--
-- Filtros para la tabla `profesional`
--
ALTER TABLE `profesional`
  ADD CONSTRAINT `profesional_ibfk_1` FOREIGN KEY (`id_profesional`) REFERENCES `personas` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `rutina`
--
ALTER TABLE `rutina`
  ADD CONSTRAINT `rutina_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `personas` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
