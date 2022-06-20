CREATE DATABASE  IF NOT EXISTS `bd_biblioteca` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `bd_biblioteca`;
-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: bd_biblioteca
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `autor`
--

DROP TABLE IF EXISTS `autor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `autor` (
  `idAutor` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `fechaNacimiento` date DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idAutor`)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `autor`
--

LOCK TABLES `autor` WRITE;
/*!40000 ALTER TABLE `autor` DISABLE KEYS */;
INSERT INTO `autor` VALUES (0,'Amado Nervo','1870-08-29','img_1655590568_descargar (3).jpg'),(1,'Gabriel García Márquez','1927-03-06','/biblioteca/assets/image/ggma01.jpg'),(2,'William Shakespeare','1564-04-23','/biblioteca/assets/image/ggma01.jpg'),(3,'Bertha Yoshiko Higashida Hirose','1972-06-14','no image'),(4,'Isaac Asimov','1920-01-02','no image'),(5,'Chrissie Mapletoft','0000-00-00','http://dummyimage.com/223x100.png/5fa2dd/ffffff'),(108,'Stephen King','1978-05-17','img_1655581482_descargar.jpg'),(109,'Mark twain','1835-11-30','img_1655584243_descargar (1).jpg'),(111,'Charles Dickens','1812-02-07','img_1655585296_descargar (2).jpg');
/*!40000 ALTER TABLE `autor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bibliotecario`
--

DROP TABLE IF EXISTS `bibliotecario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bibliotecario` (
  `codigoBbliotecario` int(11) NOT NULL,
  `rol` varchar(15) NOT NULL,
  UNIQUE KEY `codigoBbliotecario` (`codigoBbliotecario`),
  CONSTRAINT `bibliotecario_ibfk_1` FOREIGN KEY (`codigoBbliotecario`) REFERENCES `usuario` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bibliotecario`
--

LOCK TABLES `bibliotecario` WRITE;
/*!40000 ALTER TABLE `bibliotecario` DISABLE KEYS */;
INSERT INTO `bibliotecario` VALUES (1000,'administrador');
/*!40000 ALTER TABLE `bibliotecario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `copias`
--

DROP TABLE IF EXISTS `copias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `copias` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `isbn` varchar(18) NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`codigo`),
  KEY `isbn` (`isbn`),
  CONSTRAINT `copias_ibfk_1` FOREIGN KEY (`isbn`) REFERENCES `libro` (`isbn`)
) ENGINE=InnoDB AUTO_INCREMENT=10099 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `copias`
--

LOCK TABLES `copias` WRITE;
/*!40000 ALTER TABLE `copias` DISABLE KEYS */;
INSERT INTO `copias` VALUES (10000,'0-2021-2022-1',2),(10001,'0-2021-2022-1',1),(10002,'0-2021-2022-1',1),(10003,'0-2021-2022-1',1),(10004,'0-2021-2022-1',1),(10005,'0-2021-2022-1',1),(10006,'0-2021-2022-1',1),(10007,'0-2021-2022-1',1),(10008,'0-2021-2022-1',1),(10009,'0-2021-2022-1',1),(10010,'0-2021-2022-1',1),(10011,'0-2021-2022-1',1),(10012,'0-2021-2022-1',1),(10013,'0-2021-2022-1',1),(10014,'0-2021-2022-1',1),(10015,'0-2021-2022-1',1),(10016,'0-2021-2022-1',1),(10017,'0-2021-2022-1',1),(10018,'0-2021-2022-1',1),(10019,'0-2021-2022-1',1),(10020,'1-2021-2022-2',2),(10021,'1-2021-2022-2',1),(10022,'1-2021-2022-2',1),(10023,'1-2021-2022-2',1),(10024,'1-2021-2022-2',1),(10025,'1-2021-2022-2',1),(10026,'1-2021-2022-2',1),(10027,'1-2021-2022-2',1),(10028,'1-2021-2022-2',1),(10029,'1-2021-2022-2',1),(10030,'1-2021-2022-2',1),(10031,'1-2021-2022-2',1),(10032,'1-2021-2022-2',1);
/*!40000 ALTER TABLE `copias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `devolucion`
--

DROP TABLE IF EXISTS `devolucion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `devolucion` (
  `idDevolucion` int(11) NOT NULL AUTO_INCREMENT,
  `idPrestamo` int(11) NOT NULL,
  `idBbliotecario` int(11) NOT NULL,
  `fecha_devolucion` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idDevolucion`),
  UNIQUE KEY `idPrestamo` (`idPrestamo`),
  KEY `idBbliotecario` (`idBbliotecario`),
  CONSTRAINT `devolucion_ibfk_1` FOREIGN KEY (`idPrestamo`) REFERENCES `prestamo` (`idPrestamo`),
  CONSTRAINT `devolucion_ibfk_2` FOREIGN KEY (`idBbliotecario`) REFERENCES `bibliotecario` (`codigoBbliotecario`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `devolucion`
--

LOCK TABLES `devolucion` WRITE;
/*!40000 ALTER TABLE `devolucion` DISABLE KEYS */;
INSERT INTO `devolucion` VALUES (5,18,1000,'2022-06-18'),(10,24,1000,'2022-06-18'),(11,25,1000,'2022-06-18');
/*!40000 ALTER TABLE `devolucion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lector`
--

DROP TABLE IF EXISTS `lector`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lector` (
  `codigoLector` int(11) NOT NULL,
  UNIQUE KEY `codigoLector` (`codigoLector`),
  CONSTRAINT `lector_ibfk_1` FOREIGN KEY (`codigoLector`) REFERENCES `usuario` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lector`
--

LOCK TABLES `lector` WRITE;
/*!40000 ALTER TABLE `lector` DISABLE KEYS */;
INSERT INTO `lector` VALUES (1001),(1002);
/*!40000 ALTER TABLE `lector` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `libro`
--

DROP TABLE IF EXISTS `libro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `libro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `isbn` varchar(18) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `idAutor` int(11) NOT NULL,
  `tipoLibro` tinyint(3) NOT NULL,
  `codigoBbliotecario` int(11) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `fechaRegistro` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `isbn` (`isbn`),
  KEY `codigoBbliotecario` (`codigoBbliotecario`),
  KEY `idAutor` (`idAutor`),
  KEY `tipoLibro` (`tipoLibro`),
  CONSTRAINT `libro_ibfk_1` FOREIGN KEY (`idAutor`) REFERENCES `autor` (`idAutor`),
  CONSTRAINT `libro_ibfk_2` FOREIGN KEY (`codigoBbliotecario`) REFERENCES `bibliotecario` (`codigoBbliotecario`),
  CONSTRAINT `libro_ibfk_3` FOREIGN KEY (`tipoLibro`) REFERENCES `tipos-de-libros` (`idtipoLibro`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `libro`
--

LOCK TABLES `libro` WRITE;
/*!40000 ALTER TABLE `libro` DISABLE KEYS */;
INSERT INTO `libro` VALUES (1,'0-2021-2022-1','Hamlet',2,2,1000,'default.png',1,'2022-06-05 13:11:00'),(2,'1-2021-2022-2','El rey Lear',2,2,1000,'default.png',1,'2022-06-05 13:39:38');
/*!40000 ALTER TABLE `libro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `multas`
--

DROP TABLE IF EXISTS `multas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `multas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigoLector` int(11) NOT NULL,
  `monto` decimal(4,2) NOT NULL DEFAULT 0.00,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `codigoLector` (`codigoLector`),
  CONSTRAINT `multas_ibfk_2` FOREIGN KEY (`codigoLector`) REFERENCES `lector` (`codigoLector`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `multas`
--

LOCK TABLES `multas` WRITE;
/*!40000 ALTER TABLE `multas` DISABLE KEYS */;
/*!40000 ALTER TABLE `multas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prestamo`
--

DROP TABLE IF EXISTS `prestamo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prestamo` (
  `idPrestamo` int(11) NOT NULL AUTO_INCREMENT,
  `fechaPrestamo` date NOT NULL DEFAULT current_timestamp(),
  `fechaDevolucion` date NOT NULL,
  `codigoLector` int(11) NOT NULL,
  `codigoBbliotecario` int(11) NOT NULL,
  `codigo_copia` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idPrestamo`),
  KEY `codigoLector` (`codigoLector`),
  KEY `codigoBbliotecario` (`codigoBbliotecario`),
  KEY `codigo_copia` (`codigo_copia`),
  CONSTRAINT `prestamo_ibfk_2` FOREIGN KEY (`codigoLector`) REFERENCES `lector` (`codigoLector`),
  CONSTRAINT `prestamo_ibfk_3` FOREIGN KEY (`codigoBbliotecario`) REFERENCES `bibliotecario` (`codigoBbliotecario`),
  CONSTRAINT `prestamo_ibfk_4` FOREIGN KEY (`codigo_copia`) REFERENCES `copias` (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prestamo`
--

LOCK TABLES `prestamo` WRITE;
/*!40000 ALTER TABLE `prestamo` DISABLE KEYS */;
INSERT INTO `prestamo` VALUES (18,'2022-06-15','2022-07-13',1001,1000,10000,2),(24,'2022-06-18','2022-07-16',1002,1000,10000,2),(25,'2022-06-18','2022-07-16',1001,1000,10020,2),(26,'2022-06-18','2022-07-16',1001,1000,10020,1),(27,'2022-06-18','2022-07-16',1002,1000,10000,1);
/*!40000 ALTER TABLE `prestamo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipos-de-libros`
--

DROP TABLE IF EXISTS `tipos-de-libros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipos-de-libros` (
  `idtipoLibro` tinyint(3) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `fecha-registro` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idtipoLibro`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipos-de-libros`
--

LOCK TABLES `tipos-de-libros` WRITE;
/*!40000 ALTER TABLE `tipos-de-libros` DISABLE KEYS */;
INSERT INTO `tipos-de-libros` VALUES (1,'Científicos','La ciencia (del latín scientĭa, \'conocimiento\') es un sistema que organiza y construye el conocimiento a través de preguntas comprobables y un método estructurado que estudia e interpreta los fenómenos naturales, sociales y artificiales.','2022-06-04 00:00:00'),(2,'Literatura y lingüísticos','Según la Real Academia Española (RAE), literatura es el «arte de la expresión verbal»1​ (entendiéndose como verbal aquello «que se refiere a la palabra, o se sirve de ella»2​) y, por lo tanto, abarca tanto textos escritos (literatura escrita) como hablados o cantados (literatura oral).','2022-06-04 00:00:00'),(3,'De viaje','Libro de viaje, es la exposición de las experiencias y observaciones realizadas por un viajero, y puede acompañarse de mapas, dibujos, grabados, fotografías, etcétera, realizadas por el autor o por sus compañeros de viaje.','2022-06-04 00:00:00'),(4,'Biografía','La biografía es la historia de la vida de una persona narrada por otra persona, es decir, en pleno sentido desde su nacimiento hasta su muerte.','2022-06-04 00:00:00'),(5,'Libro de texto','Un libro de texto es un libro estándar en cualquier rama de estudio y corresponde a un recurso didáctico de tipo impreso que sirve como material de apoyo a las estrategias metodológicas del docente y enriquece el proceso de enseñanza-aprendizaje.','2022-06-04 22:30:49'),(6,'De referencia o consulta',NULL,'2022-06-04 22:30:49'),(9,'Monografías','Una monografía es un documento que trata un tema en particular porque está dedicado a utilizar diversas fuentes compiladas y procesadas por uno o por varios autores.','2022-06-16 21:10:39');
/*!40000 ALTER TABLE `tipos-de-libros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `telefono` varchar(11) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `imagen` varchar(1000) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `fechaRegistro` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=1004 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1000,'Nicolas','80508050','casa','us@gmail.com','12345',NULL,1,'2022-06-04 22:20:38'),(1001,'Edgar Allan Poe','95950000','Calle No. 1040','allanpoe@biblioteca.com','12345',NULL,1,'2022-06-06 12:37:52'),(1002,'M.Émile Lauvriére','','Calle No. 1221','m.emile@biblioteca.com','12345',NULL,1,'2022-06-06 12:37:52');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `v_editar_libro`
--

DROP TABLE IF EXISTS `v_editar_libro`;
/*!50001 DROP VIEW IF EXISTS `v_editar_libro`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `v_editar_libro` (
  `ideditar` tinyint NOT NULL,
  `isbn` tinyint NOT NULL,
  `titulo` tinyint NOT NULL,
  `id autor` tinyint NOT NULL,
  `nombre autor` tinyint NOT NULL,
  `id tipo libro` tinyint NOT NULL,
  `tipo de libro` tinyint NOT NULL,
  `imagen` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `v_libros`
--

DROP TABLE IF EXISTS `v_libros`;
/*!50001 DROP VIEW IF EXISTS `v_libros`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `v_libros` (
  `id libro` tinyint NOT NULL,
  `isbn` tinyint NOT NULL,
  `titulo` tinyint NOT NULL,
  `codigoBibliotecario` tinyint NOT NULL,
  `copias` tinyint NOT NULL,
  `Autor` tinyint NOT NULL,
  `Tipo de Libro` tinyint NOT NULL,
  `image` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Dumping events for database 'bd_biblioteca'
--

--
-- Dumping routines for database 'bd_biblioteca'
--
/*!50003 DROP FUNCTION IF EXISTS `mostrarCopias` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `mostrarCopias`(code INT) RETURNS int(11)
begin
declare i1 INT;
set i1 = (select count(0) from copias where estado = 1 and isbn = code);
return i1;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insertarCopias` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarCopias`(IN `isbn` VARCHAR(18), IN `cantidad` INT(11))
BEGIN
    DECLARE
        i INT DEFAULT 1 ; WHILE(i <= cantidad)
    DO
    INSERT INTO `copias`(`isbn`)
VALUES(isbn) ;
SET
    i = i +1 ;
END WHILE ;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Final view structure for view `v_editar_libro`
--

/*!50001 DROP TABLE IF EXISTS `v_editar_libro`*/;
/*!50001 DROP VIEW IF EXISTS `v_editar_libro`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_editar_libro` AS select `lib`.`id` AS `ideditar`,`lib`.`isbn` AS `isbn`,`lib`.`titulo` AS `titulo`,`lib`.`idAutor` AS `id autor`,`au`.`nombre` AS `nombre autor`,`lib`.`tipoLibro` AS `id tipo libro`,`tlib`.`nombre` AS `tipo de libro`,`lib`.`image` AS `imagen` from ((`libro` `lib` join `autor` `au`) join `tipos-de-libros` `tlib` on(`lib`.`idAutor` = `au`.`idAutor`)) where `lib`.`tipoLibro` = `tlib`.`idtipoLibro` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_libros`
--

/*!50001 DROP TABLE IF EXISTS `v_libros`*/;
/*!50001 DROP VIEW IF EXISTS `v_libros`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_libros` AS select `lib`.`id` AS `id libro`,`lib`.`isbn` AS `isbn`,`lib`.`titulo` AS `titulo`,`lib`.`codigoBbliotecario` AS `codigoBibliotecario`,`mostrarCopias`(`lib`.`isbn`) AS `copias`,`au`.`nombre` AS `Autor`,`tlib`.`nombre` AS `Tipo de Libro`,`lib`.`image` AS `image` from (((`libro` `lib` join `copias` `cop`) join `autor` `au`) join `tipos-de-libros` `tlib` on(`lib`.`isbn` = `cop`.`isbn`)) where `lib`.`isbn` = `cop`.`isbn` and `lib`.`idAutor` = `au`.`idAutor` and `lib`.`tipoLibro` = `tlib`.`idtipoLibro` group by `lib`.`isbn` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-06-18 22:43:15