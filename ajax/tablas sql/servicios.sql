/*
Navicat MySQL Data Transfer

Source Server         : Mi Computadora
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : teledata

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-06-22 03:02:13
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for servicios
-- ----------------------------
DROP TABLE IF EXISTS `servicios`;
CREATE TABLE `servicios` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Rut` int(11) NOT NULL,
  `Grupo` int(11) DEFAULT NULL,
  `TipoFactura` varchar(150) DEFAULT NULL,
  `Valor` double(11,2) DEFAULT NULL,
  `Descuento` double(11,2) DEFAULT NULL,
  `IdServicio` int(11) NOT NULL,
  `TiepoFacturacion` varchar(150) DEFAULT NULL,
  `Codigo` varchar(150) CHARACTER SET latin1 NOT NULL,
  `Descripcion` varchar(500) NOT NULL,
  `TipoMoneda` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;
