<?php
include_once "Humano.php";
class Persona extends Humano
{
    
    public $DNI;
    
    /*function __construct($Nombre, $Edad, $Dni)
    {
        parent::__construct($Nombre, $Edad);
        $this->DNI = $Dni;
    }*/
    
    function ReturnJson()
    {
        return parent::ReturnJson();
    }
}

?>