-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-06-2019 a las 04:58:40
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
-- Base de datos: `segundoparcial`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logueos`
--

CREATE TABLE `logueos` (
  `id` int(11) NOT NULL,
  `legajo` int(11) NOT NULL,
  `email` varchar(20) NOT NULL,
  `hora` time NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `logueos`
--

INSERT INTO `logueos` (`id`, `legajo`, `email`, `hora`, `created_at`, `updated_at`) VALUES
(1, 950, 'aaa@gmail.com', '00:00:00', '2019-06-24', '2019-06-24'),
(2, 950, 'aaa@gmail.com', '04:41:14', '2019-06-24', '2019-06-24'),
(3, 950, 'aaa@gmail.com', '04:41:59', '2019-06-24', '2019-06-24'),
(4, 950, 'aaa@gmail.com', '23:42:25', '2019-06-23', '2019-06-23'),
(5, 500, 'sss', '23:48:47', '2019-06-23', '2019-06-23'),
(6, 500, 'sss', '23:55:35', '2019-06-23', '2019-06-23'),
(7, 750, 'dddd', '23:57:07', '2019-06-23', '2019-06-23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `legajo` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `clave` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `sueldo` int(11) NOT NULL,
  `direccion` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `nivel` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `legajo`, `email`, `clave`, `sueldo`, `direccion`, `telefono`, `nivel`, `created_at`, `updated_at`) VALUES
(1, 950, 'aaa@gmail.com', 'RobertoCarlos', 25000, 'Calle Falsa 123', '1550297632', 'Gerente', '2019-06-24', '2019-06-24'),
(3, 951, 'aaa@gmail.com', 'RobertoCarlos', 25000, 'Calle Falsa 123', '1550297632', 'Gerente', '2019-06-24', '2019-06-24'),
(4, 500, 'sss', 'PPP', 3332, 'Calle Falsa 123', '1550297632', 'Empleado', '2019-06-24', '2019-06-24'),
(5, 750, 'dddd', 'fffff', 3332, 'Calle Falsa 123', '1550297632', 'Encargado', '2019-06-24', '2019-06-24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `fecha` date NOT NULL,
  `precio` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `marca`, `modelo`, `fecha`, `precio`, `created_at`, `updated_at`) VALUES
(1, 'Oreo', 'Alfajor', '0000-00-00', 200, '2019-06-24', '2019-06-24'),
(2, 'Oreo', 'Alfajor', '2019-06-24', 200, '2019-06-24', '2019-06-24'),
(3, 'Oreo', 'alfajor', '2019-06-24', 300, '2019-06-24', '2019-06-24'),
(4, 'Oreo', 'alfajor', '2019-06-24', 300, '2019-06-24', '2019-06-24'),
(5, 'Oreo', 'alfajor', '2019-06-24', 300, '2019-06-24', '2019-06-24'),
(6, 'Oreo', 'alfajor', '2019-06-24', 300, '2019-06-24', '2019-06-24');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `logueos`
--
ALTER TABLE `logueos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `logueos`
--
ALTER TABLE `logueos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
