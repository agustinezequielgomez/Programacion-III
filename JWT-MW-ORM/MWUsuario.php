<?php

require './vendor/autoload.php';

class MWUsuario
{
    function verificarCredenciales($request, $response, $next)
    {
        $tipoEmpleado = $request-getParam('tipo');
        if($request->isGet()==true)
        {
            $response->getBody()->write("No son necesarias las credenciales para consultar la base de datos");
            $response = $next($request,$response);
        }
        else if($tipoEmpleado == 'admin' && $tipoEmpleado!=null)
        {
            $response->getBody()->write("Posee las credenciales necesarias para modificar la base de datos.");
            $response = $next($request,$response);
        }
        else
        {
            $response->getBody()->write("No posees las credenciales necesarias para acceder");
        }
        return $response;
    }

    function verificarUsuarioExistente($request,$response,$next)
    {
        $parametros = $request->getParsedBody();
        $user = new Usuario();
        $user->nombre = $parametros["nombre"];
        $user->pass = $parametros["pass"];
        if($user->ValidaUserExistente()==false)
        {
            $request = $request->withAttribute('usuario',$user);
            $response = $next($request,$response);
        }
        else
        {
            $response->getBody()->write("<br><br>El usuario ingresado ya existe en la base de datos");
        }
        return $response;
    }

    function verificaralta($request,$response,$next)
    {
        if($request->getUploadedFiles()!=null)
        {
            $response = $next($request,$response);
        }
        else
        {
            $response->getBody()->write("El usuario que se intenta ingresar no posee foto de perfil");
        }
        return $response;
    }

    function verificarIdExistenteNoGet($request,$response,$next)
    {
        $parametros = $request->getParsedBody();
        $user = new Usuario();
        $user->id = $parametros["id"];
        $user->nombre = $parametros["nombre"];
        $user->pass = $parametros["pass"];
        if(Usuario::ValidaIdExistente($user->id)==true)
        {
            $request = $request->withAttribute('usuario',$user);
            $response = $next($request,$response);
        }
        else
        {
            $response->getBody()->write("<br>El usuario que intenta borrar o modificar no existe en la base de datos");
        }
        return $response;
    }

    function verificarIdExistenteGet($request,$response,$next)
    {
        $id = ($request->getAttribute('route'))->getArgument('id');
        if(Usuario::ValidaIdExistente($id)==true)
        {
            $response = $next($request,$response);
        }
        else
        {
            $response->getBody()->write("<br>El usuario que busca no se encuentra en la base de datos");
        }
        return $response;
    }
}
?>