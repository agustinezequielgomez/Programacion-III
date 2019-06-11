<?php
namespace clases;
use App\Models\compra;
use Slim\Http\Request;
use Slim\Http\Response;
use clases\VerificadorJWT;
require_once '../src/clases/VerificadorJWT.php';
require_once '../src/app/models/compra.php';
class compraApi
{
    public static function EfectuarCompra(Request $request, Response $response, array $args)
    {
        $token = $request->getHeader('token')[0];
        $payload = VerificadorJWT::TraerData($token);
        $atributos = $request->getParsedBody();
        $compra = new compra();
        $compra->articulo = $atributos["articulo"];
        $compra->fecha = date("dd/mm/yyyy");
        $compra->precio = $atributos["precio"];
        $compra->id_usuario=$payload->id;
        $archivos = $request->getUploadedFiles();
        $foto = $archivos["foto"];
        $extension = explode('.',$foto->getClientFileName());
        $extension = array_reverse($extension)[0];
        $foto["foto"]->moveto('./src/IMGCompras/'.$payload->id.$atributos["articulo"]);
        $compra->save();
        $response->getBody()->write("\nProducto comprado con exito");
        return $response;
    }

    public static function VerCompras(Request $request, Response $response, array $args)
    {
        $token = $request->getHeader('token')[0];
        $payload = VerificadorJWT::TraerData($token);
        if($payload->perfil=='usuario')
        {
            $response->getBody()->write(compra::where("id_usuario","=",$payload->id)->get());
        }
        else
        {
            $response->getBody()->write((compra::all())->toJson());
        }
        return $response;
    }
}
?>