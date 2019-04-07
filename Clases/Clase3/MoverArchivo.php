<?php
include_once "alumno.php";
$alumnos = alumno::TraerAMemoriaTxt("C:\\xampp\htdocs\Programacion-III\Clases\Clase3\ListadoAlumnos.txt");
foreach($alumnos as $alumno)
{
    $alumno->GuardarFoto("./Archivos");
    $alumno->PonerMarcaDeAgua("./Archivos/480px-Twenty_One_Pilots_logo2.jpg");
}

?>