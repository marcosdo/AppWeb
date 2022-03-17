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

TRUNCATE TABLE `ejercicios`;
INSERT INTO `ejercicios` (`musculo`, `nombre`) VALUES
('Hombro', 'Elevacion lateral'),
('Hombro', 'Press hombro con mancuerna'),
('Hombro', 'Elevaciones laterales'),
('Hombro', 'Remo al menton'),
('Hombro', 'Press militar'),
('Hombro', 'Trasnuca con barra en maquina multipower'),
('Hombro', 'Elevaciones frontales'),
('Hombro', 'Press arnold'),
('Pierna', 'Sentadilla'),
('Pierna', 'Prensa'),
('Pierna', 'Extension de cuadriceps'),
('Pierna', 'Hip thrust'),
('Pierna', 'Peso muerto'),
('Pierna', 'Zacandas'),
('Pierna', 'Curl femoral tumbado'),
('Pierna', 'Gemelos con carga de pie'),
('Pierna', 'Gemelos en prensa'),
('Pierna', 'Peso muerto rumano'),
('Pierna', 'Patadas (polea gluteos)'),


('Pecho', 'Press banca'),
('Pecho', 'Aperturas con mancuernas'),
('Pecho', 'Press banca inclinado'),
('Pecho', 'Maquina de empuje'),
('Pecho', 'Press banca declinado'),
('Pecho', 'Poleas plano'),
('Pecho', 'Poleas pectoral superior'),
('Pecho', 'Poleas pectoral inferior'),

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
