<?php
    include_once("../../includes/functions/Functions.php");
    QueryPHP_IncludeClasses("calidad");
    QueryPHP_IncludeClasses("db");
    $CalidadClass = new Calidad();

    $CalidadClass->Description = utf8_decode($_POST['Description']);
    $CalidadClass->Ponderacion = $_POST['Ponderacion'];
    
    $Return = $CalidadClass->AddEvaluation_Managment();
    if($Return != false){
        echo $Return;
    }else{
        echo "0";
    }
?>