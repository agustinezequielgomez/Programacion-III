<?php
namespace App\Models;
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
}
?>