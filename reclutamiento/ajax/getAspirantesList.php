<?php
    include_once("../../includes/functions/Functions.php");
    QueryPHP_IncludeClasses("db");
    QueryPHP_IncludeClasses("reclutamiento");
    $ReclutamientoClass = new Reclutamiento();

    $Aspirantes = $ReclutamientoClass->getAspirantesSinPruebasActivas();
    $ToReturn = "";
    if(count($Aspirantes) > 0){
        foreach($Aspirantes as $Aspirante){
            $ToReturn .= "<option value='".$Aspirante["idUsuario"]."'>".$Aspirante["Nombre_Completo"]."</option>";
        }
    }
    echo $ToReturn;
?>