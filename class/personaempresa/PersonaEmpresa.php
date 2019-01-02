<?php

    include('../../class/methods_global/methods.php'); 
    header('Content-type: application/json');

    class PersonaEmpresa{
        var $metodo;

        function __construct () {
			$this->metodo = new Method;
        }
    	
        function SincronizarConBsale(){

            $query = "SELECT token_produccion as access_token FROM variables_globales";
            $variables_globales = $this->metodo->select($query);
            $access_token = $variables_globales[0]['access_token'];
            return $access_token;

        }

    }

?>