<?php
include_once "Vehiculo.php";
Vehiculo::consultarVehiculo($_GET["dato"],"./vehiculos.txt");
?>