/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : teledata

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-05-27 12:35:47
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tipo_ticket
-- ----------------------------
DROP TABLE IF EXISTS `tipo_ticket`;
CREATE TABLE `tipo_ticket` (
  `IdTipoTicket` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`IdTipoTicket`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tipo_ticket
-- ----------------------------
