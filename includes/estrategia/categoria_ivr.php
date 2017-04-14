<?php
include("../../class/estrategia/estrategia.php");

$estrategia = new Estrategia();
$estrategia->asignarCategoriaIvr($_POST['color'],$_POST['tipo_contacto'],$_POST['dias'],$_POST['cant1'],$_POST['cond1'],$_POST['logica'],$_POST['cant2'],$_POST['cond2'],$_POST['w'],$_POST['mundo']);

?>
