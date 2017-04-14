<?php
    include_once("../../includes/functions/Functions.php");
    include_once("../../db/db.php");
    QueryPHP_IncludeClasses("calidad");
    QueryPHP_IncludeClasses("db");
    $CalidadClass = new Calidad();
    $CalidadClass->User = $_POST['Ejecutivo'];
    $ArrayIDs = $_POST['IDs'];
    echo json_encode($CalidadClass->getRecordGroupByIDs($ArrayIDs));
?>