<?php
class Servicio
{
    #region Atributos
    public $id;
    public $tipo;
    public $precio;
    public $demora;
    #endregion

    #region Constructor
    public function __construct($id, $tipo,  $precio, $demora)
    {
        $this->id = $id;
        $this->tipo = $tipo;
        $this->precio = $precio;
        $this->demora = $demora;
    }
    #endregion

    #region Metodos
    public function cargarServicio($dirFile)
    {
        if(file_exists($dirFile))
        {
            $resource = fopen($dirFile,"a");
            if(file_get_contents($dirFile) != "")
            {
                fwrite($resource, "\r\n"."$this->id".","."$this->tipo".","."$this->precio".",".trim($this->demora,"\r\n"));
            }
            else
            {
                fwrite($resource, "$this->id".","."$this->tipo".","."$this->precio".",".trim($this->demora,"\r\n"));
            }
        }
        else
        {
            $resource = fopen($dirFile,"w");
            fwrite($resource, "$this->id".","."$this->tipo".","."$this->precio".",".trim($this->demora,"\r\n"));
        }
        fclose($resource);
    }

    public static function ValidarServicios($servicio)
    {
        if($servicio == "10.000km"||$servicio == "20.000km"|| $servicio == "50.000km")
        {
            return 0;
        }
        return -1;
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


    public static function ConstruirServicio($dirFile)
    {
        $lineas = Servicio::LeerArchivo($dirFile);
        $Servicios = array();
        if($lineas !=NULL)
        {
            foreach($lineas as $linea)
            {
                $datos = explode(",",$linea);
                $Servicio = new Servicio((int)$datos[0],$datos[1],(int)$datos[2],$datos[3]);
                array_push($Servicios,$Servicio);
            }
            return $Servicios;
        }
    }

    public function MostrarServicio()
    {
        echo "ID: ",$this->id;
        echo "<br>Tipo: ",$this->tipo;
        echo "<br>Precio: ",$this->precio;
        echo "<br>Demora: ",$this->demora,"<br><br>";
    }


    #endregion
} 
?>