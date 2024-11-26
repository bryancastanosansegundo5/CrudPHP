-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-11-2024 a las 20:44:35
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

CREATE DATABASE Dwes;
USE Dwes;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
-- <!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
-- <!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
-- <!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dwes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dwes`
--

CREATE TABLE `dwes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `edad` int(11) NOT NULL,
  `fecha-nacimiento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `dwes`
--

INSERT INTO `dwes` (`id`, `nombre`, `apellidos`, `edad`, `fecha-nacimiento`) VALUES
(1, 'Mario', 'Dominguez', 32, '1994-10-04'),
(2, 'Ariadna', 'Martinez', 19, '1993-01-11'),
(3, 'Juan José', 'Lopez', 27, '1992-09-22'),
(4, 'Eustaquio', 'Perez', 25, '1991-11-30');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `dwes`
--
ALTER TABLE `dwes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `dwes`
--
ALTER TABLE `dwes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
-- <!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
-- <!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
