<?php
    include_once("../../includes/functions/Functions.php");
    QueryPHP_IncludeClasses("calidad");
    QueryPHP_IncludeClasses("db");
    QueryPHP_IncludeClasses("personal");
    $CalidadClass = new Calidad();
    $PersonalClass = new Personal();

    $PersonalClass->Username = $_POST['PersonalUsername'];;
    $CalidadClass->Id_Personal = $PersonalClass->getPersonalIDFromUsername();
    $CalidadClass->Id_Grabacion = $_POST['RecordId'];
    $CalidadClass->Evaluacion_Final = 0;
    
    $Return = $CalidadClass->AddEvaluation();
    if($Return != false){
        echo $Return;
    }else{
        echo "0";
    }
?>