<?php
class Vehiculo
{
    #region Atributos
    public $marca;
    public $modelo;
    public $patente;
    public $precio;
    #endregion

    #region Constructor
    public function __construct($marca, $modelo, $patente, $precio)
    {
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->patente = $patente;
        $this->precio = $precio;
    }
    #endregion

    #region Metodos
    public function cargarVehiculo($dirFile)
    {
        if(file_exists($dirFile))
        {
            $resource = fopen($dirFile,"a");
            if(file_get_contents($dirFile) != "")
            {
                fwrite($resource, "\r\n"."$this->marca".","."$this->modelo".","."$this->patente".",".trim($this->precio,"\r\n"));
            }
            else
            {
                fwrite($resource, "$this->marca".","."$this->modelo".","."$this->patente".",".trim($this->precio,"\r\n"));
            }
        }
        else
        {
            $resource = fopen($dirFile,"w");
            fwrite($resource, "$this->marca".","."$this->modelo".","."$this->patente".",".trim($this->precio,"\r\n"));
        }
        fclose($resource);
    }

    public static function ValidarPatente($patente, $dirFile)
    {
        $Vehiculos = Vehiculo::ConstruirVehiculos($dirFile);
        if($Vehiculos !=NULL)
        {
            foreach($Vehiculos as $Vehiculo)
            {
                if($Vehiculo->patente == $patente)
                {
                  return -1;  
                }
            }
        }
        return 0;
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


    public static function ConstruirVehiculos($dirFile)
    {
        $lineas = Vehiculo::LeerArchivo($dirFile);
        $Vehiculos = array();
        if($lineas !=NULL)
        {
            foreach($lineas as $linea)
            {
                $datos = explode(",",$linea);
                $Vehiculo = new Vehiculo($datos[0],$datos[1],$datos[2],(int)$datos[3]);
                array_push($Vehiculos,$Vehiculo);
            }
            return $Vehiculos;
        }
    }

    public function MostrarVehiculo()
    {
        echo "Marca: ",$this->marca;
        echo "<br>Modelo: ",$this->modelo;
        echo "<br>Patente: ",$this->patente;
        echo "<br>Precio: ",$this->precio,"<br><br>";
    }

    public static function consultarVehiculo($dato,$dirFile)
    {
        $vehiculos = Vehiculo::ConstruirVehiculos($dirFile);
        $flag = false;
        foreach($vehiculos as $vehiculo)
        {
            if((strcasecmp($vehiculo->patente,$dato)==0) || (strcasecmp($vehiculo->modelo,$dato)==0) || (strcasecmp($vehiculo->marca,$dato)==0))
            {
                $vehiculo->MostrarVehiculo();
                $flag = true;
            }
        }

        if($flag == false)
        {
            echo "<br>No existe ",$dato;
        }
    }


    public function GuardarFoto($path)
{
    if(file_exists($_FILES["foto"]["tmp_name"]))
    {
        $nombreArchivo = "";
        $arrayNombre = explode(".",$_FILES["foto"]["name"]);
        $nombreArchivo .=  $this->patente .'.' . $arrayNombre[1];
        $path .= '/' . $nombreArchivo;
        if(file_exists($path))
        {
            $this->ReemplazarFoto("./backUpFotos",$path);
        }
        else
        {
            $this->PonerMarcaDeAgua($_FILES["foto"]["tmp_name"],$path);
        }
        return $path;
    }
}

private function ReemplazarFoto($pathBackup,$FotoExistente)
{
    $nombreArchivo = "";
    $arrayNombre = explode(".",$FotoExistente);
    date_default_timezone_set('America/Argentina/Buenos_Aires'); //Seteo la zona horaria para que al imprimir la hora sea la hora local de argentina
    $fecha = date("d\-m\-y--H\.i\.s"); //Recibo la hora en formato dia-Mes-Año--Hora.Minuto.Seugndo
    $nombreArchivo .= $this->patente . "_" . $fecha . '.' . $arrayNombre[2]; //Creo el nombre del archivo con el Legajo, nombre, fecha y extension
    $pathBackup .= '/' . $nombreArchivo;        
    rename($FotoExistente,$pathBackup); //Muevo la foto a archivos Backup 
}

private function PonerMarcaDeAgua($archivo,$path)
{
    $marca = imagecreatefrompng('./Fotos/md_5aff6089d3e02.png');
    $imagen = imagecreatefromjpeg($archivo);

    $margenDerecho = 10; 
    $margenIzquierdo = 10; 
    $marcax = imagesx($marca); 
    $marcay = imagesy($marca); 

    imagecopy($imagen, $marca, imagesx($imagen) - $marcax - $margenDerecho, imagesy($imagen) - $marcay - $margenIzquierdo,0,0,$marcax,$marcay);
    imagepng($imagen,$path);
}

public function ModificarVehiculo($dirFile)
{
    $vehiculos = Vehiculo::ConstruirVehiculos($dirFile);
    $indice = Vehiculo::BuscarIndiceArray($vehiculos,$this->patente);
    if($indice != -1)
    {
        $vehiculos[$indice]->marca = $this->marca;
        $vehiculos[$indice]->modelo = $this->modelo;
        $vehiculos[$indice]->precio = $this->precio;
        $this->GuardarFoto("./Fotos");
        Vehiculo::VaciarArchivo($dirFile);
        foreach($vehiculos as $Vehiculo)
        {
            $Vehiculo->cargarVehiculo($dirFile);
        }
    }
    else
    {
        echo "<br>El Vehiculo que intenta modificar no se encuentra en la base de datos";
    }
}

private static function VaciarArchivo($dirFile)
{
    if(file_exists($dirFile))
    {
        $resource = fopen($dirFile,"w");
        fclose($resource);   
    }
}

private static function BuscarIndiceArray($vehiculos, $patente)
{
    $indice = -1;
    for($i = 0; $i < count($vehiculos); $i++)
    {    
        if($vehiculos[$i]->patente == $patente)
        {
            $indice = $i; 
        }
    }
    return $indice;
}

public function BuscarFoto()
{
    $fotos = scandir("./fotos");
    foreach($fotos as $foto)
    {
        $patente = explode(".jpg",$foto);
        if($patente[0] == $this->patente)
        {
            return $foto;
        }
    }
}

public static function Vehiculos($dirFile)
{
    $vehiculos = Vehiculo::ConstruirVehiculos($dirFile);
    $datos = array();
    foreach($vehiculos as $vehiculo)
    {
        $patente = $vehiculo->BuscarFoto();
        array_push($datos,("\r\n<tr><td>"."$vehiculo->marca"."</td><td>"."$vehiculo->modelo"."</td><td>"."$vehiculo->precio"."</td><td>"."$vehiculo->patente"."</td><td><img src=./fotos/"."$patente"."></td></tr>"));
    }
    $resource = fopen("./index.html","w");
    fwrite($resource,"<!DOCTYPE html>
    <html lang="."en".">
    <head>
        <meta charset="."UTF-8".">
        <meta name="."viewport"." content="."width=device-width, initial-scale=1.0".">
        <meta http-equiv="."X-UA-Compatible"." content="."ie=edge".">
        <title>Document</title>
    </head>
    <body>
        <table border=1px>
        <tr>
        <td>Marca</td><td>Modelo</td><td>Precio</td><td><td>Patente<td><td>Foto<td>
        <tr>");

        foreach($datos as $dato)
        {
            fwrite($resource,$dato);
        }
        fwrite($resource,"
        </table> 
    </body>
    </html>");
    fclose($resource);
}
    #endregion
}
?>