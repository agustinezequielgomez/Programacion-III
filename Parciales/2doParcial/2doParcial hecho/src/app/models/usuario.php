<?php
namespace App\Models;
class usuario extends \Illuminate\Database\Eloquent\Model
{
    function ValidarUsuarioExistenteLogin()
    {
        $usuarios = usuario::all();
        foreach($usuarios as $usuario)
        {
            if($usuario->id == $this->id)
            {
                if($usuario->clave == $this->clave)
                {
                    return $usuario;
                }
                else
                {
                    return "clave";
                }
            }
        }
        return "legajo";
    }

    static function encontrarUsuario($legajo)
    {
        $usuarios = usuario::all();
        foreach($usuarios as $usuario)
        {
            if($usuario->id == $id)
            {
                return $usuario;
            }
        }
        return false;
    }

    function ValidarLegajoExistente($legajo)
    {
        $usuarios = usuario::all();
        foreach($usuarios as $usuario)
        {
            if($usuario->id == $legajo)
            {
                return true;
            }
        }
        return false;
    }

    public static function subirFoto($archivos,$path,$usuario)
    {
        $nombreFoto = ($archivos["foto"])->getClientFileName();
        $extension = explode(".",$nombreFoto);
        $extension = array_reverse($extension)[0];
        $titulo = ($usuario->legajo.'_'.$usuario->nombre.'.'.$extension);
        $path .= $titulo;
        $archivos["foto"]->moveTo($path);
        return $path;
    }
}
?>