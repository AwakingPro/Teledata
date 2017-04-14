<?php
    include_once("../../includes/functions/Functions.php");
    QueryPHP_IncludeClasses("db");
    QueryPHP_IncludeClasses("reclutamiento");
    $ReclutamientoClass = new Reclutamiento();
    $startDate = $_POST["startDate"];
    $endDate = $_POST["endDate"];
    $Perfil = $_POST["perfil"];
    $Aspirante = $_POST["aspirante"];

    $Calificaciones = $ReclutamientoClass->getCalificacionesByDateAndPerfilAndAspirante($startDate,$endDate,$Perfil,$Aspirante);
    $Array = array();
    foreach($Calificaciones as $Calificacion){
        $ArrayTmp = array();
        $ArrayTmp["NombreCompleto"] = $Calificacion["NombreCompleto"];
        $ArrayTmp["PromedioCalificacion"] = number_format($Calificacion["PromedioCalificacion"],2,".","");
        $ArrayTmp["PromedioCalificacionMinima"] = number_format($Calificacion["PromedioCalfMinima"],2,".","");
        $ArrayTmp["Grafico"] = $Calificacion["idPrueba"];
        array_push($Array,$ArrayTmp);
    }
    echo json_encode($Array);
?>