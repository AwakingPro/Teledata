<?php
    include_once("../../includes/functions/Functions.php");
    QueryPHP_IncludeClasses("personal");
    QueryPHP_IncludeClasses("db");
    $PersonalClass = new Personal();
    $PersonalClass->startDate = $_POST['startDate'];
    $PersonalClass->endDate = $_POST['endDate'];
    $PersonalClass->Cartera = $_POST['Cartera'];
    $Personals = $PersonalClass->getPersonalList();
    $ToReturn = "";
    foreach($Personals as $Personal){
        if($Personal["Nombre_Usuario"] != ""){
            $ToReturn .= "<option value='".$Personal["Nombre_Usuario"]."'>".$Personal["Nombre"]."</option>";
        }
    }
    echo $ToReturn;
?>