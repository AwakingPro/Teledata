/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : teledata

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-07-31 23:31:04
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

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
INSERT INTO `submenu` VALUES ('11', '1', 'Crear y Ver Cliente', '../clientes');
INSERT INTO `submenu` VALUES ('12', '1', 'Servicios', '../servicios');
INSERT INTO `submenu` VALUES ('13', '1', 'Servicios del Cliente', '../clientesServicios');
INSERT INTO `submenu` VALUES ('14', '8', 'Facturas por Tiempo', '../reportes/reportesFacturas.php');
INSERT INTO `submenu` VALUES ('15', '8', 'Facturas por cliente', '../reportes/facturasClientes.php');
INSERT INTO `submenu` VALUES ('16', '9', 'Registro de Usuarios', '../registroUsuarios');
