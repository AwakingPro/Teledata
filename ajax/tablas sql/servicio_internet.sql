/*
Navicat MySQL Data Transfer

Source Server         : Mi Computadora
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : teledata

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-06-13 11:13:02
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for servicio_internet
-- ----------------------------
DROP TABLE IF EXISTS `servicio_internet`;
CREATE TABLE `servicio_internet` (
  `IdServInternet` int(11) NOT NULL AUTO_INCREMENT,
  `Estacion/Nodo` varchar(150) DEFAULT NULL,
  `MacRouter` varchar(150) DEFAULT NULL,
  `MacAntena` varchar(150) DEFAULT NULL,
  `IPRouter` varchar(150) DEFAULT NULL,
  `IPAntena` varchar(150) DEFAULT NULL,
  `FechaInstalacion` date DEFAULT NULL,
  `TecnicoInstalador` varchar(150) DEFAULT NULL,
  `Velocidad` varchar(150) DEFAULT NULL,
  `Plan` varchar(150) DEFAULT NULL,
  `EstadoServicio` varchar(150) DEFAULT NULL,
  `SeñalInstalacion` varchar(150) DEFAULT NULL,
  `SeñalActual` varchar(150) DEFAULT NULL,
  `DireccionIPAP` varchar(150) DEFAULT NULL,
  `CoordenadasLatitud` varchar(150) DEFAULT NULL,
  `CoordenadasLongitud` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`IdServInternet`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of servicio_internet
-- ----------------------------
