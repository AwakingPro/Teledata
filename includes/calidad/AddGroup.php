<?php
    include_once("../../includes/functions/Functions.php");
    QueryPHP_IncludeClasses("calidad");
    QueryPHP_IncludeClasses("db");
    QueryPHP_IncludeClasses("personal");
    $CalidadClass = new Calidad();
    $PersonalClass = new Personal();

    $PersonalClass->Username = $_POST['PersonalUsername'];
    $CalidadClass->Id_Personal = $PersonalClass->getPersonalIDFromUsername();
    $CalidadClass->Aspectos_Fortalecer = $_POST['Observation_aspectosF'];
    $CalidadClass->Aspectos_Corregir = $_POST['Observation_aspectosC'];
    $CalidadClass->Compromiso_Ejecutivo = $_POST['Observation_comprimisoE'];
    
    $Return = $CalidadClass->AddGroup();
    if($Return != false){
        echo $Return;
    }else{
        echo "0";
    }
?>