/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : teledata

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-05-26 18:13:38
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for nivel_privilegio
-- ----------------------------
DROP TABLE IF EXISTS `nivel_privilegio`;
CREATE TABLE `nivel_privilegio` (
  `IdNivelPrivilegio` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(150) DEFAULT NULL,
  `Descripcion` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`IdNivelPrivilegio`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of nivel_privilegio
-- ----------------------------
INSERT INTO `nivel_privilegio` VALUES ('1', 'Administrador', 'Descripcion de Administrador');
INSERT INTO `nivel_privilegio` VALUES ('2', 'Soporte', 'Descripcion de Soporte');
INSERT INTO `nivel_privilegio` VALUES ('3', 'Terreno', 'Descripcion de Terreno');
