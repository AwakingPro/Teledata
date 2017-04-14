/*
Navicat MySQL Data Transfer

Source Server         : Mi Computadora
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : foco

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-04-05 10:08:21
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for contactos_reclutamiento
-- ----------------------------
DROP TABLE IF EXISTS `contactos_reclutamiento`;
CREATE TABLE `contactos_reclutamiento` (
  `IdContacto` int(11) NOT NULL AUTO_INCREMENT,
  `IdUsuarioReclutamiento` int(11) NOT NULL,
  `Nombre` varchar(150) DEFAULT NULL,
  `Parentesco` varchar(150) DEFAULT NULL,
  `Celular1` varchar(20) DEFAULT NULL,
  `Celular2` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`IdContacto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of contactos_reclutamiento
-- ----------------------------

-- ----------------------------
-- Table structure for datos_generales_reclutamiento
-- ----------------------------
DROP TABLE IF EXISTS `datos_generales_reclutamiento`;
CREATE TABLE `datos_generales_reclutamiento` (
  `IdDatosGenerales` int(11) NOT NULL AUTO_INCREMENT,
  `IdUsuarioReclutamiento` varchar(255) DEFAULT NULL,
  `Rut` varchar(20) DEFAULT NULL,
  `Apellidos` varchar(150) DEFAULT NULL,
  `Nombres` varchar(150) DEFAULT NULL,
  `Telefono` varchar(150) DEFAULT NULL,
  `FechaNacimiento` date DEFAULT NULL,
  `Correo` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`IdDatosGenerales`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of datos_generales_reclutamiento
-- ----------------------------

-- ----------------------------
-- Table structure for datos_personales_reclutamiento
-- ----------------------------
DROP TABLE IF EXISTS `datos_personales_reclutamiento`;
CREATE TABLE `datos_personales_reclutamiento` (
  `IdDatosPersonales` int(11) NOT NULL AUTO_INCREMENT,
  `IdUsuarioReclutamiento` int(11) DEFAULT NULL,
  `Afp` varchar(150) DEFAULT NULL,
  `SistemaSalud` varchar(200) DEFAULT NULL,
  `UF` varchar(150) DEFAULT NULL,
  `Ges` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`IdDatosPersonales`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of datos_personales_reclutamiento
-- ----------------------------

-- ----------------------------
-- Table structure for domicilio_reclutamiento
-- ----------------------------
DROP TABLE IF EXISTS `domicilio_reclutamiento`;
CREATE TABLE `domicilio_reclutamiento` (
  `IdDomicilio` int(11) NOT NULL AUTO_INCREMENT,
  `IdUsuarioReclutamiento` int(11) NOT NULL,
  `Direccion` varchar(500) DEFAULT NULL,
  `Region` varchar(150) DEFAULT NULL,
  `Ciudad` varchar(150) DEFAULT NULL,
  `Comuna` varchar(150) DEFAULT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`IdDomicilio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of domicilio_reclutamiento
-- ----------------------------
