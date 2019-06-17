<?php
namespace App\Models;
class logueo extends \Illuminate\Database\Eloquent\Model
{
    static function crearLogueo(empleado $empleado)
    {
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $log = new logueo();
        $log->id_usuario = $empleado->id;
        $log->nombre = $empleado->nombre;
        $log->fecha_ingreso = date('Y-m-d H:i:s');
        $log->save();
    }
}
?>