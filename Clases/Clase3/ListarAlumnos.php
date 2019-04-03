<?php
require_once "alumno.php";
$vectorTxt =  alumno::MostrarAlumnosTxt("C:\\xampp\htdocs\Programacion-III\Clases\Clase3\ListadoAlumnos.txt"); // con clase::Metodo invoco a un metodo estatico
foreach($vectorTxt as $alumnos)
{
    echo $alumnos, "<br>";
}

$vectorJSONIndiv = alumno::MostrarAlumnosJSON("C:\\xampp\htdocs\Programacion-III\Clases\Clase3\ListadoAlumnos.json");
foreach($vectorJSONIndiv as $alumnosJson)
{
    var_dump($alumnosJson); 
    echo "<br>";
}

$vectorJSONArray = alumno::MostrarAlumnosArrayJSON("C:\\xampp\htdocs\Programacion-III\Clases\Clase3\ArrayAlumnos.json");
foreach($vectorJSONArray as $alumnosArrayJSON)
{
    echo $alumnosArrayJSON,"<br>";
}
?>