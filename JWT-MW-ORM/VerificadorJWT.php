<?php
require '../Server/composer/vendor/autoload.php';
use Firebase\JWT\JWT;

class VerificadorJWT
{
    private static $claveSecreta = 'claveSecreta';
    private static $algoritmo = ['HS256'];
    public static function CrearToken($datos)
    {
        $iat = time();
        $payload = array(
            'iat' => $iat,
            'exp' => $iat + (30),
            'aud' => self::aud(),
            'data' => $datos,
            'app' => "Users 2019"
        );
        return JWT::encode($payload,self::$claveSecreta);
    }

    public static function VerificarToken($token)
    {
        if(empty($token))
        {
            throw new Exception("El token esta vacio");
        }

        try
        {
            $tokenDecodificado = JWT::decode($token,self::$claveSecreta,VerificadorJWT::$algoritmo);
        }
        catch(Exception $e)
        {
            throw $e;
        }

        if($tokenDecodificado->aud !== VerificadorJWT::aud())
        {
            throw new Exception("El usuario no se valido");
        }
    }

    public static function TraerPayload($token)
    {
        return JWT::decode($token,self::$claveSecreta,VerificadorJWT::$algoritmo);
    }

    public static function TraerData($token)
    {
        return VerificadorJWT::TraerPayload($token)->data;
    }

    public static function aud()
    {
        $aud = '';
        
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $aud = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $aud = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $aud = $_SERVER['REMOTE_ADDR'];
        }
        
        $aud .= @$_SERVER['HTTP_USER_AGENT'];
        $aud .= gethostname();
        
        return sha1($aud);
    }
}
?>