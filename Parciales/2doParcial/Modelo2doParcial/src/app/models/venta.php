<?php
namespace App\Models;
class venta extends \Illuminate\Database\Eloquent\Model
{
    static public function subirFoto($archivos,$path,$venta)
    {
        $nombreFoto = ($archivos["foto"])->getClientFileName();
        $extension = explode(".",$nombreFoto);
        $extension = array_reverse($extension)[0];
        $titulo = ($venta->id.'_'.$venta->marca.'.'.$extension);
        $path .= $titulo;
        $archivos["foto"]->moveTo($path);
        return $path;
    }
}
?>