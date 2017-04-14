<?php    
    include_once("../../includes/functions/Functions.php");
    include_once("../../class/estrategia/periodo_gestion.php");
    QueryPHP_IncludeClasses("db");
    $PeriodoGestion = new PeriodoGestion();
    //$PeriodoGestion->listaPeriodo($_POST['idCedente']);
    echo json_encode($PeriodoGestion->listaPeriodo($_POST['idCedente']));     
?>