<?php
include_once "alumno.php";
parse_str(file_get_contents('php://input'), $_PUT);
switch($_PUT["archivo"])
{
    case 1:
    alumno::ModificarAlumnoTxt("C:\\xampp\htdocs\Programacion-III\Clases\Clase3\ListadoAlumnos.txt",$_PUT);
    break;
    
    case 2:
    alumno::ModificarAlumnoJSON("C:\\xampp\htdocs\Programacion-III\Clases\Clase3\ListadoAlumnos.JSON",$_PUT);
    break;

    case 3:
    alumno::ModificarAlumnoArrayJSON("C:\\xampp\htdocs\Programacion-III\Clases\Clase3\ArrayAlumnos.JSON",$_PUT);
    break;
}
?>