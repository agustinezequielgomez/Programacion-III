<?php
include_once "Vehiculo.php";
$vehiculo = new Vehiculo($_POST["marca"],$_POST["modelo"],$_POST["patente"],$_POST["precio"]);
if((Vehiculo::ValidarPatente($_POST["patente"],"./vehiculos.txt"))!=-1)
{
    $vehiculo->cargarVehiculo("./vehiculos.txt");
    echo "<br>El vehiculo fue ingresado exitosamente<br>";
}
else
{
    echo "<br>El vehiculo ya fue ingresado anteriormente<br>";
}
?>