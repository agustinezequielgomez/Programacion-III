<?php
namespace clases;
use clases\VerificadorJWT;
use clases\IApi;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\ejemploModelo;
use App\Models\venta;

class ventaApi
{
    public function VenderUno(Request $request,Response $response,$args)
    {
        $atributos = $request->getParsedBody();
        $venta = new venta();
        $venta->marca= $atributos["marca"];
        $venta->modelo = $atributos["modelo"];
        $venta->fecha = date_create();
        $venta->precio = $atributos["precio"];
        $venta->save();
        venta::subirFoto($request->getUploadedFiles(),'../files/IMGCompras/',$venta);
        return $response->getBody()->write("<br>Venta realizada con exito");
    }
}
?>