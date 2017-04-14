<?php
    include_once("../../includes/functions/Functions.php");
    QueryPHP_IncludeClasses("db");
    QueryPHP_IncludeClasses("reclutamiento");
    $ReclutamientoClass = new Reclutamiento();
    $idUsuario = $_POST['idUsuario'];
    $idPerfil = $_POST['idPerfil'];
    $idTest = $_POST['idTest'];

    $ToReturn = $ReclutamientoClass->crearPrueba($idUsuario,$idPerfil,$idTest);
    echo json_encode($ToReturn);
?>