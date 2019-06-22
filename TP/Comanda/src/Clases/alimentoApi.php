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
        $empleado = VerificadorJWT::TraerData($request->getHeader('token')[0]);
        $alimentos = alimento::obtenerAlimentoBasadoEnPuesto($empleado->tipo);
        $tiempo_estimado = alimento::calcularTiempoEstimado($empleado->tipo);
        foreach($alimentos as $alimento)
        {
            if($alimento->id_pedido == $id_pedido)
            {
                $alimento->id_empleado = $empleado->id;
                $alimento->estado = "En preparacion";
                $alimento->tiempo_comienzo = date('H:i:s');
                $alimento->tiempo_estimado = $tiempo_estimado;
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
        alimento::where('id_pedido',$request->getAttribute('id_pedido'))->update(['estado'=>'Cancelado']);
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