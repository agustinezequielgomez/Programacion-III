<?php
namespace clases;
use clases\IApi;
use clases\VerificadorJWT;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\empleado;
use App\Models\logueo;

class empleadoApi implements IApi
{
    function TraerUno(Request $request,Response $response,$args)
    {
        return (empleado::find($args['id']))->toJson();
    }

    function BorrarUno(Request $request, Response $response, $args)
    {
        empleado::destroy($request->getAttribute('id'));
        $response->getBody()->write("Empleado eliminado exitosamente");
        return $response;
    }
    
    function EnviarUno(Request $request,Response $response, $args)
    {
        $empleado = $request->getAttribute('empleado');
        $empleado->estado = "Activo";
        $empleado->save();
        $response->getBody()->write("Empleado dado de alta exitosamente");
        return $response;
    }

    function ModificarUno(Request $request,Response $response, $args)
    {
        $empleado = $request->getAttribute('empleado');
        $empleado->save();
        $response->getBody()->write("Empleado modificado exitosamente");
        return $response;
    }
    
    function TraerTodos(Request $request,Response $response, $args)
    {
        return (empleado::all())->toJson();
    }

    function Login(Request $request,Response $response, $args)
    {
        $empleado = $request->getAttribute('empleado');
        logueo::crearLogueo($empleado);
        return $response->getBody()->write(VerificadorJWT::crearToken(["id"=>$empleado->id,"nombre"=>$empleado->nombre,"tipo"=>$empleado->tipo]));
    }

    function SuspenderEmpleado(Request $request,Response $response, $args)
    {
        empleado::where('id',$request->getAttribute('id'))->update(['estado'=>'Suspendido']);
        return $response->getBody()->write("Empleado supendido exitosamente");
    }

    function ActivarEmpleado(Request $request,Response $response, $args)
    {
        empleado::where('id',$request->getAttribute('id'))->update(['estado'=>'Activo']);
        return $response->getBody()->write("Empleado activado exitosamente");
    }
}
?>