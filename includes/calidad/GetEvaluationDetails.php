<?php
    include_once("../../includes/functions/Functions.php");
    QueryPHP_IncludeClasses("calidad");
    QueryPHP_IncludeClasses("db");
    $CalidadClass = new Calidad();
    $CalidadClass->Id_Evaluacion = $_POST['Id_Evaluacion'];
    echo json_encode($CalidadClass->getEvaluationDetails());
?>