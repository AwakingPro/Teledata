<?php 
include("../../class/crm/crm.php");
$crm = new crm();
$crm->mostrarGestionDiaria($_POST['rut']);
?>