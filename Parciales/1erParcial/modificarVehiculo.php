<?php
include_once "vehiculo.php";
$vehiculo = new vehiculo($_POST["marca"],$_POST["modelo"],$_POST["patente"],$_POST["precio"]);
$vehiculo->ModificarVehiculo("./vehiculos.txt");
?>