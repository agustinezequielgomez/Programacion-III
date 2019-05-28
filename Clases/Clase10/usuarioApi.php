<?php
require_once 'usuario.php';
require_once 'IApiUsable.php';
require './vendor/autoload.php';
require './AutentificadorJWT.php';
use Firebase\JWT\JWT;


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
		$miusuario = $request->getAttribute('usuario');
		$nombre = $request->getAttribute('nombre');
		$miusuario->InsertarElUsuarioParametros();
		$archivos = $request->getUploadedFiles();
		$destino = "./fotos/";
		$nombreAnterior = $archivos['foto']->getClientFilename();
		$extension = explode(".", $nombreAnterior);
		$extension = array_reverse($extension);

		$archivos['foto']->moveTo($destino . $nombre . "." . $extension[0]);
		$response->getBody()->write("Se guardo el usuario");
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
		$miusuario = $request->getAttribute('usuario');
		$resultado = $miusuario->ModificarUsuarioParametros();
		$objDelaRespuesta = new stdclass();
		$objDelaRespuesta->resultado = $resultado;
		return $response->withJson($objDelaRespuesta, 200);
	}

	public function LoginUsuario($request, $response, $args)
	{
		$ArrayDeParametros = $request->getParsedBody();
		$miusuario = new usuario();
		$miusuario->nombre = $ArrayDeParametros['nombre'];
		$miusuario->pass = $ArrayDeParametros['pass'];

		$datos = ["nombre"=>$miusuario->nombre];
		if($miusuario->ValidaUser()==true)
		{
			$token = \AutentificadorJWT::crearToken($datos);
			$response = $response->getBody()->write($token);
	}
}
