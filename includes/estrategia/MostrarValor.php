<?php 
include("../../class/estrategia/estrategias.php");
$Estrategia = new Estrategia();
$Estrategia->MostrarValor($_POST['IdLogica'],$_POST['Id']);
?>    