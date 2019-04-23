<?php
include_once "alumno.php";
var_dump($_POST);
$alumno = alumno::MiConstructor((int)$_POST["DNI"],$_POST["Nombre"],(int)$_POST["Edad"],(int)$_POST["Legajo"]);
$ID = $alumno->GuardarUnAlumnoParametrosDB();
$alumno->ID = $ID;
$alumnos = array();
array_push($alumnos,$alumno);
$alumno->GuardarAlumnoTxt("C:\\xampp\htdocs\Programacion-III\Parciales\MetodosAlumno1erParcial\ListadoAlumnos.txt");
$alumno->GuardarJSONIndividual("C:\\xampp\htdocs\Programacion-III\Parciales\MetodosAlumno1erParcial\ListadoAlumnos.JSON");
$alumno->GuardarArrayJSON("C:\\xampp\htdocs\Programacion-III\Parciales\MetodosAlumno1erParcial\ArrayAlumnos.JSON",$alumnos);
$alumno->GuardarFoto("./Archivos");
?>