<?php
include_once "pedidos.php";
$pedido = new Pedidos($_POST["producto"],(int)$_POST["cantidad"],(int)$_POST["idProveedor"]);
$pedido->cargarPedido("./pedidos.txt","./proveedores.txt");
?>