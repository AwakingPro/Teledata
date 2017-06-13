/*
Navicat MySQL Data Transfer

Source Server         : Mi Computadora
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : teledata

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-06-13 11:12:49
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for mensualidad_direccion_ip_fija
-- ----------------------------
DROP TABLE IF EXISTS `mensualidad_direccion_ip_fija`;
CREATE TABLE `mensualidad_direccion_ip_fija` (
  `IdMensualidadDireccionIPFija` int(11) NOT NULL AUTO_INCREMENT,
  `DireccionIPFija` varchar(15) DEFAULT NULL,
  `Descripcion` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`IdMensualidadDireccionIPFija`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of mensualidad_direccion_ip_fija
-- ----------------------------
