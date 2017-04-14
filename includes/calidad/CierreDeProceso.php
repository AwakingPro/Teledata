<?php
    include_once("../../includes/functions/Functions.php");
    QueryPHP_IncludeClasses("calidad");
    QueryPHP_IncludeClasses("personal");
    QueryPHP_IncludeClasses("db");
    $CalidadClass = new Calidad();

    $CalidadClass->User = $_POST['Ejecutivo'];
    $CalidadClass->Id_Cedente = $_POST['Cartera'];
    $CalidadClass->Id_Mandante = $_POST['Mandante'];
    $CalidadClass->Aspectos_Fortalecer = $_POST['Observation_aspectosF'];
    $CalidadClass->Aspectos_Corregir = $_POST['Observation_aspectosC'];
    $CalidadClass->Compromiso_Ejecutivo = $_POST['Observation_comprimisoE'];
    
    $Return = $CalidadClass->CierreDeProceso();
    $Array = array();
    //$Array["Return"] = false;
    $Array["Return"] = true;
    if($Return === true){
        $Array["Return"] = true;
    }
    echo json_encode($Array);
?>