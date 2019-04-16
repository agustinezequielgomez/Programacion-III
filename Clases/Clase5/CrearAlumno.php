<?php
include_once "alumno.php";
$alumno = alumno::MiConstructor($_POST["DNI"],$_POST["Nombre"],$_POST["Edad"],$_POST["Legajo"]);
$alumno->GuardarUnAlumnoParametrosDB();
?>