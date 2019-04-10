INSERT INTO `proovedores`(`Numero`, `Nombre`, `Domicilio`, `Localidad`) VALUES (100,"Perez","Peron 876","Quilmes"),(101,"Gimenez","Mitre 750","Avelaneda"),(102,"Aguirre","Boedo 634", "Bernal");

INSERT INTO `productos`(`pNumero`, `pNombre`, `Precio`, `Tamaño`) VALUES (1,"Caramelos",1.5,"Chico"),(2,"Cigarrillos",45.89,"Mediano"),(3,"Gaseosa",15.80,"Grande");

INSERT INTO `envios`(`Numero`, `pNumero`, `Cantidad`) VALUES (100,1,500),(100,2,1500),(100,3,100),(101,2,55),(101,3,225),(102,1,600),(102,3,300);