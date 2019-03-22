<?php
include_once "alumno.php";

echo "GET, POST y REQUEST:<br>";
echo "_get:<br>";
var_dump($_GET);
echo "<br>_post:<br>";
var_dump($_POST);
echo "<br>_request:<br>";
var_dump($_REQUEST);

//POSTS
echo "<br>nombre:";
$nombre = $_POST["nombre"];
echo "<br>edad:";
$edad = $_POST["edad"];
echo "<br>dni:";
$dni = $_POST["dni"];
echo "<br>legajo:";
$legajo = $_POST["legajo"];*

echo "<br>";
$miAlumno = new alumno($nombre,$edad,$dni,$legajo);
echo "<br>miAlumno:";
var_dump($miAlumno);
echo "<br>JSON miAlumno:";
echo $miAlumno->ReturnJson();


?>