<?php
namespace clases;
use Slim\Http\Request;
use Slim\Http\Response;
interface IApi
{
    public function TraerUno(Request $request,Response $response,$args);
    public function TraerTodos(Request $request,Response $response,$args);
    public function EnviarUno(Request $request,Response $response,$args);
    public function ModificarUno(Request $request,Response $response,$args);
    public function BorrarUno(Request $request,Response $response,$args);
}
?>