<?php
namespace clases;
use clases\VerificadorJWT;
use clases\IApi;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\ejemploModelo;
use App\Models\logueo;

class logueosApi
{
    public function MostrarLogs(Request $request,Response $response,$args)
    {
        return (logueo::where('legajo',$args['legajo'])->get())->toJson();
    }
}
?>