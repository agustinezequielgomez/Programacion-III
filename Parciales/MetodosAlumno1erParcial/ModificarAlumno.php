<?php
include_once "alumno.php";
parse_str(file_get_contents('php://input'), $_PUT);
alumno::ModificarAlumnoDB($_PUT);
alumno::ModificarAlumnoTxt("C:\\xampp\htdocs\Programacion-III\Parciales\MetodosAlumno1erParcial\ListadoAlumnos.txt",$_PUT);
alumno::ModificarAlumnoJSON("C:\\xampp\htdocs\Programacion-III\Parciales\MetodosAlumno1erParcial\ListadoAlumnos.JSON",$_PUT);
alumno::ModificarAlumnoArrayJSON("C:\\xampp\htdocs\Programacion-III\Parciales\MetodosAlumno1erParcial\ArrayAlumnos.JSON",$_PUT);
?>