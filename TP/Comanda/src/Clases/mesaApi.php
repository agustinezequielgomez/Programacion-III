<?php
namespace clases;
use clases\VerificadorJWT;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\mesa;
use App\Models\pedido;

class mesaApi
{
    function EnviarUno(Request $request, Response $response, array $args)
    {
        $mesa = new mesa();
        $mesa->estado = "cerrada";
        $mesa->codigo_identificacion = pedido::generarCodigoDePedido();
        $mesa->save();
        return $response->getBody()->write("Mesa dada de alta");
    }

    static function ActualizarEstado(Request $request, Response $response, array $args)
    {
        $estado = $request->getAttributes()['estado'];
        $id_mesa = $request->getAttributes()['id_mesa'];
        $id_pedido = $request->getAttributes()['id_pedido'];
        mesa::find($id_mesa)->update(["estado"=>$estado,"id_pedido"=>$id_pedido]);
    }

    function cobrarMesa(Request $request,Response $response, $args)
    {
        $id = $request->getAttribute('id_mesa');
        mesa::find($id)->update(["estado"=>"con cliente pagando"]);
        $request = $request->withAttribute('id_pedido',(mesa::select('id_pedido')->where('id',$id)->get())[0]->id_pedido);
        importeApi::EnviarUno($request,$response,$args);
        return $response->getBody()->write("Cobro realizado con exito");
    }
}
?>