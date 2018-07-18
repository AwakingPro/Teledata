/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : teledata

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-06-15 20:12:26
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for mensualidad_puertos_publicos
-- ----------------------------
DROP TABLE IF EXISTS `mensualidad_puertos_publicos`;
CREATE TABLE `mensualidad_puertos_publicos` (
  `IdMensualidadPuertosPublicos` int(11) NOT NULL AUTO_INCREMENT,
  `PuertoTCPUDP` varchar(100) DEFAULT NULL,
  `Descripcion` varchar(100) DEFAULT NULL,
  `IdServicio` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdMensualidadPuertosPublicos`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
