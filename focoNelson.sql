-- --------------------------------------------------------
-- Host:                         localhost
-- Versión del servidor:         5.7.13-log - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura de base de datos para foco
CREATE DATABASE IF NOT EXISTS `foco` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `foco`;


-- Volcando estructura para tabla foco.deuda
CREATE TABLE IF NOT EXISTS `deuda` (
  `Id_deuda` int(11) NOT NULL AUTO_INCREMENT,
  `Rut` int(11) DEFAULT NULL,
  `Tipo_Deudor` varchar(255) DEFAULT NULL,
  `Producto` varchar(255) DEFAULT NULL,
  `Numero_Operacion` varchar(255) DEFAULT NULL,
  `Id_Moneda` int(11) DEFAULT NULL,
  `Tramo_Morosidad` varchar(255) DEFAULT NULL,
  `Fecha_Vencimiento` date DEFAULT NULL,
  `Monto_Mora` int(11) DEFAULT NULL,
  `Saldo_Insoluto` int(11) DEFAULT NULL,
  `Dias_Mora` int(11) DEFAULT NULL,
  `Ejecutivo_Cuenta` varchar(255) DEFAULT NULL,
  `Monto_Total_Intereses` int(11) DEFAULT NULL,
  `Fecha_Ingreso` date DEFAULT NULL,
  `sucursal` varchar(255) DEFAULT NULL,
  `Mes_Cobro` int(10) DEFAULT NULL,
  `Ano_Cobro` int(10) DEFAULT NULL,
  `Id_Cedente` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_deuda`),
  UNIQUE KEY `Unicidad` (`Rut`,`Numero_Operacion`,`Mes_Cobro`,`Ano_Cobro`,`Id_Cedente`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla foco.direcciones
CREATE TABLE IF NOT EXISTS `direcciones` (
  `Id_Direccion` int(11) NOT NULL AUTO_INCREMENT,
  `Rut` int(11) DEFAULT NULL,
  `Direccion` varchar(255) DEFAULT NULL,
  `Complemento_Direccion` varchar(255) DEFAULT NULL,
  `Codigo_postal` varchar(255) DEFAULT NULL,
  `Id_Comuna` int(11) DEFAULT NULL,
  `Id_Provincia` int(11) DEFAULT NULL,
  `Id_Region` int(11) DEFAULT NULL,
  `Id_Tipo_Demografico` int(11) DEFAULT NULL,
  `Fecha_Ingreso` date DEFAULT NULL,
  PRIMARY KEY (`Id_Direccion`),
  UNIQUE KEY `Unicidad` (`Rut`,`Direccion`,`Id_Comuna`,`Id_Provincia`,`Id_Region`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla foco.fono
CREATE TABLE IF NOT EXISTS `fono` (
  `Id_Fono` int(11) NOT NULL AUTO_INCREMENT,
  `Rut` int(11) DEFAULT NULL,
  `Codigo_Area` int(11) DEFAULT NULL,
  `Numero_Telefono` int(11) DEFAULT NULL,
  `Score` float DEFAULT NULL,
  `Id_Tipo_Demografico` int(11) DEFAULT NULL,
  `Tipo_Telefono` varchar(255) DEFAULT NULL,
  `Origen` varchar(255) DEFAULT NULL,
  `Fecha_Ingreso` date DEFAULT NULL,
  `Ult_Gestion` varchar(100) DEFAULT NULL,
  `Fecha_Ult_Gestion` date DEFAULT NULL,
  `Mejor_Gestion` varchar(100) DEFAULT NULL,
  `Fecha_Mej_Gestion` date DEFAULT NULL,
  `Cantidad_Gestiones` int(11) DEFAULT NULL,
  `Cant_Gest_Titular` int(11) DEFAULT NULL,
  `Cant_Gest_Tercero` int(11) DEFAULT NULL,
  `Cant_Gest_SinContacto` int(11) DEFAULT NULL,
  `Prioridad` int(11) DEFAULT NULL,
  `Color` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Id_Fono`),
  UNIQUE KEY `Unicidad` (`Rut`,`Numero_Telefono`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla foco.informacion_cmr
CREATE TABLE IF NOT EXISTS `informacion_cmr` (
  `id_registro` int(11) NOT NULL AUTO_INCREMENT,
  `dmacctg` varchar(50) NOT NULL DEFAULT '0',
  `dmbname` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_registro`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla foco.mail_old
CREATE TABLE IF NOT EXISTS `mail_old` (
  `id_mail` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `correo_electronico` varchar(100) DEFAULT NULL,
  `vigente` int(10) unsigned DEFAULT NULL COMMENT '1=si; 2=no',
  `rut` int(11) NOT NULL,
  `id_cliente` int(10) unsigned DEFAULT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  `Origen` text NOT NULL,
  PRIMARY KEY (`id_mail`),
  UNIQUE KEY `idx_mails` (`correo_electronico`,`rut`) USING BTREE,
  KEY `rut` (`rut`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla foco.persona
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
  PRIMARY KEY (`id_persona`),
  UNIQUE KEY `idx_rut` (`Rut`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
