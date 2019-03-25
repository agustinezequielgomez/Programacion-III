<?php
$j = 0;
for($i = 0; $j + $i <= 1000; $i++)
{
    echo $i, " + ",$j;
    $j += $i;
    echo " = ", $j,"<br>";
}
echo "Se sumaron ", $i," numeros";
?>