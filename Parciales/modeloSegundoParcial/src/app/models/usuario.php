<?php
namespace App\Models;
class usuario extends \Illuminate\Database\Eloquent\Model
{
    function VerificarUsuarioExistente()
    {
        $usuarios = self::all();
        foreach($usuarios as $usuario)
        {
            if($usuario->nombre == $this->nombre && $usuario->clave == $this->clave)
            {
                return $usuario;
            }
        }
        return false;
    }   
}
?>