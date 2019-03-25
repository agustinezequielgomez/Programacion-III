<?php
$num = (string)rand(20,60);
$cadenaOutput = "Num";
switch($num[0])
{
    case "2":
    if($num[1] == "0")
    {
        $cadenaOutput = "veinte";
    }
    else
    {
        $cadenaOutput = "veinti";
    }
    break;

    case "3":
    $cadenaOutput = "treinta";
    break;

    case "4":
    $cadenaOutput = "cuarenta";
    break;

    case "5":
    $cadenaOutput = "cincuenta";
    break;

    case "6":
    $cadenaOutput = "sesenta";
    break;
}

if($num[0] != "2" && $num[1] != "0")
{
    $cadenaOutput .= " y ";
}

switch($num[1])
    {
        case "1":
        $cadenaOutput .= "uno";
        break;
    
        case "2":
        $cadenaOutput .= "dos";
        break;

        case "3":
        $cadenaOutput .= "tres";
        break;

        case "4":
        $cadenaOutput .= "cuatro";
        break;
        
        case "5":
        $cadenaOutput .= " y cinco";
        break;

        case "6":
        $cadenaOutput .= "seis";
        break;
        
        case "7":
        $cadenaOutput .= "siete";
        break;

        case "8":
        $cadenaOutput .= "ocho";
        break;
        
        case "9":
        $cadenaOutput .= "nueve";
        break;
    }

echo "<br>",$num,"<br>",$cadenaOutput;
?>