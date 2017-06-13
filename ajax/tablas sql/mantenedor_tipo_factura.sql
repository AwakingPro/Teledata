/*
Navicat MySQL Data Transfer

Source Server         : Mi Computadora
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : teledata

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-06-05 10:28:19
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for mantenedor_tipo_factura
-- ----------------------------
DROP TABLE IF EXISTS `mantenedor_tipo_factura`;
CREATE TABLE `mantenedor_tipo_factura` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(10) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of mantenedor_tipo_factura
-- ----------------------------
INSERT INTO `mantenedor_tipo_factura` VALUES ('1', 'FSMI1', 'Factura Individual');
INSERT INTO `mantenedor_tipo_factura` VALUES ('2', 'FSMI2', 'Factura Con otros Productos/Servicios');
INSERT INTO `mantenedor_tipo_factura` VALUES ('3', 'FSMIOC', 'Factura Mensual con OC');
INSERT INTO `mantenedor_tipo_factura` VALUES ('4', 'T', 'Telefonía ');
