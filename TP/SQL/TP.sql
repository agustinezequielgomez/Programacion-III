--Punto 1:
CREATE DATABASE UTN;

CREATE TABLE Proovedores (Numero int NOT NULL, Nombre varchar(30), Domicilio varchar(50), Localidad varchar (80), PRIMARY KEY (Numero));

CREATE TABLE Productos(pNumero int NOT NULL, pNombre varchar(30), Precio float, Tamaño varchar(20), PRIMARY KEY(pNumero));

CREATE TABLE Envios (Numero int NOT NULL, pNumero int NOT NULL, Cantidad int NOT NULL, PRIMARY KEY(Numero, pNumero));

--Punto 2:
INSERT INTO `proovedores`(`Numero`, `Nombre`, `Domicilio`, `Localidad`) VALUES (100,"Perez","Peron 876","Quilmes"),(101,"Gimenez","Mitre 750","Avellaneda"),(102,"Aguirre","Boedo 634", "Bernal");

INSERT INTO `productos`(`pNumero`, `pNombre`, `Precio`, `Tamaño`) VALUES (1,"Caramelos",1.5,"Chico"),(2,"Cigarrillos",45.89,"Mediano"),(3,"Gaseosa",15.80,"Grande");

INSERT INTO `envios`(`Numero`, `pNumero`, `Cantidad`) VALUES (100,1,500),(100,2,1500),(100,3,100),(101,2,55),(101,3,225),(102,1,600),(102,3,300);

--Punto 3 (Consultas):
--1
SELECT * FROM `productos` 
ORDER BY pNombre ASC;

--2
SELECT * 
FROM `proovedores` 
WHERE Localidad = "Quilmes";

--3
SELECT * 
FROM `envios` 
WHERE Cantidad 
BETWEEN 200 AND 300;

--4
SELECT SUM(Cantidad) 
FROM `envios`;

--5
SELECT pNumero 
FROM `envios` LIMIT 3;

--6
SELECT PR.Nombre, P.pNombre 
FROM `envios` AS E 
INNER JOIN `productos` AS P 
ON E.pNumero = P.pNumero 
INNER JOIN `proovedores` AS PR 
ON PR.Numero = E.Numero;

--7
SELECT (E.cantidad*P.precio) as Monto 
FROM `envios` AS E 
INNER JOIN `productos` AS P 
ON P.pNumero = E.pNumero;

--8
SELECT Cantidad 
FROM `envios` 
WHERE Numero = 102 AND pNumero = 1;

--9
SELECT pNumero AS "Numero de producto" 
FROM `envios` AS E 
INNER JOIN `proovedores` AS PR 
ON E.Numero = PR.Numero 
WHERE PR.Localidad = 'Avellaneda';

--10
SELECT Domicilio, Localidad 
FROM `proovedores`
WHERE Nombre 
LIKE "%i%";

--11
INSERT INTO `productos`(`pNumero`, `pNombre`, `Precio`, `Tamaño`) 
VALUES (4,"Chocolate",25.35,"Chico");

--12
INSERT INTO `proovedores`(`Numero`) 
VALUES (103);

--13
INSERT INTO `proovedores` (Numero,Nombre,Localidad) 
VALUES (107,"Rosales","La Plata");

--14
UPDATE `productos` 
SET Precio = 97.50 
WHERE Tamaño = "Grande";

--15


--16
DELETE FROM `productos` 
WHERE pNumero = 1;

--17
DELETE FROM `proovedores` 
WHERE Numero NOT IN (SELECT E.Numero FROM `envios` AS E);