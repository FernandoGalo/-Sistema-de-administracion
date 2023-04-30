
CREATE TABLE `tbl_area_trabajo` (
  `ID_Area_Trabajo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_Area_Trabajo` varchar(50) NOT NULL,
  `descripcion_A_Trabajo` varchar(100) NOT NULL,
  PRIMARY KEY (`ID_Area_Trabajo`),
  UNIQUE KEY `nombre_Area_Trabajo` (`nombre_Area_Trabajo`),
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



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
  PRIMARY KEY (`ID_Donante`),
  UNIQUE KEY `Nombre_D` (`Nombre_D`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `tbl_errores` (
  `ID_Error` int(20) NOT NULL AUTO_INCREMENT,
  `codigo` int(200) NOT NULL,
  `mensaje` varchar(100) NOT NULL,
  PRIMARY KEY (`ID_Error`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `tbl_errores` SET `ID_Error`='1',`codigo`='1451',`mensaje`='No se puede eliminar el registro debido a llave foránea por referencia';
INSERT INTO `tbl_errores` SET `ID_Error`='2',`codigo`='1062',`mensaje`='No se pudo crear el Registro debido a que no pueden haber registros duplicados';
INSERT INTO `tbl_errores` SET `ID_Error`='3',`codigo`='1049',`mensaje`='No se pudo establecer la conexion, parametros mal colocados.';


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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `tbl_ms_parametros` (
  `ID_Parametro` int(11) NOT NULL AUTO_INCREMENT,
  `Parametro` tinytext NOT NULL,
  `Descripcion_P` text NOT NULL,
  `Valor` text NOT NULL,
  `ID_Usuario` int(11) NOT NULL,
  `Fecha_Creacion` date NOT NULL,
  `Fecha_Modificacion` date NOT NULL,
  PRIMARY KEY (`ID_Parametro`),
  UNIQUE KEY `Parametro` (`Parametro`) USING HASH,
  UNIQUE KEY `Parametro_2` (`Parametro`) USING HASH,
  KEY `ID_Usuario` (`ID_Usuario`),
  CONSTRAINT `tbl_ms_parametros_ibfk_1` FOREIGN KEY (`ID_Usuario`) REFERENCES `tbl_ms_usuario` (`ID_Usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `tbl_ms_parametros` SET `ID_Parametro`='1',`Parametro`='ADMIN_INTENTOS',`Descripcion_P`='CANTIDAD DE INTENTOS PERMITIDOS EN LOGIN',`Valor`='3',`ID_Usuario`='1',`Fecha_Creacion`='2023-02-23',`Fecha_Modificacion`='2023-04-13';
INSERT INTO `tbl_ms_parametros` SET `ID_Parametro`='2',`Parametro`='ADMIN_PREGUNTAS',`Descripcion_P`='CANTIDAD DE PREGUNTAS A INGRESAR',`Valor`='3',`ID_Usuario`='1',`Fecha_Creacion`='2023-02-23',`Fecha_Modificacion`='2023-02-23';
INSERT INTO `tbl_ms_parametros` SET `ID_Parametro`='3',`Parametro`='CORREO_RECUPERACION',`Descripcion_P`='CORREO PARA RECUPERAR LAS CONTRASEÑAS ',`Valor`='mugitecno.123@outlook.com',`ID_Usuario`='1',`Fecha_Creacion`='2023-02-23',`Fecha_Modificacion`='2023-04-21';
INSERT INTO `tbl_ms_parametros` SET `ID_Parametro`='4',`Parametro`='ADMIN_CPUERTO',`Descripcion_P`='NUMERO DE PUERTO DEL CORREO',`Valor`='587',`ID_Usuario`='1',`Fecha_Creacion`='2023-02-23',`Fecha_Modificacion`='2023-02-23';
INSERT INTO `tbl_ms_parametros` SET `ID_Parametro`='5',`Parametro`='ADMIN_CUSER',`Descripcion_P`='NOMBRE USUARIO',`Valor`='USUARIO',`ID_Usuario`='1',`Fecha_Creacion`='2023-02-23',`Fecha_Modificacion`='2023-02-23';
INSERT INTO `tbl_ms_parametros` SET `ID_Parametro`='6',`Parametro`='ADMIN_CPASS',`Descripcion_P`='CONTRASEÑA DEL CORREO RECUPERAR PASS',`Valor`='mugitecno0123',`ID_Usuario`='1',`Fecha_Creacion`='2023-02-23',`Fecha_Modificacion`='2023-04-21';
INSERT INTO `tbl_ms_parametros` SET `ID_Parametro`='7',`Parametro`='ADMIN_VIGENCIA',`Descripcion_P`='VIGENCIA DE LA CONTRASEÑA EN DIAS',`Valor`='30',`ID_Usuario`='1',`Fecha_Creacion`='2023-02-20',`Fecha_Modificacion`='2023-02-20';
INSERT INTO `tbl_ms_parametros` SET `ID_Parametro`='8',`Parametro`='SYS_NOMBRE',`Descripcion_P`='NOMBRE DEL SISTEMA',`Valor`='ADMINISTRACION DE FONDOS Y PROYECTOS',`ID_Usuario`='1',`Fecha_Creacion`='2023-02-23',`Fecha_Modificacion`='2023-02-23';
INSERT INTO `tbl_ms_parametros` SET `ID_Parametro`='9',`Parametro`='MIN_CONTRASEÑA',`Descripcion_P`='LOGITUD MINIMA DE LA CONTRASEÑA',`Valor`='8',`ID_Usuario`='1',`Fecha_Creacion`='2023-04-01',`Fecha_Modificacion`='2023-04-12';
INSERT INTO `tbl_ms_parametros` SET `ID_Parametro`='10',`Parametro`='MAX_CONTRASEÑA',`Descripcion_P`='LOGITUD MAXIMA DE UNA CONTRASEÑA',`Valor`='10',`ID_Usuario`='1',`Fecha_Creacion`='2023-04-01',`Fecha_Modificacion`='2023-04-12';
INSERT INTO `tbl_ms_parametros` SET `ID_Parametro`='12',`Parametro`='NOMBRE_ASOCIACION',`Descripcion_P`='EL NOMBRE QUE POSEE LA ASOCIACION',`Valor`='ASOCIACION CREO EN TI',`ID_Usuario`='1',`Fecha_Creacion`='2023-04-21',`Fecha_Modificacion`='2023-04-21';
INSERT INTO `tbl_ms_parametros` SET `ID_Parametro`='13',`Parametro`='ADMIN_TELEFONO',`Descripcion_P`='NUMERO TELEFONICO DE LA ASOCIACION ',`Valor`='22220493',`ID_Usuario`='1',`Fecha_Creacion`='2023-04-21',`Fecha_Modificacion`='2023-04-24';
INSERT INTO `tbl_ms_parametros` SET `ID_Parametro`='14',`Parametro`='ADMIN_UBICACION',`Descripcion_P`='UBICACDION EXACTA DE LA ASOCIACION',`Valor`='BARRIO LA RONDA, AVENIDA MÁXIMO JEREZ, EDIFICIO LA RONDA TEGUCIGALPA, HONDURAS.',`ID_Usuario`='1',`Fecha_Creacion`='2023-04-21',`Fecha_Modificacion`='2023-04-22';
INSERT INTO `tbl_ms_parametros` SET `ID_Parametro`='15',`Parametro`='ADMIN_CORREOS',`Descripcion_P`='CORREO OFICIAL DE LA ASOCIACION  ..,,,.',`Valor`='asociacioncreoenti@gmail.com',`ID_Usuario`='1',`Fecha_Creacion`='2023-04-21',`Fecha_Modificacion`='2023-04-22';


CREATE TABLE `tbl_ms_preguntas_x_usuario` (
  `ID_PreguntaxUser` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Pregunta` int(11) NOT NULL,
  `ID_Usuario` int(11) NOT NULL,
  `Respuesta` text NOT NULL,
  `Creado_Por` tinytext NOT NULL,
  `Fecha_Creacion` date NOT NULL,
  `Modificado_Por` tinytext NOT NULL,
  `Fecha_Modificacion` date NOT NULL,
  PRIMARY KEY (`ID_PreguntaxUser`),
  KEY `ID_Usuario` (`ID_Usuario`),
  KEY `ID_Pregunta` (`ID_Pregunta`) USING BTREE,
  CONSTRAINT `tbl_ms_preguntas_x_usuario_ibfk_1` FOREIGN KEY (`ID_Pregunta`) REFERENCES `tbl_preguntas` (`ID_Pregunta`),
  CONSTRAINT `tbl_ms_preguntas_x_usuario_ibfk_2` FOREIGN KEY (`ID_Usuario`) REFERENCES `tbl_ms_usuario` (`ID_Usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `tbl_ms_roles` (
  `ID_Rol` int(11) NOT NULL AUTO_INCREMENT,
  `Rol` text NOT NULL,
  `Descripcion` text NOT NULL,
  `Estado` int(11) NOT NULL,
  `Creado_Por` text NOT NULL,
  `Fecha_Creacion` date NOT NULL,
  `Modificado_Por` text NOT NULL,
  `Fecha_Modificacion` date NOT NULL,
  PRIMARY KEY (`ID_Rol`),
  UNIQUE KEY `Rol` (`Rol`) USING HASH
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `tbl_ms_roles` SET `ID_Rol`='1',`Rol`='ADMINISTRADOR',`Descripcion`='PERSONA QUE ADMINISTRARA EL SISTEMA',`Estado`='1',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-02-20',`Modificado_Por`='ADMIN',`Fecha_Modificacion`='2023-04-21';
INSERT INTO `tbl_ms_roles` SET `ID_Rol`='2',`Rol`='EDITOR',`Descripcion`='PUEDE INSERTAR Y ACTUALIZAR DATOS',`Estado`='1',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-02-23',`Modificado_Por`='ADMIN',`Fecha_Modificacion`='2023-04-21';
INSERT INTO `tbl_ms_roles` SET `ID_Rol`='3',`Rol`='SUPERVISOR',`Descripcion`='PUEDE VER DATOS SOLAMENTE',`Estado`='1',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-02-23',`Modificado_Por`='ADMIN',`Fecha_Modificacion`='2023-04-21';


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
INSERT INTO `tbl_ms_usuario` SET `ID_Usuario`='1',`ID_Rol`='1',`Nombre_Usuario`='ADMIN',`Usuario`='ADMIN',`Contraseña`='Admin11',`Correo_electronico`='ADMIN@gmail.com',`Fecha_Ultima_conexion`='2023-04-28',`Preguntas_Contestadas`='3',`Primer_Ingreso`='1',`Fecha_Vencimiento`='2023-05-22',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-02-23',`Modificado_Por`='ADMIN',`Fecha_Modificacion`='2023-04-22',`Estado_Usuario`='ACTIVO',`Intentos`='0',`Token`='';


CREATE TABLE `tbl_objetos` (
  `ID_Objeto` int(11) NOT NULL AUTO_INCREMENT,
  `Objeto` text NOT NULL,
  `Descripcion` text NOT NULL,
  `Tipo_Objeto` tinytext NOT NULL,
  `Creado_Por` tinytext NOT NULL,
  `Fecha_Creacion` date NOT NULL,
  `Modificado_Por` tinytext NOT NULL,
  `Fecha_Modificacion` date NOT NULL,
  PRIMARY KEY (`ID_Objeto`),
  UNIQUE KEY `Objeto` (`Objeto`) USING HASH
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `tbl_objetos` SET `ID_Objeto`='1',`Objeto`='USUARIOS',`Descripcion`='MANTENIMIENTO DE LOS USUARIOS',`Tipo_Objeto`='MANTENIMIENTO',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-02-23',`Modificado_Por`='ADMIN',`Fecha_Modificacion`='2023-03-02';
INSERT INTO `tbl_objetos` SET `ID_Objeto`='2',`Objeto`='BITACORA',`Descripcion`='BITACORA DEL SISTEMA',`Tipo_Objeto`='VISTA',`Creado_Por`='admin',`Fecha_Creacion`='2023-04-02',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_objetos` SET `ID_Objeto`='3',`Objeto`='PARAMETROS',`Descripcion`='Parametros del sistema',`Tipo_Objeto`='Seguridad',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-02-23',`Modificado_Por`='ADMIN',`Fecha_Modificacion`='2023-02-23';
INSERT INTO `tbl_objetos` SET `ID_Objeto`='4',`Objeto`='PREGUNTAS',`Descripcion`='PREGUNTAS DEL SISTEMA',`Tipo_Objeto`='SEGURIDAD',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-02-23',`Modificado_Por`='ADMIN',`Fecha_Modificacion`='2023-02-23';
INSERT INTO `tbl_objetos` SET `ID_Objeto`='5',`Objeto`='ROLES',`Descripcion`='ADMINISTRACION DE ROLES',`Tipo_Objeto`='SEGURIDAD',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-02-23',`Modificado_Por`='ADMIN',`Fecha_Modificacion`='2023-02-23';
INSERT INTO `tbl_objetos` SET `ID_Objeto`='6',`Objeto`='PROYECTOS',`Descripcion`='ADMINISTRACION DE PROYECTOS',`Tipo_Objeto`='PANTALLA',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-02-23',`Modificado_Por`='ADMIN',`Fecha_Modificacion`='2023-02-23';
INSERT INTO `tbl_objetos` SET `ID_Objeto`='7',`Objeto`='FONDOS',`Descripcion`='ADMINISTRACION DE FONDOS',`Tipo_Objeto`='PANTALLA',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-02-23',`Modificado_Por`='ADMIN',`Fecha_Modificacion`='2023-02-23';
INSERT INTO `tbl_objetos` SET `ID_Objeto`='8',`Objeto`='DONACIONES',`Descripcion`='ADMINISTRACION DE DONACIONES',`Tipo_Objeto`='PANTALLA',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-02-23',`Modificado_Por`='ADMIN',`Fecha_Modificacion`='2023-02-23';
INSERT INTO `tbl_objetos` SET `ID_Objeto`='9',`Objeto`='VOLUNTARIOS',`Descripcion`='ADMINISTRACION DE VOLUNTARIOS',`Tipo_Objeto`='PANTALLA',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-02-23',`Modificado_Por`='ADMIN',`Fecha_Modificacion`='2023-02-23';
INSERT INTO `tbl_objetos` SET `ID_Objeto`='10',`Objeto`='PAGOS',`Descripcion`='ADMINISTRACION DE PAGOS',`Tipo_Objeto`='PANTALLA',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-02-23',`Modificado_Por`='ADMIN',`Fecha_Modificacion`='2023-02-23';
INSERT INTO `tbl_objetos` SET `ID_Objeto`='11',`Objeto`='SAR',`Descripcion`='Administracion de sar',`Tipo_Objeto`='Pantalla',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-02-23',`Modificado_Por`='ADMIN',`Fecha_Modificacion`='2023-02-23';
INSERT INTO `tbl_objetos` SET `ID_Objeto`='12',`Objeto`='Backup',`Descripcion`='Descargar o restaurar copia de seguridad',`Tipo_Objeto`='Seguridad',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-04-12',`Modificado_Por`='ADMIN',`Fecha_Modificacion`='2023-04-12';
INSERT INTO `tbl_objetos` SET `ID_Objeto`='13',`Objeto`='Tipo de Fondo',`Descripcion`='Administrar los tipos de fondos',`Tipo_Objeto`='Pantalla',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-04-16',`Modificado_Por`='ADMIN',`Fecha_Modificacion`='2023-04-16';
INSERT INTO `tbl_objetos` SET `ID_Objeto`='14',`Objeto`='Area de Trabajo',`Descripcion`='Administrar las areas de trabajo',`Tipo_Objeto`='Pantalla',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-04-16',`Modificado_Por`='ADMIN',`Fecha_Modificacion`='2023-04-16';
INSERT INTO `tbl_objetos` SET `ID_Objeto`='15',`Objeto`='Vinculacion Proyectos x Voluntarios',`Descripcion`='vincula los voluntarios a los proyectos',`Tipo_Objeto`='Vinculador',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-04-16',`Modificado_Por`='ADMIN',`Fecha_Modificacion`='2023-04-16';
INSERT INTO `tbl_objetos` SET `ID_Objeto`='16',`Objeto`='Home',`Descripcion`='Pantalla principal',`Tipo_Objeto`='Vista',`Creado_Por`='Admin',`Fecha_Creacion`='2023-04-02',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_objetos` SET `ID_Objeto`='17',`Objeto`='Tipo de Pago',`Descripcion`='Tabla Tipo de pago',`Tipo_Objeto`='Tabla',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-04-21',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_objetos` SET `ID_Objeto`='18',`Objeto`='OBJETO',`Descripcion`='TBL_OBJETO',`Tipo_Objeto`='PANTALLA',`Creado_Por`='',`Fecha_Creacion`='0000-00-00',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';


CREATE TABLE `tbl_pagos_realizados` (
  `ID_de_pago` int(11) NOT NULL AUTO_INCREMENT,
  `Monto_pagado` float NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


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
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
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
INSERT INTO `tbl_permisos` SET `ID_permiso`='18',`ID_Rol`='3',`ID_Objeto`='1',`Permiso_Insercion`='0',`Permiso_Eliminacion`='0',`Permiso_Actualizacion`='0',`Permiso_consultar`='1',`Estad`='1',`Creado_Por`='ADMIN',`Fecha_Creacion`='0000-00-00',`Modificado_Por`='',`Fecha_Modificacion`='2023-02-23';
INSERT INTO `tbl_permisos` SET `ID_permiso`='19',`ID_Rol`='1',`ID_Objeto`='12',`Permiso_Insercion`='1',`Permiso_Eliminacion`='1',`Permiso_Actualizacion`='1',`Permiso_consultar`='1',`Estad`='1',`Creado_Por`='',`Fecha_Creacion`='0000-00-00',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_permisos` SET `ID_permiso`='20',`ID_Rol`='1',`ID_Objeto`='1',`Permiso_Insercion`='1',`Permiso_Eliminacion`='1',`Permiso_Actualizacion`='1',`Permiso_consultar`='1',`Estad`='1',`Creado_Por`='',`Fecha_Creacion`='0000-00-00',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_permisos` SET `ID_permiso`='21',`ID_Rol`='1',`ID_Objeto`='7',`Permiso_Insercion`='1',`Permiso_Eliminacion`='1',`Permiso_Actualizacion`='1',`Permiso_consultar`='1',`Estad`='1',`Creado_Por`='',`Fecha_Creacion`='0000-00-00',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_permisos` SET `ID_permiso`='24',`ID_Rol`='3',`ID_Objeto`='6',`Permiso_Insercion`='0',`Permiso_Eliminacion`='0',`Permiso_Actualizacion`='0',`Permiso_consultar`='1',`Estad`='1',`Creado_Por`='',`Fecha_Creacion`='0000-00-00',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_permisos` SET `ID_permiso`='27',`ID_Rol`='3',`ID_Objeto`='8',`Permiso_Insercion`='0',`Permiso_Eliminacion`='0',`Permiso_Actualizacion`='0',`Permiso_consultar`='1',`Estad`='1',`Creado_Por`='',`Fecha_Creacion`='0000-00-00',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_permisos` SET `ID_permiso`='36',`ID_Rol`='1',`ID_Objeto`='13',`Permiso_Insercion`='1',`Permiso_Eliminacion`='1',`Permiso_Actualizacion`='1',`Permiso_consultar`='1',`Estad`='1',`Creado_Por`='',`Fecha_Creacion`='0000-00-00',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_permisos` SET `ID_permiso`='37',`ID_Rol`='1',`ID_Objeto`='14',`Permiso_Insercion`='1',`Permiso_Eliminacion`='1',`Permiso_Actualizacion`='1',`Permiso_consultar`='1',`Estad`='1',`Creado_Por`='',`Fecha_Creacion`='0000-00-00',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_permisos` SET `ID_permiso`='38',`ID_Rol`='1',`ID_Objeto`='15',`Permiso_Insercion`='1',`Permiso_Eliminacion`='1',`Permiso_Actualizacion`='1',`Permiso_consultar`='1',`Estad`='1',`Creado_Por`='',`Fecha_Creacion`='0000-00-00',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_permisos` SET `ID_permiso`='39',`ID_Rol`='2',`ID_Objeto`='15',`Permiso_Insercion`='1',`Permiso_Eliminacion`='0',`Permiso_Actualizacion`='1',`Permiso_consultar`=' 1',`Estad`=' 1',`Creado_Por`='',`Fecha_Creacion`='0000-00-00',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_permisos` SET `ID_permiso`='40',`ID_Rol`='2',`ID_Objeto`='6',`Permiso_Insercion`='1',`Permiso_Eliminacion`='0',`Permiso_Actualizacion`='1',`Permiso_consultar`=' 1',`Estad`=' 1',`Creado_Por`='',`Fecha_Creacion`='0000-00-00',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_permisos` SET `ID_permiso`='41',`ID_Rol`='2',`ID_Objeto`='7',`Permiso_Insercion`='1',`Permiso_Eliminacion`='0',`Permiso_Actualizacion`='1',`Permiso_consultar`=' 1',`Estad`=' 1',`Creado_Por`='',`Fecha_Creacion`='0000-00-00',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_permisos` SET `ID_permiso`='42',`ID_Rol`='2',`ID_Objeto`='8',`Permiso_Insercion`='1',`Permiso_Eliminacion`='0',`Permiso_Actualizacion`='1',`Permiso_consultar`=' 1',`Estad`=' 1',`Creado_Por`='',`Fecha_Creacion`='0000-00-00',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_permisos` SET `ID_permiso`='43',`ID_Rol`='2',`ID_Objeto`='9',`Permiso_Insercion`='1',`Permiso_Eliminacion`='0',`Permiso_Actualizacion`='1',`Permiso_consultar`=' 1',`Estad`=' 1',`Creado_Por`='',`Fecha_Creacion`='0000-00-00',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_permisos` SET `ID_permiso`='44',`ID_Rol`='2',`ID_Objeto`='14',`Permiso_Insercion`='1',`Permiso_Eliminacion`='0',`Permiso_Actualizacion`='1',`Permiso_consultar`=' 1',`Estad`=' 1',`Creado_Por`='',`Fecha_Creacion`='0000-00-00',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_permisos` SET `ID_permiso`='45',`ID_Rol`='2',`ID_Objeto`='13',`Permiso_Insercion`='1',`Permiso_Eliminacion`='0',`Permiso_Actualizacion`='1',`Permiso_consultar`=' 1',`Estad`=' 1',`Creado_Por`='',`Fecha_Creacion`='0000-00-00',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_permisos` SET `ID_permiso`='46',`ID_Rol`='2',`ID_Objeto`='10',`Permiso_Insercion`='1',`Permiso_Eliminacion`='0',`Permiso_Actualizacion`='1',`Permiso_consultar`=' 1',`Estad`=' 1',`Creado_Por`='',`Fecha_Creacion`='0000-00-00',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_permisos` SET `ID_permiso`='47',`ID_Rol`='3',`ID_Objeto`='7',`Permiso_Insercion`='0',`Permiso_Eliminacion`='0',`Permiso_Actualizacion`='0',`Permiso_consultar`='1',`Estad`='1',`Creado_Por`='',`Fecha_Creacion`='0000-00-00',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_permisos` SET `ID_permiso`='48',`ID_Rol`='3',`ID_Objeto`='9',`Permiso_Insercion`='0',`Permiso_Eliminacion`='0',`Permiso_Actualizacion`='0',`Permiso_consultar`=' 1',`Estad`=' 1',`Creado_Por`='',`Fecha_Creacion`='0000-00-00',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_permisos` SET `ID_permiso`='49',`ID_Rol`='3',`ID_Objeto`='14',`Permiso_Insercion`='0',`Permiso_Eliminacion`='0',`Permiso_Actualizacion`='0',`Permiso_consultar`=' 1',`Estad`=' 1',`Creado_Por`='',`Fecha_Creacion`='0000-00-00',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_permisos` SET `ID_permiso`='50',`ID_Rol`='3',`ID_Objeto`='13',`Permiso_Insercion`='0',`Permiso_Eliminacion`='0',`Permiso_Actualizacion`='0',`Permiso_consultar`=' 1',`Estad`=' 1',`Creado_Por`='',`Fecha_Creacion`='0000-00-00',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_permisos` SET `ID_permiso`='51',`ID_Rol`='3',`ID_Objeto`='15',`Permiso_Insercion`='0',`Permiso_Eliminacion`='0',`Permiso_Actualizacion`='0',`Permiso_consultar`=' 1',`Estad`=' 1',`Creado_Por`='',`Fecha_Creacion`='0000-00-00',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_permisos` SET `ID_permiso`='52',`ID_Rol`='3',`ID_Objeto`='10',`Permiso_Insercion`='0',`Permiso_Eliminacion`='0',`Permiso_Actualizacion`='0',`Permiso_consultar`=' 1',`Estad`=' 1',`Creado_Por`='',`Fecha_Creacion`='0000-00-00',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_permisos` SET `ID_permiso`='53',`ID_Rol`='1',`ID_Objeto`='16',`Permiso_Insercion`='1',`Permiso_Eliminacion`='1',`Permiso_Actualizacion`='1',`Permiso_consultar`=' 1',`Estad`=' 1',`Creado_Por`='',`Fecha_Creacion`='0000-00-00',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_permisos` SET `ID_permiso`='54',`ID_Rol`='1',`ID_Objeto`='17',`Permiso_Insercion`='1',`Permiso_Eliminacion`='1',`Permiso_Actualizacion`='1',`Permiso_consultar`=' 1',`Estad`=' 1',`Creado_Por`='',`Fecha_Creacion`='0000-00-00',`Modificado_Por`='',`Fecha_Modificacion`='0000-00-00';
INSERT INTO `tbl_permisos` SET `ID_permiso`='55',`ID_Rol`='1',`ID_Objeto`='18',`Permiso_Insercion`='1',`Permiso_Eliminacion`='1',`Permiso_Actualizacion`='1',`Permiso_consultar`=' 1',`Estad`=' 1',`Creado_Por`='',`Fecha_Creacion`='0000-00-00',`Modificado_Por`='',`Fecha_Modificacion`='';


CREATE TABLE `tbl_preguntas` (
  `ID_Pregunta` int(11) NOT NULL AUTO_INCREMENT,
  `Pregunta` text NOT NULL,
  `Creado_Por` tinytext NOT NULL,
  `Fecha_Creacion` date NOT NULL,
  `Modificado_Por` tinytext NOT NULL,
  `Fecha_Modificacion` date NOT NULL,
  PRIMARY KEY (`ID_Pregunta`),
  UNIQUE KEY `Pregunta` (`Pregunta`) USING HASH
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `tbl_preguntas` SET `ID_Pregunta`='1',`Pregunta`='¿Cual es tu color favorito?',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-02-23',`Modificado_Por`='ADMIN',`Fecha_Modificacion`='2023-04-07';
INSERT INTO `tbl_preguntas` SET `ID_Pregunta`='2',`Pregunta`='¿Cual es tu animal favorito?',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-02-23',`Modificado_Por`='ADMIN',`Fecha_Modificacion`='2023-02-23';
INSERT INTO `tbl_preguntas` SET `ID_Pregunta`='3',`Pregunta`='¿Donde Naciste?',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-02-23',`Modificado_Por`='ADMIN',`Fecha_Modificacion`='2023-02-23';
INSERT INTO `tbl_preguntas` SET `ID_Pregunta`='4',`Pregunta`='¿Como se llama tu mascota?',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-02-23',`Modificado_Por`='ADMIN',`Fecha_Modificacion`='2023-02-23';
INSERT INTO `tbl_preguntas` SET `ID_Pregunta`='5',`Pregunta`='¿Cual es tu comida favorita?',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-02-23',`Modificado_Por`='ADMIN',`Fecha_Modificacion`='2023-02-23';
INSERT INTO `tbl_preguntas` SET `ID_Pregunta`='6',`Pregunta`='¿Cual es tu genero de musica favorito?',`Creado_Por`='ADMIN',`Fecha_Creacion`='2023-02-23',`Modificado_Por`='ADMIN',`Fecha_Modificacion`='2023-02-23';


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
  KEY `ID_usuario` (`ID_usuario`),
  CONSTRAINT `tbl_proyectos_ibfk_1` FOREIGN KEY (`ID_usuario`) REFERENCES `tbl_ms_usuario` (`ID_Usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `tbl_r_sar` (
  `ID_SAR` int(11) NOT NULL AUTO_INCREMENT,
  `RTN` varchar(14) NOT NULL,
  `num_declaracion` int(10) NOT NULL,
  `tipo_declaracion` varchar(15) NOT NULL,
  `nombre_razonSocial` varchar(150) NOT NULL,
  `Monto` int(7) NOT NULL,
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
  `fecha_limite_emision` date NOT NULL,
  `num_inicial` int(11) NOT NULL,
  `num_final` int(11) NOT NULL,
  `estado` int(1) NOT NULL,
  PRIMARY KEY (`ID_SAR`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `tbl_tipo_pago_r` (
  `ID_T_pago` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_T_pago`),
  UNIQUE KEY `Nombre` (`Nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `tbl_tipos_de_fondos` (
  `ID_tipo_fondo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_T_Fondo` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`ID_tipo_fondo`),
  UNIQUE KEY `nombre_T_Fondo` (`nombre_T_Fondo`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
