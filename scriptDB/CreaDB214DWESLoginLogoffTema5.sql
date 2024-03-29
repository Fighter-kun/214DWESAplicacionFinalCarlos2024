/**
 * Author:  Carlos García Cachón
 * Created: 28 nov 2023
 */

--Eliminar base de datos en caso de que exista
DROP DATABASE IF EXISTS DB214DWESLoginLogoffTema5;

DROP USER IF EXISTS 'user214DWESLoginLogoffTema5'@'%';

--Crear la base de datos
CREATE DATABASE DB214DWESLoginLogoffTema5;

--Utilizar la base de datos recién creada
USE DB214DWESLoginLogoffTema5;

--Crear la tabla T01_Usuario
CREATE TABLE T01_Usuario (
    T01_CodUsuario CHAR(8) PRIMARY KEY,
    T01_Password VARCHAR(64),
    T01_DescUsuario VARCHAR(255),
    T01_NumConexiones INT DEFAULT 0,
    T01_FechaHoraUltimaConexion DATETIME DEFAULT NULL,
    T01_Perfil ENUM('usuario','administrador') DEFAULT 'usuario',
    T01_ImagenUsuario BLOB
)ENGINE=INNODB;

--Crear la tabla T02_Departamento
CREATE TABLE T02_Departamento (
    T02_CodDepartamento CHAR(3) PRIMARY KEY,
    T02_DescDepartamento VARCHAR(255),
    T02_FechaCreacionDepartamento DATETIME DEFAULT CURRENT_TIMESTAMP,
    T02_VolumenDeNegocio FLOAT,
    T02_FechaBajaDepartamento DATETIME
)ENGINE=INNODB;

--Crear la tabla T06_Animales
CREATE TABLE T06_Animal (
    T06_CodAnimal CHAR(3) PRIMARY KEY,
    T06_DescAnimal VARCHAR(255),
    T06_FechaNacimiento DATETIME DEFAULT CURRENT_TIMESTAMP,
    T06_Sexo ENUM('macho','hembra'),
    T06_Raza VARCHAR(255),
    T06_Precio DECIMAL(10, 2),
    T06_FechaBaja DATETIME DEFAULT NULL
)ENGINE=INNODB;

--Creación del usuario de la base de datos
CREATE USER 'user214DWESLoginLogoffTema5'@'%' IDENTIFIED BY 'paso';

--Otorgar permisos al usuario para acceder a la base de datos
GRANT ALL PRIVILEGES ON DB214DWESLoginLogoffTema5.* TO 'user214DWESLoginLogoffTema5'@'%';
