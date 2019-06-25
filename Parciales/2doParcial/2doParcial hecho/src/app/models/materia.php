<?php
namespace App\Models;
use \App\Models\inscripcion;
use \App\Models\usuario;
require_once '../src/app/models/inscripcion.php';
require_once '../src/app/models/usuario.php';
class materia extends \Illuminate\Database\Eloquent\Model
{
    static function VerificarMateriaExistenteId($id)
    {
        $materias = materia::all();
        foreach($materias as $materiaDB)
        { 
            if($materiaDB->id == $id)
            {
                return true;
            }
        }
        return false;
    }

    static function traerMateriasAlumno($legajoAlumno)
    {
        $inscripciones = inscripcion::all();
        $materiasInscriptas=[];
        foreach($inscripciones as $inscripcion)
        {
            if($inscripcion->legajo_alumno == $legajoAlumno)
            {
                array_push($materiasInscriptas,$inscripcion->materia);
            }
        }
        if(empty($materiasInscriptas))
        {
            return "El alumno no esta inscripto a ninguna materia";
        }
        return $materiasInscriptas;
    }

    static function verMateriasProfesor($legajoProfesor)
    {
        $profesor = usuario::find($legajoProfesor);
        $materias = explode(',',$profesor->materias_dictadas);
        if(empty($materias))
        {
            return "El profesor no dicta materias";
        }
        return $materias;
    }

    static function verMateriasAdmin()
    {
        $materias = materia::all();
        $usuarios = usuario::all();
        $retorno = [];
        foreach($materias as $materia)
        {
            foreach($usuarios as $usuario)
            {
                if($usuario->tipo == "profesor")
                {
                    if($usuario->materias_dictadas == $materia->nombre)
                    {
                        array_push($retorno,["Materia"=>$materia->nombre,"profesor"=>$usuario->nombre]);
                    }
                }
            }
        }
        return $retorno;
    }

    static function VerificarMateriaExistente($materia)
    {
        $materias = materia::all();
        foreach($materias as $materiaDB)
        { 
            if($materiaDB->nombre == $materia)
            {
                return false;
            }
        }
        return true;
    }

    static function ValidarMateriaAnotarse($materias)
    {        
        $materiasDB = materia::all();
        foreach($materias as $materia)
        {
            foreach($materiasDB as $materiaDB)
            {
                if($materia == $materiaDB->nombre)
                {
                    return true;
                }
            }
        }
        return false;
    }
}
?>