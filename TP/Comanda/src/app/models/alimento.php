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
                $alimento = new alimento(["id_pedido"=>$pedido->id,"tipo"=>$tipoAlimento,"nombre_alimento"=>$alimentoPedido,"estado"=>"Pendiente"]);
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
            $respuesta = $alimento->where('tipo','=','comida')->orWhere('tipo','postre')->where('estado','Pendiente')->get();
            break;

            case "socio":
            $respuesta = $alimento::all();
            break;
        }
        return $respuesta;
    }

    static function calcularTiempoEstimado($puestoEmpleado)
    {
        $tiempoBase;
        switch($puestoEmpleado)
        {
            case "bartender":
            $tiempoBase = 5;
            break;

            case "cervecero":
            $tiempoBase = 2;
            break;

            case "cocinero":
            $tiempoBase = 10;
            break;
        }
        $disponibles = empleado::BuscarEmpleadoDisponible($puestoEmpleado);
        $estimado = $tiempoBase/$disponibles;
        return date('H:i:s',strtotime('+'.round($estimado).' minutes',strtotime(date('H:i:s'))));
    }
}
?>