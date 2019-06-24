<?php
include_once "proveedor.php";
class Pedidos
{
    #region Atributos
    public $cantidad;
    public $idProveedor;
    public $producto;
    #endregion

    #region Constructor
    public function __construct($producto, $cantidad, $idProveedor)
    {
        $this->cantidad =$cantidad;
        $this->idProveedor = $idProveedor;
        $this->producto = $producto;
    }
    #endregion

    #region Metodos
    public function cargarPedido($dirFile,$dirFileProveedor)
    {
        if((Proveedor::ValidarID($this->idProveedor,$dirFileProveedor))== -1)
        {
            if(file_exists($dirFile))
            {
                $resource = fopen($dirFile,"a");
                if(file_get_contents($dirFile) != "")
                {
                    fwrite($resource, "\r\n"."$this->cantidad".","."$this->idProveedor".","."$this->producto");
                }
                else
                {
                    fwrite($resource, "$this->cantidad".","."$this->idProveedor".","."$this->producto");
                }
            }
            else
            {
                $resource = fopen($dirFile,"w");
                fwrite($resource, "$this->cantidad".","."$this->idProveedor".","."$this->producto");
            }
            fclose($resource);
        }
        else
        {
            echo "<br>El Proveedor ingresado no existe en la base de datos";
        } 
    }

    public static function LeerArchivoPedidos($dirFile)
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


    public static function ConstruirPedidos($dirFile)
    {
        $lineas = Pedidos::LeerArchivoPedidos($dirFile);
        $Pedidos = array();
        if($lineas !=NULL)
        {
            foreach($lineas as $linea)
            {
                if(!empty($linea))
                {
                    $datos = explode(",",$linea);
                    $Pedido = new Pedidos($datos[2],(int)$datos[0],(int)$datos[1]);
                    array_push($Pedidos,$Pedido);
                }
            }
            return $Pedidos;
        }
    }

    public static function MostrarPedidos($dirFile,$dirFileProveedor)
    {
        $pedidos = Pedidos::ConstruirPedidos($dirFile);
        $proveedores = Proveedor::ConstruirProveedores($dirFileProveedor);
        foreach($pedidos as $pedido)
        {
            foreach($proveedores as $proveedor)
            {
                if($proveedor->id == $pedido->idProveedor)
                {
                    $pedido->ListarPedidos($proveedor->nombre);
                    echo "<br>Nombre del Proveedor: ",$proveedor->nombre;
                    echo "<br>";
                    break;
                }
            }
        }
    }

    public function ListarPedidos()
    {
        echo "<br><br>Producto: ",$this->producto;
        echo "<br>Cantidad: ",$this->cantidad;
        echo "<br>Id Proveedor: ",$this->idProveedor;
    }

    public static function listarPedidoProveedor($dirFilePedido,$dirFileProveedor,$id)
    {
        $pedidos = Pedidos::ConstruirPedidos($dirFilePedido);
        $proveedores = Proveedor::ConstruirProveedores($dirFileProveedor);
        $flag = false;
        foreach($proveedores as $proveedor)
        {
            if($proveedor->id == $id)
            {
                foreach($pedidos as $pedido)
                {
                    if($proveedor->id == $pedido->idProveedor)
                    {
                        $pedido->ListarPedidos();
                        $flag = true;
                    }
                }
                break;
            }
        }
        if(!($flag))
        {
            echo "<br>El proveedor ingresado no existe<br>";
        }
    }
    #endregion
}
?>