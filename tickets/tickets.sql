/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : teledata

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-05-09 22:06:23
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tickets
-- ----------------------------
DROP TABLE IF EXISTS `tickets`;
CREATE TABLE `tickets` (
  `IdTickets` int(11) NOT NULL AUTO_INCREMENT,
  `IdCliente` int(11) DEFAULT NULL,
  `Origen` varchar(100) DEFAULT NULL,
  `Departamento` varchar(100) DEFAULT NULL,
  `Tipo` varchar(100) DEFAULT NULL,
  `Subtipo` varchar(100) DEFAULT NULL,
  `Prioridad` varchar(100) DEFAULT NULL,
  `AsignarA` varchar(100) DEFAULT NULL,
  `Estado` varchar(100) DEFAULT NULL,
  `FechaCreasion` date DEFAULT NULL,
  PRIMARY KEY (`IdTickets`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;
