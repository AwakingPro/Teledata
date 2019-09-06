<?php
class Uf {

    public function getValue($FechaFacturacion = false) {
        if($FechaFacturacion){
            $apiUrl = 'https://api.sbif.cl/api-sbifv3/recursos_api/uf/'.$FechaFacturacion.'?apikey=186ad210733f0a0c07e91db7f59bd976a255d01e&formato=json';
        }else{
            $apiUrl = 'https://api.sbif.cl/api-sbifv3/recursos_api/uf?apikey=186ad210733f0a0c07e91db7f59bd976a255d01e&formato=json';
        }
        
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
            $Value = $dailyIndicators->UFs[0]->Valor;
            $findme   = ',';
            $coma = $this->encontrar($Value, $findme);
            //busco la coma(el decimal)
            if($coma['verificacion'] == true){
                $decimales = $coma['Value'][0];
                $findme   = '.';
                $punto = $this->encontrar($decimales, $findme);
                if($punto['verificacion'] == true){
                    // if es mayor a 50 el decimal, sumo 1
                    if($coma['Value'][1] >= 100){
                        // echo "\n";
                        // echo "entro en if";
                        // $lonDecimales = strlen($punto['Value'][1]);
                        // if($lonDecimales >= 3){
                        //     echo ' if el valor tiene '. $lonDecimales . ' su valor '.$punto['Value'][1];
                        // }else{
                        //     echo ' else el valor tiene '. $lonDecimales . ' su valor '.$punto['Value'][1];
                        // }
                        // echo "\n";
                        $redondeo = $punto['Value'][1]+=$coma['Value'][1];
                        $Value = $punto['Value'][0].$redondeo;
                        // echo ' valor final '.$Value;
                        // exit;
                    }else{
                        // echo "\n";
                        // echo "entro en else";
                        // echo $punto['Value'][0];
                        // exit;
                        $Value = $punto['Value'][0].$punto['Value'][1];
                    }
                }
            }else{
                $findme   = '.';
                //busco el punto dentro de $Value
                $punto = $this->encontrar($Value, $findme);
                if($punto['verificacion'] == true){
                    //lo concateno sin el punto ya que daria erro en el calculo al multiplicar    
                    $Value = $punto['Value'][0].$punto['Value'][1];
                }
            }
            
        }else{
            $Value = 27762.55;
        }
        // $Value = 28004;
        return floatval($Value);
    }
    
    //funcion para buscar un caracter dentro de los valores dados
    function encontrar($Value, $findme){
        //busco el punto o coma dentro de $Value
        $punto = strpos($Value, $findme);
        if($punto == true){
            $Value = explode($findme, $Value);
            $data = array('Value' => $Value,
                      'verificacion' => true
                    );
        }else{
            $data = array('Value' => $Value,
                      'verificacion' => false
                    );
        }
        return $data;
    }
}
?>