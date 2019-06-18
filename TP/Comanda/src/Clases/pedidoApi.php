<?php
namespace clases;
use clases\IApi;
use clases\VerificadorJWT;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\pedido;

class pedidoApi implements IApi
{
    function TraerUno(Request $request,Response $response,$args)
    {

    }

    function BorrarUno(Request $request, Response $response, $args)
    {

    }
    
    function EnviarUno(Request $request,Response $response, $args)
    {
        $tokenMozo = $request->getHeader('token')[0];
        $idMozo = (VerificadorJWT::TraerData($tokenMozo))->id;
        $atributos = $request->getParsedBody();
        $alimentos = pedido::procesarPedidos($atributos);
        $pedido = new pedido();
        $pedido->n_mesa = $atributos["n_mesa"];
        $pedido->estado = "Pendiente";
        $pedido->codigo_pedido = pedido::generarCodigoDePedido();
        $pedido->id_empleado = $idMozo;
        $pedido->importe = pedido::calcularImporte($alimentos);
        var_dump($pedido);
    }

    function ModificarUno(Request $request,Response $response, $args)
    {

    }
    
    function TraerTodos(Request $request,Response $response, $args)
    {

    }
}
?>