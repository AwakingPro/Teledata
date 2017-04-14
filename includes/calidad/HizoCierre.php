<?php
    include_once("../../includes/functions/Functions.php");
    QueryPHP_IncludeClasses("calidad");
    QueryPHP_IncludeClasses("personal");
    QueryPHP_IncludeClasses("db");
    $CalidadClass = new Calidad();

    $CalidadClass->User = $_POST['Ejecutivo'];
    $CalidadClass->Id_Cedente = $_POST['Cartera'];
    $CalidadClass->Id_Mandante = $_POST['Mandante'];
    
    $Return = $CalidadClass->HizoCierre();
    $Array = array();
    $Array["Return"] = false;
    if($Return === true){
        $Array["Return"] = true;
    }
    echo json_encode($Array);
?>