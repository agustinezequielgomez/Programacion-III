<?php
include_once "servicio.php";
$servicio = new Servicio($_POST["id"],$_POST["tipo"],$_POST["precio"],$_POST["demora"]);
if((Servicio::ValidarServicios($_POST["tipo"]))!=-1)
{
    $servicio->cargarServicio("./tipoServicios.txt");
    echo "<br>El servicio se cargo exitosamente<br>";
}
else
{
    echo "<br>El tipo de servicio ingresado no es valido<br>";
}
?>