-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-06-2019 a las 05:49:45
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
-- Base de datos: `id9074800_comanda`
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
  `tiempo_comienzo` datetime NOT NULL,
  `tiempo_estimado` datetime NOT NULL,
  `tiempo_real` datetime NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `pass` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `tipo` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id`, `nombre`, `pass`, `tipo`, `updated_at`, `created_at`) VALUES
(1, 'admin', 'sysadmin', 'administrador', '0000-00-00', '0000-00-00'),
(2, 'Juan Gomez', 'Juancito123', 'mozos', '0000-00-00', '0000-00-00'),
(4, 'admin5', 'sysadmin2019', 'administrador', '0000-00-00', '0000-00-00'),
(6, 'adminTest23', 'TestAdmin2', 'administrador', '2019-06-09', '0000-00-00'),
(8, 'Alberto', 'Albert123', 'bartender', '2019-06-09', '2019-06-09');

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
(16, 2, 'Juan Gomez', '2019-06-17 20:40:17', '2019-06-17', '2019-06-17');

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
  `codigo_pedido` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `importe` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `logueos`
--
ALTER TABLE `logueos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `mesa`
--
ALTER TABLE `mesa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rates`
--
ALTER TABLE `rates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
