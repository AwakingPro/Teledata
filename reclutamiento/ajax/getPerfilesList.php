<?php
    include_once("../../includes/functions/Functions.php");
    QueryPHP_IncludeClasses("db");
    QueryPHP_IncludeClasses("reclutamiento");
    $ReclutamientoClass = new Reclutamiento();

    $Perfiles = $ReclutamientoClass->getPerfiles();
    $ToReturn = "";
    if(count($Perfiles) > 0){
        foreach($Perfiles as $Perfil){
            $ToReturn .= "<option value='".$Perfil["id"]."'>".$Perfil["nombre"]."</option>";
        }
    }
    echo $ToReturn;
?>