<?php
    include_once("../../includes/functions/Functions.php");
    include_once("../../class/trabajador/trabajador.php");
    QueryPHP_IncludeClasses("db");
    $trabajador = new Trabajador(); 
    $trabajador->modificaTrabajador($_POST['nombre'], $_POST['email'], $_POST['telefono'], $_POST['direccion'], $_POST['idTrabajador']);
?>