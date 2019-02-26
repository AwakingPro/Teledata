<?php

    include('../../../class/methods_global/methods.php');
    header('Content-type: application/json');

    class FacturasDetalle {
        private $methods;
        function __construct () {
			$this->methods = new Method;
        }
    	public function BorrarDetalle($DatosDetalle){
            $idDetalle = $DatosDetalle['idDetalle'];
            $idFactura = $DatosDetalle['idFactura'];
            $TipoFactura = $DatosDetalle['TipoFactura'];
            
            $query = "UPDATE facturas_detalle SET FacturaId = 0, delete_at = NOW(),  FacturaIdTmp = $idFactura WHERE Id = '".$idDetalle."'";
            $actualizadoDetalle = $this->methods->update($query);
            if($actualizadoDetalle){
                $respuesta = array(
                    'status' => 1,
                    'Message' => ''
                );
            }else{
                $respuesta = array(
                    'status' => 2,
                    'Message' => 'Error al Eliminar'
                );
            }
            return json_encode($respuesta);
        }
    }
?>