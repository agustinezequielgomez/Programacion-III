<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require './vendor/autoload.php';
require './usuarioApi.php';
require './MWUsuario.php';

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$app = new \Slim\App(["settings"=>$config]);

$app->group("/Usuario",function()
{
    $this->get('/', \UsuarioApi::class . ':traerTodos');
    $this->get('/{id}', \UsuarioApi::class . ':traerUno')->add(\MWUsuario::class.':verificarIdExistenteGet');
    $this->post('/', \UsuarioApi::class .':cargarUno')->add(\MWUsuario::class.':verificarUsuarioExistente')->add(\MWUsuario::class.':verificaralta');
    $this->put('/',\UsuarioApi::class .':modificarUno')->add(\MWUsuario::class.':verificarIdExistenteNoGet');
    $this->delete('/',\UsuarioApi::class .':borrarUno')->add(\MWUsuario::class.':verificarIdExistenteNoGet');

})->add(\MWUsuario::class.':validarJWT');

$app->group("/Login",function()
{
    $this->post('/',\UsuarioApi::class.':loginUsuario')->add(\MWUsuario::class.':LoginUser');
});

$app->run();
?>