-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-06-2019 a las 03:06:22
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.2

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
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id` int(11) NOT NULL,
  `articulo` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha` date NOT NULL,
  `precio` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id`, `articulo`, `fecha`, `precio`, `id_usuario`, `created_at`, `updated_at`) VALUES
(1, 'Galletitas', '0000-00-00', 50, 6, '2019-06-11', '2019-06-11'),
(2, 'Gaseosa', '0000-00-00', 80, 1, '2019-06-11', '2019-06-11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registros`
--

CREATE TABLE `registros` (
  `id` int(11) NOT NULL,
  `nombre_usuario` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `metodo` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `ruta` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `hora` date NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `registros`
--

INSERT INTO `registros` (`id`, `nombre_usuario`, `metodo`, `ruta`, `hora`, `created_at`, `updated_at`) VALUES
(1, 'user3', 'GET', 'Compra/', '0000-00-00', '2019-06-11', '2019-06-11'),
(2, '', 'POST', 'Login/', '0000-00-00', '2019-06-11', '2019-06-11'),
(3, '', 'POST', 'Login/', '0000-00-00', '2019-06-11', '2019-06-11'),
(4, '', 'POST', 'Login/', '0000-00-00', '2019-06-11', '2019-06-11'),
(5, '', 'POST', 'Login/', '0000-00-00', '2019-06-11', '2019-06-11'),
(6, 'user3', 'POST', 'Login/', '0000-00-00', '2019-06-11', '2019-06-11'),
(7, 'admin', 'POST', 'Login/', '0000-00-00', '2019-06-11', '2019-06-11'),
(8, 'admin', 'POST', 'Login/', '0000-00-00', '2019-06-11', '2019-06-11'),
(9, 'admin', 'POST', 'Login/', '0000-00-00', '2019-06-11', '2019-06-11'),
(10, 'admin', 'POST', 'Login/', '0000-00-00', '2019-06-11', '2019-06-11'),
(11, 'admin', 'P', 'L', '0000-00-00', '2019-06-11', '2019-06-11'),
(12, 'admin', '', '', '0000-00-00', '2019-06-11', '2019-06-11'),
(13, '', 'P', 'L', '0000-00-00', '2019-06-11', '2019-06-11'),
(14, '', 'P', 'L', '0000-00-00', '2019-06-11', '2019-06-11'),
(15, 'admin', 'P', 'L', '0000-00-00', '2019-06-11', '2019-06-11'),
(16, 'admin', 'POST', 'Login/', '0000-00-00', '2019-06-11', '2019-06-11'),
(17, 'admin', 'POST', 'Login/', '0000-00-00', '2019-06-11', '2019-06-11'),
(18, 'admin', 'POST', 'Login/', '0000-00-00', '2019-06-11', '2019-06-11'),
(19, 'admin', 'POST', 'Login/', '0000-00-00', '2019-06-11', '2019-06-11'),
(20, 'admin', 'POST', 'Login/', '0000-00-00', '2019-06-11', '2019-06-11'),
(21, 'admin', 'POST', 'Usuario/', '0000-00-00', '2019-06-11', '2019-06-11'),
(22, 'octavio', 'POST', 'Login/', '0000-00-00', '2019-06-11', '2019-06-11'),
(23, 'octavio', 'GET', 'Compra/', '0000-00-00', '2019-06-11', '2019-06-11'),
(24, 'octavio', 'POST', 'Login/', '0000-00-00', '2019-06-11', '2019-06-11'),
(25, 'octavio', 'POST', 'Compra/', '0000-00-00', '2019-06-11', '2019-06-11'),
(26, 'octavio', 'POST', 'Compra/', '0000-00-00', '2019-06-11', '2019-06-11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `clave` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `sexo` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `perfil` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `clave`, `sexo`, `perfil`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', 'femenino', 'admin', '0000-00-00', '0000-00-00'),
(2, 'admin2', 'admin2clave', 'masculino', '', '2019-06-11', '2019-06-11'),
(3, 'admin2', 'admin2clave', 'masculino', '', '2019-06-11', '2019-06-11'),
(4, 'admin2', 'admin2clave', 'masculino', '', '2019-06-11', '2019-06-11'),
(5, 'admin2', 'admin2clave', 'masculino', '', '2019-06-11', '2019-06-11'),
(6, 'user3', 'usse3pass', 'masculino', 'usuario', '2019-06-11', '2019-06-11'),
(7, 'octavio', 'octavio', 'masculino', 'user', '2019-06-11', '2019-06-11');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `registros`
--
ALTER TABLE `registros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `registros`
--
ALTER TABLE `registros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
