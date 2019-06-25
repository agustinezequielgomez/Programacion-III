<?php
namespace clases;
use clases\VerificadorJWT;
use clases\IApi;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\inscripcion;
use App\Models\materia;
require_once '../src/app/models/inscripcion.php';
require_once '../src/app/models/materia.php';
require_once '../src/Clases/VerificadorJWT.php';

class inscripcionApi
{
    function inscribirse(Request $request, Response $response, $args)
    {
        $legajoAlumno = VerificadorJWT::TraerData($request->getHeader('token')[0])->legajo;
        $id = $request->getAttribute('idMateria');
        $materia = materia::find($id);
        $inscripcion = new inscripcion();
        $inscripcion->legajo_alumno = $legajoAlumno;
        $inscripcion->materia = $materia->nombre;
        $inscripcion->id_materia = $materia->id;
        $inscripcion->save();
        return $response->getBody()->write("Alumno inscripto satisfactoriamente");
    }
}
?>