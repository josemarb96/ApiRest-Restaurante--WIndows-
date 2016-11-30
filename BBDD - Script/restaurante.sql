-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-11-2016 a las 23:52:18
-- Versión del servidor: 10.1.16-MariaDB
-- Versión de PHP: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `restaurante`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plato`
--

CREATE TABLE `plato` (
  `idPlato` int(11) NOT NULL,
  `nombrePlato` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `plato`
--

INSERT INTO `plato` (`idPlato`, `nombrePlato`) VALUES
(2, 'Garbanzos'),
(3, 'Pato a la naranja'),
(4, 'Gourmet de puerro');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `plato`
--
ALTER TABLE `plato`
  ADD PRIMARY KEY (`idPlato`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `plato`
--
ALTER TABLE `plato`
  MODIFY `idPlato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
