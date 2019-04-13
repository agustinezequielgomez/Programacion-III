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

#region TXT
//----------------------------------------------------------------------------------TXT--------------------------------------------------------------------------------------\\
    //Guardo un alumno en un txt. Si existe el salto de linea va al principio. Si no existe no lleva salto de linea
    public function GuardarAlumnoTxt($dirFile)
    {
        if(file_exists($dirFile))
        {
            //resource es un valor que necesita el fwrite que inidca si se abrio o no el archivo. Es como el puntero a ese file
            $resource = fopen($dirFile,"a"); //a = agrega a un archivo ya existente
            fwrite($resource, "\r\n"."$this->Nombre".","."$this->Edad".","."$this->DNI".","."$this->legajo"); // "\r\n" para salto de linea
            fclose($resource);
        }
        else
        {
            $resource = fopen($dirFile,"w"); // w = Sobreescribe todo el archivo
            fwrite($resource, "$this->Nombre".","."$this->Edad".","."$this->DNI".","."$this->legajo"); // "$this->atributo" es lo mismo que $this->atruibto. El escribir las comillas o no no hace diferencia. Si fuera '$this->atributo' escribiria eso textualmente
            fclose($resource);
        }
    }

    //Elimina el archivo y lo guarda otra vez con todos los alumnos desde un array en memoria. Se guardan de manera individual en un TXT
    public static function GuardarTodosTxt($dirFile, $alumnos) 
    {
        alumno::VaciarArchivo($dirFile);
        foreach($alumnos as $alumno)
        {
            $alumno->GuardarAlumnoTxt($dirFile);
        }
    }

    //Trae las lineas de texto de manera individual (c/linea como elemento de un array) de un archivo TXT que contiene los alumnos
    public static function MostrarAlumnosTxt($dirFile) //Metodo estatico
    {
        if(file_exists($dirFile)) //Chequea si el archivo existe
        {
            $resource = fopen($dirFile,"r"); //Abro el archivo en modo lectura
            $vectorArchivo = array(); //Creo un array donde guardar las lineas del archivo
            do
            {
                array_push($vectorArchivo,fgets($resource)); //Agrego un objeto al final del array por cada linea de archivo leida

            }while(!(feof($resource))); //Leo el archivo mientras no haya terminado
            return $vectorArchivo;
        }
        //return false;
    }

    //Crea variables Alumno en base a las lineas leidas de un archivo de texto y retorna esos alumnos en un array
    public static function TraerAMemoriaTxt($dirFile)
    {
        $lineas = alumno::MostrarAlumnosTxt($dirFile); //Guardo en un array las lineas del archivo
        $alumnos = array();
        foreach($lineas as $linea)
        {
            if(!empty($linea))
            {
                $datos = explode(",",$linea); //Por cada linea no vacia parseo los datos que contiene
                array_push($alumnos,new alumno($datos[0],(int)$datos[1],(int)$datos[2],(int)$datos[3])); //Guardo en un array esos alumnos creados con los datos parseados
            }
        }
        return $alumnos;
    }

    //Toma los Alumnos construidos en memoria, filtra cual tiene que sacar del array, y en base a ese array con el elemento ya sacado se reescribe el archivo
    public static function BorrarAlumnoTxt($dirFile)
    {
        $alumnos = alumno::TraerAMemoriaTxt($dirFile);
        alumno::GuardarTodosTxt($dirFile,alumno::BorrarRegistro($alumnos)); //Borro el archivo y lo reescribo con el array restante en memoria
    }

    public static function ModificarAlumnoTxt($dirFile)
    {
        $alumnos = alumno::TraerAMemoriaTxt($dirFile);
        $indice = alumno::BuscarIndiceArray($alumnos); //Busco el indice del alumno que coincida con el DNI pasado por $_GET
        //Leo que se va a modificar
        switch($_GET["Opcion"])  
        {
            case 1:
            if($indice != -1)
            {
                $alumnos[$indice]->Nombre = $_GET["Nombre"];
                alumno::GuardarTodosTxt($dirFile,$alumnos);
            }
            else
            {
                echo "El DNI pasado no existe en la base de datos";
            }
            break;

            case 2:
            $indice = alumno::BuscarIndiceArray($alumnos);
            if($indice != -1)
            {
                $alumnos[$indice]->Edad = $_GET["Edad"];
                alumno::GuardarTodosTxt($dirFile,$alumnos);
            }
            else
            {
                echo "El DNI pasado no existe en la base de datos";
            }
            break;
        }
    }

    //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------\\
