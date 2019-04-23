<?php
include_once "proveedor.php";
$proovedor = new Proveedor($_POST["id"],$_POST["nombre"],$_POST["email"]);
$foto = $proovedor->GuardarFoto("./Fotos");
$proovedor->foto = $foto;
$proovedor->cargarProveedor("./proveedores.txt");
?>