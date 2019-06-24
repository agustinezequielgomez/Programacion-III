<?php
include_once "vehiculo.php";
include_once "servicio.php";
class Turno
{
    public $patente;
    public $fecha;
    public $marca;
    public $modelo;
    public $precio;
    public $tipoServicio;

    public function __construct($patente, $fecha, $tipoServicio)
    {
        $this->patente = $patente;
        $this->fecha = $fecha;
        $this->tipoServicio = $tipoServicio;
    }

    public function CargarTurno($dirFile,$dirVehiculos,$dirServ)
    {
        $vehiculos = Vehiculo::ConstruirVehiculos($dirVehiculos);
        $servicios = Servicio::ConstruirServicio($dirServ);
        if($vehiculos != NULL && $servicios !=NULL)
        {
            foreach($vehiculos as $vehiuculo)
            {
                if($vehiuculo->patente == $this->patente)
                {
                    $this->marca = $vehiuculo->marca;
                    $this->modelo = $vehiuculo->modelo;
                    foreach($servicios as $servicio)
                    {
                        if($servicio->tipo == $this->tipoServicio)
                        {
                            $this->precio = $servicio->precio;
                            $this->sacarTurno($dirFile);
                        }
                    }
                }
            }
        }
    }

    public function sacarTurno($dirFile)
    {
        if(file_exists($dirFile))
        {
            $resource = fopen($dirFile,"a");
            if(file_get_contents($dirFile) != "")
            {
                fwrite($resource, "\r\n"."$this->patente".","."$this->fecha".","."$this->marca".","."$this->modelo".","."$this->tipoServicio".","."$this->precio");
            }
            else
            {
                fwrite($resource, "$this->patente".","."$this->fecha".","."$this->marca".","."$this->modelo".","."$this->tipoServicio".","."$this->precio");
            }
        }
        else
        {
            $resource = fopen($dirFile,"w");
            fwrite($resource, "$this->patente".","."$this->fecha".","."$this->marca".","."$this->modelo".","."$this->tipoServicio".","."$this->precio");
        }
        fclose($resource);
    }

    public static function LeerArchivo($dirFile)
    {
        if(file_exists($dirFile))
        {
            $resource = fopen($dirFile,"r");
            $vectorArchivo = array();
            do
            {
                array_push($vectorArchivo,fgets($resource));

            }while(!(feof($resource)));
            return $vectorArchivo;
        }
    }

    public static function Constructor($patente, $fecha, $marca, $modelo, $precio, $tipo)
    {
        $turno = new Turno($patente, $fecha, $tipo);
        $turno->marca= $marca;
        $turno->modelo = $modelo;
        $turno->precio = $precio;
        return $turno;
    }

    public static function ConstruirTurnos($dirFile)
    {
        $lineas = Turno::LeerArchivo($dirFile);
        $Turnos = array();
        if($lineas !=NULL)
        {
            foreach($lineas as $linea)
            {
                $datos = explode(",",$linea);
                $Turno = Turno::Constructor($datos[0],$datos[1],$datos[2],$datos[3],(int)$datos[5],$datos[4]);
                array_push($Turnos,$Turno);
            }
            return $Turnos;
        }
    }
    public function MostrarTurnos()
    {
        echo "Patente: ",$this->patente;
        echo "<br>Fecha: ",$this->fecha;
        echo "<br>Marca: ",$this->marca;
        echo "<br>Modelo: ",$this->modelo;
        echo "<br>Precio: ",$this->precio;
        echo "<br>Tipo de servicio: ",$this->tipoServicio,"<br><br>";
    }
    
    public static function Turnos($dirFile)
    {
        $Turnos = Turno::ConstruirTurnos($dirFile);
        if($Turnos != NULL)
        {
            foreach($Turnos as $turno)
            {
                $turno->MostrarTurnos();
            }
        }
    }

    public static function Inscripciones($dirFile,$dato)
    {
        $turnos = Turno::ConstruirTurnos($dirFile);
        $flag = false;
        foreach($turnos as $turno)
        {
            if(($turno->tipoServicio == $dato) || ($turno->fecha == $dato))
            {
                $turno->MostrarTurnos();
                $flag = true;
            }
        }

        if($flag == false)
        {
            echo "<br>La fecha (formato dia/mes) o tipo de servicio (10.000km/20.000km/50.000km) ingresada no es correcta<br>";
        }
    }
}

?>