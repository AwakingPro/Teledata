<?php
include("../../class/estrategia/estrategia.php");

$estrategia = new Estrategia();
$estrategia->asignarPrioridad($_POST['id_prioridad'],$_POST['valor_prioridad']);

?>