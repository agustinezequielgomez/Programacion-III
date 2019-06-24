<?php
namespace clases;
use \App\Models\empleado;
use \App\Models\logueo;
use clases\VerificadorJWT;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\usuario;

class MWUsuario
{
    function MWLogin(Request $request,Response $response,$next)
    {
        $datos = $request->getParsedBody();
        $usuario = new usuario();
        $usuario->legajo = $datos['legajo'];
        $usuario->clave = $datos['clave'];
        $usuarioValidado = usuario::validarLogin($usuario->legajo,$usuario->clave);
        if($usuarioValidado!="contraseña" && $usuarioValidado!="legajo")
        {
            $request = $request->withAttribute('usuario',$usuarioValidado);
            $response = $next($request,$response);
        }
        else if($usuarioValidado == "contraseña")
        {
            $response->getBody()->write("<br>La contraseña es incorrecta. Intentelo nuevamente");
        }
        else if($usuarioValidado == "legajo")
        {
            $response->getBody()->write("<br>El legajo es incorrecto. Intentelo nuevamente");
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
        if($request->getUri()->getPath()=='Usuarios/' && $request->getMethod()=='GET')
        {
            $request = $request->withAttribute('nivel',$data->nivel);
            $response = $next($request,$response);
        }
        else if($request->getUri()->getPath()=='Usuario/' && $request->getMethod()=='GET'&&$data->nivel=="Gerente"||$data->nivel=="Encargado")
        {
            $response = $next($request,$response);
        }
        else if($request->getUri()->getPath()=='Venta/' && $request->getMethod()=='POST'&&$data->nivel=="Empleado"||$data->nivel=="Encargado")
        {
            $response = $next($request,$response);
        }
        else if($request->getUri()->getPath()=='logs/' && $request->getMethod()=='GET'&&$data->nivel=="Encargado")
        {
            $response = $next($request,$response);
        }
        else
        {
            $response->getBody()->write("<br>Acceso prohibido");
        }
        return $response;
    }

    function MWValidarAlta(Request $request,Response $response,$next)
    {
        $atributos = $request->getParsedBody();
        $usuario = new usuario();
        $usuario->legajo = $atributos["legajo"];
        $usuario->email = $atributos["email"];
        $usuario->clave = $atributos["clave"];
        $usuario->sueldo = $atributos["sueldo"];
        $usuario->direccion = $atributos["direccion"];
        $usuario->telefono = $atributos["telefono"];

        if($usuario->validarAlta($usuario->legajo,$usuario->email)!=false)
        {
            if($usuario->legajo>900&&$usuario->legajo<=1000)
            {
                $usuario->nivel = "Gerente";
                $request = $request->withAttribute('usuario',$usuario);
                $response = $next($request,$response);
            }
            else if($usuario->legajo>700&&$usuario->legajo<=900)
            {
                $usuario->nivel = "Encargado";
                $request = $request->withAttribute('usuario',$usuario);
                $response = $next($request,$response);
            }
            else if($usuario->legajo>0&&$usuario->legajo<=700)
            {
                $usuario->nivel = "Empleado";
                $request = $request->withAttribute('usuario',$usuario);
                $response = $next($request,$response);
            }
            else
            {
                $response->getBody()->write("El legajo ingresado no se encuentra entre los rangos solicitados");
            }
        }
        else
        {
            $response->getBody()->write("El usuario que quiere dar de alta ya existe en la base de datos");
        }
        return $response;
    }

    function loguearLogueo(Request $request,Response $response,$next)
    {
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $usuario = $request->getAttribute('usuario');
        $logueo = new logueo();
        $logueo->legajo = $usuario->legajo;
        $logueo->email = $usuario->email;
        $logueo->hora = date('H:i:s');
        $logueo->save();
        $response = $next($request,$response);
        return $response;
    }
}
?>