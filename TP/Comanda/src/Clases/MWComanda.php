<?php
namespace clases;
use \App\Models\empleado;
use \App\Models\logueo;
use clases\VerificadorJWT;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\alimento;
use App\Models\pedido;
use App\Models\menu;
use App\Models\mesa;

class MWComanda
{
    function MWLogin(Request $request,Response $response,$next)
    {
        $datos = $request->getParsedBody();
        $empleado = new empleado();
        $empleado->nombre = $datos['nombre'];
        $empleado->pass = $datos['pass'];
        $empleadoValidado = $empleado->ValidarEmpleadoExistenteLogin();
        if($empleadoValidado!=false)
        {
            if($empleadoValidado->estado!='Suspendido')
            {
                $request = $request->withAttribute('empleado',$empleadoValidado);
                $response = $next($request,$response);
            }
            else
            {
                $response->getBody()->write("<br>Login denegado. Su usuario esta suspendido.");
            }
        }
        else
        {
            $response->getBody()->write("<br>El usuario o contraseña son incorrectos. Intentelo nuevamente");
        }
        return $response;
    }

    function MWVerificarToken(Request $request,Response $response,$next)
    {
        if($request->getUri()->getPath()=='Pedidos/TiempoEstimado')
        {
            $response = $next($request,$response);
            return $response;
        }
        $token = $request->getHeader("token");
        try
        {
            VerificadorJWT::VerificarToken($token[0]);
            $response = $next($request,$response);
        }
        catch(\Exception $e)
        {
            $response->getBody()->write($e->getMessage());
        }
        return $response;
    }

    function MWVerificarCredenciales(Request $request,Response $response,$next)
    {
        if($request->getUri()->getPath()=='Pedidos/TiempoEstimado')
        {
            $response = $next($request,$response);
            return $response;
        }
        $token = $request->getHeader('token')[0];
        $data = VerificadorJWT::TraerData($token);
        switch($data->tipo)
        {
            case "administrador":
            if($request->getUri()->getPath()=='Empleados/'||$request->getUri()->getPath()=='Registros/'||$request->getUri()->getPath()=='Menu/' || $request->getUri()->getPath()=='Mesa/')
            {
                $response = $next($request,$response);
            }
            else
            {
                $response->getBody()->write("No posees las credenciales necesarias para estas acciones");
            }
            break;

            case "cocinero":
            case "bartender":
            case "cervecero":
            if($request->getUri()->getPath()=='Alimentos/')
            {
                $response = $next($request,$response);
            }
            else
            {
                $response->getBody()->write("No posees las credenciales necesarias para estas acciones");
            }
            break;

            case "mozo":
            if($request->getUri()->getPath()=='Pedidos/' && $request->getUri()->getPath()!='Pedidos/TiempoEstimado' || $request->getUri()->getPath()=='Mesa/Cobro')
            {
                $response = $next($request,$response);
            }
            else
            {
                $response->getBody()->write("No posees las credenciales necesarias para estas acciones");
            }
            break;

            case "socio":
            if($request->getUri()->getPath()=='Menu/'|| $request->getUri()->getPath()=='Pedidos/' && $request->getMethod()=="GET" || $request->getUri()->getPath()=='Mesa/')
            {
                $response = $next($request,$response);
            }
            else
            {
                $response->getBody()->write("No posees las credenciales necesarias para estas acciones");
            }
        }
        return $response;
    }

    function MWValidarIdExistenteGet(Request $request,Response $response,$next)
    {
        $id = ($request->getAttribute('route'))->getArgument('id');
        if(empleado::ValidarIdExistente($id)!=NULL)
        {
            $response = $next($request,$response);
        }
        else
        {
            $response->getBody()->write("El usuario que busca no existe en la base de datos");
        }
        return $response;
    }


    function MWValidarIdExistenteNoGet(Request $request,Response $response,$next)
    {
        $id = $request->getParsedBody()['id'];
        if(empleado::ValidarIdExistente($id)!=NULL)
        {
            $request = $request->withAttribute('id',$id);
            $response = $next($request,$response);
        }
        else
        {
            $response->getBody()->write("El usuario que quiere modificar o eliminar no existe en la base de datos");
        }
        return $response;
    }

