<?php
include("../../class/estrategia/estrategia.php");

$estrategia = new Estrategia();
$estrategia->asignarLogica($_POST['id_columna']);
$estrategia->mostrarLogica();

?>