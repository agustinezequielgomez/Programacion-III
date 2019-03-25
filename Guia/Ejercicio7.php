<?php
echo "Dia ",date("D d")," de ",date("F")," de ",date("Y"),"<br>";
$Fecha = strtotime("march 25");
switch(date("F",$Fecha))
{
    case "January":
    case "February":
    verano:
    echo "Es verano";
    break;

    case "March":
    if(date("d",$Fecha)>21)
    {
        otoño:
        echo "Es otoño";
    }
    else
    {
        goto verano;
    }
    break;

    case "April":
    case "May":
    goto otoño;
    break;

    case "June":
    if(date("d",$Fecha)>21)
    {
        invierno:
        echo "Es invierno";
    }
    else
    {
        goto otoño;
    }
    break;

    case "July":
    case "August":
    goto invierno;
    break;

    case "September":
    if(date("d",$Fecha)>21)
    {
        primavera:
        echo "Es primavera";
    }
    else
    {
        goto invierno;
    }
    break;

    case "October":
    case "November":
    goto primavera;
    break;

    case "December":
    if(date("d",$Fecha)>21)
    {
        goto verano;
    }
    else
    {
        goto primavera;
    }
    break;
}


?>