    function MWValidarAlta(Request $request,Response $response,$next)
    {
        $atributos = $request->getParsedBody();
        $empleado = new empleado;
        if($request->isPut())
        {
            $empleado = empleado::find($atributos["id"]);
        }
        $empleado->nombre = $atributos["nombre"];
        $empleado->pass = $atributos["pass"];
        $empleado->tipo = $atributos["tipo"];
        if($empleado->tipo == "administrador"||$empleado->tipo == "bartender"||$empleado->tipo == "cervecero"||$empleado->tipo == "cocinero"||$empleado->tipo == "mozo"||$empleado->tipo == "socio")
        {
            if($empleado->ValidarEmpleadoExistenteAlta()==false)
            {
                $request = $request->withAttribute('empleado',$empleado);
                $response = $next($request,$response);
            }
            else
            {
                $response->getBody()->write("El tipo de empleado que quiere dar de alta ya existe en la base de datos");
            }
        }
        else
        {
            $response->getBody()->write("El tipo de empleado que quiere dar de alta no es valido");
        }
        return $response;
    }

    function MWValidarAlimentosEnPreparacion(Request $request,Response $response,$next)
    {
        $empleado = VerificadorJWT::TraerData($request->getHeader('token')[0]);
        if(alimento::where('id_empleado',$empleado->id)->count()>0)
        {
            $request = $request->withAttribute('empleado',$empleado);
            $response = $next($request,$response);
        }
        else
        {
            $response->getBody()->write("El empleado no tiene alimentos en preparacion");
        }
        return $response;
    }

    function MWValidarPedidoExistente(Request $request,Response $response,$next)
    {
        $id_pedido = $request->getParsedBody()['id_pedido'];
        if(pedido::where('id',$id_pedido)->count()>0)
        {
            $request = $request->withAttribute('id_pedido',$id_pedido);
            $response = $next($request,$response);
        }
        else
        {
            $response->getBody()->write("El pedido seleccionado no existe.");
        }
        return $response;
    }

    function MWValidarComidaExistente(Request $request,Response $response,$next)
    {
        $alimentos = pedido::procesarPedidos($request->getParsedBody());
        $alimentosValidados = menu::verificarAlimentoExistente($alimentos);
        if($alimentosValidados === true)
        {
            $response = $next($request,$response);
        }
        else
        {
            $response->getBody()->write("No se encontraron los siguientes alimentos en nuestro menu:<br>".json_encode($alimentosValidados));
        }
        return $response;
    }

    function MWValidarEntregaPedido(Request $request,Response $response,$next)
    {
        $id = $request->getAttribute('id_pedido');
        if((pedido::select('estado')->where('id',$id)->get())[0]->estado == "Listo para servir")
        {
            $response = $next($request,$response);
        }
        else if((pedido::select('estado')->where('id',$id)->get())[0]->estado == "Entregado")
        {
            return $response->getBody()->write('El pedido ya fue entregado');
        }
        else
        {
            return $response->getBody()->write('El pedido no esta listo para ser entregado');
        }
        return $response;
    }

    function MWValidarTipoAlimento(Request $request,Response $response,$next)
    {
        $tipo = $request->getParsedBody()["tipo"];
        if($tipo != "comida" && $tipo!="trago" && $tipo!="vino" && $tipo!="postre" && $tipo!="cerveza")
        {
            $response->getBody()->write("El tipo de alimento que queres guardar no es valido");
        } 
        else
        {
            $response = $next($request,$response);
        }
        return $response;
    }

    function MWValidarIdAlimentoMenu(Request $request,Response $response,$next)
    {
        $alimento = menu::find($request->getParsedBody()["id"]);
        if($alimento!=null)
        {
            $request = $request->withAttribute('menu',$alimento);
            $response = $next($request,$response);
        }
        else
        {
            $response->getBody()->write("El alimento del menu no existe");
        }
        return $response;
    }

