<?php
include_once("../../includes/functions/Functions.php");
include_once("../../class/estrategia/config_tablas.php");
QueryPHP_IncludeClasses("db");
$ConfigTablas = new ConfigTablas();
$ConfigTablas->eliminarTablaCedente($_POST['idCedente'], $_POST['idTabla']); 
?>