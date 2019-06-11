<?php
namespace App\Models;
class registro extends \Illuminate\Database\Eloquent\Model
{
    static function crearRegistro(empleado $empleado)
    {
        $log = new registro();
        $log->id_usuario = $empleado->id;
        $log->nombre = $empleado->nombre;
        $log->save();
    }
}
?>