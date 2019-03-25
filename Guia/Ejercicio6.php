<?php
$operador = array("+","-","/","*");
$op1 = rand(0,120);
$op2 = rand(0,120);
switch($operador[rand(0,3)])
{
    case "+":
    echo $op1, "+", $op2, "=", $op1+$op2;
    break;

    case "-":
    echo $op1, "-", $op2, "=", $op1-$op2;
    break;

    case "/":
    if($op2 == 0)
    {
        echo "<br>No se puede dividir por 0";
    }
    else
    {
        echo $op1, "/", $op2, "=", $op1/$op2;
    }
    break;

    case "*":
    echo $op1, "*", $op2, "=", $op1*$op2;
    break;
}
?>