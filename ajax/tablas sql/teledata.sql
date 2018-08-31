/*
 Navicat Premium Data Transfer

 Source Server         : Teledata
 Source Server Type    : MySQL
 Source Server Version : 50719
 Source Host           : 131.0.108.31:3306
 Source Schema         : teledata

 Target Server Type    : MySQL
 Target Server Version : 50719
 File Encoding         : 65001

 Date: 15/06/2018 16:32:03
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for arriendo_equipos_datos
-- ----------------------------
DROP TABLE IF EXISTS `arriendo_equipos_datos`;
CREATE TABLE `arriendo_equipos_datos`  (
  `IdArriendoEquiposDatos` int(11) NOT NULL AUTO_INCREMENT,
  `Velocidad` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Plan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `IdOrigen` int(11) NULL DEFAULT NULL,
  `IdProducto` int(11) NULL DEFAULT NULL,
  `TipoDestino` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `IdServicio` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`IdArriendoEquiposDatos`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 32 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for clase_tickets
-- ----------------------------
DROP TABLE IF EXISTS `clase_tickets`;
CREATE TABLE `clase_tickets`  (
  `IdClase` int(11) NOT NULL,
  `Nombre` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`IdClase`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of clase_tickets
-- ----------------------------
INSERT INTO `clase_tickets` VALUES (1, 'Cliente');
INSERT INTO `clase_tickets` VALUES (2, 'Interno');

-- ----------------------------
-- Table structure for clase_clientes
-- ----------------------------
DROP TABLE IF EXISTS `clase_clientes`;
CREATE TABLE `clase_clientes`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of clase_clientes
-- ----------------------------
INSERT INTO `clase_clientes` VALUES (1, 'Normal');
INSERT INTO `clase_clientes` VALUES (2, 'Preferente');
INSERT INTO `clase_clientes` VALUES (3, 'Premium');

-- ----------------------------
-- Table structure for comentarios_tickets
-- ----------------------------
DROP TABLE IF EXISTS `comentarios_tickets`;
CREATE TABLE `comentarios_tickets`  (
  `IdComentarioTicket` int(11) NOT NULL AUTO_INCREMENT,
  `IdTickets` int(11) NULL DEFAULT NULL,
  `Comentario` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `IdUSuario` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Fecha` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`IdComentarioTicket`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for compras_ingresos
-- ----------------------------
DROP TABLE IF EXISTS `compras_ingresos`;
CREATE TABLE `compras_ingresos`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero_factura` int(11) NOT NULL,
  `fecha_emision_factura` date NOT NULL,
  `proveedor_id` int(11) NOT NULL,
  `estado_id` int(11) NOT NULL,
  `centro_costo_id` int(11) NOT NULL,
  `numero_detalle` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `fecha_detalle` date NULL DEFAULT NULL,
  `monto` double(11, 2) NULL DEFAULT NULL,
  `detalle_factura` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for contactos
-- ----------------------------
DROP TABLE IF EXISTS `contactos`;
CREATE TABLE `contactos`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rut` int(11) NOT NULL,
  `contacto` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `cargo` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for datos_tecnicos
-- ----------------------------
DROP TABLE IF EXISTS `datos_tecnicos`;
CREATE TABLE `datos_tecnicos`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rut` int(11) NOT NULL,
  `id_servicio` int(11) NOT NULL,
  `ip` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `estacion` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ap` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `senal` int(11) NOT NULL,
  `senal_actual` int(11) NOT NULL,
  `mac` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for departamentos_tickets
-- ----------------------------
DROP TABLE IF EXISTS `departamentos_tickets`;
CREATE TABLE `departamentos_tickets`  (
  `IdDepartamento` int(11) NOT NULL,
  `Nombre` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`IdDepartamento`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of departamentos_tickets
-- ----------------------------
INSERT INTO `departamentos_tickets` VALUES (1, 'Soporte Técnico');

-- ----------------------------
-- Table structure for direcciones
-- ----------------------------
DROP TABLE IF EXISTS `direcciones`;
CREATE TABLE `direcciones`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rut` int(11) NOT NULL,
  `direccion` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ciudad` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for direcciones_ip
-- ----------------------------
DROP TABLE IF EXISTS `direcciones_ip`;
CREATE TABLE `direcciones_ip`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rut` int(11) NOT NULL,
  `descripcion` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ip` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_servicio` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for estado_tickets
-- ----------------------------
DROP TABLE IF EXISTS `estado_tickets`;
CREATE TABLE `estado_tickets`  (
  `IdEstado` int(11) NOT NULL,
  `Nombre` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`IdEstado`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of estado_tickets
-- ----------------------------
INSERT INTO `estado_tickets` VALUES (1, 'Abierto');
INSERT INTO `estado_tickets` VALUES (2, 'Cerrado');
INSERT INTO `estado_tickets` VALUES (3, 'Finalizado');

-- ----------------------------
-- Table structure for facturas
-- ----------------------------
DROP TABLE IF EXISTS `facturas`;
CREATE TABLE `facturas`  (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Rut` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Grupo` int(11) NOT NULL,
  `TipoFactura` int(11) NOT NULL,
  `EstatusFacturacion` int(11) NOT NULL,
  `DocumentoIdBsale` int(11) NOT NULL,
  `UrlPdfBsale` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `informedSiiBsale` int(11) NOT NULL,
  `responseMsgSiiBsale` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `FechaFacturacion` date NOT NULL,
  `HoraFacturacion` time(0) NOT NULL,
  `TipoDocumento` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `FechaVencimiento` date NOT NULL,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2669 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for facturas_detalle
-- ----------------------------
DROP TABLE IF EXISTS `facturas_detalle`;
CREATE TABLE `facturas_detalle`  (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `FacturaId` int(11) NOT NULL,
  `Concepto` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Valor` double(11, 2) NOT NULL,
  `Descuento` float NOT NULL,
  `IdServicio` int(11) NOT NULL,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3365 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

DROP TABLE IF EXISTS `facturas_pagos`;
CREATE TABLE `facturas_pagos`  (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `FacturaId` int(11) NOT NULL,
  `FechaPago` date NOT NULL,
  `TipoPago` int(11) NOT NULL,
  `Detalle` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Monto` double(11, 2) NULL DEFAULT NULL,
  `FechaEmisionCheque` date NULL DEFAULT NULL,
  `FechaVencimientoCheque` date NULL DEFAULT NULL,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;
-- ----------------------------
-- Table structure for giros
-- ----------------------------
DROP TABLE IF EXISTS `giros`;
CREATE TABLE `giros`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of giros
-- ----------------------------
INSERT INTO `giros` VALUES (1, 'Agricultura, Ganadería, Caza y Silvicultura');
INSERT INTO `giros` VALUES (2, 'Pesca ');
INSERT INTO `giros` VALUES (3, 'Explotación de Minas y Canteras ');
INSERT INTO `giros` VALUES (4, 'Industrias Manufactureras No Metálicas ');
INSERT INTO `giros` VALUES (5, 'Industrias Manufactureras Metálicas ');
INSERT INTO `giros` VALUES (6, 'Suministro de Electricidad, Gas y Agua ');
INSERT INTO `giros` VALUES (7, 'Construcción');
INSERT INTO `giros` VALUES (8, 'Comercio al Por Mayor y Menor; Rep. Vehículos Automotores/Enseres Domésticos ');
INSERT INTO `giros` VALUES (9, 'Hoteles y Restaurantes ');
INSERT INTO `giros` VALUES (10, 'Transporte, Almacenamiento y Comunicaciones');
INSERT INTO `giros` VALUES (11, 'Intermediación Financiera ');
INSERT INTO `giros` VALUES (12, 'Actividades Inmobiliarias, Empresariales y de Alquiler ');
INSERT INTO `giros` VALUES (13, 'Adm. Pública y Defensa; Planes de Seg. Social, Afiliación Obligatoria');
INSERT INTO `giros` VALUES (14, 'Enseñanza ');
INSERT INTO `giros` VALUES (15, 'Servicios Sociales y de Salud');
INSERT INTO `giros` VALUES (16, 'Otras Actividades de Servicios Comunitarias, Sociales y Personales');
INSERT INTO `giros` VALUES (17, 'Consejo de Administración de Edificios y Condominios');
INSERT INTO `giros` VALUES (18, 'Organizaciones y Órganos Extraterritoriales ');

-- ----------------------------
-- Table structure for grupo_servicio
-- ----------------------------
DROP TABLE IF EXISTS `grupo_servicio`;
CREATE TABLE `grupo_servicio`  (
  `IdGrupo` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`IdGrupo`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of grupo_servicio
-- ----------------------------
INSERT INTO `grupo_servicio` VALUES (1, 'Grupo 1');
INSERT INTO `grupo_servicio` VALUES (2, 'Grupo 2');
INSERT INTO `grupo_servicio` VALUES (3, 'ANUAL');

-- ----------------------------
-- Table structure for inventario_egresos
-- ----------------------------
DROP TABLE IF EXISTS `inventario_egresos`;
CREATE TABLE `inventario_egresos`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `destino_tipo` int(11) NOT NULL,
  `destino_id` int(11) NOT NULL,
  `fecha_movimiento` date NOT NULL,
  `hora_movimiento` time(0) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 30 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for inventario_ingresos
-- ----------------------------
DROP TABLE IF EXISTS `inventario_ingresos`;
CREATE TABLE `inventario_ingresos`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_compra` date NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `numero_factura` int(11) NOT NULL,
  `numero_serie` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `mac_address` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `modelo_producto_id` int(11) NOT NULL,
  `proveedor_id` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `valor` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `bodega_tipo` int(11) NOT NULL DEFAULT 1,
  `bodega_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 41 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for log_login
-- ----------------------------
DROP TABLE IF EXISTS `log_login`;
CREATE TABLE `log_login`  (
  `IdLogLogin` int(11) NOT NULL AUTO_INCREMENT,
  `IdUsuario` int(11) NULL DEFAULT NULL,
  `Usuario` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Pass` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Fecha` datetime(0) NULL DEFAULT NULL,
  `Proceso` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`IdLogLogin`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 421 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for log_query
-- ----------------------------
DROP TABLE IF EXISTS `log_query`;
CREATE TABLE `log_query`  (
  `IdLogSql` int(11) NOT NULL AUTO_INCREMENT,
  `IdUsuario` int(11) NULL DEFAULT NULL,
  `Fecha` datetime(0) NULL DEFAULT NULL,
  `Query` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `TipoOperacion` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`IdLogSql`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 56814 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for log_sistema
-- ----------------------------
DROP TABLE IF EXISTS `log_sistema`;
CREATE TABLE `log_sistema`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Fecha` varchar(18) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `operacion` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_registro` int(11) NOT NULL,
  `tabla` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `query` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for mail
-- ----------------------------
DROP TABLE IF EXISTS `mail`;
CREATE TABLE `mail`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rut` int(11) NOT NULL,
  `mail` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for mantencion_red
-- ----------------------------
DROP TABLE IF EXISTS `mantencion_red`;
CREATE TABLE `mantencion_red`  (
  `IdMantencionRed` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ComentarioDatosAdicionales` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `IdServicio` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`IdMantencionRed`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 41 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for mantenedor_bodegas
-- ----------------------------
DROP TABLE IF EXISTS `mantenedor_bodegas`;
CREATE TABLE `mantenedor_bodegas`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `direccion` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `telefono` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `personal_id` int(11) NOT NULL,
  `correo` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `principal` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for mantenedor_costos
-- ----------------------------
DROP TABLE IF EXISTS `mantenedor_costos`;
CREATE TABLE `mantenedor_costos`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `principal` int(11) NOT NULL DEFAULT 0,
  `direccion` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `telefono` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `personal_id` int(11) NOT NULL,
  `correo` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for mantenedor_tipo_pago
-- ----------------------------
DROP TABLE IF EXISTS `mantenedor_tipo_pago`;
CREATE TABLE `mantenedor_tipo_pago`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mantenedor_tipo_pago
-- ----------------------------
INSERT INTO `mantenedor_tipo_pago` VALUES (1, 'Pagado Transferencia');
INSERT INTO `mantenedor_tipo_pago` VALUES (2, 'Pendiente Pago');
INSERT INTO `mantenedor_tipo_pago` VALUES (3, 'Cheque');
INSERT INTO `mantenedor_tipo_pago` VALUES (4, 'Efectivo');
INSERT INTO `mantenedor_tipo_pago` VALUES (5, 'Tarjeta de Credito');
INSERT INTO `mantenedor_tipo_pago` VALUES (6, 'Otros');

-- ----------------------------
-- Table structure for mantenedor_marca_producto
-- ----------------------------
DROP TABLE IF EXISTS `mantenedor_marca_producto`;
CREATE TABLE `mantenedor_marca_producto`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_producto_id` int(11) NOT NULL,
  `nombre` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `descripcion` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;
-- ----------------------------
-- Table structure for mantenedor_modelo_producto
-- ----------------------------
DROP TABLE IF EXISTS `mantenedor_modelo_producto`;
CREATE TABLE `mantenedor_modelo_producto`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `marca_producto_id` int(11) NOT NULL,
  `nombre` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `descripcion` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for mantenedor_productos
-- ----------------------------
DROP TABLE IF EXISTS `mantenedor_productos`;
CREATE TABLE `mantenedor_productos`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for mantenedor_proveedores
-- ----------------------------
DROP TABLE IF EXISTS `mantenedor_proveedores`;
CREATE TABLE `mantenedor_proveedores`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `direccion` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `telefono` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `contacto` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `correo` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for mantenedor_servicios
-- ----------------------------
DROP TABLE IF EXISTS `mantenedor_servicios`;
CREATE TABLE `mantenedor_servicios`  (
  `IdServicio` int(11) NOT NULL AUTO_INCREMENT,
  `servicio` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`IdServicio`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 18 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mantenedor_servicios
-- ----------------------------
INSERT INTO `mantenedor_servicios` VALUES (1, 'Arriendo de Equipos de Datos ');
INSERT INTO `mantenedor_servicios` VALUES (5, 'Servicio de Mantención de Red');
INSERT INTO `mantenedor_servicios` VALUES (4, 'Servicio de IP Pública ');
INSERT INTO `mantenedor_servicios` VALUES (3, 'Servicio de Puertos Públicos ');
INSERT INTO `mantenedor_servicios` VALUES (2, 'Servicio de Internet ');
INSERT INTO `mantenedor_servicios` VALUES (6, 'Arriendo de equipos de Telefonía IP');
INSERT INTO `mantenedor_servicios` VALUES (7, 'Otros Servicios');

-- ----------------------------
-- Table structure for mantenedor_site
-- ----------------------------
DROP TABLE IF EXISTS `mantenedor_site`;
CREATE TABLE `mantenedor_site`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `direccion` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `telefono` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `personal_id` int(11) NOT NULL,
  `correo` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kmz` longblob NULL,
  `contacto` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dueno_cerro` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `latitud_coordenada` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `longitud_coordenada` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `latitud_coordenada_site` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `longitud_coordenada_site` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `datos_proveedor_electrico` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for mantenedor_tipo_factura
-- ----------------------------
DROP TABLE IF EXISTS `mantenedor_tipo_factura`;
CREATE TABLE `mantenedor_tipo_factura`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `descripcion` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 18 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mantenedor_tipo_factura
-- ----------------------------
INSERT INTO `mantenedor_tipo_factura` VALUES (11, 'BSMI', 'Boleta Servicio Mensual Individual');
INSERT INTO `mantenedor_tipo_factura` VALUES (17, 'FSAI', 'FACTURA SERVICIO ANUAL INTERNET');
INSERT INTO `mantenedor_tipo_factura` VALUES (13, 'FSMI', 'Factura servicio mensual');
INSERT INTO `mantenedor_tipo_factura` VALUES (15, 'FSMIOC', 'Factura servicio Mensual Orden de Compra');

-- ----------------------------
-- Table structure for mantenedor_tipo_facturacion
-- ----------------------------
DROP TABLE IF EXISTS `mantenedor_tipo_facturacion`;
CREATE TABLE `mantenedor_tipo_facturacion`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `descripcion` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mantenedor_tipo_facturacion
-- ----------------------------
INSERT INTO `mantenedor_tipo_facturacion` VALUES (1, 'FSMI1', 'Factura Individual');
INSERT INTO `mantenedor_tipo_facturacion` VALUES (2, 'FSMI2', 'Factura Con otros Productos/Servicios');
INSERT INTO `mantenedor_tipo_facturacion` VALUES (3, 'FSMIOC', 'Factura Mensual con OC');
INSERT INTO `mantenedor_tipo_facturacion` VALUES (4, 'T', 'Telefonía ');

-- ----------------------------
-- Table structure for mantenedor_tipo_producto
-- ----------------------------
DROP TABLE IF EXISTS `mantenedor_tipo_producto`;
CREATE TABLE `mantenedor_tipo_producto`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `descripcion` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for mensualidad_direccion_ip_fija
-- ----------------------------
DROP TABLE IF EXISTS `mensualidad_direccion_ip_fija`;
CREATE TABLE `mensualidad_direccion_ip_fija`  (
  `IdMensualidadDireccionIPFija` int(11) NOT NULL AUTO_INCREMENT,
  `DireccionIPFija` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Descripcion` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `IdServicio` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`IdMensualidadDireccionIPFija`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for mensualidad_puertos_publicos
-- ----------------------------
DROP TABLE IF EXISTS `mensualidad_puertos_publicos`;
CREATE TABLE `mensualidad_puertos_publicos`  (
  `IdMensualidadPuertosPublicos` int(11) NOT NULL AUTO_INCREMENT,
  `PuertoTCPUDP` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Descripcion` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `IdServicio` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`IdMensualidadPuertosPublicos`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu`  (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `descripcion` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `enlace` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `permisos` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `icono` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `indice` int(11) NOT NULL,
  PRIMARY KEY (`id_menu`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1035 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES (1, 'Clientes', 'Clientes y Servicios ', '#', '1,2.3', 'fa fa-user', 1);
INSERT INTO `menu` VALUES (2, 'Tareas', 'Tareas', '../tareas/Tarea.php', '1,2,3', 'fa fa-sticky-note', 2);
INSERT INTO `menu` VALUES (4, 'com', 'Compras & Ingreso  ', '#', '1,2,3', 'fa fa-shopping-cart', 5);
INSERT INTO `menu` VALUES (5, 'Inventario', 'Inventario', '#', '1,2,3', 'fa fa-dropbox', 6);
INSERT INTO `menu` VALUES (6, 'Reportes', 'Reportes', '#', '1,2,3', 'fa fa-bar-chart', 7);
INSERT INTO `menu` VALUES (7, 'Configurac', 'Configuracion', '#', '1', 'fa fa-cog', 8);
INSERT INTO `menu` VALUES (8, 'Tickets', 'Tickets', '../tickets', '1,2,3', 'fa fa-ticket', 9);
INSERT INTO `menu` VALUES (9, 'RadioPlan', 'Radio Planning', '../radio/Radio.php', '1,2,3', 'fa fa-map-marker', 10);
INSERT INTO `menu` VALUES (3, 'NotaVent', 'Nota de Venta', '#', '1,2,3', 'glyphicon glyphicon-usd', 3);
INSERT INTO `menu` VALUES (10, 'Logs', 'Logs', '#', '1', 'fa fa-exclamation-triangle', 11);
INSERT INTO `menu` VALUES (1034, 'fac', 'Emisión de Facturas / Boletas ', '../facturacion/Facturacion.php', '1,2,3', 'fa fa-percent', 4);

-- ----------------------------
-- Table structure for menu_roles
-- ----------------------------
DROP TABLE IF EXISTS `menu_roles`;
CREATE TABLE `menu_roles`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_menu` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `menu_submenu` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for nivel_privilegio
-- ----------------------------
DROP TABLE IF EXISTS `nivel_privilegio`;
CREATE TABLE `nivel_privilegio`  (
  `IdNivelPrivilegio` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Descripcion` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`IdNivelPrivilegio`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of nivel_privilegio
-- ----------------------------
INSERT INTO `nivel_privilegio` VALUES (1, 'Administrador', 'Descripcion de Administrador');
INSERT INTO `nivel_privilegio` VALUES (2, 'Soporte', 'Descripcion de Soporte');
INSERT INTO `nivel_privilegio` VALUES (3, 'Terreno', 'Descripcion de Terreno');

-- ----------------------------
-- Table structure for nota_venta
-- ----------------------------
DROP TABLE IF EXISTS `nota_venta`;
CREATE TABLE `nota_venta`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rut` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `numero_oc` varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `solicitado_por` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `retiro` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for nota_venta_detalle
-- ----------------------------
DROP TABLE IF EXISTS `nota_venta_detalle`;
CREATE TABLE `nota_venta_detalle`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nota_venta_id` int(11) NOT NULL,
  `codigo` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `servicio` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` double NOT NULL,
  `exencion` int(11) NOT NULL,
  `total` double NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 22 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for nota_venta_tmp
-- ----------------------------
DROP TABLE IF EXISTS `nota_venta_tmp`;
CREATE TABLE `nota_venta_tmp`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `servicio` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` double NOT NULL,
  `exencion` float NOT NULL,
  `total` double NOT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for origen_tickets
-- ----------------------------
DROP TABLE IF EXISTS `origen_tickets`;
CREATE TABLE `origen_tickets`  (
  `IdOrigen` int(11) NOT NULL,
  `Nombre` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`IdOrigen`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of origen_tickets
-- ----------------------------
INSERT INTO `origen_tickets` VALUES (1, 'Llamado Telefónico');
INSERT INTO `origen_tickets` VALUES (2, 'Correo Electrónico');
INSERT INTO `origen_tickets` VALUES (3, 'Presencial');
INSERT INTO `origen_tickets` VALUES (4, 'Pagina Web');
INSERT INTO `origen_tickets` VALUES (5, 'Interno');
INSERT INTO `origen_tickets` VALUES (6, 'Carta');
INSERT INTO `origen_tickets` VALUES (7, 'Otros');

-- ----------------------------
-- Table structure for personaempresa
-- ----------------------------
DROP TABLE IF EXISTS `personaempresa`;
CREATE TABLE `personaempresa`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rut` int(11) NOT NULL,
  `dv` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nombre` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `giro` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `direccion` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `correo` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `contacto` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `comentario` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `telefono` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ciudad` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `region` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `alias` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tipo_cliente` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `id_usuario_sistema` int(11) NULL DEFAULT NULL,
  `clase_cliente` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `rut`(`rut`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 268 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of personaempresa
-- ----------------------------
INSERT INTO `personaempresa` VALUES (1, 76154671, '6', 'A C Redes Servicios Acuícolas Ltda', 'C53 Fabricación y reparación de redes – Servicios acuícolas', 'Huenao Rural s n', 'jcgredes@yahoo.es', 'jcgredes@yahoo.es', '', '652534021', 'Curaco de Vélez', 'Curaco de Vélez', '', 'Factura', 105, '76154671-6', NULL);
INSERT INTO `personaempresa` VALUES (2, 78337120, '0', 'Adriatico Ltda', 'C73 Inversiones y construcción', 'Apoquindo 3721, Of. 43', 'dragoe@cmetrix.cl', 'dragoe@cmetrix.cl', '', '228899100', 'Las Condes', 'Santiago', '', 'Factura', 105, '78337120-0', NULL);
INSERT INTO `personaempresa` VALUES (3, 76009571, '0', 'Agencia de Viajes Frogs Travel Ltda', 'C04 Agencia de viajes', 'Parcelación las Araucarias 27', 'silvina.baladron@frogstravel.cl', 'frogstravel@gmail.com', '', '991558977', 'Puerto Varas', 'Puerto Varas', '', 'Factura', 105, '76009571-0', NULL);
INSERT INTO `personaempresa` VALUES (4, 76177052, '7', 'Agrícola e Inmobiliaria Kortmann Ltda', 'AYI Agrícola e inmobiliaria', 'Ruta V-50, Km.4', 'norakortmannm@gmail.com', 'norakortmannm@gmail.com', '', '98473557', 'Puerto Varas', 'Puerto Varas', '', 'Factura', 105, '76177052-7', NULL);
INSERT INTO `personaempresa` VALUES (5, 86353500, 'k', 'Agricola Hacienda Canteras S.A.', 'C06 Agrícola', 'Hemando de Aguirre 430', 'srozzi@canteras.cl', 'srozzi@canteras.cl', '', '992799744', 'Providencia', 'Santiago', '', 'Factura', 105, '86353500-k', NULL);
INSERT INTO `personaempresa` VALUES (6, 76084888, '3', 'Agrícola Hermanos Willer Ltda', 'A44 Producción de Leche y Carne', 'Esperanza Lote A Medialuna sn', 'anpavihe@hotmail.com', 'anpavihe@hotmail.com', '', '98861122', 'Puerto Octay', 'Puerto Octay', '', 'Factura', 105, '76084888-3', NULL);
INSERT INTO `personaempresa` VALUES (7, 76027597, '2', 'Agrícola Inpu Ltda.', 'C06 Agrícola', 'Fundo Doña Charo', 'agricolainpu@inpu.cl', 'agricolainpu@inpu.cl', '', '998220911', 'Llanquihue', 'Llanquihue', '', 'Factura', 105, '76027597-2', NULL);
INSERT INTO `personaempresa` VALUES (8, 77555230, '1', 'Agrícola Las Nubes Ltda.', 'C06 Agrícola', 'Fundo Santa Berta', 'j.rogel.a@hotmail.com', 'j.rogel.a@hotmail.com', '', '997457739', 'Puerto Octay', 'Puerto Octay', '', 'Factura', 105, '77555230-1', NULL);
INSERT INTO `personaempresa` VALUES (9, 77726150, '9', 'Agrícola Los Gamos Ltda.', 'C06 Agrícola', 'Fundo Los Gamos Ltda.', 'larriagada@auguri.cl', 'larriagada@auguri.cl', '', '993344664', 'Llanquihue', 'Llanquihue', '', 'Factura', 105, '77726150-9', NULL);
INSERT INTO `personaempresa` VALUES (10, 76375796, 'k', 'Agrícola Theovencia', 'C06 Agrícola', 'Fundo San Francisco', 'mariafe.balle@gmail.com', 'mariafe.balle@gmail.com', '', '958645906', 'Puerto Octay', 'Puerto Octay', '', 'Factura', 105, '76375796-k', NULL);
INSERT INTO `personaempresa` VALUES (11, 76243328, '1', 'Agrícola y Comercial Nomehue Ltda.', 'EXP Explotación mixta', 'Av. del Valle Norte 787.  Of 404.', 'dcovarrubias@nomehue.cl', 'dcovarrubias@nomehue.cl', '', '227547500', 'Huechuraba', 'Santiago', '', 'Factura', 105, '76243328-1', NULL);
INSERT INTO `personaempresa` VALUES (12, 76519828, '3', 'Agrícola y Lechera D y E Limitada', 'C06 Agrícola', 'Av. Vitacura 5250 Of. 308', 'epalominos@neohaus.cl', 'epalominos@neohaus.cl; majo_bain@hotmail.com', '', '', 'Vitacura', 'Santiago', '', 'Factura', 105, '76519828-3', NULL);
INSERT INTO `personaempresa` VALUES (13, 78162420, '9', 'Agroindustria y Turismo Giangrandi Ltda.', 'mue Fabricación y Venta de Muebles', 'Ruta 5 Km 215', 'pbottger@vallequilimari.cl', 'pbottger@vallequilimari.cl', '', '992382139', 'Los Vilos', 'Los Vilos', '', 'Factura', 105, '78162420-9', NULL);
INSERT INTO `personaempresa` VALUES (14, 89511200, '3', 'Agropecuaria y Forestal Fundo los Abedules Ltda', 'C06 Agrícola', 'Fundo Los Abedules, Casilla 1050', 'lhennicke@gmail.com', 'lhennicke@gmail.com', '', '94585565', 'Frutillar', 'Frutillar', '', 'Factura', 105, '89511200-3', NULL);
INSERT INTO `personaempresa` VALUES (15, 76667079, '2', 'Aitue Lodge Joaquín Cisa', 'PES Arriendo de Cabañas y Pesca Deportiva', 'Lago Todo los Santos SN', 'm.larastrack@gmail.com', 'm.larastrack@gmail.com', '', '988147485', 'Puerto Varas', 'Puerto Varas', '', 'Factura', 105, '76667079-2', NULL);
INSERT INTO `personaempresa` VALUES (16, 7452422, '2', 'Alberto Osvaldo Held Pfeiffer', 'C06 Agrícola', 'Fundo Lagunitas, Frutillar Bajo', 'veroheld@hotmail.com', 'veroheld@hotmail.com', '', '652330113', 'Frutillar', 'Frutillar', '', 'Factura', 105, '7452422-2', NULL);
INSERT INTO `personaempresa` VALUES (17, 9994567, '2', 'Alejandra Cortes Fuentes', 'Hos Hosteria', 'Ruta 225.  Km. 37, El Tepú.  Ensenada.', 'contacto@quilahostal.com', 'contacto@quilahostal.com', '', '967607039', 'Puerto Varas', 'Puerto Varas', '', 'Factura', 105, '9994567-2', NULL);
INSERT INTO `personaempresa` VALUES (18, 77522900, '4', 'Alpha Moss Ltda', 'C52 Exportación de plantas', 'Nalhuitad Rural', 'G.delaRoche@AlphaMoss.cl', 'G.delaRoche@AlphaMoss.cl', '', '8247205', 'Chonchi', 'Chonchi', '', 'Factura', 105, '77522900-4', NULL);
INSERT INTO `personaempresa` VALUES (19, 8269872, '8', 'Alvaro Barros López', 'C95 Residenciales, arriendo de cabañas, camping', 'Alto Puelo km 50', 'contacto@cabalgatasriopuelo.cl', 'contacto@cabalgatasriopuelo.cl', '', '967692918', 'Cochamó', 'Cochamó', '', 'Factura', 105, '8269872-8', NULL);
INSERT INTO `personaempresa` VALUES (20, 7297943, '5', 'Andres Yermany Luckeheide', 'C18 Cabañas', 'Ruta 225, Camino Ensenada km 42', 'andres@brisasdellago.cl', 'andres@brisasdellago.cl', '', '652212012', 'Puerto Varas', 'Ensenada', '', 'Factura', 105, '7297943-5', NULL);
INSERT INTO `personaempresa` VALUES (21, 96912840, '3', 'Aquagen Chile S.A.', 'C91 Reproducción de peces y mariscos', 'San Francisco 328, Segundo Piso.', 'Silvana.paredes@aquagenchile.cl', 'Silvana.paredes@aquagenchile.cl', '', '652237308', 'Puerto Varas', 'Puerto Varas', '', 'Factura', 105, '96912840-3', NULL);
INSERT INTO `personaempresa` VALUES (22, 76198945, '6', 'Arcos y AXT Limitada', 'HHT hostal', 'Punion, sitio B19.  Contao', 'ivarcos@gmail.com', 'ivancos@gmail.com', '', '98730070', 'Hualaihué', 'Hualaihue', '', 'Factura', 105, '76198945-6', NULL);
INSERT INTO `personaempresa` VALUES (23, 76145415, '3', 'Arquitectura y Construcción Dahomey Ltda.', 'C78 Obras de ingeniería', 'Los Laureles 315', 'rrhh@dahomey.cl', 'rrhh@dahomey.cl', '', '963670805', 'Puerto Montt', 'Puerto Montt', '', 'Factura', 105, '76145415-3', NULL);
INSERT INTO `personaempresa` VALUES (24, 78735770, '9', 'Asesorías e Inversiones Riñihue Ltda.', 'A46 Asesorías', 'Sector Linea Nueva S.N', 'albertcherry@gmail.com', 'albertcherry@gmail.com', '', '92796398', 'Puerto Varas', 'Puerto Varas', '', 'Factura', 105, '78735770-9', NULL);
INSERT INTO `personaempresa` VALUES (25, 76101160, 'k', 'Asesorías Proredes Data Ltda.', 'A46 Asesorías', 'Av. Del Cóndor 550.  Oficina 106, Region Empresarial', 'cgause@proredes.net', 'cgause@proredes.net; acristi@proredes.net', '', '998737961', 'Huechuraba', 'Santiago', '', 'Factura', 105, '76101160-k', NULL);
INSERT INTO `personaempresa` VALUES (26, 76702760, '5', 'AUDREY & MICKAEL TURISMO LTDA.', 'A12 Turismo', 'Sector el Taique S N', 'lodgeeltaique@hotmail.com', 'lodgeeltaique@hotmail.com', '', '642970980', 'Puyehue', 'Osorno', '', 'Factura', 105, '76702760-5', NULL);
INSERT INTO `personaempresa` VALUES (27, 8326986, '3', 'Augusto Muller Contreras', 'A23 Contratista de Obras Menores', 's n', 'muller.augusto@gmail.com', 'muller.augusto@gmail.com', '', '998389841', 'Hualaihué', 'Contao', '', 'Factura', 105, '8326986-3', NULL);
INSERT INTO `personaempresa` VALUES (28, 76273790, '6', 'Bar de la Esquina Ltda.', 'C96 Restaurant', 'Volcán Osorno Km 13', 'cristobal@teski.cl', 'cristobal@teski.cl', '', '652566622', 'Puerto Varas', 'Ensenada', '', 'Factura', 105, '76273790-6', NULL);
INSERT INTO `personaempresa` VALUES (29, 13406155, '3', 'Benedicto Gustavo Rain Gallardo', 'MMM Fábrica de Muebles Rústicos', 'Yerbas Buenas KM 12 Camino Ensenada - Cascada', 'claudita_18_92@hotmail.com', 'claudita_18_92@hotmail.com', '', '93001599', 'Puerto Varas', 'Puerto Varas', '', 'Factura', 105, '13406155-3', NULL);
INSERT INTO `personaempresa` VALUES (30, 76226208, '8', 'Berta Solange Contreras Mutis Inversiones E.I.R.L', 'C69 Inversiones', 'Pasaje Nuevo 41 Casa 700, Valle Volcanes', 'bertacontrerasm@gmail.com', 'bertacontrerasm@gmail.com', '', '92199551', 'Puerto Montt', 'Puerto Montt', '', 'Factura', 105, '76226208-8', NULL);
INSERT INTO `personaempresa` VALUES (31, 76154515, '9', 'Bitumix Austral S.A.', 'C30 Constructora', 'Serrano 317', 'eduardo.almonacid@bitumix.cl', 'christian.montiel@bitumixaustral.cl', '', '652262985', 'Puerto Montt', 'Puerto Montt', '', 'Factura', 105, '76154515-9', NULL);
INSERT INTO `personaempresa` VALUES (32, 96633150, 'k', 'Camanchaca Cultivos Sur S.A.', 'C27 Comercio, Cultivo y Distribución de Productos del Mar', 'Rauco Rural s n', 'acayuhuan@camanchaca.cl', 'acayuhuan@camanchaca.cl; dte_prod@camanchaca.cl', '', '652534333', 'Chonchi', 'Chonchi', '', 'Factura', 105, '96633150-k', NULL);
INSERT INTO `personaempresa` VALUES (33, 6933559, '4', 'Carlos Segundo Siegel Linay', 'A37 Agrícola y Turismo', 'Ruta 225 Km 48 S.N', 'vistaallago@live.cl', 'vistaallago@live.cl', '', '99176050', 'Puerto Varas', 'Ensenada', '', 'Factura', 105, '6933559-4', NULL);
INSERT INTO `personaempresa` VALUES (34, 8651174, '6', 'Carlos Springer Gebauer', 'C06 Agrícola', 'Fundo El Faro Km. 13 Ruta Frutillar - Puerto Octay  Quilanto', 'ljubica.yager@gmail.com', 'ljubica.yager@gmail.com', '', '996415599', 'Frutillar', 'Frutillar', '', 'Factura', 105, '8651174-6', NULL);
INSERT INTO `personaempresa` VALUES (35, 77502420, '8', 'Carrier y Compañia Limitada', 'A12 Turismo', 'Ruta 225 Km 40 Ensenada', 'info@kokayak.cl; ric_carrier@hotmail.com', 'info@kokayak.cl; ric_carrier@hotmail.com', '', '652233004', 'Puerto Varas', 'Puerto Varas', '', 'Factura', 105, '77502420-8', NULL);
INSERT INTO `personaempresa` VALUES (36, 82411500, '1', 'Casa de Talleres de San Vicente de Paul', 'C44 Educación', 'Urmeneta 582', 'wladimir.sanmartin@ssvp.cl; paola.maffei@ssvp.cl', 'wladimir.sanmartin@ssvp.cl; paola.maffei@ssvp.cl', '', '964079711', 'Puerto Octay', 'Puerto Octay', '', 'Factura', 105, '82411500-1', NULL);
INSERT INTO `personaempresa` VALUES (37, 79784980, '4', 'Cermaq Chile S.A.', 'C91 Reproducción de peces y mariscos', 'Diego Portales 2000, Piso 10', 'marisol.ampuero@cermaq.com', 'jaime.maldonado@cermaq.com; e-invoice.empresa@cermaq.com', '', '652480200', 'Puerto Montt', 'Puerto Montt', '', 'Factura', 105, '79784980-4', NULL);
INSERT INTO `personaempresa` VALUES (38, 76551290, '5', 'Chilesan S.A.', 'C91 Reproducción de peces y mariscos', 'Camino al Fuerte 37', 'ocastillo@chilesan.cl', 'ocastillo@chilesan.cl', '', '051-470670', 'Coquimbo', 'Coquimbo', '', 'Factura', 105, '76551290-5', NULL);
INSERT INTO `personaempresa` VALUES (39, 13120812, 'k', 'Christian Alejandro Rehbein Montaña', 'CHC Restaurant, Hospedaje, Camping', 'Ruta 225 Km 45', 'turismoensenada@gmail.com', 'turismoensenada@gmail.com', '', '973063545', 'Puerto Varas', 'Ensenada', '', 'Factura', 105, '13120812-k', NULL);
INSERT INTO `personaempresa` VALUES (40, 76363024, '2', 'Claudia Verdugo Castro Consult  Ambiental y Acuicultura EIRL', 'CAM Consultoría Ambientales', 'Mirador Hornopirén 1890', 'claudia.verdugo@ingenat.cl', 'claudia.verdugo@ingenat.cl', '', '98851384', 'Puerto Montt', 'Puerto Montt', '', 'Factura', 105, '76363024-2', NULL);
INSERT INTO `personaempresa` VALUES (41, 13117055, '6', 'Claudio Schnettler Cid', 'C65 Ingeniera', 'Manihual 270 Puerta del Sol', 'claudioschnettler@gmail.com', 'claudioschnettler@gmail.com', '', '652263215', 'Puerto Montt', 'Puerto Montt', '', 'Factura', 105, '13117055-6', NULL);
INSERT INTO `personaempresa` VALUES (42, 76497398, '4', 'Co-Life Patagonia SpA', 'C61 Hotelería y turismo', 'Av. Bernardo Philippi 1215', 'ramirezseco@gmail.com; grellier.pauline@gmail.com', 'ramirezseco@gmail.com; reservas@hotelayacara.cl; grellier.pauline@gmail.com', '', '652421550', 'Frutillar', 'Frutillar', '', 'Factura', 105, '76497398-4', NULL);
INSERT INTO `personaempresa` VALUES (43, 76165570, '1', 'Comercial Despliegue Limitada', 'C86 Publicidad', 'Ohiggins 755, Piso 2', 'andres@tierrachiloe.com', 'andres@tierrachiloe.com; tali@despliegue.cl', '', '992225453', 'Castro', 'Castro', '', 'Factura', 105, '76165570-1', NULL);
INSERT INTO `personaempresa` VALUES (44, 76215977, '5', 'Comercial FT Ltda.', 'arr Arriendo Cabañas', 'Parcela N°4.  Camino Los Bajos, sector playa Maqui', 'asynesacon@surnet.cl; hugotriviño1@gmail.com', 'asynesacon@surnet.cl; hugotriviño1@gmail.com', '', '', 'Frutillar', 'Frutillar', '', 'Factura', 105, '76215977-5', NULL);
INSERT INTO `personaempresa` VALUES (45, 78871120, '4', 'Comercial los Arrayanes S.A.', 'C26 Comercio', 'Loteo El Mirador P 36', 'jfcanas@motorancho.cl', 'ventasmotorancho@gmail.com; jfcanas@motorancho.cl', '', '652235650', 'Puerto Varas', 'Puerto Varas', '', 'Factura', 105, '78871120-4', NULL);
INSERT INTO `personaempresa` VALUES (46, 76049160, '8', 'Comercial Melipal Limitada', 'A13 Turismo y cabañas', 'Ruta 225 KM 41.200 Lote 8 Ensenada', 'opirles@gmail.com', 'opirles@gmail.com', '', '951990438', 'Puerto Varas', 'Ensenada', '', 'Factura', 105, '76049160-8', NULL);
INSERT INTO `personaempresa` VALUES (47, 76389782, '6', 'Comercial Moritz Ltda.', 'SI Servicios de Ingenieria', 'Troncos Milenarios Parcela 104 Km. 8', 'recepcion@mservice.cl', 'recepcion@mservice.cl; mflores@mservice.cl', '', '652262526', 'Puerto Montt', 'Puerto Montt', '', 'Factura', 105, '76389782-6', NULL);
INSERT INTO `personaempresa` VALUES (48, 76067780, '9', 'Comercial Paillahue Ltda.', '002 comercial', 'Ruta 5 Sur Km 943', 'rteuberk@gmail.com', 'rteuberk@gmail.com', '', '91385851', 'Río Negro', 'Río Negro', '', 'Factura', 105, '76067780-9', NULL);
INSERT INTO `personaempresa` VALUES (49, 79962870, '8', 'Comercial Peulla', 'pdv Almacén, Prendas de Vestir', 'Peulla SN', 'rweisser@turistour.cl; jrivera@turistour.cl.', 'rweisser@turistour.cl; jrivera@turistour.cl.', '', '', 'Puerto Varas', 'Puerto Varas', '', 'Factura', 105, '79962870-8', NULL);
INSERT INTO `personaempresa` VALUES (50, 77415780, '8', 'Comercial Punta Larga Ltda', 'C98 Servicio', 'Camino Punta Larga, Fundo las Pampas km 9', 'servicio@puntalarga.cl', 'servicio@puntalarga.cl', '', '652330429', 'Frutillar', 'Frutillar', '', 'Factura', 105, '77415780-8', NULL);
INSERT INTO `personaempresa` VALUES (51, 76462081, 'k', 'Comercializadora Agua Puerto Varas Limitada', 'EDA Envasadora de Agua', 'Santa Rosa 560 Of 33', 'abruzzone@aguapuertovaras.cl', 'abruzzone@aguapuertovaras.cl', '', '993020108', 'Puerto Varas', 'Puerto Varas', '', 'Factura', 105, '76462081-k', NULL);
INSERT INTO `personaempresa` VALUES (52, 76069172, '0', 'Comercializadora Yogurteria S.A', 'Yog Compra y Venta, Imp y Exp de Helados y Yogurt', 'Pedro Lagos 640', 'oficina@yogurtlife.cl', 'oficina@yogurtlife.cl', '', '', 'Santiago', 'Santiago', '', 'Factura', 105, '76069172-0', NULL);
INSERT INTO `personaempresa` VALUES (53, 77358320, 'k', 'Concepto Nativo Inversiones Ltda', 'C17 Asesorías técnico económicas y comerciales en acuícultura', 'Ruta 225, Camino Ensenada km 7,5, Sector La Fábrica, Fundo E', 'gcea@wellbeing.cl', 'gcea@wellbeing.cl', '', '991289553', 'Puerto Varas', 'Puerto Varas', '', 'Factura', 105, '77358320-k', NULL);
INSERT INTO `personaempresa` VALUES (54, 76057203, '9', 'Constructora Mahuida y Compañia Ltda', 'C32 Contratista en obras de construcción', 'Parcela 50, La Fabrica', 'j.arjel@constructoramahuida.cl', 'j.arjel@constructoramahuida.cl', '', '998847770', 'Puerto Varas', 'Puerto Varas', '', 'Factura', 105, '76057203-9', NULL);
INSERT INTO `personaempresa` VALUES (55, 77775300, '2', 'Constructora Puerto Octay Ltda.', 'C30 Constructora', 'Panamericana Sur N° 349 Piso 2', 'constructoraoctay@gmail.com', 'marcoherna1@gmail.com', '', '', 'Puerto Montt', 'Puerto Montt', '', 'Factura', 105, '77775300-2', NULL);
INSERT INTO `personaempresa` VALUES (56, 96987580, '2', 'Constructora Rio Negro S.A', 'A50 Construcciones', 'Lote 2D La Vara Casilla 1227', 'constructorarionegro@gmail.com', 'constructorarionegro@gmail.com', '', '92898081', 'Puerto Montt', 'Puerto Montt', '', 'Factura', 105, '96987580-2', NULL);
INSERT INTO `personaempresa` VALUES (57, 77297080, '3', 'Constructora San Francisco  Ltda.', 'C29 Construcción', 'Atilio Juvenal', 'msoloyarzun@gmail.com', 'constructorasanfranciscoltda@gmail.com', '', '61220546', 'Chonchi', 'Chonchi', '', 'Factura', 105, '77297080-3', NULL);
INSERT INTO `personaempresa` VALUES (58, 76002253, '5', 'Constructora Tierra Austral Ltda', 'C29 Construcción', 'Baquedano 134', 'n.aranguiz@gmail.com', 'cbezanilla@ctaustral.cl; n.aranguiz@gmail.com', '', '652234568', 'Puerto Varas', 'Puerto Varas', '', 'Factura', 105, '76002253-5', NULL);
INSERT INTO `personaempresa` VALUES (59, 72275900, '1', 'Corporación de Arte Moderno Chiloé', 'mus museo', 'Parque Municipal SN', 'ofmamchiloe@gmail.com', 'ofmamchiloe@gmail.com', '', '', 'Castro', 'Castro', '', 'Factura', 105, '72275900-1', NULL);
INSERT INTO `personaempresa` VALUES (60, 72286300, '3', 'Corporación de Cultura Ext. Y Des. Los Heroes', 'C90 Recreación', 'General Holley 2395', 'adminsii@recreactiva.cl', 'adminsii@recreactiva.cl', '', '02-330448', 'Providencia', 'Santiago', '', 'Factura', 105, '72286300-3', NULL);
INSERT INTO `personaempresa` VALUES (61, 65117461, '9', 'Corporación Educacional Miramar Bajo', 'C44 Educación', 'Sector Rural Miramar Bajo SN', 'huahuar1@gmail.com', 'huahuar1@gmail.com', '', '652562547', 'Los Muermos', 'Los Muermos', '', 'Factura', 105, '65117461-9', NULL);
INSERT INTO `personaempresa` VALUES (62, 65122584, '1', 'Corporación Educacional Raices de Lemuy', 'C44 Educación', 'Acheuque Rural', 'colegioraicesdelemuy@hotmail.com', 'colegioraicesdelemuy@hotmail.com', '', '987410666', 'Puqueldón', 'Puqueldón', '', 'Factura', 105, '65122584-1', NULL);
INSERT INTO `personaempresa` VALUES (63, 65114919, '3', 'Corporación Educacional Santa Clara', 'C44 Educación', 'Ramón Freire Poniente SN', 'mmunozmiranda@gmail.com', 'mmunozmiranda@gmail.com', '', '652264183', 'Dalcahue', 'Dalcahue', '', 'Factura', 105, '65114919-3', NULL);
INSERT INTO `personaempresa` VALUES (64, 78288130, '2', 'Cranberries Austral Chile S.A.', 'C06 Agrícola', 'Fundo El Burro s n.', 'drubilar@cac.cl', 'drubilar@cac.cl; administracion@cac.cl', '', '997038979', 'Frutillar', 'Frutillar', '', 'Factura', 105, '78288130-2', NULL);
INSERT INTO `personaempresa` VALUES (65, 13078103, '9', 'Cristian Alejandro Cea Aguirre', 'HTA Hostal y Turismo Aventura', 'Av. Aeródromo SN', 'cochamo@patagonianativa.cl;  cricea@gmail.com', 'cochamo@patagonianativa.cl;  cricea@gmail.com', '', '993165635', 'Cochamó', 'Cochamó', '', 'Factura', 105, '13078103-9', NULL);
INSERT INTO `personaempresa` VALUES (66, 77098380, '0', 'Cristian García y Compañía Ltda', 'A01 Servicios médicos', 'Bellavista 123', 'garciasantos1522@gmail.com', 'garciasantos1522@gmail.com', '', '989016637', 'Puerto Montt', 'Puerto Montt', '', 'Factura', 105, '77098380-0', NULL);
INSERT INTO `personaempresa` VALUES (67, 6335069, '9', 'Cristina Margarita von Bischhoffshausen Neumann', 'C06 Agrícola', 'Fundo Nihue s n', 'tintronic@yahoo.com', 'christel.vonb@gmail.com', '', '652330144', 'Frutillar', 'Frutillar', '', 'Factura', 105, '6335069-9', NULL);
INSERT INTO `personaempresa` VALUES (68, 70007200, '2', 'Cuerpo de Bomberos de Puerto Varas', 'upp Utilidad Pública', 'San Francisco 601', 'superintendencia@bomberospuertovaras.cl', 'superintendencia@bomberospuertovaras.cl', '', '652233522', 'Puerto Varas', 'Puerto Varas', '', 'Factura', 105, '70007200-2', NULL);
INSERT INTO `personaempresa` VALUES (69, 12712897, '9', 'Denise Arteaga Gómez', 'A23 Contratista de Obras Menores', 'Santa Ines 1060', 'gvmmoreno@yahoo.com', 'gvmmoreno@yahoo.com', '', '86137096', 'Puerto Montt', 'Puerto Montt', '', 'Factura', 105, '12712897-9', NULL);
INSERT INTO `personaempresa` VALUES (70, 22815731, '7', 'Dimitry Vilister', 'C11 Arrendamiento de casas amobladas', 'Ruta 225, Camino Ensenada km 43', 'nsabver@gmail.com', 'nsabver@gmail.com', '', '984613035', 'Puerto Varas', 'Ensenada', '', 'Factura', 105, '22815731-7', NULL);
INSERT INTO `personaempresa` VALUES (71, 76119152, '7', 'DLC SPA', 'CP Comercialización y Producción', 'Ruta V 505 kM 3,5 SN', 'jaimedelacruz@solucionesdlc.cl', 'jaimedelacruz@solucionesdIc.cl', '', '652230616', 'Puerto Varas', 'Puerto Montt', '', 'Factura', 105, '76119152-7', NULL);
INSERT INTO `personaempresa` VALUES (72, 76633702, '3', 'Dr. Jaime Sepúlveda Sandoval y Cía. Ltda.', 'SMI Servicios Médicos, imagenológicos y kinesiológicos', 'Ruta 225. Km. 5, Parcela 23', 'jaimesep@gmail.com', 'jaimesep@gmail.com', '', '992933788', 'Puerto Varas', 'Puerto Varas', '', 'Factura', 105, '76633702-3', NULL);
INSERT INTO `personaempresa` VALUES (73, 76530740, '6', 'Educadora del Sur Ltda.', 'C44 Educación', 'Km. 12.2.  Colonia Río Sur.', 'administracion@colegiovencedor.cl', 'administracion@colegiovencedor.cl', '', '974324630', 'Puerto Varas', 'Puerto Varas', '', 'Factura', 105, '76530740-6', NULL);
INSERT INTO `personaempresa` VALUES (74, 53298654, '0', 'Eggers Ortega Blanca Isidora y Otro', 'A20 Agroturismo', 'Llanada Grande Km 33', 'diazpentz@gmail.com', 'diazpentz@gmail.com', '', '652566644', 'Cochamó', 'Cochamó', '', 'Factura', 105, '53298654-0', NULL);
INSERT INTO `personaempresa` VALUES (75, 12432775, 'k', 'Elizabeth Alejandra Navarrete Fernandez', 'A04 Supermercado', 'Ruta 225, Camino Ensenada km 43', 'ensenadapatagonia@hotmail.com', 'ensenadapatagonia@hotmail.com', '', '652212044', 'Puerto Varas', 'Ensenada', '', 'Factura', 105, '12432775-k', NULL);
INSERT INTO `personaempresa` VALUES (76, 76037036, '3', 'Empresa Eléctrica La Arena SPA', 'C56 Generación de energía', 'Gertrudis Echeñique 220, piso 7', 'jamenabar@invercap.cl', 'jamenabar@invercap.cl; jtelton@epasa.cl; ebrante@invercap.cl', '', '652234038', 'Las Condes', 'Santiago', '', 'Factura', 105, '76037036-3', NULL);
INSERT INTO `personaempresa` VALUES (77, 13968875, '9', 'Enzo Aarón Almonacid Morales', 'Cul Cultivos Marinos', 'Sector el Cobre SN', 'enzo.almonacid@hotmail.com', 'enzo.almonacid@hotmail.com', '', '998717135', 'Hualaihué', 'Hornopirén', '', 'Factura', 105, '13968875-9', NULL);
INSERT INTO `personaempresa` VALUES (78, 12659907, '2', 'Ernesto Palm del Curto ', 'A39 Servicios Turísticos', 'San Pedro 311', 'lacomarca@pueloadventure.cl', 'lacomarca@pueloadventure.cl', '', '997991920', 'Puerto Varas', 'Puerto Varas', '', 'Factura', 105, '12659907-2', NULL);
INSERT INTO `personaempresa` VALUES (79, 65115002, '7', 'Escuela Profesora Eliana Triviño Márquez', 'C44 Educación', 'Km 16 Matao Camino a Chequian', 'esc.mataoetm@gmail.com', 'esc.mataoetm@gmail.com', '', '', 'Quinchao', 'Achao', '', 'Factura', 105, '65115002-7', NULL);
INSERT INTO `personaempresa` VALUES (80, 20684095, '1', 'Esteban Rodrigo Escobar Sanders', 'A20 Agroturismo', 'Km. 24,8. Ruta 225.', 'esteban@quintadellago.com', 'esteban@quintadellago.com', '', '944527496', 'Puerto Varas', 'Puerto Varas', '', 'Factura', 105, '20684095-1', NULL);
INSERT INTO `personaempresa` VALUES (81, 76860640, '4', 'Estero Butan Ltda', 'C70 Inversiones e inmobiliaria', 'Urmeneta 305, Of. 702', 'arkiben@gmail.com', 'ebutan@gmail.com; arkiben@gmail.com', '', '981364062', 'Puerto Montt', 'Puerto Montt', '', 'Factura', 105, '76860640-4', NULL);
INSERT INTO `personaempresa` VALUES (82, 76352935, '5', 'Ferreteria Maderera y Servicios Acuicolas Andrade Vera Ltda', 'FSA Ferreteria y Servicios Acuicolas', 'Putemun Rural SN', 'ferreteriaputemun@yahoo.es', 'ferreteriaputemun@yahoo.es', '', '98201173', 'Castro', 'Castro', '', 'Factura', 105, '76352935-5', NULL);
INSERT INTO `personaempresa` VALUES (83, 76500800, 'k', 'Fibras SG Ltda.', 'FYT Fábrica y Transporte', 'transsg@outlook.com', 'transsg@outlook.com', 'transsg@outlook.com', '', '950116724', 'Puerto Montt', 'Puerto Montt', '', 'Factura', 105, '76500800-k', NULL);
INSERT INTO `personaempresa` VALUES (84, 15379541, 'k', 'Francisca Márquez Gorostegui', 'lav Lavandería', 'Colón 290', 'marquezgorostegui@gmail.com; sephidon@hotmail.com', 'marquezgorostegui@gmail.com; sephidon@hotmail.com', '', '998590585', 'Puerto Varas', 'Puerto Varas', '', 'Factura', 105, '15379541-k', NULL);
INSERT INTO `personaempresa` VALUES (85, 10335732, '2', 'Francisco Javier Fernández Seguel', 'A10 Transporte y obras menores', 'Ciruelillos s n', 'fjfernan76@yahoo.es', 'fjfernan76@yahoo.es', '', '978980095', 'Hualaihué', 'Hualaihue', '', 'Factura', 105, '10335732-2', NULL);
INSERT INTO `personaempresa` VALUES (86, 15299221, '1', 'Fredy Mansilla', 'C50 Excursiones y transporte de turismo', 'Ruta 225, Camino Ensenada km 44', 'terrasuroficina@hotmail.com', 'terrasuroficina@hotmail.com', '', '994957690', 'Puerto Varas', 'Ensenada', '', 'Factura', 105, '15299221-1', NULL);
INSERT INTO `personaempresa` VALUES (87, 5652042, '2', 'Fresia Fernandez Martinez', 'C18 Cabañas', 'Ruta 225, Camino Ensenada km 43', 'ensenadayessely@hotmail.com', 'ensenadayessely@hotmail.com', '', '652212051', 'Puerto Varas', 'Ensenada', '', 'Factura', 105, '5652042-2', NULL);
INSERT INTO `personaempresa` VALUES (88, 96975570, 'K', 'Frigorificos Puerto Montt S.A', 'A30 Frigorífico', 'Camino a Pargua Km 9', 'pamefuentesc@hotmail.com', 'pamefuentesc@hotmail.com', '', '652330356', 'Puerto Montt', 'Puerto Montt', '', 'Factura', 105, '96975570-K', NULL);
INSERT INTO `personaempresa` VALUES (89, 61103035, '5', 'Fuerza Aérea de Chile', 'DEF Defensa', 'Av. Pedro Aguirre Cerda 5500', 'jose.santibanez@fach.mil.cl', 'jose.santibanez@fach.mil.cl', '', '56229764435', 'Cerrillos', 'Santiago', '', 'Factura', 105, '61103035-5', NULL);
INSERT INTO `personaempresa` VALUES (90, 65107746, 'k', 'Fundación de Benef. Pública Educ., Cult. y Ecuestre Lipizza', 'CDE Cría de Equinos', 'Camino Coihueco Km 14,5 Fundo Tronador', 'crosas@harastronador.cl; erios@meritus.cl', 'crosas@harastronador.cl; erios@meritus.cl', '', '', 'Purranque', 'Purranque', '', 'Factura', 105, '65107746-k', NULL);
INSERT INTO `personaempresa` VALUES (91, 76048902, '6', 'Geo 3 Ltda.', 'MMT Maquinaria Movimiento de Tierra', 'Argomedo 712', 'rgamerre@gmail.com', 'rgamerre@gmail.com', '', '978987498', 'Curicó', 'Curicó', '', 'Factura', 105, '76048902-6', NULL);
INSERT INTO `personaempresa` VALUES (92, 22077734, '0', 'Gerd Dieter Deininger', 'A12 Turismo', 'Ruta 225, Km 40', 'reservas@latinarealchile.com', 'reservas@latinarealchile.com', '', '87661532', 'Puerto Varas', 'Puerto Varas', '', 'Factura', 105, '22077734-0', NULL);
INSERT INTO `personaempresa` VALUES (93, 6722638, '0', 'Germán Meier Rosemberg', 'A41 Servicios', 'Volcan SN', 'gmr1953@gmail.com', 'gmr1953@gmail.com', '', '93420695', 'Puerto Octay', 'Puerto Octay', '', 'Factura', 105, '6722638-0', NULL);
INSERT INTO `personaempresa` VALUES (94, 13591302, '2', 'Guillermo Grothe', 'A55 Obras Menores en Construcción, Mueblería', 'Camino al Cielo SN', 'guillermo.grothe@gmail.com', 'guillermo.grothe@gmail.com', '', '93970089', 'Puerto Octay', 'Puerto Octay', '', 'Factura', 105, '13591302-2', NULL);
INSERT INTO `personaempresa` VALUES (95, 4366931, '1', 'Hans Ziener Von Bauer', 'FOR Forestal', 'Fundo la Nueva Carintia, Ensenada', 'jpablobarcelog@gmail.com', 'jpablobarcelog@gmail.com', '', '652335337', 'Puerto Varas', 'Puerto Varas', '', 'Factura', 105, '4366931-1', NULL);
INSERT INTO `personaempresa` VALUES (96, 10891558, '7', 'Heriberto Enrique Subiabre Navarro', 'C54 Ferreteria y art. De buceo', 'Antonio Varas 870', 'heriberto.fermar@gmail.com', 'heriberto.fermar@gmail.com', '', '984306484', 'Puerto Montt', 'Puerto Montt', '', 'Factura', 105, '10891558-7', NULL);
INSERT INTO `personaempresa` VALUES (97, 7214455, '4', 'Hernán Patricio Schwerter Ricke', 'C06 Agrícola', 'Fundo Las Lomas s n', 'hernanschwerter@gmail.com', 'hernanschwerter@gmail.com', '', '981295019', 'Puerto Varas', 'Puerto Varas', '', 'Factura', 105, '7214455-4', NULL);
INSERT INTO `personaempresa` VALUES (98, 76541800, '3', 'Hormigones del Sur Ltda', 'C47 Elaboración de hormigones', 'Sector Pindapulli Rural, Ruta 5 Sur, km 1', 'emansilla@hormigonesdelsur.cl', 'emansilla@hormigonesdelsur.cl', '', '652566628', 'Dalcahue', 'Dalcahue', '', 'Factura', 105, '76541800-3', NULL);
INSERT INTO `personaempresa` VALUES (99, 76191977, '6', 'Hormitec Ingeniería Ltda', 'C65 Ingeniera', 'Ruta V 505, km 3,5, Modulo 1', 'cchavez@hormitec.cl', 'cchavez@hormitec.cl', '', '989231840', 'Puerto Montt', 'Alerce', '', 'Factura', 105, '76191977-6', NULL);
INSERT INTO `personaempresa` VALUES (100, 76204920, '1', 'Hotelera Peulla Limitada', 'HRE Hotel, Restaurant, excursiones', 'Peulla SN', 'facturacion@hotelpeulla.cl', 'facturacion@hotelpeulla.cl', '', '', 'Puerto Varas', 'Puerto Varas', '', 'Factura', 105, '76204920-1', NULL);
INSERT INTO `personaempresa` VALUES (101, 76102214, '8', 'Huertos del Ranco SpA', 'C25 Comercializadora de productos agrícolas', 'Fundo Diumen s n', 'administracion@huertosdelranco.cl', 'administracion@huertosdelranco.cl', '', '996795107', 'Río Bueno', 'Río Bueno', '', 'Factura', 105, '76102214-8', NULL);
INSERT INTO `personaempresa` VALUES (102, 6276537, '2', 'Hugo Patricio Moraga Fuentes', 'api Apícola', 'Ruta 225 Km 28.16', 'apisu@yahoo.com', 'apisu@yahoo.com', '', '998731582', 'Puerto Varas', 'Puerto Varas', '', 'Factura', 105, '6276537-2', NULL);
INSERT INTO `personaempresa` VALUES (103, 6373126, '9', 'Hugo Riquelme Royo', 'AVI Agrícola, Vivero', 'Camino Alerce km 2 Parcela Quilarayen', 'contacto@quilarayen.com', 'contacto@quilarayen.com', '', '976060471', 'Puerto Varas', 'Puerto Varas', '', 'Factura', 105, '6373126-9', NULL);
INSERT INTO `personaempresa` VALUES (104, 76245514, '5', 'IBA Ingenieria en Biotecnología Ambiental Empresa de Respons', 'C78 Obras de ingeniería', 'Parque Ivian 2, Los Lingues, Parcela 111', 'ccorrea@ibaingenieria.cl', 'ccorrea@ibaingenieria.cl', '', '652330184', 'Puerto Varas', 'Puerto Varas', '', 'Factura', 105, '76245514-5', NULL);
INSERT INTO `personaempresa` VALUES (105, 69252000, '9', 'Ilustre Municipalidad de Cochamó', 'C55 Fiscal', 'Santiago Bueras s n', 'azupuelo@yahoo.com', 'azupuelo@yahoo.com; fogonelqueche@gmail.com', '', '652350272', 'Cochamó', 'Cochamó', '', 'Factura', 105, '69252000-9', NULL);
INSERT INTO `personaempresa` VALUES (106, 69252200, '1', 'Ilustre Municipalidad de Hualaihué', 'C38 Departemento de educación', '21 de septiembre 450', 'nadia_ulloa@hotmail.com', 'nadia_ulloa@hotmail.com; andysilva.082@gmail.com', '', '990990761', 'Hualaihué', 'Contao', '', 'Factura', 105, '69252200-1', NULL);
INSERT INTO `personaempresa` VALUES (107, 69220301, '1', 'Ilustre Municipalidad de Llanquihue DAEM', 'C44 Educación', 'Erardo Werner 450', 'finanzas@daemllanquihue.cl', 'asistente.finanzas@daemllanquihue.cl', '', '652244500', 'Llanquihue', 'Llanquihue', '', 'Factura', 105, '69220301-1', NULL);
INSERT INTO `personaempresa` VALUES (108, 69220200, '7', 'Ilustre Municipalidad de Puerto Varas  D.A.E.M.', 'C44 Educación', 'Del Salvador 320', 'richard.gallegos@ptovaras.cl', 'cguenulef@ptovaras.cl; volavarria@ptovaras.cl', '', '652361327', 'Puerto Varas', 'Puerto Varas', '', 'Factura', 105, '69220200-7', NULL);
INSERT INTO `personaempresa` VALUES (109, 69210301, '7', 'Ilustre Municipalidad de Río Negro, Educación', 'C44 Educación', 'Vicuña Mackenna Esq. Paul Harris s n', 'mprieto@rionegrochile.cl', 'transparencia@rionegrochile.cl; marcelasoto@rionegrochile.cl', '', '64322214', 'Río Negro', 'Río Negro', '', 'Factura', 105, '69210301-7', NULL);
INSERT INTO `personaempresa` VALUES (110, 77424030, '6', 'Importadora y Comercializadora Floka Ltda', 'C62 Importadora', 'Av. Colon 0332', 'marg@surnet.cl', 'floka@telsur.cl', '', '652233107', 'Puerto Varas', 'Puerto Varas', '', 'Factura', 105, '77424030-6', NULL);
INSERT INTO `personaempresa` VALUES (111, 76481757, '5', 'Infante y Arriagada Limitada', 'mue Fabricación y Venta de Muebles', 'Línea Nueva Km 1,3', 'pazinfanteb@gmail.com', 'pazinfanteb@gmail.com', '', '997899000', 'Puerto Varas', 'Puerto Varas', '', 'Factura', 105, '76481757-5', NULL);
INSERT INTO `personaempresa` VALUES (112, 76248289, '4', 'Ingeniería e Informática Navis SPA', 'ING Ingeniería', 'Avenida 11 de Septiembre 1881 Of. 1910', 'agodoy@navis.cl', 'agodoy@navis.cl', '', '94385998', 'Providencia', 'Santiago', '', 'Factura', 105, '76248289-4', NULL);
INSERT INTO `personaempresa` VALUES (113, 76336672, '3', 'Ingeniería e Inversiones Raúl Barrera SPA', 'INA Ingeniería Naval', 'Parcela 7', 'raulbarrerarios@gmail.com', 'raulbarrerarios@gmail.com', '', '998695020', 'Puerto Varas', 'Puerto Varas', '', 'Factura', 105, '76336672-3', NULL);
INSERT INTO `personaempresa` VALUES (114, 76664954, '8', 'Ingeniería y Construcción Austral Home SPA', 'C79 Obras menores', 'Camino servidumbre A, con zanjón sn', 'ivanvargasrivas@gmail.com', 'ivanvargasrivas@gmail.com', '', '962508192', 'Puerto Varas', 'Puerto Varas', '', 'Factura', 105, '76664954-8', NULL);
INSERT INTO `personaempresa` VALUES (115, 78937110, '5', 'Inmobiliaria de la Cerda Otto Ltda', 'C67 Inmobiliaria e inversiones', 'Noruega 6677, Dpto 81', 'delacerda.g@gmail.com', 'delacerda.g@gmail.com', '', '228933271', 'Las Condes', 'Santiago', '', 'Factura', 105, '78937110-5', NULL);
INSERT INTO `personaempresa` VALUES (116, 99571250, '4', 'Inmobiliaria Porto Bello S.A.', '230 Crianza de Abejas, Cultivo, Producción Agrícola', 'Avenida Vitacura 5250 Depto 408', 'Maria.garcia@tef.cl; Andrea.poblete@tef.cl', 'Maria.garcia@tef.cl; Andrea.poblete@tef.cl', '', '993498516', 'Vitacura', 'Santiago', '', 'Factura', 105, '99571250-4', NULL);
INSERT INTO `personaempresa` VALUES (117, 76264990, 'k', 'Inmobiliaria Terramater Ltda', 'C13 Arriendo de inmuebles amoblados y semi amoblados', 'Galvarino Riveros 1277, Piso 2, Of. 13', 'joseule@iterramater.cl;elenadiaz@iterramater.cl', 'joseule@iterramater.cl;elenadiaz@iterramater.cl', '', '652637100', 'Castro', 'Castro', '', 'Factura', 105, '76264990-k', NULL);
INSERT INTO `personaempresa` VALUES (118, 76245233, '2', 'Inmobiliaria Valle Grande Ltda.', 'inm Inmobiliaria', 'Polpaico 037', 'rpanguinao@holdingpatagonia.cl', 'rpanguinao@holdingpatagonia.cl', '', '652270940', 'Puerto Montt', 'Puerto Montt', '', 'Factura', 105, '76245233-2', NULL);
INSERT INTO `personaempresa` VALUES (119, 96599370, '3', 'Inmobiliaria y de Inversiones Nueva York', 'C12 Arriendo de explotación bs. Inmuebles', 'Nueva York 52, dpto. 305', 'vcortes@inysa.com', 'vcortes@inysa.com', '', '26716013', 'Santiago', 'Santiago', '', 'Factura', 105, '96599370-3', NULL);
INSERT INTO `personaempresa` VALUES (120, 79797990, '2', 'Invermar S.A.', 'C36 Cultivo y reproducción de peces', 'Avenida Presidente Kennedy 5454, Piso 6 Of. 602', 'cvillarroel@invermar.cl', 'cvillarroel@invermar.cl', '', '652671390', 'Vitacura', 'Santiago', '', 'Factura', 105, '79797990-2', NULL);
INSERT INTO `personaempresa` VALUES (121, 76108466, '6', 'Inversiones Agroempresas', 'C97 Restaurant y agroturismo', 'Fundo los Maitenes, Quilanto s n', 'rancho@willnet.cl, recepcion@espantapajaros.cl', 'rancho@willnet.cl, recepcion@espantapajaros.cl', '', '652330049', 'Puerto Octay', 'Puerto Octay', '', 'Factura', 105, '76108466-6', NULL);
INSERT INTO `personaempresa` VALUES (122, 76214027, '6', 'Inversiones Agua del Palo Ltda.', 'C69 Inversiones', 'Agua del Palo 223', 'mwinkler_64@hotmail.com', 'mwinkler_64@hotmail.com', '', '991493885', 'Vitacura', 'Santiago', '', 'Factura', 105, '76214027-6', NULL);
INSERT INTO `personaempresa` VALUES (123, 76319677, '1', 'Inversiones Anulen Puerto Varas Ltda', 'C69 Inversiones', 'Huerfanos 1373, Of. 610', 'jazmin.manriquez@anulen.cl', 'jazmin.manriquez@anulen.cl', '', '976979066', 'Santiago', 'Santiago', '', 'Factura', 105, '76319677-1', NULL);
INSERT INTO `personaempresa` VALUES (124, 78796670, '5', 'Inversiones Bellavista Ltda', 'IYA Inversiones y Arquitectura', 'Av. Manquehue Norte 151 Of 508', 'asandovale@asandoval.cl', 'asandovale@asandoval.cl', '', '990304242', 'Las Condes', 'Santiago', '', 'Factura', 105, '78796670-5', NULL);
INSERT INTO `personaempresa` VALUES (125, 76336580, '8', 'Inversiones e Inmobiliaria Siloc S.A.', 'C71 Inversiones y administración de inmuebles', 'Calle Bilbao 1129, Of. 303', 'locke.tiger@gmail.com', 'locke.tiger@gmail.com', '', '652542218', 'Osorno', 'Osorno', '', 'Factura', 105, '76336580-8', NULL);
INSERT INTO `personaempresa` VALUES (126, 76477359, '4', 'Inversiones Finlandia Ltda.', 'PRO Propiedades', 'Imperial 092', 'patriciosaavedraduval@gmail.com', 'patriciosaavedraduval@gmail.com', '', '977786303', 'Puerto Varas', 'Puerto Varas', '', 'Factura', 105, '76477359-4', NULL);
INSERT INTO `personaempresa` VALUES (127, 76548960, '1', 'Inversiones Loreto Alejandra Mendez Rojas E.I.R.L.', 'EMI Emisora de Radio, Restaurant y Eventos', 'Aereopuerto SN', 'alejandra@radiocochamo.cl', 'alejandra@radiocochamo.cl', '', '957534720', 'Cochamó', 'Cochamó', '', 'Factura', 105, '76548960-1', NULL);
INSERT INTO `personaempresa` VALUES (128, 76174186, '1', 'Inversiones May-Ling SA', 'ITU Inversiones y Turismo', 'Ruta 225 Km 38.6 Parcela 35', 'recepcion@mipymepro.cl', 'recepcion@mipymepro.cl', '', '96992776', 'Puerto Varas', 'Puerto Varas', '', 'Factura', 105, '76174186-1', NULL);
INSERT INTO `personaempresa` VALUES (129, 76160664, '6', 'Inversiones Puelmapu S.A.', 'C37 Cultivos', 'La Capilla Sector San Rafael Lote C', 'andrea.sotonavarro@mejillon.cl', 'andrea.sotonavarro@mejillon.cl', '', '96306036', 'Calbuco', 'Calbuco', '', 'Factura', 105, '76160664-6', NULL);
INSERT INTO `personaempresa` VALUES (130, 76240036, '7', 'Inversiones Quinvi Ltda.', 'A40 Sociedad de Inversiones', 'Fuenteovejuna 1813', 'jaimequinterosc@gmail.com', 'jaimequinterosc@gmail.com', '', '98260498', 'Las Condes', 'Santiago', '', 'Factura', 105, '76240036-7', NULL);
INSERT INTO `personaempresa` VALUES (131, 76455801, '4', 'Inversiones y Turismo Puerto Rosales', 'A12 Turismo', 'Diego de Deza 1409', 'turismomaymapu@gmail.com', 'turismomaymapu@gmail.com; jmackenney@clc.cl', '', '66553618', 'Las Condes', 'Santiago', '', 'Factura', 105, '76455801-4', NULL);
INSERT INTO `personaempresa` VALUES (132, 76130693, '6', 'Irlanda Ltda', 'C30 Constructora', 'Llau Llao, 2do Sector, Parcela 5', 'segoviamunoz_j@yahoo.es', 'segoviamunoz_j@yahoo.es', '', '961578954', 'Castro', 'Castro', '', 'Factura', 105, '76130693-6', NULL);
INSERT INTO `personaempresa` VALUES (133, 7799078, 'k', 'Jaime Eduardo Zumelzo Henriquez', 'C94 Residencial', 'Carretera Austral km 55', 'luzmaryn@hotmail.com', 'luzmaryn@hotmail.com', '', '998705772', 'Hualaihué', 'Contao', '', 'Factura', 105, '7799078-k', NULL);
INSERT INTO `personaempresa` VALUES (134, 9036055, '8', 'Jaime Gebauer Bittner', 'C06 Agrícola', 'Fundo Los Pinos', 'jgebauerb@gmail.com', 'jgebauerb@gmail.com', '', '995791903', 'Puerto Octay', 'Puerto Octay', '', 'Factura', 105, '9036055-8', NULL);
INSERT INTO `personaempresa` VALUES (135, 76153587, '0', 'Jardines del Sur Ltda', 'JIN Jardines Infantiles', 'Loteo Don Rafael, Parcela 22', 'jardinthegreenvalley@gmail.com', 'jardinthegreenvalley@gmail.com', '', '978802502', 'Puerto Montt', 'Puerto Montt', '', 'Factura', 105, '76153587-0', NULL);
INSERT INTO `personaempresa` VALUES (136, 9640852, '8', 'Jorge Matzner Gebauer', 'C06 Agrícola', 'Fundo Río Blanco', 'jorge_matzner@yahoo.es', 'jorge_matzner@yahoo.es', '', '994434830', 'Puerto Octay', 'Cascadas', '', 'Factura', 105, '9640852-8', NULL);
INSERT INTO `personaempresa` VALUES (137, 7212203, '8', 'José Ricardo Torres Garay', 'C06 Agrícola', 'Quilquico s n', 'rtorres@telsur.cl', 'rtorres@telsur.cl', '', '992350446', 'Castro', 'Castro', '', 'Factura', 105, '7212203-8', NULL);
INSERT INTO `personaempresa` VALUES (138, 11414055, '4', 'Juan Andrade Macias', 'A22 Apicultura - Fabricación de Maquinaría', 'Vilupulli SN', 'juanandrade_m@hotmail.com', 'juanandrade_m@hotmail.com', '', '82868210', 'Chonchi', 'Chonchi', '', 'Factura', 105, '11414055-4', NULL);
INSERT INTO `personaempresa` VALUES (139, 7644227, '4', 'Juan Enrique Matamala Hernandez', 'A04 Supermercado', 'Cochamó SN', 'enriquematamala7@gmail.com', 'enriquematamala7@gmail.com; diazpentz@gmail.com', '', '221960701', 'Cochamó', 'Cochamó', '', 'Factura', 105, '7644227-4', NULL);
INSERT INTO `personaempresa` VALUES (140, 76063825, '0', 'Katari Hotelería Ltda.', 'C60 Hotelería', 'Renato Sanchez 4270, Las Condes Santiago', 'recepcion@tierrachiloe.com', 'andres@tierrachiloe.com; deysi@tierrachiloe.com; recepcion@tierrachiloe.com', '', '223948000', 'Providencia', 'Santiago', '', 'Factura', 105, '76063825-0', NULL);
INSERT INTO `personaempresa` VALUES (141, 76688583, '7', 'Kaweshkar SpA.', 'SRA Servicios Relacionados con la Acuicultura', 'Vocal Km. 5 Camino a Maullín', 'mmunoz@kaweshkar.cl; milton.oyarzo@kaweshkar.cl', 'mmunoz@kaweshkar.cl; milton.oyarzo@kaweshkar.cl', '', '652711319', 'Maullín', 'Maullín', '', 'Factura', 105, '76688583-7', NULL);
INSERT INTO `personaempresa` VALUES (142, 76692031, '4', 'Konvex Ingenieria SpA', 'KON Maestranza, Mantención Industrial y Servicios Acuícolas', 'Sector Piruquina Lote 11', 'Pleiva@konvex.cl', 'Pleiva@konvex.cl', '', '', 'Castro', 'Castro', '', 'Factura', 105, '76692031-4', NULL);
INSERT INTO `personaempresa` VALUES (143, 4612678, '5', 'Kurt Reinaldo Klocker Scheel', 'C06 Agrícola', 'Fundo Paraguay', 'kurtrb@yahoo.com', 'kurtrb@yahoo.com', '', '652330063', 'Frutillar', 'Frutillar', '', 'Factura', 105, '4612678-5', NULL);
INSERT INTO `personaempresa` VALUES (144, 76541036, '3', 'La Cachimba SpA', 'Hos Hosteria', 'Avenida Andrés Bello 2687', 'ximenagourmet@gmail.com', 'ximenagourmet@gmail.com', '', '994380781', 'Las Condes', 'Santiago', '', 'Factura', 105, '76541036-3', NULL);
INSERT INTO `personaempresa` VALUES (145, 77660190, 'k', 'Lacteos Winkler Ltda', 'C64 Industria lactea', 'Fundo El Encanto s n', 'lacteosfinanzas@hotmail.cl', 'lacteos.winklerfrutillar@gmail.com; lacteosfinanzas@hotmail.cl', '', '652421777', 'Frutillar', 'Frutillar', '', 'Factura', 105, '77660190-k', NULL);
INSERT INTO `personaempresa` VALUES (146, 79985510, '0', 'Lapal Ltda.', 'FAF Fábrica Artículos Tocador y Farmacia', 'Pasaje Pinochet', 'lapal.raul@gmail.com', 'lapal.raul@gmail.com', '', '', 'Maipú', 'Santiago', '', 'Factura', 105, '79985510-0', NULL);
INSERT INTO `personaempresa` VALUES (147, 15926816, '0', 'Leslie Uribe Miranda', 'A08 Transporte', 'Vilupulli Rural SN', 'uribemiranda@gmail.com', 'uribemiranda@gmail.com', '', '952159212', 'Chonchi', 'Chonchi', '', 'Factura', 105, '15926816-0', NULL);
INSERT INTO `personaempresa` VALUES (148, 76752919, '8', 'Lomas de Maullín SpA', 'FMM Fábrica de Muebles', 'Camino las Lomas km 0,8', 'hruiznayem@gmail.com', 'hruiznayem@gmail.com', '', '965957615', 'Puerto Varas', 'Puerto Varas', '', 'Factura', 105, '76752919-8', NULL);
INSERT INTO `personaempresa` VALUES (149, 76244256, '6', 'Malta Chocolate Ltda.', 'CER Micro Cervecería', 'Ruta 225. Km.7.  Lote 24c', 'cerveceriamaltachocolate@gmail.com', 'cerveceriamaltachocolate@gmail.com', '', '995393631', 'Puerto Varas', 'Puerto Varas', '', 'Factura', 105, '76244256-6', NULL);
INSERT INTO `personaempresa` VALUES (150, 10379082, '4', 'Marcela Yanina Miranda Díaz', 'A08 Transporte', 'Vilupulli Rural SN', 'mirandadiaz11@gmail.com', 'mirandadiaz11@gmail.com', '', '81590454', 'Castro', 'Castro', '', 'Factura', 105, '10379082-4', NULL);
INSERT INTO `personaempresa` VALUES (151, 6040122, '5', 'Margot Ingrid Dietz Gädicke', 'HYC Hostal y Cabañas', 'Ruta 215 Km 58', 'reservas@lasjuntas.com; a.frodietz@gmail.com', 'reservas@lasjuntas.com; a.frodietz@gmail.com', '', '998021059', 'Puyehue', 'Osorno', '', 'Factura', 105, '6040122-5', NULL);
INSERT INTO `personaempresa` VALUES (152, 10024952, '9', 'Maria José Lira Turpaud', 'C60 Hotelería', 'Nercon Alto s n', 'samuelvelascorubio@gmail.com', 'samuelvelascorubio@gmail.com', '', '997426163', 'Castro', 'Castro', '', 'Factura', 105, '10024952-9', NULL);
INSERT INTO `personaempresa` VALUES (153, 7791376, '9', 'Mario Chuescas Martinez', 'C79 Obras menores', 'Lote 12, Sector Lagunitas', 'mario.chuescas@gmail.com', 'mario.chuescas@gmail.com', '', '977823423', 'Puerto Montt', 'Puerto Montt', '', 'Factura', 105, '7791376-9', NULL);
INSERT INTO `personaempresa` VALUES (154, 8920084, '9', 'Mario Edmundo Bohle Rouge', 'ATE Agrícola, Transporte y Estación de Servicio', 'km 48, la Ensenada', 'mariobohler@gmail.com', 'mariobohler@gmail.com', '', '998212934', 'Puerto Varas', 'Ensenada', '', 'Factura', 105, '8920084-9', NULL);
INSERT INTO `personaempresa` VALUES (155, 6270533, '7', 'Mario Humberto Puchi Acuña', 'C06 Agrícola', 'Polpaico 037', 'tesoreria@holdingpatagonia.cl', 'tesoreria@holdingpatagonia.cl', '', '652270940', 'Puerto Montt', 'Puerto Montt', '', 'Factura', 105, '6270533-7', NULL);
INSERT INTO `personaempresa` VALUES (156, 96778860, '0', 'Metrohold S.A.', 'C69 Inversiones', 'Hendaya 60 Of. 202', 'pdhainaut@micp.cl', 'pdhainaut@micp.cl', '', '', 'Las Condes', 'Santiago', '', 'Factura', 105, '96778860-0', NULL);
INSERT INTO `personaempresa` VALUES (157, 12294087, 'K', 'Miguel Ángel Donoso Moreira', 'caf Cafetería', 'Petrohué sn', 'donosomiguel01@hotmail.com', 'donosomiguel01@hotmail.com', '', '973054250', 'Puerto Varas', 'Puerto Varas', '', 'Factura', 105, '12294087-K', NULL);
INSERT INTO `personaempresa` VALUES (158, 76089075, '8', 'Minimarket Panadería y Pastelería Marcos Toledo Aburto E.I.R', 'C80 Panadería', 'Calle A 542, Esquina Mataveri', 'delice.mtoledo@gmail.com', 'delice.mtoledo@gmail.com', '', '977063639', 'Puerto Montt', 'Puerto Montt', '', 'Factura', 105, '76089075-8', NULL);
INSERT INTO `personaempresa` VALUES (159, 17378756, '1', 'Minimarket Yates', 'mmk Minimarket', 'Camino Río Puelo s n. Km 90', 'erazo_lucia@hotmail.com', 'erazo_lucia@hotmail.com', '', '983585755', 'Cochamó', 'Cochamó', '', 'Factura', 105, '17378756-1', NULL);
INSERT INTO `personaempresa` VALUES (160, 13738969, 'k', 'Nelson Moreno Barria', 'C57 Hospedaje', 'Río Puelo SN', 'njmorenobarria@gmail.com; reyeslinett@gmail.com', 'njmorenobarria@gmail.com; reyeslinett@gmail.com', '', '92227358', 'Cochamó', 'Cochamó', '', 'Factura', 105, '13738969-k', NULL);
INSERT INTO `personaempresa` VALUES (161, 2589240, '2', 'Nestor Holzapfel Gross', 'C59 Hotel', 'Ruta 225, Camino Ensenada km 43', 'proser@surnet.cl', 'proser@surnet.cl', '', '652212028', 'Puerto Varas', 'Ensenada', '', 'Factura', 105, '2589240-2', NULL);
INSERT INTO `personaempresa` VALUES (162, 6304385, '0', 'Norberto Yunge Scheel', 'C06 Agrícola', 'Totoral s n', 'lorenayungeb@gmail.com', 'lorenayungeb@gmail.com', '', '9 84196092', 'Llanquihue', 'Llanquihue', '', 'Factura', 105, '6304385-0', NULL);
INSERT INTO `personaempresa` VALUES (163, 79729070, 'k', 'Opitz y Cárdenas Ltda.', 'ATT Asesorías Tributarias', 'Del Salvador 553.  Piso 2', 'popitz@opitzycardenas.cl', 'popitz@opitzycardenas.cl', '', '998690667', 'Puerto Varas', 'Puerto Varas', '', 'Factura', 105, '79729070-k', NULL);
INSERT INTO `personaempresa` VALUES (164, 8406910, '8', 'Pablo Zuñiga Torres', 'A03 Servicios turisticos y hospedaje', 'Río Puelo s n', 'puelosiempreverde@gmail.com', 'puelosiempreverde@gmail.com', '', '976687308', 'Cochamó', 'Cochamó', '', 'Factura', 105, '8406910-8', NULL);
INSERT INTO `personaempresa` VALUES (165, 76405306, '0', 'Parques Australes SPA', 'CDO constructora de obras menores', 'Los Alpes 100 Oficina 2', 'psaumann@gmail.com', 'psaumann@gmail.com', '', '993383243', 'Puerto Varas', 'Puerto Varas', '', 'Factura', 105, '76405306-0', NULL);
INSERT INTO `personaempresa` VALUES (166, 76089356, '0', 'Patagon Land S.A.', 'C68 Inmobiliario', 'AURELIO GONZALEZ 3390 PISO -1', 'mhernandez@patagonland.cl', 'jvera@patagonland.cl; oficinapartes@patagonland.cl', '', '02-233778', 'Vitacura', 'Santiago', '', 'Factura', 105, '76089356-0', NULL);
INSERT INTO `personaempresa` VALUES (167, 76149411, '2', 'Patagonia Mountain S.A.', 'A18 Centro de Montaña', 'Camino Volcán Osorno Km. 14.2', 'contabilidad@volcanosorno.com; stgovidal@gmail.com', 'contabilidad@volcanosorno.com', '', '652566624', 'Puerto Varas', 'Ensenada', '', 'Factura', 105, '76149411-2', NULL);
INSERT INTO `personaempresa` VALUES (168, 77840820, '1', 'PC Service y Cía Ltda', 'A15 Venta y arriendo de computadores', 'Sucre 1321', 'rodrigogalvez@pc-service.cl', 'rodrigogalvez@pc-service.cl; francisco.galvez@pc-service.cl', '', '02-3283400', 'Ñuñoa', 'Santiago', '', 'Factura', 105, '77840820-1', NULL);
INSERT INTO `personaempresa` VALUES (169, 76280228, '7', 'Pelayo García Turismo EIRL', 'A12 Turismo', 'Ruta 225 Km 26.8', 'xpelayo@gmail.com', 'xpelayo@gmail.com', '', '957012145', 'Puerto Varas', 'Ensenada', '', 'Factura', 105, '76280228-7', NULL);
INSERT INTO `personaempresa` VALUES (170, 5549508, '4', 'Perla Kohan MarkeLevic', 'CFS Cabañas y Fuente de Soda', 'Caminoi Lyncay SN KM 1 - Puqueldón', 'yayanesleneslemuy@gmail.com', 'yayanesleneslemuy@gmail.com', '', '988616462', 'Puqueldón', 'Puqueldón', '', 'Factura', 105, '5549508-4', NULL);
INSERT INTO `personaempresa` VALUES (171, 84764200, '9', 'Pesquera Apiao SA', 'A38 Pesquera', 'Playa Sur Rilan', 'pvelasquez@chiloeseafoods.com', 'felix@chiloeseafood.com', '', '83600370', 'Castro', 'Rilán', '', 'Factura', 105, '84764200-9', NULL);
INSERT INTO `personaempresa` VALUES (172, 78516790, '2', 'Pinturas Automotrices Ltda', 'A05 Taller', 'Cardonal Pasaje San Andres 60', 'autovaldjf@gmail.com', 'autovaldjf@gmail.com', '', '652256043', 'Puerto Montt', 'Puerto Montt', '', 'Factura', 105, '78516790-2', NULL);
INSERT INTO `personaempresa` VALUES (173, 76658930, '8', 'Plastisur Ltda', 'C23 Comercializadora', 'Las Compuertas, Parcela 8', 'reciclajes@plastisurspa.cl', 'reciclajes@plastisurspa.cl', '', '534037', 'Dalcahue', 'Dalcahue', '', 'Factura', 105, '76658930-8', NULL);
INSERT INTO `personaempresa` VALUES (174, 76118106, '8', 'Productora y Comercializadora Necton SPA', 'A46 Asesorías', 'Santa Rosa 560 Of. 27', 'pandonie@necton.cl', 'pandonie@necton.cl', '', '652234203', 'Puerto Varas', 'Puerto Varas', '', 'Factura', 105, '76118106-8', NULL);
INSERT INTO `personaempresa` VALUES (175, 76169990, '3', 'Promotora de Eventos el Embrujo Ltda.', 'A43 Restaurante y Cabañas', 'Thompson 244B', 'trabmar7@gmail.com', 'trabmar7@gmail.com; ecartesl@gmail.com', '', '', 'Castro', 'Castro', '', 'Factura', 105, '76169990-3', NULL);
INSERT INTO `personaempresa` VALUES (176, 76326429, '7', 'Quantum Research Ltda.', 'FAR Servicios de Investigación en Farmacología', 'Dr. Otto Bader 810', 'cbreton@quantumresearch.cl', 'cbreton@quantumresearch.cl;', '', '542582481', 'Puerto Varas', 'Puerto Varas', '', 'Factura', 105, '76326429-7', NULL);
INSERT INTO `personaempresa` VALUES (177, 76493435, '0', 'Quebrada Verde SPA', 'ACA Arriendo de Cabañas', 'Km 6.5 Ruta 225', 'mcuadradof@gmail.com', 'mcuadradof@gmail.com', '', '992308209', 'Puerto Varas', 'Puerto Varas', '', 'Factura', 105, '76493435-0', NULL);
INSERT INTO `personaempresa` VALUES (178, 79895320, '6', 'Rafael Achondo y Cía Ltda', 'CS Corredores de Seguros', 'Guardia Vieja 255 Oficina 1206', 'rafael.achondo@achondo.cl', 'rafael.achondo@achondo.cl', '', '222323766', 'Providencia', 'Santiago', '', 'Factura', 105, '79895320-6', NULL);
INSERT INTO `personaempresa` VALUES (179, 8354643, '3', 'Ramón Werner Bittner', 'C06 Agrícola', 'Fundo Amanecer', 'ramwerner@gmail.com', 'ramwerner@gmail.com', '', '', 'Llanquihue', 'Llanquihue', '', 'Factura', 105, '8354643-3', NULL);
INSERT INTO `personaempresa` VALUES (180, 76248177, '4', 'Re Constructora Ltda.', 'C29 Construcción', 'Quebrada Honda', 'paulalope@gmail.com', 'paulalope@gmail.com', '', '989842213', 'Llanquihue', 'Llanquihue', '', 'Factura', 105, '76248177-4', NULL);
INSERT INTO `personaempresa` VALUES (181, 76085839, '0', 'Redes Kaweshkar Ltda', 'C99 Servicios acuícolas', 'Icalma 1020, Villa Antillanca', 'milton.oyarzo@kaweshkar.cl', 'mmunoz@kaweshkar.cl; milton.oyarzo@kaweshkar.cl', '', '652711319', 'Puerto Montt', 'Puerto Montt', '', 'Factura', 105, '76085839-0', NULL);
INSERT INTO `personaempresa` VALUES (182, 6032787, '4', 'René Opitz Ruiz', 'C06 Agrícola', 'Fundo Río Pescado', 'fundoriopescado@gmail.com', 'fundoriopescado@gmail.com', '', '996425298', 'Puerto Varas', 'Puerto Varas', '', 'Factura', 105, '6032787-4', NULL);
INSERT INTO `personaempresa` VALUES (183, 76490840, '6', 'Restaurant Tique Limitada', 'C96 Restaurant', 'Alto Puelo s n', 'cocareyes@andespatagonia.cl', 'cocareyes@andespatagonia.cl', '', '995491069', 'Cochamó', 'Cochamó', '', 'Factura', 105, '76490840-6', NULL);
INSERT INTO `personaempresa` VALUES (184, 76676410, 'k', 'Restaurante Ramirez y Elgueta Ltda.', 'RSR Restaurante', 'Km 42.5, Ruta 225', 'contacto@donsalmon.cl', 'contacto@donsalmon.cl', '', '', 'Puerto Varas', 'Ensenada', '', 'Factura', 105, '76676410-k', NULL);
INSERT INTO `personaempresa` VALUES (185, 5826569, '1', 'Ricardo Edwards Braun', 'A58 abogado', 'Providencia 2653 Of 703', 'redwards@elm.cl', 'redwards@elm.cl', '', '22321805', 'Providencia', 'Santiago', '', 'Factura', 105, '5826569-1', NULL);
INSERT INTO `personaempresa` VALUES (186, 10756805, '0', 'Robert Catalán Miller', 'A12 Turismo', 'Sector El Cobre', 'tianomi@gmail.com', 'tianomi@gmail.com', '', '9 82275152', 'Hualaihué', 'Hornopirén', '', 'Factura', 105, '10756805-0', NULL);
INSERT INTO `personaempresa` VALUES (187, 77296600, '8', 'Rojas y Sanchez Limitada', 'SIS Servicios Industria Salmonera', 'Panamericana Sur SN Km 1209', 'miguelrojas.aquachiloe@gmail.com', 'miguelrojas.aquachiloe@gmail.com; sosanmar17@yahoo.es; sonia@telsur.cl', '', '652 671605', 'Chonchi', 'Chonchi', '', 'Factura', 105, '77296600-8', NULL);
INSERT INTO `personaempresa` VALUES (188, 76458580, '1', 'Rosler y Guevara Ltda.', 'A19 Agencia de Turismo', 'Ruta v69 Km 26,8 Termas de Ralún', 'caro@kinehuen.com', 'caro@kinehuen.com; dtekinehuen@desis.cl', '', '', 'Puerto Varas', 'Puerto Varas', '', 'Factura', 105, '76458580-1', NULL);
INSERT INTO `personaempresa` VALUES (189, 7958929, '2', 'Rudy Harald Plagemann Schroeder', 'A13 Turismo y cabañas', 'Ruta 225, Camino Ensenada km 43', 'pauplag@gmail.com', 'rplagemann@gmail.com', '', '652212070', 'Puerto Varas', 'Ensenada', '', 'Factura', 105, '7958929-2', NULL);
INSERT INTO `personaempresa` VALUES (190, 79910700, '7', 'Salmones Caleta Bay S.A.', 'ENG Reproducción, Engorda, Comercialización y Exp. de Peces', 'Pitreño SN', 'facturas@caletabay.cl', 'dcid@caletabay.cl; secretaria@caletabay.cl; facturas@caletabay.cl', '', '642219400', 'Lago Ranco', 'Lago Ranco', '', 'Factura', 105, '79910700-7', NULL);
INSERT INTO `personaempresa` VALUES (191, 76065596, '1', 'Salmones Camanchaca S.A.', 'C02 Acuícola en General, Cultivos de Salmones y otras Especies', 'Av. Diego Portales 2000, Piso 13', 'ostormesan@camanchaca.cl', 'efacturassalmones@camanchaca.cl', '', '652327200', 'Puerto Montt', 'Puerto Montt', '', 'Factura', 105, '76065596-1', NULL);
INSERT INTO `personaempresa` VALUES (192, 79891160, '0', 'Salmones Multiexport SA', 'sal MAYORISTAS DE PRODUCTOS DEL MAR', 'Av. Cardonal 2501', 'rbarra@multiexportfoods.com', 'rfigueroa@multiexportfoods.com; controlpago@multiexportfoods.com', '', '652483700', 'Puerto Montt', 'Puerto Montt', '', 'Factura', 105, '79891160-0', NULL);
INSERT INTO `personaempresa` VALUES (193, 96937970, '8', 'Salmonet S.A.', 'A06 Taller de redes', 'Camino Parque Nacional km 3,7', 'hradic@salmonet.cl', 'csantana@salmonet.cl; hradic@salmonet.cl', '', '994997744', 'Chonchi', 'Chonchi', '', 'Factura', 105, '96937970-8', NULL);
INSERT INTO `personaempresa` VALUES (194, 76436140, '7', 'Sandra Yañez del Solar E.I.R.L', 'A08 Transporte', 'Llicaldad SN', 'syanez@salmones-dechile.cl', 'syanez@salmones-dechile.cl', '', '68202817', 'Castro', 'Castro', '', 'Factura', 105, '76436140-7', NULL);
INSERT INTO `personaempresa` VALUES (195, 77705640, '9', 'Semillas Llanquihue Limitada', 'C06 Agrícola', 'Imperial 0690 D402', 'semillas@sll.cl', 'semillas@sll.cl; contabilidad@sll.cl', '', '652438930', 'Puerto Varas', 'Puerto Varas', '', 'Factura', 105, '77705640-9', NULL);
INSERT INTO `personaempresa` VALUES (196, 7138101, '3', 'Sergio Pérez Delgado', 'C60 Hotelería', 'Quicavi Rural SN Pasaje 1', 'hostalloscahuelesquicavi@gmail.com', 'hostalloscahuelesquicavi@gmail.com', '', '992402543', 'Quemchi', 'Quemchi', '', 'Factura', 105, '7138101-3', NULL);
INSERT INTO `personaempresa` VALUES (197, 76187607, '4', 'Servicios e Inversiones IRC Ltda', 'A02 Servicios operacionales', 'Ruta 5 Sur, km 1013 Sector la Laja', 'gerencia@chang.cl', 'gerencia@chang.cl', '', '652528139', 'Puerto Varas', 'Puerto Varas', '', 'Factura', 105, '76187607-4', NULL);
INSERT INTO `personaempresa` VALUES (198, 76521560, '9', 'Servicios Integrales del Sur S.A', 'A28 Prestación de Servicios', 'Ruta 225 Km 39,5 P.10', 'sis.ptovaras@gmail.com', 'sis.ptovaras@gmail.com', '', '82342621', 'Puerto Varas', 'Puerto Varas', '', 'Factura', 105, '76521560-9', NULL);
INSERT INTO `personaempresa` VALUES (199, 76380999, '4', 'Servicios Mecánicos Luis Gastón Sánchez Muñoz EIRL', 'A41 Servicios', 'Petrohue SN', 'serviciosnautico@gmail.com', 'serviciosnautico@gmail.com', '', '', 'Puerto Varas', 'Puerto Varas', '', 'Factura', 105, '76380999-4', NULL);
INSERT INTO `personaempresa` VALUES (200, 76620992, '0', 'Servicios Médicos Fica Toledo Limitada', 'A01 Servicios médicos', 'Nalhuitad SN', 'mficamd@gmail.com', 'mficamd@gmail.com', '', '981553755', 'Chonchi', 'Chonchi', '', 'Factura', 105, '76620992-0', NULL);
INSERT INTO `personaempresa` VALUES (201, 78110680, '1', 'Siete Inversiones Ltda', 'C06 Agrícola', 'Fundo Bulnes Lote 4', 'ahinostroza@7inversiones.cl', 'ahinostroza@7inversiones.cl', '', '961910676', 'Puerto Octay', 'Puerto Octay', '', 'Factura', 105, '78110680-1', NULL);
INSERT INTO `personaempresa` VALUES (202, 76250953, '9', 'Soc. Com. Pincheira y Villarroel Ltda', 'C60 Hotelería', 'Ruta 225 Km 39,5 Parcela 5 D Cruce Navarro, Ensenada', 'contacto@biosferavolcanicalodge.cl', 'contacto@biosferavolcanicalodge.cl', '', '', 'Puerto Varas', 'Puerto Varas', '', 'Factura', 105, '76250953-9', NULL);
INSERT INTO `personaempresa` VALUES (203, 77445750, 'k', 'Soc. Com. Y de Inv. Lonquen Ltda', 'C26 Comercio', 'Hijuela s n Trapen', 'comex@lonquenchile.cl', 'comex@lonquenchile.cl; contabilidad@lonquenchile.cl', '', '02-8945312', 'Puerto Montt', 'Puerto Montt', '', 'Factura', 105, '77445750-k', NULL);
INSERT INTO `personaempresa` VALUES (204, 78817860, '3', 'Soc. Constructora Hurtado Ltda', 'C29 Construcción', 'Manzana L, Sitio 10 Cardonal', 'contador@constructorahurtado.cl; ', 'contador@constructorahurtado.cl; mvargas@empresashurtado.cl', '', '652250788', 'Puerto Montt', 'Puerto Montt', '', 'Factura', 105, '78817860-3', NULL);
INSERT INTO `personaempresa` VALUES (205, 77431760, '0', 'Soc. De Inversiones Lago Sofia Ltda', 'C91 Reproducción de peces y mariscos', 'Chinquihue km 12', 'jperalta@lagosofia.cl', 'johana.diaz@lagosofia.cl', '', '652201930', 'Puerto Montt', 'Puerto Montt', '', 'Factura', 105, '77431760-0', NULL);
INSERT INTO `personaempresa` VALUES (206, 76303280, '9', 'Soc. Hotelera Quincho S.A.', 'C60 Hotelería', 'Ruta 225, Camino Ensenada km 7,5', 'administracion@quinchocasahotel.cl', 'administracion@quinchocasahotel.cl', '', '652330737', 'Puerto Varas', 'Puerto Varas', '', 'Factura', 105, '76303280-9', NULL);
INSERT INTO `personaempresa` VALUES (207, 76077428, '6', 'Soc. Transportes Pinar Ltda', 'A08 Transporte', 'Ruta 5 Norte SN', 'operaciones@transportespinar.cl', 'mpinar@transportespinar.cl; operaciones@transportespinar.cl', '', '994798145', 'Castro', 'Castro', '', 'Factura', 105, '76077428-6', NULL);
INSERT INTO `personaempresa` VALUES (208, 76135571, '6', 'Soc. Turistica Las Cruces Ltda', 'C09 Alojamiento y eventos', 'Av. Costanera s n', 'cabanasquincholago@gmail.com', 'cabanasquincholago@gmail.com', '', '', 'Llanquihue', 'Llanquihue', '', 'Factura', 105, '76135571-6', NULL);
INSERT INTO `personaempresa` VALUES (209, 78452070, '6', 'Sociedad Agrícola El Reinal Ltda.', 'C06 Agrícola', 'Fundo Maule Lote 6', 'mangelesgonzalezm@hotmail.com', 'mundurraga@elreinal.cl; mangelesgonzalezm@hotmail.com', '', '74783243', 'Fresia', 'Fresia', '', 'Factura', 105, '78452070-6', NULL);
INSERT INTO `personaempresa` VALUES (210, 76047022, '8', 'Sociedad Agrícola Quelén Ltda', 'C34 Cría de ganado bovino', 'Gertrudis Echeñique 394', 'ganaderas@perezcruz.com', 'ganaderas@perezcruz.com; aquelen@perezcruz.com', '', '02-26551310', 'Las Condes', 'Santiago', '', 'Factura', 105, '76047022-8', NULL);
INSERT INTO `personaempresa` VALUES (211, 76132957, 'k', 'Sociedad Agrícola y Ganadera Lacteos Tronador Ltda', 'C83 Producción de leche, cría ganado bovina', 'Fundo Tronador, Camino Coihueco s n km 14,5', 'cceballos@lacteostronador.cl', 'vmera@meritus.cl; jbarria@lacteostronador.cl; jgarces@lacteostronador.cl', '', '652566690', 'Purranque', 'Purranque', '', 'Factura', 105, '76132957-k', NULL);
INSERT INTO `personaempresa` VALUES (212, 88751000, '8', 'Sociedad Agropecuaria Erimar Ltda', 'C06 Agrícola', 'Fundo Punta Larga', 'mariowetzel@puntalarga.cl', 'mariowetzel@puntalarga.cl', '', '652330450', 'Frutillar', 'Frutillar', '', 'Factura', 105, '88751000-8', NULL);
INSERT INTO `personaempresa` VALUES (213, 76259365, '3', 'Sociedad Anestésico Quirúrgica SAQ Ltda', 'A01 Servicios médicos', 'Freire 759 Interior', 'ooalvarezo@gmail.com', 'ooalvarezo@gmail.com', '', '78890714', 'Castro', 'Castro', '', 'Factura', 105, '76259365-3', NULL);
INSERT INTO `personaempresa` VALUES (214, 77512190, '4', 'Sociedad Campo Aventura Ltda.', 'htl Hoteles', 'Valle Concha SN', 'alan.montecinos2@gmail.com', 'alanmontecinos2@gmail.com', '', '998792662', 'Cochamó', 'Cochamó', '', 'Factura', 105, '77512190-4', NULL);
INSERT INTO `personaempresa` VALUES (215, 96600190, '9', 'Sociedad Comercial Río Grande S.A.', 'C06 Agrícola', 'Santa Magdalena 75, Of. 1201', 'ealvano@esmar.cl', 'martinu1201@gmail.com', '', '998268552', 'Providencia', 'Santiago', '', 'Factura', 105, '96600190-9', NULL);
INSERT INTO `personaempresa` VALUES (216, 76173103, '3', 'Sociedad Comercial Saavedra y Vidal Limitada', 'A32 Transporte de Carga por Carretera', 'Loteo El Nogal Parcela   19 Totoral Rural', 'trans.logis_chiloe@hotmail.com', 'trans.logis_chiloe@hotmail.com', '', '977916726', 'Llanquihue', 'Llanquihue', '', 'Factura', 105, '76173103-3', NULL);
INSERT INTO `personaempresa` VALUES (217, 77434682, '1', 'Sociedad Comercial y Servicios Molina SPA', 'C79 Obras menores', 'PIRUQUINA RURAL S N', 'arsenio.cheno@hotmail.com', 'arsenio.cheno@hotmail.com', '', '', 'Castro', 'Castro', '', 'Factura', 105, '77434682-1', NULL);
INSERT INTO `personaempresa` VALUES (218, 76342740, '4', 'Sociedad de Inversiones M y J Ltda', 'C69 Inversiones', 'Panamericana Sur Km 1018', 'joaquinrodriguezabogado@gmail.com', 'joaquinrodriguezabogado@gmail.com', '', '988992122', 'Puerto Montt', 'Puerto Montt', '', 'Factura', 105, '76342740-4', NULL);
INSERT INTO `personaempresa` VALUES (219, 76080497, '5', 'Sociedad Educacional Pufudi S.A.', 'C44 Educación', 'Pufudi SN', 'margarita.uribe@hotmail.com', 'margarita.uribe@hotmail.com; diegosuribe@gmail.com', '', '063-215698', 'Mariquina', 'Valdivia', '', 'Factura', 105, '76080497-5', NULL);
INSERT INTO `personaempresa` VALUES (220, 76111956, '7', 'Sociedad Educacional Tenaun Ltda.', 'C44 Educación', 'Tenaun Rural SN', 'colegiotenaunalto@yahoo.es', 'colegiotenaunalto@yahoo.es', '', '', 'Dalcahue', 'Dalcahue', '', 'Factura', 105, '76111956-7', NULL);
INSERT INTO `personaempresa` VALUES (221, 76095304, '0', 'Sociedad Gastronomica La Gringa Ltda', 'C48 Elaboración de productos de pastelería', 'Imperial 605', 'r.bebin@lagringa.cl', 'r.bebin@lagringa.cl', '', '993195255', 'Puerto Varas', 'Puerto Varas', '', 'Factura', 105, '76095304-0', NULL);
INSERT INTO `personaempresa` VALUES (222, 76083248, '0', 'Sociedad Hotel Los Caiquenes Limitada', 'C60 Hotelería', 'Ruta 225, Camino Ensenada km 9', 'isabel.duhalde@gmail.com', 'isabel.duhalde@gmail.com', '', '981590489', 'Puerto Varas', 'Puerto Varas', '', 'Factura', 105, '76083248-0', NULL);
INSERT INTO `personaempresa` VALUES (223, 76029987, '1', 'Sociedad Médica Méndez Zuñiga Ltda', 'A25 Salud', 'Bellavista 123 Of 102', 'fmendezk@gmail.com', 'fmendezk@gmail.com', '', '652289507', 'Puerto Montt', 'Puerto Montt', '', 'Factura', 105, '76029987-1', NULL);
INSERT INTO `personaempresa` VALUES (224, 77029860, '1', 'Sociedad Radioemisora Hualaihué Ltda', 'C88 Radioemisora - Televisión', 'Diego Portales s n', 'radiohualaihue@gmail.com', 'radiohualaihue@gmail.com', '', '652217358', 'Hualaihué', 'Hornopirén', '', 'Factura', 105, '77029860-1', NULL);
INSERT INTO `personaempresa` VALUES (225, 76163620, '0', 'Sociedad Transportes Maryun Limitada', 'TDC Transporte de Carga', 'Chin Chin chico sn lote 5', 'marco.bravo@transmaryun.cl', 'marco.bravo@transmaryun.cl', '', '963614268', 'Puerto Montt', 'Puerto Montt', '', 'Factura', 105, '76163620-0', NULL);
INSERT INTO `personaempresa` VALUES (226, 76304845, '4', 'Sociedad Turística Chiloé Mágico Ltda.', 'ACA Arriendo de Cabañas', 'Llau-Llao SN', 'rcaroa@hotmail.com', 'rcaroa@hotmail.com; rcaroa@gmail.com', '', '62562631', 'Castro', 'Castro', '', 'Factura', 105, '76304845-4', NULL);
INSERT INTO `personaempresa` VALUES (227, 96854180, '3', 'TORALLA S.A. ', 'A29 Industria Pesquera y sus Derivados', 'Camino a Queilen Km 6', 'Facturaelectronica@toralla.cl', 'Facturaelectronica@toralla.cl', '', '652672500', 'Chonchi', 'Chonchi', '', 'Factura', 105, '96854180-3', NULL);
INSERT INTO `personaempresa` VALUES (228, 76591300, '4', 'Tour Operador Trails of Chile Ltda', 'A07 Tour operador', 'Ruta 225, Camino Ensenada km 7,5', 'finanzas@trailsofchile.cl', 'finanzas@trailsofchile.cl', '', '983605562', 'Puerto Varas', 'Ensenada', '', 'Factura', 105, '76591300-4', NULL);
INSERT INTO `personaempresa` VALUES (229, 76688536, '5', 'Transportes Pablo Vargas Opitz E.I.R.L.', 'A32 Transporte de Carga por Carretera', 'Las Quemas Parcela 7', 'pablovargas.transervicio@gmail.com', 'pablovargas.transervicio@gmail.com', '', '', 'Puerto Montt', 'Puerto Montt', '', 'Factura', 105, '76688536-5', NULL);
INSERT INTO `personaempresa` VALUES (230, 76765690, '4', 'Transportes Polmar Chile Ltda.', 'tcp Transporte de carga y pasajeros', 'Carlos Rogers 250.  Reñaca', 'fmartinez@movingpeople.cl', 'fmartinez@movingpeople.cl', '', '979454088', 'Viña del Mar', 'Viña del Mar', '', 'Factura', 105, '76765690-4', NULL);
INSERT INTO `personaempresa` VALUES (231, 52002794, '7', 'Transportes Volke E.I.R.L.', 'A08 Transporte', 'Cruce Totoral Parcela 14', 'fvolke@hotmail.com', 'fvolke@hotmail.com', '', '652242860', 'Llanquihue', 'Llanquihue', '', 'Factura', 105, '52002794-7', NULL);
INSERT INTO `personaempresa` VALUES (232, 76619585, '7', 'Transportes Wolf Ltda.', 'A32 Transporte de Carga por Carretera', 'Fundo Colegual KM 4 Camino Fresia', 'erwinwolf57@gmail.com', 'erwinwolf57@gmail.com', '', '984146404', 'Llanquihue', 'Llanquihue', '', 'Factura', 105, '76619585-7', NULL);
INSERT INTO `personaempresa` VALUES (233, 96566740, '7', 'Trusal S.A.', 'pez Producción y Crianza de Peces', 'Panamericana Sur KM 1030', 'marcelo.nirril@salmonesaustral.cl', 'recepcion.trusal@salmonesaustral.cl', '', '652227000', 'Puerto Montt', 'Puerto Montt', '', 'Factura', 105, '96566740-7', NULL);
INSERT INTO `personaempresa` VALUES (234, 78144880, 'k', 'Turismo Centinela Ltda', 'A12 Turismo', 'Camino Tegualda km 14', 'casadelaoma@surnet.cl', 'arriendos@delpacifico.cl; casadelaoma@surnet.cl', '', '998472623', 'Frutillar', 'Frutillar', '', 'Factura', 105, '78144880-k', NULL);
INSERT INTO `personaempresa` VALUES (235, 76129300, '1', 'Turismo el Barraco Ltda', 'A11 Transporte y turismo', 'Camino Turistico 11486A', 'jaimef@turismobarraco.com', 'jaimef@turismobarraco.com', '', '29205414', 'Lo Barnechea', 'Santiago', '', 'Factura', 105, '76129300-1', NULL);
INSERT INTO `personaempresa` VALUES (236, 76331835, '4', 'Turismo Mahuida Ltda.', 'A12 Turismo', 'Del Puente 321', 'info@constructoramahuida.cl', 'info@constructoramahuida.cl', '', '652562548', 'Puerto Montt', 'Puerto Montt', '', 'Factura', 105, '76331835-4', NULL);
INSERT INTO `personaempresa` VALUES (237, 76575833, '5', 'Turismo Río Pescado Limitada', 'A12 Turismo', 'Dardignac 59', 'gmartinezarancibia@gmail.com', 'gmartinezarancibia@gmail.com', '', '', 'San Felipe', 'San Felipe', '', 'Factura', 105, '76575833-5', NULL);
INSERT INTO `personaempresa` VALUES (238, 76264730, '3', 'Turística Petrohue Ltda.', 'C59 Hotel', 'Petrohue SN', 'reservas@petrohue.com', 'reservas@petrohue.com; gerencia@petrohue.com', '', '652212025', 'Puerto Varas', 'Puerto Varas', '', 'Factura', 105, '76264730-3', NULL);
INSERT INTO `personaempresa` VALUES (239, 77545050, '9', 'Turística Rucamalén Ltda', 'A12 Turismo', 'Ruta 225, Camino Ensenada km 36', 'reservas@rucamalen.cl', 'reservas@rucamalen.cl', '', '652335347', 'Puerto Varas', 'Ensenada', '', 'Factura', 105, '77545050-9', NULL);
INSERT INTO `personaempresa` VALUES (240, 76300584, '4', 'Universal Sign SPA', 'sen Comercialización de señalética, exportaciones', 'Costa Tenglo Alto sn', 'foyarzun@univsign.com', 'foyarzun@univsign.com; omora@biomar.com', '', '974313232', 'Puerto Montt', 'Puerto Montt', '', 'Factura', 105, '76300584-4', NULL);
INSERT INTO `personaempresa` VALUES (241, 78815130, '6', 'UXMAL Producciones e Inversiones Ltda', 'A51 Producciones e Inversiones', 'Campanario 335F', 'juanforch@icloud.com', 'juanforch@icloud.com', '', '95511510', 'Santiago', 'Santiago', '', 'Factura', 105, '78815130-6', NULL);
INSERT INTO `personaempresa` VALUES (242, 76044110, '4', 'VMIG Construcciones Ltda', 'C29 Construcción', 'Los Fresnos 135, Miraflores', 'lenchen26@hotmail.com', 'lenchen26@hotmail.com', '', '', 'Viña del Mar', 'Viña del Mar', '', 'Factura', 105, '76044110-4', NULL);
INSERT INTO `personaempresa` VALUES (243, 77058020, 'k', 'Weisser y Berner Ltda', 'C19 Cabañas y salón de té', 'Ruta 225, Camino Ensenada km 35', 'lweisser@oncesbellavista.cl', 'lweisser@oncesbellavista.cl', '', '988806181', 'Puerto Varas', 'Ensenada', '', 'Factura', 105, '77058020-k', NULL);
INSERT INTO `personaempresa` VALUES (244, 76413610, '1', 'Wendtfish Ltda.', 'CVP Compra y Venta Productos del Mar', 'Sector Putemun Camino Tey S.N', 'wendtfish@gmail.com', 'wendtfish@gmail.com', '', '98472485', 'Castro', 'Castro', '', 'Factura', 105, '76413610-1', NULL);
INSERT INTO `personaempresa` VALUES (245, 7816242, '2', 'Zady Novoa Muñoz', 'C29 Construcción', 'Av. Portales 570', 'zadynovoa@gmail.com', 'zadynovoa@gmail.com', '', '992802818', 'Puerto Montt', 'Puerto Montt', '', 'Factura', 105, '7816242-2', NULL);
INSERT INTO `personaempresa` VALUES (246, 8880621, '2', 'Ivar Emilio Morales Mansilla', '', 'Sector Vista Hermosa ', '', '', '', '', 'Rio Puelo', 'Rio Puelo', '', 'Boleta', 105, '8880621-2', NULL);
INSERT INTO `personaempresa` VALUES (247, 6490674, '7', 'José Efraín Vera Vera', '', 'Hijuela 30, Sector Rampa', '', '976683749', '', '976683749', 'Rio Puelo', 'Rio Puelo', '', 'Boleta', 105, '6490674-7', NULL);
INSERT INTO `personaempresa` VALUES (248, 14291118, '3', 'Juan Moll Vera', '', 'Sector los Mañios', '', '957585132', '', '957585132', 'Lago Ranco', 'Lago Ranco', '', 'Boleta', 105, '14291118-3', NULL);
INSERT INTO `personaempresa` VALUES (249, 7438421, '1', 'José Ruiz Inayao', '', 'Sector Chapaco SN', '', '994128907', '', '994128907', 'Rio Negro', 'Rio Negro', '', 'Boleta', 105, '7438421-1', NULL);
INSERT INTO `personaempresa` VALUES (250, 12338066, '5', 'Juan Bautista Reyes Montecinos', '', 'Peninsula de Illaguapi SN', '', '999815416', '', '999815416', 'Illahuapi', 'Illahuapi', '', 'Boleta', 105, '12338066-5', NULL);
INSERT INTO `personaempresa` VALUES (251, 10696770, '9', 'Margarita Berrios', '', 'Parcela Michael N° 5', '', '976812702', '', '976812702', 'Puerto Varas', 'Puerto Varas', '', 'Boleta', 105, '10696770-9', NULL);
INSERT INTO `personaempresa` VALUES (252, 6952368, '4', 'Lucio Vargas', '', '', '', '999114834', '', '999114834', 'Cochamó', 'Cochamó', '', 'Boleta', 105, '6952368-4', NULL);
INSERT INTO `personaempresa` VALUES (253, 5007559, '3', 'Enrique Jerónimo Fulla Capurro', '', 'Las Hijuelas Cai Cai, Sector Santa Elvira', '', '632212043', '', '632212043', 'Valdivia', 'Valdivia', '', 'Boleta', 105, '5007559-3', NULL);
INSERT INTO `personaempresa` VALUES (254, 6968462, '9', 'Isabel Galindo', '', 'Quenuir Bajo', '', '', '', '', 'Maullín', 'Maullín', '', 'Boleta', 105, '6968462-9', NULL);
INSERT INTO `personaempresa` VALUES (255, 7616928, '4', 'Cristian Beyer Rebhein', '', 'Camino Chamiza a Correntoso Km 13,5', '', '', '', '', 'Puerto Montt', 'Puerto Montt', '', 'Boleta', 105, '7616928-4', NULL);
INSERT INTO `personaempresa` VALUES (256, 5756628, '0', 'Enrique Brintrup Barrera', '', 'Fundo Ventisquero, Sector Río Tepú', '', '998177945', '', '998177945', 'Puerto Varas', 'Puerto Varas', '', 'Boleta', 105, '5756628-0', NULL);
INSERT INTO `personaempresa` VALUES (257, 22081400, '5', 'Oswaldo Rodriguez', '*', '*', 'bfsraptor@hotmail.com', '*', '*', '*', '*', '*', '*', 'Boleta', 105, '22081400', NULL);
INSERT INTO `personaempresa` VALUES (258, 15434708, '9', 'Luis POnce', '*', '*', 'luis@focoestrategico.cl', '*', '*', '*', '*', '*', '*', 'Factura', 1, '15434708-9', NULL);
INSERT INTO `personaempresa` VALUES (259, 16693834, '1', 'Joselin Rodriguez', '*', '*', 'rj45@live.cl', '*', '*', '*', '*', '*', '*', 'Factura', 1, '16693834-1', NULL);
INSERT INTO `personaempresa` VALUES (260, 22552879, '9', 'Matilda', '*', 'Boris Calderon Soto 135', 'lponce1405@gmail.com', 'Matilda', '*', '994697655', 'Buin', 'Santagigo', '*', 'Factura', 1, '22552879-9', NULL);
INSERT INTO `personaempresa` VALUES (265, 19205019, '7', 'MACARENA CORTES', 'PESCA', 'ASD', 'BFSRAPTOR@HOTMAIL.COM', '*', '', '*', 'SANTIAGO', 'SANTIAGO', '', 'BOLETA', 105, '19205019-7', 'PREFERENTE');
INSERT INTO `personaempresa` VALUES (264, 9999999, '9', 'PRUEBA', 'AGRICULTURA, GANADERíA, CAZA Y SILVICULTURA', '*', 'OSWALDO@FOCOESTRATEGICO.CL', '*', '*', '*', '*', '*', '', 'BOLETA', 1, '9999999-9', 'NORMAL');
INSERT INTO `personaempresa` VALUES (266, 22081355, 'K', 'PRUEBA', 'AGRICULTURA, GANADERíA, CAZA Y SILVICULTURA', '*', 'OSWALDO@FOCOESTRATEGICO.CL', '*', '*', '983764505', '*', '*', '*', 'BOLETA', 105, '22081355-K', 'NORMAL');
INSERT INTO `personaempresa` VALUES (267, 22081345, '2', 'PRUEBA 2', '', '*', 'BFSRAPTOR@HOTMAIL.COM', '*', '*', '*', '*', '*', '*', 'BOLETA', 105, '22081345-2', 'NORMAL');

-- ----------------------------
-- Table structure for personaempresa_extra
-- ----------------------------
DROP TABLE IF EXISTS `personaempresa_extra`;
CREATE TABLE `personaempresa_extra`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rut` int(11) NOT NULL,
  `dv` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nombre` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `giro` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `direccion` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `correo` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `contacto` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `comentario` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `telefono` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `rut`(`rut`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for productos
-- ----------------------------
DROP TABLE IF EXISTS `productos`;
CREATE TABLE `productos`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rut` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Table structure for radio_ingresos
-- ----------------------------
DROP TABLE IF EXISTS `radio_ingresos`;
CREATE TABLE `radio_ingresos`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estacion_id` int(11) NOT NULL,
  `funcion` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `alarma_activada` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `direccion_ip` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `puerto_acceso` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ancho_canal` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `apid` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `baseid` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `frecuencia` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tx_power` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `producto_id` int(11) NOT NULL,
  `ssid` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nivel` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'Administrador', 1);
INSERT INTO `roles` VALUES (2, 'Terreno', 2);
INSERT INTO `roles` VALUES (3, 'Soporte', 3);

-- ----------------------------
-- Table structure for servicio_internet
-- ----------------------------
DROP TABLE IF EXISTS `servicio_internet`;
CREATE TABLE `servicio_internet`  (
  `IdServInternet` int(11) NOT NULL AUTO_INCREMENT,
  `Velocidad` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Plan` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `IdOrigen` int(11) NOT NULL,
  `IdProducto` int(11) NOT NULL,
  `TipoDestino` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `IdServicio` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`IdServInternet`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for servicios
-- ----------------------------
DROP TABLE IF EXISTS `servicios`;
CREATE TABLE `servicios`  (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Rut` int(11) NOT NULL,
  `Grupo` int(11) NULL DEFAULT NULL,
  `TipoFactura` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `Valor` double(11, 2) NULL DEFAULT NULL,
  `Descuento` double(11, 2) NULL DEFAULT NULL,
  `IdServicio` int(11) NOT NULL,
  `Codigo` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Descripcion` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Estatus` int(11) NOT NULL,
  `FechaInstalacion` date NULL DEFAULT NULL,
  `InstaladoPor` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `Comentario` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `UsuarioPppoe` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `Conexion` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `IdUsuarioSession` int(11) NOT NULL,
  `Direccion` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Latitud` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Longitud` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Referencia` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Contacto` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Fono` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `FechaComprometidaInstalacion` date NOT NULL,
  `PosibleEstacion` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Equipamiento` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `SenalTeorica` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `IdUsuarioAsignado` int(11) NOT NULL,
  `SenalFinal` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `EstacionFinal` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `EstatusFacturacion` int(11) NOT NULL,
  `CostoInstalacion` double(11, 2) NOT NULL,
  `FacturarSinInstalacion` int(11) NOT NULL,
  `CostoInstalacionDescuento` double(11, 2) NOT NULL,
  `UsuarioPppoeTeorico` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `FechaFacturacion` date NULL DEFAULT NULL,
  `FechaActivacion` date NULL DEFAULT NULL,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 637 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for submenu
-- ----------------------------
DROP TABLE IF EXISTS `submenu`;
CREATE TABLE `submenu`  (
  `IdSubMenu` int(11) NOT NULL AUTO_INCREMENT,
  `Id_menu` int(11) NULL DEFAULT NULL,
  `Nombre` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Enlace` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`IdSubMenu`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 27 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of submenu
-- ----------------------------
INSERT INTO `submenu` VALUES (4, 5, 'Bodegas', '../bodegas/Bodega.php');
INSERT INTO `submenu` VALUES (5, 5, 'Proveedores', '../proveedores/Proveedor.php');
INSERT INTO `submenu` VALUES (6, 5, 'Mantenedor Tipo Producto', '../tipo_producto/TipoProducto.php');
INSERT INTO `submenu` VALUES (7, 5, 'Mantenedor Marca Producto', '../marca_producto/MarcaProducto.php');
INSERT INTO `submenu` VALUES (8, 5, 'Mantenedor Modelo Producto', '../modelo_producto/ModeloProducto.php');
INSERT INTO `submenu` VALUES (9, 5, 'Ingreso de productos', '../ingresos/Ingreso.php');
INSERT INTO `submenu` VALUES (10, 5, 'Egresos', '../egresos/Egreso.php');
INSERT INTO `submenu` VALUES (11, 1, 'Crear Cliente', '../clientes');
INSERT INTO `submenu` VALUES (12, 1, 'Ver Cliente', '../clientes/listaCliente.php');
INSERT INTO `submenu` VALUES (13, 1, 'Crear Servicios', '../servicios');
INSERT INTO `submenu` VALUES (14, 6, 'Facturas por Tiempo', '../reportes/reportesFacturas.php');
INSERT INTO `submenu` VALUES (15, 6, 'Facturas por cliente', '../reportes/facturasClientes.php');
INSERT INTO `submenu` VALUES (16, 7, 'Registro de Usuarios', '../registroUsuarios');
INSERT INTO `submenu` VALUES (17, 10, 'Log querys', '../logQuerys');
INSERT INTO `submenu` VALUES (18, 4, 'Agregar Ingreso Factura de Compras ', '../compras_ingresos/Ingreso.php');
INSERT INTO `submenu` VALUES (19, 4, 'Centros de Costos', '../costos/Costo.php');
INSERT INTO `submenu` VALUES (20, 10, 'Log Login', '../logLogin');
INSERT INTO `submenu` VALUES (22, 7, 'Tipo Cobro Servicio', '../TipoCobroServicio');
INSERT INTO `submenu` VALUES (23, 1, 'Ver Servicio', '	\r\n../clientesServicios');
INSERT INTO `submenu` VALUES (26, 3, 'Nota de Venta', '../nota_venta/NotaVenta.php');

-- ----------------------------
-- Table structure for subtipo_ticket
-- ----------------------------
DROP TABLE IF EXISTS `subtipo_ticket`;
CREATE TABLE `subtipo_ticket`  (
  `IdSubTipoTicket` int(11) NOT NULL AUTO_INCREMENT,
  `IdTipoTicket` int(11) NULL DEFAULT NULL,
  `Nombre` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`IdSubTipoTicket`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of subtipo_ticket
-- ----------------------------
INSERT INTO `subtipo_ticket` VALUES (1, 2, 'Problema Sin Visita');
INSERT INTO `subtipo_ticket` VALUES (4, 1, 'Ejemplo de subtipo correos');

-- ----------------------------
-- Table structure for tickets
-- ----------------------------
DROP TABLE IF EXISTS `tickets`;
CREATE TABLE `tickets`  (
  `IdTickets` int(11) NOT NULL AUTO_INCREMENT,
  `IdCliente` int(11) NULL DEFAULT NULL,
  `Origen` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `Departamento` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `Tipo` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `Subtipo` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `Prioridad` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `AsignarA` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `Estado` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `FechaCreacion` date NULL DEFAULT NULL,
  `IdServicios` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `Observaciones` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `IdUsuarioSession` int(11) NOT NULL,
  `Clase` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`IdTickets`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tiempo_prioridad
-- ----------------------------
DROP TABLE IF EXISTS `tiempo_prioridad`;
CREATE TABLE `tiempo_prioridad`  (
  `IdTiempoPrioridad` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `TiempoHora` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`IdTiempoPrioridad`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tiempo_prioridad
-- ----------------------------
INSERT INTO `tiempo_prioridad` VALUES (8, 'Alta', '24');
INSERT INTO `tiempo_prioridad` VALUES (9, 'Media', '48');
INSERT INTO `tiempo_prioridad` VALUES (10, 'Baja', '72');

-- ----------------------------
-- Table structure for tipo_facturacion
-- ----------------------------
DROP TABLE IF EXISTS `tipo_facturacion`;
CREATE TABLE `tipo_facturacion`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rut` int(11) NOT NULL,
  `id_codigo` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Table structure for tipo_ticket
-- ----------------------------
DROP TABLE IF EXISTS `tipo_ticket`;
CREATE TABLE `tipo_ticket`  (
  `IdTipoTicket` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`IdTipoTicket`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tipo_ticket
-- ----------------------------
INSERT INTO `tipo_ticket` VALUES (1, 'Correos');
INSERT INTO `tipo_ticket` VALUES (2, 'Problema Sin Visita');

-- ----------------------------
-- Table structure for trafico_generado
-- ----------------------------
DROP TABLE IF EXISTS `trafico_generado`;
CREATE TABLE `trafico_generado`  (
  `IdTraficoGenerado` int(11) NOT NULL AUTO_INCREMENT,
  `LineaTelefonica` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Descripcion` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `IdServicio` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`IdTraficoGenerado`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for usuarios
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(40) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `clave` varchar(60) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nivel` int(11) NOT NULL,
  `cargo` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `sexo` varchar(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `usuario`(`usuario`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 114 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES (1, 'lponce', 'Luis', '$2y$10$wYv6VYnc82VbH9MKK8Uk4.vx/6I6UFSA9.V7s9FjjwDe6dnsvxgMC', 1, 'CTO', 'luis@awaking.cl', 'M');
INSERT INTO `usuarios` VALUES (108, 'esalas', 'Esteban Salas', '$2y$10$kVgEiJNainKd2Hy7UoUY6uQ1QldBs38/fiaqOZvIRdTd1GtPd8zSC', 1, 'Departamento de Ventas', 'esalas@teledata.cl', '');
INSERT INTO `usuarios` VALUES (107, 'rberndt', 'Rolf Berndt', '$2y$10$bE/TRQfNOWenWRhbGeh9zes8k4iTH1wUAJUcHS.7inF.0A4UhWsfG', 1, 'Encargado de Logistica y Bodega', 'rberndt@teledata.cl', '');
INSERT INTO `usuarios` VALUES (101, 'sergio', 'Sergio Casas del Valle', '$2y$10$wk0haa0ftt6zG.nQd3BxO.IYhU1R0xdy09SXY11ML3ZCFYN.t7Zky', 1, 'Gerente General', 'sergio@teledata.cl', '');
INSERT INTO `usuarios` VALUES (106, 'rmontoya', 'Ronald Montoya', '$2y$10$NMEna//nIKUoD2NXh3a2Ge7cxRrc4rznpQST3ZBzxWXdSd8e2Fjv6', 1, 'Administrador', 'rmontoya@teledata.cl', '');
INSERT INTO `usuarios` VALUES (105, 'oswaldo', 'Oswaldo Rodriguez', '$2y$10$R8ymz9NZLRYcSRXNGh/XLODcrF1zWkwRXwd0KdvD0zjK5xhxm2vM2', 1, 'Programador', 'oswaldo@awaking.cl', 'M');
INSERT INTO `usuarios` VALUES (104, 'Fran', 'Francesca ', '$2y$10$HLYr/5u406iqMvcK6f/jae9ybwEIX1rX39DFkFC2nIlHJyuL14JU.', 1, 'Gerencia', 'fpezzuto@teledata.cl', '');
INSERT INTO `usuarios` VALUES (109, 'Katherine', 'Katherine', '$2y$10$yzdXvtzXKI9ourenTp.oY.vcsIoIZnliI2td1JRX1ckpxkwoZt6Ta', 1, 'Contadora', 'kcardenas@teledata.cl', '');
INSERT INTO `usuarios` VALUES (110, 'cjurgens', 'Carlos Jurgens', '$2y$10$.Pa0vK2.t1V6EY1XWNBSAuNJwkwLFtaRwGcNJ9SS2DWR5UEjmAow6', 1, 'Administracion', 'cjurgens@teledata.cl', '');
INSERT INTO `usuarios` VALUES (111, 'fabian', 'Fabian Ojeda', '$2y$10$xKCUPKtvz.M6q9q6.WtXr.fxq7/KZHtwP5CkQRZQ1zZE3G02xLsAW', 1, 'Soporte Nivel 2', 'fojeda@teledata.cl', '');
INSERT INTO `usuarios` VALUES (112, 'julio', 'Julio Carrillo', '$2y$10$GAv785q.0I1o1aZVAiBxc.fc7eseW5omkflk73tqhrsSVgIehz4x6', 1, 'Soporte Nivel 2', 'jcarrillo@teledata.cl', '');
INSERT INTO `usuarios` VALUES (113, 'atris', 'Atris Martelo', '$2y$10$4oI0ixVEiyXB/X0euuUiVuEwPx/dg8FGLFJJ6fX7gHai.F6u1AARG', 1, 'Soporte Nivel 1', 'atrismartelo@teledata.cl', '');

-- ----------------------------
-- Table structure for variables_globales
-- ----------------------------
DROP TABLE IF EXISTS `variables_globales`;
CREATE TABLE `variables_globales`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_comprobacion` date NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of variables_globales
-- ----------------------------
INSERT INTO `variables_globales` VALUES (1, '2018-07-01');

-- ----------------------------
-- Event structure for e_ActivarServicios
-- ----------------------------
DROP EVENT IF EXISTS `e_ActivarServicios`;
delimiter ;;
CREATE EVENT `e_ActivarServicios`
ON SCHEDULE
EVERY '1' DAY STARTS '2013-01-01 00:00:00'
DO UPDATE servicios SET FechaActivacion = NULL WHERE FechaActivacion < NOW()
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
