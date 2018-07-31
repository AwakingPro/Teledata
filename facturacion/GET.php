<?php
    $url='https://api.bsale.cl/v1/documents.json';
    $access_token='55c32f657ce5aa159a6fc039b64aabceead8f061';

    // Inicia cURL
    $session = curl_init($url);


    // Indica a cURL que retorne data
    curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

    // Configura cabeceras
    $headers = array(
        'access_token: ' . $access_token,
        'Accept: application/json',
        'Content-Type: application/json'
    );
    curl_setopt($session, CURLOPT_HTTPHEADER, $headers);

    // Ejecuta cURL
    $response = curl_exec($session);
    $code = curl_getinfo($session, CURLINFO_HTTP_CODE);

    // Cierra la sesión cURL
    curl_close($session);

    //Esto es sólo para poder visualizar lo que se está retornando
    print_r($response);

?>