<?php
include_once "alumno.php";
$alumno = alumno::MostrarTodosLosAlumnosDB();
var_dump($alumno);
?>