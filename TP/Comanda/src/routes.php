<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use clases\empleadoApi;
use clases\MWComanda;
use clases\logueosApi;
use clases\pedidoApi;
use clases\alimentoApi;
use clases\menuApi;
use clases\mesaApi;
use clases\rateApi;
use clases\consultasApi;

return function (App $app) {
    $container = $app->getContainer();

    $app->group('/Empleados',function()
    {
        $this->get('/',empleadoApi::class.':TraerTodos');
        $this->get('/{id}',empleadoApi::class.':TraerUno')->add(MWComanda::class.':MWValidarIdExistenteGet');
        $this->post('/',empleadoApi::class.':EnviarUno')->add(MWComanda::class.':MWValidarAlta');
        $this->put('/',empleadoApi::class.':ModificarUno')->add(MWComanda::class.':MWValidarAlta')->add(MWComanda::class.':MWValidarIdExistenteNoGet');
        $this->delete('/',empleadoApi::class.':BorrarUno')->add(MWComanda::class.':MWValidarIdExistenteNoGet');
        $this->put('/Suspender',empleadoApi::class.':SuspenderEmpleado')->add(MWComanda::class.':MWValidarIdExistenteNoGet');
        $this->put('/Activar',empleadoApi::class.':ActivarEmpleado')->add(MWComanda::class.':MWValidarIdExistenteNoGet');

    })->add(MWComanda::class.':MWVerificarCredenciales')->add(MWComanda::class.':MWVerificarToken');
    
    $app->group('/Login',function()
    {
        $this->post('/',empleadoApi::class.':Login')->add(MWComanda::class.':MWLogin');
    });

    $app->group('/Registros',function()
    {
        $this->get('/',logueosApi::class.':TraerTodos');
    })->add(MWComanda::class.':MWVerificarCredenciales')->add(MWComanda::class.':MWVerificarToken');

    $app->group('/Pedidos',function()
    {
        $this->get('/',pedidoApi::class.':TraerTodos');
        $this->get('/TiempoEstimado',pedidoApi::class.':ConsultarTiempoEstimado')->add(MWComanda::class.':MWValidarCodigoDePedidoExistente');
        $this->get('/{id}',pedidoApi::class.':TraerUno');
        $this->post('/',pedidoApi::class.':EnviarUno')->add(MWComanda::class.':MWValidarComidaExistente')->add(MWComanda::class.':MWValidarMesa');
        $this->delete('/',pedidoApi::class.':CancelarUno')->add(MWComanda::class.':MWValidarPedidoExistente');
        $this->put('/',pedidoApi::class.':entregarPedido')->add(MWComanda::class.':MWValidarEntregaPedido')->add(MWComanda::class.':MWValidarPedidoExistente');
    })->add(MWComanda::class.':MWVerificarCredenciales')->add(MWComanda::class.':MWVerificarToken');

    $app->group('/Alimentos',function()
    {
        $this->get('/',alimentoApi::class.':verAlimentos');
        $this->post('/',alimentoApi::class.':prepararAlimento')->add(MWComanda::class.':MWValidarPreparacionDeAlimento')->add(MWComanda::class.':MWValidarPedidoExistente');
        $this->put('/',alimentoApi::class.':terminarPreparacion')->add(MWComanda::class.':MWValidarAlimentosEnPreparacion');//->add(MWComanda::class.':MWValidarPedidoExistente');
    })->add(MWComanda::class.':MWVerificarCredenciales')->add(MWComanda::class.':MWVerificarToken');

    $app->group('/Menu',function()
    {
        $this->get('/',menuApi::class.':TraerTodos');
        $this->post('/',menuApi::class.':EnviarUno')->add(MWComanda::class.':MWValidarTipoAlimento');
        $this->put('/',menuApi::class.':ModificarUno')->add(MWComanda::class.':MWValidarTipoAlimento')->add(MWComanda::class.':MWValidarIdAlimentoMenu');
        $this->delete('/',menuApi::class.':BorrarUno')->add(MWComanda::class.':MWValidarIdAlimentoMenu');
    })->add(MWComanda::class.':MWVerificarCredenciales');

    $app->group('/Mesa',function()
    {
        $this->post('/',mesaApi::class.':EnviarUno');
        $this->post('/Cobro',mesaApi::class.':cobrarMesa')->add(MWComanda::class.':MWValidarMesa');
        $this->post('/Cierre',mesaApi::class.':cierreMesa')->add(MWComanda::class.':MWValidarMesa');
    })->add(MWComanda::class.':MWVerificarCredenciales')->add(MWComanda::class.':MWVerificarToken');

    $app->group('/Rate',function()
    {
        $this->post('/',rateApi::class.':EnviarPuntuacion')->add(MWComanda::class.':MWValidarPuntuaciones')->add(MWComanda::class.':MWValidarMesaRate');
    });

    $app->group('/Consultas',function()
    {
        $this->get('/Empleados',consultasApi::class.':ListarCantidadDeOperaciones');
        $this->get('/Pedidos',consultasApi::class.':ListarAlimentosVendidos');
        $this->get('/Mesas',consultasApi::class.':ListarMesas');
    })->add(MWComanda::class.':MWVerificarCredenciales')->add(MWComanda::class.':MWVerificarToken');
};
?>