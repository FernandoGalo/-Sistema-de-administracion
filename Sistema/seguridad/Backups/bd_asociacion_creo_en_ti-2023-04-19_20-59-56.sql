DROP TABLE IF EXISTS `tbl_area_trabajo`;
CREATE TABLE `tbl_area_trabajo` (
  `ID_Area_Trabajo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_Area_Trabajo` varchar(50) NOT NULL,
  `descripcion_A_Trabajo` varchar(100) NOT NULL,
  PRIMARY KEY (`ID_Area_Trabajo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `tbl_area_trabajo` SET `ID_Area_Trabajo`='1',`nombre_Area_Trabajo`='Repartidor de Fondos',`descripcion_A_Trabajo`='la persona reparte el fondo recibido con las personass';
INSERT INTO `tbl_area_trabajo` SET `ID_Area_Trabajo`='2',`nombre_Area_Trabajo`='Conductor de bus',`descripcion_A_Trabajo`='Conduce el bus para mover a los miembros de la Asociación';

DROP TABLE IF EXISTS `tbl_datos_asociacion`;
CREATE TABLE `tbl_datos_asociacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  `telefono` int(8) NOT NULL,
  `ubicacion` varchar(200) DEFAULT NULL,
  `correo` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `tbl_datos_asociacion` SET `id`='1',`nombre`='Asociación Creo en Ti',`telefono`='22220493',`ubicacion`='Barrio La Ronda, Avenida Máximo Jerez, Edificio La Ronda Tegucigalpa, Honduras.',`correo`='asociacioncreoenti@gmail.com';

DROP TABLE IF EXISTS `tbl_donantes`;
CREATE TABLE `tbl_donantes` (
  `ID_Donante` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_D` varchar(30) NOT NULL,
  `Tel_cel_D` varchar(15) NOT NULL,
  `Direccion_D` varchar(30) NOT NULL,
  `Correo_D` varchar(30) NOT NULL,
  `Creado_Por` tinytext NOT NULL,
  `Fecha_Creacion` date NOT NULL,
  `Modificado_por` tinytext NOT NULL,
  `Fecha_Modificacion` date NOT NULL,
  PRIMARY KEY (`ID_Donante`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `tbl_donantes` SET `ID_Donante`='1',`Nombre_D`='Ramon Ramirez',`Tel_cel_D`='98058465',`Direccion_D`='Tegucigalpa',`Correo_D`='Tegucigalpa',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-03-30',`Modificado_por`='ADMIN',`Fecha_Modificacion`='2023-03-30';

DROP TABLE IF EXISTS `tbl_errores`;
CREATE TABLE `tbl_errores` (
  `ID_Error` int(20) NOT NULL AUTO_INCREMENT,
  `codigo` int(200) NOT NULL,
  `mensaje` varchar(100) NOT NULL,
  PRIMARY KEY (`ID_Error`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `tbl_errores` SET `ID_Error`='1',`codigo`='1451',`mensaje`='No se puede eliminar el registro debido a llave foránea por referencia';
INSERT INTO `tbl_errores` SET `ID_Error`='2',`codigo`='1062',`mensaje`='No se pudo crear el usuario debido a que no pueden haber usuarios duplicados';
INSERT INTO `tbl_errores` SET `ID_Error`='3',`codigo`='1049',`mensaje`='No se pudo establecer la conexion, parametros mal colocados.';

DROP TABLE IF EXISTS `tbl_fondos`;
CREATE TABLE `tbl_fondos` (
  `ID_de_Fondo` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Tipo_Fondo` int(11) NOT NULL,
  `Nombre_del_Objeto` varchar(50) NOT NULL,
  `Cantidad_Rec` int(11) NOT NULL,
  `Valor_monetario` float NOT NULL,
  `Fecha_de_adquisicion_F` date NOT NULL,
  `ID_Proyecto` int(11) NOT NULL,
  `ID_Donante` int(11) NOT NULL,
  `ID_Usuario` int(11) NOT NULL,
  `Creado_Por` tinytext NOT NULL,
  `Fecha_Creacion` date NOT NULL,
  `Modificado_por` tinytext NOT NULL,
  `Fecha_Modificacion` date NOT NULL,
  PRIMARY KEY (`ID_de_Fondo`),
  KEY `ID_Tipo_Fondo` (`ID_Tipo_Fondo`),
  KEY `ID_Proyecto` (`ID_Proyecto`),
  KEY `ID_Usuario` (`ID_Usuario`),
  KEY `ID_Donante` (`ID_Donante`),
  CONSTRAINT `tbl_fondos_ibfk_1` FOREIGN KEY (`ID_Tipo_Fondo`) REFERENCES `tbl_tipos_de_fondos` (`ID_tipo_fondo`),
  CONSTRAINT `tbl_fondos_ibfk_2` FOREIGN KEY (`ID_Proyecto`) REFERENCES `tbl_proyectos` (`ID_proyecto`),
  CONSTRAINT `tbl_fondos_ibfk_3` FOREIGN KEY (`ID_Donante`) REFERENCES `tbl_donantes` (`ID_Donante`),
  CONSTRAINT `tbl_fondos_ibfk_4` FOREIGN KEY (`ID_Usuario`) REFERENCES `tbl_ms_usuario` (`ID_Usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `tbl_fondos` SET `ID_de_Fondo`='1',`ID_Tipo_Fondo`='1',`Nombre_del_Objeto`='perilifrina',`Cantidad_Rec`='1000',`Valor_monetario`='200001',`Fecha_de_adquisicion_F`='2023-04-16',`ID_Proyecto`='3',`ID_Donante`='1',`ID_Usuario`='1',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-04-16',`Modificado_por`='ADMIN',`Fecha_Modificacion`='2023-04-17';
INSERT INTO `tbl_fondos` SET `ID_de_Fondo`='3',`ID_Tipo_Fondo`='2',`Nombre_del_Objeto`='Pantalon1',`Cantidad_Rec`='50',`Valor_monetario`='20000',`Fecha_de_adquisicion_F`='2023-04-15',`ID_Proyecto`='3',`ID_Donante`='1',`ID_Usuario`='1',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-04-15',`Modificado_por`='ADMIN',`Fecha_Modificacion`='2023-04-18';
INSERT INTO `tbl_fondos` SET `ID_de_Fondo`='4',`ID_Tipo_Fondo`='1',`Nombre_del_Objeto`='Jeringa',`Cantidad_Rec`='3',`Valor_monetario`='20030',`Fecha_de_adquisicion_F`='2023-04-15',`ID_Proyecto`='1',`ID_Donante`='1',`ID_Usuario`='1',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-04-16',`Modificado_por`='ADMIN',`Fecha_Modificacion`='2023-04-16';
INSERT INTO `tbl_fondos` SET `ID_de_Fondo`='7',`ID_Tipo_Fondo`='1',`Nombre_del_Objeto`='gggez',`Cantidad_Rec`='1234',`Valor_monetario`='1234',`Fecha_de_adquisicion_F`='2023-04-18',`ID_Proyecto`='3',`ID_Donante`='1',`ID_Usuario`='1',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-04-17',`Modificado_por`='ADMIN',`Fecha_Modificacion`='2023-04-17';
INSERT INTO `tbl_fondos` SET `ID_de_Fondo`='8',`ID_Tipo_Fondo`='1',`Nombre_del_Objeto`='fsdafsd',`Cantidad_Rec`='1111',`Valor_monetario`='1111',`Fecha_de_adquisicion_F`='2023-04-17',`ID_Proyecto`='1',`ID_Donante`='1',`ID_Usuario`='1',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-04-18',`Modificado_por`='ADMIN',`Fecha_Modificacion`='2023-04-18';

DROP TABLE IF EXISTS `tbl_ms_bitacora`;
CREATE TABLE `tbl_ms_bitacora` (
  `ID_Bitacora` int(11) NOT NULL AUTO_INCREMENT,
  `Fecha` datetime NOT NULL,
  `ID_Usuario` int(11) NOT NULL,
  `ID_Objeto` int(11) NOT NULL,
  `Accion` tinytext NOT NULL,
  `Descripcion` text NOT NULL,
  PRIMARY KEY (`ID_Bitacora`),
  KEY `ID_Usuario` (`ID_Usuario`),
  KEY `ID_Objeto` (`ID_Objeto`),
  CONSTRAINT `tbl_ms_bitacora_ibfk_1` FOREIGN KEY (`ID_Usuario`) REFERENCES `tbl_ms_usuario` (`ID_Usuario`),
  CONSTRAINT `tbl_ms_bitacora_ibfk_2` FOREIGN KEY (`ID_Objeto`) REFERENCES `tbl_objetos` (`ID_Objeto`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='1',`Fecha`='2023-04-13 00:00:00',`ID_Usuario`='1',`ID_Objeto`='1',`Accion`='Inicio de sesion',`Descripcion`='Entro al sistema';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='2',`Fecha`='2023-04-13 00:00:00',`ID_Usuario`='27824',`ID_Objeto`='1',`Accion`='Inicio de sesion',`Descripcion`='Entro al sistema';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='3',`Fecha`='2023-04-13 00:00:00',`ID_Usuario`='1',`ID_Objeto`='1',`Accion`='Inicio de sesion',`Descripcion`='Entro al sistema';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='4',`Fecha`='2023-04-13 00:00:00',`ID_Usuario`='1',`ID_Objeto`='1',`Accion`='Inicio de sesion',`Descripcion`='Entro al sistema';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='5',`Fecha`='2023-04-13 00:00:00',`ID_Usuario`='1',`ID_Objeto`='1',`Accion`='Inicio de sesion',`Descripcion`='Entro al sistema';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='6',`Fecha`='2023-04-13 00:00:00',`ID_Usuario`='1',`ID_Objeto`='1',`Accion`='Inicio de sesion',`Descripcion`='Entro al sistema';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='7',`Fecha`='2023-04-13 00:00:00',`ID_Usuario`='1',`ID_Objeto`='1',`Accion`='Inicio de sesion',`Descripcion`='Entro al sistema';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='8',`Fecha`='2023-04-13 00:00:00',`ID_Usuario`='1',`ID_Objeto`='1',`Accion`='Inicio de sesion',`Descripcion`='Entro al sistema';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='9',`Fecha`='2023-04-13 00:00:00',`ID_Usuario`='1',`ID_Objeto`='1',`Accion`='Inicio de sesion',`Descripcion`='Entro al sistema';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='10',`Fecha`='2023-04-13 00:00:00',`ID_Usuario`='1',`ID_Objeto`='1',`Accion`='Inicio de sesion',`Descripcion`='Entro al sistema';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='11',`Fecha`='2023-04-13 00:00:00',`ID_Usuario`='1',`ID_Objeto`='1',`Accion`='Inicio de sesion',`Descripcion`='Entro al sistema';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='12',`Fecha`='2023-04-13 00:00:00',`ID_Usuario`='1',`ID_Objeto`='1',`Accion`='Creacion de usuario',`Descripcion`='Nuevo usuario agregado: ';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='13',`Fecha`='2023-04-13 00:00:00',`ID_Usuario`='1',`ID_Objeto`='1',`Accion`='Inicio de sesion',`Descripcion`='Entro al sistema';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='14',`Fecha`='2023-04-13 00:00:00',`ID_Usuario`='1',`ID_Objeto`='1',`Accion`='Creacion de usuario',`Descripcion`='Nuevo usuario agregado: ';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='15',`Fecha`='2023-04-13 00:00:00',`ID_Usuario`='1',`ID_Objeto`='1',`Accion`='Inicio de sesion',`Descripcion`='Entro al sistema';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='16',`Fecha`='2023-04-13 00:00:00',`ID_Usuario`='1',`ID_Objeto`='1',`Accion`='Creacion de usuario',`Descripcion`='Nuevo usuario agregado: ';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='17',`Fecha`='2023-04-13 00:00:00',`ID_Usuario`='1',`ID_Objeto`='1',`Accion`='Inicio de sesion',`Descripcion`='Entro al sistema';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='18',`Fecha`='2023-04-13 00:00:00',`ID_Usuario`='1',`ID_Objeto`='1',`Accion`='Inicio de sesion',`Descripcion`='Entro al sistema';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='19',`Fecha`='2023-04-13 00:00:00',`ID_Usuario`='1',`ID_Objeto`='1',`Accion`='Inicio de sesion',`Descripcion`='Entro al sistema';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='20',`Fecha`='2023-04-13 00:00:00',`ID_Usuario`='1',`ID_Objeto`='1',`Accion`='Inicio de sesion',`Descripcion`='Entro al sistema';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='21',`Fecha`='2023-04-13 00:00:00',`ID_Usuario`='1',`ID_Objeto`='1',`Accion`='Inicio de sesion',`Descripcion`='Entro al sistema';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='22',`Fecha`='2023-04-13 00:00:00',`ID_Usuario`='1',`ID_Objeto`='1',`Accion`='Inicio de sesion',`Descripcion`='Entro al sistema';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='23',`Fecha`='2023-04-13 00:00:00',`ID_Usuario`='1',`ID_Objeto`='1',`Accion`='Inicio de sesion',`Descripcion`='Entro al sistema';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='24',`Fecha`='2023-04-13 00:00:00',`ID_Usuario`='1',`ID_Objeto`='1',`Accion`='Inicio de sesion',`Descripcion`='Entro al sistema';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='25',`Fecha`='2023-04-13 00:00:00',`ID_Usuario`='1',`ID_Objeto`='1',`Accion`='Inicio de sesion',`Descripcion`='Entro al sistema';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='26',`Fecha`='2023-04-13 00:00:00',`ID_Usuario`='1',`ID_Objeto`='1',`Accion`='Inicio de sesion',`Descripcion`='Entro al sistema';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='27',`Fecha`='2023-04-13 00:00:00',`ID_Usuario`='1',`ID_Objeto`='1',`Accion`='Inicio de sesion',`Descripcion`='Entro al sistema';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='28',`Fecha`='2023-04-13 00:00:00',`ID_Usuario`='1',`ID_Objeto`='1',`Accion`='Inicio de sesion',`Descripcion`='Entro al sistema';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='29',`Fecha`='2023-04-13 00:00:00',`ID_Usuario`='1',`ID_Objeto`='1',`Accion`='Inicio de sesion',`Descripcion`='Entro al sistema';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='30',`Fecha`='2023-04-13 00:00:00',`ID_Usuario`='1',`ID_Objeto`='1',`Accion`='Inicio de sesion',`Descripcion`='Entro al sistema';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='31',`Fecha`='2023-04-13 00:00:00',`ID_Usuario`='1',`ID_Objeto`='1',`Accion`='Inicio de sesion',`Descripcion`='Entro al sistema';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='32',`Fecha`='2023-04-13 00:00:00',`ID_Usuario`='1',`ID_Objeto`='1',`Accion`='Inicio de sesion',`Descripcion`='Entro al sistema';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='33',`Fecha`='2023-04-13 00:00:00',`ID_Usuario`='1',`ID_Objeto`='1',`Accion`='Inicio de sesion',`Descripcion`='Entro al sistema';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='34',`Fecha`='2023-04-13 00:00:00',`ID_Usuario`='1',`ID_Objeto`='1',`Accion`='Eliminacion de usuario',`Descripcion`='Se elimino el usuario: JOSEPH';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='35',`Fecha`='2023-04-16 00:00:00',`ID_Usuario`='1',`ID_Objeto`='1',`Accion`='Inicio de sesion',`Descripcion`='Entro al sistema';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='36',`Fecha`='2023-04-16 00:00:00',`ID_Usuario`='1',`ID_Objeto`='1',`Accion`='Creacion de usuario',`Descripcion`='Nuevo usuario agregado: ';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='37',`Fecha`='2023-04-16 00:00:00',`ID_Usuario`='1',`ID_Objeto`='1',`Accion`='Eliminacion de fondo',`Descripcion`='Se elimino el fondo: 2';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='38',`Fecha`='2023-04-16 05:43:10',`ID_Usuario`='1',`ID_Objeto`='0',`Accion`='Inicio de sesion',`Descripcion`='Entro al sistema';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='39',`Fecha`='2023-04-16 05:45:12',`ID_Usuario`='1',`ID_Objeto`='7',`Accion`='Registro de fondo',`Descripcion`='Se registro el fondo: ';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='40',`Fecha`='2023-04-16 05:45:29',`ID_Usuario`='1',`ID_Objeto`='7',`Accion`='Registro de fondo',`Descripcion`='Se registro el fondo: ';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='41',`Fecha`='2023-04-16 05:45:35',`ID_Usuario`='1',`ID_Objeto`='7',`Accion`='Eliminacion de fondo',`Descripcion`='Se elimino el fondo: 5';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='42',`Fecha`='2023-04-16 06:20:43',`ID_Usuario`='1',`ID_Objeto`='7',`Accion`='Modificacion de fondo',`Descripcion`='Se modifico el fondo: 4';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='43',`Fecha`='2023-04-16 06:24:41',`ID_Usuario`='1',`ID_Objeto`='7',`Accion`='Modificacion de fondo',`Descripcion`='Se modifico el fondo: 4';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='44',`Fecha`='2023-04-16 06:24:56',`ID_Usuario`='1',`ID_Objeto`='7',`Accion`='Registro de fondo',`Descripcion`='Se registro el fondo: ';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='45',`Fecha`='2023-04-16 06:25:00',`ID_Usuario`='1',`ID_Objeto`='7',`Accion`='Eliminacion de fondo',`Descripcion`='Se elimino el fondo: 6';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='46',`Fecha`='2023-04-16 05:38:41',`ID_Usuario`='1',`ID_Objeto`='0',`Accion`='Inicio de sesion',`Descripcion`='Entro al sistema';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='47',`Fecha`='2023-04-16 10:07:32',`ID_Usuario`='1',`ID_Objeto`='0',`Accion`='Inicio de sesion',`Descripcion`='Entro al sistema';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='48',`Fecha`='2023-04-17 09:57:32',`ID_Usuario`='1',`ID_Objeto`='0',`Accion`='Inicio de sesion',`Descripcion`='Entro al sistema';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='49',`Fecha`='2023-04-17 11:51:14',`ID_Usuario`='1',`ID_Objeto`='7',`Accion`='Registro de fondo',`Descripcion`='Se registro el fondo: ';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='50',`Fecha`='2023-04-17 11:53:39',`ID_Usuario`='1',`ID_Objeto`='7',`Accion`='Modificacion de fondo',`Descripcion`='Se modifico el fondo: 1';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='51',`Fecha`='2023-04-18 12:14:19',`ID_Usuario`='1',`ID_Objeto`='7',`Accion`='Registro de fondo',`Descripcion`='Se registro el fondo: ';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='52',`Fecha`='2023-04-18 12:15:49',`ID_Usuario`='1',`ID_Objeto`='7',`Accion`='Modificacion de fondo',`Descripcion`='Se modifico el fondo: 3';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='53',`Fecha`='2023-04-18 12:37:28',`ID_Usuario`='1',`ID_Objeto`='1',`Accion`='Creacion de usuario',`Descripcion`='Nuevo usuario agregado: ';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='54',`Fecha`='2023-04-18 12:37:40',`ID_Usuario`='1',`ID_Objeto`='1',`Accion`='Creacion de usuario',`Descripcion`='Nuevo usuario agregado: ';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='55',`Fecha`='2023-04-18 12:37:50',`ID_Usuario`='1',`ID_Objeto`='1',`Accion`='Creacion de usuario',`Descripcion`='Nuevo usuario agregado: ';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='56',`Fecha`='2023-04-18 06:04:48',`ID_Usuario`='1',`ID_Objeto`='1',`Accion`='Creacion de usuario',`Descripcion`='Nuevo usuario agregado: AAA';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='57',`Fecha`='2023-04-18 06:04:51',`ID_Usuario`='1',`ID_Objeto`='1',`Accion`='Eliminacion de usuario',`Descripcion`='Se elimino el usuario: ';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='58',`Fecha`='2023-04-18 06:05:27',`ID_Usuario`='1',`ID_Objeto`='1',`Accion`='Eliminacion de usuario',`Descripcion`='Se elimino el usuario: ';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='59',`Fecha`='2023-04-18 06:07:29',`ID_Usuario`='1',`ID_Objeto`='1',`Accion`='Eliminacion de usuario',`Descripcion`='Se elimino el usuario: ';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='60',`Fecha`='2023-04-18 06:07:47',`ID_Usuario`='1',`ID_Objeto`='1',`Accion`='Eliminacion de usuario',`Descripcion`='Se elimino el usuario: ';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='61',`Fecha`='2023-04-18 06:08:03',`ID_Usuario`='1',`ID_Objeto`='1',`Accion`='Modificacion de usuario',`Descripcion`='Se modifico el usuario: aaaa';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='62',`Fecha`='2023-04-18 06:08:08',`ID_Usuario`='1',`ID_Objeto`='1',`Accion`='Eliminacion de usuario',`Descripcion`='Se elimino el usuario: ';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='63',`Fecha`='2023-04-18 06:11:16',`ID_Usuario`='1',`ID_Objeto`='1',`Accion`='Eliminacion de usuario',`Descripcion`='Se elimino el usuario: 52964';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='64',`Fecha`='2023-04-18 07:10:37',`ID_Usuario`='1',`ID_Objeto`='9',`Accion`='Eliminacion de voluntario',`Descripcion`='Se elimino el Voluntario: 20';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='65',`Fecha`='2023-04-18 07:12:18',`ID_Usuario`='1',`ID_Objeto`='9',`Accion`='Creacion de voluntario',`Descripcion`='Nuevo Voluntario agregado: gor';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='66',`Fecha`='2023-04-18 07:12:38',`ID_Usuario`='1',`ID_Objeto`='9',`Accion`='Modificacion de voluntario',`Descripcion`='Se modifico el voluntario: gorila';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='67',`Fecha`='2023-04-18 07:19:43',`ID_Usuario`='1',`ID_Objeto`='9',`Accion`='Creacion de voluntario',`Descripcion`='Nuevo Voluntario agregado: GORr';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='68',`Fecha`='2023-04-18 07:19:52',`ID_Usuario`='1',`ID_Objeto`='9',`Accion`='Eliminacion de voluntario',`Descripcion`='Se elimino el Voluntario: 3';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='69',`Fecha`='2023-04-18 07:20:01',`ID_Usuario`='1',`ID_Objeto`='9',`Accion`='Creacion de voluntario',`Descripcion`='Nuevo Voluntario agregado: GORRr';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='70',`Fecha`='2023-04-18 07:20:10',`ID_Usuario`='1',`ID_Objeto`='9',`Accion`='Eliminacion de voluntario',`Descripcion`='Se elimino el Voluntario: 0';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='71',`Fecha`='2023-04-18 07:20:15',`ID_Usuario`='1',`ID_Objeto`='9',`Accion`='Eliminacion de voluntario',`Descripcion`='Se elimino el Voluntario: 3';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='72',`Fecha`='2023-04-18 07:20:22',`ID_Usuario`='1',`ID_Objeto`='9',`Accion`='Creacion de voluntario',`Descripcion`='Nuevo Voluntario agregado: FSEDf';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='73',`Fecha`='2023-04-18 08:41:44',`ID_Usuario`='1',`ID_Objeto`='10',`Accion`='Modificacion de pago',`Descripcion`='Se modifico el pago: 1';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='74',`Fecha`='2023-04-18 08:42:03',`ID_Usuario`='1',`ID_Objeto`='10',`Accion`='Modificacion de pago',`Descripcion`='Se modifico el pago: 3';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='75',`Fecha`='2023-04-18 08:42:20',`ID_Usuario`='1',`ID_Objeto`='10',`Accion`='Creacion de Pago',`Descripcion`='Nuevo Pago agregado: 11';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='76',`Fecha`='2023-04-18 08:55:03',`ID_Usuario`='1',`ID_Objeto`='8',`Accion`='Creacion de Donante',`Descripcion`='Nuevo Donante agregado: GORILA';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='77',`Fecha`='2023-04-18 08:55:12',`ID_Usuario`='1',`ID_Objeto`='8',`Accion`='Modificacion de donante',`Descripcion`='Se modifico el donante: GORILAaaaaaa';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='78',`Fecha`='2023-04-18 08:55:17',`ID_Usuario`='1',`ID_Objeto`='8',`Accion`='Eliminacion de Donante',`Descripcion`='Se elimino el Donante: 86781';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='79',`Fecha`='2023-04-18 09:16:54',`ID_Usuario`='1',`ID_Objeto`='7',`Accion`='Registro de fondo',`Descripcion`='Se registro el fondo: ';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='80',`Fecha`='2023-04-18 09:17:08',`ID_Usuario`='1',`ID_Objeto`='7',`Accion`='Modificacion de fondo',`Descripcion`='Se modifico el fondo: 9';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='81',`Fecha`='2023-04-18 09:17:13',`ID_Usuario`='1',`ID_Objeto`='7',`Accion`='Eliminacion de fondo',`Descripcion`='Se elimino el fondo: 9';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='82',`Fecha`='2023-04-18 09:38:12',`ID_Usuario`='1',`ID_Objeto`='10',`Accion`='Modificacion de pago',`Descripcion`='Se modifico el pago: 1';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='83',`Fecha`='2023-04-18 09:38:17',`ID_Usuario`='1',`ID_Objeto`='10',`Accion`='Modificacion de pago',`Descripcion`='Se modifico el pago: 2';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='84',`Fecha`='2023-04-18 09:38:31',`ID_Usuario`='1',`ID_Objeto`='10',`Accion`='Creacion de Pago',`Descripcion`='Nuevo Pago agregado: 43324';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='85',`Fecha`='2023-04-18 09:38:39',`ID_Usuario`='1',`ID_Objeto`='10',`Accion`='Eliminacion de Pago',`Descripcion`='Se elimino el Pago: 43324';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='86',`Fecha`='2023-04-19 04:04:52',`ID_Usuario`='1',`ID_Objeto`='0',`Accion`='Inicio de sesion',`Descripcion`='Entro al sistema';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='87',`Fecha`='2023-04-19 07:20:52',`ID_Usuario`='1',`ID_Objeto`='8',`Accion`='Eliminacion de Donante',`Descripcion`='Se elimino el Donante: 2';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='88',`Fecha`='2023-04-19 07:27:05',`ID_Usuario`='1',`ID_Objeto`='7',`Accion`='Registro de fondo',`Descripcion`='Se registro el fondo: ';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='89',`Fecha`='2023-04-19 07:27:14',`ID_Usuario`='1',`ID_Objeto`='7',`Accion`='Eliminacion de fondo',`Descripcion`='Se elimino el fondo: 10';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='90',`Fecha`='2023-04-19 07:32:17',`ID_Usuario`='1',`ID_Objeto`='10',`Accion`='Eliminacion de Pago',`Descripcion`='Se elimino el Pago: 11';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='91',`Fecha`='2023-04-19 07:43:36',`ID_Usuario`='1',`ID_Objeto`='1',`Accion`='Creacion de usuario',`Descripcion`='Nuevo usuario agregado: ELPRO';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='92',`Fecha`='2023-04-19 07:58:38',`ID_Usuario`='38371',`ID_Objeto`='0',`Accion`='Inicio de sesion',`Descripcion`='Entro al sistema';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='93',`Fecha`='2023-04-19 08:00:00',`ID_Usuario`='38371',`ID_Objeto`='1',`Accion`='creacion de usuario',`Descripcion`='Se autoregistro el usuario: RATATA';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='94',`Fecha`='2023-04-19 08:04:01',`ID_Usuario`='1',`ID_Objeto`='0',`Accion`='Inicio de sesion',`Descripcion`='Entro al sistema';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='95',`Fecha`='2023-04-19 08:54:06',`ID_Usuario`='1',`ID_Objeto`='0',`Accion`='Inicio de sesion',`Descripcion`='Entro al sistema';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='96',`Fecha`='2023-04-19 08:58:17',`ID_Usuario`='1',`ID_Objeto`='1',`Accion`='creacion de usuario',`Descripcion`='Se autoregistro el usuario: GG';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='97',`Fecha`='2023-04-19 08:58:46',`ID_Usuario`='64989',`ID_Objeto`='1',`Accion`='creacion de usuario',`Descripcion`='Se autoregistro el usuario: FED';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='98',`Fecha`='2023-04-19 08:59:30',`ID_Usuario`='41398',`ID_Objeto`='1',`Accion`='creacion de usuario',`Descripcion`='Se autoregistro el usuario: AADAD';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='99',`Fecha`='2023-04-19 05:02:53',`ID_Usuario`='1',`ID_Objeto`='0',`Accion`='Inicio de sesion',`Descripcion`='Entro al sistema';
INSERT INTO `tbl_ms_bitacora` SET `ID_Bitacora`='100',`Fecha`='2023-04-19 08:59:48',`ID_Usuario`='1',`ID_Objeto`='0',`Accion`='Inicio de sesion',`Descripcion`='Entro al sistema';

DROP TABLE IF EXISTS `tbl_ms_hist_contraseña`;
CREATE TABLE `tbl_ms_hist_contraseña` (
  `ID_Hist` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Usuario` int(11) NOT NULL,
  `Contraseña` text NOT NULL,
  `Creado_Por` tinytext NOT NULL,
  `Fecha_Creacion` date NOT NULL,
  `Modificado_Por` tinytext NOT NULL,
  `Fecha_Modificacion` date NOT NULL,
  PRIMARY KEY (`ID_Hist`),
  KEY `ID_Usuario` (`ID_Usuario`),
  CONSTRAINT `tbl_ms_hist_contraseña_ibfk_1` FOREIGN KEY (`ID_Usuario`) REFERENCES `tbl_ms_usuario` (`ID_Usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `tbl_ms_hist_contraseña` SET `ID_Hist`='1',`ID_Usuario`='27824',`Contraseña`='Hola',`Creado_Por`='Elida',`Fecha_Creacion`='2023-03-28',`Modificado_Por`='Elida',`Fecha_Modificacion`='2023-03-28';
INSERT INTO `tbl_ms_hist_contraseña` SET `ID_Hist`='2',`ID_Usuario`='27824',`Contraseña`='Hola1',`Creado_Por`='Elida',`Fecha_Creacion`='2023-03-28',`Modificado_Por`='Elida',`Fecha_Modificacion`='2023-03-28';
INSERT INTO `tbl_ms_hist_contraseña` SET `ID_Hist`='3',`ID_Usuario`='27824',`Contraseña`='Hola1234',`Creado_Por`='Elida',`Fecha_Creacion`='2023-03-28',`Modificado_Por`='Elida',`Fecha_Modificacion`='2023-03-28';
INSERT INTO `tbl_ms_hist_contraseña` SET `ID_Hist`='4',`ID_Usuario`='27824',`Contraseña`='Hola4321',`Creado_Por`='Elida',`Fecha_Creacion`='2023-03-28',`Modificado_Por`='Elida',`Fecha_Modificacion`='2023-03-28';
INSERT INTO `tbl_ms_hist_contraseña` SET `ID_Hist`='5',`ID_Usuario`='27824',`Contraseña`='Hola1234',`Creado_Por`='Elida',`Fecha_Creacion`='2023-03-28',`Modificado_Por`='Elida',`Fecha_Modificacion`='2023-03-28';
INSERT INTO `tbl_ms_hist_contraseña` SET `ID_Hist`='6',`ID_Usuario`='27824',`Contraseña`='Hola4321',`Creado_Por`='Elida',`Fecha_Creacion`='2023-03-28',`Modificado_Por`='Elida',`Fecha_Modificacion`='2023-03-28';
INSERT INTO `tbl_ms_hist_contraseña` SET `ID_Hist`='7',`ID_Usuario`='38371',`Contraseña`='22aaAA??',`Creado_Por`='elpro',`Fecha_Creacion`='2023-04-19',`Modificado_Por`='elpro',`Fecha_Modificacion`='2023-04-19';
INSERT INTO `tbl_ms_hist_contraseña` SET `ID_Hist`='8',`ID_Usuario`='57893',`Contraseña`='11aaAA??',`Creado_Por`='RATATA',`Fecha_Creacion`='2023-04-19',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_ms_hist_contraseña` SET `ID_Hist`='9',`ID_Usuario`='64989',`Contraseña`='11aaAA??',`Creado_Por`='GG',`Fecha_Creacion`='2023-04-19',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_ms_hist_contraseña` SET `ID_Hist`='10',`ID_Usuario`='41398',`Contraseña`='11aaBB??',`Creado_Por`='FED',`Fecha_Creacion`='2023-04-19',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_ms_hist_contraseña` SET `ID_Hist`='11',`ID_Usuario`='92666',`Contraseña`='11bbAA??',`Creado_Por`='AADAD',`Fecha_Creacion`='2023-04-19',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';

DROP TABLE IF EXISTS `tbl_ms_parametros`;
CREATE TABLE `tbl_ms_parametros` (
  `ID_Parametro` int(11) NOT NULL AUTO_INCREMENT,
  `Parametro` tinytext NOT NULL,
  `Descripcion_P` text NOT NULL,
  `Valor` text NOT NULL,
  `ID_Usuario` int(11) NOT NULL,
  `Fecha_Creacion` date NOT NULL,
  `Fecha_Modificacion` date NOT NULL,
  PRIMARY KEY (`ID_Parametro`),
  KEY `ID_Usuario` (`ID_Usuario`),
  CONSTRAINT `tbl_ms_parametros_ibfk_1` FOREIGN KEY (`ID_Usuario`) REFERENCES `tbl_ms_usuario` (`ID_Usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `tbl_ms_parametros` SET `ID_Parametro`='1',`Parametro`='ADMIN_INTENTOS',`Descripcion_P`='CANTIDAD DE INTENTOS PERMITIDOS EN LOGIN',`Valor`='3',`ID_Usuario`='1',`Fecha_Creacion`='2023-02-23',`Fecha_Modificacion`='2023-04-13';
INSERT INTO `tbl_ms_parametros` SET `ID_Parametro`='2',`Parametro`='ADMIN_PREGUNTAS',`Descripcion_P`='CANTIDAD DE PREGUNTAS A INGRESAR',`Valor`='3',`ID_Usuario`='1',`Fecha_Creacion`='2023-02-23',`Fecha_Modificacion`='2023-02-23';
INSERT INTO `tbl_ms_parametros` SET `ID_Parametro`='3',`Parametro`='ADMIN_CORREO',`Descripcion_P`='CORREO ELECTRONICO ',`Valor`='mugitecno.123@outlook.com',`ID_Usuario`='1',`Fecha_Creacion`='2023-02-23',`Fecha_Modificacion`='2023-02-23';
INSERT INTO `tbl_ms_parametros` SET `ID_Parametro`='4',`Parametro`='ADMIN_CPUERTO',`Descripcion_P`='NUMERO DE PUERTO DEL CORREO',`Valor`='587',`ID_Usuario`='1',`Fecha_Creacion`='2023-02-23',`Fecha_Modificacion`='2023-02-23';
INSERT INTO `tbl_ms_parametros` SET `ID_Parametro`='5',`Parametro`='ADMIN_CUSER',`Descripcion_P`='NOMBRE USUARIO',`Valor`='USUARIO',`ID_Usuario`='1',`Fecha_Creacion`='2023-02-23',`Fecha_Modificacion`='2023-02-23';
INSERT INTO `tbl_ms_parametros` SET `ID_Parametro`='6',`Parametro`='ADMIN_CPASS',`Descripcion_P`='CONTRASEÑA DEL CORREO ELECTRONICO',`Valor`='mugitecno0123',`ID_Usuario`='1',`Fecha_Creacion`='2023-02-23',`Fecha_Modificacion`='2023-02-23';
INSERT INTO `tbl_ms_parametros` SET `ID_Parametro`='7',`Parametro`='ADMIN_VIGENCIA',`Descripcion_P`='VIGENCIA DE LA CONTRASEÑA EN DIAS',`Valor`='30',`ID_Usuario`='1',`Fecha_Creacion`='2023-02-20',`Fecha_Modificacion`='2023-02-20';
INSERT INTO `tbl_ms_parametros` SET `ID_Parametro`='8',`Parametro`='SYS_NOMBRE',`Descripcion_P`='NOMBRE DEL SISTEMA',`Valor`='ADMINISTRACION DE FONDOS Y PROYECTOS',`ID_Usuario`='1',`Fecha_Creacion`='2023-02-23',`Fecha_Modificacion`='2023-02-23';
INSERT INTO `tbl_ms_parametros` SET `ID_Parametro`='9',`Parametro`='MIN_CONTRASEÑA',`Descripcion_P`='LOGITUD MINIMA DE LA CONTRASEÑA',`Valor`='8',`ID_Usuario`='1',`Fecha_Creacion`='2023-04-01',`Fecha_Modificacion`='2023-04-12';
INSERT INTO `tbl_ms_parametros` SET `ID_Parametro`='10',`Parametro`='MAX_CONTRASEÑA',`Descripcion_P`='LOGITUD MAXIMA DE UNA CONTRASEÑA',`Valor`='10',`ID_Usuario`='1',`Fecha_Creacion`='2023-04-01',`Fecha_Modificacion`='2023-04-12';

DROP TABLE IF EXISTS `tbl_ms_preguntas_x_usuario`;
CREATE TABLE `tbl_ms_preguntas_x_usuario` (
  `ID_Pregunta` int(11) NOT NULL,
  `ID_Usuario` int(11) NOT NULL,
  `Respuesta` text NOT NULL,
  `Creado_Por` tinytext NOT NULL,
  `Fecha_Creacion` date NOT NULL,
  `Modificado_Por` tinytext NOT NULL,
  `Fecha_Modificacion` date NOT NULL,
  KEY `ID_Usuario` (`ID_Usuario`),
  KEY `ID_Pregunta` (`ID_Pregunta`) USING BTREE,
  CONSTRAINT `tbl_ms_preguntas_x_usuario_ibfk_1` FOREIGN KEY (`ID_Pregunta`) REFERENCES `tbl_preguntas` (`ID_Pregunta`),
  CONSTRAINT `tbl_ms_preguntas_x_usuario_ibfk_2` FOREIGN KEY (`ID_Usuario`) REFERENCES `tbl_ms_usuario` (`ID_Usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `tbl_ms_preguntas_x_usuario` SET `ID_Pregunta`='5',`ID_Usuario`='1',`Respuesta`='Pizza',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-03-02',`Modificado_Por`='ADMIN',`Fecha_Modificacion`='2023-04-12';
INSERT INTO `tbl_ms_preguntas_x_usuario` SET `ID_Pregunta`='1',`ID_Usuario`='1',`Respuesta`='Azul',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-03-01',`Modificado_Por`='ADMIN',`Fecha_Modificacion`='2023-04-01';
INSERT INTO `tbl_ms_preguntas_x_usuario` SET `ID_Pregunta`='3',`ID_Usuario`='1',`Respuesta`='Tegucigalpa',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-04-01',`Modificado_Por`='ADMIN',`Fecha_Modificacion`='2023-04-01';
INSERT INTO `tbl_ms_preguntas_x_usuario` SET `ID_Pregunta`='5',`ID_Usuario`='1',`Respuesta`='Pizza',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-03-02',`Modificado_Por`='ADMIN',`Fecha_Modificacion`='2023-04-12';
INSERT INTO `tbl_ms_preguntas_x_usuario` SET `ID_Pregunta`='1',`ID_Usuario`='1',`Respuesta`='Azul',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-03-01',`Modificado_Por`='ADMIN',`Fecha_Modificacion`='2023-04-01';
INSERT INTO `tbl_ms_preguntas_x_usuario` SET `ID_Pregunta`='3',`ID_Usuario`='1',`Respuesta`='Tegucigalpa',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-04-01',`Modificado_Por`='ADMIN',`Fecha_Modificacion`='2023-04-01';
INSERT INTO `tbl_ms_preguntas_x_usuario` SET `ID_Pregunta`='1',`ID_Usuario`='38371',`Respuesta`='red',`Creado_Por`='elpro',`Fecha_Creacion`='2023-04-19',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_ms_preguntas_x_usuario` SET `ID_Pregunta`='3',`ID_Usuario`='38371',`Respuesta`='tegu',`Creado_Por`='elpro',`Fecha_Creacion`='2023-04-19',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_ms_preguntas_x_usuario` SET `ID_Pregunta`='5',`ID_Usuario`='38371',`Respuesta`='mealt',`Creado_Por`='elpro',`Fecha_Creacion`='2023-04-19',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_ms_preguntas_x_usuario` SET `ID_Pregunta`='1',`ID_Usuario`='57893',`Respuesta`='red',`Creado_Por`='RATATA',`Fecha_Creacion`='2023-04-19',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_ms_preguntas_x_usuario` SET `ID_Pregunta`='5',`ID_Usuario`='57893',`Respuesta`='mealt',`Creado_Por`='RATATA',`Fecha_Creacion`='2023-04-19',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_ms_preguntas_x_usuario` SET `ID_Pregunta`='6',`ID_Usuario`='57893',`Respuesta`='rock',`Creado_Por`='RATATA',`Fecha_Creacion`='2023-04-19',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_ms_preguntas_x_usuario` SET `ID_Pregunta`='1',`ID_Usuario`='64989',`Respuesta`='red',`Creado_Por`='GG',`Fecha_Creacion`='2023-04-19',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_ms_preguntas_x_usuario` SET `ID_Pregunta`='1',`ID_Usuario`='64989',`Respuesta`='red',`Creado_Por`='GG',`Fecha_Creacion`='2023-04-19',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_ms_preguntas_x_usuario` SET `ID_Pregunta`='1',`ID_Usuario`='64989',`Respuesta`='red',`Creado_Por`='GG',`Fecha_Creacion`='2023-04-19',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_ms_preguntas_x_usuario` SET `ID_Pregunta`='3',`ID_Usuario`='41398',`Respuesta`='tegu',`Creado_Por`='FED',`Fecha_Creacion`='2023-04-19',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_ms_preguntas_x_usuario` SET `ID_Pregunta`='1',`ID_Usuario`='41398',`Respuesta`='red',`Creado_Por`='FED',`Fecha_Creacion`='2023-04-19',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_ms_preguntas_x_usuario` SET `ID_Pregunta`='6',`ID_Usuario`='41398',`Respuesta`='rock',`Creado_Por`='FED',`Fecha_Creacion`='2023-04-19',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_ms_preguntas_x_usuario` SET `ID_Pregunta`='1',`ID_Usuario`='92666',`Respuesta`='red',`Creado_Por`='AADAD',`Fecha_Creacion`='2023-04-19',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_ms_preguntas_x_usuario` SET `ID_Pregunta`='5',`ID_Usuario`='92666',`Respuesta`='mealt',`Creado_Por`='AADAD',`Fecha_Creacion`='2023-04-19',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_ms_preguntas_x_usuario` SET `ID_Pregunta`='6',`ID_Usuario`='92666',`Respuesta`='rock',`Creado_Por`='AADAD',`Fecha_Creacion`='2023-04-19',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';

DROP TABLE IF EXISTS `tbl_ms_roles`;
CREATE TABLE `tbl_ms_roles` (
  `ID_Rol` int(11) NOT NULL AUTO_INCREMENT,
  `Rol` text NOT NULL,
  `Descripcion` text NOT NULL,
  `Estado` int(11) NOT NULL,
  `Creado_Por` text NOT NULL,
  `Fecha_Creacion` date NOT NULL,
  `Modificado_Por` text NOT NULL,
  `Fecha_Modificacion` date NOT NULL,
  PRIMARY KEY (`ID_Rol`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `tbl_ms_roles` SET `ID_Rol`='1',`Rol`='Administrador',`Descripcion`='Persona que administrara el sistema',`Estado`='1',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-02-20',`Modificado_Por`='ADMIN',`Fecha_Modificacion`='2023-02-20';
INSERT INTO `tbl_ms_roles` SET `ID_Rol`='2',`Rol`='Editor',`Descripcion`='Puede insertar y actualizar datos',`Estado`='0',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-02-23',`Modificado_Por`='ADMIN',`Fecha_Modificacion`='2023-02-23';
INSERT INTO `tbl_ms_roles` SET `ID_Rol`='3',`Rol`='Supervisor',`Descripcion`='Puede ver datos solamente',`Estado`='0',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-02-23',`Modificado_Por`='ADMIN',`Fecha_Modificacion`='2023-02-23';
INSERT INTO `tbl_ms_roles` SET `ID_Rol`='76263',`Rol`='mmmmmm',`Descripcion`='mmmmmmmmmmmmmmmmmmmm',`Estado`='1',`Creado_Por`='',`Fecha_Creacion`='0000-00-00',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';

DROP TABLE IF EXISTS `tbl_ms_usuario`;
CREATE TABLE `tbl_ms_usuario` (
  `ID_Usuario` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Rol` int(11) NOT NULL,
  `Nombre_Usuario` text NOT NULL,
  `Usuario` tinytext NOT NULL,
  `Contraseña` text NOT NULL,
  `Correo_electronico` tinytext NOT NULL,
  `Fecha_Ultima_conexion` date NOT NULL,
  `Preguntas_Contestadas` int(11) NOT NULL,
  `Primer_Ingreso` int(11) NOT NULL,
  `Fecha_Vencimiento` date DEFAULT NULL,
  `Creado_Por` tinytext NOT NULL,
  `Fecha_Creacion` date NOT NULL,
  `Modificado_Por` tinytext NOT NULL,
  `Fecha_Modificacion` date NOT NULL,
  `Estado_Usuario` text DEFAULT NULL,
  `Intentos` int(11) DEFAULT NULL,
  `Token` text DEFAULT NULL,
  PRIMARY KEY (`ID_Usuario`),
  UNIQUE KEY `Usuario` (`Usuario`) USING HASH,
  KEY `ID_Rol` (`ID_Rol`),
  CONSTRAINT `tbl_ms_usuario_ibfk_1` FOREIGN KEY (`ID_Rol`) REFERENCES `tbl_ms_roles` (`ID_Rol`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `tbl_ms_usuario` SET `ID_Usuario`='1',`ID_Rol`='1',`Nombre_Usuario`='ADMIN',`Usuario`='ADMIN',`Contraseña`='Admin11',`Correo_electronico`='ADMIN@gmail.com',`Fecha_Ultima_conexion`='2023-04-19',`Preguntas_Contestadas`='3',`Primer_Ingreso`='1',`Fecha_Vencimiento`='2024-02-23',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-02-23',`Modificado_Por`='ADMIN',`Fecha_Modificacion`='2023-03-26',`Estado_Usuario`='ACTIVO',`Intentos`='0',`Token`='';
INSERT INTO `tbl_ms_usuario` SET `ID_Usuario`='27824',`ID_Rol`='2',`Nombre_Usuario`='Elida Alvarado',`Usuario`='ELIDA',`Contraseña`='Hola4321',`Correo_electronico`='elida.alvarado@unah.hn',`Fecha_Ultima_conexion`='2023-03-22',`Preguntas_Contestadas`='3',`Primer_Ingreso`='1',`Fecha_Vencimiento`='2023-04-27',`Creado_Por`='ELIDA',`Fecha_Creacion`='2023-03-22',`Modificado_Por`='Elida',`Fecha_Modificacion`='2023-03-28',`Estado_Usuario`='ACTIVO',`Intentos`='1',`Token`='';
INSERT INTO `tbl_ms_usuario` SET `ID_Usuario`='38371',`ID_Rol`='3',`Nombre_Usuario`='Rat kid',`Usuario`='ELPRO',`Contraseña`='22aaAA??',`Correo_electronico`='gg@gg.com',`Fecha_Ultima_conexion`='0000-00-00',`Preguntas_Contestadas`='3',`Primer_Ingreso`='0',`Fecha_Vencimiento`='2023-05-19',`Creado_Por`='',`Fecha_Creacion`='2023-04-19',`Modificado_Por`='elpro',`Fecha_Modificacion`='2023-04-19',`Estado_Usuario`='ACTIVO',`Intentos`='0',`Token`='';
INSERT INTO `tbl_ms_usuario` SET `ID_Usuario`='41398',`ID_Rol`='3',`Nombre_Usuario`='zazz',`Usuario`='FED',`Contraseña`='11aaBB??',`Correo_electronico`='gg@gg.com',`Fecha_Ultima_conexion`='2023-04-19',`Preguntas_Contestadas`='3',`Primer_Ingreso`='1',`Fecha_Vencimiento`='2023-05-19',`Creado_Por`='FED',`Fecha_Creacion`='2023-04-19',`Modificado_Por`='FED',`Fecha_Modificacion`='2023-04-19',`Estado_Usuario`='INACTIVO',`Intentos`='0',`Token`='';
INSERT INTO `tbl_ms_usuario` SET `ID_Usuario`='57893',`ID_Rol`='3',`Nombre_Usuario`='kid rat',`Usuario`='RATATA',`Contraseña`='11aaAA??',`Correo_electronico`='gg@gg.com',`Fecha_Ultima_conexion`='2023-04-19',`Preguntas_Contestadas`='3',`Primer_Ingreso`='1',`Fecha_Vencimiento`='2023-05-19',`Creado_Por`='RATATA',`Fecha_Creacion`='2023-04-19',`Modificado_Por`='RATATA',`Fecha_Modificacion`='2023-04-19',`Estado_Usuario`='INACTIVO',`Intentos`='0',`Token`='';
INSERT INTO `tbl_ms_usuario` SET `ID_Usuario`='64989',`ID_Rol`='3',`Nombre_Usuario`='zazz',`Usuario`='GG',`Contraseña`='11aaAA??',`Correo_electronico`='gg@gg.com',`Fecha_Ultima_conexion`='2023-04-19',`Preguntas_Contestadas`='3',`Primer_Ingreso`='1',`Fecha_Vencimiento`='2023-05-19',`Creado_Por`='GG',`Fecha_Creacion`='2023-04-19',`Modificado_Por`='GG',`Fecha_Modificacion`='2023-04-19',`Estado_Usuario`='INACTIVO',`Intentos`='0',`Token`='';
INSERT INTO `tbl_ms_usuario` SET `ID_Usuario`='92666',`ID_Rol`='3',`Nombre_Usuario`='zazzz',`Usuario`='AADAD',`Contraseña`='11bbAA??',`Correo_electronico`='gg@gg.com',`Fecha_Ultima_conexion`='2023-04-19',`Preguntas_Contestadas`='3',`Primer_Ingreso`='1',`Fecha_Vencimiento`='2023-05-19',`Creado_Por`='AADAD',`Fecha_Creacion`='2023-04-19',`Modificado_Por`='AADAD',`Fecha_Modificacion`='2023-04-19',`Estado_Usuario`='INACTIVO',`Intentos`='0',`Token`='';

DROP TABLE IF EXISTS `tbl_objetos`;
CREATE TABLE `tbl_objetos` (
  `ID_Objeto` int(11) NOT NULL AUTO_INCREMENT,
  `Objeto` text NOT NULL,
  `Descripcion` text NOT NULL,
  `Tipo_Objeto` tinytext NOT NULL,
  `Creado_Por` tinytext NOT NULL,
  `Fecha_Creacion` date NOT NULL,
  `Modificado_Por` tinytext NOT NULL,
  `Fecha_Modificacion` date NOT NULL,
  PRIMARY KEY (`ID_Objeto`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `tbl_objetos` SET `ID_Objeto`='0',`Objeto`='Home',`Descripcion`='Pantalla principal',`Tipo_Objeto`='Vista',`Creado_Por`='Admin',`Fecha_Creacion`='2023-04-02',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_objetos` SET `ID_Objeto`='1',`Objeto`='Usuarios',`Descripcion`='Mantenimiento de los usuarios',`Tipo_Objeto`='Mantenimiento',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-02-23',`Modificado_Por`='ADMIN',`Fecha_Modificacion`='2023-03-02';
INSERT INTO `tbl_objetos` SET `ID_Objeto`='2',`Objeto`='Bitacora',`Descripcion`='Bitacora del sistema',`Tipo_Objeto`='Vista',`Creado_Por`='admin',`Fecha_Creacion`='2023-04-02',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_objetos` SET `ID_Objeto`='3',`Objeto`='Parametros',`Descripcion`='Parametros del sistema',`Tipo_Objeto`='Seguridad',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-02-23',`Modificado_Por`='ADMIN',`Fecha_Modificacion`='2023-02-23';
INSERT INTO `tbl_objetos` SET `ID_Objeto`='4',`Objeto`='Preguntas',`Descripcion`='Preguntas del sistema',`Tipo_Objeto`='Seguridad',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-02-23',`Modificado_Por`='ADMIN',`Fecha_Modificacion`='2023-02-23';
INSERT INTO `tbl_objetos` SET `ID_Objeto`='5',`Objeto`='Roles',`Descripcion`='Administracion de roles',`Tipo_Objeto`='Seguridad',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-02-23',`Modificado_Por`='ADMIN',`Fecha_Modificacion`='2023-02-23';
INSERT INTO `tbl_objetos` SET `ID_Objeto`='6',`Objeto`='Proyectos',`Descripcion`='Administracion de Proyectos',`Tipo_Objeto`='Pantalla',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-02-23',`Modificado_Por`='ADMIN',`Fecha_Modificacion`='2023-02-23';
INSERT INTO `tbl_objetos` SET `ID_Objeto`='7',`Objeto`='Fondos',`Descripcion`='Administracion de fondos',`Tipo_Objeto`='Pantalla',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-02-23',`Modificado_Por`='ADMIN',`Fecha_Modificacion`='2023-02-23';
INSERT INTO `tbl_objetos` SET `ID_Objeto`='8',`Objeto`='Donaciones',`Descripcion`='Administracion de Donaciones',`Tipo_Objeto`='Pantalla',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-02-23',`Modificado_Por`='ADMIN',`Fecha_Modificacion`='2023-02-23';
INSERT INTO `tbl_objetos` SET `ID_Objeto`='9',`Objeto`='Voluntarios',`Descripcion`='Administracion de Voluntarios',`Tipo_Objeto`='Pantalla',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-02-23',`Modificado_Por`='ADMIN',`Fecha_Modificacion`='2023-02-23';
INSERT INTO `tbl_objetos` SET `ID_Objeto`='10',`Objeto`='Pagos',`Descripcion`='Administracion de pagos',`Tipo_Objeto`='Pantalla',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-02-23',`Modificado_Por`='ADMIN',`Fecha_Modificacion`='2023-02-23';
INSERT INTO `tbl_objetos` SET `ID_Objeto`='11',`Objeto`='SAR',`Descripcion`='Administracion de sar',`Tipo_Objeto`='Pantalla',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-02-23',`Modificado_Por`='ADMIN',`Fecha_Modificacion`='2023-02-23';
INSERT INTO `tbl_objetos` SET `ID_Objeto`='12',`Objeto`='Backup',`Descripcion`='Descargar o restaurar copia de seguridad',`Tipo_Objeto`='Seguridad',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-04-12',`Modificado_Por`='ADMIN',`Fecha_Modificacion`='2023-04-12';
INSERT INTO `tbl_objetos` SET `ID_Objeto`='13',`Objeto`='Tipo de Fondo',`Descripcion`='Administrar los tipos de fondos',`Tipo_Objeto`='Pantalla',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-04-16',`Modificado_Por`='ADMIN',`Fecha_Modificacion`='2023-04-16';
INSERT INTO `tbl_objetos` SET `ID_Objeto`='14',`Objeto`='Area de Trabajo',`Descripcion`='Administrar las areas de trabajo',`Tipo_Objeto`='Pantalla',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-04-16',`Modificado_Por`='ADMIN',`Fecha_Modificacion`='2023-04-16';
INSERT INTO `tbl_objetos` SET `ID_Objeto`='15',`Objeto`='Vinculacion Proyectos x Voluntarios',`Descripcion`='vincula los voluntarios a los proyectos',`Tipo_Objeto`='Vinculador',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-04-16',`Modificado_Por`='ADMIN',`Fecha_Modificacion`='2023-04-16';

DROP TABLE IF EXISTS `tbl_pagos_realizados`;
CREATE TABLE `tbl_pagos_realizados` (
  `ID_de_pago` int(11) NOT NULL AUTO_INCREMENT,
  `Monto_pagado` int(11) NOT NULL,
  `ID_T_pago` int(11) NOT NULL,
  `Fecha_de_transaccion` date NOT NULL,
  `ID_de_proyecto` int(11) NOT NULL,
  `ID_Usuario` int(11) NOT NULL,
  `Creado_Por` tinytext NOT NULL,
  `Fecha_Creacion` date NOT NULL,
  `Modificado_por` tinytext NOT NULL,
  `Fecha_Modificacion` date NOT NULL,
  PRIMARY KEY (`ID_de_pago`),
  KEY `ID_T_pago` (`ID_T_pago`),
  KEY `ID_de_proyecto` (`ID_de_proyecto`),
  KEY `ID_Usuario` (`ID_Usuario`),
  CONSTRAINT `tbl_pagos_realizados_ibfk_1` FOREIGN KEY (`ID_T_pago`) REFERENCES `tbl_tipo_pago_r` (`ID_T_pago`),
  CONSTRAINT `tbl_pagos_realizados_ibfk_2` FOREIGN KEY (`ID_de_proyecto`) REFERENCES `tbl_proyectos` (`ID_proyecto`),
  CONSTRAINT `tbl_pagos_realizados_ibfk_3` FOREIGN KEY (`ID_Usuario`) REFERENCES `tbl_ms_usuario` (`ID_Usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `tbl_pagos_realizados` SET `ID_de_pago`='1',`Monto_pagado`='5000',`ID_T_pago`='1',`Fecha_de_transaccion`='2023-04-18',`ID_de_proyecto`='1',`ID_Usuario`='1',`Creado_Por`='27824',`Fecha_Creacion`='2023-03-31',`Modificado_por`='ADMIN',`Fecha_Modificacion`='2023-04-18';
INSERT INTO `tbl_pagos_realizados` SET `ID_de_pago`='2',`Monto_pagado`='7000',`ID_T_pago`='1',`Fecha_de_transaccion`='2023-04-18',`ID_de_proyecto`='1',`ID_Usuario`='1',`Creado_Por`='27824',`Fecha_Creacion`='2023-03-31',`Modificado_por`='ADMIN',`Fecha_Modificacion`='2023-04-18';
INSERT INTO `tbl_pagos_realizados` SET `ID_de_pago`='3',`Monto_pagado`='8000',`ID_T_pago`='1',`Fecha_de_transaccion`='2023-04-19',`ID_de_proyecto`='1',`ID_Usuario`='1',`Creado_Por`='27824',`Fecha_Creacion`='2023-03-31',`Modificado_por`='ADMIN',`Fecha_Modificacion`='2023-04-18';

DROP TABLE IF EXISTS `tbl_permisos`;
CREATE TABLE `tbl_permisos` (
  `ID_permiso` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Rol` int(11) NOT NULL,
  `ID_Objeto` int(11) NOT NULL,
  `Permiso_Insercion` tinytext NOT NULL,
  `Permiso_Eliminacion` tinytext NOT NULL,
  `Permiso_Actualizacion` tinytext NOT NULL,
  `Permiso_consultar` tinytext NOT NULL,
  `Estad` tinytext NOT NULL,
  `Creado_Por` tinytext NOT NULL,
  `Fecha_Creacion` date NOT NULL,
  `Modificado_Por` tinytext DEFAULT NULL,
  `Fecha_Modificacion` date DEFAULT NULL,
  PRIMARY KEY (`ID_permiso`),
  KEY `ID_Objeto` (`ID_Objeto`),
  KEY `ID_ROL` (`ID_Rol`) USING BTREE,
  CONSTRAINT `tbl_permisos_ibfk_1` FOREIGN KEY (`ID_Rol`) REFERENCES `tbl_ms_roles` (`ID_Rol`),
  CONSTRAINT `tbl_permisos_ibfk_2` FOREIGN KEY (`ID_Objeto`) REFERENCES `tbl_objetos` (`ID_Objeto`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `tbl_permisos` SET `ID_permiso`='1',`ID_Rol`='1',`ID_Objeto`='0',`Permiso_Insercion`='1',`Permiso_Eliminacion`='1',`Permiso_Actualizacion`='1',`Permiso_consultar`='1',`Estad`='1',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-02-23',`Modificado_Por`='ADMIN',`Fecha_Modificacion`='2023-02-23';
INSERT INTO `tbl_permisos` SET `ID_permiso`='3',`ID_Rol`='1',`ID_Objeto`='2',`Permiso_Insercion`='1',`Permiso_Eliminacion`='1',`Permiso_Actualizacion`='1',`Permiso_consultar`='1',`Estad`='1',`Creado_Por`='ADMIN',`Fecha_Creacion`='0000-00-00',`Modificado_Por`='',`Fecha_Modificacion`='2023-02-23';
INSERT INTO `tbl_permisos` SET `ID_permiso`='4',`ID_Rol`='1',`ID_Objeto`='3',`Permiso_Insercion`='1',`Permiso_Eliminacion`='1',`Permiso_Actualizacion`='1',`Permiso_consultar`='1',`Estad`='1',`Creado_Por`='ADMIN',`Fecha_Creacion`='0000-00-00',`Modificado_Por`='',`Fecha_Modificacion`='2023-02-23';
INSERT INTO `tbl_permisos` SET `ID_permiso`='5',`ID_Rol`='1',`ID_Objeto`='4',`Permiso_Insercion`='1',`Permiso_Eliminacion`='1',`Permiso_Actualizacion`='1',`Permiso_consultar`='1',`Estad`='1',`Creado_Por`='ADMIN',`Fecha_Creacion`='0000-00-00',`Modificado_Por`='',`Fecha_Modificacion`='2023-02-23';
INSERT INTO `tbl_permisos` SET `ID_permiso`='6',`ID_Rol`='1',`ID_Objeto`='5',`Permiso_Insercion`='1',`Permiso_Eliminacion`='1',`Permiso_Actualizacion`='1',`Permiso_consultar`='1',`Estad`='1',`Creado_Por`='ADMIN',`Fecha_Creacion`='0000-00-00',`Modificado_Por`='',`Fecha_Modificacion`='2023-02-23';
INSERT INTO `tbl_permisos` SET `ID_permiso`='7',`ID_Rol`='1',`ID_Objeto`='6',`Permiso_Insercion`='1',`Permiso_Eliminacion`='1',`Permiso_Actualizacion`='1',`Permiso_consultar`='1',`Estad`='1',`Creado_Por`='ADMIN',`Fecha_Creacion`='0000-00-00',`Modificado_Por`='',`Fecha_Modificacion`='2023-02-23';
INSERT INTO `tbl_permisos` SET `ID_permiso`='8',`ID_Rol`='1',`ID_Objeto`='8',`Permiso_Insercion`='1',`Permiso_Eliminacion`='1',`Permiso_Actualizacion`='1',`Permiso_consultar`='1',`Estad`='1',`Creado_Por`='ADMIN',`Fecha_Creacion`='0000-00-00',`Modificado_Por`='',`Fecha_Modificacion`='2023-02-23';
INSERT INTO `tbl_permisos` SET `ID_permiso`='9',`ID_Rol`='1',`ID_Objeto`='9',`Permiso_Insercion`='1',`Permiso_Eliminacion`='1',`Permiso_Actualizacion`='1',`Permiso_consultar`='1',`Estad`='1',`Creado_Por`='ADMIN',`Fecha_Creacion`='0000-00-00',`Modificado_Por`='',`Fecha_Modificacion`='2023-02-23';
INSERT INTO `tbl_permisos` SET `ID_permiso`='10',`ID_Rol`='1',`ID_Objeto`='10',`Permiso_Insercion`='1',`Permiso_Eliminacion`='1',`Permiso_Actualizacion`='1',`Permiso_consultar`='1',`Estad`='1',`Creado_Por`='ADMIN',`Fecha_Creacion`='0000-00-00',`Modificado_Por`='',`Fecha_Modificacion`='2023-02-23';
INSERT INTO `tbl_permisos` SET `ID_permiso`='11',`ID_Rol`='1',`ID_Objeto`='11',`Permiso_Insercion`='1',`Permiso_Eliminacion`='1',`Permiso_Actualizacion`='1',`Permiso_consultar`='1',`Estad`='1',`Creado_Por`='ADMIN',`Fecha_Creacion`='0000-00-00',`Modificado_Por`='',`Fecha_Modificacion`='2023-02-23';
INSERT INTO `tbl_permisos` SET `ID_permiso`='12',`ID_Rol`='2',`ID_Objeto`='0',`Permiso_Insercion`='1',`Permiso_Eliminacion`='1',`Permiso_Actualizacion`='1',`Permiso_consultar`='1',`Estad`='',`Creado_Por`='ADMIN',`Fecha_Creacion`='0000-00-00',`Modificado_Por`='',`Fecha_Modificacion`='2023-02-23';
INSERT INTO `tbl_permisos` SET `ID_permiso`='16',`ID_Rol`='1',`ID_Objeto`='2',`Permiso_Insercion`='1',`Permiso_Eliminacion`='1',`Permiso_Actualizacion`='1',`Permiso_consultar`='1',`Estad`='1',`Creado_Por`='ADMIN',`Fecha_Creacion`='0000-00-00',`Modificado_Por`='',`Fecha_Modificacion`='2023-02-23';
INSERT INTO `tbl_permisos` SET `ID_permiso`='18',`ID_Rol`='3',`ID_Objeto`='1',`Permiso_Insercion`='1',`Permiso_Eliminacion`='1',`Permiso_Actualizacion`='1',`Permiso_consultar`='0',`Estad`='',`Creado_Por`='ADMIN',`Fecha_Creacion`='0000-00-00',`Modificado_Por`='',`Fecha_Modificacion`='2023-02-23';
INSERT INTO `tbl_permisos` SET `ID_permiso`='19',`ID_Rol`='1',`ID_Objeto`='12',`Permiso_Insercion`='1',`Permiso_Eliminacion`='1',`Permiso_Actualizacion`='1',`Permiso_consultar`='1',`Estad`='1',`Creado_Por`='',`Fecha_Creacion`='0000-00-00',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_permisos` SET `ID_permiso`='20',`ID_Rol`='1',`ID_Objeto`='1',`Permiso_Insercion`='1',`Permiso_Eliminacion`='1',`Permiso_Actualizacion`='1',`Permiso_consultar`='1',`Estad`='1',`Creado_Por`='',`Fecha_Creacion`='0000-00-00',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_permisos` SET `ID_permiso`='21',`ID_Rol`='1',`ID_Objeto`='7',`Permiso_Insercion`='1',`Permiso_Eliminacion`='1',`Permiso_Actualizacion`='1',`Permiso_consultar`='1',`Estad`='1',`Creado_Por`='',`Fecha_Creacion`='0000-00-00',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_permisos` SET `ID_permiso`='23',`ID_Rol`='3',`ID_Objeto`='12',`Permiso_Insercion`='1',`Permiso_Eliminacion`='1',`Permiso_Actualizacion`='1',`Permiso_consultar`='1',`Estad`='',`Creado_Por`='',`Fecha_Creacion`='0000-00-00',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_permisos` SET `ID_permiso`='24',`ID_Rol`='3',`ID_Objeto`='6',`Permiso_Insercion`='0',`Permiso_Eliminacion`='1',`Permiso_Actualizacion`='1',`Permiso_consultar`='0',`Estad`='',`Creado_Por`='',`Fecha_Creacion`='0000-00-00',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_permisos` SET `ID_permiso`='25',`ID_Rol`='3',`ID_Objeto`='5',`Permiso_Insercion`='1',`Permiso_Eliminacion`='1',`Permiso_Actualizacion`='1',`Permiso_consultar`=' 1',`Estad`='',`Creado_Por`='',`Fecha_Creacion`='0000-00-00',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_permisos` SET `ID_permiso`='26',`ID_Rol`='76263',`ID_Objeto`='0',`Permiso_Insercion`='1',`Permiso_Eliminacion`='1',`Permiso_Actualizacion`='1',`Permiso_consultar`='1',`Estad`='0',`Creado_Por`='',`Fecha_Creacion`='0000-00-00',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_permisos` SET `ID_permiso`='27',`ID_Rol`='3',`ID_Objeto`='8',`Permiso_Insercion`='1',`Permiso_Eliminacion`='1',`Permiso_Actualizacion`='1',`Permiso_consultar`=' 1',`Estad`='',`Creado_Por`='',`Fecha_Creacion`='0000-00-00',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_permisos` SET `ID_permiso`='30',`ID_Rol`='76263',`ID_Objeto`='12',`Permiso_Insercion`='1',`Permiso_Eliminacion`='1',`Permiso_Actualizacion`='1',`Permiso_consultar`='1',`Estad`='1',`Creado_Por`='',`Fecha_Creacion`='0000-00-00',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_permisos` SET `ID_permiso`='33',`ID_Rol`='2',`ID_Objeto`='1',`Permiso_Insercion`='1',`Permiso_Eliminacion`='',`Permiso_Actualizacion`='',`Permiso_consultar`=' ',`Estad`='',`Creado_Por`='',`Fecha_Creacion`='0000-00-00',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_permisos` SET `ID_permiso`='34',`ID_Rol`='2',`ID_Objeto`='12',`Permiso_Insercion`='1',`Permiso_Eliminacion`='',`Permiso_Actualizacion`='',`Permiso_consultar`=' ',`Estad`='',`Creado_Por`='',`Fecha_Creacion`='0000-00-00',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_permisos` SET `ID_permiso`='35',`ID_Rol`='2',`ID_Objeto`='2',`Permiso_Insercion`='1',`Permiso_Eliminacion`='',`Permiso_Actualizacion`='',`Permiso_consultar`=' ',`Estad`='',`Creado_Por`='',`Fecha_Creacion`='0000-00-00',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_permisos` SET `ID_permiso`='36',`ID_Rol`='1',`ID_Objeto`='13',`Permiso_Insercion`='1',`Permiso_Eliminacion`='1',`Permiso_Actualizacion`='1',`Permiso_consultar`='1',`Estad`='1',`Creado_Por`='',`Fecha_Creacion`='0000-00-00',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_permisos` SET `ID_permiso`='37',`ID_Rol`='1',`ID_Objeto`='14',`Permiso_Insercion`='1',`Permiso_Eliminacion`='1',`Permiso_Actualizacion`='1',`Permiso_consultar`='1',`Estad`='1',`Creado_Por`='',`Fecha_Creacion`='0000-00-00',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_permisos` SET `ID_permiso`='38',`ID_Rol`='1',`ID_Objeto`='15',`Permiso_Insercion`='1',`Permiso_Eliminacion`='1',`Permiso_Actualizacion`='1',`Permiso_consultar`='1',`Estad`='1',`Creado_Por`='',`Fecha_Creacion`='0000-00-00',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';

DROP TABLE IF EXISTS `tbl_preguntas`;
CREATE TABLE `tbl_preguntas` (
  `ID_Pregunta` int(11) NOT NULL AUTO_INCREMENT,
  `Pregunta` text NOT NULL,
  `Creado_Por` tinytext NOT NULL,
  `Fecha_Creacion` date NOT NULL,
  `Modificado_Por` tinytext NOT NULL,
  `Fecha_Modificacion` date NOT NULL,
  PRIMARY KEY (`ID_Pregunta`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `tbl_preguntas` SET `ID_Pregunta`='1',`Pregunta`='¿Cual es tu color favorito?',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-02-23',`Modificado_Por`='ADMIN',`Fecha_Modificacion`='2023-04-07';
INSERT INTO `tbl_preguntas` SET `ID_Pregunta`='2',`Pregunta`='¿Cual es tu animal favorito?',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-02-23',`Modificado_Por`='ADMIN',`Fecha_Modificacion`='2023-02-23';
INSERT INTO `tbl_preguntas` SET `ID_Pregunta`='3',`Pregunta`='¿Donde Naciste?',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-02-23',`Modificado_Por`='ADMIN',`Fecha_Modificacion`='2023-02-23';
INSERT INTO `tbl_preguntas` SET `ID_Pregunta`='4',`Pregunta`='¿Como se llama tu mascota?',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-02-23',`Modificado_Por`='ADMIN',`Fecha_Modificacion`='2023-02-23';
INSERT INTO `tbl_preguntas` SET `ID_Pregunta`='5',`Pregunta`='¿Cual es tu comida favorita?',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-02-23',`Modificado_Por`='ADMIN',`Fecha_Modificacion`='2023-02-23';
INSERT INTO `tbl_preguntas` SET `ID_Pregunta`='6',`Pregunta`='¿Cual es tu genero de musica favorito?',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-02-23',`Modificado_Por`='ADMIN',`Fecha_Modificacion`='2023-02-23';

DROP TABLE IF EXISTS `tbl_proyectos`;
CREATE TABLE `tbl_proyectos` (
  `ID_proyecto` int(11) NOT NULL AUTO_INCREMENT,
  `ID_usuario` int(11) NOT NULL,
  `Nombre_del_proyecto` varchar(100) NOT NULL,
  `Fecha_de_inicio_P` date NOT NULL,
  `Fecha_final_P` date NOT NULL,
  `Fondos_proyecto` int(11) NOT NULL,
  `Estado_Proyecto` varchar(100) NOT NULL,
  `Creado_Por` tinytext NOT NULL,
  `Fecha_Creacion` date NOT NULL,
  `Modificado_por` tinytext NOT NULL,
  `Fecha_Modificacion` date NOT NULL,
  PRIMARY KEY (`ID_proyecto`),
  UNIQUE KEY `Nombre_del_proyecto` (`Nombre_del_proyecto`),
  UNIQUE KEY `Nombre_del_proyecto_2` (`Nombre_del_proyecto`),
  KEY `ID_usuario` (`ID_usuario`),
  CONSTRAINT `tbl_proyectos_ibfk_1` FOREIGN KEY (`ID_usuario`) REFERENCES `tbl_ms_usuario` (`ID_Usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `tbl_proyectos` SET `ID_proyecto`='1',`ID_usuario`='1',`Nombre_del_proyecto`='constructora',`Fecha_de_inicio_P`='2023-04-01',`Fecha_final_P`='2023-06-22',`Fondos_proyecto`='6000',`Estado_Proyecto`='ACTIVO',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-03-30',`Modificado_por`='ADMIN',`Fecha_Modificacion`='2023-03-30';
INSERT INTO `tbl_proyectos` SET `ID_proyecto`='2',`ID_usuario`='1',`Nombre_del_proyecto`='Edificio de medicina',`Fecha_de_inicio_P`='2023-04-01',`Fecha_final_P`='2023-06-23',`Fondos_proyecto`='90000',`Estado_Proyecto`='ACTIVO',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-03-30',`Modificado_por`='ADMIN',`Fecha_Modificacion`='2023-03-30';
INSERT INTO `tbl_proyectos` SET `ID_proyecto`='3',`ID_usuario`='1',`Nombre_del_proyecto`='Parque',`Fecha_de_inicio_P`='2023-03-31',`Fecha_final_P`='2023-06-22',`Fondos_proyecto`='3000',`Estado_Proyecto`='ACTIVO',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-03-30',`Modificado_por`='ADMIN',`Fecha_Modificacion`='2023-03-31';

DROP TABLE IF EXISTS `tbl_r_sar`;
CREATE TABLE `tbl_r_sar` (
  `ID_SAR` int(11) NOT NULL AUTO_INCREMENT,
  `RTN` int(14) NOT NULL,
  `num_declaracion` int(10) NOT NULL,
  `nombre_razonSocial` varchar(150) NOT NULL,
  `departamento` varchar(30) NOT NULL,
  `municipio` varchar(30) NOT NULL,
  `barrio_colonia` varchar(60) NOT NULL,
  `calle_avenida` varchar(50) NOT NULL,
  `num_casa` int(4) NOT NULL,
  `bloque` int(4) NOT NULL,
  `telefono` int(11) NOT NULL,
  `celular` int(11) NOT NULL,
  `domicilio` varchar(100) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `profesion_oficio` varchar(50) NOT NULL,
  `cai` varchar(32) NOT NULL,
  `fecha_limite_emision` datetime NOT NULL,
  `num_inicial` int(11) NOT NULL,
  `num_final` int(11) NOT NULL,
  `estado` int(1) NOT NULL,
  PRIMARY KEY (`ID_SAR`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `tbl_r_sar` SET `ID_SAR`='0',`RTN`='504',`num_declaracion`='101',`nombre_razonSocial`='Jaimito',`departamento`='Francisco Morazan',`municipio`='municipio peligroso',`barrio_colonia`='barrio peligroso',`calle_avenida`='homel',`num_casa`='240',`bloque`='4',`telefono`='22325172',`celular`='98706543',`domicilio`='Casa en barrio peligroso',`correo`='gg@gg.com',`profesion_oficio`='Medico Cirujano',`cai`='666',`fecha_limite_emision`='2023-04-06 00:00:00',`num_inicial`='1',`num_final`='50',`estado`='0';

DROP TABLE IF EXISTS `tbl_tipo_pago_r`;
CREATE TABLE `tbl_tipo_pago_r` (
  `ID_T_pago` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(30) NOT NULL,
  PRIMARY KEY (`ID_T_pago`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `tbl_tipo_pago_r` SET `ID_T_pago`='1',`Nombre`='Transporte';
INSERT INTO `tbl_tipo_pago_r` SET `ID_T_pago`='2',`Nombre`='Biatico';

DROP TABLE IF EXISTS `tbl_tipos_de_fondos`;
CREATE TABLE `tbl_tipos_de_fondos` (
  `ID_tipo_fondo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_T_Fondo` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`ID_tipo_fondo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `tbl_tipos_de_fondos` SET `ID_tipo_fondo`='1',`nombre_T_Fondo`='medicina';
INSERT INTO `tbl_tipos_de_fondos` SET `ID_tipo_fondo`='2',`nombre_T_Fondo`='Vestimenta';

DROP TABLE IF EXISTS `tbl_voluntarios`;
CREATE TABLE `tbl_voluntarios` (
  `ID_Voluntario` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_Voluntario` varchar(30) NOT NULL,
  `Telefono_Voluntario` varchar(15) NOT NULL,
  `Direccion_Voluntario` varchar(100) NOT NULL,
  `Creado_Por` tinytext NOT NULL,
  `Fecha_Creacion` date NOT NULL,
  `Modificado_por` tinytext NOT NULL,
  `Fecha_Modificacion` date NOT NULL,
  PRIMARY KEY (`ID_Voluntario`),
  UNIQUE KEY `Nombre_Voluntario` (`Nombre_Voluntario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `tbl_voluntarios` SET `ID_Voluntario`='1',`Nombre_Voluntario`='MARIO',`Telefono_Voluntario`='98706643',`Direccion_Voluntario`='COL 5 MAYO',`Creado_Por`='Elida',`Fecha_Creacion`='2023-03-30',`Modificado_por`='elida',`Fecha_Modificacion`='2023-03-31';
INSERT INTO `tbl_voluntarios` SET `ID_Voluntario`='2',`Nombre_Voluntario`='German',`Telefono_Voluntario`='88885555',`Direccion_Voluntario`='Tegucigalpa',`Creado_Por`='elida',`Fecha_Creacion`='2023-03-31',`Modificado_por`='elida',`Fecha_Modificacion`='2023-03-31';
INSERT INTO `tbl_voluntarios` SET `ID_Voluntario`='3',`Nombre_Voluntario`='FSEDf',`Telefono_Voluntario`='3443',`Direccion_Voluntario`='2424',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-04-18',`Modificado_por`='ADMIN',`Fecha_Modificacion`='2023-04-18';

DROP TABLE IF EXISTS `tbl_voluntarios_proyectos`;
CREATE TABLE `tbl_voluntarios_proyectos` (
  `ID_Vinculacion_Proy` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Voluntario` int(11) NOT NULL,
  `ID_proyecto` int(11) NOT NULL,
  `ID_Area_Trabajo` int(11) NOT NULL,
  `Fecha_Vinculacion_P` date NOT NULL,
  `Creado_Por` tinytext NOT NULL,
  `Fecha_Creacion` date NOT NULL,
  `Modificado_por` tinytext NOT NULL,
  `Fecha_Modificacion` date NOT NULL,
  PRIMARY KEY (`ID_Vinculacion_Proy`),
  KEY `ID_Voluntario` (`ID_Voluntario`),
  KEY `ID_proyecto` (`ID_proyecto`),
  KEY `ID_Area_Trabajo` (`ID_Area_Trabajo`),
  CONSTRAINT `tbl_voluntarios_proyectos_ibfk_1` FOREIGN KEY (`ID_Voluntario`) REFERENCES `tbl_voluntarios` (`ID_Voluntario`),
  CONSTRAINT `tbl_voluntarios_proyectos_ibfk_2` FOREIGN KEY (`ID_proyecto`) REFERENCES `tbl_proyectos` (`ID_proyecto`),
  CONSTRAINT `tbl_voluntarios_proyectos_ibfk_3` FOREIGN KEY (`ID_Area_Trabajo`) REFERENCES `tbl_area_trabajo` (`ID_Area_Trabajo`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `tbl_voluntarios_proyectos` SET `ID_Vinculacion_Proy`='4',`ID_Voluntario`='2',`ID_proyecto`='1',`ID_Area_Trabajo`='1',`Fecha_Vinculacion_P`='2023-05-06',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-04-17',`Modificado_por`='ADMIN',`Fecha_Modificacion`='2023-04-17';
INSERT INTO `tbl_voluntarios_proyectos` SET `ID_Vinculacion_Proy`='6',`ID_Voluntario`='1',`ID_proyecto`='1',`ID_Area_Trabajo`='2',`Fecha_Vinculacion_P`='2023-04-17',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-04-18',`Modificado_por`='ADMIN',`Fecha_Modificacion`='2023-04-18';
