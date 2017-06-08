/*
Navicat MySQL Data Transfer

Source Server         : Mi Computadora
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : teledata

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-06-08 11:07:59
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of submenu
-- ----------------------------
INSERT INTO `submenu` VALUES ('4', '7', 'Bodegas', '../bodegas/Bodega.php');
INSERT INTO `submenu` VALUES ('5', '7', 'Proveedores', '../proveedores/Proveedor.php');
INSERT INTO `submenu` VALUES ('6', '7', 'Mantenedor Tipo Producto', '../tipo_producto/TipoProducto.php');
INSERT INTO `submenu` VALUES ('7', '7', 'Mantenedor Marca Producto', '../marca_producto/MarcaProducto.php');
INSERT INTO `submenu` VALUES ('8', '7', 'Mantenedor Modelo Producto', '../modelo_producto/ModeloProducto.php');
INSERT INTO `submenu` VALUES ('9', '7', 'Ingresos', '../ingresos/Ingreso.php');
INSERT INTO `submenu` VALUES ('10', '7', 'Egresos', '../egresos/Egreso.php');
