<?php
namespace clases;
use clases\IApi;
use clases\VerificadorJWT;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\menu;

class menuApi
{

    public function TraerTodos(Request $request,Response $response,$args)
    {
        return (menu::all())->toJson();
    }

    public function EnviarUno(Request $request,Response $response,$args)
    {
        $menu = new menu();
        $menu->nombre = strtolower($request->getParsedBody()["nombre"]);
        $menu->tipo = strtolower($request->getParsedBody()["tipo"]);
        $menu->precio = $request->getParsedBody()["precio"];
        $menu->save();
        return $response->getBody()->write("Alimento agregado al menu exitosamente");
    }

    public function ModificarUno(Request $request,Response $response,$args)
    {
        $menu = $request->getAttribute('menu');
        $menu->nombre = $request->getParsedBody()["nombre"];
        $menu->tipo = $request->getParsedBody()["tipo"];
        $menu->precio = $request->getParsedBody()["precio"];
        $menu->save();
        return $response->getBody()->write("Alimento del menu modificado exitosamente");
    }

    public function BorrarUno(Request $request,Response $response,$args)
    {
        $menu = $request->getAttribute('menu');
        menu::destroy($menu->id);
        return $response->getBody()->write("Alimento eliminado del menu exitosamente");
    }
}

?>