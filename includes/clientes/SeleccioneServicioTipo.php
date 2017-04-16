<?php 
include("../../class/clientes/ClienteClass.php");
$Cliente= new Cliente();
$Cliente->SeleccioneServicioTipo($_POST['IdTipo']);
?>    