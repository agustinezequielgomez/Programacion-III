<?php
namespace clases;
use \App\Models\usuario;
use \App\Models\materia;
use \App\Models\inscripcion;
use clases\VerificadorJWT;
use Slim\Http\Request;
use Slim\Http\Response;
//require_once '../vendor/slim/slim/Slim/Http/Request.php';
require_once '../src/app/models/usuario.php';
require_once '../src/app/models/materia.php';
require_once '../src/app/models/inscripcion.php';


class MWParcial
{
    function MWLogin(Request $request,Response $response,$next)
    {
        $datos = $request->getParsedBody();
        $usuario = new usuario();
        $usuario->id = $datos['legajo'];
        $usuario->clave = $datos['clave'];
        $usuarioValidado = $usuario->ValidarUsuarioExistenteLogin();
        if($usuarioValidado!="clave"&&$usuarioValidado!="legajo")
        {
            $request = $request->withAttribute('usuario',$usuarioValidado);
            $response = $next($request,$response);
        }
        else if($usuarioValidado == "clave")
        {
            $response->getBody()->write("<br>La contraseña es incorrectos. Intentelo nuevamente");
        }
        else if($usuarioValidado == "legajo")
        {
            $response->getBody()->write("<br>El legajo es incorrectos. Intentelo nuevamente");
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
        if($request->getUri()->getPath()=='Materia/'&&$request->getMethod()=="POST"&&$data->tipo=="admin")
        {
            $response = $next($request,$response);
        }
        else if($request->getMethod()=="POST"&&$data->tipo=="alumno")
        {
            $response = $next($request,$response);
        }
        else
        {
            $response->getBody()->write("No posees las credenciales necesarias para estas acciones");
        }
        return $response;
    }

    function MWModificar(Request $request,Response $response,$next)
    {
        $route = $request->getAttribute('route');
        $legajostr = $route->getArguments('legajo');
        $legajo = intval($legajostr["legajo"]);
        $token = $request->getHeader('token')[0];
        $data = VerificadorJWT::TraerData($token);
        if($data->tipo == "alumno" && $data->legajo == $legajo)
        {
            $request = $request->withAttribute('switch',1);
            $request = $request->withAttribute('legajo',$legajo);
            $response = $next($request,$response);
        }
        else if($data->tipo == "profesor" && $data->legajo == $legajo)
        {
            if(materia::VerificarMateriaExistente($request->getParsedBody()))
            $request = $request->withAttribute('switch',2);
            $request = $request->withAttribute('legajo',$legajo);
            $response = $next($request,$response);
        }
        else if($data->tipo=="admin")
        {
            $request = $request->withAttribute('switch',3);
            $request = $request->withAttribute('legajo',$legajo);
            $response = $next($request,$response);
        }
        else
        {
            $response->getBody()->write("No sos admin. No podes modificar otro usuario que no sea el tuyo");
        }
        return $response;
    }

    function MWValidarLegajoExistenteGet(Request $request,Response $response,$next)
    {
        $legajo = ($request->getAttribute('route'))->getArgument('legajo');
        if(usuario::ValidarLegajoExistente($legajo)!=false) 
        {
            $response = $next($request,$response);
        }
        else
        {
            $response->getBody()->write("El usuario que busca no existe en la base de datos");
        }
        return $response;
    }

    function MWValidarAlta(Request $request,Response $response,$next)
    {
        echo "go";
        $atributos = $request->getParsedBody();
        $usuario = new usuario();
        $usuario->nombre = $atributos["nombre"];
        $usuario->clave = $atributos["clave"];
        $usuario->tipo = $atributos["tipo"];
        if($usuario->tipo != "alumno"&&$usuario->tipo != "profesor"&&$usuario->tipo != "admin")
        {
            $response->getBody()->write("El tipo de usuario que quiere dar de alta no es valido.");
        }
        else
        {
            $request = $request->withAttribute('usuario',$usuario);
            $response = $next($request,$response);
        }
        return $response;
    }

    function MWValidarMateria(Request $request,Response $response,$next)
    {
        $atributos = $request->getParsedBody();
        if($atributos["nombre"]!= "" && (materia::VerificarMateriaExistente($atributos["nombre"]))==true)
        {
            $response = $next($request,$response);
        }
        else
        {
            $response->getBody()->write("La materia ya existe en la base de datos.");
        }
        return $response;
    }

    function MWValidarCupo(Request $request,Response $response,$next)
    {
        $route = $request->getAttribute('route');
        $idMateriastr = $route->getArguments('idMateria');
        $idMateria = intval($idMateriastr["idMateria"]);
        if(inscripcion::validarCupo($idMateria)==true)
        {
            $request = $request->withAttribute('idMateria',$idMateria);
            $response = $next($request,$response);
        }
        else
        {
            $response->getBody()->write("No hay mas cupo para la materia");
        }
        return $response;
    }

    function MWValidarMateriaId(Request $request,Response $response,$next)
    {
        $route = $request->getAttribute('route');
        $idMateriastr = $route->getArguments('idMateria');
        $idMateria = intval($idMateriastr["idMateria"]);
        if(materia::VerificarMateriaExistenteId($idMateria)==true)
        {
            $response = $next($request,$response);
        }
        else
        {
            $response->getBody()->write("La materia a la que quiere inscribirse no existe");
        }
        return $response;
    }
}
?>