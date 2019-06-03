<?php
interface IApi
{
    public function TraerUno($request,$response,$args);
    public function TraerTodos($request,$response,$args);
    public function EnviarUno($request,$response,$args);
    public function ModificarUno($request,$response,$args);
    public function BorrarUno($request,$response,$args);
    public function Login($request,$response,$args);
}
?>