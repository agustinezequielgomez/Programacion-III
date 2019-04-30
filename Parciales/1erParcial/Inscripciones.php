<?php
include_once "turnos.php";
Turno::Inscripciones("./turnos.txt",$_GET["dato"]);
?>