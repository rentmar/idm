-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 14-08-2021 a las 10:29:25
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ocdmonitor`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actor`
--

CREATE TABLE `actor` (
  `idactor` smallint(4) UNSIGNED NOT NULL,
  `nombre_actor` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `actor`
--

INSERT INTO `actor` (`idactor`, `nombre_actor`) VALUES
(1, 'Pertenece al Organo Legislativo'),
(2, 'Pertenece al Organo Ejecutivo'),
(3, 'Pertenece al Organo Judicial'),
(4, 'Pertenece al Organo Electoral'),
(5, 'Pertenece a un partido politico'),
(6, 'Pertenece a la sociedad civil'),
(7, 'Pertenece al Organo Ejecutivo Departamental'),
(8, 'Pertenece al Organo Legislativo Departamental'),
(9, 'Pertenece al Organo Ejecutivo Municipal'),
(10, 'Pertenece al Organo Legislativo Municipal'),
(12, 'Pertenece a las Fuerzas Armadas'),
(13, 'Pertenece a la Policía Boliviana');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `codigoley`
--

CREATE TABLE `codigoley` (
  `idcodigoley` int(11) UNSIGNED NOT NULL,
  `codigo_ley` varchar(50) NOT NULL,
  `rel_idley` int(11) UNSIGNED NOT NULL,
  `rel_idestadoley` smallint(2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuestionario`
--

CREATE TABLE `cuestionario` (
  `idcuestionario` smallint(2) UNSIGNED NOT NULL,
  `nombre_cuestionario` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cuestionario`
--

INSERT INTO `cuestionario` (`idcuestionario`, `nombre_cuestionario`) VALUES
(1, 'Reforma Electoral'),
(2, 'Institucionalidad Democratica'),
(3, 'Censo'),
(4, 'Leyes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `iddepartamento` smallint(3) UNSIGNED NOT NULL,
  `nombre_departamento` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`iddepartamento`, `nombre_departamento`) VALUES
(1, 'La Paz'),
(2, 'Santa Cruz'),
(3, 'Oruro'),
(4, 'Cochabamba'),
(5, 'Chuquisaca'),
(6, 'Tarija'),
(7, 'Beni'),
(8, 'Pando'),
(9, 'Potosi');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadoley`
--

CREATE TABLE `estadoley` (
  `idestadoley` smallint(2) UNSIGNED NOT NULL,
  `nombre_estadoley` varchar(150) NOT NULL,
  `porcentaje_estadoley` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estadoley`
--

INSERT INTO `estadoley` (`idestadoley`, `nombre_estadoley`, `porcentaje_estadoley`) VALUES
(1, 'Ley en tratamiento', 20),
(2, 'Ley sancionada', 40),
(3, 'Ley aprobada', 60),
(4, 'Ley con modificacion', 80),
(5, 'Ley promulgada', 100);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fuente`
--

CREATE TABLE `fuente` (
  `idfuente` smallint(2) UNSIGNED NOT NULL,
  `nombre_fuente` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `fuente`
--

INSERT INTO `fuente` (`idfuente`, `nombre_fuente`) VALUES
(1, 'Web de la Cámara de Diputados'),
(2, 'Archivo de Leyes (Gaceta Oficial de Bolivia)');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'docentes', 'Usuarios generales, docentes'),
(3, 'monitores', 'Alumnos registrados'),
(4, 'leyes', 'Usuarios autorizados al formulario ley');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `leyes`
--

CREATE TABLE `leyes` (
  `idleyes` int(11) UNSIGNED NOT NULL,
  `fecha_registro` int(11) NOT NULL,
  `resumen` text NOT NULL,
  `rel_idcuestionario` smallint(11) UNSIGNED NOT NULL,
  `rel_idusuario` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `leyes_estadoley`
--

CREATE TABLE `leyes_estadoley` (
  `idleyesestado` int(11) UNSIGNED NOT NULL,
  `rel_idleyes` int(11) UNSIGNED NOT NULL,
  `rel_idestadoley` smallint(2) UNSIGNED NOT NULL,
  `fecha_estadoley` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `leyes_fuente`
--

CREATE TABLE `leyes_fuente` (
  `idleyesfuente` int(11) UNSIGNED NOT NULL,
  `rel_idleyes` int(11) UNSIGNED NOT NULL,
  `rel_idfuente` smallint(2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ley_otrosubtema`
--

CREATE TABLE `ley_otrosubtema` (
  `idleyotrosubtema` int(11) UNSIGNED NOT NULL,
  `rel_idleyes` int(11) UNSIGNED NOT NULL,
  `rel_idotrosubtema` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ley_otrotema`
--

CREATE TABLE `ley_otrotema` (
  `idleyotrotema` int(11) UNSIGNED NOT NULL,
  `rel_idleyes` int(11) UNSIGNED NOT NULL,
  `rel_idotrotema` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ley_subtema`
--

CREATE TABLE `ley_subtema` (
  `idleysubtema` int(10) UNSIGNED NOT NULL,
  `rel_idleyes` int(11) UNSIGNED NOT NULL,
  `rel_idsubtema` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medio_comunicacion`
--

CREATE TABLE `medio_comunicacion` (
  `idmedio` smallint(5) UNSIGNED NOT NULL,
  `nombre_medio` varchar(50) NOT NULL,
  `rel_idtipomedio` smallint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `medio_comunicacion`
--

INSERT INTO `medio_comunicacion` (`idmedio`, `nombre_medio`, `rel_idtipomedio`) VALUES
(10, 'LA PALABRA DEL BENI', 4),
(11, 'CORREO DEL SUR', 4),
(12, 'LOS TIEMPOS', 4),
(13, 'OPINIÓN', 4),
(14, 'PAGINA 7 ', 4),
(15, 'LA PATRIA ', 4),
(16, 'EL POTOSÍ', 4),
(17, 'EL DEBER ', 4),
(18, 'EL PAÍS', 4),
(19, 'BTV', 2),
(20, 'TVU', 2),
(21, 'UNITEL', 2),
(22, 'BOLIVISIÓN', 2),
(23, 'ATB', 2),
(24, 'RED UNO', 2),
(25, 'CEACOM 51', 2),
(26, 'CANAL UNIVERSITARIO', 2),
(27, 'SISTEMA PANDINO DE COMUNICACIÓN', 2),
(28, 'TELEVISIÓN UNVERSITARIA ', 2),
(29, 'UNITEL COBIJA', 2),
(30, 'SITEL', 2),
(31, 'REITEL TV', 5),
(32, 'BTV – RURAL', 5),
(33, 'COTEVI TV', 5),
(34, 'PLUS TLT', 5),
(35, 'FIDES', 3),
(36, 'GLOBAL', 3),
(37, 'KANCHA PARLASPA', 3),
(38, 'PANAMERICANA', 3),
(39, 'UNIVERSITARIA', 3),
(40, 'OASIS', 3),
(41, 'PERLA DEL ACRE', 3),
(42, 'KOLLASUYO', 3),
(43, 'RADIO SC', 3),
(44, 'SAN MIGUEL', 6),
(45, 'ACLO', 6),
(46, 'SOBERANÍA', 6),
(47, 'ILLIMANI', 6),
(48, 'PIO XII', 6),
(49, 'FRONTERA', 6),
(50, 'FIDES – RURAL', 6),
(51, 'TURBO', 6),
(52, 'ACLO TARIJA', 6),
(53, 'La Razón', 4),
(54, 'RADIO UNIVERSITARIA', 3),
(55, 'RADIO CENTRO', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medio_departamento`
--

CREATE TABLE `medio_departamento` (
  `idmediodepartamento` int(11) UNSIGNED NOT NULL,
  `rel_idmedio` smallint(5) UNSIGNED NOT NULL,
  `rel_iddepartamento` smallint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `medio_departamento`
--

INSERT INTO `medio_departamento` (`idmediodepartamento`, `rel_idmedio`, `rel_iddepartamento`) VALUES
(1, 10, 7),
(3, 31, 7),
(5, 44, 7),
(6, 11, 5),
(8, 32, 5),
(9, 36, 5),
(21, 12, 4),
(22, 13, 4),
(23, 21, 4),
(24, 22, 4),
(25, 32, 4),
(26, 37, 4),
(28, 46, 4),
(29, 47, 4),
(30, 14, 1),
(31, 23, 1),
(32, 24, 1),
(33, 32, 1),
(34, 38, 1),
(35, 47, 1),
(36, 15, 3),
(37, 25, 3),
(38, 26, 3),
(39, 32, 3),
(40, 39, 3),
(41, 48, 3),
(45, 32, 8),
(46, 40, 8),
(49, 16, 9),
(50, 30, 9),
(51, 33, 9),
(54, 17, 2),
(55, 21, 2),
(56, 24, 2),
(57, 32, 2),
(58, 43, 2),
(59, 51, 2),
(60, 18, 6),
(61, 21, 6),
(62, 34, 6),
(64, 52, 6),
(69, 42, 5),
(70, 42, 9),
(71, 19, 5),
(72, 19, 7),
(73, 45, 5),
(74, 45, 6),
(75, 45, 9),
(82, 53, 1),
(83, 28, 8),
(84, 20, 5),
(85, 29, 8),
(86, 41, 8),
(87, 35, 1),
(88, 35, 4),
(89, 35, 6),
(90, 35, 7),
(91, 35, 8),
(92, 35, 9),
(93, 27, 8),
(94, 49, 8),
(95, 54, 8),
(97, 55, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nombreley`
--

CREATE TABLE `nombreley` (
  `idnombreley` int(11) UNSIGNED NOT NULL,
  `nombre_ley` text NOT NULL,
  `rel_idestadoley` smallint(2) UNSIGNED NOT NULL,
  `rel_idley` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticia`
--

CREATE TABLE `noticia` (
  `idnoticia` int(11) UNSIGNED NOT NULL,
  `fecha_registro` int(11) NOT NULL,
  `fecha_noticia` int(11) NOT NULL,
  `titular` varchar(200) NOT NULL,
  `resumen` text NOT NULL,
  `url_noticia` varchar(150) DEFAULT NULL,
  `rel_idmedio` smallint(5) UNSIGNED NOT NULL,
  `rel_idcuestionario` smallint(2) UNSIGNED NOT NULL,
  `rel_idusuario` int(11) UNSIGNED NOT NULL,
  `esta_activa` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticia_actor`
--

CREATE TABLE `noticia_actor` (
  `idnotactor` int(11) NOT NULL,
  `rel_idnoticia` int(11) UNSIGNED NOT NULL,
  `rel_idactor` smallint(4) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticia_otrosubtema`
--

CREATE TABLE `noticia_otrosubtema` (
  `idnototrosubtema` int(11) UNSIGNED NOT NULL,
  `rel_idnoticia` int(11) UNSIGNED NOT NULL,
  `rel_idotrosubtema` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticia_otrotema`
--

CREATE TABLE `noticia_otrotema` (
  `idnototrotema` int(11) UNSIGNED NOT NULL,
  `rel_idnoticia` int(11) UNSIGNED NOT NULL,
  `rel_idotrotema` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticia_subtema`
--

CREATE TABLE `noticia_subtema` (
  `idnotsubtema` int(10) UNSIGNED NOT NULL,
  `rel_idnoticia` int(10) UNSIGNED NOT NULL,
  `rel_idsubtema` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `otrosubtema`
--

CREATE TABLE `otrosubtema` (
  `idotrosubtema` int(11) UNSIGNED NOT NULL,
  `nombre_otrosubtema` varchar(150) NOT NULL,
  `rel_idtema` smallint(4) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `otrotema`
--

CREATE TABLE `otrotema` (
  `idotrotema` int(10) UNSIGNED NOT NULL,
  `nombre_otrotema` varchar(150) NOT NULL,
  `rel_idcuestionario` smallint(2) UNSIGNED NOT NULL,
  `rel_idusuario` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subtema`
--

CREATE TABLE `subtema` (
  `idsubtema` smallint(5) UNSIGNED NOT NULL,
  `nombre_subtema` text NOT NULL,
  `rel_idtema` smallint(4) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `subtema`
--

INSERT INTO `subtema` (`idsubtema`, `nombre_subtema`, `rel_idtema`) VALUES
(1, 'Estatutos de organizaciones políticas – Ley 1096', 1),
(2, 'Competencias del TSE', 2),
(3, 'Tutela de derechos políticos', 2),
(4, 'Juzgamiento de faltas y delitos electorales', 2),
(5, 'Redistribución de escaños a nivel nacional', 3),
(6, 'Redistribución de escaños a nivel departamental', 3),
(7, 'Redistribución del número de concejales del municipio', 3),
(8, 'Irregularidades del padrón', 8),
(9, 'Plataforma tecnológica del padrón', 8),
(10, 'Inclusión de poblaciones indígenas', 8),
(11, 'Intercambio de información con el SEGIP', 8),
(12, 'Cartografía electoral', 4),
(13, 'Delimitación de circunscripciones', 4),
(14, 'Selección y capacitación de notarios', 9),
(15, 'Capacitación de jurados electorales', 9),
(16, 'Estrategia de educación cívica y ciudadana', 9),
(17, 'Papel de los medios de comunicación en campaña electoral', 9),
(18, 'Financiamiento en etapas electorales y no electorales', 10),
(19, 'Procedimientos para el traslado de actas', 7),
(20, 'Procedimientos para el juzgamiento de actas', 7),
(21, 'Plazos para entrega de resultados', 7),
(22, 'Fechas de presentación de candidaturas e inhabilitaciones', 6),
(23, 'Sanciones por la difusión de encuestas electorales', 5),
(24, 'Requisitos de habilitación de empresas encuestadoras', 5),
(25, 'Garantías para el ejercicio de los derechos de los individuos frente a la arbitrariedad de los gobernantes', 11),
(26, 'Garantía del ejercicio de derechos políticos y su profundización', 11),
(27, 'Progresiva realización de igualdad política, social y económica', 11),
(28, 'Derecho a elegir, a ser elegido y a ocupar cargos públicos', 11),
(29, 'Libertad de expresión', 11),
(30, 'Acceso a la información', 11),
(31, 'Separación y equilibrio entre los órganos ejecutivo, legislativo y judicial', 14),
(32, 'Parlamento representativo y con pluralismo político', 14),
(33, 'Consolidación del estado de derecho o respeto a la ley', 14),
(34, 'Igualdad de todos los ciudadanos ante la ley', 14),
(35, 'El poder judicial es efectivamente independiente', 14),
(36, 'Participación de los ciudadanos en las decisiones políticas', 14),
(37, 'Participación de los ciudadanos en el diseño de políticas públicas', 14),
(38, 'Delimitación de circunscripciones', 14),
(39, 'Elegir en libertad, sin discriminación ni exclusión', 13),
(40, 'Elecciones libres, regulares y transparentes', 13),
(41, 'Libertad para ser elegido', 13),
(42, 'Libertad de asociación', 13),
(43, 'Competencia igual por cargos públicos', 13),
(44, 'Participación de la mujer', 12),
(45, 'Participación de poblaciones indígenas', 12),
(46, 'La acción de lo representantes está jurídicamente limitada a los deseos de los representados', 15),
(47, 'Los representantes disponen de recursos para exigir que se respeten sus decisiones', 15),
(48, 'Rendición de cuentas del uso de recursos públicos', 15),
(49, 'Qué es el CENSO ', 16),
(50, 'Cómo se hace un CENSO', 16),
(51, 'Cuándo se realiza ', 16),
(52, 'Administración, políticas ', 17),
(53, 'Registros electorales ', 17),
(54, 'Situación económica y social ', 17),
(55, 'Situación temas estratégicos ', 17),
(56, 'Investigación ', 17),
(57, 'Comercio, industrias, planificación ', 17),
(58, 'Distribución de recursos financieros ', 17),
(59, 'Censo de vivienda', 18),
(60, 'Censo agropecuario', 18),
(61, 'Censo de establecimientos económicos', 18),
(62, 'Base legal del censo ', 19),
(63, 'Presupuesto ', 19),
(64, 'Cronograma ', 19),
(65, 'Organización administrativa', 19),
(66, 'Actualización cartográfica', 19),
(67, 'Programa de tabulación', 19),
(68, 'Preparación de la Boleta o cuestionario', 19),
(69, 'Piloto', 19),
(70, 'Selección y formación del personal', 19),
(71, 'Universalizar el acceso a la educación', 20),
(72, 'Instalar laboratorios de ciencia y tecnología con acceso a Internet en todas las Unidades Educativas del país.', 20),
(73, 'Desarrollar programas nacionales que vinculen la educación superior con prácticas profesionales en el sector público y las empresas estatales.', 20),
(74, 'Construcción y equipamiento de los hospitales de segundo y tercer nivel, así como los Institutos de cuarto nivel de atención, Contar con nuevos ítems ', 21),
(75, 'Consolidar y fortalecer los centros de radioterapia', 21),
(76, 'Construcción y equipamiento de Hospitales Materno infantiles,', 21),
(77, 'Crear programas destinados a la educación en salud sexual y reproductiva', 21),
(78, 'Instaurar en el país el chequeo médico obligatorio en el mes del cumpleaños de cada uno de los bolivianos', 21),
(79, 'Reducir el sobrepeso de la población', 21),
(80, 'Modernizar la gestión judicial e introducir tecnologías de la información y comunicación que permitan agilizar los procesos judiciales', 22),
(81, 'Incrementar el número de procesos judiciales en todas las materias: civil-comercial, penal, familiar, niñez y adolescencia, coactivo fiscal, violencia, anticorrupción y laboral, con énfasis  en los casos de feminicidios y violencia hacia las mujeres, niñas y adolescentes', 22),
(82, 'Selección de autoridades judiciales bajo criterios de transparencia y meritocracia,', 22),
(83, 'Ampliar la infraestructura de centros penitenciarios a lo largo del país,', 22),
(84, 'Nueva normativa para viabilizar la sanción penal, mejorar las capacidades de los servidores públicos del Ministerio Público, Policía Boliviana, Defensa Pública y Órgano Judicial.', 22),
(85, 'Mayor inversión en seguridad ciudadana, específicamente para la lucha contra la violencia hacia las mujeres, niñas y adolescentes. ', 23),
(86, 'Más programas y proyectos dirigidos a la prevención y registro de crímenes de violencia contra la mujer', 23),
(87, 'Construcción de centros integrales de atención para víctimas de violencia y programas de sensibilización de trato a víctimas de violencia', 23),
(88, 'Incorporar mecanismos que garanticen la transparencia en las funciones que realiza la Policía, e implementar procedimientos que aseguren la selección de agentes policiales', 23),
(89, 'Mejorar las condiciones del personal en los puestos militares', 23),
(90, 'Crear incentivos para ampliar su incorporación al mundo laboral y entrarán en esquemas de protección social ', 24),
(91, 'Promover la participación de la mujer dentro de la sociedad y la economía,', 24),
(92, 'Promover proyectos de infraestructura y programas específicos para personas con capacidades diferentes o de la tercera edad.', 25),
(93, 'Difundir, sensibilizar y Promocionar la Declaración sobre los Derechos de los Pueblos Indígenas', 25),
(94, 'Apoyar la aplicación mundial de la Declaración sobre los Derechos de los Pueblos Indígenas', 25),
(95, 'Fomentar la participación de los pueblos indígenas en los procesos de las Naciones Unidas', 25),
(96, 'Defensa y promoción de la consulta previa, libre e informada como contribución a la protección y realización los derechos de los pueblos indígenas.', 25),
(97, 'Mantener la política de bonos, aportando a los ingresos de los hogares más vulnerables.', 26),
(98, 'Implementar sistemas de información y comunicación para control y monitoreo de contaminación y daños ambientales ', 27),
(99, 'Para el periodo 2020 - 2025 es necesario implementar un Plan Nacional Para el Bosque Seco Chiquitano denominado “8 Raíces de Vida para Restaurar y Fortalecer nuestros Bosques y la biodiversidad”', 27),
(100, 'Desarrollar la CAMPAÑA NACIONAL BOSQUE VIVO HOGAR DE TODOS en el marco de un Proyecto de Forestación y Reforestación masiva en las áreas afectadas por incendios', 27),
(101, 'Desarrollar un Plan y un marco normativo y de regulación de la conservación y el uso de los componentes de los ecosistemas amazónicos y chiquitanos', 27),
(102, 'Fortalecer las Áreas Protegidas respetando los fines y objetivos de las mismas correspondientes del Sistema Nacional, Departamental, y Municipal de Áreas Protegidas.', 27),
(103, 'Consolidar procesos de gestión integral de residuos sólidos ', 27),
(104, 'Reactivar la economía y el aparato productivo ', 28),
(105, 'Digitalización de comercio, comercio de bienes y servicios tecnológicos.', 28),
(106, 'ii. Dinamizar negocios basados en operaciones confiables y gestionadas con seguridad y soporte financiero regulado y normado.', 28),
(107, 'iii. Proteger los datos e información de nuestros actores comerciales y financieros con un sistema de seguridad cibernética nacional en el marco de la soberanía tecnológica.', 28),
(108, 'iv. Desarrollo de marcos normativos y mecanismos institucionales sobre incorporación de sistemas informáticos y tecnologías de información asociados a las inversiones y el comercio', 28),
(109, 'Fomentar el desarrollo económico y social, preservando la estabilidad macroeconómica,', 28),
(110, 'Fortalecer la industrialización en Bolivia y mantener un crecimiento económico sostenido; la meta en 2025 es un PIB nominal cercano a 60.000 millones de dólares o un PIB per cápita superior a 5.000 de dólares. ', 28),
(111, 'Garantizar la sostenibilidad de la deuda pública', 28),
(112, 'Desarrollar estrategias de articulación e integración económica y sectorial (agropecuaria, agroindustria, industria manufacturera, servicios, turismo, etc.),', 28),
(113, 'Desarrollar mecanismos de integración económica regional,  con una política de incentivos tributarios selectivos para la exportación de productos con valor agregado', 28),
(114, 'Establecer una política arancelaria dinámica, que responda a las necesidades del producción, estableciendo un comité público – privado, encargado de revisar mensualmente los aranceles', 28),
(115, 'Desarrollar incentivos para la inversión privada (nacional o extranjera), entre estos incentivos se pueden mencionar la exención temporal de impuestos,', 28),
(116, 'Lograr la desburocratización y facilitación de trámites en entidades encargadas de fiscalizar la producción', 28),
(117, 'Suscribir acuerdos específicos de protección de inversiones, ya sea con inversionistas o con países, respetando la Constitución Boliviana', 28),
(118, 'Llegar, en 2025, a una pobreza extrema del 5%, es decir, lograr su reducción, en los próximos cinco años, en diez puntos porcentuales', 29),
(119, 'Incrementar la cobertura del servicio de agua potable al 96% y saneamiento básico al 80%, ', 29),
(120, 'Dotar de alcantarillado a las zonas urbanas y de saneamiento mejorado al área rural del país, a través del programa \"Mi Alcantarillado\".', 29),
(121, 'Implementar la Televisión Digital Abierta en ciudades intermedias', 29),
(122, 'Incrementar la cobertura del servicio de telefonía móvil e internet al 100% en todas las regiones y localidades del país, con tarifas reducidas.', 29),
(123, 'Alcanzar una cobertura de gas domiciliario del 90% en las grandes ciudades y ciudades intermedias.', 29),
(124, 'Disminuir a 9% la incidencia de desnutrición crónica en niños y niñas menores de cinco años, disminuir a 30% la prevalencia de anemia en niños y niñas menores de cinco años e incrementar la lactancia materna a 84%.', 29),
(125, 'Apoyar la alimentación complementaria en las escuelas a lo largo de al menos 150 días al año.', 29),
(126, 'normativa para la combinación estudio-trabajo,', 30),
(127, 'implementaremos políticas fiscales, financieras y de incentivo para la creación de fuentes de trabajo', 30),
(128, 'plantear esquemas tributarios adecuados y progresivos para impulsar la generación de empleo de calidad,', 30),
(129, 'incentivos para ampliar su incorporación al mundo laboral y entrarán en esquemas de protección social para la mujer', 30),
(130, 'Aumentar del tamaño de la producción por inversión pública - proyectos de industrialización con altos retornos', 32),
(131, 'Impulsar la variedad de productos y su posicionamiento en el mercado internacional', 32),
(132, 'Producción de bienes y servicios que sustituyan las importaciones y aumenten la oferta exportadora.', 32),
(133, 'Desarrollar la petroquímica, siderurgia, la industria del litio y sus derivados', 32),
(134, 'Producción de hierro de Mutún permitirá a Bolivia ingresar a la era de la siderurgia', 32),
(135, 'Promover los emprendimientos de las industrias digitales será una de nuestras prioridades.', 32),
(136, 'Apoyar a la industria naciente con incentivos (premios a la innovación, celeridad en la apertura y disminución de los trámites burocráticos, así como apoyo a los productores en las áreas de ciencia y tecnología, inocuidad alimentaria, procesos de exportación, importación de insumos, gobierno electrónico para tributación y obligaciones laborales)', 32),
(137, 'Mejores condiciones productivas y tecnológicas para los pequeños y medianos productores del área rural y urbana ', 32),
(138, 'Expandir la frontera agropecuaria para que nuestros productores puedan producir más alimentos.', 32),
(139, 'Transformar las instituciones como SENASAG y SENAVEX ', 32),
(140, 'Crear una oficina de apoyo al exportador', 32),
(141, 'Cambio de la matriz energética (impulsando los proyectos de industrialización de nuestros recursos evaporíticos e hidrocarburíferos, para conformar una industria básica en el país: química, siderúrgica, petroquímica) (logrando un mayor uso de plantas hidroeléctricas y de energías alternativas (solar, eólica y biomasa)', 33),
(142, 'Especializarnos e insertarnos en los primeros eslabones de la industrialización de baterías', 33),
(143, 'Industrialización del litio boliviano', 33),
(144, 'Exportar la energía eléctrica a nuestros vecinos', 33),
(145, 'Producción de etanol y continuar con la producción de biocombustibles (bio-diésel). (Reducir la importación del diésel oíl y cubrir el consumo interno con la puesta en marcha del Proyecto de Biodiesel responsable y equilibrada con el medio ambiente)', 33),
(146, 'Asegurar que todas las bolivianas y los bolivianos cuenten con servicio eléctrico', 33),
(147, 'Incrementar las reservas de gas natural a 20 TCF, (mediante inversiones realizadas en varios proyectos de exploración y perforación de pozos)', 33),
(148, 'Realizar inversiones que permitan incrementar la producción de minerales (yeso, zinc y otros) ', 34),
(149, 'Incrementar las exportaciones de minerales con un proceso de agregación de valor.', 34),
(150, 'Montar plantas de fundición y refinación de minerales, y poner en funcionamiento la Planta Siderúrgica del Mutún.', 34),
(151, 'Consolidar la industrialización del litio boliviano diversificando la matriz productiva del pais.', 34),
(152, 'Consolidar los mercados de exportación para generar nuevas fuentes de ingresos.', 34),
(153, 'Una eficiente Gobernanza de los recursos hídricos que permita la gestión eficiente y sustentable de los mismos y así como la prevención de conflictos y su solución.', 34),
(154, 'Promover el reconocimiento del derecho de los pueblos indígenas de participar activamente en la toma de decisiones.', 34),
(155, 'Promoverá la gestión pública del agua. (Los recursos hídricos constituyen patrimonio común universal de la humanidad y la afectación de éstos constituye un perjuicio para la vida y el planeta por ello no pueden estar en manos privadas)', 34),
(156, 'Promocionar un modelo de combate a las drogas basado en el respeto a los derechos humanos, la concertación social y la corresponsabilidad de los Estados.', 36),
(157, 'Fortalecer decididamente la lucha contra el narcotráfico', 36),
(158, 'Implementar mecanismos que eviten que el narcotráfico penetre en las estructuras de la Policía Boliviana, Fuerzas Armadas ni en ninguna otra institución pública.', 36),
(159, 'Impulsar e incrementar los operativos antidroga', 36),
(160, 'Continuar con la racionalización y erradicación de cultivos excedentarios de coca.', 36),
(161, 'Terminaremos la construcción del Sistema de Contrataciones Electrónico (iniciada por el MEFP en 2018) ', 37),
(162, 'Fortalecer la administración pública del Estado Plurinacional ( basándose en los principios ético-morales del ama suwa (no robar), ama llulla (no mentir) y ama quella (no ser flojo), cumpliendo el mandato de \"Cero Tolerancia a la Corrupción\".)', 37),
(163, 'Fortalecer el modelo de gestión que desconcentra las acciones de transparencia, prevención y lucha contra la corrupción en todos los órganos del Estado, empresas públicas, autárquicas y otras.', 37),
(164, 'Promover la inversión del sector privado en turismo', 38),
(165, 'Promoverlo como un mecanismo de práctica comunitaria', 38),
(166, 'Elaborar y poner en marcha el Plan Integral de Aprovechamiento de la Hidrovía Ichilo-Mamoré-Madera', 38),
(167, 'Construir nueva infraestructura deportiva de iniciación, formación y alto rendimiento,', 40),
(168, 'Implementar las Escuelas Deportivas Plurinacionales en cada municipio', 40),
(169, 'Formar y capacitar a deportistas, técnicos, entrenadores, jueces, médicos y otros actores del deporte a través de la otorgación de becas', 40),
(170, 'Implementar el Programa Plurinacional de Alto Rendimiento Deportivo,', 40),
(171, 'Nuestra visión estratégica también incluye la transformación del país en un centro de transporte de la región', 41),
(172, 'Concluir con las gestiones y el inicio de la construcción del Corredor Ferroviario Bioceánico de Integración,', 41),
(173, 'temas de la política exterior (Diplomacia de los pueblos por la paz y la democracia, reforma de la arquitectura financiera mundial y de las instituciones financieras, derechos de los pueblos indígenas, cambio climático y la Madre Tierra, diplomacia del agua, promoción del comercio y las inversiones, atención de las bolivianas y bolivianos en el exterior y ciudadanía universal, revalorización de la hoja de coca, continuar la labor para la reforma de la Organización de las Naciones Unidas y su Consejo de Seguridad, Promoción Comercial, Negociaciones Comerciales Internacionales, Promoción de las Inversiones, acceso a puertos en condiciones favorables para Bolivia.)', 41),
(174, 'Promover la investigación y difusión de los múltiples beneficios medicinales y nutricionales de la hoja de coca ', 41),
(175, 'Desarrollar una diplomacia comercial que nos permita superar barreras no arancelarias en mercados como los Estados Unidos, la Unión Europea y países asiáticos, ', 41),
(176, 'Construir en lugares a determinar puertos secos, para que la consolidación y desconsolidación de carga se realice en Bolivia', 41),
(177, 'Realizar las inversiones portuarias necesarias para que Ilo sea una verdadera alternativa al comercio exterior boliviano', 41);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tema`
--

CREATE TABLE `tema` (
  `idtema` smallint(4) UNSIGNED NOT NULL,
  `nombre_tema` varchar(150) NOT NULL,
  `rel_idcuestionario` smallint(2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tema`
--

INSERT INTO `tema` (`idtema`, `nombre_tema`, `rel_idcuestionario`) VALUES
(1, 'Presentacion de Estatutos de organizaciones politicas', 1),
(2, 'Competencias Jurisdicionales del TSE', 1),
(3, 'Redistribuicion de Escaños', 1),
(4, 'Circunscripciones uninominales', 1),
(5, 'Difusion de encuestas', 1),
(6, 'Inhabilitacion de candidatos', 1),
(7, 'Computo departamental', 1),
(8, 'Padron Electoral', 1),
(9, 'Procedimientos Tecnico Electorales', 1),
(10, 'Financiamiento politico y partidario', 1),
(11, 'Ejercicio en libertad de derechos políticos', 2),
(12, 'Inclusión política', 2),
(13, 'Participación en el ámbito electoral', 2),
(14, 'Integración de los ciudadanos en la definición y gestión del Estado', 2),
(15, 'Instituciones', 2),
(16, 'Información a la población ', 3),
(17, 'Uso de los datos censales', 3),
(18, 'Otros Censos', 3),
(19, 'Etapa Pre Censal ', 3),
(20, 'Educación', 4),
(21, 'Salud', 4),
(22, 'Administración De Justicia', 4),
(23, 'Seguridad Ciudadana', 4),
(24, 'Género', 4),
(25, 'Igualdad (Inclusión)', 4),
(26, 'Bonos', 4),
(27, 'Medio Ambiente', 4),
(28, 'Economía', 4),
(29, 'Pobreza Y Desarrollo', 4),
(30, 'Empleo', 4),
(31, 'Impuestos', 4),
(32, 'Industria', 4),
(33, 'Energía', 4),
(34, 'Recursos Naturales', 4),
(35, 'Descentralización Y Autonomía', 4),
(36, 'Narcotráfico', 4),
(37, 'Corrupción', 4),
(38, 'Turismo', 4),
(39, 'Arte Y Cultura', 4),
(40, 'Deportes', 4),
(41, 'Política Exterior', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_medio`
--

CREATE TABLE `tipo_medio` (
  `idtipomedio` smallint(3) UNSIGNED NOT NULL,
  `nombre_tipo` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_medio`
--

INSERT INTO `tipo_medio` (`idtipomedio`, `nombre_tipo`) VALUES
(1, 'Pagina de Red Social'),
(2, 'Canal de Televisión'),
(3, 'Emisora radial'),
(4, 'Prensa Escrita'),
(5, 'TV Rural'),
(6, 'Radio Rural');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `universidad`
--

CREATE TABLE `universidad` (
  `iduniversidad` smallint(3) UNSIGNED NOT NULL,
  `nombre_universidad` varchar(150) NOT NULL,
  `sigla_universidad` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `universidad`
--

INSERT INTO `universidad` (`iduniversidad`, `nombre_universidad`, `sigla_universidad`) VALUES
(1, 'No definido', 'ND'),
(2, 'Universidad Tecnica de Oruro', 'UTO'),
(3, 'Universidad Mayor de San Simon', 'UMSS'),
(4, 'Universidad Catolica Boliviana', 'UCB'),
(5, 'Universidad Mayor Real y Pontificia de San Francisco Xavier', 'USFX'),
(6, 'Universidad Amazonica de Pando', 'UAP'),
(7, 'Universidad Autonoma Gabriel Rene Moreno', 'UAGRM'),
(8, 'Universidad Mayor de San Andres', 'UMSA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `universidad_departamento`
--

CREATE TABLE `universidad_departamento` (
  `idudepa` int(11) NOT NULL,
  `rel_iduniversidad` smallint(3) UNSIGNED NOT NULL,
  `rel_iddepartamento` smallint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `universidad_departamento`
--

INSERT INTO `universidad_departamento` (`idudepa`, `rel_iduniversidad`, `rel_iddepartamento`) VALUES
(0, 1, 3),
(0, 2, 4),
(0, 3, 1),
(0, 4, 5),
(0, 5, 8),
(0, 6, 2),
(0, 7, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `urlley`
--

CREATE TABLE `urlley` (
  `idurlley` int(11) UNSIGNED NOT NULL,
  `url_ley` varchar(255) NOT NULL,
  `rel_idley` int(11) UNSIGNED NOT NULL,
  `rel_idestadoley` smallint(2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `carnet_identidad` varchar(20) DEFAULT NULL,
  `geolocalizacion` varchar(250) DEFAULT NULL,
  `rel_iddepartamento` smallint(3) UNSIGNED NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `rel_iduniversidad` smallint(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `carnet_identidad`, `geolocalizacion`, `rel_iddepartamento`, `direccion`, `rel_iduniversidad`) VALUES
(1, '127.0.0.1', 'admin', '$2y$12$bGXrgAr0ErDJt2ICW/f2v.6M1LOI2l6KqFvj9Ot0rLPGdYy8h2sle', 'admin@admin.com', NULL, '', NULL, NULL, NULL, NULL, NULL, 1268889823, 1628906032, 1, 'Admin', 'istrator', 'ADMIN', '0', '0', 'geolocalizacion', 1, NULL, 1),
(2, '127.0.0.1', 'marcelo', '$2y$10$cvMbrdm9qpYyudrwhq3mu.yimTBsIywbbXoNEu4bRo4oRm82RGtye', 'MRolqueza@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1625062770, 1625414827, 1, 'Marcelo', 'Rolqueza', NULL, NULL, '4834568', 'GEOLOCALIZACION', 1, 'Mariano Colodro #1447', 1),
(3, '127.0.0.1', 'albert', '$2y$10$viKV5QXqqrNbc5MMPx8kyuXLOWDMjYU5uLBlgGhjwqM3C0H9vFtT6', 'albert@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1625062902, 1625414291, 1, 'Julia Carmen', 'Misericordia Morales', NULL, NULL, '7298782', '', 3, '', 0),
(4, '127.0.0.1', 'jcarlos', '$2y$10$xj7vhmTVFZOMLHbKfrhz.O2l37pN7cssOOBM0mGsXZ1A9B4S3se.W', 'almeyda@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1625358200, NULL, 1, 'Juan Carlos', 'Almeyda', NULL, NULL, '48693587', '45465456456456454', 4, 'Calle Alberto #4323', 0),
(5, '127.0.0.1', 'mon-alfredo', '$2y$10$qzrbE.2JZUSt/AAi7.ObZuBYsK3/R6YJANzOSJvxp7aHSPXIuhTWi', 'alfredo@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1625415047, 1628809866, 1, 'Alfredo R.', 'Torrico L.', NULL, NULL, NULL, NULL, 1, NULL, 0),
(6, '127.0.0.1', 'mon-claudia', '$2y$10$oq9duUb2wp.cOrNj0h.oouNPk7redo3vaUlwpKEsrfT.Q4nN7.A9C', 'claudia@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1625415426, 1625420030, 1, 'Claudia', 'Arteaga', NULL, NULL, '49512234654', '546545456456454654', 4, 'Av. Sucre #4452', 0),
(7, '127.0.0.1', 'mon-carlos', '$2y$10$qzJf1mPzU1NH0EJ6YIwZ.uL2P18cx3OaAkYjIy.F5En57hbNrWJBe', 'carlos@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1625415550, 1625419998, 1, 'Carlos', 'Olivera', NULL, NULL, '495452121', '94945454654654', 2, 'Av. Circunvalacion #476', 0),
(8, '127.0.0.1', 'mon-adriana', '$2y$10$kVDfs/u3izDKtmAJCieTb.PJNrV6SYQv3vazv3fV4kXw1.aJ3ZCHG', 'adrianitajus98@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1625674404, NULL, 1, 'Adriana', 'Mier Justiniano', NULL, NULL, '6787516', '', 1, '', 4),
(9, '127.0.0.1', 'mon-alejandro', '$2y$10$u.4.qtFJYfAEoPnNXaYOZeeA6Foyfw5QCDjLcSpA26NPinNaclhMO', '201907084@ est.edu.bo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1625674506, 1628124055, 1, 'Alejandro', 'Galindo Wieler', NULL, NULL, '00', '', 4, '', 1),
(10, '127.0.0.1', 'mon-alison', '$2y$10$u/6WP7Hnfa1BQQ7M0RtJVOfHunpiTN3wJjn5vzrVx7Q5Q8BxMoPD2', 'alison.sthephanie30@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1625674629, 1628038585, 1, 'Alison', 'Romero', NULL, NULL, '8537724', '', 1, '', 4),
(11, '127.0.0.1', 'mon-ami', '$2y$10$Q3Y8QpHoHPVEb2u5pmJtAebSM7IcIetvLCnQUXGs/2urqDlGnrAqC', 'amisita_la_seri@hotmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1625675771, NULL, 1, 'Ami', 'Cruz Amacifen', NULL, NULL, '4217053', '', 8, '', 1),
(12, '127.0.0.1', 'mon-andres', '$2y$10$K925qdJA4PPWbjmdB/mVQuZZdXAXOfOGtIFFoD6JglaARZiuJowQ6', 'andresventiadesb@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1625675847, 1627747386, 1, 'Andrés', 'Ventiades Velásquez ', NULL, NULL, '13905327', '', 5, '', 5),
(13, '127.0.0.1', 'mon-angelo', '$2y$10$frwfgKIzEEtuXd1pnYAX2Oj62X9CaA9t7mcLCIgBRkEn5OwmjPPAq', 'ap819994@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1625676142, 1628134476, 1, 'Angelo Michael', 'Perez Pool ', NULL, NULL, '7351503', '', 3, '', 2),
(14, '127.0.0.1', 'mon-belen', '$2y$10$80ltEsx4ns0nfK8/iBdfXO4CAcUoxxsIFqF0OhNIW/BMobpcQWypm', 'anabelengl24@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1625676205, NULL, 1, 'Ana Belen', 'Gutierrez Lopez', NULL, NULL, '9779920', '', 2, '', 7),
(15, '127.0.0.1', 'mon-bernardo', '$2y$10$qe8865xObWmbnq1q8EB0O.uQGSEUXZyljFd0EVhKIyCWGmfHO/zJ6', 'enzobernardogallo@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1625676259, NULL, 1, 'Bernardo', 'Gallo', NULL, NULL, '12578751', '', 1, '', 4),
(16, '127.0.0.1', 'mon-cecilia', '$2y$10$x8xji0mC62TwN5AZJ6tcg.BCWWtD480jC09r72tTX1IVy8gf28M/2', 'ceciliajustiniano306@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1625676367, 1628135027, 1, 'Cecilia', 'Justiniano Escalante', NULL, NULL, '12475248', '', 2, '', 7),
(17, '127.0.0.1', 'mon-cristian', '$2y$10$ZkPhZsLt7V2NjJFZTD7mqelkwVk0b1Xpcgcj.vv9NHeOBkIez.qNO', 'cmisericordia123@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1625676428, 1627922111, 1, 'Cristian Alberto', 'Misericordia Morales', NULL, NULL, '7390130', '', 3, '', 2),
(18, '127.0.0.1', 'mon-daniela', '$2y$10$55nP4beMdkX4xAfTC0vfnulkG6R9HDikFAaK7rnO6aPqdKGE8012y', '202004866@ est.edu.bo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1625676684, 1628043141, 1, 'Daniela Rosario', 'Hualuque Rodríguez', NULL, NULL, '0', '', 4, '', 1),
(19, '127.0.0.1', 'mon-diego', '$2y$10$1JlsIQbtpDEEwDANz5nTouWlDO/k8sxq9/CV2MTHCsSr8PiL7NHqe', 'ayo2019@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1625676805, 1628178406, 1, 'Diego', 'Ayoroa', NULL, NULL, '6964639', '', 1, '', 4),
(20, '127.0.0.1', 'mon-elsifania', '$2y$10$d.GWZs3Yw/SXQLyP7AJavOMSnS.XdVUzhyKvtVvbp/CQZgY6.TSgi', 'fannyolarterojas@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1625676855, 1627959495, 1, 'Elsifania', 'Olarte Rojas', NULL, NULL, '1766568', '', 8, '', 6),
(21, '127.0.0.1', 'mon-erick', '$2y$10$LfEdf4MpfrTxm9tByOqW/uQyJ1mb01DlEETHy1uqAYQxon6VQeASO', 'tapiaerik1500@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1625676925, 1628170370, 1, 'Erik Roger ', 'Calizaya Tapia ', NULL, NULL, '10393487', '', 5, 'Ostria Reyes #236', 5),
(22, '127.0.0.1', 'mon-ericka', '$2y$10$6xava60aeGfmf0s29weyseDY4nkQmZByMN5R0TILcKIXhe.3M6J0i', 'mniko4218@ gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1625676994, 1627742622, 1, 'Erick', 'Alvarado Beltrán ', NULL, NULL, '12681679', '', 4, '', 1),
(23, '127.0.0.1', 'mon-evelin', '$2y$10$SE7MMZ7n3md5e6tHdLl5Vu7BEX4XEi/iohn68.u331sFUuwKOmzCe', 'evelinmachaca123@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1625677141, 1628033920, 1, 'Evelin E.', 'Machaca Flores ', NULL, NULL, '7353738', '', 3, '', 2),
(24, '127.0.0.1', 'mon-fabiola', '$2y$10$QSCc3/taQIYIYOqUeB2VNuPtP.wxgHRE6NjwW4IFW49gVkVHrRpBi', 'fabi-justiniano-@hotmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1625677382, 1627598579, 1, 'Fabiola', 'Justiniano', NULL, NULL, '570431', '', 8, '', 6),
(25, '127.0.0.1', 'mon-gabriel', '$2y$10$U6SqPiI2dfSohR/iAUKWW.czeDRJZ/HyRECsHAL6SSl5nJSAl0JFK', 'garandiabarrios@gmail.com ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1625677434, NULL, 1, 'Gabriel ', 'Arandia ', NULL, NULL, '7519015', '', 1, '', 4),
(26, '127.0.0.1', 'mon-genesis', '$2y$10$jWe6K9Qq155/xDpnPEqVrO0ei0l.Q5JpiZx/pbGO9mYP9r3l.5tL2', 'mier.genesis@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1625677623, 1625680035, 1, 'Génesis ', 'S/A', NULL, NULL, '5645025', '', 1, '', 4),
(27, '127.0.0.1', 'mon-gustavo', '$2y$10$tpe.nGYN5IuvCygYIUtFtucPBcIJdV5QY9mCmOqptvO0U8GFfC9Rq', 'mamaniquispegustavo2006@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1625677685, 1627864433, 1, 'Gustavo', 'Mamani Quispe ', NULL, NULL, '7288481', '', 3, '', 2),
(28, '127.0.0.1', 'mon-idar', '$2y$10$XnaHNH4n7jw3ygaRi3ebg.2Tg5X2O9R7zVSpukLdRmM2lcPNl7rD.', 'chubyjuu18hotmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1625677745, 1628202553, 1, 'Idar Josue ', 'Villca Villanueva', NULL, NULL, '7889449', '', 8, '', 6),
(29, '127.0.0.1', 'mon-jodie', '$2y$10$gYUBwSF7tm6hHRshPTVTMOCN6NXUWbo7bBzgo8JSHvrfTp7V3DKvS', 'michellevillarroeljb@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1625677848, 1628176030, 1, 'Jodie Michelle ', 'Bautista Villarroel', NULL, NULL, '8302800', '', 1, '', 8),
(30, '127.0.0.1', 'mon-julia', '$2y$10$GD0VAoOh082/6rQ3OVv8ze2qmpYl2bTrxDxqytlDUuvppTIljjkX2', 'mise.juli.1991@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1625677922, 1627830457, 1, 'Julia Carmen', 'Julia Carmen', NULL, NULL, '7298782', '', 3, '', 2),
(31, '127.0.0.1', 'mon-keylin', '$2y$10$kX1JLROYSjg3/1Y459BogegWEUGKwBFmsnTHZz/5MaG7U2mQUR3MG', 'kelynsuarez@ gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1625677986, 1628132172, 1, 'Keylin', 'Suárez Rojas', NULL, NULL, '9433132', '', 4, '', 1),
(32, '127.0.0.1', 'mon-kiebel', '$2y$10$i23IBg8Ca8aBjI0iQScuMO1zfL6NK0.OLAbZ55YEyqtd4NiSz7zLa', 'kiebel6garcia6rocabado6@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1625678075, 1627967526, 1, 'Kiebel', 'Garcia Rocabado', NULL, NULL, '8043490', '', 4, '', 3),
(33, '127.0.0.1', 'mon-leidy', '$2y$10$YP94xAOZw.3oyHdCXMgwcej04ZbdByCbsQL9KBwzcfX2kLlQ24KM6', 'sincorreo@correo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1625678176, NULL, 1, 'Leidy Estefania ', 'Cordero Mamani', NULL, NULL, '5701704', '', 8, '', 1),
(34, '127.0.0.1', 'mon-leonela', '$2y$10$AHRxM3lTzX6vCviO4JmVaOZZ6kiIjgS0jjMhLHT6m4tC8tVvUTwwO', 'ullcafernandezleonela@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1625678254, 1628127571, 1, 'Leonela', 'Sullca Fernandez ', NULL, NULL, '9122028', '', 1, '', 8),
(35, '127.0.0.1', 'mon-luis', '$2y$10$bGIsAr6x6Vc6gk7kWPKdOeuhWuOi0/YpHnRrzAL9EPLSVoSXnE4OS', 'luis@dominio.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1625678599, 1628028708, 1, 'Luis David ', 'Santos Suárez', NULL, NULL, '4209452', '', 8, '', 6),
(36, '127.0.0.1', 'mon-luisb', '$2y$10$4w9gVeRYO2P82rKW6.G8E.WpFfJGBTURgHjDGp2Qd.qoRHQTSb9jO', 'luissdanielabc@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1625678683, 1627963373, 1, 'Luis Daniel', 'Salamanca Barral ', NULL, NULL, '8621075', '', 5, '', 5),
(37, '127.0.0.1', 'mon-luz', '$2y$10$ET3v1Y3jEmRq8lZ2HxFPFOhqbIQam/FHJvinjrAr4tXrjMet9rjKG', 'bordaortusteluzmilena@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1625678837, NULL, 1, 'Luz Milena', 'Borda Ortuste ', NULL, NULL, '10384512', '', 5, '', 1),
(38, '127.0.0.1', 'mon-maria', '$2y$10$9fbJUMRXHmfkr8JzuU.wqe.7a9F7mPtMlEvA85tRvXu1tzwK9245W', 'delcielogalindo@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1625678903, NULL, 1, 'María del Cielo ', 'Galindo', NULL, NULL, '8808885', '', 1, '', 4),
(39, '127.0.0.1', 'mon-mariac', '$2y$10$TvTELC9mcL5NRlG3Dp1uR.m.xwcXFaYS4dALCz5D12mw4QO19P39e', '202001453@ est.umss.edu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1625678999, 1628051231, 1, 'Ma. Celeste', 'Condorhuayra Araoz', NULL, NULL, '14071014', '', 4, '', 1),
(40, '127.0.0.1', 'mon-mariao', '$2y$10$TgVZu4Af9tJstRWrowoIK.0Ek.2/KDBnkkT/Kh/qRYQXanCsBW7Em', 'vikyosorio123@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1625679075, 1628043429, 1, 'María Victoria ', 'Osorio', NULL, NULL, '7208546', '', 1, '', 4),
(41, '127.0.0.1', 'mon-marioly', '$2y$10$S9EgXybZP/7JepUxA9cqaOAThrpPfZj1RXRdlcJhw05ngIFt9FzXG', 'mariolicruz98@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1625679162, 1626991330, 1, 'Marioly', 'Cruz Heredia', NULL, NULL, '9619837', '', 2, '', 7),
(42, '127.0.0.1', 'mon-mayel', '$2y$10$gjaF9xP2bPEkr.21WXqnWuqCray604Gt/n6Bm5kQePS8Y6.wv0JpG', 'ligiaherbascabrera@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1625679244, 1628142218, 1, 'Mavel Ligia ', 'Herbas Cabrera ', NULL, NULL, '975576', '', 4, '', 3),
(43, '127.0.0.1', 'mon-mihaela', '$2y$10$QK72MT1oZ86xuRSPYxDi2.nc4lafQWkkgzIEfX.MA2KZth1gq4cbK', 'mivigafeQQ@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1625679307, 1628133168, 1, 'Mihaela Victoria ', 'Gareca Fernandez', NULL, NULL, '4074239', '', 4, '', 3),
(44, '127.0.0.1', 'mon-paula', '$2y$10$3sd0GsvARcjpor1bevHaXuAcXGP3gYbSmLwLiXjjs5LWZ1SiM4d5O', 'paulafariast28@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1625679373, 1628121137, 1, 'Paula Thais ', 'Farías Teran', NULL, NULL, '5597049', '', 4, '', 3),
(45, '127.0.0.1', 'mon-ralhs', '$2y$10$YIrMU3oHyw/1/ViYavsYReRoOgHfoPjOVdZC/ssds7fnNO0h/YzQO', 'gonsalesporumaemer@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1625679440, 1628131516, 1, 'Ralhs W', 'Gonzáles Parumo', NULL, NULL, '4211751', '', 8, '', 6),
(46, '127.0.0.1', 'mon-ronald', '$2y$10$fBjuFnHXpcT3glOCyF/Fge4zyz8OtRA/wlQuFvkWEaK.GCeHA1HY.', 'ronaldalexiscondori@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1625679510, 1628140421, 1, 'Ronald Alexis', 'Condori Fernandez', NULL, NULL, '10653943', '', 2, '', 7),
(47, '127.0.0.1', 'mon-rosana', '$2y$10$GSJs5F7pt7D7ohryQvnhpem8a63RKrYBd.IcX5bLxvmQsYQ/NDA9a', 'rosivas17@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1625679577, 1628136176, 1, 'Rosana Agar', 'Vásquez Pimentel ', NULL, NULL, '6591343', '', 5, '', 5),
(48, '127.0.0.1', 'mon-sholay', '$2y$10$WXJ8amnAWLdp1sScT69T8uQDL/tYDO0rO6mnlI0mGcHll6EBh7tmG', 'sholaymisericordiamolina@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1625679666, 1628140226, 1, 'Sholay Gabriela', 'Misericordia Molina ', NULL, NULL, '7359512', '', 3, '', 2),
(49, '127.0.0.1', 'mon-taliana', '$2y$10$.pkDJOCdsIZWVRTCc3VWPekFvK85EtGlJp5Lf8Sfjrq9dfHW.1wMO', 'talianamedina1999@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1625679726, 1627793361, 1, 'Taliana', 'Quiroga Medina', NULL, NULL, '14656162', '', 2, '', 7),
(50, '127.0.0.1', 'mon-tania', '$2y$10$Ci5Nqgut1Iv7Lh0CKGsZ2ev/fwU00g4lPIJtIkjJdAUrrFLHiEe.G', 'thewantedtanita@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1625679786, NULL, 1, 'Tania Adriana ', 'Oros Ortiz', NULL, NULL, '7879403', '', 4, '', 3),
(51, '127.0.0.1', 'mon-alejandroc', '$2y$10$lubj9zh1AGUxdmXkV40W1.sZBHox5qoLE5NvE.KY2c8hrP4U9NprS', 'alecar@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1625688141, 1628036502, 1, 'Alejandro', 'Carvajal', NULL, NULL, '0000', '', 1, '', 4),
(52, '200.105.212.232', 'adm-alejandro', '$2y$12$OPArNBZJXAo.9dAfKgONIu5fUZ9KoS92JZ1sdP1rrV7WmlVbCPyHe', 'alecar1@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1626813394, 1628089211, 1, 'Alejandro', 'Carvajal', NULL, NULL, '4845151', 'ssaas', 1, 'ss', 1),
(53, '177.222.113.11', 'mon-paohu', '$2y$10$qGt25cGC4iGNq190f60q7.EzQWOeQcNPwSxJYmi9mJ4gOmOwbHAHW', 'paola.hb.1997.17@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1626823428, 1627701176, 1, 'Paola ', 'Hurtado Borobobo', NULL, NULL, '4212295', '', 8, '', 1),
(54, '181.115.160.189', 'mon-marisol', '$2y$10$Vhud6bHQekvouLk6Du05CORUC8nQ6jwah5VpY9r.C1nbUNac.mMsO', 'marisol.mzfl@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1626913208, 1628126757, 1, 'Marisol', 'Muñoz', NULL, NULL, '7567747', '', 5, '', 1),
(55, '177.222.113.11', 'mon-selky', '$2y$10$mNazTtweCTd622XwqV1Zt.XI44u2GlFkc2uTs4EGlWX90Wmn.jZsW', 'SelkymolinaVaca@hotmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1627049788, 1628087769, 1, 'Selky ', 'Molina Vaca', NULL, NULL, '5600866', '', 8, '', 1),
(56, '177.222.113.11', 'adm-sverd', '$2y$10$D9SJ4Oz57MpGdbqzIqMgYeo9jM.SCS8S/nGUMjgMwXRzrEOCPkt3u', 'observacionciudadana0@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1627077743, NULL, 1, 'Sandra', 'Verduguez', NULL, NULL, '3124967', '', 1, '', 1),
(57, '177.222.113.11', 'mon-jennifer', '$2y$10$RUhcPXZ56B0JejI.JmT/euDWq4dKZ7Gl7D0Q2evL.c1UeP3Z5yn7O', 'arredondovillagomez10@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1627566874, 1628132224, 1, 'Jennifer ', 'Arreondo Villagomez', NULL, NULL, '11304518', '', 2, '', 1),
(58, '200.105.212.122', 'mon-pando', '$2y$10$V9cQD75V8lHnnBSuedUw9eN67IGi0nP5ArpRNleXkpzYuC95clAWq', 'pando@pando.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1627593507, 1627602566, 1, 'Monitor', 'Pando', NULL, NULL, '486512152', '', 8, '', 1),
(59, '200.105.212.122', 'mon-sucre', '$2y$10$VmPKi4IxtzjVKNLGpu/CG.A29X0wFGWFFqYLy41USMmCpGpVxROJS', 'monsucre@sucre', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1627593926, 1627593943, 1, 'Monitor', 'Sucre', NULL, NULL, '48542122', '', 5, '', 1),
(60, '127.0.0.1', 'mon-monitor', '$2y$10$ggRupywlI.A9EHdmVKAyTeYYJ//dyybRuvAcKeqCmqOdrcCNDCjhW', 'monitor@prueba.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1628614200, NULL, 1, 'Monitor', 'Prueba', NULL, NULL, '4865464', '1564654165,165465456', 1, 'Calle Pando #432', 4),
(61, '127.0.0.1', 'mon-monitor1', '$2y$10$CX93Q2RCaQ.x7IvblHG3z.0pUlZ8JAjZNq.wuxUlJ/K7/iwt0.TO.', 'monitor@prueba2.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1628614624, 1628614641, 1, 'Monitor', 'Prueba2', NULL, NULL, '57896541', '1564654165,165465456', 6, 'Calle Pando #432', 4),
(62, '127.0.0.1', 'mon-monitor2', '$2y$10$2lShzTL/.6voqgyVOupmTeMWp7fF.RuLrEGcJt/a0xDcg21xMwCzC', 'monitor@prueba3.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1628614878, NULL, 1, 'Monitor', 'Prueba3', NULL, NULL, '85465421', '4542123, 4564654', 9, 'Av. circunvalacion', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 2, 2),
(5, 3, 3),
(6, 4, 3),
(7, 5, 3),
(71, 5, 4),
(8, 6, 3),
(9, 7, 3),
(10, 8, 3),
(62, 8, 4),
(11, 9, 3),
(12, 10, 3),
(63, 10, 4),
(13, 11, 3),
(14, 12, 3),
(15, 13, 3),
(16, 14, 3),
(17, 15, 3),
(64, 15, 4),
(18, 16, 3),
(19, 17, 3),
(20, 18, 3),
(21, 19, 3),
(65, 19, 4),
(22, 20, 3),
(23, 21, 3),
(24, 22, 3),
(25, 23, 3),
(26, 24, 3),
(27, 25, 3),
(66, 25, 4),
(28, 26, 3),
(67, 26, 4),
(29, 27, 3),
(30, 28, 3),
(31, 29, 3),
(32, 30, 3),
(33, 31, 3),
(34, 32, 3),
(35, 33, 3),
(36, 34, 3),
(37, 35, 3),
(38, 36, 3),
(39, 37, 3),
(40, 38, 3),
(68, 38, 4),
(41, 39, 3),
(42, 40, 3),
(69, 40, 4),
(43, 41, 3),
(44, 42, 3),
(45, 43, 3),
(46, 44, 3),
(47, 45, 3),
(48, 46, 3),
(49, 47, 3),
(50, 48, 3),
(51, 49, 3),
(52, 50, 3),
(53, 51, 3),
(70, 51, 4),
(54, 52, 1),
(55, 53, 3),
(56, 54, 3),
(57, 55, 3),
(58, 56, 1),
(59, 57, 3),
(60, 58, 3),
(61, 59, 3),
(72, 60, 3),
(74, 61, 3),
(75, 61, 4),
(76, 62, 3),
(77, 62, 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actor`
--
ALTER TABLE `actor`
  ADD PRIMARY KEY (`idactor`);

--
-- Indices de la tabla `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indices de la tabla `codigoley`
--
ALTER TABLE `codigoley`
  ADD PRIMARY KEY (`idcodigoley`),
  ADD KEY `fk_codigo_a_estadoley` (`rel_idestadoley`),
  ADD KEY `fk_codigo_a_ley` (`rel_idley`);

--
-- Indices de la tabla `cuestionario`
--
ALTER TABLE `cuestionario`
  ADD PRIMARY KEY (`idcuestionario`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`iddepartamento`);

--
-- Indices de la tabla `estadoley`
--
ALTER TABLE `estadoley`
  ADD PRIMARY KEY (`idestadoley`);

--
-- Indices de la tabla `fuente`
--
ALTER TABLE `fuente`
  ADD PRIMARY KEY (`idfuente`);

--
-- Indices de la tabla `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `leyes`
--
ALTER TABLE `leyes`
  ADD PRIMARY KEY (`idleyes`);

--
-- Indices de la tabla `leyes_estadoley`
--
ALTER TABLE `leyes_estadoley`
  ADD PRIMARY KEY (`idleyesestado`),
  ADD KEY `fk_a_estadoley` (`rel_idestadoley`),
  ADD KEY `fk_a_leyes` (`rel_idleyes`);

--
-- Indices de la tabla `leyes_fuente`
--
ALTER TABLE `leyes_fuente`
  ADD PRIMARY KEY (`idleyesfuente`);

--
-- Indices de la tabla `ley_otrosubtema`
--
ALTER TABLE `ley_otrosubtema`
  ADD PRIMARY KEY (`idleyotrosubtema`),
  ADD KEY `fk_rel_leyes` (`rel_idleyes`),
  ADD KEY `fk_otrosubtema_rel` (`rel_idotrosubtema`);

--
-- Indices de la tabla `ley_otrotema`
--
ALTER TABLE `ley_otrotema`
  ADD PRIMARY KEY (`idleyotrotema`),
  ADD KEY `fk_rel_ley` (`rel_idleyes`),
  ADD KEY `fk_rel_ot` (`rel_idotrotema`);

--
-- Indices de la tabla `ley_subtema`
--
ALTER TABLE `ley_subtema`
  ADD PRIMARY KEY (`idleysubtema`),
  ADD KEY `fk_leyes` (`rel_idleyes`),
  ADD KEY `fk_subtema` (`rel_idsubtema`);

--
-- Indices de la tabla `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `medio_comunicacion`
--
ALTER TABLE `medio_comunicacion`
  ADD PRIMARY KEY (`idmedio`),
  ADD KEY `FK_mediocomunicaciontipo` (`rel_idtipomedio`);

--
-- Indices de la tabla `medio_departamento`
--
ALTER TABLE `medio_departamento`
  ADD PRIMARY KEY (`idmediodepartamento`),
  ADD KEY `FK_mediodepartamento` (`rel_idmedio`),
  ADD KEY `FK_departamentomedio` (`rel_iddepartamento`);

--
-- Indices de la tabla `nombreley`
--
ALTER TABLE `nombreley`
  ADD PRIMARY KEY (`idnombreley`),
  ADD KEY `fk_nombreley_a_estadoley` (`rel_idestadoley`),
  ADD KEY `fk_nombreley_a_leyes` (`rel_idley`);

--
-- Indices de la tabla `noticia`
--
ALTER TABLE `noticia`
  ADD PRIMARY KEY (`idnoticia`),
  ADD KEY `fk_medio` (`rel_idmedio`),
  ADD KEY `fk_usuario` (`rel_idusuario`),
  ADD KEY `fk_cuestionario` (`rel_idcuestionario`);

--
-- Indices de la tabla `noticia_actor`
--
ALTER TABLE `noticia_actor`
  ADD PRIMARY KEY (`idnotactor`),
  ADD KEY `fk_actor` (`rel_idactor`),
  ADD KEY `fk_noticia` (`rel_idnoticia`);

--
-- Indices de la tabla `noticia_otrosubtema`
--
ALTER TABLE `noticia_otrosubtema`
  ADD PRIMARY KEY (`idnototrosubtema`),
  ADD KEY `fk_otrosubtema` (`rel_idotrosubtema`),
  ADD KEY `fk_rel_noticia` (`rel_idnoticia`);

--
-- Indices de la tabla `noticia_otrotema`
--
ALTER TABLE `noticia_otrotema`
  ADD PRIMARY KEY (`idnototrotema`),
  ADD KEY `fk_rel_otro_tema` (`rel_idotrotema`),
  ADD KEY `fk_rel_noticia_otr` (`rel_idnoticia`);

--
-- Indices de la tabla `noticia_subtema`
--
ALTER TABLE `noticia_subtema`
  ADD PRIMARY KEY (`idnotsubtema`),
  ADD KEY `fk_noticia_subtema` (`rel_idnoticia`),
  ADD KEY `fk_not_subtema` (`rel_idsubtema`);

--
-- Indices de la tabla `otrosubtema`
--
ALTER TABLE `otrosubtema`
  ADD PRIMARY KEY (`idotrosubtema`),
  ADD KEY `fk_tema_otrosubtema` (`rel_idtema`);

--
-- Indices de la tabla `otrotema`
--
ALTER TABLE `otrotema`
  ADD PRIMARY KEY (`idotrotema`);

--
-- Indices de la tabla `subtema`
--
ALTER TABLE `subtema`
  ADD PRIMARY KEY (`idsubtema`),
  ADD KEY `rel_idtema` (`rel_idtema`);

--
-- Indices de la tabla `tema`
--
ALTER TABLE `tema`
  ADD PRIMARY KEY (`idtema`),
  ADD KEY `fk_cuestionariotema` (`rel_idcuestionario`);

--
-- Indices de la tabla `tipo_medio`
--
ALTER TABLE `tipo_medio`
  ADD PRIMARY KEY (`idtipomedio`);

--
-- Indices de la tabla `universidad`
--
ALTER TABLE `universidad`
  ADD PRIMARY KEY (`iduniversidad`);

--
-- Indices de la tabla `universidad_departamento`
--
ALTER TABLE `universidad_departamento`
  ADD KEY `fk_rel_depa` (`rel_iddepartamento`),
  ADD KEY `fk_rel_universidad` (`rel_iduniversidad`);

--
-- Indices de la tabla `urlley`
--
ALTER TABLE `urlley`
  ADD PRIMARY KEY (`idurlley`),
  ADD KEY `fk_urlley_a_estadoley` (`rel_idestadoley`),
  ADD KEY `fk_urlley_a_leyes` (`rel_idley`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_email` (`email`),
  ADD UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  ADD UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  ADD UNIQUE KEY `uc_remember_selector` (`remember_selector`);

--
-- Indices de la tabla `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actor`
--
ALTER TABLE `actor`
  MODIFY `idactor` smallint(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `codigoley`
--
ALTER TABLE `codigoley`
  MODIFY `idcodigoley` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cuestionario`
--
ALTER TABLE `cuestionario`
  MODIFY `idcuestionario` smallint(2) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `iddepartamento` smallint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `estadoley`
--
ALTER TABLE `estadoley`
  MODIFY `idestadoley` smallint(2) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `fuente`
--
ALTER TABLE `fuente`
  MODIFY `idfuente` smallint(2) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `leyes`
--
ALTER TABLE `leyes`
  MODIFY `idleyes` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `leyes_estadoley`
--
ALTER TABLE `leyes_estadoley`
  MODIFY `idleyesestado` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `leyes_fuente`
--
ALTER TABLE `leyes_fuente`
  MODIFY `idleyesfuente` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ley_otrosubtema`
--
ALTER TABLE `ley_otrosubtema`
  MODIFY `idleyotrosubtema` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ley_otrotema`
--
ALTER TABLE `ley_otrotema`
  MODIFY `idleyotrotema` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ley_subtema`
--
ALTER TABLE `ley_subtema`
  MODIFY `idleysubtema` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `medio_comunicacion`
--
ALTER TABLE `medio_comunicacion`
  MODIFY `idmedio` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `medio_departamento`
--
ALTER TABLE `medio_departamento`
  MODIFY `idmediodepartamento` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT de la tabla `nombreley`
--
ALTER TABLE `nombreley`
  MODIFY `idnombreley` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `noticia`
--
ALTER TABLE `noticia`
  MODIFY `idnoticia` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `noticia_actor`
--
ALTER TABLE `noticia_actor`
  MODIFY `idnotactor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `noticia_otrosubtema`
--
ALTER TABLE `noticia_otrosubtema`
  MODIFY `idnototrosubtema` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `noticia_otrotema`
--
ALTER TABLE `noticia_otrotema`
  MODIFY `idnototrotema` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `noticia_subtema`
--
ALTER TABLE `noticia_subtema`
  MODIFY `idnotsubtema` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `otrosubtema`
--
ALTER TABLE `otrosubtema`
  MODIFY `idotrosubtema` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `otrotema`
--
ALTER TABLE `otrotema`
  MODIFY `idotrotema` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `subtema`
--
ALTER TABLE `subtema`
  MODIFY `idsubtema` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;

--
-- AUTO_INCREMENT de la tabla `tema`
--
ALTER TABLE `tema`
  MODIFY `idtema` smallint(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `tipo_medio`
--
ALTER TABLE `tipo_medio`
  MODIFY `idtipomedio` smallint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `universidad`
--
ALTER TABLE `universidad`
  MODIFY `iduniversidad` smallint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `urlley`
--
ALTER TABLE `urlley`
  MODIFY `idurlley` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de la tabla `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `codigoley`
--
ALTER TABLE `codigoley`
  ADD CONSTRAINT `fk_codigo_a_estadoley` FOREIGN KEY (`rel_idestadoley`) REFERENCES `estadoley` (`idestadoley`),
  ADD CONSTRAINT `fk_codigo_a_ley` FOREIGN KEY (`rel_idley`) REFERENCES `leyes` (`idleyes`);

--
-- Filtros para la tabla `leyes_estadoley`
--
ALTER TABLE `leyes_estadoley`
  ADD CONSTRAINT `fk_a_estadoley` FOREIGN KEY (`rel_idestadoley`) REFERENCES `estadoley` (`idestadoley`),
  ADD CONSTRAINT `fk_a_leyes` FOREIGN KEY (`rel_idleyes`) REFERENCES `leyes` (`idleyes`);

--
-- Filtros para la tabla `ley_otrosubtema`
--
ALTER TABLE `ley_otrosubtema`
  ADD CONSTRAINT `fk_otrosubtema_rel` FOREIGN KEY (`rel_idotrosubtema`) REFERENCES `otrosubtema` (`idotrosubtema`),
  ADD CONSTRAINT `fk_rel_leyes` FOREIGN KEY (`rel_idleyes`) REFERENCES `leyes` (`idleyes`);

--
-- Filtros para la tabla `ley_otrotema`
--
ALTER TABLE `ley_otrotema`
  ADD CONSTRAINT `fk_rel_ley` FOREIGN KEY (`rel_idleyes`) REFERENCES `leyes` (`idleyes`),
  ADD CONSTRAINT `fk_rel_ot` FOREIGN KEY (`rel_idotrotema`) REFERENCES `otrotema` (`idotrotema`);

--
-- Filtros para la tabla `ley_subtema`
--
ALTER TABLE `ley_subtema`
  ADD CONSTRAINT `fk_leyes` FOREIGN KEY (`rel_idleyes`) REFERENCES `leyes` (`idleyes`),
  ADD CONSTRAINT `fk_subtema` FOREIGN KEY (`rel_idsubtema`) REFERENCES `subtema` (`idsubtema`);

--
-- Filtros para la tabla `medio_comunicacion`
--
ALTER TABLE `medio_comunicacion`
  ADD CONSTRAINT `FK_mediocomunicaciontipo` FOREIGN KEY (`rel_idtipomedio`) REFERENCES `tipo_medio` (`idtipomedio`);

--
-- Filtros para la tabla `medio_departamento`
--
ALTER TABLE `medio_departamento`
  ADD CONSTRAINT `FK_departamentomedio` FOREIGN KEY (`rel_iddepartamento`) REFERENCES `departamento` (`iddepartamento`),
  ADD CONSTRAINT `FK_mediodepartamento` FOREIGN KEY (`rel_idmedio`) REFERENCES `medio_comunicacion` (`idmedio`);

--
-- Filtros para la tabla `nombreley`
--
ALTER TABLE `nombreley`
  ADD CONSTRAINT `fk_nombreley_a_estadoley` FOREIGN KEY (`rel_idestadoley`) REFERENCES `estadoley` (`idestadoley`),
  ADD CONSTRAINT `fk_nombreley_a_leyes` FOREIGN KEY (`rel_idley`) REFERENCES `leyes` (`idleyes`);

--
-- Filtros para la tabla `noticia`
--
ALTER TABLE `noticia`
  ADD CONSTRAINT `fk_noticiacuestionario` FOREIGN KEY (`rel_idcuestionario`) REFERENCES `cuestionario` (`idcuestionario`),
  ADD CONSTRAINT `fk_noticiamedio` FOREIGN KEY (`rel_idmedio`) REFERENCES `medio_comunicacion` (`idmedio`),
  ADD CONSTRAINT `fk_noticiausuario` FOREIGN KEY (`rel_idusuario`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `noticia_actor`
--
ALTER TABLE `noticia_actor`
  ADD CONSTRAINT `fk_actor` FOREIGN KEY (`rel_idactor`) REFERENCES `actor` (`idactor`),
  ADD CONSTRAINT `fk_noticia` FOREIGN KEY (`rel_idnoticia`) REFERENCES `noticia` (`idnoticia`);

--
-- Filtros para la tabla `noticia_otrosubtema`
--
ALTER TABLE `noticia_otrosubtema`
  ADD CONSTRAINT `fk_otrosubtema` FOREIGN KEY (`rel_idotrosubtema`) REFERENCES `otrosubtema` (`idotrosubtema`),
  ADD CONSTRAINT `fk_rel_noticia` FOREIGN KEY (`rel_idnoticia`) REFERENCES `noticia` (`idnoticia`);

--
-- Filtros para la tabla `noticia_otrotema`
--
ALTER TABLE `noticia_otrotema`
  ADD CONSTRAINT `fk_rel_noticia_otr` FOREIGN KEY (`rel_idnoticia`) REFERENCES `noticia` (`idnoticia`),
  ADD CONSTRAINT `fk_rel_otro_tema` FOREIGN KEY (`rel_idotrotema`) REFERENCES `otrotema` (`idotrotema`);

--
-- Filtros para la tabla `noticia_subtema`
--
ALTER TABLE `noticia_subtema`
  ADD CONSTRAINT `fk_not_subtema` FOREIGN KEY (`rel_idsubtema`) REFERENCES `subtema` (`idsubtema`),
  ADD CONSTRAINT `fk_noticia_subtema` FOREIGN KEY (`rel_idnoticia`) REFERENCES `noticia` (`idnoticia`);

--
-- Filtros para la tabla `otrosubtema`
--
ALTER TABLE `otrosubtema`
  ADD CONSTRAINT `fk_tema_otrosubtema` FOREIGN KEY (`rel_idtema`) REFERENCES `tema` (`idtema`);

--
-- Filtros para la tabla `subtema`
--
ALTER TABLE `subtema`
  ADD CONSTRAINT `subtema_ibfk_1` FOREIGN KEY (`rel_idtema`) REFERENCES `tema` (`idtema`);

--
-- Filtros para la tabla `tema`
--
ALTER TABLE `tema`
  ADD CONSTRAINT `fk_cuestionariotema` FOREIGN KEY (`rel_idcuestionario`) REFERENCES `cuestionario` (`idcuestionario`);

--
-- Filtros para la tabla `universidad_departamento`
--
ALTER TABLE `universidad_departamento`
  ADD CONSTRAINT `fk_rel_depa` FOREIGN KEY (`rel_iddepartamento`) REFERENCES `departamento` (`iddepartamento`),
  ADD CONSTRAINT `fk_rel_universidad` FOREIGN KEY (`rel_iduniversidad`) REFERENCES `universidad` (`iduniversidad`);

--
-- Filtros para la tabla `urlley`
--
ALTER TABLE `urlley`
  ADD CONSTRAINT `fk_urlley_a_estadoley` FOREIGN KEY (`rel_idestadoley`) REFERENCES `estadoley` (`idestadoley`),
  ADD CONSTRAINT `fk_urlley_a_leyes` FOREIGN KEY (`rel_idley`) REFERENCES `leyes` (`idleyes`);

--
-- Filtros para la tabla `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
