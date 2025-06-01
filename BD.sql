create database modulo;
use modulo;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `eventomodulo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `directo`
--

CREATE TABLE `directo` (
  `id` int NOT NULL,
  `categoria` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `nombre` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `puesto` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `correo` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `extension` varchar(12) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `directo`
--

INSERT INTO `directo` (`id`, `categoria`, `nombre`, `puesto`, `correo`, `extension`) VALUES
(1, 'Gabinete', 'Dr. Dámaso Leonardo Anaya Alvarado', 'Rector', ' ', '1230'),
(2, 'Órgano Interno de Control', 'Encargado de despacho del Órgano Interno de Control', '', 'contraloria@uat.edu.mx', '1170'),
(3, 'Gabinete', 'Mtro.Eduardo García Fuentes', 'Secretario de Finanzas', 'secretariafinanzas@uat.edu.mx\r\n', '1227'),
(4, 'Gabinete', 'Dra. María Concepción Placencia Valadez', 'Secretaria General\r\n', ' ', '1240'),
(5, 'Gabinete', 'Dra. Rosa Issel Acosta González', 'Secretaria Académica\r\n', ' 1280', ''),
(6, 'Gabinete', 'Dr. Fernando Leal Ríos', 'Secretario de Investigación y Posgrado', ' ', '2960'),
(7, 'Gabinete', 'Dra. Alma Amalia Hernández Ilizaliturri', 'Secretaria de Gestión Escolar', ' ', '1910'),
(8, 'Gabinete', 'C.P. Jesús Francisco Castillo Cedillo', 'Secretario de Administración', ' ', '1264'),
(9, 'Gabinete', 'MVZ Rogelio de Jesús Ramírez Flores', 'Secretario de Vinculación', ' ', '1060'),
(10, 'Gabinete', 'C.P. María del Rosario Flores Salomón', 'Titular del Órgano Interno de Control', ' ', '1170'),
(11, 'Gabinete', 'Lic. Mario Martínez Velázquez', 'Abogado General', ' ', '1360'),
(12, 'Rectoria', 'MVZ. MC. Dámaso Leonardo Anaya Alvarado', 'Rector', 'rectoria@uat.edu.mx', '1230'),
(13, 'Rectoria', 'Mtra. Laura García Álvarez', 'Directora General Familia UAT', 'lgalvarez@uat.edu.mx', ''),
(14, 'Secretaria General', 'Dra. María Concepción Placencia Valadez', 'Secretaria General', 'cplacencia@uat.edu.mx', '1240'),
(15, 'Secretaria General', 'Lic. Mónica Lizbeth Ortiz Jiménez', 'Enlace Interdepartamental', 'monica.ortiz@uat.edu.mx', '1242'),
(16, 'Secretaria de Finanzas', 'Mtro. Eduardo García Fuentes', 'Secretario de Finanzas', 'secretariafinanzas@uat.edu.mx', '1227'),
(17, 'Secretaria de Finanzas', 'C.P. María Isabel Lucio Cepeda', 'Dirección de Contabilidad', ' ', '1200'),
(18, 'Secretaria de Administración', 'C.P. Jesús Francisco Castillo Cedillo', 'Secretario de Administración', 'secretariaadmin@uat.edu.mx', '1260'),
(19, 'Secretaria de Administración', 'Mtro. Alberto Trejo Franco', 'Enlace Secretaría de Administración Zona Sur', 'altrejo@docente.uat.edu.mx', '3010'),
(20, 'Secretaria Académica', 'Dra. Rosa Issel Acosta González', 'Secretaria Académica', 'secretariaacademica@uat.edu.mx', '1280'),
(21, 'Secretaria Académica', 'Mtra. Carmen Julia Vallejo Martínez', 'Dirección de Ordenamiento y Gestión Académica', ' ', '1372'),
(22, 'Secretaria de Investigación y Posgrado', 'Dr. Fernando Leal Ríos', 'Secretario de Investigación y Posgrado', 'sip@uat.edu.mx', '2960'),
(23, 'Secretaria de Investigación y Posgrado', 'Mtra. María Isabel Loperena de la Garza', 'Dirección de Estudios de Opinión y Prospectiva\r\n', ' ', ' '),
(24, 'Secretaria de Gestión Escolar', 'Dra. Alma Amalia Hernández Ilizaliturri', 'Secretaria de Gestión Escolar', '', '1910'),
(25, 'Secretaria de Gestión Escolar', 'Dr. Augusto Federico González Graziano', 'Dirección de Servicios Escolares', '', '1680'),
(26, 'Secretaria de Vinculación', 'MVZ. Rogelio de Jesús Ramírez Flores', 'Secretario de Vinculación', 'sec.vinculacion@uat.edu.mx', '1060'),
(27, 'Secretaria de Vinculación', 'MC.José Ramón Roldan Ruíz', 'Dirección de Cultura y Arte', ' ', '2690'),
(28, 'Familia UAT', 'Mtra. Laura García Álvarez', 'Directora General Familia UAT', 'lgalvarez@uat.edu.mx', ' '),
(29, 'Familia UAT', 'Mtra.Juana María Escalante Ruíz', 'Directora del CENDI UAT Victoria', 'jmescalante@uat.edu.mx', ' '),
(30, 'Oficina de la Abogacía General', 'Lic. Mario Martínez Velázquez', 'Abogado General', ' ', '1360'),
(31, 'Planeación y Evaluación Institucional', 'Mtro. Osvaldo García Mata', 'Director de Planeación y Evaluación Institucional', 'dpei@uat.edu.mx', '1129 y 1131'),
(32, 'Organización y Normatividad', 'Dr. José Alberto Cárdenas de la Fuente', 'Organización y Normatividad', '', '1500'),
(33, 'Secretaria de Comunicación y Difusión', 'Dr. Manuel Mario Aguilar González', 'Secretario de Comunicación y Difusión', ' ', '1121'),
(34, 'Secretaria de Comunicación y Difusión', 'Lic.Daniel Alejandro Paz Rodríguez', 'Dirección de Imagen y Comunicación Estratégica', ' ', '1156');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id` INT UNSIGNED NOT NULL,
  `title` VARCHAR(255) COLLATE utf8mb4_general_ci NOT NULL,
  `slug` VARCHAR(255) COLLATE utf8mb4_general_ci NOT NULL,
  `descripcion` TEXT COLLATE utf8mb4_general_ci,
  `start` DATETIME NOT NULL,
  `end` DATETIME NOT NULL,
  `location` VARCHAR(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `modalidad` ENUM('presencial', 'virtual', 'híbrido') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'presencial',
  `tipo` ENUM('conferencia', 'congreso', 'seminario', 'taller') COLLATE utf8mb4_general_ci NOT NULL,
  `estado` ENUM('por_comenzar', 'en_curso', 'culminado') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'por_comenzar',
  `permax` INT UNSIGNED DEFAULT NULL,
  `duration` VARCHAR(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `presName` VARCHAR(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `documento` VARCHAR(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `creado_por` INT UNSIGNED NOT NULL,
  `created_at` DATETIME DEFAULT NULL,
  `updated_at` DATETIME DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (
  `id`, `title`, `slug`, `descripcion`, `start`, `end`, `location`, 
  `modalidad`, `creado_por`, `created_at`, `updated_at`, `tipo`, `estado`,
  `permax`, `duration`, `presName`, `documento`
) VALUES
(3, 'Inteligencia Artificial Aplicada', 'inteligencia-artificial-aplicada', 'Taller práctico sobre el desarrollo de modelos de IA con Python.', '2025-05-05 00:00:00', '2025-05-08 00:00:00', 'Puebla', 'presencial', 2, '2025-05-10 20:10:09', '2025-05-20 17:19:00', 'taller', 'culminado', NULL, NULL, NULL, NULL),
(4, 'Ciberseguridad y Ética Hacker', 'ciberseguridad-y-ética-hacker', 'Introducción a técnicas de protección de sistemas y auditoría ética.', '2025-05-09 00:00:00', '2025-05-14 00:00:00', 'Ciudad de México', 'virtual', 2, '2025-05-10 20:18:14', '2025-05-20 17:22:24', 'taller', 'culminado', NULL, NULL, NULL, NULL),
(5, 'Ciencia de Datos con Python', 'ciencia-de-datos-con-python', 'Taller orientado al análisis de datos y visualización con bibliotecas como Pandas y Matplotlib.', '2025-05-23 00:00:00', '2025-05-30 00:00:00', 'Puebla', 'híbrido', 2, '2025-05-10 20:19:55', '2025-05-20 17:35:34', 'taller', 'por_comenzar', NULL, NULL, NULL, NULL),
(7, 'Automatización con Arduino', 'automatización-con-arduino', 'Diseño y programación de proyectos automatizados usando placas Arduino.', '2025-05-29 00:00:00', '2025-05-29 00:00:00', 'Estado de Puebla', 'virtual', 3, '2025-05-11 22:18:02', '2025-05-20 17:30:41', 'conferencia', 'por_comenzar', NULL, NULL, NULL, NULL),
(8, 'Programación en Java desde cero', 'programación-en-java-desde-cero', 'Taller para desarrollar software', '2025-05-18 00:00:00', '2025-06-05 00:00:00', 'Teziutlán, Puebla', 'híbrido', 1, '2025-05-12 19:55:51', '2025-05-20 17:33:07', 'seminario', 'en_curso', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `user` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('admin','investigador','editor') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'investigador',
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(80) COLLATE utf8mb4_general_ci NOT NULL,
  `active` tinyint NOT NULL DEFAULT '0',
  `activation_token` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `reset_token` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `reset_token_expires_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `user`, `role`, `password`, `name`, `email`, `active`, `activation_token`, `reset_token`, `reset_token_expires_at`, `created_at`, `updated_at`) VALUES
(1, 'YazRojas', 'investigador', '$2y$10$/91w9mBntN.KqVJ39laNyeWIfNNb4KlrGR/WeocVsLd5DhDS4WvQS', 'Yazmin', 'yazrojas779@gmail.com', 1, '', NULL, NULL, '2025-05-05 23:51:48', '2025-05-05 23:52:45'),
(2, 'YazMar', 'investigador', '$2y$10$UJ8V2/wfNs7OxPgCIXsw7u/vL7ybCokh2MifmGzE13FE1d28zaPMa', 'Yaz', 'yazminrojas926@gmail.com', 1, '', NULL, NULL, '2025-05-07 10:11:22', '2025-05-07 10:12:17'),
(3, 'YazAdmin', 'admin', '$2y$10$rwZtw5ex6G1LHa9W4i2X6.qhE8vZc0WuHV136QvJxcSoKN492kILe', 'María Yazmín Rojas Hernández', 'yazminrojas037@gmail.com', 1, '', NULL, NULL, '2025-05-10 22:41:18', '2025-05-10 22:43:44'),
(5, 'Michelle', 'investigador', '$2y$10$0VJKgsVBbD5fHIrxfV3ozeVj.cs0AGBPlqLHmBM8dQwsTQq3uJtDy', 'Michelle Herrera', 'marland4939@gmail.com', 0, 'c3eeefb88f8681ede1a299582c9f96f45323d892', NULL, NULL, '2025-05-19 07:40:43', '2025-05-19 07:40:43'),
(7, 'RojasYaz', 'investigador', '$2y$10$uVp2Iz5Aqd4pV/gzUmWRe.WJ5FbQZC89F6.zWTb3/NxDFO0H29Gv6', 'Yazmín Rojas', 'yazrojar842@gmail.com', 0, '96a1a35ff782725b8e254819674fca40d339830eb01bc1f8419a7dffe0054136', NULL, NULL, '2025-05-19 08:02:28', '2025-05-19 08:02:28'),
(8, 'eduardo','admin','$2y$10$T3rsvnapSwJ1RlEXGBfUBuhspQugY0uFbVQSS/P4OUVPjNKn6Bw5G','Angel Eduardo','eduardoislassalazar@gmail.com',1, '', NULL, NULL, '2025-05-10 22:41:18', '2025-05-10 22:43:44');
--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `directo`
--
ALTER TABLE `directo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `eventos_creado_por_foreign` (`creado_por`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user` (`user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `directo`
--
ALTER TABLE `directo`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `eventos_creado_por_foreign` FOREIGN KEY (`creado_por`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
CREATE TABLE `event_subscriptions` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `event_id` INT UNSIGNED NOT NULL,
  `user_id` INT UNSIGNED NOT NULL,
  `status` ENUM('registrado','confirmado','cancelado') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'registrado',
  `registered_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_event_subscriptions_event` FOREIGN KEY (`event_id`) REFERENCES `eventos`(`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_event_subscriptions_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
