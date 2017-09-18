/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : teledata

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-09-18 00:23:30
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for log_query
-- ----------------------------
DROP TABLE IF EXISTS `log_query`;
CREATE TABLE `log_query` (
  `IdLogSql` int(11) NOT NULL AUTO_INCREMENT,
  `IdUsuario` int(11) DEFAULT NULL,
  `Fecha` datetime DEFAULT NULL,
  `Query` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`IdLogSql`)
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=latin1;
