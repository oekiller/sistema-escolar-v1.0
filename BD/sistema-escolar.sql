-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 13-02-2023 a las 16:46:02
-- Versión del servidor: 5.7.31
-- Versión de PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema-escolar`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad`
--

DROP TABLE IF EXISTS `actividad`;
CREATE TABLE IF NOT EXISTS `actividad` (
  `actividad_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_actividad` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`actividad_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `actividad`
--

INSERT INTO `actividad` (`actividad_id`, `nombre_actividad`, `estado`) VALUES
(1, 'Tarea en casa', 1),
(2, 'Sistema CRM ', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

DROP TABLE IF EXISTS `alumnos`;
CREATE TABLE IF NOT EXISTS `alumnos` (
  `alumno_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_alumno` varchar(100) NOT NULL,
  `edad` int(11) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `telefono` bigint(20) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `fecha_nac` date NOT NULL,
  `fecha_registro` date NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  `u_acceso` datetime DEFAULT NULL,
  PRIMARY KEY (`alumno_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`alumno_id`, `nombre_alumno`, `edad`, `direccion`, `cedula`, `clave`, `telefono`, `correo`, `fecha_nac`, `fecha_registro`, `estado`, `u_acceso`) VALUES
(3, 'Oscar Echeverry Gonzalez', 29, 'diagonal 4B # 15-24', '1112226560', '$2y$10$8A3vdmM7M55g1.T0ZxHMT.gwoIETawXcHdzsrKJlMPiPsF4JPiRRC', 3107644116, 'oscar@gmail.com', '2023-01-16', '2023-01-16', 1, '2023-02-13 16:39:01'),
(4, 'harold moreno', 26, 'calle 33', '123', '123', 12345, 'harold@gmail.com', '2023-01-16', '2023-01-16', 1, NULL),
(5, 'jeison peñaranda', 29, 'calle 7 ', '123', '$2y$10$6ytkBfZIFZkhm4JmaNAIFu4Ue1QlFElzgBSpP21R3oeTzcVgoCggK', 123456, 'jeison@gmail.com', '2023-01-16', '2023-01-16', 1, NULL),
(6, 'Andres Bolaños', 12, 'calle 7 ', '123', '$2y$10$Ic2OcF8cMchl.zBN432NEeKYejONavxOABafZRhjGdJjkAvHgrRLG', 3146762269, 'mina@gmail.com', '2023-01-03', '2023-01-27', 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno_profesor`
--

DROP TABLE IF EXISTS `alumno_profesor`;
CREATE TABLE IF NOT EXISTS `alumno_profesor` (
  `ap_id` int(11) NOT NULL AUTO_INCREMENT,
  `alumno_id` int(11) NOT NULL,
  `pm_id` int(11) NOT NULL,
  `periodo_id` int(11) NOT NULL,
  `estadop` int(11) NOT NULL,
  PRIMARY KEY (`ap_id`),
  KEY `alumno_id` (`alumno_id`),
  KEY `pm_id` (`pm_id`),
  KEY `periodo_id` (`periodo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `alumno_profesor`
--

INSERT INTO `alumno_profesor` (`ap_id`, `alumno_id`, `pm_id`, `periodo_id`, `estadop`) VALUES
(1, 5, 1, 1, 0),
(2, 4, 1, 1, 0),
(3, 5, 1, 2, 0),
(4, 4, 1, 1, 0),
(5, 4, 2, 2, 0),
(6, 6, 6, 1, 1),
(7, 6, 5, 1, 1),
(8, 3, 4, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aulas`
--

DROP TABLE IF EXISTS `aulas`;
CREATE TABLE IF NOT EXISTS `aulas` (
  `aula_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_aula` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`aula_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `aulas`
--

INSERT INTO `aulas` (`aula_id`, `nombre_aula`, `estado`) VALUES
(1, 'Sala 2205', 1),
(2, 'Sala 2206', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contenidos`
--

DROP TABLE IF EXISTS `contenidos`;
CREATE TABLE IF NOT EXISTS `contenidos` (
  `contenido_id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `material` varchar(255) NOT NULL,
  `pm_id` int(11) NOT NULL,
  PRIMARY KEY (`contenido_id`),
  KEY `pm_id` (`pm_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `contenidos`
--

INSERT INTO `contenidos` (`contenido_id`, `titulo`, `descripcion`, `material`, `pm_id`) VALUES
(15, 'Ejercicio de IMC', 'trabajo de refuerzo', '../../../uploads/3373/HV PAULA ANDREA E..pdf', 4),
(16, 'oscar', 'oscar', '../../../uploads/8742/HVOSCARECHEVERRY.pdf', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluaciones`
--

DROP TABLE IF EXISTS `evaluaciones`;
CREATE TABLE IF NOT EXISTS `evaluaciones` (
  `evaluacion_id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `porcentaje` varchar(100) NOT NULL,
  `contenido_id` int(11) NOT NULL,
  PRIMARY KEY (`evaluacion_id`),
  KEY `contenido_id` (`contenido_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `evaluaciones`
--

INSERT INTO `evaluaciones` (`evaluacion_id`, `titulo`, `descripcion`, `fecha`, `porcentaje`, `contenido_id`) VALUES
(24, 'Desarrollar un programa en java y mysql', 'IMC', '2023-02-17', '50%', 15),
(25, 'oscar', 'oscar', '2023-02-08', '10%', 16),
(26, 'oscar oscar', 'wfwefwfwef', '2023-02-17', '20%', 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ev_entregadas`
--

DROP TABLE IF EXISTS `ev_entregadas`;
CREATE TABLE IF NOT EXISTS `ev_entregadas` (
  `ev_entregada_id` int(11) NOT NULL AUTO_INCREMENT,
  `evaluacion_id` int(11) NOT NULL,
  `alumno_id` int(11) NOT NULL,
  `material_alumno` varchar(255) NOT NULL,
  `observacion` varchar(255) NOT NULL,
  PRIMARY KEY (`ev_entregada_id`),
  KEY `evaluacion_id` (`evaluacion_id`),
  KEY `alumno_id` (`alumno_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ev_entregadas`
--

INSERT INTO `ev_entregadas` (`ev_entregada_id`, `evaluacion_id`, `alumno_id`, `material_alumno`, `observacion`) VALUES
(5, 24, 3, '../../../uploads/7202/HOJA DE VIDA PAULA NUEVA.pdf', 'prueba de oscar 1'),
(6, 26, 3, '../../../uploads/6838/HVOSCARECHEVERRY.pdf', 'prueba de oscar 2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grados`
--

DROP TABLE IF EXISTS `grados`;
CREATE TABLE IF NOT EXISTS `grados` (
  `grado_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_grado` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`grado_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `grados`
--

INSERT INTO `grados` (`grado_id`, `nombre_grado`, `estado`) VALUES
(1, 'sexto 1', 1),
(2, 'sexto 2', 1),
(3, 'séptimo 1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

DROP TABLE IF EXISTS `materias`;
CREATE TABLE IF NOT EXISTS `materias` (
  `materia_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_materia` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`materia_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`materia_id`, `nombre_materia`, `estado`) VALUES
(1, 'Programación 1', 1),
(2, 'Programacion 2', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

DROP TABLE IF EXISTS `notas`;
CREATE TABLE IF NOT EXISTS `notas` (
  `nota_id` int(11) NOT NULL AUTO_INCREMENT,
  `ev_entregada_id` int(11) NOT NULL,
  `valor_nota` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`nota_id`),
  KEY `ev_entregada_id` (`ev_entregada_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `notas`
--

INSERT INTO `notas` (`nota_id`, `ev_entregada_id`, `valor_nota`, `fecha`) VALUES
(5, 5, 5, '2023-02-13 16:38:06'),
(6, 6, 5, '2023-02-13 16:38:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodos`
--

DROP TABLE IF EXISTS `periodos`;
CREATE TABLE IF NOT EXISTS `periodos` (
  `periodo_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_periodo` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`periodo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `periodos`
--

INSERT INTO `periodos` (`periodo_id`, `nombre_periodo`, `estado`) VALUES
(1, 'Corte 1', 1),
(2, 'Corte 2', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor`
--

DROP TABLE IF EXISTS `profesor`;
CREATE TABLE IF NOT EXISTS `profesor` (
  `profesor_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `telefono` bigint(20) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `nivel_est` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`profesor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `profesor`
--

INSERT INTO `profesor` (`profesor_id`, `nombre`, `direccion`, `cedula`, `clave`, `telefono`, `correo`, `nivel_est`, `estado`) VALUES
(1, 'eucaris gonzalez', 'diagonal 4B #15-24', '1112226560', '$2y$10$1xrWT0Lkr.EmyuZZh49FDuwJ7GrlOHgmczMHWZOI9Roj93JdQu5LC', 3146762269, 'eucaris@gmail.com', 'especialista', 1),
(4, 'magnolia giron', 'calle 32 # 3-22', '12345', '$2y$10$nOTpZsc50jy5F7I5XJiaN.ljU5TDSGBQ/zySCrDfnmXwGyZi4anVW', 3104455878, 'magnolia@gmail.com', 'profesional', 1),
(5, 'magnolia giron', 'calle 32 # 3-22', '12345', '$2y$10$QLJ6Nv35WXrVRvzyRImNZucftjsLtOsh7RdeSqw9YQHIFW4x4BA4K', 3104455878, 'magnolia@gmail.com', 'profesional', 0),
(6, 'gustavo echeverry', 'diagonal 4B # 15-24', '1112772230', '$2y$10$fbXtXgiIy72GcQZHqf40x.M8F1m1qAU/Irsem1LSiyAcs0Fn.hBz.', 123456, 'gustavo@gmail.com', 'profesional', 0),
(7, 'jaime garzon oviedo', 'calle 3', '7777', '$2y$10$wK3WWFf3NQIdIEuE.kZere2UUsedAuoAoEaaU6CDz0pmYYQvWmzkC', 12345, 'jaime@gmail.com', 'profesional', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor_materia`
--

DROP TABLE IF EXISTS `profesor_materia`;
CREATE TABLE IF NOT EXISTS `profesor_materia` (
  `pm_id` int(11) NOT NULL AUTO_INCREMENT,
  `grado_id` int(11) NOT NULL,
  `aula_id` int(11) NOT NULL,
  `profesor_id` int(11) NOT NULL,
  `materia_id` int(11) NOT NULL,
  `periodo_id` int(11) NOT NULL,
  `estadopm` int(11) NOT NULL,
  PRIMARY KEY (`pm_id`),
  KEY `grado_id` (`grado_id`),
  KEY `aula_id` (`aula_id`),
  KEY `materia_id` (`materia_id`),
  KEY `profesor_id` (`profesor_id`),
  KEY `periodo_id` (`periodo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `profesor_materia`
--

INSERT INTO `profesor_materia` (`pm_id`, `grado_id`, `aula_id`, `profesor_id`, `materia_id`, `periodo_id`, `estadopm`) VALUES
(1, 1, 1, 1, 1, 1, 0),
(2, 2, 2, 4, 2, 1, 0),
(3, 2, 1, 1, 2, 2, 0),
(4, 1, 1, 1, 1, 1, 1),
(5, 2, 2, 4, 2, 1, 1),
(6, 3, 1, 1, 2, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

DROP TABLE IF EXISTS `rol`;
CREATE TABLE IF NOT EXISTS `rol` (
  `rol_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_rol` varchar(100) NOT NULL,
  PRIMARY KEY (`rol_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`rol_id`, `nombre_rol`) VALUES
(1, 'Administrador'),
(2, 'Supervisor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `usuario_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `rol` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`usuario_id`),
  KEY `rol` (`rol`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario_id`, `nombre`, `usuario`, `clave`, `rol`, `estado`) VALUES
(1, 'Oscar Echeverry', 'admin', '$2y$10$5edpLBLfLAclfBWPkmCojuwTAoadNcFZJdWMzL1cIepuf2IlBTIFK', 1, 1),
(2, 'Jesus Mireles', 'jesus1', '$2y$10$o.qliwgI77UCccFqIsNXue3yknnffdhTAIGs74VL/XxoZvosVI4Ga', 2, 1),
(3, 'Andres', 'andres1', '$2y$10$KehjeRb5h2wBhjbf7gx8mOFiKU9UIrnSP1nNzFFVkJKyaY0DiwWxy', 1, 1),
(4, 'Andres Bolaños', 'andres', '$2y$10$BYQMT3NePsJl3pIOdh5j2.jtOxuJ9N92yBz71Scs6rfsjU83ZTtyu', 2, 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumno_profesor`
--
ALTER TABLE `alumno_profesor`
  ADD CONSTRAINT `alumno_profesor_ibfk_1` FOREIGN KEY (`alumno_id`) REFERENCES `alumnos` (`alumno_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `alumno_profesor_ibfk_2` FOREIGN KEY (`pm_id`) REFERENCES `profesor_materia` (`pm_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `alumno_profesor_ibfk_3` FOREIGN KEY (`periodo_id`) REFERENCES `periodos` (`periodo_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `contenidos`
--
ALTER TABLE `contenidos`
  ADD CONSTRAINT `contenidos_ibfk_1` FOREIGN KEY (`pm_id`) REFERENCES `profesor_materia` (`pm_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `evaluaciones`
--
ALTER TABLE `evaluaciones`
  ADD CONSTRAINT `evaluaciones_ibfk_3` FOREIGN KEY (`contenido_id`) REFERENCES `contenidos` (`contenido_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ev_entregadas`
--
ALTER TABLE `ev_entregadas`
  ADD CONSTRAINT `ev_entregadas_ibfk_1` FOREIGN KEY (`evaluacion_id`) REFERENCES `evaluaciones` (`evaluacion_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ev_entregadas_ibfk_2` FOREIGN KEY (`alumno_id`) REFERENCES `alumnos` (`alumno_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `notas`
--
ALTER TABLE `notas`
  ADD CONSTRAINT `notas_ibfk_1` FOREIGN KEY (`ev_entregada_id`) REFERENCES `ev_entregadas` (`ev_entregada_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `profesor_materia`
--
ALTER TABLE `profesor_materia`
  ADD CONSTRAINT `profesor_materia_ibfk_1` FOREIGN KEY (`profesor_id`) REFERENCES `profesor` (`profesor_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `profesor_materia_ibfk_2` FOREIGN KEY (`grado_id`) REFERENCES `grados` (`grado_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `profesor_materia_ibfk_3` FOREIGN KEY (`aula_id`) REFERENCES `aulas` (`aula_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `profesor_materia_ibfk_4` FOREIGN KEY (`materia_id`) REFERENCES `materias` (`materia_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `profesor_materia_ibfk_5` FOREIGN KEY (`periodo_id`) REFERENCES `periodos` (`periodo_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `rol` (`rol_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
