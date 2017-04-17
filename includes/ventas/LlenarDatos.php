<?php 
include("../../class/ventas/DteClass.php");
$Dte = new Dte();
$Dte->LlenarDatos($_POST['Rut']);
?>    