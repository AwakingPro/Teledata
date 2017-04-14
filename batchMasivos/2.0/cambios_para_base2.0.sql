-- AHORA TIENE RUT
CREATE TABLE IF NOT EXISTS `informacion_cmr` (
  `id_registro` int(11) NOT NULL AUTO_INCREMENT,
  `dmacctg` varchar(50) NOT NULL DEFAULT '0',
  `dmbname` varchar(50) NOT NULL DEFAULT '0',
  `rut` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_registro`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- AHORA TIENE EDAD
CREATE TABLE IF NOT EXISTS `persona` (
  `Rut` int(11) NOT NULL,
  `Digito_Verificador` varchar(1) DEFAULT NULL,
  `Nombres` varchar(255) DEFAULT NULL,
  `Apellido_Paterno` varchar(255) DEFAULT NULL,
  `Apellido_Materno` varchar(255) DEFAULT NULL,
  `Nombre_Completo` varchar(255) DEFAULT NULL,
  `Sexo` varchar(255) DEFAULT NULL,
  `Fecha_Nacimiento` date DEFAULT NULL,
  `Fecha_Ingreso` date DEFAULT NULL,
  `id_persona` int(255) NOT NULL AUTO_INCREMENT,
  `edad` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_persona`),
  UNIQUE KEY `idx_rut` (`Rut`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--NUEVAS TABLAS--
-- Volcando estructura para tabla foco.estadisticascargas
CREATE TABLE IF NOT EXISTS `estadisticascargas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `montoTotal` int(11) DEFAULT NULL,
  `totalConFono` int(11) DEFAULT NULL,
  `totalSinFono` int(11) DEFAULT NULL,
  `totalConMail` int(11) DEFAULT NULL,
  `totalSinMail` int(11) DEFAULT NULL,
  `personasConocidas` int(11) DEFAULT NULL,
  `personasNoConocidas` int(11) DEFAULT NULL,
  `Fecha_Ingreso` date DEFAULT NULL,
  `xxxxx` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Volcando estructura para tabla foco.personaexistentes
CREATE TABLE IF NOT EXISTS `personaexistentes` (
  `Rut` int(11) NOT NULL,
  `Digito_Verificador` varchar(1) DEFAULT NULL,
  `Nombres` varchar(255) DEFAULT NULL,
  `Apellido_Paterno` varchar(255) DEFAULT NULL,
  `Apellido_Materno` varchar(255) DEFAULT NULL,
  `Nombre_Completo` varchar(255) DEFAULT NULL,
  `Sexo` varchar(255) DEFAULT NULL,
  `Fecha_Nacimiento` date DEFAULT NULL,
  `Fecha_Ingreso` date DEFAULT NULL,
  `id_persona` int(255) NOT NULL AUTO_INCREMENT,
  `edad` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_persona`),
  UNIQUE KEY `idx_rut` (`Rut`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;