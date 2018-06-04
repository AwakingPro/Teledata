<?php
class Uf {

    public function getValue($date) {
        $apiUrl = 'https://mindicador.cl/api/uf/'.$date;
        //Es necesario tener habilitada la directiva allow_url_fopen para usar file_get_contents
        if ( ini_get('allow_url_fopen') ) {
            $json = file_get_contents($apiUrl);
        } else {
            //De otra forma utilizamos cURL
            $curl = curl_init($apiUrl);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $json = curl_exec($curl);
            curl_close($curl);
        }
        $dailyIndicators = json_decode($json);
        return floatval($dailyIndicators->serie[0]->valor);
    }
}
?>