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
                if(!empty($linea))
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
        move_uploaded_file($_FILES["foto"]["tmp_name"],$path);
        return $path;
    }
}
#endregion
}
?>