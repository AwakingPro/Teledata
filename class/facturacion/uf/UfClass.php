<?php
class Uf {

    public function getValue() {
        // $apiUrl = 'https://mindicador.cl/api/uf/'.date('d-m-Y');
        $apiUrl = 'https://api.sbif.cl/api-sbifv3/recursos_api/uf?apikey=186ad210733f0a0c07e91db7f59bd976a255d01e&formato=json';
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
        if(isset($dailyIndicators->UFs[0]->Valor)){
            // $Value = floatval($dailyIndicators->UFs[0]->Valor);
            $Value = $dailyIndicators->UFs[0]->Valor;
            $Value = floatval(27566.79);
            // $findme   = ',';
            // $coma = strpos($Value, $findme);
            // if($coma == true){
            //     echo 'existe la coma';
            // }else{
            //     echo 'no existe la coma';
            // }
            // $Value = number_format($Value, 3, '', ',');
            // $Value = round($Value);
            // $Value = $this->redondeado($Value, 6);
        }else{
            // $Value = floatval(27.565,79);
            $Value = floatval(27566.79);
        }
        return $Value;
    }
}
?>