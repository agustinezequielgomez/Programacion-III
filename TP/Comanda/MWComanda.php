<?php
require_once '../../Server/composer/vendor/autoload.php';
require_once './Entidades/empleado.php';
require_once './VerificadorJWT.php';

class MWComanda
{
    function MWLogin($request,$response,$next)
    {
        $datos = $request->getParsedBody();
        $empleado = new empleado();
        $empleado->nombre = $datos['nombre'];
        $empleado->pass = $datos['pass'];
        if($empleado->ValidarEmpleadoExistenteLogin()!=false)
        {
            $request = $request->withAttribute('empleado',$empleado->ValidarEmpleadoExistenteLogin());
            $response = $next($request,$response);
        }
        else
        {
            $response->getBody()->write("<br>El usuario o contraseña son incorrectos. Intentelo nuevamente");
        }
        return $response;
    }

    function MWVerificarToken($request,$response,$next)
    {
        $token = $request->getHeader("token");
        try
        {
            VerificadorJWT::VerificarToken($token[0]);
            $response = $next($request,$response);
        }
        catch(Exception $e)
        {
            $response->getBody()->write($e->getMessage());
        }
        return $response;
    }

    function MWVerificarCredenciales($request,$response,$next)
    {
        $token = $request->getHeader('token')[0];
        $data = VerificadorJWT::TraerData($token);
        if($data->tipo=="administrador")
        {
            $response = $next($request,$response);
        }
        else
        {
            $response->getBody()->write("No posees las credenciales necesarias para estas acciones");
        }
        return $response;
    }

    function MWValidarIdExistenteGet($request,$response,$next)
    {
        $id = ($request->getAttribute('route'))->getArgument('id');
        if(empleado::ValidarIdExistente($id))
        {
            $response = $next($request,$response);
        }
        else
        {
            $response->getBody()->write("El usuario que busca no existe en la base de datos");
        }
        return $response;
    }


    function MWValidarIdExistenteNoGet($request,$response,$next)
    {
        $id = $request->getParsedBody()['id'];
        if(empleado::ValidarIdExistente($id))
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

    function MWValidarAlta($request,$response,$next)
    {
        $atributos = $request->getParsedBody();
        $empleado = new empleado;
        $empleado->nombre = $atributos["nombre"];
        $empleado->pass = $atributos["pass"];
        $empleado->tipo = $atributos["tipo"];
        if($request->isPut())
        {
            $empleado->id = $atributos["id"];
        }
        if($empleado->tipo == "administrador"||$empleado->tipo == "bartender"||$empleado->tipo == "cerveceros"||$empleado->tipo == "cocineros"||$empleado->tipo == "mozos"||$empleado->tipo == "socios")
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
}
?>