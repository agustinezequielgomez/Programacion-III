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

    public static function BuscarEmpleadoDisponible($tipoDeEmpleado)
    {
        $empleados = empleado::where('estado','Activo')->where('tipo',$tipoDeEmpleado)->get(); //Obtengo todos los empleados que puedan preparar un X alimento y que esten activos
        $disponibles = 0;
        foreach($empleados as $empleado)
        {
            $alimentosEnPreparacionPorOtroEmpleado = alimento::where('estado','En preparacion')->where('id_empleado',$empleado->id)->get(); //Me fijo si esos empleados estan preparando algun alimento (si devuelve 0 es que no estan preparando ningun alimento)
            if($alimentosEnPreparacionPorOtroEmpleado->count()==0)
            {
                $disponibles++;
            }
        }
        return $disponibles;
    }
}
?>