<?php
require_once './accesoDatos.php';

class empleado
{
    public $id;
    public $nombre;
    public $pass;
    public $tipo;

    public static function TraerTodosEmpleados()
    {
        $acceso = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $acceso->RetornarConsulta('SELECT * FROM empleados');
        $consulta->execute();
        $empleados = $consulta->fetchAll(PDO::FETCH_CLASS,'empleado');
        return $empleados;
    }

    public static function TraerUnEmpleado($id)
    {
        $acceso = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $acceso->RetornarConsulta('SELECT * FROM empleados WHERE id = :id');
        $consulta->bindValue(':id',$id,PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetchObject('empleado');
    }

    public function EnviarUnEmpleado()
    {
        $acceso = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $acceso->RetornarConsulta('INSERT INTO empleados (nombre,pass,tipo) VALUES (:nombre,:pass,:tipo)');
        $consulta->bindValue(':nombre',$this->nombre,PDO::PARAM_STR);
        $consulta->bindValue(':pass',$this->pass,PDO::PARAM_STR);
        $consulta->bindValue(':tipo',$this->tipo,PDO::PARAM_STR);
        $consulta->execute();
        return $acceso->RetornarUltimoIdInsertado();
    }

    public function ModificarEmpleado()
    {
        $acceso = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $acceso->RetornarConsulta('UPDATE empleados SET nombre = :nombre, pass = :pass, tipo = :tipo WHERE :id = id');
        $consulta->bindValue(':nombre',$this->nombre,PDO::PARAM_STR);
        $consulta->bindValue(':pass',$this->pass,PDO::PARAM_STR);
        $consulta->bindValue(':tipo',$this->tipo,PDO::PARAM_STR);
        $consulta->bindValue(':id',$this->id,PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->rowCount();
    }

    public static function EliminarEmpleado($id)
    {
        $acceso = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $acceso->RetornarConsulta('DELETE FROM empleados WHERE :id = id');
        $consulta->bindValue(':id',$id,PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->rowCount();
    }

    public function ValidarEmpleadoExistenteLogin()
    {
        $empleados = self::TraerTodosEmpleados();
        foreach($empleados as $empleado)
        {
            if($empleado->nombre == $this->nombre && $empleado->pass == $this->pass)
            {
                return $empleado;
            }
        }
        return false;
    }

    public function ValidarEmpleadoExistenteAlta()
    {
        $empleados = self::TraerTodosEmpleados();
        foreach($empleados as $empleado)
        {
            if($empleado->nombre == $this->nombre && $empleado->tipo == $this->tipo)
            {
                return true;
            }
        }
        return false;
    }

    public static function ValidarIdExistente($id)
    {
        $empleados = empleado::TraerTodosEmpleados();
        foreach($empleados as $empleado)
        {
            if($empleado->id == $id)
            {
                return true;
            }
        }
        return false;
    }
}
?>