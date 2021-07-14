-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-06-2016 a las 02:09:19
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `national`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE IF NOT EXISTS `compras` (
`id_compra` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `metodo_pago` varchar(200) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `apellidos` varchar(200) NOT NULL,
  `num_tarjeta` int(11) NOT NULL,
  `tipo` varchar(200) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id_compra`, `email`, `metodo_pago`, `nombre`, `apellidos`, `num_tarjeta`, `tipo`, `total`) VALUES
(9, 'leo@leo.com', 'mastercard', 'reness', 'Ramirez', 2147483647, 'credito', 8500),
(10, 'leon.r.f@hotmail.com', 'visa', 'Leo', 'Ramirez', 2147483647, 'credito', 5500),
(11, 'leo@leo.com', 'credito', 'reness', 'azsxdcfvg', 2147483647, 'banamex', 1360);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envio`
--

CREATE TABLE IF NOT EXISTS `envio` (
  `email` varchar(200) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `codigo_postal` int(11) NOT NULL,
  `estado` varchar(200) NOT NULL,
  `envio` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `envio`
--

INSERT INTO `envio` (`email`, `nombre`, `direccion`, `codigo_postal`, `estado`, `envio`) VALUES
('leo@leo.com', 'reness', 'Loma Bonita Tecamac', 55776, 'Estado de MÃ©xico', 'fedex'),
('leon.r.f@hotmail.com', 'Leo', 'Loma Bonita Tecamac', 55776, 'Estado de MÃ©xico', 'fedex');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `micarro`
--

CREATE TABLE IF NOT EXISTS `micarro` (
`idcompra` int(11) NOT NULL,
  `usuario` varchar(200) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `micarro`
--

INSERT INTO `micarro` (`idcompra`, `usuario`, `idproducto`, `cantidad`) VALUES
(86, 'leo@leo.com', 71, 1),
(87, 'leo@leo.com', 70, 2),
(102, 'leon.r.f@hotmail.com', 154, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
`id` int(11) NOT NULL,
  `descripcion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `precio` decimal(9,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `descripcion`, `precio`) VALUES
(1, 'Producto 1', '2.56'),
(2, 'Producto 2', '3.25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro`
--

CREATE TABLE IF NOT EXISTS `registro` (
`id` int(200) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `tipo` varchar(200) NOT NULL,
  `Precio` int(11) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=157 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `registro`
--

INSERT INTO `registro` (`id`, `nombre`, `descripcion`, `foto`, `tipo`, `Precio`, `stock`) VALUES
(154, 'Tenis Adidas', 'Negros con Verde', 'tenis.jpg', 'tenis', 900, 5),
(155, 'Tenis Nike', 'Negros Caracteristicas Air Max Color Negros', 'nike-air-max-zero.jpg', 'tenis', 1000, 10),
(156, 'Sudadera', 'CAMPERA NIKE EM CLASSIC POLIWRAP', 'ropa.jpg', 'ropa', 700, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `user` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `tipo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`user`, `password`, `nombre`, `foto`, `tipo`) VALUES
('ale@hotmail.com', '123', 'Alehi', 'Captura de pantalla (50).png', ''),
('ironjimenez@hotmail.es', '12345', 'Jorge ', 'Mario.png', 'admin'),
('Juan', '1234', 'Carlos', 'Mario_SM3DW.png', ''),
('juan@hotmail.com', '1234', 'Juan', 'pool.jpg', ''),
('leo@leo.com', '1', 'reness', 'mario2.jpg', ''),
('leon.r.f@hotmail.com', '1234567', 'Leo', 'foto.jpg', 'admin'),
('soul.sbs@hotmail.com', '12', 'KJLK', 'tlaloc.jpg', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
 ADD PRIMARY KEY (`id_compra`);

--
-- Indices de la tabla `envio`
--
ALTER TABLE `envio`
 ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `micarro`
--
ALTER TABLE `micarro`
 ADD PRIMARY KEY (`idcompra`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `registro`
--
ALTER TABLE `registro`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
 ADD PRIMARY KEY (`user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `micarro`
--
ALTER TABLE `micarro`
MODIFY `idcompra` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=103;
--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `registro`
--
ALTER TABLE `registro`
MODIFY `id` int(200) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=157;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
