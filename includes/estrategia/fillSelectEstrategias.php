<?php
    include_once("../../includes/functions/Functions.php");
    include_once("../../class/estrategia/estrategia.php");
    $EstrategiaClass = new Estrategia();
    $Cedente = $_SESSION['cedente'];
    $Estrategias = $EstrategiaClass->getEstrategias($Cedente);
    echo $Estrategias;
?>