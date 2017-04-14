<?php
    include_once("../../includes/functions/Functions.php");
    QueryPHP_IncludeClasses("calidad");
    QueryPHP_IncludeClasses("db");
    $CalidadClass = new Calidad();
    $CalidadClass->startDate = $_POST['startDate'];
    $CalidadClass->endDate = $_POST['endDate'];
    $Carteras = $CalidadClass->getCarteraList();
    $ToReturn = "";
    foreach($Carteras as $Cartera){
        $ToReturn .= "<option value='".$Cartera["Cartera"]."'>".$Cartera["Cartera"]."</option>";
    }
    echo $ToReturn;
?>