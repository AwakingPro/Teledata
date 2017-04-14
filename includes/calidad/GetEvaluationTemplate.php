<?php
    include_once("../../includes/functions/Functions.php");
    QueryPHP_IncludeClasses("calidad");
    QueryPHP_IncludeClasses("db");
    $CalidadClass = new Calidad();
    $Ejecutivo = $_POST["Ejecutivo"];
    $CalidadClass->User = $Ejecutivo;
    $Evaluations = $CalidadClass->getEvaluationTemplate();
    echo utf8_encode(json_encode($Evaluations));
?>