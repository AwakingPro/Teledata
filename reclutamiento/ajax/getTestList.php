<?php
    include_once("../../includes/functions/Functions.php");
    QueryPHP_IncludeClasses("db");
    QueryPHP_IncludeClasses("reclutamiento");
    $ReclutamientoClass = new Reclutamiento();

    $Tests = $ReclutamientoClass->getTests();
    $ToReturn = "";
    if(count($Tests) > 0){
        foreach($Tests as $Test){
            $ToReturn .= "<option value='".$Test["id"]."'>".$Test["nombre"]."</option>";
        }
    }
    echo $ToReturn;
?>