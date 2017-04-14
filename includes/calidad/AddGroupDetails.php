<?php
    include_once("../../includes/functions/Functions.php");
    QueryPHP_IncludeClasses("calidad");
    QueryPHP_IncludeClasses("db");
    $CalidadClass = new Calidad();
    $CalidadClass->Id_Group = $_POST['Id_Group'];
    $Records = $_POST['Records'];
    $CalidadClass->deleteGroupDetails();
    $CalidadClass->addGroupDetails($Records);