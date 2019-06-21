<?php
namespace App\Models;
use App\Models\empleado;
class alimento extends \Illuminate\Database\Eloquent\Model
{
    static function cargarAlimentos($alimentos, $pedido)
    {
        $tiposAlimento = array_keys($alimentos);
        foreach($tiposAlimento as $tipoAlimento)
        {
            foreach($alimentos[$tipoAlimento] as $alimentoPedido)
            {
                $alimento = new alimento();
                $alimento->id_pedido = $pedido->id;
                $alimento->tipo = $tipoAlimento;
                $alimento->nombre_alimento = $alimentoPedido;
                $alimento->estado = "Pendiente";
                $alimento->save();
            }            
        }
    }

    static function obtenerAlimentoBasadoEnPuesto($puestoEmpleado)
    {
        $respuesta;
        $alimento = new alimento();
        switch($puestoEmpleado)
        {
            case "bartender":
            $respuesta = ($alimento->where('tipo','=','vino')->orWhere('tipo','=','trago')->where('estado','Pendiente'))->get();
            break;

            case "cervecero":
            $respuesta = $alimento->where('tipo','=','cerveza')->where('estado','Pendiente')->get();
            break;

            case "cocinero":
            $respuesta = $alimento->where('tipo','=','comida')->where('estado','Pendiente')->get();
            break;

            case "socio":
            $respuesta = $alimento::all();
            break;
        }
        return $respuesta;
    }

    static function calcularTiempoEstimado()
    {
        
    }
}
?>