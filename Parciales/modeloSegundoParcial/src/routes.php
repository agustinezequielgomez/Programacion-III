<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use clases\usuarioApi;
use clases\compraApi;
use clases\VerificadorMW;
require_once '../src/clases/VerificadorMW.php';
require_once '../src/clases/usuarioApi.php';
require_once '../src/clases/compraApi.php';
return function (App $app) {
    $container = $app->getContainer();

    $app->group('/Usuario',function()
    {
        $this->post('/',usuarioApi::class.':Alta')->add(VerificadorMW::class.':VerificarAlta');
        $this->get('/',usuarioApi::class.':TraerTodos');
    })->add(VerificadorMW::class.':VerificarCredenciales')->add(VerificadorMW::class.':VerificarJWT')->add(VerificadorMW::class.':RegistrarApi');
    
    $app->group('/Compra',function()
    {
        $this->post('/',compraApi::class.':EfectuarCompra');
        $this->get('/',compraApi::class.':VerCompras');
    })->add(VerificadorMW::class.':VerificarJWT')->add(VerificadorMW::class.':RegistrarApi');

    $app->group('/Login',function()
    {
        $this->post('/',usuarioApi::class.':Login');
    })->add(VerificadorMW::class.':VerificarLogin')->add(VerificadorMW::class.':RegistrarApi');
};
