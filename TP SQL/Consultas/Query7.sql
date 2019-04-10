SELECT (E.cantidad*P.precio) as Monto 
FROM `envios` AS E 
INNER JOIN `productos` AS P 
ON P.pNumero = E.pNumero;