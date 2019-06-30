-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-06-2019 a las 20:39:00
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `comanda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alimentos`
--

CREATE TABLE `alimentos` (
  `id` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `tipo` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre_alimento` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `estado` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `tiempo_comienzo` time NOT NULL,
  `tiempo_estimado` time NOT NULL,
  `tiempo_final` time NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `alimentos`
--

INSERT INTO `alimentos` (`id`, `id_pedido`, `tipo`, `nombre_alimento`, `estado`, `tiempo_comienzo`, `tiempo_estimado`, `tiempo_final`, `id_empleado`, `created_at`, `updated_at`) VALUES
(1, 1, 'comida', 'milanesa con papas', 'Listo para servir', '15:14:54', '15:19:54', '15:19:19', 12, '2019-06-30', '2019-06-30'),
(2, 1, 'comida', 'pizza de muzzarela', 'Listo para servir', '15:14:54', '15:19:54', '15:19:19', 12, '2019-06-30', '2019-06-30'),
(3, 1, 'vino', 'tinto', 'Listo para servir', '15:16:13', '15:33:13', '15:18:03', 11, '2019-06-30', '2019-06-30'),
(4, 1, 'vino', 'malbec', 'Listo para servir', '15:16:13', '15:33:13', '15:18:03', 11, '2019-06-30', '2019-06-30'),
(5, 1, 'trago', 'cuba libre', 'Listo para servir', '15:16:13', '15:33:13', '15:18:03', 11, '2019-06-30', '2019-06-30'),
(6, 1, 'cerveza', 'negra', 'Listo para servir', '15:20:00', '15:22:00', '15:20:22', 14, '2019-06-30', '2019-06-30'),
(7, 1, 'postre', 'chocotorta', 'Listo para servir', '15:14:54', '15:19:54', '15:19:19', 12, '2019-06-30', '2019-06-30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `pass` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `tipo` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `estado` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id`, `nombre`, `pass`, `tipo`, `estado`, `updated_at`, `created_at`) VALUES
(1, 'admin', 'sysadmin', 'administrador', 'Activo', '0000-00-00', '0000-00-00'),
(9, 'Juan Gomez', 'Mozo123', 'mozo', 'Activo', '2019-06-20', '2019-06-20'),
(11, 'Maria Rodriguez', 'Bartender123', 'bartender', 'Activo', '2019-06-20', '2019-06-20'),
(12, 'Camila Gonzalez', 'Cocinero123', 'cocinero', 'Activo', '2019-06-20', '2019-06-20'),
(13, 'Jose Walter', 'Socio123', 'socio', 'Activo', '2019-06-20', '2019-06-20'),
(14, 'Juan Cruz', 'Cervezero123', 'cervecero', 'Activo', '2019-06-21', '2019-06-21'),
(15, 'Roberto Gomez', 'Cervezero123', 'cervecero', 'Activo', '2019-06-22', '2019-06-22'),
(16, 'Belen Herrera', 'Cocinero123', 'cocinero', 'Activo', '2019-06-22', '2019-06-22'),
(17, 'Jose Artigas', 'Cocinero123', 'cocinero', 'Activo', '2019-06-22', '2019-06-22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `importes`
--

CREATE TABLE `importes` (
  `id` int(11) NOT NULL,
  `id_mesa` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `importe` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `importes`
--

INSERT INTO `importes` (`id`, `id_mesa`, `id_pedido`, `importe`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1150, '2019-06-30', '2019-06-30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logueos`
--

CREATE TABLE `logueos` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_ingreso` datetime NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `logueos`
--

INSERT INTO `logueos` (`id`, `id_usuario`, `nombre`, `fecha_ingreso`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', '2019-06-17 17:09:55', '2019-06-17', '2019-06-17'),
(2, 1, 'admin', '2019-06-17 17:10:46', '2019-06-17', '2019-06-17'),
(3, 1, 'admin', '2019-06-17 17:13:31', '2019-06-17', '2019-06-17'),
(4, 1, 'admin', '2019-06-17 17:14:41', '2019-06-17', '2019-06-17'),
(5, 2, 'Juan Gomez', '2019-06-17 17:15:18', '2019-06-17', '2019-06-17'),
(6, 2, 'Juan Gomez', '2019-06-17 17:15:24', '2019-06-17', '2019-06-17'),
(7, 2, 'Juan Gomez', '2019-06-17 18:37:00', '2019-06-17', '2019-06-17'),
(8, 2, 'Juan Gomez', '2019-06-17 18:38:22', '2019-06-17', '2019-06-17'),
(9, 2, 'Juan Gomez', '2019-06-17 18:39:26', '2019-06-17', '2019-06-17'),
(10, 2, 'Juan Gomez', '2019-06-17 18:40:47', '2019-06-17', '2019-06-17'),
(11, 2, 'Juan Gomez', '2019-06-17 18:43:42', '2019-06-17', '2019-06-17'),
(12, 2, 'Juan Gomez', '2019-06-17 20:05:13', '2019-06-17', '2019-06-17'),
(13, 2, 'Juan Gomez', '2019-06-17 20:18:25', '2019-06-17', '2019-06-17'),
(14, 2, 'Juan Gomez', '2019-06-17 20:19:57', '2019-06-17', '2019-06-17'),
(15, 2, 'Juan Gomez', '2019-06-17 20:28:32', '2019-06-17', '2019-06-17'),
(16, 2, 'Juan Gomez', '2019-06-17 20:40:17', '2019-06-17', '2019-06-17'),
(17, 1, 'admin', '2019-06-20 12:29:31', '2019-06-20', '2019-06-20'),
(18, 8, 'Alberto', '2019-06-20 12:32:18', '2019-06-20', '2019-06-20'),
(19, 1, 'admin', '2019-06-20 12:34:07', '2019-06-20', '2019-06-20'),
(20, 11, 'Maria Rodriguez', '2019-06-20 12:38:32', '2019-06-20', '2019-06-20'),
(21, 9, 'Juan Gomez', '2019-06-20 13:31:46', '2019-06-20', '2019-06-20'),
(22, 11, 'Maria Rodriguez', '2019-06-20 13:33:17', '2019-06-20', '2019-06-20'),
(23, 11, 'Maria Rodriguez', '2019-06-20 13:38:09', '2019-06-20', '2019-06-20'),
(24, 1, 'admin', '2019-06-20 14:13:25', '2019-06-20', '2019-06-20'),
(25, 1, 'admin', '2019-06-20 14:37:23', '2019-06-20', '2019-06-20'),
(26, 1, 'admin', '2019-06-20 17:38:59', '2019-06-20', '2019-06-20'),
(27, 13, 'Jose Walter', '2019-06-20 17:39:38', '2019-06-20', '2019-06-20'),
(28, 1, 'admin', '2019-06-20 17:46:08', '2019-06-20', '2019-06-20'),
(29, 1, 'admin', '2019-06-20 18:30:10', '2019-06-20', '2019-06-20'),
(30, 13, 'Jose Walter', '2019-06-20 18:32:40', '2019-06-20', '2019-06-20'),
(31, 13, 'Jose Walter', '2019-06-20 20:45:54', '2019-06-20', '2019-06-20'),
(32, 13, 'Jose Walter', '2019-06-20 20:46:08', '2019-06-20', '2019-06-20'),
(33, 1, 'admin', '2019-06-20 20:46:29', '2019-06-20', '2019-06-20'),
(34, 11, 'Maria Rodriguez', '2019-06-20 20:47:15', '2019-06-20', '2019-06-20'),
(35, 1, 'admin', '2019-06-20 21:37:51', '2019-06-20', '2019-06-20'),
(36, 14, 'Juan Cruz', '2019-06-20 21:39:28', '2019-06-20', '2019-06-20'),
(37, 14, 'Juan Cruz', '2019-06-20 21:53:22', '2019-06-20', '2019-06-20'),
(38, 14, 'Juan Cruz', '2019-06-20 22:03:46', '2019-06-20', '2019-06-20'),
(39, 14, 'Juan Cruz', '2019-06-21 21:25:00', '2019-06-21', '2019-06-21'),
(40, 14, 'Juan Cruz', '2019-06-21 21:38:11', '2019-06-21', '2019-06-21'),
(41, 14, 'Juan Cruz', '2019-06-21 22:04:03', '2019-06-21', '2019-06-21'),
(42, 14, 'Juan Cruz', '2019-06-21 22:13:44', '2019-06-21', '2019-06-21'),
(43, 14, 'Juan Cruz', '2019-06-21 22:21:59', '2019-06-21', '2019-06-21'),
(44, 14, 'Juan Cruz', '2019-06-22 00:59:21', '2019-06-22', '2019-06-22'),
(45, 1, 'admin', '2019-06-22 01:01:01', '2019-06-22', '2019-06-22'),
(46, 14, 'Juan Cruz', '2019-06-22 01:02:29', '2019-06-22', '2019-06-22'),
(47, 15, 'Roberto Gomez', '2019-06-22 01:07:11', '2019-06-22', '2019-06-22'),
(48, 15, 'Roberto Gomez', '2019-06-22 01:15:34', '2019-06-22', '2019-06-22'),
(49, 15, 'Roberto Gomez', '2019-06-22 01:31:15', '2019-06-22', '2019-06-22'),
(50, 14, 'Juan Cruz', '2019-06-22 01:31:48', '2019-06-22', '2019-06-22'),
(51, 15, 'Roberto Gomez', '2019-06-22 01:36:29', '2019-06-22', '2019-06-22'),
(52, 15, 'Roberto Gomez', '2019-06-22 11:25:41', '2019-06-22', '2019-06-22'),
(53, 15, 'Roberto Gomez', '2019-06-22 11:49:39', '2019-06-22', '2019-06-22'),
(54, 14, 'Juan Cruz', '2019-06-22 11:50:22', '2019-06-22', '2019-06-22'),
(55, 1, 'admin', '2019-06-22 11:52:32', '2019-06-22', '2019-06-22'),
(56, 17, 'Jose Artigas', '2019-06-22 11:54:14', '2019-06-22', '2019-06-22'),
(57, 17, 'Jose Artigas', '2019-06-22 12:04:36', '2019-06-22', '2019-06-22'),
(58, 16, 'Belen Herrera', '2019-06-22 12:05:23', '2019-06-22', '2019-06-22'),
(59, 12, 'Camila Gonzalez', '2019-06-22 12:06:33', '2019-06-22', '2019-06-22'),
(60, 12, 'Camila Gonzalez', '2019-06-22 12:20:36', '2019-06-22', '2019-06-22'),
(61, 12, 'Camila Gonzalez', '2019-06-22 12:23:50', '2019-06-22', '2019-06-22'),
(62, 17, 'Jose Artigas', '2019-06-22 12:26:41', '2019-06-22', '2019-06-22'),
(63, 12, 'Camila Gonzalez', '2019-06-22 12:27:06', '2019-06-22', '2019-06-22'),
(64, 12, 'Camila Gonzalez', '2019-06-22 12:30:22', '2019-06-22', '2019-06-22'),
(65, 12, 'Camila Gonzalez', '2019-06-22 12:37:18', '2019-06-22', '2019-06-22'),
(66, 12, 'Camila Gonzalez', '2019-06-22 12:45:10', '2019-06-22', '2019-06-22'),
(67, 12, 'Camila Gonzalez', '2019-06-22 13:00:17', '2019-06-22', '2019-06-22'),
(68, 1, 'admin', '2019-06-22 13:00:36', '2019-06-22', '2019-06-22'),
(69, 1, 'admin', '2019-06-22 13:03:54', '2019-06-22', '2019-06-22'),
(70, 1, 'admin', '2019-06-22 13:05:04', '2019-06-22', '2019-06-22'),
(71, 12, 'Camila Gonzalez', '2019-06-22 13:05:34', '2019-06-22', '2019-06-22'),
(72, 12, 'Camila Gonzalez', '2019-06-29 12:43:28', '2019-06-29', '2019-06-29'),
(73, 12, 'Camila Gonzalez', '2019-06-29 12:55:27', '2019-06-29', '2019-06-29'),
(74, 12, 'Camila Gonzalez', '2019-06-29 13:40:08', '2019-06-29', '2019-06-29'),
(75, 12, 'Camila Gonzalez', '2019-06-29 13:51:08', '2019-06-29', '2019-06-29'),
(76, 12, 'Camila Gonzalez', '2019-06-29 13:59:32', '2019-06-29', '2019-06-29'),
(77, 12, 'Camila Gonzalez', '2019-06-29 14:08:13', '2019-06-29', '2019-06-29'),
(78, 12, 'Camila Gonzalez', '2019-06-29 14:17:08', '2019-06-29', '2019-06-29'),
(79, 12, 'Camila Gonzalez', '2019-06-29 14:25:36', '2019-06-29', '2019-06-29'),
(80, 14, 'Juan Cruz', '2019-06-29 14:32:01', '2019-06-29', '2019-06-29'),
(81, 11, 'Maria Rodriguez', '2019-06-29 14:33:16', '2019-06-29', '2019-06-29'),
(82, 11, 'Maria Rodriguez', '2019-06-29 18:02:19', '2019-06-29', '2019-06-29'),
(83, 12, 'Camila Gonzalez', '2019-06-29 18:06:17', '2019-06-29', '2019-06-29'),
(84, 14, 'Juan Cruz', '2019-06-29 18:07:36', '2019-06-29', '2019-06-29'),
(85, 14, 'Juan Cruz', '2019-06-29 18:48:50', '2019-06-29', '2019-06-29'),
(86, 14, 'Juan Cruz', '2019-06-29 19:07:17', '2019-06-29', '2019-06-29'),
(87, 9, 'Juan Gomez', '2019-06-29 19:07:43', '2019-06-29', '2019-06-29'),
(88, 9, 'Juan Gomez', '2019-06-29 19:11:02', '2019-06-29', '2019-06-29'),
(89, 13, 'Jose Walter', '2019-06-29 21:51:19', '2019-06-29', '2019-06-29'),
(90, 13, 'Jose Walter', '2019-06-29 21:55:00', '2019-06-29', '2019-06-29'),
(91, 13, 'Jose Walter', '2019-06-29 22:11:06', '2019-06-29', '2019-06-29'),
(92, 9, 'Juan Gomez', '2019-06-29 22:11:57', '2019-06-29', '2019-06-29'),
(93, 9, 'Juan Gomez', '2019-06-29 22:22:16', '2019-06-29', '2019-06-29'),
(94, 9, 'Juan Gomez', '2019-06-29 22:30:41', '2019-06-29', '2019-06-29'),
(95, 9, 'Juan Gomez', '2019-06-30 00:47:31', '2019-06-30', '2019-06-30'),
(96, 12, 'Camila Gonzalez', '2019-06-30 01:15:03', '2019-06-30', '2019-06-30'),
(97, 12, 'Camila Gonzalez', '2019-06-30 01:22:31', '2019-06-30', '2019-06-30'),
(98, 12, 'Camila Gonzalez', '2019-06-30 01:37:40', '2019-06-30', '2019-06-30'),
(99, 12, 'Camila Gonzalez', '2019-06-30 02:01:37', '2019-06-30', '2019-06-30'),
(100, 13, 'Jose Walter', '2019-06-30 02:02:34', '2019-06-30', '2019-06-30'),
(101, 1, 'admin', '2019-06-30 11:53:17', '2019-06-30', '2019-06-30'),
(102, 9, 'Juan Gomez', '2019-06-30 12:22:18', '2019-06-30', '2019-06-30'),
(103, 9, 'Juan Gomez', '2019-06-30 12:34:19', '2019-06-30', '2019-06-30'),
(104, 9, 'Juan Gomez', '2019-06-30 12:39:25', '2019-06-30', '2019-06-30'),
(105, 12, 'Camila Gonzalez', '2019-06-30 12:41:51', '2019-06-30', '2019-06-30'),
(106, 17, 'Jose Artigas', '2019-06-30 12:43:27', '2019-06-30', '2019-06-30'),
(107, 14, 'Juan Cruz', '2019-06-30 12:58:27', '2019-06-30', '2019-06-30'),
(108, 12, 'Camila Gonzalez', '2019-06-30 13:03:02', '2019-06-30', '2019-06-30'),
(109, 11, 'Maria Rodriguez', '2019-06-30 13:03:51', '2019-06-30', '2019-06-30'),
(110, 9, 'Juan Gomez', '2019-06-30 13:10:40', '2019-06-30', '2019-06-30'),
(111, 9, 'Juan Gomez', '2019-06-30 15:02:27', '2019-06-30', '2019-06-30'),
(112, 1, 'admin', '2019-06-30 15:02:45', '2019-06-30', '2019-06-30'),
(113, 13, 'Jose Walter', '2019-06-30 15:05:48', '2019-06-30', '2019-06-30'),
(114, 13, 'Jose Walter', '2019-06-30 15:07:37', '2019-06-30', '2019-06-30'),
(115, 13, 'Jose Walter', '2019-06-30 15:07:55', '2019-06-30', '2019-06-30'),
(116, 9, 'Juan Gomez', '2019-06-30 15:08:45', '2019-06-30', '2019-06-30'),
(117, 12, 'Camila Gonzalez', '2019-06-30 15:13:48', '2019-06-30', '2019-06-30'),
(118, 11, 'Maria Rodriguez', '2019-06-30 15:15:50', '2019-06-30', '2019-06-30'),
(119, 11, 'Maria Rodriguez', '2019-06-30 15:17:06', '2019-06-30', '2019-06-30'),
(120, 12, 'Camila Gonzalez', '2019-06-30 15:19:10', '2019-06-30', '2019-06-30'),
(121, 14, 'Juan Cruz', '2019-06-30 15:19:46', '2019-06-30', '2019-06-30'),
(122, 9, 'Juan Gomez', '2019-06-30 15:20:49', '2019-06-30', '2019-06-30'),
(123, 12, 'Camila Gonzalez', '2019-06-30 15:30:55', '2019-06-30', '2019-06-30'),
(124, 9, 'Juan Gomez', '2019-06-30 15:31:26', '2019-06-30', '2019-06-30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `tipo` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `precio` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `menus`
--

INSERT INTO `menus` (`id`, `nombre`, `tipo`, `precio`, `created_at`, `updated_at`) VALUES
(2, 'milanesa con papas', 'comida', 150, '2019-06-30', '2019-06-30'),
(3, 'colorada', 'cerveza', 150, '2019-06-30', '2019-06-30'),
(4, 'cuba libre', 'trago', 150, '2019-06-30', '2019-06-30'),
(5, 'daikiri', 'trago', 70, '2019-06-30', '2019-06-30'),
(6, 'flan con dulce de leche', 'postre', 100, '2019-06-30', '2019-06-30'),
(7, 'chocotorta', 'postre', 100, '2019-06-30', '2019-06-30'),
(8, 'ensalada', 'comida', 120, '2019-06-30', '2019-06-30'),
(9, 'rubia', 'cerveza', 120, '2019-06-30', '2019-06-30'),
(10, 'tinto', 'vino', 200, '2019-06-30', '2019-06-30'),
(11, 'blanco', 'vino', 250, '2019-06-30', '2019-06-30'),
(12, 'malbec', 'vino', 250, '2019-06-30', '2019-06-30'),
(13, 'negra', 'cerveza', 130, '2019-06-30', '2019-06-30'),
(14, 'brownie', 'postre', 95, '2019-06-30', '2019-06-30'),
(15, 'pizza de muzzarela', 'comida', 170, '2019-06-30', '2019-06-30'),
(16, 'pizza de anana', 'comida', 30, '2019-06-30', '2019-06-30'),
(17, 'empanadas de carne', 'comida', 35, '2019-06-30', '2019-06-30'),
(18, 'empanadas de jamon y queso', 'comida', 35, '2019-06-30', '2019-06-30'),
(19, 'empanadas de pollo', 'comida', 35, '2019-06-30', '2019-06-30'),
(20, 'empanadas de pi??a', 'comida', 35, '2019-06-30', '2019-06-30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas`
--

CREATE TABLE `mesas` (
  `id` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `estado` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `codigo_identificacion` varchar(7) COLLATE utf8_spanish2_ci NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `mesas`
--

INSERT INTO `mesas` (`id`, `id_pedido`, `estado`, `codigo_identificacion`, `created_at`, `updated_at`) VALUES
(1, 0, 'cerrada', 'ztpRS', '2019-06-30', '2019-06-30'),
(2, 1, 'con cliente pagando', 'd0rJ5', '2019-06-30', '2019-06-30'),
(3, 0, 'cerrada', 'jFBz7', '2019-06-30', '2019-06-30'),
(4, 0, 'cerrada', 'SB9se', '2019-06-30', '2019-06-30'),
(5, 0, 'cerrada', 'iIwlY', '2019-06-30', '2019-06-30'),
(6, 0, 'cerrada', 'PjNXd', '2019-06-30', '2019-06-30'),
(7, 0, 'cerrada', 'LNqYp', '2019-06-30', '2019-06-30'),
(8, 0, 'cerrada', '3vm8N', '2019-06-30', '2019-06-30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `n_mesa` int(11) NOT NULL,
  `estado` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `foto` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `codigo_pedido` varchar(7) COLLATE utf8_spanish2_ci NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `importe` int(11) NOT NULL,
  `pedido_realizado` time NOT NULL,
  `pedido_en_preparacion` time NOT NULL,
  `pedido_listo_para_servir` time NOT NULL,
  `pedido_entregado` time NOT NULL,
  `tiempo_estimado` time NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `n_mesa`, `estado`, `foto`, `codigo_pedido`, `id_empleado`, `importe`, `pedido_realizado`, `pedido_en_preparacion`, `pedido_listo_para_servir`, `pedido_entregado`, `tiempo_estimado`, `created_at`, `updated_at`) VALUES
(1, 2, 'Entregado', '../files/fotos/Mesa_2_Pedido_VFlr2.PNG', 'VFlr2', 9, 1150, '15:10:25', '15:14:54', '15:20:22', '15:21:17', '15:33:13', '2019-06-30', '2019-06-30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rates`
--

CREATE TABLE `rates` (
  `id` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_mesa` int(11) NOT NULL,
  `rate_mesa` int(11) NOT NULL,
  `rate_mozo` int(11) NOT NULL,
  `rate_cocinero` int(11) NOT NULL,
  `rate_restaurant` int(11) NOT NULL,
  `comentario` varchar(66) COLLATE utf8_spanish2_ci NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `rates`
--

INSERT INTO `rates` (`id`, `id_pedido`, `id_mesa`, `rate_mesa`, `rate_mozo`, `rate_cocinero`, `rate_restaurant`, `comentario`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 5, 9, 10, 8, 'Muy bueno todo. Se podria mejorar la presentacion de la mesa.', '2019-06-30', '2019-06-30');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alimentos`
--
ALTER TABLE `alimentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `importes`
--
ALTER TABLE `importes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `logueos`
--
ALTER TABLE `logueos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mesas`
--
ALTER TABLE `mesas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rates`
--
ALTER TABLE `rates`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alimentos`
--
ALTER TABLE `alimentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `importes`
--
ALTER TABLE `importes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `logueos`
--
ALTER TABLE `logueos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT de la tabla `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `mesas`
--
ALTER TABLE `mesas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `rates`
--
ALTER TABLE `rates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
