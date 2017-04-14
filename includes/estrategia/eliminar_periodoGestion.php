<?php
    include_once("../../includes/functions/Functions.php");
    include_once("../../class/estrategia/periodo_gestion.php");
    QueryPHP_IncludeClasses("db");
    $PeriodoGestion = new PeriodoGestion(); 
    $PeriodoGestion->eliminaPeriodo($_POST['tipo'], $_POST['idPeriodo']); 
?>