<?php
require_once "alumno.php";
$vector =  alumno::MostrarAlumnos("C:\\xampp\htdocs\Programacion-III\Clases\Clase2\ListadoAlumnos.txt"); // con clase::Metodo invoco a un metodo estatico
foreach($vector as $alumnos)
{
    echo $alumnos, "<br>";
}
?>