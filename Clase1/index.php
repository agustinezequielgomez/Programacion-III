<?php 
include "alumno.php";
include_once "alumno.php";



echo "<br><h1>hola</h1>";
$nombre = "Agustin<br>";
echo $nombre;
var_dump($nombre);
//$miArray = array("Nombre"=>"Agustin<br>","Edad"=>"19<br>");
$miArray = array();
$miArray["Nombre"] = "Agus<br>";
$miArray["Edad"] = 19;
var_dump($miArray);

$miObj = new stdClass();
$miObj -> nombre="Agus";
$miObj -> edad=19.59;
var_dump($miObj);

echo "<br><br>";
echo $miObj->edad;

$miAlumno = new alumno("g",1);
$miAlumno -> Nombre="Agus";
$miAlumno -> Edad=19.59;
var_dump($miAlumno);


echo "<br><br><br>";
$miAlumno2 = new alumno("agustin",23);
var_dump($miAlumno2);
echo "<br><br><br>";

$miAlumno2->ReturnJson();
?>