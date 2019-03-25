<?php
$animales = array();
array_push($animales,"Perro", "Gato", "Ratón", "Araña", "Mosca");
$años = array();
array_push($años ,"1986","1996","2015","78","86");
$tecnologias = array();
array_push($tecnologias,"php","mysql","html5","typescript","ajax");
$arrayMergeado = array_merge($animales,$años,$tecnologias);
foreach($arrayMergeado as $valor)
{
    echo "Valor: ",$valor,"<br>";
}
?>