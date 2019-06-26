-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-06-2019 a las 05:57:42
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
  `tiempo_real` time NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `alimentos`
--

INSERT INTO `alimentos` (`id`, `id_pedido`, `tipo`, `nombre_alimento`, `estado`, `tiempo_comienzo`, `tiempo_estimado`, `tiempo_real`, `id_empleado`, `created_at`, `updated_at`) VALUES
(1, 1, 'comida', 'empanadas', 'Pendiente', '00:00:00', '00:00:00', '00:00:00', 0, '2019-06-20', '2019-06-22'),
(2, 1, 'comida', 'ñoquis', 'Pendiente', '00:00:00', '00:00:00', '00:00:00', 0, '2019-06-20', '2019-06-22'),
(3, 1, 'comida', 'pizza', 'Pendiente', '00:00:00', '00:00:00', '00:00:00', 0, '2019-06-20', '2019-06-22'),
(4, 1, 'comida', 'fideos', 'Pendiente', '00:00:00', '00:00:00', '00:00:00', 0, '2019-06-20', '2019-06-22'),
(5, 1, 'vino', 'tinto', 'Pendiente', '00:00:00', '00:00:00', '00:00:00', 0, '2019-06-20', '2019-06-22'),
(6, 1, 'trago', 'cuba libre', 'Pendiente', '00:00:00', '00:00:00', '00:00:00', 0, '2019-06-20', '2019-06-22'),
(7, 1, 'cerveza', 'colorada', 'Pendiente', '00:00:00', '00:00:00', '00:00:00', 0, '2019-06-20', '2019-06-22'),
(8, 1, 'postre', 'flan con dulce de leche', 'Pendiente', '00:00:00', '00:00:00', '00:00:00', 0, '2019-06-20', '2019-06-22'),
(9, 2, 'comida', 'langosta', 'Pendiente', '00:00:00', '00:00:00', '00:00:00', 0, '2019-06-20', '2019-06-22'),
(10, 2, 'comida', 'milanesa con pure', 'Pendiente', '00:00:00', '00:00:00', '00:00:00', 0, '2019-06-20', '2019-06-22'),
(11, 2, 'cerveza', 'tirada', 'Pendiente', '00:00:00', '00:00:00', '00:00:00', 0, '2019-06-20', '2019-06-22'),
(12, 2, 'postre', 'chocotorta', 'Pendiente', '00:00:00', '00:00:00', '00:00:00', 0, '2019-06-20', '2019-06-22'),
(13, 3, 'comida', 'milanesa', 'Pendiente', '00:00:00', '00:00:00', '00:00:00', 0, '2019-06-22', '2019-06-22'),
(14, 3, 'postre', 'chessecake', 'Pendiente', '00:00:00', '00:00:00', '00:00:00', 0, '2019-06-22', '2019-06-22');

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
(11, 'Maria Rodriguez', 'Bartender123', 'bartender', 'Suspendido', '2019-06-20', '2019-06-20'),
(12, 'Camila Gonzalez', 'Cocinero123', 'cocinero', 'Activo', '2019-06-20', '2019-06-20'),
(13, 'Jose Walter', 'Socio123', 'socio', 'Activo', '2019-06-20', '2019-06-20'),
(14, 'Juan Cruz', 'Cervezero123', 'cervecero', 'Activo', '2019-06-21', '2019-06-21'),
(15, 'Roberto Gomez', 'Cervezero123', 'cervecero', 'Activo', '2019-06-22', '2019-06-22'),
(16, 'Belen Herrera', 'Cocinero123', 'cocinero', 'Activo', '2019-06-22', '2019-06-22'),
(17, 'Jose Artigas', 'Cocinero123', 'cocinero', 'Activo', '2019-06-22', '2019-06-22');

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
(71, 12, 'Camila Gonzalez', '2019-06-22 13:05:34', '2019-06-22', '2019-06-22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa`
--

CREATE TABLE `mesa` (
  `id` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `facturacion` float NOT NULL,
  `rate_mesa` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

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
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `n_mesa`, `estado`, `foto`, `codigo_pedido`, `id_empleado`, `importe`, `created_at`, `updated_at`) VALUES
(1, 1, 'En preparacion', '../files/fotos/Mesa_1_Pedido_2ZmtK.PNG', '2ZmtK', 11, 1220, '2019-06-20', '2019-06-22'),
(2, 5, 'En preparacion', '../files/fotos/Mesa_5_Pedido_216VG.PNG', '216VG', 1, 470, '2019-06-20', '2019-06-22'),
(3, 5, 'En preparacion', '../files/fotos/Mesa_5_Pedido_qjFeI.PNG', 'qjFeI', 14, 220, '2019-06-22', '2019-06-22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rates`
--

CREATE TABLE `rates` (
  `id` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `rate_mesa` int(11) NOT NULL,
  `rate_mozo` int(11) NOT NULL,
  `rate_cocinero` int(11) NOT NULL,
  `rate_restaurant` int(11) NOT NULL,
  `comentario` varchar(66) COLLATE utf8_spanish2_ci NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

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
-- Indices de la tabla `logueos`
--
ALTER TABLE `logueos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mesa`
--
ALTER TABLE `mesa`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `logueos`
--
ALTER TABLE `logueos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT de la tabla `mesa`
--
ALTER TABLE `mesa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `rates`
--
ALTER TABLE `rates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
