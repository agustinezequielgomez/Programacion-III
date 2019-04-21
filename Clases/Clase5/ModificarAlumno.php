<?php
include_once "alumno.php";
parse_str(file_get_contents('php://input'), $_PUT);
alumno::ModificarAlumnoDB($_PUT);
alumno::ModificarAlumnoTxt("C:\\xampp\htdocs\Programacion-III\Clases\Clase5\ListadoAlumnos.txt",$_PUT);
alumno::ModificarAlumnoJSON("C:\\xampp\htdocs\Programacion-III\Clases\Clase5\ListadoAlumnos.JSON",$_PUT);
alumno::ModificarAlumnoArrayJSON("C:\\xampp\htdocs\Programacion-III\Clases\Clase5\ArrayAlumnos.JSON",$_PUT);
?>