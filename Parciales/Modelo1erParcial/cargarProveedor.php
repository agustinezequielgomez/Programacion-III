<?php
include_once "proveedor.php";
$proovedor = new Proveedor($_POST["id"],$_POST["nombre"],$_POST["email"]);
if((Proveedor::ValidarID($_POST["id"],"./proveedores.txt"))!=-1)
{
    $foto = $proovedor->GuardarFoto("./Fotos");
    $proovedor->foto = $foto;
    $proovedor->cargarProveedor("./proveedores.txt");
}
else
{
    echo "<br>El proveedor ya se encuentra en la base de datos";
}
?>