<?php
    include_once("../../includes/functions/Functions.php");
    QueryPHP_IncludeClasses("db");
    QueryPHP_IncludeClasses("reclutamiento");
    $ReclutamientoClass = new Reclutamiento();

    $Pruebas = $ReclutamientoClass->getPruebasActivas();
    $Array = array();
    foreach($Pruebas as $Prueba){
        $ArrayTmp = array();
        $ArrayTmp["Nombre"] = $Prueba["Nombre"];
        $ArrayTmp["Perfil"] = $Prueba["Perfil"];
        $ArrayTmp["Correo"] = $Prueba["Correo"];
        $ArrayTmp["Telefono"] = $Prueba["Telefono"];
        $ArrayTmp["Acciones"] = $Prueba["Prueba"];
        array_push($Array,$ArrayTmp);
    }
    echo json_encode($Array);
?>