#endregion

#region JSON INDIVIDUAL


    //-----------------------------------------------------------------------JSON INDIVIDUAL---------------------------------------------------------------------------------\\

    //Guarda un alumno como JSON en un archivo. Si el archivo esta creado pone salto de linea al principio, sino no pone.
    public function GuardarJSONIndividual($dirFile)
    {
        if(file_exists($dirFile))
        {
            $resource = fopen($dirFile,"a");
            fwrite($resource, "\r\n".$this->ReturnJson());//Escribe lo que devuelve el JSON en el archivo
            fclose($resource);
        }
        else
        {
            $resource = fopen($dirFile,"w");
            fwrite($resource, $this->ReturnJson());
            fclose($resource);
        }
    }

    //Toma los Alumnos construidos en memoria, filtra cual tiene que sacar del array, y en base a ese array con el elemento ya sacado se reescribe el archivo
    public static function BorrarAlumnoJSON($dirFile)
    {
        $arrayAlumnosVariable =  alumno::MostrarAlumnosJSON($dirFile);
        alumno::GuardarTodosJSON($dirFile,alumno::BorrarRegistro($arrayAlumnosVariable));
    }
    

    //Lee las lineas del archivo y construye un array con esas lineas decodificadas (Como objeto stdClass)
    public static function MostrarAlumnosJSON($dirFile)
    {
        if(file_exists($dirFile))
        {
            $resource = fopen($dirFile,"r");
            $vectorArchivo = array();
            do
            {
                array_push($vectorArchivo,json_decode(fgets($resource)));
            }while(!feof($resource));
            return $vectorArchivo;
        }
        return false;
    }


    //Borra el archivo y si el array pasado no esta vacio, reescribe el archivo con un alumno por linea codificado en JSON
    public static function GuardarTodosJSON($dirFile, $alumnos)
    {
        alumno::VaciarArchivo($dirFile);
        if(!(empty($alumnos)))
        {
            $resource = fopen($dirFile,"w");
            $flag = false;
            foreach($alumnos as $alumno)
            {
                if(!($flag))  //Si es la primera linea que se escribe en el archivo
                {
                    fwrite($resource,json_encode($alumno)); //Va sin salto de linea
                    $flag = true;
                }
                else
                {
                    fwrite($resource,"\r\n".json_encode($alumno)); //sino lleva salto de linea al principio (Para evitar una linea vacia al final del archivo que despues se leeria como nula)
                }
            }
            fclose($resource);
        }
    }

    public static function ModificarAlumnoJSON($dirFile)
    {
        $alumnos = alumno::MostrarAlumnosJSON($dirFile);
        $indice = alumno::BuscarIndiceArray($alumnos);
        switch($_GET["Opcion"])
        {
            case 1:
            if($indice != -1)
            {
                $alumnos[$indice]->Nombre = $_GET["Nombre"];
                alumno::GuardarTodosJSON($dirFile,$alumnos);
            }
            else
            {
                echo "El DNI pasado no existe en la base de datos";
            }
            break;

            case 2:
            if($indice != -1)
            {
                $alumnos[$indice]->Edad = (int)$_GET["Edad"]; //Es necesario especificar el tipo de dato porque sino se guarda como string
                alumno::GuardarTodosJSON($dirFile,$alumnos);
            }
            else
            {
                echo "El DNI pasado no existe en la base de datos";
            }
            break;
        }
    }
    //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------\\
    #endregion
    
