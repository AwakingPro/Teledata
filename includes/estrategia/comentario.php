<?php
include("../../class/estrategia/estrategia.php");

$estrategia = new Estrategia();
$estrategia->asignarComentario($_POST['id_com'],$_POST['valor_com']);

?>