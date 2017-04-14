<?php
    include_once("../../includes/functions/Functions.php");
    include_once("../../db/db.php");
    QueryPHP_IncludeClasses("calidad");
    QueryPHP_IncludeClasses("db");
    $CalidadClass = new Calidad();
    $CalidadClass->User = $_POST['Ejecutivo'];
    $CalidadClass->Id_Cedente = $_POST['Cartera'];
    $CalidadClass->Id_Mandante = $_POST['Mandante'];
    echo json_encode($CalidadClass->getRecordListEvaluadosAjax());
?>