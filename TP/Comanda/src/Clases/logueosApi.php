<?php
namespace clases;
use clases\IApi;
use clases\VerificadorJWT;
use Slim\Http\Request;
use Slim\Http\Response;
use \App\Models\logueo;
class logueosApi implements IApi
{
    function TraerTodos(Request $request,Response $response,$args)
    {
        return (logueo::all())->toJson();
    }

    function TraerUno(\Slim\Http\Request $request, \Slim\Http\Response $response, $args)
    {
        
    }

    function EnviarUno(\Slim\Http\Request $request, \Slim\Http\Response $response, $args)
    {
        
    }

    function ModificarUno(\Slim\Http\Request $request, \Slim\Http\Response $response, $args)
    {
        
    }

    function BorrarUno(\Slim\Http\Request $request, \Slim\Http\Response $response, $args)
    {
        
    }
}
?>