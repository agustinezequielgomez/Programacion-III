<?php
class Humano
{
    public $Nombre;
    public $Edad;

    /*function __construct($nom,$ed)
    {
        $this->Nombre=$nom;
        $this->Edad=$ed;
    }*/

    public function ReturnJson()
    {
        return json_encode($this);
    }
}
?>