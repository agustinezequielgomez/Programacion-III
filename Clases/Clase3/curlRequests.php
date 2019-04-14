<?php
function request_curl()
{
    $URL= "http://www.test.com/request";

    $conexion = curl_init();

    curl_setopt($conexion,CURLOPT_URL,$URL);
    curl_setopt($conexion,CURLOPT_HTTPGET,false);
    curl_setopt($conexion,CURLOPT_HTTPHEADER,array('Content-type: text/plain', 'Content-length: 100'));
    curl_setopt($conexion,CURLOPT_SSLVERSION,CURL_SSLVERSION_TLSV1_2);
    curl_setopt($conexion,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($conexion,CURLOPT)
}
?>