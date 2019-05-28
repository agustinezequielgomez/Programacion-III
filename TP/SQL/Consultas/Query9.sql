SELECT pNumero AS "Numero de producto" 
FROM `envios` AS E 
INNER JOIN `proovedores` AS PR 
ON E.Numero = PR.Numero 
WHERE PR.Localidad = 'Avellaneda';