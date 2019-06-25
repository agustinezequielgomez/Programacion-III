<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use clases\usuarioApi;
use clases\inscripcionApi;
use clases\materiaApi;
use clases\MWParcial;
require_once '../src/Clases/usuarioApi.php';
require_once '../src/Clases/inscripcionApi.php';
require_once '../src/Clases/materiaApi.php';
require_once '../src/Clases/MWParcial.php';

return function (App $app) {
    $container = $app->getContainer();
    $app->group('/Usuarios',function()
    {
        $this->post('/{legajo}',usuarioApi::class.':modificarUsuario')->add(MWParcial::class.':MWModificar')->add(MWParcial::class.':MWValidarLegajoExistenteGet');
        $this->post('/',usuarioApi::class.':altaUsuario')->add(MWParcial::class.':MWValidarAlta');
    });

    $app->group('/inscripcion',function()
    {
        $this->post('/{idMateria}',inscripcionApi::class.':inscribirse')->add(MWParcial::class.':MWValidarCupo')->add(MWParcial::class.':MWValidarMateriaId')->add(MWParcial::class.':MWVerificarCredenciales');
    });

    $app->group('/Materia',function()
    {
        $this->post('/',materiaApi::class.':altaMateria')->add(MWParcial::class.':MWVerificarCredenciales')->add(MWParcial::class.':MWValidarMateria');
        $this->get('/',materiaApi::class.':verMaterias');
    });

    $app->group('/Login',function()
    {
        $this->post('/',usuarioApi::class.':Login')->add(MWParcial::class.':MWLogin');
    });


};
?>