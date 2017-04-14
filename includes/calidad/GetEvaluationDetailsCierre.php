<?php
    include_once("../../includes/functions/Functions.php");
    QueryPHP_IncludeClasses("calidad");
    QueryPHP_IncludeClasses("db");
    $CalidadClass = new Calidad();
    echo json_encode($CalidadClass->getEvaluationDetailsCierre($_POST['Id_Evaluaciones']));
?>