    function MWValidarCodigoDePedidoExistente(Request $request,Response $response,$next)
    {
        $codigo_de_pedido = $request->getParam("codigo_de_pedido");
        $codgio_mesa = $request->getParam("codigo_mesa");
        if(((mesa::where('codigo_identificacion',$codgio_mesa))->count())>0)
        {
            $n_mesa = (mesa::select('id')->where('codigo_identificacion',$codgio_mesa)->get())[0]->id;
            if((pedido::where('n_mesa',$n_mesa)->where('codigo_pedido',$codigo_de_pedido)->count())>0)
            {
                $request = $request->withAttribute('pedido',pedido::where('n_mesa',$n_mesa)->where('codigo_pedido',$codigo_de_pedido)->first());
                $response = $next($request,$response);
            }
            else
            {
                $response->getBody()->write("El codigo de pedido ingresado no es correcto. Intentelo nuevamente");
            }

        }
        else
        {
            $response->getBody()->write("El codigo de mesa ingresado no es correcto. Intentelo nuevamente");
        }
        return $response;
    }

    function MWValidarPreparacionDeAlimento(Request $request,Response $response,$next)
    {
        $token = $request->getHeader('token')[0];
        $data = VerificadorJWT::TraerData($token);
        $id_pedido = $request->getParsedBody()['id_pedido'];
        if((alimento::where('id_empleado',$data->id)->where('estado','En preparacion')->count())==0)
        {
             $response = $next($request,$response);
        }
        else
        {
            $response->getBody()->write("Para poder preparar otro alimento, debes terminar de preparar el actual");
        }
        return $response;
    }

    function MWValidarMesa(Request $request,Response $response,$next)
    {
        $id_mesa = $request->getParsedBody()["n_mesa"];
        if(mesa::find($id_mesa)!=NULL)
        {
            if((mesa::find($id_mesa))->estado=="cerrada" && $request->getUri()->getPath()=='Pedidos/')
            {
                $response = $next($request,$response);
            }
            else if((mesa::find($id_mesa))->estado=="con cliente comiendo" && $request->getUri()->getPath()=='Mesa/Cobro')
            {
                $request = $request->withAttribute('id_mesa',$id_mesa);
                $response = $next($request,$response);
            }
            else
            {
                $response->getBody()->write("La mesa que selecciono esta ocupada");
            }
        }
        else
        {
            $response->getBody()->write("La mesa que selecciono no existe");
        }
        return $response;
    }

    function MWValidarMesaRate(Request $request,Response $response,$next)
    {
        $codigo_identificacion = $request->getParsedBody()["codigo_identificacion"];
        if((mesa::where('codigo_identificacion',$codigo_identificacion)->get())[0]!=NULL)
        {
            if((mesa::where('codigo_identificacion',$codigo_identificacion)->get())[0]->estado == "con cliente pagando")
            {
                $response = $next($request,$response);
            }
            else
            {
                $response->getBody()->write("Debe pagar el pedido para poder puntuar la mesa");
            }
        }
        else
        {
            $response->getBody()->write("el codigo de mesa ingresado no es correcto");
        }
        return $response;
    }

    function MWValidarPuntuaciones(Request $request,Response $response,$next)
    {
        $comentario = $request->getParsedBody()["comentario"];

        if(strlen($comentario)<=66)
        {
            if(($request->getParsedBody()["rate_mesa"] >= 0 && $request->getParsedBody()["rate_mesa"] <= 10) && ($request->getParsedBody()["rate_mozo"] >= 0 && $request->getParsedBody()["rate_mozo"] <= 10)&& ($request->getParsedBody()["rate_cocinero"] >= 0 && $request->getParsedBody()["rate_cocinero"] <= 10) && ($request->getParsedBody()["rate_restaurant"] >= 0 && $request->getParsedBody()["rate_restaurant"] <= 10))
            {
                $response = $next($request,$response);
            }
            else
            {
                $response->getBody()->write("Las puntuaciones deben estar entre 0 y 10");
            }
        }
        else
        {
            $response->getBody()->write("El comentario puede tener una longitud maxima de 66 caracteres");
        }
        return $response;
    }
    
}
?>