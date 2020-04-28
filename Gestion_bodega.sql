-- create database and name it
CREATE DATABASE gestion_bodega;
-- use database throughout the whole script
USE gestion_bodega;

/*

create table and declare data

VARCHAR : data type of the variable; it handles up to 50 characters such as lower and upper case letters, numbers, and some special characters
NOT NULL : data can't be empty
PRIMARY KEY : assign a unique and non clonable key for each user
chaset means character codification

*/

CREATE TABLE personal(
	rut VARCHAR(50) NOT NULL,
	nombre VARCHAR(50) NOT NULL,
	apellido VARCHAR(50) NOT NULL,
	cargo VARCHAR(50) NOT NULL,
	contraseña VARCHAR(50) NOT NULL,
	PRIMARY KEY(rut)
)charset=latin1;

CREATE TABLE productos(
	cod_producto VARCHAR(20) NOT NULL,
	descripcion VARCHAR(50) NOT NULL,
	stock VARCHAR(20) NOT  NULL,
	proveedor VARCHAR(50) NOT NULL,
	fecha_ingreso VARCHAR(30) NOT NULL,
	PRIMARY KEY(cod_producto)
)charset=latin1;

CREATE TABLE entregas(
	rut VARCHAR(20) NOT NULL,
	cod_producto VARCHAR(50) NOT NULL,
	cantidad VARCHAR(50) NOT NULL,
	fecha_entrega VARCHAR(30) NOT NULL
)charset=latin1;

-- insert data into a database and declare data in the same order as in the table
INSERT INTO productos(cod_producto, descripcion, stock, proveedor, fecha_ingreso) VALUES
("100", "Casco de seguridad", "50", "Vicsa S.A", "20-04-2016"),
("101", "Guantes de seguridad", "50", "Fesam LTDA", "2016-04-22"),
("102", "Calzado de seguridad", "50", "Litios S.A", "2016-04-22");


INSERT INTO personal(rut, nombre, apellido, cargo, contraseña) VALUES
("180332403", "Juan", "Pérez", "Admin", MD5("JP2016")),
("153204209", "Blanca", "Ríos", "Bodega", md5("BR2016"));