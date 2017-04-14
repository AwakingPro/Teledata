<?php
    include_once("../../includes/functions/Functions.php");
    QueryPHP_IncludeClasses("db");
    QueryPHP_IncludeClasses("reclutamiento");
    $ReclutamientoClass = new Reclutamiento();
    $startDate = $_POST["startDate"];
    $endDate = $_POST["endDate"];
    $Perfiles = $ReclutamientoClass->getPerfilesByDate($startDate,$endDate);
    $ToReturn = "";
    if(count($Perfiles) > 0){
        $ToReturn = "<option value=''>Todos</option>";
        foreach($Perfiles as $Perfil){
            $ToReturn .= "<option value='".$Perfil["id"]."'>".$Perfil["nombre"]."</option>";
        }
    }
    echo $ToReturn;
?>