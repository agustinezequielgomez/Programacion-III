-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-04-2019 a las 03:06:28
-- Versión del servidor: 10.1.19-MariaDB
-- Versión de PHP: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `utnfra`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `DNI` int(11) NOT NULL,
  `Legajo` int(11) NOT NULL,
  `Edad` int(11) NOT NULL,
  `ID-Localidad` int(11) NOT NULL,
  `Fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`ID`, `Nombre`, `DNI`, `Legajo`, `Edad`, `ID-Localidad`, `Fecha`) VALUES
(1, 'Agustin', 42147544, 107335, 19, 1, '2019-04-08 20:07:54'),
(2, 'Selene', 77854, 12124, 20, 2, '2019-04-08 20:07:54'),
(3, 'Carolina', 447858, 23231, 20, 2, '2019-04-08 20:07:54'),
(4, 'Juan', 78496, 11256, 19, 1, '2019-04-08 20:07:54'),
(5, 'Camila', 12312, 12322, 19, 1, '2019-04-08 20:07:54'),
(7, 'Ezequiel', 44878, 4542, 23, 1, '2019-04-08 20:20:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidad`
--

CREATE TABLE `localidad` (
  `ID` int(18) NOT NULL,
  `CodigoPostal` int(11) NOT NULL,
  `Nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `localidad`
--

INSERT INTO `localidad` (`ID`, `CodigoPostal`, `Nombre`) VALUES
(1, 5569, 'La Plata'),
(5, 1475, 'Lugano'),
(7, 1558, 'Villa Celina');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia`
--

CREATE TABLE `materia` (
  `ID` int(18) NOT NULL,
  `Descripcion` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `materia`
--

INSERT INTO `materia` (`ID`, `Descripcion`) VALUES
(1, '1- Programacion'),
(2, '2- Laboratorio'),
(3, '3- Matematica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia-alumno`
--

CREATE TABLE `materia-alumno` (
  `ID-Materia` int(11) NOT NULL,
  `ID-Alumno` int(11) NOT NULL,
  `Cuatrimestre` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `Nota` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `materia-alumno`
--

INSERT INTO `materia-alumno` (`ID-Materia`, `ID-Alumno`, `Cuatrimestre`, `Nota`) VALUES
(1, 1, '1ro', 10),
(1, 4, '1ro', 8),
(2, 2, '1ro', 6),
(2, 5, '1ro', 4),
(3, 3, '1ro', 2),
(3, 7, '1ro', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `localidad`
--
ALTER TABLE `localidad`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `materia-alumno`
--
ALTER TABLE `materia-alumno`
  ADD PRIMARY KEY (`ID-Materia`,`ID-Alumno`,`Cuatrimestre`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumno`
--
ALTER TABLE `alumno`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `localidad`
--
ALTER TABLE `localidad`
  MODIFY `ID` int(18) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `materia`
--
ALTER TABLE `materia`
  MODIFY `ID` int(18) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
