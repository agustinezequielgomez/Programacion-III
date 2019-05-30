<?php
interface IApi
{
    public function traerTodos($request,$response,$args);
    public function traerUno($request,$response,$args);
    public function cargarUno($request,$response,$args);
    public function modificarUno($request,$response,$args);
    public function borrarUno($request,$response,$args);
}
?>