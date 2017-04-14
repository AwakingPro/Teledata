<?php 
include("../../class/crm/crm.php");
$crm = new crm();
$crm->insertarDireccion($_POST['rut'],$_POST['direccion_nuevo']);
?>    