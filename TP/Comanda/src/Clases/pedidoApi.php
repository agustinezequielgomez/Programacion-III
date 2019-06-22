<?php
namespace clases;
use clases\VerificadorJWT;
use clases\alimentoApi;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\pedido;
use App\Models\alimento;

class pedidoApi
{
    function TraerUno(Request $request,Response $response,$args)
    {
        return (pedido::find($args['id']))->toJson();
    }

    function CancelarUno(Request $request, Response $response, $args)
    {
        $codigo_pedido = $request->getParsedBody()["codigo_pedido"];
        pedido::where('codigo_pedido',$codigo_pedido)->update(['estado','Cancelado']);
        $request = $request->withAttribute('id_pedido',pedido::select('id')->where('codigo_pedido',$codigo_pedido));
        alimentoApi::cancelarAlimentos($request,$response,$args);
        return $response->getBody()->write("\nPedido cancelado exitosamente");
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
        $pedido->foto = $pedido->subirFoto($request->getUploadedFiles(),"../files/fotos/");
        $pedido->save();
        alimento::cargarAlimentos($alimentos,$pedido);
        return $response->getBody()->write("\nPedido realizado con exito. Su codigo de pedido es: ".$pedido->codigo_pedido);
    }

    function ModificarUno(Request $request,Response $response, $args)
    {

    }
    
    static function actualizarEstadoPedido(Request $request, Response $response, $args)
    {
        $id = $request->getAttribute('id');
        $estado = $request->getAttribute('estado');
        return pedido::where('id',$id)->update(['estado'=>$estado]);
    }

    function TraerTodos(Request $request,Response $response, $args)
    {
        return $response->getBody()->write((pedido::all())->toJson());
    }
}
?>