/*
Navicat MySQL Data Transfer

Source Server         : Mi Computadora
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : foco

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-03-31 11:59:29
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for grupos
-- ----------------------------
DROP TABLE IF EXISTS `grupos`;
CREATE TABLE `grupos` (
  `IdGrupo` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(50) DEFAULT NULL,
  `IdCedente` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdGrupo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of grupos
-- ----------------------------

-- ----------------------------
-- Table structure for grupos_empresas
-- ----------------------------
DROP TABLE IF EXISTS `grupos_empresas`;
CREATE TABLE `grupos_empresas` (
  `IdGrupPersEmpr` int(11) NOT NULL AUTO_INCREMENT,
  `IdGrupo` int(11) DEFAULT NULL,
  `IdEmpresaExterna` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdGrupPersEmpr`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of grupos_empresas
-- ----------------------------

-- ----------------------------
-- Table structure for grupos_personas
-- ----------------------------
DROP TABLE IF EXISTS `grupos_personas`;
CREATE TABLE `grupos_personas` (
  `IdGrupPersEmpr` int(11) NOT NULL AUTO_INCREMENT,
  `IdGrupo` int(11) DEFAULT NULL,
  `Rut` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`IdGrupPersEmpr`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of grupos_personas
-- ----------------------------
