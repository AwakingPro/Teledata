/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : teledata

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-07-31 23:30:52
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(10) NOT NULL,
  `descripcion` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `enlace` varchar(100) NOT NULL,
  `permisos` varchar(20) NOT NULL,
  `icono` varchar(50) NOT NULL,
  PRIMARY KEY (`id_menu`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('1', 'Clientes', 'Clientes', '#', '1,2.3', 'fa fa-user');
INSERT INTO `menu` VALUES ('3', 'Ventas', 'Costos', '../costos/Costo.php', '1,2,3', 'fa fa-dollar');
INSERT INTO `menu` VALUES ('4', 'com', 'Compras & Ingreso', '../compras_ingresos/Ingreso.php', '1,2,3', 'fa fa-shopping-cart');
INSERT INTO `menu` VALUES ('7', 'Inventario', 'Inventario', '#', '1,2,3', 'fa fa-dropbox');
INSERT INTO `menu` VALUES ('8', 'Reportes', 'Reportes', '#', '1,2,3', 'fa fa-bar-chart');
INSERT INTO `menu` VALUES ('9', 'Configurac', 'Configuracion', '#', '1', 'fa fa-cog');
INSERT INTO `menu` VALUES ('10', 'Tickets', 'Tickets', '../tickets', '1,2,3', 'fa fa-ticket');
INSERT INTO `menu` VALUES ('14', 'RadioPlan', 'Radio Planning', '../radio/Radio.php', '1,2,3', 'fa fa-map-marker');
INSERT INTO `menu` VALUES ('15', 'NotaVent', 'Nota de Venta', '../nota_venta/NotaVenta.php', '1,2,3', 'glyphicon glyphicon-usd');
