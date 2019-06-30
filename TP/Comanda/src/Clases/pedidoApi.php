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
        $id_pedido = $request->getAttribute("id_pedido");
        pedido::where('id',$id_pedido)->update(['estado'=>'Cancelado']);
        $request = $request->withAttribute('id_pedido',$id_pedido);
        alimentoApi::cancelarAlimentos($request,$response,$args);
        return $response->getBody()->write("Pedido cancelado exitosamente");
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
        $pedido->pedido_realizado = date('H:i:s');
        $pedido->save();
        alimento::cargarAlimentos($alimentos,$pedido);
        return $response->getBody()->write("\nPedido realizado con exito. Su codigo de pedido es: ".$pedido->codigo_pedido);
    }

    function ConsultarTiempoEstimado(Request $request,Response $response, $args)
    {
        $pedido = $request->getAttribute('pedido');
        $tiempo_estimado = \DateTime::createFromFormat('H:i:s',$pedido->tiempo_estimado);
        $ahora = \DateTime::createFromFormat('H:i:s',date('H:i:s'));
        if($pedido->tiempo_estimado == '00:00:00')
        {
            $response->getBody()->write("Su pedido aun no comenzo a prepararse");
        }
        else if($ahora<$tiempo_estimado)
        {
            $interval = $tiempo_estimado->diff($ahora);
            $response->getBody()->write("Faltan ".$interval->format('%i')." minutos para que tu pedido este listo!");
        }
        else
        {
            $response->getBody()->write("Tu pedido va a estar listo en breve!");
        }
        return $response;
    }
    
    static function actualizarEstadoPedido(Request $request, Response $response, $args)
    {
        $id = $request->getAttribute('id');
        $estado = $request->getAttribute('estado');
        $tiempo_estimado = $request->getAttribute('estimado');
        switch($estado)
        {
            case "En preparacion":
            if((pedido::select('estado')->where('id',$id)->get())[0]->estado!="En preparacion")
            {
                pedido::where('id',$id)->update(['estado'=>$estado,'pedido_en_preparacion'=>date('H:i:s'),'tiempo_estimado'=>$tiempo_estimado]);
            }
            else if(pedido::verificarEstimadoMaximo($id,$tiempo_estimado)==true)
            {
                pedido::where('id',$id)->update(['tiempo_estimado'=>$tiempo_estimado]);
            }
            break;

            case "Listo para servir":
            pedido::where('id',$id)->update(['estado'=>$estado,'pedido_listo_para_servir'=>date('H:i:s')]);
            break;
        }
    }

    function TraerTodos(Request $request,Response $response, $args)
    {
        return $response->getBody()->write((pedido::all())->toJson());
    }

    static function entregarPedido(Request $request,Response $response, $args)
    {
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $id = $request->getAttribute('id_pedido');
        if((pedido::select('estado')->where('id',$id)->get())[0]->estado == "Listo para servir")
        {
            pedido::where('id',$id)->update(["estado"=>"Entregado","pedido_entregado"=>date('H:i:s')]);
        }
        else if((pedido::select('estado')->where('id',$id)->get())[0]->estado == "Entregado")
        {
            return $response->getBody()->write('El pedido ya fue entregado');
        }
        else
        {
            return $response->getBody()->write('El pedido no esta listo para ser entregado');
        }
        return $response->getBody()->write("Pedido entregado con exito");
    }
}
?>