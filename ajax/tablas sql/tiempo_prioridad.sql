/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : teledata

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-05-14 00:11:21
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tiempo_prioridad
-- ----------------------------
DROP TABLE IF EXISTS `tiempo_prioridad`;
CREATE TABLE `tiempo_prioridad` (
  `IdTiempoPrioridad` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) DEFAULT NULL,
  `TiempoHora` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`IdTiempoPrioridad`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tiempo_prioridad
-- ----------------------------
INSERT INTO `tiempo_prioridad` VALUES ('1', 'Alta', '24');
INSERT INTO `tiempo_prioridad` VALUES ('2', 'Alta', '24');
