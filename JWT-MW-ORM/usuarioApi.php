<?php

require './IApi.php';
require './usuario.php';
require './VerificadorJWT.php';

class UsuarioApi extends Usuario implements IApi
{
    function traerTodos($request, $response, $args)
    {
        return $response->withJson(Usuario::traerUsuarios(),200);   
    }

    function traerUno($request, $response, $args)
    {
        $respuesta = Usuario::traerUnUsuario($args["id"]);
        return $response->withJson($respuesta,200);
    }

    function cargarUno($request, $response, $args)
    {
        $user = $request->getAttribute('usuario');
        $user->enviarUnUsuario();

        $archivos = $request->getUploadedFiles();
        $nombre = $archivos["foto"]->getClientFileName();
        $extension = explode(".",$nombre);
        $extension = array_reverse($extension);

        $archivos["foto"]->moveTo("./fotos/".$user->nombre.'.'.$extension[0]);
        $response->getBody()->write("El usuario se guardo exitosamente");
        return $response;
    }

    function modificarUno($request, $response, $args)
    {
        $user = $request->getAttribute('usuario');
        if($user->modificarUsuario()>0)
        {
            $response->getBody()->write("El usuario se modifico exitosamente");
        }
        else
        {
            $response->getBody()->write("No fue posible modificar el usuario");
        }
        return $response;
    }

    function borrarUno($request, $response, $args)
    {
        $user = $request->getAttribute('usuario');
        if($user->borrarUsuario($user->id)>0)
        {
            $response->getBody()->write("El usuario se elimino exitosamente");
        }
        else
        {
            $response->getBody()->write("No fue posible eliminar el usuario");
        }
        return $response;
    }

    function loginUsuario($request,$response,$args)
    {
        $user = $request->getAttribute('user');
        $response->getBody()->write(VerificadorJWT::CrearToken(["nombre"=>$user->nombre,'pass'=>$user->pass]));
        echo VerificadorJWT::aud();
        return $response;
    }
}
?>