<?php
namespace App\Models;
class pedido extends \Illuminate\Database\Eloquent\Model
{
    public static function generarCodigoDePedido() 
    { 
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        return substr(str_shuffle($str_result), 0, 5); 
    } 

    public static function procesarPedidos($pedidos)
    {
        $pedidosParsed = array();
        $alimentos = ["comida","vino","cerveza","postre"];
        foreach($alimentos as $alimento)
        {
            if($pedidos[$alimento]!=NULL)
            {
                $pedidosParsed[$alimento] = explode(", ",$pedidos[$alimento]);
            }
            else
            {
                $pedidosParsed[$alimento] = [];
            }
        }
        return $pedidosParsed;
    }

    public static function calcularImporte($alimentos)
    {
        return ((sizeof($alimentos["comida"])*150)+(sizeof($alimentos["vino"])*200)+(sizeof($alimentos["cerveza"])*100)+(sizeof($alimentos["postre"])*70));
    }

    public function subirFoto($archivos,$path)
    {
        $nombreFoto = ($archivos["foto"])->getClientFileName();
        $extension = explode(".",$nombreFoto);
        $extension = array_reverse($extension)[0];
        $titulo = ("Mesa_".$this->n_mesa."_Pedido_".$this->codigo_pedido.'.'.$extension);
        $path .= $titulo;
        $archivos["foto"]->moveTo($path);
        return $path;
    }
}
?>