<?php
class usuario
{
	public $id;
	public $nombre;
	public $pass;

	public function BorrarUsuario()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$consulta = $objetoAccesoDato->RetornarConsulta("
				delete 
				from usuarios 				
				WHERE id=:id");
		$consulta->bindValue(':id', $this->id, PDO::PARAM_INT);
		$consulta->execute();
		return $consulta->rowCount();
	}

	public function ModificarUsuario()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$consulta = $objetoAccesoDato->RetornarConsulta("
				update usuario s
				set nombre='$this->nombre',
				pass='$this->pass',
				WHERE id='$this->id'");
		return $consulta->execute();
	}


	public function InsertarElUsuario()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$consulta = $objetoAccesoDato->RetornarConsulta("INSERT into usuarios (Nombre,'pass')values('$this->nombre','$this->pass')");
		$consulta->execute();
		return $objetoAccesoDato->RetornarUltimoIdInsertado();
	}

	public function ModificarUsuarioParametros()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$consulta = $objetoAccesoDato->RetornarConsulta("
				update usuarios 
				set nombre=:nombre,
				pass=:pass
				WHERE id=:id");
		$consulta->bindValue(':id', $this->id, PDO::PARAM_INT);
		$consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
		$consulta->bindValue(':pass', $this->pass, PDO::PARAM_STR);
		return $consulta->execute();
	}

	public function InsertarElUsuarioParametros()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$consulta = $objetoAccesoDato->RetornarConsulta("INSERT into usuarios (nombre,pass)values(:nombre,:pass)");
		$consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
		$consulta->bindValue(':pass', $this->pass, PDO::PARAM_STR);
		$consulta->execute();
		return $objetoAccesoDato->RetornarUltimoIdInsertado();
	}
	public function GuardarUsuario()
	{

		if ($this->id > 0) {
			$this->ModificarCdParametros();
		} else {
			$this->InsertarElCdParametros();
		}
	}


	public static function TraerTodoLosUsuarios()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$consulta = $objetoAccesoDato->RetornarConsulta("select id , nombre , pass from usuarios");
		$consulta->execute();
		return $consulta->fetchAll(PDO::FETCH_CLASS, "usuario");
	}

	public static function TraerUnUsuario($id)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$consulta = $objetoAccesoDato->RetornarConsulta("select id, nombre, pass from usuarios WHERE ID = $id");
		$consulta->execute();
		$cdBuscado = $consulta->fetchObject('usuario');
		return $cdBuscado;
	}

	public function mostrarDatos()
	{
		return "Metodo mostar:" . $this->nombre . "  " . $this->pass . "  " . $this->id . "\n";
	}

	public static function mostrarTodos($datos)
	{
		var_dump($datos);
		$resultado = array();
		foreach ($datos as $dato) {
			array_push($resultado, $dato->mostrarDatos());
		}
		return $resultado;
	}

	public function ValidaUser()
	{
		$usuarios = usuario::TraerTodoLosUsuarios();
		foreach ($usuarios as $usuario) 
		{
			if ($usuario->nombre == $this->nombre && $usuario->pass == $this->pass) 
			{
				return true;
			}
		}
		return false;
	}

	public function ValidarID()
	{
		$usuarios = usuario::TraerTodoLosUsuarios();

		foreach ($usuarios as $usuario) 
		{
			if ($usuario->id == $this->id) 
			{
				return true;
			}
		}
		return false;
	}


}
