<?php
    include_once("../../includes/functions/Functions.php");
    QueryPHP_IncludeClasses("db");
    QueryPHP_IncludeClasses("reclutamiento");
    $ReclutamientoClass = new Reclutamiento();
    $startDate = $_POST["startDate"];
    $endDate = $_POST["endDate"];
    $Perfil = $_POST["perfil"];

    $Aspirantes = $ReclutamientoClass->getAspirantesByDateAndPerfil($startDate,$endDate,$Perfil);
    $ToReturn = "";
    if(count($Aspirantes) > 0){
        $ToReturn = "<option value=''>Todos</option>";
        foreach($Aspirantes as $Aspirante){
            $ToReturn .= "<option value='".$Aspirante["idUsuario"]."'>".$Aspirante["Nombre_Completo"]."</option>";
        }
    }
    echo $ToReturn;
?>