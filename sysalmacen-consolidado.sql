/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50620
Source Host           : localhost:3306
Source Database       : sysalmacen

Target Server Type    : MYSQL
Target Server Version : 50620
File Encoding         : 65001

Date: 2014-12-11 21:45:29
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `articulos`
-- ----------------------------
DROP TABLE IF EXISTS `articulos`;
CREATE TABLE `articulos` (
  `id_articulo` int(8) NOT NULL,
  `id_medida` int(8) NOT NULL,
  `id_categoria` int(8) NOT NULL,
  `articulo` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `stock` double NOT NULL,
  PRIMARY KEY (`id_articulo`),
  KEY `id_unidad` (`id_medida`,`id_categoria`),
  KEY `id_categoria` (`id_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- ----------------------------
-- Records of articulos
-- ----------------------------
INSERT INTO `articulos` VALUES ('1', '1', '1', '', 'leche gloria amarilla la de la abejita', '10');
INSERT INTO `articulos` VALUES ('2', '1', '1', '', 'gaseosa', '13');

-- ----------------------------
-- Table structure for `categoria`
-- ----------------------------
DROP TABLE IF EXISTS `categoria`;
CREATE TABLE `categoria` (
  `id_categoria` int(6) NOT NULL,
  `categoria` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- ----------------------------
-- Records of categoria
-- ----------------------------
INSERT INTO `categoria` VALUES ('1', 'conservas');
INSERT INTO `categoria` VALUES ('2', 'conservas');

-- ----------------------------
-- Table structure for `detalle_entrada`
-- ----------------------------
DROP TABLE IF EXISTS `detalle_entrada`;
CREATE TABLE `detalle_entrada` (
  `id_detalle_entrada` int(8) NOT NULL,
  `id_entradas` int(8) NOT NULL,
  `id_articulo` int(8) NOT NULL,
  `cantidad` double NOT NULL,
  PRIMARY KEY (`id_detalle_entrada`),
  KEY `id_articulo` (`id_articulo`),
  KEY `id_entadas` (`id_entradas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- ----------------------------
-- Records of detalle_entrada
-- ----------------------------
INSERT INTO `detalle_entrada` VALUES ('1', '1', '2', '1');

-- ----------------------------
-- Table structure for `detalle_salida`
-- ----------------------------
DROP TABLE IF EXISTS `detalle_salida`;
CREATE TABLE `detalle_salida` (
  `id_detalle_salida` int(8) NOT NULL,
  `id_articulo` int(8) NOT NULL,
  `cantidad` double NOT NULL,
  `id_salida` int(8) NOT NULL,
  PRIMARY KEY (`id_detalle_salida`),
  KEY `id_articulo` (`id_articulo`),
  KEY `id_salida` (`id_salida`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- ----------------------------
-- Records of detalle_salida
-- ----------------------------

-- ----------------------------
-- Table structure for `entradas`
-- ----------------------------
DROP TABLE IF EXISTS `entradas`;
CREATE TABLE `entradas` (
  `id_entradas` int(8) NOT NULL,
  `id_login` int(8) NOT NULL,
  `fecha_entrada` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `proveedor` int(11) NOT NULL,
  `tipo_comprobante` varchar(30) COLLATE utf8mb4_spanish_ci NOT NULL,
  `numero_comprobante` varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL,
  `tiempo` text COLLATE utf8mb4_spanish_ci,
  `guia_remision` text COLLATE utf8mb4_spanish_ci,
  `chofer` text COLLATE utf8mb4_spanish_ci,
  PRIMARY KEY (`id_entradas`),
  KEY `id_login` (`id_login`),
  CONSTRAINT `entradas_ibfk_1` FOREIGN KEY (`id_login`) REFERENCES `login` (`id_login`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- ----------------------------
-- Records of entradas
-- ----------------------------
INSERT INTO `entradas` VALUES ('1', '1', '2014-12-11', '1', 'Boleta', '01-2', '00:37', '01-121', 'lenin');

-- ----------------------------
-- Table structure for `login`
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
-- Table structure for `proveedor`
-- ----------------------------
DROP TABLE IF EXISTS `proveedor`;
CREATE TABLE `proveedor` (
  `idproveedor` int(11) DEFAULT NULL,
  `nombre` text,
  `direccion` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of proveedor
-- ----------------------------
INSERT INTO `proveedor` VALUES ('1', 'cocorocos', null);

-- ----------------------------
-- Table structure for `salida`
-- ----------------------------
DROP TABLE IF EXISTS `salida`;
CREATE TABLE `salida` (
  `id_salida` int(8) NOT NULL,
  `id_login` int(8) NOT NULL,
  `fecha_salida` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `destinatario` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `tipo_comprobante` varchar(30) COLLATE utf8mb4_spanish_ci NOT NULL,
  `numero_comprobante` varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL,
  `chofer` varchar(20) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `placa` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `proveedor` int(11) DEFAULT NULL,
  `tiempi` text COLLATE utf8mb4_spanish_ci,
  PRIMARY KEY (`id_salida`),
  KEY `id_login` (`id_login`),
  CONSTRAINT `salida_ibfk_1` FOREIGN KEY (`id_login`) REFERENCES `login` (`id_login`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- ----------------------------
-- Records of salida
-- ----------------------------

-- ----------------------------
-- Table structure for `unidad_medida`
-- ----------------------------
DROP TABLE IF EXISTS `unidad_medida`;
CREATE TABLE `unidad_medida` (
  `id_medida` int(8) NOT NULL,
  `unidad_medida` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  PRIMARY KEY (`id_medida`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- ----------------------------
-- Records of unidad_medida
-- ----------------------------
INSERT INTO `unidad_medida` VALUES ('1', 'unidades');
INSERT INTO `unidad_medida` VALUES ('2', 'cajas');

-- ----------------------------
-- View structure for `vista_articulos`
-- ----------------------------
DROP VIEW IF EXISTS `vista_articulos`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_articulos` AS select `articulos`.`id_articulo` AS `id_articulo`,`articulos`.`descripcion` AS `descripcion`,`unidad_medida`.`unidad_medida` AS `unidad_medida`,`categoria`.`categoria` AS `categoria`,`articulos`.`stock` AS `stock` from ((`articulos` join `unidad_medida` on((`articulos`.`id_medida` = `unidad_medida`.`id_medida`))) join `categoria` on((`categoria`.`id_categoria` = `articulos`.`id_articulo`))) ;
