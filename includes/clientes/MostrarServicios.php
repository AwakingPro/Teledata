<?php 
include("../../class/clientes/ClienteClass.php");
$Cliente = new Cliente();
$Cliente->MostrarServicios($_POST['Rut']);
?>    