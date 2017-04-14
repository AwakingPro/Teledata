<?php
    include_once("../../includes/functions/Functions.php");
    QueryPHP_IncludeClasses("calidad");
    QueryPHP_IncludeClasses("db");
    $CalidadClass = new Calidad();

    $CalidadClass->User = $_POST['Ejecutivo'];
    $CalidadClass->Id_Cedente = $_POST['Cartera'];
    $CalidadClass->Id_Mandante = $_POST['Mandante'];
    
    $Return = $CalidadClass->PuedeHacerCierreDeProceso();
    $Array = array();
    $Array["Return"] = false;
    if($Return){
        $Array["Return"] = true;
    }
    echo json_encode($Array);
?>