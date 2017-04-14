<?php
if(!isset($_SESSION)){
    session_start();
}
include("../../class/tareas/tareas.php");
$tareas = new Tareas();
$tareas->asignarEstrategia($_POST['id'],$_SESSION['cedente']);
$tareas->mostrarEstrategia();
?>