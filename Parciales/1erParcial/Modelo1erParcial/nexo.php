<?php
$metodo = $_GET["caso"];
switch($metodo)
{
    case 'cargarProveedor':
    include_once "cargarProveedor.php";
    break;

    case 'consultarProveedor':
    include_once "consultarProveedor.php";
    break;

    case 'proveedores':
    include_once "proveedorMostrar.php";
    break;

    case 'hacerPedido':
    include_once "hacerPedido.php";
    break;

    case 'listarPedidos':
    include_once "listarPedidos.php";
    break;

    case 'listarPedidoProveedor':
    include_once "listarPedidoProveedor.php";
    break;

    case 'modificarProveedor':
    include_once "modificarProveedor.php";
    break;

    case 'fotosBack':
    include_once "fotosBack.php";
    break;
}
?>