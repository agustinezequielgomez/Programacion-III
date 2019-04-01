<?php

altafuncion(1);
altafuncion(2);
altafuncion(3);
altafuncion(4);


function altafuncion($numeroAPotenciar)
{
    for($i=0;$i<5;$i++)
    {
        echo pow($numeroAPotenciar,$i),"<br>";
    }
    echo "<br>";
}
?>