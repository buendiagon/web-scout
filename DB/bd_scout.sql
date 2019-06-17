-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-06-2019 a las 23:41:09
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
-- Base de datos: `bd_scout`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `biblioteca`
--

CREATE TABLE `biblioteca` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `autor` varchar(50) DEFAULT NULL,
  `rama` varchar(50) DEFAULT NULL,
  `url` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `biblioteca`
--

INSERT INTO `biblioteca` (`id`, `nombre`, `descripcion`, `autor`, `rama`, `url`) VALUES
(1, 'plan de adelanto lobatos', 'lasfdll', 'kasdnfkng', 'lobato', 'https://docs.wixstatic.com/ugd/b61656_1b08ffebe333485d9dce2e2e4b728b04.pdf'),
(2, 'plan de adelanto scout', 'asd', 'sdfsdf', 'scout', 'https://docs.wixstatic.com/ugd/b61656_1b08ffebe333485d9dce2e2e4b728b04.pdf	');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contenido`
--

CREATE TABLE `contenido` (
  `id` int(11) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `texto` varchar(400) NOT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `tipo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `contenido`
--

INSERT INTO `contenido` (`id`, `titulo`, `texto`, `imagen`, `fecha`, `tipo`) VALUES
(1, 'MISI&Oacute;N', 'Contribuir a la educaci&oacute;n de los  							j&oacute;venes, mediante un sistema de  							valores basado en la Promesa y la Ley  							Scout, para ayudar a construir un mundo  							mejor donde las personas se sientan  							realizidas como individuos y jueguen un  							papel constructivo en la sociedad.', 'imagenes/1.jpg', NULL, 'Home'),
(2, 'VISI&Oacute;N MUNDIAL', 'Para el 2023, el Movimiento Scout ser&aacute;  							el movimiento juvenil educcativo l&iacute;der  							en el mundo, permitiendo a 100 millones  							de j&oacute;venes convertirse en ciudadanos  							activos, creando un cambio positivo  							en sus comunidades basado en los valores compartidos.', 'imagenes/1.jpg', NULL, 'Home'),
(3, 'VISI&Oacute;N COLOMBIA', 'Para el 2023, la Asociaci&oacute;n Scout de  							Colombia ser&aacute; uno de los movimientos  							juveniles l&iacute;deres en nuestro pa&iacute;s,  							permitiendo a 50.000 j&oacute;venes  							convertirse	en ciudadanos  activos y gestores de paz, creando  							un cambio pisitvo en sus comunidades basado en los valores compartidos.', 'imagenes/1.jpg', NULL, 'Home'),
(4, 'Title1', 'contenido1 asd as d asd  fds fg sdfh gsd fhg sd fhg sdfg hd gfhdfgh  dfg h d hgdgh d gfh df gh df ghdfhgd hfg hdgfhd fghdf gh dgfh df gh df gh  asd asd as d asd  fds fg sdfh gsd fhg sd fhg sdfg hd gfhdfgh  dfg h d hgdgh d gfh df gh df ghdfhgd hfg hdgfhd fghdf gh dgfh df gh df gh  asdasd as d asd  fds fg sdfh gsd fhg sd fhg sdfg hd gfhdfgh  dfg h d hgdgh d gfh df gh df ghdfhgd hfg hdgfhd fghdf gh d', 'imagenes/1.jpg', '2015-08-13', 'News'),
(5, 'Title2', 'contenido1 asd as d asd  fds fg sdfh gsd fhg sd fhg sdfg hd gfhdfgh  dfg h d hgdgh d gfh df gh df ghdfhgd hfg hdgfhd fghdf gh dgfh df gh df gh  asd asd as d asd  fds fg sdfh gsd fhg sd fhg sdfg hd gfhdfgh  dfg h d hgdgh d gfh df gh df ghdfhgd hfg hdgfhd fghdf gh dgfh df gh df gh  asdasd as d asd  fds fg sdfh gsd fhg sd fhg sdfg hd gfhdfgh  dfg h d hgdgh d gfh df gh df ghdfhgd hfg hdgfhd fghdf gh d', 'imagenes/1.jpg', '2015-09-14', 'News'),
(6, 'Title3', 'contenido3 asd as d asd  fds fg sdfh gsd fhg sd fhg sdfg hd gfhdfgh  dfg h d hgdgh d gfh df gh df ghdfhgd hfg hdgfhd fghdf gh dgfh df gh df gh  asd asd as d asd  fds fg sdfh gsd fhg sd fhg sdfg hd gfhdfgh  dfg h d hgdgh d gfh df gh df ghdfhgd hfg hdgfhd fghdf gh dgfh df gh df gh  asdasd as d asd  fds fg sdfh gsd fhg sd fhg sdfg hd gfhdfgh  dfg h d hgdgh d gfh df gh df ghdfhgd hfg hdgfhd fghdf gh d', 'imagenes/1.jpg', '2016-04-22', 'News'),
(7, 'TimeLine1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime ipsa ratione omnis alias cupiditate saepe atque totam aperiam sed nulla voluptatem recusandae dolor, nostrum excepturi amet in dolores. Alias, ullam.', 'imagenes/contenido/20170305_095157.jpg', '2019-02-15', 'TimeLine'),
(48, 'investidura Daniel', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime ipsa ratione omnis alias cupiditate saepe atque totam aperiam sed nulla voluptatem recusandae dolor, nostrum excepturi amet in dolores. Alias, ullam.', 'imagenes/contenido/20170305_102220.jpg', '2019-02-15', 'TimeLine'),
(49, 'dasd', 'asdasd', 'imagenes/contenido/20170305_094518.jpg', '2019-02-15', 'TimeLine');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `evento` varchar(60) NOT NULL,
  `rama` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`id`, `fecha`, `evento`, `rama`) VALUES
