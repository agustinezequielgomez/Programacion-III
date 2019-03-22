<?php
include_once "Persona.php";
class alumno extends Persona 
{
    public $legajo;

    public function __construct($Nombre, $Edad, $Dni, $Legajo)
    {
        parent::__construct($Nombre,$Edad,$Dni);
        $this->legajo = $Legajo;
    }

    public function ReturnJson()
    {
        return parent::ReturnJson();
    }
}
?>