SELECT PR.Nombre, P.pNombre 
FROM `envios` AS E 
INNER JOIN `productos` AS P 
ON E.pNumero = P.pNumero 
INNER JOIN `proovedores` AS PR 
ON PR.Numero = E.Numero;