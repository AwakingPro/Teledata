<?php 
include("../../class/estrategia/estrategias.php");
$Estrategia = new Estrategia();
$Estrategia->MoverGrupo($_POST['IdSubQuery']);
?>    