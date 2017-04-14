<?php
    include_once("../../includes/functions/Functions.php");
    include_once("../../class/estrategia/estrategia.php");
    $EstrategiaClass = new Estrategia();
    $Estrategia = $_POST['Estrategia'];
    $Colas = $EstrategiaClass->getColas($Estrategia);
    echo $Colas;
?>