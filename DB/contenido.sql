-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-04-2019 a las 00:41:05
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_contenido`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contenido`
--

CREATE TABLE `contenido` (
  `id` varchar(30) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `texto` varchar(400) NOT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `contenido`
--

INSERT INTO `contenido` (`id`, `titulo`, `texto`, `imagen`, `fecha`) VALUES
('Home1', 'MISI&Oacute;N', 'Contribuir a la educaci&oacute;n de los  							j&oacute;venes, mediante un sistema de  							valores basado en la Promesa y la Ley  							Scout, para ayudar a construir un mundo  							mejor donde las personas se sientan  							realizidas como individuos y jueguen un  							papel constructivo en la sociedad.', 'imagenes/1.jpg', NULL),
('Home2', 'VISI&Oacute;N MUNDIAL', 'Para el 2023, el Movimiento Scout ser&aacute;  							el movimiento juvenil educcativo l&iacute;der  							en el mundo, permitiendo a 100 millones  							de j&oacute;venes convertirse en ciudadanos  							activos, creando un cambio positivo  							en sus comunidades basado en los valores compartidos.', 'imagenes/1.jpg', NULL),
('Home3', 'VISI&Oacute;N COLOMBIA', 'Para el 2023, la Asociaci&oacute;n Scout de  							Colombia ser&aacute; uno de los movimientos  							juveniles l&iacute;deres en nuestro pa&iacute;s,  							permitiendo a 50.000 j&oacute;venes  							convertirse	en ciudadanos  activos y gestores de paz, creando  							un cambio pisitvo en sus comunidades basado en los valores compartidos.', 'imagenes/1.jpg', NULL),
('News1', 'Title1', 'contenido1 asd as d asd  fds fg sdfh gsd fhg sd fhg sdfg hd gfhdfgh  dfg h d hgdgh d gfh df gh df ghdfhgd hfg hdgfhd fghdf gh dgfh df gh df gh  asd asd as d asd  fds fg sdfh gsd fhg sd fhg sdfg hd gfhdfgh  dfg h d hgdgh d gfh df gh df ghdfhgd hfg hdgfhd fghdf gh dgfh df gh df gh  asdasd as d asd  fds fg sdfh gsd fhg sd fhg sdfg hd gfhdfgh  dfg h d hgdgh d gfh df gh df ghdfhgd hfg hdgfhd fghdf gh d', '', '2015-08-13'),
('News2', 'Title2', 'contenido1 asd as d asd  fds fg sdfh gsd fhg sd fhg sdfg hd gfhdfgh  dfg h d hgdgh d gfh df gh df ghdfhgd hfg hdgfhd fghdf gh dgfh df gh df gh  asd asd as d asd  fds fg sdfh gsd fhg sd fhg sdfg hd gfhdfgh  dfg h d hgdgh d gfh df gh df ghdfhgd hfg hdgfhd fghdf gh dgfh df gh df gh  asdasd as d asd  fds fg sdfh gsd fhg sd fhg sdfg hd gfhdfgh  dfg h d hgdgh d gfh df gh df ghdfhgd hfg hdgfhd fghdf gh d', '', '2015-09-14'),
('News3', 'Title3', 'contenido3 asd as d asd  fds fg sdfh gsd fhg sd fhg sdfg hd gfhdfgh  dfg h d hgdgh d gfh df gh df ghdfhgd hfg hdgfhd fghdf gh dgfh df gh df gh  asd asd as d asd  fds fg sdfh gsd fhg sd fhg sdfg hd gfhdfgh  dfg h d hgdgh d gfh df gh df ghdfhgd hfg hdgfhd fghdf gh dgfh df gh df gh  asdasd as d asd  fds fg sdfh gsd fhg sd fhg sdfg hd gfhdfgh  dfg h d hgdgh d gfh df gh df ghdfhgd hfg hdgfhd fghdf gh d', '', '2016-04-22'),
('News4', 'Title4', 'contenido4 asd as d asd  fds fg sdfh gsd fhg sd fhg sdfg hd gfhdfgh  dfg h d hgdgh d gfh df gh df ghdfhgd hfg hdgfhd fghdf gh dgfh df gh df gh  asd asd as d asd  fds fg sdfh gsd fhg sd fhg sdfg hd gfhdfgh  dfg h d hgdgh d gfh df gh df ghdfhgd hfg hdgfhd fghdf gh dgfh df gh df gh  asdasd as d asd  fds fg sdfh gsd fhg sd fhg sdfg hd gfhdfgh  dfg h d hgdgh d gfh df gh df ghdfhgd hfg hdgfhd fghdf gh d', '', '2016-06-23'),
('TimeLine1', 'Title1', 'descripcion breve', 'imagenes/1.jpg', '2019-03-15'),
('TimeLine2', 'Title2', 'descripcion breve', 'imagenes/1.jpg', '2019-03-15'),
('TimeLine3', 'Title3', 'descripcion breve', 'imagenes/1.jpg', '2019-02-15'),
('TimeLine4', 'Title4', 'descripcion breve', 'imagenes/1.jpg', '2019-02-15');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `contenido`
--
ALTER TABLE `contenido`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
