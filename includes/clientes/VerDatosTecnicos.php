<?php 
include("../../class/clientes/ClienteClass.php");
$Cliente = new Cliente();
$Cliente->VerDatosTecnicos($_POST['Rut'],$_POST['Id']);
?>    