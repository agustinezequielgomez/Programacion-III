<?php
include_once "alumno.php";

echo "_get<br>";
var_dump($_GET);
echo "<br>_post<br>";
var_dump($_POST);
echo "<br>_request<br>";
var_dump($_REQUEST);

$nombre = $_POST["nombre"];
$edad = $_POST["edad"];
$dni = $_POST["dni"];
$legajo = $_POST["legajo"];

echo "<br>";
$miAlumno = new alumno($nombre,$edad,$dni,$legajo);
echo "<br>";
var_dump($miAlumno);
echo "<br>";
echo $miAlumno->ReturnJson();
?>