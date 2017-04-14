<?php
include("../../class/estrategia/estrategia.php");

$estrategia = new Estrategia();
$estrategia->javaGetIvr($_POST['data']);

?>
