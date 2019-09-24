<?php
    header('Content-type: application/json');

    class Usuarios {
        private $methods;
        function __construct () {
            $this->methods = new Method;
        }

    	public function compruebaSesion(){
            
            $query = " SELECT * FROM usuarios WHERE estaLogin = 1 ";
            $resultado = $this->methods->select($query);
            if(count($resultado)){
                foreach($resultado as $result){
                    $fechaAntigua = date('Y-m-d H:i:s',$result['tiempoUltimaRecarga']/1000);
                    $fechaAntigua = new DateTime( $fechaAntigua);
                    $fechaActual  = new DateTime("now");
                    $intervalo = $fechaAntigua->diff($fechaActual);
                    $horasTranscurridas = $intervalo->h;
                    if($horasTranscurridas >= 1){
                        $id = $result['id'];
                        $query = "  UPDATE usuarios SET estaLogin = 0 WHERE id = '".$id."' ";
                    }
                }
                				
            }
            // return json_encode($respuesta);
        }
    }
?>