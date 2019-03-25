<?php

$a = rand(0,3);
$b = rand(0,3);
$c = rand(0,3);
$mensaje = "El valor del medio es ";
echo $a, "<br>", $b,"<br>",$c,"<br>";

if($a>$b&&$a<$c)
{
    echo $mensaje . $a;
}
else if($b<$a&&$b>$c)
{
    echo $mensaje . $b;
}
else if($c>$a&&$c<$b)
{
    echo $mensaje . $c;
}
else
{
    echo "No hay valor del medio";
}
?>