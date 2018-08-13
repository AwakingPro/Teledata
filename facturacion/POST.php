<?php
    $url='https://api.bsale.cl/v1/payment_types.json';
    $query = "SELECT token_produccion as access_token FROM variables_globales";
    $variables_globales = $run->select($query);
    $access_token = $variables_globales[0]['access_token'];

    // Inicia cURL
    $session = curl_init($url);

    // Indica a cURL que retorne data
    curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
    // Activa SSL
    // curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, true);

    // Configura cabeceras
    $headers = array(
        'access_token: ' . $access_token,
        'Accept: application/json',
        'Content-Type: application/json'
    );
    curl_setopt($session, CURLOPT_HTTPHEADER, $headers);

    // Indica que se va ser una petición POST
    curl_setopt($session, CURLOPT_POST, true);

    $array = array("name" => "20 Dias");

    // Parsea a JSON
    $data = json_encode($array);

    // Agrega parámetros
    curl_setopt($session, CURLOPT_POSTFIELDS, $data);

    // Ejecuta cURL
    $response = curl_exec($session);

    // // Cierra la sesión cURL
    curl_close($session);
    $response = json_decode($response, true);

    //Esto es sólo para poder visualizar lo que se está retornando
    print_r($response);

?>