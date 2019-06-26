-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-06-2019 a las 22:28:00
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.1.8

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
(1, 'Agenda de caminantes', 'hipervinculo', 'none', 'caminante', 'https://docs.wixstatic.com/ugd/b61656_3d7f88c2605f4fedb84094fc316d8902.pdf'),
(2, 'Guia para dirigentes de comunidad', 'hipervinculo', 'none', 'caminante', 'https://docs.wixstatic.com/ugd/b61656_29c9e63e31c646a4baca8a284f447334.pdf'),
(3, 'Manual de especialidades para Lobatos', 'hipervinculo', 'none', 'lobato', 'https://docs.wixstatic.com/ugd/b61656_69245eea8b984e8b9704b7955a921649.pdf'),
(4, 'Rovers', 'hipervinculo', 'none', 'rover', 'https://docs.wixstatic.com/ugd/b61656_5f817f45bfb14334a5d9928f87ceaa8f.pdf'),
(5, 'Manual de especialidades para Tropa', 'hipervinculo', 'none', 'scout', 'https://docs.wixstatic.com/ugd/b61656_1e737307a6d940cb82e517a272a3e5dd.pdf'),
(6, 'Informe Corte de Honor', 'hipervinculo', 'none', 'pdf', 'https://docs.wixstatic.com/ugd/b61656_7fbe9fe23efc48afb3b43e143b5a5ed5.pdf'),
(7, 'Informe Consejo Nacional', 'hipervinculo', 'none', 'pdf', 'https://docs.wixstatic.com/ugd/b61656_2cf2eb415d7d441fb57a10c7c26d9c27.pdf'),
(8, 'Estados Financieros', 'hipervinculo', 'none', 'pdf', 'https://docs.wixstatic.com/ugd/b61656_e793b325f69f4ec6aa83d86538ee6130.pdf'),
(9, 'Malla de cumplimiento', 'hipervinculo', 'none', 'lobato', 'https://docs.wixstatic.com/ugd/b61656_bcca9ae1aca04eb78be2fe74671c90e6.xlsx?dn=Malla%20de%20Cumplimiento%20Corregido%20Enero%2020'),
(10, 'Malla de objetivos', 'hipervinculo', 'none', 'lobato', 'https://docs.wixstatic.com/ugd/b61656_3d19888039fc42dfb51ba7b89debf837.xlsx?dn=Malla%20de%20Objetivos%20Corregidos%20enero%202015'),
(11, 'Cuerpo del cuaderno de caza', 'hipervinculo', 'none', 'lobato', 'https://docs.wixstatic.com/ugd/b61656_1b08ffebe333485d9dce2e2e4b728b04.pdf'),
(12, 'Funciones Cargos Red de J&oacute;venes', 'hipervinculo', 'none', 'caminante', 'https://docs.wixstatic.com/ugd/b61656_afcd33e0c2d0483a8b4051b94871056d.pdf'),
(13, 'Bitacora Scout', 'hipervinculo', 'none', 'scout', 'https://docs.wixstatic.com/ugd/b61656_7f0970dcf832418198f021eac9851230.pdf'),
(14, 'Guia del dirigente de tropa', 'hipervinculo', 'none', 'scout', 'https://docs.wixstatic.com/ugd/b61656_d235493765f94d9998bc0377cca4e9e6.pdf'),
(15, 'Funciones Cargos Red de J&oacute;venes', 'hipervinculo', 'none', 'scout', 'https://docs.wixstatic.com/ugd/b61656_afcd33e0c2d0483a8b4051b94871056d.pdf'),
(16, 'Guia ejes estructurales', 'hipervinculo', 'none', 'rover', 'https://docs.wixstatic.com/ugd/b61656_d2509084f92447fea8a6eecfaeb2a796.pdf'),
(17, 'polit&iacute;ca Nal de participaci&oacute;n Juveni', 'hipervinculo', 'none', 'rover', 'https://docs.wixstatic.com/ugd/b61656_8945e7f7fc08460e9f72f238ef708d34.pdf'),
(18, 'Polit&iacute;ca_DNP_GENERACI&Oacute;N_RESPONSABLE_', 'hipervinculo', 'none', 'rover', 'https://docs.wixstatic.com/ugd/b61656_ce81eeac77d14b1099377dc6740f43e8.pdf'),
(19, 'Informe Tesoreria Nacional', 'hipervinculo', 'none', 'pdf', 'https://docs.wixstatic.com/ugd/b61656_31dca31eb18a481bad4f794d88853eca.pdf'),
(20, 'Acta.54 Asamblea 2017', 'hipervinculo', 'none', 'pdf', 'https://docs.wixstatic.com/ugd/b61656_4daeb238a0174645bb9a4d0948c32541.pdf'),
(21, 'Informe CNVNC', 'hipervinculo', 'none', 'pdf', 'https://docs.wixstatic.com/ugd/b61656_c36d5a5a97664632866d23a50011667a.pdf'),
(22, 'Dictamen Revisor Fiscal', 'hipervinculo', 'none', 'pdf', 'https://docs.wixstatic.com/ugd/b61656_c36d5a5a97664632866d23a50011667a.pdf'),
(23, 'CertificaciÃ³n_no_pertenecer_al_sector', 'hipervinculo', 'none', 'pdf', 'https://docs.wixstatic.com/ugd/b61656_760945fd9fe34bfc8a358b9dd8ffceb8.pdf'),
(24, 'Extracto_asamblea_autorizaciÃ³n', 'hipervinculo', 'none', 'pdf', 'https://docs.wixstatic.com/ugd/b61656_dcea5eec36a447dabd3549daace6b9f5.pdf'),
(25, 'Formulario 5245 Sol. de permanencia', 'hipervinculo', 'none', 'pdf', 'https://docs.wixstatic.com/ugd/b61656_fb80a306dab740e4a94bf221dc2883ae.pdf'),
(26, 'CertificaciÃ³n_antecedentes_Consejeros', 'hipervinculo', 'none', 'pdf', 'https://docs.wixstatic.com/ugd/b61656_931b8e8dab064057b1967b62333d60e9.pdf'),
(27, 'CertificaciÃ³n_de_cumplimiento_requisitos', 'hipervinculo', 'none', 'pdf', 'https://docs.wixstatic.com/ugd/b61656_235201739e934e929789a20780931da2.pdf'),
(28, 'Formulario 2532.pdf', 'hipervinculo', 'none', 'pdf', 'https://docs.wixstatic.com/ugd/b61656_a2a37555a02047a182640f75af4aa5cf.pdf'),
(29, 'Certificado_representaciÃ³n_legal.pdf', 'hipervinculo', 'none', 'pdf', 'https://docs.wixstatic.com/ugd/b61656_c069106246924cf08ad1f4f9d127031d.pdf'),
(30, 'Rut actualizado.pdf', 'hipervinculo', 'none', 'pdf', 'https://docs.wixstatic.com/ugd/4e72e1_64575d7305ba478da366760d2bb01f03.pdf'),
(31, 'Planillas RUMS.xls', 'hipervinculo', 'none', 'pdf', 'https://docs.wixstatic.com/ugd/b61656_984d1c6c62cd4ee0b56c3998f93d0650.xls?dn=Planilla%20RUMNS.xls'),
(32, 'INSTRUCTIVOS RUNMS Y SINMS', 'hipervinculo', 'none', 'pdf', 'https://docs.wixstatic.com/ugd/b61656_bbc929b612674dcf963893393c27ea86.pdf'),
(33, 'MODELO ACUERDO DE PAGO', 'hipervinculo', 'none', 'pdf', 'https://docs.wixstatic.com/ugd/b61656_82e97c976e87438da4772bf36de3ea7d.pdf'),
(34, 'ACUERDO VOLUNTARIO', 'hipervinculo', 'none', 'pdf', 'https://docs.wixstatic.com/ugd/b61656_22401458e0954f96a2b708e0c6046111.pdf'),
(35, 'AUTORIZACI&Oacute;N MAYOR DE EDAD', 'hipervinculo', 'none', 'pdf', 'https://docs.wixstatic.com/ugd/b61656_78123ce8e40d440fabb2aa7aa2c253ae.pdf'),
(36, 'FORMULARIO DE REGISTRO E INSCRIPCI&Oacute;N NACION', 'hipervinculo', 'none', 'pdf', 'https://docs.wixstatic.com/ugd/b61656_a6d5e230370a41c8a7548189aaf2ed7c.pdf'),
(37, 'DESCARGA_RES_NÂ°_028-17', 'hipervinculo', 'none', 'pdf', 'https://docs.wixstatic.com/ugd/b61656_210d57ab1cc44c02a28d3fbdb89f31de.pdf'),
(38, 'Politica Nacional de Desarrollo Institucional', 'hipervinculo', 'none', 'pdf', 'https://docs.wixstatic.com/ugd/b61656_b0adb3fc665f455696e60647a26b1634.pdf'),
(39, 'Manual de PolÃ­ticas de GestiÃ³n', 'hipervinculo', 'none', 'pdf', 'https://docs.wixstatic.com/ugd/b61656_a4acf52f3b284a6891a8541aa43014eb.pdf'),
(40, 'Recaudaci&oacute;n de fondos 2018 ASC', 'hipervinculo', 'none', 'pdf', 'https://docs.wixstatic.com/ugd/b61656_2394637be5194baeaefe6c1663f74277.pdf'),
(41, 'Manual Area Administrativa y Financiera', 'hipervinculo', 'none', 'pdf', 'https://docs.wixstatic.com/ugd/b61656_b9faa36cab2746698cbaea746fd894bc.pdf'),
(42, 'FORTALECIMIENTO DESARROLLO Y SOSTENIBILIDAD GRUPOS', 'hipervinculo', 'none', 'pdf', 'https://docs.wixstatic.com/ugd/b61656_4f7aff2174df42708c87278ce11f2600.pdf');

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
('1120582189', 'C.C', 'Daniel Adrian', 'Gonzalez Buendia', '3182053244', 'primero de mayo cll 19 #19-24', 'danieladriangonzalez@hotmail.com', 'estudiante', 'nueva EPS', '1998-04-22', 'buendiagon', '146015abb8c00070efc50503fcfdf568', 'administrador', 0, 'soltero', 'ninguna', 'ninguna', 'bachiller tÃ©cnico', 2, 'ninguna', 'A+', 'ninguno', 'ninguna', 'ninguna', '41655039'),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT de la tabla `contenido`
--
ALTER TABLE `contenido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
