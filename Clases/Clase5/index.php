<?php
$metodo = $_SERVER['REQUEST_METHOD'];
if($metodo == 'POST')
{
    include_once "CrearAlumno.php";
}
else if($metodo == 'GET')
{
    include_once "MostrarAlumno.php";
}
else if($metodo == 'DELETE')
{
    include_once "BorrarAlumno.php";
}
else if($metodo == 'PUT')
{
    include_once "ModificarAlumno.php";
}
?>