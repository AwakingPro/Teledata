/*
Navicat MySQL Data Transfer

Source Server         : Mi Computadora
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : teledata

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-06-05 15:59:29
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
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of servicios
-- ----------------------------
INSERT INTO `servicios` VALUES ('1', '15434708', null, null, null, null, '1', null, '15434708-9FSMI201', '2');
INSERT INTO `servicios` VALUES ('2', '15434708', null, null, null, null, '3', null, '15434708-9FSMI202', '2');
INSERT INTO `servicios` VALUES ('3', '15434708', null, null, null, null, '9', null, '15434708-9T01', '4');
INSERT INTO `servicios` VALUES ('4', '15434708', null, null, null, null, '3', null, '15434708-9FSMI203', '2');
INSERT INTO `servicios` VALUES ('5', '12381732', null, null, null, null, '1', null, '12381732-KFSMI201', '2');
INSERT INTO `servicios` VALUES ('6', '12381732', null, null, null, null, '3', null, '12381732-KFSMI202', '2');
INSERT INTO `servicios` VALUES ('7', '78337120', null, null, null, null, '2', null, '78337120-0FSMI201', '2');
INSERT INTO `servicios` VALUES ('8', '78337120', null, null, null, null, '1', null, '78337120-0FSMIOC01', '3');
INSERT INTO `servicios` VALUES ('9', '15434708', null, null, null, null, '8', null, '15434708-9FSMI204', '2');
INSERT INTO `servicios` VALUES ('10', '15434708', null, null, null, null, '0', null, '15434708-901', '0');
INSERT INTO `servicios` VALUES ('11', '15434707', null, null, null, null, '1', null, '15434707-1FSMI201', '2');
INSERT INTO `servicios` VALUES ('12', '15434707', null, null, null, null, '8', null, '15434707-1FSMI202', '2');
INSERT INTO `servicios` VALUES ('13', '87897', null, null, null, null, '3', null, '87897-1FSMI201', '2');
INSERT INTO `servicios` VALUES ('14', '76154671', null, null, null, null, '1', null, '76154671-6FSMI201', '2');
INSERT INTO `servicios` VALUES ('15', '76154671', null, null, null, null, '8', null, '76154671-6FSMI202', '2');
INSERT INTO `servicios` VALUES ('16', '1543470', null, null, null, null, '1', null, '1543470-1FSMI101', '1');
INSERT INTO `servicios` VALUES ('17', '15434708', null, null, null, null, '10', null, '15434708-9T02', '4');
INSERT INTO `servicios` VALUES ('18', '10888654', null, null, null, null, '1', null, '10888654-4FSMI201', '2');
INSERT INTO `servicios` VALUES ('19', '10888654', null, null, null, null, '3', null, '10888654-4FSMI202', '2');
INSERT INTO `servicios` VALUES ('20', '10888654', null, null, null, null, '9', null, '10888654-4T01', '4');
INSERT INTO `servicios` VALUES ('21', '10888654', null, null, null, null, '8', null, '10888654-4FSMI203', '2');
INSERT INTO `servicios` VALUES ('22', '10888654', null, null, null, null, '10', null, '10888654-4T02', '4');
INSERT INTO `servicios` VALUES ('23', '10888654', null, null, null, null, '3', null, '10888654-4FSMI101', '1');
INSERT INTO `servicios` VALUES ('24', '10888654', null, null, null, null, '1', null, '10888654-4FSMI102', '1');
INSERT INTO `servicios` VALUES ('25', '76154671', '1', '0', '1.00', '1.00', '6', '1', '', '11');
INSERT INTO `servicios` VALUES ('26', '76154671', '1', '0', '213.00', '123.00', '7', '123', '', '23213');
INSERT INTO `servicios` VALUES ('27', '78337120', '1', '0', '1.00', '1.00', '8', '1', '', '1');
INSERT INTO `servicios` VALUES ('28', '78337120', '1', '0', '1.00', '1.00', '8', '1', '78337120-1802', '1');
INSERT INTO `servicios` VALUES ('29', '78337120', '1', '0', '1.00', '1.00', '8', '1', '78337120-1803', '1sdasd');
INSERT INTO `servicios` VALUES ('30', '78337120', '1', '0', '1.00', '1.00', '8', '1', '78337120-1804', 'asdasd');
INSERT INTO `servicios` VALUES ('31', '78337120', '1', '0', '1.00', '1.00', '8', '1', '78337120-1805', '1');
INSERT INTO `servicios` VALUES ('32', '76154671', '1', '0', '1.00', '1.00', '6', '1', '76154671-1602', '1sdasdasd');
INSERT INTO `servicios` VALUES ('33', '76154671', '1', 'FSMI1', '1.00', '1.00', '6', '1', '76154671-1603', '1sdasdasd');
INSERT INTO `servicios` VALUES ('34', '76154671', '1', 'FSMI1', '1.00', '1.00', '6', '1', '76154671-1FSMI104', '1sdasdasd');
INSERT INTO `servicios` VALUES ('35', '76154671', '1', 'FSMI1', '1.00', '1.00', '8', '1', '76154671-FSMI102', 'asdasdasd');
INSERT INTO `servicios` VALUES ('36', '76154671', '1', 'FSMI1', '1.00', '1.00', '8', '1', '76154671-6FSMI103', 'asdasdasd');
