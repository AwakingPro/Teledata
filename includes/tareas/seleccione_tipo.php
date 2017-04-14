<?php
include("../../class/tareas/tareas.php");
$tareas = new Tareas();
$tareas->asignarTipo($_POST['id'],$_POST['id_cedente']);
$tareas->mostrarTipo();
?>