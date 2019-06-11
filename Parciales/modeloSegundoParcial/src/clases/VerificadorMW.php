<?php
namespace clases;
use App\Models\usuario;
use App\Models\registro;
use Slim\Http\Request;
use Slim\Http\Response;
require_once '../src/app/models/usuario.php';
require_once '../src/app/models/registro.php';
class VerificadorMW
{
    public static function VerificarLogin(Request $request,Response $response,$next)
    {
        $atributos = $request->getParsedBody();
        $usuario = new usuario();
        $usuario->nombre = $atributos["nombre"];
        $usuario->clave = $atributos["clave"];
        $usuario->sexo = $atributos["sexo"];
        if($usuario->VerificarUsuarioExistente()!=false)
        {
            $request = $request->withAttribute('usuario',$usuario->VerificarUsuarioExistente());
            $response = $next($request,$response);
        }
        else
        {
            $response->getBody()->write("\nEl nombre de usuario o contraseña no es correcto. Intentelo nuevamente");
        }
        return $response;
    }

    public static function VerificarJWT(Request $request,Response $response,$next)
    {
        $token = $request->getHeader('token')[0];
        try
        {
            VerificadorJWT::VerificarToken($token);
            $response = $next($request,$response);
        }
        catch(\Exception $e)
        {
            $response->getBody()->write($e->getMessage());
        }
        return $response;
    }

    public static function VerificarCredenciales(Request $request,Response $response,$next)
    {
        $token =$request->getHeader('token')[0];
        $payload = VerificadorJWT::TraerData($token);
        if($payload->perfil=="admin")
        {
            $response = $next($request,$response);
        }
        else
        {
            $response->getBody()->write("Hola");
        }
        return $response;
    }

    public static function VerificarAlta(Request $request,Response $response,$next)
    {
        $atributos = $request->getParsedBody();
        $usuario = new usuario();
        $usuario->nombre = $atributos["nombre"];
        $usuario->clave = $atributos["clave"];
        $usuario->sexo = $atributos["sexo"];
        $usuario->perfil = $atributos["perfil"];
        if($usuario->VerificarUsuarioExistente()==false)
        {
            $request = $request->withAttribute('usuario',$usuario);
            $response = $next($request,$response);
        }
        else
        {
            $response->getBody()->write("El usuario ya existe en la base de datos");
        }
        return $response;
    }

    public static function RegistrarApi(Request $request,Response $response,$next)
    {
        $registro = new registro();
        if($request->getUri()->getPath()=='Login/')
        {
            $username =$request->getParsedBody()["nombre"];
            $registro->nombre_usuario = $username;
        }
        else
        {
            $token = $request->getHeader('token')[0];
            $data = VerificadorJWT::TraerData($token);
            $registro->nombre_usuario = $data->nombre;
        }
        $registro->metodo = $request->getMethod();
        $registro->ruta = $request->getUri()->getPath();
        $registro->hora = getdate()[0];
        $registro->save();
        $response = $next($request,$response);
        return $response;
    }
}
?>