<?php
namespace clases;
use clases\IApi;
use clases\VerificadorJWT;
use Slim\Http\Request;
use Slim\Http\Response;
use \App\Model\registro;
class logueosApi implements IApi
{
    function TraerTodos(Request $request,Response $response,$args)
    {
        return (registro::all())->toJson();
    }
}
?>