<?php
namespace clases;
use \App\Models\empleado;
use \App\Models\logueo;
use clases\VerificadorJWT;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\alimento;
use App\Models\pedido;

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
        $token = $request->getHeader('token')[0];
        $data = VerificadorJWT::TraerData($token);
        switch($data->tipo)
        {
            case "administrador":
            if($request->getUri()->getPath()=='Empleados/'||$request->getUri()->getPath()=='Registros/')
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
            if($request->getUri()->getPath()=='Pedidos/')
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
}
?>