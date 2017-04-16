<?php 
include("../../class/clientes/ClienteClass.php");
$Cliente= new Cliente();
$Cliente->CrearCliente($_POST['Nombre'],$_POST['Rut'],$_POST['Dv']);
?>    