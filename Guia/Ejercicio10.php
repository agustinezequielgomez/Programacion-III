<?php   
$numeros = array();
$i = 0;
$j = 0;
do
{
    $i++;
    if($i%2!=0)
    {
        $numeros[$j] = $i;
        $j++;
    }
}while(count($numeros) < 10);


echo "<br>Con for<br>";
for($i = 0; $i<10; $i++)
{
    echo "<br>", $numeros[$i];
}
echo "<br>";

$i=0;
echo "<br>Con While<br>";
while($i<10)
{
    echo "<br>", $numeros[$i];
    $i++;
}

echo "<br>Con foreach<br>";
foreach($numeros as $val)
{
    echo "<br>", $val;
}
?>