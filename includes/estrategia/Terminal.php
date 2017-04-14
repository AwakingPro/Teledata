<?php 
include("../../class/estrategia/estrategias.php");
$Estrategia = new Estrategia();
$Estrategia->Terminal($_POST['IdTerminal'],$_POST['Check']);
?>    