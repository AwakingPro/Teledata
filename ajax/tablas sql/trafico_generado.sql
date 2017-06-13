/*
Navicat MySQL Data Transfer

Source Server         : Mi Computadora
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : teledata

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-06-13 11:13:08
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for trafico_generado
-- ----------------------------
DROP TABLE IF EXISTS `trafico_generado`;
CREATE TABLE `trafico_generado` (
  `IdTraficoGenerado` int(11) NOT NULL AUTO_INCREMENT,
  `LineaTelefonica` varchar(100) DEFAULT NULL,
  `Descripcion` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`IdTraficoGenerado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of trafico_generado
-- ----------------------------