(28, '2019-02-08', 'juego', 'manada'),
(30, '2019-02-22', 'actividad de servicio', 'grupo'),
(33, '2019-03-22', 'sda', 'grupo'),
(34, '2019-02-14', 'actividad de servicio', 'tropa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `documento` varchar(20) NOT NULL,
  `tipo_documento` varchar(20) NOT NULL,
  `nombres` varchar(40) NOT NULL,
  `apellidos` varchar(40) NOT NULL,
  `celular` varchar(15) NOT NULL,
  `direccion` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `ocupacion` varchar(30) NOT NULL,
  `EPS` varchar(30) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `usuario` varchar(25) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `nivel` varchar(20) DEFAULT NULL,
  `genero` tinyint(1) DEFAULT NULL,
  `estado_civil` varchar(25) DEFAULT NULL,
  `religion` varchar(30) DEFAULT NULL,
  `poblacion` varchar(30) DEFAULT NULL,
  `estudios` varchar(30) DEFAULT NULL,
  `estrato` int(11) DEFAULT NULL,
  `discapacidad` varchar(30) DEFAULT NULL,
  `RH` varchar(5) DEFAULT NULL,
  `medicamentos` varchar(100) DEFAULT NULL,
  `dieta` varchar(100) DEFAULT NULL,
  `etapa_progresion` varchar(50) DEFAULT NULL,
  `documento_padre` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`documento`, `tipo_documento`, `nombres`, `apellidos`, `celular`, `direccion`, `email`, `ocupacion`, `EPS`, `fecha_nacimiento`, `usuario`, `password`, `nivel`, `genero`, `estado_civil`, `religion`, `poblacion`, `estudios`, `estrato`, `discapacidad`, `RH`, `medicamentos`, `dieta`, `etapa_progresion`, `documento_padre`) VALUES
('1120582189', 'C.C', 'Daniel Adrian', 'Gonzalez Buendia', '3182053244', 'primero de mayo cll 19 #19-24', 'danieladriangonzalez@hotmail.com', 'estudiante', 'nueva EPS', '1998-04-22', 'buendiagon', '146015abb8c00070efc50503fcfdf568', 'ninguna', 0, 'soltero', 'ninguna', 'ninguna', 'bachiller tÃ©cnico', 2, 'ninguna', 'A+', 'ninguno', 'ninguna', 'ninguna', '41655039'),
('123', 'C.C', 'prueba', 'prueba', '0000000000', 'calle 00', 'prueba@prueba.com', 'prueba', 'nueva EPS', '2000-04-15', 'prueba', 'c893bad68927b457dbed39460e6afd62', 'tropa', 1, 'soltero', 'ninguna', 'ninguna', 'tÃ©cnico', 3, 'ninguna', 'AB+', 'ninguno', 'ninguna', 'ninguna', ''),
('41655039', 'C.C', 'Maria Eugenia', 'Buendia PeÃ±a', '3115408887', 'primero de mayo cll 19 #19-24', 'buendiadellano@gmail.com', 'pensionada', 'nueva EPS', '1964-09-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `biblioteca`
--
ALTER TABLE `biblioteca`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `contenido`
--
ALTER TABLE `contenido`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`documento`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `biblioteca`
--
ALTER TABLE `biblioteca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `contenido`
--
ALTER TABLE `contenido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
