<?php 
include("../../class/clientes/ClienteClass.php");
$Cliente= new Cliente();
$Cliente->TipoBusqueda($_POST['data']);
?>    