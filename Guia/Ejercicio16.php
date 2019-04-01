<?php

$array = array("hola");
echo "Palabra original: ";
foreach($array as $letras)
{
    echo $letras;
}

echo "<br>","Palabra invertida: ";
invertirCaracteres($array);

function invertirCaracteres($array)
{
    $arrayInvertido = array_reverse($array);
    foreach($arrayInvertido as $letras)
    {
        echo $letras;
    }
}
?>