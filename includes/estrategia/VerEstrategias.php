<?php 
include("../../class/estrategia/estrategias.php");
$Estrategia = new Estrategia();
$Estrategia->MostrarEstrategias($_POST['IdEstrategia']);
?>    