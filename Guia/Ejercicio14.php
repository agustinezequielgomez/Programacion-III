<?php
$asociativo = array();
$asociativo = array("Animales" => array("Perro", "Gato", "Ratón", "Araña", "Mosca"), "Fechas" => array("1986","1996","2015","78","86"), "Tec" =>array("php","mysql","html5","typescript","ajax"));

$indexado = array();
$indexado[0] = array("Animales" => array("Perro", "Gato", "Ratón", "Araña", "Mosca"));
$indexado[1] = array("Fechas" => array("1986","1996","2015","78","86"));
$indexado[2] = array("Tec" =>array("php","mysql","html5","typescript","ajax"));
/*
$asociativo = array();
$asociativo["animales"] = array("Perro", "Gato", "Ratón", "Araña", "Mosca");
$asociativo["años"] = array("1986","1996","2015","78","86");
$asociativo["tecnologias"] = array("php","mysql","html5","typescript","ajax");
*/
foreach($asociativo as $array => $valor)
{
    echo "<br><br>Array: ",$array;
    foreach($valor as $valorSub)
    {
        echo "<br>Valor: ",$valorSub;
    }
}

echo "<br> Indexado:<br>";
foreach($indexado as $array)
{
    foreach($array as $subValor)
    {
        foreach($subValor as $subsubValor)
        {
            echo $subsubValor;
        }
    }
}
/*for($i = 0; $i < 3; $i++)
{
    echo $indexado[$i];
    for($j = 0; $j < 5; $j++)
    {
        echo $indexado[$j];
    }
}*/
?>