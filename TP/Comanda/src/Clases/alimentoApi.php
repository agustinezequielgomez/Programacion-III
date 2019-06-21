<?php
namespace clases;
use clases\VerificadorJWT;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\alimento;
use clases\pedidoApi;

class alimentoApi
{
    static function prepararAlimento(Request $request, Response $response, array $args) //Pasar alimento a "En preparacion"
    {
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $id_pedido = $request->getParsedBody()["id_pedido"];
        $minutos_estimados = $request->getParsedBody()["tiempo_estimado"];
        $empleado = VerificadorJWT::TraerData($request->getHeader('token')[0]);
        $alimentos = alimento::obtenerAlimentoBasadoEnPuesto($empleado->tipo);
        foreach($alimentos as $alimento)
        {
            if($alimento->id_pedido == $id_pedido)
            {
                $alimento->id_empleado = $empleado->id;
                $alimento->estado = "En preparacion";
                $alimento->tiempo_comienzo = date('H:i:s');
                $alimento->tiempo_estimado = date_add(date_create('now'),$minutos_estimados.'M');
                $alimento->save();
            }
        }
        $request = $request->withAttribute('id',$id_pedido);
        $request = $request->withAttribute('estado',"En preparacion");
        pedidoApi::actualizarEstadoPedido($request,$response,$args);
        return $response->getBody()->write("\nPedido en preparacion");
    }

    static function cancelarAlimentos(Request $request, Response $response, array $args) //Pasar alimentos a "Cancelar"
    {
        $alimento = new alimento();
        $idPedido = $request->getAttribute('id_pedido');
        $alimentos = $alimento->where('id_pedido',$idPedido)->get();
        foreach($alimentos as $alimento)
        {
            $alimento->estado = "Cancelado";
            $alimento->save();
        }
    }

    function verAlimentos(Request $request, Response $response, array $args)
    {
        $token = $request->getHeader('token')[0];
        $puestoEmpleado = VerificadorJWT::TraerData($token)->tipo;
        $alimento = new alimento();
        $response->getBody()->write((alimento::obtenerAlimentoBasadoEnPuesto($puestoEmpleado))->toJson());
        return $response;
    }


}
?>