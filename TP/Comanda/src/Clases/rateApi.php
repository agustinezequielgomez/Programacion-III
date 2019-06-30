<?php
namespace clases;
use clases\VerificadorJWT;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\rate;
use App\Models\mesa;

class rateApi
{
    static function EnviarPuntuacion(Request $request, Response $response, array $args)
    {
        $atributos = $request->getParsedBody();
        $codigo_mesa = $atributos['codigo_identificacion'];
        $id_pedido = (mesa::select('id_pedido')->where('codigo_identificacion',$codigo_mesa)->get())[0]->id_pedido;
        $id_mesa = (mesa::select('id')->where('codigo_identificacion',$codigo_mesa)->get())[0]->id;
        $rate = new rate(["id_pedido"=>$id_pedido,"id_mesa"=>$id_mesa,"rate_mesa"=>$atributos["rate_mesa"],"rate_mozo"=>$atributos["rate_mozo"],"rate_cocinero"=>$atributos["rate_cocinero"],"rate_restaurant"=>$atributos["rate_restaurant"],"comentario"=>$atributos["comentario"]]);
        $rate->save();
        return $response->getBody()->write("Puntuaciones guardadas. Gracias por ayudarnos a mejorar!");
    }
}
?>