<?php
include("../../class/asignacion/asignacion.php");
$asignar = new Asignacion();
$asignar->asignarInsertar($_POST['accion'],$_POST['gestores'],$_POST['gestores_sel'],$_POST['cant'],$_POST['exito'],$_POST['id_nuevo']);
$asignar->mostrarInsertar();
?>