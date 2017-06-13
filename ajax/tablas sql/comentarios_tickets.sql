/*
Navicat MySQL Data Transfer

Source Server         : Mi Computadora
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : teledata

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-06-02 10:33:12
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for comentarios_tickets
-- ----------------------------
DROP TABLE IF EXISTS `comentarios_tickets`;
CREATE TABLE `comentarios_tickets` (
  `IdComentarioTicket` int(11) NOT NULL AUTO_INCREMENT,
  `IdTickets` int(11) DEFAULT NULL,
  `Comentario` varchar(150) DEFAULT NULL,
  `IdUSuario` varchar(150) DEFAULT NULL,
  `Fecha` datetime DEFAULT NULL,
  PRIMARY KEY (`IdComentarioTicket`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
