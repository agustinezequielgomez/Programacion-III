DELETE FROM `proovedores` 
WHERE Numero NOT IN (SELECT E.Numero FROM `envios` AS E);