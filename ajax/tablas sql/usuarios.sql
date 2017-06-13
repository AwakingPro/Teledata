/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : teledata

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-05-28 21:27:53
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for usuarios
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(40) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `clave` varchar(60) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nivel` int(11) NOT NULL,
  `cargo` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `sexo` varchar(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=MyISAM AUTO_INCREMENT=96 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES ('1', 'lponcez', 'Luis Ponce', '$2y$10$8oWS5shtgP4Y8XP/R61P1O0h7WZAZM/tK/1Xs62hOPoWMksdtgPba', '1', 'CTO', 'luis@awaking.cl', 'M');
INSERT INTO `usuarios` VALUES ('89', 'oswaldo', 'oswaldo', '$2y$10$./MECKBhiBxbl0MJp893COX44cFa/HDKKeJ0l1yOmNzJxjmrDNDEG', '1', 'Desarrollo', '', 'M');
INSERT INTO `usuarios` VALUES ('90', 'arincon', 'Alvaro Rincon', '$2y$10$/.Lqnt3GG4n40.S.U9gltOKPNNuy/FN92WWR7XnisZmIK/Amx29.W', '1', 'Desarrollador', '', '');
INSERT INTO `usuarios` VALUES ('93', 'administrador', 'Administrador', '$2y$10$/.Lqnt3GG4n40.S.U9gltOKPNNuy/FN92WWR7XnisZmIK/Amx29.W', '1', 'Administrador', '', '');
INSERT INTO `usuarios` VALUES ('94', 'soporte', 'Soporte', '$2y$10$/.Lqnt3GG4n40.S.U9gltOKPNNuy/FN92WWR7XnisZmIK/Amx29.W', '2', 'Soporte', '', '');
INSERT INTO `usuarios` VALUES ('95', 'terreno', 'Terreno', '$2y$10$/.Lqnt3GG4n40.S.U9gltOKPNNuy/FN92WWR7XnisZmIK/Amx29.W', '3', 'Terreno', '', '');
