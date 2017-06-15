/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : teledata

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-06-15 19:23:20
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for mensualidad_puerdo_publicos
-- ----------------------------
DROP TABLE IF EXISTS `mensualidad_puerdo_publicos`;
CREATE TABLE `mensualidad_puerdo_publicos` (
  `IdMensualidadPuertosPublicos` int(11) NOT NULL AUTO_INCREMENT,
  `PuertoTCP/UDP` varchar(100) DEFAULT NULL,
  `Descripcion` varchar(100) DEFAULT NULL,
  `IdServivio` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdMensualidadPuertosPublicos`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of mensualidad_puerdo_publicos
-- ----------------------------
