<?php
include_once "turnos.php";
$turno = new Turno($_POST["patente"],$_POST["fecha"],$_POST["tipoServicio"]);
if((Vehiculo::ValidarPatente($_POST["patente"],"./vehiculos.txt")==-1)&&(Servicio::ValidarServicios($_POST["tipoServicio"])==0))
{
    $turno->cargarTurno("./turnos.txt","./vehiculos.txt","./tipoServicios.txt");
    echo "<br>El turno se cargo exitosamente<br>";
}
else
{
    echo "<br>El vehiculo no existe o el tipo de Servicio seleccionado no es correcto (10.000km/20.000km/50.000km)";
}
?>