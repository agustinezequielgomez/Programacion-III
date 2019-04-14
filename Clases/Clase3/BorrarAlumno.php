<?php
require_once "alumno.php";
parse_str(file_get_contents('php://input'), $_DELETE);
switch($_DELETE["archivo"])
{
    case 1:
    alumno::BorrarAlumnoTxt("C:\\xampp\htdocs\Programacion-III\Clases\Clase3\ListadoAlumnos.txt",$_DELETE);
    break;
    
    case 2:
    alumno::BorrarAlumnoJSON("C:\\xampp\htdocs\Programacion-III\Clases\Clase3\ListadoAlumnos.JSON",$_DELETE);
    break;

    case 3:
    alumno::BorrarAlumnoArrayJSON("C:\\xampp\htdocs\Programacion-III\Clases\Clase3\ArrayAlumnos.JSON",$_DELETE);
    break;
}
?>