<?php
include("../../class/estrategia/estrategia.php");

$estrategia = new Estrategia();
$estrategia->asignarCola($_POST['id_cola'],$_POST['valor_cola']);

?>