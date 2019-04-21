<?php
include_once "alumno.php";
parse_str(file_get_contents('php://input'), $_DELETE);
try
{
    alumno::BorrarAlumnoDB($_DELETE);
    alumno::BorrarAlumnoTxt("C:\\xampp\htdocs\Programacion-III\Parciales\MetodosAlumno1erParcial\ListadoAlumnos.txt",$_DELETE);
    alumno::BorrarAlumnoJSON("C:\\xampp\htdocs\Programacion-III\Parciales\MetodosAlumno1erParcial\ListadoAlumnos.JSON",$_DELETE);
    alumno::BorrarAlumnoArrayJSON("C:\\xampp\htdocs\Programacion-III\Parciales\MetodosAlumno1erParcial\ArrayAlumnos.JSON",$_DELETE);
    alumno::MoverFotoBorrada($_DELETE,"./Archivos");
}
catch(Exception $ex)
{
    echo $ex->getMessage();
}
?>