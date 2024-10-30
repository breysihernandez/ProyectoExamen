-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-10-2024 a las 03:47:19
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `libreria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autores`
--

CREATE TABLE `autores` (
  `id_autor` int(11) NOT NULL,
  `Nombre` varchar(255) NOT NULL,
  `Apellido` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `autores`
--

INSERT INTO `autores` (`id_autor`, `Nombre`, `Apellido`) VALUES
(1, 'Sun', 'Tzu'),
(2, 'Thomas', 'Mann'),
(3, 'Antoine', 'De Saint Exupery'),
(4, 'Edgar Allan', 'Poe'),
(5, 'Charles', 'Perrault'),
(6, 'John', 'Green'),
(7, 'Miguel', 'Gane'),
(8, 'Rick', 'Riordan'),
(9, 'Ann', 'Liang'),
(10, 'Alberto', 'Villareal'),
(11, 'Stephen', 'King'),
(12, 'Scott', 'Cawthon'),
(13, 'Ramon Amaya', 'Amador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `id_detalle` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `id_libro` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_venta`
--

INSERT INTO `detalle_venta` (`id_detalle`, `id_venta`, `id_libro`, `cantidad`, `precio_unitario`) VALUES
(14, 11, 1, 2, 280.00),
(15, 11, 2, 1, 640.00),
(16, 12, 3, 1, 480.00),
(17, 12, 4, 3, 130.00),
(18, 13, 7, 2, 390.00),
(19, 13, 8, 1, 490.00),
(20, 13, 9, 1, 490.00),
(21, 14, 12, 2, 460.00),
(22, 14, 10, 1, 430.00),
(23, 15, 14, 1, 830.00),
(24, 15, 17, 1, 590.00),
(25, 15, 18, 1, 890.00),
(26, 15, 13, 2, 530.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id_empleado` int(11) NOT NULL,
  `Usuario` varchar(255) NOT NULL,
  `Contraseña` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id_empleado`, `Usuario`, `Contraseña`) VALUES
(1201, 'Angeles', '1234\r\n'),
(1202, 'Breysi', '5678'),
(1203, 'CAROLINA', 'MENDOZA'),
(1204, 'DILIA', 'PORTILLO'),
(1205, 'JUAN DAVID', 'SUAZO'),
(1206, 'RIXCCI', 'GALEAS'),
(1207, 'SHERLYN', 'REYES'),
(1208, 'XENIA', 'RODRIGUEZ'),
(1209, 'YOSSEYLI', 'COREA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generos`
--

CREATE TABLE `generos` (
  `id_genero` int(11) NOT NULL,
  `nombre_genero` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `generos`
--

INSERT INTO `generos` (`id_genero`, `nombre_genero`) VALUES
(1, 'Clásico'),
(2, 'Juvenil'),
(3, 'Romance'),
(4, 'Terror');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `id_libro` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `id_autor` int(11) NOT NULL,
  `id_genero` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`id_libro`, `titulo`, `id_autor`, `id_genero`, `precio`) VALUES
(1, 'El arte de la guerra', 1, 1, 280.00),
(2, 'La montaña mágica', 2, 1, 640.00),
(3, 'Un regalo para el corazón', 3, 1, 480.00),
(4, 'Relatos de terror y misterio', 4, 1, 130.00),
(5, 'Cuentos Clásicos', 5, 1, 130.00),
(6, 'Algo más que el bosque', 7, 2, 560.00),
(7, 'Bajo la misma estrella', 6, 2, 390.00),
(8, 'Percy Jackson 1: El ladrón del rayo', 8, 2, 490.00),
(9, 'Percy Jackson 2: El mar de los monstruos', 8, 2, 490.00),
(10, 'Percy Jackson y el cáliz de los dioses', 8, 2, 590.00),
(11, 'Ciudades de papel', 6, 3, 440.00),
(12, 'Ojalá nunca lo leas', 9, 3, 530.00),
(13, 'Todo lo que no me deja olvidarte', 10, 3, 430.00),
(14, 'Si te gusta la oscuridad', 11, 4, 830.00),
(15, 'Los otros animatrónicos', 12, 4, 460.00),
(16, 'Después del anochecer', 11, 4, 590.00),
(17, 'Apocalipsis', 11, 4, 890.00),
(18, 'La larga marcha', 11, 4, 470.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `fecha_venta` date NOT NULL,
  `total_venta` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_venta`, `id_empleado`, `fecha_venta`, `total_venta`) VALUES
(11, 1201, '2024-01-10', 1410.00),
(12, 1202, '2024-01-12', 1260.00),
(13, 1203, '2024-01-15', 1440.00),
(14, 1204, '2024-01-18', 1190.00),
(15, 1205, '2024-01-20', 1760.00);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `autores`
--
ALTER TABLE `autores`
  ADD PRIMARY KEY (`id_autor`),
  ADD UNIQUE KEY `Nombre` (`Nombre`),
  ADD UNIQUE KEY `Apellido` (`Apellido`);

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_venta` (`id_venta`),
  ADD KEY `id_libro` (`id_libro`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id_empleado`);

--
-- Indices de la tabla `generos`
--
ALTER TABLE `generos`
  ADD PRIMARY KEY (`id_genero`),
  ADD UNIQUE KEY `nombre_genero` (`nombre_genero`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`id_libro`),
  ADD KEY `id_autor` (`id_autor`),
  ADD KEY `id_genero` (`id_genero`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `id_empleado` (`id_empleado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `autores`
--
ALTER TABLE `autores`
  MODIFY `id_autor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1210;

--
-- AUTO_INCREMENT de la tabla `generos`
--
ALTER TABLE `generos`
  MODIFY `id_genero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `id_libro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `detalle_venta_ibfk_1` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id_venta`),
  ADD CONSTRAINT `detalle_venta_ibfk_2` FOREIGN KEY (`id_libro`) REFERENCES `libros` (`id_libro`);

--
-- Filtros para la tabla `libros`
--
ALTER TABLE `libros`
  ADD CONSTRAINT `libros_ibfk_1` FOREIGN KEY (`id_autor`) REFERENCES `autores` (`id_autor`),
  ADD CONSTRAINT `libros_ibfk_2` FOREIGN KEY (`id_genero`) REFERENCES `generos` (`id_genero`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleados` (`id_empleado`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
