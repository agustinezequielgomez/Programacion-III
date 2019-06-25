<?php
namespace App\Models;

class inscripcion extends \Illuminate\Database\Eloquent\Model
{
    static function validarCupo($idMateria)
    {
        $inscripciones = inscripcion::all();
        $inscriptos = 0;
        $materia = materia::find($idMateria);
        foreach($inscripciones as $inscripcion)
        {
            if($inscripcion->id_materia == $materia->id)
            {
                $inscriptos++;
            }
        }

        if($inscriptos+1<=$materia->cupos)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
?>