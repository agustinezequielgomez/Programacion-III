<?php
include_once "alumno.php";
echo "DB:<br>";
alumno::MostrarTodosLosAlumnosDB();
echo "<br>TXT:";
alumno::MostrarAlumnoTxt("C:\\xampp\htdocs\Programacion-III\Parciales\MetodosAlumno1erParcial\ListadoAlumnos.txt");
echo "<br>JSON:";
alumno::MostrarAlumnosJSON("C:\\xampp\htdocs\Programacion-III\Parciales\MetodosAlumno1erParcial\ListadoAlumnos.JSON");
echo "<br>Array JSON:";
alumno::MostrarAlumnosArrayJSON("C:\\xampp\htdocs\Programacion-III\Parciales\MetodosAlumno1erParcial\ArrayAlumnos.JSON");
?>