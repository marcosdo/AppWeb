SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

TRUNCATE TABLE `chat`;
INSERT INTO `chat` (`Receptor`, `Origen`, `Contenido`, `Tiempo`, `Tipo`) VALUES
('Entrenador1', 'Usuario1', 'hola', '2022-03-15 16:48:53', 'U-E'),
('Usuario1', 'Entrenador1', 'asda', '2022-03-15 17:12:41', 'E-U');

TRUNCATE TABLE `dietas`;
INSERT INTO `dietas` (`objetivo`, `descripcion`, `tipo`) VALUES
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

TRUNCATE TABLE `ejercicios`;
INSERT INTO `ejercicios` (`musculo`, `nombre`) VALUES
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

TRUNCATE TABLE `planificacion`;
TRUNCATE TABLE `premium`;
INSERT INTO `premium` (`peso`, `altura`, `alergias`, `observaciones_adicionales`, `num_logros`, `logros`, `id_usuario`, `id_profesional`) VALUES
(90, 90, '', '', 0, '', 'Usuario1', 'Entrenador1'),
(90, 90, '', '', 0, '', 'Usuario2', 'Entrenador1');

TRUNCATE TABLE `profesional`;
INSERT INTO `profesional` (`nombre`, `apellidos`, `correo`, `password`, `id_profesional`, `usuarios`, `num_usuarios`) VALUES
('Entrenador1', 'A A', 'a@gmail.com', '1234', 'Entrenador1', 'Usuario1,Usuario2', 2);

TRUNCATE TABLE `usuario`;
INSERT INTO `usuario` (`nombre`, `apellidos`, `correo`, `password`, `id_usuario`, `premium`) VALUES
('Kylian', 'Mbappe', 'rmcf', '$2y$10$zjPioMG1srKQlgRrh4Ixd.EU/.wmMuLbPXl/VZCfrPYAMSO8CcyTG', 'titofloren', 0),
('Usuario1', 'A A', 'a2@gmail.com', '1234', 'Usuario1', 1),
('Usuario2', 'A A', 'a3@gmail.com', '1234', 'Usuario2', 1);
COMMIT;
