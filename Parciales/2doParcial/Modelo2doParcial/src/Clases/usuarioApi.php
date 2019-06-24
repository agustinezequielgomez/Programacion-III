<?php
namespace clases;
use clases\VerificadorJWT;
use clases\IApi;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\usuario;

class usuarioApi
{
    public function TraerUno(Request $request,Response $response,$args)
    {
        $usuario = $request->getAttribute('usuario');
        return $response->getBody()->write(($request->getAttribute('usuario')->toJson()));
    }

    public function TraerSelectivo(Request $request,Response $response,$args)
    {
        $nivel = $request->getAttribute('nivel');
        echo $nivel;
        switch($nivel)
        {
            case "Gerente":
            return (usuario::select('id','legajo','email','sueldo','direccion','telefono','nivel')->get())->toJson();
            break;

            case "Encargado":
            return (usuario::select('id','legajo','email','direccion','telefono','nivel')->get())->toJson();
            break;

            case "Empleado":
            return (usuario::select('legajo','email')->get())->toJson();
            break;
        }
    }

    public function TraerTodos(Request $request,Response $response,$args)
    {
        return (usuario::all())->toJson();
    }

    public function EnviarUno(Request $request,Response $response,$args)
    {
        $usuario = $request->getAttribute('usuario');
        $usuario->save();
        return $response->getBody()->write("\nUsuario dado de alta con exito");
    }

    public function ModificarUno(Request $request,Response $response,$args)
    {

    }

    public function BorrarUno(Request $request,Response $response,$args)
    {

    }

    public function Login(Request $request,Response $response,$args)
    {
        $usuario = $request->getAttribute('usuario');
        return $response->getBody()->write(VerificadorJWT::crearToken(["legajo"=>$usuario->legajo,"id"=>$usuario->id,"nivel"=>$usuario->nivel]));
    }
}
?>