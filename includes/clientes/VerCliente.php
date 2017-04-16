<?php 
include("../../class/clientes/ClienteClass.php");
$Cliente= new Cliente();
$Cliente->VerCliente($_POST['Rut']);
?>    