CREATE DATABASE UTN;

CREATE TABLE Proovedores (Numero int NOT NULL, Nombre varchar(30), Domicilio varchar(50), Localidad varchar (80), PRIMARY KEY (Numero));

CREATE TABLE Productos(pNumero int NOT NULL, pNombre varchar(30), Precio float, Tamaño varchar(20), PRIMARY KEY(pNumero));

CREATE TABLE Envios (Numero int NOT NULL, pNumero int NOT NULL, Cantidad int NOT NULL, PRIMARY KEY(Numero, pNumero));