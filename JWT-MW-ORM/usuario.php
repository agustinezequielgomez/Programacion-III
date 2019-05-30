<?php
require './AccesoDatos.php';
class Usuario
{
    public $id;
    public $nombre;
    public $pass;
    
    public static function traerUsuarios()
    {
        $accesoADatos = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $accesoADatos->RetornarConsulta('SELECT * FROM usuarios');
        $consulta->execute();
        $usuarios = $consulta->fetchAll(PDO::FETCH_CLASS,'Usuario');
        return $usuarios;
    }

    public static function traerUnUsuario($id)
    {
        $accesoADatos = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $accesoADatos->RetornarConsulta('SELECT * FROM usuarios WHERE id = :id');
        $consulta->bindValue(':id',$id,PDO::PARAM_INT,);
        $consulta->execute();
        $usuario = $consulta->fetchObject('Usuario');
        return $usuario;
    }

    public function enviarUnUsuario()
    {
        $accesoADatos = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $accesoADatos->RetornarConsulta('INSERT INTO usuarios (nombre,pass) VALUES (:nombre, :pass)');
        $consulta->bindValue(':nombre',$this->nombre,PDO::PARAM_STR);
        $consulta->bindValue(':pass',$this->pass,PDO::PARAM_STR);
        $consulta->execute();
        return $accesoADatos->RetornarUltimoIdInsertado();  
    }

    public function modificarUsuario()
    {
        $accesoADatos = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $accesoADatos->RetornarConsulta('UPDATE usuarios SET nombre=:nombre,pass=:pass WHERE id = :id');
        $consulta->bindValue(':id',$this->id,PDO::PARAM_INT);
        $consulta->bindValue(':nombre',$this->nombre,PDO::PARAM_STR);
        $consulta->bindValue(':pass',$this->pass,PDO::PARAM_STR);
        $consulta->execute();
        return $consulta->rowCount();
    }

    public function borrarUsuario($id)
    {
        $accesoADatos = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $accesoADatos->RetornarConsulta("DELETE FROM usuarios WHERE id = :id");
        $consulta->bindValue(':id',$id,PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->rowCount();
    }

    public function ValidaUserExistente()
    {
        $usuarios = Usuario::traerUsuarios();
        foreach($usuarios as $usuario)
        {
            if($usuario->nombre == $this->nombre && $usuario->pass == $this->pass)
            {
                return true;
            }
        }
        return false;
    }

    public static function ValidaIdExistente($id)
    {
        $usuarios = Usuario::traerUsuarios();
        foreach($usuarios as $usuario)
        {            
            if($usuario->id == $id)
            {
                return true;
            }
        }
        return false;
    }
}
?>