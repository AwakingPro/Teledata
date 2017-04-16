<?php 
include("../../class/clientes/ClienteClass.php");
$Cliente = new Cliente();
$Cliente->AgregaServicio($_POST['Rut'],$_POST['IdServicio'],$_POST['Descripcion'],$_POST['IdTipo']);
?>    