<?php

class Proveedor
{
#region Atributos
public $id;
public $nombre;
public $email;
public $foto;
#endregion

#region Constructor
public function __construct($id, $nombre, $email)
{
    $this->id = $id;
    $this->nombre = $nombre;
    $this->email = $email;
}
#endregion

#region Metodos
    public function cargarProveedor($dirFile)
    {
        if((Proveedor::ValidarID($this->id,$dirFile))!= -1)
        {
            if(file_exists($dirFile))
            {
                $resource = fopen($dirFile,"a");
                if(file_get_contents($dirFile) != "")
                {
                    fwrite($resource, "\r\n"."$this->id".","."$this->nombre".","."$this->email".","."$this->foto");
                }
                else
                {
                    fwrite($resource, "$this->id".","."$this->nombre".","."$this->email".","."$this->foto");
                }
            }
            else
            {
                $resource = fopen($dirFile,"w");
                fwrite($resource, "$this->id".","."$this->nombre".","."$this->email".","."$this->foto");
            }
            fclose($resource);
        }
        else
        {
            echo "<br>El Proveedor ingresado ya existe en la base de datos";
        }
        
    }

    public static function ValidarID($id, $dirFile)
    {
        $Proveedores = Proveedor::ConstruirProveedores($dirFile);
        if($Proveedores !=NULL)
        {
            foreach($Proveedores as $Proveedor)
            {
                if($Proveedor->id == $id)
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


    public static function ConstruirProveedores($dirFile)
    {
        $lineas = Proveedor::LeerArchivo($dirFile);
        $Proveedores = array();
        if($lineas !=NULL)
        {
            foreach($lineas as $linea)
            {
                if(!empty($linea)||$linea == "")
                {
                    $datos = explode(",",$linea);
                    $Proveedor = new Proveedor((int)$datos[0],$datos[1],$datos[2]);
                    $Proveedor->foto = $datos[3];
                    array_push($Proveedores,$Proveedor);
                }
            }
            return $Proveedores;
        }
    }

    public static function ConsultarProveedor($dirFile, $nombre)
    {
        $Proveedores = Proveedor::ConstruirProveedores($dirFile);
        $flag = false;
        if($Proveedores != NULL)
        {
            foreach($Proveedores as $Proveedor)
            {
                if($Proveedor->nombre == $nombre)
                {
                    $Proveedor->MostrarProveedor();
                    $flag = true;
                }
            }

            if($flag == false)
            {
                echo "No existe Proveedor ",$nombre;
            }
        }
    }

    public function MostrarProveedor()
    {
        echo "<br>ID: ",$this->id;
        echo "<br>Nombre: ",$this->nombre;
        echo "<br>Email: ",$this->email;
        echo "<br>Foto: ",$this->foto;
        echo "<br>";
    }

    public static function ProveedoresMostrar($dirFile)
    {
        $Proveedores = proveedor::ConstruirProveedores($dirFile);
        foreach($Proveedores as $Proveedor)
        {
            $Proveedor->MostrarProveedor();
        }
    }

    public function ModificarProveedor($dirFile)
    {
        $proveedores = Proveedor::ConstruirProveedores($dirFile);
        $indice = Proveedor::BuscarIndiceArray($proveedores,$this->id);
        if($indice != -1)
        {
            $proveedores[$indice]->GuardarFoto("./Fotos");
            $proveedores[$indice]->nombre = $_POST["nombre"];
            $proveedores[$indice]->email = $_POST["email"];
            Proveedor::VaciarArchivo($dirFile);
            foreach($proveedores as $proveedor)
            {
                $proveedor->cargarProveedor($dirFile);
            }
            $this->GuardarFoto("./Fotos");
        }
        else
        {
            echo "<br>El proveedor que intenta modificar no se encuentra en la base de datos";
        }
    }
#endregion

#region Foto
public function GuardarFoto($path)
{
    if(file_exists($_FILES["foto"]["tmp_name"]))
    {
        $nombreArchivo = "";
        $arrayNombre = explode(".",$_FILES["foto"]["name"]);
        $nombreArchivo .=  $this->id . $this->nombre . '.' . $arrayNombre[1];
        $path .= '/' . $nombreArchivo;
        if(file_exists($path))
        {
            $this->ReemplazarFoto("./backUpFotos",$path);
        }
        else
        {
            move_uploaded_file($_FILES["foto"]["tmp_name"],$path);
        }
        return $path;
    }
}

private function ReemplazarFoto($pathBackup,$FotoExistente)
{
    $nombreArchivo = "";
    $arrayNombre = explode(".",$FotoExistente);
    date_default_timezone_set('America/Argentina/Buenos_Aires'); //Seteo la zona horaria para que al imprimir la hora sea la hora local de argentina
    $fecha = date("d\-m\-y--H\.i\.s"); //Recibo la hora en formato diaMesAño-Hora.Minuto.Seugndo
    $nombreArchivo .= $this->id . "_" . $fecha . '.' . $arrayNombre[2]; //Creo el nombre del archivo con el Legajo, nombre, fecha y extension
    $pathBackup .= '/' . $nombreArchivo;        
    rename($FotoExistente,$pathBackup); //Muevo la foto a archivos Backup 
}

public static function FotoBack($dirFile,$proveedores)
{
    $archivos = scandir($dirFile);
    $proveedores = Proveedor::ConstruirProveedores($proveedores);
    foreach($archivos as $archivo)
    {
        $id = explode("_",$archivo);
        foreach($proveedores as $proveedor)
        {
            if($proveedor->id == $id[0])
            {
                $nombre = $proveedor->nombre;
                $fecha = explode("--",$id[1]);
                echo "<br>Nombre: ",$nombre;
                echo "<br>Fecha: ",$fecha[0];
            }
        }
    }
}
#endregion

private static function BuscarIndiceArray($proveedores, $id)
{
    $indice = -1;
    for($i = 0; $i < count($proveedores); $i++)
    {    
        if($proveedores[$i]->id == $id)
        {
            $indice = $i; 
        }
    }
    return $indice;
}

private static function VaciarArchivo($dirFile)
{
    if(file_exists($dirFile))
    {
        $resource = fopen($dirFile,"w");
        fclose($resource);   
    }
}
}
?>