<?php
namespace App\Models;
class empleado extends \Illuminate\Database\Eloquent\Model
{
    public function ValidarEmpleadoExistenteLogin()
    {
        $empleados = self::all();
        foreach($empleados as $empleado)
        {
            if($empleado->nombre == $this->nombre && $empleado->pass == $this->pass)
            {
                return $empleado;
            }
        }
        return false;
    }

    public function ValidarEmpleadoExistenteAlta()
    {
        $empleados = self::all();
        foreach($empleados as $empleado)
        {
            if($empleado->nombre == $this->nombre && $empleado->tipo == $this->tipo)
            {
                return true;
            }
        }
        return false;
    }

    public static function ValidarIdExistente($id)
    {
        $empleados = self::all();
        foreach($empleados as $empleado)
        {
            if($empleado->id == $id)
            {
                return true;
            }
        }
        return false;
    }
}
?>