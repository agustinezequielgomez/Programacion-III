<?php
include_once "alumno.php";
parse_str(file_get_contents('php://input'), $_DELETE);
alumno::BorrarAlumnoDB($_DELETE);
alumno::BorrarAlumnoTxt("C:\\xampp\htdocs\Programacion-III\Clases\Clase5\ListadoAlumnos.txt",$_DELETE);
alumno::BorrarAlumnoJSON("C:\\xampp\htdocs\Programacion-III\Clases\Clase5\ListadoAlumnos.JSON",$_DELETE);
alumno::BorrarAlumnoArrayJSON("C:\\xampp\htdocs\Programacion-III\Clases\Clase5\ArrayAlumnos.JSON",$_DELETE);
alumno::MoverFotoBorrada($_DELETE,"./Archivos");
?>