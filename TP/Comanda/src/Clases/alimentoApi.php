<?php
namespace clases;
use clases\VerificadorJWT;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\alimento;
use clases\pedidoApi;
use App\Models\pedido;

class alimentoApi
{
    static function prepararAlimento(Request $request, Response $response, array $args) //Pasar alimento a "En preparacion"
    {
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $id_pedido = $request->getParsedBody()["id_pedido"];
        $empleado = VerificadorJWT::TraerData($request->getHeader('token')[0]);
        $alimentos = alimento::obtenerAlimentoBasadoEnPuesto($empleado->tipo);
        $tiempo_estimado = $request->getParsedBody()["tiempo_estimado"];
        $tiempo_estimado = alimento::calcularTiempoEstimado($empleado->tipo,$tiempo_estimado);
        foreach($alimentos as $alimento)
        {
            if($alimento->id_pedido == $id_pedido)
            {
                $alimento->update(["id_empleado" => $empleado->id,"estado"=>"En preparacion","tiempo_comienzo"=>date('H:i:s'),"tiempo_estimado"=>$tiempo_estimado]);
            }
        }
        $request = $request->withAttribute('id',$id_pedido);
        $request = $request->withAttribute('estado',"En preparacion");
        $request = $request->withAttribute('estimado',$tiempo_estimado);
        pedidoApi::actualizarEstadoPedido($request,$response,$args);
        return $response->getBody()->write("<br>Alimentos en preparacion");
    }

    static function terminarPreparacion(Request $request, Response $response, array $args)
    {
        $empleado = VerificadorJWT::TraerData($request->getHeader('token')[0]);
        $id_pedido = (alimento::select('id_pedido')->where('id_empleado',$empleado->id)->where('estado','En preparacion')->first())->id_pedido;
        alimento::where('id_empleado',$empleado->id)->where('estado','En preparacion')->update(['estado'=>"Listo para servir",'tiempo_final'=>date('H:i:s')]);
        if(alimento::verificarAlimentosListos($id_pedido)==true)
        {
            $request = $request->withAttribute('id',$id_pedido);
            $request = $request->withAttribute('estado',"Listo para servir");
            pedidoApi::actualizarEstadoPedido($request,$response,$args);
        }
        return $response->getBody()->write("<br>Alimento preparado");
    }

    static function cancelarAlimentos(Request $request, Response $response, array $args) //Pasar alimentos a "Cancelar"
    {
        alimento::where('id_pedido',$request->getAttribute('id_pedido'))->update(['estado'=>'Cancelado']);
    }

    function verAlimentos(Request $request, Response $response, array $args)
    {
        $token = $request->getHeader('token')[0];
        $puestoEmpleado = VerificadorJWT::TraerData($token)->tipo;
        $response->getBody()->write((alimento::obtenerAlimentoBasadoEnPuesto($puestoEmpleado))->toJson());
        return $response;
    }
}
?>