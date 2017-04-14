<?php 
include("../../class/estrategia/estrategias.php");
$Estrategia = new Estrategia();
$Estrategia->SesionEstrategia($_POST['Id']);
?>    