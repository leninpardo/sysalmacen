/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50620
Source Host           : localhost:3306
Source Database       : sysalmacen

Target Server Type    : MYSQL
Target Server Version : 50620
File Encoding         : 65001

Date: 2014-11-09 19:12:31
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for articulos
-- ----------------------------
DROP TABLE IF EXISTS `articulos`;
CREATE TABLE `articulos` (
  `id_articulo` int(8) NOT NULL AUTO_INCREMENT,
  `id_medida` int(8) NOT NULL,
  `id_categoria` int(8) NOT NULL,
  `articulo` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `stock` double NOT NULL,
  PRIMARY KEY (`id_articulo`),
  KEY `id_unidad` (`id_medida`,`id_categoria`),
  KEY `id_categoria` (`id_categoria`),
  CONSTRAINT `articulos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `articulos_ibfk_2` FOREIGN KEY (`id_medida`) REFERENCES `unidad_medida` (`id_medida`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- ----------------------------
-- Records of articulos
-- ----------------------------
INSERT INTO `articulos` VALUES ('1', '1', '1', 'leche', 'leche gloria amarilla la de la abejita', '0');

-- ----------------------------
-- Table structure for categoria
-- ----------------------------
DROP TABLE IF EXISTS `categoria`;
CREATE TABLE `categoria` (
  `id_categoria` int(6) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- ----------------------------
-- Records of categoria
-- ----------------------------
INSERT INTO `categoria` VALUES ('1', 'lapteos');
INSERT INTO `categoria` VALUES ('2', 'conservas');

-- ----------------------------
-- Table structure for detalle_entrada
-- ----------------------------
DROP TABLE IF EXISTS `detalle_entrada`;
CREATE TABLE `detalle_entrada` (
  `id_detalle_entrada` int(8) NOT NULL AUTO_INCREMENT,
  `id_entadas` int(8) NOT NULL,
  `id_articulo` int(8) NOT NULL,
  `cantidad` double NOT NULL,
  PRIMARY KEY (`id_detalle_entrada`),
  KEY `id_articulo` (`id_articulo`),
  KEY `id_entadas` (`id_entadas`),
  CONSTRAINT `detalle_entrada_ibfk_1` FOREIGN KEY (`id_articulo`) REFERENCES `articulos` (`id_articulo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detalle_entrada_ibfk_2` FOREIGN KEY (`id_entadas`) REFERENCES `entradas` (`id_entadas`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- ----------------------------
-- Records of detalle_entrada
-- ----------------------------

-- ----------------------------
-- Table structure for detalle_salida
-- ----------------------------
DROP TABLE IF EXISTS `detalle_salida`;
CREATE TABLE `detalle_salida` (
  `id_detalle_salida` int(8) NOT NULL AUTO_INCREMENT,
  `id_articulo` int(8) NOT NULL,
  `cantidad` double NOT NULL,
  `id_salida` int(8) NOT NULL,
  PRIMARY KEY (`id_detalle_salida`),
  KEY `id_articulo` (`id_articulo`),
  KEY `id_salida` (`id_salida`),
  CONSTRAINT `detalle_salida_ibfk_1` FOREIGN KEY (`id_articulo`) REFERENCES `articulos` (`id_articulo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detalle_salida_ibfk_2` FOREIGN KEY (`id_salida`) REFERENCES `salida` (`id_salida`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- ----------------------------
-- Records of detalle_salida
-- ----------------------------

-- ----------------------------
-- Table structure for entradas
-- ----------------------------
DROP TABLE IF EXISTS `entradas`;
CREATE TABLE `entradas` (
  `id_entadas` int(8) NOT NULL AUTO_INCREMENT,
  `id_login` int(8) NOT NULL,
  `fecha_entrada` datetime NOT NULL,
  `proveedor` int(11) NOT NULL,
  `tipo_comprobante` varchar(30) COLLATE utf8mb4_spanish_ci NOT NULL,
  `numero_comprobante` varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL,
  PRIMARY KEY (`id_entadas`),
  KEY `id_login` (`id_login`),
  CONSTRAINT `entradas_ibfk_1` FOREIGN KEY (`id_login`) REFERENCES `login` (`id_login`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- ----------------------------
-- Records of entradas
-- ----------------------------

-- ----------------------------
-- Table structure for login
-- ----------------------------
DROP TABLE IF EXISTS `login`;
CREATE TABLE `login` (
  `id_login` int(8) NOT NULL AUTO_INCREMENT,
  `user` varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL,
  `password` varchar(10) COLLATE utf8mb4_spanish_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `apellido` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `correo` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  PRIMARY KEY (`id_login`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- ----------------------------
-- Records of login
-- ----------------------------
INSERT INTO `login` VALUES ('1', 'damner', '1234', 'damner', 'palacios gonzales', 'damner.1995@gmail.com');

-- ----------------------------
-- Table structure for salida
-- ----------------------------
DROP TABLE IF EXISTS `salida`;
CREATE TABLE `salida` (
  `id_salida` int(8) NOT NULL AUTO_INCREMENT,
  `id_login` int(8) NOT NULL,
  `fecha_salida` datetime NOT NULL,
  `destinatario` int(50) NOT NULL,
  `tipo_comprobante` varchar(30) COLLATE utf8mb4_spanish_ci NOT NULL,
  `numero_comprobante` varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL,
  PRIMARY KEY (`id_salida`),
  KEY `id_login` (`id_login`),
  CONSTRAINT `salida_ibfk_1` FOREIGN KEY (`id_login`) REFERENCES `login` (`id_login`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- ----------------------------
-- Records of salida
-- ----------------------------

-- ----------------------------
-- Table structure for unidad_medida
-- ----------------------------
DROP TABLE IF EXISTS `unidad_medida`;
CREATE TABLE `unidad_medida` (
  `id_medida` int(8) NOT NULL AUTO_INCREMENT,
  `unidad_medida` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  PRIMARY KEY (`id_medida`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- ----------------------------
-- Records of unidad_medida
-- ----------------------------
INSERT INTO `unidad_medida` VALUES ('1', 'unidades');
INSERT INTO `unidad_medida` VALUES ('2', 'cajas');
