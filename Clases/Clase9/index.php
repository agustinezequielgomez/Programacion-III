<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require './composer/vendor/autoload.php';
require './AccesoDatos.php';
require './usuarioApi.php';
require "./autenticadorMW.php";


$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

/*
¡La primera línea es la más importante! A su vez en el modo de 
desarrollo para obtener información sobre los errores
 (sin él, Slim por lo menos registrar los errores por lo que si está utilizando
  el construido en PHP webserver, entonces usted verá en la salida de la consola 
  que es útil).

  La segunda línea permite al servidor web establecer el encabezado Content-Length, 
  lo que hace que Slim se comporte de manera más predecible.
*/

$app = new \Slim\App(["settings" => $config]);

/*LLAMADA A METODOS DE INSTANCIA DE UNA CLASE*/
$app->group('/Usuario', function () {
 
  $this->get('/', \UsuarioApi::class . ':TraerTodos');
 
  $this->get('/{id}', \UsuarioApi::class . ':traerUno');

  $this->post('/', \UsuarioApi::class . ':CargarUno')->add(autenticadorMW::class . ':verificarUsuarioAlta');

  $this->delete('/', \UsuarioApi::class . ':BorrarUno');

  $this->put('/', \UsuarioApi::class . ':ModificarUno')->add(\autenticadorMW::class . ':verificarUsuarioExistente');
})->add(\autenticadorMW::class . ':verificarCredenciales');

$app->group('/Login',function(){
    $this->post('/', \UsuarioApi::class . ':LoginUsuario');
});

$app->run();