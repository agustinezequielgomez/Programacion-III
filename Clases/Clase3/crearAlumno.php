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
echo $edad = (int)$_POST["edad"];
echo "<br>dni:";
echo $dni = (int)$_POST["dni"];
echo "<br>legajo:";
echo $legajo = (int)$_POST["legajo"];

/*COMENTADO PORQUE LAS VARIABLES SE PASAN POR POST
echo "<br><br>GETS:<br>";
echo "<br>nombre:";
echo $nombre = $_GET["nombre"];
echo "<br>edad:";
echo $edad = $_GET["edad"];
echo "<br>dni:";
echo $dni = $_GET["dni"];
echo "<br>legajo:";
echo $legajo = $_GET["legajo"];*/


echo "<br>";
$miAlumno = new alumno($nombre,$edad,$dni,$legajo);
echo "<br>miAlumno:";
var_dump($miAlumno);
echo "<br>JSON miAlumno:";
echo $miAlumno->ReturnJson();

$miAlumno2 = new alumno("agustin",12,42147,1123);
$alumnos = array();



$miAlumno->GuardarAlumnoTxt("C:\\xampp\htdocs\Programacion-III\Clases\Clase3\ListadoAlumnos.txt");
$miAlumno->GuardarJSONIndividual("C:\\xampp\htdocs\Programacion-III\Clases\Clase3\ListadoAlumnos.json");

    array_push($alumnos,$miAlumno);
    alumno::GuardarArrayJSON("C:\\xampp\htdocs\Programacion-III\Clases\Clase3\ArrayAlumnos.json",$alumnos);
?>