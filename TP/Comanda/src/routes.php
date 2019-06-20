<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use clases\empleadoApi;
use clases\MWComanda;
use clases\logueosApi;
use clases\pedidoApi;
use clases\alimentoApi;

return function (App $app) {
    $container = $app->getContainer();

    $app->group('/Empleados',function()
    {
        $this->get('/',empleadoApi::class.':TraerTodos');
        $this->get('/{id}',empleadoApi::class.':TraerUno')->add(MWComanda::class.':MWValidarIdExistenteGet');
        $this->post('/',empleadoApi::class.':EnviarUno')->add(MWComanda::class.':MWValidarAlta');
        $this->put('/',empleadoApi::class.':ModificarUno')->add(MWComanda::class.':MWValidarAlta')->add(MWComanda::class.':MWValidarIdExistenteNoGet');
        $this->delete('/',empleadoApi::class.':BorrarUno')->add(MWComanda::class.':MWValidarIdExistenteNoGet');
    })->add(MWComanda::class.':MWVerificarCredenciales')->add(MWComanda::class.':MWVerificarToken');
    
    $app->group('/Login',function()
    {
        $this->post('/',empleadoApi::class.':Login')->add(MWComanda::class.':MWLogin');
    });

    $app->group('/Registros',function()
    {
        $this->get('/',logueosApi::class.':TraerTodos');
    })->add(MWComanda::class.':MWVerificarCredenciales');

    $app->group('/Pedidos',function()
    {
        $this->post('/',pedidoApi::class.':EnviarUno');
    });

    $app->group('/Alimentos',function()
    {
        $this->get('/',alimentoApi::class.':verAlimentos');
    });
};
?>