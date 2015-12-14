-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-12-2015 a las 21:50:55
-- Versión del servidor: 5.5.36
-- Versión de PHP: 5.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `seldb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `talumnos`
--

CREATE TABLE IF NOT EXISTS `talumnos` (
  `idalumno` smallint(11) NOT NULL AUTO_INCREMENT,
  `numcontrol` varchar(8) NOT NULL DEFAULT '0',
  `nombre` varchar(60) NOT NULL DEFAULT '',
  `idgrupo` int(4) NOT NULL DEFAULT '0',
  `observaciones` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`idalumno`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `talumnos`
--

INSERT INTO `talumnos` (`idalumno`, `numcontrol`, `nombre`, `idgrupo`, `observaciones`) VALUES
(1, 'demo', 'Alumno de Test', 1, ''),
(2, '02', 'Juan Perez', 0, ''),
(16, '03', 'andres v.', 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tans1`
--

CREATE TABLE IF NOT EXISTS `tans1` (
  `idtest` int(11) NOT NULL AUTO_INCREMENT,
  `idexamen` int(11) NOT NULL DEFAULT '0',
  `idalumno` int(11) NOT NULL DEFAULT '0',
  `fechahora` datetime DEFAULT NULL,
  `idsesion` varchar(20) NOT NULL DEFAULT '',
  `a0` tinyint(4) NOT NULL DEFAULT '0',
  `a1` tinyint(4) NOT NULL DEFAULT '0',
  `a2` tinyint(4) NOT NULL DEFAULT '0',
  `a3` tinyint(4) NOT NULL DEFAULT '0',
  `a4` tinyint(4) NOT NULL DEFAULT '0',
  `a5` tinyint(4) NOT NULL DEFAULT '0',
  `a6` tinyint(4) NOT NULL DEFAULT '0',
  `a7` tinyint(4) NOT NULL DEFAULT '0',
  `a8` tinyint(4) NOT NULL DEFAULT '0',
  `a9` tinyint(4) NOT NULL DEFAULT '0',
  `a10` tinyint(4) NOT NULL DEFAULT '0',
  `a11` tinyint(4) NOT NULL DEFAULT '0',
  `a12` tinyint(4) NOT NULL DEFAULT '0',
  `a13` tinyint(4) NOT NULL DEFAULT '0',
  `a14` tinyint(4) NOT NULL DEFAULT '0',
  `a15` tinyint(4) NOT NULL DEFAULT '0',
  `a16` tinyint(4) NOT NULL DEFAULT '0',
  `a17` tinyint(4) NOT NULL DEFAULT '0',
  `a18` tinyint(4) NOT NULL DEFAULT '0',
  `a19` tinyint(4) NOT NULL DEFAULT '0',
  `aciertos` int(11) NOT NULL DEFAULT '0',
  `contestadas` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idtest`),
  UNIQUE KEY `UC_testid` (`idtest`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Volcado de datos para la tabla `tans1`
--

INSERT INTO `tans1` (`idtest`, `idexamen`, `idalumno`, `fechahora`, `idsesion`, `a0`, `a1`, `a2`, `a3`, `a4`, `a5`, `a6`, `a7`, `a8`, `a9`, `a10`, `a11`, `a12`, `a13`, `a14`, `a15`, `a16`, `a17`, `a18`, `a19`, `aciertos`, `contestadas`) VALUES
(24, 3, 1, '2011-01-12 06:35:00', '18003', 3, 2, 1, 2, 3, 4, 2, 1, 3, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 9, 10),
(25, 3, 16, '2011-01-12 07:51:00', '9608', 2, 2, 3, 3, 3, 3, 2, 1, 4, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 6, 10),
(26, 5, 2, '2012-06-25 12:03:00', '24382', 3, 4, 2, 2, 4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbancopreguntas`
--

CREATE TABLE IF NOT EXISTS `tbancopreguntas` (
  `idpregunta` int(11) NOT NULL AUTO_INCREMENT,
  `idmateria` int(11) NOT NULL DEFAULT '0',
  `unidad` tinyint(4) NOT NULL,
  `pregunta` varchar(255) NOT NULL DEFAULT '',
  `opcion1` varchar(100) DEFAULT NULL,
  `opcion2` varchar(100) DEFAULT NULL,
  `opcion3` varchar(100) DEFAULT NULL,
  `opcion4` varchar(100) DEFAULT NULL,
  `respuesta` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`idpregunta`),
  UNIQUE KEY `UC_questionid` (`idpregunta`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Volcado de datos para la tabla `tbancopreguntas`
--

INSERT INTO `tbancopreguntas` (`idpregunta`, `idmateria`, `unidad`, `pregunta`, `opcion1`, `opcion2`, `opcion3`, `opcion4`, `respuesta`) VALUES
(1, 1, 1, 'Proporcionan rápidos tiempos de respuesta', 'Sistemas Operativos Paralelos', 'Sistemas Operativos Por Lotes', 'Sistemas Operativos De Tiempo Real', 'Sistemas Operativos de Red', 3),
(2, 1, 1, 'Elige el próximo proceso a ejecutarse por el procesador', 'Característica de un Sistema Operativo', 'Scheduler', 'Administrador de E/S', 'Administrador de Memoria', 2),
(3, 1, 1, 'Su propósito es proporcionar el entorno adecuado en el cual el usuario pueda ejecutar sus programas.', 'Sistema Operativo', 'Kernel', 'Estratos de diseño', '2da. Generación', 1),
(4, 1, 1, 'Atiende de manera concurrente varios procesos de un mismo usuario', 'Sistemas Operativos de Tiempo Real', 'Sistemas Operativos Paralelos', 'Sistemas Operativos Por Lotes', 'Sistemas Operativos Distribuidos', 2),
(5, 1, 1, 'Mayor potencial de utilización de recursos en sistemas multiusuarios', 'Sistemas Operativos Paralelos', 'Sistemas Operativos De Red', 'Sistemas Operativos Por Lotes', 'Sistemas Operativos De Tiempo Real', 3),
(6, 1, 1, 'Indican a la CPU el cambio de estado de un canal o dispositivo', 'Despachador', 'Kernel o Núcleo', 'Administrador de E/S', 'Interrupciones', 4),
(7, 1, 1, 'Habilidad para evolucionar, conveniencia, eficiencia, facilitar la E/S', 'Propiedades del Kernel', 'Características de los Sistemas Operativos', 'Fuciones del Scheduler', 'Características de las Interrupciones', 2),
(8, 1, 1, 'Examinar la prioridad de los procesos', 'Función del Despachador', 'Característica del Núcleo', 'Tarea del Administrador de Procesos', 'Característica de Linux', 1),
(9, 1, 1, 'Década en que se manejaron por primera vez los Sistemas por Lotes', '90''s', '80''s', '70''s', '60''s', 4),
(10, 1, 1, 'Utiliza un algoritmo de reparto circular', 'Sistemas Operativos Distribuidos', 'Sistemas Operativos Por Lotes', 'Sistemas Operativos de Tiempo Compartido', 'Sistemas Operativos de Red', 3),
(15, 1, 2, 'test 2', 'resp1', 'resp2', 'resp3', 'resp4', 2),
(16, 1, 2, 'Módulo del S.O. que pone en ejecución el proceso planificado', 'Planificador', 'Procesos concurrentes', 'Estados del proceso', 'DeadLock', 1),
(17, 1, 2, 'Son internos del S.O. y transparentes al usuario, activos o inactivos', 'Beneficios de la concurrencia', 'Criterios de planificación', 'Beneficios del uso de Colas Multinivel', 'Procesos', 4),
(18, 1, 2, 'Una señal enviada desde un dispositivo de hardware', 'Componentes fundamentales de los procesos', 'deadlock', 'estados del proceso', 'Procesos', 3),
(19, 1, 5, 'Conjunto de circunferencias concéntricas grabadas en un disco compuesta de sectores.', 'Cilindro', 'Sector', 'Pista', 'Partición', 3),
(20, 1, 5, 'Sistema de archivos de 16 bits', 'FAT32', 'NTFS', 'EXT2', 'FAT o FAT16', 4),
(21, 1, 5, 'Reordenan la cola del disco a modo de reducir el tiempo de búsqueda total.', 'tabla de asingacion de archivos', 'algoritmos de planificación', 'latencia rotacional', 'ancho de banda', 2),
(22, 1, 5, 'Selecciona la solicitud que tiene el menor tiempo de búsqueda a partir de la posición actual de la cabeza.', 'Pista', 'Sector', 'SCAN', 'SSTF', 0),
(23, 1, 5, 'Algoritmo elevador', 'SCAN', 'Latencia', 'Ancho de banda', 'Algoritmo de búsqueda', 1),
(24, 1, 5, 'Acceder a datos generados dinámicamente', 'Función del planificador', 'Característica de la E/S', 'Búsqueda y Latencia', 'Función del sistema de archivos', 4),
(25, 1, 5, 'Soporte para cuotas de disco, archivos dispersos, evitar la fragmentación', 'Algoritmos de planificación', 'Tabla de asignación de archivos', 'Características de los sistemas de archivos', 'Sistemas de Archivos', 3),
(26, 1, 5, 'Ubicación precisa de un archivo con una cadena de texto', 'Partición', 'Ruta', 'URL', 'Pista', 2),
(27, 1, 5, 'archivos de propósito especial, de red, de disco...', 'Algoritmos de planificación', 'Funciones del Sector', 'Sistemas de Archivos', 'Funciones del sistema de archivos', 3),
(28, 1, 5, 'Tiempo adicional para que el disco gire hasta ubicar la cabeza sobre el sector deseado', 'Latencia rotacional', 'Tiempo de búsqueda', 'C-SCAN', 'Algoritmo de búsqueda', 1),
(29, 2, 1, 'de que color era el caballo blanco de napoleon', 'negro', 'azul', 'cafe', 'blanco', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tcarreras`
--

CREATE TABLE IF NOT EXISTS `tcarreras` (
  `idcarrera` int(5) NOT NULL AUTO_INCREMENT,
  `carrera` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`idcarrera`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `tcarreras`
--

INSERT INTO `tcarreras` (`idcarrera`, `carrera`) VALUES
(1, 'Licenciatura en Inform&aacute;tica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `texamenes`
--

CREATE TABLE IF NOT EXISTS `texamenes` (
  `idexamen` int(11) NOT NULL AUTO_INCREMENT,
  `totalpreg` smallint(6) NOT NULL,
  `claveexamen` varchar(8) NOT NULL DEFAULT '0',
  `fecha` date DEFAULT NULL,
  `idusuario` int(4) DEFAULT NULL,
  `idmateria` int(11) NOT NULL DEFAULT '0',
  `q0` int(11) NOT NULL DEFAULT '0',
  `q1` int(11) NOT NULL DEFAULT '0',
  `q2` int(11) NOT NULL DEFAULT '0',
  `q3` int(11) NOT NULL DEFAULT '0',
  `q4` int(11) NOT NULL DEFAULT '0',
  `q5` int(11) NOT NULL DEFAULT '0',
  `q6` int(11) NOT NULL DEFAULT '0',
  `q7` int(11) NOT NULL DEFAULT '0',
  `q8` int(11) NOT NULL DEFAULT '0',
  `q9` int(11) NOT NULL DEFAULT '0',
  `q10` int(11) NOT NULL DEFAULT '0',
  `q11` int(11) NOT NULL DEFAULT '0',
  `q12` int(11) NOT NULL DEFAULT '0',
  `q13` int(11) NOT NULL DEFAULT '0',
  `q14` int(11) NOT NULL DEFAULT '0',
  `q15` int(11) NOT NULL DEFAULT '0',
  `q16` int(11) NOT NULL DEFAULT '0',
  `q17` int(11) NOT NULL DEFAULT '0',
  `q18` int(11) NOT NULL DEFAULT '0',
  `q19` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idexamen`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `texamenes`
--

INSERT INTO `texamenes` (`idexamen`, `totalpreg`, `claveexamen`, `fecha`, `idusuario`, `idmateria`, `q0`, `q1`, `q2`, `q3`, `q4`, `q5`, `q6`, `q7`, `q8`, `q9`, `q10`, `q11`, `q12`, `q13`, `q14`, `q15`, `q16`, `q17`, `q18`, `q19`) VALUES
(3, 10, 'demo', '2010-08-01', 1, 1, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(4, 4, 'unidad2', '2010-10-01', 1, 1, 15, 16, 17, 14, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5, 10, 'unidad5', '2010-01-12', 1, 1, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tgrupos`
--

CREATE TABLE IF NOT EXISTS `tgrupos` (
  `idgrupo` int(11) NOT NULL AUTO_INCREMENT,
  `grupo` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`idgrupo`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tgrupos`
--

INSERT INTO `tgrupos` (`idgrupo`, `grupo`) VALUES
(1, '1er. Grado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tmaterias`
--

CREATE TABLE IF NOT EXISTS `tmaterias` (
  `idmateria` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` char(35) NOT NULL DEFAULT '',
  `unidades` int(11) NOT NULL,
  PRIMARY KEY (`idmateria`),
  UNIQUE KEY `UC_subjectid` (`idmateria`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `tmaterias`
--

INSERT INTO `tmaterias` (`idmateria`, `nombre`, `unidades`) VALUES
(1, 'Sistemas Operativos', 6),
(2, 'Lenguaje Ensamblador', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tmateriasalumnos`
--

CREATE TABLE IF NOT EXISTS `tmateriasalumnos` (
  `idalumno` int(11) NOT NULL DEFAULT '0',
  `idmateria` int(11) NOT NULL DEFAULT '0',
  `estatus` char(1) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tusuarios`
--

CREATE TABLE IF NOT EXISTS `tusuarios` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` char(20) NOT NULL DEFAULT '',
  `passwd` char(64) NOT NULL,
  `cargo` char(35) NOT NULL DEFAULT '',
  PRIMARY KEY (`idusuario`),
  UNIQUE KEY `UC_adminid` (`idusuario`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `tusuarios`
--

INSERT INTO `tusuarios` (`idusuario`, `nombre`, `passwd`, `cargo`) VALUES
(1, 'admin', 'ee10c315eba2c75b403ea99136f5b48d', 'catedratico');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
