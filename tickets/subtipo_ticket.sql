/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : teledata

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-05-28 21:50:47
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for subtipo_ticket
-- ----------------------------
DROP TABLE IF EXISTS `subtipo_ticket`;
CREATE TABLE `subtipo_ticket` (
  `IdSubTipoTicket` int(11) NOT NULL AUTO_INCREMENT,
  `IdTipoTicket` int(11) DEFAULT NULL,
  `Nombre` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`IdSubTipoTicket`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
