<?php
$array = array(rand(0,10),rand(0,10),rand(0,10),rand(0,10),rand(0,10));
$total = 0;
foreach($array as $val)
{
    $total += $val; 
}
echo $total, "<br>";
if($total/5>6)
{
    echo "El promedio es mayor a 6";
}
else if($total/5<6)
{
    echo "El promedio es menor a 6";
}
else
{
    echo "El promedio es igual a 6";
}
?>