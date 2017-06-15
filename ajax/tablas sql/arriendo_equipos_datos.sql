/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : teledata

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-06-15 19:22:52
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for arriendo_equipos_datos
-- ----------------------------
DROP TABLE IF EXISTS `arriendo_equipos_datos`;
CREATE TABLE `arriendo_equipos_datos` (
  `IdArriendoEquiposDatos` int(11) NOT NULL AUTO_INCREMENT,
  `TipoEquipo` varchar(150) DEFAULT NULL,
  `Modelo` varchar(150) DEFAULT NULL,
  `Mac/SN` varchar(150) DEFAULT NULL,
  `Descripcion` varchar(500) DEFAULT NULL,
  `IdServivio` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdArriendoEquiposDatos`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of arriendo_equipos_datos
-- ----------------------------
