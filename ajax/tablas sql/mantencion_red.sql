/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : teledata

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-06-15 19:23:00
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for mantencion_red
-- ----------------------------
DROP TABLE IF EXISTS `mantencion_red`;
CREATE TABLE `mantencion_red` (
  `IdMantencionRed` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(300) DEFAULT NULL,
  `ComentarioDatosAdicionales` varchar(300) DEFAULT NULL,
  `IdServivio` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdMantencionRed`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of mantencion_red
-- ----------------------------
