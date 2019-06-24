<?php
include_once "proveedor.php";
$proveedor = new Proveedor($_POST["id"],$_POST["nombre"],$_POST["email"]);
$proveedor->modificarProveedor("./proveedores.txt");
?>