#region ARRAY JSON
    //-------------------------------------------------------------------------ARRAY JSON------------------------------------------------------------------------------------\\
    
    //Guarda los alumnos en un solo array de elementos JSON. Recibe el array de Alummnos (Clase alumno) y lo fusiona con el array ya existente en el archivo para reguardarlo como un solo array con los elementos entrantes y los ya existentes
    public static function GuardarArrayJSON($dirFile, $array)
    {
        if(file_exists($dirFile))
        {
            $arrayYaExistente = alumno::MostrarAlumnosArrayJSON($dirFile); //Tomo los alumnos ya existentes
            $arrayAcumulativo = array();
            foreach($arrayYaExistente as $alumnos)
            {
                array_push($arrayAcumulativo,$alumnos); //Los meto en el nuevo array
            }
            foreach($array as $alumno) //Tomo los elementos entrantes y los meto en el nuevo array
            {
                array_push($arrayAcumulativo,$alumno);
            }
            $resource = fopen($dirFile, "w");
            fwrite($resource, json_encode($arrayAcumulativo)); //Escribo el array fusionado
            fclose($resource);
        }
        else
        {
            $resource = fopen($dirFile, "w");
            fwrite($resource, json_encode($array));
            fclose($resource);
        }
    }


    //Devuelve un array de alumnos ya decodificado como stdClass 
    public static function MostrarAlumnosArrayJSON($dirFile)
    {
        if(file_exists($dirFile))
        {
            $arrayJSON = json_decode(file_get_contents($dirFile));
            return $arrayJSON;
        }
        return false;
    }

    
    //Toma los Alumnos construidos en memoria, filtra cual tiene que sacar del array, y en base a ese array con el elemento ya sacado se reescribe el archivo (Borrandolo primero. Si no hay nada que reescribir se borra el archivo directamente)
    public static function BorrarAlumnoArrayJSON($dirFile)
    {
        $arrayAlumnos = alumno::MostrarAlumnosArrayJSON($dirFile);
        $arrayEscribir = alumno::BorrarRegistro($arrayAlumnos);
        alumno::VaciarArchivo($dirFile);
        if(!(empty($arrayEscribir)))
        {
            alumno::GuardarArrayJSON($dirFile,$arrayEscribir);
        }
    }

    public static function ModificarAlumnoArrayJSON($dirFile)
    {
        $alumnos = alumno::MostrarAlumnosArrayJSON($dirFile);
        $indice = alumno::BuscarIndiceArray($alumnos);
        switch($_GET["Opcion"])
        {
            case 1:
            if($indice != -1)
            {
                $alumnos[$indice]->Nombre = $_GET["Nombre"];
                alumno::VaciarArchivo($dirFile);
                alumno::GuardarArrayJSON($dirFile,$alumnos);
            }
            else
            {
                echo "El DNI pasado no existe en la base de datos";
            }
            break;

            case 2:
            if($indice != -1)
            {
                $alumnos[$indice]->Edad = (int)$_GET["Edad"]; //Es necesario especificar el tipo de dato porque sino se guarda como string
                alumno::VaciarArchivo($dirFile); //Es necesario borrar el archivo y reescribirlo porque sino se fusiona con lo ya existente y se duplican los registros
                alumno::GuardarArrayJSON($dirFile,$alumnos);
            }
            else
            {
                echo "El DNI pasado no existe en la base de datos";
            }
            break;
        }
    }
    //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------\\
    #endregion

