<?php
namespace clases;
use clases\VerificadorJWT;
use clases\IApi;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\materia;
require_once '../src/app/models/materia.php';
require_once '../src/Clases/VerificadorJWT.php';

class materiaApi
{
    static function altaMateria(Request $request, Response $response, $args)
    {
        $atributos = $request->getParsedBody();
        $materia = new materia();
        $materia->nombre = $atributos["nombre"];
        $materia->cuatrimestre = $atributos["cuatrimestre"];
        $materia->cupos = $atributos["cupos"];
        $materia->save();
        return $response->getBody()->write("<br>Materia dada de alta con exito");
    }

    static function verMaterias(Request $request, Response $response, $args)
    {
        $data = (VerificadorJWT::TraerData($request->getHeader('token')[0]));

        switch($data->tipo)
        {
            case "alumno":
            $materias = json_encode(materia::traerMateriasAlumno($data->legajo));
            return $response->getBody()->write($materias);
            break;

            case "profesor":
            $materias = json_encode(materia::verMateriasProfesor($data->legajo));
            return $response->getBody()->write($materias);
            break;

            case "admin":
            $materias = json_encode(materia::verMateriasAdmin());
            return $response->getBody()->write($materias);
            break;
        }
    }

}
?>