/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : teledata

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-06-04 23:25:10
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tipo_facturacion
-- ----------------------------
DROP TABLE IF EXISTS `tipo_facturacion`;
CREATE TABLE `tipo_facturacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(20) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tipo_facturacion
-- ----------------------------
INSERT INTO `tipo_facturacion` VALUES ('1', 'FSMI1', 'Factura individual');
INSERT INTO `tipo_facturacion` VALUES ('2', 'FSMI2', 'Factura con otros Productos/Servicios');
