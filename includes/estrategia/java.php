<?php
include("../../class/estrategia/estrategia.php");

$estrategia = new Estrategia();
$estrategia->javaGet($_POST['data']);

?>
