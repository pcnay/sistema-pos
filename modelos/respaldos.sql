-- MySQL dump 10.17  Distrib 10.3.23-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: pos
-- ------------------------------------------------------
-- Server version	10.3.23-MariaDB-0+deb10u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `t_Categoria`
--

DROP TABLE IF EXISTS `t_Categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_Categoria` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_Categoria`
--

LOCK TABLES `t_Categoria` WRITE;
/*!40000 ALTER TABLE `t_Categoria` DISABLE KEYS */;
INSERT INTO `t_Categoria` VALUES (2,'Categoria 2','2020-02-18 07:12:04'),(3,'Barredoras','2020-02-18 07:12:21'),(5,'ANDAMIOS','2020-02-18 07:14:07'),(6,'Generadores de Energia','2020-02-18 07:14:38'),(7,'Equipos Para Constuccion','2020-02-18 07:15:13'),(8,'CORTADORAS ANGULARES','2020-02-19 03:07:55'),(9,'TALADROS','2020-02-19 03:23:52'),(10,'bailarinas','2020-02-19 03:58:24');
/*!40000 ALTER TABLE `t_Categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_Clientes`
--

DROP TABLE IF EXISTS `t_Clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_Clientes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `documento` int(10) unsigned DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefono` varchar(80) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `compras` int(10) unsigned DEFAULT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `ultima_compra` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_Clientes`
--