#region GENERALES
    //----------------------------------------------------------------------------GENERALES----------------------------------------------------------------------------------\\
    
    //En base al Array que se le pasa por parametro, filtra y elimina el alumno con DNI correspondiente enviado por GET. Por ultimo reordena los indices del array para que no haya lugares vacios y se reescriban lineas vacias en los archivos
    private static function BorrarRegistro($array)
    {
        $indice = alumno::BuscarIndiceArray($array);
        if($indice != -1)
        {
            unset($array[$indice]); //Lo saco
            $arrayReIndexado = array_values($array); //Y reordeno los indices del array
            return $arrayReIndexado;
        }
        else
        {
            echo "<br>El DNI pasado por parametro no se encuentra en la base de datos!";
            return -1;
        }
    }

    private static function BuscarIndiceArray($alumnos)
    {
        $indice = -1;
        for($i = 0; $i < count($alumnos); $i++) //Recorro el array de alumnos en memoria
        {    
            if($alumnos[$i]->DNI == $_GET["DNI"]) //Si el alumno es el mismo que pasado por parametro
            {
                $indice = $i; //Devuelvo el indice para poder eliminarlo o modificarlo
            }
        }
        return $indice;
    }

    private static function VaciarArchivo($dirFile)
    {
        if(file_exists($dirFile))
        {
            $resource = fopen($dirFile,"w");
            fclose($resource);   
        }
    }

    //Crear transformar alumno

    //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------\\
#endregion

#region FOTOS
    //----------------------------------------------------------------------------FOTOS---------------------------------------------------------------------------------------\\
    public function GuardarFoto($path)
    {
        if(file_exists($_FILES["archivo"]["tmp_name"]))
        {
            $nombreArchivo = "";
            $arrayNombre = explode(".",$_FILES["archivo"]["name"]); //Separo el nombre de la extension (La extension queda como elemento [1] del array)
            $nombreArchivo .=  $this->legajo . $this->Nombre . '.' . $arrayNombre[1]; //Creo el nombre del archivo con el nombre del alumno, legajo y extension
            $path .= '/' . $nombreArchivo; //Creo el path agregandole al path pasado por parametro (Carpeta Archivos) la barra y el nombre del archivo
            if(file_exists($path)) //Si el alumno ya tiene foto de perfil
            {
                $this->ReemplazarFoto("./ArchivosBackup"); //Reemplazo la existente (La muevo a ArchivosBackup añadiendole al nombre la fecha)             
                move_uploaded_file($_FILES["archivo"]["tmp_name"],$path); //Y pongo la entrante en la carpeta archivos (Le decis como se llama el archivo en el primer argumento y a donde va a ir a parar en el segundo (incluyendo nombre de arhcivo mas path))
            }
            else
            {
                $this->PonerMarcaDeAgua($_FILES["archivo"]["tmp_name"],$path);
                //move_uploaded_file($_FILES["archivo"]["tmp_name"],$path); 
            }
        }
    }

    private function ReemplazarFoto($path)
    {
        $nombreArchivo = "";
        $arrayNombre = explode(".",$_FILES["archivo"]["name"]);
        date_default_timezone_set('America/Argentina/Buenos_Aires'); //Seteo la zona horaria para que al imprimir la hora sea la hora local de argentina
        $fecha = date("dmy\-H\.i\.s"); //Recibo la hora en formato diaMesAño-Hora.Minuto.Seugndo
        $nombreArchivo .= $this->legajo . $this->Nombre . $fecha . '.' . $arrayNombre[1]; //Creo el nombre del archivo con el legajo, nombre, fecha y extension
        $path .= '/' . $nombreArchivo;
        move_uploaded_file($_FILES["archivo"]["tmp_name"],$path); //Muevo la foto a archivos Backup 
    }

    private function PonerMarcaDeAgua($archivo,$path)
    {
        $marca = imagecreatefrompng('./Archivos/md_5aff6089d3e02.png'); //Cargo la marca de agua
        $imagen = imagecreatefromjpeg($archivo); //Cargo la imagen base

        $margenDerecho = 10; //Establezco margen derecho
        $margenIzquierdo = 10; //Establezco margen izquierdo
        $marcax = imagesx($marca); //Obtengo ancho de la foto
        $marcay = imagesy($marca); //Obtengo alto de la foto

        //Copio la marca de agua sobre la imagen base calculando la posicion basandome en los margenes y tamaños
        imagecopy($imagen, $marca, imagesx($imagen) - $marcax - $margenDerecho, imagesy($imagen) - $marcay - $margenIzquierdo,0,0,$marcax,$marcay);
        //Guardo la imagen con marca de agua en la ruta especificada
        imagepng($imagen,$path);
    }
    //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------\\
#endregion
}
?>