<?php 
include("../../class/estrategia/estrategias.php");
$Estrategia = new Estrategia();
$Estrategia->Deshacer($_POST['IdEstrategia']);
?>    