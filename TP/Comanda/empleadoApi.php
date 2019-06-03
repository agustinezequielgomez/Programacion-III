<?php
require_once './IApi.php';
require_once './Entidades/empleado.php';
require_once './VerificadorJWT.php';
class empleadoApi extends empleado implements IApi
{
    function TraerUno($request, $response, $args)
    {
        return $response->withJson(empleado::TraerUnEmpleado($args['id']),200);
    }

    function BorrarUno($request, $response, $args)
    {
        empleado::EliminarEmpleado($request->getAttribute('id'));
        $response->getBody()->write("Empleado eliminado exitosamente");
        return $response;
    }
    
    function EnviarUno($request, $response, $args)
    {
        $empleado = $request->getAttribute('empleado');
        $empleado->EnviarUnEmpleado();
        $response->getBody()->write("Empleado dado de alta exitosamente");
        return $response;
    }

    function ModificarUno($request, $response, $args)
    {
        $empleado = $request->getAttribute('empleado');
        $empleado->ModificarEmpleado();
        $response->getBody()->write("Empleado modificado exitosamente");
        return $response;
    }
    
    function TraerTodos($request, $response, $args)
    {
        return $response->withJson(empleado::TraerTodosEmpleados(),200);
    }

    function Login($request, $response, $args)
    {
        $empleado = $request->getAttribute('empleado');
        return $response->getBody()->write(VerificadorJWT::crearToken(["nombre"=>$empleado->nombre,"tipo"=>$empleado->tipo]));
    }
}
?>