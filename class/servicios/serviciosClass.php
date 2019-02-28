<?php

    include('../../class/methods_global/methods.php');
    header('Content-type: application/json');

    class Servicio {
        private $methods;
        function __construct () {
			$this->methods = new Method;
        }
    	public function devolverTareaServicio($DatosServicio){
            $idServicio = $DatosServicio['idServicio'];
            $idFactura = $DatosServicio['idFactura'];
            $TipoFactura = $DatosServicio['TipoFactura'];
            
            $query = "UPDATE servicios SET EstatusInstalacion  = 2 WHERE Id = '".$idServicio."'";
            $actualizadoServicio = $this->methods->update($query);
            if($actualizadoServicio){
                $respuesta = array(
                    'status' => 1,
                    'Message' => ''
                );
            }else{
                $respuesta = array(
                    'status' => 2,
                    'Message' => 'Error al Actualizar el Estado del Servicio'
                );
            }
            return json_encode($respuesta);
        }
    }
?>