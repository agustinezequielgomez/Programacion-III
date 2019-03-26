<?php
include_once "Persona.php";
class alumno extends Persona 
{
    public $legajo;

    public function __construct($Nombre, $Edad, $Dni, $Legajo)
    {
        parent::__construct($Nombre,$Edad,$Dni);
        $this->legajo = $Legajo;
    }

    public function ReturnJson()
    {
        return parent::ReturnJson(); //Escribe los metodos del hijo tambien solo invocando el padre porque el padre sabe sus hijos y encodea de igual manera los atributos del hijo
    }

    public function GuardarAlumno($dirFile)
    {
        if(file_exists($dirFile))
        {
            //resource es un valor que necesita el fwrite que inidca si se abrio o no el archivo. Es como el puntero a ese file
            $resource = fopen($dirFile,"a"); //a = agrega a un archivo ya existente
            fwrite($resource, "$this->Nombre".","."$this->Edad".","."$this->DNI".","."$this->legajo"."\r\n"); // "\r\n" para salto de linea
            fclose($resource);
        }
        else
        {
            $resource = fopen($dirFile,"w"); // w = Sobreescribe todo el archivo
            fwrite($resource, "$this->Nombre".","."$this->Edad".","."$this->DNI".","."$this->legajo"."\r\n"); // "$this->atributo" es lo mismo que $this->atruibto. El escribir las comillas o no no hace diferencia. Si fuera '$this->atributo' escribiria eso textualmente
            fclose($resource);
        }
    }

    public function GuardarJSON($dirFile)
    {
        if(file_exists($dirFile))
        {
            $resource = fopen($dirFile,"a");
            fwrite($resource, $this->ReturnJson()."\r\n");//Escribe lo que devuelve el JSON en el archivo
            fclose($resource);
        }
        else
        {
            $resource = fopen($dirFile,"w");
            fwrite($resource, $this->ReturnJson()."\r\n");
            fclose($resource);
        }
    }

    public static function MostrarAlumnos($dirFile) //Metodo estatico
    {
        if(file_exists($dirFile)) //Chequea si el archivo existe
        {
            $resource = fopen($dirFile,"r"); //Abro el archivo en modo lectura
            $vectorArchivo = array(); //Creo un array donde guardar las lineas del archivo
            do
            {
                array_push($vectorArchivo,fgets($resource)); //Agrego un objeto al final del array por cada linea de archivo leida

            }while(!feof($resource)); //Leo el archivo mientras no haya terminado
            return $vectorArchivo;
        }
        return false;
    }

    public static function BorrarAlumnoTxt($dirFile,$DNI)
    {
        //Traigo las lineas del archivo que contienen los alumnos volcados
        $arrayAlumnosArchivo = alumno::MostrarAlumnos($dirFile);
        $arrayDeAlumnos = array();
        if($arrayAlumnosArchivo!=false)
        {
            foreach($arrayAlumnosArchivo as $lineasArchivo)
            {
                if(!empty($lineasArchivo))
                {
                    $arrayAlumnoDatosSeparados = explode(",",$lineasArchivo); //Separo los datos de la linea en distintos substrings para poder crear los alumnos
                    $nuevoAlumno = new alumno($arrayAlumnoDatosSeparados[0],$arrayAlumnoDatosSeparados[1],$arrayAlumnoDatosSeparados[2],$arrayAlumnoDatosSeparados[3]); //Creo un nuevo alumno
                    array_push($arrayDeAlumnos,$nuevoAlumno); //Guardo el nuevo alumno en un array
                }
            }
        }

        //Filtro el array de alumnos para ver si el que quiero borrar aparece
        for($i = 0; $i < count($arrayDeAlumnos) ; $i++)
        {
            if($arrayDeAlumnos[$i]->DNI == $DNI) //Si algun elemento del array coincide con el DNI pasado por parametro
            {
                $cadenaReemplazada = str_replace($arrayAlumnosArchivo[$i],"",$arrayAlumnosArchivo); //Reemplazo donde estaba la linea coincidente en el archivo por espacio vacio
                file_put_contents($dirFile,$cadenaReemplazada); //Esa cadena reemplzada vuelvo a escribirla sobre el archivo.
            }
        }
    }

    public static function BorrarAlumnoJSON($dirFile, $DNI)
    {
        $arrayAlumnosArchivo = alumno::MostrarAlumnos($dirFile); //Pongo en el array de $alumnos los JSON (Un obj por indice)
        $arrayAlumnosVariable = array(); //Array que guarda variables sacadas del JSON
        foreach($arrayAlumnosArchivo as $JSONS)
        {
            array_push($arrayAlumnosVariable,json_decode($JSONS)); //Guardo en el array variables php creadas en base al JSON 
        }

        for($i = 0; $i < count($arrayAlumnosVariable); $i++)
        {
            if($arrayAlumnosVariable[$i]->DNI == $DNI)
            {
                $cadenaReemplazada = str_replace($arrayAlumnosArchivo[$i],"",$arrayAlumnosArchivo);
                file_put_contents($dirFile,$cadenaReemplazada);
            }
        }
    }
}
?>