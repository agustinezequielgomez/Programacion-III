<?php
include_once "pedidos.php";
Pedidos::listarPedidoProveedor("./pedidos.txt","./proveedores.txt",$_GET["idProveedor"]);
?>