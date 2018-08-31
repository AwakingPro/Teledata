<?php
class Uf {

    public function getValue() {
        $apiUrl = 'https://mindicador.cl/api/uf';
        //Es necesario tener habilitada la directiva allow_url_fopen para usar file_get_contents
        if ( ini_get('allow_url_fopen') ) {
            $arrContextOptions=array(
                "ssl"=>array(
                    "verify_peer"=>false,
                    "verify_peer_name"=>false,
                ),
            ); 
            $json = file_get_contents($apiUrl,false,stream_context_create($arrContextOptions));
        } else {
            //De otra forma utilizamos cURL
            $curl = curl_init($apiUrl);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $json = curl_exec($curl);
            curl_close($curl);
        }
        $dailyIndicators = json_decode($json);
        if(isset($dailyIndicators->serie[0]->valor)){
            $Value = round(floatval($dailyIndicators->serie[0]->valor),0);
        }else{
            $Value = 0;
        }
        return $Value;
    }
}
?>