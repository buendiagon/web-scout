-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-04-2019 a las 00:41:30
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
-- Base de datos: `bd_usuarios`
--

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
('12345678', 'C.C', 'Angie Lorena', 'Quevedo Torres', '3216549875', '2', 'loto@hotmail.com', 'estudiante', 'nueva EPS', '1998-06-23', 'loto', '6b49d4a35074c1fd94d3475df4ad8f7a', 'tropa', 1, 'soltero', 'ninguna', 'ninguna', 'universitarios', 3, 'ninguna', 'O+', 'ninguno', 'ninguna', 'ninguna', ''),
('41655039', 'C.C', 'Maria Eugenia', 'Buendia PeÃ±a', '3115408887', 'primero de mayo cll 19 #19-24', 'buendiadellano@gmail.com', 'pensionada', 'nueva EPS', '1964-09-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`documento`),
  ADD UNIQUE KEY `usuario` (`usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
