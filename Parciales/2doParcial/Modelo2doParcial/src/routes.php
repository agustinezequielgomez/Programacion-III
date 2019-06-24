<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use clases\usuarioApi;
use clases\MWUsuario;
use clases\ventaApi;
use clases\logueosApi;

return function (App $app) {
    $container = $app->getContainer();

    $app->group('/Usuario',function()
    {
        $this->get('/',usuarioApi::class.':TraerTodos')->add(MWUsuario::class.':MWVerificarCredenciales');
        $this->post('/',usuarioApi::class.':EnviarUno')->add(MWUsuario::class.':MWValidarAlta');
    });

    $app->group('/Venta',function()
    {
        $this->post('/',ventaApi::class.':VenderUno')->add(MWUsuario::class.':MWVerificarCredenciales');
    });

    $app->group('/Usuarios',function()
    {
        $this->get('/',usuarioApi::class.':TraerSelectivo')->add(MWUsuario::class.':MWVerificarCredenciales');
    });

    $app->group('/Login',function()
    {
        $this->post('/',usuarioApi::class.':Login')->add(MWUsuario::class.':loguearLogueo')->add(MWUsuario::class.':MWLogin');
    });

    $app->group('/logs',function()
    {
        $this->get('/{legajo}',logueosApi::class.':MostrarLogs')->add(MWUsuario::class.':MWVerificarCredenciales');
    });
};
?>