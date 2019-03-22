<?php
include_once "alumno.php";

echo "GET, POST y REQUEST:<br>";
echo "_get:<br>";
var_dump($_GET);
echo "<br>_post:<br>";
var_dump($_POST);
echo "<br>_request:<br>";
var_dump($_REQUEST);

echo "<br><br>POSTS:";
echo "<br>nombre:";
echo $nombre = $_POST["nombre"];
echo "<br>edad:";
echo $edad = $_POST["edad"];
echo "<br>dni:";
echo $dni = $_POST["dni"];
echo "<br>legajo:";
echo $legajo = $_POST["legajo"];

echo "<br><br>GETS:<br>";
echo "<br>nombre:";
echo $nombre = $_GET["nombre"];
echo "<br>edad:";
echo $edad = $_GET["edad"];
echo "<br>dni:";
echo $dni = $_GET["dni"];
echo "<br>legajo:";
echo $legajo = $_GET["legajo"];


echo "<br>";
$miAlumno = new alumno($nombre,$edad,$dni,$legajo);
echo "<br>miAlumno:";
var_dump($miAlumno);
echo "<br>JSON miAlumno:";
echo $miAlumno->ReturnJson();

$person = new Persona("a",12,42147544);
$person->ReturnJSON();

?>