/*
 Navicat Premium Data Transfer

 Source Server         : Local
 Source Server Type    : MySQL
 Source Server Version : 100134
 Source Host           : localhost:3306
 Source Schema         : Sensei

 Target Server Type    : MySQL
 Target Server Version : 100134
 File Encoding         : 65001

 Date: 20/09/2018 18:49:49
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for SS_Alumnos_Registrados
-- ----------------------------
DROP TABLE IF EXISTS `SS_Alumnos_Registrados`;
CREATE TABLE `SS_Alumnos_Registrados`  (
  `Registro_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Resgistro_AlumnoID` int(11) NULL DEFAULT NULL,
  `Resgistro_MateriaID` int(11) NULL DEFAULT NULL,
  `Resgistro_Calificacion_Final` double(3, 2) NULL DEFAULT NULL,
  PRIMARY KEY (`Registro_ID`) USING BTREE,
  INDEX `registro_materia`(`Resgistro_MateriaID`) USING BTREE,
  INDEX `resgistro_alumno`(`Resgistro_AlumnoID`) USING BTREE,
  CONSTRAINT `registro_materia` FOREIGN KEY (`Resgistro_MateriaID`) REFERENCES `SS_Materia` (`Materia_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `resgistro_alumno` FOREIGN KEY (`Resgistro_AlumnoID`) REFERENCES `SS_Usuarios` (`Usuario_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 122 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for SS_Archivos
-- ----------------------------
DROP TABLE IF EXISTS `SS_Archivos`;
CREATE TABLE `SS_Archivos`  (
  `Archi_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Archi_Ruta` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL,
  `Archi_Comentario_Alumno` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `Archi_Comentario_Maestro` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `Archi_Fecreacion` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `Archi_PerteneceID` int(11) NULL DEFAULT NULL,
  `Archi_Status` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `Archi_TareaID` int(11) NULL DEFAULT NULL,
  `Archi_Calificacion` double(10, 2) NULL DEFAULT 0.00,
  `Archi_Tipo` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`Archi_ID`) USING BTREE,
  INDEX `archivo_user`(`Archi_PerteneceID`) USING BTREE,
  INDEX `archivo_tarea`(`Archi_TareaID`) USING BTREE,
  CONSTRAINT `archivo_tarea` FOREIGN KEY (`Archi_TareaID`) REFERENCES `SS_Tareas` (`Tarea_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `archivo_user` FOREIGN KEY (`Archi_PerteneceID`) REFERENCES `SS_Alumnos_Registrados` (`Resgistro_AlumnoID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 771 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for SS_Blog
-- ----------------------------
DROP TABLE IF EXISTS `SS_Blog`;
CREATE TABLE `SS_Blog`  (
  `Blog_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Blog_Nombre` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Blog_Contenido` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `Blog_Pertenece_ID` int(11) NULL DEFAULT NULL,
  `Blog_Fecha_Creacion` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `Blog_ID_Materia` int(11) NULL DEFAULT NULL,
  `Blog_ImagenUrl` varchar(2000) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Blog_Descripcion` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Blog_UsuarioID` int(10) NULL DEFAULT NULL,
  PRIMARY KEY (`Blog_ID`) USING BTREE,
  INDEX `blogs_materias`(`Blog_ID_Materia`) USING BTREE,
  CONSTRAINT `blogs_materias` FOREIGN KEY (`Blog_ID_Materia`) REFERENCES `SS_Materia` (`Materia_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for SS_Calificacion_unidad
-- ----------------------------
DROP TABLE IF EXISTS `SS_Calificacion_unidad`;
CREATE TABLE `SS_Calificacion_unidad`  (
  `Calificacion_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Calificacion_Unidad_ID` int(11) NULL DEFAULT NULL,
  `Calificacion_Alumno_ID` int(11) NULL DEFAULT NULL,
  `Calificacion_Calificacion` double(11, 2) NULL DEFAULT NULL,
  PRIMARY KEY (`Calificacion_ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for SS_ComentariosBlog
-- ----------------------------
DROP TABLE IF EXISTS `SS_ComentariosBlog`;
CREATE TABLE `SS_ComentariosBlog`  (
  `Comentario_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Comentario_Comentario` varchar(20000) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Comentario_FechaCrea` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `Comentario_Nombre` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Comentario_foto` varchar(2000) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Comentario_Blog_ID` int(11) NULL DEFAULT NULL,
  `Comentario_Stado_comentario` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`Comentario_ID`) USING BTREE,
  INDEX `comentario_blogs`(`Comentario_Blog_ID`) USING BTREE,
  CONSTRAINT `comentario_blogs` FOREIGN KEY (`Comentario_Blog_ID`) REFERENCES `SS_Blog` (`Blog_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for SS_Documentos
-- ----------------------------
DROP TABLE IF EXISTS `SS_Documentos`;
CREATE TABLE `SS_Documentos`  (
  `Docuemnto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Documento_ruta` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Documento_descripcion` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Documento_MateriaID` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`Docuemnto_ID`) USING BTREE,
  INDEX `documento_materias`(`Documento_MateriaID`) USING BTREE,
  CONSTRAINT `documento_materias` FOREIGN KEY (`Documento_MateriaID`) REFERENCES `SS_Materia` (`Materia_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for SS_Grupo
-- ----------------------------
DROP TABLE IF EXISTS `SS_Grupo`;
CREATE TABLE `SS_Grupo`  (
  `Grup_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Grup_Nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `Grup_Usuario_ID` int(11) NULL DEFAULT NULL,
  `Grup_FechaAdicion` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Grup_Asignado` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`Grup_ID`) USING BTREE,
  INDEX `maestro_grupo`(`Grup_Usuario_ID`) USING BTREE,
  CONSTRAINT `maestro_grupo` FOREIGN KEY (`Grup_Usuario_ID`) REFERENCES `SS_Usuarios` (`Usuario_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for SS_Materia
-- ----------------------------
DROP TABLE IF EXISTS `SS_Materia`;
CREATE TABLE `SS_Materia`  (
  `Materia_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Materia_Nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `Materia_Fecha_Crea` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `Materia_Grupo_ID` int(11) NULL DEFAULT NULL,
  `Materia_Status` tinyint(4) NULL DEFAULT 0,
  PRIMARY KEY (`Materia_ID`) USING BTREE,
  INDEX `materia_grupo`(`Materia_Grupo_ID`) USING BTREE,
  CONSTRAINT `materia_grupo` FOREIGN KEY (`Materia_Grupo_ID`) REFERENCES `SS_Grupo` (`Grup_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for SS_Tareas
-- ----------------------------
DROP TABLE IF EXISTS `SS_Tareas`;
CREATE TABLE `SS_Tareas`  (
  `Tarea_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Tarea_Nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `Tarea_Descripcion` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `Tarea_Unidad_ID` int(11) NULL DEFAULT NULL,
  `Tarea_Fecha_Creacion` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `Tarea_Fecha_inicio` date NULL DEFAULT NULL,
  `Tarea_Fecha_fin` date NULL DEFAULT NULL,
  `Tarea_valor_porcentaje` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`Tarea_ID`) USING BTREE,
  INDEX `tareas_unidad`(`Tarea_Unidad_ID`) USING BTREE,
  CONSTRAINT `tareas_unidad` FOREIGN KEY (`Tarea_Unidad_ID`) REFERENCES `SS_Unidades` (`Unidades_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 73 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for SS_Unidades
-- ----------------------------
DROP TABLE IF EXISTS `SS_Unidades`;
CREATE TABLE `SS_Unidades`  (
  `Unidades_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Unidad_Descripcion` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `Unidad_Fecha_Creacion` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `Unidad_Materia_ID` int(11) NOT NULL,
  PRIMARY KEY (`Unidades_ID`) USING BTREE,
  INDEX `unidad_materia`(`Unidad_Materia_ID`) USING BTREE,
  CONSTRAINT `unidad_materia` FOREIGN KEY (`Unidad_Materia_ID`) REFERENCES `SS_Materia` (`Materia_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for SS_Usuarios
-- ----------------------------
DROP TABLE IF EXISTS `SS_Usuarios`;
CREATE TABLE `SS_Usuarios`  (
  `Usuario_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Usuario_Nombre` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `Usuario_Usr` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `Usuario_Password` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `Usuario_Tipo` tinyint(4) NULL DEFAULT NULL,
  `Usuario_Correo` varchar(60) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `Usuario_Avatar` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `Usuario_Dir` varchar(1000) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `Usuario_Mensaje` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`Usuario_ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 112 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for webchat_lines
-- ----------------------------
DROP TABLE IF EXISTS `webchat_lines`;
CREATE TABLE `webchat_lines`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `author` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `gravatar` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `text` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ts` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `ts`(`ts`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- View structure for VistaTareasPorHacer
-- ----------------------------
DROP VIEW IF EXISTS `VistaTareasPorHacer`;
CREATE ALGORITHM = UNDEFINED DEFINER = `root`@`localhost` SQL SECURITY DEFINER VIEW `VistaTareasPorHacer` AS select `SS_Materia`.`Materia_ID` AS `Materia_ID`,`SS_Materia`.`Materia_Nombre` AS `Materia_Nombre`,`SS_Unidades`.`Unidades_ID` AS `Unidades_ID`,`SS_Unidades`.`Unidad_Descripcion` AS `Unidad_Descripcion`,`SS_Tareas`.`Tarea_ID` AS `Tarea_ID`,`SS_Tareas`.`Tarea_Nombre` AS `Tarea_Nombre`,`SS_Tareas`.`Tarea_Descripcion` AS `Tarea_Descripcion`,`SS_Tareas`.`Tarea_Fecha_inicio` AS `Tarea_Fecha_inicio`,`SS_Tareas`.`Tarea_Fecha_fin` AS `Tarea_Fecha_fin`,`SS_Tareas`.`Tarea_valor_porcentaje` AS `Tarea_valor_porcentaje`,`SS_Grupo`.`Grup_ID` AS `Grup_ID`,`SS_Grupo`.`Grup_Nombre` AS `Grup_Nombre`,`Mestro`.`Usuario_Nombre` AS `Maestro_nombre`,`Mestro`.`Usuario_ID` AS `Maestro_ID`,`SS_Alumnos_Registrados`.`Resgistro_AlumnoID` AS `Resgistro_AlumnoID` from (((((`SS_Alumnos_Registrados` join `SS_Materia` on((`SS_Alumnos_Registrados`.`Resgistro_MateriaID` = `SS_Materia`.`Materia_ID`))) join `SS_Unidades` on((`SS_Unidades`.`Unidad_Materia_ID` = `SS_Materia`.`Materia_ID`))) join `SS_Tareas` on((`SS_Tareas`.`Tarea_Unidad_ID` = `SS_Unidades`.`Unidades_ID`))) join `SS_Grupo` on((`SS_Grupo`.`Grup_ID` = `SS_Materia`.`Materia_Grupo_ID`))) join `SS_Usuarios` `Mestro` on((`Mestro`.`Usuario_ID` = `SS_Grupo`.`Grup_Usuario_ID`)));

SET FOREIGN_KEY_CHECKS = 1;
