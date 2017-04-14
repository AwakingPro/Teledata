<?php
    include_once("../../includes/functions/Functions.php");
    QueryPHP_IncludeClasses("calidad");
    QueryPHP_IncludeClasses("db");
    $CalidadClass = new Calidad();

    $CalidadClass->Id_Grabacion = $_POST['RecordId'];
    $CalidadClass->Evaluacion_Final = 0;
    
    $Return = $CalidadClass->updateEvaluation();
    echo $Return;
?>