LOCK TABLES `t_Clientes` WRITE;
/*!40000 ALTER TABLE `t_Clientes` DISABLE KEYS */;
INSERT INTO `t_Clientes` VALUES (3,'Cliente No 2',22222222,'cliente2@correo.com','(222) 222-22-22)','Direccion del cliente 2','1998-10-10',211,'2020-05-01 22:24:07','2020-08-28 21:47:42'),(4,'Cliente No 3',33333333,'cliente3@correo.com','(333) 333-33-33)','Direccion del Cliente No 3','1987-10-20',205,'2020-05-01 22:27:03','0000-00-00 00:00:00'),(5,'Cliente 4 Agregado desde la ventana Crear Ventas',33333,'correo4@correo4.com','(444) 444-44-44)','direccion cliente 4','2019-08-12',90,'2020-05-23 21:03:29','2020-09-01 22:03:49'),(6,'Cliente 5',12121212,'cliente5@gmail.com','(932) 212-32-12)','Ave San fleipe Npo. 230','1980-10-12',3,'2020-08-22 05:08:11','2020-08-24 22:12:53'),(7,'Cliente 6',383832929,'cliente6@correo.com','(323) 928-39-23)','Direccion Cliente 6','2020-01-10',0,'2020-08-28 04:49:13','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `t_Clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_Productos`
--

DROP TABLE IF EXISTS `t_Productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_Productos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_categoria` int(10) unsigned NOT NULL,
  `codigo` varchar(45) NOT NULL,
  `descripcion` varchar(80) NOT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  `stock` int(10) unsigned NOT NULL DEFAULT 1,
  `precio_compra` decimal(10,2) DEFAULT NULL,
  `precio_venta` decimal(10,2) DEFAULT NULL,
  `ventas` varchar(45) DEFAULT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `id_categoria` (`id_categoria`),
  CONSTRAINT `t_Productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `t_Categoria` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_Productos`
--

LOCK TABLES `t_Productos` WRITE;
/*!40000 ALTER TABLE `t_Productos` DISABLE KEYS */;
INSERT INTO `t_Productos` VALUES (4,6,'104','Cortadora de Adobe sin Disco ','vistas/img/productos/101/105.png ',2,4000.00,5600.00,'5','2020-03-07 05:32:01'),(8,6,'108','Guadaadora ','vistas/img/productos/101/105.png ',1,1540.00,2156.00,'5','2020-03-07 05:32:01'),(9,6,'109','Hidrolavadora Electrica ','vistas/img/productos/101/105.png ',0,2600.00,3640.00,'23','2020-03-07 05:32:01'),(12,6,'112','Motobomba Electrica','vistas/img/productos/101/105.png ',36,2400.00,3360.00,'22','2020-03-07 05:32:01'),(13,6,'113','Sierra Circular ','vistas/img/productos/101/105.png ',13,1100.00,1540.00,'18','2020-03-07 05:32:01'),(14,6,'114','Disco de tugsteno para Sierra circular','vistas/img/productos/101/105.png ',12,4500.00,6300.00,'14','2020-03-07 05:32:01'),(15,6,'115','Soldador Electrico ','vistas/img/productos/101/105.png ',14,1980.00,2772.00,'17','2020-03-07 05:32:01'),(16,6,'116','Careta para Soldador','vistas/img/productos/101/105.png ',14,4200.00,5880.00,'7','2020-03-07 05:32:01'),(17,6,'117','Torre de iluminacion ','vistas/img/productos/101/105.png ',14,1800.00,2520.00,'16','2020-03-07 05:32:01'),(20,2,'203','Taladro Demoledor de muro 110V','vistas/img/productos/101/105.png ',20,3850.00,5390.00,'-4','2020-03-07 05:32:01'),(21,2,'204','Muela o cincel martillo demoledor muro','vistas/img/productos/101/105.png ',20,9600.00,13440.00,NULL,'2020-03-07 05:32:01'),(22,2,'205','Taladro Percutor de Madera y Metal','vistas/img/productos/101/105.png ',20,8000.00,11200.00,NULL,'2020-03-07 05:32:01'),(23,2,'206','Taladro Percutor SDS Plus 110V','vistas/img/productos/101/105.png ',20,3900.00,5460.00,NULL,'2020-03-07 05:32:01'),(24,2,'207','Taladro Percutor SDS Max 110V (Mineria)','vistas/img/productos/101/105.png ',20,4600.00,6440.00,NULL,'2020-03-07 05:32:01'),(25,3,'301','Andamio colgante','vistas/img/productos/101/105.png ',20,1440.00,2016.00,NULL,'2020-03-07 05:32:01'),(26,3,'302','Distanciador andamio colgante','vistas/img/productos/101/105.png ',20,1600.00,2240.00,NULL,'2020-03-07 05:32:01'),(27,3,'303','Marco andamio modular ','vistas/img/productos/101/105.png ',20,900.00,1260.00,NULL,'2020-03-07 05:32:01'),(28,3,'304','Marco andamio tijera','vistas/img/productos/101/105.png ',20,100.00,140.00,NULL,'2020-03-07 05:32:01'),(29,3,'305','Tijera para andamio','vistas/img/productos/101/105.png ',20,162.00,226.80,NULL,'2020-03-07 05:32:01'),(30,3,'306','Escalera interna para andamio','vistas/img/productos/101/105.png ',20,270.00,378.00,NULL,'2020-03-07 05:32:01'),(31,3,'307','Pasamanos de seguridad','vistas/img/productos/101/105.png ',20,75.00,105.00,NULL,'2020-03-07 05:32:01'),(32,3,'308','Rueda giratoria para andamio','vistas/img/productos/101/105.png ',20,168.00,235.20,NULL,'2020-03-07 05:32:01'),(33,3,'309','Arnes de seguridad','vistas/img/productos/101/105.png ',20,1750.00,2450.00,NULL,'2020-03-07 05:32:01'),(34,3,'310','Eslinga para arnes','vistas/img/productos/101/105.png ',20,175.00,245.00,NULL,'2020-03-07 05:32:01'),(35,3,'311','Plataforma Metalica','vistas/img/productos/101/105.png ',20,420.00,588.00,NULL,'2020-03-07 05:32:01'),(36,7,'401','Planta Electrica Diesel 6 Kva','vistas/img/productos/101/105.png ',20,3500.00,4900.00,NULL,'2020-03-07 05:32:01'),(37,7,'402','equipos construccion 402','vistas/img/productos/402/364.png',400,1500.00,2100.00,NULL,'2020-03-07 05:32:01'),(38,7,'403','Planta Electrica Diesel 20 Kva','vistas/img/productos/101/105.png ',20,3600.00,5040.00,NULL,'2020-03-07 05:32:01'),(39,7,'404','Planta Electrica Diesel 30 Kva','vistas/img/productos/101/105.png ',20,3650.00,5110.00,NULL,'2020-03-07 05:32:01'),(40,7,'405','Planta Electrica Diesel 60 Kva','vistas/img/productos/101/105.png ',20,3700.00,5180.00,NULL,'2020-03-07 05:32:01'),(41,7,'406','Planta Electrica Diesel 75 Kva','vistas/img/productos/101/105.png ',20,3750.00,5250.00,NULL,'2020-03-07 05:32:01'),(42,7,'407','Planta Electrica Diesel 100 Kva','vistas/img/productos/101/105.png ',20,3800.00,5320.00,NULL,'2020-03-07 05:32:01'),(43,7,'408','Planta Electrica Diesel 120 Kva','vistas/img/productos/101/105.png ',20,3850.00,5390.00,NULL,'2020-03-07 05:32:01'),(44,5,'501','Escalera de Tijera Aluminio ','vistas/img/productos/101/105.png ',20,350.00,490.00,NULL,'2020-03-07 05:32:01'),(45,5,'502','Andamios mini','vistas/img/productos/502/243.jpg',200,150.00,210.00,NULL,'2020-03-07 05:32:01'),(46,5,'503','Gato tensor','vistas/img/productos/101/105.png ',20,380.00,532.00,NULL,'2020-03-07 05:32:01'),(47,5,'504','Lamina Cubre Brecha ','vistas/img/productos/101/105.png ',20,380.00,532.00,NULL,'2020-03-07 05:32:01'),(48,5,'505','Llave de Tubo','vistas/img/productos/101/105.png ',20,480.00,672.00,NULL,'2020-03-07 05:32:01'),(49,5,'506','Manila por Metro','vistas/img/productos/101/105.png ',20,600.00,840.00,NULL,'2020-03-07 05:32:01'),(50,5,'507','Polea 2 canales','vistas/img/productos/101/105.png ',20,900.00,1260.00,NULL,'2020-03-07 05:32:01'),(51,5,'508','Tensor','vistas/img/productos/101/105.png ',20,100.00,140.00,NULL,'2020-03-07 05:32:01'),(52,5,'509','Bascula ','vistas/img/productos/101/105.png ',20,130.00,182.00,NULL,'2020-03-07 05:32:01'),(53,5,'510','Bomba Hidrostatica','vistas/img/productos/101/105.png ',20,770.00,1078.00,NULL,'2020-03-07 05:32:01'),(54,5,'511','Chapeta','vistas/img/productos/101/105.png ',20,660.00,924.00,NULL,'2020-03-07 05:32:01'),(55,5,'512','Cilindro muestra de concreto','vistas/img/productos/101/105.png ',20,400.00,560.00,NULL,'2020-03-07 05:32:01'),(56,5,'513','Cizalla de Palanca','vistas/img/productos/101/105.png ',20,450.00,630.00,NULL,'2020-03-07 05:32:01'),(57,5,'514','Cizalla de Tijera','vistas/img/productos/101/105.png ',20,580.00,812.00,NULL,'2020-03-07 05:32:01'),(58,5,'515','Coche llanta neumatica','vistas/img/productos/101/105.png ',20,420.00,588.00,NULL,'2020-03-07 05:32:01'),(59,5,'516','Cono slump','vistas/img/productos/101/105.png ',20,140.00,196.00,NULL,'2020-03-07 05:32:01'),(60,5,'517','Cortadora de Baldosin','vistas/img/productos/101/105.png ',20,930.00,1302.00,NULL,'2020-03-07 05:32:01'),(61,2,'202','Categoria avanzada','vistas/img/productos/default/anonymous.png',10,120.00,168.00,NULL,'2020-03-21 04:00:51'),(62,9,'901','Taladros primarios','vistas/img/productos/901/730.png',30,5.45,7.63,NULL,'2020-03-22 00:10:52'),(63,5,'502','Andamios mini','vistas/img/productos/502/243.jpg',200,150.00,210.00,NULL,'2020-03-22 00:52:11'),(64,2,'202','Categoria 2 adicional','vistas/img/productos/202/353.jpg',20,45.00,63.00,NULL,'2020-03-29 01:31:17'),(65,7,'402','equipos construccion 402','vistas/img/productos/402/364.png',400,1500.00,2100.00,NULL,'2020-03-29 02:03:34'),(66,10,'1001','descripcion 1001','vistas/img/productos/1001/263.jpg',1000,14.00,19.60,NULL,'2020-03-29 02:07:06'),(67,9,'902','taladros 902','vistas/img/productos/902/878.jpg',13,13.00,18.20,NULL,'2020-03-29 02:33:59');
/*!40000 ALTER TABLE `t_Productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_Usuario`
--

DROP TABLE IF EXISTS `t_Usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_Usuario` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `usuario` varchar(45) NOT NULL,
  `clave` varchar(80) NOT NULL,
  `perfil` varchar(45) NOT NULL,
  `vendedor` varchar(45) DEFAULT NULL,
  `foto` varchar(45) DEFAULT NULL,
  `estado` int(10) unsigned DEFAULT 0,
  `ultimo_login` datetime NOT NULL DEFAULT current_timestamp(),
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_Usuario`
--

LOCK TABLES `t_Usuario` WRITE;
/*!40000 ALTER TABLE `t_Usuario` DISABLE KEYS */;
INSERT INTO `t_Usuario` VALUES (1,'Usuario Administrador','admin','123','Administrador','','',1,'2020-09-03 22:11:53','2020-02-08 04:06:44'),(4,'Monserrat Gonzalez rrr','monserrat','$2a$07$asxx54ahjppf45sd87a5auGZEtGHuyZwm.Ur.FJvWLCql3nmsMbXy','Vendedor',NULL,'vistas/img/usuarios/monserrat/669.png',1,'2020-02-08 05:01:22','2020-02-08 05:01:22'),(8,'Minerva Sotelo Madrigal','minerva','$2a$07$asxx54ahjppf45sd87a5auGZEtGHuyZwm.Ur.FJvWLCql3nmsMbXy','Vendedor',NULL,'vistas/img/usuarios/minerva/214.jpg',1,'2020-02-14 05:52:26','2020-02-14 05:52:26'),(9,'Miguel Contreras','miguel','$2a$07$asxx54ahjppf45sd87a5auGZEtGHuyZwm.Ur.FJvWLCql3nmsMbXy','Especial',NULL,'vistas/img/usuarios/miguel/156.png',1,'2020-02-15 05:14:50','2020-02-15 05:14:50'),(10,'Miguel Contreras','miguel','$2a$07$asxx54ahjppf45sd87a5auGZEtGHuyZwm.Ur.FJvWLCql3nmsMbXy','Especial',NULL,'vistas/img/usuarios/miguel/871.png',1,'2020-02-15 05:30:11','2020-02-15 05:30:11'),(11,'Miguel Contreras','miguel','$2a$07$asxx54ahjppf45sd87a5auGZEtGHuyZwm.Ur.FJvWLCql3nmsMbXy','Especial',NULL,'vistas/img/usuarios/miguel/271.png',0,'2020-02-15 05:30:18','2020-02-15 05:30:18'),(14,'Miguel Contreras','miguel','$2a$07$asxx54ahjppf45sd87a5auGZEtGHuyZwm.Ur.FJvWLCql3nmsMbXy','Especial',NULL,'vistas/img/usuarios/miguel/706.png',0,'2020-02-15 05:49:43','2020-02-15 05:49:43');
/*!40000 ALTER TABLE `t_Usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_Ventas`
--

DROP TABLE IF EXISTS `t_Ventas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_Ventas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` int(10) unsigned NOT NULL,
  `id_cliente` int(10) unsigned NOT NULL,
  `id_vendedor` int(10) unsigned NOT NULL,
  `productos` text DEFAULT NULL,
  `impuesto` decimal(10,2) DEFAULT NULL,
  `neto` decimal(10,2) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `metodo_pago` varchar(80) DEFAULT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `id_cliente` (`id_cliente`),
  KEY `id_vendedor` (`id_vendedor`),
  CONSTRAINT `t_Ventas_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `t_Clientes` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `t_Ventas_ibfk_2` FOREIGN KEY (`id_vendedor`) REFERENCES `t_Usuario` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_Ventas`
--

LOCK TABLES `t_Ventas` WRITE;
/*!40000 ALTER TABLE `t_Ventas` DISABLE KEYS */;
INSERT INTO `t_Ventas` VALUES (45,10000,3,1,'[{\"id\":\"12\",\"descripcion\":\"Motobomba Electrica\",\"cantidad\":\"1\",\"stock\":\"37\",\"precio\":\"3360.00\",\"total\":\"3360\"},{\"id\":\"17\",\"descripcion\":\"Torre de iluminacion \",\"cantidad\":\"1\",\"stock\":\"15\",\"precio\":\"2520.00\",\"total\":\"2520.00\"}]',588.00,5880.00,6468.00,'Efectivo','2020-08-29 04:47:42'),(46,10001,5,1,'[{\"id\":\"12\",\"descripcion\":\"Motobomba Electrica\",\"cantidad\":\"1\",\"stock\":\"36\",\"precio\":\"3360.00\",\"total\":\"3360\"},{\"id\":\"13\",\"descripcion\":\"Sierra Circular \",\"cantidad\":\"1\",\"stock\":\"13\",\"precio\":\"1540.00\",\"total\":\"1540\"},{\"id\":\"17\",\"descripcion\":\"Torre de iluminacion \",\"cantidad\":\"1\",\"stock\":\"14\",\"precio\":\"2520.00\",\"total\":\"2520\"},{\"id\":\"20\",\"descripcion\":\"Taladro Demoledor de muro 110V\",\"cantidad\":\"3\",\"stock\":\"20\",\"precio\":\"5390.00\",\"total\":\"16170\"}]',2359.00,23590.00,25949.00,'TC-12312321','2020-09-02 05:03:49');
/*!40000 ALTER TABLE `t_Ventas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-09-06 19:12:18
