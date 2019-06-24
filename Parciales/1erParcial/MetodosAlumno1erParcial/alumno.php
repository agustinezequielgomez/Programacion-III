<?php
include_once "Persona.php";
include_once "AccesoDatos.php";
class alumno extends Persona 
{
    public $Legajo;
    public $ID;

    /*COMENTO EL CONSTRUCTOR PORQUE YA LOS CONSTRUYE SOLOS AL TRAERLOS
    public function __construct($Nombre, $Edad, $Dni, $Legajo)
    {
        parent::__construct($Nombre,$Edad,$Dni);
        $this->Legajo = $Legajo;
    }*/

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
            if(file_get_contents($dirFile) != "")
            {
                fwrite($resource, "\r\n"."$this->ID".","."$this->Nombre".","."$this->Edad".","."$this->DNI".","."$this->Legajo"); // "\r\n" para salto de linea
            }
            else
            {
                fwrite($resource, "$this->ID".","."$this->Nombre".","."$this->Edad".","."$this->DNI".","."$this->Legajo");
            }
        }
        else
        {
            $resource = fopen($dirFile,"w"); // w = Sobreescribe todo el archivo
            fwrite($resource, "$this->ID".","."$this->Nombre".","."$this->Edad".","."$this->DNI".","."$this->Legajo"); // "$this->atributo" es lo mismo que $this->atruibto. El escribir las comillas o no no hace diferencia. Si fuera '$this->atributo' escribiria eso textualmente
        }
        fclose($resource);
    }

    //Elimina el archivo y lo guarda otra vez con todos los alumnos desde un array en memoria. Se guardan de manera individual en un TXT
    public static function GuardarTodosTxt($dirFile, $alumnos) 
    {
        if($alumnos!=-1)
        {
            alumno::VaciarArchivo($dirFile);
            foreach($alumnos as $alumno)
            {
                $alumno->GuardarAlumnoTxt($dirFile);
            }
        }
        else
        {
            exit;
        }
    }

    //Trae las lineas de texto de manera individual (c/linea como elemento de un array) de un archivo TXT que contiene los alumnos
    public static function TraerLineasArchivo($dirFile) //Metodo estatico
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
        $lineas = alumno::TraerLineasArchivo($dirFile); //Guardo en un array las lineas del archivo
        $alumnos = array();
        if($lineas !=NULL)
        {
            foreach($lineas as $linea)
            {
                if(!empty($linea))
                {
                    $datos = explode(",",$linea); //Por cada linea no vacia parseo los datos que contiene
                    $alumno = alumno::MiConstructor((int)$datos[3],$datos[1],(int)$datos[2],(int)$datos[4]);
                    $alumno->ID = ((int)$datos[0]);
                    array_push($alumnos,$alumno); //Guardo en un array esos alumnos creados con los datos parseados
                }
            }
            return $alumnos;
        }
    }

    //Toma los Alumnos construidos en memoria, filtra cual tiene que sacar del array, y en base a ese array con el elemento ya sacado se reescribe el archivo
    public static function BorrarAlumnoTxt($dirFile, $_DELETE)
    {
        $alumnos = alumno::TraerAMemoriaTxt($dirFile);
        alumno::GuardarTodosTxt($dirFile,alumno::BorrarRegistro($alumnos,$_DELETE["Legajo"])); //Borro el archivo y lo reescribo con el array restante en memoria
    }

    public static function ModificarAlumnoTxt($dirFile, $_PUT)
    {
        $alumnos = alumno::TraerAMemoriaTxt($dirFile);
        $indice = alumno::BuscarIndiceArray($alumnos, $_PUT["Legajo"]); //Busco el indice del alumno que coincida con el DNI pasado por $_GET
        $flag = false;
        //Leo que se va a modificar
        if($indice!= -1)
        {
            if($_PUT["Nombre"]!=NULL)
            {
                $alumnos[$indice]->Nombre = $_PUT["Nombre"];
                $flag= true;
            }
            if($_PUT["Edad"]!=NULL)
            {
                $alumnos[$indice]->Edad = $_PUT["Edad"];
                $flag= true;
            }
            if($flag == true)
            {
                alumno::GuardarTodosTxt($dirFile,$alumnos);
            }
            else
            {
                throw new Exception("<br>No se pasaron datos para modificar al alumno<br>");
            }
        }
        else
        {
            throw new Exception("<br>El Legajo ingresado no existe en la base de datos<br>");
        }
    }

    public static function MostrarAlumnoTxt($dirFile)
    {
        $alumnos = alumno::TraerAMemoriaTxt($dirFile);
        foreach($alumnos as $alumno)
        {
             $alumno->MostrarAlumno();
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
            if(file_get_contents($dirFile)!= "")
            {
                fwrite($resource, "\r\n".$this->ReturnJson());//Escribe lo que devuelve el JSON en el archivo
            }
            else
            {
                fwrite($resource, $this->ReturnJson());
            }
        }
        else
        {
            $resource = fopen($dirFile,"w");
            fwrite($resource, $this->ReturnJson());
        }
        fclose($resource);
    }

    //Toma los Alumnos construidos en memoria, filtra cual tiene que sacar del array, y en base a ese array con el elemento ya sacado se reescribe el archivo
    public static function BorrarAlumnoJSON($dirFile,$_DELETE)
    {
        $arrayAlumnosVariable = alumno::LeerArchivoJSON($dirFile);
        alumno::GuardarTodosJSON($dirFile,alumno::BorrarRegistro($arrayAlumnosVariable,$_DELETE["Legajo"]));
    }
    

    //Lee las lineas del archivo y construye un array con esas lineas decodificadas (Como objeto stdClass)
    public static function LeerArchivoJSON($dirFile)
    {
        if(file_exists($dirFile))
        {
            $resource = fopen($dirFile,"r");
            $vectorArchivo = array();
            do
            {
                array_push($vectorArchivo,alumno::objectToObject(json_decode(fgets($resource))));
            }while(!feof($resource));
            return $vectorArchivo;
        }
        return false;
    }


    //Borra el archivo y si el array pasado no esta vacio, reescribe el archivo con un alumno por linea codificado en JSON
    public static function GuardarTodosJSON($dirFile, $alumnos)
    {
        if($alumnos != -1)
        {
            alumno::VaciarArchivo($dirFile);
            if(!(empty($alumnos)))
            {
                foreach($alumnos as $alumno)
                {
                    $alumno->GuardarJSONIndividual($dirFile);
                }
            }
        }
    }

    public static function ModificarAlumnoJSON($dirFile,$_PUT)
    {
        $alumnos = alumno::LeerArchivoJSON($dirFile);
        $indice = alumno::BuscarIndiceArray($alumnos,$_PUT["Legajo"]);
        $flag = false;
        if($indice!=-1)
        {
            if($_PUT["Nombre"]!=NULL)
            {
                $alumnos[$indice]->Nombre = $_PUT["Nombre"];
                $flag = true;
            }
            if($_PUT["Edad"]!=NULL)
            {
                $alumnos[$indice]->Edad = (int)$_PUT["Edad"]; //Es necesario especificar el tipo de dato porque sino se guarda como string
                $flag = true;
            }
            if($flag == true)
            {
                alumno::GuardarTodosJSON($dirFile,$alumnos);
            }
            else
            {
                throw new Exception("<br>No se pasaron datos para modificar al alumno<br>");
            }
        }
        else
        {
            throw new Exception("<br>El Legajo ingresado no existe en la base de datos<br>");
        }
    }

    public static function MostrarAlumnosJSON($dirFile)
    {
        $alumnos = alumno::LeerArchivoJSON($dirFile);
        if($alumnos !=NULL)
        {
            foreach($alumnos as $alumno)
            {
                $alumno->MostrarAlumno();
            }
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
            $arrayYaExistente = alumno::LeerArchivoArrayJSON($dirFile); //Tomo los alumnos ya existentes
            $arrayAcumulativo = array();
            if($arrayYaExistente !=NULL)
            {
                foreach($arrayYaExistente as $alumnos)
                {
                    array_push($arrayAcumulativo,$alumnos); //Los meto en el nuevo array
                }
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
    public static function LeerArchivoArrayJSON($dirFile)
    {
        if(file_exists($dirFile))
        {
            $arrayJSON = json_decode(file_get_contents($dirFile));
            $arrayAlumnos = array();
            if($arrayJSON != NULL)
            {
                foreach($arrayJSON as $alumno)
                {
                    array_push($arrayAlumnos,alumno::objectToObject($alumno));
                }
                return $arrayAlumnos;
            }
        }
        return false;
    }

    
    //Toma los Alumnos construidos en memoria, filtra cual tiene que sacar del array, y en base a ese array con el elemento ya sacado se reescribe el archivo (Borrandolo primero. Si no hay nada que reescribir se borra el archivo directamente)
    public static function BorrarAlumnoArrayJSON($dirFile,$_DELETE)
    {
        $arrayAlumnos = alumno::LeerArchivoArrayJSON($dirFile);
        $arrayEscribir = alumno::BorrarRegistro($arrayAlumnos,$_DELETE["Legajo"]);
        if($arrayEscribir != -1)
        {
            alumno::VaciarArchivo($dirFile);
            if(!(empty($arrayEscribir)))
            {
                alumno::GuardarArrayJSON($dirFile,$arrayEscribir);
            }
        }
    }

    public static function ModificarAlumnoArrayJSON($dirFile,$_PUT)
    {
        $alumnos = alumno::LeerArchivoArrayJSON($dirFile);
        $indice = alumno::BuscarIndiceArray($alumnos,$_PUT["Legajo"]);
        $flag = false;
        if($indice != -1)
        {
            if($_PUT["Nombre"]!=NULL)
            {
                $alumnos[$indice]->Nombre = $_PUT["Nombre"];
                $flag = true;
            }
            if($_PUT["Edad"]!=NULL)
            {
                $alumnos[$indice]->Edad = (int)$_PUT["Edad"]; //Es necesario especificar el tipo de dato porque sino se guarda como string
                $flag = true;
            }
            if($flag == true)
            {
                alumno::VaciarArchivo($dirFile); //Es necesario borrar el archivo y reescribirlo porque sino se fusiona con lo ya existente y se duplican los registros
                alumno::GuardarArrayJSON($dirFile,$alumnos);
            }
            else
            {
                throw new Exception("<br>No se pasaron datos para modificar al alumno<br>");
            }
        }
        else
        {
            throw new Exception("<br>El Legajo ingresado no existe en la base de datos<br>");
        }
    }

    public static function MostrarAlumnosArrayJSON($dirFile)
    {
        $alumnos = alumno::LeerArchivoArrayJSON($dirFile);
        if($alumnos!=NULL)
        {
            foreach($alumnos as $alumno)
            {
                $alumno->MostrarAlumno();
            }
        }
    }
    //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------\\
    #endregion

#region GENERALES
    //----------------------------------------------------------------------------GENERALES----------------------------------------------------------------------------------\\
    
    //En base al Array que se le pasa por parametro, filtra y elimina el alumno con DNI correspondiente enviado por GET. Por ultimo reordena los indices del array para que no haya lugares vacios y se reescriban lineas vacias en los archivos
    private static function BorrarRegistro($array, $Legajo)
    {
        $indice = alumno::BuscarIndiceArray($array, $Legajo);
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

    private static function BuscarIndiceArray($alumnos, $Legajo)
    {
        $indice = -1;
        for($i = 0; $i < count($alumnos); $i++) //Recorro el array de alumnos en memoria
        {    
            if($alumnos[$i]->Legajo == $Legajo) //Si el alumno es el mismo que pasado por parametro
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
    private static function objectToObject($instancia) 
    {
        $alumno = alumno::MiConstructor($instancia->DNI,$instancia->Nombre, $instancia->Edad,$instancia->Legajo);
        $alumno->ID = $instancia->ID;
        return $alumno;
    }

    public function curl_del($path)
    {
        $url = $this->__url.$path;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $result;
    }


    public static function MiConstructor($DNI, $Nombre, $Edad, $Legajo)
    {
        $alumno = new alumno();
        $alumno->DNI = $DNI;
        $alumno->Nombre = $Nombre;
        $alumno->Edad = $Edad;
        $alumno->Legajo = $Legajo;

        return $alumno;
    }

    public function MostrarAlumno()
    {
        echo "<br>ID: ",$this->ID;
        echo "<br>DNI: ",$this->DNI;
        echo "<br>Legajo: ",$this->Legajo;
        echo "<br>Nombre: ",$this->Nombre;
        echo "<br>Edad: ",$this->Edad;
        echo "<br>";
    }
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
            $nombreArchivo .=  $this->Legajo . $this->Nombre . '.' . $arrayNombre[1]; //Creo el nombre del archivo con el nombre del alumno, Legajo y extension
            $path .= '/' . $nombreArchivo; //Creo el path agregandole al path pasado por parametro (Carpeta Archivos) la barra y el nombre del archivo
            if(file_exists($path)) //Si el alumno ya tiene foto de perfil
            {
                $this->ReemplazarFoto("./ArchivosBackup",$path); //Reemplazo la existente (La muevo a ArchivosBackup añadiendole al nombre la fecha)             
                $this->PonerMarcaDeAgua($_FILES["archivo"]["tmp_name"],$path); //Y pongo la entrante en la carpeta archivos (Le decis como se llama el archivo en el primer argumento y a donde va a ir a parar en el segundo (incluyendo nombre de arhcivo mas path))
            }
            else
            {
                $this->PonerMarcaDeAgua($_FILES["archivo"]["tmp_name"],$path);
            }
        }
    }

    private function ReemplazarFoto($pathBackup,$FotoExistente)
    {
        $nombreArchivo = "";
        $arrayNombre = explode(".",$FotoExistente);
        date_default_timezone_set('America/Argentina/Buenos_Aires'); //Seteo la zona horaria para que al imprimir la hora sea la hora local de argentina
        $fecha = date("dmy\-H\.i\.s"); //Recibo la hora en formato diaMesAño-Hora.Minuto.Seugndo
        $nombreArchivo .= $this->Legajo . $this->Nombre . $fecha . '.' . $arrayNombre[2]; //Creo el nombre del archivo con el Legajo, nombre, fecha y extension
        $pathBackup .= '/' . $nombreArchivo;        
        copy($FotoExistente,$pathBackup); //Muevo la foto a archivos Backup 
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

    public static function MoverFotoBorrada($_DELETE, $path)
    {
        $archivos = glob($path."/".$_DELETE["Legajo"]."*.jpg"); //Busco el archivo
        $pathExistenteArhcivo = explode(".",$archivos[0]); //Separo del path la extension y el nombre
        $nombreExistenteArchivo = explode("/", $pathExistenteArhcivo[1]); //Separo del nombre solo el nombre del archivo (Dejando fuera el nombre de la carpeta)
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $fecha = date("dmy\-H\.i\.s");
        $nombreNuevoArchivo = "";
        $nombreNuevoArchivo = "./ArchivosBorrados" . "/" . $nombreExistenteArchivo[2] . $fecha . "." . $pathExistenteArhcivo[2];
        rename($archivos[0],$nombreNuevoArchivo);
    }
    //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------\\
#endregion

#region DB
/*MEJOR NO USARLA
public function GuardarUnAlumnoBD()
{
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
    $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into alumno (DNI,Legajo,Nombre,Edad)values('$this->DNI','$this->Legajo','$this->Nombre','$this->Edad')");
    $consulta->execute();
    return $objetoAccesoDato->RetornarUltimoIdInsertado();
}*/

public function GuardarUnAlumnoParametrosDB()
{
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
    $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into alumno (DNI, Legajo, Nombre, Edad)values(:DNI,:Legajo,:Nombre,:Edad)");
    $consulta->bindValue(':DNI',$this->DNI, PDO::PARAM_INT);
    $consulta->bindValue(':Legajo', $this->Legajo, PDO::PARAM_INT);
    $consulta->bindValue(':Nombre', $this->Nombre, PDO::PARAM_STR);
    $consulta->bindValue(':Edad', $this->Edad, PDO::PARAM_INT);
    $consulta->execute();		
    return $objetoAccesoDato->RetornarUltimoIdInsertado();
}

public static function TraerTodosLosAlumnosDB()
{
    $conexion = AccesoDatos::dameUnObjetoAcceso();
    $consulta = $conexion->RetornarConsulta("SELECT * FROM `alumno`");
    $consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_CLASS, "alumno");
}

public static function TraerAlumnoPorNombreDB($Nombre)
{
    $conexion = AccesoDatos::dameUnObjetoAcceso();
    $consulta = $conexion->RetornarConsulta("SELECT * FROM `alumno` WHERE Nombre = :Nombre");
    $consulta->bindValue(":Nombre",$Nombre,PDO::PARAM_STR);
    $consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_CLASS,'alumno');
}

public static function TraerAlumnoPorEdadDB($Edad)
{
    $conexion = AccesoDatos::dameUnObjetoAcceso();
    $consulta = $conexion->RetornarConsulta("SELECT * FROM `alumno` WHERE Edad = :Edad");
    $consulta->bindValue(":Edad",$Edad,PDO::PARAM_INT);
    $consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_CLASS,'alumno');
}

public static function TraerAlumnoPorLegajoDB($legajo)
{
    $conexion = AccesoDatos::dameUnObjetoAcceso();
    $consulta = $conexion->RetornarConsulta("SELECT * FROM `alumno` WHERE Legajo = :legajo");
    $consulta->bindValue(":legajo",$legajo,PDO::PARAM_INT);
    $consulta->execute();
    return $consulta->fetchObject('alumno');
}

public static function MostrarTodosLosAlumnosDB()
{
    $alumnos = alumno::TraerTodosLosAlumnosDB();
    foreach($alumnos as $alumno)
    {
        $alumno->MostrarAlumno();
    }
}

public static function BorrarAlumnoDB($_DELETE)
{
    $alumno = alumno::TraerAlumnoPorLegajoDB($_DELETE["Legajo"]);
    if($alumno != false)
    {
        $filasAfectadas = $alumno->EliminarPorIDDB();
        echo "Alumno eliminado con exito. Filas afectadas: ",$filasAfectadas;
    }
    else
    {
        throw new Exception("<br>El alumno que se intenta borrar no se encuentra en la base de datos<br>");
    }
}

public function EliminarPorIDDB()
{
       $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
       $consulta =$objetoAccesoDato->RetornarConsulta("
           delete 
           from alumno 				
           WHERE ID=:ID");	
           $consulta->bindValue(':ID',$this->ID, PDO::PARAM_INT);		
           $consulta->execute();
           return $consulta->rowCount();
}

public static function EliminarPorNombreDB($Nombre)
{
       $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
       $consulta =$objetoAccesoDato->RetornarConsulta("
           delete 
           from alumno 				
           WHERE Nombre=:Nombre");	
           $consulta->bindValue(':Nombre',$Nombre, PDO::PARAM_STR);		
           $consulta->execute();
           return $consulta->rowCount();
}

public static function EliminarPorEdadDB($Edad)
{
       $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
       $consulta =$objetoAccesoDato->RetornarConsulta("
           delete 
           from alumno 				
           WHERE Edad=:Edad");	
           $consulta->bindValue(':Edad',$Edad, PDO::PARAM_INT);		
           $consulta->execute();
           return $consulta->rowCount();
}

public static function ModificarAlumnoDB($_PUT)
{
    $alumno = alumno::TraerAlumnoPorLegajoDB($_PUT["Legajo"]);
    $flag = false;
    if($alumno != false)
    {
        if($_PUT["Nombre"] != NULL)
        {
            $alumno->Nombre = $_PUT["Nombre"];
            $flag= true;
        }
        if($_PUT["Edad"] != NULL)
        {
            $alumno->Edad = $_PUT["Edad"];
            $flag= true;
        }
        if($flag == true)
        {
            $alumno->ModificarAlumnoParametros();
        }
        else
        {
            throw new Exception("<br>No se ingresaron datos para modificar al alumno<br>");
        }
    }
    else
    {
        throw new Exception("<br>El Legajo ingresado no existe en la base de datos<br>");
    }
}

public function ModificarAlumnoParametros()
{
       $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
       $consulta =$objetoAccesoDato->RetornarConsulta("update `alumno` set Nombre=:nombre, Edad=:edad WHERE ID=:ID");
       $consulta->bindValue(':nombre',$this->Nombre, PDO::PARAM_STR);
       $consulta->bindValue(':edad', $this->Edad, PDO::PARAM_INT);
       $consulta->bindValue(':ID',$this->ID, PDO::PARAM_INT);
       return $consulta->execute();
}
#endregion
}
