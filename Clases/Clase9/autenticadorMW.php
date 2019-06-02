<?php
require_once '../../Server/composer/vendor/autoload.php';
class autenticadorMW
{
    function verificarCredenciales($request, $response, $next)
    {
        $params = $request->getParam("cargo");
        if($request->isGet()&&$params=="cliente")
        {
            $response->getBody()->write("No posees las credenciales necesarias para acceder\n");
        }
        else
        {
            $response->getBody()->write("Posees las credenciales necesarias para ver la base de datos\n");
            $response = $next($request,$response);
        }
        return $response;
    }

    function verificarUsuarioExistente($request, $response, $next)
    {
        $ArrayDeParametros = $request->getParsedBody();
		$miusuario = new usuario();
		$miusuario->id = $ArrayDeParametros['id'];
		$miusuario->nombre = $ArrayDeParametros['nombre'];
        $miusuario->pass = $ArrayDeParametros['pass'];
        if($miusuario->ValidarID()==true)
        {
            $request = $request->withAttribute('usuario',$miusuario);
            $response = $next($request,$response);
        }
        else
        {
            $response->getBody()->write("El usuario que se intenta modificar no se encuentra en la base de datos");
        }
        return $response;
    }

    function verificarUsuarioAlta($request, $response, $next)
    {
        $ArrayDeParametros = $request->getParsedBody();
		//var_dump($ArrayDeParametros);
		$nombre = $ArrayDeParametros['nombre'];
		$password = $ArrayDeParametros['pass'];

		$miusuario = new usuario();
		$miusuario->nombre = $nombre;
		$miusuario->pass = $password;
		if ($miusuario->ValidaUser() == false && ($request->getUploadedFiles() != [])) 
		{
            $request = $request->withAttribute('usuario',$miusuario);
            $request = $request->withAttribute('nombre',$nombre);
            $response = $next($request,$response);
        }
        else
        {
            $response->getBody()->write("<br>El usuario que se intenta ingresar ya existe en la base de datos o no posee foto de perfil asociada<br>");
        }
        return $response;
    }
}
?>