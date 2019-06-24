<?php
namespace App\Models;
class usuario extends \Illuminate\Database\Eloquent\Model
{
    static function validarAlta($legajo, $email)
    {
        $usuarios = (usuario::all());
        foreach($usuarios as $usuario)
        {
            if($usuario->legajo == $legajo &&$usuario->email == $email)
            {
                return false;
            }
        }
        return true;
    }

    static function validarLogin($legajo, $clave)
    {
        $usuarios = (usuario::all());
        foreach($usuarios as $usuario)
        {
            if($usuario->legajo == $legajo)
            {
                if($usuario->clave == $clave)
                {
                    return $usuario;
                }
                else
                {
                    return "contraseña";
                }
            }
        }
        return "legajo";
    }
}
?>