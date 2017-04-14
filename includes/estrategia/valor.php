<?php
include("../../class/estrategia/estrategia.php");

$estrategia = new Estrategia();
$estrategia->asignarValor($_POST['id_columna']);
$estrategia->mostrarValor();

?>