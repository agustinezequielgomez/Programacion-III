<?php
namespace clases;
use clases\VerificadorJWT;
use clases\IApi;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\usuario;
require_once '../src/app/models/usuario.php';
require_once '../src/Clases/VerificadorJWT.php';

class usuarioApi
{
    static function altaUsuario(Request $request, Response $response, $args)
    {
        $usuario = $request->getAttribute('usuario');
        $usuario->save();
        return $response->getBody()->write("<br>Usuario dado de alta con exito");
    }

    static function modificarUsuario(Request $request, Response $response, $args)
    {
        $legajo = $request->getAttribute('legajo');
        $switch = $request->getAttribute('switch');
        $atributos = $request->getParsedBody();
        $usuario = usuario::find($legajo);
        switch($switch)
        {
            case 1:
            $usuario->email = $atributos["email"];
            $usuario->foto = usuario::subirFoto($request->getUploadedFiles(),'../files/fotos/',$usuario);
            $usuario->save();
            break;

            case 2:
            $usuario->email = $atributos["email"];
            $usuario->materias_dictadas = $atributos["materias"];
            $usuario->save();
            break;

            case 3:
            $usuario->email = $atributos["email"];
            $usuario->materias_dictadas = $atributos["materias"];
            $usuario->foto = usuario::subirFoto($request->getUploadedFiles(),'../files/fotos/',$usuario);
            $usuario->save();
            break;
        }
        $usuario->save();
        return $response->getBody()->write("<br>Usuario modificado con exito");
    }

    static function Login(Request $request, Response $response, $args)
    {
        $usuario = $request->getAttribute('usuario');
        return VerificadorJWT::crearToken(["nombre"=>$usuario->nombre,"legajo"=>$usuario->id,"tipo"=>$usuario->tipo]);
    }
}
?>