<?php
namespace clases;
use clases\VerificadorJWT;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\alimento;

class alimentoApi
{
    static function prepararAlimento(Request $request, Response $response, array $args)
    {
        $token = $request->getHeader('token')[0];

    }

    static function verAlimentos(Request $request, Response $response, array $args)
    {
        $token = $request->getHeader('token')[0];
        $puestoEmpleado = VerificadorJWT::TraerData($token)->tipo;
        echo $puestoEmpleado;
        $alimento = new alimento();
        $respuesta;
        switch($puestoEmpleado)
        {
            case "bartender":
            $respuesta = $alimento->where('tipo','vino')->get();
            $response->getBody()->write($respuesta->toJson());
            break;

            case "cerveceros":
            $respuesta = $alimento->where('tipo','=','cerveza');
            $response->getBody()->write($respuesta->toJson());
            break;

            case "cocineros":
            $response->getBody()->write(($alimento->where('tipo','=','comida')->orWhere('tipo','=','postre'))->toJson());
            break;

            case "socios":
            $response->getBody()->write(($alimento::all())->toJson());
            break;
        }
        return $response;
    }
}
?>