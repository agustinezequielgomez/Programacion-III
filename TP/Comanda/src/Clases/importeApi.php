<?php
namespace clases;
use clases\VerificadorJWT;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\importe;
use App\Models\pedido;

class importeApi
{
    static function EnviarUno(Request $request, Response $response, array $args)
    {
        $id_pedido = $request->getAttribute('id_pedido');
        $pedido = pedido::find($id_pedido);
        $importe = new importe(["id_mesa"=>$pedido->n_mesa,"id_pedido"=>$pedido->id,"importe"=>$pedido->importe]);
        $importe->save();
        return $response;
    }
}
?>