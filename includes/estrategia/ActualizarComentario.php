<?php 
include("../../class/estrategia/estrategias.php");
$Estrategia = new Estrategia();
$Estrategia->ActualizarComentario($_POST['Id'],$_POST['ValorComentario']);
?>    