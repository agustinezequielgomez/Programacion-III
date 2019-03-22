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

    public function __construct($apellido, $numero, $letra)
    {
        $this->DNI = $numero;
        $this->legajo = $apellido;
        $this->nombre = $letra;
    }

    public function ReturnJson()
    {
        return json_encode($this);
    }
}
?>