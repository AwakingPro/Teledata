<?php
    include_once("../../includes/functions/Functions.php");
    QueryPHP_IncludeClasses("calidad");
    QueryPHP_IncludeClasses("db");
    $CalidadClass = new Calidad();
    $CalidadClass->Id_Cierre = $_POST['CierreId'];
    echo json_encode($CalidadClass->getCierre());
?>