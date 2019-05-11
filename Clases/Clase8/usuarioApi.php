<?php
require_once 'usuario.php';
require_once 'IApiUsable.php';

class UsuarioApi extends usuario implements IApiUsable
{
	public function TraerUno($request, $response, $args)
	{
		$id = $args['id'];
		$elusuario = usuario::TraerUnUsuario($id);
		$newResponse = $response->withJson($elusuario, 200);
		return $newResponse;
	}

	public function TraerTodos($request, $response, $args)
	{
		$todosLosusuarios = usuario::TraerTodoLosUsuarios();
		$newResponse = $response->withJson($todosLosusuarios, 200);
		return $newResponse;
	}

	public function CargarUno($request, $response, $args)
	{
		$ArrayDeParametros = $request->getParsedBody();
		//var_dump($ArrayDeParametros);
		$nombre = $ArrayDeParametros['nombre'];
		$password = $ArrayDeParametros['pass'];

		$miusuario = new usuario();
		$miusuario->nombre = $nombre;
		$miusuario->pass = $password;
		if ($miusuario->ValidaUser() == false && ($request->getUploadedFiles() != NULL)) 
		{
			$miusuario->InsertarElUsuarioParametros();
			$archivos = $request->getUploadedFiles();
			$destino = "./fotos/";
			/*var_dump($archivos);
			echo "<br>";
			var_dump($archivos['foto']);*/

			$nombreAnterior = $archivos['foto']->getClientFilename();
			$extension = explode(".", $nombreAnterior);
			//var_dump($nombreAnterior);
			$extension = array_reverse($extension);

			$archivos['foto']->moveTo($destino . $nombre . "." . $extension[0]);
			$response->getBody()->write("Se guardo el usuario");
		} 
		else 
		{
			$response->getBody()->write("El usuario ya existe en la base de datos");
		}


		return $response;
	}
	public function BorrarUno($request, $response, $args)
	{
		$ArrayDeParametros = $request->getParsedBody();
		//var_dump($ArrayDeParametros);
		$id = $ArrayDeParametros['id'];
		$usuario = new usuario();
		$usuario->id = $id;
		$cantidadDeBorrados = $usuario->BorrarUsuario();
		$objDelaRespuesta = new stdclass();
		$objDelaRespuesta->cantidad = $cantidadDeBorrados;
		if ($cantidadDeBorrados > 0) 
		{
			$objDelaRespuesta->resultado = "Usuario eliminado";
		} 
		else 
		{
			$objDelaRespuesta->resultado = "El usuario ingresado no se encuentra en la base de datos";
		}
		$newResponse = $response->withJson($objDelaRespuesta, 200);
		return $newResponse;
	}

	public function ModificarUno($request, $response, $args)
	{
		$ArrayDeParametros = $request->getParsedBody();
		//var_dump($ArrayDeParametros);    	
		//$response->getBody()->write("<h1>Modificar  uno</h1>");
		$miusuario = new usuario();
		$miusuario->id = $ArrayDeParametros['id'];
		$miusuario->nombre = $ArrayDeParametros['nombre'];
		$miusuario->pass = $ArrayDeParametros['pass'];
		if ($miusuario->ValidarID() == true) 
		{
			$resultado = $miusuario->ModificarUsuarioParametros();
			$objDelaRespuesta = new stdclass();
			//var_dump($resultado);
			$objDelaRespuesta->resultado = $resultado;
			return $response->withJson($objDelaRespuesta, 200);
		} 
		else 
		{
			$response->getBody()->write("\nEl usuario que se intenta modificar no existe en la base de datos");
		}
		return $response;
	}

	public function LoginUsuario($request, $response, $args)
	{
		//$response->getBody()->write("<h1>Modificar  uno</h1>");
		$ArrayDeParametros = $request->getParsedBody();
		//var_dump($ArrayDeParametros);    	
		$miusuario = new usuario();
		$miusuario->nombre = $ArrayDeParametros['nombre'];
		$miusuario->pass = $ArrayDeParametros['pass'];

		$resultado = $miusuario->ValidaUser();
		$objDelaRespuesta = new stdclass();
		//var_dump($resultado);
		$objDelaRespuesta->resultado = $resultado;
		return $response->withJson($objDelaRespuesta, 200);
	}
}
