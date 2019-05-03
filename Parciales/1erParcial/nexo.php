<?php
switch($_GET["caso"])
{
    case "cargarVehiculo":
    include_once "cargarVehiculo.php";
    break;

    case "consultarVehiculo":
    include_once "consultarVehiculo.php";
    break;

    case "cargarTipoServicio":
    include_once "cargarTipoServicio.php";
    break;

    case "sacarTurno":
    include_once "sacarTurno.php";
    break;

    case "Turnos":
    include_once "Turno.php";
    break;

    case "Inscripciones":
    include_once "Inscripciones.php";
    break;

    case "modificarVehiculo":
    include_once "modificarVehiculo.php";
    break;

    case "vehiculos":
    include_once "vehiculos.php";
    break;
}
?>