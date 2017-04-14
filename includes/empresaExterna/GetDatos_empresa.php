<?php
    include_once("../../includes/functions/Functions.php");
    include_once("../../class/empresaExterna/empresaExterna.php");
    QueryPHP_IncludeClasses("db");
    $empresa = new Empresa(); 
    echo json_encode($empresa->muestraDatosEmpresa($_POST['idEmpresa']));  
?>