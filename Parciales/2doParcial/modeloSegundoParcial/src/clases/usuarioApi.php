<?php
namespace clases;
use App\Models\usuario;
use Slim\Http\Request;
use Slim\Http\Response;
use clases\VerificadorJWT;
require_once '../src/clases/VerificadorJWT.php';
class usuarioApi
{
    public function Login(Request $request, Response $response, array $args)
    {
        $usuario = $request->getAttribute('usuario');
        return $response->getBody()->write(VerificadorJWT::crearToken(["id"=>$usuario->id,"nombre"=>$usuario->nombre,"sexo"=>$usuario->sexo,"perfil"=>$usuario->perfil]));
    }

    public function Alta(Request $request, Response $response, array $args)
    {
        $usuario = $request->getAttribute('usuario');
        $usuario->save();
        return $response->getBody()->write("\nUsuario dado de alta con exito");
    }

    public function TraerTodos(Request $request, Response $response, array $args)
    {
        return (usuario::all())->toJson();
    }
}
?>