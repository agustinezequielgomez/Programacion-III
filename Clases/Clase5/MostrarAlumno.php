<?php
include_once "alumno.php";
echo "DB:<br>";
alumno::MostrarTodosLosAlumnosDB();
echo "<br>TXT:";
alumno::MostrarAlumnoTxt("C:\\xampp\htdocs\Programacion-III\Clases\Clase5\ListadoAlumnos.txt");
echo "<br>JSON:";
alumno::MostrarAlumnosJSON("C:\\xampp\htdocs\Programacion-III\Clases\Clase5\ListadoAlumnos.JSON");
echo "<br>Array JSON:";
alumno::MostrarAlumnosArrayJSON("C:\\xampp\htdocs\Programacion-III\Clases\Clase5\ArrayAlumnos.JSON");
?>