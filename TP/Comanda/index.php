<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
require '../../Server/composer/vendor/autoload.php';
require './empleadoApi.php';
require './MWComanda.php';

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;
$app = new \Slim\App(["settings"=>$config]);

$app->group('/Empleados',function()
{
    $this->get('/',\empleadoApi::class.':TraerTodos');
    $this->get('/{id}',\empleadoApi::class.':TraerUno')->add(\MWComanda::class.':MWValidarIdExistenteGet');
    $this->post('/',\empleadoApi::class.':EnviarUno')->add(\MWComanda::class.':MWValidarAlta');
    $this->put('/',\empleadoApi::class.':ModificarUno')->add(\MWComanda::class.':MWValidarAlta')->add(\MWComanda::class.':MWValidarIdExistenteNoGet');
    $this->delete('/',\empleadoApi::class.':BorrarUno')->add(\MWComanda::class.':MWValidarIdExistenteNoGet');
})->add(\MWComanda::class.':MWVerificarCredenciales')->add(\MWComanda::class.':MWVerificarToken');

$app->group('/Login',function()
{
    $this->post('/',\empleadoApi::class.':Login')->add(\MWComanda::class.':MWLogin');
});

$app->run();
?>