/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : teledata

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-05-12 17:37:42
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for submenu
-- ----------------------------
DROP TABLE IF EXISTS `submenu`;
CREATE TABLE `submenu` (
  `IdSubMenu` int(11) NOT NULL AUTO_INCREMENT,
  `Id_menu` int(11) DEFAULT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Enlace` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`IdSubMenu`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of submenu
-- ----------------------------
INSERT INTO `submenu` VALUES ('1', '1', 'Crear Cliente', '../clientes/CrearCliente.php');
INSERT INTO `submenu` VALUES ('2', '1', 'Ver Clientes', '../clientes/VerClientes.php');
INSERT INTO `submenu` VALUES ('3', '3', 'Nueva Venta', '../ventas/dteNueva.php');
