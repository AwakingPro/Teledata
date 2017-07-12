/*
Navicat MySQL Data Transfer

Source Server         : Mi Computadora
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : teledata

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-07-11 21:24:43
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for mantenedor_servicios
-- ----------------------------
DROP TABLE IF EXISTS `mantenedor_servicios`;
CREATE TABLE `mantenedor_servicios` (
  `IdServicio` int(11) NOT NULL AUTO_INCREMENT,
  `servicio` varchar(200) NOT NULL,
  PRIMARY KEY (`IdServicio`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of mantenedor_servicios
-- ----------------------------
INSERT INTO `mantenedor_servicios` VALUES ('1', 'Arriendo de Equipos');
INSERT INTO `mantenedor_servicios` VALUES ('2', 'Mantenimeinto de RED');
INSERT INTO `mantenedor_servicios` VALUES ('3', 'Mensualidad IP Fija');
INSERT INTO `mantenedor_servicios` VALUES ('4', 'Mensulaidad Puerto Publico');
INSERT INTO `mantenedor_servicios` VALUES ('5', 'Servicio Internet');
INSERT INTO `mantenedor_servicios` VALUES ('6', 'Trafico Generado');
