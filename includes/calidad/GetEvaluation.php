<?php
    include_once("../../includes/functions/Functions.php");
    QueryPHP_IncludeClasses("calidad");
    QueryPHP_IncludeClasses("db");
    $CalidadClass = new Calidad();
    $CalidadClass->Id_Grabacion = $_POST['Id_Grabacion'];
    echo json_encode($CalidadClass->getEvaluation());
?>