-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-07-2023 a las 19:50:15
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `guardias`
--
CREATE DATABASE IF NOT EXISTS `guardias` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `guardias`;

DELIMITER $$
--
-- Funciones
--
CREATE DEFINER=`root`@`localhost` FUNCTION `min2horas` (`valor` INT) RETURNS VARCHAR(5) CHARSET utf8 COLLATE utf8_spanish_ci NO SQL BEGIN
    DECLARE Horas int;
    DECLARE Minutos int;

    DECLARE sHoras VARCHAR(2);
    DECLARE sMinutos VARCHAR(2);
    DECLARE sHora VARCHAR(5);

    SET Horas = Valor DIV 60;
    set Minutos = Valor - (Horas * 60);

    set sHoras = CONVERT(Horas,char);
    set sMinutos = CONVERT(Minutos,char);

    set sHoras = concat(REPEAT("0",2 - char_LENGTH(sHoras)), sHoras);
    set sMinutos = concat(REPEAT("0",2 - char_LENGTH(sMinutos)) , sMinutos);


    set shora= concat(sHoras , ':' , sMinutos);
	return shora;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE `actividades` (
  `Codigo` varchar(3) NOT NULL,
  `Descripcion` varchar(100) DEFAULT NULL,
  `Mostrar_en_listas` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `causas`
--

CREATE TABLE `causas` (
  `codigo` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config`
--

CREATE TABLE `config` (
  `fecha_ult_camb_turno` date NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `config`
--

INSERT INTO `config` (`fecha_ult_camb_turno`, `id`) VALUES
('2020-11-13', 1);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `consulta_clasificacion_faltas`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `consulta_clasificacion_faltas` (
`profesor` varchar(9)
,`apenom` varchar(77)
,`totalf` bigint(21)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `consulta_clasificacion_guardias`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `consulta_clasificacion_guardias` (
`Profesor` varchar(9)
,`apenom` varchar(77)
,`totalg` bigint(21)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `consulta_faltas`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `consulta_faltas` (
`CodigoProf` varchar(9)
,`Apenom` varchar(77)
,`Sustituto` varchar(50)
,`DiaSem` varchar(1)
,`Tramo` varchar(2)
,`Aula` varchar(50)
,`Unidad` varchar(5)
,`Curso` varchar(100)
,`Materia` varchar(100)
,`Inicio` varchar(5)
,`Fin` varchar(5)
,`Actividad` varchar(100)
,`fecha` date
,`profesor` varchar(9)
,`tramos` varchar(15)
,`causa` int(11)
,`anotacion1` varchar(25)
,`anotacion2` varchar(25)
,`anotacion3` varchar(25)
,`anotacion4` varchar(25)
,`anotacion5` varchar(25)
,`anotacion6` varchar(25)
,`anotacion7` varchar(25)
,`guardiaSN` tinyint(1)
,`id` int(11)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `consulta_horarios`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `consulta_horarios` (
`CodigoProf` varchar(9)
,`Apenom` varchar(77)
,`DiaSem` varchar(1)
,`Tramo` varchar(2)
,`CodTramo` varchar(6)
,`Aula` varchar(50)
,`Unidad` varchar(5)
,`Curso` varchar(100)
,`Materia` varchar(100)
,`Inicio` varchar(5)
,`Fin` varchar(5)
,`Actividad` varchar(100)
,`Sustituto` varchar(50)
,`Id` int(11)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `consulta_reguard`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `consulta_reguard` (
`dia` int(11)
,`tramo` varchar(6)
,`profesor` varchar(9)
,`nguardias` bigint(21)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `consulta_tramos_horarios`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `consulta_tramos_horarios` (
`Tramo` varchar(2)
,`Inicio` varchar(5)
,`Fin` varchar(5)
,`Codigo` varchar(6)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `Codigo` varchar(6) NOT NULL,
  `Descripcion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dependencias`
--

CREATE TABLE `dependencias` (
  `Codigo` varchar(5) NOT NULL,
  `Descripcion` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `faltas`
--

CREATE TABLE `faltas` (
  `fecha` date NOT NULL,
  `profesor` varchar(9) NOT NULL,
  `tramos` varchar(15) NOT NULL,
  `causa` int(11) NOT NULL,
  `anotacion1` varchar(25) NOT NULL,
  `anotacion2` varchar(25) NOT NULL,
  `anotacion3` varchar(25) NOT NULL,
  `anotacion4` varchar(25) NOT NULL,
  `anotacion5` varchar(25) NOT NULL,
  `anotacion6` varchar(25) NOT NULL,
  `anotacion7` varchar(25) NOT NULL,
  `guardiaSN` tinyint(1) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `CodigoProf` varchar(9) DEFAULT NULL,
  `DiaSem` varchar(1) DEFAULT NULL,
  `Tramo` varchar(6) DEFAULT NULL,
  `Aula` varchar(5) DEFAULT NULL,
  `Unidad` varchar(6) DEFAULT NULL,
  `Curso` varchar(6) DEFAULT NULL,
  `Materia` varchar(6) DEFAULT NULL,
  `Hinicio` varchar(5) DEFAULT NULL,
  `Hfin` varchar(5) DEFAULT NULL,
  `Actividad` varchar(3) DEFAULT NULL,
  `Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE `materias` (
  `Codigo` varchar(5) NOT NULL,
  `Descripcion` varchar(100) DEFAULT NULL,
  `Curso` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores`
--

CREATE TABLE `profesores` (
  `Codigo` varchar(9) NOT NULL,
  `TomaPosesion` varchar(10) DEFAULT NULL,
  `Puesto` varchar(50) DEFAULT NULL,
  `Apellido1` varchar(25) DEFAULT NULL,
  `Apellido2` varchar(25) DEFAULT NULL,
  `Nombre` varchar(25) DEFAULT NULL,
  `Sustituto` varchar(50) DEFAULT NULL,
  `Email` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_guardias`
--

CREATE TABLE `registro_guardias` (
  `Fecha` date NOT NULL,
  `Profesor` varchar(9) NOT NULL,
  `Dia` int(11) NOT NULL,
  `Tramo` varchar(6) NOT NULL,
  `Unidad` varchar(6) NOT NULL,
  `Aula` varchar(5) NOT NULL,
  `Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tramos_horarios`
--

CREATE TABLE `tramos_horarios` (
  `Codigo` varchar(6) NOT NULL,
  `Tramo` varchar(2) DEFAULT NULL,
  `Inicio` varchar(5) DEFAULT NULL,
  `Fin` varchar(5) DEFAULT NULL,
  `Jornada` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turnos`
--

CREATE TABLE `turnos` (
  `profesor` varchar(9) NOT NULL,
  `dia` varchar(1) NOT NULL,
  `tramo` varchar(6) NOT NULL,
  `turno` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidades`
--

CREATE TABLE `unidades` (
  `Codigo` varchar(6) NOT NULL,
  `Descripcion` varchar(5) DEFAULT NULL,
  `Curso` varchar(6) NOT NULL,
  `Aula` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL,
  `apenom` varchar(45) NOT NULL,
  `email` varchar(255) NOT NULL,
  `movil` varchar(12) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `tipo_usuario` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `apenom`, `email`, `movil`, `usuario`, `clave`, `tipo_usuario`) VALUES
(9, 'Profesor', '', '', 'Profesor', 'bd5d235eccfbea61766a97700a49a78a', 'profesor'),
(11, 'Administrador', '', '', 'admin', '9a787d4d6ab18460da19d0df1aeabeec', 'admin');

-- --------------------------------------------------------

--
-- Estructura para la vista `consulta_clasificacion_faltas`
--
DROP TABLE IF EXISTS `consulta_clasificacion_faltas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `consulta_clasificacion_faltas`  AS SELECT `faltas`.`profesor` AS `profesor`, concat(`profesores`.`Apellido1`,' ',`profesores`.`Apellido2`,' ',`profesores`.`Nombre`) AS `apenom`, count(0) AS `totalf` FROM (`faltas` join `profesores` on(`profesores`.`Codigo` = `faltas`.`profesor`)) GROUP BY `faltas`.`profesor`, concat(`profesores`.`Apellido1`,' ',`profesores`.`Apellido2`,' ',`profesores`.`Nombre`) ORDER BY count(0) DESC ;

-- --------------------------------------------------------

--
-- Estructura para la vista `consulta_clasificacion_guardias`
--
DROP TABLE IF EXISTS `consulta_clasificacion_guardias`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `consulta_clasificacion_guardias`  AS SELECT `registro_guardias`.`Profesor` AS `Profesor`, concat(`profesores`.`Apellido1`,' ',`profesores`.`Apellido2`,' ',`profesores`.`Nombre`) AS `apenom`, count(0) AS `totalg` FROM (`registro_guardias` join `profesores` on(`profesores`.`Codigo` = `registro_guardias`.`Profesor`)) GROUP BY `registro_guardias`.`Profesor`, concat(`profesores`.`Apellido1`,' ',`profesores`.`Apellido2`,' ',`profesores`.`Nombre`) ORDER BY count(0) DESC ;

-- --------------------------------------------------------

--
-- Estructura para la vista `consulta_faltas`
--
DROP TABLE IF EXISTS `consulta_faltas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `consulta_faltas`  AS SELECT `consulta_horarios`.`CodigoProf` AS `CodigoProf`, `consulta_horarios`.`Apenom` AS `Apenom`, `consulta_horarios`.`Sustituto` AS `Sustituto`, `consulta_horarios`.`DiaSem` AS `DiaSem`, `consulta_horarios`.`Tramo` AS `Tramo`, `consulta_horarios`.`Aula` AS `Aula`, `consulta_horarios`.`Unidad` AS `Unidad`, `consulta_horarios`.`Curso` AS `Curso`, `consulta_horarios`.`Materia` AS `Materia`, `consulta_horarios`.`Inicio` AS `Inicio`, `consulta_horarios`.`Fin` AS `Fin`, `consulta_horarios`.`Actividad` AS `Actividad`, `faltas`.`fecha` AS `fecha`, `faltas`.`profesor` AS `profesor`, `faltas`.`tramos` AS `tramos`, `faltas`.`causa` AS `causa`, `faltas`.`anotacion1` AS `anotacion1`, `faltas`.`anotacion2` AS `anotacion2`, `faltas`.`anotacion3` AS `anotacion3`, `faltas`.`anotacion4` AS `anotacion4`, `faltas`.`anotacion5` AS `anotacion5`, `faltas`.`anotacion6` AS `anotacion6`, `faltas`.`anotacion7` AS `anotacion7`, `faltas`.`guardiaSN` AS `guardiaSN`, `faltas`.`id` AS `id` FROM (`consulta_horarios` join `faltas` on(`consulta_horarios`.`CodigoProf` = `faltas`.`profesor`)) WHERE `faltas`.`fecha` = curdate() AND cast(`consulta_horarios`.`DiaSem` as unsigned) = date_format(current_timestamp(),'%w') ORDER BY `consulta_horarios`.`CodigoProf` ASC, `consulta_horarios`.`DiaSem` ASC, `consulta_horarios`.`Tramo` ASC ;

-- --------------------------------------------------------

--
-- Estructura para la vista `consulta_horarios`
--
DROP TABLE IF EXISTS `consulta_horarios`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `consulta_horarios`  AS SELECT `horarios`.`CodigoProf` AS `CodigoProf`, concat(`profesores`.`Apellido1`,' ',`profesores`.`Apellido2`,',',`profesores`.`Nombre`) AS `Apenom`, `horarios`.`DiaSem` AS `DiaSem`, `tramos_horarios`.`Tramo` AS `Tramo`, `tramos_horarios`.`Codigo` AS `CodTramo`, `dependencias`.`Descripcion` AS `Aula`, `unidades`.`Descripcion` AS `Unidad`, `cursos`.`Descripcion` AS `Curso`, `materias`.`Descripcion` AS `Materia`, `Min2Horas`(`horarios`.`Hinicio`) AS `Inicio`, `Min2Horas`(`horarios`.`Hfin`) AS `Fin`, `actividades`.`Descripcion` AS `Actividad`, `profesores`.`Sustituto` AS `Sustituto`, `horarios`.`Id` AS `Id` FROM (((((((`horarios` join `profesores` on(`profesores`.`Codigo` = `horarios`.`CodigoProf`)) join `tramos_horarios` on(`tramos_horarios`.`Codigo` = `horarios`.`Tramo`)) left join `dependencias` on(`dependencias`.`Codigo` = `horarios`.`Aula`)) left join `unidades` on(`unidades`.`Codigo` = `horarios`.`Unidad`)) left join `cursos` on(`cursos`.`Codigo` = `horarios`.`Curso`)) left join `materias` on(`materias`.`Codigo` = `horarios`.`Materia`)) left join `actividades` on(`actividades`.`Codigo` = `horarios`.`Actividad`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `consulta_reguard`
--
DROP TABLE IF EXISTS `consulta_reguard`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `consulta_reguard`  AS SELECT `registro_guardias`.`Dia` AS `dia`, `registro_guardias`.`Tramo` AS `tramo`, `registro_guardias`.`Profesor` AS `profesor`, count(0) AS `nguardias` FROM `registro_guardias` GROUP BY `registro_guardias`.`Dia`, `registro_guardias`.`Tramo`, `registro_guardias`.`Profesor` ORDER BY `registro_guardias`.`Dia` ASC, `registro_guardias`.`Tramo` ASC, count(0) ASC ;

-- --------------------------------------------------------

--
-- Estructura para la vista `consulta_tramos_horarios`
--
DROP TABLE IF EXISTS `consulta_tramos_horarios`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `consulta_tramos_horarios`  AS SELECT `tramos_horarios`.`Tramo` AS `Tramo`, `min2horas`(`tramos_horarios`.`Inicio`) AS `Inicio`, `min2Horas`(`tramos_horarios`.`Fin`) AS `Fin`, `tramos_horarios`.`Codigo` AS `Codigo` FROM `tramos_horarios` WHERE `tramos_horarios`.`Tramo` < '8' ORDER BY `min2horas`(`tramos_horarios`.`Inicio`) ASC ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`Codigo`);

--
-- Indices de la tabla `causas`
--
ALTER TABLE `causas`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`Codigo`);

--
-- Indices de la tabla `dependencias`
--
ALTER TABLE `dependencias`
  ADD PRIMARY KEY (`Codigo`);

--
-- Indices de la tabla `faltas`
--
ALTER TABLE `faltas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Tramo` (`Tramo`),
  ADD KEY `Aula` (`Aula`),
  ADD KEY `Unidad` (`Unidad`),
  ADD KEY `Curso` (`Curso`),
  ADD KEY `Materia` (`Materia`),
  ADD KEY `Actividad` (`Actividad`),
  ADD KEY `CodigoProf` (`CodigoProf`),
  ADD KEY `Hor` (`CodigoProf`,`Tramo`,`DiaSem`) USING BTREE;

--
-- Indices de la tabla `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`Codigo`);

--
-- Indices de la tabla `profesores`
--
ALTER TABLE `profesores`
  ADD PRIMARY KEY (`Codigo`);

--
-- Indices de la tabla `registro_guardias`
--
ALTER TABLE `registro_guardias`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `tramos_horarios`
--
ALTER TABLE `tramos_horarios`
  ADD PRIMARY KEY (`Codigo`);

--
-- Indices de la tabla `turnos`
--
ALTER TABLE `turnos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profe` (`profesor`),
  ADD KEY `Tramo` (`tramo`);

--
-- Indices de la tabla `unidades`
--
ALTER TABLE `unidades`
  ADD PRIMARY KEY (`Codigo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuario`);

--
-- AUTO_INCREMENT de la tabla `causas`
--
ALTER TABLE `causas`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `faltas`
--
ALTER TABLE `faltas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `registro_guardias`
--
ALTER TABLE `registro_guardias`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `turnos`
--
ALTER TABLE `turnos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
