<?php
include_once "proveedor.php";
proveedor::ConsultarProveedor("./proveedores.txt",$_GET["nombre"]);
?>