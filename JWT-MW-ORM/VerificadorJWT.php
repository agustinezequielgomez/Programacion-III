<?php
require_once './vendor/autoload.php';
use Firebase\JWT\JWT;

class VerificadorJWT
{
    private static $claveSecreta = 'claveSecreta';
    public static function CrearToken($datos)
    {
        $iat = time();
        $payload = array(
            'iat' => $iat,
            'exp' => $iat + (30),
            'aud' => self::aud(),
            'data' => $datos,
            'app' => 'Users 2019'
        );
        return JWT::encode($payload,self::$claveSecreta);
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